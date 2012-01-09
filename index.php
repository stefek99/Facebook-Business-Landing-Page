<?php 
	require 'facebook.php';
	require 'config_01_promotion.php';

	$facebook = new Facebook(array(
	'appId' => $app_id,
	'secret' => $app_secret,
	'cookie' => true
	));
	
	$signed_request = $facebook->getSignedRequest();
	$like_status = $signed_request["page"]["liked"];
	//$like_status  = 1;
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>

	<meta charset="utf-8">
	<title>EKO FB</title>
	
	<link rel="stylesheet" href="style.css" /> <!-- form styling -->

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> <!-- import jQuery -->
    
	<script type="text/javascript" language="JavaScript"> <!-- like jacking, form, texfields-->
		function clearText(field){
			if (field.defaultValue == field.value) field.value = '';
			else if (field.value == '') field.value = field.defaultValue;
		}
		
		function setColor(color, div) {
			document.getElementById(div.id).style.color=color
		}	

		$(document).ready(function() {
		
		try {
			var img       = $('#like-button'),
			  imgOffset = img.offset(),
			  imgTop    = imgOffset.top,
			  imgLeft   = imgOffset.left,
			  fbframe   = $('#fbframe');
		  
			  img.mousemove(function(event) {
				fbframe.css({
			  top : event.pageY - imgTop - 5,
			  left: event.pageX - imgLeft - 5
				});
			  });

			FB.Event.subscribe('edge.create', function() {
				var fadeOutTime = 1500;
				$("#before-like").fadeOut(fadeOutTime);
				setTimeout(function() {$("#after-like").fadeIn(1000)} , fadeOutTime + 500);
			 });
		} catch (err) {
			//some content might be hidden etc
		}
		 
		 
		$(".toclear").each(function (type) {
			$(this).focus(function () {
				clearText(this);
				setColor('#000', this);
			});
	
			$(this).keypress(function () {

			});
	
			$(this).blur(function () {
				setColor('#ccc', this);
				clearText(this);
			});
		});			 
		 
		$(".greenButton").click(function() { 
				var idea = $("#idea").val(); 
				var email = $("#email").val(); 
				var dataString = 'idea='+ idea + '&email=' + email;
			
				$.ajax({  
				  type: "POST",  
				  url: "send.php",  
				  data: dataString,  
				  success: function() {  
					var fadeOutTime = 1500;
					$("#contact-form").fadeOut(fadeOutTime);
					setTimeout(function() {$("#after-send").fadeIn(1000)} , fadeOutTime + 500);
				  }  
				});  
				return false;  
			});  		 

		});	
	</script>
	
	<style> <!-- positioning -->
	#Table_01 {
		position:absolute;
		left:0px;
		top:0px;
		width:520px;
		height:698px;
	}
	
	#rest {
		position:absolute;
		left:0px;
		top:698px;
		width:520px;
		height:40px;
	}

	#slices-01 {
		position:absolute;
		left:0px;
		top:0px;
		width:520px;
		height:424px;
	}

	#slices-02 {
		position:absolute;
		left:0px;
		top:424px;
		width:520px;
		height:153px;
	}

	#slices-03 {
		position:absolute;
		left:0px;
		top:577px;
		width:520px;
		height:121px;
	}
	
	#slices-02-03, #after-like { /* for contact form and after like*/
		position:absolute;
		left:0px;
		top:424px;
		width:520px;
		height:274px;
	}
	
	/* for displaying message after send */
	
	#slices-02-thanks {
		position:absolute;
		left:0px;
		top:424px;
		width:520px;
		height:153px;
	}

	#slices-03-thanks {
		position:absolute;
		left:0px;
		top:577px;
		width:520px;
		height:121px;
	}
	
	</style>

	<style type="text/css" media="screen"> <!-- like jacking styles -->
        #likejacking { position: relative; }
        #likejacking { cursor: pointer;}
        #fbframe { width: 10px; height: 10px; overflow: hidden; position: absolute; top: 0; left: 0;  opacity:0.0; filter:alpha(opacity=0); /*border:1px solid black;*/}
    </style> 
	
    </head>
    
    <body>

<div id="Table_01">

	<div id="slices-01">
		<img src="images/before-like_01.jpg" width="520" height="424" border="0" alt=""/>
	</div>
	
	<?php
	if ($like_status == 0) {
	?>	
	<div id="before-like">		
		<div id="slices-02">
			<!-- <iframe src="giant-like-promo.html" width="520" height="153" scrolling="no" frameBorder="0"></iframe> -->
						<div id="likejacking">
							<div id="like-button"><img src="images/before-like_02.png" alt="Like us!"/></div>
							
							<div id="fbframe">
							  <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="http://www.facebook.com/EkoUKLtd" show_faces="false" width="450" font=""></fb:like>
							</div>
						</div>
			
		</div>

		<div id="slices-03">
			<img src="images/before-like_03.jpg" width="520" height="121" alt="">
		</div>
	</div> <!-- before like -->
	<div id="after-like" style="display:none">
		
		<form action="" method="post" name="ekofb" id="contact-form">
            <textarea class="styleid float-right height75 toclear" id="idea">We have the know how
			
Get in touch here</textarea>
            
            <input class="styleid narrow-text float-right height32 toclear" type="email" value="your email address here" id="email"/>
            
            <div class="cleaner">&nbsp;</div>
            <input type="submit" value="Make it happen!" class="greenButton narrow-button float-right height32" />
        </form>	
		
		
	</div>
	
	<?php }
	else { //WE ARE LIKERS, WE DISPLAY CONTACT FORM
	?>
	<div id="slices-02-03" >

	    <form action="" method="post" name="ekofb" id="contact-form">
            <textarea class="styleid float-right height75 toclear" id="idea">We have the know how
			
Get in touch here</textarea>
            
            <input class="styleid narrow-text float-right height32 toclear" type="email" value="your email address here" id="email"/>
            
            <div class="cleaner">&nbsp;</div>
            <input type="submit" value="Make it happen!" class="greenButton narrow-button float-right height32" />
        </form>	
	
	</div>
	
	<div id="after-send" style="display:none">
		<div id="slices-02-thanks">
			<img src="images/submitted_02.png" width="520" height="153" alt="">
		</div>

		<div id="slices-03-thanks">
			<img src="images/submitted_03.jpg" width="520" height="121" alt="">
		</div>
	</div>
	
	<?php } ?>
</div> <!-- table -->

	<!-- DEBUG
<div id="rest">

		<?php
			print_r($signed_request);
			
			$page_id = $signed_request["page"]["id"];
			$page_admin = $signed_request["page"]["admin"];
			$like_status = $signed_request["page"]["liked"];
			$country = $signed_request["user"]["country"];
			$locale = $signed_request["user"]["locale"];
			
			echo "<br>page id = $page_id";
			echo "<br>page admin = $page_admin";
			echo "<br>like status = $like_status";
			echo "<br>country = $country";
			echo "<br>locale = $locale";	
		?>

</div>

	<div id="load-SDK-do-nothing" style="display:none">
		<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="http://www.facebook.com/EkoUKLtd" show_faces="false" width="450" font=""></fb:like>
	</div>
	-->	

    </body>
	
</html>
