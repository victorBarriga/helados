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
                        <i class="fa fa-align-justify"></i> Costos
                        <button type="button" @click="abrirModal('costos','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarCostos(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarCostos(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                            <!-- <div class="col-md-3"></div> -->
                            <!-- <div class="col-md-3">
                                <div class="input-group">
                                    <button type="submit" @click="listarCostos(1,'default','limit')" class="btn btn-warning"><i class="fa fa-warning"></i> Filtrar - Pocos</button>                        
                                    <button type="submit" @click="listarCostos(1,'','')" class="btn btn-success"><i class="fa fa-trash"></i> Borrar Filtro</button>                        
                                </div>
                            </div> -->
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Id Producto</th>
                                    <th>Nombre</th>
                                    <th>Costos Operativos</th>
                                    <th>Costos Brutos</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="insumo in arrayInsumos" :key="insumo.id_insumo">
                                    <td>
                                        <button type="button" @click="abrirModal('insumo','actualizar',insumo)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="insumo.estado">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarInsumo(insumo.id_insumo)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarArticulo(insumo.id_insumo)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="insumo.id_producto"></td>
                                    <td v-text="insumo.nombre"></td>
                                    <td v-text="insumo.costos_operativos"></td>
                                    <td v-text="insumo.costos_brutos"></td>
                                    <td v-text="insumo.fecha"></td>
                                    <td>
                                        <div v-if="insumo.estado">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Producto</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="id_producto">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="producto in arrayProducto" :key="producto.id_producto" :value="producto.id_producto" v-text="producto.nombre"></option>
                                        </select>                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Costos Operativos</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="costos_operativos" class="form-control" placeholder="Nombre de artículo">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Costos Brutos</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="costos_brutos" class="form-control" placeholder="Medida">                                        
                                    </div>
                                </div>
                               
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
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCostos()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarCostos()">Actualizar</button>
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
                id_producto : 0,
                id_almacen : 0,
                nombre_categoria : '',
                codigo : '',
                nombre : '',
                medida : '',
                precio : 0,
                costos_operativos : 0,
                costos_brutos : 0,
                cantidad : 0,
                descripcion : '',
                arrayInsumos : [],
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
                criterio : 'nombre',
                buscar : '',
                arrayCategoria :[],
                arrayProducto :[],
                arrayAlmacen :[]
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
            listarCostos (page,buscar,criterio){
             
                let me=this;
                var url= '/costos?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    debugger
                    var respuesta= response.data;
                    me.arrayInsumos = respuesta.costos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectCategoria(){
                let me=this;
                var url= '/categoria/selectCategoria';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayCategoria = respuesta.categorias;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectProducto(){
                let me=this;
                var url= '/producto/selectCategoria';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    debugger
                    me.arrayProducto = respuesta.productos.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectAlmacen(){
                let me=this;
                var url= '/almacen/selectAlmacen';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayAlmacen = respuesta.almacen;
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
                me.listarCostos(page,buscar,criterio);
            },
            registrarCostos(){
                if (this.validarInsumo()){
                    return;
                }
                
                let me = this;
                axios.post('/costos/registrar',{
                    'id_producto': this.id_producto,
                    'costos_operativos': this.costos_operativos,
                    'costos_brutos': this.costos_brutos,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCostos(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarCostos(){
               if (this.validarInsumo()){
                    return;
                }
                
                let me = this;

                axios.put('/costos/actualizar',{
                    'id_categoria': this.id_categoria,
                    'id_almacen': this.id_almacen,
                    'codigo': this.codigo,
                    'nombre': this.nombre,
                    'cantidad': this.cantidad,
                    'precio': this.precio,
                    'medida': this.medida,
                    'descripcion': this.descripcion,
                    'id_insumo': this.id_insumo
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCostos(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarInsumo(id_insumo){
               swal({
                title: 'Esta seguro de desactivar este Insumo?',
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

                    axios.put('/insumo/desactivar',{
                        'id_insumo': id_insumo
                    }).then(function (response) {
                        me.listarCostos(1,'','nombre');
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
            activarArticulo(id_insumo){
               swal({
                title: 'Esta seguro de activar este Insumo?',
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

                    axios.put('/insumo/activar',{
                        'id_insumo': id_insumo
                    }).then(function (response) {
                        me.listarCostos(1,'','nombre');
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
            validarInsumo(){
                this.errorArticulo=0;
                this.errorMostrarMsjArticulo =[];

                if (this.id_producto==0) this.errorMostrarMsjArticulo.push("Seleccione una categoría.");
                if (!this.costos_brutos) this.errorMostrarMsjArticulo.push("El costo bruto es requerido.");
                if (!this.costos_operativos) this.errorMostrarMsjArticulo.push("El costo operativo es requerido.");


                if (this.errorMostrarMsjArticulo.length) this.errorArticulo = 1;

                return this.errorArticulo;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.id_categoria= 0;
                this.nombre_categoria = '';
                this.codigo = '';
                this.nombre = '';
                this.precio = 0;
                this.cantidad = 0;
                this.descripcion = '';
		        this.errorArticulo=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "costos":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Insumo';
                                this.id_categoria=0;
                                this.nombre_categoria='';
                                this.codigo='';
                                this.nombre= '';
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
                                this.tituloModal='Actualizar Insumo';
                                this.tipoAccion=2;
                                this.id_insumo=data['id_insumo'];
                                this.id_categoria=data['id_categoria'];
                                this.codigo=data['codigo'];
                                this.nombre = data['nombre'];
                                this.cantidad=data['cantidad'];
                                this.precio=data['precio'];
                                this.id_almacen=data['id_almacen'];
                                break;
                            }
                        }
                    }
                }
                this.selectCategoria();
                this.selectAlmacen();
                this.selectProducto();
            }
        },
        mounted() {
            this.listarCostos(1,this.buscar,this.criterio);
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
