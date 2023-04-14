<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;
    //  public $guarded = [];
     protected $fillable = [
        'name',
        'describe',
        'image',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class , 'company_id','id');
    }

}
