chrome.runtime.onInstalled.addListener(function () {
    chrome.declarativeContent.onPageChanged.removeRules(undefined, function () {
        chrome.declarativeContent.onPageChanged.addRules([
            {
                conditions: [
                    new chrome.declarativeContent.PageStateMatcher({
                        /*
                                                pageUrl: {urlContains: 'xero'},*/
                    })
                ],
                actions: [new chrome.declarativeContent.ShowPageAction()]
            }
        ]);
    });
});


/*
chrome.pageAction.onClicked.addListener(function (tab) {
    /!*    chrome.identity.getAuthToken({interactive: false}, function (token) {
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
        });*!/


    /!*
    var url = new URL(tab.url);
    var id = url.searchParams.get("InvoiceID");
    var newURL = "http://xero-test.tk/invoice/" + id;

    chrome.tabs.create({url: newURL});*!/
});
*/
