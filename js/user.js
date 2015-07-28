$(document).ready(function() {

  function updateBookList() {
    $.ajax({
      url: "php_async/print_book_list.php",
      type: "GET",
      success: function(data) {
        $("#bookList").empty().append(data);
      }
    });
  };

  /**
   * Upload book.
   */
  $(document).on("submit", "#formUploadFile", function(event) {
    // Suppress default event handler.
    event.preventDefault();
    var formData = new FormData(document.getElementById("formUploadFile"));
    $.ajax({
      url: "php_async/upload_file.php",
      type: "POST",
      dataType: "text",
      data: formData,
      enctype: 'multipart/form-data',
      processData: false,
      contentType: false,
      success: function(msg) {
        $("#editBooksMsg").text(msg);
        updateBookList();
      }
    });
  });

  /**
   * Delete book.
   */
  $("#bookList").on("click", ".deleteBookButton", function() {
    var proceed = confirm("Are you sure you want to delete this file?");
    if (proceed) {
      var bookID = $(this).parent().parent().next(".hiddenBookID").val();
      $.ajax({
        url: "php_async/delete_file.php",
        type: "POST",
        dataType: "text",
        data: {
          bookID: bookID
        },
        success: function(msg) {
          $("#editBooksMsg").text(msg);
          updateBookList();
        }
      });
    }
  });
  
});