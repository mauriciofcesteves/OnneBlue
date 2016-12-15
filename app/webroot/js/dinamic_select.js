var dinamic_select = function(action, selection, model, controller, placeholder, multiple, preAction) {
    if(typeof(preAction)==='undefined') preAction = '';
    $("#"+action).select2({
        placeholder: placeholder,
        width : '100%',
        multiple: multiple,
        id: function(data){ return data[model].id; },
        ajax: {
            url: preAction + action,
            dataType: 'json',
            quietMillis: 100,
            data: function (term, page) {
                return {
                    term: term,
                    limit: 10,
                    page: page,
                };
            },
            results: function (data, page) {
                var more = (page * 10) < data.count;
                return {results: data[controller], more: more};
            },
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if(id !== "") {
                $.ajax(preAction + selection, {
                    data: {id: id},
                    dataType: "json"
                }).done(function(data) {
                    return callback(data[controller]);
                });
            }

        },
        formatResult: function(data) {
            var markup = "<table class='movie-result'><tr>";
            markup += "<td id='"+ data[model].id +"' class='movie-info'><div class='movie-title'>" + data[model].name + "</div>";
            markup += "</td></tr></table>";
            return markup;
        },
        formatSelection: function(data) {
            if (data != "") {
                return data[model].name;
            }
        },
        escapeMarkup: function (m) { return m; }
    });
}