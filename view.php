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
$PAGE->set_course($COURSE);
$PAGE->set_url('/blocks/superframe/view.php');
$PAGE->set_heading($SITE->fullname);
$PAGE->set_pagelayout('course');
$PAGE->set_title(get_string('pluginname', 'block_superframe'));
$PAGE->navbar->add(get_string('pluginname', 'block_superframe'));
require_login();

// Start output to browser.
echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname', 'block_superframe'), 5);
echo '<br>' . fullname($USER) . '<br>';
echo '<br>' . $OUTPUT->user_picture($USER) . '<br>';

//IFRAME CONTENT
$url='https://www.youtube.com/embed/5NCH29cPQt4';
$height = '600px';
$width = '900px';
$class = 'superframe_test_class';
$attributes = [
    'src'=> $url,
    'width'=> $width,
    'height'=> $height,
    'class' => $class,
    'allowfullscreen'=>'allowfullscreen'
];
echo html_writer::start_tag('div', array('class'=>"col-md-12 offset-md-12 text-center pt-4"));
echo html_writer::start_tag('iframe', $attributes);
echo html_writer::end_tag('iframe');
echo html_writer::end_tag('div');
//echo 'I am some dummy content, get rid of me fast';

//send footer out to browser
echo $OUTPUT->footer();