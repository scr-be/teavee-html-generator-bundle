# Teavee HTML Generator Bundle

The `scr-be/teavee-html-generator-bundle` project is one of a [collection](https://src.run) of open-source,
PHP libraries and Symfony bundles maintained by [Rob Frawley 2nd](https://scr.be/rmf) and 
[collaborators](https://github.com/scr-be/teavee-html-generator-bundle/graphs/contributors), often for
[Scribe Inc](https://scr.be/) under the direction of supporting their technology services with the intention
of abstracting components that may prove useful to others. *This project provides a collection of classes, traits, and interfaces to simplify Symfony bundle operations, such as 
configuring extensions and implementing compiler passes.*

| CI Test Results | Code Review     | Test Coverage   |
|:---------------:|:---------------:|:---------------:|
| [![Travis](https://scr.be/teavee-html-generator-bundle/travis_shield)](https://scr.be/teavee-html-generator-bundle/travis) | [![Codacy](https://scr.be/teavee-html-generator-bundle/codacy_shield)](https://scr.be/teavee-html-generator-bundle/codacy) | [![Coveralls](https://scr.be/teavee-html-generator-bundle/coveralls_shield)](https://scr.be/teavee-html-generator-bundle/coveralls) |

## Getting Started

Using this project expects a full-stack Symfony environment or an API-compatible alternative. Include this package using [Composer](https://getcomposer.com). You can use the CLI interface to require this package and have it added to your project `composer.json` file, or you may manually add it as a dependency within the require block of your composer config.

```bash
# To resolve dependency and add to your composer.json automatically:
composer require scr-be/teavee-html-generator-bundle
```

After requiring the package, you must register this bundle with your app kernel. When using the full-stack Symfony framework, you would simply edit `app/AppKernel.php` and add it to the array of bundles. For example

```php
class AppKernel extends \Symfony\Component\HttpKernel\Kernel
{
    /* [...] */
    public function registerBundles()
    {
        $bundles = [
            new \Symfony\Bundle\MonologBundle\MonologBundle(),
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            /* [...] */
            new Scribe\Teavee\HtmlGeneratorBundle\ScribeTeaveeHtmlGeneratorBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'])) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
        }

        return $bundles;
    }
    /* [...] */
}
```

Comprehensive, API reference is available via the badge in the below Resources section. This documentation is auto-generated using the excellent [Sami CLI application](https://github.com/FriendsOfPHP/Sami), developed by [Fabien Potencier](https://github.com/fabpot) and [contributors](https://github.com/FriendsOfPHP/Sami/graphs/contributors).

## Usage

This project is licensed under the 
[MIT License](https://github.com/scr-be/teavee-html-generator-bundle/blob/master/LICENSE.md), an 
[FSF](https://en.wikipedia.org/wiki/Free_Software_Foundation)/[OSI](https://en.wikipedia.org/wiki/Open_Source_Initiative) 
[approved](https://en.wikipedia.org/wiki/Comparison_of_free_and_open-source_software_licenses#Approvals) and 
[GPL compatible](https://en.wikipedia.org/wiki/GNU_General_Public_License#Compatibility_and_multi-licensing) permissive 
free software license. 
Review the [LICENSE.md](https://github.com/scr-be/teavee-html-generator-bundle/blob/master/LICENSE.md) file distributed 
with this source code for all rights, restrictions, requirements, and other relivant information.

## Resources

| Purpose | Status |
|:-------:|:------:|
| Documentation | [![License](https://scr.be/teavee-html-generator-bundle/api_shield)](https://scr.be/teavee-html-generator-bundle/api) |
| Latest Release | [![Packagist](https://scr.be/teavee-html-generator-bundle/packagist_shield)](https://scr.be/teavee-html-generator-bundle/packagist) |
| Readme/License | [![README](https://scr.be/teavee-html-generator-bundle/readme_shield)](https://scr.be/teavee-html-generator-bundle/readme) [![License](https://scr.be/teavee-html-generator-bundle/license_shield)](https://scr.be/teavee-html-generator-bundle/license) |
| Dependencies | [![Gemnasium](https://scr.be/teavee-html-generator-bundle/gemnasium_shield)](https://scr.be/teavee-html-generator-bundle/gemnasium)