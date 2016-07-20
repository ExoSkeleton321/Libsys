			<?php if($profile['tipoId'] == 1): ?>
				<!-- start: Main Menu -->
				<div id="sidebar-left" class="span2">
					<div class="nav-collapse sidebar-nav">
						<ul class="nav nav-tabs nav-stacked main-menu">
							<li>
								<a href="index.php"><i class="icon-home"></i><span class="hidden-tablet"> Inicio</span></a>
								<div class="tut">
									<div class="arrow-left"></div>
									Aqui podras ver el menu de todas las secciones del sistema que tiene acceso.
									<a href="#" class="next1" style="float: right;">Siguiente</a>
								</div>
							</li>
							
							<li class="divider"><span>Interno</span></li>	
							<li>
								<a href="usuarios"><i class="icon-group"></i><span class="hidden-tablet"> Usuarios</span></a>
								<div class="tut2">
									<div class="arrow-left"></div>
									Aqui podras ver y administrar todos los usuarios del sistema.
									<a href="#" class="next2" style="float: right;">Siguiente</a>
								</div>
							</li>
							<li>
								<a href="clientes"><i class="icon-user"></i><span class="hidden-tablet"> Clientes</span></a>
								<div class="tut3">
									<div class="arrow-left"></div>
									Aqui podras ver y administrar todos los clientes del sistema.
									<a href="#" class="next3" style="float: right;">Siguiente</a>
								</div>
							</li>
							<li>
								<a href="libros"><i class="icon-book"></i><span class="hidden-tablet"> Libros</span></a>
								<div class="tut4">
									<div class="arrow-left"></div>
									Aqui podras ver y administrar todos los libros del sistema.
									<a href="#" class="next4" style="float: right;">Siguiente</a>
								</div>
							</li>
							
							<li class="divider"><span>Externo</span></li>
							<li>
								<a href="ventas"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Ventas</span></a>
								<div class="tut5">
									<div class="arrow-left"></div>
									Aqui podras ver graficas de todas las ventas asi como filtrar por fechas.
									<a href="#" class="next5" style="float: right;">Siguiente</a>
								</div>
							</li>
							<li>
								<a href="pedidos"><i class="icon-eye-open"></i><span class="hidden-tablet"> Pedidos De Clientes</span></a>
								<div class="tut6">
									<div class="arrow-left"></div>
									Aqui podras ver y administrar todos los pedidos del sistema.
									<a href="#" class="next6" style="float: right;">Siguiente</a>
								</div>
							</li>
							<!--<li><a href="editoriales"><i class="icon-star"></i><span class="hidden-tablet"> Editoriales</span></a></li>-->
							<li>
								<a href="proveedores"><i class="icon-barcode"></i><span class="hidden-tablet"> Proveedores</span></a>
								<div class="tut7">
									<div class="arrow-left"></div>
									Aqui podras ver y administrar todos los proveedores del sistema.
									<a href="#" class="next7" style="float: right;">Finalizar</a>
								</div>
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
							<li>
								<a href="index.php"><i class="icon-home"></i><span class="hidden-tablet"> Inicio</span></a>
								<div class="tutVen">
									<div class="arrow-left"></div>
									Aqui podras ver el menu de todas las secciones del sistema que tiene acceso.
									<a href="#" class="nextVen" style="float: right;">Siguiente</a>
								</div>
							</li>
							
							<li>
								<a href="libros?buscar"><i class="icon-book"></i><span class="hidden-tablet"> Buscar Libro</span></a>
								<div class="tutVen2">
									<div class="arrow-left"></div>
									Aqui podras buscar todos los libros del sistema.
									<a href="#" class="nextVen2" style="float: right;">Siguiente</a>
								</div>
							</li>	
							<li>
								<a href="ventas?realizar"><i class="icon-shopping-cart"></i><span class="hidden-tablet"> Realizar Venta</span></a>
								<div class="tutVen3">
									<div class="arrow-left"></div>
									Aqui podras realizar una venta.
									<a href="#" class="nextVen3" style="float: right;">Siguiente</a>
								</div>
							</li>
							<li>
								<a href="pedidos?realizar"><i class="icon-barcode"></i><span class="hidden-tablet"> Realizar Pedido</span></a>
								<div class="tutVen4">
									<div class="arrow-left"></div>
									Aqui podras realizar un pedido.
									<a href="#" class="nextVen4" style="float: right;">Siguiente</a>
								</div>
							</li>
							<li>
								<a href="clientes"><i class="icon-user"></i><span class="hidden-tablet"> Clientes</span></a>
								<div class="tutVen5">
									<div class="arrow-left"></div>
									Aqui podras buscar todos los clientes en el sistema.
									<a href="#" class="nextVen5" style="float: right;">Siguiente</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!-- end: Main Menu -->
			<?php endif; ?>