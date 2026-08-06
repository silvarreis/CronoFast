
const step1 = document.getElementById('step-1');
const step2 = document.getElementById('step-2');
const next = document.getElementById('nextStep');
const back = document.getElementById('backStep');
const form = document.getElementById('form-register');

next.addEventListener('click', () => {
  const inputs = step1.querySelectorAll('input');
  let isValid = null;
  inputs.forEach((input) => {
        if (input.value.trim()  === "") {
            input.style.borderBottom = "2px solid red";
            isValid = false;
        } else {
            input.style.borderBottom = "2px solid green";
            isValid = true
        }
  });
  if (isValid) {
    step1.style.display = "none";
    step2.style.display = "grid";
    next.type = 'submit';
    next.textContent = "Cadastrar";
    back.style.display = "flex";
  }
});
back.addEventListener('click', () => {
    step2.style.display = "none";
    step1.style.display = "grid";
    next.textContent = "Continuar";
    back.style.display = "none";
});
form.addEventListener('submit', function(e){

  const plan = form.querySelector('input[name="plan_id"]:checked');
  const info = document.getElementById('info');
  let timeoutId;
  console.log(plan);
  if (!plan) {
    e.preventDefault();
    info.innerText = "Escolha um plano para continuar.";
    info.style.opacity = "1";
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
      const animacao = info.animate([
        { opacity: 1 }, 
        { opacity: 0 }  
      ], {
        duration: 500,  
        fill: "forwards"
      });
      animacao.onfinish = () => {
        info.innerText = "";
      };
    }, 3000);
  }
});
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