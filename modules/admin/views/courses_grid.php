
<form data-auto-controller="AdminGridController" action="" method="post">
<input type="hidden" value="<?php echo $order ?>" name="order" />
<input type="hidden" value="<?php echo $offset ?>" name="offset" id="offset"/>
<div>
	<div class="row-fluid sortable ui-sortable"  data-auto-controller="CoursesEditController">
		<div class="box span12" style="width: 40%;">
			<div class="box-header" data-original-title="" style="padding-bottom: 15px;">
				<h2>
					<i class="icon-<?php echo $grid_icon?>"></i>
					<span class="break"></span>
					<?php echo $grid_title?>

				</h2>
			<a href="#" style="float:right" class="btn btn-inverse">Додати новий</a>
			</div>
			<div class="box-content">
				<div class="listTree" data-role="grid">
					
<?php
global $str;
$str = "";
function render($data){
	global $str;
	$str .= "<ul style='padding-left:20px' class='dashboard-list'>";
 	foreach($data as $k =>$row):
 		$str .= "<li>";
 		
 		$str .= "<a class='course' href='#_".$row["id"]."'>";

 		$str .= $row["name"];
 		$str .= "</a>";
 		if((int)$row["group"] == 1){
 			$str .= "<i style='float: right;'  class='icon-user' ></i>";
 			$str .= "<i style='float: right;' class='icon-user' ></i>";
 			$str .= "<i style='float: right;' class='icon-user' ></i>";
 		}
		if(isset($row["children"]))
			render($row["children"]);
 		$str .= "</li>";
 	endforeach;
 	$str .= "</ul>";
	
}

render($data);
echo $str;

?>

					<div class="row-fluid">
						<div class="span12">
							<div class="dataTables_info" id="DataTables_Table_0_info">
								
							</div>
						</div><div class="span12 center">
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
</form>	
	<div class="row-fluid" style="float:left;width: 55%;margin-left: 10px;">
		<div class="box span12" style="display:none">
			<div class="box-header" data-original-title="" style="min-height:80px">
				<h2>
					<i class="icon-<?php echo $grid_icon?>"></i>
					<span class="break"></span>
					Дії
				</h2>
					<span style="float: right;">
									<a class="btn btn-info" href="#">Зберегти<i class="icon-edit icon-white"></i></a>
									<a class="btn btn-danger" href="#">Видалити<i class="icon-trash icon-white"></i></a>
									<a class="btn btn-warning" href="#">
										Редагувати План
										<i class="icon-calendar icon-white"></i>
									</a>
									<a class="btn btn-inverse groups" href="#">
										Редагувати групи
										<i class="icon-calendar icon-white groups"></i>
									</a>
									<a class="btn btn-success image" id="btn_upload" href="#">
										Картинка
										<i class="icon-calendar image icon-white"></i>
									</a>
<a class="get_text" id="ацуаукаку" href="#">
										Текстове поле
										<i class="icon-calendar icon-white"></i>
									</a>

									<a class="pidgotovka" id="pidgotovka" href="#">
										Підгтовока
										<i class="icon-link icon-white pidgotovka"></i>
									</a>
					</span>
			</div>
			<div class="box-content">
			<div class="b_photo" style="border: 1px solid red;margin: 50px auto;width: 200px;height: 200px;">
				<img id="_src" src="" width="200" height="200">
				<a class="btn btn-link" href="#" style="margin: 20px;">
										Редагувати Опис
					<i class="icon-calendar icon-white"></i>
				</a>
			</div>
				<form class="form-horizontal form_edit" action="/" method="post">
					<fieldset>



					<div class="control-group">
						<label class="control-label" for="focusedInput">SEO</label>
						<input id="_image_name" name="image_name"   type="hidden" value="">
						<div class="controls">
							<input id="_seo_name" name="seo_name"class="input-xlarge focused" id="focusedInput" type="text" value="">
						</div>
					</div>


					<div class="control-group">
						<label class="control-label" for="focusedInput">IMG ALT</label>
						<div class="controls">
							<input id="_img_alt" name="img_alt"class="input-xlarge focused" id="focusedInput" type="text" value="">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="focusedInput">IMG TITLE</label>
						<div class="controls">
							<input id="_img_title" name="img_title"class="input-xlarge focused" id="focusedInput" type="text" value="">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="focusedInput">Тривалість курсу</label>
						<div class="controls">
							<input id="_l_count" name="l_count"class="input-xlarge focused" id="focusedInput" type="text" value="">
						</div>
					</div>



					<div class="control-group">
						<label class="control-label" for="focusedInput">Вартість індивідуального</label>
						<div class="controls">
							<input id="_individual_price" name="individual_price"class="input-xlarge focused" id="focusedInput" type="text" value="">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput">Вартість індивідуального(зі знижкою)</label>
						<div class="controls">
							<input id="_sale_price" name="sale_price"class="input-xlarge focused" id="focusedInput" type="text" value="">
						</div>
					</div>





					<?php foreach($langs as $k=>$lang):?>
					<div class="control-group">
					<label class="control-label" for="focusedInput">Назва <?php echo $lang?></label>
					<div class="controls">
						<input id="_name_<?php echo $k?>" name="name_<?php echo $k?>"class="input-xlarge focused" id="focusedInput" type="text" value="">
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
						<label class="control-label" >Є презентація</label>
						<div class="controls">
							<select name="has_presentation" id="_has_presentation" >
								<option value="0">Ні</option>
								<option value="1">Так</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" >Завантаження презентації</label>
						<div class="controls">
							<a href="#" class="btn btn-success" id="present_button"><a>
						</div>
					</div>


					</fieldset>
				</form>
			</div>
		</div>
		
		
	</div>