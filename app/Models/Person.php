<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';

    protected $fillable = [
    	'name', 'winning_number1', 'winning_number2', 'winning_number3', 'winning_number4', 'winning_number5'
    ];
}
