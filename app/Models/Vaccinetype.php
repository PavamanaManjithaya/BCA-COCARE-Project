<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccinetype extends Model
{
    use HasFactory;
    protected $fillable = ['vname', 'description', 'status', 'period', 'seconddose', 'cost'];

}
