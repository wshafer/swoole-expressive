# Swoole + Zend Expressive

This package provides a Zend Expressive 3 runner for Swoole.

Note: Currently Zend Expressive 3 is in Alpha testing.  Due to this
this package may stop working with out warning.  Please do not
use this in production.


## Install

Install Swoole
```bash
$ pecl install swoole
```

Install Zend Expressive
```bash
$ composer create-project "zendframework/zend-expressive-skeleton:3.0.0alpha3"
```

Add the Swoole + Expressive composer package

```bash
$ composer require wshafer/swoole-expressive:dev-master
```



## Usage

```bash
$ vendor/bin/swoole-expressive --host 0.0.0.0 --port 8080
```

Open your browser to http://127.0.0.1:8080 to validate you're
up and running.