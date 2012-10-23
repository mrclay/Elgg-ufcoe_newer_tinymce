<?php

namespace UFCOE\NewerTinymce;

const PLUGIN_ID = 'ufcoe_newer_tinymce';

const TINYMCE_DATE = '2012-09-20';

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');

function init() {
	if (core_tinymce_is_newer()) {
		return;
	}
	elgg_unregister_js('tinymce');
	elgg_register_js('tinymce', 'mod/' . PLUGIN_ID . '/vendor/tinymce/jscripts/tiny_mce/tiny_mce.js');
}

function core_tinymce_is_newer() {
	$tinymce_changelog = elgg_get_plugins_path() . 'tinymce/vendor/tinymce/changelog.txt';
	if (is_readable($tinymce_changelog)) {
		if ($fp = @fopen($tinymce_changelog, 'rb')) {
			$line = fread($fp, 250);
			fclose($fp);
			if (preg_match('~\\((\\d{4}\\-\\d\\d\\-\\d\\d)\\)~', $line, $m)) {
				if ($m[1] > TINYMCE_DATE) {
					return true;
				}
			}
		}
	}
	return false;
}
