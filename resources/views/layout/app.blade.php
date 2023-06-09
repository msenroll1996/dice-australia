<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="icon" href="{{url('frontend/images/dice-png.png')}}">

    <!-- google fonts link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&family=Delius&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- google fonts link -->
    <!-- Rubik Google Font -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">  -->
    
    <!-- Asap Font Link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- slick slider link -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css"/>

    <link rel="stylesheet" href="{{url('frontend/css/style.css')}}"/>
    <!-- fontawesome link -->
    @yield('title')
</head>
<body>
<!-- Top section -->
<section id="topbar" class="d-flex align-items-center">
    <div class="container-fluid d-flex justify-content-center justify-content-md-between">
            <div class="contact-info ms-auto">
                    @php
                      $services = \App\Models\Service::where('status','1')->orderByRaw('CONVERT(order_by, SIGNED) asc')->get();
                      $phone = \App\Models\Setting::where('slug','phone')->get('value')->first()->value ?? '';
                      $email = \App\Models\Setting::where('slug','email')->get('value')->first()->value ?? '';
                      $address = \App\Models\Setting::where('slug','address')->get('value')->first()->value ?? '';
                    @endphp
            @if($phone !== '')        
            <div>
                <img src="{{url('frontend/icons/Calling.svg')}}" class="img-fluid"/>
                <span><a href="tel:{{$phone}}" class="text-decoration-none">{{$phone}}</a></span></i>
            </div>
            @endif
            @if($email !== '')
            <div>
                <img src=" {{url('frontend/icons/Message.svg')}}" class="img-fluid"/>
                <span><a href="mailto: {{$email}}" class="text-decoration-none">{{$email}}</a></span></i>
            </div>
            @endif
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
            <!-- <a href="#" class="twitter"><i class="bi bi-twitter"></i></a> -->
            <!-- <a href="https://www.facebook.com/profile.php?id=100069618114233" target="_blank" class="facebook"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://www.instagram.com/baneshwor_smiles/" target="_blank" class="instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://twitter.com/baneshworsmiles" target="_blank" class="linkdin"><i class="fa-brands fa-twitter"></i></a> -->

            <?php if(\App\Models\Setting::where('slug','facebook-link')->where('status','1')->exists()) : ?>
                    <a href="{{url(\App\Models\Setting::where('slug','facebook-link')->where('status','1')->first()->value ?? '')}}" target="_blank" class="facebook"><i class="fa-brands fa-facebook"></i></a>
                    <?php endif; ?>
                    <?php if(\App\Models\Setting::where('slug','instagram-link')->where('status','1')->exists()) : ?>
                        <a href="{{url(\App\Models\Setting::where('slug','instagram-link')->where('status','1')->first()->value ?? '')}}" target="_blank" class="instagram"><i class="fa-brands fa-instagram"></i></a>                    
                    <?php endif; ?>
                    <?php if(\App\Models\Setting::where('slug','twitter-link')->where('status','1')->exists()) : ?>
                        <a href="{{url(\App\Models\Setting::where('slug','twitter-link')->where('status','1')->first()->value ?? '')}}" target="_blank" class="twitter"><i class="fa-brands fa-twitter"></i></a>
                    <?php endif; ?>
            <!-- Button trigger modal -->
            <a type="button" class="quick-enq-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Quick enquiry
            </a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header enquiry-header">
                            <h5 class="modal-title" id="exampleModalLabel">Quick Enquiry</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
                        </div>
                        <div class="modal-body modal-detail enquiry-detail">
                        <form id="enquiry_form">
                                <div class="row">
                                    <div class="col-md-6 mb-1">
                                        <input type="text" class="form-control" id="app-fname" name="fname" placeholder="First Name" value="" onkeyup="validatetopfname()">
                                        <span class="error-msg" id="app-fname-error"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="app-lname" placeholder="Last Name" name="lname" value="" onkeyup="validatetoplname()">
                                        <span class="error-msg" id="app-lname-error"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" id="app-email" placeholder="Email" name="email" value="" onkeyup="validatetopemail()">
                                        <span class="error-msg" id="app-email-error"></span>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <input type="number" class="form-control" id="app-phone" placeholder="Phone" name="phone" value="" onkeyup="validatetopPhone()">
                                        <span class="error-msg" id="app-phone-error"></span>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <textarea type="text" class="form-control" id="app-message" placeholder="Let us know how can we help" name="app-message" value="" onkeyup="validatetopmessage()"></textarea>
                                        <span class="error-msg" id="app-message-error"></span>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id = "enquiry-submit" class="modal-submit-btn">Submit</button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a> -->
        </div>
    </div>
