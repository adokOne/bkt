<form data-auto-controller="AdminGridController" action="" method="post">
<input type="hidden" value="<?php echo $order ?>" name="order" />
<input type="hidden" value="<?php echo $offset ?>" name="offset" id="offset"/>
<input type="hidden" value="<?php echo $field ?>" name="field" id="field"/>
<input type="hidden" value="<?php echo $where ?>" name="where" id="where"/>
<div>
	<div class="row-fluid sortable ui-sortable" style="width: 97%;">
		<div class="box span12">
			<div class="box-header" data-original-title="">
				<h2>
					<i class="icon-<?php echo $grid_icon?>"></i>
					<span class="break"></span>
					<?php echo $grid_title?>
				</h2>
			</div>
			<div class="box-content">
				<div class="dataTables_wrapper" role="grid">
					<table class="table table-striped  bootstrap-datatable  dataTable">
					<thead>
						<tr role="row">
						<?php foreach ($columns as $col):?>
							<th data-type="order" data-value="name" style="cursor:pointer" class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 255px;" aria-sort="ascending" >
							<?php echo $col?>
							</th>
					    <?php endforeach;?>
							<th  role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 223px;" >
							Дії
							</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data as $row): ?>
							<tr>
							<?php foreach (array_values((array)$row) as $r):?>
								<td class="center">
								<?php echo $r?>
								</td>
								<?php endforeach;?>
								<td data-auto-controller="<?php echo $_type; ?>_action_controller" class="center">
									<a class="btn btn-success" href="#"><i class="icon-zoom-in icon-white"></i></a>
									<a class="btn btn-info" href="#"><i class="icon-edit icon-white"></i></a>
									<a class="btn btn-danger" href="#"><i class="icon-trash icon-white"></i></a>
								</td>
							</tr>
						<?php endforeach;?>
					</tbody>
					</table>
					<?php echo  $pagination->render()?>
					<div class="row-fluid">
						<div class="span12">
							<div class="dataTables_info" id="DataTables_Table_0_info">
								Всього <?php echo $total?> 
							</div>
						</div><div class="span12 center">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>