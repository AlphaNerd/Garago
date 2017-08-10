<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */

class PagesController extends AppController {


/**
 * Controller name
 *
 * @var string
 */
  public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
  public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
  public function index() {
APP::import('Model','Document');
     $this->Document = new Document;
//$documents=$this->Document->find('all');
$string="SELECT * FROM documents";
$documents=$this->Document->query($string);
    APP::import('Model','Sector');
$this->Sector = new Sector;
APP::import('Model','Category');
$this->Category = new Category;
APP::import('Model','Customer');
$this->Customer = new Customer;
APP::import('Model','Language');
$this->Language = new Language;
$Sectors=$this->Sector->find('all');
$Categorys=$this->Category->find('all');
$Customers=$this->Customer->find('all');
$Languages=$this->Language->find('all');
APP::import('Model','Attachment');
$this->Attachment = new Attachment;
 APP::import('Model','Action');
     $this->Action = new Action;
     if($this->Session->check("id"))
     {
      $user_id=$this->Session->read("id");
     }
     $actions=$this->Action->find('all',array('conditions'=>array('Action.profile_id'=>$user_id)));
     $tab=array();
     foreach ($actions as $action) {
       $tab[]=$action['Action']['document_id'];
     }
     
     $document_actionnes=$this->Document->find('all',array('conditions'=>array('Document.id'=>$tab)));


$extensions=$this->Attachment->find('all',array('fields'=>'DISTINCT Attachment.extension'));
$this->set(compact('Sectors','documents', 'Categorys', 'Customers', 'Languages','extensions','actions','document_actionnes'));
  
  }


public function detail($liste=null)
{

$tab=explode(",",$liste); 
  $this->layout=null;
  $this->loadModel("Attachment");
  APP::import('Model','Action');
     $this->Action = new Action;
       APP::import('Model','Document');
     $this->Document = new Document;
  if(count($tab)==1)
    $id=$liste;
  else
  {
   $action=array(
  'document_id'=>$tab[0],
  'profile_id'=>$tab[1],
  'type'=>$tab[2],
  'date_action'=>date("20y-m-d H:s"));
      $this->Action->create();
     $this->Action->save($action);
$id=$tab[0];
  }
$documents=$this->Document->findById($id);
$attachments=$this->Attachment->findAllByDocumentId($id);
$actions=$this->Action->find('all',array('conditions'=>array('Action.document_id'=>$id)));
if(count($tab)>1)
if($tab[2]=="download")
{
foreach ($attachments as $attachment) {
// // header("Content-Type: ".$attachment['Attachment']['mime']);
// // ob_clean();
// // flush();
// //echo $attachment['Attachment']['file'];
//   header('Content-Length: '.);
//  header('Content-Type: '.);
//  header('Content-Disposition: attachment; filename="'.$attachment['Attachment']['file'].'"');

 $this->Download($attachment['Attachment']['size'],$attachment['Attachment']['mime'],$attachment['Attachment']['name'],$attachment['Attachment']['file']);

 // ob_clean();
 // flush();
}
//echo "<pre>";
// print_r($tab);
die();
//  $zip = new ZipArchive(); 
//       // On ouvre l’archive.
//  $dir=explode("\\",$documents[0]['Document']['url']);
 
//  $zipe='files'.DS.$dir[1].DS.$dir[2].DS.$documents[0]['Document']['name'].DS.$documents[0]['Document']['name'].".zip";
 
//       if($zip->open($zipe== TRUE))
      
//       if($zip->open($zipe, ZipArchive::CREATE) == TRUE)
//       {
        
//       }
     
// foreach ($documents as $document) {
//   for($i=0;$i<count($document['Attachment']);$i++)
//   {
    
//   $zip->addFile($document['Attachment'][$i]['url']);
//   }
// }
// $zip->close();
}

$this->set(compact('documents','actions','attachments'));
}
public function rechercher($chaine=mull)
{
  
  $documents=$this->search($chaine);
   $this->set(compact('documents'));
}

