<?php

namespace App\Http\Controllers;

use App\Jobs\ChangeLocale;

use App\Settings;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Borrow;
use App\Models\Invest;

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

        $borrowsOfUser = Borrow::where('status', 1)->where('uid', $uid)->orderBy('created_at', 'desc')->get();
        $investsOfUser = Invest::leftJoin('borrow', 'invest.borrowId','=', 'borrow.id')->where('invest.uid', $uid)->orderBy('invest.created_at', 'desc')->get(
            ['invest.*', 'borrow.soluongthechap', 'borrow.kieuthechap', 'borrow.thoigianthechap', 'borrow.phantramlai', 'borrow.dutinhlai', 'borrow.sotiencanvay', 'borrow.ngaygiaingan', 'borrow.ngaydaohan']
        );

        $khoanggia = \Config::get('constants.khoanggia');

		return view('front.index', compact('userType', 'uid', 'borrows', 'borrowsOfUser', 'investsOfUser', 'khoanggia'));
	}

	public function coinmarketcap(Request $request) {
	    $sothechap = $request->input('sothechap');
        $methodPay = $request->input('methodPay');
        $dataPriceGet = 1.55; // get from website later
        $dataTygia = DB::table('settings')->where('name', 'tygiaUV')->select('content')->get()[0];
        $tygia = isset($dataTygia) ? $dataTygia->content : 1;
        $maxValue = ($sothechap * $dataPriceGet * 70 * $tygia)/ 100;
        return \Response::json($maxValue);
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
            'footer'=> Settings::where('name', 'footer')->get(['content'])->toArray()
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

        return view('front.index', compact('userType', 'uid', 'borrows', 'borrowsOfUser', 'investsOfUser', 'khoanggia'));
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
        return view('front.newloan', compact('userType', 'uid', 'borrows', 'borrowsOfUser', 'investsOfUser', 'khoanggia'));
    }
}

