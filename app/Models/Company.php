<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    public $guarded = [];

    protected $casts = [
        'email' => 'array',
        'phone' => 'array'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class , 'user_id' ,'id');
    }

}
