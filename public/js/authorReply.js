var toMail;
var toUid;

function toMailId(mail, uid) {
    toMail = mail;
    toUid = uid;
}




document.addEventListener('DOMContentLoaded', function () {
    var container = document.getElementById('replyModal');
    var modal = new bootstrap.Modal(container);
    var replyForm = document.getElementById('replyForm');
    ///
    
    replyForm.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the form from submitting traditionally
        const formData = new FormData(replyForm);
        formData.append("recipient", toMail);
        formData.append("recipient_id", toUid);
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
                    console.log( data, toMail, toUid);


                    const msg = document.getElementById("msg");
                    msg.innerHTML = `<div class="alert alert-success alert-dismissible  role="alert">
                        Message sent sucessfully!
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>`;
                    // You can update the modal or perform any other actions here


                })
                .catch(function (error) {
                    console.error('Error:', error);
                    const msg = document.getElementById("msg");
                    msg.innerHTML = `<div class="alert alert-danger" role="alert">
                        Error: ${error}!
                      </div>`;

                });

        // Close the modal
        modal.hide();
    });
    
    
    
    
});





