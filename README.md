# Swoole + Zend Expressive
[![Build Status](https://travis-ci.org/wshafer/swoole-expressive.svg?branch=master)](https://travis-ci.org/wshafer/swoole-expressive)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/wshafer/swoole-expressive/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/wshafer/swoole-expressive/?branch=master)
[![codecov](https://codecov.io/gh/wshafer/swoole-expressive/branch/master/graph/badge.svg)](https://codecov.io/gh/wshafer/swoole-expressive)

This package provides a Zend Expressive 3 runner for Swoole.

Note: Currently Zend Expressive 3 is in testing.  Due to this
this package may stop working with out warning.  Please do not
use this in production.


## Install

Install Swoole
```bash
$ pecl install swoole
```

Install Zend Expressive
```bash
$ composer create-project "zendframework/zend-expressive-skeleton:3.0.0rc1"
```

Add the Swoole + Expressive composer package

```bash
$ composer require wshafer/swoole-expressive:dev-master
```



## Usage

```bash
$ vendor/bin/swoole-expressive --host=0.0.0.0 --port=8080
```

Open your browser to http://127.0.0.1:8080 to validate you're
up and running.
