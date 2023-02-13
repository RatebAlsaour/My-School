<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [

        'subject',
        'session_price',
        'salary',
        'employee_id',
        'time_table',

    ];

    public function employee()
    {
      return $this->belongsTo(Employee::class);

    }
    public function class_Teacher()
    {
      return $this->hasMany(Class_Teacher::class);

    }
    public function classes()
    {
      return $this->belongsToMany(ClassRoom::class,Class_Teacher::class , 'teacher_id','class_room_id','id','id');

    }
    public $with=['employee'];
}
