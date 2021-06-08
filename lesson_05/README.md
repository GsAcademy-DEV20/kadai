# 05PHP
## ①課題内容（どんな作品か）
 ![2021-06-08_17h38_53](https://user-images.githubusercontent.com/69302785/121154303-d54f1c00-c881-11eb-94e4-8884c497294f.png)
- PHPでじゃんけん
- 使い方
1. C:\xampp\htdocs\GsAcademy-DEV20 以下にlesson_05フォルダをコピー
2. XAMPPでApache、MySqlをStart
3. http://localhost/GsAcademy-DEV20/lesson_05/ にアクセス
4. 下部にあるボタンから手を選ぶ。


## ②工夫した点・こだわった点
- PHPで画像表示、CSSをあててみた
- ```<form method="post">```を使って値渡し
- 関数をまとめたfuncs.phpをincludeしてみた

## ③質問・疑問（あれば）
- javascriptとPHPの使い分け。  
どういうときにどう使い分けるのがいいのか知りたいと思いました。  
（サーバー処理：PHP、クライアント処理：javascriptかなとはおもうんですが、例えば今回みたいな「じゃんけん」を組むときに、どういうところはPHPでやって、どういうところはJSで実装するのがよいのか。勝利判定処理など。）


## ④その他（感想、シェアしたいことなんでも）
- PHPで画像ボタンを実装する方法を調べたところ``` input type="image"```では、valueを渡すことが出来ないとのこと。
```input type="hidden" ```と組み合わせることで画像ボタンが使えるようになりました。  

