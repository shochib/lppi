<!-- Sidebar Menu -->
<nav class="mt-2">
	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

		<?php

		foreach ($datamenu as $key => $obj) {
			$parent = $obj->parent;

			$li = "";
			$icon_detail = "";
			$class = "nav-item";
			$id_menu2 = 0;
			if ($parent == 0) {
				$id_menu = $obj->id;
				$link = $obj->link;

				if (strlen($link) > 0) {
					$link_induk = base_url($link);
				} else {
					$link_induk = "#";
				}

				//tampil menu anak
				foreach ($datamenu as $key2 => $obj2) {
					$parent1 = $obj2->parent;
					if ($parent1 == $id_menu) {

						$id_menu2 = $obj2->id;
						$nama_menu2 = $obj2->nama_menu;
						$link2 = $obj2->link;

						$icon_detail = "<i class=\"right fas fa-angle-left\"></i>";

						$li .= "<li class=\"nav-item\">
							<a href=\"" . base_url() . "$link2\" class=\"nav-link\">
								<i class=\"far fa-circle nav-icon\"></i>
								<p>$nama_menu2</p>
							</a>
						</li>";
					}
				}

				//tampil menu induk
		?>
				<li class="nav-item">
					<a href="<?php echo $link_induk; ?> " class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							<?= $obj->nama_menu; ?>
							<?= $icon_detail; ?>
						</p>
					</a>
					</a>

					<?php

					if ($id_menu2 > 0) {
					?>
						<ul class="nav nav-treeview">
							<?= $li; ?>
						</ul>
					<?php
					} else {
					?>
				</li>
	<?php
					}

					//end data induk
				}
				//end foreach
			}

	?>

	<!--
	<li class="nav-item">
		<a href="pages/widgets.html" class="nav-link">
			<i class="nav-icon fas fa-th"></i>
			<p>
				Widgets
				<span class="right badge badge-danger">New</span>
			</p>
		</a>
	</li>

	<li class="nav-item">
		<a href="#" class="nav-link">
			<i class="nav-icon fas fa-copy"></i>
			<p>
				Layout Options
				<i class="fas fa-angle-left right"></i>
				<span class="badge badge-info right">6</span>
			</p>
		</a>

		<ul class="nav nav-treeview">
			<li class="nav-item">
				<a href="../layout/top-nav.html" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>Top Navigation</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../layout/top-nav-sidebar.html" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>Top Navigation + Sidebar</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../layout/boxed.html" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>Boxed</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../layout/fixed-sidebar.html" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>Fixed Sidebar</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../layout/fixed-sidebar-custom.html" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>Fixed Sidebar <small>+ Custom Area</small></p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../layout/fixed-topnav.html" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>Fixed Navbar</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../layout/fixed-footer.html" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>Fixed Footer</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="../layout/collapsed-sidebar.html" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>Collapsed Sidebar</p>
				</a>
			</li>
		</ul>
	</li>
	-->


	</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>