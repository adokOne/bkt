<ul class="breadcrumb">
					<li>
						<a data-auto-controller="UsersController" class="btn btn-inverse" href="#">Додати</a> 
					</li>
					<?php foreach($roles as $role):?>
						<?php if($role->name=="login") continue;?>
					<li>
	
						<a style="color:white" data-role_id="<?php echo $role->id?>" data-auto-controller="UsersController" class="btn btn-warning" href="#"><?php echo $role->desc?></a> 
					</li>
					<?php endforeach;?>
				</ul>