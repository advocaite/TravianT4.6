<div class="dialogOverlay enabled dialogVisible convertModal" style="z-index: 6015;display:none">
    <div class="dialogWrapper dialogV1" data-context="convertGoldPopup" style="z-index: 6020;position: absolute;
    margin-left: 40%;
    margin-top: 20%;">
        <div class="dialog">
            <div class="dialogContainer">
                <div class="dialogContents">
                    <form action="?" method="get" accept-charset="UTF-8">
                        <div class="dialogDragBar"></div>
                        <div class="iconButton small info" style="display: none;"></div>
                        <div class="dialogCancelButton iconButton small cancel" onclick="dialogCancelButtonClicked()"></div>
                        <div class="title" style="display: none;"></div>
                        <div class="content" id="dialogContent">Please confirm converting 1 gold to 100 silver.
            <div class="buttons">
                <button type="button" value="Redeem" id="goldToSilver_confirm_btn" class="textButtonV1 gold " onclick="goldToSiverClicked()" coins="1" version="textButtonV1" >
	Redeem<i class="goldIcon"></i><span class="goldValue">1</span></button>

            </div>
        </div>
                        <div class="buttons" style="display: none;"><button class="green dialogButtonOk ok textButtonV1" type="submit" onclick="dialogButtonOkClicked()">
	</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contentNavi subNavi tabFavorWrapper ">

    <div class="scrollingContainer">
    <div class="content">
    <div title="" class="container <?=$vars['action'] == 'buy' ? 'active' : 'normal';?>">
       

            <a href="hero.php?t=4&action=buy" class="tabItem <?=$vars['action'] == 'buy' ? 'active' : 'normal';?>"><?=T("Auction", "buy");?></a>
    </div>
    </div>
    <div class="content">
    <div title="" class="container <?=$vars['action'] == 'sell' ? 'active' : 'normal';?>">
      
       

            <a href="hero.php?t=4&action=sell" class="tabItem <?=$vars['action'] == 'sell' ? 'active' : 'normal';?>"><?=T("Auction", "sell");?></a>
        </div>
    </div>
    
    <div class="content">
    <div title="" class="container <?=$vars['action'] == 'bids' ? 'active' : 'normal';?>">
  

            <a href="hero.php?t=4&action=bids" class="tabItem <?=$vars['action'] == 'bids' ? 'active' : 'normal';?>"><?=T("Auction", "bids");?></a>
        </div>
    </div>
    <div class="content">
    <div title="" class="container <?=$vars['action'] == 'accounting' ? 'active' : 'normal';?>">
       
      

            <a href="hero.php?t=4&action=accounting" class="tabItem <?=$vars['action'] == 'accounting' ? 'active' : 'normal';?> "><?=T("Auction", "accounting");?></a>
        </div>
    </div>
    
    <div class="clear"></div>
</div>
<?//php include 'silverExchange.php';?>
<div id="silverExchange" class="silverExchange">
    <h4>Exchange office</h4>
    <div class="exchangeLine">
        <div class="directionButtons" onclick="directionButtonChanged()">
            <button class="directionButton GoldToSilver active">
                <img src="/img/x.gif" class="gold" alt="Gold">
                <img src="/img/x.gif" class="arrow" alt="">
                <img src="/img/x.gif" class="silver" alt="Silver">
            </button>
            <button class="directionButton SilverToGold">
                <img src="/img/x.gif" class="silver" alt="Silver">
                <img src="/img/x.gif" class="arrow" alt="">
                <img src="/img/x.gif" class="gold" alt="Gold">
            </button>
        </div>
        <div class="exchangeTypeGoldToSilver exchangeType active" >
            <span>
                <button type="submit" value="GoldToSilver" id="button630dddd90688d" class="textButtonV1 gold " coins="1" version="textButtonV1" onclick="siverToGoldClicked()">
	                Convert
                    <i class="goldIcon"></i>
                    <span class="goldValue">1</span>
                </button>
                <script type="text/javascript" id="button63143582b75cd_script">
                jQuery(function() {
                    jQuery('button#button63143582b75cd').click(function () {
                        jQuery(window).trigger('buttonClicked', [this, {"type":"submit","value":"GoldToSilver","name":"","id":"button63143582b75cd","class":"textButtonV1 gold ","title":"Convert now","confirm":"","onclick":"","coins":"1","wayOfPayment":{"featureKey":"exchangeSilver","context":"convertGoldPopup","dataCallback":"getExchangeCoins","confirmPopup":{"name":"gold\/convert-popup","options":{"elementFocus":"#goldToSilver_confirm_btn"}}},"version":"textButtonV1"}]);
                    });
                });
            </script>
            </span>
            <div class="exchangeItem formularDirectionltr" >
                <span class="silverExchangeFormularTerm">
                    <img src="/img/x.gif" class="gold" alt="Gold">
                </span>
                <span class="silverExchangeFormularTerm">
                    <input id="exchangeGoldToSilverInput" class="goldInput text" type="text" inputmode="numeric" value="1">
                </span>
                <span class="silverExchangeFormularTerm">×</span>
                <span class="silverExchangeFormularTerm">100</span>
                <span class="silverExchangeFormularTerm">=</span>
                <span class="silverExchangeFormularTerm resultTerm">
                    <img src="/img/x.gif" class="silver" alt="Silver">
                    <span class="silverResult">100</span>
                </span>
            </div>
        </div>
        <div class="exchangeTypeSilverToGold exchangeType">
            <span>
                <button type="submit" value="SilverToGold" id="silverToGold_btn" class="textButtonV1 green " version="textButtonV1" onclick="SilverToGoldExchange()">
	            Exchange</button>
               
            </span>
            <div class="exchangeItem formularDirection formularDirectionltr">
                <span class="silverExchangeFormularTerm">
                    <img src="/img/x.gif" class="silver" alt="Silver">
                </span>
                <span class="silverExchangeFormularTerm">
                    <input id="exchangeSilverToGoldInput" class="silverInput text" type="text" inputmode="numeric" value="200">
                </span>
                <span class="silverExchangeFormularTerm">÷</span>
                <span class="silverExchangeFormularTerm">200</span>
                <span class="silverExchangeFormularTerm">=</span>
                <span class="silverExchangeFormularTerm resultTerm">
                    <img src="/img/x.gif" class="gold" alt="Gold">
                    <span class="goldResult">1</span>
                </span>
            </div>
        </div>
    </div>
    <div class="clear">

    </div>
    <div class="exchangeMessageLine">

    </div>
