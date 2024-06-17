<div id="statisticsV2" class="scene"></div>
<script type="text/javascript">
    window.Travian.getScript("js/webpack/static/js/main.js?_=a17a8f72", function() {
        window.Travian.React && window.Travian.React.Statistics && window.Travian.React.Statistics.render(<?=json_encode($vars['data']);?>,
            {
                gpack: {
                    url: "<?=get_gpack_cdn_mainPage_url();?>"
                },
                i18n: {
                    language: "<?=get_locale();?>",
                    translations: <?=json_encode($vars['translations']);?>,
                },
                Travian: {
                    Tip: window.Travian.Tip,
                    Game: {
                        Preferences: Travian.Game.Preferences,
                    },
                },
            }
        );
    });
</script>