<?php

session_start();
include_once 'config.php';

class GeneralFunction {

    function ReturnRentFor($type) {
        $returnType = '';
        if ($type == 'M') {
            $returnType = 'Monthly';
        } elseif ($type == 'Q') {
            $returnType = 'Quartly';
        } elseif ($type == 'Y') {
            $returnType = 'Yearly';
        } elseif ($type == 'O') {
            $returnType = 'One-Time';
        } else {
            $returnType = 'Monthly';
        }
        return $returnType;
    }

    function ReturnCommercialType($type) {
        $returnType = '';
        if ($type == 'O') {
            $returnType = 'Office';
        } elseif ($type == 'S') {
            $returnType = 'Shop';
        } elseif ($type == 'SH') {
            $returnType = 'ShowRoom';
        } elseif ($type == 'G') {
            $returnType = 'Godown';
        } else {
            $returnType = '';
        }
        return $returnType;
    }

    function ReturnPropertyFor($type) {
        $returnType = '';
        if ($type == 'B') {
            $returnType = 'Boys';
        } elseif ($type == 'G') {
            $returnType = 'Girls';
        } elseif ($type == 'F') {
            $returnType = 'Family';
        } else {
            $returnType = 'Boys';
        }
        return $returnType;
    }

    function ReturnFurnishedStatus($type) {
        $returnType = '';
        if ($type == 'F') {
            $returnType = 'Fully-Furnished';
        } elseif ($type == 'U') {
            $returnType = ' Un-Furnished';
        } elseif ($type == 'S') {
            $returnType = 'Semi-Furnished';
        } else {
            $returnType = 'Fully-Furnished';
        }
        return $returnType;
    }

    function ReturnBoolStatus($type) {
        $returnType = '';
        if ($type == 'N') {
            $returnType = 'No';
        } elseif ($type == 'Y') {
            $returnType = 'Yes';
        } else {
            $returnType = '';
        }
        return $returnType;
    }

    function ReturnNumber($type) {
        $returnType = '';
        if ($type == 1) {
            $returnType = 'One';
        } elseif ($type == 2) {
            $returnType = 'Two';
        } elseif ($type == 3) {
            $returnType = 'Three';
        } elseif ($type == 4) {
            $returnType = 'Four';
        } elseif ($type == 5) {
            $returnType = 'Five';
        } elseif ($type == 6) {
            $returnType = 'Six';
        } elseif ($type == 7) {
            $returnType = 'Seven';
        } elseif ($type == 8) {
            $returnType = 'Eight';
        } elseif ($type == 9) {
            $returnType = 'Nine';
        } elseif ($type == 10) {
            $returnType = 'Ten';
        } elseif ($type == 11) {
            $returnType = 'Eleven';
        } elseif ($type == 12) {
            $returnType = 'Twelve';
        } elseif ($type == 13) {
            $returnType = 'Thirteen';
        } elseif ($type == 14) {
            $returnType = 'Fourteen';
        } elseif ($type == 15) {
            $returnType = 'Fifteen';
        } elseif ($type == 16) {
            $returnType = 'Sixteen';
        } elseif ($type == 17) {
            $returnType = 'Seventeen';
        } elseif ($type == 18) {
            $returnType = 'Eighteen';
        } elseif ($type == 19) {
            $returnType = 'Nineteen';
        } elseif ($type == 20) {
            $returnType = 'Twenty';
        } else {
            $returnType = '';
        }
        return $returnType;
    }
  function ReturnFurnishedStatusArray() {
       
         $FurnishedStatusArray = array
            (
            array('F', "Fully-Furnished"),
            array('U', "Un-Furnished"),
            array('S', "Semi-Furnished"));
        return $FurnishedStatusArray;
    }
    function ReturnArrayForNumbers() {
        $Numbers = array
            (
            array(1, "One"),
            array(2, "Two"),
            array(3, "Three"),
            array(4, "Four"),
            array(5, "Five"),
            array(6, "Six"),
            array(7, "Seven"),
            array(8, "Eight"),
            array(9, "Nine"),
            array(10, "Ten"),
            array(11, "Eleven"),
            array(12, "Twelve"),
            array(13, "Thirteen"),
            array(14, "Fourteen"),
            array(15, "Fifteen"),
            array(16, "Sixteen"),
            array(17, "Seventeen"),
            array(18, "Eighteen"),
            array(19, "Nineteen"),
            array(20, "Twenty")
        );
       // return array_slice($Numbers,0,$arrayLength);
       return $Numbers;
    }
    function ReturnPGTypeArray() {
         $PgTypeArray = array
            (
            array('B', "Boys"),
            array('G', "Girls"));
        return $PgTypeArray;
    }
      function ReturnRentStructureArray() {
           $RentStructureArray = array
            (
            array('M', "Monthly"),
            array('Q', "Quartly"),
            array('Y', "Yearly"));
        return $RentStructureArray;
          
    }
   function ReturnMaintainesStructureArray() {
           $MaintainesStructureArray = array
            (
            array('M', "Monthly"),
            array('Q', "Quartly"),
            array('Y', "Yearly"),
            array('O', "One-Time")
               );
        return $MaintainesStructureArray;
          
    }
    function SendMessageByPhone($phoneNumber, $message) {
        //------------------sms sending---------
        $url = 'http://smslowprice.com/SendingSms.aspx';
        $fields = array('userid' => urlencode('vickysingla'),
            'pass' => urlencode('welcome@123'),
            'phone' => urlencode($phoneNumber),
            'msg' => urlencode($message));
        $fields_string = '';
        foreach ($fields as $key => $value) {
            $fields_string .=$key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');
        $url_final = $url . '?' . $fields_string;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_final);
        $result = curl_exec($ch);
        curl_close($ch);
//------------------------------
    }

}

