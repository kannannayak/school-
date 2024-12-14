$(document).ready(function () {
  function load_cart_data() {
    $.ajax({
      url: "dash_apis/count",
      method: "POST",
      dataType: "json",
      success: function (data) {
        $(".service_in_quee").html(data.service_in_quee);
        $(".getChecked").html(data.getChecked);
        $(".getInPro").html(data.getInPro);
        $(".getReady").html(data.getReady);
        $(".getCompleted").html(data.getCompleted);
        $(".getNewUser").html(data.getNewUser);
        $(".getTodayUser").html(data.getTodayUser);
        $(".getTotalWorkshop").html(data.getTotalWorkshop);
        $(".getTodayWorkshop").html(data.getTodayWorkshop);
        $(".getTodayOrder").html(data.getTodayOrder);
        $(".getTotalOrder").html(data.getTotalOrder);
        $(".getTotalRev").html(data.getTotalRev);
        $(".getTotalOnline").html(data.getTotalOnline);
        $(".getTotalCash").html(data.getTotalCash);
        $(".getTotalProfit").html(data.getTotalProfit);
      },
    });
  }
  load_cart_data();
  // <--------------------------add_category---------------------------->
  // Add new Brand
  $("#add_cat").on("submit", "#add_category", function (e) {
    e.preventDefault();
    var form = $(this)[0];
    var dataform = new FormData(form);
    console.log(dataform);
    $.ajax({
      type: "post",
      url: "dash_apis/add-category_api.php",
      data: dataform,
      cache: false,
      contentType: false,
      encetype: "multipart/form-data",
      processData: false,
      beforeSend: function () {
        $("#cat_btn").prop("disabled", true); // disable button
        $("#cat_btn").text("Uploading Please Wait...");
      },
      success: function (response) {
        if (response == 1) {
          swal("", "New Record Added.", "success");
          $("#cat_btn").prop("disabled", false); // disable button
          $("#add_category").trigger("reset");
          $("#cat_btn").text("Submit");
        }
        if (response == 0) {
          swal("", "Something is wrong please try again.", "warning");
          $("#cat_btn").prop("disabled", false); // disable button
          $("#cat_btn").text("Submit");
        }
      },
    });
  });
  // Add new Brand
  // fetch-category
  function loadallbrand() {
    // $("#load-brand").html("");
    $.ajax({
      url: "dash_apis/fetch_category.php",
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      // "dataSrc": "tableData",
      success: function (data) {
        var html = "";
        $.each(data, function (key, value) {
          html += "<tr>";
          html += "<td>" + value.category_name + "</td>";
          html +=
            "<td><img style='width:40px;' src='../upload/category/" +
            value.cat_image +
            "'></td>";
          html += "<td><i class=" + value.category_icon + "></i></td>";
          // html += "<td><i class='edit-brand fa fa-edit' data-eid='" + value.category_id + "'></i> || <i class='delete-category fa fa-trash-o' data-id='" + value.category_id + "'></i></td>";
          html +=
            "<td style='display:flex;justify-content: space-around;padding: 16px;';><i id='edit_category' class='edit_category fa fa-edit btn btn-primary' data-eid='" +
            value.category_id +
            "'></i> <i class='delete-category fa fa-trash-o btn btn-danger' data-id='" +
            value.category_id +
            "'></i></td>";
          html += "</tr>";
        });
        $("#load-category").html(html);
        $("#example-table").dataTable({
          // "destroy": true,
          // "stateSave": true,
          bDestroy: true,
          bRetrive: true,
        });
      },
    });
  }
  loadallbrand();
  //edit category
  $(document).on("click", "#edit_category", function (evt) {
    evt.preventDefault();
    var category_id = $(this).attr("data-eid");
    // alert(product_id);
    $.ajax({
      url: "../ajax/edit_category.php",
      method: "GET",
      data: { category_id: category_id },
      dataType: "json",
      success: function (data) {
        console.log(data);
        $("#category_id").val(data.category_id);
        $("#category_name").val(data.category_name);
        $("#category_icon").val(data.category_icon);
        $("#cat_img").val(data.cat_image);
        $("#cat_image").html(
          '<img src="../upload/category/' +
          data.cat_image +
          '"style="width:auto;height:100px;">'
        );
        console.log($("#category_name").val());
        $("#category_list").fadeOut(100, function () {
          // Show the new page after a delay
          $("#edit_category_page").fadeIn(100);
        });
      },
    });
  });
  // <-----------------------------edit category page------------------------------->
  $("#add_cats").on("submit", "#add_categorys", function (e) {
    // alert('add_category');
    e.preventDefault();
    var form = $(this)[0];
    var dataform = new FormData(form);
    console.log(dataform);
    $.ajax({
      type: "post",
      url: "dash_apis/edit-category_api.php",
      data: dataform,
      cache: false,
      contentType: false,
      encetype: "form-data",
      processData: false,
      beforeSend: function () {
        $("#attr_btn").prop("disabled", true); // disable button
        $("#attr_btn").text("Uploading Please Wait...");
      },
      success: function (response) {
        if (response == 1) {
          swal("", "New Record Added.", "success");
          $("#attr_btn").prop("disabled", false); // disable button
          $("#add_categorys").trigger("reset"); //after submite form values clear
          $("#attr_btn").text("Submit");
        }
        if (response == 0) {
          swal("", "Something is wrong please try again.", "warning");
          $("#attr_btn").prop("disabled", false); // disable button
          $("#attr_btn").text("Submit");
        }
      },
    });
  });
  //     deletecategory
  $(document).on("click", ".delete-category", function () {
    if (confirm("Do you really want to delete this record ? ")) {
      var catID = $(this).data("id");
      var obj = { catid: catID };
      var myJSON = JSON.stringify(obj);
      var row = this;
      $.ajax({
        url: "dash_apis/delete-category.php",
        type: "POST",
        data: myJSON,
        success: function (response) {
          //          alert(response);
          if (response == 1) {
            swal("", "Record Deleted.", "success");
            setTimeout(function () {
              //                        alert('Reloading Page');
              location.reload(true);
            }, 200);
            //                    load_json_data('getcategory');
          }
        },
      });
    }
  });
  //     Delete
  // <--------------------------end category---------------------------->
  // <-----------------------start subcategory---------------------->
  // Add sub category
  $("#add_subcat").on("submit", "#add_subcategory", function (e) {
    e.preventDefault();
    var form = $(this)[0];
    var dataform = new FormData(form);
    //      console.log(dataform);
    $.ajax({
      type: "post",
      url: "dash_apis/add-subcategory.php",
      data: dataform,
      cache: false,
      contentType: false,
      encetype: "multipart/form-data",
      processData: false,
      beforeSend: function () {
        $("#cat_btn").prop("disabled", true); // disable button
        $("#cat_btn").text("Uploading Please Wait...");
      },
      success: function (response) {
        if (response == 1) {
          swal("", "New Record Added.", "success");
          $("#cat_btn").prop("disabled", false); // disable button
          $("#add_subcategory").trigger("reset");
          $("#cat_btn").text("Submit");
        }
        if (response == 0) {
          swal("", "Something is wrong please try again.", "warning");
          $("#cat_btn").prop("disabled", false); // disable button
          $("#cat_btn").text("Submit");
        }
      },
    });
  });
  // List of sub category
  function loadallbrands() {
    // $("#load-brand").html("");
    $.ajax({
      url: "dash_apis/fetch_subcategory.php",
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      // "dataSrc": "tableData",
      success: function (data) {
        var html = "";
        $.each(data, function (key, value) {
          html += "<tr>";
          html += "<td>" + value.category_name + "</td>";
          html += "<td>" + value.sub_category_name + "</td>";
          html +=
            "<td><img style='width:40px;' src='../upload/subcategory/" +
            value.subcategoty_image +
            "'></td>";
          html += "<td>" + "active" + "</td>";
          // html += "<td ><i class='edit-brand fa fa-edit' data-eid='" + value.sub_category_id + "'></i> || <i class='delete-sub-category fa fa-trash-o' data-id='" + value.sub_category_id + "'></i></td>";
          // html += "</tr>";
          html +=
            "<td style='display:flex;justify-content: space-around;padding: 16px;';><i id='eidt_subcat' class='edit-product fa fa-edit btn btn-primary' data-eid='" +
            value.sub_category_id +
            "'></i> <i class='delete-sub-category fa fa-trash-o btn btn-danger' data-id='" +
            value.sub_category_id +
            "'></i></td>";
          html += "</tr>";
        });
        $("#load-subcategory").html(html);
        $("#example-table").dataTable({
          // "destroy": true,
          // "stateSave": true,
          bDestroy: true,
          bRetrive: true,
        });
      },
    });
  }
  loadallbrands();
  //edit subcategory
  $(document).on("click", "#eidt_subcat", function (evt) {
    // alert('eidt_subcat');
    evt.preventDefault();
    var sub_category_id = $(this).attr("data-eid");
    // alert(sub_category_id);
    $.ajax({
      url: "../ajax/edit_subcategory.php",
      method: "GET",
      data: { sub_category_id: sub_category_id },
      dataType: "json",
      success: function (data) {
        console.log(data);
        $("#category_name").val(data.category_name);
        $("#sub_category_id").val(data.sub_category_id);
        $("#sub_category_name").val(data.sub_category_name);
        $("#subcategoty_img").val(data.subcategoty_image);
        $("#subcategoty_image").html(
          '<img src="../upload/subcategory/' +
          data.subcategoty_image +
          '"style="width:auto;height:100px;">'
        );
        console.log($("#sub_category_name").val());
        $("#subcat_viewpage").fadeOut(100, function () {
          // Show the new page after a delay
          $("#add_subcats").fadeIn(100);
        });
      },
    });
  });
  //update subcategory
  $("#add_subcats").on("submit", "#add_subcategorys", function (e) {
    // alert('add_subcategorys');
    e.preventDefault();
    var form = $(this)[0];
    var dataform = new FormData(form);
    console.log(dataform);
    $.ajax({
      type: "post",
      url: "dash_apis/edit-subcategory_api.php",
      data: dataform,
      cache: false,
      contentType: false,
      encetype: "form-data",
      processData: false,
      beforeSend: function () {
        $("#attr_btn").prop("disabled", true); // disable button
        $("#attr_btn").text("Uploading Please Wait...");
      },
      success: function (response) {
        if (response == 1) {
          swal("", "New Record Added.", "success");
          $("#attr_btn").prop("disabled", false); // disable button
          $("#add_categorys").trigger("reset"); //after submite form values clear
          $("#attr_btn").text("Submit");
        }
        if (response == 0) {
          swal("", "Something is wrong please try again.", "warning");
          $("#attr_btn").prop("disabled", false); // disable button
          $("#attr_btn").text("Submit");
        }
      },
    });
  });
  //List of category
  // <-----------------------end sub category---------------------->
  // Edit Brand
  $(document).on("click", ".edit-brand", function () {
    $("#edit_brand").show();
    $("#add_brand").hide();
    var studentId = $(this).data("eid");
    var obj = { sid: studentId };
    var myJSON = JSON.stringify(obj);
    $.ajax({
      url: "dash_apis/single_brand",
      type: "POST",
      data: myJSON,
      success: function (data) {
        // alert(data);
        //console.log(response);
        //var data=JSON.parse(response);
        $("#brandid").val(data.speciality_id);
        $("#combrand").val(data.speciality);
        $("#image").val(data.speciality_image);
      },
    });
  });
  $("#editbrand").on("submit", "#edit_brands", function (e) {
    e.preventDefault();
    var form = $(this)[0];
    var dataform = new FormData(form);
    console.log(dataform);
    $.ajax({
      type: "post",
      url: "dash_apis/edit-brand",
      data: dataform,
      cache: false,
      contentType: false,
      encetype: "multipart/form-data",
      processData: false,
      beforeSend: function () {
        $("#brand_btn").prop("disabled", true); // disable button
        $("#brand_btn").text("Updating Please Wait...");
      },
      success: function (response) {
        if (response == 1) {
          swal("", "Speciality Updated.", "success");
          $("#brand_btn").prop("disabled", false); // disable button
          $("#edit_brands").trigger("reset");
          $("#brand_btn").text("Update");
          $("#edit_brand").hide();
          $("#add_brand").show();
          setTimeout(function () {
            //                        alert('Reloading Page');
            location.reload(true);
          }, 200);
        }
        if (response == 0) {
          swal("", "Something is wrong please try again.", "warning");
          $("#brand_btn").prop("disabled", false); // disable button
          $("#brand_btn").text("Update");
        }
      },
    });
  });
  // Edit Brand
  //Delete Brand
  //     Delete Brand sub category
  $(document).on("click", ".delete-sub-category", function () {
    if (confirm("Do you really want to delete this record ? ")) {
      var catID = $(this).data("id");
      var obj = { catid: catID };
      var myJSON = JSON.stringify(obj);
      var row = this;
      $.ajax({
        url: "dash_apis/delete-sub-category.php",
        type: "POST",
        data: myJSON,
        success: function (response) {
          //          alert(response);
          if (response == 1) {
            //                    swal("", "Record Deleted.", "success");
            setTimeout(function () {
              //                        alert('Reloading Page');
              location.reload(true);
            }, 200);
            //                    load_json_data('getcategory');
          }
        },
      });
    }
  });
  //     Delete Brand
  //Delete Brand
  // Select option category
  load_json_data("getcategory");
  function load_json_data(id) {
    var html_code = "";
    $.getJSON("dash_apis/fetch_category.php", function (data) {
      html_code +=
        '<option style="color:black;" value="">Select Category</option>';
      $.each(data, function (key, value) {
        html_code +=
          '<option style="color:black;" value="' +
          value.category_id +
          '">' +
          value.category_name +
          "</option>";
      });
      $("#" + id).html(html_code);
    });
  }
  // Select option subcategory
  // load_json_datas('getsubcategory');
  var html_code = "";
  $("#add_product").on("change", "#getcategory", function () {
    $.getJSON(
      "dash_apis/fetch_subcategory.php?id=" + this.value,
      function (data) {
        html_code +=
          '<option style="color:black;" value="">Select SubCategory</option>';
        $.each(data, function (key, value) {
          // console.log(value)
          html_code +=
            '<option style="color:black;" value="' +
            value.sub_category_id +
            '">' +
            value.sub_category_name +
            "</option>";
        });
        //  $('#getsubcategory').empty();
        // alert(1)
        //  $('#getsubcategory').empty();
        //  const myNode = document.getElementById("getsubcategory");
        //  while (myNode.firstChild) {
        //   myNode.removeChild(myNode.lastChild);
        // }
        $("#getsubcategory")
          .find("option")
          .remove()
          .end()
          .append('<option value="0">Select SubCategory</option>')
          .val("0");
        $("#getsubcategory").html(html_code);
      }
    );
  });
  // function getsubcategory(id)
  // {
  // }
  // <-----------------------------add brand-------------------------------->
  // Add Brand
  $("#brand").on("submit", "#add_brand", function (e) {
    e.preventDefault();
    var form = $(this)[0];
    var dataform = new FormData(form);
    //      console.log(dataform);
    $.ajax({
      type: "post",
      url: "dash_apis/add-brand_api.php",
      data: dataform,
      cache: false,
      contentType: false,
      encetype: "multipart/form-data",
      processData: false,
      beforeSend: function () {
        $("#cat_btn").prop("disabled", true); // disable button
        $("#cat_btn").text("Uploading Please Wait...");
      },
      success: function (response) {
        if (response == 1) {
          swal("", "New Record Added.", "success");
          $("#cat_btn").prop("disabled", false); // disable button
          $("#add_brand").trigger("reset");
          $("#cat_btn").text("Submit");
        }
        if (response == 0) {
          swal("", "Something is wrong please try again.", "warning");
          $("#cat_btn").prop("disabled", false); // disable button
          $("#cat_btn").text("Submit");
        }
      },
    });
  });
  // Add Brand
  // Fetch Brand
  function load_brand() {
    // $("#load-brand").html("");
    $.ajax({
      url: "dash_apis/fetch_brand.php",
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      // "dataSrc": "tableData",
      success: function (data) {
        var html = "";
        $.each(data, function (key, value) {
          html += "<tr>";
          html += "<td>" + value.brand_name + "</td>";
          html +=
            "<td><img style='width:40px;' src='../upload/brand/" +
            value.brand_image +
            "'></td>";
          html += "<td>" + "active" + "</td>";
          // html += "<td><i class='edit-brand fa fa-edit' data-eid='" + value.brand_id + "'></i> || <i class='delete-brand fa fa-trash-o' data-id='" + value.brand_id + "'></i></td>";
          // html += "</tr>";
          html +=
            "<td style='display:flex;justify-content: space-around;padding: 16px;';><i id='editBrand' class='edit-brand fa fa-edit btn btn-primary' data-eid='" +
            value.brand_id +
            "'></i> <i class='delete-brand fa fa-trash-o btn btn-danger' data-id='" +
            value.brand_id +
            "'></i></td>";
          html += "</tr>";
        });
        $("#load-brand").html(html);
        $("#example-table").dataTable({
          // "destroy": true,
          // "stateSave": true,
          bDestroy: true,
          bRetrive: true,
        });
      },
    });
  }
  load_brand();
  // Fetch Brand$('#add_attr').on('submit','#add_attributes',function(e){
  e.preventDefault();
  var form = $(this)[0];
  var dataform = new FormData(form);
  //      console.log(dataform);
  $.ajax({
    type: "post",
    url: "dash_apis/add-attributes_api.php",
    data: dataform,
    cache: false,
    contentType: false,
    encetype: "multipart/form-data",
    processData: false,
    beforeSend: function () {
      $("#attr_btn").prop("disabled", true); // disable button
      $("#attr_btn").text("Uploading Please Wait...");
    },
    success: function (response) {
      if (response == 1) {
        swal("", "New Record Added.", "success");
        $("#attr_btn").prop("disabled", false); // disable button
        $("#add_attr").trigger("reset");
        $("#attr_btn").text("Submit");
      }
      if (response == 0) {
        swal("", "Something is wrong please try again.", "warning");
        $("#attr_btn").prop("disabled", false); // disable button
        $("#attr_btn").text("Submit");
      }
    },
  });
});
//edit brand get value
$(document).on("click", "#editBrand", function (evt) {
  // alert('editBrand');
  evt.preventDefault();
  var brand_id = $(this).attr("data-eid");
  // alert(brand_id);
  $.ajax({
    url: "../ajax/edit_brand.php",
    method: "GET",
    data: { brand_id: brand_id },
    dataType: "json",
    success: function (data) {
      console.log(data);
      $("#brand_id").val(data.brand_id);
      $("#brand_name").val(data.brand_name);
      $("#brand_img").val(data.brand_image);
      $("#brand_image").html(
        '<img src="../upload/brand/' +
        data.brand_image +
        '"style="width:auto;height:100px;">'
      );
      console.log($("#brand_name").val());
      $("#brand_view").fadeOut(100, function () {
        // Show the new page after a delay
        $("#edit_brand_form").fadeIn(100);
      });
    },
  });
});
//update brand
//update subcategory
$("#edit_brand_form").on("submit", "#edit_brands", function (e) {
  // alert('edit_brands');
  e.preventDefault();
  var form = $(this)[0];
  var dataform = new FormData(form);
  console.log(dataform);
  $.ajax({
    type: "post",
    url: "dash_apis/edit-brand_api.php",
    data: dataform,
    cache: false,
    contentType: false,
    encetype: "form-data",
    processData: false,
    beforeSend: function () {
      $("#attr_btn").prop("disabled", true); // disable button
      $("#attr_btn").text("Uploading Please Wait...");
    },
    success: function (response) {
      if (response == 1) {
        swal("", "New Record Added.", "success");
        $("#attr_btn").prop("disabled", false); // disable button
        $("#edit_brands").trigger("reset"); //after submite form values clear
        $("#attr_btn").text("Submit");
      }
      if (response == 0) {
        swal("", "Something is wrong please try again.", "warning");
        $("#attr_btn").prop("disabled", false); // disable button
        $("#attr_btn").text("Submit");
      }
    },
  });
});
//deletebrand
$(document).on("click", ".delete-brand", function () {
  if (confirm("Do you really want to delete this record ? ")) {
    var catID = $(this).data("id");
    var obj = { catid: catID };
    var myJSON = JSON.stringify(obj);
    var row = this;
    $.ajax({
      url: "dash_apis/delete-brand.php",
      type: "POST",
      data: myJSON,
      success: function (response) {
        //          alert(response);
        if (response == 1) {
          //                    swal("", "Record Deleted.", "success");
          setTimeout(function () {
            //                        alert('Reloading Page');
            location.reload(true);
          }, 200);
          //                    load_json_data('getcategory');
        }
      },
    });
  }
});
// <-----------------------------end brand-------------------------------->
// <-----------------------------attributes-----attributes--------------------------->
$("#add_attr").on("submit", "#add_attributes", function (e) {
  e.preventDefault();
  var form = $(this)[0];
  var dataform = new FormData(form);
  //      console.log(dataform);
  $.ajax({
    type: "post",
    url: "dash_apis/add-attributes_api.php",
    data: dataform,
    cache: false,
    contentType: false,
    encetype: "form-data",
    processData: false,
    beforeSend: function () {
      $("#attr_btn").prop("disabled", true); // disable button
      $("#attr_btn").text("Uploading Please Wait...");
    },
    success: function (response) {
      if (response == 1) {
        swal("", "New Record Added.", "success");
        $("#attr_btn").prop("disabled", false); // disable button
        $("#add_attributes").trigger("reset");
        $("#attr_btn").text("Submit");
      }
      if (response == 0) {
        swal("", "Something is wrong please try again.", "warning");
        $("#attr_btn").prop("disabled", false); // disable button
        $("#attr_btn").text("Submit");
      }
    },
  });
});
//fetching attributes
function load_attributes() {
  // $("#load-brand").html("");
  $.ajax({
    url: "dash_apis/fetch_attributes.php",
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    // "dataSrc": "tableData",
    success: function (data) {
      var html = "";
      $.each(data, function (key, value) {
        html += "<tr>";
        html += "<td>" + value.attributes_name + "</td>";
        html += "<td>" + "active" + "</td>";
        // html += "<td><i class='edit-attributes  fa fa-edit' data-eid='" + value.attributes_id + "'></i> || <i class='delete-attributes fa fa-trash-o' data-id='" + value.attributes_id + "'></i></td>";
        // html += "</tr>";
        html +=
          "<td style='display:flex;justify-content: space-around;padding: 16px;';><i class='edit-attributes fa fa-edit btn btn-primary' data-eid='" +
          value.attributes_id +
          "'></i> <i class='delete-attributes fa fa-trash-o btn btn-danger' data-id='" +
          value.attributes_id +
          "'></i></td>";
        html += "</tr>";
      });
      $("#load-attributes").html(html);
      $("#example-table").dataTable({
        // "destroy": true,
        // "stateSave": true,
        bDestroy: true,
        bRetrive: true,
      });
    },
  });
}
load_attributes();
//edit attributes
$(document).on("click", ".edit-attributes", function (evt) {
  // alert('edit-attributes');
  evt.preventDefault();
  var attributes_id = $(this).attr("data-eid");
  // alert(attributes);
  $.ajax({
    url: "../ajax/edit_attribute.php",
    method: "GET",
    data: { attributes_id: attributes_id },
    dataType: "json",
    success: function (data) {
      console.log(data);
      $("#attributes_id").val(data.attributes_id);
      $("#attributes_name").val(data.attributes_name);
      console.log($("#attributes_name").val());
      $("#view_attr_page").fadeOut(100, function () {
        // Show the new page after a delay
        $("#edit_attr_page").fadeIn(100);
      });
    },
  });
});
// Fetch Brand
$(document).on("click", ".delete-attributes", function () {
  if (confirm("Do you really want to delete this record ? ")) {
    var catID = $(this).data("id");
    var obj = { catid: catID };
    var myJSON = JSON.stringify(obj);
    var row = this;
    $.ajax({
      url: "dash_apis/delete-attributes.php",
      type: "POST",
      data: myJSON,
      success: function (response) {
        //          alert(response);
        if (response == 1) {
          //                    swal("", "Record Deleted.", "success");
          setTimeout(function () {
            //                        alert('Reloading Page');
            location.reload(true);
          }, 200);
          //                    load_json_data('getcategory');
        }
      },
    });
  }
});
// <-----------------------------end attributes-------------------------------->
// <-----------------------------add product-------------------------------->
$("#add_prdt").on("submit", "#add_product", function (e) {
  e.preventDefault();
  var form = $(this)[0];
  var dataform = new FormData(form);
  //      console.log(dataform);
  $.ajax({
    type: "post",
    url: "dash_apis/add-product_api.php",
    data: dataform,
    cache: false,
    contentType: false,
    encetype: "form-data",
    processData: false,
    beforeSend: function () {
      $("#attr_btn").prop("disabled", true); // disable button
      $("#attr_btn").text("Uploading Please Wait...");
    },
    success: function (response) {
      if (response == 1) {
        swal("", "New Record Added.", "success");
        $("#attr_btn").prop("disabled", false); // disable button
        $("#add_product").trigger("reset"); //after submite form values clear
        $("#attr_btn").text("Submit");
      }
      if (response == 0) {
        swal("", "Something is wrong please try again.", "warning");
        $("#attr_btn").prop("disabled", false); // disable button
        $("#attr_btn").text("Submit");
      }
    },
  });
});
// Fetch Brand
// <-----------------------------edit product-------------------------------->
$("#add_prdts").on("submit", "#add_products", function (e) {
  e.preventDefault();
  var form = $(this)[0];
  var dataform = new FormData(form);
  console.log(dataform);
  $.ajax({
    type: "post",
    url: "dash_apis/edit-product_api.php",
    data: dataform,
    cache: false,
    contentType: false,
    encetype: "form-data",
    processData: false,
    beforeSend: function () {
      $("#attr_btn").prop("disabled", true); // disable button
      $("#attr_btn").text("Uploading Please Wait...");
    },
    success: function (response) {
      if (response == 1) {
        swal("", "New Record Added.", "success");
        $("#attr_btn").prop("disabled", false); // disable button
        $("#add_products").trigger("reset"); //after submite form values clear
        $("#attr_btn").text("Submit");
      }
      if (response == 0) {
        swal("", "Something is wrong please try again.", "warning");
        $("#attr_btn").prop("disabled", false); // disable button
        $("#attr_btn").text("Submit");
      }
    },
  });
});
// edit Brand
//fetch products
function load_poduct() {
  // $("#load-brand").html("");
  $.ajax({
    url: "dash_apis/fetch_product.php",
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    // "dataSrc": "tableData",
    success: function (data) {
      console.log(data);
      var html = "";
      $.each(data, function (key, value) {
        html += "<tr>";
        html +=
          "<td><img style='width:40px;' src='../upload/product/" +
          value.product_image1 +
          "'></td>";
        html += "<td>" + value.product_name + "</td>";
        html += "<td>" + value.category_name + "</td>";
        html += "<td>" + "sku" + value.sku_no + "</td>";
        html += "<td>" + "₹" + value.product_new_price + "</td>";
        html += "<td>" + value.product_description + "</td>";
        html += "<td>" + value.specification + "</td>";
        html +=
          "<td>" +
          "<span>active </span><i style='color:#16a085;font-size:9px' class='fa-solid fa-circle'></i>" +
          "</td>";
        html +=
          "<td  style='display:flex;justify-content: space-between;';><i id='edit_product' class='edit-product fa fa-edit btn btn-primary' data-eid='" +
          value.product_id +
          "'></i> <i class='delete-product fa fa-trash-o btn btn-danger' data-id='" +
          value.product_id +
          "'></i></td>";
        html +=
          "<td>" +
          "<button name='view_btn' data-toggle='modal' data-target='#exampleModal' class='btn btn-primary view_button' style='background:#16a085;color:white' id=" +
          value.product_id +
          ">View</button>" +
          "</td>";
        html += "</tr>";
      });
      $("#load-product").html(html);
      $("#example-table").dataTable({
        // "destroy": true,
        // "stateSave": true,
        bDestroy: true,
        bRetrive: true,
      });
    },
  });
}
load_poduct();
//product view button click
$(document).on("click", ".view_button", function (e) {
  e.preventDefault();
  var product_id = $(this).attr("id");
  // alert(product_id);
  $.ajax({
    url: "../ajax/view_details.php",
    method: "GET",
    data: { product_id: product_id },
    dataType: "json",
    success: function (data) {
      console.log(data);
      //var data=JSON.parse(response);
      $("#product_name").val(data.product_name);
      $("#product_image1").html(
        '<img src="../upload/product/' +
        data.product_image1 +
        '" style="width:100px;height:auto;">'
      );
      $("#product_image2").html(
        '<img src="../upload/product/' +
        data.product_image2 +
        '"style="width:100px;height:auto;">'
      );
      $("#product_image3").html(
        '<img src="../upload/product/' +
        data.product_image3 +
        '"style="width:100px;height:auto;">'
      );
      $("#product_image4").html(
        '<img src="../upload/product/' +
        data.product_image4 +
        '"style="width:100px;height:auto;">'
      );
      $("#product_image5").html(
        '<img src="../upload/product/' +
        data.product_image5 +
        '"style="width:100px;height:auto;">'
      );
      $("#category_name").val(data.category_name);
      $("#sub_category_name").val(data.sub_category_name);
      $("#sku_no").val(data.sku_no);
      $("#product_new_price").val(data.product_new_price);
      $("#product_old_price").val(data.product_old_price);
      $("#brand_name").val(data.brand_name);
      $("#product_description").val(data.product_description);
      $("#specification").val(data.specification);
      console.log(product_image1);
    },
  });
});



