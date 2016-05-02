<?php
/**
 * Dal层代码
 *
 * @author liyan
 * @since 2015 1 26
 */
class DalOrder extends BaseDalEx {

    protected static function defaultDB() {
        return DBJDY;
    }

    public static function addOrder($openid, $price, $orderdate, $ordertime, $contact, $tel, $city, $district, $range, $address, $car_spec, $car_license, $package, $memo) {
        $arrIns = array(
            'openid' => $openid,
            'price' => $price,
            'order_date' => $orderdate,
            'order_time' => $ordertime,
            'contact' => $contact,
            'tel' => $tel,
            'city' => $city,
            'district' => $district,
            'range' => $range,
            'address' => $address,
            'car_spec' => $car_spec,
            'car_license' => $car_license,
            'package' => $package,
            'memo' => $memo,
            'createtime' => time(),
            );
        return self::doInsert('orders', $arrIns);
    }

    public static function getOrder($oid) {
        DAssert::assertNumeric($oid);
        $sql = "SELECT *
                FROM orders
                WHERE oid=$oid";
        return self::rs2rowline($sql);
    }

    public static function getOrderList($openid, $status) {
        self::realEscapeString($openid);
        self::realEscapeString($status);
        $sql = "SELECT *
                FROM orders
                WHERE openid='$openid' AND status='$status'
                ORDER BY createtime DESC";
        return self::rs2array($sql);
    }

    public static function getMyOrderList($openid, $ps, $pn) {
        DAssert::assertNumeric($ps);
        DAssert::assertNumeric($pn);
        self::realEscapeString($openid);
        $sql = "SELECT *
                FROM orders
                WHERE openid='$openid'
                ORDER BY createtime DESC
                LIMIT $ps, $pn";
        return self::rs2array($sql);
    }

    public static function getAllOrderList($status) {
        self::realEscapeString($status);
        $sql = "SELECT *
                FROM orders
                WHERE status='$status'
                ORDER BY createtime DESC";
        return self::rs2array($sql);
    }

    public static function updateOrderNo($oid, $openid, $no) {
        DAssert::assertNumeric($oid);
        self::realEscapeString($openid);
        $arrUpd = array(
            'order_no' => $no,
            );
        $where = "oid=$oid AND openid='$openid'";
        self::doUpdate('orders', $arrUpd, $where, 1);
    }

    public static function getNextOrderNo() {
        $arrIns = array(
            'createtime' => time()
            );
        self::doInsert('order_no', $arrIns);
        return self::insertID();
    }

    public static function updateOrderStatus($oid, $status) {
        DAssert::assertNumeric($oid);
        self::realEscapeString($status);
        $arrUpd = array(
            'status' => $status,
            );
        $where = "oid=$oid";
        return self::doUpdate('orders', $arrUpd, $where, 1);
    }

}