class clscat {

    public $catcode, $catname;

    function save_cat() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call inscat('$this->catname')";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function update_cat() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call updcat($this->catcode,'$this->catname')";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function delete_cat() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call delcat($this->catcode)";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function dsp_cat() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call dspcat()";
        $res = mysqli_query($link, $qry);
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

    function find_cat() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call findcat($this->catcode)";
        $res = mysqli_query($link, $qry);
        if (mysqli_num_rows($res) > 0) {
            $r = mysqli_fetch_row($res);
            $this->catcode = $r[0];
            $this->catname = $r[1];
        }
        $con->db_close();
    }

}

class classUserAlerts {

    // `UserAlertsId`, `PropertyType`, `FurnishedStatus`, `Location`, `UserId`
    public $UserAlertsId, $PropertyType, $FurnishedStatus, $Location, $UserId;

    function SaveUserAlerts() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call InsertUserAlerts('$this->PropertyType',$this->Location,$this->UserId)";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function DeleteUserAlerts() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call DeleteUserAlert($this->UserAlertsId)";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function DispalyUserAlerts($logincode) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call GetUserAlerts($logincode)";
        $res = mysqli_query($link, $qry);
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

}

class classUserTestimonials {

    // `UserAlertsId`, `PropertyType`, `FurnishedStatus`, `Location`, `UserId`
    public $Code, $Month, $Picture, $UserName, $Text, $Isactive;

    function SaveTestimonial() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call insertTestimonial('$this->UserName','$this->Text','$this->Month','$this->Picture',@cod)";
        $res = mysqli_query($link, $qry)or die(mysqli_error($link));
        $res1 = mysqli_query($link, "select @cod") or die(mysqli_error($link));
        $r = mysqli_fetch_row($res1);
        $Tcod = $r[0];
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return $Tcod;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function DeleteTestimonial() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call DeleteUserTestimonial($this->Code)";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function DispalyActiveTestimonials() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call DispalyActiveTestimonials()";
        $res = mysqli_query($link, $qry);
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

}

class clsreg {

    public $regcode, $regemail, $regpwd, $regdate, $regrol;

    function save_reg() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call insreg('$this->regemail','$this->regpwd','$this->regdate','$this->regrol',@cod)";
        $res = mysqli_query($link, $qry);
        if (!$res) {
            return mysqli_errno($link);
        }
        $res1 = mysqli_query($link, "select @cod") or die(mysqli_error($link));

