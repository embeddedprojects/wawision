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

class ObjGenAuftrag_Position
{

  private  $id;
  private  $auftrag;
  private  $artikel;
  private  $projekt;
  private  $bezeichnung;
  private  $beschreibung;
  private  $internerkommentar;
  private  $nummer;
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
  private  $geliefert_menge;
  private  $explodiert;
  private  $explodiert_parent;
  private  $logdatei;
  private  $punkte;
  private  $bonuspunkte;
  private  $mlmdirektpraemie;
  private  $keinrabatterlaubt;
  private  $grundrabatt;
  private  $rabattsync;
  private  $rabatt1;
  private  $rabatt2;
  private  $rabatt3;
  private  $rabatt4;
  private  $rabatt5;
  private  $einheit;
  private  $webid;
  private  $rabatt;
  private  $nachbestelltexternereinkauf;
  private  $zolltarifnummer;
  private  $herkunftsland;
  private  $artikelnummerkunde;
  private  $lieferdatumkw;

  public $app;            //application object 

  public function ObjGenAuftrag_Position($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM auftrag_position WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result['id'];
    $this->auftrag=$result['auftrag'];
    $this->artikel=$result['artikel'];
    $this->projekt=$result['projekt'];
    $this->bezeichnung=$result['bezeichnung'];
    $this->beschreibung=$result['beschreibung'];
    $this->internerkommentar=$result['internerkommentar'];
    $this->nummer=$result['nummer'];
    $this->menge=$result['menge'];
    $this->preis=$result['preis'];
    $this->waehrung=$result['waehrung'];
    $this->lieferdatum=$result['lieferdatum'];
    $this->vpe=$result['vpe'];
    $this->sort=$result['sort'];
    $this->status=$result['status'];
    $this->umsatzsteuer=$result['umsatzsteuer'];
    $this->bemerkung=$result['bemerkung'];
    $this->geliefert=$result['geliefert'];
    $this->geliefert_menge=$result['geliefert_menge'];
    $this->explodiert=$result['explodiert'];
    $this->explodiert_parent=$result['explodiert_parent'];
    $this->logdatei=$result['logdatei'];
    $this->punkte=$result['punkte'];
    $this->bonuspunkte=$result['bonuspunkte'];
    $this->mlmdirektpraemie=$result['mlmdirektpraemie'];
    $this->keinrabatterlaubt=$result['keinrabatterlaubt'];
    $this->grundrabatt=$result['grundrabatt'];
    $this->rabattsync=$result['rabattsync'];
    $this->rabatt1=$result['rabatt1'];
    $this->rabatt2=$result['rabatt2'];
    $this->rabatt3=$result['rabatt3'];
    $this->rabatt4=$result['rabatt4'];
    $this->rabatt5=$result['rabatt5'];
    $this->einheit=$result['einheit'];
    $this->webid=$result['webid'];
    $this->rabatt=$result['rabatt'];
    $this->nachbestelltexternereinkauf=$result['nachbestelltexternereinkauf'];
    $this->zolltarifnummer=$result['zolltarifnummer'];
    $this->herkunftsland=$result['herkunftsland'];
    $this->artikelnummerkunde=$result['artikelnummerkunde'];
    $this->lieferdatumkw=$result['lieferdatumkw'];
  }

