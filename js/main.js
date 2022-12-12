// Creation d'une function qui écoute un clavier et remplace les guillemets anglais par des guillemets français. 

const input = document.querySelectorAll('input');

for (i=0; i<input.length; i++) {
  if(input[i].type=="text") {
    input[i].addEventListener("keyup", function(){
      remplacerGuillemets(this);
    });
  }
}

function remplacerGuillemets(e){
  tabCaractere = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","0","1","2","3","4","5","6","7","8","9",".","!","é","(",")","è","_","ç","à",";",":","ù","*","$","€"];
  for (i=0; i<tabCaractere.length; i++) {
    e.value=e.value.replace(tabCaractere[i]+'"', tabCaractere[i]+' »');
  }
  e.value=e.value.replace('"',' « ');
}

// Creation du player video.

var player = videojs('my-video');

videojs.getPlayer('my-video').ready(function() {
    var myPlayer = this,
      options = {};
      options.content = 'Attention. Ce contenu peut contenir des scènes choquantes !';
      options.label = 'Attention !';

      var ModalDialog = videojs.getComponent('ModalDialog');
      var myModal = new ModalDialog(myPlayer, options);
      myModal.addClass('vjs-my-custom-modal');
      myPlayer.addChild(myModal);
      myModal.open();
  });