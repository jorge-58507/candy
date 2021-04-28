<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class candy_date extends Model
{
  public function getRouteKeyName(){
    return 'tx_date_slug';
  }
}
