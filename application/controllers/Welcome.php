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
                $string = '<tr><th>Course</th><th>Instructor</th><th>Room</th><th>Hour</th></tr>';
                $array = $this->timetable->getDay('Tuesday');
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
        
        public function __construct() {
            parent::__construct();
            $this->load->model('timetable');
        }
        
        public function search($day, $time)
        {
            $result = $this->timetable->getDay($day);
            
            if($result == null) {
                return null;
            } else {
                foreach($result as $course) {
                    if($course->time == $time) {
                        return $course->courseNum;
                    }
                }  
            }  
            return null;
        }
        
        public function about() {
            if (($something = $this->input->post("Days")) != '') {
                print_r($something);
            }
            //$view_data['search'] = $search;
            //$this->load->view("about", $view_data);
        }
}
