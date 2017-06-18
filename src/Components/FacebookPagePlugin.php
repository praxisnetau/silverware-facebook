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

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;
use SilverWare\Components\BaseComponent;
use SilverWare\Forms\FieldSection;

/**
 * An extension of the base component class for a Facebook Page plugin.
 *
 * @package SilverWare\Facebook\Components
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-facebook
 */
class FacebookPagePlugin extends BaseComponent
{
    /**
     * Define tab constants.
     */
    const TAB_TIMELINE = 'timeline';
    const TAB_EVENTS   = 'events';
    const TAB_MESSAGES = 'messages';
    
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'Facebook Page Plugin';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'Facebook Page Plugins';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'A component which shows a Facebook Page plugin';
    
    /**
     * Icon file for this object.
     *
     * @var string
     * @config
     */
    private static $icon = 'silverware-facebook/admin/client/dist/images/icons/FacebookPagePlugin.png';
    
    /**
     * Defines an ancestor class to hide from the admin interface.
     *
     * @var string
     * @config
     */
    private static $hide_ancestor = BaseComponent::class;
    
    /**
     * Defines the allowed children for this object.
     *
     * @var array|string
     * @config
     */
    private static $allowed_children = 'none';
    
    /**
     * Maps field names to field types for this object.
     *
     * @var array
     * @config
     */
    private static $db = [
        'PageName' => 'Varchar(255)',
        'PageURL' => 'Varchar(2048)',
        'Height' => 'AbsoluteInt',
        'ShowTabs' => 'Varchar(255)',
        'ShowFaces' => 'Boolean',
        'HideCover' => 'Boolean',
        'UseSmallHeader' => 'Boolean'
    ];
    
    /**
     * Defines the default values for the fields of this object.
     *
     * @var array
     * @config
     */
    private static $defaults = [
        'ShowTabs' => '["timeline"]',
        'ShowFaces' => 1,
        'HideCover' => 0,
        'UseSmallHeader' => 0
    ];
    
    /**
     * Maps field and method names to the class names of casting objects.
     *
     * @var array
     * @config
     */
    private static $casting = [
        'PluginAttributesHTML' => 'HTMLFragment'
    ];
    
    /**
     * Answers a list of field objects for the CMS interface.
     *
     * @return FieldList
     */
    public function getCMSFields()
    {
        // Obtain Field Objects (from parent):
        
        $fields = parent::getCMSFields();
        
        // Add Status Message (if exists):
        
        $fields->addStatusMessage($this->getSiteConfig()->getFacebookStatusMessage());
        
        // Create Main Fields:
        
        $fields->addFieldsToTab(
            'Root.Main',
            [
                TextField::create(
                    'PageName',
                    $this->fieldLabel('PageName')
                ),
                TextField::create(
                    'PageURL',
                    $this->fieldLabel('PageURL')
                ),
                CheckboxSetField::create(
                    'ShowTabs',
                    $this->fieldLabel('ShowTabs'),
                    $this->getShowTabOptions()
                )
            ]
        );
        
        // Create Options Fields:
        
        $fields->addFieldToTab(
            'Root.Options',
            FieldSection::create(
                'FacebookPagePluginOptions',
                $this->i18n_singular_name(),
                [
                    TextField::create(
                        'Height',
                        $this->fieldLabel('Height')
                    ),
                    CheckboxField::create(
                        'HideCover',
                        $this->fieldLabel('HideCover')
                    ),
                    CheckboxField::create(
                        'ShowFaces',
                        $this->fieldLabel('ShowFaces')
                    ),
                    CheckboxField::create(
                        'UseSmallHeader',
                        $this->fieldLabel('UseSmallHeader')
                    )
                ]
            )
        );
        
        // Answer Field Objects:
        
        return $fields;
    }
    
    /**
     * Answers a validator for the CMS interface.
     *
     * @return RequiredFields
     */
    public function getCMSValidator()
    {
        return RequiredFields::create([
            'PageName',
            'PageURL'
        ]);
    }
    
    /**
     * Answers the labels for the fields of the receiver.
     *
     * @param boolean $includerelations Include labels for relations.
     *
     * @return array
     */
    public function fieldLabels($includerelations = true)
    {
        // Obtain Field Labels (from parent):
        
        $labels = parent::fieldLabels($includerelations);
        
        // Define Field Labels:
        
        $labels['Height'] = _t(__CLASS__ . '.HEIGHTINPIXELS', 'Height (in pixels)');
        $labels['PageURL'] = _t(__CLASS__ . '.PAGEURL', 'Page URL');
        $labels['PageName'] = _t(__CLASS__ . '.PAGENAME', 'Page name');
        $labels['ShowTabs'] = _t(__CLASS__ . '.SHOWTABS', 'Show tabs');
        $labels['HideCover'] = _t(__CLASS__ . '.HIDECOVER', 'Hide cover');
        $labels['ShowFaces'] = _t(__CLASS__ . '.SHOWFACES', 'Show faces');
        $labels['UseSmallHeader'] = _t(__CLASS__ . '.USESMALLHEADER', 'Use small header');
        
        // Answer Field Labels:
        
        return $labels;
    }
    
    /**
     * Answers a unique ID for the wrapper element.
     *
     * @return string
     */
    public function getWrapperID()
    {
        return sprintf('%s_Wrapper', $this->getHTMLID());
    }
    
    /**
     * Answers an array of wrapper class names for the HTML template.
     *
     * @return array
     */
    public function getWrapperClassNames()
    {
        $classes = ['wrapper'];
        
        $this->extend('updateWrapperClassNames', $classes);
        
        return $classes;
    }
    
    /**
     * Answers an array of HTML tag attributes for the plugin.
     *
     * @return array
     */
    public function getPluginAttributes()
    {
        $attributes = [
            'class' => 'fb-page',
            'data-href' => $this->dbObject('PageURL')->URL(),
            'data-tabs' => $this->getTabsAttribute(),
            'data-small-header' => $this->dbObject('UseSmallHeader')->NiceAsBoolean(),
            'data-hide-cover' => $this->dbObject('HideCover')->NiceAsBoolean(),
            'data-show-facepile' => $this->dbObject('ShowFaces')->NiceAsBoolean(),
            'data-adapt-container-width' => 'true'
        ];
        
        if ($this->Height) {
            $attributes['data-height'] = $this->Height;
        }
        
        $this->extend('updatePluginAttributes', $attributes);
        
        return $attributes;
    }
    
    /**
     * Answers the HTML tag attributes for the plugin as a string.
     *
     * @return string
     */
    public function getPluginAttributesHTML()
    {
        return $this->getAttributesHTML($this->getPluginAttributes());
    }
    
    /**
     * Answers the value for the tabs attribute.
     *
     * @return string
     */
    public function getTabsAttribute()
    {
        return implode(',', json_decode($this->ShowTabs, true));
    }
    
    /**
     * Answers true if the object is disabled within the template.
     *
     * @return boolean
     */
    public function isDisabled()
    {
        if (!$this->PageURL || !$this->getSiteConfig()->FacebookAppID) {
            return true;
        }
        
        return parent::isDisabled();
    }
    
    /**
     * Answers an array of options for the show tab field.
     *
     * @return array
     */
    public function getShowTabOptions()
    {
        return [
            self::TAB_TIMELINE => _t(__CLASS__ . '.TIMELINE', 'Timeline'),
            self::TAB_EVENTS => _t(__CLASS__ . '.EVENTS', 'Events'),
            self::TAB_MESSAGES => _t(__CLASS__ . '.MESSAGES', 'Messages')
        ];
    }
}
