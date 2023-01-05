$(document).ready(function () {
    setTimeout(function () {
        loadTable();
    }, 200
    )

    //TO INSERT RECORD
    $("form").on("submit", function (event) {
        event.preventDefault();
        // var form_data = new FormData();  // Create a FormData object
        var userId = $("#user_id").val();
        var fname = $("#firstName").val();
        var lname = $("#lastName").val();
        var contactNo = $("#contactNo").val();
        var password = $("#password").val();
        var emailId = $("#email").val();

        if (fname == "" || lname == "" || contactNo == "" || password == "" || emailId == "") {
            alert("fill complete details!");
            document.getElementsByName(submit).disabled = true;
        }
        var passw = /^[A-Za-z]\w{7,14}$/;
        if (!passw.test(password)) {
            alert("Password Invalid");
            document.getElementsByName(submit).disabled = true;
        }
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(emailId)) {
            alert("Enter valid email address");
            document.getElementsByName(submit).disabled = true;
        }
        // var filter =  /^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/;
        // if (filter.test(contactNo)) {
        if (contactNo.length != 10) {
            alert("Invalid phone number");
            document.getElementsByName(submit).disabled = true;
        }
        // }
        else {
            $.ajax({
                url: "crud.php?action=insertRecord",
                type: "POST",
                // data: { Id: userId, firstName: fname, lastName: lname, contactNo: contactNo, emailId: emailId, password: password ,photo: form_data},
                data: new FormData(this),
                // dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    //console.log("dummy"+ $.trim(data));
                    data = $.trim(data);
                    if (data == 1) {
                        loadTable();

                        $('#addForm')[0].reset();
                        $('#modalRegisterForm').modal('hide');
                    }
                    if (data == 3) {
                        alert("please upload image with 'jpg','jpeg','png' extensions");
                    }
                    if (data != 1 && data != 3) {
                        alert("Can't save record");
                    }

                }
            });
        }


    });


    //FORGOT PASSWORD
    $("form").on("click","#submitEmail", function (event) {
        event.preventDefault();
        var emailId = $("#emailConfirm").val();

        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(emailId)) {
            alert("Enter valid email address");
            document.getElementsByName(submit).disabled = true;
        }
        else {
            $.ajax({
                url: "crud.php?action=forgotPassword",
                type: "POST",
                data: {emailId: emailId},
                cache: false,
                success: function (data) {
                    outputArr = JSON.parse(data);
                    console.log(outputArr);
                    key=outputArr.key;
                    token=outputArr.token;
                    link="htmlLink.php?key="+key+"&token="+token;
                    console.log(link);
                   if(outputArr.data=="1"){
                    window.location.href=link;
                   }
                   else{
                    alert("INVALID EMAIL ID");
                   }
                }
            });
        }
        
    });

    //RESET PASSWORD
    $("form").on("click","#submitNewPassword", function (event) {
        event.preventDefault();
        var token=$("#token").val();
        var key=$("#key").val();
        
        var pass1=$("#newPassword").val();
        var pass2=$("#confirmPassword").val();
        var comparison = pass1.localeCompare(pass2);
        var passw = /^[A-Za-z]\w{7,14}$/;
        if(comparison!=0){
            alert("Passwords donot match");
            document.getElementsByName(submitNewPassword).disabled = true;
        }
        if (!passw.test(pass1)) {
            alert("Password Invalid");
            document.getElementsByName(submitNewPassword).disabled = true;
        }
        
        else{
            $.ajax({
                url: "crud.php?action=resetPassword",
                type: "POST",
                data: {pass1: pass1,key: key,token:token},
                cache: false,
                success: function (data) {
                    data = $.trim(data);
                    if(data=="1"){
                        alert("PASSWORD UPDATED SUCCESSFULLY");
                        window.location.href="login";
                    }
                    else{
                        alert("Please try again!");
                    }
                }
            });
        }

    });


    //LOGIN CODE
    $("form").on("click","#submitDetails", function (event) {
        event.preventDefault();

        var password = $("#password").val();
        var emailId = $("#loginEmail").val();

        var passw = /^[A-Za-z]\w{7,14}$/;
        if (!passw.test(password)) {
            alert("Password Invalid");
            document.getElementsById(submitDetails).disabled = true;
        }
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(emailId)) {
            alert("Enter valid email address");
            document.getElementsById(submitDetails).disabled = true;
        }
        else {
            $.ajax({
                url: "crud.php?action=verifyDetails",
                type: "POST",
                data: { email: emailId, password: password },
                cache: false,
                success: function (data) {
                    data = $.trim(data);
                    if (data == 1) {
                        alert("Email Id is not registered");
                    }
                    else if (data == 3) {
                        alert("incorrect Password");
                    }
                    else if(data==2){
                        // outputArr = JSON.parse(data);
                        // var str= "Welcome "+outputArr.fullName;
                        // // console.log(str);
                        // // WelcomeDashboard(str);
                        
                        window.location.href="dashboard" ;
                       
                    }
                }
            });
        }

    });

    //TO DELETE RECORD
    $(document).on("click", ".delete-btn", function () {

        if (confirm("Do you want to delete this record?")) {

            var userId = $(this).attr('Id');
            // var $element=this;
            $.ajax({
                url: "crud.php?action=deleteRecord",
                type: "POST",
                data: { Id: userId },
                success: function (data) {
                    if (data == 1) {
                        $('#' + userId).closest("tr").fadeOut().remove();
                    } else {
                        alert("can't delete the  row")
                    }
                }

            });
            // $(this).closest("tr").fadeOut().remove();
        }
    });

    //TO UPDATE TABLE
    $(document).on("click", ".edit-btn", function () {

        $("#modalRegisterForm").modal();

        var userId = $(this).data("eid");
        //alert(userId)
        // var fname=$(this).data("eid");
        // var lname=$(this).data("eid");
        // var contactNo=$(this).data("eid");
        // var emailId=$(this).data("eid");
        $.ajax({
            url: "crud.php?action=fetchRecord",
            type: "POST",
            data: { Id: userId },
            success: function (data) {
                // $('#Upload').attr("src", data);      

                myArr = JSON.parse(data);
                // document.getElementById('Upload').value = myArr.profileImg;
                document.getElementById('firstName').value = myArr.firstName;
                document.getElementById('lastName').value = myArr.lastName;
                document.getElementById('contactNo').value = myArr.contactNo;
                document.getElementById('email').value = myArr.emailId;
                document.getElementById('password').value = myArr.password;
                document.getElementById('user_id').value = myArr.userId;

                // document.getElementById('address').value = myArr.address;
            }
        });
    });


    // TO LOGOUT
    $("#logout").click( function (event) {
        event.preventDefault();
        var request = $.ajax({
            url: "crud.php?action=logoutSession",
            type: "POST",
            success: function(){
                // alert("heyy");
                window.location.href="login" ;

            }
        });

        request.done(function(msg) {
            // alert("Logged Out");
        });

    });



});


//TO LOAD TABLE
function loadTable(page = "1") {
    // alert(page);
    $.ajax({
        url: "crud.php?action=loadRecordsTable",
        cache: false,
        type: "POST",
        data: { page_no: page },
        success: function (data) {
            outputArr = JSON.parse(data);
            // console.log(data);
            // console.log(outputArr);
            $('#table-data').html(outputArr.table_data);
            $('#pagination').html(outputArr.pagination);

        }
    });
}


$(document).on("click", "#pagination a", function () {
    var page = $(this).attr("id");
    loadTable(page);
});


function WelcomeDashboard(str){
    document.getElementsById('#bodyId').innnerText=str;
}

$(document).on("click", "#forgotPassword", function () {
    window.location.href="forgotPassword"
});
