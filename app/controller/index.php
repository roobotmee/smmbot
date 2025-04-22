<?php

function number($a){
$form = number_format($a,00,',',',');
return $form;
}

require ('sql_connect.php');

function countRow($data){
    global $connect;
    $where    = "";
    if( $data["where"] ):
        $where    = "WHERE ";
        foreach ($data["where"] as $key => $value) {
        	$ar = $data["where"][$key];
            $where.=" $key = '$ar'";
            $execute[$key]=$value;
        }
        
    else:
        $execute[]= "";
    endif;
    $row  = mysqli_query($connect,"SELECT * FROM {$data['table']} $where ");
    
    $validate = mysqli_num_rows($row);
    return ($validate) ;
    
}

?>

<!DOCTYPE html>
<html lang="uz"><head>
  <base href="https://<?=$_SERVER['HTTP_HOST']?>">
  
  
  <title><?=strtoupper($_SERVER['HTTP_HOST'])?></title>
  <meta property="og:title" content="The Best SMM Panel. Super Cheap & Super Fast!" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="Smm panel russian and uzbekistan,smm panel script,smm panel promotion,smm panel netflix,smm panel world,smm panel for free fire,smm panel premium accounts,smm panel app,smm panel apk,smm panel amazon prime,smm panel adalah,smm panel australia,smm panel america,smm panel accept paypal,smm panel api integration,the smm panel,create a smm panel,smm panel blue badge,smm panel bd,smm panel blackhatworld,smm panel bitcoin,smm panel boost,smm panel best price,smm panel business,smm panel bhw,best smm panel,smm panel club,smm panel creator,smm panel cheap india,smm panel.com,smm panel carding,smm panel comparison,total smm panel.com,smm panel service.com,c-dl.com smm panel,c-di.com smm panel,smm panel domain,smm panel discord,smm panel design,smm panel developer,smm panel drip feed,smm panel deutsch,smm panel data,smm panel script download free,original smm panel,smm panel ekşi,best smm panel ever,elite smm panel,easy smm panel,expert smm panel,ecommerce smm panel,enigma smm panel script,smm panel for carding,smm panel for youtube mo">
  <meta name="description" content="Ozbekistondagi #N1 arzon SMM Panel">
  <meta property="og:description" content=" has the Cheapest SMM Panel and 100% High Quality for all social networks. Get the best Instagram panel today" />    <link rel="shortcut icon" type="image/ico" href="public/images/8df1bd5982b694d09ace0550ed9f0738fc91dc3e.png" />
 
  
      <link rel="stylesheet" type="text/css" href="https://<?=$_SERVER['HTTP_HOST']?>/public/<?=$theme?>/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="https://<?=$_SERVER['HTTP_HOST']?>/public/<?=$theme?>/<?=$style?>.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"><center>



  </head>
 <style>


.main-panel .index-announcement {
    float: left;
    width: 100%;
    border-radius: 10px;
}
.main-panel .index-announcement .index-announcement-title {
    float: left;
    width: 100%;
    margin-top: 0;
    font-weight: 600;
    color: #000000;
    margin-bottom: 1px;
    background: #AA00FF;
    padding: 20px 30px;
    border-radius: 10px 10px 0 0;
}
.main-panel .index-announcement .index-announcement-bell {
    float: left;
    width: 50%;
    padding-right: 43px;
    text-align: right;
    margin-top: -20px;
    }
    
