function toggleSwitcher() {
  var t = document.getElementById("style-switcher");
  "-165px" === t.style.left
    ? (t.style.left = "-0px")
    : (t.style.left = "-165px");
}
function setColor(t) {
  (document.getElementById("bootstrap-style").href =
    "Css/bootstrap-" + t + ".min.css"),
    (document.getElementById("app-style").href = "Css/app-" + t + ".min.css");
    const userID = document.getElementById("memoUserID").innerText
    $.ajax({
      url : "Requires/ajax_user_theme.php",
      data : {"id":userID,"type":"update1","color":t},
      type : "POST",
      // success : function(result){
      //  if(result == "success"){
      //   toastr.success("Your theme has been updated")
      //  }else{
      //   toastr.error("Sorry for the error, please try again")
      //  } 
      // }
    })
}
function setColorGreen() {//should be purple color, havent change file name
  (document.getElementById("bootstrap-style").href = "Css/bootstrap.min.css"),
    (document.getElementById("app-style").href = "Css/app.min.css");
    const userID = document.getElementById("memoUserID").innerText
    $.ajax({
      url : "Requires/ajax_user_theme.php",
      data : {"id":userID,"type":"update1","color":"purple"},
      type : "POST",
      // success : function(result){
      //  if(result == "success"){
      //   toastr.success("Your theme has been updated")
      //  }else{
      //   toastr.error("Sorry for the error, please try again")
      //  } 
      // }
    })
    
}
var btn = document.getElementById("mode");
btn.addEventListener("click", function (t) {
  var e = localStorage.getItem("theme");

  const userID = document.getElementById("memoUserID").innerText
    $.ajax({
      url : "Requires/ajax_user_theme.php",
      data : {"id":userID,"type":"update2","color":e},
      type : "POST",
      // success : function(result){
      //  if(result == "success"){
      //   toastr.success("Your theme has been updated")
      //  }else{
      //   toastr.error("Sorry for the error, please try again")
      //  } 
      // }
    })

  "light" == e || "" == e
    ? (document.body.setAttribute("data-layout-mode", "dark"),
      localStorage.setItem("theme", "dark"))
    : (document.body.removeAttribute("data-layout-mode"),
      localStorage.setItem("theme", "light"));
});
var mybutton = document.getElementById("back-to-top");
function scrollFunction() {
  100 < document.body.scrollTop || 100 < document.documentElement.scrollTop
    ? (mybutton.style.display = "block")
    : (mybutton.style.display = "none");
}
function topFunction() {
  (document.body.scrollTop = 0), (document.documentElement.scrollTop = 0);
}
window.onscroll = function () {
  scrollFunction();
};
var preloader = document.getElementById("preloader");
window.addEventListener("load", function () {
  (preloader.style.opacity = "0"), (preloader.style.visibility = "hidden");
});
for (
  var favouriteBtn = document.getElementsByClassName("bookmark-btn"), i = 0;
  i < favouriteBtn.length;
  i++
) {
  var favouriteBtns = favouriteBtn[i];
  favouriteBtns.onclick = function () {
    favouriteBtns.classList.toggle("active");
  };
}

window.addEventListener("load", function(){
  const userID = document.getElementById("memoUserID").innerText
  $.ajax({
    url : "Requires/ajax_user_theme.php",
    data : {"id":userID,"type":"retrieve"},
    type : "POST",
    success : function(result){
      data = JSON.parse(result)
      
      ar1 = data["user_theme1"].toLowerCase()
      ar2 = data["user_theme2"].toLowerCase()
      

      if(ar1 == "blue"){
        setColor('blue')
      }else if(ar1 == "green"){
        setColor('green')
      }else if(ar1 == "purple"){
        setColorGreen()
      }

      if(ar2 == "dark"){
        document.body.setAttribute("data-layout-mode", "dark")
        localStorage.setItem("theme", "dark")
      }else{
        document.body.removeAttribute("data-layout-mode"),
        localStorage.setItem("theme", "light")
      }
    }

  })
  
});
