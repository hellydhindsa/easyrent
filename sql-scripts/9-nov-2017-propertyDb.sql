-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2017 at 04:44 AM
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
CREATE   PROCEDURE `abc` (IN `fgfg` INT)  NO SQL
    DETERMINISTIC
begin
end$$

DROP PROCEDURE IF EXISTS `ChangePassword`$$
CREATE   PROCEDURE `ChangePassword` (IN `password` VARCHAR(50), IN `registrationCode` INT, OUT `phone` VARCHAR(50))  NO SQL
begin
declare actphone varchar(50);
select prfphn from tbprf profile, tbreg registration where registration.regcod=profile.prfregcod AND registration.regcod = registrationCode into @actphone;
update tbreg set regpwd=password where regcod = registrationCode;
 set phone = @actphone;
end$$

DROP PROCEDURE IF EXISTS `delcat`$$
CREATE   PROCEDURE `delcat` (IN `ccod` INT)  NO SQL
begin
delete from tbcat where catcod=ccod;
end$$

DROP PROCEDURE IF EXISTS `delcp`$$
CREATE   PROCEDURE `delcp` (IN `ccod` INT)  NO SQL
begin
delete from tbcp where cpcod=ccod;
end$$

DROP PROCEDURE IF EXISTS `DeleteAllFeaturesByUser`$$
CREATE   PROCEDURE `DeleteAllFeaturesByUser` (IN `cod` INT, IN `typ` CHAR(1))  NO SQL
begin
delete from tbfacprp where facprpprpcod=cod and facprpprptyp = typ;
end$$

DROP PROCEDURE IF EXISTS `DeletePropertyPics`$$
CREATE   PROCEDURE `DeletePropertyPics` (IN `pcod` INT)  NO SQL
begin
delete from tbpgpic where pgpiccod=pcod;
end$$

DROP PROCEDURE IF EXISTS `DeleteUserAlert`$$
CREATE   PROCEDURE `DeleteUserAlert` (IN `cod` INT)  NO SQL
BEGIN
DELETE from tbuseralerts where userAlertsId=cod;
END$$

DROP PROCEDURE IF EXISTS `DeleteUserTestimonial`$$
CREATE   PROCEDURE `DeleteUserTestimonial` (IN `cod` INT)  NO SQL
BEGIN
DELETE from tbtestimonial where code=cod;
END$$

DROP PROCEDURE IF EXISTS `delfac`$$
CREATE   PROCEDURE `delfac` (IN `ccod` INT)  NO SQL
begin
delete from tbpgfac where pgfaccod=ccod;
end$$

DROP PROCEDURE IF EXISTS `delflo`$$
CREATE   PROCEDURE `delflo` (IN `fcod` INT)  NO SQL
begin
delete from tbflo where flocod=fcod;
end$$

DROP PROCEDURE IF EXISTS `delhus`$$
CREATE   PROCEDURE `delhus` (IN `hcod` INT)  NO SQL
begin
delete from tbhus where huscod=hcod;
end$$

DROP PROCEDURE IF EXISTS `delpg`$$
CREATE   PROCEDURE `delpg` (IN `pcod` INT)  NO SQL
begin
delete from tbpg where pgcod=pcod;
end$$

DROP PROCEDURE IF EXISTS `delprf`$$
CREATE   PROCEDURE `delprf` (IN `pcod` INT)  NO SQL
begin
delete from tbprf where prfcod=pcod;
end$$

DROP PROCEDURE IF EXISTS `delreg`$$
CREATE   PROCEDURE `delreg` (IN `rcod` INT)  NO SQL
begin
delete from tbreg where regcod=rcod;
end$$

DROP PROCEDURE IF EXISTS `delsubcat`$$
CREATE   PROCEDURE `delsubcat` (IN `sccod` INT)  NO SQL
begin
delete from tbsubcat where subcatcod=sccod;
end$$

DROP PROCEDURE IF EXISTS `DiplayUserProfileByPropertyId`$$
CREATE   PROCEDURE `DiplayUserProfileByPropertyId` (IN `pcod` INT, IN `typ` CHAR(1))  NO SQL
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
CREATE   PROCEDURE `DispalyActiveTestimonials` ()  NO SQL
BEGIN
select * from tbtestimonial where isactive=1;
END$$

DROP PROCEDURE IF EXISTS `DisplayAgentsByAgentId`$$
CREATE   PROCEDURE `DisplayAgentsByAgentId` (IN `AgentCod` INT)  NO SQL
BEGIN
select b.prfnam,b.prfcmp,b.prfphn,b.prfadd,CONCAT(b.prfcod,b.prfpic) as pic,b.prfcod,a.regeml from tbprf b, tbreg a where b.prftyp='B' and b.prfcod=AgentCod and  a.regcod=b.prfregcod;
END$$

DROP PROCEDURE IF EXISTS `DisplayAllAgentsByLocation`$$
CREATE   PROCEDURE `DisplayAllAgentsByLocation` (IN `locationId` INT)  NO SQL
BEGIN
select b.prfnam,b.prfcmp,CONCAT(b.prfcod,b.prfpic) as pic,b.prfcod from tbprf b where b.prftyp='B' and b.prfLocation=locationId and IsActive=1;
END$$

DROP PROCEDURE IF EXISTS `DisplayPropertyDetailByID`$$
CREATE   PROCEDURE `DisplayPropertyDetailByID` (IN `pcod` INT, IN `typ` CHAR(1))  NO SQL
begin
 DECLARE lcod int;
 if typ = 'P' THEN
SELECT property.*,city.catnam as city,city.catcod as citycod,location.subcatnam as location from tbpg property inner JOIN tbsubcat location on property.pgloc=location.subcatcod inner join tbcat city on location.subcatcatcod=city.catcod where pgcod=pcod; 
 elseif typ = 'H' THEN
 SELECT property.*,city.catnam as city,city.catcod as citycod,location.subcatnam as location from tbhus property inner JOIN tbsubcat location on property.husloc=location.subcatcod inner join tbcat city on location.subcatcatcod=city.catcod where huscod=pcod;
 elseif typ = 'C' THEN
  SELECT property.*,city.catnam as city,city.catcod as citycod,location.subcatnam as location from tbcp property inner JOIN tbsubcat location on property.cploc=location.subcatcod inner join tbcat city on location.subcatcatcod=city.catcod where cpcod=pcod;
 elseif typ = 'F' THEN
   SELECT property.*,city.catnam as city,city.catcod as citycod,location.subcatnam as location from tbflo property inner JOIN tbsubcat location on property.floloc=location.subcatcod inner join tbcat city on location.subcatcatcod=city.catcod where flocod=pcod;
 end if;

end$$

DROP PROCEDURE IF EXISTS `DisplayPropertyFacilityByIdAndType`$$
CREATE   PROCEDURE `DisplayPropertyFacilityByIdAndType` (IN `cod` INT, IN `typ` CHAR(1))  NO SQL
    DETERMINISTIC
BEGIN
SELECT * from tbfacprp where facprpprpcod=cod and facprpprptyp=typ;
END$$

DROP PROCEDURE IF EXISTS `DisplayRecentProperties`$$
CREATE   PROCEDURE `DisplayRecentProperties` ()  NO SQL
begin
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat  from tbpg a where IsActive=1 and ShowToCustomer=1 and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat  from tbflo a where IsActive=1 and ShowToCustomer=1 and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat from tbhus a where IsActive=1 and ShowToCustomer=1 and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat  from tbcp a where IsActive=1 and ShowToCustomer=1 and IsDeleted=0 order by regdat desc LIMIT 0,4;
end$$