.main-panel .index-announcement .index-announcement-content {
    float: left;
    width: 100%;
    overflow-x: hidden;
    overflow-y: scroll;
    height: 470px;
    padding: 0 30px;
    background: #ffffff;
    border-radius: 0 0 10px 10px;
}
.main-panel .index-announcement ul {
    float: left;
    width: 100%;
    margin-top: 10px;
    margin-bottom: 0;
    border-left: 4px solid #eff0ff;
    padding-left: 30px;
}
.main-panel .index-announcement ul li {
    list-style: none;
    float: left;
    width: 100%;
    position: relative;
    margin-bottom: 45px;
    box-shadow: 1px 5px 19px 0 rgb(0 0 0 / 22%);
    padding: 20px;
    border-radius: 0 0 6px 6px;
}
.main-panel .index-announcement ul li:before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 1px;
}
.main-panel .index-announcement ul li .icon {
    position: absolute;
    left: -52px;
    top: 48px;
    width: 40px;
    height: 40px;
    padding: 7px 0;
    text-align: center;
    background: #eff0ff;
    font-size: 16px;
    border-radius: 3px;
    box-shadow: 1px 5px 19px 0 rgba(255,255,255,0.05);
}
.main-panel .index-announcement ul li .time {
    float: left;
    color: #8c909a;
    border-radius: 3px;
    margin-top: 8px;
}
.main-panel .index-announcement ul li .time i {
    margin-right: 5px;
}
.main-panel .index-announcement ul li .t-instagram {
    color: #f40083;
    border-color: #f40083;
}
.main-panel .index-announcement ul li .service {
    float: left;
    width: 100%;
    color: #48494c;
    font-weight: 600;
    margin-top: 10px;
}
.main-panel .index-announcement ul li .desc {
    float: left;
    width: 100%;
    color: #8c909a;
    margin-top: 5px;
}
.main-panel .index-announcement ul li .title {
    float: right;
    color: #8c909a;
    padding: 5px 10px;
    border: 1px solid #8c909a;
    border-radius: 3px;
    width: 90px;
    text-align: center;
    position: relative;
}
.main-panel .index-announcement ul li .t-instagram {
    color: #f40083;
    border-color: #f40083;
}
.main-panel .index-announcement ul li .icon img {
    max-width: 60%;
}
.w .index-announcement-title {
    float: left;
    width: 100%;
    margin-top: 0px;
    font-weight: 600;
    color: #000000;
    margin-bottom: 12px;
    background: #ffffff;
    padding: 20px 30px;
    border-radius: 10px 10px 0 0;
    border-bottom: 1px solid #f33694;
}


</style>








<body class="body ">
<div class="wrapper  wrapper-navbar ">
   <div id="block_80">
    <div class="block-wrapper">
        <div class="component_navbar ">
          <div class="component-navbar__wrapper">
             <div class="sidebar-block__top component-navbar component-navbar__navbar-public editor__component-wrapper">
                <div>
                   <nav class="navbar navbar-expand-lg navbar-light">
                      <div class="sidebar-block__top-brand">
                                                        <div class="component-navbar-brand component-navbar-public-brand">
                                                                  <a target="_self" href="/"><span style="text-transform: "><span style="font-size: 24px"><span style="letter-spacing: 1.0px"><span style="line-height: 10px"><strong style="font-weight: bold"><?=strtoupper($_SERVER['HTTP_HOST'])?></strong></span></span></span></span></a>
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
<a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private "     href="https://t.me/<?=$bot?>" >
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
</div>

<br>
<br> <style>
 .body .modal .modal-content {
    background: #fff;
    color: black;
}

.modal-header h5 {
    color: black;
}
.modal-footer a {
    color: #fff;
}
.modal-header{
 border-bottom: none;
}
.modal-footer{
 border-top: none;
}
 </style>
   <div class="wrapper-content">
    <div class="wrapper-content__header">
          </div>
    <div class="wrapper-content__body">
  <br>  <div id="block_166">
  <div class="totals ">
    <div class="bg"></div>
    <div class="divider-top"></div>
    <div class="divider-bottom"></div>
    <div class="container">
      <div class="row align-items-start justify-content-start">
                              <div class="col-lg-4 col-md-6 mb-2 mt-2">
              <div class="card h-100"
                   style="
                                                                                    padding-top: 24px;                                  padding-bottom: 24px;                                                                                                                                                                                                                                                                                                                                                                                                 ">
                <div class="totals-block__card">
                  <div class="totals-block__card-left">
                    <div
                        class="totals-block__icon-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary"
                        style="
                                                                                                                                                                                                                    ">
                      <br>  <center><img src="https://<?=$_SERVER['HTTP_HOST']?>/public/icons/social.png" width=60 height=60><h2 class="totals-block__count-value style-text-primary"><?=number(countRow(['table'=>"services"])) ?></h2></center>
                    <center><p>Barcha xizmatlar</p></center><br>
