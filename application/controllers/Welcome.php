<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            $this->buildDayTable('Monday'); //works!
            //$this->buildCourseTable('4995'); // works!
            //$this->buildTimeTable('8:30am');    
	}
        
        protected function buildDayTable($day) {
            $string = '<tr><th>Course</th><th>Instructor</th><th>Room</th><th>Hour</th></tr>';
                $array = $this->timetable->getDay($day);
                foreach($array as $info) {
                    $string .= '<tr><td>' . $info->courseNum . '<td>'
                            . $info->instructor . '</td>'
                            . '<td>' . $info->room . '</td>'
                            . '<td>' . $info->time . '</td>'
                            . '</td></tr>';
                }
            
                $this->data['TableContent'] = $string;
                
                $this->data['title'] = "TimeTable";
                $this->data['data'] = $this->data;
                $this->parser->parse('Welcome', $this->data);
        }
        
        protected function buildCourseTable($course) {
             $string = '<tr><th>Day</th><th>Instructor</th><th>Room</th><th>Hour</th></tr>';
                $array = $this->timetable->getCourse($course);
                foreach($array as $info) {
                    $string .= '<tr><td>' . $info->day . '<td>'
                            . $info->instructor . '</td>'
                            . '<td>' . $info->room . '</td>'
                            . '<td>' . $info->time . '</td>'
                            . '</td></tr>';
                    
                }
            
                $this->data['TableContent'] = $string;
                
                $this->data['title'] = "TimeTable";
                $this->data['data'] = $this->data;
                $this->parser->parse('Welcome', $this->data);
        }
        
        protected function buildTimeTable($hour) {
             $string = '<tr><th>Course</th><th>Instructor</th><th>Room</th><th>Day</th></tr>';
                $array = $this->timetable->getHour($hour);
                //print_r($array);
                foreach($array as $info) {
                    $string .= '<tr><td>' . $info->courseNum . '<td>'
                            . $info->instructor . '</td>'
                            . '<td>' . $info->room . '</td>'
                            . '<td>' . $info->day . '</td>'
                            . '</td></tr>';
                    
                }
            
                $this->data['TableContent'] = $string;
                
                $this->data['title'] = "TimeTable";
                $this->data['data'] = $this->data;
                $this->parser->parse('Welcome', $this->data);
        }
        
        public function __construct() {
            parent::__construct();
            $this->load->model('timetable');
        }
        
        public function searchCourse($course) {
            $result = $this->timetabel->getCourse($course);
            
            if(result == null) {
                return null;
            }
            
            return result;
        }
        
        public function searchDay($day) {
            $result = $this->timetabel->getDay($day);
            
            if(result == null) {
                return null;
            }
            
            return result;
        }
        
        public function searchTime($time) {
            $result = $this->timetabel->getHour($time);
            
            if(result == null) {
                return null;
            }
            
            return result;
        }
}
