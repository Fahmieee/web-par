<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_drivers extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    { 
        $fields = array(
            'driver_type' => array(
                'type' => 'INT',
                'constraint' => 1
            ),
            'driver_sim_no' => array(
                'type' => 'INT',
                'constraint' => 20
            ),
            'driver_sim_date' => array(
                'type' => 'DATE'
            ),
            'driver_sim_type' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
        );
        $this->dbforge->add_column('users', $fields); 
    }

    public function down()
    {
         $this->dbforge->drop_column('users', 'driver_type');
         $this->dbforge->drop_column('users', 'driver_sim_no');
         $this->dbforge->drop_column('users', 'driver_sim_date');
         $this->dbforge->drop_column('users', 'driver_sim_type');
    }
}