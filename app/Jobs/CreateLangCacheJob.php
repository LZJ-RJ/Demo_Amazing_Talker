<?php

namespace App\Jobs;

use App\Language;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class CreateLangCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $languageSlug = '';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($languageSlug = '')
    {
        $this->languageSlug = $languageSlug;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $languageSlug = $this->languageSlug;
        $result = array('data' => array());
        $language = Language::where('slug', $languageSlug)->first();
        if ($language !== null && $language->tutors != null) {
            foreach ($language->tutors as $tutor) {
                $tutorData = Arr::except($tutor->toArray(), ['created_at', 'updated_at', 'pivot']);

                $tutorData['price_info'] = Arr::except($tutor->lessonPrice->toArray(), ['id', 'tutor_id', 'created_at', 'updated_at']);

                $teachingLanguages = array();
                foreach ($tutor->languages->toArray() as $language) {
                    array_push($teachingLanguages, Arr::except($language, ['slug', 'pivot', 'created_at', 'updated_at'])['id']);
                }
                $tutorData['teaching_languages'] = $teachingLanguages;

                array_push($result['data'], $tutorData);
            }
        }
        Cache::put("getTutorsByLang", $result, 10 * 60);
    }
}
