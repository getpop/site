# Site Builder

<!--
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]
-->

Create a component-based website

## Install

Via Composer

``` bash
$ composer require getpop/site-builder dev-master
```

**Note:** Your `composer.json` file must have the configuration below to accept minimum stability `"dev"` (there are no releases for PoP yet, and the code is installed directly from the `master` branch):

```javascript
{
    ...
    "minimum-stability": "dev",
    "prefer-stable": true,
    ...
}
```

## Architecture foundations

Layouts are rendered through custom-built reactivity, based on observing a unique JavaScript object (which contains database and configuration data).

The view is implemented through [Handlebars](https://handlebarsjs.com/) templates, which can be loaded both in the client (through the Handlebars runtime) and in the server (through PHP library [LightnCandy](https://github.com/zordius/lightncandy)). This approach is isomorphic: the same code works on both environments.

Implementation coming soon.

## Examples

### Application extending from the API

> Note: The examples below are currently not deployed... Will do so soon...

The native API can be extended by adding the other layers (configuration, view) to create the application:

- [The homepage](https://nextapi.getpop.org/?output=json&mangled=none&dataoutputmode=combined), [a single post](https://nextapi.getpop.org/posts/a-lovely-tango/?output=json&mangled=none&dataoutputmode=combined), [an author](https://nextapi.getpop.org/u/leo/?output=json&mangled=none&dataoutputmode=combined), [a list of posts](https://nextapi.getpop.org/posts/?output=json&mangled=none&dataoutputmode=combined) and [a list of users](https://nextapi.getpop.org/users/?output=json&mangled=none&dataoutputmode=combined)
- [An event, filtering from a specific module](https://nextapi.getpop.org/events/coldplay-in-london/?output=json&mangled=none&modulefilter=modulepaths&modulepaths[]=pagesectiongroup.pagesection-body.block-singlepost.block-single-content&dataoutputmode=combined)
- A tag, [filtering modules which require user state](https://nextapi.getpop.org/tags/internet/?output=json&mangled=none&modulefilter=userstate&dataoutputmode=combined) and [filtering to bring only a page from a Single-Page Application](https://nextapi.getpop.org/tags/internet/?output=json&mangled=none&modulefilter=page&dataoutputmode=combined)
- [An array of locations, to feed into a typeahead](https://nextapi.getpop.org/locations/?output=json&mangled=none&modulefilter=maincontentmodule&dataoutputmode=combined&datastructure=results)
- Alternative models for the "Who we are" page: [Normal](https://nextapi.getpop.org/who-we-are/?output=json&mangled=none&dataoutputmode=combined), [Printable](https://nextapi.getpop.org/who-we-are/?output=json&mangled=none&thememode=print&dataoutputmode=combined), [Embeddable](https://nextapi.getpop.org/who-we-are/?output=json&mangled=none&thememode=embed&dataoutputmode=combined)
- Changing the module names: [original](https://nextapi.getpop.org/?output=json&mangled=none&dataoutputmode=combined) vs [mangled](https://nextapi.getpop.org/?output=json&dataoutputmode=combined)
- Filtering information: [only module settings](https://nextapi.getpop.org/?output=json&dataoutputitems[]=modulesettings&dataoutputmode=combined&mangled=none), [module data plus database data](https://nextapi.getpop.org/?output=json&dataoutputitems[]=databases&dataoutputitems[]=moduledata&dataoutputmode=combined&mangled=none)

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email leo@getpop.org instead of using the issue tracker.

## Credits

- [Leonardo Losoviz][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/getpop/site-builder.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/getpop/site-builder/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/getpop/site-builder.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/getpop/site-builder.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/getpop/site-builder.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/getpop/site-builder
[link-travis]: https://travis-ci.org/getpop/site-builder
[link-scrutinizer]: https://scrutinizer-ci.com/g/getpop/site-builder/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/getpop/site-builder
[link-downloads]: https://packagist.org/packages/getpop/site-builder
[link-author]: https://github.com/leoloso
[link-contributors]: ../../contributors
