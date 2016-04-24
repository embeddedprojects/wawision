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

class ObjGenShopexport_Status
{

  private  $id;
  private  $artikelexport;
  private  $bearbeiter;
  private  $zeit;
  private  $bemerkung;
  private  $befehl;

  public $app;            //application object 

  public function ObjGenShopexport_Status($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM shopexport_status WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->artikelexport=$result[artikelexport];
    $this->bearbeiter=$result[bearbeiter];
    $this->zeit=$result[zeit];
    $this->bemerkung=$result[bemerkung];
    $this->befehl=$result[befehl];
  }

  public function Create()
  {
    $sql = "INSERT INTO shopexport_status (id,artikelexport,bearbeiter,zeit,bemerkung,befehl)
      VALUES('','{$this->artikelexport}','{$this->bearbeiter}','{$this->zeit}','{$this->bemerkung}','{$this->befehl}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE shopexport_status SET
      artikelexport='{$this->artikelexport}',
      bearbeiter='{$this->bearbeiter}',
      zeit='{$this->zeit}',
      bemerkung='{$this->bemerkung}',
      befehl='{$this->befehl}'
      WHERE (id='{$this->id}')";

    $this->app->DB->Update($sql);
  }

  public function Delete($id="")
  {
    if(is_numeric($id))
    {
      $this->id=$id;
    }
    else
      return -1;

    $sql = "DELETE FROM shopexport_status WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->artikelexport="";
    $this->bearbeiter="";
    $this->zeit="";
    $this->bemerkung="";
    $this->befehl="";
  }

  public function Copy()
  {
    $this->id = "";
    $this->Create();
  }

 /** 
   Mit dieser Funktion kann man einen Datensatz suchen 
   dafuer muss man die Attribute setzen nach denen gesucht werden soll
   dann kriegt man als ergebnis den ersten Datensatz der auf die Suche uebereinstimmt
   zurueck. Mit Next() kann man sich alle weiteren Ergebnisse abholen
   **/ 

  public function Find()
  {
    //TODO Suche mit den werten machen
  }

  public function FindNext()
  {
    //TODO Suche mit den alten werten fortsetzen machen
  }

 /** Funktionen um durch die Tabelle iterieren zu koennen */ 

  public function Next()
  {
    //TODO: SQL Statement passt nach meiner Meinung nach noch nicht immer
  }

  public function First()
  {
    //TODO: SQL Statement passt nach meiner Meinung nach noch nicht immer
  }

 /** dank dieser funktionen kann man die tatsaechlichen werte einfach 
  ueberladen (in einem Objekt das mit seiner klasse ueber dieser steht)**/ 

  function SetId($value) { $this->id=$value; }
  function GetId() { return $this->id; }
  function SetArtikelexport($value) { $this->artikelexport=$value; }
  function GetArtikelexport() { return $this->artikelexport; }
  function SetBearbeiter($value) { $this->bearbeiter=$value; }
  function GetBearbeiter() { return $this->bearbeiter; }
  function SetZeit($value) { $this->zeit=$value; }
  function GetZeit() { return $this->zeit; }
  function SetBemerkung($value) { $this->bemerkung=$value; }
  function GetBemerkung() { return $this->bemerkung; }
  function SetBefehl($value) { $this->befehl=$value; }
  function GetBefehl() { return $this->befehl; }

}

?>