<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
\Bitrix\Main\Localization\Loc::loadMessages(__FILE__);

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Context;
use Bitrix\Main\Mail\Event;

class EmailOrderForm extends \CBitrixComponent implements Controllerable
{
  // Обязательный метод
  public function configureActions()
  {
    // Сбрасываем фильтры по-умолчанию (ActionFilter\Authentication и ActionFilter\HttpMethod)
    // Предустановленные фильтры находятся в папке /bitrix/modules/main/lib/engine/actionfilter/
    return [
      'sendMail' => [ // Ajax-метод
        'prefilters' => [],
      ],
    ];
  }

  public function onPrepareComponentParams($arParams)
  {
    $admin_email = COption::GetOptionString('main', 'email_from');

    $arParams["EMAIL"] = !empty($arParams["EMAIL"]) ? $arParams["EMAIL"] : $admin_email;

    return $arParams;
  }

  // Ajax-методы должны быть с постфиксом Action
  public function SendMailAction()
  {
    $request = Context::getCurrent()->getRequest();
    $file = $request->getFile("order");
    $formData = $request->get("order");
    $arFile = [];
    $savedFileID = "";

    if (!empty($file)) {
      $arFile = [
        "name" => $file["name"]["composition"]["file"],
        "size" => $file["size"]["composition"]["file"],
        "tmp_name" => $file["tmp_name"]["composition"]["file"],
        "type" => $file["type"]["composition"]["file"]
      ];

      $savedFileID = CFile::SaveFile($arFile, "/mailatt/");
    }

    $mailFields = [
      "EMAIL" => $formData["email"],
      "TITLE" => $formData["title"],
      "CATEGORY" => $formData["category"],
      "TYPE" => $formData["type"],
      "SUPPLY_WAREHOUSE" => $formData["supply_warehouse"],
      "BRAND" => $formData["composition"]["brand"],
      "NOMINATION" => $formData["composition"]["nomination"],
      "AMOUNT" => $formData["composition"]["amount"],
      "PACKAGING" => $formData["composition"]["packaging"],
      "CLIENT" => $formData["composition"]["client"],
      "FILE" => !empty($arFile) ? $arFile: "нет",
      "COMMENT" => $formData["composition"]["comment"]
    ];

    Event::sendImmediate([
      "EVENT_NAME" => "SEND_FORM",
      "LID" => "s1",
      "C_FIELDS" => $mailFields
    ]);

    if($savedFileID) CFile::Delete($savedFileID);

    return $formData;
  }

  public function executeComponent()
  {
    $this->includeComponentTemplate();
  }
}