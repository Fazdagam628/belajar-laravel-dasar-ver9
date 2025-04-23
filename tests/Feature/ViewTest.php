<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText("Hello, Fauzan");

        $this->get('/hello-again')
            ->assertSeeText("Hello, Fauzan");
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText("World, Fauzan");
    }

    public function testTemplate()
    {
        $this->view("hello", ["name" => "Fauzan"])
            ->assertSeeText("Hello, Fauzan");

        $this->view("hello.world", ["name" => "Fauzan"])
            ->assertSeeText("World, Fauzan");
    }
}
