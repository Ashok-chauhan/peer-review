$(document).ready(function () {
  $("#contact").change(function () {
    
    if (this.checked) {
      $("#review-interests").show("smooth");
    } else {
      $("#review-interests").hide("smooth");
    }
  });


  $("#author").change(function () {
    if (this.checked) {
     
      $("#copy-editor").attr("disabled", true);
    }
  });

  $("#reviewer").change(function () {
    if (this.checked) {
      $("#copy-editor").attr("disabled", true);
    }
  });

  $("#copy-editor").change(function () {
    if (this.checked) {
      $('#reviewer').prop('checked', false);
      $('#author').prop('checked', false)
      $("#reviewer").attr("disabled", true);
      $("#author").attr("disabled", true);
    }
  });

});
