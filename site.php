<!--Jack Akers -->
<!--Using POST becuase it is harder to hack. The reason for this is becuase its not cashed, not saved in browser history and sends its variables hidden to the user. As it is since I am not sanitizing user input the site is vulnerable to sql injection, cross site scripting, and other vulnerabilities. As the site is currently any code written as an input will be ran which is a huge security vulnerability. So just to make it a bit safer I use POST  -->
<!DOCTYPE html>
<html> 
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./bootstrap-4.4.1-dist/css/bootstrap.css">
	<link rel="stylesheet" href="./bootstrap-4.4.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="./bootstrap-4.4.1-dist/css/bootstrap.grid.css">
	<link rel="stylesheet" href="./bootstrap-4.4.1-dist/css/bootstrap-reboot.css">
	<link rel="stylesheet" href="./bootstrap-4.4.1-dist/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="./bootstrap-4.4.1-dist/css/bootstrap-grid.min.css">
</head>
<body>
    <!-- Top Nav Bar-->
	<nav class = "navbar navbar-expand-lg navbar-dark bg-dark bg-dark">
		<ul class="navbar-nav mr-audio">
			<li class="nav-item active">
				<a class = "nav-link" style="color:white;"href="#">Movie Log</a>
			</li>
			<li class="nav-item">
				<a class = "nav-link" href="#">Add Movie</a>
			</li>
			<li class="nav-item">
				<a class = "nav-link" href="#">Movies Watched</a>
			</li>
		</ul>
	</nav>
    <!-- Input / Form -->
	<div class="d-flex flex-column align-items-center">
		<h1>Add Movie Log</h1>
		<form class="col-lg-4" action="site.php" action="site.php" method="post"> 
		<div class="form-group row">
        <label for="MovieName" class="col-sm-5 col-form-label">Movie Name <span class="Required">*</span></label>
        <div >
        	<input type="text" class="form-control" id="MovieName" name="MovieName">
        </div>
    	</div>
    	<div class="form-group row">
        <label for="DirectorsName" class="col-sm-5 col-form-label">Directors Name <span class="Required">*</span></label>
        <div>
        	<input type="text" class="form-control" id="DirectorsName" name="DirectorsName">
        </div>
    	</div>
    	<div class="form-group row">
        <label for="Artists" class="col-sm-5 col-form-label ">Artists (comma sep.)</label>
        <div>
        	<input type="text" class="form-control" id="Artists" name="Artists">
        </div>
    	</div>
    	<div class="form-group row">
        <label for="Genre" class="col-sm-5 col-form-label">Genre</label>
        <div class="" name="Genre">
        	<select class="custom-select  form-control form-control-lg" id="select" value="Genre" name="Genre">
        		<option selected>Action</option>
        		<option value="First Genre">First Genre</option>
        		<option value="Second Genre">Second Genre</option>
        		<option value="Third Genre">Third Genre</option>
      		</select>
        </div>
    	</div>
        <div class="form-group row">
            <label class="col-sm-2">Rating<span class="Required">*</span></label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">4</label>
                </div>
                 <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">5</label>
                </div>
            </div>
        </div>

        <!--Buttons-->
        <input type="submit" class="btn btn-primary" value="Submit" name="Write">
        <input type="submit" class="btn btn-primary" value="Read" name="Read">
        <input type="submit" class="btn btn-primary" value="Clear" name="Clear">

    </form>

    <!--Inline PHP not really enough to justify another file-->
    <?php

    $file="test.txt";
    $OtherFunction = 0; //Testing to see if other buttons have been pushed in order to not bring up error.

    //Clear the text file 
    function ClearFile(string $file){
        $File = fopen("test.txt","w");
        $open = ($file);
        fclose($File);
        $OtherFunction = 1;
        return ($OtherFunction);
    }
    if(isset($_POST["Clear"])){
        $OtherFunction = ClearFile($file);
        echo("Cleared");
    }

    //Read File 
    function readFromFile(string $file):string{
        $File=fopen("test.txt",'r');
        if(filesize($file) > 0){
            return(fread($File,filesize("test.txt")));
        }else{
            return("Nothing written to file.");
        }
        fclose($file);
    }
    if(isset($_POST["Read"])){
        $OtherFunction = 1;
            print (readFromFile($file));
    }

    //Write to file
    function writeToFile(string $file, string $content){
        $test = fopen("test.txt","a+");
        $open=($file);
        fwrite($test,$content);
        fclose($test);
    }
    if(!empty($_POST["MovieName"]) && !empty($_POST["DirectorsName"]) && !empty($_POST["inlineRadioOptions"])) { 
        writeToFile($file,"Movie Name: ");
        writeToFile($file,$_POST["MovieName"]);
        writeToFile($file,"<br>");
        writeToFile($file,"\n");
        writeToFile($file,"Directors Name: ");
        writeToFile($file,$_POST["DirectorsName"]);
        writeToFile($file,"<br>");
        writeToFile($file,"\n");
        writeToFile($file,"Artists: ");
        writeToFile($file,$_POST["Artists"]);
        writeToFile($file,"<br>");
        writeToFile($file,"\n");
        writeToFile($file,"Genre: ");
        writeToFile($file,$_POST["Genre"]);
        writeToFile($file,"<br>");
        writeToFile($file,"\n");
        writeToFile($file,"Rating: ");
        writeToFile($file,$_POST["inlineRadioOptions"]);
        writeToFile($file,"<br>");
        writeToFile($file,"\n");
    }elseif ($OtherFunction == 0) {
        echo('<span class="Required">Please fill out all fields!</span>'); //Using similar concept to Cross Site Scripting or SQL injection to run HTML code.
    }

    ?>
<!--Inline styling not enough to justify another file-->
<style>
    .Required{
        color:Red;
    }
</style>

</body>
</html>