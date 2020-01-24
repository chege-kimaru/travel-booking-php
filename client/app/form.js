function submit(form, url, callback) {
    let request;
    form.submit(event => {
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        // Abort any pending request
        if (request) {
            request.abort();
        }

        // Let's select and cache all the fields
        let inputs = form.find("input, select, button, textarea");

        // Serialize the data in the form
        let serializedFormData = form.serializeArray();
        let formDataObj = {};
        $.each(serializedFormData, (i, v) => {
            formDataObj[v.name] = v.value;
        });
        const data = JSON.stringify(formDataObj);

        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        inputs.prop("disabled", true);

        // Fire off the request to /form.php
        request = $.ajax({
            url: url,
            type: "post",
            contentType: "application/json",
            dataType: "json",
            data: data,
            headers: {
                'Authorization': $.cookie('jwt')
            }
        });

        // Callback handler that will be called on success
        request.done((response, textStatus, jqXHR) => {
            callback(true, response);
        });

        // Callback handler that will be called on failure
        request.fail((jqXHR, textStatus, errorThrown) => {
            callback(false, JSON.parse(jqXHR.responseText));
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(() => {
            // Reenable the inputs
            inputs.prop("disabled", false);
        });

    });
}