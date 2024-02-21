$(document).ready(function () {
  $("#contact").change(function () {
    if (this.checked) {
      $("#review-interests").show("smooth");
    } else {
      $("#review-interests").hide("smooth");
    }
  });
});
