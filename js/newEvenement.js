function toggleSelect(nb){
	let poiteur = document.getElementsByClassName('evenement-card');
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