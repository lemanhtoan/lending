<?php

namespace App\Http\Controllers;

use App\Jobs\ChangeLocale;

use App\Models\User;
use App\Settings;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Borrow;
use App\Models\Invest;
use App\Models\Post;
use App\Models\Verified;

class HomeController extends Controller
{

	/**
	 * Display the home page.
	 *
	 * @return Response
	 */
	public function index()
	{
        if (Auth::user()) {
            $userType =  Auth::user()->usertype;
            $uid = Auth::user()->id;
            $borrowsExist = Invest::where('uid', $uid)->get();
            if (count($borrowsExist)) {
                $arrBorrow = [];
                foreach ($borrowsExist as $exist) {
                    $arrBorrow[] = $exist->borrowId;
                }
                $borrows = Borrow::where('status', 1)->whereNotIn('id', $arrBorrow)->orderBy('created_at', 'desc')->get();
            }else {
                $borrows = Borrow::where('status', 1)->orderBy('created_at', 'desc')->get();
            }
        }else {
            $userType = 'NON';
            $uid = 0;

            $borrows = Borrow::where('status', 1)->orderBy('created_at', 'desc')->get();
        }

        $borrowsOfUser = Borrow::where('uid', $uid)->orderBy('created_at', 'desc')->get();
        $investsOfUser = Invest::leftJoin('borrow', 'invest.borrowId','=', 'borrow.id')->where('invest.uid', $uid)->orderBy('invest.created_at', 'desc')->get(
            ['invest.*', 'borrow.soluongthechap', 'borrow.kieuthechap', 'borrow.thoigianthechap', 'borrow.phantramlai', 'borrow.dutinhlai', 'borrow.sotiencanvay', 'borrow.ngaygiaingan', 'borrow.ngaydaohan']
        );

        $khoanggia = \Config::get('constants.khoanggia');
        $blogs = Post::where('active', 1)->orderBy('updated_at', 'desc')->get();

		return view('front.index', compact('blogs', 'userType', 'uid', 'borrows', 'borrowsOfUser', 'investsOfUser', 'khoanggia'));
	}

	public function coinmarketcap(Request $request) {
	    $sothechap = $request->input('sothechap');
        $methodPay = $request->input('methodPay');
        switch ($methodPay) {
            case 'BTC' :
                $url = 'https://api.coinmarketcap.com/v1/ticker/bitcoin/?ref=widget&convert=USD';
                break;
            case 'ETH' :
                $url = 'https://api.coinmarketcap.com/v1/ticker/ethereum/?ref=widget&convert=USD';
                break;
            case 'LTC' :
                $url = 'https://api.coinmarketcap.com/v1/ticker/litecoin/?ref=widget&convert=USD';
                break;
        }
        $jsonData = json_decode(file_get_contents($url));
        $dataPriceGet = $jsonData[0]->price_usd; // get from website later
        $dataTygia = DB::table('settings')->where('name', 'tygiaUV')->select('content')->get()[0];
        $tygia = isset($dataTygia) ? $dataTygia->content : 1;
        $maxValue = ($sothechap * $dataPriceGet * 70 * $tygia)/ 100;
        return \Response::json(round($maxValue, 2));
    }

    public function borrowcalc(Request $request) {
        $sothechap = $request->input('sothechap');
        $methodPay = $request->input('methodPay');
        $cost = $request->input('cost');
        $month = $request->input('month');
        $dataLaisuat = DB::table('settings')->where('name', 'laisuat')->select('content')->get()[0];
        $laisuat = isset($dataLaisuat) ? $dataLaisuat->content : 1;
        $laithang = ($cost * $laisuat)/ 100;
        $tong = ( (($cost * $laisuat)/ 100) * $month) +  $cost;
        $data = array(
            'permonth' => $laithang,
            'total' => $tong
        );
        return \Response::json($data);
    }

	/**
	 * Change language.
	 *
	 * @param  App\Jobs\ChangeLocaleCommand $changeLocale
	 * @param  String $lang
	 * @return Response
	 */
	public function language( $lang,
		ChangeLocale $changeLocale)
	{		
		$lang = in_array($lang, config('app.languages')) ? $lang : config('app.fallback_locale');
		$changeLocale->lang = $lang;
		$this->dispatch($changeLocale);

		return redirect()->back();
	}

