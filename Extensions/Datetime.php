<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

namespace Xoops\Core\Text\Sanitizer\Extensions;

use Xoops\Core\Text\Sanitizer;
use Xoops\Core\Text\Sanitizer\ExtensionAbstract;

/**
 * Googlechart extension
 *
 * @category  Sanitizer\Extensions
 * @package   Xoops\Core\Text
 * @author    Michael Beck <mambax7@gmail.com>
 * @copyright 2000-2015 XOOPS Project (http://xoops.org)
 * @license   GNU GPL 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 * @link      http://xoops.org
 */
class Datetime extends ExtensionAbstract
{

    protected static $jsLoaded;

    /**
     * @var array default configuration values
     */
    protected static $defaultConfiguration = [
        'enabled'   => true,
        'label'     => 'Today',
        'datevalue' => '11/05/2015',
        'id'        => 'date',
        'alt'       => 'Select',
        'title'     => 'Date',
        'name'      => '',
        'date'      => ''];

    /**
     * Register extension with the supplied sanitizer instance
     *
     * @return void
     */
    public function registerExtensionProcessing()
    {
        // Place following shortcode to test it:
        // [datetime label="Today" datevalue = "11/05/2015" id="date" alt="Select" title="Date"]

        $config = $this->ts->getConfig('datetime'); // direct load to allow Sanitizer to change 'allowchart'
        $this->shortcodes->addShortcode('datetime', function ($attributes, $content, $tagName) use ($config) {
            $xoops    = \Xoops::getInstance();
            $defaults = [
                'label'     => 'Today',
                'datevalue' => '11/05/2015',
                'id'        => 'date',
                'alt'       => 'Select',
                'title'     => 'Date',
                'name'      => '',
                'date'      => '',];

            $cleanAttributes = $this->shortcodes->shortcodeAttributes($defaults, $attributes);
            $title           = $cleanAttributes['title'];
            $name            = $cleanAttributes['name'];
            $alt             = $cleanAttributes['alt'];
            $label           = $cleanAttributes['label'];
            $id              = $cleanAttributes['id'];
            $datevalue       = $cleanAttributes['datevalue'];

            $newContent = '<div class="control-group"><label class="control-label">' . $label . '<span class="caption-required">*</span></label>
            <div class="controls"><input type="text" name="date" size="12" maxlength="12" required="" class="span2 hasDatepicker" title="'
            . $title . '" id="' . $id . '" value="' . $datevalue . '"><button type="button" class="ui-datepicker-trigger"><img src="'
            . \XoopsBaseConfig::get('url'). '/media/xoops/images/icons/calendar.png"' . ' alt="' . $alt . '" title="' . $alt
            . '"></button> <span class="dsc_pattern_horizontal"></span> <p class="help-block">' . $label . '</p></div></div>';

            return $newContent;
        });
    }
}
