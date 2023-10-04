@extends('frontend.layouts.master')
@section('title', 'Softguide:: Room Reserve')
@section('content')
  
    <section class="ftco-section contact-section bg-light">
      <div class="container">
        
       <h1 style="text-align:center;font-size:23px;" class="mb-4">{{ $rooms->name }}</h1>
        <div class="row block-9"> 
          <div class="col-md-6 order-md-last d-flex">
            <form  class="bg-white p-5 contact-form" action="{{ route('roomReserve') }}" method="POST" id="form">
              @csrf
              <div class="form-group d-flex" >
                <label class="col-form-label col-md-4 col-sm-4" for="price">Price<span class="required">*</span></label>
                <input type="text" class="form-control col-md-8 price" id="price"  name="room_price" value="{{ $rooms->price_per_day }} {{ getsiteconfig() !== null ? getsiteconfig()->price_unit : '' }}" disabled readonly/>
              </div>

              <div class="form-group d-flex">
                <label class="col-form-label col-md-4 col-sm-4 " for="extra_bed" >Extra Bed<span class="required">*</span></label>
                <input type="text" class="form-control col-md-8 extra_bed" id="extra_bed" name="extra_bed" value="{{ $rooms->extra_bed_price }} {{ getsiteconfig() !== null ? getsiteconfig()->price_unit : '' }}" disabled readonly />
              </div>
          
              <div class="form-group d-flex">
                <label class="col-form-label col-md-4 col-sm-4 " for="total_price">Total Price<span class="required">*</span></label>
                <input type="text" class="form-control col-md-8 total_price" id="total_price"  name="total_price" value="{{ $rooms->total_price }}" disabled readonly>
              </div>

              <div class="form-group d-flex" >
                <label class="col-form-label col-md-4 col-sm-4  " for="extra_bed_select">Extra Bed<span class="required">*</span></label>
                <input type="checkbox" class="form-control col-md-1 extra_bed_select" id="extra_bed_select" value="1" name="is_extra_bed"  /> <small style="padding:8px 0px;" id="extra_bed">&nbsp; If you went to take extra bed please Click.</small>
              </div>

              <div style="margin-left:40%;">
              @if($errors->has('checkin'))
              <small style="color:red">{{ $errors->first('checkin') }}</small>
              @endif
              </div>
              <div class="form-group d-flex">
                <label class="col-form-label col-md-4 col-sm-4 " for="checkin">Checkin Date<span class="required">*</span></label>
                <input type="text" class="form-control col-md-8 checkin" id="checkin" placeholder="Checkin Date" name="checkin" value="{{ old('checkin') }}" require readonly/>
              </div>

              <div class="form-group d-flex">
              <label class="col-form-label col-md-4 col-sm-4 " for="checkout">Checkout Date<span class="required">*</span></label>
                <input type="text" class="form-control col-md-8 checkout" disabled id="checkout" placeholder="Checkout Date" name="checkout" value="{{ old('checkout') }}" require readonly />
              </div>

              <div style="margin-left:40%;">
                @if($errors->has('name'))
              <small style="color:red">{{ $errors->first('name') }}</small>
              @endif
              </div>
              <div class="form-group d-flex">
                <label class="col-form-label col-md-4 col-sm-4 " for="name">Name<span class="required">*</span></label>
                <input type="text" class="form-control col-md-8" placeholder="Your Name" name="name" id="name" value="{{ old('name') }}" require />
              </div>

              <div style="margin-left:40%;">
                @if($errors->has('email'))
              <small style="color:red">{{ $errors->first('email') }}</small>
              @endif
              </div>
              <div class="form-group d-flex">
              <label class="col-form-label col-md-4 col-sm-4 " for="email">Email<span class="required">*</span></label>
                <input type="email" class="form-control col-md-8" placeholder="yourmail@email.com" pattern="[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" name="email" id="email" value="{{ old('email') }}" require />
              </div>

              <div style="margin-left:40%;">
                @if($errors->has('phone'))
                <small style="color:red">{{ $errors->first('phone') }}</small>
                @endif
                </div>
              <div class="form-group d-flex">
              <label class="col-form-label col-md-4 col-sm-4 " for="checkin">Phone<span class="required">*</span></label>
                <input type="number" class="form-control com-md-8" placeholder="+95 XX XXXX XXXX" name="phone" value="{{ old('phone') }}" require />
              </div>

              <div class="form-group offset-md-4">
                <input type="submit" value="Booking" class="btn btn-primary py-3 px-5" id="submit-btn">
                <input type="hidden" name="room_id" value="{{ $rooms->id }}">
              </div>
            </form>
          </div>
          <div class="col-md-6 d-flex">
                <div class="col-md-12 ftco-animate">
                    <div class="single-slider owl-carousel">
                    @foreach($rooms->getGallery as $gallery)
                    <div class="item">
                      <img src="{{ URL::asset('assets/upload/'. $rooms->id . '/'. $gallery->image) }}"  alt="">
                    </div>
                    @endforeach
                    </div>
                </div>    
            </div>

        </div>
      </div>
    </section>
    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.js') }}"></script>
      <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.buttons.js') }}"></script>
      <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.nonblock.js') }}"></script>
      @if(session('success'))
      <script>
        new PNotify({
        title: 'Success',
        text: '{{ session()->get('success') }}',
        type: 'success',
        hide: false,
        styling: 'bootstrap3'
        }); 
      </script>
        
    @endif
    @if(session('error'))
      <script>
        new PNotify({
        title: 'Error',
        text: '{{ session()->get('error') }}',
        type: 'error',
        hide: false,
        styling: 'bootstrap3'
        }); 
      </script>
        
    @endif
    @endsection
    <script src="{{ URL::asset('assets/frontend/js/jquery.min.js') }}"></script>
    <script>
      $(document).ready(function() {
          $("#checkin").datepicker({
              minDate: 0,
              onSelect: function(selectedDate) {
                var minDate = new Date(selectedDate);
                minDate.setDate(minDate.getDate()+1);
                  $("#checkout").datepicker("option", "minDate", minDate);
                  $("#checkout").prop("disabled",false);
              }
          });
          
          $("#checkout").datepicker({
              minDate: 0
          });
      });
    </script>
