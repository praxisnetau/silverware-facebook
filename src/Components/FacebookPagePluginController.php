<?php

/**
 * This file is part of SilverWare.
 *
 * PHP version >=5.6.0
 *
 * For full copyright and license information, please view the
 * LICENSE.md file that was distributed with this source code.
 *
 * @package SilverWare\Facebook\Components
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-facebook
 */

namespace SilverWare\Facebook\Components;

use SilverStripe\Control\HTTPRequest;
use SilverWare\Components\BaseComponentController;

/**
 * An extension of the base component controller class for a Facebook Page plugin controller.
 *
 * @package SilverWare\Facebook\Components
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-facebook
 */
class FacebookPagePluginController extends BaseComponentController
{
    /**
     * Defines the allowed actions for this controller.
     *
     * @var array
     * @config
     */
    private static $allowed_actions = [
        'refresh'
    ];
    
    /**
     * Refreshes the XFBML for the plugin after a browser resize event.
     *
     * @param HTTPRequest $request
     *
     * @return DBHTMLText
     */
    public function refresh(HTTPRequest $request)
    {
        if ($request->isAjax()) {
            
            return $this->customise([
                'Width' => $request->postVar('width')
            ])->renderWith(sprintf('%s\Includes\XFBML', FacebookPagePlugin::class));
            
        }
    }
}
