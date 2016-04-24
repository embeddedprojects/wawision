CREATE VIEW `artikel_eigenschaftensuche` AS
SELECT DISTINCT a.id, a.nummer,
(SELECT e.wert FROM eigenschaften e WHERE e.hauptkategorie='Stein' AND e.unterkategorie='Schliff' AND e.artikel=a.id LIMIT 1) as schliff,
(SELECT e.wert FROM eigenschaften e WHERE e.hauptkategorie='Stein' AND e.unterkategorie='Reinheit' AND e.artikel=a.id LIMIT 1) as reinheit,
(SELECT e.wert FROM eigenschaften e WHERE e.hauptkategorie='Stein' AND e.unterkategorie='Labor' AND e.artikel=a.id LIMIT 1) as labor,
(SELECT e.wert FROM eigenschaften e WHERE e.hauptkategorie='Stein' AND e.unterkategorie='Karat' AND e.artikel=a.id LIMIT 1) as karat,
(SELECT e.wert FROM eigenschaften e WHERE e.hauptkategorie='Stein' AND e.unterkategorie='GA-Nr.' AND e.artikel=a.id LIMIT 1) as ganr,
(SELECT e.wert FROM eigenschaften e WHERE e.hauptkategorie='Stein' AND e.unterkategorie='Farbe' AND e.artikel=a.id LIMIT 1) as farbe FROM artikel a WHERE a.nummer LIKE 'GIDI%' GROUP by a.id




