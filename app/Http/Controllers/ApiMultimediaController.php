<?php

namespace App\Http\Controllers;

use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use Illuminate\Http\Request;
use App\Models\Multimedia;
use Illuminate\Support\Facades\Storage;

class ApiMultimediaController extends Controller
{
    // Mostra tots els vídeos de l'usuari autenticat
    public function index()
    {
        $multimedia = Multimedia::where('user_id', auth()->id())->get();
        return response()->json($multimedia);
    }

    // Mostra tots els vídeos amb la relació 'user' carregada
    public function all()
    {
        try {
            $videos = Multimedia::with('user')->get();
            return response()->json($videos, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No s\'han pogut carregar els vídeos.'], 500);
        }
    }

    // Emmagatzema un nou vídeo i crea la miniatura
    public function store(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimetypes:video/mp4,video/x-matroska,image/jpeg,image/png,image/gif,image/webp|max:51200',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $file = $request->file('file');
            $path = $file->store('multimedia', 'public');
            $thumbnailPath = null;

            // Processar només vídeos
            if (str_starts_with($file->getMimeType(), 'video/')) {
                $ffmpeg = FFMpeg::create();
                $video = $ffmpeg->open(storage_path('app/public/' . $path));

                // Crear directori de thumbnails
                $thumbnailDir = storage_path('app/public/multimedia/thumbnails');
                if (!file_exists($thumbnailDir)) {
                    mkdir($thumbnailDir, 0777, true);
                }

                // Generar thumbnail amb nom únic
                $thumbnailPath = 'multimedia/thumbnails/' . uniqid() . '.jpg';
                $video->frame(TimeCode::fromSeconds(1))
                    ->save(storage_path('app/public/' . $thumbnailPath));
            }

            $multimedia = Multimedia::create([
                'user_id' => auth()->id(),
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'type' => $file->getMimeType(),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'thumbnail_path' => $thumbnailPath,
            ]);

            return response()->json($multimedia, 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Retorna errors específics de validació
            return response()->json([
                'error' => $e->errors(),
                'received_data' => $request->all() // Per depuració
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTrace() : null
            ], 500);
        }
    }

    // Actualitza les dades d'un vídeo
    // Exemple d'ApiMultimediaController.php

    public function update(Request $request)
    {
        // Validar les dades
        $validated = $request->validate([
            'id' => 'required|exists:multimedia,id', // validem que el vídeo existeixi
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            // afegeix aquí la validació per altres camps
        ]);

        // Buscar el vídeo
        $video = Multimedia::find($request->id);

        if (!$video) {
            return response()->json(['message' => 'Vídeo no trobat'], 404);
        }

        // Comprovar si l'usuari actual és el propietari del vídeo
        if ($video->user_id !== auth()->id()) {
            return response()->json(['message' => 'No tens permís per modificar aquest vídeo'], 403);
        }

        // Intentar actualitzar les dades
        try {
            $video->update([
                'title' => $request->title,
                'description' => $request->description,
                // Actualitza altres camps si cal
            ]);

            return response()->json(['message' => 'Vídeo actualitzat correctament'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en actualitzar el vídeo', 'error' => $e->getMessage()], 500);
        }
    }






    public function show($id)
    {
        // Buscar el vídeo pel seu ID
        $video = Multimedia::find($id);

        // Comprovar si el vídeo existeix
        if (!$video) {
            return response()->json(['message' => 'Vídeo no trobat'], 404);
        }

        // Retornar la informació del vídeo en format JSON
        return response()->json($video, 200);
    }





    // Elimina un vídeo
    public function destroy($id)
    {
        $multimedia = Multimedia::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$multimedia) {
            return response()->json(['message' => 'No tens permís per eliminar aquest vídeo.'], 403);
        }

        // Eliminar el fitxer físicament
        Storage::disk('public')->delete($multimedia->file_path);
        Storage::disk('public')->delete($multimedia->thumbnail_path);

        // Eliminar el registre de la base de dades
        $multimedia->delete();

        return response()->json(['message' => 'Vídeo eliminat correctament.']);
    }

    // Mostra un vídeo amb vídeos relacionats de l'usuari
    public function showWithRelated($id)
    {
        $media = Multimedia::with('user')->findOrFail($id);

        // Obtenir vídeos relacionats (d'altres vídeos de l'usuari actual)
        $relatedVideos = Multimedia::where('user_id', $media->user_id)
            ->where('id', '!=', $media->id)
            ->limit(7)
            ->get();

        return response()->json([
            'media' => $media,
            'relatedVideos' => $relatedVideos,
        ]);
    }



}
