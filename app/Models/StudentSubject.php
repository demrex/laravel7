<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    use HasFactory;
    use HasFactory; 
    protected $table = 'student_subjects';
    protected $primaryKey = 'id';
    protected $fillable = ['subjectID', 'studentID'];
}
