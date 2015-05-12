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
		$layoutdata = array();
		$layoutdata['title'] = '新規登録';
		
		$view = CustomLayouts::layoutsset($layoutdata,null);

		$view->content = View::forge('user/index');
		$view->drumForm = View::forge('elements/userform','drummania');
		$view->GuitarForm = View::forge('elements/userform','guitar');
		return $view;
	}
}
