<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vprocess extends Model
{
    use HasFactory;
    protected $fillable = ['beneficiaries_id', 'verifier_id', 'vaccinator_id', 'schedules_id','verifierstatus', 'vaccinatorstatus', 'vaccinedate', 'vaccinecenter_id', 'amount'];
}
