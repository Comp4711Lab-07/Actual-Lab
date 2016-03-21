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
            
            // by day
            $this->dayXml = simplexml_load_file(DATAPATH . 'Data1.xml');
            foreach($this->dayXml->Day as $day) {
                foreach($day->Course as $course) {
                    $tmp = new stdClass();
                    $tmp->courseNum = (string)$course->courseNum;
                    $tmp->instructor = (string)$course->Instructor;
                    $tmp->room = (string)$course->Room;
                    $tmp->time = (string)$course->Hour;
                    
                    $tmpDay[] = array($tmp);
                }
                $this->days[(string)$day['Day']][] = $tmpDay;
            }
            
            // by course
            $this->courseXml = simplexml_load_file(DATAPATH, '.xml');
            foreach($this->courseXml->CourseNum as $courseNum) {
                foreach($courseNum->course as $course) {
                    $tmp = new stdClass();
                    $tmp->instructor = (string)$course->Instructor;
                    $tmp->room = (string)$course->Room;
                    $tmp->time = (string)$course->Hour;
                    $tmp->day = (string)$course->day;
                    
                    $tmpCourse[] = array($tmp);
                }
                $this->courses[(string)$courseNum['CourseNum']][] = $tmpCourse;
            }
            
            // by time
            $this->timeXml = simplexml_load_file(DATAPATH, '.xml');
            foreach($this->timeXml->Hour as $time) {
                foreach($time->course as $course) {
                    $tmp = new stdClass();
                    $tmp->courseNum = (string)$course->courseNum;
                    $tmp->instructor = (string)$course->Instructor;
                    $tmp->room = (string)$course->Room;
                    $tmp->day = (string)$course->day;
                    
                    $tmpHour[] = array($tmp);
                }
                $this->times[(string)$time['Time']][] = $tmpHour;
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
