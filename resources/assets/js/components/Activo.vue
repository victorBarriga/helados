<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Activos
                        <button type="button" @click="abrirModal('articulo','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombres">Nombres</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarArticulo(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarArticulo(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <button type="submit" @click="listarArticulo(1,'default','limit')" class="btn btn-warning"><i class="fa fa-warning"></i> Filtrar - Pocos</button>                        
                                    <button type="submit" @click="listarArticulo(1,'','')" class="btn btn-success"><i class="fa fa-trash"></i> Borrar Filtro</button>                        
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Id</th>
                                    <th>Nombres</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>cantidad</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="articulo in arrayActivos" :key="articulo.id_activoss">
                                    <td>
                                        <button type="button" @click="abrirModal('articulo','actualizar',articulo)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="articulo.estado">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarArticulo(articulo.id_activos)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarArticulo(articulo.id_activos)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="articulo.id_activoss"></td>
                                    <td v-text="articulo.nombres"></td>
                                    <td v-text="articulo.cantidad"></td>
                                    <td v-text="articulo.precio"></td>
                                    <td>
                                        <div v-if=" articulo.cantidad < 6 ">
                                            <span class="badge badge-warning">{{articulo.cantidad }} <i class="fa fa-warning"></i></span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-success">{{articulo.cantidad}}</span>
                                        </div>
                                    </td>
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
                 
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombres</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombres" class="form-control" placeholder="Nombres de artículo">                                        
                                    </div>
                                </div>
                               <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Cantidad </label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="cantidad" class="form-control" placeholder="">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Precio </label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="precio" class="form-control" placeholder="">                                        
                                    </div>
                                </div>
                         
                                <!-- <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9"> -->
                                        <input type="hidden" v-model="descripcion" class="form-control" placeholder="Ingrese descripción" value="">
                                    <!-- </div>
                                </div> -->
                                <div v-show="errorArticulo" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjArticulo" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarArticulo()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarArticulo()">Actualizar</button>
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
    import VueBarcode from 'vue-barcode';
    export default {
        data (){
            return {
                articulo_id: 0,
                id_activos : 0,
                nombres_categoria : '',
                codigo : '',
                nombres : '',
                precio : 0,
                cantidad : 0,
                descripcion : '',
                arrayActivos : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorArticulo : 0,
                errorMostrarMsjArticulo : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombres',
                buscar : '',
                arrayCategoria :[]
            }
        },
        components: {
        'barcode': VueBarcode
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
            listarArticulo (page,buscar,criterio){
                let me=this;
                var url= '/activo';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayActivos = respuesta.activos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            // selectCategoria(){
            //     let me=this;
            //     var url= '/categoria/selectCategoria';
            //     axios.get(url).then(function (response) {
            //         var respuesta= response.data;
            //         me.arrayCategoria = respuesta.categorias;
            //     })
            //     .catch(function (error) {
            //         console.log(error);
            //     });
            // },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarArticulo(page,buscar,criterio);
            },
            registrarArticulo(){
        
                if (this.validarArticulo()){
                    return;
                }
       
                let me = this;
                axios.post('/activo/registrar',{
                    'nombres': this.nombres,
                    'cantidad': this.cantidad,
                    'precio': this.precio,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarArticulo(1,'','nombres');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarArticulo(){
               if (this.validarArticulo()){
                    return;
                }
                
                let me = this;

                axios.put('/activo/actualizar',{
                    'id_activos': this.id_activos,
                    'nombres': this.nombres,
                    'cantidad': this.cantidad,
                    'precio': this.precio,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarArticulo(1,'','nombres');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarArticulo(id_activos){
               swal({
                title: 'Esta seguro de desactivar este Activo?',
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

                    axios.put('/activo/desactivar',{
                        'id_activos': id_activos
                    }).then(function (response) {
                        me.listarArticulo(1,'','nombres');
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
            activarArticulo(id_activos){
               swal({
                title: 'Esta seguro de activar este Activo?',
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

                    axios.put('/activo/activar',{
                        'id_activos': id_activos
                    }).then(function (response) {
                        me.listarArticulo(1,'','nombres');
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
            validarArticulo(){
                this.errorArticulo=0;
                this.errorMostrarMsjArticulo =[];

                
                if (!this.nombres) this.errorMostrarMsjArticulo.push("El nombres del Activo no puede estar vacío.");
                if (!this.cantidad) this.errorMostrarMsjArticulo.push("El cantidad del Activo debe ser un número y no puede estar vacío.");
                if (!this.precio) this.errorMostrarMsjArticulo.push("El precio del Activo debe ser un número y no puede estar vacío.");

                if (this.errorMostrarMsjArticulo.length) this.errorArticulo = 1;

                return this.errorArticulo;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.id_activos= 0;
                this.nombres_categoria = '';
                this.codigo = '';
                this.nombres = '';
                this.precio = 0;
                this.cantidad = 0;
                this.descripcion = '';
		        this.errorArticulo=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "articulo":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Activo';
                                this.id_activos=0;
                                this.nombres_categoria='';
                                this.codigo='';
                                this.nombres= '';
                                this.precio=0;
                                this.cantidad=0;
                                this.descripcion = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Activo';
                                this.tipoAccion=2;
                                this.articulo_id=data['id'];
                                this.id_activos=data['id_activos'];
                                this.codigo=data['codigo'];
                                this.nombres = data['nombres'];
                                this.cantidad=data['cantidad'];
                                this.precio=data['precio'];
                                this.descripcion= data['descripcion'];
                                break;
                            }
                        }
                    }
                }
                // this.selectCategoria();
            }
        },
        mounted() {
            this.listarArticulo(1,this.buscar,this.criterio);
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
