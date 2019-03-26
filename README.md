![Logo Latarteaucitron.js](.readme/logo-tarteaucitron.png)

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


## Contribute

This plugin does not currently include the services offered by tarteaucitron.js, any contribution is therefore welcome.


### Installation

#### Plugin symlink

For development purposes, because of assets live compilation, the best way to handle plugin in your Craft project is to create a symlink to this folder.

Add this in the `composer.json` of your Craft project.

```bash
{
  "repositories": [
    {
      "type": "path",
      "url": "/path/to/craft3-tarteaucitron",
      "options": {
        "symlink": true
      }
    }
  ],
  "require": {
    "la-haute-societe/craft-tarteaucitron": "^1.0"
  }
}
```


#### Assets

Run these commands from plugin's root folder :

```bash
yarn        # Install node dependencies

yarn watch  # Build assets in development mode & watch them for changes
yarn dev    # Build assets in development mode
yarn build  # Build assets in production mode
```

### Add service

Several steps are required for adding a tarteaucitron.js service into the plugin.

#### Settings

1. Implements service settings template in `src/templates/settings/services`
2. Load it in `src/templates/settings/settings.twig`
3. Set parameters & rules in `src/models/SettingsModel.php`
4. Set CodeMirror in `resources/js/models/Settings.js` and `resources/scss/pages/_settings.scss`

#### Front

1. Define service model in `src/models/services`
2. Create plugin render function in `src/services/TarteaucitronService.php`
3. Define craft variable for rendering service template in `src/variables/TarteaucitronVariable.php`


Brought to you by ![Logo La Haute Société](.readme/logo-lahautesociete.png) [La Haute Société](https://www.lahautesociete.com)