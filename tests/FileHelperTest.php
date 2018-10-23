<?php

use PHPUnit\Framework\TestCase;
use App\FileHelper;

class FileHelperTest extends TestCase
{
    public $eight = [
        'this',
        'is',
        'a',
        'test',
        'file',
        'with',
        'eight',
        'lines'
    ];

    public function testGetRange()
    {
        $file = new FileHelper(__DIR__."/testfile.txt", null, 5);
        $three = $file->getRange(3, 5);
        $five = $file->getRange(1, 5);
        $eight = $file->getRange(1, 8);
        $max = $file->getRange(1, "max");

        $this->assertNotEquals($this->eight, $five);
        // print_r($three);
        $this->assertEquals(array_slice($this->eight, 3, 3), $three);
        
        $this->assertEquals($this->eight, $eight);
        $this->assertEquals($this->eight, $max);
        $this->assertEquals(array_slice($this->eight, 0, 5), $five);
    }

    public function testInterval()
    {
        $this->assertTrue(true);
    }
}
