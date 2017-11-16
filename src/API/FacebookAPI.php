<?php

/**
 * This file is part of SilverWare.
 *
 * PHP version >=5.6.0
 *
 * For full copyright and license information, please view the
 * LICENSE.md file that was distributed with this source code.
 *
 * @package SilverWare\Facebook\API
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-facebook
 */

namespace SilverWare\Facebook\API;

use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Injector\Injectable;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * An object to encapsulate Facebook API data and methods.
 *
 * @package SilverWare\Facebook\API
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-facebook
 */
class FacebookAPI
{
    use Injectable;
    use Configurable;
    
    /**
     * Answers the app ID from site or YAML configuration.
     *
     * @return string
     */
    public function getAppID()
    {
        $id = SiteConfig::current_site_config()->FacebookAppID;
        
        if (!$id) {
            $id = self::config()->app_id;
        }
        
        return $id;
    }
    
    /**
     * Answers true if the receiver has an app ID.
     *
     * @return boolean
     */
    public function hasAppID()
    {
        return (boolean) $this->getAppID();
    }
}
