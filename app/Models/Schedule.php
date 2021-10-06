<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['beneficiaries_id', 'user_id', 'bookingdate', 'vaccinecenter_id', 'doseno','vaccinetype_id', 'scheduletime', 'secretcode', 'status'];

    
    public function state(){
        return $this->belongsTo(State::class);
    }
    
    
    public function district(){
        return $this->belongsTo(District::class);
    }
}
