<div class="just_uploaded_pic" id="ju_<?php echo $picture->u_id ?>" >
<img src="/img/pictures/<?php echo $picture->event_id . '/' . $picture->u_id ?>/s.jpg" /><br>
<input type="text" name="name" value="<?php echo $picture->name ?>" class="picname_input" onblur="save_name(<?php echo $picture->id ?>, this.value)"/>
<input type="checkbox" id="<?php echo $picture->u_id ?>"><label for="<?php echo $picture->u_id ?>">Я есть на етом фото</label> 
<button onclick="return false;" >Отметить пользователей</button>
<a href="javascript: void(0);" onclick="return dropImage('<?php echo $picture->u_id ?>')" >Удалить</a>
</div>



