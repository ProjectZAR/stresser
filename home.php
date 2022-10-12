<?php

	/// Require the header that already contains the sidebar and top of the website and head body tags
	$page = "Home";
	require_once 'header.php'; 

	
	/// Querys for the stats below
	$TotalUsers = $odb->query("SELECT COUNT(*) FROM `users`")->fetchColumn(0);
	$TodayAttacks = $odb->query("SELECT COUNT(*) FROM `logs` WHERE date >= CURDATE()")->fetchColumn(0);
	$MonthAttack = $odb->query("SELECT COUNT(*) FROM `logs` WHERE date >= CURDATE()  - INTERVAL 30 DAY")->fetchColumn(0);
	$TotalAttacks = $odb->query("SELECT COUNT(*) FROM `logs`")->fetchColumn(0);
	$TotalPools = $odb->query("SELECT COUNT(*) FROM `api`")->fetchColumn(0);
	$RunningAttacks = $odb->query("SELECT COUNT(*) FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0")->fetchColumn(0);
	
	function ip2geolocation($ip)
	{
		# api url
		$apiurl = 'http://freegeoip.net/json/' . $ip;
	 
		# api with curl
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $apiurl);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		$data = curl_exec($ch);
		curl_close($ch);
	 
		# return data
		return json_decode($data);
	}

