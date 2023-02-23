$(document).ready(function () {
  $("table tbody").sortable({
    update: function (event, ui) {
      $(this)
        .children()
        .each(function (index) {
          if ($(this).attr("data-position") != index + 1) {
            $(this)
              .attr("data-position", index + 1)
              .addClass("updated");
          }
        });

      saveNewPositions();
      var notyf = new Notyf();
      notyf.success("Prioridade atualizada!");
      setTimeout(() => {
        location.reload(true);
      }, 2000);
    },
  });
});

function saveNewPositions() {
  var positions = [];
  $(".updated").each(function () {
    positions.push([$(this).attr("data-index"), $(this).attr("data-position")]);
    $(this).removeClass("updated");
  });

  $.ajax({
    url: "priorizacao.php",
    method: "POST",
    dataType: "text",
    data: {
      update: 1,
      positions: positions,
    },
    success: function (response) {
      console.log(response);
    },
  });
}
