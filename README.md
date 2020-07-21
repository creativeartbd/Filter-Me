# Filter Me



FilterMe is a JavaScript-based app where you can easily upload png, jpg, jpeg, and gif image in the gallery and then can apply a filter on any image. 

Live Example:  [Click here](https://shibbir.dev/demo/filter-me/)


## Configuration



Before you run this app you need to go to init.php file which is located at the root folder. Just open this PHP file and then configure `$database` variable according to your localhost database information. 



```
<?php

// Start the filterme app engine by connecting to the mysql database

require_once('classes/database.php');

require_once('classes/upload.php');


$database     = new Database('localhost', 'filterme', 'root', '');

$uploadFile   = new UploadFile($database);

```



Here I have used host as `localhost`, database name as `filterme`, localhost user as `root` and password is **empty** by default. 



## How It Works



After the configuration is done you can now open your app by the following URL: **http://localhost/filterMe/**. Assuming that you have uploaded the main project folder in your localhost root directory called **filterMe**. 



## How to Upload file?



After open the main URL you can see **Drag and Drop** area as well as the **browse** link where you can drag or browse your **images**. After successfully dragged or selected the images the app will automatically upload the image/s to the Gallery folder and as well as the database to store the data. 



## How to apply filter effect?



Now, after uploading the image you can see the image. Just click on it and then you will be redirect to filter.php page where you can multiple options to apply a filter to your selected image. 



## Can I download the applied filter? 



Yes, you can download the applied filter by pressing the **save** button.



***

