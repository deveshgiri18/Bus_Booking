<?php
class Admin_model extends CI_Model
{


    public function check_login($email, $password)
    {
        $r = $this->db->query("select * from Admin_table where email = '" . $email . "' and password = '" . $password . "'");
        if ($r->num_rows() > 0) {
            return $r->result();
        } else {
            return FALSE;
        }
    }

    //  ADMIN PAGE LOCATION ADD TABLE  

    public function add_location($insert_arr)
    {
        $this->db->insert("bms_table", $insert_arr);
        return $this->db->insert_id();
    }

    public function check_name($name)
    {

        $r = $this->db->query("select * from bms_table where name = '" . $name . "'");
        if ($r->num_rows() > 0) {
            return $r->result();
        } else {
            return FALSE;
        }
    }

    public function get_all_data()
    {
        $r = $this->db->query("select * from bms_table where status = 1");
        if ($r->num_rows() > 0) {
            return $r->result();
        } else {
            return FALSE;
        }
    }

    
    public function action()
    {
        $r = $this->db->query("select * from bms_table where action = 1");
        if ($r->num_rows() > 0) {
            return $r->result();
        } else {
            return FALSE;
        }
    }

    public function get_data_by_id($id){
        $r = $this->db->query("select * from bms_table where id = '".$id."'");
        if($r->num_rows() > 0){
                return $r->result();
        }else{ 
                return FALSE; 
        }
}

public function update_data($id,$update_arr){
    $this->db->where('id', $id);
$this->db->update('bms_table',$update_arr );
return true;
}


public function get_user_details_by_id($user_id)
	 {
	  $r = $this->db->get_where("bms_table" , array("status" => 1 , "id" => $id));
	  if($r->num_rows() > 0){ return $r->result(); }else{ return FALSE; }
	 }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

     public function bus_schedule_add($insert_arr){
        
        $this->db->insert("bus_schedule", $insert_arr);
        return $this->db->insert_id();
     }


     public function get_all_data_bus_schedule()
     {
         $r = $this->db->query("select * from bus_schedule where status = 1 ORDER BY ID DESC");
         if ($r->num_rows() > 0) {
             return $r->result();
         } else {
             return FALSE;
         }
     }

     public function get_data_by_id_bus_schedule($id){
        $r = $this->db->query("select * from bus_schedule where id = '".$id."'");
        if($r->num_rows() > 0){
                return $r->result();
        }else{ 
                return FALSE; 
        }

}

public function bus_schedule_update($id,$update_arr){
    $this->db->where('id', $id);
$this->db->update('bus_schedule',$update_arr );
return true;
}

public function get_user_details_by_id_2($user_id)
	 {
	  $r = $this->db->get_where("bus_schedule" , array("status" => 1 , "id" => $id));
	  if($r->num_rows() > 0){ return $r->result(); }else{ return FALSE; }
	 }

}
