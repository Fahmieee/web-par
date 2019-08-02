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
class Migration_add_column_is_booking extends CI_Migration {


	public function up()
	{ 
		$fields = array(  
            'is_booking' => array(
                'type' => 'int',
                'constraint'=>11,
                'default'=>0
            ),
        );
        $this->dbforge->add_column('orders', $fields); 

	}


	public function down()
	{
		$this->dbforge->drop_column('orders', 'is_booking'); 
	}

}
