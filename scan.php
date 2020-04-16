<?php 
session_start();
include('header.php');
include_once("db_connect.php");

if (empty($_SESSION['user_id'])){
header("Location: login.php");
}
?>


<?php if ((isset($_SESSION['user_id']) )) { ?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
  <link rel="stylesheet" href="css/style.css">
</head>
    <p><strong>Welcome!</strong> You are logged in as <strong><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></strong></p>
    

    <link rel="canonical" href="https://serratus.github.io/v1.0.0-beta.1/examples/scan-to-input/" />
    <link rel="stylesheet" href="https://serratus.github.io/quaggaJS/stylesheets/styles.css">
    <link rel="stylesheet" href="https://serratus.github.io/quaggaJS/stylesheets/example.css">
    <link rel="stylesheet" href="https://serratus.github.io/quaggaJS/stylesheets/pygment_trac.css">

    <script>
        var host = "serratus.github.io";
        if ((host == window.location.host) && (window.location.protocol != "https:")) {
            window.location.protocol = "https";
        }
    </script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-56318310-1', 'auto');
      ga('send', 'pageview');

    </script>
  </head>
  <body>


<link rel="stylesheet" type="text/css" href="https://serratus.github.io/quaggaJS/stylesheets/prism.css" />
<section id="container" class="container">
    <h3>Scan barcode to input-field</h3>
    <p>Click the <strong>button</strong> next to the input-field
        to start scanning a <strong>barcode</strong> </p>
    <div>
        <form>
            <div class="input-field">
                <label for="isbn_input">EAN:</label>
                <input id="isbn_input" class="isbn" type="text" />
                <button type="button" class="icon-barcode button scan">&nbsp;</button>
            </div>
        </form>
    </div>
    </p>


<script src="script/quagga.js" type="text/javascript"></script>
<script src="script/index.js" type="text/javascript"></script>
<script src="script/prism.js"></script>


      </section>
      <footer>
      </footer>
    </div>
  </body>
    
<br /><br />
    <p align="center">
    Click <a href="logout.php">here</a> to logout
    </p>
    

 <?php } ?>