        $r = mysqli_fetch_row($res1);
        $rcod = $r[0];
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return $rcod;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function update_reg() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call updreg($this->regcode,'$this->regemail','$this->regpwd',$this->regdate,$this->regrol)";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function delete_reg() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call delreg($this->regcode,'$this->regemail','$this->regpwd',$this->regdate,$this->regrol)";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function dsp_reg() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call dspreg()";
        $res = mysqli_query($link, $qry);
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

    function find_reg() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call findreg($this->regcod)";
        $res = mysqli_query($link, $qry);
        if (mysqli_num_rows($res) > 0) {
            $r = mysqli_fetch_row($res);
            $this->regcod = $r[0];
            $this->regeml = $r[1];
            $this->regpwd = $r[2];
            $this->regdat = $r[3];
            $this->regrol = $r[4];
        }
        $con->db_close();
    }

    function logincheck($eml, $pwd) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call logincheck('$eml','$pwd',@cod,@rol)";
        $res = mysqli_query($link, $qry) or die(mysqli_error($link));
        $res1 = mysqli_query($link, "select @cod,@rol") or die(mysqli_error($link));
        $r = mysqli_fetch_row($res1);
        // echo $r[0];
        if ($r[0] == -1) {
            $con->db_close();
            return 'N';
        } else {
            $_SESSION["lcod"] = $r[0];
            $a = $r[1];
            $con->db_close();
            return $a;
        }
    }

    function ChangePassword($password, $registrationCode) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call ChangePassword('$password','$registrationCode',@phone)";
        $res = mysqli_query($link, $qry) or die(mysqli_error($link));
        $res1 = mysqli_query($link, "select @phone") or die(mysqli_error($link));
        $r = mysqli_fetch_row($res1);
        // echo $r[0];
        if ($r[0] == -1) {
            $con->db_close();
            return 'N';
        } else {
            $ReturnedPhone = $r[0];
            $con->db_close();
            return $ReturnedPhone;
        }
    }

    function UpdateOTPStatus($eml, $pwd, $otp) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call UpdateOTPStatus('$eml','$pwd','$otp',@cod,@rol)";
        $res = mysqli_query($link, $qry) or die(mysqli_error($link));
        $res1 = mysqli_query($link, "select @cod,@rol") or die(mysqli_error($link));
        $r = mysqli_fetch_row($res1);
        // echo $r[0];
        if ($r[0] == -1) {
            $con->db_close();
            return 'N';
        } else {
            $_SESSION["lcod"] = $r[0];
            $a = $r[1];
            $con->db_close();
            return $a;
        }
    }

    function ResetPassword($PhoneNumber) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call ResetPassword('$PhoneNumber',@Status)";
        $res = mysqli_query($link, $qry) or die(mysqli_error($link));
        $res1 = mysqli_query($link, "select @Status") or die(mysqli_error($link));
        $r = mysqli_fetch_row($res1);
        // echo $r[0];
        if (isset($r)) {
            $con->db_close();
            return $r[0];
        }
    }

}

class clssubcat {

    public $subcatcode, $subcatname, $subcatcatcode;

    function save_subcat() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call inssubcat('$this->subcatname',$this->subcatcatcode)";
        // echo $qry;
        $res = mysqli_query($link, $qry) or die(mysqli_error($link));
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function update_subcat() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call updsubcat($this->subcatcode,'$this->subcatname',$this->subcatcatcode)";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function delete_subcat() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call delsubcat($this->subcatcode)";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function dsp_subcat($sccod) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call dspsubcat($sccod)";
        $res = mysqli_query($link, $qry) or die(mysqli_error($link));
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

    function find_subcat() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call findsubcat($this->subcatcode)";
        $res = mysqli_query($link, $qry);
        if (mysqli_num_rows($res) > 0) {
            $r = mysqli_fetch_row($res);
            $this->subcatcode = $r[0];
            $this->subcatname = $r[1];
            $this->subcatcatname = $r[2];
        }
        $con->db_close();
    }

}

class clspg {

