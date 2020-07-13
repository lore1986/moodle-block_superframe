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
 * superframe view page
 *
 * @package    block_superframe
 * @copyright  Daniel Neis <danielneis@gmail.com>
 * Modified for use in MoodleBites for Developers Level 1 by Richard Jones & Justin Hunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require('../../config.php');
$blockid = required_param('blockid', PARAM_INT);

$def_config = get_config('block_superframe'); //this is important


$PAGE->set_url('/blocks/superframe/view.php');
$PAGE->set_heading($SITE->fullname);

$PAGE->set_pagelayout($def_config->pagelayout);

$PAGE->set_title(get_string('pluginname', 'block_superframe'));
$PAGE->navbar->add(get_string('pluginname', 'block_superframe'));

require_login();


// Get the instance configuration data from the database. 
// It's stored as a base 64 encoded serialized string.
$configdata = $DB->get_field('block_instances', 'configdata', ['id' => $blockid]); //IMPORTANT

// If an entry exists, convert to an object.
if ($configdata) {
    $config = unserialize(base64_decode($configdata)); //here takes configdata local of instance else below take admin settings
} else {
    // No instance data, use admin settings.
    // However, that only specifies height and width, not size.
   $config = $def_config;
   $config->size = 'custom';
}

// URL - comes either from instance or admin.
$url = $config->url;
// Let's set up the iframe attributes.
switch ($config->size) {
    case 'custom':
        $width = $def_config->width;
        $height = $def_config->height;
        break;
    case 'small' :
        $width = 360;
        $height = 240;
        break;
    case 'medium' :
        $width = 600;
        $height = 400;
        break;
    case 'large' :
        $width = 1024;
        $height = 720;
        break;
}

// Start output to browser.
echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname', 'block_superframe'), 5);
echo '<br><h3>' . fullname($USER) . '</h3><br>';
echo '<br>' . $OUTPUT->user_picture($USER) . '<br>';


$attributes = [
    'src'=> $config->url,
    'width'=> $width . 'px',
    'height'=> $height . 'px',
    'class' => $config->class,
    'allowfullscreen'=>'allowfullscreen'
];
echo html_writer::start_tag('div', array('class'=>"col-md-12 offset-md-12 text-center pt-4"));
echo html_writer::start_tag('iframe', $attributes);
echo html_writer::end_tag('iframe');
echo html_writer::end_tag('div');
//echo 'I am some dummy content, get rid of me fast';

//send footer out to browser
echo $OUTPUT->footer();