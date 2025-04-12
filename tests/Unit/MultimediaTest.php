<?php
namespace Tests\Unit;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Multimedia;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MultimediaTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_upload_file()
    {
        Storage::fake('public'); // Simula el sistema de fitxers per evitar escriure fitxers realment
        $user = \App\Models\User::factory()->create(); // Crea un usuari per simular la càrrega
        $file = UploadedFile::fake()->image('photo.jpg'); // Crea un fitxer d'imatge fals

        // Realitza la sol·licitud per crear el contingut multimedia
        $response = $this->actingAs($user)->postJson('/api/multimedia', [
            'file' => $file,
            'title' => 'Test Title',  // Afegim títol per a les dades
            'description' => 'Test Description',  // Afegim descripció per a les dades
        ]);

        // Comprova que la resposta sigui correcte (status 201) i que la base de dades s'ha actualitzat
        $response->assertStatus(201);
        $this->assertDatabaseHas('multimedia', ['user_id' => $user->id]);

        // Comprova si el fitxer s'ha desat correctament a l'emmagatzematge
        $this->assertTrue(Storage::disk('public')->exists('multimedia/'.$file->hashName()));
    }

    public function test_cannot_upload_file_without_authentication()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('photo.jpg');

        // Comprova que l'usuari no autenticat no pot pujar fitxers
        $response = $this->postJson('/api/multimedia', [
            'file' => $file,
        ]);

        // La resposta hauria de ser un error d'autenticació (401)
        $response->assertStatus(401);
    }

    public function test_cannot_upload_invalid_file_type()
    {
        Storage::fake('public');
        $user = \App\Models\User::factory()->create();
        // Crea un fitxer de tipus no permès (PDF en lloc d'imatge)
        $file = UploadedFile::fake()->create('document.pdf', 500, 'application/pdf');

        // Prova d'enviar el fitxer no permès
        $response = $this->actingAs($user)->postJson('/api/multimedia', [
            'file' => $file,
        ]);

        $response->assertStatus(500);
    }


}
