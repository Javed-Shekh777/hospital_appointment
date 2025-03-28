<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    //
    use HasFactory;
 

 
    protected $fillable = ['user_id', 'speciality', 'education', 'experience', 'fees', 'about'];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function slots()
    {
        return $this->hasMany(AvailableSlot::class, 'doctor_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }
}
