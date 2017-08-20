<?php

/**
 * ---------------------------------------------------------------------------------------------------------------------
 * DESCRIPTION
 * ---------------------------------------------------------------------------------------------------------------------
 * This file contains the benchmark of Dazzle Loop package.
 * Benchmark has been run according to the library v0.5
 *
 * ---------------------------------------------------------------------------------------------------------------------
 * USAGE
 * ---------------------------------------------------------------------------------------------------------------------
 * To run this example in CLI from project root use following syntax. Make sure you install all externally referenced
 * libraries.
 *
 * $> php ./example-bench/benchmark-on.php
 *
 * ---------------------------------------------------------------------------------------------------------------------
 */

$model = '';

require_once __DIR__ . '/bootstrap/autoload.php';

use Dazzle\Loop\Loop;

$loop = new Loop(new $model);
$bufferSize = 1024;
$bufferText = str_repeat('.', $bufferSize-1) . "\n";
$ticks  = 1e5;
$timers = 1e4;
$writes = 1e4;
$reads  = 1e4;
$all = $ticks + $timers + $writes + $reads;

$stream = fopen('php://temp', 'w+');

if (!$stream) {
    fwrite(STDERR, "ERROR: Stream could not be opened!\n");
    exit(1);
}
if (stream_set_blocking($stream, false) !== true) {
    fwrite(STDERR, "ERROR: Unable to set stream non-blocking!\n");
    exit(1);
}

$time1 = 0;
$time2 = 0;
$time3 = 0;
$time4 = 0;
$time5 = 0;

$closeRead  = function($stream) use($loop, &$time5) {
    $time5 = microtime(true);
    $loop->removeReadStream($stream);
    $loop->stop();
};

$read  = function($stream) use($loop, $closeRead, $bufferText, $bufferSize, &$reads) {
    $readsCounter = 0;
    $loop->addReadStream($stream, function($stream) use($closeRead, $bufferText, $bufferSize, &$reads, &$readsCounter) {
        $text = fread($stream, $bufferSize);

        if ($text === '') {
            return $closeRead($stream);
        }
        if ($text === $bufferText) {
            $readsCounter++;
        }
        if ($readsCounter == $reads) {
            return $closeRead($stream);
        }
    });
};

$closeWrite = function($stream) use($loop, &$time4, $read) {
    $time4 = microtime(true);
    $loop->removeWriteStream($stream);
    rewind($stream);
    return $read($stream);
};

$write = function($stream) use($loop, $closeWrite, $bufferText, $bufferSize, &$writes) {
    $writesCounter = 0;
    $loop->addWriteStream($stream, function($stream) use($closeWrite, $bufferText, $bufferSize, &$writes, &$writesCounter) {
        $r = fwrite($stream, $bufferText);

        // nothing could be written, so stream is closed
        if ($r === 0) {
            return $closeWrite($stream);
        }
        if ($r === $bufferSize) {
            $writesCounter++;
        }
        if ($writesCounter == $writes) {
            return $closeWrite($stream);
        }
    });
};

$closeTimer = function() use($loop, &$time3, $stream, $write) {
    $time3 = microtime(true);
    return $write($stream);
};

$timer = function() use($loop, &$time2, $timers, $closeTimer) {
    $time2 = microtime(true);
    for ($i=0; $i<$timers; ++$i) {
        $loop->addTimer(1e-6, function() {});
    }
    $loop->addTimer(1e-6, $closeTimer);
};

$closeTick = function() use($loop, &$time2, $stream, $timer) {
    $time2 = microtime(true);
    return $timer();
};

$tick = function() use($loop, &$time1, $ticks, $closeTick) {
    $time1 = microtime(true);
    for ($i=0; $i<$ticks; ++$i) {
        $loop->onTick(function() use($loop) {});
    }
    $loop->onTick($closeTick);
};

$loop->onStart($tick);
$loop->start();

printf("%s\n", str_repeat('-', 64));
printf("%-30s %8s ms\n", 'Time needed:', $timeAll = (round(($time4-$time1)*1e6)/1e3), round($all/$timeAll));
printf("   > %-25s %8s ms -> %6s   events/ms\n", 'Executing ticks', $timeAll = (round(($time2-$time1)*1e6)/1e3), round($ticks/($time2-$time1)/1e3));
printf("   > %-25s %8s ms -> %6s   events/ms\n", 'Executing timers', $timeAll = (round(($time3-$time2)*1e6)/1e3), round($timers/($time3-$time2)/1e3));
printf("   > %-25s %8s ms -> %6s   events/ms\n", 'Writing streams', $timeAll = (round(($time4-$time3)*1e6)/1e3), round($writes/($time4-$time3)/1e3));
printf("   > %-25s %8s ms -> %6s   events/ms\n", 'Reading streams', $timeAll = (round(($time5-$time4)*1e6)/1e3), round($reads/($time5-$time4)/1e3));
printf("%s\n", str_repeat('-', 64));
printf("%-30s %8s MB\n", 'Memory:', round(memory_get_usage(true) / 1024 / 1024, 3));
printf("   > %-25s %8s MB\n", 'allocated', $memAll = (round(memory_get_usage() / 1024 / 1024, 3)));
printf("%-30s %8s MB\n", 'Peak Memory:', round(memory_get_peak_usage(true) / 1024 / 1024, 3));
printf("   > %-25s %8s MB\n", 'allocated', $memAll = (round(memory_get_peak_usage() / 1024 / 1024, 3)));
printf("%s\n", str_repeat('-', 64));
