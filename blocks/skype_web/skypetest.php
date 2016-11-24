<html>
    <body style="margin: 0;">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="style.css">
        <script src="https://swx.cdn.skype.com/shared/v/1.2.15/SkypeBootstrap.min.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.2.min.js"></script>
        <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
                integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous"></script>
        <script>
            $(function () {
                'use strict';

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
                        "redirect_uri": 'http://localhost:81/moodle31/blocks/skype_web/skypetest.php'
                    });
                }
                function signin(options) {
                    window.skypeWebApp.signInManager.signIn(options).then(function () {
                        // when the sign in operation succeeds display the user name
                        $(".modal").hide();
                        console.log('Signed in as ' + window.skypeWebApp.personsAndGroupsManager.mePerson.displayName());
                        showSelf();
                        showContacts();
                        getContacts();
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

                function showSelf() {
                    var client = window.skypeWebApp;
                    if (window['noMeResource']) {
                        // This is most likely an online deployment where scopes are not configured to return me resource.
                        // Disable self link in this sample.
                        $('.content').html('<div class="noMe">Ability to read and update presence, photo, location and note of the signed in user is not available in the current release.</div>');
                        $('.container .content .noMe').show();
                        return;
                    }
                    // when it's signed in, display its name, title and email
                    $('#self-name').text(client.personsAndGroupsManager.mePerson.displayName());
                    $('#self-title').text(client.personsAndGroupsManager.mePerson.title());
                    $('#self-email').text(client.personsAndGroupsManager.mePerson.email());
                    // when the user changes the note field
                    $('#txt-note').on('blur', function (event) {
                        // tell the client to change the note
                        client.personsAndGroupsManager.mePerson.note.text.set($('#txt-note').text()).then(function () {
                            console.log('The note has been changed');
                        }).then(null, function (error) {
                            // and if could not be changed, report the failure
                            console.log(error || 'The server has rejected this note change.');
                        });
                    });
                    // when the user changes the location field
                    $('#self-location').on('blur', function (event) {
                        // tell the client to change the note state
                        client.personsAndGroupsManager.mePerson.location.set($('#self-location').text()).then(function () {
                            console.log('The location has been changed');
                        }).then(null, function (error) {
                            // and if could not be changed, report the failure
                            console.log(error || 'The server has rejected this location change.');
                        });
                    });
                    // blur() fields on Enter key to trigger change
                    $("#txt-note,#self-location").on('keypress', function (event) {
                        if (event.keyCode == 13) {
                            event.preventDefault();
                            event.target.blur();
                        }
                    });
                    $("#sel-presence").change(function () {
                        var value = $(this).val();
                        client.personsAndGroupsManager.mePerson.status.set(value).then(function () {
                            console.log('The mePerson status has been changed');
                        }).then(null, function (error) {
                            // and if could not be changed, report the failure
                            console.log(error || 'The server has rejected this status state.');
                        });
                    });
                    // when the note changes, display its value
                    client.personsAndGroupsManager.mePerson.note.text.changed(function (note) {
                        if (note) {
                            $('#txt-note').text(note);
                        }
                    });
                    // when the location changes, display its value
                    client.personsAndGroupsManager.mePerson.location.changed(function (location) {
                        if (location) {
                            $('#self-location').text(location);
                        }
                    });
                    // when the status changes, display its value
                    var presenceStyle;
                    client.personsAndGroupsManager.mePerson.status.changed(function (status) {
                        $('#sel-presence').val(status);
                        $(".photo-c .photo-presence")
                                .removeClass(presenceStyle)
                                .addClass(presenceStyle = 'photo-presence-' + status);
                    });
                    // when the photo URL changes, display the new photo
                    client.personsAndGroupsManager.mePerson.avatarUrl.changed(function (url) {
                        setTimeout(function () {
                            $('.persona.self .photo-c img').attr('src', url);
                        }, 0);
                    });
                    client.personsAndGroupsManager.mePerson.note.text.subscribe();
                    client.personsAndGroupsManager.mePerson.location.subscribe();
                    client.personsAndGroupsManager.mePerson.status.subscribe();
                    client.personsAndGroupsManager.mePerson.avatarUrl.subscribe();
                    //when the button for reset note is clicked
                    $('#reset-note').on('click', function () {
                        $('#status').text('reset note ...');
                        client.personsAndGroupsManager.mePerson.note.reset().then(function () {
                            $('#status').text('');
                        });
                    });
                    //when the button for reset location is clicked
                    $('#reset-location').on('click', function () {
                        client.personsAndGroupsManager.mePerson.location.reset().then(function () {
                            $('#status').text('');
                        });
                    });
                    //when the button for reset status is clicked
                    $('#reset-status').on('click', function () {
                        client.personsAndGroupsManager.mePerson.status.reset().then(function () {
                            $('#status').text('');
                        });
                    });
                    // Show default avatar if user's fails to load
                    $(".photo-c img").error(function (event) {
                        $(event.target).attr('src', 'pix/default.png');
                    });
                }

                function showContacts() {
                    var client = window.skypeWebApp;
                    // when the user clicks on the "Get Contact" button
                    $('#useruri').keypress(function (evt) {
                        if (evt.keyCode == 13) {
                            $("#btn-get-contact").click();
                        }
                    });
                    $('#btn-get-contact').click(function () {
                        // start the contact search
                        var pSearch = client.personsAndGroupsManager.createPersonSearchQuery();
                        if (!$('#useruri').val().trim()) {
                            return;
                        }
                        pSearch.text($('#useruri').val());
                        pSearch.limit(1);
                        pSearch.getMore().then(function () {
                            var sr = pSearch.results();
                            $('#status').text('Search succeeded. Parsing results...');
                            // and throw an exception if no contacts found:
                            // the exception will be passed to the next "fail"
                            // handler: this is how Promises/A+ work.
                            if (sr.length == 0)
                                throw new Error('The contact not found');
                            // then take any found contact
                            // and pass the found contact down the chain
                            return sr[0].result;
                        }).then(function (contact) {
                            $('#status').text('A contact found. Creating a view for it...');
                            var cNote = $("<div>");
                            var noteContainer = $("<div>").addClass("note-c")
                                    .append(cNote)
                                    .append($("<div>").addClass("tick"));
                            var cDisplayName = $('<p>').addClass("primary");
                            var cTitle = $('<p>').addClass("secondary");
                            var cLocation = $('<p>').addClass("tertiary");
                            var avatarPresence = $("<div>").addClass("photo-presence");
                            var avatar = $("<div>").addClass("photo-c")
                                    .append($("<img>"))
                                    .append(avatarPresence);
                            var detail = $("<div>").addClass("detail")
                                    .append(cDisplayName)
                                    .append(cTitle)
                                    .append(cLocation);
                            var persona = $("<div>")
                                    .addClass("persona").addClass("persona-xl")
                                    .append(noteContainer)
                                    .append(avatar)
                                    .append(detail);
                            contact.avatarUrl.get().then(function (avatarUrl) {
                                $("img", avatar).attr('src', avatarUrl)
                                        .error(setDefaultAvatar);
                            });
                            contact.displayName.get().then(function (displayName) {
                                cDisplayName.text(displayName);
                            });
                            contact.title.get().then(function (title) {
                                cTitle.text(title);
                            });
                            contact.location.get().then(function (location) {
                                cLocation.text(location);
                            });
                            contact.status.get().then(onPresenceChanged);
                            contact.note.text.get().then(function (note) {
                                cNote.text(note);
                            });
                            var cCapabilities = $('<p>').text('Capabilities: Unknown');
                            var capabilities = contact.capabilities;
                            onCapabilities();
                            var onPropertyChanged = function (value) {
                                this.text(value);
                            };
                            var presenceClass;
                            var onPresenceChanged = function (status) {
                                avatarPresence
                                        .removeClass(presenceClass)
                                        .addClass(presenceClass = 'photo-presence-' + status);
                            };
                            var subP = [], subM = [];
                            // display static data of the contact
                            $('#result').empty()
                                    .append(persona)
                                    .append(cCapabilities);
                            // let the user enable presence subscription
                            $('#subscribe').click(function () {
                                // tell the contact to notify us whenever its
                                // presence or note properties change
                                contact.note.text.changed(onPropertyChanged.bind(cNote));
                                contact.displayName.changed(onPropertyChanged.bind(cDisplayName));
                                contact.title.changed(onPropertyChanged.bind(cTitle));
                                contact.location.changed(onPropertyChanged.bind(cLocation));
                                contact.status.changed(onPresenceChanged);
                                subP.push(contact.note.text.subscribe());
                                subP.push(contact.displayName.subscribe());
                                subP.push(contact.title.subscribe());
                                subP.push(contact.location.subscribe());
                                subP.push(contact.status.subscribe());
                            });
                            $('#subscribe2').click(function () {
                                // tell the contact to notify us whenever its available capabilities change
                                capabilities.chat.changed(onCapabilities);
                                capabilities.audio.changed(onCapabilities);
                                capabilities.video.changed(onCapabilities);
                                subM.push(capabilities.chat.subscribe());
                                subM.push(capabilities.audio.subscribe());
                                subM.push(capabilities.video.subscribe());
                            });
                            // let the user disable presence subscription
                            $('#unsubscribe').click(function () {
                                // tell the contact that we are no longer interested in
                                // its presence and note properties
                                $.each(subP, function (i, sub) {
                                    sub.dispose();
                                });
                                subP = [];
                                $.each(subM, function (i, sub) {
                                    sub.dispose();
                                });
                                subM = [];
                            });
                            function onCapabilities() {
                                cCapabilities.text('Capabilities: ' +
                                        'chat = ' + capabilities.chat +
                                        ', audio = ' + capabilities.audio +
                                        ', video = ' + capabilities.video);
                            }
                            $('#status').text('A contact was found and displayed.');
                        }).then(null, function (error) {
                            // if either of the steps above threw an exception,
                            // catch it here and display to the user
                            $('#status').text(error || 'Something went wrong');
                        });
                    });
                    // Show default avatar if contact's fails to load
                    function setDefaultAvatar(event) {
                        $(event.target).attr({'src':'pix/default.png', 'height':'32px', 'width':'32px'});
                    }
                }
                
               function getContacts() {
                    var client = window.skypeWebApp;
                    var tagContactList = createGroupView(client.personsAndGroupsManager.all.persons, 'Contact List');
                    $('#results').append(tagContactList);
                    // display the list of groups and relationship groups
                    client.personsAndGroupsManager.all.groups.subscribe();
                    client.personsAndGroupsManager.all.groups.added(function (group) {
                        var tagGroup;
                        if (group.name())
                            tagGroup = createGroupView(group.persons, group.name());
                        else
                            tagGroup = createGroupView(group.persons, group.relationshipLevel());
                        $('#results').append(tagGroup);
                    });
                    
                    /**
                    * Creates a <div> element that contains a visual representation of
                    * the given collection of contacts.
                    *
                    * @param {Collection} contacts
                    * @param {String} title
                    *
                    * @returns A <div> element created with jQuery.
                    */
                   function createGroupView(contacts, title) {
                       var tagName = $('<div>').text(title).addClass('group-name');
                       var tagGroup = $('<div>').addClass("persona-list").append(tagName);
                       contacts.subscribe();
                       // when a contact gets added to the group
                       contacts.added(function (contact) {
                           var avatar = $("<div>").addClass("photo-c")
                               .append($("<img>")
                               .error(setDefaultAvatar));
                           var detailPrimary = $("<div>").addClass("primary");
                           var detail = $("<div>").addClass("detail")
                               .append(detailPrimary);
                           var tagContact = $("<li>").addClass("persona").addClass("persona-small")
                               .append(avatar)
                               .append(detail)
                               .appendTo(tagGroup);
                           // when the contact's avatar changes, update the <img> src
                           contact.avatarUrl.get().then(function (url) {
                               $("img", avatar).attr("src", url);
                           });
                           // when the contact's name changes, update the <li> tag's text
                           contact.displayName.get().then(function (displayName) {
                               detailPrimary.text(displayName);
                           });
                       });
                       return tagGroup;
                   }
                
                    // Show default avatar if user's fails to load
                    function setDefaultAvatar(event) {
                        $(event.target).attr({'src':'pix/default.png', 'height':'32px', 'width':'32px'});
                    }
                };
            });
        </script>
        <div class="wrappingdiv">
            <h2>Self</h2>
            <div class="self">
                <div class="need-to-add">
                    <p>Title: <span id="self-title"></span></p>
                    <p>Email: <span id="self-email"></span></p>
                </div>
                <div class="persona persona-xl self">
                    <div class="note-c">
                        <div id="txt-note" class="editable" contenteditable="true" placeholder="What's happening today?"></div>
                        <div class="tick"></div>
                    </div>
                    <div class="photo-c">
                        <img src="pix/default.png" height="48px" width="48px" />
                        <div class="photo-presence"></div>
                    </div>
                    <div class="detail">
                        <div id="self-name" class="primary"></div>
                        <select id="sel-presence" class="secondary">
                            <option value="Online">Available</option>
                            <option value="Busy">Busy</option>
                            <option value="DoNotDisturb">Do not disturb</option>
                            <option value="BeRightBack">Be right back</option>
                            <option value="Away">Appear away</option>
                        </select>
                        <div id="self-location" class="editable tertiary" contenteditable="true" placeholder="Enter a Location"></div>
                    </div>
                </div>
            </div>

<!--            <h2>Get Contact</h2>
            <div class="contact">
                <div>
                    <input type="text" id="useruri" placeholder="someone@example.com" />
                    <span id="btn-get-contact">Get Contact</span>
                </div>
                <div id="subscribe" class="button">Subscribe to name, presence and note changes</div>
                <div id="subscribe2" class="button">Subscribe to available modalities changes</div>
                <div id="unsubscribe" class="button">Un-subscribe all</div>
                <div id="status"></div>
                <div id="result"></div>
            </div>-->
            
            <h2>Group</h2>
            <div class="groups">
                <div id="results"></div>
            </div>
        </div>
    </body>
</html>