    public $pgtit, $pgcod, $pgtyp, $pgloc, $pglndmrk, $pgadd, $pgrnt, $pgrntfor, $pgscrty, $pgocrg, $pgnoofseats, $pgavlfrm, $pgdsc, $pgsts, $pgregcod, $pgnoper, $pgfursts, $pgdelsts, $pglat, $pglong, $pgmntcrg, $pgmntcrgfor, $pgregdat;

    function save_pg() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call inspg('$this->pgtit','$this->pgtyp','$this->pgloc','$this->pglndmrk','$this->pgadd','$this->pgrnt','$this->pgrntfor','$this->pgscrty','$this->pgocrg','$this->pgnoofseats','$this->pgavlfrm','$this->pgdsc','$this->pgsts','$this->pgregcod','$this->pgnoper','$this->pgfursts','$this->pgdelsts','$this->pglat','$this->pglong','$this->pgmntcrg','$this->pgmntcrgfor','$this->pgregdat',@cod)";
        $res = mysqli_query($link, $qry)or die(mysqli_error($link));
        $res1 = mysqli_query($link, "select @cod") or die(mysqli_error($link));
        $r = mysqli_fetch_row($res1);
        $pgcod = $r[0];
        // echo $pgcod;
        if (mysqli_affected_rows($link)) {
            unset($_SESSION["cpcod"]);
            unset($_SESSION["flocod"]);
            unset($_SESSION["huscod"]);
            $_SESSION["pgcod"] = $pgcod;
            $con->db_close();
            return $res;
        } else {
            $_SESSION["pgcod"] = 0;
            $con->db_close();
            return FALSE;
        }
    }
 function Update_pg() {
       $con = new clscon();
        $link = $con->db_connect();
        $qry = "call UpdatePG('$this->pgcod','$this->pgtit','$this->pgtyp','$this->pgloc','$this->pglndmrk','$this->pgadd','$this->pgrnt','$this->pgrntfor','$this->pgscrty','$this->pgocrg','$this->pgnoofseats','$this->pgavlfrm','$this->pgdsc','$this->pgnoper','$this->pgfursts','$this->pgdelsts','$this->pgmntcrg','$this->pgmntcrgfor')";
        $res = mysqli_query($link, $qry)or die(mysqli_error($link));
      //  $res1 = mysqli_query($link, "select @cod") or die(mysqli_error($link));
       // $r = mysqli_fetch_row($res1);
       // $pgcod = $r[0];
        // echo $pgcod;
        if (mysqli_affected_rows($link)) {
           
            $con->db_close();
            return $res;
        } else {
          
            $con->db_close();
            return FALSE;
        }
    }

}

class ContactForm {

    public $contactFormName, $contactFormEmail, $contactFormSubject, $contactFormMessage, $contactFormDate;

    function saveContactForm() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call insertContactForm('$this->contactFormName','$this->contactFormEmail','$this->contactFormSubject','$this->contactFormMessage','$this->contactFormDate')";
        $res = mysqli_query($link, $qry)or die(mysqli_error($link));
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return $res;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    //GetContactForm method to get contact form who are not deleted and order by date desc
    function GetContactForm() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call GetContactForm()";
        $res = mysqli_query($link, $qry);
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

}

class clspgpic {

    public $pgpiccod, $pgpicfil, $pgpicdsc, $pgpicpgcod, $pgpictyp;

    function save_pgpic() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call inspgpic('$this->pgpicfil','$this->pgpicdsc','$this->pgpicpgcod','$this->pgpictyp')";
        $res = mysqli_query($link, $qry);



        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {

            $con->db_close();
            return FALSE;
        }
    }

    function DisplayPicsByIdAndType($cod, $typ) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call dsppgpics('$cod','$typ')";
        $res = mysqli_query($link, $qry)or die(mysqli_error($link));
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

    function GetPropertyPicturesCount($cod, $typ) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call GetPropertyPicturesCount('$cod','$typ')";
        $res = mysqli_query($link, $qry)or die(mysqli_error($link));

        $r = mysqli_fetch_row($res);
        if (isset($r[0])) {
            $con->db_close();
            return $r[0];
        } else {
            $con->db_close();
            return 0;
        }
    }

    function fndlstpgpic() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call fndlstpgpic(@cod)";
        $res = mysqli_query($link, $qry);
        $res1 = mysqli_query($link, "select @cod");
        $r = mysqli_fetch_row($res1);

        echo $r[0];
        return $r[0];

        $con->db_close();
    }

    function DeletePropertyPics() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call DeletePropertyPics($this->pgpiccod)";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

}

