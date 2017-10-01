-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2017 at 05:51 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `propertydb`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `abc`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `abc` (IN `fgfg` INT)  NO SQL
    DETERMINISTIC
begin
end$$

DROP PROCEDURE IF EXISTS `ChangePassword`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ChangePassword` (IN `password` VARCHAR(50), IN `registrationCode` INT, OUT `phone` VARCHAR(50))  NO SQL
begin
declare actphone varchar(50);
select prfphn from tbprf profile, tbreg registration where registration.regcod=profile.prfregcod AND registration.regcod = registrationCode into @actphone;
update tbreg set regpwd=password where regcod = registrationCode;
 set phone = @actphone;
end$$

DROP PROCEDURE IF EXISTS `delcat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delcat` (IN `ccod` INT)  NO SQL
begin
delete from tbcat where catcod=ccod;
end$$

DROP PROCEDURE IF EXISTS `delcp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delcp` (IN `ccod` INT)  NO SQL
begin
delete from tbcp where cpcod=ccod;
end$$

DROP PROCEDURE IF EXISTS `DeleteUserAlert`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteUserAlert` (IN `cod` INT)  NO SQL
BEGIN
DELETE from tbuseralerts where userAlertsId=cod;
END$$

DROP PROCEDURE IF EXISTS `DeleteUserTestimonial`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteUserTestimonial` (IN `cod` INT)  NO SQL
BEGIN
DELETE from tbtestimonial where code=cod;
END$$

DROP PROCEDURE IF EXISTS `delfac`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delfac` (IN `ccod` INT)  NO SQL
begin
delete from tbpgfac where pgfaccod=ccod;
end$$

DROP PROCEDURE IF EXISTS `delfacprp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delfacprp` (IN `cod` INT)  NO SQL
begin
delete from tbfacprp where facprpcod=cod;
end$$

DROP PROCEDURE IF EXISTS `delflo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delflo` (IN `fcod` INT)  NO SQL
begin
delete from tbflo where flocod=fcod;
end$$

DROP PROCEDURE IF EXISTS `delhus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delhus` (IN `hcod` INT)  NO SQL
begin
delete from tbhus where huscod=hcod;
end$$

DROP PROCEDURE IF EXISTS `delpg`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delpg` (IN `pcod` INT)  NO SQL
begin
delete from tbpg where pgcod=pcod;
end$$

DROP PROCEDURE IF EXISTS `delpgpic`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delpgpic` (IN `pcod` INT)  NO SQL
begin
delete from tbpgpic where pgpiccod=pcod;
end$$

DROP PROCEDURE IF EXISTS `delprf`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delprf` (IN `pcod` INT)  NO SQL
begin
delete from tbprf where prfcod=pcod;
end$$

DROP PROCEDURE IF EXISTS `delreg`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delreg` (IN `rcod` INT)  NO SQL
begin
delete from tbreg where regcod=rcod;
end$$

DROP PROCEDURE IF EXISTS `delsubcat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delsubcat` (IN `sccod` INT)  NO SQL
begin
delete from tbsubcat where subcatcod=sccod;
end$$

DROP PROCEDURE IF EXISTS `DiplayUserProfileByPropertyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DiplayUserProfileByPropertyId` (IN `pcod` INT, IN `typ` CHAR(1))  NO SQL
begin
 DECLARE lcod int;
 if typ = 'P' THEN
 SELECT pgregcod from tbpg where pgcod=pcod into lcod;
 elseif typ = 'H' THEN
 SELECT husregcod from tbhus where huscod=pcod into lcod;
 elseif typ = 'C' THEN
 SELECT cpregcod from tbcp where cpcod=pcod into lcod;
 elseif typ = 'F' THEN
 SELECT floregcod from tbflo where flocod=pcod into lcod;
 end if;
select a.regeml,a.regdat,b.prfnam,b.prfphn,b.prfcmp,b.prfadd,b.prftyp,CONCAT(b.prfcod,b.prfpic) as pic,b.prfcod from tbreg a,tbprf b where a.regcod=b.prfregcod and a.regrol='U' and a.regcod=lcod;
end$$

DROP PROCEDURE IF EXISTS `DispalyActiveTestimonials`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DispalyActiveTestimonials` ()  NO SQL
BEGIN
select * from tbtestimonial where isactive=1;
END$$

DROP PROCEDURE IF EXISTS `DisplayAgentsByAgentId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DisplayAgentsByAgentId` (IN `AgentCod` INT)  NO SQL
BEGIN
select b.prfnam,b.prfcmp,b.prfphn,b.prfadd,CONCAT(b.prfcod,b.prfpic) as pic,b.prfcod,a.regeml from tbprf b, tbreg a where b.prftyp='B' and b.prfcod=AgentCod and  a.regcod=b.prfregcod;
END$$

DROP PROCEDURE IF EXISTS `DisplayAllAgentsByLocation`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DisplayAllAgentsByLocation` (IN `locationId` INT)  NO SQL
BEGIN
select b.prfnam,b.prfcmp,CONCAT(b.prfcod,b.prfpic) as pic,b.prfcod from tbprf b where b.prftyp='B' and b.prfLocation=locationId and IsActive=1;
END$$

DROP PROCEDURE IF EXISTS `DisplayPropertyDetailByID`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DisplayPropertyDetailByID` (IN `pcod` INT, IN `typ` CHAR(1))  NO SQL
begin
 DECLARE lcod int;
 if typ = 'P' THEN
SELECT property.*,city.catnam as city,location.subcatnam as location from tbpg property inner JOIN tbsubcat location on property.pgloc=location.subcatcod inner join tbcat city on location.subcatcatcod=city.catcod where pgcod=pcod; 
 elseif typ = 'H' THEN
 SELECT property.*,city.catnam as city,location.subcatnam as location from tbhus property inner JOIN tbsubcat location on property.husloc=location.subcatcod inner join tbcat city on location.subcatcatcod=city.catcod where huscod=pcod;
 elseif typ = 'C' THEN
  SELECT property.*,city.catnam as city,location.subcatnam as location from tbcp property inner JOIN tbsubcat location on property.cploc=location.subcatcod inner join tbcat city on location.subcatcatcod=city.catcod where cpcod=pcod;
 elseif typ = 'F' THEN
   SELECT property.*,city.catnam as city,location.subcatnam as location from tbflo property inner JOIN tbsubcat location on property.floloc=location.subcatcod inner join tbcat city on location.subcatcatcod=city.catcod where flocod=pcod;
 end if;

end$$

DROP PROCEDURE IF EXISTS `DisplayPropertyFacilityByIdAndType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DisplayPropertyFacilityByIdAndType` (IN `cod` INT, IN `typ` CHAR(1))  NO SQL
    DETERMINISTIC
BEGIN
SELECT * from tbfacprp where facprpprpcod=cod and facprpprptyp=typ;
END$$

DROP PROCEDURE IF EXISTS `DisplayRecentProperties`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DisplayRecentProperties` ()  NO SQL
begin
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat  from tbpg a where IsActive=1 and ShowToCustomer=1
UNION ALL
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat  from tbflo a where IsActive=1 and ShowToCustomer=1
UNION ALL
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat from tbhus a where IsActive=1 and ShowToCustomer=1
UNION ALL
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat  from tbcp a where IsActive=1 and ShowToCustomer=1 order by regdat desc LIMIT 0,4;
end$$

DROP PROCEDURE IF EXISTS `DisplayUsersAdmin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DisplayUsersAdmin` ()  NO SQL
BEGIN
select city.catnam,location.subcatnam, profile.prfnam,profile.prfcmp,CONCAT(profile.prfcod,profile.prfpic) as pic,profile.prfcod,profile.IsActive,profile.prftyp from tbprf profile  inner JOIN tbsubcat location on profile.prfLocation=location.subcatcod inner join tbcat city on location.subcatcatcod=city.catcod ;


