//描画
function drawOrder(imgSrc) {

    var canvas = document.getElementById("room");
    if (canvas) {
        var ctx = canvas.getContext("2d");

        //描画順整えるため読み込んでから描画する
        var images = [];
        for (var i in imgSrc) {
            images[i] = new Image();
            images[i].src = imgSrc[i];
        }
        console.log(images);

        var loadedCount = 1;
        for (var i in images) {
            images[i].addEventListener('load', function() {
                //全部画像を読み込んだら
                if (loadedCount == images.length) {
                    var x;
                    var y;
                    for (var j in images) {

                        if (j === "1") {
                            //キャラ
                            x = Math.random() * 900;
                            y = Math.random() * 700;
                            ctx.drawImage(images[j], x, y, 48, 96);
                        } else {
                            //ステージ
                            x = 0;
                            y = 0;
                            ctx.drawImage(images[j], x, y, 960, 720);
                        }
                    }
                }
                loadedCount++;
            }, false);
        }
    }
}