<?php require APPROOT .'/views/inc/header.php'; ?>
<div class="container">
<form action="<?php echo URLROOT;?>/posts/index" method="post">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-body post">
					<textarea name="post"  class="w-100">

					</textarea>
				</div>
			</div>
		</div>

		<div class="row mt-3 mb-3">
			<div class="col-md-12 ">
				<input  type ="submit" name ="submit" class=" pull-right btn btn-outline btn-mine">
			</div>
		</div>
	</form>
	</div>
	
	<?php
		flash('post_success');
	foreach($data['userPosts'] as $user):
	?>
	<div class="card card-body mt-5 mb-5 post">
		<div class="container">
			<div class="row">
					<div class="col-md-2">
						<?php echo "@".$user->name;?>
					</div>

					<div class="col-md-10">
						<div class="row">
							<div class="col-md-12">
								<h3>
									<?php echo $user->post;?>					
								</h3>
							</div>	
						</div>	
						<hr >
						<div class="row">
							<div class="col-md-6  col-xs-6">
									<a href="<?php echo URLROOT;?>/posts/show/<?php echo $user->postId;?>" class="btn w-100 btn-dark">More</a>
							</div>

							<div class="col-md-6 col-xs-6 text-center date-created btn-dark btn">
								posted at <?php  echo date($user->created_at);?>
							</div>
							
						</div>
					</div>
					
			 </div>				
		</div>
	</div>
	<?php
	endforeach;
	?>

</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>