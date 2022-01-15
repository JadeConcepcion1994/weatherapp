<template>

    <div>
      <a href="/" class="btn btn-info">Home <i class="fa fa-home" aria-hidden="true"></i></a>
       <div class="head-title">
         <h3 align="center">Select City and Check the Weather</h3>
       </div>
       <br>

        <div class="row">
          <div class="col-md-6 offset-md-3">
               <select class="form-control" id="city">
                 <option selected disabled>Select City</option>
                 <option value="Tokyo">Tokyo</option>
                 <option value="Yokohama">Yokohama</option>
                 <option value="Kyoto">Kyoto</option>
                 <option value="Osaka">Osaka</option>
                 <option value="Sapporo">Sapporo</option>
                 <option value="Nagoya">Nagoya</option>
              </select><br>
              <center><button class="btn btn-success btn-check-weather">Check Weather <i class="fa fa-cloud" aria-hidden="true"></i></button></center>
              
          </div>
        </div>
          
    
      <br>
       <div class="row">
        <div class="col-md-6 offset-md-3">

          
        
            <div class="card hide-card">
              <div class="card-header">
               <h5><span id="city_name"></span> Weather Conditions</h5>
              </div>
              <div class="card-body card-body-weather">

                <div class="row">
                   <div class="col-md-6">
                      <br>
                      <!-- <b><span class="temp" style="font-size:100px; margin-top: 200px !important;"></span></b><span>&#176; C</span> -->
                      <center>
                        <button type="button" class="btn temp">
                        
                      </button>
                      <span class="badge">&#176; C | &#176; F</span>
                      </center>
                      

                    </div>

                    <div class="col-md-6">
                      <div class="day"></div><div class="time"></div>
                      <img id="icon_weather">
                      <div><span class="weather"></span> (<span id="desc"></span>)</div>
                      <div>Humidity: <span class="humidity"></span>%</div>
                      <div>Wind: <span class="wind"></span> km/h</div>
                    </div>
                    
                </div>

                
              </div>

              <div class="card-footer text-muted">
                <div class="row">
                  <div class="col-md-6">
                    <img src="https://img.icons8.com/fluency/48/000000/sunrise.png"/>
                      <span>Sunrise </span><b><span id="sunrise"></span></b>
                  </div>
                  <div class="col-md-6">
                    <img src="https://img.icons8.com/fluency/48/000000/sunset.png"/>
                      <span>Sunset </span><b><span id="sunset"></span></b>
                  </div>
                </div>
              </div>

            </div>
        
         </div>
       </div>

       <br>
       <div class="row">
          <div class="col-md-6 offset-md-3">
       
                <div class="card hide-card1">
                    <div class="card-body">
                       <div class="row">
                         <div class="col-md-6">
                           Latitude : <b><span id="latitude"></span></b>
                         </div>
                         <div class="col-md-6">
                           Longitude : <b><span id="longitude"></span></b>
                         </div>
                       </div>
                    </div>
                </div>

          </div>
       </div>

       <br>
       <div class="row">
          <div class="col-md-6 offset-md-3">
       
                <div class="card hide-card1">
                  <div class="card-header">
                   <h5>Places to visit</h5>
                  </div>
                    <div class="card-body">
                      <div class="table-responsive">
                          <table class="table table-dark">
                            <thead>
                                <tr>
                                  <th>Location</th>
                                  <th>Name</th>
                                  <th>Type</th>
                                </tr>
                            </thead>
                            <tbody id="places_to_visit">
                              
                            </tbody>
                          </table>
                      </div>
                    </div>
                </div>

          </div>
       </div>

      
    </div>

