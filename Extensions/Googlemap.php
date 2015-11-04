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
 * TextSanitizer extension
 *
 * @category  Sanitizer\Extensions\
 * @package   Xoops\Core\Text
 * @author    Michael Beck <mambax7@gmail.com>
 * @copyright 2000-2015 XOOPS Project (http://xoops.org)
 * @license   GNU GPL 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 * @link      http://xoops.org
 */
class Googlemap extends ExtensionAbstract
{

    protected static $jsLoaded;

    /**
     * @var array default configuration values
     */

    protected static $defaultConfiguration = [
        'enabled'    => true,
        'template'   => '<iframe src="%1$s" width="100%%" height="%2$d" scrolling="auto" frameborder="yes" marginwidth="0" marginheight="0" sandbox></iframe>',
        'clickable'  => true,  // Click to open a map in a new window in full size
        'resize'     => true,     // Resize the map down to max_width set below
        'max_width'  => 640,   // Maximum width of a map displayed on page
        'max_height' => 480,   // Maximum width of a map displayed on page
        'allowmap'   => true, // true to allow maps, false to force links only
    ];

    /**
     * Register extension with the supplied sanitizer instance
     *
     * @return void
     */
    public function registerExtensionProcessing()
    {
        // Place following shortcode to test it:
        // [googlemap width="600" height="300" src="http://maps.google.com/maps?q=Heraklion,+Greece&hl=en&ll=35.327451,25.140495&spn=0.233326,0.445976& sll=37.0625,-95.677068&sspn=57.161276,114.169922& oq=Heraklion&hnear=Heraklion,+Greece&t=h&z=12"]

        $config = $this->ts->getConfig('googlemap'); // direct load to allow Sanitizer to change 'allowchart'

        $this->shortcodes->addShortcode('googlemap', function ($attributes, $content, $tagName) use ($config) {
            $xoops           = \Xoops::getInstance();
            $defaults        = [
                'width'  => 640,
                'height' => 480,
                'src'    => '',];
            $cleanAttributes = $this->shortcodes->shortcodeAttributes($defaults, $attributes);
            $width           = $cleanAttributes['width'];
            if (preg_match('/[0-9]{1}$/', $width)) {
                $width .= 'px';
            }
            $height = $cleanAttributes['height'];
            if (preg_match('/[0-9]{1}$/', $height)) {
                $height .= 'px';
            }
            $src        = $cleanAttributes['src'];
            $newContent = '<iframe width="' . $width . '" height="' . $height . '" src="' . $src . '&output=embed" ></iframe>';

            return $newContent;
        });
    }
}
