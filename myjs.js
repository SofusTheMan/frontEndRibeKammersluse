function removeBoat() {
	var boatAmountText = document.getElementById("multiBoatDivText");
	let boatAmountInt = parseInt(boatAmountText.textContent);

	if(boatAmountInt <= 2) {

	} else {
		boatAmountInt--;
		boatAmountText.textContent = boatAmountInt.toString();
		document.getElementById("dynamicPrice").innerHTML = 50 * boatAmountInt + " kr.";
	}

}

function addBoat() {
	var boatAmountText = document.getElementById("multiBoatDivText");
	let boatAmountInt = parseInt(boatAmountText.textContent);

	boatAmountInt++;
	boatAmountText.textContent = boatAmountInt.toString();
	document.getElementById("dynamicPrice").innerHTML = 50 * boatAmountInt + " kr.";
}