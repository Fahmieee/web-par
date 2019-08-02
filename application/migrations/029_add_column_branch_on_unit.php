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
class Migration_add_column_branch_on_unit extends CI_Migration {


	public function up()
	{ 
		$fields = array(
            'branch_id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'driver_id' => array(
                'type' => 'INT',
                'constraint' => 11
            )
        );
        $this->dbforge->add_column('units', $fields); 

	}


	public function down()
	{
		$this->dbforge->drop_column('units', 'branch_id');
	}

}
