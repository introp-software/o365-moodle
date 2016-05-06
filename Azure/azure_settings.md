Azure Setting
====================================

*If you don't have create Azure Active directory, follow steps to create Azure Active directory

  *	Go to this URL https://Manage.windowsazure.com and login using Microsoft account.
  * Go to left corner of the page and click on “Active Directory” then click on “+ New ” button and in the 3rd column from the left click “Directory” & “Custom Create”.
  * After creating the Directory, it will appear in list in the “Directory” tab.

* Once you created Azure Active directory, or you have already created directory, click on that directory
* At top of the page, click on "Application" link
* Click on "Add" button at the bottom of the page to add application and choose "Add an application to my organization is developing".
* Create an application with name "Moodle" for ex. "TestMoodle"
* Choose “Web application and/or web api”. 
  
  * For Sign-On url, add the following (Very Important to add “/” at ending) and ensure whether its HTTP or HTTPS (that will depend on the client site): Ex:- https://insert_moodle_url/auth/oidc/
  * For the App ID URL, if the client is using site wide SSL, then make it: https, otherwise, keep it as it is

*	Click on created Active Directory and click on “Configure” link  

  ####* Name and Sign-On URL:
  
  It should be already there.

  ####* Logo: -
 
  You can add logo, which will show up to the user in their app area.

  ####* Application is Multi-Tenant:

  Set to No, unless you have multiple 365 instance, by default, an application that get registered is single- tenant, so only users from your 365 can login. 

  ####*	Client ID:
  
  It is already populated. You should use this is in Moodle GUI i.e. in Moodle (Site Administration > Plugin > Authentication > OpenID Connect).
  
  ####* User assignment required to access app:
      
  set to No by default.
  
  ####* Keys:
      
  The recommendation is to set this to 2 years and remember that after 2 years you have to change key again.
  
  ####App ID URL:
  
  This is your application URL. It is already populated.

  ####Reply URL: 

  Make it the same as the sign-on URL, and remember the ending “/”. For Ex.- https://insert_client_Moodle_url/auth/oidc/.

* Click on Save button, and you will see the “Key” get populated, Copied that key and paste it in Moodle GUI i.e.( Site Administration > Plugin > Authentication > OpenID Connect > ).

* Click on “Add Application” at bottom of the page. Need to add:-

  *	Office 365 SharePoint online.
  * Office 365 Exchange online.
  * OneNote may or may not be there by default. If not, OneNote (TO GET ONENOTE TO SHOW UP, the O365Admin must go to     portal.office.com, sign in with School Account or work account and click on OneNote, and it sign that user into OneNote, and when you go back to “Add Application” OneNote should be there).
  * Microsoft Graph.
 
* Now add permission as mentioned below

  * Windows Azure Active Directory 

    * App Permission (1): Read directory data.
    * Delegated Permissions (5):
    
      * Read directory data.
      *	Sign in and read user profile.
      * Read all users full profile.
      * Read and Write Directory Data.
      *	Access the Directory as the signed-in user.
  
  * Office 365 Exchange online
   
    * Delegated permissions (2):
    
      * Read user calendars
      * Read and write user calendars
      
  * Office 365 SharePoint Online -  http://screencast.com/t/TqsOARbUmEbb
    
    *	Delegated permissions (6):

      * Read items in all site collections
      * Read and write items in all site collections
      * Read and write items and lists in all site collections
      * Have full control of all site collections
      * Read user files
      * Read and write user files
      
  * OneNote
  
    * Delegated permissions (3): 
    
      * Create Pages in OneNote notebooks
      * View OneNote notebooks
      * View and Modify OneNote notebooks
      
  * Microsoft Graph - http://screencast.com/t/v42AM6tR
  
    * Delegated Permissions (9)
    
      * Have full access to user calendars
      * Access directory as the signed in user
      * Read and write directory data
      * Have full access to user files 
      * Read and write all groups
      * Read and write notebooks that the user can access (preview)
      * Read items in all site collections
      * Read and write all users full profiles
      * Sign users in
      


 
  





