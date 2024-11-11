<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addresse extends Model
{
    protected $fillable = ['address_line1','address_line2','city','state','postal_code','country','user_id'];

    public function users(){
    return $this->belongsTo(User::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'addresse_id'); // This is based on your foreign key naming
    }
}
