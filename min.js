
$(function(){
  $(".btn-gnavi").on("click", function(){
//メニューの位置
  var rightVal = 0;
  if($(this).hasClass("open")){//開いているなら
  //閉じる
    rightval = -30;
    //クラスを消す
    $(this).removeClass("open");
    ]else{//閉じている
    //クラス生成
    $(this).addClass("open");
    }
$("#grobal-navi").stop().animate({
  right: rightVal
},200);
  });
});
