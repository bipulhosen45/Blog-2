@extends('fronted.layouts.master')
@section('page_title', 'Welcome')

@section('banner')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>Feel free to contact us</h4>
                            <h2>Contact Us</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('content')


    <section class="contact-us">
        <div class="container">
            <div class="row">

                <div class="col-lg-8">
                    <div class="down-contact">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="sidebar-item contact-form">
                                    <div class="sidebar-heading">
                                        <h2>Send us a message</h2>
                                    </div>
                                    <div class="content">
                                        <form action="{{ route('contact.store') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <input name="name" type="text" class="form-control" id="name"
                                                        placeholder="Your name">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <input name="email" type="text" class="form-control" id="email"
                                                        placeholder="Your email">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <input name="phone" type="text" class="form-control" id="phone"
                                                        placeholder="Your phone">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <input name="subject" type="text" class="form-control" id="subject"
                                                        placeholder="Subject">
                                                </div>
                                                <div class="col-lg-12">
                                                    <textarea name="message" rows="1" class="form-control" id="message" placeholder="Your Message"></textarea>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-success btn-sm text-white " name=""
                                                id="" value="Send Message">
                                        </form>
                                    </div>
                                </div>
                            </div>
                
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-item contact-information">
                      <div class="sidebar-heading">
                        <h2>contact information</h2>
                      </div>
                      <div class="content">
                        <ul>
                          <li>
                            <h5>090-484-8080</h5>
                            <span>PHONE NUMBER</span>
                          </li>
                          <li>
                            <h5>info@company.com</h5>
                            <span>EMAIL ADDRESS</span>
                          </li>
                          <li>
                            <h5>123 Aenean id posuere dui, 
                                <br>Praesent laoreet 10660</h5>
                            <span>STREET ADDRESS</span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                <div class="col-lg-12">
                    <div id="map">
                        <iframe
                            src="https://maps.google.com/maps?q=Av.+L%C3%BAcio+Costa,+Rio+de+Janeiro+-+RJ,+Brazil&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            width="100%" height="450px" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>


@endsection
