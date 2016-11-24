//sign in sample:
//if user has signed in give prompt, otherwise go to index page
$(function () {
    'use strict';
    window['sign-in_load'] = function () {
        if (window.skypeWebApp && window.skypeWebApp.signInManager.state() == "SignedIn") {
            $('.wrappingdiv .signed-in').show();
            return;
        } else {
            $('.wrappingdiv .signed-in').hide();
            $('.modal').show();
             testForConfigAndSignIn({
                        "client_id": "de5875db-c425-43e1-b35a-bf823f5decc0",
                        "origins": ["https://webdir.online.lync.com/autodiscover/autodiscoverservice.svc/root"],
                        "cors": true,
                        "version": 'SkypeOnlinePreviewApp/1.0.0',
                        "redirect_uri": 'http://localhost:81/moodle31/blocks/skype_web/skypetest.php',
                        "state": 'aHR0cDovL2xvY2FsaG9zdDo4MS9tb29kbGUzMS9jb3Vyc2Uvdmlldy5waHA/aWQ9Mg=='
            });
        }
        function signin(options) {
            window.skypeWebApp.signInManager.signIn(options).then(function () {
                // when the sign in operation succeeds display the user name
                $(".modal").hide();
                $('body').trigger({ type: 'UserLoggedIn' });
                console.log('Signed in as ' + window.skypeWebApp.personsAndGroupsManager.mePerson.displayName());
                if (!window.skypeWebApp.personsAndGroupsManager.mePerson.id()
                    && !window.skypeWebApp.personsAndGroupsManager.mePerson.avatarUrl()
                    && !window.skypeWebApp.personsAndGroupsManager.mePerson.email()
                    && !window.skypeWebApp.personsAndGroupsManager.mePerson.displayName()
                    && !window.skypeWebApp.personsAndGroupsManager.mePerson.title()) {
                    window['noMeResource'] = true;
                }
                $("#anonymous-join").addClass("disable");
                $(".menu #sign-in").click();
                //listenForConversations();
            }, function (error) {
                // if something goes wrong in either of the steps above,
                // display the error message
                $(".modal").hide();
                alert("Can't sign in, please check the user name and password.");
                console.log(error || 'Cannot sign in');
            });
        }
        function testForConfigAndSignIn(options) {
            Skype.initialize({
                apiKey: '9c967f6b-a846-4df2-b43d-5167e47d81e1'
            }, function (api) {
                window.skypeWebApp = api.UIApplicationInstance;
                window.skypeApi = api;
                window.skypeWebAppCtor = api.application;
                signin(options);
            }, function (err) {
                console.log(err);
            });
        }
    };
});
