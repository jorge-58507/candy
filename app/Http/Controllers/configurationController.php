<?php

namespace App\Http\Controllers;

use App\candy_drug;
use App\candy_treatment;
use App\candy_order;
use App\User;

use Illuminate\Http\Request;

// include 'recurrent_function.php';

class configurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $r_medic = new medicController;
      $medic_id = $r_medic->get_medic('tx_medic_slug',$_COOKIE['coo_logmedic']);
      $candy_drug = new candy_drug;
      $rs_drug = $candy_drug->where('drug_ai_medic_id',$medic_id)->orWhere('drug_ai_medic_id',0)->orderby('tx_drug_category')->orderby('tx_drug_generic', 'ASC')->get();
      $candy_treatment = new candy_treatment;
      $rs_treatment = $candy_treatment->where('treatment_ai_medic_id',$medic_id)->orWhere('treatment_ai_medic_id',0)->orderby('tx_treatment_title')->get();
      $candy_order = new candy_order;
      $rs_order = $candy_order->where('order_ai_medic_id',$medic_id)->orWhere('order_ai_medic_id',0)->orderby('tx_order_type')->get();
      $raw_configuration = ["druglist" => $rs_drug, "treatmentlist" => $rs_treatment, "orderlist" => $rs_order];
      return view('configuration.index', compact('raw_configuration'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $request->user()->authorizeRole(['admin']);
      $model_user = new User;
      $rs_user = $model_user->all();
      $data = ['user_list'=>$rs_user];
      return view('configuration.dashboard', compact('data'));
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
}
