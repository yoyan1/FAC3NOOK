				
<?php include 'header.php'; 

 ?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Members</h4>
						<a class="pull-right btn btn-primary btn-sm" href="	" data-toggle="modal" data-target="#addmember" type="button" style="margin-top: -2em">Add Member</a>		
					</div>

					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th ></th>
									<th class="table-plus datatable-nosort">ID Number</th>
									<th>Fullname</th>
									<th>Address</th>
									<th>Birth Date</th>
									<th>School</th>
									<th>Username</th>
									<th>Warning</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>


								<?php

									$sql = mysqli_query($conn, "SELECT * FROM user WHERE id != '$id' ORDER BY id DESC");
									$index = 0;
									while ($row = mysqli_fetch_array($sql)) { 
											$index ++;
										?>
											
										<tr style="text-transform: capitalize;">
											<td><?php 

											echo '<div class="col-xs-4" >';
					                        echo '<img class="imggg" src="../php/uploads/'. $row['profile'].'" style="height:50px;width:50px">';
					                        echo '</div>';

					                        echo '<div class="col-xs-4" >'; ?></td>

											<td><?php echo $index?></td>
											<td><?php echo $row['fname'] ?></td>
											<td><?php echo $row['address'] ?></td>
											<td><?php echo $row['birth_date'] ?></td>
											<td><?php echo $row['school'] ?></td>
											<td><?php echo $row['username'] ?></td>
											<td><?=$row['restriction']? $row['restriction'] : 0?></td>

											<td><a href="" data-toggle="modal" data-target="#edit<?php echo $row['id'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
											<a href="../php/delete_user.php?user_id=<?=$row['id']?>" class="btn btn-success btn-sm" style="background: red; border: 1px solid red"><span class="fa fa-trash"></span></a>

										</td>
										</tr>
						<div class="modal fade" id="edit<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							
<!-- Edit modal -->				
								<div class="modal-dialog modal-dialog-centered">					
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Edit Member</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form method="POST" id="form" action="../php/edit_member.php?key=<?=$row['id'] ?>">
												<div class="form-group row">
													<label class="col-sm-12 col-md-2 col-form-label">Role<i style="color:red;font-size:1.5em;">*</i></label>
													<div class="col-sm-12 col-md-10">
														<select class="custom-select col-12" name="role" required="">
														<option value="<?=$row['role']?>"><?=$row['role']?></option>
														<?php if($row['role'] == 'user'){ 
															echo "<option>admin</option>";
														} else { 
															echo "<option>user</option>";
														} ?>
															
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-12 col-md-2 col-form-label">Action<i style="color:red;font-size:1.5em;">*</i></label>
													<div class="col-sm-12 col-md-10">
														<select class="custom-select col-12" name="action" required="" onchange="show()" id="res">
														<option value="<?=$row['restriction'] ?>"><?=$row['restriction'] ? $row['restriction'] : "0 warning" ;?></option>
															<?php 
																if($row['restriction'] == 'Restrict'){
																	echo "<option>unrestrict</option>";
																	echo "<option>Banned</option>";
																}
																elseif($row['restriction'] == 'Banned'){
																	echo "<option>unbanned</option>";
																} 
																else{
																	echo "<option>Warning</option>";
																	echo "<option value='Restrict'>Restrict</option>";
																	echo "<option value='Banned'>Banned</option>";
																} ?>
														</select>
													</div>
												</div>
												<!-- <div class="form-group row" id="limit" style="display: none">
													<label class="col-sm-12 col-md-2 col-form-label">Limit<i style="color:red;font-size:1.5em;">*</i></label>
													<div class="col-sm-12 col-md-10">
														<input class="form-control" placeholder="Limit"  type="text" name="limit" required="">
													</div>
												</div> -->
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
							<div class="modal fade" id="addmember" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Add Member</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form method="POST" action="../php/addmember.php" enctype="multipart/form-data">
												
												<div class="form-group row">
													<label class="col-sm-12 col-md-2 col-form-label">Name<i style="color:red;font-size:1.5em;">*</i></label>
													<div class="col-sm-12 col-md-10">
														<input class="form-control" placeholder="Full name"  type="text" name="name" required="">
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-sm-12 col-md-2 col-form-label">Username</label>
													<div class="col-sm-12 col-md-10">
														<input class="form-control" placeholder="Username" type="text" name="uname" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-12 col-md-2 col-form-label">Password</label>
													<div class="col-sm-12 col-md-10">
														<input class="form-control" placeholder="Password" type="password" name="pass" required>
													</div> 
												</div>

												<div class="form-group row">
													<label class="col-sm-12 col-md-2 col-form-label">Role<i style="color:red;font-size:1.5em;">*</i></label>
													<div class="col-sm-12 col-md-10">
														<select class="custom-select col-12" name="role" required="">
															<option selected="">Choose role</option>
															<option>user</option>
															<option>admin</option>
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-12 col-md-2 col-form-label">Photo</label>
													<div class="col-sm-12 col-md-10">
														<input class="form-control"  type="file" name="image" id="img-input" required>
													</div> 
												</div>
												<div class="form-group row">
													<label class="col-sm-12 col-md-2 col-form-label"></label>
													<img src="" alt="" id="img" width="150px">
												</div>
												<input type="submit" class="btn btn-primary pull-right" name="submit" value="Save">
											</form>
										</div>
									</div>
								</div>
							</div>
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

	var input = document.getElementById("img-input");
	var image = document.getElementById("img");

	input.addEventListener("change", () => {
	    image.src = URL.createObjectURL(input.files[0]);
	});

	// res.document.querySelectorAll("#form");
	// res.forEach(function (restrict){
	// 	const toLimit = restrict.getElementById('res');
	// 	toLimit.addEventListener("change" () =>{
	// 		document.getElementById('limit').style.display = 'block';
	// 	})
	
	// })
</script>



		<?php include 'footer.php'; ?>

