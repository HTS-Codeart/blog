<?php // [h1] [h2] [a] [code] [img] [center] [b] [i] [u] 
session_start();
require_once('global.include.php');

$article = $_SESSION['article_info'];
if(!isset($article) || $article == '') {
	require_once(HEADER);
	require_once(NAVBAR);
	require_once(SIDEBAR);
	echo '<html>';
	echo 'Error: No article information to process. ';
	echo 'Please <a href="/articles.html?sub=1">try again!</a></html>';
	require_once(FOOTER);
}
else {
$save = $article;

$strips = array('[code]', '[/code]', '[h1]', '[/h1]', '[h2]', '[/h2]',
'[a]', '[/a]', '[img]', '[/img]', '[center]', '[/center]', '[b]', '[/b]',
'[i]', '[/i]', '[u]', '[/u]');
foreach($strips as $tag) {
	$article = str_replace($tag, '', $article);
}

echo '
<html>
<link href="highlighting/styles/doxy.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="highlighting/src/run_prettify.js"></script>
<body bgcolor="black">
<font size="6"><pre class=\"prettyprint\">
';

echo $article;
echo'</size></pre></html>';
/*echo "
<br/></br>
<font color=\"white\">Direct Source:</font><br/><textarea id=\"demo\" rows=\"10\" cols=\"50\">
$save
</textarea>
</html>";*/
}
?>