<?php include 'inc/header.php';


if (@$_SESSION['login'] != @sha1(md5(IP() . $_SESSION['code']))) {
    go(site);
}

?>
<?php
$orders = $db->prepare("SELECT * FROM orders INNER JOIN order_statuses ON order_statuses.code = orders.status WHERE orders.seller = :s");
$orders->execute(['s' => $seller_code]);

$addresses = $db->prepare("SELECT * FROM seller_addresses WHERE seller = :s");
$addresses->execute(['s' => $seller_code]);

$bank_transfers = $db->prepare("SELECT * FROM bank_transfers WHERE seller = :s");
$bank_transfers->execute(['s' => $seller_code]);

$process = get('process', '');
?>
<div class="uk-offcanvas-content">
    <?php include 'inc/topbar.php'; ?>
    <main>
        <section class="uk-section uk-section-small">
            <div class="uk-container">
                <div class="uk-grid-medium" uk-grid>
                    <div class="uk-width-1-1 uk-width-1-4@m tm-aside-column">
                        <div class="uk-card uk-card-default uk-card-small tm-ignore-container"
                            uk-sticky="offset: 90; bottom: true; media: @m;">
                            <div class="uk-card-header">
                                <div class="uk-grid-small uk-child-width-1-1" uk-grid>
                                    <section>
                                        <div
                                            class="uk-width-1-3 uk-width-1-4@s uk-width-1-2@m uk-margin-auto uk-visible-toggle uk-position-relative uk-border-circle uk-overflow-hidden uk-light">
                                            <img class="uk-width-1-1" src="<?php echo site . "upload/customer/" . $seller_logo; ?>"><a
                                                class="uk-link-reset uk-overlay-primary uk-position-cover uk-hidden-hover"
                                                href="<?php echo site . "profile.php?process=logo"; ?>">
                                                <div class="uk-position-center"><span
                                                        uk-icon="icon: camera; ratio: 1.25;"></span></div>
                                            </a>
                                        </div>
                                    </section>
                                    <div class="uk-text-center">
                                        <div class="uk-h4 uk-margin-remove"><?php echo $seller_name; ?></div>
                                        <div class="uk-text-meta"><?php echo dt($seller_date); ?> Tarihinde Katıldı</div>
                                    </div>
                                    <div>
                                        <div class="uk-grid-small uk-flex-center" uk-grid>
                                            <div><a class="uk-button uk-button-default uk-button-small"
                                                    href="<?php echo site . "profile.php?process=settings"; ?>"><span class="uk-margin-xsmall-right"
                                                        uk-icon="icon: cog; ratio: .75;"></span><span>Ayarlar</span></a>
                                            </div>
                                            <div><button class="uk-button uk-button-default uk-button-small"
                                                    href="logout.php" title="Log out"><span
                                                        uk-icon="icon: sign-out; ratio: .75;"></span></button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <nav>
                                    <ul class="uk-nav uk-nav-default tm-nav">
                                        <li class="<?php echo $process == 'order' ? 'uk-active' : ''; ?>"><a href="<?php echo site . "profile.php?process=order"; ?>">Siparişlerim
                                                <span>(<?php echo $orders->rowCount(); ?>)</span></a></li>

                                        <li class="<?php echo $process == 'address' ? 'uk-active' : ''; ?>"><a href="<?php echo site . "profile.php?process=address"; ?>">Adreslerim
                                                <span>(<?php echo $addresses->rowCount(); ?>)</span></a></li>
                                        <li class="<?php echo $process == 'bank_transfers' ? 'uk-active' : ''; ?>"><a href="<?php echo site . "profile.php?process=bank_transfers"; ?>">Havale Bildirimlerim
                                                <span>(<?php echo $bank_transfers->rowCount(); ?>)</span></a></li>
                                        <li class="<?php echo $process == 'profile' ? 'uk-active' : ''; ?>"><a href="<?php echo site . "profile.php?process=profile"; ?>">Kişisel Bilgilerim</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <?php

                    switch ($process) {
                        case 'profile':
                    ?>
                            <div class="uk-width-1-1 uk-width-expand@m">
                                <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                    <header class="uk-card-header">
                                        <h1 class="uk-h2">Profil Bilgileri</h1>
                                    </header>
                                    <div class="uk-card-body">
                                        <form class="uk-form-stacked" action="#" method="POST" onsubmit="return false;" id="accountform">
                                            <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                                                <fieldset class="uk-fieldset">
                                                    <div class="uk-width-1-1">
                                                        <label>
                                                            <div class="uk-form-label">Bayi Kodu:</div>
                                                            <input class="uk-input" type="text" value="<?php echo $seller_code; ?>" disabled>
                                                        </label>
                                                    </div>
                                                    <div class="uk-width-1-1">
                                                        <label>
                                                            <div class="uk-form-label">Bayi Adı:</div>
                                                            <input class="uk-input" type="text" value="<?php echo $seller_name; ?>" name="name" id="name">
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <label>
                                                            <div class="uk-form-label">Telefon:</div>
                                                            <input class="uk-input" type="text" value="<?php echo $seller_phone; ?>" name="phone" id="phone">
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <label>
                                                            <div class="uk-form-label">Fax:</div>
                                                            <input class="uk-input" type="text" value="<?php echo $seller_fax; ?>" name="fax" id="fax">
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <label>
                                                            <div class="uk-form-label">Vergi No:</div>
                                                            <input class="uk-input" type="text" value="<?php echo $seller_tax_number; ?>" name="tax_number" id="tax_number">
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <label>
                                                            <div class="uk-form-label">Vergi Dairesi:</div>
                                                            <input class="uk-input" type="text" value="<?php echo $seller_tax_office; ?>" name="tax_office" id="tax_office">
                                                        </label>
                                                    </div>
                                                    <div class="uk-width-1-1">
                                                        <label>
                                                            <div class="uk-form-label">Bayi Web Sitesi:</div>
                                                            <input class="uk-input" type="text" value="<?php echo $seller_site; ?>" name="site" id="site">
                                                        </label>
                                                    </div>
                                                </fieldset>

                                            </div>
                                        </form>
                                    </div>
                                    <div class="uk-card-footer uk-text-center"><button type="submit" onclick="accountupdate();" id="accountbtn"
                                            class="uk-button uk-button-primary">Kaydet</button></div>
                                </div>
                            </div>
                        <?php
                            break;
                        case 'address':
                        ?>
                            <div class="uk-width-1-1 uk-width-expand@m">
                                <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                    <header class="uk-card-header">
                                        <h1 class="uk-h2 uk-flex uk-flex-middle">
                                            Adreslerim
                                            <a href="<?php echo site . "profile.php?process=address_add"; ?>" class="uk-button uk-button-default uk-button-small uk-margin-left">Yeni Adres Ekle</a>
                                        </h1>
                                    </header>
                                    <?php
                                    if ($addresses->rowCount() == 0) {
                                        echo alert("Henüz adresiniz yok.", "warning");
                                    } else {
                                        foreach ($addresses as $address) { ?>
                                            <section class="uk-card-body">
                                                <h3 class="uk-flex uk-flex-middle uk-flex-between">
                                                    <a class="uk-link-heading" href="#">
                                                        #<?php echo $address['id']; ?>
                                                    </a>
                                                    <span>
                                                        <a href="<?php echo site . "profile.php?process=address_edit&id=" . $address['id']; ?>" class="uk-icon-button uk-margin-small-right" uk-icon="pencil" title="Düzenle"></a>
                                                        <a href="<?php echo site . "profile.php?process=address_delete&id=" . $address['id']; ?>" class="uk-icon-button uk-text-danger" uk-icon="trash" title="Sil" onclick="return confirm('Bu adresi silmek istediğinize emin misiniz?');"></a>
                                                    </span>
                                                </h3>
                                                <table
                                                    class="uk-table uk-table-small uk-table-justify uk-table-responsive uk-table-divider uk-margin-small-top uk-margin-remove-bottom">
                                                    <tbody>
                                                        <tr>
                                                            <th class="uk-width-medium">Başlık</th>
                                                            <td><?php echo $address['title']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Açık Adres</th>
                                                            <td><?php echo $address['directions']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Durum</th>
                                                            <td><span class="uk-label <?php echo $address['status'] == '1' ? 'uk-label-success' : 'uk-label-danger'; ?>"><?php echo $address['status'] == '1' ? 'Aktif' : 'Pasif'; ?></span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </section>
                                    <?php }
                                    }

                                    ?>
                                </div>
                            </div>
                        <?php
                            break;
                        case 'bank_transfers':
                        ?>
                            <div class="uk-width-1-1 uk-width-expand@m">
                                <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                    <header class="uk-card-header">
                                        <h1 class="uk-h2 uk-flex uk-flex-middle">
                                            Havale Bildirimlerim
                                            <a href="<?php echo site . "profile.php?process=banktransfersadd"; ?>" class="uk-button uk-button-default uk-button-small uk-margin-left">Yeni Havale Bildirimi Ekle</a>
                                        </h1>
                                    </header>
                                    <?php
                                    if ($bank_transfers->rowCount() == 0) {
                                        echo alert("Henüz havale bildiriminiz yok.", "warning");
                                    } else {
                                        foreach ($bank_transfers as $transfer) { ?>
                                            <section class="uk-card-body">
                                                <h3><a class="uk-link-heading" href="#">#<?php echo $transfer['id']; ?></a>
                                                </h3>
                                                <table
                                                    class="uk-table uk-table-small uk-table-justify uk-table-responsive uk-table-divider uk-margin-small-top uk-margin-remove-bottom">
                                                    <tbody>
                                                        <tr>
                                                            <th class="uk-width-medium">Tarih</th>
                                                            <td><?php echo $transfer['date']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Tutar</th>
                                                            <td><?php echo $transfer['amount']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Banka</th>
                                                            <td><?php echo $transfer['bank']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Not</th>
                                                            <td><?php echo $transfer['description']; ?></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </section>
                                    <?php }
                                    }

                                    ?>
                                </div>
                            </div>
                        <?php
                            break;
                        case 'order':
                        ?> <div class="uk-width-1-1 uk-width-expand@m">
                                <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                    <header class="uk-card-header">
                                        <h1 class="uk-h2">Siparişler</h1>
                                    </header>
                                    <?php
                                    if ($orders->rowCount() == 0) {
                                        echo alert("Henüz siparişiniz yok.", "warning");
                                    } else {
                                        foreach ($orders as $order) { ?>
                                            <section class="uk-card-body">
                                                <h3><a class="uk-link-heading" href="#">#<?php echo $order['code']; ?></a>
                                                    <span class="uk-text-muted uk-text-small"><?php echo dt($order['date']) . '' . $order['time']; ?></span></a>
                                                </h3>
                                                <table
                                                    class="uk-table uk-table-small uk-table-justify uk-table-responsive uk-table-divider uk-margin-small-top uk-margin-remove-bottom">
                                                    <tbody>
                                                        <tr>
                                                            <th class="uk-width-medium">Ödeme Yöntemi</th>
                                                            <td><?php echo $order['payment'] == 1 ? 'Havale' : 'Kredi Kartı'; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Tutar</th>
                                                            <td><?php echo $order['amount']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="uk-width-medium">Durum</th>
                                                            <td><span class="uk-label <?php echo $order['title'] == 'Teslim Edildi' ? 'uk-label-success' : ($order['title'] == 'İptal Edildi' ? 'uk-label-danger' : 'uk-label-warning'); ?>"><?php echo $order['title']; ?></span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </section>
                                    <?php }
                                    }

                                    ?>
                                </div>
                            </div>
                        <?php
                            break;
                        case 'settings':
                        ?>
                            <div class="uk-width-1-1 uk-width-expand@m uk-grid-margin uk-first-column">
                                <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                    <header class="uk-card-header">
                                        <h1 class="uk-h2">Ayarlar</h1>
                                    </header>
                                    <div class="uk-card-body">
                                        <form class="uk-form-stacked" action="" method="POST" onsubmit="return false;"
                                            id="settingsform">
                                            <div class="uk-grid-medium uk-child-width-1-1 uk-grid uk-grid-stack" uk-grid="">
                                                <fieldset class="uk-fieldset uk-first-column">
                                                    <legend class="uk-h4">E-Posta</legend>
                                                    <div class="uk-grid-small uk-child-width-1-1 uk-grid uk-grid-stack" uk-grid="">
                                                        <div class="uk-first-column">
                                                            <label>
                                                                <div class="uk-form-label">Mevcut E-Posta</div>
                                                                <input class="uk-input uk-form-width-large" type="email" value="<?php echo $seller_email; ?>" disabled="">
                                                            </label>
                                                        </div>
                                                        <div class="uk-grid-margin uk-first-column">
                                                            <label>
                                                                <div class="uk-form-label">Yeni E-Posta</div>
                                                                <input class="uk-input uk-form-width-large" type="email" name="email" id="email">
                                                            </label>
                                                        </div>
                                                        <div class="uk-grid-margin uk-first-column">
                                                            <button class="uk-button uk-button-primary" type="submit" onclick="updateSettings()" id="update-settings-button">E-Postayı Güncelle</button>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="uk-fieldset uk-grid-margin uk-first-column">
                                                    <legend class="uk-h4">Şifre</legend>
                                                    <div class="uk-grid-small uk-child-width-1-1 uk-grid uk-grid-stack" uk-grid="">
                                                        <div class="uk-first-column">
                                                            <label>
                                                                <div class="uk-form-label">Mevcut Şifre</div>
                                                                <input class="uk-input uk-form-width-large" type="password" name="current_password" id="current_password">
                                                            </label>
                                                        </div>
                                                        <div class="uk-grid-margin uk-first-column">
                                                            <label>
                                                                <div class="uk-form-label">Yeni Şifre</div>
                                                                <input class="uk-input uk-form-width-large" type="password" name="password" id="password">
                                                            </label>
                                                        </div>
                                                        <div class="uk-grid-margin uk-first-column">
                                                            <label>
                                                                <div class="uk-form-label">Yeni Şifre (Tekrar)</div>
                                                                <input class="uk-input uk-form-width-large" type="password" name="confirm_password" id="confirm_password">
                                                            </label>
                                                        </div>
                                                        <div class="uk-grid-margin uk-first-column">
                                                            <button class="uk-button uk-button-primary" type="submit" onclick="updateSettings()" id="update-settings-button">Şifreyi Güncelle</button>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                            break;

                        case 'address_delete':
                            $id = get('id');
                            if (!$id) {
                                go(site);
                            }

                            $query = $db->prepare("SELECT * FROM seller_addresses
                            WHERE seller=:s AND id=:id");
                            $query->execute([':s' => $seller_code, ':id' => $id]);

                            if ($query->rowCount()) {

                                $delete = $db->prepare("UPDATE seller_addresses SET status=:st WHERE seller=:s AND id=:id");
                                $delete->execute([':st' => 2, ':s' => $seller_code, ':id' => $id]);
                                if ($delete) {
                                    alert("Adres pasife alındı", "success");
                                    go(site . "/profile.php?process=address", 2);
                                } else {
                                    alert("Hata oluştu", "danger");
                                }
                            } else {
                                go(site);
                            }
                            break;
                        ?>
                            <?php
                        case 'address_edit':
                            $id = get('id');
                            if (!$id) {
                                go(site);
                            }

                            $query = $db->prepare("SELECT * FROM seller_addresses
                            WHERE seller=:s AND id=:id");
                            $query->execute([':s' => $seller_code, ':id' => $id]);

                            if ($query->rowCount()) {

                                $row = $query->fetch(PDO::FETCH_ASSOC);
                            ?>
                                <div class="uk-width-1-1 uk-width-expand@m">
                                    <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                        <header class="uk-card-header">
                                            <h1 class="uk-h2">Adres Düzenle</h1>
                                        </header>
                                        <div class="uk-card-body">
                                            <form class="uk-form-stacked" action="#" method="POST" onsubmit="return false;" id="addressform">
                                                <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                                                    <fieldset class="uk-fieldset">
                                                        <input type="hidden" name="addressid" id="addressid" value="<?php echo $row['id']; ?>">
                                                        <div class="uk-width-1-1">
                                                            <label>
                                                                <div class="uk-form-label">Adres Başlık:</div>
                                                                <input class="uk-input" type="text" value="<?php echo $row['title']; ?>" name="title" id="title">
                                                            </label>
                                                        </div>
                                                        <div class="uk-width-1-1">
                                                            <label>
                                                                <div class="uk-form-label">Adres Tarifi:</div>
                                                                <input class="uk-input" type="text" value="<?php echo $row['directions']; ?>" name="directions" id="directions ">
                                                            </label>
                                                        </div>
                                                        <div class="uk-width-1-1">
                                                            <label class="uk-form-label" for="status">Adres Durumu:</label>
                                                            <div class="uk-form-controls">
                                                                <select class="uk-select uk-border-rounded uk-box-shadow-small" name="status" id="status">
                                                                    <option value="1" <?php echo $row['status'] == '1' ? 'selected' : ''; ?>>Aktif</option>
                                                                    <option value="2" <?php echo $row['status'] == '2' ? 'selected' : ''; ?>>Pasif</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </fieldset>

                                                </div>
                                            </form>
                                        </div>
                                        <div class="uk-card-footer uk-text-center"><button type="submit" onclick="addressbtn();" id="addressbutton"
                                                class="uk-button uk-button-primary">Kaydet</button></div>
                                    </div>
                                </div>
                            <?php

                            } else {
                                go(site);
                            }
                            ?>
                        <?php
                            break;
                        case 'address_add': ?>
                            <div class="uk-width-1-1 uk-width-expand@m">
                                <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                    <header class="uk-card-header">
                                        <h1 class="uk-h2">Adres Ekle</h1>
                                    </header>
                                    <div class="uk-card-body">
                                        <form class="uk-form-stacked" action="#" method="POST" onsubmit="return false;" id="addressaddform">
                                            <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                                                <fieldset class="uk-fieldset">
                                                    <div class="uk-width-1-1">
                                                        <label>
                                                            <div class="uk-form-label">Adres Başlık:</div>
                                                            <input class="uk-input" type="text" placeholder="Adres Başlığı" name="title" id="title">
                                                        </label>
                                                    </div>
                                                    <div class="uk-width-1-1">
                                                        <label>
                                                            <div class="uk-form-label">Adres Tarifi:</div>
                                                            <input class="uk-input" type="text" placeholder="Adres Tarifi" name="directions" id="directions">
                                                        </label>
                                                    </div>
                                                    <div class="uk-width-1-1">
                                                        <label class="uk-form-label" for="status">Adres Durumu:</label>
                                                        <div class="uk-form-controls">
                                                            <select class="uk-select uk-border-rounded uk-box-shadow-small" name="status" id="status">
                                                                <option value="1">Aktif</option>
                                                                <option value="2">Pasif</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </fieldset>

                                            </div>
                                        </form>
                                    </div>
                                    <div class="uk-card-footer uk-text-center"><button type="submit" onclick="addressaddbtn();" id="addressaddbutton"
                                            class="uk-button uk-button-primary">Kaydet</button></div>
                                </div>
                            </div>

                        <?php
                            break;
                        case 'banktransfersadd':
                        ?>
                            <div class="uk-width-1-1 uk-width-expand@m">
                                <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                    <header class="uk-card-header">
                                        <h1 class="uk-h2">Havale Bildirimi Ekle</h1>
                                    </header>
                                    <div class="uk-card-body">
                                        <form class="uk-form-stacked" action="#" method="POST" onsubmit="return false;" id="banktransfersaddform">
                                            <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                                                <fieldset class="uk-fieldset">
                                                    <div class="uk-width-1-1">
                                                        <label class="uk-form-label">Banka:</label>
                                                        <div class="uk-form-controls">
                                                            <select class="uk-select uk-border-rounded uk-box-shadow-small" name="bank" id="bank">
                                                                <option value="0" readonly>Banka Seçiniz</option>
                                                                <?php
                                                                $banks = $db->prepare("SELECT * FROM banks WHERE status=:st");
                                                                $banks->execute([':st' => 1]);
                                                                if ($banks->rowCount()) {
                                                                    foreach ($banks as $bank) {
                                                                ?>
                                                                        <option value="<?php echo $bank['id']; ?>"><?php echo $bank['name']; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid-small uk-child-width-1-2" uk-grid>
                                                        <div>
                                                            <label>
                                                                <div class="uk-form-label">Havale Tarihi:</div>
                                                                <input class="uk-input" type="date" placeholder="Havale Tarihi" name="transfer_date" id="transfer_date">
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <label>
                                                                <div class="uk-form-label">Havale Saati:</div>
                                                                <input class="uk-input" type="time" placeholder="Havale Saati" name="time" id="time">
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="uk-width-1-1">
                                                        <label>
                                                            <div class="uk-form-label">Havale Tutarı:</div>
                                                            <input class="uk-input" type="number" placeholder="Havale Tutarı" name="amount" id="amount">
                                                        </label>
                                                    </div>

                                                    <div class="uk-width-1-1">
                                                        <label>
                                                            <div class="uk-form-label">Havale Açıklama:</div>
                                                            <textarea class="uk-input" placeholder="Havale Açıklama" name="description" id="description"></textarea>
                                                        </label>
                                                    </div>

                                                </fieldset>

                                            </div>
                                        </form>
                                    </div>
                                    <div class="uk-card-footer uk-text-center"><button type="submit" onclick="banktransfersaddbtn();" id="banktransfersaddbutton"
                                            class="uk-button uk-button-primary">Kaydet</button></div>
                                </div>
                            </div>
                        <?php
                            break;
                        case 'logo':
                            if (isset($_POST['logoupdate']) && isset($_FILES['logo']) && $_FILES['logo']['error'] === 0) {

                                require_once 'inc/class.upload.php';

                                $image = @new Upload($_FILES['logo']);

                                if ($image->uploaded) {

                                    $image_name = $seller_code . '-' . uniqid();
                                    $image->allowed = array('image/*');
                                    $image->image_convert = 'png';
                                    $image->file_new_name_body = $image_name;
                                    $image->process('upload/customer/');
                                    //$image->file_max_size = 1024 * 1024 * 5; // 5 MB

                                    if ($image->processed) {
                                        $update = $db->prepare("UPDATE sellers SET logo=:l WHERE code=:c");
                                        $update->execute([':l' => $image_name . '.png', ':c' => $seller_code]);
                                        if ($update) {
                                            alert("Logo başarıyla güncellendi", "success");
                                            go(site . "/profile.php?process=logo", 2);
                                        } else {
                                            alert("Hata oluştu", "danger");
                                        }
                                    } else {
                                        echo 'error: ' . $image->error;
                                    }
                                } else {
                                    alert("Resim seçmediniz!", "danger");
                                }
                            }

                        ?>
                            <div class="uk-width-1-1 uk-width-expand@m">
                                <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                    <header class="uk-card-header">
                                        <h1 class="uk-h2">Logo Değiştir</h1>
                                    </header>
                                    <div class="uk-card-body">
                                        <form class="uk-form-stacked" action="#" method="POST" enctype="multipart/form-data">
                                            <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                                                <fieldset class="uk-fieldset">
                                                    <div
                                                        class="uk-width-1-3 uk-width-1-4@s uk-width-1-2@m uk-margin-auto uk-visible-toggle uk-position-relative uk-border-circle uk-overflow-hidden uk-light">
                                                        <img class="uk-width-1-1" src="<?php echo site . "upload/customer/" . $seller_logo; ?>">
                                                    </div>
                                                    <br>
                                                    <div class="uk-width-1-1">
                                                        <input type="file" name="logo" id="logo">
                                                    </div>
                                                </fieldset>

                                            </div>
                                            <div class="uk-card-footer uk-text-center"><button type="submit" name="logoupdate"
                                                    class="uk-button uk-button-primary">Yükle</button></div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                    <?php
                            break;
                    }
                    ?>


                </div>
            </div>
        </section>
        <section class="uk-section uk-section-default uk-section-small">
            <div class="uk-container">
                <div uk-slider>
                    <ul
                        class="uk-slider-items uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-5@m uk-grid">
                        <li>
                            <div class="uk-grid-small uk-flex-center uk-flex-left@s" uk-grid>
                                <div><span uk-icon="icon: star; ratio: 2.5;"></span></div>
                                <div class="uk-text-center uk-text-left@s uk-width-expand@s">
                                    <div>Mauris placerat</div>
                                    <div class="uk-text-meta">Donec mollis nibh dolor, sit amet auctor</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-grid-small uk-flex-center uk-flex-left@s" uk-grid>
                                <div><span uk-icon="icon: receiver; ratio: 2.5;"></span></div>
                                <div class="uk-text-center uk-text-left@s uk-width-expand@s">
                                    <div>Lorem ipsum</div>
                                    <div class="uk-text-meta">Sit amet, consectetur adipiscing elit</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-grid-small uk-flex-center uk-flex-left@s" uk-grid>
                                <div><span uk-icon="icon: location; ratio: 2.5;"></span></div>
                                <div class="uk-text-center uk-text-left@s uk-width-expand@s">
                                    <div>Proin pharetra</div>
                                    <div class="uk-text-meta">Nec quam a fermentum ut viverra</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-grid-small uk-flex-center uk-flex-left@s" uk-grid>
                                <div><span uk-icon="icon: comments; ratio: 2.5;"></span></div>
                                <div class="uk-text-center uk-text-left@s uk-width-expand@s">
                                    <div>Praesent ultrices</div>
                                    <div class="uk-text-meta">Praesent ultrices, orci nec finibus</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-grid-small uk-flex-center uk-flex-left@s" uk-grid>
                                <div><span uk-icon="icon: happy; ratio: 2.5;"></span></div>
                                <div class="uk-text-center uk-text-left@s uk-width-expand@s">
                                    <div>Duis condimentum</div>
                                    <div class="uk-text-meta">Pellentesque eget varius arcu</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top"></ul>
                </div>
            </div>
        </section>
    </main>
    <?php include 'inc/footer.php'; ?>