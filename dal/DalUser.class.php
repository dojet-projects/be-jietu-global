<?php
/**
 * Dal层代码
 *
 * @author liyan
 * @since 2015 1 21
 */
class DalUser extends BaseDalEx {

    protected static function defaultDB() {
        return DBJDY;
    }

    public static function addUser($openid) {
        $arrIns = array(
            'openid' => $openid,
            );
        return self::doInsert('users', $arrIns);
    }

    public static function getUserByOpenID($openid) {
        self::realEscapeString($openid);
        $sql = "SELECT *
                FROM users
                WHERE openid='$openid'";
        return self::rs2rowline($sql);
    }

    public static function updateUserLastSPID($openid, $spid) {
        DAssert::assertNumeric($spid);
        self::realEscapeString($openid);
        $arrIns = array(
            'openid' => $openid,
            'last_car_spid' => $spid,
            );
        $arrUpd = array(
            'last_car_spid' => $spid
            );
        return self::doInsertUpdate('users', $arrIns, $arrUpd);
    }

    public static function updateUserLastLicense($openid, $license) {
        self::realEscapeString($openid);
        self::realEscapeString($license);
        $arrIns = array(
            'openid' => $openid,
            'last_license' => $license,
            );
        $arrUpd = array(
            'last_license' => $license
            );
        return self::doInsertUpdate('users', $arrIns, $arrUpd);
    }

    public static function updateUserLastAddress($openid, $address) {
        self::realEscapeString($openid);
        self::realEscapeString($address);
        $arrIns = array(
            'openid' => $openid,
            'last_address' => $address,
            );
        $arrUpd = array(
            'last_address' => $address
            );
        return self::doInsertUpdate('users', $arrIns, $arrUpd);
    }

    public static function updateUserinfo($openid, $city, $district, $range, $address, $fullname, $gender, $tel, $license) {
        self::realEscapeString($city);
        self::realEscapeString($district);
        self::realEscapeString($openid);
        self::realEscapeString($fullname);
        self::realEscapeString($address);
        self::realEscapeString($tel);
        self::realEscapeString($gender);
        self::realEscapeString($license);
        $arrIns = array(
            'openid' => $openid,
            'city' => $city,
            'district' => $district,
            'range' => $range,
            'address' => $address,
            'fullname' => $fullname,
            'gender' => $gender,
            'tel' => $tel,
            'last_license' => $license,
            );
        $arrUpd = array(
            'city' => $city,
            'district' => $district,
            'range' => $range,
            'address' => $address,
            'fullname' => $fullname,
            'gender' => $gender,
            'tel' => $tel,
            'last_license' => $license,
            );
        $where = "openid='$openid'";
        // return self::doInsertUpdate('users', $arrIns, $arrUpd);
        return self::doUpdate('users', $arrUpd, $where, 1);
    }

    public static function getUserLicense($openid) {
        self::realEscapeString($openid);
        $sql = "SELECT *
                FROM user_license
                WHERE openid='$openid'";
        return self::rs2array($sql);
    }

    public static function addUserLicense($openid, $license) {
        self::realEscapeString($openid);
        self::realEscapeString($license);
        $arrIns = array(
            'openid' => $openid,
            'license' => $license,
            'lastupdate' => time(),
            );
        $arrUpd = array(
            'lastupdate' => time(),
            );
        return self::doInsertUpdate('user_license', $arrIns, $arrUpd);
    }

}