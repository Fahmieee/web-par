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
class Migration_add_column_merk_workshop extends CI_Migration {


	public function up()
	{ 
		$fields = array(  
            'merk' => array(
                'type' => 'TEXT' 
            ),
        );
        $this->dbforge->add_column('workshop', $fields); 

	}


	public function down()
	{
		$this->dbforge->drop_column('workshop', 'merk'); 
	}

}