END$$

DROP PROCEDURE IF EXISTS `dspcat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspcat` ()  NO SQL
begin
select * from tbcat ORDER BY catnam ;
end$$

DROP PROCEDURE IF EXISTS `dspfac`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspfac` (IN `factyp` CHAR(1))  NO SQL
begin
select * from tbpgfac where pgfactyp=factyp;
end$$

DROP PROCEDURE IF EXISTS `DspIndexSearchResult`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DspIndexSearchResult` (IN `lcod` INT, IN `typ` CHAR(1), IN `cat` CHAR(1))  NO SQL
begin
if cat='A' and typ='A' and lcod=0 then
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat,pgadd as address  from tbpg a 
UNION ALL
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat,floadd as address  from tbflo a 
UNION ALL
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a 
UNION ALL
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat ,cpadd as address from tbcp a order by regdat desc;
elseif cat='A' and typ='A' and lcod!=0 then
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat,pgadd as address  from tbpg a where pgloc=lcod 
UNION ALL
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat ,floadd as address from tbflo a where floloc=lcod 
UNION ALL
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a where husloc=lcod 
UNION ALL
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat ,cpadd as address from tbcp a where cploc=lcod order by regdat desc;
elseif cat='A' and typ!='A' and lcod=0 then

if typ = 'P' then
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat,pgadd as address  from tbpg a ;
elseif typ = 'H' then
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a ;
elseif typ = 'C' then
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat,cpadd as address  from tbcp a;
elseif typ = 'F' then
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat ,floadd as address from tbflo a ;
end if;
elseif cat !='A' and typ='A' and lcod=0 then
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat  from tbpg a,pgadd as address where pgtyp=cat
UNION ALL
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat,floadd as address  from tbflo a where flofor=cat
UNION ALL
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a where husfor=cat order by regdat desc;
elseif cat !='A' and typ !='A' and lcod=0 then

if typ = 'P' then
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat ,pgadd as address from tbpg a where  pgtyp=cat;
elseif typ = 'H' then
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a where husfor=cat;
elseif typ = 'C' then
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat ,cpadd as address from tbcp a ;
elseif typ = 'F' then
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat ,floadd as address from tbflo a where flofor=cat;
end if;
elseif cat ='A' and typ !='A' and lcod !=0 then

if typ = 'P' then
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat ,pgadd as address from tbpg a where pgloc=lcod ;
elseif typ = 'H' then
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a where husloc=lcod;
elseif typ = 'C' then
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat,cpadd as address  from tbcp a where cploc=lcod;
elseif typ = 'F' then
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat,floadd as address  from tbflo a where floloc=lcod ;
end if;
elseif cat !='A' and typ ='A' and lcod !=0 then

select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat ,pgadd as address from tbpg a where pgloc=lcod and pgtyp=cat
UNION ALL
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat,floadd as address  from tbflo a where floloc=lcod and flofor=cat
UNION ALL
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a where husloc=lcod and husfor=cat
UNION ALL
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat ,cpadd as address from tbcp a where cploc=lcod order by regdat desc;
elseif cat !='A' and typ !='A' and lcod !=0 then

if typ = 'P' then
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat,pgadd as address  from tbpg a where pgloc=lcod and pgtyp=cat order by regdat desc ;
elseif typ = 'H' then
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a where husloc=lcod and husfor=cat order by regdat desc ;
elseif typ = 'C' then
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat,cpadd as address  from tbcp a where cploc=lcod order by regdat desc;
elseif typ = 'F' then
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat ,floadd as address from tbflo a where floloc=lcod and flofor=cat order by regdat desc ;
end if;

end if;
end$$

DROP PROCEDURE IF EXISTS `DspInnerSearchResult`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DspInnerSearchResult` (IN `lcod` INT, IN `typ` CHAR(1), IN `cat` CHAR(1), IN `fursts` CHAR(1), IN `noofbed` INT, IN `commsts` CHAR(2), IN `pricelow` INT, IN `pricehigh` INT, IN `pricetyp` CHAR(1))  NO SQL
begin

if typ = 'P' then
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat,pgadd as address  from tbpg a where pgtyp=cat and pgfursts=fursts and pgrnt>pricelow and pgrnt<pricehigh and pgrntfor=pricetyp ;
elseif typ = 'H' then
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a where husfor=cat and husbdrm=noofbed and husfursts=fursts and husrnt>pricelow and husrnt<pricehigh and husrntfor=pricetyp;
elseif typ = 'C' then
if commsts!='A' then
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat,cpadd as address  from tbcp a where cptyp=commsts and cpfursts=fursts and cprnt>pricelow and cprnt<pricehigh and cprntfor=pricetyp;
else
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat,cpadd as address  from tbcp a where cpfursts=fursts;
end if;
elseif typ = 'F' then
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat ,floadd as address from tbflo a where flofor=cat and flobdrm=noofbed and flofursts=fursts and flornt>pricelow and flornt<pricehigh and florntfor=pricetyp ;

end if;

end$$

DROP PROCEDURE IF EXISTS `dsppgpics`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dsppgpics` (IN `pcod` INT, IN `ptyp` CHAR(1))  NO SQL
begin
select * from tbpgpic where pgpicpgcod=pcod and pgpictyp=ptyp;
end$$

DROP PROCEDURE IF EXISTS `dspprf`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspprf` ()  NO SQL
begin
select * from tbprf;
end$$

DROP PROCEDURE IF EXISTS `dspreg`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspreg` ()  NO SQL
begin
select * from tbreg;
end$$

DROP PROCEDURE IF EXISTS `dspsfacprp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspsfacprp` (IN `prpcod` INT)  NO SQL
begin
select * from tbfacprp where facprpprpcod=pgcod;
end$$

DROP PROCEDURE IF EXISTS `dspsubcat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspsubcat` (IN `sccod` INT)  NO SQL
begin
select * from tbsubcat where subcatcatcod=sccod;
end$$

DROP PROCEDURE IF EXISTS `dspusrprf`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspusrprf` (IN `lcod` INT)  NO SQL
begin
select a.regeml,a.regdat,b.prfnam,b.prfphn,b.prfcmp,b.prfadd,b.prftyp,CONCAT(b.prfcod,b.prfpic) as pic,b.prfcod from tbreg a,tbprf b where a.regcod=b.prfregcod and a.regrol='U' and a.regcod=lcod;
end$$

DROP PROCEDURE IF EXISTS `dspusrprp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dspusrprp` (IN `lcod` INT)  NO SQL
begin
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat,pgrntfor as rentFor  from tbpg a where pgregcod=lcod
UNION ALL
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat,florntfor as rentFor  from tbflo a where floregcod=lcod
UNION ALL
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husrntfor as rentFor from tbhus a where husregcod=lcod
UNION ALL
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat,cprntfor as rentFor  from tbcp a where cpregcod=lcod order by regdat desc;
end$$

DROP PROCEDURE IF EXISTS `findcat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findcat` (IN `ccod` INT)  NO SQL
begin
select * from tbcat where catcod=ccod;
end$$

DROP PROCEDURE IF EXISTS `findcp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findcp` (IN `ccod` INT)  NO SQL
begin
select * from tbcp where cpcod=ccod;
end$$

DROP PROCEDURE IF EXISTS `findfac`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findfac` (IN `ccod` INT)  NO SQL
begin
select * from tbpgfac where pgfaccod=ccod;
end$$

DROP PROCEDURE IF EXISTS `findflo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findflo` (IN `fcod` INT)  NO SQL
begin
select * from tbflo where flocod=fcod;
end$$

DROP PROCEDURE IF EXISTS `findhus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findhus` (IN `hcod` INT)  NO SQL
begin
select * from tbhus where huscod=hcod;
end$$

