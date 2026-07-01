<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Register extends BaseModel
{
    public $guarded = ['id'];

    /** @use HasFactory<\Database\Factories\RegisterFactory> */
    use HasFactory;
}
