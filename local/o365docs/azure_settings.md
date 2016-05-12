Azure Settings for Creating a Moodle Installation
=================================================

This document describes how to create the settings needed in Azure for your Moodle installation. 

* Go to https://manage.windowsazure.com and login using the account used to manage your Azure subscription.
   
* If you haven't created an Azure Active directory, follow these steps to create it:

   * Click on “Active Directory” in the left column, then click on “+ New ” and then click “Directory” & “Custom Create”.
   
   * After creating the Directory, it will appear in the list when you select “Active Directory”.

* Click on the Active directory you created.
* At top of the page, click on "Application" link.
* Click on "Add" button at the bottom of the page to add application and choose "Add an application to my organization is developing".
* Create an application with an appropriate name e.g. "My Moodle".
* Choose “Web application and/or web api”. 
* On the next step,
  
    * The Sign-on URI is the Redirect URI you from the OpenID Connect authentication plugin configuration. Ensure there is a trailing slash for this URL - i.e. https://example.com/auth/oidc/
    * The APP ID URI is the main URI of the Moodle instance e.g. https://example,com/.

* Click on the created application and then click on the “Configure” tab. The following steps describe the settings that need to be changed. The rest are optional.

    * Application is Multi-Tenant: Depending upon whether your site is intended to be single tenant or multiple tenants, you may choose Yes or No. 

    * Client ID: This will be populated already. Note this down and use it when setting up the OIDC authentication plugin for your Moodle installation.
  
    * Keys: Select the duration for your secret key depending upon your requirements. The key will be created when you save this page.
  
* Click Save at the bottom of the page, and you will see the “Key” get populated. You will need to note it down at that time and use it when setting up the OIDC authentication plugin for your Moodle installation.

* Click on “Add Application” at bottom of the page.

* Click the "+" sign next to the following items:

  * Office 365 SharePoint Online.
  * Office 365 Exchange Online.
  * OneNote.
  * Microsoft Graph.

* Click the checkmark button at the bottom right of the dialog to save your selections.

* You will now see the applications you selected in the "permissions to other applications" list. Select the dropdowns next to each of them to select the permissions for them as follows:

  * Windows Azure Active Directory:

    * App Permission (1):
    
      * Read directory data.

    * Delegated Permissions (5):
    
      * Read directory data.
      *	Sign in and read user profile.
      * Read all users full profile.
      * Read and Write Directory Data.
      *	Access the Directory as the signed-in user.
  
  * Office 365 Exchange Online:
   
    * Delegated permissions (2):
    
      * Read user calendars.
      * Read and write user calendars.
      
  * Office 365 SharePoint Online:
    
    *	Delegated permissions (6):

      * Read items in all site collections.
      * Read and write items in all site collections.
      * Read and write items and lists in all site collections.
      * Have full control of all site collections.
      * Read user files.
      * Read and write user files.
      
  * OneNote:
  
    * Delegated permissions (3): 
    
      * Create Pages in OneNote notebooks.
      * View OneNote notebooks.
      * View and Modify OneNote notebooks.
      
  * Microsoft Graph:
  
    * Delegated Permissions (9):
    
      * Have full access to user calendars.
      * Access directory as the signed in user.
      * Read and write directory data.
      * Have full access to user files. 
      * Read and write all groups.
      * Read and write notebooks that the user can access (preview).
      * Read items in all site collections.
      * Read and write all users full profiles.
      * Sign users in.

* Click Save at the bottom of the page to save all your selections.
