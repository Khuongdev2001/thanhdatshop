
/* Validate From DEV NGUYỄN HỮU KHƯƠNG */
function Validator({ form, rules, handleSubmit }) {
    const formValidator = $(form);
    if (!formValidator) {
        return;
    }
    /* Loop Rules And Add Event Blur Element */
    const selectRules = {};
    const dataValidated = {};

    function validate(input, rule) {
        const inputRules = selectRules[rule.selector];
        /* Add Text Message In HTML */
        const elementMesssage = input.parentElement.querySelector("span");
        let error = null;
        for (let i = 0; i < inputRules.length; i++) {
            const message = inputRules[i](input.value);
            /* Set Error First In Input And Stop To Set Message */
            if (message) {
                error = message;
                break;
            }
        }
        if (error) {
            elementMesssage.innerHTML = error;
            /* Add Class Css Style Error Of Validate */
            input.classList.add("is-invalid");
            input.parentElement.classList.add("form-error");
            return false;
        }
        dataValidated[input.getAttribute("data-field")] = input.value;
        /* Remove Class If No Error Blur Next */
        elementMesssage.innerHTML = null;
        input.classList.remove("is-invalid");
        input.parentElement.classList.remove("form-error");
        return true;
    }

    rules.forEach((rule) => {
        const input = formValidator.querySelector(rule.selector);
        if (!input) {
            return;
        }
        /* Add Rule If Is Tow Rule More */
        if (Array.isArray(selectRules[rule.selector])) {
            selectRules[rule.selector].push(rule.test);
        }
        /* Add Rule First */
        else {
            selectRules[rule.selector] = [rule.test];
        }
        /* Handle Blur Validate */
        input.onblur = function (e) {
            validate(input, rule);
        }
        /** Handle Onchange */
        input.onchange = function () {

            /* Clear Text Message In HTML */
            const elementMesssage = input.parentElement.querySelector("span");
            input.parentElement.classList.remove("form-error");
            elementMesssage.innerHTML = null;
            /* Rmove Class Css Style Error Of Validate */
            input.classList.remove("is-invalid");
        }
    })

    /* Handle On Submit Each Rules And Set Validate */
    formValidator.onsubmit = function (e) {
        e.preventDefault();
        let errors = [];
        rules.forEach((rule) => {
            const input = formValidator.querySelector(rule.selector);
            if (!input) {
                return;
            }
            /* Add Error Array If Validate Field */
            if (!validate(input, rule)) {
                errors.push(rule);
            };
        });
        if (errors.length) {
            return;
        }
        /* Handle Callback When Submit Validated */
        if (typeof handleSubmit == "function") {
            handleSubmit(dataValidated, formValidator);
            return;
        }
        /* Submit If Not Item In Array Errors */
        formValidator.submit();
    }
}
/* Define List Rule New */

Validator.isRequired = function (selector, message = null) {
    return {
        selector,
        /**
        * @returns underfind or true 
        */
        test: function (value) {
            return value.trim() ? undefined : message;
        }
    }
}

Validator.isEmail = function (selector, message = null) {
    const regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    return {
        selector,
        test: function (value) {
            return regex.test(value) ? undefined : message
        }
    }
}

Validator.isConfirm = function (selector, selectorMatch, message = null) {
    const password = $(selectorMatch);
    return {
        selector,
        test: function (value) {
            /* Check Password Input Password_Confirm And Password */
            return value === password.value ? undefined : message
        }
    }
}

Validator.isPhone = function (selector, message) {
    return {
        selector,
        test: function (value) {
            const regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
            return !value || regex.test(value) ? undefined : message;
        }
    }
}

Validator.inValue = function (selector, values, message = null) {
    return {
        selector,
        test: function (value) {
            return values.includes(Number(value)) ? undefined : message;
        }
    }
}

Validator.maxLengthValue = function (selector, message, maxValue) {
    return {
        selector,
        test: function (value) {
            return String(value).length > maxValue ? message : undefined;
        }
    }
}

Validator.minLengthValue = function (selector, message, minValue) {
    return {
        selector,
        test: function (value) {
            return String(value).length < minValue ? message : undefined;
        }
    }
}

Validator.isNumber = function (selector, message) {
    return {
        selector,
        test: function (value) {
            return !isNaN(value) ? undefined : message
        }
    }
}

Validator.maxValue = function (selector, message, maxValue) {
    return {
        selector,
        test: function (value) {
            return value > maxValue ? message : undefined;
        }
    }
}

Validator.isRequiredUpload = function (selector, selectFileOld, message) {
    return {
        selector,
        test: function (value) {
            const selectOld = $(selectFileOld);
            return (value || selectOld) ? undefined : message;
        }
    }
}

Validator.confirmSelect = function (selector) {
    return {
        selector,
        test: function () {
            return undefined;
        }
    }
}

