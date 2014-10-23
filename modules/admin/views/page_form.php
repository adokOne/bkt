<div class="page_edit row-fluid sortable ui-sortable">
				<div class="box span12">
					<div style="height: 30px;" class="box-header" data-original-title="">
						<h2 style="margin-right: 20px;"><i class="icon-edit"></i><span class="break"></span>Статична сторінка</h2>
						<?php foreach($langs as $id=>$lang): ?>
							<a href="#" class="btn btn-warning"><?php echo $lang;?></a>
						<?php endforeach;?>
						<a href="#" style="position: fixed;right: 84px;"class="btn btn-inverse">STRONG</a>
						<a href="#" style="position: fixed;right: 84px;"class="btn btn-inverse h2">H2</a>
					</div>
					<div class="box-content">
						<form class="page_save form-horizontal">
						  <fieldset>
						  	<input type="hidden" name="page_id" id="_page_id"/>
						  	
						  	
						  	<?php foreach($langs as $id=>$lang):?>
						  		
							<div class="control-group _<?php echo $id?>">
							  <label class="control-label" for="typeahead">Назва <?php echo $lang?></label>
							  <div class="controls">
								<input style="width:70%" name="name_<?php echo $id?>" id="_name_<?php echo $id?>" type="text" class="span6 typeahead" id="typeahead"  >
							  </div>
							</div>
						
						
						
							<div class="control-group _<?php echo $id?>">
							  <label class="control-label" for="typeahead">Тайтл <?php echo $lang?></label>
							  <div class="controls">
								<input style="width:70%" name="title_<?php echo $id?>" id="_title_<?php echo $id?>" type="text" class="span6 typeahead" id="typeahead"  >
							  </div>
							</div>
						
						
						
							<div class="control-group _<?php echo $id?>">
							  <label class="control-label" for="typeahead">Мета опис <?php echo $lang?></label>
							  <div class="controls">
								<input style="width:70%" name="meta_desc_<?php echo $id?>" id="_meta_desc_<?php echo $id?>" type="text" class="span6 typeahead" id="typeahead"  >
							  </div>
							</div>
						
						
							<div class="control-group _<?php echo $id?>">
							  <label class="control-label" for="typeahead">Ключові слова <?php echo $lang?></label>
							  <div class="controls">
								<input style="width:70%" name="meta_keywords_<?php echo $id?>" id="_meta_keywords_<?php echo $id?>" type="text" class="span6 typeahead" id="typeahead"  >
							  </div>
							</div>
													

							
					
							<div class="control-group hidden-phone _<?php echo $id?>">
							  <label class="control-label" for="textarea2">Teкст <?php echo $lang?></label>
							  <div class="controls">
								<div class="cleditor" style="width: 70%; height: 500px; ">
									<textarea contentEditable="true" name="text_<?php echo $id?>" id="_text_<?php echo $id?>" class="cleditor"  rows="3" style="width: 100%;height: 500px; ">
									<?php if(isset($data["text_".$id])) echo $data["text_".$id];?>
									</textarea>
								</div>
							  </div>
							</div>
							<?php endforeach;?>
							<div class="form-actions">
							  <button type="submit" class="save btn btn-primary">Зберігти</button>
							  <button type="reset" class="btn">Закрити</button>
							</div>
							<input value="<?php echo $c_id ?>" name="course_id" id="_course_id" type="hidden" / >
							<input value="<?php echo isset($seo_name) ? $seo_name  : ""?>" name="seo_name" id="_seo_name" type="hidden" / >
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div>