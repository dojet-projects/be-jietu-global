<?php
/**
 * Dal层代码
 *
 * @author liyan
 * @since 2015 1 20
 */
class DalService extends BaseDalEx {

    protected static function defaultDB() {
        return DBJDY;
    }

    public static function getServiceList($ps, $pn) {
        DAssert::assertNumeric($ps);
        DAssert::assertNumeric($pn);
        $sql = "SELECT *
                FROM service
                ORDER BY sortorder
                LIMIT $ps, $pn";
        return self::rs2array($sql);
    }

    public static function getService($sid) {
        DAssert::assertNumeric($sid);
        $sql = "SELECT *
                FROM service
                WHERE sid=$sid";
        return self::rs2rowline($sql);
    }

    public static function getDefaultServiceFittings($sid) {
        DAssert::assertNumeric($sid);
        $sql = "SELECT f.*
                FROM service_fitting AS sf
                INNER JOIN fitting AS f ON f.fid=sf.fid
                INNER JOIN fitting_type AS ft ON ft.ftid=f.ftid
                WHERE sf.sid=$sid";
        return self::rs2keyarray($sql, 'ftid');
    }

    public static function getServiceFittings($serviceid, $spid) {
        DAssert::assertNumeric($serviceid);
        DAssert::assertNumeric($spid);
        $sql = "SELECT ft.typename, f.fname, scf.*, ft.ftid
                FROM service_car_fitting AS scf
                INNER JOIN fitting AS f ON f.fid=scf.fid
                INNER JOIN fitting_type AS ft ON ft.ftid=f.ftid
                WHERE scf.serviceid=$serviceid AND scf.spid IN ($spid, -1)";
        return self::rs2grouparray($sql, 'ftid', 'fid');
    }

    public static function getServiceFittingTypes($serviceid, $spid) {
        DAssert::assertNumeric($serviceid);
        DAssert::assertNumeric($spid);
        $sql = "SELECT ft.*
                FROM service_car_fitting AS scf
                INNER JOIN fitting AS f ON f.fid=scf.fid
                INNER JOIN fitting_type AS ft ON ft.ftid=f.ftid
                WHERE scf.serviceid=$serviceid AND scf.spid IN ($spid, -1)";
        return self::rs2keyarray($sql, 'ftid');
    }

    public static function getFittingFullinfo($scfid) {
        DAssert::assertNumeric($scfid);
        $sql = "SELECT *
                FROM `service_car_fitting` AS scf
                INNER JOIN fitting AS f ON f.fid=scf.fid
                INNER JOIN fitting_type AS t ON f.ftid=t.ftid
                WHERE scf.scfid=$scfid";
        return self::rs2rowline($sql);
    }

    public static function getMultiFittingFullInfo($arrScfids) {
        DAssert::assertNumericArray($arrScfids);
        if (empty($arrScfids)) {
            return array();
        }
        $strIds = join(',', $arrScfids);
        $sql = "SELECT *
                FROM `service_car_fitting` AS scf
                INNER JOIN fitting AS f ON f.fid=scf.fid
                INNER JOIN fitting_type AS t ON f.ftid=t.ftid
                WHERE scf.scfid IN ($strIds)";
        return self::rs2keyarray($sql, 'scfid');
    }

}