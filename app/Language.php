<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug'];

    public function tutors()
    {
        return $this->belongsToMany('App\Tutor', 'tutor_languages', 'language_id', 'tutor_id');
    }
}
