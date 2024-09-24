<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    use HasFactory;

    /**
     * The roles that belong to the Extracurricular
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ExtracurricularToStudent()
    {
        return $this->belongsToMany(Student::class, 'student_extracurricular',  'extracurricular_id', 'student_id');
        // return $this->belongsToMany(Student::class, 'student_extracurricular', 'student_id', 'extracurricular_id');

    }
}
