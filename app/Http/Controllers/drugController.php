<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\candy_drug;
use App\candy_presentation;
use App\candy_drughistory;

class drugController extends Controller
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
        $candy_drug = new candy_drug;
        $r_medic = new medicController;
        $medic_id = $r_medic->get_medic_id();
        $generic = $request->input('a');
        $rs_drug = $this->get_drug_by_field('tx_drug_generic',$generic);
        if (count($rs_drug) < 1) {
            $candy_drug->drug_ai_medic_id = $medic_id;
            $candy_drug->tx_drug_generic = $request->input('a');
            $candy_drug->tx_drug_comertial = $request->input('b');
            $candy_drug->tx_drug_category = '';
            $candy_drug->tx_drug_dose = '{}';
            $candy_drug->tx_drug_frecuency = '{}';
            $candy_drug->tx_drug_status = 1;
            $candy_drug->tx_drug_slug = time().$request->input('a');
            $candy_drug->save();
            $message = 'Guardado Correctamente.';
        }else{ $message = 'El nombre gen&eacute;rico ya existe.'; }
        $drug_list = $this->show_all();
        $raw_druglist = array();
        foreach ($drug_list as $key => $rs_drug) {
            $raw_druglist[] = ["id"=>$rs_drug['ai_drug_id'],"value"=>$rs_drug['tx_drug_generic'],"comertial"=>$rs_drug['tx_drug_comertial']];
        }
        $raw_return = [];
        $raw_return['drug_list'] = $raw_druglist;
        $raw_return['message'] = $message;
        return response()->json($raw_return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($drug_id)
    {
        $candy_presentation = new candy_presentation;
        $r_medic = new medicController;
        $medic_id = $r_medic->get_medic_id();

        $rs_drug = $this->get_drug_by_field('ai_drug_id',$drug_id);
        $rs_presentation = $candy_presentation->select('tx_presentation_value','ai_presentation_id')
        ->where('presentation_ai_medic_id',$medic_id)->where('tx_presentation_active',1)
        ->orWhere('presentation_ai_medic_id',0)->where('tx_presentation_active',1)->get();
        $raw_presentation = array();
        foreach ($rs_presentation as $key => $value) {
            $raw_presentation[$value['ai_presentation_id']] = $value['tx_presentation_value'];
        }
        $raw_return = $rs_drug;
        $raw_return['presentation'] = json_encode($raw_presentation);
        return response()->json($raw_return);
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

    public function get_drug_by_field ($field,$value) {
		$candy_drug = new candy_drug;
		$r_medic = new medicController;
		$medic_id = $r_medic->get_medic_id();

		$rs_drug = $candy_drug
		->where('drug_ai_medic_id',$medic_id)->where($field,$value)
		->orWhere('drug_ai_medic_id',0)->where($field,$value)
		->get();
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
    public function show_all (){
        $candy_drug = new candy_drug;
        $candy_drughistory = new candy_drughistory;
        $r_medic = new medicController;
        $medic_id = $r_medic->get_medic_id();

        $qry_drug = $candy_drug->addSelect(['contador'=> $candy_drughistory->select(\DB::raw('count(candy_drughistories.drughistory_ai_drug_id)'))
            ->whereColumn('drughistory_ai_drug_id','candy_drugs.ai_drug_id')
            ->whereRaw('drughistory_ai_medic_id = '.$medic_id)
        ])
        ->where('drug_ai_medic_id',$medic_id)->where('tx_drug_status','1')
        ->orWhere('drug_ai_medic_id',0)->where('tx_drug_status','1')->orderBy('contador','desc')->orderBy('tx_drug_generic','ASC');
        $rs_drug = ($qry_drug->count()>0)? $qry_drug->get() : [];
        return $rs_drug;
    }
    public function store_dose(Request $request){
        $dose = strtolower($request->input('a'));
        $drug_id = $request->input('b');
        $frecuency = $request->input('c');

        $candy_drug = new candy_drug;
        $rs_drug = $candy_drug->where('ai_drug_id',$drug_id)->get();
        $raw_dose = json_decode($rs_drug[0]['tx_drug_dose'],true);
        if(!array_key_exists($dose, $raw_dose)) {
            $raw_dose[$dose] = null;
            $candy_drug->where('ai_drug_id',$drug_id)
            ->update(['tx_drug_dose' => json_encode($raw_dose)]);
        }
        $raw_frecuency = json_decode($rs_drug[0]['tx_drug_frecuency'],true);
        if(!array_key_exists($frecuency, $raw_frecuency)){
            $raw_frecuency[$frecuency] = null;
            $candy_drug->where('ai_drug_id',$drug_id)
            ->update(['tx_drug_frecuency' => json_encode($raw_frecuency)]);
        }
        return response()->json(['response'=>'success','message'=>'Prosigamos']);

    }
}
