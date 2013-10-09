<?php
		if(isset($_POST['article']) && isset($_POST['articleName']) && isset($_POST['description'])
		&& $_POST['article'] != "" && $_POST['articleName'] != "" && $_POST['description'] != ""){
			$articleName = htmlentities($_POST['articleName']);	//sanatize all the things
			$description = htmlentities($_POST['description']);
			$input = htmlentities($_POST['article']);
			$url = "";
			$imgUrl = "";
			$len = strlen($input);
			$categories = ["networking","os","programming","re","security","web","other"];
			if( in_array($_POST['category'], $categories) ){
				$cat = $_POST['category'];
			}else{
				$cat = "other";
			}
			$article = "<div id=\"article\">";

			for($i = 0; $i < strlen($input); $i++){	//parse the input
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
							$pos = $i+1;
							$imgUrl = "";	//get the url
							while($input[$pos] != "[" && $pos < $len){
								$imgUrl .= $input[$pos];
								$pos++;
							}
							//help prevent csrf
							if( substr($imgUrl, -4) != ".png" && substr($imgUrl, -4) != ".jpg" && substr($imgUrl, -5) != ".jpeg" && substr($imgUrl, -4) != ".png"){
								$i += strlen($imgUrl);
							}
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
							$pos = $i+1;
							$url = "";	//get the url
							while($input[$pos] != "[" && $pos < $len){
								$url .= $input[$pos];
								$pos++;
							}
							break;
						case substr($tag, 0, 2) == "/a":
							$article .= "\">".$url."</a>";
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

			echo "<h2>".$articleName."</h2><br />";
			echo "Category: ".$cat."<br />";
			echo "Submitted: ".date('l jS \of F Y h:i:s A')."<br/>";
			echo "<h4>Description:</h4><br />".$description."<br /><br />";
			echo "<h4>Article:</h4><br />".$article;
		}else{
			echo "All Form must be filled.";
		}


?>
