<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>

            <template v-if="templateVersion == 1">
   <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Gestion Inventario
                        <button type="button" @click="abrirModal('inventario','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="direccion">direccion</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarInventario(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarInventario(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Usuario</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="inventario in arrayInventario" :key="inventario.id_inventario">
                                    <td>
                                        <button type="button" @click="abrirModal('inventario','actualizar',inventario)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="inventario.estado">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarAlmacen(inventario.id_inventario)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarAlmacen(inventario.id_inventario)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                        <template>
                                            <button type="button" class="btn btn-info btn-sm" @click="GestionarInsumos(inventario.id_inventario)">
                                                <i class="icon-check"></i>Gestionar Insumos
                                            </button>
                                        </template>
                                        <template>
                                            <button type="button" class="btn btn-info btn-sm" @click="GestionarActivos(inventario.id_inventario)">
                                                <i class="icon-check"></i>Gestionar Activos
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="inventario.id_inventario"></td>
                                    <td v-text="inventario.fecha"></td>
                                    <td v-text="inventario.nombre"></td>
                                    <td v-text="inventario.tipo"></td>
                                    <td>
                                        <div v-if="inventario.estado">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
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
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
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
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <template v-if="templateVersion == 1">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Fecha</label>
                                            <div class="col-md-9">
                                                <input type="date" v-model="fecha" class="form-control">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Tipo de inventario</label>
                                            <div class="col-md-9">
                                                <select class="form-control" v-model="id_tipo_inventario">
                                                    <option value="0" disabled>Seleccione</option>
                                                    <option v-for="tipo_inventario in arrayTipoInventario" :key="tipo_inventario.id_tipo_inventario" :value="tipo_inventario.id_tipo_inventario" v-text="tipo_inventario.nombre"></option>
                                                </select>                                        
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Usuario Responsable</label>
                                            <div class="col-md-9">
                                                <select class="form-control" v-model="id_usuario">
                                                    <option value="0" disabled>Seleccione</option>
                                                    <option v-for="usuario in arrayUsuarios" :key="usuario.id_usuario" :value="usuario.id_usuario" v-text="usuario.nombre"></option>
                                                </select>                                        
                                            </div>
                                        </div>
                                        <div v-show="errorCategoria" class="form-group row div-error">
                                            <div class="text-center text-error">
                                                <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error">

                                                </div>
                                            </div>
                                        </div>
                                 </template>
                                 <template v-if="templateVersion == 2">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Fecha</label>
                                            <div class="col-md-9">
                                                <input type="number" v-model="cantidad_inventario" class="form-control">
                                                
                                            </div>
                                        </div>
                                        <div v-show="errorCategoria" class="form-group row div-error">
                                            <div class="text-center text-error">
                                                <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error">

                                                </div>
                                            </div>
                                        </div>
                                 </template>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarInvenatario()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarAlmacen()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            </template>
             <template v-if="templateVersion == 2">
                  <div class="card">
                       <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Código Insumo</th>
                                    <th>Nombre</th>
                                    <th>Cantidad Inventario</th>
                                    <th>cantidad Sistema</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="insumo in arrayInventarioInsumos" :key="insumo.id_insumo">
                                    <td>
                                        <button type="button" @click="abrirModal('inventario_insumo','actualizar',insumo)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td v-text="insumo.codigo"></td>
                                    <td v-text="insumo.nombre"></td>
                                    <td v-text="insumo.cantidad_inventario"></td>
                                    <td v-text="insumo.cantidad_sistema"></td>
                                </tr>                                
                            </tbody>
                        </table>
                        </div>
                     </div>
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
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <template v-if="templateVersion == 1">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Fecha</label>
                                            <div class="col-md-9">
                                                <input type="date" v-model="fecha" class="form-control">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Tipo de inventario</label>
                                            <div class="col-md-9">
                                                <select class="form-control" v-model="id_tipo_inventario">
                                                    <option value="0" disabled>Seleccione</option>
                                                    <option v-for="tipo_inventario in arrayTipoInventario" :key="tipo_inventario.id_tipo_inventario" :value="tipo_inventario.id_tipo_inventario" v-text="tipo_inventario.nombre"></option>
                                                </select>                                        
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Usuario Responsable</label>
                                            <div class="col-md-9">
                                                <select class="form-control" v-model="id_usuario">
                                                    <option value="0" disabled>Seleccione</option>
                                                    <option v-for="usuario in arrayUsuarios" :key="usuario.id_usuario" :value="usuario.id_usuario" v-text="usuario.nombre"></option>
                                                </select>                                        
                                            </div>
                                        </div>
                                        <div v-show="errorCategoria" class="form-group row div-error">
                                            <div class="text-center text-error">
                                                <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error">

                                                </div>
                                            </div>
                                        </div>
                                 </template>
                                 <template v-if="templateVersion == 2">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Cantidad Inventario</label>
                                            <div class="col-md-9">
                                                <input type="number" v-model="cantidad_inventario" class="form-control">
                                                
                                            </div>
                                        </div>
                                        <div v-show="errorCategoria" class="form-group row div-error">
                                            <div class="text-center text-error">
                                                <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error">

                                                </div>
                                            </div>
                                        </div>
                                 </template>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarInvenatario()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarCantidadInventario()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            </template>
            <template v-if="templateVersion == 3">
                  <div class="card">
                       <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
               
                                    <th>Nombre</th>
                                    <th>Cantidad Inventario</th>
                                    <th>cantidad Sistema</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="activo in arrayInventarioActivos" :key="activo.id_activos">
                                    <td>
                                        <button type="button" @click="abrirModal('inventario_activo','actualizar',activo)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                    </td>
          
                                    <td v-text="activo.nombres"></td>
                                    <td v-text="activo.cantidad_inventario"></td>
                                    <td v-text="activo.cantidad_sistema"></td>
                                </tr>                                
                            </tbody>
                        </table>
                        </div>
                     </div>
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
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <template v-if="templateVersion == 1">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Fecha</label>
                                            <div class="col-md-9">
                                                <input type="date" v-model="fecha" class="form-control">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Tipo de inventario</label>
                                            <div class="col-md-9">
                                                <select class="form-control" v-model="id_tipo_inventario">
                                                    <option value="0" disabled>Seleccione</option>
                                                    <option v-for="tipo_inventario in arrayTipoInventario" :key="tipo_inventario.id_tipo_inventario" :value="tipo_inventario.id_tipo_inventario" v-text="tipo_inventario.nombre"></option>
                                                </select>                                        
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Usuario Responsable</label>
                                            <div class="col-md-9">
                                                <select class="form-control" v-model="id_usuario">
                                                    <option value="0" disabled>Seleccione</option>
                                                    <option v-for="usuario in arrayUsuarios" :key="usuario.id_usuario" :value="usuario.id_usuario" v-text="usuario.nombre"></option>
                                                </select>                                        
                                            </div>
                                        </div>
                                        <div v-show="errorCategoria" class="form-group row div-error">
                                            <div class="text-center text-error">
                                                <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error">

                                                </div>
                                            </div>
                                        </div>
                                 </template>
                                 <template v-if="templateVersion == 2">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Cantidad Inventario</label>
                                            <div class="col-md-9">
                                                <input type="number" v-model="cantidad_inventario" class="form-control">
                                                
                                            </div>
                                        </div>
                                        <div v-show="errorCategoria" class="form-group row div-error">
                                            <div class="text-center text-error">
                                                <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error">

                                                </div>
                                            </div>
                                        </div>
                                 </template>
                                      <template v-if="templateVersion == 3">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Cantidad Inventario</label>
                                            <div class="col-md-9">
                                                <input type="number" v-model="cantidad_inventario" class="form-control">
                                                
                                            </div>
                                        </div>
                                        <div v-show="errorCategoria" class="form-group row div-error">
                                            <div class="text-center text-error">
                                                <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error">

                                                </div>
                                            </div>
                                        </div>
                                 </template>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarInvenatario()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarCantidadActivo()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            </template>
         
        </main>
