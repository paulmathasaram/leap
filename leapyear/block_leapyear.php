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
 * The comments block
 *
 * @package    block_comments
 * @copyright 2009 Dongsheng Cai <dongsheng@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

//moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");

class block_leapyear extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_leapyear');
    }

function get_content(){
 
$this->content = new stdClass();

$mform = new input_form();
 
//Form processing and displaying is done here
if ($mform->is_cancelled()) {
//Handle form cancel operation, if cancel button is present on form
} else if ($data = $mform->get_data()) {

if(!is_numeric($data->year))  
{  
$this->content->text = 'Strings not allowed, Input should be a number';  
return $this->content;  
}  
//multiple conditions to check the leap year  
if( (0 == $data->year % 4) and (0 != $data->year % 100) or (0 == $data->year % 400) )  
{  
$this->content->text = $data->year .' is a Leap Year';    
}  
else  
{  
$this->content->text = $data->year .' is not a Leap Year';    
}  

//In this case you process validated data. $mform->get_data() returns data posted in form.
} else {
// this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
// or on the first display of the form.
 
//Set default data (if any)
$mform->set_data($toform);
 
//displays the form
$this->content->text = $mform->render();
}
 
return $this->content;
 
}

}


 
class input_form extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
 
        $mform = $this->_form; // Don't forget the underscore!
 
        $mform->addElement('text', 'year', 'Enter the Year'); // Add elements to your form
        $mform->setType('year', PARAM_NOTAGS);                   //Set type of element
        $mform->setDefault('year', date("Y"));        //Default value

$this->add_action_buttons($cancel = false,$submitlabel='Submit');

    }

}

