<?php


App::uses('Controller', 'Controller');
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
session_start();
class AppController extends Controller {


	// added the debug toolkit
	// sessions support
	// authorization for login and logut redirect
	public $components = array(
		'RequestHandler',
		'Session',
		//'DebugKit.Toolbar',
   //      'Auth' => array(
   //          'loginRedirect' => array('controller' => 'users', 'action' => 'index'),
   //          'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			// 'authError' => 'You must be logged in to view this page.',
			// 'loginError' => 'Invalid Username or Password entered, please try again.'
 
   //      )
        );
	
	// only allow the login controllers only
	public function beforeFilter() {


$model=array('Action','Activite','ActivityManage','Axis','Bankaccount','Budget','BudgetDetail','Category','Comment','ComponentCategory','ComponentCustomer',
	         'ComponentLanguage','ComponentSector','Composant','Customer','DetailPlan','Document','DocumentCategory','DocumentCUstomer','DocumentLanguage',
	         'DocumentSector','Group','GroupeUser','Historical','HistotricalPlan','HumanSource','Indicator','Invoice','InvoiceDetail','Item','Job','JobeDetail','Language','LinkWeb','MaterialSource','Message',
	         'ModePayment','Notification','Offer','OptionPlan','Payment','PermissionAccess','PersonalOffer','Plan','PlanComposant','Project','ProjectDetailPlanning','Regulation','Sector','SocialProfile','StylePlanning',
	         'Tach','Task','TypeBankaccount','TypeComponent','TypePlan','User','VisionPlan');
$atrribute=array(
	$model[0]=>array('id','document_id','profile_id','type','date_action'),//Action
	$model[1]=>array('id','num','title','description','cible','detail_planning_id'),//Activiter
	$model[2]=>array('id','activiter_id','user_id','date'),//ActivityManger
	$model[3]=>array('id','title','historical_plan_id','position'),//Axis
	$model[4]=>array('id'),//Bankaccount
	$model[5]=>array('id','reference','total','type_budget','source_id'),//Budget
	$model[6]=>array('id',''),//BudgetDetail
	$model[7]=>['id','description','langue'],//Category
	$model[8]=>['id','plan_id','ref_cel','email_send','name','date_send','organization','message','email_recive','favorite'],//Comment
	$model[9]=>['id','component_id','category_id'],//ComponentCategory
	$model[10]=>['id','component_id','customer_id'],//ComponentCustomer
	$model[11]=>['id','component_id','language_id'],//ComponentLanguage
	$model[12]=>['id','component_id','sector_id'],//ComponentSector
	$model[13]=>['id','title','description','type_id'],//Composant
	$model[14]=>['id','description','langue'],//Customer
	$model[15]=>['id','line','row','Date_change','content','id_user','axes_id'],//DetailPlan
	$model[16]=>['id','name','country','theme','description','keyword','price','visibility','date_created','mains_document','associated_document','user_id'],//Document
	$model[17]=>['id','document_id','categorie_id'],//DocumentCatogory
	$model[18]=>['id','document_id','customer_id'],//DocumentCustomer
	$model[19]=>['id','document_id','language_id'],//DocumentLanguage
	$model[20]=>['id','document_id','sector_id'],//DocumentSector
	$model[21]=>['id','name','nombre','responsable'],//Group
	$model[22]=>['id','users_id','group_id'],//GroupeUser
	$model[23]=>['id','period','rabais','regulation_id','user_id'],//Historical
	$model[24]=>['id','plan_id','user_id','date'],//HistoricalPlan
	$model[25]=>['id','detail_plan_id'],//HumanSource
	$model[26]=>['id','num','description','type','cible','valeur','date_fin','activiter_id'],//Indicator
	$model[27]=>['id','ref','date','total_price','user_id'],//Invoice
	$model[28]=>['id','invoice_line','price','quantity','invoice_id'],//InvoiceDetail
	$model[29]=>['id','name','price','description','langue'],//Item
	$model[30]=>['id','refrences','total','detail_plan_id'],//Job
	$model[31]=>['id','item','nbr_temporary','nbr_permed','job_id'],//JobDetail
	$model[32]=>['id','name','abbreviation'],//Language
	$model[33]=>['id','link','plan_id'],//LinkWeb
	$model[34]=>['id','detail_plan_id'],//MaterialSource
	$model[35]=>['id','description','date_message','vu','id_profile_send','id_profile_recu'],//Message
	$model[36]=>['id','type','description'],//ModePayment
	$model[37]=>['id','description','date_notification','vu','id_profile_send','id_profile_recu'],//Notification
	$model[38]=>['id','nombre','price','regulation_id','item_id'],//Offer
	$model[39]=>['id','description','plan_id'],//OptionPlan
	$model[40]=>['id','payment_date','total_price','mode_payment_id','invoice_id'],//Payment
	$model[41]=>['id','permission','date_start','date_end','user_id','personal_offers_id','task_id'],//PermissionAccess
	$model[42]=>['id','number','price','historical_id','item_id'],//PersonalOffer
	$model[43]=>['id','title','date_create','logo','adress','user_id'],//Plan
	$model[44]=>['id','plan_id','title','row'],//PlanComposant
	$model[45]=>['id','title','description','accompli','notify_user'],//Project
	$model[46]=>['id','detail_planning_id','project_id'],//ProjectDetailPlanning
	$model[47]=>['id','name','date','price','description','period'],//Regulation
	$model[48]=>['id','description','langue'],//Sector
	$model[49]=>['id','user_id','social_network_name','social_network_id','email','display_name','first_name','last_name','link','picture','created','modified','status'],//SocialProfile
	$model[50]=>['id','historical_plan_id','font-family','font-size','color','background-color','font-style','font-weight'],//StylePlanning
	$model[51]=>['id','title','description','date_debut','date_fin','heurs_estimee','tauxe_estimee','urgent','notify_user','accompli','project_id'],//Tach
	$model[52]=>['id','description','references','item_id'],//Task
	$model[53]=>['id','description'],//TypeBankaccount
	$model[54]=>['id','description','langue'],//TypeComponent
	$model[55]=>['id','description','position','plan_id'],//TypePlan
	$model[56]=>['id','username','password','email','role','created','modified','status'],//User
	$model[57]=>['id'],//VisionPlan
	);

























     //  $this->Auth->allow('login');
		$this->Session->write('id','14');
        $user_id = $this->Session->read("id");
        $this->set('user_id', $user_id);
        $this->set('atrribute',$atrribute);
         if ($this->Session->check('Config.language')) {
           //  Configure::write('Config.language', $this->Session->read('Config.language'));
            configure::write('langue', $this->Session->read('Config.language'));
        }
$langue = $this->Session->read('Config.language');
        $this->set('langue', $langue);
        
    }
	
	public function isAuthorized($user) {
		// Here is where we should verify the role and give access based on role
		
		return true;
	}
	
	public function getHtml($content=null)
{
  $find=array('&amp;','&lt;','&gt;');
  $filter=array('&','<','>');
  return str_replace($find, $filter, $content);
}
public function getEntiteHtml($content=null)
{
   $find=array('&amp;','&lt;','&gt;');
  $filter=array('&','<','>');
  return str_replace($filter, $find, $content);
}
}
