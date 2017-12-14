<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <ul>
      <?php
        require_once 'dbcon.php';

        $sql = 'SELECT album_id, album_name FROM album';
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($albumid, $albumname);

        while($stmt->fetch()){
  	      echo '<li><a href="artist_list.php?albumid='.$albumid.'">'.$albumname.'</a></li>'.PHP_EOL;
        }
      ?>
    </ul>
  </body>
</html>
