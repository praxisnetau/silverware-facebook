<?php

/**
 * This file is part of SilverWare.
 *
 * PHP version >=5.6.0
 *
 * For full copyright and license information, please view the
 * LICENSE.md file that was distributed with this source code.
 *
 * @package SilverWare\Facebook\Buttons
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-facebook
 */

namespace SilverWare\Facebook\Buttons;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\DropdownField;
use SilverWare\Social\Model\SharingButton;

/**
 * An extension of the sharing button class for a Facebook sharing button.
 *
 * @package SilverWare\Facebook\Buttons
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-facebook
 */
class FacebookSharingButton extends SharingButton
{
    /**
     * Define layout constants.
     */
    const LAYOUT_BUTTON       = 'button';
    const LAYOUT_BOX_COUNT    = 'box_count';
    const LAYOUT_BUTTON_COUNT = 'button_count';
    
    /**
     * Define size constants.
     */
    const SIZE_SMALL = 'small';
    const SIZE_LARGE = 'large';
    
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'Facebook Sharing Button';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'Facebook Sharing Buttons';
    
    /**
     * Defines an ancestor class to hide from the admin interface.
     *
     * @var string
     * @config
     */
    private static $hide_ancestor = SharingButton::class;
    
    /**
     * Maps field names to field types for this object.
     *
     * @var array
     * @config
     */
    private static $db = [
        'ButtonSize' => 'Varchar(16)',
        'ButtonLayout' => 'Varchar(32)',
        'MobileIFrame' => 'Boolean'
    ];
    
    /**
     * Defines the default values for the fields of this object.
     *
     * @var array
     * @config
     */
    private static $defaults = [
        'ButtonSize' => 'small',
        'ButtonLayout' => 'button_count',
        'MobileIFrame' => 0
    ];
    
    /**
     * Maps field and method names to the class names of casting objects.
     *
     * @var array
     * @config
     */
    private static $casting = [
        'ButtonAttributesHTML' => 'HTMLFragment'
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
        
        // Create Style Fields:
        
        $fields->addFieldToTab(
            'Root.Style',
            CompositeField::create([
                DropdownField::create(
                    'ButtonSize',
                    $this->fieldLabel('ButtonSize'),
                    $this->getButtonSizeOptions()
                ),
                DropdownField::create(
                    'ButtonLayout',
                    $this->fieldLabel('ButtonLayout'),
                    $this->getButtonLayoutOptions()
                )
            ])->setName('FacebookSharingButtonStyle')->setTitle($this->i18n_singular_name())
        );
        
        // Create Options Fields:
        
        $fields->addFieldToTab(
            'Root.Options',
            CompositeField::create([
                CheckboxField::create(
                    'MobileIFrame',
                    $this->fieldLabel('MobileIFrame')
                )
            ])->setName('FacebookSharingButtonOptions')->setTitle($this->i18n_singular_name())
        );
        
        // Answer Field Objects:
        
        return $fields;
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
        
        $labels['ButtonSize'] = _t(__CLASS__ . '.BUTTONSIZE', 'Button size');
        $labels['ButtonLayout'] = _t(__CLASS__ . '.BUTTONLAYOUT', 'Button layout');
        $labels['MobileIFrame'] = _t(__CLASS__ . '.USEIFRAMEONMOBILE', 'Use <iframe> on mobile');
        
        // Answer Field Labels:
        
        return $labels;
    }
    
    /**
     * Populates the default values for the fields of the receiver.
     *
     * @return void
     */
    public function populateDefaults()
    {
        // Populate Defaults (from parent):
        
        parent::populateDefaults();
        
        // Populate Defaults:
        
        $this->Name = _t(__CLASS__ . '.SHAREVIAFACEBOOK', 'Share via Facebook');
    }
    
    /**
     * Answers an array of HTML tag attributes for the button.
     *
     * @return array
     */
    public function getButtonAttributes()
    {
        $attributes = [
            'class' => $this->ButtonClass,
            'data-href' => $this->Link,
            'data-size' => $this->ButtonSize,
            'data-layout' => $this->ButtonLayout,
            'data-mobile-iframe' => $this->dbObject('MobileIFrame')->NiceAsBoolean()
        ];
        
        $this->extend('updateButtonAttributes', $attributes);
        
        return $attributes;
    }
    
    /**
     * Answers the HTML tag attributes for the button as a string.
     *
     * @return string
     */
    public function getButtonAttributesHTML()
    {
        return $this->getAttributesHTML($this->getButtonAttributes());
    }
    
    /**
     * Answers an array of button class names for the HTML template.
     *
     * @return array
     */
    public function getButtonClassNames()
    {
        $classes = ['fb-share-button'];
        
        $this->extend('updateButtonClassNames', $classes);
        
        return $classes;
    }
    
    /**
     * Answers an array of options for the button size field.
     *
     * @return array
     */
    public function getButtonSizeOptions()
    {
        return [
            self::SIZE_SMALL => _t(__CLASS__ . '.SMALL', 'Small'),
            self::SIZE_LARGE => _t(__CLASS__ . '.LARGE', 'Large')
        ];
    }
    
    /**
     * Answers an array of options for the button layout field.
     *
     * @return array
     */
    public function getButtonLayoutOptions()
    {
        return [
            self::LAYOUT_BUTTON => _t(__CLASS__ . '.BUTTON', 'Button'),
            self::LAYOUT_BOX_COUNT => _t(__CLASS__ . '.BOXCOUNT', 'Box Count'),
            self::LAYOUT_BUTTON_COUNT => _t(__CLASS__ . '.BUTTONCOUNT', 'Button Count')
        ];
    }
}
