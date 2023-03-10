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

    protected string $extraData;

    public function setUp(): void
    {
        parent::setUp();
        $this->dataDir = __DIR__.'/../data/20230110_103241';
        $this->extraData = __DIR__.'/../data/20230110_103417';
    }

    public function test_config_file_name()
    {
        // First we test valid path and file
        Config::set('ced2graph.config_file','config.yaml');
        $loader = new DataSetLoader($this->dataDir);
        $this->assertEquals($this->dataDir.'/config.yaml', $loader->configFile());

    }

    function test_it_gives_exception_on_invalid_path(){
        $this->expectException(LoadsFileException::class);
        $loader = new DataSetLoader(__DIR__.'/../data/no_such_path');
    }

    public function test_it_gives_exception_on_invalid_filename(){
        Config::set('ced2graph.config_file','not.config.yaml');  // Doesn't exist in dir below
        $this->expectException(LoadsFileException::class);
        $loader = new DataSetLoader($this->dataDir);
    }


    public function test_store_and_append_and_replace(){
        Config::set('ced2graph.config_file','config.yaml');
        $loader = new DataSetLoader($this->dataDir);
        $ds = $loader->store('a comment','a label');
        $this->assertEquals('a comment', $ds->comment);
        $this->assertNotNull($ds->id);
        $this->assertEquals($ds->config_md5, md5(file_get_contents($loader->configFile())));
        $this->assertCount(17, $ds->data);
        $this->assertEquals('a label', $ds->data->first()->label);

        // Append additional data
        $loader = new DataSetLoader($this->extraData);
        $loader->storeData($ds,'a label');
        $ds->load('data');      // refetch the collection from database
        $this->assertCount(25, $ds->data);
        $this->assertEquals('a label', $ds->data->last()->label);

        // We should be able to explicitly replace it
        $loader->replaceData($ds,'foo label');
        $ds->load('data');      // refetch the collection from database
        $this->assertCount(25, $ds->data);
        $this->assertEquals('foo label', $ds->data->last()->label);

        // But an exception to append existing data without stating intent to replace
        $loader = new DataSetLoader($this->extraData);
        // An exeption if we try to store same data again
        $this->expectException(LoadsFileException::class);
        $loader->storeData($ds,'foo label');
    }
}
