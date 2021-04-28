<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\candy_reason;
use App\candy_medic;

class reasonController extends Controller
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
			$model_reason = new candy_reason;
			$medic_controller = new medicController;

			$medic_id = $medic_controller->get_medic_id();

			$reason_id = $model_reason->insertGetId(
			[
					'tx_reason_value' => $request->input('a'),
					'reason_ai_medic_id' => $medic_id,
					'tx_reason_status' => 1,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
			]
			);
			return response()->json(['reason_id'=>$reason_id,'reason_value'=>$request->input('a'),"reason_list"=>$this->get_reason_list()]);
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
	// ###############  ORDINALES
    public function get_reason_list () {
			$model_reason = new candy_reason;
			$medic_controller = new medicController;

			$medic_id = $medic_controller->get_medic_id();
			$qry_reason = $model_reason
			->WHERE('reason_ai_medic_id',"=",0)
			->orWhere('reason_ai_medic_id',"=",$medic_id)
			->SELECT('candy_reasons.tx_reason_value');
			$rs_reason = $qry_reason->get();
			$raw_reason=array();
			foreach ($rs_reason as $key => $reason_value) {
					$raw_reason[$reason_value['tx_reason_value']] = null;
			}
			$reason_list = (object)$raw_reason;
			return $reason_list;
		}
		public function get_reason_by_value($reason_value){
			$medic_controller = new medicController;
			$medic_id = $medic_controller->get_medic_id();
			$candy_reason = new candy_reason;
			$qry_reason = $candy_reason
			->WHERE('candy_reasons.tx_reason_value',"=",$reason_value)
			->WHERE('candy_reasons.reason_ai_medic_id','=',$medic_id)
			->orWhere('candy_reasons.tx_reason_value',"=",$reason_value)
			->WHERE('candy_reasons.reason_ai_medic_id','=',0)
			->SELECT('candy_reasons.ai_reason_id');
			$rs_reason = $qry_reason->firstOrFail();
			return response()->json(['reason_id'=>$rs_reason['ai_reason_id']]);
		}

}
