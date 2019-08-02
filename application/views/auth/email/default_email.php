<!DOCTYPE html>
<html lang="en">
    <head>
		<title>Email</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<div style="width:700px;display: block;padding:30px 20px;background:#f0eff4;box-sizing: border-box;">
			<div style="background:#fff;width:100%;display: block;padding:15px 20px;box-sizing: border-box;border-bottom: 7px solid #3269c6;">
				<div style="width:100%;display: block;padding:0 15px 15px;border-bottom: 1px solid #3269c6;box-sizing: border-box;">
					<img src="<?php echo base_url()?>assets/images/logo.png" style="width:80px;">
				</div>
				<div style="width: 100%;display: block;padding:30px 15px;box-sizing: border-box;">
					<p style="color:#999;"><?php echo $content?></p>
					<p style="color: #999;">If this is not you requesting a registration code please ignore and delete this messege.</p>
					<p style="padding-top: 10px; color: #999;">
						Yours Sincerely<br>
						Patrajasa Team
					</p>
				</div>
			</div>
			<p style="margin:25px; font-size: 11px; text-align: center; color: #999;">
				<img src="<?php echo base_url()?>assets/images/logo.png" style="width:80px; margin-bottom: 10px;"><br>
				Jln. Sarijadi Bandung 42438
			</p>
		</div>
	</body>
</html>