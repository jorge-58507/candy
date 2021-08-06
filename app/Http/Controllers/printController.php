<?php

// namespace Candy\Http\Controllers;

// use Illuminate\Http\Request;
// use PDF;

// include 'recurrent_function.php';

// class printController extends Controller
// {
	
// }


// <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class printController extends Controller
{
    
    function full_page ($raw_page){
		$r_medic = new medicController;
		$rs_medic = $r_medic->get_medic_logged();
		$medic_print = $rs_medic['tx_medic_print'];
		$raw_print = json_decode($medic_print, true);
		$medic_option = $rs_medic['tx_medic_option'];
		$raw_option = json_decode($medic_option, true);
		// ver cual perfil esta seleccionado, almacenar esa informacion en tx_medic_option
		$profile_selected = $raw_print[$raw_option['print_profile']];
        $profile_selected = $profile_selected['complete_page'];
		$dr = ($rs_medic['tx_medic_gender'] === "femenina") ? 'Dra.' : 'Dr.';
		$sign_line = ($profile_selected['sign_line'] === "1") ? '<span>______________________________</span><br /><span>'.$dr.' '.$rs_medic['tx_medic_pseudonym'].'</span><br /><span>'.$profile_selected['speciality'].'</span><br />' : '';
		$print_title = ($profile_selected['print_title'] === 'localization') ? $profile_selected['localization'] : $dr.' '.$rs_medic['tx_medic_pseudonym'];
		$output = '
		<link type="text/css" rel="stylesheet" href="./css/print.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="./css/material_icons.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="./css/materialize.min.css"  media="screen,projection"/>
		<style>
			@page { margin: 170px 25px 100px 25px;}
			.print_header { position: fixed; top: -130px; left: 0px; right: 0px; height: 50px; }
			.print_bottom { position: fixed; bottom: 0px; left: 0px; right: 0px; height: 50px; }
		</style>
		<div class="print_header">
			<div class="center-align col_25" style="height: 100px; float: left;">
				<img width="115px" height="115px" src="./image/logo/'.$profile_selected['medic_logo'].'">
			</div>
			<div class="center-align col_50 h_100" style="float: left;">
				<div class="header_title sanson_title">'.$print_title.'</div>
				<div><font style="font-size:8px">'.$profile_selected['line1'].'</font></div>
				<div><font style="font-size:8px">'.$profile_selected['line2'].'</font></div>
				<div><font style="font-size:8px">'.$profile_selected['line3'].'</font></div>
			</div>
			<div class="center-align col_25" style="height: 100px; float: left; text-align: right;">'.date('d-m-Y',strtotime($raw_page['date'])).'</div>
		</div>
		<div class="print_bottom center-align ">
			'.$sign_line.'<br/>
			<div class=" center-align bs_2 radius_10 ">
				<span>'.$profile_selected['bottomline1'].'</span>
				<br />
				<span>'.$profile_selected['bottomline2'].'</span>
			</div>
		</div>
		<div class="print_page" style="">
			<div class="top_content">
				<div class="col_100 center-align h_30" >
					<span class="content_title sanson_title fs_20">
						'.$raw_page['title'].'
					</span>
				</div>
				<div class="bs_2 radius_10 h_80">
					<div class="flex_horizontal col_100 h_30 px_10" >
						<div class="col_40" style="float: left;"><span class="font_bolder">Nombre:   </span>'.$raw_page['patient_name'].'</div>
						<div class="col_25" style="float: left;"><span class="font_bolder">RUC:      </span>'.$raw_page['patient_cip'].'</div>
						<div class="col_35" style="float: left;"><span class="font_bolder">Telefono: </span>'.$raw_page['patient_tlf'].'</div>
					</div>
					<div class="flex_horizontal col_100 h_30 px_10">
						<div class="col_100 truncate" style="float: left;">
							<span class="font_bolder">Direcci&oacute;n: </span>
							'.$raw_page['patient_direction'].'
						</div>
					</div>
				</div>
			</div>
			<div class="middle_content px_10">'.$raw_page['content'].'</div>
		</div>        ';
		return $output;
	}
	// function vertical_halfpage ($raw_page) {
	// 	$r_medic = new recurrent_medic;
	// 	$rs_medic = $r_medic->get_medic_logged();
	// 	$medic_print = $rs_medic['tx_medic_print'];
	// 	$raw_print = json_decode($medic_print, true);
	// 	$medic_option = $rs_medic['tx_medic_option'];
	// 	$raw_option = json_decode($medic_option, true);
	// 	// ver cual perfil esta seleccionado, almacenar esa informacion en tx_medic_option
	// 	$profile_selected = $raw_print[$raw_option['print_profile']];
	// 	$dr = ($rs_medic['tx_medic_gender'] === "femenina") ? 'Dra.' : 'Dr.';
	// 	$sign_line = ($profile_selected['sign_line'] === "1") ? '<span>______________________________</span><br /><span>'.$dr.' '.$rs_medic['tx_medic_pseudonym'].'</span><br /><span>'.$profile_selected['speciality'].'</span><br />' : '';
	// 	$print_title = ($profile_selected['print_title'] === 'localization') ? $profile_selected['localization'] : $dr.' '.$rs_medic['tx_medic_pseudonym'];


	// 	$output = '
	// 	<link type="text/css" rel="stylesheet" href="./css/print.css"  media="screen,projection"/>
	// 	<link type="text/css" rel="stylesheet" href="./css/material_icons.css"  media="screen,projection"/>
	// 	<link type="text/css" rel="stylesheet" href="./css/materialize.min.css"  media="screen,projection"/>
	// 	<style>
	// 		@page { margin: 170px 25px 100px 25px; size: 20cm 14.75cm;}
	// 		.print_header { position: fixed; top: -130px; left: 0px; right: 0px;}
	// 		.print_bottom { position: fixed; bottom: 40px; left: 0px; right: 0px;}
	// 	</style>

	// 	<div class="print_header">
	// 		<div class="center-align col_25 header_logo" >
	// 			<img width="115px" height="115px" src="./image/logo/'.$profile_selected['medic_logo'].'">
	// 		</div>
	// 		<div class="center-align col_50 h_100" style="float: left;">
	// 			<div class="header_title sanson_title" style="font-size: 24px;">'.$print_title.'</div>
	// 			<div><font style="font-size:8px">'.$profile_selected['topline_1'].'</font></div>
	// 			<div><font style="font-size:8px">'.$profile_selected['topline_2'].'</font></div>
	// 			<div><font style="font-size:8px">'.$profile_selected['topline_3'].'</font></div>
	// 		</div>
	// 		<div class="center-align col_25" style="height: 100px; float: left; text-align: right;">'.date('d-m-Y',strtotime($raw_page['date'])).'</div>
	// 	</div>
	// 	<div class="print_bottom center-align">
	// 		'.$sign_line.'<br/>
	// 		<div class="center-align bs_2 radius_10 ">
	// 			<span>'.$profile_selected['bottomline_1'].'</span>
	// 			<br />
	// 			<span>'.$profile_selected['bottomline_2'].'</span>
	// 		</div>
	// 	</div>

	// 	<div class="print_page">
	// 		<div class="vhp_top_content">
	// 			<div class="col_100 center-align " >
	// 				<span class="content_title sanson_title fs_20">
	// 					'.$raw_page['title'].'
	// 				</span>
	// 			</div>
	// 		</div>
	// 		<div class="vhp_middle_content px_10">'.$raw_page['content'].'</div>
	// 	</div>        ';
	// 	return $output;
	// }
	// function half_page (){
	// 	$output = '
	// 	<div style="transform: rotate(90deg);">probandoooooooo</div>;
	// 	';
	// 	return $output;
	// }
	// public function print_history_laboratory (){
	// 	session_start();
	// 	$r_date = new dateController; 
    //     $r_history = new historyController; 
    //     $r_patient = new patientController;

	// 	$array_fields = $r_history->array_fields;
	// 	$rs_dateopened = $r_date->get_dateopened();
	// 	$rs_history = $r_history->get_history_by_date($rs_dateopened[0]['ai_date_id']);
	// 	// $raw_history = json_decode($rs_history['tx_history_value'], true);
	// 	// $raw_laboratory = $raw_history[$rs_dateopened[0]['ai_date_id']]['laboratory'];        
	// 	// $print_lab = ['laboratory' => $raw_laboratory];
	// 	// $pre_content = ''; 
	// 	// $obj_laboratory =  $print_lab['laboratory'];

	// 	// foreach ($array_fields['laboratory'] as $spanish => $key_obj) {
	// 	// 	$css_classes = ($obj_laboratory[$key_obj][1] === true) ? 'red-text tex-darken-1 font_bolder' : '';
	// 	// 	if ($obj_laboratory[$key_obj][0] != '') {
	// 	// 		$pre_content .= '<span class="'.$css_classes.'">'.$spanish.str_replace("\n","<br/>",$obj_laboratory[$key_obj][0]).'</span><br/>';
	// 	// 	}
	// 	// }
    //     $pre_content = $r_history->generate_laboratory_content($rs_history);

	// 	$content_exploded = explode("<br/>", $pre_content);
	// 	$line_counter = 0;
	// 	$content = '';
	// 	foreach ($content_exploded as $key => $line_content) {
	// 		if ($line_content != '') {
	// 			$page_breaker = '';
	// 			if ($line_counter >= 30) {
	// 				$page_breaker = '<p style="page-break-before: always">';
	// 				$line_counter = 0;
	// 			}
	// 			$content .= $page_breaker.$line_content.'<br/>';
	// 			$line_counter++;
	// 		}
	// 	}

	// 	$rs_patient = $r_patient->get_patient('ai_patient_id',$rs_dateopened[0]['date_ai_patient_id']);
	// 	$raw_page = [
	// 		'date' => $rs_history['tx_history_date'],
	// 		'title'=>'Resultados de Laboratorio',
	// 		'patient_name'=>$rs_patient['tx_patient_name'],
	// 		'patient_cip'=>$rs_patient['tx_patient_identification'],
	// 		'patient_tlf'=>$rs_patient['tx_patient_telephone'],
	// 		'patient_direction'=>$rs_patient['tx_patient_direction'],
	// 		'content'=>$content   //ARREGLAR ESTE ARRAY PARA QUE MUESTRE E CONTENIDO
	// 	];
	// 	$pdf = \App::make('dompdf.wrapper');
	// 	$pdf->loadHTML($this->full_page($raw_page));
	// 	return $pdf->stream();
	// }
	public function print_history_report (){
		session_start();

		$r_date = new dateController; $r_history = new historyController; $r_patient = new patientController;
		$raw_dateopened = $r_date->get_dateopened(); $rs_dateopened = $raw_dateopened['data'];
		$rs_history = $r_history->get_history_by_date($rs_dateopened[0]['ai_date_id']);

		$content = '';
		$reason = ($rs_history['history_reason']['content'] != '') ?           '<span class="font_bolder">Motivo de Consulta:</span> <br/><div class="pl_5">'.$rs_history['history_reason']['content'].'</div>' : '';
		$current = ($rs_history['tx_history_current'] != '') ?                 '<span class="font_bolder"><br/>Enfermedad Actual:</span> <br/><div class="pl_5">'.$rs_history['tx_history_current'].'</div>' : '';
		$antecedent = ($rs_history['history_antecedent']['content'] != '') ?   '<span class="font_bolder"><br/>Antecedente(s):</span> <br/><div class="pl_5">'.$rs_history['history_antecedent']['content'].'</div>' : '';
		$examination = ($rs_history['tx_history_examination'] != '') ?         '<span class="font_bolder"><br/>Examen F&iacute;sico:</span> <br/><div class="pl_5">'.$rs_history['tx_history_examination'].'</div>' : '';
		$diagnostic = ($rs_history['history_diagnostic']['content'] != '') ?   '<span class="font_bolder"><br/>Diagn&oacute;stico:</span> <br/><div class="pl_5">'.$rs_history['history_diagnostic']['content'].'</div>' : '';
		$comment = ($rs_history['tx_history_comment'] != '') ?                 '<span class="font_bolder"><br/>Comentario(s):</span> <br/><div class="pl_5">'.$rs_history['tx_history_comment'].'</div>' : '';
		$plan = ($rs_history['tx_history_plan'] != '') ?                       '<span class="font_bolder"><br/>Plan:</span> <br/><div class="pl_5">'.$rs_history['tx_history_plan'].'</div>' : '';

		$content = $reason.$current.$antecedent.$examination.$diagnostic.$comment.$plan;
		$rs_patient = $r_patient->get_patient('ai_patient_id',$rs_dateopened[0]['date_ai_patient_id']);
		$raw_page = [
			'date' => $rs_history['tx_history_date'],
			'title'=>'Informe M&eacute;dico',
			'patient_name'=>$rs_patient[0]['tx_patient_name'],
			'patient_cip'=>$rs_patient[0]['tx_patient_identification'],
			'patient_tlf'=>$rs_patient[0]['tx_patient_telephone'],
			'patient_direction'=>$rs_patient[0]['tx_patient_direction'],
			'content'=>$content
		];
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->full_page($raw_page));
		return $pdf->stream();
	}
	public function print_history_medicalorder ($date_slug){
		session_start();
		$r_date = new recurrent_date; $r_history = new recurrent_history; $r_patient = new recurrent_patient; $r_function = new recurrent_function;
		$rs_dateopened = $r_date->get_dateopened();
		$rs_history = $r_history->get_history_by_dateslug($date_slug);
		$raw_document = json_decode($rs_history[0]['tx_history_document'], true);
		$obj_document = $raw_document[$rs_dateopened[0]['ai_date_id']]['medicalorder'];

		require 'print/print_history_medicalorder.php';

		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->full_page($raw_page));
		return $pdf->stream();
	}
	// public function print_document_constancy ($date_slug) {
	// 	session_start();
	// 	$r_date = new recurrent_date; $r_history = new recurrent_history; $r_patient = new recurrent_patient; $r_function = new recurrent_function;
	// 	$rs_dateopened = $r_date->get_dateopened();
	// 	$rs_history = $r_history->get_history_by_dateslug($date_slug);
	// 	$raw_history = json_decode($rs_history[0]['tx_history_value'], true);

	// 	require 'print/print_document_constancy.php';

	// 	$pdf = \App::make('dompdf.wrapper');
	// 	$pdf->loadHTML($this->full_page($raw_page));
	// 	return $pdf->stream();
	// }
	// public function print_document_incapacity ($date_slug) {
	// 	session_start();
	// 	$r_date = new recurrent_date; $r_history = new recurrent_history; $r_patient = new recurrent_patient; $r_function = new recurrent_function;
	// 	$rs_dateopened = $r_date->get_dateopened();
	// 	$rs_history = $r_history->get_history_by_dateslug($date_slug);
	// 	$raw_history = json_decode($rs_history[0]['tx_history_value'], true);
	// 	$raw_document = json_decode($rs_history[0]['tx_history_document'], true);

	// 	require 'print/print_document_incapacity.php';

	// 	$pdf = \App::make('dompdf.wrapper');
	// 	$pdf->loadHTML($this->vertical_halfpage($raw_page));
	// 	return $pdf->stream();
	// }

}
