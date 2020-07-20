<?php require_once('header.php'); ?>

<div class="container">
     <div class="row">
          <div class="col-md-12">
               <h3>Media Library</h3>
          </div>
     </div>

     <div class="content-container">
          <!-- Uploaded image container -->
          <div class="uploaded-image p-5">
               <div class="row">
                    <div class="col-md-12">
                         <p class="no-of-items"><?php echo $noOfItems .  ($noOfItems > 1 ? ' Items' : ' Item');  ?></p>
                    </div>
               </div>
               <div class="row" id="load-image">
                    <?php
                    // Get the gallery                     
                    echo $allGalleries;
                    ?>
               </div>
          </div>
          <!-- Uploaded image container end here-->

          <!-- Upload image container -->
          <div class="upload-image">
               <div class="row">
                    <div class="col-md-4">
                         <p><strong>Upload Image</strong></p>
                    </div>
                    <div class="col-md-8">
                         <div class="img-upload-area" id="drop-area">
                              <p>Drag and Drop or <a href="#" id="clicker">Browse for files</strong></p>
                              <input type="file" id="file" />
                         </div>
                    </div>
               </div>
          </div>
          <!-- Upload image container end here -->
     </div>
</div>

<?php require_once('footer.php'); ?>