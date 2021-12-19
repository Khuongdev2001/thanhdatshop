function Validator({ form, rules }) {
    const formValidator = document.querySelector(form);
    /* Loop Rules And Add Event Blur Element */
    const selectRules = {};

    function validate(input, rule) {
        const inputRules = selectRules[rule.selector];
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
            /* Add Text Message In HTML */
            const elementMesssage = input.parentElement.querySelector("span");
            elementMesssage.innerHTML = error;
            /* Add Class Css Style Error Of Validate */
            input.classList.add("is-invalid");
            return false;
        }
        /* Remove Class If No Error Blur Next */
        input.classList.remove("is-invalid");
        return true;
    }

    rules.forEach((rule) => {
        const input = formValidator.querySelector(rule.selector);
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
        input.oninput = function () {
            /* Clear Text Message In HTML */
            const elementMesssage = input.parentElement.querySelector("span");
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
            /* Add Error Array If Validate Field */
            if (!validate(input, rule)) {
                errors.push(rule);
            };
        });
        /* Submit If Not Item In Array Errors */
        if (!errors.length) {
            formValidator.submit();
        }
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
    const password = document.querySelector(selectorMatch);
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

Validator.maxLengthValue=function(selector,message,maxValue){
    return {
        selector,
        test:function(value){
            return String(value).length>maxValue ? message : undefined;
        }
    }
}

Validator.minLengthValue=function(selector,message,minValue){
    return {
        selector,
        test:function(value){
            return String(value).length<minValue ? message : undefined;
        }
    }
}

Validator.isNumber=function(selector,message){
    return {
        selector,
        test:function(value){
            return !isNaN(value) ? undefined : message
        }
    }
}

Validator.maxValue=function(selector,message,maxValue){
    return {
        selector,
        test:function(value){
            return value > maxValue ? message : undefined;
        }
    }
}

Validator.isRequiredUpload=function (selector,selectFileOld,message) {
    return {
        selector,
        test:function(value){
            const selectOld=document.querySelector(selectFileOld);
            return (value || selectOld) ? undefined : message;
        }
    }
}