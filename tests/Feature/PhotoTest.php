<?php

namespace Tests\Feature;

use App\Models\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhotoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_photos(): void
    {
        Photo::create([
            'data' => 'image_1.png',
            'description' => 'test_1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Photo::create([
            'data' => 'image_2.png',
            'description' => 'test_2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Photo::create([
            'data' => 'image_3.png',
            'description' => 'test_3',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
