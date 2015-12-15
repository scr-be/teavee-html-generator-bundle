# Teavee HTML Generator Bundle

| CI Test Results | Code Review     | Test Coverage   |
|:---------------:|:---------------:|:---------------:|
| [![Travis](https://scr.be/teavee-html-generator-bundle/travis_shield)](https://scr.be/teavee-html-generator-bundle/travis) | [![Codacy](https://scr.be/teavee-html-generator-bundle/codacy_shield)](https://scr.be/teavee-html-generator-bundle/codacy) | [![Coveralls](https://scr.be/teavee-html-generator-bundle/coveralls_shield)](https://scr.be/teavee-html-generator-bundle/coveralls) |

## Overview

The `scr-be/teavee-html-generator-bundle` project provides a framework for
creating HTML component generators by implementing:

- An abstract "provider" for defining data retrieval logic
- An abstract "generator" for defining rendering logic
- An abstract "manager" for interfacing between the above components, handling
  the optional caching operations, and providing a simple user-facing API
- Twig extension registrar abstraction

Included component generator implementations are currently limited to buttons
and icons.

> This project is one of a [collection](https://src.run) of open-source, PHP
> libraries and Symfony bundles maintained by [Rob Frawley 2nd](https://scr.be/rmf)
> and [collaborators](https://github.com/scr-be/teavee-html-generator-bundle/graphs/contributors),
> often under the employ of [Scribe Inc](https://scr.be/).

## Install

Include this package within your project using [Composer](https://getcomposer.com)
by executing the following command.

```bash
composer require scr-be/teavee-html-generator-bundle
```

Enable the bundle by adding the following line in the *app/AppKernel.php* file
of your project.

```php
// app/AppKernel.php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Scribe\Teavee\HtmlGeneratorBundle\ScribeTeaveeHtmlGeneratorBundle(),
        );
        // ...
    }
}
```

## Configuration

The Symfony *console* command provides a method to dump a bundle's configuration
reference. To view this information simple call the following command from your
Symfony project root-directory.

```bash
app/console config:dump-reference scribe_teavee_html_generator
```

## API Reference

API reference documentation is available via the badge in the below Resources
section. This documentation is auto-generated using the excellent
[Sami CLI application](https://github.com/FriendsOfPHP/Sami), developed by
[Fabien Potencier](https://github.com/fabpot) and
[contributors](https://github.com/FriendsOfPHP/Sami/graphs/contributors).

## License

This project is licensed under the
[MIT License](https://github.com/scr-be/teavee-html-generator-bundle/blob/master/LICENSE.md), an
[FSF](https://en.wikipedia.org/wiki/Free_Software_Foundation)/[OSI](https://en.wikipedia.org/wiki/Open_Source_Initiative)
[approved](https://en.wikipedia.org/wiki/Comparison_of_free_and_open-source_software_licenses#Approvals) and
[GPL compatible](https://en.wikipedia.org/wiki/GNU_General_Public_License#Compatibility_and_multi-licensing)
permissive free software license. Review the
[LICENSE.md](https://github.com/scr-be/teavee-html-generator-bundle/blob/master/LICENSE.md)
file distributed with this source code for additional information.

# Resource Info/Links

| Purpose | Status |
|:-------:|:------:|
| Latest Release (Packagist) | [![Packagist](https://scr.be/teavee-html-generator-bundle/packagist_shield)](https://scr.be/teavee-html-generator-bundle/packagist) |
| Documentation (API)        | [![License](https://scr.be/teavee-html-generator-bundle/api_shield)](https://scr.be/teavee-html-generator-bundle/api) |
| Dependency Information     | [![Gemnasium](https://scr.be/teavee-html-generator-bundle/gemnasium_shield)](https://scr.be/teavee-html-generator-bundle/gemnasium) |
| License (MIT)              | [![License](https://scr.be/teavee-html-generator-bundle/license_shield)](https://scr.be/teavee-html-generator-bundle/license) |
