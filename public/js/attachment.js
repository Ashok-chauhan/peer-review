async function getRevisionFile(submission_content_id) {
  const attachment = document.getElementById("attachment");
  attachment.innerHTML = "";
  const response = await fetch("../getRevisionFile/" + submission_content_id);
  const data = await response.text();
  const dataArr = data.split("#");

  /*
     if(data.content !==undefined){
     attachment.innerHTML = `
     <div class="text-secondary fw-bold">Attachment &nbsp;&nbsp; ${data.submission_date}</div>
     <p><a href="../downloads/${data.content}">${data.content} </a> </p>`;
     }
     * 
     */

  if (data.length > 0) {
    attachment.innerHTML = `
        <div class="text-secondary fw-bold">Attachment &nbsp;&nbsp; ${dataArr[1]}</div>
        <p><a href="../downloads/${dataArr[0]}">${dataArr[0]} </a> </p>`;
  }
}

async function editorUpload() {
  alert("got it");
}
/** FILE UPLOAD BOF*/
/*
// Select your input type file and store it in a variable
const input = document.getElementById("revisionFile");

// This will upload the file after having read it
const upload = () => {
  const editorForm = document.getElementById("editor_upload");
  const formData = new FormData(editorForm);
  //formData.append('userFile', file)
  const proto = window.location.protocol;
  const host = proto + "//" + window.location.hostname;
  let url = host + "/editor/editorUpload";
  fetch(url, {
    // Your POST endpoint
    method: "POST",
    headers: {
      // Content-Type may need to be completely **omitted**
      // or you may need something
      // "Content-Type": "application/x-www-form-urlencoded"
    },
    body: formData, //file // This is your file object
  })
    .then(
      (response) => response.json() // if the response is a JSON object
    )
    .then((success) => {
      console.log(success);
      // console.log(success.upload_content);
      if (success.error) {
        const err = document.getElementById("editor-file");
        let msg = `<span class="alert alert-danger">${success.error}</span>`;
        err.innerHTML = msg;
      } else {
        const el = document.getElementById("editor-file");
        let uploaded = `<div class="badge text-bg-warning">Your Uploaded files</div>
                    
<table class="table table-bordered border-primary"><tr><td> ${success.upload_content}</td> <td> ${success.decision_date} </td>
<td><a href="${host}/editor/deleteEditorUpload/${success.submissionID}/${success.decisionID}">Delete</a></td></tr></table>`;
        el.innerHTML = uploaded;
      }
    })
    .catch(
      (error) => console.log(error) // Handle the error response object
    );
};

// Event handler executed when a file is selected
const onSelectFile = () => upload();

// Add a listener on your input
// It will be triggered when a file will be selected
input.addEventListener("change", onSelectFile, false);
*/
/** FILE UPLOAD BOF*/

/** BOF DISCUSS MODAL */
//function discuss () {
document.addEventListener("DOMContentLoaded", function () {
  console.log("got it");

  var container = document.getElementById("discussModal");
  var modal = new bootstrap.Modal(container);
  var replyForm = document.getElementById("discussForm");
  ///

  replyForm.addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent the form from submitting traditionally
    const formData = new FormData(replyForm);
    //formData.append("submissionID", subId);
    console.log(replyForm.action);
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
        console.log(data);
      })
      .catch(function (error) {
        console.error("Error:", error);
      });

    // Close the modal
    modal.hide();
  });
});

/** EOF DISCUSS MODAL */

/** BOF EDITOR TO AUTHOR NOTIFICATION */
var replyContainer = document.getElementById("replyModal");
var rplModal = new bootstrap.Modal(replyContainer);
var authorReplyForm = document.getElementById("replyForm");
document.getElementById("replyForm").addEventListener("submit", function (e) {
  e.preventDefault();
  const formData = new FormData(authorReplyForm);
  console.log(authorReplyForm.action);
  fetch(authorReplyForm.action, {
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
      // console.log(data);
      const msg = document.getElementById("msg");
      msg.innerHTML = `<div class="alert alert-success alert-dismissible  role="alert">
                    Message sent sucessfully!
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>`;
    })
    .catch(function (error) {
      console.error("Error:", error);
      const msg = document.getElementById("msg");
      msg.innerHTML = `<div class="alert alert-danger" role="alert">
                    Error: ${error}!
                  </div>`;
    });

  rplModal.hide();
});
/** EOF EDITOR TO AUTHOR NOTIFICATION */

// copy-editor bof
document.addEventListener("DOMContentLoaded", function () {
  console.log("got it");

  var container = document.getElementById("copyeditorModal");
  var modal = new bootstrap.Modal(container);
  var replyForm = document.getElementById("copyEditorReplyForm");
  ///

  replyForm.addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent the form from submitting traditionally
    const formData = new FormData(replyForm);
    //formData.append("submissionID", subId);
    console.log(replyForm.action);
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
        console.log(data);
      })
      .catch(function (error) {
        console.error("Error:", error);
      });

    // Close the modal
    modal.hide();
  });
});

// copy-editor eof