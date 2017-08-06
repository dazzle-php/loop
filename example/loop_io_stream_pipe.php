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
 * $> php ./example/loop_io_stream_pipe.php
 *
 * Following flags are supported to test example with different configurations:
 *
 * --model  : define model to use, default: select, supported: [ select ]
 *
 * Ex:
 * $> php ./example/loop_io_stream_pipe.php --model=select
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

if (stream_set_blocking(STDIN, false) !== true) {
    fwrite(STDERR, "ERROR: Unable to set STDIN non-blocking.\n");
    exit(1);
}

if (stream_set_blocking(STDOUT, false) !== true) {
    fwrite(STDERR, "ERROR: Unable to set STDOUT non-blocking.\n");
    exit(1);
}

$buffer = '';

$loop->addReadStream(STDIN, function($stream) use($loop, &$buffer) {
    $chunk = fread($stream, 64 * 1024);
    // reading nothing means we reached EOF
    if ($chunk === '') {
        $loop->removeReadStream($stream);
        return;
    }
    $buffer .= $chunk;
});

$loop->addWriteStream(STDOUT, function($stream) use($loop, &$buffer) {
    // try to write to output
    $r = fwrite($stream, $buffer);

    // nothing could be written, so stream is closed
    if ($buffer !== '' && $r === 0) {
        $loop->removeWriteStream($stream);
        fclose($stream);
        fwrite(STDERR, "Stopped because STDOUT closed\n");
        return;
    }

    $buffer = substr($buffer, $r);
});

$loop->start();
