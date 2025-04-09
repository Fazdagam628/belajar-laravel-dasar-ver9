<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Tests\TestCase;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals("Foo", $foo->foo());
        self::assertEquals("Foo", $foo2->foo());
        self::assertSame($foo, $foo2);
        // self::assertNotSame($foo, $foo2);
    }

    public function testBind()
    {
        // $person = $this->app->make(Person::class);
        // self::assertNotNull($person); //error code

        $this->app->bind(Person::class, function ($app) {
            return new Person("Fauzan", "masud Ramadhani");
        });

        $person1 = $this->app->make(Person::class); //closure() // new Person("Fauzan", "masud Ramadhani")
        $person2 = $this->app->make(Person::class); //closure() // new Person("Fauzan", "masud Ramadhani")

        self::assertEquals("Fauzan", $person1->firstName);
        self::assertEquals("Fauzan", $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        // $person = $this->app->make(Person::class);
        // self::assertNotNull($person); //error code

        $this->app->singleton(Person::class, function ($app) {
            return new Person("Fauzan", "masud Ramadhani");
        });

        $person1 = $this->app->make(Person::class); // new Person("Fauzan", "masud Ramadhani"); // if not exists
        $person2 = $this->app->make(Person::class); //return existing

        self::assertEquals("Fauzan", $person1->firstName);
        self::assertEquals("Fauzan", $person2->firstName);
        self::assertSame($person1, $person2); //Object yang sama
    }

    public function testInstance()
    {
        // $person = $this->app->make(Person::class);
        // self::assertNotNull($person); //error code
        $person = new Person("Fauzan", "masud Ramadhani");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // new Person("Fauzan", "masud Ramadhani"); // if not exists
        $person2 = $this->app->make(Person::class); //return existing

        self::assertEquals("Fauzan", $person1->firstName);
        self::assertEquals("Fauzan", $person2->firstName);
        self::assertSame($person1, $person2); //Object yang sama
    }

    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app) {
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        // self::assertNotSame($foo, $bar->foo);
        self::assertSame($foo, $bar1->foo);

        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);
        $this->app->singleton(HelloService::class, function ($app) {
            return new HelloServiceIndonesia();
        });
        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Halo Fauzan', $helloService->hello('Fauzan'));
    }
}
