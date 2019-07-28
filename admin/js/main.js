// Email Validation
function validateEmail(email) {
  var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
  if (filter.test(email)) {
    return true;
  } else {
    return false;
  }
}

// Add USER
function addUser(e) {
  e.preventDefault();

  let name = $("#name").val();
  let email = $("#email").val();
  let password = $("#password").val();
  let cnfPassword = $("#cnf_password").val();

  if ((name = "" || email == "" || password == "" || cnfPassword == "")) {
    $("#responseUser").html(
      '<span class="text-danger">All Fields Are Required</span>'
    );
  } else if (!validateEmail(email)) {
    $("#responseUser").html('<span class="text-danger">Invalid Email</span>');
    $("#email").focus();
  } else {
    $.ajax({
      url: "./includes/adduser.process.php",
      method: "POST",
      data: $("#addUserForm").serialize()
    }).done(function(data) {
      $("form").trigger("reset");
      $("#responseUser").html('<span class="text-success">' + data + "</span>");
      setTimeout(function() {
        $("#responseUser").fadeOut("slow");
      }).fail(function() {
        console.log("Error!");
      });
    });
    return false;
  }
} // ADD USER FUNCTION END

// ADD SUBJECT FUNCTION
function addSubject(e) {
  e.preventDefault();

  let subject = $("#subject").val();

  if (subject == "") {
    $("#responseSubject").html(
      '<span class="text-danger">Enter a Subject to Add</span>'
    );
    $("#subject").focus();
  } else {
    $.ajax({
      url: "./includes/addsubject.process.php",
      method: "POST",
      data: $("#addSubjectForm").serialize()
    })

      .done(function(data) {
        $("form").trigger("reset");
        $("#responseSubject").html(
          '<spna class="text-success">' + data + "</span>"
        );
        setTimeout(function() {
          $("#responseSubject").fadeOut("slow");
        }, 2000);

        $("#btnAddSubject").attr("data-dismiss", "modal");
      })
      .fail(function() {
        console.log("Error!");
      });
  }
  return false;
} // ADD SUBJECT FUNCTION END

$(document).ready(function() {
  //Event Listeners
  $("#btnAddUser").on("click", addUser);
  $("#btnAddSubject").on("click", addSubject);
}); //Document Ready Function END
