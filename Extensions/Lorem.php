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
class Lorem extends ExtensionAbstract
{

    protected static $jsLoaded;

    //    protected static $defaultConfiguration = ['enabled' => true];

    /**
     * @var array default configuration values
     */
    protected static $defaultConfiguration = [
        'enabled' => true,
        'lorem'   => ''
    ];

    /**
     * Register extension with the supplied sanitizer instance
     *
     * @return void
     */
    public function registerExtensionProcessing()
    {
        $config = $this->ts->getConfig('lorem'); // direct load to allow Sanitizer to change 'allowchart'
        $this->shortcodes->addShortcode('lorem', function ($attributes, $content, $tagName) use ($config) {
            $defaults        = ['lorem' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec nulla vitae lacus mattis volutpat eu at sapien. Nunc interdum congue libero, quis laoreet elit sagittis ut. Pellentesque lacus erat, dictum condimentum pharetra vel, malesuada volutpat risus. Nunc sit amet risus dolor. Etiam posuere tellus nisl. Integer lorem ligula, tempor eu laoreet ac, eleifend quis diam. Proin cursus, nibh eu vehicula varius, lacus elit eleifend elit, eget commodo ante felis at neque. Integer sit amet justo sed elit porta convallis a at metus. Suspendisse molestie turpis pulvinar nisl tincidunt quis fringilla enim lobortis. Curabitur placerat quam ac sem venenatis blandit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam sed ligula nisl. Nam ullamcorper elit id magna hendrerit sit amet dignissim elit sodales. Aenean accumsan consectetur rutrum.'];

            $cleanAttributes = $this->shortcodes->shortcodeAttributes($defaults, $attributes);
            $lorem           = $cleanAttributes['lorem'];

            return $lorem;
        });
    }
}
