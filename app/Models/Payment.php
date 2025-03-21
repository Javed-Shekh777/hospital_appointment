<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    //
    use HasFactory;

    protected $fillable = ['appointment_id', 'user_id', 'amount', 'payment_status', 'payment_method', 'transaction_id'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
