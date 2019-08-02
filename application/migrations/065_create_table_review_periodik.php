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
class Migration_create_table_review_periodik extends CI_Migration {


	public function up()
	{ 
		$table = "review_periodik";
		$fields = array(
			'id'           => [
				'type'           => 'INT(11)',
				'auto_increment' => TRUE,
				'unsigned'       => TRUE,
			],  
			'item_id'      => [
				'type'           => 'INT(11)',  
			], 
			'user_id'           => [
				'type'           => 'INT(11)',  
			], 
			'driver_id'      => [
				'type'           => 'INT(11)',  
			],  
			'nilai'      => [
				'type'           => 'VARCHAR(255)',  
			],
			'rating'      => [
				'type'           => 'VARCHAR(255)',  
			],
	 		'note' => array(
                'type' => 'text'
            ), 
	 		'created_at' => array(
                'type' => 'datetime'
            )
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($table);
	 
	}


	public function down()
	{
		$table = "review_periodik";
		if ($this->db->table_exists($table))
		{ 
			$this->dbforge->drop_table($table);
		}
	}

}
