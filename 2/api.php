<?php 
include_once "base.php";
$do=(!empty($_GET["do"]))?$_GET["do"]:"";

switch($do){
    case "reg":
        if(rc("user",["acc"=>$_POST["acc"]])){
            echo 0;
        }else{
            save("user",$_POST);
            echo 1;
        }
        break;
    case "login":
        if(rc("user",["acc"=>$_POST["acc"]])){
            if(rc("user",["acc"=>$_POST["acc"],"pw"=>$_POST["pw"]])){
                $_SESSION["login"]=$_POST["acc"];
                if($_POST["acc"]=="admin"){
                    echo 1;
                }else{
                    echo 2;
                }
            }else{
                echo 3;
            }
        }else{
            echo 4;
        }
        break;
    case "forget":
        $user = find("user",$_POST);
        if($user){
            echo "您的密碼為：".$user[0]["pw"];
        }else{
            echo "查無此資料";
        }
        break;
    case "getPo":
        echo json_encode(find("news",$_POST));
        break;
    case "delUser":
        if(!empty($_POST["del"])){
            foreach($_POST["del"] as $id){
                del("user",$id);
            }
        }
        gt("admin.php","do=user");
        break;
    case 'editNews':
        foreach($_POST as $id => $col){
            if(!empty($col["del"])){
                del("news",$id);
            }else{
                $col["id"]=$id;
                print_r($col);
                save("news",$col);
            }
        }
        gt("admin.php?do=news");
        break;
    case "addQue":
        foreach($_POST["opt"] as $opt){
            save("que",["title"=>$_POST["title"],"opt"=>$opt,"vote"=>0]);
        }
        gt("admin.php","do=que");
        break;
    case "queVote":
        $opt=find("que",$_POST["vote"])[0];
        $opt["vote"]++;
        save("que",$opt);
        $sum=qa("SELECT title, SUM(vote) as total FROM que WHERE title='".$opt["title"]."' GROUP BY title")[0]["total"];
        // echo "SELECT title, SUM(vote) as total FROM que WHERE title='".$opt["title"]."' GROUP BY title";
        gt("index.php","do=queResult&sum=$sum&title=".$opt["title"]);
        break;
    case "good":
        if($_POST["type"]==1){
            save("log",["nid"=>$_POST["id"],"user"=>$_POST["user"]]);
            $news=find("news",$_POST["id"])[0];
            $news['good']++;
            save("news",$news);
        }else{
            del("log",find("log",["nid"=>$_POST["id"],"user"=>$_POST["user"]])[0]["id"]);
            $news=find("news",$_POST["id"])[0];
            $news['good']--;
            save("news",$news);
        }
        break;
}
?>