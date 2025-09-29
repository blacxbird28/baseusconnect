<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    //
    protected $fillable = [
        'nama', 'no_ktp', 'domisili', 'alamat', 'email', 'no_hp',
        'tgl_lahir', 'gender', 'gol_darah', 'job', 'emergency_contact_name', 'emergency_contact_number',
        'bib_number', 'size', 'medical_record', 'hh', 'mm', 'ss',
        'community_name', 'instagram', 'tiktok', 'partner_desc', 'upload_transfer'
    ];
}
