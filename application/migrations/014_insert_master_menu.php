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
class Migration_insert_master_menu extends CI_Migration {


	public function up()
	{ 
		// insert function value
		 $data_menu = array(
            array('id'=>1,'module_id'=>1, 'name'=>'root', 'url'=>'#', 'parent_id'=>0, 'icon'=>" ", 'sequence'	=>0),
            array('id'=>2,'module_id'=>1, 'name'=>'Dashboard', 'url'=>'dashboard', 'parent_id'=>1, 'icon'=>"fa-home", 'sequence'=>1),
            array('id'=>3,'module_id'=>1, 'name'=>'System Access', 'url'=>'#', 'parent_id'=>1, 'icon'=>"fa-users", 'sequence'=>2),
            array('id'=>4,'module_id'=>1, 'name'=>'Group', 'url'=>'group', 'parent_id'=>3, 'icon'=>" ", 'sequence'=>1),
            array('id'=>5,'module_id'=>1, 'name'=>'Role', 'url'=>'role', 'parent_id'=>3, 'icon'=>" ", 'sequence'=>2),
            array('id'=>6,'module_id'=>1, 'name'=>'Privileges', 'url'=>'privilleges', 'parent_id'=>3, 'icon'=>" ", 'sequence'=>3),
            array('id'=>7,'module_id'=>1, 'name'=>'Manage Account', 'url'=>'#', 'parent_id'=>1, 'icon'=>"fa-universal-access", 'sequence'	=>3), 
            array('id'=>8,'module_id'=>1, 'name'=>'Employee', 'url'=>'employee', 'parent_id'=>7, 'icon'=>" ", 'sequence'=>1), 
            array('id'=>9,'module_id'=>1, 'name'=>'Driver', 'url'=>'driver', 'parent_id'=>7, 'icon'=>" ", 'sequence'=>2), 
            array('id'=>10,'module_id'=>1, 'name'=>'User', 'url'=>'user', 'parent_id'=>7, 'icon'=>" ", 'sequence'=>3), 
            array('id'=>11,'module_id'=>1, 'name'=>'Master Data', 'url'=>'#', 'parent_id'=>1, 'icon'=>"fa-database", 'sequence'=>4), 
            array('id'=>12,'module_id'=>1, 'name'=>'Kota', 'url'=>'city', 'parent_id'=>11, 'icon'=>" ", 'sequence'=>1), 
            array('id'=>13,'module_id'=>1, 'name'=>'Area', 'url'=>'area', 'parent_id'=>11, 'icon'=>" ", 'sequence'=>2), 
            array('id'=>14,'module_id'=>1, 'name'=>'Cabang', 'url'=>'branch', 'parent_id'=>11, 'icon'=>" ", 'sequence'=>3), 
            array('id'=>15,'module_id'=>1, 'name'=>'Driver', 'url'=>'driver', 'parent_id'=>11, 'icon'=>" ", 'sequence'=>4), 
            array('id'=>16,'module_id'=>1, 'name'=>'Bengkel', 'url'=>'workshop', 'parent_id'=>11, 'icon'=>" ", 'sequence'=>5), 
            array('id'=>17,'module_id'=>1, 'name'=>'Unit', 'url'=>'unit', 'parent_id'=>11, 'icon'=>" ", 'sequence'=>6), 
            array('id'=>18,'module_id'=>1, 'name'=>'Parts Rutin', 'url'=>'maintenance_routine', 'parent_id'=>11, 'icon'=>" ", 'sequence'=>7), 
            array('id'=>19,'module_id'=>1, 'name'=>'Parts Non-Rutin', 'url'=>'maintenance_non_routine', 'parent_id'=>11, 'icon'=>" ", 'sequence'=>8), 
            array('id'=>20,'module_id'=>1, 'name'=>'Item Review Periodic', 'url'=>'review_items', 'parent_id'=>11, 'icon'=>" ", 'sequence'=>9), 
            array('id'=>21,'module_id'=>1, 'name'=>'Scheduler Tools', 'url'=>'#', 'parent_id'=>1, 'icon'=>"fa-server", 'sequence'=>5), 
            array('id'=>22,'module_id'=>1, 'name'=>'Scheduler', 'url'=>'scheduler', 'parent_id'=>21, 'icon'=>" ", 'sequence'=>1),
            array('id'=>23,'module_id'=>1, 'name'=>'Maintenance Service', 'url'=>'#', 'parent_id'=>1, 'icon'=>"fa-car", 'sequence'=>6),  
            array('id'=>24,'module_id'=>1, 'name'=>'Maintenance Request', 'url'=>'maintenance_request', 'parent_id'=>23, 'icon'=>" ", 'sequence'=>1),  
            array('id'=>25,'module_id'=>1, 'name'=>'Work Order', 'url'=>'workorder', 'parent_id'=>23, 'icon'=>" ", 'sequence'=>2), 
            array('id'=>26,'module_id'=>1, 'name'=>'Report Work Order', 'url'=>'report/workorder', 'parent_id'=>23, 'icon'=>" ", 'sequence'=>3), 
            array('id'=>27,'module_id'=>1, 'name'=>'History Pelayanan', 'url'=>'#', 'parent_id'=>1, 'icon'=>"fa-history", 'sequence'=>7),  
            array('id'=>28,'module_id'=>1, 'name'=>'History Pelayanan', 'url'=>'report/order', 'parent_id'=>27, 'icon'=>" ", 'sequence'=>1),  
            array('id'=>29,'module_id'=>1, 'name'=>'History Pelayanan Driver', 'url'=>'report/driver', 'parent_id'=>27, 'icon'=>" ", 'sequence'=>2),  
            array('id'=>30,'module_id'=>1, 'name'=>'History Pelayanan Bengkel', 'url'=>'report/workshop', 'parent_id'=>27, 'icon'=>" ", 'sequence'=>3),  
        );
        $this->db->insert_batch('menu', $data_menu); 
	} 

	public function down()
	{
		
	}

}