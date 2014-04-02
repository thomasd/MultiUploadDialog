<?php
/**
 * MultiUploadDialogInjector plugin for MultiUploadDialog extra
 *
 * Copyright 2014 by Thomas Dullnig
 * Created on 02-27-2014
 *
 * MultiUploadDialog is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * MultiUploadDialog is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * MultiUploadDialog; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package multiuploaddialog
 */

/**
 * Description
 * -----------
 * This plugin replaces the default upload dialog with an enhanced multi-upload dialog, capable of multi file select and drag'n'drop.
 *
 * Variables
 * ---------
 * @var $modx modX
 * @var $scriptProperties array
 *
 * @package multiuploaddialog
 **/

if(!function_exists('add_lang_topic')){
    function add_lang_topic($topic = 'multiuploaddialog:default', $prefix = 'multiuploaddialog'){
        global $modx;
        $modx->lexicon->load($topic);
        $lang = $modx->lexicon->fetch($prefix);
        if($lang){
            //I HATE javascript code inside PHP strings!!!!!! Still I have to use it...cruel world!
            $modx->regClientStartupHTMLBlock(
                '<script>
                    Ext.namespace("MODx.lang");
                    Ext.applyIf(MODx.lang, ' . json_encode($lang) . ');
                </script>'
            );
        }
    }
}

switch($modx->event->name){
    case 'OnManagerPageBeforeRender':

        $modx->controller->addLexiconTopic('multiuploaddialog:default');
        $modx->regClientStartupScript(MODX_ASSETS_URL . 'components/multiuploaddialog/libs/fileapi/FileAPI.min.js');
        $modx->regClientStartupScript(MODX_ASSETS_URL . 'components/multiuploaddialog/js/multiuploaddialog-min.js');

        break;
    case 'OnRichTextBrowserInit':
        //MODx does not use modManagerController::addLexiconTopic for file-browser-view so we have to load the language topic manually.
        add_lang_topic();
        break;
}