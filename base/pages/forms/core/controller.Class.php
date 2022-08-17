<?php
class Connect extends PDO{
    public function __construct()
    {
        parent::__construct("mysql:host=localhost;dbname=bd_local",'root','',
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    }
}

class Controller{
    //  print data
   // funcion printData($id)
   // {
     //   $db = new Connect;
      //  $user $db -> prepapre (" SELECT * FROM tbl_user ORDER BY id");

   // }
    //check if user is logged in
    function checkUserStatus($id,$sess)
    {
        $db = new Connect;
        $user = $db -> prepare("SELECT id FROM tbl_user Where id=:id and session=:session ");
        $user -> execute([
            ':id'        => $id,
            ':session'   => $sess

        ]);
        $userInfo = $user -> fetch(PDO :: FETCH_ASSOC);
        if(!$userInfo["id"])
        {
            return false;
        }
        else 
        {
            return true;
        }
    }
    //generar char
    function generateCode($length){
        $chars = "vwyzABC01256";
        $code = "";
        $clean = strlen($chars) -1; 
        while(strlen($code) < $length )
        { 
            $code .=$chars[mt_rand(0,$clean)];
        }
        return $code;
    }
    //insert data
    function insertData($data){
        $db = new Connect;
        $checkUser = $db-> prepare("Select * from tbl_user where email=:email");
        $checkUser-> execute(['email'=> $data["email"]]);
        $info = $checkUser -> fetch(PDO :: FETCH_ASSOC);

        if(!$info["id"])
        {
            $session = $this -> generateCode (10);
            $inserUser = $db -> prepare("INSERT INTO tbl_user (id,f_name,l_name, avatar,email,password,session) value (:id,:f_name, :l_name, :avatar,:email,:password,:session)");
            $inserUser -> execute([
                ':id'=> 'US-'.$this->generateCode(5),
                ':f_name'=> $data["givenName"],
                ':l_name'=> $data["familyName"],
                ':avatar'=> $data["avatar"],
                ':email'=> $data["email"],
                ':password'=> $this -> generateCode(5),
                ':session'=> $session 
            ]);
            if($inserUser){
                setcookie("id",$db -> lastInsertId(),time()+60*60*24*30,"/",NULL);
                setcookie("sess",$session,time()+60*60*24*30,"/",NULL);
                header('Location: index1.php');
                exit();
            }else 
            {
                return "error inserting user";
            }
        }else 
        { 
            setcookie("id",$info["id"],time()+60*60*24*30,"/",NULL);
            setcookie("sess",$info["session"],time()+60*60*24*30,"/",NULL);
            header('Location: index1.php');
            exit();
        }
    }
}
?>