<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'addresse_id', 'payment_method', 'total_amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Addresse::class, 'addresse_id'); // Ensure the foreign key matches
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }
}
