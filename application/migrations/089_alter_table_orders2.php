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
class Migration_alter_table_orders2 extends CI_Migration {


	public function up()
	{ 
		$fields = array(  
            'file' => array(
                'type' => 'VARCHAR(255)' 
            ),  
        );
        $this->dbforge->add_column('orders', $fields); 

	}


	public function down()
	{
		$this->dbforge->drop_column('orders', 'file'); 
	}

}
