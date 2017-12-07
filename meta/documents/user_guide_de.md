# plentymarkets Payment – Rechnung

Mit diesem Plugin binden Sie die Zahlungsart **Rechnung** in Ihren Webshop ein.

## Zahlungsart einrichten

Bevor die Zahlungsart in Ihrem Webshop verfügbar ist, müssen Sie Einstellungen in Ihrem plentymarkets Backend vornehmen.

##### Zahlungsart einrichten:

1. Öffnen Sie das Menü **Einstellungen&nbsp;» Aufträge&nbsp;» Zahlung » Invoice » Rechnung**.
2. Wählen Sie einen Mandanten.
3. Nehmen Sie die Einstellungen vor. Beachten Sie dazu die Erläuterungen in Tabelle 1.
4. **Speichern** Sie die Einstellungen.

<table>
<caption>Tab. 1: Einstellungen für die Zahlungsart vornehmen</caption>
	<thead>
		<th>
			Einstellung
		</th>
		<th>
			Erläuterung
		</th>
	</thead>
	<tbody>
        <tr>
			<td>
				<b>Sprache</b>
			</td>
			<td>
				Sprache wählen. Die übrigen Einstellungen, z.B. Name, Infoseite etc., werden sprachabhängig gespeichert.
			</td>
		</tr>
        <tr>
			<td>
				<b>Name</b>
			</td>
			<td>
				Die Bezeichnung, die in der Übersicht der Zahlungsarten in der Kaufabwicklung für diese Zahlungsart angezeigt wird.
			</td>
		</tr>
		<tr>
			<td>
				<b>Infoseite</b>
			</td>
			<td>Wählen, ob als <a href="https://knowledge.plentymarkets.com/auftragsabwicklung/payment/bankdaten-verwalten#40"><strong>Information zur Zahlungsart</strong></a> eine Kategorieseite oder eine externe Webseite angezeigt wird.
			</td>
		</tr>
		<tr>
			<td>
				<b>Infoseite intern/<br />Infoseite extern</b>
			</td>
			<td>In der Beschreibung der Zahlungsart wird ein Link zu den <strong>Details</strong> der Zahlungsart angezeigt.<br /><strong>Infoseite intern:</strong> Über Eingabe der Kategorie-ID oder das Auswahlfeld eine Kategorieseite vom Typ <strong>Content</strong> wählen, die weitere Informationen zur Zahlungsart bietet.<br /><strong>Infoseite extern:</strong> Die URL einer externen Informationsseite eingeben. <strong><i>Wichtig:</i></strong>Entweder http:// oder https:// verwenden.<br />Wird keine Eingabe vorgenommen, wird kein Link angezeigt.
			</td>
        <tr>
			<td>
				<b>Logo</b>
			</td>
			<td>
			Wählen, ob das im Plugin hinterlegte <strong>Standard-Logo</strong> der Zahlungsart oder ein eigenes Logo angezeigt wird.
			</td>
		</tr>
        <tr>
			<td>
				<b>Logo-URL</b>
			</td>
			<td>
			Eine https-URL, die zum Logo-Bild führt. Gültige Dateiformate sind .gif, .jpg oder .png. Die Maximalgröße beträgt 190 Pixel in der Breite und 60 Pixel in der Höhe.
			</td>
		</tr>
		<tr>
			<td>
				<b>Beschreibung</b>
			</td>
			<td>
				Eine Beschreibung der Zahlungsart eingeben, die dem Kunden in der Kaufabwicklung angezeigt wird. Der Text wird nach 150 Zeichen mit Ellipse abgeschnitten.
			</td>
		</tr>
		<tr>
			<td>
				<b>Lieferländer</b>
			</td>
			<td>
				Nur für die hier eingestellten Lieferländer ist diese Zahlungsart freigegeben.
			</td>
		</tr>
		<tr>
			<td colspan="2" class="th">Anzeigedaten</td>  
		</tr>
		<tr>
			<td>
				<b>Mindestanzahl an Bestellungen</b>
			</td>  
			<td>
