<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\CreateLangCacheJob;
use Illuminate\Http\Request;
use App\Language;
use Illuminate\Support\Facades\Cache;

class LanguageController extends Controller
{

    public function getTutorsByLang(Request $request, $languageSlug = '')
    {
        if ($languageSlug == '') return;


        $getTutorsByLangCache = Cache::get("getTutorsByLang", null);
        if ($getTutorsByLangCache) {
            return response()->json([$getTutorsByLangCache], 200);
        } else {
            try {
                dispatch(new CreateLangCacheJob($languageSlug));
                $getTutorsByLangCache = Cache::get("getTutorsByLang", null);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }

        return json_encode($getTutorsByLangCache);
    }

    public function create()
    {
        return view('language.create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::all();
        return view('language.index', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->exists('slug') && !Language::where('slug', $request->input('slug'))->exists()) {
            Language::create(['slug' => $request->input('slug')]);
        }
        return redirect(route('languages.index'));
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
