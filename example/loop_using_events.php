<?php

/**
 * ---------------------------------------------------------------------------------------------------------------------
 * DESCRIPTION
 * ---------------------------------------------------------------------------------------------------------------------
 * This file contains the example of using start/stop listeners in loop.
 *
 * ---------------------------------------------------------------------------------------------------------------------
 * USAGE
 * ---------------------------------------------------------------------------------------------------------------------
 * To run this example in CLI from project root use following syntax
 *
 * $> php ./example/loop_using_events.php
 *
 * Following flags are supported to test example with different configurations:
 *
 * --model  : define model to use, default: select, supported: [ select ]
 *
 * Ex:
 * $> php ./example/loop_using_events.php --model=select
 *
 * ---------------------------------------------------------------------------------------------------------------------
 */

$model = '';

require_once __DIR__ . '/bootstrap/autoload.php';

use Dazzle\Loop\Loop;

$loop = new Loop(new $model);

$loop->onStart(function() {
    printf("This is 1st callback to be executed on event start.\n");
});
$loop->onStart(function() {
    printf("This is 2nd callback to be executed on event start.\n");
});
$loop->onStart(function() use($loop) {
    $loop->stop();
});
$loop->onStop(function() {
    printf("This is 1st callback to be executed on event stop.\n");
});
$loop->onStop(function() {
    printf("This is 2nd callback to be executed on event stop.\n");
});

$loop->start();