</section>
<!-- Top section -->
<!-- Header section -->
<header class="header" id="dice-nav-head">
    <a class="navbar-brand" id="navbar-brand" href="{{url('/')}}">
        <img src="{{url(\App\Models\Setting::where('slug','logo')->first()->value ?? '')}}" class="img-fluid logo"  alt="">
    </a>
    <ul class="nav nav-inner navbar-list ms-md-auto" id="navigation-links">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/about')}}">About</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Our Services
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach($services as $service)
                    <li><a class="dropdown-item" href="{{url('/service/'.$service->slug)}}">{{$service->name}}</a></li>
                @endforeach    
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/ndis')}}">NDIS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/referral')}}">Make a Referral</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/career')}}">Working at DICE </a>
        </li>
        <li class="nav-item">
            <a class="nav-link pr-0" href="{{url('/contact')}}">Contact Us </a>
        </li>
    </ul>
    <div class="mobile-navbar-btn ms-auto">
        <ion-icon name="menu-outline" class="mobile-nav-icon"></ion-icon>
        <ion-icon name="close-outline" class="mobile-nav-icon"></ion-icon>
    </div>
</header>

{{-- content section --}}
    @yield('content')

        <section class="listen-icon" id="listen-icon">
            <button class="listen" onclick="changeIcon(this)" id="show_hide_bt">
                <div class="listen-img" id="listen-img">
                    <i id="volume-icon" class="fa-solid fa-volume-xmark"></i>
                </div>
                <div class="listen-text">
                    Mute
                </div>
            </button>
        </section>

{{--  content section --}}
<!-- footer section -->
<section class='footer'>
    <div class='row footer-top'>
        <div class='col-md-12'>
            <div class="footer-logo text-center">
                <img src='{{url("frontend/images/white-logo.png")}}' class="img-fluid" alt="DICE-Logo">
            </div>
        </div>
    </div>
    <div class="row footer-details">
    @if($address !== '')
        <div class="col-md-4">
            <div class="foot-location">
                <img src="{{url('frontend/icons/location.svg')}}"/>
                <a href="https://goo.gl/maps/CGAWi13eiyLkCnzv7" target="_blank" rel="noreferrer">{{$address}}</a>
            </div>
        </div>
        @endif
            
        @if($phone !== '')        
        <div class="col-md-4">
            <div class="foot-location">
                <img src="{{url('frontend/icons/phone.svg')}}"/>
                <a href="tel: {{$phone}}">{{$phone}}</a>
            </div>
        </div>
        @endif
        @if($email !== '') 
        <div class="col-md-4">
            <div class="foot-location">
                <img src="{{url('frontend/icons/email.svg')}}"/>
                <a href="mailto: {{$email}}">{{$email}}</a>
            </div>
        </div>
        @endif
    </div>
    <div class="booton-section">
        <div class="bootom-nav">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('/about')}}">About us</a></li>
                <!-- <li><a href="/service">Services</a></li> -->
                <li><a href="{{url('/referral')}}">Make a Referral</a></li>
                <li><a href="{{url('/contact')}}">Contact Us</a></li>
            </ul>
        </div>
        <div class="bottom-footer">
            <p>ABN : 97654871011</p>
            <p>NDIS : 4050102564</p>
            <p>DICE © 2022. All Rights Reserved.</p>
            <p><a>Disclaimer</a> &nbsp; | &nbsp; <a>Privacy Policy</a></p>
            <p>Designed & Developed By: <a target="_blank" rel="noreferrer" href="https://www.extratechs.com.au/">&nbsp; Extratech</a></p>
        </div>
    </div>
</section>
<!-- footer section end-->
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Bootstrap link -->

<!-- jquery link -->
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<!-- jquery link -->

<!-- fontawesome link -->
<script src="https://kit.fontawesome.com/794cc97646.js" crossorigin="anonymous"></script>

<!-- ionicons link -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<!-- slick slider link -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<!-- hamburger link -->
<script type="text/javascript" src="{{url('frontend/js/index.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script id = "audio_js" src="https://code.responsivevoice.org/responsivevoice.js?key=gqRRrSwU"></script>
<script>

