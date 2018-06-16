<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
  public function loan() {
    return $this->belongsTo('App/Loan');
  }
}
