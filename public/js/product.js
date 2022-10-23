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

$(".qtybutton1").click(function(){
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

function changeQuantity(params)
{
    let quantity = params.value;

    let url = params.name;
    let route = url + "?quantity=" + quantity;

     window.location = route;
}

function adjustQuantity(element) {
    let url = element.getAttribute("value");;

   // console.log(url);
     window.location = url;
}

$(".quick-view-btn").click(function () {
    let productId = $(this).attr("productId");
    $.ajax({
        type: "GET",
        datatype: "JSON",
        url: "/products/detail/" + productId,
        success: function (results) {
            // console.log(results);
            // $("#modelProductImage").html('');

            $("#productId").val(results.id);
            $("#url").val("/products/details/" + results.id);
            $("#modelProductBrand").html(results.brand);
            $("#modelProductMemory").html(
                results.ram + " GB" + " - " + results.memory
            );
            $("#modalProductName").html(results.name);
            $("#modalProductPrice").html(
                results.price.toLocaleString("vi", {
                    style: "currency",
                    currency: "VND",
                })
            );
             $("#modelProductColor").html(results.color);
            $("#modalProductDesc").html(results.description);
            results.thumbs.map((productImage) => {
                $("#modelProductImage").children("img").eq(0).remove();
                let image =
                    `<img src="` + productImage.url + `" alt="product image">`;
                $("#modelProductImage").append(image);
                //  $("#modelProductImageThumb").append(image);
            });
        },
    });
});

 //Live search o phan san pham
$(document).ready(function () {
    $('#keyword').on('keyup', function () {
        var query = $(this).val();
        if (query != '') {
            $.ajax({
                url: "search_pro",
                type: "get",
                data: { 'search_pro': query },
                success: function (data) {
                    $('#loadProduct').html(data);
                }
            });
        } else {
            $('#loadProduct').html('');
        }
    });
});

// Live search index
$(document).ready(function () {
    $('#inputSearch').on('keyup', function () {
        var query = $(this).val();
        if (query != '') {
            $.ajax({
                url: "/products/live-search",
                type: "get",
                data: { 'search': query },
                success: function (data) {
                    $('#show-list').html(data);
                }
            });
        } else {
            $('#show-list').html('');
        }
    });
});

//filter product

/*$(document).ready(function() {
       $(document).on('click', '.feature_checkbox', function() {
          //alert(123);
           var ids = [];

           $('.feature_checkbox').each(function () {
               if($(this).is(":checked")){
                   ids.push($(this).attr('id'));
               }
            });

           // $("#filterArea").empty();
           fetchDataOfCategory(ids);
           /*  let url = "/products/filter-product" + "?" + "ids=" + ids;

             window.location = url;*/
         //   alert(ids);
  /*     });
});*/

/*function fetchDataOfCategory(id) {
       $.ajax({
           url: "/products/filter-product" + "?" + "ids=" + id,
           type: "GET",
           success: function (data) {
               $("#filterArea").html(data['data']);
               $("#flexProduct").html(data['flex']);
           },
       });
}*/

//load more
function loadMore() {
    const page = parseInt($("#page").val());
   /* let url = "/products/load-more";
    window.location = url;*/
    $.ajax({
        type: "get",
        dataType: "JSON",
        data: { page },
        url: "/products/load-more",
        success: function (result) {
            if (result.data != "") {
                $("#flexProduct").append(result.flex);
                $("#filterArea").append(result.data);
                $("#page").val(page + 1);
            } else {
                $("#button-loadMore").css("display", "none");
            }
        },
    });


}

$(document).ready(function () {
    $(".product-features, .phone-types, .product-memories, .brands").click(function () {
        var formData = $("#myForm").serialize();
        $.ajax({
            url: "/products/load-product?" + formData,
            type: "get",
            dataType: "json",
            success: function (data) {
                $("#filterArea").html(data["data"]);
                $("#flexProduct").html(data["flex"]);
            },
        });
    });
});

$(document).ready(function () {
    $("#submit-discount").click(function () {
        var formData = $("#form-discount").serialize();
        let url = "/products/discount?"+formData;
        window.location = url;
    });
});


$("#actual-btn").change(function () {
     const form = new FormData();
     form.append("file", $(this)[0].files[0]);
     //window.location = "/upload/services";
    $.ajax({
        processData: false,
        contentType: false,
        type: "POST",
        datatype: "JSON",
        data: form,
        url: "/upload/services",
        success: function (results) {
            console.log(results);
            if (results.error == false) {
                $("#image_show").html(
                    '<img src="' +
                        results.url +
                        '"  class=" mt-5"  style="border-radius: 50%" width="250px">'
                );
                $("#thumb").val(results.url);
            } else {
                alert("File không đúng định dạng!!!");
            }
        },
    });
});
