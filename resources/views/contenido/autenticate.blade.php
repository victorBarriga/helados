    @extends('principal')
    @section('contenido')


    @if ($data)
            @if($data == 1)
                <template v-if="menu==0">
                    <h1>Escritorio</h1>
                </template>

                <template v-if="menu==109">
                    <activo></activo>
                </template>

                <template v-if="menu==200">
                    <tipoinventario></tipoinventario>
                </template>

                <template v-if="menu==300">
                    <almacen></almacen>
                </template>

                <template v-if="menu==400">
                    <proveedor></proveedor>
                </template>

                <template v-if="menu==500">
                    <inventario></inventario>
                </template>

                <template v-if="menu==600">
                    <compras></compras>
                </template>

                <template v-if="menu==700">
                    <insumo></insumo>
                </template>

                <template v-if="menu==800">
                    <producto></producto>
                </template>

                <template v-if="menu==900">
                    <costos></costos>
                </template>

                <template v-if="menu==901">
                    <cronograma></cronograma>
                </template>

                <template v-if="menu==113">
                    <procesando></procesando>
                    
                </template>
                <template v-if="menu==114">
                    <procesando></procesando>
                    
                </template>

                <template v-if="menu==11">
                    <h1>Ayuda</h1>
                </template>

                <template v-if="menu==12">
                    <h1>Acerca de</h1>
                </template>

            @elseif ($data == 2)
                    <template v-if="menu==5">
                        <procesando></procesando>
                    </template>

                    <template v-if="menu==6">
                        <procesando></procesando>
                    </template>

                    <template v-if="menu==10">
                        <procesando></procesando>
                    </template>

                    <template v-if="menu==11">
                        <h1>Ayuda</h1>
                    </template>

                    <template v-if="menu==12">
                        <h1>Acerca de</h1>
                    </template>
                     
            @elseif ($data == 3)
                    <template v-if="menu==1">
                        <procesando></procesando>
                    </template>

                    <template v-if="menu==2">
                        <procesando></procesando>
                    </template>

                    <template v-if="menu==3">
                        <procesando></procesando>
                    </template>

                    <template v-if="menu==4">
                        <procesando></procesando>
                    </template>

                     <template v-if="menu==9">
                        <procesando></procesando>
                    </template>

                    <template v-if="menu==11">
                        <h1>Ayuda</h1>
                    </template>

                    <template v-if="menu==12">
                        <h1>Acerca de</h1>
                    </template>
            @elseif ($data == 4)
                    <template v-if="menu==100">
                        <procesando></procesando>
                    </template>
                    
                    <template v-if="menu==101">
                        <procesando></procesando>
                    </template>

                    <template v-if="menu==102">
                        <procesando></procesando>
                    </template>

                    <template v-if="menu==103">
                        <procesando></procesando>
                    </template>
                    <template v-if="menu==11">
                        <h1>Ayuda</h1>
                    </template>

                    <template v-if="menu==12">
                        <h1>Acerca de</h1>
                    </template>

            @else    

            @endif
                 
    @endif
                
    @endsection