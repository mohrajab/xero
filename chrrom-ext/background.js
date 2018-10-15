chrome.runtime.onInstalled.addListener(function () {
    chrome.declarativeContent.onPageChanged.removeRules(undefined, function () {
        chrome.declarativeContent.onPageChanged.addRules([
            {
                conditions: [
                    new chrome.declarativeContent.PageStateMatcher({
                        pageUrl: {urlContains: 'xero'},
                    })
                ],
                actions: [new chrome.declarativeContent.ShowPageAction()]
            }
        ]);
    });
});


chrome.pageAction.onClicked.addListener(function (tab) {
    chrome.identity.launchWebAuthFlow(
        {'url': 'http://127.0.0.1:8000/login', 'interactive': true},
        function (redirect_url) { /* Extract token from redirect_url */
        });
    /*    var url = new URL(tab.url);
        var id = url.searchParams.get("InvoiceID");
        var newURL = "http://localhost/xero/public/test/" + id;

        chrome.tabs.create({url: newURL});*/
});