DROP PROCEDURE IF EXISTS `DisplayUserByUserId`$$
CREATE   PROCEDURE `DisplayUserByUserId` (IN `UserId` INT)  NO SQL
BEGIN
select b.prfnam,b.prfcmp,b.prfphn,b.prfadd,CONCAT(b.prfcod,b.prfpic) as pic,b.prfcod,a.regeml from tbprf b, tbreg a where b.prfcod=UserId and  a.regcod=b.prfregcod;
END$$

DROP PROCEDURE IF EXISTS `DisplayUsersAdmin`$$
CREATE   PROCEDURE `DisplayUsersAdmin` ()  NO SQL
BEGIN
select city.catnam,location.subcatnam, profile.prfnam,profile.prfcmp,CONCAT(profile.prfcod,profile.prfpic) as pic,profile.prfcod,profile.IsActive,profile.prftyp from tbprf profile  inner JOIN tbsubcat location on profile.prfLocation=location.subcatcod inner join tbcat city on location.subcatcatcod=city.catcod ;


END$$

DROP PROCEDURE IF EXISTS `dspcat`$$
CREATE   PROCEDURE `dspcat` ()  NO SQL
begin
select * from tbcat ORDER BY catnam ;
end$$

DROP PROCEDURE IF EXISTS `dspfac`$$
CREATE   PROCEDURE `dspfac` (IN `factyp` CHAR(1))  NO SQL
begin
select * from tbpgfac where pgfactyp=factyp;
end$$

DROP PROCEDURE IF EXISTS `DspIndexSearchResult`$$
CREATE   PROCEDURE `DspIndexSearchResult` (IN `lcod` INT, IN `typ` CHAR(1), IN `cat` CHAR(1))  NO SQL
begin
if cat='A' and typ='A' and lcod=0 then
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat,pgadd as address  from tbpg a where IsActive=1 and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat,floadd as address  from tbflo a where IsActive=1 and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a where IsActive=1 and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat ,cpadd as address from tbcp a where IsActive=1 and IsDeleted=0 order by regdat desc;
elseif cat='A' and typ='A' and lcod!=0 then
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat,pgadd as address  from tbpg a where pgloc=lcod and IsActive=1 and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat ,floadd as address from tbflo a where floloc=lcod and IsActive=1 and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a where husloc=lcod and IsActive=1 and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat ,cpadd as address from tbcp a where cploc=lcod and IsActive=1 and IsDeleted=0 order by regdat desc;
elseif cat='A' and typ!='A' and lcod=0 then

if typ = 'P' then
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat,pgadd as address  from tbpg a where IsActive=1 and IsDeleted=0 ;
elseif typ = 'H' then
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a where IsActive=1 and IsDeleted=0 ;
elseif typ = 'C' then
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat,cpadd as address  from tbcp a where IsActive=1 and IsDeleted=0;
elseif typ = 'F' then
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat ,floadd as address from tbflo a where IsActive=1 and IsDeleted=0 ;
end if;
elseif cat !='A' and typ='A' and lcod=0 then
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat  from tbpg a,pgadd as address where pgtyp=cat and IsActive=1 and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat,floadd as address  from tbflo a where flofor=cat and IsActive=1 and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a where husfor=cat and IsActive=1 and IsDeleted=0 order by regdat desc;
elseif cat !='A' and typ !='A' and lcod=0 then

if typ = 'P' then
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat ,pgadd as address from tbpg a where  pgtyp=cat and IsActive=1 and IsDeleted=0;
elseif typ = 'H' then
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a where husfor=cat and IsActive=1 and IsDeleted=0;
elseif typ = 'C' then
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat ,cpadd as address from tbcp a WHERE IsActive=1 and IsDeleted=0 ;
elseif typ = 'F' then
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat ,floadd as address from tbflo a where flofor=cat and IsActive=1 and IsDeleted=0;
end if;
elseif cat ='A' and typ !='A' and lcod !=0 then

if typ = 'P' then
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat ,pgadd as address from tbpg a where pgloc=lcod and IsActive=1 and IsDeleted=0 ;
elseif typ = 'H' then
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a where husloc=lcod and IsActive=1 and IsDeleted=0;
elseif typ = 'C' then
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat,cpadd as address  from tbcp a where cploc=lcod and IsActive=1 and IsDeleted=0;
elseif typ = 'F' then
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat,floadd as address  from tbflo a where floloc=lcod and IsActive=1 and IsDeleted=0 ;
end if;
elseif cat !='A' and typ ='A' and lcod !=0 then

select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat ,pgadd as address from tbpg a where pgloc=lcod and pgtyp=cat and IsActive=1 and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat,floadd as address  from tbflo a where floloc=lcod and flofor=cat and IsActive=1 and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a where husloc=lcod and husfor=cat and IsActive=1 and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat ,cpadd as address from tbcp a where cploc=lcod and IsActive=1 and IsDeleted=0 order by regdat desc;
elseif cat !='A' and typ !='A' and lcod !=0 then

if typ = 'P' then
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat,pgadd as address  from tbpg a where pgloc=lcod and pgtyp=cat and IsActive=1 and IsDeleted=0 order by regdat desc ;
elseif typ = 'H' then
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a where husloc=lcod and husfor=cat and IsActive=1 and IsDeleted=0 order by regdat desc ;
elseif typ = 'C' then
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat,cpadd as address  from tbcp a where cploc=lcod and IsActive=1 and IsDeleted=0 order by regdat desc;
elseif typ = 'F' then
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat ,floadd as address from tbflo a where floloc=lcod and flofor=cat and IsActive=1 and IsDeleted=0 order by regdat desc ;
end if;

end if;
end$$

DROP PROCEDURE IF EXISTS `DspInnerSearchResult`$$
CREATE   PROCEDURE `DspInnerSearchResult` (IN `lcod` INT, IN `typ` CHAR(1), IN `cat` CHAR(1), IN `fursts` CHAR(1), IN `noofbed` INT, IN `commsts` CHAR(2), IN `pricelow` INT, IN `pricehigh` INT, IN `pricetyp` CHAR(1))  NO SQL
begin

if typ = 'P' then
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat,pgadd as address  from tbpg a where pgtyp=cat and pgfursts=fursts and pgrnt>pricelow and pgrnt<pricehigh and pgrntfor=pricetyp and IsActive=1 and IsDeleted=0 ;
elseif typ = 'H' then
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husadd as address from tbhus a where husfor=cat and husbdrm=noofbed and husfursts=fursts and husrnt>pricelow and husrnt<pricehigh and husrntfor=pricetyp and IsActive=1 and IsDeleted=0;
elseif typ = 'C' then
if commsts!='A' then
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat,cpadd as address  from tbcp a where cptyp=commsts and cpfursts=fursts and cprnt>pricelow and cprnt<pricehigh and cprntfor=pricetyp and IsActive=1 and IsDeleted=0;
else
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat,cpadd as address  from tbcp a where cpfursts=fursts and IsActive=1 and IsDeleted=0;
end if;
elseif typ = 'F' then
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat ,floadd as address from tbflo a where flofor=cat and flobdrm=noofbed and flofursts=fursts and flornt>pricelow and flornt<pricehigh and florntfor=pricetyp and IsActive=1 and IsDeleted=0 ;

end if;

end$$

DROP PROCEDURE IF EXISTS `dsppgpics`$$
CREATE   PROCEDURE `dsppgpics` (IN `pcod` INT, IN `ptyp` CHAR(1))  NO SQL
begin
select * from tbpgpic where pgpicpgcod=pcod and pgpictyp=ptyp;
end$$

DROP PROCEDURE IF EXISTS `dspprf`$$
CREATE   PROCEDURE `dspprf` ()  NO SQL
begin
select * from tbprf;
end$$

DROP PROCEDURE IF EXISTS `dspreg`$$
CREATE   PROCEDURE `dspreg` ()  NO SQL
begin
select * from tbreg;
end$$

