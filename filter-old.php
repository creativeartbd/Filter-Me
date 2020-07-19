<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
     <div class="container">
          <div class="row">
               <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                         <a class="navbar-brand" href="#">Logo</a>
                    </nav>
               </div>
          </div>
          <div class="row">
               <div class="col-md-12">
                    <h2>Breaker.jpg</h2>
                    <div class="image-gallery image-filter">
                         <img src="Gallery/03.jpg" alt="" id="filterMe" class="img-fluid">
                         <div id="drawMe"></div>

                         <ul class="nav nav-pills mb-3 image-filter-option" id="pills-tab" role="tablist">
                              <li class="nav-item">
                                   <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#image-filter" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa fa-magic" aria-hidden="true"></i>&nbsp;Filter</a>
                              </li>
                              <li class="nav-item">
                                   <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#image-adjust" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa fa-sun-o" aria-hidden="true"></i>&nbsp;Adjust</a>
                              </li>
                              <li class="nav-item">
                                   <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#image-crop" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fa fa-crop" aria-hidden="true"></i>&nbsp;Crop</a>
                              </li>
                         </ul>
                         <div class="tab-content" id="pills-tabContent">
                              <div class="tab-pane fade show active" id="image-filter" role="tabpanel" aria-labelledby="pills-home-tab">
                              </div>
                              <div class="tab-pane fade" id="image-adjust" role="tabpanel" aria-labelledby="pills-profile-tab">
                                   <div class="row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <label for="exposure">Exposure</label>
                                                  <input type="range" min="0" max="100" value="70" step="1" onchange="applyFilter();" data-filter="brightness" data-scale="%">
                                             </div>
                                             <div class="form-group">
                                                  <label for="">Contrast</label>
                                                  <input type="range" min="0" max="200" value="100" step="1" onchange="applyFilter()" data-filter="contrast" data-scale="%">
                                             </div>
                                             <div class="form-group">
                                                  <label for="">Saturation</label>
                                                  <input type="range" min="0" max="500" value="100" step="1" onchange="applyFilter()" data-filter="saturate" data-scale="%">
                                             </div>
                                             <div class="form-group">
                                                  <label for="">Warmth</label>
                                                  <input type="range" min="1" max="100" value="1" step="1" onchange="" data-filter="" data-scale="%">
                                             </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <label for="exposure">Tint</label>
                                                  <input type="range" min="0" max="100" value="70" step="1" onchange="" data-filter="" data-scale="%">
                                             </div>
                                             <div class="form-group">
                                                  <label for="exposure">Highlight</label>
                                                  <input type="range" min="0" max="100" value="100" step="1" onchange="applyFilter()" data-filter="opacity" data-scale="%">
                                             </div>
                                             <div class="form-group">
                                                  <label for="exposure">Shadow</label>
                                                  <input type="range" min="0" max="100" value="8" step="1" onchange="applyFilter();" data-filter="drop-shadow" data-scale="px">
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="tab-pane fade" id="image-crop" role="tabpanel" aria-labelledby="pills-contact-tab">
                                   <div class="form-group">
                                        <div class="col-md-12">
                                             <div class="input-group">
                                                  <label for="flip" class="col-sm-4 col-md-4 control-label text-right">Flip</label>
                                                  <div id="flip" class="btn-group">
                                                       <a class="btn btn-primary active flip" onclick="applyCrop(this);" data-value="none" data-toggle="flip" data-title="none">None</a>
                                                       <a class="btn btn-primary notActive flip" onclick="applyCrop(this);" data-value="scaleX(-1)" data-toggle="flip" data-title="flip-horizentally">Flip Horizentally</a>
                                                       <a class="btn btn-primary notActive flip" onclick="applyCrop(this);" data-value="scaleY(-1)" data-toggle="flip" data-title="flip-vertically">Flip Vertically</a>
                                                  </div>                                                  
                                             </div>
                                        </div>
                                   </div>
                                   <div class="form-group">
                                        <div class="col-md-12">
                                             <div class="input-group">
                                                  <label for="rotate" class="col-sm-4 col-md-4 control-label text-right">Rotate</label>
                                                  <div id="rotate" class="btn-group">
                                                       <a class="btn btn-primary active" onclick="applyCrop(this);" data-value="rotate(0deg)" data-toggle="rotate" data-title="0-deg">0 Deg</a>
                                                       <a class="btn btn-primary notActive" onclick="applyCrop(this);" data-value="rotate(30deg)" data-toggle="rotate" data-title="30-deg">30 Deg</a>
                                                       <a class="btn btn-primary notActive" onclick="applyCrop(this);" data-value="rotate(60deg)" data-toggle="rotate" data-title="60-deg">60 Deg</a>
                                                       <a class="btn btn-primary notActive" onclick="applyCrop(this);" data-value="rotate(90deg)" data-toggle="rotate" data-title="90-deg">90 Deg</a>
                                                       <a class="btn btn-primary notActive" onclick="applyCrop(this);" data-value="rotate(100deg)" data-toggle="rotate" data-title="100-deg">180 Deg</a>
                                                  </div>                                                  
                                             </div>
                                        </div>
                                   </div>
                                   <div class="form-group">
                                        <div class="col-md-12">
                                             <div class="input-group">
                                                  <label for="ratio" class="col-sm-4 col-md-4 control-label text-right">Ratio</label>
                                                  <div id="ratio" class="btn-group">
                                                       <a class="btn btn-primary active" onclick="applyRatio(this);" data-value="16/9" data-title="16/9">16:9</a>
                                                       <a class="btn btn-primary notActive" onclick="applyRatio(this);" data-value="10/7" data-title="10/7">10:7</a>
                                                       <a class="btn btn-primary notActive" onclick="applyRatio(this);" data-value="7/5" data-title="7/5">7:5</a>
                                                       <a class="btn btn-primary notActive" onclick="applyRatio(this);" data-value="4/3" data-title="4/3">4:3</a>
                                                       <a class="btn btn-primary notActive" onclick="applyRatio(this);" data-value="5/3" data-title="5/3">5:3</a>
                                                       <a class="btn btn-primary notActive" onclick="applyRatio(this);" data-value="3/2" data-title="3/2">3:2</a>
                                                  </div>                                                  
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-md-12">
                    <button class="btn btn-light" id="back">Back</button>
                    <button class="btn btn-primary" id="save">Save</button>
               </div>
          </div>
     </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
     <script src="assets/js/app.js"></script>
</body>

</html>