<?php

if (!function_exists('classActivePath')) {
	function classActivePath($path)
	{
		return Request::is($path) ? ' class="active"' : '';
	}
}

if (!function_exists('classActiveSegment')) {
	function classActiveSegment($segment, $value)
	{
		if(!is_array($value)) {
			return Request::segment($segment) == $value ? ' class="active"' : '';
		}
		foreach ($value as $v) {
			if(Request::segment($segment) == $v) return ' class="active"';
		}
		return '';
	}
}

if (!function_exists('classActiveOnlyPath')) {
	function classActiveOnlyPath($path)
	{
		return Request::is($path) ? ' active' : '';
	}
}

if (!function_exists('classActiveOnlySegment')) {
	function classActiveOnlySegment($segment, $value)
	{
		if(!is_array($value)) {
			return Request::segment($segment) == $value ? ' active' : '';
		}
		foreach ($value as $v) {
			if(Request::segment($segment) == $v) return ' active';
		}
		return '';
	}
}


if (!function_exists('emailSend')) {
	function emailSend($data, $email, $subject, $typeEmail, $dataAdd = null) {
		$dataAdmin = \DB::table('settings')->where('name', 'emailadmin')->select('content')->get()[0];
		$emailAdmin = $dataAdmin->content;

		\Mail::send('emails.mailTemp', ['data' => $data, 'typeEmail' => $typeEmail,  'dataAdd' => $dataAdd], function($message) use ($data, $email, $emailAdmin, $subject, $typeEmail) {
			$message->to($email);
			if ($typeEmail == 'REMINDER_1' || $typeEmail == 'BORROW_INVEST_DONE' || $typeEmail == 'REMINDER_LOST') { // check type is send to cc admin
				$message->cc($emailAdmin);
			}
			$message->subject($subject);
		});
	}
}

if (!function_exists('tgetMessage')) {
    function tgetMessage($uid) {
        return \DB::table('message')->where('uid', $uid)->where('status', 0)->get();// status = 0
    }
}

if (!function_exists('convertCoint')) {
    function convertCoint($moneyType, $value) {
        switch ($moneyType) {
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
        $dataTygia = \DB::table('settings')->where('name', 'tygiaUV')->select('content')->get()[0];

        $dataP = \DB::table('settings')->where('name', 'crate')->select('content')->get()[0];
        $tygia = isset($dataTygia) ? $dataTygia->content : 1;
        $vayCoint = ($value* 100)/($dataPriceGet * $dataP->content * $tygia);
        return round($vayCoint, 8);
    }
}

