<?php
require ('sql_connect.php');
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
                                                                  <a target="_self" href="/"><span style="text-transform: "><span style="font-size: 24px"><span style="letter-spacing: 1.0px"><span style="line-height: 120px"><strong style="font-weight: bold"><?=$_SERVER['HTTP_HOST']?></strong></span></span></span></span></a>
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
    <div class="component_navbar"></div>
    <div class="component_navbar_sub"></div>
</div>
   <div class="wrapper-content">
    <div class="wrapper-content__header">
          </div>
    <div class="wrapper-content__body">
      <!-- Main variables *content* -->
      <div id="block_api" class="pt-5 pb-5">
  <div class="block-api">
    <div class="bg"></div>
    <div class="divider-top"></div>
    <div class="divider-bottom"></div>
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="card">
            <div class="center-big-content-block">
              <h4 class="mb-3">API Base</h4>
                                  <div class="table-bg">
                    <div class="table-wr ">
                      <table class="table mb-3">
                        <thead>
                        <tr>
                          <th class="width-40">HTTP Method</th>
                          <th>POST or GET</th>
                        </tr>
                        </thead>
                        <tbody>
                                                  <tr>
                            <td>API url</td>
                            <td>https://<?=$_SERVER['HTTP_HOST']?>/api/v2</td>
                          </tr>
                                                  <tr>
                            <td>Bot</td>
                            <td href="https://t.me/<?=$bot?>"><?=$bot?></td>
                          </tr>
                                                </tbody>
                      </table>
                    </div>
                  </div>

                              <h4 class="mb-3">Service list</h4>
                                  <div class="table-bg">
                    <div class="table-wr ">
                      <table class="table mb-3">
                        <thead>
                        <tr>
                          <th class="width-40">Parameters</th>
                          <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                                                  <tr>
                            <td>key</td>
                            <td>Your API key</td>
                          </tr>
                                                  <tr>
                            <td>action</td>
                            <td>services</td>
                          </tr>
                                                </tbody>
                      </table>
                    </div>
                  </div>
                
                <div><h6>Example response</h6></div>
                <pre>
