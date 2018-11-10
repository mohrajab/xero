var url = new URL(window.location.href);
var id = null;
if (url.searchParams.has("InvoiceID")) {
    id = url.searchParams.get("InvoiceID");
} else {
    id = url.searchParams.get("invoiceID");
}

//prod
var newURL = "http://xero-test.tk/invoice/" + id;

//dev
// var newURL = "http://localhost:8000/invoice/" + id;

var dropdown = `<dt id="options2" style="color: #2E3544;background: white;">
        <div style="vertical-align: center" id="ext-gen32-2">
        <img style="padding-right: 5px" width="25px" src="http://xero-test.tk/theme/img/logo.png"/>
        <b> Accessories <b style="color: #00D07F"> Cloud</b></b><span>&nbsp;</span>
        </div>
    </dt>
    <dd id="ext-gen31-2" style="visibility: hidden; position: relative; display: block;width: 102% !important;">
        <ul>
            <li><a style="vertical-align: center" target="_blank" href="${newURL}?type=pdf">
            <img style="padding-right: 5px" width="15px" src="http://xero-test.tk/storage/v1fj9DIgG5qtIJ9u9GsEGtT8beZg9roZ0KEUEl9v.png"/>
          
            Arabic PDF
            </a></li>
            <li><a style="vertical-align: center" target="_blank" href="${newURL}?type=word">
            <img style="padding-right: 5px" width="15px" src="http://icons.iconarchive.com/icons/dakirby309/simply-styled/128/Microsoft-Word-2013-icon.png"/>
            Word
            </a></li>
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
