<?php

use Core\Config;
use Game\Hero\SessionHero;
use Controller\HeroInventoryCtrl;
use Core\Database\DB;

?>

<script type="text/javascript">
    var adventureList = new Travian.AdventureList();
</script>

    
  
        <div id="content" class="heroAdventure heroAdventureAdventures">
            <h1 class="titleInHeader">Adventures</h1>
            <div id="heroAdventure" class="scene">
                <div class="heroState">
                    <i class="statusHome_medium"></i>
                    <div>
                        <span>Hero is currently in village 
                            <a href="karte.php" data-reactroot=""><?=$vars['hero']['vname']; ?></a>.
                        </span>
                    </div>
                </div>
                <div class="walkingCalculationWrapper  collapsed" onclick="stateChanged()">
                    <div class="title">Travel time calculation for other villages.
                        <svg viewBox="0 0 12 7.41">
                            <path d="M1.41 0L6 4.58 10.59 0 12 1.41l-6 6-6-6z"></path>
                        </svg>
                    </div>
                    <div class="formV2 walkingCalculationVillage" id="walkingCalculationVillage">
                        <label class="select">
                            <select name="village" class="selectVillage">
                                
                                <option value="111107" class="optionSelect" >New village</option>
                                <option value="111508" class="optionSelect">New village</option>
                            </select>
                            <div class="label pinned">Select village</div>
                        </label>
                        <div class="homeVillage">Hero is in the selected village.</div>
                    </div>
                </div>
                <table class="borderGap adventureList">
                    <thead>
                        <tr>
                            <th class="place">Place</th>
                            <th class="coordinates"></th>
                            <th class="duration">Duration</th>
                            <th class="difficulty">Danger</th>
                            <th class="button"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td class="place">
                                <img src="/img/x.gif" class="hill" alt="Mountain">
                            </td>
                            <td class="coordinates">
                                <a class="" href="/karte.php?x=-10&amp;y=-83">‭
                                    <span class="coordinates coordinatesWrapper coordinatesAligned coordinatesltr">
                                        <span class="coordinateX">(‭-‭10‬‬</span>
                                        <span class="coordinatePipe">|</span>
                                        <span class="coordinateY">‭-‭83‬‬)</span>
                                    </span>‬
                                </a>
                            </td>
                            <td class="duration">0:12:44</td>
                            <td class="difficulty">
                                <i alt="hard" class="difficulty_hard"></i>
                            </td>
                            <td class="button">
                                <button class="textButtonV2 buttonFramed rectangle withText green" type="button" data-mapid="113674">
                                    <div>
                                        <div>Explore</div>
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="place">
                                <img src="/img/x.gif" class="clay" alt="Clay">
                            </td>
                            <td class="coordinates">
                                <a class="" href="/karte.php?x=-4&amp;y=-70">‭
                                    <span class="coordinates coordinatesWrapper coordinatesAligned coordinatesltr">
                                        <span class="coordinateX">(‭-‭4‬‬</span>
                                        <span class="coordinatePipe">|</span>
                                        <span class="coordinateY">‭-‭70‬‬)</span>
                                    </span>‬
                                </a>
                            </td>
                            <td class="duration">0:11:10</td>
                            <td class="difficulty">
                                <i alt="normal" class="difficulty_normal"></i>
                            </td>
                            <td class="button">
                                <button class="textButtonV2 buttonFramed rectangle withText green" type="button" data-mapid="108467">
                                    <div>
                                        <div>Explore</div>
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="place">
                                <img src="/img/x.gif" class="grassland" alt="Plains">
                            </td>
                            <td class="coordinates">
                                <a class="" href="/karte.php?x=-15&amp;y=-68">‭
                                    <span class="coordinates coordinatesWrapper coordinatesAligned coordinatesltr">
                                        <span class="coordinateX">(‭-‭15‬‬</span>
                                        <span class="coordinatePipe">|</span>
                                        <span class="coordinateY">‭-‭68‬‬)</span>
                                    </span>‬
                                </a>
                            </td>
                            <td class="duration">0:14:33</td>
                            <td class="difficulty">
                                <i alt="normal" class="difficulty_normal"></i>
                            </td>
                            <td class="button">
                                <button class="textButtonV2 buttonFramed rectangle withText green" type="button" data-mapid="107654">
                                    <div>
                                        <div>Explore</div>
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="place">
                                <img src="/img/x.gif" class="grassland" alt="Plains">
                            </td>
                            <td class="coordinates">
                                <a class="" href="/karte.php?x=-12&amp;y=-85">‭
                                    <span class="coordinates coordinatesWrapper coordinatesAligned coordinatesltr">
                                        <span class="coordinateX">(‭-‭12‬‬</span>
                                        <span class="coordinatePipe">|</span>
                                        <span class="coordinateY">‭-‭85‬‬)</span>
                                    </span>‬
                                </a>
                            </td>
                            <td class="duration">0:16:29</td>
                            <td class="difficulty">
                                <i alt="normal" class="difficulty_normal"></i>
                            </td>
                            <td class="button">
                                <button class="textButtonV2 buttonFramed rectangle withText green" type="button" data-mapid="114474">
                                    <div>
                                        <div>Explore</div>
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="place">
                                <img src="/img/x.gif" class="grassland" alt="Plains">
                            </td>
                            <td class="coordinates">
                                <a class="" href="/karte.php?x=-4&amp;y=-66">‭
                                    <span class="coordinates coordinatesWrapper coordinatesAligned coordinatesltr">
                                        <span class="coordinateX">(‭-‭4‬‬</span>
                                        <span class="coordinatePipe">|</span>
                                        <span class="coordinateY">‭-‭66‬‬)</span>
                                    </span>‬
                                </a>
                            </td>
                            <td class="duration">0:16:15</td>
                            <td class="difficulty">
                                <i alt="hard" class="difficulty_hard"></i>
                            </td>
                            <td class="button">
                                <button class="textButtonV2 buttonFramed rectangle withText green" type="button" data-mapid="106863">
                                    <div>
                                        <div>Explore</div>
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="place">
                                <img src="/img/x.gif" class="lake" alt="Lake">
                            </td>
                            <td class="coordinates">
                                <a class="" href="/karte.php?x=-7&amp;y=-85">‭
                                    <span class="coordinates coordinatesWrapper coordinatesAligned coordinatesltr">
                                        <span class="coordinateX">(‭-‭7‬‬</span>
                                        <span class="coordinatePipe">|</span>
                                        <span class="coordinateY">‭-‭85‬‬)</span>
                                    </span>‬
                                </a>
                            </td>
                            <td class="duration">0:16:06</td>
                            <td class="difficulty">
                                <i alt="normal" class="difficulty_normal"></i>
                            </td>
                            <td class="button">
                                <button class="textButtonV2 buttonFramed rectangle withText green" type="button" data-mapid="114479">
                                    <div>
                                        <div>Explore</div>
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="place">
                                <img src="/img/x.gif" class="forest" alt="Forest">
                            </td>
                            <td class="coordinates">
                                <a class="" href="/karte.php?x=0&amp;y=-77">‭
                                    <span class="coordinates coordinatesWrapper coordinatesAligned coordinatesltr">
                                        <span class="coordinateX">(‭0‬</span>
                                        <span class="coordinatePipe">|</span>
                                        <span class="coordinateY">‭-‭77‬‬)</span>
                                    </span>‬
                                </a>
                            </td>
                            <td class="duration">0:14:33</td>
                            <td class="difficulty">
                                <i alt="normal" class="difficulty_normal"></i>
                            </td>
                            <td class="button">
                                <button class="textButtonV2 buttonFramed rectangle withText green" type="button" data-mapid="111278">
                                    <div>
                                        <div>Explore</div>
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="place">
                                <img src="/img/x.gif" class="hill" alt="Mountain">
                            </td>
                            <td class="coordinates">
                                <a class="" href="/karte.php?x=-11&amp;y=-83">‭
                                    <span class="coordinates coordinatesWrapper coordinatesAligned coordinatesltr">
                                        <span class="coordinateX">(‭-‭11‬‬</span>
                                        <span class="coordinatePipe">|</span>
                                        <span class="coordinateY">‭-‭83‬‬)</span>
                                    </span>‬
                                </a>
                            </td>
                            <td class="duration">0:13:01</td>
                            <td class="difficulty">
                                <i alt="normal" class="difficulty_normal"></i>
                            </td>
                            <td class="button">
                                <button class="textButtonV2 buttonFramed rectangle withText green" type="button" data-mapid="113673">
                                    <div>
                                        <div>Explore</div>
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="place">
                                <img src="/img/x.gif" class="lake" alt="Lake">
                            </td>
                            <td class="coordinates">
                                <a class="" href="/karte.php?x=-15&amp;y=-64">‭
                                    <span class="coordinates coordinatesWrapper coordinatesAligned coordinatesltr">
                                        <span class="coordinateX">(‭-‭15‬‬</span>
                                        <span class="coordinatePipe">|</span>
                                        <span class="coordinateY">‭-‭64‬‬)</span>
                                    </span>‬
                                </a>
                            </td>
                            <td class="duration">0:19:47</td>
                            <td class="difficulty">
                                <i alt="hard" class="difficulty_hard"></i>
                            </td>
                            <td class="button">
                                <button class="textButtonV2 buttonFramed rectangle withText green" type="button" data-mapid="106050">
                                    <div>
                                        <div>Explore</div>
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="place">
                                <img src="/img/x.gif" class="clay" alt="Clay">
                            </td>
                            <td class="coordinates">
                                <a class="" href="/karte.php?x=-17&amp;y=-86">‭
                                    <span class="coordinates coordinatesWrapper coordinatesAligned coordinatesltr">
                                        <span class="coordinateX">(‭-‭17‬‬</span>
                                        <span class="coordinatePipe">|</span>
                                        <span class="coordinateY">‭-‭86‬‬)</span>
                                    </span>‬
                                </a>
                            </td>
                            <td class="duration">0:21:29</td>
                            <td class="difficulty">
                                <i alt="normal" class="difficulty_normal"></i>
                            </td>
                            <td class="button">
                                <button class="textButtonV2 buttonFramed rectangle withText green" type="button" data-mapid="114870">
                                    <div>
                                        <div>Explore</div>
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="place">
                                <img src="/img/x.gif" class="hill" alt="Mountain">
                            </td>
                            <td class="coordinates">
                                <a class="" href="/karte.php?x=-9&amp;y=-64">‭
                                    <span class="coordinates coordinatesWrapper coordinatesAligned coordinatesltr">
                                        <span class="coordinateX">(‭-‭9‬‬</span>
                                        <span class="coordinatePipe">|</span>
                                        <span class="coordinateY">‭-‭64‬‬)</span>
                                    </span>‬
                                </a>
                            </td>
                            <td class="duration">0:17:22</td>
                            <td class="difficulty">
                                <i alt="normal" class="difficulty_normal"></i>
                            </td>
                            <td class="button">
                                <button class="textButtonV2 buttonFramed rectangle withText green" type="button" data-mapid="106056">
                                    <div>
                                        <div>Explore</div>
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="place">
                                <img src="/img/x.gif" class="hill" alt="Mountain">
                            </td>
                            <td class="coordinates">
                                <a class="" href="/karte.php?x=-17&amp;y=-69">‭
                                    <span class="coordinates coordinatesWrapper coordinatesAligned coordinatesltr">
                                        <span class="coordinateX">(‭-‭17‬‬</span>
                                        <span class="coordinatePipe">|</span>
                                        <span class="coordinateY">‭-‭69‬‬)</span>
                                    </span>‬
                                </a>
                            </td>
                            <td class="duration">0:15:47</td>
                            <td class="difficulty">
                                <i alt="normal" class="difficulty_normal"></i>
                            </td>
                            <td class="button">
                                <button class="textButtonV2 buttonFramed rectangle withText green" type="button" data-mapid="108053">
                                    <div>
                                        <div>Explore</div>
                                    </div>
                                </button>
                            </td>
                        </tr> -->
                         <?=$vars['tbody'];?>
                    </tbody>
                </table>
            
