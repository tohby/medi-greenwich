<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientInfo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patientId', 'dob', 'height', 'weight'
    ];

    /**
     * Get the patient that owns the appointment.
     */
    public function patient()
    {
        return $this->belongsTo(User::class, 'patientId');
    }
}
