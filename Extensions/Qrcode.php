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
class Qrcode extends ExtensionAbstract
{
    protected static $jsLoaded;

    /**
     * @var array default configuration values
     */
    protected static $defaultConfiguration = [
        'enabled' => true,
        'name'    => '',
        'title'   => '',];

    /**
     * Register extension with the supplied sanitizer instance
     *
     * @return void
     */
    public function registerExtensionProcessing()
    {
        // Place following shortcode to test it:
        // [qrcode] or with options: [countryflag size=32 country="CA"]

        $config = $this->ts->getConfig('qrcode'); // direct load to allow Sanitizer to change 'allowchart'
        $this->shortcodes->addShortcode('qrcode', function ($attributes, $content, $tagName) use ($config) {
            $xoops           = \Xoops::getInstance();
            $defaults        = [
                'name'  => 'QR Code',
                'title' => 'Xoops.org',];
            $cleanAttributes = $this->shortcodes->shortcodeAttributes($defaults, $attributes);
            $title           = $cleanAttributes['title'];
            $name            = $cleanAttributes['name'];
            $newContent      = '<img src="' . \XoopsBaseConfig::get('url') . '/modules/qrcode/include/qrrender.php?text=/' . __DIR__ . ' "alt="' . $name . '"  title="' . $title . '">';

            return $newContent;
        });
    }
}
