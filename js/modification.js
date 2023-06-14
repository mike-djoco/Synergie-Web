document.addEventListener("DOMContentLoaded", setup);

function setup() {
	document.getElementById("bcontact").addEventListener("click", opencontact);
	document.getElementById("closes").addEventListener("click", closecontact);
}

function toggleForm(String direction){
	let element = document.getElementById("goToInfo");
	element.classList.remove("current");
	element = document.getElementById("goToMDP");
	element.classList.remove("current");
	element = document.getElementById("goToMail");
	element.classList.remove("current");
	element = document.getElementById("goToRole");
	element.classList.remove("current");

	if (direction == "goToInfo") {
		element = document.getElementById("goToInfo");
		element.classList.add("current");
	}else if (direction == "goToMDP") {
		element = document.getElementById("goToMDP");
		element.classList.add("current");
	}else if (direction == "goToMail") {
		element = document.getElementById("goToMail");
		element.classList.add("current");
	}else if (direction == "goToRole") {
		element = document.getElementById("goToRole");
		element.classList.add("current");
	}
}
