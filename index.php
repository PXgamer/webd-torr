<?php

require 'loader.php';

$wDT = new \pxgamer\wDT();

$templatesList = $wDT->getTemplates();
$currentTemplate = $wDT->getCurrentTemplate();
$currentHelper = $wDT->getCurrentHelper();
$templateContent = $wDT->getTemplateContent('layout');
$torrentsList = $wDT->getTorrentsList();

if ($currentTemplate !== '') {
    $templateContent = preg_replace('/\{\{mainContent\}\}/', $wDT->getTemplateContent($currentTemplate), $templateContent);
    include 'helpers/'.$currentHelper.'.php';
    $helper = new $currentHelper();
    $templateContent = $helper->viewReplace($templateContent, $torrentsList);
} else {
    $templateContent = preg_replace('/\{\{mainContent\}\}/', '', $templateContent);
}

echo $templateContent;
