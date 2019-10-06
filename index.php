<html>
<?php session_start();?>
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
        padding: 0px, 20px;

    }
    .card{
        margin: 20px;
        margin-top:20%;
    
    }
    .btn{
        background-image: linear-gradient(to bottom right,#23416b,#b04276);
    }
       h1{
           font-family:georgia;
           text-align:center;
           
       }
       h2{
           font-size: 30px;
           text-align: center;
       }
       
 </style>
</head>



<body>

<nav>
    <div class="nav-wrapper">
        
        <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="./index.php">Home</a></li>
        <li><a href="./userdocs.php">Your Docs</a></li>
        <li><a style="float:right" href=<?php if(isset($_SESSION['userid'])) echo "./logout.php"; else echo "./signup.php";?>><?php if(isset($_SESSION['userid'])) echo "Logout"; else echo "Login";?></a></li>
      </ul>
    </div>
</nav>

    <h1>
    NoteSync</h1>
    <h2>Convert your notes from analog to digital!</h2>
<div class="row">
    <div class="col s12 m6 l4">
      <div class="card hoverable">
        <div class="card-content white-text">
          <span class="card-title black-text">OCR</span>
          <p class="black-text">Convert your notes,images to text here!</p>
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
          <p class="black-text">Convert your text to speech!</p>
        </div>
        <div class="card-action">
            <a class="btn" href="tts.php">Try it out!</a>
        </div>
      </div>
    </div>

    <div class="col s12 m6 l4">
      <div class="card hoverable">
        <div class="card-content white-text">
          <span class="card-title black-text">Get Wiki Links</span>
          <p class="black-text">Wiki links for all imp notes</p>
        </div>
        <div class="card-action">
          <a class="btn" href="natlang.php">Try it out!</a>
        </div>
      </div>
    </div>
  </div>
    <!-- <form><input type="text" value="Message" name="message" id="ttsmessage"><br><br>
    <input type="button" value="Audio" onclick="mySpeech()"></form> -->
</body>

</html>
