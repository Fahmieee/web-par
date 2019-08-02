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
class Migration_create_table_maintenance extends CI_Migration {


	public function up()
	{ 
		$table = "maintenance";
		$fields = array(
			'id'           => [
				'type'           => 'INT(11)',
				'auto_increment' => TRUE,
				'unsigned'       => TRUE,
			],
			'type'      => [
				'type' => 'VARCHAR(255)',
			],
			'merk'          => [
				'type' => 'VARCHAR(255)',
		 		'null' => TRUE,
			],
			'distance'          => [
				'type' => 'VARCHAR(255)',
		 		'null' => TRUE,
			],
			'description'      => [
				'type' => 'TEXT',
				'null' => TRUE,
			],
			'is_deleted' => [
				'type' => 'TINYINT(4)',
			],
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($table);
	 
	}


	public function down()
	{
		$table = "maintenance";
		if ($this->db->table_exists($table))
		{ 
			$this->dbforge->drop_table($table);
		}
	}

}
