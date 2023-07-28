<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                   <img src="https://learn.microsoft.com/en-us/power-pages/admin/media/maintenance-mode/maintenance-page.png">
                </div>
                <!-- Fin ejemplo de tabla Listado -->
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