[
    {
        "service": 1,
        "name": "Followers",
        "type": "Default",
        "category": "First Category",
        "rate": "0.90",
        "min": "50",
        "max": "10000",
        "refill": true,
        "cancel": true
    },
    {
        "service": 2,
        "name": "Comments",
        "type": "Custom Comments",
        "category": "Second Category",
        "rate": "8",
        "min": "10",
        "max": "1500",
        "refill": false,
        "cancel": true
    }
]
</pre>

                              <h4 class="mb-3">Add order</h4>
                                                      <form class="">
                      <div class="form-group">
                        <select class="form-control input-sm" id="service_type">
                                                      <option value="0">Default</option>
                                                      <option value="10">Package</option>
                                                      
                                                      <option value="17">Poll</option>
                                                      
                                                  </select>
                      </div>
                    </form>
                                                        <div id="type_0" style="display:none;">
                      <div class="table-bg">
                        <div class="table-wr ">
                          <table class="table mb-3">
                            <thead>
                            <tr>
                              <th class="width-40">Parameters</th>
                              <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                                          <tr>
                                <td>key</td>
                                <td>Your API key</td>
                              </tr>
                                                          <tr>
                                <td>action</td>
                                <td>add</td>
                              </tr>
                                                          <tr>
                                <td>service</td>
                                <td>Service ID</td>
                              </tr>
                                                          <tr>
                                <td>link</td>
                                <td>Link to page</td>
                              </tr>
                                                          <tr>
                                <td>quantity</td>
                                <td>Needed quantity</td>
                              </tr>
                                                          <tr>
                                <td>runs (optional)</td>
                                <td>Runs to deliver</td>
                              </tr>
                                                          <tr>
                                <td>interval (optional)</td>
                                <td>Interval in minutes</td>
                              </tr>
                                                        </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                                      <div id="type_10" style="display:none;">
                      <div class="table-bg">
                        <div class="table-wr ">
                          <table class="table mb-3">
                            <thead>
                            <tr>
                              <th class="width-40">Parameters</th>
                              <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                                          <tr>
                                <td>key</td>
                                <td>Your API key</td>
                              </tr>
                                                          <tr>
                                <td>action</td>
                                <td>add</td>
                              </tr>
                                                          <tr>
                                <td>service</td>
                                <td>Service ID</td>
                              </tr>
                                                          <tr>
                                <td>link</td>
                                <td>Link to page</td>
                              </tr>
                                                        </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                                      <div id="type_2" style="display:none;">
                      <div class="table-bg">
                        <div class="table-wr ">
                          <table class="table mb-3">
                            <thead>
                            <tr>
                              <th class="width-40">Parameters</th>
                              <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                                          <tr>
                                <td>key</td>
                                <td>Your API key</td>
                              </tr>
                                                          <tr>
                                <td>action</td>
                                <td>add</td>
                              </tr>
                                                          <tr>
                                <td>service</td>
                                <td>Service ID</td>
                              </tr>
                                                          <tr>
                                <td>link</td>
                                <td>Link to page</td>
                              </tr>
                                                          <tr>
                                <td>comments</td>
                                <td>Comments list separated by \r\n or \n</td>
                              </tr>
                                                        </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                                      <div id="type_9" style="display:none;">
                      <div class="table-bg">
                        <div class="table-wr ">
                          <table class="table mb-3">
                            <thead>
                            <tr>
                              <th class="width-40">Parameters</th>
                              <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                                          <tr>
                                <td>key</td>
                                <td>Your API key</td>
                              </tr>
                                                          <tr>
                                <td>action</td>
                                <td>add</td>
                              </tr>
                                                          <tr>
                                <td>service</td>
                                <td>Service ID</td>
                              </tr>
                                                          <tr>
                                <td>link</td>
                                <td>Link to page</td>
                              </tr>
                                                          <tr>
                                <td>quantity</td>
                                <td>Needed quantity</td>
                              </tr>
                                                          <tr>
                                <td>usernames</td>
                                <td>Usernames list separated by \r\n or \n</td>
                              </tr>
                                                        </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                                      <div id="type_3" style="display:none;">
                      <div class="table-bg">
                        <div class="table-wr ">
                          <table class="table mb-3">
                            <thead>
                            <tr>
                              <th class="width-40">Parameters</th>
                              <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                                          <tr>
                                <td>key</td>
                                <td>Your API key</td>
                              </tr>
                                                          <tr>
                                <td>action</td>
                                <td>add</td>
                              </tr>
                                                          <tr>
                                <td>service</td>
                                <td>Service ID</td>
                              </tr>
                                                          <tr>
                                <td>link</td>
                                <td>Link to page</td>
                              </tr>
                                                          <tr>
                                <td>quantity</td>
                                <td>Needed quantity</td>
                              </tr>
                                                          <tr>
                                <td>usernames</td>
                                <td>Usernames list separated by \r\n or \n</td>
                              </tr>
                                                          <tr>
                                <td>hashtags</td>
                                <td>Hashtags list separated by \r\n or \n</td>
                              </tr>
                                                        </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                                      <div id="type_6" style="display:none;">
                      <div class="table-bg">
                        <div class="table-wr ">
                          <table class="table mb-3">
                            <thead>
                            <tr>
                              <th class="width-40">Parameters</th>
                              <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                                          <tr>
                                <td>key</td>
                                <td>Your API key</td>
                              </tr>
                                                          <tr>
                                <td>action</td>
                                <td>add</td>
                              </tr>
                                                          <tr>
                                <td>service</td>
                                <td>Service ID</td>
                              </tr>
                                                          <tr>
                                <td>link</td>
                                <td>Link to page</td>
                              </tr>
                                                          <tr>
                                <td>quantity</td>
                                <td>Needed quantity</td>
                              </tr>
                                                          <tr>
                                <td>hashtag</td>
                                <td>Hashtag to scrape usernames from</td>
                              </tr>
                                                        </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                                      <div id="type_7" style="display:none;">
                      <div class="table-bg">
                        <div class="table-wr ">
                          <table class="table mb-3">
                            <thead>
                            <tr>
                              <th class="width-40">Parameters</th>
                              <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                                          <tr>
                                <td>key</td>
                                <td>Your API key</td>
                              </tr>
                                                          <tr>
                                <td>action</td>
                                <td>add</td>
                              </tr>
                                                          <tr>
                                <td>service</td>
                                <td>Service ID</td>
                              </tr>
                                                          <tr>
                                <td>link</td>
                                <td>Link to page</td>
                              </tr>
                                                          <tr>
                                <td>quantity</td>
                                <td>Needed quantity</td>
                              </tr>
                                                          <tr>
                                <td>username</td>
                                <td>URL to scrape followers from</td>
                              </tr>
                                                        </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                                      <div id="type_100" style="display:none;">
                      <div class="table-bg">
                        <div class="table-wr ">
                          <table class="table mb-3">
                            <thead>
                            <tr>
                              <th class="width-40">Parameters</th>
                              <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                                          <tr>
                                <td>key</td>
                                <td>Your API key</td>
                              </tr>
                                                          <tr>
                                <td>action</td>
                                <td>add</td>
                              </tr>
                                                          <tr>
                                <td>service</td>
                                <td>Service ID</td>
                              </tr>
                                                          <tr>
                                <td>username</td>
                                <td>Username</td>
                              </tr>
                                                          <tr>
                                <td>min</td>
                                <td>Quantity min</td>
                              </tr>
                                                          <tr>
                                <td>max</td>
                                <td>Quantity max</td>
                              </tr>
                                                          <tr>
                                <td>posts (optional)</td>
                                <td>Use this parameter if you want to limit the number of new (future) posts that will be parsed and for which orders will be created. If posts parameter is not set, the subscription will be created for an unlimited number of posts.</td>
                              </tr>
                                                          <tr>
                                <td>old_posts (optional)</td>
                                <td>Number of existing posts that will be parsed and for which orders will be created, can be used if this option is available for the service.</td>
                              </tr>
                                                          <tr>
                                <td>delay</td>
                                <td>Delay in minutes. Possible values: 0, 5, 10, 15, 30, 60, 90, 120, 150, 180, 210, 240, 270, 300, 360, 420, 480, 540, 600</td>
                              </tr>
                                                          <tr>
                                <td>expiry (optional)</td>
                                <td>Expiry date. Format d/m/Y</td>
                              </tr>
                                                        </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                                      <div id="type_14" style="display:none;">
                      <div class="table-bg">
                        <div class="table-wr ">
                          <table class="table mb-3">
                            <thead>
                            <tr>
                              <th class="width-40">Parameters</th>
                              <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                                          <tr>
                                <td>key</td>
                                <td>Your API key</td>
                              </tr>
                                                          <tr>
                                <td>action</td>
                                <td>add</td>
                              </tr>
                                                          <tr>
                                <td>service</td>
                                <td>Service ID</td>
                              </tr>
                                                          <tr>
                                <td>link</td>
                                <td>Link to page</td>
                              </tr>
                                                          <tr>
                                <td>comments</td>
                                <td>Comments list separated by \r\n or \n</td>
                              </tr>
                                                        </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                                      <div id="type_15" style="display:none;">
                      <div class="table-bg">
                        <div class="table-wr ">
                          <table class="table mb-3">
                            <thead>
                            <tr>
                              <th class="width-40">Parameters</th>
                              <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                                          <tr>
                                <td>key</td>
                                <td>Your API key</td>
                              </tr>
                                                          <tr>
                                <td>action</td>
                                <td>add</td>
                              </tr>
                                                          <tr>
                                <td>service</td>
                                <td>Service ID</td>
                              </tr>
                                                          <tr>
                                <td>link</td>
                                <td>Link to page</td>
                              </tr>
                                                          <tr>
                                <td>quantity</td>
                                <td>Needed quantity</td>
                              </tr>
                                                          <tr>
                                <td>username</td>
                                <td>Username of the comment owner</td>
                              </tr>
                                                        </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                                      <div id="type_17" style="display:none;">
                      <div class="table-bg">
                        <div class="table-wr ">
                          <table class="table mb-3">
                            <thead>
                            <tr>
                              <th class="width-40">Parameters</th>
                              <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                                          <tr>
                                <td>key</td>
                                <td>Your API key</td>
                              </tr>
                                                          <tr>
                                <td>action</td>
                                <td>add</td>
                              </tr>
                                                          <tr>
                                <td>service</td>
                                <td>Service ID</td>
                              </tr>
                                                          <tr>
                                <td>link</td>
                                <td>Link to page</td>
                              </tr>
                                                          <tr>
                                <td>quantity</td>
                                <td>Needed quantity</td>
                              </tr>
                                                          <tr>
                                <td>answer_number</td>
                                <td>Answer number of the poll</td>
                              </tr>
                                                        </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                                      <div id="type_18" style="display:none;">
                      <div class="table-bg">
                        <div class="table-wr ">
                          <table class="table mb-3">
                            <thead>
                            <tr>
                              <th class="width-40">Parameters</th>
                              <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                                          <tr>
                                <td>key</td>
                                <td>Your API key</td>
                              </tr>
                                                          <tr>
                                <td>action</td>
                                <td>add</td>
                              </tr>
                                                          <tr>
                                <td>service</td>
                                <td>Service ID</td>
                              </tr>
                                                          <tr>
                                <td>link</td>
                                <td>Link to page</td>
                              </tr>
                                                          <tr>
                                <td>username</td>
                                <td>Username</td>
                              </tr>
                                                          <tr>
                                <td>comments</td>
                                <td>Comments list separated by \r\n or \n</td>
                              </tr>
                                                        </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                                      <div id="type_20" style="display:none;">
                      <div class="table-bg">
                        <div class="table-wr ">
                          <table class="table mb-3">
                            <thead>
                            <tr>
                              <th class="width-40">Parameters</th>
                              <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                                          <tr>
                                <td>key</td>
                                <td>Your API key</td>
                              </tr>
                                                          <tr>
                                <td>action</td>
                                <td>add</td>
                              </tr>
                                                          <tr>
                                <td>service</td>
                                <td>Service ID</td>
                              </tr>
                                                          <tr>
                                <td>link</td>
                                <td>Link to page</td>
                              </tr>
                                                          <tr>
                                <td>quantity</td>
                                <td>Needed quantity</td>
                              </tr>
                                                          <tr>
                                <td>groups</td>
                                <td>Groups list separated by \r\n or \n</td>
                              </tr>
                                                        </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                                  
                <div><h6>Example response</h6></div>
                <pre>
{
    "order": 23501
}
</pre>
                              <h4 class="mb-3">Order status</h4>
                                  <div class="table-bg">
                    <div class="table-wr ">
                      <table class="table mb-3">
                        <thead>
                        <tr>
                          <th class="width-40">Parameters</th>
                          <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                                                  <tr>
                            <td>key</td>
                            <td>Your API key</td>
                          </tr>
                                                  <tr>
                            <td>action</td>
                            <td>status</td>
                          </tr>
                                                  <tr>
                            <td>order</td>
                            <td>Order ID</td>
                          </tr>
                                                </tbody>
                      </table>
                    </div>
                  </div>
                
                <div><h6>Example response</h6></div>
                <pre>
{
    "charge": "0.27819",
    "status": "Partial",
    "currency": "UZS"
}
</pre>


