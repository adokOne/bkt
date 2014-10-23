<div class="page_edit row-fluid sortable ui-sortable">
				<div class="box span12">
					<div style="height: 30px;" class="box-header" data-original-title="">
						<h2 style="margin-right: 20px;"><i class="icon-edit"></i><span class="break"></span>Акція</h2>
						<?php foreach($langs as $id=>$lang): ?>
							<a href="#" class="btn btn-warning"><?php echo $lang;?></a>
						<?php endforeach;?>
					</div>
					<p id="eedd"></p>
					<div class="box-content">
						<form class="page_save form-horizontal">
						  <fieldset>
						  	<input type="hidden" name="news_id" id="_news_id"/>
						  	
							<div class="control-group _0 _1">
							  <label class="control-label" for="typeahead">Активна</label>
							  <div class="controls">
							  	<select name="active">
							  		<option value="1">TAK</option>
							  		<option value="0">HI</option>
							  	</select>
							  </div>
							</div>	
							
						  	<?php foreach($langs as $id=>$lang):?>
						

						
							<div class="control-group _<?php echo $id?>">
							  <label class="control-label" for="typeahead">ТЕМА <?php echo $lang?></label>
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
						
							<div class="control-group _<?php echo $id?>">
							  <label class="control-label" for="typeahead">SEO назва <?php echo $lang?></label>
							  <div class="controls">
								<input style="width:70%" name="seo_name_<?php echo $id?>" id="_seo_name_<?php echo $id?>" type="text" class="span6 typeahead" id="typeahead"  >
							  </div>
							</div>		
							
							
							<div class="control-group hidden-phone _<?php echo $id?>">
							  <label class="control-label" for="textarea3">Анонс <?php echo $lang?></label>
							  <div class="controls">
								<div class="cleditor" style="width: 70%; height: 100px; ">
									<textarea name="anons_<?php echo $id?>" id="_anons_<?php echo $id?>" class=""  rows="50" style="width: 100%;height: 100px; ">
									<?php if(isset($data["anons_".$id])) echo $data["anons_".$id];?>
									</textarea>
								</div>
							  </div>
							</div>			
					
							<div class="control-group hidden-phone _<?php echo $id?>">
							  <label class="control-label" for="textarea2">Teкст <?php echo $lang?></label>
							  <div class="controls">
								<div class="cleditor" style="width: 70%; height: 500px; ">
									<textarea name="text_<?php echo $id?>" id="_text_<?php echo $id?>" class="cleditor"  style="display: none; width: 1000%;height: 500px; ">
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
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div>