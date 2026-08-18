const step1 = document.getElementById('step-1');
const step2 = document.getElementById('step-2');
const step3 = document.getElementById('step-3');

const payStep = document.getElementById('payStep');
const next = document.getElementById('nextStep');
const back = document.getElementById('backStep');

const form = document.getElementById('form-register');
const info = document.getElementById('info');

let currentStep = 1;
let amount = 0;

next.addEventListener('click', (e) => {
    e.preventDefault();

    if (currentStep === 1) {

        const inputs = step1.querySelectorAll('input');
        let isValid = true;

        inputs.forEach((input) => {
            if (input.value.trim() === "") {
                input.style.borderBottom = "2px solid red";
                isValid = false;
            } else {
                input.style.borderBottom = "2px solid green";
    
            }
        });

        if (!isValid) return;

        step1.style.display = "none";
        step2.style.display = "flex";
        back.style.display = "block";
        next.textContent = "Prosseguir";

        currentStep = 2;
        return;
    }

    // STEP 2 -> STEP 3
    if (currentStep === 2) {

        const plan = document.querySelector('input[name="plan_id"]:checked');

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
        step2.style.display = "none";
        step3.style.display = "grid";
        next.style.display = "none";
        back.style.display = "none";

        switch (plan.value) {
            case "1":
                amount = 290;
                break;
            case "2":
                amount = 590;
                break;
            case "3":
                amount = 1200;
                break;
        }
        const mp = new MercadoPago(
            'APP_USR-e5ba5c8e-7488-4cee-b8aa-632a2411278a',
            {
                locale: "pt-BR"
            }
        );
        const bricksBuilder = mp.bricks();
        const renderCardPaymentBrick = async (bricksBuilder) => {
          const settings = {
            initialization: {
                amount: amount, 
                payer: {
                    email: "",
                },
            },
            customization: {
                visual: {
                    style: {
                        theme: 'dark',
                        customVariables: {
                        },
                    },
                },
                paymentMethods: {
                    maxInstallments: 1,
                },
            },
            callbacks: {
                onReady: () => {},
                onSubmit: (cardFormData) => {
                    return new Promise((resolve, reject) => {
                        fetch('/preapproval', {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json",
                                "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                            },
                            body: JSON.stringify({
                                name: document.querySelector('#name').value,
                                email: document.querySelector('#email').value,
                                password: document.querySelector('#password').value,
                                password_confirmation: document.querySelector('#password_confirmation').value,
                                cardFormData: cardFormData, 
                                plan_id: plan.value
                            })
                        })
                        .then(async (response) => {
                            const data = await response.json();
                            if (data.success) {
                                window.location.reload();
                            }
                            resolve();
                        })
                        .catch((error) => {
                            reject();
                        })
                    });
                },
                onError: (error) => {
                    console.error("Erro no Brick:", error);
                },
            },
          };
          window.cardPaymentBrickController = await bricksBuilder.create('cardPayment', 'cardPaymentBrick_container', settings);
        };
        renderCardPaymentBrick(bricksBuilder);
        currentStep = 3;
    }
    
});
back.addEventListener('click', (e) => {
    e.preventDefault();
    step2.style.display = "none";
    step1.style.display = "grid";
    next.textContent = "Continuar";
    back.style.display = "none";
});