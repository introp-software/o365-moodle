# Moodle Plugins for Microsoft Services
*including* **Office 365** *and other Microsoft services*

## OpenID Connect Authentication Plugin.

The OpenID Connect plugin provides single-sign-on functionality using configurable identity providers.

This is part of the suite of Office 365 plugins for Moodle.

This repository is updated with stable releases. To follow active development, see: https://github.com/Microsoft/o365-moodle

## Installation.

1. Unpack the plugin into /auth/oidc within your Moodle install.
2. From the Moodle Administration block, expand Site Administration and click "Notifications".
3. Follow the on-screen instuctions to install the plugin.
4. To configure the plugin, from the Moodle Administration block, go to Site Administration > Plugins > Authentication > Manage Authentication.
5. Enable OpenID Connect and click on "Setting" to configure OpenID connection.

## Settings:-

#### Provider Name:

The name entered here will be used through the OpenID Connect plugin and the Office 365 plugins to refer to the system used tolog users in. For example, if your users are used to calling their Azure AD account their "School" account, you enter "School account" here, and all references to authentication will be "Log in with your School account".

#### Client ID:

Add the Client ID from Azure, how to get this Client ID Refer Azure_Moodle Setting doc.

### Client Secret:

Add the client secret (which is the 2-year key) from the Azure “Moodle” application settings Refer Azure_Moodle Setting doc.
      
### Authorization Endpoint and Token Endpoint: 

Provided by Microsoft – Use the Default Auth Endpoint and Token Endpoint. 

The values should be:

* For Authorization Endpoint :- https://login.microsoftonline.com/common/oauth2/authorize.
* For Token Endpoint :- https://login.microsoftonline.com/common/oauth2/token.

### Resource:

It is already pre-populated. 

Explanation:

The OpenID Connect Sign-in request has to specify a resource parameter. This specifies the protected resource that you’re needing to access as part of the sign-in request. Graph.windows.net is Microsoft Azure AD graph. This lets Moodle go and get things such as first name, last name, etc. in Azure AD.

### Redirect URI:

It is already pre-populated.

Explanation: 

This is the URI to register as the "Redirect URI". Your OpenID Connect identity provider should ask for this when registering Moodle as a client. 

NOTE: You must enter this in your OpenID Connect provider exactly as it appears here. Any difference will prevent logins using OpenID Connect.	

### Auto-Append:

When using the "Username/Password" login flow, this setting with automatically append a given string to an entered username. This is useful in Azure AD usernames, where a single domain name is often used for every user - i.e. [user]@contoso.onmicrosoft.com. Users would normally have to enter this entire username to successfully log in to Moodle, but in this example, entering "@contoso.onmicrosoft.com" here means users would only have to enter their unique username, i.e. "bob.smith", instead of "bob.smith@contoso.onmicrosoft.com".

### Domain Hint:

If users have several different Azure AD accounts with different tenants (i.e. @contoso.onmicrosoft.com, @example.onmicrosoft.com), but Moodle only uses one of these tenants, you can enter that tenant in this box to have the Azure AD login screen only ever suggest accounts from that tenant.

### Login Flow:

This refers to how a user will Login to Moodle. There are Two options:

* Authorization Request:

Using this flow, the user clicks the name of the identity provider (See "Provider Name" above) on the Moodle login page and is redirected to the provider to log in. Once successfully logged in, the user is redirected back to Moodle where the Moodle login takes place transparently. This is the most standardized, secure way for the user log in.
    
* Username/Password Authentication: -
  
Using this flow, the user enters their username and password into the Moodle login form like they would with a manual login. This will authorize the user with the identity provider, but will not create a session on the identity provider's site. For example, if using Office 365 with OpenID Connect, the user will be logged in to Moodle but not the Office 365 web applications. Using the authorization request is recommended if you want users to be logged in to both Moodle and the identity provider. Note that not all identity providers support this flow.

### User Restrictions:

This setting allows you to restrict the users that can log in to Moodle using OpenID Connect (Azure AD). Once you've entered at least one user restriction, users logging in to Moodle must match at least one entered pattern.

How to use user restrictions:

* Enter a regular expression pattern that matches the usernames of users you want to allow.
* Enter one pattern per line
* If you enter multiple patterns a user will be allowed if they match ANY of the patterns.
* The character "/" should be escaped with "\".
* If you don't enter any restrictions above, all users that can log in to the OpenID Connect provider will be accepted by      Moodle.
* Any user that does not match any entered pattern(s) will be prevented from logging in using OpenID Connect.

### Record debug messages:

If you experience problems using OpenID Connect, enable this setting. Once enabled, errors will be recorded to the Moodle log for review. These errors can help you or the plugin developers debug and fix the problem. The error log can be viewed by navigating to Site Administration > Reports > Logs, changing the "All activities" select box to "Site errors", and clicking "Get these logs".
    
### Custom Icon:

This setting allows you to choose from a selection of predefined icons to appear next to the identity provider link on the login page.  
You can also upload your own icon.

* There are several predefined icons to choose from, clicking an icon will use that icon on the login page.
* To use a custom icon, use the file picker below the "Icon" setting.
* This image will not be resized on the login page, so we recommend uploading an image no bigger than 35x35 pixels.
* If you have uploaded a custom icon and want to go back to one of the stock icons, click the custom icon in the file picker and click   "Delete", then "OK", then "Save Changes" at the bottom of the settings page. The selected stock icon will now appear on the Moodle    login page.


For more documentation, visit https://docs.moodle.org/30/en/Office365

# Contributing

Before we can accept your pull request, you'll need to electronically complete Microsoft's [Contributor License Agreement](https://cla.microsoft.com/). If you've done this for other Microsoft projects, then you're already covered.

[Why a CLA?](https://www.gnu.org/licenses/why-assign.html) (from the FSF)

# Copyright

&copy; Microsoft, Inc.  Code for this plugin is licensed under the GPLv3 license.

Any Microsoft trademarks and logos included in these plugins are property of Microsoft and should not be reused, redistributed, modified, repurposed, or otherwise altered or used outside of this plugin.
