
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SeenSMS</title>
    <link rel="shortcut icon" type="image/png" href="https://seensms.uz/assets/images/logos/seensms.jpg" />
    <link rel="stylesheet" href="https://seensms.uz/assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    <link rel="stylesheet" href="https://seensms.uz/assets/css/layout.css">
        </head>

<body>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar overflow-y-auto">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="https://seensms.uz/home" class="text-nowrap logo-img">
                    <img src="https://seensms.uz/assets/images/logos/seensms.jpg" id="logo" alt="" />
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                                                            <li class="sidebar-item">
                        <a class="sidebar-link" href="https://seensms.uz/orders/create" aria-expanded="false">
                            <span>
                              <i class="ti ti-plus"></i>
                            </span>
                            <span class="hide-menu">Yangi buyurtma</span>
                        </a>
                    </li>
                                        <li class="sidebar-item">
                        <a class="sidebar-link" href="https://seensms.uz/tariffs" aria-expanded="false">
                        <span>
                          <i class="ti ti-list"></i>
                        </span>
                            <span class="hide-menu">Xizmatlar</span>
                        </a>
                    </li>
                                        <li class="sidebar-item">
                        <a class="sidebar-link" href="https://seensms.uz/orders" aria-expanded="false">
                            <span>
                              <i class="ti ti-cards"></i>
                            </span>
                            <span class="hide-menu">Mening buyurtmalarim</span>
                        </a>
                    </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="https://seensms.uz/payment/pay" aria-expanded="false">
                            <span>
                              <i class="ti ti-currency-dollar"></i>
                            </span>
                                <span class="hide-menu">Hisobni to'ldirish</span>
                            </a>
                        </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="https://seensms.uz/profile" aria-expanded="false">
                            <span>
                              <i class="ti ti-settings"></i>
                            </span>
                                    <span class="hide-menu">Sozlamalar</span>
                                </a>
                            </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="https://seensms.uz/-?v=6" aria-expanded="false">
                            <span>
                              <i class="ti ti-phone"></i>
                            </span>
                                <span class="hide-menu">Nomer olish</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="https://seensms.uz/referal" aria-expanded="false">
                            <span>
                              <i class="ti ti-activity"></i>
                            </span>
                                <span class="hide-menu">Taklif havola</span>
                            </a>
                                        <li class="sidebar-item">
                        <a class="sidebar-link" href="https://seensms.uz/support" aria-expanded="false">
                            <span>
                              <i class="ti ti-antenna"></i>
                            </span>
                            <span class="hide-menu">Qo'llab quvvatlash</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="https://seensms.uz/-?v=2" aria-expanded="false">
                        <span>
                          <i class="ti ti-api"></i>
                        </span>
                            <span class="hide-menu">Api</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="https://seensms.uz/about" aria-expanded="false">
                            <span>
                              <i class="ti ti-address-book"></i>
                            </span>
                            <span class="hide-menu">Biz haqimizda</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-xl-none">
                        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                </ul>
                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                                                <a href="https://seensms.uz/news" class="icon-button">
                            <span class="fas fa-bell"></span>
                                                    </a>
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                <img src="https://seensms.uz/assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                <div class="message-body">
                                    <span class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-currency-dollar fs-6"></i>
                                        <p class="mb-0 fs-3">Balans: 994.71 so'm</p>
                                    </span>
                                    <a href="https://seensms.uz/payment/pay" class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-file-dollar fs-6"></i>
                                        <p class="mb-0 fs-3">Hisobni to'ldirish</p>
                                    </a>

                                    <a href="https://seensms.uz/profile" class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-settings fs-6"></i>
                                        <p class="mb-0 fs-3">Sozlamalar</p>
                                    </a>

                                                                        <a href="https://seensms.uz/logout" class="btn btn-outline-primary mx-3 mt-2 d-block" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Chiqish</a>
                                    <form id="logout-form" action="https://seensms.uz/logout" method="POST" class="d-none">
                                        <input type="hidden" name="_token" value="i3lO28oEA6qO31uVcU8xmRiEQas0uZ2KdHsOLHJx">                                    </form>
                                </div>
                            </div>
                        </li>
                                            </ul>
                </div>
            </nav>
        </header>
        <!--  Header End -->
        <div class="row" style="padding-top: 5rem!important; margin-right: 0!important; margin-left: 0.5rem!important;">
            <!--  Row 1 -->
            <div class="row justify-content-center">
    <div class="">
        <div class="card">
            <div class="card-header">Yangi buyurtma</div>

            <div class="card-body">
                                
                    <form action="https://seensms.uz/orders/store" method="POST" class="form-group">
                        <input type="hidden" name="_token" value="i3lO28oEA6qO31uVcU8xmRiEQas0uZ2KdHsOLHJx">                        <label for="category">Bo'lim</label>
                        <select id="category" class="form-control">
                            <option value="">Tanlang</option>
                                                            <option value="1"  data-icon="telegram">Telegram Obunachi</option>
                                                            <option value="21"  data-icon="telegram">Telegram Obunachi Kafolatli</option>
                                                            <option value="2"  data-icon="telegram">Telegram Post Ko&#039;rish</option>
                                                            <option value="4"  data-icon="telegram">Telegram Reaksiya</option>
                                                            <option value="3"  data-icon="telegram">Telegram Premium reasksiya</option>
                                                            <option value="5"  data-icon="telegram">Telegram Avto reaksiya</option>
                                                            <option value="6"  data-icon="telegram">Telegram Avto Ko&#039;rish</option>
                                                            <option value="7"  data-icon="telegram">Telegram So&#039;rovnoma</option>
                                                            <option value="8"  data-icon="instagram">Instagram Obunachi</option>
                                                            <option value="22"  data-icon="instagram">Instagram Obunachi Kafolatli</option>
                                                            <option value="9"  data-icon="instagram">Instagram Video ko&#039;rish</option>
                                                            <option value="10"  data-icon="instagram">Instagram Istoriya ko&#039;rish</option>
                                                            <option value="11"  data-icon="instagram">Instagram Repost ulashish</option>
                                                            <option value="12"  data-icon="instagram">Instagram LIVE (Jonli efir)</option>
                                                            <option value="13"  data-icon="instagram">Instagram Like</option>
                                                            <option value="14"  data-icon="tiktok">Tiktok Obunachi</option>
                                                            <option value="23"  data-icon="tiktok">Tiktok Video ko&#039;rish</option>
                                                            <option value="15"  data-icon="tiktok">Tiktok Like</option>
                                                            <option value="16"  data-icon="youtube">Youtube Obunachi</option>
                                                            <option value="17"  data-icon="youtube">Youtube Like / Dislike</option>
                                                            <option value="18"  data-icon="youtube">Youtube Shorts</option>
                                                            <option value="19"  data-icon="youtube">Youtube Video ko&#039;rish</option>
                                                            <option value="20"  data-icon="youtube">Youtube Komentariya</option>
                                                    </select>
                        <label for="tariff">Tarif nomi</label>
                        <select name="tariff" id="tariff" class="form-control">
                            <option value="">Tanlang</option>
                                                            </select>
                                                            
                                                            
                                                            
                                                            
                        <label for="tariff_info">Tarif haqida</label>
                        <textarea name="tariff_info" id="tariff_info" cols="30" rows="10" class="form-control" disabled></textarea>
                        <div id="tariff_data">
                                                <label for="data">Havolani kiriting:</label>
                        <input type="text" name="data" id="data" placeholder="" class="form-control">
                                                </div>
                        <p>⚠️ Havola yuborayotganda e'tiborli bo'ling va yuborgan havolangizga kirib ko'ring! Agarda noto'g'ri yoki yaroqsiz havola yuborib buyurtma bersangiz buyurtmangiz bajarilmasligi va buyurtma puli qaytarilmasligi mumkin! (Shaxsiy yoki yopiq havolalarni yubormang!)</p>
                        <label for="quantity">Soni</label>
                        <input type="number" name="quantity" id="quantity" placeholder="1000" class="form-control">
                        <p>Minimal: <span id="min"></span>, Maksimal: <span id="max"></span></p>
                        <label for="price">Narxi (so'm)</label>
                        <input type="text" id="price" value="" class="form-control" disabled>
                        <div id="answer_block">
                                                </div>
                        <button type="submit" class="btn btn-success mt-2">Buyurtma berish</button>
                    </form>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>
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
                var $icon = $('<img src="https://seensms.uz/assets/icons/' + icon + '.png" class="img-flag" width="20" height="20" />');
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
                url: "https://seensms.uz/tariffs/get",
                type: "GET",
                data: {
                    category: category
                },
                success: function(data){
                    let html = '<option value="">Tanlang</option>';
                    data.forEach(function(tariff){
                        html += '<option value="'+tariff.id+'">'+tariff.name+'</option>';
                    });
                    $("#tariff").html(html);
                }
            });
        });
        $("#tariff").change(function(){
            let tariff = $(this).val();
            let quantity = $("#quantity").val();
            $.ajax({
                url: "https://seensms.uz/tariff/get",
                type: "GET",
                data: {
                    id: tariff,
                    quantity: quantity
                },
                success: function(data){
                    $("#min").html(data.min);
                    $("#max").html(data.max);
                    $("#price").val(data.amount);
                    $("#url").attr('placeholder', data.example);
                    $("#tariff_info").val(data.info);
                    if(data.need_answer){
                        $("#answer_block").html('<label for="answer">Javob</label><input type="text" id="answer" name="answer" class="form-control" required>');
                    }else{
                        $("#answer_block").html('');
                    }
                    if(data.id === 136){
                        $("#tariff_data").html('<label for="data">Xabar</label>\
                            <textarea name="data" id="data" cols="30" rows="10" class="form-control" placeholder="' + data.example + '"></textarea>\
                        ');
                    }else{
                        $("#tariff_data").html('<label for="data">Havolani kiriting:</label>\
                            <input type="text" name="data" id="data" placeholder="' + data.example + '" class="form-control">\
                            ');
                    }
                }
            });
        });
        $("#quantity").keyup(function(){
            console.log($(this).val());
            let tariff = $("#tariff").val();
            let quantity = $("#quantity").val();
            if(tariff === '') return;
            $.ajax({
                url: "https://seensms.uz/tariff/get",
                type: "GET",
                data: {
                    id: tariff,
                    quantity: quantity
                },
                success: function(data){
                    $("#min").html(data.min);
                    $("#max").html(data.max);
                    $("#price").val(data.amount);
                }
            });
        });
    </script>
</body>

</html>
