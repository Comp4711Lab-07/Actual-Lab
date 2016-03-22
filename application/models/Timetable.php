<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Timetable
 *
 * @author Austin
 */
class Timetable extends CI_Model {
    //put your code here
    protected $dayXml = null;
    protected $courseXml = null;
    protected $timeXml = null;
    protected $days = array();
    protected $courses = array();
    protected $times = array();


    // Constructor
    public function __construct()
    {
            parent::__construct();
            $this->load->model('booking');
            
            // by day
            $this->dayXml = simplexml_load_file(DATAPATH . 'Day.xml');
            
            foreach($this->dayXml->Day as $day) {
                $tmpDay = array();
                foreach($day->Course as $course) {
                    /*$tmp = new stdClass();
                    $tmp->courseNum = (string)$course->courseNum;
                    $tmp->instructor = (string)$course->Instructor;
                    $tmp->room = (string)$course->Room;
                    $tmp->time = (string)$course->Hour;*/
                    
                    $tmp = Booking::byDay((string)$course->courseNum,
                            (string)$course->Instructor,
                            (string)$course->Room,
                            (string)$course->Hour);
                    
                    $tmpDay[] = $tmp;
                }
                $this->days[(string)$day['type']] = $tmpDay;
            }
            
            // by course
            $this->courseXml = simplexml_load_file(DATAPATH . 'Course.xml');
            
            foreach($this->courseXml->CourseNum as $courseNum) {
                $tmpCourse = array();
                foreach($courseNum->course as $course) {
                    /*$tmp = new stdClass();
                    $tmp->instructor = (string)$course->Instructor;
                    $tmp->room = (string)$course->Room;
                    $tmp->time = (string)$course->Hour;
                    $tmp->day = (string)$course->day;*/
                    
                    $tmp = Booking::byCourse((string)$course->Instructor,
                            (string)$course->Room,
                            (string)$course->Hour,
                            (string)$course->day);
                    
                    $tmpCourse[] = $tmp;
                }
                $this->courses[(string)$courseNum['type']][] = $tmpCourse;
            }
            
            // by time
            $this->timeXml = simplexml_load_file(DATAPATH . 'Time.xml');
            
            foreach($this->timeXml->Hour as $time) {
                $tmpHour = array();
                foreach($time->course as $course) {
                   /* $tmp = new stdClass();
                    $tmp->courseNum = (string)$course->courseNum;
                    $tmp->instructor = (string)$course->Instructor;
                    $tmp->room = (string)$course->Room;
                    $tmp->day = (string)$course->day;*/
                    
                    $tmp = Booking::byHour((string)$course->courseNum,
                            (string)$course->Instructor,
                            (string)$course->Room, 
                            (string)$course->day);
                    
                    $tmpHour[] = $tmp;
                }
                $this->times[(string)$time['type']][] = $tmpHour;
            }
            
    }
    
    public function getDay($code) {
        if(isset($this->days[$code])) {
            return $this->days[$code];
        } else {
            return null;
        }
    }
    
    public function getDayArray() {
        return $this->days;
    }
    
    public function getCourse($code) {
        if(isset($this->courses[$code])) {
            return $this->courses[$code];
        } else {
            return null;
        }
    }
    
    public function getCourseArray() {
        return $this->courses;
    }
    
    public function getHour($code) {
        if(isset($this->times[$code])) {
            return $this->times[$code];
        } else {
            return null;
        }
    }
    
    public function getTimeArray() {
        return $this->times;
    }
}
