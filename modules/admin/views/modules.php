<div class="span2 main-menu-span">
	<div class="nav-collapse sidebar-nav" >
		<ul class="nav nav-tabs nav-stacked main-menu">
		<?php foreach($modules as $module):?>
			<li>
				<a href="/admin/<?php echo $module->class?>">
					<i class="icon-white <?php echo $module->icon;?>">
					</i>
					<span class="hidden-tablet">
						<?php echo $module->name;?>
					</span>
				</a>
			</li>
		<?php endforeach;?>
		</ul>
	</div>
</div>