<h4 class="mb-3">All orders</h4>
                                  <div class="table-bg">
                    <div class="table-wr ">
                      <table class="table mb-3">
                        <thead>
                        <tr>
                          <th class="width-40">Parameters</th>
                          <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                                                  <tr>
                            <td>key</td>
                            <td>Your API key</td>
                          </tr>
                                                  <tr>
                            <td>action</td>
                            <td>orders</td>
                          </tr>
                                                  
                                                </tbody>
                      </table>
                    </div>
                  </div>
                
                <div><h6>Example response</h6></div>
                <pre>
[{
    "customer": "125632728",
    "service": "15",
    "order":"6291",
    "status": "Completed",
    "charge": "2627.622",
    "currency": "UZS"
},
{
    "customer": "125632728",
    "service": "15",
    "order":"8643",
    "status": "In progress",
    "charge": "2627.622",
    "currency": "UZS"
}]
</pre>


                              <h4 class="mb-3">Multiple orders status</h4>
                                  <div class="table-bg">
                    <div class="table-wr ">
                      <table class="table mb-3">
                        <thead>
                        <tr>
                          <th class="width-40">Parameters</th>
                          <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                                                  <tr>
                            <td>key</td>
                            <td>Your API key</td>
                          </tr>
                                                  <tr>
                            <td>action</td>
                            <td>status</td>
                          </tr>
                                                  <tr>
                            <td>orders</td>
                            <td>Order IDs separated by comma (1,65,885,56,46,56)</td>
                          </tr>
                                                </tbody>
                      </table>
                    </div>
                  </div>
                
                <div><h6>Example response</h6></div>
                <pre>
{
    "1": {
        "charge": "0.27819",
        "status": "Partial",
        "currency": "UZS"
    },
    "10": {
        "error": "Incorrect order ID"
    },
    "100": {
        "charge": "1.44219",
        "status": "In progress",
        "currency": "UZS"
    }
}
</pre>
                              <h4 class="mb-3">Create refill</h4>
                                  <div class="table-bg">
                    <div class="table-wr ">
                      <table class="table mb-3">
                        <thead>
                        <tr>
                          <th class="width-40">Parameters</th>
                          <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                                                  <tr>
                            <td>key</td>
                            <td>Your API key</td>
                          </tr>
                                                  <tr>
                            <td>action</td>
                            <td>refill</td>
                          </tr>
                                                  <tr>
                            <td>order</td>
                            <td>Order ID</td>
                          </tr>
                                                </tbody>
                      </table>
                    </div>
                  </div>
                
                <div><h6>Example response</h6></div>
                <pre>
{
    "refill": "1"
}
</pre>
                              <h4 class="mb-3">Get refill status</h4>
                                  <div class="table-bg">
                    <div class="table-wr ">
                      <table class="table mb-3">
                        <thead>
                        <tr>
                          <th class="width-40">Parameters</th>
                          <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                                                  <tr>
                            <td>key</td>
                            <td>Your API key</td>
                          </tr>
                                                  <tr>
                            <td>action</td>
                            <td>refill_status</td>
                          </tr>
                                                  <tr>
                            <td>refill</td>
                            <td>Refill ID</td>
                          </tr>
                                                </tbody>
                      </table>
                    </div>
                  </div>
                
                <div><h6>Example response</h6></div>
                <pre>
{
    "status": "Completed"
}
</pre>
                              <h4 class="mb-3">User balance</h4>
                                  <div class="table-bg">
                    <div class="table-wr ">
                      <table class="table mb-3">
                        <thead>
                        <tr>
                          <th class="width-40">Parameters</th>
                          <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                                                  <tr>
                            <td>key</td>
                            <td>Your API key</td>
                          </tr>
                                                  <tr>
                            <td>action</td>
                            <td>balance</td>
                          </tr>
                                                </tbody>
                      </table>
                    </div>
                  </div>
                
                <div><h6>Example response</h6></div>
                <pre>
{
    "balance": "2182.66",
    "currency": "UZS"
}
</pre>
                            <a href="/example.txt" class="btn btn-big-secondary" target="_blank">Example of PHP code</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    </div>
    <div class="wrapper-content__footer">
       <div id="block_69">
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
                            </div>
                        </div>
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
</body>
</html>