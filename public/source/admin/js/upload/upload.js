function UploadFile({
    selectorBtnUpload,
    selectorInput,
    callbackUpload,
    tests,
    file
}) {
    /* Bắt Sự Kiện Input */
    const inputFile = document.querySelector(selectorInput);
    const btnUploads = document.querySelectorAll(selectorBtnUpload);
    /* Trigger Click To Input File */
    btnUploads.forEach(btnUpload=>{
        btnUpload.onclick = function (e) {
            inputFile.click();
            e.preventDefault();
        }
    })
    /* Show Images Are Available  File */
    if(file){
        UploadFile.createElement(file,"old");
    }
    /* Listening Change Input When Click Upload */
    inputFile.onchange = function (e) {
        /* Validates Pass If True  */
        for (test of tests) {
            if (!test(e.target.files[0])) {
                inputFile.value="";
                return;
            }
        }
        /* Callback When Change File */
        callbackUpload(e);
    }
}


UploadFile.createElement = function (src,type=null) {
    /* Display None Css */
    document.querySelector(".upload-file").style.display = "none";
    /* Create Dom Object */
    const previewUpload = document.createElement("div");
    previewUpload.classList.add("preview-upload");
    const boxThumbnail = document.createElement("div");
    if(type){
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = "imgs[]";
        input.id="file-old";
        input.value = true;
        boxThumbnail.append(input);
    }
    boxThumbnail.classList.add("box-thumbnail");
    const img = document.createElement("img");
    img.src = src;
    const btnRemove = document.createElement("div");
    btnRemove.classList.add("btn-remove");
    btnRemove.innerHTML = `<i class="fa fa-times" aria-hidden="true"></i>`;
    /* Add Event Remove */
    btnRemove.onclick = () => UploadFile.removeElement(previewUpload);
    boxThumbnail.append(img);
    boxThumbnail.append(btnRemove);
    previewUpload.append(boxThumbnail);
    document.querySelector(".upload-widget-wrapper").append(previewUpload);
}

UploadFile.removeElement = function (previewUpload) {
    previewUpload.remove();
    document.querySelector(".upload-file").style.display = "block";
    document.querySelector(".input-file").value = "";
}

UploadFile.validateFileMaxSize = function (size, handleError) {
    return (file) => {
        if (file.size > size) {
            /* Show Error  */
            handleError();
            return false;
        }
        return true;
    }
    /* @pass if true */
}
UploadFile.isImage = function (handleError) {
    return (file) => {
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
        if (!validImageTypes.includes(file.type)) {
           /* Show Error */
           handleError();
           return false;
        }
        return true;
    }
}