<script type="text/javascript">
    // jQuery(function() {
    //     window.Travian.Browser.getScript('//gpack.travian.com/4d2c3f41/js/main.js', function() {
    //         window.Travian.React && window.Travian.React.HeroAdventure && window.Travian.React.HeroAdventure.render(
    //             {
    //                 gql: "{ownPlayer{hero{isRegenerating,regenerationDuration,homeVillage{mapId,id,name},status{status,inOasis{belongsTo{mapId,name}},inVillage{id,mapId,name,type},arrivalAt,arrivalIn,onWayTo{x,y,village{mapId,name}}}adventures{mapId,x,y,place,difficulty,travelingDuration}},villages{id,mapId,name,hasRallyPoint,x,y}}}",
    //                 viewData: {"data":{"ownPlayer":{"hero":{"isRegenerating":false,"regenerationDuration":null,"homeVillage":{"mapId":110467,"id":21085,"name":"leonidas`s village"},"status":{"status":100,"inOasis":null,"inVillage":{"id":21085,"mapId":110467,"name":"leonidas`s village","type":1},"arrivalAt":null,"arrivalIn":null,"onWayTo":null},"adventures":[{"mapId":113674,"x":-10,"y":-83,"place":"hill","difficulty":0,"travelingDuration":764},{"mapId":108467,"x":-4,"y":-70,"place":"clay","difficulty":1,"travelingDuration":670},{"mapId":107654,"x":-15,"y":-68,"place":"grassland","difficulty":2,"travelingDuration":873},{"mapId":114474,"x":-12,"y":-85,"place":"grassland","difficulty":3,"travelingDuration":989},{"mapId":106863,"x":-4,"y":-66,"place":"grassland","difficulty":0,"travelingDuration":975},{"mapId":114479,"x":-7,"y":-85,"place":"lake","difficulty":1,"travelingDuration":966},{"mapId":111278,"x":0,"y":-77,"place":"forest","difficulty":2,"travelingDuration":873},{"mapId":113673,"x":-11,"y":-83,"place":"hill","difficulty":3,"travelingDuration":781},{"mapId":106050,"x":-15,"y":-64,"place":"lake","difficulty":0,"travelingDuration":1187},{"mapId":114870,"x":-17,"y":-86,"place":"clay","difficulty":1,"travelingDuration":1289},{"mapId":106056,"x":-9,"y":-64,"place":"hill","difficulty":2,"travelingDuration":1042},{"mapId":108053,"x":-17,"y":-69,"place":"hill","difficulty":3,"travelingDuration":947}]},"villages":[{"id":21085,"mapId":110467,"name":"leonidas`s village","hasRallyPoint":true,"x":-9,"y":-75},{"id":28624,"mapId":111107,"name":"New village","hasRallyPoint":true,"x":-171,"y":-77},{"id":34972,"mapId":111508,"name":"New village","hasRallyPoint":true,"x":-171,"y":-78}]}}},
    //                 activePerspective: "perspectiveResources"
    //             }, 
    //                 ajax: {
    //                     handler: Travian.api,
    //                     onAjaxError: function(error) {
    //                         (new Travian.Dialog.Dialog({preventFormSubmit: true}))
    //                             .setContent(!error || error.length === 0 ? '' : error)
    //                             .show();
    //                     }
    //                 },
    //                 lib: {
    //                     jQuery: jQuery
    //                 },
    //                 Travian: {
    //                     Tip: Travian.Tip,
    //                     Game: {
    //                         Layout: Travian.Game.Layout,
    //                         Hero: Travian.Game.Hero
    //                     },
    //                     Constants: Travian.Constants,
    //                     Variables: Travian.Variables,
    //                 },
    //                 common: {
    //                     timezone: "Europe\/London"                    }
    //             }
    //         );
    //     });
    // });
