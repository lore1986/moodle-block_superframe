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
 * superframe renderer page
 *
 * @package    block_superframe
 * @copyright  Daniel Neis <danielneis@gmail.com>
 * Modified for use in MoodleBites for Developers Level 1 by Richard Jones & Justin Hunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 class block_superframe_renderer extends plugin_renderer_base {

function display_view_page($url, $width, $height) {

        global $USER, $DB;

        $course_id = required_param('courseid',PARAM_INT);

        $data = new stdClass();
        
        $u = $DB->get_record_select('user',"id ='$USER->id'",null, user_picture::fields());

        // Page heading and iframe data.
        $data->heading = get_string('pluginname', 'block_superframe');
        $data->url = $url;
        $data->height = $height;
        $data->width = $width;
        $data->name = $USER->firstname;
        $data->pic = $this->output->user_picture($u);
        $data->linkback = new moodle_url('/course/view.php',['id' => $course_id]); 
        $data->textlinkback =  get_string('returncourse', 'block_superframe');
        

        // Start output to browser.
        echo $this->output->header();
    
       
        // Render the data in a Mustache template.
        echo $this->render_from_template('block_superframe/frame', $data);

        // Finish the page.
        echo $this->output->footer();
   }

   function fetch_block_content($blockid){
        
     global $USER;
     
     $course_id = $this->page->course->id;
     
     $data_block = new stdClass();

     $data_block->welcome = get_string('welcomeuser', 'block_superframe', $USER);

     $url = new moodle_url('/blocks/superframe/view.php', ['blockid' => $blockid, 'courseid' => $course_id]);

     $urllink= get_string('viewlink', 'block_superframe');
     
     $data_block->linkviewtext = $urllink;
     $data_block->linkview = $url;

     
     
     return $this->render_from_template('block_superframe/block', $data_block);
   }

   function render_users_on_block($students){

     global $DB, $OUTPUT;
     
     $data_to_render = new stdClass ();

     //print_r($students); exit;

     foreach ($students as $student){
          $studentpropertylist[] = array();
          $studentpropertylist['name'] = $student->firstname;
          $studentpropertylist['pic'] = $OUTPUT->user_picture($student); //$this->output->user_picture($rs);
          $lastlogin = $DB->get_record('user',['id' => $student->id], $fields='lastlogin');
          $studentpropertylist['login'] = unserialize(base64_decode($lastlogin->lastlogin));
          //$rs = $DB->get_record_select("user", "id = '$student->id'", null, user_picture::fields());
          //$studentlist['pic'] = $this->output->user_picture($rs);
          //var_dump($lastlogin);exit;
          
          $data_to_render->studentslist[] = $studentpropertylist;
     }
     
     return $this->render_from_template('block_superframe/block', $data_to_render);

   }
}