/*Upload File */
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
$("#upload").change(function () {
    const form = new FormData();
    form.append("file", $(this)[0].files[0]);
    $.ajax({
        processData: false,
        contentType: false,
        type: "POST",
        datatype: "JSON",
        data: form,
        url: "/admin/upload/services",
        success: function (results) {
            if (results.error == false) {
                $("#image_show").html(
                    '<a href="' +
                        results.url +
                        '"><img src="' +
                        results.url +
                        '" target="_blank" width="100px"></a>'
                );
                $("#thumb").val(results.url);
            } else {
                alert("File không đúng định dạng!!!");
            }
        },
    });
});
/*Upload multi Files */
$("#uploads").change(function () {
      const form = new FormData();
      let TotalFiles = $("#uploads")[0].files.length; //Total files
      let files = $("#uploads")[0];
      for (let i = 0; i < TotalFiles; i++) {
          form.append("files" + i, files.files[i]);
      }
      form.append("TotalFiles", TotalFiles);
    $.ajax({
        processData: false,
        contentType: false,
        type: "POST",
        datatype: "JSON",
        data: form,
        url: "/admin/multi-upload/services",
        success: function (results) {
            if (results.error == false) {
                $("#thumbs").val(results.url);
            } else {
                alert("File không đúng định dạng!!!");
            }
        },
    });
});
