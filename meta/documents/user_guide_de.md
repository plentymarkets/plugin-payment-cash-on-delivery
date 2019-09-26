<div class="alert alert-warning" role="alert">
   <strong><i>Hinweis:</strong></i> Dieses Plugin setzt Ceres und IO in Version 2.0.3 oder höher voraus.
</div>

# plentymarkets Payment – Nachnahme

Mit diesem Plugin bindest Du die Zahlungsart **Nachnahme** in deinen Webshop ein.

## Zahlungsart einrichten

Bevor die Zahlungsart in deinem Webshop verfügbar ist, musst du zuerst einige Einstellungen in deinem plentymarkets Backend vornehmen.

Zuerst aktivierst du die Zahlungsart einmalig im Menü **System » Systemeinstellungen » Aufträge » Zahlung » Zahlungsarten**. Weitere Informationen dazu findest du auf der Handbuchseite <strong><a href="https://knowledge.plentymarkets.com/payment/zahlungsarten-verwalten#20" target="_blank">Zahlungsarten verwalten</a></strong>.

Stelle zudem sicher, dass die Zahlungsart unter dem Punkt **Erlaubte Zahlungsarten** in den <strong><a href="https://knowledge.plentymarkets.com/crm/kontakte-verwalten#15" target="_blank">Kundenklassen</a></strong> vorhanden ist und nicht im Bereich **Gesperrte Zahlungsarten** in den <strong><a href="https://knowledge.plentymarkets.com/auftragsabwicklung/fulfillment/versand-vorbereiten#1000" target="_blank">Versandprofilen</a></strong> aufgeführt ist.

##### Zahlungsart einrichten:

1. Öffne das Menü **Einrichtung » Aufträge&nbsp;» Versand » Optionen**.
2. Wechsele in das Tab **Versandprofile**.
3. Setze einen Haken bei **Nachnahme**.
4. Sperre im Abschnitt **Gesperrte Zahlungsarten** alle Zahlungsarten mit Ausnahme von **Nachnahme**.
5. Wechsele in das Tab **Portotabelle**.
6. Nimm die Einstellungen vor. Beachte die Informationen zu <a href="https://knowledge.plentymarkets.com/fulfillment/versand-vorbereiten#1500"><strong>Versandprofilen</strong></a>.
7. **Speichere** die Einstellungen.

## Details der Zahlungsart im Webshop anzeigen

Das Template-Plugin **Ceres** bietet dir die Möglichkeit, Name und Logo deiner Zahlungsart im Bestellvorgang individuell anzuzeigen. Gehe wie im Folgenden beschrieben vor, um Name und Logo der Zahlungsart anzuzeigen.

##### Details zur Zahlungsart einrichten:

1. Gehe zu **Plugins » Plugin-Übersicht**.
2. Klicke auf das Plugin **Nachnahme**.
3. Klicke auf **Konfiguration**.
4. Gib unter **Name** den Namen ein, der für die Zahlungsart angezeigt werden soll.
5. Gib unter **Logo-URL** eine https-URL ein, die zum Logo-Bild führt. Gültige Dateiformate sind .gif, .jpg oder .png. Die Maximalgröße beträgt 190 Pixel in der Breite und 60 Pixel in der Höhe.
6. **Speichere** die Einstellungen.<br />→ Name und Logo der Zahlungsart werden im Bestellvorgang des Webshops angezeigt.

## Zahlungsart auswählen

Wenn mindestens ein aktives und gültiges Versandprofil die Eigenschaft **Nachnahme** enthält, wird die Zahlungsart in der Bestellabwicklung angezeigt und ist auswählbar. Nach Auswahl eines Versandprofils mit der Eigenschaft **Nachnahme** wird die Zahlungsart automatisch ausgewählt.

## Lizenz

Das gesamte Projekt unterliegt der GNU AFFERO GENERAL PUBLIC LICENSE – weitere Informationen findest du in der [LICENSE.md](https://github.com/plentymarkets/plugin-payment-invoice/blob/master/LICENSE.md).
