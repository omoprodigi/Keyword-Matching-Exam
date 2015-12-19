<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'courses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code', 'department_id', 'lecturer_id'];


    public function faculty()
    {
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }

    public function lecturer()
    {
        return $this->belongsTo('App\User', 'lecturer_id', 'id');
    }

}
