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
class Migration_add_column_pic_detail extends CI_Migration {


	public function up()
	{ 
		$fields = array(  
            'name' => array(
                'type' => 'varchar', 
                'constraint' => 255, 
            ),'email' => array(
                'type' => 'varchar', 
                'constraint' => 255, 
            ),'phone' => array(
                'type' => 'varchar', 
                'constraint' => 255, 
            ),'is_cs' => array(
                'type' => 'int', 
                'constraint' => 1, 
                'default'=>0
            ),
        );
        $this->dbforge->add_column('workshops_pics', $fields); 

	}


	public function down()
	{
		$this->dbforge->drop_column('workshops_pics', 'name');
		$this->dbforge->drop_column('workshops_pics', 'email');
		$this->dbforge->drop_column('workshops_pics', 'phone');
		$this->dbforge->drop_column('workshops_pics', 'is_cs');
	}

}
