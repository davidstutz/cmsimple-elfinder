<?php
/**
 * @file elfinder.php
 * @brief Containing Elfinder class.
 *
 * Elfinder plugin elfinder.php
 * 
 * @author David Stutz
 * @version 1.0.0
 * @license GPLv3
 * @package elfinder
 * @see http://sourceforge.net/projects/cmsimplepictures/
 * 
 *  This file is part of the elfinder editor plugin for CMSimple.
 *
 *  The plugin is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The plugin is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *  GNU General Public License for more details.
 *
 *  @see <http://www.gnu.org/licenses/>.
 */

if (!class_exists('Elfinder')) {
    // include_once '../../elfinder.php';
    include_once 'plugins/elfinder/elfinder.php';
}

 /**
  * Functio to initialize Elfinder for Elrte editor.
  * 
  * @global pth
  * @global sl
  * @global sn
  * @global cf
  * @global plugin_cf
  * @global cf
  * 
  * @return <string> script
  */
function elfinder_elrte_init()
{
	global $pth, $sl, $sn, $cf, $plugin_cf, $cf;
	
	/**
	 * Load configuration.
	 */
	include_once $pth['folder']['plugins'] . 'elfinder/config/config.php';
	
	if (!isset($_SESSION))
	{
		session_start();
	}
	
	if(file_exists($pth['folder']['plugins'] . 'jquery/jquery.inc.php')
                AND !function_exists('include_jQuery'))
	{
		include $pth['folder']['plugins'] . 'jquery/jquery.inc.php';
	}
	
	/* Use JQuery plugin if possible. */
	
	if(!function_exists('include_jQuery'))
	{
		/* Include JQuery and JQuery UI. */
		Elfinder::include_jquery();
	}
	else
	{
		/* Include JQuery. */
		include_jQuery();
		
		/* Include JQuery UI. */
		include_jQueryUI();
	}
	
	/**
	 * Init elfinder.
	 */
	Elfinder::include_elfinder();
	
        $_SESSION['elfinder']['folders'] = $cf['folders'];
        $_SESSION['elfinder']['folders']['plugins'] = $pth['folder']['plugins'];
        $_SESSION['elfinder']['sn'] = $sn;
        $_SESSION['elfinder']['url'] = $_SERVER['HTTP_HOST'] . $sn . '/userfiles/';
        $_SESSION['elfinder']['root'] = realpath($pth['folder']['userfiles']);
        $_SESSION['elfinder']['images_library'] = $plugin_cf['elfinder']['images_library'];
        
	return 'elrte_filebrowser_callback = function(callback, folder) {
				//$("<div />").dialogelfinder({
				//  url : "' . $sn . $pth['folder']['plugins'] . '/elfinder/elfinder/connectors/connector.php?type=" + folder,
                                //  commandsOptions: {
                                //    getfile: {
                                //      oncomplete: "destroy" // destroy elFinder after file selection
                                //    }
                                //  },
                                //  getFileCallback: callback // pass callback to file manager
                                //});
				$(\'<div id="elfinder" />\').elfinder({
					url : "' . $sn . $pth['folder']['plugins'] . '/elfinder/elfinder/connectors/connector.php",
				 	lang : "' . $sl . '",
				 	places : "",
				 	dialog : {
				 		width : 900,
				 		modal : true,
				 	},
				 	closeOnEditorCallback: true,
				 	editorCallback: callback,
				});
			};';
}
