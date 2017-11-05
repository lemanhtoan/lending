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
	function emailSend($data, $email, $subject, $typeEmail) {
		$dataAdmin = \DB::table('settings')->where('name', 'emailadmin')->select('content')->get()[0];
		$emailAdmin = $dataAdmin->content;

		\Mail::send('emails.mailTemp', ['data' => $data, 'typeEmail' => $typeEmail], function($message) use ($data, $email, $emailAdmin, $subject, $typeEmail) {
			$message->to($email);
			if ($typeEmail == 'REMINDER_1') { // check type is send to cc admin
				$message->cc($emailAdmin);
			}
			$message->subject($subject);
		});
	}
}
