<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">[TABTEXT]</a></li>
    </ul>
<!-- ende gehort zu tabview -->

<!-- erstes tab -->
<div id="tabs-1">

<fieldset>
        <legend>Filter</legend>

        <form action="" method="POST">

                <table>
                        <tr>
                                <td>
                                        Artikel:
                                        <input type="text" name="artikel" id="artikel" value="[ARTIKEL]">
                                </td>
                                <td>
                                        [AUSWAHLFILTER]
<select name="beleg">
[BELEGART]
</select>
                                </td>
<td><input type="submit" name="" value="Filter"></td>
                        </tr>
                </table>

        </form>
</fieldset>
<table width="100%>">
<tr>
<td>Artikel</td>
<td>Belege</td>
<td>Gesamt Menge</td>
<td>Gesamt Umsatz</td>
</tr>
<tr>
  <td style="background-color:lightgrey;color:white;padding:10px;font-size:2em;" width="25%">[ARTIKEL]</td>
  <td style="background-color:lightgrey;color:white;padding:10px;font-size:2em;" width="25%">[BELEG]</td>
  <td style="background-color:lightgrey;color:white;padding:10px;font-size:2em;" width="25%">[GESAMTMENGE]</td>
  <td style="background-color:lightgrey;color:white;padding:10px;font-size:2em;" width="25%">[GESAMTUMSATZ]</td>
</tr>
</table>

[MESSAGE]
[TAB1]
[TAB1NEXT]
</div>

<!-- tab view schließen -->
</div>
