<?php
/*
**** COPYRIGHT & LICENSE NOTICE *** DO NOT REMOVE ****
* 
* WaWision (c) embedded projects GmbH, Holzbachstrasse 4, D-86154 Augsburg, * Germany 2015 
*
* This file is licensed under the Embedded Projects General Public License *Version 3.1. 
*
* You should have received a copy of this license from your vendor and/or *along with this file; If not, please visit www.wawision.de/Lizenzhinweis 
* to obtain the text of the corresponding license version.  
*
**** END OF COPYRIGHT & LICENSE NOTICE *** DO NOT REMOVE ****
*/
?>
<?php
include ("_gen/importvorlage.php");

class Importvorlage extends GenImportvorlage {
  var $app;
  var $limit_datensaetze;

  function Importvorlage($app) {
    //parent::GenImportvorlage($app);
    $this->app=&$app;

    $this->limit_datensaetze=1;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","ImportvorlageCreate");
    $this->app->ActionHandler("edit","ImportvorlageEdit");
    $this->app->ActionHandler("import","ImportvorlageImport");
    $this->app->ActionHandler("list","ImportvorlageList");
    $this->app->ActionHandler("delete","ImportvorlageDelete");
    $this->app->ActionHandler("uebersicht","ImportvorlageUebersicht");
    $this->app->ActionHandler("adressen","ImportvorlageAdressen");
    $this->app->ActionHandler("adresseedit","ImportvorlageAdresseEdit");
    $this->app->ActionHandler("rueckgaengig","ImportvorlageRueckgaengig");

    $this->app->ActionHandlerListen($app);

    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Daten Import");

    $this->app = $app;
  }

  function ImportvorlageAdresseEdit()
  {
    $this->app->Tpl->Parse('TAB1',"importvorlage_uebersicht.tpl");
    $this->app->Tpl->Set('TABTEXT',"Import");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }

  function ImportvorlageUebersicht()
  {
    $this->app->Tpl->Parse('TAB1',"importvorlage_uebersicht.tpl");
    $this->app->Tpl->Set('TABTEXT',"Import");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }

  function ImportvorlageAdressen()
  {
    //$this->app->Tpl->Parse('TAB1',"importvorlage_adressen.tpl");
    $this->app->YUI->TableSearch('TAB1',"adresse_import");
    $this->app->erp->MenuEintrag("index.php?module=importvorlage&action=uebersicht","Zur&uuml;ck zur &Uuml;bersicht");
    $this->app->Tpl->Set('TABTEXT',"Import");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }

