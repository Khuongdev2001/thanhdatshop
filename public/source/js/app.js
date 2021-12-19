"use strict"
const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);
handleSlider({});
handleModal();
handleSetTab();
handleInput();
Dropdown();

/* Handle Login */
Validator({
    form: "#form-login",
    rules: [
        Validator.isRequired("#email", "Email Không Được Bỏ Trống"),
        Validator.isEmail("#email", "Không Phải Định Dạng Email!"),
        Validator.isRequired("#password", "Mật Khẩu Không Bỏ Trống!")
    ],
    handleSubmit: function (fields, formValidator) {
        /* Call Api */
        const routeLogin = window.location.origin + "/login";
        const response = Fetch.post(routeLogin, fields);
        const btnLogin = formValidator.querySelector(".btn-login");
        btnLogin.textContent = "Đang Tải...";
        response.then(data => data.json())
            .then((data) => {
                btnLogin.textContent = "Đăng Nhập";
                if (!data.status) {
                    formValidator.querySelector("#password").value = null;
                    return Toastr({ type: "error", title: "error", message: data.message });
                }
                setTimeout(() => {
                    window.location.reload();
                }, 500);
                return Toastr({ type: "success", title: "success", message: data.message });
            })
    }
});
/* Handle Reg And Update */
(function () {
    const rules = [
        Validator.isRequired("#fullname", "Không Được Để Trống Họ Và Tên!"),
        Validator.minLengthValue("#fullname", "Họ và Tên Tối Thiểu 5 Từ!", 5),
        Validator.maxLengthValue("#fullname", "Họ và Tên Tối Đa 30 Từ!", 30),
        Validator.isRequired("#email", "Không Được Để Trống Email!"),
        Validator.minLengthValue("#email", "Email Tối Thiểu 5 Từ!", 5),
        Validator.maxLengthValue("#email", "Email Tối Đa 30 Từ!", 30),
        Validator.isEmail("#email", "Sai Định Dạng Email!"),
        Validator.isRequired("#password", "Không Được Để Trống Mật Khẩu!"),
        Validator.minLengthValue("#password", "Mật Khẩu Tối Thiểu 5 Từ!", 5),
        Validator.maxLengthValue("#password", "Mật Khẩu Tối Đa 30 Từ!", 30),
        Validator.isRequired("#password_confirm", "Không Được Để Trống Mật Khẩu!"),
        Validator.isConfirm("#password_confirm", "#password", "Mật Khẩu Xác Thực Không Khớp!"),
    ];
    /* Handle Validate Reg */
    Validator({
        form: "#form-reg",
        rules,
        handleSubmit: function (fields, formValidator) {
            /* Call Api */
            const routeReg = window.location.origin + "/reg";
            const response = Fetch.post(routeReg, fields);
            const btnReg = formValidator.querySelector(".btn-reg");
            btnReg.textContent = "Đang Tải...";
            btnReg.disabled = true;
            response.then(data => data.json())
                .then((data) => {
                    btnReg.textContent = "Đăng Ký";
                    if (!data.status) {
                        setTimeout(() => {
                            btnReg.disabled = false;
                        }, 500);
                        return Toastr({ type: "error", title: "error", message: data.message });
                    }
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                    return Toastr({ type: "success", title: "success", message: data.message });
                })
        }
    });
    /* Handle Validate Update Info */

    Validator({
        form: "#form-update-account",
        rules,
        handleSubmit: function (fields, formValidator) {
            /* Call Api */
            const routeUpdate = window.location.origin + "/account";
            const response = Fetch.post(routeUpdate, fields);
            const btnUpdate = formValidator.querySelector(".btn-update");
            btnUpdate.textContent = "Đang Tải...";
            btnUpdate.disabled = true;
            response.then(data => data.json())
                .then((data) => {
                    btnUpdate.textContent = "Lưu Thay Đổi";
                    if (!data.status) {
                        setTimeout(() => {
                            btnUpdate.disabled = false;
                        }, 500);
                        return Toastr({ type: "error", title: "error", message: data.message });
                    }
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                    return Toastr({ type: "success", title: "success", message: data.message });
                })
        }
    })
    /* Handle Change Password Page Account */
    Validator({
        form: "#form-change-password",
        rules: [
            Validator.minLengthValue("#password", "Mật Khẩu Tối Thiểu 5 Từ!", 5),
            Validator.maxLengthValue("#password", "Mật Khẩu Tối Đa 30 Từ!", 30),
            Validator.isRequired("#password_confirm", "Không Được Để Trống Mật Khẩu!"),
            Validator.isConfirm("#password_confirm", "#password", "Mật Khẩu Xác Thực Không Khớp!"),
        ],
        handleSubmit: function (fields, formValidator) {
            /* Call Api */
            const routerChange = window.location.origin + "/account/password";
            const response = Fetch.post(routerChange, fields);
            const btnChange = formValidator.querySelector(".btn-change");
            btnChange.textContent = "Đang Tải...";
            btnChange.disabled = true;
            response.then(data => data.json())
                .then((data) => {
                    btnChange.textContent = "Thay Đổi";
                    if (!data.status) {
                        setTimeout(() => {
                            btnChange.disabled = false;
                        }, 500);
                        return Toastr({ type: "error", title: "error", message: data.message });
                    }
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                    return Toastr({ type: "success", title: "success", message: data.message });
                })
        }
    })

    /* Handle Validate User Address Add */
    Validator({
        form: "#form-add-address",
        rules: [
            Validator.isRequired("#fullname", "Không Được Để Trống Họ Và Tên!"),
            Validator.minLengthValue("#fullname", "Họ và Tên Tối Thiểu 5 Từ!", 5),
            Validator.maxLengthValue("#fullname", "Họ và Tên Tối Đa 30 Từ!", 30),
            Validator.isRequired("#phone", "Không Được Để Trống SĐT!"),
            Validator.isPhone("#phone", "Không Phải Định Dạng SĐT!", 5),
            Validator.isRequired("#province", "Không Được Để Trống Tỉnh/Tp!"),
            Validator.isRequired("#district", "Không Được Để Trống Quận/Huyện!"),
            Validator.isRequired("#commune", "Không Được Để Trống Phường/Xã!"),
            Validator.isRequired("#address", "Không Được Để Trống Địa Chỉ!")

        ]
    })
})();


