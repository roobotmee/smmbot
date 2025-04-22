<?php

session_start();
require ('sql_connect.php');

$api = json_decode(file_get_contents("https://".$_SERVER['HTTP_HOST']."/api/v2?key=".$_SESSION['request']['detail'][1]."&action=balance"),1);

?>
	
	
	
<? if ($_SESSION['request']['ok']==true){?>
<!DOCTYPE html>
<html id="theme_21" lang="en">
<head>
	
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Yangi buyurtma</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="google-site-verification" content="" />

  
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  



      <link rel="stylesheet" type="text/css" href="https://<?=$_SERVER['HTTP_HOST']?>/public/<?=$theme?>/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="https://<?=$_SERVER['HTTP_HOST']?>/public/<?=$theme?>/<?=$style?>.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"><center>
<link rel="shortcut icon" type="image/png" href="https://seensms.uz/assets/images/logos/seensms.jpg" />
    <link rel="stylesheet" href="https://seensms.uz/assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    <link rel="stylesheet" href="https://seensms.uz/assets/css/layout.css">
        <link rel="stylesheet" type="text/css" href="https://<?=$_SERVER['HTTP_HOST']?>/public/<?=$theme?>/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="https://<?=$_SERVER['HTTP_HOST']?>/public/<?=$theme?>/<?=$style?>.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  </head>
<body class="body ">
<div class="wrapper  wrapper-navbar ">
   <div id="block_80">
    <div class="block-wrapper">
        <div class="component_navbar ">
          <div class="component-navbar__wrapper">
             <div class="sidebar-block__top component-navbar component-navbar__navbar-public editor__component-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light">
                      <div style="left:30px;" class="sidebar-block__top-brand">
                                                        <div class="component-navbar-brand component-navbar-public-brand">
                                                                  <a target="_self" href="/"><span style="text-transform: "><span style="font-size: 24px"><span style="letter-spacing: 1.0px"><span style="line-height: 10px"><strong style="font-weight: bold"><?=$_SERVER['HTTP_HOST']?></strong></span></span></span></span></a>
                                                              </div>
                                                                          </div>
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-14" aria-controls="navbar-collapse-14" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-burger">
                        <span class="navbar-burger-line"></span>
                    </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbar-collapse-14">
                     <div class="component-navbar-collapse-divider"></div>
                     <div class="d-flex component-navbar-collapse">
                        <ul class="navbar-nav navbar-nav-sidebar-menu">
<li class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
<a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private "     href="/services" >
                                                                                      <span class="component-navbar-nav-link-icon">
                                             <img src="https://<?=$_SERVER['HTTP_HOST']?>/public/icons/social.png" width=20 height=20>
                                           </span>Xizmatlar
                                                                        </a>
                               </li>                   <li class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
<a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private "     href="/api" >
                                                                                      <span class="component-navbar-nav-link-icon">
                                             <img src="https://<?=$_SERVER['HTTP_HOST']?>/public/icons/api.png" width=20 height=20>
                                           </span>API
                                                                        </a>
                               </li>                   <li class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
<a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private "     href="https://t.me/apiseen_bot" >
                                                                                      <span class="component-navbar-nav-link-icon">
                                             <img src="https://<?=$_SERVER['HTTP_HOST']?>/public/icons/bot.png" width=20 height=20>
                                           </span>Bot
                                                                        </a>
                               </li> 
							   

                                                           </ul>
														  

</nav>
                   
                   
                         </div>
      </div> 
</div>
    </div>
<div class="component_navbar"></div>
    <div class="component_navbar_sub"></div>
</div>
   <div class="wrapper-content">
    <div class="wrapper-content__header">
          </div>


      <div id="block_93">
    <div class="new_order-block ">
        <div class="bg"></div>
        
        <div class="divider-top"></div>
        <div class="divider-bottom"></div>
        <div class="container">
        

        	
       
            <div class="row new-order-form">
                <div class="col-lg-4 col-lg-8 col-lg-12">
                   <div class="component_form_group component_card component_radio_button">
                      <div class=" ">

</div>
    </div>
  </div></div></div></div></div>

    <br><br><br><br><div class="wrapper-content__body">
      <!-- Main variables *content* -->
      <div style = "font-weight: 400;
    padding: 9px 10px 9px 10px;
    border-radius: 12px !important;
    width: 300px;
    border: none;
    background-image: linear-gradient( 183deg,#07c590,#0e8a5c);
    box-shadow: rgb(0 0 0 / 10%) 0px 1px 1px, rgb(255 255 255 / 25%) 0px 1px 1px inset, rgb(107 255 173 / 75%) 0px -4px 15px inset;
    color: #fff !important;
    font-size: 20px;
    text-align: center;">
	<center>
Balansingiz: <?=$api['balance']?> so‘m</b>
Hisob raqam: <?=$_SESSION['request']['detail'][0]?></center>
	
</div><br><br><br>
<div id="block_70">
    <div class="sign-in">
        <div class="bg"></div>
        <div class="divider-top"></div>
        <div class="divider-bottom"></div>
        <div class="container">
            <div class="row sign-up-center-alignment">
                <div class="col-lg-8">
                    <div class="component_card">
                        <div class="card">
					 <? if($req):?>
        <div class="alert alert-dismissible alert-<?=$ress['color']?>">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
         <center> <?=$ress['text']?></center>
        </div>
        
      <? endif;?>
      	
      	
      <br><br>
                           <div class="container mt-2">
	<form action="" method="POST" class="form-group">
    <input type="hidden" name="_token" value="">                        
    <label for="category">Bo'lim</label>
                        <select id="category" class="form-control input-sm">
                            <option>Tanlang</option>
                                       <?

$new_arr = [];
$s = mysqli_query($connect,"SELECT * FROM `services`");

while($a = mysqli_fetch_assoc($s)):

$cid = $a['category_id'];
	$ca = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM cates WHERE cate_id = $cid"));
	$categ = $ca['category_id'];
	$cas= mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM categorys WHERE category_id = $categ"));
$category=base64_decode($cas['category_name'])." ".base64_decode($ca['name']);

?>
	<?php
	
	if(!in_array($category, $new_arr)):
$new_arr[] = $category;
?>
<option data-icon="fab fa-telegram" value="<?=$cid?>"><?=$category?></option>                     
                                                 
<? endif;?>
	<? endwhile; ?>
	
	</select>
	
	<label for="tariff">Tarif nomi</label>
    <select name="tariff" id="tariff" class="form-control input-sm">
        <option value="">Tanlang</option>
    </select>
    <div id="for-info"></div>
    <div id="average"></div>
    <div id ="link"></div>
    <div id ="quan"></div>
    <span id="min"></span><span id="max"></span>
  <span id ="buy"></span>
 <div id="additional"></div>
    <button type="submit" class="btn btn-primary mt-1">Buyurtma berish</button>
</form>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>


                    

<script type="text/javascript" src="https://<?=$_SERVER['HTTP_HOST']?>/style/js/1.js">
      </script>
  <script type="text/javascript" src="https://<?=$_SERVER['HTTP_HOST']?>/style/js/2.js">
      </script>
  <script type="text/javascript" src="https://<?=$_SERVER['HTTP_HOST']?>/style/js/3.js">
      </script>
  <script type="text/javascript" >
     window.modules.layouts = {"theme_id":21,"auth":0,"live":true};   </script>
  <script type="text/javascript" >
     window.modules.api = [];   </script>
  <script type="text/javascript" >
      </script>
      <script src="https://seensms.uz/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="https://seensms.uz/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://seensms.uz/assets/js/sidebarmenu.js"></script>
<script src="https://seensms.uz/assets/js/app.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
      <script>
        $("#category").select2({
            templateResult: formatState,
            templateSelection: formatState,
            escapeMarkup: function(m) {
                return m;
            }
        });

        function formatState(state) {
            if (!state.id) {
                return state.text;
            }

            var icon = state.element.dataset['icon'];
            if (icon) {
                var $icon = $('<i class = "' + icon + '"</i>');
                $state = $('<span>').append($icon).append(' ' + state.text);
            }else{
                $state = $('<span>' + state.text + '</span>');
            }
            return $state;
        }

        $("#tariff").select2();
        $("#category").change(function(){
            let category = $(this).val();
            $.ajax({
                url: "https://<?=$_SERVER['HTTP_HOST']?>/category.php",
                type: "GET",
                data: {
                    category: category
                },
                success: function(data){
                	
                    let html = '<option value="">Tanlang</option>';
                    data.data.forEach(function(tariff){
                    	
                        html += '<option value="'+tariff.id+'">'+tariff.name+' 1000 ta '+tariff.price+' so‘m</option>';

 });
 
$("#tariff").html(html);
                }
                
            });
        });
        $("#tariff").change(function(){
            let service = $(this).val();
            $.ajax({
                url: "https://<?=$_SERVER['HTTP_HOST']?>/category.php",
                type: "GET",
                data: {
                    type: "tarif",
                    service_id: service
                },
                success: function(data){
                    let val = data.data;
                    
                    if(val.desc != ""){
                        $("#for-info").html("<label for=\"info\">Tarif haqida</label>\
    <textarea name=\"tariff_info\" id=\"tariff_info\" cols=\"30\" rows=\"10\" class=\"form-control\" disabled>"+val.desc+"</textarea>");
                    }else{
                        $("#for-info").html("");
                    }
                    if(val.average !="Malumot yoq"){
                    	$("#average").html("<br><label for=\"average\">Bajarilish vaqti</label>\
<input id=\"average\" placeholder=\""+val.average+"\" class=\"form-control\" readonly>");
                    }else{
                    $("#average").html("");	
                    }
                    
                    
                    
                    if(val.type == "Default"){
                    $("#min").html('<b>Min</b> '+val.min+' ,');
                    $("#max").html(' <b>Max</b> '+val.max+'');
                   $("#price").attr('placeholder',val.price);
 $("#quantity").attr('placeholder', val.min);
                 $("#link").html("<label for=\"url\">Havola</label>\
    <input id=\"url\" class=\"form-control\" name=\"url\">");
$("#buy").html("<label for=\"price\">Narxi</label>\
<input type=\"text\" id=\"price\" value =\" "+val.price+" so’m\"class=\"form-control\" disabled>");
    $("#quan").html("<label for=\"quantity\">Soni</label>\
    <input id=\"quantity\" class=\"form-control\" name=\"quantity\">");
 
$("#additional").html("");
                    }else if(val.type == "Package"){
                        $("#min").html("");
                        $("#max").html("");
                        $("#link").html("<label for=\"url\">Havola</label>\
<input id=\"url\" class=\"form-control\" name=\"url\">");
    $("#quan").html("<input id=\"quantity\" class=\"form-control\" name=\"quantity\" value=\"1\" type=\"hidden\">");
 $("#price").attr('placeholder',val.price);
$("#buy").html("<label for=\"price\">Narxi</label>\
<input type=\"text\" id=\"price\" value =\" "+val.price+" so’m\"class=\"form-control\" disabled>");
    
$("#additional").html("");
                    }else{
                    	$("#price").attr('placeholder',val.price);
                    $("#link").html("<label for=\"url\">Havola</label>\
<input id=\"url\" class=\"form-control\" name=\"url\">");
    $("#quan").html("<label for=\"quantity\">Soni</label>\
    <input id=\"quantity\" class=\"form-control\" name=\"quantity\">");	
                	$("#min").html('<b>Min</b> '+val.min+' ,');
                    $("#max").html(' <b>Max</b> '+val.max+'');
                    $("#buy").html("<label for=\"price\">Narxi</label>\
<input type=\"text\" id=\"price\" value =\" "+val.price+" so’m\"class=\"form-control\" disabled>");
    
                        $("#additional").html("<label for=\"answer\">Javob</label>\
    <input id=\"answer\" class=\"form-control\" name=\"answer\">")
                    }
                }
            });
        });
        

        
    </script>
      
</body>
</html>
<? }else{ ?>
<? include "login.php";?>
<? } ?>

