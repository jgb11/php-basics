<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catálogo de productos</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

  </head>
  <body>
    <div class="container">
      <div class="col-sm-8 col-sm-offset-2">
      <h1>Catálogo de productos</h1>
      <?php
        if (isset($_SESSION['msg'])) {
          echo '<div class="alert alert-info">'.$_SESSION['msg'].'</div>';
          unset($_SESSION['msg']);
        }
      ?>

      <br/>
      <a href="form-insert.php" class="btn btn-info">Insertar nuevo producto</a>
      <br/><br/>

      <table class="table">
        <tr>
          <th>Referencia</th>
          <th>Nombre</th>
          <th>Marca</th>
          <th>Precio</th>
          <th>Stock</th>
          <th>Acciones</th>
        </tr>
        <?php
        # extensión avanzada para conectar a una bbdd mysql
        $connection = new mysqli('localhost', 'root', '', 'ejemplos');
        # query siempre con comillas dobles ""
        $result = $connection->query("SELECT * FROM productos");
        while ($producto = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<td>'.$producto['referencia'].'</td>';
          echo '<td>'.$producto['nombre'].'</td>';
          echo '<td>'.$producto['marca'].'</td>';
          echo '<td>'.$producto['precio'].'</td>';
          echo '<td>'.$producto['stock'].'</td>';
          echo '<td>';
            echo '<a href="form-update.php?ref='.$producto['referencia'].'">Editar</a>';
          echo '</td>';
          echo '</tr>';
        }

        $connection->close();
        ?>
      </table>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
