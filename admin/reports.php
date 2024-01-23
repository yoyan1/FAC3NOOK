				
<?php include 'header.php'; ?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Reports</h4>
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							
							
							<thead>
								<tr>
									<th>Fullname</th>
									<th>Book Title</th>
									<th>Task</th>
									<th>Date Transaction (Y-M-D)</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sql = mysqli_query($conn, "SELECT * from reports LEFT JOIN books ON reports.title = books.bookid left join members on reports.fullname = members.memid");
								while ($row = mysqli_fetch_array($sql)) { ?>

									<tr style="text-transform: capitalize;">
										
										<td><?php echo $row['fullname']; ?></td>
											<td><?php echo $row['title']; ?></td>
												<td><?php echo $row['task']; ?></td>
													<td><?php echo $row['transactiondate']; ?></td>

									</tr>
									
								<?php 
								}
								?>
								
								
							</tbody>
							
						</table>
					</div>
				</div>

		<?php include 'footer.php'; ?>

