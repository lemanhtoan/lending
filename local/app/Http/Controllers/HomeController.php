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
use App\Models\Slideshow;
use App\Models\Hash;
use Carbon;

use App\ActivationService;


class HomeController extends Controller
{

    public function __construct(ActivationService $activationService)
    {
        $this->activationService = $activationService;
    }

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
            $uCCL = Auth::user()->cclAddress;
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
            $uCCL = '';

            $borrows = Borrow::where('status', 1)->orderBy('created_at', 'desc')->get();
        }

        $borrowsOfUser = Borrow::where('uid', $uid)->orderBy('created_at', 'desc')->get();
        $investsOfUser = Invest::leftJoin('borrow', 'invest.borrowId','=', 'borrow.id')->where('invest.uid', $uid)->orderBy('invest.created_at', 'desc')->get(
            ['invest.*', 'borrow.soluongthechap', 'borrow.kieuthechap', 'borrow.thoigianthechap', 'borrow.phantramlai', 'borrow.dutinhlai', 'borrow.sotiencanvay', 'borrow.ngaygiaingan', 'borrow.ngaydaohan']
        );

        $khoanggia = \Config::get('constants.khoanggia');
        $blogs = Post::where('active', 1)->orderBy('updated_at', 'desc')->get();
        $slideshows = Slideshow::where('status', 1)->orderBy('position', 'desc')->get();
		return view('front.index', compact('blogs', 'userType', 'uid', 'borrows', 'borrowsOfUser', 'investsOfUser', 'khoanggia', 'slideshows', 'uCCL'));
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
            'emailadmin'=> Settings::where('name', 'emailadmin')->get(['content'])->toArray(),
            'ccl'=> Settings::where('name', 'ccl')->get(['content'])->toArray(),
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
        $slideshows = Slideshow::where('status', 1)->orderBy('position', 'desc')->get();
        return view('front.index', compact('blogs', 'userType', 'uid', 'borrows', 'borrowsOfUser', 'investsOfUser', 'khoanggia', 'slideshows'));
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
            $uCCL = Auth::user()->cclAddress;
        }else {
            $userType = 'NON';
            $uid = 0;
            $uCCL = '';
        }

        $borrowsOfUser = Borrow::where('uid', $uid)->orderBy('created_at', 'desc')->get();

        $investsOfUser = Invest::leftJoin('borrow', 'invest.borrowId','=', 'borrow.id')->where('invest.uid', $uid)->orderBy('invest.created_at', 'desc')->get(
            ['invest.*', 'borrow.soluongthechap', 'borrow.kieuthechap', 'borrow.thoigianthechap', 'borrow.phantramlai', 'borrow.dutinhlai', 'borrow.sotiencanvay', 'borrow.ngaygiaingan', 'borrow.ngaydaohan']
        );

        $blogs = Post::where('active', 1)->orderBy('updated_at', 'desc')->get();

        return view('front.mborrow', compact('blogs', 'userType', 'uid', 'borrowsOfUser', 'investsOfUser', 'uCCL'));
    }

    public function deleteitem(Request $request) {
	    $id = $request->input('id');
        if (Auth::user()) {
            $uid = Auth::user()->id;
            $userType =  Auth::user()->usertype;
            $uCCL = Auth::user()->cclAddress;
        }else {
            $uid = 0;
            $userType = 'NON';
            $uCCL = Auth::user()->cclAddress;
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

            return view('front.mborrow', compact('blogs', 'userType', 'uid', 'borrowsOfUser', 'investsOfUser', 'ok', 'uCCL'));
        } else {
            $error = 'Item not exist';
            $borrowsOfUser = Borrow::where('uid', $uid)->orderBy('created_at', 'desc')->get();

            return view('front.mborrow', compact('blogs', 'userType', 'uid', 'borrowsOfUser', 'investsOfUser', 'error', 'uCCL'));
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

     public function saveAccount(Request $request) {
        if (Auth::user()) {
            $uid = Auth::user()->id;
            $mothod = $request->input('cclAddress');
            User::where('id', $uid)->update(array('cclAddress'=> $mothod));
            return redirect('manager')->with('ok', 'Thông tin đã được cập nhật');
        }
    }

    // test on wez.nz coupon // chưa hoàn thiện: https://github.com/madmis/wexnz-api
    public function tcoupon() {
        $input = [
            'currency' => 'USD',
            'amount' => '0.01',
            'receiver' => 'toanlm91',
            'apiKey' => '7F8VC4WQ-U8QDJ56S-98F5OCHJ-ZB3WSKRM-F8305VGR',
            'apiSecret' => '177ed0df6253ef7784e9325bb549c6df126235cb43d124e8e541c64213a92530'
        ];
        // key: 7F8VC4WQ-U8QDJ56S-98F5OCHJ-ZB3WSKRM-F8305VGR
        // secret: 177ed0df6253ef7784e9325bb549c6df126235cb43d124e8e541c64213a92530
        $uri = 'https://wex.nz/tapi';
        $content = json_encode($input);

        $curl = curl_init($uri);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);
        curl_close($curl);
        var_dump($json_response);
    }

    public function ttest() {
        // chuyển tiền ntnao, vì hiện tại chỉ có address của người nhận https://info.shapeshift.io/
        $result = $this->createFixedAmountTransaction(
            '0.01',
            '14TJLFYhChumj3NDjHqjcDiUeL5A6opKx8',
            'ETH',
            'BTC',
            '0x123f681646d4a755815f9cb19e1acc8565a0c2ac'
        );
        var_dump($result);die;
    }
    public function createFixedAmountTransaction (
         $amount,
         $withdrawalAddress, // sent to admin
         $coin1,
         $coin2,
         $returnAddress = null, // dia chi nhan tien lai neu co loi xay ra
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

    public function cronSet() {
//        lay du db ra nhung hask status = 0, sau do chay check len  https://blockchain.info/rawtx/b6f6991d03df0e2e04dafffcd6bc418aac66049e2cd74b80f14ac86db1e3f0da
//        de tim height, khi nao co height thi tiep tuc lay tu 2  https://blockchain.info/latestblock va thuc hien phep toan .
//
//        neu thoa man thi update status = 1 trong bang hash_confirm va borrow = 1 status
        // check borrow the chap
        $listCheck = Hash::where('status', 0)->get();
        if(count($listCheck)) {
            foreach($listCheck as $ihash) {
                $keyHash = $ihash->hask;
                $baseUrl = 'https://blockchain.info/rawtx/';
                $getInfo = $baseUrl.$keyHash;
                $file = $getInfo;
                $file_headers = @get_headers($file);
                if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found' || $file_headers[0] == 'HTTP/1.1 500 Internal Server Error') {
                    $exists = false;
                }
                else {
                    $exists = true;
                }
                if ($exists) {
                    $jsonInfo = file_get_contents($getInfo);
                    $objInfo = json_decode($jsonInfo);
                    $urlHeight = 'https://blockchain.info/latestblock';
                    $jsonInfoHeight = file_get_contents($urlHeight);
                    $objInfoHeight = json_decode($jsonInfoHeight);
                    if ( ( ($objInfoHeight->height - $objInfo->block_height) + 1) > 2 ) {
                        Hash::where('id', $ihash->id)->update(array('status'=>1));
                        // update status ...
                        Borrow::where('id', $ihash->dataId)->update(array('status'=>1));
                    }
                }
            }
        }

        $data = date('Y-m-d');
        $time = date('h-A');
        \Log::useFiles(base_path() . '/log/'.$data.'/'.$time.'-info.log', 'info');
        \Log::info('Log content here ...');
        // http://localhost/lending/tlog
    }

    public function getBorrowReminder() {
        // reminder 1 - route: treminder1
        $dataReminder = DB::table('settings')->where('name', 'dayredm')->select('content')->get()[0];
        $fromDate = new Carbon('now');
        $toDate = Carbon::now()->addDays($dataReminder->content);

        $data = Borrow::where('status', '<', '20')->whereBetween( 'ngaydaohan', array($fromDate->toDateTimeString(), $toDate->toDateTimeString()) )->orderBy('ngaydaohan', 'asc')->get();
        if (count($data)) {
            foreach ($data as $record) {
                $userObj = User::where('id', $record->uid)->first();
                emailSend($record, $userObj['email'], 'Email Reminder ' .$userObj['username'], 'REMINDER_1');

                // update - neu da send email reminder => cap nhat trang thai cua khoan vay la da reminder lan 1 => status = 20
                Borrow::where('id', $record->id)->update(array('status'=> '20'));
            }
        } else {
            echo 'No data';
        }
    }

    public function getBorrowReminderLost() {
        // reminder 2 - lost : route: treminderlost
        $dataReminder = DB::table('settings')->where('name', 'daylost')->select('content')->get()[0];
        $fromDate = new Carbon('now');


        $data = Borrow::where('status', '=', '20')->where( 'ngaydaohan', '<=', $fromDate->toDateTimeString())->orderBy('ngaydaohan', 'asc')->get();
        if (count($data)) {
            foreach ($data as $record) {
                $toDate = Carbon::parse($record['ngaydaohan'])->addDays($dataReminder->content);
                $dataAdd['dateLost'] = $toDate->toDateTimeString();
                $userObj = User::where('id', $record->uid)->first();

                emailSend($record, $userObj['email'], 'Email Reminder ' .$userObj['username'] .' - '.$toDate->toDateTimeString(), 'REMINDER_LOST', $dataAdd);

                // update - neu da send email reminder => cap nhat trang thai cua khoan vay la da reminder lan 1 => status = 20
                Borrow::where('id', $record->id)->update(array('status'=> '30'));
            }
        } else {
            echo 'No data';
        }
    }

    public function filterBorrow(Request $request) {
	    //dd($request->all());
        if ($request->input('uid')) {
            $userObj = User::where('id', $request->input('uid'))->first();
            $userType =  $userObj['usertype'];
            $uid = $request->input('uid');
        }else {
            $userType = 'NON';
            $uid = 0;
        }

        if (Auth::user()) {
            $uCCL = Auth::user()->cclAddress;
        }else {
            $uCCL = Auth::user()->cclAddress;
        }


        $borrowsOfUser = Borrow::where('uid', $uid)->orderBy('created_at', 'desc')->get();

        if ($request->input('start_time')) {
            $startFilter = $request->input('start_time');
        } else {
            $startFilter = Carbon::now()->subMonths(12)->toDateTimeString();
        }

        if ($request->input('end_time')) {
            $endFilter = $request->input('end_time');
        } else {
            $endFilter = Carbon::now()->addMonths(12)->toDateTimeString();
        }

        $investsOfUser = Invest::leftJoin('borrow', 'invest.borrowId','=', 'borrow.id')->where('invest.uid', $uid)
            ->whereBetween( 'invest.created_at', array($startFilter, $endFilter) )
            ->orderBy('invest.created_at', 'desc')->get(
            ['invest.*', 'borrow.soluongthechap', 'borrow.kieuthechap', 'borrow.thoigianthechap', 'borrow.phantramlai', 'borrow.dutinhlai', 'borrow.sotiencanvay', 'borrow.ngaygiaingan', 'borrow.ngaydaohan']
        );

        $blogs = Post::where('active', 1)->orderBy('updated_at', 'desc')->get();

        return view('front.mborrow', compact('blogs', 'userType', 'uid', 'borrowsOfUser', 'investsOfUser', 'uCCL'));
    }


    public function confirmInvest(Request $request) {
        $id = $request->input('id');
        return view('front.confirm', compact('id'));
    }

    public function postConfirmInvest(Request $request) {
        $id = $request->input('investId');
        $keyHash = $request->input('keyHash');
        $apiKey = 'freekey';
        $baseUrl = 'https://api.ethplorer.io/getTxInfo/';
        $getInfo = $baseUrl.$keyHash.'?apiKey='.$apiKey;

        $file_headers = @get_headers($getInfo);
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found' || $file_headers[0] == 'HTTP/1.1 500 Internal Server Error') {
            $exists = false;
        } else {
            $exists = true;
        }
        if ($exists) {
            $jsonInfo = file_get_contents($getInfo);
            $objInfo = json_decode($jsonInfo);
            if(isset($objInfo->error)) {
                $mess = "TRAN_INVALID";
            } else {
                $borrowsOfUser = Borrow::where('id', $id)->first();
                $userInfo = User::where('id', $borrowsOfUser->uid)->first();
                $isSuccess = false;
                $isTo = false;
                $value = $objInfo->operations[0];
                $valueMoney = $value->value;
                $decimals = $value->tokenInfo->decimals;
                $symbol = $value->tokenInfo->symbol;
                $isToAdd = $value->to;
                if($objInfo->success) {
                    $isSuccess= true;
                }
                if($isToAdd) {
                    if ($userInfo) {
                        if ($userInfo->cclAddress == $isToAdd) {
                            $isTo = true;
                        }
                    }
                }

                $sotien = $borrowsOfUser->sotiencanvay;
                $dataTygia = DB::table('settings')->where('name', 'ccl')->select('content')->get()[0];
                $dataMoney = round($sotien/$dataTygia->content, 8);
                if ( ($valueMoney/(pow(10,$decimals)) ) < $dataMoney) { // > test
                    // thong bao toi nguoi vay hoan tra
                    if ($isSuccess && $isTo) {
                        // email to $userInfo->email
                        $email = $userInfo->email;
                        $dataAdmin = \DB::table('settings')->where('name', 'emailadmin')->select('content')->get()[0];
                        $emailAdmin = $dataAdmin->content;
                        $data = array(
                            'message' => 'You need refund wrong token to username '. $userInfo->username.' with ',
                            'value' => ($valueMoney/(pow(10,$decimals))),
                            'to' => $userInfo->cclAddress
                        );
                        \Mail::send('emails.mailError', ['data' => $data], function($message) use ($data, $email, $emailAdmin) {
                            $message->to($email);
                            $message->cc($emailAdmin);
                            $message->subject("Email refund token wrong");
                        });
                        $mess = "Transaction wrong token value";
                    } else {
                        $mess = "TRAN_INVALID";
                    }
                } else {
                    if ($isSuccess && $isTo) {
                        if (Auth::user()) {
                            $uid = Auth::user()->id;
                        } else {
                            $uid = 0;
                        }
                        // cap nhat trang thai ndt da chuyen tien
                        // thong bao giao dich thanh cong
                        // luu thong tin hash
                        $isCheck = Hash::where('hask', $keyHash)->get();
                        if(count($isCheck) == '0') {
                            $hash = new Hash();
                            $mess = "TRAN_COMPLETED";
                            $hash->uid = $uid;
                            $hash->type = 'borrow';
                            $hash->hask = $keyHash;
                            $hash->dataId = $id;
                            $hash->status = 1;
                            $hash->save();

                            // update status ...
                            Invest::where('borrowId', $id)->update(array('status'=>1));
                        } else {
                            $mess = "TRAN_INVALID_BEFORE";
                        }
                    }
                }
            }
        } else {
            $mess = "TRAN_INVALID";
        }
        return view('front.confirm', compact('id', 'mess'));
    }

    public function confirmBorrow(Request $request) {
        $id = $request->input('id');
        if (Auth::user()) {
            $uCCL = Auth::user()->cclAddress;
        } else {
            $uCCL = '';
        }
        return view('front.confirmborrow', compact('id', 'uCCL'));
    }

    public function postConfirmBorrow(Request $request) {
        $id = $request->input('borrowId');
        $keyHash = $request->input('keyHash');
        $baseUrl = 'https://blockchain.info/rawtx/';
        $getInfo = $baseUrl.$keyHash;
        $file = $getInfo;
        $file_headers = @get_headers($file);
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found' || $file_headers[0] == 'HTTP/1.1 500 Internal Server Error') {
            $exists = false;
        }
        else {
            $exists = true;
        }
        if ($exists) {
            if (Auth::user()) {
                $uid = Auth::user()->id;
            } else {
                $uid = 0;
            }
            $jsonInfo = file_get_contents($getInfo);
            $objInfo = json_decode($jsonInfo);
            if(isset($objInfo->block_height)) {
                // process save db and check unique value => 1: success; 0: confirm
                $isCheck = Hash::where('hask', $keyHash)->get();
                if(count($isCheck) == '0') {
                    $urlHeight = 'https://blockchain.info/latestblock';
                    $jsonInfoHeight = file_get_contents($urlHeight);
                    $objInfoHeight = json_decode($jsonInfoHeight);
                    $hash = new Hash();
                    if ( ( ($objInfoHeight->height - $objInfo->block_height) + 1) > 2 ) {
                        // transaction success
                        $mess = "TRAN_COMPLETED";
                        $hash->uid = $uid;
                        $hash->type = 'borrow';
                        $hash->hask = $keyHash;
                        $hash->dataId = $id;
                        $hash->status = 1;
                        $hash->save();

                        // update status ...
                        Borrow::where('id', $id)->update(array('status'=>1));
                    } else {
                        // transaction confirm => need crontab check and update
                        $mess = "Transaction confirm, process checking completed";
                        $hash->uid = $uid;
                        $hash->type = 'borrow';
                        $hash->hask = $keyHash;
                        $hash->dataId = $id;
                        $hash->status = 0;
                        $hash->save();
                    }
                } else {
                    $mess = "TRAN_INVALID_BEFORE";
                }
            } else {
                $mess = "TRAN_INVALID";
            }
        } else {
            $mess = "TRAN_INVALID";
        }

        return view('front.confirmborrow', compact('id', 'mess'));
    }

    public function confirmUser(Request $request) {
	    $email = $request->input('email');
        $uId = $request->input('uId');
        $usertype = $request->input('usertype');
        $uData = User::where('id', $uId)->where('confirmed', '0')->where('activated', '0')->first();
        if(count($uData) > 0) {
            User::where('id', $uId)->update(array('confirmed'=>1, 'email'=> $email, 'usertype' => $usertype));
            $this->activationService->sendActivationMail($uData);
            return redirect('/')->with('status', 'We sent you an activation code. Check your email.');
        } else {
            $userData = new \stdClass();
            $userData->id = '0';
            $mess='INVALID_DATA';
            return view('front.uconfirm', compact('userData', 'mess'));
        }
    }
}

