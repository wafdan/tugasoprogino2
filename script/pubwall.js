//Mainan AJAX
var xmlhttp;
var xmlhttp2;
var xmlhttp3;
var xmlhttp4;
var xmlhttp5;
var xmlhttp6;

function showEntirely(userid){
    showWall(userid);
    showPhoto(userid);
    showFriends(userid);
    showInformation(userid);
}
function showWall(userid){
    xmlhttp = getXHR();
    if(xmlhttp==null){
        alert ("Browser does not support HTTP Request");
        return;
    }
    var url = "script/getpublicwallajax.php"
    url = url+"?userid="+userid;
    xmlhttp.open("GET",url,true);
    xmlhttp.onreadystatechange = wallstateChanged;
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send(null);
}
function wallstateChanged(){
    if(xmlhttp.readyState == 4){
        var obj = document.getElementById('wallcontent');
        obj.innerHTML =
        "<fieldset class='profile-status'>\n\
        <legend><span>Public Wall</span></legend>"
        + xmlhttp.responseText +
        "</fieldset>";
    }
}
function showPhoto(userid){
    xmlhttp2 = getXHR();
    if(xmlhttp2==null){
        alert ("Browser does not support HTTP Request");
        return;
    }
    var url = "script/getphotoajax.php"
    url = url+"?userid="+userid;
    xmlhttp2.open("GET",url,true);
    xmlhttp2.onreadystatechange = photostateChanged;
    xmlhttp2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp2.send(null);
}
function photostateChanged(){
    if(xmlhttp2.readyState == 4){
        var obj = document.getElementById('profile');
        obj.innerHTML = xmlhttp2.responseText;
    }
}
function showFriends(userid){
    xmlhttp3 = getXHR();
    if(xmlhttp3==null){
        alert ("Browser does not support HTTP Request");
        return;
    }
    var url = "script/getfriendsajax.php"
    url = url+"?userid="+userid;
    xmlhttp3.open("GET",url,true);
    xmlhttp3.onreadystatechange = friendstateChanged;
    xmlhttp3.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp3.send(null);
}
function friendstateChanged(){
    if(xmlhttp3.readyState == 4){
        var obj = document.getElementById('friends');
        obj.innerHTML = xmlhttp3.responseText;
    }
}
function showInformation(userid){
    xmlhttp4 = getXHR();
    if(xmlhttp4==null){
        alert ("Browser does not support HTTP Request");
        return;
    }
    var url = "script/getinformationajax.php"
    url = url+"?userid="+userid;
    xmlhttp4.open("GET",url,true);
    xmlhttp4.onreadystatechange = informationstateChanged;
    xmlhttp4.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp4.send(null);
}
function informationstateChanged(){
    if(xmlhttp4.readyState == 4){
        var obj = document.getElementById('information');
        obj.innerHTML = xmlhttp4.responseText;
    }
}
function getXHR(){
    var xmlHttpObj;
    if(window.XMLHttpRequest){
        xmlHttpObj = new XMLHttpRequest();
    }else{
        try{
            xmlHttpObj = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(e){
            try{
                xmlHttpObj=new ActiveXObject("Microsoft.XMLHTTP");
            }catch(e){
                xmlHttpObj=false;
            }
        }
    }
    return xmlHttpObj;
}
function showWallorderpop(userid){
    xmlhttp5 = getXHR();
    if(xmlhttp5==null){
        alert ("Browser does not support HTTP Request");
        return;
    }
    var url = "script/getpubwallorderpopajax.php"
    url = url+"?userid="+userid;
    xmlhttp5.open("GET",url,true);
    xmlhttp5.onreadystatechange = wallorderpopstateChanged;
    xmlhttp5.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp5.send(null);
}
function wallorderpopstateChanged(){
    if(xmlhttp5.readyState == 4){
        var obj = document.getElementById('wallcontent');
        obj.innerHTML =
        "<fieldset class='profile-status'>\n\
        <legend><span>Popular Posts</span></legend>"
        + xmlhttp5.responseText +
        "</fieldset>";
    }
}

//end Mainan AJAX