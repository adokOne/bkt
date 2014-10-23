<div class="modal" style="width:500px">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>План курсу
		<a class="btn btn-warning" href="#">Додати<i class="icon-edit icon-white"></i></a>
    </h3>
  </div>
  <div class="hidden" style="display:none">
  						
  						<div class="control-group">
  							<label style="text-align:left" class="control-label" for="focusedInput"></label>
  							<div class="controls" style="margin-left: 30px;padding-bottom: 10px;">
							<a class="btn btn-danger" href="#">Видалити</a>			
							</div>			
						<div class="controls" style="margin-left: 30px;padding-bottom: 10px;">
							Назва Рус
							<input  name="name[0][ru]"class="input-xlarge focused" id="focusedInput" type="text" value="">
						</div>
							<div class="controls" style="margin-left: 30px;padding-bottom: 10px;">
							Назва УКР
							<input  name="name[0][ua]"class="input-xlarge focused" id="focusedInput" type="text" value="">
						</div>
						</div>
  </div>
  <div class="modal-body" style="max-height: 300px;">
				<form class="form-horizontal form_edit" action="/" method="post">
					<input type="hidden" name="course_id" id="_course_id" value="<?php echo count($plans) > 0 ? $plans[0]->course_id : ""?>" />
					<fieldset>

					<?php foreach($plans as $k=>$plan):?>
						
						<div class="control-group">
							<label style="text-align:left" class="control-label" for="focusedInput">Тема <?php echo ($k + 1);?></label>
							<div class="controls" style="margin-left: 30px;padding-bottom: 10px;">
								<a class="btn btn-danger" href="#">Видалити</a>
								<a class="btn btn-success" data-id="<?php echo $plan->id?>" href="#">Редагувати підпункти</a>
							</div>
						
						<div class="controls" style="margin-left: 30px;padding-bottom: 10px;">
							Назва Рус
							<input  name="name[<?php echo ($k);?>][ru]"class="input-xlarge focused" id="focusedInput" type="text" value="<?php echo $plan->name_ru;?>">
						</div>
							<div class="controls" style="margin-left: 30px;padding-bottom: 10px;">
							Назва УКР
							<input  name="name[<?php echo ($k);?>][ua]"class="input-xlarge focused" id="focusedInput" type="text" value="<?php echo $plan->name_ua;?>">
						</div>
						</div>
					<?php endforeach;?>
					</fieldset>
				</form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn close">Закрити</a>
    <a href="#" class="btn btn-primary">Зберегти</a>
  </div>
</div>