# Contribute

This plugin does not currently include all the services offered by tarteaucitron.js, any contribution is therefore welcome.

## Installation

### Plugin symlink

For development purposes, because of assets live compilation, the best way to handle plugin in your Craft project is to create a symlink to this folder.

Add this in the `composer.json` of your Craft project.

```bash
{
  "repositories": [
    {
      "type": "path",
      "url": "/path/to/your/craft-tarteaucitron",
      "options": {
        "symlink": true
      }
    }
  ],
  "require": {
    "la-haute-societe/craft-tarteaucitron": "dev-master"
  }
}
```


### Assets

All sources are located in the `resources` folder in the plugin root folder.

To build assets, run these commands from the plugin root folder :

```bash
npm install        # Install node dependencies needed for building assets

npm run watch  # Build assets in development mode & watch them for changes
npm run dev    # Build assets in development mode
npm run build  # Build assets in production mode
```


## Updating tarteaucitron.js

```bash
git submodule init
git submodule update
cp -r tarteaucitron.js/* src/resources/tarteaucitron
```



## Add service

Several steps are required to add a tarteaucitron.js service into the plugin.

### Settings

1. Implements service settings template in `src/templates/settings/services`
2. Include it in `src/templates/settings/settings.twig`
3. Declare parameters & validation rules in `src/models/SettingsModel.php`
4. Load CodeMirror style for your settings in `resources/js/models/Settings.js` and `resources/scss/pages/_settings.scss`

### Frontend

1. Define a service model in `src/models/services`
2. Create a plugin rendering function in `src/services/TarteaucitronService.php`
3. Define a Craft variable method to render the service in your templates in `src/variables/TarteaucitronVariable.php`
