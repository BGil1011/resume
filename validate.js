function Validate() {
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input =>{
        switch(input.id){
            case 'email':
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if(!regex.test(input.value)){
                     I_error(input );
                } else{
                    R_error(input);
                }
            break;
            
            case 'fname': 
            case 'lname':
             input.value = input.value.trim();
             if(input.value == ''){
                 I_error(input);
             }else{
                
                R_error(input);
             }
             break;

            case 'summary':
            case 'head':
                input.value = input.value.trim();
                if(input.value.length < 10){
                         I_error(input);
                     }else{
                        R_error(input);
                     }      
                
            break;
        }
    });
    if(document.querySelectorAll('.error').length > 0){ return false;}
    return true;
}

function I_error(html){
    if(html.nextElementSibling.classList.contains('error')) return; 
    const error = document.createElement('p');
    error.classList.add('error');
    error.textContent = `${html.previousElementSibling.textContent} is invalid`;
    html.parentElement.insertBefore(error,html.nextElementSibling)
}
function R_error(html){
    if(html.nextElementSibling.classList.contains('error')) 
        html.nextElementSibling.remove();
}
