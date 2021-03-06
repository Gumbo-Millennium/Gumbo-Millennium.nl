<?php
/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
    exit;
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine


// Adding the trancelation
// user side
$lang = array_merge($lang, array(
    'MAYBE'    							=> 'Maybe',
    'AMOUNT'    						=> 'Amount',
    'PAID'    							=> 'Paid',
    'NOT_PAID'    						=> 'Not paid',
    'SAVED'    							=> 'Saved',
    'TO'                                => 'To',
    'DC_ACT_CHANGE_STATE'    			=> 'Change state',
    'DC_ACT_ALREADY_STATUS'    			=> 'The user already has this status.',
    'DC_ACT_INVALID_STATUS'    			=> 'Invalid user status',
    'DC_ACT_IN_PAST_AND_OVER'           => 'This event is finished, please check the events that are in the future',
    'DC_ACT_IN_PAST'    				=> 'This event is in the past. Something in the past can not change.',
    'DC_ACT_NOT_ENROLLED'    			=> 'User is not signed up',
    'DC_ACT_NOT_ACTIVE'    				=> 'This event is not active',
    'DC_ACT_ERROR_NO_ROWS_ADDED'    	=> 'No new rows added',
    'DC_ACT_ERROR_TO_MANY_ROWS_ADDED'   => 'No new rows added',
    'DC_ACT_NO_ACT'   					=> 'Event not fount',
    'DC_ACT_ERROR_LOAD'   				=> 'Error while loading this event',
    'DC_ACT'   							=> 'Event',
    'DC_ACT_LANG_TILL'   				=> 'Till',
    'DC_ACT_LANG_ENROLLS'   			=> 'People who are going',
    'DC_ACT_LANG_SUBSCRIBE'   			=> 'Subscription',
    'DC_ACT_LANG_DATE'   				=> 'Date and time',
    'DC_ACT_LANG_PRICE'   				=> 'Price',
    'DC_ACT_LANG_LOCATION'  			=> 'Location',
    'DC_ACT_SAVE_COMMENT'  				=> 'Save comment',
    'DC_ACT_ENROLL_NOBODY'  			=> 'Nobody sign up for this event',
    'DC_ACT_ENROLL_FORCE'  				=> 'Is signing up required?',
    'DC_ACT_ENROLL_TIME'  				=> 'Signing up is open till',
    'DC_ACT_ENROLL_AMOUNT'  			=> 'Users who signed up',
    'DC_ACT_ENROLL_AMOUNT_MAX'  		=> 'Maximum signed up users is reached',
    'DC_ACT_ENROLL_LEFT'  				=> 'Sign ups left',
    'DC_ACT_ENROLL_UNLIMITED'  			=> 'Unlimited',
    'DC_ACT_ENROLL_DATETIME_OVER'  		=> 'The time to sign up is over',
    'DC_ACT_ENROLL_CLOSED'  			=> 'Sign ups for this event are closed',
    'DC_ACT_UNSUBSCRIBE'  				=> 'You are allowed to unsubscribe until',
    'DC_ACT_LANG_ICAL_TITLE'            => 'Personal iCal for your calander',
    'DC_ACT_LANG_ICAL_URL'  			=> 'Copy your personal iCal link',
    'DC_ACT_LANG_ICAL_EXPLAIN'          => 'This is your personal iCal feed. You can use this link to automaticly sync the Gumbo Millennium events with your digital calander. The iCal link is personal because it also looks for events that are only visable for you.<br/> (Login is needed, otherwise you only get the public events)',
    'DC_ACT_LANG_ICAL_MORE_INFO'  		=> 'How to add this iCal link to your Google Calendar?',
    'DC_ACT_NO_LOGIN_NEEDED'  			=> 'This event is open for everybody.<br />So you dont need to sign up.',
    'DC_ACT_LIST'                       => 'Events',
    'DC_ACT_GO_TO'                      => 'Jump to event',
    'DC_ACT_USER_ENROLLED'              => 'You are going to this event',
    'DC_ACT_IS_NOT_ENROLLED'            => 'You are not going to this event',
    'DC_ACT_EVENT_MANAGEMENT'  		    => 'Event management',
));

