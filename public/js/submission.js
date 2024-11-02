// adding contributor

document.addEventListener("DOMContentLoaded", function () {
  var container = document.getElementById("contributorModal");
  var modal = new bootstrap.Modal(container);
  var replyForm = document.getElementById("contributorForm");

  replyForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the form from submitting traditionally
    if (!contributorFormCheck()) return;

    if (!validateEmail(document.getElementById("c-email").value)) {
      alert("Please enter a valid email");
      return false;
    }
    const formData = new FormData(replyForm);
    //formData.append("submissionID", subId);

    show_loader();
    fetch(replyForm.action, {
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
        //console.log(data.email);
        const nodeEl = document.getElementById("co-author");
        //<table id="${data.id}" width="100%" class="table table-bordered dt-responsive nowrap font-size-13">
        let row = `
                    <tr id="${data.id}">
                    <td style="width: 7%" >${data.title} ${data.name} ${
          data.m_name
        } ${data.l_name}</td>
                    <td  style="width: 20%">${data.email}</td>
                    <td style="width: 10%">${
                      data.role == 3 ? `Author` : `Translator`
                    }</td>
                    <td  style="width: 7%"><input class="check" type="radio" value="${
                      data.id
                    }" id="${data.id}" name="primary_contact" ></td>
                    <td style="width: 10%">
                    <input type="hidden" name="coauthorName[]" value="${
                      data.title
                    } ${data.name} ${data.m_name} ${data.l_name}">
                    <input type="hidden" name="coauthorId[]" value="${data.id}">
                    <input type="hidden" name="coauthorEmails[]" value="${
                      data.email
                    }">
                    
                    <span class="btn1 btn-danger"> <i class="fa fa-trash" onClick="del(${
                      data.id
                    },'contributorForm','deleteTempFile');" aria-hidden="true"></i></span>
                    </td>
                    </tr>
                    `;
        nodeEl.innerHTML += row;
      })
      .catch(function (error) {
        console.error("Error:", error);
        const msg = document.getElementById("msg");
        msg.innerHTML = `<div class="alert alert-danger" role="alert">
                        Error: ${error}!
                      </div>`;
      })
      .finally(() => {
        hide_loader();
      });

    // Close the modal

    modal.hide();
  });
});

