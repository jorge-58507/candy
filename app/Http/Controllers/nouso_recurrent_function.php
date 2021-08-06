<?php
namespace App\Http\Controllers;

use App\candy_medic;
use App\candy_patient;
use App\candy_reason;
use App\candy_antecedent;
use App\candy_diagnostic;
use App\candy_statistic;
use App\candy_date;
use App\candy_order;
use App\candy_history;
use App\candy_drug;

use Illuminate\Support\Facades\Hash;

//    ###########      USUARIOS

class recurrent_function{
	public function replace_special_character($str){
		$to_replace = array("&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;","&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&nolger;","&squote;","&deg;","°","&ntilde;","&laremun;","&dblquote;");
		$replacement = array("Á","É","Í","Ó","Ú","Ñ","á","é","í","ó","ú","\n","'","°","º","ñ","#","\"");
		foreach($to_replace as $key => $val){
			$str= str_replace($val,$replacement[$key],$str);
		}
		return $str;
	}
	public function replace_regular_character($str){
		$to_replace = array("Á","É","Í","Ó","Ú","Ñ","á","é","í","ó","ú","\n","'","º","°","ñ","#","\"");
		$replacement = array("&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;","&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&nolger;","&squote;","°","&deg;","&ntilde;","&laremun;","&dblquote;");
		foreach($to_replace as $key => $val){
			$str= str_replace($val,$replacement[$key],$str);
		}
		return $str;
	}
	public function url_replace_special_character($str){
		$to_replace = array("ampersand;","Aacute;","Eacute;","Iacute;","Oacute;","Uacute;","Ntilde;","aacute;","eacute;","iacute;","oacute;","uacute;","laremun;","nolger;","squote;","deg;","°","ntilde;","dblquote;");
		$replacement = array("&","Á","É","Í","Ó","Ú","Ñ","á","é","í","ó","ú","#","\n","'","°","º","ñ","\"");
		foreach($to_replace as $key => $val){
			$str= str_replace($val,$replacement[$key],$str);
		}
		return $str;
	}
	public function url_replace_regular_character($str){
		$to_replace = array("&","Á","É","Í","Ó","Ú","Ñ","á","é","í","ó","ú","#","\n","'","º","°","ñ","\"");
		$replacement = array("ampersand;","Aacute;","Eacute;","Iacute;","Oacute;","Uacute;","Ntilde;","aacute;","eacute;","iacute;","oacute;","uacute;","laremun;","nolger;","squote;","°","deg;","ntilde;","dblquote;");
		foreach($to_replace as $key => $val){
			$str= str_replace($val,$replacement[$key],$str);
		}
		return $str;
	}
	public function replace_textarea_pagebreak ($str) {
		$value = str_replace("\n","<br/>",$str);
		return $value;
	}
}

// class recurrent_user
// {
	// public static function unset_session(){
  //   session_start();
	// 	unset($_SESSION['session_iuser']);
	// 	unset($_SESSION['session_tuser']);
	// }
  // public static function unset_coo_logmedic(){
  //   setcookie("coo_medic","",-86400);
  // }
	// public static function check_coo_logmedic(){
	// 	$ans = (empty($_COOKIE['coo_medic'])) ? false : true;
	// 	return $ans;
	// }
	// public static function set_coo_logmedic($medic_slug){
	// 	setcookie("coo_medic", Hash::make(time())."jjsrmp".$medic_slug."222".time(),time()+86400);
	// }
	// public static function get_coo_logmedic(){
	// 	$cookie = $_COOKIE['coo_medic'];
	// 	$exploded = explode("jjsrmp",$cookie);
	// 	$coo_medic = explode("222",$exploded[1]);
	// 	return $coo_medic;
	// }
// }

//    ###########      MEDICOS
// class recurrent_medic
// {
	// public static function get_medic ($field,$medic_record) {
	// 	$medic = new candy_medic;
	// 	$qry_medic = $medic
	// 	->WHERE($field,"=",$medic_record)
	// 	->SELECT('candy_medics.ai_medic_id');
	// 	$rs_medic = $qry_medic->first();
	// 	return $rs_medic['ai_medic_id'];
	// }
	// public static function get_medic_logged () {
	// 	$r_medic = new recurrent_medic;
	// 	$coo_medic = recurrent_user::get_coo_logmedic();
	// 	$medic_id = $r_medic->get_medic('tx_medic_slug',$coo_medic);
	// 	$medic = new candy_medic;
	// 	$qry_medic = $medic
	// 	->WHERE('ai_medic_id',"=",$medic_id);
	// 	$rs_medic = $qry_medic->firstOrFail();
	// 	return $rs_medic;
	// }
