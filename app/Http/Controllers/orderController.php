<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\candy_order;

class orderController extends Controller
{
	public function get_order_list ($order_type) {
		$candy_order = new candy_order;
		$medic_controller = new medicController;
		$medic_id = $medic_controller->get_medic_id();
		$rs_order = $candy_order->select('ai_order_id','tx_order_value')
		->where('order_ai_medic_id','=',$medic_id)
		->where('tx_order_type','=',$order_type)
		->orWhere('order_ai_medic_id',0)
		->where('tx_order_type','=',$order_type)
		->get();
		$raw_order = array();
		foreach ($rs_order as $key => $order) {
			$raw_order[$order['ai_order_id']] = $order['tx_order_value'];
		}
		return $raw_order;
	}
}
