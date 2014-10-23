<div class="modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  </div>
  <div class="modal-body">
				<form class="form-horizontal form_edit" action="/" method="post">
					<fieldset>
					<div class="control-group">
					<label class="control-label" for="focusedInput">Відповідь</label>
					<div class="controls">
						<textarea name="text"></textarea>
					</div>
					</div>

					<input type="hidden" name="id" id="_id" value="<?php echo $id?>"/>
					</fieldset>
				</form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn btn-primary">Зберегти</a>
  </div>
</div>