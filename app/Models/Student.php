<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    public function StudentToClass()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id', 'id');
        
        // karena namanya reference_id ga perlu kasih kea dibawah
        // 'foreing_key' diisi penghubung ke table lain, 'other_key' diisi key pada tabel 
        // return $this->belongsTo(ClassRoom::class, 'foreign_key', 'other_key');
    }
    
    public function StudentToExtracurricular()
    {
        return $this->belongsToMany(Extracurricular::class, 'student_extracurricular', 'student_id', 'extracurricular_id');
    }

    protected $table = "students"; // ga perlu bikin sebenernya karena nama tablenya sesuai
    protected $primaryKey = "id"; //ga perlu bikin kalau namanya id
    // public $incrementing = false; 
    // protected $keyType = 'string'; //kabain kalau primary key bukan integer
    // public $timestamps = false; //kalau tanpa created atau updated
    
    // kalau mau insert pake eloquent melalui controller
    protected $fillable = [
        'name', 
        'gender', 
        'nis', 
        'class_id',
        'image',
    ];

    
}
