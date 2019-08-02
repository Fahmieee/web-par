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
class Migration_create_table_unit extends CI_Migration {


	public function up()
	{ 
		$table = "units";
		$fields = array(
			'id'           => [
				'type'           => 'INT(11)',
				'auto_increment' => TRUE,
				'unsigned'       => TRUE,
			],
			'type_assets'      => [
				'type' => 'INT(11)',
			],
			'type_unit'      => [
				'type' => 'INT(11)',
			],
			'merk'      => [
				'type' => 'VARCHAR(255)',
			],
			'model'      => [
				'type' => 'VARCHAR(255)',
			],
			'varian'      => [
				'type' => 'VARCHAR(255)',
			],
			'years'      => [
				'type' => 'INT(4)',
			],
			'mes'      => [
				'type' => 'VARCHAR(255)',
			],
			'transmition'      => [
				'type' => 'VARCHAR(255)',
			],
			'no_police'      => [
				'type' => 'VARCHAR(255)',
			],
			'mileage'      => [
				'type' => 'INT(11)',
			],
			'stnk_due_date'          => [
				'type' => 'DATE',
			],
	 		'kir_due_date'          => [
				'type' => 'DATE',
			],
			'chassis_number'      => [
				'type' => 'VARCHAR(255)',
			],
			'machine_number'      => [
				'type' => 'VARCHAR(255)',
			],
			'color'      => [
				'type' => 'VARCHAR(255)',
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
		$table = "units";
		if ($this->db->table_exists($table))
		{ 
			$this->dbforge->drop_table($table);
		}
	}

}
