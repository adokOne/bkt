<form data-auto-controller="AdminGridController" action="" method="post">

<div>
	<div class="row-fluid sortable ui-sortable" style="width: 97%;">
		<div class="box span12">
			<div class="box-header" data-original-title="">
				<h2>

					<span class="break"></span>
				</h2>
			</div>
			<div class="box-content">
				<div class="dataTables_wrapper" role="grid">
					<table class="table table-striped  bootstrap-datatable  dataTable">
					<thead>
						<tr role="row">
							<th data-type="order" data-value="name" style="cursor:pointer" class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 255px;" aria-sort="ascending" >
							Комментар
							</th>
							<th  role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 223px;" >
							Дії
							</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($comments as $row): ?>
							<tr>
								<td class="center">
								<?php echo $row->text?>
								</td>
								<td data-id="<?php echo $row->id?>" data-auto-controller="blog_com_action_controller" class="center">
									<a class="btn btn-danger" href="#"><i class="icon-trash icon-white"></i></a>
								</td>
							</tr>
						<?php endforeach;?>
					</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
</form>