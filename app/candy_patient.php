<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class candy_patient extends Model
{
  public function getRouteKeyName(){
    return 'tx_patient_slug';
  }

}
