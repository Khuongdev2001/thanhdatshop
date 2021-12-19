/* Handle Module Comment */
(function () {
    const wpCommentDomS = $$(".box-comment");
    let options = {
        root: null,
        rootMargin: '40px 0px 0px 0px',
        threshold: 0.1
    }
    wpCommentDomS.forEach(wpCommentDom => {
        let observer = new IntersectionObserver(callbackObserver, options);
        observer.observe(wpCommentDom);
        const moduleName = wpCommentDom.getAttribute("data-module");
        const router = `${window.location.origin}/${moduleName}`;
        function callbackObserver(obs) {
            obs.forEach(ob => {
                if (!ob.isIntersecting) {
                    return;
                }
                handleSetParam({
                    module_id: moduleId
                }, function (data) {
                    /* Handle Render Module */
                    handleRenderModule(ob.target.querySelector(".wp-comment"), data);
                });
                /* Clear Observe */
                observer.unobserve(wpCommentDom);
            })
        }
        /* Handle Submit Comment New */
        const formDom = wpCommentDom.querySelector("form");
        const textCommentDom = formDom.querySelector("#comment_content");
        const moduleId = wpCommentDom.getAttribute("data-id");
        formDom.onsubmit = function (e) {
            addComentApi({
                comment_content: textCommentDom.value,
                module_id: moduleId
            }, function (data) {
                /* Call When Api Add Success */
                Toastr({
                    type: "success",
                    message: "Phản Hồi Của Bạn Đã Được Ghi Nhận!",
                    title: "success",
                });
            })
            textCommentDom.value = null;
            e.preventDefault();
        }

        /* Handle Api Add Comment */

        function addComentApi(field, callback = () => null) {
            Fetch.post(`${router}/comment/add`, field)
                .then(data => data.json())
                .then(data => {
                    callback(data);
                })
        }

        /* Handle Component Comment Item */
        function handleSetParam(fields, callback) {
            /* Get Url Current */
            const url = new URL(window.location);
            for (let field in fields) {
                url.searchParams.set(field, fields[field]);
            }
            const params = url.search;
            getCommentApi(`${router}/comment${params}`, callback);
        }
        /* Handle Put Comment Api */
        function getCommentApi(url, callback) {
            Fetch.get(url)
                .then(data => data.json())
                .then(data => {
                    callback(data);
                });
        }

        /* Handle Append Module */
        function handleRenderModule(boxModule, data) {
            const comments = data.data.data;
            const boxFragment = document.createElement("div");
            comments.forEach(comment => {
                boxFragment.append(commentItem(comment));
            });
            boxModule.append(boxFragment);
            if (data.next_page_url) {
                const btnSeemore = document.createElement("a");
                btnSeemore.classList.add("fs-13");
                btnSeemore.textContent = `Xem Thêm Bình Luận`;
                btnSeemore.href = "";
                btnSeemore.onclick = function (e) {
                    handleSeeMore(this, boxModule, data.next_page_url)
                    e.preventDefault();
                }
                boxModule.append(btnSeemore);
            }
        }
        /* Handle Render Item */
        function commentItem(comment) {
            const commentItem = document.createElement("div");
            commentItem.classList.add("comment-item");
            const commentInfo = document.createElement("div");
            commentInfo.classList.add("comment-info");
            commentInfo.innerHTML = `
            <a href="" class="box-thumbnail">
                <img src="${comment.avatar_cdn ?? routerWeb.asset(comment.avatar)}" class="w-100">
            </a>
            <div class="box-info">
                <p class="fullname">${comment.fullname}</p>
                <div>
                    <span class="user-type">Người Tư Vấn</span>
                    <span class="post-created-at">${comment.created_at}</span>
                </div>
            </div>
            `;
            const commentContent = document.createElement("div");
            commentContent.classList.add("comment-content");
            commentContent.innerHTML = `
            <p>
               ${comment.comment_content}
            </p>
            `;
            /* Only Append Children When Has Comment Children */
            const commentChildren = document.createElement("div");
            const commentAction = document.createElement("div");
            commentAction.classList.add("comment-action");
            const btnReply = document.createElement("button");
            btnReply.classList.add("btn-reply");
            btnReply.textContent = "Phản Hồi";
            btnReply.onclick = function (e) {
                this.disabled = true;
                handleCreateFormReply({ boxModule: commentItem,commentator:comment.fullname }
                    , function (formControl) {
                    addComentApi({
                        module_id: moduleId,
                        parent_id: comment.comment_id,
                        comment_content: formControl.value
                    }, function () {
                        Toastr({
                            type: "success",
                            message: "Phản Hồi Của Bạn Đã Được Ghi Nhận!",
                            title: "success",
                        });
                    })
                    formControl.value = "";
                });
                e.preventDefault();
            }
            if (comment.count_comment_children) {
                const btnSeeMore = document.createElement("a");
                btnSeeMore.classList.add("btn-seemore", "pr-10", "fs-13");
                btnSeeMore.href = "";
                btnSeeMore.onclick = function (e) {
                    this.textContent = "Đang Tải...";
                    /* Handle SeeMore Parent Comment */
                    handleSetParam(
                        {
                            module_id: moduleId,
                            isParent: true,
                            parent_id: comment.comment_id
                        }, (data) => {
                            /* Call When Api Success */
                            handleRenderModule(commentChildren.querySelector(".wp-comment"), data);
                            this.remove();
                        });
                    e.preventDefault();
                };
                btnSeeMore.textContent = `Xem Câu Trả Lời (${comment.count_comment_children})`;
                commentAction.append(btnSeeMore);
            }
            commentAction.append(btnReply);
            commentItem.append(commentInfo);
            commentItem.append(commentContent);
            commentItem.append(commentAction);
            if (comment.count_comment_children) {
                commentChildren.classList.add("comment-children");
                commentChildren.innerHTML = `
                <div class="wp-comment">
                </div>
                `;
                commentItem.append(commentChildren);
            }
            return commentItem;
        }

        function handleSeeMore(self, boxModule, nextUrl) {
            self.textContent = "Đang Tải...";
            console.log(nextUrl);
            getCommentApi(nextUrl, function (data) {
                self.remove();
                handleRenderModule(boxModule, data);
            })
        }


        function handleCreateFormReply({boxModule,commentator}, handleSubmit) {
            const formReply = document.createElement("form");
            formReply.classList.add("form-reply");
            const formGroup = document.createElement("div");
            formGroup.classList.add("form-group");
            const formControl = document.createElement("input");
            formControl.classList.add("form-control");
            formControl.value=`@${commentator}:`;
            const btnSubmit = document.createElement("button");
            btnSubmit.classList.add("btn-reply", "input-append", "btn-default");
            const icon = document.createElement("i");
            icon.classList.add("fas", "fa-paper-plane");
            btnSubmit.append(icon);
            formGroup.append(btnSubmit);
            formGroup.append(formControl);
            formReply.append(formGroup);
            formReply.onsubmit = function (e) {
                if(!formControl.value.trim()){
                    Toastr({
                        type:"error",
                        title:"Error",
                        message:"Bạn Cần Nhập Nội Dung!"
                    });
                    return false;
                }
                handleSubmit(formControl);
                e.preventDefault();
            }
            boxModule.append(formReply);
        }
    })
})()
