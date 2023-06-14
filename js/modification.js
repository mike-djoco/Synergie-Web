

function toggleInfo(nb){
	let poiteur = document.getElementsByClassName('modification-form');
	for (let i = 0; i < poiteur.length; i++) {
		if (i == nb) {
			let myElement = poiteur[i];
			myElement.classList.add("current");
		}else {
			let myElement = poiteur[i];
			myElement.classList.remove("current");
		}
	}
}
