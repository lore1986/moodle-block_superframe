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

 /*
 
you don't need to worry about collecting data from a settings form.
you don't need worry about saving form data in the database.
Moodle does all of that for you .
defined('MOODLE_INTERNAL') || die();

*/

//IFRAME CONTENT
$url='https://www.youtube.com/embed/5NCH29cPQt4';
$height = '600px';
$width = '900px';
$class = 'superframe_test_class';

$options = array();
$options['course'] = get_string('course');
$options['popup'] = get_string('popup');

if ($ADMIN->fulltree){
    $settings->add(new admin_setting_heading('simpleheader',
        get_string('superframe_name_admin', 'block_superframe'), get_string('superframe_description_admin')));

    $settings->add(new admin_setting_configtext('block_superframe/url', 
    get_string('url_setting', 'block_superframe'), get_string('url_setting_desc', 'block_superframe'), $url, PARAM_RAW));

    $settings->add(new admin_setting_configtext('block_superframe/height', 
    get_string('height_setting', 'block_superframe'), get_string('height_setting_desc', 'block_superframe'), $height, PARAM_INT));

    $settings->add(new admin_setting_configtext('block_superframe/width', 
    get_string('width_setting', 'block_superframe'), get_string('width_setting_desc', 'block_superframe'), $width, PARAM_INT));

    $settings->add(new admin_setting_configtext('block_superframe/class', 
    get_string('class_setting', 'block_superframe'), get_string('class_setting_desc', 'block_superframe'), $class, PARAM_RAW));

    $settings->add(new admin_setting_configselect('block_superframe/pagelayout', 
    get_string('page_layout', 'block_superframe'),
    get_string('page_layout_desc', 'block_superframe'), 
    'course', $options));
}