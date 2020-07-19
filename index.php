<!doctype html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="assets/css/style.css">
     <title>Filter Me App</title>
</head>

<body>
     <!-- Navigation area -->
     <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container">
               <a class="navbar-brand" href="#">Filter Me :)</a>
          </div>
     </nav>
     <!-- Navigation area end here-->

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
                              <p><strong>9 Items</strong></p>
                         </div>
                    </div>
                    <div class="row" id="load-image"></div>
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

     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
     <script src="assets/js/app.js"></script>     
</body>
</html>