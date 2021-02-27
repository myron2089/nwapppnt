@extends('frontend.layouts.app')

@section('css')
    
@endsection
@section('content')
<div class="container clearfix">

                <!-- Contact Form Overlay
                ============================================= -->
                <div id="contact-form-overlay" class="clearfix">

                    <div class="fancy-title title-dotted-border">
                        <h3>Envíanos un correo</h3>
                    </div>

                    <div class="contact-widget">

                        <div class="contact-form-result"></div>

                        <!-- Contact Form
                        ============================================= -->
                        <form class="nobottommargin"  name="template-contactform" method="post" action="{{route('send.contact.email')}}">
                            <div class="form-process"></div>
                            <div class="col_half">
                                <label for="template-contactform-name">Nombre <small>*</small></label>
                                <input type="text" id="name" name="name" value="" class="sm-form-control required" required autofocus />
                            </div>

                            <div class="col_half col_last">
                                <label for="template-contactform-email">Correo Electrónico <small>*</small></label>
                                <input type="email" id="email" name="email" value="" class="required email sm-form-control"  required/>
                            </div>

                            <div class="clear"></div>

                            <div class="col_half">
                                <label for="template-contactform-phone">Teléfono</label>
                                <input type="text" id="phone" name="phone" value="" class="sm-form-control" />
                            </div>

                           

                            <div class="clear"></div>

                            <div class="col_full">
                                <label for="template-contactform-subject">Asunto <small>*</small></label>
                                <input type="text" id="subject" name="subject" value="" class="required sm-form-control" required />
                            </div>

                            <div class="col_full">
                                <label for="template-contactform-message">Correo Electrónico <small>*</small></label>
                                <textarea class="required sm-form-control" id="message" name="message" rows="6" cols="30" required></textarea>
                            </div>

                            <div class="col_full hidden">
                                <input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
                            </div>

                            <div class="col_full">
                                <button class="button button-3d nomargin" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">Enviar Mensaje</button>
                            </div>

                        </form>
                    </div>


                    <div class="line"></div>

                    <!-- Contact Info
                    ============================================= -->
                    <div class="col_one_third nobottommargin">

                        <address>
                            <strong>Next Level Strategy</strong><br>
                            17 avenida 8-80, zona 14<br>
                            Guatemala, Guatemala<br>
                        </address>
                        <abbr title="Phone Number"><strong>Teléfono:</strong></abbr> (502) 2459-1825<br>
                       
                        <abbr title="Email Address"><strong>Email:</strong></abbr> <a href="mailto:info@nextlevelstrategy.net" data-type="email" data-auto-recognition="true" >info@nextlevelstrategy.net</a>

                    </div><!-- Contact Info End -->

                    <!-- Testimonails
                    ============================================= -->
                   <!-- <div class="col_two_third col_last nobottommargin">

                        <div class="fslider customjs testimonial twitter-scroll twitter-feed" data-username="envato" data-count="4" data-animation="slide" data-arrows="false">
                            <i class="i-plain color icon-twitter nobottommargin" style="margin-right: 15px;"></i>
                            <div class="flexslider" style="width: auto;">
                                <div class="slider-wrap">
                                    <div class="slide"></div>
                                </div>
                            </div>
                        </div>

                    </div>--><!-- Testimonials End -->

                </div><!-- Contact Form Overlay End -->

            </div>
@endsection
@section('scripts')
<script type="text/javascript">
    
$( "#contactform" ).submit(function( event ) {
        event.preventDefault();
        
        $("#form-process").css("display","block");

    });


</script>



@endsection
