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
        <link rel="stylesheet" href="./css/main.css">
    <!-- Scritps -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://www.gstatic.com/firebasejs/6.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.6.1/firebase-database.js"></script>

    <link rel="stylesheet" href="css/normalize.css">

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
          var message = document.getElementById("message").value;
          firebase.database().ref("messages").push().set({
            "message": message,
            "sender": myName
          });
          return false;
        }
      </script>
</head>
<body background="./img/fondo.jpg!d">
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color:  #fbfbe5 ;">
        <a class="navbar-brand" href="./index.php">Cultivate <img src="./img/logo.jpg" alt="" width="35" height="35"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto navbar-success">    
            <li class="nav-item">
              <a class="nav-link" href="./SingIn.php">Iniciar Sesión</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="./SingUp.php" >Registrarse</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="./SingUp.php" >Nosotros</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
        </div>
    </nav>
    <div class="chat">
        <div class="chat-title">
            <h1>Opiniones</h1>
            <h2>y comentarios</h2>
            <figure class="avatar">
            <img src="https://p7.hiclipart.com/preview/349/273/275/livechat-online-chat-computer-icons-chat-room-web-chat-others.jpg" /></figure>
        </div>
        <div class="messages">
            <div class="messages-content"></div>
        </div>
        <div class="message-box">
            <center><a href="./SingIn.php">Necesitas inciar sesión para interactuar</a></center>
        </div>
    </div>
    <div class="bg"></div>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.concat.min.js'></script>
    <script src="./js/index.js?v=<?= time(); ?>"></script>

    <style>
        .fixed-bottom {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: lightseagreen;
            color: white;
            text-align: center;
            padding: 25px;
            font-size: 20px;
        }
</style>
</body>
</html>