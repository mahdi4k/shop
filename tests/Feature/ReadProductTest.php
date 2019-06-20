<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadProductTest extends TestCase
{
    /**
     * 
     *
     * @test
     */
    public function testExample()
    {
        $this->get('/')->assertSee('طراحی وب سایت');
    }
}
