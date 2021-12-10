var $messages = $('.messages-content'),
    d, h, m,
    i = 0;

var myName = "";

$(window).load(function() {
  email='';
  $messages.mCustomScrollbar();
  firebase.database().ref("messages").on("child_added", function (snapshot) {
    if (snapshot.val().sender == email) {
      $('<div class="message message-personal"><figure class="avatar"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpdX6tPX96Zk00S47LcCYAdoFK8INeCElPeJrVDrh8phAGqUZP_g" /></figure><div id="message-' + snapshot.key + '">' + snapshot.val().message + '<button class="btn-delete" data-id="' + snapshot.key + '" onclick="deleteMessage(this);"><i class="fa fa-trash" aria-hidden="true"></i></button></div></div>').appendTo($('.mCSB_container')).addClass('new');
      $('.message-input').val(null);
     // $('<div class="message new" style="display: none" ><input class="usuario" style="display: none" value="'+ snapshot.val().sender +'"></input></div>').appendTo($('.mCSB_container')).addClass('new');
    } else {
      $('<div class="message new"><figure class="avatar"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpdX6tPX96Zk00S47LcCYAdoFK8INeCElPeJrVDrh8phAGqUZP_g" /></figure><div id="message-' + snapshot.key + '">' + snapshot.val().sender + ': ' + snapshot.val().message + '</div></div>').appendTo($('.mCSB_container')).addClass('new');
      //$('<input class="usuario" value="'+ snapshot.val().sender +'"></input>').appendTo($('.body'));
    } 
    setDate();
    updateScrollbar();
  });
});
$('.login-submit').click(function() {
  login();
});

function login(){
  var email = $('.email-Input').val();
  var pass = $('.pass-Input').val();
  console.log(pass);
  firebase.database().ref("users").on("child_added", function (snapshot) {
    if (snapshot.val().email == email && snapshot.val().password ==pass) {
      usuer=snapshot.val().email;
      rol=snapshot.val().rol;
      window.location.href="./panel.php?user="+usuer+"&rol="+rol+"";
      return true;
    } else{
      return false;
      
    }
    setDate();
    updateScrollbar();
  });
  
}
function cargar(email){
    if(email==''){

    }else{

    }
}

function updateScrollbar() {
  $messages.mCustomScrollbar("update").mCustomScrollbar('scrollTo', 'bottom', {
    scrollInertia: 10,
    timeout: 0
  });
}

function setDate(){
  d = new Date()
  if (m != d.getMinutes()) {
    m = d.getMinutes();
    $('<div class="timestamp">' + d.getHours() + ':' + m + '</div>').appendTo($('.message:last'));
  }
}
//Chat 
function insertMessage() {
  msg = $('.message-input').val();
  if ($.trim(msg) == '') {
    return false;
  }

  sendMessage();
}
$('.message-submit').click(function() {
  insertMessage();
});
//Registro
function insertUser() {
  email = $('.email-input').val();
  pas =$('.pas-input').val();
  if ($.trim(email) == '' || $.trim(pas)== '') {
    return false;
  }

  sendUser();
}

$('.user-submit').click(function() {
  insertUser();
});

$(window).on('keydown', function(e) {
  if (e.which == 13) {
    insertMessage();
    return false;
  }
});