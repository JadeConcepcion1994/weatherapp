<template>
    <div>
       
       <div class="jumbotron j1">
        <div style="background-color: transparent;" class="jumbotron">
            <!-- <h1 align="center">Hello, Welcome to Japan!</h1>
            <h1 align="center">LAND OF THE RISING SUN</h1><br> -->
            <h1 align="center">WANT TO VISIT A CITY?</h1><br>
            <center><a href="/weather" style="color: white;" class="btn btn-outline-success btn-lg">Check the Weather <i class="fa fa-arrow-right" aria-hidden="true"></i></a></center>
        </div>
        
           
       </div>



       <!--Popup Modal-->
       <div class="modal" tabindex="-1" role="dialog" id="welcomeModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Welcome!</h5>
              </div>
              <div class="modal-body">
                <p>This is your <span class="tgi">Travel Guide Information</span> in <b class="jpn">Japan!</b></p>
                <br>
                <button style="float: right" type="button" class="btn btn-success" data-dismiss="modal">Continue <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
              </div>
            </div>
          </div>
        </div>


    </div>

</template>

<script>
    $(document).ready(function(){

        $('#welcomeModal').modal({
            backdrop: 'static',
            keyboard: false
        });

    });
</script>
