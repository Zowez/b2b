<?php include 'inc/header.php'; ?>
<div class="uk-offcanvas-content">
    <?php include 'inc/topbar.php'; ?>
    <main>
        <section class="uk-section uk-section-small">
            <div class="uk-container">
                <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                    <div>
                        <div class="uk-grid-medium" uk-grid>
                            <section class="uk-width-1-1 uk-width-expand@m">
                                <article class="uk-card uk-card-default uk-card-small uk-card-body uk-article tm-ignore-container">
                                    <div class="uk-child-width-1-1 uk-child-width-1-2@s uk-margin-top" uk-grid>
                                        <section class="uk-width-1-1">
                                            <h2 class="uk-text-center">Bayi Giriş</h2>
                                            <form>
                                                <div class="uk-grid-small uk-child-width-1-1" uk-grid>
                                                    <div><label>
                                                            <div class="uk-form-label uk-form-label-required">Name</div><input class="uk-input" type="text" required>
                                                        </label></div>
                                                    <div><label>
                                                            <div class="uk-form-label uk-form-label-required">Email</div><input class="uk-input" type="email" required>
                                                        </label></div>
                                                    <div><label>
                                                            <div class="uk-form-label">Topic</div><select class="uk-select">
                                                                <option>Customer service</option>
                                                                <option>Tech support</option>
                                                                <option>Other</option>
                                                            </select>
                                                        </label></div>
                                                    <div><label>
                                                            <div class="uk-form-label">Message</div><textarea class="uk-textarea" rows="5"></textarea>
                                                        </label></div>
                                                    <div class="uk-text-center"><button class="uk-button uk-button-primary">Send</button></div>
                                                </div>
                                            </form>
                                        </section>
                                    </div>
                                </article>
                            </section>
                            <section class="uk-width-1-1 uk-width-expand@m">
                                <article class="uk-card uk-card-default uk-card-small uk-card-body uk-article tm-ignore-container">
                                    <div class="uk-child-width-1-1 uk-child-width-1-2@s uk-margin-top" uk-grid>
                                        <section class="uk-width-1-1">
                                            <h2 class="uk-text-center">Bayi Kayıt</h2>
                                            <form action="" method="POST" onsubmit="return false;" id="seller-register-form">
                                                <div class="uk-grid-small uk-child-width-1-1" uk-grid>
                                                    <div>
                                                        <input class="uk-input" placeholder="Bayi Adı" name="name" type="text" required>
                                                    </div>
                                                    <div>
                                                        <input class="uk-input" placeholder="Bayi Email" name="mail" type="email" required>
                                                    </div>
                                                    <div>
                                                        <input class="uk-input" placeholder="Bayi Şifresi" name="password" type="password" required>
                                                    </div>
                                                    <div>
                                                        <input class="uk-input" placeholder="Bayi Şifresi Tekrar" name="confirm_password" type="password" required>
                                                    </div>
                                                    <div>
                                                        <input class="uk-input" placeholder="Bayi Telefon" name="phone" type="number" required>
                                                    </div>
                                                    <div>
                                                        <input class="uk-input" placeholder="Bayi Vergi No" name="tax_number" type="text" required>
                                                    </div>
                                                    <div>
                                                        <input class="uk-input" placeholder="Bayi Vergi Dairesi" name="tax_office" type="text" required>
                                                    </div>
                                                    <div class="uk-text-center"><button id="registerSeller" onclick="registerSeller()" class="uk-button uk-button-primary">Kayıt Ol</button></div>
                                                </div>
                                            </form>
                                        </section>
                                    </div>
                                </article>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="uk-section uk-section-default uk-section-small">
            <div class="uk-container">
                <div uk-slider>
                    <ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-5@m uk-grid">
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