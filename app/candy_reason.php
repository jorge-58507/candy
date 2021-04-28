<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class candy_reason extends Model
{
  public function getRouteKeyName(){
    return 'tx_reason_slug';
  }
  protected $table = 'candy_reasons';
}
