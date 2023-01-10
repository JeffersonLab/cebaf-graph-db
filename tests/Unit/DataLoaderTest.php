<?php

namespace Tests\Unit;

use App\Exceptions\LoadsFileException;
use App\Models\DataLoader;
use App\Models\DataSet;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class DataLoaderTest extends TestCase
{
    use DatabaseTransactions;

    protected string $dataDir;

    public function setUp(): void
    {
        parent::setUp();
        $this->dataDir = __DIR__.'/../data/20230110_103241/20210910_000000';

    }

    public function test_graph_file_name()
    {
        $ds = DataSet::factory()->create();

        // First we test valid path and file
        Config::set('ced2graph.graph_file','graph.pkl');
        $loader = new DataLoader($this->dataDir, $ds);
        $this->assertEquals($this->dataDir.'/graph.pkl', $loader->graphFile());

        // Then we test invalid path
        $this->expectException(LoadsFileException::class);
        $loader = new DataLoader(__DIR__.'/../data/no_such_path', $ds);

        // and invalid file name
        Config::set('ced2graph.graph_file','not.graph.pkl');  // Doesn't exist in dir below
        $this->expectException(LoadsFileException::class);
        $loader = new DataLoader($this->dataDir, $ds);

    }

    public function test_store(){
        Config::set('ced2graph.graph_file','graph.pkl');
        $ds = DataSet::factory()->create();
        $loader = new DataLoader($this->dataDir, $ds);
        $data = $loader->store('GOOD');
        $this->assertNotNull($data->id);
        $this->assertEquals('GOOD', $data->label);
        $this->assertEquals(md5($data->graph), md5(file_get_contents($loader->graphFile())));
        $this->assertEquals($ds->id, $data->dataSet->id);
        // TODO timestamp assertion
    }

}
