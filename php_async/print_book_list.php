<?php 

require_once '_root_.php';
require_once _ROOT_.'/php_utils/common.php';
require_once _ROOT_.'/php_utils/db_utils.php';
require _ROOT_.'/php_utils/auth_check.php';

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