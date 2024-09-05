<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VitalSign extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'device_id', 'blood_pressure', 'pulse_rate', 'timestamp',
    ];

    /**
     * Vital signs are associated with a patient and a device.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
