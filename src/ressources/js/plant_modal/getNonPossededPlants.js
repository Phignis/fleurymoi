const getNonPossededPlants = async () => {
	let fetched = await fetch(
		"/config/config.php?" +
		new URLSearchParams({
			getNonPossededPlants: true,
		}),
		{
			method: "GET",
			credentials: "include",
		},
	);
	
	let listPlant = await fetched.json();
	
	console.log(listPlant);
}
