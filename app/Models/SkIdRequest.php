<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkIdRequest extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'middle_name', 'last_name', 'suffix',
        'dob', 'gender', 'blood_type', 'address', 'contact_number',
        'emergency_contact_name', 'emergency_contact_number',
        'id_photo_path', 'signature_path', 'status', 'remarks',
        'emergency_contact_address',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    // A request belongs to a specific user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
