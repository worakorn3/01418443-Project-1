// Tutorial
// https://codepen.io/rheajt/pen/prGjdV/?editors=1010
// https://www.youtube.com/watch?v=2Vx00MAmhbs
// https://script.google.com/a/ku.th/d/1GSSRTfrNuZoXabGlY_wZ159NkUnCS9Jdm1XVkZeZO2iWxRlzr5Ytx-ID/edit?usp=sharing

$(document).ready(function (e) {
    $(function () {
        $(document).on("click", '#google-form-btn', function (event) {
            event.preventDefault();
            // alert("button press eiei");
            console.log(event_id);


            // Get Event Name, Google Form Link, Attendants's Emails

            // let data = {
            //     eventName: "",
            //     formLink: "",
            //     email: {
                    
            //     }
            // };
            $.ajax({
                url:"../../service/organizer/getFormBundle.php",
                type:"get",
                dataType:"json",
                data:{
                    event_id:event_id
                },
                success:function(bundle){
                    var sendCount = 0;
                    console.log("bundle", bundle);
                    for(let i=0; i<bundle.email.length; i++){
                        let data = {
                            "attendant":bundle.attendant[i],
                            "organizer":bundle.organizerName,
                            "eventName":bundle.eventName,
                            "formLink":bundle.formLink,
                            "email":bundle.email[i]
                        }
                        // console.log("data", data);
                        sendEmail(data);
                    }

                    alert("send email success");
                    
                },
                error:function(e){
                    console.log("get form bundle error");
                    console.log(e);
                }
            })
        });
    });
});

function sendEmail(data){
     // POST to Google App Scripts
     $.ajax({
        url: "../../service/organizer/sendEmail.php",
        dataType: "JSONP",
        type: "POST",
        data: data,
        success: function(e) {
            sendCount++;
            console.log("Success email sent.", sendEmail);
        },
        error: function(e) {
            console.log("Error, email not sent.")
            console.log(e);
        }
    });
}



// function sendEmail() {
//     // e.preventDefault();
//     const MAIL_APP = "https://script.google.com/macros/s/AKfycbwetsM68Ca1L30lwBmDtq6iqzQXQ4UivqiGR4uyNQNu0WaR82Y/exec";
//     const POST_REQ = {
//         attendant: "",
//         organizer: <?php echo $event->organizer->name?>,
//         eventName: "",
//         formLink: "",
//         email: ""
//     };

//     if(MAIL_APP) {
//         $.post(MAIL_APP, JSON.stringify(POST_REQ), function(){
//             alert("Mail sent!");
//         })
//         .fail(function(){
//             alert("Something went wrong");
//         });
//     }
// }