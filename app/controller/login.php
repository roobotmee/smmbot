<?php

session_start();
require ('sql_connect.php');
$req = $_REQUEST;
$id = $req['id'];
$key = $req['key'];
$_csrf = $req['_csrf_key'];

$file = mysqli_query($connect,"SELECT * FROM `users` WHERE user_id = '".$id."'");
$get = mysqli_fetch_assoc($file);
$gets = mysqli_num_rows($file);

if($req){
if($_csrf == $_SESSION['csrf']){
if($gets){
if($get['api_key']==$key){
$json = array('ok'=>true,"detail"=>[$id,$key]);
$_SESSION['request']=$json;
$ress = array('color'=>'success','error'=>0,"text"=>"Buyurtma berish saxifasiga yo'naltirilmoqdasiz...","get_loc"=>"/order/new");
}else{
$ress = array('color'=>'danger','error'=>1,"text"=>"API Key mos kelmaydi!");
}
}else{
$ress = array('color'=>'danger','error'=>1,'text'=>"Hechqanday malumot topilmadi");
}
}else{
$ress = array('color'=>'danger','error'=>1,"text"=>"Kirish taqiqlanadi");
}
}
if($req and $ress['error']==0):
echo '<script>setInterval(function(){window.location="' . $ress['get_loc'] . '"},5000)</script>';
endif;
?>
<!DOCTYPE html>
<html id="theme_21" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>API</title>
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
                            <form action="" method="post" class="component_form_group component_checkbox">
                                <div class="">
<div class="form-group">
                                        
                                        <input style = "font-weight: 600;
    padding: 9px 10px 9px 10px;
    border-radius: 12px !important;
    width: 250px;
    border: none;
    background-image: linear-gradient( 183deg,#07c590,#0e8a5c);
    box-shadow: rgb(0 0 0 / 10%) 0px 1px 1px, rgb(255 255 255 / 25%) 0px 1px 1px inset, rgb(107 255 173 / 75%) 0px -4px 15px inset;
    color: #fff !important;
    font-size: 13px;
    text-align: center;" type="text" class="form-control" id="id" name="id" placeholder="User ID" required=1>
                                                                                                            
                                    </div>
                                                                            <div class="form-group">
                                            
                                            <input style = "font-weight: 600;
    padding: 9px 10px 9px 10px;
    border-radius: 12px !important;
    width: 250px;
    border: none;
    background-image: linear-gradient( 183deg,#07c590,#0e8a5c);
    box-shadow: rgb(0 0 0 / 10%) 0px 1px 1px, rgb(255 255 255 / 25%) 0px 1px 1px inset, rgb(107 255 173 / 75%) 0px -4px 15px inset;
    color: #fff !important;
    font-size: 13px;
    text-align: center;" type="text" class="form-control" id="key" name="key" placeholder="API Key" required>
                                        </div>
                                        <?php 
                                        $_SESSION['csrf']=base64_encode(md5(uniqid()));
                                        ?>
                                       <input name = "_csrf_key" value = "<?=$_SESSION['csrf']?>" type="hidden">
                                                                        
                                      
		   
                                <div class="component_button_submit">
                                    <div class="form-group">
                                        <div class=""><br>
                                            <button style = "font-weight: 600;
    padding: 9px 10px 9px 10px;
    border-radius: 14px !important;
    width: 100px;
    border: none;
    background-image: linear-gradient( 183deg,#e60b52,#c50000);
    box-shadow: rgb(0 0 0 / 10%) 0px 1px 1px, rgb(255 255 255 / 25%) 0px 1px 1px inset, rgb(255 255 255 / 38%) 0px -4px 15px inset;
    color: #fff !important;
    font-size: 13px;
    text-align: center;" type="submit" class="btn btn-block btn-big-primary">Kirish</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">Sizda akount yoqmi <a href="https://t.me/<?=$bot?>" class="sign-up-center-signin-link">ro'yxatdan o'ting</a></div>
                            </form>
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
</body>
</html>


