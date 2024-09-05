<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'medical_history', 'current_medications', 'emergency_contact',
    ];

    /**
     * Get the user that owns the patient.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the care points associated with the patient.
     */
    public function carePoints()
    {
        return $this->hasMany(CarePoint::class);
    }

    /**
     * Get the caregiver for the patient.
     */
    public function caregiver()
    {
        return $this->hasOneThrough(
            CareGiver::class,    // The related model
            CarePoint::class,    // The intermediate model
            'patient_id',        // Foreign key on the intermediate model
            'id',                // Foreign key on the related model
            'id',                // Local key on the parent model
            'caregiver_id'       // Local key on the intermediate model
        );
    }

    public function device()
    {
        return $this->hasOne(Device::class);
    }

}
