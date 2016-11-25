<?php

require_once(__DIR__ . '/../../config.php');
require_login();
$client_id = get_config('auth_oidc', 'clientid');
$config = array('client_id' => $client_id, 'wwwroot' => $CFG->wwwroot);

global $PAGE;

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/blocks/skype_web/skypechat.php');
$PAGE->set_title('skype chat');
$skypesdkurl = new moodle_url('https://swx.cdn.skype.com/shared/v/1.2.9/SkypeBootstrap.js');
$PAGE->requires->js($skypesdkurl, true);
$PAGE->requires->jquery();
$PAGE->requires->jquery_plugin('ui');
$PAGE->requires->jquery_plugin('ui-css');
$PAGE->requires->yui_module('moodle-block_skype_web-signin', 'M.block_skype_web.signin.init', array($config));
$PAGE->requires->yui_module('moodle-block_skype_web-chatservice', 'M.block_skype_web.chatservice.init', array($config));

echo $OUTPUT->header();
$templateengine = new Mustache_Engine();
$bodycontents = $templateengine->render(file_get_contents($CFG->dirroot . '/blocks/skype_web/html_templates/skype_chat.html'), array('get_string' => function($stringtolocalize) {
        return get_string($stringtolocalize, 'block_skype_web');
    }));

echo $bodycontents;
echo $OUTPUT->footer();
?>