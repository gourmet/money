# Money (DataType)

[![Build Status](https://travis-ci.org/gourmet/money.svg?branch=master)](https://travis-ci.org/gourmet/money)
[![Total Downloads](https://poser.pugx.org/gourmet/money/downloads.svg)](https://packagist.org/packages/gourmet/money)
[![License](https://poser.pugx.org/gourmet/money/license.svg)](https://packagist.org/packages/gourmet/money)

Adds support for the [Money][money] database type in [CakePHP 3][cakephp].

## Install

Using [Composer][composer]:

```
composer require gourmet/money:dev-master
```

You then need to load the plugin. In `boostrap.php`, something like:

```php
\Cake\Core\Plugin::load('Gourmet/Money', ['bootstrap' => true]);
```

__NOTE: Important to autoload the plugin's `bootstrap.php`, which will register the new `money` type.__

## Usage

In your table, define the `money` columns like so:

```php
use Cake\Database\Schema\Table as Schema;

class OrdersTable extends Table
{
    protected function _initializeSchema(Schema $schema)
	{
		$schema->columnType('total', 'money');
		return $schema;
	}
}
```

For more details on `DataTypes`, read the official CakePHP 3 [documentation](http://book.cakephp.org/3.0/en/orm/saving-data.html#saving-complex-types).

## Patches & Features

* Fork
* Mod, fix
* Test - this is important, so it's not unintentionally broken
* Commit - do not mess with license, todo, version, etc. (if you do change any, bump them into commits of
their own that I can ignore when I pull)
* Pull request - bonus point for topic branches

## Bugs & Feedback

http://github.com/gourmet/money/issues

## License

Copyright (c) 2015, Jad Bitar and licensed under [The MIT License][mit].

[cakephp]:http://cakephp.org
[composer]:http://getcomposer.org
[composer:ignore]:http://getcomposer.org/doc/faqs/should-i-commit-the-dependencies-in-my-vendor-directory.md
[mit]:http://www.opensource.org/licenses/mit-license.php
[money]:http://github.com/sebastianbergmann/money
