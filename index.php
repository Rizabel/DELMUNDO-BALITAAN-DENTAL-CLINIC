<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Del Mundo - Balitaan Dental Clinic</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <main>
      <div class="big-wrapper light">
        <header>
          <div class="container">
            <div class="logo">
              <img src="logo2.png" alt="Logo" />
            </div>

            <div class="links">
              <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#service">Service</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="calendar.php">Make an Appointment</a></li>
                <li><a href="logout.php" class="btn">Log-out</a></li>
              </ul>
            </div>

            <div class="overlay"></div>

            <div class="hamburger-menu">
              <div class="bar"></div>
            </div>
          </div>
        </header>

        <div class="showcase-area">
          <div class="container">
            <div class="left">
              <div class="big-title">
                <h1>May The Floss Be With You.</h1> 
              </div>
              <p class="text">
              Thank you for choosing us for your dental care needs. Our dedicated team is committed to providing you with the highest quality of dental care in a comfortable and welcoming environment.
              </p>
              <div class="cta">
                <a href="calendar.php" class="btn">Make an Appointment</a>
              </div>
            </div>

            <div class="right">
              <img src="bg.jpg" class="bg" />
            </div>
          </div>
        </div>
        <div class="bottom-area">
          <div class="container">
          </div>
        </div>
      </div>
    </main>

    <section class="about" id="service">
        <div class="main">
            <img src="service (2).png" >
        <div class="about-text">
            <h2>Services</h2>
            <h5>Tooth Extraction <small>(Bunot)</small></h5>
            <p> the removal of teeth from the dental alveolus in the alveolar bone. </p>
                <h5>Oral Prophylaxis (Linis)</h5>
            <p>Oral prophylaxis is a thorough examination of your oral health combined with a scale and clean.</p>
                <h5>Tooth Restoration (Pasta)</h5>
            <p>A dental implant is a small post, usually made of titanium, 
                that serves as a substitute for the root of the tooth</p>
                <h5>Orthodontics (Braces)</h5>
            <p>Fillings are special materials that your dentist places on your teeth to repair tooth decay (cavities) 
                or defects on the tooth surface.  </p>
                
        </div>
    </div>
    </section>


    <section class="about" id="about">
        <div class="main">
            <img src="about 1.jpg">
        <div class="about-text">
            <h2>About us</h2>
            <h5>Dental Clinic</h5>
            <p>At Del Mundo - Balitaan Dental Clinic, we pride ourselves on utilizing the latest technology and techniques to ensure that you receive the best possible care. Our experienced and friendly staff is dedicated to addressing your individual needs and concerns.</p>
            <h5>Location</h5>
            <p>141 M.H. del Pilar St., Batangas City, Philippines</p>
            <h5>Contact</h5>
            <p>0917 523 6648</p>
        </div>
    </div>
    </section>

    

    <!-- JavaScript Files -->

    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script src="js/dmbdc.js"></script>
  </body>
</html>