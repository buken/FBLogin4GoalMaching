<?php
require_once ("src/facebook.php");

$config = array('appId' => '181338932010860', 'secret' => 'a3a153539bec474f9041d8c833aaafbf');

$facebook = new Facebook($config);

if ($facebook -> getUser()) {
	try {
		$user = $facebook -> api('/me', 'get');
	} catch(FacebookApiException $e) {
		// 取得に失敗したら例外をキャッチしてエラーログに出力
		error_log($e -> getType());
		error_log($e -> getMessage());
	}
}
?>
<html>
	<body>
		<?php
		if (isset($user)) {
			// ログイン済みでユーザ情報がとれていれば表示
			echo '<pre>';
			print_r($user);
			echo '</pre>';
		} else {
			// 未ログインならログイン
			$loginUrl = $facebook -> getLoginUrl();
			echo '<a href="' . $loginUrl . '">Ligin with Facebook</a>';
		}
		?>
	</body>
</html>