</div>
                  </div>
                  <div class="totals-block__card-right">
                    <div class="totals-block__count">
                      
                    </div>
                    <div class="totals-block__card-name">
                                              
                                          </div>
                  </div>
                </div>
              </div>
            </div>
                                        <div class="col-lg-4 col-md-6 mb-2 mt-2">
              <div class="card h-100"
                   style="
                                                                                    padding-top: 24px;                                  padding-bottom: 24px;                                                                                                                                                                                                                                                                                                                                                                                                 ">
                <div class="totals-block__card">
                  <div class="totals-block__card-left">
                    <div
                        class="totals-block__icon-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary"
                        style="
                                                                                                                                                                                                                    ">
                      <br> <center><img src="https://<?=$_SERVER['HTTP_HOST']?>/public/icons/order.png" width=60 height=60><h2 class="totals-block__count-value style-text-primary"><?=number(countRow(['table'=>"orders","where"=>["status"=>"Completed"]])) ?></h2></center>
                  <center><p>Bajarilgan buyurtmalar</p></center><br>  </div>
                    
                  </div>
                  <div class="totals-block__card-right">
                    <div class="totals-block__count">
               
                    </div>
                    <div class="totals-block__card-name">
                                              
                                          </div>
                  </div>
                </div>
              </div>
            </div>
                                        <div class="col-lg-4 col-md-6 mb-2 mt-2">
              <div class="card h-100"
                   style="
                                                                                    padding-top: 24px;                                  padding-bottom: 24px;                                                                                                                                                                                                                                                                                                                                                                                                 ">
                <div class="totals-block__card">
                  <div class="totals-block__card-left">
                  <div class="totals-block__icon-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary"
                        style="
                                                                                                                                                                                                                    ">
              <br><center><img src="https://<?=$_SERVER['HTTP_HOST']?>/public/icons/man.png" width=60 height=60><h2 class="totals-block__count-value style-text-primary"><?=number(countRow(['table'=>"users"])) ?></h2></center>
                    <center><p>Barcha obunachilar</p></center><br>
</div>
                  </div>
                  
                  <div class="totals-block__card-right">
                    <div class="totals-block__count">
                  
                    </div>
                    <div class="totals-block__card-name">
                                              
                                          </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-2 mt-2">
              <div class="card h-100"
                   style="
                                                                                    padding-top: 24px;                                  padding-bottom: 24px;                                                                                                                                                                                                                                                                                                                                                                                                 ">
                <div class="totals-block__card">
                  <div class="totals-block__card-left">
                    <div
                        class="totals-block__icon-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary"
                        style="
                                                                                                                                                                                                                    ">
                      <br> <center><img src="https://<?=$_SERVER['HTTP_HOST']?>/public/icons/24-hours.png" width=60 height=60><h2 class="totals-block__count-value style-text-primary">24/7</h2></center>
                  <center><p>Tezkor yordam markazi</p></center><br>  </div>
                    
                  </div>
                  <div class="totals-block__card-right">
                    <div class="totals-block__count">
               
                    </div>
                    <div class="totals-block__card-name">
                                              
                                          </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-2 mt-2">
              <div class="card h-100"
                   style="
                                                                                    padding-top: 24px;                                  padding-bottom: 24px;                                                                                                                                                                                                                                                                                                                                                                                                 ">
                <div class="totals-block__card">
                  <div class="totals-block__card-left">
                    <div
                        class="totals-block__icon-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary"
                        style="
                                                                                                                                                                                                                    ">
                      <br> <center><img src="https://<?=$_SERVER['HTTP_HOST']?>/public/icons/free.png" width=60 height=60><h2 class="totals-block__count-value style-text-primary"><?=number(countRow(['table'=>"services","where"=>["service_price"=>"0"]])) ?></h2></center>
                  <center><p>Bepul xizmatlar</p></center><br>  </div>
                    
                  </div>
                  <div class="totals-block__card-right">
                    <div class="totals-block__count">
               
                    </div>
                    <div class="totals-block__card-name">
                                              
                                          </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-2 mt-2">
              <div class="card h-100"
                   style="
                                                                                    padding-top: 24px;                                  padding-bottom: 24px;                                                                                                                                                                                                                                                                                                                                                                                                 ">
                <div class="totals-block__card">
                  <div class="totals-block__card-left">
                  <div class="totals-block__icon-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary"
                        style="
                                                                                                                                                                                                                    ">
              <br><center><img src="https://<?=$_SERVER['HTTP_HOST']?>/public/icons/total.png" width=60 height=60><h2 class="totals-block__count-value style-text-primary" ><?=number(countRow(['table'=>"orders"])) ?></h2></center>
                    <center><p>Barcha buyurtmalar</p></center><br>
</div>
                  </div>
                  
                                                                              </div>
    </div>
  </div>
