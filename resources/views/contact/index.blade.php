@extends('main')


@section('contact') 
            <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">
  
          <div class="section-title">
            <h2>Contact</h2>
         </div>
        </div>
  
        <div>
          <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1891.1912921204366!2d-72.29868104198292!3d18.556782696846962!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8eb9e7baf1a8c86b%3A0x7b1518bd8e64df61!2sDirection%20d&#39;Epid%C3%A9miologie%2C%20de%20Laboratoire%20et%20de%20Recherches!5e0!3m2!1sen!2sbg!4v1603116470815!5m2!1sen!2sbg" frameborder="0" allowfullscreen></iframe>
        </div>
  
        <div class="container">
          <div class="row mt-5">
  
            <div class="col-lg-4">
              <div class="info">
                <div class="address">
                  <i class="icofont-google-map"></i>
                  <h4>Adresse:</h4>
                  <p>Delmas 33, Haiti (W.I)</p>
                </div>
  
                <div class="email">
                  <i class="icofont-envelope"></i>
                  <h4>Email:</h4>
                  <p>secretariatdelr@yahoo.fr</p>
                </div>
  
                <div class="phone">
                  <i class="icofont-phone"></i>
                  <h4>Téléphone:</h4>
                  <p>+509 2254 0014</p>
                </div>
  
              </div>
  
            </div>
  
            <div class="col-lg-8 mt-5 mt-lg-0">
  
              <form action="{{ route('sendEmail') }}" method="post" role="form" >
                @csrf
  
                <div class="form-row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="nom" class="form-control" required id="nom" placeholder="Votre nom" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-6 form-group">
                    <input type="email" class="form-control" required name="email_source" id="email_source" placeholder="Votre Email" data-rule="email" data-msg="Please enter a valid email" />
                    <div class="validate"></div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" required name="sujet" id="sujet" placeholder="Sujet" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validate"></div>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="messages" id="messages" required rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                  <div class="validate"></div>
                </div>
                {{-- <div class="mb-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div> --}}
                <button type="submit" class="text-center btn btn-primary">Envoyer un Message</button>
              </form>
  
            </div>
  
          </div>
  
        </div>
      </section><!-- End Contact Section -->
@endsection
