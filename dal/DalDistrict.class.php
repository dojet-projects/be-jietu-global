<?php
/**
 * Dal层代码
 *
 * @author liyan
 * @since 2015 1 29
 */
class DalDistrict extends BaseDalEx {

    protected static function defaultDB() {
        return DBJDY;
    }

    public static function getDistricts($upid) {
        DAssert::assertNumeric($upid);
        $sql = "SELECT *
                FROM district
                WHERE upid=$upid AND avail=1
                ORDER BY displayorder";
        return self::rs2array($sql);
    }

}