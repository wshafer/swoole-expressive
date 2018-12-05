```
 WARNING: This package is abandoned and no longer maintained. 
 The author suggests using the zendframework/zend-expressive-swoole 
 package instead. 
```

# Swoole + Zend Expressive
[![Build Status](https://travis-ci.org/wshafer/swoole-expressive.svg?branch=master)](https://travis-ci.org/wshafer/swoole-expressive)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/wshafer/swoole-expressive/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/wshafer/swoole-expressive/?branch=master)
[![codecov](https://codecov.io/gh/wshafer/swoole-expressive/branch/master/graph/badge.svg)](https://codecov.io/gh/wshafer/swoole-expressive)

This package provides a Zend Expressive 3 runner for Swoole.

## Install

Install Swoole
```bash
$ pecl install swoole-2.1.1
```

Install Zend Expressive
```bash
$ composer create-project zendframework/zend-expressive-skeleton
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
