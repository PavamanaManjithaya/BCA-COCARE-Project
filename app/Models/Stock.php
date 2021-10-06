<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','district_id','vaccinecenter_id', 'vaccinetype_id', 'date', 'qty','sage','eage','dose','status','stock_id'];

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function vaccinetype(){
        return $this->belongsTo(Vaccinetype::class);
    }
    public function vaccinecenter(){
        return $this->belongsTo(Vaccinecenter::class);
    }
}
