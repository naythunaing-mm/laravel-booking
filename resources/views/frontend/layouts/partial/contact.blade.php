@extends('frontend.layouts.master')
@section('title','SoftGuide::Contact Page')
@section('content')
    <section class="ftco-section contact-section bg-light">
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-12 mb-4">
            <h2 class="h3">Contact Information</h2>
          </div>
          <div class="w-100"></div>
          <div class="col-md-3 d-flex">
          	<div class="info rounded bg-white p-4">
	            <p><span>Address:</span> 
                    {{ (getsiteconfig() !== '')? getsiteconfig()->address : '' }}
                </p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info rounded bg-white p-4">
	            <p><span>Online Phone</span> <a href="">
                    {{ (getsiteconfig() !== '')? getsiteconfig()->online_phone : '' }}
                </a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info rounded bg-white p-4">
	            <p><span>Phone:</span> <a href="javascript:void(0);">
                    {{ (getsiteconfig() !== '')? getsiteconfig()->outline_phone : '' }}
                </a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info rounded bg-white p-4">
	            <p><span>Email:</span> <a href="mailto:info@yoursite.com">
                    {{ (getsiteconfig() !== '')? getsiteconfig()->email : '' }}
                </a></p>
	          </div>
          </div>
          
        </div>
        <div class="row block-9">
          <div class="col-md-6 order-md-last d-flex">
            <form action="contact.php" class="bg-white p-5 contact-form" method="post">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name" name="name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Email" name="email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="City" name="city">
              </div>
              <div class="form-group">
                <textarea name="message" id="" cols="30" rows="5" class="form-control" placeholder="Message" ></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                <input type="hidden" name="form-sub" value="1">
              </div>
            </form>
          
          </div>

          <div class="col-md-6 d-flex">
          	<div id="map" class="bg-white">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.920199614829!2d96.1271119340391!3d16.830314483320876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c195280d8ece71%3A0xae58d36ddceb3e81!2sSoftGuide%20Hledan!5e0!3m2!1sen!2smm!4v1693315975524!5m2!1sen!2smm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endsection