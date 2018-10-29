const CLIENT_ID = '3';
const CLIENT_SECRET = 'sOndrYNyZtpkh4TmbGLLqqwJwZHbqc8VNH2kAG9A';
const REDIRECT_URL = chrome.identity.getRedirectURL('token');
const SERVER_URL = 'http://localhost/xero/public';
const REQUEST_CODE_URL = SERVER_URL + '/redirect' + '?client_id=' + CLIENT_ID + '&redirect_uri=' + REDIRECT_URL;
const REQUEST_TOKEN_URL = SERVER_URL + '/callback' + '?client_id=' + CLIENT_ID + '&client_secret=' + CLIENT_SECRET + '&redirect_uri=' + REDIRECT_URL;

$("button").click(function () {
    chrome.identity.launchWebAuthFlow(
        {
            'url': REQUEST_CODE_URL,
            'interactive': true
        },
        function (redirect_url) {
            if (chrome.runtime.lastError) {
                callback(chrome.runtime.lastError);
                return;
            }

            $.ajax({
                url: REQUEST_TOKEN_URL + "&code=" + (new URL(redirect_url)).searchParams.get("code"),
                method: "GET",
                beforeSend: function () {
                },
                success: function (response) {
                    chrome.storage.sync.set({auth: response}, function () {
                        console.log('Auth is set' + response);
                    });
                },
                error: function (response) {
                    if (chrome.runtime.lastError) {
                        callback(chrome.runtime.lastError);
                        return;
                    }
                }
            });
        });
});

function getData() {
    $.ajax({
        url: REQUEST_TOKEN_URL + "api/data",
        method: "GET",
        headers: {
            Accept: 'Application/json',
            Authorization: getToken()
        },
        beforeSend: function () {
        },
        success: function (response) {
            storageSet(response);
        },
        error: function (response) {
            if (chrome.runtime.lastError) {
                callback(chrome.runtime.lastError);
                return;
            }
        }
    });
}


function getToken() {
    const data = storageGet('auth');
    if (data)
        return data.token_type + " " + data.access_token;
    else
        return undefined;
}


function storageGet(key) {
    return chrome.storage.sync.get([key], function (result) {
        return result[key];
    });
}

function storageSet(object) {
    chrome.storage.sync.set(object);
}
