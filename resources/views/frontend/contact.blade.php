@extends('frontend.template')
@section('pageTitle','Contact | Foodstagram')
@section('css')
    <link rel="stylesheet" href="{{asset('css/contact.css')}}">
@endsection
@section('content')
<div class="con-first">
    <div class="container">
        <div class="contact">
            <h1>Contact</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellendus</br> quia aspernatur consequatur quae velit ullam asperiores omnis</br> ratione quos aperiam! Et amet itaque beatae dolorum! Eveniet,</br> reprehenderit quod? Illum, necessitatibus.</p>
        </div>
        <div class="con-pic">
            <img src="images/icecream.jpg" alt="">
        </div>
    </div>
</div>

<div class="page-section cta">
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <div class="cta-inner text-center rounded">
            <h2 class="section-heading mb-5">
              <span class="section-heading  -upper">Come On In</span>
              <span class="section-heading-lower">We're Open</span>
            </h2>
            <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
              <li class="list-unstyled-item list-hours-item d-flex">
                Sunday
                <span class="ml-auto">9:00 AM to 8:00 PM</span>
              </li>
              <li class="list-unstyled-item list-hours-item d-flex">
                Monday
                <span class="ml-auto">9:00 AM to 8:00 PM</span>
              </li>
              <li class="list-unstyled-item list-hours-item d-flex">
                Tuesday
                <span class="ml-auto">9:00 AM to 8:00 PM</span>
              </li>
              <li class="list-unstyled-item list-hours-item d-flex">
                Wednesday
                <span class="ml-auto">closed</span>
              </li>
              <li class="list-unstyled-item list-hours-item d-flex">
                Thursday
                <span class="ml-auto">9:00 AM to 8:00 PM</span>
              </li>
              <li class="list-unstyled-item list-hours-item d-flex">
                Friday
                <span class="ml-auto">9:00 AM to 8:00 PM</span>
              </li>
              <li class="list-unstyled-item list-hours-item d-flex">
                Saturday
                <span class="ml-auto">9:00 AM to 5:00 PM</span>
              </li>
            </ul>
            <p class="address mb-5">
              <em>
                <strong>No.(10) Ward,Inya Road,Yangon, Myanmar (Burma)</strong>
                <br>
                Near St. Augustine’s Catholic Church
              </em>
            </p>
            <p class="mb-0">
              <small>
                <em>Call Anytime</em>
              </small>
              <br>
              09799707426
            </p>
          </div>
        </div>
      </div>
    </div>
</div>

   
<div class="map">
  <div class="contact-in">
    <div class="contact-map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d954.7748699103089!2d96.1381108291367!3d16.821420282997284!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDQ5JzE3LjEiTiA5NsKwMDgnMTkuMiJF!5e0!3m2!1sen!2sus!4v1621072296353!5m2!1sen!2sus"
       width="100%" height="auto" frameborder="0" style="border:0"; allowfullscreen="" aria-hidden="false" tabindex="0" ></iframe>
    </div>
    <div class="contact-form">
      <h1>Contact Us</h1>
      <form>
        <input type="text" placeholder="Name" class="contact-form-txt">
        <input type="text" placeholder="Email" class="contact-form-txt">
        <textarea placeholder="Message" class="contact-form-textarea"></textarea>
        <input type="submit" name="Submit" class="contact-form-btn">
      </form>
    </div>
  </div>
</div>
@endsection