<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiaries extends Model
{
    use HasFactory;
    protected $fillable = ['referenceid','user_id','id_proof','id_number','name','gender','dob','dose'];
}
