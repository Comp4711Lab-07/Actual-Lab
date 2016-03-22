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
            $this->display_list();
        }
        
        public function searchCourse($course) {
            $result = $this->timetable->getCourse($course);
            
            if(result == null) {
                return null;
            }
            
            return result;
        }
        
        public function searchDay($day) {
            $result = $this->timetable->getDay($day);
            
            if(result == null) {
                return null;
            }
            
            return result;
        }
        
        public function searchTime($time) {
            $result = $this->timetable->getHour($time);
            
            if(result == null) {
                return null;
            }
            
            return result;
        }
        
        public function display_list() {
            $list1 = $this->timetable->getDayArray();
            $history1 = '';
            $key1 = array_keys($list1);
            foreach ($key1 as $item) {
                $history1 .= '<li><a href="/Welcome/about/0/' . $item . '"> ' . $item . ' </a></li>';
            }
            
            $this->data['Daydroplist'] = $history1;
            
            $list2 = $this->timetable->getTimeArray();
            $history2 = '';
            $key2 = array_keys($list2);
            foreach ($key2 as $item) {
                $history2 .= '<li><a href="/Welcome/about/1/' . $item . ' "> ' . $item . ' </a></li>';
            }
            
            $this->data['Timedroplist'] = $history2;
            
            $list3 = $this->timetable->getCourseArray();
            $history3 = '';
            $key3 = array_keys($list3);
            foreach ($key3 as $item) {
                $history3 .= '<li><a href="/Welcome/about/2/' . $item . '"> ' . $item . ' </a></li>';
            }
            $this->data['Coursedroplist'] = $history3;
        }
        
        public function about($num = '0', $item = '') {
            if ($item != '') {
                if ($num == 0) {
                    $this->buildDayTable($item);
                } else if ($num == 1) {
                    $this->buildTimeTable($item);
                } else if ($num == 2) {
                    $this->buildCourseTable($item);
                }
            }
        }
}
