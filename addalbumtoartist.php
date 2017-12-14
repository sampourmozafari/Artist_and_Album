<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      $albumname = filter_input(INPUT_POST, 'albumname') or die('Missing/illegal parameter');
      $artistid = filter_input(INPUT_POST, 'artistid', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');

      require_once 'dbcon.php';

      $sql = 'INSERT INTO album (album_name) VALUES (?)';
      $stmt = $link->prepare($sql);
      $stmt->bind_param('s', $albumname);
      $stmt->execute();

      $albumid = $link->insert_id;

      $sql3 = 'INSERT INTO artist_has_album (artist_artist_id, album_album_id) VALUES (?, ?)';
      $stmt3 = $link->prepare($sql3);
      $stmt3->bind_param('ii', $artistid, $albumid);
      $stmt3->execute();

      if ($stmt3->affected_rows >0 ){
      	echo 'Album added to artist';
      }
      else {
      	echo 'No change - film allready added to category';
      }
    ?>

    <hr>

    <a href="artist_details.php?artistid=<?=$artistid?>">Artist details</a><br>
    <a href="artist_list.php?albumid=<?=$albumid?>">Films in same category</a><br>
  </body>
</html>
