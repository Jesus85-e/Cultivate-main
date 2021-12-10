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
    <section class="py-5 header">
    <div class="container">
        <div class="row">
            <div class="col-md-2" >
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                   
                    <a class="nav-link mb-3 p-3  data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="background-color:  #fbfbe5 ;">
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Semillas o fruto</span></a>
                    <a class="nav-link mb-3 p-3 shadow active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="background-color:  #fbfbe5 ;">
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Frijol</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="background-color:  #fbfbe5 ;">
                        <i class="fa fa-calendar-minus-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Trigo</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false" style="background-color:  #fbfbe5 ;">
                       
                        <span class="font-weight-bold small text-uppercase">Chiles</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false" style="background-color:  #fbfbe5 ;">
                        
                        <span class="font-weight-bold small text-uppercase">Sevada</span></a>
                    </div>
            </div>


            <div class="col-md-9">
                <!-- Tabs content -->
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade shadow rounded bg-white show active p-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <h4 class="font-italic mb-4">CURSOS FRIJOL</h4>
                        <div class="card-deck">
                                <div class="card">
                                    <img class="card-img-top" src="./img/Frijol/Curso1.jpg" alt="Card image cap">
                                    <div class="card-body">
                                    <h5 class="card-title">CARACTERÍSTICAS FÍSICAS Y DE GERMINACIÓN EN SEMILLAS Y
PLÁNTULAS DE FRIJOL</h5>
                                  
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="https://drive.google.com/file/d/1zN14-jxWtZQzhm_cBVmuO8-LunwNPJcR/view?usp=sharing" class="btn btn-primary btn-sm">Descargar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="card-img-top" src="./img/Frijol/curso2.jpg" alt="Card image cap">
                                    <div class="card-body">
                                    <h5 class="card-title">MANEJO Y TRATAMIENTO DE SEMILLA DE FRIJOL</h5>
                            
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="https://drive.google.com/file/d/1vBI8WGN1x3ow5ebJOoneNXR7E0v8TbY3/view?usp=sharing" class="btn btn-primary btn-sm">Descargar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="card-img-top" src="./img/Frijol/Curso3.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <center>
                                    <h5 class="card-title">CULTIVO DE FRIJOL BASICO PASO A PASO</h5>
                                        <center>
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="https://drive.google.com/file/d/1vjAVyjjq2FYdURKmmwJ3hzv1K6qJTWVY/view?usp=sharing" class="btn btn-primary btn-sm">Descargar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                </div>
                    </div>
                    
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <h4 class="font-italic mb-4">Trigo</h4>
                        <div class="card-deck">
                                <div class="card">
                                    <img class="card-img-top" src="./img/trigo/Curso1.jpg" alt="Card image cap">
                                    <div class="card-body">
                                    <h5 class="card-title">MANUEAL DE RECOMENDACIONES PARA EL CULTIVO DEL TRIGO</h5>
                                    
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="https://drive.google.com/file/d/1xY8y3p2hDma_FFXgRUUb-1y-H7vdlO_9/view?usp=sharing" class="btn btn-primary btn-sm">Descargar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="card-img-top" src="./img/trigo/curso2.jpg" alt="Card image cap">
                                    <div class="card-body">
                                    <h5 class="card-title">RESULTADOS DE CULTIVO DE TRIGO</h5>
                                    <p class="card-text">
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="https://drive.google.com/file/d/1UT9zg3ot-jTTSNQocvMwDkf58PKXGokf/view?usp=sharing" class="btn btn-primary btn-sm">Descargar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="card-img-top" src="./img/trigo/curso5.jpg" alt="Card image cap">
                                    <div class="card-body">
                                    <h5 class="card-title">MANUAL DE TRIGO IPNI</h5>
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="./img//trigo//Resumen-Manual-Trigo-IPNI.pdf" class="btn btn-primary btn-sm">Descargar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                </div>
                    </div>
                    
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <h4 class="font-italic mb-4">Chile</h4>
                        <div class="card-deck">
                                <div class="card">
                                    <img class="card-img-top" src="./img/Chile/Curso1.jpg" alt="Card image cap">
                                    <div class="card-body">
                                    <h5 class="card-title">SELECCIÓN Y CONSERVACION DE SEMILLA DE CHILE</h5>
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="https://drive.google.com/file/d/1XyXK2jGoouFyVBYI7ep-0E6QOSuU4dh-/view?usp=sharing" class="btn btn-primary btn-sm">Descargas</a>
                                        <center>

                                        </small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="card-img-top" src="./img//Chile//curso4.jpg" alt="Card image cap">
                                    <div class="card-body">
                                    <h5 class="card-title">FACTORES DE CALIDAD DE LA SEMILLA DE CHILE SILVESTRE</h5>
                                   
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="https://drive.google.com/file/d/1_ILGmOwL2pW1T8e2DdIX_nPzg81kdXAw/view?usp=sharing" class="btn btn-primary btn-sm">Descargas</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="card-img-top" src="./img/Chile/curso3.jpg" alt="Card image cap">
                                    <div class="card-body">
                                    <h5 class="card-title">CARACRTERISTICAS DEL FRUTO Y SEMILLA DEL CHILE HUACLE</h5>
                                    
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="https://drive.google.com/file/d/1ZiIF2XUHiSVz6ZVJdRaArjGXK5VL_Jl9/view?usp=sharing" class="btn btn-primary btn-sm">Descargar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                </div>
                    </div>
                    
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <h4 class="font-italic mb-4">Sevada</h4>
                        <div class="card-deck">
                                <div class="card">
                                    <img class="card-img-top" src="./img/sevada/curso1.jpg" alt="Card image cap">
                                    <div class="card-body">
                                    <h5 class="card-title">PLANEACION AGRICOLA NACIONAL</h5>
                                    
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="https://drive.google.com/file/d/1El8IOmCa45rVagUnmVSQLS8fSQDNoFFV/view?usp=sharing" class="btn btn-primary btn-sm">Descargar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="card-img-top" src="./img/sevada/curso2.jpg" alt="Card image cap">
                                    <div class="card-body">
                                    <h5 class="card-title">MANEJO DE CULTIVO SEBADA</h5>
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="https://drive.google.com/file/d/1H2t2917luip2yLMJSgvMwGpyXOGld4rS/view?usp=sharing" class="btn btn-primary btn-sm">Descargar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="card-img-top" src="./img/sevada/curso3.jpg" alt="Card image cap">
                                    <div class="card-body">
                                    <h5 class="card-title">RENDIMIENTO Y CALIDAD DE LA SEMILLA DE CEBADA</h5>
                                
                                    </div>
                                    <div class="card-footer">
                                    <small class="text-muted">
                                        <center>
                                        <a href="https://drive.google.com/file/d/1LcgtxQOyHTr3TpxXZPqWpdwjIY-0CBd_/view?usp=sharing" class="btn btn-primary btn-sm">Descargar</a>
                                        <center>
                                    </small>
                                    </div>
                                </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.concat.min.js'></script>
    <script src="./js/panel.js?v=<?= time(); ?>"></script>

</body>
</html>