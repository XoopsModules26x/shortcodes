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
 * @author    Michael Beck <mambax7@gmail.com> (based on code from WordPress)
 * @copyright 2015 WordPress (http://wordpress.org)
 * @copyright 2000-2015 XOOPS Project (http://xoops.org)
 * @license   GNU GPL 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 * @link      http://xoops.org
 */
class Cloak extends ExtensionAbstract
{

    protected static $jsLoaded;

    //    protected static $defaultConfiguration = ['enabled' => true];

    /**
     * @var array default configuration values
     */
    protected static $defaultConfiguration = [
        'enabled'     => true,
        'email'       => '',
        'hexEncoding' => 0];

    /**
     * @param $number
     * @param $threshold
     * @return string
     */
    protected function zeroise($number, $threshold)
    {
        return sprintf('%0' . $threshold . 's', $number);
    }

    /**
     * Register extension with the supplied sanitizer instance
     *
     * @return void
     */
    public function registerExtensionProcessing()
    {
        $config = $this->ts->getConfig('cloak'); // direct load to allow Sanitizer to change 'allowchart'
        $this->shortcodes->addShortcode('cloak', function ($attributes, $content, $tagName) use ($config) {
            $xoops    = \Xoops::getInstance();
            $defaults = [
                'email'       => '',
                'hexEncoding' => 0];

            $cleanAttributes = $this->shortcodes->shortcodeAttributes($defaults, $attributes);
            $emailAddress    = $cleanAttributes['email'];
            $hexEncoding     = $cleanAttributes['hexEncoding'];

            $email_no_spam_address = '';
            for ($i = 0, $len = strlen($emailAddress); $i < $len; $i++) {
                $j = mt_rand(0, 1 + $hexEncoding);
                if ($j == 0) {
                    $email_no_spam_address .= '&#' . ord($emailAddress[$i]) . ';';
                } elseif ($j == 1) {
                    $email_no_spam_address .= $emailAddress[$i];
                } elseif ($j == 2) {
                    $email_no_spam_address .= '%' . $this->zeroise(dechex(ord($emailAddress[$i])), 2);
                }
            }

            return str_replace('@', '&#64;', $email_no_spam_address);
        });
    }
}
