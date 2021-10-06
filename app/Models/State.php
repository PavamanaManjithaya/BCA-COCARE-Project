<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;
use App\Models\User;
class State extends Model
{
    use HasFactory;
    protected $fillable = ['state', 'status'];

    
}
