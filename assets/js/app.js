const dropArea = document.querySelector('#drop-area');

if( dropArea ) {	
	
	// Stop default browser behaviour
	['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
		dropArea.addEventListener( eventName, preventDefaults, false );
	})

	// Drop the file
	dropArea.addEventListener('drop', (event) => {
		let dt = event.dataTransfer;
		let files = dt.files;
		// Handle files
		handleFiles(files)
	});	
}

// Prevent default browser reaction 
function preventDefaults(e) {
	e.preventDefault()
	e.stopPropagation()
}

// Handle dropped files to upload
function handleFiles(files) {	
	uploadFile(files);
}

// Start upload  the files
function uploadFile(files) {

	let url = 'process-file.php'
	let formData = new FormData();
	let allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

	// Do some validation 
	for (const [key, value] of Object.entries(files)) {
		let extension = value.name.split(".").pop();
		if (allowedExt.includes(extension) == false) {
			alert('Invalid file formate, we are only accepting ' + allowedExt.join(", ") + ' file formates');
			return false;
		}
		formData.append( 'files', value );
		// After complete the validation preview the image
		previewFile(value, value.name);
	}

	// Now save file to the database
	fetch(url, {
		method: 'POST',
		body: formData,
	})
	.then((data) => {
		// Just showing some return data to the console
		console.log( data );
	})
	.catch((error) => {
		// If we found any error message 
		alert( error );
	})
}

// Load the image here which we want to filter 
const loadImage = document.querySelector('#load-image');

// Preview the uploaded files
function previewFile(file, fileName) {
	let noOfItems = document.querySelector('.no-of-items');	

	let reader = new FileReader();
		reader.readAsDataURL(file);
		reader.onload = function () {

		let html = '';
			html += '<div class="col-md-4"><div class="item" id="item"><a href="filter.php"><img src="' + reader.result + '" alt="" class="img-fluid filter-me"></a><span>' + fileName + '</span></div></div>';
			loadImage.innerHTML += html;
			reader.onloadend = doFilter();

		let filterMe = document.querySelectorAll('.filter-me');
			noOfItems.innerHTML = filterMe.length + ' Items';	
	}
}

// Fire doFilter function on page load
window.addEventListener('load', doFilter );

// Save the filter image to local storage by click on the corresponding image
function doFilter() {
	let filterMe = document.querySelectorAll(".filter-me");	
	// If I can't find you :p 
	if( !filterMe.length ) 
		return ;

	for (let i of filterMe) {
		i.addEventListener("click", function () {
			localStorage.setItem("imgData", this.src);
		});
	}
}

// All Default filter styles
let presets = {	
	original: {name: 'Original', filterSet: {} },
	greyscale: {name: 'Greyscale', filterSet: { grayscale: 1} },
	seipa: {name: 'Sepia', filterSet: { sepia: 1} },
	invert: {name: 'Invert', filterSet: { invert: 1 } },
	duotone: {name: 'Duotone', filterSet: { grayscale : 1, contrast : 1 } },
	warm: {name: 'Warm', filterSet: {contrast: 1.5, brightness: 0.9}},
	cool: {name: 'Cool', filterSet: {brightness:1.1, hueRotate: '-10', sepia: .3, saturate: 1.6}},
	dramatic: {name: 'Dramatic', filterSet: {grayscale: 0.5, contrast: 0.95, brightness: 0.9}},	
};

// Apply the filters
function makeFilter(filterSet) {
	
	var filterString = "";
	// Default filters 
	var defaultValues = {		 
		grayscale: 0,
		sepia: 0,
		saturate: 1,
		hueRotate: 0,
		invert: 0,
		brightness: 1,
		contrast: 1,
		blur: 0,
		opacity: 1		
	};

	// Loop through the filter object and save it to filterString
	for (var filterFunc in filterSet) {
		if(filterSet[filterFunc] !== defaultValues[filterFunc]) {
			if(filterFunc == 'hueRotate') {
				filterString = filterString + "hue-rotate(" + filterSet[filterFunc] + "deg) ";
			}
			else if(filterFunc == 'blur') {
				filterString = filterString + filterFunc + "(" + filterSet[filterFunc] + "px) ";
			}
			else {
				filterString = filterString + filterFunc + "(" + filterSet[filterFunc] + ") ";
			}
		}
	}
	// Now return the filter property with filter value
	return "filter: " + filterString + ";";
}

// Load all filter styles to this element
let loadPresets = document.querySelector("#loadPresets");

// Get the current local storage image
let currentImage = localStorage.getItem("imgData");

