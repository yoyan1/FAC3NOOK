				
<?php include 'header.php'; 

 ?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">User's Post</h4>
					</div>

					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th>Fullname</th>
									<th>Image</th>
									<th>Caption</th>
									<th>Comments</th>
									<th>Reaction</th>
									<th>Warning</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>


								<?php

									$sql = mysqli_query($conn, "SELECT * FROM publication LEFT JOIN user ON user.id = publication.user_id ORDER BY publication.date DESC");
									while ($row = mysqli_fetch_array($sql)) { ?>
						
										<tr>
											<td><?php echo $row['fname'] ?></td>
											<td><?php 

											echo '<div class="col-xs-4" >';
					                        echo  $row['image'] == ""? 'none' : '<img class="imggg" src="../php/uploads/'. $row['image'].'" style="height:50px;width:50px">';
					                        echo '</div>';

					                        echo '<div class="col-xs-4" >'; ?></td>
											<td style="max-width: 15rem"><?php echo $row['post'] ?></td>
											<td><?php echo $row['comments'] ?></td>
											<td><?php echo $row['reaction'] ?></td>
											<td><?php echo $row['warning'] ?></td>
											<td><a href="" data-toggle="modal" data-target="#edit<?php echo $row['post_id'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>

										</td>
										</tr>
						<div class="modal fade" id="edit<?php echo $row['post_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							
<!-- Edit modal -->				
								<div class="modal-dialog modal-dialog-centered">					
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Action</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form method="POST" action="../php/restrict.php?key=<?=$row['post_id']?>">
												<div class="form-group row">
													<label class="col-sm-12 col-md-2 col-form-label">Warning<i style="color:red;font-size:1.5em;">*</i></label>
													<div class="col-sm-12 col-md-10">
														<select class="custom-select col-12" name="action" required="">
															<option value="<?=$row['warning'] ?>"><?=$row['warning'] ? $row['warning'] : "0 Warning"?> </option>
															<option>Warning</option>
															<option>Delete post</option>
														</select>
													</div>
												</div>
												<input type="submit" class="btn btn-primary pull-right" name="submit" value="Save">
											</form>
										</div>
									</div>
								</div>
							</div>
										
									<?php } ?>
								
							</tbody>
						</table>
					</div>
				</div>


<!-- Add Modal -->
							
<script type="text/javascript">
	function yesnoCheck(that) {
		if (that.value == "Student") {
			document.getElementById("ifYes").style.display = "block";
			document.getElementById("ifYess").style.display = "block";
		}
		else {
			document.getElementById("ifYes").style.display = "none";
			document.getElementById("ifYess").style.display = "none";  
		}
	}
</script>



		<?php include 'footer.php'; ?>

