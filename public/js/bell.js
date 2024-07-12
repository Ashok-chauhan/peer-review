function notification(){
const path = window.location.href.split('/');
    console.log('Bell rang...',  path[3]);
let url = path[3]+'/update_bellnotification';
console.log(url);

    fetch(url, {
        method: "POST",
        body: '',
      })
        .then(function (response) {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.text();
        })
        .then(function (data) {
        
          console.log('value ',data);
          if(data ==1){
         
            document.getElementById("noti-dot").style.display='none';
          }
          // You can update the modal or perform any other actions here
          
        })
        .catch(function (error) {
          console.error("Error:", error);
          
        });

        
  }