<html>

<head>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=KrEQqVp2"></script>

   <style>
    body{
        font-family: 'Be Vietnam';
    }
    .nav-wrapper{
        background-image: linear-gradient(to bottom right,#23416b,#b04276);
        padding: 0px, 10px;
    }
    .card{
        margin: 20px;
    }
    .btn{
        background-image: linear-gradient(to bottom right,#23416b,#b04276);
    }
 </style>
</head>

<script>
    function mySpeech() {
        var speak = document.getElementById("ttsmessage").value;
        responsiveVoice.speak(speak);
    }
</script>


<body>

<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">NoteSync</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="./index.php">Home</a></li>
        <li><a href="./userdocs.php">Your Docs</a></li>
        <li><a style="float:right" href="#">Login</a></li>
      </ul>
    </div>
</nav>

<div class="row">
    <div class="col s12 m6 l4">
      <div class="card hoverable">
        <div class="card-content white-text">
          <span class="card-title black-text">OCR</span>
          <p class="black-text">I am a very simple card. I am good at containing small bits of information.
          I am convenient because I require little markup to use effectively.</p>
        </div>
        <div class="card-action">
          <a class="btn" href="ocr.php">Try it out!</a>
        </div>
      </div>
    </div>
   
    <div class="col s12 m6 l4">
      <div class="card hoverable">
        <div class="card-content white-text">
          <span class="card-title black-text">Notes Aloud</span>
          <p class="black-text">I am a very simple card. I am good at containing small bits of information.
          I am convenient because I require little markup to use effectively.</p>
        </div>
        <div class="card-action">
            <a class="btn" href="#">Try it out!</a>
        </div>
      </div>
    </div>

    <div class="col s12 m6 l4">
      <div class="card hoverable">
        <div class="card-content white-text">
          <span class="card-title black-text">Get Wiki Links</span>
          <p class="black-text">I am a very simple card. I am good at containing small bits of information.
          I am convenient because I require little markup to use effectively.</p>
        </div>
        <div class="card-action">
          <a class="btn" href="#">Try it out!</a>
        </div>
      </div>
    </div>
  </div>
    <!-- <form><input type="text" value="Message" name="message" id="ttsmessage"><br><br>
    <input type="button" value="Audio" onclick="mySpeech()"></form> -->
</body>

</html>