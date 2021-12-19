/* Defind Routing */
function routerWeb() {

}
routerWeb.productDetails = function (id, slug) {
    return `${window.location.origin}/${id}/${slug}`;
}
routerWeb.cartOrder = function (id) {
    return `${window.location.origin}/cart/order/${id}`;
}
routerWeb.postDetails=function(slug){
    return `${window.location.origin}/post/${slug}.html`;
}
routerWeb.asset=function(src){
    return `${window.location.origin}/source/img/${src}`;
};