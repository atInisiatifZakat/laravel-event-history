# Record event as history

[![Latest Version on Packagist](https://img.shields.io/packagist/v/inisiatif/laravel-event-history.svg?style=flat-square)](https://packagist.org/packages/inisiatif/laravel-event-history)
[![PHPUnit](https://github.com/atInisiatifZakat/laravel-event-history/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/atInisiatifZakat/laravel-event-history/actions/workflows/run-tests.yml)
[![Laravel Pint](https://github.com/atInisiatifZakat/laravel-event-history/actions/workflows/fix-php-code-style-issues.yml/badge.svg?branch=main)](https://github.com/atInisiatifZakat/laravel-event-history/actions/workflows/fix-php-code-style-issues.yml)
[![Psalm](https://github.com/atInisiatifZakat/laravel-event-history/actions/workflows/run-psalm-static-analyst.yml/badge.svg?branch=main)](https://github.com/atInisiatifZakat/laravel-event-history/actions/workflows/run-psalm-static-analyst.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/inisiatif/laravel-event-history.svg?style=flat-square)](https://packagist.org/packages/inisiatif/laravel-event-history)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require inisiatif/laravel-event-history
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="event-history-migrations"
php artisan migrate
```

## Usage

```php
$eventHistory = new Inisiatif\EventHistory();
echo $eventHistory->echoPhrase('Hello, Inisiatif!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Nuradiyana](https://github.com/atInisiatifZakat)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
