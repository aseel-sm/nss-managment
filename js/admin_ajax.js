//set reg status
$(function () {
  $("#set_reg_status").on("click", function () {
    const status = $("#set_reg_status").val();
    const currentClass = status == 0 ? "btn-success" : "btn-danger";
    const newClass = status == 0 ? "btn-danger" : "btn-success";
    const value = status == 0 ? "Turn Off" : "Turn On";
    const newStatus = status == 1 ? 0 : 1;
    $.ajax({
      method: "POST",
      url: "../backend/set_status.php",
      data: { status: status, type: "registration" },
    }).done(function (data) {
      console.log(data);
      var result = data;
      if (result == "success") {
        console.log(value);
        $("#set_reg_status")
          .removeClass(currentClass)
          .addClass(newClass)
          .html(value)
          .val(newStatus);
      }
    });
  });
});
//set enr status
$(function () {
  $("#set_enr_status").on("click", function () {
    const status = $("#set_enr_status").val();
    const currentClass = status == 0 ? "btn-success" : "btn-danger";
    const newClass = status == 0 ? "btn-danger" : "btn-success";
    const value = status == 0 ? "Turn Off" : "Turn On";
    const newStatus = status == 1 ? 0 : 1;
    $.ajax({
      method: "POST",
      url: "../backend/set_status.php",
      data: { status: status, type: "enrollment" },
    }).done(function (data) {
      console.log(data + "enr");
      var result = data;
      if (result == "success") {
        console.log(value);
        $("#set_enr_status")
          .removeClass(currentClass)
          .addClass(newClass)
          .html(value)
          .val(newStatus);
      }
    });
  });
});