// management side  
$lang = array_merge($lang, array(
    'OPTIONAL_SETTINGS'                 => 'Optional settings',
    'ACP_ACTIVITY_NEW'  				=> 'Add new event',
    'ACP_ACTIVITY_NEW_EXPLAIN'  		=> 'Add a new event to the system, and some more text',
    'ACP_DC_ACT_DESCRIPTION'  			=> 'Description',
    'ACP_DC_ACT_START_DATE'  			=> 'Start date',
    'ACP_DC_ACT_START_DATE_EXPLAIN'		=> 'Enter the start date',
	'ACP_DC_ACT_START_TIME'  			=> 'Start time',
    'ACP_DC_ACT_START_TIME_EXPLAIN'		=> 'Enter the start time',
	'ACP_DC_ACT_END_DATE'  				=> 'End date',
    'ACP_DC_ACT_END_DATE_EXPLAIN'		=> 'Enter the end date',
	'ACP_DC_ACT_END_TIME'  				=> 'End time',
    'ACP_DC_ACT_END_TIME_EXPLAIN'		=> 'Enter the end time',
    'ACP_DC_ACT_NAME'  					=> 'Name of the event',
    'ACP_DC_ACT_NAME_EXPLAIN'  			=> 'Give the new event a name',
    'ACP_DC_ACT_ENROL'  				=> 'Join this event',
    'ACP_DC_ACT_DEENROL'  				=> 'Leave this event',
    'ACP_DC_ACT_ENROL_EXPLAIN'  		=> 'Let people subscribe for this event',
    'ACP_DC_ACT_LOCATION'  				=> 'Location',
    'ACP_DC_ACT_LOCATION_EXPLAIN'  		=> 'Enter the location from where the event starts',
    'ACP_DC_ACT_PAY_OPTION'  			=> 'Payment',
    'ACP_DC_ACT_COMMISSION'  			=> 'Commission',
    'ACP_DC_ACT_COMMISSION_EXPLAIN'  	=> 'What commission is making this event',
    'ACP_DC_ACT_ENROLL_DATE'  			=> 'Max subscribe date',
    'ACP_DC_ACT_ENROLL_DATE_EXPLAIN'  	=> 'The date users can subscribe. <br />If left empty the max subscribe date will equal with the start date',
	'ACP_DC_ACT_ENROLL_TIME'  			=> 'Max subscribe time',
    'ACP_DC_ACT_ENROLL_TIME_EXPLAIN'  	=> 'The time users can subscribe on de max subscribe day. <br />If left empty the max subscribe time will equal with the start time',
    'ACP_DC_ACT_ENROLL_MAX'  			=> 'Max users',
    'ACP_DC_ACT_ENROLL_MAX_EXPLAIN'  	=> 'The max amount of user that can subscribe to this event <br />0 is unlimited',
    'ACP_DC_ACT_PRICE'  				=> 'Price',
    'ACP_DC_ACT_PRICE_EXPLAIN'  		=> 'The price non Gumbo Millennium members have to pay',
	'ACP_DC_ACT_PRICE_MEMBER'  			=> 'Price for Gumbo Millennium members',
    'ACP_DC_ACT_PRICE_MEMBER_EXPLAIN'  	=> 'The price Gumbo Millennium members have to pay',
    'ACP_DC_ACT_ACCES'  				=> 'Acces settings',
    'ACP_DC_ACT_ADD_GROUP_MANAGER'  			=> 'Add group manager(s)',
    'ACP_DC_ACT_ADD_GROUP_MANAGER_EXPLAIN'  	=> 'Add group(s) who get the acces to this event and change this event',
	'ACP_DC_ACT_ADD_GROUP'  			=> 'Add view groups(s)',
    'ACP_DC_ACT_ADD_GROUP_EXPLAIN'  	=> 'Add group(s) who get the acces to view this event',
    'NOT_EMPTY'  						=> 'is not allowed to be empty',
    'NOT_PREG'  						=> 'has forbidden characters',
    'WRONG_FORMAT'  					=> 'has the wrong format',
    'CASH'  							=> 'Cash',
    'IDEAL'  							=> 'iDeal (not supported yet)',
    'DEACTIVE'  						=> 'Deactive',
    'STATE'  							=> 'State',
    'CANT_LATER'  						=> 'can\'t be later than',
    'EARLYER'  							=> 'can\'t be earlier than',
    'CANT_PAST'  						=> 'can\'t be in the past',
    'NOT_FOUND'  						=> 'not found',
    'UNVALID'  							=> 'is unvalid',
    'ACP_DC_ACT_OVERVIEW'  				=> 'Events overview',
    'ACP_DC_ACT_OVERVIEW_EXPLAIN'  		=> 'All future events',
    'ACP_DC_ACT_EDIT'  					=> 'Edit this event',
	'ACP_DC_ACT_EDIT_EXPLAIN'  			=> 'If you like you can change this event',
	'ACP_DC_ACT_RECYCLE'  				=> 'Recycle this event',
	'ACP_DC_ACT_RECYCLE_EXPLAIN'  		=> 'Making a new event from a old event without the old data like start date and time',
	'ACP_DC_ACT_PAST'  					=> 'Past events',
	'ACP_DC_ACT_PAST_EXPLAIN'  			=> 'The list of events that are past. You can recycle or preview the event. <br />Use the input fields to find all other events.',
	'ACP_DC_ACT_PAST_OVERVIEW_EXPLAIN'  => 'The list of  the 10 last events that are past. You can recycle, review and see all subscriptions the event',
	'ADVANCED_SEARCH'  					=> 'Advanced search',
	'ACP_DC_ACT_END_DATE_UNSUBSCRIBE'  			=> 'End date to unsubscribe',
	'ACP_DC_ACT_END_DATE_UNSUBSCRIBE_EXPLAIN'  	=> 'The date the user has to unsubscribe form this event. <br />If left empty the max subscribe date will equal with the start date',
	'ACP_DC_ACT_END_TIME_UNSUBSCRIBE'  			=> 'End time to unsubscribe',
	'ACP_DC_ACT_END_TIME_UNSUBSCRIBE_EXPLAIN'  	=> 'The time the user has to unsubscribe from this event. <br />If left empty the max subscribe time will equal with the start time',
	'ACP_DC_ACT_CURRENT'  				=> 'Current events',
	'ACP_DC_ACT_ACTIVE'  				=> 'Active events',
	'ACP_DC_ACT_DEACTIVE'  				=> 'Deactive events',
	'UNVALED_EMAIL_ADDRESS'  			=> '\'%s\' is an invalid email addres for \'%s\'.',
	
));

