<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_id', 'first_name', 'last_name', 'company', 
        'city', 'country', 'phone1', 'phone2', 'email', 
        'subscription_date', 'website'
    ];
}
