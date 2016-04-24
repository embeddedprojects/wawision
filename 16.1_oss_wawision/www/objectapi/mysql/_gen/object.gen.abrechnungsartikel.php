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

class ObjGenAbrechnungsartikel
{

  private  $id;
  private  $sort;
  private  $artikel;
  private  $bezeichnung;
  private  $nummer;
  private  $menge;
  private  $preis;
  private  $steuerklasse;
  private  $rabatt;
  private  $abgerechnet;
  private  $startdatum;
  private  $lieferdatum;
  private  $abgerechnetbis;
  private  $wiederholend;
  private  $zahlzyklus;
  private  $abgrechnetam;
  private  $rechnung;
  private  $projekt;
  private  $adresse;
  private  $status;
  private  $bemerkung;
  private  $logdatei;
  private  $beschreibung;
  private  $dokument;
  private  $preisart;

  public $app;            //application object 

  public function ObjGenAbrechnungsartikel($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM abrechnungsartikel WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result['id'];
    $this->sort=$result['sort'];
    $this->artikel=$result['artikel'];
    $this->bezeichnung=$result['bezeichnung'];
    $this->nummer=$result['nummer'];
    $this->menge=$result['menge'];
    $this->preis=$result['preis'];
    $this->steuerklasse=$result['steuerklasse'];
    $this->rabatt=$result['rabatt'];
    $this->abgerechnet=$result['abgerechnet'];
    $this->startdatum=$result['startdatum'];
    $this->lieferdatum=$result['lieferdatum'];
    $this->abgerechnetbis=$result['abgerechnetbis'];
    $this->wiederholend=$result['wiederholend'];
    $this->zahlzyklus=$result['zahlzyklus'];
    $this->abgrechnetam=$result['abgrechnetam'];
    $this->rechnung=$result['rechnung'];
    $this->projekt=$result['projekt'];
    $this->adresse=$result['adresse'];
    $this->status=$result['status'];
    $this->bemerkung=$result['bemerkung'];
    $this->logdatei=$result['logdatei'];
    $this->beschreibung=$result['beschreibung'];
    $this->dokument=$result['dokument'];
    $this->preisart=$result['preisart'];
  }