//     delete-dealoftheday
$(document).on('click', '.delete-dealoftheday', function (e) {
  e.preventDefault();
  var product_id = $(this).attr('data-id');
  $.ajax({
    url: '../ajax/delete-dealOfTheDay.php',
    method: 'POST',
    data: { product_id: product_id },
    dataType: 'json',
    success: function (response) {
      console.log(response);
      if (response.status == 'success') {
        swal("", "Deleted The Deal.", "success");
        location.replace(location.href);
      } else {
        swal("", "Already Added To Day Of The Deal.");
      }
    },
  });

});





//edit product 1p
$(document).on("click", "#edit_product", function (e) {
  e.preventDefault();
  var product_id = $(this).attr("data-eid");
  // alert(product_id);
  $.ajax({
    url: "../ajax/edit_details.php",
    method: "GET",
    data: { product_id: product_id },
    dataType: "json",
    success: function (data) {
      console.log(data);
      // var data=JSON.parse(response);
      $("#p_id").val(data.product_id);
      $("#p_name").val(data.product_name);
      $("#p_img1").val(data.product_image1);
      $("#p_img2").val(data.product_image2);
      $("#p_img3").val(data.product_image3);
      $("#p_img4").val(data.product_image4);
      $("#p_img5").val(data.product_image5);
      $("#p_image1").html(
        '<img src="../upload/product/' +
        data.product_image1 +
        '"style="width:auto;height:100px;">'
      );
      $("#p_image2").html(
        '<img src="../upload/product/' +
        data.product_image2 +
        '"style="width:auto;height:100px;">'
      );
      $("#p_image3").html(
        '<img src="../upload/product/' +
        data.product_image3 +
        '"style="width:auto;height:100px;">'
      );
      $("#p_image4").html(
        '<img src="../upload/product/' +
        data.product_image4 +
        '"style="width:auto;height:100px;">'
      );
      $("#p_image5").html(
        '<img src="../upload/product/' +
        data.product_image5 +
        '"style="width:auto;height:100px;">'
      );
      $("#cat_name").val(data.category_name);
      $("#cat_id").val(data.category_id);
      $("#sub_cat_name").val(data.sub_category_name);
      $("#s_no").val(data.sku_no);
      $("#p_new_price").val(data.product_new_price);
      $("#p_old_price").val(data.product_old_price);
      $("#b_name").val(data.brand_name);
      $("#p_description").val(data.product_description);
      $("#spec").val(data.specification);
      console.log($("#p_img1").val());
      $("#product_listsss").fadeOut(100, function () {
        // Show the new page after a delay
        $("#edit_product_page").fadeIn(100);
      });
    },
  });
});
//     deleteproduct
$(document).on("click", ".delete-product", function () {
  if (confirm("Do you really want to delete this record ? ")) {
    var catID = $(this).data("id");
    var obj = { catid: catID };
    var myJSON = JSON.stringify(obj);
    var row = this;
    $.ajax({
      url: "dash_apis/delete-product.php",
      type: "POST",
      data: myJSON,
      success: function (response) {
        //          alert(response);
        if (response == 1) {
          swal("", "Record Deleted.", "success");
          setTimeout(function () {
            //                        alert('Reloading Page');
            location.reload(true);
          }, 200);
          //                    load_json_data('getcategory');
        }
      },
    });
  }
});
// <-----------------------------end product-------------------------------->
//add slider
$("#add_slider_banner").on("submit", "#add_slider", function (e) {
  e.preventDefault();
  var form = $(this)[0];
  // alert('add_slider_banner');
  var dataform = new FormData(form);
  console.log(dataform);
  $.ajax({
    type: "post",
    url: "dash_apis/add-slider_api.php",
    data: dataform,
    cache: false,
    contentType: false,
    encetype: "multipart/form-data",
    processData: false,
    beforeSend: function () {
      $("#cat_btn").prop("disabled", true); // disable button
      $("#cat_btn").text("Uploading Please Wait...");
    },
    success: function (response) {
      if (response == 1) {
        swal("", "New Record Added.", "success");
        $("#cat_btn").prop("disabled", false); // disable button
        $("#add_slider").trigger("reset");
        $("#cat_btn").text("Submit");
      }
      if (response == 0) {
        swal("", "Something is wrong please try again.", "warning");
        $("#cat_btn").prop("disabled", false); // disable button
        $("#cat_btn").text("Submit");
      }
    },
  });
});
// fetch-category
function loadallslider() {
  // $("#load-brand").html("");
  $.ajax({
    url: "dash_apis/fetch_slider.php",
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    // "dataSrc": "tableData",
    success: function (data) {
      var html = "";
      $.each(data, function (key, value) {
        html += "<tr>";
        html +=
          "<td><img style='width:40px;' src='../upload/slider_banner/" +
          value.background_image +
          "'></td>";
        html +=
          "<td><img style='width:40px;' src='../upload/slider_banner/" +
          value.image +
          "'></td>";
        html += "<td>" + value.title + "</td>";
        html += "<td>" + value.content + "</td>";
        html +=
          "<td style='display:flex;justify-content: space-around;padding: 16px;';><i class='edit_slider fa fa-edit btn btn-primary' data-eid='" +
          value.id +
          "'></i> <i class='delete-slider fa fa-trash-o btn btn-danger' data-id='" +
          value.id +
          "'></i></td>";
        html += "</tr>";
      });
      $("#load-slider").html(html);
      $("#example-table").dataTable({
        // "destroy": true,
        // "stateSave": true,
        bDestroy: true,
        bRetrive: true,
      });
    },
  });
}
loadallslider();
//1edit slider
$(document).on("click", ".edit_slider", function (e) {
  e.preventDefault();
  var product_id = $(this).attr("data-eid");
  // alert(product_id);
  $.ajax({
    url: "../ajax/edit_slider.php",
    method: "GET",
    data: { product_id: product_id },
    dataType: "json",
    success: function (data) {
      console.log(data.background_image);
      $("#slider_id").val(data.id);
      $("#slider_bgimage").val(data.background_image);
      $("#slider_img").val(data.image);
      $("#slider_background_image").html(
        '<img src="../upload/slider_banner/' +
        data.background_image +
        '"style="width:auto;height:100px;">'
      );
      $("#slider_image").html(
        '<img src="../upload/slider_banner/' +
        data.image +
        '"style="width:auto;height:100px;">'
      );
      $("#slider_title").val(data.title);
      $("#slider_cont").val(data.content);
      console.log($("#slider_bgimage").val());
      $("#slide_page_show").fadeOut(100, function () {
        // Show the new page after a delay
        $("#slide_page_hide").fadeIn(100);
      });
    },
  });
});
// <-----------------------------update slider-------------------------------->
$("#upt_slider_banner").on("submit", "#upt_slider", function (e) {
  e.preventDefault();
  var form = $(this)[0];
  var dataform = new FormData(form);
  console.log(dataform);
  $.ajax({
    type: "post",
    url: "dash_apis/edit-slider_api.php",
    data: dataform,
    cache: false,
    contentType: false,
    encetype: "form-data",
    processData: false,
    beforeSend: function () {
      $("#attr_btn").prop("disabled", true); // disable button
      $("#attr_btn").text("Uploading Please Wait...");
    },
    success: function (response) {
      if (response == 1) {
        swal("", "New Record Added.", "success");
        $("#attr_btn").prop("disabled", false); // disable button
        $("#upt_slider").trigger("reset"); //after submite form values clear
        $("#attr_btn").text("Submit");
      }
      if (response == 0) {
        swal("", "Something is wrong please try again.", "warning");
        $("#attr_btn").prop("disabled", false); // disable button
        $("#attr_btn").text("Submit");
      }
    },
  });
});
//     delete-slider
$(document).on("click", ".delete-slider", function () {
  if (confirm("Do you really want to delete this record ? ")) {
    var catID = $(this).data("id");
    var obj = { catid: catID };
    var myJSON = JSON.stringify(obj);
    var row = this;
    $.ajax({
      url: "dash_apis/delete-slider.php",
      type: "POST",
      data: myJSON,
      success: function (response) {
        //          alert(response);
        if (response == 1) {
          swal("", "Record Deleted.", "success");
          setTimeout(function () {
            //                        alert('Reloading Page');
            location.reload(true);
          }, 200);
          //                    load_json_data('getcategory');
        }
      },
    });
  }
});
// ----------------------------------end slider-------------------------


