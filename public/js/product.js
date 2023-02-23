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

$(document).on("click", ".quick-view-btn", function(){
     $("#modalProductPrice").html("");
      $("#modalProductDiscount").html("");
       $("#modalProductPriceOnly").html("");
       $("#discountPercentage").html("");
    $("#modelProductMemory").html("");
    $("#numberRating").html("");
    $("#modalProductName").html("");
    $("#modalProductPrice").html("");
    $("#modelProductColor").html("");
    $("#modalProductDesc").html("");
    $("#modelProductImage").attr("src",
        "https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif?20151024034921"
    );
    let productId = $(this).attr("productId");
    $.ajax({
        type: "GET",
        datatype: "JSON",
        url: "/products/detail/" + productId,
        success: function (results) {
            $("#productId").val(results.id);
            $("#url").val("/products/details/" + results.id);
            $("#modelProductBrand").html(results.brand);
             $("#star-1").removeClass("no-star");
             $("#star-2").removeClass("no-star");
             $("#star-3").removeClass("no-star");
             $("#star-4").removeClass("no-star");
             $("#star-5").removeClass("no-star");
            if (results.rating < 1)
            {
                $("#star-1").toggleClass("no-star");
                $("#star-2").toggleClass("no-star");
                $("#star-3").toggleClass("no-star");
                $("#star-4").toggleClass("no-star");
                $("#star-5").toggleClass("no-star");
            }
             if (results.rating >= 1 && results.rating < 2) {
               $("#star-2").toggleClass("no-star");
               $("#star-3").toggleClass("no-star");
               $("#star-4").toggleClass("no-star");
               $("#star-5").toggleClass("no-star");
             }
             if (results.rating >= 2 && results.rating < 3) {
               $("#star-3").toggleClass("no-star");
               $("#star-4").toggleClass("no-star");
               $("#star-5").toggleClass("no-star");
             }
              if (results.rating >= 3 && results.rating < 4) {
                $("#star-4").toggleClass("no-star");
                $("#star-5").toggleClass("no-star");
              }
              if (results.rating >= 4 && results.rating < 5) {
                  $("#star-5").toggleClass("no-star");
              }
              if (results.rating >= 5) {

              }
            $("#modelProductMemory").html(
                results.ram + " GB" + " - " + results.memory
            );
            $("#numberRating").html("("+ results.numberRating + ")");
            $("#modalProductName").html(results.name);
            if(results.discount == 0) {
                 $("#modalProductPriceOnly").html(
                     results.price.toLocaleString("vi", {
                         style: "currency",
                         currency: "VND",
                     })
                 );
            }


            if(results.discount > 0) {
                const newPrice = results.price - results.discount;
                const percent = newPrice / results.price;
                   $("#modalProductPrice").html(
                       results.price.toLocaleString("vi", {
                           style: "currency",
                           currency: "VND",
                       })
                   );
 $("#modalProductDiscount").html(
     newPrice.toLocaleString("vi", {
         style: "currency",
         currency: "VND",
     })
 );
   $("#discountPercentage").html("-"+percent.toFixed(0)+"%");
            }

            $("#modelProductColor").html(results.color);
            $("#modalProductDesc").html(results.description);
             $("#quantity-phone").html(results.quantity);

            results.thumbs.map((productImage) => {
                $("#modelProductImage").children("img").eq(0).remove();
                // let image =
                //     `<img src="` + productImage.url + `" alt="product image">`;
                // $("#modelProductImage").append(image);
                //  $("#modelProductImageThumb").append(image);
                $("#modelProductImage").attr("src", productImage.url);
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

//function to get current url
//load more
//pagination = 6
function loadMore() {
    let page = parseInt($("#page").val());
    if(page === 1){
        page=2;
    }
    const url = window.location.href;
    let newUrl = url.replace("products/filter", "products/load-more");
    // if (
    //     newUrl === "http://127.0.0.1:8000/products/load-more" || newUrl === "http://allo-store.vn/products/load-more"
    // ) {
    //     newUrl += "?page=" + page;
    // } else {
    //     newUrl += "&page=" + page;
    // }
    $.ajax({
        type: "get",
        dataType: "JSON",
        data: { page },
        //generate url keep current url and add page to url
        url: newUrl,
        success: function (result) {
            if(page === 2){
                page=1;
            }
            if (result.data != "") {
                $("#flexProduct").append(result.flex);
                $("#filterArea").append(result.data);
                $("#page").val(page + 1);
                //6 is product quantity/request
            } if( (result.numberOfProduct - page * 6 )< 6) {
                $("#button-loadMore").css("display", "none");
            }
        },
    });


}

$(document).ready(function () {
    // $(".product-features, .phone-types, .product-memories, .brands").click(function () {
    //     var formData = $("#myForm").serialize();
    //     $.ajax({
    //         url: "/products/load-product?" + formData,
    //         type: "get",
    //         dataType: "json",
    //         success: function (data) {
    //             $("#filterArea").html(data["data"]);
    //             $("#flexProduct").html(data["flex"]);
    //         },
    //     });
    // });
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
