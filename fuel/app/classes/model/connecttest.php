<?php 
// namespace Model;
use Orm\Model;

class Model_Connecttest extends Model{
	protected static $_table_name = 'connect_test';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'id',
		'created_at',
		'updated_at',
		'testtext',
		'testvarchar',
	);

	// public static function post_results()
	// {
		
	// }
}

?>