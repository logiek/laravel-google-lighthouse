# laravel-google-lighthouse

[![Latest Stable Version](https://poser.pugx.org/logiek/laravel-google-lighthouse/v/stable)](https://packagist.org/packages/logiek/laravel-google-lighthouse) [![Total Downloads](https://poser.pugx.org/logiek/laravel-google-lighthouse/downloads)](https://packagist.org/packages/logiek/laravel-google-lighthouse) [![License](https://poser.pugx.org/logiek/laravel-google-lighthouse/license)](https://packagist.org/packages/logiek/laravel-google-lighthouse) [![PHP Version Require](http://poser.pugx.org/logiek/laravel-google-lighthouse/require/php)](https://packagist.org/packages/logiek/laravel-google-lighthouse)

**This package is based on [octoper/lighthouse-php](https://github.com/octoper/lighthouse-php).**

This package provides a wrapper for Google Lighthouse to audit the quality of web pages with Laravel.

## Installation

You can install the package via Composer:

``` bash
composer require logiek/laravel-google-lighthouse
```

The package will automatically register itself. Optionally you can publish the config file with:

```bash
php artisan vendor:publish --provider="Logiek\GoogleLighthouse\GoogleLighthouseServiceProvider" --tag="config"
```

## Usage

The following example will perform the default Google Lighthouse audit and store the result in the given path.

```php
use Logiek\GoogleLighthouse\GoogleLighthouse;

(new GoogleLighthouse())
    ->setOutput('report.html')
    ->audit('http://example.com');
```

### Categories

Per default the audit will run all the available categories. To run the audit for a specified list of categories you can specify the categories that the audit should run as shown in the example below, any missing category will be skipped. 

The available categories are: `performance`, `pwa`, `bestPractices`, `accessibility` and `seo`.

```php
use Logiek\GoogleLighthouse\GoogleLighthouse;

(new GoogleLighthouse())
    ->performance()
    ->pwa()
    ->setOutput('report.html')
    ->audit('http://example.com');
```

### Output

The `setOutput` method accepts a second argument that can be used to specify the format (based on the configuration). If the format argument is missing then the file extension will be used to determine the output format. If the file extension does not specify an accepted format, an exception will be thrown.

For the example the following code will create two reports example.report.html and example.report.json.

```php
use Logiek\GoogleLighthouse\GoogleLighthouse;

(new GoogleLighthouse())
    ->setOutput('example', ['html', 'json'])
    ->audit('http://example.com');
```

### Options

The `setOption` method can be used to specify certain options to fine tune Google Lighthouse to your liking.  

```php
use Logiek\GoogleLighthouse\GoogleLighthouse;

(new GoogleLighthouse())
    ->setOption('--throttling.cpuSlowdownMultiplier', 4)
    ->setOutput('report.html')
    ->audit('http://example.com');
```

## Changelog

Please see the [CHANGELOG](CHANGELOG.md) for more information about recent changes.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
