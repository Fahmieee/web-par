<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_change_maintenance_id_parts_table extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    { 
        $fields = array(
            'maintenance_id' => array(
                'name' => 'service_type',
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            ),
        );
        $this->dbforge->modify_column('orders', $fields); 
    }

    public function down()
    {
         
    }
}