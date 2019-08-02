<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_menu_item_emergency extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    { 
        $data = array(
            'id'        =>31,
            'module_id' =>1,
            'name'      =>'Item Request Darurat',
            'url'       =>'emergency_item',
            'parent_id' =>11,
            'icon'      =>" ",
            'sequence'  =>10,
        );
        $this->db->insert('menu',$data); 
    }

    public function down()
    {
         
    }
}