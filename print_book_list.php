<?php 

require_once 'common.php';
require_once 'db_utils.php';
require 'auth_check.php';

$uid = $_SESSION['uid'];
$books = dbFetchAllBooksDataByUID($uid);

echo "<table class='bookList'>";
foreach ($books as $book) {
  $bookID = $book['id'];
  $fileName = $book['fileName'];
  $fileSize = $book['fileSize'];
  echo <<<END
  <tr>
    <td><a href='books/$uid/$fileName'>$fileName</a></td>
    <td>$fileSize</td>
    <td><input type='button' class='deleteBookButton' value='x'></input></td>
  </tr>
  <input type='hidden' class='hiddenBookID' value='$bookID'></input>
END;
}
echo "</table>";

?>