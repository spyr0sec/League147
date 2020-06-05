window.onload = choosePic;

const myPix = new Array("images/markheader.png", "images/juddheader.png", "images/ronnieheader.png", "images/neilheader.png","images/dingheader.png","images/hawkinsheader.png"
, "images/murphyheader.png", "images/wenboheader.png", "images/williamsheader.png");

function choosePic() {
    const randomNum = Math.floor(Math.random() * myPix.length);
    document.getElementById("myPicture").src = myPix[randomNum];
}



// function GetPlayer1(){
//     var e = document.getElementById("Player1");
//     var result = e.options[e.selectedIndex].text;
//
//     document.getElementById("p1").innerHTML = result + " confirmed as player 1.";
// }
//
// function GetPlayer2(){
//     var e = document.getElementById("Player2");
//     var result = e.options[e.selectedIndex].text;
//
//     document.getElementById("p2").innerHTML = result + " confirmed as player 2.";
// }
//
// function GetBothPlayers(){
//     var e = document.getElementById("Player1");
//     var f = document.getElementById("Player2");
//     var p1confirm = e.options[e.selectedIndex].text;
//     var p2confirm = f.options[f.selectedIndex].text;
//
//     document.getElementById("p1").innerHTML = p1confirm + " confirmed as player 1.";
//     document.getElementById("p2").innerHTML = p2confirm + " confirmed as player 2.";

