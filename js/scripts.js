var current_page = 1;


function start_load()
	{
		$("#monitor").load("demo.php", "current_page="+current_page);
		document.getElementById("to_back").style.display = "none";
	}

function next_page()
	{
		var read_all_page = document.getElementById("display_all_page").value;
		if (current_page < read_all_page) {
			document.getElementById("waiting").style.display = "block";
			document.getElementById("load_all").style.display = "none";
			current_page++;
			start_load();			
		}
		if (current_page == read_all_page) {
			document.getElementById("to_next").style.display = "none";
			}
		else {
				document.getElementById("to_next").style.display = "block";
			}
		if (current_page == 1)	{
				document.getElementById("to_back").style.display = "none";
			}
		else {
				document.getElementById("to_back").style.display = "block";
			}
	}
	
function back_page()
	{
		if (current_page > 1) {
			document.getElementById("waiting").style.display = "block";
			document.getElementById("load_all").style.display = "none";
			current_page--;
			start_load();
		}
		var read_all_page = document.getElementById("display_all_page").value;
		if (current_page == read_all_page) {
			document.getElementById("to_next").style.display = "none";
			}
		else {
				document.getElementById("to_next").style.display = "block";
			}
		if (current_page == 1)	{
				document.getElementById("to_back").style.display = "none";
			}
		else {
				document.getElementById("to_back").style.display = "block";
			}
	}
	
function reload_page()
	{
		document.getElementById("waiting").style.display = "block";
		document.getElementById("load_all").style.display = "none";
		current_page = document.getElementById("display_current_page").value;
		start_load();
		var read_all_page = document.getElementById("display_all_page").value;
		if (current_page == read_all_page) {
				document.getElementById("to_next").style.display = "none";
				}
		else {
				document.getElementById("to_next").style.display = "block";
			}
		if (current_page == 1)	{
					document.getElementById("to_back").style.display = "none";
				}
		else {
				document.getElementById("to_back").style.display = "block";
			}
	}