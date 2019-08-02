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
class Migration_create_table_units_drivers extends CI_Migration {


	public function up()
	{ 
		$table = "units_drivers";
		$fields = array(
			'id'           => [
				'type'           => 'INT(11)',
				'auto_increment' => TRUE,
				'unsigned'       => TRUE,
			],
			'user_id'      => [
				'type'           => 'INT(11)',
			], 
			'unit_id'      => [
				'type'           => 'INT(11)',
			] 
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($table);
	 
	}


	public function down()
	{
		$table = "units_drivers";
		if ($this->db->table_exists($table))
		{ 
			$this->dbforge->drop_table($table);
		}
	}

}
