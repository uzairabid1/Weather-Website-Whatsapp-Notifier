
//Getting all the elements
const timeEl = document.getElementById("time");
const dateEl = document.getElementById("date");
const currentWeaterItemsEl = document.getElementById("current-weather-items");
const timezoneEl = document.getElementById("time-zone");
const countryEl = document.getElementById("country");
const weatherForecastEl = document.getElementById("weather-forecast");
const currentTemmpEl = document.getElementById("current-temp");
const phonenumber_check=document.getElementById("phoneId");
const search_temp = document.getElementById("search-temp");
//date and time
const days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
const months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
let el=document.getElementById("search-day");
el.style.visibility="hidden"
let name_bar=document.getElementById("Name-bar");
let phno_bar=document.getElementById("phno-bar");
let form_srchbtn=document.getElementById("form-search-btn");
let form_sendbtn=document.getElementById("form-send-btn");
name_bar.style.visibility="hidden";
phno_bar.style.visibility="hidden";
form_srchbtn.style.visibility="hidden";
form_sendbtn.style.visibility="hidden";

setInterval(()=> {
const time = new Date();
const month = time.getMonth();
const day = time.getDay();
const date = time.getDate();
const hour = time.getHours();
const hoursIn12HrFormat = hour >= 13?hour%12: hour;

const minutes = time.getMinutes();
const ampm = hour>=12 ? 'PM' : 'AM';
if(minutes < 10){
    timeEl.innerHTML = hoursIn12HrFormat + ":" +"0" + minutes + " " + `<span id="span-time">${ampm}</span>`;
}
else{
    timeEl.innerHTML = hoursIn12HrFormat + ":" + minutes +" "+ `<span id="span-time">${ampm}</span>`;
}
dateEl.innerHTML = days[day] + ", " + date +" " + months[month];
},1000);


//API work
const API = 'cfcade31d0f35fa2d1db13ad675f5746';

function getSearchData(){
    let el=document.getElementById("search-day");
  el.style.visibility="visible"
let search = document.getElementById("search");
fetch(`https://api.openweathermap.org/data/2.5/weather?q=${search.value}&units=metric&appid=${API}`).then(res=>res.json()).then(data =>{
    console.log(data);
    showSearchData(data);
});
}

function showSearchData(data){
  search_temp.style.opacity = '0';
search_temp.style.transition = "opacity 0.6s ease-out"
setInterval(() => {
  search_temp.style.opacity = 1;
}, 1500);
search_temp.innerHTML = `<div class="search-day" id="search-temp">
<img src="http://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png" alt="weather icon" class="2-icon">
<div class="other">
    <div class="day">Today</div>
    <div class="temp">Night - ${data.main.temp_min}&#8451;</div>
    <div class="temp">Day - ${data.main.temp_max}&#8451;</div>
</div>
</div>`
}

function getWeatherData(){
    navigator.geolocation.getCurrentPosition((success)=>{
        let {latitude,longitude} = success.coords;
        fetch(`https://api.openweathermap.org/data/2.5/onecall?lat=${latitude}&lon=${longitude}&exclude=hourly,minutely&units=metric&appid=${API}`).then(res => res.json()).then(data=> {
           showWeatherData(data);                   
        });  
    });  
}