?>


  <!-- Page Content -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title"><?php echo $page; ?> <i style="display: none;" id="alerts" class="fa fa-cog fa-spin"></i></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
            <li><a href="#"><?php echo $sitename; ?></a></li>
            <li class="active"><?php echo $page; ?></li>
          </ol>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- .row -->
      <div class="row">
        <div class="col-lg-3 col-sm-3 col-xs-12">
          <div class="white-box analytics-info">
            <h3 class="box-title">Total Users</h3>
            <ul class="list-inline two-part">
              <li>
                <div id="sparklinedash"></div>
              </li>
              <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success"><?php echo $TotalUsers; ?></span></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-12">
          <div class="white-box analytics-info">
            <h3 class="box-title">Total Boots</h3>
            <ul class="list-inline two-part">
              <li>
                <div id="sparklinedash2"></div>
              </li>
              <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple"><?php echo $TotalAttacks; ?></span></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-12">
          <div class="white-box analytics-info">
            <h3 class="box-title">Running Attacks</h3>
            <ul class="list-inline two-part">
              <li>
                <div id="sparklinedash3"></div>
              </li>
              <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info"><?php echo $RunningAttacks; ?></span></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-12">
          <div class="white-box analytics-info">
            <h3 class="box-title">Total Servers</h3>
            <ul class="list-inline two-part">
              <li>
                <div id="sparklinedash4"></div>
              </li>
              <li class="text-right"><i class="ti-arrow-down text-danger"></i> <span class="text-danger"><?php echo $TotalPools; ?></span></li>
            </ul>
          </div>
        </div>
      </div>
      <!--/.row -->
      <!-- .row -->
    <div id="alertsdiv" style="display:inline-block;width:100%"></div>
      <!--/.row -->
      <!-- .row -->

	    <div class="row">
        <div class="col-sm-12 col-md-12 col-xs-12">
          <div class="white-box">
            <h3 class="box-title">Live Attack Map & Server Status</h3>
            <div class="row">
              <div class="col-sm-12 col-md-8 col-xs-12">
				 <div id="world-map" style=" height: 490px"></div>
			  <script>
				$(function(){
				  $('#world-map').vectorMap({
					  
					  map: 'world_mill_en',
					  hoverOpacity: 0.7,
						hoverColor: false,
						markerStyle: {
						  initial: {
							fill: '#01c0c8',
							stroke: '#383f47'
						  }
						},
					  backgroundColor: '#353C48',
					  markers: [
					  
					  
					  <?php 
					    $SQLSelect = $odb->query("SELECT * FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 ORDER BY `id` DESC");
						while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
							$ipAttack      = $show['ip'];
							
							
							if (!filter_var($ipAttack, FILTER_VALIDATE_IP) === false) {
								
							$geolocation = ip2geolocation($ipAttack);
							$geolocation->latitude;
							$geolocation->longitude;
							$geolocation->longitude;
							$ipOctets = explode('.', $ipAttack);
							$ipnew = $ipOctets[0] . '.' . $ipOctets[1] . '.' . preg_replace('/./', '*', $ipOctets[2]) . '.' . preg_replace('/./', '*', $ipOctets[3]);
							
							}
							else
							{
								// remove http://
								$url = preg_replace('#^https?://#', '', $ipAttack);
								$url = preg_replace('#^http?://#', '', $ipAttack);
								
								$ipnew = gethostbyname($url);
								$geolocation = ip2geolocation($ipnew);
								$geolocation->latitude;
								$geolocation->longitude;
								$geolocation->longitude;
								
								$ipOctets = explode('.', $ipnew);
								$ipnew = $ipOctets[0] . '.' . $ipOctets[1] . '.' . preg_replace('/./', '*', $ipOctets[2]) . '.' . preg_replace('/./', '*', $ipOctets[3]);
								
							}
									
							
							
							
							echo  "{latLng: [".$geolocation->latitude.", ".$geolocation->longitude."], name: '".$ipnew."'},\n";
						}
					  
					  ?>
								
						{latLng: [, ], name: ''}
						]
					  
					  });
				});
				  </script>
              </div>
              <div class="col-sm-12 col-md-4 col-xs-12">
                <ul class="country-state slimscrollcountry">
				  
				  <?php
						$newssql = $odb -> query("SELECT * FROM `api` LIMIT 0,5");
						while($row = $newssql ->fetch()){
							$name = $row['name'];
							$slots = $row['slots'];
							$vip = $row['vip'];
							if($vip == 0)
							{
								$vip = "Normal";
							}
							else 
							{
								$vip = "VIP";
							}
							
							$attacks = $odb->query("SELECT COUNT(*) FROM `logs` WHERE `handler` LIKE '%$name%' AND `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0")->fetchColumn(0);
							$load    = round($attacks / $slots * 100, 2);
					
							
							echo'<li>
                    <h3>'.$name.' ('.$vip.')</h3>
                    <small>Running Attacks: '.$attacks.'/'.$slots.'</small>
                    <div class="pull-right">'.$load.'% <i class="fa fa-level-down text-danger"></i></div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-purple" role="progressbar" aria-valuenow="'.$load.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$load.'%;"> <span class="sr-only">'.$load.'%</span></div>
                    </div>
                  </li>';
						}
						?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
	   <div class="row">
	   
	          <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="white-box">
            <h3 class="box-title">Latest News</h3>
            <div class="steamline">
			<?php
						$newssql = $odb -> query("SELECT * FROM `news` ORDER BY `date` DESC LIMIT 5");
						while($row = $newssql ->fetch()){
							$ID = $row['ID'];
							$title = $row['title'];
							$content = $row['content'];
							echo 
							' <div class="sl-item">
                <div class="sl-right">
                  <div><a href="#">'.$title.'</a> </div>
                  <p>'.$content.'f</p>
                </div>
              </div>';
						}
						?>
            </div>
          </div>
        </div>
		<?php
			$plansql = $odb -> prepare("SELECT `users`.`expire`, `plans`.`name`, `plans`.`concurrents`, `plans`.`mbt` FROM `users`, `plans` WHERE `plans`.`ID` = `users`.`membership` AND `users`.`ID` = :id");
			$plansql -> execute(array(":id" => $_SESSION['ID']));
			$row = $plansql -> fetch(); 
			$date = date("m-d-Y, h:i:s a", $row['expire']);
			if (!$user->hasMembership($odb)){
				$row['mbt'] = 0;
				$row['concurrents'] = 0;
				$row['name'] = 'No membership';
				$date = '0-0-0';
			}
		?>
		<div class="col-md-6 col-sm-12 col-xs-12">
          <div class="white-box">
            <h3 class="box-title">Account Statistics</h3>
            <div class="weather-box">
              <div class="weather-info">
                <div class="row">
                  <div class="col-xs-12 p-r-10">
                    <div class="row">
                      <div class="col-md-12">
                        <p class="pull-left">Current Plan</p>
                        <p class="pull-right font-bold"><?php echo $row['name']; ?></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <p class="pull-left">Max Boot Time</p>
                        <p class="pull-right font-bold"><?php echo $row['mbt']; ?></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <p class="pull-left">Concurrents</p>
                        <p class="pull-right font-bold"><?php echo $row['concurrents']; ?></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <p class="pull-left">Expire Date</p>
                        <p class="pull-right font-bold"><?php echo $date; ?></p>
                      </div>
                    </div>
					
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/.row -->
	  <script>

		alerts();

		function alerts() {
			document.getElementById("alertsdiv").style.display = "none";
			document.getElementById("alerts").style.display = "inline"; 
			var xmlhttp;
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			}
			else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("alertsdiv").innerHTML = xmlhttp.responseText;
					document.getElementById("alerts").style.display = "none";
					document.getElementById("alertsdiv").style.display = "inline-block";
					document.getElementById("alertsdiv").style.width = "100%";
					eval(document.getElementById("ajax").innerHTML);
				}
			}
			xmlhttp.open("GET","includes/ajax/user/alerts.php",true);
			xmlhttp.send();
		}
		</script>
<?php

	require_once 'footer.php';
	
?>