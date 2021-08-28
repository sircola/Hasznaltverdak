/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function Ujra( mennyi, maxcnt ) {
  
    urlParams = new URLSearchParams(window.location.search);

    honnan = urlParams.get('honnan');

    if( honnan == null )
        honnan = 0;
    else
        honnan = parseInt(honnan);
 
    honnan = honnan + mennyi;

    if( honnan > maxcnt - mennyi )
        honnan = maxcnt - mennyi;

    if( honnan < 0 )
        honnan = 0;

    window.location.href="?honnan="+honnan;
}


function regEllenorzes() {
    
    varos=document.getElementById("ui1");
    if(varos.value.length<1){
        document.getElementById("ue1").innerHTML="!";
        varos.value="";
        varos.focus();
        return;
    }    
    
    pw1=document.getElementById("ui3");
    pw2=document.getElementById("ui4");
    if(pw1.value!=pw2.value||pw1.value.length==0||pw2.value.length==0){
        pw1.value=""; pw2.value="";
        pw1.focus();
        return;
    }
    
    email=document.getElementById("ui5");
    minta=new RegExp("^\\w+(\\.\\w+)*@\\w+(\\.\\w+)*\\.\\w{2,6}$");
    if(!minta.test(email.value)){
        email.value="";
        email.focus();
        return;
    }
    
    document.forms[0].submit();
}


function jarmuEllenorzes() {
    
    kep1=document.getElementById("ui1");
    if(kep1.value.length<1){
        document.getElementById("ue1").innerHTML="!";
        kep1.value="";
        kep1.focus();
        return;
    }    

    tipus=document.getElementById("ui4");
    if(tipus.value.length<1){
        document.getElementById("ue4").innerHTML="!";
        tipus.value="";
        tipus.focus();
        return;
    }    

    szin=document.getElementById("ui5");
    if(szin.value.length<1){
        document.getElementById("ue5").innerHTML="!";
        szin.value="";
        szin.focus();
        return;
    }    
    
    evjarat=document.getElementById("ui6");
    if(evjarat.value.length<1||isNaN(evjarat.value)){
        document.getElementById("ue6").innerHTML="!";
        evjarat.value="";
        evjarat.focus();
        return;
    }    
    
    muszaki=document.getElementById("ui7");
    if(muszaki.value.length<1||isNaN(muszaki.value)){
        document.getElementById("ue7").innerHTML="!";
        muszaki.value="";
        muszaki.focus();
        return;
    }    

    kilometer=document.getElementById("ui8");
    if(kilometer.value.length<1||isNaN(kilometer.value)){
        document.getElementById("ue8").innerHTML="!";
        kilometer.value="";
        kilometer.focus();
        return;
    } 
    
    ar=document.getElementById("ui9");
    if(ar.value.length<1||isNaN(ar.value)){
        document.getElementById("ue9").innerHTML="!";
        ar.value="";
        ar.focus();
        return;
    } 
  
    document.forms[0].submit();
}


function askTorles(num) {
    if(confirm("Törli a járművet?"))
        document.forms[num].submit();
}

function keresesEllenorzes() {
    
    kereso=document.getElementById("kereso");
    if(kereso.value.length<1){
        kereso.value="";
        kereso.focus();
        return;
    }    
 
    document.forms["kereso"].submit();
}