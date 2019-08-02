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
class Migration_create_table_notification extends CI_Migration {


	public function up()
	{ 
		$table = "notification";
		$fields = array(
			'id'           => [
				'type'           => 'INT(11)',
				'auto_increment' => TRUE,
				'unsigned'       => TRUE,
			], 
			'from'           => [
				'type'           => 'INT(11)',  
			], 
			'to'      => [
				'type'           => 'INT(11)',  
			], 
			'title'      => [
			 	'type' => 'varchar',
                'constraint'=>255
			],
			'message'          => [
				'type' => 'text'
			],
			'created_at'      => [
				'type'           => 'DATETIME',  
			], 
            'created_by' => array(
                'type' => 'INT',
                'constraint'=>11
            ),
            'is_read' => array(
                'type' => 'INT',
                'constraint'=>1,
                'default'=>0
            ),
            'category' => array(
                'type' => 'varchar',
                'constraint'=>255
            ),
            'reference_id' => array(
                'type' => 'INT',
                'constraint'=>11,
                'default'=>0
            ),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($table);
	 
	}


	public function down()
	{
		$table = "notification";
		if ($this->db->table_exists($table))
		{ 
			$this->dbforge->drop_table($table);
		}
	}

}