  function ImportvorlageRueckgaengig()
  {
    $sid = $this->app->Secure->GetGET("sid");

    if($sid > 0)
    {
      $tmp = $this->app->DB->SelectArr("SELECT *,DATE_FORMAT(zeitstempel,'%d.%m.%Y %H:%i') as zeit 
          FROM importvorlage_log WHERE ersterdatensatz='1' AND user='".$this->app->User->GetID()."' 
          ORDER by zeitstempel DESC LIMIT 1");  

        if($tmp[0]['id']==$sid)
        {
          $zeitstempel = $this->app->DB->Select("SELECT zeitstempel FROM importvorlage_log WHERE id='$sid' LIMIT 1");
          $this->app->erp->ImportvorlageLogDelete($zeitstempel);
          $msg=$this->app->erp->base64_url_encode("<div class=\"info\">Import r&uuml;ckg&auml;ngig gemacht.</div>");
          header("Location: index.php?module=importvorlage&action=list&msg=$msg");
          exit;
        }
    }
  } 



  function ImportvorlageCreate()
  {
    $this->ImportvorlageMenu();
    parent::ImportvorlageCreate();
  }

  function ImportvorlageDelete()
  {
    $id = $this->app->Secure->GetGET("id");
    if(is_numeric($id))
    {
      $this->app->DB->Delete("DELETE FROM importvorlage WHERE id='$id'");
    }
    $this->ImportvorlageList();
  }

  function ImportvorlageList()
  {
    $this->ImportvorlageMenu();
    if($this->app->DB->Select("SELECT COUNT(id) FROM importvorlage") <=0)
    {
      $this->app->DB->Insert("INSERT INTO `importvorlage` (`id`, `bezeichnung`, `fields`, `internebemerkung`, `ziel`, `letzterimport`, `mitarbeiterletzterimport`, `importtrennzeichen`, `importerstezeilenummer`, `importdatenmaskierung`, `importzeichensatz`) VALUES
          ('', 'Standard Artikel Import (Format siehe Wiki)', '1:nummer;\r\n2:name_de;\r\n3:name_en;\r\n4:beschreibung_de;\r\n5:beschreibung_en;\r\n6:kurztext_de;\r\n7:kurztext_en;\r\n8:internerkommentar;\r\n9:hersteller;\r\n10:herstellernummer;\r\n11:herstellerlink;\r\n12:ean;', '', 'artikel', '0000-00-00 00:00:00', '', 'semikolon', 2, 'keine', '');");

      $this->app->DB->Insert("INSERT INTO `importvorlage` (`id`, `bezeichnung`, `fields`, `internebemerkung`, `ziel`, `letzterimport`, `mitarbeiterletzterimport`, `importtrennzeichen`, `importerstezeilenummer`, `importdatenmaskierung`, `importzeichensatz`) VALUES
          ('', 'Shopware Artikel CSV (Ohne Lager)', '1:nummer;\r\n2:variante_von;\r\n3:name_de;\r\n4:kurztext_de;\r\n4:anabregs_text;\r\n5:lieferantname;\r\n6:umsatzsteuer;\r\n11:lieferanteinkaufnetto;\r\n8:verkaufspreis1netto;\r\n12:pseudopreis;\r\n15:aktiv;\r\n18:beschreibung_de;\r\n25:topseller;\r\n38:herstellernummer;\r\n42:gewicht;\r\n46:ean;\r\n47:einheit;', '', 'artikel', '0000-00-00 00:00:00', '', 'semikolon', 2, 'gaensefuesschen', '');");
    }

    $tmp = $this->app->DB->SelectArr("SELECT *,DATE_FORMAT(zeitstempel,'%d.%m.%Y %H:%i') as zeit FROM importvorlage_log WHERE ersterdatensatz='1' ORDER by zeitstempel DESC LIMIT 1");

    if($tmp[0]['id'] > 0 && $tmp[0]['tabelle']=="adresse")
    {
      $name_import = $this->app->DB->Select("SELECT bezeichnung FROM importvorlage WHERE id='".$tmp[0]['importvorlage']."' LIMIT 1"); 
      $user_name = $this->app->DB->Select("SELECT a.name FROM user u LEFT JOIN adresse a ON a.id=u.adresse WHERE u.id='".$tmp[0]['user']."' LIMIT 1"); 
      $this->app->Tpl->Set('MESSAGE',"<div class=\"info\">Letzter Import: $name_import am ".$tmp[0]['zeit']." Uhr von $user_name (<a href=\"#\" onclick=\"if(!confirm('Wirklich den Import r&uuml;ckg&auml;ngig machen?')) return false; else window.location.href='index.php?module=importvorlage&action=rueckgaengig&sid=".$tmp[0]['id']."';\">Import r&uuml;ckg&auml;ngig machen</a>).</div>");
    }


    parent::ImportvorlageList();
  }

  function ImportvorlageMenu()
  {
    $id = $this->app->Secure->GetGET("id");
    $bezeichnung = $this->app->DB->Select("SELECT bezeichnung FROM importvorlage WHERE id='$id' LIMIT 1");

    $this->app->Tpl->Set('KURZUEBERSCHRIFT2',$bezeichnung);

    if($this->app->Secure->GetGET("action")=="list")
    {
      $this->app->erp->MenuEintrag("index.php?module=importvorlage&action=create","Neue Importvorlage anlegen");
      $this->app->erp->MenuEintrag("index.php?module=importvorlage&action=uebersicht","Zur&uuml;ck zur &Uuml;bersicht");
    }
    else
    {
      $this->app->erp->MenuEintrag("index.php?module=importvorlage&action=edit&id=$id","Details");
      //if($this->app->Secure->GetGET("action")!="create")
      $this->app->erp->MenuEintrag("index.php?module=importvorlage&action=import&id=$id","Import starten: CSV Datei heraufladen");
      $this->app->erp->MenuEintrag("index.php?module=importvorlage&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    }
  }

  function ImportvorlageEdit()
  {
    $this->ImportvorlageMenu();
    parent::ImportvorlageEdit();
  }

  function ImportvorlageGetFields($id)
  {
    $fields = $this->app->DB->Select("SELECT fields FROM importvorlage WHERE id='$id' LIMIT 1");

    $fieldsarray = explode(';',$fields);
    for($i=0;$i<count($fieldsarray);$i++)
    {
      $fieldsarray_items = explode(':',$fieldsarray[$i]);
      $fieldsarray_items[0] = str_replace('!','',$fieldsarray_items[0]);
      if($fieldsarray_items[1]!=""){
        if(strpos($fieldsarray_items[0],'"') === false)
        {
          $csv_fields[$fieldsarray_items[0]]= $fieldsarray_items[1];
          $csv_fields_keys[] = $fieldsarray_items[0];
        }
      }
    }           
    return $csv_fields;
  }

  function ImportvorlageGetFieldsNew($id)
  {
    $fields = $this->app->DB->Select("SELECT fields FROM importvorlage WHERE id='$id' LIMIT 1");
    $fieldsarray = explode(';',$fields);
    for($i=0;$i<count($fieldsarray);$i++)
    {
      $fieldsarray_items = explode(':',$fieldsarray[$i],3);
      $fieldsarray_items1 = trim(str_replace('!','',$fieldsarray_items[1]));
      if($fieldsarray_items[1]!=""){
        if(strpos($fieldsarray_items[0],'"') === false)
        {
          $erg[$i]['nr'] = trim($fieldsarray_items[0]);
          $erg[$i]['field'] = $fieldsarray_items1;
          if(strpos($fieldsarray_items[1],'!') !== false)
          {
             $erg[$i]['inv'] = true;
          }          
        } else {
          $erg[$i]['field'] = $fieldsarray_items1;
          $erg[$i]['vorlage'] = trim(trim($fieldsarray_items[0]),'"');
        }
        if(isset($fieldsarray_items[2]) && trim($fieldsarray_items[2]))$erg[$i]['bedingung'] = trim($fieldsarray_items[2]);
      }
    }
    if(isset($erg))return $erg;
    return false;
  }

  
  function ImportvorlageGetFieldsInverse($id)
  {
    $fields = $this->app->DB->Select("SELECT fields FROM importvorlage WHERE id='$id' LIMIT 1");

    $fieldsarray = explode(';',$fields);
    for($i=0;$i<count($fieldsarray);$i++)
    {
      $fieldsarray_items = explode(':',$fieldsarray[$i]);
      if($fieldsarray_items[1]!=""){
        if(strpos($fieldsarray_items[0],'"') === false)
        {
          if(strpos($fieldsarray_items[1],'!') !== false)
          {
            $csv_fields[$fieldsarray_items[0]] = true;
          } else {
            $csv_fields[$fieldsarray_items[0]] = false;
          }
        }
      }
    }
    return $csv_fields;
  }
  
  function ImportvorlageGetVorlage($id)
  {
    $fields = $this->app->DB->Select("SELECT fields FROM importvorlage WHERE id='$id' LIMIT 1");

    $fieldsarray = explode(';',$fields);
    for($i=0;$i<count($fieldsarray);$i++)
    {
      $fieldsarray_items = explode(':',$fieldsarray[$i]);
      if($fieldsarray_items[1]!=""){
        if(strpos($fieldsarray_items[0],'"') === false)
        {

        } else {
          
          $vorlage[trim($fieldsarray_items[1])] = trim(trim($fieldsarray_items[0]),'"');
        }
      }
    }           
    if(isset($vorlage))return $vorlage;
    return false;
  }

  function ImportvorlageImport()
  {
    $id = (int)$this->app->Secure->GetGET("id");
    $this->app->erp->MenuEintrag("index.php?module=importvorlage&action=edit&id=$id","Details");
    $this->app->erp->MenuEintrag("index.php?module=importvorlage&action=import&id=$id","Import starten: CSV Datei heraufladen");

    
    
    set_time_limit (0);
    $upload = $this->app->Secure->GetPOST("upload");
    $selcharsets = array('UTF8'=>'UTF-8','ISO-8859-1'=>'ISO-8859-1','CP850'=>'CP850');
    $sel = '<select id="selcharset">';
    $charset = '';
    if($id)$charset = $this->app->DB->Select("SELECT charset from importvorlage where id = '$id'");
    if($upload!="")
    {
      $charset = $this->app->Secure->GetPOST("charset");
    }
    $this->app->Tpl->Set('CHARSET',$charset);
    foreach($selcharsets as $k => $v)
    {
      $sel .= '<option value="'.$k.'"'.($charset == $k?' selected="selected" ':'').'>'.$v.'</option>';
      
    }
    $sel .= '</select>';
    $this->app->Tpl->Set('SELCHARSET',$sel);
    $this->app->Tpl->Add('JAVASCRIPT','
    $(document).ready(function() {
      $("#selcharset").on("change",function(){
        $("#charset").val($("#selcharset").val());
      });
    });
   
    ');
    
    $bezeichnung = $this->app->DB->Select("SELECT bezeichnung FROM importvorlage WHERE id='$id' LIMIT 1");
    $importtrennzeichen = $this->app->DB->Select("SELECT importtrennzeichen FROM importvorlage WHERE id='$id' LIMIT 1");
    $importerstezeilenummer = $this->app->DB->Select("SELECT importerstezeilenummer FROM importvorlage WHERE id='$id' LIMIT 1");
    $importdatenmaskierung = $this->app->DB->Select("SELECT importdatenmaskierung FROM importvorlage WHERE id='$id' LIMIT 1");
    $importzeichensatz = $this->app->DB->Select("SELECT importzeichensatz FROM importvorlage WHERE id='$id' LIMIT 1");
    $fields = $this->app->DB->Select("SELECT fields FROM importvorlage WHERE id='$id' LIMIT 1");
    $ziel = $this->app->DB->Select("SELECT ziel FROM importvorlage WHERE id='$id' LIMIT 1");
    $utf8decode = 0;//$this->app->DB->Select("SELECT utf8decode FROM importvorlage WHERE id='$id' LIMIT 1");

    $fieldset = $this->ImportvorlageGetFieldsNew($id);
    /*
    $fieldsarray = explode(';',$fields);
    for($i=0;$i<count($fieldsarray);$i++)
    {
      $fieldsarray_items = explode(':',$fieldsarray[$i],3);
      $fieldsarray_items[0] = str_replace('!','',$fieldsarray_items[0]);
      if($fieldsarray_items[1]!=""){
        if(strpos($fieldsarray_items[0],'"') === false)
        {
          $csv_fields[$fieldsarray_items[0]]= $fieldsarray_items[1];
          $csv_fields_keys[] = $fieldsarray_items[0];
        } else {
          $vorlage[trim($fieldsarray_items[1])] = trim(trim($fieldsarray_items[0]),'"');
          
        }
      }
    }
    
    if(!isset($vorlage)) $vorlage = null;
    
    $fieldsarray = explode(';',$fields);
    for($i=0;$i<count($fieldsarray);$i++)
    {
      $fieldsarray_items = explode(':',$fieldsarray[$i]);
      if($fieldsarray_items[1]!=""){
        
        if(strpos($fieldsarray_items[0],'"') === false)
        {
          if(strpos($fieldsarray_items[1],'!') !== false)
          {
            $fieldsinverse[$fieldsarray_items[0]] = true;
          } else {
            $fieldsinverse[$fieldsarray_items[0]] = false;
          }
        }
      }
    } 
    if(!isset($fieldsinverse))$fieldsinverse = null;*/
    
    
    if($importtrennzeichen=="semikolon") $importtrennzeichen=';';
    if($importtrennzeichen=="komma") $importtrennzeichen=',';

    if($importdatenmaskierung=="gaensefuesschen") $importdatenmaskierung='"';
    $number_of_fields = count($csv_fields);

    

    if($upload!="")
    {

      //print_r($csv_fields);
      $stueckliste_csv = $this->app->erp->GetTMP()."importvorlage".$this->app->User->GetID();


      if (move_uploaded_file($_FILES['userfile']['tmp_name'], $stueckliste_csv)) {
        $importfilename = $_FILES['userfile']['name'];
      }
      ini_set("auto_detect_line_endings", true);
      if (($handle = fopen($stueckliste_csv, "r")) !== FALSE) 
      {
        $rowcounter = 0;
        $rowcounter_real = 0;

        //$this->ImportPrepareHeader($ziel,$csv_fields_keys,$csv_fields,$vorlage);
        $this->ImportPrepareHeader($ziel, $fieldset);
        while (($data = fgetcsv($handle, 0, $importtrennzeichen)) !== FALSE) {
          $rowcounter++;
          $num = count($data);
          if($rowcounter >= $importerstezeilenummer)
          {
            $rowcounter_real++;
            //$data = array_map("utf8_encode", $data);
            //print_r($data);
            foreach($data as $key=>$value) {
              if($charset && strtoupper($charset) != 'UTF-8' && strtoupper($charset) != 'UTF8')$data[$key] = iconv($charset, 'UTF-8', $data[$key]."\0") ;
            }
            foreach($data as $key=>$value) {
              //        $data[$key] = str_replace('"','',$data[$key]);
              //        $data[$key] = mb_convert_encoding($data[$key], "utf-8", "windows-1251");
              /* Detect character encoding with current detect_order */
              //$data[$key] = html_entity_decode($this->app->erp->fixeUmlaute( $data[$key] ));
              //              $data[$key] = html_entity_decode( $data[$key] );
              
              //if($utf8decode) $data[$key] = utf8_decode($data[$key] );
              $data[$key] = trim( $data[$key] );
              // $data[$key] = iconv('UCS-2', 'UTF-8', $data[$key]."\0") ;
              $data[$key] = str_replace('""', '"', $data[$key]);
              $data[$key] = preg_replace("/^\"(.*)\"$/sim", "$1", $data[$key]);
              //                                                                $data[$key]= mb_convert_encoding($data[$key], "Windows-1252");
            }

            if($limit_erreicht!=true)
              //$this->ImportPrepareRow($rowcounter_real,$ziel,$data,$csv_fields_keys,$csv_fields,$fieldsinverse,$vorlage);
            $this->ImportPrepareRow($rowcounter_real,$ziel,$data,$fieldset);

            if($rowcounter_real >= $this->limit_datensaetze) {
              $limit_erreicht = true;
              //break;
            }

          }
        }
      }
      fclose($handle);

      if($rowcounter_real < $this->limit_datensaetze)
        unlink($stueckliste_csv);

      if($limit_erreicht)
        $this->app->Tpl->Add('IMPORTBUTTON','<input type="submit" name="import" value="importieren"> <i>Vorschau: Es werden aktuell nur 50 von <b>'.$rowcounter_real.'</b> Datens&auml;tze angezeigt. Importiert werden aber alle '.$rowcounter_real.' Datens&auml;tze!</i> <input type="hidden" name="importdateiname" value="'.$stueckliste_csv.'">');
      else
        $this->app->Tpl->Add('IMPORTBUTTON','<input type="submit" name="import" value="importieren">');

      $this->app->Tpl->Add('IMPORTBUTTON','<input type="submit" name="import" value="importieren">');
    }


    $import = $this->app->Secure->GetPOST("import");
    if($import!="")
    {
      $this->ImportvorlageDo($charset);
      $this->app->erp->Tpl->Set('MESSAGE',"<div class=\"info\">Import durchgef&uuml;hrt.</div>");
    }



    $this->app->Tpl->Set('KURZUEBERSCHRIFT2',$bezeichnung);
    $this->app->Tpl->Parse('TAB1',"importvorlage_import.tpl");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }

  function ImportvorlageGetCSV($stueckliste_csv,$id, $charset = "")
  {
    // einlesen von der CSV Datei
    $fieldstmp = $this->app->DB->Select("SELECT fields FROM importvorlage WHERE id='$id' LIMIT 1");

    $importtrennzeichen = $this->app->DB->Select("SELECT importtrennzeichen FROM importvorlage WHERE id='$id' LIMIT 1");
    $importerstezeilenummer = $this->app->DB->Select("SELECT importerstezeilenummer FROM importvorlage WHERE id='$id' LIMIT 1");
    $importdatenmaskierung = $this->app->DB->Select("SELECT importdatenmaskierung FROM importvorlage WHERE id='$id' LIMIT 1");
    $importzeichensatz = $this->app->DB->Select("SELECT importzeichensatz FROM importvorlage WHERE id='$id' LIMIT 1");
    $utf8decode = 0;//$this->app->DB->Select("SELECT utf8decode FROM importvorlage WHERE id='$id' LIMIT 1");

    $fieldsarray = explode(';',$fieldstmp);
    for($i=0;$i<count($fieldsarray);$i++)
    {
      $fieldsarray_items = explode(':',$fieldsarray[$i]);
      if(trim($fieldsarray_items[1])!=""){
        if(trim($fieldsarray_items[0]) == (int)trim($fieldsarray_items[0]))
        {
          $csv_fields[trim($fieldsarray_items[0])]= trim($fieldsarray_items[1]);
          $csv_fields_keys[] = trim($fieldsarray_items[0]);
        } else {
          $vorlage[trim($fieldsarray_items[1])] = trim(trim($fieldsarray_items[0]),'"');
        }
      }
    }

    if($importtrennzeichen=="semikolon") $importtrennzeichen=';';
    if($importtrennzeichen=="komma") $importtrennzeichen=',';

    if($importdatenmaskierung=="gaensefuesschen") $importdatenmaskierung='"';
    $number_of_fields = count($csv_fields);
    if (($handle = fopen($stueckliste_csv, "r")) !== FALSE)
    {
      $rowcounter = 0;
      $rowcounter_real = 0;

      while (($data = fgetcsv($handle, 0, $importtrennzeichen)) !== FALSE) {
        $rowcounter++;
        $num = count($data);
        if($rowcounter >= $importerstezeilenummer)
        {  
          $rowcounter_real++;
          //$data = array_map("utf8_encode", $data);
          //print_r($data);
          foreach($data as $key=>$value) {
            if($charset && strtoupper($charset) != 'UTF-8' && strtoupper($charset) != "UTF8")$data[$key] = iconv($charset, 'UTF-8', $value."\0");
          }
          
          foreach($data as $key=>$value) {
            //  $data[$key] = str_replace('"','',$data[$key]);
            //  $data[$key] = mb_convert_encoding($data[$key], "utf-8", "windows-1251");
            /* Detect character encoding with current detect_order */

            //            $data[$key] = html_entity_decode($data[$key] );
            //if($utf8decode) $data[$key] = utf8_decode($data[$key] );
            
            $data[$key] = trim( $data[$key] );
            // $data[$key] = iconv('UCS-2', 'UTF-8', $data[$key]."\0") ;
            $data[$key] = str_replace('""', '"', $data[$key]);
            $data[$key] = preg_replace("/^\"(.*)\"$/sim", "$1", $data[$key]);
            //$data[$key]= mb_convert_encoding($data[$key], "Windows-1252");
          }
          //$this->ImportPrepareRow($rowcounter_real,$ziel,$data,$csv_fields_keys,$csv_fields);
          for($j=0;$j<=$number_of_fields;$j++)
          {  
            $value = trim($data[($csv_fields_keys[$j]-1)]);
            $fieldname = $csv_fields[$csv_fields_keys[$j]];
            $tmp[$fieldname][$rowcounter+1] = $value;
            $tmp['cmd'][$rowcounter+1] = 'create';
            $tmp['checked'][$rowcounter+1] = 1;
            if(isset($vorlage))
            {
              foreach($vorlage as $k => $v)
              {
                $tmp[$v] = $k;
              }
            }
          }
        }
      }
      $number_of_rows = $rowcounter;
      fclose($handle);
      unlink($stueckliste_csv);
    }
    return $tmp;
  }


  function ImportvorlageDo($charset = "")
  {
    $id = $this->app->Secure->GetGET("id");
    $ziel = $this->app->DB->Select("SELECT ziel FROM importvorlage WHERE id='$id' LIMIT 1");
    //$fields = $this->ImportvorlageGetFields($id);
    
    //$fieldsinverse = $this->ImportvorlageGetFieldsInverse($id);
    //$vorlagen = $this->ImportvorlageGetVorlage($id);

    $fieldset = $this->ImportvorlageGetFieldsNew($id);
    
    $ekpreisaenderungen = 0;
    $vkpreisaenderungen = 0;

    $tmp = $this->app->Secure->GetPOST("row");


    $stueckliste_csv = $this->app->Secure->GetPOST("importdateiname");
    if($stueckliste_csv !="")
    {
      $tmp = $this->ImportvorlageGetCSV($stueckliste_csv,$id,$charset);
    }

    $ersterdatensatz = 1;
    $zeitstempel = time();

    $number_of_rows = count($tmp['cmd']);

    if(count($tmp['cmd']) >= 50) $number_of_rows = $number_of_rows + 2;

    for($i=1;$i<=$number_of_rows;$i++)
    {
      unset($felder);
      unset($lieferantid);
      unset($kundenid);
      unset($artikelid);
      unset($adressid);
      if($tmp['lieferantennummer'][$i]!="" && $tmp['kundennummer'][$i]!="NEW")
      {
        $lieferantid = $this->app->DB->Select("SELECT id FROM adresse WHERE lieferantennummer='".$tmp['lieferantennummer'][$i]."' 
            AND lieferantennummer!='' LIMIT 1");

      }

      if($tmp['kundennummer'][$i]!="" && $tmp['kundennummer'][$i]!="NEW")
      {
        $kundenid = $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='".$tmp['kundennummer'][$i]."' AND kundennummer!='' LIMIT 1");
      }

      if($kundenid<=0) $kundenid=0;
      if($lieferantid<=0) $lieferantid=0;

      if($lieferantid<=0 && $tmp['lieferantname'][$i]!="")
      {
        $lieferantid = $this->app->DB->Select("SELECT id FROM adresse WHERE name='".$tmp['lieferantname'][$i]."' LIMIT 1");
      }

      if($ziel!="adresse")
      {
        $artikelid = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='".$tmp['nummer'][$i]."' AND nummer!='' LIMIT 1");
      }
      
      if($ziel == "artikel")
      {
        foreach($fieldset as $k => $v)
        {
          $bedingung = "";
          $value = "";
          $fieldname = "";
          if(isset($fieldset[$k]['bedingung']))$bedingung = $fieldset[$k]['bedingung'];
          if(trim(strtolower($bedingung)) == 'unique')
          {
            if($v['field'] && isset($tmp[$v['field']]) && isset($tmp[$v['field']][$i]) && $tmp[$v['field']][$i])
            {
              if(!isset($artikelid) || !$artikelid)
                $artikelid = $this->app->DB->Select("SELECT id FROM artikel WHERE ".$v['field']."='".$tmp[$v['field']][$i]."' AND nummer!='' LIMIT 1");
              
            }
          }
        }
        
      }
      
      if($ziel == "adresse")
      {
        foreach($fieldset as $k => $v)
        {
          $bedingung = "";
          $value = "";
          $fieldname = "";
          if(isset($fieldset[$k]['bedingung']))$bedingung = $fieldset[$k]['bedingung'];
          if(trim(strtolower($bedingung)) == 'unique')
          {
            if($v['field'] && isset($tmp[$v['field']]) && isset($tmp[$v['field']][$i]) && $tmp[$v['field']][$i])
            {  
              $adressid = $this->app->DB->Select("SELECT id FROM adresse WHERE ".$v['field']."='".$tmp[$v['field']][$i]."' LIMIT 1");
              if($adressid)
              {
                if(isset($tmp['kundennummer'][$i]) && strtoupper(trim($tmp['kundennummer'][$i])) == 'NEW')
                {
                  $kundenid = $adressid;
                  $tmp['kundennummer'][$i] = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id = '$adressid' LIMIT 1");
                }
                if(isset($tmp['lieferantennummer'][$i]) && strtoupper(trim($tmp['lieferantennummer'][$i])) == 'NEW')
                {
                  $lieferantid = $adressid;
                  $tmp['lieferantennummer'][$i] = $this->app->DB->Select("SELECT lieferantennummer FROM adresse WHERE id = '$adressid' LIMIT 1");
                }
              }
            }
          }
        }
      }
      if($ziel == "einkauf")
      {
        foreach($fieldset as $k => $v)
        {
          $bedingung = "";
          $value = "";
          $fieldname = "";
          if(isset($fieldset[$k]['bedingung']))$bedingung = $fieldset[$k]['bedingung'];
          if(trim(strtolower($bedingung)) == 'sonstiges' && $v['field'] == 'lieferantennummer' && $tmp[$v['field']][$i] != '')
          {
            $tmp['lieferantennummer'][$i] = $this->app->DB->Select("SELECT lieferantennummer FROM adresse WHERE sonstiges='".$tmp[$v['field']][$i]."' LIMIT 1");
            $lieferantid = $this->app->DB->Select("SELECT id FROM adresse WHERE lieferantennummer='".$tmp['lieferantennummer'][$i]."' LIMIT 1");
            
          }
        }
      }

      switch($ziel)
      {
        case "einkauf":
        case "artikel":

          // pruefe ob es artikelnummer schon gibt
          if($artikelid > 0)
            $tmp['cmd'][$i]="update";

          // wenn es artikel nicht gibt muss man diesen neu anlegen
          if($tmp['cmd'][$i]=="create" && $tmp['checked'][$i]=="1")
          {
            if($tmp['name_de']!="")
            {
              /*foreach($fields as $key=>$value)
              {
                
                //$felder[$value]=html_entity_decode($this->app->erp->fixeUmlaute($tmp[$value][$i]));
                $felder[$value]=$tmp[$value][$i];
                if(isset($fieldinverse) && is_array($fieldinverse) && isset ($fieldinverse[$key]) && $fieldinverse[$key])
                {
                  if($felder[$value] != "1")
                  {
                    $felder[$value] = 1;
                  }elseif($felder[$value] == "1")
                  {
                    $felder[$value] = 0;
                  }
                }
              }
              if(isset($vorlagen))
              {
                foreach($vorlagen as $key => $value)
                {
                  $felder[$key] = $value;
                  
                }
                
                
              }*/
              
              foreach($fieldset as $k => $v)
              {
                $bedingung = "";
                $value = "";
                $fieldname = "";
                if(isset($v['bedingung']))$bedingung = $v['bedingung'];
                if(trim(strtolower($bedingung)) == 'unique')
                {

                  
                }
                if(isset($v['nr']))
                {
                  $value = trim($tmp[$v['field']][$i]);
                  if(isset($v['inv']))
                  {
                    if($value != "1")
                    {
                      $value = 1;
                    }else{
                      $value = 0;
                    }
                  }
                } elseif(isset($v['vorlage']))
                {
                  $value = $v['vorlage'];
                }
                if(isset($v['bedingung']))$value = $this->ImportvorlageBedingung($value, $v['bedingung']);
                $fieldname = $v['field'];
                $felder[$fieldname] = $value;
                $tmp[$fieldname][$i] = $value;
              }
              
              
              
            }

            if($tmp['nummer'][$i]=="")
            {
              $felder['nummer']=$this->app->erp->GetNextArtikelnummer($tmp['typ'][$i]);
            }
            else
            {
              $felder['nummer']=$tmp['nummer'][$i];
            }
            if($tmp['artikelbeschreibung_de'][$i]!="") $felder['anabregs_text'] = $tmp['artikelbeschreibung_de'][$i];
            if($tmp['artikelbeschreibung_en'][$i]!="") $felder['anabregs_text_en'] = $tmp['artikelbeschreibung_en'][$i];

            if(!is_numeric($tmp['projekt'][$i]))
            {
              $tmp['projekt'][$i] = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='".$tmp['projekt'][$i]."' AND abkuerzung!='' LIMIT 1");
              $felder['projekt'] = $tmp['projekt'][$i];
            }

            // ek preis
            if($lieferantid <=0 && $tmp['lieferantname'][$i]!="")
            {
              $lieferantid = $this->app->erp->CreateAdresse($tmp['lieferantname'][$i]);
              $this->app->erp->AddRolleZuAdresse($lieferantid, "Lieferant", "von","Projekt",$tmp['projekt'][$i]);
            }
            if($lieferantid>0)
              $felder['adresse']=$lieferantid;
            // mit welcher Artikelgruppe?
            $artikelid = $this->app->erp->ImportCreateArtikel($felder,false);


            // vk preis
            if($tmp['lieferanteinkaufnetto'][$i]!="" && $lieferantid > 0){

              if($tmp['lieferantbestellnummer'][$i]!="") $nr = $tmp['lieferantbestellnummer'][$i];
              else if($tmp['herstellernummer'][$i]!="") $nr = $tmp['herstellernummer'][$i];
              else $nr = $tmp['name_de'][$i];

              if($tmp['lieferanteinkaufvpemenge'][$i] > 0 && $tmp['lieferanteinkaufmenge'][$i]<=0)
                $tmp['lieferanteinkaufmenge'][$i] = $tmp['lieferanteinkaufvpemenge'][$i];

              if($tmp['lieferanteinkaufmenge'][$i] > 1)
              {
                $tmp['lieferanteinkaufnetto'][$i] = $tmp['lieferanteinkaufnetto'][$i] / $tmp['lieferanteinkaufmenge'][$i];
                $tmp['lieferanteinkaufmenge'][$i] = 1;
              }

              if($tmp['lieferanteinkaufmenge'][$i]<=0)
                $tmp['lieferanteinkaufmenge'][$i] = 1;
              if($artikelid && $lieferantid)
              {
                $aktlieferantid = $this->app->DB->Select("SELECT adresse FROM artikel WHERE id = '$artikelid'");
                if(!$aktlieferantid)$this->app->DB->Update("UPDATE artikel SET adresse = '$lieferantid' WHERE id = '$artikelid' LIMIT 1");
                
              }
              $bezeichnunglieferant = "";
              if($tmp['bezeichnunglieferant'][$i])
              {
                $bezeichnunglieferant = $this->app->DB->real_escape_string($tmp['bezeichnunglieferant'][$i]);
                if($tmp['bezeichnunglieferant2'][$i])$bezeichnunglieferant .= " ".$this->app->DB->real_escape_string($tmp['bezeichnunglieferant2'][$i]);
              }
              
              $this->app->erp->AddEinkaufspreis($artikelid,$tmp['lieferanteinkaufmenge'][$i],
                  $lieferantid,$nr,$bezeichnunglieferant,
                  str_replace(',','.',$tmp['lieferanteinkaufnetto'][$i]),$tmp['lieferanteinkaufwaehrung'][$i],$tmp['lieferanteinkaufvpemenge'][$i]);

            }

            if($tmp['verkaufspreis1netto'][$i]!=""){
              $gruppe = "";
              if(isset($tmp['verkaufspreis1gruppe'][$i]))$gruppe = $this->app->DB->Select("SELECT id FROM gruppen where kennziffer = '".$tmp['verkaufspreis1gruppe'][$i]."' AND art = 'preisgruppe' LIMIT 1");
              
              if(!is_numeric($tmp['verkaufspreis1menge'][$i])) $tmp['verkaufspreis1menge'][$i] = 1;
              
              if((float)str_replace(',','.',$tmp['verkaufspreis1netto'][$i]))
              {
                if($gruppe)
                {
                  $this->app->erp->AddVerkaufspreisGruppe($artikelid,$tmp['verkaufspreis1menge'][$i],$gruppe,str_replace(',','.',$tmp['verkaufspreis1netto'][$i]),$tmp['verkaufspreis1waehrung'][$i]);
                }else{
                  $this->app->erp->AddVerkaufspreis($artikelid,$tmp['verkaufspreis1menge'][$i],
                    $kundenid,str_replace(',','.',$tmp['verkaufspreis1netto'][$i]),$tmp['verkaufspreis1waehrung'][$i],"",$gruppe);
                }
              }
            }
            if($tmp['verkaufspreis2netto'][$i]!=""){
              $gruppe = "";
              if(isset($tmp['verkaufspreis2gruppe'][$i]))$gruppe = $this->app->DB->Select("SELECT id FROM gruppen where kennziffer = '".$tmp['verkaufspreis2gruppe'][$i]."' AND art = 'preisgruppe' LIMIT 1");
              if(!is_numeric($tmp['verkaufspreis2menge'][$i])) $tmp['verkaufspreis2menge'][$i] = 1;
              if((float)str_replace(',','.',$tmp['verkaufspreis2netto'][$i]))
              {
                if($gruppe)
                {
                  $this->app->erp->AddVerkaufspreisGruppe($artikelid,$tmp['verkaufspreis2menge'][$i],$gruppe,str_replace(',','.',$tmp['verkaufspreis2netto'][$i]),$tmp['verkaufspreis2waehrung'][$i]);
                }else{
                  $this->app->erp->AddVerkaufspreis($artikelid,$tmp['verkaufspreis2menge'][$i],
                    $kundenid,str_replace(',','.',$tmp['verkaufspreis2netto'][$i]),$tmp['verkaufspreis2waehrung'][$i],"",$gruppe);
                }
              }
            }

            if($tmp['verkaufspreis3netto'][$i]!=""){
              $gruppe = "";
              if(isset($tmp['verkaufspreis3gruppe'][$i]))$gruppe = $this->app->DB->Select("SELECT id FROM gruppen where kennziffer = '".$tmp['verkaufspreis3gruppe'][$i]."' AND art = 'preisgruppe' LIMIT 1");
              if(!is_numeric($tmp['verkaufspreis3menge'][$i])) $tmp['verkaufspreis3menge'][$i] = 1;
              if((float)str_replace(',','.',$tmp['verkaufspreis3netto'][$i]))
              {
                if($gruppe)
                {
                  $this->app->erp->AddVerkaufspreisGruppe($artikelid,$tmp['verkaufspreis3menge'][$i],$gruppe,str_replace(',','.',$tmp['verkaufspreis3netto'][$i]),$tmp['verkaufspreis3waehrung'][$i]);
                }else{
                  $this->app->erp->AddVerkaufspreis($artikelid,$tmp['verkaufspreis3menge'][$i],
                    $kundenid,str_replace(',','.',$tmp['verkaufspreis3netto'][$i]),$tmp['verkaufspreis3waehrung'][$i],"",$gruppe);
                }
              }
            }
            if($tmp['verkaufspreis4netto'][$i]!=""){
              $gruppe = "";
              if(isset($tmp['verkaufspreis4gruppe'][$i]))$gruppe = $this->app->DB->Select("SELECT id FROM gruppen where kennziffer = '".$tmp['verkaufspreis4gruppe'][$i]."' AND art = 'preisgruppe' LIMIT 1");
              if(!is_numeric($tmp['verkaufspreis4menge'][$i])) $tmp['verkaufspreis4menge'][$i] = 1;
              if((float)str_replace(',','.',$tmp['verkaufspreis4netto'][$i]))
              {
                if($gruppe)
                {
                  $this->app->erp->AddVerkaufspreisGruppe($artikelid,$tmp['verkaufspreis4menge'][$i],$gruppe,str_replace(',','.',$tmp['verkaufspreis4netto'][$i]),$tmp['verkaufspreis4waehrung'][$i]);
                }else{
                  $this->app->erp->AddVerkaufspreis($artikelid,$tmp['verkaufspreis4menge'][$i],
                    $kundenid,str_replace(',','.',$tmp['verkaufspreis4netto'][$i]),$tmp['verkaufspreis4waehrung'][$i],"",$gruppe);
                }
              }
            }
            if($tmp['variante_von'][$i]!="")
            {
              // schaue ob              
              $tmpartikelid = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='".$tmp['variante_von'][$i]."' AND nummer!='' LIMIT 1");
              if($tmpartikelid > 0)
              {
                $this->app->DB->Update("UPDATE artikel SET variante_von='".$tmpartikelid."',variante=1 
                    WHERE id='".$artikelid."' AND id!='".$tmpartikelid."' LIMIT 1");

              } 
            }
            
            if($tmp['einheit'][$i] != "" )
            {
              if($artikelid)$this->app->DB->Update("UPDATE artikel set einheit = '".$this->app->DB->real_escape_string($tmp['einheit'][$i])."' where id = '$artikelid' LIMIT 1");
            }
            
            if($tmp['stuecklisteexplodiert'][$i]!="")
            {
              if($artikelid)
              {
                $this->app->DB->Update("UPDATE artikel set juststueckliste = '".((int)$tmp['stuecklisteexplodiert'][$i])."' where id = '$artikelid' LIMIT 1");
                
                
              }
              
            }
            
            if($tmp['stuecklistevonartikel'][$i]!="" && $artikelid)
            {
              $tmpartikelid = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='".$tmp['stuecklistevonartikel'][$i]."' AND nummer!='' LIMIT 1"); 
              if($tmpartikelid > 0)
              {
                $this->app->DB->Update("UPDATE artikel set stueckliste = '1',typ='produktion' WHERE id = '$tmpartikelid' LIMIT 1");


                $stuecklistecheck = $this->app->DB->Select("SELECT id FROM stueckliste where stuecklistevonartikel = '$tmpartikelid' and artikel = '$artikelid' LIMIT 1");
                if(!$stuecklistecheck)
                {
                  $sort = 1 + (int)$this->app->DB->Select("SELECT max(sort) FROM stueckliste where stuecklistevonartikel = '$tmpartikelid' LIMIT 1");
                  $this->app->DB->Insert("INSERT INTO stueckliste (artikel, stuecklistevonartikel,menge,layer,place,sort,firma) values ('$artikelid','$tmpartikelid','1','$sort','Top','DP','1')");
                  $stuecklistecheck = $this->app->DB->GetInsertID();
                }
                
                if($stuecklistecheck)
                {
                  if(isset($tmp['stuecklistemenge'][$i]) && $tmp['stuecklistemenge'][$i] != "")
                  {
                    $einheit = $this->app->DB->Select("SELECT einheit FROM artikel where id = '$artikelid' LIMIT 1");
                    if($einheit == '' || $einheit == 'Stck' || $einheit == 'St')
                    {
                      $menge = (int)$tmp['stuecklistemenge'][$i];
                      if($menge <= 1)$menge = 1;            
                      $this->app->DB->Update("UPDATE stueckliste SET menge = '$menge' where id = '$stuecklistecheck' LIMIT 1");
                    }
                  }
                  if($tmp['stuecklistelayer'][$i] != "")
                  {
                    $layer = $this->app->DB->real_escape_string($tmp['stuecklistelayer'][$i]);
                    $this->app->DB->Update("UPDATE stueckliste SET layer = '$layer' where stuecklistevonartikel = '$tmpartikelid' and artikel = '$artikelid' LIMIT 1");
                  }
                  if($tmp['stuecklisteplace'][$i] != "")
                  {
                    $place = $this->app->DB->real_escape_string($tmp['stuecklisteplace'][$i]);
                    $this->app->DB->Update("UPDATE stueckliste SET place = '$place' where stuecklistevonartikel = '$tmpartikelid' and artikel = '$artikelid' LIMIT 1");
                  }                  
                }
              }
            }
            
            
            if($tmp['aktiv'][$i]=="1")
            {
              $this->app->DB->Update("UPDATE artikel SET inaktiv=0 WHERE id='".$artikelid."' LIMIT 1");
            } 
            if($tmp['aktiv'][$i]=="0")
            {
              $this->app->DB->Update("UPDATE artikel SET inaktiv=1 WHERE id='".$artikelid."' LIMIT 1");
            } 
            // prozentzeichen entfernen
            $tmp['umsatzsteuer'][$i] = str_replace('%','',$tmp['umsatzsteuer'][$i]);
            /*
               if($tmp[umsatzsteuer][$i]=="" || $tmp[umsatzsteuer][$i]=="19.00" || $this->app->erp->Firmendaten("steuersatz_normal")==$tmp[umsatzsteuer][$i] 
               || $tmp[umsatzsteuer][$i]=="19%" || $tmp[umsatzsteuer][$i]=="19.00%" || $tmp[umsatzsteuer][$i]=="19" || $tmp[umsatzsteuer][$i]=="normal")
               {
               } 
             */           
            // standard standardsteuersatz 
            $this->app->DB->Update("UPDATE artikel SET umsatzsteuer='normal' WHERE id='".$artikelid."' LIMIT 1");

            if($tmp['umsatzsteuer'][$i]=="7.00" || $tmp['umsatzsteuer'][$i]=="7%" || $tmp['umsatzsteuer'][$i]=="7.00%" || $tmp['umsatzsteuer'][$i]=="7" 
                || $this->app->erp->Firmendaten("steuersatz_ermaessigt")==$tmp['umsatzsteuer'][$i]
                || $tmp['umsatzsteuer'][$i]=="ermaessigt")
            {
              $this->app->DB->Update("UPDATE artikel SET umsatzsteuer='ermaessigt' WHERE id='".$artikelid."' LIMIT 1");
            } 

            // Artikelkategorie
            if($tmp['artikelkategorie'][$i]!="")
            {
              $tmp['typ'][$i] = $tmp['artikelkategorie'][$i];
            }
            if(is_numeric($tmp[typ][$i]))
            {
              $this->app->DB->Update("UPDATE artikel SET typ='".$tmp['typ'][$i]."_kat' WHERE id='".$artikelid."' LIMIT 1");
            } else {
              $this->app->DB->Update("UPDATE artikel SET typ='".$tmp['typ'][$i]."' WHERE id='".$artikelid."' LIMIT 1");
            }



            if($tmp['lager_platz'][$i]!=""){
              $lager_id = $this->app->DB->Select("SELECT lager FROM lager_platz WHERE kurzbezeichnung='".$tmp['lager_platz'][$i]."' AND kurzbezeichnung!=''");
              if($lager_id <=0)
              {
                $lager_id = $this->app->DB->Select("SELECT id FROM lager WHERE geloescht!='1' LIMIT 1");
              }
              $felder['lagerartikel']=1;
              $tmp['lagerartikel'][$i]=1;
              $this->app->DB->Update("UPDATE artikel SET lagerartikel='1' WHERE id='$artikelid' LIMIT 1");
              $regal = $this->app->erp->CreateLagerplatz($lager_id,$tmp['lager_platz'][$i]);
              $this->app->DB->Update("UPDATE artikel set lager_platz = '$regal' WHERE id = '$artikelid'");
              $this->app->erp->LagerEinlagernDifferenz($artikelid,$tmp['lager_menge'][$i],$regal,"","Erstbef&uuml;llung",1);
            }
            //17:lieferanteinkaufvpemenge;

          } else if ($tmp['cmd'][$i]=="update" && $tmp['checked'][$i]=="1") {

            // wenn er vorhanden ist nur ein Update braucht
            if($artikelid > 0)
            {
              //foreach($fields as $key=>$value)
              foreach($fieldset as $key=>$val)
              {
                
                $valu = $val['field'];
                
                $bedingung = "";
                $value = "";
                if(isset($val['bedingung']))$bedingung = $val['bedingung'];
                if(trim(strtolower($bedingung)) == 'unique')
                {

                  
                }
                if(isset($val['nr']))
                {
                  $value = trim($tmp[$valu][$i]);
                  if(isset($val['inv']))
                  {
                    if($value != "1")
                    {
                      $value = 1;
                    }else{
                      $value = 0;
                    }
                  }
                } elseif(isset($val['vorlage']))
                {
                  $value = $val['vorlage'];
                }
                if(isset($val['bedingung']))$value = $this->ImportvorlageBedingung($value, $val['bedingung']);
                $tmp[$valu][$i] = $value;
                $value = $valu;
              }
              
              
              
              
              foreach($fieldset as $key=>$val)
              {
                
                $value = $val['field'];
                
                
                switch($value)
                {
                  case "name_de":
                  case "name_en":
                  case "kurztext_en":
                  case "kurztext_de":
                  case "beschreibung_de":
                  case "beschreibung_en":
                  case "anabregs_text":
                  case "anabregs_text_en":
                  case "lagerartikel":
                  case "ean":
                  case "gewicht":
                  case "mindestlager":
                  case "umsatzsteuer":
                  case "gewicht":
                  case "hersteller":
                  case "internerkommentar":
                  case "herstellerlink":
                  case "herstellernummer":
                    $this->app->DB->Update("UPDATE artikel SET ".$value."='".$tmp[$value][$i]."' WHERE id='".$artikelid."' LIMIT 1");
                    break;
                  case "artikelkategorie":
                  case "typ":

                    if($tmp['artikelkategorie'][$i]!="")
                    {
                      $tmp['typ'][$i] = $tmp['artikelkategorie'][$i];
                    }
                    if(is_numeric($tmp['typ'][$i]))
                    {

                      $this->app->DB->Update("UPDATE artikel SET typ='".$tmp['typ'][$i]."_kat' WHERE id='".$artikelid."' LIMIT 1");
                    } else {
                      $this->app->DB->Update("UPDATE artikel SET typ='".$tmp['typ'][$i]."' WHERE id='".$artikelid."' LIMIT 1");
                    }

                    break;
                  case "stuecklistevonartikel":
                    if($tmp['stuecklistevonartikel'][$i]!="" && $artikelid)
                    {
                      
                      $tmpartikelid = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='".$tmp['stuecklistevonartikel'][$i]."' AND nummer!='' LIMIT 1"); 
                      
                      if($tmpartikelid > 0)
                      {
                        $this->app->DB->Update("UPDATE artikel set stueckliste = '1', typ='produktion' WHERE id = '$tmpartikelid' LIMIT 1");

                        $stuecklistecheck = $this->app->DB->Select("SELECT id FROM stueckliste where stuecklistevonartikel = '$tmpartikelid' and artikel = '$artikelid' LIMIT 1");
                        if(!$stuecklistecheck)
                        {
                          $sort = 1 + (int)$this->app->DB->Select("SELECT max(sort) FROM stueckliste where stuecklistevonartikel = '$tmpartikelid' LIMIT 1");
                          $this->app->DB->Insert("INSERT INTO stueckliste (artikel, stuecklistevonartikel,menge,layer,place,sort,firma) values ('$artikelid','$tmpartikelid','1','Top','DP','$sort','1')");
                          $stuecklistecheck = $this->app->DB->GetInsertID();
                        }
                        
                        if($stuecklistecheck)
                        {
                          if(isset($tmp['stuecklistemenge'][$i]) && $tmp['stuecklistemenge'][$i] != "")
                          {
                            $einheit = $this->app->DB->Select("SELECT einheit FROM artikel where id = '$artikelid' LIMIT 1");
                            
                            if($einheit == '' || $einheit == 'Stck' || $einheit == 'St')
                            {
                              $menge = (int)$tmp['stuecklistemenge'][$i];
                              if($menge <= 1)$menge = 1;            
                              $this->app->DB->Update("UPDATE stueckliste set menge = '$menge'  where id = '$stuecklistecheck' LIMIT 1");
                              
                            }
                          }
                          if($tmp['stuecklistelayer'][$i] != "")
                          {
                            $layer = $this->app->DB->real_escape_string($tmp['stuecklistelayer'][$i]);
                            $this->app->DB->Update("UPDATE stuecklistevonartikel SET layer = '$layer'  where stuecklistevonartikel = '$tmpartikelid' and artikel = '$artikelid' LIMIT 1");
                          }
                          if($tmp['stuecklisteplace'][$i] != "")
                          {
                            $place = $this->app->DB->real_escape_string($tmp['stuecklisteplace'][$i]);
                            $this->app->DB->Update("UPDATE stueckliste set place = '$place' where stuecklistevonartikel = '$tmpartikelid' and artikel = '$artikelid' LIMIT 1");
                          }                  
                        }
                      }
                    }
                  
                  break;
                  case "einheit":
                    if($tmp['einheit'][$i] != "")
                    {
                      if($artikelid)$this->app->DB->Update("UPDATE artikel SET einheit='".$this->app->DB->real_escape_string($tmp['einheit'][$i])."' WHERE id='".$artikelid."' LIMIT 1");
                    }
                  break;
                  case "umsatzsteuer":
                    if($tmp[$value][$i]=="" || $tmp[$value][$i]=="19.00" || 
                        $tmp[$value][$i]=="19%" || $tmp[$value][$i]=="19.00%" || $tmp[$value][$i]=="19")
                    {
                      $this->app->DB->Update("UPDATE artikel SET umsatzsteuer='normal' WHERE id='".$artikelid."' LIMIT 1");
                    } 
                    if($tmp[$value][$i]=="7.00" || $tmp[$value][$i]=="7%" || $tmp[$value][$i]=="7.00%" || $tmp[$value][$i]=="7")
                    {
                      $this->app->DB->Update("UPDATE artikel SET umsatzsteuer='ermaessigt' WHERE id='".$artikelid."' LIMIT 1");
                    } 
                    break;
                  case "aktiv":
                    if($tmp[$value][$i]=="0")
                      $this->app->DB->Update("UPDATE artikel SET inaktiv=1 WHERE id='".$artikelid."' LIMIT 1");
                    else
                      $this->app->DB->Update("UPDATE artikel SET inaktiv=0 WHERE id='".$artikelid."' LIMIT 1");
                    break;
                  case "variante_von":
                    if($tmp[$value][$i]!="")
                    {
                      // schaue ob              
                      $tmpartikelid = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='".$tmp[$value][$i]."' AND nummer!='' LIMIT 1");
                      if($tmpartikelid > 0)
                      {
                        $this->app->DB->Update("UPDATE artikel SET variante_von='".$tmpartikelid."',variante=1 
                            WHERE id='".$artikelid."' AND id!='".$tmpartikelid."' LIMIT 1");
                      } 
                    }
                    break;
                  case  "lieferanteinkaufnetto":
                    $alterek = $this->app->DB->Select("SELECT preis FROM einkaufspreise WHERE ab_menge='".$tmp['lieferanteinkaufmenge'][$i]."' 
                        AND (gueltig_bis='0000-00-00' OR gueltig_bis >=NOW()) AND adresse='".$lieferantid."' LIMIT 1");
                    if($alterek != str_replace(',','.',$tmp['lieferanteinkaufnetto'][$i]))
                    {
                      $ekpreisaenderungen++;
                      $this->app->DB->Update("UPDATE einkaufspreise SET gueltig_bis=DATE_SUB(NOW(),INTERVAL 1 DAY) 
                          WHERE adresse='".$lieferantid."' AND artikel='".$artikelid."' 
                          AND (gueltig_bis='0000-00-00' OR gueltig_bis >=NOW())
                          AND ab_menge='".$tmp['lieferanteinkaufmenge'][$i]."' LIMIT 1");

                      if($tmp['lieferantbestellnummer'][$i]!="") $nr = $tmp['lieferantbestellnummer'][$i];
                      else if($tmp['herstellernummer'][$i]!="") $nr = $tmp['herstellernummer'][$i];
                      else $nr = $tmp['name_de'][$i];

                      if($tmp['lieferanteinkaufvpemenge'][$i] > 0 && $tmp['lieferanteinkaufmenge'][$i]<=0)
                        $tmp['lieferanteinkaufmenge'][$i] = $tmp['lieferanteinkaufvpemenge'][$i];

                      if($tmp['lieferanteinkaufmenge'][$i] > 1)
                      {
                        //$tmp['lieferanteinkaufnetto'][$i] = $tmp['lieferanteinkaufnetto'][$i] / $tmp['lieferanteinkaufmenge'][$i]; // wieder raus
                        //$tmp['lieferanteinkaufmenge'][$i] = 1; // wieder raus
                      }

                      if($tmp['lieferanteinkaufmenge'][$i]<=0)
                        $tmp['lieferanteinkaufmenge'][$i] = 1;
                      if($artikelid && $lieferantid)
                      {
                        $aktlieferantid = $this->app->DB->Select("SELECT adresse FROM artikel WHERE id = '$artikelid' LIMIT 1");
                        if(!$aktlieferantid)$this->app->DB->Update("UPDATE artikel SET adresse = '$lieferantid' WHERE id = '$artikelid' LIMIT 1");
                        
                      }
                      $bezeichnunglieferant = "";
                      if($tmp['bezeichnunglieferant'][$i])
                      {
                        $bezeichnunglieferant = $this->app->DB->real_escape_string($tmp['bezeichnunglieferant'][$i]);
                        if($tmp['bezeichnunglieferant2'][$i])$bezeichnunglieferant .= " ".$this->app->DB->real_escape_string($tmp['bezeichnunglieferant2'][$i]);
                      }
                      
                      $this->app->erp->AddEinkaufspreis($artikelid,$tmp['lieferanteinkaufmenge'][$i],
                          $lieferantid,$nr,$bezeichnunglieferant,
                          str_replace(',','.',$tmp['lieferanteinkaufnetto'][$i]),$tmp['lieferanteinkaufwaehrung'][$i],$tmp['lieferanteinkaufvpemenge'][$i]);
                    } 
                    break;
                  case  "verkaufspreis1netto":
                    $gruppe = "";
                    if(isset($tmp['verkaufspreis1gruppe'][$i]))$gruppe = $this->app->DB->Select("SELECT id FROM gruppen where kennziffer = '".$tmp['verkaufspreis1gruppe'][$i]."' AND art = 'preisgruppe' LIMIT 1");

                    $altervk = $this->app->DB->Select("SELECT preis FROM verkaufspreise WHERE ab_menge='".$tmp['verkaufspreis1menge'][$i]."' 
                        AND (gueltig_bis='0000-00-00' OR gueltig_bis >=NOW() ) AND adresse <='$kundenid' ".($gruppe?" AND gruppe = '".$gruppe."'":" AND (is_null(gruppe) or gruppe = '') ")." LIMIT 1");
                    if($altervk != str_replace(',','.',$tmp['verkaufspreis1netto'][$i]) && str_replace(',','.',$tmp['verkaufspreis1netto'][$i]))
                    {
                      $vkpreisaenderungen++;
                      $this->app->DB->Update("UPDATE verkaufspreise SET gueltig_bis=DATE_SUB(NOW(),INTERVAL 1 DAY) 
                          WHERE artikel='".$artikelid."' AND adresse='$kundenid' ".($gruppe?" AND gruppe = '".$gruppe."'":" AND (is_null(gruppe) or gruppe = '') ")."
                          AND ab_menge='".$tmp['verkaufspreis1menge'][$i]."' LIMIT 1");
                      if($gruppe)
                      {
                        $this->app->erp->AddVerkaufspreisGruppe($artikelid,$tmp['verkaufspreis1menge'][$i],$gruppe,str_replace(',','.',$tmp['verkaufspreis1netto'][$i]),$tmp['verkaufspreis1waehrung'][$i]);
                      }else{
                        $this->app->erp->AddVerkaufspreis($artikelid,$tmp['verkaufspreis1menge'][$i],
                            $kundenid,str_replace(',','.',$tmp['verkaufspreis1netto'][$i]),$tmp['verkaufspreis1waehrung'][$i],"",$gruppe);
                      }
                    } 
                    break;
                  case  "verkaufspreis2netto":
                    
                    
                    $gruppe = "";
                    if(isset($tmp['verkaufspreis2gruppe'][$i]))
                    {
                      $gruppe = $this->app->DB->Select("SELECT id FROM gruppen where kennziffer = '".$tmp['verkaufspreis2gruppe'][$i]."' AND art = 'preisgruppe' LIMIT 1");
                    }

                    $altervk = $this->app->DB->Select("SELECT preis FROM verkaufspreise WHERE ab_menge='".$tmp['verkaufspreis2menge'][$i]."' 
                        AND (gueltig_bis='0000-00-00' OR gueltig_bis >=NOW() ) AND adresse <='$kundenid' ".($gruppe?" AND gruppe = '".$gruppe."'":" AND (is_null(gruppe) or gruppe = '') ")." LIMIT 1");

                    if($altervk != str_replace(',','.',$tmp['verkaufspreis2netto'][$i]) && str_replace(',','.',$tmp['verkaufspreis2netto'][$i]))
                    {
                      $vkpreisaenderungen++;
                      $this->app->DB->Update("UPDATE verkaufspreise SET gueltig_bis=DATE_SUB(NOW(),INTERVAL 1 DAY) 
                          WHERE artikel='".$artikelid."' AND adresse='$kundenid' ".($gruppe?" AND gruppe = '".$gruppe."'":" AND (is_null(gruppe) or gruppe = '') ")."
                          AND ab_menge='".$tmp['verkaufspreis2menge'][$i]."' LIMIT 1");
                      if($tmp['verkaufspreis2netto'][$i])
                      {
                        if($gruppe)
                        {
                          $this->app->erp->AddVerkaufspreisGruppe($artikelid,$tmp['verkaufspreis2menge'][$i],$gruppe,str_replace(',','.',$tmp['verkaufspreis2netto'][$i]),$tmp['verkaufspreis2waehrung'][$i]);
                        }else{
                          $this->app->erp->AddVerkaufspreis($artikelid,$tmp['verkaufspreis2menge'][$i],
                            $kundenid,str_replace(',','.',$tmp['verkaufspreis2netto'][$i]),$tmp['verkaufspreis2waehrung'][$i],"",$gruppe);
                        }                          
                      }

                    }
                    break;
                  case  "verkaufspreis3netto":
                    $gruppe = "";
                    if(isset($tmp['verkaufspreis3gruppe'][$i]))$gruppe = $this->app->DB->Select("SELECT id FROM gruppen where kennziffer = '".$tmp['verkaufspreis3gruppe'][$i]."' AND art = 'preisgruppe' LIMIT 1");
                  
                    $altervk = $this->app->DB->Select("SELECT preis FROM verkaufspreise WHERE ab_menge='".$tmp['verkaufspreis3menge'][$i]."' 
                        AND (gueltig_bis='0000-00-00' OR gueltig_bis >=NOW() ) AND adresse <='$kundenid' ".($gruppe?" AND gruppe = '".$gruppe."'":" AND (is_null(gruppe) or gruppe = '') ")." LIMIT 1");
                    if($altervk != str_replace(',','.',$tmp['verkaufspreis3netto'][$i]) && str_replace(',','.',$tmp['verkaufspreis3netto'][$i]))
                    {
                      $vkpreisaenderungen++;
                      $this->app->DB->Update("UPDATE verkaufspreise SET gueltig_bis=DATE_SUB(NOW(),INTERVAL 1 DAY) 
                          WHERE artikel='".$artikelid."' AND adresse='$kundenid' ".($gruppe?" AND gruppe = '".$gruppe."'":" AND (is_null(gruppe) or gruppe = '') ")."
                          AND ab_menge='".$tmp['verkaufspreis3menge'][$i]."' LIMIT 1");

                      if($tmp['verkaufspreis3netto'][$i])
                      {
                        if($gruppe)
                        {
                          $this->app->erp->AddVerkaufspreisGruppe($artikelid,$tmp['verkaufspreis3menge'][$i],$gruppe,str_replace(',','.',$tmp['verkaufspreis3netto'][$i]),$tmp['verkaufspreis3waehrung'][$i]);
                        }else{
                          $this->app->erp->AddVerkaufspreis($artikelid,$tmp['verkaufspreis3menge'][$i],
                            $kundenid,str_replace(',','.',$tmp['verkaufspreis3netto'][$i]),$tmp['verkaufspreis3waehrung'][$i],"",$gruppe);
                        }
                      }
                    } 
                    break;
                  case  "verkaufspreis4netto":
                    $gruppe = "";
                    if(isset($tmp['verkaufspreis4gruppe'][$i]))$gruppe = $this->app->DB->Select("SELECT id FROM gruppen where kennziffer = '".$tmp['verkaufspreis4gruppe'][$i]."' AND art = 'preisgruppe' LIMIT 1");
                  
                    $altervk = $this->app->DB->Select("SELECT preis FROM verkaufspreise WHERE ab_menge='".$tmp['verkaufspreis4menge'][$i]."' 
                        AND (gueltig_bis='0000-00-00' OR gueltig_bis >=NOW() ) AND adresse <='$kundenid' ".($gruppe?" AND gruppe = '".$gruppe."'":" AND (is_null(gruppe) or gruppe = '') ")." LIMIT 1");
                    if($altervk != str_replace(',','.',$tmp['verkaufspreis4netto'][$i]) && str_replace(',','.',$tmp['verkaufspreis4netto'][$i]))
                    {
                      $vkpreisaenderungen++;
                      $this->app->DB->Update("UPDATE verkaufspreise SET gueltig_bis=DATE_SUB(NOW(),INTERVAL 1 DAY) 
                          WHERE artikel='".$artikelid."' AND adresse='$kundenid' ".($gruppe?" AND gruppe = '".$gruppe."'":" AND (is_null(gruppe) or gruppe = '') ")."
                          AND ab_menge='".$tmp['verkaufspreis4menge'][$i]."' LIMIT 1");

                      if($tmp['verkaufspreis4netto'][$i])
                      {
                        if($gruppe)
                        {
                          $this->app->erp->AddVerkaufspreisGruppe($artikelid,$tmp['verkaufspreis4menge'][$i],$gruppe,str_replace(',','.',$tmp['verkaufspreis4netto'][$i]),$tmp['verkaufspreis4waehrung'][$i]);
                        }else{
                          $this->app->erp->AddVerkaufspreis($artikelid,$tmp['verkaufspreis4menge'][$i],
                            $kundenid,str_replace(',','.',$tmp['verkaufspreis4netto'][$i]),$tmp['verkaufspreis4waehrung'][$i],"",$gruppe);
                        }
                      }
                    } 
                    break;
                  case "lager_platz":
                    if($tmp['lager_platz'][$i]!=""){
                      $lager_id = $this->app->DB->Select("SELECT lager FROM lager_platz WHERE 
                          kurzbezeichnung='".$tmp['lager_platz'][$i]."' AND kurzbezeichnung!='' AND geloescht!='1' LIMIT 1");
                      if($lager_id <=0)
                      {
                        $lager_id = $this->app->DB->Select("SELECT id FROM lager WHERE geloescht!='1' LIMIT 1");
                      }
                      $felder['lagerartikel']=1;
                      $tmp['lagerartikel'][$i]=1;
                      $this->app->DB->Update("UPDATE artikel SET lagerartikel='1' WHERE id='$artikelid' LIMIT 1");
                      $regal = $this->app->erp->CreateLagerplatz($lager_id,$tmp['lager_platz'][$i]);
                      $this->app->DB->Update("UPDATE artikel SET lager_platz='$regal' WHERE id='$artikelid' LIMIT 1");
                      $this->app->erp->LagerEinlagernDifferenz($artikelid,$tmp['lager_menge'][$i],$regal,"","Erstbef&uuml;llung",1);
                    }
                    break; 

                }
              }
            }
          }     
          break;
        case "zeiterfassung":
          if($tmp['cmd'][$i]=="create" && $tmp['checked'][$i]=="1")
          {
            if($tmp['nummer'][$i]!="")
            {
              foreach($fieldset as $k => $v)
              {
                $bedingung = "";
                $value = "";
                $fieldname = "";
                if(isset($fieldset[$k]['bedingung']))$bedingung = $fieldset[$k]['bedingung'];
                if(trim(strtolower($bedingung)) == 'unique')
                {

                  
                }
                if(isset($v['nr']))
                {
                  $value = trim($tmp[$v['field']][$i]);
                  if(isset($v['inv']))
                  {
                    if($value != "1")
                    {
                      $value = 1;
                    }else{
                      $value = 0;
                    }
                  }
                } elseif(isset($v['vorlage']))
                {
                  $value = $v['vorlage'];
                }
                if(isset($v['bedingung']))$value = $this->ImportvorlageBedingung($value, $v['bedingung']);
                $fieldname = $v['field'];
                $felder[$fieldname] = $value;
                
              }
              
              
              
              
              
              
              //foreach($fields as $key=>$value)
                //$felder[$value]=$tmp[$value][$i];
              $adresse = $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='".$tmp['nummer'][$i]."' LIMIT 1");
            }
            $vonZeit = $felder['datum_von']." ".$felder['zeit_von'].":00";
            $bisZeit = $felder['datum_bis']." ".$felder['zeit_bis'].":00";
            $ort = "";
            $projekt = "";
            $art = "";
            $kunde = $adresse;
            if($felder['taetigkeit']=="")$felder[taetigkeit]="Zeiterfassung";
            $this->app->erp->AddArbeitszeit($this->app->User->GetID(), $vonZeit, $bisZeit, $felder['taetigkeit'], $felder['details'],$ort, $projekt, 0,$art,$kunde);
          }
          break;
        case "adresse":

          // wenn import per datei
          if($stueckliste_csv !="")
            $tmp['checked'][$i]=1;

          if(!is_numeric($tmp['projekt'][$i]) && $tmp['projekt'][$i]!="")
          {
            $tmp['projekt'][$i] = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='".$tmp['projekt'][$i]."' AND abkuerzung!='' LIMIT 1");
            $felder['projekt'] = $tmp['projekt'][$i];
          }

          // automatisch create und update erkennen
          if($tmp['kundennummer'][$i]=="" && $tmp['lieferantennummer'][$i]=="" && $tmp['name'][$i]=="")
          {
            $tmp['cmd'][$i]="none";
            $tmp['checked'][$i]=0;
          }
          else if($tmp['kundennummer'][$i]=="" && $tmp['name'][$i]!="" && $tmp['lieferantennummer'][$i]=="")
          {
            $tmp['cmd'][$i]="create";
          }
          else if($tmp['lieferantennummer'][$i]!="" || $tmp['kundennummer'][$i]!="")
          {
            $checkkunde = $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='".$tmp['kundennummer'][$i]."' AND kundennummer!='' LIMIT 1");
            if($checkkunde <= 0)
              $tmp['cmd'][$i]="create";
            else 
              $tmp['cmd'][$i]="update";

            if($checkkunde <= 0)
            {
              $checklieferant = $this->app->DB->Select("SELECT id FROM adresse WHERE lieferantennummer='".$tmp['lieferantennummer'][$i]."' AND lieferantennummer!='' LIMIT 1");
              if($checklieferant <= 0)
                $tmp['cmd'][$i]="create";
              else 
                $tmp['cmd'][$i]="update";
            }
          }

          // automatisch create und update erkennen

          if($tmp['cmd'][$i]=="create" && $tmp['checked'][$i]=="1")
          {
            $adresse=0;
            
            
            foreach($fieldset as $k => $v)
            {
              $bedingung = "";
              $value = "";
              $fieldname = "";
              if(isset($v['bedingung']))$bedingung = $v['bedingung'];
              if(trim(strtolower($bedingung)) == 'unique')
              {
                
              }
              if(isset($v['nr']))
              {
                $value = trim($tmp[$v['field']][$i]);
                if(isset($v['inv']))
                {
                  if($value != "1")
                  {
                    $value = 1;
                  }else{
                    $value = 0;
                  }
                }
              } elseif(isset($v['vorlage']))
              {
                $value = $v['vorlage'];
              }
              if(isset($v['bedingung']))$value = $this->ImportvorlageBedingung($value, $v['bedingung']);
              $fieldname = $v['field'];
              $felder[$fieldname] = $value;
              
            }
            
            
            /*foreach($fields as $key=>$value)
            {
              $felder[$value]=trim($tmp[$value][$i]);
              if(isset($fieldinverse) && is_array($fieldinverse) && isset ($fieldinverse[$key]) && $fieldinverse[$key])
              {
                if($felder[$value] != "1")
                {
                  $felder[$value] = 1;
                }elseif($felder[$value] == "1")
                {
                  $felder[$value] = 0;
                }
              }
              if(isset($vorlagen))
              {
                foreach($vorlagen as $key => $value)
                {
                  $felder[$key] = $value;
                  
                }
              }
            }*/

            if(($tmp['kundennummer'][$i]!="" && $tmp['kundennummer'][$i]!="NEW") || ($tmp['lieferantennummer'][$i]!="" && $tmp['lieferantennummer'][$i]!="NEW"))
            {
              $adresse = $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='".$tmp['kundennummer'][$i]."' AND kundennummer!='' LIMIT 1");
              if($adresse <=0)
                $adresse = $this->app->DB->Select("SELECT id FROM adresse WHERE lieferantennummer='".$tmp['lieferantennummer'][$i]."' AND lieferantennummer!='' LIMIT 1");
            }

            if($felder['name']!="" || $felder['firma']!="")
            { 
              $felder['strasse'] = $felder['strasse']." ".$felder['hausnummer'];
              if($felder['strasse_hausnummer']!="") $felder['strasse'] = $felder['strasse_hausnummer'];

              $felder['email'] = str_replace(" ","",$felder['email']);

              $felder['sprache'] = strtoupper($felder['sprache']);
              $felder['typ'] = strtolower($felder['typ']);

              switch(strtoupper($felder['typ']))
              {
                case "mr": $felder['typ']="herr"; break;
                case "mr.": $felder['typ']="herr"; break;
                case "ms": $felder['typ']="frau"; break;
                case "mrs": $felder['typ']="frau"; break;
                case "mrs.": $felder['typ']="frau"; break;
              }

              if($felder['land']=="") $felder['land']="DE";

              if($felder['geburtstag']!="")
              {
                if(strpos($felder['geburtstag'],'.')!==false) {
                  $felder['geburtstag'] = $this->app->String->Convert($felder['geburtstag'],"%1.%2.%3","%3-%2-%1");
                }
              }

              if($felder['plz_ort']!="")
              {
                // Ausgabe: @example.com
                $felder['plz'] = strstr($felder['plz_ort'], ' ', true); 
                $felder['ort'] = strstr($felder['plz_ort'], ' '); 
              }



              if($felder['firma']!="")
              {
                if($felder['vorname']!="")
                  $felder['ansprechpartner']=$felder['vorname']." ".$felder['name'];
                else
                  $felder['ansprechpartner']=$felder['name'];

                $felder['name']=$felder['firma'];
                $felder['typ']='firma';
              } else 
                if($felder['vorname']!="" && $felder['nachname']=="")
                  $felder['name']=$felder['vorname']." ".$felder['name'];

              $als_ansprechpartner_speichern = false;
              //pruefe ob datensatz ein ansprechpartner werden soll
              if($felder['lieferantennummer']!=str_replace("ANSPRECHPARTNER","",$felder['lieferantennummer'])) 
              {
                // Dieser Datensatz wird als ansprechpartner verwendet
                $als_ansprechpartner_speichern = true;
                $ermittle_adresse = str_replace("ANSPRECHPARTNER","",$felder['lieferantennummer']);
                $ermittle_adresse = rtrim(ltrim($ermittle_adresse," :"));
                $adresse = $this->app->DB->Select("SELECT id FROM adresse WHERE lieferantennummer='$ermittle_adresse' AND lieferantennummer!='' LIMIT 1");

                if($tmp['strasse_hausnummer'][$i]!="") $tmp['strasse'][$i] = $felder['strasse_hausnummer'];
                $tmp['typ'][$i] = $felder['typ'];
                $tmp['name'][$i] = $felder['name'];

                $data_fields = array('typ','name','abteilung','unterabteilung','adresszusatz','titel','strasse','ort','plz',
                    'land','telefon','telefax','email','mobil','anschreiben');
                foreach($data_fields as $tmp_key=>$data_field_key)
                {
                  $data_ansprechpartner[$data_field_key] = $tmp[$data_field_key][$i];
                }
                $this->app->erp->ImportCreateAnsprechpartner($adresse,$data_ansprechpartner);
              }
              else if($felder['kundennummer']!=str_replace("ANSPRECHPARTNER","",$felder['kundennummer'])) 
              {
                // Dieser Datensatz wird als ansprechpartner verwendet
                $als_ansprechpartner_speichern = true;
                $ermittle_adresse = str_replace("ANSPRECHPARTNER","",$felder['kundennummer']);
                $ermittle_adresse = rtrim(ltrim($ermittle_adresse," :"));
                $adresse = $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='$ermittle_adresse' AND kundennummer!='' LIMIT 1");

                if($tmp['strasse_hausnummer'][$i]!="") $tmp['strasse'][$i] = $felder['strasse_hausnummer'];
                $tmp['typ'][$i] = $felder['typ'];
                $tmp['name'][$i] = $felder['name'];

                $data_fields = array('typ','name','abteilung','unterabteilung','adresszusatz','titel','strasse','ort','plz',
                    'land','telefon','telefax','email','mobil','anschreiben');
                foreach($data_fields as $tmp_key=>$data_field_key)
                {
                  $data_ansprechpartner[$data_field_key] = $tmp[$data_field_key][$i];
                }
                $this->app->erp->ImportCreateAnsprechpartner($adresse,$data_ansprechpartner);
              } 
                else {
                $loeschen_lfr_new=false;
                if(strtoupper($felder['lieferantennummer'])=="NEW" || strtoupper($felder['lieferantennummer'])=="NEU")
                  $loeschen_lfr_new=true;

                $loeschen_kd_new=false;
                if(strtoupper($felder['kundennummer'])=="NEW" || strtoupper($felder['kundennummer'])=="NEU" )
                  $loeschen_kd_new=true;

                if($loeschen_lfr_new) $felder['lieferantennummer']="";
                if($loeschen_kd_new) $felder['kundennummer']="";
                $adresse =$this->app->erp->ImportCreateAdresse($felder, false);
                $this->app->erp->ImportvorlageLog($id,$zeitstempel,"adresse",$adresse,$ersterdatensatz);
                $ersterdatensatz=0;

                if($felder['lieferantennummer']!="" || $loeschen_lfr_new)
                {
                  $this->app->erp->AddRolleZuAdresse($adresse, "Lieferant", "von","Projekt",$tmp[projekt][$i]);
                }
                if($felder['kundennummer']!="" || $loeschen_kd_new)
                {
                  $this->app->erp->AddRolleZuAdresse($adresse, "Kunde", "von","Projekt",$tmp[projekt][$i]);
                }
              }
              // Ansprechpartner automatisch anlegen

              if($felder['ansprechpartner1name']!="" && !$als_ansprechpartner_speichern)
              {
                unset($data);
                $data['name']=$felder['ansprechpartner1name'];
                $data['strasse']=$felder['ansprechpartner1strasse'];
                $data['sprache']=$felder['ansprechpartner1sprache'];
                $data['bereich']=$felder['ansprechpartner1bereich'];
                $data['abteilung']=$felder['ansprechpartner1abteilung'];
                $data['unterabteilung']=$felder['ansprechpartner1unterabteilung'];
                $data['land']=$felder['ansprechpartner1land'];
                $data['ort']=$felder['ansprechpartner1ort'];
                $data['plz']=$felder['ansprechpartner1plz'];
                $data['telefon']=$felder['ansprechpartner1telefon'];
                $data['telefax']=$felder['ansprechpartner1telefax'];
                $data['mobil']=$felder['ansprechpartner1mobil'];
                $data['email']=$felder['ansprechpartner1email'];
                $data['sonstiges']=$felder['ansprechpartner1sonstiges'];
                $data['adresszusatz']=$felder['ansprechpartner1adresszusatz'];
                $data['ansprechpartner_land']=$felder['ansprechpartner1ansprechpartner_land'];
                $data['anschreiben']=$felder['ansprechpartner1anschreiben'];
                $data['titel']=$felder['ansprechpartner1titel'];
                $this->app->erp->CreateAnsprechpartner($adresse,$data);
              }


              if($felder['ansprechpartner2name']!="" && !$als_ansprechpartner_speichern )
              {
                unset($data);
                $data['name']=$felder['ansprechpartner2name'];
                $data['strasse']=$felder['ansprechpartner2strasse'];
                $data['sprache']=$felder['ansprechpartner2sprache'];
                $data['bereich']=$felder['ansprechpartner2bereich'];
                $data['abteilung']=$felder['ansprechpartner2abteilung'];
                $data['unterabteilung']=$felder['ansprechpartner2unterabteilung'];
                $data['land']=$felder['ansprechpartner2land'];
                $data['ort']=$felder['ansprechpartner2ort'];
                $data['plz']=$felder['ansprechpartner2plz'];
                $data['telefon']=$felder['ansprechpartner2telefon'];
                $data['telefax']=$felder['ansprechpartner2telefax'];
                $data['mobil']=$felder['ansprechpartner2mobil'];
                $data['email']=$felder['ansprechpartner2email'];
                $data['sonstiges']=$felder['ansprechpartner2sonstiges'];
                $data['adresszusatz']=$felder['ansprechpartner2adresszusatz'];
                $data['ansprechpartner_land']=$felder['ansprechpartner2ansprechpartner_land'];
                $data['anschreiben']=$felder['ansprechpartner2anschreiben'];
                $data['titel']=$felder['ansprechpartner2titel'];
                $this->app->erp->CreateAnsprechpartner($adresse,$data);
              }

              if($felder['ansprechpartner3name']!="" && !$als_ansprechpartner_speichern )
              {
                unset($data);
                $data['name']=$felder['ansprechpartner3name'];
                $data['strasse']=$felder['ansprechpartner3strasse'];
                $data['sprache']=$felder['ansprechpartner3sprache'];
                $data['bereich']=$felder['ansprechpartner3bereich'];
                $data['abteilung']=$felder['ansprechpartner3abteilung'];
                $data['unterabteilung']=$felder['ansprechpartner3unterabteilung'];
                $data['land']=$felder['ansprechpartner3land'];
                $data['ort']=$felder['ansprechpartner3ort'];
                $data['plz']=$felder['ansprechpartner3plz'];
                $data['telefon']=$felder['ansprechpartner3telefon'];
                $data['telefax']=$felder['ansprechpartner3telefax'];
                $data['mobil']=$felder['ansprechpartner3mobil'];
                $data['email']=$felder['ansprechpartner3email'];
                $data['sonstiges']=$felder['ansprechpartner3sonstiges'];
                $data['adresszusatz']=$felder['ansprechpartner3adresszusatz'];
                $data['ansprechpartner_land']=$felder['ansprechpartner3ansprechpartner_land'];
                $data['anschreiben']=$felder['ansprechpartner3anschreiben'];
                $data['titel']=$felder['ansprechpartner3titel'];
                $this->app->erp->CreateAnsprechpartner($adresse,$data);
              }

              if($felder['lieferadresse1name']!="")
              {
                unset($data);
                $data['name']=$felder['lieferadresse1name'];
                $data['strasse']=$felder['lieferadresse1strasse'];
                $data['abteilung']=$felder['lieferadresse1abteilung'];
                $data['unterabteilung']=$felder['lieferadresse1unterabteilung'];
                $data['land']=$felder['lieferadresse1land'];
                $data['ort']=$felder['lieferadresse1ort'];
                $data['plz']=$felder['lieferadresse1plz'];
                $data['telefon']=$felder['lieferadresse1telefon'];
                $data['telefax']=$felder['lieferadresse1telefax'];
                $data['email']=$felder['lieferadresse1email'];
                $data['sonstiges']=$felder['lieferadresse1sonstiges'];
                $data['adresszusatz']=$felder['lieferadresse1adresszusatz'];
                $data['ansprechpartner']=$felder['lieferadresse1ansprechpartner'];
                $data['standardlieferadresse']=$felder['lieferadresse1standardlieferadresse'];
                $this->app->erp->CreateLieferadresse($adresse,$data);
              }

              if($felder['lieferadresse2name']!="")
              {
                unset($data);
                $data['name']=$felder['lieferadresse2name'];
                $data['strasse']=$felder['lieferadresse2strasse'];
                $data['abteilung']=$felder['lieferadresse2abteilung'];
                $data['unterabteilung']=$felder['lieferadresse2unterabteilung'];
                $data['land']=$felder['lieferadresse2land'];
                $data['ort']=$felder['lieferadresse2ort'];
                $data['plz']=$felder['lieferadresse2plz'];
                $data['telefon']=$felder['lieferadresse2telefon'];
                $data['telefax']=$felder['lieferadresse2telefax'];
                $data['email']=$felder['lieferadresse2email'];
                $data['sonstiges']=$felder['lieferadresse2sonstiges'];
                $data['adresszusatz']=$felder['lieferadresse2adresszusatz'];
                $data['ansprechpartner']=$felder['lieferadresse2ansprechpartner'];
                $data['standardlieferadresse']=$felder['lieferadresse2standardlieferadresse'];
                $this->app->erp->CreateLieferadresse($adresse,$data);
              }

              if($felder['lieferadresse3name']!="")
              {
                unset($data);
                $data['name']=$felder['lieferadresse3name'];
                $data['strasse']=$felder['lieferadresse3strasse'];
                $data['abteilung']=$felder['lieferadresse3abteilung'];
                $data['unterabteilung']=$felder['lieferadresse3unterabteilung'];
                $data['land']=$felder['lieferadresse3land'];
                $data['ort']=$felder['lieferadresse3ort'];
                $data['plz']=$felder['lieferadresse3plz'];
                $data['telefon']=$felder['lieferadresse3telefon'];
                $data['telefax']=$felder['lieferadresse3telefax'];
                $data['email']=$felder['lieferadresse3email'];
                $data['sonstiges']=$felder['lieferadresse3sonstiges'];
                $data['adresszusatz']=$felder['lieferadresse3adresszusatz'];
                $data['ansprechpartner']=$felder['lieferadresse3ansprechpartner'];
                $data['standardlieferadresse']=$felder['lieferadresse3standardlieferadresse'];
                $this->app->erp->CreateLieferadresse($adresse,$data);
              }

              //rolle verpassen
            }



            if($tmp['liefername'][$i]!="")
            {
              $tmp['liefername'][$i] = $tmp['liefervorname'][$i]." ".$tmp['liefername'][$i];
              $tmp['lieferstrasse'][$i] = $tmp['lieferstrasse'][$i]." ".$tmp['lieferhausnummer'][$i];

              if($tmp['lieferfirma'][$i]!="")
              {
                $tmp['lieferadresszusatz'][$i]=$tmp['liefervorname'][$i]." ".$tmp['liefername'][$i];
                $tmp['liefername'][$i]=$tmp['lieferfirma'][$i];
                $tmp['liefertyp'][$i]='firma';
              }

              $this->app->DB->Insert("INSERT INTO lieferadressen 
                  (id,name,abteilung,unterabteilung,land,strasse,ort,plz,telefon,telefax,email,ansprechpartner,adresse,typ,adresszusatz,standardlieferadresse)
                  VALUES ('','{$tmp['liefername'][$i]}','{$tmp['lieferabteilung'][$i]}','{$tmp['lieferunterabteilung'][$i]}',
                    '{$tmp['lieferland'][$i]}','{$tmp['lieferstrasse'][$i]}','{$tmp['lieferort'][$i]}',
                    '{$tmp['lieferplz'][$i]}','{$tmp['liefertelefon'][$i]}','{$tmp['liefertelefax'][$i]}','{$tmp['lieferemail'][$i]}',
                    '{$tmp['lieferansprechpartner'][$i]}','$adresse','{$tmp['liefertyp'][$i]}','{$tmp['lieferadresszusatz'][$i]}',1)");
            }
          }
          else if($tmp['cmd'][$i]=="update" && $tmp['checked'][$i]=="1")
          {
            $adresse=0;
            //            foreach($fields as $key=>$value)
            //              $felder[$value]=$tmp[$value][$i];

            if($tmp['kundennummer'][$i]!="" || $tmp['lieferantennummer'][$i]!="")
            {
              $adresse = $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='".$tmp['kundennummer'][$i]."' AND kundennummer!='' LIMIT 1");
              if($adresse <=0)
                $adresse = $this->app->DB->Select("SELECT id FROM adresse WHERE lieferantennummer='".$tmp['lieferantennummer'][$i]."' AND lieferantennummer!='' LIMIT 1");
            }
            if($adresse > 0)
            {
              $fields_tmp = "";
              
              foreach($fieldset as $k => $v)
              {
                $bedingung = "";
                $value = "";
                $fieldname = "";
                if(isset($fieldset[$k]['bedingung']))$bedingung = $fieldset[$k]['bedingung'];
                if(trim(strtolower($bedingung)) == 'unique')
                {
                  
                }
                if(isset($fieldset[$k]['nr']))
                {
                  $value = trim($data[$fieldset[$k]['nr'] - 1]);
                  if(isset($fieldset[$k]['inv']))
                  {
                    if($value != "1")
                    {
                      $value = 1;
                    }else{
                      $value = 0;
                    }
                  }
                } elseif(isset($fieldset[$k]['vorlage']))
                {
                  $value = $fieldset[$k]['vorlage'];
                }
                if(isset($fieldset[$k]['bedingung']))$value = $this->ImportvorlageBedingung($value, $fieldset[$k]['bedingung']);
                $fieldname = $fieldset[$k]['field'];
                $felder[$fieldname] = $value;
                
                $key = $fieldname;
                $value = $fieldname;
                
                $felder[$key]=$tmp[$value][$i];
                if($key=="typ" || $key=="zahlungsweise") $tmp[$value][$i] = strtolower($tmp[$value][$i]);

                if($key=="typ")
                {
                  switch($tmp[$value][$i])
                  {
                    case "mr": $tmp[$value][$i]="herr"; break;
                    case "mr.": $tmp[$value][$i]="herr"; break;
                    case "mrs": $tmp[$value][$i]="frau"; break;
                    case "mrs.": $tmp[$value][$i]="frau"; break;
                  }
                }

                if($key=="land") {
                  if($tmp[$value][$i]=="Deutschland" || $tmp[$value][$i]=="Germany" || $tmp[$value][$i]=="")
                    $tmp[$value][$i] = "DE";
                }

                if($key=="geburtstag")
                {
                  if(strpos($tmp[$value][$i],'.')!==false) {
                    $tmp[$value][$i] = $this->app->String->Convert($tmp[$value][$i],"%1.%2.%3","%3-%2-%1");
                  }
                }
                //if($fields_tmp!="") $fields_tmp .= ",";
                //$fields_tmp = " ".$fields[$key]."='".$tmp[$value][$i]."' ";
                $fields_tmp = " ".$v['field']."='".$tmp[$value][$i]."' ";
                $this->app->DB->Update("UPDATE adresse SET $fields_tmp WHERE id='$adresse' LIMIT 1");
                
              }
              
              /*
              foreach($fields as $key=>$value)
              {
                $felder[$key]=$tmp[$value][$i];
                if($key=="typ" || $key=="zahlungsweise") $tmp[$value][$i] = strtolower($tmp[$value][$i]);

                if($key=="typ")
                {
                  switch($tmp[$value][$i])
                  {
                    case "mr": $tmp[$value][$i]="herr"; break;
                    case "mr.": $tmp[$value][$i]="herr"; break;
                    case "mrs": $tmp[$value][$i]="frau"; break;
                    case "mrs.": $tmp[$value][$i]="frau"; break;
                  }
                }

                if($key=="land") {
                  if($tmp[$value][$i]=="Deutschland" || $tmp[$value][$i]=="Germany" || $tmp[$value][$i]=="")
                    $tmp[$value][$i] = "DE";
                }

                if($key=="geburtstag")
                {
                  if(strpos($tmp[$value][$i],'.')!==false) {
                    $tmp[$value][$i] = $this->app->String->Convert($tmp[$value][$i],"%1.%2.%3","%3-%2-%1");
                  }
                }
                //if($fields_tmp!="") $fields_tmp .= ",";
                $fields_tmp = " ".$fields[$key]."='".$tmp[$value][$i]."' ";
                $this->app->DB->Update("UPDATE adresse SET $fields_tmp WHERE id='$adresse' LIMIT 1");
              }*/
            }
          }
          break;
      }
    }
    if($ziel=="zeiterfassung")
    {
      $msg=$this->app->erp->base64_url_encode("<div class=\"info\">Import durchgef&uuml;hrt.</div>");
      header("Location: index.php?module=importvorlage&action=import&id=$id&msg=$msg");
      exit;
    } else {    
      $msg=$this->app->erp->base64_url_encode("<div class=\"info\">Import durchgef&uuml;hrt.</div>");
      header("Location: index.php?module=importvorlage&action=import&id=$id&msg=$msg");
      exit;
    }
  }
  
  function ImportvorlageBedingung($value, $bedingung)
  {
    if(strpos($bedingung,'?') !== false && strpos($bedingung,':') !== false)
    {
      $beda = explode('?',$bedingung,2);
      $beda[1] = trim(trim($beda[1]),'"');
      $beda[1] = str_replace('%value%',$value,$beda[1]);
      
      $beda2 = explode(':',$beda[1],2);
      if(isset($beda2[1]))
      {
        $beda[1] = $beda2[0];
        $beda2[1] = trim(trim($beda2[1]),'"');
        $beda2[1] = str_replace('%value%',$value,$beda2[1]);
        if(strpos($beda[0],'>=') !== false)
        {
          $beda3 = explode('>=',$beda[0],2);
          $beda3[1] = trim(trim($beda3[1]),'"');          
          if(trim(trim($value),'"') >= trim(trim($beda3[1]),'"'))
          {
            return $beda[1];
          }else{
            return $beda2[1];
          }
          
        }elseif(strpos($beda[0],'<=') !== false)
        {
          $beda3 = explode('<=',$beda[0],2);
          $beda3[1] = trim(trim($beda3[1]),'"');          
          if(trim(trim($value),'"') <= trim(trim($beda3[1]),'"'))
          {
            return $beda[1];
          }else{
            return $beda2[1];
          }        
        }elseif(strpos($beda[0],'>') !== false)
        {
          $beda3 = explode('>',$beda[0],2);
          $beda3[1] = trim(trim($beda3[1]),'"');          
          if(trim(trim($value),'"') > trim(trim($beda3[1]),'"'))
          {
            return $beda[1];
          }else{
            return $beda2[1];
          }
          
        }elseif(strpos($beda[0],'<') !== false)
        {
          $beda3 = explode('<',$beda[0],2);
          $beda3[1] = trim(trim($beda3[1]),'"');          
          if(trim(trim($value),'"') < trim(trim($beda3[1]),'"'))
          {
            return $beda[1];
          }else{
            return $beda2[1];
          }
        }elseif(strpos($beda[0],'!=') !== false)
        {
          $beda3 = explode('!=',$beda[0],2);
          $beda3[1] = trim(trim($beda3[1]),'"');          
          if(trim(trim($value),'"') != trim(trim($beda3[1]),'"'))
          {
            return $beda[1];
          }else{
            return $beda2[1];
          }
        }elseif(strpos($beda[0],'==') !== false)
        {
          $beda3 = explode('==',$beda[0],2);
          $beda3[1] = trim(trim($beda3[1]),'"');          
          if(trim(trim($value),'"') == trim(trim($beda3[1]),'"'))
          {
            return $beda[1];
          }else{
            return $beda2[1];
          }
        }elseif(strpos($beda[0],'=') !== false)
        {
          $beda3 = explode('=',$beda[0],2);
          $beda3[1] = trim(trim($beda3[1]),'"');          
          if(trim(trim($value),'"') == trim(trim($beda3[1]),'"'))
          {
            return $beda[1];
          }else{
            return $beda2[1];
          }
        }
      }
    }else{
      
    }     
    
    
    return $value;
  }


  //function ImportPrepareHeader($ziel,$csv_fields_keys,$csv_fields, $vorlage = null)
  function ImportPrepareHeader($ziel,$fieldset)
  {
    //$number_of_fields =count($csv_fields_keys);
    $number_of_fields =count($fieldset);

    switch($ziel)
    {
      case "einkauf":
      case "artikel":
        $this->app->Tpl->Add('ERGEBNIS','<tr><td width="100"><b>Auswahl</b></td><td width="100"><b>Aktion</b></td><td><b>Artikel</b></td>');
        break;
      case "adresse":
        $this->app->Tpl->Add('ERGEBNIS','<tr><td width="100"><b>Auswahl</b></td><td width="100"><b>Aktion</b></td><td><b>Adresse</b></td>');
        break;

      case "zeiterfassung":
        $this->app->Tpl->Add('ERGEBNIS','<tr><td width="100"><b>Auswahl</b></td>
            <td width="100"><b>Aktion</b></td><td><b>Kunde</b></td>');
        break;
    }

    for($j=0;$j<$number_of_fields;$j++)
    {
      //$this->app->Tpl->Add('ERGEBNIS','<td><b>'.$csv_fields[($csv_fields_keys[$j])].'</b></td>');
      if(isset($fieldset[$j]) && isset($fieldset[$j]['field']))$this->app->Tpl->Add('ERGEBNIS','<td><b>'.$fieldset[$j]['field'].'</b></td>');
    }
    /*
    if($vorlage && is_array($vorlage) && count($vorlage) > 0)
    {
      foreach($vorlage as $k => $val)
      {
        $this->app->Tpl->Add('ERGEBNIS','<td><b>'.$k.'</b></td>');
      }
    }*/
    $this->app->Tpl->Add('ERGEBNIS','</tr>');
  }

  //function ImportPrepareRow($rowcounter,$ziel,$data,$csv_fields_keys,$csv_fields,$fieldsinverse = null, $vorlage = null)
  function ImportPrepareRow($rowcounter,$ziel,$data,$fieldset)
  {
    //$number_of_fields =count($csv_fields_keys);
    $number_of_fields =count($fieldset);
    //Standard
    $fields['waehrung'] = 'EUR';

    for($j=0;$j<$number_of_fields;$j++)
    {
      //$value = trim($data[($csv_fields_keys[$j]-1)]);

      //$fieldname = $csv_fields[$csv_fields_keys[$j]];
      $value = "";
      $bedingung = false;
      if(isset($fieldset[$j]['bedingung']))$bedingung = $fieldset[$j]['bedingung'];
      if(isset($fieldset[$j]['nr']))
      {
        $value = trim($data[$fieldset[$j]['nr'] - 1]);
        if(isset($fieldset[$j]['inv']))
        {
          if($value != "1")
          {
            $value = 1;
          }else{
            $value = 0;
          }
        }
      } elseif(isset($fieldset[$j]['vorlage']))
      {
        $value = $fieldset[$j]['vorlage'];
      }
      if(isset($fieldset[$j]['bedingung']))$value = $this->ImportvorlageBedingung($value, $fieldset[$j]['bedingung']);
      $fieldname = $fieldset[$j]['field'];
      
      /*
      if($fieldsinverse && is_array($fieldsinverse) && isset($fieldsinverse[$j]) && $fieldsinverse[$j])
      {
        if($value != "1")
        {
          $value = 1;
        } elseif($value == "1")
        {
          $value = 0;
        }
      }*/
      
      switch($fieldname)
      {
        case "herstellernummer":
          $fields['herstellernummer'] = $value;
          $fields['herstellernummer'] = $this->app->DB->Select("SELECT herstellernummer 
              FROM artikel WHERE herstellernummer='".$fields['herstellernummer']."' LIMIT 1");
          //                                                    if($fields[herstellernummer]<=0) $fields[herstellernummer]="";
          break;
        case "nummer":
          $fields['nummer'] = $value;
          $fields['nummer'] = $this->app->DB->Select("SELECT nummer FROM artikel WHERE nummer='".$fields['nummer']."' LIMIT 1");
          
          foreach($fieldset as $k => $v)
          {
            $bedingung = "";
            if(isset($fieldset[$k]['bedingung']))$bedingung = $fieldset[$k]['bedingung'];
            if(trim(strtolower($bedingung)) == 'unique')
            {
              
              if($v['field'] && isset($fields[$v['field']])  && $fields[$v['field']])
              {
                $adressid = $this->app->DB->Select("SELECT id FROM artikel WHERE ".$v['field']."='".$fields[$v['field']]."' LIMIT 1");
                if($adressid)
                {
                  if(isset($fields['nummer']) && strtoupper($value) == 'NEW')
                  {
                    $fields['nummer'] = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id = '".$adressid."' LIMIT 1");
                  }
                }
              }
            }
          }
          
          //if($fields[nummer]==0) $fields[nummer]="";
          break;
        case "lieferantennummer":
          $fields['lieferantennummer'] = $value;
          $fields['lieferantennummer'] = $this->app->DB->Select("SELECT lieferantennummer FROM adresse WHERE lieferantennummer='".$fields['lieferantennummer']."' LIMIT 1");
              
          foreach($fieldset as $k => $v)
          {
            $bedingung = "";
            if(isset($fieldset[$k]['bedingung']))$bedingung = $fieldset[$k]['bedingung'];
            if(trim(strtolower($bedingung)) == 'unique')
            {
              
              if($v['field'] && isset($fields[$v['field']])  && $fields[$v['field']])
              {
                $adressid = $this->app->DB->Select("SELECT id FROM adresse WHERE ".$v['field']."='".$fields[$v['field']]."' LIMIT 1");
                if($adressid)
                {
                  if(isset($fields['lieferantennummer']) && strtoupper($value) == 'NEW')
                  {
                    $fields['lieferantennummer'] = $this->app->DB->Select("SELECT lieferantennummer FROM adresse WHERE id = '".$adressid."' LIMIT 1");
                  }
                }
              }
            }
          }
          
          $lieferantid = $this->app->DB->Select("SELECT id FROM adresse WHERE lieferantennummer='".$fields['lieferantennummer']."' LIMIT 1");

          //if($fields[lieferantennummer]=="") $fields[lieferantennummer]="";
          break;
        case "kundennummer":
          $fields['kundennummer'] = $value;
          $fields['kundennummer'] = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE kundennummer='".$fields['kundennummer']."' LIMIT 1");
          foreach($fieldset as $k => $v)
          {
            $bedingung = "";
            if(isset($fieldset[$k]['bedingung']))$bedingung = $fieldset[$k]['bedingung'];
            if(trim(strtolower($bedingung)) == 'unique')
            {
              
              if($v['field'] && isset($fields[$v['field']])  && $fields[$v['field']])
              {
                $adressid = $this->app->DB->Select("SELECT id FROM adresse WHERE ".$v['field']."='".$fields[$v['field']]."' LIMIT 1");
                if($adressid)
                {
                  if(isset($fields['kundennummer']) && strtoupper($value) == 'NEW')
                  {
                    $fields['kundennummer'] = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id = '".$adressid."' LIMIT 1");
                  }
                }
              }
            }
          }
          
          //if($fields[kundennummer]==0) $fields[kundennummer]="";
          break;
        case "ab_menge":
          $fields['ab_menge'] = $value;
          break;
        case "ean":
          $fields['ab_menge'] = $value;
          break;
        case "waehrung":
          $fields['waehrung'] = $value;
          break;
        case "ekpreis":
          $value = str_replace('EUR','',$value);
          $value = str_replace(' ','',$value);
          if(preg_match('#^(?<integer>.*)(?<separator>[\.,])(?<decimals>[0-9]+)$#', $value, $matches))
          {
            /* clean integer and append decimals with your own separator */
            $number = ((int) preg_replace('#[^0-9]+#', '', $matches['integer']) . ',' . $matches['decimals']);
          }
          else
          {
            $number = (int) preg_replace('#[^0-9]+#', '', $input);
          }
          // $formatter = new NumberFormatter('de_DE', NumberFormatter::CURRENCY);

          // prüfe von rechts letztes zeichen das keine 0 ist

          // let's print the international format for the en_US locale
          $value = $number;
          $fields['ekpreis'] = $value;
          break;
        case "datum_von":
          $value = $this->app->String->Convert($value,"%1.%2.%3","20%3-%2-%1");
          $fields['datum_von'] = $value;
          break;
        case "datum_bis":
          $value = $this->app->String->Convert($value,"%1.%2.%3","20%3-%2-%1");
          $fields['datum_bis'] = $value;
          break;
        case "kennung":
          $fields['kennung'] = $value;
          break;
        case "zeit_bis":
          $fields['zeit_bis'] = $value;
          break;
        case "zeit_von":
          $fields['zeit_von'] = $value;
          break;
        default:
          $fields[$fieldname] = $value; 
          //$value = $data[($csv_fields_keys[$j]-1)];
          //    $value = $data[($csv_fields_keys[$j]-1)];
      }

      $output .= '<td><input type="text" size="15" name="row['.$fieldname.']['.$rowcounter.']" value="'.$value.'" readonly></td>';
    }
    /*
    if($vorlage && is_array($vorlage) && count($vorlage) > 0)
    {
      foreach($vorlage as $k => $val)
      {
        $fields[$k] = $val;
        $output .= '<td><input type="text" size="15" name="row['.$fieldname.']['.$rowcounter.']" value="'.$val.'" readonly></td>';
      }
    }*/
    /*
    if($ziel == "adresse")
    {
      foreach($fieldset as $k => $v)
      {
        $bedingung = "";
        $value = "";
        $fieldname = "";
        if(isset($fieldset[$k]['bedingung']))$bedingung = $fieldset[$k]['bedingung'];
        if(trim(strtolower($bedingung)) == 'unique')
        {
          
          if($v['field'] && isset($fields[$v['field']])  && $fields[$v['field']])
          {
            $adressid = $this->app->DB->Select("SELECT id FROM adresse WHERE ".$v['field']."='".$fields[$v['field']]."' LIMIT 1");
            if($adressid)
            {
              if(isset($fields['kundennummer']) && strtoupper(trim($fields['kundennummer'])) == 'NEW')
              {
                $fields['kundennummer'] = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id = '".$adressid."' LIMIT 1");
              }
              if(isset($fields['lieferantennummer']) && strtoupper(trim($fields['lieferantennummer'])) == 'NEW')
              {
                $fields['lieferantennummer'] = $this->app->DB->Select("SELECT lieferantennummer FROM adresse WHERE id = '".$adressid."' LIMIT 1");
              }
            }
          }
        }
      }
    }*/
    
    

    switch($ziel)
    {
      case "einkauf":
        $checked = "checked";
        if($fields['lieferantennummer']=="")
        {
          $action_anzeige = "Keine (Lieferant fehlt)";
          $action="none";
          $checked="";
        }
        else if($fields['lieferantennummer']!="" && $fields['nummer']!="")
        {
          $nummer = $fields['nummer'];
          $action_anzeige = "Update (Artikelnr. gefunden)";
          $action="update";
        }
        else if($fields['lieferantennummer']!="" && $fields['herstellernummer']!="")
        {
          $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE herstellernummer='".$fields['herstellernummer']."' LIMIT 1");
          $action_anzeige = "Update (Herstellernr. gefunden)";
          $action="update";
        } 
        else if($fields['lieferantennummer']!="" && $fields['bestellnummer']!="")
        {
          $artikelid = $this->app->DB->Select("SELECT artikel FROM einkaufspreise WHERE bestellnummer='".$fields['bestellnummer']."'
              AND adresse='".$lieferantid."' LIMIT 1");
          $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='".$artikelid."' LIMIT 1");
          $action_anzeige = "Update (Bestellnr. gefunden)";
          $action="update";
        } 


        else {
          $action_anzeige = "Keine (Artikel- oder Herstellernr. fehlt)";
          $action="none";
          $checked="";
        }
        break;
      case "adresse":

        if($fields['kundennummer']=="" && $fields['lieferantennummer']=="" && $fields['name']=="")
        {
          $action_anzeige = "Keine (Kd.- und Lieferanten-Nr. und name fehlt)";
          $action="none";
          $checked="";
        }
        else if($fields['kundennummer']=="" && $fields['name']!="" && $fields['lieferantennummer']=="")
        {
          $action_anzeige = "Neu (Adresse neu anlegen)";
          $action="create";
          $checked="checked";
        }
        else if($fields['lieferantennummer']!="" || $fields['kundennummer']!="")
        {
          $checkkunde = $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='".$fields['kundennummer']."' AND kundennummer!='' LIMIT 1");
          if($checkkunde <= 0)
          {
            $action_anzeige = "Neu (Adresse neu anlegen)";
            $action="create";
            $checked="checked";
          } else {
            $action_anzeige = "Update (Kundennummer gefunden)";
            $action="update";
            $checked="checked";
          }

          if($checkkunde <= 0) {
            $checklieferant = $this->app->DB->Select("SELECT id FROM adresse WHERE lieferantennummer='".$fields['lieferantennummer']."' AND lieferantennummer!='' LIMIT 1");
            if($checklieferant <= 0)
            {
              $action_anzeige = "Neu (Adresse neu anlegen)";
              $action="create";
              $checked="checked";
            } else {
              $action_anzeige = "Update (Lieferantennummer gefunden)";
              $action="update";
              $checked="checked";
            }
          }
        }

        break;

      case "artikel":
        if($fields['nummer']=="" && $fields['name_de']=="")
        {
          $action_anzeige = "Keine (Artikel Nr. und name_de fehlt)";
          $action="none";
          $checked="";
        }
        else if($fields['nummer']=="" && $fields['name_de']!="")
        {
          $action_anzeige = "Neu (Artikel neu anlegen)";
          $action="create";
          $checked="checked";
        }
        else if($fields['nummer']!="")
        {
          $action_anzeige = "Update (Artikel update)";
          $action="update";
          $checked="checked";
        }
        break;
      case "zeiterfassung":
        $checked = "checked";
        if($fields['kennung']!="")
          $nummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE kennung='".$fields['kennung']."' LIMIT 1");
        else $nummer="";
        if($nummer=="")
        {
          $action_anzeige = "Keine (Kennung oder Kundennummer fehlt)";
          $action="none";
          $checked="";
        } else {
          $action="create";
        }
        break;


    }

    $this->app->Tpl->Add('ERGEBNIS','<tr><td width="100"><input type="hidden" name="'.$row['cmd'][$rowcounter].'" value="'.$action.'">
        <input type="checkbox" name="'.$row['checked']['.$rowcounter.'].'" '.$checked.' value="1"></td><td nowrap>'.$action_anzeige.'</td>
        <td>'.$nummer.'<input type="hidden" name="'.$row['nummer'][$rowcounter].'" value="'.$nummer.'"></td>'.$output);
    $this->app->Tpl->Add('ERGEBNIS','</tr>');
  }

}

?>
