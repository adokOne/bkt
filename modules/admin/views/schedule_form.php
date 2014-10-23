<div class="modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Графік групового курсу</h3>
  </div>
  <div class="modal-body">
				<form class="form-horizontal form_edit" action="/" method="post">
					<fieldset>
												
					<div class="control-group">
					<label class="control-label" for="focusedInput">Дні</label>
					<div class="controls">
						<input id="_days" name="days"class="input-xlarge focused" id="focusedInput" type="text" value="">
					</div>
					</div>

					
					

					<div class="control-group">
					<label class="control-label" for="focusedInput">Початок(час)</label>
					<div class="controls">
						<input id="_time_from" name="time_from"class="input-xlarge focused" id="focusedInput" type="text" value="">
					</div>
					</div>


					<div class="control-group">
					<label class="control-label" for="focusedInput">Кінець(час)</label>
					<div class="controls">
						<input id="_time_to" name="time_to"class="input-xlarge focused" id="focusedInput" type="text" value="">
					</div>
					</div>



					<div class="control-group">
					<label class="control-label" for="focusedInput">Початок(дата)</label>
					<div class="controls">
						<input id="_start_date" name="start_date"class="input-xlarge focused" id="focusedInput" type="text" value="">
					</div>
					</div>


					<div class="control-group">
					<label class="control-label" for="focusedInput">К-ть занять</label>
					<div class="controls">
						<input id="_lessons_count" name="lessons_count"class="input-xlarge focused" id="focusedInput" type="text" value="">
					</div>
					</div>

					<div class="control-group">
					<label class="control-label" for="focusedInput">К-ть людей</label>
					<div class="controls">
						<input id="_people_count" name="people_count"class="input-xlarge focused" id="focusedInput" type="text" value="">
					</div>
					</div>

					<div class="control-group">
					<label class="control-label" for="focusedInput">Ціна</label>
					<div class="controls">
						<input id="_price" name="price"class="input-xlarge focused" id="focusedInput" type="text" value="">
					</div>
					</div>









					<input type="hidden" name="course_id" id="_course_id" value="<?php echo $course_id?>"/>
                                        <input type="hidden" name="id" id="_id" value="<?php echo $id?>"/>


					</fieldset>
				</form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn">Закрити</a>
    <a href="#" class="btn btn-primary">Зберегти</a>
  </div>
</div>