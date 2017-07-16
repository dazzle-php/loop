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
* ReactPHP compatibility,
* ReactPHP Event-Loop adapters,
* ...and more.

## Provided Example(s)

### Quickstart

TODO

### Additional

TODO

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

Versioning of Dazzle libraries is being shared between all packages included in [Dazzle Project](https://github.com/dazzle-php/dazzle). That means the releases are being made concurrently for all of them. On one hand this might lead to "empty" releases for some packages at times, but don't worry. In the end it is far much easier for contributors to maintain and -- what's the most important -- much more straight-forward for users to understand the compatibility and inter-operability of the packages.

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

