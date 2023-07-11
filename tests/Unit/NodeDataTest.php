<?php

namespace Tests\Unit;

use App\Exceptions\NodeDataException;
use App\Utilities\NodeData;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class NodeDataTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp():void
    {
        parent::setUp();
        Config::set('ced2graph.node_file','node.dat');
        Config::set('ced2graph.type_file','info.dat');
        $this->nodeData = new NodeData(__DIR__ . '/../data/20230110_103241/20210913_000000');
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_value_is_retrieved()
    {
        // Expected value below is node number 69 on line 71 of the node.dat file
        $this->assertEquals(10.0473, $this->nodeData->value('IBC0L02','Current'));
    }
    public function test_it_gives_exception_on_invalid_field(){
        $this->expectException(NodeDataException::class);
        $this->assertEquals(10.0473, $this->nodeData->value('IBC0L02','NoSuchField'));
    }
    public function test_it_gives_exception_on_invalid_node(){
        $this->expectException(NodeDataException::class);
        $this->assertEquals(10.0473, $this->nodeData->value('NoSuchNode','Current'));
    }
}
