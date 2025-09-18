<?php

require_once '../system/function.php';

if (@$_SESSION['login'] != @sha1(md5(IP() . $seller_code))) {
    go(site);
}


if ($_POST) {



    $seller_name  = post('name');
    $seller_phone = post('phone');
    $seller_fax = post('fax');
    $seller_site = post('site');
    $seller_tax_number = post('tax_number');
    $seller_tax_office = post('tax_office');


    if (!$seller_name || !$seller_phone || !$seller_tax_number || !$seller_tax_office) {

        echo 'empty';
    } else {




        $already = $db->prepare("SELECT code FROM sellers WHERE code!=:c");
        $already->execute([':c' => $seller_code]);
        if ($already->rowCount()) {
            echo 'already';
        } else {

            $result = $db->prepare("UPDATE sellers SET

                        name     =:seller_name,
                        phone    =:seller_phone,
                        fax      =:seller_fax,
                        site     =:seller_site,
                        tax_number =:seller_tax_number,
                        tax_office =:seller_tax_office WHERE code=:seller_code AND id=:id

                    ");

            $result->execute([

                ':seller_name' => $seller_name,
                ':seller_phone' => $seller_phone,
                ':seller_fax' => $seller_fax,
                ':seller_site' => $seller_site,
                ':seller_tax_number' => $seller_tax_number,
                ':seller_tax_office'   => $seller_tax_office,
                ':seller_code' => $seller_code,
                ':id' => $seller_id
            ]);

            if ($result->rowCount()) {
                echo 'ok';
            } else {
                echo 'error';
            }
        }
    }
}
