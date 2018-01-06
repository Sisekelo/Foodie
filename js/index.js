function closeme(){
  console.log('dance');
  document.getElementById("MessageRow").style.display = "none";
}


function signup_login(id){
  if(id=="signingup"){
    document.getElementById("signup").style.display="block";
    document.getElementById("login").style.display="none"
  }
  else{
    document.getElementById("signup").style.display="none";
    document.getElementById("login").style.display="block"

  }
}

function onSignIn(googleUser) {
      
        var profile = googleUser.getBasicProfile();
        document.getElementById("email").value = profile.getEmail();
       document.getElementById("name1").value = profile.getGivenName();
        document.getElementById("surname1").value = profile.getFamilyName();
        document.getElementById("picNew").value = profile.getImageUrl();
        document.getElementById("clickMe").click();
        return;
      }

function FixNumber(){

var ori_number = document.getElementById("number").value;

if(ori_number.slice(0,1) === 0 && ori_number !== ""){
  var change = ori_number.slice(1,10);
  var latest = "+27"+change;
  document.getElementById("number").value = latest;
}

}


$("#login-button").click(function(event){
     event.preventDefault();
   
   $('form').fadeOut(500);
   $('.wrapper').addClass('form-success');
});