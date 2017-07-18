@extends('layout.master')

@section('content')
  <div class="container cart-wrapper">
    <center><span class="red">All your orders will be Cash on delivery for some time.</span></center>
    <div class="col-xs-12">
      @if(Session::has('Cart'))
        <table class="table table-bordered table-responsive cart-table">
          <thead>
            <tr>
              <th>Product</th>
              <th class="middle-align">Price</th>
              <th class="middle-align">Quantity</th>
              <th class="middle-align">Total</th>
              <th class="middle-align"></th>
            </tr>
          </thead>
          <tbody>
        @php
          $itemcount=0;
          $amount=0;
          $count=0;
          $items=Session::get('Cart');
        @endphp
        @foreach ($items as $item)
          @if ($count==0)
            @if(count($item)>0)
              @php
                $itemcount=count($item);
              @endphp
              @foreach($item as $product)
                @php
                  $price=1;
                  $price = $product['price'] / $product['quantity'];
                @endphp
                <tr>
                  <td><img class="cart-image" src="{{ URL::asset($product['image']) }}" alt=""><span class="grey cart-product-name">{{ $product['name'] }}</span></td>
                  <td class="middle-align"><span class="grey">Rs. {{ $price }}</span></td>
                  <td class="middle-align">
                    {{-- <button type="button" class="reduce-cart" name="button">-</button>
                    <input type="number" name="" value="{{ $product['quantity'] }}">
                    <button type="button" class="increase-cart" name="button">+</button> --}}
                    <span class="cart-input">{{ $product['quantity'] }}</span>
                    <input class="input-hidden" id="cart-input" type="text" value="{{ $product['quantity'] }}" name="quantity"/>
                    <span class="hidden">{{ $product['id'] }}</span>
                  </td>
                  <td class="middle-align"><span class="red">Rs. {{ $product['price'] }}</span></td>
                  <td class="middle-align"><a href="{{ url('removefromcart') }}/{{ $product['id'] }}"><button type="button" name="button" class="grey cart-remove-button">X</button></a></td>
                </tr>
              @endforeach
            @else
                <div  class=" col-md-12 col-xs-12 col-sm-12 col-lg-12"><center><h2 class="grey">Put Something in the cart</h2></center></div>
            @endif
          @elseif ($count==1)

          @elseif ($count==2)
            @php
              $amount=$item;
            @endphp
          @endif
          @php
            $count++;
          @endphp
        </tbody>
      </table>
        @endforeach
        @if($itemcount>0)
        <div class="col-xs-12 cart-footer zero-padding">
          <div class="col-xs-12 col-md-6">
            <div class="check-out-form col-xs-12 zero-padding">
               <form action="{{ url('/checkout') }}" method="post">
               <input type="hidden" name="amount" value="{{ $amount }}"/>
               <input type="hidden" name="language" value="en"/>
               <input type="hidden" name="merchant_id" value="42290"/>
               <input type="hidden" name="integration_type" value="iframe_normal"/>
               <input type="hidden" name="cancel_url" value="{{ url('cart') }}"/>
               <input type="hidden" name="redirect_url" value="{{ url('/checkoutresponse') }}"/>
               <input type="hidden" name="currency" value="INR"/>
               {{ csrf_field() }}
               <input type="hidden" name="order_id" value="{{ getRandomString(10) }}"/>
               @if(count($addresses)>0)
                   <div class="col-xs-12 col-sm-12 zero-padding">
                     <label style="text-align:left;" class="grey">Select delivery address</label>
                     <select name="address" required>
                     @foreach ($addresses as $address)
                       <option value="{{ $address->id }}">{{ $address->street_name }}</option>
                     @endforeach
                    </select>
                   </div>

                   <div class="col-xs-12 col-sm-12 bill-drop zero-padding"  id="bill-drop">
                     <label style="text-align:left;" class="grey">Select billing address</label>
                     <select name="billing-address" required>
                         @foreach ($addresses as $address)
                           <option value="{{ $address->id }}">{{ $address->street_name }}</option>
                         @endforeach
                     </select>
                   </div>

                    <div class="col-md-12 zero-padding" >
                     <label class="grey"><input id="diff-bill" type="checkbox" name="diffbillingaddress" value="1"> Different billing address</label>
                    </div>
                    <div class="col-md-12 zero-padding" >
                      <label class="grey"><input id="cod" type="checkbox" name="cod" value="1"> Cash/Card On delivery</label>
                    </div>
                    <div class="col-md-12" ><a href="{{ url('/address') }}" >Add another Address</a></div>

                  @else
                    <div class="col-md-12" ><a href="{{ url('/address') }}" >Add Address</a></div>
                  @endif

               </div>
          </div>
          <div class="col-xs-12 col-md-6">
            <h3><span>CART</span> <span class="green">TOTAL</span></h3>
            <div class="col-xs-6 zero-padding align-left">
              <h5 class="grey">SUBTOTAL</h5>
              <h5 class="grey">SHIPPING</h5>
              <h5 class="grey">ORDER TOTAL</h5>
            </div>
            <div class="col-xs-6 zero-padding align-right">
              <h5 class="grey">Rs {{ $amount }}</h5>
              <h5 class="red">Free Shipping</h5>
              <h5 class="grey">Rs {{ $amount }}</h5>
            </div>
              <button class="add-to-cart-button col-md-12 col-sm-12 col-xs-12 zero-padding" type="submit">Checkout</button>

           </form>
          </div>
        </div>
      @endif
    @else
      <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12"><center><h2 class="grey">No Items Selected</h2></center></div>
    @endif
    </div>
  </div>
  <script type="text/javascript">
  $('.reduce-cart').click(function(e){
    var val = $(this).prev().val();
  });

  $(".cart-input").on('click',function (e) {
    currentCartCount=$(this).next().val();
    $(this).hide();
    $(this).next().show().focus();
  });

  $(".input-hidden").keypress(function(e) {
    if(e.which<48 || e.which>57){
      e.preventDefault();
    }
    if(e.which==13){
      $(".input-hidden").blur();
    }
  });

  var baseUrl = "{{ url('/') }}/";
  $(".input-hidden").blur(function() {
    $(this).hide();
    if($(this).val()!=$(this).prev().html()){
      $(this).prev().html($(this).val()).show();
      $.ajax({
        url:baseUrl+"removecart",
        method:"get",
        data:{
          id:$(this).next().html(),
          quantity:$(this).val()
        },
        success:function (response) {
          if(response==1){
            // $.ajax({
            //   url:baseUrl+"refreshcart",
            //   method:"get",
            //   success:function (response) {
            //     $("#cart-div").html(response);
            //   },
            //   error:function (response) {
            //   }
            // });
            // $.ajax({
            //   url:baseUrl+"cartcount",
            //   method:"get",
            //   success:function (response) {
            //     $("#cart-glyph").html(response);
            //   },
            //   error:function (response) {
            //   }
            // });
            // $.ajax({
            //   url:baseUrl+"refreshviewcart",
            //   method:"get",
            //   success:function (response) {
            //     $("#books").html(response);
            //   },
            //   error:function (response) {
            //   }
            // });
            location.reload();
          }else{
            location.reload();
          }
        },
        error:function (response) {

        }
      });
    }else{
      $(this).prev().show();
    }
  });
  $("#diff-bill" ).on( "click", function() {
    $("#bill-drop").toggleClass('bill-drop');
  });
  </script>
@endsection
