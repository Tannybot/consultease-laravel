<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';
    protected $primaryKey = 'sid';
    public $timestamps = false;

    protected $fillable = ['semail', 'sname', 'spassword', 'saddress', 'snic', 'sdob', 'stel', 'profile_pic'];
}
