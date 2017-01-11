<?php
/*
Plugin Name: ContentGems Shortcode Plugin
Description: Enables shortcode to embed ContentGems Widget.
Usage: <code>[contentgems feed="YOUR_FEED_ID" debug="false" max="40" stylesheet="true" view="grid" selector="ContentGemsWidget" poweredby="true"]</code>. This code is available to copy and paste directly from the ContentGems Feed Manager.
Version: 1.0
License: GPL
Author: Dakota J Lightning / ContentGems
Author URI: https://contentgems.com
Text Domain: contentgems
*/

function createContentGemsWidget($atts, $content = null) {
	extract(shortcode_atts(array(
		'feed'      => '',
		'debug'        => '',
		'max'          => '',
		'stylesheet'   => '',
		'view'         => '',
		'selector'     => '',
		'poweredby'    => '',
	), $atts));

	if (!$feed) {

		$error = "
		<div style='border: 5px solid #d9534f; background-color: #fff;border-radius: 6px; padding: 25px; margin: 25px 0 25px;'>
			<p style='margin: 0;'>Something is wrong with your ContentGems shortcode.</p>
		</div>";

		return $error;

	} else {

    $JSEmbed = "<div id=\"ContentGemsWidget\"></div>";
    $JSEmbed .= "<script>\n";
    $JSEmbed .= "window.ContentGemsWidgetOptions = {";
    $JSEmbed .= "feed_id        :  '$feed',          \n";

    if ($debug) {
      $JSEmbed .= "debug        :  $debug,           \n";
    }
    if ($selector) {
      $JSEmbed .= "selector     :  $selector,        \n";
    }
    if ($max) {
      $JSEmbed .= "max          :  '$max',           \n";
    }
    if ($stylesheet) {
      $JSEmbed .= "stylesheet   :  $stylesheet,      \n";
    }
    if ($view) {
      $JSEmbed .= "view         :  '$view',          \n";
    }
    if ($poweredby) {
      $JSEmbed .= "poweredBy    :  $poweredby,       \n";
    }

		$JSEmbed .= "}\n";

    $JSEmbed .= "!function(){function t(){var t=a.createElement(\"script\");t.type=\"text/javascript\",t.async=!0,t.src=\"https://assets.contentgems.com/website-widget/1.0.0/website-widget.js\";var e=a.getElementsByTagName(\"script\")[0];e.parentNode.insertBefore(t,e)}var e=window,a=document;e.attachEvent?e.attachEvent(\"onload\",t):e.addEventListener(\"load\",t,!1)}();";
    $JSEmbed .= "</script>";

		/**
		* Return embed in JS and iframe
		*/
		return "$JSEmbed <noscript> $iframe_embed </noscript>";
	}
}

add_shortcode('contentgems', 'createContentGemsWidget');

?>
