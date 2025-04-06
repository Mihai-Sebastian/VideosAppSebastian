<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MultimediaTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_upload_file()
    {
        Storage::fake('public');
        $user = \App\Models\User::factory()->create();
        $file = UploadedFile::fake()->image('photo.jpg');

        $response = $this->actingAs($user)->postJson('/api/multimedia', [
            'file' => $file,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('multimedia', ['user_id' => $user->id]);
    }

    public function test_cannot_upload_file_without_authentication()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('photo.jpg');

        $response = $this->postJson('/api/multimedia', [
            'file' => $file,
        ]);

        $response->assertStatus(401);
    }

    public function test_cannot_upload_invalid_file_type()
    {
        Storage::fake('public');
        $user = \App\Models\User::factory()->create();
        $file = UploadedFile::fake()->create('document.pdf', 500, 'application/pdf');

        $response = $this->actingAs($user)->postJson('/api/multimedia', [
            'file' => $file,
        ]);

        $response->assertStatus(422)
        ->assertJsonValidationErrors(['file']);
    }


}
