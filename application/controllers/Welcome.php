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
                //$something =  $this->timetable->getDay('Tuesday');
                //foreach($something as $course) {
                    //$this->data['TableContent'] = $course->courseNum;
                //}
            
                //$this->data['TableContent'] = $this->search('Tuesday', '3:30pm');
                
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
}
