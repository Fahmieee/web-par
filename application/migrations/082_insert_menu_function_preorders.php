<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_menu_function_preorders extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    { 
        for ($i=1; $i < 6; $i++) { 
            $data = array(
                'menu_id'        =>32, 
                'function_id'  =>$i,
            );
            $this->db->insert('menu_function',$data); 
        }  
        
    }

    public function down()
    {
         
    }
}