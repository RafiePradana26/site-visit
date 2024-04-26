@extends('layouts.welcome')
@section('content')
<section class="testimonial">
    <div class="container">
      <div class="row">
        <div class="section-title text-center">
          <h2>Testimoni</h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,  <br> there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="block">
            <ul class="counter-box clearfix">
              <li>
                <div class="counter-item">
                  <i class="ion-ios-chatboxes-outline"></i>
                  <h4 class="counter">99</h4>
                  <span>Cups Of Coffee</span>
                </div>
              </li>
              <li>
                <div class="counter-item">
                  <i class="ion-ios-glasses-outline"></i>
                  <h4 class="counter">45</h4>
                  <span>Article Written</span>
                </div>
              </li>
              <li>
                <div class="counter-item">
                  <i class="ion-ios-compose-outline"></i>
                  <h4 class="counter">125</h4>
                  <span>Projects Completed</span>
                </div>
              </li>
              <li>
                <div class="counter-item">
                  <i class="ion-ios-timer-outline"></i>
                  <h4 class="counter">200</h4>
                  <span>Combined Projects</span>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-5 col-md-offset-1">
          <div class="testimonial-carousel text-center">
            <div  class="testimonial-slider owl-carousel">
              <div>
                <i class="ion-quote"></i>
                <p>"This Company created an e-commerce site with the tools to make our business a success, with innovative ideas we feel that our site has unique elements that make us stand out from the crowd."</p>
                <div class="user">
                  <img src="{{ asset('assets/website/images/item-img1.jpg') }}" alt="Pepole">
                  <p><span>Rose Ray</span> CEO-Themefisher</p>
                </div>
              </div>
              <div>
                <i class="ion-quote"></i>
                <p>"This Company created an e-commerce site with the tools to make our business a success, with innovative ideas we feel that our site has unique elements that make us stand out from the crowd."</p>
                <div class="user">
                  <img src="{{ asset('assets/website/images/item-img1.jpg') }}" alt="Pepole">
                  <p><span>Rose Ray</span> CEO-Themefisher</p>
                </div>
              </div>
              <div>
                <i class="ion-quote"></i>
                <p>"This Company created an e-commerce site with the tools to make our business a success, with innovative ideas we feel that our site has unique elements that make us stand out from the crowd."</p>
                <div class="user">
                  <img src="{{ asset('assets/website/images/item-img1.jpg') }}" alt="Pepole">
                  <p><span>Rose Ray</span> CEO-Themefisher</p>
                </div>
              </div>
              <div>
                <i class="ion-quote"></i>
                <p>"This Company created an e-commerce site with the tools to make our business a success, with innovative ideas we feel that our site has unique elements that make us stand out from the crowd."</p>
                <div class="user">
                  <img src="{{ asset('assets/website/images/item-img1.jpg') }}" alt="Pepole">
                  <p><span>Rose Ray</span> CEO-Themefisher</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
   
@endsection

<style>
   
</style>

