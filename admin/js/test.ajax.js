$("#addQuestionForm").submit(function() {
  let question = $("#QuestionInput").val();
  let options = [
    $("#addQuestionOption1").val(),
    $("#addQuestionOption2").val(),
    $("#addQuestionOption3").val(),
    $("#addQuestionOption4").val()
  ];
  let answer = $("#AnswerInput").val();
  let testNumber = $("#testNumberInput").val();
  console.log(options);
  //   console.log(question, answer);
  // alert("submited");
  $.ajax({
    url: "includes/test.inc.php",
    type: "post",
    data: {
      testNumber: testNumber,
      question: question,
      options: options,
      answer: answer,
      request: "addQuestionAnswer"
    },
    success: function(data) {
      //   alert(data);
      //   console.log(data);
      let response = JSON.parse(data).msg;
      //   console.log(response);

      switch (response) {
        case "qas":
          $("#addQuestionFormMessages").html(
            '<div class="alert alert-success" role="alert">Question Added Successfully</div>'
          );
          setTimeout(function() {
            $("#addQuestionFormMessages").html("");
            $("#QuestionInput").val("");
            $(".addQuestionOptionInput").val("");
            $("#AnswerInput").val("");
            if ($("#closeMeAfterQuestionAdded").is(":checked")) {
              $("#addQuestionModalcloseBtn").click();
            } else {
            }
          }, 1000);
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

let MainData = [];

$(document).ready(function() {
  setInterval(function() {
    let testNumber = $("#testNumberInput").val();
    $.ajax({
      url: "includes/test.inc.php",
      type: "post",
      data: {
        testNumber: testNumber,
        page: "",
        request: "getQuestions"
      },
      success: function(data) {
        let datas = JSON.parse(data).data;
        MainData = data;
        // console.log(datas);
        //   console.log(JSON.parse(data).data);

        renderQuestionPagenation(datas);
      },
      error: function(e) {
        console.error("error");
      }
    });
  }, 1000);
});

let pageNo = 1;

function questionPage(page) {
  //   console.log(page);
  pageNo = page;
}

function renderQuestionPagenation(data) {
  var i;
  let rows = [];
  let limit = 20;
  //   console.log(pageNo);
  let totalData = data;
  let totalPages = Math.ceil(totalData.length / limit);

  let paginationBar = [];
  for (i = 1; i <= totalPages; i++) {
    paginationBar.push(
      '<li class="page-item"><a href="#" class="page-link" onclick="questionPage(\' ' +
        i +
        " ')\" >" +
        i +
        "</a></li>"
    );
  }
  paginationBar = paginationBar.toString();
  $("#questionPaginationBar").html(paginationBar);
  //   console.log(paginationBar.toString());

  //   console.log(totalData.length);
  //   console.log("totalPages", totalPages);
  let filteredData = [];
  for (i = (pageNo - 1) * limit; i < limit * pageNo; i++) {
    filteredData.push(totalData[i]);
  }
  filteredData = filteredData.filter(function(element) {
    return element !== undefined;
  });
  //   console.log(filteredData);
  renderRowsInTable(filteredData);
}

function renderRowsInTable(data) {
  var i;
  let rows = [];
  for (i = 0; i < data.length; i++) {
    // alert(subjects[i]["sub_name"])

    rows.push(
      '<tr>  <td scope="row">' +
        (i + 1) +
        "</td>  <td>" +
        data[i]["question"] +
        "</td>  <td>" +
        data[i]["answer"] +
        ". " +
        JSON.parse(data[i]["options"])[data[i]["answer"] - 1] +
        '</td>  <td>  <button class="btn btn-success" onclick="viewQuestionAnswer(\' ' +
        data[i]["id"] +
        '  \')" >  <i class="fa fa-eye"></i>  </button>  </td>  <td>  <button class="btn btn-warning"  onclick="editQuestionAnswer(\' ' +
        data[i]["id"] +
        '  \')">  <i class="fa fa-pencil-square-o"></i>  </button>  </td>  <td>  <button class="btn btn-danger" onclick="deleteQuestionAnswer(\' ' +
        data[i]["id"] +
        '  \')"  >  <i class="fa fa-trash"></i>  </button>  </td>  </tr>'
    );
    // console.log(subjects[i]["sub_name"]);
  }
  rows = rows.toString();
  $("#questionsAnswersTableBody").html(rows);
}

function viewQuestionAnswer(id) {
  $.ajax({
    url: "includes/test.inc.php",
    type: "post",
    data: {
      question: id,
      request: "viewQuestionAnswer"
    },
    success: function(data) {
      //   console.log(data);
      data = JSON.parse(data).data[0];
      let questionId = data["id"];
      let question = data["question"];
      let answer = data["answer"];
      let options = JSON.parse(data["options"]);
      // console.log(options);
      $("#viewQuestionIDInput").val(questionId);
      $("#viewQuestionInput").val(question);
      let optionsHTML = [];
      for (i = 0; i < options.length; i++) {
        optionsHTML.push(
          '<div class="form-group"> <label for="viewQuestionOption' +
            i +
            '">Option ' +
            (i + 1) +
            '</label> <input type="text" class="form-control viewQuestionOptionInput" value="' +
            options[i] +
            '" id="viewQuestionOption' +
            i +
            '" readonly></div>'
        );
      }
      optionsHTML = optionsHTML.toString();
      optionsHTML = optionsHTML.replace(
        /readonly><\/div>,/g,
        "readonly> </div>"
      );
      // console.log(optionsHTML);
      $("#viewQuestionOptionsContainer").html(optionsHTML);
      $("#viewAnswerInput").val(options[answer - 1]);
      //   console.log(data);

      $("#viewQuestionAnswer").modal("show");
    },
    error: function(e) {
      console.error("error");
    }
  });
}

function deleteQuestionAnswer(id) {
  let confirmDeleteRequest = confirm(
    "Are You Sure You Want To Delete This Question ?"
  );
  if (confirmDeleteRequest) {
    $.ajax({
      url: "includes/test.inc.php",
      type: "post",
      data: {
        question: id,
        request: "deleteQuestionAnswer"
      },
      success: function(data) {
        data = JSON.parse(data);
        // console.log(data);
        if (data.msg == "qds") {
          // alert("delete: " + id);
        } else {
          alert("Sorry! Somthing Wrong. Unable Dlelete Question");
        }
      },
      error: function(e) {
        console.error("error");
      }
    });
  } else {
    return false;
  }
}

function editQuestionAnswer(id) {
  // let confirmEditRequest = confirm(
  //   "Are You Sure You Want To Edit This Question ?"
  // );

  // console.log("edit", id);
  $.ajax({
    url: "includes/test.inc.php",
    type: "post",
    data: {
      question: id,
      request: "viewQuestionAnswer"
    },
    success: function(data) {
      //   console.log(data);
      data = JSON.parse(data).data[0];
      let questionId = data["id"];
      let question = data["question"];
      let answer = data["answer"];
      let options = JSON.parse(data["options"]);
      // console.log(options);
      $("#editQuestionIDInput").val(questionId);
      $("#editQuestionInput").val(question);
      let optionsHTML = [];
      for (i = 0; i < options.length; i++) {
        optionsHTML.push(
          '<div class="form-group"> <label for="editQuestionOption' +
            i +
            '">Option ' +
            (i + 1) +
            '</label> <input type="text" class="form-control editQuestionOptionInput" value="' +
            options[i] +
            '" id="editQuestionOption' +
            (i + 1) +
            '"></div>'
        );
      }
      optionsHTML = optionsHTML.toString();
      optionsHTML = optionsHTML.replace(/><\/div>,/g, "> </div>");
      // console.log(optionsHTML);
      $("#editQuestionOptionsContainer").html(optionsHTML);
      $("#editCorrectAnswerInput option[value=" + answer + "]").attr(
        "selected",
        "selected"
      );
      //   console.log(data);

      $("#editQuestionAnswer").modal("show");

      updateQuestion(id);
    },
    error: function(e) {
      console.error("error");
    }
  });
}

function updateQuestion(id) {
  $("#editQuestionForm").submit(function() {
    // alert(id);
    let question = $("#editQuestionInput").val();
    let options = [
      $("#editQuestionOption1").val(),
      $("#editQuestionOption2").val(),
      $("#editQuestionOption3").val(),
      $("#editQuestionOption4").val()
    ];
    let answer = $("#editCorrectAnswerInput").val();
    // console.log(question);
    // console.log(options);
    // console.log(answer);

    $.ajax({
      url: "includes/test.inc.php",
      type: "post",
      data: {
        questionId: id,
        question: question,
        options: options,
        answer: answer,
        request: "updateQuestionAnswer"
      },
      success: function(data) {
        //   alert(data);
        data = JSON.parse(data);
        let response = data.msg;
        // console.log(response);

        switch (response) {
          case "qus":
            $("#editQuestionFormMessages").html(
              '<div class="alert alert-success" role="alert"> Update Successful! </div>'
            );
            break;
          case "quu":
            $("#editQuestionFormMessages").html(
              '<div class="alert alert-danger" role="alert"> Update unsuccessful! try agin </div>'
            );
            break;
          default:
            break;
        }
        setTimeout(function() {
          $("#editQuestionFormMessages").html("");
          $("#editQuestionModalcloseBtn").click();
        }, 2000);
      },
      error: function(e) {
        console.error("error");
      }
    });

    return false;
  });
  // console.log("update :", id);
}

function pagination(id) {
  console.log(id);
  console.log(window.location.href + "");
  console.log(window.location.search);
  console.log(window);
  //   history.pushState("Hello Man", null, "test.php&?go=lop");
}
