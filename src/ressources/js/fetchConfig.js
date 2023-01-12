const getConfig = async () => {
	try {
		
		const root = document.querySelector(":root");
		 
		if (!root) throw "Can't select :root";
		
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
		
		Object.keys(colors).map((colorName) => {
			root.style.setProperty(`--${colorName}-color`, colors[colorName]);
		});
	} catch(e) {
		console.log(e);
	}
};

getConfig();