class clsfac {

    public $faccode, $facname, $factype;

    function save_fac() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call insfac('$this->facname','$this->factype')";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function update_fac() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call updfac($this->faccode,'$this->facname','$this->factype')";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function delete_fac() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call delfac($this->faccode)";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function dsp_fac() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call dspfac('$this->factype')";
        $res = mysqli_query($link, $qry)or die(mysqli_error($link));
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

    function find_fac() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call findfac($this->faccode)";
        $res = mysqli_query($link, $qry);
        if (mysqli_num_rows($res) > 0) {
            $r = mysqli_fetch_row($res);
            $this->faccode = $r[0];
            $this->facname = $r[1];
        }
        $con->db_close();
    }

}

class clsfacprp {

    public $code, $faccode, $prpcod, $type;

    function save_facprp() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call insfacprp($this->faccode,$this->prpcod,'$this->type')";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function DeleteAllFeaturesByUser() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call DeleteAllFeaturesByUser('$this->prpcod','$this->type')";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function dsp_facprp() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call DisplayPropertyFacilityByIdAndType('$this->prpcod','$this->type')";
        $res = mysqli_query($link, $qry)or die(mysqli_error($link));
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

}

class clsflo {

    public $flofor, $floloc, $flolndmrk, $floadd, $flobdrm, $flobthrm, $floblcny, $floktchn, $flolvrm, $flofursts, $floflono, $floflotot, $flornt, $florntfor, $floocrg, $floscrty, $flomntcrg, $flomntcrgfor, $flosts, $floregcod, $floavlfrm, $flodsc, $flodelsts, $flolat, $flolong, $flototare, $floareunt, $floregdat;

    function save_flo() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call insflo('$this->flofor','$this->floloc','$this->flolndmrk','$this->floadd','$this->flobdrm','$this->flobthrm','$this->floblcny','$this->floktchn','$this->flolvrm','$this->flofursts','$this->floflono','$this->floflotot','$this->flornt','$this->florntfor','$this->floocrg','$this->floscrty','$this->flomntcrg','$this->flomntcrgfor','$this->flosts','$this->floregcod','$this->floavlfrm','$this->flodsc','$this->flodelsts','$this->flolat','$this->flolong','$this->flototare','$this->floareunt','$this->floregdat',@cod)";
        $res = mysqli_query($link, $qry);
        $res1 = mysqli_query($link, "select @cod") or die(mysqli_error($link));
        $r = mysqli_fetch_row($res1);
        $pgcod = $r[0];
        // echo $pgcod;
        if (mysqli_affected_rows($link)) {
            unset($_SESSION["pgcod"]);
            unset($_SESSION["cpcod"]);
            unset($_SESSION["huscod"]);
            $_SESSION["flocod"] = $pgcod;
            $con->db_close();
            return TRUE;
        } else {
            $_SESSION["flocod"] = 0;
            $con->db_close();
            return FALSE;
        }
    }

}

class clshus {

    public $husfor, $husloc, $huslndmrk, $husadd, $husbdrm, $husbthrm, $husblcny, $huslby, $huslvrm, $husktchn, $husfursts, $hustotare, $husrnt, $husrntfor, $husscrty, $husmntcrg, $husmntcrgfor, $husocrg, $husavlfrm, $husdsc, $hussts, $husregcod, $husdelsts, $huslat, $huslong, $husareunt, $husstryblt, $husregdat;

