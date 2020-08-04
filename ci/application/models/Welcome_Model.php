<?php
class Welcome_Model extends CI_Model 
{
	function saverecords($data) {
        $stmt = 'INSERT INTO `web` (`vue`, `react`, `angular`)
                    VALUES (?,?,?)';
        $query = $this->db->query($stmt,[$data['vue'], $data['react'], $data['angular']]);
        if(!$query){
            return $this->db->error();
        };
    }
    
    function getrecords() {
        //Query-->Result
        $query = $this->db->query('SELECT `vue`,`react`,`angular`, DATE_FORMAT(`date`, "%m/%e") d, `date` x FROM `web` ORDER BY x ASC');
        $result = $query->result_array();
        return $result;
    }
    
    function checkduplicate() {
        $query = $this->db->query('SELECT * FROM `web` WHERE  CURDATE() = Date_format(`date`, "%Y/%m/%e")');
        $result = $query->result_array();
        return $result;
	}
}