Validator.isRequiredIf = function (selector, message, callback) {
    return {
        selector,
        test: function (value) {
            if (callback()) {
                // console.log(value);
                return Number(value) ? undefined : message;
            }
            return undefined;
        }
    }
}


/* Slider View DEV NGUYỄN HỮU KHƯƠNG */
function handleSlider({ id = ".sliders", delay = 4000 }) {
    const sliders = $(id);
    if (!sliders) {
        return;
    }
    /* get width slider */
    const widthSlider = sliders.clientWidth;
    const minHeight = widthSlider / 3.08;
    const wpSlider = sliders.children[0];
    /* get num slider item */
    const numSlider = wpSlider.children.length;
    /* set width slider wrapper */
    wpSlider.style.width = `${numSlider * widthSlider}px`;
    let index = 0;
    for (let i = 0; i < numSlider; i++) {
        if (wpSlider.children[i].classList.contains("active")) {
            index = i;
        }
        wpSlider.children[i].style.width = `${widthSlider}px`;
        wpSlider.children[i].style.minHeight = `${minHeight}px`;

    }

    const navigate = sliders.parentElement.children[1].children;
    /* add event btn prev */
    navigate[0].onclick = function (e) {
        prevSlider();
        e.preventDefault();
    };
    /* add event btn next */
    navigate[1].onclick = function (e) {
        nextSlider();
        e.preventDefault();
    };

    /* handle css by index*width of slider */
    function hanldeCssSlider() {
        wpSlider.style.transform = `translate3d(${-index * widthSlider}px,0px,0px)`;
        let transition = index ? "all 0.5s" : "";
        wpSlider.style.transition = transition;
    }

    function nextSlider() {
        if (numSlider == index) {
            index = 0;
        }
        hanldeCssSlider();
        index++;
    }

    function prevSlider() {
        if (!index) {
            index = numSlider - 1;
        }
        else {
            index--;
        }
        hanldeCssSlider();
    }
    let timer = setInterval(nextSlider, delay);

    /* add event hover */

    sliders.parentElement.addEventListener("mouseover", () =>
        clearInterval(timer)
    );

    /* add event hover out */
    sliders.parentElement.addEventListener("mouseout", () =>
        timer = setInterval(nextSlider, delay)
    )
}

/* Set Tab View DEV NGUYỄN HỮU KHƯƠNG */

function handleSetTab() {
    const tabItems = $$(".tab-item");
    const tabPenals = $$(".tab-penal");
    tabItems.forEach((tab, index) => {
        tab.onclick = function (e) {
            $(".tab-item.active").classList.remove("active");
            $(".tab-penal.active").classList.remove("active");
            this.classList.add("active");
            tabPenals[index].classList.add("active");
            e.preventDefault();
        }
    })
}

/* Modal View DEV NGUYỄN HỮU KHƯƠNG */
function handleModal() {
    /* Loop Element Modals */
    $$('[data-toggle="modal"]').forEach((btnOnModal) => {
        btnOnModal.onclick = function (e) {
            const selectorModalTarget = btnOnModal.getAttribute("data-target");
            const modalActive = $(".modal.active");
            if (modalActive) {
                modalActive.classList.remove("active");
            }
            /* Handle Show Modal */
            const modalTarget = $(selectorModalTarget);
            modalTarget.classList.add("active");
            /* Handle Exit Modal */
            modalTarget.querySelector(".btn-exit").onclick = function (e) {
                modalTarget.classList.remove("active");
                e.preventDefault();
            }
            e.preventDefault();
        }
    })
}

/* Handle Input */

function handleInput() {
    $$(".form-group-outline input").forEach(input => {
        // check input is value
        if (input.value) {
            input.previousElementSibling.classList.add("active");
        }
        input.onfocus = function () {
            input.previousElementSibling.classList.add("active");
        }
        input.addEventListener("focusout", function () {
            if (!input.value) {
                input.previousElementSibling.classList.remove("active");
            }
        })
    })
}

/* Handle Toastr Notification DEV NGUYỄN HỮU KHƯƠNG*/

/* Create Toastr Parent Wrapper */
const toastr = document.createElement("div");
toastr.id = "toastr";
document.body.appendChild(toastr);
function Toastr({ type, title, message, delay = 2000 }) {
    const toastrItem = document.createElement("div");
    /* Convert Type To Icon FontAwesome 4.5.0 Error 5.0 More Than Version*/
    const icons = {
        success: "check",
        info: "exclamation",
        error: "times",
    }
    toastrItem.classList.add(`toastr`);
    toastrItem.classList.add(type);
    /* Add HTML Component Toastr */
    toastrItem.innerHTML = `
    <a href="" class="toastr_icon">
        <i class="fa fa-${icons[type]}"></i>
    </a>
    <div class="toastr_content">
    <h4 class="toastr_title">${title}</h4>
    <p class="toastr_message">${message}</p>
    </div>
    <a href="" class="toastr_btn_exit">
        <i class="fa fa-times"></i>
    </a>`
    toastr.appendChild(toastrItem);
    /* Clear Toastr Item By Timer */
    const timer = setTimeout(function () {
        toastrItem.remove();
    }, delay);
    /* Clear Toastr Item With Click */
    toastrItem.querySelector(".toastr_btn_exit").onclick = function (e) {
        toastrItem.remove();
        /* Clear Timmer Fix Error When Click Before Time */
        clearTimeout(timer);
        e.preventDefault();
    }
}



