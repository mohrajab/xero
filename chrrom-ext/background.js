chrome.runtime.onInstalled.addListener(function () {
    chrome.declarativeContent.onPageChanged.removeRules(undefined, function () {
        chrome.declarativeContent.onPageChanged.addRules([
            {
                conditions: [
                    new chrome.declarativeContent.PageStateMatcher({
                        pageUrl: {urlContains: 'InvoiceID'},
                    })
                ],
                actions: [new chrome.declarativeContent.ShowPageAction()]
            }
        ]);
    });
});


chrome.pageAction.onClicked.addListener(function (tab) {
    var url = new URL(tab.url);
    var id = url.searchParams.get("InvoiceID");
    var newURL = "http://localhost/xero/public/test/" + id;

    chrome.tabs.create({url: newURL});
});