  function indexation($text)
  {
      $dirvide= new Folder('files' . DS .'Vide');
      $filevide = new File($dirvide->pwd() . DS . '2.txt');
    $contentsvide = $filevide->read();
$motevide = utf8_encode($contentsvide);
    $motevide=explode(",",$motevide);
     $mots=array();
    //$fichier=explode(" ",$fichier);
   for ($i=0; $i <count($motevide) ; $i++) { 
    $mots[]= $motevide[$i];
    }
$saisie=explode(" "," ".$text);
    $indexe=array();
    for ($i=0; $i <count($saisie) ; $i++) { 
    if(!in_array($saisie[$i], $mots)&&strlen(trim($saisie[$i]))>1)
      {
        $indexe[]=$saisie[$i];
      }
  }
    $saisie= array_values($indexe);

   return $saisie;
}
  public function search($chaine=null)
  {
      $this->layout=null;
    $optionsearch=explode(',', $chaine);
 
APP::import('Model','User');
$this->User = new User;
APP::import('Model','Sector');
$this->Sector = new Sector;
APP::import('Model','Category');
$this->Category = new Category;
APP::import('Model','Customer');
$this->Customer = new Customer;
APP::import('Model','Language');
$this->Language = new Language;
APP::import('Model','DocumentSector');
$this->DocumentSector = new DocumentSector;
APP::import('Model','DocumentCategory');
$this->DocumentCategory = new DocumentCategory;
APP::import('Model','DocumentCustomer');
$this->DocumentCustomer = new DocumentCustomer;
APP::import('Model','DocumentLanguage');
$this->DocumentLanguage = new DocumentLanguage;
APP::import('Model','Attachment');
$this->Attachment = new Attachment;
$DocumentCategorys=array();
$DocumentSectors=array();
$AttachmentsA=array();
$DocumentLanguages=array();
$DocumentCustomers=array();
  $tab=$this->indexation($optionsearch[0]);
  $Attachments = $this->Attachment->find('all',array(
            'fields'=>'DISTINCT Attachment.document_id'
              ));

          APP::import('Model','Document');
              $this->Document = new Document;
     if(count($tab))
     {
       if($optionsearch[7]!='0')
          $Attachments = $this->Attachment->find('all',array(
            'fields'=>'DISTINCT Attachment.document_id',
            'conditions'=>array('Attachment.extension'=>$optionsearch[7]
              )));
     
       if($optionsearch[2]!='0')
       {
          $DocumentSector = $this->DocumentSector->find('all',array(
            'fields'=>'DISTINCT DocumentSector.document_id',
            'conditions'=>array('DocumentSector.sector_id'=>$optionsearch[2]
            )));
        }
        else
        {
           $DocumentSector = $this->DocumentSector->find('all',array(
            'fields'=>'DISTINCT DocumentSector.document_id'
            ));
         }
         if($optionsearch[3]!='0')
         {
          $DocumentCategory = $this->DocumentCategory->find('all',array(
            'fields'=>'DISTINCT DocumentCategory.document_id',
            'conditions'=>array('DocumentCategory.categorie_id'=>$optionsearch[3]
            )));
        }
        else
        {
           $DocumentCategory = $this->DocumentCategory->find('all',array(
            'fields'=>'DISTINCT DocumentCategory.document_id'
            ));
         }
         if($optionsearch[4]!='0')
         {
          $DocumentCustomer = $this->DocumentCustomer->find('all',array(
            'fields'=>'DISTINCT DocumentCustomer.document_id',
            'conditions'=>array('DocumentCustomer.customer_id'=>$optionsearch[4]
            )));
        }
        else
        {
           $DocumentCustomer = $this->DocumentCustomer->find('all',array(
            'fields'=>'DISTINCT DocumentCustomer.document_id'
            ));
         }
         if($optionsearch[1]!='0')
         { 
          $DocumentLanguage = $this->DocumentLanguage->find('all',array(
            'fields'=>'DISTINCT DocumentLanguage.document_id',
            'conditions'=>array('DocumentLanguage.language_id'=>$optionsearch[1]
            )));
        }
        else
        {
            $DocumentLanguage = $this->DocumentLanguage->find('all',array(
            'fields'=>'DISTINCT DocumentLanguage.document_id'
           ));
      }
         foreach ($DocumentSector as $documentSector) {
          $DocumentSectors[]=$documentSector['DocumentSector']['document_id'];
        }
         foreach ($Attachments as $attachment) {
          $AttachmentsA[]=$attachment['Attachment']['document_id'];
        }
           foreach ($DocumentCategory as $documentCategory) {
          $DocumentCategorys[]=$documentCategory['DocumentCategory']['document_id'];
        }
          foreach ($DocumentCustomer as $documentCustomer) {
          $DocumentCustomers[]=$documentCustomer['DocumentCustomer']['document_id'];
        }
          foreach ($DocumentLanguage as $documentLanguage) {
          $DocumentLanguages[]=$documentLanguage['DocumentLanguage']['document_id'];
        }
       
$document=array_values(array_intersect($DocumentSectors, 
  $DocumentCategorys,$DocumentCustomers,$DocumentLanguages,$AttachmentsA));

$userString="SELECT id FROM users where username LIKE '%".$tab[0]."%' OR email LIKE '%".$tab[0]."'";
for($i=1;$i<count($tab);$i++)
             {
              $userString.=" OR username LIKE '%".$tab[$i]."%' OR email LIKE '%".$tab[$i]."'";
            }

$userid=$this->User->query($userString);
$usersarrayid=array('0');
for ($i=0; $i <count($userid) ; $i++) { 
 $usersarrayid[]=$userid[$i]['users']['id'];
}


      $string="SELECT * FROM documents where   ((keyword LIKE '%".$tab[0]."%' OR name LIKE '%".$tab[0]."%' OR description LIKE '%".$tab[0]."%'";
             for($i=1;$i<count($tab);$i++)
             {
              $string.=" OR keyword LIKE '%".$tab[$i]."%' OR name LIKE '%".$tab[$i]."%' OR description LIKE '%".$tab[$i]."%'";
             }
         if(count($document)){
          $string.=") AND (id='".$document[0]."'";
for($j=1;$j<count($document);$j++)
{
  $string .=" OR id='".$document[$j]."'";
}
}else{
  $string.=") AND ( id='0'";
}


$string.=") OR ( user_id ='".$usersarrayid[0]."'";
for ($i=01; $i <count($usersarrayid) ; $i++) { 
  $string.=" OR user_id ='".$usersarrayid[$i]."'";
}

$string.=" ))";

if($optionsearch[5]!='0' && $optionsearch[6]!='0' )
{
  $string.=" AND date_created BETWEEN '".$optionsearch[5]."' AND '".$optionsearch[6]."'";
}else if($optionsearch[5]!='0')
{
 $string.=" AND date_created >= '".$optionsearch[5]."'";
}
else if($optionsearch[6]!='0')
$string.=" AND date_created <= '".$optionsearch[6]."'";

             $documents=$this->Document->query($string);
          for($i=0;$i<count($documents);$i++)
          {
            $Sector="";
            $Category="";
            $Customer="";
            $Language=array();
            $user = $this->User->findById($documents[$i]['documents']['user_id']);     
          $Attachment = $this->Attachment->find('all',array('conditions'=>array('Attachment.document_id'=>$documents[$i]['documents']['id'])));
          $DocumentSector = $this->DocumentSector->findAllByDocumentId($documents[$i]['documents']['id']);
         
          $DocumentCategory = $this->DocumentCategory->findAllByDocumentId($documents[$i]['documents']['id']);
          $DocumentCustomer = $this->DocumentCustomer->findAllByDocumentId($documents[$i]['documents']['id']);
          $DocumentLanguage = $this->DocumentLanguage->findAllByDocumentId($documents[$i]['documents']['id']);
              for ($j=0; $j <count($DocumentSector) ; $j++)  
              {
                 
                 $tab=$this->Sector->findById($DocumentSector[$j]['DocumentSector']['sector_id']);
                 $Sector[]=$tab['Sector']['description'];
              }
           for ($j=0; $j <count($DocumentCategory) ; $j++)
           $Category[]=$this->Category->findById($DocumentCategory[$j]['DocumentCategory']['categorie_id'])['Category']['description'];
          for ($j=0; $j <count($DocumentCustomer) ; $j++)
           $Customer[]=$this->Customer->findById($DocumentCustomer[$j]['DocumentCustomer']['customer_id'])['Customer']['description'];
           for ($j=0; $j <count($DocumentLanguage) ; $j++)
           $Language[]=$this->Language->findById($DocumentLanguage[$j]['DocumentLanguage']['language_id'])['Language']['name'];
                        
              $documents[$i]=array_merge($documents[$i],array('option'=>array(
                'Sector'=>$Sector,
                'Category'=>$Category,
                'Customer'=>$Customer,
                'Langue'=>$Language,
                'Attachments'=>$Attachment,
                'user'=>$user
                )
              )
              );
            
              }

         return $documents;
          
       } 
  }


function Download($size,$type,$title,$content)
{
     header('Content-Type:'.$type);
    header('Content-Length: '. $size);
    header('Content-disposition: attachment; filename='. $name);
    header('Pragma: no-cache');
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
    readfile($content);
    exit();
        // header("Content-Length: $size");
        // header("Content-Type: $type");
        // header("Content-Disposition: attachment; filename=".$title);
        // echo $content;

}

}
