CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `belege` AS
select `rechnung`.`id` AS `id`,`rechnung`.`adresse` AS `adresse`,`rechnung`.`datum` AS `datum`,`rechnung`.`belegnr` AS `belegnr`,
`rechnung`.`status` AS `status`,`rechnung`.`land` AS `land`,'rechnung' AS `typ`,umsatz_netto, erloes_netto, deckungsbeitrag, provision_summe, vertriebid,gruppe from `rechnung` WHERE `rechnung`.`status`!='angelegt'
union all
select `gutschrift`.`id` AS `id`,`gutschrift`.`adresse` AS `adresse`,`gutschrift`.`datum` AS `datum`,`gutschrift`.`belegnr` AS `belegnr`,
`gutschrift`.`status` AS `status`,`gutschrift`.`land` AS `land`,'gutschrift' AS `typ` ,umsatz_netto*-1,erloes_netto*-1, deckungsbeitrag*-1, provision_summe*-1,vertriebid,gruppefrom `gutschrift` WHERE `gutschrift`.`status`!='angelegt' AND `gutschrift`.`nicht_umsatzmindernd`!='1';




