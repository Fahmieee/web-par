<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_change_unit_tables extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    { 
        $fields = array(
            'type_unit' => array(
                'name' => 'type_unit',
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            ),
        );
        $this->dbforge->modify_column('units', $fields); 
    }

    public function down()
    {
         
    }
}