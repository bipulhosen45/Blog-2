@php
    $post= DB::table('posts')->where('status', 1)->first();
@endphp
<footer class="">
    <div class="container">
        <div class="row">
            <div class="col-md-3 text-start">
                <a href="{{route('front.index')}}" class="d-block mb-3" style="color: #f48840"><img src="{{$setting?->favicon}}" width="270px" height="70px" alt=""></a>
                <p class="text-capitalize">Office Location: {{$setting?->address}}</p>
                <div class="col-lg-12 mt-3">
                    <ul class="d-flex justify-content-start">
                        <li><a href="{{ $setting?->facebook }}"><i class="fa-brands fa-facebook"></i></a></li>
                        <li class="mx-3"><a href="{{ $setting?->twitter }}"><i class="fa-brands fa-twitter"></i></a></li>
                        <li><a href="{{ $setting?->linkedin }}"><i class="fa-brands fa-linkedin"></i></a></li>
                        <li class="mx-3"><a href="{{ $setting?->instagram }}"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="{{ $setting?->youtube }}"><i class="fa-brands fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto">
                <h6 class="text-uppercase mb-4 font-weight-bold" style="color: #f48840">
                    Quick links
                </h6>
                <p class="text-start text-capitalize" style="margin-left: 26%;">
                    <a href="{{ route('front.index') }}" class="text-primary">Home</a>
                </p>
                <p class="text-start text-capitalize" style="margin-left: 26%;">
                    <a href="#" class="text-primary">About Us</a>
                </p>
                <p class="text-start text-capitalize" style="margin-left: 26%;">
                    <a href="{{ route('front.all_post') }}" class="text-primary">Blog Post</a>
                </p>
                <p class="text-start text-capitalize" style="margin-left: 26%;">
                    <a href="{{ route('front.contact') }}" class="text-primary">Contact Us</a>
                </p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto">
                <h6 class="text-uppercase mb-4 font-weight-bold" style="color: #f48840">
                    Partners
                </h6>
                <p class="text-start text-capitalize" style="margin-left: 29%;">
                    <a href="#" class="text-primary">Clients</a>
                </p>
                <p class="text-start text-capitalize" style="margin-left: 29%;">
                    <a href="#" class="text-primary">Teams</a>
                </p>
                <p class="text-start text-capitalize" style="margin-left: 29%;">
                    <a href="#" class="text-primary">Testimonials</a>
                </p>
                <p class="text-start text-capitalize" style="margin-left: 29%;">
                    <a href="#" class="text-primary">Journal</a>
                </p>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto">
                <h6 class="text-uppercase mb-4 font-weight-bold" style="color: #f48840">
                    Privacy Policy
                </h6>
                <p class="text-start text-capitalize" style="margin-left: 18%;">
                    <a href="#" class="text-primary">Privacy Policy</a>
                </p>
                <p class="text-start text-capitalize" style="margin-left: 18%;">
                    <a href="#" class="text-primary">Terms &amp; Conditions</a>
                </p>
                <p class="text-start text-capitalize" style="margin-left: 18%;">
                    <a href="#" class="text-primary">Partners</a>
                </p>
                <p class="text-start text-capitalize" style="margin-left: 18%;">
                    <a href="#" class="text-primary">Carrer</a>
                </p>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto">
                <h6 class="text-uppercase mb-4 font-weight-bold" style="color: #f48840; margin-left: -25%;">
                   Contact Us
                </h6>
                <p class="text-start text-capitalize text-primary" style="margin-left: 23%; font-size: 13px;">
                    <a href="" class="text-white fas fa-home mr-3"></a> {{$setting?->address}}
                </p>
                <p class="text-start text-lowercase text-primary" style="margin-left: 23%; font-size: 13px;">
                    <a href="" class="text-white fas fa-envelope mr-3"></a> {{$setting?->support_email}}
                </p>
                <p class="text-start text-capitalize text-primary" style="margin-left: 23%; font-size: 13px;">
                    <a href="" class="text-white fas fa-phone mr-3"></a> {{$setting?->phone_one}}
                </p>
                <p class="text-start text-capitalize text-primary" style="margin-left: 23%; font-size: 13px;">
                    <a href="" class="text-white fas fa-print mr-3"></a> {{$setting?->phone_two}}
                </p>
            </div>
        </div>
        <div class="row my-5" style="border-bottom: 1px solid rgba(115, 110, 110, 0.536);"></div>
            <!-- Grid column -->
          

            <div class="col-lg-12">
                <div class="copyright-text">
                    <p>MediTips BLOG &copy; {{ date('Y') }} | Design & Developed By <a href="pnptech.com"
                            target="_parent">URL Academy</a></p>
                </div>
            </div>

    </div>
</footer>

@push('js')
@endpush