var scrollicon = document.getElementById('listen-icon');
var diceLogo = document.getElementById('navbar-brand');
var navHeader = document.getElementById('dice-nav-head');
        window.onscroll= function(){
            if(window.scrollY > 300){
                diceLogo.classList.add("navbar-brand-scroll");
                navHeader.classList.add("header-scroll");

            }
            if(window.scrollY==0){
                navHeader.classList.remove("header-scroll");
                diceLogo.classList.remove("navbar-brand-scroll");
            }
        }
        
        var topfnameError = document.getElementById('app-fname-error')
        var toplnameError = document.getElementById('app-lname-error')
        var topemailError = document.getElementById('app-email-error')
        var topphoneError = document.getElementById('app-phone-error')
        var topmessageError = document.getElementById('app-message-error')

        function validatetopfname(){
            var topfname = document.getElementById('app-fname').value;
            if(topfname.length == 0){
                $('#app-fname').focus();
                topfnameError.innerHTML = "First name is required!";
                return false;
            }
            topfnameError.innerHTML = '';
            return true;
        }

        function validatetoplname(){
            var topllname = document.getElementById('app-lname').value;
            if(topllname.length == 0){
                $('#app-phone').focus();
                toplnameError.innerHTML= "Last name is required!"
                return false
            }
            else {
                toplnameError.innerHTML= ""
                return true
            }
        }

        function validatetopemail(){
            var topemailtype = document.getElementById('app-email').value;
            if(topemailtype.length == 0){
                $('#app-appointment-type').focus();
                topemailError.innerHTML = "Email field is required!";
                return false;
            }
            topemailError.innerHTML = '';
            return true;
        }

        function validatetopPhone(){
            var topphone = document.getElementById('app-phone').value;
            if(topphone.length == 0){
                $('#app-date').focus();
                topphoneError.innerHTML = "Phone field is required!"
            }
            if(!topphone.match(/^\d{10}$/)){
                topphoneError.innerHTML = "Invalid mobile number";
                return false;
            }
            else {
                topphoneError.innerHTML = "";
                return true;
            }
        }
        function validatetopmessage(){
            var topmessage = document.getElementById('app-message').value;
            if(topmessage.length == 0){
                $('#app-time').focus();
                topmessageError.innerHTML = "Message field is required!"
            }
            else {
                topmessageError.innerHTML = "";
                return true;
            }
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#enquiry_form').on('submit', function (e) {
            e.preventDefault();
            if(!validatetopfname() || !validatetoplname() || !validatetopemail() || !validatetopPhone() || !validatetopmessage()){
                return false
            }
            else {
            document.getElementById('enquiry-submit').disabled=true;

                let firstname = $('#app-fname').val();
                let lastname = $('#app-lname').val();

                let email = $('#app-email').val();
                let phone = $('#app-phone').val();

                let message = $('#app-message').val();

                $.ajax({

                    url: "{{url('contact_mail')}}",
                    type:"POST",
                    data:{
                        firstname:firstname,
                        lastname:lastname,
                        email:email,
                        phone:phone,
                    // service_id:service_id,
                    message:message,
                    },

                success:function(response){
  
                if (response) {
                    Swal.fire({
                        title: 'Submitted!!',
                        text: (response.success),
                        icon: 'success'
                    }).then(function (){
                    $('#enquiry_form')[0].reset();
                    document.getElementById('enquiry-submit').disabled=false;


                    $('#exampleModal').modal('hide');
                    })
            //   $('#success-message').text(response.success);

                }
                },
                error: function(response) {
                    document.getElementById('enquiry-submit').disabled=false;
                }
                });
            }
            });

            function changeIcon(button) {
            var text = $(button).text().trim();
            if ($(button).text().trim() == 'Listen') {
                
                $(button).html('<div class="listen-img" id="listen-img"> <i id="volume-icon" class="fa-solid fa-volume-xmark"></i> </div> <div class="listen-text">Mute </div>');
                responsiveVoice = new ResponsiveVoice;
                            responsiveVoice.init();
                            responsiveVoice.resume();
                

                

                
            }
            else {
                $(button).html('<div class="listen-img" id="listen-img"> <i id="volume-icon" class="fa-solid fa-volume-high"></i> </div> <div class="listen-text" id="showhide">Listen </div>');

                
                    responsiveVoice.pause();
              
                    responsiveVoice = null;
                // element = document.getElementById('audio_js');
                // element.remove();
            }
        }
</script>
@yield('script')
</body>
</html>
