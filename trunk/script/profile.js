//Mainan AJAX
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

function getNotif(){
    if(!getXHR){
        return;
    }
    var notif;
    
}

//end Mainan AJAX