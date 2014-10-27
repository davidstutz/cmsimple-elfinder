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
 *  This file is part of the elfinder filebrowser plugin for CMSimple.
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
/*! \mainpage CMSimple Elfinder Filebrowser
 *
 * This plugin provides the Elfinder filebrowser for usage in your CMSimple installation.
 * 
 * This is  a generated documentation of the plugin.
 * 
 * \mainpage
 */

 /**
 * @class Elfinder
 * 
 * Elfinder class for generla informartion and script including.
 * 
 * @author David Stutz
 * @since 1.0.0
 * @package elfinder
 */
class Elfinder {

	/**
	 * Current version.
	 * 
	 * @var <string>
	 */
	const VERSION = '1.0.0beta1';
	
	/**
	 * @static
	 * @public
	 * Get plugin's name.
	 * 
	 * @return <string> name
	 */
	static function name()
	{
		return "Elfinder filebrowser plugin.";
	}
	
	/**
	 * @static
	 * @public
	 * Get plugin's release date.
	 * 
	 * @return <string> release date.
	 */
	static function release_date() 
	{
	   return "27th October 2014";
	}
	
	/**
	 * @static
	 * @public
	 * Get plugin's author.
	 * 
	 * @return <string> author.
	 */
	static function author()
	{
		return "David Stutz";
	}
	
	/**
	 * @static
	 * @public
	 * Get plugin's website.
	 * 
	 * @return <string> website link
	 */
	static function github()
	{
		return '<a href="https://github.com/davidstutz/cmsimple-elfinder" target="_blank">GitHub Repository</a>';
	}
	
	/**
	 * @static
	 * @public
	 * Get plugin's description.
	 * 
	 * @return <string> description
	 */
	static function description()
	{
		return 'Elfinder filebrowser plugin.';
	}
	
	/**
	 * @static
	 * @public
	 * Legal notes on elfinder.
	 * 
	 * @return <string> legal
	 */
	static function legal()
	{
		return '<q>elFinder is an open-source file manager for web, written in JavaScript using jQuery UI. As you can see its creation is inspired by simplicity and convenience of Finder program used in Mac OS X operating system.</q><br />'
			.'For more information see: <a href="https://github.com/Studio-42/elFinder" target="_blank">elFinder Website</a><br />'
			.'elFinder license: BSD - see <a href="http://en.wikipedia.org/wiki/BSD_licenses">Wikipedia</a><br />'
			.'JQuery and JQuery-UI license: MIT and GPL - see <a href="http://en.wikipedia.org/wiki/MIT_License">Wikipedia MIT License</a> - <a href="http://en.wikipedia.org/wiki/Gpl">Wikipedia MIT License</a><br />';
	}
	
	/**
	 * @static
	 * @public
	 * Include jquery.
	 * 
	 * @global hjs
	 * @global pth
	 * @global plugin
	 *
	 */
	public static function include_jquery()
	{
		global $pth, $plugin, $hjs;
		$plugin = basename(dirname(__FILE__),"/");
		
		static $jquery_included = FALSE;
		
		if (!$jquery_included)
		{
			$hjs .= '<script src="'.$pth['folder']['plugins'] . $plugin . '/jquery/js/jquery-1.7.1.min.js" type="text/javascript"></script>';
			$hjs .= '<script src="'.$pth['folder']['plugins'] . $plugin . '/jquery/js/jquery-ui-1.8.13.custom.min.js" type="text/javascript"></script>';
			
			$jquery_included = TRUE;
		}
	}
	
	/**
	 * @static
	 * @public
	 * Init elfinder.
	 * 
	 * @global pth
	 * @global plugin
	 * @global hjs
	 * @global sl
	 */
	public static function include_elfinder()
	{
	 	global $pth, $plugin, $hjs, $sl;
		$plugin = basename(dirname(__FILE__),"/");
		
		static $elfinder_included = FALSE;
		
		if (!$elfinder_included)
		{
			$hjs .= '<link rel="stylesheet" href="' . $pth['folder']['plugins']. 'elfinder/elfinder/css/elfinder.css" type="text/css" media="screen" charset="utf-8">';
			$hjs .= '<link rel="stylesheet" href="' . $pth['folder']['plugins']. 'elfinder/elfinder/css/theme.css" type="text/css" media="screen" charset="utf-8">';

			$hjs .= '<script src="' . $pth['folder']['plugins'] . 'elfinder/elfinder/js/elfinder.min.js" type="text/javascript" charset="utf-8"></script>';
			$hjs .= '<script src="' . $pth['folder']['plugins'] . 'elfinder/elfinder/js/i18n/elfinder.' . $sl . '.js" type="text/javascript" charset="utf-8"></script>';
			
			$hjs .= '<script src="' . $pth['folder']['plugins'] . 'elfinder/init.js" type="text/javascript"></script>';
			
			$elfinder_included = TRUE;
		}
	}
}