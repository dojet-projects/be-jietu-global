<?php
/**
 * Dal层代码
 *
 * @author liyan
 * @since 2015 1 26
 */
class DalCart extends BaseDalEx {

    protected static function defaultDB() {
        return DBJDY;
    }

    public static function clearCartForOpenId($openid) {
        self::realEscapeString($openid);
        $sql = "DELETE FROM cart
                WHERE openid='$openid'";
        return self::doDelete($sql);
    }

    public static function addCart($openid, $serviceid, $fittings, $tag) {
        $strFittings = serialize($fittings);
        $arrIns = array(
            'openid' => $openid,
            'serviceid' => $serviceid,
            'fittings' => $strFittings,
            'tag' => $tag,
            );
        return self::doInsert('cart', $arrIns);
    }

    public static function getUserCart($openid) {
        self::realEscapeString($openid);
        $sql = "SELECT *
                FROM cart
                WHERE openid='$openid'";
        return self::rs2array($sql);
    }

    public static function getPackage($openid) {
        self::realEscapeString($openid);
        $sql = "SELECT serviceid, fittings
                FROM cart
                WHERE openid='$openid'";
        return self::rs2array($sql);
    }

}