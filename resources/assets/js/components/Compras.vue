<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header"  >
                        <i class="fa fa-align-justify" v-if="listado != 3"></i> Gestion de compras
                        <button type="button" @click="mostrarDetalle()" class="btn btn-secondary" v-if="listado != 3">
                            <i class="icon-plus" v-if="listado != 3"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <!-- Listado-->
                    <template v-if="listado == 1">
                    <div class="card-body">
                        <!-- <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="tipo_comprobante">Tipo Comprobante</option>
                                      <option value="num_comprobante">Número Comprobante</option>
                                      <option value="fecha_hora">Fecha-Hora</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarIngreso(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarIngreso(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div> -->
                       
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                          
                                        <th>Id</th>
                                        <th>Proveedor</th>
                                        <th>Fecha Hora</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="ingreso in arrayCompras" :key="ingreso.id">
                                        <td>
                                            <button type="button" @click="overView(ingreso.id)" class="btn btn-success btn-sm">
                                            <i class="icon-eye"></i>
                                            </button> 
                                                <button type="button" class="btn btn-danger btn-sm" @click="desactivarIngreso(ingreso.id)">
                                                    <i class="icon-trash"></i>
                                                </button>
                                            
                                                <button type="button" class="btn btn-warning btn-sm" @click="editarIngreso(ingreso.id)">
                                                    <i class="icon-pencil"></i>
                                                </button>
                                           
                                        </td>

                                        <td v-text="ingreso.id_compra"></td>
                                        <td v-text="ingreso.nombre"></td>
                                        <td v-text="ingreso.fecha"></td>
                                        <td v-text="ingreso.monto_total"></td>
                                        <!-- <td v-text="ingreso.impuesto"></td> -->
                                        <td>
                                            <div v-if="ingreso.estado">
                                                <span class="badge badge-success">Activo</span>
                                            </div>
                                            <div v-else>
                                                <span class="badge badge-danger">Desactivado</span>
                                            </div>
                                            
                                        </td>
                                    </tr>                                
                                </tbody>
                            </table>
                        </div>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    </template>
                    <!--Fin Listado-->
                    <!-- Detalle-->
                    <template v-if="listado == 2">
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Proveedor(*)</label>
                                    <v-select
                                        :on-search="selectProveedor"
                                        label="nombre"
                                        :options="arrayProveedor"
                                         placeholder="Buscar Proveedores..."
                                        :onChange="getDatosProveedor"                                        
                                    >

                                    </v-select>
                                </div>
                            </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Referebcua</label>
                                  <input type="text" class="form-control" v-model="referencia">
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                                <label for="">Impuesto(*)</label>
                                <input type="text" class="form-control" v-model="impuesto">
                            </div> -->
                            <input type="hidden" class="form-control" v-model="impuesto">
                          
                            <input type="hidden" class="form-control" v-model="serie_comprobante" placeholder="000x">
                            <!-- <div class="form-group">
                                    <div class="col-md-4">
                                    <label>Serie Comprobante</label>
                                </div>
                            </div> -->
                            <input type="hidden" class="form-control" v-model="num_comprobante" placeholder="000xx">
                            <!-- <div class="form-group">
                                <div class="col-md-4">
                                <label>Número Comprobante(*)</label>
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <div v-show="errorIngreso" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjIngreso" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- PRUEBA ------------------------------- INICIO-->
                        <!-- Button trigger modal -->


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Seleccione uno o varios insumos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <select class="form-control col-md-3" v-model="criterioA">
                                        <option value="nombre">Nombre</option>
                                        <option value="descripcion">Descripción</option>
                                        <option value="codigo">Código</option>
                                        </select>
                                        <input type="text" v-model="buscarA" @keyup.enter="listarArticulo(buscarA,criterioA)" class="form-control" placeholder="Texto a buscar">
                                        <button type="submit" @click="listarArticulo(buscarA,criterioA)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table  table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Categoría</th>
                                            <th>Precio Venta</th>
                                            <th>Stock</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="articulo in arrayInsumo" :key="articulo.id">
                                            <td>
                                                 <div v-if="articulo.check">
                                                    <button type="button" @click="agregarDetalleModal(articulo)" class="btn btn-success btn-sm">
                                                      <i class="icon-check"></i>
                                                     </button>
                                                </div>
                                                 <div v-else>
                                                    <button type="button" @click="agregarDetalleModal(articulo)" class="btn btn-info btn-sm">
                                                        <i class="icon-check"></i>
                                                      </button>
                                                 </div>
                                                
                                            </td>
                                            
                                          
                                            <td v-text="articulo.codigo"></td>
                                            <td v-text="articulo.nombre"></td>
                                            <td v-text="articulo.nombre_categoria"></td>
                                            <td v-text="articulo.precio"></td>
                                            <td v-text="articulo.cantidad"></td>
                                            <td>
                                                <div v-if="articulo.estado">
                                                    <span class="badge badge-success">Activo</span>
                                                </div>
                                                <div v-else>
                                                    <span class="badge badge-danger">Desactivado</span>
                                                </div>
                                                
                                            </td>
                                        </tr>                                
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                
                            </div>
                            </div>
                        </div>
                        </div>
                        <!-- PRUEBA -------------------------------FIN-->
                        <div class="form-group row border">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Insumo <span style="color:red;" v-show="idarticulo==0">(*Seleccione)</span></label>
                                    <div class="form-inline">
                                        <input type="text" class="form-control" v-model="codigo" @keyup.enter="buscarArticulo()" placeholder="Ingrese artículo">
                                        <!-- <button @click="abrirModal()" class="btn btn-primary">...</button> -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">...</button>
                                        <input type="text" readonly class="form-control" v-model="articulo">
                                    </div>                                    
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Precio <span style="color:red;" v-show="precio==0">(*Ingrese)</span></label>
                                    <input type="number" value="0" step="any" class="form-control" v-model="precio">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cantidad <span style="color:red;" v-show="cantidad==0">(*Ingrese)</span></label>
                                    <input type="number" value="0" class="form-control" v-model="cantidad">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button @click="agregarDetalle()" class="btn btn-success form-control btnagregar"><i class="icon-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Insumo</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                            <td>
                                                <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                                    <i class="icon-close"></i>
                                                </button>
                                            </td>
                                            <td v-text="detalle.articulo">
                                            </td>
                                            <td>
                                                <input v-model="detalle.precio" type="number" value="3" class="form-control">
                                            </td>
                                       
                                            <td>
                                                <span style="color:red;" v-show="detalle.cantidad>detalle.cantidad">Cantidad: {{detalle.cantidad}}</span>
                                                <input v-model="detalle.cantidad" type="number" class="form-control">
                                            </td>
                                        
                                            <td>
                                                {{ parseFloat(detalle.precio*detalle.cantidad).toLocaleString("en-US")}}
                                            </td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4"><strong>Total Parcial:</strong></td>                                    
                                            <td>Bs {{ parseFloat(totalParcial=(total-totalImpuesto)).toLocaleString("en-US")}}</td>                                         
                                        </tr>
                                        <!-- <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Impuesto:</strong></td>
                                            <td>Bs {{totalImpuesto=((total*impuesto)/(1+impuesto)).toFixed(2)}}</td>
                                        </tr> -->
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Neto:</strong></td>
                                            <td>Bs {{ parseFloat(total=calcularTotal).toLocaleString("en-US")}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="5">
                                                NO hay artículos agregados
                                            </td>
                                        </tr>
                                    </tbody>                                    
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                <button type="button" class="btn btn-primary" @click="registrarIngreso()">Registrar Compra</button>
                            </div>
                        </div>
                    </div>
                    </template>
                    <!-- Fin Detalle-->

                    <!-- INICIO -DETALLE -->
                    <template v-if="listado == 3">
                        <div class="card-body">
                            <div class="form-group row border" style="padding-top: 10px;">
                                <br>
                                <div class="col-md-1" style="height: 30px;">
                                    <div class="form-group">
                                        <label for="">Proveedor:</label>
                                    </div>
                                </div>
                                <div class="col-md-8" style="height: 30px;">
                                    <div class="form-group">
                                        <label for=""> <p v-text="nombre"></p></label>
                                    </div>
                                </div>
                                <div class="col-md-1" style="height: 30px;">
                                    <div class="form-group">
                                        <label for="">Fecha: </label>
                        
                                    </div>
                                </div>
                                <div class="col-md-2" style="height: 30px;">
                                    <label for=""> <p v-text="fecha"></p></label>
                                </div>
                                <div class="col-md-2" style="height: 30px;">
                                    <div class="form-group">
                                        <label>Tipo Comprobante : </label>
                                      
                                    </div>
                                </div>
                                <div class="col-md-3" style="height: 30px;">
                                    <div class="form-group">
                                        <label> <p v-text="tipo_comprobante"></p></label>
                                       
                                    </div>
                                </div>

                                <div class="col-md-2" style="height: 30px;">
                                    <div class="form-group">
                                        <label>Serie Comprobante:</label>
                                 
                                    </div>
                                </div>
                                <div class="col-md-2" style="height: 30px;">
                                    <div class="form-group">
                                        <label><p v-text="serie_comprobante"></p></label>
                                        
                                    </div>
                                </div>
                                <div class="col-md-2" style="height: 30px;">
                                    <div class="form-group">
                                        <label>Núm. Comprobante: </label>
                                    </div>
                                </div>
                                <div class="col-md-1" style="height: 30px;">
                                    <div class="form-group">
                                        <label><p v-text="num_comprobante"></p></label>
                                       
                                    </div>
                                </div>
                                <div class="col-md-2" style="height: 30px;">
                                    <div class="form-group">
                                        <label>Usuario Resp.: </label>
                                    </div>
                                </div>
                                <div class="col-md-3" style="height: 30px;">
                                    <div class="form-group">
                                        <label><p v-text="usuario"></p></label>
                                       
                                    </div>
                                </div>
                                <div  class="col-md-2" style="height: 30px;">
                                    <div class="form-group">
                                        <label>Tipo Compra: </label>
                                    </div>
                                </div>
                                <div class="col-md-2" style="height: 30px;">
                                    <div class="form-group">
                                        <label><p v-text="tipo_compra"></p></label>
                                       
                                    </div>
                                </div>
                             
                                <div class="col-md-2" style="height: 30px;">
                                </div>
                                <hr>
                                    <div v-if="placa_compra !== null"  class="col-md-2" style="height: 30px;">
                                        <div class="form-group">
                                            <label>Chofer Resp.: </label>
                                        </div>
                                    </div>
                                    <div v-if="placa_compra !== null"  class="col-md-3" style="height: 30px;">
                                        <div class="form-group">
                                            <label><p v-text="nombre_chofer"></p></label>
                                           
                                        </div>
                                    </div>
                                    <div  v-if="placa_compra !== null"  class="col-md-2" style="height: 30px;">
                                        <div class="form-group">
                                            <label>Placa: </label>
                                        </div>
                                    </div>
                                    <div v-if="placa_compra !== null"  class="col-md-2" style="height: 30px;">
                                        <div class="form-group">
                                            <label><p v-text="placa_compra"></p></label>
                                           
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                               


                            </div>  
                           
                            <div class="form-group row border">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Artículo</th>
                                                <!-- <th>Descripción</th> -->
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody v-if="arrayDetalle.length">
                                            <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                                                <td v-text="detalle.nombre">
                                                </td>
                                                <!-- <td v-text="detalle.descripcion">
                                                </td> -->
                                                <td v-text="detalle.precio">
                                                </td>
                                                <td v-text="detalle.cantidad">
                                                </td>
                                                
                                                <td>
                                                    {{ parseFloat(detalle.precio*detalle.cantidad).toLocaleString("en-US")}}
                                                </td>
                                            </tr>
                                            <tr style="background-color: #CEECF5;">
                                                <td colspan="3" align="right"><strong>Total Parcial:</strong></td>
                                                <td>Bs {{parseFloat(totalParcial=(total-totalImpuesto)).toLocaleString("en-US")}}</td>
                                            </tr>
                                            <!-- <tr style="background-color: #CEECF5;">
                                                <td colspan="4" align="right"><strong>Total Impuesto:</strong></td>
                                                <td>Bs {{totalImpuesto=((total*impuesto)).toFixed(2)}}</td>
                                            </tr> -->
                                            <tr style="background-color: #CEECF5;">
                                                <td colspan="3" align="right"><strong>Total Neto:</strong></td>
                                                <td>Bs {{ parseFloat(total).toLocaleString("en-US")}} </td>
                                            </tr>
                                        </tbody>
                                        <tbody v-else>
                                            <tr>
                                                <td colspan="5">
                                                    NO hay artículos agregados
                                                </td>
                                            </tr>
                                        </tbody>                                    
                                    </table>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                    <a v-bind:href="`${linkPdfTermic}`" target="_blank" class="btn btn-success">Imprimir Reporte Termica</a>
                                    <a v-bind:href="`${linkPdf}`" target="_blank" class="btn btn-primary">Imprimir Reporte A4</a>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- FIN  -  DETALLE -->
                    <!-- INICIO EDITAR-->
                          <!-- Detalle-->
                          <template v-if="listado == 4">
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Proveedor(*)</label>
                                    <v-select
                                        v-model="tes"
                                        :on-search="selectProveedor"
                                        label="nombre"
                                        :options="arrayProveedor"
                                     
                                        placeholder="Buscar Proveedores..."
                                        :onChange="getDatosProveedor"                                        
                                    >

                                    </v-select>
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                                <label for="">Impuesto(*)</label>
                                <input type="text" class="form-control" v-model="impuesto">
                            </div> -->
                            <input type="hidden" class="form-control" v-model="impuesto">
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tipo Comprobante(*)</label>
                                    <select class="form-control" v-model="tipo_comprobante">
                                        <option value="0">Seleccione</option>
                                        <option value="BOLETA">Boleta</option>
                                        <option value="FACTURA">Factura</option>
                                        <option value="TICKET">Ticket</option>
                                    </select>
                                </div>
                            </div> -->
                            <input type="hidden" class="form-control" v-model="serie_comprobante" placeholder="000x">
                            <!-- <div class="form-group">
                                    <div class="col-md-4">
                                    <label>Serie Comprobante</label>
                                </div>
                            </div> -->
                            <input type="hidden" class="form-control" v-model="num_comprobante" placeholder="000xx">
                            <!-- <div class="form-group">
                                <div class="col-md-4">
                                <label>Número Comprobante(*)</label>
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <div v-show="errorIngreso" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjIngreso" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- PRUEBA ------------------------------- INICIO-->
                        <!-- Button trigger modal -->


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Seleccione uno o varios Insumos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <select class="form-control col-md-3" v-model="criterioA">
                                        <option value="nombre">Nombre</option>
                                        <option value="descripcion">Descripción</option>
                                        <option value="codigo">Código</option>
                                        </select>
                                        <input type="text" v-model="buscarA" @keyup.enter="listarArticulo(buscarA,criterioA)" class="form-control" placeholder="Texto a buscar">
                                        <button type="submit" @click="listarArticulo(buscarA,criterioA)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table  table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Categoría</th>
                                            <th>Precio Venta</th>
                                            <th>Stock</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="articulo in arrayInsumo" :key="articulo.id">
                                            <td>
                                                 <div v-if="articulo.check">
                                                    <button type="button" @click="agregarDetalleModal(articulo)" class="btn btn-success btn-sm">
                                                      <i class="icon-check"></i>
                                                     </button>
                                                </div>
                                                 <div v-else>
                                                    <button type="button" @click="agregarDetalleModal(articulo)" class="btn btn-info btn-sm">
                                                        <i class="icon-check"></i>
                                                      </button>
                                                 </div>
                                                
                                            </td>
                                            
                                          
                                            <td v-text="articulo.codigo"></td>
                                            <td v-text="articulo.nombre"></td>
                                            <td v-text="articulo.nombre_categoria"></td>
                                            <td v-text="articulo.precio_venta"></td>
                                            <td v-text="articulo.stock"></td>
                                            <td>
                                                <div v-if="articulo.condicion">
                                                    <span class="badge badge-success">Activo</span>
                                                </div>
                                                <div v-else>
                                                    <span class="badge badge-danger">Desactivado</span>
                                                </div>
                                                
                                            </td>
                                        </tr>                                
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                
                            </div>
                            </div>
                        </div>
                        </div>
                        <!-- PRUEBA -------------------------------FIN-->
                        <div class="form-group row border">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Insumo <span style="color:red;" v-show="idarticulo==0">(*Seleccione)</span></label>
                                    <div class="form-inline">
                                        <input type="text" class="form-control" v-model="codigo" @keyup.enter="buscarArticulo()" placeholder="Ingrese artículo">
                                        <!-- <button @click="abrirModal()" class="btn btn-primary">...</button> -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">...</button>
                                        <input type="text" readonly class="form-control" v-model="articulo">
                                    </div>                                    
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Precio <span style="color:red;" v-show="precio==0">(*Ingrese)</span></label>
                                    <input type="number" value="0" step="any" class="form-control" v-model="precio">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cantidad <span style="color:red;" v-show="cantidad==0">(*Ingrese)</span></label>
                                    <input type="number" value="0" class="form-control" v-model="cantidad">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button @click="agregarDetalle()" class="btn btn-success form-control btnagregar"><i class="icon-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Insumo</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                            <td>
                                                <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                                    <i class="icon-close"></i>
                                                </button>
                                            </td>
                                            <td v-text="detalle.nombre">
                                            </td>
                                            <td>
                                                <input v-model="detalle.precio" type="number" value="3" class="form-control">
                                            </td>
                                       
                                            <td>
                                                <span style="color:red;" v-show="detalle.cantidad>detalle.stock">Stock: {{detalle.stock}}</span>
                                                <input v-model="detalle.cantidad" type="number" class="form-control">
                                            </td>
                                        
                                            <td>
                                                {{ parseFloat(detalle.precio*detalle.cantidad).toLocaleString("en-US")}}
                                            </td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4"><strong>Total Parcial:</strong></td>                                    
                                            <td>Bs {{ parseFloat(totalParcial=(total-totalImpuesto)).toLocaleString("en-US")}}</td>                                         
                                        </tr>
                                        <!-- <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Impuesto:</strong></td>
                                            <td>Bs {{totalImpuesto=((total*impuesto)/(1+impuesto)).toFixed(2)}}</td>
                                        </tr> -->
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Neto:</strong></td>
                                            <td>Bs {{ parseFloat(total=calcularTotal).toLocaleString("en-US")}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="5">
                                                NO hay Insumo agregados
                                            </td>
                                        </tr>
                                    </tbody>                                    
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                <button type="button" class="btn btn-warning" @click="EditarIngresoSave()">Editar Compra</button>
                            </div>
                        </div>
                    </div>
                    </template>
                    <!-- Fin Detalle-->
                    <!-- FIN EDITAR-->
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del i agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                       
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <select class="form-control col-md-3" v-model="criterioA">
                                        <option value="nombre">Nombre</option>
                                        <option value="descripcion">Descripción</option>
                                        <option value="codigo">Código</option>
                                        </select>
                                        <input type="text" v-model="buscarA" @keyup.enter="listarArticulo(buscarA,criterioA)" class="form-control" placeholder="Texto a buscar">
                                        <button type="submit" @click="listarArticulo(buscarA,criterioA)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table  table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Categoría</th>
                                            <th>Precio Venta</th>
                                            <th>Stock</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="articulo in arrayInsumo" :key="articulo.id">
                                            <td>
                                                <button type="button" @click="agregarDetalleModal(articulo)" class="btn btn-success btn-sm">
                                                <i class="icon-check"></i>
                                                </button>
                                            </td>
                                            <td v-text="articulo.codigo"></td>
                                            <td v-text="articulo.nombre"></td>
                                            <td v-text="articulo.nombre_categoria"></td>
                                            <td v-text="articulo.precio_venta"></td>
                                            <td v-text="articulo.stock"></td>
                                            <td>
                                                <div v-if="articulo.condicion">
                                                    <span class="badge badge-success">Activo</span>
                                                </div>
                                                <div v-else>
                                                    <span class="badge badge-danger">Desactivado</span>
                                                </div>
                                                
                                            </td>
                                        </tr>                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPersona()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
    import vSelect from 'vue-select';
    export default {
        data (){
            return {
                ingreso_id: 0,
                id_proveedor:0,
                id_proveedor2:'',
                nombre : '',
                referencia : '',
                fecha : '',
                tes:'',
                usuario : '',
                tipo_comprobante : 'BOLETA',
                tipo_compra : 'NORMAL',
                placa_compra : '',
                nombre_chofer : '',
                serie_comprobante : '',
                num_comprobante : '',
                impuesto: 0.0,
                total:0.0,
                totalImpuesto: 0.0,
                totalParcial: "0.0",
                arrayCompras : [],
                arrayProveedor: [],
                arrayDetalle : [],
                listado:1,
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorIngreso : 0,
                linkPdf : "",
                linkPdfTermic : "",
                errorMostrarMsjIngreso : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 10,
                criterio : 'num_comprobante',
                buscar : '',
                criterioA:'nombre',
                buscarA: '',
                arrayInsumo: [],
                idarticulo: 0,
                codigo: '',
                articulo: '',
                precio: 0,
                cantidad:0
                
            }
        },
        components: {
            vSelect
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },
            calcularTotal: function(){
                var resultado=0.0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    resultado=resultado+(this.arrayDetalle[i].precio*this.arrayDetalle[i].cantidad)
                }
                const numero = 11223.48; 
                // Español
                console.log(numero.toLocaleString("es-ES"));
                // Inglés Americano
                console.log(numero.toLocaleString("en-US"));
                // Árabe
                console.log(numero.toLocaleString("ar-EG"));
                return resultado;
            }
        },
        methods : {
            listarIngreso (page,buscar,criterio){
                let me=this;
                me.listado=1;
                debugger
                var url= '/compra?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCompras = respuesta.compras.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectProveedor(search,loading){
                let me=this;
                loading(true)

                var url= '/proveedor/selectProveedor?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q: search
                    me.arrayProveedor=respuesta.proveedores.data;
                    loading(false)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            editarIngreso(id){
                let me=this;
                me.listado=4;

    
                var url= '/compra/overview?id=' + id;
                
                axios.get(url).then(function (response) {
                  
                   var respuesta= response.data;
               
                   var ingresos = respuesta.ingresos;
                   var currentPurcharse = respuesta.ingresos.data[0];
                    
                    me.id = currentPurcharse.id;
                    me.tes = currentPurcharse.nombre;
                    me.id_proveedor = currentPurcharse.id2;
                    me.id_proveedor2 = currentPurcharse.id2;
                    me.arrayDetalle = respuesta.detalle.data;
                    me.nombre = currentPurcharse.nombre;
                    me.tipo_comprobante = "BOLETA";
                    me.impuesto = currentPurcharse.impuesto; 
                    me.fecha = currentPurcharse.fecha_hora;
                    me.serie_comprobante = currentPurcharse.serie_comprobante;
                    me.num_comprobante = currentPurcharse.num_comprobante;
                    me.usuario = currentPurcharse.usuario;
                    me.totalParcial = currentPurcharse.total.toLocaleString("en-US");
                    me.impuesto = currentPurcharse.impuesto;
                    me.total = currentPurcharse.total.toLocaleString("en-US");
                    me.linkPdf="report-compra-unit?id="+currentPurcharse.id;
                    me.linkPdfTermic="report-compra-unit-termic?id="+currentPurcharse.id;
      
                })
                .catch(function (error) {
                    console.log(error);
                });

                me.id_proveedor=1;
                me.tipo_comprobante='BOLETA';
                me.serie_comprobante='';
                me.num_comprobante='';
                me.impuesto=0.00;
                me.total=0.0;
                me.idarticulo=0;
                me.articulo='';
                me.cantidad=0;
                me.precio=0;
                me.arrayDetalle=[];
            },
            getDatosProveedor(val1){
                let me = this;
                me.loading = true;
                me.id_proveedor = val1.id_proveedor;
            },
            buscarArticulo(){
                let me=this;
                var url= '/articulo/buscarArticulo?filtro=' + me.codigo;

                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayInsumo = respuesta.articulos;

                    if (me.arrayInsumo.length>0){
                        me.articulo=me.arrayInsumo[0]['nombre'];
                        me.idarticulo=me.arrayInsumo[0]['id'];
                    }
                    else{
                        me.articulo='No existe insumo';
                        me.idarticulo=0;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarIngreso(page,buscar,criterio);
            },
            encuentra(id){
                var sw=0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    if(this.arrayDetalle[i].idarticulo==id){
                        sw=true;
                    }
                }
                return sw;
            },
            eliminarDetalle(index){
                let me = this;
                me.arrayDetalle.splice(index, 1);
            },
            agregarDetalle(){
                let me=this;
                if(me.idarticulo==0 || me.cantidad==0 || me.precio==0){
                }
                else{
                    if(me.encuentra(me.idarticulo)){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Ese insumo ya se encuentra agregado!',
                            })
                    }
                    else{
                       me.arrayDetalle.push({
                            idarticulo: me.idarticulo,
                            articulo: me.articulo,
                            cantidad: me.cantidad,
                            precio: me.precio
                        });
                        me.codigo="";
                        me.idarticulo=0;
                        me.articulo="";
                        me.cantidad=0;
                        me.precio=0; 
                    }
                    
                }

                

            },
            agregarDetalleModal(data =[]){
                let me=this;
            
                if(me.encuentra(data['id'])){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Ese insumo ya se encuentra agregado!',
                            })
                    }
                    else{
                       me.arrayDetalle.push({
                            idarticulo: data['id_insumo'],
                            articulo: data['nombre'],
                            cantidad: 1,
                            precio: data['precio']
                        }); 
    
                    for(var i=0;i<this.arrayInsumo.length;i++){
                        if(this.arrayInsumo[i].id_insumo==data['id_insumo']){
                                this.arrayInsumo[i].check = true; 
                           }
                        }
                    }
            },

            listarArticulo (buscar,criterio){  
                let me=this;
                var url= '/insumo/listarInsumo?buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayInsumo = respuesta.insumos.data;
                    for(var i2 = 0;i2<me.arrayDetalle.length; i2++){
                            let currentDetail = me.arrayDetalle[i2];
                                
                            for(var i=0;i<me.arrayInsumo.length;i++){
                                if(me.arrayInsumo[i].id==currentDetail.id_insumo){
                                        me.arrayInsumo[i].check = true; 
                                  }
                                }
                             }
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            registrarIngreso(){
                if (this.validarIngreso()){
                    return;
                }
                
                let me = this;
                me.listado=2;
                axios.post('/compra/registrar',{
                    'id_proveedor': this.id_proveedor,            
                    'total' : this.total,
                    'referencia' : this.referencia,
                    'data': this.arrayDetalle,
                }).then(function (response) {
                    me.listado=1;
                    me.listarIngreso(1,'','num_comprobante');
                    me.id_proveedor=0;
                    me.tipo_comprobante='BOLETA';
                    me.serie_comprobante='';
                    me.num_comprobante='';
                    me.impuesto=0.00;
                    me.total=0.0;
                    me.idarticulo=0;
                    me.articulo='';
                    me.cantidad=0;
                    me.referencia='';
                    me.referencia='';
                    me.precio=0;
                    me.arrayDetalle=[];
                    // location.reload();

                }).catch(function (error) {
                    console.log(error);
                });
            },
            EditarIngresoSave(){
           
                if (this.validarIngreso()){
                    return;
                }
                
                let me = this;
                let pro = me.id_proveedor2;
                let pro2 = this.id_proveedor2;
                // me.listado=2;
                axios.put('/compra/editar',{
                    'id_proveedor':pro2||10,
                    'tipo_comprobante': this.tipo_comprobante,
                    'serie_comprobante' : this.serie_comprobante,
                    'num_comprobante' : this.num_comprobante,
                    'impuesto' : this.impuesto,
                    'total' : this.total,
                    'id': this.id,
                    'data': this.arrayDetalle

                }).then(function (response) {
                
                    // me.listado=1;
                    // me.listarIngreso(1,'','num_comprobante');
                    // me.id_proveedor=0;
                    // me.tipo_comprobante='BOLETA';
                    // me.serie_comprobante='';
                    // me.num_comprobante='';
                    // me.impuesto=0.00;
                    // me.total=0.0;
                    // me.idarticulo=0;
                    // me.articulo='';
                    // me.cantidad=0;
                    // me.precio=0;
                    // me.arrayDetalle=[];
                    location.reload();

                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarIngreso(){
               
                this.errorIngreso=0;
                this.errorMostrarMsjIngreso =[];

                if (this.id_proveedor==0) this.errorMostrarMsjIngreso.push("Seleccione un Proveedor");
                if (this.arrayDetalle.length<=0) this.errorMostrarMsjIngreso.push("Ingrese detalles");
                if (this.errorMostrarMsjIngreso.length) this.errorIngreso = 1;
                return this.errorIngreso;
            },
            mostrarDetalle(){
                let me=this;
                me.listado=2;

                me.id_proveedor=0;
                me.tipo_comprobante='BOLETA';
                me.serie_comprobante='';
                me.num_comprobante='';
                me.impuesto=0.00;
                me.total=0.0;
                me.idarticulo=0;
                me.articulo='';
                me.cantidad=0;
                me.precio=0;
                me.arrayDetalle=[];
            },
            overView(id){
                let me=this;
                me.listado=3;

    
                var url= '/compra/overview?id=' + id;
                
                axios.get(url).then(function (response) {
                   var respuesta= response.data;
                   var ingresos = respuesta.ingresos;
                   var currentPurcharse = respuesta.ingresos.data[0];
                    me.arrayDetalle = respuesta.detalle.data;
                    me.nombre = currentPurcharse.nombre;
                    me.tipo_comprobante = "BOLETA";
                    me.tipo_compra = currentPurcharse.tipo_compra;
                    me.nombre_chofer = currentPurcharse.nombre_chofer;
                    me.placa_compra = currentPurcharse.placa_compra;
                    me.impuesto = currentPurcharse.impuesto; 
                    me.fecha = currentPurcharse.fecha_hora;
                    me.serie_comprobante = currentPurcharse.serie_comprobante;
                    me.num_comprobante = currentPurcharse.num_comprobante;
                    me.usuario = currentPurcharse.usuario;
                    me.totalParcial = currentPurcharse.total.toLocaleString("en-US");
                    me.impuesto = currentPurcharse.impuesto;
                    me.total = currentPurcharse.total.toLocaleString("en-US");
                    me.linkPdf="report-compra-unit?id="+currentPurcharse.id;
                    me.linkPdfTermic="report-compra-unit-termic?id="+currentPurcharse.id;
      
                })
                .catch(function (error) {
                    console.log(error);
                });

                me.id_proveedor=1;
                me.tipo_comprobante='BOLETA';
                me.serie_comprobante='';
                me.num_comprobante='';
                me.impuesto=0.00;
                me.total=0.0;
                me.idarticulo=0;
                me.articulo='';
                me.cantidad=0;
                me.precio=0;
                me.arrayDetalle=[];
            },
            ocultarDetalle(){
                this.listado=1;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
            },
            abrirModal(){               
                this.arrayInsumo=[];
                this.modal = 1;
                this.tituloModal = 'Seleccione uno o varios insumos';
            },
              abrirModal2(){               
                this.arrayInsumo=[];
                this.modal = 2;
                this.tituloModal = 'TEST';
            },
            desactivarUsuario(id){
               swal({
                title: 'Esta seguro de desactivar este usuario?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/user/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            activarUsuario(id){
               swal({
                title: 'Esta seguro de activar este usuario?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/user/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
        },
        mounted() {
            this.listarIngreso(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
        height: 100% !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
    @media (min-width: 600px) {
        .btnagregar {
            margin-top: 2rem;
        }
    }

</style>
