var radios = document.querySelectorAll("input[type='radio']");
var customRadio = document.getElementById("custom");
var customText = document.getElementById("customInput");
if(customRadio.checked == true) {
	customText.readOnly = false;
}
for(var i = 0; i < radios.length; i++) {
	radios[i].addEventListener("click", function() {
		if(this != customRadio) {
			customText.readOnly = true;
		} else {
			customText.readOnly = false;
		}
	});
}

