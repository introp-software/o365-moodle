## Instructions for setting up Office Mix as an LTI provider

Register Your Moodle Installation with Office Mix
-------------------------------------------------

  * Go to https://mix.office.com/lti/.
  * Click Register an LMS.
  * If you are not already signed in, sign in with your Microsoft or Office Mix account. 
  * Type a name to describe your Moodle installation.
  * Select the checkbox indicating that you agree to allow Office Mix to pass data to your Moodle installation.
  * Click Save.
  * At this point, you will receive a new Consumer Key, Shared Secret, and Launch URL. You will need these in the subsequent steps below. 
  * To retrieve these at a later time, return to https://mix.office.com/lti/ page and click Manage Your Registrations.
  
Adding Office Mix as an LTI Provider in Moodle
----------------------------------------------

  * Log in to Moodle using your administrator account.
  * Go to Site Administration.
  * Go to Plugins > Activity modules > LTI > Manage external tool types.
  * Select Active.
  * Click Add external tool configuration.
  * In the Tool name box, type "Office Mix".
  * In the Tool base URL box, type "https://mix.office.com/lti".
  * In the Consumer key and Shared secret boxes, enter the values you received when you registered your Moodle installation above.
  * Select the Show tool type when creating tool instances checkbox.
  * Configure Privacy settings according to your requirements.
    
  Note: Sending the Name of the user will allow Office Mix to display rich analytics and question responses. 
  If you do not send any user information, then Office Mix will not be able restore a student's answers 
  if they view the content on a subsequent visit.

  * Click Save changes.
  
Now that Office Mix has been configured, follow these [instructions](#instruction-for-moodle) to embed a mix.  

Adding a specific Office Mix into course content
------------------------------------------------

  * Log in to Moodle as a Teacher or Admin.
  * Select the course you'd like to work with.
  * Click Turn editing on.
  * Locate the section that you'd like to modify and click Add an activity or resource.
  * Select External tool.
  * Click Add.
  * In the General settings:
  * In the Activity name box, type a name for your activity.
  * Select Office Mix from the External tool type list.
  * Set your Privacy and Grade settings.
  * Click Save and display. At this point, you should see a placeholder for your activity.
  * In the embedded activity, use one of these methods to select a mix:
  
    Using URL: A simple way to select a mix is to visit the Office Mix website, select the mix you want to include in the course, copy the URL from the browser address bar and paste it in the dialog. This method makes it easy to include mixes that have been created by other people.

    Using My Mixes: Select a mix from your My Mixes page. In order to prevent students from having to sign in to view a mix, only those mixes with permissions set to Unlisted or Public are shown.
    
    After you have selected a mix, click Yes to confirm that this is the mix you'd like to use.
    At this point, you should see the mix embedded within your course.
    
 
Resources
=========

You can also refer to these Office Mixes for more information

-   <https://mix.office.com/en-us/Lti/UsingMoodle>
-   <https://mix.office.com/en-us/Lti/SetupMoodle>
    

