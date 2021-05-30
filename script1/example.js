//ファイル名：example.js
function gate(){
    //ダイアログで取得したものを変数に代入する
    var value = prompt("1+1?");
    if(value==2){
    //正解なら正解のアラートを出す
    alert('正解です');
    }else{
    //違うなら
    alert('不正解です');
    }
    }