<?php

/**
*
* @package phpBB3
* @version $Id$
* @athor: Gerco Versloot
* @date: 6 - 8 - 2012
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @Gumbo millennium
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include_once($phpbb_root_path . 'common.' . $phpEx);
include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);
include_once($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include_once ($phpbb_root_path . 'dc/dc_activities_handler.' . $phpEx);
include_once ($phpbb_root_path . 'dc/dc_activity_class.' . $phpEx);
include_once($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/dc_activity');


if(!isset($_GET["act"])){
	trigger_error($user->lang['DC_ACT_NO_ACT']);
}

// Build main objects
$act_hndlr = new activities_handler();			// build activity handler
$activity_id = request_var('act', 0);			// get activity by id (default = 0)	

if($activity_id == 0){
	trigger_error($user->lang['DC_ACT_NO_ACT']);
}

$activity = Activity::get_activity($activity_id, $act_hndlr, intval($user->data['user_id']));	
if($activity == NULL){
	trigger_error($user->lang['DC_ACT_NO_ACT']);				// send error to the user
	
	return null;
}

$manager = $activity->is_manager($user->data['user_id']);
$in_the_past = ($activity->getStartDatetime() < new DateTime('now') ? true : false) ;

// get authorisation 
if (!($activity->user_access($user->data['user_id']) || $manager) )
{
	trigger_error('NOT_AUTHORISED');
}

// set activity readed
if(!$activity->get_read(intval($user->data['user_id']))){
	$activity->set_read( intval($user->data['user_id']));
}
// change enrol status
$template->assign_var('CHANGE', ($change_status = request_var('change', false))); 	// open enrol select options (default = false)
$status = request_var('status', 0);											// get new enrol status (default = 0: no new status)

if($status != 0 && check_form_key('chance_the_subscribe_status')){															// if a new status
	if($user->data['user_id'] == ANONYMOUS || $user->data['user_type'] == USER_INACTIVE){	// check if user is guest or if user is inactive
		trigger_error($user->lang['LOGIN_VIEWFORUM']);				// send error to the user
	}else {
		switch($status){														// check new status
			case 1:																// new status = yes
			if($activity->is_max_enrolled(1)){
				trigger_error($user->lang['DC_ACT_ENROLL_AMOUNT_MAX']);
			}else{
				$activity->set_users_status(
					array( 
						array(
							"user_id"		=> intval($user->data["user_id"]),
							"user_ip"		=> $user->ip,
							"status"		=> USER_SIGN_IN,
							)
						)
					);
				
					// test sends messagers
					$url = generate_board_url() . '/' . $user->page['page'];		// get current page
					$messenger = new messenger(FALSE);
					$messenger->subject($activity->getName());
					$messenger->template('dc_activity_subscribe',$user->data['user_lang']);
					$messenger->to($user->data['user_email'], $user->data['username']);
					$messenger->im($user->data['user_jabber'], $user->data['username']);
					$messenger->assign_vars(array(
						'ACTIVITY_NAME'    		=> $activity->getName(),
						'USERNAME'    			=> $user->data['username'],
						'START_DATETIME'    	=> $user->format_date( $activity->getStartDatetime()->getTimestamp()),
						'END_DATETIME'    		=> $user->format_date( $activity->getEndDatetime()->getTimestamp()),
						'UNSUBSCRIBE_DATETIME'	=> $user->format_date( $activity->getUnsubscribeMaxDatetime()->getTimestamp() ),
						'DESCRIPTION'    		=> $activity->getDescription_preview(10),
						'LINK'    				=> substr($url , 0, strpos($url , '?'))."?act=".$activity->getId(),		// remove all query parameters (like: ?sid=XXXX) and add only the current activity
						'COMMISSION'    		=> get_group_name($activity->getCommission())
						));
					$messenger->send($user->data['user_notify_type']);
					$messenger->save_queue();
				}
				break;
			case 2:																// new status = no					
			$activity->set_users_status(array(
				array(
					"user_id"		=> intval($user->data["user_id"]),
					"user_ip"		=> $user->ip,
					"status"		=> USER_SIGN_OUT
					)
				));
			break;
		}
	}
}

$enrol_list = $activity->get_enrol_list(ALL_USERS, 'ASC', "username");				// get enrol_list

// get comment
// Used the salt because the default must be a string to check if there is a new comment. 
// I wanted to use a boolean as default but that is impassable because than the input has to be aan boolean. 
// So if the input is the salt there is no new comment. 
$salt = (String)mt_rand(); 													// create (string) salt for gettting the comment 
$comment = utf8_normalize_nfc(request_var('comment', $salt)); 									// get new comment (default = $salt: no new comment)
if($comment != $salt && check_form_key('chance_the_subscribe_status')){														// check for a new comment
	if(array_key_exists($user->data['user_id'], $enrol_list)){ 			// check if user has enrolled
		$activity->set_user_comment($user->data['user_id'],$comment, $enrol_list); 		// set new comment
		$template->assign_var('COMMENT_SAVED', true);						// set template saved	
	}
}


add_form_key('chance_the_subscribe_status'); // set form key to avoid cross side scripting
// set default variables
$template->assign_var('TITLE', $activity->getName());						// set title
$template->assign_var('DESCRIPTION', $activity->getDescription());			// set description
$template->assign_var('START_DATE_TIME',$user->format_date( $activity->getStartDatetime()->getTimestamp()));	// set start date and time
$template->assign_var('END_DATE_TIME', $user->format_date( $activity->getEndDatetime()->getTimestamp()));		// set end date and time 

// check is current is singed in
if( isset($enrol_list[ $user->data['user_id']]) && $enrol_list[$user->data['user_id']]["status"] == "yes"){	// check if user is enrolled
	$template->assign_var('USER_ENROLLED_CHECK', true);										// set user enrolled
	$template->assign_var('USER_ENROLLED_PAID',  $enrol_list[$user->data['user_id']]["price_paid"]);	// set user amount paid
	$template->assign_var('USER_ENROLLED_STATUS', ucfirst( $enrol_list[$user->data['user_id']]["status"]) );	// set current user status	
	$template->assign_var('USER_ENROLLED_COMMENT', $enrol_list[$user->data['user_id']]["comments"]);		// get current comment
	
}else{
	$template->assign_var('USER_ENROLLED_CHECK', false); 									// user not enrolled
}

$sign_up_places = $activity->getEnrolMax() - $activity->getAmountEnrolledUser();
$template->assign_var('ENROLL', $activity->getEnrol());				// get enrol
$template->assign_var('U_SIGN_UPS_LEFT', ($activity->getEnrolMax() > 0) ? $sign_up_places : $user->lang['DC_ACT_ENROLL_UNLIMITED']);
$template->assign_var('IS_ACTIVE', $activity->getActive());			//get active
$template->assign_var('IS_ENROLL_MAX', $activity->is_max_enrolled(1)); // check the limit of subscriptions is reached
$enrol_date_time = $activity->getEnrolDateTime();			// get max enrol date and time
$unsubscribe_date_time = $activity->getUnsubscribeMaxDatetime();			// get the time the user has to unsubscribe
$template->assign_var('ENROLL_DATE',$user->format_date( $enrol_date_time->getTimestamp() )); // set end enrol date time
$template->assign_var('UNSUBSCRIBE_MAX_DATETIME',$user->format_date( $unsubscribe_date_time->getTimestamp() )); // set end enrol date time

if($enrol_date_time > new DateTime("now")){					// check if the enrol date time or  is past
	$template->assign_var('ENROLL_DATE_CHECK', true);		// enrol date time not past
}else{
	$template->assign_var('ENROLL_DATE_CHECK', false);		// enrol date time past
}
if($unsubscribe_date_time > new DateTime("now")){				// check if the unsubscrive date time or  is past
	$template->assign_var('UNSUBSCRIBE_DATE_CHECK', true);		// enrol date time not past
}else{
	$template->assign_var('UNSUBSCRIBE_DATE_CHECK', false);		// enrol date time past
}	




// some more default variables
$template->assign_var('PRICE', $activity->getPrice());					// set price
$template->assign_var('PRICE_MEMBER', $activity->getPriceMember());		// set price member
$template->assign_var('LOCATION', $activity->getLocation());			// set location

// list of all user that are enrolled in 2 rows
if($enrol_list!= 0){		// get a list of all enrolled users	
	$users_enrolled = $activity->getAmountEnrolledUser();				// count amount enrolled users
	$template->assign_var('USERS_ENROLLED_AMOUNT', $users_enrolled);	// set template amount
	$template->assign_var('USERS_ENROLLED_CHECK', true);				// set force enrol
	// split the group into two lists
	$split = $users_enrolled / 2 ;										// caluclate the half of all enrolled users
	$counter = 0;														// counter for splitting
	$enrol_block = 1;													// current list with users
	foreach ($enrol_list as $id => $value)								// split enrolled users in two groups
	{
		if($value['status'] == "yes"){
			
			if($split < $counter){											// if the half of the group is splitted
				$enrol_block = 2;											// set next blok
			}
			$template->assign_block_vars('users_enrolled'.$enrol_block, array(	// set array of enrolled user groups
				'USER_ID'    => $id,
				'USER_LINK'	=>	append_sid($phpbb_root_path.'memberlist.'.$phpEx, "mode=viewprofile&u=". $id),
				'USER_NAME'    => $value['username'],
				));
			$counter++;														// next enrolled user
		}
	}
}else{
	$template->assign_var('USERS_ENROLLED_CHECK', false); 				// set no forced enrol
}



// links
$template->assign_var('URL_CLEAN', append_sid($phpbb_root_path.'dc/dc_activity.'.$phpEx, "act=" .$activity->getId()));
$template->assign_var('URL_STATUS', append_sid($phpbb_root_path.'dc/dc_activity.'.$phpEx, "act=" .$activity->getId()));
$template->assign_var('URL_CHANGE_STATUS_YES', append_sid($phpbb_root_path.'dc/dc_activity.'.$phpEx, "act=".$activity->getId()."&status=1" ));
$template->assign_var('URL_CHANGE_STATUS_NO', append_sid($phpbb_root_path.'dc/dc_activity.'.$phpEx, "act=".$activity->getId()."&status=2" ));
$template->assign_var('URL_CHANGE_STATUS_MAYBE', append_sid($phpbb_root_path.'dc/dc_activity.'.$phpEx, "act=".$activity->getId()."&status=3" ));
$template->assign_var('URL_CHANGE_STATUS', append_sid($phpbb_root_path.'dc/dc_activity.'.$phpEx, "act=".$activity->getId()."&change=true" ));

// some additional words for transalation
$template->assign_var('LANG_TILL', strtolower($user->lang['DC_ACT_LANG_TILL']));
$template->assign_var('LANG_ENROLLS', $user->lang['DC_ACT_LANG_ENROLLS']);
$template->assign_var('LANG_SIGN_UPS_LEFT', $user->lang['DC_ACT_ENROLL_LEFT']);
$template->assign_var('LANG_SUBSCRIPTIONS', $user->lang['DC_ACT_LANG_SUBSCRIBE']);  
$template->assign_var('LANG_UNSUBSCRIPTIONS', $user->lang['DC_ACT_UNSUBSCRIBE']);
$template->assign_var('LANG_SUBSCRIBE', $user->lang['ACP_DC_ACT_ENROL']);  
$template->assign_var('LANG_UNSUBSCRIBE', $user->lang['ACP_DC_ACT_DEENROL']);  
$template->assign_var('LANG_DATE', $user->lang['DC_ACT_LANG_DATE']);
$template->assign_var('LANG_PRICE', $user->lang['DC_ACT_LANG_PRICE']);
$template->assign_var('LANG_MEMBER', strtolower($user->lang['DC_ACT_LANG_MEMBER']));
$template->assign_var('LANG_NOT_ACTIVE', $user->lang['DC_ACT_NOT_ACTIVE']);
$template->assign_var('LANG_LOCATION', $user->lang['DC_ACT_LANG_LOCATION']);
$template->assign_var('LANG_ENROLL_NOBODY', $user->lang['DC_ACT_ENROLL_NOBODY']);
$template->assign_var('LANG_ENROLL_FORCE', $user->lang['DC_ACT_ENROLL_FORCE']);
$template->assign_var('LANG_ENROLL_TIME', $user->lang['DC_ACT_ENROLL_TIME']);
$template->assign_var('LANG_ENROLL_AMOUNT', $user->lang['DC_ACT_ENROLL_AMOUNT']);
$template->assign_var('LANG_ENROLL_AMOUNT_MAX', $user->lang['DC_ACT_ENROLL_AMOUNT_MAX']);
$template->assign_var('LANG_ENROLL_DATETIME_OVER', $user->lang['DC_ACT_ENROLL_DATETIME_OVER']);
$template->assign_var('LANG_ENROLL_CLOSED', $user->lang['DC_ACT_ENROLL_CLOSED']);
$template->assign_var('LANG_SAVE_COMMENT', $user->lang['DC_ACT_SAVE_COMMENT']);
$template->assign_var('LANG_YES', $user->lang['YES']);
$template->assign_var('LANG_NO', $user->lang['NO']);
$template->assign_var('LANG_MAYBE', $user->lang['MAYBE']);
$template->assign_var('LANG_AMOUNT', $user->lang['AMOUNT']);
$template->assign_var('LANG_PAID', strtolower($user->lang['PAID']));
$template->assign_var('LANG_CANCEL', $user->lang['CANCEL']);
$template->assign_var('LANG_SAVED', $user->lang['SAVED']);
$template->assign_var('LANG_TO', strtolower($user->lang['TO']));
$template->assign_var('LANG_CHANGE',  ucfirst(strtolower($user->lang['CHANGE'])));
$template->assign_var('LANG_NO_LOGIN_NEEDED',  $user->lang['DC_ACT_NO_LOGIN_NEEDED']);

// if a user is a manager: some exta functions and assignments
$template->assign_var('IS_MANAGER', $manager);
if($manager){
	$template->assign_var('OVERVIEW_NAME', ucfirst(strtolower($user->lang['ACP_DC_ACT_OVERVIEW'])));
	$template->assign_var('OVERVIEW_URL', append_sid(generate_board_url()."/adm/index.php", "i=dc_activity_management&mode=overview" ));	
	
	$template->assign_var('EDIT_NAME', ucfirst(strtolower($user->lang['ACP_DC_ACT_EDIT'])));
	$template->assign_var('EDIT_URL', append_sid(generate_board_url()."/adm/index.php", "i=dc_activity_management&mode=edit_activity&id=".$activity->getId() ));
	
	$template->assign_var('SUBSCRIBE_NAME', ucfirst(strtolower($user->lang['DC_ACT_LANG_ENROLLS'])));
	$template->assign_var('SUBSCRIBE_URL', append_sid(generate_board_url()."/adm/index.php", "i=dc_activity_management&mode=enrolls&id=".$activity->getId() ));
	
	
	
	$template->assign_var('IS_PAST', $in_the_past);
	$template->assign_var('RECYLCLE_NAME', ucfirst(strtolower($user->lang['ACP_DC_ACT_RECYCLE'])));
	$template->assign_var('RECYCLE_URL', append_sid($phpbb_root_path.'adm/index.'.$phpEx, "i=dc_activity_management&mode=recycle_activity&id=".$activity->getId() ));
}



// other assignments
$template->assign_var('FORM_HIDDEN_ACT',$activity->getId() );
$template->assign_var('FORM_HIDDEN_SID', $user->data["session_id"]);


page_header($activity->getName());
// set template

$template->assign_block_vars('navlinks', array(
	'FORUM_NAME'         => $user->lang['DC_ACT_LIST'],
            'U_VIEW_FORUM'      	=> append_sid("{$phpbb_root_path}dc/dc_activity_list.$phpEx" )) //The path to the custom file relative to the phpbb root path.            
);

$template->assign_block_vars('navlinks', array(
	'FORUM_NAME'         => $activity->getName(), 
            'U_VIEW_FORUM'      	=> append_sid("{$phpbb_root_path}dc/dc_activity.$phpEx", "act=".$activity->getId())) //The path to the custom file relative to the phpbb root path.            
);

$template->set_filenames(array(
	'body' => 'dc_activity.html',
	));

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();
?>