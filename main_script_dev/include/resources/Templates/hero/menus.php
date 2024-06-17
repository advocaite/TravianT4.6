<?php $favorTabId = \Core\Session::getInstance()->getFavoriteTab("hero");?>
<?php

use Core\Config;
use Game\Hero\SessionHero;
use Controller\Hero_imageCtrl;
use Core\Database\DB;

?>
<?php
      
        
?>
    <script src=
    "https://html2canvas.hertzen.com/dist/html2canvas.min.js">
    </script>
<div>
    <div class="contentNavi subNavi tabFavorWrapper">
        <button type="button" class="scrollFrom" disabled=""></button>
        <div class="scrollingContainer" id="firstTab">
            <div class="content favorActive" data-tab="#tab-inventory"><a class="tabItem active"
                    id="inventory1">Inventory</a></div>
            <div data-tab="#tab-attributes" class="content "><a class="tabItem " id="attributes1">Attributes</a></div>
            <div class="content " data-tab="#tab-apperance"><a class="tabItem " id="apperance1">Appearance</a></div>
        </div>
    </div>
    
    <div class="dialogOverlay dialogVisible enabled " style="z-index:6666; display:none; " id="toolModal_cage">
        <div class="dialogWrapper dialogV2" data-context="" style="position: absolute;
            margin-left: 40%;
            margin-top: 30%;">
            <div class="dialog confirmation heroConsumablesPopup heroV2 scene">
                <div class="dialogContainer">
                    <div class="dialogContents1" style="border-radius: 5px;
                    border: 1px solid #beae9a;
                    background-color: #fff9eb;
                    padding: 10px;
                    min-width: 300px;
                    width: min-content;
                    ">
                        <form action="?" method="get" accept-charset="UTF-8">
                            <div class="dialogDragBar"></div>
                            <div class="content" id="dialogContent">

                                <h3>Cage</h3>
                                <div class="itemInformation">
                                    <div class="heroItem consumable       " title="" data-tier="consumable">
                                        <svg viewBox="0 0 62 62">
                                            <path class="top" d="M31 4l2-4h-4l2 4z"></path>
                                            <path class="bottom" d="M29 62h4l-2-4-2 4z"></path>
                                            <path class="from" d="M0 33l4-2-4-2v4z"></path>
                                            <path class="to" d="M58 31l4 2v-4l-4 2z"></path>
                                        </svg>
                                        <div class="item item114"></div>
                                        <div class="count">28</div>
                                    </div>
                                    <span>Equip and raid an oasis with animals to tame them. Tamed animals reinforce
                                        your village as defensive troops. Taming animals happens without combat.</span>
                                </div>
                                <div class="formV2" id="consumableHeroItem">
                                    <label class="input">
                                        <input type="text" inputmode="numeric" value="28" id="input_cage">
                                        <div class="label pinned">Number of items moved to inventory</div>
                                    </label>
                                </div>
                                <div class="buttonsWrapper">
                                    <button class="textButtonV2 buttonFramed rectangle withText grey" type="button"
                                        id="btnClose_cage">
                                        <div>Cancel</div>
                                    </button>
                                    <button class="textButtonV2 buttonFramed rectangle withText green" type="button"
                                        data-id="233985" data-placeid="-6" data-amount="28" id="btnMove_cage">
                                        <div>Move</div>
                                    </button>
                                </div>
                            </div>

                            <div class="buttons"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dialogOverlay dialogVisible enabled " style="z-index:6666; display:none" id="download_modal">
        <div class="dialogWrapper dialogV2" data-context="" style="position: absolute;
            margin-left: 30%;
            margin-top: 10%;">
            <div class="dialog confirmation heroDownloadDialog heroV2 scene">
                <div class="dialogContainer">
                    <div class="dialogContents">
                       
                            <div class="dialogDragBar"></div>
                            <div class="content" id="dialogContent">
                                <h3>Download hero image</h3>
                                <p>Download an image of your current hero to use as a social media avatar.</p>
                                <div class="imageComposer">
                                    <div class="backgroundSelection">
                                        <div class="label">Choose background</div>
                                        <label class="option heroBackground" data-checked="" onclick="backgroundSelection('heroBackground')">
                                            <input type="radio" name="background" id="background_heroBackground" value="heroBackground" checked="">
                                        </label>
                                        <label class="option oasisCrop" data-checked="" onclick="backgroundSelection('oasisCrop')">
                                            <input type="radio" name="background" id="background_oasisCrop" value="oasisCrop">
                                        </label>
                                        <label class="option volcano"  onclick="backgroundSelection('volcano')">
                                            <input type="radio" name="background" id="background_volcano" value="volcano">
                                        </label>
                                        <label class="option none" data-checked="" onclick="backgroundSelection('none')">
                                            <input type="radio" name="background" id="background_none" value="none">
                                            <svg viewBox="0 0 14 14">
                                                <path d="M14 1.4 12.6 0 7 5.6 1.4 0 0 1.4 5.6 7 0 12.6 1.4 14 7 8.4l5.6 5.6 1.4-1.4L8.4 7 14 1.4z"></path>
                                            </svg>
                                        </label>
                                    </div>
                                    <div class="preview">
                                        <div class="label">Preview</div>
                                        <div id="downloadHeroImagePreview" class="heroImageWrapper " style="background-image: url(https://gpack.example.com/29c89d54/mainPage/img_ltr/scenes/HeroV2/download/heroBackground.jpg);">
                                            <img src="hero_body.php?uid=<?= $vars['hero']['uid']; ?>&size=inventory&horse=<?=$vars['hero']['horse'];?>&helmet=<?=$vars['hero']['helmet']?>" class="heroBodyImage heroBodyImage-<?= getDirection(); ?>" alt="<?= T("HeroInventory", "Body" ); ?>"   style="touch-action: none; cursor: inherit";/> 
                                      
                                        </div>
                                       
                                   
                                    
                                    
                                    </div>
                                </div>
                                <div class="buttonsWrapper">
                                    <button class="textButtonV2 buttonFramed rectangle withText grey" type="button" onclick="downloadCancelClicked()">
                                        <div>Cancel</div>
                                    </button>
                                    <button class="textButtonV2 buttonFramed download rectangle withText green" onclick="takeshot()"  >
                                        <div>Download</div>
                                    </button>
                                </div>
                            </div>
                            <div class="buttons"></div>
                         <div id="output"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <div class="dialogOverlay dialogVisible enabled " style="z-index:6666; display:none; " id="toolModal_bandage">
        <div class="dialogWrapper dialogV2" data-context="" style="position: absolute;
            margin-left: 40%;
            margin-top: 30%;">
            <div class="dialog confirmation heroConsumablesPopup heroV2 scene">
                <div class="dialogContainer">
                    <div class="dialogContents1" style="border-radius: 5px;
                    border: 1px solid #beae9a;
                    background-color: #fff9eb;
                    padding: 10px;
                    min-width: 300px;
                    width: min-content;
                    ">
                        <form action="?" method="get" accept-charset="UTF-8">
                            <div class="dialogDragBar"></div>
                            <div class="content" id="dialogContent">
                                <h3>Bandage</h3>
                                <div class="itemInformation">
                                    <div class="heroItem consumable       " title="" data-tier="consumable">
                                        <svg viewBox="0 0 62 62">
                                            <path class="top" d="M31 4l2-4h-4l2 4z"></path>
                                            <path class="bottom" d="M29 62h4l-2-4-2 4z"></path>
                                            <path class="from" d="M0 33l4-2-4-2v4z"></path>
                                            <path class="to" d="M58 31l4 2v-4l-4 2z"></path>
                                        </svg>
                                        <div class="item item113"></div>
                                        <div class="count">45</div>
                                    </div>
                                    <span>‭‭33‬%‬ healed troop losses right after battle. You can only heal the number
                                        of troops that you have bandages for. Healing time is equal to the return time
                                        of these troops, but at least 12h.</span>
                                </div>
                                <div class="formV2" id="consumableHeroItem">
                                    <label class="input">
                                        <input type="text" inputmode="numeric" value="45" id="input_bandage">
                                        <div class="label pinned">Number of bandages to equip</div>
                                    </label>
                                </div>
                                <div class="itemImpact">
                                    <div class="impactDescription">Number of equipped bandages:</div>
                                    <div class="impactValue">
                                        <span class="from">0</span>
                                        <svg viewBox="0 0 22 22" preserveAspectRatio="none">
                                            <path d="M6 0L6 12L0 12L11 22L22 12L16 12L16 0Z"></path>
                                        </svg>
                                        <span class="to">45</span>
                                    </div>
                                </div>
                                <div class="buttonsWrapper">
                                    <button class="textButtonV2 buttonFramed rectangle withText grey" type="button"
                                        id="btnClose_bandage">
                                        <div>Cancel</div>
                                    </button>
                                    <button class="textButtonV2 buttonFramed rectangle withText green" type="button"
                                        data-id="424754" data-placeid="10" data-amount="45" id="btnMove_bandage">
                                        <div>Equip</div>
                                    </button>
                                </div>
                            </div>
                            <div class="buttons"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="dialogOverlay dialogVisible enabled " style="z-index:6666; display:none; " id="toolModal_smallbandage">
        <div class="dialogWrapper dialogV2" data-context="" style="position: absolute;
            margin-left: 40%;
            margin-top: 30%;">
            <div class="dialog confirmation heroConsumablesPopup heroV2 scene">
                <div class="dialogContainer">
                    <div class="dialogContents1" style="border-radius: 5px;
                    border: 1px solid #beae9a;
                    background-color: #fff9eb;
                    padding: 10px;
                    min-width: 300px;
                    width: min-content;
                    ">
                        <form action="?" method="get" accept-charset="UTF-8">
                            <div class="dialogDragBar"></div>
                            <div class="content" id="dialogContent">
                                <h3>Small Bandage</h3>
                                <div class="itemInformation">
                                    <div class="heroItem consumable       " title="" data-tier="consumable">
                                        <svg viewBox="0 0 62 62">
                                            <path class="top" d="M31 4l2-4h-4l2 4z"></path>
                                            <path class="bottom" d="M29 62h4l-2-4-2 4z"></path>
                                            <path class="from" d="M0 33l4-2-4-2v4z"></path>
                                            <path class="to" d="M58 31l4 2v-4l-4 2z"></path>
                                        </svg>
                                        <div class="item item112"></div>
                                        <div class="count">62</div>
                                    </div>
                                    <span>‭‭25‬%‬ healed troop losses right after battle. You can only heal the number
                                        of troops that you have bandages for. Healing time is equal to the return time
                                        of these troops, but at least 12h.</span>
                                </div>
                                <div class="formV2" id="consumableHeroItem">
                                    <label class="input">
                                        <input type="text" inputmode="numeric" value="62" id="input_smallbandage">
                                        <div class="label pinned">Number of small bandages to equip</div>
                                    </label>
                                </div>
                                <div class="itemImpact">
                                    <div class="impactDescription">Number of equipped small bandages:</div>
                                    <div class="impactValue">
                                        <span class="from">0</span>
                                        <svg viewBox="0 0 22 22" preserveAspectRatio="none">
                                            <path d="M6 0L6 12L0 12L11 22L22 12L16 12L16 0Z"></path>
                                        </svg>
                                        <span class="to">62</span>
                                    </div>
                                </div>
                                <div class="buttonsWrapper">
                                    <button class="textButtonV2 buttonFramed rectangle withText grey" type="button"
                                        id="btnClose_smallbandage">
                                        <div>Cancel</div>
                                    </button>
                                    <button class="textButtonV2 buttonFramed rectangle withText green" type="button"
                                        data-id="330940" data-placeid="6" data-amount="62" id="btnMove_smallbandage">
                                        <div>Equip</div>
                                    </button>
                                </div>
                            </div>
                            <div class="buttons"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="dialogOverlay dialogVisible enabled " style="z-index:6666; display:none; " id="toolModal_tableofLaw">
        <div class="dialogWrapper dialogV2" data-context="" style="position: absolute;
            margin-left: 40%;
            margin-top: 30%;">
            <div class="dialog confirmation heroConsumablesPopup heroV2 scene">
                <div class="dialogContainer">
                    <div class="dialogContents1" style="border-radius: 5px;
                    border: 1px solid #beae9a;
                    background-color: #fff9eb;
                    padding: 10px;
                    min-width: 300px;
                    width: min-content;
                    ">
                        <form action="?" method="get" accept-charset="UTF-8">
                            <div class="dialogDragBar"></div>
                            <div class="content" id="dialogContent">
                                <h3>Tablet of Law</h3>
                                <div class="itemInformation">
                                    <div class="heroItem consumable       " title="" data-tier="consumable">
                                        <svg viewBox="0 0 62 62">
                                            <path class="top" d="M31 4l2-4h-4l2 4z"></path>
                                            <path class="bottom" d="M29 62h4l-2-4-2 4z"></path>
                                            <path class="from" d="M0 33l4-2-4-2v4z"></path>
                                            <path class="to" d="M58 31l4 2v-4l-4 2z"></path>
                                        </svg>
                                        <div class="item item109"></div>
                                        <div class="count">44</div>
                                    </div>
                                    <span>Each tablet of law that is used will raise the loyalty of your hero's home
                                        village by ‭‭1‬%‬ (to a maximum of ‭‭125‬%‬)</span>
                                </div>
                                <div class="error">You cannot use this item currently, as your village has reached
                                    maximum loyalty.</div>
                                <div class="formV2" id="consumableHeroItem">
                                    <label class="input">
                                        <input type="text" inputmode="numeric" value="0" id="input_tableofLaw">
                                        <div class="label pinned">Number of tablets of law used</div>
                                    </label>
                                </div>
                                <div class="buttonsWrapper">
                                    <button class="textButtonV2 buttonFramed rectangle withText grey" type="button"
                                        id="btnClose_tableofLaw">
                                        <div>Cancel</div>
                                    </button>
                                    <button class="textButtonV2 buttonFramed disabled rectangle withText green"
                                        type="button" disabled="" data-id="439283" data-placeid="9" data-amount="0"
                                        id="btnMove_tableofLaw">
                                        <div>Use</div>
                                    </button>
                                </div>
                            </div>
                            <div class="buttons"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="dialogOverlay dialogVisible enabled " style="z-index:6666; display:none; " id="toolModal_crop">
        <div class="dialogWrapper dialogV2" data-context="" style="position: absolute;
            margin-left: 40%;
            margin-top: 30%;">
            <div class="dialog confirmation heroConsumablesPopup heroV2 scene">
                <div class="dialogContainer">
                    <div class="dialogContents1" style="border-radius: 5px;
                    border: 1px solid #beae9a;
                    background-color: #fff9eb;
                    padding: 10px;
                    min-width: 300px;
                    width: min-content;
                    ">
                        <form action="?" method="get" accept-charset="UTF-8">
                            <div class="dialogDragBar"></div>
                            <div class="content" id="dialogContent">
                                <h3>Crop</h3>
                                <div class="itemInformation">
                                    <div class="heroItem consumable       " title="" data-tier="consumable">
                                        <svg viewBox="0 0 62 62">
                                            <path class="top" d="M31 4l2-4h-4l2 4z"></path>
                                            <path class="bottom" d="M29 62h4l-2-4-2 4z"></path>
                                            <path class="from" d="M0 33l4-2-4-2v4z"></path>
                                            <path class="to" d="M58 31l4 2v-4l-4 2z"></path>
                                        </svg>
                                        <div class="item item148"></div>
                                        <div class="count">145169</div>
                                    </div>
                                    <span>Transfer crop to the granary of your currently active village.</span>
                                </div>
                                <div class="formV2" id="consumableHeroItem">
                                    <label class="input">
                                        <input type="text" inputmode="numeric" value="11053" id="input_crop">
                                        <div class="label pinned">Amount of crop to transfer</div>
                                    </label>
                                </div>
                                <div class="itemImpact">
                                    <div class="impactDescription">Send to active village:</div>
                                    <div class="impactValue">
                                        <span class="value">New village</span>
                                    </div>
                                </div>
                                <div class="itemImpact">
                                    <div class="impactDescription">Amount in storage after transfer:</div>
                                    <div class="impactValue">
                                        <span class="from">6547</span>
                                        <svg viewBox="0 0 22 22" preserveAspectRatio="none">
                                            <path d="M6 0L6 12L0 12L11 22L22 12L16 12L16 0Z"></path>
                                        </svg>
                                        <span class="to">17600</span>
                                    </div>
                                </div>
                                <div class="buttonsWrapper">
                                    <button class="textButtonV2 buttonFramed rectangle withText grey" type="button"
                                        id="btnClose_crop">
                                        <div>Cancel</div>
                                    </button>
                                    <button class="textButtonV2 buttonFramed rectangle withText green" type="button"
                                        data-id="199884" data-placeid="4" data-amount="11053" id="btnMove_crop">
                                        <div>Transfer</div>
                                    </button>
                                </div>
                            </div>
                            <div class="buttons"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ToolTips">

        <div class="heroItemTooltip tier1" style="display:none">
            <div class="title">Gelding</div>
            <div class="subTitle">Tier 1 Horse</div>
            <div class="separator"></div>
            <div class="stat">
                <div>‭+‭14‬‬ speed for mounted hero</div>
                <div class="details">Includes Gaul tribe advantage.</div>
            </div>
        </div>
        <div class="heroItemTooltip consumable helmet" style="display:none">
            <div class="title">Helmet of Enlightenment</div>
            <div class="subTitle">Tier 2 Head gear</div>
            <div class="separator"></div>
            <div class="stat">
                <div>‭+‭20‬%‬ experience</div>
            </div>
        </div>
        <div class="heroItemTooltip consumable body" style="display:none">
            <div class="title">Body of Enlightenment</div>
            <div class="subTitle">Defense Improvement</div>
            <div class="separator"></div>
            <div class="stat">
                <div>‭+‭20‬%‬ experience</div>
            </div>
        </div>
        <div class="heroItemTooltip consumable leftHand" style="display:none">
            <div class="title">LeftHand of Enlightenment</div>
            <div class="subTitle">Attack Improvement</div>
            <div class="separator"></div>
            <div class="stat">
                <div>‭+‭20‬%‬ experience</div>
            </div>
        </div>
        <div class="heroItemTooltip consumable rightHand" style="display:none">
            <div class="title">RightHand of Enlightenment</div>
            <div class="subTitle">Attack Improvement</div>
            <div class="separator"></div>
            <div class="stat">
                <div>‭+‭20‬%‬ experience</div>
            </div>
        </div>
        <div class="heroItemTooltip consumable shoes" style="display:none">
            <div class="title">Shoes of Enlightenment</div>
            <div class="subTitle">Speed Improvement</div>
            <div class="separator"></div>
            <div class="stat">
                <div>‭+‭20‬%‬ experience</div>
            </div>
        </div>
        <div class="heroItemTooltip consumable bag" style="display:none">
            <div class="title">Bag of Enlightenment</div>
            <div class="subTitle">The item is stackable.</div>
            <div class="separator"></div>
            <div class="stat">
                <div>‭+‭20‬%‬ experience</div>
            </div>
        </div>
        <div class="heroItemTooltip consumable cage" style="display:none" id="cage">
            <div class="title">Cage</div>
            <div class="subTitle">Consumable </div>
            <div class="separator"></div>
            <div class="stat">
                <div>Animals in an oasis can be tamed with them and brought to your village, where they will help in
                    defending it.</div>
                <div class="details">Equip and raid an oasis with animals to tame them. Tamed animals reinforce your
                    village as defensive troops. Taming animals happens without combat.</div>
            </div>
            <div class="stat">
                <div>The item is stackable.</div>
            </div>
            <div class="stat">
                <div>Has to be equipped before battle to take effect.</div>
            </div>
            <div class="stat">
                <div>No fight will take place but animals will be captured.</div>
            </div>
        </div>
        <div class="heroItemTooltip consumable crop" style="display:none" id="crop">
            <div class="title">Crop</div>
            <div class="subTitle">Consumable </div>
            <div class="separator"></div>
            <div class="stat">
                <div>Crop</div>
                <div class="details">Transfer crop to the granary of your currently active village.</div>
            </div>
        </div>

        <div class="heroItemTooltip consumable bandage" style="display:none" id="bandage">
            <div class="title">Bandage</div>
            <div class="subTitle">Consumable </div>
            <div class="separator"></div>
            <div class="stat">
                <div>‭‭33‬%‬ healed troop losses right after battle.</div>
                <div class="details">You can only heal the number of troops that you have bandages for. Healing time is
                    equal to the return time of these troops, but at least 12h.</div>
            </div>
            <div class="stat">
                <div>The item is stackable.</div>
            </div>
            <div class="stat">
                <div>Has to be equipped before battle to take effect.</div>
            </div>
        </div>

        <div class="heroItemTooltip consumable smallbandage" style="display:none" id="smallbandage">
            <div class="title">Small Bandage</div>
            <div class="subTitle">Consumable </div>
            <div class="separator"></div>
            <div class="stat">
                <div>‭‭25‬%‬ healed troop losses right after battle.</div>
                <div class="details">You can only heal the number of troops that you have bandages for. Healing time is
                    equal to the return time of these troops, but at least 12h.</div>
            </div>
            <div class="stat">
                <div>The item is stackable.</div>
            </div>
            <div class="stat">
                <div>Has to be equipped before battle to take effect.</div>
            </div>
        </div>

        <div class="heroItemTooltip consumable tableofLaw" style="display:none" id="tableofLaw">
            <div class="title">Tablet of Law</div>
            <div class="subTitle">Consumable </div>
            <div class="separator"></div>
            <div class="stat">
                <div>Raises the loyalty in the home town of the hero for ‭‭1‬%‬ for each tablet, to a maximum of
                    ‭‭125‬%‬.</div>
                <div class="details">Each tablet of law that is used will raise the loyalty of your hero's home village
                    by ‭‭1‬%‬ (to a maximum of ‭‭125‬%‬)</div>
            </div>
            <div class="stat">
                <div>Takes effect when equipped.</div>
            </div>
            <div class="stat">
                <div>The item is stackable.</div>
            </div>
        </div>
    </div>
    <div class="navigationSpacer"></div>
    <script>jQuery(function () { Travian.Game.TabScrollNavigation() });</script>
