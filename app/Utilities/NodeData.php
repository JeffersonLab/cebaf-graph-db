<?php

namespace App\Utilities;

use App\Exceptions\LoadsFileException;
use App\Exceptions\NodeDataException;
use App\Traits\LoadsFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class helper for working with node.dat files produced by ced2graph.
 */
class NodeData
{
    use LoadsFile;

    /**
     * @var array
     */
    public $typeData = [];

    /**
     * @var
     */
    public $nodeData;

    /**
     * @param string $path
     * @throws LoadsFileException
     */
    public function __construct(string $path)
    {
        $this->path = $path;
        $this->assertPathIsReadable($this->path);
        $this->assertPathHasFile($this->typeDataFile());
        $this->assertPathHasFile($this->nodeDataFile());
        $this->buildTypeData();
        $this->buildNodeData();
    }

    /**
     * The full path to the file containing type info data.
     *
     * @return string
     */
    protected function typeDataFile()
    {
        return $this->path . DIRECTORY_SEPARATOR . 'info.dat';
    }

    /**
     * The full path to file containg nonde data.
     *
     * @return string
     */
    protected function nodeDataFile()
    {
        return $this->path . DIRECTORY_SEPARATOR . 'node.dat';
    }

    /**
     * Create the typeData array from data file.
     *
     * @return void
     */
    protected function buildTypeData(): void
    {
        $this->typeData = [];
        foreach (file($this->typeDataFile(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            $items = preg_split("/[\t\s]+/", $line);
            $id = $items[0];
            // Skip the first headings line
            if ($id == 'TYPE') {
                continue;
            }
            // We flip the array so that we can use string keys to find numeric positions
            $fields = array_flip(explode(",", $items[2]));
            $this->typeData[$id] = $fields;
        }
    }

    /**
     * Create the nodeData array from data file.
     *
     * @return void
     */
    protected function buildNodeData(): void
    {
        $this->nodeData = [];
        foreach (file($this->nodeDataFile(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            $items = preg_split("/[\t\s]+/", $line);
            $name = $items[1];      // not interested in id of column 0
            $type = $items[2];
            // Skip the first headings line
            if ($name == 'NAME') {
                continue;
            }
            $values = explode(",", $items[3]);
            $this->nodeData[$name] = [
                'type' => $type,
                'values' => $values,
            ];
        }
    }

    /**
     * The get value of a node field.
     *
     * @param string $node
     * @param string $field
     * @return mixed
     * @throws NodeDataException
     */
    public function value($node, $field) : mixed
    {
        $type = null;
        $values = [];

        if (array_key_exists($node, $this->nodeData)) {
            $type = $this->nodeData[$node]['type'];
            $values = $this->nodeData[$node]['values'];
        } else {
            throw new NodeDataException("Unable to find $node in {$this->nodeDataFile()}");
        }

        if (array_key_exists($type, $this->typeData) && array_key_exists($field, $this->typeData[$type])) {
            $index = $this->typeData[$type][$field];
        } else {
            throw new NodeDataException("Unable to find type info for $node, $field in {$this->typeDataFile()}");
        }

        if (array_key_exists($node, $this->nodeData)) {
            return $values[$index];
        }
        throw new NodeDataException("No data for $field of $node.");

    }
}
