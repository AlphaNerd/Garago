<?php

App::uses('AppController', 'Controller');

/**
 * Documents Controller
 *
 * @property Document $Document
 */
class DocumentsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Document->recursive = 0;
		$this->set('documents', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Document->exists($id)) {
			throw new NotFoundException(__('Invalid document'));
		}
		$options = array('conditions' => array('Document.' . $this->Document->primaryKey => $id));
		$this->set('document', $this->Document->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

		if ($this->request->is('post')) {
     	$this->layout=null;
			$espaceprofile=17;
            $id_users=$this->Session->read("id");
			 $this->loadModel('DocumentCategory');
			 $this->loadModel('DocumentCustomer');
			 $this->loadModel('DocumentLanguage');
			 $this->loadModel('DocumentSector');
			  $this->loadModel('Attachment');
	$source_dir = 'files'.DS.$this->request->data['name'];	
 if (!file_exists($source_dir)) {
    mkdir($source_dir, 0777, true);
 }


				 $main_document = $this->request->data['Document']["upload"];
          if($main_document["size"]>0){
             $fileMain_document= fread(fopen($main_document["tmp_name"],"r"),$main_document["size"]);
              }

             $associated_documents1 = $associated_documents=$this->request->data['Document']['file'];
              	foreach ($associated_documents as $associated_document) 
						{
							$filename =$source_dir.DS.$associated_document['name'];
						 move_uploaded_file($associated_document["tmp_name"], $filename);
						}


//$file_list = Utils::listDirectory($source_dir);
$dir = $source_dir;
//  si le dossier pointe existe
$files=array();
if (is_dir($dir)) {
   // si il contient quelque chose
   if ($dh = opendir($dir)) {

       // boucler tant que quelque chose est trouve
       while (($file = readdir($dh)) !== false) {
           // affiche le nom et le type si ce n'est pas un element du systeme
           if( $file != '.' && $file != '..') {
           //echo "fichier : $file : type : " . filetype($dir .'/'. $file) . "<br />\n";
           $files[]=$file;
           }
       }
       // on ferme la connection
       closedir($dh);
   }
}
 $zip = new ZipArchive(); 
      if($zip->open($source_dir.'.zip', ZipArchive::CREATE) === true)
      {
	// Création d'un dossier par addEmptyDir(). [Facultatif]
       $zip->addEmptyDir('Fichiers textes');
	// Ajout d'un fichier.
      	foreach ($files as $file) {
	$zip->addFile($dir.'/'.$file);
	}
	// Ajout directement.
	//$zip->addFromString('Fichiers textes/Fichier.txt', 'Je suis le contenu de Fichier.txt !');
	$zip->close();
      }

$filedocument =addslashes(file_get_contents($source_dir.'.zip'));
				 $document=
				 array('name'=>$this->request->data['name'],
				 	'country'=>$this->request->data['country'],
				 	'theme'=>$this->request->data['them'],
				 	'description'=>$this->request->data['description'],
				 	'keyword'=>$this->request->data['keyword'],
				 	'price'=>$this->request->data['Document']['price'],
				 	'visibility'=>$this->request->data['visibility'],
				 	'date_created'=>$this->request->data['Document']['creation_date'],
				 	'main_document'=>$fileMain_document,
				 	'associated_document'=>$filedocument,
				 	'user_id'=>$id_users,
				 	'mime'=>$main_document["type"]
				 	);
				 $this->Document->create();
				 $this->Document->save($document);
				 $document_id=$this->Document->getLastInsertID();
				   $associated_documents=$this->request->data['Document']['file'];
              	foreach ($associated_documents1 as $associated_document) 
						{
							if($associated_document['size']>31457280)
							{
								$zip = new ZipArchive(); 
								      if($zip->open('files'.DS.explode('.',$associated_document["name"])[0].'.zip', ZipArchive::CREATE) === true)
								      {
									$zip->addFile($dir.'/'.$associated_document['name']);
									$zip->close();
								      }
								$file=addslashes(file_get_contents('files'.DS.explode('.',$associated_document["name"])[0].'.zip'));
							}else
							{
								$file=addslashes(file_get_contents($source_dir.'/'.$associated_document["name"]));

							}
						 $data=array(
						 	'extension'=>explode('.',$associated_document["name"])[sizeof(explode('.',$associated_document["tmp_name"]))-1],
						 	'file'=>$file,
						 	'document_id'=>$document_id,
						 	'size'=>$this->bytes($associated_document['size']),
						 	'name'=>$associated_document['name'],
						 	'mime'=>$associated_document["type"]
						 	);
						 $this->Attachment->create();
						 $this->Attachment->save($data);
						   shell_exec('rm -rf ' . realpath('files'.DS.explode('.',$associated_document["name"])[0].'.zip'));
						}
						shell_exec('rm -rf ' . realpath($source_dir));
                        shell_exec('rm -rf ' . realpath($source_dir.'.zip'));
				 foreach ($this->request->data['s'] as $key => $value) {
				 		$documentSector=array('sector_id'=>$key,
				 			'document_id'=>$document_id);
				 		$this->DocumentSector->create();
				 $this->DocumentSector->save($documentSector);
				 	}
				 	foreach ($this->request->data['l'] as $key => $value) {
				 		$documentLanguage=array('language_id'=>$key,
				 			'document_id'=>$document_id);
				 		$this->DocumentLanguage->create();
				 $this->DocumentLanguage->save($documentLanguage);
				 	}	
				 	foreach ($this->request->data['c'] as $key => $value) {
				 		$DocumentCategory=array('categorie_id'=>$key,
				 			'document_id'=>$document_id);
				 		$this->DocumentCategory->create();
				 $this->DocumentCategory->save($DocumentCategory);
				 	}	
				 	foreach ($this->request->data['u'] as $key => $value) {
				 		$DocumentCustomer=array('customer_id'=>$key,
				 			'document_id'=>$document_id);
				 		$this->DocumentCustomer->create();
				 $this->DocumentCustomer->save($DocumentCustomer);
				 	}	
		
			if ($this->Document->save($this->request->data)) {
				$this->Session->setFlash(__('The document has been saved'));
				
				$this->redirect(array('controller'=>'documents','action' => 'index'));
			} else {
				$this->Session->setFlash(__('The document could not be saved. Please, try again.'));
			}
			 
		}else
		{
APP::import('Model','Sector');
$this->Sector = new Sector;
APP::import('Model','Category');
$this->Category = new Category;
APP::import('Model','Customer');
$this->Customer = new Customer;
APP::import('Model','Language');
$this->Language = new Language;
$Sectors = $this->Sector->find('all');
$Categorys = $this->Category->find('all');
$Customers = $this->Customer->find('all');
$Languges = $this->Language->find('all');
$this->set(compact('Sectors', 'Categorys', 'Customers', 'Languges'));
		}

	}
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Document->exists($id)) {
			throw new NotFoundException(__('Invalid document'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Document->save($this->request->data)) {
				$this->Session->setFlash(__('The document has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The document could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Document.' . $this->Document->primaryKey => $id));
			$this->request->data = $this->Document->find('first', $options);
		}
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Document->id = $id;
		if (!$this->Document->exists()) {
			throw new NotFoundException(__('Invalid document'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Document->delete()) {
			$this->Session->setFlash(__('Document deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Document was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


	function bytes($a) {
		return $a;
    $unim = array("B","KB","MB","GB","TB","PB");
    $c = 0;
    while ($a>=1024) {
        $c++;
        $a = $a/1024;
    }
    return number_format($a,($c ? 2 : 0),",",".")." ".$unim[$c];
}


}
