<?php require APPROOT .'/views/inc/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="show col-md-12">
            <div class="card card-body post">
                <div class="row">

                </div>
              <?php echo  $data['posts']->post; ?>
            </div>
        </div>
    </div>
</div>


<?php require APPROOT .'/views/inc/footer.php'; ?>