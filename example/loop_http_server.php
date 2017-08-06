<?php

/**
 * ---------------------------------------------------------------------------------------------------------------------
 * DESCRIPTION
 * ---------------------------------------------------------------------------------------------------------------------
 * This file contains the example of creating simple HTTP/1.0 server using loop.
 *
 * ---------------------------------------------------------------------------------------------------------------------
 * USAGE
 * ---------------------------------------------------------------------------------------------------------------------
 * To run this example in CLI from project root use following syntax
 *
 * $> php ./example/loop_http_server.php
 *
 * Following flags are supported to test example with different configurations:
 *
 * --model  : define model to use, default: select, supported: [ select ]
 *
 * Ex:
 * $> php ./example/loop_http_server.php --model=select
 *
 * ---------------------------------------------------------------------------------------------------------------------
 */

$model = '';

require_once __DIR__ . '/bootstrap/autoload.php';

use Dazzle\Loop\Loop;

$loop = new Loop(new $model);

$server = stream_socket_server('tcp://127.0.0.1:8080');

if (stream_set_blocking($server, 0) !== true) {
    fwrite(STDERR, "ERROR: Unable to set server to non-blocking.\n");
    exit(1);
}

$loop->addReadStream($server, function($server) use($loop) {
    $conn = stream_socket_accept($server);
    $data = "HTTP/1.1 200 OK\r\nContent-Length: 11\r\n\r\nHello World\n";
    $loop->addWriteStream($conn, function($conn) use($loop, &$data) {
        $written = fwrite($conn, $data);
        if ($written === strlen($data)) {
            fclose($conn);
            $loop->removeStream($conn);
        } else {
            $data = substr($data, $written);
        }
    });
});

$loop->start();
