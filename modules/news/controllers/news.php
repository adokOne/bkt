<?php 
class News_Controller extends Controller {

	public function sale($seo=null){
			javascript::add(array(
				"admin/jquery-1.7.2.min",
				"jquery.validate",
				"admin/jquery-ui-1.8.21.custom.min",
				"jquery.form",
				"jquery.mvc",
				"script",
				"form",
				
			)); 
			
			
			stylesheet::add(array("jqueryslidemenu","form"));
			javascript::add(array(
				"controllers/front_menu_controller",
				"controllers/online_reg_controller",
				"controllers/call_back_controller"
			));
		
	if($seo!=null)
		$this->item($seo);
	else{
		$news = ORM::factory("news")->where("type","sale")->find_all();
		$ns = array();
		foreach ($news as $n) {
			$ns[] = $news = ORM::factory("news_lang")->where(array("id_lang"=>$this->lang,"news_id"=>$n->id))->find();
		}
		$view = new View('main');
		$view->blog = "";
		$view->menu = $this->_get_menu();
		$view->view_slide = false;
		$view->courses = $this->prepare_courses();
$view->cls = "blog";
		$content = new View("sale_list");
		$content->news = $ns;
		Router::$site_title = Kohana::config("core.sitename")."| Акції";
		Router::$site_description = Kohana::config("core.site_desc");
		Router::$site_keywords = Kohana::config("core.site_keyw");
		Router::$page_content = $content->render(false);
		Router::$page_title = "Акції";
		
		$view->render(true);
	}
}



	
	public function index($seo=null){
			javascript::add(array(
				"admin/jquery-1.7.2.min",
				"jquery.validate",
				"admin/jquery-ui-1.8.21.custom.min",
				"jquery.form",
				"jquery.mvc",
				"script",
				"form",
				
			)); 
			
			
			stylesheet::add(array("jqueryslidemenu","form"));
			javascript::add(array(
				"controllers/front_menu_controller",
				"controllers/online_reg_controller",
				"controllers/call_back_controller"
			));
		
	if($seo!=null)
		$this->item($seo);
	else{
		$news = ORM::factory("news")->where("type","news")->orderby("id","desc")->find_all();
		$ns = array();
		foreach ($news as $n) {
			$ns[] = $news = ORM::factory("news_lang")->where(array("id_lang"=>$this->lang,"news_id"=>$n->id))->find();
		}
		$view = new View('main');
		$view->blog = "";
		$view->menu = $this->_get_menu();
		$view->view_slide = false;
		$view->courses = $this->prepare_courses();
		$view->cls = "blog";
		$content = new View("news_list");
		$content->news = $ns;
		Router::$site_title = Kohana::config("core.sitename")."| Блог";
		Router::$site_description = Kohana::config("core.site_desc");
		Router::$site_keywords = Kohana::config("core.site_keyw");
		Router::$page_content = $content->render(false);
		Router::$page_title = "Статті";
		
		$view->render(true);
	}
			
		
		

	}
	
	public function item($seo){
		
		$page = ORM::factory("news_lang")->where(array("seo_name"=>trim($seo),"id_lang"=>$this->lang))->find();
		if($page->id == 0){
			Kohana::show_404();
			die;
		}
			javascript::add(array(
				"controllers/front_menu_controller",
				"controllers/feedback_page_controller"
			));
			$page->views_count ++;
			$page->save();
		$view = new View('item_blog');
		$view->menu = $this->_get_menu();
		$view->view_slide = false;
		$view->commments = $this->get_comments($page->id);
		$view->cls = "blog";
		$view->courses = $this->prepare_courses();
		Router::$site_title = $page->title;
		Router::$site_description = $page->meta_desc;
		Router::$site_keywords = $page->meta_keywords;
		Router::$page_content = $page->text;
		Router::$page_title = $page->title;
		$view->render(true);
		
	}

	public function comment(){
			$feed = ORM::factory("comment");
			$feed->news_lang_id = (int)$this->input->post("page_id");
			$feed->name = trim($this->input->post("name"));
			$feed->text = mysql_escape_string($this->input->post("text"));
            $feed->email = mysql_escape_string($this->input->post("email"));
			$feed->created_at = time();
			$feed->save();
			echo json_encode(array("success"=>true));
	}

	private function get_comments($id){
		$view = new View("comments");
		$view->comments = ORM::factory("comment")->where("news_lang_id",$id)->find_all();
		$view->page_id = $id;
		return $view->render();
	}

}