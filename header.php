<?php
echo "
<!Doctype html>
<meta charset='UTF-8'>
<head>
<style>

	
    body{
        background-color:#f1f1f1;
        padding:0;
        margin:0;
        overflow-x:hidden;
        font-size:20px;
    }
    header{
        background-color:#fff;
        padding:10px;
        box-shadow:0 0 3px #000;
        position: fixed;
        width:99%;
        text-align:center;
    }

    header li
    {
        display: inline;
        padding-left:25px;
    }
    header li a
    {
        color:#333;
        text-decoration:none;
        padding:13px;
        transition: .3s ease;
    }

    header li a:hover
    {
        color:royalblue;
        text-decoration:underline;
        padding:13px;
    }

    .logout
    {
        color:#fff;
        background-color:red;
        border-radius:30px;
        float:right;
        position: relative;
        top:-15px;
    }

    .logout:hover
    {
        color:#fff;
        background-color:darkred;
        border-radius:30px;
        float:right;
        position: relative;
        top:-14px;
        text-decoration: none;
    }
	
	header li a:hover {
		color: red;
		background-color: transparent;
		text-decoration: underline;
		cursor: pointer;
	    font-size:1.23em;
}

</style>
</head>
<header>
<ul>
<span style='float:left;'>Angemeldet als: "?>
<?php 


if ($_SESSION["Logstatus"]) {
    echo $_SESSION["Username"];
}
else
{
			if(! headers_sent() ){
        header("Location:logout.php");
		}else{
			echo '<script type="text\javascript">
			window.location.href="logout.php";</script>';
		}
		
    }
echo " </span>	 	 
<span  style='font-size: 20px;color: #ff9933;'>© Copyright 2024 - Learnforschool - Alle Rechte Vorbehalten&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
<li><a class='logout' href='//"; echo $_SERVER['SERVER_NAME']; echo"/logout.php'> Abmelden</a></li></br>

     <li><a style='color: #101d00' href='//"; echo $_SERVER['SERVER_NAME']; echo"/start.php'>Startseite</a></li>
	 <li><a style='color: #004d00' href='//"; echo $_SERVER['SERVER_NAME']; echo"/aufgaben.php'>Aufgabenübersicht</a></li>
	 <li><a style='color: #3AA16A' href='//"; echo $_SERVER['SERVER_NAME']; echo"/rechtliches/Impressum.php'>Impressum</a></li>
	 <li><a style='color: #3AA16A' href='//"; echo $_SERVER['SERVER_NAME']; echo"/rechtliches/Datenschutz.php'>Datenschutzerklärung</a></li>
	 <li><a style='color: darkred;' href='//"; echo $_SERVER['SERVER_NAME']; echo"/accdestroy.php'>Account löschen</a></li>


</ul>

</header>
</br></br></br></br></br></br>
"?>