DROP PROCEDURE IF EXISTS `findpg`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findpg` (IN `pcod` INT)  NO SQL
begin
select * from tbpg where pgcod=pcod;
end$$

DROP PROCEDURE IF EXISTS `findprf`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findprf` (IN `pcod` INT)  NO SQL
begin
select * from tbprf where prfcod=pcod;
end$$

DROP PROCEDURE IF EXISTS `findreg`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findreg` (IN `rcod` INT)  NO SQL
begin
select * from tbreg where regcod=rcod;
end$$

DROP PROCEDURE IF EXISTS `findsubcat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `findsubcat` (IN `sccod` INT)  NO SQL
begin
select * from tbsubcat where subcatcod=sccod;
end$$

DROP PROCEDURE IF EXISTS `fndlstpgpic`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fndlstpgpic` (OUT `lpiccod` INT)  NO SQL
begin
select max(pgpiccod) from tbpgpic  into lpiccod;
end$$

DROP PROCEDURE IF EXISTS `GetContactForm`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetContactForm` ()  NO SQL
BEGIN
SELECT * FROM contactform where isdeleted=0 order by date DESC ;
END$$

DROP PROCEDURE IF EXISTS `GetPropertyPicturesCount`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPropertyPicturesCount` (IN `ppicpgcod` INT, IN `ppictyp` CHAR(1))  NO SQL
SELECT count(*) FROM tbpgpic where pgpicpgcod=ppicpgcod and pgpictyp=ppictyp$$

DROP PROCEDURE IF EXISTS `GetUserAlerts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUserAlerts` (IN `uid` INT)  NO SQL
BEGIN
select city.catnam,location.subcatnam ,alert.propertyType,alert.useralertsid from tbuseralerts alert inner JOIN tbsubcat location on alert.location=location.subcatcod inner join tbcat city on location.subcatcatcod =city.catcod where UserId=uid;
END$$

DROP PROCEDURE IF EXISTS `inscat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `inscat` (IN `catnam` VARCHAR(50))  NO SQL
begin
insert tbcat values(null,catnam);
end$$

DROP PROCEDURE IF EXISTS `inscp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `inscp` (IN `ctyp` CHAR(1), IN `cloc` INT, IN `clndmrk` VARCHAR(100), IN `cadd` VARCHAR(100), IN `cpwshrm` CHAR(1), IN `cppntry` CHAR(1), IN `cflono` INT, IN `cflo` INT, IN `carecov` INT, IN `crdfac` INT, IN `crnt` FLOAT, IN `crntfor` CHAR(1), IN `cmntcrg` FLOAT, IN `cmntcrgfor` CHAR(1), IN `cocrg` FLOAT, IN `cavlfrm` DATE, IN `cageofconst` INT, IN `cdsc` VARCHAR(200), IN `cregcod` INT, IN `cpubsts` CHAR(1), IN `cregdat` DATE, IN `cdelsts` CHAR(1), IN `clat` VARCHAR(20), IN `clng` VARCHAR(20), IN `cscrty` FLOAT, IN `careunit` VARCHAR(20), IN `cfursts` CHAR(1), OUT `cod` INT)  NO SQL
begin
insert tbcp values(null,ctyp,cloc,clndmrk,cadd,cpwshrm,cppntry,cflono,cflo,carecov,crdfac,crnt,crntfor,cmntcrg,cmntcrgfor,cocrg,cavlfrm,cageofconst,cdsc,cregcod,cpubsts,cregdat,cdelsts,clat,clng,cscrty,careunit,cfursts,1,0);
select last_insert_id() into cod;
end$$

DROP PROCEDURE IF EXISTS `insertContactForm`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertContactForm` (IN `contactFormName` VARCHAR(15), IN `contactFormEmail` VARCHAR(50), IN `contactFormSubject` VARCHAR(20), IN `contactFormMessage` VARCHAR(100), IN `contactFormDate` DATE)  NO SQL
begin
insert ContactForm (ContactFormId,Date,Email,IsDeleted,Message,Name,Subject) values(null,contactFormDate,contactFormEmail,0,contactFormMessage,contactFormName,contactFormSubject);

end$$

DROP PROCEDURE IF EXISTS `insertTestimonial`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertTestimonial` (IN `Forusername` VARCHAR(50), IN `Fortext` VARCHAR(500), IN `Formonth` VARCHAR(10), IN `Forpicture` VARCHAR(10), OUT `cod` INT)  NO SQL
begin
insert tbtestimonial (code,IsActive,month,picture,text,username) values(null,1,Formonth,Forpicture,Fortext,Forusername);
select last_insert_id() into cod;
end$$

DROP PROCEDURE IF EXISTS `InsertUserAlerts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertUserAlerts` (IN `PropType` VARCHAR(10), IN `loc` INT, IN `uid` INT)  NO SQL
BEGIN
INSERT INTO `tbuseralerts`( `PropertyType`, `Location`, `UserId`) VALUES (PropType,loc,uid);
END$$

DROP PROCEDURE IF EXISTS `insfac`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insfac` (IN `facnam` VARCHAR(50), IN `factyp` CHAR(1))  NO SQL
begin
insert tbpgfac values(null,facnam,factyp);
end$$

DROP PROCEDURE IF EXISTS `insfacprp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insfacprp` (IN `faccod` INT, IN `pgccod` INT, IN `prptyp` CHAR(1))  NO SQL
begin
insert tbfacprp values(null,faccod,pgccod,prptyp);
end$$

DROP PROCEDURE IF EXISTS `insflo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insflo` (IN `ffor` CHAR(1), IN `floc` INT, IN `flnfmrk` VARCHAR(100), IN `fadd` VARCHAR(100), IN `fbdrm` INT, IN `fbthrm` INT, IN `fblcny` INT, IN `fkitchen` CHAR(1), IN `flvroom` CHAR(1), IN `ffursts` CHAR(1), IN `fflono` INT, IN `fflotot` INT, IN `frnt` FLOAT, IN `frntfor` INT, IN `focrg` FLOAT, IN `fscrty` FLOAT, IN `fmntcrg` FLOAT, IN `fmntcrgfor` INT, IN `fsts` CHAR(1), IN `fregcod` INT, IN `favlfrom` DATE, IN `fdsc` VARCHAR(500), IN `fdelsts` CHAR(1), IN `flat` VARCHAR(10), IN `flong` VARCHAR(10), IN `ftotare` INT, IN `fareunit` VARCHAR(10), IN `fregdat` DATE, OUT `cod` INT)  NO SQL
begin
insert tbflo values(null,ffor,floc,flnfmrk,fadd,fbdrm,fbthrm,fblcny,fkitchen,flvroom,ffursts,fflono,fflotot,frnt,frntfor,focrg,fscrty,fmntcrg,fmntcrgfor,fsts,fregcod,favlfrom,fdsc,fdelsts,flat,flong,ftotare,fareunit,fregdat,1,0);
select last_insert_id() into cod;
end$$

