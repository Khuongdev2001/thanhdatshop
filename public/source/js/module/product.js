/* Handle PreView Thumbnail Slider */
function handleSliderPreview(selectorBoxParent) {
    $$(selectorBoxParent).forEach(boxParent => {
        const preview = boxParent.querySelector(".slider-preview img");
        /* Put Slider Active To Preview */
        const sliderActive = boxParent
            .querySelector(".slider-paginate .slider-link.active img");
        preview.src = sliderActive.src;
        const sliderItems = boxParent.querySelectorAll(".slider-paginate .slider-item");
        sliderItems.forEach(sliderItem => {
            sliderItem.onclick = function (e) {
                boxParent.querySelector(".slider-link.active")
                    .classList.remove("active");
                this.querySelector(".slider-link").classList.add("active");
                preview.src = this.querySelector("img").src;
            }
        });
    });
}

handleSliderPreview(".product-slider")