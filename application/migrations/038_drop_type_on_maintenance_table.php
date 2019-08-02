<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_drop_type_on_maintenance_table extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    { 
        $this->dbforge->drop_column('maintenance', 'type'); 
    }

    public function down()
    {
         
    }
}