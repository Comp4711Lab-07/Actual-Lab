<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bookings
 *
 * @author Austin
 */
class Booking extends CI_Model {
    public $instructor = null;
    public $room = null;
    public $time = null;
    public $day = null;
    public $courseNum = null;
    
    // Constructor
    public function __construct() {
       // parent::__construct();
    }
    
    public static function byCourse($Instructor, $Room, $Time, $Day) {
        $instance = new self();
        $instance->courseBuilder($Instructor, $Room, $Time, $Day);
        return $instance;
    }
    
    public static function byDay($CourseNum, $Instructor, $Room, $Time) {
        $instance = new self();
        $instance->dayBuilder($CourseNum, $Instructor, $Room, $Time);
        return $instance;
    }
    
    public static function byHour($CourseNum, $Instructor, $Room, $Day) {
        $instance = new self();
        $instance->timeBuilder($CourseNum, $Instructor, $Room, $Day);
        return $instance;
    }
    
    private function courseBuilder($Instructor, $Room, $Time, $Day)
    {
        $this->instructor = $Instructor;
        $this->room = $Room;
        $this->time = $Time;
        $this->day = $Day;
    }
    
    private function dayBuilder($CourseNum, $Instructor, $Room, $Time)
    {
        $this->courseNum = $CourseNum;
        $this->instructor = $Instructor;
        $this->room = $Room;
        $this->time = $Time;
    }
    
    private function timeBuilder($CourseNum, $Instructor, $Room, $Day) {
        $this->courseNum = $CourseNum;
        $this->instructor = $Instructor;
        $this->room = $Room;
        $this->day = $Day;
    }
}
