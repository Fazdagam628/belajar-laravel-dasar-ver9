<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInput()
    {
        $this->get('/input/hello?name=fauzan')->assertSeeText("Hello, fauzan");
        $this->post("/input/hello", [
            'name' => 'fauzan'
        ])->assertSeeText("Hello, fauzan");
    }

    public function testInputNested()
    {
        $this->post("/input/hello/first", [
            'name' => [
                'first' => 'fauzan',
                'last' => 'Masud Ramadhani',
            ]
        ])->assertSeeText("Hello, fauzan");
    }

    public function testInputAll()
    {

        $this->post("/input/hello/input", [
            'name' => [
                'first' => 'Fauzan',
                'last' => 'Masud Ramadhani',
            ]
        ])->assertSeeText("name")
            ->assertSeeText("first")
            ->assertSeeText("last")
            ->assertSeeText("Fauzan")
            ->assertSeeText("Masud Ramadhani");
    }
    public function testAll()
    {

        $this->post("/input/hello/array", [
            'products' => [
                [
                    'name' => 'Laptop',
                    'price' => 5000000
                ],
                [
                    'name' => 'PS4',
                    'price' => 3500000

                ]
            ]
        ])->assertSeeText("Laptop")
            ->assertSeeText("PS4");
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Fauzan',
            'married' => 'false',
            'birth_date' => '2007-09-26',
        ])->assertSeeText('Fauzan')->assertSeeText('false')->assertSeeText('2007-09-26');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Fauzan",
                "middle" => "Masud",
                "last" => "Ramadhani"
            ]
        ])->assertSeeText("Fauzan")
            ->assertDontSeeText("Masud")
            ->assertSeeText("Ramadhani");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            "username" => "Fauzan",
            "admin" => true,
            "password" => "password"
        ])->assertSeeText("Fauzan")
            ->assertDontSeeText("admin")
            ->assertSeeText("password");;
    }
    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "Fauzan",
            "admin" => true,
            "password" => "password"
        ])->assertSeeText("Fauzan")
            ->assertSeeText("admin")
            ->assertSeeText("false")
            ->assertSeeText("password");;
    }
}