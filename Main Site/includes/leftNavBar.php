			<?php if($profile['tipoId'] == 1): ?>
				<!-- start: Main Menu -->
				<div id="sidebar-left" class="span2">
					<div class="nav-collapse sidebar-nav">
						<ul class="nav nav-tabs nav-stacked main-menu">
							<li><a href="index.php"><i class="icon-home"></i><span class="hidden-tablet"> Inicio</span></a></li>	
							<li><a href="usuarios"><i class="icon-user"></i><span class="hidden-tablet"> Usuarios</span></a></li>
							<li><a href="ventas"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Ventas</span></a></li>
							<li><a href="pedidos"><i class="icon-eye-open"></i><span class="hidden-tablet"> Pedidos De Clientes</span></a></li>
							<li><a href="libros"><i class="icon-book"></i><span class="hidden-tablet"> Libros</span></a></li>
							<li><a href="editoriales"><i class="icon-star"></i><span class="hidden-tablet"> Editoriales</span></a></li>
							<li><a href="proveedores"><i class="icon-barcode"></i><span class="hidden-tablet"> Proveedores</span></a></li>
							<li><a href="clientes"><i class="icon-user"></i><span class="hidden-tablet"> Clientes</span></a></li>
							<li>
								<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Dropdown</span><span class="label label-important"> 3 </span></a>
								<ul>
									<li><a class="submenu" href="submenu.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 1</span></a></li>
									<li><a class="submenu" href="submenu2.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 2</span></a></li>
									<li><a class="submenu" href="submenu3.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 3</span></a></li>
								</ul>	
							</li>
						</ul>
					</div>
				</div>
				<!-- end: Main Menu -->
			<?php else: ?>
				<!-- start: Main Menu -->
				<div id="sidebar-left" class="span2">
					<div class="nav-collapse sidebar-nav">
						<ul class="nav nav-tabs nav-stacked main-menu">
							<li><a href="index.php"><i class="icon-home"></i><span class="hidden-tablet"> Inicio</span></a></li>
							<li><a href="libro/buscar"><i class="icon-book"></i><span class="hidden-tablet"> Buscar Libro</span></a></li>	
							<li><a href="venta/realizar"><i class="icon-shopping-cart"></i><span class="hidden-tablet"> Realizar Venta</span></a></li>
							<li><a href="pedidos"><i class="icon-barcode"></i><span class="hidden-tablet"> Pedidos De Clientes</span></a></li>
							<li><a href="cliente/buscar"><i class="icon-user"></i><span class="hidden-tablet"> Consultar Cliente</span></a></li>
						</ul>
					</div>
				</div>
				<!-- end: Main Menu -->
			<?php endif; ?>