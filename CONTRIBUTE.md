# Contribute

This plugin does not currently include the services offered by tarteaucitron.js, any contribution is therefore welcome.

## Installation

### Plugin symlink

For development purposes, because of assets live compilation, the best way to handle plugin in your Craft project is to create a symlink to this folder.

Add this in the `composer.json` of your Craft project.

```bash
{
  "repositories": [
    {
      "type": "path",
      "url": "/path/to/your/craft3-tarteaucitron",
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


### Assets

All sources are localised in `resources` folder in plugin's root folder.

To build assets, run these commands from plugin's root folder :

```bash
yarn        # Install node dependencies needed for building assets

yarn watch  # Build assets in development mode & watch them for changes
yarn dev    # Build assets in development mode
yarn build  # Build assets in production mode
```


## Add service

Several steps are required for adding a tarteaucitron.js service into the plugin.

### Settings

1. Implements service settings template in `src/templates/settings/services`
2. Load it in `src/templates/settings/settings.twig`
3. Set parameters & rules in `src/models/SettingsModel.php`
4. Load CodeMirror style for your settings in `resources/js/models/Settings.js` and `resources/scss/pages/_settings.scss`

### Front

1. Define service model in `src/models/services`
2. Create plugin rendering function in `src/services/TarteaucitronService.php`
3. Define Craft variable for rendering service in your templates in `src/variables/TarteaucitronVariable.php`
