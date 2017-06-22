# Dazzle Async I/O Event Loop

[![Build Status](https://travis-ci.org/dazzle-php/throwable.svg)](https://travis-ci.org/dazzle-php/throwable)
[![Code Coverage](https://scrutinizer-ci.com/g/dazzle-php/throwable/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/dazzle-php/throwable/?branch=master)
[![Code Quality](https://scrutinizer-ci.com/g/dazzle-php/throwable/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dazzle-php/throwable/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/dazzle-php/throwable/v/stable)](https://packagist.org/packages/dazzle-php/throwable) 
[![Latest Unstable Version](https://poser.pugx.org/dazzle-php/throwable/v/unstable)](https://packagist.org/packages/dazzle-php/throwable) 
[![License](https://poser.pugx.org/dazzle-php/throwable/license)](https://packagist.org/packages/dazzle-php/throwable/license)

<br>
<p align="center">
<img src="https://avatars0.githubusercontent.com/u/29509136?v=3&s=150" />
</p>

## Description

Dazzle Loop is a component that provides abstraction layer for writing asynchronous code in PHP on single thread or process
with usage of single or multiple loops.

## Feature Highlights

Loop features:

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

## Requirements

* PHP-5.6 or PHP-7.0+,
* UNIX or Windows OS.

## Installation

```
$> composer require dazzle-php/loop
```

## Tests

```
$> vendor/bin/phpunit -d memory_limit=1024M
```

## Contributing

Thank you for considering contributing to this repository! The contribution guide can be found in the [contribution tips][1].

## License

Dazzle Framework is open-sourced software licensed under the [MIT license][2].

[1]: https://github.com/dazzle-php/throwable/blob/master/CONTRIBUTING.md
[2]: http://opensource.org/licenses/MIT
