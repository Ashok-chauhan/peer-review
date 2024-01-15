function radioCtr(status, revId) {
    const proto = window.location.protocol;
    const host = proto + '//' + window.location.hostname + '/peer/updateReview';
    const formData = new FormData();
    formData.append('status', status);
    formData.append('reviewID', revId);
   
    fetch(host, {
        method: 'POST',
        body: formData,
    }).then(function (response) {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    }).then(function (data) {
        // Handle the response from the server
        const msg = document.getElementById("msg");
        msg.innerHTML = `<div class="alert alert-success alert-dismissible  role="alert">
                        ${data.success}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>`;
        // You can update the modal or perform any other actions here
    }).catch(function (error) {
                console.error('Error:', error);
                const msg = document.getElementById("msg");
                msg.innerHTML = `<div class="alert alert-danger" role="alert">
                        Error: ${data.error}!
                      </div>`;
            });

}