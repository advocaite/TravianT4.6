<script type="text/javascript" data-cmp-info="6">
    jQuery(function(){
        "use strict";

        var renderIgnoreList = function() {
            Travian.api('player/ignore', {
                data: {
                    method: 'render_ignore_list'
                },
                success: function(response) {
                    if (response.result !== undefined) {
                        jQuery('#ignore-list').html(response.result);
                    }
                }
            });
        };

        renderIgnoreList();
    });

	var unignoreUser = function(targetPlayer) {
		Travian.api('player/ignore', {
			data: {
				method: 'stop_ignore_target_player',
				renderIgnoreList: true,
				params: {
					targetPlayer: targetPlayer
				}
			},
			success: function(response) {
				if ((response.error === undefined || !response.error) && response.result !== undefined) {
					jQuery('#ignore-list').html(response.result);
				}
			}
		});

		return false;
	};
</script>

<div class="ignoreListContainer" id="ignore-list"><div id="ignore-list-columns">
</div>
<div class="clear"></div>

<div class="clear"></div></div>