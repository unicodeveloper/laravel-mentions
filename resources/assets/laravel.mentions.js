function enableMentions(elem, type, column) {
    $(elem).atwho({
        at: "@",
        limit: 5,
        callbacks: {
            remoteFilter: function(query, callback) {
                if (query.length <= 1) return;

                $.getJSON("/api/mentions/" + type, {
                    q: query,
                    c: column
                }, function(data) {
                    callback(data);
                });
            }
        }
    });
}
