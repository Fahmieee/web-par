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
class Migration_create_table_produk extends CI_Migration {


	public function up()
	{ 
		$table = "produk";
		$fields = array(
			'id'           => [
				'type'           => 'INT(11)',
				'auto_increment' => TRUE,
				'unsigned'       => TRUE,
			], 
			 
	 		'code' => array(
                'type' => 'varchar',
                'constraint'=>255
            ),
	 		'name' => array(
                'type' => 'varchar',
                'constraint'=>255
            ),
	 		'description' => array(
                'type' => 'text'
            ),
			 
            'is_deleted' => array(
                'type' => 'int',
                'constraint'=>1,
                'default'=>0
            ),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($table);
	 
	}


	public function down()
	{
		$table = "produk";
		if ($this->db->table_exists($table))
		{ 
			$this->dbforge->drop_table($table);
		}
	}

}
