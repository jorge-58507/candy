<?php

namespace App\Http\Controllers;

use App\candy_medic;
use App\candy_auth;
use App\candy_patient;
use App\candy_rel_medic_patient;
use App\candy_date;
use App\candy_reason;
use App\candy_history;
use App\User;
use App\candy_antecedenthistory;
use App\candy_reasonhistory;

use Illuminate\Http\Request;
use App\Http\Requests\StorePatientRequest;

// include 'recurrent_function.php';
 
class dateController extends Controller
{
     /* Display a listing of the resource.
     * @return \Illuminate\Http\Response     */

    public function index(Request $request)
    { // ###############   SELECCIONAR MEDICO
      $user = $request->user();
      if ( auth()->user()->checkRole('admin') === true){ 
        return redirect() -> route('configuration.create');
      }
      $candy_medic = new candy_medic;
      $qry_medic = $candy_medic
      ->select('candy_medics.tx_medic_pseudonym', 'candy_medics.tx_medic_slug')
      ->join('candy_rel_medic_users', 'candy_rel_medic_users.medic_user_ai_medic_id', '=', 'candy_medics.tx_medic_slug')
      ->join('users', 'users.id', '=', 'candy_rel_medic_users.medic_user_ai_user_id')
      ->where('users.id', '=', $user['id']);
      $rs_medic = $qry_medic->get();
      $count = $qry_medic->count();
      $r_user = new userController;
      if ($count > 1) {
        $r_user->unset_coo_logmedic();
        return view('date.index', compact('rs_medic'));
      }elseif ($count == 0) {
        // si el user es admin redirecciona

        
        $r_user->unset_coo_logmedic(); 
        return view('auth.no_medic');
      }else{
        $r_user->set_coo_logmedic($rs_medic[0]['tx_medic_slug']);
        return redirect() -> route('date.create');
      }
    }
     // Show the form for creating a new resource.
     // ###############   CREAR CITA
    public function create(candy_patient $candy_patient)
    {
      $r_user = new userController;
      if (!$r_user->check_coo_logmedic()) { return redirect()->route('date.index'); }
      $reason_controller = new reasonController; 
      $patient_controller = new patientController;
      $medic_controller = new medicController;

      $raw_admin_date = [
        // "next_h"=>trim($r_patient -> cal_num_history($r_user->get_coo_logmedic())),
        "patient_list"=>$patient_controller->get_patient_list(),
        // "reason_list"=>$r_reason->get_reason_list(),
        "reason_list"=>$reason_controller->get_reason_list(),
        "date_list"=>$this->get_dates_by_date(date('Y-m-d')),
        "medic_logged"=>$medic_controller->get_medic_logged()
      ];
      return view('date.admin_date', compact('raw_admin_date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $medic_controller = new medicController;
      $medic_id = $medic_controller->get_medic_id();
      // $r_medic = new recurrent_medic;
      // $medic_id = $r_medic->get_medic('tx_medic_slug',$_COOKIE['coo_logmedic']);


      $date_time = date('H:i:s',strtotime($request->input('c')));

      $candy_date = new candy_date;
      $candy_date->date_ai_medic_id = $medic_id;
      $candy_date->date_ai_patient_id = $request->input('a');
      $candy_date->date_ai_reason_id = $request->input('b');
      $candy_date->tx_date_date = date('Y-m-d',strtotime($request->input('d')));
      $candy_date->tx_date_time = $date_time;
      $candy_date->tx_date_status = 1;
      $candy_date->tx_date_slug = time().$medic_id.$request->input('a').$request->input('b');
      $candy_date->save();
      // ANSWER
      // $r_date = new recurrent_date;
      $rs_date = $this->get_dates_by_date(date('Y-m-d',strtotime($request->input('d'))));
      return response()->json(['message'=>'¡Cita Guardada!','date_list'=>$rs_date]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
    public function update(Request $request, $date_slug)
    {
      session_start();
      $candy_date = new candy_date;
      $candy_reason = new candy_reason;
      $candy_history = new candy_history;
      $candy_antecedenthistory = new candy_antecedenthistory;
      $candy_patient = new candy_patient;
      $candy_reasonhistory = new candy_reasonhistory;
      $r_medic = new medicController;

      $qry_date = $candy_date->where('tx_date_slug','=',$date_slug);
      $rs_date = $qry_date->get();
      if ($qry_date->count() > 0 && $rs_date[0]['tx_date_status'] === 1) {

        // ACTUALIZAR CITA, DESACTIVARLA
        $candy_date->where('tx_date_slug','=',$date_slug)->update(['tx_date_status' => 0]);
        $_SESSION['opendate_session'] = $date_slug;

        //CONSULTAR EL CONTENIDO DE MOTIVO DE CONSULTA
        $qry_reason = $candy_reason->where('ai_reason_id',$rs_date[0]['date_ai_reason_id']);
        $rs_reason = $qry_reason->get();
        
        $user = $request->user();
        $user_id = $user['id'];

        $date_id = $rs_date[0]['ai_date_id'];
        $count_history = $candy_history->where('history_ai_date_id','=',$date_id)->count();
        if ($count_history < 1) {
          $today = date('Y-m-d');
          $candy_history->history_ai_user_id = $user_id;
          $candy_history->history_ai_date_id = $date_id;
          $candy_history->tx_history_date = $today;
          $candy_history->tx_pe_skin = '';
          $candy_history->tx_pe_head = '';
          $candy_history->tx_pe_orl = '';
          $candy_history->tx_pe_neck = '';
          $candy_history->tx_pe_respiratory = '';
          $candy_history->tx_pe_cardiac = '';
          $candy_history->tx_pe_auscultation = '';
          $candy_history->tx_pe_inspection = '';
          $candy_history->tx_pe_palpation = '';
          $candy_history->tx_pe_hip = '';
          $candy_history->tx_pe_condition = '';
          $candy_history->tx_pe_breathing = '';
          $candy_history->tx_pe_hydration = '';
          $candy_history->tx_pe_fever = '';
          $candy_history->tx_pe_pupils = '';
          $candy_history->tx_history_current = '';
          $candy_history->tx_history_examination = '';
          $candy_history->tx_history_comment = '';
          $candy_history->tx_history_plan = '';
          $candy_history->tx_history_vitalsign = '{"fc":null,"fr":null,"tas":null,"tad":null,"temp":null,"gc":null}';
          $candy_history->tx_lab_hemoglobin = '[null,false]';
          $candy_history->tx_lab_hematocrit = '[null,false]';
          $candy_history->tx_lab_platelet = '[null,false]';
          $candy_history->tx_lab_redbloodcell = '[null,false]';
          $candy_history->tx_lab_urea = '[null,false]';
          $candy_history->tx_lab_creatinine = '[null,false]';
          $candy_history->tx_lab_whitebloodcell = '[null,false]';
          $candy_history->tx_lab_lymphocytes = '[null,false]';
          $candy_history->tx_lab_neutrophils = '[null,false]';
          $candy_history->tx_lab_monocytes = '[null,false]';
          $candy_history->tx_lab_basophils = '[null,false]';
          $candy_history->tx_lab_eosinophils = '[null,false]';
          $candy_history->tx_lab_result = '[null,false]';
          $candy_history->tx_document_incapacity = '[]'; //array de 4 string
          $candy_history->save();
          $last_historyid = $candy_history->ai_history_id;

          $medic_id = $r_medic->get_medic_id();
          $candy_reasonhistory->reasonhistory_ai_history_id = $last_historyid;
          $candy_reasonhistory->reasonhistory_ai_reason_id = $rs_reason[0]['ai_reason_id'];
          $candy_reasonhistory->tx_reasonhistory_value = $rs_reason[0]['tx_reason_value'];
          $candy_reasonhistory->reasonhistory_ai_medic_id = $medic_id;
          $candy_reasonhistory->save();

        }

        return response()->json(['response'=>'success']);
      }else{
        return response()->json(['response'=>'failed','message'=>'Esta cita ya fue atendida.']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     // public function destroy(Request $request, candy_date $candy_date)
     public function destroy($id)
    {
      $candy_date = new candy_date;
      $rs_date = $candy_date->where('tx_date_slug','=',$id)->first();
      if ($rs_date['tx_date_status'] === 1) {
        $candy_date->where('tx_date_slug','=',$id)->delete();
        $status = 'Success';
        $message = 'Se Elimin&oacute; la Cita.';
      }else{ $status = 'Failed'; $message = 'No se puede eliminar la cita.'; }
      // ANSWER
      $rs_date = $this->get_dates_by_date($rs_date['tx_date_date']);
      return response()->json(['status'=>$status,'message'=>$message,'date_list'=>$rs_date]);
    }


    // RECURRENTES
    public function get_dates_by_date ($date) {
      $medic_controller = new medicController;
      $medic_id = $medic_controller->get_medic_id();

      $candy_date = new candy_date;
      $qry_date = $candy_date
      ->join('candy_patients','candy_patients.AI_patient_id','=','candy_dates.date_ai_patient_id')
      ->join('candy_reasons','candy_reasons.ai_reason_id','=','candy_dates.date_ai_reason_id')
      ->Where('tx_date_date','=',$date)
      ->Where('date_ai_medic_id','=',$medic_id)
      ->ORDERBY('tx_date_time','ASC')
      ->select('candy_patients.tx_patient_name','candy_dates.tx_date_slug','candy_dates.tx_date_time','candy_reasons.tx_reason_value','candy_dates.tx_date_status');
      $rs_date = $qry_date->get();
      $raw_date = array();
      foreach ($rs_date as $key => $date) {
        $rs_date[$key]['tx_date_time'] = date('h:i:s A',strtotime($date['tx_date_time']));
      }
      return $rs_date;
    }

    public function unset_coo_dateopened(){
      unset($_SESSION['opendate_session']);
    }
    public function check_coo_dateopened(){
      $ans = (empty($_SESSION['opendate_session'])) ? false : true;
      return $ans;
    }
    public function get_dateopened(){
      $candy_date = new candy_date;
      if (empty($_SESSION['opendate_session'])) {
        return 'null';
      }
      $dateopened = $_SESSION['opendate_session'];
      $qry_date = $candy_date
      ->JOIN('candy_reasons','ai_reason_id','=','date_ai_reason_id')
      ->where('tx_date_slug',$dateopened)
      ->SELECT('candy_dates.date_ai_patient_id','candy_dates.ai_date_id','candy_dates.tx_date_date','candy_dates.tx_date_time','candy_dates.date_ai_reason_id','candy_reasons.tx_reason_value','candy_dates.tx_date_slug');
      $rs_date = $qry_date->get();
      return ['count'=>$qry_date->count(), 'data'=>$rs_date];
    }
    public function filter_date_by_date ($date) {
      // $r_date = new dateController;
      $rs_date = $this->get_dates_by_date(date('Y-m-d',strtotime($date)));
      return response()->json(['date_list'=>$rs_date,'status'=>'success']);
    }
}
