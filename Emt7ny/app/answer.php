<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class answer extends Model
{
    public $incrementing = false;
    protected $fillable = ['studentId', 'questionId', 'answer'];
}