/* Handle Show Country */
(function () {
    const provinceElement = $("#province");
    const districtElement = $("#district");
    const communeElement = $("#commune");
    if (provinceElement) {
        const route = window.location.origin;
        provinceElement.addEventListener("change", function (e) {
            communeElement.innerHTML = "<option value>Chọn Xã</option>";
            handleSetValue.call(districtElement, { id: e.target.value, type: "district" });
        })
        districtElement.addEventListener("change", function (e) {
            handleSetValue.call(communeElement, { id: e.target.value, type: "commune" });
        })
        /* Is Value Default */
        if (provinceElement.value) {
            handleSetValue.call(provinceElement, {
                type: "province",
                callback: function () {
                    handleSetValue.call(districtElement, {
                        id: provinceElement.value, type: "district",
                        callback: function () {
                            handleSetValue.call(communeElement, {
                                id: districtElement.value, type: "commune"
                            });
                        }
                    });
                }
            });
        }
        /* No Value Default */
        else {
            provinceElement.onclick = function () {
                handleSetValue.call(provinceElement, { type: "province" });
                this.onclick = null;
            };
        }
        function handleSetValue({ id = "", type, callback = () => null }) {
            if (["province", "district", "commune"].indexOf(type) == -1) {
                throw ("type not value");
            }
            const convertTexts = { province: "Chọn Tỉnh", district: "Chọn Huyện", commune: "Chọn Xã" };
            const valueDefault = this.value;
            Fetch.get(`${route}/api/${type}/${id}`)
                .then(data => data.json())
                .then(data => {
                    if (data.status) {
                        let textSelect = `<option value>${convertTexts[type]}</option>`;
                        data.data.forEach(data => {
                            /* province_id province_name */
                            textSelect += `<option value="${data[type + "_id"]}"
                                    ${valueDefault == data[type + "_id"] && "selected"}>
                                    ${data[type + "_name"]}</option>`;
                        });
                        this.innerHTML = textSelect;
                        callback();
                    }
                });
        }
    }
})();

/* Handle Lazy */
(function () {
    const lazys = $$(".lazy");
    let options = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    }
    let observer = new IntersectionObserver(callback, options);
    /* Loop Active Lazy Element */
    lazys.forEach(lazy => {
        observer.observe(lazy);
    })
    function callback(obs) {
        obs.forEach(ob => {
            if (ob.isIntersecting) {
                const url = ob.target.getAttribute("data-src");
                ob.target.src = url;
                ob.target.removeAttribute("data-src");
                ob.target.classList.remove("lazy");
                observer.unobserve(ob.target);
                const sliderItem = ob.target.parentElement.parentElement;
                const loaders = sliderItem.querySelectorAll(".loader");
                loaders.forEach(loader => loader.remove());

            }
        })
    }
})();

