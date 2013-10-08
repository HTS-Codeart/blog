<?php
		if(isset($_POST['article'])){
		//parse the input
			$input = htmlentities($_POST['article']);
			$article = "<div id=\"article\">";
			for($i = 0; $i < strlen($input); $i++){
				if($input[$i] == "\n"){
					$article .= "<br />";
				}else if($input[$i] == "\t"){
					$article .= "&nbsp;&nbsp;&nbsp;&nbsp;";
				}else if($input[$i] == " "){
					$article .= "&nbsp;";
				}else if($input[$i] == "["){	//tags
					$tag = substr($input, $i+1, 7);					
					switch($tag){
						case substr($tag, 0, 2) == "h1":
							$article .= "<h2>";	
							$i += 3;
							break;
						case substr($tag, 0, 3) == "/h1":
							$article .= "</h2>";
							$i += 4;
							break;
						case substr($tag, 0, 2) == "h2":
							$article .= "<h3>";
							$i += 3;
							break;
						case substr($tag, 0, 3) == "/h2":
							$article .= "</h3>";
							$i += 4;
							break;
						case substr($tag, 0, 4) == "code":
							$article .= "<div id=\"code\">";
							$i += 5;
							break;
						case substr($tag, 0, 5) == "/code":
							$article .= "</div>";
							$i += 6;
							break;
						case substr($tag, 0, 3) == "img":
							$article .= "<img src=\"";	
							$i += 4;
							break;
						case substr($tag, 0, 4) == "/img":
							$article .= "\"/>";
							$i += 5;
							break;
						case substr($tag, 0, 1) == "b":
							$article .= "<strong>";
							$i += 2;
							break;
						case substr($tag, 0, 2) == "/b":
							$article .= "</strong>";
							$i += 3;
							break;
						case substr($tag, 0, 1) == "i":
							$article .= "<i>";
							$i += 2;
							break;
						case substr($tag, 0, 2) == "/i":
							$article .= "</i>";
							$i += 3;
							break;
						case substr($tag, 0, 1) == "u":
							$article .= "<u>";
							$i += 2;
							break;
						case substr($tag, 0, 2) == "/u":
							$article .= "</u>";
							$i += 3;
							break;
						case substr($tag, 0, 6) == "center":
							$article .= "<center>";
							$i += 7;
							break;
						case substr($tag, 0, 7) == "/code":
							$article .= "</center>";
							$i += 8;
							break;
						case substr($tag, 0, 1) == "a":
							$article .= "<a href=\"";	
							$i += 2;
							break;
						case substr($tag, 0, 2) == "/a":
							$article .= "\">here</a>";
							$i += 3;
							break;
						default:
							break;
					}	
				}else{
					$article .= $input[$i];
				}				
			}
			$article .= "</div>";
			echo $article;
		}


?>
Allowed tags:<br />[h1][/h1]&nbsp;[h2][/h2]&nbsp;[code][/code]&nbsp;[img][/img]&nbsp;[center][/center]&nbsp;[b][/b]&nbsp;[i][/i]&nbsp;[u][/u]&nbsp;[a][/a]
<form method="post" action="articles.php" name="articleForm">
	<textarea rows="30" cols="100" name="article" value="" >
	</textarea>	
	<input type="submit" />
</form>

