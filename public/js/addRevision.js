var toMail;
var toUid;
var subId;
function toMailId(mail, uid) {
  toMail = mail;
  toUid = uid;
}
function subId(id) {
  subId = id;
}

document.addEventListener("DOMContentLoaded", function () {
  var container = document.getElementById("revisionModal");
  var modal = new bootstrap.Modal(container);
  var replyForm = document.getElementById("revisionForm");
  ///

  replyForm.addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent the form from submitting traditionally

    const article = document.getElementById("article_type").value;
    if (!article) {
      alert("Please select article component");
      return false;
    }
    const formData = new FormData(replyForm);
    console.log(formData);
    formData.append("submissionID", subId);
    // body: new FormData(replyForm),
    // Perform AJAX request
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
        //window.location.reload();

        const msg = document.getElementById("msg");
        msg.innerHTML = `<div class="alert alert-success alert-dismissible  role="alert">
                        Revised file uploaded sucessfully!
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>`;
        // You can update the modal or perform any other actions here
        setTimeout(function () {
          location.reload();
        }, 1000);
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
