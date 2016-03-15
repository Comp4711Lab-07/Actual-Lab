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
    protected $xml = null;
    protected $days = array();


    // Constructor
    public function __construct()
    {
            parent::__construct();
            $this->xml = simplexml_load_file(DATAPATH . 'Data1.xml');

            foreach($this->xml->Day as $day) {
                $this->days[(string)$day['code']] = $day;
            }
    }
    
    public function getDay($code) {
        if(isset($this->days($code))) {
            return $this->days($code);
        } else {
            return null;
        }
    }
}
