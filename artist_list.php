<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      $albumid = filter_input(INPUT_GET, 'albumid', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');
    ?>
    <ul>
      <?php
        require_once 'dbcon.php';

        $sql = 'SELECT artist.artist_id, artist.artist_name
        FROM artist, artist_has_album
        WHERE artist_has_album.album_album_id=?
        AND artist.artist_id=artist_has_album.artist_artist_id';

        $stmt = $link->prepare($sql);
        $stmt->bind_param('i', $albumid);
        $stmt->execute();
        $stmt->bind_result($artistid, $artistname);

        while($stmt->fetch()) {
	         echo '<li><a href="artist_details.php?artistid='.$artistid.'">'.$artistname.'</a></li>'.PHP_EOL;
        }
      ?>
    </ul>
  </body>
</html>
