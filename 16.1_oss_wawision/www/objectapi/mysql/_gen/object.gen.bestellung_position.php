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

class ObjGenBestellung_Position
{

  private  $id;
  private  $bestellung;
  private  $artikel;
  private  $projekt;
  private  $bezeichnunglieferant;
  private  $bestellnummer;
  private  $beschreibung;
  private  $menge;
  private  $preis;
  private  $waehrung;
  private  $lieferdatum;
  private  $vpe;
  private  $sort;
  private  $status;
  private  $umsatzsteuer;
  private  $bemerkung;
  private  $geliefert;
  private  $mengemanuellgeliefertaktiviert;
  private  $manuellgeliefertbearbeiter;
  private  $abgerechnet;
  private  $logdatei;
  private  $abgeschlossen;
  private  $einheit;

  public $app;            //application object 

  public function ObjGenBestellung_Position($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM bestellung_position WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->bestellung=$result[bestellung];
    $this->artikel=$result[artikel];
    $this->projekt=$result[projekt];
    $this->bezeichnunglieferant=$result[bezeichnunglieferant];
    $this->bestellnummer=$result[bestellnummer];
    $this->beschreibung=$result[beschreibung];
    $this->menge=$result[menge];
    $this->preis=$result[preis];
    $this->waehrung=$result[waehrung];
    $this->lieferdatum=$result[lieferdatum];
    $this->vpe=$result[vpe];
    $this->sort=$result[sort];
    $this->status=$result[status];
    $this->umsatzsteuer=$result[umsatzsteuer];
    $this->bemerkung=$result[bemerkung];
    $this->geliefert=$result[geliefert];
    $this->mengemanuellgeliefertaktiviert=$result[mengemanuellgeliefertaktiviert];
    $this->manuellgeliefertbearbeiter=$result[manuellgeliefertbearbeiter];
    $this->abgerechnet=$result[abgerechnet];
    $this->logdatei=$result[logdatei];
    $this->abgeschlossen=$result[abgeschlossen];
    $this->einheit=$result[einheit];
  }

  public function Create()
  {
    $sql = "INSERT INTO bestellung_position (id,bestellung,artikel,projekt,bezeichnunglieferant,bestellnummer,beschreibung,menge,preis,waehrung,lieferdatum,vpe,sort,status,umsatzsteuer,bemerkung,geliefert,mengemanuellgeliefertaktiviert,manuellgeliefertbearbeiter,abgerechnet,logdatei,abgeschlossen,einheit)
      VALUES('','{$this->bestellung}','{$this->artikel}','{$this->projekt}','{$this->bezeichnunglieferant}','{$this->bestellnummer}','{$this->beschreibung}','{$this->menge}','{$this->preis}','{$this->waehrung}','{$this->lieferdatum}','{$this->vpe}','{$this->sort}','{$this->status}','{$this->umsatzsteuer}','{$this->bemerkung}','{$this->geliefert}','{$this->mengemanuellgeliefertaktiviert}','{$this->manuellgeliefertbearbeiter}','{$this->abgerechnet}','{$this->logdatei}','{$this->abgeschlossen}','{$this->einheit}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE bestellung_position SET
      bestellung='{$this->bestellung}',
      artikel='{$this->artikel}',
      projekt='{$this->projekt}',
      bezeichnunglieferant='{$this->bezeichnunglieferant}',
      bestellnummer='{$this->bestellnummer}',
      beschreibung='{$this->beschreibung}',
      menge='{$this->menge}',
      preis='{$this->preis}',
      waehrung='{$this->waehrung}',
      lieferdatum='{$this->lieferdatum}',
      vpe='{$this->vpe}',
      sort='{$this->sort}',
      status='{$this->status}',
      umsatzsteuer='{$this->umsatzsteuer}',
      bemerkung='{$this->bemerkung}',
      geliefert='{$this->geliefert}',
      mengemanuellgeliefertaktiviert='{$this->mengemanuellgeliefertaktiviert}',
      manuellgeliefertbearbeiter='{$this->manuellgeliefertbearbeiter}',
      abgerechnet='{$this->abgerechnet}',
      logdatei='{$this->logdatei}',
      abgeschlossen='{$this->abgeschlossen}',
      einheit='{$this->einheit}'
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

    $sql = "DELETE FROM bestellung_position WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->bestellung="";
    $this->artikel="";
    $this->projekt="";
    $this->bezeichnunglieferant="";
    $this->bestellnummer="";
    $this->beschreibung="";
    $this->menge="";
    $this->preis="";
    $this->waehrung="";
    $this->lieferdatum="";
    $this->vpe="";
    $this->sort="";
    $this->status="";
    $this->umsatzsteuer="";
    $this->bemerkung="";
    $this->geliefert="";
    $this->mengemanuellgeliefertaktiviert="";
    $this->manuellgeliefertbearbeiter="";
    $this->abgerechnet="";
    $this->logdatei="";
    $this->abgeschlossen="";
    $this->einheit="";
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
  function SetBestellung($value) { $this->bestellung=$value; }
  function GetBestellung() { return $this->bestellung; }
  function SetArtikel($value) { $this->artikel=$value; }
  function GetArtikel() { return $this->artikel; }
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetBezeichnunglieferant($value) { $this->bezeichnunglieferant=$value; }
  function GetBezeichnunglieferant() { return $this->bezeichnunglieferant; }
  function SetBestellnummer($value) { $this->bestellnummer=$value; }
  function GetBestellnummer() { return $this->bestellnummer; }
  function SetBeschreibung($value) { $this->beschreibung=$value; }
  function GetBeschreibung() { return $this->beschreibung; }
  function SetMenge($value) { $this->menge=$value; }
  function GetMenge() { return $this->menge; }
  function SetPreis($value) { $this->preis=$value; }
  function GetPreis() { return $this->preis; }
  function SetWaehrung($value) { $this->waehrung=$value; }
  function GetWaehrung() { return $this->waehrung; }
  function SetLieferdatum($value) { $this->lieferdatum=$value; }
  function GetLieferdatum() { return $this->lieferdatum; }
  function SetVpe($value) { $this->vpe=$value; }
  function GetVpe() { return $this->vpe; }
  function SetSort($value) { $this->sort=$value; }
  function GetSort() { return $this->sort; }
  function SetStatus($value) { $this->status=$value; }
  function GetStatus() { return $this->status; }
  function SetUmsatzsteuer($value) { $this->umsatzsteuer=$value; }
  function GetUmsatzsteuer() { return $this->umsatzsteuer; }
  function SetBemerkung($value) { $this->bemerkung=$value; }
  function GetBemerkung() { return $this->bemerkung; }
  function SetGeliefert($value) { $this->geliefert=$value; }
  function GetGeliefert() { return $this->geliefert; }
  function SetMengemanuellgeliefertaktiviert($value) { $this->mengemanuellgeliefertaktiviert=$value; }
  function GetMengemanuellgeliefertaktiviert() { return $this->mengemanuellgeliefertaktiviert; }
  function SetManuellgeliefertbearbeiter($value) { $this->manuellgeliefertbearbeiter=$value; }
  function GetManuellgeliefertbearbeiter() { return $this->manuellgeliefertbearbeiter; }
  function SetAbgerechnet($value) { $this->abgerechnet=$value; }
  function GetAbgerechnet() { return $this->abgerechnet; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }
  function SetAbgeschlossen($value) { $this->abgeschlossen=$value; }
  function GetAbgeschlossen() { return $this->abgeschlossen; }
  function SetEinheit($value) { $this->einheit=$value; }
  function GetEinheit() { return $this->einheit; }

}

?>