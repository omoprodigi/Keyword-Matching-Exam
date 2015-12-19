<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faculties';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code'];


    public function departments()
    {
        return $this->hasMany('App\Department', 'faculty_id', 'id');
    }
   
}
