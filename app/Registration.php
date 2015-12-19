<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'registrations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['course_id','student_id'];


}
