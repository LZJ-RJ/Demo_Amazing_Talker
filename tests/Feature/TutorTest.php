<?php

namespace Tests\Feature;

use App\Language;
use App\Tutor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TutorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function testTutor()
    {
        $slug = $this->generateRandomString();
        $name = $this->generateRandomString();
        $headline = $this->generateRandomString();
        $introduction = $this->generateRandomString();

        $response = $this->post(route('languages.store'), [
            'slug' => $slug,
        ]);
        $response->assertRedirect(route('languages.index'));
        $response->assertStatus(302);

        $language = Language::where('slug', $slug)->first();
        $response = $this->post(route('tutors.store'), [
            'slug' => $slug,
            'name' => $name,
            'headline' => $headline,
            'introduction' => $introduction,
            'trial_price' => 123,
            'normal_price' => 456,
            'languages' => [$language->id],
        ]);
        $tutor = Tutor::where('slug', $slug)->first();
        $response->assertRedirect(route('tutors.index'));
        $response->assertStatus(302);

        $response = $this->get('/api/tutor/' . $slug);
        $response
            ->assertStatus(200)
            ->assertExactJson(
                ['data' =>
                    [
                        'id' => $tutor->id,
                        'slug' => $slug,
                        'name' => $name,
                        'headline' => $headline,
                        'introduction' => $introduction,
                        'price_info' => [
                            'trial_price' => 123,
                            'normal_price' => 456,
                        ],
                        'teaching_languages' => [
                            0 => $language->id
                        ]
                    ]
                ]);
    }
}
