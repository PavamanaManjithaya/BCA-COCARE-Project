<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccinecenter extends Model
{
    use HasFactory;
    protected $fillable = ['cvcname', 'category', 'address', 'pincode','state_id','district_id','starttime','endtime','status'];

    
    public function state(){
        return $this->belongsTo(State::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }
    
}
