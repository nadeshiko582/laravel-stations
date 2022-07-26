<?php

namespace Tests\Feature\LaravelStations\Station12;

use App\Models\Sheet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SheetTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group station12
     */
    public function testSeedコマンドでマスターデータが作成されるか(): void
    {
        $this->seed();
        $this->assertEquals(Sheet::count(), 15);
    }

    /**
     * @group station12
     */
    public function test座席一覧画面に全ての座席が表示されるか(): void
    {
        $this->seed();
        $response = $this->get('/sheets');
        $response->assertStatus(200);
        $sheets = Sheet::all();
        foreach ($sheets as $sheet) {
            $response->assertSeeText($sheet->row .'-'. $sheet->column);
        }
    }
}