<div class="alert alert-warning" role="alert">
   <strong><i>Hinweis:</strong></i> Dieses Plugin setzt Ceres und IO in Version 2.0.3 oder höher voraus.
</div>

# plentymarkets Payment – Nachnahme

Mit diesem Plugin binden Sie die Zahlungsart **Nachnahme** in Ihren Webshop ein.

## Zahlungsart einrichten

Bevor die Zahlungsart in Ihrem Webshop verfügbar ist, müssen Sie zuerst einige Einstellungen in Ihrem plentymarkets Backend vornehmen.

Zuerst aktivieren Sie die Zahlungsart einmalig im Menü **System » Systemeinstellungen » Aufträge » Zahlung » Zahlungsarten**. Weitere Informationen dazu finden Sie auf der Handbuchseite <strong><a href="https://knowledge.plentymarkets.com/payment/zahlungsarten-verwalten#20" target="_blank">Zahlungsarten verwalten</a></strong>.

Stellen Sie zudem sicher, dass die Zahlungsart unter dem Punkt **Erlaubte Zahlungsarten** in den <strong><a href="https://knowledge.plentymarkets.com/crm/kontakte-verwalten#15" target="_blank">Kundenklassen</a></strong> vorhanden ist und nicht im Bereich **Gesperrte Zahlungsarten** in den <strong><a href="https://knowledge.plentymarkets.com/auftragsabwicklung/fulfillment/versand-vorbereiten#1000" target="_blank">Versandprofilen</a></strong> aufgeführt ist.

##### Zahlungsart einrichten:

1. Öffnen Sie das Menü **System&nbsp;» Systemeinstellungen » Aufträge&nbsp;» Versand » Optionen**.
2. Wechseln Sie in das Tab **Versandprofile**.
3. Setzen Sie einen Haken bei **Nachnahme**.
4. Wechseln Sie in das Tab **Portotabelle**.
5. Nehmen Sie die Einstellungen vor. Beachten Sie die Informationen zu <a href="https://knowledge.plentymarkets.com/fulfillment/versand-vorbereiten#1500"><strong>Versandprofilen</strong></a>.
5. **Speichern** Sie die Einstellungen.

## Details der Zahlungsart im Webshop anzeigen

Das Template-Plugin **Ceres** bietet Ihnen die Möglichkeit, Name und Logo Ihrer Zahlungsart im Bestellvorgang individuell anzeigen können. Gehen Sie wie im Folgenden beschrieben vor, um Name und Logo der Zahlungsart anzuzeigen.

##### Details zur Zahlungsart einrichten:

1. Gehen Sie zu **Plugins » Plugin-Übersicht**.
2. Klicken Sie auf das Plugin **Nachnahme**.
3. Klicken Sie auf **Konfiguration**.
4. Geben Sie unter **Name** den Namen ein, der für die Zahlungsart angezeigt werden soll.
5. Geben sie unter **Logo-URL** eine https-URL ein, die zum Logo-Bild führt. Gültige Dateiformate sind .gif, .jpg oder .png. Die Maximalgröße beträgt 190 Pixel in der Breite und 60 Pixel in der Höhe.
5. **Speichern** Sie die Einstellungen.<br />→ Name und Logo der Zahlungsart werden im Bestellvorgang des Webshops angezeigt.

## Zahlungsart auswählen

Wenn mindestens ein aktives und gültiges Versandprofil die Eigenschaft **Nachnahme** enthält, wird die Zahlungsart in der Bestellabwicklung angezeigt, ist aber nicht auswählbar. Nach Auswahl eines Versandprofils mit der Eigenschaft **Nachnahme** wird die Zahlungsart automatisch ausgewählt.

## Lizenz

Das gesamte Projekt unterliegt der GNU AFFERO GENERAL PUBLIC LICENSE – weitere Informationen finden Sie in der [LICENSE.md](https://github.com/plentymarkets/plugin-payment-invoice/blob/master/LICENSE.md).
