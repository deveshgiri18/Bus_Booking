<?php
class Admin_bus_booking_model extends CI_Model
{


public function get_all_data()
    {
        $r = $this->db->query("select * from bus_schedule where status = 1");
        if ($r->num_rows() > 0) {
            return $r->result();
        } else {
            return FALSE;
        }
    }

    public function get_data_bus_booking()
    {
        $r = $this->db->query("select * from bus_booking where status = 1");
        if ($r->num_rows() > 0) {
            return $r->result();
        } else {
            return FALSE;
        }
    }

    

    public function bus_booking_add($insert_arr)
    {
        $this->db->insert("bus_booking", $insert_arr);
        return $this->db->insert_id();
    }

   

    public function get_bus_details($busno){
        $r = $this->db->query("select * from bus_schedule where status = 1 and busno = '".$busno."'");
        if ($r->num_rows() > 0) {
            return $r->result();
        } else {
            return FALSE;
        }
    }
}