
<!DOCTYPE html>

<html>

<head>
<meta charset="utf-8">
<title>特産横丁</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/immediate_change.css">

</head>
<body>
<header>
<h1><a href="index.php"><img src="images/logo.png" alt="ろご"></a></h1>
</header>
<!-- メインビジュアル -->
<main>
<p>変更が完了しました。</p>
<input type="button" value="決済ページに戻る" onclick="complete()" class="settlement1">
      <script>
        function complete() {
          window.close()
          window.opener.location.reload();
        }
      </script>
</main>
<!-- フッター -->
<hr>
<footer>
<div class="footer_copyright"><small>copyright &copy; 2019 K. All rights reserved.</small></div>
</footer>
</body>
</html>