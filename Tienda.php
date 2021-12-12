<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio </title>
        <!-- BOOTSTRAP - BOOTSWATCH THEME - COSMOS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/materia/bootstrap.min.css">
        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <!-- CUSTOM CSS -->
    <!-- Scritps -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://www.gstatic.com/firebasejs/6.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.6.1/firebase-database.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/normalize.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.min.css'>
    <style>
        figure.avatar {
            bottom: 0px !important;
        }
        .btn-delete {
            background: red;
            color: white;
            border: none;
            margin-left: 10px;
            border-radius: 5px;
        }
    </style>
    <?php
	    $user = $_GET['user'];
        $rol= $_GET['rol'];
    ?>
    <script>
        // Your web app's Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyB5OOVR7jJ4Spo7ptuX9TBJnTS7NZZK_M0",
            authDomain: "chat-b2423.firebaseapp.com",
            projectId: "chat-b2423",
            databaseURL: "https://chat-b2423-default-rtdb.firebaseio.com/",
            storageBucket: "chat-b2423.appspot.com",
            messagingSenderId: "395540327353",
            appId: "1:395540327353:web:8dbd141c2f1fe6677e6468"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        firebase.database().ref("messages").on("child_removed", function (snapshot) {
            document.getElementById("message-" + snapshot.key).innerHTML = "Este mensaje a sido eliminado";
        });
        function deleteMessage(self) {
            var messageId = self.getAttribute("data-id");
            firebase.database().ref("messages").child(messageId).remove();
        }
        function sendMessage() {
            var myName='<?=$user?>';
            var message = document.getElementById("message").value;
            firebase.database().ref("messages").push().set({
                "message": message,
                "sender": myName
            });
            return false;
        }
        function cargar(){
            var email='<?=$user?>';
            $messages.mCustomScrollbar();
            firebase.database().ref("messages").on("child_added", function (snapshot) {
                if (snapshot.val().sender == email) {
                $('<div class="message message-personal"><figure class="avatar"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpdX6tPX96Zk00S47LcCYAdoFK8INeCElPeJrVDrh8phAGqUZP_g" /></figure><div id="message-' + snapshot.key + '">' + snapshot.val().message + '<button class="btn-delete" data-id="' + snapshot.key + '" onclick="deleteMessage(this);"><i class="fa fa-trash" aria-hidden="true"></i></button></div></div>').appendTo($('.mCSB_container')).addClass('new');
                $('.message-input').val(null);
                // $('<div class="message new" style="display: none" ><input class="usuario" style="display: none" value="'+ snapshot.val().sender +'"></input></div>').appendTo($('.mCSB_container')).addClass('new');
                } else {
                $('<div class="message new"><figure class="avatar"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpdX6tPX96Zk00S47LcCYAdoFK8INeCElPeJrVDrh8phAGqUZP_g" /></figure><div id="message-' + snapshot.key + '">' + snapshot.val().sender + ': ' + snapshot.val().message + '</div></div>').appendTo($('.mCSB_container')).addClass('new');
                //
                } 
                setDate();
                updateScrollbar();
            });
        }
        function roles() {
            var rol='<?=$rol?>';
            console.log(rol);
            if(rol==2){
                document.getElementById('usuario').setAttribute('style',"display: ");
            }else if(rol==3){
                document.getElementById('vendedor').setAttribute('style','display: ');
            }
        }
    </script>
    
