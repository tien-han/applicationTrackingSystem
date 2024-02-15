<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
  <?php
    echo '<p>POST</p>';
    echo var_dump($_POST);
  ?>

  <!-- Call on insert.php to insert form submission values into our pizza table -->
    <?php
        require '../data-processing/insert.php';
        insertPizzaValues($_POST);
    ?>
 </body>
</html>