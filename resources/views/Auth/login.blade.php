<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"> </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    
    Login

    <input id="email" >

    <input id="password" >


    <button id="enviar" >Ingresar</button>


    <script>
      

        $('#enviar').click(function(){

            let email = $('#email').val();
            let password = $('#password').val();

            $.ajax({
                url: '/login',
                type: 'POST',
                dataType: 'json',
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    },
                data: {
                    email: email,
                    password: password
                },
                success: function(response){
                 
                    if(response.message == 'Success'){
                        window.location.href = '/categorias';
                    }
                }
            });

        });

    
    </script>


</body>
</html>