    public function settingSet(Request $rq) {
        $type = $rq->input('stype');
        if ($type == 'dataLogo') {
            $check = Settings::where('name', 'dataLogo')->lists( 'content', 'id')->toArray();
            if ($check) {
                $checkId = key($check);
                $checkContent = array_values($check)[0];
                $cat = Settings::find($checkId);
                $cat->name = $type;
                $file_path = public_path('uploads/commons/').$checkContent;
                if ($rq->hasFile('value')) {
                    if (file_exists($file_path))
                    {
                        unlink($file_path);
                    }

                    $f = $rq->file('value')->getClientOriginalName();
                    $filename = time().'_'.$f;
                    $cat->content = $filename;
                    $rq->file('value')->move('uploads/commons/',$filename);
                }
                $cat->save();

            } else {
                $item = new Settings();
                $f = $rq->file('value')->getClientOriginalName();
                $filename = time().'_'.$f;
                $item->name = $type;
                $item->content = $filename;
                $rq->file('value')->move('uploads/commons/',$filename);
                $item->save();
            }
        }elseif($type == 'khoitao') {
            $value = $rq->input('value');
            // get usertype = 1 => insert or update
            // later
        }else{
                $key = $rq->input('stype');
                $value = $rq->input('value');
                $check = Settings::where('name', $key)->lists( 'content', 'id')->toArray();
                if ($check) {
                    $checkId = key($check);
                    $cat = Settings::find($checkId);
                    $cat->name = $key;
                    $cat->content = $value;
                    $cat->save();

                } else {
                    $item = new Settings();
                    $item->name = $key;
                    $item->content = $value;
                    $item->save();
                }
            }

        return redirect()->route('getsettings');
    }

    public function getsettings()
    {
        return View ('back.settings-list', $this->getDataSetting());
    }

    public function getDataSetting() {
        return [
            'data'=>Settings::all(),
            'dataLogo' => Settings::where('name', 'dataLogo')->get(['content'])->toArray(),
            'dataHotline' => Settings::where('name', 'dataHotline')->get(['content'])->toArray(),
            'emailsupport' => Settings::where('name', 'emailsupport')->get(['content'])->toArray(),
            'mainbg' => Settings::where('name', 'mainbg')->get(['content'])->toArray(),
            'maincolor'=> Settings::where('name', 'maincolor')->get(['content'])->toArray(),
            'laisuat'=> Settings::where('name', 'laisuat')->get(['content'])->toArray(),
            'tygiaUV'=> Settings::where('name', 'tygiaUV')->get(['content'])->toArray(),
            'daylost'=> Settings::where('name', 'daylost')->get(['content'])->toArray(),
            'dayredm'=> Settings::where('name', 'dayredm')->get(['content'])->toArray(),
            'maxqty'=> Settings::where('name', 'maxqty')->get(['content'])->toArray(),
            'maxverified'=> Settings::where('name', 'maxverified')->get(['content'])->toArray(),
            'footer'=> Settings::where('name', 'footer')->get(['content'])->toArray(),
            'emailadmin'=> Settings::where('name', 'emailadmin')->get(['content'])->toArray()
        ];
    }

