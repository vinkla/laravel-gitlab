Laravel GitLab
==============

![laravel-gitlab](https://cloud.githubusercontent.com/assets/499192/7440610/e030579c-f0bf-11e4-8c78-fdf74626de2b.png)

Laravel [GitLab](https://gitlab.com/) is a [GitLab](https://gitlab.com/) bridge for Laravel using the [GitLab API package](https://github.com/m4tthumphrey/php-gitlab-api).

```php
// Fetch projects.
$gitlab->api('projects')->all();

// Create Issues.
$gitlab->api('issues')->create($id, $params);

// Want to use the facade?
GitLab::api('users')->show($id);
```

[![Build Status](https://img.shields.io/travis/vinkla/laravel-gitlab/master.svg?style=flat)](https://travis-ci.org/vinkla/laravel-gitlab)
[![StyleCI](https://styleci.io/repos/32235069/shield?style=flat)](https://styleci.io/repos/32235069)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/vinkla/gitlab.svg?style=flat)](https://scrutinizer-ci.com/g/vinkla/gitlab/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/vinkla/gitlab.svg?style=flat)](https://scrutinizer-ci.com/g/vinkla/gitlab)
[![Latest Version](https://img.shields.io/github/release/vinkla/gitlab.svg?style=flat)](https://github.com/vinkla/gitlab/releases)
[![License](https://img.shields.io/packagist/l/vinkla/gitlab.svg?style=flat)](https://packagist.org/packages/vinkla/gitlab)

## Installation
Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require vinkla/gitlab
```

Add the service provider to `config/app.php` in the `providers` array.

```php
Vinkla\GitLab\GitLabServiceProvider::class
```

If you want you can use the [facade](http://laravel.com/docs/facades). Add the reference in `config/app.php` to your aliases array.

```php
'GitLab' => Vinkla\GitLab\Facades\GitLab::class
```

## Configuration

Laravel GitLab requires connection configuration. To get started, you'll need to publish the vendor assets:

```bash
$ php artisan vendor:publish --provider="Vinkla\GitLab\GitLabServiceProvider"
```

This will create a `config/gitlab.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### Default Connection Name

This option `default` is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `main`.

#### GitLab Connections

This option `connections` is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.

## Usage

#### GitLabManager

This is the class of most interest. It is bound to the ioc container as `gitlab` and can be accessed using the `Facades\GitLab` facade. This class implements the ManagerInterface by extending AbstractManager. The interface and abstract class are both part of [Graham Campbell's](https://github.com/GrahamCampbell) [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at that repository. Note that the connection class returned will always be an instance of `GitLab\Client`.

#### Facades\GitLab

This facade will dynamically pass static method calls to the `gitlab` object in the ioc container which by default is the `GitLabManager` class.

#### GitLabServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

### Examples
Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
// You can alias this in config/app.php.
use Vinkla\GitLab\Facades\GitLab;

GitLab::api('projects')->all();
// We're done here - how easy was that, it just works!

GitLab::api('users')->all(true);
// This example is simple and there are far more methods available.
```

The GitLab manager will behave like it is a `GitLab\Client`. If you want to call specific connections, you can do that with the connection method:

```php
use Vinkla\GitLab\Facades\GitLab;

// Writing this…
GitLab::connection('main')->api('projects')->all();

// …is identical to writing this
GitLab::api('projects')->all();

// and is also identical to writing this.
GitLab::connection()->api('projects')->all();

// This is because the main connection is configured to be the default.
GitLab::getDefaultConnection(); // This will return main.

// We can change the default connection.
GitLab::setDefaultConnection('alternative'); // The default is now alternative.
```

If you prefer to use dependency injection over facades like me, then you can inject the manager:

```php
use Vinkla\GitLab\GitLabManager;

class Foo
{
	protected $gitlab;

	public function __construct(GitLabManager $gitlab)
	{
		$this->gitlab = $gitlab;
	}

	public function bar()
	{
		$this->gitlab->api('users')->all(true);
	}
}

App::make('Foo')->bar();
```

## Documentation
There are other classes in this package that are not documented here. This is because the package is a Laravel wrapper of [the official GitLab package](https://github.com/m4tthumphrey/php-gitlab-api).

## License

Laravel GitLab is licensed under [The MIT License (MIT)](LICENSE).
