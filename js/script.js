var select = "tab1";
var displ = "mynotes"

function show(a,b)
{
	document.getElementById(select).style.backgroundColor = "rgb(204, 204, 204)";
	document.getElementById(displ).style.display = "none";

	document.getElementById(a).style.backgroundColor = "rgb(238, 238, 238)";
	document.getElementById(b).style.display = "block";

	select = a;
	displ = b;
}