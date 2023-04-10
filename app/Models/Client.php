<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable=[
        'first_name',
        'last_name',
        'email',
        'phone',
        'name_company',
        'link_website',
        'link_facebook',
        'link_twitter',
        'link_youtube',
        'link_linkedin',
        'address_1',
        'address_2',
        'country',
        'governorate',
        'city',
        'zip_code',
        'user_id'
    ];

    protected $casts = [
        'email' => 'array',
        'phone' => 'array'
    ];

    

}
