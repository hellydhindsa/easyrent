<?php
class clscon
{
    public $link;
    function db_connect()
    {
       $host="localhost";
       //local connection
       
       $uname="root";
      $pwd="";
       $this->link=mysqli_connect($host,$uname,$pwd,"propertydb");
     
       // server connection
     // $uname="wwweasyr_6";
       // $pwd="Helly123#";
        //$this->link=mysqli_connect($host,$uname,$pwd,"wwweasyr_6");
        return $this->link;
        }
        function db_close()
        {
            mysqli_close($this->link);
            
        }
      
    }
    ?>