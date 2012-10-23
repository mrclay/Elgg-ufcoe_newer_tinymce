<?php

namespace UFCOE\NewerTinymce;

const PLUGIN_ID = 'ufcoe_newer_tinymce';

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');

function init() {
	elgg_unregister_js('tinymce');
	elgg_register_js('tinymce', 'mod/' . PLUGIN_ID . '/vendor/tinymce/jscripts/tiny_mce/tiny_mce.js');
}
