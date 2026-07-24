<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

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
