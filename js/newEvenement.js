function toggleSelect(nb){
	let poiteur = document.getElementsByClassName('evenement-card');
	for (let i = 0; i < poiteur.length; i++) {
		if (i == nb) {
			let myElement = poiteur[i];
			myElement.classList.add("current");
			return nb;
		}else {
			let myElement = poiteur[i];
			let title = document.getElementById('current-tittle');
			let creator = document.getElementById('current-creator');
			let date = document.getElementById('current-date-eve');
			title.textContent=poiteur[nb].getElementsByClassName('card-name')[0].textContent;
			creator.textContent=poiteur[nb].getElementsByClassName('card-creator')[0].innerHTML;
			date.textContent=poiteur[nb].getElementsByClassName('card-date')[0].innerHTML;
			myElement.classList.remove("current");
			return -1;
		}
	}

	let title = document.getElementById('current-tittle');//poiteur[nb].getElementsByClassName('card-name')[0].innerHTML;
	let creator = document.getElementById('current-creator');//poiteur[nb].getElementsByClassName('card-creator')[0].innerHTML;
	let date = document.getElementById('current-date-eve');//poiteur[nb].getElementsByClassName('card-date')[0].innerHTML;
	alert('Titre = '+title.textContent);
	title.textContent='Paragraphe créé et inséré grâce au JavaScript';
}