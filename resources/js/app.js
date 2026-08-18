const btnConfigUser     = document.getElementById("btn-config-user");
const btnLogout         = document.getElementById("btn-logout");
const btnMenu           = document.getElementById("menu-icon");
const boxControls       = document.querySelector('.controls');

const formLaps          = document.querySelector("#laps");
const meanArithmeticTag = document.getElementById("mean-arithmetic");
const totalSelectedTag  = document.getElementById("total-selected");
const totalTag          = document.getElementById("total");
const selectAll         = document.getElementById('selectAll');

let interval = false, arrayTime = [];
let hour = 0, minutes = 0, hundredthsSecond = 0.0, i = 0, lapNumber = 1;
let timeDisplay = document.getElementById('time');
let lapsContainer = document.getElementById('laps');
let btnCalc = document.querySelector(".btn-calc-laps");

let timerLogic = {
    start: () => {
        if (!interval) {
            interval = setInterval(() => {
                hundredthsSecond = Math.round((hundredthsSecond + 0.01) * 100) / 100;
                updateProgress(hundredthsSecond);
                if (hundredthsSecond == 99.99) {
                    hundredthsSecond = 0;
                    minutes++;
                }
                if (minutes == 60) {
                    minutes = 0;
                    hour = 1;
                }
                if (hour == 24) {
                    hour = 0;
                    minutes = 0;
                    hundredthsSecond = 0;
                }
                showTime();
                toggleButtons(['lap', 'pause'], ['start']);
            }, 6);
        } 
    },
    lap: () => {
        lapNumber = String(lapNumber).padStart(2, '0');
        const totalTime = timeDisplay.textContent;
        const lapTime = calcLapTime(totalTime);
        document.getElementById("laps").style.visibility = 'visible';
        const lapTimeBox = document.createElement('label');
        lapTimeBox.classList.add("item");
        lapTimeBox.innerHTML = `
            <input type="checkbox" class="hidden-checkbox" id="${lapNumber}" name="times[]" value="${lapNumber}, ${totalTime}, ${lapTime}">
            <div class="record">
                <span class="lap-number" for="${lapNumber}">${lapNumber}</span>
                <span>${totalTime}</span>
                <span>|</span>
                <span><strong>${lapTime}</strong></span>
            </div>
        `
        lapNumber++;
        lapsContainer.prepend(lapTimeBox);
        localStorage.setItem('historicoLapsHTML', lapsContainer.innerHTML);
        localStorage.setItem('proximoLapNumero', lapNumber);
        localStorage.setItem('time', totalTime);
    },
    pause: () => {
        if (lapNumber > 0 && lapNumber > 1) {
            btnCalc.classList.remove('hidden');
            timerLogic.lap();
        }
        clearInterval(interval);
        interval = false;
        toggleButtons(['continue', 'reset'], ['pause', 'lap']);
    },
    reset: () => {
        localStorage.removeItem('historicoLapsHTML');
        localStorage.removeItem('proximoLapNumero');
        localStorage.removeItem('time');
        localStorage.clear();
        sessionStorage.clear();
        btnCalc.classList.add('hidden');
        lapsContainer.replaceChildren();
        document.getElementById("laps").style.visibility = 'hidden';
        arrayTime = [];
        lapNumber = 1;
        showTime(true);
        toggleButtons(['start'], ['continue', 'reset', 'lap', 'pause']);
        
    },
    continue: () => {
        btnCalc.classList.add('hidden');
        timerLogic.start()
        toggleButtons(['pause', 'lap'],['continue', 'reset']);
    }
}
function showTime(clear = null) {
    if (clear) {
        clearInterval(interval);
        hour = 0; 
        minutes = 0;  
        hundredthsSecond = 0.0;
        interval = null;
        timeDisplay.textContent = `00:00:00.00`;
    }
    const hh = String(hour).padStart(2, '0');
    const mm = String(minutes).padStart(2, '0');
    const ss_cc = hundredthsSecond.toFixed(2).padStart(5, '0');
    timeDisplay.textContent = `${hh}:${mm}:${ss_cc}`; 
};
function calcLapTime(timeTotal) {
    const [h, m, s_c] = timeTotal.split(":");
    let hh = h, mm = m, ss_cc = s_c;
    arrayTime.push([h, m, s_c]);
    for (let i = 1; i < arrayTime.length; i++) {
        let lestTime = arrayTime[i - 1].join('');
        let currentTime = arrayTime[i].join('');

        let lapTime = (Number(currentTime) - Number(lestTime)).toFixed(2);
    
        hh = String(Math.floor(lapTime / 10000)).padStart(2, '0');
        mm = String(Math.floor((lapTime % 10000) / 100)).padStart(2, '0') ;
        ss_cc = String((lapTime % 100).toFixed(2)).padStart(5, '0');
    }
    return `${hh}:${mm}:${ss_cc}`;
}
function formatTime(time) {
    let hr, min, seg_cs;
    hr = String(Math.floor(time / 10000)).padStart(2, '0');
    min = String(Math.floor((time % 10000) / 100)).padStart(2, '0');
    seg_cs = String((time % 100).toFixed(2)).padStart(5, '0');
    return `${hr}:${min}:${seg_cs}`;
}
if (btnMenu) {
    btnMenu.addEventListener('click', () => {
        document.getElementById("nav").classList.toggle("active");
    });
}
if (btnConfigUser) {
    btnConfigUser.addEventListener('click', () => {
        window.location.href = '/profile';
    });
}
document.querySelectorAll(".dropdown-btn").forEach(btn => {
    btn.addEventListener("click", function () {
        if (window.innerWidth <= 835) {
            this.parentElement.classList.toggle("active");
        }
    });
});
if (btnLogout) {
    btnLogout.addEventListener('click', function () {
        window.location.href = "login";
        axios.post("/logout").then()
        .catch(err => {
            console.error('Erro ao sair:', err);
        });
    });
}
function toggleButtons(show, hidden) {
    show.forEach(action => boxControls.querySelector(`[data-action="${action}"]`)?.classList.remove("hidden"));
    hidden.forEach(action => boxControls.querySelector(`[data-action="${action}"]`)?.classList.add("hidden"));
}
if (boxControls) {
    boxControls.addEventListener('click', (e) => {
        const func = e.target.dataset.action;
        if (timerLogic[func]) {
            timerLogic[func]();
        }
    });
}
if (selectAll) {
    selectAll.addEventListener('change', function () {
        document.querySelectorAll('.hidden-checkbox').forEach(item => {
            item.checked = this.checked;
        });
    });
}
function updateProgress(percent) {
    document.querySelector('#time')
    .style.setProperty('--progress', percent);
}
const getForm = (id) => document.getElementById(id);

