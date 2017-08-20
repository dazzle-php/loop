# Dazzle Async I/O Event Loop

[![Build Status](https://travis-ci.org/dazzle-php/loop.svg)](https://travis-ci.org/dazzle-php/loop)
[![Code Coverage](https://scrutinizer-ci.com/g/dazzle-php/loop/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/dazzle-php/loop/?branch=master)
[![Code Quality](https://scrutinizer-ci.com/g/dazzle-php/loop/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dazzle-php/loop/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/dazzle-php/loop/v/stable)](https://packagist.org/packages/dazzle-php/loop) 
[![Latest Unstable Version](https://poser.pugx.org/dazzle-php/loop/v/unstable)](https://packagist.org/packages/dazzle-php/loop) 
[![License](https://poser.pugx.org/dazzle-php/loop/license)](https://packagist.org/packages/dazzle-php/loop/license)

> **Note:** This repository is part of [Dazzle Project](https://github.com/dazzle-php/dazzle) - the next-gen library for PHP. The project's purpose is to provide PHP developers with a set of complete tools to build functional async applications. Please, make sure you read the attached README carefully and it is guaranteed you will be surprised how easy to use and powerful it is. In the meantime, you might want to check out the rest of our async libraries in [Dazzle repository](https://github.com/dazzle-php) for the full extent of Dazzle experience.

<br>
<p align="center">
<img src="https://raw.githubusercontent.com/dazzle-php/dazzle/master/media/dazzle-x125.png" />
</p>

## Description

Dazzle Loop is a component that provides abstraction layer for writing asynchronous code in PHP on single thread or process with usage of single or multiple loops.

## Feature Highlights

Dazzle Loop features:

* Interface for writing asynchronous code on single Thread or Process,
* File descriptor polling,
* One-time and periodic timers,
* Deferred execution of callbacks,
* Support for StreamSelect -based loops,
* ~~Support for LibEvent -based loops~~,
* ~~Support for LibEv -based loops~~,
* ~~Support for ExtEvent -based loops~~,
* Support for combining multiple loops and managing them from one wrapper,
* Support for switching between multiple execution flows,
* ReactPHP Event-Loop adapters,
* ReactPHP compatibility,
* ...and more.

## Provided Example(s)

### Quickstart

This example shows implementation of non-blocking clock using loop:

```php
$loop = new Loop();

$loop->addPeriodicTimer(1, function() {
    printf("\rCurrent clock: %s", date('Y-m-d H:i:s'));
});

$loop->start();
```

### Additional

Additional examples can be found in [example](https://github.com/dazzle-php/loop/tree/master/example) directory. Below is the list of provided examples as a reference and preferred consumption order:

- [Quickstart](https://github.com/dazzle-php/loop/blob/master/example/loop_quickstart.php)
- [Using Loop start/stop events](https://github.com/dazzle-php/loop/blob/master/example/loop_using_events.php)
- [Scheduling simple timers](https://github.com/dazzle-php/loop/blob/master/example/loop_using_simple_timers.php)
- [Scheduling periodic timers](https://github.com/dazzle-php/loop/blob/master/example/loop_using_periodic_timers.php)
- [Scheduling periodic timers with manual control](https://github.com/dazzle-php/loop/blob/master/example/loop_using_periodic_timers_controls.php)
- [Cancelling timers](https://github.com/dazzle-php/loop/blob/master/example/loop_cancelling_timers.php)
- [Cancelling timers alternatively](https://github.com/dazzle-php/loop/blob/master/example/loop_cancelling_timers_alternative.php)
- [Queueing tick listeners](https://github.com/dazzle-php/loop/blob/master/example/loop_listening_on_ticks.php)
- [Queueing tick listeners to begin/end of queue](https://github.com/dazzle-php/loop/blob/master/example/loop_listening_on_ticks_all.php)
- [Using streams asynchronously - pt 1](https://github.com/dazzle-php/loop/blob/master/example/loop_io_stream_source.php)
- [Using streams asynchronously - pt 2](https://github.com/dazzle-php/loop/blob/master/example/loop_io_stream_pipe.php)
- [__Advanced:__  Implementing simple HTTP server](https://github.com/dazzle-php/loop/blob/master/example/loop_http_server.php)

If any of the above examples has left you confused, please take a look in the [tests](https://github.com/dazzle-php/loop/tree/master/test) directory as well.

## Comparison

This section contains Dazzle vs React comparison many users requested. If you are wondering why this section has been created, see the [author's note](https://github.com/dazzle-php/dazzle/blob/master/NOTE.md).

#### Performance

<br>
<p align="center">
<img src="https://raw.githubusercontent.com/dazzle-php/loop/master/media/graph-perf-cpu.png" />
</p>

The detailed information about this benchmark can be found in [benchmark-on.php](https://github.com/dazzle-php/loop/blob/master/example-bench/benchmark.php) and [benchmark-react.php](https://github.com/dazzle-php/loop/blob/master/example-bench/benchmark-react.php) files.

#### Memory Allocation Efficiency

<br>
<p align="center">
<img src="https://raw.githubusercontent.com/dazzle-php/loop/master/media/graph-perf-mem.png" />
</p>

The detailed information about this benchmark can be found in [benchmark-once.php](https://github.com/dazzle-php/loop/blob/master/example-bench/benchmark.php) and [benchmark-react.php](https://github.com/dazzle-php/loop/blob/master/example-bench/benchmark-react.php) files.

#### Details

| Detail | Dazzle Event | React-equivalent |
| :--- | :---: | :---: |
| Active support | X | ? |
| Provided well-formed documentation | X | X |
| Provided well-formed set of tests with at least 80% coverage and API examples | X | X |
| Support for executing event ticks | X | X |
| Support for before and after event ticks listeners | X | X |
| Support for timers | X | X |
| Support for periodic timers | X | X | 
| Asynchronous writing of streams | X | X |
| Asynchronous reading of streams | X | X |
| Cancelling timers | X | X |
| Implemented stream model | X | X |
| Implemented lib-event model | WIP | X |
| Implemented lib-ev model | WIP | X |
| Implemented ext-event model | WIP | X |
| Support for state change events | X | |
| Support for flow controls | X | |
| Support for multiple flows and switching between active ones | X | |

## Requirements

Loop requires:

* PHP-5.6 or PHP-7.0+,
* UNIX or Windows OS.

## Installation

To install this library make sure you have [composer](https://getcomposer.org/) installed, then run following command:

```
$> composer require dazzle-php/loop
```

## Tests

Tests can be run via:

```
$> vendor/bin/phpunit -d memory_limit=1024M
```

## Versioning

Versioning of Dazzle libraries is described in versioning section of [Dazzle Project](https://github.com/dazzle-php/dazzle) index repository. Please, refer there for detailed information on the subject.

## Contributing

Thank you for considering contributing to this repository! 

- The contribution guide can be found in the [contribution tips](https://github.com/dazzle-php/loop/blob/master/CONTRIBUTING.md). 
- Open tickets can be found in [issues section](https://github.com/dazzle-php/loop/issues). 
- Current contributors are listed in [graphs section](https://github.com/dazzle-php/loop/graphs/contributors)
- To contact the author(s) see the information attached in [composer.json](https://github.com/dazzle-php/loop/blob/master/composer.json) file.

## License

Dazzle Loop is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

<hr>
<p align="center">
<i>"Everything is possible. The impossible just takes longer."</i> ― Dan Brown
</p>
