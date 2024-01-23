<?php include 'header.php';
$currentDate = new DateTime();
$currentDate->modify('+30 days');
$newDate = $currentDate->format('Y-m-d')

?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			
			<div class="title pb-20">
				<h2 class="h3 mb-0">Dashboard</h2>
			</div>
													  

			<div class="row pb-10">
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">
						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php $sql = mysqli_query($conn, "SELECT * FROM user WHERE role = 'user'"); echo $row = mysqli_num_rows($sql); ?></div>
								<div class="font-14 text-secondary weight-500">Members</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#00eccf"><span class="fa-solid fa-users" style="color:#ff5b5b"></span></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">
						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php $sqll = mysqli_query($conn, "SELECT * FROM publication"); echo mysqli_num_rows($sqll); ?></div>
								<div class="font-14 text-secondary weight-500">Total Post</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#ff5b5b"><span class="fa-regular fa-address-card" style="color:#007bff"></span></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">
						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php $sqlll = mysqli_query($conn, "SELECT * FROM user WHERE role = 'admin'"); echo $row = mysqli_num_rows($sqlll); ?></div>
								<div class="font-14 text-secondary weight-500">Admin</div>
							</div>
							<div class="widget-icon">
								<div class="icon"><i class="fa-solid fa-user-tie" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>
				</div>
				
		<?php include 'footer.php'; ?>