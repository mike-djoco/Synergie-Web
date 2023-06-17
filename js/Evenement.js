function toggleSelect(nb){
	let poiteur = document.getElementsByClassName('evenement-card');
	for (let i = 0; i < poiteur.length; i++) {
		if (i == nb) {
			let myElement = poiteur[i];
		}else {
			let myElement = poiteur[i];
			let title = document.getElementById('current-tittle');
			let creator = document.getElementById('current-creator');
			let date = document.getElementById('current-date-eve');
			let info = document.getElementById('current-information');
			let id = document.getElementById('current-idEvent');
			title.textContent = poiteur[nb].getElementsByClassName('card-name')[0].textContent;
			creator.textContent = 'Créer par : '+poiteur[nb].getElementsByClassName('card-creator')[0].innerHTML;
			date.textContent = 'Il aura lieux le : '+poiteur[nb].getElementsByClassName('card-date')[0].innerHTML;
			info.textContent = poiteur[nb].getElementsByClassName('card-info')[0].innerHTML;
			id.textContent = poiteur[nb].getElementsByClassName('card-id')[0].innerHTML;


			let idSauv = document.getElementById('idEve').value = id.textContent;
			var idEveInput = document.getElementById('idEve');
			idEveInput.value = document.getElementById('idEve').value;
		}
	}
}

