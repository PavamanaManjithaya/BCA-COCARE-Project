<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;

class District extends Model
{
    use HasFactory;
	protected $fillable = ['state_id', 'district', 'status'];

    public function state(){
        return $this->belongsTo(State::class);
    }
}
