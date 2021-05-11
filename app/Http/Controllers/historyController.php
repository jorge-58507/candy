<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\candy_reason;
use App\candy_current;
use App\candy_antecedent;
use App\candy_examination;
use App\candy_diagnostic;
use App\candy_plan;
use App\candy_ef;
use App\candy_skin; 
use App\candy_head; 
use App\candy_orl; 
use App\candy_neck;
use App\candy_respiratory; 
use App\candy_cardiac; 
use App\candy_auscultation;
use App\candy_inspection; 
use App\candy_palpation; 
use App\candy_hip;
use App\candy_history;
use App\candy_drug;
use App\candy_treatment;

class historyController extends Controller
{
    function __construct() {
		$this->array_fields = ['laboratory' => ['Hemoglobina: '=>'hemoglobin','Hematocrito: '=>'hematocrit','Plaquetas: '=>'platelet','Gl&oacute;bulos Rojos: '=>'redbloodcell','Urea: '=>'urea','Creatinina: '=>'creatinine','Gl&oacute;bulos Blancos: '=>'whitebloodcell','Linfocitos: '=>'lymphocytes','Neutr&oacute;filos: '=>'neutrophils','Monocitos: '=>'monocytes','Bas&oacute;filos: '=>'basophils','Eosin&oacute;filos: '=>'eosinophils',''=>'result']];
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      session_start();
      $date_controller = new dateController;
      $ans = $date_controller->check_coo_dateopened();
    // return response()->json(['response'=>$ans,'message'=> $_SESSION['opendate_session']]);
    //   if (!$date_controller->check_coo_dateopened()) { return redirect()->route('date.index'); }
    
      $dateopened = $date_controller->get_dateopened();
      $rs_dateopened = $dateopened['data'];

      $r_patient = new patientController;
      $r_medic = new medicController;
      $r_order = new orderController;

      $candy_reason = new candy_reason;
      $candy_current = new candy_current;
      $candy_antecedent = new candy_antecedent;
      $candy_examination = new candy_examination;
      $candy_diagnostic = new candy_diagnostic;
      $candy_plan = new candy_plan;
      $candy_ef = new candy_ef;
      $candy_skin = new candy_skin; $candy_head = new candy_head; $candy_orl = new candy_orl; $candy_neck = new candy_neck;
      $candy_respiratory = new candy_respiratory; $candy_cardiac = new candy_cardiac; $candy_auscultation = new candy_auscultation;
      $candy_inspection = new candy_inspection; $candy_palpation = new candy_palpation; $candy_hip = new candy_hip;
      $candy_history = new candy_history;
      $candy_drug = new candy_drug;
      $candy_treatment = new candy_treatment;

    
      $medic_id = $r_medic->get_medic_id();
        
      $qry_reason = $candy_reason->where('reason_ai_medic_id',$medic_id)->Where('tx_reason_status','1')->orWhere('reason_ai_medic_id',0)->Where('tx_reason_status','1');
      $rs_reason = ($qry_reason->count()>0)? $qry_reason->get() : [];
      $qry_antecedent = $candy_antecedent->where('antecedent_ai_medic_id',$medic_id)->Where('tx_antecedent_status','1')->orWhere('antecedent_ai_medic_id',0)->Where('tx_antecedent_status','1')->orderby('tx_antecedent_category')->orderby('tx_antecedent_value');
      $rs_antecedent = ($qry_antecedent->count()>0)? $qry_antecedent->get() : [];
      $qry_diagnostic = $candy_diagnostic->where('diagnostic_ai_medic_id',$medic_id)->Where('tx_diagnostic_status','1')->orWhere('diagnostic_ai_medic_id',0)->Where('tx_diagnostic_status','1');
      $rs_diagnostic = ($qry_diagnostic->count()>0)? $qry_diagnostic->get() : [];
      $qry_current = $candy_current->where('current_ai_medic_id',$medic_id)->orWhere('current_ai_medic_id',0);
      $rs_current = ($qry_current->count()>0)? $qry_current->get() : [];
      $qry_examination = $candy_examination->where('examination_ai_medic_id',$medic_id)->orWhere('examination_ai_medic_id',0);
      $rs_examination = ($qry_examination->count()>0)? $qry_examination->get() : [];
      $qry_plan = $candy_plan->where('plan_ai_medic_id',$medic_id)->orWhere('plan_ai_medic_id',0);
      $rs_plan = ($qry_plan->count()>0)? $qry_plan->get() : [];
      $rs_ef = ($candy_ef->count()>0)? $candy_ef->get() : [];
      $qry_skin = $candy_skin->where('skin_ai_medic_id',$medic_id)->orWhere('skin_ai_medic_id',0);
      $rs_skin = ($qry_skin->count()>0)? $qry_skin->get() : [];
      $qry_head = $candy_head->where('head_ai_medic_id',$medic_id)->orWhere('head_ai_medic_id',0);
      $rs_head = ($qry_head->count()>0)? $qry_head->get() : [];
      $qry_orl = $candy_orl->where('orl_ai_medic_id',$medic_id)->orWhere('orl_ai_medic_id',0);
      $rs_orl = ($qry_orl->count()>0)? $qry_orl->get() : [];
      $qry_neck = $candy_neck->where('neck_ai_medic_id',$medic_id)->orWhere('neck_ai_medic_id',0);
      $rs_neck = ($qry_neck->count()>0)? $qry_neck->get() : [];
      $qry_respiratory = $candy_respiratory->where('respiratory_ai_medic_id',$medic_id)->orWhere('respiratory_ai_medic_id',0);
      $rs_respiratory = ($qry_respiratory->count()>0)? $qry_respiratory->get() : [];
      $qry_cardiac = $candy_cardiac->where('cardiac_ai_medic_id',$medic_id)->orWhere('cardiac_ai_medic_id',0);
      $rs_cardiac = ($qry_cardiac->count()>0)? $qry_cardiac->get() : [];
      $qry_auscultation = $candy_auscultation->where('auscultation_ai_medic_id',$medic_id)->orWhere('auscultation_ai_medic_id',0);
      $rs_auscultation = ($qry_auscultation->count()>0)? $qry_auscultation->get() : [];
      $qry_inspection = $candy_inspection->where('inspection_ai_medic_id',$medic_id)->orWhere('inspection_ai_medic_id',0);
      $rs_inspection = ($qry_inspection->count()>0)? $qry_inspection->get() : [];
      $qry_palpation = $candy_palpation->where('palpation_ai_medic_id',$medic_id)->orWhere('palpation_ai_medic_id',0);
      $rs_palpation = ($qry_palpation->count()>0)? $qry_palpation->get() : [];
      $qry_hip = $candy_hip->where('hip_ai_medic_id',$medic_id)->orWhere('hip_ai_medic_id',0);
      $rs_hip = ($qry_hip->count()>0)? $qry_hip->get() : [];
      $rs_history_by_patient = $this->get_history_by_patient($rs_dateopened[0]['date_ai_patient_id'],$medic_id);
    //   $rs_history_by_patient = ($qry_history_by_patient->count()>0)? $qry_history_by_patient->get() : [];
      
    // VERIFICAR ALARMAS EN LOS LABORATORIOS
      $raw_lab = array();
      foreach ($rs_history_by_patient as $key => $obj_record) {
        // $history_decode = json_decode($obj_record['tx_history_value'], true);
        // $laboratory =  $history_decode[$obj_record['history_ai_date_id']]['laboratory'];
        // $laboratory = $obj_record[''];
        $alarm = 0; $empty = 1;
        // foreach ($laboratory as $index => $fe_laboratory) {
        //     if ($fe_laboratory[1] == true) { $alarm = 1;  }
        //     if (!empty($fe_laboratory[0])) { $empty = 0;  }
        // }
        $hemoglobin = json_decode($obj_record['tx_lab_hemoglobin'], true);
        if (!empty($hemoglobin[0])) { $empty = 0;  }; //Hay contenido
        if ($hemoglobin[1] == true) { $alarm = 1;  }; //Hay alarma

        $hematocrit = json_decode($obj_record['tx_lab_hematocrit'], true);
        if (!empty($hematocrit[0])) { $empty = 0;  }; //Hay contenido
        if ($hematocrit[1] == true) { $alarm = 1;  }; //Hay alarma

        $platelet = json_decode($obj_record['tx_lab_platelet'], true);
        if (!empty($platelet[0])) { $empty = 0;  }; //Hay contenido
        if ($platelet[1] == true) { $alarm = 1;  }; //Hay alarma

        $redbloodcell = json_decode($obj_record['tx_lab_redbloodcell'], true);
        if (!empty($redbloodcell[0])) { $empty = 0;  }; //Hay contenido
        if ($redbloodcell[1] == true) { $alarm = 1;  }; //Hay alarma

        $urea = json_decode($obj_record['tx_lab_urea'], true);
        if (!empty($urea[0])) { $empty = 0;  }; //Hay contenido
        if ($urea[1] == true) { $alarm = 1;  }; //Hay alarma

        $hemoglobin = json_decode($obj_record['tx_lab_hemoglobin'], true);
        if (!empty($hemoglobin[0])) { $empty = 0;  }; //Hay contenido
        if ($hemoglobin[1] == true) { $alarm = 1;  }; //Hay alarma

        $hemoglobin = json_decode($obj_record['tx_lab_hemoglobin'], true);
        if (!empty($hemoglobin[0])) { $empty = 0;  }; //Hay contenido
        if ($hemoglobin[1] == true) { $alarm = 1;  }; //Hay alarma

        
        if ($empty === 0) {
            $raw_lab[$key]['date'] = $obj_record['tx_history_date']; //Fecha de la cita
            $raw_lab[$key]['content'] = $this->generate_laboratory_content($laboratory);
            $raw_lab[$key]['alarm'] = $alarm;
        }
      }

      $rs_physic = ["skin"=>json_encode($rs_skin),"head"=>json_encode($rs_head),"orl"=>json_encode($rs_orl),"neck"=>json_encode($rs_neck),"respiratory"=>json_encode($rs_respiratory),"cardiac"=>json_encode($rs_cardiac),"auscultation"=>json_encode($rs_auscultation),"inspection"=>json_encode($rs_inspection),"palpation"=>json_encode($rs_palpation),"hip"=>json_encode($rs_hip)];
      $rs_patient = $r_patient->get_patient('AI_patient_id',$rs_dateopened[0]['date_ai_patient_id']);
      $rs_drug = $candy_drug->where('drug_ai_medic_id',$medic_id)->orWhere('drug_ai_medic_id',0)->orderby('tx_drug_category')->get();
      $rs_treatment = $candy_treatment->where('treatment_ai_medic_id',$medic_id)->orWhere('treatment_ai_medic_id',0)->get();

      $raw_history = ["dateopened"=>$rs_dateopened[0],"medic_logged"=>$r_medic->get_medic_logged(),"patientsdate"=>$rs_patient[0],"patientsage"=>$r_patient->calculate_age($rs_patient[0]['tx_patient_birthday']),"reasonlist"=>$rs_reason,"currentlist"=>$rs_current,"antecedentlist"=>$rs_antecedent,"examinationlist"=>$rs_examination,"diagnosticlist"=>$rs_diagnostic,"planlist"=>$rs_plan,
      "condition"=>$rs_ef,"efdatabase"=>$rs_physic,"laboratory_order"=>$r_order->get_order_list('laboratory'),"json_history"=>$this->get_history_by_date($rs_dateopened[0]['ai_date_id']),'raw_lab'=> $raw_lab,"complementary_order"=>$r_order->get_order_list('complementary'),"profile_order"=>$r_order->get_order_list('profile'),"druglist"=>$rs_drug,"treatmentlist"=>$rs_treatment]; 
      return view('history.index', compact('raw_history'));
      
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // RECURRENTE

    public function compare_reason ($raw_history,$date_id) {
		$candy_reason = new candy_reason;
		$rs_reason = $candy_reason->select('ai_reason_id','tx_reason_value')->get();
		$raw_reason = array();
		foreach ($rs_reason as $key => $reason) {
			$raw_reason[$reason['ai_reason_id']] = $reason['tx_reason_value'];
		}
		$reason_selected = array();
		foreach ($raw_history[$date_id]['history']['reason']['selected'] as $key => $reason_id) {
				$pos = strpos($raw_history[$date_id]['history']['reason']['content'],$raw_reason[$reason_id]);
				if ($pos > -1) { 
						$reason_selected[] = $reason_id;
				}
		}
		return $reason_selected;
	}
	public function compare_antecedent ($raw_history,$date_id) {
		$candy_antecedent = new candy_antecedent;
		$rs_antecedent = $candy_antecedent->select('ai_antecedent_id','tx_antecedent_value')->get();
		$raw_antecedent = array();
		foreach ($rs_antecedent as $key => $antecedent) {
            $raw_antecedent[$antecedent['ai_antecedent_id']] = $antecedent['tx_antecedent_value'];
        }
        $antecedent_selected = array();
        foreach ($raw_history[$date_id]['history']['antecedent']['selected'] as $key => $antecedent_id) {
            $pos = strpos($raw_history[$date_id]['history']['antecedent']['content'],$raw_antecedent[$antecedent_id]);			
			if ($pos > -1) { 
				$antecedent_selected[] = $antecedent_id;
            }
		}
		return $antecedent_selected;
	}
	public function compare_diagnostic ($raw_history,$date_id) {
		$candy_diagnostic = new candy_diagnostic;
		$rs_diagnostic = $candy_diagnostic->select('ai_diagnostic_id','tx_diagnostic_value')->get();
		$raw_diagnostic = array();
		foreach ($rs_diagnostic as $key => $diagnostic) {
			$raw_diagnostic[$diagnostic['ai_diagnostic_id']] = $diagnostic['tx_diagnostic_value'];
		}
		$diagnostic_selected = array();
		foreach ($raw_history[$date_id]['history']['diagnostic']['selected'] as $key => $diagnostic_id) {
			$pos = strpos($raw_history[$date_id]['history']['diagnostic']['content'],$raw_diagnostic[$diagnostic_id]);
			if ($pos > -1) { 
					$diagnostic_selected[] = $diagnostic_id;
			}
		}
		return $diagnostic_selected;
	}
	public function get_history_by_date ($date_id) {
		$candy_history = new candy_history;
		$rs_history = $candy_history->where('history_ai_date_id','=',$date_id)->firstorfail();
		return $rs_history;
	}
	public function get_history_by_dateslug ($date_slug) {
		$candy_history = new candy_history;
		$rs_history = $candy_history
		->join('candy_dates','candy_dates.ai_date_id','=','candy_histories.history_ai_date_id')
		->where('candy_dates.tx_date_slug','=',$date_slug)->get();
		return $rs_history;
	}
	public function get_history_by_patient ($patient_id,$medic_id) {
		$candy_history = new candy_history;
		$rs_history_by_patient = $candy_history
			->join('candy_dates','candy_dates.ai_date_id','=','candy_histories.history_ai_date_id')
			->where('candy_dates.date_ai_patient_id',$patient_id)
			->where('candy_dates.date_ai_medic_id',$medic_id)->get();
		return $rs_history_by_patient;
	}
	public function generate_laboratory_content ($obj_laboratory) {
		$content = '';
		$array_fields = $this->array_fields;
		foreach ($array_fields['laboratory'] as $spanish => $key_obj) {
			$css_classes = ($obj_laboratory[$key_obj][1] === true) ? 'red-text tex-darken-1 font_bolder' : '';
			$content .= '<span class="'.$css_classes.'">'.$spanish.str_replace("\n","</br>",$obj_laboratory[$key_obj][0]).'</span>'.'</br>';
		}
		return $content;
	}
	public function get_laboratory_cards () {
		$r_date = new dateController;
		$rs_dateopened = $r_date->get_dateopened();
		$r_medic = new medicController;
		$medic_id = $r_medic->get_medic_id();
		$rs_history_by_patient = $this->get_history_by_patient($rs_dateopened[0]['date_ai_patient_id'],$medic_id);
		$raw_lab = array();
		foreach ($rs_history_by_patient as $key => $obj_record) {
			// $history_decode = json_decode($obj_record['tx_history_value'], true); *********ARREGLAR ESTO
			$laboratory =  $history_decode[$obj_record['history_ai_date_id']]['laboratory'];
			$alarm = 0; $empty = 1;
			foreach ($laboratory as $index => $fe_laboratory) {
					if ($fe_laboratory[1] == true) { $alarm = 1;  }
					if (!empty($fe_laboratory[0])) { $empty = 0;  }
			}
			if ($empty === 0) {
					$raw_lab[$key]['date'] = date('d-m-Y',strtotime($obj_record['tx_history_date']));
					$raw_lab[$key]['content'] = $this->generate_laboratory_content($laboratory);
					$raw_lab[$key]['alarm'] = $alarm;
			}
		}
		return $raw_lab;
	}
}
