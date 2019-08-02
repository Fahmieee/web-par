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
class Migration_add_column_order_wo_no_order extends CI_Migration {


	public function up()
	{ 
		$fields = array(  
            'order_wo_no' => array(
                'type' => 'VARCHAR',
                'constraint'=>255
            ),
        );
        $this->dbforge->add_column('orders', $fields); 

	}


	public function down()
	{
		$this->dbforge->drop_column('orders', 'order_wo_no'); 
	}

}