// }

//    ###########      PACIENTES
// class recurrent_patient
// {
	// public function cal_num_history ($coo_medic) {
	// 	$candy_medic = new candy_medic;
	// 	$candy_patient = new candy_patient;
	// 	$rs_medic = $candy_medic
	// 	->where('tx_medic_slug', "=", $coo_medic)
	// 	->select('candy_medics.tx_medic_option')->get();
	// 	$medic_option = json_decode($rs_medic[0]['tx_medic_option'],true);

	// 	// $medic_id = recurrent_medic::get_medic('tx_medic_slug',$coo_medic);
	// 	$medic_id = $rs_medic[0]['ai_medic_id'];
	// 	if (!empty($medic_option['history_prefix'])) {
	// 		$qry_nexth = $candy_patient
	// 		->JOIN('candy_rel_medic_patients', 'candy_rel_medic_patients.medic_patient_ai_patient_id', '=', 'candy_patients.AI_patient_id')
	// 		->WHERE('candy_rel_medic_patients.medic_patient_ai_medic_id', "=", $medic_id)
	// 		->WHERE('candy_patients.tx_patient_history', "LIKE", '%'.$medic_option['history_prefix'].'%')
	// 		->SELECT('candy_patients.tx_patient_history', 'candy_patients.AI_patient_id');
	// 		$next_h = $medic_option['history_prefix'].($qry_nexth->count()+1);
	// 	}else{
	// 		$qry_nexth = $candy_patient
	// 			->JOIN('candy_rel_medic_patients', 'candy_rel_medic_patients.medic_patient_ai_patient_id', '=', 'candy_patients.AI_patient_id')
	// 			->WHERE('candy_rel_medic_patients.medic_patient_ai_medic_id', "=", $medic_id)
	// 			->ORDERBY('AI_patient_id','DESC')
	// 			->LIMIT('1')
	// 			->SELECT('candy_patients.tx_patient_history', 'candy_patients.AI_patient_id');
	// 			$next_h=-1;
	// 			if ($qry_nexth->count() > 0) {
	// 				$rs_nexth = $qry_nexth->get();
	// 				$next_h = $rs_nexth[0]['tx_patient_history'];
	// 			}
	// 			$next_h += 1;
	// 			$next_h = str_split('00000000'.$next_h,-15);
	// 		}
	// 		return $next_h;
	// }
	// public static function get_patient_list () {
	// 	$model_patient = new candy_patient;
	// 	$coo_medic = recurrent_user::get_coo_logmedic();
	// 	$medic_id = recurrent_medic::get_medic('tx_medic_slug',$coo_medic);
	// 	$qry_patient_list = $model_patient
	// 		->JOIN('candy_rel_medic_patients', 'candy_rel_medic_patients.medic_patient_ai_patient_id', '=', 'candy_patients.AI_patient_id')
	// 		->WHERE('candy_rel_medic_patients.medic_patient_ai_medic_id', "=", $medic_id)
	// 		->ORDERBY('tx_patient_name','ASC')
	// 		->SELECT('candy_patients.tx_patient_name', 'candy_patients.tx_patient_history', 'candy_patients.tx_patient_avatar');
	// 	$rs_patient_list = $qry_patient_list->get();
	// 	$raw_patient=array();
	// 	foreach ($rs_patient_list as $key => $patient_name) {
	// 		$raw_patient[$patient_name['tx_patient_name']."--".$patient_name['tx_patient_history']] = '../image/avatar/'.$patient_name['tx_patient_avatar'];
	// 	}
	// 	$pat = (object)$raw_patient;
	// 	return $pat;
	// }
	// public static function get_patient ($field,$patient_record) {
	// 	$patient = new candy_patient;
	// 	$rs_patient = $patient->WHERE($field,"=",$patient_record)->first();
	// 	return $rs_patient;
	// }
	// public function verify_patient ($request,$patient,$field) {
	// 	$answer = '';
	// 	switch ($field) {
	// 		case 'tx_patient_identification':
	// 			$qry_patient_id = $patient   // VERIFICAR QUE NO EXISTA LA CEDULA
	// 			->WHERE($field,"=",$request->input('b'))
	// 			->SELECT('candy_patients.AI_patient_id');
	// 			if ($qry_patient_id->count() > 0) {
	// 				return 'failed';
	// 			}
	// 			break;
	// 		case 'tx_patient_history':
	// 			$r_medic = new recurrent_medic;
	// 			$medic_id = $r_medic->get_medic('tx_medic_slug',$_COOKIE['coo_logmedic']);
	// 			$qry_patient_id = $patient   // VERIFICAR QUE NO EXISTA LA HISTORIA
	// 			->JOIN('candy_rel_medic_patients', 'candy_rel_medic_patients.medic_patient_ai_patient_id', '=', 'candy_patients.AI_patient_id')
	// 			->JOIN('candy_medics', 'candy_rel_medic_patients.medic_patient_ai_medic_id', '=', 'candy_medics.ai_medic_id')
	// 			->WHERE('candy_rel_medic_patients.medic_patient_ai_medic_id', "=", $medic_id)
	// 			->WHERE($field,"=",$request->input('e'))
	// 			->SELECT('candy_patients.AI_patient_id');
	// 			if ($qry_patient_id->count() > 0) {
	// 				return 'failed';
	// 			}
	// 			break;
	// 	}
	// }
	// public function calculate_age ($birthday) {
	// 	list($Y,$m,$d) = explode("-",$birthday);
	// 	return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	// }

