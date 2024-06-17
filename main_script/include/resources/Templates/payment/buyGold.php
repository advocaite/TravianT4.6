<?php

use Core\Helper\WebService;

?>
<script type="text/javascript">
    function ShopUIV2() {
        this.allowSlidePackages = true;
        this.allowSlidePaymentMethods = true;
        this.goldPackagesPages = [];
        this.goldPackagesPagesSize = 0;
        this.paymentMethodsPages = [];
        this.paymentMethodsPageSize = 0;
        this.selectedPaymentMethod = false;
        this.rtl = false;
        this.initialize = function () {
            var b = this;
            if (jQuery(".paymentWizardDirectionRTL").length > 0) {
                this.rtl = true
            }
            b.slidingContentInnerPackage = jQuery("#packageSlider .slidingContentInner");
            b.slidingContentOuterPackage = jQuery("#packageSlider .slidingContentOuter");
            b.slidingContentOuterWidthPackage = parseInt(b.slidingContentOuterPackage.width());
            TweenLite.to(b.slidingContentInnerPackage, .5, {
                onComplete: function () {
                    b.allowSlidePackages = true
                }
            });
            b.slidingContentInnerPaymentMethods = jQuery("#paymentMethodsSlider .slidingContentInner");
            b.slidingContentOuterPaymentMethods = jQuery("#paymentMethodsSlider .slidingContentOuter");
            b.slidingContentOuterWidthPaymentMethods = parseInt(b.slidingContentOuterPaymentMethods.width());

            TweenLite.to(b.slidingContentInnerPaymentMethods, .5, {
                onComplete: function () {
                    b.allowSlidePaymentMethods = true
                }
            });

            var a = 0;
            jQuery("#packageSlider .productsPage").each(function (k, d) {
                b.goldPackagesPages[a] = d;
                if (b.goldPackagesPagesSize === 0) {
                    b.goldPackagesPagesSize = jQuery(d).width()
                }
                a++
            });
            b.initializePaymentMethods();
            setTimeout(function () {
                b.packageSliderButtonCheck();
                b.paymentMethodsSliderButtonCheck();
                b.bindEvents();
                b.updateResultBox();
                setTimeout(function () {
                    jQuery("#packageSlider .package.hideForLoading").removeClass("hideForLoading")
                }, 500)
            }, 250)
        };
        this.initializePaymentMethods = function () {
            var b = this;
            jQuery("#paymentMethodsSlider .loading").removeClass("hide");
            if (typeof jQuery(".package.selected input.goldProductId")[0] === "undefined") {
                return
            }
            var a = parseInt(jQuery(".package.selected input.goldProductId").val());
            jQuery("#paymentMethodsSlider .slidingContent").empty();
            b.updateResultBox();
            Travian.ajax({
                data: {cmd: "paymentProviders", selectedPackage: a}, onSuccess: function (d) {
                    if (typeof jQuery("#paymentMethodsSlider .slidingContent")[0] === "undefined") {
                        return false
                    }
                    jQuery("#paymentMethodsSlider .slidingContent").html(d.html);
                    if (!b.rtl) {
                        b.slidingContentInnerPaymentMethods.css("margin-left", 0)
                    } else {
                        b.slidingContentInnerPaymentMethods.css("margin-right", 0)
                    }
                    b.paymentMethodsPages = [];
                    b.paymentMethodsPageSize = 0;
                    var c = 0;
                    jQuery(".methodsPage").each(function (k, f) {
                        b.paymentMethodsPages[c] = f;
                        if (b.paymentMethodsPageSize == 0) {
                            b.paymentMethodsPageSize = jQuery(f).width()
                        }
                        c++
                    });
                    jQuery("#paymentMethodsSlider .methodItem").each(function (k, g) {
                        g = jQuery(g);
                        g.click(b.methodItemClickEvent);
                        if (b.selectedPaymentMethod !== false) {
                            if (parseInt(g.children().val()) == b.selectedPaymentMethod) {
                                jQuery("#paymentMethodsSlider .methodItem").removeClass("selected");
                                g.addClass("selected");
                                for (var e = 0; e < b.paymentMethodsPages.length; e++) {
                                    if (b.paymentMethodsPages[e] == g.parent()) {
                                        var f = e * b.paymentMethodsPageSize;
                                        if (f == 0) {
                                            f = 1
                                        }
                                        b.allowSlidePaymentMethods = false;
                                        jQuery("#paymentMethodsSlider .methodsPage").removeClass("visible").addClass("hidden");
                                        jQuery(b.paymentMethodsPages[e]).removeClass("hidden").addClass("visible");
                                        if (!g.rtl) {
                                            TweenLite.to(g.slidingContentInnerPaymentMethods, 0.5, {
                                                "margin-left": f * -1,
                                                onComplete: function () {
                                                    b.allowSlidePaymentMethods = true;
                                                }
                                            });
                                        } else {
                                            TweenLite.to(g.slidingContentInnerPaymentMethods, 0.5, {
                                                "margin-right": f * -1,
                                                onComplete: function () {
                                                    b.allowSlidePaymentMethods = true;
                                                }
                                            });
                                        }
                                        b.updateResultBox()
                                    }
                                }
                            }
                        }
                    });
                    b.paymentMethodsSliderButtonCheck();
                    jQuery("#paymentMethodsSlider .loading").addClass("hide")
                }
            })
        };
        this.packageSliderButtonCheck = function () {
            var a = this;
            if (typeof a.goldPackagesPages != "undefined") {
                if (jQuery(a.goldPackagesPages[0]).hasClass("visible")) {
                    if (!jQuery("#packageSlider .slideArea.area1").hasClass("inactive")) {
                        jQuery("#packageSlider .slideArea.area1").addClass("inactive")
                    }
                } else {
                    jQuery("#packageSlider .slideArea.area1").removeClass("inactive")
                }
                if (jQuery(a.goldPackagesPages[a.goldPackagesPages.length - 1]).hasClass("hidden")) {
                    if (jQuery("#packageSlider .slideArea.area2").hasClass("inactive")) {
                        jQuery("#packageSlider .slideArea.area2").removeClass("inactive")
                    }
                } else {
                    jQuery("#packageSlider .slideArea.area2").addClass("inactive")
                }
            }
        };
        this.paymentMethodsSliderButtonCheck = function () {
            var a = this;
            if (typeof a.paymentMethodsPages[0] != "undefined") {
                if (jQuery(a.paymentMethodsPages[0]).hasClass("visible")) {
                    if (!jQuery("#paymentMethodsSlider .slideArea.area1").hasClass("inactive")) {
                        jQuery("#paymentMethodsSlider .slideArea.area1").addClass("inactive")
                    }
                } else {
                    jQuery("#paymentMethodsSlider .slideArea.area1").removeClass("inactive")
                }
                if (jQuery(a.paymentMethodsPages[a.paymentMethodsPages.length - 1]).hasClass("hidden")) {
                    if (jQuery("#paymentMethodsSlider .slideArea.area2").hasClass("inactive")) {
                        jQuery("#paymentMethodsSlider .slideArea.area2").removeClass("inactive")
                    }
                } else {
                    jQuery("#paymentMethodsSlider .slideArea.area2").addClass("inactive")
                }
            }
        };
        this.bindEvents = function () {
            var a = this;
            jQuery("#packageSlider .slideArea.area1").click(function () {
                a.packageSlideLeft()
            });
            jQuery("#packageSlider .slideArea.area2").click(function () {
                a.packageSlideRight()
            });
            jQuery("#packageSlider .package").click(function () {
                d = jQuery(this);
                if (!d.hasClass("selected")) {
                    jQuery(".package").removeClass("selected");
                    d.addClass("selected");
                    a.initializePaymentMethods()
                }
            });
            jQuery("#phonePackages .package").click(function () {
                d = jQuery(this);
                if (!d.hasClass("selected")) {
                    jQuery(".package").removeClass("selected");
                    d.addClass("selected");
                    a.initializePaymentMethods()
                }
            });
            jQuery("#paymentMethodsSlider .slideArea.area1").click(function () {
                a.paymentMethodsSlideLeft()
            });
            jQuery("#paymentMethodsSlider .slideArea.area2").click(function () {
                a.paymentMethodsSlideRight()
            });
            jQuery("#paymentMethodsSlider .methodItem").click(a.methodItemClickEvent);
            jQuery("#paymentMethodsSlider").click(function () {
                a.updateResultBox();
                a.saveSelectedPaymentMethod()
            });
            jQuery("#overview .resultBox .activeButton").click(function () {
                a.buyNowAction()
            });
            jQuery(".buyGoldLocation").change(function () {
                a.changeLocation()
            });
            jQuery("#vouchers .package").click(function () {
                voucherPopup()
            });
            jQuery(window).one('shopUIV2RestorePreview', function () {
                jQuery("#paymentMethodsSlider .loading").removeClass("hide");
                jQuery("#packageSlider .slidingContentInner").html('');
                jQuery("#paymentMethodsSlider .slidingContentInner").html('');
                jQuery("#phonePackages .package").destroy();
                jQuery("#vouchers .package").destroy();
                jQuery("#packageSlider .slideArea > div").removeClass("active").addClass("inactive");
                jQuery("#paymentMethodsSlider .slideArea > div").removeClass("active").addClass("inactive");
                jQuery(".resultBox .goldUnits").html("");
                jQuery(".resultBox #goldBalanceNew").html("");
                jQuery(".resultBox #priceToPay").html("")
            });
        };
        this.methodItemClickEvent = function () {
            d = jQuery(this);
            if (!d.hasClass("inactive") && !d.hasClass("defect")) {
                jQuery("#paymentMethodsSlider .methodItem").removeClass("selected");
                d.addClass("selected")
            }
        };
        this.updateResultBox = function () {
            if (typeof jQuery(".package.selected .goldUnits")[0] === "undefined") {
                return
            }
            jQuery(".resultBox #packageGoldAmount .goldUnits").html(jQuery(".package.selected .goldUnits").html());
            jQuery(".resultBox #goldBalanceNew").html((parseInt(jQuery(".package.selected .goldUnits").html()) + parseInt(jQuery(".accountBalance span").html())));
            jQuery(".resultBox #priceToPay").html(jQuery(".package.selected .price").html());
            if (jQuery("#paymentMethodsSlider .methodItem.selected")[0]) {
                jQuery(".resultBox .inactiveButton").addClass("hide");
                jQuery(".resultBox .activeButton").removeClass("hide")
            } else {
                jQuery(".resultBox .activeButton").addClass("hide");
                jQuery(".resultBox .inactiveButton").removeClass("hide")
            }
        };
        this.saveSelectedPaymentMethod = function () {
            var a = this;
            if (jQuery("#paymentMethodsSlider .methodItem.selected")) {
                a.selectedPaymentMethod = parseInt(jQuery("#paymentMethodsSlider .methodItem.selected input.providerId").val())
            }
        };
        this.packageSlideLeft = function () {
            var g = this;
            if (g.allowSlidePackages) {
                var f = "";
                var a = "";
                var b = false;
                for (var c = g.goldPackagesPages.length - 1; c >= 0; c--) {
                    if (jQuery(g.goldPackagesPages[c]).hasClass("visible")) {
                        f = jQuery(g.goldPackagesPages[c]);
                        b = true
                    }
                    if (b && jQuery(g.goldPackagesPages[c]).hasClass("hidden")) {
                        a = jQuery(g.goldPackagesPages[c]);
                        break
                    }
                }
                if (a != "") {
                    var e = 0;
                    if (!g.rtl) {
                        e = g.slidingContentInnerPackage.css("margin-left")
                    } else {
                        e = g.slidingContentInnerPackage.css("margin-right")
                    }
                    e = parseInt(e.replace("px", ""));
                    var d = (e + g.goldPackagesPagesSize);
                    if (d == 0) {
                        d = 1
                    }
                    f.removeClass("visible").addClass("hidden");
                    a.removeClass("hidden").addClass("visible");
                    g.allowSlidePackages = false;

                    if (!g.rtl) {
                        TweenLite.to(g.slidingContentInnerPackage, 0.5, {
                            "margin-left": d,
                            onComplete: function () {
                                g.allowSlidePackages = true
                            }
                        });
                    } else {
                        TweenLite.to(g.slidingContentInnerPackage, 0.5, {
                            "margin-right": d,
                            onComplete: function () {
                                g.allowSlidePackages = true
                            }
                        });
                    }
                }
            }
            g.packageSliderButtonCheck()
        };
        this.packageSlideRight = function () {
            var g = this;
            if (g.allowSlidePackages) {
                var f = "";
                var a = "";
                var b = false;
                for (var c = 0; c < g.goldPackagesPages.length; c++) {
                    if (jQuery(g.goldPackagesPages[c]).hasClass("visible")) {
                        f = jQuery(g.goldPackagesPages[c]);
                        b = true
                    }
                    if (jQuery(g.goldPackagesPages[c]).hasClass("hidden")) {
                        if (b) {
                            a = jQuery(g.goldPackagesPages[c]);
                            break
                        }
                    }
                }
                if (a != "") {
                    var e = 0;
                    if (!g.rtl) {
                        e = g.slidingContentInnerPackage.css("margin-left")
                    } else {
                        e = g.slidingContentInnerPackage.css("margin-right")
                    }
                    e = parseInt(e.replace("px", "")) * -1;
                    var d = (e + g.goldPackagesPagesSize) * -1;
                    f.removeClass("visible").addClass("hidden");
                    a.removeClass("hidden").addClass("visible");
                    g.allowSlidePaymentMethods = false;
                    if (!g.rtl) {
                        TweenLite.to(g.slidingContentInnerPackage, 0.5, {
                            "margin-left": d,
                            onComplete: function () {
                                g.allowSlidePackages = true
                            }
                        });
                    } else {
                        TweenLite.to(g.slidingContentInnerPackage, 0.5, {
                            "margin-right": d,
                            onComplete: function () {
                                g.allowSlidePackages = true
                            }
                        });
                    }
                }
            }
            g.packageSliderButtonCheck()
        };
        this.paymentMethodsSlideLeft = function () {
            var g = this;
            if (g.allowSlidePaymentMethods) {
                var f = "";
                var a = "";
                var b = false;
                for (var c = g.paymentMethodsPages.length - 1; c >= 0; c--) {
                    if (jQuery(g.paymentMethodsPages[c]).hasClass("visible")) {
                        f = jQuery(g.paymentMethodsPages[c]);
                        b = true
                    }
                    if (b && jQuery(g.paymentMethodsPages[c]).hasClass("hidden")) {
                        a = jQuery(g.paymentMethodsPages[c]);
                        break
                    }
                }
                if (a != "") {
                    var e = 0;
                    if (!g.rtl) {
                        e = g.slidingContentInnerPaymentMethods.css("margin-left")
                    } else {
                        e = g.slidingContentInnerPaymentMethods.css("margin-right")
                    }
                    e = parseInt(e.replace("px", ""));
                    var d = (e + g.paymentMethodsPageSize);
                    if (d == 0) {
                        d = 1
                    }
                    f.removeClass("visible").addClass("hidden");
                    a.removeClass("hidden").addClass("visible");
                    g.allowSlidePaymentMethods = false;

                    if (!g.rtl) {
                        TweenLite.to(g.slidingContentInnerPaymentMethods, 0.5, {"margin-left": d});
                    } else {
                        TweenLite.to(g.slidingContentInnerPaymentMethods, 0.5, {"margin-right": d});
                    }
                }
            }
            g.paymentMethodsSliderButtonCheck()
        };
        this.paymentMethodsSlideRight = function () {
            var g = this;
            if (g.allowSlidePaymentMethods) {
                var f = "";
                var a = "";
                var b = false;
                for (var c = 0; c < g.paymentMethodsPages.length; c++) {
                    if (g.paymentMethodsPages[c].hasClass("visible")) {
                        f = g.paymentMethodsPages[c];
                        b = true
                    }
                    if (g.paymentMethodsPages[c].hasClass("hidden")) {
                        if (b) {
                            a = g.paymentMethodsPages[c];
                            break
                        }
                    }
                }
                if (a != "") {
                    var e = 0;
                    if (!g.rtl) {
                        e = g.slidingContentInnerPaymentMethods.css("margin-left")
                    } else {
                        e = g.slidingContentInnerPaymentMethods.css("margin-right")
                    }
                    e = parseInt(e.replace("px", "")) * -1;
                    var d = (e + g.paymentMethodsPageSize) * -1;
                    f.removeClass("visible").addClass("hidden");
                    a.removeClass("hidden").addClass("visible");
                    g.allowSlidePaymentMethods = false;
                    if (!g.rtl) {
                        TweenLite.to(g.slidingContentInnerPaymentMethods, 0.5, {"margin-left": d});
                    } else {
                        TweenLite.to(g.slidingContentInnerPaymentMethods, 0.5, {"margin-right": d});
                    }
                }
            }
            g.paymentMethodsSliderButtonCheck()
        };
        this.buyNowAction = function () {
            if (jQuery("#overview .resultBox .inactiveButton.hide")[0]) {
                var e = parseInt(jQuery(".package.selected input.goldProductId").val());
                var b = parseInt(jQuery("#paymentMethodsSlider .methodItem.selected input.providerId").val());
                var d = 800;
                var f = 600;
                if (jQuery("#paymentMethodsSlider .methodItem.selected input.popupWidth")[0]) {
                    d = jQuery("#paymentMethodsSlider .methodItem.selected input.popupWidth")[0]
                }
                if (jQuery("#paymentMethodsSlider .methodItem.selected input.popupHeight")[0]) {
                    f = jQuery("#paymentMethodsSlider .methodItem.selected input.popupHeight")[0]
                }
                var a = (screen.width - d) / 2;
                var c = (screen.height - f) / 2;
                window.open("/tgpay.php?product=" + e + "&provider=" + b, "tgpay", "scrollbars=yes,status=yes,resizable=yes,toolbar=yes,width=" + d + ",height=" + f + ",left=" + a + ",top=" + c)
            }
        };
        this.changeLocation = function () {
            var b = jQuery("select.buyGoldLocation").val();
            Travian.Game.PaymentWizardEventListener.PaymentWizardObject && Travian.Game.PaymentWizardEventListener.PaymentWizardObject.close();

            setTimeout(function(){
                jQuery(window).trigger("startPaymentWizard", {
                    data: {
                        cmd: "paymentWizard",
                        goldProductId: "",
                        goldProductLocation: b,
                        location: "",
                        activeTab: "buyGold",
                        formData: {}
                    }, onOpen: function () {
                    }
                })
            }, 1200);
        };
        this.selectPackage = function (e) {
            var d = this;
            var f = jQuery(".package input[value=" + e + "]")[0];
            e = f.parent();
            var a = e.getParent();
            if (a.id != "phonePackages") {
                if (a.hasClass("hidden")) {
                    for (var b = 0; b < d.goldPackagesPages.length; b++) {
                        if (d.goldPackagesPages[b] == a) {
                            var c = b * d.goldPackagesPagesSize;
                            if (c == 0) {
                                c = 1
                            }
                            d.allowSlidePackages = false;
                            jQuery("#packageSlider .productsPage").removeClass("visible").addClass("hidden");
                            d.goldPackagesPages[b].removeClass("hidden").addClass("visible");
                            if (!g.rtl) {
                                TweenLite.to(g.slidingContentInnerPackage, 0.5, {"margin-left": c * -1});
                            } else {
                                TweenLite.to(g.slidingContentInnerPackage, 0.5, {"margin-right": c * -1});
                            }
                        }
                    }
                }
            }
            jQuery(".package").removeClass("selected");
            e.addClass("selected")
        }
    }
