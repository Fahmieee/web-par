<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_change_menu_name extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    { 
        $this->db->set('name', '"Departemen"', FALSE);
        $this->db->where('id', 4);
        $this->db->update('menu'); 

         $this->db->set('name', '"Jabatan"', FALSE);
        $this->db->where('id', 5);
        $this->db->update('menu'); 

        $this->db->set('name', '"Parts Perawatan"', FALSE);
        $this->db->where('id', 18);
        $this->db->update('menu'); 

        $this->db->set('name', '"Parts Perbaikan"', FALSE);
        $this->db->where('id', 19);
        $this->db->update('menu');
    }

    public function down()
    {
         
    }
}