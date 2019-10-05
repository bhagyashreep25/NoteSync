<html>

<head>
    <style>
        body {
            margin: 0;
            font-family: Georgia, Helvetica, sans-serif;

        }

        .nav {
            overflow: hidden;
            background-image: linear-gradient(to bottom right, #23416b, #b04276);
        }

        .nav a {

            float: left;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 20px;
            opacity: 0.8;
        }

        .nav a:hover {
            opacity: 1;
        }

        .add {
            margin: 5%;
            margin-left: 28%;
            padding: 30px;
            border: #b04276 solid 2px;
            width: 40%;
        }

        .add input {
            border-radius: 7px;
            width: 250px;
            text-align: center;
            background-color: bisque;
        }

        h1 {
            color: black;
            text-align: center;
            font-size: 50px;
        }
    </style>
</head>

<script>
// Initialising the speech API 
const synth = window.speechSynthesis; 
// Element initialization section 
const form = document.querySelector('form'); 
const textarea = document.getElementById('maintext'); 
const voice_select = document.getElementById('voice-select'); 
 
// Retrieving the different voices and putting them as 
// options in our speech selection section 
let voices = []; 
const getVoice = () => { 
	
	// This method retrieves voices and is asynchronously loaded 
	voices = synth.getVoices(); 
	var option_string = ""; 
	voices.forEach(value => { 
		var option = value.name + ' (' + value.lang + ') '; 
		var newOption = "<option data-name='" + value.name + 
				"' data-lang='" + value.lang + "'>" + option 
				+ "</option>\n"; 
		option_string += newOption; 
	}); 
	
	voice_select.innerHTML = option_string; 
} 
synth.onvoiceschanged = function() { 
	getVoice(); 
}; 
const speak = () => { 
	
	// If the speech mode is on we dont want to load 
	// another speech 
	if(synth.speaking) { 
		alert('Already speaking....'); 
		return; 
	} 
	
	
	if(textarea.value !== '') { 
		
		// Creating an object of SpeechSynthesisUtterance with 
		// the input value that represents a speech request 
		const speakText = new SpeechSynthesisUtterance(textarea.value); 
		// When the speaking is ended this method is fired 
		speakText.onend = e => { 
			console.log('Speaking is done!'); 
		}; 
		
		// When any error occurs this method is fired 
		speakText.error = e=> { 
			console.error('Error occured...'); 
		}; 
		// Selecting the voice for the speech from the selection DOM 
		const id = voice_select.selectedIndex; 
		const selectedVoice = 
			voice_select.selectedOptions[0].getAttribute('data-name'); 
	
		// Checking which voices has been chosen from the selection 
		// and setting the voice to the chosen voice 
		voices.forEach(voice => { 
			if(voice.name === selectedVoice) { 
				speakText.voice = voice; 
			} 
		}); 
		// Finally calling the speech function that enables speech 
		synth.speak(speakText); 
	} 
}; 
// This is the section when we assign the speak button, the 
// speech function 
form.addEventListener('submit', evt => { 
	evt.preventDefault(); 
	speak(); 
	textarea.blur(); 
}); 
</script>

<body>
    <h1><i>NoteSync</i></h1>
    <div class="nav">
        <a class="Home" href="#home">Home</a>
        <a class="Docs" href="#docs">YourDocs</a>
        <a class="about">About</a>
        <a class="Scan" href="#scan">Sign up</a>


    </div>
    <div class="add">
        <form action="" method="post" enctype="multipart/form-data">
            <center>
                Add the image here:<br>
                <br><input type="file" name="ocrfile" id="ocrfile">
                <br><br>

                <input type="submit" value="Upload" name="submit" formaction="cloud.php">
                <br><br>
                <input type="download" value="Download text file" name="download">
                <br><br>
                <input type="covert" value="Covert to pdf" name="convert">
                <br><br>
                <input type="text" value="Message" name="message" id="message">
                <br><br> <input type="button" value="Audio">
            </center>

        </form>

    </div>
</body>

</html>