function closeObject(id) {
  document.getElementById(id).style.display = 'none';
}

function openObject(id) {
  document.getElementById(id).style.display = 'block';
}

function openClose(id){
	if (document.getElementById(id).style.display == 'block'){
		closeObject(id);
		$("#" + id).addClass("oculto");
	}else{
		openObject(id);
		$("#" + id).removeClass("oculto");
	}
}

function cleanString(aString){
	return String(aString).replace(/(\r\n|\n|\r)/gm, "");
}

function IsCellphone(cellphone) {
  var regex = /^([0-9+])+$/;
  return regex.test(cellphone);
}

function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function home(){
	document.location.href = "./index.php";
}