</template>
  

    <script>
    $(document).ready(function(){
      $('.hide-card').hide();
      $('.hide-card1').hide();

      $('.btn-check-weather').on('click', function(){
        var value = $('#city').val();
         
         //conditon to check if no value
         if(value == null){

          swal.fire('Error!', 'Please Select an Option','error');

         }else{

            $.ajax({
                url: "http://api.openweathermap.org/data/2.5/forecast",//api request for weather conditions
                type: "GET",
                dataType: "JSON",
                data: {
                    q: value,
                    cnt: '6',
                    APPID: "08b662111b14602224fa6f0044d0df0a"//api key
                },
                beforeSend: function(){
                  $('.btn-check-weather').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                },
                success: function(data) {

                  setTimeout(function(){//settimeout for 2sec

                    $('.hide-card').show();
                    $('.btn-check-weather').html('Check Weather <i class="fa fa-cloud" aria-hidden="true"></i>');
                    var temp = data.list[0].main.temp_max - 273.15;//convert to celcius
                    var icon = data.list[0].weather[0].icon;//icon depends on weather condition

                    var timestamp = data.list[0].dt * 1000;
                    var dateWithouthSecond = new Date(data.list[0].dt * 1000);
                    let real_time = new Date(timestamp).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});//convert to current time in location

                    var srise = data.city.sunrise * 1000;
                    let sun_rise = new Date(srise).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});//convert sunrise time
                    var sset = data.city.sunset * 1000;
                    let sun_set = new Date(sset).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});//convert sunset time

                    let wspeed = data.list[0].wind.speed * 3.6;

                    //passing data on html elements
                    $('#sunrise').text(sun_rise);
                    $('#sunset').text(sun_set);
                    $('.time').text(real_time);
                    $('#city_name').text(data.city.name);
                    $('.weather').text(data.list[0].weather[0].main);
                    $('#desc').text(data.list[0].weather[0].description);
                    $('.temp').text(Math.round(temp));
                    $('.humidity').text(data.list[0].main.humidity);
                    $('.wind').text(Math.round(wspeed));
                    $('#icon_weather').attr('src', 'http://openweathermap.org/img/wn/'+icon+'.png');


                    //get current day
                    const unixTime = data.list[0].dt;
                    const date = new Date(unixTime*1000);
                    let day = date.getDay();

                      //condition to get current day
                       if(day == 1){
                         var fday = 'Monday';
                       }else if(day == 2){
                         var fday = 'Tuesday';
                       }else if(day == 3){
                         var fday = 'Wednesday';
                       }else if(day == 4){
                         var fday = 'Thursday';
                       }else if(day == 5){
                         var fday = 'Friday';
                       }else if(day == 6){
                         var fday = 'Saturday';
                       }else if(day == 0){
                         var fday = 'Sunday';
                       }


                    $('.day').text(fday);

                  }, 2000);
                  

                    
                }

            });


            //condition for longitude at latitude
            if(value == 'Tokyo'){
              var ll = '35.689487,35.689487';
            }else if(value == 'Yokohama'){
              var ll = '35.443708,139.638026';
            }else if(value == 'Kyoto'){
              var ll = '35.02107,135.75385';
            }else if(value == 'Osaka'){
              var ll = '34.690469,135.511293';
            }else if(value == 'Sapporo'){
              var ll = '43.06417,141.34695';
            }else if(value == 'Nagoya'){
              var ll = '35.1814464,136.90639799999997';
            }

            

            $.ajax({

                url: "https://api.foursquare.com/v3/places/search?ll="+ll,//api request for places api in Foursquare
                type: "GET",
                headers: {
                   Accept: 'application/json',
                   Authorization: 'fsq3rd1jOsSbxQPX5CQnFE8Q971u7EW4bsjl4LR/R0VpF74='
                },
 
                success: function(data) {
                  console.log(data);
                  setTimeout(function(){//settimeout for 2sec
                    $("#places_to_visit").html("");//empty current table 

                    $('.hide-card1').show();
                    $('#latitude').text(data.context.geo_bounds.circle.center.latitude);
                    $('#longitude').text(data.context.geo_bounds.circle.center.longitude);

                    //foreach function for each response in json format
                    $.each(data.results, function(k, v) {
                      if(v.location.address == null){
                        var address = value;
                      }else{
                        var address = v.location.address + ', ' + value;
                      }
                      
                        $('#places_to_visit').append(
                            "<tr>"+
                                "<td>"+address+"</td>"+
                                "<td>"+v.name+"</td>"+
                                "<td>"+v.categories[0].name+"</td>"+
                            "</tr>");
                    });


                  }, 2000);
                 
                  
                }

            });




         }

         


      });
    });
</script>