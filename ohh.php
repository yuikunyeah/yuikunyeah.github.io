<?php
try
{
$date = new DateTime();
$date->setTimeZone(new DateTimeZone('Asia/Tokyo'));
$comment_text=$_POST['text'];
$comment_image_name=$_FILES['image_name'];
if(!empty($_POST['comment_id']))
{
$comment_id=$_POST['comment_id'];
}
$user_id=$_SESSION['user_id'];
$post_id=$_POST['id'];

if($comment_text=='')
{
    set_flash('danger','コメントが空です');
    reload();
} 

if($comment_image_name['size']>0)
{
    if($comment_image_name['size']>1000000)
    {
        set_flash('danger','画像が大きすぎます');
        reload();
    }
    else
    {
        move_uploaded_file($comment_image_name['tmp_name'],'./image/'.$comment_image_name['name']);

    }
}

$comment_text=htmlspecialchars($comment_text,ENT_QUOTES,'UTF-8');
$user_id=htmlspecialchars($user_id,ENT_QUOTES,'UTF-8');
$dsn = 'mysql:dbname=db;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'INSERT INTO comment(text,image,user_id,created_at,post_id,comment_id) VALUES (?,?,?,?,?,?)';
$stmt = $dbh -> prepare($sql);
$data[] = $comment_text;
$data[] = $comment_image_name['name'];
$data[] = $user_id;
$data[] = $date->format('Y-m-d H:i:s');
$data[] = $post_id;
if(!empty($comment_id))
{
$data[] = $comment_id;
} 
else 
{
$data[] = '';
}
$stmt -> execute($data);
$dbh = null;

set_flash('sucsess','コメントを追加しました');
header('Location:../post/post_disp.php?post_id='.$post_id.'');

}   
catch (Exception $e)
{
print'ただいま障害により大変ご迷惑をお掛けしております。';
exit();
}

?>
コメント内容と添付されている画像を確認して、コメントテーブルにINSERTしています。
if(!empty($_POST['comment_id']))
{
$comment_id=$_POST['comment_id'];
}
こちらの行はcomment_idがPOSTされたときに、$comment_idに値を渡しています。
後ほど説明しますが、コメントにコメントされた場合に$comment_idに値を渡すようになっております。

$comments = get_comments($post['id']);
foreach($comments as $comment):
if(empty($comment['comment_id'])):
$comment_user = get_user($comment['user_id']);
<div class="comment">
  <div class="user_info">
    <img src="/user/image/<?= $comment_user['image'] ?>">
    <?php print''.$comment_user['name'].''; ?>
  </div>
<span class="comment_text"><?= $comment['text'] ?></span>
<?php
if(!empty($comment['image'])){
print'<p class="comment_image"><img src="../comment/image/'.$comment['image'].'"></p>';
}
print'<span class="comment_created_at">'.convert_to_fuzzy_time($comment['created_at']).'</span>';
endif;
?>
