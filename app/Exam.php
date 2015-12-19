<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'examinations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['course_id','student_id', 'score_percentage'];
}
