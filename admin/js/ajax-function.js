console.log("ajax-functions");
$("#cofirmPasswordToDeleteAccount").keyup(function() {
  //   console.log("paass check");
  let email = $("#emailToDeleteAccount").val();
  let password = this.value;
  $.ajax({
    url: "includes/admin.inc.php",
    type: "post",
    data: {
      email: email,
      password: password,
      request: "deleteAccountPasswordCheck"
    },
    success: function(data) {
      let response = JSON.parse(data).response;
      console.log(response);
      if (response == 200) {
        console.log("ok");
        $("#deleteMyAccountBtn").removeClass("disabled");
        $("#deleteMyAccountBtn").removeAttr("disabled");
      } else {
        $("#deleteMyAccountBtn").addClass("disabled");
        $("#deleteMyAccountBtn").addAttr("disabled");
        console.log("you are n admin");
      }
    },
    error: function(e) {
      console.error("error");
    }
  });
});

// function checkBothPasswordInputValuesAreSame(e) {
//   alert("hi");
//   return void 0;
//   //   let password = $("#ChangePasswordInput").val();
//   //   console.log(password);
//   //   return false;
// }

$("#deleteAccountForm").submit(function(event) {
  event.preventDefault();
  //   var self = this;
  //   window.setTimeout(function() {
  //     self.submit();
  //   }, 2000);
});

$("#addSubjectForm").submit(function() {
  let subject = $("#subjectName").val();
  let request = "addSubject";

  console.log(subject);
  // alert("ajax");

  $.ajax({
    url: "includes/admin.inc.php",
    type: "post",
    data: {
      request: request,
      subject: subject
    },
    success: function(data) {
      let response = JSON.parse(data).msg;
      console.log(response);

      switch (response) {
        case "sas":
          // subject added successfully
          $("#addSubjectModalClose").click();
          alert("subject added successfully");
          break;
        case "piq":
          // proble in query
          $("#addSubjectMessages").html(
            '<div class="alert alert-primary" role="alert"> A simple primary alert—check it out!</div>'
          );

          break;
        case "sae":
          // subject already exist
          $("#addSubjectMessages").html(
            '<div class="alert alert-danger" role="alert"> Subject Already Exist </div>'
          );

          break;
        case "sfn":
          // subject field null
          $("#addSubjectMessages").html(
            '<div class="alert alert-danger" role="alert"> Please write somthing in Subject Name filde </div>'
          );

          break;
        default:
          break;
      }
    },
    error: function(e) {
      console.error("error");
    }
  });

  return false;
});

function renderSubjects() {
  let request = "getSubjects";

  $.ajax({
    url: "includes/admin.inc.php",
    type: "post",
    data: {
      request: request
    },
    success: function(data) {
      let subjects = JSON.parse(data).subjects;
      // console.log(subjects);
      var i;
      let options = [];
      for (i = 0; i < subjects.length; i++) {
        // alert(subjects[i]["sub_name"])
        options.push(
          "<option value='" +
            subjects[i]["sub_name"] +
            "'>" +
            subjects[i]["sub_name"] +
            "</option>"
        );
        // console.log(subjects[i]["sub_name"]);
      }
      options = options.toString();
      $("#subjectSelectForAddQuestions").html(options);
    },
    error: function(e) {
      console.error("error");
    }
  });
}

function addUserFormSubmit() {}

$("#addUserFormSubmit").submit(function() {
  let name = this[0].value;
  let email = this[1].value;
  let password = this[2].value;

  let request = "addUser";
  try {
    $.ajax({
      url: "includes/admin.inc.php",
      type: "post",
      data: { request: request, name: name, email: email, password: password },
      success: function(data) {
        let response = JSON.parse(data).msg;
        console.log(response);

        switch (response) {
          case "uas":
            $("#addUserModalCloseBtn").click();
            setTimeout(function() {
              alert("User Added Successfully");
            }, 500);
            break;
          case "uau":
            $("#userAddFormMessages").html(
              '<div class="alert alert-danger" role="alert">User Add Unsuccessful! try again</div>'
            );
            break;
          case "uaewte":
            // alert("uae");
            $("#userAddFormMessages").html(
              '<div class="alert alert-danger" role="alert">User Already Exists With This Email</div>'
            );
            break;
          case "pfaf":
            // alert("uae");
            $("#userAddFormMessages").html(
              '<div class="alert alert-danger" role="alert">please fillup all the fields </div>'
            );
            break;
          default:
            break;
        }
      },
      error: function(e) {
        console.error("error");
      }
    });
  } catch (error) {
    console.log(error);
  }

  return false;
});

$("#addTestForm").submit(function() {
  // alert("submit");
  let subjetcName = $(this)[0][0].value;
  let testName = $(this)[0][1].value;
  console.log(subjetcName, testName);

  try {
    $.ajax({
      url: "includes/admin.inc.php",
      type: "post",
      data: {
        subject: subjetcName,
        testName: testName,
        request: "addNewTest"
      },
      success: function(data) {
        let response = JSON.parse(data).msg;
        console.log(response);

        switch (response) {
          case "ntas":
            alert("New Test Added");
            setTimeout(function() {
              let redirectUrl =
                "http://localhost:8001/admin/test.php?test=" +
                JSON.parse(data)["testId"];
              window.location = redirectUrl;
            }, 500);
            break;
          case "pfsn":
            $("#newTestAddFormSubmitMessages").html(
              '<div class="alert alert-danger" role="alert">please fill subject name</div>'
            );
            break;
          default:
            break;
        }
      },
      error: function(e) {
        console.error("error");
      }
    });
  } catch (error) {
    console.log(error);
  }

  return false;
});
