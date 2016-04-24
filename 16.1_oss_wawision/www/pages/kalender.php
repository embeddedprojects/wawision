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
class Kalender {
  var $app;

  function Kalender(&$app) {
    //parent::GenKalender($app);
    $this->app=$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","KalenderList");
    $this->app->ActionHandler("data","KalenderData");
    $this->app->ActionHandler("ics","KalenderICS");
    $this->app->ActionHandler("eventdata","KalenderEventData");
    $this->app->ActionHandler("update","KalenderUpdate");
    $this->app->ActionHandler("delete","KalenderDelete");
    $this->app->ActionHandler("taskstatus","KalenderTaskStatus");

    $this->publicColor = "#3fa848";	
    $this->taskColor = "#ae161e";	

    $this->app->ActionHandlerListen($app);


    $this->app = $app;
  }

  function KalenderList()
  {
    $this->app->erp->KalenderList(TAB1);
    $this->app->YUI->DatePicker("datum");
    $this->app->YUI->DatePicker("datum_bis");

    //		$this->app->Tpl->Parse(TAB1,"kalender.tpl");
    $this->app->Tpl->Set(TABTEXT,"");
    $this->app->Tpl->Parse(PAGE,"tabview.tpl");
    $this->app->erp->StartseiteMenu();

  }

