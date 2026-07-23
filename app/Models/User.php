<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function userDetails()
    {   
        //cada usuario pode ter um user_details.
        return $this->hasOne(UserDetail::class);
    }

    public function department()
    {
        //este usuario pertence a um departamento.
        return $this->belongsTo(Department::class);
    }

}
