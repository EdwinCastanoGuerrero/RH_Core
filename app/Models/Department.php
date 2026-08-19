<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function users()
    {   
        //uma usuario pode ter muitos departamentos.
        return $this->belongsToMany(User::class);
    }

    public function isEditableOrDeletable(): bool
    {
        return !in_array($this->id, [1, 2]);
    }

}
