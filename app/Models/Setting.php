<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'group',
        'label',
        'type',
        'value',
    ];
    const GROUP = [
        'social' => 'social',
        'general' => 'general',
    ];
}