/* Handle Fetch */
function Fetch() {

}

Fetch.post = function (url, data = {}) {
    const csrf = $('meta[name="csrf-token"]')
        .getAttribute("content");
    return fetch(url, {
        method: 'POST', // *GET, POST, PUT, DELETE, etc.
        mode: 'cors', // no-cors, *cors, same-origin
        cache: 'no-cache',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json'
            , 'X-CSRF-TOKEN': csrf
        },
        redirect: 'follow',
        referrerPolicy: 'no-referrer',
        body: JSON.stringify(data)
    });
}

Fetch.get = function (url) {
    return fetch(url);
}


/* Handle Dropdown */
function Dropdown() {
    const dropdowns = $$(".dropdown");
    dropdowns.forEach(dropdown => {
        const btnDropDown = dropdown.querySelector('[data-toggle="dropdown"]');
        btnDropDown.onclick = function (e) {
            const dropdownMenu = dropdown.querySelector(".dropdown-menu");
            dropdownMenu.classList.toggle("active");
            e.preventDefault();
        }
    });
}

/* Handle Currency Format */

Number.prototype.currencyFormat = function (currencyType = "VNĐ") {
    return this.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + " " + currencyType;
}

/* Convert Date */

formatFullDate = function (date, sign = "/") {
    const dateNew = new Date(date);
    let dateStr = `${dateNew.getFullYear()}${sign}${dateNew.getMonth()}${sign}${dateNew.getDate()} ${dateNew.getHours()}:${dateNew.getMinutes()}:${dateNew.getSeconds()}`;
    return dateStr;
}

function formatDate(date, sign = "/") {
    const dateNew = new Date(date);
    return `${dateNew.getFullYear()}${sign}${dateNew.getMonth()}${sign}${dateNew.getDate()}`;
}

function convertLinkProduct(product) {
    return `${window.location.origin}/${product.product_id}/${product.product_slug}`;
};



function handleCreateLoaderModal() {
    const modalLoader = document.createElement("div");
    modalLoader.classList.add("modal", "modal-loader", "active");
    const modalDialog = document.createElement("div");
    modalDialog.classList.add("modal-dialog");
    const modalContent = document.createElement("div");
    modalContent.classList.add("modal-content");
    modalContent.innerHTML = `
    <div class="lds-ring loader loader-yellow">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    `;
    modalDialog.append(modalContent);
    modalLoader.append(modalDialog);
    return modalLoader;
}


/* Handle Create Load */
function createLoader(boxMoule) {
    const loader = document.createElement("div");
    const classAdd = 'lds-ring loader loader-dark';
    loader.classList.add(...classAdd.split(" "));
    loader.innerHTML = `<div></div><div></div><div></div><div></div>`;
    boxMoule.append(loader);
    return loader;
}
function removeLoader(boxMoule) {
    const loaders = boxMoule.querySelectorAll(".loader.loader-dark");
    loaders.forEach(loader => loader.remove());
}


function boxDialog() {

}

boxDialog.confirm = function (
    { message, btnTextCancel, btnTextAccept },
    callback) {
    const modalConfirm = document.createElement("div");
    modalConfirm.classList.add("modal", "active", "modal-confirm");
    const modalDialog = document.createElement("div");
    modalDialog.classList.add("modal-dialog", "round-5");
    const modalContent = document.createElement("div");
    modalContent.classList.add("modal-content");
    const confirm = document.createElement("div");
    confirm.classList.add("confirm");
    const confirmContent = document.createElement("p");
    confirmContent.classList.add("confirm-content");
    confirmContent.textContent = message;
    const confirmAction = document.createElement("div");
    confirmAction.classList.add("confirm-action");
    const btnDeny = document.createElement("a");
    btnDeny.classList.add("round-5", "confirm-deny", "btn", "btn-outline-primary");
    btnDeny.textContent = btnTextCancel;
    btnDeny.onclick = function (e) {
        modalConfirm.remove();
        e.preventDefault();
    }
    const btnAccept = document.createElement("a");
    btnAccept.classList.add("round-5", "confirm-accpet", "btn", "text-light", "btn-pink");
    btnAccept.textContent = btnTextAccept;
    btnAccept.onclick = function (e) {
        callback()
        modalConfirm.remove();
        e.preventDefault();
    }
    confirmAction.append(btnDeny, btnAccept);
    confirm.append(confirmContent, confirmAction);
    modalContent.append(confirm);
    modalDialog.append(modalContent);
    modalConfirm.append(modalDialog);
    document.body.append(modalConfirm);
}