</script>
<div class="buyGoldContent paymentWizardDirection<?= getDirection(); ?>">
    <div id="packageSlider"><h1><?= T("PaymentWizard", "Packages"); ?></h1>
        <div class="slideArea area1">
            <div class="arrowL inactive"></div>
        </div>
        <div class="slideArea area2">
            <div class="arrowR inactive"></div>
        </div>
        <div class="slidingContentOuter">
            <div class="slidingContentInner">
                <div class="slidingContent">
                    <?php
                    function addPackage($page, $size, $selectedGoldProductId, $goldProductId, $goldProductName, $goldProductGold, $goldProductPrice, $goldProductImageName)
                    {
                        $HTML = '<div class="package size' . $size . ' ' . ($selectedGoldProductId == $goldProductId || ($selectedGoldProductId <= 0 && $page == 1 && $size == 1) ? 'selected' : '') . ' hideForLoading" title="' . T("PaymentWizard",
                                "ChoosePackage") . '">';
                        $HTML .= '<input type="hidden" class="goldProductId" value="' . $goldProductId . '"/>';
                        $HTML .= '<div class="goldProductTextWrapper">';
                        $HTML .= '<div class="goldUnits">' . $goldProductGold . '</div>';
                        $HTML .= '<div class="goldUnitsTypeText">' . T("PaymentWizard", "Gold") . '</div>';
                        $HTML .= '<div class="footerLine"><span class="price">' . $goldProductPrice . '&nbsp;*</span></div>';
                        $HTML .= '</div>';
                        $HTML .= '<div class="goldProductImageWrapper">';
                        $HTML .= '<img src="' . WebService::getPaymentUrl() . 'img/product/' . $goldProductImageName . '" width="100" height="114" alt="' . $goldProductName . '"/>';
                        $HTML .= '</div>';
                        $HTML .= '</div>';
                        return $HTML;
                    }

                    $pages = [];
                    $size = $x = 0;
                    $page = 1;
                    $selectedPage = 1;
                    foreach ($vars['packages'] as $key => $value) {
                        ++$x;
                        $ex = explode(".", $value['goldProductPrice']);
                        $decimals = sizeof($ex) == 1 ? 0 : strlen($ex[1]);
                        $price = number_format($value['goldProductPrice'], $decimals, '.', ',');
                        $price = $price . ' ' . $value['goldProductMoneyUnit'];
                        $pages[$page][] = addPackage($page,
                            ++$size,
                            $vars['goldProductId'],
                            $value['goldProductId'],
                            $value['goldProductName'],
                            $value['goldProductGold'],
                            $price,
                            $value['goldProductImageName']);
                        if ($vars['goldProductId'] == $value['goldProductId']) {
                            $selectedPage = $page;
                        }
                        if ($x == 5) {
                            $page++;
                            $size = 0;
                        }
                    }
                    ?>
                    <?php
                    foreach ($pages as $page => $products) {
                        echo '<div class="productsPage ' . ($page == 1 ? 'visible' : 'hidden') . '">';
                        echo '<div class="fakeProductHelper"></div>';
                        //packages
                        foreach ($products as $p) {
                            echo $p;
                        }
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div id="paymentMethodsSlider"><h1><?= T("PaymentWizard", "Payment methods"); ?></h1>
        <div class="loading"></div>
        <div class="slideArea area1">
            <div class="arrowL inactive"></div>
        </div>
        <div class="slideArea area2">
            <div class="arrowR inactive"></div>
        </div>
        <div class="slidingContentOuter">
            <div class="slidingContentInner">
                <div class="slidingContent"></div>
            </div>
        </div>
    </div>
    <div id="overview">
        <div class="priceNotificationBox">* <?= T("PaymentWizard", "All displayed prices are final prices"); ?></div>
        <!---<div class="priceNotificationBox" style="color:red;font-weight:bold">* <?= T("PaymentWizard",
            "PayPalVATDesc"); ?></div>--->
        <br/>
        <h1><?= T("PaymentWizard", "Overview"); ?></h1>
        <table class="resultBox">
            <tr>
                <td><?= T("PaymentWizard", "Selected package"); ?></td>
                <td id="packageGoldAmount"><span class="goldUnits"></span> <?= T("PaymentWizard", "Gold"); ?></td>
            </tr>
            <tr>
                <td><?= T("PaymentWizard", "Your new gold balance"); ?></td>
                <td><span id="goldBalanceNew"></span> <?= T("PaymentWizard", "Gold"); ?></td>
            </tr>
            <tr>
                <td><?= T("PaymentWizard", "Price"); ?></td>
                <td id="priceToPay"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="inactiveButton">
                        <button type="button" value="<?= T("PaymentWizard", "Buy now"); ?>"
                                id="<?= ($button_id = get_button_id()); ?>"
                                class="green disabled " title="<?= T("PaymentWizard", "Buy now"); ?>">
                            <div class="button-container addHoverClick">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content"><?= T("PaymentWizard", "Buy now"); ?></div>
                            </div>
                        </button>
                        <script type="text/javascript"
                                id="<?= $button_id; ?>_script">jQuery(function () {
                                if (jQuery('#<?=$button_id;?>')) {
                                    jQuery('#<?=$button_id;?>').click(function (event) {
                                        jQuery(window).trigger('buttonClicked', [this, {
                                            "type": "button",
                                            "value": "Buy now",
                                            "name": "",
                                            "id": "<?=$button_id;?>",
                                            "class": "green disabled ",
                                            "title": "<?=T("PaymentWizard", "Buy now");?>",
                                            "confirm": "",
                                            "onclick": ""
                                        }]);
                                    });
                                }
                            });</script>
                    </div>
                    <div class="activeButton hide">
                        <button type="button" value="<?= T("PaymentWizard", "Buy now"); ?>"
                                id="<?= ($button_id = get_button_id()); ?>" class="green "
                                title="Buy now">
                            <div class="button-container addHoverClick">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content"><?= T("PaymentWizard", "Buy now"); ?></div>
                            </div>
                        </button>
                        <script type="text/javascript" id="<?= $button_id; ?>_script">
                            jQuery(function () {
                                if (jQuery('#<?=$button_id;?>')) {
                                    jQuery('#<?=$button_id;?>').click(function (event) {
                                        jQuery(window).trigger('buttonClicked', [this, {
                                            "type": "button",
                                            "value": "Buy now",
                                            "name": "",
                                            "id": "<?=$button_id;?>",
                                            "class": "green ",
                                            "title": "<?=T("PaymentWizard", "Buy now");?>",
                                            "confirm": "",
                                            "onclick": ""
                                        }]);
                                    });
                                }
                            });</script>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div id="paymentMethodsSlider">
        <hr/>
        <h1><?= T("redeemCode", "Redeem code"); ?></h1>
        <p style="font-size: 13px;">
            <?= T("redeemCode", "EnterYourCodeTo"); ?>:
        </p>
        <table id="brought_in" cellpadding="1" cellspacing="1">
            <tbody>
            <thead>
            <tr>
                <td><?= T("redeemCode", "Redeem code"); ?></td>
            </tr>
            </thead>
            <tr>
                <td>
                    <?= T("redeemCode", "Purchased code"); ?>:
                    <input type="text" class="text" value="" style="width: 50%" id="redeemCode">

                    <button id="redeemCodeButton" type="button" class="gold">
                        <div class="button-container addHoverClick">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-content"><?= T("redeemCode", "Redeem"); ?></div>
                        </div>
                    </button>
                    <script type="text/javascript" id="redeemCodeButton_script">
                        jQuery(function () {
                            jQuery('#redeemCodeButton').click(function (event) {
                                var redeemCode = jQuery("#redeemCode").val().trim();
                                var errors = {
                                    invalidCode: "<?=T("redeemCode", "invalidCode");?>",
                                    codeIsUsed: "<?=T("redeemCode", "codeIsUsed");?>",
                                    redeemSuccess: "<?=T("redeemCode", "redeemSuccess");?>",
                                    tooManyTries: "<?=T("redeemCode", "tooManyTries");?>",
                                    unknownError: "<?=T("redeemCode", "unknownError");?>"
                                };
                                Travian.ajax({
                                    data: {
                                        cmd: "redeemCode",
                                        redeemCode: redeemCode
                                    },
                                    onSuccess: function (a) {
                                        var dialog;
                                        if (a.result == true) {
                                            dialog = new Travian.Dialog.Dialog(
                                                {
                                                    preventFormSubmit: true,
                                                    buttonOk: true, overlayCancel: false, onOkay: function () {
                                                        window.location.reload();
                                                    }
                                                }
                                            );
                                            dialog.setContent(errors[a.errorMsg]);
                                        } else {
                                            dialog = new Travian.Dialog.Dialog(
                                                {
                                                    preventFormSubmit: true
                                                }
                                            );
                                            dialog.setContent(errors[a.errorMsg]);
                                        }
                                        dialog.show();
                                        jQuery("#redeemCodeButton").attr("disabled", false);
                                        jQuery("#redeemCodeButton").removeClass("disabled");
                                    },
                                    onFailure: function (a) {

                                        dialog = new Travian.Dialog.Dialog(
                                            {
                                                preventFormSubmit: true,
                                                buttonOk: true, overlayCancel: false, onOkay: function () {
                                                    window.location.reload();
                                                }
                                            }
                                        );
                                        dialog.setContent('Request failed!');
                                        dialog.show();
                                        jQuery("#redeemCodeButton").attr("disabled", false);
                                        jQuery("#redeemCodeButton").removeClass("disabled");
                                    }
                                });
                                jQuery(window).trigger('buttonClicked', [this, {
                                    "type": "button",
                                    "class": "gold",
                                    "id": "redeemCodeButton"
                                }]);
                            });
                        });
                    </script>
                </td>
            </tr>
            </tbody>
        </table>
        <hr/>
    </div>
    <div class="clear"></div>
    <div class="spaceBorder"></div>
    <div id="phonePackages"><!--<h1>SMS & phone</h1>No SMS/phone packages available.--></div>
    <div id="vouchers">
        <h1><?= T("PaymentWizard", "Voucher"); ?></h1>
        <div class="package size1 hideForLoading" title="<?= T("PaymentWizard", "Redeem voucher"); ?>">
            <div class="goldProductTextWrapper">
                <div class="goldUnitsTypeText"><?= T("PaymentWizard", "Voucher"); ?></div>
                <div class="footerLine"><span class="voucher"><?= T("PaymentWizard", "Redeem"); ?></span></div>
                <?= T("PaymentWizard", "Redeem voucher"); ?>
            </div>
            <div class="goldProductImageWrapper">
                <img src="<?= WebService::getPaymentUrl(); ?>img/product/Travian_Facelift_voucher.png"
                     width="100" height="114" alt="<?= T("PaymentWizard", "Voucher"); ?>"/></div>
        </div>
        <script type="text/javascript">
            function voucherPopup() {
                window.location.href = "voucher.php";
            }

            jQuery(function () {
                var shopUIV2 = new ShopUIV2();
                shopUIV2.initialize();
                var selectedPage = <?=$selectedPage;?>;
                if (selectedPage > 1) {
                    for (var i = 1; i < selectedPage; ++i) {
                        shopUIV2.packageSlideRight();
                    }
                }
            });
        </script>
    </div>
</div>