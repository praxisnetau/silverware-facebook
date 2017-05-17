<?php

/**
 * This file is part of SilverWare.
 *
 * PHP version >=5.6.0
 *
 * For full copyright and license information, please view the
 * LICENSE.md file that was distributed with this source code.
 *
 * @package SilverWare\Facebook\Extensions
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-facebook
 */

namespace SilverWare\Facebook\Extensions;

use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverWare\Extensions\Config\ServicesConfig;

/**
 * An extension of the services config class which adds Facebook settings to site configuration.
 *
 * @package SilverWare\Facebook\Extensions
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-facebook
 */
class FacebookConfig extends ServicesConfig
{
    /**
     * Maps field names to field types for this object.
     *
     * @var array
     * @config
     */
    private static $db = [
        'FacebookAppID' => 'Varchar(128)'
    ];
    
    /**
     * Updates the CMS fields of the extended object.
     *
     * @param FieldList $fields List of CMS fields from the extended object.
     *
     * @return void
     */
    public function updateCMSFields(FieldList $fields)
    {
        // Update Field Objects (from parent):
        
        parent::updateCMSFields($fields);
        
        // Create Facebook Tab:
        
        $fields->findOrMakeTab(
            'Root.SilverWare.Services.Facebook',
            $this->owner->fieldLabel('Facebook')
        );
        
        // Create Field Objects:
        
        $fields->addFieldsToTab(
            'Root.SilverWare.Services.Facebook',
            [
                CompositeField::create([
                    TextField::create(
                        'FacebookAppID',
                        $this->owner->fieldLabel('FacebookAppID')
                    )->setRightTitle(
                        _t(
                            __CLASS__ . '.FACEBOOKAPPIDRIGHTTITLE',
                            'Create a new app using the Facebook Developers website and paste the App ID here.'
                        )
                    )
                ])->setName('FacebookAPIConfig')->setTitle($this->owner->fieldLabel('FacebookAPIConfig'))
            ]
        );
    }
    
    /**
     * Updates the field labels of the extended object.
     *
     * @param array $labels Array of field labels from the extended object.
     *
     * @return void
     */
    public function updateFieldLabels(&$labels)
    {
        // Update Field Labels (from parent):
        
        parent::updateFieldLabels($labels);
        
        // Update Field Labels:
        
        $labels['Facebook'] = _t(__CLASS__ . '.FACEBOOK', 'Facebook');
        $labels['FacebookAppID'] = _t(__CLASS__ . '.FACEBOOKAPPID', 'Facebook App ID');
        $labels['FacebookAPIConfig'] = _t(__CLASS__ . '.FACEBOOKAPI', 'Facebook API');
    }
    
    /**
     * Answers a status message array for the CMS interface.
     *
     * @return string
     */
    public function getFacebookStatusMessage()
    {
        if (!$this->owner->FacebookAppID) {
            
            return _t(
                __CLASS__ . '.FACEBOOKAPPIDMISSING',
                'Facebook App ID has not been entered into site configuration.'
            );
            
        }
    }
    
    /**
     * Answers the HTML tag attributes for the body as an array.
     *
     * @return array
     */
    public function getBodyAttributes()
    {
        return ['data-facebook-app-id' => $this->getSiteConfig()->FacebookAppID];
    }
}
