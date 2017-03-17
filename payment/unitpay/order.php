<?php


if(empty($GLOBALS['SysValue'])) exit(header("Location: /"));


// ��������������� ����������
$public_key = $SysValue['unitpay']['public_key'];
$secret_key = $SysValue['unitpay']['secret_key'];


// ��������� ��������
/*$mrh_ouid = explode("-", $_POST['ouid']);
$inv_id = $mrh_ouid[0]."".$mrh_ouid[1];     //����� �����*/
$id = $_POST['ouid'];

// �������� �������
$inv_desc  = "PHPShopPaymentService";

// ����� �������
$out_summ  = number_format($GLOBALS['SysValue']['other']['total'], 2, '.', '');

// ��� ������ � ������
$mnt_currency = $GLOBALS['PHPShopSystem']->getDefaultValutaIso();

// ���������� �������
$PHPShopCart = new PHPShopCart();

/**
 * ������ ������ ������� �������
 */
function cartpaymentdetails($val) {
     $dis=$val['uid']."  ".$val['name']." (".$val['num']." ��. * ".$val['price'].") -- ".$val['total']."
";

    return $dis;
}

// ����� HTML �������� � ������� ��� ������
$disp= '
<div align="center">
<p>
������� ����� ������ <b>Unitpay</b> � ��� ������� �����.
</p>
 <p><br></p>
 
<form method="GET" name="pay" id="pay" action="https://unitpay.ru/pay/' . $public_key . '">
    <input type="hidden" name="account" value="'.$id.'">
    <input type="hidden" name="sum" value="'.$out_summ.'">
    <input type="hidden" name="currency" value="'.$mnt_currency.'">
    <input type=hidden name="desc" value="'.iconv('windows-1251','utf-8',$PHPShopCart->display('cartpaymentdetails')).'">
        <table><tr><td><img src="images/shop/icon-client-new.gif"  width="16" height="16" border="0" align="left"><a href="javascript:pay.submit();">�������� ����� ��������� �������</a></td></tr></table>
</form>
</div>';

?>