// }

// reason
// class recurrent_reason
// {
	// public static function get_reason_list () {
	// 	$r_medic = new recurrent_medic;
	// 	$coo_medic = recurrent_user::get_coo_logmedic();
	// 	$medic_id = $r_medic->get_medic('tx_medic_slug',$coo_medic);

	// 	$candy_reason = new candy_reason;
	// 	$qry_reason = $candy_reason
	// 	->WHERE('reason_ai_medic_id',"=",0)
	// 	->orWhere('reason_ai_medic_id',"=",$medic_id)
	// 	->SELECT('candy_reasons.tx_reason_value');
	// 	$rs_reason = $qry_reason->get();
	// 	$raw_reason=array();
	// 	foreach ($rs_reason as $key => $reason_value) {
	// 		$raw_reason[$reason_value['tx_reason_value']] = null;
	// 	}
	// 	$reason_list = (object)$raw_reason;
	// 	return $reason_list;
	// }
// }
// class recurrent_date
// {
	// public static function get_dates_by_date ($date) {
	// 	$r_medic = new recurrent_medic;
	// 	$coo_medic = recurrent_user::get_coo_logmedic();
	// 	$medic_id = $r_medic->get_medic('tx_medic_slug',$coo_medic);

	// 	$candy_date = new candy_date;
	// 	$qry_date = $candy_date
	// 	->join('candy_patients','candy_patients.AI_patient_id','=','candy_dates.date_ai_patient_id')
	// 	->join('candy_reasons','candy_reasons.ai_reason_id','=','candy_dates.date_ai_reason_id')
	// 	->Where('tx_date_date','=',$date)
	// 	->Where('date_ai_medic_id','=',$medic_id)
	// 	->ORDERBY('tx_date_time','ASC')
	// 	->select('candy_patients.tx_patient_name','candy_dates.tx_date_slug','candy_dates.tx_date_time','candy_reasons.tx_reason_value','candy_dates.tx_date_status');
	// 	$rs_date = $qry_date->get();
	// 	$raw_date = array();
	// 	foreach ($rs_date as $key => $date) {
	// 		$rs_date[$key]['tx_date_time'] = date('h:i:s A',strtotime($date['tx_date_time']));
	// 	}
	// 	return $rs_date;
	// }
	// public static function unset_coo_dateopened(){
	// 		unset($_SESSION['opendate_session']);
	// }
	// public static function check_coo_dateopened(){
	// 	$ans = (empty($_SESSION['opendate_session'])) ? false : true;
	// 	return $ans;
  // }
	// public static function get_dateopened(){
	// 	$candy_date = new candy_date;
	// 	$dateopened = $_SESSION['opendate_session'];
	// 	$qry_date = $candy_date
	// 	->JOIN('candy_reasons','ai_reason_id','=','date_ai_reason_id')
	// 	->where('tx_date_slug',$dateopened)
	// 	->SELECT('candy_dates.date_ai_patient_id','candy_dates.ai_date_id','candy_dates.tx_date_date','candy_dates.tx_date_time','candy_dates.date_ai_reason_id','candy_reasons.tx_reason_value','candy_dates.tx_date_slug');
	// 	$rs_date = $qry_date->get();
	// 	return $rs_date;
  // }
// }

