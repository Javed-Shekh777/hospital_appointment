<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AvailableSlot extends Model
{
    use HasFactory;
  
    protected $fillable = ['doctor_id', 'date', 'time','start_time','end_time', 'status'];

    // Doctor Relation
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
