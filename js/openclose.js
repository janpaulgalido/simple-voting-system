function openNav() {
    document.getElementById("mySidenav").style.left = "0px";
    document.getElementById("mySidenav").style.transition = "0.5s ease";
    document.getElementById("main").style.marginLeft = "250px";
    document.getElementById("main").style.transition = "0.5s ease";
    document.getElementById("hamburger").style.opacity = '0';
    }

function closeNav() {
      document.getElementById("mySidenav").style.left = "-250px";
      document.getElementById("mySidenav").style.transition = "0.5s ease";
      document.getElementById("main").style.marginLeft= "0";
      document.getElementById("main").style.transition= "0.5s ease";
      document.getElementById("hamburger").style.opacity = '1';
    }
    window.onload = function() {
    document.getElementById("hamburger").style.opacity = '0';
    window.setTimeout(closeNav, 500); //.5 seconds
    window.setTimeout(openNav, 500); //.5 seconds
    }


     /** $(document).ready(function() {
      $("a").click(function(){
        $(this).addClass('active').siblings().removeClass('active');
      });
  });**/