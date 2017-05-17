# SilverWare Facebook Module

Provides a [Facebook Page Plugin][fbpageplugin] component and
[sharing button][fbsharebutton] for use with [SilverWare][silverware].

## Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Issues](#issues)
- [Contribution](#contribution)
- [Maintainers](#maintainers)
- [License](#license)

## Requirements

- [SilverWare][silverware]
- [SilverWare Social Module][silverware-social]

## Installation

Installation is via [Composer][composer]:

```
$ composer require silverware/facebook
```

## Configuration

As with all SilverStripe modules, configuration is via YAML.  An extension is applied to site configuration which
adds a tab for Facebook settings to the SilverWare Services tab.

### Facebook App ID

Before the `FacebookPagePlugin` component can function, you will first need to create a *Facebook App ID* using
the Facebook for Developers site. To do this:

1. Login to the [Facebook for Developers][fbdevelopers] site.
2. Click on "My Apps" and then "Add a New App".
3. Enter the app display name and contact email.
4. Click on the "Create App ID" button.

This will generate a new Facebook App ID. Copy the ID number, and paste it into
the "Facebook App ID" field under Settings > SilverWare > Services > Facebook API.
Finally, click the "Save" button to store your site settings.

## Usage

### Facebook Page Plugin

![Facebook Page Plugin](http://i.imgur.com/EL6rdgR.png)

This module provides a `FacebookPagePlugin` component which can be added to a [SilverWare][silverware]
template or layout using the CMS. For the plugin to work correctly, you will need:

1. A valid *Facebook App ID* ([see above](#configuration)).
2. The name of your Facebook page.
3. The URL of your Facebook page.

Add the component where desired in your template or layout, entered the name of your
Facebook page (e.g. "My Company") and the URL of your page on Facebook.

For more information about the Facebook Page Plugin, see the [Facebook documentation][fbpageplugin].

### Facebook Sharing Button

![Facebook Sharing Button](http://i.imgur.com/0Nf9HMt.png)

Also provided is a `FacebookSharingButton` which is used with the `SharingComponent`
from the [SilverWare Social Module][silverware-social]. Simply add this button using
the Buttons tab on the `SharingComponent`, and your pages will now
be able to be shared via Facebook.

For more information, see the [Facebook documentation][fbsharebutton].

## Issues

Please use the [GitHub issue tracker][issues] for bug reports and feature requests.

## Contribution

Your contributions are gladly welcomed to help make this project better.
Please see [contributing](CONTRIBUTING.md) for more information.

## Maintainers

[![Colin Tucker](https://avatars3.githubusercontent.com/u/1853705?s=144)](https://github.com/colintucker) | [![Praxis Interactive](https://avatars2.githubusercontent.com/u/1782612?s=144)](http://www.praxis.net.au)
---|---
[Colin Tucker](https://github.com/colintucker) | [Praxis Interactive](http://www.praxis.net.au)

## License

[BSD-3-Clause](LICENSE.md) &copy; Praxis Interactive

[composer]: https://getcomposer.org
[fbpageplugin]: https://developers.facebook.com/docs/plugins/page-plugin
[fbsharebutton]: https://developers.facebook.com/docs/plugins/share-button
[fbdevelopers]: https://developers.facebook.com
[silverware]: https://github.com/praxisnetau/silverware
[silverware-social]: https://github.com/praxisnetau/silverware-social
[issues]: https://github.com/praxisnetau/silverware-facebook/issues
