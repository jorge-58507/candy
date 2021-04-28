<?php

namespace App\Http\Controllers;

use App\candy_medic;
use App\candy_auth;
use App\candy_patient;
use App\candy_rel_medic_patient;
use App\candy_date;
use App\candy_history;
use App\User;

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

      // $r_date = new recurrent_date; 
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
      $r_history = new historyController;
      $candy_date = new candy_date;
      $qry_date = $candy_date->where('tx_date_slug','=',$date_slug);
      $rs_date = $qry_date->get();
      if ($qry_date->count() > 0 && $rs_date[0]['tx_date_status'] === 1) {

        $candy_date->where('tx_date_slug','=',$date_slug)->update(['tx_date_status' => 0]);
        $_SESSION['opendate_session'] = $date_slug;
        // CONSULTAR ANTECEDENTES ANTERIORES
        $qry_lastdate = $candy_date->where('date_ai_patient_id',$rs_date[0]['date_ai_patient_id'])->where('tx_date_status',0)->orderBy('ai_date_id','desc')->take(2);
        if ($qry_lastdate->count() > 1) {
          $rs_lastdate = $qry_lastdate->get();
          $lastdate_id = $rs_lastdate[1]['ai_date_id'];
          $rs_history = $r_history->get_history_by_date($lastdate_id);
          $array_history = json_decode($rs_history['tx_history_value'],true);
          $raw_antecedent = $array_history[$lastdate_id]['history']['antecedent'];
        }else{
          $raw_antecedent = ["selected" => [], "content" => ''];
        }
        // crear json history
        // $user_id = $_SESSION['user_session'];
        $user = $request->user();
        $user_id = $user['id'];

        $json_history = '{"'.$rs_date[0]['ai_date_id'].'":{"physical_exam":{"skin":null,"head":null,"orl":null,"neck":null,"respiratory":null,"cardiac":null,"auscultation":null,"inspection":null,"palpation":null,"hip":null,"condition":"0","breathing":"0","hydration":"0","fever":"0","pupils":"0"},"history":{"reason":{"selected":['.$rs_date[0]['date_ai_reason_id'].'],"content":"Dolor de Espalda"},"current":{"content":null},"antecedent":{"selected":'.json_encode($raw_antecedent['selected']).',"content":"'.$raw_antecedent['content'].'"},"examination":{"content":null},"diagnostic":{"selected":[],"content":null},"comment":{"content":null},"plan":{"content":null},"vital_sign":{"fc":null,"fr":null,"tas":null,"tad":null,"temp":null,"gc":null}},"laboratory":{"hemoglobin":[null,false],"hematocrit":[null,false],"platelet":[null,false],"redbloodcell":[null,false],"urea":[null,false],"creatinine":[null,false],"whitebloodcell":[null,false],"lymphocytes":[null,false],"neutrophils":[null,false],"monocytes":[null,false],"basophils":[null,false],"eosinophils":[null,false],"result":[null,false]}}}';
        $raw_history = json_decode($json_history,true);
        $json_document = '{"'.$rs_date[0]['ai_date_id'].'":{"medicalorder":{"laboratory":null,"complementary":null},"prescription":{},incapacity":{}';
        $raw_document = json_decode($json_document,true);
        $date_id = key($raw_history);
        $candy_history = new candy_history;
        $count_history = $candy_history->where('history_ai_date_id','=',$date_id)->count();
        if ($count_history < 1) {
          $today = date('Y-m-d');
          $candy_history->history_ai_user_id = $user_id;
          $candy_history->history_ai_date_id = $date_id;
          $candy_history->tx_history_date = $today;
          $candy_history->tx_history_value = json_encode($raw_history);
          $candy_history->tx_history_document = json_encode($raw_document);
          $candy_history->save();
        }
        // return response()->json(['response'=>'success','message'=>'Prosigamos']);
        return response()->json(['response'=>'success','message'=> $lastdate_id]);
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