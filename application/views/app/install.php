<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	  <title>APP INSTALL</title>
	  <meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS" />
	  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">

	  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
	  <meta name="apple-mobile-web-app-capable" content="yes">
	  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent"> 
	  <meta name="apple-mobile-web-app-title" content="Flatkit">
	  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
	  <meta name="mobile-web-app-capable" content="yes">
	  <!-- Bootstrap 4 -->
	  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css"> 
	  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/flatkit/app.css">
	  <link rel="stylesheet" href="<?php echo base_url()?>assets/fonts/font-awesome/css/font-awesome.min.css">
	  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/font.css">
	  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/material-design-icons.css">  
	  <style type="text/css">
	    .control-label{
	      text-align: left !important;
	    }
	    textarea {
	      resize: none;
	      min-height: 100px;
	    }

	    .container{
	    	background: #232222;
opacity: 0.9;
	    }
	  </style>

	<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript">
     	function blinker() {
		    $('.blink_me').fadeOut(500);
		    $('.blink_me').fadeIn(500);
		}

		setInterval(blinker, 1000);
    </script>
    <style type="text/css">
     	.blink_me{
     		color:red;
     		font-size: 20px;
     	}
     	.inline-grid {
     		display: inline-grid;
     	}
     	.inline-block {
     		display: inline-block;
     	}
    </style>
</head>
<body style="background-image: url(assets/images/background.jpg);color: white;overflow-y: hidden; background-repeat: no-repeat;background-size: cover;">
	<div class="container">
		<h2 class="padding-top: 20px">PAR APPLI</h2><hr>
		<div style="overflow-y: auto;height: calc(100% - 120px);">
			
			<div class="col-sm-12 inline-block">
				<div class="col-sm-4 inline-grid pull-left">
					<p>
						2018/07/13 11:30<span class="blink_me"></span>
					</p>
					<a href="<?php echo base_url();?>mobile/par-1.0.0.apk" class="btn btn-default"><i class="material-icons">&#xE884;</i>APK</a>  
                    <!-- <a href="itms-services://?action=download-manifest&url=https://ipa.shirobyte.com/patrajasa/dev/manifest.plist" class="btn btn-default"><i class="material-icons">&#xE884;</i>IPA Dev</a> -->
				</div>
				<div class="col-sm-8 inline-grid pull-left">
					<h3>Changelog</h3><br>					
					<p class="float-left"> - Release Production</p>   
				</div>
			</div><hr>
			
		</div>
		
	</div> 

</body>
</html>