    function save_hus() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call inshus('$this->husfor','$this->husloc','$this->huslndmrk','$this->husadd','$this->husbdrm','$this->husbthrm','$this->husblcny','$this->huslby','$this->huslvrm','$this->husktchn','$this->husfursts','$this->hustotare','$this->hussts','$this->husregcod','$this->husrnt','$this->husrntfor','$this->husscrty','$this->husmntcrg','$this->husmntcrgfor','$this->husocrg','$this->husavlfrm','$this->husdsc','$this->husdelsts','$this->huslat','$this->huslong','$this->husareunt','$this->husstryblt','$this->husregdat',@cod)";
        $res = mysqli_query($link, $qry);
        $res1 = mysqli_query($link, "select @cod") or die(mysqli_error($link));
        $r = mysqli_fetch_row($res1);
        $pgcod = $r[0];
        // echo $pgcod;
        if (mysqli_affected_rows($link)) {
            unset($_SESSION["pgcod"]);
            unset($_SESSION["flocod"]);
            unset($_SESSION["cpcod"]);
            $_SESSION["huscod"] = $pgcod;
            $con->db_close();
            return TRUE;
        } else {
            $_SESSION["huscod"] = 0;
            $con->db_close();
            return FALSE;
        }
    }

}

class clscp {

    public $cptyp, $cploc, $cplndmrk, $cpadd, $cppbthrm, $cpppntry, $cpflono, $cptotflo, $cparecov, $cprdfac, $cprnt, $cprntfor, $cpmntcrg, $cpmntcrgfor, $cpocrg, $cpavlfrm, $cpagefconst, $cpdsc, $cpregcod, $cpsts, $cpregdat, $cpdelsts, $cplat, $cplong, $cpscrty, $cpareunt, $cpfursts;

    function save_cp() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call inscp('$this->cptyp','$this->cploc','$this->cplndmrk','$this->cpadd','$this->cppbthrm','$this->cpppntry','$this->cpflono','$this->cptotflo','$this->cparecov','$this->cprdfac','$this->cprnt','$this->cprntfor','$this->cpmntcrg','$this->cpmntcrgfor','$this->cpocrg','$this->cpavlfrm','$this->cpagefconst','$this->cpdsc','$this->cpregcod','$this->cpsts','$this->cpregdat','$this->cpdelsts','$this->cplat','$this->cplong','$this->cpscrty','$this->cpareunt','$this->cpfursts',@cod)";
        $res = mysqli_query($link, $qry);
        $res1 = mysqli_query($link, "select @cod") or die(mysqli_error($link));
        $r = mysqli_fetch_row($res1);
        $pgcod = $r[0];
        // echo $pgcod;
        if (mysqli_affected_rows($link)) {
            unset($_SESSION["pgcod"]);
            unset($_SESSION["flocod"]);
            unset($_SESSION["huscod"]);
            $_SESSION["cpcod"] = $pgcod;
            $con->db_close();
            return TRUE;
        } else {
            $_SESSION["cpcod"] = 0;
            $con->db_close();
            return FALSE;
        }
    }

}

class clsprf {

    public $prfcode, $prfname, $prfphn, $prftype, $prfregcod, $prfaddress, $prfcmp, $prfpic, $prfIsActive, $Otp, $otpIsApproved, $prfLocation;

    function save_prf() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call insprf('$this->prfname','$this->prfphn','$this->prftype','$this->prfregcod','$this->prfaddress','$this->prfcmp','$this->prfpic','$this->prfIsActive','$this->Otp','$this->otpIsApproved','$this->prfLocation',@cod)";
        $res = mysqli_query($link, $qry);
        if (!$res) {
            return mysqli_errno($link);
        }
        $res1 = mysqli_query($link, "select @cod") or die(mysqli_error($link));
        $r = mysqli_fetch_row($res1);
        $pcod = $r[0];
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return $pcod;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function UpdateUserStatus($cod, $sts) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call updateUserStatus($cod,$sts)";
        // echo $qry;
        $res = mysqli_query($link, $qry) or die(mysqli_error($link));
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function update_prf() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call UpdateUserProfile($this->prfcode,'$this->prfname','$this->prfaddress','$this->prfcmp','$this->prfpic')";
        // echo $qry;
        $res = mysqli_query($link, $qry) or die(mysqli_error($link));
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function delete_prf() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call delprf($this->prfcode)";
        $res = mysqli_query($link, $qry);
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function dsp_prf() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call dspprf($this->prfcode)";
        $res = mysqli_query($link, $qry)or die(mysqli_error($link));
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

