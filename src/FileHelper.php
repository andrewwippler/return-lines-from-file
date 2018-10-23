<?php

namespace App;

use SplFileObject;

/**
 * FileHelper class
 */
class FileHelper
{
    protected $interval;
    protected $fileName;
    protected $redis;

    /**
     * Creates a file helper
     *
     * @param string $fileName Full path to file
     * @param any    $redis    Redis connection
     * @param int    $interval Interval of lines each run should produce
     */
    public function __construct($fileName, $redis, $interval)
    {
        $this->interval = $interval;
        $this->fileName = $fileName;
        $this->redis = $redis;
    }

    /**
     * Returns inverval number of lines in an array
     *
     * @return array
     **/
    public function getInterval()
    {
        $lines = [];
        $file = new SplFileObject($this->fileName);
        $file->seek($this->getTimesRun());
        while ($i < $this->interval) {
            $lines[] = trim($file->fgets());
            $i++;
        }
        return $lines;
    }

    /**
     * Returns start and end number of lines in an array
     *
     * @param int   $start Start line number
     * @param mixed $end   End line number
     *
     * @return array
     **/
    public function getRange($start, $end)
    {
        $lines = [];
        $file = new SplFileObject($this->fileName);
        $seek = $start-1;
        $file->seek($seek);
        
        if (!is_int($end)) {
            while (!$file->eof()) {
                $lines[] = trim($file->fgets());
            }
        } else {
            while ($seek < $end) {
                $thisLine = trim($file->fgets());
                // echo "$seek < $end = $thisLine\n";
                $lines[] = $thisLine;
                $seek++;
            }
        }

        return $lines;
    }

    /**
     * Times this function has been called
     *
     * @return int
     **/
    public function getTimesRun()
    {
        $times = $this->redis->incr("$this->fileName-timesRun-$this->interval");
        $correctTimes = ($times-1)*$this->interval;
        return $correctTimes;
    }
}
