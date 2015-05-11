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
		//---------------------------------------DB 登録確認用
		if(Input::method() == 'POST'){
			$data = array(
				'created_at'=>'20150510',
				'updated_at'=>'20150510',
				'testtext'=>'fizzbuzz',
				'testvarchar'=>'fizzbuzz',
			);
			$postdata = new Model_Connecttest($data);
			echo 'hoge';
			$postdata->save();
			// $postQuery = DB::insert('connect_test')->set($postdata)->execute();
			echo DB::last_query();
		}

		//---------------------------------------DB 接続確認用
		$query = DB::select()->from('connect_test')->execute();

		//---------------------------------------DB 登録テスト
		$res1 = Model_Connecttest::find('all');
		// $resTestText -> $res1->testtext;

		//--------------------------------------View
		$layoutdata = array();
		$layoutdata['title'] = 'Home';
		
		$view = CustomLayouts::layoutsset($layoutdata,null);

		// $view ->set_global('resTestText',$resTestText->as_array());
		// $view ->set_global('res1',$res1->testtext);
		$view ->set_global('res1',$res1);
		$view ->set_global('query',$query->as_array());

		$view->content = View::forge('top/index');
		// return Response::forge( View::forge('top/index') );
		return $view;
	}

	// public function action_index(){

	// }

}
