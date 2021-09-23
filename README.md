# Laravel Dingtalk Error Notifier

# 说明
**此包来源于 [lidelin/ding-error-notifier](https://github.com/lidelin/ding-error-notifier)**

## Requirements
- PHP 7.1.3+
- Laravel 5.6+

# Installation

1. Install the package by running this command in your terminal/cmd:
```bash
composer require sumiansz/laravel-dingtalk-error-notifier
```

2. Because we use the [ding-notice](https://github.com/wowiwj/ding-notice), so we should configure ding-notice
```bash
php artisan vendor:publish --provider="DingNotice\DingNoticeServiceProvider"
``` 

3. add below configs in app/ding.php
```php
return [
    ...

    'error-notifier' => [
        'enabled' => env('DING_ERROR_NOTIFIER_ENABLED', true),

        'token' => env('DING_ERROR_NOTIFIER_DING_TOKEN', ''),

        'timeout' => env('DING_ERROR_NOTIFIER_DING_TIME_OUT', 2.0)
    ],
];
```

4. publish config/notifier.php
```bash
php artisan vendor:publish --provider="Sumian\DingtalkErrorNotifier\DingtalkErrorNotifierServiceProvider"
```

5. modify config/notifier.php
```php
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | notifier name
    |--------------------------------------------------------------------------
    */
    'name' => env('NOTIFIER_NAME', 'ding'),

    /*
    |--------------------------------------------------------------------------
    | error notify level
    |--------------------------------------------------------------------------
    */
    'level' => env('NOTIFIER_LEVEL', 'error'),

    /*
    |--------------------------------------------------------------------------
    | ding channel, you can config in ding.php
    |--------------------------------------------------------------------------
    */
    'ding_channel' => env('NOTIFIER_DING_CHANNEL', 'error-notifier'),
];
```
