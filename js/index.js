$(document).ready(function() {

  $.validator.addMethod("alphabetic", 
    function(value, element) {
      return /^[a-z]+$/i.test(value);
    }, 
    "Alphabetic only"
  );

  $.validator.addMethod("alphanumeric", 
    function(value, element) {
      return /^[a-z0-9]+$/i.test(value);
    }, 
    "Alphanumeric only"
  );

  $('#login').validate({
    rules: {
      email: {
        required: true,
        email: true,
        maxlength: EMAIL_MAX_LEN
      },
      password: {
        required: true,
        minlength: PASSWORD_MIN_LEN,
        maxlength: PASSWORD_MAX_LEN,
        alphanumeric: true
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });

  $('#registration').validate({
    rules: {
      firstName: {
        required: true,
        minlength: FIRSTNAME_MIN_LEN,
        maxlength: FIRSTNAME_MAX_LEN,
        alphabetic: true
      },
      lastName: {
        required: true,
        minlength: LASTNAME_MIN_LEN,
        maxlength: LASTNAME_MAX_LEN,
        alphabetic: true
      },
      email: {
        required: true,
        email: true,
        maxlength: EMAIL_MAX_LEN,
        remote: {
          url: 'is_email_available.php',
          type: "post",
          data: {
            email: function() {
              return $('#registration :input[name="email"]').val();
            }
          }
        }
      },
      password: {
        required: true,
        minlength: PASSWORD_MIN_LEN,
        maxlength: PASSWORD_MAX_LEN,
        alphanumeric: true
      }
    },
    messages: {
      email: {
        remote: jQuery.validator.format("{0} is already taken")
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });

});