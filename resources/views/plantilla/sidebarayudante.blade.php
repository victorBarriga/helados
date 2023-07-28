<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="fa fa-truck"></i> AYUDANTE PRODUCCÍON</a>
                    </li>
                    <li class="nav-title">
                        --------------------------------------
                    </li>
                    <!--=======================================================================================  -->
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Cronograma Diario</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=104" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Gestion Cronograma</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Producción</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=105" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Productos</a>
                            </li>
                            <li @click="menu=106" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Costos</a>
                            </li>
                            <li @click="menu=107" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Formula</a>
                            </li>
                        </ul>
                    </li>
                    <!--=======================================================================================  -->
                   
                 
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>