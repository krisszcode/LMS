<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_Submission_Score extends Model
{
    public function belongToAssigment(){

        return $this->belongsTo(assigmentPage::class);
    }

    public function belongsToUser(){

        return $this->belongsTo(User::class);
    }
}
