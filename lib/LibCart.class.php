<?php
/**
 * description
 *
 * Filename: LibCart.class.php
 *
 * @author liyan
 * @since 2015 1 29
 */
class LibCart {

    public static function getUserCart($openid) {
        $arrCart = DalCart::getUserCart($openid);
        foreach ($arrCart as &$cart) {
            $cart['fittings'] = unserialize($cart['fittings']);
        }
        unset($cart);
        return $arrCart;
    }

    public static function getPackage($openid) {
        $arrCart = DalCart::getPackage($openid);
        foreach ($arrCart as &$cart) {
            $cart['fittings'] = unserialize($cart['fittings']);
        }
        unset($cart);
        return json_encode($arrCart);
    }

}

