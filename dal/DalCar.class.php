<?php
/**
 * Dal层代码
 *
 * @author liyan
 * @since 2015 1 20
 */
class DalCar extends BaseDalEx {

    protected static function defaultDB() {
        return DBJDY;
    }

    public static function getAllCarBrands() {
        $sql = "SELECT *
                FROM car_brand
                ORDER BY pinyin";
        return self::rs2array($sql);
    }

    public static function addCarBrand($brandname) {
        $arrIns = array(
            'brandname' => $brandname,
            );
        return self::doInsert('car_brand', $arrIns);
    }

    public static function updateCarBrand($bid, $brandname) {
        DAssert::assertNumeric($bid);
        $arrUpd = array(
            'brandname' => $brandname,
            );
        $where = "bid=$bid";
        return self::doUpdate('car_brand', $arrUpd, $where, 1);
    }

    public static function getCarBrand($bid) {
        DAssert::assertNumeric($bid);
        $sql = "SELECT *
                FROM car_brand
                WHERE bid=$bid";
        return self::rs2rowline($sql);
    }

    public static function getCarSeries($bid) {
        DAssert::assertNumeric($bid);
        $sql = "SELECT *
                FROM car_series
                WHERE bid=$bid";
        return self::rs2array($sql);
    }

    public static function addCarSeries($bid, $seriesname) {
        DAssert::assertNumeric($bid);
        $arrIns = array(
            'seriesname' => $seriesname,
            'bid' => $bid,
            );
        return self::doInsert('car_series', $arrIns);
    }

    public static function updateCarSeries($sid, $bid, $seriesname) {
        DAssert::assertNumeric($bid);
        $arrUpd = array(
            'seriesname' => $seriesname,
            'bid' => $bid,
            );
        $where = "sid=$sid";
        return self::doUpdate('car_series', $arrUpd, $where, 1);
    }

    public static function getCarSeriesInfo($sid) {
        DAssert::assertNumeric($sid);
        $sql = "SELECT *
                FROM car_series AS s
                INNER JOIN car_brand AS b ON b.bid=s.bid
                WHERE s.sid=$sid";
        return self::rs2rowline($sql);
    }

    public static function getCarSpecs($sid) {
        DAssert::assertNumeric($sid);
        $sql = "SELECT *
                FROM car_spec
                WHERE sid=$sid";
        return self::rs2array($sql);
    }

    public static function addCarSpec($sid, $specname) {
        DAssert::assertNumeric($sid);
        $arrIns = array(
            'specname' => $specname,
            'sid' => $sid,
            );
        return self::doInsert('car_spec', $arrIns);
    }

    public static function updateCarSpec($spid, $sid, $specname) {
        DAssert::assertNumeric($sid);
        DAssert::assertNumeric($spid);
        $arrUpd = array(
            'specname' => $specname,
            'sid' => $sid,
            );
        $where = "spid=$spid";
        return self::doUpdate('car_spec', $arrUpd, $where, 1);
    }

    public static function getCarInfoBySpid($spid) {
        DAssert::assertNumeric($spid);
        $sql = "SELECT sp.spid, b.brandname, s.seriesname, sp.specname, b.bid, s.sid
                FROM car_spec AS sp
                INNER JOIN car_series AS s ON s.sid=sp.sid
                INNER JOIN car_brand AS b ON b.bid=s.bid
                WHERE sp.spid=$spid";
        return self::rs2rowline($sql);
    }

}