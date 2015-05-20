<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 * @package    app
 * @extends    Controller
 *
 */

class Controller_User extends Controller
{
	/**
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
		if(!Auth::check()){
			Response::redirect('/user/error');
		}

		// ¥í¥°¥¤¥ó¤·¤Æ¤¤¤ë¥æ©`¥¶©`¤ÎÇéˆó
		$user = Model_Newregist::find(Auth::get_user_id()[1]);
		$profile = unserialize($user->profile_fields);
		$pref= ( array_key_exists('pref',$profile) ) ? $pref = $profile['pref'] : null;
		$home= ( array_key_exists('home',$profile) ) ? $home = $profile['home'] : null;
		$comment = ( array_key_exists('comment',$profile) ) ? $comment = $profile['comment'] : null;
		$url=( array_key_exists('url',$profile) ) ? $url = $profile['url'] : null;

		$userdata = [
			'id'=>$user->id,
			'username'=>$profile['displayName'],
			'pref'=>$pref,
			'home'=>$home,
			'comment'=>$comment,
			'url'=>$url,
			'password'=>$user->password,
		];


		$drumdata;
		$guitardata;

		$formtype = ['profiles','drum','guitar'];

		// function userProfileEdit(){
		// 	$user = Model_Newregist::find(Auth::get_user_id()[1]);;
		// 	$displayName = Input::post('displayName');
		// 	$pref = Input::post('pref');
		// 	$home = Input::post('home');
		// 	$url = Input::post('url');
		// 	$comment = Input::post('comment');
		// 	$password = Input::post('password');
		// 	$old_password = $user->password;
		// 	Auth::update_user([
		// 		'password'=>$password,
		// 		'old_password'=>$old_password,
		// 		'profile_fields'=>[
		// 			'displayName'=>$displayName,
		// 			'pref'=>$pref,
		// 			'home'=>$home,
		// 			'url'=>$url,
		// 			'comment'=>$comment,
		// 		],
		// 	]);
		// };
		// function musicDataEdit($type){
			
		// };

		if(Input::post()){
			$formname = Input::post('formType');
			print_r($formname);
			if($formname == $formtype[0]){
				// userProfileEdit();
				$user = Model_Newregist::find(Auth::get_user_id()[1]);
				$displayName = Input::post('displayName');
				$pref = Input::post('pref');
				$home = Input::post('home');
				$url = Input::post('url');
				$comment = Input::post('comment');
				$password = Input::post('password');
				$old_password = $user->password;
				$auth = Auth::instance();
				$userId = $auth->get_screen_name();
				echo $userId;
				$auth->update_user(array(
					// 'password' => $password,
					// 'old_password' => $old_password,
					'displayName'=>$displayName,
					'pref'=>$pref,
					'home'=>$home,
					'url'=>$url,
					'comment'=>$comment,
				),$userId);
			}
			if($formname == $formtype[1]){
				// musicDataEdit($formname);
				print_r($_POST);
			}
			if($formname == $formtype[2]){
				// musicDataEdit($formname);
				print_r($_POST);
			}
		}


		$layoutdata = array();
		$layoutdata['title'] = '¥Þ¥¤¥Ú©`¥¸';
		
		$view = CustomLayouts::layoutsset($layoutdata,null);

		Asset::js(["view/user.js"],[],'add_js',false);
		$view->content = View::forge('user/index');

		$className = array('drummania');
		$view->set_global('drumform',View::forge('elements/userform',array('data'=>$className)));

		$className = array('guitarfreaks');
		$view->set_global('guitarform',View::forge('elements/userform',array('data'=>$className)));

		return $view;
	}
	public function action_error()
	{
		$layoutdata = array();
		$layoutdata['title'] = '¥¨¥é©`';
		
		$view = CustomLayouts::layoutsset($layoutdata,null);

		$view->content = View::forge('user/error');
		return $view;
	}

}
