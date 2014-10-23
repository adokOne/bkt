<div class="modal" style="width:800px">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Підготовка до курсу
		
    </h3>
  </div>
  <div class="hidden" style="display:none">
  						

  </div>
  <div class="modal-body"  style="max-height: 500px;">
				<form class="form-horizontal form_edit" action="/" method="post">
					<input type="hidden" name="course_id" id="_course_id" value="<?php echo $id?>" />
					<fieldset>
  						<div class="control-group">		
						<div class="controls" style="margin-left: 30px;padding-bottom: 10px;">
							Текст Рус
							<textarea  name="text_ru" id="text_ru"><?php echo $prepare->text_ru?></textarea>
							<a href="ru" class="btn btn-inverse">Ссилка</a>
						</div>
							<div class="controls" style="margin-left: 30px;padding-bottom: 10px;">
							Текст УКР
							<textarea  name="text_ua" id="text_ua"><?php echo $prepare->text_ua?></textarea>
							<a href="ua" class="btn btn-inverse">Ссилка</a>
						</div>
						</div>
					</fieldset>
				</form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn btn-primary">Зберегти</a>
  </div>
</div>