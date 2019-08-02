<?php
/**
 * @author   Natan Felles <natanfelles@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_create_table_api_limits
 *
 * @property CI_DB_forge         $dbforge
 * @property CI_DB_query_builder $db
 */
class Migration_insert_default_maintenance extends CI_Migration {


	public function up()
	{ 
		// insert function value
		 $data_function = array(
            array('type'=> 'NONROUTINE','description' => 'NONROUTINE'),
            array('type'=> 'EMERGENCY','description' => 'EMERGENCY')
        );
        $this->db->insert_batch('maintenance', $data_function); 
	}


	public function down()
	{
		
	}

}