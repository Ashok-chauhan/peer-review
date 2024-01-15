
/*
document.getElementById("addFile").addEventListener("click", function (e) {
            e.preventDefault();
            const para = document.createElement("span");
            para.setAttribute("class","fw-bold");
            para.textContent = "Article Component *";
            const fileUploadFields = document.getElementById("fileUploadFields");
            const select = document.createElement("select");
           
            const option1 = document.createElement("option");
            //option1.setAttribute("selected");
            option1.textContent = "Select article component";
            const option2 = document.createElement("option");
            option2.setAttribute("value", "Article Text");
            option2.textContent = "Article text";
            const option3 = document.createElement("option");
            option3.setAttribute("value","Research Instrument");
            option3.textContent = "Research instrument";
            const option4 = document.createElement("option");
            option4.setAttribute("value","Research Materials");
            option4.textContent = "Research Materials";
            const option5 = document.createElement("option");
            option5.setAttribute("value","Research Results");
            option5.textContent = "Research Results";
            const option6 = document.createElement("option");
            option6.setAttribute("value","Transcripts");
            option6.textContent = "Transcripts";
            const option7 = document.createElement("option");
            option7.setAttribute("value","Data Analysis");
            option7.textContent = "Data Analysis";
            const option8 = document.createElement("option");
            option8.setAttribute("value","Data Set");
            option8.textContent = "Data Set";
            const option9 = document.createElement("option");
            option9.setAttribute("value","Source Texts");
            option9.textContent = "Source Texts";
            const option10 = document.createElement("option");
            option10.setAttribute("value","Other");
            option10.textContent = "Other";
            
            
            select.appendChild(option1);
            select.appendChild(option2);
            select.appendChild(option3);
            select.appendChild(option4);
            select.appendChild(option5);
            select.appendChild(option6);
            select.appendChild(option7);
            select.appendChild(option8);
            select.appendChild(option9);
            select.appendChild(option10);
            fileUploadFields.appendChild(para);
            fileUploadFields.appendChild(select);
            
            select.setAttribute("class","form-select");
            select.name= "article_type[]";
            const newDiv = document.createElement("div");
            newDiv.setAttribute("class", "p-2");
            const newFileInput = document.createElement("input");
            newFileInput.type = "file";
            newFileInput.name = "article[]";
            newFileInput.classList.add("fileToUpload");
            newDiv.appendChild(newFileInput);
            
            fileUploadFields.appendChild(newDiv);
        });
        
       */
        
   // adding contributor
   
   document.addEventListener('DOMContentLoaded', function () {
      
      
    var container = document.getElementById('contributorModal');
    var modal = new bootstrap.Modal(container);
    var replyForm = document.getElementById('contributorForm');
     
    replyForm.addEventListener('submit', function (event) {
       
        event.preventDefault(); // Prevent the form from submitting traditionally
        
        const formData = new FormData(replyForm);
        //formData.append("submissionID", subId);
        console.log(formData.get("c-name"));
        document.getElementById("coauthor").textContent = formData.get('c-name');
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
                    console.log( data);
                    document.cookie= 'coauthor='+data;

                    const msg = document.getElementById("msg");
                    msg.innerHTML = `<div class="alert alert-success alert-dismissible  role="alert">
                        Message sent sucessfully!
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>`;
                   

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