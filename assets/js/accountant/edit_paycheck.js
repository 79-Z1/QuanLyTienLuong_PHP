const button = document.getElementById('luu');
function handleChange(e){
    if(e.value != 0){
        button.setAttribute('disabled','')
        return
    }
    button.removeAttribute('disabled')
}