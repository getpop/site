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

## Main Concepts

### Multidomain

PoP has been built to support decentralization: modules can fetch their data from a different domain/subdomain from which the application is hosted. For instance, an application can have its components retrieved from subdomains:

![Modules can have their data fetched from different domains and subdomains](https://uploads.getpop.org/wp-content/uploads/2017/02/site-wireframe.png)

A single component is also able to have many sources of data, each of them coming from a different domain/subdomain. For instance, the [events calendar in SukiPoP.com](https://sukipop.com/en/calendar/) displays events from several external sites in a unique calendar, painting events with a different color according to the source domain:

![Multidomain events calendar](https://uploads.getpop.org/wp-content/uploads/2018/12/multidomain-events-calendar.png)

### Rendering through JavaScript templates

Will be added soon...

### Isomorphic Server-Side Rendering

Will be added soon...

### Reactivity

Will be added soon...

## Architecture Design and Implementation

#### Dataloading

#### Dataloading Modules

##### Lazy-Loading

We can instruct a dataloading module to be lazy-loaded (i.e. instead of fetching its database data immediately, it is fetched on a subsequent request from the client) simply by setting its prop `"lazy-load"` to `true`:

```php
function initModelProps($module, &$props) 
{
  switch ($module[1]) {
    case self::MODULE_AUTHORARTICLES:

      // Set the content lazy
      $this->setProp($module, $props, 'lazy-load', true);
      break;
  }

  parent::initModelProps($module, $props);
}
```

Being a prop, this value can be set either by the dataloading module itself, or by any of its ancestor modules:

```php
function initModelProps($module, &$props) 
{
  switch ($module[1]) {
    case self::MODULE_AUTHORARTICLESWRAPPER:

      // Set the content lazy
      $this->setProp([MODULE_AUTHORARTICLES], $props, 'lazy-load', true);
      break;
  }

  parent::initModelProps($module, $props);
}
```

Among others, the following are several uses cases for lazy-loading the data for a module:

- Modules which are displayed on several pages (eg: a "latest posts" widget on a sidebar) can have its data cached in the client (eg: through Service Workers, localStorage, etc) and, by lazy-loading, this data is not fetched again on the server on each request
- Fetching data from a different domain
- Improve apparent loading speed by lazy-loading data for below-the-fold modules (eg: a post's comments)
- Fetching data with user state on a page without user state ([as outlined here](https://www.smashingmagazine.com/2018/12/caching-smartly-gutenberg/))

### Multidomain

By default, a module will fetch its data from the domain where the application is hosted. To change this to a different domain(s) or subdomain(s) is done by setting prop `"dataload-multidomain-sources"` on the module:

```php
function initModelProps($module, &$props) {
    
  switch ($module[1]) {
    case self::MODULE_SOMENAME:

      $this->setProp(
        $module, 
        $props, 
        'dataload-multidomain-sources', 
        'https://anotherdomain.com'
      );
      break;
  }

  parent::initModelProps($module, $props);
}
```

We can also pass an array of domains, in which case the module will fetch its data from all of them:

```php
function initModelProps($module, &$props) {
    
  switch ($module[1]) {
    case self::MODULE_SOMENAME:

      $this->setProp(
        $module, 
        $props, 
        'dataload-multidomain-sources', 
        array(
          'https://anotherdomain1.com',
          'https://subdomain.anotherdomain2.com',
          'https://www.anotherdomain3.com',
        );
      break;
  }

  parent::initModelProps($module, $props);
}
```

When fetching data from several sources, each source will keep its own state in the [QueryHandler](#queryhandler). Then, it is able to query different amounts of data from different domains (eg: 3 results from domain1.com and 6 results from domain2.com), and stop querying from a particular domain when it has no more results.

Because the external site may have different components installed, it is not guaranteed that fetching data from the external site by simply adding `?output=json` will bring the data required by the origin site. To solve this issue, when querying data from an external site, PoP will use the [custom-querying API](#Custom-Querying-API) to fetch exactly the required data fields (this works for fetching database data, not configuration). If we have control on the external site and we can guarantee that both sites have the same components installed, then we can define constant `EXTERNAL_SITES_RUN_SAME_SOFTWARE` as true, which will allow to fetch database and configuration data through the regular `?output=json` request.

### Handlebars

Will be added soon...

### LightnCandy

Will be added soon...

### Code Splitting

Will be added soon...

### Progressive-Web App

Will be added soon...

### Single-Page Application

Will be added soon...

### Content CDN

Will be added soon...

### A/B Testing

Will be added soon...

### Form Input Modules

Will be added soon...

### Client-side Rendering

Will be added soon...

### JavaScript templates through Handlebars

Will be added soon...

### Executing JavaScript functions

Will be added soon...

### Resources

Will be added soon...

### Asset-bundling

Will be added soon...

### Progressive Booting

Will be added soon...

### Links in body

Will be added soon...

### State Management

Will be added soon...

### Data Cache, Configuration Cache and Replication

Will be added soon...

### Reactivity

Will be added soon...

## Server-Side Rendering

Will be added soon...

### Isomorphism

Will be added soon...

### JavaScript templates into PHP through LightnCandy

Will be added soon...

### Rendering a Webpage as a Transactional Email

Will be added soon...

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