// For management past activities
$lang = array_merge($lang, array(
    'ACP_DC_ACT_START_DATE_FROM'  		=> 'Start date from',
    'ACP_DC_ACT_START_DATE_TO'  		=> 'Start date to',
	'ACP_DC_ACT_END_DATE_FROM'  		=> 'End date from',
    'ACP_DC_ACT_END_DATE_TO'  			=> 'End date to',
	
	'LIST_ACTIVITYS'    				=> '%s Events',
	'LIST_ACTIVITY'    					=> '1 Event',
	'ALL_ACTIVITY'    					=> 'All events',
	'ACP_DC_ACT_AMOUNT_SIGNED'    		=> 'Amount Sign in',
	
));

// For management enrolls/subscribe list 
$lang = array_merge($lang, array(
    'ACP_DC_ACT_ENROLL'  				=> 'Subscribe list',
    'ACP_DC_ACT_ENROLL_EXPLAIN'  		=> 'The list of all users who subscribed this activity.',
    'ACP_DC_ACT_COMMENT'  				=> 'Comment',
    'ACP_DC_ACT_STATUS'  				=> 'Status',
    'ACP_DC_SELECT_USER'  				=> 'Select a user',
    'ACP_DC_SELECT_USER_EXPLAIN'  		=> 'Select a user you whant to change the payment',
    'ACP_DC_ACT_PAID'  					=> 'The amount the user paid',
    'DC_ACT_USER_NOT_ENROLLED'    		=> 'is not subscripted',
    'DC_ACT_PAYMENT_DONE'    			=> 'Payment done',
    'DC_ACT_REALNAME'    				=> 'Real name',
	'LIST_USERS'    					=> '%s Users',
	'LIST_USER'    						=> '1 User',
    'ACP_DC_SELECT_USERS'    			=> 'Select user(s)',
    'ACP_DC_SELECT_MULTI_USER'    		=> 'Select multiple users',
    'ACP_DC_SELECT_MULTI_USER_EXPLAIN'	=> 'Instert usernames to change the amount paid of multiple users. <br /> If you enter a username in the field, the "Select a user" field will not be used.',
    'ACP_DC_ACT_DISPLAY_LIMIT'    		=> 'Display entries',
    'ACP_DC_ACT_INVALED_USERNAME'    	=> 'Invalid username(s)',
    'DC_ACT_INVALID_ACTION'    			=> 'Invalid action',
    'ACP_DC_ACTION_OPTIONS'    			=> 'Select action',
    'ACP_DC_ACTION_OPTIONS_EXPLAIN'		=> 'Select the action you like to execute',
    'ACP_DC_ACTION_PAY'					=> 'Change payment',
    'ACP_DC_ACTION_EMAIL'				=> 'Send email',
    'ACP_DC_ACTION_SUBSCRIBE'			=> 'Subscribe user(s) (Change status to yes)',
    'ACP_DC_ACTION_UNSUBSCRIBE'			=> 'Unsubscribe users(s) (Change status to no)',
    'ACP_DC_USERS_ADDED'				=> 'User(s) successfully subscribed to the event',
    'ADD_USERS'							=> 'Add user(s)',
    'SELECT_USER'						=> 'Select user',
    'SELECT_USERS'                      => 'Select all users',
    'ENROLLED_USERS'					=> 'Signed up users',
));

