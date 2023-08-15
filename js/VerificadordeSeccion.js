if(sessionStorage.getItem("Usuario" != '') && sessionStorage.getItem("Privilegios" != '')){
    sessionStorage.setItem("SeccionPermitida",true);
}else{
    location.href ='../index.html';

}