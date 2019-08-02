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
class Migration_drop_table_pic extends CI_Migration {


	public function up()
	{ 
		$this->dbforge->drop_table('pic');
	}


	public function down()
	{
		 
	}

}
