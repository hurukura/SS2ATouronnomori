<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>討論の杜｜ホーム</title>
    
    <style>
        button{
            display: inline-block;
            border-style: solid;
            background-color: lightgray;
            border-width:1px;
            border-color: darkgray;
            color: black;
            font-size: 1.4em;
            text-align: left;
            -moz-border-radius: 5px;
   　       -webkit-border-radius: 5px;
            border-radius: 5px;

            }
    </style>
    
    <h1><img src="images/touron.png" width="400" height="130"></h1>
    
    <h1>現在行われている討論</h1>
    
    
    <link rel="stylesheet" href="style.css">

</head>
<body>
    

    
   <button class="button1" onclick="touron()"style="width:50%">１．お題：<br>　　参加者：</button><br><br>
        
   <button class="button2" onclick="touron2()" style="width:50%">２．お題：<br>　　参加者：</button><br><br>
    
   <button class="button3" onclick="touron3()" style="width:50%">３．お題：<br>　　参加者：</button><br><br>
    
   <button class="button4" onclick="touron4()" style="width:50%">４．お題：<br>　　参加者：</button><br><br>
    
   <button class="button5" onclick="touron5()" style="width:50%">５．お題：<br>　　参加者：</button><br><br>
    
    <header>
        
        
    </header>
</body>
</html>

<script>

function touron(){
  ret = confirm("ルーム１に移動します");
  if (ret == true){
    location.href = "http://localhost/discussion.php";
  }
}
  function touron2(){
  ret = confirm("ルーム２に移動します");
  if (ret == true){
    location.href = "http://localhost/discussion.php";
  }
  }

  function touron3(){
  ret = confirm("ルーム３に移動します");
  if (ret == true){
    location.href = "http://localhost/discussion.php";
  }
  }
  function touron4(){
  ret = confirm("ルーム４に移動します");
  if (ret == true){
    location.href = "http://localhost/discussion.php";
  }
  }
  function touron5(){
  ret = confirm("ルーム５に移動します");
  if (ret == true){
    location.href = "http://localhost/discussion.php";
  }
  }
}

</script>



