	// Function to create themed buttons
	$(function() {
		$( "input:submit", ".comment, .wallpost" ).button();
		$( ".comment" ).click(function() { return false; });
	});
	
	// Tabs function
	$(function() {
		$( "#tabs" ).tabs();
	});
	