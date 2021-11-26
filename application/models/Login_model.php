<?php

class Login_model extends CI_Model
{
    public function insert_user($data)
    {
        $this->db->insert('users', $data);
        return  $this->db->insert_id();
    }
    public function email_exist($email_entered)
    {
       $this->db->select("*");
       $this->db->from("users");
       $this->db->where("email_address",$email_entered);
       $query = $this->db->get();
       if($query->result() != null){
            return true;
       }else{
           return false;
       }
    }
    public function verified_login($email_entered,$password_entered)
    {
       $this->db->select("*");
       $this->db->from("users");
       $this->db->where("email_address",$email_entered);
       $this->db->where("password",$password_entered);
       $query = $this->db->get();
       if($query->result() != null){
            return true;
       }else{
           return false;
       }
    }
}