function showWeatherData(data){
  let {humidity,pressure,sunrise,sunset,wind_speed} = data.current;
  // timezoneEl.innerHTML = data.timezone;
  countryEl.innerHTML = data.lat + 'N    ' +  + data.lon + ' E ';
  currentWeaterItemsEl.innerHTML = `<div class="weather-item">
  <div>Humidity</div>
  <div>${humidity}%</div>
  </div>
  <div class="weather-item">
  <div>Pressure</div>
  <div>${pressure}</div> 
  </div>
  <div class="weather-item">
  <div>Wind speed</div>
  <div>${wind_speed}</div>
  </div>
  <div class="weather-item">
  <div>Sunrise</div>
  <div>${window.moment(sunrise*1000).format("hh:mm a")}</div>
  </div>
  <div class="weather-item">
  <div>Sunset</div>
  <div>${window.moment(sunset*1000).format("hh:mm a")}</div>
  </div>`
  
  let otherDayForecast = ' ';
  data.daily.forEach((day,idx) => {
      if(idx==0){
       currentTemmpEl.innerHTML = `<div class="today" id="current-temp">
       <img src="http://openweathermap.org/img/wn//${day.weather[0].icon}@2x.png" alt="weather icon" class="2-icon">
       <div class="other">
           <div class="day">Today</div>
           <div class="temp">Night - ${day.temp.night}&#8451;</div>
           <div class="temp">Day - ${day.temp.day}&#8451;</div>
       </div>
   </div>`
      }else{
      otherDayForecast += `<div class="weather-forecast-item">
      <div class="day">${window.moment(day.dt*1000).format('ddd')}</div>
      <img src="http://openweathermap.org/img/wn/${day.weather[0].icon}@2x.png" alt="weather icon" class="2-icon">
      <div class="temp">Night - ${day.temp.night}&#8451;</div>
      <div class="temp">Day - ${day.temp.day}&#8451;</div>
      </div>`    
      }   
  });
  
  weatherForecastEl.innerHTML = otherDayForecast;
  }
function whatsapplinkupd(){
    let name_bar=document.getElementById("Name-bar");
    let phno_bar=document.getElementById("phno-bar");
    let form_srchbtn=document.getElementById("form-search-btn");
    let form_sendbtn=document.getElementById("form-send-btn");
    name_bar.style.visibility="visible"
    phno_bar.style.visibility="visible"
    form_srchbtn.style.visibility="visible"   
}
function phonenumber(inputtxt)
{
  var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
  if(inputtxt.value.match(phoneno))
     {
	   return true;      
	 }
   else
     {
	   alert("Not a valid Phone Number");
	   return false;
     }
}
getWeatherData();



function validatename(){
      var name=document.forms['myform']['name'];
      var letters=/^[a-zA-Z\s]*$/;
      if(name.value==""){
        document.getElementById("name-status").style.visibility="visible";
        document.getElementById("name-status").style.color="red";
        document.getElementById("name-status").innerHTML="Name cant be null";
        return false;
      }
      else if(!name.value.match(letters)){
        document.getElementById("name-status").style.visibility="visible";
        document.getElementById("name-status").style.color="red";
        document.getElementById("name-status").innerHTML="Cant input numbers";
        return false;
      }
      else{
        document.getElementById("name-status").style.visibility="visible";
        document.getElementById("name-status").style.color="green";
        document.getElementById("name-status").innerHTML="valid";
        return true;
      }
    }
     

function validatephone(){
    var check=document.getElementById("phoneId").value;
    var regex=/^(\+92|0|92)[0-9]{10}$/;
    var check_zero=check[0];
    if(check.value=="")
    {
      document.getElementById("phno-status").style.visibility="visible";
      document.getElementById("phno-status").style.color="red";
      document.getElementById("phno-status").innerHTML="Phone No cannot be null";
      return false;

    }
  
     if(check_zero=='0'){
      document.getElementById("phno-status").style.visibility="visible";
      document.getElementById("phno-status").style.color="red";
      document.getElementById("phno-status").innerHTML="number starts with +92";
      return false;
    }
    if(regex.test(check)){
        document.getElementById("phno-status").style.visibility="visible";
        document.getElementById("phno-status").style.color="green";
        document.getElementById("phno-status").innerHTML="valid";
        return true;
    }
    else{
        document.getElementById("phno-status").style.visibility="visible";
        document.getElementById("phno-status").style.color="red";
        document.getElementById("phno-status").innerHTML="invalid";
        return false;
    }
    
}
function checkvalidation(){
    if(validatename()==true&&validatephone()==true){
        form_sendbtn.style.visibility = "visible";
    }
    else{
      form_sendbtn.style.visibility = "hidden";
    }
}