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
		if(Input::method()=='POST'){
			$val = Model_Userregist::validate('create');
			$val -> add_field('email','Eメール','required|valid_email');
			if($val->run()){
				$username=Input::post('username');
				$email=Input::post('email');
				$password=Input::post('password');
				$group=1;
				// $email_cound=Model_Userregist::find()->where('email',$email)->count();
				// if($email_count>0){
				// 	Session::set_flash('error','登録済みのメールアドレスです。');
				// }

				$auth = Auth::instance();
				if($auth->create_user($username,$password,$email,$group)){
					$created=Model_Userregist::find('first',array('where'=>array('email'=>$email)))->created_at;

					$body = 'author:skill simlator α\n\n';
					$body.= 'thank you for registed.\n';
					$body.= Html::anchor('user/activate/'.$email.'/'.$created,'登録完了');
					$body.= '\n\n 30分以内に送信したメールから登録完了を行って下さい。';
					$body.= '\n 30分を過ぎますと登録は無効となり、再登録する必要があります。';

					$mail=Email::forge();
					$sendmail->from('info@gitadora.96.lt','gitadora skillsimlator α');
					$sendmail->to($email,$username);
					$sendmail->subject('【GITADORA Skill Simlator α】登録手続');
					$sendmail->html_body($body);

					$sendmail->send();

					Session::set_flash('success',$username.'仮登録<br>');
					Response::redirect('/');
				}else{
					Session::set_flash('error','登録されませんでした。');
				}
			}

			Session::set_flash('error',$val->show_errors());
		}

		//--------------------------------------View
		$layoutdata = array();
		$layoutdata['title'] = 'Home';
		
		$view = CustomLayouts::layoutsset($layoutdata,null);
		$view->content = View::forge('top/index');
		// return Response::forge( View::forge('top/index') );
		return $view;
	}

}
