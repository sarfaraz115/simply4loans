//----Submit Button Data List Script---//

//$(function() {
//    $("[id*=btnSave]").bind("click", function() {
//        var user = {};
//        user.Username = $("[id*=txtUsername]").val();
//        user.Password = $("[id*=txtPassword]").val();
//        $.ajax({
//            type: "POST",
//            url: "CS.aspx/SaveUser",
//            data: '{user: ' + JSON.stringify(user) + '}',
//            contentType: "application/json; charset=utf-8",
//            dataType: "json",
//            success: function(response) {
//                alert("User has been added successfully.");
//                window.location.reload();
//            }
//        });
//        return false;
//    });
//});

//---View Answer Data List Script---//

       function switchViews(obj, row) {
           var div = document.getElementById(obj);


           if (div.style.display == "none") {
               div.style.display = "inline";
           }
           else {
               div.style.display = "none";
           }
       }



         function switchViews(obj, row) {
             var work = document.getElementById(obj);


             if (work.style.display == "none") {
                 work.style.display = "inline";
             }
             else {
                 work.style.display = "none";
             }
         }


 
 
         function switchViews(obj, row) {
             var Erorr = document.getElementById(obj);


             if (Erorr.style.display == "none") {
                 Erorr.style.display = "inline";
             }
             else {
                 Erorr.style.display = "none";
             }
         }


