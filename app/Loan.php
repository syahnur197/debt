<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
  protected $fillable = [
    'user_id',
    'debtor_name',
    'debtor_ic',
    'debtor_phone',
    'debtor_address',
    'photo',
    'note',
    'guarantor_name',
    'guarantor_ic_no',
    'amount',
    'loan_date',
    'payback_date',
  ];

  public function user() {
    return $this->belongsTo('App\User');
  }

  public function documents() {
    return $this->hasMany('App\Document');
  }

  public function likes() {
    return $this->hasMany('App\Like');
  }
}
