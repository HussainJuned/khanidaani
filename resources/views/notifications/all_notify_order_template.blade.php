<script type="text/template" class="template" id="all_notify_order_template">

  <a href="{{ route('home') }}/order/status/<%= notify.data.order.id %>">
    <div class="notification">
        <span class="line"></span>
        <div class="notification__info">
            <div class="info_avatar">
                <img src="{{ asset('/images/notification_head4.png')}}" alt="" id="all_noti_pi_<%= notify.data.order.id %>" class="img_test">

            <%
              $(document).ready(function () {


                function getImageURL(id) {
                  $.ajax({
                  url: "{{ route('home')}}/api/user/" + id + "/profile_image",
                  type: "GET",
                  dataType: "json",
                }).done( function (json) {
                  var selector = "#all_noti_pi_" + notify.data.order.id;
                  //console.log("Selector: " + selector);
                    $(selector).attr('src', '{{ URL::to('/') }}/storage/images/profile_image/'+json);
                   
                });
                }

                if(notify.data.noti_type == 'chef') {
                  var id = notify.data.order.buyer_user_id;
                  getImageURL(id);
                }
                

                if(notify.data.noti_type == 'user') {
                  var id = notify.data.order.dish_user_id;
                  getImageURL(id);
                }

                if(notify.data.noti_type == 'dsp') { 
                  var id = notify.data.order.dish_user_id;
                  getImageURL(id);
                }

              
              });
              
            %>
            </div>
            <div class="info">
              <p>
                  <% if(notify.data.noti_type == 'chef') { %>
                  <a href="#" id="temp_name"><%= notify.data.order.buyer_fullname %></a>
                    <span>Has Ordered your dish</span>
                  <% } %>

                  <% if(notify.data.noti_type == 'user') { %>
                  <a href="#" id="temp_name">You</a>
                    <span>Have Ordered a dish</span>
                  <% } %>

                  <% if(notify.data.noti_type == 'dsp') { %>
                  <a href="#" id="temp_name"><%= notify.data.order.buyer_fullname %></a>
                    <span>Has Choosen you as deliverer for</span>
                  <% } %>

                  <a href="{{ route('home') }}/dishes/<%= notify.data.order.dish_id %>">
                    <%= notify.data.order.dish_name %>
                  </a>
                  <br>
                  What about unique order id {eg. 182082001} it's mean 2018/8/20 order no 1.
                </p>
                <p class="time"><%= moment.utc(notify.data.order.created_at).fromNow() %></p>
            </div>
        </div>
        <div class="notification__icons ">
            <span class="lnr lnr-cart loved noti_icon"></span>
        </div>
    </div>
  </a>


</script>