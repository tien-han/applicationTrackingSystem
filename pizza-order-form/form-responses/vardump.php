<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
  <?php echo '<p>POST</p>'; ?> 
  <?php echo var_dump($_POST); ?>

  <?php echo '<p>GET</p>'; ?> 
  <?php echo var_dump($_GET); ?> 

  <!-- Call on insert.php to insert form submission values into our pizza table -->
    <?php
        require '../data-processing/insert.php';
        insertPizzaValues($_POST);
    ?>
 </body>
</html>