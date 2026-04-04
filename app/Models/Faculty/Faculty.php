<?php

namespace App\Models\Faculty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculty';
    protected $primaryKey = 'facid';
    public $timestamps = false;

    protected $fillable = ['facemail', 'facname', 'facpassword', 'factel', 'subject', 'profile_pic'];
}
