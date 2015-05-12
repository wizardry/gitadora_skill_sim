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

class Controller_Newregist extends Controller
{
	/**
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
		if(Input::post()){
			$temp = Model_Newregist::find('last');
			$querytest = $temp->id;

			$displayname=Input::post('username');
			$username = $querytest+1;
			$password=Input::post('password');
			$email=Input::post('email');

			$auth = Auth::instance();
			$auth->create_user($username,$password,$email,1,array('displayName'=>$displayname,));

		}
		$layoutdata = array();
		$layoutdata['title'] = '新規登録';
		
		$view = CustomLayouts::layoutsset($layoutdata,null);

		$view->content = View::forge('newregist/index');
		return $view;
	}
}
