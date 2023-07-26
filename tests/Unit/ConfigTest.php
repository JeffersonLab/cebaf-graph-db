<?php

namespace Tests\Unit;

use App\Models\Config;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_its_factory_produces_good_yaml(): void
    {
        $config = Config::factory()->make();
        $yaml = yaml_parse($config->yaml);
        $this->assertNotFalse($yaml);
        $this->assertEquals('1h', $yaml['mya']['dates']['interval']);
        $this->assertEquals('1h', $config->retrieve('mya.dates.interval'));
        $this->assertTrue($config->save());
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_rejects_invalid_yaml(): void
    {
        $config = Config::factory()->make();
        $config->yaml = "This is just a sentence.\nAnd this is another.";
        $this->assertFalse($config->validate());
        $this->assertContains('The yaml formatting is not valid.', $config->errors()->all());
        // The snippet below is missing the required 'mya' key
        $config->yaml = "ced:\nnodes:\nedges:\noutput:";
        $this->assertFalse($config->validate());
        $this->assertFalse($config->save());
        $this->assertContains('The yaml lacks mya key.', $config->errors()->all());
    }
}
