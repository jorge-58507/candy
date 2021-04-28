<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\candy_patient;
use App\candy_medic;
use App\candy_rel_medic_patient;

class patientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $model_patient = new candy_patient;
        $model_medic = new candy_medic;
        $model_rel_patient_medic = new candy_rel_medic_patient;
        $medic_controller = new medicController;

        $verify_history = $this->get_patient_by_history($request->input('e'));
        if($verify_history['count']>0){
            return response()->json(['status'=>'failed','message'=>'Historia ya existe.']);
        }
        $verify_identification = $this->get_patient_by_ci($request->input('b'));   
        if($verify_identification['count']>0){
            return response()->json(['status'=>'failed','message'=>'Cédula ya existe.']);
        }
        $model_patient->tx_patient_name = $request->input('a');
        $model_patient->tx_patient_identification = $request->input('b');
        $model_patient->tx_patient_birthday = $request->input('c');
        $model_patient->tx_patient_gender = $request->input('d');
        $model_patient->tx_patient_history = $request->input('e');
        $model_patient->tx_patient_direction = $request->input('f');
        $model_patient->tx_patient_avatar = 'default_avatar.jpg';
        $patient_slug = time().str_replace(' ', '', $request->input('a'));
        $model_patient->tx_patient_slug = $patient_slug;
        $answer = $model_patient->save();
        
        $rs_last = $model_patient->SELECT('ai_patient_id')->where('tx_patient_slug',$patient_slug)->get();
        $patient_id = $rs_last[0]['ai_patient_id'];

        $medic_slug = $medic_controller->get_coo_logmedic();
        $rs_medic = $model_medic->SELECT('ai_medic_id')->WHERE('tx_medic_slug',$medic_slug)->get();
        $medic_id = $rs_medic[0]['ai_medic_id'];

        $model_rel_patient_medic->medic_patient_ai_medic_id = $medic_id;
        $model_rel_patient_medic->medic_patient_ai_patient_id = $patient_id;
        $model_rel_patient_medic->save();

        $status = ($answer) ? 'success' : 'failed';
        $rs_all_patient = $this->get_patient_list();
        return response()->json(['status'=>$status,'message'=>'¡Paciente Creado!','patient_id'=>$patient_id,'patient_list'=>$rs_all_patient]);
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

    public function get_patient ($field,$patient_record) {
        $patient = new candy_patient;
        $qry_patient = $patient->WHERE($field,"=",$patient_record)
        ->orderby('ai_patient_id','DESC')
        ->limit(1);
        $rs_patient = $qry_patient->get();

		return $rs_patient;
	}
	
    public function get_patient_by_ci($patient_ci)
    {
        $rs_patient = $this->get_patient('tx_patient_identification',$patient_ci);
        $data['count'] = count($rs_patient);
        $data['data'] = $rs_patient;
        return $data;
    }
    public function get_patient_by_history($history_number)
    {
        $rs_patient = $this->get_patient('tx_patient_history',$history_number);
        $data['count'] = count($rs_patient);
        $data['data'] = $rs_patient;
        return $data;
    }
    public function get_next_history () {
			$candy_medic = new candy_medic;
			$candy_patient = new candy_patient;
			$medic_controller = new medicController;
			$coo_medic = $medic_controller->get_coo_logmedic();
			$rs_medic = $candy_medic
			->where('tx_medic_slug', "=", $coo_medic)
			->select('candy_medics.tx_medic_option','candy_medics.ai_medic_id')->get();
			$medic_option = json_decode($rs_medic[0]['tx_medic_option'],true);

			$medic_id = $rs_medic[0]['ai_medic_id'];
			if (!empty($medic_option['history_prefix'])) {
				$qry_nexth = $candy_patient
				->JOIN('candy_rel_medic_patients', 'candy_rel_medic_patients.medic_patient_ai_patient_id', '=', 'candy_patients.AI_patient_id')
				->WHERE('candy_rel_medic_patients.medic_patient_ai_medic_id', "=", $medic_id)
				->WHERE('candy_patients.tx_patient_history', "LIKE", '%'.$medic_option['history_prefix'].'%')
				->SELECT('candy_patients.tx_patient_history', 'candy_patients.AI_patient_id');
							$next_h = $medic_option['history_prefix'].($qry_nexth->count()+1);
				// $next_h = $qry_nexth->count();
							
			}else{
				$qry_nexth = $candy_patient
					->JOIN('candy_rel_medic_patients', 'candy_rel_medic_patients.medic_patient_ai_patient_id', '=', 'candy_patients.AI_patient_id')
					->WHERE('candy_rel_medic_patients.medic_patient_ai_medic_id', "=", $medic_id)
					->ORDERBY('AI_patient_id','DESC')
					->LIMIT('1')
					->SELECT('candy_patients.tx_patient_history', 'candy_patients.AI_patient_id');
					$next_h=-1;
					if ($qry_nexth->count() > 0) {
							$rs_nexth = $qry_nexth->get();
							$next_h = $rs_nexth[0]['tx_patient_history'];
					}
					$next_h += 1;
					$next_h = str_split('00000000'.$next_h,-15);
			}
			return ["next_h"=>$next_h];
    }
    public function get_patient_list () {
        $medic_controller = new medicController;
        $medic_id = $medic_controller->get_medic_id();
        $model_patient = new candy_patient;
        $qry_patient_list = $model_patient
                ->JOIN('candy_rel_medic_patients', 'candy_rel_medic_patients.medic_patient_ai_patient_id', '=', 'candy_patients.AI_patient_id')
                ->WHERE('candy_rel_medic_patients.medic_patient_ai_medic_id', "=", $medic_id)
                ->ORDERBY('tx_patient_name','ASC')
                ->SELECT('candy_patients.tx_patient_name', 'candy_patients.tx_patient_history', 'candy_patients.tx_patient_avatar');
        $rs_patient_list = $qry_patient_list->get();
        $raw_patient=array();
        foreach ($rs_patient_list as $key => $patient_name) {
            $raw_patient[$patient_name['tx_patient_name']."--".$patient_name['tx_patient_history']] = '../image/avatar/'.$patient_name['tx_patient_avatar'];
        }
        $pat = (object)$raw_patient;
        return $pat;
    }

	public function verify_patient ($request,$patient,$field) {
		$answer = '';
		switch ($field) {
			case 'tx_patient_identification':
				$qry_patient_id = $patient   // VERIFICAR QUE NO EXISTA LA CEDULA
				->WHERE($field,"=",$request->input('b'))
				->SELECT('candy_patients.AI_patient_id');
				if ($qry_patient_id->count() > 0) {
					return 'failed';
				}
				break;
			case 'tx_patient_history':
				$r_medic = new medicController;
				$medic_id = $r_medic->get_medic_id();
				$qry_patient_id = $patient   // VERIFICAR QUE NO EXISTA LA HISTORIA
				->JOIN('candy_rel_medic_patients', 'candy_rel_medic_patients.medic_patient_ai_patient_id', '=', 'candy_patients.AI_patient_id')
				->JOIN('candy_medics', 'candy_rel_medic_patients.medic_patient_ai_medic_id', '=', 'candy_medics.ai_medic_id')
				->WHERE('candy_rel_medic_patients.medic_patient_ai_medic_id', "=", $medic_id)
				->WHERE($field,"=",$request->input('e'))
				->SELECT('candy_patients.AI_patient_id');
				if ($qry_patient_id->count() > 0) {
					return 'failed';
				}
				break;
		}
	}
	public function calculate_age ($birthday) {
		list($Y,$m,$d) = explode("-",$birthday);
		return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}

}
