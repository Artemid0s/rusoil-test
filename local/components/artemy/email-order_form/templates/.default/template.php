<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
\Bitrix\Main\Localization\Loc::loadMessages(__FILE__);
$this->addExternalJs('https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js');
$this->addExternalCss('https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css');
$this->addExternalJs('https://code.jquery.com/jquery-3.7.1.min.js');
?>

<!--<pre><?php /*print_r($arParams); */ ?></pre>-->
<div class="container">
    <form class="order_form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="order[email]" value="<?=$arParams["EMAIL"]?>">
        <h2><?= GetMessage("PAGE_TITLE") ?></h2>
        <div class="row wo-padding">
            <div class="col col-lg-12">
                <label for="order_title"><?= GetMessage("ORDER_LABEL"); ?></label>
                <br/>
                <input type="text" name="order[title]" id="order_title" required>
                <div class="invalid-feedback">
                    Обязательно для заполнения
                </div>
            </div>
        </div>
        <h3><?= GetMessage("CATEGORY_TITLE"); ?></h3>
        <div class="row wo-padding">
            <div class="col col-lg-12">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="order[category]" value="category_1"
                           id="category_1" required>
                    <label class="form-check-label" for="category_1">Масла, автохимия, фильтры. Автоаксессуары,
                        обогреватели, запчасти, сопутствующие товары</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="order[category]" value="category_2"
                           id="category_2">
                    <label class="form-check-label" for="category_2">Шины, диски</label>
                </div>
            </div>
        </div>
        <h3><?= GetMessage("ORDER_TYPE_TITLE"); ?></h3>
        <div class="row wo-padding">
            <div class="col col-lg-12">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="order[type]" value="type_1" id="type_1" required>
                    <label class="form-check-label" for="type_1">Запрос цены и сроков поставки</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="order[type]" value="type_2" id="type_2">
                    <label class="form-check-label" for="type_2">Пополнение складов</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="order[type]" value="type_3" id="type_3">
                    <label class="form-check-label" for="type_3">Спецзаказ</label>
                </div>
            </div>
        </div>
        <h3><?= GetMessage("SUPPLY_WAREHOUSE") ?></h3>
        <div class="row wo-padding">
            <div class="col col-lg-4">
                <select class="form-select form-select-sm" name="order[supply_warehouse]" id="supply_warehouse">
                    <option selected value="">(выберите склад поставки)</option>
                    <option value="supply_warehouse_1">Склад 1</option>
                    <option value="supply_warehouse_2">Склад 2</option>
                    <option value="supply_warehouse_3">Склад 3</option>
                </select>
            </div>
        </div>
        <h3><?= GetMessage("ORDER_COMPOSITION") ?></h3>
        <div class="row form-group wo-padding">
            <div class="col col-lg-2 col-md-2 width-19">
                <label for="brand"><?= GetMessage("BRAND_LABEL") ?></label>
                <select class="form-select form-select-sm" name="order[composition][brand]" id="brand">
                    <option class="disabled" selected value="">Выберите бренд</option>
                    <option value="brand_1">Бренд 1</option>
                    <option value="brand_2">Бренд 2</option>
                    <option value="brand_3">Бренд 3</option>
                </select>
            </div>
            <div class="col col-lg-2 col-md-2 width-19">
                <label for="nomination"><?= GetMessage("NOMINATION_LABEL") ?></label>
                <input class="form-control input-sm inputfield" type="text" name="order[composition][nomination]"
                       id="nomination">
            </div>
            <div class="col col-lg-2 col-md-2 width-19">
                <label for="amount"><?= GetMessage("AMOUNT_LABEL") ?></label>
                <input class="form-control input-sm inputfield" type="text" name="order[composition][amount]"
                       id="amount">
            </div>
            <div class="col col-lg-2 col-md-2 width-19">
                <label for="packging"><?= GetMessage("PACKAGING_LABEL") ?></label>
                <input class="form-control input-sm inputfield" type="text" name="order[composition][packaging]"
                       id="packaging">
            </div>
            <div class="col col-lg-2 col-md-2 width-19">
                <label for="client"><?= GetMessage("CLIENT_LABEL") ?></label>
                <input class="form-control input-sm inputfield" type="text" name="order[composition][client]"
                       id="client">
            </div>
            <div class="row-controls col col-lg-1 col-md-1">
                <div class="add">+</div>
                <div class="remove">-</div>
            </div>
        </div>
        <br/>
        <div class="row wo-padding">
            <div class="col col-lg-4">
                <input class="form-control form-control-sm" type="file" name="order[composition][file]"
                       accept=".doc, .docx">
            </div>
        </div>
        <br/>
        <div class="row wo-padding">
            <div class="col col-lg-6">
                <textarea class="form-control" name="order[composition][comment]" id="comment" row
                          wo-paddings="5"></textarea>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col col-lg-12">
                <span class="error-message"></span>
            </div>
        </div>
        <div class="row wo-padding">
            <div class="col col-lg-3">
                <button class="btn btn-primary">
                    Отправить
                </button>
            </div>
        </div>
    </form>
    <div class="spinner-overlay"></div>
    <div class="d-flex justify-content-center">
        <div class="spinner-border" role="status">
            <span class="sr-only"></span>
        </div>
    </div>
</div>
