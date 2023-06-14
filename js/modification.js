
document.addEventListener("DOMContentLoaded", setup);

function setup() {
	document.getElementById("goToInfoCall").addEventListener("click", toggleInfo;
	document.getElementById("goToMDPCall").addEventListener("click", toggleMDP;
	document.getElementById("goToMailCall").addEventListener("click", toggleMail;
	document.getElementById("goToRoleCall").addEventListener("click", toggleRole;
}

function toggleInfo(event){
	document.getElementById("goToInfo").classList.remove("current");
	document.getElementById("goToMDP").classList.remove("current");
	document.getElementById("goToMail").classList.remove("current");
	document.getElementById("goToRole").classList.remove("current");

	document.getElementById("goToInfo").classList.add("current");
}

function toggleMDP(event){
	document.getElementById("goToInfo").classList.remove("current");
	document.getElementById("goToMDP").classList.remove("current");
	document.getElementById("goToMail").classList.remove("current");
	document.getElementById("goToRole").classList.remove("current");

	document.getElementById("goToInfo").classList.add("current");
}

function toggleMail(event){
	document.getElementById("goToInfo").classList.remove("current");
	document.getElementById("goToMDP").classList.remove("current");
	document.getElementById("goToMail").classList.remove("current");
	document.getElementById("goToRole").classList.remove("current");

	document.getElementById("goToInfo").classList.add("current");
}

function toggleRole(event){
	document.getElementById("goToInfo").classList.remove("current");
	document.getElementById("goToMDP").classList.remove("current");
	document.getElementById("goToMail").classList.remove("current");
	document.getElementById("goToRole").classList.remove("current");

	document.getElementById("goToInfo").classList.add("current");
}