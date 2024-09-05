<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_type', 'device_model', 'manufacturer', 'installation_date', 'status', 'patient_id',
    ];

    /**
     * A device is assigned to a patient.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
