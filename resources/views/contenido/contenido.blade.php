    @extends('principal')
    @section('contenido')


    {{-- @if (Auth::check())
            @if(Auth::user()->idrol == 1)
                <template v-if="menu==0">
                    <h1>Escritorio</h1>
                </template>

                <template v-if="menu==109">
                    <activo></activo>
                </template>

                <template v-if="menu==101">
                    <categoria></categoria>
                </template>

                <template v-if="menu==100">
                    <articulo></articulo>
                </template>

                <template v-if="menu==110">
                    <ingreso></ingreso>
                </template>

                <template v-if="menu==103">
                    <proveedor></proveedor>
                </template>

                <template v-if="menu==5">
                    <venta></venta>
                </template>

                <template v-if="menu==6">
                    <cliente></cliente>
                </template>

                <template v-if="menu==111">
                    <user></user>
                </template>

                <template v-if="menu==112">
                    <rol></rol>
                </template>

                <template v-if="menu==9">
                    <reportpurcharse></reportpurcharse>
                </template>

                <template v-if="menu==113">
                    <reporte></reporte>
                    
                </template>
                <template v-if="menu==114">
                    <reporte2></reporte2>
                    
                </template>

                <template v-if="menu==11">
                    <h1>Ayuda</h1>
                </template>

                <template v-if="menu==12">
                    <h1>Acerca de</h1>
                </template>

            @elseif (Auth::user()->idrol == 2)
                    <template v-if="menu==5">
                        <venta></venta>
                    </template>

                    <template v-if="menu==6">
                        <cliente></cliente>
                    </template>

                    <template v-if="menu==10">
                        <reporte></reporte>
                    </template>

                    <template v-if="menu==11">
                        <h1>Ayuda</h1>
                    </template>

                    <template v-if="menu==12">
                        <h1>Acerca de</h1>
                    </template>
                     
            @elseif (Auth::user()->idrol == 3)
                    <template v-if="menu==1">
                        <categoria></categoria>
                    </template>

                    <template v-if="menu==2">
                        <articulo></articulo>
                    </template>

                    <template v-if="menu==3">
                        <ingreso></ingreso>
                    </template>

                    <template v-if="menu==4">
                        <proveedor></proveedor>
                    </template>

                     <template v-if="menu==9">
                        <reportpurcharse></reportpurcharse>
                    </template>

                    <template v-if="menu==11">
                        <h1>Ayuda</h1>
                    </template>

                    <template v-if="menu==12">
                        <h1>Acerca de</h1>
                    </template>
            @elseif (Auth::user()->idrol == 4)
                    <template v-if="menu==100">
                        <articulo></articulo>
                    </template>
                    
                    <template v-if="menu==101">
                        <categoria></categoria>
                    </template>

                    <template v-if="menu==102">
                        <ingreso></ingreso>
                    </template>

                    <template v-if="menu==103">
                        <proveedor></proveedor>
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
                 --}}
    @endsection