</div>
      <!-- Main variables *content* -->
      <div id="block_105">
    <div class="block-signin-text ">
        <div class="bg"></div>
        <div class="divider-top"></div>
        <div class="divider-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="block-signin-text__block-text">
                        <div class="block-signin-text__block-text-title">
                                                            <h1> Ijtimoiy akkauntingiz obunachilari va yoqtirishlarini bir joyda, bir zumda oling </h1>
                                                    </div>
                        <div class="block-signin-text__block-text-description">
                          <p>Ijtimoiy hisobingizni bitta panelda boshqarish uchun vaqtni tejang. Odamlar Facebook reklamalarini boshqarish, Instagram, YouTube, Twitter, Soundcloud, veb-sayt reklamalari va boshqalar kabi SMM xizmatlarini qaerdan sotib olishadi!</p> </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div><br><br>
                	<br>
                	<br><br>
                	<br>
</div>
<div id="block_102">
    <div class="header-with-text ">
        <div class="bg"></div>
        <div class="divider-top"></div>
        <div class="divider-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-block__title">
                                                    <center><h2 class="text-center">Nima uchun <b><?=strtoupper($_SERVER['HTTP_HOST'])?></b> <br></center>
<strong style="font-weight: bold"><?=strtoupper($_SERVER['HTTP_HOST'])?></strong>’dan SMM xizmatlariga buyurtma berish kerak?</h2>
                                            </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="text-block__description">
                                                    <p class="text-center">Bizning panelda SMM xizmatlariga buyurtma berishdan qanday foyda olishingiz mumkinligini bilib oling.</p>
                                            </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="block_72">
    <div class="features-block-icons ">
        <div class="bg"></div>
        <div class="divider-top"></div>
        <div class="divider-bottom"></div>
        <div class="container">
            <div class="row align-items-start justify-content-start">
                                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card features-block__card h-100"
                             style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ">
                            <div class="features-block__header">
                                <div class="features-block__header-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary" style="margin-bottom: 10px;
                                         height: 96px;                                                                                                                                                                                                                                                 ">
                                    <?php if($theme == "Eternity") {
echo "<br>";
}?><img src="https://<?=$_SERVER['HTTP_HOST']?>/public/icons/money.png" width=60 height=60>
                                </div>
                                                                    <div class="features-block__header-title" style="margin-bottom: 8px; padding-left: 0px; padding-right: 0px;">
                                                                                    <p><strong style="font-weight: bold">Eng arzon SMM panel</strong></p>
                                                                            </div>
                                                            </div>
                            <div class="features-block__body">
                                                                    <div class="features-block__body-description" style="padding-left: 0px; padding-right: 0px;">
                                                                                    <p><strong style="font-weight: bold"><?=strtoupper($_SERVER['HTTP_HOST'])?></strong> Panel bozordagi barcha mavjud panellar orasida eng arzon.</p>
                                                                            </div>
                                                            </div>
                        </div>
                    </div>
                                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card features-block__card h-100"
                             style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ">
                            <div class="features-block__header">
                                <div class="features-block__header-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary" style="margin-bottom: 10px;
                                         height: 96px;                                                                                                                                                                                                                                                 ">
                                    <?php if($theme == "Eternity") {
echo "<br>";
}?>
<img src="https://<?=$_SERVER['HTTP_HOST']?>/public/icons/profits.png" width=60 height=60>
                                </div>
                                                                    <div class="features-block__header-title" style="margin-bottom: 8px; padding-left: 0px; padding-right: 0px;">
                                                                                    <p><strong style="font-weight: bold"><?=strtoupper($_SERVER['HTTP_HOST'])?></strong></p>
                                                                            </div>
                                                            </div>
                            <div class="features-block__body">
                                                                    <div class="features-block__body-description" style="padding-left: 0px; padding-right: 0px;">
                                                                                    <p><strong style="font-weight: bold"><?=strtoupper($_SERVER['HTTP_HOST'])?></strong> ko‘plab to‘lov tizimlari mavjud.</p>
                                                                            </div>
                                                            </div>
                        </div>
                    </div>
                                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card features-block__card h-100"
                             style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ">
                            <div class="features-block__header">
                                <div class="features-block__header-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary" style="margin-bottom: 10px;
                                         height: 96px;                                                                                                                                                                                                                                                 ">
                                 <br>   <img src="https://<?=$_SERVER['HTTP_HOST']?>/public/icons/best-seller.png" width=60 height=60>
                                </div>
                                                                    <div class="features-block__header-title" style="margin-bottom: 8px; padding-left: 0px; padding-right: 0px;">
                                                                                    <p><strong style="font-weight: bold"><strong style="font-weight: bold"><?=strtoupper($_SERVER['HTTP_HOST'])?></strong> xizmatlar</strong></p>
                                                                            </div>
                                                            </div>
                            <div class="features-block__body">
                                                                    <div class="features-block__body-description" style="padding-left: 0px; padding-right: 0px;">
                                                                                    <p>Biz sifat va arzonlikka e'tibor qaratadigan sotuvchi paneli uchun eng yaxshi SMM panelimiz.</p>
                                                                            </div>
                                                            </div>
                        </div>
                    </div>
                                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card features-block__card h-100"
                             style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ">
                            <div class="features-block__header">
                                <div class="features-block__header-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary" style="margin-bottom: 10px;
                                         height: 96px;                                                                                                                                                                                                                                                 ">
                                    <?php if($theme == "Eternity") {
echo "<br>";
}?>
<img src="https://<?=$_SERVER['HTTP_HOST']?>/public/icons/speed.png" width=60 height=60>
                                </div>
                                                                    <div class="features-block__header-title" style="margin-bottom: 8px; padding-left: 0px; padding-right: 0px;">
                                                                                    <p><strong style="font-weight: bold"><strong style="font-weight: bold"><?=strtoupper($_SERVER['HTTP_HOST'])?></strong> tezligi</strong></p>
                                                                            </div>
                                                            </div>
                            <div class="features-block__body">
                                                                    <div class="features-block__body-description" style="padding-left: 0px; padding-right: 0px;">
                                                                                    <p><strong style="font-weight: bold"><?=strtoupper($_SERVER['HTTP_HOST'])?></strong> biz buyurtma qabul qilishimizdanoq uni sifatli va tezkor yetkazib beramiz.</p>
                                                                            </div>
                                                            </div>
                                                            
                        </div>
                    </div>
                            </div>
                            
        </div>
        
    </div>
    
