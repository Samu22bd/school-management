<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;
    protected $table = "class"; // ga perlu bikin sebenernya karena nama tablenya sesuai
    // protected $primaryKey = "id"; //ga perlu bikin kalau namanya id
    // public $incrementing = false; 
    // protected $keyType = 'string'; //kabain kalau primary key bukan integer
    // public $timestamps = false; //kalau tanpa created atau updated

    public function ClassToStudents()
    {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }

    public function ClassToTeacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
}
