
## Setting for Office Mix in Moodle

First register your LMS with Office Mix website, if it is not registered 

## To register your LMS with the Office Mix website:
  * Go to https://mix.office.com/lti/.
  * Click Register an LMS.
  * If you are not already signed in, sign in with an Office Mix account/ Microsoft account. 
  
  Note: Most often, you'll want to sign in with a work or school account. If you haven't used Office Mix before, 
  you can create a new account.
  * Type a name to describe your LMS. If you have more than one LMS or Production/Stage instances, 
  register each one separately with a name that will help you identify it.
  * Select the checkbox indicating that you agree to allow Office Mix to pass data to your LMS.
  * Click Save.
  * At this point, you will receive a new Consumer Key, Shared Secret, and Launch URL. 
  You will enter this information in the next part of the process. 
  To retrieve it at a later time, return to https://mix.office.com/lti/ page and click Manage Your Registrations.
  

Add External Tool
-----------------

To install Office Mix in Moodle:

  * Go to Site Administration.
  * Go to Plugins > Activity modules > LTI > Manage external tool types.
  * Select Active.
  * Click Add external tool configuration.
  * In the Tool name box, type "Office Mix".
  * In the Tool base URL box, type "https://mix.office.com/lti".
  * In the Consumer key box, type the value you received when you registered your LMS.
  * In the Shared secret box, type the value you received when you registered your LMS.
  * Select the Show tool type when creating tool instances checkbox.

  * Configure the Privacy settings.
    
    * Note: Sending the Name of the user will allow Office Mix to display rich analytics and question responses. 
    If you do not send any user information, then Office Mix will not be able restore a student's answers 
    if they view the content on a subsequent visit.
  * Click Save changes.
  
Now that Office Mix has been configured, follow these [instructions](#instruction-for-moodle) to embed a mix.  



  
  
## Instruction For Moodle

  * Login with Teacher or Admin in Moodle
  * Select the course you'd like to work with.
  * Click Turn editing on.
  * Locate the section that you'd like to modify and click Add an activity or resource.
  * Select External tool.
  * Click Add.
  * In the General settings:
  * In the Activity name box, type a name for your activity.
  * Select Office Mix from the External tool type list. See [Add External Tool](#add-external-tool).
  * Set your Privacy and Grade settings.
  * Click Save and display. At this point, you should see a placeholder for your activity.
  * In the embedded activity, use one of these methods to select a mix:
    By URL: A simple way to select a mix is to visit the Office Mix website, watch a mix, and copy/paste the URL in the dialog. This method makes it easy to include mixes that have been created by other people.
    My Mixes: Select a mix from your My Mixes page. In order to prevent students from having to sign in to view a mix, only those mixes with permissions set to Unlisted or Public are shown.
    After you have selected a mix, click Yes to confirm that this is the mix you'd like to use.
    At this point, you should see the mix embedded within your course.
    