/* Handle Loading Api Product */
(function () {
    const router = window.location.origin;
    /* Create Lazy */
    const loadDatas = $$(".load-data");
    let options = {
        root: null,
        rootMargin: '40px 0px 0px 0px',
        threshold: 0.1
    }
    let observer = new IntersectionObserver(callbackObserver, options);
    /* Loop Active Lazy Element */
    loadDatas.forEach(loadData => {
        handleClickCatShowProduct(loadData);
        observer.observe(loadData);
    })
    function callbackObserver(obs) {
        obs.forEach(ob => {
            if (!ob.isIntersecting) {
                return;
            }
            const boxModule = ob.target;
            const catId = boxModule.getAttribute("data-cat");
            /* Handle Product */
            if (boxModule.classList.contains("load-product")) {
                const api = `${router}/api/v2/product/list?cat_id=${catId}`;
                handleAppendModule(boxModule, api, handleRenderProduct,
                    function () {
                        /* Call When Api Success */
                        const loader = boxModule.querySelector(".loader");
                        loader && loader.remove();
                    });
            }
            /* Handle Post */
            else if (boxModule.classList.contains("load-post")) {
                const api = `${router}/api/v2/post/list?cat_id=${catId}`;
                handleAppendModule(boxModule, api,
                    handlerRenderPost,
                    function () {
                        /* Call When Api Success */
                        /* Call When Api Success */
                        const loader = boxModule.querySelector(".loader");
                        loader && loader.remove();
                    })
            }
            /* Clear Observe */
            observer.unobserve(boxModule);
        })
    }

    /* Handle Call Api Create Element Product */
    function handleAppendModule(boxModule, api, handleRenderDom, callback) {
        let btnSeeMore = boxModule.querySelector(".btn-see-more");
        Fetch.get(api)
            .then(data => data.json())
            .then(data => {
                if (data.status) {
                    /* Handle Create Dom Module*/
                    handleRenderDom(boxModule, data);
                    /* Call Function Callback */
                    callback(boxModule);
                    /* Check Btn SeeMore */
                    if (data.data.next_page_url) {
                        if (!btnSeeMore) {
                            btnSeeMore = document.createElement("button");
                            btnSeeMore.classList.add("btn", "btn-yellow", "btn-round", "btn-see-more");
                            btnSeeMore.setAttribute("data-paginate", data.data.current_page + 1);
                            /* Add Event Btn See More */
                            btnSeeMore.onclick = function (e) {
                                /* next_page_url customer backend no use data.data.next_page_url */
                                handleSeeMore(boxModule, data.next_page_url,
                                    this,
                                    handleRenderDom);
                                e.preventDefault();
                            };
                            btnSeeMore.innerHTML = "Xem Thêm";
                            const boxBtn = document.createElement("div");
                            boxBtn.classList.add("text-center");
                            boxBtn.append(btnSeeMore);
                            boxModule.append(boxBtn);
                        }
                        else {
                            btnSeeMore.setAttribute("data-paginate", data.data.current_page + 1);
                            /* next_page_url customer backend no use data.data.next_page_url */
                            btnSeeMore.onclick = function (e) {
                                /* Block If Loading */
                                if (!this.disabled) {
                                    handleSeeMore(boxModule, data.next_page_url,
                                        this,
                                        handleRenderDom);
                                }
                                e.preventDefault();
                            };
                        }
                    }
                    else {
                        btnSeeMore && btnSeeMore.remove();
                    }
                }
            });
    }
    /*Call When HandleAppendModule Call Api Success. Render Dom Product Append Dom To BoxProduct*/
    function handleRenderProduct(boxModule, data) {
        const parentFragment = document.createDocumentFragment();
        const products = data.data.data;
        products.forEach(product => {
            let productClassName = "product col-hero-lg-3 col-hero-xl-2 col-hero-2 col-hero-md-4 col-hero-sm-6";
            /* Add Class Hot If Product Type 1 */
            product.product_type && productClassName + "hot";
            const productElement = document.createElement("div");
            productElement.classList.add(...productClassName.split(" "));
            let childrenProduct = `
                <a href="${convertLinkProduct(product)}" class="product-thumbnail img-ratio d-block">
                    <img src="${data.asset}${product.url}"  class="thumbnail w-100">
                </a>
                <p>
                    <a href="${convertLinkProduct(product)}" class="product-title d-block">${product.product_title}</a>
                </p>
                <div class="box-info">
                    <div class="box-star">
                        <span class="star"><i class="fas fa-star"></i></span>
                        <span class="star"><i class="fas fa-star"></i></span>
                        <span class="star"><i class="fas fa-star"></i></span>
                        <span class="star"><i class="fas fa-star"></i></span>
                        <span class="star"><i class="fas fa-star"></i></span>
                    </div>
                    <span class="buyed">Đã Bán:14</span>
                </div>
                <div class="box-price">
                    <span class="price">${product.price ? product.price.currencyFormat() : "Chưa Cập Nhật"}</span>
                    <div class="box-discount">
                        <span class="num">${product.percer ? `-${product.percer}%` : "?"}</span>
                    </div>
                </div>
                <a href="javascript:void(0)" class="btn-add-card">Thêm Giỏ Hàng</a>
            `
            productElement.innerHTML = childrenProduct;
            /* Handle Add Event Add Cart Module */
            productElement.querySelector(".btn-add-card").
                onclick = function () {
                    handleChangeCart({
                        id: product.product_id
                    })
                }
            parentFragment.append(productElement)
        });
        /* Append Dom Box Product And Remove Loader */
        boxModule.querySelector(".products").append(parentFragment);
    }

    /*Call When HandleAppendModule Call Api Success. Render Dom Post Append Dom To BoxPost*/
    function handlerRenderPost(boxModule, data) {
        const parentFragment = document.createDocumentFragment();
        const posts = data.data.data;
        posts.forEach((post, index) => {
            let postClassName = "post col-lg-3 col-xl-2 col-md-4 col-sm-6";
            /* Class Post First Only Post */
            const postElement = document.createElement("div");
            postElement.classList.add(...postClassName.split(" "));
            const childrenPost =
                `
                <a href="${routerWeb.postDetails(post.post_slug)}" class="box-thumbnail d-block">
                    <img src="${data.asset}${post.post_thumbnail}" class="thumbnail w-100">
                </a>
                <div class="info">
                    <h3 class="title">${post.post_title}</h3>
                    <p class="description">${post.post_description}</p>
                </div>
                <div class="box-bottom">
                    <span class="date-created">Ngày đăng: ${formatDate(post.created_at)}</span>
                    <span class="author">${post.fullname}</span>
                </div>
            `
            postElement.innerHTML = childrenPost;
            parentFragment.append(postElement);
        });
        boxModule.querySelector(".posts").append(parentFragment);
    }

    /* Handle See More Product */
    function handleSeeMore(boxModule, nextUrl, btnSeeMore, handleRenderDom) {
        btnSeeMore.textContent = "Đang Tải...";
        btnSeeMore.disabled = true;
        handleAppendModule(boxModule, nextUrl,
            handleRenderDom,
            function () {
                /* Call When Api Success */
                btnSeeMore.textContent = "Xem Thêm";
                /* Unclock If Render Dom */
                btnSeeMore.disabled = false;
            });
    }

    /* Handle Click Cat Show Product Module Home */
    function handleClickCatShowProduct(loadData) {
        const catItems = loadData.querySelectorAll(".top-cat .cat-item");
        let loaded = true;
        catItems.forEach(catItem => {
            catItem.onclick = handleClick;
        });
        function handleClick(e) {
            /* Only Load 1 Loaded */
            if (this.classList.contains("active") || !loaded) {
                /* Block Click If Item Active */
                return;
            }
            /* Remove Class Active Before */
            loadData.querySelectorAll(".top-cat .cat-item.active")
                .forEach(item => {
                    item.classList.remove("active");
                });
            /* Add Class Active New */
            this.classList.add("active");
            const catId = this.getAttribute("data-cat");
            /* Remove Btn SeeMore */
            loadData.querySelectorAll(".text-center").forEach(boxBtn => {
                boxBtn.remove();
            });
            /* Clear Products */
            loadData.querySelector(".products").innerHTML = null;
            const loader = createLoader(loadData);
            loaded = false;
            const api = `${router}/api/v2/product/list?cat_id=${catId}`;
            /* Call Api */
            handleAppendModule(loadData, api,
                handleRenderProduct,
                function () {
                    /* Call When Success */
                    loader.remove();
                    loaded = true;
                });
            e.preventDefault();
        }
    }
    /* Handle Field Cat Product Module Product List */
    function handleFieldProduct(selectorBoxMoule, selectorFields) {
        const fieldsResult = {};
        let loaded = true;
        /* Handle Set Value URL */
        $$(selectorBoxMoule).forEach(boxModule => {
            const router = window.location.origin;
            let api = `${router}/api/v2/product/list`;
            const boxOuterProduct = boxModule.querySelector(".box-product")
            const boxProduct = boxOuterProduct.querySelector(".products");
            /* Handle First Set Value Default */
            const queryRaw = window.location.search;
            const params = new URLSearchParams(queryRaw);
            const fieldDefaults = {};
            for (const param of params) {
                /**
                 * ['search', 'vì anh thương m']
                 * ['cat_id', '8']
                 */
                const checkCheckBox = boxModule.querySelector(`[name='${param[0]}']`);
                if (checkCheckBox && checkCheckBox.type == "checkbox") {
                    param[1] = param[1].split(",");
                }
                fieldDefaults[param[0]] = param[1];
            }

            /* Handle Query Default */
            handleAppendModule(boxOuterProduct, `${api}${queryRaw}`,
                handleRanderProductField, function () {
                    removeLoader(boxOuterProduct);
                });
            /* Loop Selector */
            selectorFields.forEach(selectorField => {
                boxModule.querySelectorAll(selectorField)
                    .forEach(input => {
                        /* If Input CheckBox */
                        if (input.type == "checkbox") {
                            /* If CheckBox Always Start With Empty Array */
                            if (!Array.isArray(fieldsResult[input.name])) {
                                fieldsResult[input.name] = [];
                            };
                            /* If CheckBox In Value Push To Array Define*/
                            if (Array.isArray(fieldDefaults[input.name])) {
                                const indexField = fieldDefaults[input.name]
                                    .indexOf(input.value);
                                /*Defalt Input Check Is Set True @value=true|false*/
                                if (indexField != -1) {
                                    fieldsResult[input.name].push(fieldDefaults[input.name][indexField]);
                                    input.checked = true;
                                }
                            }
                            /* If Input Text */
                        } else if (input.type == "radio") {
                            /*@value true|false*/
                            input.checked = fieldDefaults[input.name] == input.value;
                        } else {
                            /* Set Value Default */
                            fieldDefaults[input.name] ?
                                input.value = fieldDefaults[input.name] :
                                null;
                            fieldsResult[input.name] = input.value;
                        }
                        input.addEventListener("change", handleChangeInput);
                    });
            })
            function handleChangeInput(e) {
                const field = fieldsResult[e.target.name];
                if (Array.isArray(field)) {
                    const indexFields = field.indexOf(e.target.value);
                    if (indexFields == -1) {
                        field.push(e.target.value);
                    }
                    else {
                        field.splice(indexFields, 1);
                    }
                }
                else {
                    fieldsResult[e.target.name] = e.target.value;
                }
                const timer = setInterval(() => {
                    if (document.documentElement.scrollTop <= 100) {
                        clearInterval(timer);
                    }
                    document.documentElement.scrollTop -= 10;
                });
                handlePushHistory();
            }
            function handlePushHistory() {
                /* Loop Field Search Push History */
                const url = new URL(window.location);
                for (let field in fieldsResult) {
                    url.searchParams.set(field, fieldsResult[field]);
                }
                window.history.pushState({}, null, url);
                /* Get Query URL */
                const queryRaw = window.location.search;
                /* Handle Query Change */
                boxProduct.innerHTML = null;
                createLoader(boxOuterProduct);
                handleAppendModule(boxOuterProduct, `${api}${queryRaw}`,
                    handleRanderProductField, function () {
                        /* Call When Api Success */
                        removeLoader(boxOuterProduct);
                        loaded = true;
                    });
            }
        })

        function handleRanderProductField(boxModule, data) {
            const parentFragment = document.createDocumentFragment();
            const products = data.data.data;
            products.forEach(product => {
                let productClassName = "product col-lg-3 col-md-4 col-sm-6";
                /* Add Class Hot If Product Type 1 */
                product.product_type && productClassName + "hot";
                const productElement = document.createElement("div");
                productElement.classList.add(...productClassName.split(" "));
                let childrenProduct = `
                <a href="" class="product-thumbnail img-ratio d-block">
                    <img src="${data.asset}${product.url}"  class="thumbnail w-100">
                </a>
                <p>
                    <a href="${product.product_slug}" class="product-title d-block">${product.product_title}</a>
                </p>
                <div class="box-info">
                    <div class="box-star">
                        <span class="star"><i class="fas fa-star"></i></span>
                        <span class="star"><i class="fas fa-star"></i></span>
                        <span class="star"><i class="fas fa-star"></i></span>
                        <span class="star"><i class="fas fa-star"></i></span>
                        <span class="star"><i class="fas fa-star"></i></span>
                    </div>
                    <span class="buyed">Đã Bán:14</span>
                </div>
                <div class="box-price">
                    <span class="price">${product.price
                        ? product.price.currencyFormat()
                        : "Chưa Cập Nhật"}</span>
                    <div class="box-discount">
                        <span class="num">${product.percer
                        ? `${product.percer}%`
                        : "?"}</span>
                    </div>
                </div>
                <a href="" class="btn-add-card">Thêm Giỏ Hàng</a>
            `
                productElement.innerHTML = childrenProduct;
                parentFragment.append(productElement)
                /* Hanle Add Event Add Cart */
                productElement.querySelector(".btn-add-card").onclick = function (e) {
                    handleChangeCart({
                        id: product.product_id
                    })
                    e.preventDefault();
                }
            });
            /* Product None */
            if (!products[0]) {
                const productEmpty = `
                <div class="col-12 bg-yellow my-30 p-20 round-5 text-center">
                    Không Có Sản Phẩm Nào
                </div>`
                return boxModule.querySelector(".products")
                    .innerHTML = productEmpty;
            }
            /* Append Dom Box Product And Remove Loader */
            boxModule.querySelector(".products").append(parentFragment);
        }
    }
    handleFieldProduct(".product-box.product-filter", [
        "#search",
        "[name='cat_id']",
        "[name='brand_id']",
        "[name='price']",
        "[name='price_sort']"
    ], [
        "[name='price']:checked"
    ]);

    /* ============================ Module Cart ================================ */
    /* Handle Add Cart */
    function handleChangeCart(fields, callback = () => null) {
        /* Create Animation */
        const api = `${window.location.origin}/cart/change`;
        const ElementLoader = handleCreateLoaderModal();
        document.body.append(ElementLoader);
        const urlRequest = new URL(api);
        /* Loop Fields Add Paramater */
        for (let field in fields) {
            urlRequest.searchParams.set(field, fields[field]);
        };
        Fetch.get(urlRequest.href)
            .then(data => data.json())
            .then(cart => {
                ElementLoader.remove();
                if (cart.status) {
                    const boxCart = $(".box-cart .cart-num");
                    boxCart.textContent = cart.cartInfo.totalQty
                    callback(cart);
                    return Toastr({
                        type: "success",
                        title: "Success",
                        delay: 500,
                        message: cart.message
                    });
                }
                Toastr({
                    type: "error",
                    title: "Success",
                    message: cart.message
                })
            });
    }

    /* Handle Done Add Cart */
    function handleUpdateDomCart(cart) {
        /* Check Update Module Page List Cart */
        const wpCart = $("#wp-cart");
        if (wpCart) {
            const prices = wpCart
                .querySelectorAll(".total-price,.total-price-temporary");
            prices.forEach(price => {
                price.textContent = Number(cart.cartInfo.totalPrice).currencyFormat();
            })
            /* Update Total Qty */
            const qtys = wpCart.querySelectorAll(".total-qty");
            qtys.forEach(qty => {
                qty.textContent = cart.cartInfo.totalQty;
            })
        }
    }

    /* Handle Change Cart In Moudle Cart */
    function handleSetValueCart() {
        $$("#wp-cart .form-group-qty").forEach(formQty => {
            const id = formQty.getAttribute("data-id") ?? null;
            /* Query Parent Node */
            const cartItemDom = formQty.closest(".cart-item");
            const numElement = formQty.querySelector(".qty");
            const btns = formQty.querySelectorAll(".btn-decrease,.btn-increase");
            btns.forEach(btn => {
                btn.onclick = function (e) {
                    e.preventDefault();
                    let qty = this.classList.contains("btn-increase") ? -1 : 1;
                    console.log(qty);
                    let num = isNaN(numElement.value) ? 0 : Number(numElement.value);
                    /* Check Cart Item Deleted */
                    if (!(num + qty)) {
                        return boxDialog.confirm({
                            message: "Bạn muốn xoá sản phẩm này?",
                            btnTextAccept: "Xóa",
                            btnTextCancel: "Không",
                        }, function () {
                            /* Handle Delete */
                            handleDeleteApiCart({
                                id
                            }, function (cart) {
                                /* Reload If No Item Cart */
                                if (!cart.cartInfo.totalQty) {
                                    return window.location.reload();
                                }
                                if (cart.status) {
                                    /* Delete Element */
                                    cartItemDom.remove();
                                    handleUpdateDomCart(cart);
                                }
                            })
                        })
                    }
                    numElement.value = num + qty;
                    /* Request Api */
                    handleChangeCart({
                        id,
                        qty
                    }, function (cart) {
                        /* Call When Api Success */
                        const totalPriceItem = cartItemDom.querySelectorAll(".col-table-4");
                        handleUpdateDomCart(cart);
                        /* Handle Update Price By Product Id */
                        totalPriceItem.forEach(item => {
                            item.textContent = Number(cart.cartItem.total_price)
                                .currencyFormat();
                        })
                    });
                }
            })
        })
    }

    /* Hanlde Delete Cart With Api Backend Module Cart */
    function handleDeleteApiCart(fields, callback = () => null) {
        /* Create Animation */
        const api = `${window.location.origin}/cart/delete`;
        const ElementLoader = handleCreateLoaderModal();
        document.body.append(ElementLoader);
        const urlRequest = new URL(api);
        /* Loop Fields Add Paramater */
        for (let field in fields) {
            urlRequest.searchParams.set(field, fields[field]);
        };
        Fetch.get(urlRequest.href)
            .then(data => data.json())
            .then(cart => {
                ElementLoader.remove();
                if (cart.status) {
                    const boxCart = $(".box-cart .cart-num");
                    boxCart.textContent = cart.cartInfo.totalQty
                    callback(cart);
                    return Toastr({
                        type: "success",
                        title: "Success",
                        delay: 500,
                        message: cart.message
                    });
                }
                Toastr({
                    type: "error",
                    title: "Success",
                    message: cart.message
                })
            });
    }

    /* Handle Click Btn Delete Cart Session Module Cart */
    function handleClickDeleteCart() {
        $$("#wp-cart").forEach(wpCart => {
            wpCart.querySelectorAll(".btn-delete").forEach(btnDelete => {
                btnDelete.onclick = function (e) {
                    const id = this.getAttribute("data-id") ?? null;
                    /* Query Parent Node */
                    const cartItemDom = this.closest(".cart-item");
                    boxDialog.confirm({
                        message: "Bạn muốn xoá sản phẩm này?",
                        btnTextAccept: "Xóa",
                        btnTextCancel: "Không",
                    }, function () {
                        /* Handle Delete */
                        handleDeleteApiCart({
                            id
                        }, function (cart) {
                            /* Reload If No Item Cart */
                            if (!cart.cartInfo.totalQty) {
                                return window.location.reload();
                            }
                            if (cart.status) {
                                /* Delete Element */
                                cartItemDom.remove();
                                handleUpdateDomCart(cart);
                            }
                        })
                    })
                    e.preventDefault();
                }
            })
        });
    }
    /* Handle Show More History Order Module Cart */
    function handleShowMoreHistoryCart() {
        /* Define cartStatus get All */
        let cartStatus = "";
        let isDisable = false;
        $$(".table-products-mobile.load-data").forEach(boxModule => {
            const loaderFirst = boxModule.querySelector(".text-center");
            const orderBody = boxModule.querySelector(".table-body");
            /* Handle Set Url Api Param cartStatus So Save cartStatus when click */
            function handleSetApi({ page = 1 } = {},
                callback = () => null) {
                const router = window.location.origin;
                const api = `${router}/cart/history/raw?page=${page}&cartStatus=${cartStatus}`;
                handleRenderProduct(api, callback);
            }
            /* Hanlde Option Observe */
            let options = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            }
            /* Handle Render Product */
            function handleRenderProduct(api, callback) {
                Fetch.get(api)
                    .then(cart => cart.json())
                    .then(data => {
                        const carts = data.data.data;
                        const boxFrament=document.createElement("div");
                        if(!carts){
                            /* Defind Children Box Html When None Data */
                            boxFrament.innerHTML = `<p class="text-center fs-13">Không Có Dữ Liệu!</p>`;
                        }
                        carts.forEach(cart => {
                            const cartHtml = `
                                <div class="order-head fs-13">
                                    <span class="type">${data.cartStatus[cart.cart_status]}</span>
                                    <span class="date">${formatFullDate(cart.created_at, "-")}</span>
                                </div>
                                <div class="order-body">
                                    <div class="product my-20">
                                        <a href="" class="box-thumbnail round-5">
                                            <img src="${data.asset}${cart.url}" class="w-100 thumbnail">
                                        </a>
                                        <div class="product-info">
                                            <a href="" class="product-name mb-10">${cart.product_title}</a>
                                            <span class="num">${cart.total_product} sản phẩm</span>
                                            <span class="price">${Number(cart.total_price).currencyFormat()}</span>
                                        </div>
                                    </div>
                                    <div class="box-action">
                                        <a href="${routerWeb.cartOrder(cart.cart_id)}"
                                        class="btn btn-round btn-pink btn-details btn-outline">Xem Chi Tiết</a>
                                        <a href="${routerWeb.productDetails(cart.product_id, cart.product_slug)}"
                                        class="btn btn-round btn-pink btn-ouline btn-outline btn-rebuy">Mua Lại</a>
                                    </div>
                                </div>
                            `;
                            const orderItem=document.createElement("div");
                            orderItem.classList.add("order-item", "bg-light","p-15");
                            orderItem.innerHTML=cartHtml;
                            boxFrament.append(orderItem);
                        })
                        callback(carts);
                        orderBody.append(boxFrament);
                        /* Check Add Seemore */
                        if (data.data.next_page_url) {
                            /* Add Loader HTML */
                            const loader = document.createElement("div");
                            loader.classList.add("text-center");
                            loader.innerHTML = `
                            <div class="lds-ring loader loader-dark">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>`;
                            boxModule.append(loader);
                            /* Add Observe Loader Next */
                            handleObserve(loader, function () {
                                /* So Page Current Want Next Should Page Current + 1 */
                                handleSetApi({ page: data.data.current_page + 1 }, function (data) {
                                    /* Call When Api Success*/
                                    loader.remove();
                                });
                            })
                        }
                    });
            }
            /* Handle Observe LoadMore */
            function handleObserve(target, callback) {
                let observer = new IntersectionObserver(function (obs) {
                    obs.forEach(ob => {
                        if (!ob.isIntersecting) {
                            return;
                        }
                        callback();
                        observer.unobserve(target);
                    });
                }, options);
                /* Add Observe Give Btn Load More Fist */
                observer.observe(target);
            }
            /* Handle Observe First Loading */
            handleObserve(loaderFirst, function () {
                handleSetApi({}, function (data) {
                    /* Call When Api Success*/
                    loaderFirst.remove();
                });
            });
            /* Add Event Click Status */
            const btnStatus = boxModule.querySelectorAll(".order-types .btn-status");
            btnStatus.forEach(btn => {
                btn.onclick = function (e) {
                    /* Fix Error OverLoad */
                    if (!isDisable && !this.classList.contains("active")) {
                        boxModule.querySelector(".order-types .btn-status.active")
                            .classList.remove("active");
                        /* Add Active Class New */
                        this.classList.add("active");
                        cartStatus = this.getAttribute("data-status") ?? "";
                        handleSetApi({ page: 1 }, function () {
                            orderBody.innerHTML = '';
                            isDisable = false;
                        })
                        isDisable = true;
                    }
                    e.preventDefault();
                }
            })
        })
    }
    handleClickDeleteCart();
    handleSetValueCart();
    handleShowMoreHistoryCart();
    /* ============================ End Module Cart ================================ */

    /*============================= Module Product============================ */
    function handleSetValueProduct() {
        $$("#box-product-details .form-group-qty").forEach(formQty => {
            const numElement = formQty.querySelector(".qty");
            const btns = formQty.querySelectorAll(".btn-decrease,.btn-increase");
            btns.forEach(btn => {
                btn.onclick = function (e) {
                    let qty = this.classList.contains("btn-increase") ? -1 : 1;
                    let num = isNaN(numElement.value)
                        ? 0
                        : Number(numElement.value);
                    /* Check Cart Item Deleted */
                    numElement.value = (num + qty) <= 0 ? 1 : num + qty;
                    /* Request Api */
                    e.preventDefault();
                }
            })
        })
        
        /* Handle Click Add Cart */
        $$(".btn-add-card").forEach(btn => {
            btn.onclick = function (e) {
                const id = this.getAttribute("data-id") ?? null;
                const fields = { id };
                const checkBoxDetails = this.closest("#box-product-details");
                if (checkBoxDetails) {
                    fields.qty=checkBoxDetails.querySelector(".qty").value;
                }
                handleChangeCart(fields);
                e.preventDefault();
            }
        })
    }
    handleSetValueProduct();
})();