</head>
<body background="./img/fondo.jpg!d" class="body">
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color:  #fbfbe5 ;">
        <?php  
            echo "<a class='navbar-brand' href='panel.php?user=$user&rol=$rol'>Cultivate<img src='./img/logo.jpg'  width='35' height='35'></a>";
        ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto navbar-success" style="display: none" id="usuario">    
                <li class="nav-item">
                    <?php  
                        echo "<a class='nav-link' href='Cursos.php?user=$user&rol=$rol'>Cursos</a>";
                    ?>
                </li>
                <li class="nav-item">
                    <?php  
                        echo "<a class='nav-link' href='MCursos.php?user=$user&rol=$rol'>Mis Cursos</a>";
                    ?>
                </li>
                <li class="nav-item">
                    <?php  
                        echo "<a class='nav-link' href='Tienda.php?user=$user&rol=$rol'>Tienda</a>";
                    ?>
                </li>
                <li class="nav-item">
                    
                </li>
            </ul>
            <ul class="navbar-nav mr-auto navbar-success" style="display:none" id="vendedor">    
                <li class="nav-item">
                    <?php  
                        echo "<a class='nav-link' href='MisProductos.php?user=$user&rol=$rol'>Mis productos</a>";
                    ?>
                </li>
                <li class="nav-item">
                    
                </li>
            </ul>
            <ul class="navbar-nav  navbar-success" >    
                <li class="nav-item dropdown "  >
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $user;?> 
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./index.php">Cerrar Sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
 
    <div class="container">
                       <center> <h4 class="font-italic mb-4">Herramientas</h4><center>
                        <div class="card-deck">
                                <div class="card">
                                    <img class="card-img-top" src="https://image.slidesharecdn.com/tema2-110515055424-phpapp01/95/maquinarias-y-herramientas-de-cultivo-8-728.jpg?cb=1305441434" alt="Card image cap" height="170" width="100">
                                    <div class="card-body">
                                    <h5 class="card-title">Avinadora</h5>
                                  
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="" class="btn btn-primary btn-sm">Comprar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="card-img-top" src="https://www.silosdelcinca.com/wp-content/uploads/hoz-300x159.jpg" alt="Card image cap" height="170" width="100">
                                    <div class="card-body">
                                    <h5 class="card-title">OZ</h5>
                            
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="" class="btn btn-primary btn-sm">Comprar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="card-img-top" src="https://www.revista.ferrepat.com/wp-content/uploads/2016/03/HYD2016-1.jpg" alt="Card image cap" height="170" width="100">
                                    <div class="card-body">
                                    <h5 class="card-title">Fumigadora</h5>
                            
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="" class="btn btn-primary btn-sm">Comprar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="card-img-top" src="https://www.deere.com.mx/assets/images/region-3/products/harvesters/thumb_grainharvester_group_page_large_8e2a8ab60ec82878a7a24ea2b17f4e2df4220973.png" alt="Card image cap" height="170" width="100">
                                    <div class="card-body">
                                        <center>
                                    <h5 class="card-title"> Trilladora</h5>
                                        <center>
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="" class="btn btn-primary btn-sm">Comprar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                </div>

                                <center> <h4 class="font-italic mb-4">Herbicidas</h4><center>
                        <div class="card-deck">
                                <div class="card">
                                    <img class="card-img-top" src="https://www.disagro.com/sites/default/files/imagen_producto/disagro-ppc_agente-36-sl_0.png" alt="Card image cap" height="170" width="100">
                                    <div class="card-body">
                                    <h5 class="card-title">Agente 36</h5>
                                  
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="" class="btn btn-primary btn-sm">Comprar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="card-img-top" src="https://m.media-amazon.com/images/I/71T4ikxw2-L._AC_SX425_.jpg" alt="Card image cap" height="170" width="100">
                                    <div class="card-body">
                                    <h5 class="card-title">Surfactant</h5>
                            
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="" class="btn btn-primary btn-sm">Comprar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ6e6ZKB2cwXZwnAJ0pZgym7tf9THoSe4i59w&usqp=CAU" alt="Card image cap" height="170" width="100">
                                    <div class="card-body">
                                    <h5 class="card-title">Herbicida C</h5>
                            
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="" class="btn btn-primary btn-sm">Comprar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                        </div>
                                 
        
    </div>
                    
</body>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.concat.min.js'></script>
    <script src="./js/panel.js?v=<?= time(); ?>"></script>

</body>
</html>