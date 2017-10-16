<?php

namespace App\Http\Controllers;

use App\Jobs\ChangeLocale;

use App\Settings;
use Illuminate\Http\Request;
use Auth;

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