    public function homeFilter(Request $request) {
	    $sotienvay = $request->input('search_sotienvay');
	    $thoigianvay = $request->input('search_thoigianvay');
	    $tienthechap = $request->input('search_tienthechap');
	    $laisuat = $request->input('search_laisuat');
	    $tiennhan = $request->input('search_tiennhan');
        $sqlData = "SELECT *  FROM borrow  WHERE status = '1' ";
        if ($sotienvay != "") {
            if ($sotienvay != '0') { // all
                switch ($sotienvay) {
                    case '1':
                        $sqlData .= " AND sotiencanvay BETWEEN '0' AND '2000000'";
                        break;
                    case '2':
                        $sqlData .= " AND sotiencanvay BETWEEN '2000000' AND '4000000'";
                        break;
                    case '4':
                        $sqlData .= " AND sotiencanvay BETWEEN '4000000' AND '6000000'";
                        break;
                    case '6':
                        $sqlData .= " AND sotiencanvay BETWEEN '6000000' AND '9000000'";
                        break;
                    case '15x':
                        $sqlData .= " AND sotiencanvay >= '15000000'";
                        break;
                }

            }
        }
        if ($thoigianvay != "") {
            $sqlData .= " AND thoigianthechap ='".$thoigianvay."'";
        }

        if ($tienthechap != "") {
            $sqlData .= " AND kieuthechap ='".$tienthechap."'";
        }

        if ($laisuat != "") {
            $sqlData .= " AND phantramlai ='".$laisuat."'";
        }

        if ($tiennhan != "") {
            $sqlData .= " AND kieuthechap ='".$tiennhan."'";
        }

        $sqlDataUser = $sqlData;

        if (Auth::user()) {
            $userType =  Auth::user()->usertype;
            $uid = Auth::user()->id;
            $borrowsExist = Invest::where('uid', $uid)->get();
            if (count($borrowsExist)) {
                $arrBorrow = [];
                foreach ($borrowsExist as $exist) {
                    $arrBorrow[] = $exist->borrowId;
                }
                $sqlData .= " AND id NOT IN ( '" . implode($arrBorrow, "', '") . "' )";
            }
            $sqlDataUser .= " AND uid = '".$uid."'";
        }else {
            $userType = 'NON';
            $uid = 0;
        }
        $sqlData  .=' ORDER BY created_at desc';
        $borrows = DB::select(DB::raw($sqlData));

        $sqlDataUser  .=' ORDER BY created_at desc';
        $borrowsOfUser = DB::select(DB::raw($sqlDataUser));

        $investsOfUser = Invest::leftJoin('borrow', 'invest.borrowId','=', 'borrow.id')->where('invest.uid', $uid)->orderBy('invest.created_at', 'desc')->get(
            ['invest.*', 'borrow.soluongthechap', 'borrow.kieuthechap', 'borrow.thoigianthechap', 'borrow.phantramlai', 'borrow.dutinhlai', 'borrow.sotiencanvay', 'borrow.ngaygiaingan', 'borrow.ngaydaohan']
        );

        $khoanggia = \Config::get('constants.khoanggia');
        $blogs = Post::where('active', 1)->orderBy('updated_at', 'desc')->get();

        return view('front.index', compact('blogs', 'userType', 'uid', 'borrows', 'borrowsOfUser', 'investsOfUser', 'khoanggia'));
    }

    public function getNewLoan(Request $request) {
        $sotienvay = $request->input('search_sotienvay');
        $thoigianvay = $request->input('search_thoigianvay');
        $tienthechap = $request->input('search_tienthechap');
        $laisuat = $request->input('search_laisuat');
        $tiennhan = $request->input('search_tiennhan');
        $sqlData = "SELECT *  FROM borrow  WHERE status = '1' ";
        if ($sotienvay != "") {
            if ($sotienvay != '0') { // all
                switch ($sotienvay) {
                    case '1':
                        $sqlData .= " AND sotiencanvay BETWEEN '0' AND '2000000'";
                        break;
                    case '2':
                        $sqlData .= " AND sotiencanvay BETWEEN '2000000' AND '4000000'";
                        break;
                    case '4':
                        $sqlData .= " AND sotiencanvay BETWEEN '4000000' AND '6000000'";
                        break;
                    case '6':
                        $sqlData .= " AND sotiencanvay BETWEEN '6000000' AND '9000000'";
                        break;
                    case '15x':
                        $sqlData .= " AND sotiencanvay >= '15000000'";
                        break;
                }

            }
        }
        if ($thoigianvay != "") {
            $sqlData .= " AND thoigianthechap ='".$thoigianvay."'";
        }

        if ($tienthechap != "") {
            $sqlData .= " AND kieuthechap ='".$tienthechap."'";
        }

        if ($laisuat != "") {
            $sqlData .= " AND phantramlai ='".$laisuat."'";
        }

        if ($tiennhan != "") {
            $sqlData .= " AND kieuthechap ='".$tiennhan."'";
        }

        $sqlDataUser = $sqlData;

        if (Auth::user()) {
            $userType =  Auth::user()->usertype;
            $uid = Auth::user()->id;
            $borrowsExist = Invest::where('uid', $uid)->get();
            if (count($borrowsExist)) {
                $arrBorrow = [];
                foreach ($borrowsExist as $exist) {
                    $arrBorrow[] = $exist->borrowId;
                }
                $sqlData .= " AND id NOT IN ( '" . implode($arrBorrow, "', '") . "' )";
            }
            $sqlDataUser .= " AND uid = '".$uid."'";
        }else {
            $userType = 'NON';
            $uid = 0;
        }
        $sqlData  .=' ORDER BY created_at desc';
        $borrows = DB::select(DB::raw($sqlData));

        $sqlDataUser  .=' ORDER BY created_at desc';
        $borrowsOfUser = DB::select(DB::raw($sqlDataUser));

        $investsOfUser = Invest::leftJoin('borrow', 'invest.borrowId','=', 'borrow.id')->where('invest.uid', $uid)->orderBy('invest.created_at', 'desc')->get(
            ['invest.*', 'borrow.soluongthechap', 'borrow.kieuthechap', 'borrow.thoigianthechap', 'borrow.phantramlai', 'borrow.dutinhlai', 'borrow.sotiencanvay', 'borrow.ngaygiaingan', 'borrow.ngaydaohan']
        );

        $khoanggia = \Config::get('constants.khoanggia');
        $blogs = Post::where('active', 1)->orderBy('updated_at', 'desc')->get();
        return view('front.newloan', compact('blogs', 'userType', 'uid', 'borrows', 'borrowsOfUser', 'investsOfUser', 'khoanggia'));
    }

