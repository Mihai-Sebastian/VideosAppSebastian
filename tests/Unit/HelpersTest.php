<?php

namespace Tests\Unit;

use App\Helpers\UserHelper;
use Tests\TestCase;
use App\Helpers\VideoHelper;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HelpersTest extends TestCase
{
    use RefreshDatabase; // Reinicia la base de dades abans de cada test

    /** @test */
    public function it_creates_default_videos()
    {
        UserHelper::create_regular_user();
        // Executem el helper per crear els vídeos
        VideoHelper::createDefaultVideo();
        // Verifiquem que s'han creat exactament 3 vídeos
        $this->assertEquals(3, Video::count());

        // Verificació del primer vídeo
        $video1 = Video::find(1);
        $this->assertEquals('Prova 1', $video1->title);
        $this->assertEquals('Video de prova', $video1->description);
        $this->assertEquals('https://www.youtube.com/embed/xiIDzCdOhmw?si=849tI9GK0X4P9V7E', $video1->url);
        $this->assertNull($video1->previous);
        $this->assertEquals(2, $video1->next);
        $this->assertEquals(1, $video1->series_id);

        // Verificació del segon vídeo
        $video2 = Video::find(2);
        $this->assertEquals('Prova 2', $video2->title);
        $this->assertEquals('Video de prova 2', $video2->description);
        $this->assertEquals('https://www.youtube.com/embed/ApD5pR9bC-o?si=TDOHH_AswnGfsjB4', $video2->url);
        $this->assertEquals(1, $video2->previous);
        $this->assertEquals(3, $video2->next);
        $this->assertEquals(1, $video2->series_id);

        // Verificació del tercer vídeo
        $video3 = Video::find(3);
        $this->assertEquals('Prova 3', $video3->title);
        $this->assertEquals('Video de prova 3', $video3->description);
        $this->assertEquals('https://www.youtube.com/embed/TJQgz1qKFVc?si=wPhIczbIEoaBnGBO', $video3->url);
        $this->assertEquals(2, $video3->previous);
        $this->assertNull($video3->next);
        $this->assertEquals(1, $video3->series_id);
    }
}
