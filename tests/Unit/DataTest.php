<?php

namespace Tests\Unit;

use App\Models\Data;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DataTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_generates_correct_file_names_for_export()
    {
        $data = Data::factory()->create(['timestamp' => '2023-01-27 23:00']);
        $this->assertEquals($data->id.'_20230127_230000_graph.pkl',$data->exportGraphFileName());
        $this->assertEquals($data->id.'_20230127_230000_globals.json',$data->exportGlobalsFileName());
    }

    public function test_it_writes_files_to_disk_and_cleans_up(){
        $data = Data::factory()->create(['timestamp' => '2023-01-27 23:00']);
        $outputPath = $data->dataSet->exportPath();
        Storage::fake('local');
        $this->assertTrue($data->exportToStorage());
        $this->assertTrue(Storage::has($outputPath . DIRECTORY_SEPARATOR . $data->exportGraphFileName()));
        $this->assertTrue(Storage::has($outputPath . DIRECTORY_SEPARATOR . $data->exportGlobalsFileName()));
        $this->assertTrue($data->deleteFromStorage($outputPath));
        $this->assertFalse(Storage::has($outputPath . DIRECTORY_SEPARATOR . $data->exportGraphFileName()));
        $this->assertFalse(Storage::has($outputPath . DIRECTORY_SEPARATOR . $data->exportGlobalsFileName()));
    }


}