$('#cards_banner').on('submit', '#cards', function (e) {
  e.preventDefault();
  var form = $(this)[0];
  var dataform = new FormData(form);
  console.log(dataform);
  $.ajax({
    type: "post",
    url: 'dash_apis/add-cards_api.php',
    data: dataform,
    cache: false,
    contentType: false,
    encetype: "multipart/form-data",
    processData: false,
    beforeSend: function () {
      $("#btn_cards").prop('disabled', true); // disable button
      $("#btn_cards").text("Uploading Please Wait...");
    },
    success: function (response) {
      if (response == 1) {
        swal("", "New Record Added.", "success");
        $("#btn_cards").prop('disabled', false); // disable button
        $("#cards").trigger("reset");
        $("#btn_cards").text("Submit");
      }
      if (response == 0) {
        swal("", "Something is wrong please try again.", "warning");
        $("#cat_btn").prop('disabled', false); // disable button
        $("#cat_btn").text("Submit");
      }
    },
  });
});
// fetch-card
function loadallcards() {
  $.ajax({
    url: 'dash_apis/fetch_cards.php',
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    success: function (data) {
      var html = '';
      $.each(data, function (key, value) {
        html += "<tr>";
        html += "<td><img style='width:40px;' src='../upload/cards/" + value.image + "'></td>";
        html += "<td>" + value.product_name + "</td>";
        html += "<td>" + value.about_price + "</td>";
        html += "<td>" + value.primary_text + "</td>";
        html += "<td style='display:flex;justify-content: space-around;padding: 16px;';><i class='edit-card fa fa-edit btn btn-primary' data-eid='" + value.cards_id + "'></i> <i class='delete-card fa fa-trash-o btn btn-danger' data-id='" + value.cards_id + "'></i></td>";
        html += "</tr>";
      });
      $('#load-cards').html(html);
      $("#example-table").dataTable({
        "bDestroy": true,
        "bRetrive": true,
      });
    }
  });
}
loadallcards();
//1edit card
$(document).on("click", ".edit-card", function (e) {
  e.preventDefault();
  var cards_id = $(this).attr('data-eid');
  $.ajax({
    url: '../ajax/edit_card.php',
    method: 'GET',
    data: { cards_id: cards_id },
    dataType: 'json',
    success: function (data) {
      console.log(data);
      $("#card_id").val(data.cards_id);
      $("#card_name").val(data.product_name);
      $("#card_price").val(data.about_price);
      $("#cardprimary_text").val(data.primary_text);
      $("#card_img").val(data.image);
      $("#card_image").html('<img src="../upload/cards/' + data.image + '"style="width:auto;height:100px;">');
      $("#card_show").fadeOut(100, function () {
        $("#card_hide").fadeIn(100);
      })
    }
  });
});
// <-----------------------------update slider-------------------------------->
$('#card_hide').on('submit', '#upt_cards', function (e) {
  e.preventDefault();
  var form = $(this)[0];
  var dataform = new FormData(form);
  console.log(dataform);
  $.ajax({
    type: "post",
    url: 'dash_apis/edit-card_api.php',
    data: dataform,
    cache: false,
    contentType: false,
    encetype: "form-data",
    processData: false,
    beforeSend: function () {
      $("#attr_btn").prop('disabled', true); // disable button
      $("#attr_btn").text("Uploading Please Wait...");
    },
    success: function (response) {
      if (response == 1) {
        swal("", "New Record Added.", "success");
        $("#attr_btn").prop('disabled', false); // disable button
        $("#upt_cards").trigger("reset");//after submite form values clear
        $("#attr_btn").text("Submit");
      }
      if (response == 0) {
        swal("", "Something is wrong please try again.", "warning");
        $("#attr_btn").prop('disabled', false); // disable button
        $("#attr_btn").text("Submit");
      }
    },
  });
});
//delete-slider
$(document).on("click", ".delete-card", function () {
  if (confirm("Do you really want to delete this record ? ")) {
    var catID = $(this).data("id");
    var obj = { catid: catID };
    var myJSON = JSON.stringify(obj);
    var row = this;
    $.ajax({
      url: 'dash_apis/delete-cards.php',
      type: "POST",
      data: myJSON,
      success: function (response) {
        //          alert(response);
        if (response == 1) {
          swal("", "Record Deleted.", "success");
          setTimeout(function () {
            //                        alert('Reloading Page');
            location.reload(true);
          }, 200);
          //                    load_json_data('getcategory');
        }
      },
    });
  }
});







