<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Doctor;
use App\Models\AvailableSlot;
use Carbon\Carbon;

class GenerateDoctorSlots extends Command
{
    protected $signature = 'generate:doctor-slots';
    protected $description = 'Generate doctor slots for the next 7 days automatically';

    public function handle()
    {
        $doctors = Doctor::all();
        $startTime = "10:00";
        $endTime = "15:00";
        $slotDuration = 60; // 30-minute slots

        foreach ($doctors as $doctor) {
            for ($i = 1; $i <= 7; $i++) { // Next 7 days ke slots
                $date = Carbon::now()->addDays($i)->format('Y-m-d');

                $current = Carbon::parse($startTime);
                $end = Carbon::parse($endTime);

                while ($current < $end) {
                    AvailableSlot::updateOrCreate([
                        'doctor_id' => $doctor->id,
                        'date' => $date,
                        'start_time' => $current->format('H:i'),
                        'end_time' => $current->addMinutes($slotDuration)->format('H:i'),
                        'status' => 'available',
                    ]);
                }
            }
        }

        $this->info('Doctor slots generated successfully!');
    }
}
