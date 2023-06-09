@extends("layout.app")
@section('title')
    <title>Contact</title> 
    <meta name="description" content="Contact us today to arrange free, no-obligation care consultation for you or your loved one."/>
    <meta name="og:title" content="DICE"/>
    <meta name="og:image" content="{{url('frontend/images/contact-bg.png')}}"/>
@endsection
{!! Html::style('frontend/css/css-loader.css') !!}
@section('content')
    <section class="contactus-section" style="background-image:url({{url('frontend/images/contact-bg.png')}})">
        {{--start loader--}}<div class="loader loader-default" id="loader"></div>{{--end loader--}}
            <div class="contactus-header">
                <h1>Contact Us</h1>
                <p>We can help you get the right care for yourself or someone you love. If you would like to find out more. Give us a call to schedule a free consultation.</p>
                <div class="dice-email-links">
                    <div class="dice-contact-links">
                        <h5>General Enquiry</h5>
                        @if($email !== null)
                        <div class="contactus-email">
                            <div class="contactus-icon">
                                <i class="fa-solid fa-envelope fa-lg"></i>
                            </div>
                            <div>
                                <a href="mailto:contact@dice.org.au">{{$email->value}}</a>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="dice-contact-links">
                        <h5>Account</h5>
                        <div class="contactus-email">
                            <div class="contactus-icon">
                                <i class="fa-solid fa-envelope fa-lg"></i>
                            </div>
                            <div>
                                <a href="mailto:accounts@dice.org.au">accounts@dice.org.au</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contactus-icons">
                    @if($phone !== null)
                    <div class="contactus-email">
                        <div class="contactus-icon">
                            <i class="fa-solid fa-phone fa-lg"></i>
                        </div>
                        <div>
                            <a href="tel:1300 050 051">{{$phone->value}}</a>
                        </div>
                    </div>
                    @endif
                    @if($address !== null)
                    <div class="contactus-location">
                        <div class="contactus-icon">
                            <i class="fa-solid fa-location-dot fa-lg"></i>
                        </div>
                        <div>
                            <a href="https://goo.gl/maps/4x5Y3Mn1xAybeS2u6"  target="-_blank" rel="noreferrer">{{$address->value}}</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
    </section>
    <section class="contact-form-section">
        <div class="row">
            <div class="col-md-6">
                <div class="form-header">
                    <h5>Are you ready to join our growing family?</h5>
                    <h2>Let us support you.</h2>
                    <p>Fill in your details below, and our customer care team will contact you shortly.</p>
                </div>
                <form class="contactus-form" id="contact_form">
                    <div class="row">
                    <div class="mb-3 col-md-12">
                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name" onkeyup="contactFname()">
                        <span class="error-msg" id="contact-fname-error"></span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" onkeyup="contactEmail()">
                        <span class="error-msg" id="contact-email-error"></span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" onkeyup="contactPhone()">
                        <span class="error-msg" id="contact-phone-error"></span>
                    </div>
                    <div class="mb-3">
                        <textarea name="" class="form-control text-area" id="message" cols="50" rows="4" onkeyup="contactMessage()" placeholder="Type your message here"></textarea>
                        <span class="error-msg" id="contact-message-error"></span>
                    </div>
                    <div class="">
                        <!-- Button trigger modal -->
                        <button type="submit" class="submit-btn">Submit</button>
                        <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content footer-content">
                                    <div class="modal-header submit-header-modal">
                                        <img src="{{url('frontend/icons/success.svg')}}"/>
                                    </div>
                                    <div class="modal-body" style="background: #FFFFFF">
                                        <h2 style="color: #3A3A3A; font-weight: 700; font-size: 24px; line-height: 2rem">Success!</h2>
                                        <p id = "success"></p>
                                    </div>
                                    <div class="modal-footer submit-footer-modal">
                                        <a type="button" class="submit-close-btn" href="{{url('/contact')}}">Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="dice-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d100855.68390598494!2d144.9747537!3d-37.8195557!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642b4fba98713%3A0x1942f75072ac1f39!2sSuite%20614%2F343%20Little%20Collins%20St%2C%20Melbourne%20VIC%203000%2C%20Australia!5e0!3m2!1sen!2snp!4v1668771030232!5m2!1sen!2snp" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
       fnameError = document.getElementById('contact-fname-error');
       emailError = document.getElementById('contact-email-error');
       phoneError = document.getElementById('contact-phone-error');
       messageError = document.getElementById('contact-message-error');

       function contactFname(){
            var fullname = document.getElementById('fullname').value;
            if(fullname.length == 0){
                $('#fullname').focus();
                fnameError.innerHTML = "Full name is required !";
                return false;
            }
            fnameError.innerHTML = '';
            return true;
       }

        function contactEmail(){
        var email = document.getElementById('email').value;
        if(email.length == 0){
            $('#email').focus();
            emailError.innerHTML = "Email field is required !";
            return false;
        }
        emailError.innerHTML = '';
        return true;
        }

        function contactPhone(){
            var phone = document.getElementById('phone').value;
            if(phone.length == 0){
                $('#phone').focus();
                phoneError.innerHTML = "Phone number is required !";
                return false;
            }
            if(!phone.match(/^\d{10}$/)){
                phoneError.innerHTML = "Please provide valid 10 digit number";
                return false;
            }
            phoneError.innerHTML = '';
            return true;
        }

        function contactMessage(){
            var message = document.getElementById('message').value;
            if(message.length == 0){
                $('#message').focus();
                messageError.innerHTML = "Message field is required !";
                return false;
            }
            messageError.innerHTML = '';
            return true;
        }
        $('#contact_form').on('submit', function (e) {
           e.preventDefault();
           if(!contactFname() || !contactEmail() || !contactPhone() || !contactMessage()){
                return false;
           }else{
            let fullname = $('#fullname').val();
            let email = $('#email').val();
            let phone = $('#phone').val();
            let message = $('#message').val();
            
            start_loader();
            $.ajax({

                url: "{{url('/contact_mail')}}",
                type:"POST",
                data:{
                    fullname:fullname,
                    email:email,
                    phone:phone,
                    // service_id:service_id,
                    message:message,
                },

                    success:function(response){
                        end_loader()
                    console.log(response);
                    if (response) {
                        $('#success').text(response.success);
                        $('#contactModal').modal('show');
                    }
                    },
                    error: function(response) {

                    }
                });
                
           }
        });
        //starting loader
    function start_loader() {
        $('#loader').addClass('is-active');
    }
    //ending loader
    function end_loader() {
        $('#loader').removeClass('is-active');
    }
    </script>
    
@endsection