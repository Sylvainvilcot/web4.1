window.onload = (() => {
	var form = document.getElementById('form');
	var select = document.getElementById("enfant");
	var container = document.querySelector(".container");


	select.onchange = (() => {

		var element = document.createElement("div");
		element.id = "prenom";

		if(document.getElementById("prenom") != null) {
			document.getElementById("prenom").remove();
		}

		for(let i = 0 ; i < select.value ; i++) {
			var div = document.createElement("div");
			div.innerHTML = "<label for='nom'>Prenom enfant "+ (i+1) +"</label> <input type='text' id='nom' name='prenom' placeholder='Saisir prénom'>";
			element.appendChild(div);			
			container.appendChild(element);
		}
	});
});