<?php require APPROOT .'/views/inc/header.php'; ?>
<div class="container">
<form action="" method="post">
	<div class="row">
		<div class="col-md-8">
			<textarea name="post"  class="w-100">

			</textarea>
			
		</div>

		<div class="col-md-4">
			<a href="<?php echo URLROOT;?>/posts/add" name ="submit" class="pull-right btn btn-outline btn-success">
				<i class="fa fa-plus"></i> Post
			</a>
		</div>
	</form>
	</div>
	<?php

	foreach($data['userPosts'] as $user):
	?>
		<div class="card card-body mt-5 mb-5 bg-primary">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<?php echo $user->name;?>
					</div>
					<div class="col-md-8">
						<h4>
							<?php echo $user->post;?>					
						</h4>
					</div>
				</div>
				<br>
				<hr >
				<div class="row">
					<div class="col-md-6 ">
						<a href="<?php echo URLROOT;?>/posts/show/<?php echo $user->postId;?>" class="btn w-100 btn-dark">More</a>
					</div>

					<div class="col-md-6 text-center date-created">
						posted at <?php echo $user->created_at;?>
					</div>
				</div>
				
			</div>
		</div>
	<?php
	endforeach;
	?>

</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>