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
class Migration_create_table_preorders extends CI_Migration {


	public function up()
	{ 
		$table = "preorders";
		$fields = array(
			'id'           => [
				'type'           => 'INT(11)',
				'auto_increment' => TRUE,
				'unsigned'       => TRUE,
			], 
			'maintenance_id'           => [
				'type'           => 'INT(11)',  
			], 
			'unit_id'      => [
				'type'           => 'INT(11)',  
			], 
			'workshop_id'      => [
				'type'           => 'INT(11)',  
			],
			'user_id'          => [
				'type'           => 'INT(11)',  
			],
			'status'      => [
				'type'           => 'VARCHAR(255)',  
			],
	 		'description' => array(
                'type' => 'text'
            ),
			'preorder_no' => array(
                'type' => 'varchar',
                'constraint'=>255
            ),
           	'order_date' => array(
                'type' => 'DATETIME'
            ),
            'pairing_id' => array(
                'type' => 'INT',
                'constraint'=>11
            ),
            'type' => array(
                'type' => 'INT',
                'constraint'=>11
            ),
            'service_type' => array(
                'type' => 'varchar',
                'constraint'=>255
            ),
            'token' => array(
                'type' => 'varchar',
                'constraint'=>255
            ),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($table);
	 
	}


	public function down()
	{
		$table = "preorders";
		if ($this->db->table_exists($table))
		{ 
			$this->dbforge->drop_table($table);
		}
	}

}
