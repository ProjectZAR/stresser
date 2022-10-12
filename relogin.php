<?php 

	ob_start();
	require_once 'includes/app/config.php';
	require_once 'includes/app/init.php';

	if (!(empty($maintaince))) {
		header('Location: maintenace.php');
		exit;
	}

	//Set IP (are you using cloudflare?)
	if ($cloudflare == 1){
		$ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
	}
	else{
		$ip = $user -> realIP();
	}

	//Are you already logged in?
	if ($user -> LoggedIn()){
		header('Location: home.php');
		exit;
	}
	


	if(isset($_POST['doLogin'])){
		
		$username = $_COOKIE['username'];
		$password = $_POST['login-password'];
		
		if(empty($_POST['g-recaptcha-response']) || empty($_POST['login-password'])){
			$error = "Please enter all fields";
		}

		if(!($user -> captcha($_POST['g-recaptcha-response'], $google_secret))){
			$error = "The captcha was incorrect";
		}
		
		
		$date = strtotime('-1 hour', time());
		$attempts = $odb->query("SELECT COUNT(*) FROM `loginlogs` WHERE `ip` = '$ip' AND `username` LIKE '%failed' AND `date` BETWEEN '$date' AND UNIX_TIMESTAMP()")->fetchColumn(0);
		if ($attempts > 2) {
			$date = strtotime('+1 hour', $waittime = $odb->query("SELECT `date` FROM `loginlogs` WHERE `ip` = '$ip' ORDER BY `date` DESC LIMIT 1")->fetchColumn(0) - time());
			//$error = 'Too many failed attempts. Please wait '.$date.' seconds and try again.';
		}

		//Check username exists
		$SQLCheckLogin = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username");
		$SQLCheckLogin -> execute(array(':username' => $username));
		$countLogin = $SQLCheckLogin -> fetchColumn(0);
		if (!($countLogin == 1)){
			$SQL = $odb -> prepare("INSERT INTO `loginlogs` VALUES(:username, :ip, UNIX_TIMESTAMP(), 'XX')");
			$SQL -> execute(array(':username' => $username." - failed",':ip' => $ip));
			$error = "The username does not exist in our system.";
		}

		// Check if password is corredt
		$SQLCheckLogin = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username AND `password` = :password");
		$SQLCheckLogin -> execute(array(':username' => $username, ':password' => SHA1(md5($password))));
		$countLogin = $SQLCheckLogin -> fetchColumn(0);
		if (!($countLogin == 1)){
			$SQL = $odb -> prepare("INSERT INTO `loginlogs` VALUES(:username, :ip, UNIX_TIMESTAMP(), 'XX')");
			$SQL -> execute(array(':username' => $username." - failed",':ip' => $ip));
			$error = 'The password you entered is invalid.';
		}

		//Check if the user is banned
		$SQL = $odb -> prepare("SELECT `status` FROM `users` WHERE `username` = :username");
		$SQL -> execute(array(':username' => $username));
		$status = $SQL -> fetchColumn(0);
		if ($status == 1){
			$ban = $odb -> query("SELECT `reason` FROM `bans` WHERE `username` = '$username'") -> fetchColumn(0);
			if(empty($ban)){ $ban = "No reason given."; }
			$error = 'You are banned. Reason: '.htmlspecialchars($ban);
		}

		//Insert login log and log in
		if(empty($error)){
			$SQL = $odb -> prepare("SELECT * FROM `users` WHERE `username` = :username");		$SQL -> execute(array(':username' => $username));
			$userInfo = $SQL -> fetch();
			$ipcountry = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip)) -> {'geoplugin_countryName'};
			if (empty($ipcountry)) {$ipcountry = 'XX';}
			$SQL = $odb -> prepare('INSERT INTO `loginlogs` VALUES(:username, :ip, UNIX_TIMESTAMP(), :ipcountry)');
			$SQL -> execute(array(':ip' => $ip, ':username' => $username, ':ipcountry' => $ipcountry));
			$_SESSION['username'] = $userInfo['username'];
			$_SESSION['ID'] = $userInfo['ID'];
			setcookie("username", $userInfo['username'], time() + 720000);
			header('Location: home.php');
			exit;
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
<title><?php echo $sitename;?> - ReLogin</title>
<!-- Bootstrap Core CSS -->
<link href="includes/theme/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- animation CSS -->
<link href="includes/theme/css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="includes/theme/css/style.css" rel="stylesheet">
<!-- color CSS -->
<link href="includes/theme/css/colors/default-dark.css" id="theme"  rel="stylesheet">
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
  <div class="login-box">
  <?php
					if(!empty($error)){
						echo error($error);
					}
				?>
    <div class="white-box">
      <form class="form-horizontal form-material" id="loginform" method="post">
        <h3 class="box-title m-b-20">Welcome Back! <?php echo $_COOKIE['username']; ?></h3>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" required="" name="login-password"  placeholder="Password">
          </div>
        </div>
		 <div class="form-group">
          <div class="col-xs-12">
            <center> <div class="g-recaptcha" data-sitekey=<?php echo $google_site; ?>></div> </center>
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button type="submit" name="doLogin" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
          </div>
        </div>
      </form>
	  <a href="logout.php"> Not you? Click here! </a>
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="includes/theme/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="includes/theme/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="includes/theme/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->
<script src="includes/theme/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="includes/theme/js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="includes/theme/js/custom.js"></script>
<!--Style Switcher -->
<script src="includes/theme/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>

