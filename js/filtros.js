var checkTodos = $("#checkTodos");
checkTodos.click(function () {
  if ($(this).is(":checked")) {
    $("input:checkbox").prop("checked", true);
  } else {
    $("input:checkbox").prop("checked", false);
  }
});
