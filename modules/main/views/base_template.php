<p>
<?php
if(isset($course)){
$course_p = $this->db->from("pages")->join("pages_langs",array("pages.id"=>"pages_langs.page_id"))->where(array("pages_langs.id_lang"=>$cur_lang,"pages.course_id"=>$course->id))->get()->current();

echo $course_p->text;


}

?>
</p>
<div>
	<ul style="list-style: none;">
		<?php foreach($courses as $course):?>
		<li style="height: 120px;border-bottom: 1px dashed gray;padding-top: 10px;">
			<img alt="<?php echo $course->img_alt?>" title="<?php echo $course->img_title?>" style="float: left;" src="/upload/logos/<?php echo $course->id?>/pic_93.jpg" width="93" height="93">
			<?php $course_p = $this->db->from("pages")->join("pages_langs",array("pages.id"=>"pages_langs.page_id"))->where(array("pages_langs.id_lang"=>$cur_lang,"pages.course_id"=>$course->id))->get()->current();?>
			<?php $course_l = $course->where("id_lang",$cur_lang)->courses_langs->current();?>
			
			<div style="float: left;width:400px" >
				<?php $link = Router::$current_language == Kohana::config('multi_lang.default') ? "/" : "/".Router::$current_language."/";?>
				<a href="<?php echo $link.url::current()."/".$course->seo_name?>">
					<h3 style="text-align: center;margin:0">	
						<?php echo $course_l!==false ? $course_l->name : ""?>
					</h3>
				</a>
				<p style="text-align: justify;width: 465px;padding: 5px;">
					<?php  echo $course_p !== false ? strip_tags(trim(text::limit_chars($course_p->text,300,"..."))) : ""?>
				</p>
			</div>
		</li>
		<?php endforeach;?>
	</ul>
</div>