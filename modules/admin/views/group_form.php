<div class="modal" style="width:500px" data-course_id="<?php echo $id?>">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Групи набору на курси
		<a class="btn btn-warning" href="#">Додати<i class="icon-edit icon-white"></i></a>
    </h3>
  </div>
  <div class="modal-body">
					<?php foreach($groups as $k=>$plan):?>
						
						<div class="control-group" data-id="<?php echo $plan->id?>" style="position:relative">
							<label style="text-align:left" class="control-label g_lab" for="focusedInput">
								Група <?php echo ($k + 1)?>
							</label>
							<label style="text-align:left" class="control-label" for="focusedInput">
								Початок занять <?php echo 
								$plan->start_date."</br>Дні:".
								$plan->days.". </br >Час занять".
								$plan->time_from."-".
								$plan->time_to."<br />К-ть занять: ".
								$plan->lessons_count.".<br/>Ціна:".
								$plan->price
								
								
								
								
								
								 ;?>
							</label>
							<div class="controls" style="margin-left: 30px;padding-bottom: 10px;position:absolute;top:0;right:0;">
								<a class="btn btn-danger" href="#">Видалити</a>
								<a class="btn btn-success" href="#">Редагувати</a>
							</div>
						</div>
					<?php endforeach;?>
  </div>
</div>