DROP PROCEDURE IF EXISTS `dspsfacprp`$$
CREATE   PROCEDURE `dspsfacprp` (IN `prpcod` INT)  NO SQL
begin
select * from tbfacprp where facprpprpcod=pgcod;
end$$

DROP PROCEDURE IF EXISTS `dspsubcat`$$
CREATE   PROCEDURE `dspsubcat` (IN `sccod` INT)  NO SQL
begin
select * from tbsubcat where subcatcatcod=sccod;
end$$

DROP PROCEDURE IF EXISTS `dspusrprf`$$
CREATE   PROCEDURE `dspusrprf` (IN `lcod` INT)  NO SQL
begin
select a.regeml,a.regdat,b.prfnam,b.prfphn,b.prfcmp,b.prfadd,b.prftyp,CONCAT(b.prfcod,b.prfpic) as pic,b.prfcod from tbreg a,tbprf b where a.regcod=b.prfregcod  and a.regcod=lcod;
end$$

DROP PROCEDURE IF EXISTS `dspusrprp`$$
CREATE   PROCEDURE `dspusrprp` (IN `lcod` INT)  NO SQL
begin
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat,pgrntfor as rentFor  from tbpg a where pgregcod=lcod and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat,florntfor as rentFor  from tbflo a where floregcod=lcod and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat,husrntfor as rentFor from tbhus a where husregcod=lcod and IsDeleted=0
UNION ALL
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat,cprntfor as rentFor  from tbcp a where cpregcod=lcod and IsDeleted=0 order by regdat desc;
end$$

DROP PROCEDURE IF EXISTS `findcat`$$
CREATE   PROCEDURE `findcat` (IN `ccod` INT)  NO SQL
begin
select * from tbcat where catcod=ccod;
end$$

DROP PROCEDURE IF EXISTS `findcp`$$
CREATE   PROCEDURE `findcp` (IN `ccod` INT)  NO SQL
begin
select * from tbcp where cpcod=ccod;
end$$

DROP PROCEDURE IF EXISTS `findfac`$$
CREATE   PROCEDURE `findfac` (IN `ccod` INT)  NO SQL
begin
select * from tbpgfac where pgfaccod=ccod;
end$$

DROP PROCEDURE IF EXISTS `findflo`$$
CREATE   PROCEDURE `findflo` (IN `fcod` INT)  NO SQL
begin
select * from tbflo where flocod=fcod;
end$$

DROP PROCEDURE IF EXISTS `findhus`$$
CREATE   PROCEDURE `findhus` (IN `hcod` INT)  NO SQL
begin
select * from tbhus where huscod=hcod;
end$$

DROP PROCEDURE IF EXISTS `findpg`$$
CREATE   PROCEDURE `findpg` (IN `pcod` INT)  NO SQL
begin
select * from tbpg where pgcod=pcod;
end$$

DROP PROCEDURE IF EXISTS `findprf`$$
CREATE   PROCEDURE `findprf` (IN `pcod` INT)  NO SQL
begin
select * from tbprf where prfcod=pcod;
end$$

DROP PROCEDURE IF EXISTS `findreg`$$
CREATE   PROCEDURE `findreg` (IN `rcod` INT)  NO SQL
begin
select * from tbreg where regcod=rcod;
end$$

DROP PROCEDURE IF EXISTS `findsubcat`$$
CREATE   PROCEDURE `findsubcat` (IN `sccod` INT)  NO SQL
begin
select * from tbsubcat where subcatcod=sccod;
end$$

DROP PROCEDURE IF EXISTS `fndlstpgpic`$$
CREATE   PROCEDURE `fndlstpgpic` (OUT `lpiccod` INT)  NO SQL
begin
select max(pgpiccod) from tbpgpic  into lpiccod;
end$$

DROP PROCEDURE IF EXISTS `GetCityAndLocationNamesByLocationId`$$
CREATE   PROCEDURE `GetCityAndLocationNamesByLocationId` (IN `Lcod` INT)  NO SQL
begin
SELECT city.catnam as city,location.subcatnam as location from tbsubcat location inner join tbcat city on location.subcatcatcod=city.catcod where location.subcatcod=Lcod;

END$$

DROP PROCEDURE IF EXISTS `GetContactForm`$$
CREATE   PROCEDURE `GetContactForm` ()  NO SQL
BEGIN
SELECT * FROM contactform where isdeleted=0 order by date DESC ;
END$$

DROP PROCEDURE IF EXISTS `GetPropertyPicturesCount`$$
CREATE   PROCEDURE `GetPropertyPicturesCount` (IN `ppicpgcod` INT, IN `ppictyp` CHAR(1))  NO SQL
SELECT count(*) FROM tbpgpic where pgpicpgcod=ppicpgcod and pgpictyp=ppictyp$$

DROP PROCEDURE IF EXISTS `GetResendOTP`$$
CREATE   PROCEDURE `GetResendOTP` (IN `remail` VARCHAR(50))  NO SQL
begin
SELECT profile.otp,profile.prfphn  from tbprf profile,tbreg register where profile.prfregcod=register.regcod and register.regeml=remail;
end$$

DROP PROCEDURE IF EXISTS `GetUserAlerts`$$
CREATE   PROCEDURE `GetUserAlerts` (IN `uid` INT)  NO SQL
BEGIN
select city.catnam,location.subcatnam ,alert.propertyType,alert.useralertsid from tbuseralerts alert inner JOIN tbsubcat location on alert.location=location.subcatcod inner join tbcat city on location.subcatcatcod =city.catcod where UserId=uid;
END$$

DROP PROCEDURE IF EXISTS `GetUserdetailsForAlerts`$$
CREATE   PROCEDURE `GetUserdetailsForAlerts` (IN `LocationId` INT, IN `PropType` CHAR(1))  NO SQL
BEGIN
select DISTINCT profile.prfphn, register.regeml,profile.prfnam from tbreg register 
inner join tbprf profile on register.regcod=profile.prfregcod
inner join tbuseralerts alert on register.regcod=alert.UserId where propertytype=PropType and location=LocationId;

END$$

DROP PROCEDURE IF EXISTS `inscat`$$
CREATE   PROCEDURE `inscat` (IN `catnam` VARCHAR(50))  NO SQL
begin
insert tbcat values(null,catnam);
end$$

DROP PROCEDURE IF EXISTS `inscp`$$
CREATE   PROCEDURE `inscp` (IN `ctyp` CHAR(1), IN `cloc` INT, IN `clndmrk` VARCHAR(100), IN `cadd` VARCHAR(100), IN `cpwshrm` CHAR(1), IN `cppntry` CHAR(1), IN `cflono` INT, IN `cflo` INT, IN `carecov` INT, IN `crdfac` INT, IN `crnt` FLOAT, IN `crntfor` CHAR(1), IN `cmntcrg` FLOAT, IN `cmntcrgfor` CHAR(1), IN `cocrg` FLOAT, IN `cavlfrm` DATE, IN `cageofconst` INT, IN `cdsc` VARCHAR(200), IN `cregcod` INT, IN `cpubsts` CHAR(1), IN `cregdat` DATE, IN `cdelsts` CHAR(1), IN `clat` VARCHAR(20), IN `clng` VARCHAR(20), IN `cscrty` FLOAT, IN `careunit` VARCHAR(20), IN `cfursts` CHAR(1), OUT `cod` INT)  NO SQL
begin
insert tbcp values(null,ctyp,cloc,clndmrk,cadd,cpwshrm,cppntry,cflono,cflo,carecov,crdfac,crnt,crntfor,cmntcrg,cmntcrgfor,cocrg,cavlfrm,cageofconst,cdsc,cregcod,cpubsts,cregdat,cdelsts,clat,clng,cscrty,careunit,cfursts,1,0);
select last_insert_id() into cod;
end$$

