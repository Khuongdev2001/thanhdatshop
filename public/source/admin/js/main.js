function Fetch(callback) {

}

Fetch.post = function (url, data = {}) {
  return fetch(url, {
    method: 'POST', // *GET, POST, PUT, DELETE, etc.
    mode: 'cors', // no-cors, *cors, same-origin
    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
    credentials: 'same-origin', // include, *same-origin, omit
    headers: {
      'Content-Type': 'application/json'
      // 'Content-Type': 'application/x-www-form-urlencoded',
      , 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    redirect: 'follow', // manual, *follow, error
    referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    body: JSON.stringify(data) // body data type must match "Content-Type" header
  });
}

Fetch.get = function (url) {
  return fetch(url);
}

/* Handle Convert Format Number To Input */
function FormatNumberInput(seletors = [], maxLength = 10) {
  seletors.forEach(selector => {
    document.querySelectorAll(selector)
      .forEach(seletorFormat => handleFormat(seletorFormat));
  })

  function handleFormat(seletorFormat) {
    /* Value Raw */
    const selectorValue = document.querySelector(seletorFormat.getAttribute("data-target"));
    /* Filter Key  */
    seletorFormat.onkeydown = function (e) {
      const regex = /1|2|3|4|5|6|7|8|9|0|Backspace|Delete/;
      /* Block KeyBoard Value Not Number && No Delete*/
      if (!regex.test(e.key)) {
        return false;
      };
      /* When Value Has Length Value Only Keyboard Delete Is Allow*/
      return selectorValue.value.length <= maxLength || /Backspace|Delete/.test(e.key);
    };
    seletorFormat.oninput = function (e) {
      const priceFormat = e.target.value;
      const priceRaw = priceFormat.replace(/\./g, '');
      if (isNaN(Number(priceRaw))) {
        return null;
      }
      selectorValue.value = priceRaw;
      e.target.value = currencyFormat(priceRaw);
    };
    seletorFormat.value = currencyFormat(selectorValue.value);
  }
}


/* Handle Convert Number Format */
function currencyFormat(num) {
  num = Number(num);
  if (num) {
    return num.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
  }
  return null;
}