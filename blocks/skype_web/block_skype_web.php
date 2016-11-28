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
 * @author Sushant Gawali <sushant@introp.net>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright (C) 2014 onwards Microsoft Open Technologies, Inc. (http://msopentech.com/)
 */
defined('MOODLE_INTERNAL') || die();

/**
 * Skype Block.
 */
class block_skype_web extends block_base {

    /**
     * Initialize plugin.
     */
    public function init() {

        global $PAGE;
        $skypesdkurl = new moodle_url('https://swx.cdn.skype.com/shared/v/1.2.9/SkypeBootstrap.js');
        $PAGE->requires->js($skypesdkurl, true);
        $this->title = get_string('skype_web', 'block_skype_web');
    }

    /**
     * Whether the block has settings.
     *
     * @return bool Has settings or not.
     */
    public function has_config() {
        return false;
    }

    /**
     * Get the content of the block.
     *
     * @return stdObject
     */
    public function get_content() {

        global $PAGE, $CFG, $USER, $SESSION;

        $PAGE->requires->jquery();
        $PAGE->requires->jquery_plugin('ui');
        $PAGE->requires->jquery_plugin('ui-css');

        $clientid = get_config('auth_oidc', 'clientid');
        $config = array('client_id' => $clientid, 'wwwroot' => $CFG->wwwroot);

        $this->content = new stdClass;
        $this->content->text = '';
        if ($USER->auth == 'oidc' || !empty($SESSION->skype_login)) {
            $PAGE->requires->yui_module('moodle-block_skype_web-groups', 'M.block_skype_web.groups.init', array($config));
            $PAGE->requires->yui_module('moodle-block_skype_web-signin', 'M.block_skype_web.signin.init', array($config));
            $PAGE->requires->yui_module('moodle-block_skype_web-contact', 'M.block_skype_web.contact.init', array($config));
            $PAGE->requires->yui_module('moodle-block_skype_web-self', 'M.block_skype_web.self.init', array($config));
            $this->content->text .= $this->get_template($CFG->dirroot . '/blocks/skype_web/html_templates/skype_block.html');
        } else {
            $PAGE->requires->yui_module('moodle-block_skype_web-login', 'M.block_skype_web.login.init', array($config));
            $this->content->text .= $this->get_template($CFG->dirroot . '/blocks/skype_web/html_templates/skype_login.html');
        }

        $this->content->text = str_replace("@@wwwroot@@", $CFG->wwwroot, $this->content->text);
        $this->content->footer = '';
        return $this->content;
    }

    private function get_template($templatepath) {
        $templateengine = new Mustache_Engine();
        $output = $templateengine->render(file_get_contents($templatepath), array('get_string' => function($stringtolocalize) {
                return get_string($stringtolocalize, 'block_skype_web');
        }));
        return $output;
    }
}
