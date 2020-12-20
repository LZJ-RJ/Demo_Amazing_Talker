<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorLessonPrice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tutor_id', 'trial_price', 'normal_price'];

    public function tutor()
    {
        return $this->belongsTo('App\Tutor');
    }
}
