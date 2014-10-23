<div class="modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Ціна на курс</h3>
  </div>
  <div class="modal-body">
				<form class="form-horizontal form_edit" action="/" method="post">
					<fieldset>
					
					

					<div class="control-group">
					<label class="control-label" for="focusedInput">Ціна 2</label>
						<div class="controls">
							<input id="_price_1" name="price_1"class="input-xlarge focused" id="focusedInput" type="text" value="">
						</div>
					</div>
					<div class="control-group">
					<label class="control-label" for="focusedInput">Ціна 3-4</label>
						<div class="controls">
							<input id="_price_2" name="price_2"class="input-xlarge focused" id="focusedInput" type="text" value="">
						</div>
					</div>
					<div class="control-group">
					<label class="control-label" for="focusedInput">Ціна 5-6</label>
						<div class="controls">
							<input id="_price_3" name="price_3"class="input-xlarge focused" id="focusedInput" type="text" value="">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput">Ціна 7-8</label>
						<div class="controls">
							<input id="_price_4" name="price_4"class="input-xlarge focused" id="focusedInput" type="text" value="">
						</div>
					</div>
					


					<input type="hidden" name="id" id="_id" />

					<div class="control-group">
						<label class="control-label" >Курс</label>
						<div class="controls">
							<select name="course_id" id="_course_id" >
							  	<?php foreach($courses as  $id => $course):?>
							  	
									<option value="<?php echo $id ?>"><?php echo $course?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					</fieldset>
				</form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn">Закрити</a>
    <a href="#" class="btn btn-primary">Зберегти</a>
  </div>
</div>