    public function manager() {
        if (Auth::user()) {
            $userType =  Auth::user()->usertype;
            $uid = Auth::user()->id;
        }else {
            $userType = 'NON';
            $uid = 0;
        }

        $borrowsOfUser = Borrow::where('uid', $uid)->orderBy('created_at', 'desc')->get();

        $investsOfUser = Invest::leftJoin('borrow', 'invest.borrowId','=', 'borrow.id')->where('invest.uid', $uid)->orderBy('invest.created_at', 'desc')->get(
            ['invest.*', 'borrow.soluongthechap', 'borrow.kieuthechap', 'borrow.thoigianthechap', 'borrow.phantramlai', 'borrow.dutinhlai', 'borrow.sotiencanvay', 'borrow.ngaygiaingan', 'borrow.ngaydaohan']
        );

        $blogs = Post::where('active', 1)->orderBy('updated_at', 'desc')->get();

        return view('front.mborrow', compact('blogs', 'userType', 'uid', 'borrowsOfUser', 'investsOfUser'));
    }

    public function deleteitem(Request $request) {
	    $id = $request->input('id');
        if (Auth::user()) {
            $uid = Auth::user()->id;
            $userType =  Auth::user()->usertype;
        }else {
            $uid = 0;
            $userType = 'NON';
        }

        $investsOfUser = Invest::leftJoin('borrow', 'invest.borrowId','=', 'borrow.id')->where('invest.uid', $uid)->orderBy('invest.created_at', 'desc')->get(
            ['invest.*', 'borrow.soluongthechap', 'borrow.kieuthechap', 'borrow.thoigianthechap', 'borrow.phantramlai', 'borrow.dutinhlai', 'borrow.sotiencanvay', 'borrow.ngaygiaingan', 'borrow.ngaydaohan']
        );

        $blogs = Post::where('active', 1)->orderBy('updated_at', 'desc')->get();
        $borrowCheck = Borrow::where('uid', $uid)->where('id', $id)->get();
        if(count($borrowCheck)) {
            Borrow::where('uid', $uid)->where('id', $id)->delete();
            $ok = 'Deleted item';
            $borrowsOfUser = Borrow::where('uid', $uid)->orderBy('created_at', 'desc')->get();

            return view('front.mborrow', compact('blogs', 'userType', 'uid', 'borrowsOfUser', 'investsOfUser', 'ok'));
        } else {
            $error = 'item not exist';
            $borrowsOfUser = Borrow::where('uid', $uid)->orderBy('created_at', 'desc')->get();

            return view('front.mborrow', compact('blogs', 'userType', 'uid', 'borrowsOfUser', 'investsOfUser', 'error'));
        }
    }

