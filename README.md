Bitmasking
==========

This simple library provides a set of functions for easier life when dealing with bitmasks.

You can install it using composer:

```shell
$ composer require semisedlak/bitmasking
```

## How it works

Create your own bitmask class which extends from `Semisedlak\Bitmasking\Bitmask` class. Define your bitmask constants in this class. Set the `$bitmask` property and your `$maxBits` property (in fact it means how many "settings" will you have).

## Good to know

When defining a bitmask constants use powers of two, e.g.:

```php
const BIT_1 = 1; // 1 << 0
const BIT_2 = 2; // 1 << 1
const BIT_3 = 4; // 1 << 2
const BIT_4 = 8; // 1 << 3
const BIT_5 = 16; // 1 << 4

const BIT_ALL = BIT_1 | BIT_2 | BIT_3 | BIT_4 | BIT_5;
```
