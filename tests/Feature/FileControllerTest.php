<?php

namespace Tests\Feature;

// use GuzzleHttp\Psr7\UploadedFile;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileControllerTest extends TestCase
{
    public function testUpload()
    {
        $picture = UploadedFile::fake()->image("fauzan.png");

        $this->post('/file/upload', [
            'picture' => $picture
        ])->assertSeeText("OK fauzan.png");
    }
}
