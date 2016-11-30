define(['jquery', 'platform/core/core'], function ($, $kd) {
    var LiveChat;

    LiveChat = function () {
        this.chatList = [];
    };

    $kd.action('btn-open-chat', function (btn) {
        var obj = btn.data('object');

        $kd.ajax('ajax/platform/message/chat/open', obj)
            .complete()
            .done(function (result) {
                $('#docklet-ow').prepend(result.html);
            })
            .error();
    }).action('btn-chat-conf-close', function (btn) {
        btn.closest('.chat-popup').remove();
    });

    window.Chat = new LiveChat();
});