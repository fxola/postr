<?php require APPROOT .'/views/inc/header.php'; ?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<textarea name="post" >

			</textarea>
			
		</div>
		<div class="col-md-4">
			<a href="<?php echo URLROOT;?>/posts/add" class="pull-right btn btn-outline btn-success">
				<i class="fa fa-plus"></i> Post
			</a>
		</div>
	</div>
	<?php
	// echo "<pre>";
	// var_dump($data['userPosts']);
	// echo "</pre>";
	foreach($data['userPosts'] as $user):

	?>
		<div class="card card-body mt-5 mb-5">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						posted by <?php echo $user->name;?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 text-left">
						<?php echo $user->post;?>
					</div>

					<div class="col-md-4 text-right date-created">
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