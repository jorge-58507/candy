<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\candy_medic;
use App\candy_rel_medic_user;
use App\User;
use App\role_user;

// include 'recurrent_function.php';

class medicController extends Controller
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
      $model_medic = new candy_medic;
      $model_user = new User;
      $medic_print = 
      [
        [
          "half_page"=>[
            "line1"=>$request->input('g'),"line2"=>$request->input('h'),"line3"=>$request->input('i'),"bottomline1"=>$request->input('j'),"bottomline2"=>$request->input('k'),"sign_line"=>"1","speciality"=>$request->input('d'),"print_title"=>"localization","localization"=>$request->input('e'),"medic_logo"=>"default_logo.png"
          ],
          "complete_page"=>[
            "line1"=>$request->input('l'),"line2"=>$request->input('m'),"line3"=>$request->input('n'),"line4"=>$request->input('o'),"bottomline1"=>$request->input('p'),"bottomline2"=>$request->input('q'),"sign_line"=>"1","speciality"=>$request->input('d'),"print_title"=>"localization","localization"=>$request->input('e'),"medic_logo"=>"default_logo.png"
          ]
        ]
      ];
      $prefix = substr($request->input('a'),0,2);

      $model_medic->tx_medic_pseudonym = $request->input('a');
      $model_medic->tx_medic_gender = $request->input('b');
      $model_medic->tx_medic_speciality = $request->input('d');
      $model_medic->tx_medic_ubication = $request->input('e');
      $model_medic->tx_medic_telephone = $request->input('f');
      $model_medic->tx_medic_print = json_encode($medic_print);
      $model_medic->tx_medic_option = json_encode(["print_profile"=>0,"history_prefix"=>$prefix,"defaultDate"=>"-10"]);
      $medic_slug = time().str_replace(' ', '', $request->input('a'));
      $model_medic->tx_medic_slug = $medic_slug;
      $model_medic->save();

      $mail_splited = explode("@",$request->input('c'));
      $user_slug = time().str_replace(' ', '', $mail_splited[0]);

      $answer = User::create([
        'name' => $request->input('a'),
        'email' => $request->input('c'),
        'password' => Hash::make($request->input('r')),
        'slug' => $user_slug,
      ]);

      $model_role_user = new role_user;
      $model_role_user->user_id = $answer['id'];
      $model_role_user->role_id = 2;
      $model_role_user->save();
        // return $answer;

      // $model_user->create(["name"=>$request->input('a'), "email"=>$request->input('c'), "password"=>$request->input('r'), "slug"=>$user_slug]);

      $candy_rel = new candy_rel_medic_user;
      $data[]=['medic_user_ai_user_id'=>$answer['id'],'medic_user_ai_medic_id'=>$medic_slug];
      $data[]=['medic_user_ai_user_id'=>1,'medic_user_ai_medic_id'=>$medic_slug];
      $candy_rel->insert($data);
      
      // $candy_rel->medic_user_ai_user_id = $answer['id'];
      // $candy_rel->medic_user_ai_medic_id = $medic_slug;
      // $candy_rel->save();
      // $candy_rel = new candy_rel_medic_user;
      // $candy_rel->medic_user_ai_user_id = 1;
      // $candy_rel->medic_user_ai_medic_id = $medic_slug;
      // $candy_rel->save();

      return response()->json(['message'=>'Medico Creado!']);

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
    /* LOG MEDIC */
    public function log(Request $request){
      $r_user = new userController;
      $r_user->set_coo_logmedic($request->input('a'));
      return response()->json(['message'=>'Success!']);
    }
    public function get_coo_logmedic(){
      $cookie = $_COOKIE['coo_medic'];
      $exploded = explode("jjsrmp",$cookie);
      $coo_medic = explode("222",$exploded[1]);
      return $coo_medic;
    }
    public function get_medic_id(){
      $model_medic = new candy_medic;

      $medic_slug = $this->get_coo_logmedic();
      $rs_medic = $model_medic->SELECT('ai_medic_id')->WHERE('tx_medic_slug',$medic_slug)->get();
      $medic_id = $rs_medic[0]['ai_medic_id'];
      return $medic_id;
    }
    public function get_medic_logged () {
      $model_medic = new candy_medic;

      $medic_id = $this->get_medic_id();
      $qry_medic = $model_medic
      ->WHERE('ai_medic_id',"=",$medic_id);
      $rs_medic = $qry_medic->firstOrFail();
      return $rs_medic;
    }

}
