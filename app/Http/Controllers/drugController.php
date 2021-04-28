<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class drugController extends Controller
{
	public function get_drug_by_field ($field,$value) {
		$candy_drug = new candy_drug;
		$r_medic = new recurrent_medic;
		$medic_id = $r_medic->get_medic('tx_medic_slug',$_COOKIE['coo_logmedic']);

		$rs_drug = $candy_drug
		->where('drug_ai_medic_id',$medic_id)->where($field,$value)
		->orWhere('drug_ai_medic_id',0)->where($field,$value)
		->firstorfail();
    return $rs_drug;
	}
	public function compare_medicine ($raw_prescription) {
		$candy_drug = new candy_drug;
		$rs_drug = $candy_drug->select('ai_drug_id','tx_drug_generic')->get();
		$raw_drug = array();
		foreach ($rs_drug as $key => $drug) {
			$raw_drug[$drug['ai_drug_id']] = $drug['tx_drug_generic'];
		}
		$raw_selected = $raw_prescription['drug_selected'];
		$drug_selected = array();
		foreach ($raw_selected as $key => $drug_id) {
			$pos = strpos($raw_prescription['recipe'],$raw_drug[$drug_id]);
			if ($pos > -1) {
				$drug_selected[] = $drug_id;
// set Undeletable
				$candy_drug->where('ai_drug_id', $drug_id)->update(['tx_drug_deletable' => 0]);
			}
		}
		return $drug_selected;
	}
}
