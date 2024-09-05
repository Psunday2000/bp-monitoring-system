<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CareGiver extends Model
{
    use HasFactory;

    protected $table = 'caregivers';

    protected $fillable = [
        'user_id', 'specialization', 'license_number',
    ];

    /**
     * Get the user that owns the caregiver.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the care points associated with the caregiver.
     */
    public function carePoints()
    {
        return $this->hasMany(CarePoint::class);
    }

    /**
     * Get the patients associated with the caregiver.
     */
    public function patients()
    {
        return $this->hasManyThrough(
            Patient::class,     // The related model
            CarePoint::class,   // The intermediate model
            'caregiver_id',     // Foreign key on the intermediate model
            'id',               // Foreign key on the related model
            'id',               // Local key on the parent model
            'patient_id'        // Local key on the intermediate model
        );
    }
}
