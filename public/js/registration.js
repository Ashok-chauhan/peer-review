$(document).ready(function () {
  $("#review-interests").hide("smooth");

  $("#contact").change(function () {
    
    if (this.checked) {
      $("#review-interests").show("smooth");
    } else {
      $("#review-interests").hide("smooth");
    }
  });

  $("#reviewer").change(function () {
    
    if (this.checked) {
      $("#review-interests").show("smooth");
    } else {
      $("#review-interests").hide("smooth");
    }
  });


  $("#author").change(function () {
    if (this.checked) {
     
      $("#copy-editor").attr("disabled", true);
      $('#copy-editor').prop('checked', false);
      $("#publisher").attr("disabled", true);
      $('#publisher').prop('checked', false);
      $("#editor").attr("disabled", true);
      $('#editor').prop('checked', false);
    }else{
      $("#copy-editor").attr("disabled", false);
     
      $("#publisher").attr("disabled", false);
     
      $("#editor").attr("disabled", false);
   

    }
  });

  $("#reviewer" ).change(function () {
    if (this.checked) {
      $("#copy-editor").attr("disabled", true);
      $('#copy-editor').prop('checked', false);
      $("#publisher").attr("disabled", true);
      $('#publisher').prop('checked', false);
      $("#editor").attr("disabled", true);
      $('#editor').prop('checked', false);
    }else{
      $("#copy-editor").attr("disabled", false);
      $("#publisher").attr("disabled", false);
      $("#editor").attr("disabled", false);
    }
  });

  $("#copy-editor").change(function () {
    if (this.checked) {
      $('#reviewer').prop('checked', false);
      $('#author').prop('checked', false);
      $('#editor').prop('checked', false);
      $('#publisher').prop('checked', false);
      $("#reviewer").attr("disabled", true);
      $("#author").attr("disabled", true);
      $("#editor").attr("disabled", true);
      $("#publisher").attr("disabled", true);

    }else{
      $("#reviewer").attr("disabled", false);
      $("#author").attr("disabled", false);
      $("#editor").attr("disabled", false);
      $("#publisher").attr("disabled", false);

    }
  });


  $("#editor").change(function () {
    if (this.checked) {
      
      $('#reviewer').prop('checked', false);
      $('#author').prop('checked', false);
      $('#copy-editor').prop('checked', false);
      $('#publisher').prop('checked', false);
      $('#translator').prop('checked', false);

      $('#copy-editor').attr('disabled', true);
      $('#publisher').attr('disabled', true);
      $('#translator').attr('disabled', true);
      $("#reviewer").attr("disabled", true);
      $("#author").attr("disabled", true);
    }else{
      
      $('#copy-editor').attr('disabled', false);
      $('#publisher').attr('disabled', false);
      $('#translator').attr('disabled', false);
      $("#reviewer").attr("disabled", false);
      $('#reviewer').prop('disabled', false);
      $("#author").attr("disabled", false);
    }
  });

  $("#publisher").change(function () {
    if (this.checked) {
      console.log('checked');
      $('#reviewer').prop('checked', false);
      $('#author').prop('checked', false);
      $('#copy-editor').prop('checked', false);
      $('#editor').prop('checked', false);
      $('#translator').prop('checked', false);

      $('#copy-editor').attr('disabled', true);
     
      $('#translator').attr('disabled', true);
      $("#reviewer").attr("disabled", true);
      $("#author").attr("disabled", true);
      $("#editor").attr("disabled", true);
    }else{
      console.log('unchecekd');
      $('#copy-editor').attr('disabled', false);
    
      $('#translator').attr('disabled', false);
      $("#reviewer").attr("disabled", false);
      $('#reviewer').prop('disabled', false);
      $("#author").attr("disabled", false);
      $("#editor").attr("disabled", false);
    }
  });

});
