let accessLang = ['ru', 'kk'];
let getLanguage = () => {
    // Получаем локаль из атрибута lang HTML тега
    const htmlLang = document.documentElement.getAttribute('lang');
    if (htmlLang && accessLang.indexOf(htmlLang) !== -1) {
        return htmlLang;
    }
    
    // Если не найдено, проверяем скрипты
    for (let scr of document.scripts) {
        for (let attr of scr.attributes) {
            if (attr['name'] === 'plugin-lang' && accessLang.indexOf(attr['value']) != -1) {
                return attr['value'];
            }
        }
    }
    return 'ru';
}

document.addEventListener("DOMContentLoaded", function (event) {
    /*headers*/
    var lang = getLanguage();

    let app_css = document.createElement('link');
    app_css.rel = "stylesheet";
    app_css.href = "/css/saqtandyry-app.css";


    /*body*/
    /*container*/
    let btn_container = document.createElement('div');
    btn_container.id = "saqtandyry-status-btn-id";
    btn_container.type = "button";
    btn_container.className = "saqtandyry-status-btn";
    btn_container.style.display = "block";


    btn_container.innerHTML = `<svg viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="saqtandyry-status-logo">
            <path
                d="M10.4649 13.806L11.5351 13.1811L13.1405 12.2587V12.9133L17.9865 15.7102L17.9568 19.1022L15.0432 20.7982L12.1297 19.1022V14.1332L13.1703 14.7581L13.1405 18.4774L15.0432 19.5783L16.9459 18.4774V16.3053L11.5351 13.1811V22.6727L10.9703 23L10.4649 22.6727V13.806Z"
                fill="white" />
            <path
                d="M12.1 7.31953L11.5351 7.64683L13.1405 8.59896V2.32083L15.073 1.24968L16.9459 2.32083V4.52264L13.7054 6.3674V7.61708L17.9865 5.11772V1.72574L15.073 0L12.1 1.72574V7.31953Z"
                fill="white" />
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M6.98649 20.7982L9.92973 19.1022V13.4787L19.0865 8.21216L20.9595 9.34282V11.4851L19.0865 12.6455L15.8162 10.7115L14.7459 11.3364L19.0865 13.8655L22 12.11V8.71798L19.0865 7.02199L14.2108 9.81889L5.08378 4.52264V2.35058L6.98649 1.21992L8.85946 2.35058V6.06986L9.92973 6.6947V1.72574L6.98649 0L4.04324 1.72574V5.14748L8.85946 7.91462V9.1643L2.94324 12.6158L1.07027 11.5149V9.31307L2.94324 8.24191L6.18378 10.0867L7.25405 9.49159L2.94324 6.99224L0 8.68823V12.11L2.94324 13.8357L8.85946 10.414V18.4774L6.98649 19.5783L5.05405 18.4476V16.3053L8.32432 14.4308V13.1811L4.01351 15.7102L4.04324 19.0724L6.98649 20.7982ZM9.92973 8.5097V12.2885L13.1703 10.414L9.92973 8.5097Z"
                fill="white" />
        </svg>
    <svg xmlns="http://www.w3.org/2000/svg"  
     width="124" height="13" viewBox="0 0 130 13"
     class="saqtandyry-status-btn-title" id="saqtandyry-status-btn-title">
    <text y="10" font-size="14" font-weight="600"  
    font-family="Museo Sans Cyrl" fill="white">
        ${lang === 'ru' ? "Определить статус" : "Мәртебені анықтау"}
    </text>
</svg>`;
    
    // Добавляем обработчик клика на всю кнопку
    btn_container.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        const formContainer = document.getElementById('saqtandyry-status-form-id');
        const btnContainer = document.getElementById('saqtandyry-status-btn-id');
        if (formContainer && btnContainer) {
            formContainer.style.display = 'block';
            btnContainer.style.display = 'none';
        }
    });

    let form_container = document.createElement("div");
    form_container.id = "saqtandyry-status-form-id";
    form_container.className = "saqtandyry-status-form-container";
    form_container.style.display = "none";
    form_container.innerHTML = `
    <div class="handle ui-draggable-handle">
        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" id="closeX">
            <path d="M20.7867 11.4293C20.9148 11.3099 21.0181 11.1664 21.0907 11.0071C21.1633 10.8478 21.2039 10.6757 21.21 10.5007C21.2161 10.3257 21.1877 10.1512 21.1264 9.98713C21.0651 9.8231 20.9721 9.67275 20.8527 9.54467C20.7333 9.41659 20.5898 9.31328 20.4305 9.24065C20.2711 9.16801 20.099 9.12747 19.924 9.12134C19.749 9.11522 19.5745 9.14362 19.4105 9.20493C19.2464 9.26624 19.0961 9.35926 18.968 9.47867L15.0667 13.116L11.4293 9.21334C11.186 8.96406 10.8547 8.81995 10.5064 8.81183C10.1581 8.8037 9.82049 8.93222 9.56575 9.16988C9.31102 9.40754 9.15942 9.73545 9.1434 10.0835C9.12737 10.4315 9.2482 10.7719 9.48001 11.032L13.1173 14.9333L9.21468 18.5707C9.08207 18.6889 8.97442 18.8324 8.89805 18.9928C8.82169 19.1532 8.77814 19.3272 8.76997 19.5047C8.7618 19.6821 8.78917 19.8594 8.85047 20.0261C8.91178 20.1929 9.00579 20.3457 9.12697 20.4755C9.24815 20.6054 9.39407 20.7098 9.55615 20.7825C9.71823 20.8552 9.89321 20.8948 10.0708 20.8989C10.2484 20.9031 10.425 20.8717 10.5903 20.8066C10.7556 20.7416 10.9062 20.6441 11.0333 20.52L14.9347 16.884L18.572 20.7853C18.6895 20.9204 18.8329 21.0304 18.9938 21.1089C19.1546 21.1873 19.3297 21.2326 19.5084 21.2419C19.6871 21.2513 19.8659 21.2246 20.0341 21.1634C20.2023 21.1021 20.3564 21.0077 20.4873 20.8857C20.6183 20.7636 20.7233 20.6165 20.7961 20.453C20.8689 20.2895 20.9081 20.113 20.9113 19.934C20.9144 19.7551 20.8815 19.5773 20.8146 19.4114C20.7476 19.2454 20.6479 19.0946 20.5213 18.968L16.8853 15.0667L20.7867 11.4293Z" fill="#CCCCCC"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.333374 15C0.333374 6.90001 6.90004 0.333344 15 0.333344C23.1 0.333344 29.6667 6.90001 29.6667 15C29.6667 23.1 23.1 29.6667 15 29.6667C6.90004 29.6667 0.333374 23.1 0.333374 15ZM15 27C13.4242 27 11.8637 26.6896 10.4078 26.0866C8.95193 25.4835 7.62906 24.5996 6.51476 23.4853C5.40046 22.371 4.51654 21.0481 3.91349 19.5922C3.31043 18.1363 3.00004 16.5759 3.00004 15C3.00004 13.4241 3.31043 11.8637 3.91349 10.4078C4.51654 8.9519 5.40046 7.62903 6.51476 6.51473C7.62906 5.40043 8.95193 4.51651 10.4078 3.91346C11.8637 3.3104 13.4242 3.00001 15 3.00001C18.1826 3.00001 21.2349 4.26429 23.4853 6.51473C25.7358 8.76516 27 11.8174 27 15C27 18.1826 25.7358 21.2349 23.4853 23.4853C21.2349 25.7357 18.1826 27 15 27Z" fill="#CCCCCC"/>
        </svg>
    </div>`;

    /*form*/
    var form = document.createElement('iframe');
    form.id = 'saqtandyry-form';
    form.frameBorder = "0";
    form.allowTransparency = "false";
    form.scrolling = 'auto';
    form.src = "https://plugin.iss.fms.kz/saqtandyry-form.html?lang=" + lang;

    //form.src = "http://localhost:8877/saqtandyry-form.html?lang=" + lang;
    form_container.appendChild(form);

    /*add to document*/
    document.body.appendChild(btn_container);
    document.body.appendChild(form_container);
    document.body.appendChild(app_css);

    //setFormTramslate()
});

window.onload = function () {
    // Обработчик закрытия формы
    const closeBtn = document.getElementById('closeX');
    if (closeBtn) {
        closeBtn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            const formContainer = document.getElementById('saqtandyry-status-form-id');
            const btnContainer = document.getElementById('saqtandyry-status-btn-id');
            if (formContainer && btnContainer) {
                formContainer.style.display = 'none';
                btnContainer.style.display = 'block';
            }
        });
    }
};

window.addEventListener("message", function (event) {
    if (event.origin === "https://plugin.iss.fms.kz") {
        const formContainer = this.document.getElementById('saqtandyry-status-form-id');
        const form = this.document.getElementById('saqtandyry-form');
        
        if (event.data === "REQ_BTN_TRIGGERED") {
            if (formContainer) {
                formContainer.style.maxHeight = '90vh';
                formContainer.style.height = '90vh';
            }
            if (form) {
                form.style.height = '100%';
            }
        } else if (event.data === "CLEAR") {
            if (formContainer) {
                formContainer.style.maxHeight = 'calc(100vh - 120px)';
                formContainer.style.height = '550px';
            }
            if (form) {
                form.style.height = '100%';
            }
        }
    }
});




