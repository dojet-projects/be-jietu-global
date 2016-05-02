<?php
/**
 * description
 *
 * Filename: LibOrder.class.php
 *
 * @author liyan
 * @since 2015 2 1
 */
class LibOrder {

    public static function updateOrderNo($oid, $openid) {
        $no = DalOrder::getNextOrderNo();
        $no = sprintf("N%'011d", $no);
        return DalOrder::updateOrderNo($oid, $openid, $no);
    }

}

