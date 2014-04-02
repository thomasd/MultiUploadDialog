<?php
/**
 * plugins transport file for MultiUploadDialog extra
 *
 * Copyright 2014 by Thomas Dullnig 
 * Created on 02-27-2014
 *
 * @package multiuploaddialog
 * @subpackage build
 */

if (! function_exists('stripPhpTags')) {
    function stripPhpTags($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<' . '?' . 'php', '', $o);
        $o = str_replace('?>', '', $o);
        $o = trim($o);
        return $o;
    }
}
/* @var $modx modX */
/* @var $sources array */
/* @var xPDOObject[] $plugins */


$plugins = array();

$plugins[1] = $modx->newObject('modPlugin');
$plugins[1]->fromArray(array (
  'id' => 1,
  'property_preprocess' => false,
  'name' => 'MultiUploadDialogInjector',
  'description' => 'This plugin replaces the default upload dialog with an enhanced multi-upload dialog, capable of multi file select and drag\'n\'drop.',
  'properties' => 
  array (
  ),
  'disabled' => false,
), '', true, true);
$plugins[1]->setContent(file_get_contents($sources['source_core'] . '/elements/plugins/multiuploaddialoginjector.plugin.php'));

return $plugins;
