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
class Chart extends ExtensionAbstract
{

    protected static $jsLoaded;

    protected static $defaultConfiguration = [
        'enabled'   => true,
        'data'      => '',
        'colors'    => '',
        'size'      => '400x200',
        'bg'        => 'ffffff',
        'title'     => '',
        'labels'    => '',
        'advanced'  => '',
        'charttype' => 'pie'];

    /**
     * Register extension with the supplied sanitizer instance
     *
     * @return void
     */
    public function registerExtensionProcessing()
    {
// Place following shortcode to test it:
// [chart charttype="pie" title="Example Pie Chart" data="41.12,32.35,21.52,5.01" labels="First+Label|Second+Label|Third+Label|Fourth+Label" background_color="FFFFFF" colors="D73030,329E4A,415FB4,DFD32F" size="450x180"]

        $config = $this->ts->getConfig('chart');
        $this->shortcodes->addShortcode('chart', function ($attributes, $content, $tagName) use ($config) {
            $defaults = [
                'enabled'          => true,
                'data'             => '',
                'colors'           => '',
                'size'             => '400x200',
                'background_color' => 'ffffff',
                'title'            => '',
                'labels'           => '',
                'advanced'         => '',
                'charttype'        => 'pie'];

            $cleanAttributes  = $this->shortcodes->shortcodeAttributes($defaults, $attributes);
            $type             = $cleanAttributes['charttype'];
            $title            = $cleanAttributes['title'];
            $data             = $cleanAttributes['data'];
            $labels           = $cleanAttributes['labels'];
            $background_color = $cleanAttributes['background_color'];
            $colors           = $cleanAttributes['colors'];
            $size             = $cleanAttributes['size'];

            switch ($type) {
                case 'line' :
                    $charttype = 'lc';
                    break;
                case 'xyline' :
                    $charttype = 'lxy';
                    break;
                case 'sparkline' :
                    $charttype = 'ls';
                    break;
                case 'meter' :
                    $charttype = 'gom';
                    break;
                case 'scatter' :
                    $charttype = 's';
                    break;
                case 'venn' :
                    $charttype = 'v';
                    break;
                case 'pie' :
                    $charttype = 'p3';
                    break;
                case 'pie2d' :
                    $charttype = 'p';
                    break;
                default :
                    $charttype = $type;
                    break;
            }

            $string = '';

            if ($title) {
                $string .= '&chtt=' . $title . '';
            }
            if ($labels) {
                $string .= '&chl=' . $labels . '';
            }
            if ($colors) {
                $string .= '&chco=' . $colors . '';
            }
            $string .= '&chs=' . $size . '';
            $string .= '&chd=t:' . $data . '';
            $string .= '&chf=' . $background_color . '';

            $newContent = '<img title="' . $title . '" src="http://chart.apis.google.com/chart?cht=' . $charttype . $string . $advanced . '" alt="' . $title . '" />';

            return $newContent;
        });
    }
}
