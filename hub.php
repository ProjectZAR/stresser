<?php

	/// Require the header that already contains the sidebar and top of the website and head body tags
	$page = "Attack Hub";
	require_once 'header.php'; 
	
	/// Querys for the stats below
	$TodayAttacks = $odb->query("SELECT COUNT(id) FROM `logs` WHERE `date` BETWEEN DATE_SUB(CURDATE(), INTERVAL '-1' DAY) AND UNIX_TIMESTAMP()")->fetchColumn(0);
	$MonthAttack = $odb->query("SELECT COUNT(id) FROM `logs` WHERE `date` BETWEEN DATE_SUB(CURDATE(), INTERVAL '-30' DAY) AND UNIX_TIMESTAMP()")->fetchColumn(0);
	$TotalAttacks = $odb->query("SELECT COUNT(*) FROM `logs`")->fetchColumn(0);
	$RunningAttacks = $odb->query("SELECT COUNT(*) FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0")->fetchColumn(0);
	
	$testattacks = $odb->query("SELECT COUNT(*) FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0")->fetchColumn(0);
	$load    = round($testattacks / $maxattacks * 100, 2);
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

      <!--/.row -->
      <!-- .row -->
	    <div class="row">
        <div class="col-lg-3 col-sm-3 col-xs-12">
          <div class="white-box analytics-info">
            <h3 class="box-title">Total Boots Today</h3>
            <ul class="list-inline two-part">
              <li>
                <div id="sparklinedash"></div>
              </li>
              <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success"><?php echo $TodayAttacks; ?></span></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-12">
          <div class="white-box analytics-info">
            <h3 class="box-title">Total Boots Month</h3>
            <ul class="list-inline two-part">
              <li>
                <div id="sparklinedash2"></div>
              </li>
              <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple"><?php echo $MonthAttack; ?></span></li>
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
            <h3 class="box-title">Total Power Consumption</h3>
            <ul class="list-inline two-part">
              <li>
                <div id="sparklinedash4"></div>
              </li>
              <li class="text-right"><i class="text-danger"></i> <span class="text-danger">%<?php echo $load; ?></span></li>
            </ul>
          </div>
        </div>
      </div>
	   <div id="alertsdiv" style="display:inline-block;width:100%"></div>
      <div class="row">
	
	   <div class="col-lg-12" id="div"></div>
	     <div class="col-md-6 col-sm-12 col-xs-12">
		
          <div class="white-box">
		  <h3 class="m-b-0 box-title">Attack Hub <i style="display: none;" id="image" class="fa fa-cog fa-spin"></i></h3>
				<form class="form-horizontal"  method="post" onsubmit="return false;">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Host</label>
                <div class="col-sm-9">
                  <input class="form-control" type="text" id="host" name="host" placeholder="1.1.1.1 or http://link.com">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Port</label>
                <div class="col-sm-9">
                  <input class="form-control" type="text" id="port" name="port" placeholder="80">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Time (Seconds)</label>
                <div class="col-sm-9">
                  <input class="form-control" type="text" id="time" name="time" placeholder="30">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Method</label>
                <div class="col-sm-9">
                  <select class="form-control" id="method" name="method">
														<optgroup label="Layer 4 Methods">
														<?php
														$SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'layer4' ORDER BY `id` ASC");
														while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
															$name = $getInfo['name'];
															$fullname = $getInfo['fullname'];
															echo '<option value="' . htmlentities($name) . '">' . htmlentities($fullname) . '</option>';
														}
														?>
														</optgroup>
														<optgroup label="Layer 7 Methods">
														<?php
															$SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'layer7' ORDER BY `id` ASC");
															while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
																$name     = $getInfo['name'];
																$fullname = $getInfo['fullname'];
																echo '<option value="' . $name . '">' . $fullname . '</option>';
															}
														?>
														</optgroup>
													</select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword4" class="col-sm-3 control-label">VIP Mode</label>
                <div class="col-sm-9">
                  <select class="form-control" id="vip" name="vip">
				  <option value="1">Yes</option>
				  <option value="0">No</option>
				  </select>
                </div>
              </div>
              <div class="form-group m-b-0">
                <div class="col-sm-offset-3 col-sm-9">
                  <button class="btn btn-success" onclick="start()" type="submit">
													<i class="fa fa-plus push-5-r"></i> Start
												</button>
												<?php 
												// Check if user has an API with us.
												$userID = $_SESSION['ID'];
												
													$SQL = $odb -> prepare("SELECT COUNT(userID) FROM `users_api` WHERE `userID` = :userID");
													$SQL -> execute(array(':userID' => $userID));
													$status = $SQL -> fetchColumn(0);
													if ($status == 1){
													
														echo '
												<button class="btn btn-outline btn-warning" data-toggle="modal" data-target="#manageapi" type="button"><i class="fa fa-wrench"></i> Manage API</button>';
													
													}
												?>
                </div>
              </div>
            </form>
          </div>
        </div>
		 <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="white-box">
		  <h3 class="m-b-0 box-title">Manage Attacks <i style="display: none;" id="manage" class="fa fa-cog fa-spin"></i></h3>
            <div id="attacksdiv" style="display:inline-block;width:100%"></div>
          </div>
        </div>
      </div>
	  <?php 
	  // Checks if there session for the latest attack sent
	  
	  if(!empty($_SESSION['ping_key']))
	  {
	  /// GRAB PING INFO
	   $SQLSelect = $odb->query("SELECT * FROM `ping_sessions` WHERE ping_key='{$_SESSION['ping_key']}' ORDER BY `ID` DESC LIMIT 1");
		while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
			
		$userid = $show['user_id'];
		$key = $show['ping_key'];
        $pingip = $show['ping_ip'];
        $pingport = $show['ping_port'];
	  ?>
	  <!-- Modal -->
		<div class="modal fade" id="pingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Pinging - <?php echo $pingip; ?></h4>
			  </div>
			  <div class="modal-body">
				<div class="ping-tool" style="height:275px;overflow:auto;"></div>
								<script data-cfasync="false" type="text/javascript">
									console.log("lol");
									/*
									var timer, i = 0;
									jQuery(function() {
										timer = setInterval(function() {
											++i;
											$.ajax({
												url      : "pingAttack.php",
												type     : "GET",
												data     : "token=<?php echo $token; ?>",
												datatype : "json",
												timeout  : 3000
											}).success(function(data) {
												console.log(data);
												if (data.code === 0 ) $("div.ping-tool").prepend("<div style='color:lime;'>[" + 
													i + " / <?php echo $maxPings; ?>] " +  data.message + "</div>");
												if (data.code !== 0 || i > <?php echo $maxPings-1; ?>) {
													$("div.ping-tool").prepend("<div style='color:red;'>[" + i + " / <?php echo $maxPings; ?>] " + 
														(data.code === 0 ? "Ping completed" : "Ping has stopped, error: " + data.message) + 
														"</div>");
													clearInterval(timer);
												}
											}).error(function(xhr, txt, err) {
												$("div.ping-tool").prepend("<div style='color:red;'>[ERROR] Ping tool has stopped: " +
													xhr.responseText + " (" + txt + ")</div>");
												clearInterval(timer);
											});
											
											// Bug fix: sometimes pings don't end
											if (i > <?php echo $maxPings-1; ?>) clearInterval(timer);
										}, 2000);
									});*/

									var token   = '<?php echo $key?>',
										i       = 0,
										maxPing = 4,
										retry   = 0,
										delay   = 250, // calm ur tits b0i, shtap changing this; u fok'n crack head ~AppleJuice
										running = true
									;
									function pingServer() {
										// end function if we're not supposed to run
										if (!running || i >= maxPing) {
											writeMessage("*** Completed's automatic ping tool has " + (i >= maxPing ? " completed" : "terminated") + " ***<br /><br />", 3);
											return;
										}

										// end after 3 retries
										if (retry > 3) {
											running = false;
											writeMessage("[" + i + "/" + maxPing + "] Maximum retries attempted. Completed's automatic ping tool will terminate");
											return false;
										}
										
										// send ajax request
										$.ajax({
											url      : "pingAttack.php",
											type     : "GET",
											data     : "token=<?php echo $key; ?>",
											datatype : "json",
											timeout  : 15000 // fuck me
										}).success(function(data) {
											console.log(data);

											// successful response
											if (data.code === 0) {
												++i; // increment # of pingies ;)
												retry = 0; // reset try 
												writeMessage("[" + i + "/" + maxPing + "] " + data.message, true);
											// server error
											} else if (data.code === 5) {
												++retry;
												writeMessage("[" + i + "/" + maxPing + "] An error has occurred: " + data.message + ". Retrying (" + retry + "/3)");
											// other error
											} else {
												writeMessage("[" + i + "/" + maxPing + "] An error has occurred: " + data.message + ". AppleJuice's automatic ping tool will terminate");
												running = false;
												return false;
											}
										}).error(function(xhr, txt, err) {
											writeMessage("[" + i + "/" + maxPing + "] An error has occurred: " + xhr.responseText + " (" + txt + ") Retrying (" + retry + "/3)");
											++retry;
										}).complete(function() {
											setTimeout(function() {
												pingServer();
											}, delay);
										});

									}

									function writeMessage(message, success) {
										$("div.ping-tool").prepend("<div style='color:" + (success == true ? "lime":(success==3?"#3171f9":"#4C0000")) + "'>" + message + "</div>");
									}

									jQuery(function() {
										setTimeout(function() {
											writeMessage("*** PINGING <?=htmlentities($ip) . " " . $maxPings?> TIMES ***", true);
											pingServer();
										}, delay);
									});
								</script>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
	  <?php
	  // End of Pinger Module
		}
	  }
	  ?>
      <!--/.row -->
	  <script>
		attacks();
		alerts();
		
		function attacks() {
			document.getElementById("attacksdiv").style.display = "none";
			document.getElementById("manage").style.display = "inline"; 
			var xmlhttp;
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			}
			else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("attacksdiv").innerHTML = xmlhttp.responseText;
					document.getElementById("manage").style.display = "none";
					document.getElementById("attacksdiv").style.display = "inline-block";
					document.getElementById("attacksdiv").style.width = "100%";
					eval(document.getElementById("ajax").innerHTML);
				}
			}
			xmlhttp.open("GET","includes/ajax/user/attacks/attacks.php",true);
			xmlhttp.send();
		
		}
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
		
		
		
			
		function start() {
			var host=$('#host').val();
			var port=$('#port').val();
			var time=$('#time').val();
			var method=$('#method').val();
			var vip=$('#vip').val();
			document.getElementById("image").style.display="inline"; 
			document.getElementById("div").style.display="none"; 
			var xmlhttp;
			if (window.XMLHttpRequest) {
				xmlhttp=new XMLHttpRequest();
			}
			else {
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("div").innerHTML=xmlhttp.responseText;
					document.getElementById("div").style.display="inline";
					document.getElementById("image").style.display="none";
					if (xmlhttp.responseText.search("success") != -1) {
						attacks();
						window.setInterval(ping(host),10000);
					}
				}
			}
			xmlhttp.open("GET","includes/ajax/user/attacks/hub.php?type=start" + "&host=" + host + "&port=" + port + "&time=" + time + "&method=" + method + "&vip=" + vip,true);
			xmlhttp.send();
			// $('#pingModal').modal('show'); 
						
		}
		
		function renew(id) {
			document.getElementById("manage").style.display="inline"; 
			document.getElementById("div").style.display="none"; 
			var xmlhttp;
			if (window.XMLHttpRequest) {
				xmlhttp=new XMLHttpRequest();
			}
			else {
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("div").innerHTML=xmlhttp.responseText;
					document.getElementById("div").style.display="inline";
					document.getElementById("manage").style.display="none";
					if (xmlhttp.responseText.search("success") != -1) {
						attacks();
						window.setInterval(ping(host),10000);
					}
				}
			}
			xmlhttp.open("GET","includes/ajax/user/attacks/hub.php?type=renew&id=" + id,true);
			xmlhttp.send();
			$('#pingModal').modal('show'); 
		}
		
		function stop(id) {
			document.getElementById("manage").style.display="inline"; 
			document.getElementById("div").style.display="none"; 
			var xmlhttp;
			if (window.XMLHttpRequest) {
				xmlhttp=new XMLHttpRequest();
			}
			else {
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("div").innerHTML=xmlhttp.responseText;
					document.getElementById("div").style.display="inline";
					document.getElementById("manage").style.display="none";
					if (xmlhttp.responseText.search("success") != -1) {
						attacks();
						window.setInterval(ping(host),10000);
					}
				}
			}
			xmlhttp.open("GET","includes/ajax/user/attacks/hub.php?type=stop" + "&id=" + id,true);
			xmlhttp.send();
		}
		
		
		</script>
		<div class="modal " id="manageapi" tabindex="-1" role="dialog" aria-hidden="false" style="display: non;">
				<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content ">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="exampleModalLabel1">Manage API  <i style="display: none;" id="icon" class="fa fa-cog fa-spin"></i></h4>
									  </div>
									  <div class="modal-body">
									  <div id="div"></div>
											<?php /// HERE NEEDS TO BE TERMS OF SERVICE FROM ADMIN PANEL! ?>
											<form class="form-horizontal" method="post" onsubmit="return false;">
											<ul class="list-icons">
											
								
											</ul>
											</form>
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button onclick="newticket()" class="btn btn-outline btn-info"><i class="fa fa-plus"></i> Regenerate Key</button>
									  </div>
									</div>
								  </div>
			</div>
<?php

	require_once 'footer.php';
	
?>