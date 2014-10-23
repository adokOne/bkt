<div class="modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Список сторінок</h3>
  </div>
  <div class="modal-body">
				<form class="form-horizontal form_edit" action="/" method="post">
					<fieldset>
						
					<div class="control-group">
						<label class="control-label" >Розділ</label>
						<div class="controls">
							<select name="link" id="_link" >
								<option value="courses">-----|||-----</option>
								<option value="courses">Навчальні курси</option>
								<option value="news">Новини</option>
								<option value="price">Прайс</option>
								<option value="contacts">Контакти</option>
								<option value="about">Про нас</option>
								<option value="timetable">Розклад</option>
							  	<?php foreach($pages as  $page):?>
									<option value="<?php echo $page->old_id == 1111 ? "courses/".$page->pages_lang->current()->where("id_lang",1)->seo_name :  "index.php?option=com_content&view=category&id=1&pid=".$page->old_id ?>"><?php echo $page->pages_lang->current()->where("id_lang",1)->name?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					<input type="hidden" name="name" id="_name" />
					<input type="hidden" name="position_id" id="_position_id" value="<?php echo $id?>" />
					<input type="hidden" name="parent_id" id="_parent_id" value="<?php echo $parent_id?>" />


					</fieldset>
				</form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn">Закрити</a>
    <a href="#" class="btn btn-primary">Зберегти</a>
  </div>
</div>