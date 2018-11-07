const CLIENT_ID = '3';
//prod
const CLIENT_SECRET = 'xooutbW09WseDn8JAoniMzzZSXxGuDwuHoZNVyfL';
const SERVER_URL = "http://xero-test.tk";

//dev
// const CLIENT_SECRET = 'sOndrYNyZtpkh4TmbGLLqqwJwZHbqc8VNH2kAG9A';
// const SERVER_URL = 'http://localhost:8000';

const REDIRECT_URL = chrome.identity.getRedirectURL('token');
const REQUEST_CODE_URL = SERVER_URL + '/redirect' + '?client_id=' + CLIENT_ID + '&redirect_uri=' + REDIRECT_URL;
const REQUEST_TOKEN_URL = SERVER_URL + '/callback' + '?client_id=' + CLIENT_ID + '&client_secret=' + CLIENT_SECRET + '&redirect_uri=' + REDIRECT_URL;
let TOKEN = undefined;
getToken();

function getUser(callback) {
    $.ajax({
        url: SERVER_URL + "/api/user",
        method: "GET",
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', "Bearer " + TOKEN);
            xhr.setRequestHeader('Accept', 'Application/json');
        },
        success: function (response) {
            storageSet({user: response.data});
            if (callback) {
                callback();
            }
        },
        error: function (response) {
            return {};
        }
    });
}

function getServices() {
    return $.ajax({
        url: SERVER_URL + "/api/services",
        method: "GET",
        headers: {
            Accept: 'Application/json'
        },
        beforeSend: function () {
        },
        success: function (response) {
            storageSet({services: response.data});

            return response.data;
        },
        error: function (response) {
            return [];
        }
    });
}

function services() {
    // if (!storageGet('services')) {
        getServices();
    // }
}

function getToken() {
    chrome.storage.sync.get(['auth'], function (result) {
        TOKEN = result && result.auth ? result.auth.access_token : undefined;
    });
}

function storageGet(key) {
    return chrome.storage.sync.get([key], function (result) {
        return result[key];
    });
}

function storageSet(object) {
    chrome.storage.sync.set(object);
}

$(document).ready(function () {
     // chrome.storage.sync.remove(['auth']);
    // TOKEN = undefined;

    if (!TOKEN) {
        setNonAuthedView();
    } else {
        getUser(function () {
            setAuthedView();
        });
    }

    services();

    chrome.storage.sync.get('services', function (result) {
        result['services'].forEach(function (item) {
            let service = `<div class="card col-xs-6">
                <img src="${item.image_linked}" class="img">
                <p class="name-p">${item.name}</p>
                <p class="points-p">${item.points} pts</p>
            </div>`;

            $(".cards").append(service)
        });
    });

    $(document).on('click', '.main-btn', function () {
        $("button").attr("disabled", true);

        chrome.identity.launchWebAuthFlow(
            {
                'url': REQUEST_CODE_URL,
                'interactive': true
            },
            function (redirect_url) {
                if (chrome.runtime.lastError) {
                    $("button").attr("disabled", false);
                    callback(chrome.runtime.lastError);
                    return;
                }

                $.ajax({
                    url: REQUEST_TOKEN_URL + "&code=" + (new URL(redirect_url)).searchParams.get("code"),
                    method: "GET",
                    beforeSend: function () {
                    },
                    success: function (response) {
                        TOKEN = response.data.auth.access_token;
                        chrome.storage.sync.set(response.data, function () {
                            getUser(function () {
                                setAuthedView();
                            });
                        });
                    },
                    error: function (response) {
                        $("button").attr("disabled", false);

                        if (chrome.runtime.lastError) {
                            callback(chrome.runtime.lastError);
                            return;
                        }
                    }
                });
            });
    });
});

function setAuthedView() {
    chrome.storage.sync.get('user', function (result) {
        let user = result.user;

        $("#row").html(`<div class="container text-center" style="margin: 20px 0;">
            <div class="col-xs-3"></div>
            <div class="col-xs-1">
                <img src="${user.photo_url}" class="img-circle" style="width: 50px;">
            </div>
            <div class="col-xs-6 name">
               <div style="margin-left: 15px;">
                <label>${user.name}</label>
                <span><span>${user.current_points}</span> from ${user.current_active}</span>
</div>
            </div>
            <div class="col-xs-2"></div>
        </div>`);
    });
}


function setNonAuthedView() {
    $("#row").html(`<div class="container">
            <button type="button" class="btn main-btn text-center">Login Web Access</button>
        </div>`);
}
