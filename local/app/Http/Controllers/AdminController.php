<?php namespace App\Http\Controllers;

use App\Repositories\ContactRepository;
use App\Repositories\UserRepository;
use App\Repositories\BlogRepository;
use App\Repositories\CommentRepository;
use Auth;
use Session;
use DB;
use Carbon;

class AdminController extends Controller {

    protected $user_gestion;

    public function __construct(UserRepository $user_gestion)
    {
		$this->user_gestion = $user_gestion;
    }

	public function admin()
	{
        $nbrMessages = 5;
        $nbrUsers = 8;
        $nbrMind = 3;

        $fromDate1 = new \Carbon('last week');
        $toDate1 = new \Carbon('now');
        $u4 = \DB::table('invest')->whereBetween('created_at', array($fromDate1->toDateTimeString(), $toDate1->toDateTimeString()) )->get();

        $fromDate2 = \Carbon::now()->subDays(14);
        $toDate2 = \Carbon::now()->subDays(7);
        $u3 = \DB::table('invest')->whereBetween('created_at', array($fromDate2->toDateTimeString(), $toDate2->toDateTimeString()) )->get();

        $fromDate3 = \Carbon::now()->subDays(21);
        $toDate3 = \Carbon::now()->subDays(14);
        $u2 = \DB::table('invest')->whereBetween('created_at', array($fromDate3->toDateTimeString(), $toDate3->toDateTimeString()) )->get();

        $fromDate4 = \Carbon::now()->subDays(28);
        $toDate4 = \Carbon::now()->subDays(21);
        $u1 = \DB::table('invest')->whereBetween('created_at', array($fromDate4->toDateTimeString(), $toDate4->toDateTimeString()) )->get();
        $dataUser = array(
            "w1" => count($u1),
            "w2" => count($u2),
            "w3" => count($u3),
            "w4" => count($u4)
        );
        $fromDate1 = new \Carbon('last week');
        $toDate1 = new \Carbon('now');
        $t4 = \DB::table('borrow')->whereBetween('created_at', array($fromDate1->toDateTimeString(), $toDate1->toDateTimeString()) )->get();

        $fromDate2 = \Carbon::now()->subDays(14);
        $toDate2 = \Carbon::now()->subDays(7);
        $t3 = \DB::table('borrow')->whereBetween('created_at', array($fromDate2->toDateTimeString(), $toDate2->toDateTimeString()) )->get();

        $fromDate3 = \Carbon::now()->subDays(21);
        $toDate3 = \Carbon::now()->subDays(14);
        $t2 = \DB::table('borrow')->whereBetween('created_at', array($fromDate3->toDateTimeString(), $toDate3->toDateTimeString()) )->get();

        $fromDate4 = \Carbon::now()->subDays(28);
        $toDate4 = \Carbon::now()->subDays(21);
        $t1 = \DB::table('borrow')->whereBetween('created_at', array($fromDate4->toDateTimeString(), $toDate4->toDateTimeString()) )->get();
        $dataTrans = array(
            "w1" => count($t1),
            "w2" => count($t2),
            "w3" => count($t3),
            "w4" => count($t4)
        );
        return view('back.index', compact('nbrMessages', 'nbrUsers', 'nbrMind', 'nbrDrug', 'dataTrans', 'dataUser'));
	}

    public function getLogoutAdmin()
    {
        Auth::logout();
        Session::flush();
        return redirect('/administrator');
    }
}