DROP PROCEDURE IF EXISTS `insertContactForm`$$
CREATE   PROCEDURE `insertContactForm` (IN `contactFormName` VARCHAR(15), IN `contactFormEmail` VARCHAR(50), IN `contactFormSubject` VARCHAR(20), IN `contactFormMessage` VARCHAR(100), IN `contactFormDate` DATE)  NO SQL
begin
insert contactform (ContactFormId,Date,Email,IsDeleted,Message,Name,Subject) values(null,contactFormDate,contactFormEmail,0,contactFormMessage,contactFormName,contactFormSubject);

end$$

DROP PROCEDURE IF EXISTS `insertTestimonial`$$
CREATE   PROCEDURE `insertTestimonial` (IN `Forusername` VARCHAR(50), IN `Fortext` VARCHAR(500), IN `Formonth` VARCHAR(10), IN `Forpicture` VARCHAR(10), OUT `cod` INT)  NO SQL
begin
insert tbtestimonial (code,IsActive,month,picture,text,username) values(null,1,Formonth,Forpicture,Fortext,Forusername);
select last_insert_id() into cod;
end$$

DROP PROCEDURE IF EXISTS `InsertUserAlerts`$$
CREATE   PROCEDURE `InsertUserAlerts` (IN `PropType` VARCHAR(10), IN `loc` INT, IN `uid` INT)  NO SQL
BEGIN
INSERT INTO `tbuseralerts`( `PropertyType`, `Location`, `UserId`) VALUES (PropType,loc,uid);
END$$

DROP PROCEDURE IF EXISTS `insfac`$$
CREATE   PROCEDURE `insfac` (IN `facnam` VARCHAR(50), IN `factyp` CHAR(1))  NO SQL
begin
insert tbpgfac values(null,facnam,factyp);
end$$

DROP PROCEDURE IF EXISTS `insfacprp`$$
CREATE   PROCEDURE `insfacprp` (IN `faccod` INT, IN `pgccod` INT, IN `prptyp` CHAR(1))  NO SQL
begin
insert tbfacprp values(null,faccod,pgccod,prptyp);
end$$

DROP PROCEDURE IF EXISTS `insflo`$$
CREATE   PROCEDURE `insflo` (IN `ffor` CHAR(1), IN `floc` INT, IN `flnfmrk` VARCHAR(100), IN `fadd` VARCHAR(100), IN `fbdrm` INT, IN `fbthrm` INT, IN `fblcny` INT, IN `fkitchen` CHAR(1), IN `flvroom` CHAR(1), IN `ffursts` CHAR(1), IN `fflono` INT, IN `fflotot` INT, IN `frnt` FLOAT, IN `frntfor` INT, IN `focrg` FLOAT, IN `fscrty` FLOAT, IN `fmntcrg` FLOAT, IN `fmntcrgfor` INT, IN `fsts` CHAR(1), IN `fregcod` INT, IN `favlfrom` DATE, IN `fdsc` VARCHAR(500), IN `fdelsts` CHAR(1), IN `flat` VARCHAR(10), IN `flong` VARCHAR(10), IN `ftotare` INT, IN `fareunit` VARCHAR(10), IN `fregdat` DATE, OUT `cod` INT)  NO SQL
begin
insert tbflo values(null,ffor,floc,flnfmrk,fadd,fbdrm,fbthrm,fblcny,fkitchen,flvroom,ffursts,fflono,fflotot,frnt,frntfor,focrg,fscrty,fmntcrg,fmntcrgfor,fsts,fregcod,favlfrom,fdsc,fdelsts,flat,flong,ftotare,fareunit,fregdat,1,0);
select last_insert_id() into cod;
end$$

DROP PROCEDURE IF EXISTS `inshus`$$
CREATE   PROCEDURE `inshus` (IN `hfor` CHAR(1), IN `hloc` INT, IN `hlndmrk` VARCHAR(100), IN `hadd` VARCHAR(100), IN `hbdrm` INT, IN `hbthrm` INT, IN `hblcny` INT, IN `hlby` CHAR(1), IN `hlvrm` CHAR(1), IN `hkitchen` INT, IN `hfursts` CHAR(1), IN `htotare` INT, IN `hpubsts` CHAR(1), IN `hregcod` INT, IN `hrnt` FLOAT, IN `hrntfor` CHAR(1), IN `hsrty` FLOAT, IN `hmaint` FLOAT, IN `hmaintfor` CHAR(1), IN `hocrg` FLOAT, IN `havlfrm` DATE, IN `hdsc` VARCHAR(500), IN `hdelsts` CHAR(1), IN `hlat` VARCHAR(10), IN `hlong` VARCHAR(10), IN `hareunit` VARCHAR(20), IN `hstrbut` INT, IN `hregdat` DATE, OUT `cod` INT)  NO SQL
begin
insert tbhus values(null,hfor,hloc,hlndmrk,hadd,hbdrm,hbthrm,hblcny,hlby,hlvrm,hkitchen,hfursts,htotare,hrnt,hrntfor,hsrty,hmaint,hmaintfor,hocrg,havlfrm,hdsc,hpubsts,hregcod,hdelsts,hlat,hlong,hareunit,hstrbut,hregdat,1,0);
select last_insert_id() into cod;
end$$

DROP PROCEDURE IF EXISTS `inspg`$$
CREATE   PROCEDURE `inspg` (IN `ptit` VARCHAR(50), IN `ptyp` CHAR(1), IN `ploc` INT, IN `plndmrk` VARCHAR(100), IN `padd` VARCHAR(100), IN `prnt` FLOAT, IN `prntfor` CHAR(1), IN `pscrty` FLOAT, IN `pocrg` FLOAT, IN `pnoseats` INT, IN `pavlfrm` DATE, IN `pdsc` VARCHAR(500), IN `psts` CHAR(1), IN `pregcod` INT, IN `pnoper` INT, IN `pfursts` CHAR(1), IN `pdelsts` CHAR(1), IN `plat` VARCHAR(30), IN `plong` VARCHAR(30), IN `pmntcrg` FLOAT, IN `pmntcrgfor` CHAR(1), IN `pregdat` DATE, OUT `cod` INT)  NO SQL
begin
insert tbpg values(null,ptit,ptyp,ploc,plndmrk,padd,prnt,prntfor,pscrty,pocrg,pnoseats,pavlfrm,pdsc,psts,pregcod,pnoper,pfursts,pdelsts,plat,plong,pmntcrg,pmntcrgfor,pregdat,1,0,0);
select last_insert_id() into cod;
end$$

DROP PROCEDURE IF EXISTS `inspgpic`$$
CREATE   PROCEDURE `inspgpic` (IN `ppicfil` VARCHAR(50), IN `ppicdsc` VARCHAR(100), IN `ppicpgcod` INT, IN `ppictyp` CHAR(1))  NO SQL
begin
insert tbpgpic values(null,ppicfil,ppicdsc,ppicpgcod,ppictyp);

end$$

DROP PROCEDURE IF EXISTS `insprf`$$
CREATE   PROCEDURE `insprf` (IN `pnam` VARCHAR(50), IN `pphn` VARCHAR(50), IN `ptyp` CHAR(1), IN `pregcod` INT, IN `padd` VARCHAR(100), IN `pcmp` VARCHAR(50), IN `ppic` VARCHAR(50), IN `pisactive` INT, IN `potp` INT, IN `potpisapproved` INT, IN `ploc` INT, OUT `cod` INT)  NO SQL
begin
insert tbprf values(null,pnam,pphn,ptyp,pregcod,padd,pcmp,ppic,pisactive,potp,potpisapproved,ploc);
select last_insert_id() into cod;
end$$

