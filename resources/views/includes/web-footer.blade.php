    <!-- Start Footer  -->
    <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            <h4>About ThewayShop</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="https://x.com/Kamalch88334489?t=VylgJhEmNHyEvFOIXCpewg&s=09"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <li><a href="https://wa.me/qr/I7FPYIZKD4EYD1 "><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link">
                            <h4>Information</h4>
                            <ul>
                                @foreach (getPages() as $page)                                
                                <li><a href="{{ route('page',$page->url_key)}}">{{$page->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Contact Us</h4>
                            <ul>
                                <li>
                                    <p><i class="fas fa-map-marker-alt"></i>Address: Clock Tower . Sardarshahar <br> KS 67213 </p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-888705770">+1-888 705 770</a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">contactinfo@gmail.com</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </footer>
    <!-- End Footer  -->

    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; 2024 <a href="#">ThewayShop</a> Design By :
            <a href="https://html.design/">Kamal Choudhary</a></p>
    </div>
    <!-- End copyright  -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="{{asset('web-assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('web-assets/js/popper.min.js')}}"></script>
    <script src="{{asset('web-assets/js/bootstrap.min.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{asset('web-assets/js/jquery.superslides.min.js')}}"></script>
    <script src="{{asset('web-assets/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('web-assets/js/inewsticker.js')}}"></script>
    <script src="{{asset('web-assets/js/bootsnav.js.')}}"></script>
    <script src="{{asset('web-assets/js/images-loded.min.js')}}"></script>
    <script src="{{asset('web-assets/js/isotope.min.js')}}"></script>
    <script src="{{asset('web-assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('web-assets/js/baguetteBox.min.js')}}"></script>
    <script src="{{asset('web-assets/js/form-validator.min.js')}}"></script>
    <script src="{{asset('web-assets/js/contact-form-script.js')}}"></script>
    <script src="{{asset('web-assets/js/custom.js')}}"></script>