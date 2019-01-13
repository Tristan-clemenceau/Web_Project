 function menu() {
		 document.getElementById("test").style.visibility = "hidden";
		 document.getElementById("cross").style.visibility = "visible";
		 document.getElementById("mid_box").style.visibility ="visible";
}
function cross(){
		 document.getElementById("cross").style.visibility = "hidden";
		 document.getElementById("test").style.visibility = "visible";
		 document.getElementById("mid_box").style.visibility ="hidden";
}
function left_Arrow(){
		document.getElementById("formulaire").style.visibility="hidden";
		document.getElementById("login").style.visibility="hidden";
		document.getElementById("register").style.visibility="hidden";
		document.getElementById("left_arrow").style.visibility="hidden";
}
function display(argument){
		cross();
		document.getElementById("formulaire").style.visibility="visible";
		document.getElementById("left_arrow").style.visibility="visible";
		if (argument=='login') {
			document.getElementById("login").style.visibility="visible";
			document.getElementById("register").style.visibility="hidden";
		}else if(argument=='register'){
			document.getElementById("login").style.visibility="hidden";
			document.getElementById("register").style.visibility="visible";
		}else{
			alert('exception');
		}
}