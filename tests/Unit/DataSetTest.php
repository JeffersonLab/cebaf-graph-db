<?php

namespace Tests\Unit;

use App\Models\Data;
use App\Models\DataSet;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DataSetTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic unit test example.
     */
    public function test_its_factory_produces_valid_model(): void
    {
        $dataSet = DataSet::factory()->make();
        $dataSet->validate();
        $this->assertTrue($dataSet->save());
    }

    public function test_it_exports_to_disk_and_cleans_up(): void
    {
        $set = DataSet::factory()->create();
        foreach (['2023-01-28 00:00', '2023-01-28 01:00', '2023-01-28 02:00'] as $ts) {
            $data = Data::factory()->create(['timestamp' => $ts, 'data_set_id' => $set->id]);
        }
        $set->load('data');

        Storage::fake('local');
        $set->exportToStorage();

        $outputPath = $set->exportPath();
        foreach ($set->data as $datum) {
            $this->assertTrue(Storage::has($outputPath.DIRECTORY_SEPARATOR.$datum->exportGraphFileName()));
            $this->assertTrue(Storage::has($outputPath.DIRECTORY_SEPARATOR.$datum->exportGlobalsFileName()));
        }

        $set->deleteFromStorage();
        foreach ($set->data as $datum) {
            $this->assertFalse(Storage::has($outputPath.DIRECTORY_SEPARATOR.$datum->exportGraphFileName()));
            $this->assertFalse(Storage::has($outputPath.DIRECTORY_SEPARATOR.$datum->exportGlobalsFileName()));
        }
    }

    public function test_it_write_to_a_zip_file(): void
    {
        $set = DataSet::factory()->create();
        foreach (['2023-01-28 00:00', '2023-01-28 01:00', '2023-01-28 02:00'] as $ts) {
            $data = Data::factory()->create(['timestamp' => $ts, 'data_set_id' => $set->id]);
        }
        $set->load('data');

        Storage::fake('public');
        $writtenZip = $set->makePublicZipFile();
        $this->assertTrue(file_exists($writtenZip));
        $this->assertEquals($writtenZip, Storage::path('public').DIRECTORY_SEPARATOR.$set->publicZipFile());
    }
}
