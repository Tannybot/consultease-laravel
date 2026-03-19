<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class WebUser extends Authenticatable
{
    use HasFactory;

    protected $table = 'webuser';
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['email', 'usertype', 'google_id', 'google_2fa_enabled'];

    protected $casts = [
        'google_2fa_enabled' => 'boolean',
    ];
}
