<?php
require __DIR__ . '/vendor/autoload.php';

$REDIS_HOST = $_ENV['REDIS_HOST'] ?? '127.0.0.1';

$redis = new Predis\Client(
    [
    'scheme' => 'tcp',
    'host'   => $REDIS_HOST,
    'port'   => 6379,
    ]
);

//set default values
$interval = $_GET['interval'] ?? 10;
$fileName = $_GET['file'];
$fullfilepath = __DIR__."/uploads/$fileName";
$start    = $_GET['start'];
$end      = $_GET['end'] ?? 'max';

if (empty($file)) {
    return JSONEncode(['message' => 'file cannot be empty']);
}

if (!file_exists($fullfilepath)) {
    return JSONEncode(['message' => 'the file does not exist on disk']);
}

$file = new App\FileHelper($fullfilepath, $redis, $interval);


if (!empty($interval) && empty($start)) {
    // Get a few lines
    foreach ($file->getInterval() as $l) {
        echo $l."\n";
    }
    exit;
} elseif (!empty($start)) {
    //loop until max
    foreach ($file->getRange($start, $end) as $l) {
        echo $l."\n";
    }
} else {
    return JSONEncode(['message' => 'I did not know how to handle this request.']);
}
