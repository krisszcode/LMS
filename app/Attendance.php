<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public function user_attendance(){

        return $this->hasMany(User::class);
    }
}
//

