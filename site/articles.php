<?php

if(isset($_POST['article']) && isset($_POST['articleName']) && isset($_POST['description'])
		&& $_POST['article'] != "" && $_POST['articleName'] != "" && $_POST['description'] != ""){
			$articleName = htmlentities($_POST['articleName']);	//sanatize all the things
			$description = htmlentities($_POST['description']);
			$input = htmlentities($_POST['article']);
			$url = "";
			$imgUrl = "";
			$len = strlen($input);
			$categories = array("networking","os","programming","re","security","web","other");
			if( in_array($_POST['category'], $categories) ){
				$cat = $_POST['category'];
			}else{
				$cat = "other";
			}
			$article = "<div id=\"article\" class=\"blog_entry\">";
			$partOfCode = false;
			$numOpenTags = 0;

			for($i = 0; $i < strlen($input); $i++){	//parse the input
				if($input[$i] == "\n"){
					$article .= "<br />";
				}else if($input[$i] == "\t"){
					$article .= "&nbsp;&nbsp;&nbsp;&nbsp;";
				}else if($input[$i] == " "){
					$article .= "&nbsp;";
				}else if($input[$i] == "[" && !$partOfCode){	//tags
					$tag = substr($input, $i+1, 7);
					switch($tag){
						case substr($tag, 0, 4) == "code":
							$article .= "<strong>Code:</strong><br /><div id=\"code\">";
							$i += 5;
							$numOpenTags += 1;
							$partOfCode = true;
							break;
						case substr($tag, 0, 2) == "h1":
							$article .= "<h2>";
							$i += 3;
							$numOpenTags += 1;
							break;
						case substr($tag, 0, 3) == "/h1":
							$article .= "</h2>";
							$i += 4;
							$numOpenTags -= 1;
							break;
						case substr($tag, 0, 2) == "h2":
							$article .= "<h3>";
							$i += 3;
							$numOpenTags += 1;
							break;
						case substr($tag, 0, 3) == "/h2":
							$article .= "</h3>";
							$i += 4;
							$numOpenTags -= 1;
							break;
						case substr($tag, 0, 3) == "img":
							$pos = $i+1;
							$imgUrl = "";	//get the url
							while($input[$pos] != "[" && $pos < $len){
								$imgUrl .= $input[$pos];
								$pos++;
							}
							//help prevent csrf
							if( substr($imgUrl, -4) != ".png" && substr($imgUrl, -4) != ".jpg" && substr($imgUrl, -5) != ".jpeg" && substr($imgUrl, -4) != ".png" 
							&& substr($imgUrl, -4) != ".gif"){
								$i += strlen($imgUrl) + 6;
								$article .= "[INVALID IMAGE]";
							}else{
								$article .= "<img src=\"";
								$i += 4;
								$numOpenTags += 1;
							}
							break;
						case substr($tag, 0, 4) == "/img":
							$article .= "\"/>";
							$i += 5;
							$numOpenTags -= 1;
							break;
						case substr($tag, 0, 1) == "b":
							$article .= "<strong>";
							$i += 2;
							$numOpenTags += 1;
							break;
						case substr($tag, 0, 2) == "/b":
							$article .= "</strong>";
							$i += 3;
							$numOpenTags -= 1;
							break;
						case substr($tag, 0, 1) == "i":
							$article .= "<i>";
							$i += 2;
							$numOpenTags += 1;
							break;
						case substr($tag, 0, 2) == "/i":
							$article .= "</i>";
							$i += 3;
							$numOpenTags -= 1;
							break;
						case substr($tag, 0, 1) == "u":
							$article .= "<u>";
							$i += 2;
							$numOpenTags += 1;
							break;
						case substr($tag, 0, 2) == "/u":
							$article .= "</u>";
							$i += 3;
							$numOpenTags -= 1;
							break;
						case substr($tag, 0, 6) == "center":
							$article .= "<center>";
							$i += 7;
							$numOpenTags += 1;
							break;
						case substr($tag, 0, 7) == "/center":
							$article .= "</center>";
							$i += 8;
							$numOpenTags -= 1;
							break;
						case substr($tag, 0, 1) == "a":
							$i += 2;
							if($i+1 < $len){
								$pos = $i+1;
								$url = "";	//get the url
								while($input[$pos] != "[" && $pos < $len){
									$url .= $input[$pos];
									$pos++;
								}
							}else $url = "";
							if(filter_var($url, FILTER_VALIDATE_URL)) {
								$article .= "<a href=\"";
								$numOpenTags += 1;
							}else{
								$article .= "[INVALID URL]";
								$i += strlen($url)+4;
							}
							break;
						case substr($tag, 0, 2) == "/a":
							$article .= "\">".$url."</a>";
							$i += 3;
							$numOpenTags -= 1;
							break;
						default:
							break;
					}
				}else if( $input[$i] == "["){
					$tag = substr($input, $i+1, 7);
					if(substr($tag, 0, 5) == "/code"){
						$article .= "</div>";
						$i += 6;
						$numOpenTags -= 1;
						$partOfCode = false;
					}else{
						$article .= $input[$i];
					}
				}else{
					$article .= $input[$i];
				}
			}
			$article .= "</div></div>";

			if($numOpenTags == 0){
				//submit to db
				header("Location: articles.html?sub=2");
				die();
			}else{
				echo "All tags must be closed.";
			}
}


?>

