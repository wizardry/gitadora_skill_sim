<?php 
class Customlayouts
{
	public static function layoutsset($data,$page)
	{
		if($page == null){
			$view = View::forge('layouts/template',array('title'=>$data['title']));
			$view->header = View::forge('elements/header-normal');
			$view->footer = View::forge('elements/footer-normal');

			return $view;
		}else{
			$view = View::forge('layouts/template');
			$view->header = View::forge('elements/header-normal');
			$view->footer = View::forge('elements/footer-normal');

			return $view;
		}
	}
}


?>