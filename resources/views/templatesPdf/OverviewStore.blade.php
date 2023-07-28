<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .btn-kuper{
        background: red;
        width: 350px;
        height: 10px;
        font-weight: 700;
    }
    td{
        text-align: center;
    }
    .fechas {

    }
    .nuevo{
        text-align: left
    }

    th {
        text-align: start;
    }
   .table-bordered {
         border: 1px solid;
        }

</style>
<body>


    <img style="width: 150px" src="https://img.freepik.com/premium-vector/director-studio-movie-video-cinema-film-production-logo-design-vector-icon-illustration_106546-1291.jpg?w=2000" alt="">
    <div class="nuevo">
        <h1>REPORTE DE PRODUCCIONES</h1>
    </div>

<br>

<?php
 $total = 0;
?>


    <table  class="table-bordered" style="width: 100%;">
        <tr class="table-bordered" style="background: rgb(127, 255, 212)">
          <th class="table-bordered">#</th>
          <th class="table-bordered">Id Produccion</th>
          <th class="table-bordered">Nombre Formula</th>
          <th class="table-bordered">Encargado de Producción</th>
          <th class="table-bordered">Hora de Producción</th>
          <th class="table-bordered">Fecha</th>

        </tr class="table-bordered">
        @foreach($valor['ventas'] as $team)
        <tr class="table-bordered">
            <th class="table-bordered"  scope="row">{{ $loop->index+1}}</th>
            <td class="table-bordered">{{ $team->nombre}}</td>
            <td class="table-bordered">{{ $team->tipo_comprobante }}</td>
            <td class="table-bordered">{{ $team->num_comprobante }}</td>
            <td class="table-bordered">{{ $team->fecha_hora }}</td>
            <td class="table-bordered">{{ $team->total}}</td>

        </tr> 
             <?php $total =  $team->total + $total ?>
             @endforeach
      </table>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quos beatae amet eaque consequatur officia! Magni, suscipit. Id ea voluptatem maxime doloremque. Velit magnam neque asperiores iure, reiciendis ipsa dolorem.</p>
<br>
<br>

    
</div>

</body>
</html>