  public function Create()
  {
    $sql = "INSERT INTO abrechnungsartikel (id,sort,artikel,bezeichnung,nummer,menge,preis,steuerklasse,rabatt,abgerechnet,startdatum,lieferdatum,abgerechnetbis,wiederholend,zahlzyklus,abgrechnetam,rechnung,projekt,adresse,status,bemerkung,logdatei,beschreibung,dokument,preisart)
      VALUES('','{$this->sort}','{$this->artikel}','{$this->bezeichnung}','{$this->nummer}','{$this->menge}','{$this->preis}','{$this->steuerklasse}','{$this->rabatt}','{$this->abgerechnet}','{$this->startdatum}','{$this->lieferdatum}','{$this->abgerechnetbis}','{$this->wiederholend}','{$this->zahlzyklus}','{$this->abgrechnetam}','{$this->rechnung}','{$this->projekt}','{$this->adresse}','{$this->status}','{$this->bemerkung}','{$this->logdatei}','{$this->beschreibung}','{$this->dokument}','{$this->preisart}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE abrechnungsartikel SET
      sort='{$this->sort}',
      artikel='{$this->artikel}',
      bezeichnung='{$this->bezeichnung}',
      nummer='{$this->nummer}',
      menge='{$this->menge}',
      preis='{$this->preis}',
      steuerklasse='{$this->steuerklasse}',
      rabatt='{$this->rabatt}',
      abgerechnet='{$this->abgerechnet}',
      startdatum='{$this->startdatum}',
      lieferdatum='{$this->lieferdatum}',
      abgerechnetbis='{$this->abgerechnetbis}',
      wiederholend='{$this->wiederholend}',
      zahlzyklus='{$this->zahlzyklus}',
      abgrechnetam='{$this->abgrechnetam}',
      rechnung='{$this->rechnung}',
      projekt='{$this->projekt}',
      adresse='{$this->adresse}',
      status='{$this->status}',
      bemerkung='{$this->bemerkung}',
      logdatei='{$this->logdatei}',
      beschreibung='{$this->beschreibung}',
      dokument='{$this->dokument}',
      preisart='{$this->preisart}'
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

    $sql = "DELETE FROM abrechnungsartikel WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->sort="";
    $this->artikel="";
    $this->bezeichnung="";
    $this->nummer="";
    $this->menge="";
    $this->preis="";
    $this->steuerklasse="";
    $this->rabatt="";
    $this->abgerechnet="";
    $this->startdatum="";
    $this->lieferdatum="";
    $this->abgerechnetbis="";
    $this->wiederholend="";
    $this->zahlzyklus="";
    $this->abgrechnetam="";
    $this->rechnung="";
    $this->projekt="";
    $this->adresse="";
    $this->status="";
    $this->bemerkung="";
    $this->logdatei="";
    $this->beschreibung="";
    $this->dokument="";
    $this->preisart="";
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
  function SetSort($value) { $this->sort=$value; }
  function GetSort() { return $this->sort; }
  function SetArtikel($value) { $this->artikel=$value; }
  function GetArtikel() { return $this->artikel; }
  function SetBezeichnung($value) { $this->bezeichnung=$value; }
  function GetBezeichnung() { return $this->bezeichnung; }
  function SetNummer($value) { $this->nummer=$value; }
  function GetNummer() { return $this->nummer; }
  function SetMenge($value) { $this->menge=$value; }
  function GetMenge() { return $this->menge; }
  function SetPreis($value) { $this->preis=$value; }
  function GetPreis() { return $this->preis; }
  function SetSteuerklasse($value) { $this->steuerklasse=$value; }
  function GetSteuerklasse() { return $this->steuerklasse; }
  function SetRabatt($value) { $this->rabatt=$value; }
  function GetRabatt() { return $this->rabatt; }
  function SetAbgerechnet($value) { $this->abgerechnet=$value; }
  function GetAbgerechnet() { return $this->abgerechnet; }
  function SetStartdatum($value) { $this->startdatum=$value; }
  function GetStartdatum() { return $this->startdatum; }
  function SetLieferdatum($value) { $this->lieferdatum=$value; }
  function GetLieferdatum() { return $this->lieferdatum; }
  function SetAbgerechnetbis($value) { $this->abgerechnetbis=$value; }
  function GetAbgerechnetbis() { return $this->abgerechnetbis; }
  function SetWiederholend($value) { $this->wiederholend=$value; }
  function GetWiederholend() { return $this->wiederholend; }
  function SetZahlzyklus($value) { $this->zahlzyklus=$value; }
  function GetZahlzyklus() { return $this->zahlzyklus; }
  function SetAbgrechnetam($value) { $this->abgrechnetam=$value; }
  function GetAbgrechnetam() { return $this->abgrechnetam; }
  function SetRechnung($value) { $this->rechnung=$value; }
  function GetRechnung() { return $this->rechnung; }
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetAdresse($value) { $this->adresse=$value; }
  function GetAdresse() { return $this->adresse; }
  function SetStatus($value) { $this->status=$value; }
  function GetStatus() { return $this->status; }
  function SetBemerkung($value) { $this->bemerkung=$value; }
  function GetBemerkung() { return $this->bemerkung; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }
  function SetBeschreibung($value) { $this->beschreibung=$value; }
  function GetBeschreibung() { return $this->beschreibung; }
  function SetDokument($value) { $this->dokument=$value; }
  function GetDokument() { return $this->dokument; }
  function SetPreisart($value) { $this->preisart=$value; }
  function GetPreisart() { return $this->preisart; }

}

?>