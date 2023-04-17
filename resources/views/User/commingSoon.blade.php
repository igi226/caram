<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Caramia</title>

    <style>

        /* Set height to 100% for body and html to enable the background image to cover the whole page: */

body, html {

  height: 100%

}



.bgimg {

  /* Background image */

  /* background-image: url(../forestbridge.jpg); */

  /* Full-screen */

  height: 100%;

  /* Center the background image */

  background-position: center;

  /* Scale and zoom in the image */

  background-size: cover;

  /* Add position: relative to enable absolutely positioned elements inside the image (place text) */

  position: relative;

  /* Add a white text color to all elements inside the .bgimg container */

  color: white;

  /* Add a font */

  font-family: "Courier New", Courier, monospace;

  /* Set the font-size to 25 pixels */

  font-size: 25px;

}



/* Position text in the top-left corner */

.topleft {

  position: absolute;

  top: 0;

  left: 16px;

}



/* Position text in the bottom-left corner */

.bottomleft {

  position: absolute;

  bottom: 0;

  left: 16px;

}



/* Position text in the middle */

.middle {

  position: absolute;

  top: 50%;

  left: 50%;

  transform: translate(-50%, -50%);

  text-align: center;

}



/* Style the <hr> element */

hr {

  margin: auto;

  width: 40%;

}

    </style>

</head>

<body>

    <div class="bgimg" style="background-image:url({{url('/forestbridge.jpg')}})">

        <div class="topleft">

            <img src="{{ asset('storage/SiteImages/16657332696982.png') }}" alt="" height="40">

        </div>

        <div class="middle">

          <h1>COMING SOON</h1>

          <hr>

          <p id="demo">Thanks for Visiting</p>

        </div>

        {{-- <div class="bottomleft">

          <p>Some text</p>

        </div> --}}

      </div>



      <script>

        // Set the date we're counting down to

var countDownDate = new Date("Dec 5, 2022 15:37:25").getTime();



// Update the count down every 1 second

var x = setInterval(function() {



  // Get todays date and time

  var now = new Date().getTime();



  // Find the distance between now an the count down date

  var distance = countDownDate - now;



  // Time calculations for days, hours, minutes and seconds

  var days = Math.floor(distance / (1000 * 60 * 60 * 24));

  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

  var seconds = Math.floor((distance % (1000 * 60)) / 1000);



  // Display the result in an element with id="demo"

  document.getElementById("demo").innerHTML = days + "d " + hours + "h "

  + minutes + "m " + seconds + "s ";



  // If the count down is finished, write some text

  if (distance < 0) {

    clearInterval(x);

    document.getElementById("demo").innerHTML = "EXPIRED";

  }

}, 3000);

      </script>

</body>

</html>