//---------------------start add largecards----------------------
$('#largecards_banner').on('submit', '#largecards', function (e) {
  e.preventDefault();
  var form = $(this)[0];
  var dataform = new FormData(form);
  console.log(dataform);
  $.ajax({
    type: "post",
    url: 'dash_apis/add-largecards_api.php',
    data: dataform,
    cache: false,
    contentType: false,
    encetype: "multipart/form-data",
    processData: false,
    beforeSend: function () {
      $("#btn_largecards").prop('disabled', true); // disable button
      $("#btn_largecards").text("Uploading Please Wait...");
    },
    success: function (response) {
      if (response == 1) {
        swal("", "New Record Added.", "success");
        $("#btn_largecards").prop('disabled', false); // disable button
        $("#largecards").trigger("reset");
        $("#btn_largecards").text("Submit");
      }
      if (response == 0) {
        swal("", "Something is wrong please try again.", "warning");
        $("#btn_largecards").prop('disabled', false); // disable button
        $("#btn_largecards").text("Submit");
      }
    },
  });
});
// fetch_largecards
function loadalllargecards() {
  $.ajax({
    url: 'dash_apis/fetch_largecards.php',
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    success: function (data) {
      var html = '';
      $.each(data, function (key, value) {
        html += "<tr>";
        html += "<td><img style='width:40px;' src='../upload/largecards/" + value.image + "'></td>";
        html += "<td>" + value.product_name + "</td>";
        html += "<td>" + value.about_price + "</td>";
        html += "<td>" + value.primary_text + "</td>";
        html += "<td style='display:flex;justify-content: space-around;padding: 16px;';><i class='edit-largecards fa fa-edit btn btn-primary' data-eid='" + value.largecards_id + "'></i> <i class='delete-largecard fa fa-trash-o btn btn-danger' data-id='" + value.largecards_id + "'></i></td>";
        html += "</tr>";
      });
      $('#load-largecards').html(html);
      $("#example-table").dataTable({
        "bDestroy": true,
        "bRetrive": true,
      });
    }
  });
}
loadalllargecards();
//1edit card
$(document).on("click", ".edit-largecards", function (e) {
  e.preventDefault();
  var cards_id = $(this).attr('data-eid');
  $.ajax({
    url: '../ajax/edit_largecard.php',
    method: 'GET',
    data: { cards_id: cards_id },
    dataType: 'json',
    success: function (data) {
      console.log(data);
      $("#card_id").val(data.largecards_id);
      $("#card_name").val(data.product_name);
      $("#card_price").val(data.about_price);
      $("#cardprimary_text").val(data.primary_text);
      $("#card_img").val(data.image);
      $("#card_image").html('<img src="../upload/largecards/' + data.image + '"style="width:auto;height:100px;">');
      $("#largecard_show").fadeOut(100, function () {
        $("#largecard_hide").fadeIn(100);
      })
    }
  });
});
// <-----------------------------update slider-------------------------------->
$('#largecard_hide').on('submit', '#upt_largecards', function (e) {
  e.preventDefault();
  var form = $(this)[0];
  var dataform = new FormData(form);
  console.log(dataform);
  $.ajax({
    type: "post",
    url: 'dash_apis/edit-largecard_api.php',
    data: dataform,
    cache: false,
    contentType: false,
    encetype: "form-data",
    processData: false,
    beforeSend: function () {
      $("#attr_btn").prop('disabled', true); // disable button
      $("#attr_btn").text("Uploading Please Wait...");
    },
    success: function (response) {
      if (response == 1) {
        swal("", "New Record Added.", "success");
        $("#attr_btn").prop('disabled', false); // disable button
        $("#upt_largecards").trigger("reset");//after submite form values clear
        $("#attr_btn").text("Submit");
      }
      if (response == 0) {
        swal("", "Something is wrong please try again.", "warning");
        $("#attr_btn").prop('disabled', false); // disable button
        $("#attr_btn").text("Submit");
      }
    },
  });
});
//delete-slider
$(document).on("click", ".delete-card", function () {
  if (confirm("Do you really want to delete this record ? ")) {
    var catID = $(this).data("id");
    var obj = { catid: catID };
    var myJSON = JSON.stringify(obj);
    var row = this;
    $.ajax({
      url: "dash_apis/delete-cards.php",
      type: "POST",
      data: myJSON,
      success: function (response) {
        //          alert(response);
        if (response == 1) {
          swal("", "Record Deleted.", "success");
          setTimeout(function () {
            //                        alert('Reloading Page');
            location.reload(true);
          }, 200);
          //                    load_json_data('getcategory');
        }
      },
    });
  }
});
//delete-largecard
$(document).on("click", ".delete-largecard", function () {
  if (confirm("Do you really want to delete this record ? ")) {
    var catID = $(this).data("id");
    var obj = { catid: catID };
    var myJSON = JSON.stringify(obj);
    var row = this;
    $.ajax({
      url: "dash_apis/delete-largecards.php",
      type: "POST",
      data: myJSON,
      success: function (response) {
        //          alert(response);
        if (response == 1) {
          swal("", "Record Deleted.", "success");
          setTimeout(function () {
            //                        alert('Reloading Page');
            location.reload(true);
          }, 200);
          //                    load_json_data('getcategory');
        }
      },
    });
  }
});
//order view button click
$(document).on("click", ".order_view_button", function (e) {
  e.preventDefault();
  var order_id = $(this).attr("id");
  alert(order_id);
  $.ajax({
    url: "../ajax/view_order_details.php",
    method: "GET",
    data: { order_id: order_id },
    dataType: "json",
    success: function (data) {
      console.log(data);
      //var data=JSON.parse(response);
      $("#product_name").val(data.product_name);
      $("#product_image1").html(
        '<img src="../upload/product/' +
        data.product_image1 +
        '" style="width:100px;height:auto;">'
      );
      $("#product_image2").html(
        '<img src="../upload/product/' +
        data.product_image2 +
        '"style="width:100px;height:auto;">'
      );
      $("#product_image3").html(
        '<img src="../upload/product/' +
        data.product_image3 +
        '"style="width:100px;height:auto;">'
      );
      $("#product_image4").html(
        '<img src="../upload/product/' +
        data.product_image4 +
        '"style="width:100px;height:auto;">'
      );
      $("#product_image5").html(
        '<img src="../upload/product/' +
        data.product_image5 +
        '"style="width:100px;height:auto;">'
      );
      $("#category_name").val(data.category_name);
      $("#sub_category_name").val(data.sub_category_name);
      $("#sku_no").val(data.sku_no);
      $("#product_new_price").val(data.product_new_price);
      $("#product_old_price").val(data.product_old_price);
      $("#brand_name").val(data.brand_name);
      $("#product_description").val(data.product_description);
      $("#specification").val(data.specification);
      console.log(product_image1);
    },
  });
});
//shipping status button click
$(document).on("click", ".ShipingStatus", function (e) {
  // alert('ShipingStatus');
  e.preventDefault();
  var order_id = $(this).attr("id");
  // alert(order_id);
  $.ajax({
    url: "../ajax/ShipingStatus.php",
    method: "GET",
    data: { order_id: order_id },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response.status == "success") {
        location.reload(); // reload the page if the response status is 'success'
      } else {
        console.log("Error:", response.message);
      }
    },
  });
});
//delivery status button click
$(document).on("click", ".DeliveryStatus", function (e) {
  // alert('ShipingStatus');
  e.preventDefault();
  var delivery_id = $(this).attr("id");
  // alert(order_id);
  $.ajax({
    url: "../ajax/DeliveryStatus.php",
    method: "GET",
    data: { delivery_id: delivery_id },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response.status == "success") {
        location.reload(); // reload the page if the response status is 'success'
      } else {
        console.log("Error:", response.message);
      }
    },
  });
});
//add vendor details--start vendor page ------------------------------------------->
$("#add_vndr").on("submit", "#add_vendor", function (e) {
  // alert('add_vendor');
  e.preventDefault();
  var form = $(this)[0];
  var dataform = new FormData(form);
  console.log(dataform);
  $.ajax({
    type: "post",
    url: "dash_apis/add-vendor_api.php",
    data: dataform,
    cache: false,
    contentType: false,
    encetype: "form-data",
    processData: false,
    beforeSend: function () {
      $("#vndr_btn").prop("disabled", true); // disable button
      $("#vndr_btn").text("Uploading Please Wait...");
    },
    success: function (response) {
      if (response == 1) {
        swal("", "New Record Added.", "success");
        $("#vndr_btn").prop("disabled", false); // disable button
        $("#add_vendor").trigger("reset"); //after submite form values clear
        $("#vndr_btn").text("Submit");
      }
      if (response == 0) {
        swal("", "Something is wrong please try again.", "warning");
        $("#vndr_btn").prop("disabled", false); // disable button
        $("#vndr_btn").text("Submit");
      }
    },
  });
});
//fetch vendors
function load_vendor() {
  // $("#load-brand").html("");
  $.ajax({
    url: "dash_apis/fetch_vendors.php",
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    // "dataSrc": "tableData",
    success: function (data) {
      console.log(data);
      var html = "";
      $.each(data, function (key, value) {
        html += "<tr>";
        html +=
          "<td><img style='width:40px;' src='../upload/vendors/" +
          value.image +
          "'></td>";
        html += "<td>" + value.name + "</td>";
        html += "<td>" + value.phone + "</td>";
        html += "<td>" + value.email + "</td>";
        html += "<td>" + value.city + "</td>";
        html += "<td>" + value.state + "</td>";
        html +=
          "<td>" +
          "<span>active </span><i style='color:#16a085;font-size:9px' class='fa-solid fa-circle'></i>" +
          "</td>";
        html +=
          "<td  style='display:flex;justify-content: space-between;';><i id='edit_vendor' class='edit-edit_vendor fa fa-edit btn btn-primary' data-eid='" +
          value.vendor_id +
          "'></i> <i class='delete-vendor fa fa-trash-o btn btn-danger' data-id='" +
          value.vendor_id +
          "'></i></td>";
        html +=
          "<td >" +
          "<button name='vendor_view_btn' data-toggle='modal' data-target='#exampleModal1' class='btn btn-primary vendor_view_button' style='background:#16a085;color:white' id=" +
          value.vendor_id +
          ">View</button>" +
          "</td>";
        html += "</tr>";
      });
      $("#load-vendor").html(html);
      $("#example-table").dataTable({
        // "destroy": true,
        // "stateSave": true,
        bDestroy: true,
        bRetrive: true,
      });
    },
  });
}
load_vendor();
//vendor view button click
$(document).on("click", ".vendor_view_button", function (e) {
  e.preventDefault();
  var vendor_id = $(this).attr("id");
  // alert(product_id);
  $.ajax({
    url: "../ajax/vendor_view_details.php",
    method: "GET",
    data: { vendor_id: vendor_id },
    dataType: "json",
    success: function (data) {
      console.log(data);
      //var data=JSON.parse(response);
      $("#vendor_image").html(
        '<img src="../upload/vendors/' +
        data.image +
        '" style="width:100px;height:auto;">'
      );
      $("#vendor_name").val(data.name);
      $("#vendor_phone").val(data.phone);
      $("#vendor_email").val(data.email);
      $("#vendor_city").val(data.city);
      $("#vendor_state").val(data.state);
      $("#vendor_pincode").val(data.pincode);
      $("#vendor_address").val(data.address);
      $("#pan_no").val(data.pan_no);
      $("#pan_card_img").html(
        '<img src="../upload/vendors/' +
        data.pan_card_img +
        '"style="width:100px;height:auto;">'
      );
      $("#aadhar_no").val(data.aadhar_no);
      $("#aadhar_front_img").html(
        '<img src="../upload/vendors/' +
        data.aadhar_front_img +
        '"style="width:100px;height:auto;">'
      );
      $("#aadhar_back_img").html(
        '<img src="../upload/vendors/' +
        data.aadhar_back_img +
        '"style="width:100px;height:auto;">'
      );
      $("#gst_no").val(data.gst_no);
      $("#gst_certificate_img").html(
        '<img src="../upload/vendors/' +
        data.gst_certificate_img +
        '"style="width:100px;height:auto;">'
      );
      console.log(product_image1);
    },
  });
});
//edit vendor 1p
$(document).on("click", "#edit_vendor", function (e) {
  e.preventDefault();
  var vendor_id = $(this).attr("data-eid");
  // alert(vendor_id);
  $.ajax({
    url: "../ajax/edit_vendor_details.php",
    method: "GET",
    data: { vendor_id: vendor_id },
    dataType: "json",
    success: function (data) {
      console.log(data);
      // var data=JSON.parse(response);
      $("#vendor_id").val(data.vendor_id);
      $("#v_name").val(data.name);
      $("#v_img").val(data.image);
      $("#v_pan_card_img").val(data.pan_card_img);
      $("#v_aadhar_front_img").val(data.aadhar_front_img);
      $("#v_aadhar_back_img").val(data.aadhar_back_img);
      $("#v_gst_certificate_img").val(data.gst_certificate_img);
      $("#v_image").html(
        '<img src="../upload/vendors/' +
        data.image +
        '"style="width:auto;height:100px;">'
      );
      $("#v_pan_card_image").html(
        '<img src="../upload/vendors/' +
        data.pan_card_img +
        '"style="width:auto;height:100px;">'
      );
      $("#v_aadhar_front_image").html(
        '<img src="../upload/vendors/' +
        data.aadhar_front_img +
        '"style="width:auto;height:100px;">'
      );
      $("#v_aadhar_back_image").html(
        '<img src="../upload/vendors/' +
        data.aadhar_back_img +
        '"style="width:auto;height:100px;">'
      );
      $("#v_gst_certificate_image").html(
        '<img src="../upload/vendors/' +
        data.gst_certificate_img +
        '"style="width:auto;height:100px;">'
      );
      $("#v_phone").val(data.phone);
      $("#v_email").val(data.email);
      $("#v_city").val(data.city);
      $("#v_state").val(data.state);
      $("#v_pincode").val(data.pincode);
      $("#v_address").val(data.address);
      $("#v_pan_no").val(data.pan_no);
      $("#v_aadhar_no").val(data.aadhar_no);
      $("#v_gst_no").val(data.gst_no);
      console.log($("#v_pan_card_img").val());
      $("#hide_vendor_form").fadeOut(100, function () {
        // Show the new page after a delay
        $("#show_vendor_form").fadeIn(100);
      });
    },
  });
});
// <-----------------------------edit product-------------------------------->
$("#update_vndr").on("submit", "#upt_vndr", function (e) {
  e.preventDefault();
  var form = $(this)[0];
  var dataform = new FormData(form);
  console.log(dataform);
  $.ajax({
    type: "post",
    url: "dash_apis/edit-vendor_api.php",
    data: dataform,
    cache: false,
    contentType: false,
    encetype: "form-data",
    processData: false,
    beforeSend: function () {
      $("#update-vndr_btn").prop("disabled", true); // disable button
      $("#update-vndr_btn").text("Uploading Please Wait...");
    },
    success: function (response) {
      if (response == 1) {
        swal("", "New Record Added.", "success");
        $("#update-vndr_btn").prop("disabled", false); // disable button
        $("#upt_vndr").trigger("reset"); //after submite form values clear
        $("#update-vndr_btn").text("Submit");
      }
      if (response == 0) {
        swal("", "Something is wrong please try again.", "warning");
        $("#update-vndr_btn").prop("disabled", false); // disable button
        $("#update-vndr_btn").text("Submit");
      }
    },
  });
});
//     delete-vendor
$(document).on("click", ".delete-vendor", function () {
  if (confirm("Do you really want to delete this record ? ")) {
    var vendor_id = $(this).data("id");
    var obj = { vendor_id: vendor_id };
    var myJSON = JSON.stringify(obj);
    var row = this;
    $.ajax({
      url: "dash_apis/delete-vendor.php",
      type: "POST",
      data: myJSON,
      success: function (response) {
        //          alert(response);
        if (response == 1) {
          swal("", "Record Deleted.", "success");
          setTimeout(function () {
            //                        alert('Reloading Page');
            location.reload(true);
          }, 200);
          //                    load_json_data('getcategory');
        }
      },
    });
  }
});
//chnage password
$("#chng_pass").on("submit", "#change_pass", function (e) {
  // alert('change_pass');
  e.preventDefault();
  var form = $(this)[0];
  var dataform = new FormData(form);
  console.log(dataform);
  $.ajax({
    type: "post",
    url: "edit-password_api.php",
    data: dataform,
    cache: false,
    contentType: false,
    encetype: "form-data",
    processData: false,
    beforeSend: function () {
      $("#update-vndr_btn").prop("disabled", true); // disable button
      $("#update-vndr_btn").text("Uploading Please Wait...");
    },
    success: function (response) {
      if (response == 1) {
        swal("", "Password Changed.", "success");
        $("#btn-chng_pass").prop("disabled", false); // disable button
        $("#change_pass").trigger("reset"); //after submite form values clear
        $("#btn-chng_pass").text("Submit");
      }
      if (response == 0) {
        swal("", "Old password is wrong please try again.", "warning");
        $("#btn-chng_pass").prop("disabled", false); // disable button
        $("#btn-chng_pass").text("Submit");
      }
    },
  });
});
//cancel admin status button click
$(document).on("click", ".CancelStatus", function (e) {
  e.preventDefault();
  var order_id = $(this).attr("id");
  // alert(order_id);
  if (confirm("Are you sure you want to cancel this product?")) {
    $.ajax({
      url: "../ajax/AdminOrderCancel.php",
      method: "GET",
      data: { order_id: order_id },
      dataType: "json",
      success: function (response) {
        console.log(response);
        if (response.status == "success") {
          location.replace(location.href);
        }
      },
    });
  } else {
    return false;
  }
});
//fetch banner
function loadallbrand() {
  // $("#load-brand").html("");
  $.ajax({
    url: "dash_apis/fetch_banner.php",
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    // "dataSrc": "tableData",
    success: function (data) {
      var html = "";
      $.each(data, function (key, value) {
        html += "<tr>";
        html += "<td>" + value.category_name + "</td>";
        html +=
          "<td><img style='width:40px;' src='../upload/category/" +
          value.cat_image +
          "'></td>";
        // html += "<td><i class='edit-brand fa fa-edit' data-eid='" + value.category_id + "'></i> || <i class='delete-category fa fa-trash-o' data-id='" + value.category_id + "'></i></td>";
        html +=
          "<td style='display:flex;justify-content: space-around;padding: 16px;';><i id='edit_category' class='edit_category fa fa-edit btn btn-primary' data-eid='" +
          value.category_id +
          "'></i> <i class='delete-category fa fa-trash-o btn btn-danger' data-id='" +
          value.category_id +
          "'></i></td>";
        html += "</tr>";
      });
      $("#load-category").html(html);
      $("#example-table").dataTable({
        // "destroy": true,
        // "stateSave": true,
        bDestroy: true,
        bRetrive: true,
      });
    },
  });
}
//user app home api for all details
function loadallbrand() {
  // $("#load-brand").html("");
  $.ajax({
    url: "dash_apis/fetch_home.php",
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    // "dataSrc": "tableData",
    success: function (data) {
      var html = "";
      $.each(data, function (key, value) { });
    },
  });
}

$(document).ready(function () {
  $(".get_cat").on("change", function () {
    var category_id = this.value;
    $.ajax({
      url: "getstates.php",
      type: "POST",
      data: {
        category_id: category_id,
      },
      cache: false,
      success: function (result) {
        $("#state-dropdown").html(result);
        $("#city-dropdown").html(
          '<option value="">Select State First</option>'
        );
      },
    });
  });
});