DROP PROCEDURE IF EXISTS `insreg`$$
CREATE   PROCEDURE `insreg` (IN `reml` VARCHAR(50), IN `rpwd` VARCHAR(50), IN `rdat` DATETIME, IN `rrol` CHAR(1), OUT `cod` INT)  NO SQL
begin
insert tbreg values(null,reml,rpwd,rdat,rrol);
select last_insert_id() into cod;
end$$

DROP PROCEDURE IF EXISTS `inssubcat`$$
CREATE   PROCEDURE `inssubcat` (IN `scnam` VARCHAR(100), IN `scccod` INT)  NO SQL
begin
insert tbsubcat values(null,scnam,scccod);
end$$

DROP PROCEDURE IF EXISTS `logincheck`$$
CREATE   PROCEDURE `logincheck` (IN `eml` VARCHAR(50), IN `pwd` VARCHAR(50), OUT `cod` INT, OUT `rol` CHAR(1))  NO SQL
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
CREATE   PROCEDURE `ManageAllProperiesForAdmin` ()  NO SQL
begin
select pgtit as tit, SUBSTRING(pgdsc,1,20) as  dsc,'PG' as typ,pgrnt as rnt,0 as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.pgcod and pgpictyp='P' limit 0,1),'noimg.jpeg') as pic,pgcod as cod,pgregdat as regdat,IsActive as active ,ShowTOCustomer as Showtocustomer from tbpg a
UNION ALL
select '' as tit, SUBSTRING(flodsc,1,20) as  dsc,'FLOOR' as typ,flornt as rnt,flototarea as area,flobthrm as bath,flobdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.flocod and pgpictyp='F' limit 0,1),'noimg.jpeg') as pic,flocod as cod,floregdat as regdat,IsActive as active ,ShowTOCustomer as Showtocustomer  from tbflo a 
UNION ALL
select '' as tit, SUBSTRING(husdsc,1,20) as dsc,'HOUSE' as typ,husrnt as rnt,hustotare as area,husbtnrm as bath,husbdrm as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.huscod and pgpictyp='H' limit 0,1),'noimg.jpeg') as pic,huscod as cod,husregdat as regdat ,IsActive as active ,ShowTOCustomer as Showtocustomer from tbhus a
UNION ALL
select '' as tit, SUBSTRING(cpdsc,1,20) as  dsc,'COMMERCIAL' as typ,cprnt as rnt,cptotarecov as area,0 as bath,0 as bed,IFNULL((select CONCAT(pgpiccod,pgpicfil) from tbpgpic where pgpicpgcod=a.cpcod and pgpictyp='C' limit 0,1),'noimg.jpeg') as pic,cpcod as cod,cpregdat as regdat ,IsActive as active ,ShowTOCustomer as Showtocustomer  from tbcp a  order by regdat desc;
end$$

DROP PROCEDURE IF EXISTS `ResetPassword`$$
CREATE   PROCEDURE `ResetPassword` (IN `PhoneNumber` VARCHAR(20), OUT `Status` VARCHAR(20))  NO SQL
begin
DECLARE actregcod int DEFAULT -1;
DECLARE randomPassword varchar(10);
set Status='InvalidPhone';
set @randomPassword=FLOOR(RAND() * 999999);
select registration.regcod from tbprf profile, tbreg registration where registration.regcod=profile.prfregcod AND profile.prfphn=PhoneNumber into  @actregcod;
if @actregcod IS NOT NULL THEN
update tbreg set regpwd=@randomPassword where regcod = @actregcod;
set Status=@randomPassword;

end if;


end$$

DROP PROCEDURE IF EXISTS `UpdateCommercial`$$
CREATE   PROCEDURE `UpdateCommercial` (IN `ccode` INT, IN `ctyp` CHAR(1), IN `cloc` INT, IN `clndmrk` VARCHAR(100), IN `cadd` VARCHAR(100), IN `cpwshrm` CHAR(1), IN `cppntry` CHAR(1), IN `cflono` INT, IN `ctotflo` INT, IN `carecov` INT, IN `crdfac` INT, IN `crnt` FLOAT, IN `crntfor` CHAR(1), IN `cmntcrg` FLOAT, IN `cmntcrgfor` CHAR(1), IN `cocrg` FLOAT, IN `cavlfrm` DATE, IN `cageofconst` INT, IN `cdsc` VARCHAR(200), IN `cdelsts` CHAR(1), IN `cscrty` FLOAT, IN `careunit` VARCHAR(20), IN `cfursts` CHAR(1))  NO SQL
begin
UPDATE tbcp SET cptyp=ctyp,cploc=cloc,cplndmrk=clndmrk,cpadd=cadd,cppwshrm=cpwshrm,cpppentry=cppntry,cpflono=cflono,cptotflo=ctotflo,cptotarecov=carecov,cprdfac=crdfac,cprnt=crnt,cprntfor=crntfor,cpmntcrg=cmntcrg,cpmntcrgfor=cmntcrgfor,cpocry=cocrg,cpavlfrm=cavlfrm,cpageofcnst=cageofconst,cpdsc=cdsc,cpdelsts=cdelsts,cpscrty=cscrty,cpareunit=careunit,cpfursts=cfursts where cpcod=ccode;

end$$

DROP PROCEDURE IF EXISTS `UpdateFloor`$$
CREATE   PROCEDURE `UpdateFloor` (IN `flocode` INT, IN `ffor` CHAR(1), IN `floc` INT, IN `flnfmrk` VARCHAR(100), IN `fadd` VARCHAR(100), IN `fbdrm` INT, IN `fbthrm` INT, IN `fblcny` INT, IN `fkitchen` CHAR(1), IN `flvroom` CHAR(1), IN `ffursts` CHAR(1), IN `fflono` INT, IN `fflotot` INT, IN `frnt` FLOAT, IN `frntfor` CHAR(1), IN `focrg` FLOAT, IN `fscrty` FLOAT, IN `fmntcrg` FLOAT, IN `fmntcrgfor` CHAR(1), IN `favlfrom` DATE, IN `fdsc` VARCHAR(500), IN `fdelsts` CHAR(1), IN `ftotare` INT, IN `fareunit` VARCHAR(10))  NO SQL
begin
UPDATE tbflo set flofor=ffor,floloc=floc,flolndmrk=flnfmrk,floadd=fadd,flobdrm=fbdrm,flobthrm=fbthrm,floblcny=fblcny,floktchn=fkitchen,flolvrm=flvroom,flofursts=ffursts,floflono=fflono,floflotot=fflotot,flornt=frnt,florntfor=frntfor,floocrg=focrg,floscrty=fscrty,flomntcrg=fmntcrg,flomntcrgfor=fmntcrgfor,floavlfrm=favlfrom,flodsc=fdsc,flodelsts=fdelsts,flototarea=ftotare,floareunts=fareunit where flocod=flocode;

end$$

DROP PROCEDURE IF EXISTS `UpdateHouse`$$
CREATE   PROCEDURE `UpdateHouse` (IN `hcode` INT, IN `hfor` CHAR(1), IN `hloc` INT, IN `hlndmrk` VARCHAR(100), IN `hadd` VARCHAR(100), IN `hbdrm` INT, IN `hbthrm` INT, IN `hblcny` INT, IN `hlby` CHAR(1), IN `hlvrm` CHAR(1), IN `hkitchen` INT, IN `hfursts` CHAR(1), IN `htotare` INT, IN `hrnt` FLOAT, IN `hrntfor` CHAR(1), IN `hsrty` FLOAT, IN `hmaint` FLOAT, IN `hmaintfor` CHAR(1), IN `hocrg` FLOAT, IN `havlfrm` DATE, IN `hdsc` VARCHAR(500), IN `hdelsts` CHAR(1), IN `hareunit` VARCHAR(20), IN `hstrbut` INT)  NO SQL
begin
UPDATE tbhus Set husfor=hfor,husloc=hloc,huslndmrk=hlndmrk,husadd=hadd,husbdrm=hbdrm,husbtnrm=hbthrm,husblcny=hblcny,huslby=hlby,huslvrm=hlvrm,huskitchen=hkitchen,husfursts=hfursts,hustotare=htotare,husrnt=hrnt,husrntfor=hrntfor,husscrty=hsrty,husmntcrg=hmaint,husmntcryfor=hmaintfor,husocrg=hocrg,husavlfrm=havlfrm,husdsc=hdsc,husdelsts=hdelsts,husareunit=hareunit,husstrybuit=hstrbut where huscod=hcode;

