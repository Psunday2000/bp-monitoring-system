<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarePoint extends Model
{
    use HasFactory;

    protected $table = 'carepoints';

    protected $fillable = [
        'caregiver_id',
        'patient_id',
    ];

    /**
     * A CarePoint connects to a caregiver.
     */
    public function caregiver()
    {
        return $this->belongsTo(CareGiver::class, 'caregiver_id');
    }

    /**
     * A CarePoint connects to a patient.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
