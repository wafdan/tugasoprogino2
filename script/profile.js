//Mainan AJAX
var xmlhttp;

function showNotif(targetid){
    xmlhttp = getXHR();
    if(xmlhttp==null){
        alert ("Browser does not support HTTP Request");
        return;
    }
    var url = "script/getnotificationajax.php"
    url = url+"?targetid="+targetid;
    xmlhttp.open("GET",url,true);
    xmlhttp.onreadystatechange = stateChanged;
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send(null);
}

function stateChanged(){
    if(xmlhttp.readyState == 4){
        var obj = document.getElementById('notifications');
        if(obj.innerHTML == ''){
            obj.innerHTML = "<fieldset class='profile-status'>\n\
                                <legend><span>Notification</span></legend>"
                                    + xmlhttp.responseText +
                             "</fieldset>";
        }else{
            obj.innerHTML = "";
        }

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

//end Mainan AJAX