end$$

DROP PROCEDURE IF EXISTS `UpdateOTPStatus`$$
CREATE   PROCEDURE `UpdateOTPStatus` (IN `eml` VARCHAR(50), IN `pwd` VARCHAR(50), IN `otpIn` INT(11), OUT `cod` INT, OUT `rol` CHAR(1))  NO SQL
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

DROP PROCEDURE IF EXISTS `UpdatePG`$$
CREATE   PROCEDURE `UpdatePG` (IN `pcod` INT, IN `ptit` VARCHAR(50), IN `ptyp` CHAR(1), IN `ploc` INT, IN `plndmrk` VARCHAR(100), IN `padd` VARCHAR(100), IN `prnt` FLOAT, IN `prntfor` CHAR(1), IN `pscrty` FLOAT, IN `pocrg` FLOAT, IN `pnoseats` INT, IN `pavlfrm` DATE, IN `pdsc` VARCHAR(500), IN `pnoper` INT, IN `pfursts` CHAR(1), IN `pdelsts` CHAR(1), IN `pmntcrg` FLOAT, IN `pmntcrgfor` CHAR(1))  NO SQL
begin
update tbpg set pgtit=ptit,pgtyp=ptyp,pgloc=ploc,pglndmrk=plndmrk,pgadd=padd,pgrnt=prnt,pgrntfor=prntfor,
pgscrty=pscrty,pgocrg=pocrg,pgnofseats=pnoseats,pgavlfrm=pavlfrm,pgdsc=pdsc,pgnoper=pnoper,
pgfursts=pfursts,pgdelsts=pdelsts,pgmntcrg=pmntcrg,pgmntcrgfor=pmntcrgfor  where pgcod=pcod;
end$$

DROP PROCEDURE IF EXISTS `updatePropertyDeleteStatus`$$
CREATE   PROCEDURE `updatePropertyDeleteStatus` (IN `cod` INT, IN `typ` VARCHAR(2), IN `sts` INT)  NO SQL
begin
if typ = 'P' then
 update tbpg set IsDeleted=sts where pgcod=cod;
elseif typ = 'H' then
 update tbhus set IsDeleted=sts where huscod=cod;
elseif typ = 'C' then
 update tbcp set IsDeleted=sts where cpcod=cod;
elseif typ = 'F' then
 update tbflo set IsDeleted=sts where flocod=cod;

end if ;
end$$

DROP PROCEDURE IF EXISTS `updatePropertyIndexStatus`$$
CREATE   PROCEDURE `updatePropertyIndexStatus` (IN `cod` INT, IN `typ` VARCHAR(2), IN `sts` INT)  NO SQL
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
CREATE   PROCEDURE `updatePropertyStatus` (IN `cod` INT, IN `typ` VARCHAR(2), IN `sts` INT)  NO SQL
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
CREATE   PROCEDURE `UpdateUserProfile` (IN `pcod` INT, IN `pnam` VARCHAR(50), IN `padd` VARCHAR(100), IN `pcmp` VARCHAR(50), IN `ppic` VARCHAR(50))  NO SQL
begin
update tbprf set prfnam=pnam,prfadd=padd,prfcmp=pcmp,prfpic=ppic where prfcod=pcod;
end$$

DROP PROCEDURE IF EXISTS `updateUserStatus`$$
CREATE   PROCEDURE `updateUserStatus` (IN `cod` INT, IN `status` INT)  NO SQL
BEGIN
update tbprf set IsActive=status where prfcod=cod;
END$$

DROP PROCEDURE IF EXISTS `updcat`$$
CREATE   PROCEDURE `updcat` (IN `ccod` INT, IN `cnam` VARCHAR(100))  NO SQL
begin
update tbcat set catnam=cnam where catcod=ccod;
end$$

DROP PROCEDURE IF EXISTS `updfac`$$
CREATE   PROCEDURE `updfac` (IN `ccod` INT, IN `facnam` VARCHAR(100), IN `factyp` CHAR(1))  NO SQL
begin
update tbpgfac set pgfacnam=facnam,pgfactyp=factyp where pgfaccod=ccod;
end$$

DROP PROCEDURE IF EXISTS `updreg`$$
CREATE   PROCEDURE `updreg` (IN `rcod` INT, IN `reml` VARCHAR(50), IN `rpwd` VARCHAR(50), IN `rdat` DATETIME, IN `rrol` CHAR(1))  NO SQL
begin
update tbreg set regeml=reml,regpwd=rpwd,regdat=rdat,regrol=rrol where regcod=rcod;
end$$

DROP PROCEDURE IF EXISTS `updsubcat`$$
CREATE   PROCEDURE `updsubcat` (IN `sccod` INT, IN `scnam` VARCHAR(100), IN `scccod` INT)  NO SQL
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactform`
--

INSERT INTO `contactform` (`Name`, `Email`, `Subject`, `Message`, `Date`, `IsDeleted`, `ContactFormId`) VALUES
('preet', 'preet.dhindsa@hormail.com', 'test subject', 'test message', '2017-08-09', 0, 1),
('Helly', 'helly@gmail.com', 'test hai g', 'test message is here', '2017-08-10', 0, 2),
('asas', 'Abcs@gmail.com', 'asasas', 'asasas', '2017-08-10', 0, 3),
('sdsdsd', 'helly@gmail.com', 'sdsd', 'sdsds', '2017-08-10', 0, 4),
('preet12345', 'preet12345@gmail.com', 'preet', 'test hai g ', '2017-10-25', 0, 5);

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
  `IsActive` tinyint(1) NOT NULL DEFAULT '1',
  `ShowTOCustomer` tinyint(1) NOT NULL DEFAULT '0',
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cpcod`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbcp`
--

INSERT INTO `tbcp` (`cpcod`, `cptyp`, `cploc`, `cplndmrk`, `cpadd`, `cppwshrm`, `cpppentry`, `cpflono`, `cptotflo`, `cptotarecov`, `cprdfac`, `cprnt`, `cprntfor`, `cpmntcrg`, `cpmntcrgfor`, `cpocry`, `cpavlfrm`, `cpageofcnst`, `cpdsc`, `cpregcod`, `cppubsts`, `cpregdat`, `cpdelsts`, `cplat`, `cplong`, `cpscrty`, `cpareunit`, `cpfursts`, `IsActive`, `ShowTOCustomer`, `IsDeleted`) VALUES
(10, 'O', 33, 'Near TDI City', 'Sector 125 mohali', 'Y', 'Y', 3, 7, 7676, 67767, 677, 'Q', 6767, 'M', 6767, '2017-06-06', 15, 'desc Updated hai g', 4, 'P', '2015-10-13', 'Y', '40.714398', '-74.005279', 6767, 'sqr-m', 'S', 1, 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=latin1;

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
(38, 1, 43, 'P'),
(39, 2, 43, 'P'),
(40, 3, 43, 'P'),
(41, 4, 43, 'P'),
(42, 5, 43, 'P'),
(43, 6, 43, 'P'),
(44, 7, 43, 'P'),
(45, 8, 43, 'P'),
(46, 10, 43, 'P'),
(50, 20, 9, 'H'),
(51, 21, 9, 'H'),
(52, 22, 9, 'H'),
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
(81, 3, 55, 'P'),
(82, 1, 45, 'P'),
(83, 3, 45, 'P'),
(84, 5, 45, 'P'),
(85, 7, 45, 'P'),
(86, 1, 46, 'P'),
(87, 3, 46, 'P'),
(88, 5, 46, 'P'),
(89, 7, 46, 'P'),
(94, 1, 44, 'P'),
(95, 3, 44, 'P'),
(100, 12, 3, 'F'),
(101, 14, 3, 'F'),
(102, 16, 3, 'F'),
(103, 18, 3, 'F'),
(106, 24, 10, 'C'),
(107, 26, 10, 'C'),
(111, 20, 8, 'H'),
(112, 21, 8, 'H'),
(113, 22, 8, 'H'),
(114, 1, 48, 'P'),
(115, 3, 48, 'P'),
(116, 5, 48, 'P'),
(117, 1, 49, 'P'),
(118, 3, 49, 'P'),
(119, 1, 50, 'P'),
(120, 3, 50, 'P'),
(121, 1, 51, 'P'),
(122, 3, 51, 'P'),
(123, 5, 52, 'P'),
(124, 7, 52, 'P'),
(125, 1, 53, 'P'),
(126, 3, 53, 'P'),
(127, 1, 54, 'P'),
(128, 3, 54, 'P'),
(129, 5, 54, 'P'),
(130, 1, 55, 'P'),
(131, 3, 55, 'P'),
(132, 1, 56, 'P'),
(133, 3, 56, 'P'),
(134, 1, 57, 'P'),
(135, 3, 57, 'P'),
(136, 1, 58, 'P'),
(137, 3, 58, 'P'),
(138, 1, 59, 'P'),
(139, 3, 59, 'P'),
(140, 1, 60, 'P'),
(141, 3, 60, 'P');

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
  `IsActive` tinyint(1) DEFAULT '1',
  `ShowTOCustomer` tinyint(1) DEFAULT '0',
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`flocod`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbflo`
--

