<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\CreateTutorCacheJob;
use App\Language;
use Illuminate\Http\Request;
use App\Tutor;
use App\TutorLanguage;
use App\TutorLessonPrice;
use Illuminate\Support\Facades\Cache;

class TutorController extends Controller
{

    public function getTutorByTutorSlug(Request $request, $tutorSlug = '')
    {
        if ($tutorSlug == '') return;


        $getTutorByTutorSlugCache = Cache::get("getTutorByTutorSlug", null);
        if ($getTutorByTutorSlugCache) {
            return response()->json([$getTutorByTutorSlugCache], 200);
        } else {
            try {
                dispatch(new CreateTutorCacheJob($tutorSlug));
                $getTutorByTutorSlugCache = Cache::get("getTutorByTutorSlug", null);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }

        return json_encode($getTutorByTutorSlugCache);
    }

    public function create()
    {
        $languages = Language::all();
        return view('tutor.create', compact('languages'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tutors = Tutor::all();
        return view('tutor.index', compact('tutors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->exists('slug') && $request->input('slug') != '' && !Tutor::where('slug', $request->input('slug'))->exists()) {
            $newTutor = Tutor::create([
                'slug' => $request->input('slug'),
                'name' => $request->input('name'),
                'headline' => $request->input('headline'),
                'introduction' => $request->input('introduction'),
            ]);
        }

        if ($request->exists('trial_price') && $request->exists('normal_price') && isset($newTutor)) {
            $tutorLessonPrice = TutorLessonPrice::where('tutor_id', $newTutor->id)->first();
            if ($tutorLessonPrice === null) {
                TutorLessonPrice::create([
                    'tutor_id' => $newTutor->id,
                    'trial_price' => $request->input('trial_price'),
                    'normal_price' => $request->input('normal_price')
                ]);
            } else {
                $tutorLessonPrice->update([
                    'trial_price' => $request->input('trial_price'),
                    'normal_price' => $request->input('normal_price')
                ]);
            }
        }

        if ($request->exists('languages') && isset($newTutor)) {
            foreach ($request->input('languages') as $value) {
                TutorLanguage::updateOrCreate(['tutor_id' => $newTutor->id, 'language_id' => $value]);
            }
        }

        return redirect(route('tutors.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('show');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('destroy');
    }
}
