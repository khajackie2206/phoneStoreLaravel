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

$(".qtybutton").click(function(){
    let quantity = Number($("#product-quantity").attr("value"));

    if ($(this).attr("action") == "quantity-dec" && quantity > 0) {
        $("#product-quantity").attr("value", quantity - 1);
        $("#product-quantity").text = quantity - 1;
    }
    if (
        $(this).attr("action") == "quantity-inc" 
    ) {
        $("#product-quantity").attr("value", quantity + 1);
        $("#product-quantity").text = quantity + 1;
    }
});

$(".quick-view-btn").click(function () {
    let productId = $(this).attr("productId");
    $.ajax({
        type: "GET",
        datatype: "JSON",
        url: "/products/detail/" + productId,
        success: function (results) {
          //  console.log(results);
            // $("#modelProductImage").html('');
            // $("#modelProductImageThumb").html('');
            $("#modelProductBrand").html(results.brand);
            $("#modalProductName").html(results.name);
            $("#modalProductPrice").html(
                results.price.toLocaleString("vi", {
                    style: "currency",
                    currency: "VND",
                })
            );
          
            $("#modalProductDesc").html(results.description);
            results.thumbs.map((productImage) => {
                $("#modelProductImage").children("img").eq(0).remove();
                let image =
                    `<img src="` +
                    productImage.url +
                    `" alt="product image">`;
                  $("#modelProductImage").append(image);
                //  $("#modelProductImageThumb").append(image);
            });
                  $("#color-select option").remove();
            results.colors.map((color, index) => {
          
             //   console.log(index);
                if (index == 0) {
                    let colorIten =
                        `<option value="` +
                        color.id +
                        ` selected="selected">` +
                        color.name +
                        `</option>`;
                    $("#color-select").append(colorIten);
                }
                else{
                    let colorIten =
                    `<option value="` +
                    color.id +
                    `">` +
                    color.name +
                    `</option>`;
                $("#color-select").append(colorIten);
            }
            });
    
        },
    });
});
