<div class="modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Купон на знижку</h3>
  </div>
  <div class="modal-body">
				<form class="form-horizontal form_edit" action="/" method="post">
					<fieldset>
					<div class="control-group">
					<label class="control-label" for="focusedInput">Номер</label>
					<div class="controls">
						<input id="_number" name="number"class="input-xlarge focused" id="focusedInput" type="text" value="">
					</div>
					</div>
					
					<div class="control-group">
					<label class="control-label" for="focusedInput">Оранізація</label>
					<div class="controls">
								<select name="organization_id" id="_organization_id" >
							  	<?php foreach($organizations as  $organization):?>
							  	
									<option value="<?php echo $organization->id ?>"><?php echo $organization->name?></option>
								<?php endforeach;?>
									
									
							</select>
					</div>
					</div>

					<div class="control-group">
					<label class="control-label" for="focusedInput">Процент знижки</label>
					<div class="controls">
						<input id="_discount" name="discount" class="input-xlarge focused" id="focusedInput" type="text" value="">
					</div>
					</div>
					
					
					<div class="control-group">
					<label class="control-label" for="focusedInput">Багаторазовий?</label>
					<div class="controls">
								<select name="many_use" id="_many_use" >
									<option value="0">Ні</option>
									<option value="1">Так</option>
									
									
									
							</select>
					</div>
					</div>
					
					


					<input type="hidden" name="id" id="_id" />
<?php /*
					<div class="control-group">
						<label class="control-label" >Курс</label>
						<div class="controls">
							<select name="courses_id" id="_courses_id" >
							  	<?php foreach($courses as  $id => $course):?>
							  	
									<option value="<?php echo $id ?>"><?php echo $course?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					*/ ?>
					</fieldset>
				</form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn">Закрити</a>
    <a href="#" class="btn btn-primary">Зберегти</a>
  </div>
</div>