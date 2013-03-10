	/* Text Area Auto Grow Function */
		function CheckTextareaFieldSize(postid) {
		// If the number of characters in the textarea 
		//    field exceeds the col number multiplied 
		//    by the row number minus one, add another 
		//    row to the field.
		// Customize with form name and field name, both 
		//    in 4 places.
		var fname = "comment" + postid;
		var ic = document.forms[fname].comment.cols;
		var ir = document.forms[fname].comment.rows;
		var j = document.forms[fname].comment.value.length;
		var k = ic * (ir - 1);
		if(j > k) {
		   document.forms[fname].comment.rows = (ir + 1);
		   }
		}	