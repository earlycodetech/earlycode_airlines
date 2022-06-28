<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <?php 
        if (isset($_POST['send'])) {
           $email = $_POST['email'];
           $subject = $_POST['subject'];
           $message = $_POST['message'];
           $message = "
           <html>
               <div style=\"background-color: #FBD6D2; margin: 0 auto; width: 300px; box-shadow: 5px 5px 60px 10px #FBD6D2; padding: 10px;\">
                   <img src=\"http://earlytransport.apexassets.online/assets/img/earlycode_logo.jpg\"  style=\"display: block; margin: 0 auto; width: 200px;\">
   
                   <h1 style=\"text-align: center; padding: 20px 0;\">Welcome to the Future</h1>
                   <h6 style=\"text-align: center; padding: 20px 0;\">$message</h6>
               </div>
           </html>
           
           ";
            $to = $email;
            $headers = "From: Earlycode-Transport <support@earlyTransport.com>\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset= ISO-8859-1\r\n";
            
            $mail =  mail($to,$subject,$message,$headers);
            if ($mail) {
                echo "Email was sent!";
            }else{
                echo "Not Sent!";
            }

        }
    ?>
    <div class="container mt-5">
        <form  method="post">
            <input type="email" placeholder="Email" name="email" class="form-control mb-3">
            <input type="text" placeholder="Subject" name="subject" class="form-control mb-3">

            <textarea  name="message" class="form-control mb-3"></textarea>


            <input type="submit" name="send" value="Send" class="btn mt-3 btn-primary">
        </form>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</body>
</html>