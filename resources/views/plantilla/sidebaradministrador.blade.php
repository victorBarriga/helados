<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="fa fa-user-circle-o"></i> ADMINISTRADOR</a>
                    </li>
                    <li class="nav-title">
                        --------------------------------------
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Inventario</a>
                        <ul class="nav-dropdown-items" style="margin-left: 10px">
                            <li @click="menu=500" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Gestion - Inventario</a>
                            </li>
                            <li @click="menu=109" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Gestion - Activos</a>
                            </li>
                            <li @click="menu=200" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Tipos de Inventario</a>
                            </li>
                            <li @click="menu=300" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Gestion - Almacen</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Insumos</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=700" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Gestion de Insumos</a>
                            </li>
                            <li @click="menu=101" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Categorias</a>
                            </li>
                          
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Compras</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=600" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i>Gestion Compras</a>
                            </li>
                            <li @click="menu=400" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Proveedores</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i> Producción</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=105" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-basket-loaded"></i> Gestion Producción</a>
                            </li>
                            <li @click="menu=106" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Costos</a>
                            </li>
                            <li @click="menu=107" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Formula</a>
                            </li>
                            <li @click="menu=800" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Productos</a>
                            </li>
                            <li @click="menu=900" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Costos</a>
                            </li>
                            <li @click="menu=901" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Cronograma</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Cronograma</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=104" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user"></i> Gestión de Cronograma</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=111" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user"></i> Usuarios</a>
                            </li>
                            <li @click="menu=112" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Roles</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Almacen</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=115" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Gestion de almacen</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Reportes</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=113" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Gestión de Reportes</a>
                            </li>
                            <li @click="menu=114" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Gestión de estadisticas</a>
                            </li>
                        </ul>
                    </li>
       
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>