<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    // Atributs mass assignables
    protected $fillable = ['title', 'description', 'url', 'published_at', 'previous', 'next', 'serie_id','user_id'];

    // Indicar que 'published_at' és una data
    protected $casts = [
        'published_at' => 'datetime',
    ];
    // Relació amb User (cada vídeo pertany a un usuari)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class, 'serie_id');
    }

    // Configurar Carbon perquè mostri les dates en català
    protected static function boot()
    {
        parent::boot();
        Carbon::setLocale('ca'); // Assegurar la localització en català
    }

    // Retorna la data en format llegible, tipus "13 de gener de 2025"
    public function getFormattedPublishedAtAttribute()
    {
        if (!$this->published_at) {
            return 'No publicat'; // Evita errors si la data és null
        }

        return Carbon::parse($this->published_at)->locale('ca')->isoFormat('D [de] MMMM [de] YYYY');
    }

    // Retorna la data com "fa 2 hores"
    public function getFormattedForHumansPublishedAtAttribute()
    {
        if (!$this->published_at) {
            return 'No publicat'; // Evita errors si la data és null
        }

        return $this->published_at->diffForHumans();
    }

    // Retorna el valor Unix timestamp de published_at
    public function getPublishedAtTimestampAttribute()
    {
        if (!$this->published_at) {
            return null; // Retorna null si no hi ha data
        }

        return $this->published_at->timestamp;
    }
}
