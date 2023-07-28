<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Venta;
use App\Persona;
use App\DetalleVenta;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $ventas = Venta::join('personas','ventas.idcliente','=','personas.id')
            ->join('users','ventas.idusuario','=','users.id')
            ->select('ventas.id','ventas.tipo_comprobante','ventas.serie_comprobante',
            'ventas.num_comprobante','ventas.fecha_hora','ventas.impuesto','ventas.total',
            'ventas.estado','personas.nombre','users.usuario')
            ->orderBy('ventas.id', 'desc')->paginate(10);
        }
        else{
            $ventas = Venta::join('personas','ventas.idcliente','=','personas.id')
            ->join('users','ventas.idusuario','=','users.id')
            ->select('ventas.id','ventas.tipo_comprobante','ventas.serie_comprobante',
            'ventas.num_comprobante','ventas.fecha_hora','ventas.impuesto','ventas.total',
            'ventas.estado','personas.nombre','users.usuario')
            ->where('ventas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('ventas.id', 'desc')->paginate(10);
        }
        
        return [
            'pagination' => [
                'total'        => $ventas->total(),
                'current_page' => $ventas->currentPage(),
                'per_page'     => $ventas->perPage(),
                'last_page'    => $ventas->lastPage(),
                'from'         => $ventas->firstItem(),
                'to'           => $ventas->lastItem(),
            ],
            'ventas' => $ventas
        ];
    }
        public function obtenerCabecera(Request $request){
            if (!$request->ajax()) return redirect('/');

            $id = $request->id;
            $venta = Venta::join('personas','ventas.idcliente','=','personas.id')
            ->join('users','ventas.idusuario','=','users.id')
            ->select('ventas.id','ventas.tipo_venta','ventas.placa','ventas.chofer','ventas.tipo_comprobante','ventas.serie_comprobante',
            'ventas.num_comprobante','ventas.fecha_hora','ventas.impuesto','ventas.total',
            'ventas.estado','personas.id as id2','personas.nombre','users.usuario')
            ->where('ventas.id','=',$id)
            ->orderBy('ventas.id', 'desc')->take(1)->get();
            
            return ['venta' => $venta];
        }
    public function obtenerDetalles(Request $request){
        if (!$request->ajax()) return redirect('/');

        $id = $request->id;
        $detalles = DetalleVenta::join('articulos','detalle_ventas.idarticulo','=','articulos.id')
        ->select('detalle_ventas.cantidad','detalle_ventas.idarticulo','detalle_ventas.precio','detalle_ventas.descuento',
        'articulos.nombre as articulo')
        ->where('detalle_ventas.idventa','=',$id)
        ->orderBy('detalle_ventas.id', 'desc')->get();
        
        return ['detalles' => $detalles];
    }

    public function obtenerChofer(Request $request){
        if (!$request->ajax()) return redirect('/');
        $id = $request->id;
        $persona = Persona::find($id);
        return ['persona' => $persona];
    }

    public function store(Request $request)
    {

        // dd($request);
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');
            $venta = new Venta();
            $venta->idcliente = $request->idcliente;
            $venta->idusuario = \Auth::user()->id;
            $venta->tipo_comprobante = $request->tipo_comprobante;
            $venta->serie_comprobante = $request->serie_comprobante;
            $venta->num_comprobante = $request->num_comprobante;
            $venta->fecha_hora = $mytime->addHours(1);
            $venta->impuesto = $request->impuesto;
            $venta->total = $request->total;
            $venta->estado = 'Registrado';
            $venta->placa = $request->placa;
            $venta->chofer = $request->chofer;
            $venta->tipo_venta = $request->tipo_venta;
            $venta->tipo_vehiculo = $request->tipo_vehiculo;
            $venta->save();

            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetalleVenta();
                $detalle->idventa = $venta->id;
                $detalle->idarticulo = $det['idarticulo'];
                $detalle->cantidad = $det['cantidad'];
                $detalle->precio = $det['precio'];
                $detalle->descuento = $det['descuento'];         
                $detalle->save();
            }          

           DB::commit();
           return $venta->id;
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $venta = Venta::findOrFail($request->id);
        $venta->estado = 'Anulado';
        $venta->save();
    }
    public function editar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');


        $content_pack_news = DB::table('detalle_ventas')
        ->where('idventa' , $request->id)->get();

      
        foreach ($content_pack_news as $key => $value) {
        $currentDetail = DetalleVenta::find($value->id);
        $currentDetail->delete();
        }

        $venta = Venta::findOrFail($request->id);
        $venta->total = $request->total;
        $venta->idcliente = $request->idcliente;
        $venta->tipo_venta = $request->tipo_venta;
        $venta->placa = $request->placa;
        $venta->chofer = $request->id_chofer;
        $venta->save();
        foreach($request->data as $ep=>$det)
        {
            $detalle = new DetalleVenta();
            $detalle->idventa = $venta->id;
            $detalle->idarticulo = $det['idarticulo'];
            $detalle->cantidad = $det['cantidad'];
            $detalle->precio = $det['precio'];
            $detalle->descuento = $det['descuento'];         
            $detalle->save();
        }         
    }
}
