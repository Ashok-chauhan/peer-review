//ABANDORNED NOT IN USSE SINCE UISNG SEPARATE PAGE INSTEAD RADIO BUTTON TO CHANGE STATUS.
function sendEmail(subid) {
  const proto = window.location.protocol;
  const host = proto + "//" + window.location.hostname + "/editor/final_email";
  const formData = new FormData();
  formData.append("submissionid", subid);
 

  fetch(host, {
    method: "POST",
    body: formData,
  })
    .then(function (response) {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then(function (data) {
     
      const msg = document.getElementById("msg");
      msg.innerHTML = `<div class="alert alert-success alert-dismissible  role="alert">
                        ${data.success}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>`;
     
    })
    .catch(function (error) {
      console.error("Error:", error);
      const msg = document.getElementById("msg");
      msg.innerHTML = `<div class="alert alert-danger" role="alert">
                        Error: ${data.error}!
                      </div>`;
    });
}



function resetAll() {
   if (confirm('Are you sure you want to reset all?')) {
    } else {
       return false
     }
    }


    
const productionForm = document.getElementById("productionReplyForm");
var production_modal = document.getElementById("productionModal");
var prodModal = new bootstrap.Modal(production_modal);
productionForm.addEventListener("submit", function (event) {
  event.preventDefault(); //

  // const article = document.getElementById("articleType").value;
  // if (!article) {
  //   alert("Please select article component");
  //   return false;
  // }
  const formData = new FormData(productionForm);
  // Perform AJAX request
  fetch(productionForm.action, {
    method: "POST",
    body: formData,
  })
    .then(function (response) {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.text();
    })
    .then(function (data) {
      // Handle the response from the server
      //window.location.reload();
      console.log(data);

      const msg = document.getElementById("msg");
      msg.innerHTML = `<div class="alert alert-success alert-dismissible  role="alert">
                      Revised file uploaded sucessfully!
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
      // You can update the modal or perform any other actions here
        // setTimeout(function () {
        //   location.reload();
        // },200);
    })
    .catch(function (error) {
      console.error("Error:", error);
      const msg = document.getElementById("msg");
      msg.innerHTML = `<div class="alert alert-danger" role="alert">
                      Error: ${error}!
                    </div>`;
    });

  // Close the modal
  prodModal.hide();
});

$("#productionModal").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var recipient = button.data("arridx"); // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  const params = recipient.split("/");
  let recipient_id = params[0];
  let recipient_email = params[1];
  let subid = params[2];
  let title = params[3];

  var modal = $(this);
  modal.find("#recipient").val(recipient_email);
  modal.find("#submission").val(subid);
  modal.find("#recipient_id").val(recipient_id);
  modal.find("#subject-title").val(title);
});


