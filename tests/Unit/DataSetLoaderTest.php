<?php

namespace Tests\Unit;

use App\Exceptions\LoadsFileException;
use App\Models\DataSetLoader;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class DataSetLoaderTest extends TestCase
{
    use DatabaseTransactions;

    protected string $dataDir;

    public function setUp(): void
    {
        parent::setUp();
        $this->dataDir = __DIR__.'/../data/20221221_092324';

    }

    public function test_config_file_name()
    {
        // First we test valid path and file
        Config::set('ced2graph.config_file','config.yaml');
        $loader = new DataSetLoader($this->dataDir);
        $this->assertEquals($this->dataDir.'/config.yaml', $loader->configFile());

        // Then we test invalid path
        $this->expectException(LoadsFileException::class);
        $loader = new DataSetLoader(__DIR__.'/../data/no_such_path');

        // and invalid file name
        Config::set('ced2graph.config_file','not.config.yaml');  // Doesn't exist in dir below
        $this->expectException(LoadsFileException::class);
        $loader = new DataSetLoader($this->dataDir);
    }

    public function test_store(){
        Config::set('ced2graph.config_file','config.yaml');
        $loader = new DataSetLoader($this->dataDir);
        $ds = $loader->store('a comment','a label');
        $this->assertEquals('a comment', $ds->comment);
        $this->assertNotNull($ds->id);
        $this->assertEquals($ds->config_md5, md5(file_get_contents($loader->configFile())));
        $this->assertCount(17, $ds->data);
        $this->assertEquals('a label', $ds->data->first()->label);
    }
}
