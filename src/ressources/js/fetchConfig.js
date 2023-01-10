const getConfig = async () => {
	try {
		// Set page in loading state and show loader
		const res = await fetch(
			"/config/config.php?" +
			// url search param will add in get method the param in object
			new URLSearchParams({
				fetchTheme: true, // we fetch current theme
			})
		);
		
		// wait for json response of php
		const colors = await res.json();
		
	
		if (!colors) throw "No config fetched";
		
		// We have the config object
		 
		const root = document.querySelector(":root");
		 
		if (!root) throw "Can't select :root";
		
		console.log(colors);
		Object.keys(colors).map((colorName) => {
			console.log("name: ", colorName, " hexa: ", colors[colorName]);
			root.style.setProperty(`--${colorName}-color`, colors[colorName]);
		});
	} catch(e) {
		console.log(e);
	}
};
getConfig();
