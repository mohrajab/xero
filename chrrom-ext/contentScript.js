var url = new URL(window.location.href);
var id = url.searchParams.get("InvoiceID");
var newURL = "http://localhost/xero/public/test/" + id;

var button = `<a href="${newURL}">Custom Temp</a>`;
var e = document.createElement('li');
e.innerHTML = button;

var elementx = document.getElementById("ext-gen26");
elementx.querySelector("ul").appendChild(e);


