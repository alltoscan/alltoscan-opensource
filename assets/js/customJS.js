function myFunction() {
    var element = document.getElementById('focus');
    element.classList.toggle("dark-mode");
  
    var x = document.getElementById("btnValue");
    if (x.innerHTML === "Dark mode") {
      x.innerHTML = "Light mode";
      x.classList.remove('btn-dark')
      x.classList.toggle('btn-light')
    } else {
      x.innerHTML = "Dark mode";
      x.classList.remove('btn-light')
      x.classList.toggle('btn-dark')
    }
  
  }

function copyTextFromSpan() {
    var text = $("#copyAddress").text();
    var tempInput = $("<input>");
    $("body").append(tempInput);
    tempInput.val(text).select();
    document.execCommand("copy");
    tempInput.remove();
    var copyToastMsg = document.getElementById("CopyMessage");
    var toast = new bootstrap.Toast(copyToastMsg);
    toast.show();
}

$("#copy-button").click(function () {
    copyTextFromSpan();
});

$( document ).ready(function() {
    $("a.advertiseImage").click(function() {
        var imageName = $(this).data("resim");
        var imagePath = "assets/img/advertise/" + imageName;
        $("#advertiseModal .modal-body img").attr("src", imagePath);
        $("#advertiseModal").modal("show");
    });

    $('#back-to-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
        return false;
    });

    $("#freeNameSearchInput").keyup(function() {
        var domainAdresi = $(this).val();
        var regex = /^([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,}$/i;
        if (regex.test(domainAdresi)) {
          console.log("The domain address is valid.");
        } else {
          console.log("The domain address is not valid.");
        }
    });
    
    $('form#freeNameSearchForm').submit(function(e) {
        e.preventDefault();
        var domain = $("#freeNameSearchInput").val().trim(); // We take the value in the input field and delete the leading and trailing spaces
        if (/^[a-zA-Z0-9._-]+$/.test(domain)) { // regular expression of allowed characters for domain name
          var url = "/freename/" + domain; // we create the url
          window.location.href = url; // we redirect the page to the url we created
        } else {
            alert("Invalid domain name!"); // We show a warning message to the user if the domain name contains characters that are not allowed
        }
    });
    
      
});


$(document).ready(function() {

  $('#searchButtonDesktop').click(function() {
    var searchInput = $('#txtSearchInputDesktop').val(); // Get value of input field

    if (searchInput === '') {
      // if empty
      return;
    }
  });
  $('#searchButtonMobile').click(function() {
    var searchInput = $('#txtSearchInputMobile').val(); // Get value of input field

    if (searchInput === '') {
      // if empty
      return;
    }
  });

  $("#tick2").html($("#tick").html());

    var temp = 0,
        intervalId = 0;
    $("#tick li").each(function() {
        var offset = $(this).offset();
        var offsetLeft = offset.left;
        // $(this).css({'left':offsetLeft+temp});
        $(this).css({
            left: temp
        });
        temp = $(this).width() + temp + 40;
    });
    $("#tick").css({
        width: temp + 40,
        "margin-left": "20px"
    });
    temp = 0;
    $("#tick2 li").each(function() {
        var offset = $(this).offset();
        var offsetLeft = offset.left;
        $(this).css({
            left: temp
        });
        temp = $(this).width() + temp + 40;
    });
    $("#tick2").css({
        width: temp + 40,
        "margin-left": temp + 40
    });

    function abc(a, b) {
        var marginLefta = parseInt($("#" + a).css("marginLeft"));
        var marginLeftb = parseInt($("#" + b).css("marginLeft"));
        if (-marginLefta <= $("#" + a).width() && -marginLefta <= $("#" + a).width()) {
            $("#" + a).css({
                "margin-left": marginLefta - 1 + "px"
            });
        } else {
            $("#" + a).css({
                "margin-left": temp
            });
        }
        if (-marginLeftb <= $("#" + b).width()) {
            $("#" + b).css({
                "margin-left": marginLeftb - 1 + "px"
            });
        } else {
            $("#" + b).css({
                "margin-left": temp
            });
        }
    }

    function start() {
        intervalId = window.setInterval(function() {
            abc("tick", "tick2");
        }, 12);
    }

    $(function() {
        $("#ats_token__ticker").mouseenter(function() {
            window.clearInterval(intervalId);
        });
        $("#ats_token__ticker").mouseleave(function() {
            start();
        });
        start();
    });
  
});


function decimalZeroClear(price) {
  price = price.replace(/\.?0*$/, '');
  return price;
}