DROP PROCEDURE IF EXISTS `inshus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `inshus` (IN `hfor` CHAR(1), IN `hloc` INT, IN `hlndmrk` VARCHAR(100), IN `hadd` VARCHAR(100), IN `hbdrm` INT, IN `hbthrm` INT, IN `hblcny` INT, IN `hlby` CHAR(1), IN `hlvrm` CHAR(1), IN `hkitchen` INT, IN `hfursts` CHAR(1), IN `htotare` INT, IN `hpubsts` CHAR(1), IN `hregcod` INT, IN `hrnt` FLOAT, IN `hrntfor` CHAR(1), IN `hsrty` FLOAT, IN `hmaint` FLOAT, IN `hmaintfor` CHAR(1), IN `hocrg` FLOAT, IN `havlfrm` DATE, IN `hdsc` VARCHAR(500), IN `hdelsts` CHAR(1), IN `hlat` VARCHAR(10), IN `hlong` VARCHAR(10), IN `hareunit` VARCHAR(20), IN `hstrbut` INT, IN `hregdat` DATE, OUT `cod` INT)  NO SQL
begin
insert tbhus values(null,hfor,hloc,hlndmrk,hadd,hbdrm,hbthrm,hblcny,hlby,hlvrm,hkitchen,hfursts,htotare,hrnt,hrntfor,hsrty,hmaint,hmaintfor,hocrg,havlfrm,hdsc,hpubsts,hregcod,hdelsts,hlat,hlong,hareunit,hstrbut,hregdat,1,0);
select last_insert_id() into cod;
end$$

DROP PROCEDURE IF EXISTS `inspg`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `inspg` (IN `ptit` VARCHAR(50), IN `ptyp` CHAR(1), IN `ploc` INT, IN `plndmrk` VARCHAR(100), IN `padd` VARCHAR(100), IN `prnt` FLOAT, IN `prntfor` CHAR(1), IN `pscrty` FLOAT, IN `pocrg` FLOAT, IN `pnoseats` INT, IN `pavlfrm` DATE, IN `pdsc` VARCHAR(500), IN `psts` CHAR(1), IN `pregcod` INT, IN `pnoper` INT, IN `pfursts` CHAR(1), IN `pdelsts` CHAR(1), IN `plat` VARCHAR(30), IN `plong` VARCHAR(30), IN `pmntcrg` FLOAT, IN `pmntcrgfor` CHAR(1), IN `pregdat` DATE, OUT `cod` INT)  NO SQL
begin
insert tbpg values(null,ptit,ptyp,ploc,plndmrk,padd,prnt,prntfor,pscrty,pocrg,pnoseats,pavlfrm,pdsc,psts,pregcod,pnoper,pfursts,pdelsts,plat,plong,pmntcrg,pmntcrgfor,pregdat,1,0);
select last_insert_id() into cod;
end$$

DROP PROCEDURE IF EXISTS `inspgpic`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `inspgpic` (IN `ppicfil` VARCHAR(50), IN `ppicdsc` VARCHAR(100), IN `ppicpgcod` INT, IN `ppictyp` CHAR(1))  NO SQL
begin
insert tbpgpic values(null,ppicfil,ppicdsc,ppicpgcod,ppictyp);

end$$

DROP PROCEDURE IF EXISTS `insprf`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insprf` (IN `pnam` VARCHAR(50), IN `pphn` VARCHAR(50), IN `ptyp` CHAR(1), IN `pregcod` INT, IN `padd` VARCHAR(100), IN `pcmp` VARCHAR(50), IN `ppic` VARCHAR(50), IN `pisactive` INT, IN `potp` INT, IN `potpisapproved` INT, IN `ploc` INT, OUT `cod` INT)  NO SQL
begin
insert tbprf values(null,pnam,pphn,ptyp,pregcod,padd,pcmp,ppic,pisactive,potp,potpisapproved,ploc);
select last_insert_id() into cod;
end$$

DROP PROCEDURE IF EXISTS `insreg`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insreg` (IN `reml` VARCHAR(50), IN `rpwd` VARCHAR(50), IN `rdat` DATETIME, IN `rrol` CHAR(1), OUT `cod` INT)  NO SQL
begin
insert tbreg values(null,reml,rpwd,rdat,rrol);
select last_insert_id() into cod;
end$$

DROP PROCEDURE IF EXISTS `inssubcat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `inssubcat` (IN `scnam` VARCHAR(100), IN `scccod` INT)  NO SQL
begin
insert tbsubcat values(null,scnam,scccod);
end$$

DROP PROCEDURE IF EXISTS `logincheck`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `logincheck` (IN `eml` VARCHAR(50), IN `pwd` VARCHAR(50), OUT `cod` INT, OUT `rol` CHAR(1))  NO SQL
begin
declare actpwd varchar(50);
declare IsOtpAppoved bit;
select regpwd from tbreg where regeml = eml into @actpwd;
if @actpwd = pwd then

select regcod from tbreg where regeml = eml into cod;
select regrol from tbreg where regeml = eml into rol;
select IsOtpApproved from tbprf where prfregcod = cod into @IsOtpAppoved;
if @IsOtpAppoved = 0 THEN
set rol = 'O';
end if ;
else
set cod = -1;
set rol = 'N';
end if ;
end$$

DROP PROCEDURE IF EXISTS `ManageAllProperiesForAdmin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ManageAllProperiesForAdmin` ()  NO SQL
begin
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat,IsActive as active ,ShowTOCustomer as Showtocustomer from tbpg a
UNION ALL
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat,IsActive as active ,ShowTOCustomer as Showtocustomer  from tbflo a 
UNION ALL
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat ,IsActive as active ,ShowTOCustomer as Showtocustomer from tbhus a
UNION ALL
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat ,IsActive as active ,ShowTOCustomer as Showtocustomer  from tbcp a  order by regdat desc;
end$$

DROP PROCEDURE IF EXISTS `UpdateOTPStatus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateOTPStatus` (IN `eml` VARCHAR(50), IN `pwd` VARCHAR(50), IN `otpIn` INT(11), OUT `cod` INT, OUT `rol` CHAR(1))  NO SQL
begin
declare actpwd varchar(50);
declare actotp int;
declare IsOtpAppoved bit;
select regpwd from tbreg where regeml = eml into @actpwd;
if @actpwd = pwd then

select regcod from tbreg where regeml = eml into cod;
select regrol from tbreg where regeml = eml into rol;

select otp from tbprf where prfregcod = cod into @actotp;
if @actotp = otpIn THEN
update tbprf set isotpapproved=1 where prfregcod = cod;
else
set rol = 'O';
end if ;
else
set cod = -1;
set rol = 'N';
end if ;
end$$

DROP PROCEDURE IF EXISTS `updatePropertyIndexStatus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePropertyIndexStatus` (IN `cod` INT, IN `typ` VARCHAR(2), IN `sts` INT)  NO SQL
begin
if typ = 'P' then
 update tbpg set ShowTOCustomer=sts where pgcod=cod;
elseif typ = 'H' then
 update tbhus set ShowTOCustomer=sts where huscod=cod;
elseif typ = 'C' then
 update tbcp set ShowTOCustomer=sts where cpcod=cod;
elseif typ = 'F' then
 update tbflo set ShowTOCustomer=sts where flocod=cod;

end if ;
end$$

DROP PROCEDURE IF EXISTS `updatePropertyStatus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePropertyStatus` (IN `cod` INT, IN `typ` VARCHAR(2), IN `sts` INT)  NO SQL
begin
if typ = 'P' then
 update tbpg set IsActive=sts where pgcod=cod;
elseif typ = 'H' then
 update tbhus set IsActive=sts where huscod=cod;
elseif typ = 'C' then
 update tbcp set IsActive=sts where cpcod=cod;
elseif typ = 'F' then
 update tbflo set IsActive=sts where flocod=cod;

end if ;
end$$

