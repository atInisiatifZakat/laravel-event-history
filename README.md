# Record event as history

[![Latest Version on Packagist](https://img.shields.io/packagist/v/inisiatif/laravel-event-history.svg?style=flat-square)](https://packagist.org/packages/inisiatif/laravel-event-history)
[![PHPUnit](https://github.com/atInisiatifZakat/laravel-event-history/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/atInisiatifZakat/laravel-event-history/actions/workflows/run-tests.yml)
[![Laravel Pint](https://github.com/atInisiatifZakat/laravel-event-history/actions/workflows/fix-php-code-style-issues.yml/badge.svg?branch=main)](https://github.com/atInisiatifZakat/laravel-event-history/actions/workflows/fix-php-code-style-issues.yml)
[![Psalm](https://github.com/atInisiatifZakat/laravel-event-history/actions/workflows/run-psalm-static-analyst.yml/badge.svg?branch=main)](https://github.com/atInisiatifZakat/laravel-event-history/actions/workflows/run-psalm-static-analyst.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/inisiatif/laravel-event-history.svg?style=flat-square)](https://packagist.org/packages/inisiatif/laravel-event-history)

Paket ini digunakan untuk mencatan event seperti `Pengajuan sudah di setujui` dll.

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

### Persiapan

Melakukan registrasi user model, tambahkan code berikut di `boot` method `AppServiceProvider`

```php
use Inisiatif\EventHistory\EventHistories;

EventHistories::useUserModelClassName(User::class);
```

Selanjutnya semua model yang mempunyai history harus implement interface `Inisiatif\EventHistory\Concerns\HasEventHistories`, kita juga
bisa menggunakan default implementasi dengan trait `Inisiatif\EventHistory\InteractWithEventHistories`

```php
use Illuminate\Database\Eloquent\Model;
use Inisiatif\EventHistory\Concerns\HasEventHistories;
use Inisiatif\EventHistory\InteractWithEventHistories;

class ExampleModel extends Model implements HasEventHistories {
    use InteractWithEventHistories;
}
```

### Menggunakan Listener

Anda bisa menggukakan `Inisiatif\EventHistory\RecordEventHistoryListener` untuk setiap event yang akan di catat history-nya,
yang perlu di pastikan adalah event anda harus implements `Inisiatif\EventHistory\Concerns\EventHistoryAwareInterface`

```php
<?php

declare(strict_types=1);

namespace Inisiatif\EventHistory\Concerns;

interface EventHistoryAwareInterface
{
    public function getModelAwareHistories(): mixed;

    public function getHistoryDescription(): string;
}
```

method `getModelAwareHistories` harus return model atau collection dengan interface `Inisiatif\EventHistory\Concerns\HasEventHistories`.
Under the hood, listener akan memanggil job `Inisiatif\EventHistory\Jobs\NewEventHistoryJob`

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
