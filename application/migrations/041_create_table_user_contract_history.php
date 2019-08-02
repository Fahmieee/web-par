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
class Migration_create_table_user_contract_history extends CI_Migration {


	public function up()
	{ 
		$table = "user_contract_history";
		$fields = array(
			'id'           => [
				'type'           => 'INT',
				'auto_increment' => TRUE,
				'unsigned'       => TRUE,
				'contraint'       => 11,
			],
			'user_id'      => [
				'type'           => 'INT',
				'contraint'       => 11,
			], 

			'driver_id'      => [
				'type'           => 'INT',
				'contraint'       => 11,
				'null' => TRUE,
			], 
			'unit_id'      => [
				'type'           => 'INT',
				'contraint'       => 11,
				'null' => TRUE,
			], 
			'description'      => [
				'type'           => 'TEXT',
				'null' => TRUE,
			],
			'start_date'      => [
				'type'           => 'DATETIME',
				'null' => TRUE,
			], 
			'end_date'      => [
				'type'           => 'DATETIME',
			 		'null' => TRUE,
			]
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($table);
	 
	}


	public function down()
	{
		$table = "user_contract_history";
		if ($this->db->table_exists($table))
		{ 
			$this->dbforge->drop_table($table);
		}
	}

}
