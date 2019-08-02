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
class Migration_add_column_start_end_contract extends CI_Migration {


	public function up()
	{ 
		$fields = array(  
            'start_date_contract' => array(
                'type' => 'datetime' 
            ) ,
            'end_date_contract' => array(
                'type' => 'datetime' 
            ) 
        );
        $this->dbforge->add_column('users', $fields); 

	}


	public function down()
	{
		$this->dbforge->drop_column('users', 'start_date_contract'); 
		$this->dbforge->drop_column('users', 'end_date_contract'); 
	}

}
