<?php

namespace Tests\Feature;

use Tests\TestCase;

class CalendarPageTest extends TestCase
{
    public function test_calendar_page_loads_with_book_option(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSee('Option C · Book Calendar')
            ->assertSee('M')
            ->assertSee('K')
            ->assertSee('J');
    }

    public function test_calendar_page_applies_query_customization(): void
    {
        $response = $this->get('/?month=11&year=2030&title=Cog%20Ledger&description=Steam%20notes&palette=royal&font=serif');

        $response->assertStatus(200)
            ->assertSee('November 2030')
            ->assertSee('Cog Ledger')
            ->assertSee('Steam notes')
            ->assertSee('Royal Brass')
            ->assertSee('Classic Serif');
    }
}
