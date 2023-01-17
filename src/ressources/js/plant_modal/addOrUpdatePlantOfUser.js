const addOrUpdatePlantOfUser = async (botanicalName, quantity) => {
	if(botanicalName && quantity && parseInt(quantity, 10) == quantity && typeof botanicalname != "string") {
		let fetched = await fetch(
			"/config/config.php?" +
			new URLSearchParams({
				addOrUpdatePossededPlant: true,
				botanical_name: botanicalName,
				quantity: quantity,
			}),
			{
				method:"GET",
				credentials:"include",
			},
		);
		
		isPushed = await fetched.json();
		
		displayMessages();
		return isPushed;
	} else {
		return false;
	}
}
