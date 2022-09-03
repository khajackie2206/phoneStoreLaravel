$("#upload").change(function () {
    console.log(123)
    const form = new FormData();
    form.append("file", $(this)[0].files[0]);
    $.ajax({
        processData: false,
        contentType: false,
        type: "POST",
        dataType: "JSON",
        data: form,
        url: "/upload",
        success: function (results) {
            console.log(results);
        },
    });
});
