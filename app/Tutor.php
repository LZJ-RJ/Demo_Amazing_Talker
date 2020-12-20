<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'name', 'headline', 'introduction'];

    protected $columns = ['id', 'slug', 'name', 'headline', 'introduction'];

    public function scopeExclude($query, $value = [])
    {
        return $query->select(array_diff($this->columns, (array)$value));
    }

    public function getLanguages($id = 0)
    {
        if ($id == 0) return;

        $getTutorLanguages = TutorLanguage::where('tutor_id', $id)->get();
        $languages = array();
        if ($getTutorLanguages !== null) {
            foreach ($getTutorLanguages as $language) {
                if (($tmpLanguages = Language::find($language->language_id)) !== null) {
                    array_push($languages, $tmpLanguages->slug);
                }
            }
        }
        return $languages;
    }

    public function getTrialPrice($id = 0)
    {
        if ($id == 0) return;

        $getTutorLessonPrice = TutorLessonPrice::where('tutor_id', $id)->first();
        $trialPrice = 0;
        if ($getTutorLessonPrice !== null) {
            $trialPrice = $getTutorLessonPrice->trial_price;
        }
        return $trialPrice;
    }

    public function getNormalPrice($id = 0)
    {
        if ($id == 0) return;

        $getTutorLessonPrice = TutorLessonPrice::where('tutor_id', $id)->first();
        $normalPrice = 0;
        if ($getTutorLessonPrice !== null) {
            $normalPrice = $getTutorLessonPrice->normal_price;
        }
        return $normalPrice;
    }

    public function languages()
    {
        return $this->belongsToMany('App\Language', 'tutor_languages', 'tutor_id', 'language_id');
    }

    public function lessonPrice()
    {
        return $this->hasOne('App\TutorLessonPrice');
    }
}
