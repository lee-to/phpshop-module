<?php

function unitpay_users_repay($obj, $PHPShopOrderFunction) {
    global $PHPShopBase, $SysValue;

    // ��������������� ����������
    $public_key = $SysValue['unitpay']['public_key'];
    $secret_key = $SysValue['unitpay']['secret_key'];


    // ��������� ��������
    /*$mrh_ouid = explode("-", $PHPShopOrderFunction->objRow['uid']);
    $inv_id = $mrh_ouid[0] . "" . $mrh_ouid[1];     //����� �����*/
    $id = $PHPShopOrderFunction->objRow['uid'];

    // ����� �������
    $out_summ  = number_format($PHPShopOrderFunction->getTotal(), 2, '.', '');
    
    // ��� ������ � ������
    $mnt_currency = $GLOBALS['PHPShopSystem']->getDefaultValutaIso();

    // ���������� �������
    $PHPShopCart = new PHPShopCart();

    /**
     * ������ ������ ������� �������
     */
    function cartpaymentdetails($val) {
        $dis = $val['uid'] . "  " . $val['name'] . " (" . $val['num'] . " ��. * " . $val['price'] . ") -- " . $val['total'] . "
";

        return $dis;
    }

    // ���� ����� �� �������
    if ($PHPShopOrderFunction->getParam('statusi') != 101)
        $disp = '<form method="GET" name="pay" id="pay" action="https://unitpay.ru/pay/' . $public_key . '">
    <input type="hidden" name="account" value="'.$id.'">
    <input type="hidden" name="sum" value="'.$out_summ.'">
    <input type="hidden" name="currency" value="'.$mnt_currency.'">
    <input type=hidden name="desc" value="'.iconv('windows-1251','utf-8',$PHPShopCart->display('cartpaymentdetails')).'">
	<a href="javascript:void(0)" class=b title="' . __('��������') . ' ' . $PHPShopOrderFunction->getOplataMetodName() . '" onclick="javascript:pay.submit();" >
            <img src="images/shop/coins.gif" alt="��������" width="16" height="16" border="0" align="absmiddle"  hspace=5>' .
                $PHPShopOrderFunction->getOplataMetodName() . "</a></form>";
    else
        $disp = PHPShopText::b($PHPShopOrderFunction->getOplataMetodName());

    return $disp;
}

?>