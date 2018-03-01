<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

///Patient's nominated care provider.This may be the primary care provider (in a GP context), or it may be a patient nominated care manager in a community/disablity setting, or even organization that will provide people to perform the care provider roles.

class Practitioner extends Model
{
    public function patient()
    {
        return $this->hasMany('App\Patient');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
