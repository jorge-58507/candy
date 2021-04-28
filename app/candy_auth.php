<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class candy_auth extends Model
{
  public function getRouteKeyName(){
    return 'slug';
  }
}
