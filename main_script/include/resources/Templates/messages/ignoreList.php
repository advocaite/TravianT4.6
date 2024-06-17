<script type="text/javascript">
    jQuery(function() {
        "use strict";

        var renderIgnoreList = function () {
            Travian.ajax({
                data: {
                    cmd: 'ignoreList',
                    method: 'render_ignore_list'
                },

                onSuccess: function (response) {
                    if (response.result !== undefined) {
                        jQuery('#ignore-list').html(response.result);
                    }
                }
            });
        };

        renderIgnoreList();
    });

    var unignoreUser = function (targetPlayer) {
        Travian.ajax({
            data: {
                cmd: 'ignoreList',
                method: 'stop_ignore_target_player',
                renderIgnoreList: true,
                params: {
                    targetPlayer: targetPlayer
                }
            },

            onSuccess: function (response) {
                if ((response.error === undefined || !response.error) && response.result !== undefined) {
                    jQuery('#ignore-list').html(response.result);
                }
            }
        });

        return false;
    };
</script>

<div class="ignoreListContainer" id="ignore-list">
</div>
<br/>
<span></span>