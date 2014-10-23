<?php $lang= Kohana::lang("all");?>

<div id = "online_reg" style="margin: 0 auto;width: 300px;">


		<form id="form1" action="/online" method="post" data-auto-controller="OnlineRegController">	
		
			<fieldset>
				<p class="first">
					<label for="name"><?php echo $lang["fio"]?></label>
					<input required="required" type="text"  name="name" id="name" size="30">
				</p>
				<p>
					<label for="email">E-mail</label>
					<input required="required" type="email"  name="email" id="email" size="30">
				</p>
				<p>
					<label for="web"><?php echo $lang["phone"]?></label>
					<input required="required"  type="text"  name="phone" id="web" size="30">
				</p>		
				<p>
					<label for="web"><?php echo $lang["course"]?></label>
				<select  style="width: 260px;" required="required"  name="course_id" size="1">
					<?php foreach ($courses as $id=>$course):?>
					<option value="<?php echo $course->id?>" ><?php echo $course->where("id_lang",$cur_lang)->courses_langs->current()->name ?></option>
					<?php endforeach;?>
				</select>
				</p>	

				<p>
					<label for="web"><?php echo $lang["sale_code"]?></label>
					<input  type="text"  name="disc_code" id="web_" size="30">
				</p>	

			</fieldset>				

			<p class="submit"><button type="submit"><?php echo $lang['zap_na_kurs']?></button></p>		
						
		</form>





</div>