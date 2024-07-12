const publisherForm = document.getElementById("publisherReplyForm");
var publisher_modal = document.getElementById("publisherModal");
var publisherModal = new bootstrap.Modal(publisher_modal);
publisherForm.addEventListener("submit", function (event) {
  event.preventDefault(); //

  // const article = document.getElementById("articleType").value;
  // if (!article) {
  //   alert("Please select article component");
  //   return false;
  // }
  const formData = new FormData(publisherForm);
  // Perform AJAX request
  fetch(publisherForm.action, {
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
      }, 500);
    })
    .catch(function (error) {
      console.error("Error:", error);
      const msg = document.getElementById("msg");
      msg.innerHTML = `<div class="alert alert-danger" role="alert">
                      Error: ${error}!
                    </div>`;
    });

  // Close the modal
  publisherModal.hide();
});