INSERT INTO `tbflo` (`flocod`, `flofor`, `floloc`, `flolndmrk`, `floadd`, `flobdrm`, `flobthrm`, `floblcny`, `floktchn`, `flolvrm`, `flofursts`, `floflono`, `floflotot`, `flornt`, `florntfor`, `floocrg`, `floscrty`, `flomntcrg`, `flomntcrgfor`, `flosts`, `floregcod`, `floavlfrm`, `flodsc`, `flodelsts`, `flolat`, `flolong`, `flototarea`, `floareunts`, `floregdat`, `IsActive`, `ShowTOCustomer`, `IsDeleted`) VALUES
(1, 'd', 33, 'rwer', 'werwe', 3, 4, 3, 'f', 'f', 'f', 3, 45, 34, '3', 34, 343, 34, '3', 'v', 3, '2015-09-01', '434fdfd', 'f', '3434', '3443dff', 34, 'fdsfdsf', '2015-09-22', 1, 0, 0),
(2, 'G', 39, 'land mark hai ', '148/7 sector 126 greater mohali', 2, 4, 3, 'N', 'N', 'F', 3, 8, 454, 'Q', 4545, 4545, 54545, '0', 'P', 4, '0000-00-00', 'this is very good floor . at best location. this is front facing to garden . with vip number like 2343. this is very good awsson. you may like , get his is humbel request please get this floor . we need to go abroar for 3 years . please take this pg . otersise we ,. need come one oter to take care of this pg . please taje . we will be vewry yjank full you yu . yhanks love you.', 'Y', '40.714398', '-74.005279', 45, 'bigha', '2015-10-12', 1, 0, 0),
(3, 'B', 35, 'czxcxz', 'czxcxzc', 2, 3, 1, 'N', 'N', 'S', 2, 9, 43434, 'Y', 5665, 54454, 565656, '', 'P', 4, '2017-06-06', 'This is proper floor description  u[pdated ', 'Y', '40.714398', '-74.005279', 34343, 'bigha', '2015-10-12', 1, 0, 0);

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
  `IsActive` tinyint(1) NOT NULL DEFAULT '1',
  `ShowTOCustomer` tinyint(1) NOT NULL DEFAULT '0',
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`huscod`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbhus`
--

INSERT INTO `tbhus` (`huscod`, `husfor`, `husloc`, `huslndmrk`, `husadd`, `husbdrm`, `husbtnrm`, `husblcny`, `huslby`, `huslvrm`, `huskitchen`, `husfursts`, `hustotare`, `husrnt`, `husrntfor`, `husscrty`, `husmntcrg`, `husmntcryfor`, `husocrg`, `husavlfrm`, `husdsc`, `huspubsts`, `husregcod`, `husdelsts`, `huslat`, `huslong`, `husareunit`, `husstrybuit`, `husregdat`, `IsActive`, `ShowTOCustomer`, `IsDeleted`) VALUES
(8, 'F', 36, 'hgfhgfh', 'hgfhgfh', 3, 3, 2, 'N', 'N', 3, 'F', 232323, 233, 'Y', 323, 3232, 'Q', 2323, '2017-06-06', 'Final property description is here', 'P', 4, 'Y', '40.714398', '-74.005279', 'sqr-m', 2, '2015-10-26', 1, 0, 0),
(9, 'F', 36, 'hgfhgfh', 'hgfhgfh', 3, 3, 2, 'Y', 'N', 3, 'F', 232323, 233, 'Y', 323, 3232, 'Q', 2323, '0000-00-00', 'tjhgdfhdgf<br>gfhgfhgfh<br>gfhgfhgf<br>hgfhgfh<br>gfhgfhgf<br>hgfhgf<br>hgfh<br>gfh<br>gfh<br>gf<br>', 'P', 26, 'Y', '40.714398', '-74.005279', 'sqr-m', 5, '2015-10-26', 1, 1, 0);

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
  `IsActive` tinyint(1) NOT NULL DEFAULT '1',
  `ShowTOCustomer` tinyint(1) NOT NULL DEFAULT '0',
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pgcod`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbpg`
--

INSERT INTO `tbpg` (`pgcod`, `pgtit`, `pgtyp`, `pgloc`, `pglndmrk`, `pgadd`, `pgrnt`, `pgrntfor`, `pgscrty`, `pgocrg`, `pgnofseats`, `pgavlfrm`, `pgdsc`, `pgsts`, `pgregcod`, `pgnoper`, `pgfursts`, `pgdelsts`, `pglat`, `pglog`, `pgmntcrg`, `pgmntcrgfor`, `pgregdat`, `IsActive`, `ShowTOCustomer`, `IsDeleted`) VALUES
(43, 'pg for girls', 'G', 33, 'pta', 'uni', 1234, 'M', 123, 343, 15, '0000-00-00', 'descrip tion is here   wekjfwfbewkjbfkewjdbfkjewfbkjwebfkjwefbewkjfbkjewfbewjbfjxwbfjhebjebjewfbjewhbfjewbfewkjbfkjwefwkefoiwefh4ufwrkcbwvsemanbckw jhfbwefbewiu efeiufhiu hiufhewiu rjfbriufhf jfbi34ufhe djf ref3riufh3rwiufhierfhirefherfbej cv jrevkjerverivb', 'Y', 26, 3, 'F', 'Y', '40.714398', '-74.005279', 2323, '2', '2015-10-26', 1, 1, 0),
(44, 'preet pg1551234r', 'B', 34, 'near Sandhu Daily', '# 60-c professor colony opp Punjabi University patiala', 3223, 'Q', 3232, 2323, 15, '2017-08-07', 'this is very good pg . at best location. this is front faccing to garden . with viip number like 2343. this is very goiod awsson. you may like , gthis is humbel request please get this pg . we need to go abroar for 3 years . please take this pg . otersise we ,. need come one oter to take care of this pg . please taje . we will be vewry yjank full you yu . yhanks love you.', 'Y', 4, 7, 'U', 'Y', '40.714398', '-74.005279', 32323, 'O', '2015-11-12', 0, 1, 1),
(47, 'del test 1', 'B', 34, 'landmark', 'pta add', 34, 'M', 32, 67, 4, '2017-10-08', 'this test dswcription', 'Y', 4, 3, 'F', 'Y', '23', '23', 67, 'Q', '2017-10-08', 1, 0, 0),
(48, 'test PG ', 'B', 36, 'pta', 'patiala', 2334, 'M', 334, 3, 12, '2017-10-18', 'description', 'Y', 50, 2, 'F', 'Y', '40.714398', '-74.005279', 3333, 'M', '2017-10-21', 1, 0, 0),
(49, 'test 1221', 'B', 36, 'pta', 'chd', 234, 'M', 54, 6565, 3, '2017-10-10', 'sddsdsd', 'Y', 50, 3, 'F', 'Y', '40.714398', '-74.005279', 111, 'M', '2017-10-21', 1, 0, 0),
(50, 'test titel', 'B', 36, 'ds', 'dsw', 5000, 'Q', 4000, 3000, 12, '2017-10-12', 'test description', 'Y', 50, 3, 'S', 'Y', '40.714398', '-74.005279', 2000, 'Y', '2017-10-24', 1, 0, 0),
(51, 'PG test', 'B', 36, 'chd', 'patiala', 15000, 'Y', 12000, 2000, 14, '2017-10-23', 'test description', 'Y', 50, 3, 'F', 'Y', '40.714398', '-74.005279', 2000, 'O', '2017-10-24', 1, 0, 0),
(52, 'PG title', 'B', 36, 'chd', 'chd', 16000, 'Q', 15000, 14000, 12, '2017-10-11', 'descriptiontestd&nbsp;', 'Y', 50, 4, 'S', 'N', '40.714398', '-74.005279', 13000, 'Y', '2017-10-24', 1, 0, 0),
(53, 'test PG 25', 'B', 36, 'chd', 'patiala', 12000, 'Q', 53222, 45900, 13, '2017-10-15', 'description hai g&nbsp;', 'Y', 50, 3, 'F', 'Y', '40.714398', '-74.005279', 234555, 'M', '2017-10-25', 1, 0, 0),
(54, 'title', 'G', 36, 'dsdsds', 'sdsdds', 34555600, 'Q', 5, 432, 13, '2017-10-24', 'sdsdsdsds', 'Y', 50, 2, 'F', 'Y', '40.714398', '-74.005279', 322222, 'M', '2017-10-25', 1, 0, 0),
(55, 'final title', 'B', 36, 'sdsds', 'sdsd', 23000, 'Q', 343, 33, 12, '2017-10-10', 'sdsdsdsds', 'Y', 50, 3, 'F', 'N', '40.714398', '-74.005279', 234, 'Q', '2017-10-25', 1, 0, 0),
(56, 'Title', 'B', 34, 'sdsdsd', 'sdsds', 234555, 'Q', 4, 4, 12, '2017-10-16', 'sdsdsdsdsd', 'Y', 50, 3, 'S', 'N', '40.714398', '-74.005279', 3, 'Q', '2017-10-25', 1, 0, 0),
(57, 'test PG ', 'G', 36, 'landmark', 'address', 11000, 'Y', 122333, 22222, 15, '2017-10-17', 'this is description test', 'Y', 50, 7, 'S', 'N', '40.714398', '-74.005279', 23333, 'Q', '2017-10-25', 1, 0, 0),
(58, 'test property', 'B', 36, 'wewewe', 'wewe', 2544, 'M', 4, 4, 11, '2017-11-21', 'ewewew', 'Y', 4, 2, 'S', 'N', '40.714398', '-74.005279', 13, 'M', '2017-11-09', 1, 0, 0),
(59, 'preet pg 21', 'B', 36, 'eqeq', 'qeqeqe', 4444440, 'M', 55555, 44, 15, '2017-11-07', 'eqeqeqeqe', 'Y', 4, 8, 'F', 'N', '40.714398', '-74.005279', 1054, 'M', '2017-11-09', 1, 0, 0),
(60, 'preet pg 21', 'B', 36, 'eqeq', 'qeqeqe', 4444440, 'M', 55555, 44, 15, '2017-11-07', 'eqeqeqeqe', 'Y', 4, 8, 'F', 'N', '40.714398', '-74.005279', 1054, 'M', '2017-11-09', 1, 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbpgpic`
--

