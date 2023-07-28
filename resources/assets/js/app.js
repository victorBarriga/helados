
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('categoria', require('./components/Categoria.vue'));
Vue.component('almacen', require('./components/Almacen.vue'));
Vue.component('producto', require('./components/Producto.vue'));
Vue.component('articulo', require('./components/Articulo.vue'));
Vue.component('insumo', require('./components/Insumo.vue'));
Vue.component('cronograma', require('./components/Cronograma.vue'));
Vue.component('costos', require('./components/Costos.vue'));
Vue.component('procesando', require('./components/Procesando.vue'));
Vue.component('activo', require('./components/Activo.vue'));
Vue.component('cliente', require('./components/Cliente.vue'));
Vue.component('proveedor', require('./components/Proveedor.vue'));
Vue.component('inventario', require('./components/Inventario.vue'));
Vue.component('rol', require('./components/Rol.vue'));
Vue.component('tipoinventario', require('./components/TipoInventario.vue'));
Vue.component('user', require('./components/User.vue'));
Vue.component('ingreso', require('./components/Ingreso.vue'));  
Vue.component('compras', require('./components/Compras.vue'));  
Vue.component('venta', require('./components/Venta.vue'));  
Vue.component('reporte', require('./components/reportsStore.vue'));
Vue.component('reporte2', require('./components/reporteEstadisticas.vue'));
Vue.component('reportpurcharse', require('./components/reportsPurcharse.vue'));


const app = new Vue({
    el: '#app',
    data :{
        menu : 0
    }
});
