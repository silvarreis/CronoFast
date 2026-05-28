document.querySelector('form').addEventListener('submit', function(e){
    e.preventDefault();

    const inputs = this.querySelectorAll('input:not([type="hidden"])');
    let valid = true;
    
    inputs.forEach(input => {
        if(!input.value.trim()){
            valid = false;
            input.style.borderBottom = '2px solid red';
        } else {
            input.style.borderBottom = '2px solid green';
        }
    });

    if (valid) { this.submit(); }
});