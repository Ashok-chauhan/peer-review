/*
var toMail;
var toUid;

function toMailId(mail, uid) {
  toMail = mail;
  toUid = uid;
}
*/

document.addEventListener("DOMContentLoaded", function () {
  var container = document.getElementById("replyModal");
  var modal = new bootstrap.Modal(container);
  var replyForm = document.getElementById("replyForm");

  replyForm.addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent the form from submitting traditionally
    const formData = new FormData(replyForm);
    //formData.append("recipient", "dadsfds");
    //formData.append("recipient_id", "444");
    console.log(replyForm.action);
    console.log(formData);
    fetch(replyForm.action, {
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
                        Message sent sucessfully!
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
    modal.hide();
  });
});

$("#replyModal").on("show.bs.modal", function (event) {
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
