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
class Migration_insert_master_menu_booking extends CI_Migration {


	public function up()
	{ 
		 
            $data_menu =  array('id'=>34,'module_id'=>1, 'name'=>'Booking', 'url'=>'booking', 'parent_id'=>23, 'icon'=>" ", 'sequence'=>5) ;
            $insert = $this->db->insert('menu', $data_menu);  
            for($i=1;$i<=5;$i++){
                  $data_menu_function = array(
                          'menu_id' => $insert, 
                          'function_id' => $i, 
                      );
                      $this->db->insert('menu_function', $data_menu_function);
                  }
      	} 

	public function down()
	{
		
	}

}