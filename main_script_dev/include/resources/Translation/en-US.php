<?php

use Core\Config;
use Model\DailyQuestModel;
use Model\Quest;

global $Definition;

$Definition['403Error']['You cannot pass!'] = 'You cannot pass!';
$Definition['403Error']['I am a servant of the Secret Order, wielder of the flame of 403, You cannot pass'] = 'I am a servant of the Secret Order, wielder of the flame of 403. You cannot pass.';
//Academy
$Definition['Academy'] = [
    "zoomIn" => "zoom in",
    "Researches for village %s" => "Researches for village %s",
    "ResearchesForVillage" => "Researches For Village",
    "noResearchAvailableDesc" => "No new troops can be researched at the moment. To look up the prerequisites for new troops, click on the picture of the relevant unit in the manual.",
    "showMore" => "show more",
    "hideMore" => "show less",
    "Researching" => "Researching",
    "unit" => "Unit",
    "research" => "Research",
    "one_research_is_going" => "One research is already running.",
];

$Definition['ActivationNew'] = [
    'unableToGenerateBase' => 'We were unable to generate a new village for you. Please try again after a while or contact administrator.',

    'vidSelectDescription' => 'Great empires begin with important decisions! Are you an attacker who loves competition? Or is your time investment rather low? Are you a team player who enjoys building up a thriving economy to forge the anvil?',
    'sectorSelectDescription' => 'Where do you want to start building up your empire? Use the "recommended" area for the most ideal location. Or select the area where your friends are located and team up!',
    'recommendedForNewPlayers' => 'Recommended for new players',
    'Select your starting position' => 'Select your starting position',
    'Select your tribe' => 'Select your tribe',
    'Confirm' => 'Confirm',
    'back' => 'back',
    'New' => 'New',
    'RECOMMENDED' => 'RECOMMENDED',
    'Ready to rule the world?' => 'Ready to rule the world?',
    'PLAY NOW' => 'PLAY NOW',
    'North - West' => 'North - West',
    'North - East' => 'North - East',
    'South - West' => 'South - West',
    'South - East' => 'South - East',
    'selectionComplete' => 'Your selection is complete. One more click to accept the challenge!',
    "race1_attributes" => [
        0 => 'Moderate time requirements',
        1 => 'Can develop villages the fastest',
        2 => 'Very strong but expensive troops',
        3 => 'Hard to play for new players',
    ],
    'race2_attributes' => [
        0 => 'High time requirements',
        1 => 'Good at looting in early game',
        2 => 'Strong, cheap infantry',
        3 => 'For aggressive players',
    ],
    "race3_attributes" => [
        0 => 'Low time requirements',
        1 => 'Loot protection and good defense',
        2 => 'Excellent, fast cavalry',
        3 => 'Well suited to new players',
    ],
    "race6_attributes" => [
        0 => 'Low time requirements',
        1 => 'More resources available',
        2 => 'Excellent, defensive units',
        3 => 'Well suited to new players',
    ],
    "race7_attributes" => [
        0 => 'High time requirements',
        1 => 'Impressively strong cavalry',
        2 => 'Reliant on others for protection',
        3 => 'Not recommended for new players!',
    ],
];

$Definition['activation'] = [
    'unableToGenerateBase' => 'We were unable to generate a new village for you. Please try again after a while or contact administrator.',

    "selectASector" => "Select Starting Position",
    "sector_nw" => "You will start in the north-west.",
    "sector_ne" => "You will start in the north-east.",
    "sector_sw" => "You will start in the south-west.",
    "sector_se" => "You will start in the south-east.",
    "race_helpers" => [
        1 => "Quintus",
        2 => 'Henrik',
        3 => 'Ambiorix',
    ],
    "selectedRace" => "You chose the %s tribe %s From now on will be your advisor.",
    "changeVid" => "Change tribe",
    "submitSector" => "Select Starting Position",
    "sectorDescription" => 'Choose your village\'s starting location by clicking on the map.',
    "selectARace" => "Choose a tribe.",
    "submitKind" => "Choose a tribe",
    "attributes" => "Specifics",
    "thanksForActivation" => 'Thank you for activating your account..',
    "pleaseChooseATribe" => 'Select your tribe for this world.',
    "vidDescription" => 'We recommend you choose the Gaul tribe if you are new to TRAVIAN.',
    "race1_attributes" => [
        0 => 'Time requirements are moderate.',
        1 => 'May develop villages the fastest.',
        2 => 'Very Strong but expensive troops, good <br />infantry.',
        3 => 'Has hardly any advantages during the game\'s <br /> initial stage, not recommended for new <br /> players.',
    ],
    'race2_attributes' => [
        0 => 'Sufficient time needed for offensive play',
        1 => 'Inexpensive troops may be produced fast,<br /> good at looting.',
        2 => 'For aggressive and experienced players.',
    ],
    "race3_attributes" => [
        0 => 'Low time requirements.',
        1 => 'Better loot protection and good defense available early on.',
        2 => 'Very good cavalry, fastest units in game.',
        3 => 'Good fit for new players.',
    ],
];
//Alliance
$Definition['Alliance']['Kicking/inviting is not allowed at this time'] = 'icking/inviting is not allowed at this time.';
$Definition['Alliance']['Enter tag'] = 'Enter Tag.';
$Definition['Alliance']['Enter name'] = 'Enter Name.';
$Definition['Alliance']['Tag too long'] = 'Tag too long.';
$Definition['Alliance']['Name too long'] = 'Name too long.';
$Definition['Alliance']['Category'] = 'Category';
$Definition['Alliance']['week'] = 'Week';
$Definition['Alliance']['bbcode'] = 'BB code';
$Definition['Alliance']['Medals'] = 'Medals';
$Definition['Alliance']['BB codes'] = 'BB code';
$Definition['Alliance']['News'] = 'News';
$Definition['Alliance']['Number'] = 'Number';
$Definition['Alliance']['losses'] = 'losses';
$Definition['Alliance']['strength'] = 'strength';
$Definition['Alliance']['Title'] = 'Title';
$Definition['Alliance']['URL'] = 'URL';
$Definition['Alliance']['Hint'] = 'Hint';
$Definition['Alliance']['Tip'] = 'Tip';
$Definition['Alliance']['confederacy with x'] = 'Confederacy with %s';
$Definition['Alliance']['NAP with x'] = 'NAP with %s';
$Definition['Alliance']['war with x'] = 'War with %s';
$Definition['Alliance']['accept'] = 'Accept';
$Definition['Alliance']['Select'] = 'Select';
$Definition['Alliance']['Confirm'] = 'Confirm';
$Definition['Alliance']['wrongPassword'] = 'Wrong Password';
$Definition['Alliance']['In order to kick the player you have to enter your password again for security reasons'] = 'In order to kick the player you have to enter your password again for security reasons.';
$Definition['Alliance']['Password'] = 'Password';
$Definition['Alliance']['Cant kick player'] = 'Cant kick player.';
$Definition['Alliance']['InvitesAreClosed'] = 'Invites Are Closed.';
$Definition['Alliance']['There is already an offer'] = 'There is already an offer.';
$Definition['Alliance']['Alliance x does not exists'] = 'Alliance %s does not exists.';
$Definition['Alliance']['offer a confederacy'] = 'offer a confederacy';
$Definition['Alliance']['offer a NAP'] = 'offer a NAP';
$Definition['Alliance']['declare war'] = 'declare war';
$Definition['Alliance']['Own offers'] = 'Own offers';
$Definition['Alliance']['Foreign offers'] = 'Foreign offers';
$Definition['Alliance']['Send'] = 'Send';
$Definition['Alliance']['DiplomacyShowText'] = '<div class="text">If you want to see connections in the alliance description automatically, type <span class="e">[diplomatie]</span> into the description, <span class="e">[ally]</span>, <span class="e">[nap]</span> and <span class="e">[war]</span> are also possible.		</div>';
$Definition['Alliance']['DiplomacyHint'] = 'It\'s part of diplomatic etiquette to talk to another alliance and negotiate before sending an offer for a non-aggression pact (NAP) or a confederacy.';
$Definition['Alliance']['Existing relationships'] = 'Existing relationships';
$Definition['Alliance']['The player x does`t exists'] = 'The player %s does`t exists.';
$Definition['Alliance']['none'] = 'none';
$Definition['Alliance']['draw back'] = 'Cancle';
$Definition['Alliance']['invite sent to x'] = 'invite sent to %s.';
$Definition['Alliance']['invitation for x'] = 'invitation for %s';
$Definition['Alliance']['test has already received an invitation'] = '%s has already received an invitation.';
$Definition['Alliance']['Invitations'] = 'Invitations';
$Definition['Alliance']['invite'] = 'invite';
$Definition['Alliance']['toTheForum'] = 'Link to the forum';
$Definition['Alliance']['you just left your alliance'] = 'you just left your alliance.';
$Definition['Alliance']['In order to quit the alliance you have to enter your password gain for safety reasons'] = 'In order to quit the alliance you have to enter your password again for safety reasons.';
$Definition['Alliance']['x has been kicked from the alliance'] = '%s has been kicked from the alliance.';
$Definition['Alliance']['If your alliance wants to use an external forum, you can enter the URL here'] = 'If your alliance wants to use an external forum, you can enter the URL here.';
$Definition['Alliance']['choose player'] = 'Choose player';
$Definition['Alliance']['Manage flags and markers in map'] = 'Manage flags and markers in map';
$Definition['Alliance']['Manage forums'] = 'Manage forums';
$Definition['Alliance']['IGMs to every alliance member'] = 'IGMs to every alliance member';
$Definition['Alliance']['You can set up different permissions for each alliance member and assign positions'] = 'You can set up different permissions for each alliance member and assign positions.';
$Definition['Alliance']['fighting points'] = 'fighting points';
$Definition['Alliance']['Tag exists'] = 'Tag exists.';
$Definition['Alliance']['Changes saved'] = 'Changes saved.';
$Definition['Alliance']['Date'] = 'Date';
$Definition['Alliance']['Don´t show attacks of own alliance (under 100 units, no losses)'] = 'on´t show attacks of own alliance (under 100 units, no losses)';
$Definition['Alliance']['noReports'] = 'no Reports.';
$Definition['Alliance']['online now'] = 'now online';
$Definition['Alliance']['active players'] = 'Active within 10 minute';
$Definition['Alliance']['active 3days'] = 'Active within 3 days';
$Definition['Alliance']['active 7days'] = 'Active within 7 days';
$Definition['Alliance']['inactive'] = 'in active';
$Definition['Alliance']['Rank'] = 'Rank';
$Definition['Alliance']['Points'] = 'Points';
$Definition['Alliance']['Change name'] = 'Change name';
$Definition['Alliance']['Change alliance description'] = 'Change alliance description';
$Definition['Alliance']['Edit internal info page'] = 'Edit internal info page';
$Definition['Alliance']['Assign to position'] = 'Assign to position';
$Definition['Alliance']['Link to the forum'] = 'Link to the forum';
$Definition['Alliance']['Settings'] = 'Settings';
$Definition['Alliance']['Actions'] = 'Actions';
$Definition['Alliance']['Invite a player into the alliance'] = 'Invite a player into the alliance';
$Definition['Alliance']['Alliance diplomacy'] = 'Alliance diplomacy';
$Definition['Alliance']['Quit alliance'] = 'Quit alliance';
$Definition['Alliance']['Kick player'] = 'Kick player';
$Definition['Alliance']['Population'] = 'Population';
$Definition['Alliance']['Details'] = 'Details';
$Definition['Alliance']['Members'] = 'Members';
$Definition['Alliance']['Position'] = 'Position';
$Definition['Alliance']['no thread created'] = 'No Threads has been created yet.';
$Definition['Alliance']['This survey ends on x'] = 'This survey ends on %s.';
$Definition['Alliance']['voting finished'] = 'voting finished.';
$Definition['Alliance']['move topic'] = 'move topic';
$Definition['Alliance']['edit topic'] = 'edit topics';
$Definition['Alliance']['x times edited, last edit by y'] = '%sx edited, last by %s on %s.';
$Definition['Alliance']['Player ID'] = 'Player ID';
$Definition['Alliance']['user_list_headline'] = 'Open forum for these players';
$Definition['Alliance']['answer(s)'] = 'answer(s)';
$Definition['Alliance']['Last post'] = 'Last post';
$Definition['Alliance']['Posts:'] = 'Posts:';
$Definition['Alliance']['pop'] = 'pop';
$Definition['Alliance']['Villages'] = 'Villages';
$Definition['Alliance']['post reply'] = 'post reply';
$Definition['Alliance']['created'] = 'created';
$Definition['Alliance']['author'] = 'author';
$Definition['Alliance']['messages'] = 'messages';
$Definition['Alliance']['reply'] = 'reply';
$Definition['Alliance']['vote'] = 'vote';
$Definition['Alliance']['to result'] = 'to result';
$Definition['Alliance']['to survey'] = 'to survey';
$Definition['Alliance']['name'] = 'name';
$Definition['Alliance']['addLine'] = 'Add';
$Definition['Alliance']['New Thread'] = 'New Thread';
$Definition['Alliance']['Post new thread'] = 'Post new thread';
$Definition['Alliance']['Thread'] = 'Thread';
$Definition['Alliance']['Report'] = 'Report';
$Definition['Alliance']['Coordinates'] = 'Coordinates';
$Definition['Alliance']['report'] = 'report';
$Definition['Alliance']['Troops'] = 'Troops';
$Definition['Alliance']['Vote_options'] = 'Vote options';
$Definition['Alliance']['Survey'] = 'Survey';
$Definition['Alliance']['ends on'] = 'Ends on';
$Definition['Alliance']['open_topic'] = 'open topic';
$Definition['Alliance']['close_topic'] = 'Close topic';
$Definition['Alliance']['stick_topic'] = 'stick topic';
$Definition['Alliance']['unstick_topic'] = 'Unstick topic';
$Definition['Alliance']['preview'] = 'preview';
$Definition['Alliance']['underline'] = 'underline';
$Definition['Alliance']['Player'] = 'Player';
$Definition['Alliance']['Alliance ID'] = 'Alliance ID';
$Definition['Alliance']['ally_list_headline'] = 'Open for other alliances:';
$Definition['Alliance']['sitters_allowed'] = 'Sitters are allowed';
$Definition['Alliance']['open forum for the following alliances'] = 'Open forum for the following alliances';
$Definition['Alliance']['edit forum'] = 'edit forum';
$Definition['Alliance']['create_in_area'] = 'create in area';
$Definition['Alliance']['public_forum'] = 'Public forum';
$Definition['Alliance']['forum_name'] = 'Forum name';
$Definition['Alliance']['new_forum'] = 'New forum';
$Definition['Alliance']['desc'] = 'Description';
$Definition['Alliance']['alliance_forum'] = 'Alliance forum';
$Definition['Alliance']['conf_forum'] = 'Confidence forum';
$Definition['Alliance']['closed_forum'] = 'Closed forum';
$Definition['Alliance']['Tag'] = 'Tag';
$Definition['Alliance']['Forum name'] = 'Forum name';
$Definition['Alliance']['Threads'] = 'Threads';
$Definition['Alliance']['Last post'] = 'Last post';
$Definition['Alliance']['to the top'] = 'to the top';
$Definition['Alliance']['to the bottom'] = 'to the bottom';
$Definition['Alliance']['Delete'] = 'Delete';
$Definition['Alliance']['Confirm deletion?'] = 'Confirm deletion?';
$Definition['Alliance']['show last post'] = 'show last post';
$Definition['Alliance']['edit'] = 'edit';
$Definition['Alliance']['thread without new entries'] = 'Thread without new entries';
$Definition['Alliance']['thread with new entries'] = 'Thread with new entries';
$Definition['Alliance']['noForum'] = 'No forum has been created yet.';
$Definition['Alliance']['switch admin'] = 'switch admin';
$Definition['Alliance']['switch non admin'] = 'switch non admin';
$Definition['Alliance']['set x as favor tab'] = 'Set %s tab as Favorite Tab.';
$Definition['Alliance']['This tab is set as favourite'] = 'This tab is set as favourite';
$Definition['Alliance']['Overview'] = 'Overview';
$Definition['Alliance']['NewForum'] = 'New Forum';
$Definition['Alliance']['Attacks'] = 'Attacks';
$Definition['Alliance']['Bonuses'] = 'Bonuses';
$Definition['Alliance']['Forum'] = 'Forum';
$Definition['Alliance']['Options'] = 'Options';
$Definition['Alliance']['Profile'] = 'Profile';
$Definition['Alliance']['Alliance'] = 'Alliance';
$Definition['Alliance']['no Alliance'] = 'No Alliance';
$Definition['Alliance']['You are currently not in an alliance In order to join an alliance, you need a level 1 Embassy and an invitation'] = 'You are currently not in an alliance In order to join an alliance, you need a level 1 Embassy and an invitation.';
//Artefacts
$Definition['Artefacts']['numbers'] = [
    1 => 'I',
    2 => 'II',
    3 => 'III',
    4 => 'IV',
    5 => 'V',
    6 => 'VI',
    7 => 'VII',
    8 => 'VIII',
    9 => 'IX',
    10 => 'X',
];
$Definition['Artefacts'][2] = [
    'names' => [
        1 => 'The architects\' slight secret %s',
        2 => 'The architects\' great secret %s',
        3 => 'The architects unique secret',
    ],
    'desc' => 'This artefact gives your village additional protection against catapults and rams. It makes buildings and walls ‎‭‭%s more stable.',
];
$Definition['Artefacts'][4] = [
    'names' => [
        1 => 'The slight titan boots %s',
        2 => 'The great titan boots %s',
        3 => 'The unique titan boots',
    ],
    'desc' => 'This artefact increases the speed of your troops by %s‎ of its initial value.',
];
$Definition['Artefacts'][5] = [
    'names' => [
        1 => 'The eagles slight eyes %s',
        2 => 'The eagles great eyes %s',
        3 => 'The eagles unique eyes',
    ],
    'desc' => 'This artefact makes your scouts ‎‭‭%s&times;‬‎ stronger than normal. All scouts in the village, as well as all scouts sent for spying from this village, are affected. Additionally, you can see the type of troops attacking you at your rally point, but not the number of troops.',
];
$Definition['Artefacts'][6] = [
    'names' => [
        1 => 'Slight diet control %s',
        2 => 'Great diet control %s',
        3 => 'Unique diet control',
    ],
    'desc' => 'This artefact reduces the crop usage of your own and others troops in your village to ‎‭‭‭%s&times; of its initial values.',
];
$Definition['Artefacts'][8] = [
    'names' => [
        1 => 'The trainers slight talent %s',
        2 => 'The trainers great talent %s',
        3 => 'The trainers unique talent',
    ],
    'desc' => 'This artefact reduces training times in the palace, residence, workshop, stable and barracks to %s&times; of its initial values.',
];
$Definition['Artefacts'][9] = [
    'names' => [
        1 => 'Slight storage masterplan %s',
        2 => 'Great storage masterplan %s',
    ],
    'desc' => 'This construction plan allows you to build great granaries and great warehouses. The plan is also required to be able to build the higher levels of those buildings.',
];
$Definition['Artefacts'][10] = [
    'names' => [
        1 => 'Rivals slight confusion %s',
        2 => 'Rivals great confusion %s',
        3 => 'Rivals unique confusion',
    ],
    "desc" => nl2br("This artefact increases the capacity of crannies by factor of %s&times;‬‎.

Additional effect: Catapults can only shoot random on villages affected by the artefacts power. Exceptions for the village and account artefacts are the Wonder of the World and Treasury. Exception for the unique artefact is only the Wonder of the World."),
];
$Definition['Artefacts'][11] = [
    'names' => [
        1 => 'Artefact of the slight fool',
        3 => 'Artefact of the unique fool',
    ],//no desc for this one.
];
$Definition['Artefacts'][12] = [
    'name' => 'Wonder of the World construction plan',
    'desc' => 'The construction plan allows you to build a wonder of the world in the Natarian villages. To build up to level 49, one plan is enough. For higher levels, an additional plan held by an alliance member is necessary.',
    //no desc for this one.
];
//Auction
$Definition['Auction']['notEnoughGold'] = 'Not enough gold.';
$Definition['Auction']['autoCorrect'] = 'Auto corrected.';
$Definition['Auction']['disabledSubmitTooltip'] = 'Gold number is not entered.';
$Definition['Auction']['disabledSubmitTooltip2'] = 'At least 200 silver is needed.';
$Definition['Auction']['enabledSubmitTooltip'] = 'exchange';
$Definition['Auction']['enabledSubmitTooltip2'] = 'Exchange silver to gold';
$Definition['Auction']['maxAmountTooltip'] = 'Buy gold';
$Definition['Auction']['exchange'] = 'exchange';
$Definition['Auction']['Exchange'] = 'Exchange';
$Definition['Auction']['silverExchange'] = 'Exchange office';
$Definition['Auction']['sitterError'] = 'You can\'t access here as a sitter.';
$Definition['Auction']['deletionError'] = 'You can\'t access here since you\'re account is in deletion process.';
$Definition['Auction']['yes'] = 'yes';
$Definition['Auction']['no'] = 'no';
$Definition['Auction']['Confirm sale:'] = 'Confirm sale:';
$Definition['Auction']['You can only have x auctions at a time'] = 'You can only have %s auctions at a time.';
$Definition['Auction']['10AdventuresError'] = 'Finish 10 adventures to unlock the auctions!';
$Definition['Auction']['Finish 10 adventures to unlock the auctions!'] = 'Finish 10 adventures to unlock the auctions!';
$Definition['Auction']['Choose an item to sell An auction can last up to x hours'] = 'Choose an item to sell An auction can last up to %s hours.';
$Definition['Auction']['Finished auctions'] = 'Finished auctions';
$Definition['Auction']['AuctionNotFound'] = 'Auction not found!';
$Definition['Auction']['Really sell this item?'] = 'Really sell this item?';
$Definition['Auction']['Sell [AMOUNT] units?'] = 'Sell [AMOUNT] units?';
$Definition['Auction']['Not enough items available for auction ([MIN_AMOUNT] items)'] = 'Not enough items available for auction ([MIN_AMOUNT] items)';
$Definition['Auction']['Do you want to sell this horse for 100 silver?'] = 'Do you want to sell this horse for 100 silver?';
$Definition['Auction']['You cannot sell your horse!'] = 'You cannot sell your horse!';
$Definition['Auction']['AuctionFinished'] = 'This auction is finished.';
$Definition['Auction']['notEnoughSilverAuctionError'] = 'You don\'t have enough silver. %s silver is needed at least!';
$Definition['Auction']['min'] = 'min';
$Definition['Auction']['bidFor'] = 'Bid for';
$Definition['Auction']['balanceSince'] = 'dealings during the last 7 days';
$Definition['Auction']['cause'] = 'Reason';
$Definition['Auction']['date'] = 'Date';
$Definition['Auction']['showAccounting'] = 'Show accounting details.';
$Definition['Auction']['hideAccounting'] = 'Hide accounting details.';
$Definition['Auction']['noBooking'] = 'Nothing found.';
$Definition['Auction']['Adventure'] = 'Adventure';
$Definition['Auction']['sell x items of y'] = 'sell %s items of %s';
$Definition['Auction']['buy x items of y'] = 'buy %s items of %s';
$Definition['Auction']['currentBid'] = 'Current bid';
$Definition['Auction']['currentBidder'] = 'Current bidder';
$Definition['Auction']['notEnoughSilver'] = 'Not enough silver';
$Definition['Auction']['desc'] = 'description';
$Definition['Auction']['clock'] = 'clock';
$Definition['Auction']['bid'] = 'Auctions';
$Definition['Auction']['noAuction'] = 'No auctions found.';
$Definition['Auction']['Change'] = 'Change';
$Definition['Auction']['del'] = 'delete';
$Definition['Auction']['select all'] = 'select all';
$Definition['Auction']['won'] = 'won';
$Definition['Auction']['outbid'] = 'outbid';
$Definition['Auction']['reserve'] = 'Booking';
$Definition['Auction']['balance'] = 'Balance';
$Definition['Auction']['running'] = 'running';
$Definition['Auction']['x unit perItem'] = 'x unit per unit';
$Definition['Auction']['buy'] = 'buy';
$Definition['Auction']['sell'] = 'sell';
$Definition['Auction']['bids'] = 'bids';
$Definition['Auction']['doBid'] = 'bid';
$Definition['Auction']['accounting'] = 'accounting';
$Definition['Auction']['cancelled'] = 'cancelled';
$Definition['Auction']['finished'] = 'finished';
$Definition['Auction']['filterFor'] = 'Filter for';
$Definition['Auction']['silver'] = 'silver';
$Definition['Auction']['helmet'] = 'helmets';
$Definition['Auction']['body'] = 'body items';
$Definition['Auction']['leftHand'] = 'leftHand items';
$Definition['Auction']['rightHand'] = 'rightHand items';
$Definition['Auction']['shoes'] = 'shoes';
$Definition['Auction']['horse'] = 'horses';
$Definition['Auction']['cage'] = 'cages';
$Definition['Auction']['scroll'] = 'scrolls';
$Definition['Auction']['ointment'] = 'ointments';
$Definition['Auction']['bandage25'] = 'small bandages';
$Definition['Auction']['bandage%s'] = 'bandages';
$Definition['Auction']['bucketOfWater'] = 'Buckets';
$Definition['Auction']['bookOfWisdom'] = 'Book of wisdom';
$Definition['Auction']['lawTables'] = 'Law tablets';
$Definition['Auction']['artWork'] = 'Artworks';
//BBCode
$Definition['BBCode']['this player is registered at x'] = 'This player registered his account on this game world on the %s';
$Definition['BBCode']['this player is under protection to x'] = 'This player is under protection to %s';
$Definition['BBCode']['x has refused a confederacy to y'] = '%s has refused a confederacy to %s.';
$Definition['BBCode']['x has refused nap to y'] = '%s has refused nap to %s.';
$Definition['BBCode']['x has refused war to y'] = '%s has refused war to %s.';
$Definition['BBCode']['confederacies with'] = 'confederacies with';
$Definition['BBCode']['non-aggression pact(s) with'] = 'non-aggression pact(s) with';
$Definition['BBCode']['at war(s) with'] = 'at war(s) with';
$Definition['BBCode']['Forum'] = 'Forum';
$Definition['BBCode']['News'] = 'News';
$Definition['BBCode']['Strength of own alliance'] = 'Strength of own alliance';
$Definition['BBCode']['X kicked Y from Alliance'] = '%s kicked %s from Alliance';
$Definition['BBCode']['Fighting points (difference to yesterday)'] = 'Fighting points (difference to yesterday)';
$Definition['BBCode']['troops destroyed by alliance Ally'] = 'troops destroyed by alliance %s';
$Definition['BBCode']['resources stolen by alliance Ally'] = 'resources stolen by alliance %s';
$Definition['BBCode']['troops destroyed of alliance Ally'] = 'troops destroyed of alliance %s';
$Definition['BBCode']['resources stolen of alliance Ally'] = 'resources stolen of alliance %s';
$Definition['BBCode']['This alliance cannot be found'] = 'This alliance cannot be found';
$Definition['BBCode']['latest postings on forum'] = 'latest postings on forum';
$Definition['BBCode']['Alliance Events'] = 'Alliance events';
$Definition['BBCode']['X joined Alliance'] = '%s has joined the alliance.';
$Definition['BBCode']['X left Alliance'] = '%s left Alliance';
$Definition['BBCode']['X created new village'] = '%s created new village';
$Definition['BBCode']['X invited Y'] = '%s has invited %s into the alliance. ';
$Definition['BBCode']['x has offered a confederacy to y'] = '%s has offered confederacy to %s';
$Definition['BBCode']['x has offered war to y'] = '%s has offered war to %s';
$Definition['BBCode']['x has offered nap to y'] = '%s has offered nap to %s';
$Definition['BBCode']['x has accepted a confederacy to y'] = '%s has accepted a confederacy to';
$Definition['BBCode']['x has accepted nap to y'] = '%s has accepted nap to';
$Definition['BBCode']['x has accepted war to y'] = '%s has accepted war to';
$Definition['BBCode']['Losses compared to alliance'] = 'Losses compared to alliance %s';
$Definition['BBCode']['attack'] = 'Attack';
$Definition['BBCode']['defense'] = 'Defense';
//Buildings
$Definition['Buildings']['increase warehouse storage by level 20 storage value'] = 'increase warehouse storage by level 20 storage value';
$Definition['Buildings']['increase granny storage by level 20 storage value'] = 'increase granny storage by level 20 storage value';
$Definition['Buildings']['Alliance Founder'] = 'Alliance Founder';
$Definition['Buildings']['Alliance'] = 'Alliance';
$Definition['Buildings']['to the alliance'] = 'To the alliance';
$Definition['Buildings']['Tag'] = 'Tag';
$Definition['Buildings']['Name'] = 'Name';
$Definition['Buildings']['FoundAlliance'] = 'Found alliance';
$Definition['Buildings']['accept'] = 'accept';
$Definition['Buildings']['refuse'] = 'refuse';
$Definition['Buildings']['ww_change_name_desc'] = 'WW name';
$Definition['Buildings']['allianceFull'] = 'This alliance has the maximum members count.';
$Definition['Buildings']['Enter Tag'] = 'Enter tag.';
$Definition['Buildings']['Tag exists'] = 'Tag exists.';
$Definition['Buildings']['Enter Name'] = 'Enter name.';
$Definition['Buildings']['Join alliance'] = 'Join alliance';
$Definition['Buildings']['There are no invitations available'] = 'No invitation is currently available.';
$Definition['Buildings']['Buildings'] = 'Building';
$Definition['Buildings']['onOffLevelSwitch'] = 'Show/Hide building levels';
$Definition['Buildings']['maxMasterBuilderReached'] = 'You can have just %s building orders in master builder.';
$Definition['Buildings']['enoughResourcesAt'] = 'Enough resources on %s';
$Definition['Buildings']['constructBuilding'] = 'Construct building';
$Definition['Buildings']['upgradeBuilding'] = 'Upgrade to level %s';
$Definition['Buildings']['waitLoop'] = 'Wait loop';
$Definition['Buildings']['workersBusy'] = 'The workers are already at work.';
$Definition['Buildings']['enoughResourcesAtNever'] = 'Your crop production is negative. So you\'ll not be able to have enough resources.';
$Definition['Buildings']['(not possible)'] = '(not possible)';
$Definition['Buildings']['finishNow']['finishNow'] = 'complete construction immediately';
$Definition['Buildings']['mainBuilding']['Demolish building'] = 'Demolish building';
$Definition['Buildings']['mainBuilding']['demolish_desc'] = 'If you do not need a building any more, you can order your master builders to demolish it';
$Definition['Buildings']['mainBuilding']['demolish'] = 'demolish';
$Definition['Buildings']['mainBuilding']['Demolish completely'] = 'Demolish completely';
$Definition['Buildings']['mainBuilding']['complete_demolish_title'] = 'Immediately demolish the selected building? It will be removed from your village';
$Definition['Buildings']['buildingQueue']['buildingQueue'] = 'buildingQueue';
$Definition['Buildings']['buildingQueue']['name'] = 'Travian PLUS';
$Definition['Buildings']['buildingQueue']['desc'] = 'Travian PLUS allows you to queue one further construction order.';
$Definition['Buildings']['newBuilding']['Infrastructure'] = 'Infrastructure';
$Definition['Buildings']['newBuilding']['Military'] = 'Military';
$Definition['Buildings']['newBuilding']['Resources'] = 'Resources';
$Definition['Buildings']['Infrastructure'] = 'Infrastructure';
$Definition['Buildings']['Military'] = 'Military';
$Definition['Buildings']['resources'] = 'Resources';
$Definition['Buildings']['costsForUpgradeToLvl'] = '<b>Costs</b> for upgrading to level %s';
$Definition['Buildings']['costs'] = 'Costs';
$Definition['Buildings']['errors']['foodShortage'] = 'Food shortage.';
$Definition['Buildings']['errors']['upgradeWareHouse'] = 'Upgrade warehouse.';
$Definition['Buildings']['errors']['upgradeGranny'] = 'Upgrade granny.';
$Definition['Buildings']['errors']['constructWarehouse'] = 'Construct warehouse.';
$Definition['Buildings']['errors']['constructGranny'] = 'Construct granny.';
$Definition['Buildings']['errors']['noGreatArtefact'] = 'You need the artifact to upgrade this building.';
$Definition['Buildings']['errors']['wwPlans'] = 'Wonders of the World can only be erected in one of the old Natarian villages. However, a construction plan is also necessary. Starting with level 50, an additional plan is needed for its completion. The second plan one has to be owned by another player in the same alliance.';
$Definition['Buildings']['construct_with_master_builder'] = 'Construct with master builder';
$Definition['Buildings']['constructNewBuilding'] = 'Construct new building';
$Definition['Buildings']['preRequests'] = 'Prerequisites';
$Definition['Buildings']['no_building_available'] = 'No buildings can be constructed at the moment.<br />Most buildings have certain requirements, to be built. Find out more in the manual.';
$Definition['Buildings']['soon_available'] = 'Soon available buildings';
$Definition['Buildings']['level'] = 'level';
$Definition['Buildings']['upgradeNotices']['reachedMaxLvL'] = 'reached max level.';
$Definition['Buildings']['upgradeNotices']['buildingIsOnDemolition'] = 'This building is under demolition.';
$Definition['Buildings']['upgradeNotices']['upCostsToLevel'] = 'Costs for upgrading to level';
$Definition['Buildings']['upgradeNotices']['currentlyUpgradingToLevel'] = 'Currently upgrading to level %s';
$Definition['Buildings']['upgradeNotices']['currentlyReachingMaxLevel'] = '%s is currently reaching max level.';
$Definition['Buildings']['masterBuilder']['masterBuilder'] = 'Master Builder';
$Definition['Buildings']['masterBuilder']['atStartOfConstruction'] = 'At start of construction';
$Definition['Buildings']['buildingSites']['rallyPoint'] = 'Rallypoint site';
$Definition['Buildings']['buildingSites']['building'] = 'Building site';
$Definition['Buildings']['buildingSites']['WorldWonder'] = 'WW site';
$Definition['Buildings'][1]['title'] = 'Woodcutter';
$Definition['Buildings'][1]['desc'] = 'The woodcutter cuts down trees in order to produce lumber. The further you extend the woodcutter, the more lumber is produced<br><br>By constructing a sawmill, you can further increase the production.';
$Definition['Buildings'][1]['current_prod'] = 'Current production';
$Definition['Buildings'][1]['next_prod'] = 'Production at level';
$Definition['Buildings'][1]['unit'] = 'per hour';
$Definition['Buildings'][2]['title'] = 'Clay Pit';
$Definition['Buildings'][2]['desc'] = 'Clay is produced here. By increasing its level, you increase the clay production.';
$Definition['Buildings'][2]['current_prod'] = 'Current production';
$Definition['Buildings'][2]['next_prod'] = 'Production at level';
$Definition['Buildings'][2]['unit'] = 'per hour';
$Definition['Buildings'][3]['title'] = 'Iron Mine';
$Definition['Buildings'][3]['desc'] = 'Here miners produce the precious resource of iron. By increasing the mine`s level, you increase the iron production.';
$Definition['Buildings'][3]['current_prod'] = 'Current production';
$Definition['Buildings'][3]['next_prod'] = 'Production at level';
$Definition['Buildings'][3]['unit'] = 'per hour';
$Definition['Buildings'][4]['title'] = 'Cropland';
$Definition['Buildings'][4]['desc'] = 'Your population`s food is produced here. By increasing the farm`s level, you increase its crop production.';
$Definition['Buildings'][4]['current_prod'] = 'Current production';
$Definition['Buildings'][4]['next_prod'] = 'Production at level';
$Definition['Buildings'][4]['unit'] = 'per hour';
$Definition['Buildings'][5]['title'] = 'Sawmill';
$Definition['Buildings'][5]['desc'] = 'Lumber cut by your woodcutters is processed here. Based on its level, your sawmill can increase your lumber production by up to 25 percent.';
$Definition['Buildings'][5]['current_prod'] = 'Current increase in production';
$Definition['Buildings'][5]['next_prod'] = 'Increase at level';
$Definition['Buildings'][5]['unit'] = 'percent';
$Definition['Buildings'][6]['title'] = 'Brickyard';
$Definition['Buildings'][6]['desc'] = 'The brickyard converts clay into bricks. Based on its level, your brickyard can increase your clay production by up to 25 percent.';
$Definition['Buildings'][6]['current_prod'] = 'Current increase in production';
$Definition['Buildings'][6]['next_prod'] = 'Increase at level';
$Definition['Buildings'][6]['unit'] = 'percent';
$Definition['Buildings'][7]['title'] = 'Iron Foundry';
$Definition['Buildings'][7]['desc'] = 'The iron foundry melts iron. Based on its level, your iron foundry can increase your iron production by up to 25 percent.';
$Definition['Buildings'][7]['current_prod'] = 'Current increase in production';
$Definition['Buildings'][7]['next_prod'] = 'Increase at level';
$Definition['Buildings'][7]['unit'] = 'percent';
$Definition['Buildings'][8]['title'] = 'Grain Mill';
$Definition['Buildings'][8]['desc'] = 'Here, your grain is ground/milled in order to produce flour. Based on its level, your Grain Mill can increase your crop production by up to 25 percent. ';
$Definition['Buildings'][8]['current_prod'] = 'Current increase in production';
$Definition['Buildings'][8]['next_prod'] = 'Increase at level';
$Definition['Buildings'][8]['unit'] = 'percent';
$Definition['Buildings'][9]['title'] = 'Bakery';
$Definition['Buildings'][9]['desc'] = 'The bakery uses flour to make bread. In conjunction to the grain mill, the increase in crop production can go up to 50 percent in total.';
$Definition['Buildings'][9]['current_prod'] = 'Current increase in production';
$Definition['Buildings'][9]['next_prod'] = 'Increase at level';
$Definition['Buildings'][9]['unit'] = 'percent';
$Definition['Buildings'][10]['title'] = 'Warehouse';
$Definition['Buildings'][10]['desc'] = 'In your warehouse, the resources lumber, clay and iron are stored. By increasing its level, you increase your warehouse\'s capacity.';
$Definition['Buildings'][10]['current_prod'] = 'Current capacity';
$Definition['Buildings'][10]['next_prod'] = 'Capacity at level';
$Definition['Buildings'][10]['unit'] = 'resource units';
$Definition['Buildings'][11]['title'] = 'Granary';
$Definition['Buildings'][11]['desc'] = 'In the granary, the crop produced on your farms is stored. By increasing its level, you increase the granary’s capacity.';
$Definition['Buildings'][11]['current_prod'] = 'Current capacity';
$Definition['Buildings'][11]['next_prod'] = 'Capacity at level';
$Definition['Buildings'][11]['unit'] = 'resource units';
$Definition['Buildings'][13]['title'] = 'Smithy';
$Definition['Buildings'][13]['desc'] = 'The smithy improves the weapons and armour of your troops. By increasing its level, you can order the fabrication of even better weapons and armour. ';
$Definition['Buildings'][14]['title'] = 'Tournament Square';
$Definition['Buildings'][14]['desc'] = 'Your troops can increase their stamina at the tournament square. The further the building is upgraded the faster your troops are beyond a minimum distance of 20 squares.';
$Definition['Buildings'][14]['current_prod'] = 'Current increase speed';
$Definition['Buildings'][14]['next_prod'] = 'increase at level';
$Definition['Buildings'][14]['unit'] = 'percent';
$Definition['Buildings'][15]['title'] = 'Main Building';
$Definition['Buildings'][15]['desc'] = 'The main building is the home of the village\'s master builders. The higher its level, the faster your master builders complete the construction of new buildings. ';
$Definition['Buildings'][15]['current_prod'] = 'Current construction time';
$Definition['Buildings'][15]['next_prod'] = 'Construction time at level';
$Definition['Buildings'][15]['unit'] = 'percent';
$Definition['Buildings'][16]['title'] = 'Rally Point';
$Definition['Buildings'][16]['desc'] = 'Your village\'s troops gather here. From here, you can send them out to conquer, attack, raid or reinforce other villages.';
$Definition['Buildings'][17]['title'] = 'Marketplace';
$Definition['Buildings'][17]['desc'] = 'At the marketplace, you can trade resources with other players. The higher its level, the more resources can be transported at the same time. ';
$Definition['Buildings'][18]['title'] = 'Embassy';
$Definition['Buildings'][18]['desc'] = 'The embassy is a place for diplomats. The higher its level, the more options the king gains.';
$Definition['Buildings'][19]['title'] = 'Barracks';
$Definition['Buildings'][19]['desc'] = 'In the barracks, infantry can be trained. The higher its level, the faster the troops are trained.';
$Definition['Buildings'][20]['title'] = 'Stable';
$Definition['Buildings'][20]['desc'] = 'In the stable, your cavalry is trained. The higher its level, the faster the troops are trained. ';
$Definition['Buildings'][21]['title'] = 'Workshop';
$Definition['Buildings'][21]['desc'] = 'Siege economyengines, like catapults and rams, can be built in the workshop. The higher its level, the faster these units are produced.';
$Definition['Buildings'][22]['title'] = 'Academy';
$Definition['Buildings'][22]['desc'] = 'In the academy, new unit types can be researched. By increasing its level, you can order the research of better units. <br><br> After you researched the units in your academy, you can train them in this village. ';
$Definition['Buildings'][23]['title'] = 'Cranny';
$Definition['Buildings'][23]['desc'] = 'The cranny is used to hide some of your resources when the village is attacked. These resources cannot be stolen. ';
$Definition['Buildings'][23]['current_prod'] = 'Current storage';
$Definition['Buildings'][23]['next_prod'] = 'Storage at level';
$Definition['Buildings'][23]['overall_storage'] = 'Overall storage';
$Definition['Buildings'][23]['unit'] = 'resource unit';
$Definition['Buildings'][24]['title'] = 'Town Hall';
$Definition['Buildings'][24]['desc'] = 'In the town hall, you can hold pompous celebrations. Such a celebration increases your culture points.';
$Definition['Buildings'][25]['title'] = 'Residence';
$Definition['Buildings'][25]['desc'] = 'The residence is a small palace, where the king or queen lives when (s)he visits the village. The residence protects the village against enemies who want to conquer it.';
$Definition['Buildings'][26]['title'] = 'Palace';
$Definition['Buildings'][26]['desc'] = 'The King or Queen of the empire lives in the palace. Only one palace can exist in your realm at a time. You need a palace in order to proclaim a village as your capital.';
$Definition['Buildings'][27]['title'] = 'Treasury';
$Definition['Buildings'][27]['desc'] = 'The riches of your empire are kept in the treasury. Your treasury has room for only one treasure. After you have captured an artefact, it takes 24 hours on a normal server and 12 hours on a 3x speed server for the artefact to become effective. ';
$Definition['Buildings'][28]['title'] = 'Trade Office';
$Definition['Buildings'][28]['desc'] = 'In the trade office, the merchants\' carts get improved and equipped with powerful horses. The higher its level, the more your merchants are able to carry. ';
$Definition['Buildings'][28]['current_prod'] = 'Increase percent';
$Definition['Buildings'][28]['next_prod'] = 'Increase percent at level';
$Definition['Buildings'][28]['unit'] = 'Percent';
$Definition['Buildings'][29]['title'] = 'Great Barracks';
$Definition['Buildings'][29]['desc'] = 'The great barracks allows you to build more units at the same time but they cost thrice the original amount. ';
$Definition['Buildings'][30]['title'] = 'Great Stable';
$Definition['Buildings'][30]['desc'] = 'The great stable allows you to build more units at the same time but they cost thrice the original amount.';
$Definition['Buildings'][31]['title'] = 'City Wall';
$Definition['Buildings'][31]['desc'] = 'By building a city wall, you can protect your village against the barbarian hordes of your enemies. The higher its level, the higher is the bonus given to your forces\' defence. ';
$Definition['Buildings'][31]['current_prod'] = 'Current defense bonus';
$Definition['Buildings'][31]['next_prod'] = 'Defense bonus at level';
$Definition['Buildings'][31]['unit'] = 'percent';
$Definition['Buildings'][32]['title'] = 'Earth Wall';
$Definition['Buildings'][32]['desc'] = 'By building an earth wall, you can protect your village against the barbarian hordes of your enemies. The higher its level, the higher is the bonus given to your forces\' defence.';
$Definition['Buildings'][32]['current_prod'] = 'Current defense bonus';
$Definition['Buildings'][32]['next_prod'] = 'Defense bonus at level';
$Definition['Buildings'][32]['unit'] = 'percent';
$Definition['Buildings'][33]['title'] = 'Palisade';
$Definition['Buildings'][33]['desc'] = 'By building a palisade, you can protect your village against the barbarian hordes of your enemies. The higher its level, the higher is the bonus given to your forces\' defence. ';
$Definition['Buildings'][33]['current_prod'] = 'Current defense bonus';
$Definition['Buildings'][33]['next_prod'] = 'Defense bonus at level';
$Definition['Buildings'][33]['unit'] = 'percent';
$Definition['Buildings'][34]['title'] = 'Stonemason\'s Lodge';
$Definition['Buildings'][34]['desc'] = 'The stonemason\'s lodge is an expert in cutting stone. The further the building is extended the higher the stability of the village\'s buildings. The bonus applies to all buildings, regardless of resource fields, buildings or the wall.';
$Definition['Buildings'][34]['current_prod'] = 'Current stability';
$Definition['Buildings'][34]['next_prod'] = 'Building stability at level';
$Definition['Buildings'][34]['unit'] = 'Percent';
$Definition['Buildings'][35]['title'] = 'Brewery';
$Definition['Buildings'][35]['desc'] = 'Tasty mead is brewed in the brewery and later quaffed by the soldiers during the celebrations. <br><br> These drinks make your soldiers braver and stronger when attacking others (1% per level). Unfortunately, the chiefs’ power of persuasion is decreased and catapults can only do random hits. <br><br> It can only be built by Teutons and only in their capital. It affects the whole empire.';
$Definition['Buildings'][36]['title'] = 'Trapper';
$Definition['Buildings'][36]['desc'] = 'The trapper protects your village with well hidden traps. This means that unwary enemies can be imprisoned and won\'t be able to harm your village any more. ';
$Definition['Buildings'][36]['current_prod'] = 'Current traps number';
$Definition['Buildings'][36]['next_prod'] = 'Traps number at level';
$Definition['Buildings'][36]['unit'] = 'Traps';
$Definition['Buildings'][36]['overall_storage'] = 'Overall traps number';
$Definition['Buildings'][37]['title'] = 'Hero\'s Mansion';
$Definition['Buildings'][37]['desc'] = 'In the hero\'s mansion, you can get an overview of the surrounding oasis. Starting with building level 10, you can occupy oases with your hero and increase the resource production of your village. ';
$Definition['Buildings'][38]['title'] = 'Great Warehouse';
$Definition['Buildings'][38]['desc'] = 'The great warehouse has 3 times the capacity of a normal warehouse. <br><br> This building can only be built in wonder of the world villages or with a special Natarian artefact.';
$Definition['Buildings'][38]['current_prod'] = 'Current capacity';
$Definition['Buildings'][38]['next_prod'] = 'Capacity at level';
$Definition['Buildings'][38]['unit'] = 'resource units';
$Definition['Buildings'][39]['title'] = 'Great Granary';
$Definition['Buildings'][39]['desc'] = 'The great granary has 3 times the capacity of a normal granary. <br><BR> This building can only be built in wonder of the world villages or with a special Natarian artefact.';
$Definition['Buildings'][39]['current_prod'] = 'Current capacity';
$Definition['Buildings'][39]['next_prod'] = 'Capacity at level';
$Definition['Buildings'][39]['unit'] = 'resource units';
$Definition['Buildings'][40]['title'] = 'Wonder Of The World';
$Definition['Buildings'][40]['desc'] = 'The Wonder of the World represents the pride of all architecture. Only the mightiest and richest are able to build such a master work and defend it against envious enemies. <br><br>Wonders of the World can only be erected in one of the old Natarian villages. However, a construction plan is also necessary. Starting with level 50, an additional plan is needed for its completion. The second plan one has to be owned by another player in the same alliance.';
$Definition['Buildings'][41]['title'] = 'Horse Drinking Trough';
$Definition['Buildings'][41]['desc'] = 'The horse drinking trough cares for the well-being of your horses and therefore increases the speed of their training.  <br><br> The horse drinking trough reduces the crop usage for one for the following soldiers: Equites Legati from level 10, Equites Imperatoris from level 15 and Equites Caesaris from level 20. <br ><BR> The horse drinking trough can only be built by Romans..';
$Definition['Buildings'][41]['current_prod'] = 'Current training time';
$Definition['Buildings'][41]['next_prod'] = 'Training time at level';
$Definition['Buildings'][41]['unit'] = 'Percent';

$Definition['Buildings'][42]['title'] = 'Stone Wall';
$Definition['Buildings'][42]['desc'] = 'By building a stone wall, you can protect your village against the barbarian hordes of your enemies. The higher its level, the higher is the bonus given to your forces\' defence. <br>The stone wall can only be built by Egyptians, its defence bonus is like the Gaulish Palisade and its durability is like the Teutonic earth wall.';
$Definition['Buildings'][42]['current_prod'] = 'Current defense bonus';
$Definition['Buildings'][42]['next_prod'] = 'Defense bonus at level';
$Definition['Buildings'][42]['unit'] = 'percent';

$Definition['Buildings'][43]['title'] = 'Makeshift Wall';
$Definition['Buildings'][43]['desc'] = 'By building a makeshift wall, you can protect your village against the barbarian hordes of your enemies. The higher its level, the higher is the bonus given to your forces\' defence. <br/>The makeshift wall can only be built by Huns, its defence bonus is like the Teutonic earth wall and its durability is like the Roman city wall.';
$Definition['Buildings'][43]['current_prod'] = 'Current defense bonus';
$Definition['Buildings'][43]['next_prod'] = 'Defense bonus at level';
$Definition['Buildings'][43]['unit'] = 'percent';

$Definition['Buildings'][44]['title'] = 'Command Center';
$Definition['Buildings'][44]['desc'] = 'The Command Center protects the village against enemy conquests. You can build one Command Center per village. Settlers and Senators/Chiefs/Chieftains/Nomarchs/Logades can be trained there.';

$Definition['Buildings'][45]['title'] = 'Waterworks';
$Definition['Buildings'][45]['desc'] = 'With the Waterworks you regulate the water flow to your oases. This not only helps growing trees and crops, but is also useful for quarries and mines supplying workers with water and transporting resources. <br />This building increases the bonus of all annexed oases. Its maximum effect on level 20 doubles the effect of oases. <br />The Waterworks can only be built by Egyptians.';
$Definition['Buildings'][45]['current_prod'] = 'Current increase in production';
$Definition['Buildings'][45]['next_prod'] = 'Increase at level';
$Definition['Buildings'][45]['unit'] = 'percent';

//Combat
$Definition['combat'] = [
    "simulate" => "Simulate",
    "attacker" => "Attacker",
    "defender" => "Defender",
    "number" => "Number",
    "unit_level" => "Level",
    "other" => "Other",
    "Population" => "Population",
    "catapult_target_level" => "Catapult target",
    "hero_off_bonus" => "Hero(Off bonus)",
    "hero_power" => "Hero(Attack Power)",
    "Palace_Resident" => "Residence/Palace",
    "loyaltyReducedBy" => "Loyalty lowered by",
    "DamageByCatapult" => "Catapult damage",
    "DamageByRam" => "Ram damage",
    "from" => "From",
    "to" => "To",
    "normal" => "Normal",
    "raid" => "Raid",
    "attack_type" => "Attack type",
    "troops" => "Troops",
    "casualties" => "Casualties",
    "attack_settings" => "Attack settings",
    "attack_types" => [
        1 => "Spy",
        2 => "Normal",
        3 => "Raid",
    ],
];
//cropFinder
$Definition['cropFinder']['title'] = 'Crop Finder';
$Definition['cropFinder']['Start position:'] = 'Start position:';
$Definition['cropFinder']['cropper'] = 'cropper';
$Definition['cropFinder']['both'] = 'both';
$Definition['cropFinder']['Type'] = 'Type';
$Definition['cropFinder']['any'] = 'any';
$Definition['cropFinder']['Oasis crop bonus (at least)'] = 'Oasis crop bonus (at least)';
$Definition['cropFinder']['only show unoccupied'] = 'Only show unoccupied';
$Definition['cropFinder']['search'] = 'Search';
$Definition['cropFinder']['Croplands'] = 'Croplands';
$Definition['cropFinder']['distance'] = 'distance';
$Definition['cropFinder']['Position'] = 'Position';
$Definition['cropFinder']['Oasis'] = 'Oasis';
$Definition['cropFinder']['Occupied by'] = 'Occupied by';
$Definition['cropFinder']['Alliance'] = 'Alliance';
$Definition['cropFinder']['noRows'] = 'No croplands found with chosen settings.';
//DailyQuest
$Definition['DailyQuest']['You`ve reached max voting limit Try again later'] = 'You`ve reached maximum daily voting limit. Please try again later.';
$Definition['DailyQuest']['Daily Quests'] = 'Daily Quests ';
$Definition['DailyQuest']['Collect daily rewards'] = 'Collect daily rewards';
$Definition['DailyQuest']['Click for details'] = 'Click for details';
$Definition['DailyQuest']['points'] = 'Points ';
$Definition['DailyQuest']['Collect reward'] = 'Collect reward';
$Definition['DailyQuest']['Overview'] = 'Overview';
$Definition['DailyQuest']['This account is banned'] = 'This account is banned.';
$Definition['DailyQuest']['Congratulations! You have collected enough points to get a reward!'] = 'Congratulations! You have collected enough points to get a reward!';
$Definition['DailyQuest']['For collecting x points today, you receive the following reward'] = 'For collecting %s points today, you receive the following reward';
$Definition['DailyQuest']['For collecting x points today, you can now collect your reward'] = 'For collecting %s points today, you can now collect your reward';
$Definition['DailyQuest']['Your daily reward is determined randomly from these options'] = 'Your daily reward is determined randomly from these options';
$Definition['DailyQuest']['reward_25%_desc'] = 'By collecting 25 points you will receive of one of the following rewards:
<br />
 <ul>
<li>+' . calculate_dailyquest_bonus(200, 'res') . ' resources of each type</li>
<li>+' . calculate_dailyquest_bonus(50, 'exp') . ' hero experience</li>
<li>+' . calculate_dailyquest_bonus(50, 'cp') . ' culture points</li>
<li>+' . calculate_dailyquest_bonus(1000, 'res') . ' resources of one random type</li>
</ul>';
$Definition['DailyQuest']['you collected x points today!'] = 'you collected %s points today!';
$Definition['DailyQuest']['Your Reward:'] = 'Your Reward:';
$Definition['DailyQuest']['reward_25%_rows'][] = '<li> +' . calculate_dailyquest_bonus(200, 'res') . ' resources of each type</li>';
$Definition['DailyQuest']['reward_25%_rows'][] = '<li> +' . calculate_dailyquest_bonus(50, 'exp') . ' hero experience</li>';
$Definition['DailyQuest']['reward_25%_rows'][] = '<li>+' . calculate_dailyquest_bonus(50, 'cp') . ' culture points</li>';
$Definition['DailyQuest']['reward_25%_rows'][] = '<li>+' . calculate_dailyquest_bonus(1000, 'res') . ' resources of one random type</li>';
$Definition['DailyQuest']['x points achieved'] = '%s points achieved.';
$Definition['DailyQuest']['reward_50%_desc'] = 'By collecting 50 points you will receive of one of the following rewards:
<br />
 <ul>
<li> +' . calculate_dailyquest_bonus(86400, 'plus') . ' PLUS Account</li>
<li> +' . calculate_dailyquest_bonus(86400, 'productionBoost') . ' +25% lumber production</li>
<li>+' . calculate_dailyquest_bonus(86400, 'productionBoost') . ' +25% clay production</li>
<li>+' . calculate_dailyquest_bonus(86400, 'productionBoost') . ' +25% iron production</li>
<li>+' . calculate_dailyquest_bonus(86400, 'productionBoost') . ' +25% crop production</li>
</ul>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li> +' . calculate_dailyquest_bonus(86400, 'plus') . ' PLUS Account</li>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li> +' . calculate_dailyquest_bonus(86400, 'productionBoost') . ' +25% lumber production</li>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li> +' . calculate_dailyquest_bonus(86400, 'productionBoost') . ' +25% clay production</li>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li> +' . calculate_dailyquest_bonus(86400, 'productionBoost') . ' +25% iron production</li>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li> +' . calculate_dailyquest_bonus(86400, 'productionBoost') . ' +25% crop production</li>';
$Definition['DailyQuest']['reward_75%_desc'] = 'By collecting 75 points you will receive of one of the following rewards:
<br />
 <ul>
<li>+' . calculate_dailyquest_bonus(5, 'item') . ' ointments</li>
<li>+' . calculate_dailyquest_bonus(5, 'item') . ' tablet of law</li>
<li>+' . calculate_dailyquest_bonus(5, 'item') . ' small bandages </li>
<li>+' . calculate_dailyquest_bonus(5, 'item') . ' cages</li>
<li>+' . calculate_dailyquest_bonus(1, 'adv') . ' additional adventure</li>
</ul>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(5, 'item') . ' ointments</li>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(5, 'item') . ' tablet of law</li>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(5, 'item') . ' small bandages </li>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(5, 'item') . ' cages</li>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(1, 'adv') . ' additional adventure</li>';
$Definition['DailyQuest']['reward_100%_desc'] = 'By collecting 100 points you will receive of one of the following rewards:
<br />
 <ul>
<li>+' . calculate_dailyquest_bonus(400, 'cp') . ' culture points</li>
<li>+' . calculate_dailyquest_bonus(20000, 'res') . ' resources of one random type</li>
<li>+' . calculate_dailyquest_bonus(400, 'exp') . ' hero experience</li>
<li>+' . calculate_dailyquest_bonus(4000, 'res') . ' resources of each type</li>
</ul>';
$Definition['DailyQuest']['reward_100%_rows'][] = '<li>+' . calculate_dailyquest_bonus(400, 'cp') . ' culture points</li>';
$Definition['DailyQuest']['reward_100%_rows'][] = '<li>+' . calculate_dailyquest_bonus(20000, 'res') . ' resources of one random type</li>';
$Definition['DailyQuest']['reward_100%_rows'][] = '<li>+' . calculate_dailyquest_bonus(400, 'exp') . ' hero experience</li>';
$Definition['DailyQuest']['reward_100%_rows'][] = '<li>+' . calculate_dailyquest_bonus(4000, 'res') . ' resources of each type</li>';
$Definition['DailyQuest']['Receive these free rewards every day!'] = 'Receive these free rewards every day!';
$Definition['DailyQuest']['nextResetDesc'] = 'Next reset at %s o´clock. Make sure to collect your reward before!';
$Definition['DailyQuest']['Quest is complete for today'] = 'Quest is complete for today';
$Definition['DailyQuest']['Quest is still open'] = 'Quest is still open.';
$Definition['DailyQuest']['Difficulty'] = 'Difficulty';
$Definition['DailyQuest']['Requirement'] = 'Requirement';
$Definition['DailyQuest']['Overview'] = 'Overview';
$Definition['DailyQuest']['This quest is worth + x points'] = 'This quest is worth + %s points';
$Definition['DailyQuest']['Points granted for this quest: + x / y'] = 'Points granted for this quest: + %s / %s';
$Definition['DailyQuest']['The points for this quest can be achieved x times per day'] = 'The points for this quest can be achieved %s times per day';
$Definition['DailyQuest']['Difficulties'] = [
    "challenging" => 'challenging',
    "hard" => 'hard',
    "moderate" => 'moderate',
];
$Definition['DailyQuest']['questData'] = [
    1 => [
        'name' => 'Complete an adventure',
        'desc' => 'Send your hero on an adventure. This quest is accomplished once your hero arrives, even if it fails to survive the adventure.
To send your hero on an adventure, just click on the icon shown on the image.',
        'difficulty' => 'moderate',
        'Requirement' => 'Available adventure',
    ],
    2 => [
        'name' => 'Raid an unoccupied oasis',
        'desc' => 'Send troops to raid an unoccupied oasis. This quest is accomplished once your army arrives, even if it is killed during the fight. Using cages to avoid the combat will not grant you any points for this quest.
You can calculate the outcome of the raid by using the combat simulator. You can find it within your rally point.',
        'difficulty' => 'hard',
        'Requirement' => '(Lots of) troops',
    ],
    3 => [
        'name' => 'Raid/attack a Natarian village',
        'desc' => 'Send troops to raid/attack a Natarian village. This quest is accomplished once your army arrives, even if it is killed during the fight.
You should not try to raid/attack a Wonder of the World village controlled by the Natarian tribe before you have gathered at least 100,000 troops.
<br />',
        'difficulty' => 'challenging',
        'Requirement' => '(Lots of) troops',
    ],
    4 => [
        'name' => 'Win an auction',
        'desc' => 'Participating in an auction will let you win twice - first when you win the auction and gain the item you want and second when you collect points for your daily rewards balance.
The points will be awarded once you win any auction you bid on.
<br />',
        'difficulty' => 'challenging',
        'Requirement' => 'Complete 10 adventures',
    ],
    5 => [
        'name' => 'Gain or spend gold',
        'desc' => 'To achieve the points for this quest, you need to either gain or spend gold. It is up to you to decide how and for what benefit you want to gain/use any amount of your gold balance.
<br />',
        'difficulty' => 'moderate',
        'Requirement' => 'None',
    ],
    6 => [
        'name' => 'Upgrade a building',
        'desc' => 'To achieve the points for this quest, you need to either upgrade an existing building or build a new one.
The points will be granted once the construction is completed.
<br />',
        'difficulty' => 'moderate',
        'Requirement' => 'Resources',
    ],
    7 => [
        'name' => 'Upgrade a resource field',
        'desc' => 'To achieve the points for this quest, you need to either upgrade an existing resource field or build a new one.
The points will be granted once the construction is completed.
<br />',
        'difficulty' => 'moderate',
        'Requirement' => 'Resources',
    ],
    8 => [
        'name' => 'Build 20 infantry units of one type at once',
        'desc' => 'To achieve the points for this quest, you need to order the training of 20 infantry units in your barracks at once.
Please be aware that infantry units already in the training queue will not grant you any points for this quest.
<br />',
        'difficulty' => 'challenging',
        'Requirement' => 'Barracks',
    ],
    9 => [
        'name' => 'Build 20 cavalry units of one type at once',
        'desc' => 'To achieve the points for this quest, you need to order the training of 20 cavalry units in your stable at once.
Please be aware that cavalry units already in the training queue will not grant you any points for this quest.
<br />',
        'difficulty' => 'challenging',
        'Requirement' => 'Stable',
    ],
    10 => [
        'name' => 'Hold a small or big celebration ',
        'desc' => '
Hold a small or big celebration
Hold one small or big celebration in your town hall.
<br/>
The points will be granted when you hold any celebration. Already running celebrations do not grant you any points.
<br/>',
        'difficulty' => 'hard',
        'Requirement' => '3 Town Halls',
    ],
    11 => [
        'name' => 'Contribute %s resources to an alliance bonus',
        'desc' => 'To support your alliance you can contribute resources to an alliance bonus. Once your alliance collected enough contributions to unlock or level up an alliance bonus, the whole alliance benefits from its effect. This quest is accomplished once you\'ve contributed to any alliance bonus.',
        'difficulty' => 'challenging',
        'Requirement' => 'Alliance membership',
    ],
];
$Definition['DailyQuest']['VotingSystemTitle'] = 'Earn free gold!';
$Definition['DailyQuest']['Vote'] = 'Vote';
$Definition['DailyQuest']['VoteRewardDesc'] = 'Each vote +10 <img class="gold" src="img/x.gif"> will be give you.';
$Definition['DailyQuest']['Earn free gold!!!'] = 'Earn free gold!!!';
$Definition['DailyQuest']['Click on Consultant to open Hints page'] = 'Click on Consultant to open Hints page';
$Definition['DailyQuest']['if you abuse the vote system you will be banned'] = 'if you abuse the vote system you will be banned.';
$Definition['DailyQuest']['voteQuestDescription'] = 'You can earn some free gold by completing a vote process. <br> You must click on the image below to be taken to vote';
//Dorf1
$Definition['Dorf1']['units'] = 'Troops';
$Definition['Dorf1']['none'] = 'none';
$Definition['Dorf1']['production']['production per hour'] = 'Production per hour';
$Definition['Dorf1']['production']['resources'][1] = 'Lumber';
$Definition['Dorf1']['production']['resources'][2] = 'Clay';
$Definition['Dorf1']['production']['resources'][3] = 'Iron';
$Definition['Dorf1']['production']['resources'][4] = 'Crop';
$Definition['Dorf1']['production']['productionBoostButton'] = 'More information in production bonus.';
$Definition['Dorf1']['movements']['incoming'] = 'Incoming troops';
$Definition['Dorf1']['movements']['outgoing'] = 'Outgoing troops';
$Definition['Dorf1']['movements']['hour'] = 'hour';
$Definition['Dorf1']['movements']['in'] = 'in ';
$Definition['Dorf1']['movements']['incomingAttacksToOases'] = 'Incoming attacks to my oasis';
$Definition['Dorf1']['movements']['incomingAttacksToMe'] = 'Incoming attacks to me';
$Definition['Dorf1']['movements']['reinforcement'] = 'Rein.';
$Definition['Dorf1']['movements']['incomingReinforcements'] = 'Incoming reinforcements';
$Definition['Dorf1']['movements']['incomingReinforcementsToMyOases'] = 'Incoming reinforcements to my oasis';
$Definition['Dorf1']['movements']['outGoingAttacks'] = 'Own attacks';
$Definition['Dorf1']['movements']['attack'] = 'Attack(s)';
$Definition['Dorf1']['movements']['outGoingReinforcements'] = 'Own reinforcements';
$Definition['Dorf1']['movements']['adventure'] = 'Adventure';
$Definition['Dorf1']['movements']['outGoingAdventure'] = 'Hero is on adventure.';
$Definition['Dorf1']['movements']['evasion'] = 'Evasion';
$Definition['Dorf1']['movements']['settlers'] = 'Settlers';
$Definition['Dorf1']['movements']['settlersOnTheWay'] = 'Settlers on the way';
$Definition['Dorf1']['movements']['outGoingEvasion'] = 'Own troops evasion';
//embassyWhite
$Definition['embassyWhite']['embassy'] = 'Embassy';
$Definition['embassyWhite']['invites to you:'] = 'Invites to you:';
$Definition['embassyWhite']['max embassy level:'] = 'Max Embassy level: ';
$Definition['embassyWhite']['construct an embassy'] = 'construct an embassy';
$Definition['embassyWhite']['Alliance forum'] = 'Alliance forum';
$Definition['embassyWhite']['Alliance overview'] = 'Alliance overview';
$Definition['embassyWhite']['no alliance'] = 'No alliance';
$Definition['embassyWhite']['You are currently not part of any alliance'] = 'You are currently not part of any alliance';
//ExtraModules
$Definition['ExtraModules'] = [
    'addFarmsNearby' => 'Add %sx%s nearby farms',
    'addFarms' => 'Automatically add unique 100 farms',
    'addFarmsIsDisabledTill' => 'This feature is disabled till %s.',
    'buyAdventure' => 'Find Adventure',
    'upgradeToMaxLevel' => 'Upgrade to max level',
    'upgradeStorageToMaxLevel' => 'Upgrade to max level',
    'increaseStorage' => 'Increase storage',
    'smithyMaxLevel' => 'Upgrade to max level',
    'smithyUpgradeAllToMax' => 'Upgrade all to max level',
    'academyResearchAll' => 'Research all units',
    'finishTraining' => 'Finish all training',
    'Used %s of %s' => 'Used %s of %s',
    'Feature limit reached' => 'Feature limit reached.',
    'Errors' => [
        'WWDisabled' => 'You can\'t use this feature in WW Villages.',
        'Feature limit reached' => 'Feature limit reached.',
    ],
];
//Farmlist
$Definition['FarmList'] = [
    'You can only have one autoraid per account' => 'You can only have one autoraid per account.',
    'Auto raid On' => 'Auto raid On',
    'Auto raid Off' => 'Auto raid Off',
    'Auto raid costs %s silver(s) every %s seconds when it hits the farmlist' => 'Auto raid costs %s <img class="silver" src="img/x.gif"> which randomly attacks farmlist in a while.',
    "System: You must wait some time before sending another raid" => "System: You must wait some time before sending another raid.",
    "nameTooLong" => "Name is too long.",
    "enterListName" => "Enter list name.",
    "nameIsNotUnique" => "This name is taken. name must be unique by village.",
    "nRaidsMade" => "%s raids made.",
    "delete" => "Delete",
    "choose_village" => "Choose a village",
    "add" => "Add",
    "addRaid" => "Add raid",
    "editRaid" => "Edit raid",
    "choose_target" => "Select target",
    "FarmList" => "Farm list",
    "reallyDelete" => "Really delete?",
    "raidList" => "Raid list",
    "lastTargets" => "Last targets",
    "create_new_list" => "Create new list",
    "rename_list" => "Rename list",
    "rename" => "Rename",
    "Village" => "Village",
    "pop" => "Inh.",
    "distance" => "Distance",
    "troops" => "Troops",
    "lastRaid" => "Last raid",
    "name" => "Name",
    "create" => "Create",
    "checkAll" => "Check all",
    "startRaid" => "Start raid",
    "details" => "Details",
    "occupiedOasis" => "Occupied oasis",
    "unoccupiedOasis" => "Unoccupied oasis",
    "edit" => "Edit",
    "outGoingAttack" => "Own attacks",
    "noSlot" => "No farm is added to list.",
    "noVillageInTarget" => "No village found in these coordinates.",
    "noTroopsSelected" => "No troops selected.",
    "sameVillageEntered" => "You can't attack your current selected village.",
    "errorWorldWonderVillage" => "You can't attack this village.",
    "slotsFull" => "All slots in use.",
    'editAllSlotsRaid' => 'Edit all slots',
    'Attack_iReport1' => 'Attack to <img src=\'img/x.gif\' class=\'iReport iReport1\'/><img src=\'img/x.gif\' class=\'iReport iReport2\'/><img src=\'img/x.gif\' class=\'iReport iReport3\'/>',
    'Attack_iReport2' => 'Attack to <img src=\'img/x.gif\' class=\'iReport iReport1\'/>',
    'Attack_iReport3' => 'Attack to <img src=\'img/x.gif\' class=\'iReport iReport1\'/><img src=\'img/x.gif\' class=\'iReport iReport2\'/> except which are totally defended.',
    'Attack_att3' => '<img src=\'img/x.gif\' class=\'att3\'/><br /> Attack randomly when your troops are lower than total list sum.',
    'underProtection' => 'You cannot attack other players while your beginner\'s protection is active.',
    'You attacked %s seconds ago, you need to wait %s seconds before sending another raid' => 'Your last attack was sent %s seconds ago. You need to wait %s seconds to send another raid.',
];

use Core\Helper\WebService;
$Definition['Global']['Building settings'] = 'Building settings';
$Definition['Global']['Times'] = 'Times';
$Definition['Global']['Unlimited'] = 'Unlimited';
$Definition['Global']['Hour'] = 'Hour';
$Definition['Global']['Day'] = 'Day';
$Definition['Global']['Minute'] = 'Minute';
$Definition['Global']['Second'] = 'Second';
$Definition['Global']['This tab is set as favourite'] = 'This tab is set as favourite';
$Definition['Global']['Select tab %s as favourite'] = 'Select tab %s as favourite';
$Definition['Global']['loadingData'] = 'Loading...';

$Definition['Global']['registration_startgame_message_subject'] = 'Subject';
$Definition['Global']['registration_startgame_message_message'] = '';


$Definition['Global']['Newsletter_NewServer_subject'] = 'New %s %sx Server';
$Definition['Global']['Newsletter_NewServer_content'] = '<strong> Hello</strong>,
<br/>
<br/>
<br/>
Your time has come!
<strong>Today we are launching a new <a href="[REGISTRATION_URL]" style="color:#f88c1f;" target="_blank"
                                        title="Travian"> server</a> for Travian</strong>. Ascend into the pantheon of Travian’s strongest and bravest warriors!
<br/>
<br/>
<div align="center">
    <a href="[REGISTRATION_URL]" target="_blank" title="Play now">
        <img alt="Play now" height="47" src="[INDEX_URL]img/Webstart/Play_Now_Button_x120_rot_EN.jpg"
             style="border-width: 0px; border-style: solid;" title="Play now" width="120"/></a>
</div>
<br/>
The struggle for artifacts and legendary wonders of the world is renewed.
<br/>
<br/>
<strong><a href="[REGISTRATION_URL]" style="color:#f88c1f;" target="_blank" title="Travian">Begin a new battle now</a></strong> and join a powerful alliance. Don’t lose any time!<br/>
<br/>Become the strongest player of Travian!<br/><br/><strong>Your Travian Team<br/><br/><br/><br/></strong>';
$Definition['Global']['Languages'] = [
    'en' => 'en',
    'ir' => 'ir',
];
$Definition['Global']['edit'] = 'edit';
$Definition['Global']['ms'] = 'ms';
$Definition['Global']['ns'] = 'ns';
$Definition['Global']['Best regards,The Travian Team'] = 'Best regards,<br />The Travian Team';
$Definition['Global']['FreeGoldTitle'] = 'Free gold';
$Definition['Global']['FreeGold'] = "Dear player,\n\n%s gold added to your account.\n\n Regards,\n\nTravian Team";
$Definition['Global']['BuyGoldSubject'] = 'Transmission Completed';
$Definition['Global']['BuyGoldText'] = 'Transmission Completed Successfully' . PHP_EOL . PHP_EOL . '%s golds added to your account.' . PHP_EOL . PHP_EOL . "Your tracking code is: %s" . PHP_EOL . PHP_EOL . "Regards,\nTravian Team";
$Definition['Global']['voucherTitle'] = 'Transmission Completed';
$Definition['Global']['voucherText'] = 'Your voucher code used and gold transferred to your account.' . PHP_EOL . PHP_EOL . '%s golds added to your account.' . PHP_EOL . PHP_EOL . "Your tracking code is: %s" . PHP_EOL . PHP_EOL . "Regards,\nTravian Team";
$Definition['Global']['Travian'] = 'Travian';
$Definition['Global']['Farm'] = 'Farm';
$Definition['Global']['Farms'] = 'Farms';
$Definition['Global']['The process may take some time Please wait'] = 'The process may take some time. Please wait.';
$Definition['Global']['Loading'] = 'Loading';
$Definition['Global']['Contact admin'] = 'Contact support';
$Definition['Global']['VoucherEmailSubject'] = 'Travian voucher code';
$Definition['Global']['VoucherEmailMessage'] = 'Dear Player,<br />You recently deleted your account on travian and you have bought some travian golds.<br /><br />You can now recieve your gold to another account in travian games with the code below <br /> Voucher code: %s<br /><br />Regards, Travian Team';
$Definition['Global']['FAQ'] = 'FAQ';
$Definition['Global']['cropfinder']['no results found'] = 'no results found.';
$Definition['Global']['today'] = 'Today';
$Definition['Global']['yesterday'] = 'Yesterday';
$Definition['Global']['tomorrow'] = 'tomorrow';
$Definition['Global']['x days later'] = '%s days later';
$Definition['Global']['x days past'] = '%s days past';
$Definition['Global']['Dear [PlayerName],'] = 'Dear %s,';
$Definition['Global']['beforeyesterday'] = 'The day before yesterday';
$Definition['Global']['newVillageName'] = 'New village';
$Definition['Global']['moreInformation'] = 'More information';
$Definition['Global']['Hello x'] = 'Hello %s,';
$Definition['Global']['continue'] = 'continue';
$Definition['Global']['gold'] = 'gold';
$Definition['Global']['silver'] = 'silver';
$Definition['Global']['convertedTo'] = 'Converted to';
$Definition['Global']['Login'] = 'Login';
$Definition['Global']['Register'] = 'Register';
$Definition['Global']['Support'] = 'Support';
$Definition['Global']['Wilderness'] = 'Wilderness';
$Definition['Global']['OccupiedOasis'] = 'Occupied oasis';
$Definition['Global']['unOccupiedOasis'] = 'Unoccupied oasis';
$Definition['Global']['Abandoned valley'] = 'Abandoned valley';
$Definition['Global']['Player not found'] = 'Player not found';
$Definition['Global']['Alliance not found'] = 'Alliance not found';
$Definition['Global']['Invalid Report ID'] = 'Invalid Report ID';
$Definition['Global']['Invalid private key'] = 'Invalid private key';
$Definition['Global']['General']['instructions'] = 'instructions';
$Definition['Global']['General']['description'] = 'Description';
$Definition['Global']['General']['ok'] = 'ok';
$Definition['Global']['General']['cancel'] = 'cancel';
$Definition['Global']['General']['close'] = 'close';
$Definition['Global']['General']['or'] = 'or';
$Definition['Global']['General']['closeWindow'] = 'Close window';
$Definition['Global']['General']['level'] = 'level';
$Definition['Global']['General']['in'] = 'in';
$Definition['Global']['General']['at'] = 'at';
$Definition['Global']['General']['endat'] = 'End at';
$Definition['Global']['General']['hour'] = 'hour';
$Definition['Global']['General']['startat'] = 'Start in';
$Definition['Global']['General']['duration'] = 'duration';
$Definition['Global']['General']['cost'] = 'cost';
$Definition['Global']['General']['perHour'] = 'per hour';
$Definition['Global']['General']['save'] = 'save';
$Definition['Global']['NatarsName'] = 'Natars';
$Definition['Global']['playerVillageName'] = "%s's village";
$Definition['Global']['wwName'] = 'WW Village';
$Definition['Global']['NatureName'] = 'Nature';
$Definition['Global']['races'][1] = 'Romans';
$Definition['Global']['races'][2] = 'Teutons';
$Definition['Global']['races'][3] = 'Gauls';
$Definition['Global']['races'][4] = 'Nature';
$Definition['Global']['races'][5] = 'Natars';
$Definition['Global']['races'][6] = 'Egyptians';
$Definition['Global']['races'][7] = 'Huns';
$Definition['Global']['UnloadHelper']['message'] = 'You have made changes. Do you really want to leave this page?';
$Definition['Global']['Footer']['FAQ'] = 'FAQ - Answers';
$Definition['Global']['Footer']['Credits'] = 'Credits';
$Definition['Global']['Footer']['HomePage'] = 'Homepage';
$Definition['Global']['Footer']['Forum'] = 'Forum';
$Definition['Global']['Footer']['Links'] = 'Links';
$Definition['Global']['Footer']['Terms'] = 'Terms';
$Definition['Global']['Footer']['Imprint'] = 'Imprint';
$Definition['Global']['Footer']['Register'] = 'REGISTER';
$Definition['Global']['SUPPORT_MESSAGE_EXTRA_THINGS'] = '<br /><br />-----<br />ATTENTION: We would like to invite you to help improve our support! <br />It would be great if you can spare a few minutes to fill out a short survey!<br />To the survey: <a target="_blank" href="http://goto.traviangames.com/t-com">http://goto.traviangames.com/t-com</a><br />-----<br /><br />T4 Travian online help: <a target="_blank" href="http://t4.answers.travian.com/">http://t4.answers.travian.com/</a><br />T2.5/T3 Travian online help: <a target="_blank" href="http://t3.answers.travian.com/">http://t3.answers.travian.com/</a><br />Web: <a target="_blank" href="http://www.travian.com/">http://www.travian.com/</a><br />Email: <a href="mailto:admin@' . WebService::getJustDomain() . '">admin@' . WebService::getJustDomain() . '</a><br /><br />--<br />Travian Games GmbH<br />Wilhelm-Wagenfeld-Straße 22<br />80807 München<br />Germany<br /><br /><a target="_blank" href="http://www.traviangames.com">http://www.traviangames.com</a><br /><br />CEO: Lars Janssen<br /><br />Registration court: Munich district court<br />Business license number: HRB 173511<br /><br />Tax ID number: DE 246258085<br />–<br />This email and its attachments are strictly confidential and are intended<br />solely for the attention of the person to whom it is addressed. If you are<br />not the intended recipient of this email, please delete it including its<br />attachments immediately and inform us accordingly.<br />–<br /><br /><br />-----<br /><br /><br />';
$Definition['Global']['SUPPORT_MESSAGE_EXTRA_THINGS_UNIQUE_FINDER'] = 'ATTENTION: We would like to invite you to help improve our support!';
$Definition['Global']['INVITATION_WITH_PRE_REGISTRATION_CODE_EMAIL_SUBJECT'] = 'New server is coming';
$Definition['Global']['INVITATION_WITH_PRE_REGISTRATION_CODE_EMAIL'] = '<strong>Hello [EMAIL]</strong>,
<br />
<br />Your time has come! <strong>Today we are launching</strong>
<strong><a href="[GAME_WORLD_URL_REGISTRATION]" style="color:#f88c1f;" target="_blank" title="Travian">server [WORLD_ID]</a></strong>
<strong>for Travian. </strong>
Ascend into the pantheon of Travian’s strongest and bravest warriors!
<br />
<br />
<div align="left">
    <a href="[GAME_WORLD_URL_REGISTRATION]" target="_blank" title="Play now">
        <img alt="Play now" height="47" src="[GAME_WORLD_URL]img/en/Play_Now_Button_x120_rot_EN.jpg" style="border-width: 0px; border-style: solid;" title="Play now" width="120" />
    </a>
</div>
<br />The struggle for artifacts and legendary wonders of the world is renewed
<br />
<br />
<strong>
    <a href="[GAME_WORLD_URL_REGISTRATION]" style="color:#f88c1f;" target="_blank" title="Travian">Begin a new battle now</a>
</strong> and join a powerful alliance Don’t lose any time!
<br />
<br />Become the strongest player of Travian!
<br />
<p>Your preregistration code is: [PRE_REGISTRATION_CODE]</p>
<br />
<strong>Your Travian Team</strong>';
$Definition['Global']['WWPlansReleaseMessage'] = '
Countless days have passed since the first battles upon
the walls of the cursed villages of the dreaded Natars,
many armies of both the free ones and the Natarian empire
struggled and died before the walls of the many
strongholds from which the Natars had once ruled all
creation. Now with the dust settled and as a tentative
sense of calm spread among the remaining soldiers, armies
began to count their losses and collect their dead, the
stench of combat still lingering in the night air, a smell
of a slaughter unforgettable in its extent and brutality
soon to be dwarfed by yet others. The largest armies of
the free tribes were preparing for another attack, and the
fearsome Natars were marshalling their defences for yet
another renewed assault upon the coveted former
strongholds of the Natarian Empire.
<br><br>
Soon, scouts arrived with tales of a most awesome sight
and a chilling reminder; a dreaded army of an unfathomable
size had been spotted treading its path towards the very
end of the world, the Natarian capital, a force so great
that the dust from their march would choke off all light,
a force so brutal and ruthless that it would crush all
hope. The free people knew thay they had to do the
impossible; race against time and the endless hordes of
the Natarian Empire to raise a Wonder of the World in
order to restore peace to the world and vanquish the
Natarian threat once and for all.
<br><br>
But to raise such a great Wonder would be no easy task;
one would need construction plans created and long
forgotten in the distant past, plans of such an arcane
nature that even the very wisest of sages knew not their
contents or locations.
<br><br>
Tens of thousands of scouts roamed across all existence
searching in vain for these mystical plans, looking in all
places but the dreaded Natarian Capital, yet could not
find them. Today however, they return baring good news;
the locations of the plans have finally been discovered,
concealed by the armies of the Natars inside secret
strongholds, purposefully constructed to be hidden from
the eyes of man.
<br><br>
Now begins the final stretch, when the greatest armies of
the free peoples and the Natars will clash upon the
largest battlefields of the world to decide the fate of
all that lies under heaven. Sword against sword, this is
the war that will echo across the eons; this is your war,
and here you shall etch your name across history. Here you
shall become legend...
<br><br>
<span style="font-size:60%; color: #666;">(Story by
Grozoth)</span>
<br><br>
<br><br>
<b>Facts:</b><i>To steal one, the following things must
happen:</i><br>
<li>You must attack the village (NO Raid!)</li>
<li>WIN the Attack</li>
<li>Destroy the treasury</li>
<li>Hero must participate in an attack</li>
<li>An empty treasury level 10 MUST be in the village
where that attack came from</li>
<br><br>
If not, the next attack on that village, winning with a
hero and empty treasury will take the building plan.
<br><br>
To build a WW, you must own a plan yourself (you = the WW
village owner) from level 0 to 49, from 50 to 100 you need
an additional plan, belonging to a player in your
alliance! Two Plans in the WW village account won´t work!
';
$Definition['Global']['WWConstructStart'] = $Definition['Global']['WWPlansReleaseMessage'];
$Definition['Global']['ArtifactsReleaseMessage'] = <<<HTML_ENTITIES
<div style="width:450px; height:830px; padding: 95px 60px
60px 25px; background:
url(img/Natars_Banner_gross.jpg)
no-repeat;">
        <center>
            <h1>Artefacts</h1>
            <p style="font-size:85%; text-align:justify; width:400px">
                Whispered rumours echo throughout the villages, pertaining
                legends told only by the best of storytellers. They
                concern the Natars, Travian’s most fearsome warriors. It
                is every hero’s dream to slay them, every soldier’s goal.
                No one knows how the Natars grew to be so powerful, their
                soldiers so fearsome. Determined to discover the source of
                their power, an elite group of scouts is sent out to spy
                on them.  They return a few hours later with terrified
                faces and wild theories: it seems the Natars’ power comes
                from mysterious items they call artefacts, which they had
                stolen from your ancestors. Manage to steal the artefacts,
                they say, and you can steal their power.
                <br><br><img src="img/msg.jpg"
                             alt="Artefacts" width="400" height="200" style="float:
right">
                <br><br>
                The time has come to reclaim the artefacts. Conspire with
                your alliance and assemble your warriors to retrieve these
                coveted objects. However, the Natars will not give the
                artefacts up without a fight… and neither shall your
                enemies. If you can manage to successfully repossess the
                artefacts and fend off your enemies, then you will be able
                to reap the rewards. Your buildings shall become
                incredibly strong and powerful, your troops much faster
                and more crop-efficient. Seize the artefacts, bring glory
                to your empire, and become the new legends for your
                successors.
            </p><br/><br/>
<span style="font-size:60%; color: #666;">(Story by
Cryptid_Hunter)</span>
</center>
</div>
HTML_ENTITIES;
/*$Definition['Global']['ServerFinishWinner'] = 'Dear Travian players,
<br><br>
<img src="/img/ww100.png" style="float:right;">
All good things must come to an end, and so too must this
age. Once Solomon was given a ring, upon which was
inscribed a message that could take away all the joys or
sorrows of the world, that message was roughly translated,
“this too shall pass”. It is both our joy and sorrow to
announce to all Travian players that this too has now
passed! We hope you enjoyed your time with us as much as
we enjoyed serving you and thank you for staying until the
very end!
<br><br>
The results:
Day had long since passed into night, yet the workers of
the village <i><b>%s</b></i>, laboured on throughout
the wintery eve, ever wary of the countless armies
marching to destroy their work, knowing that they raced
against time and the greatest threat that had ever faced
the free tribes. Their tireless struggles were rewarded at
<b>11:12 pm</b> after a nameless worker laid the final
stone in what will be forever known as the greatest and
most magnificent creation in all of history since the fall
of the Natars.
<br><br>
Together with the alliance <i>"<b>%s.</b>"</i>, <i>"
<b>%s</b>"</i> was the first to finish the Wonder of the
World, using millions of resources whilst also protecting
it with hundreds of thousands of brave defenders. It is
therefore <i>"<b>%s</b>"</i> who receives the title
"winner of this era"!
<br><br>
<i>"<b>%s</b>"</i> was ruler over the largest personal
empire, followed closely by <i>"<b>%s</b>"</i> and <i>"
<b>%s</b>"</i>.
<br>
<i>"<b>%s</b>"</i> slew more than any other, and was
the mightiest, most fearsome commander.
<br>
<i>"<b>%s</b>"</i> was the most glorious defender,
slaughtering enemies at the village gates, staining the
lands around those villages with their blood.
<br><br>
Best regards,<br>
Your Travian-Team
<br><br>
<span style="font-size:60%; color: #666;">(Story by
Grozoth)</span>';*/
$Definition['Global']['NatarsAreBuildingWW'] = '<center><span style="text-align: center; color: red;"><b>Important news</b></span></center><br />OMG, We were notified that <font color="blue"><b>Natars</b></font> found the power to build the Wonder of the world and they are upgrading that very fast (%s level(s) per %s).<img src="/img/natars.jpg" style="float:right;"><br><br><br /><br />With their power we can\'t destroy them and we must increase our upgrading speed to win the <font color="blue"><b>Natars</b></font>.';
$Definition['Global']['ServerFinishWinner'] = 'Dear Travian players,
<br><br>
<img src="/img/ww100.png" style="float:right;">
All good things must come to an end, and so too must this
age. Once Solomon was given a ring, upon which was
inscribed a message that could take away all the joys or
sorrows of the world, that message was roughly translated,
“this too shall pass”. It is both our joy and sorrow to
announce to all Travian players that this too has now
passed! We hope you enjoyed your time with us as much as
we enjoyed serving you and thank you for staying until the
very end!
<br><br>
The results:
Day had long since passed into night, yet the workers of
the village <i><b>%s</b></i>, laboured on throughout
the wintery eve, ever wary of the countless armies
marching to destroy their work, knowing that they raced
against time and the greatest threat that had ever faced
the free tribes. Their tireless struggles were rewarded
after a nameless worker laid the final stone in what
will be forever known as the greatest and most magnificent
creation in all of history since the fall
of the Natars.
<br><br>
Together with the alliance <i>"<b>%s.</b>"</i>, <i>"
<b>%s</b>"</i> was the first to finish the Wonder of the
World, using millions of resources whilst also protecting
it with hundreds of thousands of brave defenders. It is
therefore <i>"<b>%s</b>"</i> who receives the title
"winner of this era"!
<br><br>
<i>"<b>%s</b>"</i> was ruler over the largest personal
empire, followed closely by <i>"<b>%s</b>"</i> and <i>"
<b>%s</b>"</i>.
<br>
<i>"<b>%s</b>"</i> slew more than any other, and was
the mightiest, most fearsome commander.
<br>
<i>"<b>[DEFENDER]</b>"</i> was the most glorious defender,
slaughtering enemies at the village gates, staining the
lands around those villages with their blood.
<br><br>
Best regards,<br>
Your Travian-Team
<br><br>
<span style="font-size:60%; color: #666;">(Story by
Grozoth)</span>';
$Definition['Global']['ServerFinishNoWinner'] = 'Dear Travian players,
<br><br>
<img src="/img/ww100.png" style="float:right;">
All good things must come to an end, and so too must this
age. Once Solomon was given a ring, upon which was
inscribed a message that could take away all the joys or
sorrows of the world, that message was roughly translated,
“this too shall pass”. It is both our joy and sorrow to
announce to all Travian players that this too has now
passed! We hope you enjoyed your time with us as much as
we enjoyed serving you and thank you for staying until the
very end!
<br><br>
The results:
The players did their best to lvl up WonderOfTheWorld but natars built that faster.
So the winner is Natars.
<br><br>
<i>"<b>%s</b>"</i> was ruler over the largest personal
empire, followed closely by <i>"<b>%s</b>"</i> and <i>"
<b>%s</b>"</i>.
<br>
<i>"<b>%s</b>"</i> slew more than any other, and was
the mightiest, most fearsome commander.
<br>
<i>"<b>[DEFENDER]</b>"</i> was the most glorious defender,
slaughtering enemies at the village gates, staining the
lands around those villages with their blood.
<br><br>
Best regards,<br>
Your Travian-Team
<br><br>
<span style="font-size:60%; color: #666;">(Story by
Grozoth)</span>';
$Definition['Global']['SUPPORT_MESSAGE_EXTRA_THINGS'] = '<br /><br />';
$Definition['Global']['SUPPORT_MESSAGE_EXTRA_THINGS_UNIQUE_FINDER'] = '<br />';
$Definition['Global']['GoldPromotionPublicMsg'] = '<font color="#998200" size="4"><b>Gold Promotion!!!</b></font><br /><br />This Gold promotion will happen between %s till %s.<br /><br />All gold purchased during this time will give you <b>20%%</b> more gold than usual.';
//GoldHelper
$Definition['GoldHelper']['exchangeResources']['exchangeResources'] = 'Exchange resources';
$Definition['GoldHelper']['exchangeResources']['error_in_ww'] = 'You can\'t use this feature in WW Villages.';
$Definition['GoldHelper']['exchangeResources']['error_no_marketplace'] = 'Build marketplace';
$Definition['GoldHelper']['exchangeResources']['error_low_pop'] = 'You must have at least 40 pop';
$Definition['GoldHelper']['exchangeResources']['error_low_resources'] = 'You must have at least 50 resources.';
//Help
$Definition['Help']['Help system'] = 'Help system';
$Definition['Help']['FAQ - Answers'] = 'FAQ - Answers';
$Definition['Help']['Game rules'] = 'Game rules';
$Definition['Help']['Contact ingame support'] = 'Contact ingame support';
$Definition['Help']['If you couldn\'t find an answer, contact the ingame support here'] = 'If you couldn\'t find an answer, contact the ingame support here.';
$Definition['Help']['Plus questions'] = 'Plus questions';
$Definition['Help']['You can ask questions about payment and premium features here'] = 'You can ask questions about payment and premium features here.';
$Definition['Help']['Forum'] = 'Forum';
$Definition['Help']['On our Forum, you can meet and converse with other players'] = 'On our Forum, you can meet and converse with other players.';
$Definition['Help']['Short instruction'] = 'Short instruction';
$Definition['Help']['Here you can find short explanations about the troops and buildings found in Travian'] = 'Here you can find short explanations about the troops and buildings found in Travian.';
$Definition['Help']['Interface help'] = 'Interface help';
$Definition['Help']['An overview of the user interface with short descriptions of the different functions'] = 'An overview of the user interface with short descriptions of the different functions.';
$Definition['Help']['Here, you can find the current game rules'] = 'Here, you can find the current game rules.';
$Definition['Help']['Here, you can find your answers about Travian If you really can\'t find your answer here, you can also contact our ingame support afterwards'] = 'Here, you can find your answers about Travian If you really can\'t find your answer here, you can also contact our ingame support afterwards.';
$Definition['Help']['inGameSupport'] = [
    'description' => 'Using our help system, the Answers page, you can easily find answers to all general questions about Travian quickly and without searching for a long time. Additionally, you have the possibility to contact the support. It can take our support up to 24 hours to answer your question. To get a faster answer, try Answers.',
    'FAQ - go to Answers' => 'FAQ - go to Answers',
    'I tried Answers but I want to contact the support' => 'I tried Answers but I want to contact the support.',
    'Contact ingame support' => 'Contact ingame support',
];
//Hero
$Definition['Hero'] = [
    "Attributes" => "Attributes",
    "Appearance" => "Appearance",
    "Adventure" => "Adventure",
    "Auction" => "Auction",
    "showInformation" => "Show information",
    "hideInformation" => "Hide information",
    "normal" => "normal",
    "hard" => "hard",
];
//HeroAdventure
$Definition['HeroAdventure']['Duration to the adventure'] = 'Duration to the adventure';
$Definition['HeroAdventure']['Arrival in: %s hrs | Return in: %s hrs'] = 'Arrival in: %s hrs | Return in: %s hrs';
$Definition['HeroAdventure']['No rallyPoint'] = 'There\'s no rallypoint in hero\'s village.';
$Definition['HeroAdventure']['headerAdventures'] = 'Currently available adventures';
$Definition['HeroAdventure']['location'] = 'location';
$Definition['HeroAdventure']['moveTime'] = 'Duration';
$Definition['HeroAdventure']['difficulty'] = 'difficulty';
$Definition['HeroAdventure']['timeLeft'] = 'Time left';
$Definition['HeroAdventure']['goTo'] = 'Link';
$Definition['HeroAdventure']['gotoAdventure'] = 'To the adventure.';
$Definition['HeroAdventure']['normal'] = 'Normal';
$Definition['HeroAdventure']['hard'] = 'Hard';
$Definition['HeroAdventure']['wald'] = 'Wald';
$Definition['HeroAdventure']['clay'] = 'Clay';
$Definition['HeroAdventure']['hill'] = 'Hill';
$Definition['HeroAdventure']['lake'] = 'Lake';
$Definition['HeroAdventure']['adventure_dif_hard'] = 'Hard adventure';
$Definition['HeroAdventure']['adventure_dif_normal'] = 'Normal adventure';
$Definition['HeroAdventure']['natarsLandscape'] = 'Wilderness';
$Definition['HeroAdventure']['natars'] = 'Natars village';
$Definition['HeroAdventure']['adventure'] = 'Adventure';
$Definition['HeroAdventure']['unOccupiedOasis'] = 'Unoccupied Oasis';
$Definition['HeroAdventure']['ok'] = 'ok';
$Definition['HeroAdventure']['no adventures'] = 'No adventure found.';
$Definition['HeroAdventure']['Hero not available'] = 'Hero is not available.';
$Definition['HeroAdventure']['Hero is stationed in village'] = 'Hero is in this village';
$Definition['HeroAdventure']['Hero is not in selected village at the moment'] = 'Hero is not in selected village at the moment/';
$Definition['HeroAdventure']['StartAdventure'] = 'Start adventure';
$Definition['HeroAdventure']['back'] = 'back';
$Definition['HeroAdventure']['rallyPointNeeded'] = 'Rallypoint needed.';
$Definition['HeroAdventure']['Send hero to village'] = 'Send hero to village';
$Definition['HeroAdventure']['Travel time to village'] = 'Travel time to village';
$Definition['HeroAdventure']['Revive hero first'] = 'Revive hero first';
$Definition['HeroAdventure']['The Hero must be stationed in the selected village first in order to start an adventure from there'] = 'The Hero must be stationed in the selected village first in order to start an adventure from there.';
$Definition['HeroAdventure']['Travel time calculation for other villages'] = 'Travel time calculation for other villages';
$Definition['HeroAdventure']['Show travel time calculation for other villages'] = 'Show travel time calculation for other villages';
$Definition['HeroAdventure']['Hide travel time calculation for other villages'] = 'Hide travel time calculation for other villages';
$Definition['HeroAdventure']['Hero on his way'] = 'Hero on his way';
//HeroFace
$Definition['HeroFace'] = [
    "Gender" => "Gender",
    "male" => "male",
    "female" => "female",
    "save" => "save",
    "random" => "random",
    "headProfile" => "head",
    "hairColor" => "colour of hair",
    "hairStyle" => "hair style",
    "ears" => "ears",
    "eyebrow" => "eyebrows",
    "eyes" => "eyes",
    "nose" => "nose",
    "mouth" => "mouth",
    "beard" => "beard",
];
//Hero Global
$Definition['HeroGlobal']['HeroOverview'] = 'Hero overview';
$Definition['HeroGlobal']['health'] = 'Health';
$Definition['HeroGlobal']['Experience'] = 'Experience';
$Definition['HeroGlobal']['Appear'] = 'Appearance';
$Definition['HeroGlobal']['Attributes'] = 'Attributes';
$Definition['HeroGlobal']['showInformation'] = 'Show information';
$Definition['HeroGlobal']['hideInformation'] = 'Hide information';
$Definition['HeroGlobal']['available_adventures:'] = 'Available adventures:';
$Definition['HeroGlobal']['next adventure will expire in:'] = 'Next adventure will expire in: %s';
$Definition['HeroGlobal']['Auctions'] = 'Auctions';
$Definition['HeroGlobal']['Auctions with maximum bid:'] = 'Auctions with maximum bid:';
$Definition['HeroGlobal']['Auctions which you got outbid:'] = 'Auctions which you got outbid:';
$Definition['HeroGlobal']['Adventure'] = 'Adventure';
$Definition['HeroGlobal']['Tooltip loading'] = 'Tooltip loading...';
$Definition['HeroGlobal']['shortStatus']['Home'] = '	in home village';
$Definition['HeroGlobal']['shortStatus']['defending'] = 'defending';
$Definition['HeroGlobal']['shortStatus']['trapped'] = 'trapped';
$Definition['HeroGlobal']['shortStatus']['dead'] = 'dead';
$Definition['HeroGlobal']['shortStatus']['return'] = 'on the way';
$Definition['HeroGlobal']['shortStatus']['adventure'] = 'on the way';
$Definition['HeroGlobal']['shortStatus']['reinforcement'] = 'on the way';
$Definition['HeroGlobal']['shortStatus']['attack'] = 'on the way';
$Definition['HeroGlobal']['shortStatus']['escape'] = 'on the way';
$Definition['HeroGlobal']['shortStatus']['reviving'] = 'Regenerating';
$Definition['HeroGlobal']['longStatus']['Home'] = 'Your hero is currently in village %s.';
$Definition['HeroGlobal']['longStatus']['defending'] = 'Your hero is defending village %s.';
$Definition['HeroGlobal']['longStatus']['trapped'] = 'Your hero is imprisoned in village %s.';
$Definition['HeroGlobal']['longStatus']['dead'] = 'Your hero is dead.';
$Definition['HeroGlobal']['longStatus']['return'] = 'Your hero is returning to village %s.';
$Definition['HeroGlobal']['longStatus']['return'] .= 'Arrival in %s at %s.';
$Definition['HeroGlobal']['longStatus']['adventure'] = 'Hero is on the adventure %s';
$Definition['HeroGlobal']['longStatus']['reinforcement'] = 'Home village is %s. Hero is on thy way.';
$Definition['HeroGlobal']['longStatus']['reinforcement'] .= 'Arrival in %s at %s.';
$Definition['HeroGlobal']['longStatus']['attack'] = 'Home village is %s. Hero is on thy way.';
$Definition['HeroGlobal']['longStatus']['attack'] .= 'Arrival in %s at %s.';
$Definition['HeroGlobal']['longStatus']['escape'] = 'Hero is escaping';
$Definition['HeroGlobal']['longStatus']['escape'] .= 'Arrival in %s at %s.';
$Definition['HeroGlobal']['longStatus']['reviving'] = 'Your hero is regenerating in village';
$Definition['HeroGlobal']['inventoryStatus']['Home'] = 'Your hero is currently in village <a href="karte.php?d=%s">%s</a>.';
$Definition['HeroGlobal']['inventoryStatus']['defending'] = 'Your hero is defending village <a href="karte.php?d=%s">%s</a>.';
$Definition['HeroGlobal']['inventoryStatus']['trapped'] = 'Your hero is imprisoned in village <a href="karte.php?d=%s">%s</a>.';
$Definition['HeroGlobal']['inventoryStatus']['dead'] = 'Your hero is dead.';
$Definition['HeroGlobal']['inventoryStatus']['return'] = 'Your hero is returning to village <a href="karte.php?d=%s">%s</a>.';
$Definition['HeroGlobal']['inventoryStatus']['return'] .= 'Arrival in %s at %s.';
$Definition['HeroGlobal']['inventoryStatus']['adventure'] = 'Hero is on the adventure %s. Arrival in %s at %s.';
$Definition['HeroGlobal']['inventoryStatus']['adventure'] .= '<div class="subMessage"> (You can see the adventure progress in <a href="build.php?gid=16&amp;tt=1&amp;newdid=%s">Rallypoint</a>.) </div>';
$Definition['HeroGlobal']['inventoryStatus']['reinforcement'] = 'Home village is <a href="karte.php?d=%s">%s</a>. Hero is on thy way.';
$Definition['HeroGlobal']['inventoryStatus']['reinforcement'] .= 'Arrival in %s at %s.';
$Definition['HeroGlobal']['inventoryStatus']['attack'] = 'Home village is <a href="karte.php?d=%s">%s</a>. Hero is on thy way.';
$Definition['HeroGlobal']['inventoryStatus']['attack'] .= 'Arrival in %s at %s.';
$Definition['HeroGlobal']['inventoryStatus']['escape'] = 'Hero is escaping';
$Definition['HeroGlobal']['inventoryStatus']['escape'] .= 'Arrival in %s at %s.';
$Definition['HeroGlobal']['inventoryStatus']['reviving'] = 'Your hero is regenerating in village <a href="karte.php?d=%s">%s</a>';
$Definition['HeroGlobal']['inventoryStatus']['reviving'] .= ' Remaining time:';
//HeroInventory
$Definition['HeroInventory'] = [
    "loyaltyIsMaxYourCannotIncreaseItMore" => "Your village loyalty is maxed. You can`t increase it anymore.",
    "HeroAliveAndCannotUseBucket" => "Your hero is alive. So you can\\'t use bucket of water.",
    "YourHeroWillBeAliveImmediatelyAndOneWaterBucketWillBeUsedAndNoResourcesWillBeRefunded" => "You hero will be alive immediately. One waterbucket will be used and the resources will not be refunded.",
    "YouCannotUseThisItemCurrently" => "You cannot use this item currently.",
    "waterBucketsUsed" => "You used your max times of use of water buckets. Next use at: %s",
    "currentHeroExperience" => "Current Hero Experience",
    "heroExperienceGainFromItems" => "Experience gained from item",
    "heroExperienceAfterUse" => "Hero experience after use",
    "currentCulturePoints" => "Current culture points",
    "culturePointsGainFromItems" => "Culture points gained from artwork",
    "culturePointsAfterUsage" => "Culture points after use",
    "heroLevel" => "Hero level",
    "RomanSpecialHeroAttribute" => "Your hero will get %s attack power for every point.",
    "TeutonSpecialHeroAttribute" => "When hero is with troops, You'll have %s raid bonus.",
    "GualSpecialHeroAttribute" => "If your hero is cavalry, you'll get %s more speed.",
    "notMoveableText" => 'Your hero is dead or is not in village, so you are not able to use this item.',
    "notMoveableTextDead" => 'You cannot use this item. Revive your hero first.',
    "moveDialogDescription" => "Number of items",
    "useDialogDescription" => "Number of items",
    "useOneDialogTitle" => "Are you sure you want to use this item?",
    "moveDialogTitle" => "Move",
    "useDialogTitle" => "Use",
    "buttonOk" => "ok",
    "buttonCancel" => "Cancel",
    "save" => "Save changes",
    "Body" => "Body",
    "BuyItem" => "Buy item",
    "sellItem" => "Sell item",
    "productBonus" => "Resources",
    "increaseOfProduction" => "Increase of production",
    "productBonusDesc" => "Increases the resource production of the village where the hero is currently residing at.",
    "defBonus" => "Def bonus",
    "defBonusDesc" => "Increases the defensive power of all the troops accompanied by your hero.",
    "offBonus" => "Off bonus",
    "offBonusDesc" => "Increases the offensive power of all your attacking troops which are accompanied by your hero.",
    "fightingStrength" => "Fighting strength",
    "fightingStrengthDesc" => "The fighting strength of your hero combines both his defensive and offensive power. The higher the value of his fighting strength, the less damage he will take during adventures.",
    "attackBehaviourSettings" => "Hide hero",
    "availablePoints" => "Available points",
    "SaveChanges" => "Please save changes.",
    "HeroHideDesc" => "Hero will hide during an attack on their home village. ",
    "HeroShowDesc" => "Your hero will always stay with the troops",
    "ReviveHeroInVillage" => "To set a different home village, change to the desired village and initiate the revival there.",
    "ResourcesRequiredToReviveHero" => "Resources required to revive hero",
    'HeroReviveInVillageDescription' => 'Hero\'s home village was <a href="karte.php?d=%s">%s</a>. Hero will be revived in village <a href="karte.php?d=%s">%s</a>.',
    "EnoughResourcesAt" => "Enough resources at",
    "changeResourcesHeadline" => "Change resource production of the hero",
    "Regenerate" => "Revive hero",
    "health" => "Health",
    "heroRegenerationRate" => "Your hero regeneration",
    "perDay" => "per day",
    "fromHero" => "from hero",
    "fromItem" => "from items",
    "experience" => "Experience",
    "experienceNeededToNextLevel" => "Your hero need %s more experience to reach level %s.",
    "speed" => "Speed",
    "speedOfYourHero" => "Speed of your hero",
    "fieldPerHour" => "Field/Hour",
    "fromHorse" => "From horse",
    "HeroProduction" => "Hero production",
    "currentHeroProduction" => "Current hero production",
    "Bonus" => "Bonus",
    "Percent" => "Percent",
    "level" => "level",
    'heroExperienceBonus' => 'Bonus',
];
//HeroItems
$Definition['HeroItems'] = [
    1 => [
        1 => [
            "name" => "Helmet alert",
            "title" => "%s&#37;+ Experience more",
        ],
        2 => [
            "name" => "Helmet of Enlightenment",
            "title" => "%s&#37;+ Experience more",
        ],
        3 => [
            "name" => "Helmet of Knowledge",
            "title" => "%s&#37;+ Experience more",
        ],
        4 => [
            "name" => "Their helmet reconstruction",
            "title" => "%s+ Health At Every Day",
        ],
        5 => [
            "name" => "Their hats Health",
            "title" => "%s+ Health At Every Day",
        ],
        6 => [
            "name" => "Helmet Healing",
            "title" => "%s+ Health At Every Day",
        ],
        7 => [
            "name" => "Gladiators Helmet",
            "title" => "%s+ Culture Points per day",
        ],
        8 => [
            "name" => "Helmet Tribune",
            "title" => "%s+ Culture Points per day",
        ],
        9 => [
            "name" => "Helmet console",
            "title" => "%s+ Culture Points per day",
        ],
        10 => [
            "name" => "Rider helmet",
            "title" => "Training time in Stable reduced to %s&#37;.",
        ],
        11 => [
            "name" => "Cavalry helmet",
            "title" => "Training time in Stable reduced to %s&#37;.",
        ],
        12 => [
            "name" => "Senior cavalry helmet",
            "title" => "Training time in Stable reduced to %s&#37;.",
        ],
        13 => [
            "name" => "Soldiers Helmet",
            "title" => "Training time in barracks reduced to %s&#37;.",
        ],
        14 => [
            "name" => "Helmet of the Warrior",
            "title" => "Training time in barracks reduced by %s%%.",
        ],
        15 => [
            "name" => "Helmet of the Archon",
            "title" => "Training time in barracks reduced by %s%%.",
        ],
    ],
    2 => [
        82 => [
            "name" => "Armor reconstruction",
            "title" => "%s+ Health At Every Day",
        ],
        83 => [
            "name" => "Armor Health",
            "title" => "%s+ Health At Every Day",
        ],
        84 => [
            "name" => "Armor Health B",
            "title" => "%s+ Health At Every Day",
        ],
        85 => [
            "name" => "Light Armor",
            "title" => "%s will reduce the amount of damages to health.<br />%s+ Health At Every Day",
        ],
        86 => [
            "name" => "Armor",
            "title" => "%s will reduce the amount of damages to health.<br />%s+ Health At Every Day",
        ],
        87 => [
            "name" => "Heavy Armor",
            "title" => "%s will reduce the amount of damages to health.<br />%s+ Health At Every Day",
        ],
        88 => [
            "name" => "Light Breast Shield",
            "title" => "%s+ Offensive strength for Hero",
        ],
        89 => [
            "name" => "Breast Shield",
            "title" => "%s+ Offensive strength for Hero",
        ],
        90 => [
            "name" => "Heavy Breast Shield",
            "title" => "%s+ Offensive strength for Hero",
        ],
        91 => [
            "name" => "Light Polychotomy Armor",
            "title" => "%s will reduce the amount of damages to health.<br />%s+ Offensive strength for Hero",
        ],
        92 => [
            "name" => "Polychotomy Armor",
            "title" => "%s will reduce the amount of damages to health.<br />%s+ Offensive strength for Hero",
        ],
        93 => [
            "name" => "Heavy Polychotomy Armor",
            "title" => "%s will reduce the amount of damages to health.<br />%s+ Offensive strength for Hero",
        ],
    ],
    3 => [
        61 => [
            "name" => "Small Map",
            "title" => "%s&#37; Speed ​​back to the village",
        ],
        62 => [
            "name" => "Map",
            "title" => "%s&#37; Speed ​​back to the village",
        ],
        63 => [
            "name" => "Big Map",
            "title" => "%s&#37; Speed ​​back to the village",
        ],
        64 => [
            "name" => "Small triangular flags",
            "title" => "%s&#37; increase in speed when traveling between villages own troops.",
        ],
        65 => [
            "name" => "triangular flags",
            "title" => "%s&#37; increase in speed when traveling between villages own troops.",
        ],
        66 => [
            "name" => "Big triangular flags",
            "title" => "%s&#37; increase in speed when traveling between villages own troops.",
        ],
        67 => [
            "name" => "Small Flags",
            "title" => "Speed ​​between allied troops will increase to %s&#37;",
        ],
        68 => [
            "name" => "Flags",
            "title" => "Speed ​​between allied troops will increase to %s&#37;",
        ],
        69 => [
            "name" => "Big Flags",
            "title" => "Speed ​​between allied troops will increase to %s&#37;",
        ],
        73 => [
            "name" => "Small Bag Pirates",
            "title" => "%s&#37;+ Rober Points",
        ],
        74 => ["name" => "Bag Pirates", "title" => "%s&#37;+ Rober Points"],
        75 => [
            "name" => "Big Bag Pirates",
            "title" => "%s&#37;+ Rober Points",
        ],
        76 => [
            "name" => "Small Shield",
            "title" => "%s+ Offensive strength for Hero",
        ],
        77 => [
            "name" => "Shield",
            "title" => "%s+ Offensive strength for Hero",
        ],
        78 => [
            "name" => "Big Shield",
            "title" => "%s+ Offensive strength for Hero",
        ],
        79 => [
            "name" => "Small Natars Fibers",
            "title" => "%s&#37;+ Power attacks against Natars",
        ],
        80 => [
            "name" => "Natars Fibers",
            "title" => "%s&#37;+ Power attacks against Natars",
        ],
        81 => [
            "name" => "Big Natars Fibers",
            "title" => "%s&#37;+ Power attacks against Natars",
        ],
    ],
    4 => [
        16 => [
            "name" => "Short sword of Legionnaire",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Legionnaire",
        ],
        17 => [
            "name" => "Sword of Legionnaire",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Legionnaire",
        ],
        18 => [
            "name" => "Long sword of Legionnaire",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Legionnaire",
        ],
        19 => [//start
               "name" => "Short sword of Praetorian",
               "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Praetorian",
        ],
        20 => [
            "name" => "Sword of Praetorian",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Praetorian",
        ],
        21 => [
            "name" => "Long sword of Praetorian",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Praetorian",
        ],
        22 => [
            "name" => "Short sword of Imperian",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Imperian",
        ],
        23 => [
            "name" => "sword of Imperian",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Imperian",
        ],
        24 => [
            "name" => "Long sword of Imperian",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Imperian",
        ],
        25 => [
            "name" => "Short sword of Equites Imperatoris",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Equites Imperatoris",
        ],
        26 => [
            "name" => "sword of Equites Imperatoris",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Equites Imperatoris",
        ],
        27 => [
            "name" => "Long sword of Equites Imperatoris",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Equites Imperatoris",
        ],
        28 => [
            "name" => "Short spear of Equites Caesaris",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Equites Caesaris",
        ],
        29 => [
            "name" => "spear of Equites Caesaris",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Equites Caesaris",
        ],
        30 => [
            "name" => "Long spear of Equites Caesaris",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Equites Caesaris",
        ],
        31 => [
            "name" => "Short spear of Phalanx",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Phalanx",
        ],
        32 => [
            "name" => "spear of Phalanx",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Phalanx",
        ],
        33 => [
            "name" => "Long spear of Phalanx",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Phalanx",
        ],
        34 => [
            "name" => "Short sword of Swordsman",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Swordsman",
        ],
        35 => [
            "name" => "sword of Swordsman",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Swordsman",
        ],
        36 => [
            "name" => "Ling sword of Swordsman",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Swordsman",
        ],
        37 => [
            "name" => "Short bow of Theutates Thunder",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Theutates Thunder",
        ],
        38 => [
            "name" => "bow of Theutates Thunder",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Theutates Thunder",
        ],
        39 => [
            "name" => "Long bow of Theutates Thunder",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Theutates Thunder",
        ],
        40 => [
            "name" => "Walking-staff of the Druidrider",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Druidrider",
        ],
        41 => [
            "name" => "Mystic staff of Druidrider",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Druidrider",
        ],
        42 => [
            "name" => "Fighting-staff of the Druidrider",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Druidrider",
        ],
        43 => [
            "name" => "Light lance of the Haeduan",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Haeduan",
        ],
        44 => [
            "name" => "Lance of the Haeduan",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Haeduan",
        ],
        45 => [
            "name" => "Heavy lance of the Haeduan",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Haeduan",
        ],
        46 => [
            "name" => "Club of the Clubswinger",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Clubswinger",
        ],
        47 => [
            "name" => "Mace of the Clubswinger",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Clubswinger",
        ],
        48 => [
            "name" => "Morning star of the Clubswinger",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Clubswinger",
        ],
        49 => [
            "name" => "Spear of the Spearman",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Spearman",
        ],
        50 => [
            "name" => "Spike of the Spearman",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Spearman",
        ],
        51 => [
            "name" => "Lance of the Spearman",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Spearman",
        ],
        52 => [
            "name" => "Hatchet of the Axeman",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Axeman",
        ],
        53 => [
            "name" => "Axe of the Axeman",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Axeman",
        ],
        54 => [
            "name" => "Battle axe of the Axeman",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Axeman",
        ],
        55 => [
            "name" => "Light hammer of the Paladin",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Paladin",
        ],
        56 => [
            "name" => "Hammer of the Paladin",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Paladin",
        ],
        57 => [
            "name" => "Heavy hammer of the Paladin",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Paladin",
        ],
        58 => [
            "name" => "Short sword of the Teutonic Knight",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Teutonic Knight",
        ],
        59 => [
            "name" => "Sword of the Teutonic Knight",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Teutonic Knight",
        ],
        60 => [
            "name" => "Long sword of the Teutonic Knight",
            "title" => "%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Teutonic Knight",
        ],
        115 => [ //start
                 'name' => 'Club of the Slave Militia',
                 'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Slave Militia',
        ],
        116 => [
            'name' => 'Mace of the Slave Militia',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Slave Militia',
        ],
        117 => [
            'name' => 'Morning Star of the Slave Militia',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Slave Militia',
        ],
        118 => [ //start
                 'name' => 'Hatchet of the Ash Warden',
                 'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Ash Warden',
        ],
        119 => [
            'name' => 'Axe of the Ash Warden',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Ash Warden',
        ],
        120 => [
            'name' => 'Battle Axe of the Ash Warden',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Ash Warden',
        ],
        121 => [//start
                'name' => 'Short Khopesh of the Warrior',
                'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Khopesh Warrior',
        ],
        122 => [
            'name' => 'Khopesh of the Warrior',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Khopesh Warrior',
        ],
        123 => [
            'name' => 'Long Khopesh of the Warrior',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Khopesh Warrior',
        ],
        124 => [//start
                'name' => 'Spear of the Anhor Guard',
                'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Anhor Guard',
        ],
        125 => [
            'name' => 'Spear of the Anhor Guard',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Anhor Guard',
        ],
        126 => [
            'name' => 'Lance of the Anhor Guard',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Anhor Guard',
        ],
        127 => [//start
                'name' => 'Short Bow of the Resheph Chariot',
                'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Resheph Chariot',
        ],
        128 => [
            'name' => 'Bow of the Resheph Chariot',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Resheph Chariot',
        ],
        129 => [
            'name' => 'Long Bow of the Resheph Chariot',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Resheph Chariot',
        ],
        130 => [ //start
                 'name' => 'Hatchet of the Mercenary',
                 'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Mercenary',
        ],
        131 => [
            'name' => 'Axe of the Mercenary',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Mercenary',
        ],
        132 => [
            'name' => 'Battle Axe of the Mercenary',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Mercenary',
        ],
        133 => [ //start
                 'name' => 'Composite Short Bow of the Bowman',
                 'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Bowman',
        ],
        134 => [
            'name' => 'Composite Bow of the Bowman',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Bowman',
        ],
        135 => [
            'name' => 'Composite Long Bow of the Bowman',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Bowman',
        ],
        136 => [ //start
                 'name' => 'Short Spatha Sword of the Steppe Rider',
                 'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Steppe Rider',
        ],
        137 => [
            'name' => 'Spatha Sword of the Steppe Rider',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Steppe Rider',
        ],
        138 => [
            'name' => 'Long Spatha Sword of the Steppe Rider',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Steppe Rider',
        ],
        139 => [ //start
                 'name' => 'Composite Short Bow of the Marksman',
                 'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Marksman',
        ],
        140 => [
            'name' => 'Composite Bow of the Marksman',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Marksman',
        ],
        141 => [
            'name' => 'Composite Long Bow of the Marksman',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Marksman',
        ],
        142 => [ //start
                 'name' => 'Short Spatha Sword of the Marauder',
                 'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Marauder',
        ],
        143 => [
            'name' => 'Spatha Sword of the Marauder',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Marauder',
        ],
        144 => [
            'name' => 'Long Spatha Sword of the Marauder',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Marauder',
        ],
    ],
    5 => [
        94 => [
            "name" => "Remake Boots",
            "title" => "%s+ Health At Every Day",
        ],
        95 => [
            "name" => "Health Boots",
            "title" => "%s+ Health At Every Day",
        ],
        96 => [
            "name" => "Repair Boots",
            "title" => "%s+ Health At Every Day",
        ],
        97 => [
            "name" => "Military Boots",
            "title" => "%s&#37;+ speed increase troops for distances of more than %s homes",
        ],
        98 => [
            "name" => "Fighter Boots",
            "title" => "%s&#37;+ speed increase troops for distances of more than %s homes",
        ],
        99 => [
            "name" => "Ruler Boots",
            "title" => "%s&#37;+ speed increase troops for distances of more than %s homes",
        ],
        100 => [
            "name" => "Small auditor",
            "title" => "%s+ Home in time for the cavalry hero",
        ],
        101 => [
            "name" => "auditor",
            "title" => "%s+ Home in time for the cavalry hero",
        ],
        102 => [
            "name" => "Big auditor",
            "title" => "%s+ Home in time for the cavalry hero",
        ],
    ],
    6 => [
        103 => [
            "name" => "Horse",
            "title" => "%s+ Home in time for heroes",
        ],
        104 => [
            "name" => "The Noble Horse",
            "title" => "%s+ Home in time for heroes",
        ],
        105 => [
            "name" => "Fighter Horse",
            "title" => "%s+ Home in time for heroes",
        ],
    ],
    7 => [
        112 => [
            "name" => "A small bandage",
            "title" => "Equipped bandages can heal a maximum of 25&#37; of battle losses right after the battle. You can only heal the amount of troops that you have bandages for. Healing time is equal to the return time of these troops, but at least 24 hours.<br />The item is stackable.<br />Has to be equipped before battle to take effect.",
        ],
    ],
    8 => [
        113 => [
            "name" => "bandage",
            "title" => "Equipped bandages can heal a maximum of 33&#37; of battle losses right after the battle. You can only heal the amount of troops that you have bandages for. Healing time is equal to the return time of these troops, but at least 24 hours.<br />The item is stackable.<br />Has to be equipped before battle to take effect.",
        ],
    ],
    9 => [
        114 => [
            "name" => "Cage",
            "title" => "By this item your hero can capture animals from oases and bring them home as defensive units.",
        ],
    ],
    10 => [
        107 => [
            "name" => "Inscription",
            "title" => "Will increase your hero experience.",
        ],
    ],
    11 => [
        106 => [
            "name" => "Ointment",
            "title" => "It restores the hero\'s health max to %s&#37;. Each drop of Ointment will restore 1 point of hero health.",
        ],
    ],
    12 => [
        108 => [
            "name" => "Water Bucket",
            "title" => "Revive your hero immediately.",
        ],
    ],
    13 => [
        110 => [
            "name" => "Book of Knowledge",
            "title" => "By this item you can redistribute all points of your hero.",
        ],
    ],
    14 => [
        109 => [
            "name" => "Law tablet",
            "title" => "With immediate effect, increases the hero\'s home village loyalty by %s&#37; percent per table with a maximum of %s&#37;.",
        ],
    ],
    15 => [
        111 => [
            "name" => "Artwork",
            "title" => "If you use the artwork, you'll immediately gain additional culture points based on the culture point production of your villages (+%s culture points), up to a maximum of %s culture points per used artwork.<br />Takes effect when equipped.<br />The item is stackable.",
        ],
    ],
];
//HeroMansion
$Definition['HeroMansion'] = [
    "AnnexedOasis" => "Annexed Oasis",
    "type" => "Type",
    "owner" => "Owner",
    "Village" => "Village",
    "Coordinates" => "Coordinates",
    "Resources" => "Resources",
    "Loyalty" => "Loyalty",
    "conquered" => "Conquered",
    "Forest" => "Forest",
    "Clay" => "Clay",
    "Hill" => "Hill",
    "Lake" => "Lake",
    "nextOasisInHeroMansionLevel" => "Next oasis at hero's mansion level ",
    "inReachOases" => "In reach oases",
    "noSlot" => "No Oasis found.",
    "duration" => "Duration",
    "finished" => "Finished",
    "AbandonOases" => "Abandon oasis",
    "areYouSure" => "Are you sure?",
    "del" => "delete",
    "noNearOasis" => "No nearby oases found.",
];
//inGame
$Definition['inGame']['Enable this button to construct by clicking on the field'] = 'Enable this button to construct by clicking on the field';
$Definition['inGame']['Disable fast upgrade'] = 'Disable fast upgrade';
$Definition['inGame']['Inadmissible name/message'] = 'Inadmissible name/message.';
$Definition['inGame']['Error: very long input'] = 'Error: Very long name/message.';
$Definition['inGame']['TrainingTime'] = 'Training time: %s';
$Definition['inGame']['noTroopInBeingTrained'] = 'No troops are being trained.';
$Definition['inGame']['FreeMerchants'] = 'Free Merchants: %s/%s';
$Definition['inGame']['No further tasks available in this category'] = 'No further tasks available in this category.';
$Definition['inGame']['Click here to extend your beginners protection by 3 days'] = 'Click here to extend your beginners protection by %s %s';
$Definition['inGame']['You cannot send resources to other players, attack them or be attacked by them while in beginners protection'] = 'You cannot send resources to other players, attack them or be attacked by them while in beginners protection';
$Definition['inGame']['Are you sure you want to extend your beginners protection?'] = 'Are you sure you want to extend your beginners protection?';
$Definition['inGame']['Hours'] = 'Hours';
$Definition['inGame']['Days'] = 'Days';
$Definition['inGame']['Minutes'] = 'Minutes';
$Definition['inGame']['Seconds'] = 'Seconds';
$Definition['inGame']['extend'] = 'Extend';
$Definition['inGame']['Exchange'] = 'Exchange';
$Definition['inGame']['Are you sure you want to convert x gold to y silver?'] = 'Are you sure you want to convert %s gold to %s silver?';
$Definition['inGame']['maintenanceDesc'] = 'The system is under maintenance.<br /> Our experts are working on system to fix it as soon as possible.<br />This process may take from minutes to hours.<br /> Thanks for your patience. <br /> Travian Team';
$Definition['inGame']['serverTime'] = 'Server Time';
$Definition['inGame']['loyalty'] = 'Loyalty';
$Definition['inGame']['needPlusDesc'] = 'For this feature you need Travian Plus activated.';
$Definition['inGame']['noWorkShop'] = 'There is no workshop in this village.';
$Definition['inGame']['DirectLinks'] = 'Direct Links';
$Definition['inGame']['noStable'] = 'There is no stable in this village.';
$Definition['inGame']['noBarracks'] = 'There is no barracks in this village.';
$Definition['inGame']['noMarketplace'] = 'There is no marketplace in this village.';
$Definition['inGame']['changeVillageName'] = 'change Village Name.';
$Definition['inGame']['trap_desc'] = 'you have %s trap. %s trap is full already.';
$Definition['inGame']['newVillageName'] = 'new Village Name';
$Definition['inGame']['DoubleClickToChangeVillageName'] = 'Double Click For Change Village Name.';
$Definition['inGame']['villages'] = 'Villages';
$Definition['inGame']['hideCoordinates'] = 'hide Coordinates';
$Definition['inGame']['showCoordinates'] = 'show Coordinates';
$Definition['inGame']['Village statistics'] = 'Village statistics';
$Definition['inGame']['culture points'] = 'Culture Points';
$Definition['inGame']['Culture points generated to take control of another village:'] = 'Culture points generated to take control of another village:';
$Definition['inGame']['MaintenanceWork'] = 'Maintenance work';
$Definition['inGame']['run celebration'] = 'Run celebration';
$Definition['inGame']['festival'] = 'Festival';
$Definition['inGame']['type'] = 'type';
$Definition['inGame']['one celebration is running'] = 'one celebration is running.';
$Definition['inGame']['celebrationRunning'] = 'Running celebrations';
$Definition['inGame']['Here you can subscribe or unsubscribe to our newsletter'] = 'Here you can subscribe or unsubscribe to our newsletter.';
$Definition['inGame']['sitterChangeNameDesc'] = 'You cant change village name as sitter.';
$Definition['inGame']['The account will be deleted in'] = 'The account will be deleted in	%s.';
$Definition['inGame']['infoBox']['ArtifactsWillBeReleasedIn'] = 'Artifacts will be released in %s hours.';
$Definition['inGame']['infoBox']['wwPlansWillBeReleasedIn'] = 'WW plans will be released in %s hours.';
$Definition['inGame']['infoBox']['youCanBuildWWIn'] = 'You can build WW in %s hours.';
$Definition['inGame']['infoBox']['MedalsWillBeGivenIn'] = 'Medals will be given in %s Hours.';
$Definition['inGame']['infoBox']['AutoFinishTime'] = 'Server will be ended in %s hours by Natars.';
$Definition['inGame']['infoBox']['CatapultAvailableIn'] = 'Catapults will be available in %s hours.';
$Definition['inGame']['infoBox']['PlusWillBeFinished'] = ' Your plus account expires in %s.';
$Definition['inGame']['infoBox']['Boost1WillBeFinished'] = 'Wood production boost will be finished in %s hours.';
$Definition['inGame']['infoBox']['Boost2WillBeFinished'] = 'Clay production boost will be finished in %s hours.';
$Definition['inGame']['infoBox']['Boost3WillBeFinished'] = 'Iron production boost will be finished in %s hours.';
$Definition['inGame']['infoBox']['Boost4WillBeFinished'] = 'Crop production boost will be finished in %s hours.';
$Definition['inGame']['infoBox']['plusAccountExpired'] = 'Your plus account is Expired.';
$Definition['inGame']['infoBox']['productionBoost1Expired'] = 'Wood production boost is Expired.';
$Definition['inGame']['infoBox']['productionBoost2Expired'] = 'Clay production boost is Expired.';
$Definition['inGame']['infoBox']['productionBoost3Expired'] = 'Iron production boost is Expired.';
$Definition['inGame']['infoBox']['productionBoost4Expired'] = 'Crop production boost is Expired.';
$Definition['inGame']['infoBox']['protection'] = 'You still have %s hours of beginner\'s protection left.';
$Definition['inGame']['infoBox']['Your account was banned!'] = 'Your account was banned!';
$Definition['inGame']['infoBox']['Reason'] = 'Reason';
$Definition['inGame']['infoBox']['Not enough gold to extend this feature'] = 'Not enough gold to extend this feature.';
$Definition['inGame']['infoBox']['Reasons'] = [
    'Pushing' => 'Pushing',
    'Cheat' => 'Cheat',
    'Hack' => 'Hack',
    'Bug' => 'Bug',
    'Bad Name' => 'Bad name',
    'Multiaccount' => 'Multiaccount',
    'Swearing' => 'Swearing',
    'Insults' => 'Insults',
    'Spam' => 'Spam',
    'Another' => 'Another',
    'Other' => 'Other'
];
$Definition['inGame']['infoBox']['AutoType_GoldPromotion'] = '<font color="#ff8000" size="2"><b>Gold Promotion</b></font><br />This Gold promotion will happen between %s till %s.<br />All gold purchased during this time will give you <b>20%%</b> more gold than usual.';
$Definition['inGame']['infoBox']['Your account is in vacation until [time]'] = 'Your account is in vacation until %s.';
$Definition['inGame']['infoBox']['day(s)'] = 'day(s)';
$Definition['inGame']['infoBox']['hour(s)'] = 'hour(s)';
$Definition['inGame']['infoBox']['overFlowMessage'] = 'Your report box has over 90%% of its size used. Overflowing reports, which are older than %d %s may be deleted.';
$Definition['inGame']['More Information'] = 'More Information';
//Your report box has over 90% of its size used. Overflowing reports, which are older than one day may be deleted.
$Definition['inGame']['total_messages'] = 'Messages';
$Definition['inGame']['unReadMessages'] = 'Unread messages';
$Definition['inGame']['showMoreMessages'] = 'Display more messages';
$Definition['inGame']['hideMoreMessages'] = 'Hide messages';
$Definition['inGame']['Confirm'] = 'Confirm';
$Definition['inGame']['InfoBox'] = 'Info Box';
$Definition['inGame']['Delete this message permanently?'] = 'Delete this message permanently?';
$Definition['inGame']['This tab is selected as your fav tab'] = 'This tab is selected as your favourite tab';
$Definition['inGame']['Select this tab as fav'] = 'Select this tab as favourite tab';
$Definition['inGame']['sendMessage'] = 'Send message';
$Definition['inGame']['zoom_in'] = 'Zoom in';
$Definition['inGame']['zoomIn'] = 'Zoom In';
$Definition['inGame']['available'] = 'available';
$Definition['inGame']['Amount'] = 'Amount';
$Definition['inGame']['train_troops'] = 'Train troops';
$Definition['inGame']['bannedSmallPage'] = 'You are banned.';
$Definition['inGame']['in_training'] = 'in training';
$Definition['inGame']['next_creating'] = 'Next trap will be created in %s hours.';
$Definition['inGame']['next_training'] = 'Next troop will be trained in %s hours.';
$Definition['inGame']['in_creating'] = 'In Creating';
$Definition['inGame']['train'] = 'Train';
$Definition['inGame']['palaceNoTrainText'] = 'In order to found a new village you need a level 10, 15 or 20 palace and 3 settlers. In order to conquer a new village you need a level 10, 15 or 20 palace and a senator, chief or chieftain.';
$Definition['inGame']['residenceNoTrainText'] = 'In order to found a new village you need a level 10 or 20 residence and 3 settlers. In order to conquer a new village you need a level 10 or 20 residence and a senator, chief or chieftain.';
$Definition['inGame']['noTroops'] = 'No troops for this building have been researched yet.<br />You can research new troops in the academy.';
$Definition['inGame']['Profile']['Profile'] = 'Profile';
$Definition['inGame']['Profile']['edit profile description'] = 'Edit profile description.';
$Definition['inGame']['Options']['Options'] = 'Options';
$Definition['inGame']['Options']['edit account settings'] = 'Edit account settings.';
$Definition['inGame']['Options']['you may not edit settings of another account'] = 'You may not edit the settings of another account.';
$Definition['inGame']['Forum']['Forum'] = 'Forum';
$Definition['inGame']['Forum']['Meet other players on our external forum'] = 'Meet other players on our external forum.';
$Definition['inGame']['Help']['Help'] = 'Help';
$Definition['inGame']['Help']['Manuals, Answers and Support'] = 'Manuals, Answers and Support';
$Definition['inGame']['Logout']['Logout'] = 'Logout';
$Definition['inGame']['Logout']['Log out from the game'] = 'Log out from the game.';
$Definition['inGame']['Navigation']['Resources'] = 'Resources';
$Definition['inGame']['Navigation']['Buildings'] = 'Buildings';
$Definition['inGame']['Navigation']['Map'] = 'Map';
$Definition['inGame']['Navigation']['Statistics'] = 'Statistics';
$Definition['inGame']['Navigation']['Reports'] = 'Reports';
$Definition['inGame']['Navigation']['newReports'] = 'New Report(s)';
$Definition['inGame']['Navigation']['Messages'] = 'Messages';
$Definition['inGame']['Navigation']['newMessages'] = 'New Message(s)';
$Definition['inGame']['Navigation']['Buy gold'] = 'Buy gold';
$Definition['inGame']['gold'] = 'Gold';
$Definition['inGame']['goldShort'] = 'Gold';
$Definition['inGame']['silver'] = 'Silver';
$Definition['inGame']['silverShort'] = 'Silver';
$Definition['inGame']['endAt'] = 'Finish At';
$Definition['inGame']['finishNow'] = 'Finish Now';
$Definition['inGame']['finishNowSitterNoPermission'] = 'You don\'t have permission to use gold as a sitter.';
$Definition['inGame']['finishNowWWDisabled'] = 'You cant use gold in ww vilage.';
$Definition['inGame']['resources']['resources'] = 'Resources';
$Definition['inGame']['resources']['r0'] = 'All';
$Definition['inGame']['resources']['r1'] = 'Lumber';
$Definition['inGame']['resources']['r2'] = 'Clay';
$Definition['inGame']['resources']['r3'] = 'Iron';
$Definition['inGame']['resources']['r4'] = 'Crop';
$Definition['inGame']['resources']['r5'] = 'Free Crop';
$Definition['inGame']['Small celebration'] = 'Small celebration';
$Definition['inGame']['Big celebration'] = 'Big celebration';
$Definition['inGame']['Hold a celebration'] = 'Hold a celebration';
$Definition['inGame']['productionBoost']['activate'] = 'Activate';
$Definition['inGame']['productionBoost']['remainingTime'] = 'Time Remaining: %s To Day %s.';
$Definition['inGame']['productionBoost']['remainingTime2'] = 'End At %s Hours.';
$Definition['inGame']['productionBoost']['woodProductionBoost'] = 'More Wood production';
$Definition['inGame']['productionBoost']['clayProductionBoost'] = 'More Clay production';
$Definition['inGame']['productionBoost']['ironProductionBoost'] = 'More Iron production';
$Definition['inGame']['productionBoost']['cropProductionBoost'] = 'More Crop production';
$Definition['inGame']['productionBoost']['extend'] = 'Extend';
$Definition['inGame']['productionBoost']['activate now'] = 'Activate now <br> Bonus duration in days: %s';
$Definition['inGame']['productionBoost']['extend now'] = 'Extend now <br> Bonus duration in days: %s';
$Definition['inGame']['plus']['remainingTime'] = 'Remaining time: %s days to %s';
$Definition['inGame']['plus']['remainingTime2'] = 'Ends at %s';
$Definition['inGame']['plus']['activate'] = 'Activate';
$Definition['inGame']['plus']['extend'] = 'Extend';
$Definition['inGame']['plus']['activate now'] = 'Activate now.<br> Duration: %s day';
$Definition['inGame']['plus']['extend now'] = 'Extend now.<br> Duration: %s day';
$Definition['inGame']['sitterNoPermForGold'] = 'As a sitter you can only do this if the account owner has given you permission.';
$Definition['inGame']['continue'] = 'continue';
$Definition['inGame']['stockBar']['production']['r1'] = 'Lumber||Production: %s<br>Full in: %s<br>Click for more information';
$Definition['inGame']['stockBar']['production']['r2'] = 'Clay||Production: %s<br>Full in: %s<br>Click for more information';
$Definition['inGame']['stockBar']['production']['r3'] = 'Iron||Production: %s<br>Full in: %s<br>Click for more information';
$Definition['inGame']['stockBar']['production']['r4'] = 'Crop||Production less building upkeep: %s<br>Full in: %s<br>Click for more information';
$Definition['inGame']['stockBar']['production']['r4Empty'] = 'Crop||Production less building upkeep: %s<br><span class="red">Empty in: %s</span><br>Click for more information';
$Definition['inGame']['stockBar']['production']['r5'] = 'Free crop for further buildings.||Crop balance: %s<br>Click for more information';
$Definition['inGame']['bannedPage'] = 'Hello %s!
</br></br>You have been banned due to violation of the rules. Every players may only own and play one account on each server.
</br></br>To ensure that you won`t get banned again in future, you should read the rules carefully:
</br></br><center><a href="http://' . WebService::getJustDomain() . 'spielregeln.php">» Game rules</a></center>
</br></br></br>
To continue playing contact the Multihunter and put things straight with him/her
</br></br><center><a href="messages.php?t=1&id=2">» Write message</a></center>
</br></br>
Head the following advise when writing your message:
</br></br>
● There is always a reason for a ban. Try to think about possible reasons for this ban and put things straight with the Multihunter.
</br>
● Multihunters can review enormous amounts of information about accounts. Stick to the truth and do not make excuses to justify your violation of the rules.
</br>
● Be cooperative and insightful, this might reduce the punishment.
</br>
● If the Multihunter does not answer immediately, then he/she is probably not online.</br>
 The issue will not be resolved any faster by sending multiple messages, especially if he/she did not even read the first one yet.
</br>
● If you have really been banned unjustly, try to stay calm and polite while talking to the Multihunter and telling him/her about your point of view.
</p>
<small><i>Best regards, Your Travian-Team</i></small></p>';
$Definition['inGame']['bannedPageWithTime'] = 'Hello %s!
</br></br>You have been banned due to %s. Every players may only own and play one account on each server.
</br></br>To ensure that you won`t get banned again in future, you should read the rules carefully:
</br></br><center><a href="http://' . WebService::getJustDomain() . 'spielregeln.php">» Game rules</a></center>
</br></br></br>
To continue playing you should wait to %s or contact the Multihunter and put things straight with him/her
</br></br><center><a href="messages.php?t=1&id=2">» Write message</a></center>
</br></br>
Head the following advise when writing your message:
</br></br>
● There is always a reason for a ban. Try to think about possible reasons for this ban and put things straight with the Multihunter.
</br>
● Multihunters can review enormous amounts of information about accounts. Stick to the truth and do not make excuses to justify your violation of the rules.
</br>
● Be cooperative and insightful, this might reduce the punishment.
</br>
● If the Multihunter does not answer immediately, then he/she is probably not online.</br>
 The issue will not be resolved any faster by sending multiple messages, especially if he/she did not even read the first one yet.
</br>
● If you have really been banned unjustly, try to stay calm and polite while talking to the Multihunter and telling him/her about your point of view.
</p>
<small><i>Best regards, Your Travian-Team</i></small></p>';
$Definition['inGame']['bannedClickPage'] = '
<h2>Hello %s,</h2>
<br/>
<center><b>Your account has been banned</b>
    <br>
</center>
<div>This ban could be temporary cause of overclick, in that case will be removed automatically after 5 seconds.
    <br>
    <br>or maybe it happened cause of:
    <br>
    <br>
    <li>Using an illegal script</li>
    <li>Pushing</li>
    <li>Spam</li>
    <li>Cursing the other players</li>
    <li>Trying to hack the system</li>
    <br>
    <br>For more info contact <a href="messages.php?t=1&id=4">Multihunter</a> or <a href="messages.php?t=1&id=1">Support</a> or sent email to <b>chamirhossein@gmail.com</b>.
    <br>
    <br>Best regards</div>
';
$answersUrl = getAnswersUrl();
$Definition['inGame']['QUEST_MESSAGE_SUBJECT'] = 'Advice for the start of the game';
$Definition['inGame']['QUEST_MESSAGE'] = <<<HTML
Hello %s,<br><br>
<br><br>
Travian is a game of domination through strategy and diplomacy. At the core, it is about standing up against other players. Seek allies to reach your goals; even the strongest players require assistance.<br><br>
<br><br>
The predominant task is always to survive and grow. In order to start on a sound footing, simply solve the tasks I give you. Protect your resources and villages from greedy neighbours. In case you are struggling, you can find some additional help here: <a href="{$answersUrl}index.php?aid=104#go2answer">Help I am a farm!</a><br><br>
<br><br>
At the start, you can often avoid enemy attacks, however you should defend yourself against conquer attempts. Without troops, you won't be able to help yourself nor your allies. More information here: <a href="{$answersUrl}index.php?aid=172#go2answer">Troops</a><br><br>
<br><br>
Once the dust of the first battles has settled, the strongest alliances will start fighting for control of ever larger territories. They will destroy threats and competitors and form new alliances. Particularly strong alliances will later fight for control of powerful artefacts and - as a display of their own power - to be the first to erect a wonder of the world.<br><br>
<br><br>
Adjust your personal goals to the time you can spend playing - the more ambitious your aims, the more time will be required to build, negotiate and fight.<br><br>
<br><br>
But enough talking! Get together with old and new friends, fight your enemies - and have fun together!
HTML;
$Definition['links']['These links are found helpful by many players Add them to your personal link list'] = 'These links are found helpful by many players. Add them to your personal link list.';
$Definition['links']['Recommended links'] = 'Recommended links';
$Definition['links']['recommenced_links'] = [
    [
        'name' => 'Travian Answers',
        'url' => getAnswersUrl() . '*',
    ],
    [
        'name' => 'Village overview',
        'url' => 'dorf3.php?s=0',
    ],
    [
        'name' => 'Warehouse Overview',
        'url' => 'dorf3.php?s=3',
    ],
    [
        'name' => 'Alliance Reports',
        'url' => 'allianz.php?s=3',
    ],
    [
        'name' => 'Surrounding Reports',
        'url' => 'reports.php?t=5',
    ],
    [
        'name' => 'Options',
        'url' => 'options.php',
    ],
    [
        'name' => 'Community',
        'url' => getForumUrl() . '*',
    ],
];
$Definition['links']['Define often-used pages as direct links Place a * at the end of the link and it will be opened in a new tab'] = 'Define often-used pages as direct links. Place a * at the end of the link and it will be opened in a new tab.';
$Definition['links']['Delete entry'] = 'Delete entry';
$Definition['links']['add entry'] = 'Add entry';
$Definition['links']['No'] = 'No';
$Definition['links']['Link Name'] = 'Link name';
$Definition['links']['Link Target'] = 'Link target';
$Definition['links']['Link list'] = 'Link list';
$Definition['links']['linkWillOpenInNewTab'] = 'Link will open in new tab.';
$Definition['links']['edit link list'] = 'Edit link list and add links.';
$Definition['links']['Travian Plus allows you to make a link list'] = 'Travian Plus allows you to make a link list.';
//Login
$Definition['Login']['Server will start in'] = 'Server will start in:';
$Definition['Login']['registrationSuccessful'] = 'Thanks for your registration. We will send you an email when server starts.';
$Definition['Login']['registrationSuccessful'] .= ' Wait for email.';
$Definition['Login']['Login'] = 'Login';
$Definition['Login']['Welcome'] = 'Welcome to server %s';
$Definition['Login']['noJavascript'] = 'JavaScript is deactivated. You must activate it in your browser settings to be able to play Travian.';
$Definition['Login']['accountNameOrEmailAddress'] = 'Account name or e-mail address';
$Definition['Login']['pass'] = 'Password';
$Definition['Login']['lowResOption'] = 'Version for player ';
$Definition['Login']['lowRes'] = 'with low bandwidth (internet connection speed)';
$Definition['Login']['lowResInfo'] = '(Note: this version of the map doesn\'t have all the options enabled)';
$Definition['Login']['Captcha'] = 'Captcha';
$Definition['Login']['CaptchaError'] = 'Please enter Captcha once again.';
$Definition['Login']['PasswordForgotten?'] = 'Password forgotten? ';
$Definition['Login']['We will send you a new password It will be activated as soon as you confirm receipt?'] = 'We will send you a new password. It will be activated as soon as you confirm receipt.';
$Definition['Login']['Request new CAPTCHA'] = 'Request new CAPTCHA.';
$Definition['Login']['Email'] = 'Email';
$Definition['Login']['Request password'] = 'Request password';
$Definition['Login']['Sent to'] = 'Password was sent';
$Definition['Login']['EmailEmpty'] = 'ایمیل خالی است.';
$Definition['Login']['PasswordChangedSuccessfully'] = 'The password has been successfully changed.';
$Definition['Login']['PasswordFail'] = 'Password didn\'t changed. Perhaps the code is already used.';
$Definition['Login']['pw_forgot_email'] = nl2br('
<div style="direction: rtl; text-align: right">
Hello %s
you have requested a new password for Travian. Please find your new access data<br>
for Travian enclosed in the message below:
---------------------------------------------------------------------------------------------------------------------------------

Your access data:
Player name:  %s
Email address: %s
Password: %s
Game world: %s

---------------------------------------------------------------------------------------------------------------------------------
Please click this link to activate your new password. The old password then
becomes invalid:
<a href="%s">%s</a>

If you want to change your new password, you can enter a new one in your profile
on tab "account".

In case you did not request a new password you may ignore this email.

Your Travian Team
</div>
Impressum:
Travian Games GmbH, Wilhelm-Wagenfeld-Str. 22, 80807 München, Deutschland
Tel: +49 (0)89 3249150, Fax: +49 (0)89 324915970, www.traviangames.de
CEO: Siegfried Müller
commercial court: Amtsgericht München, HRB 173511,
tax number: DE 246258085');
$Definition['Login']['userErrors']['empty'] = 'Enter login.';
$Definition['Login']['userErrors']['notFound'] = ' Login does not exist. Are you sure that you play on .com and not e.g. on .us or .co.uk?';
$Definition['Login']['pwErrors']['empty'] = 'Enter password';
$Definition['Login']['pwErrors']['wrong'] = 'The password is wrong.';
$Definition['Login']['pwErrors']['error21Days'] = 'This user hasn\'t been logged in for more than 21 days. Sitter login now allowed.';
//Logout
$Definition['Logout'] = [
    "Logout" => "Logout successful.",
    "delete_cookies" => "Delete cookies.",
    "thanks_for_your_visit" => 'Thank you for your visit',
    "cookieDesc" => "If other people use this computer too, you should delete your cookies for your own safety",
    "back_to_the_game" => "Back to the game",
];
//Manual
$Definition['Manual'] = [
    'fightingStrength' => "Fighting strength",
    "fightingStrengthAgainstInf" => "Fighting strength against Inf",
    'fightingStrengthAgainstCav' => "Fighting strength against Cav",
    "speed" => "speed",
    "CarrySize" => "Carry",
    "TravianAnswers" => "Travian answers",
    "moreInTravianAnswers" => "More in Travian Answers",
    "durationOfTraining" => "Training time",
    "fieldsPerHour" => "fields per hour",
    "preRequests" => "Prerequisites",
    "toOverview" => "to Overview",
    "None" => "None",
    "and" => "and",
    "construction_time" => "Construction time",
    "for" => "for",
    "level" => "level",
    "BuildingPlan" => "Building plan",
    "Capital" => "Capital",
    "onlyForTribe" => "Only for",
    "Units" => "Units",
];
//Map
$Definition['map'] = [
    "player" => "Player",
    "alliance" => "Alliance",
    "owner" => "Owner",
    "Tribe" => "Tribe",
    "Village" => "Village",
    "Annex Oasis" => "Annex Oasis",
    "sendTroops" => "Send Troops",
    "no free slots" => "Hero mansion has now free slots.",
    "distribution" => "Distribution",
    "pop" => "Population",
    "capital" => "Capital",
    'x is under protection to y' => 'This Player is under protection to %s',
    'banned' => 'This player is banned.',
    'sendMerchants' => 'Send Merchants',
    "constructMarketplace" => "Construct Marketplace.",
    "readySettlers" => "Ready Settlers",
    "foundNewVillage" => "Create new village",
    "culturePointsForNewVillage" => "Culture points to found new village ",
    "noResourcesForNewVillage" => "Not enough resources (At least 750 units of each resource needed).",
    "Add to farm list" => "Add to farm list",
    "noFarmList" => "No Farm list exists for this village. Create one first.",
    "Edit farm list (Oasis already in farm list x)" => "Edit farm list (Oasis already in farm list %s)",
    "Edit farm list (Village already in farm list x)" => "Edit farm list (Village already in farm list %s)",
    "move up" => "Move up",
    "move down" => "Move down",
    "move right" => "Move right",
    "move left" => "Move left",
    "for this feature you need the goldclub actived" => "for this feature you need the an activated goldclub.",
    "vacationModeActive" => "This player is in vacation.",
    'noUnits' => 'None.',
    'units' => 'units',
    'Bonus' => 'Bonus',
    'Reports' => 'Reports',
    'Surrounding' => 'Surrounding',
    'Other Information' => 'Other Information',
    'fields' => 'fields',
    'Distance' => 'Distance',
    'Simulate raid' => 'Simulate raid',
    'No information<br>available!' => 'No information<br>available!',
    'landscape_desc' => 'Landscape',
    'centerMap' => 'Centre map',
    'constructRallyPoint' => 'Construct Rallypoint.',
    'startAdventure' => 'Start adventure',
    "mark_not_found" => "No results found",
    "ok" => "ok",
    "markAlliance" => "Mark Alliance",
    "markPlayer" => "Mark player",
    "markField" => "mark field",
    "players" => "players",
    "please_resend_all_data" => "All information needed.",
    "alliances_mark_exists" => "This alliance is already marked.",
    "player_mark_exists" => "This player is already marked.",
    "invalid_coordinates" => "Invalid coordinates.",
    "colour_does_not_exists" => "Invalid color.",
    "no_alliance_map_mark_error" => "Player is not in any alliance.",
    "map" => "Map",
    "zoomIn" => "Zoom in",
    "zoomOut" => "Zoom out",
    "zoomLevel" => "Zoom level",
    "filter" => "filter",
    "showAllianceMarks" => "Show alliance marks",
    "hideAllianceMarks" => "Hide alliance marks",
    "showUserMarks" => "Show Player marks",
    "hideUserMarks" => "Hide Player marks",
    "minimap" => "Minimap",
    "outline" => "Outline",
    "users" => "Users",
    "population" => "Population",
    "tribe" => "Tribe",
    "village" => "Village",
    "loadingData" => "Loading...",
    "landscape" => "Landscape‎‭",
    "freeOasis" => "Unoccupied oasis",
    "occupiedOasis" => "Occupied Oasis",
    "natarsVillage" => "Natar\\'s Village",
    "bounty" => "Bounty",
    "difficulty" => "Difficulty",
    "arrival" => "Arrival in",
    "supply" => "Supply",
    "spy" => "Spy",
    "return" => "Return",
    "raid" => "Raid",
    "attack" => "Attack",
    "save" => "Save",
    "cancel" => "Cancel",
    'flags' => "Flags",
    "Adventure" => "Adventure",
    "normal" => "Normal",
    "hard" => "Hard",
    "ownPlayerMarkTitle" => "Own field marks.",
    "ownAllianceMarks" => "Field marks for my alliance.",
    "ownFlags" => "Own flags.",
    "allianceMarkTitle" => 'Alliance mark for my alliance',
    "playerMarksTitle" => "Player mark for my alliance",
    "allianceFlags" => 'Field mark for my alliance',
    "largeMap" => "Fullscreen",
    "needPlus" => "In order to use this feature, you need to activate the Plus!",
    "cropFinder" => "Cropfinder",
    "needClub" => "In order to use this feature, you need to activate the Gold club!",
    "YouAreBanned" => "You are banned.",
    "YouAreInVacationMode" => "You are in vacation mode.",
    "YouAreProtected" => "You are under beginner protection. and can't do this action.",
    'mapFlagsLimitReached' => 'You reached the max number of 5 flags. Please delete one flag before you can add another one.',
    'mapMarksLimitReached' => 'You reached the max number of 10 marks. Please delete one mark before you can add another one.',
];
//Market place
$Definition['MarketPlace']['While you are in beginners protection you are only allowed to do a 1:1 or better trade'] = 'While you are in beginners protection you are only allowed to do a 1:1 or better trade.';
$Definition['MarketPlace']['x\'s offering has been accepted'] = 'x\'s offering has been accepted'; //new
$Definition['MarketPlace']['are on their way to you'] = 'are on their way to you.';
$Definition['MarketPlace']['have been dispatched by your merchants'] = 'have been dispatched by your merchants';
$Definition['MarketPlace']['Management'] = 'Management';
$Definition['MarketPlace']['SendResources'] = 'Send resources';
$Definition['MarketPlace']['resourcesSent'] = 'Resources were sent.';
$Definition['MarketPlace']['sitterNoPermissions'] = 'As a sitter you can only do this if the account owner has given you permission.';
$Definition['MarketPlace']['sameVillage'] = 'Your merchants are already at this village.';
$Definition['MarketPlace']['Buy'] = 'Buy';
$Definition['MarketPlace']['Offer'] = 'Offer';
$Definition['MarketPlace']['Delete'] = 'Delete';
$Definition['MarketPlace']['Select x as favor tab'] = 'Set %s as favourite tab';
$Definition['MarketPlace']['This tab is set as favourite'] = 'This tab is set as favourite.';
$Definition['MarketPlace']['Free merchants'] = 'Free merchants';
$Definition['MarketPlace']['Own merchants and NPC'] = 'Own merchants and NPC';
$Definition['MarketPlace']['Merchants offering resources'] = 'Merchants offering resources';
$Definition['MarketPlace']['you are banned'] = 'You\'ve been banned due to defective rules.';
$Definition['MarketPlace']['Merchants underway'] = 'Merchants underway';
$Definition['MarketPlace']['Exchange resources'] = 'Exchange resources';
$Definition['MarketPlace']['Trade routes'] = 'Trade routes';
$Definition['MarketPlace']['Create new trade route'] = 'Create new trade route';
$Definition['MarketPlace']['Start'] = 'Start';
$Definition['MarketPlace']['Merchants'] = 'Merchants';
$Definition['MarketPlace']['Action'] = 'Action';
$Definition['MarketPlace']['GoldClub'] = 'Gold Club';
$Definition['MarketPlace']['Description'] = 'Description';
$Definition['MarketPlace']['Trade route to x'] = 'Trade route to %s';
$Definition['MarketPlace']['edit'] = 'edit';
$Definition['MarketPlace']['cancel'] = 'cancel';
$Definition['MarketPlace']['Resources'] = 'Resources';
$Definition['MarketPlace']['Target village'] = 'Target village';
$Definition['MarketPlace']['Target'] = 'Target';
$Definition['MarketPlace']['all'] = 'all';
$Definition['MarketPlace']['only mine'] = 'only mine';
$Definition['MarketPlace']['others'] = 'others';
$Definition['MarketPlace']['Show villages in list'] = 'Show villages in list';
$Definition['MarketPlace']['Start time'] = 'Start time';
$Definition['MarketPlace']['nextTradeRoute'] = 'Next trade route at %s needs %s merchants.';
$Definition['MarketPlace']['not enough merchants'] = 'Not enough merchants';
$Definition['MarketPlace']['offer added successfully'] = 'Offer added successfully.';
$Definition['MarketPlace']['own alliance only'] = 'Own alliance only';
$Definition['MarketPlace']['max, time of transport'] = 'max, time of transport';
$Definition['MarketPlace']["Own offers"] = 'Own offers';
$Definition['MarketPlace']["I'm searching"] = 'I\'m searching';
$Definition['MarketPlace']["Alliance"] = 'Alliance';
$Definition['MarketPlace']["hours"] = 'hours.';
$Definition['MarketPlace']["accept offer"] = 'accept offer';
$Definition['MarketPlace']["yes"] = 'yes';
$Definition['MarketPlace']["no"] = 'no';
$Definition['MarketPlace']["Offers at the marketplace"] = 'Offers at the marketplace';
$Definition['MarketPlace']["Offered to me"] = 'Offered to me';
$Definition['MarketPlace']["Wanted from me"] = 'Wanted from me';
$Definition['MarketPlace']["Player"] = 'Player';
$Definition['MarketPlace']["Duration"] = 'Duration';
$Definition['MarketPlace']["Action"] = 'Action';
$Definition['MarketPlace']["onReturnMerchants"] = 'Returning Merchants';
$Definition['MarketPlace']["onComingMerchants"] = 'Incoming Merchants';
$Definition['MarketPlace']["onGoingMerchants"] = 'Ongoing Merchants';
$Definition['MarketPlace']["noResourcesEntered"] = 'No resources have been selected.';
$Definition['MarketPlace']["noVillageWithName"] = 'A village with the name has not been found.';
$Definition['MarketPlace']["noVillageInCoordinate"] = 'There is no village at these coordinates.';
$Definition['MarketPlace']["enterVillageNameOrCoordinate"] = 'Invalid coordinates.';
$Definition['MarketPlace']["PlayerBanned"] = 'The Player Was Banned.';
$Definition['MarketPlace']["serverFinished"] = 'This Server is Finished.';
$Definition['MarketPlace']["go"] = 'go';
$Definition['MarketPlace']["goBack"] = 'Go Back';
$Definition['MarketPlace']["or"] = 'or';
$Definition['MarketPlace']["Village"] = 'Village';
$Definition['MarketPlace']["Arrival"] = 'Arrival';
$Definition['MarketPlace']["in"] = 'in';
$Definition['MarketPlace']["hour"] = 'hour';
$Definition['MarketPlace']["at"] = 'at';
$Definition['MarketPlace']["sendToVillage"] = 'Send to village';
$Definition['MarketPlace']["returnFromVillage"] = 'Return from village';
$Definition['MarketPlace']["receiveFromVillage"] = 'Receive from village';
$Definition['MarketPlace']["Each of your merchants can carry"] = 'Each of your merchants can carry';
$Definition['MarketPlace']["Each of your merchants can carry resources"] = 'resources';
$Definition['MarketPlace']["prepare"] = 'prepare';
$Definition['MarketPlace']["noOffers"] = 'No Offers Was Found';
$Definition['MarketPlace']["I'm offering"] = 'I\'m offering';
$Definition['MarketPlace']['not enough resources'] = 'not enough resources';
$Definition['MarketPlace']['Unable to create offer; maximum ratio allowed is 2:1'] = 'Unable to create offer; maximum ratio allowed is 2:1.';
$Definition['MarketPlace']['Search'] = 'Search';
$Definition['MarketPlace']['Deliveries'] = 'Deliveries';
$Definition['MarketPlace']['noRoute'] = 'No trade route found.';
$Definition['MarketPlace']['Create new trade route'] = 'Create new trade route';
$Definition['MarketPlace']['notEnoughMerchants'] = "Not enough merchants. [MERCHANTS_NEEDED] merchants are needed, but there are only [MERCHANTS_AVAILABLE] merchants available.";
$Definition['MarketPlace']['tradeRouteDesc'] = 'The Gold club allows you to set up trade routes, which automatically send resources between your villages.';
$Definition['MarketPlace']['Enabled'] = 'Enabled';
$Definition['MarketPlace']['needToBeActive'] = 'In order to use this feature, you need to activate the Gold club!';
$Definition['MarketPlace']['Click here to exchange resources'] = 'Click here to exchange resources.';
$Definition['MarketPlace']['Trade your village\'s resources immediately with NPC merchant 1:1'] = 'Trade your village\'s resources immediately with NPC merchant 1:1';
$Definition['MarketPlace']['Send time'] = 'Send time';
$Definition['MarketPlace']['every %s minutes'] = 'every %s minutes';
$Definition['MarketPlace']['every %s hours'] = 'every %s hours';
$Definition['MarketPlace']['every %s days'] = 'every %s days';
$Definition['MarketPlace']['You are under protection'] = 'You are under protection.';

//Medals
$Definition['Medals']['Category'] = 'Category';
$Definition['Medals']['Week'] = 'Week';
$Definition['Medals']['Rank'] = 'Rank';
$Definition['Medals']['Resources'] = 'Resources';
$Definition['Medals']['Points'] = 'Points';
$Definition['Medals']['Received in week:'] = 'Received in week:';
$Definition['Medals']['category15'] = 'This medal shows that you\'ve been %s times in top 10 robbers';
$Definition['Medals']['category9'] = 'This medal shows that you\'ve been %s times in top 3 robbers';
$Definition['Medals']['category14'] = 'This medal shows that you\'ve been %s times in top 10 climbers.';
$Definition['Medals']['category8'] = 'This medal shows that you\'ve been %s times in top 3 climbers.';
$Definition['Medals']['category7'] = 'This medal showws that you\'ve been %s times between top 10 defenders.';
$Definition['Medals']['category13'] = 'This medal showws that you\'ve been %s times between top 3 defenders.';
$Definition['Medals']['category12'] = 'This medal shows that you\'ve been %s times in top 10 attackers.';
$Definition['Medals']['category6'] = 'This medal shows that you\'ve been %s times in top 3 attackers.';
$Definition['Medals']['category5'] = 'This medal shows that you\'ve been %s times in both attacker and defender tops.';
$Definition['Medals']['names'][1] = 'Attackers of the week';
$Definition['Medals']['names'][2] = 'Defenders of the week';
$Definition['Medals']['names'][3] = 'Climbers of the week';
$Definition['Medals']['names'][4] = 'Robbers of the week';
$Definition['Medals']['names'][5] = 'Top 10 Attacker and defenders of the week';
$Definition['Medals']['names'][6] = 'Top 3 attackers';
$Definition['Medals']['names'][12] = 'Top 10 attackers';
$Definition['Medals']['names'][7] = 'Top 3 defenders';
$Definition['Medals']['names'][13] = 'Top 10 defenders';
$Definition['Medals']['names'][8] = 'Top 3 climbers';
$Definition['Medals']['names'][14] = 'Top 10 climbers';
$Definition['Medals']['names'][9] = 'Top 3 robbers';
$Definition['Medals']['names'][15] = 'Top 10 robbers';
$Definition['Medals']['SpecialMedals'] = [
    // Ranke Wonder Of World
    1 => '<span class="gloriatitle">National Championship</span><div class="gloriacontent">Country: %s<br>Server: %s<br>Category: Wonder Of World<br>Name: %s<br>Tribe: %s<br>Rank: 1<br>WW level: %s</div>',
    2 => '<span class="gloriatitle">National Championship</span><div class="gloriacontent">Country: %s<br>Server: %s<br>Category: Wonder Of World<br>Name: %s<br>Tribe: %s<br>Rank: 2<br>WW level: %s</div>',
    3 => '<span class="gloriatitle">National Championship</span><div class="gloriacontent">Country: %s<br>Server: %s<br>Category: Wonder Of World<br>Name: %s<br>Tribe: %s<br>Rank: 3<br>WW level: %s</div>',

    // Ranke Offensive 1 ta 4 top 10
    4 => '<span class="gloriatitle">National Championship</span><div class="gloriacontent">Country: %s<br>Server: %s<br>Category: Offensive<br>Name: %s<br>Tribe: %s<br>Rank: 1<br>Points: %s</div>',
    5 => '<span class="gloriatitle">National Championship</span><div class="gloriacontent">Country: %s<br>Server: %s<br>Category: Offensive<br>Name: %s<br>Tribe: %s<br>Rank: 2<br>Points: %s</div>',
    6 => '<span class="gloriatitle">National Championship</span><div class="gloriacontent">Country: %s<br>Server: %s<br>Category: Offensive<br>Name: %s<br>Tribe: %s<br>Rank: 3<br>Points: %s</div>',
    7 => '<span class="gloriatitle">National Championship</span><div class="gloriacontent">Country: %s<br>Server: %s<br>Category: Offensive<br>Name: %s<br>Tribe: %s<br>Rank: 4<br>Points: %s</div>',
    // Ranke Defensive 1 ta 4 top 10
    8 => '<span class="gloriatitle">National Championship</span><div class="gloriacontent">Country: %s<br>Server: %s<br>Category: Defensive<br>Name: %s<br>Tribe: %s<br>Rank: 1<br>Points: %s</div>',
    9 => '<span class="gloriatitle">National Championship</span><div class="gloriacontent">Country: %s<br>Server: %s<br>Category: Defensive<br>Name: %s<br>Tribe: %s<br>Rank: 2<br>Points: %s</div>',
    10 => '<span class="gloriatitle">National Championship</span><div class="gloriacontent">Country: %s<br>Server: %s<br>Category: Defensive<br>Name: %s<br>Tribe: %s<br>Rank: 3<br>Points: %s</div>',
    11 => '<span class="gloriatitle">National Championship</span><div class="gloriacontent">Country: %s<br>Server: %s<br>Category: Defensive<br>Name: %s<br>Tribe: %s<br>Rank: 4<br>Points: %s</div>',
    // Ranke Pop Nafarate Avale 1 ta 4
    12 => '<span class="gloriatitle">National Championship</span><div class="gloriacontent">Country: %s<br>Server: %s<br>Category: Population <br>Name: %s<br>Tribe: %s<br>Rank: 1<br>Points: %s</div>',
    13 => '<span class="gloriatitle">National Championship</span><div class="gloriacontent">Country: %s<br>Server: %s<br>Category: Population <br>Name: %s<br>Tribe: %s<br>Rank: 2<br>Points: %s</div>',
    14 => '<span class="gloriatitle">National Championship</span><div class="gloriacontent">Country: %s<br>Server: %s<br>Category: Population <br>Name: %s<br>Tribe: %s<br>Rank: 3<br>Points: %s</div>',
    15 => '<span class="gloriatitle">National Championship</span><div class="gloriacontent">Country: %s<br>Server: %s<br>Category: Population <br>Name: %s<br>Tribe: %s<br>Rank: 4<br>Points: %s</div>',
];
//Messages
$Definition['Messages']['You cannot send a message to more than %s users'] = 'You cannot send a message to more than %s users.';
$Definition['Messages']['spam_unread_protection'] = 'Spam protection: You have %s unread messages which was sent to this player, you cannot send any messages to this player until the player reads the messages or you should wait two hours.';
$Definition['Messages']['Current message has already been reported as: x'] = 'Current message has already been reported as: %s.';
$Definition['Messages']['Error: Very long subject!'] = 'Error: Very long subject!';
$Definition['Messages']['Spam protection: Please wait for 10 minutes and try again'] = '<b>Spam protection</b>: Please wait for 10 minutes and try again.';
$Definition['Messages']['You are currently not part of any alliance'] = 'You are currently not part of any alliance.';
$Definition['Messages']['Inadmissible message'] = 'Inadmissible message.';
$Definition['Messages']['Mark as read'] = 'Mark as read';
$Definition['Messages']['Mark as unread'] = 'Mark as unread';
$Definition['Messages']['reportingSuccessful'] = 'reporting Successful sent.';
$Definition['Messages']['closeButtonText'] = 'Close';
$Definition['Messages']['Messages'] = 'Messages';
$Definition['Messages']['Inbox'] = 'Inbox';
$Definition['Messages']['needClub'] = 'For using this feature you need an activated gold club.';
$Definition['Messages']['Delete'] = 'Delete';
$Definition['Messages']['Subject'] = 'Subject';
$Definition['Messages']['Sender'] = 'Sender';
$Definition['Messages']['Sent at'] = 'Sent';
$Definition['Messages']['Read'] = 'Read';
$Definition['Messages']['Unread'] = 'Unread';
$Definition['Messages']['Your note is too long!'] = 'Your note is too long!';
$Definition['Messages']['select all'] = 'select all';
$Definition['Messages']['Recipient'] = 'Recipient';
$Definition['Messages']['Choose reason'] = 'Choose reason.';
$Definition['Messages']['Advertisement'] = 'Advertisement';
$Definition['Messages']['harassment'] = 'harassment';
$Definition['Messages']['gold'] = 'Gold buying';
$Definition['Messages']['Other'] = 'Other';
$Definition['Messages']['report'] = 'Report';
$Definition['Messages']['Attention: Misuse of the report function is punishable'] = 'Attention: Misuse of the report function is punishable.';
$Definition['Messages']['sender'] = 'Sender';
$Definition['Messages']['Report as spam'] = 'Report as spam';
$Definition['Messages']['back to send box'] = 'back to the inbox';
$Definition['Messages']['There are no messages available in the sentbox'] = 'There are no messages available in the sentbox.';
$Definition['Messages']['There are no messages available in the inbox'] = 'There are no messages available in the inbox.';
$Definition['Messages']['There are no messages available in the archive'] = 'There are no messages available in the archive.';
$Definition['Messages']['waiting for confirmation'] = 'waiting for confirmation';
$Definition['Messages']['Recover'] = 'Recover';
$Definition['Messages']['Addressbook'] = 'Address book';
$Definition['Messages']['send'] = 'send';
$Definition['Messages']['Alliance'] = 'Alliance';
$Definition['Messages']['xxx wrote:'] = '%s wrote:';
$Definition['Messages']['You dont have permission here'] = 'You dont have permission here';
$Definition['Messages']['player x does not exists'] = 'The name %s does not exist.';
$Definition['Messages']['you send your last message in x and you will be able to send message in y'] = 'You send your last message in %s and you will be able to send message in %s.';
$Definition['Messages']['no subject'] = 'No subject';
$Definition['Messages']['ConfirmDelete'] = 'Do you really want to delete this message?';
$Definition['Messages']['answer'] = 'Answer';
$Definition['Messages']['Player'] = 'Player';
$Definition['Messages']['Coordinates'] = 'Coordinates';
$Definition['Messages']['report'] = 'Report';
$Definition['Messages']['Troops'] = 'Troops';
$Definition['Messages']['preview'] = 'Preview';
$Definition['Messages']['back to the inbox'] = 'back to the inbox';
$Definition['Messages']['Write'] = 'Write';
$Definition['Messages']['Sent'] = 'Sent';
$Definition['Messages']['- saved -'] = '- Saved -';
$Definition['Messages']['Archive'] = 'Archive';
$Definition['Messages']['Notes'] = 'Notes';
$Definition['Messages']['Ignored players'] = 'Ignored players';
$Definition['Messages']['online now'] = 'Now online';
$Definition['Messages']['active players'] = 'max. 10h';
$Definition['Messages']['active 3days'] = 'max. 3 days';
$Definition['Messages']['active 7days'] = 'max. 7 days';
$Definition['Messages']['inactive'] = 'inactive';
$Definition['Messages']['Ambassador'] = 'Ambassador';
$Definition['Messages']['Alliance Invitation received'] = 'Alliance Invitation received';
$Definition['Messages']['Alliance Invitation revoked'] = 'Alliance Invitation revoked';
$Definition['Messages']['Spam protection: You must have at least %s pop to be able to send messages'] = 'Spam protection: You must have at least %s pop to be able to send messages';
$Definition['Messages']['AllianceInvitationRevokeText'] = <<<HTML
Hello %s,
<br /><br />
your invitation to join the alliance %s has been revoked by %s.
<br /><br />
Have fun and good luck!
HTML;
$Definition['Messages']['AllianceInvitationReceiveText'] = <<<HTML
Hello %s,
<br /><br />
you are invited by [player]%s[/player] to join the alliance [alliance]%s[/alliance].
<br /><br />
To accept the invitation go to your embassy and join the alliance. If you don't have an embassy yet, build one first.
<br /><br />
Have fun and good luck.
HTML;
$Definition['Messages']['WrittenBySitter%s'] = '- Written by Sitter %s -';
//NotFound
$Definition['notFound']['title'] = 'Nothing here!';
$Definition['notFound']['desc'] = 'We looked 404 times already but can\'t find anything';
//NPC
$Definition['npc'] = [
    "disabled_in_ww" => "You can't use this feature in WW Villages.",
    'npc_desc' => 'With the NPC merchant, you can distribute the resources in your warehouse as you desire.<br><br>The first line shows the current stock. In the second line, you can choose another distribution. The third line shows the difference between the old and new stock.',
    'sum' => 'Sum',
    'distribute_remaining_resources' => 'Distribute remaining resources.',
    'exchangeResources' => 'Exchange resources',
    'redeem_now' => 'Redeem now',
    'redeem' => 'Redeem',
    'remain' => 'remain',
    "build_marketPlace" => "Construct marketplace",
];
//Options
$Definition['Options']['Change name'] = 'Change name';
$Definition['Options']['Yes'] = 'Yes';
$Definition['Options']['No'] = 'No';
$Definition['Options']['You need to wait 7 days before deletion'] = 'Unfortunately, you cannot transfer your gold right now. If you have any questions, send an email to plus@' . (WebService::getJustDomain()) . '.';
$Definition['Options']['Newsletter'] = 'Newsletter';
$Definition['Options']['sitter'] = 'Sitter';
$Definition['Options']['Sitter(s) for this account'] = 'Sitter(s) for this account';
$Definition['Options']['Sitting for other account(s)'] = 'Sitting for other account(s)';
$Definition['Options']['Sitting for other account(s)Desc'] = 'You are set as the sitter for the following accounts. You can remove yourself as sitter by clicking on the red X.';
$Definition['Options']['MySittersDesc'] = 'A sitter can log in to your account with your name and his/her password. You may have a maximum of two sitters. ';
$Definition['Options']['no entry'] = 'No Entry';
$Definition['Options']['Here you can subscribe or unsubscribe to our newsletter'] = 'Here you can subscribe or unsubscribe to our newsletter.';
$Definition['Options']['Travian Games'] = 'Travian Games';
$Definition['Options']['invalid old email'] = 'Old email invalid.';
$Definition['Options']['invalid new email'] = 'New email address invalid!';
$Definition['Options']['Receive notifications about invitations to an alliance'] = 'Receive notifications about invitations to an alliance';
$Definition['Options']['new email exists'] = 'new email exists.';
$Definition['Options']['Name black listed'] = 'The new account name does either already exist or is not allowed. Please try another name..';
$Definition['Options']['Name exists'] = 'The new account name does either already exist or is not allowed. Please try another name.';
$Definition['Options']['Name too short'] = 'Name too short.';
$Definition['Options']['Name too long'] = 'Name too long.';
$Definition['Options']['Please enter a new account name and confirmation password'] = 'Please enter a new account name and confirmation password.';
$Definition['Options']['Confirmation password does not match'] = 'Confirmation password does not match.';
$Definition['Options']['Confirm with password'] = 'Confirm with password:';
$Definition['Options']['Change account name'] = 'Change account name';
$Definition['Options']['Number of changes'] = 'Number of changes:';
$Definition['Options']['Enter new account name'] = 'Enter new account name';
$Definition['Options']['changeNameDesc'] = 'You can change your account name here. Please be aware that your account name may not be in violation of the game rules or the terms & conditions. You can change your account name for free for %s times or until you reach %s population. Afterwards, changing your account name will be charged with %s Gold. An account name change with a population higher than %s is not possible!';
$Definition['Options']['Change password'] = 'Change password';
$Definition['Options']['Old Password'] = 'Old Password';
$Definition['Options']['New Password'] = 'New Password:';
$Definition['Options']['confirm'] = 'confirm';
$Definition['Options']['Change email'] = 'Change email';
$Definition['Options']['Old email'] = 'Old email';
$Definition['Options']['New email'] = 'New email';
$Definition['Options']['Change email desc'] = 'Please enter your old and your new email address. You will then receive a verification code at both email addresses which you have to enter here.';
$Definition['Options']['Game'] = 'Game';
$Definition['Options']['Account'] = 'Account';
$Definition['Options']['Delete account'] = 'Delete account';
$Definition['Options']['Delete account?'] = 'Delete account? ';
$Definition['Options']['Sitter'] = 'Sitter';
$Definition['Options']['Preferences'] = 'Preferences';
$Definition['Options']['Report filter'] = 'Report filter';
$Definition['Options']['Auto-complete'] = 'Auto-complete';
$Definition['Options']['No reports about transfers between your own villages'] = 'No reports about transfers between your own villages.';
$Definition['Options']['No reports about transfers to foreign villages'] = 'No reports about transfers to foreign villages.';
$Definition['Options']['No reports about transfers from foreign villages'] = 'No reports about transfers from foreign villages.';
$Definition['Options']['The LowRes version does not display images in reports'] = 'The LowRes version does not display images in reports.';
$Definition['Options']['Complete for rally point and marketplace'] = 'Complete for rally point and marketplace:';
$Definition['Options']['Own villages'] = 'Own villages ';
$Definition['Options']['Nearby villages'] = 'Nearby villages';
$Definition['Options']["Alliance members' villages"] = 'Alliance members\' villages';
$Definition['Options']["Display"] = 'Display';
$Definition['Options']["Don't display images in reports"] = 'Don\'t display images in reports.';
$Definition['Options']["Messages and reports per page"] = 'Messages and reports per page';
$Definition['Options']["Troop movements per page in rally point"] = 'Troop movements per page in rally point:';
$Definition['Options']["Time zone preferences"] = 'Time zone preferences';
$Definition['Options']["You can change your time zone here"] = 'You can change your time zone here.';
$Definition['Options']["Time zone"] = 'Time zone:';
$Definition['Options']["Date format"] = 'Date format:';
$Definition['Options']["local time zones"] = 'local time zones';
$Definition['Options']["general time zones"] = 'general time zones';
$Definition['Options']["change_mail_desc"] = 'A verification code was sent to both the old and the new email addresses. Enter both in the correct fields here.';
$Definition['Options']["Old email code"] = 'Old email code';
$Definition['Options']["New email code"] = 'New email code';
$Definition['Options']["x of y changes"] = '%s of %s changes ';
$Definition['Options']["password wrong"] = 'The password is wrong.';
$Definition['Options']["deleteDesc"] = 'You can delete your account here. After starting the cancellation, it will take one hour to complete the deletion of your account. You can cancel the deletion at any time by clicking on the red X. An account in deletion can no longer access auctions or the exchange office!';
$Definition['Options']["codes are not correct"] = 'Invalid codes!';
$Definition['Options']["email_changed"] = 'Email changed';
$Definition['Options']["Email change is in progress"] = 'Email change is in progress. ';
$Definition['Options']["EmailChange_new_subject"] = 'Travian account email change part 2';
$Definition['Options']["EmailChange_new"] = '
<div style="text-align: left; direction: LTR">
Hello %s,

you have selected this email address as the new email for your Travian account
on world comx. Please enter the following code in the box "Code new address" in
your profile located in the "account" tab:

Code: %s

You will receive another email to your old address with a second code which you
should enter in the box "Code old address".
</div>
';
$Definition['Options']["EmailChange_old_subject"] = 'Travian account email change part 1';
$Definition['Options']["EmailChange_old"] = '
<div style="text-align: left; direction: LTR">
Hello %s,

you have requested a change of this email for your Travian account on world
comx.
Please enter the following code in the box "Code old address" in your profile on
tab "account":

Code: %s

You will receive another email to your new address with a second code which you
should enter in the box "Code new address".
</div>';
$Definition['Options']['Vacation'] = 'Vacation';
$Definition['Options']['Use the vacation to protect your villages while being abroad'] = 'Use the vacation to protect your villages while being abroad.';
$Definition['Options']['While in vacation mode the following actions will be deactivated'] = 'While in vacation mode the following actions will be deactivated';
$Definition['Options']['send or receive troops'] = 'send or receive troops';
$Definition['Options']['start new building orders'] = 'start new building order';
$Definition['Options']['using the marketplace'] = 'using the marketplace';
$Definition['Options']['start training troops'] = 'start training troops';
$Definition['Options']['join alliances'] = 'join alliances';
$Definition['Options']['delete your account'] = 'delete your account';
$Definition['Options']['Alliance settings'] = 'Alliance settings';
$Definition['Options']['Show alliance news'] = 'Show alliance news';
$Definition['Options']['Alliance members founded new village'] = 'Alliance members founded new village';
$Definition['Options']['New alliance member joined'] = 'New alliance member joined';
$Definition['Options']['Player has been invited'] = 'Player has been invited';
$Definition['Options']['Player has left alliance'] = 'Player has left alliance';
$Definition['Options']['Player was kicked from alliance'] = 'Player was kicked from alliance';
$Definition['Options']['There are no outgoing troops'] = 'There are no outgoing troops';
$Definition['Options']['There are no incoming troops'] = 'There are no incoming troops';
$Definition['Options']['There are no troops reinforing other players'] = 'There are no troops reinforing other players';
$Definition['Options']['No other player reinforces you'] = 'No other player reinforces you';
$Definition['Options']['You dont own a Wonder of the World Village'] = 'You dont own a Wonder of the World Village';
$Definition['Options']['You dont own an artifact'] = 'You dont own an artifact';
$Definition['Options']['You dont have beginners protection left'] = 'You dont have beginners protection left';
$Definition['Options']['There are no troops in your traps'] = 'There are no troops in your traps';
$Definition['Options']['x/9 conditions met'] = '%s/9 conditions met';
$Definition['Options']['Available Days x/y'] = 'Available Days %s/%s';
$Definition['Options']['How many days should the vacation mode last'] = 'How many days should the vacation mode last';
$Definition['Options']['Vacation til'] = 'Vacation til';
$Definition['Options']['Your account is not in deletion'] = 'Your account is not in deletion';
$Definition['Options']['enter vacation mode now'] = 'enter vacation mode now';
$Definition['Options']['Vacation mode is active'] = 'Vacation mode is active';
$Definition['Options']['Are you sure you want to enter vacation mode?'] = 'Are you sure you want to enter vacation mode?';
$Definition['Options']['Your account will be protected, and the resource production will continue'] = 'Your account will be protected, and the resource production will continue.';
$Definition['Options']['So will the crop consumption by troops too, which may lead to troop starvation'] = 'So will the crop consumption by troops too, which may lead to troop starvation.';
$Definition['Options']['Your are not able to'] = 'Your are not able to';
$Definition['Options']['upgrade buildings'] = 'upgrade buildings';
$Definition['Options']['train troops'] = 'train troops';
$Definition['Options']['send troops'] = 'send troops';
$Definition['Options']['send merchants'] = 'send merchants';
$Definition['Options']['delete your account'] = 'delete your account';
$Definition['Options']['Remaining days in vacation mode'] = 'Remaining days in vacation mode';
$Definition['Options']['day(s)'] = 'day(s)';
$Definition['Options']['You can abort vacation mode now'] = 'You can abort vacation mode now';
$Definition['Options']['abort vacation mode'] = 'abort vacation mode';
$Definition['Options']['Vacation mode runs til'] = 'Vacation mode runs til';
$Definition['Options']['player name'] = 'player name';
$Definition['Options']['Send raids'] = 'Send raids';
$Definition['Options']['Send reinforcements to other players'] = 'Send reinforcements to other players';
$Definition['Options']['Send resources to other players'] = 'Send resources to other players';
$Definition['Options']['Buy and spend Gold'] = 'Buy and spend Gold';
$Definition['Options']['Delete and archive messages and reports'] = 'Read and send messages';
$Definition['Options']['Contribute resources to alliance bonuses'] = 'Contribute resources to alliance bonuses';
$Definition['Options']['Read and send messages'] = 'Delete and archive messages and reports';
$Definition['Options']['language settings'] = 'language settings';
$Definition['Options']['Language'] = 'Language';
$Definition['Options']['Support colorBlind title'] = 'Colorblind support';
$Definition['Options']['Use colorBlind?'] = 'Use colorblind support?';
$Definition['Options']['Support colorBlind desc'] = 'You can activate the colorblind support to use optimized icons and improved colors. This mode doesn\'t alter any game mechanics.';
$Definition['Options']['Transfer gold'] = 'Transfer gold';
$Definition['Options']['You have Gold %s pieces of gold, %s pieces can be transferred after deleting your account!'] = 'You have Gold %s pieces of gold. %s pieces can be transferred after deleting your account!';
$Definition['Options']['Auto reload status'] = 'Auto reload settings';
$Definition['Options']['Enable auto reload?'] = 'Enable auto reload?';
$Definition['Options']['Use fast upgrade on buildings'] = 'Use fast upgrade on buildings';
$Definition['Options']['This player is sitter for 2 players'] = 'This player is sitter for 2 players.';
$Definition['Options']['You can set the page to auto reload, the page will be automatically refreshed when timer reaches 0'] = 'You can set the page to auto reload, the page will be automatically refreshed when timer reaches 0.';

$Definition['Options']['Graphic pack'] = 'Graphic pack';
$Definition['Options']['You can change the way the game looks for you'] = 'You can change the way the game looks for you.';
$Definition['Options']['new'] = 'New';


//PaymentWizard
$Definition['PaymentWizard']['You have a WW village or Artifact So you cannot use this feature'] = 'You have a WW village or Artifact So you cannot use this feature.';
$Definition['PaymentWizard']['Gold'] = 'Gold';
$Definition['PaymentWizard']['goldClub'] = 'Gold club';
$Definition['PaymentWizard']['x gold moneyUnit'] = '%s Gold %s %s';
$Definition['PaymentWizard']['paymentUnAvailable'] = 'Currently payment is not available.';
$Definition['PaymentWizard']['location'] = 'Location';
$Definition['PaymentWizard']['ChangeLocation'] = 'Change location';
$Definition['PaymentWizard']['Package'] = 'Package';
$Definition['PaymentWizard']['ChoosePackage'] = 'Choose package';
$Definition['PaymentWizard']['changePackage'] = 'Change package';
$Definition['PaymentWizard']['BuySettings'] = 'Buy settings';
$Definition['PaymentWizard']['hour'] = 'hour';
$Definition['PaymentWizard']['Not Available yet'] = 'Not available yet';
$Definition['PaymentWizard']['All displayed prices are final prices'] = 'All displayed prices are final prices.';
$Definition['PaymentWizard']['You can check the status of your order at any time'] = 'You can check the status of your order at any time.';
$Definition['PaymentWizard']['Show open orders'] = 'Show open orders';
$Definition['PaymentWizard']['Hide open orders'] = 'Hide open orders';
$Definition['PaymentWizard']['Payment options:'] = 'Payment options:';
$Definition['PaymentWizard']['Show payment methods'] = 'Show payment methods';
$Definition['PaymentWizard']['Buy gold'] = 'Buy gold';
$Definition['PaymentWizard']['Advantages'] = 'Advantages';
$Definition['PaymentWizard']['Plus Support'] = 'Plus Support';
$Definition['PaymentWizard']['Earn Gold'] = 'Earn Gold';
$Definition['PaymentWizard']['Delivery:'] = 'Delivery:';
$Definition['PaymentWizard']['Select payment method'] = 'Select payment method';
$Definition['PaymentWizard']['Step3-ChoosePayment'] = 'Step3 - ChoosePayment';
$Definition['PaymentWizard']['step'] = 'Step';
$Definition['PaymentWizard']['notEnoughGoldForThisOption'] = 'You do not have enough gold to use this feature!';
$Definition['PaymentWizard']['ChooseAnotherPackage'] = 'Choose another package';
$Definition['PaymentWizard']['BuyNow'] = 'Buy now?';
$Definition['PaymentWizard']['Gold'] = 'Gold';
$Definition['PaymentWizard']['Please activate advantage that you can choose'] = 'Please choose which advantage you would like to unlock:';
$Definition['PaymentWizard']['ToTheEndOfTheGame'] = 'whole game round';
$Definition['PaymentWizard']['Days remaining'] = 'Days remaining:';
$Definition['PaymentWizard']['until'] = 'until';
$Definition['PaymentWizard']['EndsAtX'] = 'Ends at %s.';
$Definition['PaymentWizard']['Bonus duration'] = 'Bonus duration';
$Definition['PaymentWizard']['Days'] = 'Days';
$Definition['PaymentWizard']['Payment rules'] = 'Payment rules';
$Definition['PaymentWizard']['PaymentRulesHTML'] = '<div style="width: 400px; font-size: 13px;"><h1 style="color: red; text-align: center;">Buy Gold Rules</h1><h2>Rules to buy Gold</h2><h3>1. Automated system</h3>Our Payment system is automatic and after successful buy ,Gold will added to your account automatically<h3>2. The system didn\'t give your gold?</h3>Sometime System will stuck or the gateways need to check the information before let us know and the gold will not transfer to user account! in this case you can\'t Get your money back!! Just send a message to multihunter and we will add your gold as soon as possible.<h3 style="color: red;">Important:</h3><p>If you buy gold and play with it and request paypal for your money back, we can\'t accept that and your account will be banned!</p><h3 style="color: red;">Important:</h3>if Our system goes Down we will give you extra gold or ... to make you happy and get back you to the game.<h3 style="color: red;">Important:</h3>You can\'t Request for get back your money from us or <b>PayPal</b> for any reason.<h3 style="color: red;">Important:</h3>if Our system shut down for more than 1 day we will get back your gold</p><p>You <b>Should</b> read these rules before buy any golds, by buying gold you accepted our rules!.</div>';
$Definition['PaymentWizard']['Extend automatically'] = 'Extend automatically';
$Definition['PaymentWizard']['Activated To End Of the game'] = 'Activated To <b>End Of the game</b>';
$Definition['PaymentWizard']['GoldClub'] = 'Gold club';
$Definition['PaymentWizard']['goldClubDesc'] = '<p>Gives advantages for the whole game round!</p>
<p>Enable your merchants to automatically send resources multiple times, find slots with increased crop production faster on the map and archive your messages and reports. Use the farm list to manage your attacks and allow your troops to evade in case of an attack on your capital!</p>';
$Definition['PaymentWizard']['Plus'] = 'Plus';
$Definition['PaymentWizard']['PlusDesc'] = ' <p>Provides a better overview and other advantages for the time displayed!</p>
                <p>Adjust the game to your playing style with direct links and use the superior overview of the large map. Receive attack warnings and detailed information in the village overview. Order your merchants to automatically repeat a shipment for a second time around and queue an additional construction order!</p>';
$Definition['PaymentWizard']['+25Wood'] = '+25% lumber production';
$Definition['PaymentWizard']['+25WoodDesc'] = ' <p>Grants a 25% increase in production of the selected resource in all your villages for the duration displayed.</p>
                <p>The 25% bonus does not only apply to the base production of the resource, but it does apply to all other bonuses</p>';
$Definition['PaymentWizard']['+25Clay'] = '+25% clay production';
$Definition['PaymentWizard']['+25ClayDesc'] = '<p>Grants a 25% increase in production of the selected resource in all your villages for the duration displayed.</p>
                <p>The 25% bonus does not only apply to the base production of the resource, but it does apply to all other bonuses!</p>';
$Definition['PaymentWizard']['+25Iron'] = '+25% iron production';
$Definition['PaymentWizard']['+25IronDesc'] = ' <p>Grants a 25% increase in production of the selected resource in all your villages for the duration displayed.</p>
                <p>The 25% bonus does not only apply to the base production of the resource, but it does apply to all other bonuses!</p>';
$Definition['PaymentWizard']['+25Crop'] = '+25% crop production';
$Definition['PaymentWizard']['+25CropDesc'] = '<p>Grants a 25% increase in production of the selected resource in all your villages for the duration displayed.</p>
                <p>The 25% bonus does not only apply to the base production of the resource, but it does apply to all other bonuses!</p>';
$Definition['PaymentWizard']['Travian Answers'] = 'Travian Answers';
$Definition['PaymentWizard']['Recipient [RECEIVER_COUNT]:'] = 'Recipient [RECEIVER_COUNT]:';
$Definition['PaymentWizard']['mentor'] = 'Advisor';
$Definition['PaymentWizard']['How can we help?'] = 'How can we help?';
$Definition['PaymentWizard']['Plus FAQ'] = 'Plus FAQ';
$Definition['PaymentWizard']['Plus FAQ Desc'] = 'In case you have questions regarding a gold transfer, the different Plus features or buying gold, our support tool "Answers" will help you.';
$Definition['PaymentWizard']['Contact Plus Support'] = 'Contact Plus Support';
$Definition['PaymentWizard']['Plus Support'] = 'Plus Support';
$Definition['PaymentWizard']['Plus Support Desc'] = 'You\'re experiencing a problem and cannot find an answer to your question? You can contact our Plus Support here.';
$Definition['PaymentWizard']['Miscellaneous information'] = 'Miscellaneous information';
$Definition['PaymentWizard']['Miscellaneous information warning'] = 'In case you wish to delete your account, please note that this is only possible 7 days after the last gold purchase or transfer.';
$Definition['PaymentWizard']['How can I invite players?'] = 'How can I invite players?';
$Definition['PaymentWizard']['Players invited so far'] = 'Players invited so far';
$Definition['PaymentWizard']['If you invite players to open an account in Travian on this server, you can receive Gold as a reward, You can use this Gold to purchase a Plus Account or other Gold advantages'] = 'If you invite players to open an account in Travian on this server, you can receive Gold as a reward. You can use this Gold to purchase a Plus Account or other Gold advantages.';
$Definition['PaymentWizard']['To bring in new players, you can invite them by email or have them click on your REF link'] = 'To bring in new players, you can invite them by email or have them click on your REF link.';
$Definition['PaymentWizard']['As soon as an invited player has reached x villages'] = 'As soon as an invited player has reached <span class="amount">2</span> villages, you will receive <span class="goldReward"><img src="img/x.gif" class="gold" alt="Gold"> <span class="amount">' . Config::getProperty("gold", "invitePlayerGold") . '.</span></span>';
$Definition['PaymentWizard']['back to overview'] = 'back to overview';
$Definition['PaymentWizard']['Choose an option to earn gold'] = 'Choose an option to earn gold';
$Definition['PaymentWizard']['Send link to friends'] = 'Send link to friends';
$Definition['PaymentWizard']['You can send a link to your friends via email, inviting them to Travian'] = 'You can send a link to your friends via email, inviting them to Travian.';
$Definition['PaymentWizard']['Send email to friends'] = 'Send email to friends';
$Definition['PaymentWizard']['Your personal referral link'] = 'Your personal referral link';
$Definition['PaymentWizard']['Display a list of all the players you have invited so far'] = 'Display a list of all the players you have invited so far';
$Definition['PaymentWizard']['Display list of all invited players'] = 'Display list of all invited players';
$Definition['PaymentWizard']['Please enter recipients email addresses'] = 'Please enter recipients email addresses';
$Definition['PaymentWizard']['Recipient 1'] = 'Recipient 1';
$Definition['PaymentWizard']['Recipient 2'] = 'Recipient 2';
$Definition['PaymentWizard']['Add more people'] = 'Add more people';
$Definition['PaymentWizard']['Add a personal message (optional)'] = 'Add a personal message (optional)';
$Definition['PaymentWizard']['Cancel'] = 'Cancel';
$Definition['PaymentWizard']['Send invitation'] = 'Send invitation';

$Definition['PaymentWizard']['INVITE_EMAIL_MESSAGE'] = 'Hello,

player [PLAYERNAME] ([PLAYEREMAIL]) wants to invite you
to play the browser strategy game Travian together.
[PLAYERNAME] plays on world [GAMEWORLD] with tribe [TRIBE].

To sign up, please use this link:
<a href="[INVITE_LINK]">[INVITE_LINK]</a>

----------

[CUSTOM_MESSAGE]';
$Definition['PaymentWizard']['You have not brought in any new players yet'] = 'You have not brought in any new players yet.';
$Definition['PaymentWizard']['INVITE_EMAIL_SUBJECT'] = 'Travian: Invitation from player [PLAYERNAME]';
$Definition['PaymentWizard']['Number of successfully sent invitations: x'] = 'Number of successfully sent invitations: %s';
$Definition['PaymentWizard']['OpenOffers'] = 'Open offers';
$Definition['PaymentWizard']['Order Date'] = 'Order Date';
$Definition['PaymentWizard']['Payment'] = 'Payment';
$Definition['PaymentWizard']['Booking'] = 'Booking';
$Definition['PaymentWizard']['Presenter'] = 'Presenter';
$Definition['PaymentWizard']['Units'] = 'Units';
$Definition['PaymentWizard']['Price'] = 'Price';
$Definition['PaymentWizard']['Pending'] = 'Pending';
$Definition['PaymentWizard']['Success'] = 'Success';
$Definition['PaymentWizard']['Success2'] = 'Failed';
$Definition['PaymentWizard']['Cancelled'] = 'Cancelled';
$Definition['PaymentWizard']['booked'] = 'Booked';
$Definition['PaymentWizard']['not booked'] = 'Not booked';
$Definition['PaymentWizard']['no Open Orders'] = 'No open orders.';
$Definition['PaymentWizard']['AccountDeletionErr'] = 'The account is under deletion.<br>It is not possible to buy gold.<br><br>Unfortunately, this is necessary in order to avoid payment frauds.';
$Definition['PaymentWizard']['The payment system is not available'] = 'The payment system is not available.';
$Definition['PaymentWizard']['An error occurred The payment system is not available at the moment Please try again later'] = 'An error occurred The payment system is not available at the moment Please try again later.';
$Definition['PaymentWizard']['World'] = 'World';
$Definition['PaymentWizard']['UID'] = 'UID';
$Definition['PaymentWizard']['Member since'] = 'Member since';
$Definition['PaymentWizard']['Inhabitants'] = 'Inhabitants';
$Definition['PaymentWizard']['Villages'] = 'Villages';
$Definition['PaymentWizard']['paymentFeatures'] = 'Plus Features';
$Definition['PaymentWizard']['Troops'] = 'Troops';
$Definition['PaymentWizard']['buyAnimal'] = 'Buy Animals';
$Definition['PaymentWizard']['General'] = 'General';
$Definition['PaymentWizard']['GeneralOptions'] = 'General Options';
$Definition['PaymentWizard']['buyTroops'] = 'Buy Troops';
$Definition['PaymentWizard']['buyResources'] = 'Buy Resources';
$Definition['PaymentWizard']['WWDisabled'] = 'You can\'t use this feature in a WW Village.';
$Definition['PaymentWizard']['Buy'] = 'Buy';
$Definition['PaymentWizard']['delivery'] = 'Delivery';
$Definition['PaymentWizard']['Immediately'] = 'Immediately';
$Definition['PaymentWizard']['Minutes'] = 'min(s)';
$Definition['PaymentWizard']['rallyPointTo20'] = 'Build RallyPoint level 20';
$Definition['PaymentWizard']['rallyPointTo20Desc'] = 'Build a level 20 rally point on current village.';
$Definition['PaymentWizard']['oneHourOfProduction'] = 'Buy 1 hour village production Resource';
$Definition['PaymentWizard']['oneHourOfProductionDesc'] = '1 hour of your resource production, will be added to your current village.';
$Definition['PaymentWizard']['finishTraining'] = 'Finish All Training troops Instant';
$Definition['PaymentWizard']['finishTrainingDesc'] = 'All your troops on the queue list in the current village will train instantly.';
$Definition['PaymentWizard']['moreProtection'] = 'Protection';
$Definition['PaymentWizard']['moreProtectionDesc'] = 'With protection enabled no one can attack you when you are away.';
$Definition['PaymentWizard']['fasterTraining'] = '+%s%% faster training';
$Definition['PaymentWizard']['fasterTrainingDesc'] = 'You can train faster in all of your village in this period.';
$Definition['PaymentWizard']['academyResearchAll'] = 'Research all units';
$Definition['PaymentWizard']['academyResearchAllDesc'] = 'Research all units in village. No need to research in academy anymore.';
$Definition['PaymentWizard']['smithyUpgradeAllToMax'] = 'Upgrade all troops to max level in smithy';
$Definition['PaymentWizard']['smithyUpgradeAllToMaxDesc'] = 'All troops will be upgraded to max level in smithy.';
$Definition['PaymentWizard']['cancelTrainingQueue'] = 'Clean training queue';
$Definition['PaymentWizard']['cancelTrainingQueueDesc'] = 'All training queue will be deleted. No refund of resources included.';
$Definition['PaymentWizard']['increaseStorage'] = 'Increase storage';
$Definition['PaymentWizard']['increaseStorageDesc'] = 'Increases current storage capacity by a level 20 storage.';
$Definition['PaymentWizard']['Gold bank'] = 'Gold bank';
$Definition['PaymentWizard']['Show all the golds you have saved'] = 'Show all saved golds';
$Definition['PaymentWizard']['Display saved golds and how to use them'] = 'Display saved golds and how to use them';
$Definition['PaymentWizard']['Voucher code'] = 'Voucher code';
$Definition['PaymentWizard']['Voucher ID'] = 'Voucher ID';
$Definition['PaymentWizard']['Gold'] = 'Gold';
$Definition['PaymentWizard']['Action'] = 'Action';
$Definition['PaymentWizard']['Use'] = 'Use';
$Definition['PaymentWizard']['Date'] = 'Date';
$Definition['PaymentWizard']['Used: %s of %s'] = 'Used: %s of %s';
$Definition['PaymentWizard']['No saved golds'] = 'You have no saved golds!';
$Definition['PaymentWizard']['Are you sure?'] = 'Are you sure?';
$Definition['PaymentWizard']['This feature is disabled'] = 'This feature is disabled.';
$Definition['PaymentWizard']['Gold bank is disabled'] = 'Gold bank is disabled';
$Definition['PaymentWizard']['Invitation is closed'] = 'Invitation is closed';
$Definition['PaymentWizard']['Server is closed for invitations'] = 'Server is closed for invitations.';
$Definition['PaymentWizard']['Gold bank is disabled'] = 'Gold bank is disabled.';
$Definition['PaymentWizard']['Power'] = 'Power!';
$Definition['PaymentWizard']['Attack/Defense Bonus'] = 'Attack/Defense Bonus';


$Definition['PaymentWizard']['atkBonus'] = '+%s%% Attack Bonus';
$Definition['PaymentWizard']['atkBonusDesc'] = 'Increases your total troops offensive bonus by a percent.';
$Definition['PaymentWizard']['defBonus'] = '+%s%% Defense Bonus';
$Definition['PaymentWizard']['defBonusDesc'] = 'Increases your total troops defensive bonus by a percent.';
$Definition['PaymentWizard']['Protection'] = 'Protection';
$Definition['PaymentWizard']['Protection Packages'] = 'Protection packages';
$Definition['PaymentWizard']['Protection daily limit reached'] = 'Protection daily limit reached.';
$Definition['PaymentWizard']['You have %s hour(s) of protection left'] = 'You have %s hour(s) of protection left.';
$Definition['PaymentWizard']['You have no protection left'] = 'You have no protection left.';
$Definition['PaymentWizard']['You can buy %s hour(s) of protection per day'] = 'You can buy %s hour(s) of protection per day.';
$Definition['PaymentWizard']['You have %s golds in your vouchers'] = 'You have %s golds in your vouchers.';


$Definition['PaymentWizard']['Location'] = 'Location';
$Definition['PaymentWizard']['Packages'] = 'Packages';
$Definition['PaymentWizard']['Payment methods'] = 'Payment methods';
$Definition['PaymentWizard']['Overview'] = 'Overview';
$Definition['PaymentWizard']['Selected package'] = 'Selected package';
$Definition['PaymentWizard']['Your new gold balance'] = 'Your new gold balance';
$Definition['PaymentWizard']['Gold'] = 'Gold';
$Definition['PaymentWizard']['Price'] = 'Price';
$Definition['PaymentWizard']['Buy now'] = 'Buy now';
$Definition['PaymentWizard']['Voucher'] = 'Voucher';
$Definition['PaymentWizard']['Redeem'] = 'Redeem';
$Definition['PaymentWizard']['Redeem voucher'] = 'Redeem voucher';
$Definition['PaymentWizard']['Open orders'] = 'Open orders';
$Definition['PaymentWizard']['Voucher rules'] = 'Voucher rules';
$Definition['PaymentWizard']['voucherRules'] = [
    'Only ' . (100 - Config::getProperty("gold", "voucherTaxPercent")) . '% of remaining golds will be transferred.',
    'The voucher code can be used to redeem code on any user account (without email).',
    'Only bought golds and bonuses will be saved as vouchers.',
    sprintf('Alliance prize is for %s main members that their population is above %s.', Config::getProperty("bonus", "bonusGoldTopAllianceCount"), Config::getProperty("bonus", "bonusGoldTopAllianceMinPop")),
    'You cannot sell vouchers.',
    'Voucher codes will last only ' . Config::getProperty("gold", "voucherExpireDays") . ' days.',
];
$Definition['PaymentWizard']['Reason'] = 'Reason';
$Definition['PaymentWizard']['Show'] = 'Show';
$Definition['PaymentWizard']['Voucher'] = 'Voucher';
$Definition['PaymentWizard']['Vouchers'] = 'Vouchers';
$Definition['PaymentWizard']['History'] = 'History';
$Definition['PaymentWizard']['Email'] = 'Email';
$Definition['PaymentWizard']['Yes'] = 'Yes';
$Definition['PaymentWizard']['Used'] = 'Used';
$Definition['PaymentWizard']['Use details'] = 'Use details';
$Definition['PaymentWizard']['Voucher details'] = 'Voucher details';
$Definition['PaymentWizard']['World ID'] = 'World ID';
$Definition['PaymentWizard']['Player'] = 'Player';
$Definition['PaymentWizard']['Gold num'] = 'Gold count';
$Definition['PaymentWizard']['Use voucher'] = 'Use vouchers';
$Definition['PaymentWizard']['Invalid voucher code'] = 'Invalid voucher code';
$Definition['PaymentWizard']['Unable to use voucher'] = 'Unable to use voucher';
$Definition['PaymentWizard']['Redeem gold by gold number'] = 'Redeem gold by gold number';
$Definition['PaymentWizard']['You don`t have enough gold in your bank'] = 'You don`t have enough gold in your bank.';
$Definition['PaymentWizard']['Gold number must be 20 or more'] = 'Gold number must be 20 or more.';
$Definition['PaymentWizard']['%s golds was added to your account'] = '%s golds was added to your account.';
$Definition['PaymentWizard']['Voucher code'] = 'Voucher code';
$Definition['PaymentWizard']['Use voucher with code'] = 'Use voucher with code';
$Definition['PaymentWizard']['Your voucher(s)'] = 'Your voucher(s)';
$Definition['PaymentWizard']['You have no voucher codes'] = "You don't have any voucher(s).";
$Definition['PaymentWizard']['VoucherReasons']['gift'] = 'Gift';
$Definition['PaymentWizard']['VoucherReasons']['remaining'] = 'Remaining Gold';
$Definition['PaymentWizard']['VoucherReasons']['winner'] = 'Winner';
$Definition['PaymentWizard']['VoucherReasons']['2ndWinner'] = '2nd Winner';
$Definition['PaymentWizard']['VoucherReasons']['3rdWinner'] = '3rd Winner';
$Definition['PaymentWizard']['VoucherReasons']['winnerAlliance'] = 'Winner alliance';
$Definition['PaymentWizard']['VoucherReasons']['topOff'] = 'Top Offensive';
$Definition['PaymentWizard']['VoucherReasons']['topDef'] = 'Top Defensive';
$Definition['PaymentWizard']['VoucherReasons']['topClimber'] = 'Top Climber';
$Definition['PaymentWizard']['VoucherReasons']['topOffHammer'] = 'Top Offensive hammer';
$Definition['PaymentWizard']['VoucherReasons']['topDefHammer'] = 'Top Defensive hammer';
$Definition['PaymentWizard']['VoucherReasons']['payment'] = 'Payment Wizard';
$Definition['PaymentWizard']['VoucherReasons']['Partial use'] = 'Partial use';
$Definition['PaymentWizard']['PayPalVATDesc'] = 'PayPal payments will add 3% VAT + 0.30$ to price.';
$Definition['PaymentWizard']['Animals purchased'] = 'Animals purchased!';
$Definition['PaymentWizard']['Troops purchased'] = 'Troops purchased!';
$Definition['PaymentWizard']['Resources purchased!'] = 'Resources purchased!';
$Definition['PaymentWizard']['You can buy animals every %s %s'] = 'You can buy animals every %s %s.';
$Definition['PaymentWizard']['You can buy resources every %s %s'] = 'You can buy resources every %s %s.';
$Definition['PaymentWizard']['You can buy troops every %s %s'] = 'You can buy troops every %s %s.';
$Definition['PaymentWizard']['You need to wait %s %s before buying this package'] = 'You need to wait %s %s before buying this package.';

$Definition['PaymentWizard']['buyBuildings'] = 'Buy Buildings';
$Definition['PaymentWizard']['buildMaxWarehouse'] = 'Build a Warehouse level 20 in the village.';
$Definition['PaymentWizard']['buildMaxWarehouseDesc'] = '';
$Definition['PaymentWizard']['buildMaxGranary'] = 'Build a Granary level 20 in the village.';
$Definition['PaymentWizard']['buildMaxGranaryDesc'] = '';
$Definition['PaymentWizard']['upgradeMainBuildingTo20'] = 'Upgrade Main Building level 20 in the village.';
$Definition['PaymentWizard']['upgradeMainBuildingTo20Desc'] = '';
$Definition['PaymentWizard']['buildMaxRallyPoint'] = 'Build a RallyPoint level 20 in the village.';
$Definition['PaymentWizard']['buildMaxRallyPointDesc'] = '';
$Definition['PaymentWizard']['buildMaxBarracks'] = 'Build Barracks level 20 in the village.';
$Definition['PaymentWizard']['buildMaxBarracksDesc'] = '';
$Definition['PaymentWizard']['buildMaxStable'] = 'Build a Stable level 20 in the village.';
$Definition['PaymentWizard']['buildMaxStableDesc'] = '';
$Definition['PaymentWizard']['buildMaxWorkshop'] = 'Build a Workshop level 20 in the village.';
$Definition['PaymentWizard']['buildMaxWorkshopDesc'] = '';
$Definition['PaymentWizard']['buildMaxAcademy'] = 'Build an Academy level 20 in the village.';
$Definition['PaymentWizard']['buildMaxAcademyDesc'] = '';
$Definition['PaymentWizard']['buildMaxSmithy'] = 'Build a Smithy level 20 in the village.';
$Definition['PaymentWizard']['buildMaxSmithyDesc'] = '';
$Definition['PaymentWizard']['buildMaxTrasury'] = 'Build a Trasury level 20 in the village.';
$Definition['PaymentWizard']['buildMaxTrasuryDesc'] = '';
$Definition['PaymentWizard']['buildMaxTournametnSquare'] = 'Build a Tournament Square level 20 in the village.';
$Definition['PaymentWizard']['buildMaxTournametnSquareDesc'] = '';
$Definition['PaymentWizard']['upgradeAllResourcesTo5'] = 'Upgrade Resources Fields to level 5';
$Definition['PaymentWizard']['upgradeAllResourcesTo5Desc'] = '';
$Definition['PaymentWizard']['upgradeAllResourcesTo10'] = 'Upgrade Resources Fields to level 10';
$Definition['PaymentWizard']['upgradeAllResourcesTo10Desc'] = '';
$Definition['PaymentWizard']['upgradeAllResourcesTo20'] = 'Upgrade Resources Fields to level 20';
$Definition['PaymentWizard']['upgradeAllResourcesTo20Desc'] = '';
$Definition['PaymentWizard']['upgradeAllResourcesTo30'] = 'Upgrade Resources Fields to level 30';
$Definition['PaymentWizard']['upgradeAllResourcesTo30Desc'] = '';

//
$Definition['productionOverview'] = [
    "productionOverview" => "Production overview",
    "balance" => "balance",
    "production_field" => "Resources field",
    "production_per_hour" => "Hourly production",
    "production" => "production",
    "bonus" => "Bonus",
    "production_bonus" => "Production bonus",
    "Oases" => "Oases",
    "total_bonus" => "Total bonus",
    "total_production_per_hour" => "Total production per hour",
    "hero_production" => "Hero production",
    "interim_balance" => "Interim balance",
    "total" => "Total",
    "HDP" => "Horse drinking pool",
    "sum" => "Sum",
    "inactive" => "inactive",
    "productionBoostSpeechBubbleFurtherInfo" => 'The production bonus increases the production of the resource in <span class="underlined">all</span> your villages.',
    "productionWithBoost" => "Hourly production including production bonus",
    "extendNow" => "Extend now",
    "activeNow" => "Activate now",
    "durationDays" => "Duration days",
    "Production of buildings and oases" => "Production of buildings and oases",
    "Population and construction orders" => "Population and construction orders",
    "Incomplete construction orders" => "Incomplete construction orders",
    "Consumption of own troops" => "Consumption of own troops",
    "in village" => "in village",
    "in oasis or reinforcements from own villages" => "in oasis or reinforcements from own villages",
    "imprisoned" => "imprisoned",
    "on the way" => "on the way",
    "Artefact bonus" => "Artefact bonus",
    "Consumption of foreign troops" => "Consumption of foreign troops",
    "Crop balance" => "Crop balance",
    "WW effect" => "WW effect",
];
//
$Definition['Alliance']['In order to quit alliance you need an embassy'] = 'In order to quit alliance you need an embassy.';
$Definition['Alliance']['in vacation'] = 'in vacation';
$Definition['Profile']['Player Profile'] = 'Player Profile';
$Definition['Profile']['Details'] = 'Details';
$Definition['Profile']['Rank'] = 'Rank';
$Definition['Profile']['Tribe'] = 'Tribe';
$Definition['Profile']['Alliance'] = 'Alliance';
$Definition['Profile']['Villages'] = 'Villages';
$Definition['Profile']['Status'] = 'Status';
$Definition['Profile']['Login to player account'] = 'Login to player account';
$Definition['Profile']['Population'] = 'Population';
$Definition['Profile']['Description'] = 'Description';
$Definition['Profile']['Name'] = 'Name';
$Definition['Profile']['Active'] = 'Active';
$Definition['Profile']['inActive'] = 'In active';
$Definition['Profile']['This player messages are banned'] = 'This player is banned for in game communications.';
$Definition['Profile']['Escape in villages'] = 'Escape in villages';
$Definition['Profile']['Oases'] = 'Oases';
$Definition['Profile']['Inhabitants'] = 'Inhabitants';
$Definition['Profile']['Coordinates'] = 'Coordinates';
$Definition['Profile']['Stop ignoring this player'] = 'Stop ignoring this player';
$Definition['Profile']['Accept messages from this player'] = 'Accept messages from this player';
$Definition['Profile']['Write message'] = 'Write message';
$Definition['Profile']['Write Message'] = 'Write Message';
$Definition['Profile']['Ignore Player'] = 'Ignore Player';
$Definition['Profile']['Edit list'] = 'Edit list';
$Definition['Profile']['Ignore list is full'] = 'Ignore list is full.';
$Definition['Profile']['Player will be ignored'] = 'Player will be ignored.';
$Definition['Profile']['WoW'] = 'WoW';
$Definition['Profile']['Support'] = 'Support';
$Definition['Profile']['Game rules'] = 'Game rules';
$Definition['Profile']['To ignore messages from a specific player, go to its profile and click on "Ignore"!'] = 'To ignore messages from a specific player, go to its profile and click on "Ignore"!';
$Definition['Profile']['MultihunterDesc'] = 'The Multihunters are responsible for compliance with the <a href="http://www.travian.com/spielregeln.php" target="_blank">rules of the game</a>. If you have questions about the rules or would like to report violations, you can message the Multihunters.';
$Definition['Profile']['Support and Multihunter'] = 'Support and Multihunter';
$Definition['Profile']['The support consists of experienced players who will gladly answer your questions'] = 'The support consists of experienced players who will gladly answer your questions.';
$Definition['Profile']['capital'] = 'Capital';
$Definition['Profile']['Artifact'] = 'Artifact';
$Definition['Profile']['Birthday'] = 'Birthday';
$Definition['Profile']['Gender'] = 'Gender';
$Definition['Profile']['n/a'] = 'N/A';
$Definition['Profile']['male'] = 'male';
$Definition['Profile']['female'] = 'female';
$Definition['Profile']['Location'] = 'Location';
$Definition['Profile']['Age'] = 'Age';
$Definition['Profile']['Overview'] = 'Overview';
$Definition['Profile']['Edit Profile'] = 'Edit Profile';
$Definition['Profile']['Medals'] = 'Medals';
$Definition['Profile']['DoveOfPeace'] = 'Dove Of Peace';
$Definition['Profile']['Category'] = 'Category';
$Definition['Profile']['Rank'] = 'Rank';
$Definition['Profile']['Week'] = 'Week';
$Definition['Profile']['BB-Code'] = 'BB-Code';
$Definition['Profile']['SpecialMedalsTitle'] = [
    1 => 'Winner rank 1',
    2 => 'Winner rank 2',
    3 => 'Winner rank 3',

    4 => 'Top Offensive rank 1',
    5 => 'Top Offensive rank 2',
    6 => 'Top Offensive rank 3',
    7 => 'Top Offensive rank 4',

    8 => 'Top Defensive rank 1',
    9 => 'Top Defensive rank 2',
    10 => 'Top Defensive rank 3',
    11 => 'Top Defensive rank 4',

    12 => 'Top Climbers Rank 1',
    13 => 'Top Climbers Rank 2',
    14 => 'Top Climbers Rank 3',
    15 => 'Top Climbers Rank 4',

    16 => 'Top offensive hammer',
    17 => 'Top defensive hammer',
    18 => 'Winner alliance',
];
$Definition['Profile']['Player special medals'] = 'Player special medals';
$Definition['Profile']['mySpeicalMTitle'] = [
    1 => 'Wonder Of The World',
    2 => 'Wonder Of The World',
    3 => 'Wonder Of The World',

    4 => "Offensive",
    5 => "Offensive",
    6 => "Offensive",
    7 => "Offensive",

    8 => 'Defensive',
    9 => 'Defensive',
    10 => 'Defensive',
    11 => 'Defensive',

    12 => 'Population',
    13 => 'Population',
    14 => 'Population',
    15 => 'Population',

    16 => 'Top offensive hammer',
    17 => 'Top defensive hammer',
    18 => 'Winner alliance',
];
$Definition['Profile']['mySpeicalM'] = [
// Ranke Wonder Of World
1 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Rank: 1 - WW level: %s',
2 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Rank: 2 - WW level: %s',
3 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Rank: 3 - WW level: %s',

// Ranke Offensive 1 ta 4 top 10
4 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Rank: 1 - P: %s',
5 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Rank: 2 - P: %s',
6 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Rank: 3 - P: %s',
7 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Rank: 4 - P: %s',
// Ranke Defensive 1 ta 4 top 10
8 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Rank: 1 - P: %s',
9 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Rank: 2 - P: %s',
10 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Rank: 3 - P: %s',
11 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Rank: 4 - P: %s',
// Ranke Pop Nafarate Avale 1 ta 4
12 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Rank: 1 - Points: %s',
13 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Rank: 2 - Points: %s',
14 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Rank: 3 - Points: %s',
15 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Rank: 4 - Points: %s',

16 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Points: %s',
17 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - Points: %s',
18 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - A: <span class="warning"><b>%s</b></span>',

];
$Definition['Profile']['SpecialMedalsLayout'] = 'Server %s  &nbsp; &nbsp; &nbsp; Account %s';
$Definition['Profile']['SpecialMedalsState'] = 'Special medals state';
$Definition['Profile']['SpecialShow'] = 'Show';
$Definition['Profile']['SpecialHide'] = 'Hide';
$Definition['Profile']['SpecialMedals'] = 'World Medals';
$Definition['Profile']['Language'] = 'Language';
$Definition['Profile']['Show country flag in your profile'] = 'Show country flag in your profile';
$Definition['Profile']['Show special medals?'] = 'Show special medals?';
$Definition['Profile']['YES'] = 'YES';
$Definition['Profile']['NO'] = 'NO';
$Definition['Profile']['Note'] = 'Note';
$Definition['Profile']['Edit'] = 'Edit';
$Definition['Profile']['NoteDescription'] = 'Edit your personal note about this player. Max. length: 500 characters';


$Definition['Quest'] = [];
$Definition['Quest']['welcome'] = 'Welcome';
$Definition['Quest']['helperAndTasks'] = 'Tasks and help';
$Definition['Quest']['taskList'] = 'Task List';
$Definition['Quest']['questButtonActivateTips'] = 'Show Hints';
$Definition['Quest']['questButtonDeactivateTips'] = 'Disable Hints';
$Definition['Quest']['questTipsToggleDescription'] = 'Hints on/off';
$Definition['Quest']['startTutorial'] = 'Continue';
$Definition['Quest']['getReward'] = 'Get Reward';
$Definition['Quest']['SkipTutorial'] = 'Avoid tasks';
$Definition['Quest']['skip'] = 'Avoid tasks';
$Definition['Quest']['questRewardTitle'] = 'Your reward:';
$Definition['Quest']['overview'] = 'Overview';
$Definition['Quest']['questTaskTitle'] = 'Quest';
$Definition['Quest']['endOfTutorial'] = 'end Of Tutorial';
$Definition['Quest']['continue'] = 'Continue';
$Definition['Quest']['battle'] = 'Battle ';
$Definition['Quest']['economy'] = 'Economy';
$Definition['Quest']['world'] = 'World ';
$Definition['Quest']['Tutorial_01']['questTitle'] = 'Welcome';
$Definition['Quest']['Tutorial_01']['questDescription'] = 'Hello %s, Welcome to Travian! <br>As long as you build a new village for yourself, I\'ll help you.In this tutorial, you should make your own village and get to know about the purpose of the game and its features.';
$Definition['Quest']['Tutorial_01']['continue'] = 'Continue';
$Definition['Quest']['Tutorial_01']['skip'] = 'Avoid tasks';
$Definition['Quest']['Tutorial_01']['todo'] = [0 => 'Tutorials explaining the main features of the game and may only take a few minutes. Begin now!',];
$Definition['Quest']['Tutorial_01']['steps'] = [0 => 'Start tutorial',];
$Definition['Quest']['Tutorial_02']['questTitle'] = 'Tasks and help';
$Definition['Quest']['Tutorial_02']['questDescription'] = 'You can move task page or close it. To open it again, simply click on my picture in the top left corner. Hints and Tasks will help you in the game.';
$Definition['Quest']['Tutorial_02']['questDescriptionReward'] = 'Now you can always get information on your current task. you can start The next task when you receive a taks reward. get your clay pit.!';
$Definition['Quest']['Tutorial_02']['rewardDescription'] = 'A Clay pit level 1 waiting for you!';
$Definition['Quest']['Tutorial_02']['todo'] = [
    0 => 'Close Tasks ',
    1 => 'click on Consultant to open Hints page ',
    2 => 'Turn off feature hints (disable) ',
];
$Definition['Quest']['Tutorial_02']['steps'] = [
    0 => 'Close Tasks',
    1 => 'Open Tasks',
    2 => 'Disable Hints',
];
$Definition['Quest']['Tutorial_03']['questTitle'] = 'Construct a Woodcutter ';
$Definition['Quest']['Tutorial_03']['questDescription'] = 'to raise your village you need a lot of resources,to build and train troops and even grow your empire! First Increase your resource Production - build a Woodcutter!';
$Definition['Quest']['Tutorial_03']['questDescriptionReward'] = 'It\'s a strong start moving in the stronger economy. I just completed Woodcutter construction,to be able to continue.';
$Definition['Quest']['Tutorial_03']['rewardDescription'] = 'finish Woodcutter level 1';
$Definition['Quest']['Tutorial_03']['todo'] = [
    0 => 'Open a forest area by clicking on it ',
    1 => 'Order construction Woodcutter level 1 ',
];
$Definition['Quest']['Tutorial_03']['steps'] = [
    0 => 'Open Woodcutter area',
    1 => 'construct Woodcutter',
];
$Definition['Quest']['Tutorial_04']['questTitle'] = 'Upgrade woodcutter ';
$Definition['Quest']['Tutorial_04']['questDescription'] = 'A larger building will require more resources with each upgrade, but in turn it will also produce more. Please upgrade the woodcutter from level 1 to level 2 now!';
$Definition['Quest']['Tutorial_04']['questDescriptionReward'] = 'The display of your storage and stock can be found above your village. Construction costs will be taken from the stocks. I\'ll instantly finish the construction for you again.';
$Definition['Quest']['Tutorial_04']['questTaskTitle'] = 'Task';
$Definition['Quest']['Tutorial_04']['rewardDescription'] = 'Finish construction of woodcutter level 2 immediately';
$Definition['Quest']['Tutorial_04']['todo'] = [
    0 => 'Open the level 1 woodcutter ',
    1 => 'Order the construction of a level 2 woodcutter ',
];
$Definition['Quest']['Tutorial_04']['steps'] = [
    0 => 'Open building ',
    1 => 'Woodcutter 2',
];
$Definition['Quest']['Tutorial_05']['questTitle'] = 'Construct Cropland ';
$Definition['Quest']['Tutorial_05']['questDescription'] = 'When you look at the share of its resources, Note the consumption of wheat in the left corner. This amount is needed to train troops and buildings. Please make a Cropland';
$Definition['Quest']['Tutorial_05']['questDescriptionReward'] = 'Now Your village\'s wheat is produced in sufficient quantities to build a new building. Populations are locally Nutrition forces stationed in the village of wheat are supported.';
$Definition['Quest']['Tutorial_05']['rewardDescription'] = 'Finish Cropland level 1 and Upgrade it to level 2';
$Definition['Quest']['Tutorial_05']['todo'] = [
    0 => 'Click on Cropland ',
    1 => 'Construct Cropland to level 1 ',
];
$Definition['Quest']['Tutorial_05']['steps'] = [
    0 => 'Open Crop land ',
    1 => 'Construct Crop land',
];
$Definition['Quest']['Tutorial_06']['questTitle'] = 'Hero Productions ';
$Definition['Quest']['Tutorial_06']['questDescription'] = 'If Your Hero is alive, it can produce resources for their village. by our Constructions we just have some clay. Change the hero production to clay';
$Definition['Quest']['Tutorial_06']['questDescriptionReward'] = 'Great! now your hero will help to product more resource. All produced Resources will add to main village. I will just increase your resource.';
$Definition['Quest']['Tutorial_06']['rewardDescription'] = '<div class="inlineIconList resourceWrapper"><div class="inlineIcon resources" title=""><i class="r2 questRewardTypeResource questRewardTypeClay"></i><span class="value questRewardValue">'.Quest::getInstance()->multiply(200).'</span></div></div>';
$Definition['Quest']['Tutorial_06']['todo'] = [
    0 => 'Click on the hero image and open overview. ',
    1 => 'Change your Hero Productions to Clay and save. ',
];
$Definition['Quest']['Tutorial_06']['steps'] = [
    0 => 'Click On hero Image',
    1 => 'Change production ',
];
$Definition['Quest']['Tutorial_07']['questTitle'] = 'Enter to your village center ';
$Definition['Quest']['Tutorial_07']['questDescription'] = 'Next, we will increase stock value by village overview at the top of the game\'s menu. To do this, we need to have buildings within the village. Go into the village center.';
$Definition['Quest']['Tutorial_07']['todo'] = [0 => 'Enter village center.',];
$Definition['Quest']['Tutorial_07']['steps'] = [0 => 'Enter village center',];
$Definition['Quest']['Tutorial_08']['questTitle'] = 'Counstrunct Warehouse ';
$Definition['Quest']['Tutorial_08']['questDescription'] = 'without warehouse, just some of resource can be stored in your village. Click on Building site to build warehouse! In the menu on the construction find warehouse and build it';
$Definition['Quest']['Tutorial_08']['questDescriptionReward'] = 'Construction work has started and soon you can save more resources and plunder. I will give you ' . Quest::calcEffect(86400, 'plus', true) . ' Travian Plus, which can give commands to a building and put it in the queue that first construction of the building is not finished.';
$Definition['Quest']['Tutorial_08']['rewardDescription'] = 'One day Travian Plus';
$Definition['Quest']['Tutorial_08']['todo'] = [
    0 => 'open construction and click infrastructure and the menu. ',
    1 => 'Give orders to build warehouse level 1. ',
];
$Definition['Quest']['Tutorial_08']['steps'] = [
    0 => 'Click on Building site',
    1 => 'Construct Warehouse',
];
$Definition['Quest']['Tutorial_09']['questTitle'] = 'Rally Point ';
$Definition['Quest']['Tutorial_09']['questDescription'] = 'in order to send your hero to adventures, you need a rally point - you can find it in village center! Construct it and Upgrade it to level 1';
$Definition['Quest']['Tutorial_09']['questDescriptionReward'] = 'It looks great! Now you can send Your Hero to the adventure. To perform this task, I\'ll give you some gold which you can spend it in a proper way.';
$Definition['Quest']['Tutorial_09']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeGold"> <span class="questRewardValue">2</span>';
$Definition['Quest']['Tutorial_09']['todo'] = [
    0 => 'Click on the building site of rally point. ',
    1 => 'Construct Rally Point level 1 ',
];
$Definition['Quest']['Tutorial_09']['steps'] = [
    0 => 'Click on RallyPoint place',
    1 => 'Construct RallyPoint',
];
$Definition['Quest']['Tutorial_10']['questTitle'] = 'Finish immediately ';
$Definition['Quest']['Tutorial_10']['questDescription'] = 'Below the village, you can find a list with all of your current construction orders. This time, you can speed up the construction yourself. Use the gold from the last task and finish the construction orders by clicking on "complete construction immediately".';
$Definition['Quest']['Tutorial_10']['questDescriptionReward'] = 'Now you can send your hero adventure. First,give order to build some resources which your village always growing up. Get this Gold and Use it wisely.';
$Definition['Quest']['Tutorial_10']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeGold"> <span class="questRewardValue">10</span>';
$Definition['Quest']['Tutorial_10']['todo'] = [0 => 'Complete construction orders immediately ',];
$Definition['Quest']['Tutorial_10']['steps'] = [0 => 'Complete construction ',];
$Definition['Quest']['Tutorial_11']['questTitle'] = 'Join to Adventure ';
$Definition['Quest']['Tutorial_11']['questDescription'] = 'Discover mysterious places in your surroundings to collect experience and valuable loot. Open the adventure list and send your hero on their first adventure.';
$Definition['Quest']['Tutorial_11']['questDescriptionReward'] = 'Great!, Your Hero is on the way of Adventure - how things he will found? Below hero image you can see the image of the hero moving. I will return Your Hero IMMEDIATELY!, to see what would happen.';
$Definition['Quest']['Tutorial_11']['rewardDescription'] = 'Your Hero will return immediately from Adventure';
$Definition['Quest']['Tutorial_11']['todo'] = [0 => 'Send your hero on their first adventure ',];
$Definition['Quest']['Tutorial_11']['steps'] = [0 => 'Hero adventure ',];
$Definition['Quest']['Tutorial_12']['questTitle'] = 'Reports';
$Definition['Quest']['Tutorial_12']['questDescription'] = 'Your hero is now on their way back from the first adventure. In the menu at the top, you can find the reports. Open the report list and read the adventure report.';
$Definition['Quest']['Tutorial_12']['questDescriptionReward'] = 'You can see what kind of an award Your Hero Found.Your Hero is also a superficial wound - to prevent from this event, I\'ll give you some ointment.';
$Definition['Quest']['Tutorial_12']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeItem item106"> <span class="questRewardValue">' . Quest::calcEffect(10, 'item', true) . '</span>';
$Definition['Quest']['Tutorial_12']['todo'] = [
    0 => 'Open the Report List',
    1 => 'View new report of adventure',
];
$Definition['Quest']['Tutorial_12']['steps'] = [
    0 => 'Report menu ',
    1 => 'Read report ',
];
$Definition['Quest']['Tutorial_13']['questTitle'] = 'Heal Hero';
$Definition['Quest']['Tutorial_13']['questDescription'] = 'Your hero was slightly injured. Open the hero overview by clicking on their image. Now click on the ointments in the inventory and use them with "ok". Only the required amount will be used.';
$Definition['Quest']['Tutorial_13']['questDescriptionReward'] = 'All the tools and weapons can be use in the same way. Depending on its type, you can view item informations by holding the cursor over it.';
$Definition['Quest']['Tutorial_13']['rewardDescription'] = 'Additionally, Your Hero received 20 experience points.';
$Definition['Quest']['Tutorial_13']['todo'] = [
    0 => 'Click on your hero\'s image to open the inventory ',
    1 => 'Click on the ointments in the inventory to use them',
];
$Definition['Quest']['Tutorial_13']['steps'] = [
    0 => 'Hero inventory ',
    1 => 'Heal Hero',
];
$Definition['Quest']['Tutorial_14']['questTitle'] = 'Interface help ';
$Definition['Quest']['Tutorial_14']['questDescription'] = 'Near my image, you can find some additional help regarding the game. There, you can find explanations about the layout and different sections of the user interface. Just give it a try!';
$Definition['Quest']['Tutorial_14']['questDescriptionReward'] = 'If you have specific questions, First search them in "Travian Answers" and get help. To do this, the "i" in the header of this window or in a corner of your screen.';
$Definition['Quest']['Tutorial_14']['rewardDescription'] = buildResourcesReward([270, 300, 270, 220]);
$Definition['Quest']['Tutorial_14']['todo'] = [0 => 'Open the user interface help and have a look around the UI ',];
$Definition['Quest']['Tutorial_14']['steps'] = [0 => 'User Interface Help ',];
$Definition['Quest']['Tutorial_15']['questTitle'] = 'End of training ';
$Definition['Quest']['Tutorial_15']['questDescription'] = $Definition['Quest']['Tutorial_15a']['questDescriptionReward'] = 'Now you know the basics of the game. Important information such as the time-critical data to support newcomers and the game will be show in the info box on the left. Enjoy Travian!';
$Definition['Quest']['Tutorial_15']['rewardDescription'] = 'Finish training.';
$Definition['Quest']['Tutorial_15']['todo'] = [0 => 'End of tutorial',];
$Definition['Quest']['Tutorial_15']['steps'] = [0 => 'End of tutorial',];
$Definition['Quest']['Tutorial_15a']['questTitle'] = 'Skip tutorial';
$Definition['Quest']['Tutorial_15a']['questDescription'] = 'To get you started, I will give you the buildings and advantages from the tutorial. Further tasks and rewards are waiting for you from now until you found your second village. Enjoy playing Travian!';
$Definition['Quest']['Tutorial_15a']['rewardDescription'] = 'Rally point, clay pit, woodcutter 2, cropland 2, 10 gold, ' . Quest::calcEffect(86400, 'plus', true) . ' PLUS';
$Definition['Quest']['Tutorial_15a']['steps'] = [0 => 'Skip tutorial',];
$Definition['Quest']['battle_01_name'] = 'Next Adventure ';
$Definition['Quest']['battle_02_name'] = 'Build Cranny ';
$Definition['Quest']['battle_03_name'] = 'Build barracks ';
$Definition['Quest']['battle_04_name'] = 'Hero level ';
$Definition['Quest']['battle_05_name'] = 'Train troops';
$Definition['Quest']['battle_06_name'] = 'Earth Wall';
$Definition['Quest']['battle_07_name'] = 'Attack oasis';
$Definition['Quest']['battle_08_name'] = '10 adventures';
$Definition['Quest']['battle_09_name'] = 'Auctions';
$Definition['Quest']['battle_10_name'] = 'Upgrade barracks';
$Definition['Quest']['battle_11_name'] = 'Construct an academy';
$Definition['Quest']['battle_12_name'] = 'Research unit';
$Definition['Quest']['battle_13_name'] = 'Construct a smithy';
$Definition['Quest']['battle_14_name'] = 'Improve units';
$Definition['Quest']['battle_15_name'] = 'Complete 5 adventures';
$Definition['Quest']['Battle_01']['questTitle'] = 'Next adventure';
$Definition['Quest']['Battle_01']['questDescription'] = 'During the tutorial, you already collected some experience from an adventure. Start the next adventure as soon as your hero has returned to your village. Loot and experience will allow you to grow more quickly.';
$Definition['Quest']['Battle_01']['questDescriptionReward'] = 'Nice, your hero is already on their way. Hint: The more fighting strength your hero has, the less damage they will take from adventures.';
$Definition['Quest']['Battle_01']['rewardDescription'] = '30 hero experience';
$Definition['Quest']['Battle_01']['todo'] = [0 => 'Move on to the second adventure ',];
$Definition['Quest']['Battle_02']['questTitle'] = 'Construct a cranny ';
$Definition['Quest']['Battle_02']['questDescription'] = 'Many players live off of robbing the resources from other players. At game start, you have beginner\'s protection and you are safe. Construct a cranny to save at least a part of your resources from being plundered.';
$Definition['Quest']['Battle_02']['questDescriptionReward'] = 'Great, now plunderers will not find it as easy to steal from you anymore. Check the info box to see the time of beginner\'s protection you have left.';
$Definition['Quest']['Battle_02']['rewardDescription'] = buildResourcesReward([130, 150, 120, 100]);
$Definition['Quest']['Battle_02']['todo'] = [0 => 'Build a cranny in your village ',];
$Definition['Quest']['Battle_03']['questTitle'] = 'Build barracks ';
$Definition['Quest']['Battle_03']['questDescription'] = 'The barracks is the first building that allows you to train troops. Even as a peace-loving player, you will need troops in order to protect yourself and your allies from enemies.';
$Definition['Quest']['Battle_03']['questDescriptionReward'] = 'Your barracks has been built! A good step towards world domination!';
$Definition['Quest']['Battle_03']['rewardDescription'] = buildResourcesReward([110, 140, 160, 30]);
$Definition['Quest']['Battle_03']['todo'] = [0 => ' Construct barracks ',];
$Definition['Quest']['Battle_04']['questTitle'] = 'Hero level ';
$Definition['Quest']['Battle_04']['questDescription'] = 'Whenever your hero reaches a new level, they will get stronger. Open the hero\'s attributes and distribute the attribute points you have been awarded.';
$Definition['Quest']['Battle_04']['questDescriptionReward'] = 'You can change the distribution of points for each attribute at any time. All you need for this is a book of wisdom, which can be found in adventures.';
$Definition['Quest']['Battle_04']['rewardDescription'] = buildResourcesReward([190, 250, 150, 110]);
$Definition['Quest']['Battle_04']['todo'] = [0 => 'Distribute your hero\'s attribute points after levelling up.',];
$Definition['Quest']['Battle_05']['questTitle'] = 'Train troops';
$Definition['Quest']['Battle_05']['questDescription'] = 'Now it is time to train your first troops. In the barracks, you can already train one type of infantry unit.';
$Definition['Quest']['Battle_05']['questDescriptionReward'] = 'The cornerstone for a glorious army has been laid! Always remember that you can still be attacked, even when you are not online.';
$Definition['Quest']['Battle_05']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeItem item114"> <span class="questRewardValue">1</span>';
$Definition['Quest']['Battle_05']['todo'] = [0 => 'Train two troops in the barracks ',];
$Definition['Quest']['Battle_06']['questTitle'] = 'Earth Wall ';
$Definition['Quest']['Battle_06']['questDescription'] = 'Now you should also build some defences. A fortification will increase your base defence and also increases the fighting strength of defending troops.';
$Definition['Quest']['Battle_06']['questDescriptionReward'] = 'Wonderful, the defenders of your village are now better protected.';
$Definition['Quest']['Battle_06']['rewardDescription'] = buildResourcesReward([120, 120, 90, 50]);
$Definition['Quest']['Battle_06']['todo'] = [0 => 'Build a fortification around your village. ',];
$Definition['Quest']['Battle_07']['questTitle'] = 'Attack oasis ';
$Definition['Quest']['Battle_07']['questDescription'] = 'Search the map for a free oasis nearby and plunder it. In case there are animals defending it, send your hero equipped with cages in order to capture them.';
$Definition['Quest']['Battle_07']['questDescriptionReward'] = 'Congratulations, your first attack is on its way! You can still cancel it for a short period of time from within your rally point.';
$Definition['Quest']['Battle_07']['rewardDescription'] = Quest::calcEffect(2, 'troops', true) . ' base unit troops';
$Definition['Quest']['Battle_07']['todo'] = [0 => 'Open a free oasis on the map and attack it. ',];
$Definition['Quest']['Battle_08']['questTitle'] = '10 adventures ';
$Definition['Quest']['Battle_08']['questDescription'] = 'Continue to send your hero on adventures. After having finished 10 of them, you can participate in auctions and trade items with other players.';
$Definition['Quest']['Battle_08']['questDescriptionReward'] = 'Congratulations, you can now use the auction house. Take this silver, so you have some money for trading right away.';
$Definition['Quest']['Battle_08']['rewardDescription'] = '500 silver';
$Definition['Quest']['Battle_08']['todo'] = [0 => 'Finish 10 adventures',];
$Definition['Quest']['Battle_09']['questTitle'] = 'Auctions';
$Definition['Quest']['Battle_09']['questDescription'] = 'Go to the auction house and see which items are currently on offer. Maybe you want to turn some of your loot from adventures into silver as well?';
$Definition['Quest']['Battle_09']['questDescriptionReward'] = 'Great, now you know how to trade equipment and consumable items with other players.';
$Definition['Quest']['Battle_09']['rewardDescription'] = buildResourcesReward([280, 120, 220, 110]);
$Definition['Quest']['Battle_09']['todo'] = [0 => 'Create or place a bid in an auction. .',];
$Definition['Quest']['Battle_10']['questTitle'] = 'Upgrade barracks ';
$Definition['Quest']['Battle_10']['questDescription'] = 'Upgrade your barracks now. With this, you fulfill the requirements to unlock further buildings.';
$Definition['Quest']['Battle_10']['questDescriptionReward'] = 'Nice. Your troops are now trained faster and you can construct an academy.';
$Definition['Quest']['Battle_10']['rewardDescription'] = buildResourcesReward([440, 290, 430, 240]);
$Definition['Quest']['Battle_10']['todo'] = [0 => 'Upgrade your barracks to level 3. ',];
$Definition['Quest']['Battle_11']['questTitle'] = 'Construct an academy';
$Definition['Quest']['Battle_11']['questDescription'] = 'New and stronger units for your village can be researched in the academy. Some units are very expensive and have high requirements before they can be researched.';
$Definition['Quest']['Battle_11']['questDescriptionReward'] = 'Well done. Soon you will find out more about the soldiers of your tribe.';
$Definition['Quest']['Battle_11']['rewardDescription'] = buildResourcesReward([210, 170, 245, 115]);
$Definition['Quest']['Battle_11']['todo'] = [0 => 'Construct an academy now.',];
$Definition['Quest']['Battle_12']['questTitle'] = 'Research unit';
$Definition['Quest']['Battle_12']['questDescription'] = 'Check your research options now. There are infantry and cavalry units, as well as siege weapons. Units are mainly specialised in either attack or defence.';
$Definition['Quest']['Battle_12']['questDescriptionReward'] = 'Research alone is of course not enough; your units will also need to be trained.';
$Definition['Quest']['Battle_12']['rewardDescription'] = buildResourcesReward([450, 435, 515, 550]);
$Definition['Quest']['Battle_12']['todo'] = [0 => 'Research an additional troop type.',];
$Definition['Quest']['Battle_13']['questTitle'] = 'Construct a smithy ';
$Definition['Quest']['Battle_13']['questDescription'] = 'A smithy allows you to better arm and equip your soldiers. Furthermore, a smithy is required in order to build additional troop buildings.';
$Definition['Quest']['Battle_13']['questDescriptionReward'] = 'Perfect. Now you can better equip your soldiers.';
$Definition['Quest']['Battle_13']['rewardDescription'] = buildResourcesReward([500, 400, 700, 400]);
$Definition['Quest']['Battle_13']['todo'] = [0 => 'Construct a smithy.',];
$Definition['Quest']['Battle_14']['questTitle'] = 'Improve units';
$Definition['Quest']['Battle_14']['questDescription'] = 'Improving your soldiers\' equipment isn\'t cheap. The more soldiers you have, the more rewarding an improvement will be. This time, you will gain more than a refund of the costs.';
$Definition['Quest']['Battle_14']['questDescriptionReward'] = 'Research a unit improvement in the smithy.';
$Definition['Quest']['Battle_14']['rewardDescription'] = '

								<img src="img/x.gif" class="questRewardTypeItem item112"> <span class="questRewardValue">' . Quest::calcEffect(10, 'item', true) . '</span>

							';
$Definition['Quest']['Battle_14']['todo'] = [0 => 'Finish upgrading a troop type.',];
$Definition['Quest']['Battle_15']['questTitle'] = 'Complete 5 Adventures';
$Definition['Quest']['Battle_15']['questDescription'] = 'More Adventures mean more loot and experience. Keep your Hero active, but consider giving him some rest if his health is low.';
$Definition['Quest']['Battle_15']['questDescriptionReward'] = 'Ointments can be used to heal your hero. If you equip ointments they will be used as soon as the hero takes damage.';
$Definition['Quest']['Battle_15']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeItem item106"> <span class="questRewardValue">' . Quest::calcEffect(15, 'item', true) . '</span>';
$Definition['Quest']['Battle_15']['todo'] = [0 => 'Complete 5 adventures',];
$Definition['Quest']['economy_01_name'] = 'Iron mine';
$Definition['Quest']['economy_02_name'] = 'More resources ';
$Definition['Quest']['economy_03_name'] = 'Granary';
$Definition['Quest']['economy_04_name'] = 'All to one ';
$Definition['Quest']['economy_05_name'] = 'To 2!';
$Definition['Quest']['economy_06_name'] = 'market place';
$Definition['Quest']['economy_07_name'] = 'Trade';
$Definition['Quest']['economy_08_name'] = 'All to 2';
$Definition['Quest']['economy_09_name'] = 'Warehouse level 3';
$Definition['Quest']['economy_10_name'] = 'Granary level 3';
$Definition['Quest']['economy_11_name'] = 'Grain Mill';
$Definition['Quest']['economy_12_name'] = 'All to 5';
$Definition['Quest']['Economy_01']['questTitle'] = 'Iron mine';
$Definition['Quest']['Economy_01']['questDescription'] = 'Order the construction of an iron mine! Your primary aim is still a high production of resources so that you can grow quickly.';
$Definition['Quest']['Economy_01']['questDescriptionReward'] = 'Higher iron production for your village. A production bonus will help you increase the production of any particular resource even further.';
$Definition['Quest']['Economy_01']['rewardDescription'] = Quest::calcEffect(86400, 'productionBoost', true) . ' +25% bonus on the production of all resources';
$Definition['Quest']['Economy_01']['todo'] = [0 => 'Start the construction of an iron mine.',];
$Definition['Quest']['Economy_02']['questTitle'] = 'More resources';
$Definition['Quest']['Economy_02']['questDescription'] = 'Extend one lumber, clay, iron and crop field each to level 1. To complete this task you need to have at least 2 fields of each resource type above level 0. As long as Travian PLUS is still active, you can always order one further construction at the same time.';
$Definition['Quest']['Economy_02']['questDescriptionReward'] = 'Congratulations! Your village grows and thrives...';
$Definition['Quest']['Economy_02']['rewardDescription'] = 'One day +25% bonus on the production of all resources';
$Definition['Quest']['Economy_02']['todo'] = [0 => 'Extend one more of each resource tile to level 1.',];
$Definition['Quest']['Economy_03']['questTitle'] = 'Granary';
$Definition['Quest']['Economy_03']['questDescription'] = 'In order to store more crop, you need a granary. Your current storage limit can be found when looking at the resources bar.';
$Definition['Quest']['Economy_03']['questDescriptionReward'] = 'Nicely done! The granary now allows you to store more crop.';
$Definition['Quest']['Economy_03']['rewardDescription'] = buildResourcesReward([250, 290, 100, 130]);
$Definition['Quest']['Economy_03']['todo'] = [0 => 'Construct a granary.',];
$Definition['Quest']['Economy_04']['questTitle'] = 'All to one ';
$Definition['Quest']['Economy_04']['questDescription'] = 'In the beginning, it\'s best to focus on resources. Please upgrade all your resource fields to level 1.';
$Definition['Quest']['Economy_04']['questDescriptionReward'] = 'Your resource production is developing nicely. Soon we can start the construction of more buildings in your village.';
$Definition['Quest']['Economy_04']['rewardDescription'] = buildResourcesReward([400, 460, 330, 270]);
$Definition['Quest']['Economy_04']['todo'] = [0 => 'Upgrade all resource fields to level 1.',];
$Definition['Quest']['Economy_05']['questTitle'] = 'To 2! ';
$Definition['Quest']['Economy_05']['questDescription'] = 'Well done! If you require more information regarding your production, click on your stocks.';
$Definition['Quest']['Economy_05']['questDescriptionReward'] = 'Well done! If you require more information regarding your production, click on your stocks.';
$Definition['Quest']['Economy_05']['rewardDescription'] = buildResourcesReward([240, 255, 190, 160]);
$Definition['Quest']['Economy_05']['todo'] = [0 => 'Upgrade 1 field of each resource to level 2.',];
$Definition['Quest']['Economy_06']['questTitle'] = 'Marketplace ';
$Definition['Quest']['Economy_06']['questDescription'] = 'In case you have a lack of one resource, you can trade it for other resources with other players at the marketplace. In order to construct a small marketplace, you need a larger main building.';
$Definition['Quest']['Economy_06']['questDescriptionReward'] = 'Your marketplace is ready and you can now start trading with other players. Don\'t fall for the really bad offers though!';
$Definition['Quest']['Economy_06']['rewardDescription'] = '
								<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . Quest::getInstance()->multiply(600) . '</span>
							';
$Definition['Quest']['Economy_06']['todo'] = [0 => 'Construct marketplace ',];
$Definition['Quest']['Economy_07']['questTitle'] = 'Trade ';
$Definition['Quest']['Economy_07']['questDescription'] = 'Existing offers on the marketplace can be seen when clicking on \"buy\". Check the exchange rate and the distance. Should you not be able to find a suitable offer, click on \"offer\" to create an offer yourself.';
$Definition['Quest']['Economy_07']['questDescriptionReward'] = 'Awesome, you have initiated your first trade.';
$Definition['Quest']['Economy_07']['rewardDescription'] = buildResourcesReward([100, 99, 99, 99]);
$Definition['Quest']['Economy_07']['todo'] = [0 => 'Create a marketplace offer or accept one',];
$Definition['Quest']['Economy_08']['questTitle'] = 'All to 2';
$Definition['Quest']['Economy_08']['questDescription'] = 'Before you start constructing more expensive buildings, we should further increase your resource production. Upgrade all your resource fields to level 2.';
$Definition['Quest']['Economy_08']['questDescriptionReward'] = 'Congratulations! Your resource production is developing nicely.';
$Definition['Quest']['Economy_08']['rewardDescription'] = buildResourcesReward([400, 400, 400, 200]);
$Definition['Quest']['Economy_08']['todo'] = [0 => 'Extend all resource fields to level 2',];
$Definition['Quest']['Economy_09']['questTitle'] = 'Warehouse Level 3 ';
$Definition['Quest']['Economy_09']['questDescription'] = 'It\'s time to adjust your warehouse to the increased production. Unplanned loot from your hero may also make your storage overflow.';
$Definition['Quest']['Economy_09']['questDescriptionReward'] = 'Really good, no valuable resources will be wasted now.';
$Definition['Quest']['Economy_09']['rewardDescription'] = buildResourcesReward([620, 750, 560, 230]);
$Definition['Quest']['Economy_09']['todo'] = [0 => 'Upgrade your warehouse to level 3',];
$Definition['Quest']['Economy_10']['questTitle'] = 'Granary level 3';
$Definition['Quest']['Economy_10']['questDescription'] = 'The higher your production, the easier your storage gets filled up. The granary should also be upgraded.';
$Definition['Quest']['Economy_10']['questDescriptionReward'] = 'Now there is room again in the granary, so that production can continue even in your absence.';
$Definition['Quest']['Economy_10']['rewardDescription'] = buildResourcesReward([880, 1020, 590, 320]);
$Definition['Quest']['Economy_10']['todo'] = [0 => 'Upgrade your granary to level 3.',];
$Definition['Quest']['Economy_11']['questTitle'] = 'Grain Mill';
$Definition['Quest']['Economy_11']['questDescription'] = 'A grain mill increases the production of all your croplands. In order to be worth its price, you need to have a high enough base production.';
$Definition['Quest']['Economy_11']['questDescriptionReward'] = 'Now you have a lot of free crop available for further constructions. There are also buildings that increase the production of the other resources.';
$Definition['Quest']['Economy_11']['rewardDescription'] = 'Grain Mill Level 2';
$Definition['Quest']['Economy_11']['todo'] = [0 => 'Upgrade one cropland to level 5',];
$Definition['Quest']['Economy_12']['questTitle'] = 'All to 5';
$Definition['Quest']['Economy_12']['questDescription'] = 'You will need a much higher production in order to spare you a long waiting time until you are able to afford the buildings and settlers needed for a second village. Upgrade all resource fields to level 5.';
$Definition['Quest']['Economy_12']['questDescriptionReward'] = 'Well done, your production is faster now and you can do more works.';
$Definition['Quest']['Economy_12']['rewardDescription'] = Quest::calcEffect(86400, 'productionBoost', true) . ' +25% bonus on the production of all resources';
$Definition['Quest']['Economy_12']['todo'] = [0 => 'Upgrade all resource fields to level 5.',];
$Definition['Quest']['World_01']['questTitle'] = 'View statistics';
$Definition['Quest']['World_01']['questDescription'] = 'In the world of Travian, you compete against thousands of other players. Check the statistics to find out more about your own position in the game';
$Definition['Quest']['World_01']['questDescriptionReward'] = 'Apart from the rank, there is other useful information. The tab Top10 will show you the strongest attackers and the most successful robbers.';
$Definition['Quest']['World_01']['rewardDescription'] = buildResourcesReward([90, 120, 60, 30]);
$Definition['Quest']['World_01']['todo'] = [0 => 'Open the statistics and compare yourself with other players. ',];
$Definition['Quest']['World_02']['questTitle'] = 'Change village name ';
$Definition['Quest']['World_02']['questDescription'] = 'A village name chosen by you is a sign to other players, showing them that your empire is being led actively.';
$Definition['Quest']['World_02']['questDescriptionReward'] = 'Nice, now you have completed the first step to leave your mark in the world of Travian.';
$Definition['Quest']['World_02']['rewardDescription'] = Quest::calcEffect(100, 'cp', true) . ' culture points';
$Definition['Quest']['World_02']['todo'] = [0 => 'Change the village name on the village sign.',];
$Definition['Quest']['World_03']['questTitle'] = 'Main building level 3 ';
$Definition['Quest']['World_03']['questDescription'] = 'A bigger main building unlocks new buildings and your workers\' speed will increase. Being able to build more quickly will however only pay out if you produce enough resources.';
$Definition['Quest']['World_03']['questDescriptionReward'] = 'Great, the bigger main building now allows you to construct some additional buildings that you\'ve just unlocked.';
$Definition['Quest']['World_03']['rewardDescription'] = buildResourcesReward([170, 100, 130, 70]);
$Definition['Quest']['World_03']['todo'] = [0 => 'Upgrade your main building to level 3.',];
$Definition['Quest']['World_04']['questTitle'] = 'Construct an embassy ';
$Definition['Quest']['World_04']['questDescription'] = 'The world of Travian is a dangerous place and you need to be able to defend yourself. The best additional defence is offered by strong allies. Construct an embassy in order to join an alliance.';
$Definition['Quest']['World_04']['questDescriptionReward'] = 'Perfect, now you can accept alliance invitations. Invitations can be found inside the embassy.';
$Definition['Quest']['World_04']['rewardDescription'] = buildResourcesReward([215, 145, 195, 50]);
$Definition['Quest']['World_04']['todo'] = [0 => 'Construct an embassy.',];
$Definition['Quest']['World_05']['questTitle'] = 'Open map ';
$Definition['Quest']['World_05']['questDescription'] = 'The map shows you the world of Travian. Check out your neighbours to find allies and identify threats.';
$Definition['Quest']['World_05']['questDescriptionReward'] = 'Are there strong players or alliances near you? The map also helps you find oases and spots where you can settle new villages.';
$Definition['Quest']['World_05']['rewardDescription'] = buildResourcesReward([90, 160, 90, 95]);
$Definition['Quest']['World_05']['todo'] = [0 => 'Open the map in the menu.',];
$Definition['Quest']['World_06']['questTitle'] = 'Read message';
$Definition['Quest']['World_06']['questDescription'] = 'You have just received a message with some helpful hints. Unread messages can be identified by the number above the button. Have a look now.';
$Definition['Quest']['World_06']['questDescriptionReward'] = 'Use messages to communicate with other players. It does always pay out to be calm and polite, even if you are at battle.';
$Definition['Quest']['World_06']['rewardDescription'] = buildResourcesReward([280, 315, 200, 145]);
$Definition['Quest']['World_06']['todo'] = [0 => 'Open the messages overview and read the taskmaster\'s message! ',];
$Definition['Quest']['World_07']['questTitle'] = 'Bonus gold ';
$Definition['Quest']['World_07']['questDescription'] = 'During the tutorial, you\'ve already used gold to speed up your construction orders. In the gold shop, you can find out what else you can use your gold for.';
$Definition['Quest']['World_07']['questDescriptionReward'] = 'Here is some free gold again, so that you can make use of some of the gold advantages.';
$Definition['Quest']['World_07']['rewardDescription'] = '

								<img src="img/x.gif" class="questRewardTypeGold"> <span class="questRewardValue">20</span>

							';
$Definition['Quest']['World_07']['todo'] = [0 => 'Take a look at the advantages you can buy with gold.',];
$Definition['Quest']['World_08']['questTitle'] = 'Alliance ';
$Definition['Quest']['World_08']['questDescription'] = 'Search for allies and join an alliance. If you don\'t have any contacts yet, check the alliances of players near you or search for an alliance on the forum.';
$Definition['Quest']['World_08']['questDescriptionReward'] = 'We\'re off to a great start. The stronger and more active each single player is, the stronger you will be as a team. Have you found out how to report attacks to each other and how to ask for assistance?';
$Definition['Quest']['World_08']['rewardDescription'] = buildResourcesReward([295, 210, 235, 185]);
$Definition['Quest']['World_08']['todo'] = [0 => 'Join an alliance.',];
$Definition['Quest']['World_09']['questTitle'] = 'Main building level 5';
$Definition['Quest']['World_09']['questDescription'] = 'It is time to upgrade the main building, so that you can construct new buildings. Please remember to also take care of your resource production at the same time.';
$Definition['Quest']['World_09']['questDescriptionReward'] = 'Great! isn\'t it ? Now Your Building will Build Faster. Get Your Reward And prepare your self for next Quest.';
$Definition['Quest']['World_09']['rewardDescription'] = buildResourcesReward([570, 470, 560, 265]);
$Definition['Quest']['World_09']['todo'] = [0 => ' Upgrade your main building to level 5.',];
$Definition['Quest']['World_10']['questTitle'] = 'Seat of government ';
$Definition['Quest']['World_10']['questDescription'] = 'Construct a seat of government now in order to found a new village soon. In case you are not sure if you want this village to remain your capital village, please select the residence.';
$Definition['Quest']['World_10']['questDescriptionReward'] = 'This building is necessary in order to settle a new village or conquer one. Its level limits the amount of possible expansions.';
$Definition['Quest']['World_10']['rewardDescription'] = buildResourcesReward([525, 420, 620, 335]);
$Definition['Quest']['World_10']['todo'] = [0 => 'Seat of government',];
$Definition['Quest']['World_11']['questTitle'] = 'Culture points';
$Definition['Quest']['World_11']['questDescription'] = 'In order to reign over more villages in your empire, you need culture points. The overview in the residence or palace tells you how far away you are and how long it is going to take.';
$Definition['Quest']['World_11']['questDescriptionReward'] = 'In the village list you can also see the current status of possible new villages and the amount of missing culture points. Visit \"Answers\" to find out how to quickly increase your culture points.';
$Definition['Quest']['World_11']['rewardDescription'] = buildResourcesReward([650, 800, 740, 530]);
$Definition['Quest']['World_11']['todo'] = [0 => 'Open the culture points tab in your residence or palace.',];
$Definition['Quest']['World_12']['questTitle'] = 'Warehouse level 7 ';
$Definition['Quest']['World_12']['questDescription'] = 'Upgrade your warehouse to prepare yourself for settling a new village. Your current storage capacity won\'t be enough soon to afford the required buildings and settlers.';
$Definition['Quest']['World_12']['questDescriptionReward'] = 'Great, your storage capacity should be enough for some time now. Remember to defend or hide your valuable resources.';
$Definition['Quest']['World_12']['rewardDescription'] = buildResourcesReward([2650, 2150, 1810, 1320]);
$Definition['Quest']['World_12']['todo'] = [0 => 'Upgrade your warehouse to level 7.',];
$Definition['Quest']['World_13']['questTitle'] = 'Surroundings report';
$Definition['Quest']['World_13']['questDescription'] = 'The surroundings reports help you stay informed about events and changes within your neighbourhood.';
$Definition['Quest']['World_13']['questDescriptionReward'] = 'From name changes to performed raids and conquerings, much is possible. I hope you enjoyed reading the reports.';
$Definition['Quest']['World_13']['rewardDescription'] = buildResourcesReward([800, 700, 750, 600]);
$Definition['Quest']['World_13']['todo'] = [0 => 'Open the reports and read the surroundings reports.',];
$Definition['Quest']['World_14']['questTitle'] = 'Residence or palace level 10 ';
$Definition['Quest']['World_14']['questDescription'] = 'Settlers can be trained in a palace or a residence. The tab "Train" shows you the required building level.';
$Definition['Quest']['World_14']['questDescriptionReward'] = 'From each village you can only control 2 to 3 new villages. All that\'s missing for a new village now are 3 settlers and a lot of culture points.';
$Definition['Quest']['World_14']['rewardDescription'] = Quest::calcEffect(500, 'cp', true) . ' culture points. ';
$Definition['Quest']['World_14']['todo'] = [0 => 'Upgrade your residence or palace to level 10. ',];
$Definition['Quest']['World_15']['questTitle'] = 'Train three settlers';
$Definition['Quest']['World_15']['questDescription'] = 'Settlers always travel in a small group when founding a new village.';
$Definition['Quest']['World_15']['questDescriptionReward'] = 'Protect your settlers well from attacks until they are ready to go.';
$Definition['Quest']['World_15']['rewardDescription'] = buildResourcesReward([1050, 800, 900, 750]);
$Definition['Quest']['World_15']['todo'] = [0 => 'Train 3 settlers in residence/palace.',];
$Definition['Quest']['World_16']['questTitle'] = 'Creating new village';
$Definition['Quest']['World_16']['questDescription'] = 'Search the map for a good spot to settle. Would you like it to be near your village, produce more of one particular resource or be near many oases? Found a second village using your settlers.';
$Definition['Quest']['World_16']['questDescriptionReward'] = "Great, you're one of the most powerful empires in the world of Travian. Continue playing and traing lots of troops to defend the enemis.";
$Definition['Quest']['World_16']['rewardDescription'] = Quest::calcEffect(172800, 'plus', true) . ' of Travian plus.';
$Definition['Quest']['World_16']['todo'] = [0 => 'Create new village.',];
$Definition['Quest']['world_01_name'] = 'View statistics';
$Definition['Quest']['world_02_name'] = 'Change village name';
$Definition['Quest']['world_03_name'] = 'Main building level 3 ';
$Definition['Quest']['world_04_name'] = 'Construct an embassy ';
$Definition['Quest']['world_05_name'] = 'Open Map';
$Definition['Quest']['world_06_name'] = 'Read message';
$Definition['Quest']['world_07_name'] = 'Bonus gold';
$Definition['Quest']['world_08_name'] = 'Alliance';
$Definition['Quest']['world_09_name'] = 'Main building level 5';
$Definition['Quest']['world_10_name'] = 'Seat of government';
$Definition['Quest']['world_11_name'] = 'Culture points';
$Definition['Quest']['world_12_name'] = 'Warehouse level 7';
$Definition['Quest']['world_13_name'] = 'Surroundings report';
$Definition['Quest']['world_14_name'] = 'Residence or palace level 10 ';
$Definition['Quest']['world_15_name'] = '3 Settlers';
$Definition['Quest']['world_16_name'] = 'New village';
//
$Definition['RallyPoint']['greyAreaNewVillageCaution'] = 'Caution: If you settle a village at this coordinates, Natars will try to attack and keep you away from this area.<br />Villages in this area will not produce culture points.';
$Definition['RallyPoint']['Changed successfully: %s will be the new home village for hero'] = 'Changed successfully: %s will be the new home village for hero.';
$Definition['RallyPoint']['nowSettlersWillGoNeedsXResources'] = 'Now settlers will go to create a new village.<br />Creating new village needs %s of each resources (lumber, clay, iron, crop).';
$Definition['RallyPoint']['Settlers']['notEnoughResources'] = 'Not enough resources.';
$Definition['RallyPoint']['reinforcement'] = 'Reinforcement';
$Definition['RallyPoint']['normal'] = 'Attack';
$Definition['RallyPoint']['raid'] = 'Raid';
$Definition['RallyPoint']['attack'] = 'Attack';
$Definition['RallyPoint']['Village'] = 'Village';
$Definition['RallyPoint']['changeHeroHomeVillage'] = 'Change hero home';
$Definition['RallyPoint']['or'] = 'or';
$Definition['RallyPoint']['number'] = 'number';
$Definition['RallyPoint']['withdraw'] = 'Withdraw';
$Definition['RallyPoint']['sendBack'] = 'Send Back';
$Definition['RallyPoint']['reviving'] = 'Reviving';
$Definition['RallyPoint']['createNewVillage'] = 'Create new village';
$Definition['RallyPoint']['loyaltyReducedBy'] = 'Loyalty reduced by ';
$Definition['RallyPoint']['spy'] = 'Spy';
$Definition['RallyPoint']['supply'] = 'Reinforcement';
$Definition['RallyPoint']['Errors']['activeVillageChanged'] = 'Active village was changed.';
$Definition['RallyPoint']['Errors']['EnterCoordinateOrDname'] = 'Insert name or coordinates.';
$Definition['RallyPoint']['Errors']['noVillageWithThisName'] = 'Village does not exist.';
$Definition['RallyPoint']['Errors']['noVillageInCoordinate'] = 'Coordinates does not exist.';
$Definition['RallyPoint']['Errors']['NatarCapitalError'] = 'You can\'t send orcement Capital Of Natar!';
$Definition['RallyPoint']['Errors']['noTroopsSelected'] = 'You need to mark min. one troop.';
$Definition['RallyPoint']['Errors']['playerHasBeginnerProtection'] = 'This player is under protection.';
$Definition['RallyPoint']['Errors']['cantAttackUrSelf'] = 'Your troops are already in your village';
$Definition['RallyPoint']['Errors']['cantAttackDuringProtection'] = 'You can\'t attack while you are in protection.';
$Definition['RallyPoint']['Errors']['reallyAttackOwn?'] = 'Are you sure you want to attack yourself?';
$Definition['RallyPoint']['Errors']['reallyAttackFriend?'] = 'Are you sure you want to attack your friend?';
$Definition['RallyPoint']['Errors']['protectionWillBeGone'] = 'The protection will be cancelled. Are you sure?';
$Definition['RallyPoint']['Errors']['youCannotAttackArtifactWhileInProtection'] = 'You cannot attack a village with artifact while you are in protection.';
$Definition['RallyPoint']['Errors']['youAreBanned'] = 'You Are Banned.';
$Definition['RallyPoint']['Errors']['playerBanned'] = 'This account is banned due to violations of the game rules';
$Definition['RallyPoint']['Errors']['cantSendReinforcementsDuringProtection'] = 'You can\'t send reinforcements while you are in protection.';
$Definition['RallyPoint']['Errors']['heroDeployError'] = 'You can only move in you here in a reinforcement. note that the target village must have rally point.';
$Definition['RallyPoint']['Errors']['serverFinished'] = 'Game Finished.';
$Definition['RallyPoint']['Errors']['playerIsInVacation'] = 'The player is in vacation.';
$Definition['RallyPoint']['Errors']['farmsAreProtectedTill'] = 'Farm are protected till %s.';
$Definition['RallyPoint']['reinforcementForVillageName'] = 'Reinforcement For %s';
$Definition['RallyPoint']['send'] = 'Send';
$Definition['RallyPoint']['edit'] = 'Edit';
$Definition['RallyPoint']['reinforcementForPlayerName'] = 'Reinforcement For %s';
$Definition['RallyPoint']['imprisendInVillage'] = 'Imprisend In %s';
$Definition['RallyPoint']['imprisendPlayer'] = 'Imprisend %s';
$Definition['RallyPoint']['showAll'] = 'show All';
$Definition['RallyPoint']['no_incoming_troops_error'] = 'No incoming troops.';
$Definition['RallyPoint']['no_outgoing_troops_error'] = 'No walking troops.';
$Definition['RallyPoint']['no_outvillage_troops_error'] = 'No out village troops.';
$Definition['RallyPoint']['return'] = 'Return';
$Definition['RallyPoint']['units'] = 'Units';
$Definition['RallyPoint']['ownTroops'] = 'Own Troops';
$Definition['RallyPoint']['from'] = 'from';
$Definition['RallyPoint']['CrannyForest'] = 'Cranny Forest';
$Definition['RallyPoint']['adventure'] = 'Adventure';
$Definition['RallyPoint']['occupiedOasis'] = 'Occupied Oasis';
$Definition['RallyPoint']['unoccupiedOasis'] = 'Unoccupied Oasis';
$Definition['RallyPoint']['ArrivalIn'] = 'Arrival In';
$Definition['RallyPoint']['against'] = 'against';
$Definition['RallyPoint']['for'] = 'for';
$Definition['RallyPoint']['of'] = '';
$Definition['RallyPoint']['catapultTargets'] = 'Target';
//attack types
$Definition['RallyPoint']['inAttack'] = $Definition['RallyPoint']['outAttack'] = $Definition['RallyPoint']['inAttackOasis'] = 'Attack';
$Definition['RallyPoint']['inRaid'] = $Definition['RallyPoint']['outRaid'] = $Definition['RallyPoint']['inRaidOasis'] = 'Raid';
$Definition['RallyPoint']['inSupply'] = $Definition['RallyPoint']['outSupply'] = $Definition['RallyPoint']['inSupplyOasis'] = 'Reinforcement';
$Definition['RallyPoint']['outSettlers'] = 'Build New Village';
$Definition['RallyPoint']['outSpy'] = 'Spy';
$Definition['RallyPoint']['myOasis'] = 'My Oasis';
$Definition['RallyPoint']['outEscape'] = 'Escape to the forest hideout';
$Definition['RallyPoint']['filters'][1] = 'Incoming troops';
$Definition['RallyPoint']['filters'][2] = 'Outgoing troops';
$Definition['RallyPoint']['filters'][3] = 'Troops in this village and its oases';
$Definition['RallyPoint']['filters'][4] = 'Troops in other villages or oases';
$Definition['RallyPoint']['SubFilters'][1] = 'Outgoing attacks/raids';
$Definition['RallyPoint']['SubFilters'][2] = 'Incoming troops';
$Definition['RallyPoint']['SubFilters'][3] = 'Enforcements';
$Definition['RallyPoint']['SubFilters'][4] = 'Outgoing attacks/raids';
$Definition['RallyPoint']['SubFilters'][5] = 'Own reinforcements';
$Definition['RallyPoint']['SubFilters'][6] = 'Sort by send time';
$Definition['RallyPoint']['goldClubEvasionDesc'] = 'With the Gold club you can order the troops in your capital village to flee from attacks.';
$Definition['RallyPoint']['evasion in capital'] = 'Evasion in capital';
$Definition['RallyPoint']['goldclub'] = 'Gold club';
$Definition['RallyPoint']['EvasionSettings'] = 'Evasion settings';
$Definition['RallyPoint']['HeroShowDesc'] = ' Your hero will always stay with the troops';
$Definition['RallyPoint']['HeroHideDesc'] = 'Hero will hide during an attack on their home village.';
$Definition['RallyPoint']["EvasionDesc"] = 'The troops will leave at the moment of the attack and return 180 seconds after. The troops will only evade if there are NO troops returning home within 10 seconds prior to the attack, with the exception of troops returning from the use of this option. This feature will enable all troops trained in the village to evade, but reinforcing troops will NOT evade.';
$Definition['RallyPoint']['Management'] = 'Management';
$Definition['RallyPoint']['overview'] = 'Overview';
$Definition['RallyPoint']['sendTroops'] = 'Send Troops';
$Definition['RallyPoint']['combatSimulator'] = 'Combat Simulator';
$Definition['RallyPoint']['farmlist'] = 'Farm list';
$Definition['RallyPoint']['needClubToBeActive'] = 'For this feature you need the Gold club activated.';
$Definition['RallyPoint']['This tab is set as favourite'] = 'This tab is set as favourite';
$Definition['RallyPoint']['Set tab x as favourite'] = 'Set tab %s as favourite';
$Definition['RallyPoint']['ArrivalIn'] = 'Arrival In';
$Definition['RallyPoint']['kill'] = 'Kill';
$Definition['RallyPoint']['target'] = 'Target';
$Definition['RallyPoint']['player'] = 'Player';
$Definition['RallyPoint']['catapult only attacks in normal type'] = 'Catapult only attacks in <b>normal</b> type';
$Definition['RallyPoint']['troops'] = 'Troops';
$Definition['RallyPoint']['random'] = 'Random';
$Definition['RallyPoint']['willBeAttackedTarget'] = 'Will be attacked by catapult';
$Definition['RallyPoint']['options'] = 'Options';
$Definition['RallyPoint']['Consumption'] = 'Consumption';
$Definition['RallyPoint']['withdraw'] = 'withdraw';
$Definition['RallyPoint']['TroopKillDesc'] = 'Are you sure you want to kill troops?';
$Definition['RallyPoint']['back'] = 'Send back';
$Definition['RallyPoint']['free'] = 'Free';
$Definition['RallyPoint']['spyTarget'] = 'Scout Type';
$Definition['RallyPoint']['spyTargetTroopsBuildings'] = 'Scout defences and troops';
$Definition['RallyPoint']['spyTargetTroopsResources'] = 'Scout resources and troops';
//
$Definition['reCaptcha']['title'] = 'Bot identifier system';
$Definition['reCaptcha']['desc'] = 'We need you to verify that you are not a robot playing the game.<br /><br />Click on the checkbox to verify that you are not a robot.';
$Definition['reCaptcha']['Sorry you submitted wrong answer'] = 'Sorry you answer is not correct.';

$Definition['farmListLockHandle']['title'] = 'Bot identifier system';
$Definition['farmListLockHandle']['captcha'] = 'Captcha';
$Definition['farmListLockHandle']['submit'] = 'Submit';
$Definition['farmListLockHandle']['newCode'] = 'Request new code';
$Definition['farmListLockHandle']['desc'] = 'You used farmlist more than expected in a short time. Your are not able to use farmlist for now. Release your account by entering the below text in the input.';
$Definition['farmListLockHandle']['Sorry you submitted wrong answer'] = 'Sorry you answer is not correct.';

//
$Definition['Reports'] = [
    "reportTypes" => [
        1 => 'Won as attacker without losses',
        0 => 'Report',
        2 => 'Won as attacker with losses',
        3 => 'Lost as attacker with losses',
        4 => 'Won as defender without losses',
        5 => 'Won as defender with losses',
        6 => 'Lost as defender with losses',
        7 => 'Lost as defender without losses',
        8 => 'Reinforcement',
        11 => 'Wood Delivered.',
        12 => 'Clay Delivered.',
        13 => 'Iron Delivered.',
        14 => 'Crop Delivered.',
        15 => 'Won scouting as attacker',
        16 => 'Won scouting as attacker but defender found',
        17 => 'Lost scouting as attacker',
        18 => 'Won scouting as defender',
        19 => 'Lost scouting as defender',
        20 => 'Animals Caught',
        21 => 'Adventure report',
        22 => 'Settlers founded a new village',
    ],
    'not_destroyed_reason' => [
        'disabled' => 'Village did not destroy because village destruction is disabled',
        'isWW' => 'Village did not destroy because it is a WW Village',
        'isFarm' => 'Village did not destroy because it is a Farm Village',
        'disabledCapitalOnZeroPop' => 'Village did not destroy because capital does not destroy on zero pop',
        'OnlyOneVillage' => 'Village did not destroy because player has only one village',
        'ArtifactExists' => 'Village did not destroy because the villge contains an artifact',
    ],
];
$Definition['Reports']['There was no village at target destination'] = 'There was no village at target destination.';
$Definition['Reports']['newVillageCreatedSuccussFully'] = 'New village created successfully';
$Definition['Reports']['escapeNonCapitalErr'] = 'Your troops didn\'t evade because escape is only available in capital.';
$Definition['Reports']['escapeTroopsComingErr'] = 'Your troops didn\'t evade because you got a return within 10 seconds.';
$Definition['Reports']['evasionNotEnabled'] = 'Troops didn`t escape because evasion is not enabled.';
$Definition['Reports']['escapeDisabledBecauseYourPopulationIsTooLow'] = 'Troops didn`t escape because your village population is too low.';
$Definition['Reports']['Overflowing reports will be deleted automatically, if they are older than %s hours'] = 'Overflowing reports will be deleted automatically, if they are older than %s hours.';
$Definition['Reports']['Archive||For this feature you need the Gold club activated'] = 'Archive||For this feature you need the Gold club activated.';
$Definition['Reports']['Add to farm list||For this feature you need the Gold club activated'] = 'Add to farm list||For this feature you need the Gold club activated';
$Definition['Reports']['Mark as read'] = 'Mark as read';
$Definition['Reports']['Mark as unread'] = 'Mark as unread';
$Definition['Reports']['Combat simulator'] = 'Combat simulator';
$Definition['Reports']['Repeat attack'] = 'Repeat attack';
$Definition['Reports']['Tabs']['All'] = 'All';
$Definition['Reports']['Tabs']['Troops'] = 'Troops';
$Definition['Reports']['Tabs']['Trade'] = 'Trade';
$Definition['Reports']['Tabs']['Miscellaneous'] = 'Miscellaneous';
$Definition['Reports']['Tabs']['Archive'] = 'Archive';
$Definition['Reports']['Tabs']['Surrounding'] = 'Surrounding';
$Definition['Reports']['Tabs']['Attacks'] = 'Attacks';
$Definition['Reports']['Tabs']['Defense'] = 'Defense';
$Definition['Reports']['Tabs']['Spy'] = 'Spy';
$Definition['Reports']['Tabs']['Other'] = 'Other';
$Definition['Reports']['needClub'] = 'For using this feature you need an active gold club.';
$Definition['Reports']['village totally destroyed'] = 'Village totally destroyed.';
$Definition['Reports']['adventureFailed'] = 'Adventure wasn\'t successful.';
$Definition['Reports']['Silver'] = 'Silver';
$Definition['Reports']['WWPlanCaptured'] = 'WW Construction plan robbed.';
$Definition['Reports']['heroArtifactCapture'] = 'Artifact robbed.';
$Definition['Reports']['x didnt damaged'] = '%s didn\'t damaged.';
$Definition['Reports']['TrapFreeAllianceAndMe'] = 'You freed %s troops of yours and %s troops of your alliance and others were killed.';
$Definition['Reports']['TrapFreeMe'] = 'You freed %s troops of yours and others were killed.';
$Definition['Reports']['TrapFreeAlliance'] = 'You freed %s troops of your alliance trapped troops and others were killed.';
$Definition['Reports']['select all'] = 'Select all';
$Definition['Reports']['Unread'] = 'Unread';
$Definition['Reports']['location'] = 'location';
$Definition['Reports']['distance'] = 'distance';
$Definition['Reports']['Read'] = 'Read';
$Definition['Reports']['newer reports'] = 'Newer reports';
$Definition['Reports']['older reports'] = 'Older reports';
$Definition['Reports']['Really delete this report?'] = 'Really delete this report?';
$Definition['Reports']['Delete report'] = 'Delete report';
$Definition['Reports']['Delete'] = 'Delete';
$Definition['Reports']['Archive'] = 'Archive';
$Definition['Reports']['Recover'] = 'Recover';
$Definition['Reports']['Access permissions'] = 'Access permissions';
$Definition['Reports']['make opponent anonymous'] = 'make opponent anonymous';
$Definition['Reports']['make myself anonymous'] = 'make myself anonymous';
$Definition['Reports']['hide own troops'] = 'hide own troops';
$Definition['Reports']['hide opposing troops'] = 'hide opposing troops';
$Definition['Reports']['Description:'] = 'Description:';
$Definition['Reports']['VillageCaptured'] = 'Village %s people decided to join your empire.';
$Definition['Reports']['CantCaptureCapital'] = 'You can\'t capture capital.';
$Definition['Reports']['culturePointsErr'] = 'Not enough culture points.';
$Definition['Reports']['rpExists'] = 'Residence or Palace exists.';
$Definition['Reports']['You can only have 1 ww village at a time'] = 'You can only have 1 ww village at a time.';
$Definition['Reports']['You cannot capture your alliance members village'] = 'You cannot capture your alliance member`s village.';
$Definition['Reports']['randomTargetsWereChosen'] = 'Random targets were selected.';
$Definition['Reports']['defenderIsSupportedByTheFollowingArtifact'] = 'Defender is protected by the following artifact: %s';
$Definition['Reports']['NoFreeAttackerTreasurySpace'] = 'There is no treasury or treasury is full.';
$Definition['Reports']['maxArtifactReached'] = 'You have maximum artifacts possible.';
$Definition['Reports']['TreasuryExists'] = 'Treasury exists';
$Definition['Reports']['From'] = 'From';
$Definition['Reports']['Village'] = 'Village';
$Definition['Reports']['oasis'] = 'oasis';
$Definition['Reports']['Troops'] = 'Troops';
$Definition['Reports']['units'] = 'Units';
$Definition['Reports']['Trapped'] = 'Trapped';
$Definition['Reports']['casualties'] = 'Casualties';
$Definition['Reports']['from oasis'] = 'from oasis';
$Definition['Reports']['you used x cages'] = 'You used %s cage(s).';
$Definition['Reports']['x attacks y'] = '%s attacks %s.';
$Definition['Reports']['x send resources to y'] = '%s send resources to %s.';
$Definition['Reports']['Bounty'] = 'Bounty';
$Definition['Reports']['exp'] = 'experience';
$Definition['Reports']['noValuableThingFound'] = 'Your hero found nothing.';
$Definition['Reports']['injury'] = 'health';
$Definition['Reports']['unknown'] = 'unknown';
$Definition['Reports']['Sender'] = 'Sender';
$Definition['Reports']['Recipient'] = 'Recipient';
$Definition['Reports']['supplies'] = 'supplies';
$Definition['Reports']['from alliance'] = 'from alliance';
$Definition['Reports']['x supplies y'] = '%s supplies %s';
$Definition['Reports']['Consumption'] = 'Consumption';
$Definition['Reports']['reinforced'] = 'reinforced';
$Definition['Reports']['x reinforced y'] = '%s reinforced %s';
$Definition['Reports']['perHR'] = 'Per Hour';
$Definition['Reports']['x destroyed'] = '%s destroyed.';
$Definition['Reports']['reduced lvl from x to y'] = '%s\'s level reduced from %s to %s.';
$Definition['Reports']['x did not damaged'] = '%s didn\'t damaged.';
$Definition['Reports']['you troops in village x were attacked'] = 'Your troops in village %s were attacked';
$Definition['Reports']['x is on adventure'] = '%s explores %s.';
$Definition['Reports']['An Oasis was plundered'] = 'An Oasis was plundered.';
$Definition['Reports']['x has conquered an oasis'] = '%s has conquered an oasis.';
$Definition['Reports']['An Oasis was abandoned'] = 'An Oasis was abandoned.';
$Definition['Reports']['x has founded y'] = '%s has founded %s.';
$Definition['Reports']['x has conquered y'] = '%s has conquered %s.';
$Definition['Reports']['x has lost y'] = '%s has lost %s.';
$Definition['Reports']['x renamed y to z'] = '%s renamed %s to %s.';
$Definition['Reports']['A fight took at village name of player name'] = 'A fight took at %s of %s.';
$Definition['Reports']['noData'] = 'There are no reports available.';
$Definition['Reports']['Subject'] = 'Subject';
$Definition['Reports']['Sent'] = 'Sent';
//report types
$Definition['Reports']['AnimalsCaught'] = 'Animals caught.';
$Definition['Reports']['x spies y'] = '%s scouts %s.';
$Definition['Reports']['x founds a new village'] = '%s founds a new village.';
$Definition['Reports']['occupiedOasis'] = 'Occupied oasis';
$Definition['Reports']['unoccupiedOasis'] = 'Unoccupied oasis';
$Definition['Reports']['Attacker'] = 'Attacker';
$Definition['Reports']['Defender'] = 'Defender';
$Definition['Reports']['Reinforcement'] = 'Reinforcement';
$Definition['Reports']['Information'] = 'Information';
$Definition['Reports']['Resources'] = 'Resources';
$Definition['Reports']['None of your soldiers returned'] = 'None of your soldiers returned.';
$Definition['Reports']['None of your spies returned'] = 'None of your spies returned.';
$Definition['Reports']['Ram does not work on alliance members'] = 'Ram does not work on alliance members.';
$Definition['Reports']['Cata is disabled'] = 'Catapult system is disabled.';
$Definition['Reports']['Cata does not work on alliance members'] = 'Catapult does not work on alliance members.';
$Definition['Reports']['NoFreeSlotsToCaptureOasis'] = 'Upgrade your Hero mansion to capture the oases';
$Definition['Reports']['OasisCaptured'] = 'Oasis was captured by the hero..';
$Definition['Reports']['LoyaltyLowered'] = 'Loyalty lowered from <b>%d</b> to <b>%d</b>';
$Definition['Reports']['Inbox - All reports older than seven days will be deleted'] = 'Inbox - All reports which are not archived will be deleted after 3 hours.'; //Inbox - All reports older than seven days will be deleted.

$Definition['Reports']['Management'] = 'Management';
$Definition['Reports']['ManagementDesc'] = 'You can manage your reports here.';
$Definition['Reports']['ManagementOptions'] = [
    1 => 'Won as attacker without losses',
    2 => 'Won as attacker with losses',
    3 => 'Lost as attacker with losses',
    4 => 'Won as defender without losses',
    5 => 'Won as defender with losses',
    6 => 'Lost as defender with losses',
    7 => 'Lost as defender without losses',
    8 => 'Reinforcement',
    9 => 'Merchants',
    10 => 'Spy',
    11 => 'Adventure',
    12 => 'All reports',
];
$Definition['Reports']['startTime'] = [
    0 => 'Start of server',
    600 => '10 min ago',
    1800 => '30 min ago',
    3600 => '1 hour ago',
    7200 => '2 hours ago',
    10800 => '3 hours ago',
    21600 => '6 hours ago',
    43200 => '12 hours ago',
    86400 => '1 day ago',
    172800 => '2 days ago',
    604800 => '7 days ago',
];
$Definition['Reports']['ManagementDeleteDesc'] = "Delete reports of %s from %s %s";
$Definition['Reports']['ButtonOK'] = 'OK';
$Definition['Reports']['ReportsStatistics'] = 'Reports statistics';
$Definition['Reports']['%s report(s) removed successfully'] = '%s report(s) removed successfully.';
$Definition['Reports']['AllReportsCount'] = 'All reports';
$Definition['Reports']['ReportsWithoutCasualties'] = 'Attack reports without casualties';
$Definition['Reports']['ReportsWithCasualties'] = 'Attack reports with casualties';
$Definition['Reports']['ReportsDefWithoutCasualties'] = 'Defense reports without casualties';
$Definition['Reports']['ReportsDefWithCasualties'] = 'Defense reports with casualties';
$Definition['Reports']['ReportsOtherReports'] = 'Other reports';
//
$Definition['ResidencePalace']['Management'] = 'Management';
$Definition['ResidencePalace']['Train'] = 'Train';
$Definition['ResidencePalace']['CulturePoints'] = 'Culture Points';
$Definition['ResidencePalace']['Loyalty'] = 'Loyalty';
$Definition['ResidencePalace']['Expansion'] = 'Expansion';
$Definition['ResidencePalace']['This tab is set as favourite'] = 'This tab is set as favourite';
$Definition['ResidencePalace']['Select x as favor tab'] = 'Set %s as favourite tab.';
$Definition['ResidencePalace']['Controllable villages'] = 'Controllable villages';
$Definition['ResidencePalace']['Number of your villages'] = 'Number of your villages';
$Definition['ResidencePalace']['Maximum controllable villages'] = 'Maximum controllable villages';
$Definition['ResidencePalace']['Culture points per day'] = 'Culture points per day';
$Definition['ResidencePalace']['Culture points produced so far'] = 'Culture points produced so far';
$Definition['ResidencePalace']['Next village controllable at'] = 'Next village controllable at';
$Definition['ResidencePalace']['Culture points still needed'] = 'Culture points still needed';
$Definition['ResidencePalace']['Active village'] = 'Active village';
$Definition['ResidencePalace']['Other villages'] = 'Other villages';
$Definition['ResidencePalace']['Hero'] = 'Hero';
$Definition['ResidencePalace']['Total'] = 'Total';
$Definition['ResidencePalace']['loyaltyDesc'] = 'Total';
$Definition['ResidencePalace']['Coordinates'] = 'Coordinates';
$Definition['ResidencePalace']['noExpansion'] = 'No villages found.';
$Definition['ResidencePalace']['ChangeCapital'] = 'Choose this village as capital';
$Definition['ResidencePalace']['Cant set ww as capital'] = 'You can\'t choose a WW village as capital.';
$Definition['ResidencePalace']['Password'] = 'Password';
$Definition['ResidencePalace']['wrongPass'] = 'Incorrect password.';
$Definition['ResidencePalace']['ConfirmChangeCapital'] = 'Are you sure?';
$Definition['ResidencePalace']['This is your capital'] = 'This is your capital.';
$Definition['ResidencePalace']['Date'] = 'Date';
$Definition['ResidencePalace']['In order to found or conquer further villages, you require culture points An additional village will predictably be controllable on x (±5 minutes)'] = 'In order to found or conquer further villages, you require culture points. An additional village will predictably be controllable on %s (±5 minutes)';
$Definition['ResidencePalace']['The further the buildings of your villages are upgraded, the more culture points per day they will produce'] = 'The further the buildings of your villages are upgraded, the more culture points per day they will produce.';
$Definition['ResidencePalace']['Loyalty in the current village'] = 'Loyalty in the current village';
$Definition['ResidencePalace']['Loyalty overview'] = 'Loyalty overview';
$Definition['ResidencePalace']['village'] = 'Village';
$Definition['ResidencePalace']['Inhabitants'] = 'Inhabitants';
$Definition['ResidencePalace']['Player(s)'] = 'Player(s)';
$Definition['ResidencePalace']['A palace or residence protect a village from being conquered If the seat of government has been destroyed, a village`s loyalty can be lowered by attacks with chieftains, chiefs and senators If the loyalty is lowered to zero, the village will join the attacker`s empire An ongoing great celebration in the village of either attacker or defender will increase or lower the rate at which each attacking administrator will lower the loyalty Each level of the seat of government increases the speed at which the loyalty of a village increases to 100% again A hero stationed in the village can use tablets of law to additionally increase loyalty'] = 'A palace or residence protect a village from being conquered. If the seat of government has been destroyed, a village\'s loyalty can be lowered by attacks with chieftains, chiefs and senators. If the loyalty is lowered to zero, the village will join the attacker\'s empire.An ongoing great celebration in the village of either attacker or defender will increase or lower the rate at which each attacking administrator will lower the loyalty.Each level of the seat of government increases the speed at which the loyalty of a village increases to 100% again.A hero stationed in the village can use tablets of law to additionally increase loyalty.';
//
$Definition['Smithy']['Improve weapons and armour'] = 'Improve weapons and armour';
$Definition['Smithy']['one_research_is_going'] = 'One research is already running.';
$Definition['Smithy']['reachedMaxLvl'] = '%s reached max level.';
$Definition['Smithy']['improve'] = 'Improve';
$Definition['Smithy']['Researching'] = 'Researching';
$Definition['Smithy']['unit'] = 'Unit';
$Definition['Smithy']['upgradeSmithy'] = 'Smithy level too low';
//
$Definition['Statistics']['Prizes for top 10'] = 'Prizes for top 10';
$Definition['Statistics']['Bonus name'] = 'Bonus name';
$Definition['Statistics']['No prize is declared for top10'] = 'No prize is declared for top10.';
$Definition['Statistics']['top10 prize distribution desc'] = 'The prizes for top10 will be given to player after the top10 was reset.';

$Definition['Statistics']['Average number of troops per player'] = 'Average number of troops per player';
$Definition['Statistics']['Game development'] = 'Game development';
$Definition['Statistics']['The following graphs show a time progression of economy, population, and the military strength of your army'] = 'The following graphs show a time progression of economy, population, and the military strength of your army.';
$Definition['Statistics']['Number of troops'] = 'Number of troops';
$Definition['Statistics']['titleInHeader'] = 'Statistics';
$Definition['Statistics']['edit'] = 'edit';
$Definition['Statistics']['tabs'] = [];
$Definition['Statistics']['tabs']['players'] = 'Player(s)';
$Definition['Statistics']['tabs']['alliances'] = 'Alliance';
$Definition['Statistics']['tabs']['villages'] = 'Village';
$Definition['Statistics']['tabs']['hero'] = 'Hero';
$Definition['Statistics']['tabs']['plus'] = 'Plus';
$Definition['Statistics']['tabs']['General'] = 'General';
$Definition['Statistics']['tabs']['WonderOfTheWorld'] = 'WW';
//$Definition['Statistics']['tabs']['WonderOfTheWorld'] = 'WonderOfTheWorld';
$Definition['Statistics']['tabs']['Bonus'] = 'Bonus and states';
$Definition['Statistics']['tabs']['farm'] = 'Farm';
$Definition['Statistics']['Actions'] = 'Actions';
$Definition['Statistics']['subTabs'] = [];
$Definition['Statistics']['subTabs']['overview'] = 'Overview';
$Definition['Statistics']['subTabs']['attacker'] = 'Attacker';
$Definition['Statistics']['subTabs']['defender'] = 'Defender';
$Definition['Statistics']['subTabs']['Top 10'] = 'Top 10';
$Definition['Statistics']['player'] = 'Player';
$Definition['Statistics']['alliance'] = 'Alliance';
$Definition['Statistics']['rank'] = 'Rank';
$Definition['Statistics']['name'] = 'Name';
$Definition['Statistics']['largestPlayers'] = 'Largest players';
$Definition['Statistics']['largestAlliances'] = 'Largest alliances';
$Definition['Statistics']['largestVillages'] = 'Largest villages';
$Definition['Statistics']['level'] = 'level';
$Definition['Statistics']['xp'] = 'Experience';
$Definition['Statistics']['most exp heros'] = 'The most experienced heroes';
$Definition['Statistics']['alliance'] = 'Alliance';
$Definition['Statistics']['population'] = 'Population';
$Definition['Statistics']['village'] = 'Village';
$Definition['Statistics']['points'] = 'Points';
$Definition['Statistics']['coordinates'] = 'Coordinates';
$Definition['Statistics']['errors'] = [];
$Definition['Statistics']['errors']['userNotFound'] = 'Player %s not found.';
$Definition['Statistics']['errors']['allianceNotFound'] = 'Alliance %s not found.';
$Definition['Statistics']['errors']['villageNotFound'] = 'Village %s not found.';
$Definition['Statistics']['top10'] = [];
$Definition['Statistics']['top10']['attackers of the week'] = 'Attackers of the week';
$Definition['Statistics']['top10']['defenders of the week'] = 'Defenders of the week';
$Definition['Statistics']['top10']['robbers of the week'] = 'Robbers of the week';
$Definition['Statistics']['top10']['climbers of the week'] = 'Climbers of the week';
$Definition['Statistics']['top10']['resources'] = 'Resources';
$Definition['Statistics']['top10']['ranks'] = 'ranks';
$Definition['Statistics']['top10']['pop'] = 'pop';
$Definition['Statistics']['top10']['points'] = 'points';
$Definition['Statistics']['top10']['No'] = 'No';
$Definition['Statistics']['top10']['top off hammer'] = 'Top Offensive Hammer';
$Definition['Statistics']['top10']['top def hammer'] = 'Top Defensive Hammer';
$Definition['Statistics']['top10']['date'] = 'date';
$Definition['Statistics']['General'] = [];
$Definition['Statistics']['General']['Country ranks'] = 'Country ranks';
$Definition['Statistics']['General']['Country name'] = 'Country name';
$Definition['Statistics']['General']['Players'] = 'Players';
$Definition['Statistics']['General']['Points'] = 'Points';
$Definition['Statistics']['General']['CountryFlag'] = 'CF';
$Definition['Statistics']['General']['Total country population'] = 'Total country population';
$Definition['Statistics']['General']['Tribe'] = 'Tribe';
$Definition['Statistics']['General']['Tribes'] = 'Tribes';
$Definition['Statistics']['General']['Romans'] = 'Romans';
$Definition['Statistics']['General']['Teutons'] = 'Teutons';
$Definition['Statistics']['General']['Gauls'] = 'Gauls';
$Definition['Statistics']['General']['Egyptians'] = 'Egyptians';
$Definition['Statistics']['General']['Huns'] = 'Huns';
$Definition['Statistics']['General']['Miscellaneous'] = 'Miscellaneous';
$Definition['Statistics']['General']['Attacks'] = 'Attacks';
$Definition['Statistics']['General']['Casualties'] = 'Casualties';
$Definition['Statistics']['General']['Date'] = 'Date';
$Definition['Statistics']['General']['Registered'] = 'Registered';
$Definition['Statistics']['General']['Percent'] = 'Percent';
$Definition['Statistics']['General']['Players'] = 'Players';
$Definition['Statistics']['General']['RegisteredPlayers'] = 'Registered players';
$Definition['Statistics']['General']['ActivePlayers'] = 'Active players';
$Definition['Statistics']['General']['onlinePlayers'] = 'Online players';
$Definition['Statistics']['General']['Attacks and casualties'] = 'Attacks and casualties';
$Definition['Statistics']['WonderOfTheWorld'] = [];
$Definition['Statistics']['WonderOfTheWorld']['player'] = 'Player';
$Definition['Statistics']['WonderOfTheWorld']['name'] = 'Name';
$Definition['Statistics']['WonderOfTheWorld']['alliance'] = 'Alliance';
$Definition['Statistics']['WonderOfTheWorld']['level'] = 'level';
$Definition['Statistics']['WonderOfTheWorld']['attackToWonder'] = '%s';
$Definition['Statistics']['Game development'] = 'Game development';
$Definition['Statistics']['The following graphs show a time progression of economy, population, and the military strength of your army'] = 'The following graphs show a time progression of economy, population, and the military strength of your army.';
$Definition['Statistics']['Number of troops'] = 'Number of troops';
$Definition['Statistics']['total'] = 'total';
$Definition['Statistics']['reinforcements'] = 'reinforcements';
$Definition['Statistics']['Resource production and population'] = 'Resource production and population';
$Definition['Statistics']['resources/4'] = 'resources/4';
$Definition['Statistics']['Inhabitants'] = 'Inhabitants';
$Definition['Statistics']['Rank'] = 'Rank';
$Definition['Statistics']['Number of troops killed'] = 'Number of troops killed';
$Definition['Statistics']['attack'] = 'attack';
$Definition['Statistics']['Winner and top player bonuses'] = 'Winner and top player bonuses';
$Definition['Statistics']['Winner Player'] = 'Winner Player';
$Definition['Statistics']['Second Winner Player'] = '2d Winner Player';
$Definition['Statistics']['Third Winner Player'] = '3rd Winner Player';
$Definition['Statistics']['Bonus rules'] = 'Bonus rules';
$Definition['Statistics']['bonus_rules_array'] = [
    'We will not give any prizes to multi-account players.',
    'If there is a prize for 2nd winner and 3rd winner, the wonder level must be 50+ to get prize.',
    sprintf('Alliance prize is for %s top members (except winner) that their population is above %s.', Config::getProperty("bonus", "bonusGoldTopAllianceCount"), Config::getProperty("bonus", "bonusGoldTopAllianceMinPop")),
    'Some servers may have cash prizes, we`ll notifiy you in that case.',
    'After server finished, the prizes will be added to your vouchers (saved by email).',
];
$Definition['Statistics']['Winner Alliance (Top 5)'] = 'Winner Alliance (Top 5)';
$Definition['Statistics']['Top attacker'] = 'Top 1 attacker';
$Definition['Statistics']['Top defender'] = 'Top 1 defender';
$Definition['Statistics']['Top climber'] = 'Top 1 climber';
$Definition['Statistics']['Server states'] = 'Server states';
$Definition['Statistics']['Daily gold will be given in'] = 'Daily gold will be given in';
$Definition['Statistics']['Daily quest will reset in'] = 'Daily quest will reset in';
$Definition['Statistics']['Medals will be given in'] = 'Medals will be given in';
$Definition['Statistics']['Artifacts will be released in'] = 'Artifacts will be released in';
$Definition['Statistics']['WWPlans will be released in'] = 'WWPlans will be released in';
$Definition['Statistics']['You can build WW in'] = 'You can build WW in';
$Definition['Statistics']['Game will be finished in'] = 'Game will be finished in';
$Definition['Statistics']['hours'] = 'hours';
$Definition['Statistics']['Top Off hammer'] = 'Top 1 Offensive hammer';
$Definition['Statistics']['Top Def hammer'] = 'Top 1 Defensive hammer';
$Definition['Statistics']['raid'] = 'raid';
$Definition['Statistics']['Other prises'] = 'Other prises';
//
$Definition['Treasury']['ArtifactIsDisabled'] = 'Artifact disabled.';
$Definition['Treasury']['This tab is set as favourite'] = 'This tab is set as favourite';
$Definition['Treasury']['Management'] = 'Management';
$Definition['Treasury']['Artefacts in your area'] = 'Artefacts in your area';
$Definition['Treasury']['Small artefacts'] = 'Small artefacts';
$Definition['Treasury']['Large artefacts'] = 'Large artefacts';
$Definition['Treasury']['select tab x as favor tab'] = 'Select tab %s as favor tab.';
$Definition['Treasury']['Stored artefact'] = 'Stored artefact';
$Definition['Treasury']['Name'] = 'Name';
$Definition['Treasury']['Village'] = 'Village';
$Definition['Treasury']['conquered'] = 'Conquered';
$Definition['Treasury']['Former owner'] = 'Former owner';
$Definition['Treasury']['you dont own any artefacts'] = 'You don`t own any artefacts.';
$Definition['Treasury']['Effect'] = 'Effect';
$Definition['Treasury']['Village'] = 'Village';
$Definition['Treasury']['Account'] = 'Account';
$Definition['Treasury']['Player'] = 'Player';
$Definition['Treasury']['Area of effect'] = 'Area of effect';
$Definition['Treasury']['Bonus'] = 'Bonus';
$Definition['Treasury']['Required level'] = 'Required level';
$Definition['Treasury']['Time of conquer'] = 'Time of conquer';
$Definition['Treasury']['Active'] = 'Active';
$Definition['Treasury']['Time of activation'] = 'Time of activation';
$Definition['Treasury']['Alliance'] = 'Alliance';
$Definition['Treasury']['Distance'] = 'Distance';
$Definition['Treasury']['Owner'] = 'Owner';
$Definition['Treasury']['No Artefact'] = 'Artefacts are not released yet.';
//
$Definition['Troops']['hero']['title'] = 'Hero';
$Definition['Troops'][1]['title'] = 'Legionnaire';
$Definition['Troops'][1]['desc'] = 'The Legionnaire is the simple and all-purpose infantry of the Roman Empire. With his well-rounded training, he is good at both defence and offence. However, the Legionnaire will never reach the levels of the more specialized troops.';
$Definition['Troops'][2]['title'] = 'Praetorian';
$Definition['Troops'][2]['desc'] = 'The Praetorians are the emperor\'s guard and they defend him with their life. Because their training is specialized for defence, they are very weak attackers.';
$Definition['Troops'][3]['title'] = 'Imperian';
$Definition['Troops'][3]['desc'] = 'The Imperian is the ultimate attacker of the Roman Empire. He is quick, strong, and the nightmare of all defenders. However, his training is expensive and time-intensive.';
$Definition['Troops'][4]['title'] = 'Equites Legati';
$Definition['Troops'][4]['desc'] = 'The Equites Legati are the roman reconnaissance troops. They are pretty fast and can spy on enemy villages in order to see resources and troops.
<br><br>
If there are no Scouts, Equites Legati or Pathfinders in the scouted village, the scouting remains unnoticed.';
$Definition['Troops'][5]['title'] = 'Equites Imperatoris';
$Definition['Troops'][5]['desc'] = 'The Equites Imperatoris are the standard cavalry of the roman army and are very well armed. They are not the fastest troops, but are a horror for unprepared enemies. You should, however, always keep in mind that catering for horse and rider isn\'t cheap.';
$Definition['Troops'][6]['title'] = 'Equites Caesaris';
$Definition['Troops'][6]['desc'] = 'The Equites Caesaris are the heavy cavalry of Rome. They are very well armoured and deal great amounts of damage, but all that armour and weaponry comes with a price. They are slow, carry less resources and feeding them is expensive.';
$Definition['Troops'][7]['title'] = 'Battering Ram';
$Definition['Troops'][7]['desc'] = 'The Battering Ram is a heavy support weapon for your infantry and cavalry. Its task is to destroy the enemy walls and therefore increase your troops’ chances of overcoming the enemy\'s fortifications.';
$Definition['Troops'][8]['title'] = 'Fire Catapult';
$Definition['Troops'][8]['desc'] = 'The Catapult is an excellent long-distance weapon; it is used to destroy the fields and buildings of enemy villages. However, without escorting troops, it is almost defenceless, so don\'t forget to send some of your troops with it.
<br><br>
Having a high level rally point makes your catapults more accurate and gives you the option to target additional enemy buildings. More information is available <a href="' . getAnswersUrl() . '?view=answers&amp;action=answer&amp;aid=157#go2answer" target="blank">here</a>.
<br>
HINT: Catapults CAN hit the cranny, trappers or stonemason\'s lodges when they target randomly.';
$Definition['Troops'][9]['title'] = 'Senator';
$Definition['Troops'][9]['desc'] = 'The Senator is the tribe\'s chosen leader. He\'s a good speaker and knows how to convince others. He is able to persuade other villages to fight for the empire.
<br><br>
Every time the Senator speaks to the inhabitants of a village, the enemy\'s loyalty value decreases until the village is yours.';
$Definition['Troops'][10]['title'] = 'Settler';
$Definition['Troops'][10]['desc'] = 'Settlers are brave and daring citizens who move out of the village after a long training session to found a new village in your honour.
<br><br>
As the journey and the founding of the new village are very difficult, three settlers are bound to stick together. They need a basis of 750 units per resource.';
$Definition['Troops'][11]['title'] = 'Clubswinger';
$Definition['Troops'][11]['desc'] = 'Clubswingers are the cheapest unit in Travian. They are quickly trained and have medium attack capabilities, but their armour isn’t the best. Clubswingers are almost defenceless against cavalry and will be ridden down with ease.';
$Definition['Troops'][12]['title'] = 'Spearman';
$Definition['Troops'][12]['desc'] = 'In the Teuton army, the Spearman’s task is defence. He is especially good against cavalry thanks to his weapons\' length.

However, avoid using him in attacks, because his offensive capabilities are very low.';
$Definition['Troops'][13]['title'] = 'Axeman';
$Definition['Troops'][13]['desc'] = 'This is the Teuton\'s strongest infantry unit. He is strong at both offence and defence but he is slower and more expensive than other units.';
$Definition['Troops'][14]['title'] = 'Scout';
$Definition['Troops'][14]['desc'] = 'The Scout moves far ahead of the Teuton troops in order to get an impression of the enemy\'s strength and his villages. He moves on foot, which makes him slower than his Roman or Gaul counterparts. He scouts the enemy units, resources and fortifications.
<br><br>
If there are no enemy Scouts, Pathfinders or Equites Legati in the scouted village then the scouting remains unnoticed.';
$Definition['Troops'][15]['title'] = 'Paladin';
$Definition['Troops'][15]['desc'] = 'As they are equipped with heavy armour, Paladins are a great defensive unit. Infantry will find it especially difficult to overcome his mighty shield.
<br><br>
Unfortunately their, attacking capabilities are rather low and their speed, compared to other cavalry units, is below average. Their training takes very long and is rather expensive.';
$Definition['Troops'][16]['title'] = 'Teutonic Knight';
$Definition['Troops'][16]['desc'] = 'The Teutonic Knight is a formidable warrior and instills fear and despair in his foes. In defence, he stands out against enemy cavalry. However, the cost of training and feeding him is extraordinary.';
$Definition['Troops'][17]['title'] = 'Ram';
$Definition['Troops'][17]['desc'] = 'The Ram is a heavy support weapon for your infantry and cavalry. Its task is to destroy enemy walls and therefore increase your troops’ chances of overcoming the enemy\'s fortifications.';
$Definition['Troops'][18]['title'] = 'Catapult';
$Definition['Troops'][18]['desc'] = 'The Catapult is an excellent long-distance weapon; it is used to destroy the fields and buildings of enemy villages. However, without escorting troops, it is almost defenceless, so don\'t forget to send some of your troops with it.
<br><br>
Having a high level rally point makes your catapults more accurate and gives you the option to target additional enemy buildings. More information is available <a href="' . getAnswersUrl() . '?view=answers&amp;action=answer&amp;aid=157#go2answer" target="blank">here</a>.
<br>
HINT: Catapults CAN hit the cranny, trappers or stonemason\'s lodges when they target randomly.';
$Definition['Troops'][19]['title'] = 'Chief';
$Definition['Troops'][19]['desc'] = 'Among their best, the Teutons choose their Chief. To be chosen, bravery and strategy aren\'t enough; you also have to be a formidable speaker as it is the Chief\'s primary objective to convince the population of foreign villages to join the Chief\'s tribe.
<br><br>
The more often the Chief speaks to the population of a village, the more the loyalty of the village sinks until it finally joins the chief\'s tribe.';
$Definition['Troops'][20]['title'] = 'Settler';
$Definition['Troops'][20]['desc'] = 'Settlers are brave and daring citizens who move out of the village after a long training session to found a new village in your honour.
<br><br>
As the journey and the founding of the new village are very difficult, three settlers are bound to stick together. They need a basis of 750 units per resource.';
$Definition['Troops'][21]['title'] = 'Phalanx';
$Definition['Troops'][21]['desc'] = 'Since they are infantry, the Phalanx is cheap and fast to produce.
<br><br>
Though their attack power is low, in defence they are quite strong against both infantry and cavalry.';
$Definition['Troops'][22]['title'] = 'Swordsman';
$Definition['Troops'][22]['desc'] = 'The Swordsmen are more expensive than the Phalanx, but they are an offensive unit.
<br><br>
They are quite weak in defence, especially against cavalry.';
$Definition['Troops'][23]['title'] = 'Pathfinder';
$Definition['Troops'][23]['desc'] = 'The Pathfinder is the Gaul\'s reconnaissance unit. They are very fast and they can make a surreptitious advance on enemy units, resources or buildings in order to spy on them.
<br><br>
If there aren\'t any Scouts, Equites Legati or Pathfinders in the scouted village, the scouting remains unnoticed.';
$Definition['Troops'][24]['title'] = 'Theutates Thunder';
$Definition['Troops'][24]['desc'] = 'Theutates Thunders are very fast and powerful cavalry units. They can carry a large amount of resources which makes them excellent raiders too.
<br><br>
When it comes to defence, their abilities are average at best.';
$Definition['Troops'][25]['title'] = 'Druidrider';
$Definition['Troops'][25]['desc'] = 'This medium cavalry unit is brilliant at defence. The main purpose of the Druidrider is to defend against enemy infantry. Its training cost and food supply are relatively expensive.';
$Definition['Troops'][26]['title'] = 'Haeduan';
$Definition['Troops'][26]['desc'] = 'The Haeduans are the Gaul\'s ultimate weapon for both offence and defence against cavalry. Few units can match their prowess.
<br><br>
However, their training and equipment are very expensive. So you should think very carefully if they will be worth the effort and expenses.';
$Definition['Troops'][27]['title'] = 'Ram';
$Definition['Troops'][27]['desc'] = 'The Ram is a heavy support weapon for your infantry and cavalry. Its task is to destroy the enemy walls and thus increase your troops’ chances of overcoming the enemy\'s fortifications.';
$Definition['Troops'][28]['title'] = 'Catapult';
$Definition['Troops'][28]['desc'] = 'The Catapult is an excellent long-distance weapon; it is used to destroy the fields and buildings of enemy villages. However, without escorting troops, it is almost defenceless, so don\'t forget to send some of your troops with it.
<br><br>
Having a high level rally point makes your catapults more accurate and gives you the option to target additional enemy buildings. More information is available <a href="' . getAnswersUrl() . '?view=answers&amp;action=answer&amp;aid=157#go2answer" target="blank">here</a>.
<br>
HINT: Catapults CAN hit the cranny, trappers or stonemason\'s lodges when they target randomly.';
$Definition['Troops'][29]['title'] = 'Chieftain';
$Definition['Troops'][29]['desc'] = 'Each tribe has an ancient and experienced fighter whose presence and speeches are able to convince the population of enemy villages to join his tribe.
<br><br>
The more often the Chieftain speaks in front of the walls of an enemy village, the more its loyalty sinks until it joins the Chieftain\'s tribe.';
$Definition['Troops'][30]['title'] = 'Settler';
$Definition['Troops'][30]['desc'] = 'Settlers are brave and daring citizens who move out of the village after a long training session to found a new village in your honour.
<br><br>
As the journey and the founding of the new village are very difficult, three settlers are bound to stick together. They need a basis of 750 units per resource.';
$Definition['Troops'][31]['title'] = 'Rat';
$Definition['Troops'][32]['title'] = 'Spider';
$Definition['Troops'][33]['title'] = 'Snake';
$Definition['Troops'][34]['title'] = 'Bat';
$Definition['Troops'][35]['title'] = 'Wild Boar';
$Definition['Troops'][36]['title'] = 'Wolf';
$Definition['Troops'][37]['title'] = 'Bear';
$Definition['Troops'][38]['title'] = 'Crocodile';
$Definition['Troops'][39]['title'] = 'Tiger';
$Definition['Troops'][40]['title'] = 'Elephant';
$Definition['Troops'][41]['title'] = 'Pikeman';
$Definition['Troops'][42]['title'] = 'Thorned Warrior';
$Definition['Troops'][43]['title'] = 'Guardsman';
$Definition['Troops'][44]['title'] = 'Birds Of Prey';
$Definition['Troops'][45]['title'] = 'Axerider';
$Definition['Troops'][46]['title'] = 'Natarian Knight';
$Definition['Troops'][47]['title'] = 'War Elephant';
$Definition['Troops'][48]['title'] = 'Ballista';
$Definition['Troops'][49]['title'] = 'Natarian Emperor';
$Definition['Troops'][50]['title'] = 'Settler';
$Definition['Troops'][51]['title'] = 'Slave Militia';
$Definition['Troops'][51]['desc'] = 'The Slave Militia is the cheapest unit with the shortest production time in the game. While this allows you to raise a defense very quickly, he compares badly in fighting strength to other defensive troops.';
$Definition['Troops'][52]['title'] = 'Ash Warden';
$Definition['Troops'][52]['desc'] = 'The Ash Warden is your standard defensive foot soldier with solid combat power. He fares exceptionally well against other infantry, yet his defense against cavalry should not be overlooked.';
$Definition['Troops'][53]['title'] = 'Khopesh Warrior';
$Definition['Troops'][53]['desc'] = 'The Khopesh Warrior is an elite soldier boasting both a strong offense and remarkable defense against other warriors on foot.';
$Definition['Troops'][54]['title'] = 'Sopdu Explorer';
$Definition['Troops'][54]['desc'] = 'The Sopdu Explorer rides out into unknown territory to explore the area and count the military numbers of your enemies. He is also able to investigate the setup of opposing villages and detect any weak points.';
$Definition['Troops'][55]['title'] = 'Anhur Guard';
$Definition['Troops'][55]['desc'] = 'The Anhor Guard is a mounted defender that dominates any attacking infantry. In addition to moderate prowess in offense and defense against cavalry, he is the fastest Egyptian unit after the Sopdu Explorer.';
$Definition['Troops'][56]['title'] = 'Resheph Chariot';
$Definition['Troops'][56]['desc'] = 'The Resheph Chariot is well-versed in all masteries of combat. He packs a heavy offensive punch as well as a very solid defense against infantry, though he truly excels at defending against cavalry. In return, he is very costly to train and consumes plenty of crop.';
$Definition['Troops'][57]['title'] = 'Ram';
$Definition['Troops'][57]['desc'] = 'The Ram is a heavy support weapon for your infantry and cavalry. Its task is to destroy the enemy walls and therefore increase your troops’ chances of overcoming the enemy\'s fortifications.';
$Definition['Troops'][58]['title'] = 'Stone Catapult';
$Definition['Troops'][58]['desc'] = 'The Stone Catapult is an excellent long-distance weapon; it is used to destroy the fields and buildings of enemy villages. However, without escorting troops, it is almost defenceless, so don\'t forget to send some of your troops with it. 
<br/>
Having a high level rally point makes your catapults more accurate and gives you the option to target additional enemy buildings. More information is available here. HINT: Catapults CAN hit the cranny, trappers or stonemason\'s lodges when they target randomly.';
$Definition['Troops'][59]['title'] = 'Nomarch';
$Definition['Troops'][59]['desc'] = 'The Nomarch is the administrative leader of the Egyptians. He negotiates terms of surrender and, thanks to his charisma, can win over enemy people to join your empire. 
<br/>
With every visit of the Nomarch, the loyalty of the enemy’s population decreases until it is reduced to nothing and the people accept your rule.';
$Definition['Troops'][60]['title'] = 'Settler';
$Definition['Troops'][60]['desc'] = 'Settlers are brave and daring citizens who move out of the village after a long training session to found a new village in your honour. 
<br/>
As the journey and the founding of the new village are very difficult, three settlers are bound to stick together. They need a basis of 750 units per resource.';
$Definition['Troops'][61]['title'] = 'Mercenary';
$Definition['Troops'][61]['desc'] = 'The Mercenary is a jack-of-all-trades. His offensive and defensive performance is very comparable, yet he does not excel in any form of combat. However, his abilities are reflected in his moderate training costs.';
$Definition['Troops'][62]['title'] = 'Bowman';
$Definition['Troops'][62]['desc'] = 'The Bowman is your premium choice for large offensive strikes. He loves to be at the front lines, which is fortunate, because of his puny defensive skill.';
$Definition['Troops'][63]['title'] = 'Spotter';
$Definition['Troops'][63]['desc'] = 'The Spotter is a lighting-fast scout unit that detects military and economic secrets of your enemies‘ villages and relays them back to you.';
$Definition['Troops'][64]['title'] = 'Steppe Rider';
$Definition['Troops'][64]['desc'] = 'The Steppe Rider is an outstanding attacker who undergoes training faster than most other mounted warriors. As a result however, he is very weak in defensive combat.';
$Definition['Troops'][65]['title'] = 'Marksman';
$Definition['Troops'][65]['desc'] = 'The Marksman is a well-rounded cavalry unit. His solid attacking power is overshadowed by the fact that he is the only proficient defensive soldier of the Huns.';
$Definition['Troops'][66]['title'] = 'Marauder';
$Definition['Troops'][66]['desc'] = 'The Marauder is an absolute force to be reckoned with. With incredible attacking power as well as impressive speed, he overruns most defenses without a scratch on his armor.';
$Definition['Troops'][67]['title'] = 'Ram';
$Definition['Troops'][67]['desc'] = 'The Ram is a heavy support weapon for your infantry and cavalry. Its task is to destroy the enemy walls and therefore increase your troops’ chances of overcoming the enemy\'s fortifications.';
$Definition['Troops'][68]['title'] = 'Catapult';
$Definition['Troops'][68]['desc'] = 'The Catapult is an excellent long-distance weapon; it is used to destroy the fields and buildings of enemy villages. However, without escorting troops, it is almost defenceless, so don\'t forget to send some of your troops with it. 
<br/>
Having a high level rally point makes your catapults more accurate and gives you the option to target additional enemy buildings. More information is available here. HINT: Catapults CAN hit the cranny, trappers or stonemason\'s lodges when they target randomly.';
$Definition['Troops'][69]['title'] = 'Logades';
$Definition['Troops'][69]['desc'] = 'The Logades has earned his place by defeating all challengers in a deadly battle of physical and mental prowess. Now he leaves his dwelling only to conquer. 
<br/>
Everytime he steps into the village of an enemy, his powerful presence reduces the loyalty of the people to their previous owner, until they decide to join your command.';
$Definition['Troops'][70]['title'] = 'Settler';
$Definition['Troops'][70]['desc'] = 'Settlers are brave and daring citizens who move out of the village after a long training session to found a new village in your honour. 
<br/>
As the journey and the founding of the new village are very difficult, three settlers are bound to stick together. They need a basis of 750 units per resource.';

$Definition['Troops'][98]['title'] = 'Hero';
$Definition['Troops'][99]['title'] = 'Trap';
//
$Definition['villageOverview']['villageOverview'] = 'Village overview';
$Definition['villageOverview']['Overview'] = 'Overview';
$Definition['villageOverview']['Resources'] = 'Resources';
$Definition['villageOverview']['Warehouse'] = 'Warehouse';
$Definition['villageOverview']['CulturePoints'] = 'Culture points';
$Definition['villageOverview']['Troops'] = 'Troops';
$Definition['villageOverview']['Select x as favor tab'] = 'Select %s as favor tab.';
$Definition['villageOverview']['This tab is set as favourite'] = 'This tab is set as favourite tab.';
$Definition['villageOverview']['Village statistics||For this feature you need Travian Plus activated'] = 'Village statistics||For this feature you need Travian Plus activated.';
$Definition['villageOverview']['Village'] = 'Village';
$Definition['villageOverview']['Attacks'] = 'Attacks';
$Definition['villageOverview']['Building'] = 'Building';
$Definition['villageOverview']['Troops'] = 'Troops';
$Definition['villageOverview']['Merchants'] = 'Merchants';
$Definition['villageOverview']['Own attacking troops'] = 'Own attacking troops';
$Definition['villageOverview']['Oasis attacking troops'] = 'Oasis attacking troops';
$Definition['villageOverview']['Oasis reinforcing troops'] = 'Oasis reinforcing troops';
$Definition['villageOverview']['Village reinforcing troops'] = 'Village reinforcing troops';
$Definition['villageOverview']['Other attacking troops'] = 'Other attacking troops';
$Definition['villageOverview']['Own Reinforcing troops'] = 'Own Reinforcing troops';
$Definition['villageOverview']['Sum'] = 'Sum';
$Definition['villageOverview']['duration'] = 'duration';
$Definition['villageOverview']['CPs/Day'] = 'CPs/Day';
$Definition['villageOverview']['Celebrations'] = 'Celebrations';
$Definition['villageOverview']['Slots'] = 'Slots';
$Definition['villageOverview']['Own Troops'] = 'Own Troops';
$Definition['villageOverview']['Troops in villages'] = 'Troops in villages';
$Definition['villageOverview']['Upkeep'] = 'Upkeep';
$Definition['villageOverview']['Armory'] = 'Armory';
$Definition['villageOverview']['inResearch'] = 'In progress';
$Definition['villageOverview']['research_level'] = 'Research level';
$Definition['villageOverview']['per hour'] = 'per hour';
//
$Definition['demolishNowPopup']['Redeem'] = 'Redeem';
$Definition['demolishNowPopup']['desc'] = 'Are you sure you want to completely demolish this building? This building will be removed from your village.';
//
$Definition['finishNowPopup']['title'] = 'Complete construction immediately';
$Definition['finishNowPopup']['desc'] = 'The following commands will be instantly completed:';
$Definition['finishNowPopup']['Redeem'] = 'Redeem';
$Definition['finishNowPopup']['buildingOrders'] = 'Building instructions:';
$Definition['finishNowPopup']['academy'] = 'Research' . '(Academy)';
$Definition['finishNowPopup']['smithy'] = 'Research' . '(smithy)';
$Definition['finishNowPopup']['demolishBuildingLevel'] = 'Demolish building level';
$Definition['finishNowPopup']['level'] = 'Level';
$Definition['finishNowPopup']['No construction orders or research that could be completed instantly'] = 'No construction orders or research that could be completed instantly.';
//
$Definition['goldClubPopup']['title'] = 'Golden Club';
$Definition['goldClubPopup']['gold'] = 'Gold';
$Definition['goldClubPopup']['Bonus duration'] = 'Bonus duration';
$Definition['goldClubPopup']['whole game round'] = 'whole game round';
$Definition['goldClubPopup']['Additionally, you will have access to the following features:'] = 'Additionally, you will have access to the following features:';
$Definition['goldClubPopup']['In order to use this feature, you need to activate the Gold club!'] = 'In order to use this feature, you need to activate the Gold club!';
$Definition['goldClubPopup']['troopEscape'] = [
    'title' => 'Evasion in capital',
    'text' => 'Own troops in your capital can be ordered to automatically flee the village from attacks via the rally point.',
];
$Definition['goldClubPopup']['raidList'] = [
    'title' => 'Farm list',
    'text' => 'In the rally point, you can use the farm list to manage attacks on lucrative targets.',
];
$Definition['goldClubPopup']['tradeThreeTimes'] = [
    'title' => 'Merchants can run 3 times',
    'text' => 'Merchants can carry out resource shipments automatically up to three times in a row.',
];
$Definition['goldClubPopup']['tradeRoute'] = [
    'title' => 'Automatic trade routes',
    'text' => 'You can set up timed and regular resource shipments between your own villages.',
];
$Definition['goldClubPopup']['cropFinder'] = [
    'title' => 'Crop finder (9 and 15) on the map',
    'text' => 'An integrated search function on the map allows you to find slots with increased crop production and oasis bonus.',
];
$Definition['goldClubPopup']['messageArchive'] = [
    'title' => 'Message and report archive',
    'text' => 'Important messages and reports can be archived and easily accessed later on.',
];
$Definition['goldClubPopup']['furtherInfos'] = 'The <B>Gold club</b> will enable these features for the rest of the game round. Click the "i" for more information..';
//
$Definition['overlay'] = [
    'defaultTitle' => 'Welcome to the new Travian User Panel',
    'defaultDescription' => 'To see more information about any of the part mouse cursor on the box to take each item of information to be displayed.',
    'closeLink' => 'Close help and continue to play.',
    'mainPageTitle' => 'Home',
    'mainPageDescription' => 'The <span class=\"important\">Travian emblem<\/span> brings you to our main page, which provides you with further information and games.',
    'villageSwitchTitle' => 'Switch village view',
    'villageSwitchDescription' => 'Switch between the resource fields outside of your village and the village centre containing all your other buildings. Click on a resource field, building or empty slot to open them. Here you can either upgrade or use them.',
    'mainNavigationTitle' => 'Special game overviews',
    'mainNavigationDescription' => '<span class=\"important\">World map:<\/span> The map shows the surroundings of your village. Here you can see targets and potential threats.<br \/><span class=\"important\">Statistics:<\/span> Selected data of all players and alliances within the game.<br \/><span class=\"important\">Reports:<\/span> Reports regarding events such as battles, trades and adventures.<br \/><span class=\"important\">Messages:<\/span> Strike deals or make plans directly with other players.',
    'premiumFeaturesTitle' => 'Purchase and use gold',
    'premiumFeaturesDescription' => 'Buy <span class="important">Gold</span> here to have access to exclusive features and interface upgrades.<br \/><span class=\"important\">Silver<\/span> is used in hero auctions and can be exchanged for gold at the auction house.',
    'outOfGameTitle' => 'Management',
    'outOfGameDescription' => 'Useful game features:<br /><span class="important">Profile:</span> Edit your public player profile.<br /><span class="important">Settings:</span> Preferences and technical settings.<br /><span class="important">Forum:</span> Go straight to the official Travi4n forum.<br /><span class="important">IRC:</span> A support chat in which you can find help.<br /><span class="important">Answers:</span> The Travian help pages.<br /><span class="important">Logout:</span> Log out of your account.',
    'villageResourcesTitle' => 'Resources of the selected village',
    'villageResourcesDescription' => 'Displays the size of the warehouse and current stock of the resources lumber, clay and iron.<br \/>A click on the stock will display an overview as to how the current production of a resource is calculated.',
    'villageCropTitle' => 'Crop of the selected village',
    'villageCropDescription' => 'Displays the size of the granary and current crop stock. Free crop is required for the upkeep of new or upgraded buildings. In-game, click on the relevant buttons to see more detailed information.',
    'sidebarBoxHeroTitle' => 'Your hero avatar',
    'sidebarBoxHeroDescription' => 'Your hero and some important data about it.<br \/>Click on the image to change attributes or equip items.<br \/>The first button leads to available adventures; you can send your hero on its way straight from there. The other button leads to the auction house, where you can sell your collected items or buy some from other players.',
    'sidebarBoxAllianceTitle' => 'Your alliance',
    'sidebarBoxAllianceDescription' => 'In an alliance, players can better cooperate with each other and offer each other support. For your own safety you should quickly search for allies. When you\'re a member of an alliance, the buttons will lead to the alliance profile and the alliance forum.',
    'sidebarBoxInfoboxTitle' => 'The info box',
    'sidebarBoxInfoboxDescription' => 'Here you can find important system messages.',
    'sidebarBoxLinklistTitle' => 'The link list',
    'sidebarBoxLinklistDescription' => 'In order to use the link list, you need Atergatis PLUS.<br \/>Direct links to important targets or buildings as well as external links can be created. The button allows you to edit the list.',
    'sidebarBoxActiveVillageTitle' => 'Village sign of the active village',
    'sidebarBoxActiveVillageDescription' => 'Name of the selected village and the loyalty of its citizens to your rule.<br \/>At the top, PLUS users can find 4 direct links to the marketplace and troop buildings. The edit button allows you to change the village name.',
    'sidebarBoxVillagelistTitle' => 'The list of all your villages',
    'sidebarBoxVillagelistDescription' => 'In the header, you can see how many villages you currently own and how many you could currently have. Below, you can see the culture point progress needed for the next village. The buttons allow you to look at some other overview pages and to display the village coordinates.',
    'sidebarBoxQuestmasterTitle' => 'The advisor and taskmaster',
    'sidebarBoxQuestmasterDescription' => 'Click on the taskmaster to show or hide his tasks for you. He will let you know if there are any news. Below you can find an overview of the current tasks.',
];
//
$Definition['plusPopup'] = [
    'title' => 'Travian PLUS',
    'subHeadLine' => 'In order to use this feature, you need to activate Travian PLUS.',
    'plusPopupButtonExtraFeatures' => 'Additionally, you will have access to the following features:',
    'Bonus duration in days:' => 'Bonus duration in days:',
    "features" => [
        'attackWarning' => [
            'title' => 'Attack warning',
            'text' => 'Incoming attacks will be displayed in the village list.',
        ],
        'buildingQueue' => [
            'title' => 'Building queue',
            'text' => 'The building queue allows you to queue one further construction order.',
        ],
        'directLinks' => [
            'title' => 'Direct links',
            'text' => 'Direct links to marketplace, barracks, stable and workshop, as well as additional important tooltip information.',
        ],
        'linkList' => [
            'title' => 'Link list',
            'text' => 'Allows for freely definable links, which allow you to reach every page in the game with one simple click..',
        ],
        'villageStatistics' => [
            'title' => 'Village overview',
            'text' => 'Overview of production, stock, culture points and troops for all your villages.',
        ],
        'fullScreen' => [
            'title' => 'Larger map',
            'text' => 'For a better overview, the map can be extended to cover the whole screen and display a larger area.',
        ],
        'tradeMulti' => [
            'title' => 'Merchants can run twice',
            'text' => 'Merchants can automatically repeat resource deliveries for a second time.',
        ],
    ],
    'furtherInfos' => 'Travian PLUS enables the above mentioned features for %s days and can be extended at any time. If you select the automatic extension of this feature, it will be extended one day before it runs out and the gold will also be deducted then. For further information, click the "i".',
];
//
$Definition['productionBoostPopup']['+25%‎ lumber production'] = '+25% More wood production';
$Definition['productionBoostPopup']['+25%‎ clay production'] = '+25% Clay produced more';
$Definition['productionBoostPopup']['+25%‎ iron production'] = '+25% Iron production more';
$Definition['productionBoostPopup']['+25%‎ crop production'] = '+25% Wheat production more';
$Definition['productionBoostPopup']['Production bonus'] = 'Production bonuses';
$Definition['productionBoostPopup']['Select which resources production you would like to increase:'] = 'A feature which increases the resources to Selection:';
$Definition['productionBoostPopup']['Bonus duration in days:'] = 'duration in days:';
$Definition['productionBoostPopup']['furtherInfos'] = 'The production bonus increases the production of the selected resource(s) in all your villages by 25%% for %s days. If you select the automatic extension, the production bonus will be re-activated automatically once it runs out.';

$Definition['Support'] = [
    'Support' => 'Support',
    'description' => 'You can use the following form to submit your request to the Support. Please take a bit of time to answer the form questions in as much detail as possible, so that we can answer your request quickly and in length. Please note that without a valid email address, your request will not get processed.',
    'Game errors, login errors and game rules related questions' => 'Game errors, login errors and game rules related questions',
    'Game world' => 'Game world',
    'please select' => 'please select',
    'I don´t know' => 'I don´t know',
    'Username' => 'Username',
    'Email' => 'Email',
    'Category' => 'Category',
    'Message' => 'Message',
    'General questions' => 'General questions',
    'I cannot log in' => 'I cannot log in',
    'I cannot register an account' => 'I cannot register an account',
    'send request' => 'send request',
    'Captcha' => 'Captcha',
    'errors' => [
        'please select',
        'This field is necessary' => 'This field is necessary.',
        'Entry is too short' => 'Entry is too short.',
        'Invalid email address' => 'Invalid email address.',
        'Wrong captcha' => 'Wrong captcha.',
    ],
    'done' => 'We will try to help you as soon as possible. Please be patient - you will usually receive an answer within 24 hours.',
];

$Definition['inGameSupport'] = [
    'Support' => 'Support',
    'description' => 'Using our help system, the Answers page, you can easily find answers to all general questions about Travian quickly and without searching for a long time. Additionally, you have the possibility to contact the support. It can take our support up to 24 hours to answer your question. To get a faster answer, try Answers.',
    'Game errors, login errors and game rules related questions' => 'Game errors, login errors and game rules related questions',
    'Category' => 'Category',
    'Message' => 'Message',
    'general questions' => 'general questions',
    'report an error' => 'report an error',
    'send request' => 'send request',
    'please select' => 'please select',
    'Game support' => 'Game support',
    'Violation of the rules' => 'Violation of the rules',
    'Plus support' => 'Plus support',
    'Back to the village' => 'Back to the village.',
    'Captcha' => 'Captcha',
    'errors' => [
        'please select',
        'This field is necessary' => 'This field is necessary.',
        'Entry is too short' => 'Entry is too short.',
        'Wrong captcha' => 'Wrong captcha.',
    ],
    'done' => 'We will try to help you as soon as possible. Please be patient - you will usually receive an answer within 24 hours.',
];
$Definition['LinkList']['Vouchers (GoldBank)'] = 'Vouchers (GoldBank)';
$Definition['LinkList']['Farmlist'] = 'Farmlist';
$Definition['LinkList']['Farms'] = 'Farms';
$Definition['LinkList']['Go to admin panel'] = 'Go to admin panel';
$Definition['LinkList']['Contact Support'] = 'Contact Support';

$Definition['Email']['serverStartEmailSubject'] = 'Citvian new server starts soon';
$Definition['Email']['serverStartEmail'] = '
<div style="font-size: 14px;">
Dear [PLAYERNAME], <br /> The <b><u>[SERVER_NAME]</b></u> game world will be started soon!
<br />
<p style="color: red; font-weight: bold; font-size: 16px; text-align: center;">The server will be started at <u>[SERVER_START_TIME]</u>.</p>
<br />
This email is to notify you that the game server <b><u>[SERVER_NAME]</u></b> <b>will be started soon</b>. Don`t miss anything. Be the first to activate and join the server.
<br />
<p style="color: green; font-weight: bold; font-size: 16px; text-align: center;">
Click on the link to play and have fun: <a href="[SERVER_URL]">[SERVER_URL]</a>
</p>
</div>';
$Definition['redeemCode'] = [
    'Redeem' => 'Redeem',
    'EnterYourCodeTo' => 'If you have a redeem code, enter your code to redeem your purchase below:',
    'Redeem code' => 'Redeem code',
    'Purchased code' => 'Purchased code',
    'invalidCode' => 'Invalid code.',
    'codeIsUsed' => 'This code is used before.',
    'redeemSuccess' => 'You successfully redeemed your code. The gold will be added to you soon.',
    'tooManyTries' => 'Too many tries. Please try again after sometime.',
    'unknownError' => 'Unknown error',
];
$Definition['Voting'] = [
    'description' => 'You can vote here at these websites listed below and get %s gold for free.',
    'Next vote in %s hours' => 'Next vote in %s hours.',
    'Vote at TopG' => 'Vote at TopG',
    'Vote at Arena Top 100' => 'Vote at Arena Top 100',
    'Vote at GTop100' => 'Vote at GTop100',
];
$Definition['Embassy']['Alliance'] = 'Alliance';
$Definition['Embassy']['Password'] = 'Password';
$Definition['Embassy']['Confirm'] = 'Confirm';
$Definition['Embassy']['No nearby alliance found'] = 'No nearby alliance found';
$Definition['Embassy']['Population'] = 'Population';
$Definition['Embassy']['Villages within 50 fields'] = 'Villages within 50 fields';
$Definition['Embassy']['Alliance %s (%s), invited by %s'] = 'Alliance %s (%s), invited by %s';
$Definition['Embassy']['Found alliance'] = 'Found alliance';
$Definition['Embassy']['In order to found an alliance you need to have an embassy level 3'] = 'In order to found an alliance you need to have an embassy level 3';
$Definition['Embassy']['Join alliance'] = 'Join alliance';
$Definition['Embassy']['Find alliance'] = 'Find alliance';
$Definition['Embassy']['The password is wrong'] = 'The password is wrong.';
$Definition['Embassy']['In order to quit the alliance you have to enter your password again for safety reasons'] = 'In order to quit the alliance you have to enter your password again for safety reasons';
$Definition['Embassy']['Leave the alliance'] = 'Leave the alliance';
$Definition['Embassy']['Alliance leave contribution note'] = 'This will only affect your overall contribution rank. The contributions to the current alliance bonuses will stay. If you return, your contribution sum will be 0.';
$Definition['Embassy']['If you leave the alliance your contribution statistics will reset'] = 'If you leave the alliance your contribution statistics will reset';

$Definition['Mail']['Hello'] = 'Hello';
$Definition['Mail']['Activate'] = 'Activate';
$Definition['Mail']['Activation code'] = 'Activation code';
$Definition['Mail']['Email verification reminder'] = 'Email verification reminder';
$Definition['Mail']['Activation progress reminder'] = 'Activation progress reminder';
$Definition['Mail']['_TO_ACTIVATE_YOUR_ACCOUNT_PLEASE_'] = 'To activate your account, please click on the confirm button or copy the activation code below and paste it in your browser.';
$Definition['Mail']['Continue Registration Progress'] = 'Continue Registration Progress';
$Definition['Mail']['Your Travian Team'] = 'Your Travian Team';
$Definition['Mail']['Enjoy the game and fight many glorious battles'] = 'Enjoy the game and fight many glorious battles';
$Definition['Mail']['Game world Url'] = 'Game world Url';
$Definition['Mail']['Thank you for registering on %s'] = 'Thank you for registering on %s';
$Definition['Mail']['APPROVED_EMAIL_TO_CONTINUE_INSTRUCTIONS'] = 'You have already approved your email address. To complete your registration and play, login to your account or click on the link below to directly go to the process:';

$Definition['EVerify'] = [
    'Email verification' => 'Email verification',
    'VERIFICATION_CODE' => 'Verification code',
    'NEED_VERIFICATION_FOR_FEATURES' => 'You\'ll need to verify your email to continue using full features of the game.',
    'ADD_NEW_VERIFY_PROGRESS' => 'Add new verify progress',
    'VERIFY' => 'Verify',
    'EMAIL_ADDRESS' => 'e-mail address',
    'VERIFICATION_IN_PROGRESS' => 'Verification is in progress.',
    'ENTER_CODE_OR_CLICK_ON_THE_LINK' => 'Enter your verification code or click on the link in the email to verify your e-mail address.',
    'PLEASE_CHECK_SPAM_BOX' => 'Please also check your <b>spam mailbox</b>.',
    'TO_CANCEL_AND_CREATE_NEW_ONE_CLICK_HERE' => 'To cancel current verification progress and start new one <a href="/verify.php?cancelProgress">click here</a>.',
    'errors' => [
        'emptyEmail' => 'Please enter an email.',
        'invalidEmail' => 'Your email is not well formatted and incorrect.',
        'alreadyInProgress' => 'You have one verification in progress.',
        'emailAlreadyExists' => 'This email address already exists. One account per email is allowed.',
        'emailBlacklisted' => 'This email is blacklisted. You cannot verify your account with this email address.',
        'noVerificationInProgress' => 'There is no verification in progress.',
        'emptyCode' => 'Please enter verification code.',
        'invalidCode' => 'Verification code is invalid.',
        'verificationSuccessFull' => 'Verification was success full. All features unlocked.',
        'invalidCaptcha' => 'Invalid captcha.',
        'verificationEmailHasBeenSent' => 'Activation code was sent to your email.<br/>Please click on the link in the email or enter the code you received here to verify ownership of the email address.',
        'tooManyResends' => 'You have requested too many resend requests. Calm down for a while.',
    ],
    'limitations' => [
        'You cannot restore your account password if it`s forgotten.',
        'You cannot send any movements (attacks, reinforcements) except adventures and trades.',
        'You cannot make any purchases.',
        'You cannot use voucher system.',
        'Your remaining golds and bonuses won`t be saved to your email.',
        'Your medals won`t be saved.',
        'Your medals won`t be shown.',
    ],
    'UNVERIFIED_ACCOUNT_LIMITATIONS' => 'Unverified account limitations',
    'YOU_CANNOT_DO_THE_FOLLOWING_THINGS' => 'If you don`t verify your email you cannot do the following things',
    'WE_ARE_NOT_RESPONSIBLE_AS_ADMINISTRATORS_TO_RESTORE' => 'If you don`t verify your email, we as administrators will not help you restore your account password, save your remaining gold, restore your medals, ... .',
    'YOU_ARE_THE_ONLY_ONE_RESPONSIBLE' => 'You are the only one who is responsible for this verification.',
    'TO_LOGIN_PLEASE_CLICK_HERE' => 'To login please <a href="login.php">click here</a>.',
    'NO_CODE_ENTERED' => 'No code entered.',
    'ENTERED_CODE_INVALID' => 'Entered code is invalid.',
    'EMAIL_EXISTS_CANT_VERIFY' => 'We couldn\'t verify your e-mail address because it\'s already verified on another account.',
    'EMAIL_BLACKLISTED_CANT_VERIFY' => 'We couldn\'t verify your e-mail address because the e-mail address is in the blacklist.',
    'NO_MATCHING_ROWS_FOUND' => 'We couldn\'t find any results matching your verification code.',
    'YOUR_ACCOUNT_WAS_VERIFIED_SUCCESSFULLY' => 'Your email was verified successfully.',
    'email' => [
        'HELLO_X' => 'Hello %s,',
        'THANKS_FOR_REGISTERING_ACCOUNT' => 'Thank you for registering your Travian account!',
        'INSTRUCTIONS' => 'You signed up for Travian world. To verify your e-mail address please click the following link or enter the verification code directly to the system:',
        'YOUR_ACCESS_DATA' => 'Your access data',
        'PLAYER_NAME' => 'Player name',
        'EMAIL_ADDRESS' => 'Email address',
        'GAME_WORLD' => 'Game world',
        'VERIFICATION_CODE' => 'Verification code',
        'HAVE_A_GOOD_TIME_AND_MANY_GLORIOUS_BATTLES' => 'Have a good time and many glorious battles.',
        'YOUR_TRAVIAN_TEAM' => 'Your Travian Team',
        'GAME_HINTS' => 'Game hints',
        'IN_OUR_ANSWERS_AND_FORUM' => 'In our Travian Answers you will find answers for %s many questions concerning Travian. You may also visit our forums at %s for relevant news and to communicate with other players.',
    ],
    'YOUR_EMAIL_ADDRESS_IS_NOT_VERIFIED_TO_VERIFY_CLICK_HERE' => 'Your email address is not verified. To verify please <a href="/verify.php">click here</a>.',
    'TO_RESEND_EMAIL_PLEASE_CLICK_HERE' => 'To resend verfication code email please <a href="verify.php?resendEmail">click here</a>.',
    'LOGIN_BEFORE_GAME_DESCRIPTION_VERIFY' => 'Your account is activated and there is no need to verify your email for now. You can play right after server is started by entering your username and password.',
];
$Definition['Truce'] = [
    'reasons' => [
        0 => 'Normal',
        1 => 'Christmas',
        2 => 'New Year',
        3 => 'Easter',
        4 => 'Mourning Ashura',
    ],
    'infobox_reasons' => [
        0 => 'Normal truce active<br>Start: %s<br>End:%s',
        1 => 'Christmas`s truce active<br>Start: %s<br>End:%s',
        2 => 'New Year`s truce active<br>Start: %s<br>End:%s',
        3 => 'Easter`s truce active<br>Start: %s<br>End:%s',
        4 => 'Ashura`s truce active<br>Start: %s<br>End:%s',
    ],
    'report_descriptions' => [
        0 => '%s visited your village.',
        1 => '%s wishes you happy chrismas.',
        2 => '%s wishes you happy new year.',
        3 => '%s wishes you happy easter.',
        4 => '%s shows his/her condolences for Ashura event',
    ],
];
$Definition['AllianceBonus'] = [
    'As sitter you can`t contribute to alliance bonuses' => 'As sitter you can`t contribute to alliance bonuses.',
    'You have reached you daily contribution limit, Reset in %s' => 'You have reached you daily contribution limit. Reset in %s.',
    'Your contribution will be tripled' => 'Your contribution will be tripled',
    'Your active village was changed' => 'Your active village was changed',
    'Invalid resources entered' => 'Invalid resources entered',
    'Not enough are not available' => 'Not enough are not available',
    'The amount of gold could not be subtracted from your account' => 'The amount of gold could not be subtracted from your account',
    'Contribution: %s resources' => 'Contribution: %s resources',
    'Tripled: %s resources' => 'Tripled: %s resources',
    'Contribute' => 'Contribute',
    'Contribution failed:' => 'Contribution failed:',
    'You can`t contribute when next level is unlocking' => 'You can`t contribute when next level is unlocking',
    'Contribution limit for today is reached' => 'Contribution limit for today is reached',
    'Recruitment' => 'Recruitment',
    'Philosophy' => 'Philosophy',
    'Metallurgy' => 'Metallurgy',
    'Commerce' => 'Commerce',

    'training_upgrading' => 'Recruitment upgrading',
    'cp_upgrading' => 'Philosophy upgrading',
    'armor_upgrading' => 'Metallurgy upgrading',
    'trade_upgrading' => 'Commerce upgrading',

    'training_bonus_maxed' => 'Recruitment is at max level',
    'cp_bonus_maxed' => 'Philosophy is at max level',
    'armor_bonus_maxed' => 'Metallurgy is at max level',
    'trade_bonus_maxed' => 'Commerce is at max level',

    'Faster troop production bonus' => 'Faster troop production bonus',
    'Culture Points production bonus' => 'Culture Points production bonus',
    'Weapons and armor bonus' => 'Weapons and armor bonus',
    'Merchant capacity bonus' => 'Merchant capacity bonus',
    'Please select a bonus' => 'Please select a bonus.',
    'Sum:' => 'Sum:',
    'Contribute x3' => 'Contribute x3',
    'AllianceBonusDescription' => 'Teamwork is the key to success in the world of Travian. Contribute resources to get bonus rewards for the whole alliance and increase your advantage over other players. Since bonuses require large amounts of resources, the whole alliance needs to contribute to this cause.',
    'Contribute resources' => 'Contribute resources',
    'My daily contribution limit (reset in %s)' => 'My daily contribution limit (reset in %s)‎',
    'Amount of resources you can still contribute: %s' => 'Amount of resources you can still contribute: %s',
    'Contribution successful' => 'Contribution successful.',
    'Alliance bonus overview' => 'Alliance bonus overview',
    'Contributors of the Week' => 'Contributors of the Week',
    'Contributors of all Time' => 'Contributors of all Time',
    'NoColumn' => 'No.',
    'Player(s)' => 'Player(s)',
    'Resources' => 'Resources',
    'Amount of resources needed to reach next level: %s' => 'Amount of resources needed to reach next level: %s',
    'training_bonus_desc' => 'Sharing military insights can be substantial in winning a war. Advancements in siege engine development and well-schooled instructors will increase the size of your army faster.',
    'armor_bonus_desc' => 'For an empire to thrive you need more than just an army. Provide education in human sciences for your people to become pioneers in architecture and village planning. An influential culture will encourage foreign nations to accept your rule.',
    'cp_bonus_desc' => 'Throughout history, conflicts were determined by the same principle: You gotta have the bigger stick. Upgraded armor and enhanced weaponry will enable your soldiers to overpower their enemies.',
    'trade_bonus_desc' => 'A battle without resupplies is a battle lost. Packhorses and bigger carts facilitate your merchants to carry more resources to where they are needed most, be it the front or a comrade in need.',
    'training_bonus_upgrading' => 'Recruitment bonus is upgrading and will be available at %s',
    'armor_bonus_upgrading' => 'Philosophy bonus is upgrading and will be available at %s',
    'cp_bonus_upgrading' => 'Metallurgy bonus is upgrading and will be available at %s',
    'trade_bonus_upgrading' => 'Commerce bonus is upgrading and will be available at %s',
    'You joined the alliance less than 24:00 hours ago' => 'You joined the alliance less than 24:00 hours ago.',
    'You can still donate, but you may have to wait for the bonuses to unlock' => 'You can still donate, but you may have to wait for the bonuses to unlock.',
    'Bonus activation time: %s' => 'Bonus activation time: %s',
    'Alliance bonus level %s (+%s%%)' => 'Alliance bonus level %s (+%s%%)',
];
$Definition['WWChangeName'] = [
    'Name' => 'Name',
    'Wonder of the world name' => 'Wonder of the world name',
    'What do you want Wonder of the world name to be?' => 'What do you want Wonder of the world name to be?',
    'Can be changed until level 11' => 'Can be changed until level 11',
];


$Definition['TransferGold'] = [
    'title' => 'Transfer gold',
    'desc' => 'You can transfer gold from your account to other accounts.',
    'transfer_cost' => 'Transfer cost: %s%% of the gold',
    'only_bought' => '🔴 Only bought gold can be transferred.',
    'the_following_errors' => 'The following errors has occurred:',
    'available_gold' => 'Available gold',
    'gold_amount' => 'Gold amount',
    'target_player' => 'Target player',
    'cost' => 'Cost',
    'transfer' => 'Transfer',
    'InvalidGoldAmount' => 'Invalid gold amount',
    'YouDoNotHaveEnoughGold' => 'You don`t have enough gold',
    'TargetPlayerUnknown' => 'Target player unknown',
    'TargetPlayerNotFound' => 'Target player not found',
    'transfer_success_msg' => '%s <img src="img/x.gif" class="gold"> has been transferred to player %s',
    'recent_transfers' => 'Recent transfers',
    'player' => 'Player',
    'amount' => 'Amount',
    'date' => 'Date',
    'TransferMsg' => [
        'Subject' => 'Gold transfer complete',
        'Message' => "Hello %s,\n\n%s gold was transferred to your account from player %s.\n\nHappy farming.",
    ],
    'SenderEmailAddress' => 'Sender email address',
    'InvalidAccountEmail' => 'Sender email address is invalid.',
];


return $Definition;