  public function Create()
  {
    $sql = "INSERT INTO auftrag_position (id,auftrag,artikel,projekt,bezeichnung,beschreibung,internerkommentar,nummer,menge,preis,waehrung,lieferdatum,vpe,sort,status,umsatzsteuer,bemerkung,geliefert,geliefert_menge,explodiert,explodiert_parent,logdatei,punkte,bonuspunkte,mlmdirektpraemie,keinrabatterlaubt,grundrabatt,rabattsync,rabatt1,rabatt2,rabatt3,rabatt4,rabatt5,einheit,webid,rabatt,nachbestelltexternereinkauf,zolltarifnummer,herkunftsland,artikelnummerkunde,lieferdatumkw)
      VALUES('','{$this->auftrag}','{$this->artikel}','{$this->projekt}','{$this->bezeichnung}','{$this->beschreibung}','{$this->internerkommentar}','{$this->nummer}','{$this->menge}','{$this->preis}','{$this->waehrung}','{$this->lieferdatum}','{$this->vpe}','{$this->sort}','{$this->status}','{$this->umsatzsteuer}','{$this->bemerkung}','{$this->geliefert}','{$this->geliefert_menge}','{$this->explodiert}','{$this->explodiert_parent}','{$this->logdatei}','{$this->punkte}','{$this->bonuspunkte}','{$this->mlmdirektpraemie}','{$this->keinrabatterlaubt}','{$this->grundrabatt}','{$this->rabattsync}','{$this->rabatt1}','{$this->rabatt2}','{$this->rabatt3}','{$this->rabatt4}','{$this->rabatt5}','{$this->einheit}','{$this->webid}','{$this->rabatt}','{$this->nachbestelltexternereinkauf}','{$this->zolltarifnummer}','{$this->herkunftsland}','{$this->artikelnummerkunde}','{$this->lieferdatumkw}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE auftrag_position SET
      auftrag='{$this->auftrag}',
      artikel='{$this->artikel}',
      projekt='{$this->projekt}',
      bezeichnung='{$this->bezeichnung}',
      beschreibung='{$this->beschreibung}',
      internerkommentar='{$this->internerkommentar}',
      nummer='{$this->nummer}',
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
      geliefert_menge='{$this->geliefert_menge}',
      explodiert='{$this->explodiert}',
      explodiert_parent='{$this->explodiert_parent}',
      logdatei='{$this->logdatei}',
      punkte='{$this->punkte}',
      bonuspunkte='{$this->bonuspunkte}',
      mlmdirektpraemie='{$this->mlmdirektpraemie}',
      keinrabatterlaubt='{$this->keinrabatterlaubt}',
      grundrabatt='{$this->grundrabatt}',
      rabattsync='{$this->rabattsync}',
      rabatt1='{$this->rabatt1}',
      rabatt2='{$this->rabatt2}',
      rabatt3='{$this->rabatt3}',
      rabatt4='{$this->rabatt4}',
      rabatt5='{$this->rabatt5}',
      einheit='{$this->einheit}',
      webid='{$this->webid}',
      rabatt='{$this->rabatt}',
      nachbestelltexternereinkauf='{$this->nachbestelltexternereinkauf}',
      zolltarifnummer='{$this->zolltarifnummer}',
      herkunftsland='{$this->herkunftsland}',
      artikelnummerkunde='{$this->artikelnummerkunde}',
      lieferdatumkw='{$this->lieferdatumkw}'
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

    $sql = "DELETE FROM auftrag_position WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->auftrag="";
    $this->artikel="";
    $this->projekt="";
    $this->bezeichnung="";
    $this->beschreibung="";
    $this->internerkommentar="";
    $this->nummer="";
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
    $this->geliefert_menge="";
    $this->explodiert="";
    $this->explodiert_parent="";
    $this->logdatei="";
    $this->punkte="";
    $this->bonuspunkte="";
    $this->mlmdirektpraemie="";
    $this->keinrabatterlaubt="";
    $this->grundrabatt="";
    $this->rabattsync="";
    $this->rabatt1="";
    $this->rabatt2="";
    $this->rabatt3="";
    $this->rabatt4="";
    $this->rabatt5="";
    $this->einheit="";
    $this->webid="";
    $this->rabatt="";
    $this->nachbestelltexternereinkauf="";
    $this->zolltarifnummer="";
    $this->herkunftsland="";
    $this->artikelnummerkunde="";
    $this->lieferdatumkw="";
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
  function SetAuftrag($value) { $this->auftrag=$value; }
  function GetAuftrag() { return $this->auftrag; }
  function SetArtikel($value) { $this->artikel=$value; }
  function GetArtikel() { return $this->artikel; }
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetBezeichnung($value) { $this->bezeichnung=$value; }
  function GetBezeichnung() { return $this->bezeichnung; }
  function SetBeschreibung($value) { $this->beschreibung=$value; }
  function GetBeschreibung() { return $this->beschreibung; }
  function SetInternerkommentar($value) { $this->internerkommentar=$value; }
  function GetInternerkommentar() { return $this->internerkommentar; }
  function SetNummer($value) { $this->nummer=$value; }
  function GetNummer() { return $this->nummer; }
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
  function SetGeliefert_Menge($value) { $this->geliefert_menge=$value; }
  function GetGeliefert_Menge() { return $this->geliefert_menge; }
  function SetExplodiert($value) { $this->explodiert=$value; }
  function GetExplodiert() { return $this->explodiert; }
  function SetExplodiert_Parent($value) { $this->explodiert_parent=$value; }
  function GetExplodiert_Parent() { return $this->explodiert_parent; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }
  function SetPunkte($value) { $this->punkte=$value; }
  function GetPunkte() { return $this->punkte; }
  function SetBonuspunkte($value) { $this->bonuspunkte=$value; }
  function GetBonuspunkte() { return $this->bonuspunkte; }
  function SetMlmdirektpraemie($value) { $this->mlmdirektpraemie=$value; }
  function GetMlmdirektpraemie() { return $this->mlmdirektpraemie; }
  function SetKeinrabatterlaubt($value) { $this->keinrabatterlaubt=$value; }
  function GetKeinrabatterlaubt() { return $this->keinrabatterlaubt; }
  function SetGrundrabatt($value) { $this->grundrabatt=$value; }
  function GetGrundrabatt() { return $this->grundrabatt; }
  function SetRabattsync($value) { $this->rabattsync=$value; }
  function GetRabattsync() { return $this->rabattsync; }
  function SetRabatt1($value) { $this->rabatt1=$value; }
  function GetRabatt1() { return $this->rabatt1; }
  function SetRabatt2($value) { $this->rabatt2=$value; }
  function GetRabatt2() { return $this->rabatt2; }
  function SetRabatt3($value) { $this->rabatt3=$value; }
  function GetRabatt3() { return $this->rabatt3; }
  function SetRabatt4($value) { $this->rabatt4=$value; }
  function GetRabatt4() { return $this->rabatt4; }
  function SetRabatt5($value) { $this->rabatt5=$value; }
  function GetRabatt5() { return $this->rabatt5; }
  function SetEinheit($value) { $this->einheit=$value; }
  function GetEinheit() { return $this->einheit; }
  function SetWebid($value) { $this->webid=$value; }
  function GetWebid() { return $this->webid; }
  function SetRabatt($value) { $this->rabatt=$value; }
  function GetRabatt() { return $this->rabatt; }
  function SetNachbestelltexternereinkauf($value) { $this->nachbestelltexternereinkauf=$value; }
  function GetNachbestelltexternereinkauf() { return $this->nachbestelltexternereinkauf; }
  function SetZolltarifnummer($value) { $this->zolltarifnummer=$value; }
  function GetZolltarifnummer() { return $this->zolltarifnummer; }
  function SetHerkunftsland($value) { $this->herkunftsland=$value; }
  function GetHerkunftsland() { return $this->herkunftsland; }
  function SetArtikelnummerkunde($value) { $this->artikelnummerkunde=$value; }
  function GetArtikelnummerkunde() { return $this->artikelnummerkunde; }
  function SetLieferdatumkw($value) { $this->lieferdatumkw=$value; }
  function GetLieferdatumkw() { return $this->lieferdatumkw; }

}

?>