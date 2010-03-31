var url = 'chat/chatController.php';

function initAjax() {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	return xmlhttp;
}

function sendChat() {
	xmlhttp = initAjax();	
	
	sender = document.getElementById('chatsender').value;
	recver = document.getElementById('chatrecver').value;
	message = document.getElementById('chatmessage').value;
	
	postdata = "action=send&sender=" + sender + "&receiver=" + recver + "&message=" + message;
	document.getElementById('chatmessage').value = "";
	
	xmlhttp.open("POST", url, true);
	
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", postdata.length);
	xmlhttp.setRequestHeader("Connection", "close");
	
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById('chatbox').innerHTML += "--\n<b>You:</b> " + xmlhttp.responseText;
		}
	}
	
	xmlhttp.send(postdata);
}

function chatPoll() {
	xmlhttp = initAjax();
	
	sender = document.getElementById('chatsender').value;
	recver = document.getElementById('chatrecver').value;
	postdata = "action=poll&sender=" + sender + "&receiver=" + recver;
	
	xmlhttp.open("POST", url, true);
	
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", postdata.length);
	xmlhttp.setRequestHeader("Connection", "close");
	
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			if(xmlhttp.responseText != "") {
				document.getElementById('chatbox').innerHTML += "--\n<b>Friend:</b> " + xmlhttp.responseText;
			}
		}
	}
	
	xmlhttp.send(postdata);
}

function startPoll() {
	chatPoll();
	loop = setTimeout("startPoll()", 2000);
}

function checkEnter(e) {
	// look for window.event in case event isn't passed in
	if (window.event) {
		e = window.event;
	}
	
	if (e.keyCode == 13) {
			document.getElementById('chatsend').click();
	}
}