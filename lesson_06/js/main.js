let myChara = 0;
const charaImage = ["chara0.png", "chara1.png", "chara2.png", "chara3.png"];


// ================================================
//  メイン
// ================================================
// ====================
//  入口
// ====================

$(".chara").on("click", function() {
    myChara = $(this).attr("data-image");
    console.log("myChara:" + myChara);

    document.getElementById("selected-avatar").src = "img/" + charaImage[myChara];
});