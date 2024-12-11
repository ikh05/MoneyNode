function toggleClass(element, nameClass){
    stringToDOM(element).classList.toggle(nameClass);
}

function togglePassword(button, element){
    element = stringToDOM(element);
    [...button.children].map(c => toggleClass(c, 'd-none'));
    if(element.getAttribute('type') === 'password'){
        element.setAttribute('type', 'text');
    }else{
        element.setAttribute('type', 'password');
    }
}


function stringToDOM(element){
    return typeof element === 'string' ? document.querySelector(element) : element;
}