<?php
class clscon
{
    public $link;
    function db_connect()
    {
        $host="localhost";
       $uname="root";
       $pwd="";
        $this->link=mysqli_connect($host,$uname,$pwd,"propertydb");
      //  $uname="easyrent_helly";
     //   $pwd="helly123#";
       // $this->link=mysqli_connect($host,$uname,$pwd,"easyrent_preet");
        return $this->link;
        }
        function db_close()
        {
            mysqli_close($this->link);
            
        }
      
    }
    ?>