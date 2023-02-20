<?php
if (!$conn) {
    header("Location: ../index.html");
}
?>
<style>

      .mySlides {
        display: none
      }
      img {
        vertical-align: middle;
        border-radius: 5px 5px 5px 5px;
      }

      .slideshow-container {

        position: relative;
        margin: auto;
      }
      /* Next & previous buttons */
      .prev,
      .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        /*margin-top: -22px;*/
        margin-top: -45px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 3px 3px 3px 3px;
        user-select: none;
      }
      /* Position the "next button" to the right */
      .next {
        right: 0;
        border-radius: 3px 3px 3px 3px;
        
      }
      .prev {
        left: 0;
        border-radius: 3px 3px 3px 3px;
      }
      /* On hover, add a black background color with a little bit see-through */
      .prev:hover,
      .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
      }
      /* Caption text */
      .text {
        color: #ffffff;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
      }
      /* Number text (1/3 etc) */
      .numbertext {
        color: #ffffff;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
      }
      /* The dots/bullets/indicators */
      .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #999999;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
      }
      .active,
      .dot:hover {
        background-color: #111111;
      }
      /* Fading animation */
      .fade {
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
        animation-duration: 1.5s;
      }
      @-webkit-keyframes fade {
        from {
          opacity: .4
        }
        to {
          opacity: 1
        }
      }
      @keyframes fade {
        from {
          opacity: .4
        }
        to {
          opacity: 1
        }
      }
      /* On smaller screens, decrease text size */
      @media only screen and (max-width: 300px) {
        .prev,
        .next,
        .text {
          font-size: 11px
        }
      }
    </style>

    <div class="slideshow-container">
    <?php 
        $num_slide = 0;
        $result = $conn->query("SELECT * FROM lezione");
        while($lezione =  $result->fetch_assoc()){
            $num_slide++;
            ?>
            <div class="mySlides fade" >
        
        <img src="<?php echo $lezione['presentazione'];?>" style="width:100%; height: 250px;" 
        onclick=location.href="corso-<?php echo $lezione['corso_lez']?>.html" alt="<?php echo $lezione['titolo'];?>">
      </div>
            
            <?php 
            if($num_slide == 3){
                break;
            }
        }
        ?>
            <?php 
        $result2 = $conn->query("SELECT * FROM esercizio");
        while($esercizio =  $result2->fetch_assoc()){
            $num_slide++;
            ?>
            <div class="mySlides fade">
        <img src="<?php echo $esercizio['traccia'];?>" style="width:100%; height: 250px" 
        onclick=location.href="corso-<?php echo $esercizio['corso_ex']?>.html">
      </div>
            
            <?php 
            if($num_slide == 6){
                break;
            }
        }
        ?>
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
   
    <br>
    <div style="text-align:center">
    	<?php 
    	$stop;
    	if(($result->num_rows+$result2->num_rows) < 6){
    	    $stop = $result->num_rows+$result2->num_rows;
    	}else{
    	    $stop =  6;
    	}
    	for ($i = 0; $i < $stop; $i++) {
    	  ?>
    	  <span class="dot" onclick="currentSlide(<?php echo $i;?>)"></span>
    	  <?php   
    	}
    	
    	?>
    </div>
    <script>
      let slideIndex = 0;
      let timeoutId = null;
      const slides = document.getElementsByClassName("mySlides");
      const dots = document.getElementsByClassName("dot");
      
      showSlides();
      function currentSlide(index) {
           slideIndex = index;
           showSlides();
      }
     function plusSlides(step) {
        
        if(step < 0) {
            slideIndex -= 2;
            
            if(slideIndex < 0) {
              slideIndex = slides.length - 1;
            }
        }
        
        showSlides();
     }
      function showSlides() {
        for(let i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
          dots[i].classList.remove('active');
        }
        slideIndex++;
        if(slideIndex > slides.length) {
          slideIndex = 1
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].classList.add('active');
         if(timeoutId) {
            clearTimeout(timeoutId);
         }
        timeoutId = setTimeout(showSlides, 5000); // Change image every 5 seconds
      }
    </script>
    

<table style="width: 100%; font-size: 28pt;font-family: cursive;" id="pannello_controllo">
<tr style="height: 100px;"><td><b>Sei uno <font color="green">studente</font>?</b></td></tr>
<tr style="height: 100px"><td><b>Hai bisogno di aiuto con lo <font color="green">studio</font>?</b></tr>
<tr style="height: 100px"><td><b>Acquista i <font color="green">corsi</font> o le <font color="green">lezioni singole</font>,</b></td></tr>
<tr style="height: 100px"><td><b>acquista gli <font color="green">esercizi svolti,</font></b></tr>
<tr style="height: 100px"><td><b>manda i tuoi <font color="green">esercizi svolti</font> da correggere,</b></tr>
<tr style="height: 100px"><td><b>manda le <font color="green">tracce</font> degli esercizi da svolgere.</b></tr>
<tr style="height: 100px"><td><b>Sono sono a tua disposizione,</b></tr>
<tr style="height: 100px"><td><b><font color="green">sempre</font> vicino alle tue esigenze!</b></tr>

</table>         