</template>
<script>
    export default {
        data (){
            return {
                id_almacen: 0,
                id_usuario: 0,
                templateVersion: 1,
                id_tipo_inventario: 0,
                direccion : '',
                fecha : '',
                descripcion : '',
                arrayInventario : [],
                arrayTipoInventario : [],
                arrayUsuarios : [],
                arrayInventarioInsumos : [],
                arrayInventarioActivos : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                cantidad_inventario : 0,
                errorCategoria : 0,
                errorMostrarMsjCategoria : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'direccion',
                buscar : ''
            }
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

            }
        },
        methods : {
            listarInventario (page,buscar,criterio){
                let me=this;

                var url= '/inventario';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
        
                    me.arrayInventario = respuesta.inventarios.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarUsuarios (){
                let me=this;
                var url= '/usuario';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayUsuarios = respuesta.usuarios.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            
            listarTipoInventario(){
                let me=this;
                 me.arrayTipoInventario = [
                                            {
                                                id_tipo_inventario:1,
                                                nombre:'Inventario de activos'
                                            },
                                            {
                                                id_tipo_inventario:2,
                                                nombre:'Inventario de insumos'
                                            },
                                          ];
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarInventario(page,buscar,criterio);
            },
            registrarInvenatario(){
                if (this.validarInventario()){
                    return;
                }
                
                let me = this;

                axios.post('/inventario/registrar',{
                    'fecha': this.fecha,
                    'id_usuario': this.id_usuario,
                    'id_tipo_inventario': this.id_tipo_inventario,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarInventario(1,'','direccion');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarAlmacen(){
               if (this.validarInventario()){
                    return;
                }
                let me = this;
                axios.put('/inventario/actualizar',{
                   'fecha': this.fecha,
                    'id_usuario': this.id_usuario,
                    'id_tipo_inventario': this.id_tipo_inventario,
                    'id_inventario': this.id_inventario,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarInventario(1,'','direccion');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            actualizarCantidadInventario(){
               
                let me = this;
                axios.put('/inventario-insumo/actualizar',{
                    'id_inventario': this.id_inventario,
                    'id_insumo': this.id_insumo,
                    'cantidad_inventario': this.cantidad_inventario,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarInventario(1,'','direccion');
                    me.GestionarInsumos();
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
             actualizarCantidadActivo(){
               
                let me = this;
                axios.put('/inventario-activo/actualizar',{
                    'id_inventario': this.id_inventario,
                    'id_activo': this.id_activo,
                    'cantidad_inventario': this.cantidad_inventario,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarInventario(1,'','direccion');
                    me.GestionarInsumos();
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            
            desactivarAlmacen(id_inventario){
               swal({
                title: 'Esta seguro de desactivar esta Inventario?',
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

                    axios.put('/inventario/desactivar',{
                        'id_inventario': id_inventario
                    }).then(function (response) {
                        me.listarInventario(1,'','direccion');
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
            activarAlmacen(id_inventario){
               swal({
                title: 'Esta seguro de activar esta Inventario?',
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

                    axios.put('/inventario/activar',{
                        'id_inventario': id_inventario
                    }).then(function (response) {
                        me.listarInventario(1,'','direccion');
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
            GestionarInsumos(id_inventario){
              let me=this;
              me.templateVersion = 2;

            axios.get('/inventario-insumo/listar?id_inventario='+id_inventario,{
                        'id_inventario': id_inventario
                    }).then(function (response) {
                        debugger
                        me.arrayInventarioInsumos = response.data.inventarios_insumos.data;
                    }).catch(function (error) {
                        console.log(error);
                    });
            },
            GestionarActivos(id_inventario){
              let me=this;
              me.templateVersion = 3;

            axios.get('/inventario-activo/listar?id_inventario='+id_inventario,{
                        'id_inventario': id_inventario
                    }).then(function (response) {
                        debugger
                        me.arrayInventarioActivos = response.data.inventarios_activos.data;
                    }).catch(function (error) {
                        console.log(error);
                    });
            },

            validarInventario(){
                this.errorCategoria=0;
                this.errorMostrarMsjCategoria =[];

                if (!this.id_usuario) this.errorMostrarMsjCategoria.push("El usuario es requerido.");
                if (!this.id_tipo_inventario) this.errorMostrarMsjCategoria.push("El tipo de inventario es requerido.");
                if (!this.fecha) this.errorMostrarMsjCategoria.push("La fecha es requerida.");

                if (this.errorMostrarMsjCategoria.length) this.errorCategoria = 1;

                return this.errorCategoria;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.direccion='';
                this.descripcion='';
            },
            abrirModal(modelo, accion, data = []){
                debugger
                switch(modelo){
                    case "inventario":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar inventario';
                                this.fecha= '';
                                this.id_tipo_inventario = 0;
                                this.id_usuario = 0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                debugger
                                this.modal=1;
                                this.tituloModal='Actualizar inventario';
                                this.tipoAccion=2;
                                this.fecha=data['fecha'];
                                this.id_tipo_inventario = data['id_tipo_inventario'];
                                this.id_usuario= data['id_usuario'];
                                this.id_inventario= data['id_inventario'];
                                break;
                            }
                        }
                        break;
                    }
                    case "inventario_insumo":
                    {
                              this.modal=1;
                                this.tituloModal='Actualizar Cantidad Inventario';
                                this.tipoAccion=2;
                                this.cantidad_inventario=data['cantidad_inventario'];
                                this.id_inventario= data['id_inventario'];
                                this.id_insumo= data['id_insumo'];
                                break;
                    }
                    case "inventario_activo":
                    {
                              this.modal=1;
                                this.tituloModal='Actualizar Cantidad Inventario';
                                this.tipoAccion=2;
                                this.cantidad_inventario=data['cantidad_inventario'];
                                this.id_inventario= data['id_inventario'];
                                this.id_activos= data['id_activos'];
                                break;
                    }
                }
            }
        },
        mounted() {
            this.listarInventario(1,this.buscar,this.criterio);
            this.listarTipoInventario();
            this.listarUsuarios();
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
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
