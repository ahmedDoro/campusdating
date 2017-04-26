<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="../css/viewprofilestyle.css" type="text/css" rel="stylesheet">
    <title>Manage photos</title>
</head>
<body>
    <div class="container-fluid header">
        <nav class="navbar">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">
                    <fieldset>
                        <p class="logo">C</p><p>ampus</p><p class="logo">D</p><p>ate</p>
                    </fieldset>
                </a>
            </div>
        </nav><br /><br />
    </div>
        </nav><br /><br />
    </div>
	
    <div class="container main">
        <div class="row">
            <div class="col-pics col-sm-3">
                <div class="photos">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      
            <div id="formdiv">
                <h2>Upload multiple photos</h2>
                <form enctype="multipart/form-data" action="" method="post">
                   Upload 5 photos max
                    <hr/>
                    <div id="filediv"><input name="file[]" type="file" id="file"/></div><br/>
           
                    <input class="input" type="button" id="add_more" class="upload" value="Add More images"/>
                    <input class="submit"type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
                </form>
                <br/>
                <br/>
				
                <?php include "upload.php"; ?>
            </div>
           
		  
            </div>
                <div class="row button">
                   
                </div>
            </div>
            <div class="info col-sm-4">
                <div class="aboutme">
                    <p><br /></p>
				 <p><br /></p>
				  <p><br /></p>
				   <p><br /></p>
                </div>
            </div>
            <div class="info col-sm-5">
               
            </div>
        </div>
    </div>
	</div>
	</div>
		
   <footer>
        <div class="row footer-row">
            <div class="footer-col1 col-sm-4">
                <h3>About us</h3>
                <p><a class="footer-a" href="#">About the authors</a></p>
                <p><a class="footer-a" href="#">About the webpage</a></p>
                <p><a class="footer-a" href="#">Our vision</a></p>
                <p><a class="footer-a" href="#">Testimonials</a></p>
                <p><a class="footer-a" href="#">Contact us</a></p>
            </div>
            <div class="footer-col2 col-sm-4">
                <h3>Terms and conditions</h3>
                <p><a class="footer-a" href="#">Terms of use</a></p>
                <p><a class="footer-a" href="#">About cookies and cookie policy</a></p>
                <p><a class="footer-a" href="#">Data protection</a></p>
                <p><a class="footer-a" href="#">Privacy policy</a></p>
                <p><a class="footer-a" href="#">Copy rights</a></p>
            </div>
            <div class="footer-col3 col-sm-4">
                <h3>Something else</h3>
            </div>
        </div>
    </footer>
</body>
</html>