DROP PROCEDURE IF EXISTS `UpdateUserProfile`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateUserProfile` (IN `pcod` INT, IN `pnam` VARCHAR(50), IN `padd` VARCHAR(100), IN `pcmp` VARCHAR(50), IN `ppic` VARCHAR(50))  NO SQL
begin
update tbprf set prfnam=pnam,prfadd=padd,prfcmp=pcmp,prfpic=ppic where prfcod=pcod;
end$$

DROP PROCEDURE IF EXISTS `updateUserStatus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateUserStatus` (IN `cod` INT, IN `status` INT)  NO SQL
BEGIN
update tbprf set IsActive=status where prfcod=cod;
END$$

DROP PROCEDURE IF EXISTS `updcat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updcat` (IN `ccod` INT, IN `cnam` VARCHAR(100))  NO SQL
begin
update tbcat set catnam=cnam where catcod=ccod;
end$$

DROP PROCEDURE IF EXISTS `updfac`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updfac` (IN `ccod` INT, IN `facnam` VARCHAR(100), IN `factyp` CHAR(1))  NO SQL
begin
update tbpgfac set pgfacnam=facnam,pgfactyp=factyp where pgfaccod=ccod;
end$$

DROP PROCEDURE IF EXISTS `updpg`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updpg` (IN `pcod` INT, IN `ptit` VARCHAR(50), IN `ptyp` CHAR(1), IN `ploc` INT, IN `plndmrk` VARCHAR(100), IN `padd` VARCHAR(100), IN `prnt` FLOAT, IN `prntfor` CHAR(1), IN `pscrty` FLOAT, IN `pocrg` FLOAT, IN `pnoseats` INT, IN `pavlfrm` DATE, IN `pdsc` VARCHAR(500), IN `psts` CHAR(1), IN `pregcod` INT, IN `pnoper` INT, IN `pfursts` CHAR(1), IN `pdelsts` CHAR(1), IN `plat` VARCHAR(30), IN `plong` VARCHAR(30), IN `pmntcrg` FLOAT, IN `pmntcrgfor` CHAR(1), IN `pregdat` DATE)  NO SQL
begin
update tbpg set pgtit=ptit,pgtyp=ptyp,pgloc=ploc,pglndmrk=plndmrk,pgadd=padd,pgrnt=prnt,pgrntfor=prntfor,
pgscrty=pscrty,pgocrg=pocrg,pgnofseats=pnoseats,pgavlfrm=pavlfrm,pgdsc=pdsc,pgsts=psts,pgregcod=pregcod,pgnoper=pnoper,
pgfursts=pfursts,pgdelsts=pdelsts,pglat=plat,pglog=plong,pgmntcrg=pmntcrg,pgmntcrgfor=pmntcrgfor,pgregdat=pregdat  where pgcod=pcod;
end$$

DROP PROCEDURE IF EXISTS `updreg`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updreg` (IN `rcod` INT, IN `reml` VARCHAR(50), IN `rpwd` VARCHAR(50), IN `rdat` DATETIME, IN `rrol` CHAR(1))  NO SQL
begin
update tbreg set regeml=reml,regpwd=rpwd,regdat=rdat,regrol=rrol where regcod=rcod;
end$$

DROP PROCEDURE IF EXISTS `updsubcat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updsubcat` (IN `sccod` INT, IN `scnam` VARCHAR(100), IN `scccod` INT)  NO SQL
begin
update tbsubcat set subcatnam=scnam, subcatcatcod=scccod where subcatcod=sccod;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `contactform`
--

