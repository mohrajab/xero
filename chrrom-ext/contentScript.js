var url = new URL(window.location.href);
var id = null;
if (url.searchParams.has("InvoiceID")) {
    id = url.searchParams.get("InvoiceID");
} else {
    id = url.searchParams.get("invoiceID");
}

//prod
/*
var newURL = "http://xero-test.tk/invoice/" + id;
*/

//dev
var newURL = "http://localhost/xero/public/invoice/" + id;

var dropdown = `<dt id="options2">
        <div id="ext-gen32-2">Arabic PDF<span>&nbsp;</span></div>
    </dt>
    <dd id="ext-gen31-2" style="right: 86px; top: 240px; visibility: hidden; display: block;width: 97px !important;">
        <ul>
            <li><a target="_blank" href="${newURL}?type=pdf">PDF</a></li>
            <li><a target="_blank" href="${newURL}?type=word">Word</a></li>
        </ul>
    </dd>`;

var e = document.createElement('dl');
e.setAttribute("class", "select list");
e.setAttribute("style", "float:right;");
e.setAttribute("id", "ext-gen30-2");
e.innerHTML = dropdown;
var options = document.querySelector(".options-bar");
options.insertBefore(e, options.firstChild);

var option = document.getElementById("options2");
option.addEventListener("mouseover", handelHover, false);
option.addEventListener("mouseout", handelHover, false);
option.addEventListener("click", handelClick);

//prod
/*
var newURL = "http://xero-test.tk/invoice/" + id;
*/

/*

//dev
var newURL = "http://localhost/xero/public/invoice/" + id;

var button = `<a href="${newURL}" target="_blank">Arabic Invoice</a>`;
var e = document.createElement('li');
e.innerHTML = button;

var elementx = document.getElementById("ext-gen26");
elementx.querySelector("ul").appendChild(e);

*/


function handelHover(event) {
    var item = event.target;
    item.classList.toggle('hover');
}

function handelClick(event) {
    var item = event.target;
    if (item.classList.contains('opened')) {
        item.classList.remove('opened');
        document.getElementById("ext-gen31-2").style.visibility = "hidden";
    } else {
        item.classList.add('opened');
        document.getElementById("ext-gen31-2").style.visibility = "visible";
    }
}