// POST method implementation:
async function del(id, frm, method) {
  if (frm == null || (frm !== undefined && frm !== "contributorForm")) {
    document.getElementById(frm).reset();
  }
  const formData = new FormData();
  formData.append("id", id);

  //fetch("deleteCoauthor", {
  show_loader();
  fetch(method, {
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
      console.log(data.response);
      if (data.response) {
        let msg = `<div class="alert alert-success alert-dismissible fade show" role="alert">Deleted.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
        document.getElementById("del").innerHTML = msg;
        document.getElementById(id).remove();
        // window.location.reload();
      }
    })
    .catch(function (error) {
      let msg = `<div class="alert alert-danger">"Error:" ${error}</div>`;
      document.getElementById("del").innerHTML = msg;
      console.error("Error:", error);
    })
    .finally(() => {
      hide_loader();
    });
}

document.addEventListener("DOMContentLoaded", function () {
  var form = document.getElementById("authorModal");
  var modal = new bootstrap.Modal(form);
  var replyForm = document.getElementById("authorForm");

  var tform = document.getElementById("titleModal");
  var titleModal = new bootstrap.Modal(tform);
  var titleForm = document.getElementById("titleForm");

  var artform = document.getElementById("articleModal");
  var articleModal = new bootstrap.Modal(artform);
  var articleForm = document.getElementById("articleForm");

  replyForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the form from submitting traditionally

    if (Filevalidation("articlefile") > 100000) {
      alert("File too Big, please select a file less than 100mb");
      return false;
    }

    const article_type = authorForm.elements["article_type"].value;
    if (!article_type) {
      alert("Please select article component");
      return false;
    }

    const formData = new FormData(replyForm);
    //formData.append("submissionID", subId);

    show_loader();
    fetch(replyForm.action, {
      method: "POST",
      body: formData,
    })
      .then(function (response) {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then(function (success) {
        // Handle the response from the server

        const el = document.getElementById("author-file");
        let uploaded = `<tr id ="${success.id}">
                <td width="200"> ${success.component}</td>
                 <td width="500"> ${success.content} </td>
        <td width="20">
        <span class="btn1 btn-danger"> <i class="fa fa-trash" onClick="del(${success.id},'authorForm','deleteTempFile');" aria-hidden="true"></i></span>
        </td></tr>`;
        el.innerHTML += uploaded;
        //window.location.reload();
      })
      .catch(function (error) {
        console.error("Error:", error);
        const msg = document.getElementById("msg");
        msg.innerHTML = `<div class="alert alert-danger" role="alert">
                        Error: ${error}!
                      </div>`;
      })
      .finally(() => {
        hide_loader();
      });

    // Close the modal
    modal.hide();
  });

  /// Title page upload bof
  titleForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the form from submitting traditionally
    if (Filevalidation("articlePagefile") > 100000) {
      alert("File too Big, please select a file less than 100mb");
      return false;
    }

    const titleformData = new FormData(titleForm);
    
    //formData.append("submissionID", subId);

    show_loader();
    fetch(titleForm.action, {
      method: "POST",
      body: titleformData,
    })
      .then(function (response) {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then(function (success) {
        // Handle the response from the server
//console.log(success);

        const el = document.getElementById("author-file");
        let uploaded = `<tr id ="${success.id}">
                <td width="200"> ${success.component}</td>
                 <td width="500"> ${success.content} </td>
        <td width="20">
        <span class="btn1 btn-danger"> <i class="fa fa-trash" onClick="del(${success.id},'titleForm','deleteTempFile');" aria-hidden="true"></i></span>
        </td></tr>`;
        el.innerHTML += uploaded;
      })
      .catch(function (error) {
        console.error("Error:", error);
        const msg = document.getElementById("msg");
        msg.innerHTML = `<div class="alert alert-danger" role="alert">
                        Error: ${error}!
                      </div>`;
      })
      .finally(() => {
        hide_loader();
      });

    titleModal.hide();
  });
  /// Title page upload eof
  /// Article text bof
  articleForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the form from submitting traditionally

    if (Filevalidation("articleTextfile") > 100000) {
      alert("File too Big, please select a file less than 100mb");
      return false;
    }
    const ArticleFormData = new FormData(articleForm);
    //formData.append("submissionID", subId);

    show_loader();
    fetch(articleForm.action, {
      method: "POST",
      body: ArticleFormData,
    })
      .then(function (response) {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then(function (success) {
        // Handle the response from the server

        const el = document.getElementById("author-file");
        let uploaded = `<tr id="${success.id}">
                <td width="200"> ${success.component}</td>
                 <td width="500"> ${success.content} </td>
        <td width="20">
        <span class="btn1 btn-danger"> <i class="fa fa-trash" onClick="del(${success.id},'articleForm','deleteTempFile');" aria-hidden="true"></i></span>
        </td></tr>`;
        el.innerHTML += uploaded;
      })
      .catch(function (error) {
        console.error("Error:", error);
        const msg = document.getElementById("msg");
        msg.innerHTML = `<div class="alert alert-danger" role="alert">
                        Error: ${error}!
                      </div>`;
      })
      .finally(() => {
        hide_loader();
      });

    articleModal.hide();
  });
  /// Article text eof
});

function show_loader() {
  const spinner = document.getElementById("spinner");
  spinner.removeAttribute("hidden");
}

function hide_loader() {
  const spinner = document.getElementById("spinner");
  spinner.setAttribute("hidden", "");
}

function validateSForm() {
  //const subForm = document.getElementById("submission");

  // alert("You must agree to the terms first.");
  // return false;

  // Get all checkboxes with the specified class name
  //var checkboxes = document.getElementsByClassName("terms");
  //var error = document.getElementById("msg");
  const title = document.getElementById("title").value;
  const keyword = document.getElementById("keyword").value;
  const keywordArray = keyword.split(',');
  const language = document.getElementById("language").value;
  const article_File = document.getElementById("articlePagefile").value;
  const textFile = document.getElementById("articleTextfile").value;
  const file = document.getElementById("articlefile").value;
  const agreement = document.getElementById("data");
  const contributor = document.getElementById("c-email").value;
  // const terms1 = document.getElementById("terms1");
  // alert(terms1);
  // document.getElementById("editor_comment").value;

  // Check if at least one checkbox is checked
  var checkboxes = document.getElementsByClassName("terms");
  var error = document.getElementById("msg");
  // Check if at least one checkbox is checked
  for (var i = 0; i < checkboxes.length; i++) {
    if (!checkboxes[i].checked) {
      // error.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">Submission Requirements, You must read and acknowledge all checks to proceed submission.
      // <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      // </div>`;

      alert(
        "Submission Requirements, You must read and acknowledge all checks to proceed submission."
      );
      document.getElementById("terms1").focus();
      return false;
    }
  }

  const comment = tinymce.get("editor_comment").getContent();
  if (!comment.length) {
    alert("Please enter a valid comment to editor");
    document.getElementById("editor_comment").focus();
    return false;
  }
  if (!article_File) {
    alert("Please upload Article page file");
    return false;
  }
  if (Filevalidation("articlePagefile") >= 4096) {
    alert("File too Big, please select a file less than 4mb");
    return false;
  }
  //return false;

  if (!textFile) {
    alert("Please upload Article text file");
    return false;
  }

  if (!title.length) {
    alert("Please enter a valid Title");
    document.getElementById("title").focus();
    return false;
  }
  const abstract = tinymce.get("abstract").getContent();
  if (!abstract.length) {
    alert("Please enter a valid abstract");
    document.getElementById("abstract").focus();
    return false;
  }
  if (!contributor) {
    alert("Please add atleast one contributor to proceed");
    return false;
  }

  var primaryContact = document.getElementsByName("primary_contact");
  var ischecked = false;
  for (var i = 0; i < primaryContact.length; i++) {
    if (primaryContact[i].checked) {
      ischecked = true;
      break;
    }
  }
  if (!ischecked) {
    //payment method button is not checked
    alert("Please choose Contributor.");
    return false;
  }

  if (!language.length) {
    alert("Please enter a valid language");
    document.getElementById("language").focus();
    return false;
  } else if (!keyword.length) {
    alert("Please enter a valid keyword");
    document.getElementById("keyword").focus();
    return false;
  }
  if(keywordArray.length < 3){
    alert("Minimum 3 keywords required");
    document.getElementById("keyword").focus();
    return false;
  }

  const reference = tinymce.get("reference").getContent();
  if (!reference.length) {
    alert("Please enter a valid reference");
    document.getElementById("reference").focus();
    return false;
  }
  if (!agreement.checked) {
    alert("You must agree to proceed submission.");
    return false;
  }
  // No checkbox is checked, prevent form submission
}

function authReset(elm) {
  document.getElementById(elm).reset();
}
function resetContributor() {
  document.getElementById("contributorForm").reset();
}

function contributorFormCheck() {
  const coauth = document.getElementById("c-roleID");
  const translator = document.getElementById("cc-roleID");
  if (coauth.checked || translator.checked) {
    return true;
  } else {
    const error = document.getElementById("contributError");
    error.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">Contributor's role is required to add contributor.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>`;
    return false;
  }
}

const validateEmail = (email) => {
  return email.match(
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
  );
};

const Filevalidation = (file) => {
  const fi = document.getElementById(file);
  if (fi.files.length > 0) {
    for (const i = 0; i <= fi.files.length - 1; i++) {
      const fsize = fi.files.item(i).size;
      const file = Math.round(fsize / 1024);
      // The size of the file.
      /*
      if (file >= 4096) {
        alert("File too Big, please select a file less than 4mb");
        return false;
      }
      */
      return file;
    }
  }
};

tinymce.init({
  selector: "tinymce-editor",
  setup: function (editor) {
    editor.on("change", function (e) {
      editor.save();
    });
  },
});