</div>
            </div>
<script type="text/javascript">
   
    function goldToSiverClicked(){
        var dialogOverlay=document.getElementsByClassName("convertModal")[0];
        var input = jQuery('#exchangeGoldToSilverInput').val();
      
        dialogOverlay.style.display='none';
        $.post("silverExchange.php", {
                'exTyp': 'GoldToSilver',
                's':input
                
            }, function(res) {
                location.reload();
            })
           

    }
    function SilverToGoldExchange(){
        var input = jQuery('#exchangeSilverToGoldInput').val();
        $.post("silverExchange.php", {
                'exTyp': 'SilverToGold',
                's':input
                
            }, function(res) {
                location.reload();
            })
    }
    function dialogCancelButtonClicked(){
        var dialogOverlay=document.getElementsByClassName("convertModal")[0];
        
        dialogOverlay.style.display='none';
    }

    function siverToGoldClicked(){
        var dialogOverlay=document.getElementsByClassName("convertModal")[0];
        
        dialogOverlay.style.display='block';
    }

    function directionButtonChanged() {
      
        var directionButtons=document.getElementsByClassName("directionButtons")[0];
        var exchangeTypeGoldToSilver=document.getElementsByClassName("exchangeTypeGoldToSilver")[0];
        var exchangeTypeSilverToGold=document.getElementsByClassName("exchangeTypeSilverToGold")[0];
        for(let i=0;i<directionButtons.children.length;i++)
            {
                try {
                    directionButtons.children[i].className=directionButtons.children[i].className.replace(" active","");
                    
                   
                } catch (error) {
                    
                }
                
               
            }
            try {
                exchangeTypeSilverToGold.className=exchangeTypeSilverToGold.className.replace(" active","");
                exchangeTypeGoldToSilver.className=exchangeTypeGoldToSilver.className.replace(" active","");
            } catch (error) {
                
            }
            if(event.target.className.split(" ")[1]!=null){
                event.target.className=event.target.className.replace(event.target.className,event.target.className +" active");
               if(event.target.className.includes("GoldToSilver"))
               {
               
                exchangeTypeGoldToSilver.className=exchangeTypeGoldToSilver.className.replace(exchangeTypeGoldToSilver.className,exchangeTypeGoldToSilver.className+ " active")
               }
               else{
               
                exchangeTypeSilverToGold.className=exchangeTypeSilverToGold.className.replace(exchangeTypeSilverToGold.className,exchangeTypeSilverToGold.className+ " active")
               }
            }
            else{
                event.target.parentNode.className=event.target.parentNode.className.replace(event.target.parentNode.className,event.target.parentNode.className +" active");
                if(event.target.parentNode.className.includes("GoldToSilver"))
               {
                
                exchangeTypeGoldToSilver.className=exchangeTypeGoldToSilver.className.replace(exchangeTypeGoldToSilver.className,exchangeTypeGoldToSilver.className+ " active")
               }
               else{
              
                exchangeTypeSilverToGold.className=exchangeTypeSilverToGold.className.replace(exchangeTypeSilverToGold.className,exchangeTypeSilverToGold.className+ " active")
               }
            }
    }
</script>
