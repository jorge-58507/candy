<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
	public function unset_coo_logmedic(){
    setcookie("coo_medic","",-86400);
    }
	public function check_coo_logmedic(){
		$ans = (empty($_COOKIE['coo_medic'])) ? false : true;
		return $ans;
	}
	public function set_coo_logmedic($medic_slug){
		setcookie("coo_medic", Hash::make(time())."jjsrmp".$medic_slug."222".time(),time()+86400);
	}
	public function get_coo_logmedic(){
		$cookie = $_COOKIE['coo_medic'];
		$exploded = explode("jjsrmp",$cookie);
		$coo_medic = explode("222",$exploded[1]);
		return $coo_medic;
	}
}