</div>



<div id="block_72">
    <div class="header-with-text ">
        <div class="bg"></div>
        <div class="divider-top"></div>
        <div class="divider-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-block__title">
                                                    <h2 class="text-center"><b id="orders"></b><span style="text-align: CENTER"><?=strtoupper($_SERVER['HTTP_HOST'])?>  bilan hamisha muvaffaqiyatga erishing.</span></h2>
                                            </div>
                </div>
            </div>
            
    </div>
    
</div>


</div>
</div>    </div></div></div></div></div>
  </div></div></div></div></div></div></div>








    <div class="wrapper-content__footer">
       <div id="block_76">
    <div class="footer ">
        <div class="component_footer_single_line">
            <div class="component-footer">
                <div class="component-footer__public">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="component-footer__public-copyright">
                                                                            <p class="text-center"><span style="text-align: CENTER"><img src="https://<?=$_SERVER['HTTP_HOST']?>/public/icons/law.png" width=20 height=20> Copyright. All Rights Reserved.</span></p>
                                                                    </div>
                                                                    <!-- TrustBox widget - Micro Review Count -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="https://aaio.io/" target="_blank">
	<img src="https://aaio.io/assets/svg/banners/mini/dark-1.svg" title="Aaio - Сервис по приему онлайн платежей">
</a>
    
     </div>
  </div>
</div>

  <script type="text/javascript" src="https://<?=$_SERVER['HTTP_HOST']?>/public/global/ch3915babussofa4.js">
      </script>
  <script type="text/javascript" src="https://<?=$_SERVER['HTTP_HOST']?>/public/global/cgtptn05b64bwcs4.js">
      </script>
  <script type="text/javascript" src="https://<?=$_SERVER['HTTP_HOST']?>/public/global/xcz59lmywkfdgsp4.js">
      </script>
  <script type="text/javascript" src="https://<?=$_SERVER['HTTP_HOST']?>/public/global/wnzsoolloslhfumj.js">
      
      </script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3160914153828540"
     crossorigin="anonymous"></script>


  <script type="text/javascript" >
     
  <script type="text/javascript" >
     window.modules.signin = [];   </script>
  <script type="text/javascript" >
      </script><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.27.6/js/jquery.tablesorter.js"></script><script src="https://cdn.rentalpanel.com/toolkit.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	

</script><script type="text/javascript" src="https://<?=$_SERVER['HTTP_HOST']?>/public/<?=$theme?>/js/ajax.js">
   

  
