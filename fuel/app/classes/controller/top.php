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

class Controller_Top extends Controller
{
	/**
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
		$data = [];
		$error = null;
		if($_POST){
			$auth = Auth::instance();
			if($auth->login($_POST['id'],$_POST['password']) ){
				Response::redirect('user/index');
			}else{
				$error = 'ユーザーIDかパスワードが違います。再入力して下さい。';
			}
		}

		//--------------------------------------View
		$layoutdata = array();
		$layoutdata['title'] = 'Home';
		$view = CustomLayouts::layoutsset($layoutdata,null);
		$view->content = View::forge('top/index');
		$view->set_global('error',$error);
		// echo $data;
		return $view;
	}

}
