<?php


class DB{

    private $host = "localhost";
    private $user = "root";
    private $password = '';
    private $db_Name = 'cle3';
    private $connect;
    private $insert;
    private $update;
    private $delete;


    function __construct()
    {
        try {
                $this->connect = mysqli_connect($this->host, $this->user, $this->password, $this->db_Name);
            echo "geen error";
            }catch(Exception $e){
            echo '<h1>Error: </h1>', $e->getMessage();
        }

    }

    public function insert ($var1){
        $this->insert = "INSERT INTO `online_users`(`ID`, `user`) VALUES ('','$var1')";

        if(mysqli_query($this->connect, $this->insert)){
            echo "succes";
        }else{
            echo "faal";
        }

        /*if($this->connect){
            echo "<br>". $var1." opgeslagen in db";
        }else{
            echo "<br>failed";
        }*/

        mysqli_close($this->connect);
    }


}