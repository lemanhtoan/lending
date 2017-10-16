<?php

namespace App\Http\Controllers;

use App\Jobs\ChangeLocale;

use App\Settings;
use Illuminate\Http\Request;
use Auth;
use DB;

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
        }else {
            $userType = 'NON';
        }
		return view('front.index', compact('userType'));
	}

	public function coinmarketcap(Request $request) {
	    $sothechap = $request->input('sothechap');
        $methodPay = $request->input('methodPay');
        $dataPriceGet = 1.55; // get from website later
        $dataTygia = DB::table('settings')->where('name', 'tygiaUV')->select('content')->get()[0];
        $tygia = isset($dataTygia) ? $dataTygia->content : 1;
        $maxValue = number_format(($sothechap * $dataPriceGet * 70 * $tygia)/ 100, 2);
        return \Response::json($maxValue);
    }

    public function borrowcalc(Request $request) {
        $sothechap = $request->input('sothechap');
        $methodPay = $request->input('methodPay');
        $cost = $request->input('cost');
        $month = $request->input('month');
        $dataLaisuat = DB::table('settings')->where('name', 'laisuat')->select('content')->get()[0];
        $laisuat = isset($dataLaisuat) ? $dataLaisuat->content : 1;
        $laithang = number_format(($cost * $laisuat)/ 100, 2);
        $tong = number_format( ( (($cost * $laisuat)/ 100) * $month) +  $cost, 2);
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

}