Mindestanzahl an Bestellungen eingeben, die ein Kunde mit einer anderen Zahlungsart abschließen muss, bevor der Kauf auf Rechnung verwendet werden kann.
			</td>
		</tr>
		<tr>
			<td>
				<b>Mindestbetrag für Kauf auf Rechnung</b>
			</td>  
			<td>
			Betrag eingeben, der beim Kauf auf Rechnung nicht unterschritten werden darf.
			</td>
		</tr> 
		<tr>
			<td>
				<b>Maximalbetrag für Kauf auf Rechnung</b>
			</td>  
			<td>
			Betrag eingeben, der beim Kauf auf Rechnung nicht überschritten werden darf.
			</td>
		</tr>
		<tr>
			<td>
				<b>Verwendungszweck</b>
			</td>  
			<td>
			Verwendungszweck für den Kauf auf Rechnung eingeben.
			</td>
		</tr>
		<tr>
			<td>
				<b>Verwendungszweck anzeigen</b>
			</td>  
			<td>
			Aktivieren, um den Verwendungszweck in der Bestellbestätigung anzuzeigen. Diese Informationen werden dem passenden <a href="#10."><strong>Template-Container</strong></a> verknüpft.
			</td>
		</tr>
		<tr>
			<td>
				<b>Bankdaten anzeigen</b>
			</td>  
			<td>
			Aktivieren, um die Bankdaten in der Bestellbestätigung anzuzeigen. Bankdaten speichern Sie im Menü <strong>Einstellungen » Grundeinstellungen » Bank</strong>.
			</td>
		</tr>
		<tr>
			<td>
				<b>Rechnungsadresse gleich Lieferadresse</b>
			</td>  
			<td>
			Aktivieren, wenn Rechnungs- und Lieferadresse beim Kauf auf Rechnung übereinstimmen sollen.
			</td>
		</tr>
		<tr>
			<td>
				<b>Kauf auf Rechnung für Gastbestellungen verbieten</b>
			</td>  
			<td>
			Aktivieren, um den Kauf auf Rechnung nur für angemeldete Kunden zu erlauben.
			</td>
		</tr> 
	</tbody>
</table>

## Logo der Zahlungsart auf der Startseite anzeigen

Das Template-Plugin **Ceres** bietet Ihnen auf der Startseite einen Template-Container, in dem Sie die Logos Ihrer Zahlungsart anzeigen können. Gehen Sie wie im Folgenden beschrieben vor, um das Logo der Zahlungsart zu verknüpfen.

##### Logo mit Template-Container verknüpfen:

1. Gehen Sie zu **Plugins » Content**. 
3. Wählen Sie den Bereich **Invoice icon**.
4. Aktivieren Sie den Container **Homepage: Payment method container**.
5. **Speichern** Sie die Einstellungen.<br />→ Das Logo der Zahlungsart wird auf der Startseite des Webshops angezeigt.

## Bankdaten in der Bestellbestätigung anzeigen <a id="10." name="10."></a>

Gehen Sie wie im Folgenden beschrieben vor, um die im System hinterlegten Bankdaten und einen Verwendungszweck auf der Bestellbestätigungsseite anzuzeigen.

##### Bankdaten anzeigen:

1. Öffnen Sie das Menü **Einstellungen&nbsp;» Aufträge&nbsp;» Zahlung » Invoice » Rechnung**.
2. Wählen Sie einen Mandanten.
3. Geben Sie im Bereich **Anzeigedaten** einen **Verwendungszweck** ein.
4. Aktivieren Sie die Option **Verwendungszweck anzeigen**.
5. Aktivieren Sie die Option **Bankdaten anzeigen**.
4. **Speichern** Sie die Einstellungen.

Nachdem Sie die Einstellungen vorgenommen haben, verknüpfen Sie die Bankdaten mit einem Template-Container.

##### Bankdaten mit Template-Container verknüpfen:

1. Gehen Sie zu **Plugins » Content**. 
3. Wählen Sie den Bereich **Invoice bank details**.
4. Aktivieren Sie den Container **Order confirmation: Additional payment information**.
5. **Speichern** Sie die Einstellungen.<br />→ Die Bankdaten werden auf der Bestellbestätigungsseite angezeigt.

## Rechnungsdokumente erstellen

Erfahren Sie, wie Sie [Vorlagen für Rechnungsdokumente](https://www.plentymarkets.eu/handbuch/mandant-shop/standard/dokumente/rechnung/#2-2) anlegen. Rechnungen erstellen Sie [manuell](https://www.plentymarkets.eu/handbuch/mandant-shop/standard/dokumente/rechnung/#3-1) oder lassen diese [automatisch über eine Ereignisaktion](https://www.plentymarkets.eu/handbuch/mandant-shop/standard/dokumente/rechnung/#3-2) erzeugen.

## Lizenz
 
Das gesamte Projekt unterliegt der GNU AFFERO GENERAL PUBLIC LICENSE – weitere Informationen finden Sie in der [LICENSE.md](https://github.com/plentymarkets/plugin-payment-invoice/blob/master/LICENSE.md).