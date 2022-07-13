<html>
<body>
<?php
require_once 'F:\xampp\htdocs\Project\connectionClass.php'
?>

<!DOCTYPE html>
<html lang="en">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap');
        </style>
<head>
  <link rel="icon" href="favicon.ico" type="image/ico">
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Today</title>
    <link rel="stylesheet" href="main.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <script src=https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js integrity=”sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q” crossorigin=”anonymous”></script>

<script src=”https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js” integrity=”sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl” crossorigin=”anonymous”></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment-with-locales.min.js" integrity="sha512-vFABRuf5oGUaztndx4KoAEUVQnOvAIFs59y4tO0DILGWhQiFnFHiR+ZJfxLDyJlXgeut9Z07Svuvm+1Jv89w5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<script type="module">

</script>
<body>
    <div class="container">
        <!-- Button trigger modal -->  

        <div class="current-info">
            <div class="date_container">
               <div class="time" id="time">
                    12:30 <span id="span-time">PM</span>
                </div>
                 <div class="date" id="date">
                 Wednesday,1 june
                </div>
                <div class="others" id="current-weather-items">

            </div>
        </div>        
            <div class="place_container">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Get Notified
                  </button>
                  
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Get Weather Updates on Whatsapp</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form id ="form" name="myform" method="POST">
                                <div class="form-group">
                                  <div class="whatsapp-link" id="whatsapp-link">
                                    <label for="whatsapp-link">Join Chat with twilio:
                                      <a onclick=" whatsapplinkupd()" href="https://api.whatsapp.com/send/?phone=%2B14155238886&text=join+stared-practical&app_absent=0" target="_blank">  Join Now</a>
                                    </label>
                                      </div>
                                  
                                  <div id="Name-bar"><label id="Name-label" for="exampleInputEmail1">Name</label>
                                  <input id="nameId" name = "name" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter your name">
                                  <br>
                                  <label  id="name-status" style="color:red;visibility: hidden;">Invalid Name</label><br>
                                  <small id="emailHelp" class="form-text text-muted">We'll never share your details with anyone else.</small>

                                  </div>
                                <div id="phno-bar">
                                  <label  id="phno-label" for="exampleInputPassword1">Phone Number</label>
                                  <input id="phoneId" name="phone" type="text" class="form-control"  placeholder="+92xxxxxxxxxx"><br>
                                  <label  id="phno-status" style="color:red;visibility: hidden;">Invalid Phone</label>
                                  <br>
                                </div>
                                <button id="form-search-btn" onclick = "checkvalidation()" type="button" class="btn btn-outline-primary">validate</button>
                                <button id="form-send-btn" name="submit" type="submit" class="btn btn-outline-primary">submit</button>
                                </div>
                              </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        
                        </div>
                      </div>
                    </div>
                  </div>
            <div class="time-zone" id="time_zone">ASIA/Karachi</div>
            <div id="country" class="country">PK</div>
            <div class="input-group">
                <input id="search" type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                <button onclick = "getSearchData()" type="button" class="search-btn">search</button> 
              </div>
               <div class="search-day" id="search-day">
              <div class="search-day" id="search-temp">               
                <div class="other">
                    <div class="day">Today</div>
                    <div class="temp">Night - 25.6&#8451;</div>
                    <div class="temp">Day - 25.6&#8451;</div>
                </div>
            </div>
            </div>
             </div>
       </div>
    </div>
    <div class="future-forecast">
        <div class="today" id="current-temp">
            <img src="http://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="2-icon">
            <div class="other">
                <div class="day">Today</div>
                <div class="temp">Night - 25.6&#8451;</div>
                <div class="temp">Day - 25.6&#8451;</div>
            </div>
        </div>
        <div class="weather-forecast" id="weather-forecast">
            <div class="weather-forecast-item">
            <div class="day">Thursday</div>
            <img src="http://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="2-icon">
            <div class="temp">Night - 25.6&#8451;</div>
            <div class="temp">Day - 25.6&#8451;</div>
            </div>
            <div class="weather-forecast-item">
                <div class="day">Friday</div>
                <img src="http://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="2-icon">
                <div class="temp">Night - 25.6&#8451;</div>
                <div class="temp">Day - 25.6&#8451;</div>
                </div>
                <div class="weather-forecast-item">
                    <div class="day">Saturday</div>
                    <img src="http://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="2-icon">
                    <div class="temp">Night - 25.6&#8451;</div>
                    <div class="temp">Day - 25.6&#8451;</div>
                    </div>
                    <div class="weather-forecast-item">
                        <div class="day">Sunday</div>
                        <img src="http://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="2-icon">
                        <div class="temp">Night - 25.6&#8451;</div>
                        <div class="temp">Day - 25.6&#8451;</div>
                        </div>
                        <div class="weather-forecast-item">
                            <div class="day">Monday</div>
                            <img src="http://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="2-icon">
                            <div class="temp">Night - 25.6&#8451;</div>
                            <div class="temp">Day - 25.6&#8451;</div>
                            </div>
        </div>
    </div>     
                
      <div>        
       </div> 
    </body>
    <script src=”https://code.jquery.com/jquery-3.2.1.slim.min.js” integrity=”sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN” crossorigin=”anonymous”></script>
<script src="script.js" <?php echo time(); ?>></script>
<script type="text/javascript">

const imgs = [];
imgs[0] ='bg.jpg';
imgs[1] ='bg2.jpg';
imgs[2] ='bg3.jpg';
imgs[3] ='bg4.jpg';
imgs[4] ='bg5.jpg';
imgs[5] ='bg6.jpg';
imgs[6] ='bg7.jpg';
imgs[7] ='bg8.jpg';
imgs[8] ='bg9.jpg';
  window.onload = function(){
  const random = imgs[Math.floor(Math.random()*imgs.length)];
  document.getElementsByTagName('body')[0].style.backgroundImage = "url('"+ random +"')";
            document.getElementsByTagName('body')[0].style.backgroundRepeat = "no-repeat";
            document.getElementsByTagName('body')[0].style.backgroundSize = "cover";
}
</script>

