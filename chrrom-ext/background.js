chrome.runtime.onInstalled.addListener(function () {
    chrome.declarativeContent.onPageChanged.removeRules(undefined, function () {
        chrome.declarativeContent.onPageChanged.addRules([
            {
                conditions: [
                    new chrome.declarativeContent.PageStateMatcher({/*
                        pageUrl: {urlContains: 'xero'},*/
                    })
                ],
                actions: [new chrome.declarativeContent.ShowPageAction()]
            }
        ]);
    });
});


chrome.pageAction.onClicked.addListener(function (tab) {
    /*    chrome.identity.getAuthToken({interactive: false}, function (token) {
            if (!token) {
                if (chrome.runtime.lastError.message.match(/not signed in/)) {
                    alert("not singed in");
                } else {
                    alert("singed in");
                    chrome.identity.getProfileUserInfo(function (user) {
                        alert(user.email);
                    });
                }
            }
        });*/
    /* chrome.identity.launchWebAuthFlow(
         {'url': 'https://go.xero.com/Dashboard/', 'interactive': true},
         function (redirect_url) { /!* Extract token from redirect_url *!/
             alert(redirect_url);
         });*/
    var url = new URL(tab.url);
    var id = url.searchParams.get("InvoiceID");
    var newURL = "http://localhost:8000/invoice/" + id;

    chrome.tabs.create({url: newURL});
});
