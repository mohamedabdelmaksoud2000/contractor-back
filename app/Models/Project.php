<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class , 'supervisor_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class , 'client_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class , 'company_id');
    }
}
