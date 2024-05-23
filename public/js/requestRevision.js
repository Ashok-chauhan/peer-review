const requestRevision = (id)=>{
    const message = document.getElementById('message');
    message.innerHTML ='';
    const value = document.getElementById(id).getAttribute('value');
    
    //message.innerHTML =  value.replace(/<[^>]*>?/gm, '');
    message.innerHTML =  value;
    
    
}