    function DisplayUsersAdmin() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call DisplayUsersAdmin()";
        $res = mysqli_query($link, $qry)or die(mysqli_error($link));
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

    function find_prf() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call findfac($this->prfcode)";
        $res = mysqli_query($link, $qry);
        if (mysqli_num_rows($res) > 0) {
            $r = mysqli_fetch_row($res);
            $this->prfcode = $r[0];
            $this->prfname = $r[1];
            $this->prfphn = $r[2];
            $this->prftyp = $r[3];
            $this->prfregcod = $r[4];
            $this->prfaddress = $r[5];
            $this->prfcmp = $r[6];
            $this->prfpic = $r[7];
        }
        $con->db_close();
    }

    function dsp_prfbyusercod($lcod) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call dspusrprf($lcod)";
        $res = mysqli_query($link, $qry);
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

    function DisplayProfileByPropertyID($pcod, $typ) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call DiplayUserProfileByPropertyId($pcod,'$typ')";
        $res = mysqli_query($link, $qry)or die(mysqli_error($link));
        ;
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

    function DisplayAllAgentsByLocationID($loc) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call DisplayAllAgentsByLocation('$loc')";
        $res = mysqli_query($link, $qry)or die(mysqli_error($link));
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

    function DisplayAgentsByAgentId($AgentId) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call DisplayAgentsByAgentId('$AgentId')";
        $res = mysqli_query($link, $qry)or die(mysqli_error($link));
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

}

class clsprop {

    function dsp_prpbyuser($lcod) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call dspusrprp($lcod)";
        $res = mysqli_query($link, $qry);
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

    function dsp_propertiesForAdmin() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call ManageAllProperiesForAdmin";
        $res = mysqli_query($link, $qry);
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

    function UpdatePropertyStatus($cod, $type, $sts) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call updatePropertyStatus($cod,'$type',$sts)";
        // echo $qry;
        $res = mysqli_query($link, $qry) or die(mysqli_error($link));
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }
    function UpdatePropertyDeleteStatus($cod, $type, $sts) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call updatePropertyDeleteStatus($cod,'$type',$sts)";
        // echo $qry;
        $res = mysqli_query($link, $qry) or die(mysqli_error($link));
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }
    function UpdatePropertyIndexStatus($cod, $type, $sts) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call updatePropertyIndexStatus($cod,'$type',$sts)";
        // echo $qry;
        $res = mysqli_query($link, $qry) or die(mysqli_error($link));
        if (mysqli_affected_rows($link)) {
            $con->db_close();
            return TRUE;
        } else {
            $con->db_close();
            return FALSE;
        }
    }

    function DisplayRecentProperties() {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call DisplayRecentProperties()";
        $res = mysqli_query($link, $qry);
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

    function DisplayIndexSearch($loc, $typ, $cat) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call DspIndexSearchResult('$loc','$typ','$cat')";
        $res = mysqli_query($link, $qry)or die(mysqli_error($link));
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

    function DisplayInnerSearch($location, $type, $category, $FurnishedStatus, $NoOfBedrooms, $commercial, $PriceStart, $PriceEnd, $PriceUnits) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call DspInnerSearchResult('$location','$type','$category','$FurnishedStatus','$NoOfBedrooms','$commercial','$PriceStart','$PriceEnd','$PriceUnits')";
        $res = mysqli_query($link, $qry)or die(mysqli_error($link));
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_row($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

    function DisplayMoreDetailProperty($ptyp, $typ) {
        $con = new clscon();
        $link = $con->db_connect();
        $qry = "call DisplayPropertyDetailByID('$ptyp','$typ')";
        $res = mysqli_query($link, $qry)or die(mysqli_error($link));
        $i = 0;
        $arr = array();
        while ($r = mysqli_fetch_array($res)) {
            $arr[$i] = $r;
            $i++;
        }
        $con->db_close();
        return $arr;
    }

}

?>