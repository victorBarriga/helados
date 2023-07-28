<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="fa fa-cart-arrow-down"></i> SECRETARIA</a>
                    </li>
                    <li class="nav-title">
                        --------------------------------
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i> INVENTARIO</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=101" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i>  Gestion de Categorias</a>
                            </li>
                            <li @click="menu=100" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-basket-loaded"></i> Gestion de Insumos</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> COMPRAS</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=102" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Gestion de Compras</a>
                            </li>
                            <li @click="menu=103" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>  Proveedores</a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>