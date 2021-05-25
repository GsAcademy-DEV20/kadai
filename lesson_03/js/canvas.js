// canvas準備
var srcs = [
    "../img/studyroom_bg.png",
    "../img/studyroom_desk.png",

];

var canvas = document.getElementById("room");
if (canvas) {
    var ctx = canvas.getContext("2d");

    var images = [];
    for (var i in srcs) {
        images[i] = new Image();
        images[i].src = srcs[i];
    }

    //描画順制御
    var loadedCount = 1;
    for (var i in images) {
        images[i].addEventListener('load', function() {
            if (loadedCount == images.length) {
                var x = 0;
                var y = 0;
                for (var j in images) {
                    ctx.drawImage(images[j], x, y, 960, 720);
                }
            }
            loadedCount++;
        }, false);
    }
}