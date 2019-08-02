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
class Migration_add_column_last_km extends CI_Migration {


	public function up()
	{ 
		$fields = array(  
            'last_km' => array(
                'type' => 'varchar',
                'constraint'=>255 
            ) 
        );
        $this->dbforge->add_column('user_contract_history', $fields); 

	}


	public function down()
	{
		$this->dbforge->drop_column('user_contract_history', 'last_km'); 
	}

}