DROP TABLE IF EXISTS `contactform`;
CREATE TABLE IF NOT EXISTS `contactform` (
  `Name` varchar(15) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Subject` varchar(20) NOT NULL,
  `Message` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL,
  `ContactFormId` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ContactFormId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactform`
--

INSERT INTO `contactform` (`Name`, `Email`, `Subject`, `Message`, `Date`, `IsDeleted`, `ContactFormId`) VALUES
('preet', 'preet.dhindsa@hormail.com', 'test subject', 'test message', '2017-08-09', 0, 1),
('Helly', 'helly@gmail.com', 'test hai g', 'test message is here', '2017-08-10', 0, 2),
('asas', 'Abcs@gmail.com', 'asasas', 'asasas', '2017-08-10', 0, 3),
('sdsdsd', 'helly@gmail.com', 'sdsd', 'sdsds', '2017-08-10', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbcat`
--

DROP TABLE IF EXISTS `tbcat`;
CREATE TABLE IF NOT EXISTS `tbcat` (
  `catcod` int(11) NOT NULL AUTO_INCREMENT,
  `catnam` varchar(100) NOT NULL,
  PRIMARY KEY (`catcod`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbcat`
--

INSERT INTO `tbcat` (`catcod`, `catnam`) VALUES
(14, ' patiala'),
(15, ' chandigarh'),
(16, ' ambala');

-- --------------------------------------------------------

--
-- Table structure for table `tbcp`
--

DROP TABLE IF EXISTS `tbcp`;
CREATE TABLE IF NOT EXISTS `tbcp` (
  `cpcod` int(11) NOT NULL AUTO_INCREMENT,
  `cptyp` char(1) NOT NULL,
  `cploc` int(11) NOT NULL,
  `cplndmrk` varchar(100) NOT NULL,
  `cpadd` varchar(100) NOT NULL,
  `cppwshrm` char(1) NOT NULL,
  `cpppentry` char(1) NOT NULL,
  `cpflono` int(11) NOT NULL,
  `cptotflo` int(11) NOT NULL,
  `cptotarecov` int(11) NOT NULL,
  `cprdfac` int(11) NOT NULL,
  `cprnt` float NOT NULL,
  `cprntfor` char(1) NOT NULL,
  `cpmntcrg` float NOT NULL,
  `cpmntcrgfor` char(1) NOT NULL,
  `cpocry` float NOT NULL,
  `cpavlfrm` date NOT NULL,
  `cpageofcnst` int(11) NOT NULL,
  `cpdsc` varchar(200) NOT NULL,
  `cpregcod` int(11) NOT NULL,
  `cppubsts` char(1) NOT NULL,
  `cpregdat` date NOT NULL,
  `cpdelsts` char(1) NOT NULL,
  `cplat` varchar(20) NOT NULL,
  `cplong` varchar(20) NOT NULL,
  `cpscrty` float NOT NULL,
  `cpareunit` varchar(20) NOT NULL,
  `cpfursts` char(1) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `ShowTOCustomer` tinyint(1) NOT NULL,
  PRIMARY KEY (`cpcod`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbcp`
--

INSERT INTO `tbcp` (`cpcod`, `cptyp`, `cploc`, `cplndmrk`, `cpadd`, `cppwshrm`, `cpppentry`, `cpflono`, `cptotflo`, `cptotarecov`, `cprdfac`, `cprnt`, `cprntfor`, `cpmntcrg`, `cpmntcrgfor`, `cpocry`, `cpavlfrm`, `cpageofcnst`, `cpdsc`, `cpregcod`, `cppubsts`, `cpregdat`, `cpdelsts`, `cplat`, `cplong`, `cpscrty`, `cpareunit`, `cpfursts`, `IsActive`, `ShowTOCustomer`) VALUES
(10, 'O', 33, 'Near TDI City', 'Sector 125 mohali', 'Y', 'Y', 3, 7, 7676, 67767, 677, 'Q', 6767, 'M', 6767, '0000-00-00', 15, 'desc', 4, 'P', '2015-10-13', 'Y', '40.714398', '-74.005279', 6767, 'sqr-m', 'S', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbfacprp`
--

DROP TABLE IF EXISTS `tbfacprp`;
CREATE TABLE IF NOT EXISTS `tbfacprp` (
  `facprpcod` int(11) NOT NULL AUTO_INCREMENT,
  `facprpfaccod` int(11) NOT NULL,
  `facprpprpcod` int(11) NOT NULL,
  `facprpprptyp` char(1) NOT NULL,
  PRIMARY KEY (`facprpcod`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbfacprp`
--

INSERT INTO `tbfacprp` (`facprpcod`, `facprpfaccod`, `facprpprpcod`, `facprpprptyp`) VALUES
(1, 1, 39, 'P'),
(2, 2, 39, 'P'),
(3, 3, 39, 'P'),
(4, 5, 39, 'P'),
(5, 1, 40, 'P'),
(6, 2, 40, 'P'),
(7, 3, 40, 'P'),
(8, 5, 40, 'P'),
(9, 12, 2, 'F'),
(10, 14, 2, 'F'),
(11, 16, 2, 'F'),
(12, 12, 3, 'F'),
(13, 14, 3, 'F'),
(14, 16, 3, 'F'),
(15, 18, 3, 'F'),
(16, 20, 3, 'H'),
(17, 22, 3, 'H'),
(18, 20, 4, 'H'),
(19, 22, 4, 'H'),
(20, 20, 5, 'H'),
(21, 22, 5, 'H'),
(22, 20, 6, 'H'),
(23, 22, 6, 'H'),
(24, 24, 7, 'C'),
(25, 26, 7, 'C'),
(26, 24, 5, 'C'),
(27, 25, 5, 'C'),
(28, 24, 6, 'C'),
(29, 25, 6, 'C'),
(30, 24, 7, 'C'),
(31, 25, 7, 'C'),
(32, 24, 8, 'C'),
(33, 25, 8, 'C'),
(34, 24, 9, 'C'),
(35, 25, 9, 'C'),
(36, 24, 10, 'C'),
(37, 26, 10, 'C'),
(38, 1, 43, 'P'),
(39, 2, 43, 'P'),
(40, 3, 43, 'P'),
(41, 4, 43, 'P'),
(42, 5, 43, 'P'),
(43, 6, 43, 'P'),
(44, 7, 43, 'P'),
(45, 8, 43, 'P'),
(46, 10, 43, 'P'),
(47, 20, 8, 'H'),
(48, 21, 8, 'H'),
(49, 22, 8, 'H'),
(50, 20, 9, 'H'),
(51, 21, 9, 'H'),
(52, 22, 9, 'H'),
(53, 1, 44, 'P'),
(54, 3, 44, 'P'),
(55, 5, 44, 'P'),
(56, 7, 44, 'P'),
(57, 1, 45, 'P'),
(58, 3, 45, 'P'),
(59, 5, 45, 'P'),
(60, 7, 45, 'P'),
(61, 1, 46, 'P'),
(62, 3, 46, 'P'),
(63, 5, 46, 'P'),
(64, 7, 46, 'P'),
(65, 9, 45, 'P'),
(66, 1, 48, 'P'),
(67, 3, 48, 'P'),
(68, 1, 49, 'P'),
(69, 3, 49, 'P'),
(70, 1, 50, 'P'),
(71, 3, 50, 'P'),
(72, 1, 51, 'P'),
(73, 3, 51, 'P'),
(74, 1, 52, 'P'),
(75, 3, 52, 'P'),
(76, 1, 53, 'P'),
(77, 3, 53, 'P'),
(78, 1, 54, 'P'),
(79, 3, 54, 'P'),
(80, 1, 55, 'P'),
(81, 3, 55, 'P');

-- --------------------------------------------------------

--
-- Table structure for table `tbflo`
--

DROP TABLE IF EXISTS `tbflo`;
CREATE TABLE IF NOT EXISTS `tbflo` (
  `flocod` int(11) NOT NULL AUTO_INCREMENT,
  `flofor` char(1) NOT NULL,
  `floloc` int(11) NOT NULL,
  `flolndmrk` varchar(100) NOT NULL,
  `floadd` varchar(100) NOT NULL,
  `flobdrm` int(11) NOT NULL,
  `flobthrm` int(11) NOT NULL,
  `floblcny` int(11) NOT NULL,
  `floktchn` char(1) NOT NULL,
  `flolvrm` char(1) NOT NULL,
  `flofursts` char(1) NOT NULL,
  `floflono` int(11) NOT NULL,
  `floflotot` int(11) NOT NULL,
  `flornt` float NOT NULL,
  `florntfor` char(1) NOT NULL,
  `floocrg` float NOT NULL,
  `floscrty` float NOT NULL,
  `flomntcrg` float NOT NULL,
  `flomntcrgfor` char(1) NOT NULL,
  `flosts` char(1) NOT NULL,
  `floregcod` int(11) NOT NULL,
  `floavlfrm` date NOT NULL,
  `flodsc` varchar(500) NOT NULL,
  `flodelsts` char(1) NOT NULL,
  `flolat` varchar(20) NOT NULL,
  `flolong` varchar(20) NOT NULL,
  `flototarea` int(11) NOT NULL,
  `floareunts` varchar(20) NOT NULL,
  `floregdat` date NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `ShowTOCustomer` tinyint(1) NOT NULL,
  PRIMARY KEY (`flocod`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbflo`
--

INSERT INTO `tbflo` (`flocod`, `flofor`, `floloc`, `flolndmrk`, `floadd`, `flobdrm`, `flobthrm`, `floblcny`, `floktchn`, `flolvrm`, `flofursts`, `floflono`, `floflotot`, `flornt`, `florntfor`, `floocrg`, `floscrty`, `flomntcrg`, `flomntcrgfor`, `flosts`, `floregcod`, `floavlfrm`, `flodsc`, `flodelsts`, `flolat`, `flolong`, `flototarea`, `floareunts`, `floregdat`, `IsActive`, `ShowTOCustomer`) VALUES
(1, 'd', 33, 'rwer', 'werwe', 3, 4, 3, 'f', 'f', 'f', 3, 45, 34, '3', 34, 343, 34, '3', 'v', 3, '2015-09-01', '434fdfd', 'f', '3434', '3443dff', 34, 'fdsfdsf', '2015-09-22', 1, 0),
(2, 'G', 39, 'land mark hai ', '148/7 sector 126 greater mohali', 2, 4, 3, 'N', 'N', 'F', 3, 8, 454, 'Q', 4545, 4545, 54545, '0', 'P', 4, '0000-00-00', 'this is very good floor . at best location. this is front facing to garden . with vip number like 2343. this is very good awsson. you may like , get his is humbel request please get this floor . we need to go abroar for 3 years . please take this pg . otersise we ,. need come one oter to take care of this pg . please taje . we will be vewry yjank full you yu . yhanks love you.', 'Y', '40.714398', '-74.005279', 45, 'bigha', '2015-10-12', 1, 0),
(3, 'B', 35, 'czxcxz', 'czxcxzc', 2, 3, 1, 'N', 'N', 'S', 2, 9, 43434, 'Y', 5665, 54454, 565656, '0', 'P', 4, '0000-00-00', 'zxczxczxczxczx', 'Y', '40.714398', '-74.005279', 34343, 'bigha', '2015-10-12', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbhus`
--

DROP TABLE IF EXISTS `tbhus`;
CREATE TABLE IF NOT EXISTS `tbhus` (
  `huscod` int(11) NOT NULL AUTO_INCREMENT,
  `husfor` char(1) NOT NULL,
  `husloc` int(11) NOT NULL,
  `huslndmrk` varchar(100) NOT NULL,
  `husadd` varchar(100) NOT NULL,
  `husbdrm` int(11) NOT NULL,
  `husbtnrm` int(11) NOT NULL,
  `husblcny` int(11) NOT NULL,
  `huslby` char(1) NOT NULL,
  `huslvrm` char(1) NOT NULL,
  `huskitchen` int(11) NOT NULL,
  `husfursts` char(1) NOT NULL,
  `hustotare` int(11) NOT NULL,
  `husrnt` float NOT NULL,
  `husrntfor` char(1) NOT NULL,
  `husscrty` float NOT NULL,
  `husmntcrg` float NOT NULL,
  `husmntcryfor` char(1) NOT NULL,
  `husocrg` float NOT NULL,
  `husavlfrm` date NOT NULL,
  `husdsc` varchar(200) NOT NULL,
  `huspubsts` char(1) NOT NULL,
  `husregcod` int(11) NOT NULL,
  `husdelsts` char(1) NOT NULL,
  `huslat` varchar(20) NOT NULL,
  `huslong` varchar(20) NOT NULL,
  `husareunit` varchar(20) NOT NULL,
  `husstrybuit` int(11) NOT NULL,
  `husregdat` date NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `ShowTOCustomer` tinyint(1) NOT NULL,
  PRIMARY KEY (`huscod`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbhus`
--

INSERT INTO `tbhus` (`huscod`, `husfor`, `husloc`, `huslndmrk`, `husadd`, `husbdrm`, `husbtnrm`, `husblcny`, `huslby`, `huslvrm`, `huskitchen`, `husfursts`, `hustotare`, `husrnt`, `husrntfor`, `husscrty`, `husmntcrg`, `husmntcryfor`, `husocrg`, `husavlfrm`, `husdsc`, `huspubsts`, `husregcod`, `husdelsts`, `huslat`, `huslong`, `husareunit`, `husstrybuit`, `husregdat`, `IsActive`, `ShowTOCustomer`) VALUES
(8, 'F', 36, 'hgfhgfh', 'hgfhgfh', 3, 3, 2, 'Y', 'N', 3, 'F', 232323, 233, 'Y', 323, 3232, 'Q', 2323, '0000-00-00', 'tjhgdfhdgf<br>gfhgfhgfh<br>gfhgfhgf<br>hgfhgfh<br>gfhgfhgf<br>hgfhgf<br>hgfh<br>gfh<br>gfh<br>gf<br>', 'P', 4, 'Y', '40.714398', '-74.005279', 'sqr-m', 5, '2015-10-26', 1, 0),
(9, 'F', 36, 'hgfhgfh', 'hgfhgfh', 3, 3, 2, 'Y', 'N', 3, 'F', 232323, 233, 'Y', 323, 3232, 'Q', 2323, '0000-00-00', 'tjhgdfhdgf<br>gfhgfhgfh<br>gfhgfhgf<br>hgfhgfh<br>gfhgfhgf<br>hgfhgf<br>hgfh<br>gfh<br>gfh<br>gf<br>', 'P', 26, 'Y', '40.714398', '-74.005279', 'sqr-m', 5, '2015-10-26', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbpg`
--

DROP TABLE IF EXISTS `tbpg`;
CREATE TABLE IF NOT EXISTS `tbpg` (
  `pgcod` int(11) NOT NULL AUTO_INCREMENT,
  `pgtit` varchar(50) NOT NULL,
  `pgtyp` char(1) NOT NULL,
  `pgloc` int(11) NOT NULL,
  `pglndmrk` varchar(100) NOT NULL,
  `pgadd` varchar(100) NOT NULL,
  `pgrnt` float NOT NULL,
  `pgrntfor` char(1) NOT NULL,
  `pgscrty` float NOT NULL,
  `pgocrg` float NOT NULL,
  `pgnofseats` int(11) NOT NULL,
  `pgavlfrm` date NOT NULL,
  `pgdsc` varchar(500) NOT NULL,
  `pgsts` char(1) NOT NULL,
  `pgregcod` int(11) NOT NULL,
  `pgnoper` int(11) NOT NULL,
  `pgfursts` char(1) NOT NULL,
  `pgdelsts` char(1) NOT NULL,
  `pglat` varchar(20) NOT NULL,
  `pglog` varchar(20) NOT NULL,
  `pgmntcrg` float NOT NULL,
  `pgmntcrgfor` char(1) NOT NULL,
  `pgregdat` date NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `ShowTOCustomer` tinyint(1) NOT NULL,
  PRIMARY KEY (`pgcod`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbpg`
--

INSERT INTO `tbpg` (`pgcod`, `pgtit`, `pgtyp`, `pgloc`, `pglndmrk`, `pgadd`, `pgrnt`, `pgrntfor`, `pgscrty`, `pgocrg`, `pgnofseats`, `pgavlfrm`, `pgdsc`, `pgsts`, `pgregcod`, `pgnoper`, `pgfursts`, `pgdelsts`, `pglat`, `pglog`, `pgmntcrg`, `pgmntcrgfor`, `pgregdat`, `IsActive`, `ShowTOCustomer`) VALUES
(43, 'pg for girls', 'G', 33, 'pta', 'uni', 1234, 'M', 123, 343, 15, '0000-00-00', 'descrip tion is here   wekjfwfbewkjbfkewjdbfkjewfbkjwebfkjwefbewkjfbkjewfbewjbfjxwbfjhebjebjewfbjewhbfjewbfewkjbfkjwefwkefoiwefh4ufwrkcbwvsemanbckw jhfbwefbewiu efeiufhiu hiufhewiu rjfbriufhf jfbi34ufhe djf ref3riufh3rwiufhierfhirefherfbej cv jrevkjerverivb', 'Y', 26, 3, 'F', 'Y', '40.714398', '-74.005279', 2323, '2', '2015-10-26', 1, 1),
(44, 'preet pg', 'B', 34, 'near Sandhu Daily', '# 60-c professor colony opp Punjabi University patiala', 3223, 'M', 3232, 2323, 15, '2017-08-07', 'this is very good pg . at best location. this is front faccing to garden . with viip number like 2343. this is very goiod awsson. you may like , gthis is humbel request please get this pg . we need to go abroar for 3 years . please take this pg . otersise we ,. need come one oter to take care of this pg . please taje . we will be vewry yjank full you yu . yhanks love you.', 'Y', 4, 7, 'U', 'Y', '40.714398', '-74.005279', 32323, '3', '2015-11-12', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbpgfac`
--

DROP TABLE IF EXISTS `tbpgfac`;
CREATE TABLE IF NOT EXISTS `tbpgfac` (
  `pgfaccod` int(11) NOT NULL AUTO_INCREMENT,
  `pgfacnam` varchar(30) NOT NULL,
  `pgfactyp` char(1) NOT NULL,
  PRIMARY KEY (`pgfaccod`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbpgfac`
--

INSERT INTO `tbpgfac` (`pgfaccod`, `pgfacnam`, `pgfactyp`) VALUES
(1, 'WIFI', 'P'),
(2, 'FOOD', 'P'),
(3, 'Two_Wheeler_Parking', 'P'),
(4, 'Personal_BathRoom', 'P'),
(5, 'Laundry', 'P'),
(6, 'AC', 'P'),
(7, 'TV', 'P'),
(8, 'Four_Wheeler_Parking', 'P'),
(9, 'Personal_kitchen', 'P'),
(10, 'Balcony', 'P'),
(12, 'WIFI', 'F'),
(13, '  Four wheller parking ', 'F'),
(14, ' TV', 'F'),
(15, 'Bed', 'F'),
(16, 'Two_wheller_parking', 'F'),
(17, 'Laundery', 'F'),
(18, 'Ac', 'F'),
(19, 'Gas_Connection', 'F'),
(20, 'Two_wheller_parking', 'H'),
(21, 'four_wheller_parking', 'H'),
(22, 'Electricity_connection', 'H'),
(23, 'Gas_Connection', 'H'),
(24, 'Two_wheller_parking', 'C'),
(25, 'four_wheller_parking', 'C'),
(26, 'Electricity_connection', 'C'),
(28, ' abcd', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `tbpgpic`
--

DROP TABLE IF EXISTS `tbpgpic`;
CREATE TABLE IF NOT EXISTS `tbpgpic` (
  `pgpiccod` int(11) NOT NULL AUTO_INCREMENT,
  `pgpicfil` varchar(50) NOT NULL,
  `pgpicdsc` varchar(100) NOT NULL,
  `pgpicpgcod` int(11) NOT NULL,
  `pgpictyp` char(1) NOT NULL,
  PRIMARY KEY (`pgpiccod`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbpgpic`
--

INSERT INTO `tbpgpic` (`pgpiccod`, `pgpicfil`, `pgpicdsc`, `pgpicpgcod`, `pgpictyp`) VALUES
(24, '.jpg', 'this is pg description', 43, 'P'),
(25, '.jpg', 'this is pg description', 43, 'P'),
(26, '.jpg', 'this is pg description', 8, 'H'),
(27, '.jpg', 'this is pg description', 44, 'P'),
(28, '.jpg', 'this is pg description', 44, 'P'),
(29, '.jpg', 'this is pg description', 44, 'P'),
(30, '.jpg', 'this is pg description', 45, 'P'),
(31, '.png', 'this is pg description', 46, 'P'),
(32, '.jpg', 'this is pg description', 2, 'F'),
(33, '.png', 'this is pg description', 0, 'N'),
(34, '.png', 'this is pg description', 0, 'N'),
(35, '.png', 'this is pg description', 0, 'N'),
(36, '.png', 'this is pg description', 0, 'N'),
(37, '.png', 'this is pg description', 0, 'N'),
(38, '.png', 'this is pg description', 49, 'P'),
(39, '.png', 'this is pg description', 52, 'P'),
(40, '.png', 'this is pg description', 55, 'P');

-- --------------------------------------------------------

--
-- Table structure for table `tbprf`
--

DROP TABLE IF EXISTS `tbprf`;
CREATE TABLE IF NOT EXISTS `tbprf` (
  `prfcod` int(11) NOT NULL AUTO_INCREMENT,
  `prfnam` varchar(50) NOT NULL,
  `prfphn` varchar(20) NOT NULL,
  `prftyp` char(1) NOT NULL,
  `prfregcod` int(11) NOT NULL,
  `prfadd` varchar(100) NOT NULL,
  `prfcmp` varchar(50) NOT NULL,
  `prfpic` varchar(50) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `Otp` int(11) NOT NULL,
  `IsOtpApproved` tinyint(1) NOT NULL,
  `prfLocation` int(11) NOT NULL,
  PRIMARY KEY (`prfcod`),
  UNIQUE KEY `prfphn` (`prfphn`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbprf`
--

INSERT INTO `tbprf` (`prfcod`, `prfnam`, `prfphn`, `prftyp`, `prfregcod`, `prfadd`, `prfcmp`, `prfpic`, `IsActive`, `Otp`, `IsOtpApproved`, `prfLocation`) VALUES
(19, 'preetinder Singh', '9041450614', 'B', 4, 'dfguyhgtrvfcdxs', 'help', '.png', 1, 8352, 1, 36),
(21, 'Admin ', '9501516800', 'B', 11, 'Patiala', 'Admin', '.png', 1, 2614, 1, 36),
(22, 'abhushan', '9465209952', 'O', 50, 'fgfgffg', 'dfdf', '.jpg', 0, 4751, 1, 33);

-- --------------------------------------------------------

--
-- Table structure for table `tbreg`
--

DROP TABLE IF EXISTS `tbreg`;
CREATE TABLE IF NOT EXISTS `tbreg` (
  `regcod` int(11) NOT NULL AUTO_INCREMENT,
  `regeml` varchar(50) NOT NULL,
  `regpwd` varchar(50) NOT NULL,
  `regdat` datetime NOT NULL,
  `regrol` char(1) NOT NULL,
  PRIMARY KEY (`regcod`),
  UNIQUE KEY `regeml` (`regeml`),
  UNIQUE KEY `regeml_2` (`regeml`),
  UNIQUE KEY `regeml_3` (`regeml`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbreg`
--

INSERT INTO `tbreg` (`regcod`, `regeml`, `regpwd`, `regdat`, `regrol`) VALUES
(4, 'preet@gmail.com', 'indercssoft', '2015-07-15 00:00:00', 'U'),
(11, 'admin@property.com', 'admin123#', '2015-05-05 00:00:00', 'A'),
(50, 'anhushan@gmail.com', '1234', '2017-06-10 00:00:00', 'U');

-- --------------------------------------------------------

--
-- Table structure for table `tbsubcat`
--

DROP TABLE IF EXISTS `tbsubcat`;
CREATE TABLE IF NOT EXISTS `tbsubcat` (
  `subcatcod` int(11) NOT NULL AUTO_INCREMENT,
  `subcatnam` varchar(100) NOT NULL,
  `subcatcatcod` int(11) NOT NULL,
  PRIMARY KEY (`subcatcod`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbsubcat`
--

INSERT INTO `tbsubcat` (`subcatcod`, `subcatnam`, `subcatcatcod`) VALUES
(2, 'jjjjj', 6),
(3, ' kkkkkkkkkkkk s', 10),
(4, ' ddddd', 10),
(5, ' asasas', 10),
(6, ' ssss', 9),
(8, '  SAMSUNG', 12),
(10, 'Honda ', 11),
(11, 'NOKIA', 12),
(18, ' Iphone', 12),
(31, ' ghghgh', 21),
(32, 'Hondabbvv', 11),
(33, ' ghuman nagar', 14),
(34, ' urban estate', 14),
(35, ' sec 22 ', 15),
(36, ' sector 21', 15),
(37, ' sector 43', 15),
(38, ' main city', 16),
(39, ' cantt', 16);

-- --------------------------------------------------------

--
-- Table structure for table `tbtestimonial`
--

DROP TABLE IF EXISTS `tbtestimonial`;
CREATE TABLE IF NOT EXISTS `tbtestimonial` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `text` varchar(500) NOT NULL,
  `Picture` varchar(10) NOT NULL,
  `Month` varchar(10) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbtestimonial`
--

INSERT INTO `tbtestimonial` (`code`, `UserName`, `text`, `Picture`, `Month`, `IsActive`) VALUES
(9, 'ArshDeep Singh', 'I found my current apartment on EasyRent with extraordinary help from them and totally satisfied with the choice I made. All I had to do was to tell what I was looking for and I got back property suggestions nearly exact to my imagination. Among those, I finally chose mine now then completed procedure at ease. Highly recommend EasyRent for your home search.', '.jpg', 'September', 1),
(10, 'GaganDeep', 'I found my current apartment on EasyRent with extraordinary help from them and totally satisfied with the choice I made. All I had to do was to tell what I was looking for and I got back property suggestions nearly exact to my imagination. Among those, I finally chose mine now then completed procedure at ease. Highly recommend EasyRent for your home search.', '.jpg', 'September', 1),
(11, 'HariOM', 'I found my current apartment on EasyRent with extraordinary help from them and totally satisfied with the choice I made. All I had to do was to tell what I was looking for and I got back property suggestions nearly exact to my imagination. Among those, I finally chose mine now then completed procedure at ease. Highly recommend EasyRent for your home search.', '.jpg', 'December', 1),
(12, 'RamParshad', 'I found my current apartment on EasyRent with extraordinary help from them and totally satisfied with the choice I made. All I had to do was to tell what I was looking for and I got back property suggestions nearly exact to my imagination. Among those, I finally chose mine now then completed procedure at ease. Highly recommend EasyRent for your home search.', '.jpg', 'June', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbuseralerts`
--

DROP TABLE IF EXISTS `tbuseralerts`;
CREATE TABLE IF NOT EXISTS `tbuseralerts` (
  `UserAlertsId` int(11) NOT NULL AUTO_INCREMENT,
  `PropertyType` varchar(10) NOT NULL,
  `Location` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  PRIMARY KEY (`UserAlertsId`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbuseralerts`
--

INSERT INTO `tbuseralerts` (`UserAlertsId`, `PropertyType`, `Location`, `UserId`) VALUES
(1, 'P', 23, 4),
(17, 'P', 36, 4),
(13, 'C', 37, 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;