</script>
                            </div>
                        </div>
                    				
<script type="text/javascript">
    function stateChanged()
    {
        console.log(event.target.className);
        var state=document.getElementsByClassName("walkingCalculationWrapper")[0];
        if(state.className.includes("collapsed"))
        {
           
            document.getElementsByClassName("walkingCalculationWrapper")[0].className= document.getElementsByClassName("walkingCalculationWrapper")[0].className.replace("collapsed","expanded");
            
        }
        else{
            if(event.target.className!='selectVillage')
            document.getElementsByClassName("walkingCalculationWrapper")[0].className= document.getElementsByClassName("walkingCalculationWrapper")[0].className.replace("expanded","collapsed");
           
        }
    }


    jQuery(function() {
        var chooseOtherVillageLink = jQuery('chooseOtherVillageLink');
        if (chooseOtherVillageLink.length > 0) {
            chooseOtherVillageLink.on('click', function(e) {
                var sw = jQuery('#durationCalculationsContainer .openedClosedSwitch');
                Travian.toggleSwitch(jQuery('durationCalculations'), sw);
                Travian.toggleSwitchDescription(sw, '<?=T("HeroAdventure", "Show travel time calculation for other villages");?>.', '<?=T("HeroAdventure", "Hide travel time calculation for other villages");?>');
            });
        }
    });
    $(document).ready(function () {
            var dump;
            $(".textButtonV2").on('click', function () {
                var txt1 = "<div class='adventureStarted lake'><div class='heroState'><i class='statusRunning_medium'></i><div><span>Your hero is on its way to an adventure in <a class='' href='/karte.php?x=-7&amp;y=-85'>‭<span class='coordinates coordinatesWrapper'><span class='coordinateX'> -‭7‬‬</span><span class='coordinatePipe'>|</span><span class='coordinateY'>‭-‭85‬ </span></span>‬</a>.</span>&nbsp;<span><span>Arrival in <span class='timer' counting='down' value='15399' data-reactroot=''>4:16:39</span> at 11:04</span></span><br><span class='hint'><span>(The adventure's progress can be seen in the <a href='/build.php?id=39&amp;tt=1&amp;newdid=28624' data-reactroot=''>Rally point</a>.)</span></span></div></div><button class='textButtonV2 buttonFramed continue rectangle withText green'  type='button'><div>Continue</div></button></div>"; 
                $("#heroAdventure").empty();
                $("#heroAdventure").append(txt1);
              dump=$(this).attr('data-mapid')  ;
            });
           
 
            $(document).on('click', '.continue', function() {
                // This will work!
               location.reload();
            });
          
        });
    function selectVillage(){
      
        var state=document.getElementsByClassName("walkingCalculationWrapper")[0];
        document.getElementsByClassName("walkingCalculationWrapper")[0].className= document.getElementsByClassName("walkingCalculationWrapper")[0].className.replace("collapsed","expanded");
        }
</script>






