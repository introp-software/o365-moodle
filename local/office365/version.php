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
 * @package local_office365
 * @author James McQuillan <james.mcquillan@remote-learner.net>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright (C) 2014 onwards Microsoft, Inc. (http://microsoft.com/)
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version = 2015111912;
$plugin->requires = 2015111600;
$plugin->component = 'local_office365';
$plugin->maturity = MATURITY_STABLE;
$plugin->release = '30.0.0.12';
$plugin->dependencies = [
    'auth_oidc' => 2015111910,
    'block_microsoft' => 2015111914,
    'local_o365' => 2015111917,
    'local_onenote' => 2015111906,
    'assignfeedback_onenote' => 2015111903,
    'assignsubmission_onenote' => 2015111904,
    'repository_onenote' => 2015111903,
    'repository_office365' => 2015111909,
    'filter_oembed' => 2015111909,
];
