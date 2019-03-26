![Logo tarteaucitron.js](.readme/logo-tarteaucitron.png)

# Craft 3 - tarteaucitron.js

Integration of tarteaucitron.js as a Craft 3 Plugin.

This plugin currently includes the following services :
 - Facebook Pixel
 - Google Adwords (conversion)
 - Google Adwords (remarketing)
 - Google Analytics (universal)
 - Google Maps
 - Google Tag Manager
 - Linkedin
 - reCAPTCHA
 - Twitter
 - Vimeo
 - Youtube


## Requirements

This plugin requires Craft CMS 3.0.0-RC1 or later.


## Installation

Run this command from your Craft project's root folder :

```bash
composer require la-haute-societe/craft-tarteaucitron
```

Then add this twig code on the templates where you want the plugin to be loaded.
```twig
{{ craft.tarteaucitron.initScript }}
```


### Load service

![Settings page](.readme/settings.jpg)

All services are configurable from the plugin settings page.

You have to activate service, then, for some services, add the specified twig code on the pages where you want the service to appear. In this case, you must replace the parameters specified in the twig code with yours.

### Service HTML Attributes

For some service templates, you can include a parameter named `htmlAttributes`. See [dataAttributes Yii documentation](https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#$dataAttributes-detail).


## Contribute

Want to contribute? See [CONTRIBUTE.md](./CONTRIBUTE.md)


Brought to you by ![Logo La Haute Société](.readme/logo-lahautesociete.png) [La Haute Société](https://www.lahautesociete.com)