    public function uploadVerified(Request $request) {
        if (Auth::user()) {
            $uid = Auth::user()->id;
            $type = $request->input('isType');
            if ($type == '0') {
                $lt = 'Hình thức CMTND';
            } else {$lt = 'Hình thức Postcode';}
            $front = $request->file('front_end');
            if (isset($front)) {
                $name_img_f = uniqid().'_'.$front->getClientOriginalName();
                $front->move('uploads/verified/',$name_img_f);
            }

            $back = $request->file('back_end');
            if (isset($back)) {
                $name_img_b = uniqid().'_'.$back->getClientOriginalName();
                $back->move('uploads/verified/',$name_img_b);
            }

            if ($back && $front) {
                $isCheck = Verified::where('uid', $uid)->where('type', $type)->get();
                if (count($isCheck)) {
                    Verified::where('uid', $uid)->where('type', $type)->update(array('front'=>$name_img_f, 'back'=> $name_img_b));
                } else {
                    $verified = new Verified();
                    $verified->uid = $uid;
                    $verified->type = $type;
                    $verified->front = $name_img_f;
                    $verified->back = $name_img_b;
                    $verified->status = 0;
                    $verified->save();
                }
                $ok = 'Xác thực đã được gửi đi ('.$lt.') - chờ admin xét duyệt';
                return view('front.verified', compact('ok'));
            }else {
                $error = 'Vui lòng nhập đủ file yêu cầu';
                return view('front.verified', compact('error'));
            }

        } else {
            $error = 'Vui lòng login và xác thực lại';
            return view('front.verified', compact('error'));
        }
    }
    public function borrowWaiting() {
	    $data = DB::table('borrow')->leftJoin('user_id', 'borrow.uid', '=', 'user_id.uid')->where('borrow.status', 10)->where('user_id.status', 0)->get(['borrow.*', 'user_id.type', 'user_id.front', 'user_id.back']);
        return view('back.waiting', compact('data'));
    }

    public function verifiedItem(Request $request) {
	    $id = $request->input('id');
        $uid = $request->input('uid');
        Borrow::where('id', $id)->where('status', 10)->update(array('status'=>0));
        Verified::where('uid', $uid)->update(array('status'=> 1));
        $data = DB::table('borrow')->leftJoin('user_id', 'borrow.uid', '=', 'user_id.uid')->where('borrow.status', 10)->where('user_id.status', 0)->get(['borrow.*', 'user_id.type', 'user_id.front', 'user_id.back']);
        $ok = 'Duyệt khoản vay thành công';
        return view('back.waiting', compact('data', 'ok'));
    }

    public function methodPayment(Request $request) {
        if (Auth::user()) {
            $uid = Auth::user()->id;
            $mothod = $request->input('methodPayment');
            User::where('id', $uid)->update(array('userReceived'=> $mothod));
            return redirect('manager')->with('ok', 'Thông tin đã được cập nhật');
        }
    }

    public function ttest() {

        $result = $this->createFixedAmountTransaction(
            '0.5',
            '0x123f681646d4a755815f9cb19e1acc8565a0c2ac',
            'BTC',
            'ETH',
            '1HLjjjSPzHLNn5GTvDNSGnhBqHEF7nZxNZ'
        );
        var_dump($result);die;
        die('1');
    }
    public function createFixedAmountTransaction (
         $amount,
         $withdrawalAddress,
         $coin1,
         $coin2,
         $returnAddress = null,
         $rsAddress = null,
         $destinationTag = null,
         $apiKey = null
    )
    {
        $input = [
            'withdrawal' => $withdrawalAddress,
            'pair' => strtolower($coin1).'_'.strtolower($coin2),
            'returnAddress' => $returnAddress,
            'destTag' => $destinationTag,
            'rsAddress' => $rsAddress,
            'apiKey' => $apiKey,
            'amount' => $amount,
        ];


        $uri = 'https://shapeshift.io/sendamount';
        $content = json_encode($input);

        $curl = curl_init($uri);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        /*$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 201 ) {
            die("Error: call to URL $uri failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }
        */
        curl_close($curl);
        $response = json_decode($json_response, true);
        echo "<pre>"; var_dump($response);
    }
}

