<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
   public function testResponse() {
        $this->get('/response/hello')->assertStatus(200)->assertSeeText("hello response");
   }

   public function testHeader() {
    $this->get('/response/header')
    ->assertStatus(200)
    ->assertSeeText("Fauzan")->assertSeeText("Masud Ramadhani")
    ->assertHeader('Content-Type', 'application/json')
    ->assertHeader('Author', 'Programmer Zaman Now')
    ->assertHeader('App', 'Belajar laravel');
   }

   public function testView() {
        $this->get('/response/type/view')
            ->assertSeeText('Hello, Fauzan');
   }

   public function testJson() {
        $this->get('/response/type/json')
            ->assertJson([
                'firstName' => 'Fauzan',
                'lastName' => 'Masud Ramadhani'
            ]);
   }

   public function testFile(){
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/png');
   }

   public function testDownload(){
        $this->get('/response/type/download')
            ->assertDownload('fauzan.png');
   }
}
