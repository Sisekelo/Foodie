function showNotice(icon){

  var d = parseInt(document.getElementById("amount").innerHTML);
  var e = document.getElementById("zero").checked;
  var f = parseInt(document.getElementById("amount2").innerHTML);



  if(icon == "icons" && d !== 0 ){
      document.getElementById("message").style.display="none";
      document.getElementById("notification").style.display="block";
      
      document.getElementById("notification").style.visibility="visible";
    }
  else if(icon == "icons2" && f !==0 && e === false){
      document.getElementById("message2").style.display="none";
      document.getElementById("notification2").style.display="block";
      document.getElementById("notification2").style.visibility="visible";
  }
}

function Payment(range){
  setTimeout(function(){

    var peter = document.getElementById(range).value;

    if(peter < 90){

      document.getElementById(range).value =1
    }
    else if(peter > 90){

      if(range == "myRange"){

        document.getElementById("first").style.display = "none";
        document.getElementById("second").style.display = "block";
        document.getElementById(range).style.display ="none";
        document.getElementById(range).value =5;
        document.getElementById("amount2").innerHTML = document.getElementById("amount").innerHTML;
      }

      else if(range == "myRange1"){

        document.getElementById("second").style.display = "none";
        document.getElementById("third").style.display = "block";
        document.getElementById(range).style.display ="none";

        document.getElementById(range).value =5;

        document.getElementById("amount3").innerHTML = document.getElementById("amount2").innerHTML;
        document.getElementById("confirmFood").innerHTML = document.querySelector('input[name="food"]:checked').id+" panini";
        document.getElementById("confirmFoodPic").src = "img/"+document.querySelector('input[name="food"]:checked').id+".png";

        var checks = document.getElementsByClassName('flavour');
        var str = '';
        for (i = 0; i < 4; i++){
          if (checks[i].checked === true){
              str += checks[i].id + " ";
            }
        };

        document.getElementById("confirmFoodFlav").innerHTML = str;
        document.getElementById("confirmDrink").innerHTML = document.querySelector('input[name="drink"]:checked').id;
        document.getElementById("confirmDrinkPic").src = "img/"+document.querySelector('input[name="drink"]:checked').id+".png";
      }
      else if(range == "myRange2"){

        document.getElementById(range).value =5;
        document.getElementById("third").style.display = "none";

        var amountcheck = document.getElementById("amount3").innerHTML;
        parseInt(amountcheck);
        if(amountcheck != 0){

          document.getElementById("lastmeal").value = document.getElementById("confirmFood").innerHTML;
          document.getElementById("lastflavour").value = document.getElementById("confirmFoodFlav").innerHTML;
          document.getElementById("lastdrink").value = document.getElementById("confirmDrink").innerHTML;
          document.getElementById("lastamount").value = document.getElementById("amount3").innerHTML;
          document.getElementById("finalform").submit();
        }
        else{
          alert("baba choose something light")
        }
      }
    };
  },1000)
}

function tellme(id){


  document.getElementById("chilli").checked = false;
  document.getElementById("cheese").checked = false;
  document.getElementById("onion").checked = false;
  document.getElementById("tomato").checked = false;


  var value = document.getElementById(id).value;
  var valueLast = document.getElementById("amount").innerHTML;
  valueLast = parseInt(valueLast);
  value = parseInt(value);

  if(id == "nothing"){
      document.getElementById("amount").innerHTML = value;
      var x = document.getElementById(id).parentElement.id;
      var y = x.slice(0,5);
      if(y == "icons"){
        document.getElementById("message").style.display="block";
        document.getElementById("notification").style.display="none";
        document.getElementById("top").innerHTML = "You dont want anything to eat?";
        document.getElementById("top2").innerHTML = "Slide to choose a drink";
      }
      else if(z == "icons2"){
        document.getElementById("essage2").style.display="block";
        document.getElementById("notification2").style.display="none";
        document.getElementById("top").innerHTML = "You dont want anything to drink?";
        document.getElementById("top2").innerHTML = "Slide to choose a confirm your meal";
      }
      showSlide();

  }
  else{
      document.getElementById("myRange").style.display ="none";
        if(valueLast < 100){
            document.getElementById("amount").innerHTML = value+valueLast;
        }
        document.getElementById("flavour").innerHTML = document.getElementById(id).id;
    }
  }

function tellthem(id){

  var value = document.getElementById(id).value;
  var valueLast = document.getElementById("amount2").innerHTML;
  valueLast = parseInt(valueLast);
  value = parseInt(value);
  z = "icons2"

  
  if(id == "zero"){
    
    if(valueLast == 50 || valueLast == 150){
      document.getElementById("amount2").innerHTML = valueLast - 50;
    }
      if(z == "icons2"){
        document.getElementById("message2").style.display="block";
        document.getElementById("notification2").style.display="none";
        document.getElementById("top3").innerHTML = "You dont want anything to drink?";
        document.getElementById("top4").innerHTML = "Slide to confirm your drink";
        showNotice(z);
        return
        
      }

  }
  else{

  if(valueLast == 100 || valueLast == 0){
      document.getElementById("amount2").innerHTML = value+valueLast;
      }
      document.getElementById("drink_choice").innerHTML = document.getElementById(id).id;
      showNotice(z);
  }
}

function showSlide(){

      document.getElementById("myRange").style.display ="block"
 }

 function goback(page){
    if(page == "page3"){
      document.getElementById("second").style.display = "block";
      document.getElementById("third").style.display = "none";
      document.getElementById("myRange1").style.display ="block";
    }
    else if(page == "page25" || page == "page2" ){
      document.getElementById("first").style.display = "block";
      document.getElementById("second").style.display = "none";
      document.getElementById("myRange").style.display ="block";
    }
 }
 
function changeClass(){
  document.getElementsByClassName("sidebar")[0].className += " active"
}

function cancel(){
  document.getElementsByClassName("sidebar active")[0].className = "sidebar"
}