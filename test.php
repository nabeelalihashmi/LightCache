<?php

use IconicCodes\LightCache\FilesCache;

require 'vendor/autoload.php';

$cache = new FilesCache;

$cache->cachedir = __DIR__ . "/cache";

$item = $cache->get('test_cache_1', function() {
    return [ uniqid(), time() + 5];
});

$count = 0;
$oldItem = $item;
while ($count < 7) {
    $item = $cache->get('test_cache_1', function() {
        return [ uniqid(), time() + 5];
    });

    if($count < 5) {
        $test = 'testEq';
        $exp = 'cached for';
    } else {
        $test = 'testNotEq';
        $exp = 'expired after';
    }
    $test_num = $count + 1;
    $test($item, $oldItem, "Test ${test_num} \nExpected item to be $exp 5 seconds");
    $count++;
    sleep(1);
}




function testNotEq($expect, $output, $message) {
    echo "\n$message \n";
    echo 'not expected value: '  . $expect . "\n";
    echo 'output value: ' . $output . "\n";

    if ($expect !== $output) {
        echo "TEST OK \n";
    } else {
        echo "TEST FAIL \n";
    }

    echo "\n-----------------------------------\n";

}

function testEq($expect, $output, $message) {
    echo "\n$message \n";
    echo 'expected value: '  . $expect . "\n";
    echo 'output value: ' . $output . "\n";

    if ($expect === $output) {
        echo "TEST OK \n";
    } else {
        echo "TEST FAIL \n";
    }

    echo "\n-----------------------------------\n";

}