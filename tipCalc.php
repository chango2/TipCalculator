<!DOCTYPE html>
<html>
<head>
	<title>Tip Calculator</title>
	<link rel="stylesheet" type="text/css" href="tipCalc.css">
</head>
<body>

	<!-- DIV for containing all elements inside -->
	<div id="container">

		<h1>Tip Calculator</h1>

		<!-- POST request form -->
		<form action="tipCalc.php" method="post">

			<span id="subtotal">Bill subtotal: $</span><input id="billST" type="text" name="billTotal" value=<?php
															echo "";
															if(isset($_POST['billTotal']) && is_numeric($_POST['billTotal']) && $_POST['billTotal'] > 0) {
																echo $_POST['billTotal'];
															} 
															?>>

			<!-- Div for the user to choose a tip value -->												
			<div id="chooseTip">
				Tip percentage: <br />
				<!-- php loop to create radio inputs -->
				<?php for($i = 10; $i <= 20; $i += 5) { ?>
					<input type="radio" name="tip" value="<?= $i ?>"<?php 
																		if(isset($_POST['tip']) && $_POST['tip'] == $i) { 
																			echo "checked"; 
																		} 
																	?> ><?= $i ?>%
				<?php } ?>
				<!-- Custom input radio button -->
				<br><input id="custom" type="radio" name="tip" value="customV" <?php 
																		if(isset($_POST['tip']) && $_POST['tip'] == "customV") { 
																			echo "checked"; 
																			if(isset($_POST['customValue']) && is_numeric($_POST['customValue'])) {
																				$_POST['tip'] = $_POST['customValue'];
																			}
																		}?> >

				<!-- Custom input Text area -->
				Custom: <input id="customInput" type="text" name="customValue" readonly value=<?php
																				if(isset($_POST['customValue']) && is_numeric($_POST['customValue'])) {
																					echo $_POST['customValue'];
																				} 
																			?> >% <br>
			</div>

			<!-- Split tip and money -->
			<div id="sp">
				Split: <input type="text" name="split" value=<?php
														$spl = 1;			/*Default split set to 1*/
														if(isset($_POST['split'])){
															$spl = $_POST['split'];
														}
														echo $spl;
													?>>
				person(s) <br>
			</div>

			<!-- Submit Button -->
			<input id="submit" type="submit" name="calculate" value="Calculate">
		</form>
	</div>


	<!-- Div for showing how much tip and total user needs to pay -->
	<div id="receipt">
		<?php
			if(isset($_POST['tip'], $_POST['billTotal'])) {
				if(is_numeric($_POST['billTotal']) && $_POST['billTotal'] > 0 && is_numeric($_POST['tip']) && $_POST['tip'] > 0 && is_numeric($_POST['split']) && $_POST['split'] > 0) {
					?>
					<script type="text/javascript">document.getElementById("receipt").style.display = 'block'</script>
					<?php
						echo "Tip: $" . number_format($_POST['billTotal']*($_POST['tip'] / 100), 2);
						echo "<br>Total: $" . number_format($_POST['billTotal']*($_POST['tip'] / 100) + $_POST['billTotal'], 2);
						if($_POST['split'] > 1) {
							echo "<br>Tip Per Person: $" . number_format($_POST['billTotal']*($_POST['tip'] / 100) / $_POST['split'], 2);
							echo "<br>Total Each: $" . number_format(($_POST['billTotal']*($_POST['tip'] / 100) + $_POST['billTotal']) / $_POST['split'], 2);
					}
				}
			}
		?>
	</div>


	<!-- This part of code checks if any user inputs are wrong and adds appropriate css to notify them what they need to fix -->
	<?php
		if(isset($_POST['billTotal']) && $_POST['billTotal'] < 1 ) {
			?><script type="text/javascript">
				document.getElementById("subtotal").classList.toggle('wrong');
				document.getElementById("receipt").style.display = 'none';
			</script>;
		<?php }
		if(isset($_POST['tip']) && $_POST['tip'] < 1) {
			?><script type="text/javascript">
				document.getElementById("chooseTip").classList.toggle('wrong');
				document.getElementById("receipt").style.display = 'none';
			</script>;
		<?php }
		if(isset($_POST['split']) && $_POST['split'] < 1 ) {
			?><script type="text/javascript">
				document.getElementById("sp").classList.toggle('wrong')
				document.getElementById("receipt").style.display = 'none';
			</script>;
		<?php }
	?>

	<!-- JS file for "read only" functionality -->
	<script type="text/javascript" src="tipCalc.js"></script>
</body>
</html>