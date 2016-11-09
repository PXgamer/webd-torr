<?php

namespace pxgamer;

class wDT
{
    private static $templates = null;
    private static $currentTemplate = null;
    private static $currentHelper = null;

    public function __construct()
    {
    }

    public function getTemplates()
    {
        if (!self::$templates) {
            self::$templates = [];
            $tmpList = glob('views/*.phtml');
            foreach ($tmpList as $l) {
                preg_match_all("/views\/(.*)\.phtml/i", $l, $match);
                self::$templates[$match[1][0]] = $l;
            }
        }

        return self::$templates;
    }

    public function getCurrentTemplate()
    {
        if (!self::$currentTemplate) {
            self::$currentTemplate = (isset($_GET['template'])) ? $_GET['template'] : '';
        }

        return self::$currentTemplate;
    }

    public function getCurrentHelper()
    {
        if (!self::$currentHelper) {
            self::$currentHelper = ((isset($_GET['template'])) ? $_GET['template'] : '').'Helper';
        }

        return self::$currentHelper;
    }

    public function getTemplateContent($template = '')
    {
        $template = ($template !== '') ? $template : self::$currentTemplate;

        return (isset(self::$templates[$template]) && file_exists(self::$templates[$template])) ? file_get_contents(self::$templates[$template]) : '';
    }

    public function getTorrentsList()
    {
        return [];
    }
}
