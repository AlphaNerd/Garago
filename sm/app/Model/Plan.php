<?php
App::uses('AppModel', 'Model');
/**
 * Plan Model
 *
 */
class Plan extends AppModel {
// public $validate = array(
		
// 		'avatar_file'=>array(
// 			'rule'=>array('fileExtension',array('ico','png')),
// 			'message'=>'vous ne pouvez  envoyer que ico ou png'
// 			));



 //   public function fileExtension($check, $extensions, $allowEmpty = true)
	// 				    {
	// 				        $file = current($check);
	// 				        if($allowEmpty && empty($file['tmp_name'])){
	// 				            return true;
	// 				        }
	// 				        $extension = strtolower(pathinfo($file['name'] , PATHINFO_EXTENSION));
	// 				        return in_array($extension, $extensions);
	// 				    }
	// 				    public function beforeDelete($cascade = true)
	// 				    {
	// 				    	$oldextension=$this->field('Logo');
	// 				        	$oldfile= IMAGES. 'Logo'. DS. $this->id . '.' . $oldextension;
					        	
	// 				        	if (file_exists($oldfile))
	// 				        	 {
	// 				        		unlink($oldfile);
	// 				        	 }
	// 				    }
	// public function afterSave($created)
	// 				     {
	// 				        if(isset($this->data[$this->alias]['avatar_file']))
	// 				        {
	// 				        	$file=$this->data[$this->alias]['avatar_file'];
	// 				        $extension=strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
	// 				        if(!empty($file['tmp_name']))
	// 				        {
	// 				        	$oldextension=$this->field('Logo');
	// 				        	$oldfile= IMAGES. 'Logo'. DS. $this->id . '.' . $oldextension;
					        	
	// 				        	if (file_exists($oldfile))
	// 				        	 {
	// 				        		unlink($oldfile);
	// 				        	 }
	// 				        	move_uploaded_file($file['tmp_name'],IMAGES.'Logo'.DS.$this->id.
	// 				        		'.'.$extension);
	// 				        }
	// 				      //  $this->saveField('Logo',$extension);
	// 				         }
					          
	// 				     }
}
