function radioCtr(status, revId, subid) {
  const proto = window.location.protocol;
  const host = proto + "//" + window.location.hostname + "/peer/updateReview";
  const formData = new FormData();
  formData.append("status", status);
  formData.append("reviewID", revId);
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
      // Handle the response from the server
      const msg = document.getElementById("msg");
      msg.innerHTML = `<div class="alert alert-success alert-dismissible  role="alert">
                        ${data.success}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>`;
      // You can update the modal or perform any other actions here
    })
    .catch(function (error) {
      console.error("Error:", error);
      const msg = document.getElementById("msg");
      msg.innerHTML = `<div class="alert alert-danger" role="alert">
                        Error: ${data.error}!
                      </div>`;
    });
}

/////// peerModa , data preparation
//data-arridx="<?= $discussion->sender_id . '/' . $discussion->sender_email . '/' . $discussion->submissionID . '/' . $discussion->title; ?>"

const peerForm = document.getElementById("peerReplyForm");
var peer_modal = document.getElementById("peerModal");
var peerModal = new bootstrap.Modal(peer_modal);
peerForm.addEventListener("submit", function (event) {
  event.preventDefault(); //

  // const article = document.getElementById("articleType").value;
  // if (!article) {
  //   alert("Please select article component");
  //   return false;
  // }
  const formData = new FormData(peerForm);
  // Perform AJAX request
  fetch(peerForm.action, {
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
        setTimeout(function () {
          location.reload();
        },200);
    })
    .catch(function (error) {
      console.error("Error:", error);
      const msg = document.getElementById("msg");
      msg.innerHTML = `<div class="alert alert-danger" role="alert">
                      Error: ${error}!
                    </div>`;
    });

  // Close the modal
  peerModal.hide();
});

$("#peerModal").on("show.bs.modal", function (event) {
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


const peerConsentForm = document.getElementById("peerConsentForm");
var peerConsent_modal = document.getElementById("peerConsent");
var peerConsentModal = new bootstrap.Modal(peerConsent_modal);
peerConsentForm.addEventListener("submit", function (event) {
  event.preventDefault(); //
  const formData = new FormData(peerConsentForm);
  // Perform AJAX request
  fetch(peerConsentForm.action, {
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
     console.log(data);
      const msg = document.getElementById("msg");
      msg.innerHTML = `<div class="alert alert-success alert-dismissible  role="alert">
                      Consent status updated sucessfully!
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
      // You can update the modal or perform any other actions here
        setTimeout(function () {
          location.reload();
        }, 200);
      
    })
    .catch(function (error) {
      console.error("Error:", error);
      const msg = document.getElementById("msg");
      msg.innerHTML = `<div class="alert alert-danger" role="alert">
                      Error: ${error}!
                    </div>`;
    });
  // Close the modal
  peerConsentModal.hide();
});