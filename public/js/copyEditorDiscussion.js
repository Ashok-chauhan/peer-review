/** BOF COPY EDITOR DISCUSSION MODAL */

document.addEventListener('DOMContentLoaded', function () {
    console.log('got it');

    var container = document.getElementById('copyeditorModal');
    var modal = new bootstrap.Modal(container);
    var replyForm = document.getElementById('copyeditorForm');
    ///

    replyForm.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the form from submitting traditionally
        const formData = new FormData(replyForm);
        //formData.append("submissionID", subId);
        console.log(replyForm.action);
        // body: new FormData(replyForm),
        // Perform AJAX request
        fetch(replyForm.action, {
            method: 'POST',
            body: formData,
        })
                .then(function (response) {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(function (data) {
                    // Handle the response from the server
                    console.log(data);


//                    const msg = document.getElementById("msg");
//                    msg.innerHTML = `<div class="alert alert-success alert-dismissible  role="alert">
//                        Message sent sucessfully!
//             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//                      </div>`;
                    // You can update the modal or perform any other actions here


                })
                .catch(function (error) {
                    console.error('Error:', error);
//                    const msg = document.getElementById("msg");
//                    msg.innerHTML = `<div class="alert alert-danger" role="alert">
//                        Error: ${error}!
//                      </div>`;

                });

        // Close the modal
        modal.hide();

    });
});

/** EOF COPY EDITOR DISCUSSION MODAL */