document.addEventListener("click", (e) => {
    const open     = e.target.closest("[data-open]");
    const close    = e.target.closest("[data-close]");
    const sendForm = e.target.closest("[data-send]");
    const edit     = e.target.closest("[data-edit]");
    const deleteUp = e.target.closest("[data-delete]");
    const deleteTime = e.target.closest("[data-delete-time]");
    const timeForm = e.target.closest("[data-time]");
    const view     = e.target.closest("[data-view]");
    const url      = window.location.pathname;

    if (open) {
        console.log(open.dataset.open);
        document.getElementById(open.dataset.open).classList.remove("hidden");
        if (url === '/stopwatch') {
            const valueAll = [];
            const valueSelected = [];
            
            formLaps.querySelectorAll('.hidden-checkbox').forEach((inputs) => {
                if (inputs.checked) {
                    valueSelected.push(Number((inputs.value.split(",")[2].split(":")).join("")))
                } 
                valueAll.push(Number((inputs.value.split(",")[2].split(":")).join("")));
            });

            const totalAll = parseFloat(
                valueAll.reduce(
                    (acc, currentNum) => acc + currentNum, 0
                )
            );

            const totalSelected = parseFloat(
                valueSelected.reduce(
                    (acc, currentNum) => acc + currentNum, 0
                )
            );

            meanArithmeticTag.textContent = (totalSelected/valueSelected.length).toFixed(2);
            totalSelectedTag.textContent = formatTime(totalSelected);
            totalTag.textContent = formatTime(totalAll);
        }
    }
    if (close) {
        close.closest(".modal-container").classList.add("hidden");
        close.closest(".modal").querySelector(".modal-body form").reset();
        if(meanArithmeticTag) {
           meanArithmeticTag.textContent = "0.0"; 
        }
    }
    if (sendForm) {
        const formEl = getForm(sendForm.dataset.send);
        if (formEl) {
            formEl.requestSubmit();
            meanArithmeticTag.textContent = "0.0";
        } else {
            alert("Formulario não encontrado para envio!");
        }
    }
    if (edit) {
        const id = edit.dataset.edit;
        const form = document.querySelector(`#form-edit-${url.split('/')[1]}`);
        const input = form.querySelectorAll('input')
        axios.get(`${url}/${id}/edit`).then(response => {
            const data = response.data;
            input.forEach(input => {
                const fieldName = input.name;
                if (data.hasOwnProperty(fieldName)) {
                    input.value = data[fieldName];  
                }
                form.action = `${url}/${id}`;
            });
        }).catch(error => {
            console.error("Erro ao buscar dados:", error);
        });
    }
    if (deleteUp) {
        const validate = confirm("Deseja apagar ?");
        if (!validate) return;
        const id = deleteUp.dataset.delete;
        const tr = document.getElementById(`${id}`);
        axios.delete(`${url}/${id}/delete`);
        tr.remove();
    }
    if (deleteTime) {
        const validate = confirm("Deseja apagar ?");
        if (!validate) return;
        const id = deleteTime.dataset.deleteTime;
        const trTime = document.getElementById(`time-${id}`);
        axios.delete(`${url}/${id}/time/delete`);
        trTime.remove();
    }
    if (timeForm) {
        const formEl1 = document.getElementById('add-time-part');
        const formEl2 = document.getElementById('laps');
        const formData = new FormData();

        new FormData(formEl1).forEach((value, key) => {
            formData.append(key, value);
        });
        new FormData(formEl2).forEach((value, key) => {
            formData.append(key, value);
        });

        axios.post('/stopwatch', formData, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }).then(res => {
            localStorage.removeItem('historicoLapsHTML');
            localStorage.removeItem('proximoLapNumero');
            localStorage.removeItem('time');
            window.location.reload();
        }).catch(err => {
            console.log(err.response.data);
        });
    }
    if (view) {
        const id = view.dataset.view;
        window.location.href = `/dashboard/show/${id}`;
    }
    
});

document.addEventListener('DOMContentLoaded', () => {
    const htmlSalvo = localStorage.getItem('historicoLapsHTML');
    const numeroSalvo = localStorage.getItem('proximoLapNumero');
    const time = localStorage.getItem('time');
    if (htmlSalvo) {
        document.getElementById("laps").style.visibility = 'visible';
        lapsContainer.innerHTML = htmlSalvo;
        lapNumber = parseInt(numeroSalvo);
        if (lapNumber > 0 && lapNumber > 1) {
            btnCalc.classList.remove('hidden');
        }
        timeDisplay.textContent =  time;
        toggleButtons(['continue', 'reset'], ['start','pause', 'lap']);
    }
});

window.addEventListener('DOMContentLoaded', () => {
    if ('caches' in window) {
        caches.keys().then((cacheNames) => {
            cacheNames.forEach((cacheName) => {
                caches.delete(cacheName);
            });
        }).catch((error) => console.error('Erro ao limpar cache:', error));
    }
});