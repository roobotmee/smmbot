$(document).ready(function(){

  /* Katogeriye ait servisleri çek */
  category_detail();
  $("#neworder_category").change(function(){
    category_detail();
  });
  /* Katogeriye ait servisleri çek */
  /* Servise ait verileri çek */
  $("#neworder_services").change(function(){
    service_detail();
  });
  $("#payment_method").change(function(){
    addfunds_form();
  });
  /* Servise ait verileri çek */
  /* Sipariş miktarı değişince fiyat hesapla */
  $(document).on('keyup', '#order_quantity', function() {
    var service   = $("#neworder_services").val();
    var quantity  = $("#neworder_quantity").val();
    var charge  = $("#charge_default").val();
    var runs      = $("#dripfeed-runs").val();
    if(quantity != ""){
        
        if( $("#dripfeedcheckbox").prop('checked') ){
            var dripfeed  = "var";
        }else{
            var dripfeed  = "bos";
        }
        var charge_calc = charge*quantity/1000
        $("#charge").val(charge_calc);
        $("#dripfeed-totalquantity").val(data.totalQuantity);
    }else{
        $("#charge").val("0");
    }
  });
  $(document).on('keyup', '#dripfeed-runs', function() {
    var service   = $("#neworder_services").val();
    var quantity  = $("#neworder_quantity").val();
    var runs      = $("#dripfeed-runs").val();
      if( $("#dripfeedcheckbox").prop('checked') ){
        var dripfeed  = "var";
      }else{
        var dripfeed  = "bos";
      }
    $.post('ajax_data',{action:'service_price',service:service,quantity:quantity,dripfeed:dripfeed,runs:runs}, function(data){
        $("#charge").val(data.price);
        $("#dripfeed-totalquantity").val(data.totalQuantity);
    }, 'json');
  });
  $(document).on('keyup', '#neworder_comment', function() {
    comment_charge();
  });
  /* Sipariş miktarı değişince fiyat hesapla */
  /* Dripfeed değiştir */
  $(document).on('change', '#dripfeedcheckbox', function() {
    var dripfeed = $(this).prop('checked');
    if( dripfeed ){
      $("#dripfeed-options").removeClass();
      dripfeed_charge();
    }else{
      $("#dripfeed-options").addClass('hidden');
      dripfeed_charge();
    }
  });
  /* Dripfeed değiştir */
});

function category_detail(){
  var category_now = $("#neworder_category").val();
  $.post('ajax_data',{action:'services_list',category:category_now}, function(data){
      $("#neworder_services").html(data.services);
      service_detail();
  }, 'json');
}

function service_detail(){
  var service_now = $("#neworder_services").val();
  var service_now_name = $("#neworder_services option:selected" ).text();
  $.post('ajax_data',{action:'service_detail',service:service_now}, function(data){
      if( data.empty == 1 ){
        $("#charge_div").hide();
        $('#descriptionContainer').addClass('hidden');
        $('#description_detail').html('');
        $('#service_name').text("N/A");
        $('#example_link').text("N/A");
        $('#example_link').attr('href', "https://anon.ws/?");
        $('#guaranteed').text("N/A");
        $('#speed').text("N/A");
        $('#start_time').text("N/A");
      }else{
        $("#charge_div").show();
        $("#neworder_fields").html(data.details);
        $("#charge").val(data.price);
        $("#charge_default").val(data.price);
        $('#descriptionContainer').removeClass('hidden');
        $('#description_detail').html($('#service_description').get(0).outerHTML);
        $('#service_name').text(service_now_name);
        $('#serviceId').text(service_now);
        $('#start_time').text("0-24H");
        $('#example_link').text("N/A");
        $('#status').text();
        $('#average_time').text("Not enough data");
        $('#speed').text("N/A");
        $('#guaranteed').text("Yes");
      }
    //   $(".datetime").datepicker({
    //      format: "dd/mm/yyyy",
    //      language: "tr",
    //      startDate: new Date(),
    //   }).on('change', function(ev){
    //      $(".datetime").datepicker('hide');
    //   });
      $("#clearExpiry").click(function(){
           $("#expiryDate").val('');
       });
       var dripfeed = $("#dripfeedcheckbox").prop('checked');
       if( dripfeed ){
         $("#dripfeed-options").removeClass();
       }
       comment_charge();
        if( $("#dripfeedcheckbox").prop('checked') ){
          dripfeed_charge();
        }
          if( data.sub ){
            $("#charge_div").hide();
          }else{
            $("#charge_div").show();
          }
  }, 'json');
}

function addfunds_form(){
    var method_now = $("#payment_method").val();
    $("#addfunds_form").html();
    if( $(method_now).val() !== "" ) { 
      $("#addfunds_form").html("<style>.loader {border: 16px solid #f3f3f3;border-radius: 50%;border-top: 16px solid #3498db;width: 120px;height: 120px;-webkit-animation: spin 2s linear infinite; /* Safari */animation: spin 2s linear infinite;}@-webkit-keyframes spin {0% { -webkit-transform: rotate(0deg); }100% { -webkit-transform: rotate(360deg); }}@keyframes spin {0% { transform: rotate(0deg); }100% { transform: rotate(360deg); }}</style><center><div class='loader'></div></center>");
      $.post('ajax_data',{action:'addfunds_form',method:method_now}, function(data){
          $("#addfunds_form").html(data.form_data);
          service_detail();
      }, 'json');
    }
}

function comment_charge(){
  var service   = $("#neworder_services").val();
  var comments  = $("#neworder_comment").val();
    if( comments ){
      $.post('ajax_data',{action:'service_price',service:service,comments:comments}, function(data){
          $("#neworder_quantity").val(data.commentsCount);
          $("#charge").val(data.price);
      }, 'json');
    }
}

function dripfeed_charge(){
  var service     = $("#neworder_services").val();
  var quantity    = $("#neworder_quantity").val();
  var runs        = $("#dripfeed-runs").val();
    if( $("#dripfeedcheckbox").prop('checked') ){
      var dripfeed  = "var";
    }else{
      var dripfeed  = "bos";
    }
  $.post('ajax_data',{action:'service_detail',service:service,quantity:quantity,dripfeed:dripfeed,runs:runs}, function(data){
      $("#charge").val(data.price);
  }, 'json');
}
