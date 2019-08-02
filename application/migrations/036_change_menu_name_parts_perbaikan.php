<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_change_menu_name_parts_perbaikan extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    { 
        $this->db->set('name', '"Parts"', FALSE);
        $this->db->where('id', 19);
        $this->db->update('menu'); 

         $this->db->set('sequence', '"7"', FALSE);
        $this->db->where('id', 19);
        $this->db->update('menu'); 

        $this->db->set('sequence', '"8"', FALSE);
        $this->db->where('id', 18);
        $this->db->update('menu'); 

        $this->db->set('url', '"parts"', FALSE);
        $this->db->where('id', 19);
        $this->db->update('menu');  
    }

    public function down()
    {
         
    }
}