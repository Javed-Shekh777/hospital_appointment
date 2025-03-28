<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    //
    use HasFactory;
   

    protected $fillable = ['patient_id', 'doctor_id', 'status', 'payment_status','slot_id','payment_id'];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function slot()
    {
        return $this->belongsTo(AvailableSlot::class,'slot_id');
    }


}
