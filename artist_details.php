<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      $artistid = filter_input(INPUT_GET, 'artistid', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');

      require_once 'dbcon.php';

      $sql = 'SELECT artist.artist_name FROM artist WHERE artist.artist_id=?';
      $stmt = $link->prepare($sql);
      $stmt->bind_param('i', $artistid);
      $stmt->execute();
      $stmt->bind_result($artistname);

      while($stmt->fetch()) {
      }
      echo '<h1>'.$artistname.'</h1>';
    ?>

    <h2>Albums</h2>
    <ul>
      <?php
        $sql = 'SELECT album.album_id, album.album_name FROM artist_has_album, album WHERE artist_artist_id=? AND artist_has_album.album_album_id = album.album_id';
        $stmt = $link->prepare($sql);
        $stmt->bind_param('i', $artistid);
        $stmt->execute();
        $stmt->bind_result($albumid, $albumname);

        while($stmt->fetch()) {
	        echo '<li><a href="artist_list.php?albumid='.$albumid.'">'.$albumname.'</a>';
        }
	    ?>
    <form action="addalbumtoartist.php" method="post">
	    <input type="hidden" name="artistid" value="<?=$artistid?>">
      <input type="text" name="albumname" value="" placeholder="Album name">
      <input type="submit" value="Add album to artist">
    </form>
  </body>
</html>
