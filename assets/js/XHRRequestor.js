var XHRRequestor = (function() {
    const xhr = new XMLHttpRequest();

    function sendXHRRequest(verb, callback, resource, ...params) {
        let uri = '/' + resource
        params.forEach(params => {
            uri += '/' + params;
        });
        xhr.open(verb, uri, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = () => callback(xhr);
        // Envoi de la requête
        xhr.send();
    }

    function httpPost(callback, resource, ...params) {
        sendXHRRequest('POST', callback, resource, ...params);
    }

    function httpGet(callback, resource, ...params) {
        sendXHRRequest('GET', callback, resource, ...params);
    }

    function httpPut(callback, resource, ...params) {
        sendXHRRequest('PUT', callback, resource, ...params);
    }

    function httpDelete(callback, resource, ...params) {
        sendXHRRequest('DELETE', callback, resource, ...params);
    }

    return {
        httpPost   : httpPost,
        httpGet    : httpGet,
        httpPut    : httpPut,
        httpDelete : httpDelete
    }
})();