INSERT INTO `tbpgpic` (`pgpiccod`, `pgpicfil`, `pgpicdsc`, `pgpicpgcod`, `pgpictyp`) VALUES
(24, '.jpg', 'this is pg description', 43, 'P'),
(25, '.jpg', 'this is pg description', 43, 'P'),
(26, '.jpg', 'this is pg description', 8, 'H'),
(30, '.jpg', 'this is pg description', 45, 'P'),
(31, '.png', 'this is pg description', 46, 'P'),
(33, '.png', 'this is pg description', 0, 'N'),
(34, '.png', 'this is pg description', 0, 'N'),
(35, '.png', 'this is pg description', 0, 'N'),
(36, '.png', 'this is pg description', 0, 'N'),
(37, '.png', 'this is pg description', 0, 'N'),
(38, '.png', 'this is pg description', 49, 'P'),
(39, '.png', 'this is pg description', 52, 'P'),
(40, '.png', 'this is pg description', 55, 'P'),
(44, '.jpg', 'this is pg description', 44, 'P'),
(45, '.jpg', 'Pg pic is updated', 44, 'P'),
(46, '.jpg', 'Pg pic is updated', 44, 'P'),
(47, '.jpg', 'Pg pic is updated', 3, 'F'),
(50, '.jpg', 'Pg pic is updated', 10, 'C'),
(51, '.jpg', 'Pg pic is updated', 2, 'F');

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbprf`
--

INSERT INTO `tbprf` (`prfcod`, `prfnam`, `prfphn`, `prftyp`, `prfregcod`, `prfadd`, `prfcmp`, `prfpic`, `IsActive`, `Otp`, `IsOtpApproved`, `prfLocation`) VALUES
(19, 'preetinder Singh', '9501516800', 'B', 4, 'dfguyhgtrvfcdxs', 'help', '.png', 1, 8352, 0, 36),
(21, 'Admin ', '9878161852', 'O', 11, 'Patiala', 'Admin', '.jpg', 1, 2614, 1, 36),
(22, 'abhushan', '9465209952', 'O', 50, 'fgfgffg', 'dfdf', '.jpeg', 0, 4751, 1, 33),
(23, 'arshdeep', '7986364130', 'O', 51, 'chd', 'arsh.com', '.png', 1, 5218, 1, 36);

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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbreg`
--

INSERT INTO `tbreg` (`regcod`, `regeml`, `regpwd`, `regdat`, `regrol`) VALUES
(4, 'preet@gmail.com', 'indercssoft', '2015-07-15 00:00:00', 'U'),
(11, 'admin@property.com', '930836', '2015-05-05 00:00:00', 'A'),
(50, 'anhushan@gmail.com', 'abc123#', '2017-06-10 00:00:00', 'U'),
(51, 'preet.dhindsa@hotmail.com', 'arsh123#', '2017-10-21 00:00:00', 'U');

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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbuseralerts`
--

INSERT INTO `tbuseralerts` (`UserAlertsId`, `PropertyType`, `Location`, `UserId`) VALUES
(1, 'P', 23, 4),
(18, 'P', 36, 51),
(17, 'P', 36, 4),
(13, 'C', 37, 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
