<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorLanguage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tutor_id', 'language_id'];
}
