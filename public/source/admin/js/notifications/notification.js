/* Create Toastr Parent Wrapper */
const toastr = document.createElement("div");
toastr.id = "toastr";
document.body.appendChild(toastr);
function Toastr({ type, title, message, delay = 2000}) {
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