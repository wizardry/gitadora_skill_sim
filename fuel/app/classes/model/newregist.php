<?php 
// namespace Model;
use Orm\Model;

class Model_Newregist extends Model{
	protected static $_table_name = 'userinfo_tb';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'id',
		'username',
		'password',
		'group',
		'email',
		'last_login',
		'login_hash',
		'profile_fields',
		'created_at',
		'updated_at',
	);

	// public static function post_results()
	// {
		
	// }
}

