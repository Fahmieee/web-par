<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_change_menu_name_master_produk extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    { 
        $this->db->set('name', '"Master Merk Unit"', FALSE);
        $this->db->where('id', 33);
        $this->db->update('menu');  
    }

    public function down()
    {
         
    }
}