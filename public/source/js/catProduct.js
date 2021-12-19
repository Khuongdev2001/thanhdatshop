/* Show filter case */
$(".btn-show-filter").onclick = function (e) {
    const domTarget = e.target.getAttribute("data-target");
    $(domTarget).classList.add("active");
    const exitSidebars = $$(".sidebar-dialog,.btn-sidebar-exit");
    exitSidebars.forEach(element=>{
        element.onclick = function(e){
            $(domTarget).classList.remove("active");
            e.preventDefault();
        };
    })
    e.preventDefault();
}

/* Close filter case */
