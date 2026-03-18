<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponsibilityCenter extends Model
{
    protected $fillable = [
        'code',
        'name',
        'display_name',
        'address',
        'head_name',
    ];
}