</div>
<div id="tab-inventory" class="tab" style="background-color: #3a3c31;
    				color: #5e463a;
					background-image: url(https://gpack.example.com/29c89d54/mainPage/img_ltr/scenes/HeroV2/heroPageBackground.jpg);background-position: center 50px;
    				background-repeat: no-repeat;">
    <div class="inventoryPageWrapper  ">

        <div class="currentHeroEquipment ">
            <div class="equipmentSlots">
                <div class="scene">

                    <div class="heroItem empty helmet" title="" data-placeid="-1" data-slot="helmet"
                        onclick="equipmentSlotsClick('helmet')">
                        <svg viewBox="0 0 62 62">
                            <path class="top" d="M31 4l2-4h-4l2 4z"></path>
                            <path class="bottom" d="M29 62h4l-2-4-2 4z"></path>
                            <path class="from" d="M0 33l4-2-4-2v4z"></path>
                            <path class="to" d="M58 31l4 2v-4l-4 2z"></path>
                        </svg>
                        <div class="item item2"></div>
                    </div>
                    <div class="heroItem empty body" data-placeid="-4" data-slot="body"
                        onclick="equipmentSlotsClick('body')">
                        <svg viewBox="0 0 62 62">
                            <path class="top" d="M31 4l2-4h-4l2 4z"></path>
                            <path class="bottom" d="M29 62h4l-2-4-2 4z"></path>
                            <path class="from" d="M0 33l4-2-4-2v4z"></path>
                            <path class="to" d="M58 31l4 2v-4l-4 2z"></path>
                        </svg>
                        <div class="item "></div>
                    </div>
                    <div class="heroItem empty shoes" data-placeid="-5" data-slot="shoes" 
                        onclick="equipmentSlotsClick('shoes')">
                        <svg viewBox="0 0 62 62">
                            <path class="top" d="M31 4l2-4h-4l2 4z"></path>
                            <path class="bottom" d="M29 62h4l-2-4-2 4z"></path>
                            <path class="from" d="M0 33l4-2-4-2v4z"></path>
                            <path class="to" d="M58 31l4 2v-4l-4 2z"></path>
                        </svg>
                        <div class="item "></div>
                    </div>
                    <div class="heroItem empty leftHand" data-placeid="-2" data-slot="leftHand"
                        onclick="equipmentSlotsClick('leftHand')">
                        <svg viewBox="0 0 62 62">
                            <path class="top" d="M31 4l2-4h-4l2 4z"></path>
                            <path class="bottom" d="M29 62h4l-2-4-2 4z"></path>
                            <path class="from" d="M0 33l4-2-4-2v4z"></path>
                            <path class="to" d="M58 31l4 2v-4l-4 2z"></path>
                        </svg>
                        <div class="item "></div>
                    </div>
                    <div class="heroItem empty rightHand" data-placeid="-3" data-slot="rightHand"
                         onclick="equipmentSlotsClick('rightHand')">
                        <svg viewBox="0 0 62 62">
                            <path class="top" d="M31 4l2-4h-4l2 4z"></path>
                            <path class="bottom" d="M29 62h4l-2-4-2 4z"></path>
                            <path class="from" d="M0 33l4-2-4-2v4z"></path>
                            <path class="to" d="M58 31l4 2v-4l-4 2z"></path>
                        </svg>
                        <div class="item "></div>
                    </div>
                    <div class="heroItem empty horse" title="" data-id="200372" data-placeid="-7"
                        data-slot="horse"  onclick="equipmentSlotsClick('horse')">
                        <svg viewBox="0 0 62 62">
                            <path class="top" d="M31 4l2-4h-4l2 4z"></path>
                            <path class="bottom" d="M29 62h4l-2-4-2 4z"></path>
                            <path class="from" d="M0 33l4-2-4-2v4z"></path>
                            <path class="to" d="M58 31l4 2v-4l-4 2z"></path>
                        </svg>
                        <div class="item item103"></div>
                    </div>
                    <div class="heroItem empty bag" title="" data-id="233985" data-placeid="-6"
                        data-slot="bag" id="cage">
                        <svg viewBox="0 0 62 62">
                            <path class="top" d="M31 4l2-4h-4l2 4z"></path>
                            <path class="bottom" d="M29 62h4l-2-4-2 4z"></path>
                            <path class="from" d="M0 33l4-2-4-2v4z"></path>
                            <path class="to" d="M58 31l4 2v-4l-4 2z"></path>
                        </svg>
                        <div class="item item114"></div>
                        <div class="count"></div>
                    </div>
                </div>
            </div>
            <!-- <div class="hero female horse item103">
        </div> -->

            <div id="bodyOptions">
                <div id="hero_body_container" style="padding:50px;margin:50px;">
                    <div id="hero_body">

                        <img src="hero_body.php?uid=<?= $vars['hero']['uid']; ?>&size=inventory&horse=<?=$vars['hero']['horse'];?>&helmet=<?=$vars['hero']['helmet']?>"
                            class="heroBodyImage heroBodyImage-<?= getDirection(); ?>" alt="<?= T("
                            HeroInventory", "Body" ); ?>"/>

                        <div class="clear"></div>
                    </div>

                </div>
            </div>
            <button class="textButtonV2 buttonFramed download rectangle withIcon green" type="button" onclick="downloadClicked()">
                <svg>
                    <svg viewBox="0 0 16 16" class="outline">
                        <path
                            d="M14 11v3H2v-3H0v3c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2v-3h-2zm-1-4-1.4-1.4L9 8.2V0H7v8.2L4.4 5.6 3 7l5 5 5-5z">
                        </path>
                    </svg>
                    <svg viewBox="0 0 16 16" class="icon">
                        <path
                            d="M14 11v3H2v-3H0v3c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2v-3h-2zm-1-4-1.4-1.4L9 8.2V0H7v8.2L4.4 5.6 3 7l5 5 5-5z">
                        </path>
                    </svg>
                </svg>
            </button>
        </div>
        <div class="inventoryWrapper">
            <div class="inventoryFilters">
                <div class="filterSlot all active" data-key="all" style="box-sizing: border-box;"
                    onclick="filterslotClick('all')"><i></i></div>
                <div class="filterSlot leftHand " data-key="leftHand" style="box-sizing: border-box;"
                    onclick="filterslotClick('leftHand')"><i></i></div>
                <div class="filterSlot rightHand " data-key="rightHand" style="box-sizing: border-box;"
                    onclick="filterslotClick('rightHand')"><i></i></div>
                <div class="filterSlot helmet " data-key="helmet" style="box-sizing: border-box;"
                    onclick="filterslotClick('helmet')"><i></i></div>
                <div class="filterSlot body " data-key="body" style="box-sizing: border-box;"
                    onclick="filterslotClick('body')"><i></i></div>
                <div class="filterSlot shoes " data-key="shoes" style="box-sizing: border-box;"
                    onclick="filterslotClick('shoes')"><i></i></div>
                <div class="filterSlot bag " data-key="bag" style="box-sizing: border-box;"
                    onclick="filterslotClick('bag')"><i></i></div>
            </div>
            <a class="tradeItems" href="hero.php?t=4">
                <svg viewBox="0 0 20 20">
                    <defs>
                        <linearGradient id="arrowColored_goldGradient" x1="26.81" y1="42.42" x2="26.81" y2="41.31"
                            gradientTransform="matrix(0 16.23 13.53 0 -556.56 -425.35)" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-color="#cba467"></stop>
                            <stop offset="0.05" stop-color="#cba467"></stop>
                            <stop offset="0.13" stop-color="#f3e2ae"></stop>
                            <stop offset="0.32" stop-color="#efbf7b"></stop>
                            <stop offset="0.48" stop-color="#aa8050"></stop>
                            <stop offset="0.72" stop-color="#835e35"></stop>
                            <stop offset="0.93" stop-color="#ad8a54"></stop>
                            <stop offset="1" stop-color="#d7b672"></stop>
                        </linearGradient>
                        <linearGradient id="arrowColored_greenGradient" x1="50.52" y1="58.77" x2="51.23" y2="59.18"
                            gradientTransform="matrix(0 8.3 7.47 0 -433.41 -413.45)" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-color="#bdff83"></stop>
                            <stop offset="0.53" stop-color="#60a124"></stop>
                            <stop offset="0.84" stop-color="#5c9722"></stop>
                            <stop offset="1" stop-color="#496818"></stop>
                        </linearGradient>
                    </defs>
                    <path class="goldBorder" d="M3 18V1.78L16.57 9.9Z" fill="url(#arrowColored_goldGradient)"
                        stroke="#000000"></path>
                    <path class="greenInner" d="M5 14.05v-8.3l7.51 4.15Z" fill="url(#arrowColored_greenGradient)"
                        stroke="#000000"></path>
                </svg>
                Trade items
            </a>
            <div class="heroItems filter_all">






                <!-- <//?//php for ($i = 0; $i <$vars['inventorySize']; ++$i): ?> -->



                <?php for ($i = 0; $i <16; ++$i): ?>
                   
                <div class="heroItem consumable <?php echo json_decode($vars['HeroItems'])[$i]->slot == null ? "empty" :  json_decode($vars['HeroItems'])[$i]->slot; ?>" title=""
                    data-id="489848" data-placeid="1" data-slot="helmet" data-tier="<?php echo json_decode($vars['HeroItems'])[$i]->id?>"
                    style="box-sizing: border-box;" onclick="heroItemClick()">
                    <div
                        class="item <?=$vars['hero']['gender'];?>_item_<?= json_decode($vars['HeroItems'])[$i]->typeId; ?>">
                    </div>
                    <!-- <div id="inventory_<//?= json_decode($vars['HeroItems'])[$i]->id; ?>" class="invenry draggable"></div> -->
                    <div class="count">
                        <?= json_decode($vars['HeroItems'])[$i]->amount; ?>
                    </div>
                </div>
                <?php endfor; ?>
                <div class="clear"></div>





            </div>
        </div>
    </div>
</div>
<div id="tab-attributes" class="tab" style="display:none;background-color: #3a3c31;
    				color: #5e463a;
					background-image: url(https://gpack.example.com/29c89d54/mainPage/img_ltr/scenes/HeroV2/heroPageBackground.jpg);background-position: center 50px;
    				background-repeat: no-repeat;">
    <div id="content1" class="heroV2Attributes1">
        <div id="heroV2" class="scene">
            <div class=" attributeBox">
                <div class="stats">
                    <div class="name">
                        <i class="attributeHealth_medium"
                            style=" background-image: url(https://gpack.example.com/29c89d54/mainPage/img_ltr/general/heroV2/attributeSpeed_medium.png);width: 23px;height: 24px;"></i><span>Health</span>
                    </div>
                    <div class="progressBar preventMobileSwipeNavigation">
                        <div class="bar">
                            <div class="decoration">

                            </div>
                            <div class="filling primary green"
                                style="width:<?= ($vars['hero']['regenerating'] ? $vars['hero']['regeneratedHealth'] : $vars['hero']['health']); ?>%;">
                            </div>
                            <div class="filling secondary green" style="transition-duration: 250ms;">
                            </div>
                        </div>
                    </div>
                    <div class="value">
                        <?= $vars['hero']['health']?> %
                    </div>
                    <div class="name">
                        <i class="attributeExperience_medium"
                            style=" background-image: url(https://gpack.example.com/29c89d54/mainPage/img_ltr/general/heroV2/attributeExperience_medium.png);width: 23px;height: 24px;"></i><span>Experience</span>
                    </div>
                    <div class="progressBar preventMobileSwipeNavigation">
                        <div class="bar">
                            <div class="decoration"></div>
                            <div class="filling primary blue"
                                style="width:<?= $vars['hero']['reachedExperience']; ?>%;"></div>
                            <div class="filling secondary blue" style="transition-duration: 250ms;"></div>
                        </div>
                    </div>
                    <div class="value">
                        <?= number_format($vars['hero']['reachedExperience'], 2, '.', '')?> %
                    </div>
                    <div class="name">
                        <i class="attributeSpeed_medium"
                            style=" background-image: url(https://gpack.example.com/29c89d54/mainPage/img_ltr/general/heroV2/attributeHealth_medium.png);width: 23px;height: 24px;"></i><span>Speed</span>
                    </div>
                    <div class="value speedValue">
                        <svg viewBox="0 0 10 7.75" class="arrowDouble"
                            style="width: 14px; height: 14px; fill: #057600;">
                            <path d="M0 0h3l3 3.88-3 3.87H0l3-3.87"></path>
                            <path d="M4 0h3l3 3.88-3 3.87H4l3-3.87"></path>
                        </svg>
                        <span><strong>
                                <?= $vars['hero']['speed']; ?>
                            </strong> fields/hour</span>
                    </div>
                </div>
            </div>
            <div class="attributeBox">
                <div class="heroProduction">
                    <div class="productionTotal">
                        <strong>Hero production</strong>
                        <div class="productionItem">
                            <span class="value">+ 6</span>
                            <i class="crop_small"></i>
                        </div>
                        <div class="productionItem">
                            <span class="value">+
                                <?= number_format_x($vars['hero']['allResourcesProduct'], 1e5); ?>
                            </span>
                            <i class="resources_small"></i>
                        </div>
                    </div>
                    <div class="changeProduction">
                        <div class="resource resources_medium">
                            <button class="textButtonV2 buttonFramed pickProductionType active rectangle withIcon green"
                                type="button" onclick="productionChange()">
                                <i class="resources_medium" style="position: relative;
                                z-index: 3;"></i>
                            </button>
                            <span class="value">
                                <?= number_format_x($vars['hero']['allResourcesProduct'], 1e5); ?>
                            </span>
                        </div>
                        <div class="resource lumber_small">
                            <button class="textButtonV2 buttonFramed pickProductionType  rectangle withIcon grey"
                                type="button" onclick="productionChange()">
                                <i class="lumber_small" style="position: relative;
                                z-index: 3;"></i>
                            </button>
                            <span class="value">
                                <?= number_format_x($vars['hero']['eachResourceProduct'], 1e5); ?>
                            </span>
                        </div>
                        <div class="resource clay_small">
                            <button class="textButtonV2 buttonFramed pickProductionType  rectangle withIcon grey"
                                type="button" onclick="productionChange()">
                                <i class="clay_small" style="position: relative;
                                z-index: 3;"></i>
                            </button>
                            <span class="value">
                                <?= number_format_x($vars['hero']['eachResourceProduct'], 1e5); ?>
                            </span>
                        </div>
                        <div class="resource iron_small">
                            <button class="textButtonV2 buttonFramed pickProductionType  rectangle withIcon grey"
                                type="button" onclick="productionChange()">
                                <i class="iron_small" style="position: relative;
                                z-index: 3;"></i>
                            </button>
                            <span class="value">
                                <?= number_format_x($vars['hero']['eachResourceProduct'], 1e5); ?>
                            </span>
                        </div>
                        <div class="resource crop_medium">
                            <button class="textButtonV2 buttonFramed pickProductionType  rectangle withIcon grey"
                                type="button" onclick="productionChange()">
                                <i class="crop_medium" style="position: relative;
                                z-index: 3;"></i>
                            </button>
                            <span class="value">
                                <?= number_format_x($vars['hero']['eachResourceProduct'], 1e5); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="attributeBox">
                <div class="heroAttributes">
                    <div class="attributes">
                        <div class="title">Attributes</div>
                        <div class="points_descr">Points available</div>
                        <div class="pointsAvailable">0</div>
                        <div class="name">
                            <i class="attributeStrength_medium"
                                style="background-image: url(https://gpack.example.com/29c89d54/mainPage/img_ltr/general/heroV2/attributeStrength_medium.png);width: 24px;height: 22px;"></i>
                            <span>Fighting strength</span>
                        </div>
                        <div class="progressBar preventMobileSwipeNavigation">
                            <div class="bar">
                                <div class="decoration"></div>
                                <div class="filling primary blue" style="width:<?= $vars['hero']['power']; ?>%;"></div>
                                <div class="filling secondary blue" style="width: 0%; transition-duration: 250ms;">
                                </div>
                            </div>
                        </div>
                        <label class="points">
                            <input type="text" inputmode="numeric" name="fightingStrength" disabled=""
                                autocomplete="off" style="width: 50%;">
                        </label>
                        <div class="value">
                            <?= $vars['hero']['power']; ?>
                        </div>
                        <div class="name">
                            <i class="attributeOffBonus_medium"
                                style="background-image: url(https://gpack.example.com/29c89d54/mainPage/img_ltr/general/heroV2/attributeOffBonus_medium.png);width: 24px;height: 22px;"></i>
                            <span>Off bonus</span>
                        </div>
                        <div class="progressBar preventMobileSwipeNavigation">
                            <div class="bar">
                                <div class="decoration"></div>
                                <div class="filling primary blue" tyle="width:<?= $vars['hero']['offBonus']; ?>%;">
                                </div>
                                <div class="filling secondary blue" style="width: 0%; transition-duration: 250ms;">
                                </div>
                            </div>
                        </div>
                        <label class="points">
                            <input type="text" inputmode="numeric" name="offBonus" disabled="" autocomplete="off"
                                style="width: 50%;">
                        </label>
                        <div class="value">
                            <?= $vars['hero']['offBonus']; ?>%
                        </div>
                        <div class="name">
                            <i class="attributeDefBonus_medium"
                                style="background-image: url(https://gpack.example.com/29c89d54/mainPage/img_ltr/general/heroV2/attributeDefBonus_medium.png);width: 24px;height: 22px;"></i>
                            <span>Def bonus</span>
                        </div>
                        <div class="progressBar preventMobileSwipeNavigation">
                            <div class="bar">
                                <div class="decoration"></div>
                                <div class="filling primary blue" style="width:<?= $vars['hero']['defBonus']; ?>%;">
                                </div>
                                <div class="filling secondary blue" style="width: 0%; transition-duration: 250ms;">
                                </div>
                            </div>
                        </div>
                        <label class="points">
                            <input type="text" inputmode="numeric" name="defBonus" disabled="" autocomplete="off"
                                style="width: 50%;">
                        </label>
                        <div class="value">
                            <?= $vars['hero']['defBonus']; ?>%
                        </div>
                        <div class="name">
                            <i class="attributeRessourceBonus_medium"
                                style="background-image: url(https://gpack.example.com/29c89d54/mainPage/img_ltr/general/heroV2/attributeRessourceBonus_medium.png);width: 24px;height: 22px;"></i>
                            <span>Resource production</span>
                        </div>
                        <div class="progressBar preventMobileSwipeNavigation">
                            <div class="bar">
                                <div class="decoration"></div>
                                <div class="filling primary blue" style="width:<?= $vars['hero']['production']; ?>%;">
                                </div>
                                <div class="filling secondary blue" style="width: 0%; transition-duration: 250ms;">
                                </div>
                            </div>
                        </div>
                        <label class="points">
                            <input type="text" inputmode="numeric" name="resourceProduction" disabled=""
                                autocomplete="off" style="width: 50%;">
                        </label>
                        <div class="value">
                            <?= $vars['hero']['production']; ?>%
                        </div>
                        <button class="textButtonV2 buttonFramed rectangle withText green" type="button" disabled=""
                            id="savePoints">
                            <div>Save changes</div>
                        </button>
                    </div>
                </div>

            </div>
            <div class="attributeBox">
                <div class="heroEquipmentBenefits">
                    <strong>Hero equipment benefits</strong>
                    <ul>
                        <li>
                            <span class="listIcon"></span>
                            <span class="benefit">‭+‭14‬‬ speed for mounted hero</span>
                        </li>
                        <li>
                            <span class="listIcon"></span>
                            <span class="benefit">‭+‭20‬%‬ experience</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="attributeBox">
                <div class="heroState">
                    <i class="statusHome_medium"
                        style="background-image: url(https://gpack.example.com/29c89d54/mainPage/img_ltr/general/heroV2/statusHome_medium.png);width: 24px;height: 22px;"></i>
                    <div>
                        <span>Hero is currently in village <a href="karte.php" data-reactroot=""><?=$vars['hero']['vname']; ?></a>.</span>
                    </div>
                </div>
                <div class="formV2 heroHideSwitch">
                    <label class="switch">
                        <input type="checkbox" name="attackBehaviour" value="hide" checked="">
                        <div class="switch" style="border-color: #99c02c;
                            background-image: linear-gradient(to bottom,#bbe34c,#99c02c);"></div>
                        <div class="label">Hero will hide during an attack on their home village.</div>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="tab-apperance" class="tab" style="display:none;background-color: #3a3c31;
    				color: #5e463a;
					background-image: url(https://gpack.example.com/29c89d54/mainPage/img_ltr/scenes/HeroV2/heroPageBackground.jpg);background-position: center 50px;
    				background-repeat: no-repeat;">
    <div id="content2" class="heroV2Appearance">
        <div id="heroV2" class="scene">

            <div class="categories">
                <div class="category jaw selected  " data-category="jaw" id="jaw" onclick="categoryClicked('jaw')">
                    <i></i>
                </div>
                <div class="category eyes   " data-category="eyes" id="eyes" onclick="categoryClicked('eyes')">
                    <i></i>
                </div>
                <div class="category brows   " data-category="brows" id="brows" onclick="categoryClicked('brows')">
                    <i></i>
                </div>
                <div class="category nose   " data-category="nose" id="nose" onclick="categoryClicked('nose')">
                    <i></i>
                </div>
                <div class="category mouth   " data-category="mouth" id="mouth" onclick="categoryClicked('mouth')">
                    <i></i>
                </div>
                <div class="category ears   " data-category="ears" id="ears" onclick="categoryClicked('ears')">
                    <i></i>
                </div>
                <div class="category hair   " data-category="hair" id="hair" onclick="categoryClicked('hairStyle')">
                    <i></i>
                </div>
                <div class="category beard enabled " data-category="beard" id="beard"
                    onclick="categoryClicked('beard')">
                    <i></i>
                </div>
                <div class="category scar   " data-category="scar" id="scar" onclick="categoryClicked('scar')">
                    <i></i>
                </div>
                <div class="category tattoo   " data-category="tattoo" id="tattoo" onclick="categoryClicked('tattoo')">
                    <i></i>
                </div>
            </div>



            <div class="selectionWrapper ">
                <div class="optionsWrapper">
                    <div class="option option0" onclick="optionClicked('option0')">
                        <div class="optionPreview female jaw">
                            <img class="heroImage"
                                src="hero_image.php?size=sideinfo&amp;uuu=<?=$vars['hero']['uid']; ?>&amp;hairColor=<?=$vars['hero']['hairColor'];?>&amp;gender=<?=$vars['hero']['gender'];?>&amp;size=<?='medium'?>&amp;beard=<?=$vars['hero']['beard']; ?>&amp;jaw=<?=0; ?>&amp;hairStyle=<?=$vars['hero']['hairStyle']; ?>&amp;nose=<?=$vars['hero']['nose']; ?>&amp;mouth=<?=$vars['hero']['mouth']; ?>&amp;eyes=<?=$vars['hero']['eyes']; ?>&amp;ears=<?=$vars['hero']['ears']; ?>&amp;brows=<?=$vars['hero']['eyebrow']; ?>&amp;"
                                title="Hero" alt="Hero" data-cmp-info="9">
                        </div>
                    </div>
                    <div class="option option1" onclick="optionClicked('option1')">
                        <div class="optionPreview female jaw">
                            <img class="heroImage"
                                src="hero_image.php?size=sideinfo&amp;uuu=<?=$vars['hero']['uid']; ?>&amp;hairColor=<?=$vars['hero']['hairColor'];?>&amp;gender=<?=$vars['hero']['gender'];?>&amp;size=<?='medium'?>&amp;beard=<?=$vars['hero']['beard']; ?>&amp;jaw=<?=1; ?>&amp;hairStyle=<?=$vars['hero']['hairStyle']; ?>&amp;nose=<?=$vars['hero']['nose']; ?>&amp;mouth=<?=$vars['hero']['mouth']; ?>&amp;eyes=<?=$vars['hero']['eyes']; ?>&amp;ears=<?=$vars['hero']['ears']; ?>&amp;brows=<?=$vars['hero']['eyebrow']; ?>&amp;"
                                title="Hero" alt="Hero" data-cmp-info="9">

                            <!-- <img class="heroImage" src="hero_image.php?size=sideinfo&amp;uuu=<?=$vars['hero']['uid']; ?>&amp;beard=<?=$heroFace['beard']; ?>&amp;eyes=<?=$heroFace['eyes']; ?>&amp;brows=<?=$heroFace['eyebrow']; ?>&amp;ears=<?=$heroFace['ears']; ?>&amp;mouth=<?=$heroFace['mouth']; ?>&amp;nose=<?=$heroFace['nose']; ?>&amp;" title="Hero" alt="Hero" data-cmp-info="9"> -->
                        </div>
                    </div>
                    <div class="option option2 selected " onclick="optionClicked('option2')">
                        <div class="optionPreview female jaw">
                            <img class="heroImage"
                                src="hero_image.php?size=sideinfo&amp;uuu=<?=$vars['hero']['uid']; ?>&amp;hairColor=<?=$vars['hero']['hairColor'];?>&amp;gender=<?=$vars['hero']['gender'];?>&amp;size=<?='medium'?>&amp;beard=<?=$vars['hero']['beard']; ?>&amp;jaw=<?=2; ?>&amp;hairStyle=<?=$vars['hero']['hairStyle']; ?>&amp;nose=<?=$vars['hero']['nose']; ?>&amp;mouth=<?=$vars['hero']['mouth']; ?>&amp;eyes=<?=$vars['hero']['eyes']; ?>&amp;ears=<?=$vars['hero']['ears']; ?>&amp;brows=<?=$vars['hero']['eyebrow']; ?>&amp;"
                                title="Hero" alt="Hero" data-cmp-info="9">

                        </div>
                        <div class="selectedIndicator"></div>
                    </div>
                    <div class="option  option3 " onclick="optionClicked('option3')">
                        <div class="optionPreview female jaw">
                            <img class="heroImage"
                                src="hero_image.php?size=sideinfo&amp;uuu=<?=$vars['hero']['uid']; ?>&amp;hairColor=<?=$vars['hero']['hairColor'];?>&amp;gender=<?=$vars['hero']['gender'];?>&amp;size=<?='medium'?>&amp;beard=<?=$vars['hero']['beard']; ?>&amp;jaw=<?=3; ?>&amp;hairStyle=<?=$vars['hero']['hairStyle']; ?>&amp;nose=<?=$vars['hero']['nose']; ?>&amp;mouth=<?=$vars['hero']['mouth']; ?>&amp;eyes=<?=$vars['hero']['eyes']; ?>&amp;ears=<?=$vars['hero']['ears']; ?>&amp;brows=<?=$vars['hero']['eyebrow']; ?>&amp;"
                                title="Hero" alt="Hero" data-cmp-info="9">

                        </div>
                    </div>
                    <div class="option option4  " onclick="optionClicked('option4')">
                        <div class="optionPreview female jaw">
                            <img class="heroImage"
                                src="hero_image.php?size=sideinfo&amp;uuu=<?=$vars['hero']['uid']; ?>&amp;hairColor=<?=$vars['hero']['hairColor'];?>&amp;gender=<?=$vars['hero']['gender'];?>&amp;size=<?='medium'?>&amp;beard=<?=$vars['hero']['beard']; ?>&amp;jaw=<?=4; ?>&amp;hairStyle=<?=$vars['hero']['hairStyle']; ?>&amp;nose=<?=$vars['hero']['nose']; ?>&amp;mouth=<?=$vars['hero']['mouth']; ?>&amp;eyes=<?=$vars['hero']['eyes']; ?>&amp;ears=<?=$vars['hero']['ears']; ?>&amp;brows=<?=$vars['hero']['eyebrow']; ?>&amp;"
                                title="Hero" alt="Hero" data-cmp-info="9">

                        </div>
                    </div>
                    <div class="option option5  " onclick="optionClicked('option5')">
                        <div class="optionPreview female jaw">
                            <img class="heroImage"
                                src="hero_image.php?size=sideinfo&amp;uuu=<?=$vars['hero']['uid']; ?>&amp;hairColor=<?=$vars['hero']['hairColor'];?>&amp;gender=<?=$vars['hero']['gender'];?>&amp;size=<?='medium'?>&amp;beard=<?=$vars['hero']['beard']; ?>&amp;jaw=<?=5; ?>&amp;hairStyle=<?=$vars['hero']['hairStyle']; ?>&amp;nose=<?=$vars['hero']['nose']; ?>&amp;mouth=<?=$vars['hero']['mouth']; ?>&amp;eyes=<?=$vars['hero']['eyes']; ?>&amp;ears=<?=$vars['hero']['ears']; ?>&amp;brows=<?=$vars['hero']['eyebrow']; ?>&amp;"
                                title="Hero" alt="Hero" data-cmp-info="9">

                        </div>
                    </div>

                </div>
                <div class="previewWrapper">
                    <div class="preview male zoomedIn ">
                        <img class="heroImage"
                            src="hero_image.php?size=sideinfo&amp;uuu=<?=$vars['hero']['uid']; ?>&amp;hairColor=<?=$vars['hero']['hairColor'];?>&amp;gender=<?=$vars['hero']['gender'];?>&amp;size=<?='large'?>&amp;beard=<?=$vars['hero']['beard']; ?>&amp;jaw=<?=2; ?>&amp;hairStyle=<?=$vars['hero']['hairStyle']; ?>&amp;nose=<?=$vars['hero']['nose']; ?>&amp;mouth=<?=$vars['hero']['mouth']; ?>&amp;eyes=<?=$vars['hero']['eyes']; ?>&amp;ears=<?=$vars['hero']['ears']; ?>&amp;brows=<?=$vars['hero']['eyebrow']; ?>&amp;"
                            title="Hero" alt="Hero" data-cmp-info="9">

                    </div>
                    <div class="actions">
                        <button class="textButtonV2 buttonFramed toggleGender male  rectangle withIcon green"
                            type="button" onclick="sexChange()">
                            <svg>
                                <svg viewBox="0 0 21 21" class="outline">
                                    <path class="female"
                                        d="M21 .8v4.4a.8.8 0 0 1-.8.8h-.4a.8.8 0 0 1-.8-.8V3.42l-4 4a5.51 5.51 0 0 1-5.71 8.5 5.37 5.37 0 0 1-1.22-.43A6.46 6.46 0 0 0 10.2 14a3.36 3.36 0 0 0 1-.05A3.5 3.5 0 0 0 9.76 7.1a3.53 3.53 0 0 0-2.1 1.35 3.38 3.38 0 0 0-.59 1.36 3.41 3.41 0 0 0 0 1.49 2.44 2.44 0 0 1-1.07.58 2.62 2.62 0 0 1-.79 0l-.06-.21A5.52 5.52 0 0 1 9.37 5.1c.23 0 .46-.08.69-.1h.44a5.51 5.51 0 0 1 3.11 1l4-4H15.8a.8.8 0 0 1-.8-.8V.8a.8.8 0 0 1 .8-.8h4.4a.8.8 0 0 1 .8.8Z">
                                    </path>
                                    <path class="male"
                                        d="M10.82 8.11a2.62 2.62 0 0 0-.79 0 2.46 2.46 0 0 0-1.13.59v.11a3.51 3.51 0 0 1-2.77 4.12 3.41 3.41 0 0 1-1.35 0 2.79 2.79 0 0 1-.39-.1A3.5 3.5 0 0 1 5.8 6a6.55 6.55 0 0 1 2.09-1.45A5.58 5.58 0 0 0 5.41 4 5.57 5.57 0 0 0 0 9.22a5.49 5.49 0 0 0 4.5 5.68V17H3.3a.8.8 0 0 0-.8.8v.4a.8.8 0 0 0 .8.8h1.2v1.2a.8.8 0 0 0 .8.8h.4a.8.8 0 0 0 .8-.8V19h1.2a.8.8 0 0 0 .8-.8v-.4a.8.8 0 0 0-.8-.8H6.5v-2.1A5.53 5.53 0 0 0 11 9.5a5.41 5.41 0 0 0-.18-1.39Z">
                                    </path>
                                </svg>
                                <svg viewBox="0 0 21 21" class="icon">
                                    <path class="female"
                                        d="M21 .8v4.4a.8.8 0 0 1-.8.8h-.4a.8.8 0 0 1-.8-.8V3.42l-4 4a5.51 5.51 0 0 1-5.71 8.5 5.37 5.37 0 0 1-1.22-.43A6.46 6.46 0 0 0 10.2 14a3.36 3.36 0 0 0 1-.05A3.5 3.5 0 0 0 9.76 7.1a3.53 3.53 0 0 0-2.1 1.35 3.38 3.38 0 0 0-.59 1.36 3.41 3.41 0 0 0 0 1.49 2.44 2.44 0 0 1-1.07.58 2.62 2.62 0 0 1-.79 0l-.06-.21A5.52 5.52 0 0 1 9.37 5.1c.23 0 .46-.08.69-.1h.44a5.51 5.51 0 0 1 3.11 1l4-4H15.8a.8.8 0 0 1-.8-.8V.8a.8.8 0 0 1 .8-.8h4.4a.8.8 0 0 1 .8.8Z">
                                    </path>
                                    <path class="male"
                                        d="M10.82 8.11a2.62 2.62 0 0 0-.79 0 2.46 2.46 0 0 0-1.13.59v.11a3.51 3.51 0 0 1-2.77 4.12 3.41 3.41 0 0 1-1.35 0 2.79 2.79 0 0 1-.39-.1A3.5 3.5 0 0 1 5.8 6a6.55 6.55 0 0 1 2.09-1.45A5.58 5.58 0 0 0 5.41 4 5.57 5.57 0 0 0 0 9.22a5.49 5.49 0 0 0 4.5 5.68V17H3.3a.8.8 0 0 0-.8.8v.4a.8.8 0 0 0 .8.8h1.2v1.2a.8.8 0 0 0 .8.8h.4a.8.8 0 0 0 .8-.8V19h1.2a.8.8 0 0 0 .8-.8v-.4a.8.8 0 0 0-.8-.8H6.5v-2.1A5.53 5.53 0 0 0 11 9.5a5.41 5.41 0 0 0-.18-1.39Z">
                                    </path>
                                </svg>
                            </svg>
                        </button>
                        <button class="textButtonV2 buttonFramed shuffleConfig  rectangle withIcon green" type="button"
                            onclick="randomClicked()">
                            <svg>
                                <svg viewBox="0 0 20 19" class="outline">
                                    <path
                                        d="M11.83 8.35A2.23 2.23 0 0 0 10.05 7l-4.6-.6a2.24 2.24 0 0 0-2 .8L.51 10.74A2.2 2.2 0 0 0 .16 13l1.59 4a2.25 2.25 0 0 0 1.79 1.39l4.59.61a2.24 2.24 0 0 0 2-.79l2.94-3.58a2.23 2.23 0 0 0 .35-2.23ZM5 8.67c.6-.28 1.22-.23 1.37.1s-.21.83-.82 1.11-1.21.23-1.36-.11S4.4 9 5 8.67Zm-3.37 5.21c-.31-.52-.3-1.1 0-1.28s.82.09 1.13.62.29 1.11 0 1.29-.82-.1-1.13-.63ZM4 17.54c-.32.18-.82-.1-1.13-.63s-.29-1.1 0-1.29.82.1 1.12.63.3 1.1 0 1.29Zm1-3.15c-.31-.53-.3-1.11 0-1.29s.82.1 1.12.63.3 1.1 0 1.28-.82-.09-1.12-.62Zm2.32 3.48c-.31.18-.82-.09-1.12-.62s-.3-1.11 0-1.29.82.09 1.13.62.29 1.11 0 1.29Zm1.75.59a.45.45 0 0 1-.58-.25l-2.1-5.3a.47.47 0 0 1-.17 0l-5.36-.7a.44.44 0 0 1-.39-.48.44.44 0 0 1 .45-.39H1l5.36.66.15.06 3.55-4.33a.44.44 0 0 1 .62-.06.43.43 0 0 1 .06.62l-3.5 4.31 2.09 5.29a.43.43 0 0 1-.24.57Zm1.29-1.91c-.36.07-.74-.41-.86-1.06s.08-1.23.44-1.3.75.42.87 1.07-.08 1.22-.44 1.29Zm.69-5.19c-.36.07-.75-.41-.86-1.06s.08-1.23.44-1.3.75.41.86 1.07-.08 1.22-.44 1.29Zm8.45-6.95L16.57.82a2.19 2.19 0 0 0-2-.8L10 .59A2.28 2.28 0 0 0 8.18 2L6.82 5.38l4 .52h.06A2.21 2.21 0 0 1 12.47 7l.3-.74a.47.47 0 0 1-.13-.11L9.22 1.93a.44.44 0 0 1 .64-.6l3.42 4.19a.55.55 0 0 1 .08.15L19 5a.44.44 0 0 1 .11.87l-5.51.7-.6 1.55 1.27 3.2a2.34 2.34 0 0 1 .15 1l2.02-.32a2.23 2.23 0 0 0 1.79-1.38l1.61-4a2.22 2.22 0 0 0-.34-2.21ZM9.3 3c.36.09.54.64.39 1.23s-.55 1-.9.92-.53-.63-.39-1.23.6-1.01.9-.92Zm3.91-.89c-.12.35-.72.45-1.34.24s-1-.67-.92-1 .72-.46 1.34-.24 1 .66.92 1Zm4.94 2.24c-.12.35-.72.46-1.34.24s-1-.66-.92-1 .72-.45 1.34-.24 1 .67.92 1Zm-2 4.8c-.42.51-1 .72-1.27.49s-.17-.84.26-1.35 1-.72 1.28-.49.16.84-.27 1.35Z">
                                    </path>
                                </svg>
                                <svg viewBox="0 0 20 19" class="icon">
                                    <path
                                        d="M11.83 8.35A2.23 2.23 0 0 0 10.05 7l-4.6-.6a2.24 2.24 0 0 0-2 .8L.51 10.74A2.2 2.2 0 0 0 .16 13l1.59 4a2.25 2.25 0 0 0 1.79 1.39l4.59.61a2.24 2.24 0 0 0 2-.79l2.94-3.58a2.23 2.23 0 0 0 .35-2.23ZM5 8.67c.6-.28 1.22-.23 1.37.1s-.21.83-.82 1.11-1.21.23-1.36-.11S4.4 9 5 8.67Zm-3.37 5.21c-.31-.52-.3-1.1 0-1.28s.82.09 1.13.62.29 1.11 0 1.29-.82-.1-1.13-.63ZM4 17.54c-.32.18-.82-.1-1.13-.63s-.29-1.1 0-1.29.82.1 1.12.63.3 1.1 0 1.29Zm1-3.15c-.31-.53-.3-1.11 0-1.29s.82.1 1.12.63.3 1.1 0 1.28-.82-.09-1.12-.62Zm2.32 3.48c-.31.18-.82-.09-1.12-.62s-.3-1.11 0-1.29.82.09 1.13.62.29 1.11 0 1.29Zm1.75.59a.45.45 0 0 1-.58-.25l-2.1-5.3a.47.47 0 0 1-.17 0l-5.36-.7a.44.44 0 0 1-.39-.48.44.44 0 0 1 .45-.39H1l5.36.66.15.06 3.55-4.33a.44.44 0 0 1 .62-.06.43.43 0 0 1 .06.62l-3.5 4.31 2.09 5.29a.43.43 0 0 1-.24.57Zm1.29-1.91c-.36.07-.74-.41-.86-1.06s.08-1.23.44-1.3.75.42.87 1.07-.08 1.22-.44 1.29Zm.69-5.19c-.36.07-.75-.41-.86-1.06s.08-1.23.44-1.3.75.41.86 1.07-.08 1.22-.44 1.29Zm8.45-6.95L16.57.82a2.19 2.19 0 0 0-2-.8L10 .59A2.28 2.28 0 0 0 8.18 2L6.82 5.38l4 .52h.06A2.21 2.21 0 0 1 12.47 7l.3-.74a.47.47 0 0 1-.13-.11L9.22 1.93a.44.44 0 0 1 .64-.6l3.42 4.19a.55.55 0 0 1 .08.15L19 5a.44.44 0 0 1 .11.87l-5.51.7-.6 1.55 1.27 3.2a2.34 2.34 0 0 1 .15 1l2.02-.32a2.23 2.23 0 0 0 1.79-1.38l1.61-4a2.22 2.22 0 0 0-.34-2.21ZM9.3 3c.36.09.54.64.39 1.23s-.55 1-.9.92-.53-.63-.39-1.23.6-1.01.9-.92Zm3.91-.89c-.12.35-.72.45-1.34.24s-1-.67-.92-1 .72-.46 1.34-.24 1 .66.92 1Zm4.94 2.24c-.12.35-.72.46-1.34.24s-1-.66-.92-1 .72-.45 1.34-.24 1 .67.92 1Zm-2 4.8c-.42.51-1 .72-1.27.49s-.17-.84.26-1.35 1-.72 1.28-.49.16.84-.27 1.35Z">
                                    </path>
                                </svg>
                            </svg>
                        </button>
                        <button
                            class="textButtonV2 buttonFramed toggleZoom {isLoading ? 'isLoading' : ''} rectangle withIcon green"
                            type="button">
                            <svg class="zoomOut">
                                <svg viewBox="0 0 21.77 22" class="outline">
                                    <path
                                        d="M19.09 2.48a8.82 8.82 0 1 0 .19 12.46 8.81 8.81 0 0 0-.19-12.46Zm-10.66 11a6.51 6.51 0 1 1 9.2-.14 6.51 6.51 0 0 1-9.2.14Zm-2.88 2.29.57.55a1.58 1.58 0 0 1 0 2.22l-2.9 3a1.55 1.55 0 0 1-2.21 0L.48 21a1.55 1.55 0 0 1 0-2.21l2.9-3a1.56 1.56 0 0 1 2.17-.02Z">
                                    </path>
                                    <path class="horizontal"
                                        d="M15.62 9.8h-5.33a.85.85 0 0 1-.85-.8v-.33a.85.85 0 0 1 .85-.85h5.33a.85.85 0 0 1 .85.85V9a.85.85 0 0 1-.85.8Z">
                                    </path>
                                    <path class="vertical"
                                        d="M14 6.15v5.32a.86.86 0 0 1-.85.86h-.29a.86.86 0 0 1-.85-.86V6.15a.85.85 0 0 1 .85-.85h.29a.85.85 0 0 1 .85.85Z">
                                    </path>
                                </svg>
                                <svg viewBox="0 0 21.77 22" class="icon">
                                    <path
                                        d="M19.09 2.48a8.82 8.82 0 1 0 .19 12.46 8.81 8.81 0 0 0-.19-12.46Zm-10.66 11a6.51 6.51 0 1 1 9.2-.14 6.51 6.51 0 0 1-9.2.14Zm-2.88 2.29.57.55a1.58 1.58 0 0 1 0 2.22l-2.9 3a1.55 1.55 0 0 1-2.21 0L.48 21a1.55 1.55 0 0 1 0-2.21l2.9-3a1.56 1.56 0 0 1 2.17-.02Z">
                                    </path>
                                    <path class="horizontal"
                                        d="M15.62 9.8h-5.33a.85.85 0 0 1-.85-.8v-.33a.85.85 0 0 1 .85-.85h5.33a.85.85 0 0 1 .85.85V9a.85.85 0 0 1-.85.8Z">
                                    </path>
                                    <path class="vertical"
                                        d="M14 6.15v5.32a.86.86 0 0 1-.85.86h-.29a.86.86 0 0 1-.85-.86V6.15a.85.85 0 0 1 .85-.85h.29a.85.85 0 0 1 .85.85Z">
                                    </path>
                                </svg>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="colorsWrapper">
                    <div class="colorPalette">Skin color</div>
                    <div class="colors skinColor">
                        <div class="color skin1  " data-color="skin1" onclick="colorChanged(0)">
                            <div class="colorPreview skin1"></div>
                        </div>
                        <div class="color skin2  " data-color="skin2" onclick="colorChanged(1)">
                            <div class="colorPreview skin2"></div>
                        </div>
                        <div class="color skin3 selected " data-color="skin3" onclick="colorChanged(2)">
                            <div class="colorPreview skin3"></div>
                            <div class="selectedIndicator"></div>
                        </div>
                        <div class="color skin4  " data-color="skin4" onclick="colorChanged(3)">
                            <div class="colorPreview skin4"></div>
                        </div>
                    </div>
                </div>
                <div class="buttonWrapper" style="    grid-column-start: 1;grid-column-end: 5;justify-self: end;">
                    <button class="textButtonV2 buttonFramed buyOptions  disabled rectangle withText gold" type="button"
                        style="display:none">
                        <div>No buy option selected</div>
                    </button>
                    <button class="textButtonV2 buttonFramed resetChanges  rectangle withIcon green" type="button"
                        onclick="resetClicked()">
                        <svg>
                            <svg viewBox="0 0 16.02 16" class="outline">
                                <path
                                    d="M2.35 2.35A8 8 0 1 1 .27 10h2.08A6 6 0 1 0 8 2a5.93 5.93 0 0 0-4.22 1.78L7 7H0V0Z"
                                    data-name="Path 78"></path>
                            </svg>
                            <svg viewBox="0 0 16.02 16" class="icon">
                                <path
                                    d="M2.35 2.35A8 8 0 1 1 .27 10h2.08A6 6 0 1 0 8 2a5.93 5.93 0 0 0-4.22 1.78L7 7H0V0Z"
                                    data-name="Path 78"></path>
                            </svg>
                        </svg>
                    </button>
                    <button class="textButtonV2 buttonFramed saveChanges  rectangle withText green" type="button"
                        onclick="saveClicked()">
                        <div>Save changes</div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>




<!--<a id="tabFavorButton" class="contentTitleButton" style="margin-right: 62%; z-index: 99; margin-top: 25px;"-->
<!--   onclick="-->
<!--           Travian.ajax(-->
<!--           {-->
<!--           data:-->
<!--           {-->
<!--           cmd: 'tabFavorite',-->
<!--           name: 'hero',-->
<!--           number: '-->
<?//=$vars['selectedTab'];?>



<div class="clear"></div>

<script type="text/javascript">

    window.onload = function () {
        var arr =<?php echo $vars['HeroEquipments'];?>;
      
        
        console.log(arr);
        
         for(let i=0;i<arr.length;i++)
         {
          
            var equipmentName = $(".equipmentSlots .scene").children().siblings('.' + arr[i]['slot'])[0];
            equipmentName.className=equipmentName.className.replace("empty","consumable");
           
            equipmentName.children[1].className="item "+'<?php echo $vars['hero']['gender']?>'+"_item_"+arr[i]['typeId'];
         }
      

        doload();
    };
    function doload() {

        var sexbutton = document.getElementsByClassName("actions")[0];
        var categories = document.getElementsByClassName("categories")[0];
        var gender = '<?php echo $vars['hero']['gender']?>';
        if (gender == "female") {

            sexbutton.children[0].className = sexbutton.children[0].className.replace("male", "female");

            categories.children[7].className = categories.children[7].className.replace("enabled", "disabled");
        }
        if (<?php echo $vars['hero']['helmet'] ?>==0)
        {
            var heroItems = document.getElementsByClassName("heroItems")[0];
            // heroItems.children[0].className=heroItems.children[0].className.replace(heroItems.children[0].className.split(" ")[1],"");
            // heroItems.children[0].className=heroItems.children[0].className.replace(heroItems.children[0].className.split(" ")[2],"empty");
            heroItems.children[0].children[1].className = heroItems.children[0].children[1].className.replace(heroItems.children[0].children[1].className.split(" ")[1], " ");
        }
        if (<?php echo $vars['hero']['horse'] ?>==0)
        {
            var heroIt = document.querySelector('.equipmentSlots .scene').children[5];
            heroIt.className = heroIt.className.replace(heroIt.className.split(" ")[1], "empty");
        }
    }
    $(function () {
        $(".scrollingContainer").on("click", ".content", function () {
            var that = $(this);
            var tabid = that.data("tab");

            $(".tab").each(function (k, v) {
                $(this).hide();

            });

            $(tabid).show();

            for (let i = 0; i < document.getElementById("firstTab").children.length; i++) {
                try {
                    document.getElementById("firstTab").children[i].children[0].className = document.getElementById("firstTab").children[i].children[0].className.replace(" active", "");
                 
                } catch (error) {

                }

                //console.log(tabid.split("#tab-")[1]);
            }
            try {
                document.getElementById(tabid.split("#tab-")[1] + '1').className += " active";
            } catch (error) {

            }

        });
    });


    function sexChange() {

        var optionWrapper = document.getElementsByClassName("optionsWrapper")[0];
        var previewWrapper = document.getElementsByClassName("previewWrapper")[0];
        var sexbutton = document.getElementsByClassName("actions")[0];
        var categories = document.getElementsByClassName("categories")[0];
        if (sexbutton.children[0].className.includes("female")) {
            sexbutton.children[0].className = sexbutton.children[0].className.replace("female", "male");
            for (let i = 0; i < optionWrapper.children.length; i++) {
                optionWrapper.children[i].children[0].children[0].src = optionWrapper.children[i].children[0].children[0].src.replace("female", "male");

            }
            previewWrapper.children[0].children[0].src = previewWrapper.children[0].children[0].src.replace("female", "male");
            categories.children[7].className = categories.children[7].className.replace("disabled", "enabled");
        }
        else {

            sexbutton.children[0].className = sexbutton.children[0].className.replace("male", "female");
            for (let i = 0; i < optionWrapper.children.length; i++) {
                optionWrapper.children[i].children[0].children[0].src = optionWrapper.children[i].children[0].children[0].src.replace("male", "female");
                if (optionWrapper.children[i].children[0].children[0].src.includes("fefe")) {
                    optionWrapper.children[i].children[0].children[0].src = optionWrapper.children[i].children[0].children[0].src.replace("fefe", "fe");
                }

            }

            previewWrapper.children[0].children[0].src = previewWrapper.children[0].children[0].src.replace("male", "female");
            if (previewWrapper.children[0].children[0].src.includes("fefe")) {
                previewWrapper.children[0].children[0].src = previewWrapper.children[0].children[0].src.replace("fefe", "fe");
            }
            categories.children[7].className = categories.children[7].className.replace("enabled", "disabled");
        }
    }
    function productionChange() {
        var productionTotal = document.getElementsByClassName("productionTotal")[0];

        var targetParent = event.target.parentNode;

        if (targetParent.children[1] == null) {
            targetParent = event.target.parentNode.parentNode;

        }

        productionTotal.children[2].children[0].textContent = "+" + targetParent.children[1].textContent;
        productionTotal.children[2].children[1].className = targetParent.children[0].children[0].className;
        var heroIt1 = $($(".changeProduction").children()).siblings('.resource');
        var hasItemDiv = $(heroIt1).children();
        var resultParent;
        for (let i = 0; i < hasItemDiv.length; i++) {
            if ($(hasItemDiv[i]).hasClass('green')) {
                resultParent = $(hasItemDiv[i]).parent();
            }
        }
        $(resultParent).children()[0].className = $(resultParent).children()[0].className.replace("green", "grey");
        targetParent.children[0].className = targetParent.children[0].className.replace("grey", "green");
    }



    function filterslotClick(item) {
        //alert(item);
        var inventoryFilters = document.getElementsByClassName("inventoryFilters")[0];
        var heroItems = document.getElementsByClassName("heroItems")[0];
        for (let i = 0; i < inventoryFilters.children.length; i++) {
            try {
                inventoryFilters.children[i].className = inventoryFilters.children[i].className.replace(" active", "");

            } catch (error) {

            }
            try {
                inventoryFilters.children[i].className = inventoryFilters.children[i].className.replace(item, item + " active");


                heroItems.className = "heroItems filter_" + item;
            } catch (error) {

            }
        }


    }

    function colorChanged(item) {
        var colors = document.getElementsByClassName("colors")[0];
        for (let i = 0; i < colors.children.length; i++) {
            try {
                colors.children[i].className = colors.children[i].className.replace(" selected", "");
                colors.children[i].children[1].remove();

            } catch (error) {

            }


        }
        event.target.className = event.target.className.replace(item, item + " selected");
        var div = document.createElement("div");
        div.className = "selectedIndicator";

        event.target.appendChild(div);
        var optionWrapper = document.getElementsByClassName("optionsWrapper")[0];
        for (let i = 0; i < optionWrapper.children.length; i++) {

            myArray = optionWrapper.children[i].children[0].children[0].src.split("&");
            for (let j = 0; j < myArray.length; j++) {
                if (myArray[j].includes('hairColor')) {
                    // console.log(item);
                    optionWrapper.children[i].children[0].children[0].src = optionWrapper.children[i].children[0].children[0].src.replace((optionWrapper.children[i].children[0].children[0].src.split("&")[j]).split('=')[1], item);
                }
            }

            // console.log(optionWrapper.children[i].children[0].children[0].src  );


        }
        var previewWrapper = document.getElementsByClassName("previewWrapper")[0];

        myArray = previewWrapper.children[0].children[0].src.split("&");
        for (let j = 0; j < myArray.length; j++) {
            if (myArray[j].includes('hairColor')) {
                previewWrapper.children[0].children[0].src = previewWrapper.children[0].children[0].src.replace((previewWrapper.children[0].children[0].src.split("&")[j]).split('=')[1], item);
            }
        }



    }
    function randomClicked() {
        var imageSrc = document.getElementsByClassName("optionsWrapper")[0].children[0].children[0].children[0].src;
        var myArray = imageSrc.split("&");
        for (let i = 0; i < myArray.length; i++) {
            if (myArray[i].includes("beard")) {
                imageSrc = imageSrc.replace(myArray[i], "beard=" + Math.floor(Math.random() * 5));

            }
            if (myArray[i].includes("jaw")) {
                imageSrc = imageSrc.replace(myArray[i], "jaw=" + Math.floor(Math.random() * 5));

            }
            if (myArray[i].includes("hairStyle")) {
                imageSrc = imageSrc.replace(myArray[i], "hairStyle=" + Math.floor(Math.random() * 5));

            }
            if (myArray[i].includes("nose")) {
                imageSrc = imageSrc.replace(myArray[i], "nose=" + Math.floor(Math.random() * 5));

            }
            if (myArray[i].includes("mouth")) {
                imageSrc = imageSrc.replace(myArray[i], "mouth=" + Math.floor(Math.random() * 5));

            }
            if (myArray[i].includes("eyes")) {
                imageSrc = imageSrc.replace(myArray[i], "eyes=" + Math.floor(Math.random() * 5));

            }
            if (myArray[i].includes("ears")) {
                imageSrc = imageSrc.replace(myArray[i], "ears=" + Math.floor(Math.random() * 5));

            }
            if (myArray[i].includes("brows")) {
                imageSrc = imageSrc.replace(myArray[i], "brows=" + Math.floor(Math.random() * 5));

            }
            if (myArray[i].includes("hairColor")) {

                var t = Math.floor(Math.random() * 3);

                switch (t) {
                    case 0:
                        imageSrc = imageSrc.replace(myArray[i], "hairColor=" + 0);
                        break;
                    case 1:
                        imageSrc = imageSrc.replace(myArray[i], "hairColor=" + 1);
                        break;
                    case 2:
                        imageSrc = imageSrc.replace(myArray[i], "hairColor=" + 2);
                        break;
                    case 3:
                        imageSrc = imageSrc.replace(myArray[i], "hairColor=" + 3);
                        break;

                }
            }
        }
        var optionWrapper = document.getElementsByClassName("optionsWrapper")[0];
        var hasItemDiv = $(".categories").children();
        var resultParent;
        var arrayIndex;
        for (let i = 0; i < hasItemDiv.length; i++) {
            if ($(hasItemDiv[i]).hasClass("selected")) {
                resultParent = $(hasItemDiv[i]);

            }
        }
        var getId = $(resultParent).get(0).id;
        for (let i = 0; i < optionWrapper.children.length; i++) {
            const myArray1 = optionWrapper.children[i].children[0].children[0].src.split("&");

            for (let j = 0; j < myArray1.length; j++) {
                if (myArray1[j].includes(getId)) {

                    myArray1[j] = getId + "=" + i;

                    optionWrapper.children[i].children[0].children[0].src = imageSrc.replace(imageSrc.split("&")[j], myArray1[j]);


                }
            }


        }
        var hasItemDiv = $(".optionsWrapper").children();
        var resultParent;
        var arrayIndex;
        for (let i = 0; i < hasItemDiv.length; i++) {
            if ($(hasItemDiv[i]).hasClass("selected")) {
                arrayIndex = i;

            }
        }
        var previewWrapper = document.getElementsByClassName("previewWrapper")[0];
        var srcExchange = optionWrapper.children[arrayIndex].children[0].children[0].src;
        srcExchange = srcExchange.replace("medium", "large");
        previewWrapper.children[0].children[0].src = srcExchange;

    }


    function optionClicked(item) {
        var optionWrapper = document.getElementsByClassName("optionsWrapper")[0];
        for (let i = 0; i < optionWrapper.children.length; i++) {
            try {
                optionWrapper.children[i].className = optionWrapper.children[i].className.replace(" selected", "");
                optionWrapper.children[i].children[1].remove();

            } catch (error) {

            }


        }
        event.target.className = event.target.className.replace(item, item + " selected");
        var div = document.createElement("div");
        div.className = "selectedIndicator";

        event.target.appendChild(div);
        var hasItemDiv = $(".categories").children();
        var resultParent;
        for (let i = 0; i < hasItemDiv.length; i++) {
            if ($(hasItemDiv[i]).hasClass("selected")) {
                resultParent = $(hasItemDiv[i]);
            }
        }
        var previewWrapper = document.getElementsByClassName("previewWrapper")[0];
        var srcExchange = event.target.children[0].children[0].src;
        srcExchange = srcExchange.replace("medium", "large");
        previewWrapper.children[0].children[0].src = srcExchange;




    }

    function categoryClicked(item) {
        var categories = document.getElementsByClassName("categories")[0];

        for (let i = 0; i < categories.children.length; i++) {
            categories.children[i].className = categories.children[i].className.replace(" selected", "");


        }
        event.target.className = event.target.className.replace(item, item + " selected");
        var optionWrapper = document.getElementsByClassName("optionsWrapper")[0];
        var resultParent;
        var arrayIndex;
        var hasItemDiv = $(optionWrapper).children();
        for (let i = 0; i < hasItemDiv.length; i++) {
            if ($(hasItemDiv[i]).hasClass("selected")) {
                resultParent = $($(hasItemDiv[i]).children()[0]).children()[0].src;
                arrayIndex = i;
            }
        }

        for (let i = 0; i < optionWrapper.children.length; i++) {

            if (resultParent.includes(item)) {
                const myArray = resultParent.split("&");

                for (let j = 0; j < myArray.length; j++) {
                    if (myArray[j].includes(item)) {

                        myArray[j] = item + "=" + i;

                        optionWrapper.children[i].children[0].children[0].src = resultParent.replace(resultParent.split("&")[j], myArray[j]);


                    }
                }
            }
            else {
                optionWrapper.children[i].children[0].children[0].src = optionWrapper.children[i].children[0].children[0].src + item + "=" + i + "&";
            }





        }
        var previewWrapper = document.getElementsByClassName("previewWrapper")[0];

        var srcExchange = optionWrapper.children[arrayIndex].children[0].children[0].src;

        srcExchange = srcExchange.replace("medium", "large");
        previewWrapper.children[0].children[0].src = srcExchange;
        //alert(event.target.children[0].children[0].src);




    }
    function equipmentSlotsClick(item) {
        var imageSrc = document.getElementById("hero_body").children[0].src;
        var myArray = imageSrc.split("&");
        eventClassName=event.target.className;
        if (!event.target.className.includes("empty")) {
            var herotooltip=document.getElementsByClassName("heroItemTooltip "+event.target.className.split(" ")[2])[0];
            herotooltip.style.display="none";
            var heroItemName = event.target.className.split("heroItem ")[1].split(" ")[1];
        
            var ItemName = event.target.children[1].className;
       
            event.target.className = event.target.className.replace(event.target.className.split(" ")[1], "empty");
            var heroIt = $($(".heroItems").children()).siblings('.empty')[0];
            heroIt.className = heroIt.className.replace("empty", heroItemName);
            console.log(heroIt.children[0].className);
            heroIt.children[0].className = ItemName;
            if (eventClassName.split(" ")[2] == "horse") {
                $.post("hero.php", {
                    'helmet':<?php echo $vars['hero']['helmet'];?>,
                    'body':<?php echo $vars['hero']['body'];?>,
                    'leftHand':<?php echo $vars['hero']['leftHand'];?>,
                    'rightHand':<?php echo $vars['hero']['rightHand'];?>,
                    'shoes':<?php echo $vars['hero']['shoes'];?>,
                    'horse':2
                }, function (res) {
                    location.reload();
                });
            }
            else if (eventClassName.split(" ")[2] == "helmet") {
                $.post("hero.php", {
                    'helmet': 0,
                    'body':<?php echo $vars['hero']['body'];?>,
                    'leftHand':<?php echo $vars['hero']['leftHand'];?>,
                    'rightHand':<?php echo $vars['hero']['rightHand'];?>,
                    'shoes':<?php echo $vars['hero']['shoes'];?>,
                    'horse':<?php echo $vars['hero']['horse'];?>
                }, function (res) {
                    location.reload();
                });
            }
               
            else if(eventClassName.split(" ")[2]=="body")
            {
                $.post("hero.php", {
                    'helmet':<?php echo $vars['hero']['helmet'];?>,
                    'body':0,
                    'leftHand':<?php echo $vars['hero']['leftHand'];?>,
                    'rightHand':<?php echo $vars['hero']['rightHand'];?>,
                    'shoes':<?php echo $vars['hero']['shoes'];?>,
                    'horse':<?php echo $vars['hero']['horse'];?>
                }, function (res) {
                    location.reload();
                });
            }
            else if(eventClassName.split(" ")[2]=="shoes")
            { $.post("hero.php", {
                    'helmet':<?php echo $vars['hero']['helmet'];?>,
                    'body':<?php echo $vars['hero']['body'];?>,
                    'leftHand':<?php echo $vars['hero']['leftHand'];?>,
                    'rightHand':<?php echo $vars['hero']['rightHand'];?>,
                    'shoes':0,
                    'horse':<?php echo $vars['hero']['horse'];?>
                }, function (res) {
                    location.reload();
                });

            }
            else if(eventClassName.split(" ")[2]=="leftHand")
            {
                $.post("hero.php", {
                    'helmet':<?php echo $vars['hero']['helmet'];?>,
                    'body':<?php echo $vars['hero']['body'];?>,
                    'leftHand':0,
                    'rightHand':<?php echo $vars['hero']['rightHand'];?>,
                    'shoes':<?php echo $vars['hero']['shoes'];?>,
                    'horse':<?php echo $vars['hero']['horse'];?>
                }, function (res) {
                     location.reload();
                });
            }
            else if(eventClassName.split(" ")[2]=="rightHand")
            {
                $.post("hero.php", {
                    'helmet':<?php echo $vars['hero']['helmet'];?>,
                    'body':<?php echo $vars['hero']['body'];?>,
                    'leftHand':<?php echo $vars['hero']['leftHand'];?>,
                    'rightHand':0,
                    'shoes':<?php echo $vars['hero']['shoes'];?>,
                    'horse':<?php echo $vars['hero']['horse'];?>
                }, function (res) {
                     location.reload();
                });
            }
            else{
                $.post("hero.php", {
                    'bag': 0
                }, function (res) {
                    location.reload();
                });
            }
           



            //$(heroIt).siblings('.empty')[0].className=$(heroIt).siblings('.empty')[0].className.replace("empty",heroItemName);
            //$($(heroIt).siblings('.empty')[0]).children()[1].className+=ItemName;


            //   console.log($(heroIt[0]).data('placeid'));
        }

        //alert(event.target.className);
    }
    function heroItemClick() {
      
        if (event.target.className.split(" ")[2]!="empty") {
            eventClassName=event.target.className;
            var sendId=$(event.target).attr("data-tier");
            var imageSrc = document.getElementById("hero_body").children[0].src;
            var myArray = imageSrc.split("&");
            var heroItemName = event.target.className.split(" ")[1];
            var itemId=event.target.children[0].className.split(" ")[1].split("item_")[1];
            var equipmentName = $(".equipmentSlots .scene").children().siblings('.' + event.target.className.split(" ")[2])[0];
            var herotooltip=document.getElementsByClassName("heroItemTooltip "+event.target.className.split(" ")[2])[0];
            herotooltip.style.display="none";
            // if (event.target.className.split(" ")[2] == "helmet") {

                // $.post("hero.php", {
                //     'helmet':<//?php echo $vars['hero']['uid'] ?>
                //     }, function (res) {
                //     // location.reload();
                // });

                // for (let i = 0; i < myArray.length; i++) {
                //     if (myArray[i].includes("helmet")) {
                //         document.getElementById("hero_body").children[0].src = imageSrc.replace(myArray[i], "helmet=" +itemId);

                //     }
                // }

                // document.getElementsByClassName("hero female")[0].children[0].src="https://gpack.example.com/29c89d54/mainPage/img_ltr/scenes/HeroV2/image/body/2.png";
                
                if(equipmentName.className.includes("empty"))
                {
                    equipmentName.className = equipmentName.className.replace("empty", heroItemName);
                 
                    equipmentName.children[1].className=event.target.children[0].className;
                    event.target.className = "heroItem consumable empty";
                    event.target.children[0].className = "item ";
                    event.target.children[1].className = "item ";
                    var itemCount=$(equipmentName).children()[2];
                   
                  
                   $(itemCount).text( event.target.children[1].textContent);
                }
                else
                {
                    var equipChildren=equipmentName.children[1].className;
                    equipmentName.children[1].className=event.target.children[0].className;
                  
                    event.target.children[0].className = equipChildren;
                    event.target.children[1].className = "count";
                    var itemCount=$(equipmentName).children()[2];
                   
                  
                   $(itemCount).text( event.target.children[1].textContent);
                }
               
                if (eventClassName.split(" ")[2] == "horse") {
                $.post("hero.php", {
                    'helmet':<?php echo $vars['hero']['helmet'];?>,
                    'body':<?php echo $vars['hero']['body'];?>,
                    'leftHand':<?php echo $vars['hero']['leftHand'];?>,
                    'rightHand':<?php echo $vars['hero']['rightHand'];?>,
                    'shoes':<?php echo $vars['hero']['shoes'];?>,
                    'horse':sendId
                }, function (res) {
                    location.reload();
                });
            }
            else if (eventClassName.split(" ")[2] == "helmet") {
                $.post("hero.php", {
                    'helmet': sendId,
                    'body':<?php echo $vars['hero']['body'];?>,
                    'leftHand':<?php echo $vars['hero']['leftHand'];?>,
                    'rightHand':<?php echo $vars['hero']['rightHand'];?>,
                    'shoes':<?php echo $vars['hero']['shoes'];?>,
                    'horse':<?php echo $vars['hero']['horse'];?>
                }, function (res) {
                    location.reload();
                });
            }
               
            else if(eventClassName.split(" ")[2]=="body")
            {
                $.post("hero.php", {
                    'helmet': <?php echo $vars['hero']['helmet'];?>,
                    'body':sendId,
                    'leftHand':<?php echo $vars['hero']['leftHand'];?>,
                    'rightHand':<?php echo $vars['hero']['rightHand'];?>,
                    'shoes':<?php echo $vars['hero']['shoes'];?>,
                    'horse':<?php echo $vars['hero']['horse'];?>
                }, function (res) {
                    location.reload();
                });
            }
            else if(eventClassName.split(" ")[2]=="shoes")
            { $.post("hero.php", {
                'helmet': <?php echo $vars['hero']['helmet'];?>,
                    'body':<?php echo $vars['hero']['body'];?>,
                    'leftHand':<?php echo $vars['hero']['leftHand'];?>,
                    'rightHand':<?php echo $vars['hero']['rightHand'];?>,
                    'shoes':sendId,
                    'horse':<?php echo $vars['hero']['horse'];?>
                }, function (res) {
                    location.reload();
                });

            }
            else if(eventClassName.split(" ")[2]=="leftHand")
            {
                $.post("hero.php", {
                    'helmet': <?php echo $vars['hero']['helmet'];?>,
                    'body':<?php echo $vars['hero']['body'];?>,
                    'leftHand':sendId,
                    'rightHand':<?php echo $vars['hero']['rightHand'];?>,
                    'shoes':<?php echo $vars['hero']['shoes'];?>,
                    'horse':<?php echo $vars['hero']['horse'];?>
                }, function (res) {
                     location.reload();
                });
            }
            else if(eventClassName.split(" ")[2]=="rightHand")
            {
                $.post("hero.php", {
                    'helmet': <?php echo $vars['hero']['helmet'];?>,
                    'body':<?php echo $vars['hero']['body'];?>,
                    'leftHand':<?php echo $vars['hero']['leftHand'];?>,
                    'rightHand':sendId,
                    'shoes':<?php echo $vars['hero']['shoes'];?>,
                    'horse':<?php echo $vars['hero']['horse'];?>
                }, function (res) {
                     location.reload();
                });
            }
            else{

                
                $.post("hero.php", {
                    'bag': 0
                }, function (res) {
                  //  location.reload();
                });
            }

          
        
           
        }
    }


    var equipmentName = document.getElementsByClassName("equipmentSlots")[0].getElementsByClassName("scene")[0];
    var heroItems = document.getElementsByClassName("heroItems filter_all")[0];

    heroItems.addEventListener("mouseover", (event) => {
        

        if (event.target.className.split(" ")[2] != "empty" && event.target.className.split(" ")[1] != "filter_all") {
               
                if(event.target.className.split(" ")[1]=="consumable")
                {
                    // var herotooltip=$(".ToolTips").children().siblings("#"+event.target.id)[0];
                    var herotooltip=document.getElementsByClassName("heroItemTooltip consumable "+event.target.className.split(" ")[2])[0];
                }
                else{
                    var herotooltip=document.getElementsByClassName("heroItemTooltip "+event.target.className.split(" ")[1])[0];

                }


                 herotooltip.style.position='absolute';
                 let topOffset = event.target.offsetTop + $(herotooltip).height()/2+500;
                let leftOffset = event.target.offsetLeft/2 + $(herotooltip).width()/2;
                $(herotooltip).css('top', `${topOffset}px`);
                $(herotooltip).css('left', `${leftOffset}px`);
                $(herotooltip).css('z-index',`30000`);
                  herotooltip.style.display='block';
              console.log($(herotooltip), herotooltip.clientLeft, herotooltip.clientTop, event.target.offsetTop);


        }
        setTimeout(() => {
            // event.target.style.color = "";
        }, 500);

    }, false);

    heroItems.addEventListener("mouseout", (event) => {
              if(event.target.className.split(" ")[2]!="empty"&&event.target.className.split(" ")[1]!="filter_all")
            {
                if(event.target.className.split(" ")[1]=="consumable")
            {
                // var herotooltip=$(".ToolTips").children().siblings("#"+event.target.id)[0];
                var herotooltip=document.getElementsByClassName("heroItemTooltip "+event.target.className.split(" ")[2])[0];
            }
            else{
                var herotooltip=document.getElementsByClassName("heroItemTooltip "+event.target.className.split(" ")[1])[0];

            }
              herotooltip.style.display='none';

            setTimeout(() => {
              event.target.style.color = "";
            }, 500);
          }
    }, false);

    // heroItems.addEventListener("mousedown", (event) => {
    //     if (event.target.className.split(" ")[2] != "empty" && event.target.className.split(" ")[1] != "filter_all") {
    //         if (event.target.className.split(" ")[1] == "consumable") {
    //             // var herotooltip = $(".ToolTips").children().siblings("#" + event.target.id)[0];
    //             var herotooltip=document.getElementsByClassName("heroItemTooltip "+event.target.className.split(" ")[2])[0];
    //             // if (event.target.className.split(" ")[2] == "inventory") {
    //             //     var eventId = event.target.id;
    //             //     var toolModal = document.getElementById("toolModal_" + event.target.id).style.display = "block";
    //             //     var btnClose = document.getElementById("btnClose_" + eventId);
    //             //     var toolModals = document.getElementById("toolModal_" + eventId);
    //             //     var btnMove = document.getElementById("btnMove_" + eventId);
    //             //     btnClose.onclick = function () {
    //             //         toolModals.style.display = "none";
    //             //     }
    //             //     btnMove.onclick = function () {
    //             //         var input_value = parseInt(document.getElementById('input_' + eventId).value);
    //             //         var state_value = parseInt(document.querySelector('.heroItems .count').textContent);
    //             //         var itemCount = $("#" + eventId + " .count");
    //             //         $(itemCount).text(state_value - input_value);
    //             //         toolModals.style.display = "none";
    //             //     }
    //             // }
    //             // else if (event.target.className.split(" ")[2] == "bag") {
    //             //     var eventId = event.target.id;
    //             //     var toolModal = document.getElementById("toolModal_" + event.target.id).style.display = "block";
    //             //     var btnClose = document.getElementById("btnClose_" + eventId);
    //             //     var toolModals = document.getElementById("toolModal_" + eventId);
    //             //     var btnMove = document.getElementById("btnMove_" + eventId);
    //             //     btnClose.onclick = function () {
    //             //         toolModals.style.display = "none";
    //             //     }
    //             //     btnMove.onclick = function () {


    //             //         var input_value = parseInt(document.getElementById('input_' + eventId).value);
    //             //         var state_value = parseInt(document.querySelector('.heroItems .count').textContent);

    //             //         if (state_value > input_value) {

    //             //             var heroItemName = event.target.className.split("heroItem ")[1];
    //             //             var ItemName = event.target.children[1].className.split("item ")[1];
    //             //             var heroIt = document.querySelector('.equipmentSlots .scene').children[6];

    //             //             var heroIt1 = document.querySelector('.equipmentSlots .scene').children[6];

    //             //             var hasItemDiv = $(heroIt1).children();
    //             //             var equipmentId = heroIt.id;
    //             //             var equipmentClass = heroIt.children[1].className;
    //             //             var equipmentCount = heroIt.children[2].textContent;
    //             //             // var hasItemDiv = $(heroIt1).children();
    //             //             var resultParent;
    //             //             for (let i = 0; i < hasItemDiv.length; i++) {
    //             //                 if ($(hasItemDiv[i]).hasClass(ItemName)) {
    //             //                     resultParent = $(hasItemDiv[i]).parent();
    //             //                 }
    //             //             }
    //             //             var itemCount = $("#" + eventId + ".count");
    //             //             if (state_value - input_value == 0) {
    //             //                 $(itemCount).text('');

    //             //             }
    //             //             else {
    //             //                 $(itemCount).text(state_value - input_value);
    //             //             }
    //             //             //console.log("state_value"+state_value+"input_value"+input_value);
    //             //             if (resultParent == null) {

    //             //                 if (event.target.className.split(" ")[1] != "empty") {
    //             //                     // heroIt1.className=heroIt1.className.replace(heroIt1.className.split(" ")[1],heroItemName);
    //             //                     if (heroIt1.id != event.target.id) {
    //             //                         heroIt1.id = event.target.id;
    //             //                         heroIt1.children[1].className = "item " + ItemName;
    //             //                         heroIt1.children[2].innerHTML = input_value;
    //             //                         event.target.id = equipmentId;
    //             //                         event.target.children[1].className = equipmentClass;
    //             //                         event.target.children[2].textContent = equipmentCount;
    //             //                         //var div = document.createElement("div");
    //             //                         //div.className="count";
    //             //                         //div.innerHTML += input_value;
    //             //                         //heroIt.appendChild(div);
    //             //                     }
    //             //                     else {

    //             //                     }
    //             //                 }
    //             //                 else {
    //             //                     heroIt1.id = event.target.id;
    //             //                     heroIt1.children[1].className = ItemName;
    //             //                     heroIt1.children[2].innerHTML = input_value;
    //             //                 }
    //             //             }
    //             //             else {
    //             //                 var parentCount = $(resultParent).children()[2];
    //             //                 $(parentCount).text(parseInt(parentCount.textContent) + input_value);
    //             //             }
    //             //             //$(heroIt1).children().find('div.'+ItemName);


    //             //             //console.log(itemCount);
    //             //             //itemCount[0].innerText="";
    //             //             // itemCount[0].innerHtml="";
    //             //             // $(itemCount[0]).html("");*
    //             //             // console.log(itemCount);

    //             //         }
    //             //         else if (state_value == input_value) {

    //             //             var heroItemName = event.target.className.split("heroItem ")[1];
    //             //             var ItemName = event.target.children[1].className.split("item ")[1];

    //             //             //event.target.className=event.target.className.replace(event.target.className.split(" ")[1],"empty");
    //             //             var heroIt = document.querySelector('.equipmentSlots .consumable');
    //             //             var heroIt1 = document.querySelector('.equipmentSlots .consumable');
    //             //             //    document.querySelector('.equipmentSlots .count')

    //             //             var hasItemDiv = $(heroIt1).children();
    //             //             //var hasItemDiv = $(heroIt1).children();
    //             //             var resultParent;
    //             //             for (let i = 0; i < hasItemDiv.length; i++) {
    //             //                 if ($(hasItemDiv[i]).hasClass(ItemName)) {
    //             //                     resultParent = $(hasItemDiv[i]).parent();
    //             //                 }
    //             //             }
    //             //             var itemCount = $("#" + eventId + ".count");
    //             //             if (state_value - input_value == 0) {
    //             //                 $(itemCount).text('');

    //             //             }
    //             //             else {
    //             //                 $(itemCount).text(state_value - input_value);
    //             //             }
    //             //             //console.log("state_value"+state_value+"input_value"+input_value);
    //             //             if (resultParent == null) {

    //             //                 //heroIt1.className=heroIt1.className.replace(event.target.className.split(" ")[1],heroItemName);
    //             //                 heroIt1.children[1].className += ItemName;
    //             //                 heroIt1.id = event.target.id;
    //             //                 var div = document.createElement("div");
    //             //                 div.className = "count";
    //             //                 div.innerHTML += input_value;
    //             //                 heroIt.appendChild(div);
    //             //             }
    //             //             else {
    //             //                 var parentCount = $(resultParent).children()[2];
    //             //                 $(parentCount).text(parseInt(parentCount.textContent) + input_value);
    //             //             }
    //             //         }
    //             //         toolModals.style.display = "none";
    //             //     }

    //             // }
    //             else {
    //                 var herotooltip = document.getElementsByClassName("heroItemTooltip " + event.target.className.split(" ")[2])[0];

    //             }
    //             herotooltip.style.display = 'none';

    //             setTimeout(() => {
    //                 event.target.style.color = "";
    //             }, 500);
    //         }
    //     }
    // }, false);
    equipmentName.addEventListener("mouseover", (event) => {


        //console.log(document.getElementsByClassName('.count')[0].value);

        
        if (event.target.className.split(" ")[1] != "empty" && event.target.className != "scene") {
            if (event.target.className.split(" ")[1] == "consumable") {
                // var herotooltip = $(".ToolTips").children().siblings("#" + event.target.id)[0];
                var herotooltip=document.getElementsByClassName("heroItemTooltip consumable "+event.target.className.split(" ")[2])[0];
            }
            else {
                var herotooltip = document.getElementsByClassName("heroItemTooltip " + event.target.className.split(" ")[1])[0];

            }
            //console.log($(event.target));
            herotooltip.style.position = 'absolute';
            // herotooltip.style.top=event.target.offsetTop;
            // herotooltip.style.left=event.target.offsetLeft;
            let topOffset = event.target.offsetTop + $(herotooltip).height() / 2;
            let leftOffset = event.target.offsetLeft + $(herotooltip).width() / 2;
            $(herotooltip).css('top', `${topOffset}px`);
            $(herotooltip).css('left', `${leftOffset}px`);
            $(herotooltip).css('z-index', `30000`);
            //    herotooltip.clientTop = event.target.offsetTop;
            //    herotooltip.clientLeft = event.target.offsetLeft;
            herotooltip.style.display = 'block';
        }
        setTimeout(() => {
            event.target.style.color = "";
        }, 500);

    }, false);

    equipmentName.addEventListener("mouseout", (event) => {
        if (event.target.className.split(" ")[1] != "empty" && event.target.className != "scene") {
            var herotooltip;
            if (event.target.className.split(" ")[1] == "consumable") {
                var herotooltip=document.getElementsByClassName("heroItemTooltip consumable "+event.target.className.split(" ")[2])[0];
            }
            else {
                herotooltip = document.getElementsByClassName("heroItemTooltip " + event.target.className.split(" ")[1])[0];

            }
            herotooltip.style.display = 'none';

            setTimeout(() => {
                event.target.style.color = "";
            }, 500);
        }
    }, false);

    // equipmentName.addEventListener("mousedown", (event) => {
    //     if (event.target.className.split(" ")[1] != "empty" && event.target.className != "scene") {

    //         if (event.target.className.split(" ")[1] == "consumable") {
    //             var herotooltip = $(".ToolTips").children().siblings("#" + event.target.id)[0];
    //             var eventId = event.target.id;
    //             var toolModal = document.getElementById("toolModal_" + event.target.id).style.display = "block";

    //             var btnClose = document.getElementById("btnClose_" + eventId);
    //             var toolModals = document.getElementById("toolModal_" + eventId);
    //             var btnMove = document.getElementById("btnMove_" + eventId);
    //             btnClose.onclick = function () {
    //                 toolModals.style.display = "none";
    //             }
    //             btnMove.onclick = function () {
    //                 var input_value = parseInt(document.getElementById('input_' + eventId).value);
    //                 var state_value = parseInt(document.querySelector('.equipmentSlots .count').textContent);

    //                 if (state_value > input_value) {

    //                     var heroItemName = event.target.className.split("heroItem ")[1];
    //                     var ItemName = event.target.children[1].className.split("item ")[1];
    //                     var heroIt = $($(".heroItems").children()).siblings('.empty')[0];
    //                     var heroIt1 = $($(".heroItems").children()).siblings('.consumable');
    //                     var hasItemDiv = $(heroIt1).children();
    //                     var resultParent;
    //                     for (let i = 0; i < hasItemDiv.length; i++) {
    //                         if ($(hasItemDiv[i]).hasClass(ItemName)) {
    //                             resultParent = $(hasItemDiv[i]).parent();
    //                         }
    //                     }
    //                     var itemCount = $("div.equipmentSlots .count");
    //                     if (state_value - input_value == 0) {
    //                         $(itemCount).text('');

    //                     }
    //                     else {
    //                         $(itemCount).text(state_value - input_value);
    //                     }
    //                     //console.log("state_value"+state_value+"input_value"+input_value);
    //                     if (resultParent == null) {
    //                         heroIt.className = heroIt.className.replace("empty", heroItemName);
    //                         heroIt.id = event.target.id;
    //                         heroIt.children[1].className += ItemName;

    //                         var div = document.createElement("div");
    //                         div.className = "count";
    //                         div.innerHTML += input_value;
    //                         heroIt.appendChild(div);
    //                     }
    //                     else {
    //                         var parentCount = $(resultParent).children()[2];
    //                         $(parentCount).text(parseInt(parentCount.textContent) + input_value);
    //                     }
    //                     //$(heroIt1).children().find('div.'+ItemName);


    //                     //console.log(itemCount);
    //                     //itemCount[0].innerText="";
    //                     // itemCount[0].innerHtml="";
    //                     // $(itemCount[0]).html("");*
    //                     // console.log(itemCount);

    //                 }
    //                 else if (state_value == input_value) {

    //                     var heroItemName = event.target.className.split("heroItem ")[1];
    //                     var ItemName = event.target.children[1].className.split("item ")[1];
    //                     event.target.className = event.target.className.replace(event.target.className.split(" ")[1], "empty");
    //                     var heroIt = $($(".heroItems").children()).siblings('.empty')[0];
    //                     var heroIt1 = $($(".heroItems").children()).siblings('.consumable');
    //                     var hasItemDiv = $(heroIt1).children();
    //                     var resultParent;
    //                     for (let i = 0; i < hasItemDiv.length; i++) {
    //                         if ($(hasItemDiv[i]).hasClass(ItemName)) {
    //                             resultParent = $(hasItemDiv[i]).parent();
    //                         }
    //                     }
    //                     var itemCount = $("div.equipmentSlots .count");
    //                     if (state_value - input_value == 0) {
    //                         $(itemCount).text('');

    //                     }
    //                     else {
    //                         $(itemCount).text(state_value - input_value);
    //                     }
    //                     //console.log("state_value"+state_value+"input_value"+input_value);
    //                     if (resultParent == null) {
    //                         heroIt.className = heroIt.className.replace("empty", heroItemName);
    //                         heroIt.children[1].className += ItemName;
    //                         heroIt.id = event.target.id;
    //                         var div = document.createElement("div");
    //                         div.className = "count";
    //                         div.innerHTML += input_value;
    //                         heroIt.appendChild(div);
    //                     }
    //                     else {
    //                         var parentCount = $(resultParent).children()[2];
    //                         $(parentCount).text(parseInt(parentCount.textContent) + input_value);
    //                     }

    //                 }
    //                 else {



    //                 }
    //                 toolModals.style.display = "none";
    //             }
    //         }
    //         else {
    //             var herotooltip = document.getElementsByClassName("heroItemTooltip " + event.target.className.split(" ")[1])[0];

    //         }
    //         herotooltip.style.display = 'none';

    //         setTimeout(() => {
    //             event.target.style.color = "";
    //         }, 500);
    //     }
    // }, false);




    function resetClicked() {

        var imageSrc = document.getElementsByClassName("optionsWrapper")[0].children[0].children[0].children[0].src;

        var myArray = imageSrc.split("&");
        for (let i = 0; i < myArray.length; i++) {
            if (myArray[i].includes("gender")) {


                imageSrc = imageSrc.replace(myArray[i], "gender=" + '<?php echo $vars['hero']['gender'];?>');
                console.log(imageSrc);
            }
            if (myArray[i].includes("beard")) {

                imageSrc = imageSrc.replace(myArray[i], "beard=" +<?php echo $vars['hero']['beard'];?>);

            }
            if (myArray[i].includes("jaw")) {
                imageSrc = imageSrc.replace(myArray[i], "jaw=" +<?php echo $vars['hero']['headProfile'];?>);
                // console.log("jaw"+imageSrc);
            }
            if (myArray[i].includes("hairStyle")) {
                imageSrc = imageSrc.replace(myArray[i], "hairStyle=" +<?php echo $vars['hero']['hairStyle'];?>);
                //console.log("hairStyle"+imageSrc);
            }
            if (myArray[i].includes("nose")) {
                imageSrc = imageSrc.replace(myArray[i], "nose=" +<?php echo $vars['hero']['nose'];?>);
                //  console.log("nose"+imageSrc);
            }
            if (myArray[i].includes("mouth")) {

                imageSrc = imageSrc.replace(myArray[i], "mouth=" +<?php echo $vars['hero']['mouth'];?>);
                // console.log("mouth"+imageSrc);
            }
            if (myArray[i].includes("eyes")) {
                imageSrc = imageSrc.replace(myArray[i], "eyes=" +<?php echo $vars['hero']['eyes'];?>);
                // console.log("eyes"+imageSrc);
            }
            if (myArray[i].includes("ears")) {
                imageSrc = imageSrc.replace(myArray[i], "ears=" +<?php echo $vars['hero']['ears'];?>);
                //  console.log("ears"+imageSrc);
            }
            if (myArray[i].includes("brows")) {
                imageSrc = imageSrc.replace(myArray[i], "brows=" +<?php echo $vars['hero']['eyebrow'];?>);
                //console.log("brows"+imageSrc);
            }
            if (myArray[i].includes("hairColor")) {

                imageSrc = imageSrc.replace(myArray[i], "hairColor=" +<?php echo $vars['hero']['hairColor'];?>);
                //console.log("hairColor"+imageSrc);
            }
        }

        var optionWrapper = document.getElementsByClassName("optionsWrapper")[0];
        var hasItemDiv = $(".categories").children();
        var resultParent;
        var arrayIndex;
        for (let i = 0; i < hasItemDiv.length; i++) {
            if ($(hasItemDiv[i]).hasClass("selected")) {
                resultParent = $(hasItemDiv[i]);

            }
        }
        var getId = $(resultParent).get(0).id;
        for (let i = 0; i < optionWrapper.children.length; i++) {
            const myArray1 = optionWrapper.children[i].children[0].children[0].src.split("&");

            for (let j = 0; j < myArray1.length; j++) {
                if (myArray1[j].includes(getId)) {

                    myArray1[j] = getId + "=" + i;

                    optionWrapper.children[i].children[0].children[0].src = imageSrc.replace(imageSrc.split("&")[j], myArray1[j]);


                }
            }


        }

        var previewWrapper = document.getElementsByClassName("previewWrapper")[0];
        var srcExchange = imageSrc;
        srcExchange = srcExchange.replace("medium", "large");

        previewWrapper.children[0].children[0].src = srcExchange;

    }


    function saveClicked() {
        // $.ajax({
        //     url: '',
        //     type: 'POST',
        //     data: { question: 'aaaaaaaaaaaaaaaaa' },
        //     success: function (data) {
        //         console.log(data);
        //     //   location.reload();
        //     },
        //     error: function (error) {
        //         alert('error');
        //     }
        // });
        var imageSrc = document.getElementsByClassName("previewWrapper")[0].children[0].children[0].src;
        var myArray = imageSrc.split("&");
        var beard, headProfile, hairStyle, nose, mouth, eyes, ears, eyebrow, hairColor, gender;
        for (let i = 0; i < myArray.length; i++) {
            if (myArray[i].includes("beard")) {
                beard = myArray[i].split("=")[1];
            }
            if (myArray[i].includes("jaw")) {
                headProfile = myArray[i].split("=")[1];
            }
            if (myArray[i].includes("hairStyle")) {
                hairStyle = myArray[i].split("=")[1];
            }
            if (myArray[i].includes("nose")) {
                nose = myArray[i].split("=")[1];
            }
            if (myArray[i].includes("mouth")) {
                mouth = myArray[i].split("=")[1];
            }
            if (myArray[i].includes("eyes")) {
                eyes = myArray[i].split("=")[1];
            }
            if (myArray[i].includes("ears")) {
                ears = myArray[i].split("=")[1];
            }
            if (myArray[i].includes("brows")) {
                eyebrow = myArray[i].split("=")[1];
            }
            if (myArray[i].includes("gender")) {
                gender = myArray[i].split("=")[1];
            }
            if (myArray[i].includes("hairColor")) {

                hairColor = myArray[i].split("=")[1];



            }
        }
        if (beard ==<?php echo $vars['hero']['beard'] ?>&& headProfile ==<?php echo $vars['hero']['headProfile'] ?>&& hairStyle ==<?php echo $vars['hero']['hairStyle'] ?>&& nose ==<?php echo $vars['hero']['nose'] ?>&& mouth ==<?php echo $vars['hero']['mouth'] ?>&& eyes ==<?php echo $vars['hero']['eyes'] ?>&& ears ==<?php echo $vars['hero']['ears'] ?>&& eyebrow ==<?php echo $vars['hero']['eyebrow'] ?>&& hairColor ==<?php echo $vars['hero']['hairColor'] ?>&& gender == '<?php echo $vars['hero']['gender']?>') {

        }
        else {
            $.post("hero.php", {
                'beard': beard,
                'headProfile': headProfile,
                'hairStyle': hairStyle,
                'nose': nose,
                'mouth': mouth,
                'eyes': eyes,
                'ears': ears,
                'eyebrow': eyebrow,
                'hairColor': hairColor,
                'gender': gender
            }, function (res) {
                location.reload();
            })
        }

    }


    function takeshot() {
            // div_content = document.querySelector("#downloadHeroImagePreview")
			// 	//make it as html5 canvas
			// 	html2canvas(div_content).then(function(canvas) {
			// 		//change the canvas to jpeg image
			// 		data = canvas.toDataURL('image/jpeg');
					
			// 		window.open(data);
            const findEl = document.getElementById('downloadHeroImagePreview');
            html2canvas(findEl).then((canvas) => {
        const link = document.createElement('a');
        document.body.appendChild(link);
        link.download = "download.jpg";
        link.href = canvas.toDataURL();
        link.click();
        link.remove();
            })
        var downloadModal=document.getElementById('download_modal');
        downloadModal.style.display='none';
    }
    function downloadClicked(){
          var downloadModal=document.getElementById('download_modal');
          downloadModal.style.display='block';
            
    }
    function downloadCancelClicked(){
        var downloadModal=document.getElementById('download_modal');
        downloadModal.style.display='none';
    }
    function backgroundSelection(item)
    {
        
        var backgroundImage=document.getElementById("downloadHeroImagePreview");
       if(item!='none')
            backgroundImage.style.backgroundImage=backgroundImage.style.backgroundImage.replace(backgroundImage.style.backgroundImage.split('download/')[1],item+".jpg");
        else
        backgroundImage.style.backgroundImage=backgroundImage.style.backgroundImage.replace(backgroundImage.style.backgroundImage.split('download/')[1],item+".png");
      
    }
</script>