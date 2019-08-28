<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    protected $guarded = ['id'];

    public function choices()
    {
        return $this->hasMany(choice_question::class, 'questionId');
    }

    public function pictures()
    {
        return $this->hasMany(picture_question::class, 'questionId');
    }
}
