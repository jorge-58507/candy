<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
use App\candy_diagnostichistory;
use App\candy_antecedenthistory;
use App\candy_drughistory;
use App\candy_reasonhistory;
use App\candy_laboratoryhistory;
use App\candy_complementaryhistory;
use App\candy_date;
use App\candy_patient;


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
      $dateopened = $date_controller->get_dateopened();
      if ($dateopened === 'null') {
        return redirect()->action([dateController::class, 'index']);
      }
  
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
      $candy_reasonhistory = new candy_reasonhistory;
      $candy_diagnostichistory = new candy_diagnostichistory;
      $candy_drughistory = new candy_drughistory;

    
      $medic_id = $r_medic->get_medic_id();
      $medic_id = $medic_id+0;
        
      $qry_reason = $candy_reason->addSelect(['contador' => $candy_reasonhistory->select(DB::raw('count(candy_reasonhistories.reasonhistory_ai_reason_id)'))
          ->whereColumn('reasonhistory_ai_reason_id', 'candy_reasons.ai_reason_id')
          ->whereRaw('reasonhistory_ai_medic_id = '.$medic_id)
      ])
      ->Where('reason_ai_medic_id',$medic_id)->Where('tx_reason_status','1')->Where('tx_reason_level',">",0)
      ->orWhere('reason_ai_medic_id',0)->Where('tx_reason_status','1')->Where('tx_reason_level',">",0)->orderBy('contador','desc');
      $rs_reason = ($qry_reason->count()>0)? $qry_reason->get() : [];

      $qry_antecedent = $candy_antecedent->where('antecedent_ai_medic_id',$medic_id)->Where('tx_antecedent_status','1')->orWhere('antecedent_ai_medic_id',0)->Where('tx_antecedent_status','1')->orderby('tx_antecedent_category')->orderBy('tx_antecedent_value');
      $rs_antecedent = ($qry_antecedent->count()>0)? $qry_antecedent->get() : [];

      $qry_diagnostic = $candy_diagnostic->addSelect(['contador'=> $candy_diagnostichistory->select(DB::raw('count(candy_diagnostichistories.diagnostichistory_ai_diagnostic_id)'))
        ->whereColumn('diagnostichistory_ai_diagnostic_id','candy_diagnostics.ai_diagnostic_id')
        ->whereRaw('diagnostichistory_ai_medic_id = '.$medic_id)
      ])
      ->where('diagnostic_ai_medic_id',$medic_id)->where('tx_diagnostic_status','1')->where('tx_diagnostic_level',">",0)
      ->orWhere('diagnostic_ai_medic_id',0)->where('tx_diagnostic_status','1')->where('tx_diagnostic_level',">",0)->orderBy('contador','desc');
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
      $laboratory_ans = $this->get_laboratory_cards($rs_dateopened[0]['date_ai_patient_id'],$rs_dateopened[0]['ai_date_id']);

      $rs_physic = ["skin"=>json_encode($rs_skin),"head"=>json_encode($rs_head),"orl"=>json_encode($rs_orl),"neck"=>json_encode($rs_neck),"respiratory"=>json_encode($rs_respiratory),"cardiac"=>json_encode($rs_cardiac),"auscultation"=>json_encode($rs_auscultation),"inspection"=>json_encode($rs_inspection),"palpation"=>json_encode($rs_palpation),"hip"=>json_encode($rs_hip)];
      $rs_patient = $r_patient->get_patient('AI_patient_id',$rs_dateopened[0]['date_ai_patient_id']);

      $qry_drug = $candy_drug->addSelect(['contador'=> $candy_drughistory->select(DB::raw('count(candy_drughistories.drughistory_ai_drug_id)'))
        ->whereColumn('drughistory_ai_drug_id','candy_drugs.ai_drug_id')
        ->whereRaw('drughistory_ai_medic_id = '.$medic_id)
      ])
      ->where('drug_ai_medic_id',$medic_id)->where('tx_drug_status','1')
      ->orWhere('drug_ai_medic_id',0)->where('tx_drug_status','1')->orderBy('contador','desc')->orderBy('tx_drug_generic','ASC');
      $rs_drug = ($qry_drug->count()>0)? $qry_drug->get() : [];

      $rs_treatment = $candy_treatment->where('treatment_ai_medic_id',$medic_id)->orWhere('treatment_ai_medic_id',0)->get();

      $raw_history = ["dateopened"=>$rs_dateopened[0],"medic_logged"=>$r_medic->get_medic_logged(),"patientsdate"=>$rs_patient[0],"patientsage"=>$r_patient->calculate_age($rs_patient[0]['tx_patient_birthday']),"reasonlist"=>$rs_reason,"currentlist"=>$rs_current,"antecedentlist"=>$rs_antecedent,"examinationlist"=>$rs_examination,"diagnosticlist"=>$rs_diagnostic,"planlist"=>$rs_plan,
      "condition"=>$rs_ef,"efdatabase"=>$rs_physic,"laboratory_order"=>$r_order->get_order_list('laboratory'),"json_history"=>$this->get_history_by_date($rs_dateopened[0]['ai_date_id']),'raw_lab'=> $laboratory_ans,"complementary_order"=>$r_order->get_order_list('complementary'),"profile_order"=>$r_order->get_order_list('profile'),"druglist"=>$rs_drug,"treatmentlist"=>$rs_treatment]; 
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
    public function store(Request $request) //GUARDAR PLANES
    {

      // else{ //CREAR
      //   $candy_history->history_ai_user_id = $user_id;
      //   $candy_history->history_ai_date_id = $date_id;
      //   $candy_history->tx_history_date = $today;
      //   $candy_history->tx_pe_skin = $raw_history[$date_id]['physical_exam']['skin'];
      //   $candy_history->tx_pe_head = $raw_history[$date_id]['physical_exam']['head'];
      //   $candy_history->tx_pe_orl = $raw_history[$date_id]['physical_exam']['orl'];
      //   $candy_history->tx_pe_neck = $raw_history[$date_id]['physical_exam']['neck'];
      //   $candy_history->tx_pe_respiratory = $raw_history[$date_id]['physical_exam']['respiratory'];
      //   $candy_history->tx_pe_cardiac = $raw_history[$date_id]['physical_exam']['cardiac'];
      //   $candy_history->tx_pe_auscultation = $raw_history[$date_id]['physical_exam']['auscultation'];
      //   $candy_history->tx_pe_inspection = $raw_history[$date_id]['physical_exam']['inspection'];
      //   $candy_history->tx_pe_palpation = $raw_history[$date_id]['physical_exam']['palpation'];
      //   $candy_history->tx_pe_hip = $raw_history[$date_id]['physical_exam']['hip'];
      //   $candy_history->tx_pe_condition = $raw_history[$date_id]['physical_exam']['condition'];
      //   $candy_history->tx_pe_breathing = $raw_history[$date_id]['physical_exam']['breathing'];
      //   $candy_history->tx_pe_hydration = $raw_history[$date_id]['physical_exam']['hydration'];
      //   $candy_history->tx_pe_fever = $raw_history[$date_id]['physical_exam']['fever'];
      //   $candy_history->tx_pe_pupils = $raw_history[$date_id]['physical_exam']['pupils'];
      //   $candy_history->tx_history_current = $raw_history[$date_id]['history']['current']['content'];
      //   $candy_history->tx_history_examination = $raw_history[$date_id]['history']['examination']['content'];
      //   $candy_history->tx_history_comment = $raw_history[$date_id]['history']['comment']['content'];
      //   $candy_history->tx_history_plan = $raw_history[$date_id]['history']['plan']['content'];
      //   $candy_history->tx_history_vitalsign = json_encode($vital_sign);
      //   $candy_history->tx_lab_hemoglobin = $raw_history[$date_id]['laboratory']['hemoglobin'];
      //   $candy_history->tx_lab_hematocrit = $raw_history[$date_id]['laboratory']['hematocrit'];
      //   $candy_history->tx_lab_platelet = $raw_history[$date_id]['laboratory']['platelet'];
      //   $candy_history->tx_lab_redbloodcell = $raw_history[$date_id]['laboratory']['redbloodcell'];
      //   $candy_history->tx_lab_urea = $raw_history[$date_id]['laboratory']['urea'];
      //   $candy_history->tx_lab_creatinine = $raw_history[$date_id]['laboratory']['creatinine'];
      //   $candy_history->tx_lab_whitebloodcell = $raw_history[$date_id]['laboratory']['whitebloodcell'];
      //   $candy_history->tx_lab_lymphocytes = $raw_history[$date_id]['laboratory']['lymphocytes'];
      //   $candy_history->tx_lab_neutrophils = $raw_history[$date_id]['laboratory']['neutrophils'];
      //   $candy_history->tx_lab_monocytes = $raw_history[$date_id]['laboratory']['monocytes'];
      //   $candy_history->tx_lab_basophils = $raw_history[$date_id]['laboratory']['basophils'];
      //   $candy_history->tx_lab_eosinophils = $raw_history[$date_id]['laboratory']['eosinophils'];
      //   $candy_history->tx_lab_result = $raw_history[$date_id]['laboratory']['result'];
      //   $candy_history->save();
      // }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date_id)
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
    public function update(Request $request, $date_id)
    {
      $user = $request->user();
      $user_id = $user['id'];
      $raw_history = $request->input('a');
      // $date_id = key($raw_history);
      // return response()->json(['message'=>json_encode($raw_history)]);

      $reason_selected = $this->compare_reason($raw_history,$date_id);
      $antecedent_selected = $this->compare_antecedent($raw_history,$date_id);
      $diagnostic_selected = $this->compare_diagnostic($raw_history,$date_id);
      $medicine_selected = $this->compare_drug($raw_history, $date_id);                                                                                  

      $candy_history = new candy_history;
      $count_history = $candy_history->where('history_ai_date_id','=',$date_id)->count();

      $today = date('Y-m-d');
      $vital_sign = [
        "fc"=>$raw_history[$date_id]['history']['vital_sign']['fc'],
        "fr"=>$raw_history[$date_id]['history']['vital_sign']['fr'],
        "tas"=>$raw_history[$date_id]['history']['vital_sign']['tas'],
        "tad"=>$raw_history[$date_id]['history']['vital_sign']['tad'],
        "temp"=>$raw_history[$date_id]['history']['vital_sign']['temp'],
        "gc"=>$raw_history[$date_id]['history']['vital_sign']['gc']
      ];

      if ($count_history > 0) { //ACTUALIZAR
        $history = $candy_history->where('history_ai_date_id', $date_id)->first();
        $history->tx_pe_skin = $raw_history[$date_id]['physical_exam']['skin'];
        $history->tx_pe_head = $raw_history[$date_id]['physical_exam']['head'];
        $history->tx_pe_orl = $raw_history[$date_id]['physical_exam']['orl'];
        $history->tx_pe_neck = $raw_history[$date_id]['physical_exam']['neck'];
        $history->tx_pe_respiratory = $raw_history[$date_id]['physical_exam']['respiratory'];
        $history->tx_pe_cardiac = $raw_history[$date_id]['physical_exam']['cardiac'];
        $history->tx_pe_auscultation = $raw_history[$date_id]['physical_exam']['auscultation'];
        $history->tx_pe_inspection = $raw_history[$date_id]['physical_exam']['inspection'];
        $history->tx_pe_palpation = $raw_history[$date_id]['physical_exam']['palpation'];
        $history->tx_pe_hip = $raw_history[$date_id]['physical_exam']['hip'];
        $history->tx_pe_condition = $raw_history[$date_id]['physical_exam']['condition'];
        $history->tx_pe_breathing = $raw_history[$date_id]['physical_exam']['breathing'];
        $history->tx_pe_hydration = $raw_history[$date_id]['physical_exam']['hydration'];
        $history->tx_pe_fever = $raw_history[$date_id]['physical_exam']['fever'];
        $history->tx_pe_pupils = $raw_history[$date_id]['physical_exam']['pupils'];
        $history->tx_history_current = $raw_history[$date_id]['history']['current']['content'];
        $history->tx_history_examination = $raw_history[$date_id]['history']['examination']['content'];
        $history->tx_history_comment = $raw_history[$date_id]['history']['comment']['content'];
        $history->tx_history_plan = json_encode(["recipe"=> $raw_history[$date_id]['history']['plan']['recipe'], "indication"=> $raw_history[$date_id]['history']['plan']['indication']]);
        $history->tx_history_vitalsign = json_encode($vital_sign);
        $history->tx_lab_hemoglobin = $raw_history[$date_id]['laboratory']['hemoglobin'];
        $history->tx_lab_hematocrit = $raw_history[$date_id]['laboratory']['hematocrit'];
        $history->tx_lab_platelet = $raw_history[$date_id]['laboratory']['platelet'];
        $history->tx_lab_redbloodcell = $raw_history[$date_id]['laboratory']['redbloodcell'];
        $history->tx_lab_urea = $raw_history[$date_id]['laboratory']['urea'];
        $history->tx_lab_creatinine = $raw_history[$date_id]['laboratory']['creatinine'];
        $history->tx_lab_whitebloodcell = $raw_history[$date_id]['laboratory']['whitebloodcell'];
        $history->tx_lab_lymphocytes = $raw_history[$date_id]['laboratory']['lymphocytes'];
        $history->tx_lab_neutrophils = $raw_history[$date_id]['laboratory']['neutrophils'];
        $history->tx_lab_monocytes = $raw_history[$date_id]['laboratory']['monocytes'];
        $history->tx_lab_basophils = $raw_history[$date_id]['laboratory']['basophils'];
        $history->tx_lab_eosinophils = $raw_history[$date_id]['laboratory']['eosinophils'];
        $history->tx_lab_result = $raw_history[$date_id]['laboratory']['result'];
        $history->save();
        $history_id = $history->ai_history_id;

        // $candy_reason = new candy_reason;
        //INSERCION EN reason_history
        $candy_reasonhistory = new candy_reasonhistory;
        $rs_reasonhistory = $candy_reasonhistory->where('reasonhistory_ai_history_id',$history_id)->get();
        $array_reasonhistory = [];
        foreach ($rs_reasonhistory as $value) {
          $ans = $candy_reasonhistory->where('ai_reasonhistory_id', $value['ai_reasonhistory_id'])->delete();
          $array_reasonhistory[] =$value['ai_reasonhistory_id'];
        }
        $candy_reasonhistory->destroy($array_reasonhistory);

                                                                          // SOLO GUARDA EL ULTIMO REASONHISTORY
                                                                        // $arr=[$reason_selected];
        $r_medic = new medicController;
        $medic_id = $r_medic->get_medic_id();
        $array_insert = [];
        foreach ($reason_selected as $reason_id => $reason) {
          // $qry = $candy_reasonhistory->where('reasonhistory_ai_reason_id',$reason_id)->WHERE('reasonhistory_ai_history_id',$history_id);
          // $count = $qry->count();
          // if ($count === 0) { //CREAR REASONHISTORY
            // $candy_reasonhistory->reasonhistory_ai_history_id = $history_id;
            // $candy_reasonhistory->reasonhistory_ai_reason_id = $reason_id;
            // $candy_reasonhistory->tx_reasonhistory_value = $reason;
            // $candy_reasonhistory->reasonhistory_ai_medic_id = $medic_id;
            // $candy_reasonhistory->save();

            array_push($array_insert,['reasonhistory_ai_history_id'=>$history_id,'reasonhistory_ai_reason_id'=>$reason_id,'tx_reasonhistory_value'=>$reason,'reasonhistory_ai_medic_id'=>$medic_id,'created_at'=>time(),'updated_at'=>time()]);
                                                                          // $arr[]=[$candy_reasonhistory->ai_reasonhistory_id=>$reason];
          // }
        }
        $candy_reasonhistory->insert($array_insert);
                                                                          // return response()->json(['message'=>json_encode($array_insert)]);

        // $diff_reason = array_diff($reason_history,$reason_selected);
        // foreach ($diff_reason as $id => $reason_value) {
        //   $rs = $candy_reasonhistory->where('ai_reasonhistory_id',$id)->delete();
        // }

                              // return response()->json(['message'=>json_encode($result)]);
                              // return response()->json(['message'=>'Se eliminara: '.json_encode($reason_history).'*********** de: '.json_encode($rs_reasonhistory).' porque: '.json_encode($reason_selected)]);

        $candy_drughistory = new candy_drughistory;
        foreach ($medicine_selected as $drug) {
          $count = $candy_drughistory->where('drughistory_ai_drug_id',$drug['id'])->where('drughistory_ai_history_id',$history_id)->count();
          if ($count === 0 && $drug['id'] != false) {
            $candy_drughistory->drughistory_ai_medic_id = $medic_id;
            $candy_drughistory->drughistory_ai_history_id = $history_id;
            $candy_drughistory->drughistory_ai_drug_id = $drug['id'];
            $candy_drughistory->tx_drughistory_value = $drug['description'];
            $candy_drughistory->tx_drughistory_duration = $drug['duration'];
            $candy_drughistory->tx_drughistory_frecuency = $drug['frecuency'];
            $candy_drughistory->tx_drughistory_interval = $drug['interval'];
            $candy_drughistory->tx_drughistory_presentation = $drug['presentation'];
            $candy_drughistory->tx_drughistory_quantity = $drug['quantity'];
            $candy_drughistory->tx_drughistory_dose = $drug['dose'];
            $candy_drughistory->save();
          }
        }
      }
      $candy_date = new candy_date;
      $rs_date = $candy_date->where('ai_date_id',$date_id)->get();
      $laboratory_ans = $this->get_laboratory_cards($rs_date[0]['date_ai_patient_id'],$date_id);
      return response()->json(['message'=>json_encode($reason_selected),'answer'=>['laboratory'=>$laboratory_ans]]);

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
      foreach ($rs_reason as $reason) {
        // $raw_reason[$reason['ai_reason_id']] = trim($reason['tx_reason_value']);
        $raw_reason[$reason['ai_reason_id']] = strtolower(trim($reason['tx_reason_value']));
      }
      $reason_explode = explode(",",$raw_history[$date_id]['history']['reason']['content']);
      $reason_explode_lowercase = [];
      foreach ($reason_explode as $reason){
        $reason_explode_lowercase[] = trim($reason);
        // $reason_explode_lowercase[] = strtolower(trim($reason));
      }
      $reason_selected = [];
      if (strlen($raw_history[$date_id]['history']['reason']['content']) > 0) {
        foreach ($reason_explode_lowercase as $reason){// cicla el campo_escrito dividido por comas
            $key = array_search(strtolower($reason), $raw_reason); //busca si campo_escrito aparece en el listado general de razones
            if(!$key){
              $medic_controller = new medicController;
              $medic_id = $medic_controller->get_medic_id();
              $candy_reason->tx_reason_value = ucfirst($reason);
              $candy_reason->reason_ai_medic_id = $medic_id;
              $candy_reason->tx_reason_status = 1;
              $candy_reason->tx_reason_level = 0;
              $candy_reason->save();
              $key = $candy_reason->ai_reason_id;
            }else{
              $qry_reason = $candy_reason->where('ai_reason_id',$key)->where('tx_reason_level',0);
              if ($qry_reason->count() > 0) {
                $qry_reason->update(['tx_reason_level' => 1]);
              }
            }
          $reason_selected[$key] = $reason;
        }
      }
		  return $reason_selected;
	  }
    public function compare_antecedent ($raw_history,$date_id) {
      $candy_antecedent = new candy_antecedent;
      $rs_antecedent = $candy_antecedent->select('ai_antecedent_id','tx_antecedent_value')->get();
      $raw_antecedent = [];
      foreach ($rs_antecedent as $key => $antecedent) {
        $raw_antecedent[$antecedent['ai_antecedent_id']] = strtolower(trim($antecedent['tx_antecedent_value']));
      }
      $antecedent_explode = explode(",", $raw_history[$date_id]['history']['antecedent']['content']);
      $antecedent_explode_lowercase = [];
      foreach ($antecedent_explode as $antecedent) {
        $antecedent_explode_lowercase[] = trim($antecedent);
      }
      $antecedent_selected = [];
      if(strlen($raw_history[$date_id]['history']['antecedent']['content']) > 0){
        foreach ($antecedent_explode_lowercase as $antecedent) {
          $key = array_search(strtolower($antecedent),$raw_antecedent);
          if(!$key){
            $medic_controller = new medicController;
            $medic_id = $medic_controller->get_medic_id();
            $candy_antecedent->antecedent_ai_medic_id = $medic_id;
            $candy_antecedent->tx_antecedent_value = ucfirst($antecedent);
            $candy_antecedent->tx_antecedent_category = 0;
            $candy_antecedent->tx_antecedent_status = 1;
            $candy_antecedent->tx_antecedent_level = 0;
            $candy_antecedent->save();
            $key = $candy_antecedent->ai_antecedent_id;
          }else{
            $qry_antecedent = $candy_antecedent->where('ai_antecedent_id',$key)->where('tx_antecedent_level',0);
            if ($qry_antecedent->count() > 0) {
              $qry_antecedent->update(['tx_antecedent_level' => 1]);
            }
          }
          $antecedent_selected[$key] = $antecedent;
        }
      }
      return $antecedent_selected;
    }
	public function compare_diagnostic ($raw_history,$date_id) {  //HACER EL diagnostic COMPARE COMO HICE EL REASON, SELECTED SOLO FUNCIONARA PARA MEDICAMENTOS Y HACERLE DOBLE VERIFICACION
		$candy_diagnostic = new candy_diagnostic;
		$rs_diagnostic = $candy_diagnostic->select('ai_diagnostic_id','tx_diagnostic_value')->get();
		$raw_diagnostic = array();
		foreach ($rs_diagnostic as $key => $diagnostic) {
			$raw_diagnostic[$diagnostic['ai_diagnostic_id']] = strtolower(trim($diagnostic['tx_diagnostic_value']));
		}
    $diagnostic_explode = explode(",", $raw_history[$date_id]['history']['diagnostic']['content']);
    $diagnostic_explode_lowercase = [];
    foreach ($diagnostic_explode as $diagnostic) {
      $diagnostic_explode_lowercase[] = trim($diagnostic);
    }
    $diagnostic_selected=[];
    if(strlen($raw_history[$date_id]['history']['diagnostic']['content']) > 0){
      foreach ($diagnostic_explode_lowercase as $diagnostic) {
        $key = array_search(strtolower($diagnostic),$raw_diagnostic);
        if (!$key) {
          $medic_controller = new medicController;
          $medic_id = $medic_controller->get_medic_id();
          $candy_diagnostic->diagnostic_ai_medic_id = $medic_id;
          $candy_diagnostic->tx_diagnostic_value = ucfirst($diagnostic);
          $candy_diagnostic->tx_diagnostic_category = 'none';
          $candy_diagnostic->tx_diagnostic_status = 1;
          $candy_diagnostic->tx_diagnostic_level = 0;
          $candy_diagnostic->save();
          $key = $candy_diagnostic->ai_diagnostic_id;
        }else{
          $qry_diagnostic = $candy_diagnostic->where('ai_diagnostic_id',$key)->where('tx_diagnostic_level',0);
          if ($qry_diagnostic->count() > 0) {
            $qry_diagnostic->update(['tx_diagnostic_level' => 1]);
          }
        }
        $diagnostic_selected[$key] = $diagnostic;
      }
    }
		return $diagnostic_selected;
	}
  public function compare_drug ($raw_history,$date_id) {
    $candy_drug = new candy_drug;

    $rs_drug= $candy_drug->select('ai_drug_id','tx_drug_generic')->get();
    $raw_drug = [];
    foreach ($rs_drug as $drug) {
      $raw_drug[$drug['ai_drug_id']] = strtolower(trim($drug['tx_drug_generic']));
    }
    $drug_selected = array();
    $drug_historyselected = $raw_history[$date_id]['history']['plan']['selected'];
    $indication = $raw_history[$date_id]['history']['plan']['indication'];
    $exploded_indication = explode("\n",$indication);

    if (strlen($raw_history[$date_id]['history']['plan']['indication']) > 0) {
      foreach ($drug_historyselected as $key => $array_drug) { //cicla drug_Selected y la compara con la indication
        $str = $raw_drug[$array_drug['id']].',';
        foreach ($exploded_indication as $exp_line) {
          $match = preg_match("/^$str/i", $exp_line); // SI MATCH=1 AGREGAR A SELECTED
          if ($match === 1) {
            $drug_selected[] = $array_drug;
            break;
          }
        }
      }
    // Y LUEGO CICLAR INDICATION, HACERLE EXPLODE POR REGLON Y EXPLODE ANTES DE LA "," Y VER SI COINCIDE CON EL LISTADO GENERAL DE MEDICAMENTOS
      $exploded_lowercase_indication = [];
      foreach ($exploded_indication as $indication_line) {
        $exploded_lowercase_indication[] = trim($indication_line);
      }
      foreach ($exploded_lowercase_indication as $indication) {
        $exploded = explode(",", $indication);
        $key = array_search(strtolower($exploded[0]), $raw_drug); //busca si campo_escrito aparece en el listado general de medicamentos
        $repeated=0;
        foreach ($drug_selected as $value) {
          if($value['id'] === $key) { $repeated = 1; }
        }
        if ($repeated == 0 && $key != false) {
          $detail = explode(" ",$exploded[1]);
          if (count($detail) === 12 && $detail[4]==="de" && $detail[6]==="cada" && $detail[8]==="horas") {
            $drug_selected[] = ["id"=>$key,"description"=>$exploded[0],"quantity"=>$detail[2], "presentation"=>$detail[3], "dose"=>$detail[5], "frecuency"=>$detail[7], "duration"=>$detail[10], "interval"=>$detail[11]];
          }
        }
      }
    }
    return $drug_selected;
  }
  public function get_reason_by_history($h_id){
    $candy_reasonhistory = new candy_reasonhistory;
    $reason_history = $candy_reasonhistory->where('reasonhistory_ai_history_id',$h_id)->get();
    $arr_reason['selected']=[]; 
    $arr_reason['content']='';
    foreach ($reason_history as $key => $reason) {
      $arr_reason['selected'][] = $reason['reasonhistory_ai_reason_id'];
      $arr_reason['content'] .= ($key != 0) ? ', '.$reason['tx_reasonhistory_value'] : $reason['tx_reasonhistory_value']; 
    }
    return $arr_reason;
  }
  public function get_antecedent_by_history($patient_id){
    $candy_antecedenthistory = new candy_antecedenthistory;
    $antecedent_history = $candy_antecedenthistory->where('antecedenthistory_tx_patient_slug',$patient_id)->get();
    $arr_antecedent['selected']=[]; $arr_antecedent['content']='';
    foreach ($antecedent_history as $key => $antecedent) {
      $arr_antecedent['selected'][] = $antecedent['antecedenthistory_ai_antecedent_id'];
      $arr_antecedent['content'] .= ($key != 0) ? ', '.$antecedent['tx_antecedenthistory_value'] : $antecedent['tx_antecedenthistory_value']; 
    }
    return $arr_antecedent;
  }
  public function get_diagnostic_by_history($h_id){
    $candy_diagnostichistory = new candy_diagnostichistory;
    $diagnostic_history = $candy_diagnostichistory->where('diagnostichistory_ai_history_id',$h_id)->get();
    $arr_diagnostic['selected']=[]; $arr_diagnostic['content']='';
    foreach ($diagnostic_history as $key => $diagnostic) {
      $arr_diagnostic['selected'][] = $diagnostic['diagnostichistory_ai_diagnostic_id'];
      $arr_diagnostic['content'] .= ($key != 0) ? ', '.$diagnostic['tx_diagnostichistory_value'] : $diagnostic['tx_diagnostichistory_value']; 
    }
    return $arr_diagnostic;
  }
  public function get_drug_by_history($h_id){
    $candy_drughistory = new candy_drughistory;
    $drug_history = $candy_drughistory->where('drughistory_ai_history_id',$h_id)->get();
    $arr_drug['selected']=[]; $arr_drug['content']='';
    foreach ($drug_history as $key => $drug) {
      $arr_drug['selected'][] = $drug['drughistory_ai_drug_id'];
      $arr_drug['content'] .= ($key != 0) ? ', '.$drug['tx_drughistory_value'] : $drug['tx_drughistory_value']; 
    }
    return $arr_drug;
  }
  public function get_laboratoryorder_by_history($h_id){
    $candy_laboratoryhistory = new candy_laboratoryhistory;
    $laboratory_history = $candy_laboratoryhistory->where('laboratoryhistory_ai_history_id',$h_id)->get();
    $arr_lab['selected']=[]; $arr_lab['content']='';
    foreach ($laboratory_history as $key => $order) {
      $arr_lab['selected'][] = $order['laboratoryhistory_ai_laboratory_id'];
      $arr_lab['content'] .= ($key != 0) ? ', '.$order['tx_laboratoryhistory_value'] : $order['tx_laboratoryhistory_value'];
    }
    return $arr_lab;
  }
  public function get_complementaryorder_by_history($h_id){
    $candy_complementaryhistory = new candy_complementaryhistory;
    $complementary_history = $candy_complementaryhistory->where('complementaryhistory_ai_history_id',$h_id)->get();
    $arr['selected']=[]; $arr['content']='';
    foreach ($complementary_history as $key => $order) {
      $arr['selected'][] = $order['complementaryhistory_ai_complementary_id'];
      $arr['content'] .= ($key != 0) ? ', '.$order['tx_complementaryhistory_value'] : $order['tx_complementaryhistory_value'];
    }
    return $arr;
  }
	public function get_history_by_date ($date_id) {
		$candy_history = new candy_history;
    $candy_date = new candy_date;
    $candy_patient = new candy_patient;

		$rs_date = $candy_date->where('ai_date_id',$date_id)->get();
    $rs_patient = $candy_patient->where('ai_patient_id',$rs_date[0]['date_ai_patient_id'])->get();
    $rs_history = $candy_history->where('history_ai_date_id','=',$date_id)->firstorfail();

    $reason_history = $this->get_reason_by_history($rs_history['ai_history_id']);
    $antecedent_history = $this->get_antecedent_by_history($rs_patient[0]['tx_patient_slug']);
    $diagnostic_history = $this->get_diagnostic_by_history($rs_history['ai_history_id']);
    $drug_history = $this->get_drug_by_history($rs_history['ai_history_id']);
    $laboratoryorder_history = $this->get_laboratoryorder_by_history($rs_history['ai_history_id']); 
    $complementaryorder_history = $this->get_complementaryorder_by_history($rs_history['ai_history_id']); 

    $rs_history['tx_lab_hemoglobin'] = json_decode($rs_history['tx_lab_hemoglobin'],true);
    $rs_history['tx_lab_hematocrit'] = json_decode($rs_history['tx_lab_hematocrit'],true);
    $rs_history['tx_lab_platelet'] = json_decode($rs_history['tx_lab_platelet'],true);
    $rs_history['tx_lab_redbloodcell'] = json_decode($rs_history['tx_lab_redbloodcell'],true);
    $rs_history['tx_lab_urea'] = json_decode($rs_history['tx_lab_urea'],true);
    $rs_history['tx_lab_creatinine'] = json_decode($rs_history['tx_lab_creatinine'],true);
    $rs_history['tx_lab_whitebloodcell'] = json_decode($rs_history['tx_lab_whitebloodcell'],true);
    $rs_history['tx_lab_lymphocytes'] = json_decode($rs_history['tx_lab_lymphocytes'],true);
    $rs_history['tx_lab_neutrophils'] = json_decode($rs_history['tx_lab_neutrophils'],true);
    $rs_history['tx_lab_monocytes'] = json_decode($rs_history['tx_lab_monocytes'],true);
    $rs_history['tx_lab_basophils'] = json_decode($rs_history['tx_lab_basophils'],true);
    $rs_history['tx_lab_eosinophils'] = json_decode($rs_history['tx_lab_eosinophils'],true);
    $rs_history['tx_lab_result'] = json_decode($rs_history['tx_lab_result'],true);

    $rs_history['history_reason'] = $reason_history;
    $rs_history['history_antecedent'] = $antecedent_history;
    $rs_history['history_diagnostic'] = $diagnostic_history;
    $rs_history['history_drug'] = $drug_history;
    $rs_history['history_laboratoryorder'] = $laboratoryorder_history;
    $rs_history['history_complementaryorder'] = $complementaryorder_history;
		return $rs_history;
	}
	public function get_history_by_dateslug ($date_slug) {
		$candy_history = new candy_history;
		$rs_history = $candy_history
		->join('candy_dates','candy_dates.ai_date_id','=','candy_histories.history_ai_date_id')
		->where('candy_dates.tx_date_slug','=',$date_slug)->get();
		return $rs_history;
	}
	public function get_history_by_patient ($patient_id,$medic_id,$sort) {
		$candy_history = new candy_history;
		$rs_history_by_patient = $candy_history
			->join('candy_dates','candy_dates.ai_date_id','=','candy_histories.history_ai_date_id')
			->where('candy_dates.date_ai_patient_id',$patient_id)
			->where('candy_dates.date_ai_medic_id',$medic_id)
      ->orderBy('ai_date_id',$sort)
      ->get();
		return $rs_history_by_patient;
	}
	public function generate_laboratory_content ($obj_laboratory) {
		$content = '';
		$array_fields = $this->array_fields;
    $alarm = 0;
		foreach ($array_fields['laboratory'] as $spanish => $english) {
      $css_classes = '';
      $rs_laboratory = json_decode($obj_laboratory['tx_lab_'.$english]);
      if (!empty($rs_laboratory[0])) {
        if ($rs_laboratory[1] === true) {
          $css_classes = 'red-text tex-darken-1 font_bolder';
          $alarm = 1;
        }
        $content .= '<span class="'.$css_classes.'">'.$spanish.str_replace("\n","</br>",$rs_laboratory[0]).'</span>'.'</br>';
      }

		}
		return ['alarm'=>$alarm, 'content'=>$content];
	}
	public function get_laboratory_cards ($patient_id,$date_id) {
		$r_date = new dateController;
    $candy_history = new candy_history;
		$r_medic = new medicController;
		$medic_id = $r_medic->get_medic_id();
    $history_record = $this->get_history_by_patient($patient_id,$medic_id,'DESC');
    $array_card = [];
    foreach ($history_record as $rs_history) {
      $raw_lab = array();
      $ans_laboratory = $this->generate_laboratory_content($rs_history);
      $array_lab['date'] = date('d-m-Y',strtotime($rs_history['tx_history_date']));
      $array_lab['alarm'] = $ans_laboratory['alarm'];
      $array_lab['content'] = $ans_laboratory['content'];
      if (!empty($array_lab['content'])) {
        array_push($array_card,$array_lab);
      }
    }
		return $array_card;
	}
}