(function () {
    /* Handle Delete User Address */
    $$(".address-action .btn-delete").forEach(btnDelete => {
        btnDelete.onclick = function () {
            const id = this.getAttribute("data-id") ?? 0;
            boxDialog.confirm({
                message: "Bạn muốn xoá địa chỉ này",
                btnTextAccept: "Xóa",
                btnTextCancel: "Không"
            }, () => {
                const route = window.location.origin;
                const api = `${route}/account/address/delete/${id}`;
                Fetch.get(api)
                    .then(data => data.json())
                    .then(data => {
                        if (data.status) {
                            this.closest(".address-item").remove();
                            Toastr({
                                type: "success",
                                title: "Success",
                                message: data.messag
                            });
                        };
                    });
            })
        }
    })
})();

(function () {
    const boxMenuMobile = $("#box-menu-mobile");
    /* Handle Menu Mobile */
    $$("#box-menu-mobile #main-menu-mobile .icon").forEach(btn => {
        btn.onclick = function (e) {
            this.parentElement.classList.toggle("active");
            e.preventDefault();
        }
    });
    $(".btn-open-menu-mobile").onclick = function (e) {
        boxMenuMobile.classList.add("active");
        e.preventDefault();
    }
    boxMenuMobile.querySelector(".btn-exit").onclick = function (e) {
        boxMenuMobile.classList.remove("active");
        e.preventDefault();
    }
})()