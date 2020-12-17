'use strict'

function saveForm() {

    //nothing to work with, get out of here
    
    if(typeof window.sessionStorage ==="undefined"){return;}
    
    saveValues("input");
    saveValues("select");
    
    return true;
}

function loadForm() {

    //nothing to work with, get out of here
    
    if(typeof window.sessionStorage ==="undefined"){return;}
    
    setValues("input");
    setValues("select");
}

function saveValues(tag){

    var inputs=document.getElementsByTagName(tag);
    
    for(var i=0;i<inputs.length;i++){
        window.sessionStorage.setItem(inputs[i].name, inputs[i].value);
    }
    
}

function setValues(tag){

    var inputs=document.getElementsByTagName(tag);
    
    for(var i=0;i<inputs.length;i++){
        if(inputs[i].name != "password" && inputs[i].name != "password_r" )
            inputs[i].value = window.sessionStorage.getItem(inputs[i].name);
    }
    
}

function clearForm(){
    if(typeof window.sessionStorage ==="undefined"){return;}

    window.sessionStorage.clear();
}