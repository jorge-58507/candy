<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class candy_medic extends Model
{
  public function getRouteKeyName(){
    return 'tx_medic_slug';
  }
  public function users(){
		return $this->belongsToMany('App\User', 'candy_rel_medic_users', 'medic_user_ai_user_id', 'medic_user_ai_medic_id');
	}

}
