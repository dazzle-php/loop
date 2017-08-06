<?php

/**
 * ---------------------------------------------------------------------------------------------------------------------
 * DESCRIPTION
 * ---------------------------------------------------------------------------------------------------------------------
 * This file contains the example of using streams in loop.
 *
 * ---------------------------------------------------------------------------------------------------------------------
 * USAGE
 * ---------------------------------------------------------------------------------------------------------------------
 * To run this example in CLI from project root use following syntax
 *
 * $> php ./example/loop_io_stream_source.php
 *
 * Following flags are supported to test example with different configurations:
 *
 * --model  : define model to use, default: select, supported: [ select ]
 *
 * Ex:
 * $> php ./example/loop_io_stream_source.php --model=select
 *
 * IMPORTANT!!!
 *
 * For the best result, use loop_io_stream_source.php and loop_io_stream_pipe.php together.
 *
 * Ex:
 * $> php ./example/loop_io_stream_source.php | php ./example/loop_io_stream_pipe.php
 * ---------------------------------------------------------------------------------------------------------------------
 */

$model = '';

require_once __DIR__ . '/bootstrap/autoload.php';

use Dazzle\Loop\Loop;

$loop = new Loop(new $model);

if (stream_set_blocking(STDOUT, false) !== true) {
    fwrite(STDERR, "ERROR: Unable to set STDOUT non-blocking.\n");
    exit(1);
}

$loop->addPeriodicTimer(0.25, function() {
    printf("NEW LINE\n");
});

$loop->start();