// For management send mail
$lang = array_merge($lang, array(
    'ACP_DC_AC_SEND_MAIL'  				=> 'Mail',
    'ACP_DC_AC_SEND_MAIL_EXPLAIN'  		=> 'Compose a mail',
	'APC_DC_SEND_MAIL_SETTINGS'			=> 'Email settings',
	'DC_ACT_EMAIL_FROM'					=> 'Sending and replaying email address',
	'DC_ACT_EMAIL_FROM_EXPLAIN'			=> 'If an email address given this will be the sending email adress. Also you recive the replayed emails on this adress. <br /> If you leave this emty the sending email address is noreply@gumbo-millennium.nl',
));

// For group list
$lang = array_merge($lang, array(
    'FIND_GROUP'  						=> 'Find a group',
    'NO_GROUPS'  						=> 'No groups found for this search criterion.',
    'GROUPLIST'  						=> 'Group list',
    'FIND_GROUPNAME_EXPLAIN'	=> 'Use this form to search for specific groups. You do not need to fill out all fields. To match partial data use * as a wildcard. Use the mark checkboxes to select one or more usernames (several usernames may be accepted depending on the form itself) and click the Select Marked button to return to the previous form.',
    'GROUPNAME'  						=> 'Group name',
    'SORT_GROUPNAME'  					=> 'Group name',
	'L_FIND_GROUP'						=> 'Find a group',
	'LIST_GROUP'						=> '1 Group',
	'LIST_GROUPS'						=> '%d Groups',
));

?>