<script>
    $(document).ready(function() {
        var roomPrice = {{ $rooms->price_per_day }};
        var extraBedPrice = {{ $rooms->extra_bed_price }};
        @if(getsiteconfig() !== null)
        var priceUnit = "{{ getsiteconfig()->price_unit }}";
        @else
        var priceUnit = '';
        @endif
        // Function to update the total price
        function updatePriceDisplay() {
        var checkinDate = new Date($("#checkin").val());
        var checkoutDate = new Date($("#checkout").val());

        // Check if valid dates are selected before calculating the total price
        if (!isNaN(checkinDate) && !isNaN(checkoutDate)) {
        var daysDifference = Math.floor((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24)); // Adding 1 to include the last day
        var totalBasePrice = roomPrice * daysDifference;

        if ($(".extra_bed_select").is(":checked")) {
        totalBasePrice += extraBedPrice * daysDifference;
        }

        $(".total_price").val(formatPrice(totalBasePrice));
        } else {
        // If dates are not valid, display the default total price
        $(".total_price").val(roomPrice + priceUnit);
        }
        }

        function formatPrice(price) {
        return price.toFixed(2) + priceUnit;
        }

        // Attach change event handlers to update the price
        $(".extra_bed_select, .checkin, .checkout").change(function() {
        updatePriceDisplay();
        });

        updatePriceDisplay();
    });
</script>
<script>
  $(document).ready(function(){
      $('#submit-btn').click(function(){
          let error         = false
          const name        = $('.name').val();
          const email       = $('.email').val();
          const phone       = $('.phone').val();
          const name_length = name.length;
          if(name  == ''){
              $('.name-error-msg').text('')
              $('.name-error-msg').text('Please fill name')
              $('.label-error').show()
              error     = true
          } else {
              $('.label-error').hide()
          }
          if(email  == ''){
              $('.email-error-msg').text('')
              $('.email-error-msg').text('Please fill email')
              $('.email-error').show()
              error     = true
          } else {
              $('.label-error').hide()
          }
          if(phone  == ''){
              $('.phone-error-msg').text('')
              $('.phone-error-msg').text('Please fill phone')
              $('.label-error').show()
              error     = true
          } else {
              $('.label-error').hide()
          }
          if(name != '' && name_length <3){
              $('.name-error-msg').text('')
              $('.name-error-msg').text('Name length is at least must be greather then three ')
              $('.label-error').show()
              error     = true
          }
          if(name != '' && name_length > 30){
              $('.name-error-msg').text('')
              $('.name-error-msg').text('Name length is must be less then 30')
              $('.label-error').show()
              error     = true
          }
          if(error == false){
              $('#form-create').submit();
          }
      })
      
      $('#reset').click(function(){
              $('.label-error').hide()
      }) 
  })
</script>
      
      
  </body>
</html>

