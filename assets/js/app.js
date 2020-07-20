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

const imgUploaded = document.querySelector('.imgUploaded');
const loadImage = document.querySelector('#load-image');


function uploadFile(files) {

	let url = 'process-file.php'
	let formData = new FormData();
	let allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

	for (const [key, value] of Object.entries(files)) {
		let extension = value.name.split(".").pop();
		if (allowedExt.includes(extension) == false) {
			alert('Invalid file formate, we are only accepting ' + allowedExt.join(", ") + ' file formates');
			return false;
		}
		formData.append('files', value);
		previewFile(value, value.name);
	}

	fetch(url, {
		method: 'POST',
		body: formData,
	})
		.then((data) => {
			console.log( data );
		})
		.catch((error) => {
			console.log(error);
		})

}

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


window.addEventListener('load', doFilter );

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


function makeFilter(filterSet) {
	
	var filterString = "";
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
	return "filter: " + filterString + ";";
}

let loadPresets = document.querySelector("#loadPresets");
let currentImage = localStorage.getItem("imgData");
if( loadPresets) {
	for ( preset in presets ) {
		loadPresets.innerHTML += `<div class="col-md-3"><div class="preset-item"><img src="${currentImage}" class="img-fluid change-filter" style="${makeFilter(presets[preset].filterSet)}"><span>${presets[preset].name}</span></div></div>`;
	}	
}


let changeFilter = document.querySelectorAll(".change-filter");
for (let x of changeFilter) {
	x.addEventListener("click", function() {
		let style = this.getAttribute("style");				
		let ffilterImage = document.querySelector(".filterImage").style = style;
	})
}




// for ( let count = 0; count < 8;l  ) {

// 	loadPresets.innerHTML = `<img src="${currentImage}" style="${ makeFilter( value ) }">`;
// }

// for( const [ key, value ] in Object.entries(presets()) ) {
// 	console.log( value );
// 	//console.log( makeFilter(preset.filterSet ) );
// 	//loadPresets.innerHTML = `<img src="${currentImage}" style="filter:${makeFilter(preset.filterSet)}">`;
// }

$("#clicker").click(function () {
	$("#file").click();
});


// const status = document.getElementById('status');
// const output = document.getElementById('output');
// if (window.FileList && window.File && window.FileReader) {

// 	document.getElementById('file-selector').addEventListener('change', event => {

// 	output.src = '';
// 	status.textContent = '';

// 	const file = event.target.files[0];

// 	if (!file.type) {
// 		status.textContent = 'Error: The File.type property does not appear to be supported on this browser.';
// 		return;
// 	}

// 	if (!file.type.match('image.*')) {
// 		status.textContent = 'Error: The selected file does not appear to be an image.'
// 		return;
// 	}

// 	const reader = new FileReader();
// 	reader.addEventListener('load', event => {
// 		output.src = event.target.result;
// 	});
// 	reader.readAsDataURL(file);
// }); 





$('.nav-tabs a').on('shown.bs.tab', function () {
	alert('The new tab is now fully shown.');
});


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


var image = document.querySelector(".filterImage");
var filterControls = document.querySelectorAll("input[type=range]");
var flip = document.querySelector(".flip");

function applyRatio(ratio) {
	var ratio = ratio.getAttribute('data-value');
	console.log(ratio);
	crop(imageURL, ratio).then(canvas => {
		document.querySelector("#drawMe").appendChild(canvas);
	});
}

function applyCrop(flip) {
	var computedFilters = "";
	computedFilters = flip.getAttribute('data-value');
	image.style.transform = computedFilters;
}

function applyFilter() {
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


//let imageURL = document.querySelector("#filterMe").getAttribute("src");



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
	


function download_image(){
  // var canvas = document.getElementById("mcanvas");   
  // canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");

  // var link = document.createElement('a');
  // link.download = "my-image.png";
  // link.href = document.querySelector(".filterImage").src;
  // link.click();
}

function callMe() {
	
}

callMe();

