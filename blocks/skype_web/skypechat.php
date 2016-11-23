<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Chat Service</title>
</head>
<body>
    <div class="">
        <div class="wrappingdiv">
            <div class="">
                <div class="chat-service">
                    <div class="noMe">Ability to receive chat, audio, and video invitations is not available in the current release.</div>
                    <h2>Chat Service</h2>
                    <div class="conversation">
                        <div id="start" class="header">
                            <div id="chat-to" class="editable" contenteditable="true" placeholder="sip:someone@example.com"></div>
                            <div>
                                <a id="btn-start-messaging" class="iconfont chat" title="Start Instant Messaging"></a>
                            </div>
                        </div>
                        <div id="status-header" class="header" style="display: none;">
                            <div class="right-controls">
                                <a id="btn-stop-messaging" class="icon icon-small icon-close" title="Stop Instant Messaging"></a>
                            </div>
                            <h3>Found User</h3>
                            <div class="chat-name"></div>
                            <div class="notification"></div>
                        </div>
                        <div id="message-history" class="messages"></div>
                        <div id="input-message" class="chatinput editable" contenteditable="true" placeholder="Type a message here" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="cc-conversations">
        </div>
    </div>
    
    <link href="style.css" rel="stylesheet" />
    <script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.2.min.js"></script>
    <script src="//swx.cdn.skype.com/shared/v/1.2.15/SkypeBootstrap.min.js"></script>
    
    <script src="sign-in.js" type="text/javascript"></script>
    <script src="chat-service.js"></script>
    <script type="text/javascript">
        $(function () {
            $('body').on('UserLoggedIn', function () {
                window['chat-service_load']();
            });

            window['sign-in_load']();
        });
    </script>
</body>
</html>


