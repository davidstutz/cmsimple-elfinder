<?php
/**
 * @file admin.php
 * @brief Admin area.
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

if (!defined('CMSIMPLE_XH_VERSION')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}
 
if (!class_exists('Elfinder')) require dirname(__FILE__)."/elfinder.php";

if(isset($elfinder))
{
	initvar('admin');
	initvar('post');
	
	$plugin = basename(dirname(__FILE__),"/");
	
	$o .= print_plugin_admin('on');
	
	if($admin != 'plugin_main')
	{
		$o .= plugin_admin_common($action,$admin,$plugin);
	}

	if ($action == ''
		OR $action == 'plugin_text')
	{
		/* Plugin information. */
		$o .= '<p><b>' . Elfinder::name() . '</b></p>'
				. '<hr />'
				. '<p class="elfinder-notice">'
                                    . 'Version: ' . Elfinder::VERSION . '<br />'
                                . '</p>'
                                . '<p class="elfinder-help">'
                                    . 'Released: ' . Elfinder::release_date() . '<br />'
                                    . 'Author: ' . Elfinder::author() . '<br />'
                                    . 'GitHub Repository/Releases: ' . Elfinder::github() . '<br />'
                                    . Elfinder::description() . '<br />'
                                    . Elfinder::legal() . '<br />'
				.'</p>';
	}
}


/**
 * Load the filebrowser if a filetype is requested.
 */
if($adm)
{
	if(isset($cf['filebrowser']['external'])
		AND $cf['filebrowser']['external'] != 'elfinder')
	{
		return;
	}
	
	/* Detect type. */
	if ($images
		OR $function == 'images')
	{
		$type = 'images';
	}
	if ($downloads
		OR $function == 'downloads')
	{
		$type = 'downloads';
	}
	if ($media)
	{
		 $type = 'media';
	}
	if ($userfiles)
	{
		$type = 'userfiles';
	}
	
	if (isset($type)
		AND $type != '')
	{
		$f = $type;
		
		if (file_exists($pth['folder']['plugins'] . 'jquery/jquery.inc.php'))
		{
			include_once($pth['folder']['plugins'] . 'jquery/jquery.inc.php'); 
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
	
		/* Include elfinder. */
		Elfinder::include_elfinder();
					
		/**
		 * All configuraiton is done usign session.
		 * Start session if not started yet.
		 */
		if (!isset($_SESSION))
		{
			session_start();
		}
		
		$_SESSION['elfinder']['folders'] = $cf['folders'];
		$_SESSION['elfinder']['folders']['plugins'] = $pth['folder']['plugins'];
		$_SESSION['elfinder']['sn'] = $sn;
		$_SESSION['elfinder']['url'] = $_SERVER['HTTP_HOST'] . $sn . '/userfiles/';
		$_SESSION['elfinder']['alias'] = ucfirst($type);
		$_SESSION['elfinder']['root'] = realpath($pth['folder']['userfiles']);
		$_SESSION['elfinder']['images_library'] = $plugin_cf[$plugin]['images_library'];
		
		/* Init elfinder. */
		$hjs .= '<script type="text/javascript">
			$().ready(function() {
				$(".elfinder").elfinder({
					url         : "' . $pth['folder']['plugins'] . $plugin . '/elfinder/connectors/connector.php",
					lang        : "' . $sl . '",
					places      : "",
					toolbar     : elfinder_toolbar,
					contextmenu : elfinder_contextmenu,
				});
			});
			</script>';
		
		$o .= '<h1>' . $tx['editmenu'][$type] . '</h1>';
		$o .= '<div class="elfinder"></div>';
		
		/* Reset variables. */
		$images = $downloads = $userfiles = $media = FALSE;
	}
}
?>