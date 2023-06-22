<?php
class Home_model extends CI_Model
{
    public function get_data()
    {
        $r = $this->db->query("select * from bms_table where action = 1");
        if ($r->num_rows() > 0) {
            return $r->result();
        } else {
            return FALSE;
        }
    }
    public function get_bus_booking_details($goto,$gofrom,$dateid)
    {
        $r = $this->db->query("select * from bus_schedule where start = '".$gofrom."' and end = '".$goto."' and date = '".$dateid."'");
        
        if ($r->num_rows() > 0) { return $r->result(); } else { return FALSE;}
    }

    public function get_data_by_id($id){
        $r = $this->db->query("select * from bus_schedule where id = '".$id."'");
        if($r->num_rows() > 0){
                return $r->result();
        }else{ 
                return FALSE; 
        }

}


public function confirm_booking($insert_arr)
    {
        $this->db->insert("bus_booking", $insert_arr);
        return $this->db->insert_id();
    }
}