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
class Migration_alter_table_orders extends CI_Migration {


	public function up()
	{ 
		$this->dbforge->drop_column('orders', 'est_biaya_maintenance');
		$fields = array(  
            'est_biaya_maintenance_start' => array(
                'type' => 'DATETIME' 
            ),  
            'est_biaya_maintenance_end' => array(
                'type' => 'DATETIME' 
            ),
        );
        $this->dbforge->add_column('orders', $fields); 

	}


	public function down()
	{
		$this->dbforge->drop_column('orders', 'file'); 
	}

}