  function KalenderICS()
  {
    $findlogin = $this->app->DB->Select("SELECT id FROM user WHERE username='".$this->app->DB->real_escape_string($_SERVER['PHP_AUTH_USER'])."' AND username!=''
        AND kalender_aktiv='1' AND kalender_passwort='".$this->app->DB->real_escape_string($_SERVER['PHP_AUTH_PW'])."' AND kalender_passwort!='' AND `activ`='1' LIMIT 1");

    $this->app->erp->Protokoll("Benutzer: ".$this->app->DB->real_escape_string($_SERVER['PHP_AUTH_USER']));

    //$findlogin='1000';
    //if ($_SERVER['PHP_AUTH_USER']=="sauterbe" && $_SERVER['PHP_AUTH_PW']=="ZakledhLs")
    if($findlogin > 0)	
    {
      $event = new ICS("wawision");

      $data = $this->app->DB->SelectArr("SELECT DISTINCT ke.id, ort,beschreibung, bezeichnung AS title, DATE_FORMAT(von,'%Y-%m-%d %H:%i') AS start, 
          DATE_FORMAT(bis,'%Y-%m-%d %H:%i') AS end, allDay, color, public
          FROM kalender_user AS ku
          LEFT JOIN kalender_event AS ke ON ke.id=ku.event
          WHERE (ku.userid='$findlogin' OR ke.public='1') ORDER by von");

      for($i=0;$i<count($data);$i++)
      {
        //	$data[$i]['color'] = (($data[$i]['public']=='1')?$this->publicColor:$data[$i]['color']);
        $data[$i]['allDay'] = (($data[$i]['allDay']=='1')?true:false);
        $data[$i]['public'] = (($data[$i]['public']=='1')?true:false);
        $data[$i]['title'] = $this->app->erp->ReadyForPDF($data[$i]['title']);
        $data[$i]['ort'] = $this->app->erp->ReadyForPDF($data[$i]['ort']);
        $data[$i]['beschreibung'] = $this->app->erp->ReadyForPDF($data[$i]['beschreibung']);
        $event->AddEvent($data[$i]['id'],$data[$i]['start'],$data[$i]['end'],$data[$i]['title'],$data[$i]['beschreibung'],$data[$i]['ort']);
      }

      //$event->AddEvent(1,"2014-05-18 11:00","2014-05-18 21:00","Test 444 Event","This is an event made by Benedikt","Augsburg");
      //$event->AddEvent(2,"2014-05-18 09:00","2014-05-18 09:30","Test 3 Event","This is an event made by Benedikt","Augsburg");
      $event->show();
      exit;
    } else {
      header('WWW-Authenticate: Basic realm="WaWision Kalender"');
      header('HTTP/1.0 401 Unauthorized');
    }
  }

  function KalenderTaskStatus()
  {
    $user = $this->app->User->GetID();
    $data = $this->app->DB->SelectArr("SELECT kalender_aufgaben , a.id FROM adresse AS a
        LEFT JOIN user as u ON u.adresse=a.id
        WHERE u.id='$user' LIMIT 1");
    $new_status = '';
    if($data[0]['kalender_aufgaben']=='1')
      $new_status = '0';
    else
      $new_status = '1';

    $this->app->DB->Update("UPDATE adresse SET kalender_aufgaben='$new_status' WHERE id='{$data[0]['id']}' LIMIT 1");
    exit;
  }




  function KalenderData()
  {
    $user = $this->app->User->GetID();
    $start = date("Y-m-d H:i:s", $this->app->Secure->GetGET('start'));
    $end = date("Y-m-d H:i:s", $this->app->Secure->GetGET('end'));

    /*		$data = $this->app->DB->SelectArr("SELECT id, bezeichnung AS title, von AS start, bis AS end, allDay, color 
                FROM kalender_event WHERE '$start'<=von AND bis<='$end'"); */

    $data = $this->app->DB->SelectArr("SELECT DISTINCT ke.id, ort,beschreibung, bezeichnung AS title, von AS start, bis AS end, allDay, color, public
        FROM kalender_user AS ku
        LEFT JOIN kalender_event AS ke ON ke.id=ku.event
        WHERE (ku.userid='$user' OR ke.public='1') AND bis<='$end' ORDER by start");


    for($i=0;$i<count($data);$i++)
    {
      //	$data[$i]['color'] = (($data[$i]['public']=='1')?$this->publicColor:$data[$i]['color']);
      $data[$i]['allDay'] = (($data[$i]['allDay']=='1')?true:false);
      $data[$i]['public'] = (($data[$i]['public']=='1')?true:false);
      $data[$i]['title'] = $this->app->erp->ReadyForPDF($data[$i]['title']);
      $data[$i]['ort'] = $this->app->erp->ReadyForPDF($data[$i]['ort']);
      $data[$i]['beschreibung'] = $this->app->erp->ReadyForPDF($data[$i]['beschreibung']);
    }

    $aufgaben_visible = $this->app->DB->Select("SELECT kalender_aufgaben FROM adresse AS a
        LEFT JOIN user as u ON u.adresse=a.id
        WHERE u.id='$user' LIMIT 1");

    // Mindesthaltbarkeitsdatum einblenden
    if($this->app->erp->RechteVorhanden("mhdwarning","list"))	
    {
      $sql = "SELECT a.id as id,a.name_de, a.nummer, SUM(lm.menge) as menge, lm.mhddatum
        FROM lager_mindesthaltbarkeitsdatum lm 
        LEFT JOIN artikel a ON a.id=lm.artikel LEFT JOIN lager_platz l ON l.id=lm.lager_platz GROUP By lm.mhddatum, a.id";

      $tmpartikel = $this->app->DB->SelectArr($sql);

      for($ij=0;$ij<count($tmpartikel);$ij++)
      {
        $data[] = array('id' => -3,
            'title'=>round($tmpartikel[$ij]['menge'],0)." x ".$this->app->erp->ReadyForPDF($tmpartikel[$ij]['name_de']),
            'start'=> $tmpartikel[$ij]['mhddatum'],
            'end'=> $tmpartikel[$ij]['mhddatum'],
            'allDay'=>true,
            'color'=>'#FA5858',
            'public'=>'1',
            'task'=>$tmpartikel[$ij]['id']);			
      }
    }

    //Geburtstage einblenden
    if($this->app->erp->Firmendaten("geburtstagekalender")=="1")
    {

      //1201   1001

      $tmp = explode('-',$start); 
      $startyear = $tmp[0];

      $tmp = explode('-',$end); 
      $endyear = $tmp[0];


      if($endyear>$startyear)
      {   

        //0111   1230 // neues jahr
        $sql = "SELECT a.id as id,a.name,DATE_FORMAT(a.geburtstag,'%m-%d') as datum,
          YEAR('$end') - YEAR(a.geburtstag) - IF(DAYOFYEAR('$end') < DAYOFYEAR(CONCAT(YEAR('$end'),DATE_FORMAT(a.geburtstag, '-%m-%d'))),1,0) as alterjahre
          FROM adresse a WHERE DATE_FORMAT(a.geburtstag,'%m%d') <= date_format('$end','%m%d') AND a.geloescht!='1' AND a.geburtstag!='0000-00-00' AND a.geburtstagkalender=1";

        $tmpartikel = $this->app->DB->SelectArr($sql);
        for($ij=0;$ij<count($tmpartikel);$ij++)
        {
          $data[] = array('id' => -4,
              'title'=>"Geburtstag: ".$this->app->erp->ReadyForPDF($tmpartikel[$ij]['name'])." (".$tmpartikel[$ij]['alterjahre'].")",
              'start'=> $endyear."-".$tmpartikel[$ij]['datum'],
              'end'=> $endyear."-".$tmpartikel[$ij]['datum'],
              'allDay'=>true,
              'color'=>'#FA5858',
              'public'=>'1',
              'task'=>$tmpartikel[$ij]['id']);			
        }


        //0111   1230 // altes jahr
        $sql = "SELECT a.id as id,a.name,DATE_FORMAT(a.geburtstag,'%m-%d') as datum,
          YEAR('$end') - YEAR(a.geburtstag) - IF(DAYOFYEAR('$end') < DAYOFYEAR(CONCAT(YEAR('$end'),DATE_FORMAT(a.geburtstag, '-%m-%d'))),1,0) as alterjahre
          FROM adresse a WHERE DATE_FORMAT(a.geburtstag,'%m%d') <= 1231 AND a.geloescht!='1' AND a.geburtstag!='0000-00-00'";

        $tmpartikel = $this->app->DB->SelectArr($sql);
        for($ij=0;$ij<count($tmpartikel);$ij++)
        {
          $data[] = array('id' => -4,
              'title'=>"Geburtstag: ".$this->app->erp->ReadyForPDF($tmpartikel[$ij]['name'])." (".$tmpartikel[$ij]['alterjahre'].")",
              'start'=> $startyear."-".$tmpartikel[$ij]['datum'],
              'end'=> $startyear."-".$tmpartikel[$ij]['datum'],
              'allDay'=>true,
              'color'=>'#FA5858',
              'public'=>'1',
              'task'=>$tmpartikel[$ij]['id']);			
        }


      } else {
        $sql = "SELECT a.id as id,a.name,DATE_FORMAT(a.geburtstag,'%m-%d') as datum,
          YEAR('$end') - YEAR(a.geburtstag) - IF(DAYOFYEAR('$end') < DAYOFYEAR(CONCAT(YEAR('$end'),DATE_FORMAT(a.geburtstag, '-%m-%d'))),1,0) as alterjahre
          FROM adresse a WHERE DATE_FORMAT(a.geburtstag,'%m%d') <= date_format('$end','%m%d') AND DATE_FORMAT(a.geburtstag,'%m%d') >= date_format('$start','%m%d') AND a.geloescht!='1' AND a.geburtstag!='0000-00-00'";

        $tmpartikel = $this->app->DB->SelectArr($sql);
        for($ij=0;$ij<count($tmpartikel);$ij++)
        {
          $data[] = array('id' => -4,
              'title'=>"Geburtstag: ".$this->app->erp->ReadyForPDF($tmpartikel[$ij]['name'])." (".$tmpartikel[$ij]['alterjahre'].")",
              'start'=> $startyear."-".$tmpartikel[$ij]['datum'],
              'end'=> $startyear."-".$tmpartikel[$ij]['datum'],
              'allDay'=>true,
              'color'=>'#FA5858',
              'public'=>'1',
              'task'=>$tmpartikel[$ij]['id']);			
        }

      }

    }






    // Aufgabene einblenden
    if($aufgaben_visible=='1') {
      // Aufgaben hinzufügen
      $tasks = $this->app->DB->SelectArr("SELECT a.id, aufgabe, abgabe_bis, ganztags FROM aufgabe AS a 
          LEFT JOIN user AS u ON u.adresse=a.adresse
          WHERE u.id='$user' AND a.status='offen' AND abgabe_bis>='$start' 
          AND abgabe_bis<='$end'");
      for($i=0;$i<count($tasks);$i++) 
      {
        $allday = (($tasks[$i]['ganztags']=='1') ? true : false);
        $data[] = array('id' => -2,
            'title'=>$this->app->erp->ReadyForPDF($tasks[$i]['aufgabe']),
            'start'=> $tasks[$i]['abgabe_bis'],
            'end'=> $tasks[$i]['abgabe_bis'],
            'allDay'=>$allday,
            'color'=>$this->taskColor,
            'public'=>'',
            'task'=>$tasks[$i]['id']);
      }

    }

    header('Content-type: application/json');		
    echo json_encode($data);
    exit;
  }

  function KalenderUpdate() 
  {
    $id = $this->app->Secure->GetGET("id");
    $task = $this->app->Secure->GetGET("task");

    if(is_numeric($id) && $id > 0) {
      $start = $this->app->Secure->GetGET("start");
      $end = $this->app->Secure->GetGET("end");
      $this->app->DB->Update("UPDATE kalender_event SET von='$start', bis='$end' WHERE id='$id' LIMIT 1");
    }

    if(is_numeric($task) && $task > 0) {
      $start = $this->app->Secure->GetGET("start");
      $allday = $this->app->Secure->GetGET("allDay");
      // jjjj-mm-tt ss-mm-ss  -> jjjj-mm-tt ss:mm:ss

      $allday_db = (($allday=='true') ? '1' : '0');
      $converted = $this->app->String->Convert($start, "%1-%2-%3 %4-%5-%6", "%1-%2-%3 %4:%5:%6"); 
      $this->app->DB->Update("UPDATE aufgabe SET abgabe_bis='$converted', ganztags='$allday_db' WHERE id='$task' LIMIT 1");
    }

    exit;
  }

  function KalenderEventData() 
  {
    $event = $this->app->Secure->GetGET("id");
    if(is_numeric($event) && $event>0){
      $data = $this->app->DB->SelectArr("SELECT id, ort, bezeichnung AS titel, beschreibung, von, bis, allDay, color, public FROM kalender_event WHERE id='$event' LIMIT 1");
      $personen = $this->app->DB->SelectArr("SELECT DISTINCT ku.userid, a.name FROM kalender_user AS ku
          LEFT JOIN user AS u ON u.id=ku.userid 
          LEFT JOIN adresse a ON a.id=u.adresse
          WHERE ku.event='$event' ORDER BY u.username ");
    }


    $data[0]['allDay'] = (($data[0]['allDay']=='1')?true:false);
    $data[0]['public'] = (($data[0]['public']=='1')?true:false);
    $data[0]['titel'] = $this->app->erp->ReadyForPDF($data[0]['titel']);
    $data[0]['ort'] = $this->app->erp->ReadyForPDF($data[0]['ort']);
    $data[0]['beschreibung'] = $this->app->erp->ReadyForPDF($data[0]['beschreibung']);

    //		$data[0]['color'] = (($data[0]['public']=='1')?$this->publicColor:$data[0]['color']);
    $data[0]['personen'] = $personen;
    $data = $data[0];	

    header('Content-type: application/json');
    echo json_encode($data);
    exit;
  }
}

?>
