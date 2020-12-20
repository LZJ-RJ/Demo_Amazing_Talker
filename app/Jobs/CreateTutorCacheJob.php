<?php

namespace App\Jobs;

use App\Tutor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class CreateTutorCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tutorSlug = '';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($tutorSlug = '')
    {
        $this->tutorSlug = $tutorSlug;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tutorSlug = $this->tutorSlug;
        $result = array('data' => array());
        $tutor = Tutor::where('slug', $tutorSlug)->exclude(['created_at', 'updated_at'])->first();
        if ($tutor !== null) {
            $tutorData = $tutor->toArray();

            $tutorData['price_info'] = Arr::except($tutor->lessonPrice->toArray(), ['id', 'tutor_id', 'created_at', 'updated_at']);

            $teachingLanguages = array();
            foreach ($tutor->languages->toArray() as $language) {
                array_push($teachingLanguages, Arr::except($language, ['slug', 'pivot', 'created_at', 'updated_at'])['id']);
            }
            $tutorData['teaching_languages'] = $teachingLanguages;
            $result['data'] = $tutorData;
        }

        Cache::put("getTutorByTutorSlug", $result, 10 * 60);
    }
}