// class recurrent_history
// {
// 	function __construct() {
// 		$this->array_fields = ['laboratory' => ['Hemoglobina: '=>'hemoglobin','Hematocrito: '=>'hematocrit','Plaquetas: '=>'platelet','Gl&oacute;bulos Rojos: '=>'redbloodcell','Urea: '=>'urea','Creatinina: '=>'creatinine','Gl&oacute;bulos Blancos: '=>'whitebloodcell','Linfocitos: '=>'lymphocytes','Neutr&oacute;filos: '=>'neutrophils','Monocitos: '=>'monocytes','Bas&oacute;filos: '=>'basophils','Eosin&oacute;filos: '=>'eosinophils',''=>'result']];
//   }
// 	public static function compare_reason ($raw_history,$date_id) {
// 		$candy_reason = new candy_reason;
// 		$rs_reason = $candy_reason->select('ai_reason_id','tx_reason_value')->get();
// 		$raw_reason = array();
// 		foreach ($rs_reason as $key => $reason) {
// 			$raw_reason[$reason['ai_reason_id']] = $reason['tx_reason_value'];
// 		}
// 		$reason_selected = array();
// 		foreach ($raw_history[$date_id]['history']['reason']['selected'] as $key => $reason_id) {
// 				$pos = strpos($raw_history[$date_id]['history']['reason']['content'],$raw_reason[$reason_id]);
// 				if ($pos > -1) { 
// 						$reason_selected[] = $reason_id;
// 				}
// 		}
// 		return $reason_selected;
// 	}
// 	public static function compare_antecedent ($raw_history,$date_id) {
// 		$candy_antecedent = new candy_antecedent;
// 		$rs_antecedent = $candy_antecedent->select('ai_antecedent_id','tx_antecedent_value')->get();
// 		$raw_antecedent = array();
// 		foreach ($rs_antecedent as $key => $antecedent) {
//             $raw_antecedent[$antecedent['ai_antecedent_id']] = $antecedent['tx_antecedent_value'];
//         }
//         $antecedent_selected = array();
//         foreach ($raw_history[$date_id]['history']['antecedent']['selected'] as $key => $antecedent_id) {
//             $pos = strpos($raw_history[$date_id]['history']['antecedent']['content'],$raw_antecedent[$antecedent_id]);			
// 			if ($pos > -1) { 
// 				$antecedent_selected[] = $antecedent_id;
//             }
// 		}
// 		return $antecedent_selected;
// 	}
// 	public static function compare_diagnostic ($raw_history,$date_id) {
// 		$candy_diagnostic = new candy_diagnostic;
// 		$rs_diagnostic = $candy_diagnostic->select('ai_diagnostic_id','tx_diagnostic_value')->get();
// 		$raw_diagnostic = array();
// 		foreach ($rs_diagnostic as $key => $diagnostic) {
// 			$raw_diagnostic[$diagnostic['ai_diagnostic_id']] = $diagnostic['tx_diagnostic_value'];
// 		}
// 		$diagnostic_selected = array();
// 		foreach ($raw_history[$date_id]['history']['diagnostic']['selected'] as $key => $diagnostic_id) {
// 			$pos = strpos($raw_history[$date_id]['history']['diagnostic']['content'],$raw_diagnostic[$diagnostic_id]);
// 			if ($pos > -1) { 
// 					$diagnostic_selected[] = $diagnostic_id;
// 			}
// 		}
// 		return $diagnostic_selected;
// 	}
// 	public static function get_history_by_date ($date_id) {
// 		$candy_history = new candy_history;
// 		$rs_history = $candy_history->where('history_ai_date_id','=',$date_id)->firstorfail();
// 		return $rs_history;
// 	}
// 	public static function get_history_by_dateslug ($date_slug) {
// 		$candy_history = new candy_history;
// 		$rs_history = $candy_history
// 		->select('candy_histories.ai_history_id','candy_histories.tx_history_value','candy_histories.tx_history_date','candy_histories.tx_history_document')
// 		->join('candy_dates','candy_dates.ai_date_id','=','candy_histories.history_ai_date_id')
// 		->where('candy_dates.tx_date_slug','=',$date_slug)->get();
// 		return $rs_history;
// 	}
// 	public static function get_history_by_patient ($patient_id,$medic_id) {
// 		$candy_history = new candy_history;
// 		$rs_history_by_patient = $candy_history->select('candy_histories.ai_history_id', 'candy_histories.tx_history_date', 'candy_histories.tx_history_value','candy_histories.history_ai_date_id')
// 			->join('candy_dates','candy_dates.ai_date_id','=','candy_histories.history_ai_date_id')
// 			->where('candy_dates.date_ai_patient_id',$patient_id)
// 			->where('candy_dates.date_ai_medic_id',$medic_id)->get();
// 		return $rs_history_by_patient;
// 	}
// 	public function generate_laboratory_content ($obj_laboratory) {
// 		$content = '';
// 		$array_fields = $this->array_fields;
// 		foreach ($array_fields['laboratory'] as $spanish => $key_obj) {
// 			$css_classes = ($obj_laboratory[$key_obj][1] === true) ? 'red-text tex-darken-1 font_bolder' : '';
// 			$content .= '<span class="'.$css_classes.'">'.$spanish.str_replace("\n","</br>",$obj_laboratory[$key_obj][0]).'</span>'.'</br>';
// 		}
// 		return $content;
// 	}
// 	public function get_laboratory_cards () {
// 		$r_date = new recurrent_date;
// 		$rs_dateopened = $r_date->get_dateopened();
// 		$r_medic = new recurrent_medic;
// 		$medic_id = $r_medic->get_medic('tx_medic_slug',$_COOKIE['coo_logmedic']);
// 		$rs_history_by_patient = $this->get_history_by_patient($rs_dateopened[0]['date_ai_patient_id'],$medic_id);
// 		$raw_lab = array();
// 		foreach ($rs_history_by_patient as $key => $obj_record) {
// 			$history_decode = json_decode($obj_record['tx_history_value'], true);
// 			$laboratory =  $history_decode[$obj_record['history_ai_date_id']]['laboratory'];
// 			$alarm = 0; $empty = 1;
// 			foreach ($laboratory as $index => $fe_laboratory) {
// 					if ($fe_laboratory[1] == true) { $alarm = 1;  }
// 					if (!empty($fe_laboratory[0])) { $empty = 0;  }
// 			}
// 			if ($empty === 0) {
// 					$raw_lab[$key]['date'] = date('d-m-Y',strtotime($obj_record['tx_history_date']));
// 					$raw_lab[$key]['content'] = $this->generate_laboratory_content($laboratory);
// 					$raw_lab[$key]['alarm'] = $alarm;
// 			}
// 		}
// 		return $raw_lab;
// 	}
// }



