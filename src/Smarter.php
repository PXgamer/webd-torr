<?php

namespace pxgamer\wdTorr;

/**
 * Class Smarter.
 */
class Smarter
{
    /**
     * @var \Smarty
     */
    public static $smarty;

    /**
     * @return \Smarty
     */
    public static function get()
    {
        if (!isset(self::$smarty)) {
            self::$smarty = new \Smarty();
        }
        self::$smarty->setTemplateDir(SRC_PATH.'/Templates/');
        self::$smarty->setCompileDir(SRC_PATH.'/Templates_c/');
        self::$smarty->setPluginsDir(SRC_PATH.'/SmartyPlugins/');

        return self::$smarty;
    }
}
