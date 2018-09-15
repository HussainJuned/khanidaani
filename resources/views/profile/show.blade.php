@extends ('layouts.master')

@section ('title', 'Profile')

@section ('content')

<!--================================
        START BREADCRUMB AREA
    =================================-->
<section class="breadcrumb-area title-hide">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-title">{{ $user->name }} Profile</h1>
            </div>
        </div>
    </div>
</section>
<!--================================
      END BREADCRUMB AREA
  =================================-->

{{-- TODO If user visiting other profile then don't show dashboard menu this function will same for chefdish,delivery,pickerspoint--}}
@if (auth()->id() == $profile->user->id)
    @include( 'includes.menu-dashboard')
@endif

<!--================================
        START PROFILE AREA
    =================================-->
<section class="author-profile-area">
    <div class="container" id="profile">
        @include('includes.success_message')
        @include('includes.error_messeages')
        
        <div class="row">
            @include( 'includes.profile_sidebar' )
            <!-- end /.sidebar -->
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <!-- SALE STATUS -->
                    <div class="col-md-12">
                        <div class="author_module aspect_ratio mg-bt">
                <img src="{{ route('home') }}/storage/images/cover_image/{{ $profile->cover_image }}"
                     alt="author image" class="ratio_img">
              </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="author-info mcolorbg4">
                            <p>Total Dish</p>
                            <h3>{{ count($dishes) }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="author-info pcolorbg">
                            <p>Total sales</p>
                            <h3>{{ $total_sales }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="author-info scolorbg">
                            <p>Total Ratings</p>
                            <div class="rating product--rating">
                                <ul>
                                    @for ($i=1; $i <= 5; $i++) <li>
                                        @if($i <= $total_ratings) <span class="fa fa-star"></span>
                                            @else
                                            <span class="fa fa-star-o"></span>
                                            @endif
                                            </li>

                                            @endfor
                                </ul> <span class="rating__count">({{ $total_ratings_count }})</span>
                            </div>
                        </div>
                    </div>
                    <!-- SALE STATUS -->
                        <div class="col-md-12 col-sm-12">
                            <div class="author_module about_author mg-bt">
                                <h4> About {{ $user->name }}</h4>
                                <div class="brdr_btm"></div>
                                <p> {!! $profile->description !!} </p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="upload_modules">
                                <a class="toggle_title" href="#collapse5" role="button" data-toggle="collapse"
                                   aria-expanded="false" aria-controls="collapse5">
                                    <h4>Add Dish or Services
                                        <span class="lnr lnr-chevron-down"></span>
                                    </h4>
                                </a>

                                <div class="information__set toggle_module collapse" id="collapse5">

                                    <div class="upload_modules with--addons">
                                        <!-- end /.module_title -->

                                        <div class="modules__content">
                                            <div class="row">

                                                    <div class="col-md-4 col-sm-4">
                                                        <div class="author-info mcolorbg4">
                                                            <p>Total Dish</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <div class="author-info mcolorbg4">
                                                            <p>Total Dish</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <div class="author-info mcolorbg4">
                                                            <p>Total Dish</p>
                                                        </div>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end /.upload_modules -->
                            </div>
                    </div>
                    <!-- end /.row -->

                    {{--<div class="row">
                        <div class="col-md-12">
                            <div class="product-title-area">
                                <div class="product__title">
                                    <h2>{{ $user->name }} --}}{{--{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}--}}{{-- Dishes</h2>
                                </div>
                            </div>
                        </div>

                        @foreach($dishes as $dish)
                        <div class="col-lg-6 col-md-6">
                            <!-- start .single-product -->
                            <div class="product product--card">
                                <div class="product__thumbnail">
                                    <div class="aspect_ratio"> <img src="{{ route('home') }}/storage/images/dish_images/{{ $dish->dish_thumbnail }}" alt="Product Image" class="ratio_img"> </div>
                                    <div class="prod_btn"> 
                                    <a href="{{ route('dishes.show', ['id' => $dish]) }}" class="transparent btn--sm btn--round">More Info</a> 
                                    </div>
                                    <!-- end /.prod_btn -->
                                </div>
                                <!-- end /.product__thumbnail -->
                                <div class="product-desc">
                                    <a href="{{ route('dishes.show', ['id' => $dish]) }}" class="product_title">
                                        <h4> {{ $dish->dish_name }} </h4> </a>
                                    <ul class="titlebtm">
                                        <li> <img class="auth-img" src="{{ route('home') }}/storage/images/profile_image/{{ $profile->profile_image }}" alt="author image">
                                            <p> <a href="{{ route('profile.show', [ 'profile' => $profile->id]) }}">{{ $user->name }}</a> </p>
                                        </li>
                                        <li class="product_cat"> <a href="#">
                          From <span>{{ $profile->city }}, </span><span>{{ $profile->area }}</span></a> </li>
                                    </ul>
                                </div>
                                <!-- end /.product-desc -->
                                <div class="product-purchase">
                                    <div class="price_love"> <span>৳{{ $dish->dish_price }}</span>
                                        <p> <span class="lnr lnr-heart"></span> 0</p>
                                    </div>
                                    <div class="rating product--rating pull-right">
                                        <ul>
                                            @for ($i=1; $i <= 5; $i++)
                                                                                            
                                              <li>
                                                @if($i <= round($dish->avg_rating))
                                                  <span class="fa fa-star"></span>
                                                @else
                                                  <span class="fa fa-star-o"></span>
                                                @endif
                                              </li>

                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                                <!-- end /.product-purchase -->
                            </div>
                            <!-- end /.single-product -->
                        </div> 
                        @endforeach
                    </div>--}}
                    <!-- end /.row -->
                </div>
        </div>
    </div>
</section>
<!--================================
     START SELF-ADS AREA
 =================================-->
@include('includes.self_ads')
<!--================================
    END SELF-ADS AREA
=================================-->

@endsection


@push ('head-css')
  <style type="text/css">
    #snackbar {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 17px;
      }

      #snackbar.show {
        visibility: visible;
        -webkit-animation: fadein 0.3s, fadeout 0.3s 1.3s;
        animation: fadein 0.3s, fadeout 0.3s 1.3s;
      }

      @-webkit-keyframes fadein {
        from {
          bottom: 0;
          opacity: 0;
        }
        to {
          bottom: 30px;
          opacity: 1;
        }
      }

      @keyframes fadein {
        from {
          bottom: 0;
          opacity: 0;
        }
        to {
          bottom: 30px;
          opacity: 1;
        }
      }

      @-webkit-keyframes fadeout {
        from {
          bottom: 30px;
          opacity: 1;
        }
        to {
          bottom: 0;
          opacity: 0;
        }
      }

      @keyframes fadeout {
        from {
          bottom: 30px;
          opacity: 1;
        }
        to {
          bottom: 0;
          opacity: 0;
        }
      }
  </style>
@endpush


@push('scripts-footer-bottom-2')
<style type="text/css">
  
</style>

<script type="text/javascript">
  $(document).ready( function () {
    //snackbar
    function snackbar($msg) {
        $('#snackbar').html($msg);
        $('#snackbar').toggleClass('show');
        setTimeout(function () {
            $('#snackbar').removeClass('show');
        }, 1600);
    }


    //send message
    $('#send_msg').click(function(e) {
        e.preventDefault();
      var body = $('#author-message').val();
      $('#author-message').val(' ');

      $.ajax({
        url: '{{ route('messages.store') }}',
        method: "POST",
        data: {
          '_token': '{{ csrf_token() }}',
          'sender_id': {{ auth()->id() }},
          'recipient_id': {{ $profile->id }},
          'body': body,
        },
      }).done( function(data) {
          console.log("data: " + data);
          snackbar('Message Sent Successfully');

      });
    });
  });
</script>

@endpush