// if loadPresets found then load the filter
if( loadPresets) {
	for ( preset in presets ) {
		loadPresets.innerHTML += `<div class="col-md-3"><div class="preset-item"><img src="${currentImage}" class="img-fluid change-filter" style="${makeFilter(presets[preset].filterSet)}"><span>${presets[preset].name}</span></div></div>`;
	}	
}

// Get the change filter element
let changeFilter = document.querySelectorAll(".change-filter");
// Apply the corresponding filter to the image
for (let x of changeFilter) {
	x.addEventListener("click", function() {
		let style = this.getAttribute("style");				
		let ffilterImage = document.querySelector(".filterImage").style = style;
	})
}

// Show browse button when click on "Browse for files"
$("#clicker").click(function () {
	$("#file").click();
});


// For Crop tab
$('#flip a').on('click', function () {
	var sel = $(this).data('title');
	var tog = $(this).data('toggle');
	$('#' + tog).prop('value', sel);

	$('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
	$('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
})

$('#rotate a').on('click', function () {
	var sel = $(this).data('title');
	var tog = $(this).data('toggle');
	$('#' + tog).prop('value', sel);

	$('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
	$('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
})

$('#ratio a').on('click', function () {
	var sel = $(this).data('title');
	var tog = $(this).data('toggle');
	$('#' + tog).prop('value', sel);

	$('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
	$('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
})
// For the crop tab end here

// Select the image which we want to filter 
var image = document.querySelector(".filterImage");
// Get all the "Adjust" range value
var filterControls = document.querySelectorAll("input[type=range]");
// Get the flip element
var flip = document.querySelector(".flip");

// Apply the Ratio effect
function applyRatio(ratio) {
	var ratio = ratio.getAttribute('data-value');
	console.log(ratio);
	crop(imageURL, ratio).then(canvas => {
		document.querySelector("#drawMe").appendChild(canvas);
	});
}

// Apply the flip effect
function applyFlip(flip) {
	var computedFilters = "";
	computedFilters = flip.getAttribute('data-value');
	image.style.transform = computedFilters;
}

// Apply the rotate effect
function applyRotae(flip) {
	var computedFilters = "";
	computedFilters = flip.getAttribute('data-value');
	image.style.transform = computedFilters;
}

// Apply the adjust effect
function applyAdjust() {
	var computedFilters = "";
	filterControls.forEach(function (item, index) {
		if (item.getAttribute("data-filter") != '') {
			if (item.getAttribute("data-filter") == 'drop-shadow') {
				computedFilters += item.getAttribute("data-filter") + '(' + item.value + item.getAttribute("data-scale") + ' ' + item.value + item.getAttribute("data-scale") + ' ' + item.value + item.getAttribute("data-scale") + ' ' + 'gray' + ')';
			} else {
				computedFilters += item.getAttribute("data-filter") + '(' + item.value + item.getAttribute("data-scale") + ") ";
			}
		}

	});
	image.style.filter = computedFilters;
}



function crop(url, aspectRatio) {

	// we return a Promise that gets resolved with our canvas element
	return new Promise(resolve => {
		// this image will hold our source image data
		const inputImage = new Image();
		// we want to wait for our image to load
		inputImage.onload = () => {
			// let's store the width and height of our image
			const inputWidth = inputImage.naturalWidth;
			const inputHeight = inputImage.naturalHeight;
			// get the aspect ratio of the input image
			const inputImageAspectRatio = inputWidth / inputHeight;
			// if it's bigger than our target aspect ratio
			let outputWidth = inputWidth;
			let outputHeight = inputHeight;
			if (inputImageAspectRatio > aspectRatio) {
				outputWidth = inputHeight * aspectRatio;
			} else if (inputImageAspectRatio < aspectRatio) {
				outputHeight = inputWidth / aspectRatio;
			}

			// calculate the position to draw the image at
			const outputX = (outputWidth - inputWidth) * .5;
			const outputY = (outputHeight - inputHeight) * .5;

			// create a canvas that will present the output image
			//const outputImage = document.createElement('canvas');
			const outputImage = document.createElement('canvas');

			// set it to the same size as the image
			outputImage.width = outputWidth;
			outputImage.height = outputHeight;

			// draw our image at position 0, 0 on the canvas
			const ctx = outputImage.getContext('2d');
			ctx.drawImage(inputImage, outputX, outputY);
			resolve(outputImage);
		};

		// start loading our image
		inputImage.src = url;
	})
}

let filterImage = document.querySelector(".filterImage");          
if( filterImage) {
	filterImage.src = localStorage.getItem("imgData");      
}