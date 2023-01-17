const addOrUpdatePlantOfUser = async (botanicalName, quantity) => {
	return new Promise((resolve) => setTimeout(resolve, 1000));
	
	if(botanicalName && quantity) {
		let fetched = await fetch(
			"/config/config.php?" +
			new URLSearchParams({
				addOrUpdatePlantOfUser: true,
				botanical_name: botanicalName,
				quantity: quantity,
			}),
			{
				method:"GET",
				credentials:"include",
			},
		);
		
		return await fetched.json();
	} else throw "mauvaises données en paramètre";
}