// class recurrent_order
// {
	// public static function get_order_list ($order_type) {
	// 	$candy_order = new candy_order;
	// 	$r_medic = new recurrent_medic;
	// 	$medic_id = $r_medic->get_medic('tx_medic_slug',$_COOKIE['coo_logmedic']);
	// 	$rs_order = $candy_order->select('ai_order_id','tx_order_value')
	// 	->where('order_ai_medic_id','=',$medic_id)->where('tx_order_type','=',$order_type)
	// 	->orWhere('order_ai_medic_id',0)->where('tx_order_type','=',$order_type)
	// 	->get();
	// 	$raw_order = array();
	// 	foreach ($rs_order as $key => $order) {
	// 		$raw_order[$order['ai_order_id']] = $order['tx_order_value'];
	// 	}
	// 	return $raw_order;
	// }
// }
// class recurrent_drug
// {
// 	public static function get_drug_by_field ($field,$value) {
// 		$candy_drug = new candy_drug;
// 		$r_medic = new recurrent_medic;
// 		$medic_id = $r_medic->get_medic('tx_medic_slug',$_COOKIE['coo_logmedic']);

// 		$rs_drug = $candy_drug
// 		->where('drug_ai_medic_id',$medic_id)->where($field,$value)
// 		->orWhere('drug_ai_medic_id',0)->where($field,$value)
// 		->firstorfail();
//     return $rs_drug;
// 	}
// 	public static function compare_medicine ($raw_prescription) {
// 		$candy_drug = new candy_drug;
// 		$rs_drug = $candy_drug->select('ai_drug_id','tx_drug_generic')->get();
// 		$raw_drug = array();
// 		foreach ($rs_drug as $key => $drug) {
// 			$raw_drug[$drug['ai_drug_id']] = $drug['tx_drug_generic'];
// 		}
// 		$raw_selected = $raw_prescription['drug_selected'];
// 		$drug_selected = array();
// 		foreach ($raw_selected as $key => $drug_id) {
// 			$pos = strpos($raw_prescription['recipe'],$raw_drug[$drug_id]);
// 			if ($pos > -1) {
// 				$drug_selected[] = $drug_id;
// // set Undeletable
// 				$candy_drug->where('ai_drug_id', $drug_id)->update(['tx_drug_deletable' => 0]);
// 			}
// 		}
// 		return $drug_selected;
// 	}

// }

?>
