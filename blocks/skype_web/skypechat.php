<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package block_skype_web
 * @author Aashay Zajriya <aashay@introp.net>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright (C) 2014 onwards Microsoft Open Technologies, Inc. (http://msopentech.com/)
 */

require_once(__DIR__ . '/../../config.php');
require_login();
$clientid = get_config('auth_oidc', 'clientid');
$config = array('client_id' => $clientid, 'wwwroot' => $CFG->wwwroot);

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
$bodycontents = $templateengine->render(file_get_contents($CFG->dirroot . '/blocks/skype_web/html_templates/skype_chat.html'),
        array('get_string' => function($stringtolocalize) {
            return get_string($stringtolocalize, 'block_skype_web');
        }));

echo $bodycontents;
echo $OUTPUT->footer();