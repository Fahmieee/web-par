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
class Migration_drop_column_pic_id extends CI_Migration {


	public function up()
	{ 

        $this->dbforge->drop_column('workshops_pics', 'pic_id'); 
	}


	public function down()
	{  
        $fields = array(  
            'pic_id' => array(
                'type' => 'INT', 
                'constraint' => 11, 
            )
        );
        $this->dbforge->add_column('workshops_pics', $fields); 
	}

}
