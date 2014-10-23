<?php

function render($data){
	global $str;
	$str .= "<ul style='padding-left:20px' class='dashboard-list'>";
 	foreach($data as $k =>$row):
 		$str .= "<li>";
 		
 		$str .= "<a  style='height: 30px;display: block;' class='course' href='#_".$row["id"]."'>";

 		$str .= $row["name"];
 		$str .= "<span data-parent_id='".$row["id"]."' style='float: right;width:auto' class='btn btn-inverse'>+</span>";
 		$str .= "<span data-id='".$row["id"]."' style='float: right;width:auto' class='btn btn-danger'>-</span>";
 		$str .= "</a>";
		if(isset($row["children"]))
			render($row["children"]);
 		$str .= "</li>";
 	endforeach;
 	$str .= "</ul>";
	
}

?>
<form data-auto-controller="AdminGridController" action="" method="post">
<input type="hidden" value="<?php echo $order ?>" name="order" />
<input type="hidden" value="<?php echo $offset ?>" name="offset" id="offset"/>
<div>
	<div class="row-fluid sortable ui-sortable"  style="width: 99%;" data-auto-controller="MenuEditController">
		<div class="box span12" >
			<div class="box-header" data-original-title="" style="padding-bottom: 15px;">
				<h2>
					<i class="icon-<?php echo $grid_icon?>"></i>
					<span class="break"></span>
					<?php echo $grid_title?>

				</h2>
				<a href="#" style="float:right" class="btn btn-inverse">Додати нову</a>
			</div>
			<div class="box-content">
				<div class="row-fluid">
		<?php foreach($types as $type):?>

		<div data-id="<?php echo $type->id ?>" data-auto-controller="MenuController" class="box span12" style="width: 40%;">
			
			<div class="box-header" data-original-title="" style="padding-bottom: 15px;">
				<h2>
					<i class="icon-<?php echo $grid_icon?>"></i>
					<span class="break"></span>
					<?php echo $type->name;?>

				</h2>
				<a href="#" style="float:right" class="btn btn-inverse">Додати новий пункт</a>
			</div>
			<div class="box-content">
				<div class="listTree" data-role="grid">
<?php

$_data = arr::ORM_object_to_array($type->menus);
$_data = arr::array_stack($_data,'parent_id','children');
global $str;
$str = "";


render($_data);
echo $str;

?>

					<div class="row-fluid">
						<div class="span12">
							<div class="dataTables_info" id="DataTables_Table_0_info">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php endforeach;?>
				</div>
			</div>
		</div>
		</div>
</form>	
	<div class="row-fluid" style="float:left;width: 55%;margin-left: 10px;">
		<div class="box span12" style="display:none">
			<div class="box-header" data-original-title="">
				<h2>
					<i class="icon-<?php echo $grid_icon?>"></i>
					<span class="break"></span>
					Дії
				</h2>
					<span style="float: right;">
									<a class="btn btn-info" href="#"><i class="icon-edit icon-white"></i></a>
									<a class="btn btn-danger" href="#"><i class="icon-trash icon-white"></i></a>
					</span>
			</div>
			<div class="box-content">
				<form class="form-horizontal form_edit" action="/" method="post">
					<fieldset>
					
					<?php foreach($langs as $k=>$lang):?>
					<div class="control-group">
					<label class="control-label" for="focusedInput">Назва <?php echo $lang?></label>
					<div class="controls">
						<input id="_name_<?php echo $k?>" name="name_<?php echo $k?>"class="input-xlarge focused" id="focusedInput" type="text" value="">
					</div>
					</div>
					<div class="control-group">
					<label class="control-label" for="focusedInput">SEO Назвa <?php echo $lang?></label>
					<div class="controls">
						<input id="_seo_name_<?php echo $k?>"name="seo_name_<?php echo $k?>"class="input-xlarge focused" id="focusedInput" type="text" value="">
					</div>
					</div>
					<?php endforeach;?>
					<input type="hidden" name="id" id="_id" />

					<div class="control-group">
						<label class="control-label" >Батьківська категорія</label>
						<div class="controls">
							<select name="parent_id" id="_parent_id" >
								<option value="">Головна</option>
							  	<?php foreach($courses as  $id => $course):?>
							  	
									<option value="<?php echo $id ?>"><?php echo $course?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" >Груповий?</label>
						<div class="controls">
							<select name="group" id="_group" >
								<option value="1">Так</option>
								<option value="0">Hi</option>
							</select>
						</div>
					</div>
					</fieldset>
				</form>
			</div>
		</div>
		
		
	</div>
