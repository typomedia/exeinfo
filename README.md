# Exeinfo Library

Library providing file properties/metadata from Windows binaries (`*.exe`, `*.dll`).

The Library is [PSR-1](https://www.php-fig.org/psr/psr-1/), [PSR-4](https://www.php-fig.org/psr/psr-4/), [PSR-12](https://www.php-fig.org/psr/psr-12/) compliant.

**Unit Tests have a Code Coverage of 100%!**

## Requirements

- `>= PHP 7.2`

## Dependencies

- `none`

## Install

```
composer require typomedia/exeinfo
```

## Usage

```php
use Typomedia\Exeinfo\Exeinfo;

$exeinfo = new Exeinfo('php.exe');

print $exeinfo->product;
print $exeinfo->company;
print $exeinfo->comment;
print $exeinfo->copyright;
print $exeinfo->description;
print $exeinfo->version;
```

## Credits

This library is heavily inspired by [NeuD](https://stackoverflow.com/users/8024536/neud) answer on [Stack Overflow](https://stackoverflow.com/a/44021325).

## Information

- https://docs.microsoft.com/en-us/windows/win32/menurc/versioninfo-resource
- https://nsis.sourceforge.io/Examples/VersionInfo.nsi