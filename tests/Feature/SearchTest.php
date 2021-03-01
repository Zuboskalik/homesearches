<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPageOpen()
    {
        $this->visit('/')
             ->type('0', 'pricemin')
             ->dontSee('No results found...');
    }
    public function testPriceMinCorrect()
    {
        $this->visit('/')
             ->type('0', 'pricemin')
             ->dontSee('No results found...');
    }
    public function testPriceMaxCorrect()
    {
        $this->visit('/')
             ->type('0', 'pricemax')
             ->see('No results found...');
    }
}
