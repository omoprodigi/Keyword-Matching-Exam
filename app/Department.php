<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'departments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code', 'faculty_id'];


    public function faculty()
    {
        return $this->belongsTo('App\Faculty', 'faculty_id', 'id');
    }

    
}
