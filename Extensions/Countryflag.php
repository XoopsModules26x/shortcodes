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
class Countryflag extends ExtensionAbstract
{

    protected static $jsLoaded;

    /**
     * @var array default configuration values
     */
    protected static $defaultConfiguration = [
        'enabled' => true,
        'size'    => '',
        'country' => '',];

    /**
     * Register extension with the supplied sanitizer instance
     *
     * @return void
     */
    public function registerExtensionProcessing()
    {
        // Place following shortcode to test it:
        // [countryflag] or with options: [countryflag size=32 country="CA"]
        // Flag sizes are: 16, 32, 64,
        // Countries are standard two letter country codes, e.g. US for USA, FR for France, DE for Germany, etc.

        $config = $this->ts->getConfig('countryflag'); // direct load to allow Sanitizer to change 'allowchart'

        $this->shortcodes->addShortcode('countryflag', function ($attributes, $content, $tagName) use ($config) {
            $defaults = [
                'size'    => '64',
                'country' => 'US',];

            $cleanAttributes = $this->shortcodes->shortcodeAttributes($defaults, $attributes);
            $size            = $cleanAttributes['size'];
            $country         = $cleanAttributes['country'];

            $newContent = '<img src="' . \XoopsBaseConfig::get('url') . '/media/xoops/images/flags/' . $size . '/' . $country . '.png"' . '"  alt="' . $country . '">';

            return $newContent;

        });
    }
}
