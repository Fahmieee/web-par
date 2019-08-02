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
class Migration_add_column_pairing_id_order extends CI_Migration {


	public function up()
	{ 
		$fields = array(  
            'pairing_id' => array(
                'type' => 'INT',
                'constraing'=>11
            ),
        );
        $this->dbforge->add_column('orders', $fields); 

	}


	public function down()
	{
		$this->dbforge->drop_column('orders', 'pairing_id'); 
	}

}
