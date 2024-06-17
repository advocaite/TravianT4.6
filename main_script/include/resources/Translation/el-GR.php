<?php
use Core\Config;
use Model\DailyQuestModel;
use Model\Quest;
global $Definition;

$Definition['403Error']['You cannot pass!'] = 'You cannot pass!';
$Definition['403Error']['I am a servant of the Secret Order, wielder of the flame of 403, You cannot pass'] = 'I am a servant of the Secret Order, wielder of the flame of 403. You cannot pass.';
//Academy
$Definition['Academy'] = [
    "zoomIn" => "μεγέθυνση",
    "Researches for village %s" => "Έρευνα μονάδας για το χωριό %s",
    "ResearchesForVillage" => "Έρευνες για το χωριό",
    "noResearchAvailableDesc" => "Κανένα νέο στράτευμα δεν μπορεί να ερευνηθεί προς το παρόν. Για να διαβάσεις τις απαιτήσεις για τα νέα στρατεύματα πάτησε στο μαύρο βιβλίο στην κάτω αριστερή γωνία.",
    "showMore" => "δείξε περισσότερα",
    "hideMore" => "δείξε λιγότερο",
    "Researching" => "Σε ανάπτυξη", "unit" => "Μονάδα",
    "research" => "Έρευνα",
    "one_research_is_going" => "Υπάρχει ήδη μια έρευνα που διεξάγεται.",
];

$Definition['ActivationNew'] = [
    'unableToGenerateBase' => 'We were unable to generate a new village for you. Please try again after a while or contact administrator.',
    'vidSelectDescription' => 'Οι μεγάλες αυτοκρατορίες ξεκινούν με σημαντικές αποφάσεις! Έχεις την επίθεση και τον ανταγωνισμό στο αίμα σου; Έχεις μάθει να κάνεις υπομονή για να επιτύχεις τους στόχους σου ή μήπως όχι; Είσαι παίκτης που διακατέχεται από ομαδικό πνεύμα και απολαμβάνει την ανάπτυξη μιας ακμάζουσας οικονομίας; ',
    'sectorSelectDescription' => 'Πού θέλεις να ξεκινήσεις την αυτοκρατορία σου; Αξιοποίησε τη συνιστώμενη περιοχή για την πιο ιδανική επιλογή. Εναλλακτικά, επίλεξε την περιοχή όπου βρίσκονται οι φίλοι σου και παίξε μαζί τους!',
    'recommendedForNewPlayers' => 'Συνιστάται για καινούργιους παίκτες',
    'Select your starting position' => 'Επίλεξε την αρχική σου θέση',
    'Select your tribe' => 'Επίλεξε την φυλή σου',
    'Confirm' => 'Επιβεβαίωση',
    '
    ' => 'πίσω',
    'New' => 'New',
    'RECOMMENDED' => 'ΣΥΝΙΣΤΑΤΑΙ',
    'Ready to rule the world?' => 'Είστε έτοιμος να κατακτήσετε τον κόσμο;',
    'PLAY NOW' => 'ΠΑΙΞΕ ΤΩΡΑ',
    'North - West' => 'Βόρεια - Δυτικά',
    'North - East' => 'Βόρεια - Ανατολικά',
    'South - West' => 'Νότια - Δυτικά',
    'South - East' => 'Νότια - Ανατολικά',
    'selectionComplete' => 'Η επιλογή σας ολοκληρώθηκε. Ένα μόνο κλικ έμεινε για αποδοχή της πρόκλησης!',
    "race1_attributes" => [
        0 => 'Μέτριες απαιτήσεις σε χρόνο',
        1 => 'Είναι εφικτή η ταχύτερη δυνατή ανάπτυξη χωριών',
        2 => 'Πολύ ισχυρά, αλλά ακριβά στρατεύματα',
        3 => 'Υψηλό επίπεδο δυσκολίας για αρχάριους παίκτες',
    ], 'race2_attributes' => [
        0 => 'Υψηλές απαιτήσεις σε χρόνο',
        1 => 'Καλή επιλογή για λαφυραγώγηση νωρίς στο παιχνίδι',
        2 => 'Ισχυρό, φτηνό πεζικό',
        3 => 'Για επιθετικούς παίκτες',
    ], "race3_attributes" => [
        0 => 'Χαμηλές απαιτήσεις σε χρόνο',
        1 => 'Προστασία από λαφυραγώγηση και καλή άμυνα',
        2 => 'Εξαιρετικό, ταχύ ιππικό',
        3 => 'Κατάλληλη επιλογή για αρχάριους παίκτες',
    ], "race6_attributes" => [
        0 => 'Χαμηλές απαιτήσεις σε χρόνο',
        1 => 'Περισσότεροι πόροι διαθέσιμοι',
        2 => 'Εξαιρετικές αμυντικές μονάδες',
        3 => 'Κατάλληλη επιλογή για αρχάριους παίκτες',
    ], "race7_attributes" => [
        0 => 'Υψηλές απαιτήσεις σε χρόνο',
        1 => 'Εντυπωσιακά ισχυρό ιππικό',
        2 => 'Εξαρτάται από άλλους για προστασία',
        3 => 'Δεν συνιστάται για νέους παίκτες!',
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
        1 => "Quintus", 2 => 'Henrik', 3 => 'Ambiorix',
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
    ], 'race2_attributes' => [
        0 => 'Sufficient time needed for offensive play',
        1 => 'Inexpensive troops may be produced fast,<br /> good at looting.',
        2 => 'For aggressive and experienced players.',
    ], "race3_attributes" => [
        0 => 'Low time requirements.',
        1 => 'Better loot protection and good defense available early on.',
        2 => 'Very good cavalry, fastest units in game.',
        3 => 'Good fit for new players.',
    ],
];
//Alliance
$Definition['Alliance']['Kicking/inviting is not allowed at this time'] = 'Η εκδίωξη / πρόσκληση δεν επιτρέπεται τη στιγμή αυτή.';
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
$Definition['Alliance']['Title'] = 'Τίτλος';
$Definition['Alliance']['URL'] = 'URL';
$Definition['Alliance']['Hint'] = 'Συμβουλή';
$Definition['Alliance']['Tip'] = 'Συμβουλή';
$Definition['Alliance']['confederacy with x'] = 'Συνομοσπονδία με %s';
$Definition['Alliance']['NAP with x'] = 'Σύμφωνο μη επίθεσης με %s';
$Definition['Alliance']['war with x'] = 'Πόλεμο με %s';
$Definition['Alliance']['accept'] = 'Αποδοχή';
$Definition['Alliance']['Select'] = 'Επιλογή';
$Definition['Alliance']['Confirm'] = 'Επιβεβαίωση';
$Definition['Alliance']['wrongPassword'] = 'Λάθος κωδικός';
$Definition['Alliance']['In order to kick the player you have to enter your password again for security reasons'] = 'Για να θέσετε εκτός συμμαχίας τον παίκτη, πρέπει να εισάγετε ξανά τον κωδικό πρόσβασης για λόγους ασφαλείας.';
$Definition['Alliance']['Password'] = 'Κωδικός';
$Definition['Alliance']['Cant kick player'] = 'Δεν μπορείτε να αποπέμψετε παίκτη.';
$Definition['Alliance']['InvitesAreClosed'] = 'Οι προσκλήσεις έχουν κλείσει.';
$Definition['Alliance']['There is already an offer'] = 'Υπάρχει ήδη μια προσφορά.';
$Definition['Alliance']['Alliance x does not exists'] = 'Η συμμαχία %s δεν υπάρχει.';
$Definition['Alliance']['offer a confederacy'] = 'Προσφορά συνασπισμού';
$Definition['Alliance']['offer a NAP'] = 'Προσφορά συμφώνου μη επίθεσης';
$Definition['Alliance']['declare war'] = 'Κήρυξη πολέμου';
$Definition['Alliance']['Own offers'] = 'Δικές μου προτάσεις';
$Definition['Alliance']['Foreign offers'] = 'Ξένες προτάσεις';
$Definition['Alliance']['Send'] = 'Αποστολή';
$Definition['Alliance']['DiplomacyShowText'] = '<div class="text">Αν επιθυμείς να εμφανίζονται οι διπλωματικές σου σχέσεις στην περιγραφή της συμμαχίας σου, πληκτρολόγησε [diplomatie] στην περιγραφή είναι διαθέσιμα επίσης ξεχωριστά [ally], [nap] και [war].</div>';
$Definition['Alliance']['DiplomacyHint'] = 'Θα ήταν διπλωματική ευγένεια να έχετε μιλήσει με την άλλη συμμαχία και να έχετε διαπραγματευτεί πριν προσφέρετε ένα σύμφωνο μη επίθεσης ή έναν συνασπισμό.';
$Definition['Alliance']['Existing relationships'] = 'Υπάρχουσες σχέσεις';
$Definition['Alliance']['The player x does`t exists'] = 'Ο παίκτης %s δεν υπάρχει.';
$Definition['Alliance']['none'] = 'καμία';
$Definition['Alliance']['draw back'] = 'Ανάκληση';
$Definition['Alliance']['invite sent to x'] = 'Έχει αποσταλεί πρόσκληση στον %s.';
$Definition['Alliance']['invitation for x'] = 'Πρόσκληση στον %s';
$Definition['Alliance']['test has already received an invitation'] = 'ο %s έχει ήδη παραλάβει πρόσκληση.';
$Definition['Alliance']['Invitations'] = 'Προσκλήσεις';
$Definition['Alliance']['invite'] = 'προσκάλεσε';
$Definition['Alliance']['toTheForum'] = 'Σὐνδεση στο Forum (Φόρουμ)';
$Definition['Alliance']['you just left your alliance'] = 'Μόλις εγκατέλειψες τη συμμαχία.';
$Definition['Alliance']['In order to quit the alliance you have to enter your password gain for safety reasons'] = 'Για να τερματίσετε τη συμμαχία πρέπει να καταχωρήσετε ξανά τον κωδικό πρόσβασης για λόγους ασφαλείας.';
$Definition['Alliance']['x has been kicked from the alliance'] = 'Ο παίκτης %s εκδιώχθηκε από τη συμμαχία.';
$Definition['Alliance']['If your alliance wants to use an external forum, you can enter the URL here'] = 'Εάν η συμμαχία θέλει να χρησιμοποιήσει εξωτερικό forum(φόρουμ), μπορείς να εισάγεις τη διεύθυνση εδώ.';
$Definition['Alliance']['choose player'] = 'Επιλέξτε παίκτη';
$Definition['Alliance']['Manage flags and markers in map'] = 'Διαχείριση σημαιών και μαρκαρισμάτων στον χάρτη';
$Definition['Alliance']['Manage forums'] = 'Διαχείριση forum (φόρουμ)';
$Definition['Alliance']['IGMs to every alliance member'] = 'Μήνυμα σε κάθε μέλος της συμμαχίας';
$Definition['Alliance']['You can set up different permissions for each alliance member and assign positions'] = 'Μπορείτε να δώσετε διαφορετικές άδειες για κάθε μέλος της συμμαχίας σας και να τους αναθέσετε θέσεις.';
$Definition['Alliance']['fighting points'] = 'πόντοι μάχης';
$Definition['Alliance']['Tag exists'] = 'Η συντομογραφία υπάρχει.';
$Definition['Alliance']['Changes saved'] = 'Οι αλλαγές αποθηκεύτηκαν';
$Definition['Alliance']['Date'] = 'Ημερομηνία';
$Definition['Alliance']['Don´t show attacks of own alliance (under 100 units, no losses)'] = 'Μην δείχνετε επιθέσεις από την συμμαχία μου (κάτω από 100 μονάδες, χωρίς απώλειες)';
$Definition['Alliance']['noReports'] = 'Δεν υπάρχουν αναφορές διαθέσιμες.';
$Definition['Alliance']['online now'] = 'now online';
$Definition['Alliance']['active players'] = 'Ενεργός πριν 10 λεπτά';
$Definition['Alliance']['active 3days'] = 'Ενεργός πριν 3 μέρες';
$Definition['Alliance']['active 7days'] = 'Ενεργός πριν 7 μέρες';
$Definition['Alliance']['inactive'] = 'ανενεργός';
$Definition['Alliance']['Rank'] = 'Κατάταξη:';
$Definition['Alliance']['Points'] = 'Βαθμοί:';
$Definition['Alliance']['Change name'] = 'Αλλαγή ονόματος';
$Definition['Alliance']['Change alliance description'] = 'Αλλαγή περιγραφής της συμμαχίας';
$Definition['Alliance']['Edit internal info page'] = 'Επεξεργαστείτε την εσωτερική σελίδα πληροφοριών';
$Definition['Alliance']['Assign to position'] = 'Ορισμός θέσης';
$Definition['Alliance']['Link to the forum'] = 'Σὐνδεση στο Forum (Φόρουμ)';
$Definition['Alliance']['Settings'] = 'Επιλογές';
$Definition['Alliance']['Actions'] = 'Ενέργειες';
$Definition['Alliance']['Invite a player into the alliance'] = 'Πρόσκληση παίκτη στη συμμαχία';
$Definition['Alliance']['Alliance diplomacy'] = 'Διπλωματία συμμαχίας';
$Definition['Alliance']['Quit alliance'] = 'Αποχώρηση από τη συμμαχία';
$Definition['Alliance']['Kick player'] = 'Αποπομπή παίκτη';
$Definition['Alliance']['Population'] = 'Πληθυσμός';
$Definition['Alliance']['Details'] = 'Λεπτομέρειες';
$Definition['Alliance']['Members'] = 'Μέλη';
$Definition['Alliance']['Position'] = 'Θέση';
$Definition['Alliance']['no thread created'] = 'Δεν έχουν δημιουργηθεί ακόμη θέματα.';
$Definition['Alliance']['This survey ends on x'] = 'Η ψηφοφορία αυτή τελειώνει %s.';
$Definition['Alliance']['voting finished'] = 'η ψηφοφορία ολοκληρώθηκε.';
$Definition['Alliance']['move topic'] = 'μετακίνηση θέματος';
$Definition['Alliance']['edit topic'] = 'επεξεργασία θεμάτων';
$Definition['Alliance']['x times edited, last edit by y'] = '%sx επεξεργασία, τελευταία από %s στις %s.';
$Definition['Alliance']['Player ID'] = 'ID παίκτη';
$Definition['Alliance']['user_list_headline'] = 'Ανοίξτε το φόρουμ για αυτούς τους παίκτες';
$Definition['Alliance']['answer(s)'] = 'Απαντήσεις';
$Definition['Alliance']['Last post'] = 'Τελευταία ανάρτηση';
$Definition['Alliance']['Posts:'] = 'Αναρτήσεις:';
$Definition['Alliance']['pop'] = 'pop';
$Definition['Alliance']['Villages'] = 'Χωριά';
$Definition['Alliance']['post reply'] = 'Απάντηση';
$Definition['Alliance']['created'] = 'δημιουργήθηκε';
$Definition['Alliance']['author'] = 'δημιουργός';
$Definition['Alliance']['messages'] = 'μηνύματα';
$Definition['Alliance']['reply'] = 'απάντηση';
$Definition['Alliance']['vote'] = 'ψήφος';
$Definition['Alliance']['to result'] = 'στο αποτέλεσμα';
$Definition['Alliance']['to survey'] = 'προς ψηφοφορία';
$Definition['Alliance']['name'] = 'Όνομα';
$Definition['Alliance']['addLine'] = 'Προσθέστε';
$Definition['Alliance']['New Thread'] = 'Νέο θέμα';
$Definition['Alliance']['Post new thread'] = 'Δημοσιεύστε νέο θέμα';
$Definition['Alliance']['Thread'] = 'Θέμα';
$Definition['Alliance']['Report'] = 'Αναφορά';
$Definition['Alliance']['Coordinates'] = 'Συντεταγμένες';
$Definition['Alliance']['report'] = 'αναφορα';
$Definition['Alliance']['Troops'] = 'στρατεύματα';
$Definition['Alliance']['Vote_options'] = 'Επιλογές ψηφοφορίας';
$Definition['Alliance']['Survey'] = 'Καταμέτρηση';
$Definition['Alliance']['ends on'] = 'Τελειώνει στις';
$Definition['Alliance']['open_topic'] = 'Ανοίξτε θέμα';
$Definition['Alliance']['close_topic'] = 'Κλείστε θέμα';
$Definition['Alliance']['stick_topic'] = 'Συνδέστε θέμα';
$Definition['Alliance']['unstick_topic'] = 'Αποσυνδέστε το θέμα';
$Definition['Alliance']['preview'] = 'προεπισκόπηση';
$Definition['Alliance']['underline'] = 'υπογράμμηση';
$Definition['Alliance']['Player'] = 'Παίκτης';
$Definition['Alliance']['Alliance ID'] = 'ID συμμαχίας';
$Definition['Alliance']['ally_list_headline'] = 'Άνοιγμα για άλλες συμμαχίες:';
$Definition['Alliance']['sitters_allowed'] = 'Επιτρέπεται για sitters';
$Definition['Alliance']['open forum for the following alliances'] = 'Ανοίξτε το φόρουμ για τις ακόλουθες συμμαχίες';
$Definition['Alliance']['edit forum'] = 'Επεξεργασία Φόρουμ (Forum)';
$Definition['Alliance']['create_in_area'] = 'Δημιουργήστε στην περιοχή';
$Definition['Alliance']['public_forum'] = 'Δημόσιο Φόρουμ (Forum)';
$Definition['Alliance']['forum_name'] = 'Ονομασία Φόρουμ (Forum)';
$Definition['Alliance']['new_forum'] = 'Νέο Φόρουμ (Forum)';
$Definition['Alliance']['desc'] = 'Περιγραφή';
$Definition['Alliance']['alliance_forum'] = 'Φόρουμ (forum) συμμαχίας';
$Definition['Alliance']['conf_forum'] = 'Φόρουμ (Forum) συνασπισμού';
$Definition['Alliance']['closed_forum'] = 'Κλειστό Φόρουμ (Forum)';
$Definition['Alliance']['Tag'] = 'Tag';
$Definition['Alliance']['Forum name'] = 'Ονομασία Φόρουμ (Forum)';
$Definition['Alliance']['Threads'] = 'Θέματα';
$Definition['Alliance']['Last post'] = 'Τελευταία αποστολή';
$Definition['Alliance']['to the top'] = 'Αρχή';
$Definition['Alliance']['to the bottom'] = 'προς τα κάτω';
$Definition['Alliance']['Delete'] = 'Διαγραφή';
$Definition['Alliance']['Confirm deletion?'] = 'Επιβεβαίωση διαγραφής;';
$Definition['Alliance']['show last post'] = 'Εμφάνιση τελευταίας ανάρτησης';
$Definition['Alliance']['edit'] = 'Επεξεργασία';
$Definition['Alliance']['thread without new entries'] = 'Θέμα χωρίς νέες καταχωρήσεις';
$Definition['Alliance']['thread with new entries'] = 'Θέμα με νέες καταχωρήσεις';
$Definition['Alliance']['noForum'] = 'Δεν έχει δημιουργηθεί φόρουμ (forum).';
$Definition['Alliance']['switch admin'] = 'αλλαγή διαχειριστή';
$Definition['Alliance']['switch non admin'] = 'αλλαγή μη διαχειριστή';
$Definition['Alliance']['set x as favor tab'] = 'Θέσε το  %s στα αγαπημένα';
$Definition['Alliance']['This tab is set as favourite'] = 'Επέλεξε αυτή την καρτέλα ως αγαπημένη καρτέλα';
$Definition['Alliance']['Overview'] = 'Επισκόπηση';
$Definition['Alliance']['NewForum'] = 'Νέο Φόρουμ (Forum)';
$Definition['Alliance']['Attacks'] = 'Επιθέσεις';
$Definition['Alliance']['Bonuses'] = 'Bonuses';
$Definition['Alliance']['Forum'] = 'Φόρουμ(Forum)';
$Definition['Alliance']['Options'] = 'Επιλογές';
$Definition['Alliance']['Profile'] = 'Προφίλ';
$Definition['Alliance']['Alliance'] = 'Συμμαχία';
$Definition['Alliance']['no Alliance'] = 'Καμία συμμαχία';
$Definition['Alliance']['You are currently not in an alliance In order to join an alliance, you need a level 1 Embassy and an invitation'] = 'Αυτή τη στιγμή δεν βρίσκεστε σε συμμαχία Για να συμμετάσχετε σε μια συμμαχία, χρειάζεστε μια Πρεσβεία 1ου επιπέδου και μια πρόσκληση.';
//Artefacts
$Definition['Artefacts']['numbers'] = [
    1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII',
    8 => 'VIII', 9 => 'IX', 10 => 'X',
];
$Definition['Artefacts'][2] = [
    'names' => [
        1 => 'Το μικρό μυστικό του αρχιτέκτονα %s',
        2 => 'Το μεγάλο μυστικό του αρχιτέκτονα %s',
        3 => 'Το μοναδικό μυστικό του αρχιτέκτονα',
    ],
    'desc' => 'Αυτό το πολύτιμο αντικείμενο δίνει στο χωριό σας προστασία ενάντια στους καταπέλτες και τους πολιορκητικούς κριούς. Κάνει τα κτίρια και τα τείχη να είναι <b>%s</b> ποιο σταθερά.',
];
$Definition['Artefacts'][4] = [
    'names' => [
        1 => 'Οι μικρές μπότες του Τιτάνα %s',
        2 => 'Οι μεγάλες μπότες του Τιτάνα %s',
        3 => 'Οι μοναδικές μπότες του Τιτάνα',
    ],
    'desc' => 'Αυτό το πολύτιμο αντικείμενο αυξάνει την ταχύτητα των στρατευμάτων σας κατά <b>%s</b> από την αρχική τους αξία.',
];
$Definition['Artefacts'][5] = [
    'names' => [
        1 => 'Τα μικρά μάτια του αετού %s',
        2 => 'Τα μεγάλα μάτια του αετού %s',
        3 => 'Τα μοναδικά μάτια των αετών',
    ],
    'desc' => 'Αυτό το πολύτιμο αντικείμενο κάνει τους ανιχνευτές σας <b>%s</b>‬ δυνατότερους από το φυσιολογικό. Επηρεάζονται όλοι οι ανιχνευτές μέσα στο χωριό καθώς και όλοι οι ανιχνευτές που στέλνονται για κατασκοπία από αυτό το χωριό. Επιπλέον μπορείτε να δείτε τον τύπο των στρατευμάτων που σας κάνει επίθεση από την Πλατεία συνέλευσης, αλλά όχι τον αριθμό των στρατευμάτων..',
];
$Definition['Artefacts'][6] = [
    'names' => [
        1 => 'Μικρός έλεγχος δίαιτας %s',
        2 => 'Μεγάλος έλεγχος δίαιτας %s',
        3 => 'Μοναδικός τρόπος δίαιτας',
    ],
    'desc' => 'Αυτό το πολύτιμο αντικείμενο μειώνει την κατανάλωση σιταριού των δικό σας στρατευμάτων καθώς και ενισχύσεων σε αυτό το χωριό στα <b>%s</b> από την αρχική του αξία.',
];
$Definition['Artefacts'][8] = [
    'names' => [
        1 => 'Το μικρό ταλέντο του εκπαιδευτή %s',
        2 => 'Το μεγάλο ταλέντο του εκπαιδευτή %s',
        3 => 'Το μοναδικό ταλέντο του εκπαιδευτή',
    ],
    'desc' => 'Αυτό το πολύτιμο αντικείμενο μειώνει την διάρκεια εκπαίδευσης στο Παλάτι, Μέγαρο, Εργαστήριο, Στάβλο και Στρατόπεδο στα <b>%s</b> από την αρχική του αξία.',
];
$Definition['Artefacts'][9] = [
    'names' => [
        1 => 'Το μικρό σχέδιο αποθήκευσης %s',
        2 => 'Το μεγάλο σχέδιο αποθήκευσης %s',
    ],
    'desc' => 'Αυτό το σχέδιο κατασκευής σας επιτρέπει να κτίσετε Μεγάλες Σιταποθήκες και Μεγάλες Αποθήκες. Το σχέδιο χρειάζεται και για να αναβαθμίσετε σε μεγαλύτερο επίπεδο τα κτήρια αυτά. Δεν υπάρχουν επιπλέον προϋποθέσεις γι αυτά τα κτήρια',
];
$Definition['Artefacts'][10] = [
    'names' => [
        1 => 'Η μικρή σύγχυση του αντιπάλου %s',
        2 => 'Η μεγάλη σύγχυση του αντιπάλου %s',
        3 => 'Η μοναδική σύγχυση του αντιπάλου',
    ], "desc" => nl2br("Αυτό το αντικείμενο αυξάνει την χωρητικότητα των κρυψώνων κατά <b>%s</b>.

Επιπλέον επίδραση: Οι καταπέλτες μπορούν να χτυπήσουν μόνο τυχαία στα χωριά που επηρεάζονται από την δύναμη του αντικειμένου. Εξαιρέσεις για το αντικείμενο χωριού και λογαριασμού αποτελούν το Παγκόσμιο Θαύμα και το Θησαυροφυλάκιο. Εξαίρεση για το μοναδικό αντικείμνο είναι μόνο το Παγκόσμιο Θαύμα."),
];
$Definition['Artefacts'][11] = [
    'names' => [
        1 => 'Αντικείμενο του μικρού ανόητου',
        3 => 'Αντικείμενο του μοναδικού ανόητου',
    ],//no desc for this one.
];
$Definition['Artefacts'][12] = [
    'name' => 'Σχέδια Κατασκευής των Παγκοσμίου Θαύματος',
    'desc' => 'Τα σχέδια κατασκευής ΠΘ είναι εξαιρετικά σημαντικά για να μπορέσετε να ξεκινήσετε το κτίσιμο ενός ΠΘ σε ένα χωριό ΠΘ. Ο παίκτης στον οποίο ανήκει το χωριό ΠΘ πρέπει να έχει πρώτος ένα σχέδια κατασκευής. Ένα μόνο σχέδιο θα επιτρέψει στον κάτοχο του χωριού ΠΘ να κτίσει ένα ΠΘ από το επίπεδο 0 έως το επίπεδο 49. Παρόλα αυτά, έτσι ώστε ένας παίκτης να μπορέσει να κτίσει ένα ΠΘ από το επίπεδο 49 έως το επίπεδο 100, ένας άλλος παίκτης μέσα από την συμμαχία του κατόχου του ΠΘ ΠΡΕΠΕΙ να κατέχει ένα δεύτερο σχέδιο ΠΘ. Αυτός μπορεί να είναι οποιοσδήποτε παίκτης μέσα στην συμμαχία',
    //no desc for this one.
];
//Auction
$Definition['Auction']['notEnoughGold'] = 'Δεν έχετε αρκετό χρυσό.';
$Definition['Auction']['autoCorrect'] = 'Αυτόματη διόρθωση.';
$Definition['Auction']['disabledSubmitTooltip'] = 'Δεν δόθηκε κάποιο ποσό χρυσού στο ανταλλακτήριο.';
$Definition['Auction']['disabledSubmitTooltip2'] = 'Χρειάζεται τουλάχιστον 200 ασήμι.';
$Definition['Auction']['enabledSubmitTooltip'] = 'Μετατροπή τώρα';
$Definition['Auction']['enabledSubmitTooltip2'] = 'Αντάλλαξε ασήμι σε χρυσό';
$Definition['Auction']['maxAmountTooltip'] = 'Αγορά χρυσού τώρα';
$Definition['Auction']['exchange'] = 'Μετατροπή';
$Definition['Auction']['Exchange'] = 'Μετατροπή';
$Definition['Auction']['silverExchange'] = 'Ανταλλακτήριο';
$Definition['Auction']['sitterError'] = 'Δεν μπορείτε να έχετε πρόσβαση εδώ, δεδομένου ότι είσαστε συνδεδεμένος σαν sitter.';
$Definition['Auction']['deletionError'] = 'Δεν μπορείτε να έχετε πρόσβαση εδώ, δεδομένου ότι ο λογαριασμός σας βρίσκεται σε διαδικασία διαγραφής.';
$Definition['Auction']['yes'] = 'ναι';
$Definition['Auction']['no'] = 'όχι';
$Definition['Auction']['Confirm sale:'] = 'Επιβεβαίωση πώλησης:';
$Definition['Auction']['You can only have x auctions at a time'] = 'Μπορείτε να έχετε μόνο %s πλειστηριασμούς κάθε φορά.';
$Definition['Auction']['10AdventuresError'] = 'Finish 10 adventures to unlock the auctions!';
$Definition['Auction']['Finish 10 adventures to unlock the auctions!'] = 'Ολοκλήρωσε 10 περιπέτειες για να ξεκλειδώσεις το γραφείο συναλλαγών!';
$Definition['Auction']['Choose an item to sell An auction can last up to x hours'] = 'Επέλεξε ένα αντικείμενο προς πώληση. Μια δημοπρασία μπορεί να διαρκέσει μέχρι %s ώρες.';
$Definition['Auction']['Finished auctions'] = 'Τελειωμένες δημοπρασίες';
$Definition['Auction']['AuctionNotFound'] = 'Δεν βρέθηκε η δημοπρασία.';
$Definition['Auction']['Really sell this item?'] = 'Σίγουρα θέλετε να πουλήσετε αυτό το αντικείμενο;';
$Definition['Auction']['Sell [AMOUNT] units?'] = 'Θα πουλήσετε [AMOUNT] μονάδες;';
$Definition['Auction']['Not enough items available for auction ([MIN_AMOUNT] items)'] = 'Δεν υπάρχουν αρκετά διαθέσιμα αντικείμενα για δημοπρασία ([MIN_AMOUNT] αντικείμενα)';
$Definition['Auction']['Do you want to sell this horse for 100 silver?'] = 'Θέλετε να πουλήσετε αυτό το άλογο για 100 ασήμια;';
$Definition['Auction']['You cannot sell your horse!'] = 'Δεν μπορείτε να πουλήσετε το άλογό σας!';
$Definition['Auction']['AuctionFinished'] = 'Η δημοπρασία ολοκληρώθηκε.';
$Definition['Auction']['notEnoughSilverAuctionError'] = 'Δεν έχετε αρκετό ασήμι. Σας χρειάζεται τουλάχιστον %s ασήμι!';
$Definition['Auction']['min'] = 'ελαχ.';
$Definition['Auction']['bidFor'] = 'Προσφορά για';
$Definition['Auction']['balanceSince'] = 'συμφωνίες τις τελευταίες 7 ημέρες';
$Definition['Auction']['cause'] = 'Λόγος';
$Definition['Auction']['date'] = 'Ημερομηνία';
$Definition['Auction']['showAccounting'] = 'Δείξε τη λογιστική ασημιού.';
$Definition['Auction']['hideAccounting'] = 'Κρύψε τη λογιστική ασημιού.';
$Definition['Auction']['noBooking'] = 'Δεν βρέθηκε τίποτα.';
$Definition['Auction']['Adventure'] = 'Από περιπέτεια';
$Definition['Auction']['sell x items of y'] = 'Πώληση %s μονάδων(ας) από %s';
$Definition['Auction']['buy x items of y'] = 'Αγόρα %s μονάδων(ας) από %s';
$Definition['Auction']['currentBid'] = 'Τρέχουσα προσφορά';
$Definition['Auction']['currentBidder'] = 'Υψηλότερος πλειοδότης';
$Definition['Auction']['notEnoughSilver'] = 'Δεν υπάρχει αρκετό ασήμι.';
$Definition['Auction']['desc'] = 'Περιγραφή';
$Definition['Auction']['clock'] = 'Χρόνος';
$Definition['Auction']['bid'] = 'Δημοπρασία';
$Definition['Auction']['noAuction'] = 'Δεν βρέθηκε η δημοπρασία.';
$Definition['Auction']['Change'] = 'Αλλαγή';
$Definition['Auction']['del'] = 'Διαγραφή';
$Definition['Auction']['select all'] = 'Επιλογή όλων';
$Definition['Auction']['won'] = 'κέρδισε';
$Definition['Auction']['outbid'] = 'μειοδότησε';
$Definition['Auction']['reserve'] = 'Κρατήσεις';
$Definition['Auction']['balance'] = 'Ισοζύγιο';
$Definition['Auction']['running'] = 'σε εξέλιξη';
$Definition['Auction']['x unit perItem'] = '%s ανά μονάδα';
$Definition['Auction']['buy'] = 'Αγόρασε';
$Definition['Auction']['sell'] = 'Πούλησε';
$Definition['Auction']['bids'] = 'Προσφορές';
$Definition['Auction']['doBid'] = 'Προσφορά';
$Definition['Auction']['accounting'] = 'Λογιστική ασημιού';
$Definition['Auction']['cancelled'] = 'ακυρώθηκε';
$Definition['Auction']['finished'] = 'τέλειωσε';
$Definition['Auction']['filterFor'] = 'Φίλτρο για';
$Definition['Auction']['silver'] = 'ασήμι';
$Definition['Auction']['helmet'] = 'κράνη';
$Definition['Auction']['body'] = 'αντικείμενα σώματος';
$Definition['Auction']['leftHand'] = 'αριστερόχειρα αντικείμενα';
$Definition['Auction']['rightHand'] = 'δεξιόχειρα αντικείμανα';
$Definition['Auction']['shoes'] = 'μπότες';
$Definition['Auction']['horse'] = 'άλογα';
$Definition['Auction']['cage'] = 'κλουβιά';
$Definition['Auction']['scroll'] = 'πάπυρους';
$Definition['Auction']['ointment'] = 'αλοιφές';
$Definition['Auction']['bandage25'] = 'μικρούς επιδέσμους';
$Definition['Auction']['bandage%s'] = 'επιδέσμους';
$Definition['Auction']['bucketOfWater'] = 'δοχεία';
$Definition['Auction']['bookOfWisdom'] = 'βιβλία της σοφίας';
$Definition['Auction']['lawTables'] = 'πινάκια του νόμου';
$Definition['Auction']['artWork'] = 'καλλιτεχνήματα';
//BBCode
$Definition['BBCode']['this player is registered at x'] = 'Αυτός ο παίκτης έκανε εγγραφή στις %s';
$Definition['BBCode']['this player is under protection to x'] = 'Ο παίκτης βρήσκετε υπό την προστασία νέου παίκτη μέχρι τις %s';
$Definition['BBCode']['x has refused a confederacy to y'] = '%s αρνήθηκε να συνασπιστεί με %s.';
$Definition['BBCode']['x has refused nap to y'] = '%s αρνήθηκε το σύμφωνο μη επίθεσης με %s.';
$Definition['BBCode']['x has refused war to y'] = '%s αρνήθηκε τον πόλεμο με %s.';
$Definition['BBCode']['confederacies with'] = 'συνομοσπονδία με';
$Definition['BBCode']['non-aggression pact(s) with'] = 'σύμφωνο μη επίθεσης με';
$Definition['BBCode']['at war(s) with'] = 'σε πόλεμο με';
$Definition['BBCode']['Forum'] = 'Φόρουμ';
$Definition['BBCode']['News'] = 'Νέα';
$Definition['BBCode']['Strength of own alliance'] = 'Η δύναμη της συμμαχίας σας';
$Definition['BBCode']['X kicked Y from Alliance'] = '%s αποβλήθηκε %s από τη συμμαχία';
$Definition['BBCode']['Fighting points (difference to yesterday)'] = 'Πόντοι μάχης (διαφορά με εχθές)';
$Definition['BBCode']['troops destroyed by alliance Ally'] = 'στρατεύματα που καταστράφηκαν από τη συμμαχία %s';
$Definition['BBCode']['resources stolen by alliance Ally'] = 'ύλες που κλάπηκαν από τη συμμαχία %s';
$Definition['BBCode']['troops destroyed of alliance Ally'] = 'στρατεύματα που καταστράφηκαν από τη συμμαχία %s';
$Definition['BBCode']['resources stolen of alliance Ally'] = 'ύλες που έχουν κλαπεί από τη συμμαχία %s';
$Definition['BBCode']['This alliance cannot be found'] = 'Αυτή η συμμαχία δεν μπορεί να βρεθεί';
$Definition['BBCode']['latest postings on forum'] = 'τελευταίες δημοσιεύσεις στο φόρουμ';
$Definition['BBCode']['Alliance Events'] = 'Γεγονότα συμμαχίας';
$Definition['BBCode']['X joined Alliance'] = '%s έχει προσχωρήσει στη συμμαχία.';
$Definition['BBCode']['X left Alliance'] = '%s αποχώρησε από τη συμμαχία';
$Definition['BBCode']['X created new village'] = '%s ίδρυσε νέο χωριό';
$Definition['BBCode']['X invited Y'] = '%s προσκάλεσε %s στη συμμαχία. ';
$Definition['BBCode']['x has offered a confederacy to y'] = '%s έχει προσφερθεί συνομοσπονδία %s';
$Definition['BBCode']['x has offered war to y'] = '%s κήρυξε πόλεμο %s';
$Definition['BBCode']['x has offered nap to y'] = '%s πρότεινε σύμφωνο μη επίθεσης %s';
$Definition['BBCode']['x has accepted a confederacy to y'] = '%s αποδέχτηκε την συνομοσπονδία με %s';
$Definition['BBCode']['x has accepted nap to y'] = '%s αποδέχτηκε το σύμφωνο μη επίθεσης με %s';
$Definition['BBCode']['x has accepted war to y'] = '%s αποδέχτηκε τον πόλεμο με %s';
$Definition['BBCode']['Losses compared to alliance'] = 'Απώλειες σε σύγκριση με τη συμμαχία %s';
$Definition['BBCode']['attack'] = 'Επίθεση';
$Definition['BBCode']['defense'] = 'Άμυνα';
//Buildings
$Definition['Buildings']['increase warehouse storage by level 20 storage value'] = 'αύξησε τον αποθηκευτικό του χώρο κατα μια αποθήκη στο επίπεδο 20';
$Definition['Buildings']['increase granny storage by level 20 storage value'] = 'αύξησε τον αποθηκευτικό του χώρο κατα μια σιταποθήκη στο επίπεδο 20';
$Definition['Buildings']['Alliance Founder'] = 'Ιδρυτής συμμαχίας';
$Definition['Buildings']['Alliance'] = 'Συμμαχία';
$Definition['Buildings']['to the alliance'] = 'Στην συμμαχία';
$Definition['Buildings']['Tag'] = 'Συντομογραφία';
$Definition['Buildings']['Name'] = 'Όνομα';
$Definition['Buildings']['FoundAlliance'] = 'Δημιουργία συμμαχίας';
$Definition['Buildings']['accept'] = 'αποδοχή';
$Definition['Buildings']['refuse'] = 'απόρρυψη';
$Definition['Buildings']['ww_change_name_desc'] = 'Όνομα Παγκοσμίου Θαύματος';
$Definition['Buildings']['allianceFull'] = 'Η συμμαχία έχει φτάσει στο μέγιστο όριο μελών.';
$Definition['Buildings']['Enter Tag'] = 'Δώστε συντομογραφία.';
$Definition['Buildings']['Tag exists'] = 'Η συντομογραφία υπάρχει ήδη.';
$Definition['Buildings']['Enter Name'] = 'Δώσε όνομα.';
$Definition['Buildings']['Join alliance'] = 'Συμμετέχω στη συμμαχία';
$Definition['Buildings']['There are no invitations available'] = 'Δεν υπάρχουν προσκλήσεις διαθέσιμες.';
$Definition['Buildings']['Buildings'] = 'Κτίζεται';
$Definition['Buildings']['onOffLevelSwitch'] = 'δείξε / κρύψε δείκτες αναβάθμισης';
$Definition['Buildings']['maxMasterBuilderReached'] = 'Ο αρχιμάστορας μπορεί να διαχειριστεί, το μέγιστο %s εντολές την κάθε φορά.';
$Definition['Buildings']['enoughResourcesAt'] = 'Αρκετές ύλες στις %s';
$Definition['Buildings']['constructBuilding'] = 'Κατασκευή κτιρίου';
$Definition['Buildings']['upgradeBuilding'] = 'Αναβάθμιση στο επίπεδο %s';
$Definition['Buildings']['waitLoop'] = 'Σε αναμονή';
$Definition['Buildings']['workersBusy'] = 'Οι εργάτες είναι ήδη απασχολημένοι.';
$Definition['Buildings']['enoughResourcesAtNever'] = 'Η παραγωγή σιταριού στο χωριό σας είναι αρνητική. Έτσι δεν θα μπορείτε να έχετε αρκετούς πόρους ποτέ.';
$Definition['Buildings']['(not possible)'] = '(αδύνατον)';
$Definition['Buildings']['finishNow']['finishNow'] = 'Άμεση ολοκλήρωση κατασκευής';

$Definition['Buildings']['mainBuilding']['Demolish building'] = 'Κατεδάφιση κτιρίου';
$Definition['Buildings']['mainBuilding']['demolish_desc'] = 'Εάν δεν χρειάζεσαι άλλο ένα κτίριο μπορείς, να διατάξεις τους μάστορες σου να το κατεδαφίσουν κομμάτι με κομμάτι';
$Definition['Buildings']['mainBuilding']['demolish'] = 'Κατεδάφιση';
$Definition['Buildings']['mainBuilding']['Demolish completely'] = 'Ολοκληρωτική Κατεδάφιση';
$Definition['Buildings']['mainBuilding']['complete_demolish_title'] = 'Άμεση κατεδάφιση του συγκεκριμένου κτηρίου; Θα αφαιρεθεί από το χωριό σου.';

$Definition['Buildings']['buildingQueue']['buildingQueue'] = 'buildingQueue';
$Definition['Buildings']['buildingQueue']['name'] = 'Travian PLUS';
$Definition['Buildings']['buildingQueue']['desc'] = 'Το Travian PLUS σου επιτρέπει να βάλεις στην σειρά μια ακόμα εργασία κατασκευής.';

$Definition['Buildings']['newBuilding']['Infrastructure'] = 'Υποδομή';
$Definition['Buildings']['newBuilding']['Military'] = 'Στρατός';
$Definition['Buildings']['newBuilding']['Resources'] = 'Ύλες';
$Definition['Buildings']['Infrastructure'] = 'Υποδομή';
$Definition['Buildings']['Military'] = 'Στρατός';
$Definition['Buildings']['resources'] = 'Ύλες';
$Definition['Buildings']['costsForUpgradeToLvl'] = '<b>Δαπάνες</b> για αναβάθμιση στο επίπεδο %s';
$Definition['Buildings']['costs'] = 'Δαπάνες';
$Definition['Buildings']['errors']['foodShortage'] = 'Έλλειψη τροφής.';
$Definition['Buildings']['errors']['upgradeWareHouse'] = 'Αναβαθμίστε την αποθήκη.';
$Definition['Buildings']['errors']['upgradeGranny'] = 'Αναβαθμίστε την σιταποθήκη.';
$Definition['Buildings']['errors']['constructWarehouse'] = 'Κατασκευάστε μια αποθήκη.';
$Definition['Buildings']['errors']['constructGranny'] = 'Κατασκευάστε μια σιταποθήκη.';
$Definition['Buildings']['errors']['noGreatArtefact'] = 'Για την αναβάθμιση αυτού του κτιρίου απαιτούνται σχέδια κατασκευής.';
$Definition['Buildings']['errors']['wwPlans'] = 'Τα Παγκόσμια θαύματα μπορούν να ανεγερθούν μόνο σε ένα από τα παλιά χωριά του Ναταρίων. Ωστόσο, απαιτείται επίσης ένα σχέδιο κατασκευής. Φτάνοντας μέχρι το επίπεδο 50, απαιτείται συμπληρωματικό σχέδιο για την ολοκλήρωσή του. Το δεύτερο σχέδιο πρέπει να ανήκει σε άλλο παίκτη στην ίδια συμμαχία.';
$Definition['Buildings']['construct_with_master_builder'] = 'Κατασκευή με τον αρχιμάστορα';
$Definition['Buildings']['constructNewBuilding'] = 'Κατασκευή νέου κτηρίου';
$Definition['Buildings']['preRequests'] = 'Προϋποθέσεις';
$Definition['Buildings']['no_building_available'] = 'Δεν μπορούν να κατασκευαστούν κτίρια αυτήν την στιγμή.';
$Definition['Buildings']['soon_available'] = 'Σύντομα διαθέσιμα κτίρια';
$Definition['Buildings']['level'] = 'Επίπεδο';
$Definition['Buildings']['upgradeNotices']['reachedMaxLvL'] = 'έφτασε στο μέγιστο επίπεδο.';
$Definition['Buildings']['upgradeNotices']['buildingIsOnDemolition'] = 'Αυτό το κτίριο βρίσκεται υπό κατεδάφιση.';
$Definition['Buildings']['upgradeNotices']['upCostsToLevel'] = 'Κόστος χτισίματος κτιρίου στο επίπεδο';
$Definition['Buildings']['upgradeNotices']['currentlyUpgradingToLevel'] = 'Κατασκευή στο επίπεδο %s';
$Definition['Buildings']['upgradeNotices']['currentlyReachingMaxLevel'] = '%s έφτασε στο ανώτερο επίπεδο.';
$Definition['Buildings']['masterBuilder']['masterBuilder'] = 'Αρχιμάστορας';
$Definition['Buildings']['masterBuilder']['atStartOfConstruction'] = 'με την έναρξη της κατασκευής';
$Definition['Buildings']['buildingSites']['rallyPoint'] = 'Περιοχή χτισίματος πλατείας αθλημάτων';
$Definition['Buildings']['buildingSites']['building'] = 'Περιοχή κατασκευής κτηρίου';
$Definition['Buildings']['buildingSites']['WorldWonder'] = 'Περιοχή χτισίματος ΠΘ';

$Definition['Buildings'][1]['title'] = 'Ξυλοκόπος';
$Definition['Buildings'][1]['desc'] = 'Ο ξυλοκόπος κόβει δέντρα για να παραχθεί ξυλεία. Όσο μεγαλύτερο επίπεδο έχει ο ξυλοκόπος, τόσο περισσότερη ξυλεία παράγει.';
$Definition['Buildings'][1]['current_prod'] = 'Τρέχουσα παραγωγή';
$Definition['Buildings'][1]['next_prod'] = 'Παραγωγή στο επίπεδο';
$Definition['Buildings'][1]['unit'] = 'την ώρα';

$Definition['Buildings'][2]['title'] = 'Ορυχείο πηλού';
$Definition['Buildings'][2]['desc'] = 'Εδώ παράγεται ο πηλός. Με την αύξηση επιπέδου του ορυχείου αυξάνετε και την παραγωγή πηλού.';
$Definition['Buildings'][2]['current_prod'] = 'Τρέχουσα παραγωγή';
$Definition['Buildings'][2]['next_prod'] = 'Παραγωγή στο επίπεδο';
$Definition['Buildings'][2]['unit'] = 'την ώρα';

$Definition['Buildings'][3]['title'] = 'Ορυχείο σιδήρου';
$Definition['Buildings'][3]['desc'] = 'Από τα ορυχεία σιδήρου οι ανθρακωρύχοι βγάζουν τον πολύτιμο σίδηρο. Όσο ανεβαίνει το επίπεδο του ορυχείου σιδήρου τόσο αυξάνεται και η παραγωγή σιδήρου.';
$Definition['Buildings'][3]['current_prod'] = 'Τρέχουσα παραγωγή';
$Definition['Buildings'][3]['next_prod'] = 'Παραγωγή στο επίπεδο';
$Definition['Buildings'][3]['unit'] = 'την ώρα';

$Definition['Buildings'][4]['title'] = 'Χωράφι σιταριού';
$Definition['Buildings'][4]['desc'] = 'Στο χωράφι σιταριού παράγονται τρόφιμα για τον πληθυσμό σου. Με την αναβάθμιση επιπέδου του αγροκτήματος σιταριού αυξάνετε και την παραγωγή σιταριού.';
$Definition['Buildings'][4]['current_prod'] = 'Τρέχουσα παραγωγή';
$Definition['Buildings'][4]['next_prod'] = 'Παραγωγή στο επίπεδο';
$Definition['Buildings'][4]['unit'] = 'την ώρα';

$Definition['Buildings'][5]['title'] = 'Πριονιστήριο';
$Definition['Buildings'][5]['desc'] = 'Εδώ το ξύλο που παραδίδεται από τους ξυλοκόπους σου υποβάλλεται σε επεξεργασία. Με βάση το επίπεδο του πριονιστηρίου σου μπορεί να αυξηθεί η παραγωγή ξυλείας μέχρι και 25 τοις εκατό.';
$Definition['Buildings'][5]['current_prod'] = 'Τρέχουσα αύξηση στην παραγωγή';
$Definition['Buildings'][5]['next_prod'] = 'Αύξηση στο επίπεδο';
$Definition['Buildings'][5]['unit'] = 'τοις εκατό';

$Definition['Buildings'][6]['title'] = 'Πηλοποιείο';
$Definition['Buildings'][6]['desc'] = 'Εδώ ο πηλός υποβάλλεται με επεξεργασία και παρἀγοντε τούβλα. Με βάση το επίπεδο του φούρνου πηλού μπορεί να αυξηθεί η παραγωγή πηλού μέχρι 25 τοις εκατό.';
$Definition['Buildings'][6]['current_prod'] = 'Τρέχουσα αύξηση στην παραγωγή';
$Definition['Buildings'][6]['next_prod'] = 'Αύξηση στο επίπεδο';
$Definition['Buildings'][6]['unit'] = 'τοις εκατό';

$Definition['Buildings'][7]['title'] = 'Χυτήριο σιδήρου';
$Definition['Buildings'][7]['desc'] = 'Στο χυτήριο σιδήρου ο σίδηρος βελτιώνεται. Ανάλογα με το επίπεδό του η παραγωγή του σιδήρου αυξάνεται μέχρι 25 τοις εκατό.';
$Definition['Buildings'][7]['current_prod'] = 'Τρέχουσα αύξηση στην παραγωγή';
$Definition['Buildings'][7]['next_prod'] = 'Αύξηση στο επίπεδο';
$Definition['Buildings'][7]['unit'] = 'τοις εκατό';

$Definition['Buildings'][8]['title'] = 'Μύλος σιταριού';
$Definition['Buildings'][8]['desc'] = 'Στο μύλο το σιτάρι αλέθεται σε αλεύρι. Ανάλογα με το επίπεδο του μύλου σιταριού, η παραγωγή σιταριού αυξάνεται μέχρι 25 τοις εκατό.';
$Definition['Buildings'][8]['current_prod'] = 'Τρέχουσα αύξηση στην παραγωγή';
$Definition['Buildings'][8]['next_prod'] = 'Αύξηση στο επίπεδο';
$Definition['Buildings'][8]['unit'] = 'τοις εκατό';

$Definition['Buildings'][9]['title'] = 'Αρτοποιείο';
$Definition['Buildings'][9]['desc'] = 'Εδώ το αλεύρι που παράγεται στο μύλο χρησιμοποιείται στο φούρνο για να ψηθεί το ψωμί. Επιπλέον η παραγωγή σιταριού μαζί με τον μύλο σιταριού, αυξάνεται μέχρι και 50 τοις εκατό.';
$Definition['Buildings'][9]['current_prod'] = 'Τρέχουσα αύξηση στην παραγωγή';
$Definition['Buildings'][9]['next_prod'] = 'Αύξηση στο επίπεδο';
$Definition['Buildings'][9]['unit'] = 'τοις εκατό';

$Definition['Buildings'][10]['title'] = 'Αποθήκη πρώτων υλών';
$Definition['Buildings'][10]['desc'] = 'Στην αποθήκη πρώτων υλών μπορούν να αποθηκευτούν τα ξύλα, ο πηλός και ο σίδηρος. Με την αύξηση του επιπέδου του κτιρίου αυξάνεται την χωρητικότητά του.';
$Definition['Buildings'][10]['current_prod'] = 'Τρέχουσα χωρητικότητα';
$Definition['Buildings'][10]['next_prod'] = 'Χωρητικότητα στο επίπεδο';
$Definition['Buildings'][10]['unit'] = 'πρώτες ύλες';

$Definition['Buildings'][11]['title'] = 'Σιταποθήκη';
$Definition['Buildings'][11]['desc'] = 'Στην σιταποθήκη αποθηκεύεται το σιτάρι που παράγεται από τα αγροκτήματά σου. Αυξάνοντας το επίπεδο της σιταποθήκης, αυξάνεται η ικανότητα αποθήκευσης σιταριού.';
$Definition['Buildings'][11]['current_prod'] = 'Τρέχουσα χωρητικότητα';
$Definition['Buildings'][11]['next_prod'] = 'Χωρητικότητα στο επίπεδο';
$Definition['Buildings'][11]['unit'] = 'πρώτες ύλες';

$Definition['Buildings'][13]['title'] = 'Σιδηρουργείο';
$Definition['Buildings'][13]['desc'] = 'Το σιδηρουργείο βελτιώνει τα όπλα και τις πανοπλίες των στρατευμάτων σας. Αυξάνοντας το επίπεδο του, μπορείτε να παραγγείλετε καλύτερα υλικά για τα όπλα και τις πανοπλίες σας.';

$Definition['Buildings'][14]['title'] = 'Πλατεία αθλημάτων';
$Definition['Buildings'][14]['desc'] = 'Στην πλατεία αθλημάτων τα στρατεύματά σου βελτιώνουν την αντοχή τους. Όσο υψηλότερο το επίπεδο του κτιρίου τόσο πιο γρήγορα είναι τα στρατεύματά σου σε αποστάσεις άνω των 20 τετραγώνων';
$Definition['Buildings'][14]['current_prod'] = 'Τρέχουσα ταχύτητα';
$Definition['Buildings'][14]['next_prod'] = 'Ταχύτητα στο επίπεδο';
$Definition['Buildings'][14]['unit'] = 'τοις εκατό';

$Definition['Buildings'][15]['title'] = 'Κεντρικό κτίριο';
$Definition['Buildings'][15]['desc'] = 'Το κεντρικό κτίριο είναι το σπίτι των μαστόρων του χωριού. Όσο υψηλότερο το επίπεδό του, τόσο γρηγορότερα οι μάστορες ολοκληρώνουν τις κατασκευές των κτιρίων.';
$Definition['Buildings'][15]['current_prod'] = 'Τρέχον χρόνος κτισίματος';
$Definition['Buildings'][15]['next_prod'] = 'Χρόνος κτισίματος στο επίπεδο';
$Definition['Buildings'][15]['unit'] = 'τοις εκατό';

$Definition['Buildings'][16]['title'] = 'Πλατεία συγκεντρώσεως';
$Definition['Buildings'][16]['desc'] = 'Τα στρατεύματα του χωριού συναντιούνται στην πλατεία συγκεντρώσεως. Από εδώ μπορούν να σταλούν έξω για να κατακτήσουν, να επιτεθούν ή να ενισχύσουν άλλα χωριά. Αν υπάρχουν λιγότερες επιθετικές μονάδες, από το επίπεδο της πλατείας συγκέντρωσης, μπορείς να δεις τον τύπο των στρατευμάτων';

$Definition['Buildings'][17]['title'] = 'Αγορά';
$Definition['Buildings'][17]['desc'] = 'Στην αγορά μπορείς να ανταλλάξεις με άλλους παίκτες τις πρώτες ύλες σου. Όσο υψηλότερο το επίπεδο της αγοράς, τόσο περισσότερες πρώτες ύλες μπορούν να μεταφερθούν την ίδια χρονική στιγμή.';

$Definition['Buildings'][18]['title'] = 'Πρεσβεία';
$Definition['Buildings'][18]['desc'] = 'Η πρεσβεία είναι ένα μέρος για τους διπλωμάτες. Όσο υψηλότερο το επίπεδό της πρεσβείας τόσο πιο πολλές διπλωματικές επιλογές έχει ο βασιλιάς.';

$Definition['Buildings'][19]['title'] = 'Στρατόπεδο';
$Definition['Buildings'][19]['desc'] = 'Στο στρατόπεδο μπορεί να εκπαιδευθεί όλο το πεζικό. Όσο υψηλότερο το επίπεδό του στρατοπέδου τόσο γρηγορότερα μπορούν να εκπαιδευτούν τα στρατεύματα.';

$Definition['Buildings'][20]['title'] = 'Στάβλος';
$Definition['Buildings'][20]['desc'] = 'Στο στάβλο μπορεί να εκπαιδευτεί το ιππικό. Όσο υψηλότερο το επίπεδο του στάβλου τόσο γρηγορότερα εκπαιδεύονται τα στρατεύματα.';

$Definition['Buildings'][21]['title'] = 'Εργαστήριο';
$Definition['Buildings'][21]['desc'] = 'Στο εργαστήριο μπορούν να κατασκευαστούν πολιορκητικές μηχανές όπως καταπέλτες και πολιορκητικοί κριοί. Όσο υψηλότερο το επίπεδο του εργαστηρίου τόσο γρηγορότερα μπορούν να παράγονται οι μονάδες.';

$Definition['Buildings'][22]['title'] = 'Ακαδημία';
$Definition['Buildings'][22]['desc'] = 'Στην ακαδημία μπορούν να ερευνηθούν νέοι τύποι μονάδων. Με την αύξηση του επιπέδου της ακαδημίας μπορείς να διατάξεις την έρευνα καλύτερων μονάδων. <br><br> Αφού ερευνήσετε τις μονάδες σας στην ακαδημία, μπορείτε να τις εκπαιδεύσετε σε αυτό το χωριό.';

$Definition['Buildings'][23]['title'] = 'Κρυψώνα';
$Definition['Buildings'][23]['desc'] = 'Η κρυψώνα έχει σαν σκοπό να κρύβει ένα ποσοστό των πρώτων υλών που έχεις στις αποθήκες σου όταν δέχεσαι επίθεση. Αυτές οι πρώτες ύλες δεν μπορούν να κλαπούν.';
$Definition['Buildings'][23]['current_prod'] = 'Μονάδες ανά ύλη που κρύβονται από αυτήν την κρυψώνα';
$Definition['Buildings'][23]['next_prod'] = 'Χωρητικότητα στο επίπεδο';
$Definition['Buildings'][23]['overall_storage'] = 'Μονάδες ανά ύλη που κρύβονται από όλες τις κρυψώνες σας';
$Definition['Buildings'][23]['unit'] = 'Μονάδες';

$Definition['Buildings'][24]['title'] = 'Δημαρχείο';
$Definition['Buildings'][24]['desc'] = 'Στο δημαρχείο μπορείς να οργανώσεις θεαματικούς εορτασμούς για τους πολίτες σου. Οι πόντοι πολιτισμού αυξάνονται με έναν τέτοιο εορτασμό.';

$Definition['Buildings'][25]['title'] = 'Μἐγαρο';
$Definition['Buildings'][25]['desc'] = 'Το Μέγαρο προστατεύει το χωριό από επιθέσεις κατάκτησης των εχθρών. Μπορείτε να κτίσετε ένα Μέγαρο ανά χωριό. Άποικοι και Γερουσιαστές μπροούν να εκπαιδευτούν εδώ.';

$Definition['Buildings'][26]['title'] = 'Παλάτι';
$Definition['Buildings'][26]['desc'] = 'Το Παλάτι είναι ένα μοναδικό κτήριο. Μπορείτε να έχετε μόνο ένα σε όλο το βασίλειό σας και μπορείτε να δηλώσετε αυτό το χωριό σαν πρωτεύουσα. Άποικοι και Γερουσιαστές μπορούν να εκπαιδευτούν εδώ.';

$Definition['Buildings'][27]['title'] = 'Θησαυροφυλάκιο';
$Definition['Buildings'][27]['desc'] = 'Τα πλούτη της αυτοκρατορίας σου αποθηκεύονται στο θησαυροφυλάκιο. Το Θησαυροφυλάκιο έχει χώρο για ένα θησαυρό. Αφού κατακτήσετε ένα πολύτιμο αντικείμενο, θα χρειαστούν 24 ώρες για να ενεργοποιηθεί σε κανονικής ταχύτητας server και 12 ώρες σε 3x ταχύτητας server.';

$Definition['Buildings'][28]['title'] = 'Εμπορικό γραφείο';
$Definition['Buildings'][28]['desc'] = 'Στο εμπορικό γραφείο τα κάρα των εμπόρων βελτιώνονται και εξοπλίζονται με γρήγορα άλογα. Όσο υψηλότερο το επίπεδο του εμπορικού γραφείου τόσο περισσότερες πρώτες ὐλες μπορούν και μεταφέρουν οι έμποροι σου.';
$Definition['Buildings'][28]['current_prod'] = 'Τρέχουσα ικανότητα μεταφοράς';
$Definition['Buildings'][28]['next_prod'] = 'Ικανότητα μεταφοράς στο επίπεδο';
$Definition['Buildings'][28]['unit'] = 'πρώτες ύλες';

$Definition['Buildings'][29]['title'] = 'Μεγάλο στρατόπεδο';
$Definition['Buildings'][29]['desc'] = 'Το μεγάλο στρατόπεδο επιτρέπει την παραγωγή περισσότερων μονάδων παράλληλα με το στρατόπεδο αλλά με το τριπλάσιο κόστος παραγωγής. ';

$Definition['Buildings'][30]['title'] = 'Μεγάλος στάβλος';
$Definition['Buildings'][30]['desc'] = 'Ο μεγάλος στάβλος επιτρέπει την παραγωγή περισσότερων μονάδων ιππικού παράλληλα με τον στάβλο αλλά με το τριπλάσιο κόστος παραγωγής.';

$Definition['Buildings'][31]['title'] = 'Τείχος Πόλεως';
$Definition['Buildings'][31]['desc'] = 'Χτίζοντας ένα τείχος πόλεως προστατεύεις το χωριό σου από τους εχθρούς. Για κάθε επίπεδο που ανεβάζεις το τείχος σου τόσο μεγαλύτερο αμυντικό πλεονέκτημα έχουν οι αμυντικές σου δυνάμεις.';
$Definition['Buildings'][31]['current_prod'] = 'Τρέχον αμυντικό επίδομα';
$Definition['Buildings'][31]['next_prod'] = 'Αμυντικό επίδομα στο επίπεδο';
$Definition['Buildings'][31]['unit'] = 'τοις εκατό';

$Definition['Buildings'][32]['title'] = 'Χωματένιο Τεἰχος';
$Definition['Buildings'][32]['desc'] = 'Χτίζοντας ένα χωμάτινο τεἰχος προστατεύεις το χωριό σου από επιθέσεις. Όσο αναπτύσσεται το τεἰχος με πασσάλους, τόσο μεγαλύτερη αμυντικό πλεονέκτημα θα λαμβάνουν τα αμυντικά σου στρατεύματα μέσα στο χωριό';
$Definition['Buildings'][32]['current_prod'] = 'Τρέχον αμυντικό επίδομα';
$Definition['Buildings'][32]['next_prod'] = 'Αμυντικό επίδομα στο επίπεδο';
$Definition['Buildings'][32]['unit'] = 'τοις εκατό';

$Definition['Buildings'][33]['title'] = 'Τεἰχος με πἀσαλους';
$Definition['Buildings'][33]['desc'] = 'Χτίζοντας ένα τεἰχος με πασσάλους προστατεύεις το χωριό σου από επιθέσεις. Όσο αναπτύσσεται το τεἰχος με πασσάλους, τόσο μεγαλύτερη αμυντικό πλεονέκτημα θα λαμβάνουν τα αμυντικά σου στρατεύματα μέσα στο χωριό';
$Definition['Buildings'][33]['current_prod'] = 'Τρέχον αμυντικό επίδομα';
$Definition['Buildings'][33]['next_prod'] = 'Αμυντικό επίδομα στο επίπεδο';
$Definition['Buildings'][33]['unit'] = 'τοις εκατό';

$Definition['Buildings'][34]['title'] = 'Λιθοδὀμος';
$Definition['Buildings'][34]['desc'] = 'Ο λιθοδὀμος είναι ένας έμπειρος εργάτης στην επεξεργασία της πέτρας.Όσο υψηλότερα επεκτείνεται το κτίριο τόσο πιο σταθερά γίνονται τα κτίρια του χωριού. Το μπόνους δίνεται σε όλα τα κτίρια, ανεξάρτητα αν είναι πεδία υλών, κτίρια ή το τείχος.';
$Definition['Buildings'][34]['current_prod'] = 'Τρέχουσα σταθερότητα';
$Definition['Buildings'][34]['next_prod'] = 'Σταθερότητα στο επίπεδο';
$Definition['Buildings'][34]['unit'] = 'τοις εκατό';

$Definition['Buildings'][35]['title'] = 'Ζυθοποιείο';
$Definition['Buildings'][35]['desc'] = 'Νόστιμη μπύρα ετοιμάζεται στο ζυθοποιείο και μετά καταναλώνεται από τους στρατιώτες κατά την διάρκεια των εορτών. <br><br> Αυτά τα ποτά κάνουν τους στρατιώτες σας γενναιότερους και δυνατότερους στις μάχες (1% ανά επίπεδο). Δυστυχώς, η δύναμη των φύλαρχων μειώνεται και οι καταπέλτες χτυπούν μόνο τυχαία. <br><br> Μπορεί να κτιστεί μόνο από Τεύτονες και μόνο στις πρωτεύουσές τους. Επηρεάζει όλη την αυτοκρατορία.';

$Definition['Buildings'][36]['title'] = 'Τοποθέτης παγίδων';
$Definition['Buildings'][36]['desc'] = 'Το άτομο που στήνει παγίδες προστατεύει το χωριό σου με τις καλά κρυμμένες παγίδες. Κατά συνέπεια οι απρόσεκτοι εχθροί μπορούν να φυλακιστούν και δεν θα είναι σε θέση να βλάψουν το χωριό σου άλλο.';
$Definition['Buildings'][36]['current_prod'] = 'Τρέχον αριθμός προς κατασκευή';
$Definition['Buildings'][36]['next_prod'] = 'Αριθμός παγίδων στο επίπεδο';
$Definition['Buildings'][36]['unit'] = 'Παγίδες';
$Definition['Buildings'][36]['overall_storage'] = 'Συνολικός μέγιστος αριθμός';

$Definition['Buildings'][37]['title'] = 'Περιοχή ηρώων';
$Definition['Buildings'][37]['desc'] = 'Στην περιοχή ηρώων μπορείτε να έχετε μια επισκόπηση των γύρο οάσεων. Αρχίζοντας από το κτίριο επίπεδο 10, μπορείτε να κατακτήσετε οάσεις με τον ήρωά σας και να αυξήσετε την παραγωγή υλών του χωριού σας.';

$Definition['Buildings'][38]['title'] = 'Μεγάλη αποθήκη';
$Definition['Buildings'][38]['desc'] = 'Στην αποθήκη πρώτων υλών το ξύλο, ο πηλός και ο σίδηρος αποθηκεύονται. Η μεγάλη αποθήκη πρώτων υλών σας προσφέρει περισσότερο χώρο για να κρατήσει τους πόρους σας ξηρούς και ασφαλείς όπως και η κανονική.</br>
Το κτίριο μπορεί να κτιστεί μόνο σε παλιά χωριά Νατάριων ή με την χρήση ειδικών αντικειμένων από τους Νατάριους.';
$Definition['Buildings'][38]['current_prod'] = 'Τρέχουσα χωρητικότητα';
$Definition['Buildings'][38]['next_prod'] = 'Χωρητικότητα στο επίπεδο';
$Definition['Buildings'][38]['unit'] = 'πρώτες ύλες';

$Definition['Buildings'][39]['title'] = 'Μεγάλη σιταποθήκη';
$Definition['Buildings'][39]['desc'] = 'Στην Μεγάλη Σιταποθήκη, μπορείτε να αποθηκεύσετε 3 φορές περισσότερο σιτάρι από την κανονική.';
$Definition['Buildings'][39]['current_prod'] = 'Τρέχουσα χωρητικότητα';
$Definition['Buildings'][39]['next_prod'] = 'Χωρητικότητα στο επίπεδο';
$Definition['Buildings'][39]['unit'] = 'πρώτες ύλες';

$Definition['Buildings'][40]['title'] = 'Παγκόσμιο Θαύμα';
$Definition['Buildings'][40]['desc'] = 'Το Παγκόσμιο Θαύμα είναι το στέμμα του πολιτισμού. Μόνο οι πιο δυνατοί και πλουσιότεροι είναι σε θέση να οικοδομήσουν ένα τέτοιο κύριο έργο και να το υπερασπιστούν εναντίον επιβλαβών εχθρών. <br> <br> Τα Παγκόσμια θαύματα μπορούν να ανεγερθούν μόνο σε ένα από τα παλιά χωριά του Ναταρίων. Ωστόσο, απαιτείται επίσης ένα σχέδιο κατασκευής. Φτάνοντας μέχρι το επίπεδο 50, απαιτείται συμπληρωματικό σχέδιο για την ολοκλήρωσή του. Το δεύτερο σχέδιο πρέπει να ανήκει σε άλλο παίκτη στην ίδια συμμαχία.';

$Definition['Buildings'][41]['title'] = 'Μέρος ποτίσματος αλόγων';
$Definition['Buildings'][41]['desc'] = 'Το μέρος ποτίσματος αλόγων φροντίζει για την υγεία των αλόγων σας, χαμηλώνει την κατανάλωση σιταριού και κάνει την εκπαίδευσή τους γρηγορότερη. Ανά επίπεδο, ο χρόνος εκπαίδευσης στον στάβλο σας μειώνεται κατά 1%.';
$Definition['Buildings'][41]['current_prod'] = 'Τρέχων χρόνος εκπαίδευσης';
$Definition['Buildings'][41]['next_prod'] = 'Χρόνος εκπαίδευσης στο επίπεδο';
$Definition['Buildings'][41]['unit'] = 'τοις εκατό';

$Definition['Buildings'][42]['title'] = 'Πέτρινο τείχος';
$Definition['Buildings'][42]['desc'] = 'Η ανέγερση ενός Πέτρινου τείχους παρέχει προστασία στο χωριό σας απέναντι στις βάρβαρες εχθρικές ορδές. Όσο υψηλότερο το επίπεδο, τόσο υψηλότερο το μπόνους άμυνας.';
$Definition['Buildings'][42]['current_prod'] = 'Τρέχον αμυντικό επίδομα';
$Definition['Buildings'][42]['next_prod'] = 'Αμυντικό επίδομα στο επίπεδο';
$Definition['Buildings'][42]['unit'] = 'τοις εκατό';

$Definition['Buildings'][43]['title'] = 'Αυτοσχέδιο τείχος';
$Definition['Buildings'][43]['desc'] = 'Η ανέγερση ενός Αυτοσχέδιου τείχους παρέχει προστασία στο χωριό σου απέναντι στις βάρβαρες εχθρικές ορδές. Όσο υψηλότερο το επίπεδο του Αυτοσχέδιου τείχους, τόσο υψηλότερο το μπόνους άμυνας.';
$Definition['Buildings'][43]['current_prod'] = 'Τρέχον αμυντικό επίδομα';
$Definition['Buildings'][43]['next_prod'] = 'Αμυντικό επίδομα στο επίπεδο';
$Definition['Buildings'][43]['unit'] = 'τοις εκατό';

$Definition['Buildings'][44]['title'] = 'Κέντρο διοίκησης';
$Definition['Buildings'][44]['desc'] = 'Το Κέντρο διοίκησης παρέχει προστασία στο χωριό απέναντι στις εχθρικές κατακτήσεις. Είναι δυνατή η ανέγερση ενός Κέντρου διοίκησης για κάθε χωριό. Άποικοι και Γερουσιαστές/Αρχηγοί/Αρχηγοί/Νομάρχες/Λογάδες μπορούν να εκπαιδευτούν εκεί.';

$Definition['Buildings'][45]['title'] = 'Υδραγωγείο';
$Definition['Buildings'][45]['desc'] = 'Το Υδραγωγείο επιτρέπει τον έλεγχο της ροής του νερού για την άρδευση των οάσεών σας. Αυτό δεν συμβάλλει απλώς στην καλλιέργεια δέντρων και σιτηρών, αλλά είναι επίσης χρήσιμο για τα λατομεία και τα ορυχεία, καθώς προμηθεύει νερό για τους εργάτες, αλλά και μια δίοδο μεταφοράς πόρων και πρώτων υλών.';
$Definition['Buildings'][45]['current_prod'] = 'Τρέχουσα αύξηση στην παραγωγή';
$Definition['Buildings'][45]['next_prod'] = 'Αύξηση στο επίπεδο';
$Definition['Buildings'][45]['unit'] = 'τοις εκατό';

//Combat
$Definition['combat'] = ["simulate" => "Προσομοίωση επίθεσης",
    "attacker" => "Επιτιθέμενος",
    "defender" => "Αμυνόμενος",
    "number" => "Αριθμός",
    "unit_level" => "Επίπεδο έρευνας",
    "other" => "Άλλο",
    "Population" => "Πληθυσμός",
    "catapult_target_level" => "Επίπεδο στόχου καταπέλτη",
    "hero_off_bonus" => "Ήρωας (επιθ. bonus)",
    "hero_power" => "Ήρωας (δύναμη μάχης)",
    "Palace_Resident" => "Μέγαρο/Παλάτι",
    "loyaltyReducedBy" => "Η πίστη μειώθηκε κατά",
    "DamageByCatapult" => "Ζημιά από τους καταπέλτες",
    "DamageByRam" => "Ζημιά από πολιορκητικό κριό",
    "from" => "Από",
    "to" => "σε",
    "normal" => "Κανονική",
    "raid" => "Επιδρομή",
    "attack_type" => "Τύπος μάχης",
    "troops" => "Μονάδες στρατού",
    "casualties" => "Απώλειες",
    "attack_settings" => "Ρυθμίσεις επίθεσης",
    "attack_types" => [
        1 => "Ανίχνευση",
        2 => "Κανονική",
        3 => "Επιδρομή",
    ],
];
//cropFinder
$Definition['cropFinder']['title'] = 'Βρείτε 9/15 χωράφια σιταριού';
$Definition['cropFinder']['Start position:'] = 'Αρχική θέση:';
$Definition['cropFinder']['cropper'] = 'άρι σιταριού';
$Definition['cropFinder']['both'] = 'και τα δυο';
$Definition['cropFinder']['Type'] = 'Τύπος';
$Definition['cropFinder']['any'] = 'όλα';
$Definition['cropFinder']['Oasis crop bonus (at least)'] = 'Οάσεις με μπόνους σιταριού (τουλάχιστον)';
$Definition['cropFinder']['only show unoccupied'] = 'δείξε μόνο μη κατειλημμένα';
$Definition['cropFinder']['search'] = 'Αναζήτηση';
$Definition['cropFinder']['Croplands'] = 'Χωράφια σιταριού';
$Definition['cropFinder']['distance'] = 'Απόσταση';
$Definition['cropFinder']['Position'] = 'Θέση';
$Definition['cropFinder']['Oasis'] = 'Οάσεις';
$Definition['cropFinder']['Occupied by'] = 'Κατειλημμένα από';
$Definition['cropFinder']['Alliance'] = 'Συμμαχία';
$Definition['cropFinder']['noRows'] = 'Δεν βρέθηκαν χωράφια με την επιλεγμένη αναζήτηση.';
//DailyQuest
$Definition['DailyQuest']['You`ve reached max voting limit Try again later'] = '!!!';
$Definition['DailyQuest']['Daily Quests'] = 'Καθημερινές εργασίες';
$Definition['DailyQuest']['Collect daily rewards'] = 'Συλλέξτε τις καθημερινές ανταμοιβές';
$Definition['DailyQuest']['Click for details'] = 'Πάτα για λεπτομέρειες';
$Definition['DailyQuest']['points'] = 'Πόντοι ';
$Definition['DailyQuest']['Collect reward'] = 'Συλλογή ανταμοιβής';
$Definition['DailyQuest']['Overview'] = 'Επισκόπηση';
$Definition['DailyQuest']['This account is banned'] = 'Ο λογαριασμός είναι κλειδωμένος.';
$Definition['DailyQuest']['Congratulations! You have collected enough points to get a reward!'] = 'Συγχαρητήρια! Συλλέξατε αρκετούς πόντους για να λάβετε μια ανταμοιβή!';
$Definition['DailyQuest']['For collecting x points today, you receive the following reward'] = 'Συλλέγοντας %s πόντους σήμερα, λάβατε τις ακόλουθες ανταμοιβές';
$Definition['DailyQuest']['For collecting x points today, you can now collect your reward'] = 'Συλλέγοντας %s πόντους σήμερα, μπορείτε να λάβετε τώρα την ανταμοιβή σας';
$Definition['DailyQuest']['Your daily reward is determined randomly from these options'] = 'Η καθημερινή σας ανταμοιβή είναι τυχαία από αυτές τις επιλογές';
$Definition['DailyQuest']['reward_25%_desc'] = 'Συγκεντρώνοντας 25 πόντους μπορείτε να λάβετε μια από τις ακόλουθες ανταμοιβές:
<br />
 <ul>
<li>+' . calculate_dailyquest_bonus(200, 'res') . ' ύλες κάθε τύπου</li>
<li>+' . calculate_dailyquest_bonus(50, 'exp') . ' εμπειρία ήρωα</li>
<li>+' . calculate_dailyquest_bonus(50, 'cp') . ' πόντους πολιτισμού</li>
<li>+' . calculate_dailyquest_bonus(1000, 'res') . ' ύλες από έναν τυχαίο τύπο</li>
</ul>';
$Definition['DailyQuest']['you collected x points today!'] = 'Η ανταμοιβή για τους %s πόντους σήμερα έχει ληφθεί!';
$Definition['DailyQuest']['Your Reward:'] = 'Η ανταμοιβή:';
$Definition['DailyQuest']['reward_25%_rows'][] = '<li> +' . calculate_dailyquest_bonus(200, 'res') . ' ύλες κάθε τύπου</li>';
$Definition['DailyQuest']['reward_25%_rows'][] = '<li> +' . calculate_dailyquest_bonus(50, 'exp') . ' εμπειρία ήρωα</li>';
$Definition['DailyQuest']['reward_25%_rows'][] = '<li>+' . calculate_dailyquest_bonus(50, 'cp') . ' πόντους πολιτισμού</li>';
$Definition['DailyQuest']['reward_25%_rows'][] = '<li>+' . calculate_dailyquest_bonus(1000, 'res') . ' ύλες από έναν τυχαίο τύπο</li>';
$Definition['DailyQuest']['x points achieved'] = '%s πόντοι έχουν επιτευχθεί.';
$Definition['DailyQuest']['reward_50%_desc'] = 'Συγκεντρώνοντας 50 πόντους μπορείτε να λάβετε μια από τις ακόλουθες ανταμοιβές:
<br />
 <ul>
<li>+'.calculate_dailyquest_bonus(86400, 'plus').' λογαριασμό PLUS</li>
<li>+'.calculate_dailyquest_bonus(86400, 'productionBoost').' +25% επίδομα παραγωγής ξυλείας</li>
<li>+'.calculate_dailyquest_bonus(86400, 'productionBoost').' +25% επίδομα παραγωγής πηλού</li>
<li>+'.calculate_dailyquest_bonus(86400, 'productionBoost').' +25% επίδομα παραγωγής σιδήρου</li>
<li>+'.calculate_dailyquest_bonus(86400, 'productionBoost').' +25% επίδομα παραγωγής σιταριού</li>
</ul>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li> +'.calculate_dailyquest_bonus(86400, 'plus').' λογαριασμό PLUS</li>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li> +'.calculate_dailyquest_bonus(86400, 'productionBoost').' +25% επίδομα παραγωγής ξυλείας</li>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li> +'.calculate_dailyquest_bonus(86400, 'productionBoost').' +25% επίδομα παραγωγής πηλού</li>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li> +'.calculate_dailyquest_bonus(86400, 'productionBoost').' +25% επίδομα παραγωγής σιδήρου</li>';
$Definition['DailyQuest']['reward_50%_rows'] = '<li> +'.calculate_dailyquest_bonus(86400, 'productionBoost').' +25% επίδομα παραγωγής σιταριού</li>';
$Definition['DailyQuest']['reward_75%_desc'] = 'Συγκεντρώνοντας 75 πόντους μπορείτε να λάβετε μια από τις ακόλουθες ανταμοιβές:
<br />
 <ul>
<li>+' . calculate_dailyquest_bonus(5, 'item') . ' αλοιφές</li>
<li>+' . calculate_dailyquest_bonus(5, 'item') . ' πινάκια του νόμου</li>
<li>+' . calculate_dailyquest_bonus(5, 'item') . ' μικροί επίδεσμοι</li>
<li>+' . calculate_dailyquest_bonus(5, 'item') . ' κλουβιά</li>
<li>+' . calculate_dailyquest_bonus(1, 'adv') . ' επιπλέον περιπέτεια</li>
</ul>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(5, 'item') . ' αλοιφές</li>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(5, 'item') . ' πινάκια του νόμου</li>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(5, 'item') . ' μικροί επίδεσμοι</li>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(5, 'item') . ' κλουβιά</li>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(1, 'adv') . ' επιπλέον περιπέτεια</li>';
$Definition['DailyQuest']['reward_100%_desc'] = 'Συγκεντρώνοντας 100 πόντους μπορείτε να λάβετε μια από τις ακόλουθες ανταμοιβές:
<br />
 <ul>
<li>+' . calculate_dailyquest_bonus(400, 'cp') . ' πόντους πολιτισμού</li>
<li>+' . calculate_dailyquest_bonus(20000, 'res') . ' ύλες από έναν τυχαίο τύπο</li>
<li>+' . calculate_dailyquest_bonus(400, 'exp') . ' εμπειρία ήρωα</li>
<li>+' . calculate_dailyquest_bonus(4000, 'res') . ' ύλες κάθε τύπου</li>
</ul>';
$Definition['DailyQuest']['reward_100%_rows'][] = '<li>+' . calculate_dailyquest_bonus(400, 'cp') . ' πόντους πολιτισμού</li>';
$Definition['DailyQuest']['reward_100%_rows'][] = '<li>+' . calculate_dailyquest_bonus(20000, 'res') . ' ύλες από έναν τυχαίο τύπο</li>';
$Definition['DailyQuest']['reward_100%_rows'][] = '<li>+' . calculate_dailyquest_bonus(400, 'exp') . ' εμπειρία ήρωα</li>';
$Definition['DailyQuest']['reward_100%_rows'][] = '<li>+' . calculate_dailyquest_bonus(4000, 'res') . ' ύλες κάθε τύπου</li>';
$Definition['DailyQuest']['Receive these free rewards every day!'] = 'Λάβε δωρεάν ανταμοιβή κάθε μέρα!';
$Definition['DailyQuest']['nextResetDesc'] = 'Επόμενη ανανέωση στις %s η ώρα';
$Definition['DailyQuest']['Quest is complete for today'] = 'Η εργασία ολοκληρώθηκε για σήμερα';
$Definition['DailyQuest']['Quest is still open'] = 'Η εργασία είναι ακόμα ενεργή.';
$Definition['DailyQuest']['Difficulty'] = 'Δυσκολία';
$Definition['DailyQuest']['Requirement'] = 'Απαιτούμενα';
$Definition['DailyQuest']['Overview'] = 'Επισκόπηση';
$Definition['DailyQuest']['This quest is worth + x points'] = 'Αυτή η εργασία αξίζει + %s πόντους';
$Definition['DailyQuest']['Points granted for this quest: + x / y'] = 'Πόντοι που κερδήθηκαν από την εργασία: + %s / %s';
$Definition['DailyQuest']['The points for this quest can be achieved x times per day'] = 'Οι πόντοι αυτής της εργασίας μπορούν να επιτευχθούν %s φορές την μέρα';
$Definition['DailyQuest']['Difficulties'] = [
    "challenging" => 'άνω του μετρίου', "hard" => 'μεγάλη', "moderate" => 'μέτρια',
];
$Definition['DailyQuest']['questData'] = [
    1 => [
        'name' => 'Ολοκλήρωσε μια περιπέτεια', 'desc' => 'Στείλτε τον ήρωά σας σε μια περιπέτεια. Αυτή η εργασία ολοκληρώνεται μόλις φτάσει ο ήρωάς σας, ακόμα και αν δεν καταφέρει να επιβιώσει από την περιπέτεια.
Για να στείλετε τον ήρωά σας σε μια περιπέτεια, απλά κάντε κλικ στο εικονίδιο που εμφανίζεται στην εικόνα.',
        'difficulty' => 'moderate', 'Requirement' => 'Διαθέσιμη περιπέτεια',
    ], 2 => [
        'name' => 'Επιδρομή σε μια μη κατειλημμένη όαση', 'desc' => 'Στείλε στρατό να κάνει επιδρομή σε μια μη κατειλημμένη όαση. Αυτή η εργασία ολοκληρώνεται μόλις φτάσει ο στρατός σου, ακόμα και αν σκοτωθεί κατά την μάχη. Αν χρησιμοποιήσεις κλουβιά για να αποφύγεις την μάχη <b>δεν</b> θα δώσει στον στρατό σου κανένα πόντο για την εργασία. 
Μπορείς να υπολογίσεις το αποτέλεσμα της επιδρομής χρησιμοποιώντας τον προσομοιωτή μάχης. Μπορείς να τον βρεις στην Πλατεία συγκέντρωσης.',
        'difficulty' => 'hard', 'Requirement' => '(Πολλά) στρατεύματα',
    ], 3 => [
        'name' => 'Επιδρομή/Επίθεση σε χωριό Νατάριων', 'desc' => 'Στείλε στρατό να κάνει επιδρομή/επίθεση σε ένα χωριό Νατάριων. Η εργασία αυτή θα ολοκληρωθεί όταν ο στρατός φτάσει, ακόμα και αν σκοτωθούν όλα τα στρατεύματα στην μάχη.
Μην επιτεθείς σε χωριό Παγκοσμίου Θαύματος που ανήκει στους Νατάριους πριν έχει εκπαιδεύσει τουλάχιστον 100.000 στρατό.
<br />', 'difficulty' => 'challenging', 'Requirement' => '(Πολλά) στρατεύματα',
    ], 4 => [
        'name' => 'Κέρδισε μια δημοπρασία', 'desc' => 'Λάβε μέρος σε μια δημοπρασία και κέρδισε δυο φορές αποκτόντας το αντικείμενο που σε ενδιαφέρει και συλλέγοντας πόντους για τις ημερήσιες ανταμοιβές σου! Οι πόντοι θα προστεθούν μόλις κερδίσεις μια δημοπρασία που επέλεξες.
<br />', 'difficulty' => 'challenging',
        'Requirement' => 'Ολοκλήρωση 10 περιπετειών',
    ], 5 => [
        'name' => 'Κέρδισε ή χρησιμοποίησε χρυσό', 'desc' => 'Για λάβεις τους πόντους της εργασίας, χρειάζεται είτε να κερδίσεις είτε να ξοδέψεις χρυσό. Από εσένα εξαρτάται για πως και ποιο προτέρημα θέλεις να κερδίσεις/χρησιμοποιήσεις οποιοδήποτε ποσό από τον χρυσό του λογαριασμού σου.
<br />', 'difficulty' => 'moderate', 'Requirement' => 'Κανένα',
    ], 6 => [
        'name' => 'Αναβάθμισε ένα κτήριο', 'desc' => 'Για να κερδίσεις τους πόντους αυτής της εργασίας, χρειάζεται ή να αναβαθμίσεις το υπάρχον κτήριο ή να κτίσεις ένα νέο. 
Οι πόντοι θα σου πιστωθούν με την ολοκλήρωση της εργασίας.
<br />', 'difficulty' => 'moderate', 'Requirement' => 'Ύλες',
    ], 7 => [
        'name' => 'Αναβάθμιση πεδίου ύλης', 'desc' => 'Για να κερδίσεις τους πόντους αυτής της εργασίας, χρειάζεται ή να αναβαθμίσεις το υπάρχον πεδίο ύλης ή να κτίσεις ένα νέο. 
Οι πόντοι θα σου πιστωθούν με την ολοκλήρωση της εργασίας.
<br />', 'difficulty' => 'moderate', 'Requirement' => 'Ύλες',
    ], 8 => [
        'name' => 'Εκπαίδευσε 20 μονάδες πεζικού ενός τύπου', 'desc' => 'Για να κερδίσεις τους πόντους αυτής της εργασίας, πρέπει να εκπαιδεύσεις 20 στρατεύματα πεζικού στο στρατόπεδο σου, σε μια παρτίδα. 
Παρακαλώ σημείωσε ότι οι μονάδες πεζικού που είναι ήδη σε σειρά κατασκευής <b>δεν</b> θα σου δώσουν πόντους σε αυτήν την εργασία.
<br />', 'difficulty' => 'challenging', 'Requirement' => 'Στρατόπεδο',
    ], 9 => [
        'name' => 'Εκπαίδευσε 20 στρατεύματα ιππικού ενός τύπου', 'desc' => 'Για να κερδίσεις τους πόντους γι αυτήν την εργασία, πρέπει να εκπαιδεύσεις 20 στρατεύματα ιππικού στον στάβλο σε μια παρτίδα.
Παρακαλώ σημείωσε ότι οι μονάδες ιππικού που είναι ήδη σε σειρά κατασκευής <b>δεν</b> θα σου δώσουν πόντους σε αυτήν την εργασία. 
<br />', 'difficulty' => 'challenging', 'Requirement' => 'Στάβλος',
    ], 10 => [
        'name' => 'Διοργάνωσε μια μικρή ή μεγάλη γιορτή', 'desc' => '
Διοργάνωσε μια μικρή ή μεγάλη γιορτή στο δημαρχείο. 
Οι πόντοι θα πιστωθούν μόλις διοργανώσεις οποιαδήποτε γιορτή. Γιορτές που βρίσκονται ήδη σε εξέλιξη δεν δίνουν κανένα πόντο..
<br/> 
<br/>', 'difficulty' => 'hard', 'Requirement' => '3 Δημαρχία',
    ],
    11 => [
        'name' => 'Contribute %s resources to an alliance bonus', 'desc' => 'To support your alliance you can contribute resources to an alliance bonus. Once your alliance collected enough contributions to unlock or level up an alliance bonus, the whole alliance benefits from its effect. This quest is accomplished once you\'ve contributed to any alliance bonus.', 'difficulty' => 'challenging', 'Requirement' => 'Alliance membership',
    ],
];
$Definition['DailyQuest']['VotingSystemTitle'] = 'Κέρδίσε δωρεάν χρυσό!';
$Definition['DailyQuest']['Vote'] = 'Vote';
$Definition['DailyQuest']['VoteRewardDesc'] = 'Each vote +10 <img class="gold" src="img/x.gif"> will be give you.';
$Definition['DailyQuest']['Earn free gold!!!'] = 'Κέρδίσε δωρεάν χρυσό!!!';
$Definition['DailyQuest']['Click on Consultant to open Hints page'] = 'Click on Consultant to open Hints page';
$Definition['DailyQuest']['if you abuse the vote system you will be banned'] = 'if you abuse the vote system you will be banned.';
$Definition['DailyQuest']['voteQuestDescription'] = 'You can earn some free gold by completing a vote process. <br> You must click on the image below to be taken to vote';
//Dorf1
$Definition['Dorf1']['units'] = 'Στρατεύματα:';
$Definition['Dorf1']['none'] = 'κανένα';
$Definition['Dorf1']['production']['production per hour'] = 'Παραγωγή ανά ώρα';
$Definition['Dorf1']['production']['resources'][1] = 'Ξύλο';
$Definition['Dorf1']['production']['resources'][2] = 'Πηλός';
$Definition['Dorf1']['production']['resources'][3] = 'Σίδερο';
$Definition['Dorf1']['production']['resources'][4] = 'Σιτάρι';
$Definition['Dorf1']['production']['productionBoostButton'] = 'περισσότερες πληροφορίες για το επίδομα παραγωγής.';
$Definition['Dorf1']['movements']['incoming'] = 'Εισερχόμενα στρατεύματα';
$Definition['Dorf1']['movements']['outgoing'] = 'Εξερχόμενα στρατεύματα';
$Definition['Dorf1']['movements']['hour'] = 'ώρες';
$Definition['Dorf1']['movements']['in'] = 'σε ';
$Definition['Dorf1']['movements']['incomingAttacksToOases'] = 'Εισερχόμενες επιθέσεις στις οάσεις μου';
$Definition['Dorf1']['movements']['incomingAttacksToMe'] = 'Εισερχόμενες επιθέσεις';
$Definition['Dorf1']['movements']['reinforcement'] = 'Ενίσχυση';
$Definition['Dorf1']['movements']['incomingReinforcements'] = 'Εισερχόμενες ενισχύσεις';
$Definition['Dorf1']['movements']['incomingReinforcementsToMyOases'] = 'Εισερχόμενες ενισχύσεις στις οάσεις μου';
$Definition['Dorf1']['movements']['outGoingAttacks'] = 'Δικές μου επιθέσεις';
$Definition['Dorf1']['movements']['attack'] = 'Επιθέσεις)';
$Definition['Dorf1']['movements']['outGoingReinforcements'] = 'Δικές μου ενισχύσεις';
$Definition['Dorf1']['movements']['adventure'] = 'Περιπέτια';
$Definition['Dorf1']['movements']['outGoingAdventure'] = 'Ο ήρωας πηγαίνει σε περιπέτεια.';
$Definition['Dorf1']['movements']['evasion'] = 'Διαφυγή';
$Definition['Dorf1']['movements']['settlers'] = 'Εγκατάσταση';
$Definition['Dorf1']['movements']['settlersOnTheWay'] = 'Άποικοι στο δρόμο';
$Definition['Dorf1']['movements']['outGoingEvasion'] = 'Διαφυγή δικών μου στρατευμάτων';
//embassyWhite
$Definition['embassyWhite']['embassy'] = 'Πρεσβεία';
$Definition['embassyWhite']['invites to you:'] = 'Τρέχουσες προσκλήσεις:';
$Definition['embassyWhite']['max embassy level:'] = 'Μέγιστο επίπεδο πρεσβείας: ';
$Definition['embassyWhite']['construct an embassy'] = 'Κατασκεύασε πρεσβία';
$Definition['embassyWhite']['Alliance forum'] = 'Φόρουμ συμμαχίας';
$Definition['embassyWhite']['Alliance overview'] = 'Σελίδα συμμαχίας';
$Definition['embassyWhite']['no alliance'] = 'Καμία συμμαχία';
$Definition['embassyWhite']['You are currently not part of any alliance'] = 'Δεν είσαι μέλος σε καμία συμμαχία';
//ExtraModules
$Definition['ExtraModules'] = [
    'addFarmsNearby' => 'Πρόσθεσε %sx%s κοντινές φάρμες',
    'addFarms' => 'Πρόσθεσε αυτόματα 100 διαφορετικές φάρμες',
    'addFarmsIsDisabledTill' => 'Αυτή η επιλογή είναι απενεργοποιημένη μέχρι %s.',
    'buyAdventure' => 'Αγόρασε μια περιπέτεια',
    'upgradeToMaxLevel' => 'Αναβάθμιση σε μέγιστο επίπεδο για',
    'upgradeStorageToMaxLevel' => 'Αναβάθμιση σε μέγιστο επίπεδο για',
    'increaseStorage' => 'Αυξήστε την αποθήκευση',
    'smithyMaxLevel' => 'Αναβάθμιση σε μέγιστο επίπεδο για',
    'smithyUpgradeAllToMax' => 'Αναβαθμήστε όλα τα στρατεύματα στο μέγιστο επίπεδο.',
    'academyResearchAll' => 'Έρευνα όλων των μονάδων',
    'finishTraining' => 'Τελειώστε την εκπαίδευση όλων των στρατευμάτων στιγμιαία',
    'Used %s of %s' => 'Χρησιμοποιημένο %s από %s',
    'Feature limit reached' => 'Το όριο χαρακτηριστικών επιτεύχθηκε.',
    'Errors' => ['WWDisabled' => 'Δεν μπορείτε να χρησιμοποιήσετε αυτή τη λειτουργία σε χωριά ΠΘ.', 'Feature limit reached' => 'Το όριο χαρακτηριστικών επιτεύχθηκε.',],
];
//Farmlist
$Definition['FarmList'] = [
    'You can only have one autoraid per account' => 'Μπορείτε να έχετε μόνο μια αυτόματη λίστα επιδρομών ανά λογαριασμό.',
    'Auto raid On' => 'Αυτόματες επιδρομές ON',
    'Auto raid Off' => 'Αυτόματες επιδρομές Off',
    'Auto raid costs %s silver(s) every %s seconds when it hits the farmlist' => 'Οι αυτόματες επιδρομές κοστίζουν %s <img class="silver" src="img/x.gif"> η οποία επιτίθεται τυχαία στη φάρμα αυτόματα.',
    "System: You must wait some time before sending another raid" => "Σύστημα: Πρέπει να περιμένετε λίγο πριν στείλετε άλλη επιδρομή.",
    "nameTooLong" => "Το όνομα είναι υπερβολικά μεγάλο.",
    "enterListName" => "Καταχωρίστε το όνομα λίστας.",
    "nameIsNotUnique" => "Το όνομα αυτό έχει ληφθεί. Το όνομα πρέπει να είναι μοναδικό από το χωριό.",
    "nRaidsMade" => "%s επιδρομές έγιναν επιτυχώς.",
    "delete" => "Διαγραφή",
    "choose_village" => "Επιλογή χωριού",
    "add" => "πρόσθεση",
    "addRaid" => "Πρόσθεσε φάρμα",
    "editRaid" => "Επεξεργασία επιδρομής",
    "choose_target" => "Επιλογή στόχου",
    "FarmList" => "Λίστα με φάρμες",
    "reallyDelete" => "Θέλετε πραγματικά να διαγράψετε αυτήν την καταχώρηση από την λίστα με φάρμες;",
    "raidList" => "Λίστα επιδρομών",
    "lastTargets" => "Τελευταίοι στόχοι",
    "create_new_list" => "Δημιούργησε νέα λίστα",
    "rename_list" => "Αλλαγή ονόματος λίστας",
    "rename" => "Αλλαγή ονόματος",
    "Village" => "Χωριό",
    "pop" => "Κατ",
    "distance" => "Απόσταση",
    "troops" => "στρατεύματα",
    "lastRaid" => "Τελευταία επιδρομή",
    "name" => "Όνομα",
    "create" => "δημιουργία",
    "checkAll" => "τσέκαρε τα όλα",
    "startRaid" => "Άρχησε επιδρομή",
    "details" => "Λεπτομέριες",
    "occupiedOasis" => "Κατειλημμένη ὀαση",
    "unoccupiedOasis" => "Μη κατειλημμένη όαση",
    "edit" => "Επεξεργασία",
    "outGoingAttack" => "Οι επιθέσεις μου",
    "noSlot" => "Καμία φάρμα δεν έχει προστεθεί στη λίστα.",
    "noVillageInTarget" => "Δεν υπάρχει χωριό σε αυτές τις συντεταγμένες.",
    "noTroopsSelected" => "Δεν επιλέχτηκαν στρατεύματα.",
    "sameVillageEntered" => "Δεν μπορείτε να επιτεθείτε στο τρέχον επιλεγμένο χωριό.",
    "errorWorldWonderVillage" => "Δεν μπορείτε να επιτεθείτε σε αυτό το χωριό.",
    "slotsFull" => "Η λίστα είναι πλήρης.",
    'editAllSlotsRaid' => 'Επεξεργασία όλων των φαρμών',
    'Attack_iReport1' => 'Επίθεση στο <img src=\'img/x.gif\' class=\'iReport iReport1\'/><img src=\'img/x.gif\' class=\'iReport iReport2\'/><img src=\'img/x.gif\' class=\'iReport iReport3\'/>',
    'Attack_iReport2' => 'Επίθεση στο <img src=\'img/x.gif\' class=\'iReport iReport1\'/>',
    'Attack_iReport3' => 'Επίθεση στο <img src=\'img/x.gif\' class=\'iReport iReport1\'/><img src=\'img/x.gif\' class=\'iReport iReport2\'/> με εξαίρεση τα οποία υπερασπίζονται πλήρως.',
    'Attack_att3' => '<img src=\'img/x.gif\' class=\'att3\'/><br /> Επίθεση τυχαία όταν τα στρατεύματά σας είναι χαμηλότερα από το συνολικό άθροισμα.',
    'underProtection' => 'Δεν μπορείτε να επιτεθείτε σε άλλους παίκτες όταν βρίσκεστε υπό προστασία νέου παίκτη.',
    'You attacked %s seconds ago, you need to wait %s seconds before sending another raid' => 'Η τελευταία επίθεσή σας στάλθηκε % s δευτερόλεπτα πριν. Πρέπει να περιμένετε % s για να στείλετε μια άλλη επιδρομή.',
];
use Core\Helper\WebService;
$Definition['Global']['Building settings'] = 'Building settings';
$Definition['Global']['Times'] = 'Times';
$Definition['Global']['Unlimited'] = 'Απεριόριστο';
$Definition['Global']['Hour'] = 'Ώρα';
$Definition['Global']['Day'] = 'Ημέρα';
$Definition['Global']['Minute'] = 'Λεπτό';
$Definition['Global']['Second'] = 'Δευτερόλεπτο';
$Definition['Global']['This tab is set as favourite'] = 'Αυτή η καρτέλα έχει οριστεί ως αγαπημένη';
$Definition['Global']['Select tab %s as favourite'] = 'Θέσε το %s στα αγαπημένα';
$Definition['Global']['loadingData'] = 'Φόρτωση...';
$Definition['Global']['registration_startgame_message_subject'] = 'Subject';
$Definition['Global']['registration_startgame_message_message'] = '';
//Newsletter
$Definition['Global']['Newsletter_NewServer_subject'] = 'Νέος %s %sx γύρος';
$Definition['Global']['Newsletter_NewServer_content'] = '<strong> Γειά σου</strong>,
<br/>
<br/>
<br/>
Ήρθε η ώρα σου!
<strong>Σήμερα ξεκινάμε έναν νέο <a href="[REGISTRATION_URL]" style="color:#f88c1f;" target="_blank"
                                        title="Travian"> server</a> Travian</strong>. Ανέβα στο πάνθεον των δυνατότερων και γενναιότερων πολεμιστών του Travian!
<br/>
<br/>
<div align="center">
    <a href="[REGISTRATION_URL]" target="_blank" title="Συνδέσου τώρα">
        <img alt="Play now" height="47" src="[INDEX_URL]img/Webstart/Play_Now_Button_x120_rot_EN.jpg"
             style="border-width: 0px; border-style: solid;" title="Play now" width="120"/></a>
</div>
<br/>
Ο αγώνας για τα πολύτιμα αντικείμενα και τα θρυλικά θαύματα του κόσμου ανανεώνεται.
<br/>
<br/>
<strong><a href="[REGISTRATION_URL]" style="color:#f88c1f;" target="_blank" title="Travian">Ξεκινήστε μια νέα μάχη τώρα</a></strong> και να εντάξου σε μια ισχυρή συμμαχία. Μην χάνεις χρόνο!<br/>
<br/>Γίνετε ο ισχυρότερος παίκτης του Travian!<br/><br/><strong>Η ομάδα του ΜΟΛΩΝ ΛΑΒΕ<br/><br/><br/><br/></strong>';
$Definition['Global']['Languages'] = [
    'en' => 'en',
    'ir' => 'ir',
    'gr' => 'gr',
];
$Definition['Global']['edit'] = 'επεξεργασία';
$Definition['Global']['ms'] = 'ms';
$Definition['Global']['ns'] = 'ns';
$Definition['Global']['Best regards,The Travian Team'] = 'Τις καλύτερες ευχές,<br />Η ομάδα του ΜΟΛΩΝ ΛΑΒΕ';
$Definition['Global']['FreeGoldTitle'] = 'Δωρεάν χρυσό';
$Definition['Global']['FreeGold'] = "Αγαπητέ παίκτη,\n\n%s χρυσό προστέθηκε στο λογαριασμό σου.\n\n Χαιρετισμούς,\n\n Η ομάδα υποστήριξης του ΜΟΛΩΝ ΛΑΒΕ";
$Definition['Global']['BuyGoldSubject'] = 'Η συναλλαγή ολοκληρώθηκε';
$Definition['Global']['BuyGoldText'] = 'Η συναλλαγή ολοκληρώθηκε επιτυχώς' . PHP_EOL . PHP_EOL . '%s χρυσό προστέθηκαν στο λογαριασμό σας.' . PHP_EOL . PHP_EOL . "Ο αριθμός συναλαγής σας είναι: %s" . PHP_EOL . PHP_EOL . "ε εκτίμηση,\n Η ομάδα του Μολών Λαβέ";
$Definition['Global']['voucherTitle'] = 'Η συναλλαγή ολοκληρώθηκε';
$Definition['Global']['voucherText'] = 'Το κουπόνι χρησιμοποιήθηκε επιτυχώς και το χρυσό προστέθηκε στο λογαριασμό σας.' . PHP_EOL . PHP_EOL . '%s χρυσό προστέθηκαν στο λογαριασμό σας.' . PHP_EOL . PHP_EOL . "Ο αριθμός συναλαγής σας είναι: %s" . PHP_EOL . PHP_EOL . "Με εκτίμηση,\n Η ομάδα του Μολών Λαβέ";
$Definition['Global']['Travian'] = 'Travian';
$Definition['Global']['Farm'] = 'Φάρμα';
$Definition['Global']['Farms'] = 'Φάρμες';
$Definition['Global']['The process may take some time Please wait'] = 'Η διαδικασία μπορεί να διαρκέσει λίγο. Παρακαλώ περιμένετε.';
$Definition['Global']['Loading'] = 'Φόρτωση';
$Definition['Global']['Contact admin'] = 'Επικοινωνήστε με την υποστήριξη';
$Definition['Global']['VoucherEmailSubject'] = 'Travian κωδικός κουπονιού';
$Definition['Global']['VoucherEmailMessage'] = 'Αγαπητέ παίκτη,<br />πρόσφατα διαγράψατε τον λογαριασμό σας στον ΜΟΛΩΝ ΛΑΒΕ και έχετε αγοράσει μερικά χρυσά νομίσματα.<br /><br />Τώρα μπορείτε να λάβετε το χρυσό σας σε άλλο λογαριασμό στα παιχνίδια του ΜΟΛΩΝ ΛΑΒΕ με τον παρακάτω κώδικα <br /> Κωδικός κουπονιού: %s<br /><br />Χαιρετισμοί από την, ομάδα του ΜΟΛΩΝ ΛΑΒΕ';
$Definition['Global']['FAQ'] = 'FAQ';
$Definition['Global']['cropfinder']['no results found'] = 'Δεν βρέθηκαν αποτελέσματα.';
$Definition['Global']['today'] = 'Σήμερα';
$Definition['Global']['yesterday'] = 'Χτές';
$Definition['Global']['tomorrow'] = 'Αύριο';
$Definition['Global']['x days later'] = '%s ημέρες μετά';
$Definition['Global']['x days past'] = '%s ημέρες πριν';
$Definition['Global']['Dear [PlayerName],'] = 'Αγαπητέ %s,';
$Definition['Global']['beforeyesterday'] = 'Προχτές';
$Definition['Global']['newVillageName'] = 'Νεο χωριό';
$Definition['Global']['moreInformation'] = 'Περισσότερες πληροφορίες';
$Definition['Global']['Hello x'] = 'Γειά σου %s,';
$Definition['Global']['continue'] = 'συνέχεια';
$Definition['Global']['gold'] = 'χρυσό';
$Definition['Global']['silver'] = 'ασήμι';
$Definition['Global']['convertedTo'] = 'Μετέτρεψε σε';
$Definition['Global']['Login'] = 'Σύνδεση';
$Definition['Global']['Register'] = 'Εγγραφή';
$Definition['Global']['Support'] = 'Υποστήριξη';
$Definition['Global']['Wilderness'] = 'Ερημιά';
$Definition['Global']['OccupiedOasis'] = 'Κατειλημμένη ὀαση';
$Definition['Global']['unOccupiedOasis'] = 'Μη κατειλημμένη όαση';
$Definition['Global']['Abandoned valley'] = 'Εγκατηλημμένη κοιλάδα';
$Definition['Global']['Player not found'] = 'Ο παίκτης δεν βρέθηκε';
$Definition['Global']['Alliance not found'] = 'Η συμμαχία δεν βρέθηκε';
$Definition['Global']['Invalid Report ID'] = 'Μη έγκυρο ID αναφοράς';
$Definition['Global']['Invalid private key'] = 'Μη έγκυρο κλειδί';
$Definition['Global']['General']['instructions'] = 'Οδηγίες';
$Definition['Global']['General']['ok'] = 'OK';
$Definition['Global']['General']['cancel'] = 'ακύρωση';
$Definition['Global']['General']['close'] = 'κλείσε';
$Definition['Global']['General']['or'] = 'ή';
$Definition['Global']['General']['closeWindow'] = 'Κλείσε παράθυρο';
$Definition['Global']['General']['level'] = 'επίπεδο';
$Definition['Global']['General']['in'] = 'σε';
$Definition['Global']['General']['at'] = 'έτοιμο στις';
$Definition['Global']['General']['endat'] = 'Τελειώνει';
$Definition['Global']['General']['hour'] = 'ώρες';
$Definition['Global']['General']['startat'] = 'Έναρξη σε';
$Definition['Global']['General']['duration'] = 'Διάρκεια';
$Definition['Global']['General']['cost'] = 'Κόστος';
$Definition['Global']['General']['perHour'] = 'την ώρα';
$Definition['Global']['General']['save'] = 'Αποθήκευση';
$Definition['Global']['NatarsName'] = 'Natars';
$Definition['Global']['playerVillageName'] = "%s's χωριό";
$Definition['Global']['wwName'] = 'Χωριό Παγκοσμίου θαύματος';
$Definition['Global']['NatureName'] = 'Φύση';
$Definition['Global']['races'][1] = 'Ρωμαίοι';
$Definition['Global']['races'][2] = 'Τεύτονες';
$Definition['Global']['races'][3] = 'Γαλάτες';
$Definition['Global']['races'][4] = 'Φύση';
$Definition['Global']['races'][5] = 'Νατάριοι';
$Definition['Global']['races'][6] = 'Αιγύπτιοι';
$Definition['Global']['races'][7] = 'Ούννοι';
$Definition['Global']['UnloadHelper']['message'] = 'Έχετε κάνει κάποιες αλλαγές. Θέλετε σίγουρα να φύγετε από τη σελίδα;';
$Definition['Global']['Footer']['FAQ'] = 'FAQ - Απαντήσεις';
$Definition['Global']['Footer']['Credits'] = 'Credits';
$Definition['Global']['Footer']['HomePage'] = 'Κεντρική σελίδα';
$Definition['Global']['Footer']['Forum'] = 'Φόρουμ';
$Definition['Global']['Footer']['Links'] = 'Links';
$Definition['Global']['Footer']['Terms'] = 'Όροι χρήσης';
$Definition['Global']['Footer']['Imprint'] = 'Στοιχεία Εκδόσεως';
$Definition['Global']['Footer']['Register'] = 'Εγγραφή';
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
Πέρασαν ατέλειωτες μέρες από τις πρώτες μάχες πάνω στα τείχη των καταραμένων 
χωριών των τρομερών Νατάρωιν, πολλοί στρατοί και από τους δυο, του ελεύθερους 
και την Ναταριανή αυτοκρατορία, πολέμησαν και πέθαναν στα τείχη πολλών οχυρών 
από τα οποία κάποτε οι Νατάριοι κυριαρχούσαν. Τώρα που έπεσε η σκόνη και 
καθώς μια αίσθηση ηρεμίας απλώθηκε ανάμεσα τους στρατιώτες, οι στρατοί άρχισαν 
να μετρούν τις απώλειες τους και να μαζεύουν τους νεκρούς τους, η δυσοσμία της
μάχης αιωρείται ακόμα στον αέρα της νύχτας, η μυρωδιά μιας αξέχαστης σφαγής 
σε μέγεθος και βιαιότητα που θα ακολουθηθεί σύντομα από άλλες. Οι μεγαλύτεροι 
στρατοί των ελεύθερων φυλών προετοιμάζονταν για μια νέα μάχη και οι φοβεροί
Νατάριοι προετοιμάζουν τις άμυνές τους για μια νέα εισβολή στα πολυπόθητα
οχυρά της Ναταριανής αυτοκρατορίας.
<br><br>
Σύντομα έφτασαν ανιχνευτές με ιστορίες για το πιο εκπληκτικό θέαμα 
και ένα ανατριχιαστικό εύρημα: ένας τρομερός στρατός ακαθόριστου μεγέθους
βρέθηκε να απλώνει τα μέρη του μέχρι το τέλος του κόσμου, την Ναταριανή 
πρωτεύουσα, μια δύναμη τόσο μεγάλη που η σκόνη από το περπάτημα τους θα έκρυβε 
τον ήλιο, μια δύναμη τόσο μεγάλη και τρομερή που θα συνέτριβε όλες τις ελπίδες. 
Οι ελεύθεροι άνθρωποι ήξεραν ότι πρέπει να καταφέρουν το ακατόρθωτο, 
να αγωνιστούν ενάντια στον χρόνο και τις ατέλειωτες ορδές της 
Ναταριανής αυτοκρατορίας για να ανυψώσουν το Παγκόσμιο Θαύμα 
ώστε να αποκαταστήσουν την ειρήνη στον κόσμο και να αφανίσουν την 
Ναταριανή απειλή.
<br><br>
Αλλά για να κτιστεί ένα Παγκόσμιο Θαύμα δεν θα ήταν μαι εύκολη εργασία. 
Κάποιος θα χρειαστεί σχέδια κατασκευής που δημιουργήθηκαν στο ξεχασμένο 
παρελθόν, σχέδια τέτοιας φύσης που ακόμα και οι μεγαλύτεροι σοφοί δεν ήξεραν 
το περιεχόμενο ή την τοποθεσία τους.
<br><br>
Δεκάδες χιλιάδες ανιχνευτές ξεχύθηκαν σε όλη την επικράτεια ψάχνοντας μάταια 
γι αυτά τα μυστικά σχέδια, κοίταξαν παντού εκτός από την φοβερή πρωτεύουσα των
Νατάριων, παρόλα αυτά δεν βρήκαν τίποτα. Παρόλα αυτά, σήμερα, γύρισαν φέρνοντας
καλά νέα. Οι τοποθεσίες των σχεδίων βρέθηκαν επιτέλους, σφραγισμένες από τις 
δυνάμεις των Νατάριων μέσα σε μυστικά οχυρά κατασκευασμένα ειδικά για να μην 
τα βλέπουν οι άνθρωποι.
<br><br>
Τώρα ξεκινά η τελική προσπάθεια, όπου οι μεγαλύτεροι στρατοί των ελεύθερων 
λαών και των Νατάριων θα συγκρουστούν στα μεγαλύτερα πεδία μαχών του κόσμου
για να κρίνουν το μέλλον όσων είναι κάτω από τους ουρανούς. Σπαθί εναντίον
σπαθιού, αυτός είναι ο πόλεμος που θα αντηχεί μέσα στους αιώνες, αυτός είναι
ο δικός σου πόλεμος και εδώ θα πρέπει να γράψεις το όνομά σου στην ιστορία.
Εδώ θα γίνεις θρύλος...
<br><br>
<span style="font-size:60%; color: #666;">(Story by
Grozoth)</span>
<br><br>
<br><br>
<b>Στοιχεία:</b><i>Για να κλέψετε ένα, πρέπει να συμβούν τα ακόλουθα:</i><br>
<li>Πρέπει να κάνετε επίθεση (ΟΧΙ επιδρομή!)</li>
<li>Πρέπει να ΚΕΡΔΙΣΕΤΕ την επίθεση</li>
<li>Πρέπει να καταστρέψετε το Θησαυροφυλάκιο</li>
<li>Ο Ήρωας πρέπει να συμετάσχει στην επίθεση</li>
<li>ΠΡΕΠΕΙ να έχετε ένα Θησαυροφυλάκιο επίπεδο 10 στο χωριό από το 
οποίο γίνεται η επίθεση</li>
<br><br>
Για να κτίσετε ένα ΠΘ, πρέπει να κατέχετε ένα σχέδιο ο ίδιος 
(ο ίιδος= ο ιδιοκτήτης του χωριού ΠΘ) από το επίπεδο 0 έως το επίπεδο 49 και 
από το επίπεδο 50 μέχρι το επίπεδο 100 χρειάζεστε ένα ακόμα σχέδιο το οποίο
θα ανήκει σε έναν παίκτης της συμμαχίας σας! Δυο σχέδια στον λογαριασμό με 
το χωριό ΠΘ δεν θα λειτουργήσουν!
';
$Definition['Global']['WWConstructStart'] = $Definition['Global']['WWPlansReleaseMessage'];
$Definition['Global']['ArtifactsReleaseMessage'] = <<<HTML_ENTITIES
<div style="width:450px; height:830px; padding: 95px 60px
60px 25px; 
ground:
url(img/Natars_Banner_gross.jpg)
no-repeat;">
        <center>
            <h1>Πολύτιμα Αντικείμενα</h1>
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
$Definition['Global']['GoldPromotionPublicMsg'] = '<font color="#998200" size="4"><b>Προσφορά Πακέτων Χρυσού!!!</b></font><br /><br />Οι προσφορές ισχύουν από %s μέχρι %s.<br /><br />Όλος ο χρυσός που αγοράσατε κατά τη διάρκεια αυτής της περιόδου θα σας δώσει <b>20%%</b> περισσότερο χρυσό από το συνηθισμένο.';
//GoldHelper
$Definition['GoldHelper']['exchangeResources']['exchangeResources'] = 'Ανταλλαγή υλών';
$Definition['GoldHelper']['exchangeResources']['error_in_ww'] = 'Δεν μπορείτε να χρησιμοποιήσετε αυτή τη λειτουργία σε χωριά ΠΘ.';
$Definition['GoldHelper']['exchangeResources']['error_no_marketplace'] = 'Χρειάζεται να κτίστε μια αγορά πρώτα';
$Definition['GoldHelper']['exchangeResources']['error_low_pop'] = 'Πρέπει να φτάσετε τουλάχιστον 40 πληθυσμό για να χρησιμοποιήσετε αυτή την επιλογή';
$Definition['GoldHelper']['exchangeResources']['error_low_resources'] = 'Πρέπει να έχετε τουλάχιστον 50 ύλες.';
//Help
$Definition['Help']['Help system'] = 'Σύστημα βοήθειας';
$Definition['Help']['FAQ - Answers'] = 'FAQ - Απαντήσεις';
$Definition['Help']['Game rules'] = 'Κανόνες παιχνιδιού';
$Definition['Help']['Contact ingame support'] = 'Επικοινωνήστε με το support μέσα στο παιχνίδι';
$Definition['Help']['If you couldn\'t find an answer, contact the ingame support here'] = 'Αν δεν μπορείς να βρεις απάντηση, επικοινώνησε με την υποστήριξη μέσα στο παιχνίδι.';
$Definition['Help']['Plus questions'] = 'Plus ερωτήσεις';
$Definition['Help']['You can ask questions about payment and premium features here'] = 'Εδώ κάνετε ερωτήσεις για πληρωμές και πρόσθετα στοιχεία.';
$Definition['Help']['Forum'] = 'Φόρουμ';
$Definition['Help']['On our Forum, you can meet and converse with other players'] = 'Στο Φόρουμ μας μπορείτε να συναντήσετε και αν συζητήσετε με άλλους παίκτες.';
$Definition['Help']['Short instruction'] = 'Σύντομη παρουσίαση';
$Definition['Help']['Here you can find short explanations about the troops and buildings found in Travian'] = 'Εδώ μπορείτε να βρείτε μια σύντομη εξήγηση σχετικά με τα στρατεύματα και τα κτίρια στο TRAVIAN..';
$Definition['Help']['Interface help'] = 'Βοήθεια περιβάλλοντος χρήστη';
$Definition['Help']['An overview of the user interface with short descriptions of the different functions'] = 'Μια επισκόπηση του περιβάλλοντος χρήστη μαζί με μια μικρή περιγραφή των διαφόρων λειτουργιών.';
$Definition['Help']['Here, you can find the current game rules'] = 'Εδώ μπορείτε να βρείτε τους κανόνες του παιχνιδιού.';
$Definition['Help']['Here, you can find your answers about Travian If you really can\'t find your answer here, you can also contact our ingame support afterwards'] = 'Εδώ μπορείτε να βρείτε την απάντησή σας σχετικά με το TRAVIAN. Επιπλέον, έχετε την δυνατότητα να επικοινωνήσετε με την υποστήριξη μέσα στο παιχνίδι, αν πραγματικά δεν μπορείτε να βρείτε την απάντησή σας.';
$Definition['Help']['inGameSupport'] = [
    'description' => 'Χρησιμοποιώντας το σύστημα βοήθειας στη σελίδα Απαντήσεις, μπορείτε εύκολα να βρείτε απαντήσεις σε όλες τις γενικές ερωτήσεις σχετικά με το Travian γρήγορα και χωρίς να ψάχνετε για μεγάλο χρονικό διάστημα. Επιπλέον, έχετε τη δυνατότητα να επικοινωνήσετε με την υποστήριξη. Μπορεί να πάρει στην υποστήριξή μας μέχρι και 24 ώρες για να απαντήσει στην ερώτησή σας. Για να πάρετε μια ταχύτερη απάντηση, δοκιμάστε τις απαντήσεις.',
    'FAQ - go to Answers' => 'FAQ - μεταβείτε στις Απαντήσεις',
    'I tried Answers but I want to contact the support' => 'Δοκίμασα τις απαντήσεις αλλά θέλω να επικοινωνήσω με την υποστήριξη.',
    'Contact ingame support' => 'Επικοινωνήστε με την υποστήριξη του παιχνιδιού',
];
//Hero
$Definition['Hero'] = ["Attributes" => "Χαρακτηριστικά", "Appearance" => "Εμφάνιση",
    "Adventure" => "Περιπέτειες", "Auction" => "Δημοπρασίες",
    "showInformation" => "Δείξε Πληροφορίες",
    "hideInformation" => "Κρύψε Πληροφορίες", "normal" => "κανονική",
    "hard" => "δύσκολη",
];
//HeroAdventure
$Definition['HeroAdventure']['Duration to the adventure'] = 'Διάρκεια περιπέτειας';
$Definition['HeroAdventure']['Arrival in: %s hrs | Return in: %s hrs'] = 'Άφιξη σε: %s ώρες | Επιστροφή σε: %s ώρες';
$Definition['HeroAdventure']['No rallyPoint'] = 'Δεν υπάρχει πλατεία συγκέντρωσης στο χωριό του ήρωα.';
$Definition['HeroAdventure']['headerAdventures'] = 'Διαθέσιμες περιπέτειες';
$Definition['HeroAdventure']['location'] = 'Μέρος';
$Definition['HeroAdventure']['moveTime'] = 'Διάρκεια';
$Definition['HeroAdventure']['difficulty'] = 'Κίνδυνος';
$Definition['HeroAdventure']['timeLeft'] = 'Εναπομείναν χρόνος';
$Definition['HeroAdventure']['goTo'] = 'Link';
$Definition['HeroAdventure']['gotoAdventure'] = 'Προς την περιπέτεια.';
$Definition['HeroAdventure']['normal'] = 'Κανονική';
$Definition['HeroAdventure']['hard'] = 'Δύσκολη';
$Definition['HeroAdventure']['wald'] = 'Δάσος';
$Definition['HeroAdventure']['clay'] = 'Πηλός';
$Definition['HeroAdventure']['hill'] = 'Λόφος';
$Definition['HeroAdventure']['lake'] = 'Λίμνη';
$Definition['HeroAdventure']['adventure_dif_hard'] = 'Δύσκολη περιπέτεια';
$Definition['HeroAdventure']['adventure_dif_normal'] = 'Κανονική περιπέτεια';
$Definition['HeroAdventure']['natarsLandscape'] = 'Εγκαταλειμμένη κοιλάδα';
$Definition['HeroAdventure']['natars'] = 'Νατάριοι';
$Definition['HeroAdventure']['adventure'] = 'Περιπέτεια';
$Definition['HeroAdventure']['unOccupiedOasis'] = 'Όαση';
$Definition['HeroAdventure']['ok'] = 'OK';
$Definition['HeroAdventure']['no adventures'] = 'Δεν βρέθηκε περιπέτεια.';
$Definition['HeroAdventure']['Hero not available'] = 'Ο ήρωας δεν είναι διαθέσιμος.';
$Definition['HeroAdventure']['Hero is stationed in village'] = 'Ο Ήρωας είναι εγκατεστημένος στο χωριό';
$Definition['HeroAdventure']['Hero is not in selected village at the moment'] = 'Ο ήρωας δεν βρίσκεται σε επιλεγμένο χωριό αυτή τη στιγμή';
$Definition['HeroAdventure']['StartAdventure'] = 'Άρχισε περιπέτεια';
$Definition['HeroAdventure']['back'] = 'πίσω';
$Definition['HeroAdventure']['rallyPointNeeded'] = 'Το επιλεγμένο χωριό δεν έχει Πλατεία συγκεντρώσεως!';
$Definition['HeroAdventure']['Send hero to village'] = 'Στείλτε τον ήρωα στο χωριό';
$Definition['HeroAdventure']['Travel time to village'] = 'Χρόνος που απαιτείται για το χωριό';
$Definition['HeroAdventure']['Revive hero first'] = 'Αναζωογονήστε πρώτα τον ήρωα';
$Definition['HeroAdventure']['The Hero must be stationed in the selected village first in order to start an adventure from there'] = 'Ο ήρωας πρέπει να βρίσκεται στο επιλεγμένο χωριό για να αρχίσει μια περιπέτεια από εκεί.';
$Definition['HeroAdventure']['Travel time calculation for other villages'] = 'Υπολογισμός διάρκειας για άλλα χωριά';
$Definition['HeroAdventure']['Show travel time calculation for other villages'] = 'Δείξε τον υπολογισμό του χρόνου ταξιδιού για άλλα χωριά';
$Definition['HeroAdventure']['Hide travel time calculation for other villages'] = 'Κρύψε τον υπολογισμό του χρόνου ταξιδιού για άλλα χωριά';
$Definition['HeroAdventure']['Hero on his way'] = 'Ο ήρωας είναι στο δρόμο';
//HeroFace
$Definition['HeroFace'] = ["Gender" => "Γένος", "male" => "άντρας",
    "female" => "γυναίκα", "save" => "Αποθήκευση",
    "random" => "Τυχαίο", "headProfile" => "κεφάλι",
    "hairColor" => "χρώμα μαλλιών", "hairStyle" => "στυλ μαλλιών",
    "ears" => "αυτιά", "eyebrow" => "φρύδια",
    "eyes" => "μάτια", "nose" => "μύτη", "mouth" => "στόμα",
    "beard" => "γενειάδα",
];
//Hero Global
$Definition['HeroGlobal']['HeroOverview'] = 'Επισκόπηση Ήρωα';
$Definition['HeroGlobal']['health'] = 'Υγεία';
$Definition['HeroGlobal']['Experience'] = 'Εμπειρία';
$Definition['HeroGlobal']['Appear'] = 'Εμφάνιση';
$Definition['HeroGlobal']['Attributes'] = 'Χαρακτηριστικά';
$Definition['HeroGlobal']['showInformation'] = 'Δείξε περισσότερες πληροφορίες';
$Definition['HeroGlobal']['hideInformation'] = 'Κρύψε περισσότερες πληροφορίες';
$Definition['HeroGlobal']['available_adventures:'] = 'Διαθέσιμες περιπέτειες:';
$Definition['HeroGlobal']['next adventure will expire in:'] = 'Η επόμενη περιπέτεια λήγει σε: %s';
$Definition['HeroGlobal']['Auctions'] = 'Δημοπρασίες';
$Definition['HeroGlobal']['Auctions with maximum bid:'] = 'Δημοπρασίες που έχεις μέγιστη προσφορά:';
$Definition['HeroGlobal']['Auctions which you got outbid:'] = 'Δημοπρασίες που κάλυψαν την προσφορά σου:';
$Definition['HeroGlobal']['Adventure'] = 'Περιπέτειες';
$Definition['HeroGlobal']['Tooltip loading'] = 'Φόρτωση δεδομένων...';
$Definition['HeroGlobal']['shortStatus']['Home'] = '	στο χωριό βάση';
$Definition['HeroGlobal']['shortStatus']['defending'] = 'αμύνετε';
$Definition['HeroGlobal']['shortStatus']['trapped'] = 'παγιδευμένος';
$Definition['HeroGlobal']['shortStatus']['dead'] = 'Νεκρός';
$Definition['HeroGlobal']['shortStatus']['return'] = 'στο δρόμο';
$Definition['HeroGlobal']['shortStatus']['adventure'] = 'στο δρόμο';
$Definition['HeroGlobal']['shortStatus']['reinforcement'] = 'στο δρόμο';
$Definition['HeroGlobal']['shortStatus']['attack'] = 'στο δρόμο';
$Definition['HeroGlobal']['shortStatus']['escape'] = 'στο δρόμο';
$Definition['HeroGlobal']['shortStatus']['reviving'] = 'Αναγεννιέται';
$Definition['HeroGlobal']['longStatus']['Home'] = 'Ο Ήρωας βρήσκεται στο χωριό βάση %s.';
$Definition['HeroGlobal']['longStatus']['defending'] = 'Ο ήρωας σας αμύνετε στο χωριό %s.';
$Definition['HeroGlobal']['longStatus']['trapped'] = 'Ο ήρωας σας φυλακίστηκε στο χωριό %s.';
$Definition['HeroGlobal']['longStatus']['dead'] = 'Ο ήρωας είναι νεκρός.';
$Definition['HeroGlobal']['longStatus']['return'] = 'Ο ήρωας επιστρέφει στο χωριό %s.';
$Definition['HeroGlobal']['longStatus']['return'] .= 'Άφιξη σε %s στις %s.';
$Definition['HeroGlobal']['longStatus']['adventure'] = 'Ο ήρωας πηγαίνει σε μια περιπέτεια στο %s';
$Definition['HeroGlobal']['longStatus']['reinforcement'] = 'Το χωριό βάσης είναι %s. Ο ήρωας βρίσκεται στο δρόμο.';
$Definition['HeroGlobal']['longStatus']['reinforcement'] .= 'Άφιξη σε %s στις %s.';
$Definition['HeroGlobal']['longStatus']['attack'] = 'Το χωριό βάσης είναι %s. Ο ήρωας βρίσκεται στο δρόμο.';
$Definition['HeroGlobal']['longStatus']['attack'] .= 'Άφιξη σε %s στις %s.';
$Definition['HeroGlobal']['longStatus']['escape'] = 'Ο ήρωας βρίσκεται σε διαφυγή';
$Definition['HeroGlobal']['longStatus']['escape'] .= 'Άφιξη σε %s στις %s.';
$Definition['HeroGlobal']['longStatus']['reviving'] = 'Ο ήρωας αναγεννιέται στο χωριό';
$Definition['HeroGlobal']['inventoryStatus']['Home'] = 'Ο Ήρωας είναι στο χωριό βάση <a href="karte.php?d=%s">%s</a>.';
$Definition['HeroGlobal']['inventoryStatus']['defending'] = 'Ο ήρωας μας αμύνεται στο χωριό <a href="karte.php?d=%s">%s</a>.';
$Definition['HeroGlobal']['inventoryStatus']['trapped'] = 'Ο ήρωας σας έχει φυλακιστεί στο χωριό <a href="karte.php?d=%s">%s</a>.';
$Definition['HeroGlobal']['inventoryStatus']['dead'] = 'Ο ήρωας είναι νεκρός.';
$Definition['HeroGlobal']['inventoryStatus']['return'] = 'Ο ήρωας επιστρέφει στο χωριό <a href="karte.php?d=%s">%s</a>.';
$Definition['HeroGlobal']['inventoryStatus']['return'] .= 'Άφιξη σε %s στις %s.';
$Definition['HeroGlobal']['inventoryStatus']['adventure'] = 'Ο ήρωας πηγαίνει σε μια περιπέτεια στο %s. Άφιξη σε %s στις %s.';
$Definition['HeroGlobal']['inventoryStatus']['adventure'] .= '<div class="subMessage"> (Τις περιπέτειες σε εξέλιξη μπορείτε να τις δείτε στο <a href="build.php?gid=16&amp;tt=1&amp;newdid=%s">Πλατεία συγκεντρώσεως</a>.) </div>';
$Definition['HeroGlobal']['inventoryStatus']['reinforcement'] = 'Το χωριό βάσης είναι <a href="karte.php?d=%s">%s</a>. Ο ήρωας βρίσκεται στο δρόμο.';
$Definition['HeroGlobal']['inventoryStatus']['reinforcement'] .= 'Άφιξη σε %s στις %s.';
$Definition['HeroGlobal']['inventoryStatus']['attack'] = 'Το χωριό βάσης είναι <a href="karte.php?d=%s">%s</a>. Ο ήρωας βρίσκεται στο δρόμο.';
$Definition['HeroGlobal']['inventoryStatus']['attack'] .= 'Άφιξη σε %s στις %s.';
$Definition['HeroGlobal']['inventoryStatus']['escape'] = 'Ο ήρωας βρίσκεται σε διαφυγή';
$Definition['HeroGlobal']['inventoryStatus']['escape'] .= 'Άφιξη σε %s στις %s.';
$Definition['HeroGlobal']['inventoryStatus']['reviving'] = 'Ο ήρωάς σας αναγεννάται στο χωριό <a href="karte.php?d=%s">%s</a>';
$Definition['HeroGlobal']['inventoryStatus']['reviving'] .= ' Αναγεννιέται σε:';
//HeroInventory
$Definition['HeroInventory'] = [
    "loyaltyIsMaxYourCannotIncreaseItMore" => "Your village loyalty is maxed. You can`t increase it anymore.",
    "HeroAliveAndCannotUseBucket" => "Ο ήρωας είναι ζωντανός. Γι αυτό δεν μπορείτε να χρησιμοποιήσετε αυτό το αντικείμενο.",
    "YourHeroWillBeAliveImmediatelyAndOneWaterBucketWillBeUsedAndNoResourcesWillBeRefunded" => "You hero will be alive immediately. One waterbucket will be used and the resources will not be refunded.",

    "YouCannotUseThisItemCurrently" => "Δεν μπορείτε αν χρησιμοποιήσετε αυτό το αντικείμενο αυτήν την στιγμή.",
    "waterBucketsUsed" => "Έχετε χρησιμοποιήσει το μέγιστο αριθμό δοχείων νερού ανα ημέρα.",
    "currentHeroExperience" => "Τρέχουσα εμπειρία του ήρωα",
    "heroExperienceGainFromItems" => "Εμπειρία που αποκτήθηκε από το αντικείμενο",
    "heroExperienceAfterUse" => "Εμπειρία ήρωα μετά τη χρήση",
    "currentCulturePoints" => "Τρέχοντες πόντοι πολιτισμού",
    "culturePointsGainFromItems" => "Πόντοι πολιτισμού που αποκτήθηκαν με τη χρήση του καλυτεχνήματος",
    "culturePointsAfterUsage" => "Πόντοι πολιτισμού μετά τη χρήση",
    "heroLevel" => "Επίπεδο ήρωα",
    "RomanSpecialHeroAttribute" => "Ο ήρωάς σας θα πάρει δύναμη επίθεσης %s για κάθε πόντο.",
    "TeutonSpecialHeroAttribute" => "Όταν ο ήρωας είναι με στρατεύματα, θα έχετε %s μπόνους επιδρομής.",
    "GualSpecialHeroAttribute" => "Εάν ο ήρωάς σας είναι ιππικό, θα έχετε %s περισσότερη ταχύτητα.",
    "notMoveableText" => 'Ο ήρωάς σας είναι νεκρός ή δεν βρίσκεται στο χωριό, έτσι δεν μπορείτε να χρησιμοποιήσετε αυτό το αντικείμενο τώρα.',
    "notMoveableTextDead" => 'Δεν μπορείτε να χρησιμοποιήσετε αυτό το στοιχείο. Αναζωογονήστε πρώτα τον ήρωά σας.',
    "moveDialogDescription" => "Αριθμός αντικειμένων",
    "useDialogDescription" => "Αριθμός αντικειμένων προς χρήση",
    "useOneDialogTitle" => "Θέλετε πραγματικά να χρησιμοποιήσετε αυτό το αντικείμενο;",
    "moveDialogTitle" => "Μετακίνηση",
    "useDialogTitle" => "Χρήση",
    "buttonOk" => "OK",
    "buttonCancel" => "Ακύρωση",
    "save" => "Αποθήκευση αλλαγών",
    "Body" => "Σώμα",
    "BuyItem" => "Αγοράστε αντικείμενα",
    "sellItem" => "Πουλήστε αντικείμενα",
    "productBonus" => "Ύλες",
    "increaseOfProduction" => "Αύξηση της παραγωγής",
    "productBonusDesc" => "Αυξάνει την παραγωγή υλών του χωριού όπου κατοικεί ο ήρωας.",
    "defBonus" => "Αμυν. μπόνους",
    "defBonusDesc" => "Αυξάνει την αμυντική δύναμη όλων των στρατευμάτων που βρίσκονται με τον ήρωα.",
    "offBonus" => "Επιθ. μπόνους",
    "offBonusDesc" => "Αυξάνει την επιθετική δύναμη όλων των επιτιθέμενων στρατευμάτων που συνοδεύουν τον ήρωα.",
    "fightingStrength" => "Δύναμη μάχης",
    "fightingStrengthDesc" => "Η δύναμη μάχης του ήρωα συνδυάζει τη αμυντική και επιθετική του δύναμη. Όσο υψηλότερη η τιμή της επιθετικής δύναμης, τόσο λιγότερη ζημιά παθαίνει στις περιπέτειες.",
    "attackBehaviourSettings" => "κρύψε τον Ήρωα",
    "availablePoints" => "Διαθέσιμοι πόντοι",
    "SaveChanges" => "Παρακαλώ αποθηκεύστε τις αλλαγές σας.",
    "HeroHideDesc" => "Ο Ήρωας θα κρυφτεί σε μια επίθεση σε αυτό το χωριό.",
    "HeroShowDesc" => "Ο ήρωας μένει πάντα με τα στρατεύματα.",
    "ReviveHeroInVillage" => "Για να τον αναγεννήσεις σε διαφορετικό χωριό, αλλάξτε το επιθυμητό χωριό και ξεκινήστε την αναγέννηση εκεί.",
    "ResourcesRequiredToReviveHero" => "Ύλες που απαιτούνται για την αναγέννηση του ήρωα",
    'HeroReviveInVillageDescription' => 'Το χωριό του ήρωα πριν σκοτωθεί ήταν <a href="karte.php?d=%s">%s</a>. Ο ήρωας θα αναγέννηθει στο χωριό <a href="karte.php?d=%s">%s</a>.',
    "EnoughResourcesAt" => "Αρκετές ύλες την",
    "changeResourcesHeadline" => "Αλλαγή παραγωγής υλών του ήρωα",
    "Regenerate" => "Αναγένησε τον ήρωα",
    "health" => "Υγεία",
    "heroRegenerationRate" => "Η τρέχουσα αναγέννηση του ήρωα",
    "perDay" => "τη μέρα",
    "fromHero" => "από τον ήρωα",
    "fromItem" => "από τον εξοπλισμό",
    "experience" => "Εμπειρία",
    "experienceNeededToNextLevel" => "Ο ήρωας χρειάζεται %s εμπειρία για να φτάσει στο επίπεδο %s.",
    "speed" => "Ταχύτητα",
    "speedOfYourHero" => "Ταχύτητα",
    "fieldPerHour" => "Πεδία/ώρα",
    "fromHorse" => "Πεδία/ώρα από το άλογο",
    "HeroProduction" => "Παραγωγή ήρωα ",
    "currentHeroProduction" => "Τρέχουσα παραγωγή του ήρωα",
    "Bonus" => "Μπόνους",
    "Percent" => "Ποσοστό", "level" => "επίπεδο",
    'heroExperienceBonus' => 'Bonus',

];
//HeroItems
$Definition['HeroItems'] = [
    1 => [
            1 => [
            "name" => "Κράνος της Επίγνωσης",
            "title" => "%s&#37;+ περισσότερη εμπειρία",
        ], 2 => [
            "name" => "Κράνος της Διαφώτισης",
            "title" => "%s&#37;+ περισσότερη εμπειρία",
        ], 3 => [
            "name" => "Κράνος της Σοφίας",
            "title" => "%s&#37;+ περισσότερη εμπειρία",
        ], 4 => [
            "name" => "Κράνος της Αναγέννησης",
            "title" => "%s+ Πόντοι υγείας ανα ημέρα",
        ], 5 => [
            "name" => "Κράνος της Υγείας",
            "title" => "%s+ Πόντοι υγείας ανα ημέρα",
        ], 6 => [
            "name" => "Κράνος της Θεραπείας",
            "title" => "%s+ Πόντοι υγείας την ημέρα",
        ], 7 => [
            "name" => "Κράνος του Μονομάχου",
            "title" => "%s+ Πόντοι Πολιτισμού ανα ημέρα",
        ], 8 => [
            "name" => "Κράνος του Θρόνου",
            "title" => "%s+ Πόντοι Πολιτισμού ανα ημέρα",
        ], 9 => [
            "name" => "Κράνος του Ύπατου",
            "title" => "%s+ Πόντοι Πολιτισμού ανα ημέρα",
        ], 10 => [
            "name" => "Κράνος του Ιππέα",
            "title" => "Μείωση χρόνου εκπαίδευσης στον στάβλο κατά 10%.",
        ], 11 => [
            "name" => "Κράνος του Ιππικού",
            "title" => "Μείωση χρόνου εκπαίδευσης στον στάβλο κατά 15%.",
        ], 12 => [
            "name" => "Κράνος του βαρύ Ιππικού",
            "title" => "Μείωση χρόνου εκπαίδευσης στον στάβλο κατά 20%.",
        ], 13 => [
            "name" => "Κράνος του Μισθοφόρου",
            "title" => "Η στρατολόγηση στο στρατόπεδο μειώνεται κατά 10%.",
        ], 14 => [
            "name" => "Κράνος του Πολεμιστή",
            "title" => "Η στρατολόγηση στο στρατόπεδο μειώνεται κατά 15%.",
        ], 15 => [
            "name" => "Κράνος του Άρχοντα",
            "title" => "Η στρατολόγηση στο στρατόπεδο μειώνεται κατά 20%.",
        ],
    ], 2 => [
        82 => [
            "name" => "Πανοπλία της Αναγέννησης",
            "title" => "%s+ πόντοι υγείας την ημέρα",
        ], 83 => [
            "name" => "Πανοπλία της Υγείας",
            "title" => "%s+ πόντοι υγείας την ημέρα",
        ], 84 => [
            "name" => "Πανοπλία της Θεραπείας",
            "title" => "%s+ πόντοι υγείας την ημέρα",
        ], 85 => [
            "name" => "Ελαφριά κλιμακωτή πανοπλία",
            "title" => "%s πόντους υγείας λιγότερη φθορά για κάθε επίθεση,<br />%s πόντοι υγείας την ημέρα.",
        ], 86 => [
            "name" => "Κλιμακωτή πανοπλία",
            "title" => "%s πόντους υγείας λιγότερη φθορά για κάθε επίθεση,<br />%s πόντοι υγείας την ημέρα.",
        ], 87 => [
            "name" => "Βαριά κλιμακωτή πανοπλία",
            "title" => "%s πόντους υγείας λιγότερη φθορά για κάθε επίθεση,<br />%s πόντοι υγείας την ημέρα.",
        ], 88 => [
            "name" => "Ελαφριά πανοπλία θώρακος",
            "title" => "%s+ δύναμη μάχης για τον ήρωα.",
        ], 89 => [
            "name" => "Πανοπλία θώρακος",
            "title" => "%s+ δύναμη μάχης για τον ήρωα.",
        ], 90 => [
            "name" => "Βαριά πανοπλία θώρακος",
            "title" => "%s+ δύναμη μάχης για τον ήρωα.",
        ], 91 => [
            "name" => "Ελαφριά αρθρωτή πανοπλία",
            "title" => "%s μονάδες περισσότερη δύναμη μάχης για τον ήρωα.<br />%s πόντους υγείας λιγότερη φθορά για κάθε επίθεση.",
        ], 92 => [
            "name" => "Αρθρωτή πανοπλία",
            "title" => "%s μονάδες περισσότερη δύναμη μάχης για τον ήρωα.<br />%s πόντους υγείας λιγότερη φθορά για κάθε επίθεση.",
        ], 93 => [
            "name" => "Βαριά αρθρωτή πανοπλία",
            "title" => "%s μονάδες περισσότερη δύναμη μάχης για τον ήρωα.<br />%s πόντους υγείας λιγότερη φθορά για κάθε επίθεση.",
        ],
    ], 3 => [
        61 => [
            "name" => "Μικρός χάρτης",
            "title" => "%s&#37; γρηγορότερη επιστροφή (ισχύει για τον ήρωα και όλα τα στρατεύματα που είναι μαζί του)",
        ], 62 => [
            "name" => "Χάρτης", "title" => "%s&#37; γρηγορότερη επιστροφή (ισχύει για τον ήρωα και όλα τα στρατεύματα που είναι μαζί του)",
        ], 63 => [
            "name" => "Μεγάλος χάρτης",
            "title" => "%s&#37; γρηγορότερη επιστροφή (ισχύει για τον ήρωα και όλα τα στρατεύματα που είναι μαζί του)",
        ], 64 => [
            "name" => "Μικρό Παράσημο",
            "title" => "%s&#37; γρηγορότερα στρατεύματα μεταξύ των χωριών σας.",
        ], 65 => [
            "name" => "Παράσημο",
            "title" => "%s&#37; γρηγορότερα στρατεύματα μεταξύ των χωριών σας.",
        ], 66 => [
            "name" => "Μεγάλο Παράσημο",
            "title" => "%s&#37; γρηγορότερα στρατεύματα μεταξύ των χωριών σας.",
        ], 67 => [
            "name" => "Μικρό Λάβαρο",
            "title" => "%s&#37; γρηγορότερα στρατεύματα μεταξύ μελών της στυμαχίας",
        ], 68 => [
            "name" => "Λάβαρο",
            "title" => "%s&#37; γρηγορότερα στρατεύματα μεταξύ μελών της στυμαχίας",
        ], 69 => [
            "name" => "Μεγάλο Λάβαρο",
            "title" => "%s&#37; γρηγορότερα στρατεύματα μεταξύ μελών της στυμαχίας",
        ], 73 => [
            "name" => "Σακούλι του κλέφτη",
            "title" => "%s&#37;+ επίδομα λεηλασίας",
        ], 74 => [
            "name" => "Σάκος του κλέφτη",
            "title" => "%s&#37;+ επίδομα λεηλασίας"
        ], 75 => [
            "name" => "Τσάντα του κλέφτη",
            "title" => "%s&#37;+ επίδομα λεηλασίας",
        ], 76 => [
            "name" => "Μικρή ασπίδα",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα.",
        ], 77 => [
            "name" => "Ασπίδα",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα.",
        ], 78 => [
            "name" => "Μεγάλη ασπίδα",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα.",
        ], 79 => [
            "name" => "Μικρό κέρας του Νατάριου",
            "title" => "%s&#37;+ δύναμη μάχης ενάντια σε Νατάριους (ισχύει μόνο σε επιθέσεις εναντίον Νατάριων και όχι σε άμυνα).",
        ], 80 => [
            "name" => "Κέρας του Νατάριου",
            "title" => "%s&#37;+ δύναμη μάχης ενάντια σε Νατάριους (ισχύει μόνο σε επιθέσεις εναντίον Νατάριων και όχι σε άμυνα).",
        ], 81 => [
            "name" => "Μεγάλο κέρας του Νατάριου",
            "title" => "%s&#37;+ δύναμη μάχης ενάντια σε Νατάριους (ισχύει μόνο σε επιθέσεις εναντίον Νατάριων και όχι σε άμυνα).",
        ],
    ], 4 => [
        16 => [
            "name" => "Μικρό σπαθί του Λεγεωνάριου",
            "title" => "%s+ δύναμη μαχης για των Ήρωα;<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Λεγεωνάριο.",
        ], 17 => [
            "name" => "Σπαθί του Λεγεωνάριου",
            "title" => "%s+ δύναμη μάχης για των Ήρωα;<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Λεγεωνάριο.",
        ], 18 => [
            "name" => "Μεγάλο σπαθί του Λεγεωνάριου",
            "title" => "%s+ δύναμη μάχης για των Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Λεγεωνάριο.",
        ], 19 => [//start
            "name" => "Μικρό σπαθί του Πραιτοριανού",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα;<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Πραιτοριανό.",
        ], 20 => [
            "name" => "Σπαθί του Πραιτοριανού",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Πραιτοριανό.",
        ], 21 => [
            "name" => "Μεγάλο σπαθί του Πραιτοριανού",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Πραιτοριανό.",
        ], 22 => [
            "name" => "Μικρό σπαθί του Ιμπεριανού",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Ιμπεριανό.",
        ], 23 => [
            "name" => "Σπαθί του Ιμπρριανού",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Ιμπεριανό.",
        ], 24 => [
            "name" => "Μεγάλο σπαθί του Ιμπεριανού",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Ιμπεριανό.",
        ], 25 => [
            "name" => "Μικρό σπαθί του Imperatoris",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Equites Imperatoris",
        ], 26 => [
            "name" => "Σπαθί του Imperatoris",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Equites Imperatoris",
        ], 27 => [
            "name" => "Μεγάλο σπαθί του Imperatoris",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Equites Imperatoris",
        ], 28 => [
            "name" => "Ελαφρύ δόρυ του Caesaris",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Equites Caesaris",
        ], 29 => [
            "name" => "Δόρυ του Caesaris",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Equites Caesaris",
        ], 30 => [
            "name" => "Βαρύ δόρυ του Caesaris",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Equites Caesaris",
        ], 31 => [
            "name" => "Λόγχη της Φάλαγγας",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Φάλαγγα.",
        ], 32 => [
            "name" => "Ακόντιο της Φάλαγγας",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Φάλαγγα.",
        ], 33 => [
            "name" => "Δόρυ της Φάλαγγας",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Φάλαγγα.",
        ], 34 => [
            "name" => "Μικρό σπαθί του Μαχητή με ξίφος",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Μαχητή με ξίφος",
        ], 35 => [
            "name" => "Σπαθί του Μαχητή με ξίφος",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Μαχητή με ξίφος",
        ], 36 => [
            "name" => "Μεγάλο σπαθί του μαχητή με ξίφος",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Μαχητή με ξίφος",
        ], 37 => [
            "name" => "Μικρό τόξο του Τουτατή",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Αστραπή του Τουτατή.",
        ], 38 => [
            "name" => "Τόξο του Τουτατή",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Αστραπή του Τουτατή.",
        ], 39 => [
            "name" => "Μεγάλο τόξο του Τουτατή",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Αστραπή του Τουτατή.",
        ], 40 => [
            "name" => "Περιπατητικό ραβδί του Δρουίδη",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Δρουίδη.",
        ], 41 => [
            "name" => "Ραβδί του Δρουίδη",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Δρουίδη.",
        ], 42 => [
            "name" => "Ραβδί μάχης του Δρουίδη",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Δρουίδη.",
        ], 43 => [
            "name" => "Μικρό δόρυ του Ιδουανού",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Ιδουανό.",
        ], 44 => [
            "name" => "Δόρυ του Ιδουανού",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Ιδουανό.",
        ], 45 => [
            "name" => "Μεγάλο δόρυ του Ιδουανού",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Ιδουανό.",
        ], 46 => [
            "name" => "Ρόπαλο του Μαχητή με Ρόπαλο",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Μαχητή με Ρόπαλο.",
        ], 47 => [
            "name" => "Ακανθωτό ρόπαλο του Μαχητή με Ρόπαλο",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Μαχητή με Ρόπαλο.",
        ], 48 => [
            "name" => "Αλυσιδωτή μπάλα του Μαχητή με Ρόπαλο",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Μαχητή με Ρόπαλο.",
        ], 49 => [
            "name" => "Λόγχη του Μαχητή με Ακόντιο",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Μαχητή με Ακόντιο.",
        ], 50 => [
            "name" => "Ακόντιο του Μαχητή με Ακόντιο",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Μαχητή με Ακόντιο.",
        ], 51 => [
            "name" => "Δόρυ του Μαχητή με Ακόντιο",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Μαχητή με Ακόντιο.",
        ], 52 => [
            "name" => "Τσεκουράκι του Μαχητή με Τσεκούρι",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Τσεκούρι.",
        ], 53 => [
            "name" => "Τσεκούρι του Μαχητή με Τσεκούρι",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Τσεκούρι.",
        ], 54 => [
            "name" => "Πολεμικό τσεκούρι του Μαχητή με Τσεκούρι",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Τσεκούρι.",
        ], 55 => [
            "name" => "Ελαφρύ σφυρί του Παλατινού",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Παλατινό.",
        ], 56 => [
            "name" => "Σφυρί του Παλατινού",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Παλατινό.",
        ], 57 => [
            "name" => "Βαρύ σφυρί του Παλατινού",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Παλατινό.",
        ], 58 => [
            "name" => "Μικρό σπαθί του Τεύτονα Ιππότη",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Τεύτονα Ιππότη.",
        ], 59 => [
            "name" => "Σπαθί του Τεύτονα Ιππότη",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Τεύτονα Ιππότη.",
        ], 60 => [
            "name" => "Μεγάλο σπαθί του Τεύτονα Ιππότη",
            "title" => "%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Τεύτονα Ιππότη.",

        ], 115 => [ //start
            'name' => 'Ρόπαλο της Πολιτοφυλακής σκλάβων',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Πολιτοφυλακή σκλάβων',
        ], 116 => [
            'name' => 'Mace της Πολιτοφυλακής σκλάβων',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Πολιτοφυλακή σκλάβων',
        ], 117 => [
            'name' => 'Morning Star της Πολιτοφυλακής σκλάβων',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Πολιτοφυλακή σκλάβων',
        ], 118 => [ //start
            'name' => 'Hatchet of the Ash Warden',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Φύλακα της τέφρας',
        ], 119 => [
            'name' => 'Axe of the Ash Warden',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Φύλακα της τέφρας',
        ], 120 => [
            'name' => 'Battle Axe of the Ash Warden',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Φύλακα της τέφρας',
        ], 121 => [//start
            'name' => 'Κοντή κοπίς του Πολεμιστή',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Πολεμιστή',
        ], 122 => [
            'name' => 'Κοπίς του Πολεμιστή',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Πολεμιστή',
        ], 123 => [
            'name' => 'Μακριά κοπίς του Πολεμιστή',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Πολεμιστή',
        ], 124 => [//start
            'name' => 'Μικρό δόρυ του Φύλακα Anhor',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Φύλακα Anhor',
        ], 125 => [
            'name' => 'Δόρυ του Φύλακα Anhor',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Φύλακα Anhor',
        ], 126 => [
            'name' => 'Μακρύ δόρυ του Φύλακα Anhor',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Φύλακα Anhor',
        ], 127 => [//start
            'name' => 'Μικρό τόξο του Άρματος Resheph',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Άρμα Resheph',
        ], 128 => [
            'name' => 'Τόξο του Άρματος Resheph',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Άρμα Resheph',
        ], 129 => [
            'name' => 'Μακρύ τόξο του Άρματος Resheph',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Άρμα Resheph',
        ], 130 => [ //start
            'name' => 'Μικρός πέλεκυς του Μισθοφόρου',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Μισθοφόρο',
        ], 131 => [
            'name' => 'Πέλεκυς του Μισθοφόρου',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Μισθοφόρο',
        ], 132 => [
            'name' => 'Πολεμικός πέλεκυς του Μισθοφόρου',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Μισθοφόρο',
        ], 133 => [ //start
            'name' => 'Μικρό Σύνθετο τόξο του Τοξότη',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Τοξότη',
        ], 134 => [
            'name' => 'Σύνθετο τόξο του Τοξότη',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Τοξότη',
        ], 135 => [
            'name' => 'Μεγάλο Σύνθετο τόξο του Τοξότη',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Τοξότη',
        ], 136 => [ //start
            'name' => 'Κοντή σπάθα του Καβαλάρη της Στέπας',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Καβαλάρη της Στέπας',
        ], 137 => [
            'name' => 'Σπάθα του Καβαλάρη της Στέπας',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Καβαλάρη της Στέπας',
        ], 138 => [
            'name' => 'Μεγάλη σπάθα του Καβαλάρη της Στέπας',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Καβαλάρη της Στέπας',
        ], 139 => [ //start
            'name' => 'Μικρό Σύνθετο τόξο του Επίλεκτου τοξότη',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Επίλεκτο τοξότη',
        ], 140 => [
            'name' => 'Σύνθετο τόξο του Επίλεκτου τοξότη',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Επίλεκτο τοξότη',
        ], 141 => [
            'name' => 'Μεγάλο Σύνθετο τόξο του Επίλεκτου τοξότη',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Επίλεκτο τοξότη',
        ], 142 => [ //start
            'name' => 'Short Spatha Sword of the Marauder',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Επιδρομέα',
        ], 143 => [
            'name' => 'Spatha Sword of the Marauder',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Επιδρομέα',
        ], 144 => [
            'name' => 'Long Spatha Sword of the Marauder',
            'title' => '%s+ δύναμη μάχης για τον Ήρωα<br />επιπλέον +%s επίθεση και +%s άμυνα για κάθε Επιδρομέα',
        ],
    ], 5 => [
        94 => [
            "name" => "Μπότες της Αναγέννησης", "title" => "%s+ ΠΥ/ημέρα",
        ], 95 => [
            "name" => "Μπότες της Υγείας", "title" => "%s+ ΠΥ/ημέρα",
        ], 96 => [
            "name" => "Μπότες της Θεραπείας", "title" => "%s+ ΠΥ/ημέρα",
        ], 97 => [
            "name" => "Μπότες του Μισθοφόρου",
            "title" => "%s&#37;+ ταχύτητα στην βασική ταχύτητα του στρατού για αποστάσεις %s πεδία.",
        ], 98 => [
            "name" => "Μπότες του Πολεμιστή",
            "title" => "%s&#37;+ ταχύτητα στην βασική ταχύτητα του στρατού για αποστάσεις %s πεδία.",
        ], 99 => [
            "name" => "Μπότες του Άρχοντα",
            "title" => "%s&#37;+ ταχύτητα στην βασική ταχύτητα του στρατού για αποστάσεις %s πεδία.",
        ], 100 => [
            "name" => "Μικρά σπιρούνια",
            "title" => "%s+ πεδία την ώρα σε έναν 1x ταχύτητας server(+6 πεδία την ώρα σε έναν 3x ταχύτητας server)",
        ], 101 => [
            "name" => "Σπιρούνια",
            "title" => "%s+ πεδία την ώρα σε έναν 1x ταχύτητας server(+8 πεδία την ώρα σε έναν 3x ταχύτητας server)",
        ], 102 => [
            "name" => "Μεγάλα σπιρούνια",
            "title" => "%s+ πεδία την ώρα σε έναν 1x ταχύτητας server(+10 πεδία την ώρα σε έναν 3x ταχύτητας server)",
        ],
    ], 6 => [
        103 => [
            "name" => "Ήρεμο άλογο",
			"title" => "%s+ Η ταχύτητα του ήρωα αυξάνει σε 14 πεδία την ώρα σε έναν 1x ταχύτητας server (σε 28 πεδία την ώρα σε έναν 3x ταχύτητας server).",
        ], 104 => [
            "name" => "Καθαρόαιμο άλογο",
            "title" => "%s+ Η ταχύτητα του ήρωα αυξάνει σε 17 πεδία την ώρα σε έναν 1x ταχύτητας server (σε 34 πεδία την ώρα σε έναν 3x ταχύτητας server).",
        ], 105 => [
            "name" => "Πολεμικό άλογο",
			"title" => "%s+ Η ταχύτητα του ήρωα αυξάνει σε 20 πεδία την ώρα σε έναν 1x ταχύτητας server (σε 40 πεδία την ώρα σε έναν 3x ταχύτητας server).",
        ],
    ], 7 => [
        112 => [
            "name" => "Μικρός επίδεσμος",
            "title" => "Οι εξοπλισμένοι επίδεσμοι θεραπεύουν το πολύ το 25&#37; των απωλειών αμέσως μετά από μια μάχη. Μπορείτε να θεραπεύσετε μόνο την ποσότητα των στρατευμάτων για τα οποία έχετε επιδέσμους.Ο χρόνος θεραπείας είναι ισοδύναμος με τον χρόνο επιστροφής των στρατευμάτων, αλλά χρειάζεται ένα ελάχιστο 24 ωρών.<br />Το αντικείμενο μπορεί να συσσωρευτεί.<br />Επιδρά μετά την μάχη.",
        ],
    ], 8 => [
        113 => [
            "name" => "Επίδεσμος",
            "title" => "Επίδεσμος Οι εξοπλισμένοι επίδεσμοι θεραπεύουν το πολύ το 33&#37; των απωλειών αμέσως μετά από μια μάχη. Μπορείτε να θεραπεύσετε μόνο την ποσότητα των στρατευμάτων για τα οποία έχετε επιδέσμους.Ο χρόνος θεραπείας είναι ισοδύναμος με τον χρόνο επιστροφής των στρατευμάτων, αλλά χρειάζεται ένα ελάχιστο 24 ωρών.<br />Το αντικείμενο μπορεί να συσσωρευτεί.<br />Επιδρά μετά την μάχη.",
        ],
    ], 9 => [
        114 => [
            "name" => "Κλουβί",
            "title" => "Τα ζώα σε μια όαση μπορούν να εξημερωθούν με αυτά και μετά να τα φέρετε στο χωριό σας, όπου θα σας βοηθήσουν να αμυνθείτε.<br />Το αντικείμενο μπορεί να συσσωρευτεί.<br />Δεν θα υπάρξει μάχη αλλά τα ζώα θα αιχμαλωτιστούν.",
        ],
    ], 10 => [
        107 => [
            "name" => "Πάπυρος",
            "title" => "Επιδρά όταν βρίσκεται στην τσάντα και δίνει ένα συγκεκριμένο ποσό εμπειρίας.<br />Επιδρά όταν είναι εφοδιασμένο.<br />Το αντικείμενο μπορεί να συσσωρευτεί.",
        ],
    ], 11 => [
        106 => [
            "name" => "Αλοιφή",
            "title" => "Άμεση αναγέννηση των πόντων υγείας του ήρωα. Ο αριθμός των αλοιφών δείχνει πόσοι πόντοι υγείας θα αναπαραχθούν (μεγ. %s&#37;). Επιδρά όταν εφοδιαστεί. Αυτό το αντικείμενο μπορεί να συσσωρευτεί..",
        ],
    ], 12 => [
        108 => [
            "name" => "Δοχείο νερού",
            "title" => "Αναβιώνει τον ήρωα άμεσα. Αν ο ήρωας είναι ζωντανός, δεν μπορείτε να βάλετε ένα δοχείο νερού στην τσάντα του. Επιδρά όταν εφοδιαστεί.",
        ],
    ], 13 => [
        110 => [
            "name" => "Βιβλίο της Σοφίας",
            "title" => "Με αυτό το αντικείμενο μπορείτε να διαγράψετε και αν επανατοποθετήσετε όλες τις ικανότητες του ήρωα.",
        ],
    ], 14 => [
        109 => [
            "name" => "Πινάκιο του Νόμου",
            "title" => "Αυξάνει την πίστη στο χωριό από το οποίο προέρχεται ο ήρωας κατά %s&#37; για κάθε πινάκιο, με ένα μέγιστο όριο %s&#37;.<br />Επιδρά όταν είναι εφοδιασμένο.<br />Το αντικείμενο μπορεί να συσσωρευτεί.",
        ],
    ], 15 => [
        111 => [
            "name" => "Καλλιτέχνημα",
            "title" => "Αν χρησιμοποιήσετε το Καλλιτέχνημα, θα κερδίσετε τόσους πόντους πολιτισμού όσους παράγουν όλα τα χωριά σας μαζί (+%s πόντους πολιτισμού), μέχρι ένα μέγιστο 2000 ανά καλλιτέχνημα.<br />Επιδρά όταν είναι εφοδιασμένο.<br />Το αντικείμενο μπορεί να συσσωρευτεί.",
        ],
    ],
];
//HeroMansion
$Definition['HeroMansion'] = ["AnnexedOasis" => "Προσαρτημένες οάσεις",
    "type" => "Τύπος", "owner" => "Ιδιοκτήτης",
    "Village" => "Χωριό",
    "Coordinates" => "Συντεταγμένες",
    "Resources" => "Ύλες",
    "Loyalty" => "Πίστη",
    "conquered" => "Κατειλημμένη",
    "Forest" => "Δάσος", "Clay" => "Πηλού",
    "Hill" => "Λόφος", "Lake" => "Λίμνη",
    "nextOasisInHeroMansionLevel" => "Επόμενη όαση με Περιοχή Ηρώων επίπεδο ",
    "inReachOases" => "Οάσεις στην εμβέλειά σας",
    "noSlot" => "Δεν υπάρχουν προσαρτημένες οάσεις.",
    "duration" => "Διάρκεια",
    "finished" => "Στις",
    "AbandonOases" => "Εγκαταλείψτε την όαση",
    "areYouSure" => "Είσαι σίγουρος;",
    "del" => "Διαγραφή",
    "noNearOasis" => "Δεν βρέθηκαν κοντινές οάσεις.",
];
//inGame
$Definition['inGame']['Enable this button to construct by clicking on the field'] = 'Ενεργοποιήστε αυτό το κουμπί για να το κατασκευάσετε κάνοντας κλικ στο πεδίο';
$Definition['inGame']['Disable fast upgrade'] = 'Απενεργοποιήστε την γρήγορη αναβάθμιση';
$Definition['inGame']['Inadmissible name/message'] = 'Απαράδεκτο όνομα / μήνυμα.';
$Definition['inGame']['Error: very long input'] = 'Σφάλμα: Πολύ μακρύ όνομα / μήνυμα.';
$Definition['inGame']['TrainingTime'] = 'Διάρκεια εκπαίδευσης: %s';
$Definition['inGame']['noTroopInBeingTrained'] = 'Κανένα στράτευμα σε εκπαίδευση';
$Definition['inGame']['FreeMerchants'] = 'Ελεύθεροι έμποροι: %s/%s';
$Definition['inGame']['No further tasks available in this category'] = 'Δεν υπάρχουν περαιτέρω εργασίες σε αυτήν την κατηγορία.';
$Definition['inGame']['Click here to extend your beginners protection by 3 days'] = 'Κάνε κλικ για να παρατείνεις την προστασία νέου παίκτη κατά %s %s';
$Definition['inGame']['You cannot send resources to other players, attack them or be attacked by them while in beginners protection'] = 'Δεν μπορείτε να στείλετε ύλες, επιτεθείτε ή να σας επιτεθούν όταν βρήσκεστε υπό την προστασία νέου παίκτη.';
$Definition['inGame']['Are you sure you want to extend your beginners protection?'] = 'Είστε σίγουρος ότι θέλετε να παρατείνετε την προστασία νέου παίκτη;';
$Definition['inGame']['Hours'] = 'ώρες';
$Definition['inGame']['Days'] = 'ημέρες';
$Definition['inGame']['Minutes'] = 'λεπτά';
$Definition['inGame']['Seconds'] = 'δευτερόλεπτα';
$Definition['inGame']['extend'] = 'Παράταση';
$Definition['inGame']['Exchange'] = 'Μετατροπή';
$Definition['inGame']['Are you sure you want to convert x gold to y silver?'] = 'Είστε σίγουρος ότι θέλετε να μετατρέψετε %s χρυσό σε %s ασήμι;';
$Definition['inGame']['maintenanceDesc'] = 'Το σύστημα βρίσκεται υπό συντήρηση.<br /> Οι ειδικοί μας εργάζονται στο σύστημα για να το διορθώσουμε το συντομότερο δυνατό.<br />Αυτή η διαδικασία μπορεί να διαρκέσει από λίγα λεπτά έως ώρες.<br /> Σας ευχαριστούμε για την υπομονή σας. <br /> Η ομάδα του ΜΟΛΩΝ ΛΑΒΕ';
$Definition['inGame']['serverTime'] = '΄Ώρα server';
$Definition['inGame']['loyalty'] = 'Πίστη';
$Definition['inGame']['needPlusDesc'] = 'Για αυτή τη λειτουργία χρειάζεστε το Travian Plus ενεργοποιημένο.';
$Definition['inGame']['noWorkShop'] = 'Δεν υπάρχει εργαστήριο στο χωριό.';
$Definition['inGame']['DirectLinks'] = 'Απευθείας Links';
$Definition['inGame']['noStable'] = 'Δεν υπάρχει σταύλος στο χωριό.';
$Definition['inGame']['noBarracks'] = 'Δεν υπάρχει στρατόπαιδο στο χωριό.';
$Definition['inGame']['noMarketplace'] = 'Δεν υπάρχει αγορά στο χωριό.';
$Definition['inGame']['changeVillageName'] = 'Αλλάξτε το όνομα του χωριού.';
$Definition['inGame']['trap_desc'] = 'έχετε %s παγίδες. %s παγίδες είναι γεμάτες ήδη.';
$Definition['inGame']['newVillageName'] = 'Νέο όνομα χωριού';
$Definition['inGame']['DoubleClickToChangeVillageName'] = 'Επεξεργασία ονόματος χωριού.';
$Definition['inGame']['villages'] = 'Χωριά';
$Definition['inGame']['hideCoordinates'] = 'Κρύψε Συντεταγμένες';
$Definition['inGame']['showCoordinates'] = 'Δείξε Συντεταγμένες';
$Definition['inGame']['Village statistics'] = 'Στατιστικά χωριών';
$Definition['inGame']['culture points'] = 'πόντοι πολιτισμού';
$Definition['inGame']['Culture points generated to take control of another village:'] = 'Απαιτούμενοι πόντοι πολιτισμού για να δημιουργήσετε νέο χωριό:';
$Definition['inGame']['MaintenanceWork'] = 'Εργασία συντήρησης';
$Definition['inGame']['run celebration'] = 'Διοργάνωση';
$Definition['inGame']['festival'] = 'Festival';
$Definition['inGame']['type'] = 'Τύπος';
$Definition['inGame']['one celebration is running'] = 'Γιορτή σε εξέλιξη.';
$Definition['inGame']['celebrationRunning'] = 'Γιορτή σε εξέλιξη';
$Definition['inGame']['Here you can subscribe or unsubscribe to our newsletter'] = 'Εδώ μπορείτε να εγγραφείτε ή να διαγραφείτε στο newsletter μας.';
$Definition['inGame']['sitterChangeNameDesc'] = 'Δεν μπορείτε να αλλάξετε το όνομα του χωριού ως sitter.';
$Definition['inGame']['The account will be deleted in'] = 'Ο λογαριασμός θα διαγραφεί σε %s.';
$Definition['inGame']['infoBox']['ArtifactsWillBeReleasedIn'] = 'Τα πολύτιμα αντικείμενα θα εμφανιστούν σε %s ώρες.';
$Definition['inGame']['infoBox']['wwPlansWillBeReleasedIn'] = 'Τα σχέδια κατασκευής ΠΘ θα εμφανιστούν σε %s ώρες.';
$Definition['inGame']['infoBox']['youCanBuildWWIn'] = 'Έναρξη χτησίματος ΠΘ σε %s ώρες.';
$Definition['inGame']['infoBox']['MedalsWillBeGivenIn'] = 'Τα επόμενα μετάλλια θα δοθούν σε %s ώρες.';
$Definition['inGame']['infoBox']['AutoFinishTime'] = 'Ο γύρος θα τερματιστεί σε %s ώρες από τους νατάριους.';
$Definition['inGame']['infoBox']['CatapultAvailableIn'] = 'Οι καταπέλτες θα είναι διαθέσιμοι σε %s ώρες.';
$Definition['inGame']['infoBox']['PlusWillBeFinished'] = ' Ο λογαριασμός Plus λήγει σε %s.';
$Definition['inGame']['infoBox']['Boost1WillBeFinished'] = 'Το επίδομα παραγωγής ξυλείας λήγει σε  %s ώρες.';
$Definition['inGame']['infoBox']['Boost2WillBeFinished'] = 'Το επίδομα παραγωγής πηλού λήγει σε  %s ώρες.';
$Definition['inGame']['infoBox']['Boost3WillBeFinished'] = 'Το επίδομα παραγωγής σιδήρου λήγει σε  %s ώρες.';
$Definition['inGame']['infoBox']['Boost4WillBeFinished'] = 'Το επίδομα παραγωγής σιταριού λήγει σε  %s ώρες.';
$Definition['inGame']['infoBox']['plusAccountExpired'] = 'Ο Plus λογαριασμός σας έχει λήξει.';
$Definition['inGame']['infoBox']['productionBoost1Expired'] = 'Το επίδομα παραγωγής ξυλείας έχει λήξει.';
$Definition['inGame']['infoBox']['productionBoost2Expired'] = 'Το επίδομα παραγωγής πηλού έχει λήξει.';
$Definition['inGame']['infoBox']['productionBoost3Expired'] = 'Το επίδομα παραγωγής σιδήρου έχει λήξει.';
$Definition['inGame']['infoBox']['productionBoost4Expired'] = 'Το επίδομα παραγωγής σιταριού έχει λήξει.';
$Definition['inGame']['infoBox']['protection'] = 'Σας έχουν μείνει %s ώρες προστασίας νέου παίκτη.';
$Definition['inGame']['infoBox']['Your account was banned!'] = 'Ο λογαριασμός σας έχει κλειδωθεί!';
$Definition['inGame']['infoBox']['Reason'] = 'Λόγος';
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
$Definition['inGame']['infoBox']['Your account is in vacation until [time]'] = 'Ο λογαριασμός σας είναι σε διακοπές μέχρι %s.';
$Definition['inGame']['infoBox']['day(s)'] = 'ημέρα(ες)';
$Definition['inGame']['infoBox']['hour(s)'] = 'ώρα(ες)';
$Definition['inGame']['infoBox']['overFlowMessage'] = 'Έχει χρησιμοποιηθεί περίπου το 90%% της χωρητικότητας των αναφορών σας. Οι αναφορές πριν %d %s μπορεί να διαγραφούν.';
$Definition['inGame']['More Information'] = 'Περισσότερες πληροφορίες';
//Your report box has over 90% of its size used. Overflowing reports, which are older than one day may be deleted.
$Definition['inGame']['total_messages'] = 'Μηνύματα';
$Definition['inGame']['unReadMessages'] = 'Αδιάβαστα μηνύματα';
$Definition['inGame']['showMoreMessages'] = 'Δείξε περισσότερα μηνύματα';
$Definition['inGame']['hideMoreMessages'] = 'Κρύψε περισσότερα μηνύματα';
$Definition['inGame']['Confirm'] = 'Επιβεβαίωση';
$Definition['inGame']['InfoBox'] = 'Κουτί πληροφοριών';
$Definition['inGame']['Delete this message permanently?'] = 'Οριστική διαγραφή μηνύματος;';
$Definition['inGame']['This tab is selected as your fav tab'] = 'Αυτή η καρτέλα αποθηκεύτηκε στα αγαπημένα';
$Definition['inGame']['Select this tab as fav'] = 'Επέλεξε αυτή την καρτέλα ως αγαπημένη καρτέλα';
$Definition['inGame']['sendMessage'] = 'Αποστολή μηνύματος';
$Definition['inGame']['zoom_in'] = 'Μεγέθυνση';
$Definition['inGame']['zoomIn'] = 'Σμίκρυνση';
$Definition['inGame']['available'] = 'διαθέσιμα ';
$Definition['inGame']['Amount'] = 'Ποσότητα';
$Definition['inGame']['train_troops'] = 'Εκπαίδευση στρατευμάτων';
$Definition['inGame']['bannedSmallPage'] = 'Ο λογαριασμός σας είναι κλειδωμένος.';
$Definition['inGame']['in_training'] = 'Σε εκπαίδευση';
$Definition['inGame']['next_creating'] = 'Η επόμενη παγίδα θα είναι έτοιμη σε %s ώρες.';
$Definition['inGame']['next_training'] = 'Ο επόμενος στρατιώτης θα είναι έτοιμος σε %s ώρες.';
$Definition['inGame']['in_creating'] = 'Υπό κατασκευή';
$Definition['inGame']['train'] = 'Εκπαίδεση';
$Definition['inGame']['palaceNoTrainText'] = 'Προκειμένου να ιδρυθεί ή να κατακτηθεί ένα νέο χωριό χρειάζεσαι ένα <b>Παλάτι</b> επιπέδου 10,15 ή 20 και 3 αποίκους.</br>Για να κατακτήσεις ένα χωριό χρειάζεσαι ένα <b>Παλάτι</b> επίπεδο 10,15 ή 20 και ένα γερουσιαστή, αρχηγό ή φύλαρχο.';
$Definition['inGame']['residenceNoTrainText'] = 'Προκειμένου να ιδρυθεί ή να κατακτηθεί ένα νέο χωριό χρειάζεσαι ένα <b>Μἐγαρο</b> επιπέδου 10 ή 20 και 3 αποίκους.</br>Για να κατακτήσεις ένα χωριό χρειάζεσαι ένα <b>Μἐγαρο</b> επίπεδο 10 ή 20 και ένα γερουσιαστή, αρχηγό ή φύλαρχο.';
$Definition['inGame']['noTroops'] = 'Δεν έχει ερευνηθεί κανένα στράτευμα γι αυτό το κτίριο.<br />Μπορείτε να ερευνήσετε νέα κτίρια στην ακαδημία.';
$Definition['inGame']['Profile']['Profile'] = 'Προφίλ';
$Definition['inGame']['Profile']['edit profile description'] = 'Επεξεργασία προφίλ.';
$Definition['inGame']['Options']['Options'] = 'Επιλογές';
$Definition['inGame']['Options']['edit account settings'] = 'Επεξεργασία επιλογών λογαριασμού.';
$Definition['inGame']['Options']['you may not edit settings of another account'] = 'Δεν μπορείτε να επεξεργαστείτε τις ρυθμίσεις ενός άλλου λογαριασμού.';
$Definition['inGame']['Forum']['Forum'] = 'Φόρουμ';
$Definition['inGame']['Forum']['Meet other players on our external forum'] = 'Συναντίστε άλλους παίκτες στο εξωτερικό μας φόρουμ.';
$Definition['inGame']['Help']['Help'] = 'Βοήθεια';
$Definition['inGame']['Help']['Manuals, Answers and Support'] = 'Εγχειρίδια, Απαντήσεις και Υποστήριξη';
$Definition['inGame']['Logout']['Logout'] = 'Αποσύνδεση';
$Definition['inGame']['Logout']['Log out from the game'] = 'Αποσύνδεση από το παιχνίδι.';
$Definition['inGame']['Navigation']['Resources'] = 'Ύλες';
$Definition['inGame']['Navigation']['Buildings'] = 'Κτίρια';
$Definition['inGame']['Navigation']['Map'] = 'Χάρτης';
$Definition['inGame']['Navigation']['Statistics'] = 'Στατιστικά';
$Definition['inGame']['Navigation']['Reports'] = 'Αναφορές';
$Definition['inGame']['Navigation']['newReports'] = 'Νέες Αναφορές';
$Definition['inGame']['Navigation']['Messages'] = 'Μηνύματα';
$Definition['inGame']['Navigation']['newMessages'] = 'νέα μηνύματα';
$Definition['inGame']['Navigation']['Buy gold'] = 'Αγόρασε Χρυσό';
$Definition['inGame']['gold'] = 'Χρυσό';
$Definition['inGame']['goldShort'] = 'Χρυσό';
$Definition['inGame']['silver'] = 'Ασήμι';
$Definition['inGame']['silverShort'] = 'Ασήμι';
$Definition['inGame']['endAt'] = 'Τελειώνει στις';
$Definition['inGame']['finishNow'] = 'Τελείωσε τώρα';
$Definition['inGame']['finishNowSitterNoPermission'] = 'Δεν έχετε άδεια να χρησιμοποιήσετε το χρυσό ως sitter.';
$Definition['inGame']['finishNowWWDisabled'] = 'Δεν μπορείτε να χρησιμοποιήσετε χρυσό σε χωριό Παγκοσμίου Θαύματος.';
$Definition['inGame']['resources']['resources'] = 'Ύλες';
$Definition['inGame']['resources']['r0'] = 'όλα';
$Definition['inGame']['resources']['r1'] = 'Ξύλο';
$Definition['inGame']['resources']['r2'] = 'Πηλός';
$Definition['inGame']['resources']['r3'] = 'Σίδερο';
$Definition['inGame']['resources']['r4'] = 'Σιτάρι';
$Definition['inGame']['resources']['r5'] = 'Kατανάλωση σιταριού';
$Definition['inGame']['Small celebration'] = 'Μικρή γιορτή';
$Definition['inGame']['Big celebration'] = 'Μεγάλη γιορτή';
$Definition['inGame']['Hold a celebration'] = 'Άρχισε μια γιορτή';
$Definition['inGame']['productionBoost']['activate'] = 'Ενεργοποίηση';
$Definition['inGame']['productionBoost']['remainingTime'] = 'Εναπομείναν χρόνος: %s μέρες. Μεχρι τίς: %s.';
$Definition['inGame']['productionBoost']['remainingTime2'] = 'τελειώνει σε %s ώρες.';
$Definition['inGame']['productionBoost']['woodProductionBoost'] = 'Περισσότερη παραγωγή ξύλου';
$Definition['inGame']['productionBoost']['clayProductionBoost'] = 'Περισσότερη παραγωγή πηλού';
$Definition['inGame']['productionBoost']['ironProductionBoost'] = 'Περισσότερη παραγωγή σιδήρου';
$Definition['inGame']['productionBoost']['cropProductionBoost'] = 'Περισσότερη παραγωγή σιταριού';
$Definition['inGame']['productionBoost']['extend'] = 'Επέκταση τώρα';
$Definition['inGame']['productionBoost']['activate now'] = 'Ενεργοποίηση τώρα <br> Διάρκεια επιδόματος: %s';
$Definition['inGame']['productionBoost']['extend now'] = 'Επέκταση τώρα<br> Διάρκεια επέκτασης: %s';
$Definition['inGame']['plus']['remainingTime'] = 'Εναπομείναν χρόνος: %s μέρες. Μεχρι τίς: %s';
$Definition['inGame']['plus']['remainingTime2'] = 'Τελειώνει στις %s';
$Definition['inGame']['plus']['activate'] = 'Eνεργοποίηση Travian Plus';
$Definition['inGame']['plus']['extend'] = 'Επέκταση τώρα';
$Definition['inGame']['plus']['activate now'] = 'Eνεργοποίηση τώρα<br> Διάρκεια: %s';
$Definition['inGame']['plus']['extend now'] = 'Επέκταση τώρα<br> Διάρκεια: %s';
$Definition['inGame']['sitterNoPermForGold'] = 'Ως sitter, μπορείτε να το κάνετε μόνο εάν ο κάτοχος του λογαριασμού σας έχει δώσει την άδειά του.';
$Definition['inGame']['continue'] = 'συνέχεια';
$Definition['inGame']['stockBar']['production']['r1'] = 'Ξύλο||Παραγωγή: %s<br>Γεμάτο σε: %s<br>...πάτησε για περισσότερς πληροφορείες.';
$Definition['inGame']['stockBar']['production']['r2'] = 'Πηλός||Παραγωγή: %s<br>Γεμάτο σε: %s<br>...πάτησε για περισσότερς πληροφορείες.';
$Definition['inGame']['stockBar']['production']['r3'] = 'Σίδερο||Παραγωγή: %s<br>Γεμάτο σε: %s<br>...πάτησε για περισσότερς πληροφορείες.';
$Definition['inGame']['stockBar']['production']['r4'] = 'Σιτάρι||Παραγωγή λιγότερη από την κατανάλωση των κτιρίων: %s<br>Γεμάτο σε: %s<br>...πάτησε για περισσότερς πληροφορείες,';
$Definition['inGame']['stockBar']['production']['r4Empty'] = 'Σιτάρι||Παραγωγή λιγότερη από την κατανάλωση των κτιρίων: %s<br><span class="red">Άδειο σε: %s</span><br>...πατήστε για περισσότερες πληροφορίες.';
$Definition['inGame']['stockBar']['production']['r5'] = 'Ελεύθερο σιτάρι για περισσότερα κτίρια.||Διαθέσιμο σιτάρι: %s<br>...πατήστε για περισσότερες πληροφορίες.';
$Definition['inGame']['bannedPage'] = 'Γειά σου %s!
</br></br>Ο λογαριασμός σας έχει κλειδωθεί λόγω παραβίασης των κανόνων. Κάθε παίκτης μπορεί να κατέχει και να παίζει μόνο ένα λογαριασμό σε κάθε γύρο παιχνιδιού.
</br></br>Για να εξασφαλίσετε ότι δεν θα κλειδωθείτε ξανά στο μέλλον, θα πρέπει να διαβάσετε προσεκτικά τους κανόνες:
</br></br><center><a href="http://' . WebService::getJustDomain() . 'spielregeln.php">» Game rules</a></center>
</br></br></br>
Για να συνεχίσετε να παίζετε, επικοινωνήστε με τον Multihunter και μιλήστε ξεκάθαρα μαζί του.
</br></br><center><a href="messages.php?t=1&id=2">» Γράψε μήνυμα</a></center>
</br></br>
Ακολουθήστε τις παρακάτω συμβουλές όταν γράφετε το μήνυμά σας:
</br></br>
● Υπάρχει πάντα ένας λόγος για το κλείδωμα. Προσπαθήστε να σκεφτείτε τους πιθανούς λόγους για αυτό το κλείδωμα και να συζητήσετε την κατάσταση με τον Multihunter.
</br>
● Οι Multihunters μπορούν να επιθεωρούν τεράστιες ποσότητες πληροφοριών σχετικά με τους λογαριασμούς. Προβάλλετε την αλήθεια και μην επικαλείστε δικαιολογίες για να δικαιολογήσετε την παραβίαση των κανόνων.
</br>
● Να είστε συνεργάσιμοι και διορατικοί, αυτό θα μπορούσε να μειώσει την τιμωρία.
</br>
● Αν ο Multihunter δεν απαντήσει αμέσως, τότε πιθανότατα δεν είναι συνδεδεμένος στο διαδίκτυο.</br>
 Το ζήτημα δεν θα επιλυθεί με μεγαλύτερη ταχύτητα στέλνοντας πολλαπλά μηνύματα, ειδικά αν ακόμα δεν είχε ακόμη διαβάσει το πρώτο.
</br>
● Εάν έχετε νομίζετε ότι έχετε κλειδωθεί πραγματικά αδίκως, προσπαθήστε να παραμείνετε ήρεμοι και ευγενικοί μιλώντας στο Multihunter και να του πείτε για την άποψή σας.
</p>
<small><i>Με εκτίμηση, η ομάδα του ΜΟΛΩΝ ΛΑΒΕ</i></small></p>';

$Definition['inGame']['bannedPageWithTime'] = 'Γειά σου %s!
</br></br>Ο λογαριασμός σας έχει κλειδωθεί μέχρι %s. Κάθε παίκτης μπορεί να κατέχει και να παίζει μόνο ένα λογαριασμό σε κάθε γύρο παιχνιδιού.
</br></br>Για να εξασφαλίσετε ότι δεν θα κλειδωθείτε ξανά στο μέλλον, θα πρέπει να διαβάσετε προσεκτικά τους κανόνες:
</br></br><center><a href="http://' . WebService::getJustDomain() . 'spielregeln.php">» Κανόνες παιχνιδιού</a></center>
</br></br></br>
Για να συνεχίσετε να παίζετε το παιχνίδι θα πρέπει να περιμένετε μέχρι %s ή να επικοινωνήστε με τον Multihunter και μιλήστε ξεκάθαρα μαζί του.
</br></br><center><a href="messages.php?t=1&id=2">» Γράψε μήνυμα</a></center>
</br></br>
Ακολουθήστε τις παρακάτω συμβουλές όταν γράφετε το μήνυμά σας:
</br></br>
● Υπάρχει πάντα ένας λόγος για το κλείδωμα. Προσπαθήστε να σκεφτείτε τους πιθανούς λόγους για αυτό το κλείδωμα και να συζητήσετε την κατάσταση με τον Multihunter.
</br>
● MΟι Multihunters μπορούν να επιθεωρούν τεράστιες ποσότητες πληροφοριών σχετικά με τους λογαριασμούς. Προβάλλετε την αλήθεια και μην επικαλείστε δικαιολογίες για να δικαιολογήσετε την παραβίαση των κανόνων.
</br>
● Να είστε συνεργάσιμοι και διορατικοί, αυτό θα μπορούσε να μειώσει την τιμωρία.
</br>
● Αν ο Multihunter δεν απαντήσει αμέσως, τότε πιθανότατα δεν είναι συνδεδεμένος στο διαδίκτυο.</br>
 Το ζήτημα δεν θα επιλυθεί με μεγαλύτερη ταχύτητα στέλνοντας πολλαπλά μηνύματα, ειδικά αν ακόμα δεν είχε ακόμη διαβάσει το πρώτο.
</br>
● Εάν έχετε νομίζετε ότι έχετε κλειδωθεί πραγματικά αδίκως, προσπαθήστε να παραμείνετε ήρεμοι και ευγενικοί μιλώντας στο Multihunter και να του πείτε για την άποψή σας.
</p>
<small><i>Με εκτίμηση, η ομάδα του ΜΟΛΩΝ ΛΑΒΕ</i></small></p>';
$Definition['inGame']['bannedClickPage'] = '
<h2>Γειά σου %s,</h2>
<br/>
<center><b>Ο λογαριασμός σας έχει κλειδωθεί</b>
    <br>
</center>
<div>Αυτό το κλείδωμα μπορεί να είναι προσωρινή αιτία υπερπήδησης, στην περίπτωση αυτή θα αφαιρεθεί αυτόματα μετά από 5 δευτερόλεπτα.
    <br>
    <br>ή ίσως συνέβη εξαιτίας:
    <br>
    <br>
    <li>Χρησιμοποιώντας ένα παράνομο πρόγραμμα σκριπτ</li>
    <li>Pushing</li>
    <li>Spam</li>
    <li>Περιφρονώντας τους άλλους παίκτες</li>
    <li>Προσπαθώντας να διαβάλει το σύστημα</li>
    <br>
    <br>Για περισσότερες πληροφορίες επικοινωνήστε <a href="messages.php?t=1&id=4">Multihunter</a> or <a href="messages.php?t=1&id=1">Support</a> ή στείλτε email στο <b>molon.lave.team@gmail.com</b>.
    <br>
    <br>Με εκτίμηση, η ομάδα του ΜΟΛΩΝ ΛΑΒΕ</div>
';
$answersUrl = getAnswersUrl();
$Definition['inGame']['QUEST_MESSAGE_SUBJECT'] = 'Χρήσιμες πληροφορίες';
$Definition['inGame']['QUEST_MESSAGE'] = <<<HTML
Καλώς ορίσατε %s,<br><br>
<br><br>
Αυτή είναι η νέα σας πατρίδα.
<br><br>
Ρίξτε μια ματιά τριγύρω. Τα εύφορα χωράφια, οι χρυσαφένιοι σιτοβολώνες και τα σιδερένια βουνά, όλα σάς ανήκουν. Το χωριό σας μπορεί να είναι μικρό αυτήν τη στιγμή, αλλά με μυαλό και σκληρή δουλειά, θα μεταμορφωθεί στο λίκνο μιας αυτοκρατορίας: της δικής σας. Ακόμα κι έτσι, ένας μεγάλος ηγέτης χρειάζεται κάτι περισσότερο από αρετή, χρειάζεται σοφία. Οπότε, καλό είναι να με ακούσετε:
<br><br>
Τα πάντα στον κόσμο εξαρτώνται από τους διαθέσιμους πόρους. Τα κτίριά σας τους χρειάζονται, τα στρατεύματά σας τους καταναλώνουν κι ολόκληροι πόλεμοι διεξάγονται με αποκλειστικό σκοπό την κατοχή τους. Ναι, είναι κάτι που πρέπει να το εμπεδώσετε καλά: οι πόροι είναι το μέσον για έναν σκοπό. Να τους ξοδεύετε πάντα σοφά. Η αρχική προστασία που απολαμβάνετε ως αρχάριος θα χαθεί και οι επιδρομείς δεν θα περιμένουν άλλο. Να συνδέεστε τακτικά και να επενδύετε στην Κρυψώνα και σε περισσότερα πεδία άντλησης πόρων, για να διατηρήσετε μια ακμάζουσα οικονομία.
<br><br>
Πάρτε μια βαθιά ανάσα. Ο αέρας μπορεί ακόμα να είναι φρέσκος από τη βροχή, αλλά υπάρχει μια υποψία στάχτης. Δεν μπορείτε να αποφύγετε τα σημάδια του πολέμου. Αλλά η τέχνη της διπλωματίας δεν χρειάζεται να μένει πλέον κρυφή: μιλήστε με τους άλλους. Βρείτε φίλους και γίνετε μέλη μιας συμμαχίας. Θα σας υποστηρίξουν σε καιρούς μεγάλης ανάγκης και θα σας δώσουν άπειρες συμβουλές. Θα πρέπει, επίσης, να αποταθείτε στους εχθρούς σας. Θα διαπιστώσετε ότι μια συμφωνία μπορεί να αποβεί αμοιβαία επωφελής.
<br><br>
Και τώρα, θέστε τα θεμέλια. Αυτό είναι το μνημείο σας. Αλλά δεν θα είναι το μόνο. Το πλάνο σας θα πρέπει να είναι να εποικίσετε ένα δεύτερο χωριό, το συντομότερο δυνατόν. Οι επιλογές στη διάθεσή σας και, ως εκ τούτου, η ισχύς σας θα αυξηθεί κατά πολύ. Πολύ περισσότεροι πόροι, πρόσθετοι τρόποι να αποκτήσετε πιο εξειδικευμένα κτίρια και, επομένως, καλύτερες στρατηγικές. Η εγκατάσταση των εποίκων σας κοντά στους φίλους σας αποτελεί, επίσης, ένα διόλου αμελητέο πλεονέκτημα.
<br><br>
Αλλά αρκετά με τα λόγια. Είναι ώρα για δράση. Συμβουλευτείτε τον Εργοδηγό - έχει ήδη μεγάλα σχέδια για εσάς. Ας μου επιτραπεί να κλείσω με μια πολύτιμη σοφή συμβουλή: πραγματική ήττα είναι μόνο η παραίτηση. Θα υπάρξουν προκλήσεις και θα υπάρξουν και αναποδιές, αλλά μόνον αν τις υπερπηδήσετε θα αναπτυχθείτε. Τα καλά κόποις κτώνται, αλλά ο επιμένων νικά. Και τώρα, βγείτε εκεί έξω και δείξτε στον κόσμο από τι είστε φτιαγμένος.
HTML;
$Definition['links']['These links are found helpful by many players Add them to your personal link list'] = 'Πολλοί παίκτες βρίσκουν αυτά τα link βοηθητικά. Πρόσθεσέ τα στην προσωπική σου λίστα με link.';
$Definition['links']['Recommended links'] = 'Προτεινόμενα links';
$Definition['links']['recommenced_links'] = [
    [
        'name' => 'Travian Answers', 'url' => getAnswersUrl() . '*',
    ], [
        'name' => 'Επισκόπηση χωριού', 'url' => 'dorf3.php?s=0',
    ], [
        'name' => 'Επισκόπηση αποθήκης', 'url' => 'dorf3.php?s=3',
    ], [
        'name' => 'Αναφορές συμμαχίας', 'url' => 'allianz.php?s=3',
    ], [
        'name' => 'Αναφορές περιχώρων', 'url' => 'reports.php?t=5',
    ], [
        'name' => 'Επιλογές', 'url' => 'options.php',
    ], [
        'name' => 'Κοινότητα', 'url' => getForumUrl() . '*',
    ],
];
$Definition['links']['Define often-used pages as direct links Place a * at the end of the link and it will be opened in a new tab'] = 'Θέστε σελίδα που χρησιμοποιείτε συχνά σαν απευθείας links. Βάλτε ένα * στο τέλος του link και θα ανοίγει σε νέα καρτέλα.';
$Definition['links']['Delete entry'] = 'διαγραφή καταχώρησης';
$Definition['links']['add entry'] = 'προσθέστε περιεχόμενο';
$Definition['links']['No'] = 'Αρ';
$Definition['links']['Link Name'] = 'Όνομα Link';
$Definition['links']['Link Target'] = 'Προορισμός Link';
$Definition['links']['Link list'] = 'Λίστα link';
$Definition['links']['linkWillOpenInNewTab'] = 'Το λινκ θα ανοίξει σε νέο tab/παράθυρο';
$Definition['links']['edit link list'] = 'επεξεργασία λίστας link';
$Definition['links']['Travian Plus allows you to make a link list'] = 'Το Travian Plus σάς επιτρέπει να δημιουργήσετε μια λίστα συνδέσμων.';
//Login
$Definition['Login']['Server will start in'] = 'O server θα ξεκινήσει στις:';
$Definition['Login']['registrationSuccessful'] = 'Ευχαριστούμε για την εγγραφή σας. Θα σας στείλουμε ένα email όταν ξεκινά ο server.';
$Definition['Login']['registrationSuccessful'] .= 'Περιμένετε για το email.';
$Definition['Login']['Login'] = 'Σύνδεση';
$Definition['Login']['Welcome'] = 'Καλωσορίσατε στον server %s';
$Definition['Login']['noJavascript'] = 'JavaScript είναι απενεργοποιημένη. Πρέπει να το ενεργοποιήσετε στις ρυθμίσεις του προγράμματος περιήγησης για να μπορέσετε να παίξετε Travian.';
$Definition['Login']['accountNameOrEmailAddress'] = 'Όνομα λογαριασμού ή διεύθυνση email';
$Definition['Login']['pass'] = 'Κωδικός';
$Definition['Login']['lowResOption'] = 'Έκδοση για τον παίκτη ';
$Definition['Login']['lowRes'] = 'με χαμηλό bandwidth (ταχύτητα σύνδεσης internet)';
$Definition['Login']['lowResInfo'] = '(Σημείωση: αυτή η έκδοση του χάρτη δεν έχει όλες τις επιλογές διαθέσιμες)';
$Definition['Login']['Captcha'] = 'Captcha';
$Definition['Login']['CaptchaError'] = 'Παρακαλώ εισάγετε ξανά το Captcha';
$Definition['Login']['PasswordForgotten?'] = 'Ξέχασες τον κωδικό σου;';
$Definition['Login']['We will send you a new password It will be activated as soon as you confirm receipt?'] = 'Θα σας στείλουμε έναν νέο κωδικό. Θα ενεργοποιηθεί μόλις επιβεβαιώσετε την παραλαβή του.';
$Definition['Login']['Request new CAPTCHA'] = 'Ζητήστε νέο CAPTCHA.';
$Definition['Login']['Email'] = 'Email';
$Definition['Login']['Request password'] = 'Ζητήστε κωδικό';
$Definition['Login']['Sent to'] = 'O κωδικός στάλθηκε!';
$Definition['Login']['EmailEmpty'] = 'Bάλτε το σωστό σας email';
$Definition['Login']['PasswordChangedSuccessfully'] = 'Ο κωδικός πρόσβασης έχει αλλάξει επιτυχώς.';
$Definition['Login']['PasswordFail'] = 'Ο κωδικός πρόσβασης δεν άλλαξε. Ίσως ο κώδικας να χρησιμοποιηθεί ήδη.';
$Definition['Login']['pw_forgot_email'] = nl2br('
<div style="direction: rtl; text-align: right">
Γειά σου %s
έχετε ζητήσει έναν νέο κωδικό πρόσβασης για το το λογαριασμό σας στον κόσμο του ΜΟΛΩΝ ΛΑΒΕ. Βρείτε τα νέα σας δεδομένα πρόσβασης<br>
για το Travian που περιγράφεται στο παρακάτω μήνυμα:
---------------------------------------------------------------------------------------------------------------------------------

Τα δεδομένα πρόσβασης:
Ονομα παίκτη:  %s
Διεύθυνση ηλεκτρονικού ταχυδρομείου: %s
Κωδικός πρόσβασης: %s
Κόσμος παιχνιδιού: %s

---------------------------------------------------------------------------------------------------------------------------------
Κάντε κλικ σε αυτόν τον σύνδεσμο για να ενεργοποιήσετε τον νέο κωδικό πρόσβασής σας. Ο παλιός κωδικός πρόσβασης
καθίσταται άκυρος:
<a href="%s">%s</a>

Εάν θέλετε να αλλάξετε τον νέο κωδικό πρόσβασής σας, μπορείτε να εισάγετε ένα νέο στο προφίλ σας
στην καρτέλα "λογαριασμός".

Σε περίπτωση που δεν ζητήσατε νέο κωδικό πρόσβασης, μπορείτε να αγνοήσετε αυτό το μήνυμα ηλεκτρονικού ταχυδρομείου.

Με εκτίμηση, η ομάδα του ΜΟΛΩΝ ΛΑΒΕ
</div>
Impressum:
Travian Games GmbH, Wilhelm-Wagenfeld-Str. 22, 80807 München, Deutschland
Tel: +49 (0)89 3249150, Fax: +49 (0)89 324915970, www.traviangames.de
CEO: Siegfried Müller
commercial court: Amtsgericht München, HRB 173511,
tax number: DE 246258085');
$Definition['Login']['userErrors']['empty'] = 'Εισαγωγή σύνδεσης.';
$Definition['Login']['userErrors']['notFound'] = 'Η σύνδεση δεν υπάρχει.';
$Definition['Login']['pwErrors']['empty'] = 'Εισάγετε τον κωδικό πρόσβασης';
$Definition['Login']['pwErrors']['wrong'] = 'Ο κωδικός πρόσβασης είναι λάθος.';
$Definition['Login']['pwErrors']['error21Days'] = 'Αυτός ο χρήστης δεν έχει συνδεθεί για περισσότερο από 21 ημέρες. Η πρόσβαση στο Sitter δεν επιτρέπεται.';
//Logout
$Definition['Logout'] = ["Logout" => "Επιτυχής αποσύνδεση.",
    "delete_cookies" => "Διαγραφή cookies",
    "thanks_for_your_visit" => 'Ευχαριστούμε για την επίσκεψη σου',
    "cookieDesc" => "Εάν χρησιμοποιούν κι άλλοι χρήστες αυτόν τον υπολογιστή, θα πρέπει να διαγράψετε τα cookies για τη δική σας ασφάλεια ",
    "back_to_the_game" => "Πίσω στο παιχνίδι",
];
//Manual
$Definition['Manual'] = ['fightingStrength' => "Δύναμη επίθεσης",
    "fightingStrengthAgainstInf" => "Αμυντική δὐναμη ενάντια σε πεζικό",
    'fightingStrengthAgainstCav' => "Αμυντική δὐναμη ενάντια σε ιππικό",
    "speed" => "Ταχύτητα", "CarrySize" => "Μπορεί να μεταφέρει",
    "TravianAnswers" => "Travian answers",
    "moreInTravianAnswers" => "περισσότερα στο Travian Answers",
    "durationOfTraining" => "Χρόνος εκπαίδευσης",
    "fieldsPerHour" => "Πεδία/Ώρα",
    "preRequests" => "Προϋποθέσεις",
    "toOverview" => "προς σύνοψη", "None" => "Καμία",
    "and" => "και",
    "construction_time" => "χρόνος κατασκευής",
    "for" => "για", "level" => "επίπεδο",
    "BuildingPlan" => "Σχέδιο κατασκευής",
    "Capital" => "Πρωτεύουσα",
    "onlyForTribe" => "μόνο για τους", "Units" => "Στρατεύματα",
];
//Map
$Definition['map'] = ["player" => "Παίκτης",
    "alliance" => "Συμμαχία",
    "owner" => "Ιδιοκτήτης",
    "Tribe" => "Φυλή",
    "Village" => "Χωριό",
    "Annex Oasis" => "Κατάκτηση όασης",
    "sendTroops" => "Αποστολή στρατευμάτων",
    "no free slots" => "Η περιοχή ηρώων έχει ελέυθερη θέση.",
    "distribution" => "Διανομή γης",
    "pop" => "Πληθυσμός",
    "capital" => "Πρωτεύουσα",
    'x is under protection to y' => 'Ο παίκτης είναι υπό την προστασία νέου παίκτη μέχρι %s',
    'banned' => 'Ο παίκτης είναι κλειδωμένος.',
    'sendMerchants' => 'Αποστολή εμπόρων',
    "constructMarketplace" => "Κατασκευάστε μια αγορά.",
    "readySettlers" => "Έτοιμοι άποικοι",
    "foundNewVillage" => "Ίδρυση νέου χωριού",
    "culturePointsForNewVillage" => "Πόντοι πολιτισμού για να ιδρυθεί νέο χωριό ",
    "noResourcesForNewVillage" => "Δεν υπάρχουν αρκετές ύλες (Χρειάζεται τουλάχιστον 750 ύλες από το κάθε είδος).",
    "Add to farm list" => "Πρόσθεσε στη λίστα με φάρμες",
    "noFarmList" => "Δεν υπάρχει λίστα με φάρμες σε αυτό το χωριό. Δημιουργήστε μια πρώτα.",
    "Edit farm list (Oasis already in farm list x)" => "Επεξεργασία λίστας με φάρμες (Η όαση υπάρχει ήδη στη λίστα %s)",
    "Edit farm list (Village already in farm list x)" => "Επεξεργασία λίστας με φάρμες (Το χωριό υπάρχει ήδη στη λίστα %s)",
    "move up" => "Κίνηση πάνω",
    "move down" => "Κίνηση κάτω",
    "move right" => "Κίνηση δεξιά",
    "move left" => "Κίνηση αριστερά",
    "for this feature you need the goldclub actived" => "Γι αυτό το στοιχείο χρειάζεστε ενεργοποιημένο το Travian Plus.",
    "vacationModeActive" => "Αυτός ο παίκτης βρίσκεται σε διακοπές.",
    'noUnits' => 'Κανένα.',
    'units' => 'Στρατεύματα',
    'Bonus' => 'Μπόνους',
    'Reports' => 'Αναφορές',
    'Surrounding' => 'Περίγυρος',
    'Other Information' => 'Άλλες πληροφορίες',
    'fields' => 'Πεδία',
    'Distance' => 'Απόσταση',
    'Simulate raid' => 'Εξομοίωση επιδρομής',
    'No information<br>available!' => 'Δεν υπάρχουν διαθέσιμες<br>πληροφορίες!',
    'landscape_desc' => 'Εγκαταλειμμένη κοιλάδα',
    'centerMap' => 'Επικέντρωση χάρτη',
    'constructRallyPoint' => 'Κατασκευάστε πλατεία συγκεντρώσεως.',
    'startAdventure' => 'Άρχισε περιπέτεια',
    "mark_not_found" => "Δεν βρέθηκαν αποτελέσματα",
    "ok" => "OK",
    "markAlliance" => "σημείωσε συμμαχία",
    "markPlayer" => "σημείωσε παίκτη",
    "markField" => "σημείωσε πεδίο",
    "players" => "παίκτες",
    "please_resend_all_data" => "Όλες οι απαραίτητες πληροφορίες.",
    "alliances_mark_exists" => "Αυτή η συμμαχία έχει ήδη επισημανθεί.",
    "player_mark_exists" => "Αυτός ο παίκτης έχει ήδη επισημανθεί.",
    "invalid_coordinates" => "Μη έγκυρες συντεταγμένες.",
    "colour_does_not_exists" => "Μη έγκυρο χρώμα.",
    "no_alliance_map_mark_error" => "Ο παίκτης δεν είναι μέλος καμιάς συμμαχίας.",
    "map" => "Χάρτης",
    "zoomIn" => "Μεγέθυνση",
    "zoomOut" => "Σμίκρυνση",
    "zoomLevel" => "Επίπεδο μεγέθυνσης",
    "filter" => "Φίλτρο",
    "showAllianceMarks" => "δείξτε τα μαρκαρίσματα της συμμαχίας",
    "hideAllianceMarks" => "Κρύψε τα μαρκαρίσματα της συμμαχίας",
    "showUserMarks" => "δείξτε τα δικά μου μαρκαρίσματα",
    "hideUserMarks" => "Κρύψε τα δικά μου μαρκαρίσματα",
    "minimap" => "Μίνιχάρτης",
    "outline" => "Υπογράμμιση",
    "users" => "Παίκτης",
    "population" => "Πληθυσμός",
    "tribe" => "Φιλή",
    "village" => "Χωριό",
    "loadingData" => "Φόρτωση...",
    "landscape" => "Εγκαταλειμμένη κοιλάδα‭",
    "freeOasis" => "Μη κατειλημμένη όαση",
    "occupiedOasis" => "Κατειλημμένη ὀαση",
    "natarsVillage" => "Χωριό ναταρίων",
    "bounty" => "Λάφυρα",
    "difficulty" => "Δυσκολία",
    "arrival" => "Άφιξη στο",
    "supply" => "Προμήθεια",
    "spy" => "Ανίχνευση",
    "return" => "Επιστροφή",
    "raid" => "Επιδρομή",
    "attack" => "Επίθεση",
    "save" => "Aποθήκευση",
    "cancel" => "Ακύρωση",
    'flags' => "Σημαίες ",
    "Adventure" => "Περιπέτεια",
    "normal" => "Κανονική",
    "hard" => "Δύσκολη",
    "ownPlayerMarkTitle" => "Μαρκαρίσματα του παίκτη.",
    "ownAllianceMarks" => "Μαρκαρίσματα της συμμαχίας μου.",
    "ownFlags" => "Δικές μου σημαίες.",
    "allianceMarkTitle" => 'Σήμα συμμαχίας για τη συμμαχία μου',
    "playerMarksTitle" => "Σημάδι παίκτη για τη συμμαχία μου",
    "allianceFlags" => 'Σήμα πεδίου για τη συμμαχία μου',
    "largeMap" => "Πλήρης η οθόνη",
    "needPlus" => "Για να χρησιμοποιήσετε αυτό το στοιχείο πρέπει να ενεργοποιήσετε το Plus!",
    "cropFinder" => "Εύρεση πολυσίταρων",
    "needClub" => "Για να χρησιμοποιήσετε αυτό το στοιχείο πρέπει να ενεργοποιήσετε το Gold club!",
    "YouAreBanned" => "Ο λογαριασμός σας έχει κλειδωθεί.",
    "YouAreInVacationMode" => "Βρίσκεστε σε κατάσταση διακοπών.",
    "YouAreProtected" => "Είστε υπό προστασία νέου παίκτη και δεν μπορείς να κάνεις αυτή τη κίνηση.",
    'mapFlagsLimitReached' => 'Έχετε φτάσει στο μέγιστο αριθμό 5 σημαίες. Διαγράψτε μια σημαία για να προσθέσετε μια άλλη.',
    'mapMarksLimitReached' => 'Έχετε φτάσει τον μέγιστο αριθμό των 10 σημειώσεων. Διαγράψτε ένα σημάδι για να προσθέσετε ένα άλλο.',
];
//Market place
$Definition['MarketPlace']['While you are in beginners protection you are only allowed to do a 1:1 or better trade'] = 'Ενώ βρήσκεστε υπό την προστασία νέου παίκτη επιτρέπεται μόνο να κάνετε ένα εμπόριο 1: 1 ή καλύτερο.';
$Definition['MarketPlace']['x\'s offering has been accepted'] = 'Η προσφορά του %s έγινε αποδεκτή'; //new
$Definition['MarketPlace']['are on their way to you'] = 'είναι στον δρόμο σε σένα.';
$Definition['MarketPlace']['have been dispatched by your merchants'] = 'έχουν αποσταλεί από τους εμπόρους σας';
$Definition['MarketPlace']['Management'] = 'Διαχείριση';
$Definition['MarketPlace']['SendResources'] = 'Αποστολή υλών';
$Definition['MarketPlace']['resourcesSent'] = 'Οι πρώτες ύλες στάλθηκαν.';
$Definition['MarketPlace']['sitterNoPermissions'] = 'Ως sitter μπορείτε να το κάνετε μόνο εάν ο κάτοχος του λογαριασμού σας έχει δώσει την άδειά του.';
$Definition['MarketPlace']['sameVillage'] = 'Οι έμποροί σου είναι ήδη στο συγκεκριμένο χωριό.';
$Definition['MarketPlace']['Buy'] = 'Αγορά';
$Definition['MarketPlace']['Offer'] = 'Προσφορά';
$Definition['MarketPlace']['Delete'] = 'Διαγραφή';
$Definition['MarketPlace']['Select x as favor tab'] = 'Θέσε το %s στα αγαπημένα';
$Definition['MarketPlace']['This tab is set as favourite'] = 'Αυτή η καρτέλα έχει οριστεί ως αγαπημένη.';
$Definition['MarketPlace']['Free merchants'] = 'Ελεύθεροι έμποροι';
$Definition['MarketPlace']['Own merchants and NPC'] = 'Δικοί σου έμποροι και NPC';
$Definition['MarketPlace']['Merchants offering resources'] = 'Έμποροι που προσφέρουν ύλες';
$Definition['MarketPlace']['you are banned'] = 'Έχετε κλειδωθεί για την μη τήρηση των κανόνων.';
$Definition['MarketPlace']['Merchants underway'] = 'Έμποροι στον δρόμο';
$Definition['MarketPlace']['Exchange resources'] = 'Ανταλλαγή υλών';
$Definition['MarketPlace']['Trade routes'] = 'Εμπορικές οδοί';
$Definition['MarketPlace']['Create new trade route'] = 'Δημιουργία νέας εμπορικής οδού';
$Definition['MarketPlace']["goBack"] = 'επεξεργασία εγγραφής';
$Definition['MarketPlace']['Start'] = 'Αρχή';
$Definition['MarketPlace']['Merchants'] = 'Έμποροι  ';
$Definition['MarketPlace']['Action'] = 'Ενἐργεια';
$Definition['MarketPlace']['GoldClub'] = 'Gold Club';
$Definition['MarketPlace']['Description'] = 'Περιγραφή';
$Definition['MarketPlace']['Trade route to x'] = 'Εμπορική οδός προς %s';
$Definition['MarketPlace']['edit'] = 'επεξεργασία';
$Definition['MarketPlace']['cancel'] = 'ακύρωση';
$Definition['MarketPlace']['Resources'] = 'Πρώτες ύλες';
$Definition['MarketPlace']['Target village'] = 'Χωριό προορισμού';
$Definition['MarketPlace']['Target'] = 'Στόχος';
$Definition['MarketPlace']['all'] = 'όλα';
$Definition['MarketPlace']['only mine'] = 'μόνο το δικό μου';
$Definition['MarketPlace']['others'] = 'τα άλλα';
$Definition['MarketPlace']['Show villages in list'] = 'Δείξε τα χωριά στην λίστα';
$Definition['MarketPlace']['Start time'] = 'Αρχή χρόνου';
$Definition['MarketPlace']['nextTradeRoute'] = 'Η επόμενη εμπορική οδός στις %s η ώρα χρειάζεται %s εμπόρους.';
$Definition['MarketPlace']['not enough merchants'] = 'Πολύ λίγοι έμποροι';
$Definition['MarketPlace']['offer added successfully'] = 'Επιτυχής δημιουργία προσφοράς.';
$Definition['MarketPlace']['own alliance only'] = 'Μόνο στη δική μου συμμαχία';
$Definition['MarketPlace']['max, time of transport'] = 'Μέγιστη διάρκεια μεταφοράς';
$Definition['MarketPlace']["Own offers"] = 'Δικές μου προσφορές';
$Definition['MarketPlace']["I'm searching"] = 'Αναζητώ';
$Definition['MarketPlace']["Alliance"] = 'Συμμαχία';
$Definition['MarketPlace']["hours"] = 'ώρες.';
$Definition['MarketPlace']["accept offer"] = 'Αποδοχή προσφοράς';
$Definition['MarketPlace']["yes"] = 'ναι';
$Definition['MarketPlace']["no"] = 'όχι';
$Definition['MarketPlace']["Offers at the marketplace"] = 'Προσφορές στην αγορά';
$Definition['MarketPlace']["Offered to me"] = 'Προσφέρονται σε μένα';
$Definition['MarketPlace']["Wanted from me"] = 'Ζητούνται από εμένα';
$Definition['MarketPlace']["Player"] = 'Παίκτης';
$Definition['MarketPlace']["Duration"] = 'Διάρκεια';
$Definition['MarketPlace']["Action"] = 'Ενἐργεια';
$Definition['MarketPlace']["onReturnMerchants"] = 'Επιστρέφοντες έμποροι';
$Definition['MarketPlace']["onComingMerchants"] = 'Εισερχώμενοι έμποροι';
$Definition['MarketPlace']["onGoingMerchants"] = 'Απεσταλμένοι έμποροι';
$Definition['MarketPlace']["noResourcesEntered"] = 'Δεν έχουν επιλεγεί ύλες.';
$Definition['MarketPlace']["noVillageWithName"] = 'Δεν βρέθηκε χωριό με αυτό το όνομα.';
$Definition['MarketPlace']["noVillageInCoordinate"] = 'Δεν υπάρχει χωριό σε αυτές τις συντεταγμένες.';
$Definition['MarketPlace']["enterVillageNameOrCoordinate"] = 'Λάθος συντεταγμένες.';
$Definition['MarketPlace']["PlayerBanned"] = 'Ο παίκτης είναι κλειδωμένος.';
$Definition['MarketPlace']["serverFinished"] = 'Ο γύρος έχει τελειώσει.';
$Definition['MarketPlace']["go"] = 'πήγαινε';
$Definition['MarketPlace']["go"] = 'πήγαινε';
$Definition['MarketPlace']["or"] = 'ή';
$Definition['MarketPlace']["Village"] = 'Χωριό';
$Definition['MarketPlace']["Arrival"] = 'Άφιξη';
$Definition['MarketPlace']["in"] = 'σε';
$Definition['MarketPlace']["hour"] = 'ώρες';
$Definition['MarketPlace']["at"] = 'στις';
$Definition['MarketPlace']["sendToVillage"] = 'Μεταφορά στο';
$Definition['MarketPlace']["returnFromVillage"] = 'Επιστροφή από';
$Definition['MarketPlace']["receiveFromVillage"] = 'Έλαβε από το χωριό';
$Definition['MarketPlace']["Each of your merchants can carry"] = 'Ο καθένας εκ των εμπόρων σου μπορεί να μεταφέρει';
$Definition['MarketPlace']["Each of your merchants can carry resources"] = 'πρώτες ύλες';
$Definition['MarketPlace']["prepare"] = 'Προετοιμασία';
$Definition['MarketPlace']["noOffers"] = 'Δεν βρέθηκαν προσφορές στην αγορά';
$Definition['MarketPlace']["I'm offering"] = 'Προσφέρω';
$Definition['MarketPlace']['not enough resources'] = 'Πολύ λίγες πρώτες ύλες';
$Definition['MarketPlace']['Unable to create offer; maximum ratio allowed is 2:1'] = 'Δεν γίνεται να δημιουργηθεί η προφορά. Μέγιστη επιτρεπόμενη αναλογία 2:1';
$Definition['MarketPlace']['Search'] = 'Αναζητώ';
$Definition['MarketPlace']['Deliveries'] = 'Αποστολές';
$Definition['MarketPlace']['noRoute'] = 'Δεν υπάρχουν ενεργές εμπορικές οδοί.';
$Definition['MarketPlace']['Create new trade route'] = 'Δημιουργία νέας εμπορικής οδού';
$Definition['MarketPlace']['notEnoughMerchants'] = "Πολύ λίγοι έμποροι. [MERCHANTS_NEEDED] merchants are needed, but there are only [MERCHANTS_AVAILABLE] merchants available.";
$Definition['MarketPlace']['tradeRouteDesc'] = 'Με το Gold club μπορείτε να διατάξετε τα στρατεύματά σας να δραπετεύσουν από επιθέσεις στην πρωτεύουσά σας.';
$Definition['MarketPlace']['Enabled'] = 'Ενεργοποιήθηκε';
$Definition['MarketPlace']['needToBeActive'] = 'Για να χρησιμοποιήσετε αυτό το στοιχείο πρέπει να ενεργοποιήσετε το Gold club!';
$Definition['MarketPlace']['Click here to exchange resources'] = 'Κάντε κλικ εδώ για να ανταλλάξετε τις ύλες.';
$Definition['MarketPlace']['Trade your village\'s resources immediately with NPC merchant 1:1'] = 'Ανταλλάξτε τις ύλες του χωριού σας αμέσως με τον έμπορο NPC 1:1';
$Definition['MarketPlace']['Send time'] = 'Ώρα αποστολής';
$Definition['MarketPlace']['every %s minutes'] = 'κάθε %s λεπτά';
$Definition['MarketPlace']['every %s hours'] = 'κάθε %s ώρες';
$Definition['MarketPlace']['every %s days'] = 'κάθε %s μέρες';
$Definition['MarketPlace']['You are under protection'] = 'You are under protection.';


//Medals
$Definition['Medals']['Category'] = 'Κατηγορία';
$Definition['Medals']['Week'] = 'Εβδομάδα';
$Definition['Medals']['Rank'] = 'Θέση';
$Definition['Medals']['Resources'] = 'Ύλες';
$Definition['Medals']['Points'] = 'Πόντοι';
$Definition['Medals']['Received in week:'] = 'Ελήφθη την εβδομάδα:';
$Definition['Medals']['category15'] = 'Λαμβάνοντας αυτό το μετάλλιο  δείχνει ότι ήσασταν %s φορές μέσα στο Τοπ 10 των κλεφτών της εβδομάδας';
$Definition['Medals']['category9'] = 'Λαμβάνοντας αυτό το μετάλλιο  δείχνει ότι ήσασταν %s φορές μέσα στο Τοπ 3 των κλεφτών της εβδομάδας';
$Definition['Medals']['category14'] = 'Λαμβάνοντας αυτό το μετάλλιο  δείχνει ότι ήσασταν %s φορές μέσα στο Τοπ 10 της προόδου της εβδομάδας.';
$Definition['Medals']['category8'] = 'Λαμβάνοντας αυτό το μετάλλιο  δείχνει ότι ήσασταν %s φορές μέσα στο Τοπ 3 της προόδου της εβδομάδας.';
$Definition['Medals']['category7'] = 'Λαμβάνοντας αυτό το μετάλλιο  δείχνει ότι ήσασταν %s φορές μέσα στο Τοπ 10 των αμυντικών της εβδομάδας.';
$Definition['Medals']['category13'] = 'Λαμβάνοντας αυτό το μετάλλιο  δείχνει ότι ήσασταν %s φορές μέσα στο Τοπ 3 των αμυντικών της εβδομάδας.';
$Definition['Medals']['category12'] = 'Λαμβάνοντας αυτό το μετάλλιο  δείχνει ότι ήσασταν %s φορές μέσα στο Τοπ 10 των επιθετικών της εβδομάδας.';
$Definition['Medals']['category6'] = 'Λαμβάνοντας αυτό το μετάλλιο  δείχνει ότι ήσασταν %s φορές μέσα στο Τοπ 3 των επιθετικών της εβδομάδας.';
$Definition['Medals']['category5'] = 'Λαμβάνοντας αυτό το μετάλλιο  δείχνει ότι ήσασταν μέσα στο Τοπ 10 των πιο επιθετικών και καλύτερων αμυντικών της εβδομάδας, ταυτόχρονα, %s φορές.';
$Definition['Medals']['names'][1] = 'Επιθετικοί της εβδομάδας';
$Definition['Medals']['names'][2] = 'Αμυντικοί της εβδομάδας';
$Definition['Medals']['names'][3] = 'Μεγαλύτερη πρόοδο της εβδομάδας';
$Definition['Medals']['names'][4] = 'Κλέφτες της εβδομάδας';
$Definition['Medals']['names'][5] = 'Τοπ 10 επιθετικοί και αμυντικοί της εβδομάδας';
$Definition['Medals']['names'][6] = 'Τοπ 3 επιθετικοί';
$Definition['Medals']['names'][12] = 'Τοπ 10 επιθετικοί';
$Definition['Medals']['names'][7] = 'Τοπ 3 αμυντικοί';
$Definition['Medals']['names'][13] = 'Τοπ 10 αμυντικοί';
$Definition['Medals']['names'][8] = 'Τοπ 3 προόδου';
$Definition['Medals']['names'][14] = 'Τοπ 10 προόδου';
$Definition['Medals']['names'][9] = 'Τοπ 3 κλεφτών';
$Definition['Medals']['names'][15] = 'Τοπ 10 κλεφτών';
$Definition['Medals']['SpecialMedals'] = [
    // Ranke Wonder Of World
    1 => '<span class="gloriatitle">ΜΟΛΩΝ ΛΑΒΕ</span><div class="gloriacontent">Χώρα: %s<br>Σέρβερ: %s<br>Κατηγορία: Παγκόσμιο Θαύμα<br>Όνομα: %s<br>Φυλή: %s<br>Θέση: 1<br>Επίπεδο ΠΘ: %s</div>',
    2 => '<span class="gloriatitle">ΜΟΛΩΝ ΛΑΒΕ</span><div class="gloriacontent">Χώρα: %s<br>Σέρβερ: %s<br>Κατηγορία: Παγκόσμιο Θαύμα<br>Όνομα: %s<br>Φυλή: %s<br>Θέση: 2<br>Επίπεδο ΠΘ: %s</div>',
    3 => '<span class="gloriatitle">ΜΟΛΩΝ ΛΑΒΕ servers</span><div class="gloriacontent">Χώρα: %s<br>Σέρβερ: %s<br>Κατηγορία: Παγκόσμιο Θαύμα<br>Όνομα: %s<br>Φυλή: %s<br>Θέση: 3<br>Επίπεδο ΠΘ: %s</div>',

    // Ranke Offensive 1 ta 4 top 10
    4 => '<span class="gloriatitle">ΜΟΛΩΝ ΛΑΒΕ</span><div class="gloriacontent">Χώρα: %s<br>Σέρβερ: %s<br>Κατηγορία: Επιθετικός<br>Όνομα: %s<br>Φυλή: %s<br>Θέση: 1<br>Βαθμοί: %s</div>',
    5 => '<span class="gloriatitle">ΜΟΛΩΝ ΛΑΒΕ</span><div class="gloriacontent">Χώρα: %s<br>Σέρβερ: %s<br>Κατηγορία: Επιθετικός<br>Όνομα: %s<br>Φυλή: %s<br>Θέση: 2<br>Βαθμοί: %s</div>',
    6 => '<span class="gloriatitle">ΜΟΛΩΝ ΛΑΒΕ</span><div class="gloriacontent">Χώρα: %s<br>Σέρβερ: %s<br>Κατηγορία: Επιθετικός<br>Όνομα: %s<br>Φυλή: %s<br>Θέση: 3<br>Βαθμοί: %s</div>',
    7 => '<span class="gloriatitle">ΜΟΛΩΝ ΛΑΒΕ</span><div class="gloriacontent">Χώρα: %s<br>Σέρβερ: %s<br>Κατηγορία: Επιθετικός<br>Όνομα: %s<br>Φυλή: %s<br>Θέση: 4<br>Βαθμοί: %s</div>',
    // Ranke Defensive 1 ta 4 top 10
    8 => '<span class="gloriatitle">ΜΟΛΩΝ ΛΑΒΕ</span><div class="gloriacontent">Χώρα: %s<br>Σέρβερ: %s<br>Κατηγορία: Αμυντικός<br>Όνομα: %s<br>Φυλή: %s<br>Θέση: 1<br>Βαθμοί: %s</div>',
    9 => '<span class="gloriatitle">ΜΟΛΩΝ ΛΑΒΕ</span><div class="gloriacontent">Χώρα: %s<br>Σέρβερ: %s<br>Κατηγορία: Αμυντικός<br>Όνομα: %s<br>Φυλή: %s<br>Θέση: 2<br>Βαθμοί: %s</div>',
    10 => '<span class="gloriatitle">ΜΟΛΩΝ ΛΑΒΕ</span><div class="gloriacontent">Χώρα: %s<br>Σέρβερ: %s<br>Κατηγορία: Αμυντικός<br>Όνομα: %s<br>Φυλή: %s<br>Θέση: 3<br>Βαθμοί: %s</div>',
    11 => '<span class="gloriatitle">ΜΟΛΩΝ ΛΑΒΕ</span><div class="gloriacontent">Χώρα: %s<br>Σέρβερ: %s<br>Κατηγορία: Αμυντικός<br>Όνομα: %s<br>Φυλή: %s<br>Θέση: 4<br>Βαθμοί: %s</div>',
    // Ranke Pop Nafarate Avale 1 ta 4
    12 => '<span class="gloriatitle">ΜΟΛΩΝ ΛΑΒΕ</span><div class="gloriacontent">Χώρα: %s<br>Σέρβερ: %s<br>Κατηγορία: Πληθυσμός <br>Όνομα: %s<br>Φυλή: %s<br>Θέση: 1<br>Βαθμοί: %s</div>',
    13 => '<span class="gloriatitle">ΜΟΛΩΝ ΛΑΒΕ</span><div class="gloriacontent">Χώρα: %s<br>Σέρβερ: %s<br>Κατηγορία: Πληθυσμός <br>Όνομα: %s<br>Φυλή: %s<br>Θέση: 2<br>Βαθμοί: %s</div>',
    14 => '<span class="gloriatitle">ΜΟΛΩΝ ΛΑΒΕ</span><div class="gloriacontent">Χώρα: %s<br>Σέρβερ: %s<br>Κατηγορία: Πληθυσμός <br>Όνομα: %s<br>Φυλή: %s<br>Θέση: 3<br>Βαθμοί: %s</div>',
    15 => '<span class="gloriatitle">ΜΟΛΩΝ ΛΑΒΕ</span><div class="gloriacontent">Χώρα: %s<br>Σέρβερ: %s<br>Κατηγορία: Πληθυσμός <br>Όνομα: %s<br>Φυλή: %s<br>Θέση: 4<br>Βαθμοί: %s</div>',
];
//Messages
$Definition['Messages']['Bold'] = 'Έντονα';
$Definition['Messages']['Italic'] = 'Πλάγια';
$Definition['Messages']['Underline'] = 'Υπογραμμισμένα';
$Definition['Messages']['Back to the inbox'] = 'πίσω στα εισερχόμενα';
$Definition['Messages']['You cannot send a message to more than %s users'] = 'Δεν μπορείτε να στείλετε ένα μήνυμα σε περισσότερους από %s χρήστες.';
$Definition['Messages']['spam_unread_protection'] = 'Προστασία κατά της ανεπιθύμητης αλληλογραφίας: Έχετε μη αναγνωσμένα μηνύματα %s που αποστέλλονται σε αυτόν τον παίκτη, δεν μπορείτε να στείλετε μηνύματα σε αυτόν τον παίκτη, έως ότου ο αναγνώστης διαβάσει τα μηνύματα ή θα πρέπει να περιμένετε δύο ώρες.';
$Definition['Messages']['Current message has already been reported as: x'] = 'Το τρέχον μήνυμα έχει ήδη αναφερθεί ως: %s.';
$Definition['Messages']['Error: Very long subject!'] = 'Σφάλμα: Πολύ μακρύ θέμα!';
$Definition['Messages']['Spam protection: Please wait for 10 minutes and try again'] = '<b>Προστασία κατά της ανεπιθύμητης αλληλογραφίας</b>: Περιμένετε 10 λεπτά και δοκιμάστε ξανά.';
$Definition['Messages']['You are currently not part of any alliance'] = 'Δεν είστε μέλος μιας συμμαχίας.';
$Definition['Messages']['Inadmissible message'] = 'Απαράδεκτο μήνυμα.';
$Definition['Messages']['Mark as read'] = 'Μάρκαρε ως διαβασμένο';
$Definition['Messages']['Mark as unread'] = 'Επισήμανση ως μη αναγνωσμένα';
$Definition['Messages']['reportingSuccessful'] = 'Αναφορά με επιτυχία.';
$Definition['Messages']['closeButtonText'] = 'κλείσιμο';
$Definition['Messages']['Messages'] = 'Μηνύματα';
$Definition['Messages']['Inbox'] = 'Εισερχόμενα';
$Definition['Messages']['needClub'] = 'Για τη χρήση αυτής της λειτουργίας χρειάζεται να ενεργοποιήσετε το gold club.';
$Definition['Messages']['Delete'] = 'Διαγραφή';
$Definition['Messages']['Subject'] = 'Θέμα';
$Definition['Messages']['Sender'] = 'Αποστολέας';
$Definition['Messages']['Sent at'] = 'Ελήφθησαν';
$Definition['Messages']['Read'] = 'Διαβασμένο';
$Definition['Messages']['Unread'] = 'Αδιάβαστο';
$Definition['Messages']['Your note is too long!'] = 'Πολύ μεγάλη σημείωση!';
$Definition['Messages']['select all'] = 'Επιλογή όλων';
$Definition['Messages']['Recipient'] = 'Παραλήπτης';
$Definition['Messages']['Choose reason'] = 'Επέλεξε λόγο.';
$Definition['Messages']['Advertisement'] = 'Διαφήμιση';
$Definition['Messages']['harassment'] = 'Παρενόχληση';
$Definition['Messages']['gold'] = 'Αγορά χρυσού';
$Definition['Messages']['Other'] = 'Άλλο';
$Definition['Messages']['report'] = 'Αναφορά';
$Definition['Messages']['Attention: Misuse of the report function is punishable'] = 'Προσοχή: Η κακή χρήση της λειτουργίας αναφοράς είναι αξιόποινη.';
$Definition['Messages']['sender'] = 'Αποστολέας';
$Definition['Messages']['Report as spam'] = 'Αναφορά ως ανεπιθύμητο';
$Definition['Messages']['back to send box'] = 'πίσω στα εισερχόμενα';
$Definition['Messages']['There are no messages available in the sentbox'] = ' Δεν υπάρχουν εξερχόμενα μηνύματα.';
$Definition['Messages']['There are no messages available in the inbox'] = 'Δεν υπάρχουν διαθέσιμα μηνύματα στα Εισερχόμενα.';
$Definition['Messages']['There are no messages available in the archive'] = 'Δεν υπάρχουν διαθέσιμα μηνύματα στo αρχείο.';
$Definition['Messages']['waiting for confirmation'] = 'Αναμονή για επιβεβαίωση';
$Definition['Messages']['Recover'] = 'Ανάκτηση';
$Definition['Messages']['Addressbook'] = 'Bιβλίο διευθύνσεων';
$Definition['Messages']['send'] = 'Αποστολή';
$Definition['Messages']['Alliance'] = 'Συμμαχία';
$Definition['Messages']['xxx wrote:'] = '%s έγραψε:';
$Definition['Messages']['You dont have permission here'] = 'Δεν έχετε άδεια εδώ';
$Definition['Messages']['player x does not exists'] = 'Ο παίκτης %s δεν υπάρχει.';
$Definition['Messages']['you send your last message in x and you will be able to send message in y'] = 'Στείλατε το τελευταίο σας μήνυμα στις %s και θα μπορείτε να στείλετε μηνύματα στις %s.';
$Definition['Messages']['no subject'] = 'Χωρίς θέμα';
$Definition['Messages']['ConfirmDelete'] = 'Πραγματικά θέλετε να διαγράψετε αυτό το μήνυμα;';
$Definition['Messages']['answer'] = 'Απάντηση';
$Definition['Messages']['Player'] = 'Παίκτης';
$Definition['Messages']['Coordinates'] = 'Συντεταγμένες';
$Definition['Messages']['report'] = 'Αναφορά';
$Definition['Messages']['Troops'] = 'Στρατεύματα';
$Definition['Messages']['preview'] = 'Επισκόπηση';
$Definition['Messages']['to the inbox'] = 'στα εισερχόμενα';
$Definition['Messages']['Write'] = 'Γράψε';
$Definition['Messages']['Sent'] = 'Αποστολή';
$Definition['Messages']['- saved -'] = '- Αποθηκεύτηκε -';
$Definition['Messages']['Archive'] = 'Αρχείο';
$Definition['Messages']['Notes'] = 'Σημειώσεις';
$Definition['Messages']['Ignored players'] = 'Αγνοημένοι παίκτες';
$Definition['Messages']['online now'] = 'Σε σύνδεση(online)';
$Definition['Messages']['active players'] = 'μέγιστο 10 ώρες';
$Definition['Messages']['active 3days'] = 'μέγιστο 3 μέρες';
$Definition['Messages']['active 7days'] = 'μέγιστο 7 μέρες';
$Definition['Messages']['inactive'] = 'ανενεργοί';
$Definition['Messages']['Ambassador'] = 'Ambassador';
$Definition['Messages']['Alliance Invitation received'] = 'Πρόσκληση συμμαχίας ελήφθει';
$Definition['Messages']['Alliance Invitation revoked'] = 'Η πρόσκληση της συμμαχίας ανακλήθηκε';
$Definition['Messages']['Spam protection: You must have at least %s pop to be able to send messages'] = 'Προστασία κατά της ανεπιθύμητης αλληλογραφίας: Πρέπει να έχετε τουλάχιστον %s pop για να μπορείτε να στέλνετε μηνύματα';
$Definition['Messages']['AllianceInvitationRevokeText'] = <<<HTML
Γειά σου %s,
<br /><br />
η πρόσκληση για να προσχωρήσεις στη συμμαχία %s έχει ανακληθεί από τον %s.
<br /><br />
Καλή διασκέδαση και τύχη.
HTML;
$Definition['Messages']['AllianceInvitationReceiveText'] = <<<HTML
Γειά σου %s,
<br /><br />
έχεις προσκληθεί από τον %s να προσχωρήσεις στη συμμαχία %s.
<br /><br />
Για να αποδεχτείς την πρόσκληση πήγαινε στην πρεσβία. Αν δεν υπάρχει πρεσβία, χτήστε μια πρώτα.
<br /><br />
Καλή διασκέδαση και τύχη.
HTML;
$Definition['Messages']['WrittenBySitter%s'] = '- Γράφηκε από τον Sitter %s -';

//NotFound
$Definition['notFound']['title'] = 'Δεν υπάρχει τίποτα εδώ!';
$Definition['notFound']['desc'] = 'We looked 404 times already but can\'t find anything';
//NPC
$Definition['npc'] = ["disabled_in_ww" => "Δεν μπορείτε να χρησιμοποιήσετε αυτή την επιλογή σε χωριό Παγκοσμίου Θαύματος.",
    'npc_desc' => 'Με τον NPC έμπορο, μπορείτε να μοιράσετε τις ύλες στις αποθήκες σας όπως επιθυμείτε.<br><br>Η πρώτη γραμμή σας δείχνει τις υπάρχουσες αποθηκευμένες ύλες. Στην δεύτερη γραμμή μπορείτε να επιλέξετε μια άλλη κατανομή. Η τρίτη γραμμή σας δείχνει την διαφορά μεταξύ της παλιάς και της νέας ποσότητας αποθήκευσης.',
    'sum' => 'Σύνολο',
    'distribute_remaining_resources' => 'Μοίρασε τις υπόλοιπες ύλες',
    'exchangeResources' => 'Ανταλλαγή υλών',
    'redeem_now' => 'Εξαγορά τώρα',
    'redeem' => 'Εξαγορά',
    'remain' => 'Υπόλοιπο',
    "build_marketPlace" => "Χρειάζεται να κτίστε μια αγορά πρώτα",
];
//Options
$Definition['Options']['Change name'] = 'Αλλαγή ονόματος';
$Definition['Options']['Yes'] = 'Ναι';
$Definition['Options']['No'] = 'Όχι';
$Definition['Options']['You need to wait 7 days before deletion'] = 'Δυστυχώς, δεν μπορείτε να μεταφέρετε το χρυσό σας τώρα. Εάν έχετε οποιεσδήποτε ερωτήσεις, στείλτε ένα μήνυμα ηλεκτρονικού ταχυδρομείου στο plus@' . (WebService::getJustDomain()) . '.';
$Definition['Options']['Newsletter'] = 'Λήψη νέων';
$Definition['Options']['sitter'] = 'Sitter';
$Definition['Options']['Sitter(s) for this account'] = 'Sitter γι αυτόν τον λογαριασμό';
$Definition['Options']['Sitting for other account(s)'] = 'Sitter σε άλλο λογαριασμό';
$Definition['Options']['Sitting for other account(s)Desc'] = 'Έχεις εισαχθεί ως sitter στους ακόλουθους λογαριασμούς. Μπορείς να ακυρώσεις αυτή την ιδιότητα πατώντας το κόκκινο x.';
$Definition['Options']['MySittersDesc'] = 'Ένας sitter μπορεί να συνδεθεί στον λογαριασμό σου χρησιμοποιώντας το δικό σου όνομα χρήστη και τον δικό του κωδικό πρόσβασης. Μπορείς να έχεις μέχρι δύο sitters.';
$Definition['Options']['no entry'] = 'καμία';
$Definition['Options']['Here you can subscribe or unsubscribe to our newsletter'] = 'Εδώ μπορείτε να εγγραφείτε ή να απεγγραφείτε από την λήψη νέων.';
$Definition['Options']['Travian Games'] = 'Travian Games';
$Definition['Options']['invalid old email'] = 'Το παλιό μήνυμα ηλεκτρονικού ταχυδρομείου είναι άκυρο.';
$Definition['Options']['invalid new email'] = 'Το νέο μήνυμα ηλεκτρονικού ταχυδρομείου είναι άκυρο!';
$Definition['Options']['Receive notifications about invitations to an alliance'] = 'Λήψη ενημέρωσης για προσκλήσεις σε συμμαχίες';
$Definition['Options']['new email exists'] = 'Το νέο email υπάρχει ήδη.';
$Definition['Options']['Name black listed'] = 'Το νέο όνομα λογαριασμού είτε υπάρχει ήδη είτε δεν επιτρέπεται. Δοκιμάστε άλλο όνομα.';
$Definition['Options']['Name exists'] = 'Το νέο όνομα λογαριασμού είτε υπάρχει ήδη είτε δεν επιτρέπεται. Δοκιμάστε ένα άλλο όνομα.';
$Definition['Options']['Name too short'] = 'Πολύ μικρό όνομα.';
$Definition['Options']['Name too long'] = 'Πολύ μεγάλο όνομα.';
$Definition['Options']['Please enter a new account name and confirmation password'] = 'Εισαγάγετε ένα νέο όνομα λογαριασμού και κωδικό επιβεβαίωσης.';
$Definition['Options']['Confirmation password does not match'] = 'Ο κωδικός επιβεβαίωσης δεν ταιριάζει.';
$Definition['Options']['Confirm with password'] = 'Επιβεβαίωση με κωδικό';
$Definition['Options']['Change account name'] = 'Αλλαγή ονόματος λογαριασμού:';
$Definition['Options']['Number of changes'] = 'Αριθμός αλλαγών';
$Definition['Options']['Enter new account name'] = 'Γράψτε νέο όνομα χρήστη';
$Definition['Options']['changeNameDesc'] = 'Μπορείτε να αλλάξετε το όνομα του λογαριασμού σας εδώ. Λάβετε υπόψη ότι το όνομα του λογαριασμού σας ενδέχεται να μην παραβιάζει τους κανόνες του παιχνιδιού ή τους όρους και τις προϋποθέσεις. Μπορείτε να αλλάξετε το όνομα του λογαριασμού σας δωρεάν για %s φορές ή έως ότου φτάσετε %s πληθυσμό. Στη συνέχεια, η αλλαγή του ονόματος του λογαριασμού σας θα χρεωθεί με %s χρυσά. Δεν είναι δυνατή η αλλαγή ονόματος λογαριασμού με πληθυσμό μεγαλύτερο από %s!';
$Definition['Options']['Change password'] = 'Αλλαγή κωδικού';
$Definition['Options']['Old Password'] = 'Παλιός κωδικός';
$Definition['Options']['New Password'] = 'Νέος κωδικός';
$Definition['Options']['confirm'] = 'Επιβεβαίωση';
$Definition['Options']['Change email'] = 'Αλλαγή Email';
$Definition['Options']['Old email'] = 'Παλαιό E-Mail';
$Definition['Options']['New email'] = 'Νέο E-Mail';
$Definition['Options']['Change email desc'] = 'Παρακαλώ γράψτε το παλαιό και νέο σας email. Τότε θα λάβετε έναν κωδικό και στις δυο διευθύνσεις email τον οποίο πρέπει να βάλετε εδώ';
$Definition['Options']['Game'] = 'Παιχνίδι';
$Definition['Options']['Account'] = 'Λογαριασμός';
$Definition['Options']['Delete account'] = 'Διαγραφή λογαριασμού';
$Definition['Options']['Delete account?'] = 'Διαγραφή λογαριασμού? ';
$Definition['Options']['Sitter'] = 'Sitter';
$Definition['Options']['Preferences'] = 'Ρυθμίσεις';
$Definition['Options']['Report filter'] = 'Φίλτρο αναφορών';
$Definition['Options']['Auto-complete'] = 'Αυτόματη-συμπλήρωση';
$Definition['Options']['No reports about transfers between your own villages'] = 'Καμία αναφορά για τις μεταφορές πρώτων υλών ανάμεσα σε δικά μου χωριά.';
$Definition['Options']['No reports about transfers to foreign villages'] = 'Καμία αναφορά για τις μεταφορές πρώτων υλών σε ξένα χωριά.';
$Definition['Options']['No reports about transfers from foreign villages'] = 'Καμία αναφορά για τις μεταφορές πρώτων υλών από ξένα χωριά.';
$Definition['Options']['The LowRes version does not display images in reports'] = 'Η έκδοση LowRes δεν εμφανίζει εικόνες στις αναφορές.';
$Definition['Options']['Complete for rally point and marketplace'] = 'Χρησιμοποιείτε για την Πλατεία συνέλευσης και την Αγορά';
$Definition['Options']['Own villages'] = 'Τα χωριά μου';
$Definition['Options']['Nearby villages'] = 'Χωριά των περιχώρων';
$Definition['Options']["Alliance members' villages"] = 'Χωριά από τους παίκτες της συμμαχίας';
$Definition['Options']["Display"] = 'Εμφάνιση';
$Definition['Options']["Don't display images in reports"] = 'Μη εμφάνιση εικόνων στις αναφορές.';
$Definition['Options']["Messages and reports per page"] = 'Μηνύματα και αναφορές ανά σελίδα';
$Definition['Options']["Troop movements per page in rally point"] = 'Μετακινήσεις στρατευμάτων ανά σελίδα στην Πλατεία συγκέντρωσης:';
$Definition['Options']["Time zone preferences"] = 'Ρυθμίσεις ώρας';
$Definition['Options']["You can change your time zone here"] = 'Εδώ μπορείς να αλλάξεις την ώρα στο ρολόι του Travian ώστε να αντιστοιχεί στην χρονική σου ζώνη';
$Definition['Options']["Time zone"] = 'Επιλέξτε ζώνη';
$Definition['Options']["Date format"] = 'Ημερομηνία';
$Definition['Options']["local time zones"] = 'Τοπικές χρονικές ζώνες';
$Definition['Options']["general time zones"] = 'Γενικές χρονικές ζώνες';
$Definition['Options']["change_mail_desc"] = 'Ο κωδικός επαλήθευσης στάλθηκε τόσο στη παλιά όσο και στη νέα διευθύνση ηλεκτρονικού ταχυδρομείου. Πληκτρολογήστε και τα δύο στα σωστά πεδία.';
$Definition['Options']["Old email code"] = 'Κωδικός από παλιό email';
$Definition['Options']["New email code"] = 'Κωδικός από νέο email';
$Definition['Options']["x of y changes"] = '%s από %s αλλαγές';
$Definition['Options']["password wrong"] = 'Ο κωδικός πρόσβασης είναι λάθος.';
$Definition['Options']["deleteDesc"] = 'Εδώ μπορείς να διαγράψεις τον λογαριασμό σου. Αφού αρχίσεις την διαδικασία διαγραφής, θα πάρει 3 ημέρες για να ολοκληρωθεί η διαγραφή του λογαριασμού σου.';
$Definition['Options']["codes are not correct"] = 'Μη έγκυροι κωδικοί!';
$Definition['Options']["email_changed"] = 'Email changed';
$Definition['Options']["Email change is in progress"] = 'Η αλλαγή ηλεκτρονικού ταχυδρομείου βρίσκεται σε εξέλιξη. ';
$Definition['Options']["EmailChange_new_subject"] = 'Αλλαγή email του λογαριασμού στο Travian μέρος 2';
$Definition['Options']["EmailChange_new"] = '<div style="text-align: left; direction: LTR">
Hello %s,

you have selected this email address as the new email for your Travian account
on world comx. Please enter the following code in the box "Code new address" in
your profile located in the "account" tab:

Code: %s

You will receive another email to your old address with a second code which you
should enter in the box "Code old address".
</div>
';
$Definition['Options']["EmailChange_old_subject"] = 'Αλλαγή email του λογαριασμού στο Travian μέρος 1';
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
$Definition['Options']['Vacation'] = 'Διακοπές';
$Definition['Options']['Use the vacation to protect your villages while being abroad'] = 'Χρησιμοποιήστε την κατάσταση διακοπών για να προστατέψετε το χωριό σας ενώ είστε μακριά.';
$Definition['Options']['While in vacation mode the following actions will be deactivated'] = 'Όταν βρίσκεστε σε κατάσταση διακοπών, οι ακόλουθες ενέργειες δεν θα είναι δυνατές';
$Definition['Options']['send or receive troops'] = 'αποστολή ή λήψη στρατευμάτων';
$Definition['Options']['start new building orders'] = 'αρχή νέων κατασκευών';
$Definition['Options']['using the marketplace'] = 'χρήση της αγοράς';
$Definition['Options']['start training troops'] = 'έναρξη εκπαίδευσης στρατευμάτων';
$Definition['Options']['join alliances'] = 'ένταξη σε συμμαχία';
$Definition['Options']['delete your account'] = 'διαγραφή λογαριασμού';
$Definition['Options']['Alliance settings'] = 'Ρυθμίσεις συμμαχίας';
$Definition['Options']['Show alliance news'] = 'Εμφάνιση ειδοποιήσεων συμμαχιών';
$Definition['Options']['Alliance members founded new village'] = 'Τα μέλη της συμμαχίας που ίδρυσαν νέο χωριό';
$Definition['Options']['New alliance member joined'] = 'Όταν ένα νεο μέλος της συμμαχίας εντάχθηκε';
$Definition['Options']['Player has been invited'] = 'Όταν ο παίκτης έχει προσκληθεί';
$Definition['Options']['Player has left alliance'] = 'Όταν ο παίκτης αποχωρήσει από την συμμαχία';
$Definition['Options']['Player was kicked from alliance'] = 'Ο ένας παίκτης διωχθεί από τη συμμαχία';
$Definition['Options']['There are no outgoing troops'] = 'Δεν υπάρχουν εξερχόμενα στρατεύματα';
$Definition['Options']['There are no incoming troops'] = 'Δεν υπάρχουν εισερχόμενα στρατεύματα';
$Definition['Options']['There are no troops reinforing other players'] = 'Δεν υπάρχουν στρατεύματα που να ενισχύουν άλλους παίκτες';
$Definition['Options']['No other player reinforces you'] = 'Δεν έχετε ενισχύσεις από άλλους παίκτες';
$Definition['Options']['You dont own a Wonder of the World Village'] = 'Δεν σας ανήκει χωριό Παγκοσμίου Θαύματος';
$Definition['Options']['You dont own an artifact'] = 'Δεν σας ανήκει κάποιο Πολύτιμο Αντικείμενο';
$Definition['Options']['You dont have beginners protection left'] = 'Δεν σας έχει απομείνει προστασία νέου παίκτη';
$Definition['Options']['There are no troops in your traps'] = 'Δεν υπάρχουν στρατεύματα στις παγίδες σας';
$Definition['Options']['x/9 conditions met'] = '%s/9 προϋποθέσεις για διακοπές';
$Definition['Options']['Available Days x/y'] = 'Διαθέσιμες ημέρες %s/%s';
$Definition['Options']['How many days should the vacation mode last'] = 'Πόσο θέλετε να διαρκέσει η κατάσταση διακοπών σας';
$Definition['Options']['Vacation til'] = 'Διακοπές μέχρι';
$Definition['Options']['Your account is not in deletion'] = 'Ο λογαριασμός σας δεν βρίσκεται σε διαγραφή';
$Definition['Options']['enter vacation mode now'] = 'Μπείτε σε κατάσταση διακοπών τώρα';
$Definition['Options']['Vacation mode is active'] = 'Η κατάσταση διακοπών είναι ενεργή';
$Definition['Options']['Are you sure you want to enter vacation mode?'] = 'Κατά την διάρκεια της κατάστασης διακοπών ο λογαριασμός σας θα προστατεύεται';
$Definition['Options']['Your account will be protected, and the resource production will continue'] = 'Ωστόσο, η παραγωγή υλών θα συνεχίζεται και τα στρατεύματά σας θα καταναλώνουν σιτάρι.';
$Definition['Options']['So will the crop consumption by troops too, which may lead to troop starvation'] = 'Αυτό μπορεί να οδηγήσει στον θάνατο από ασιτία</br></br>Μπορείτε να ακυρώσετε την κατάσταση διακοπών οποιαδήποτε στιγμή με την χρήση Χρυσού.';
$Definition['Options']['Your are not able to'] = 'Δεν μπορείτε να';
$Definition['Options']['upgrade buildings'] = 'αναβαθμίσετε κτήρια';
$Definition['Options']['train troops'] = 'εκπαιδεύσετε στρατεύματα';
$Definition['Options']['send troops'] = 'στείλετε στρατεύματα';
$Definition['Options']['send merchants'] = 'στείλετε εμπόρους';
$Definition['Options']['delete your account'] = 'διαγράψετε τον λογαριασμό σας';
$Definition['Options']['Remaining days in vacation mode'] = 'Μέρες που απομένουν σε κατάσταση διακοπών';
$Definition['Options']['day(s)'] = 'μέρες';
$Definition['Options']['You can abort vacation mode now'] = 'Μπορείτε να βγείτε από την κατάσταση διακοπών τώρα';
$Definition['Options']['abort vacation mode'] = 'Ακυρώστε κατάσταση διακοπών';
$Definition['Options']['Vacation mode runs til'] = 'Η κατάσταση διακοπών ισχύει μέχρι τις';
$Definition['Options']['player name'] = 'Όνομα παίκτη';
$Definition['Options']['Send raids'] = 'Αποστολή επιδρομών';
$Definition['Options']['Send reinforcements to other players'] = 'Αποστολή ενισχύσεων σε άλλους παίκτες';
$Definition['Options']['Send resources to other players'] = 'Αποστολή υλών σε άλλους παίκτες';
$Definition['Options']['Buy and spend Gold'] = 'Αγορά και κατανάλωση Χρυσού';
$Definition['Options']['Delete and archive messages and reports'] = 'Διάβασμα και αποστολή μηνυμάτων';
$Definition['Options']['Contribute resources to alliance bonuses'] = 'Contribute resources to alliance bonuses';
$Definition['Options']['Read and send messages'] = 'Διαγραφή και αρχειοθέτηση μηνυμάτων και αναφορών';
$Definition['Options']['language settings'] = 'Επιλογή Γλώσσας';
$Definition['Options']['Language'] = 'Γλώσσα';
$Definition['Options']['Support colorBlind title'] = 'Υποστήριξη αχρωματοψίας';
$Definition['Options']['Use colorBlind?'] = 'Χρήση υποστήριξης αχρωματοψίας?';
$Definition['Options']['Support colorBlind desc'] = 'Μπορείτε να ενεργοποιήσετε την υποστήριξη αχρωματοψίας για να χρησιμοποιήσετε βελτιωμένες εικόνες και καλύτερα χρώματα. Αυτή η μέθοδος δεν αλλάζει την μηχανική του παιχνιδιού.';
$Definition['Options']['Transfer gold'] = 'Μεταφορά χρυσού';
$Definition['Options']['You have Gold %s pieces of gold, %s pieces can be transferred after deleting your account!'] = 'Έχετε %s χρυσά νομίσματα. %s από αυτά μπορούν να μεταφερθούν διαγράφοντας το λογαριασμό σας.';
$Definition['Options']['Auto reload status'] = 'Ρυθμίσεις αυτόματης επαναφόρτισης';
$Definition['Options']['Enable auto reload?'] = 'Eνεργοποιήστε την αυτόματη επαναφόρτωση?';
$Definition['Options']['Use fast upgrade on buildings'] = 'Χρησιμοποιήστε γρήγορη αναβάθμιση στα κτίρια';
$Definition['Options']['This player is sitter for 2 players'] = 'Αυτός ο παίκτης είναι sitter σε 2 λογαριασμούς.';
$Definition['Options']['You can set the page to auto reload, the page will be automatically refreshed when timer reaches 0'] = 'Μπορείτε να ρυθμίσετε τη σελίδα να φορτώνεται αυτόματα, η σελίδα θα ανανεώνεται αυτόματα όταν ο χρονομετρητής φτάσει στο 0.';
$Definition['Options']['Graphic pack'] = 'Πακέτο Γραφικών';
$Definition['Options']['You can change the way the game looks for you'] = 'Μπορείτε να αλλάξετε το πακέτο γραφικών';
$Definition['Options']['new'] = 'Νέο';
//PaymentWizard
$Definition['PaymentWizard']['You have a WW village or Artifact So you cannot use this feature'] = 'Έχετε ένα χωριό WW ή αντικείμενο. Έτσι δεν μπορείτε να χρησιμοποιήσετε αυτό το χαρακτηριστικό.';
$Definition['PaymentWizard']['Gold'] = 'Χρυσό';
$Definition['PaymentWizard']['goldClub'] = 'Gold club';
$Definition['PaymentWizard']['x gold moneyUnit'] = '%s Χρυσό %s %s';
$Definition['PaymentWizard']['paymentUnAvailable'] = 'Αυτήν τη στιγμή η πληρωμή δεν είναι διαθέσιμη.';
$Definition['PaymentWizard']['location'] = 'Χώρα';
$Definition['PaymentWizard']['ChangeLocation'] = 'Αλλαγή χώρας';
$Definition['PaymentWizard']['Package'] = 'Πακέτα';
$Definition['PaymentWizard']['ChoosePackage'] = 'επιλέξτε πακέτο';
$Definition['PaymentWizard']['changePackage'] = 'αλλαγή πακέτου';
$Definition['PaymentWizard']['BuySettings'] = 'Ρύθμιση αγοράς';
$Definition['PaymentWizard']['hour'] = 'ώρες';
$Definition['PaymentWizard']['Not Available yet'] = 'Δεν είναι ακόμα διαθέσιμο';
$Definition['PaymentWizard']['All displayed prices are final prices'] = 'Όλες οι τιμές είναι τελικές';
$Definition['PaymentWizard']['You can check the status of your order at any time'] = 'Μπορείτε να ελέγξετε την κατάσταση της παραγγελίας σας ανά πάσα στιγμή.';
$Definition['PaymentWizard']['Show open orders'] = 'Εμφάνιση ανοικτών παραγγελιών';
$Definition['PaymentWizard']['Hide open orders'] = 'Απόκρυψη ανοικτών παραγγελιών';
$Definition['PaymentWizard']['Payment options:'] = 'Επιλογές πληρωμής:';
$Definition['PaymentWizard']['Show payment methods'] = 'Εμφάνιση μεθόδων πληρωμής';
$Definition['PaymentWizard']['Buy gold'] = 'Αγοράστε χρυσό';
$Definition['PaymentWizard']['Advantages'] = 'Πλεονεκτήματα';
$Definition['PaymentWizard']['Plus Support'] = 'Υποστήριξη Plus';
$Definition['PaymentWizard']['Earn Gold'] = 'Κέρδισε χρυσό';
$Definition['PaymentWizard']['Delivery:'] = 'Μεταφορά:';
$Definition['PaymentWizard']['Select payment method'] = 'Επέλεξε μέθοδο πληρωμής';
$Definition['PaymentWizard']['Step3-ChoosePayment'] = 'Βήμα3 - Επέλεξε πληρωμή';
$Definition['PaymentWizard']['step'] = 'Βήμα';
$Definition['PaymentWizard']['notEnoughGoldForThisOption'] = 'Δεν έχετε αρκετό χρυσό για να χρησιμοποιήσετε αυτό το στοιχείο!';
$Definition['PaymentWizard']['ChooseAnotherPackage'] = 'Επιλέξτε ένα διαφορετικό πακέτο';
$Definition['PaymentWizard']['BuyNow'] = 'Θα αγοράσετε χρυσό τώρα;';
$Definition['PaymentWizard']['Gold'] = 'Χρυσός';
$Definition['PaymentWizard']['Please activate advantage that you can choose'] = 'Παρακαλώ διάλεξε ποιο πλεονέκτημα θα ήθελες να ξεκλειδώσεις';
$Definition['PaymentWizard']['ToTheEndOfTheGame'] = ' όλο τον γύρο του παιχνιδιού';
$Definition['PaymentWizard']['Days remaining'] = 'Ημέρες που απομένουν:';
$Definition['PaymentWizard']['until'] = '. Μέχρι τις:';
$Definition['PaymentWizard']['EndsAtX'] = 'Το επίδομα λήγει στις %s.';
$Definition['PaymentWizard']['Bonus duration'] = 'Διάρκεια επιδόματος';
$Definition['PaymentWizard']['Days'] = 'Mέρες';
$Definition['PaymentWizard']['Payment rules'] = 'Κανόνες πληρωμής';
$Definition['PaymentWizard']['PaymentRulesHTML'] = '<div style="width: 400px; font-size: 13px;"><h1 style="color: red; text-align: center;">Buy Gold Rules</h1>
<h2>Κανόνες αγοράς χρυσού</h2><h3>1. Automated system</h3>Our Payment system is automatic and after successful buy ,Gold will added to your account automatically<h3>
2. The system didn\'t give your gold?</h3>Sometime System will stuck or the gateways need to check the information before let us know and the gold will not transfer to user account! in this case you can\'t Get your money 
!! Just send a message to multihunter and we will add your gold as soon as possible.<h3 style="color: red;">Important:</h3><p>If you buy gold and play with it and request paypal for your money 
, we can\'t accept that and your account will be banned!</p><h3 style="color: red;">Important:</h3>if Our system goes Down we will give you extra gold or ... to make you happy and get 
you to the game.<h3 style="color: red;">Important:</h3>You can\'t Request for get your money from us or <b>PayPal</b> for any reason.<h3 style="color: red;">Important:</h3>if Our system shut down for more than 1 day we will get 
your gold</p><p>You <b>Should</b> read these rules before buy any golds, by buying gold you accepted our rules!.</div>';
$Definition['PaymentWizard']['Extend automatically'] = 'αυτόματη επέκταση';
$Definition['PaymentWizard']['Activated To End Of the game'] = 'Ενεργοποιημένο για <b>όλο τον γύρο του παιχνιδιού</b>';
$Definition['PaymentWizard']['GoldClub'] = 'Gold club';
$Definition['PaymentWizard']['goldClubDesc'] = '<p>Τα πλεονεκτήματα ισχύουν για όλο τον γύρο του παιχνιδιού!</p>
<p>Οι έμποροι μπορούν να στείλουν ύλες πολλές φορές, μπορείς να βρεις πεδία με μεγάλη παραγωγή σιταριού γρηγορότερα στον χάρτη και να αρχειοθετήσεις τα μηνύματά και τις αναφορές σου. Χρησιμοποίησε την λίστα με φάρμες για να διαχειριστής τις επιθέσεις σου και άσε τα στρατεύματά σου να αποφεύγουν τις επιθέσεις στην πρωτεύουσά σου!</p>';
$Definition['PaymentWizard']['Plus'] = 'Travian Plus';
$Definition['PaymentWizard']['PlusDesc'] = ' <p>Σου δίνει την δυνατότητα να έχεις καλύτερη επισκόπηση και άλλα πλεονεκτήματα για το ενδεδειγμένο χρονικό διάστημα!</p>
                <p>Προσάρμοσε το παιχνίδι στον τρόπο παιχνιδιού σου με απευθείας link και την χρήση καλύτερης επισκόπησης του μεγάλου χάρτη. Λαμβάνεις προειδοποίηση επιθέσεων και λεπτομερείς πληροφορίες στην επισκόπηση χωριών. Οι έμποροι μπορούν να επαναλάβουν μια αποστολή υλών δεύτερη φορά και μπορείς να βάλεις στην σειρά εργασίες κατασκευής!</p>';
$Definition['PaymentWizard']['+25Wood'] = '+25% παραγωγή ξυλείας';
$Definition['PaymentWizard']['+25WoodDesc'] = ' <p>Δίνει 25% αύξηση παραγωγής στην επιλεγμένη ύλη σε όλα τα χωριά σου για το χρονικό διάστημα που αναφέρεται.</p>
                <p>Το επίδομα 25% δεν ισχύει μόνο για την βασική παραγωγή υλών αλλά και για όλα τα άλλα επιδόματα!</p>';
$Definition['PaymentWizard']['+25Clay'] = '+25% παραγωγή πηλού';
$Definition['PaymentWizard']['+25ClayDesc'] = '<p>Δίνει 25% αύξηση παραγωγής στην επιλεγμένη ύλη σε όλα τα χωριά σου για το χρονικό διάστημα που αναφέρεται.</p>
                <p>Το επίδομα 25% δεν ισχύει μόνο για την βασική παραγωγή υλών αλλά και για όλα τα άλλα επιδόματα!</p>';
$Definition['PaymentWizard']['+25Iron'] = '+25% παραγωγή σιδήρου';
$Definition['PaymentWizard']['+25IronDesc'] = ' <p>Δίνει 25% αύξηση παραγωγής στην επιλεγμένη ύλη σε όλα τα χωριά σου για το χρονικό διάστημα που αναφέρεται.</p>
                <p>Το επίδομα 25% δεν ισχύει μόνο για την βασική παραγωγή υλών αλλά και για όλα τα άλλα επιδόματα!</p>';
$Definition['PaymentWizard']['+25Crop'] = '+25% παραγωγή σιταριού';
$Definition['PaymentWizard']['+25CropDesc'] = '<p>Δίνει 25% αύξηση παραγωγής στην επιλεγμένη ύλη σε όλα τα χωριά σου για το χρονικό διάστημα που αναφέρεται.</p>
                <p>Το επίδομα 25% δεν ισχύει μόνο για την βασική παραγωγή υλών αλλά και για όλα τα άλλα επιδόματα!</p>';
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
$Definition['PaymentWizard']['How can I invite players?'] = 'Πως προσκαλώ παίκτες;';
$Definition['PaymentWizard']['Players invited so far'] = 'Επισκόπηση παικτών που προσκαλέστηκαν';
$Definition['PaymentWizard']['If you invite players to open an account in Travian on this server, you can receive Gold as a reward, You can use this Gold to purchase a Plus Account or other Gold advantages'] = 'Αν καλέσεις παίκτες για να ανοίξουν έναν λογαριασμό σε αυτόν τον server, μπορείς να λάβεις χρυσό σαν ανταμοιβή.';
$Definition['PaymentWizard']['To bring in new players, you can invite them by email or have them click on your REF link'] = 'Μπορείς να χρησιμοποιήσεις αυτόν τον χρυσό για να αγοράσεις έναν Λογαριασμό Plusα ή άλλα πλεονεκτήματα του Plus. Μπορείς να καλέσεις έναν παίκτη μέσω email ή δίνοντάς τους να πατήσουν στο REF link σου';
$Definition['PaymentWizard']['As soon as an invited player has reached x villages'] = 'Μόλις ένας παίκτης που προσκάλεσες φτάσει τα <span class="amount">2</span> χωριά, θα λάβεις <span class="goldReward"><img src="img/x.gif" class="gold" alt="Gold"> <span class="amount">' . Config::getProperty("gold", "invitePlayerGold") . '.</span></span>';
$Definition['PaymentWizard']['
to overview'] = 'πίσω στην επισκόπηση.';
$Definition['PaymentWizard']['Choose an option to earn gold'] = 'Διάλεξε έναν τρόπο να κερδίσεις χρυσό';
$Definition['PaymentWizard']['Send link to friends'] = 'Αποστολή link σε φίλους';
$Definition['PaymentWizard']['You can send a link to your friends via email, inviting them to Travian'] = 'Μπορείς να στείλεις ένα link σε φίλους σου μέσω email, προσκαλώντας τους στο Travian.';
$Definition['PaymentWizard']['Send email to friends'] = 'Αποστολή email σε φίλους';
$Definition['PaymentWizard']['Your personal referral link'] = 'Το προσωπικό σας link αναφοράς';
$Definition['PaymentWizard']['Display a list of all the players you have invited so far'] = 'Δείξε μια λίστα όλων των παικτών που έχεις προσκαλέσει μέχρι τώρα.';
$Definition['PaymentWizard']['Display list of all invited players'] = 'Δείξε μια λίστα όλων των παικτών που έχεις προσκαλέσει';
$Definition['PaymentWizard']['Please enter recipients email addresses'] = 'Παρακαλώ γράψε τις διευθύνσεις email των παραληπτών';
$Definition['PaymentWizard']['Recipient 1'] = 'Παραλήπτης 1';
$Definition['PaymentWizard']['Recipient 2'] = 'Παραλήπτης 2';
$Definition['PaymentWizard']['Add more people'] = 'Πρόσθεσε περισσότερα άτομα';
$Definition['PaymentWizard']['Add a personal message (optional)'] = 'Πρόσθεσε ένα προσωπικό μήνυμα (προαιρετικό)';
$Definition['PaymentWizard']['Cancel'] = 'Ακύρωση';
$Definition['PaymentWizard']['Send invitation'] = 'Αποστολή πρόσκλησης';

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
$Definition['PaymentWizard']['World'] = 'Κόσμος';
$Definition['PaymentWizard']['UID'] = 'UID';
$Definition['PaymentWizard']['Member since'] = 'Μέλος από';
$Definition['PaymentWizard']['Inhabitants'] = 'Κάτοικοι';
$Definition['PaymentWizard']['Villages'] = 'Χωριά';
$Definition['PaymentWizard']['paymentFeatures'] = 'Επιλογές Plus';
$Definition['PaymentWizard']['Troops'] = 'Troops';
$Definition['PaymentWizard']['buyAnimal'] = 'Buy animal';
$Definition['PaymentWizard']['General'] = 'Γενικά';
$Definition['PaymentWizard']['GeneralOptions'] = 'Γενικές επιλογές';
$Definition['PaymentWizard']['buyTroops'] = 'Buy Troops';
$Definition['PaymentWizard']['buyResources'] = 'Buy resources';
$Definition['PaymentWizard']['WWDisabled'] = 'You can\'t use this feature in a WW Village.';
$Definition['PaymentWizard']['Buy'] = 'Αγορά';
$Definition['PaymentWizard']['delivery'] = 'Delivery';
$Definition['PaymentWizard']['Immediately'] = 'Immediately';
$Definition['PaymentWizard']['Minutes'] = 'min(s)';
$Definition['PaymentWizard']['upgradeAllResourcesTo20'] = 'Upgrade Resources Fields to level 20';
$Definition['PaymentWizard']['upgradeAllResourcesTo20Desc'] = 'Upgrade Resources Fields to level 20.';
$Definition['PaymentWizard']['upgradeAllResourcesTo30'] = 'Upgrade Resources Fields to level 30';
$Definition['PaymentWizard']['upgradeAllResourcesTo30Desc'] = 'Upgrade Resources Fields to level 30.';
$Definition['PaymentWizard']['rallyPointTo20'] = 'Build RallyPoint level 20';
$Definition['PaymentWizard']['rallyPointTo20Desc'] = 'Build a level 20 rally point on current village.';
$Definition['PaymentWizard']['oneHourOfProduction'] = 'Buy 1 hour village production Resource';
$Definition['PaymentWizard']['oneHourOfProductionDesc'] = '1 hour of your resource production, will be added to your current village.';
$Definition['PaymentWizard']['finishTraining'] = 'Finish All Training troops Instant';
$Definition['PaymentWizard']['finishTrainingDesc'] = 'All your troops on the queue list in the current village will train instantly.';
$Definition['PaymentWizard']['moreProtection'] = 'Protection';
$Definition['PaymentWizard']['moreProtectionDesc'] = 'With protection enabled no one can attack you when you are away.';
$Definition['PaymentWizard']['fasterTraining'] = '+%s%% ταχύτερη εκπαίδευση';
$Definition['PaymentWizard']['fasterTrainingDesc'] = 'Γρηγορότερη εκπαίδευση στρατού για όλο το λογαριασμό.';
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
$Definition['PaymentWizard']['No saved golds'] = 'Ακόμα δεν έχετε φέρει κανέναν νέο παίκτη';
$Definition['PaymentWizard']['Are you sure?'] = 'Are you sure?';
$Definition['PaymentWizard']['This feature is disabled'] = 'This feature is disabled.';
$Definition['PaymentWizard']['Gold bank is disabled'] = 'Gold bank is disabled';
$Definition['PaymentWizard']['Invitation is closed'] = 'Invitation is closed';
$Definition['PaymentWizard']['Server is closed for invitations'] = 'Server is closed for invitations.';
$Definition['PaymentWizard']['Gold bank is disabled'] = 'Gold bank is disabled.';
$Definition['PaymentWizard']['Power'] = 'Δύναμη:';
$Definition['PaymentWizard']['Attack/Defense Bonus'] = 'Δύναμη Μάχης';


$Definition['PaymentWizard']['atkBonus'] = '+%s%% Επιθετικό Μπόνους';
$Definition['PaymentWizard']['atkBonusDesc'] = 'Αυξάνει την επιθετική δύναμη των στρατευμάτων σας.';
$Definition['PaymentWizard']['defBonus'] = '+%s%% Αμυντικό Μπόνους';
$Definition['PaymentWizard']['defBonusDesc'] = 'Αυξάνει την αμυντική δύναμη των στρατευμάτων σας.';
$Definition['PaymentWizard']['Protection'] = 'Protection';
$Definition['PaymentWizard']['Protection Packages'] = 'Protection packages';
$Definition['PaymentWizard']['Protection daily limit reached'] = 'Protection daily limit reached.';
$Definition['PaymentWizard']['You have %s hour(s) of protection left'] = 'You have %s hour(s) of protection left.';
$Definition['PaymentWizard']['You have no protection left'] = 'You have no protection left.';
$Definition['PaymentWizard']['You can buy %s hour(s) of protection per day'] = 'You can buy %s hour(s) of protection per day.';
$Definition['PaymentWizard']['You have %s golds in your vouchers'] = 'You have %s golds in your vouchers.';


$Definition['PaymentWizard']['Location'] = 'Χώρες';
$Definition['PaymentWizard']['Packages'] = 'Πακέτα';
$Definition['PaymentWizard']['Payment methods'] = 'Διαθέσημες μέθοδοι πληρωμής:';
$Definition['PaymentWizard']['Overview'] = 'Ολοκλήρωση';
$Definition['PaymentWizard']['Selected package'] = 'Eπιλεγμένο πακέτο';
$Definition['PaymentWizard']['Your new gold balance'] = 'Το νέο σας χρυσό';
$Definition['PaymentWizard']['Gold'] = 'Χρυσό';
$Definition['PaymentWizard']['Price'] = 'Τιμή';
$Definition['PaymentWizard']['Buy now'] = 'Αγορασε τωρα';
$Definition['PaymentWizard']['Voucher'] = 'ΕΞΑΡΓΎΡΩΣΗ ΚΟΥΠΟΝΙΟΎ';
$Definition['PaymentWizard']['Redeem'] = 'Εξαργύρωση';
$Definition['PaymentWizard']['Redeem voucher'] = 'ΕΞΑΡΓΎΡΩΣΗ ΚΟΥΠΟΝΙΟΎ';
$Definition['PaymentWizard']['Open orders'] = 'Ανοιχτές παραγγελίες';
$Definition['PaymentWizard']['Voucher rules'] = 'Κανόνες';
$Definition['PaymentWizard']['voucherRules'] = [
    'Only '.(100-Config::getProperty("gold", "voucherTaxPercent")).'% of remaining golds will be transferred.',
    'The voucher code can be used to redeem code on any user account (without email).',
    'Only bought golds and bonuses will be saved as vouchers.',
    sprintf('Alliance prize is for %s main members that their population is above %s.', Config::getProperty("bonus", "bonusGoldTopAllianceCount"), Config::getProperty("bonus", "bonusGoldTopAllianceMinPop")),
    'You cannot sell vouchers.',
    'Voucher codes will last only '.Config::getProperty("gold", "voucherExpireDays").' days.',
];
$Definition['PaymentWizard']['Reason'] = 'Reason';
$Definition['PaymentWizard']['Show'] = 'Show';
$Definition['PaymentWizard']['Voucher'] = 'Κουπόνια';
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
$Definition['PaymentWizard']['PayPalVATDesc'] = 'Οι πληρωμές PayPal θα προσθέσουν 3% ΦΠΑ + 0,30 $ στην τιμή.';
$Definition['PaymentWizard']['Animals purchased'] = 'Επιτυχής αγορά ζώων!';
$Definition['PaymentWizard']['Troops purchased'] = 'Επιτυχής αγορά στρατευμάτων!';
$Definition['PaymentWizard']['Resources purchased!'] = 'Επιτυχής αγορά υλών!';
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
$Definition['productionOverview'] = ["productionOverview" => "Επισκόπηση παραγωγής",
    "balance" => "Ισοζύγιο",
    "production_field" => "Πεδία υλών",
    "production_per_hour" => "Παραγωγή την ώρα",
    "production" => "Παραγωγή",
    "bonus" => "Επίδομα",
    "production_bonus" => "Επίδομα παραγωγής",
    "Oases" => "Όαση",
    "total_bonus" => "Συνολικό επίδομα",
    "total_production_per_hour" => "Συνολική παραγωγή την ώρα",
    "hero_production" => "Παραγωγή ήρωα",
    "interim_balance" => "Προσωρινό ισοζύγιο",
    "total" => "Σύνολο",
    "HDP" => "Μέρος ποτίσματος αλόγων",
    "sum" => "Σύνολο",
    "inactive" => "ανενεργό",
    "productionBoostSpeechBubbleFurtherInfo" => 'Η ενίσχυση αυξάνει την παραγωγή της ύλης σε <span class="underlined">όλα</span> τα χωριά σας!',
    "productionWithBoost" => "Ωριαία παραγωγή συμπεριλαμβανομένου του bonus παραγωγής",
    "extendNow" => "επεκτείνετε τώρα",
    "activeNow" => "Ενεργοποίηση τώρα",
    "durationDays" => "Διάρκεια ημερών",
    "Production of buildings and oases" => "Παραγωγή κτιρίων και οάσεων",
    "Population and construction orders" => "Παραγγελίες πληθυσμού και κατασκευής",
    "Incomplete construction orders" => "Ατελείς εντολές κατασκευής",
    "Consumption of own troops" => "Κατανάλωση δικών στρατευμάτων",
    "in village" => "στο χωριό",
    "in oasis or reinforcements from own villages" => "σε όαση ή ενισχύσεις από χωριά",
    "imprisoned" => "φυλακίστηκε",
    "on the way" => "στο δρόμο",
    "Artefact bonus" => "Μπόνους αντικειμένων",
    "Consumption of foreign troops" => "Κατανάλωση ξένων στρατευμάτων",
    "Crop balance" => "Ισοζύγιο σιταριού",
    "WW effect" => "WW effect",
];
//
$Definition['Alliance']['In order to quit alliance you need an embassy'] = 'In order to quit alliance you need an embassy.';
$Definition['Alliance']['in vacation'] = 'in vacation';
$Definition['Profile']['Player Profile'] = 'Προφίλ παίκτη';
$Definition['Profile']['Details'] = 'Λεπτομέρειες';
$Definition['Profile']['Rank'] = 'Κατάταξη';
$Definition['Profile']['Tribe'] = 'Φυλή';
$Definition['Profile']['Alliance'] = 'Συμμαχία';
$Definition['Profile']['Villages'] = 'Χωριά';
$Definition['Profile']['Status'] = 'Status';
$Definition['Profile']['Login to player account'] = 'Login to player account';
$Definition['Profile']['Population'] = 'Πληθυσμός';
$Definition['Profile']['Description'] = 'Περιγραφή';
$Definition['Profile']['Name'] = 'Όνομα';
$Definition['Profile']['Active'] = 'Active';
$Definition['Profile']['inActive'] = 'In active';
$Definition['Profile']['This player messages are banned'] = 'This player is banned for in game communications.';
$Definition['Profile']['Escape in villages'] = 'Escape in villages';
$Definition['Profile']['Oases'] = 'Οάσεις';
$Definition['Profile']['Inhabitants'] = 'Κάτοικοι';
$Definition['Profile']['Coordinates'] = 'Συντεταγμένες';
$Definition['Profile']['Stop ignoring this player'] = 'Σταμάτα την αγνόηση';
$Definition['Profile']['Accept messages from this player'] = 'αποδοχή μηνυμάτων από αυτόν τον παίκτη';
$Definition['Profile']['Write message'] = 'Δημιουργία μηνύματος';
$Definition['Profile']['Write Message'] = 'Δημιουργία μηνύματος';
$Definition['Profile']['Ignore Player'] = 'Αγνόησε τον παίκτη';
$Definition['Profile']['Edit list'] = 'Edit list';
$Definition['Profile']['Ignore list is full'] = 'Ignore list is full.';
$Definition['Profile']['Player will be ignored'] = 'Player will be ignored.';
$Definition['Profile']['WoW'] = 'WoW';
$Definition['Profile']['Support'] = 'Support';
$Definition['Profile']['Game rules'] = 'Game rules';
$Definition['Profile']['To ignore messages from a specific player, go to its profile and click on "Ignore"!'] = 'Για να αγνοήσετε τα μηνύματα ενός παίκτη, πηγαίνετε στο προφίλ του και πατήστε "Αγνόησε"';
$Definition['Profile']['MultihunterDesc'] = 'The Multihunters are responsible for compliance with the <a href="http://www.travian.com/spielregeln.php" target="_blank">rules of the game</a>. If you have questions about the rules or would like to report violations, you can message the Multihunters.';
$Definition['Profile']['Support and Multihunter'] = 'Support and Multihunter';
$Definition['Profile']['The support consists of experienced players who will gladly answer your questions'] = 'The support consists of experienced players who will gladly answer your questions.';
$Definition['Profile']['capital'] = 'Πρωτεύουσα';
$Definition['Profile']['Artifact'] = 'αντικείμενα';
$Definition['Profile']['Birthday'] = 'Ημερομηνία γέννησης';
$Definition['Profile']['Gender'] = 'Φύλο';
$Definition['Profile']['n/a'] = 'τίποτα άλλο';
$Definition['Profile']['male'] = 'Άνδρας';
$Definition['Profile']['female'] = 'Γυναίκα';
$Definition['Profile']['Location'] = 'Τοποθεσία';
$Definition['Profile']['Age'] = 'ηλικία';
$Definition['Profile']['Overview'] = 'Επισκόπηση';
$Definition['Profile']['Edit Profile'] = 'Αλλαγή προφίλ';
$Definition['Profile']['Medals'] = 'Μετάλλια';
$Definition['Profile']['DoveOfPeace'] = 'Περιστέρι της ειρήνης';
$Definition['Profile']['Category'] = 'Κατηγορία';
$Definition['Profile']['Rank'] = 'Κατάταξη';
$Definition['Profile']['Week'] = 'Εβδομάδα';
$Definition['Profile']['BB-Code'] = 'BB-Code';
$Definition['Profile']['SpecialMedalsTitle'] = [
    1 => 'Νικητής θέση 1η',
    2 => 'Νικητής θέση 2η',
    3 => 'Νικητής θέση 3η',

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
$Definition['Profile']['SpecialShow'] = 'Δείξε';
$Definition['Profile']['SpecialHide'] = 'Κρύψε';
$Definition['Profile']['SpecialMedals'] = 'World Medals';
$Definition['Profile']['Language'] = 'Language';
$Definition['Profile']['Show country flag in your profile'] = 'Show country flag in your profile';
$Definition['Profile']['Show special medals?'] = 'Show special medals?';
$Definition['Profile']['YES'] = 'ΝΑΙ';
$Definition['Profile']['NO'] = 'ΟΧΙ';
$Definition['Profile']['Note'] = 'Σημείωση';
$Definition['Profile']['Edit'] = 'Επεξεργασία';
$Definition['Profile']['NoteDescription'] = 'Καταχώρησε τις δικές σου σημειώσεις σχετικά με αυτόν τον παίκτη. Μέγιστο: 500 χαρακτίρες';

//

$Definition['Quest'] = [];
$Definition['Quest']['welcome'] = 'Καλωσόρισες';
$Definition['Quest']['helperAndTasks'] = 'Εργασίες και βοήθεια';
$Definition['Quest']['taskList'] = 'Λίστα εργασιών';
$Definition['Quest']['questButtonActivateTips'] = 'Show Hints';
$Definition['Quest']['questButtonDeactivateTips'] = 'Disable Hints';
$Definition['Quest']['questTipsToggleDescription'] = 'Συμβουλές on/off';
$Definition['Quest']['startTutorial'] = 'Συνέχεια';
$Definition['Quest']['getReward'] = 'Λήψη ανταμοιβής';
$Definition['Quest']['SkipTutorial'] = 'Παράλειψη οδηγού';
$Definition['Quest']['skip'] = 'Παράλειψη οδηγού';
$Definition['Quest']['questRewardTitle'] = 'Η ανταμοιβή σου';
$Definition['Quest']['overview'] = 'Επισκόπηση';
$Definition['Quest']['questTaskTitle'] = 'Εργασία';
$Definition['Quest']['endOfTutorial'] = 'Τέλος οδηγού';
$Definition['Quest']['continue'] = 'Συνέχεια';
$Definition['Quest']['battle'] = 'Μάχη';
$Definition['Quest']['economy'] = 'Οικονομία';
$Definition['Quest']['world'] = 'Κόσμος';

$Definition['Quest']['Tutorial_01']['questTitle'] = 'Καλωσόρισες';
$Definition['Quest']['Tutorial_01']['questDescription'] = 'Γεια σου %s, καλωσόρισες στους ΜΟΛΩΝ ΛΑΒΕ σέρβερς! <br>Μέχρι να ιδρύσεις το επόμενο χωριό σου, θα σε οδηγήσω μέσα στο παιχνίδι. Στον οδηγό, θα κτίσεις το χωριό σου και θα μάθεις περισσότερα για τα στοιχεία και τους στόχους του παιχνιδιού.';
$Definition['Quest']['Tutorial_01']['continue'] = 'Συνέχεια';
$Definition['Quest']['Tutorial_01']['skip'] = 'Παράλειψη οδηγού';
$Definition['Quest']['Tutorial_01']['todo'] = [0 => 'Ο οδηγός σου εξηγεί τα κύρια στοιχεία του παιχνιδιού και παίρνει μόνο λίγα λεπτά - ξεκίνα τώρα!',];
$Definition['Quest']['Tutorial_01']['steps'] = [0 => 'Αρχή οδηγού',];

$Definition['Quest']['Tutorial_02']['questTitle'] = 'Εργασίες και βοήθεια';
$Definition['Quest']['Tutorial_02']['questDescription'] = 'Μπορείς να μετακινήσεις ή να κλήσεις αυτό το παράθυρο. Για να το ανοίξεις πάλι, απλά πάτα στην εικόνα μου στην κάτω δεξιά γωνία. Η συμβουλή θα σε βοηθήσει σε περίπτωση που έχεις πρόβλημα να προχωρήσεις στον οδηγό.';
$Definition['Quest']['Tutorial_02']['questDescriptionReward'] = 'Τώρα μπορείς πάντα να βρεις πληροφορίες για τις τρέχουσες εργασίες σου. Μόνο όταν αποδεχθείς την ανταμοιβή σου θα ενεργοποιηθεί η επόμενη εργασία. Απαίτησε το ορυχείο πηλού σου τώρα!';
$Definition['Quest']['Tutorial_02']['rewardDescription'] = 'Ορυχείο πηλού Επίπεδο 1';
$Definition['Quest']['Tutorial_02']['todo'] = [0 => 'Κλείσε το παράθυρο του οδηγού ', 1 => 'Πάτα στον συμβουλάτορα να ανοίξεις το παράθυρο εργασιών ',2 => 'Απενεργοποίησε το στοιχείο βοήθειας ',];
$Definition['Quest']['Tutorial_02']['steps'] = [0 => 'Κλείσε εργασίες', 1 => 'Άνοιξε εργασίες', 2 => 'Απενεργοποιήστε συμβουλές',];

$Definition['Quest']['Tutorial_03']['questTitle'] = 'Φτιάξε έναν ξυλοκόπο ';
$Definition['Quest']['Tutorial_03']['questDescription'] = 'Θα χρειαστείς πολλές ύλες για να κτίσεις το χωριό σου, να εκπαιδεύσεις στρατό και να μεγαλώσεις την αυτοκρατορία σου. Πρώτα αύξησε την παραγωγή υλών σου - κτίσε έναν ξυλοκόπο!';
$Definition['Quest']['Tutorial_03']['questDescriptionReward'] = 'Είναι ένα καλό ξεκίνημα  που βασιζεται  στην καλή οικονομία. Μόλις ολοκλήρωσα την κατασκευή του ξυλοκόπου, για να μπορέσω να συνεχίσω.';
$Definition['Quest']['Tutorial_03']['rewardDescription'] = 'Ολοκλήρωσε τον ξυλοκόπο επίπεδο 1 αμέσως';
$Definition['Quest']['Tutorial_03']['todo'] = [0 => 'Άνοιξε ένα πεδίο στο δάσος πατώντας πάνω του ',1 => 'Παρήγγειλε την κατασκευή ενός ξυλοκόπου επίπεδο 1 ',];
$Definition['Quest']['Tutorial_03']['steps'] = [0 => 'Άνοιξε τον ξυλοκόπο επίπεδο', 1 => 'Φτιάξε έναν ξυλοκόπο',];

$Definition['Quest']['Tutorial_04']['questTitle'] = 'Αναβάθμιση ξυλοκόπου ';
$Definition['Quest']['Tutorial_04']['questDescription'] = 'Ένα μεγαλύτερο κτήριο απαιτεί περισσότερες ύλες με κάθε αναβάθμιση, αλλά, ως αντάλλαγμα, θα παράγει και περισσότερο. Παρακαλώ αναβάθμισε τον ξυλοκόπο από το επίπεδο 1 στο επίπεδο 2 τώρα!';
$Definition['Quest']['Tutorial_04']['questDescriptionReward'] = 'Η επίδειξη του αποθηκευτικού χώρου και του αποθέματός σας βρίσκεται πάνω από το χωριό σας. Το κόστος κατασκευής θα ληφθεί από τα αποθέματα. Θα ολοκληρώσω αμέσως την κατασκευή για σας ξανά.';
$Definition['Quest']['Tutorial_04']['questTaskTitle'] = 'Εργασία';
$Definition['Quest']['Tutorial_04']['rewardDescription'] = 'Ολοκλήρωση κατασκευής ξυλοκόπου επίπεδο 2 άμεσα';
$Definition['Quest']['Tutorial_04']['todo'] = [0 => 'Άνοιξε τον ξυλοκόπο επίπεδο 1  ',1 => 'Παρήγγειλε την κατασκευή ενός ξυλοκόπου επίπεδο 2 ',];
$Definition['Quest']['Tutorial_04']['steps'] = [0 => 'Άνοιξε τον ξυλοκόπο επίπεδο 1 ', 1 => 'Κατασκευή ξυλοκόπου επίπεδο 2',];

$Definition['Quest']['Tutorial_05']['questTitle'] = ' Χωράφι σιταριού  ';
$Definition['Quest']['Tutorial_05']['questDescription'] = 'Όταν κοιτάτε τα αποθέματα, στα δεξιά μπορείτε να δείτε το ελεύθερο σιτάρι, το οποίο υποδεικνύει την ποσότητα σιταριού διαθέσιμη για νέα κτήρια. Τα κτήρια καταναλώνουν σιτάρι για την συντήρησή τους. Παρακαλώ κατασκεύασε ένα χωράφι σιταριού.';
$Definition['Quest']['Tutorial_05']['questDescriptionReward'] = 'Το χωριό σου παράγει ξανά αρκετό σιτάρι για να υποστηρίξει νέα κτήρια. Ο πληθυσμός πρέπει να τροφοδοτείτε τοπικά, τα στρατεύματα μπορούν επίσης να υποστηριχθούν με αποστολές σιταριού.';
$Definition['Quest']['Tutorial_05']['rewardDescription'] = 'Ολοκλήρωσε άμεσα την κατασκευή χωραφιού σιταριού επίπεδο 1 και αναβάθμισε στο επίπεδο 2';
$Definition['Quest']['Tutorial_05']['todo'] = [0 => 'Πάτησε να ανοίξεις ένα χωράφι σιταριού ', 1 => 'Αναβάθμισε το χωράφι σιταριού στο επίπεδο 1 ',];
$Definition['Quest']['Tutorial_05']['steps'] = [0 => 'Άνοιξε ένα χωράφι σιταριού ', 1 => 'Κατασκεύασε ένα χωράφι σιταριού',];

$Definition['Quest']['Tutorial_06']['questTitle'] = ' Παραγωγή ήρωα';
$Definition['Quest']['Tutorial_06']['questDescription'] = 'Αν ο ήρωας σου είναι ζωντανός, μπορεί να παράγει ύλες για το χωριό του. Οι αναβαθμίσεις μας προκάλεσαν έλλειψη σε πηλό. Άλλαξε την παραγωγή του ήρωα σε πηλό τώρα.';
$Definition['Quest']['Tutorial_06']['questDescriptionReward'] = 'Πολύ καλά. Ο ήρωας σου μπορεί να σε βοηθήσει σε περίπτωση έλλειψης υλών. Όλες οι ύλες που παράγουν θα πηγαίνουν πάντα στο χωριό βάση, ακόμα και όταν είναι στον δρόμο. Θα αυξήσω λίγο το απόθεμα σου.';
$Definition['Quest']['Tutorial_06']['rewardDescription'] = '<div class="inlineIconList resourceWrapper"><div class="inlineIcon resources" title=""><i class="r2 questRewardTypeResource questRewardTypeClay"></i><span class="value questRewardValue">'.Quest::getInstance()->multiply(200).'</span></div></div>';
$Definition['Quest']['Tutorial_06']['todo'] = [0 => 'Πάτησε στην εικόνα του ήρωα και άνοιξε την επισκόπηση . ',1 => 'Άλλαξε τις ύλες σε πηλό και αποθήκευσε. ',];
$Definition['Quest']['Tutorial_06']['steps'] = [0 => 'Εικόνα ήρωα', 1 => 'Παραγωγή ήρωα',];

$Definition['Quest']['Tutorial_07']['questTitle'] = ' Μπες στο χωριό σου';
$Definition['Quest']['Tutorial_07']['questDescription'] = 'Στην συνέχεια, θα αυξήσουμε την χωρητικότητα αποθήκευσης για τις ύλες σου. Γι αυτό, χρειαζόμαστε ένα κτήριο μέσα στο χωριό σου. Πήγαινε στην επισκόπηση χωριού πατώντας στο πάνω μενού';
$Definition['Quest']['Tutorial_07']['todo'] = [ 0 => 'Μπες στο χωριό σου τώρα.',];
$Definition['Quest']['Tutorial_07']['steps'] = [    0 => 'Μπες στο χωριό σου τώρα',];

$Definition['Quest']['Tutorial_08']['questTitle'] = 'Κατασκευή αποθήκης';
$Definition['Quest']['Tutorial_08']['questDescription'] = 'Χωρίς αποθήκη, μόνο μερικά από τα αποθέματα μπορούν να αποθηκευτούν στο χωριό σας. Κάντε κλικ στην περιοχή κατασκευής κτηρίου για να δημιουργήσετε μια αποθήκη! Στο μενού της κατασκευής βρεις την αποθήκη για να την οικοδομήσεις';
$Definition['Quest']['Tutorial_08']['questDescriptionReward'] = 'Η εργασίες κατασκευής ξεκίνησαν και σύντομα θα έχεις αρκετό χώρο αποθήκευσης για την παραγωγή και τα λάφυρά σας. Θα σου δώσω '.Quest::calcEffect(86400, 'plus', true).' Travian Plus, το οποίο σου επιτρέπει να βάλεις στην σειρά μια δεύτερη κατασκευή ενώ δεν έχει τελειώσει ακόμα η πρώτη.';
$Definition['Quest']['Tutorial_08']['rewardDescription'] = 'Travian PLUS 24 ώρες';
$Definition['Quest']['Tutorial_08']['todo'] = [ 0 => 'Κάντε κλικ στην περιοχή κατασκευής κτηρίου για να δημιουργήσετε μια αποθήκη. ',1 => 'Δώστε εντολές για να δημιουργήσετε επίπεδο αποθήκης 1. ',];
$Definition['Quest']['Tutorial_08']['steps'] = [    0 => 'Κάντε κλικ στην περιοχή κατασκευής κτηρίου', 1 => 'Κατασκευάστε αποθήκη',];

$Definition['Quest']['Tutorial_09']['questTitle'] = 'Πλατεία συγκέντρωσης';
$Definition['Quest']['Tutorial_09']['questDescription'] = 'Για να στείλετε τον ήρωά σας στις περιπέτειες, χρειάζεστε μια πλατεία συγκέντρωσης - μπορείτε να τη βρείτε στο κέντρο του χωριού! Κατασκευάστε τη και αναβαθμίστε τη στο επίπεδο 1';
$Definition['Quest']['Tutorial_09']['questDescriptionReward'] = 'Υπέροχα! Η κατασκευή ξεκίνησε και ο ήρωας σου μπορεί τώρα να ξεκινήσει. Γι αυτήν την εργασία, θα σου δώσω λίγο χρυσό, τον οποίο θα χρησιμοποιήσουμε για καλό σκοπό αμέσως.';
$Definition['Quest']['Tutorial_09']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeGold"> <span class="questRewardValue">2</span>';
$Definition['Quest']['Tutorial_09']['todo'] = [ 0 => 'Κάντε κλικ στην περιοχή κατασκευής της πλατείας συγκέντρωσης. ', 1 => 'Κατασκευάστε την πλατεία συγκέντρωσης 1',];
$Definition['Quest']['Tutorial_09']['steps'] = [    0 => 'Κάντε κλικ στην περιοχή κατασκευής της πλατείας συγκέντρωσης', 1 => 'Κατασκευάστε πλατεία συγκέντρωσης',];

$Definition['Quest']['Tutorial_10']['questTitle'] = 'Άμεση ολοκλήρωση';
$Definition['Quest']['Tutorial_10']['questDescription'] = 'Κάτω από το χωριό, μπορείς να βρες μια λίστα με όλες τις παραγγελίες κατασκευής σου. Αυτήν την φορά, μπορείς να αυξήσεις την ταχύτητα κατασκευής ο ίδιος. Χρησιμοποίησε τον χρυσό από την τελευταία εργασία και ολοκλήρωσε τις παραγγελίες κατασκευής πατώντας στο "άμεση ολοκλήρωση κατασκευής".';
$Definition['Quest']['Tutorial_10']['questDescriptionReward'] = 'Τώρα μπορείς να στείλεις των ήρωα σου σε μια περιπέτεια. Πρώτα, παρήγγειλε την κατασκευή ορισμένων πεδίων υλών ακόμα ώστε το χωριό σου να συνεχίσει να μεγαλώνει. Πάρε αυτόν τον χρυσό και χρησιμοποίησε τον σωστά.';
$Definition['Quest']['Tutorial_10']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeGold"> <span class="questRewardValue">10</span>';
$Definition['Quest']['Tutorial_10']['todo'] = [0 => 'Άμεση ολοκλήρωση κατασκευών',];
$Definition['Quest']['Tutorial_10']['steps'] = [0 => 'Ολοκλήρωση κατασκευής',];

$Definition['Quest']['Tutorial_11']['questTitle'] = 'Άρχισε περιπέτεια';
$Definition['Quest']['Tutorial_11']['questDescription'] = 'Ανακάλυψε μυστήρια μέρει στον περίγυρό σου για να μαζέψεις εμπειρία και πολύτιμα λάφυρα. Άνοιξε την λίστα με τις περιπέτειες και στείλε το ήρωα σου στην πρώτη του περιπέτεια.';
$Definition['Quest']['Tutorial_11']['questDescriptionReward'] = 'Ωραία, ο ήρωα είναι στον δρόμο - τι θα βρει; Κάτω από την εικόνα του μπορείς να ότι ο ήρωας είναι στον δρόμο. Θα τον κάνω να φτάσει τώρα ώστε να δεις τι συμβαίνει.';
$Definition['Quest']['Tutorial_11']['rewardDescription'] = 'Ο ήρωας φτάνει άμεσα στην περιπέτεια';
$Definition['Quest']['Tutorial_11']['todo'] = [0 => 'Στείλε τον ήρωα στην πρώτη του περιπέτεια',];
$Definition['Quest']['Tutorial_11']['steps'] = [0 => 'Περιπέτεια ήρωα',];

$Definition['Quest']['Tutorial_12']['questTitle'] = 'Αναφορές';
$Definition['Quest']['Tutorial_12']['questDescription'] = 'Ο ήρωας επιστρέφει από την πρώτη του περιπέτεια. Στο μενού πάνω, μπορείς να βρεις τις αναφορές. Άνοιξε την λίστα με τις αναφορές και διάβασε την αναφορά της περιπέτειας.';
$Definition['Quest']['Tutorial_12']['questDescriptionReward'] = 'Μπορείς ήδη να δεις τι είδους λάφυρα έλαβες στην επισκόπηση. Τι ήταν για σένα; Επίσης ο ήρωας τραυματίστηκε λίγο - για να το αντιμετωπίσεις αυτό, θα του δώσω τώρα μερικές αλοιφές.';
$Definition['Quest']['Tutorial_12']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeItem item106"> <span class="questRewardValue">'.Quest::calcEffect(10, 'item', true).'</span>';
$Definition['Quest']['Tutorial_12']['todo'] = [    0 => 'Άνοιξε την λίστα αναφορών', 1 => 'Διάβασε την νέα αναφορά περιπέτειας',];
$Definition['Quest']['Tutorial_12']['steps'] = [    0 => 'Μενού αναφορών ', 1 => 'Διάβασε αναφορά',];

$Definition['Quest']['Tutorial_13']['questTitle'] = 'Θεραπεία ήρωα';
$Definition['Quest']['Tutorial_13']['questDescription'] = 'Ο ήρωας τραυματίστηκε λίγο. Άνοιξε την επισκόπηση ήρωα πατώντας στην εικόνα του. Τώρα πάτα στις αλοιφές στο ευρετήριο και χρησιμοποίησε τις πατώντας "ΟΚ". Θα χρησιμοποιηθεί μόνο η απαιτούμενη ποσότητα.';
$Definition['Quest']['Tutorial_13']['questDescriptionReward'] = 'Όλα τα εργαλεία και τα όπλα μπορούν να χρησιμοποιηθούν με τον ίδιο τρόπο. Ανάλογα με τον τύπο του, μπορείτε να δείτε πληροφορίες σχετικά με το στοιχείο κρατώντας το δείκτη πάνω του.';
$Definition['Quest']['Tutorial_13']['rewardDescription'] = 'Επιπλέον, ο ήρωας λαμβάνει 20 πόντους εμπειρίας.';
$Definition['Quest']['Tutorial_13']['todo'] = [    0 => 'Πάτα στην εικόνα του ήρωα για να ανοίξεις το ευρετήριο',    1 => 'Πάτα στις αλοιφές στο ευρετήριο για να τις χρησιμοποιήσεις',];
$Definition['Quest']['Tutorial_13']['steps'] = [    0 => 'Ευρετήριο ήρωα', 1 => 'Θεράπευσε τον ήρωα',];

$Definition['Quest']['Tutorial_14']['questTitle'] = ' Περιβάλλον χρήστη';
$Definition['Quest']['Tutorial_14']['questDescription'] = 'Κοντά στην εικόνα μου, μπορείς να βρεις περισσότερη βοήθεια σχετικά με το παιχνίδι. Εκεί μπορείς εξηγήσει σχετικά με την επιφάνεια χρήσης και διαφορετικούς τομείς του περιβάλλοντος χρήστη. Απλά δοκίμασε!';
$Definition['Quest']['Tutorial_14']['questDescriptionReward'] = 'Αν έχεις μια συγκεκριμένη ερώτηση, μπορείς πάντα να κοιτάξεις το "Answers" πρώτα - και θα βρεις βοήθεια. Γι αυτό, απλά πάτα στο "i" στην επικεφαλίδα του παραθύρου ή στην πάνω γωνία της οθόνης.';
$Definition['Quest']['Tutorial_14']['rewardDescription'] = buildResourcesReward([270, 300, 270, 220]);
$Definition['Quest']['Tutorial_14']['todo'] = [0 => 'Άνοιξε την βοήθεια για το περιβάλλον χρήστη και ρίξε μια ματιά στο περιβάλλον χρήστη',];
$Definition['Quest']['Tutorial_14']['steps'] = [0 => 'Περιβάλλον χρήστη',];

$Definition['Quest']['Tutorial_15']['questTitle'] = 'Τέλος οδηγού';
$Definition['Quest']['Tutorial_15']['questDescription'] = $Definition['Quest']['Tutorial_15a']['questDescriptionReward'] = 'Τώρα ξέρεις τα βασικά για να παίξεις το παιχνίδι. Σημαντικές πληροφορίες, όπως η λήξη της προστασίας νέου χρήστη ή ειδικά γεγονότα μπορούν να βρεθούν στο κουτί πληροφοριών στα αριστερά. Καλή διασκέδαση με το Travian!';
$Definition['Quest']['Tutorial_15']['rewardDescription'] = 'Τέλος οδηγού.';
$Definition['Quest']['Tutorial_15']['todo'] = [0 => 'Τέλος οδηγού',];
$Definition['Quest']['Tutorial_15']['steps'] = [0 => 'Τέλος οδηγού',];

$Definition['Quest']['Tutorial_15a']['questTitle'] = 'Παράλειψη οδηγού';
$Definition['Quest']['Tutorial_15a']['questDescription'] = 'Για να ξεκινήσεις, θα σου δώσω τα κτήρια και τα πλεονεκτήματα από τον οδηγό. Περισσότερες εργασίες και ανταμοιβές σε περιμένουν από τώρα μέχρι να ιδρύσεις δεύτερο χωριό. Καλή διασκέδαση με το Travian!';
$Definition['Quest']['Tutorial_15a']['rewardDescription'] = '10 χρυσά, Πλατεία συγκεντρώσεως Επίπεδο 1, Ορυχείο πηλού Επίπεδο 1, Ξυλοκόπος Επίπεδο 2, Χωράφι σιταριού Επίπεδο 2,  '.Quest::calcEffect(86400, 'plus', true).' PLUS';
$Definition['Quest']['Tutorial_15a']['steps'] = [0 => 'Παράλειψη οδηγού',];

$Definition['Quest']['battle_01_name'] = 'Επόμενη περιπέτεια';
$Definition['Quest']['battle_02_name'] = 'Κατασκευή κρυψώνας';
$Definition['Quest']['battle_03_name'] = 'Κτίσε στρατόπεδο';
$Definition['Quest']['battle_04_name'] = 'Δύναμη μάχης';
$Definition['Quest']['battle_05_name'] = 'Εκπαίδευση στρατευμάτων';
$Definition['Quest']['battle_06_name'] = 'Τείχος';
$Definition['Quest']['battle_07_name'] = 'Επίθεση σε όαση';
$Definition['Quest']['battle_08_name'] = '10 περιπέτειες';
$Definition['Quest']['battle_09_name'] = 'Δημοπρασίες';
$Definition['Quest']['battle_10_name'] = 'Αναβάθμιση στρατοπέδου';
$Definition['Quest']['battle_11_name'] = 'Κατασκεύασε μια ακαδημία';
$Definition['Quest']['battle_12_name'] = 'Έρευνα μονάδας';
$Definition['Quest']['battle_13_name'] = 'Κατασκεύασε ένα σιδηρουργείο';
$Definition['Quest']['battle_14_name'] = 'Αναβάθμιση μονάδων';
$Definition['Quest']['battle_15_name'] = 'Ολοκληρώστε 5 περιπέτειες';

$Definition['Quest']['Battle_01']['questTitle'] = 'Επόμενη περιπέτεια';
$Definition['Quest']['Battle_01']['questDescription'] = 'Κατά τη διάρκεια του σεμιναρίου, έχετε ήδη συγκεντρώσει κάποια εμπειρία από μια περιπέτεια. Ξεκινήστε την επόμενη περιπέτεια μόλις ο ήρωάς σας επιστρέψει στο χωριό σας. Το φορτίο και η εμπειρία θα σας επιτρέψουν να αναπτυχθείτε πιο γρήγορα.';
$Definition['Quest']['Battle_01']['questDescriptionReward'] = 'Ωραία, ο ήρωας είναι ήδη στο δρόμο. Σημείωση: Όσο μεγαλύτερη δύναμη μάχης έχει ο ήρωας, τόσο λιγότερο τραυματίζεται στις περιπέτειες.';
$Definition['Quest']['Battle_01']['rewardDescription'] = '30 εμπειρία ήρωα';
$Definition['Quest']['Battle_01']['todo'] = [0 => 'Περάστε στη δεύτερη περιπέτεια',];

$Definition['Quest']['Battle_02']['questTitle'] = 'Κατασκευή κρυψώνας';
$Definition['Quest']['Battle_02']['questDescription'] = 'Πολλοί παίκτες ζουν από κλέβοντας τις ύλες από άλλους παίκτες. Στην αρχή του παιχνιδιού, έχεις την προστασία νέου παίκτη και είσαι ασφαλής. Φτιάξε μια κρυψώνα για να σώσεις τουλάχιστον ένα μέρος των υλών σου από λεηλασίες.';
$Definition['Quest']['Battle_02']['questDescriptionReward'] = 'Ωραία, τώρα οι επιδρομείς δεν θα μπορούν εύκολα να κλέψουν ύλες από σένα. Έλεγξε, στα αριστερά, το κουτί πληροφοριών για να δεις τον χρόνο προστασίας νέου παίκτη που έχεις.';
$Definition['Quest']['Battle_02']['rewardDescription'] = buildResourcesReward([130, 150, 120, 100]);
$Definition['Quest']['Battle_02']['todo'] = [0 => 'Κατασκευάστε μια κρυψώνα στο χωριό σας',];

$Definition['Quest']['Battle_03']['questTitle'] = 'Κτίσε στρατόπεδο';
$Definition['Quest']['Battle_03']['questDescription'] = 'Το στρατόπεδο είναι το πρώτο κτήριο που σου επιτρέπει να εκπαιδεύσεις στρατό. Ακόμα και σαν ειρηνικός παίκτης, θα χρειαστείς στρατό για να προστατεύσεις τον εαυτό σου και τους συμμάχους σου από εχθρούς.';
$Definition['Quest']['Battle_03']['questDescriptionReward'] = 'Το στρατόπρδο σας έχει χτιστεί! Ένα καλό βήμα προς την παγκόσμια κυριαρχία!';
$Definition['Quest']['Battle_03']['rewardDescription'] = buildResourcesReward([110, 140, 160, 30]);
$Definition['Quest']['Battle_03']['todo'] = [0 => ' Κτίσε στρατόπεδο',];

$Definition['Quest']['Battle_04']['questTitle'] = 'Δύναμη μάχης';
$Definition['Quest']['Battle_04']['questDescription'] = 'Κάθε φορά που ο ήρωάς σας φτάνει σε ένα νέο επίπεδο, θα ενισχυθεί. Ανοίξτε τα χαρακτηριστικά του ήρωα και διανείμετε τους βαθμούς των χαρακτηριστικών που σας έχουν απονεμηθεί.';
$Definition['Quest']['Battle_04']['questDescriptionReward'] = 'Μπορείς να αλλάξεις την διανομή των πόντων για κάθε χαρακτηριστικό το οποιαδήποτε στιγμή. Αυτό που χρειάζεσαι είναι ένα βιβλίο της σοφίας, το οποίο μπορεί να βρεθεί σε περιπέτειες.';
$Definition['Quest']['Battle_04']['rewardDescription'] = buildResourcesReward([190, 250, 150, 110]);
$Definition['Quest']['Battle_04']['todo'] = [0 => 'Διανείμετε τους πόντους χαρακτηριστικών του ήρωα σας.',];

$Definition['Quest']['Battle_05']['questTitle'] = 'Εκπαίδευση στρατευμάτων';
$Definition['Quest']['Battle_05']['questDescription'] = 'Τώρα ήρθε η ώρα να εκπαιδεύσετε τα πρώτα σας στρατεύματα. Στους στρατώνες, μπορείτε ήδη να εκπαιδεύσετε έναν τύπο μονάδας πεζικού.';
$Definition['Quest']['Battle_05']['questDescriptionReward'] = 'Ο βασικός λίθος για έναν λαμπρό στρατό έχει τεθεί! Να θυμάστε πάντα ότι μπορείτε ακόμη να επιτεθείτε, ακόμη και όταν δεν είστε συνδεδεμένοι.';
$Definition['Quest']['Battle_05']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeItem item114"> <span class="questRewardValue">1</span>';
$Definition['Quest']['Battle_05']['todo'] = [0 => 'Εκπαιδεύστε δύο στρατεύματα στο στρατόπεδο ',];

$Definition['Quest']['Battle_06']['questTitle'] = 'Τεἰχος';
$Definition['Quest']['Battle_06']['questDescription'] = 'Τώρα πρέπει να κτίσεις και μερικές άμυνες. Μια οχύρωση θα αυξήσει την βασική σου άμυνα και, επίσης, αυξάνει την δύναμη μάχης των αμυνομένων στρατευμάτων.';
$Definition['Quest']['Battle_06']['questDescriptionReward'] = 'Υπέροχα, οι αμυνόμενοι στο χωριό σου προστατεύονται καλύτερα.';
$Definition['Quest']['Battle_06']['rewardDescription'] = buildResourcesReward([120, 120, 90, 50]);
$Definition['Quest']['Battle_06']['todo'] = [0 => 'Κτίσε μια οχύρωση γύρο από το χωριό σου. ',];

$Definition['Quest']['Battle_07']['questTitle'] = 'Επίθεση σε όαση';
$Definition['Quest']['Battle_07']['questDescription'] = 'Ψάξε τον χάρτη για μια κοντινή όαση και κάνε της επιδρομή. Σε περίπτωση που έχει ζώα να αμύνονται, στείλε τον ήρωά σου εξοπλισμένο με κλουβιά για να τα πιάσει.';
$Definition['Quest']['Battle_07']['questDescriptionReward'] = 'Συγχαρητήρια, η πρώτη σου επίθεση είναι στον δρόμο της! Μπορείς να την ακυρώσεις για ένα μικρό χρονικό διάστημα από την πλατεία συγκέντρωσης.';
$Definition['Quest']['Battle_07']['rewardDescription'] = Quest::calcEffect(2, 'troops', true) . ' βασικές μονάδες στρατού';
$Definition['Quest']['Battle_07']['todo'] = [0 => 'Άνοιξε μια ελεύθερη όαση στο χάρτη και κάνε επίθεση. ',];

$Definition['Quest']['Battle_08']['questTitle'] = '10 Περιπέτειες';
$Definition['Quest']['Battle_08']['questDescription'] = 'Συνεχίστε να στείλετε τον ήρωά σας στις περιπέτειες. Αφού ολοκληρώσετε 10 από αυτές, μπορείτε να συμμετάσχετε σε δημοπρασίες και να ανταλλάξετε αντικείμενα με άλλους παίκτες.';
$Definition['Quest']['Battle_08']['questDescriptionReward'] = 'Συγχαρητήρια, μπορείς να χρησιμοποιήσεις τις δημοπρασίες. Πάρε αυτό το ασήμι, ώστε να έχεις μερικά χρήματα για εμπόριο αμέσως.';
$Definition['Quest']['Battle_08']['rewardDescription'] = '500 Ασημένια νομίσματα';
$Definition['Quest']['Battle_08']['todo'] = [0 => 'Τέλειωσε 10 περιπέτειες',];

$Definition['Quest']['Battle_09']['questTitle'] = 'Δημοπρασίες';
$Definition['Quest']['Battle_09']['questDescription'] = 'Πήγαινε στις δημοπρασίες και δες ποια αντικείμενα προσφέρονται αυτήν την στιγμή. Ίσως θέλεις να μετατρέψεις κάποια από τα λάφυρά σου σε ασήμι;';
$Definition['Quest']['Battle_09']['questDescriptionReward'] = 'Εξαιρετικά, τώρα ξέρεις πως να κάνεις εμπόριο με εξοπλισμό και αναλώσιμα αντικείμενα με άλλους παίκτες.';
$Definition['Quest']['Battle_09']['rewardDescription'] = buildResourcesReward([280, 120, 220, 110]);
$Definition['Quest']['Battle_09']['todo'] = [0 => 'Δημιούργησε μια ή κάνε μια προσφορά στις δημοπρασίες',];

$Definition['Quest']['Battle_10']['questTitle'] = 'Αναβάθμιση στρατοπέδου';
$Definition['Quest']['Battle_10']['questDescription'] = 'Αναβάθμισε και άλλο το στρατόπεδο σου τώρα. Με αυτό θα έχεις τις προδιαγραφές να ξεκλειδώσεις και άλλα κτήρια.';
$Definition['Quest']['Battle_10']['questDescriptionReward'] = 'Ωραία. Τα στρατεύματά σου τώρα εκπαιδεύονται γρηγορότερα και μπορείς να κατασκευάσεις μια ακαδημία.';
$Definition['Quest']['Battle_10']['rewardDescription'] = buildResourcesReward([440, 290, 430, 240]);
$Definition['Quest']['Battle_10']['todo'] = [0 => 'Αναβάθμισε το στρατόπεδο στο επίπεδο 3. ',];

$Definition['Quest']['Battle_11']['questTitle'] = 'Κατασκεύασε μια ακαδημία';
$Definition['Quest']['Battle_11']['questDescription'] = 'Νέες και δυνατότερες μονάδες για το χωριό σου μπορούν να ανακαλυφθούν στην ακαδημία. Κάποιες μονάδες είναι πολύ ακριβές και έχουν υψηλές απαιτήσεις πριν ερευνηθούν.';
$Definition['Quest']['Battle_11']['questDescriptionReward'] = 'Πολύ καλά. Σύντομα θα βρεις περισσότερα για τους στρατιώτες της φυλής σου.';
$Definition['Quest']['Battle_11']['rewardDescription'] = buildResourcesReward([210, 170, 245, 115]);
$Definition['Quest']['Battle_11']['todo'] = [0 => 'Κατασκεύασε μια ακαδημία τώρα.',];

$Definition['Quest']['Battle_12']['questTitle'] = 'Έρευνα μονάδας';
$Definition['Quest']['Battle_12']['questDescription'] = 'Έλεγξε τις επιλογές έρευνας τώρα. Υπάρχουν μονάδες πεζικού και ιππικού, όπως και πολιορκητικά όπλα. Οι μονάδες εξειδικεύονται είτε στην επίθεση είτε στην άμυνα.';
$Definition['Quest']['Battle_12']['questDescriptionReward'] = 'Η έρευνα από μόνη δεν είναι φυσικά αρκετή. Οι μονάδες σου πρέπει να εκπαιδευτούν.';
$Definition['Quest']['Battle_12']['rewardDescription'] = buildResourcesReward([450, 435, 515, 550]);
$Definition['Quest']['Battle_12']['todo'] = [0 => 'Ερεύνησε μια ακόμα μονάδα στρατεύματος.',];

$Definition['Quest']['Battle_13']['questTitle'] = 'Κατασκεύασε ένα σιδηρουργείο';
$Definition['Quest']['Battle_13']['questDescription'] = 'Ένα σιδηρουργείο σου επιτρέπει να εξοπλίσεις καλύτερα τον στρατό σου. Επιπλέον ένα σιδηρουργείο χρειάζεται για να κτίσεις επιπλέον κτήρια στρατού.';
$Definition['Quest']['Battle_13']['questDescriptionReward'] = 'Τέλεια. Τώρα μπορείς να εξοπλίσεις καλύτερα τον στρατό σου.';
$Definition['Quest']['Battle_13']['rewardDescription'] = buildResourcesReward([500, 400, 700, 400]);
$Definition['Quest']['Battle_13']['todo'] = [0 => 'Κατασκεύασε ένα σιδηρουργείο.',];

$Definition['Quest']['Battle_14']['questTitle'] = 'Αναβάθμιση μονάδων';
$Definition['Quest']['Battle_14']['questDescription'] = 'Η βελτίωση του εξοπλισμού του στρατού σου δεν είναι φθηνή. Όσο περισσότερους στρατιώτες έχεις, τόσο μεγαλύτερη θα είναι η ανταμοιβή. Αυτήν την φορά, θα κερδίσεις κάτι παραπάνω από αποζημίωση του κόστους.';
$Definition['Quest']['Battle_14']['questDescriptionReward'] = 'Τέλεια, τώρα οι δυνατότητες των στρατευμάτων σου σε επίθεση και άμυνα βελτιώθηκαν.';
$Definition['Quest']['Battle_14']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeItem item112"> <span class="questRewardValue">'.Quest::calcEffect(10, 'item', true).'</span>';
$Definition['Quest']['Battle_14']['todo'] = [0 => 'Ερεύνησε μια βελτίωση στρατεύματος στο σιδηρουργείο.',];

$Definition['Quest']['Battle_15']['questTitle'] = 'Ολοκληρώστε 5 περιπέτειες';
$Definition['Quest']['Battle_15']['questDescription'] = 'Περισσότερες περιπέτειες σημαίνουν περισσότερα λάφυρα και εμπειρία. Διατηρείτε τον ήρωα σας ενεργό αλλά δώστε του την ευκαιρία να ξεκουραστεί αν η υγεία του είναι χαμηλά.';
$Definition['Quest']['Battle_15']['questDescriptionReward'] = 'Οι αλοιφές χρησιμεύουν στην θεραπεία ρου ήρωα. Αν εξοπλιστείτε με αλοιφές, θα χρησιμοποιηθούν μόλις ο ήρωας λάβει ζημιά.';
$Definition['Quest']['Battle_15']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeItem item106"> <span class="questRewardValue">'.Quest::calcEffect(15, 'item', true).'</span>';
$Definition['Quest']['Battle_15']['todo'] = [0 => 'Ολοκληρώστε πέντε περιπέτειες',];

$Definition['Quest']['economy_01_name'] = 'Ορυχείο σιδήρου';
$Definition['Quest']['economy_02_name'] = 'Περισσότερες ύλες';
$Definition['Quest']['economy_03_name'] = 'Σιταποθήκη';
$Definition['Quest']['economy_04_name'] = 'Όλα στο ένα';
$Definition['Quest']['economy_05_name'] = 'Στο 2!';
$Definition['Quest']['economy_06_name'] = 'Αγορά';
$Definition['Quest']['economy_07_name'] = 'Εμπόριο';
$Definition['Quest']['economy_08_name'] = 'Όλα στο 2';
$Definition['Quest']['economy_10_name'] = 'Αποθήκη υλών επίπεδο 3';
$Definition['Quest']['economy_11_name'] = 'Μύλος σιταριού';
$Definition['Quest']['economy_12_name'] = 'Όλα στο 5';

$Definition['Quest']['Economy_01']['questTitle'] = 'Ορυχείο σιδήρου';
$Definition['Quest']['Economy_01']['questDescription'] = 'Παρήγγειλε την κατασκευή ενός ορυχείο σιδήρου! Ο πρωταρχικός σου στόχος είναι ακόμα μια υψηλή παραγωγή υλών ώστε να μεγαλώσεις γρήγορα.';
$Definition['Quest']['Economy_01']['questDescriptionReward'] = 'Μεγαλύτερη παραγωγή σιδήρου για το χωριό σου. Ένα επίδομα παραγωγής θα σε βοηθήσει να αυξήσεις την παραγωγή οποιασδήποτε ύλης ακόμα περισσότερο.';
$Definition['Quest']['Economy_01']['rewardDescription'] = Quest::calcEffect(86400, 'productionBoost', true).' Μια μέρα +25% επίδομα στην παραγωγή όλων των υλών';
$Definition['Quest']['Economy_01']['todo'] = [0 => 'Άρχισε την κατασκευή ενός ορυχείου σιδήρου.',];

$Definition['Quest']['Economy_02']['questTitle'] = 'Περισσότερες ύλες';
$Definition['Quest']['Economy_02']['questDescription'] = 'Αναβάθμισε έναν ξυλοκόπο, ένα ορυχείο πηλού, ένα ορυχείο σιδήρου και ένα χωράφι σιταριού, το καθένα στο επίπεδο 1. Όσο το Travian PLUS είναι ενεργό, μπορείς πάντα να παραγγείλεις περισσότερες κατασκευές την ίδια ώρα.';
$Definition['Quest']['Economy_02']['questDescriptionReward'] = 'Συγχωρητήρια! Το χωριό σας αναπτύσσεται συνεχώς..';
$Definition['Quest']['Economy_02']['rewardDescription'] = buildResourcesReward([160, 190, 150, 70]);
$Definition['Quest']['Economy_02']['todo'] = [0 => 'Αναβαθμίστε ακόμα ένα πεδίο από κάθε ύλη στο επίπεδο 1.',];

$Definition['Quest']['Economy_03']['questTitle'] = 'Σιταποθήκη';
$Definition['Quest']['Economy_03']['questDescription'] = 'Για να αποθηκεύσεις περισσότερο σιτάρι, χρειάζεσαι μια σιταποθήκη. Το τρέχον όριο αποθήκευσης μπορεί να βρεθεί κοιτώντας στην μπάρα των υλών.';
$Definition['Quest']['Economy_03']['questDescriptionReward'] = 'Πολύ ωραία! Η σιταποθήκη τώρα σου επιτρέπει να αποθηκεύσεις περισσότερο σιτάρι.';
$Definition['Quest']['Economy_03']['rewardDescription'] = buildResourcesReward([250, 290, 100, 130]);
$Definition['Quest']['Economy_03']['todo'] = [0 => 'Κατασκεύασε μια σιταποθήκη',];

$Definition['Quest']['Economy_04']['questTitle'] = 'Όλα στο ένα';
$Definition['Quest']['Economy_04']['questDescription'] = 'Στην αρχή είναι καλύτερα να συγκεντρωθείς στις ύλες. Σε παρακαλώ αναβάθμισε όλα τα πεδία υλών σου στο επίπεδο 1.';
$Definition['Quest']['Economy_04']['questDescriptionReward'] = 'Η παραγωγή υλών σου αναπτύσσεται ωραία. Σύντομα θα μπορέσουμε να ξεκινήσουμε την κατασκευή περισσότερων κτηρίων στο χωριό σου.';
$Definition['Quest']['Economy_04']['rewardDescription'] = buildResourcesReward([400, 460, 330, 270]);
$Definition['Quest']['Economy_04']['todo'] = [0 => 'Αναβάθμισε όλα τα πεδία υλών στο επίπεδο 1.',];

$Definition['Quest']['Economy_05']['questTitle'] = 'Στο 2!';
$Definition['Quest']['Economy_05']['questDescription'] = 'Συνέχισε να αυξάνεις την παραγωγή σου. Αναβάθμισε ένα ξυλοκόπο, ένα ορυχείο πηλού, ένα ορυχείο σιδήρου και ένα χωράφι σιταριού στο επίπεδο 2!.';
$Definition['Quest']['Economy_05']['questDescriptionReward'] = 'Πολύ καλά! Αν χρειαστείς περισσότερες πληροφορίες σχετικά με την παραγωγή, πάνω στα αποθέματα..';
$Definition['Quest']['Economy_05']['rewardDescription'] = buildResourcesReward([240, 255, 190, 160]);
$Definition['Quest']['Economy_05']['todo'] = [0 => 'Αναβάθμισε ένα πεδίο ύλης από την καθεμία στο επίπεδο 2 .',];

$Definition['Quest']['Economy_06']['questTitle'] = 'Αγορά';
$Definition['Quest']['Economy_06']['questDescription'] = 'Σε περίπτωση που σου λείπουν κάποιες ύλες, μπορείς να κάνεις εμπόριο για άλλες ύλες με άλλους παίκτες μέσω της αγοράς. Για να κτίσεις μια μικρή αγορά χρειάζεσαι μεγαλύτερο κεντρικό κτήριο.';
$Definition['Quest']['Economy_06']['questDescriptionReward'] = 'Η αγορά σου είναι έτοιμη και μπορείς να αρχίσεις το εμπόριο με άλλους παίκτες. Πρόσεχε τις κακές προσφορές!';
$Definition['Quest']['Economy_06']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . Quest::getInstance()->multiply(600) . '</span>';
$Definition['Quest']['Economy_06']['todo'] = [0 => 'Κατασκεύασε μια αγορά',];

$Definition['Quest']['Economy_07']['questTitle'] = 'Εμπόριο';
$Definition['Quest']['Economy_07']['questDescription'] = 'Υπάρχουσες προσφορές στην αγορά μπορούν να βρεθούν αν πατήσετε στο "αγορά". Έλεγξε την αναλογία συναλλαγής και την απόσταση. Αν δεν βρεις μια κατάλληλη προσφορά, πάτα στο "προσφορά" και δημιούργησε την δικιά σου προσφορά.';
$Definition['Quest']['Economy_07']['questDescriptionReward'] = 'Υπέροχα, δημιούργησες το πρώτο σου εμπόριο.';
$Definition['Quest']['Economy_07']['rewardDescription'] = buildResourcesReward([100, 99, 99, 99]);
$Definition['Quest']['Economy_07']['todo'] = [0 => 'Δημιούργησε μια προσφορά στην αγορά ή δέξου μια υπάρχουσα',];

$Definition['Quest']['Economy_08']['questTitle'] = 'Όλα στο 2';
$Definition['Quest']['Economy_08']['questDescription'] = 'Πριν αρχίσεις την κατασκευή ακριβότερων κτηρίων, πρέπει να αυξήσεις την παραγωγή υλών σου. Αναβάθμισε όλα τα πεδία υλών στο επίπεδο 2.';
$Definition['Quest']['Economy_08']['questDescriptionReward'] = 'Συγχαρητήρια! Η παραγωγή υλών σου αναπτύσσεται ωραία.';
$Definition['Quest']['Economy_08']['rewardDescription'] = buildResourcesReward([400, 400, 400, 200]);
$Definition['Quest']['Economy_08']['todo'] = [0 => 'Αναβάθμισε όλα τα πεδία υλών στο επίπεδο 2',];

$Definition['Quest']['Economy_09']['questTitle'] = 'Αποθήκη υλών επίπεδο 3';
$Definition['Quest']['Economy_09']['questDescription'] = 'Ήρθε η ώρα να προσαρμόσεις την αποθήκη στην αυξανόμενη παραγωγή σου. Λάφυρα από τον ήρωα μπορεί επίσης να κάνουν την αποθήκη σου να ξεχειλίσει.';
$Definition['Quest']['Economy_09']['questDescriptionReward'] = 'Πολύ καλά, δεν θα χαθεί καμία ύλη τώρα.';
$Definition['Quest']['Economy_09']['rewardDescription'] = buildResourcesReward([620, 750, 560, 230]);
$Definition['Quest']['Economy_09']['todo'] = [0 => 'Αναβάθμισε την αποθήκη σου στο επίπεδο 3',];

$Definition['Quest']['Economy_10']['questTitle'] = 'Σιταποθήκη επίπεδο 3';
$Definition['Quest']['Economy_10']['questDescription'] = 'Όσο υψηλότερη η παραγωγή σου, τόσο ευκολότερα γεμίζουν οι αποθήκες σου. Η σιταποθήκη πρέπει επίσης να αναβαθμιστεί..';
$Definition['Quest']['Economy_10']['questDescriptionReward'] = 'Τώρα έχεις πάλι χώρο στην σιταποθήκη, ώστε η παραγωγή να συνεχίσει ακόμα και όταν είσαι απόν.';
$Definition['Quest']['Economy_10']['rewardDescription'] = buildResourcesReward([880, 1020, 590, 320]);
$Definition['Quest']['Economy_10']['todo'] = [0 => 'Αναβάθμισε τη σιταποθήκη στο επίπεδο 3.',];

$Definition['Quest']['Economy_11']['questTitle'] = 'Μύλος σιταριού';
$Definition['Quest']['Economy_11']['questDescription'] = 'Ένας μύλος σιταριού αυξάνει την παραγωγή όλων των χωραφιών σιταριού σου. Για να αξίζει την τιμή του, χρειάζεται να έχει αρκετά υψηλή βασική παραγωγή.';
$Definition['Quest']['Economy_11']['questDescriptionReward'] = 'Τώρα έχεις πολύ ελεύθερο σιτάρι διαθέσιμο για περισσότερες κατασκευές. Υπάρχουν επίσης κτήρια που αυξάνουν την παραγωγή των άλλων υλών.';
$Definition['Quest']['Economy_11']['rewardDescription'] = 'Μύλος σιταριού Επίπεδο 2';
$Definition['Quest']['Economy_11']['todo'] = [0 => 'Αναβάθμισε ένα χωράφι σιταριού στο επίπεδο 5',];

$Definition['Quest']['Economy_12']['questTitle'] = 'Όλα στο 5';
$Definition['Quest']['Economy_12']['questDescription'] = 'Θα χρειαστείς μια πολύ υψηλότερη παραγωγή για να μπορέσεις να κερδίσεις χρόνο μέχρι να μπορέσεις να έχεις την πολυτέλεια για τα κτήρια και τους αποίκους που χρειάζονται για το δεύτερο χωριό. Αναβάθμισε όλα τα πεδία σας στο επίπεδο 5.';
$Definition['Quest']['Economy_12']['questDescriptionReward'] = 'Πολύ καλά, έχεις μια αρκετά καλή παραγωγή..';
$Definition['Quest']['Economy_12']['rewardDescription'] = Quest::calcEffect(86400, 'productionBoost', true).' Μια μέρα +25% επίδομα στην παραγωγή όλων των υλών';
$Definition['Quest']['Economy_12']['todo'] = [0 => 'Αναβάθμισε όλα τα πεδία υλών στο επίπεδο 5.',];

$Definition['Quest']['World_01']['questTitle'] = 'Δες τα στατιστικά';
$Definition['Quest']['World_01']['questDescription'] = 'Στον κόσμο του Travian, ανταγωνίζεσαι χιλιάδες παίκτες. ΄Έλεγξε τα στατιστικά για να βρεις περισσότερα για την τρέχουσα θέση σου στο παιχνίδι.';
$Definition['Quest']['World_01']['questDescriptionReward'] = 'Εκτός από την κατάταξη υπάρχουν και άλλες χρήσιμες πληροφορίες. Η καρτέλα τοπ 10 θα σου δείξει τους δυνατότερους επιθετικούς και τους πιο επιτυχής κλέφτες.';
$Definition['Quest']['World_01']['rewardDescription'] = buildResourcesReward([90, 120, 60, 30]);
$Definition['Quest']['World_01']['todo'] = [0 => 'Άνοιξε τα στατιστικά και σύγκρινε τον εαυτό σου με άλλους παίκτες . ',];

$Definition['Quest']['World_02']['questTitle'] = 'Άλλαξε το όνομα του χωριού';
$Definition['Quest']['World_02']['questDescription'] = 'Ένα όνομα χωριού που επιλέχθηκε από εσένα, δείχνει στους άλλους παίκτες ότι η αυτοκρατορία σου ξεκίνησε ενεργά.';
$Definition['Quest']['World_02']['questDescriptionReward'] = 'Ωραία, τώρα ολοκλήρωσες το πρώτο βήμα για να αφήσεις το σημάδι σου στον κόσμο του Travian.';
$Definition['Quest']['World_02']['rewardDescription'] = Quest::calcEffect(100, 'cp', true) . ' πόντοι πολιτισμού';
$Definition['Quest']['World_02']['todo'] = [0 => 'Άλλαξε το όνομα του χωριού στο σήμα του χωριού.',];

$Definition['Quest']['World_03']['questTitle'] = 'Κεντρικό κτήριο επίπεδο 3';
$Definition['Quest']['World_03']['questDescription'] = 'Ένα μεγαλύτερο κεντρικό κτήριο, ξεκλειδώνει νέα κτήρια και αυξάνει την ταχύτητα των εργατών σας. Το γρηγορότερο κτίσιμο θα αποδώσει μόνο αν παράγεις αρκετές ύλες.';
$Definition['Quest']['World_03']['questDescriptionReward'] = 'Πολύ ωραία, το μεγαλύτερο κεντρικό κτήριο σου επιτρέπει να κατασκευάσεις μερικά πρόσθετα κτήρια που μόλις ξεκλείδωσες.';
$Definition['Quest']['World_03']['rewardDescription'] = buildResourcesReward([170, 100, 130, 70]);
$Definition['Quest']['World_03']['todo'] = [0 => 'Αναβάθμισε το κεντρικό κτήριο στο επίπεδο 3.',];

$Definition['Quest']['World_04']['questTitle'] = 'Κατασκεύασε πρεσβεία';
$Definition['Quest']['World_04']['questDescription'] = 'Ο κόσμος του Travian είναι επικίνδυνο μέρος και χρειάζεται να αμυνθείς. Η καλύτερη πρόσθετη άμυνα προσφέρεται από δυνατούς συμμάχους. Κατασκεύασε μια πρεσβεία για να μπεις σε μια συμμαχία.';
$Definition['Quest']['World_04']['questDescriptionReward'] = 'Τέλεια, μπορείς να δεχθείς προσκλήσεις συμμαχίας. Οι προσκλήσεις μπορούν να βρεθούν μέσα στην πρεσβεία.';
$Definition['Quest']['World_04']['rewardDescription'] = buildResourcesReward([215, 145, 195, 50]);
$Definition['Quest']['World_04']['todo'] = [0 => 'Κατασκεύασε μια πρεσβεία.',];

$Definition['Quest']['World_05']['questTitle'] = 'Άνοιξε τον χάρτη';
$Definition['Quest']['World_05']['questDescription'] = 'Ο χάρτης σου δείχνει τον κόσμο του Travian. Έλεγξε την γειτονιά σου, βρες συμμάχους και αναγνώρισε τις απειλές.';
$Definition['Quest']['World_05']['questDescriptionReward'] = 'Υπάρχουν δυνατοί παίκτες ή συμμαχίες κοντά σου; Ο χάρτης σε βοηθάει επίσης να βρεις οάσεις και σημεία που μπορείς να εγκαταστήσεις νέα χωριά.';
$Definition['Quest']['World_05']['rewardDescription'] = buildResourcesReward([90, 160, 90, 95]);
$Definition['Quest']['World_05']['todo'] = [0 => 'Άνοιξε τον χάρτη στο μενού.',];

$Definition['Quest']['World_06']['questTitle'] = 'Διάβασε μήνυμα';
$Definition['Quest']['World_06']['questDescription'] = 'Μόλις έλαβες ένα μήνυμα με κάποιες χρήσιμες συμβουλές. Αδιάβαστα μηνύματα μπορούν να εντοπιστούν από το νούμερο πάνω από το κουμπί. Ρίξε μια ματιά τώρα.';
$Definition['Quest']['World_06']['questDescriptionReward'] = 'Χρησιμοποίησε μηνύματα για να επικοινωνήσεις με άλλους παίκτες. Βοηθάει πάντα να είσαι ήρεμος και ευγενικός, ακόμα και αν είστε σε διαμάχη.';
$Definition['Quest']['World_06']['rewardDescription'] = buildResourcesReward([280, 315, 200, 145]);
$Definition['Quest']['World_06']['todo'] = [0 => 'Άνοιξε την επισκόπηση μηνυμάτων και διάβασε το μήνυμα από τον taskmaster!',];

$Definition['Quest']['World_07']['questTitle'] = 'Επίδομα χρυσού';
$Definition['Quest']['World_07']['questDescription'] = 'Κατά την διάρκεια των εργασιών, έχεις ήδη χρησιμοποιήσει χρυσό για την εγρήγορσή των εργασιών κατασκευής.';
$Definition['Quest']['World_07']['questDescriptionReward'] = 'Εδώ είναι ακόμα λίγος δωρεάν χρυσός, ώστε να μπορέσεις να τον χρησιμοποιήσεις για κάποια από τα πλεονεκτήματα του χρυσού.';
$Definition['Quest']['World_07']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeGold"> <span class="questRewardValue">20</span>							';
$Definition['Quest']['World_07']['todo'] = [0 => 'Ρίξε μια ματιά στα πλεονεκτήματα που μπορείς να αγοράσεις με τον χρυσό.',];

$Definition['Quest']['World_08']['questTitle'] = 'Συμμαχία ';
$Definition['Quest']['World_08']['questDescription'] = 'Ψάξε για συμμάχους και μπες σε μια συμμαχία. Αν δεν έχεις ακόμα επαφές, έλεγξε τις συμμαχίες των παικτών κοντά σου ή ψάξε για μια συμμαχία στο φόρουμ.';
$Definition['Quest']['World_08']['questDescriptionReward'] = 'Είμαστε έτοιμοι για μια μεγάλη αρχή. Όσο πιο δυνατός και ενεργός είναι ένας παίκτης, τόσο πιο δυνατοί θα είστε σαν ομάδα. Βρήκες πως μπορείτε να αναφέρετε αναφορές επιθέσεων ο ένας στον άλλο και πως να ζητήσετε βοήθεια;';
$Definition['Quest']['World_08']['rewardDescription'] = buildResourcesReward([295, 210, 235, 185]);
$Definition['Quest']['World_08']['todo'] = [0 => 'Μπες σε συμμαχία.',];

$Definition['Quest']['World_09']['questTitle'] = 'Κεντρικό κτήριο επίπεδο 5';
$Definition['Quest']['World_09']['questDescription'] = 'Ήρθε η ώρα να αναβαθμίσετε το κεντρικό κτίριο, ώστε να μπορείτε να κατασκευάσετε νέα κτίρια. Θυμηθείτε επίσης να φροντίσετε την παραγωγή πόρων σας ταυτόχρονα.';
$Definition['Quest']['World_09']['questDescriptionReward'] = 'Υπέροχα, τώρα μπορείς να κατασκευάσεις ένα μέγαρο. Επίσης, η ταχύτητα των εργατών αυξήθηκε.';
$Definition['Quest']['World_09']['rewardDescription'] = buildResourcesReward([570, 470, 560, 265]);
$Definition['Quest']['World_09']['todo'] = [0 => 'Αναβάθμισε το κεντρικό κτήριο στο επίπεδο 5.',];

$Definition['Quest']['World_10']['questTitle'] = 'Η βάση της κυβέρνησης';
$Definition['Quest']['World_10']['questDescription'] = 'Κατασκεύασε την βάση της κυβέρνησης τώρα για να ιδρύσεις ένα νέο χωριό σύντομα. Αν δεν είσαι σίγουρος αν θες αυτό το χωριό να παραμείνει πρωτεύουσά σου, παρακαλώ διάλεξε το μέγαρο.';
$Definition['Quest']['World_10']['questDescriptionReward'] = 'Αυτά τα κτήρια είναι απαραίτητα για να ιδρύσεις ένα νέο χωριό ή να κατακτήσεις ένα. Το επίπεδό του περιορίζει τον αριθμό πιθανών επεκτάσεων';
$Definition['Quest']['World_10']['rewardDescription'] = buildResourcesReward([525, 420, 620, 335]);
$Definition['Quest']['World_10']['todo'] = [0 => 'Κατασκεύασε ένα μέγαρο ή παλάτι',];

$Definition['Quest']['World_11']['questTitle'] = 'Πόντοι πολιτισμού';
$Definition['Quest']['World_11']['questDescription'] = 'Για να έχεις την κυριαρχία πάνω σε περισσότερα χωριά στην αυτοκρατορία σου, χρειάζεσαι πόντους πολιτισμού. Η επισκόπηση στο μέγαρο σου δείχνει πόσο μακριά είσαι και πόσο θα πάρει.';
$Definition['Quest']['World_11']['questDescriptionReward'] = 'Στην λίστα των χωριών σου μπορείς επίσης να δεις την τρέχουσα κατάσταση για πιθανά νέα χωριά και το ποσό των πόντων πολιτισμού που σου λείπει. Πήγαινα στο "Answers" για να βρεις πόσο γρήγορα αυξάνεις τους πόντους πολιτισμού σου.';
$Definition['Quest']['World_11']['rewardDescription'] = buildResourcesReward([650, 800, 740, 530]);
$Definition['Quest']['World_11']['todo'] = [0 => 'Άνοιξε την καρτέλα με τους πόντους πολιτισμού στο μέγαρο.',];

$Definition['Quest']['World_12']['questTitle'] = 'Αποθήκη υλών επίπεδο 7';
$Definition['Quest']['World_12']['questDescription'] = 'Αναβάθμισε την αποθήκη υλών σου για να προετοιμαστείς για την ίδρυση ενός νέου χωριού. Η τρέχουσα δυνατότητα αποθήκευσης δεν είναι αρκετή για να κτίσεις τα απαιτούμενα κτήρια για την ίδρυση νέου χωριού.';
$Definition['Quest']['World_12']['questDescriptionReward'] = 'Μπράβο, η δυνατότητα αποθήκευσης πρέπει να είναι αρκετή για κάποιο χρονικό διάστημα. Να θυμάσαι να υπερασπίζεσαι ή να κρύβεις τις πολύτιμες ύλες σου.';
$Definition['Quest']['World_12']['rewardDescription'] = buildResourcesReward([2650, 2150, 1810, 1320]);
$Definition['Quest']['World_12']['todo'] = [0 => 'Αναβάθμισε την αποθήκη υλών στο επίπεδο 7.',];

$Definition['Quest']['World_13']['questTitle'] = 'Αναφορές περιχώρων';
$Definition['Quest']['World_13']['questDescription'] = 'Οι αναφορές περιχώρων σε βοηθούν να μείνεις πληροφορημένος για γεγονότα και αλλαγές στην περιοχή σου.';
$Definition['Quest']['World_13']['questDescriptionReward'] = 'Από αλλαγή ονομάτων μέχρι επιδρομές και κατακτήσεις, όλα είναι δυνατά. Ελπίζω να απόλαυσες το διάβασμα.';
$Definition['Quest']['World_13']['rewardDescription'] = buildResourcesReward([800, 700, 750, 600]);
$Definition['Quest']['World_13']['todo'] = [0 => 'Άνοιξε τις αναφορές και διάβασε τις αναφορές περιχώρων.',];

$Definition['Quest']['World_14']['questTitle'] = 'Μέγαρο ή παλάτι επίπεδο 10';
$Definition['Quest']['World_14']['questDescription'] = 'Οι άποικοι μπορούν να εκπαιδευτούν σε ένα μέγαρο ή παλάτι. Στην καρτέλα "Εκπαίδευση" σου δείχνει το απαιτούμενο επίπεδο κτηρίου.';
$Definition['Quest']['World_14']['questDescriptionReward'] = 'Από κάθε χωριό μπορείς μόνο να ελέγξεις 2 έως 3 χωριά. Το μόνο που λείπει τώρα για ένα νέο χωριό είναι 3 άποικοι και πολλοί πόντοι πολιτισμού.';
$Definition['Quest']['World_14']['rewardDescription'] = Quest::calcEffect(500, 'cp', true) . ' πόντοι πολιτισμού. ';
$Definition['Quest']['World_14']['todo'] = [0 => 'Αναβάθμισε το μέγαρο ή το παλάτι στο επίπεδο 10. ',];

$Definition['Quest']['World_15']['questTitle'] = 'Εκπαίδευσε τρεις αποίκους';
$Definition['Quest']['World_15']['questDescription'] = 'Οι άποικοι πάντα ταξιδεύουν σε μια μικρή ομάδα όταν ιδρύουν ένα νέο χωριό. Προστάτευσε τους αποίκους σου καλά από τις επιθέσεις μέχρι να είναι έτοιμοι να φύγουν.';
$Definition['Quest']['World_15']['questDescriptionReward'] = 'Ωραία. Οι άποικοι πάντα θα παίρνουν μερικές ύλες για το νέο χωριό μαζί τους, ώστε να μπορούν να αρχίσουν να το κτίζουν αμέσως.';
$Definition['Quest']['World_15']['rewardDescription'] = buildResourcesReward([1050, 800, 900, 750]);
$Definition['Quest']['World_15']['todo'] = [0 => 'Εκπαίδευσε τρεις αποίκους.',];

$Definition['Quest']['World_16']['questTitle'] = 'Ίδρυση νέου χωριού';
$Definition['Quest']['World_16']['questDescription'] = 'Ψάξε τον χάρτη για ένα καλό σημείο για εγκατάσταση. Θα ήθελες να είσαι κοντά στο χωριό σου, να παράγεις περισσότερο από μια ύλη ή να είσαι κοντά σε πολλές οάσεις;';
$Definition['Quest']['World_16']['questDescriptionReward'] = "Πολύ καλά. Θα σου δώσω τώρα άλλες 2 ημέρες Travian Plus - αυτό θα σε βοηθήσει.";
$Definition['Quest']['World_16']['rewardDescription'] = Quest::calcEffect(172800, 'plus', true) . ' ώρες Travian plus.';
$Definition['Quest']['World_16']['todo'] = [0 => 'Ίδρυσε δεύτερο χωριό χρησιμοποιώντας τους αποίκους σου.',];

$Definition['Quest']['world_01_name'] = 'Δες τα στατιστικά';
$Definition['Quest']['world_02_name'] = 'Άλλαξε το όνομα του χωριού';
$Definition['Quest']['world_03_name'] = 'Κεντρικό κτήριο επίπεδο 3 ';
$Definition['Quest']['world_04_name'] = 'Κατασκεύασε πρεσβεία';
$Definition['Quest']['world_05_name'] = 'Άνοιξε τον χάρτη';
$Definition['Quest']['world_06_name'] = 'Διάβασε μήνυμα';
$Definition['Quest']['world_07_name'] = 'Επίδομα χρυσού';
$Definition['Quest']['world_08_name'] = 'Μπες σε συμμαχία';
$Definition['Quest']['world_09_name'] = 'Κεντρικό κτήριο επίπεδο 5';
$Definition['Quest']['world_10_name'] = 'Η βάση της κυβέρνησης';
$Definition['Quest']['world_11_name'] = 'Πόντοι πολιτισμού';
$Definition['Quest']['world_12_name'] = 'Αποθήκη υλών επίπεδο 7';
$Definition['Quest']['world_13_name'] = 'Αναφορές περιχώρων';
$Definition['Quest']['world_14_name'] = 'Μέγαρο ή παλάτι επίπεδο 10';
$Definition['Quest']['world_15_name'] = 'Εκπαίδευσε τρεις αποίκους';
$Definition['Quest']['world_16_name'] = 'Νεο χωριό';
//
$Definition['RallyPoint']['greyAreaNewVillageCaution'] = 'Caution: If you settle a village at this coordinates, Natars will try to attack and keep you away from this area.<br />Villages in this area will not produce culture points.';
$Definition['RallyPoint']['Changed successfully: %s will be the new home village for hero'] = 'Changed successfully: %s will be the new home village for hero.';
$Definition['RallyPoint']['nowSettlersWillGoNeedsXResources'] = 'Now settlers will go to create a new village.<br />Creating new village needs %s of each resources (lumber, clay, iron, crop).';
$Definition['RallyPoint']['Settlers']['notEnoughResources'] = 'Not enough resources.';

$Definition['RallyPoint']['sendBack'] = 'Στείλε πίσω';
$Definition['RallyPoint']['reinforcement'] = 'Ενίσχυση';
$Definition['RallyPoint']['normal'] = 'Κανονική';
$Definition['RallyPoint']['raid'] = 'Επιδρομή';
$Definition['RallyPoint']['attack'] = 'Επίθεση';
$Definition['RallyPoint']['Village'] = 'Χωριό';
$Definition['RallyPoint']['changeHeroHomeVillage'] = 'επανατοποθέτηση ήρωα';
$Definition['RallyPoint']['or'] = 'ή';
$Definition['RallyPoint']['number'] = 'Αριθμός';
$Definition['RallyPoint']['withdraw'] = 'Απόσυρση';
$Definition['RallyPoint']['send'] = 'Στείλε';
$Definition['RallyPoint']['reviving'] = 'Αναγεννιέται';
$Definition['RallyPoint']['createNewVillage'] = 'Ἰδρυση νέου χωριού';
$Definition['RallyPoint']['loyaltyReducedBy'] = 'Η πίστη μειώθηκε κατά';
$Definition['RallyPoint']['spy'] = 'Ανίχνευση';
$Definition['RallyPoint']['supply'] = 'Ενίσχυση';
$Definition['RallyPoint']['Errors']['activeVillageChanged'] = 'Active village was changed.';
$Definition['RallyPoint']['Errors']['EnterCoordinateOrDname'] = 'Δώσε όνομα ή συντεταγμένες.';
$Definition['RallyPoint']['Errors']['noVillageWithThisName'] = 'Το χωριό δεν υπάρχει.';
$Definition['RallyPoint']['Errors']['noVillageInCoordinate'] = 'Οι συντεταγμένες δεν υπάρχουν.';
$Definition['RallyPoint']['Errors']['NatarCapitalError'] = 'Δεν μπορείτε να στείλετε ενισχύσεις στην πρωτεύουσα των Ναταρίων!';
$Definition['RallyPoint']['Errors']['noTroopsSelected'] = 'Δεν επιλέχθηκε κανένα στράτευμα.';
$Definition['RallyPoint']['Errors']['playerHasBeginnerProtection'] = 'Ο παίκτης βρίσκεται υπό την προστασία νέου παίκτη.';
$Definition['RallyPoint']['Errors']['cantAttackUrSelf'] = 'Τα στρατεύματά σας βρίσκονται ήδη στο χωριό σας';
$Definition['RallyPoint']['Errors']['cantAttackDuringProtection'] = 'Δεν μπορείτε να επιτεθείτε ενώ βρίσκεστε σε προστασία νέου παίκτη.';
$Definition['RallyPoint']['Errors']['reallyAttackOwn?'] = 'Προειδοποίηση! Θέλεις πραγματικά να επιτεθείς στον εαυτό σου;';
$Definition['RallyPoint']['Errors']['reallyAttackFriend?'] = 'Προειδοποίηση! Θέλετε πραγματικά να επιτεθείτε σε έναν φίλο;';
$Definition['RallyPoint']['Errors']['protectionWillBeGone'] = 'Η προστασία νέου παίκτη θα τερματιστεί. Είστε σίγουρος;';
$Definition['RallyPoint']['Errors']['youCannotAttackArtifactWhileInProtection'] = 'You cannot attack a village with artifact while you are in protection.';
$Definition['RallyPoint']['Errors']['youAreBanned'] = 'Ο λογαριασμός σας έχει κλειδωθεί.';
$Definition['RallyPoint']['Errors']['playerBanned'] = 'Ο λογαριασμός αυτός έχει κλειδωθεί λόγω παραβιάσεων των κανόνων του παιχνιδιού';
$Definition['RallyPoint']['Errors']['cantSendReinforcementsDuringProtection'] = 'Δεν μπορείτε να στείλετε ενισχύσεις ενώ βρίσκεστε σε προστασία νέου παίκτη.';
$Definition['RallyPoint']['Errors']['heroDeployError'] = 'Μπορείτε να μετακινηθείτε μόνο σε σας εδώ σε μια ενίσχυση. Σημειώστε ότι το χωριό στόχος πρέπει να έχει πλατεία συγκέντρωσης.';
$Definition['RallyPoint']['Errors']['serverFinished'] = 'Το παιχνίδι τελείωσε.';
$Definition['RallyPoint']['Errors']['playerIsInVacation'] = 'Ο παίκτης βρίσκεται σε διακοπές.';
$Definition['RallyPoint']['Errors']['farmsAreProtectedTill'] = 'Η φάρμα προστατεύεται μέχρι %s.';
$Definition['RallyPoint']['reinforcementForVillageName'] = 'Ενισχύσεις για %s';
$Definition['RallyPoint']['send'] = 'Αποστολή';
$Definition['RallyPoint']['edit'] = 'Επεξεργασία';
$Definition['RallyPoint']['reinforcementForPlayerName'] = 'Ενισχύσεις για %s';
$Definition['RallyPoint']['imprisendInVillage'] = 'Κρατούμενοι στο %s';
$Definition['RallyPoint']['imprisendPlayer'] = 'Φυλακισμένοι %s';
$Definition['RallyPoint']['showAll'] = 'προβολή όλων';
$Definition['RallyPoint']['no_incoming_troops_error'] = 'Δεν υπάρχουν εισερχώμενα στρατεύματα.';
$Definition['RallyPoint']['no_outgoing_troops_error'] = 'Δεν υπάρχουν στρατεύματα στο δρόμο.';
$Definition['RallyPoint']['no_outvillage_troops_error'] = 'Δεν υπάρχουν εξερχώμενα στρατεύματα.';
$Definition['RallyPoint']['return'] = 'Επιστροφή';
$Definition['RallyPoint']['units'] = 'Μονάδες';
$Definition['RallyPoint']['ownTroops'] = 'Δικά μου στρατεύματα';
$Definition['RallyPoint']['from'] = 'από';
$Definition['RallyPoint']['CrannyForest'] = 'Μεγάλο βουνό';
$Definition['RallyPoint']['adventure'] = 'Περιπέτια';
$Definition['RallyPoint']['occupiedOasis'] = 'Κατειλημμένη ὀαση';
$Definition['RallyPoint']['unoccupiedOasis'] = 'Μη κατειλημμένη όαση';
$Definition['RallyPoint']['ArrivalIn'] = 'Άφιξη';
$Definition['RallyPoint']['against'] = 'εναντίον';
$Definition['RallyPoint']['for'] = 'για';
$Definition['RallyPoint']['of'] = 'από';
$Definition['RallyPoint']['catapultTargets'] = 'Στόχος';
//attack types
$Definition['RallyPoint']['inAttack'] = $Definition['RallyPoint']['outAttack'] = $Definition['RallyPoint']['inAttackOasis'] = 'Επίθεση';
$Definition['RallyPoint']['inRaid'] = $Definition['RallyPoint']['outRaid'] = $Definition['RallyPoint']['inRaidOasis'] = 'Επιδρομή';
$Definition['RallyPoint']['inSupply'] = $Definition['RallyPoint']['outSupply'] = $Definition['RallyPoint']['inSupplyOasis'] = 'Ενίσχυση';
$Definition['RallyPoint']['outSettlers'] = 'Ίδρυση νέου χωριού';
$Definition['RallyPoint']['outSpy'] = 'Ανίχνευση';
$Definition['RallyPoint']['myOasis'] = 'My Oasis';
$Definition['RallyPoint']['outEscape'] = 'Διαφυγή σε βουνό';
$Definition['RallyPoint']['filters'][1] = 'Εισερχόμενα στρατεύματα';
$Definition['RallyPoint']['filters'][2] = 'Εξερχόμενα στρατεύματα';
$Definition['RallyPoint']['filters'][3] = 'Στρατεύματα στο χωριό και τις οάσεις του';
$Definition['RallyPoint']['filters'][4] = 'Στρατεύματα σε άλλα χωριά και οάσεις';
$Definition['RallyPoint']['SubFilters'][1] = 'Εισερχόμενες επιθέσεις/επιδρομές';
$Definition['RallyPoint']['SubFilters'][2] = 'Εισερχόμενα στρατεύματα';
$Definition['RallyPoint']['SubFilters'][3] = 'Ενισχύσεις';
$Definition['RallyPoint']['SubFilters'][4] = 'Εξερχόμενες επιθέσεις/επιδρομές';
$Definition['RallyPoint']['SubFilters'][5] = 'Δικές μου ενισχύσεις';
$Definition['RallyPoint']['SubFilters'][6] = 'Όλα';
$Definition['RallyPoint']['goldClubEvasionDesc'] = 'Με το Gold club μπορείτε να διατάξετε τα στρατεύματά σας να δραπετεύσουν από επιθέσεις στην πρωτεύουσά σας.';
$Definition['RallyPoint']['evasion in capital'] = 'Διαφυγή στην πρωτεύουσα';
$Definition['RallyPoint']['goldclub'] = 'Gold club';
$Definition['RallyPoint']['EvasionSettings'] = 'Επιλογές διαφυγής';
$Definition['RallyPoint']['HeroShowDesc'] = ' Ο ήρωάς σας θα παραμείνει πάντα στα στρατεύματα';
$Definition['RallyPoint']['HeroHideDesc'] = 'Ο Ήρωας θα κρυφτεί σε μια επίθεση σε αυτό το χωριό.';
$Definition['RallyPoint']["EvasionDesc"] = 'Ενεργοποίηση διαφυγής στρατευμάτων για την πρωτεύουσα. Τα στρατεύματα θα φύγουν την στιγμή της επίθεσης και θα επιστρέψουν μετά από 180 δευτ. Τα στρατεύματα θα διαφύγουν μόνο αν ΔΕΝ υπάρχουν στρατεύματα που επιστρέφουν σπίτι μέσα σε 10 δευτ. πριν την επίθεση, με την εξαίρεση στρατευμάτων που επιστρέφουν μετά την χρήση αυτής της επιλογής. Αυτή η επιλογή θα επηρεάσει όλα τα εκπαιδευμένα στρατεύματα στο χωριό να διαφύγουν, αλλά στρατεύματα ενισχύσεων ΔΕΝ θα διαφύγουν.';
$Definition['RallyPoint']['Management'] = 'Διαχείριση';
$Definition['RallyPoint']['overview'] = 'Επισκόπηση';
$Definition['RallyPoint']['sendTroops'] = 'Στείλε στρατό';
$Definition['RallyPoint']['combatSimulator'] = 'Προσομ. μάχης';
$Definition['RallyPoint']['farmlist'] = 'Φάρμες';
$Definition['RallyPoint']['needClubToBeActive'] = 'για αυτό το στοιχείο χρειάζεται να έχεις ενεργοποιημένο το Gold club';
$Definition['RallyPoint']['This tab is set as favourite'] = 'Αυτή η καρτέλα έχει οριστεί ως αγαπημένη';
$Definition['RallyPoint']['Set tab x as favourite'] = 'Θέσε το %s στα αγαπημένα';
$Definition['RallyPoint']['ArrivalIn'] = 'Άφιξη';
$Definition['RallyPoint']['kill'] = 'Σκότωσε';
$Definition['RallyPoint']['target'] = 'Στόχος';
$Definition['RallyPoint']['player'] = 'Παίκτης';
$Definition['RallyPoint']['catapult only attacks in normal type'] = 'Οι καταπέλτες βρίσκουν στόχο μόνο σε επίθεση τύπου <b>κανονική</b>';
$Definition['RallyPoint']['troops'] = 'Στρατεύματα';
$Definition['RallyPoint']['random'] = 'Τυχαία';
$Definition['RallyPoint']['willBeAttackedTarget'] = 'Θα δεχτεί επίθεση από καταπέλτες';
$Definition['RallyPoint']['options'] = 'Επιλογές';
$Definition['RallyPoint']['Consumption'] = 'Συντήρηση';
$Definition['RallyPoint']['withdraw'] = 'Απόσυρση πίσω';
$Definition['RallyPoint']['TroopKillDesc'] = 'Είστε βέβαιοι ότι θέλετε να σκοτώσετε στρατεύματα?';
$Definition['RallyPoint']['Sendback'] = 'Στείλτε πίσω';
$Definition['RallyPoint']['free'] = 'Free';
$Definition['RallyPoint']['spyTarget'] = 'Τύπος ανίχνευσης';
$Definition['RallyPoint']['spyTargetTroopsBuildings'] = 'Ανίχνευση άμυνας και στρατευμάτων';
$Definition['RallyPoint']['spyTargetTroopsResources'] = 'Ανίχνευση πρώτων υλών και στρατευμάτων';
//
$Definition['reCaptcha']['title'] = 'Σύστημα αναγνώρισης Bot';
$Definition['reCaptcha']['desc'] = 'Πρέπει να επαληθεύσετε ότι δεν είστε ρομπότ παίζοντας το παιχνίδι.<br /><br />Κάντε κλικ στο πλαίσιο ελέγχου για να βεβαιωθείτε ότι δεν είστε ρομπότ.';
$Definition['reCaptcha']['Sorry you submitted wrong answer'] = 'Λυπούμαστε που η απάντησή σας δεν είναι σωστή.';

$Definition['farmListLockHandle']['title'] = 'Σύστημα ταυτοποίησης bot';
$Definition['farmListLockHandle']['captcha'] = 'Captcha';
$Definition['farmListLockHandle']['submit'] = 'Υποβολή';
$Definition['farmListLockHandle']['newCode'] = 'Ζητήστε νέο κωδικό';
$Definition['farmListLockHandle']['desc'] = 'Χρησιμοποιήσατε τη φάρμα περισσότερο από το αναμενόμενο σε σύντομο χρονικό διάστημα. Δεν μπορείτε πλέον να χρησιμοποιήσετε τη λίστα φάρμινγκ. Απελευθερώστε το λογαριασμό σας εισάγοντας το παρακάτω κείμενο στην είσοδο.';
$Definition['farmListLockHandle']['Sorry you submitted wrong answer'] = 'Λυπούμαστε που η απάντηση δεν είναι σωστή.';

//
$Definition['Reports'] = ["reportTypes" => [1 => 'Νίκησε σαν επιτιθέμενος χωρίς απώλειες',
    0 => 'Αναφορά',
    2 => 'Νίκησε σαν επιτιθέμενος με απώλειες',
    3 => 'Έχασε σαν επιτιθέμενος',
    4 => 'Νίκησε σαν αμυνόμενος χωρίς απώλειες',
    5 => 'Νίκησε σαν αμυνόμενος με απώλειες',
    6 => 'Έχασε σαν αμυνόμενος με απώλειες',
    7 => 'Έχασε σαν αμυνόμενος χωρίς απώλειες',
    8 => 'Έφτασαν ενισχύσεις',
    11 => 'Οι έμποροι παρέδωσαν περισσότερο ξύλο.',
    12 => 'Οι έμποροι παρέδωσαν περισσότερο πηλό.',
    13 => 'Οι έμποροι παρέδωσαν περισσότερο σίδηρο.',
    14 => 'Οι έμποροι παρέδωσαν περισσότερο σιτάρι.',
    15 => 'Η ανίχνευση ήταν επιτυχής και δεν εντοπίστηκε.',
    16 => 'Η ανίχνευση ήταν επιτυχής αλλά εντοπίστηκε.',
    17 => 'Η ανίχνευση απέτυχε.',
    18 => 'Η ανίχνευση αποτράπηκε επιτυχώς.',
    19 => 'Η ανίχνευση δεν αποτράπηκε',
    20 => 'Ζώα πιάστηκαν',
    21 => 'Αναφορά περιπέτειας.',
    22 => 'Επιτυχής δημιουργία χωριού',
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
$Definition['Reports']['newVillageCreatedSuccussFully'] = 'Νέο χωριό δημιουργήθηκε με επιτυχία';
$Definition['Reports']['escapeNonCapitalErr'] = 'Τα στρατεύματά σας δεν διέφυγαν επειδή η διαφυγή είναι διαθέσιμη μόνο στην πρωτεύουσα.';
$Definition['Reports']['escapeTroopsComingErr'] = 'Τα στρατεύματά σας δεν διέφυγαν επειδή πήρατε μια επιστροφή μέσα σε 10 δευτερόλεπτα.';
$Definition['Reports']['evasionNotEnabled'] = 'Troops didn`t escape because evasion is not enabled.';
$Definition['Reports']['escapeDisabledBecauseYourPopulationIsTooLow'] = 'Troops didn`t escape because your village population is too low.';
$Definition['Reports']['Overflowing reports will be deleted automatically, if they are older than %s hours'] = 'Οι αναφορές θα διαγραφούν αυτόματα, αν είναι μεγαλύτερες από% s ώρες.';
$Definition['Reports']['Archive||For this feature you need the Gold club activated'] = 'Αρχείο || Για αυτό το χαρακτηριστικό χρειάζεστε το Gold club ενεργοποιημένο.';
$Definition['Reports']['Add to farm list||For this feature you need the Gold club activated'] = 'Προσθήκη στη λίστα με φάρμες || Για να χρησιμοποιήσετε αυτή την επιλογή πρέπει να ενεργοποιήσετε το Gold Club.';
$Definition['Reports']['Mark as read'] = 'Μάρκαρε ως διαβασμένο';
$Definition['Reports']['Mark as unread'] = 'Μάρκαρε ως αδιάβαστο';
$Definition['Reports']['Combat simulator'] = 'Προσομοιωτής μάχης';
$Definition['Reports']['Repeat attack'] = 'Επανάληψη επίθεσης';
$Definition['Reports']['Tabs']['All'] = 'Όλα';
$Definition['Reports']['Tabs']['Troops'] = 'Στρατεύματα';
$Definition['Reports']['Tabs']['Trade'] = 'Εμπόριο';
$Definition['Reports']['Tabs']['Miscellaneous'] = 'Διάφορα';
$Definition['Reports']['Tabs']['Archive'] = 'Αρχείο';
$Definition['Reports']['Tabs']['Surrounding'] = 'Περίγυρος';
$Definition['Reports']['Tabs']['Attacks'] = 'Επιθετικές';
$Definition['Reports']['Tabs']['Defense'] = 'Αμυντικές';
$Definition['Reports']['Tabs']['Spy'] = 'Κατασκοπία';
$Definition['Reports']['Tabs']['Other'] = 'Διάφορα';
$Definition['Reports']['needClub'] = 'Για να χρησιμοποιήσετε αυτή την επιλογή πρέπει να ενεργοποιήσετε το Gold Club.';
$Definition['Reports']['village totally destroyed'] = 'Το χωριό καταστράφηκε ολοκληρωτικά.';
$Definition['Reports']['adventureFailed'] = 'Αποτυχής περιπέτεια.';
$Definition['Reports']['Silver'] = 'Ασήμι';
$Definition['Reports']['WWPlanCaptured'] = 'Σχέδιο κατασκευής Παγκοσμίου Θαύματος κατακτήθηκε.';
$Definition['Reports']['heroArtifactCapture'] = 'Πολύτιμο αντικείμενο κατακτήθηκε.';
$Definition['Reports']['x didnt damaged'] = '%s δεν έπαθε ζημιά.';
$Definition['Reports']['TrapFreeAllianceAndMe'] = 'Έχετε απελευθερώσει %s στρατεύματα σας και %s στρατεύματα της συμμαχίας σας και άλλοι σκοτώθηκαν.';
$Definition['Reports']['TrapFreeMe'] = 'Έχετε απελευθερώσει %s στρατεύματα σας και άλλοι σκοτώθηκαν.';
$Definition['Reports']['TrapFreeAlliance'] = 'Έχετε απελευθερώσει %s στρατεύματα της συμμαχίας σας και άλλοι σκοτώθηκαν.';
$Definition['Reports']['select all'] = 'Επιλογή όλων';
$Definition['Reports']['Unread'] = 'Αδιάβαστη';
$Definition['Reports']['location'] = 'Τοποθεσία';
$Definition['Reports']['distance'] = 'Απόσταση';
$Definition['Reports']['Read'] = 'Διαβασμένη';
$Definition['Reports']['newer reports'] = 'προηγούμενη αναφορά';
$Definition['Reports']['older reports'] = 'επόμενη αναφορά';
$Definition['Reports']['Really delete this report?'] = 'Θέλετε να διαγραφή αυτή η αναφορά;';
$Definition['Reports']['Delete report'] = 'Διαγραφή αναφοράς';
$Definition['Reports']['Delete'] = 'Διαγραφή';
$Definition['Reports']['Archive'] = 'Αρχείο';
$Definition['Reports']['Recover'] = 'Ανάκτηση';
$Definition['Reports']['Access permissions'] = 'Επιλογές πρόσβασης';
$Definition['Reports']['make opponent anonymous'] = 'κάντε τον αντίπαλο ανώνυμο';
$Definition['Reports']['make myself anonymous'] = 'κάντε τον εαυτό μου ανώνυμο';
$Definition['Reports']['hide own troops'] = 'κρύψτε τα δικά μου στρατεύματα';
$Definition['Reports']['hide opposing troops'] = 'κρύψτε τα αντίπαλα στρατεύματα';
$Definition['Reports']['Description:'] = 'Περιγραφή:';
$Definition['Reports']['VillageCaptured'] = 'Οι κάτοικοι του χωριού %s αποφάσισαν να ενταχθούν στην αυτοκρατορία σου.';
$Definition['Reports']['CantCaptureCapital'] = 'Η (πρωτεύουσα) δεν μπορεί να κατακτηθεί.';
$Definition['Reports']['culturePointsErr'] = 'Μη επαρκείς πόντοι πολιτισμού.';
$Definition['Reports']['rpExists'] = 'Υπάρχει Παλάτι ή Μέγαρο.';
$Definition['Reports']['You can only have 1 ww village at a time'] = 'Σε αυτό το γύρο μπορείτε να κατακτήσετε μόνο ένα Παγκόσμιο Θαύμα.';
$Definition['Reports']['You cannot capture your alliance members village'] = 'You cannot capture your alliance member`s village.';
$Definition['Reports']['randomTargetsWereChosen'] = 'Random targets were selected.';
$Definition['Reports']['defenderIsSupportedByTheFollowingArtifact'] = 'Defender is protected by the following artifact: %s';
$Definition['Reports']['NoFreeAttackerTreasurySpace'] = 'Δεν υπάρχει θησαυροφυλάκιο ή το θησαυροφυλάκιο είναι γεμάτο.';
$Definition['Reports']['maxArtifactReached'] = 'Έχετε τα μέγιστα δυνατά πολύτιμα αντικείμενα.';
$Definition['Reports']['TreasuryExists'] = 'Υπάρχει θησαυροφυλάκιο';
$Definition['Reports']['From'] = 'από το';
$Definition['Reports']['Village'] = 'χωριό';
$Definition['Reports']['oasis'] = 'όαση';
$Definition['Reports']['Troops'] = 'Στρατεύματα';
$Definition['Reports']['units'] = 'Μονάδες';
$Definition['Reports']['Trapped'] = 'Παγιδεύτηκαν';
$Definition['Reports']['casualties'] = 'Απώλειες';
$Definition['Reports']['from oasis'] = 'από την όαση';
$Definition['Reports']['you used x cages'] = 'Χρησιμοποίησες %s κλουβιά.';
$Definition['Reports']['x attacks y'] = 'Ο %s επιτέθηκε στον %s.';
$Definition['Reports']['x send resources to y'] = 'Ο %s έστειλε ύλες στον %s.';
$Definition['Reports']['Bounty'] = 'Λάφυρα';
$Definition['Reports']['exp'] = 'Εμπειρία';
$Definition['Reports']['noValuableThingFound'] = 'Δεν βρέθηκε τίποτα αξίας.';
$Definition['Reports']['injury'] = 'Υγεία';
$Definition['Reports']['unknown'] = 'unknown';
$Definition['Reports']['Sender'] = 'Αποστολέας';
$Definition['Reports']['Recipient'] = 'Παραλήπτης';
$Definition['Reports']['supplies'] = 'τροφοδοτεί';
$Definition['Reports']['from alliance'] = 'από τη συμμαχία';
$Definition['Reports']['x supplies y'] = '%s τροφοδοτεί %s';
$Definition['Reports']['Consumption'] = 'Κατανάλωση';
$Definition['Reports']['reinforced'] = 'ενίσχυσε';
$Definition['Reports']['x reinforced y'] = 'Ο %s ενίσχυσε το %s';
$Definition['Reports']['perHR'] = 'την ώρα';
$Definition['Reports']['x destroyed'] = '%s κατεστράφη.';
$Definition['Reports']['reduced lvl from x to y'] = 'Το επίπεδο του %s μειώθηκε από %s σε %s.';
$Definition['Reports']['x did not damaged'] = 'Το %s δεν έπαθε ζημιά.';
$Definition['Reports']['you troops in village x were attacked'] = 'Οι ενισχύσεις σου στο χωριό %s δέχτηκαν επίθεση';
$Definition['Reports']['x is on adventure'] = '%s εξερευνά %s.';
$Definition['Reports']['An Oasis was plundered'] = 'Μια όαση λεηλατήθηκε.';
$Definition['Reports']['x has conquered an oasis'] = 'Ο %s έχει κατακτήσει μια όαση.';
$Definition['Reports']['An Oasis was abandoned'] = 'Μια όαση εγκαταλείφθηκε.';
$Definition['Reports']['x has founded y'] = '%s ίδρυσε το %s.';
$Definition['Reports']['x has conquered y'] = '%s έχει κατακτήσει το %s.';
$Definition['Reports']['x has lost y'] = '%s έχασε το %s.';
$Definition['Reports']['x renamed y to z'] = '%s μετονόμασε το %s σε %s.';
$Definition['Reports']['A fight took at village name of player name'] = 'Μια μάχη έγινε στο χωριό  %s του %s.';
$Definition['Reports']['noData'] = 'Δεν υπάρχουν αναφορές διαθέσιμες.';
$Definition['Reports']['Subject'] = 'Θέμα';
$Definition['Reports']['Sent'] = 'Αποστολή';
//report types
$Definition['Reports']['AnimalsCaught'] = 'Τα ζώα αιχμαλωτίστηκαν.';
$Definition['Reports']['x spies y'] = 'Ο %s ανίχνευσε %s.';
$Definition['Reports']['x founds a new village'] = '%s ίδρυσε ένα νέο χωριό';
$Definition['Reports']['occupiedOasis'] = 'Κατειλημμένη ὀαση';
$Definition['Reports']['unoccupiedOasis'] = 'Μη κατειλημμένη όαση';
$Definition['Reports']['Attacker'] = 'Επιτιθέμενος';
$Definition['Reports']['Defender'] = 'Αμυνόμενος';
$Definition['Reports']['Reinforcement'] = 'Ενίσχυση';
$Definition['Reports']['Information'] = 'Πληροφορίες';
$Definition['Reports']['Resources'] = 'Ύλες';
$Definition['Reports']['None of your soldiers returned'] = 'Κανένας από τους στρατιώτες σου δεν επέστρεψε.';
$Definition['Reports']['None of your spies returned'] = 'Κανένας από τους ανιχνευτές σας δεν επέστρεψε.';
$Definition['Reports']['Ram does not work on alliance members'] = 'Ram does not work on alliance members.';
$Definition['Reports']['Cata is disabled'] = 'Catapult system is disabled.';
$Definition['Reports']['Cata does not work on alliance members'] = 'Catapult does not work on alliance members.';
$Definition['Reports']['NoFreeSlotsToCaptureOasis'] = 'Αναβαθμίστε την Περιοχή ηρώων για να κατακτήσετε την όαση';
$Definition['Reports']['OasisCaptured'] = 'Η όαση κατακτήθηκε από τον ήρωα..';
$Definition['Reports']['LoyaltyLowered'] = 'Η πίστη των κατοίκων έπεσε από <b>%d</b> σε <b>%d</b>';
$Definition['Reports']['Inbox - All reports older than seven days will be deleted'] = 'Όλες οι αναφορές που δεν έχουν αρχειοθετηθεί θα διαγραφούν μετά από 3 ώρες.'; //Inbox - All reports older than seven days will be deleted.
$Definition['Reports']['Management'] = 'Διαχείριση';
$Definition['Reports']['ManagementDesc'] = 'Εδώ μπορείτε να κάνετε διαχείριση των αναφορών σας.';
$Definition['Reports']['ManagementOptions'] = [
    1 => 'Νίκησε σαν επιτιθέμενος χωρίς απώλειες',
    2 => 'Νίκησε σαν επιτιθέμενος με απώλειες',
    3 => 'Έχασε σαν επιτιθέμενος',
    4 => 'Νίκησε σαν αμυνόμενος χωρίς απώλειες',
    5 => 'Νίκησε σαν αμυνόμενος με απώλειες',
    6 => 'Έχασε σαν αμυνόμενος με απώλειες',
    7 => 'Έχασε σαν αμυνόμενος χωρίς απώλειες',
    8 => 'Έφτασαν ενισχύσεις',
    9 => 'Ύλες',
    10 => 'Κατασκοπεία',
    11 => 'Περιπέτιες',
    12 => 'Όλες οι αναφορές',
];
$Definition['Reports']['startTime'] = [
    0 => 'Εκίνηση Server',
    600 => '10 λεπτά πριν',
    1800 => '30 λεπτά πριν',
    3600 => '1 ώρα πριν',
    7200 => '2 ώρες πριν',
    10800 => '3 ώρες πριν',
    21600 => '6 ώρες πριν',
    43200 => '12 ώρες πριν',
    86400 => '1 ημέρα πριν',
    172800 => '2 ημέρες πριν',
    604800 => '7 ημέρες πριν',
];

$Definition['Reports']['ManagementDeleteDesc'] = 'Διαγράψτε τις αναφορες %s από %s %s';
$Definition['Reports']['ButtonOK'] = 'Διαγραφή';
$Definition['Reports']['ReportsStatistics'] = 'Στατιστικά αναφορών';
$Definition['Reports']['%s report(s) removed successfully'] = '%s αναφορές διαγράφηκαν επιτυχώς.';
$Definition['Reports']['AllReportsCount'] = 'Αναφορές συνολικά';
$Definition['Reports']['ReportsWithoutCasualties'] = 'Επιθετικές αναφορές χωρίς απώλειες';
$Definition['Reports']['ReportsWithCasualties'] = 'Επιθετικές αναφορές με απώλειες';
$Definition['Reports']['ReportsDefWithoutCasualties'] = 'Αμυντικές αναφορές χωρίς απώλειες';
$Definition['Reports']['ReportsDefWithCasualties'] = 'Αμυντικές αναφορές με απώλειες';
$Definition['Reports']['ReportsOtherReports'] = 'Άλλες αναφορές';
//
$Definition['ResidencePalace']['Management'] = 'Διαχείριση';
$Definition['ResidencePalace']['Train'] = 'Εκπαίδευση';
$Definition['ResidencePalace']['CulturePoints'] = 'Πόντοι πολιτισμού';
$Definition['ResidencePalace']['Loyalty'] = 'Πίστη';
$Definition['ResidencePalace']['Expansion'] = 'Επέκταση';
$Definition['ResidencePalace']['This tab is set as favourite'] = 'Αυτή η καρτέλα έχει οριστεί ως αγαπημένη';
$Definition['ResidencePalace']['Select x as favor tab'] = 'Θέσε το %s στα αγαπημένα.';
$Definition['ResidencePalace']['Controllable villages'] = 'Ελεγχόμενα χωριά';
$Definition['ResidencePalace']['Number of your villages'] = 'Ο αριθμός των χωριών σας';
$Definition['ResidencePalace']['Maximum controllable villages'] = 'Μέγιστο ελεγχόμενων χωριών';
$Definition['ResidencePalace']['Culture points per day'] = 'Πόντοι πολιτισμού ανά ημέρα';
$Definition['ResidencePalace']['Culture points produced so far'] = 'ΠΠ που παράχθηκαν ήδη';
$Definition['ResidencePalace']['Next village controllable at'] = 'Επόμενο χωριό διαθέσιμο σε';
$Definition['ResidencePalace']['Culture points still needed'] = 'Αναγακαίοι πόντοι πολιτιμσού';
$Definition['ResidencePalace']['Active village'] = 'Ενεργό χωριό';
$Definition['ResidencePalace']['Other villages'] = 'Άλλα χωριά';
$Definition['ResidencePalace']['Hero'] = 'Ήρωας';
$Definition['ResidencePalace']['Total'] = 'Σύνολο';
$Definition['ResidencePalace']['loyaltyDesc'] = 'Σύνολο';
$Definition['ResidencePalace']['Coordinates'] = 'Συντεταγμένες';
$Definition['ResidencePalace']['noExpansion'] = 'Δεν βρέθηκαν χωριά.';
$Definition['ResidencePalace']['ChangeCapital'] = 'Κάνε αυτό το χωριό την πρωτεύουσα σου;';
$Definition['ResidencePalace']['Cant set ww as capital'] = 'Δεν μπορείτε να επιλέξετε ένα χωριό Παγκοσμίου Θαύματος για πρωτεύουσα σας.';
$Definition['ResidencePalace']['Password'] = 'Κωδικός';
$Definition['ResidencePalace']['wrongPass'] = 'Λάθος κωδικός.';
$Definition['ResidencePalace']['ConfirmChangeCapital'] = 'Είσαι σίγουρος;';
$Definition['ResidencePalace']['This is your capital'] = 'Το χωριό αυτό είναι η πρωτεύουσα σας.';
$Definition['ResidencePalace']['Date'] = 'Ημερομηνία';
$Definition['ResidencePalace']['In order to found or conquer further villages, you require culture points An additional village will predictably be controllable on x (±5 minutes)'] = 'Για να ιδρύσεις ή να κατακτήσεις περισσότερα χωριά, χρειάζεσαι πόντους πολιτισμού. Το επόμενο χωριό θα είναι πιθανόν διαθέσιμο στις %s (±5 λεπτά)';
$Definition['ResidencePalace']['The further the buildings of your villages are upgraded, the more culture points per day they will produce'] = 'Όσο υψηλότερο είναι το επίπεδο των κτηρίων σου, τόσο περισσότερους πόντους πολιτισμού θα παράγουν την ημέρα.';
$Definition['ResidencePalace']['Loyalty in the current village'] = 'Πίστη στο συγκεκριμένο χωριό';
$Definition['ResidencePalace']['Loyalty overview'] = 'Επισκόπηση πίστης';
$Definition['ResidencePalace']['village'] = 'Χωριό';
$Definition['ResidencePalace']['Inhabitants'] = 'Κάτοικοι';
$Definition['ResidencePalace']['Player(s)'] = 'Παίκτης';
$Definition['ResidencePalace']['A palace or residence protect a village from being conquered If the seat of government has been destroyed, a village`s loyalty can be lowered by attacks with chieftains, chiefs and senators If the loyalty is lowered to zero, the village will join the attacker`s empire An ongoing great celebration in the village of either attacker or defender will increase or lower the rate at which each attacking administrator will lower the loyalty Each level of the seat of government increases the speed at which the loyalty of a village increases to 100% again A hero stationed in the village can use tablets of law to additionally increase loyalty'] =
'Το παλάτι ή το μέγαρο προστατεύει ένα χωριό από την κατάκτηση. Αν καταστραφεί η έδρα της κυβέρνησης, η πίστη ενός χωριού μπορεί να μειωθεί από επιθέσεις με αρχηγούς, φύλαρχους και γερουσιαστές. Αν η πίστη μειωθεί στο μηδέν, το χωριό θα ενσωματωθεί στην αυτοκρατορία του επιτιθέμενου. 
Μια γιορτή σε εξέλιξη στο χωριό του επιτιθέμενου ή του αμυνόμενου θα αυξήσει ή μειώσει την τιμή με την οποία κάθε επιτιθέμενος αρχηγός θα μειώσει την πίστη.
Κάθε επίπεδο της έδρας της κυβέρνησης μειώνει αυξάνει την ταχύτητα με την οποία αυξάνει η πίστη έως το 100% και πάλι. 
Ένας ήρωας που έχει βάση του το χωριό, μπορεί να χρησιμοποιήσει πινάκια του νόμου για να αυξήσει την πίστη.';
//
$Definition['Smithy']['Improve weapons and armour'] = 'Βελτίωση όπλων και πανοπλοίας';
$Definition['Smithy']['one_research_is_going'] = 'Υπάρχει ήδη μια έρευνα που διεξάγεται.';
$Definition['Smithy']['reachedMaxLvl'] = '%s εντελώς βελτιωμένο.';
$Definition['Smithy']['improve'] = 'βελτίωση';
$Definition['Smithy']['Researching'] = 'Σε ανάπτυξη';
$Definition['Smithy']['unit'] = 'Μονάδα';
$Definition['Smithy']['upgradeSmithy'] = 'Σιδηρουργείο πολύ χαμηλό επίπεδο';
//
$Definition['Statistics']['Prizes for top 10'] = 'Prizes for top 10';
$Definition['Statistics']['Bonus name'] = 'Bonus name';
$Definition['Statistics']['No prize is declared for top10'] = 'No prize is declared for top10.';
$Definition['Statistics']['top10 prize distribution desc'] = 'The prizes for top10 will be given to player after the top10 was reset.';


$Definition['Statistics']['Average number of troops per player'] = 'Μέσος αριθμός στρατευμάτων ανά παίκτη';
$Definition['Statistics']['Game development'] = 'Ανάπτυξη παιχνιδιών';
$Definition['Statistics']['The following graphs show a time progression of economy, population, and the military strength of your army'] = 'Τα παρακάτω γραφήματα δείχνουν μια χρονική εξέλιξη της οικονομίας, του πληθυσμού και της στρατιωτικής δύναμης του στρατού σας.';
$Definition['Statistics']['Number of troops'] = 'Αριθμός στρατευμάτων';
$Definition['Statistics']['titleInHeader'] = 'Στατιστικά';
$Definition['Statistics']['edit'] = 'επεξεργασία';
$Definition['Statistics']['tabs'] = [];
$Definition['Statistics']['tabs']['players'] = 'Παίκτης';
$Definition['Statistics']['tabs']['alliances'] = 'Συμμαχία';
$Definition['Statistics']['tabs']['villages'] = 'Χωριό';
$Definition['Statistics']['tabs']['hero'] = 'Ήρωες';
$Definition['Statistics']['tabs']['plus'] = 'Plus';
$Definition['Statistics']['tabs']['General'] = 'Γενικά';
$Definition['Statistics']['tabs']['WonderOfTheWorld'] = 'Παγκόσμιο Θαύμα';
//$Definition['Statistics']['tabs']['WonderOfTheWorld'] = 'WonderOfTheWorld';
$Definition['Statistics']['tabs']['Bonus'] = 'Έπαθλα';
$Definition['Statistics']['tabs']['farm'] = 'Φάρμες';
$Definition['Statistics']['Actions'] = 'Ενέργειες';
$Definition['Statistics']['subTabs'] = [];
$Definition['Statistics']['subTabs']['overview'] = 'Επισκόπηση';
$Definition['Statistics']['subTabs']['attacker'] = 'Επιτιθέμενος';
$Definition['Statistics']['subTabs']['defender'] = 'Αμυνόμενος';
$Definition['Statistics']['subTabs']['Top 10'] = 'Top 10';
$Definition['Statistics']['player'] = 'Παίκτης';
$Definition['Statistics']['alliance'] = 'Συμμαχία';
$Definition['Statistics']['rank'] = 'Κατάταξη';
$Definition['Statistics']['name'] = 'όνομα';
$Definition['Statistics']['largestPlayers'] = 'Οι μεγαλύτεροι παίκτες';
$Definition['Statistics']['largestAlliances'] = 'Οι μεγαλύτερες συμμαχίες';
$Definition['Statistics']['largestVillages'] = 'Τα μεγαλύτερα χωριά';
$Definition['Statistics']['level'] = 'Επίπεδο';
$Definition['Statistics']['xp'] = 'Εμπειρία';
$Definition['Statistics']['most exp heros'] = 'Οι περισσότερο έμπυροι ήρωες';
$Definition['Statistics']['alliance'] = 'Συμμαχία';
$Definition['Statistics']['population'] = 'Πληθυσμός';
$Definition['Statistics']['village'] = 'Χωριό';
$Definition['Statistics']['points'] = 'Βαθμοί';
$Definition['Statistics']['coordinates'] = 'Συντεταγμένες';
$Definition['Statistics']['errors'] = [];
$Definition['Statistics']['errors']['userNotFound'] = 'Ο παίκτης %s δεν βρέθηκε.';
$Definition['Statistics']['errors']['allianceNotFound'] = 'Η συμμαχία %s δεν βρέθηκε.';
$Definition['Statistics']['errors']['villageNotFound'] = 'Τ χωριό %s δεν βρέθηκε.';
$Definition['Statistics']['top10'] = [];
$Definition['Statistics']['top10']['attackers of the week'] = 'Επιθετικοί της εβδομάδας';
$Definition['Statistics']['top10']['defenders of the week'] = 'Αμυντικοί της εβδομάδας';
$Definition['Statistics']['top10']['robbers of the week'] = 'Κλέφτες της εβδομάδας';
$Definition['Statistics']['top10']['climbers of the week'] = 'Μεγαλύτερη εβδομαδιαία πρόοδος';
$Definition['Statistics']['top10']['resources'] = 'Ύλες';
$Definition['Statistics']['top10']['ranks'] = 'Κατάταξη';
$Definition['Statistics']['top10']['pop'] = 'pop';
$Definition['Statistics']['top10']['points'] = 'Πόντοι';
$Definition['Statistics']['top10']['No'] = 'No';
$Definition['Statistics']['top10']['top off hammer'] = 'Μεγαλύτερο αμυντικό χάμερ';
$Definition['Statistics']['top10']['top def hammer'] = 'Μεγαλύτερο επιθετικό χάμερ';
$Definition['Statistics']['top10']['date'] = 'Ημερομηνία';
$Definition['Statistics']['General'] = [];
$Definition['Statistics']['General']['Country ranks'] = 'Κατάταξη χώρας';
$Definition['Statistics']['General']['Country name'] = 'Χώρα';
$Definition['Statistics']['General']['Players'] = 'Παίκτες';
$Definition['Statistics']['General']['Points'] = 'Πόντοι';
$Definition['Statistics']['General']['CountryFlag'] = 'CF';
$Definition['Statistics']['General']['Total country population'] = 'Πληθυσμός χώρας';
$Definition['Statistics']['General']['Tribe'] = 'Φυλή';
$Definition['Statistics']['General']['Tribes'] = 'Φυλές';
$Definition['Statistics']['General']['Romans'] = 'Ρωμαίοι';
$Definition['Statistics']['General']['Teutons'] = 'Τεύτονες';
$Definition['Statistics']['General']['Gauls'] = 'Γαλάτες';
$Definition['Statistics']['General']['Egyptians'] = 'Αιγύπτιοι';
$Definition['Statistics']['General']['Huns'] = 'Ούννοι';
$Definition['Statistics']['General']['Miscellaneous'] = 'Διάφορα';
$Definition['Statistics']['General']['Attacks'] = 'Επιθέσεις';
$Definition['Statistics']['General']['Casualties'] = 'Απώλειες';
$Definition['Statistics']['General']['Date'] = 'Ημερομηνία';
$Definition['Statistics']['General']['Registered'] = 'Εγγεγραμμένοι';
$Definition['Statistics']['General']['Percent'] = 'Ποσοστό';
$Definition['Statistics']['General']['Players'] = 'Παίκτες';
$Definition['Statistics']['General']['RegisteredPlayers'] = 'Εγγεγραμμένοι παίχτες';
$Definition['Statistics']['General']['ActivePlayers'] = 'Ενεργοί παίκτες';
$Definition['Statistics']['General']['onlinePlayers'] = 'Παίκτες online';
$Definition['Statistics']['General']['Attacks and casualties'] = 'Επιθέσεις & απώλειες';
$Definition['Statistics']['WonderOfTheWorld'] = [];
$Definition['Statistics']['WonderOfTheWorld']['player'] = 'Παίκτης';
$Definition['Statistics']['WonderOfTheWorld']['name'] = 'Όνομα';
$Definition['Statistics']['WonderOfTheWorld']['alliance'] = 'Συμμαχία';
$Definition['Statistics']['WonderOfTheWorld']['level'] = 'Επίπεδο';
$Definition['Statistics']['WonderOfTheWorld']['attackToWonder'] = '%s';
$Definition['Statistics']['Game development'] = 'Ανάπτυξη παιχνιδιών';
$Definition['Statistics']['The following graphs show a time progression of economy, population, and the military strength of your army'] = 'Τα παρακάτω γραφήματα δείχνουν μια χρονική εξέλιξη της οικονομίας, του πληθυσμού και της στρατιωτικής δύναμης του στρατού σας.';
$Definition['Statistics']['Number of troops'] = 'Αριθμός στρατευμάτων';
$Definition['Statistics']['total'] = 'σύνολο';
$Definition['Statistics']['reinforcements'] = 'ενισχύσεις';
$Definition['Statistics']['Resource production and population'] = 'Παραγωγή υλών και πληθυσμός';
$Definition['Statistics']['resources/4'] = 'ύλες/4';
$Definition['Statistics']['Inhabitants'] = 'Κάτοικοι';
$Definition['Statistics']['Rank'] = 'Κατάταξη';
$Definition['Statistics']['Number of troops killed'] = 'Αριθμός σκοτωμένων στρατευμάτων';
$Definition['Statistics']['attack'] = 'επίθεση';
$Definition['Statistics']['Winner and top player bonuses'] = 'Νικητές και μπόνους κορυφαίων παικτών';
$Definition['Statistics']['Winner Player'] = 'Νικητής';
$Definition['Statistics']['Second Winner Player'] = '2ος παίκτης ';
$Definition['Statistics']['Third Winner Player'] = '3ος παίκτης';
$Definition['Statistics']['Bonus rules'] = 'Κανόνες μπόνους';
$Definition['Statistics']['bonus_rules_array'] = [
    'Δεν θα δώσουμε βραβεία σε παίκτες πολλαπλών λογαριασμών.',
    'Αν υπάρχει βραβείο για τον 2ο νικητή και τον 3ο νικητή, το επίπεδο των θαυμάτων πρέπει να είναι 50+ για να κερδίσει το βραβείο.',
    sprintf('Το βραβείο της Συμμαχίας είναι για τα κορυφαία %s μέλη της(εκτός από τον νικητή) ότι ο πληθυσμός τους είναι πάνω %s.', Config::getProperty("bonus", "bonusGoldTopAllianceCount"), Config::getProperty("bonus", "bonusGoldTopAllianceMinPop")),
    'Μερικοί σέρβερς ενδέχεται να έχουν χρηματικά έπαθλα, θα σας ειδοποιήσουμε σε αυτή την περίπτωση.',
    'Μετά την ολοκλήρωση του σέρβερ, τα βραβεία θα αποστέλονται σε μορφή κουπονιών με (email).',];
$Definition['Statistics']['Winner Alliance (Top 5)'] = 'Νικήτρια Συμμαχία (Top 5)';
$Definition['Statistics']['Top attacker'] = '1ος επιθετικός';
$Definition['Statistics']['Top defender'] = '1ος αμυντικός';
$Definition['Statistics']['Top climber'] = '1ος σε πρόοδο';
$Definition['Statistics']['Server states'] = 'Κατάσταση σέρβερ';
$Definition['Statistics']['Daily gold will be given in'] = 'Ο καθημερινός χρυσός θα δοθεί σε';
$Definition['Statistics']['Daily quest will reset in'] = 'Οι καθημερινές εργασίες θα μηδενιστούν σε';
$Definition['Statistics']['Medals will be given in'] = 'Τα επόμενα μετάλλια θα δοθούν σε';
$Definition['Statistics']['Artifacts will be released in'] = 'Τα πολύτιμα αντικείμενα θα εμφανιστούν σε';
$Definition['Statistics']['WWPlans will be released in'] = 'Χρόνος για τα σχέδια κατασκευής ΠΘ';
$Definition['Statistics']['You can build WW in'] = 'Μπορείτε να χτίσετε το ΠΘ στο';
$Definition['Statistics']['Game will be finished in'] = 'Το παιχνίδι θα ολοκληρωθεί σε';
$Definition['Statistics']['hours'] = 'ώρες';
$Definition['Statistics']['Top Off hammer'] = 'Κορυφαίος επιθετικός στρατός';
$Definition['Statistics']['Top Def hammer'] = 'Κορυφαίος αμυντικός στρατός';
$Definition['Statistics']['raid'] = 'επιδρομή';
$Definition['Statistics']['Other prises'] = 'Άλλα βραβεία';
//
$Definition['Treasury']['ArtifactIsDisabled'] = 'Artifact disabled.';
$Definition['Treasury']['This tab is set as favourite'] = 'Αυτή η καρτέλα έχει οριστεί ως αγαπημένη';
$Definition['Treasury']['Management'] = 'Διαχείριση';
$Definition['Treasury']['Artefacts in your area'] = 'ΠΑ στην περιοχή σου';
$Definition['Treasury']['Small artefacts'] = 'Μικρά ΠΑ';
$Definition['Treasury']['Large artefacts'] = 'Μεγάλα ΠΑ';
$Definition['Treasury']['select tab x as favor tab'] = 'Θέσε το %s στα αγαπημένα.';
$Definition['Treasury']['Stored artefact'] = 'Αποθηκευμένο αντικείμενο';
$Definition['Treasury']['Name'] = 'Όνομα';
$Definition['Treasury']['Village'] = 'Χωριό';
$Definition['Treasury']['conquered'] = 'Κατακτημένο';
$Definition['Treasury']['Former owner'] = 'Προηγούμενος ιδιοκτήτης';
$Definition['Treasury']['you dont own any artefacts'] = 'Δεν έχει κατακτηθεί κανένα πολύτιμο αντικείμενο.';
$Definition['Treasury']['Effect'] = 'Επιρροή';
$Definition['Treasury']['Village'] = 'Χωριό';
$Definition['Treasury']['Account'] = 'Λογαριασμός';
$Definition['Treasury']['Player'] = 'Παίκτης';
$Definition['Treasury']['Area of effect'] = 'Σφαίρα επιρροής';
$Definition['Treasury']['Bonus'] = 'Μπόνους';
$Definition['Treasury']['Required level'] = 'Απαιτούμενο επίπεδο';
$Definition['Treasury']['Time of conquer'] = 'Ώρα κατάκτησης';
$Definition['Treasury']['Active'] = 'ενεργό';
$Definition['Treasury']['Time of activation'] = 'Στιγμή ενεργοποίησης';
$Definition['Treasury']['Alliance'] = 'Συμμαχία';
$Definition['Treasury']['Distance'] = 'Απόσταση';
$Definition['Treasury']['Owner'] = 'Ιδιοκτήτης';
$Definition['Treasury']['No Artefact'] = 'Τα πολύτιμα αντικείμενα δεν εμφανίστηκαν ακόμα.';
//
$Definition['Troops']['hero']['title'] = 'Ήρωας';
$Definition['Troops'][1]['title'] = 'Λεγεωνάριος';
$Definition['Troops'][1]['desc'] = 'Ο λεγεωνάριος είναι ένα απλό και γενικής χρήσης στράτευμα πεζικού της Ρωμαϊκής Αυτοκρατορίας. Με την γενική του εκπαίδευση είναι το ίδιο καλός τόσο σε άμυνα όσο και σε επίθεση. Παρόλα αυτά ο Λεγεωνάριος δεν θα φτάσει ποτέ το επίπεδο πιο εξειδικευμένων στρατευμάτων.';
$Definition['Troops'][2]['title'] = 'Πραιτωριανός';
$Definition['Troops'][2]['desc'] = 'Οι Πραιτοριανοί είναι η φρουρά του Αυτοκράτορα και τον υπερασπίζονται με την ζωή τους. Μιας και είναι εξειδικευμένοι στην άμυνα, η επίθεσή τους είναι πολύ αδύναμη.';
$Definition['Troops'][3]['title'] = 'Ιμπεριανός';
$Definition['Troops'][3]['desc'] = 'Οι Ιμπεριανοί είναι η τέλεια επιθετική μονάδα των ρωμαϊκών στρατευμάτων. Είναι γρήγοροι και ισχυροί στην επίθεση και ο εφιάλτης όλων των εν αμύνη στρατευμάτων, αλλά η εκπαίδευσή τους είναι μακρόχρονη και δαπανηρή.';
$Definition['Troops'][4]['title'] = 'Equites Legati';
$Definition['Troops'][4]['desc'] = 'Οι Equites Legati είναι τα ρωμαϊκά στρατεύματα αναγνώρισης. Είναι αρκετά γρήγοροι και μπορούν να κατασκοπεύσουν τα εχθρικά χωριά για να δουν ύλες και στρατεύματα. .
<br><br>
Αν δεν υπάρχουν ανιχνευτές ή Equites Legati στο χωριό που κατασκοπεύεται, η ανίχνευση παραμένει αόρατη.';
$Definition['Troops'][5]['title'] = 'Equites Imperatoris';
$Definition['Troops'][5]['desc'] = 'Οι Equites Imperatoris είναι το βασικό ιππικό του Ρωμαϊκού στρατού και είναι πολύ καλά οπλισμένοι. Δεν είναι τα πιο γρήγορα στρατεύματα αλλά είναι ο τρόμος του εχθρού. Πρέπει όμως να έχεις πάντα κατά νου ότι να ταΐζεις το άλογο και τον αναβάτη δεν είναι πάντα φτηνό.';
$Definition['Troops'][6]['title'] = 'Equites Caesaris';
$Definition['Troops'][6]['desc'] = 'Οι Equites Caesaris είναι το βαρύ ιππικό της Ρώμης. Έχουν πολύ καλή πανοπλία και μπορούν να προκαλέσουν μεγάλη ζημιά, αλλά όλα αυτά τα όπλα και την πανοπλία έχουν το τἰμημἀ τους. Είναι αργοί, μεταφέρουν λιγότερες πρώτες ύλες και η διατροφή τους είναι πιο ακριβή.';
$Definition['Troops'][7]['title'] = 'Πολιορκητικός κριός';
$Definition['Troops'][7]['desc'] = 'Ο πολιορκητικός κριός είναι ένα βαρύ όπλο υποστήριξης για το πεζικό και το ιππικό σου. Ο στόχος του είναι να καταστρέψει τα εχθρικά τείχη και, με αυτόν τον τρόπο, να αυξήσει τις πιθανότητες των στρατευμάτων σου να υπερνικήσουν τις οχυρώσεις του εχθρού.';
$Definition['Troops'][8]['title'] = 'Καταπέλτης φωτιάς';
$Definition['Troops'][8]['desc'] = 'Ο καταπέλτης είναι ένα εξαιρετικό όπλο μεγάλης απόστασης. Χρησιμοποιείται για την καταστροφή των πεδίων και των κτηρίων του εχθρικού χωριού. Παρόλα αυτά, αν δεν έχει συνοδεία άλλων στρατευμάτων, είναι ακίνδυνος, γι αυτό μην ξεχνάτε να στείλετε και μερικά στρατεύματα μαζί.
<br><br>
Έχοντας μια Πλατεία συγκεντρώσεως σε υψηλό επίπεδο κάνει τους καταπέλτες σας να χτυπούν με μεγαλύτερη ακρίβεια τα εχθρικά χωριά. Περισσότερες πληροφορίες <a href="' . getAnswersUrl() . '?view=answers&amp;action=answer&amp;aid=157#go2answer" target="blank">εδώ</a>.
<br>
ΣΗΜΕΙΩΣΗ: Οι καταπέλτες ΜΠΟΡΟΥΝ να χτυπήσουν κρυψώνες, τοποθέτη παγίδων και λιθοδόμο όταν χτυπούν τυχαία.';
$Definition['Troops'][9]['title'] = 'Γερουσιαστής';
$Definition['Troops'][9]['desc'] = 'Ο Γερουσιαστής είναι ο εκλεγμένος αρχηγός της φυλής. Είναι καλός ρήτορας και ξέρει πως να πείσει τους άλλους. Μπορεί να πείσει άλλα χωριά να πολεμάνε για την αυτοκρατορία του.
<br><br>
Κάθε φορά που ένας Γερουσιαστής μιλά στους κατοίκους ενός χωριού, η τιμή της πίστης του εχθρού μειώνεται μέχρι το χωριό να γίνει δικό σας.
Προϋποθέσεις.';
$Definition['Troops'][10]['title'] = 'Άποικος';
$Definition['Troops'][10]['desc'] = 'Οι άποικοι είναι γενναίοι και θαρραλέοι πολίτες που φεύγουν από το χωριό μετά από μακρά εκπαίδευση για να ιδρύσουν ένα νέο χωριό προς τιμήν σας.
<br><br>
Καθώς το ταξίδι και η ίδρυση του νέου χωριού είναι πολύ δύσκολα, τρεις άποικοι είναι ορκισμένοι να πάνε μαζί. Χρειάζονται μια βάση 750 μονάδων ανά ύλη.';
$Definition['Troops'][11]['title'] = 'Μαχητής με ρόπαλο';
$Definition['Troops'][11]['desc'] = 'Ένας μαχητής με ρόπαλο είναι η φτηνότερη μονάδα σε όλο το Travian. Εκπαιδεύεται γρήγορα, αλλά έχει μόνο μια μέση ικανότητα επίθεσης και η πανοπλία του δεν είναι σίγουρα η καλύτερη. Ειδικά ενάντια στο ιππικό είναι τελείως ανυπεράσπιστος και θα σκοτωθεί με ευκολία.';
$Definition['Troops'][12]['title'] = 'Μαχητής με ακόντιο';
$Definition['Troops'][12]['desc'] = 'Στον στρατό των Τευτόνων, η δουλειά ενός Μαχητή με ακόντιο είναι η άμυνα. Είναι ιδιαίτερα καλός ενάντια ιππικού χάρη στο μήκος του όπλου του. Παρόλα αυτά, αποφύγετε να τον χρησιμοποιείτε σε επιθέσεις, γιατί η επιθετικές του ικανότητες είναι πολύ χαμηλές.';
$Definition['Troops'][13]['title'] = 'Μαχητής με τσεκούρι';
$Definition['Troops'][13]['desc'] = 'Αυτό είναι η ισχυρότερη μονάδα πεζικού από τους Τεύτονες. Έχοντας μια καλή δύναμη στην επίθεση και μεσαία άμυνα είναι λίγο πιο αργοί και ακριβότεροι από άλλες μονάδες.';
$Definition['Troops'][14]['title'] = 'Ανιχνευτής';
$Definition['Troops'][14]['desc'] = 'Ο Ανιχνευτής κινείται μπροστά από τα Τευτονικά στρατεύματα για να λάβει πληροφορίες για τον στρατό και τα κτήρια του εχθρού. Κινείτε με τα πόδια και αυτό τον κάνει πιο αργό από τους Ρωμαίους ή Γαλάτες ομολόγους του. Ανιχνεύει τις εχθρικές μονάδες, ύλες και οχυρώσεις. 
<br><br>
 Αν δεν υπάρχουν Ανιχνευτές ή Equites Legati στο χωριό που κατασκοπεύεται, η ανίχνευση θα παραμείνει αόρατη.';
$Definition['Troops'][15]['title'] = 'Παλατινός';
$Definition['Troops'][15]['desc'] = 'Καθώς είναι εξοπλισμένοι με βαριά πανοπλία, οι Παλατινοί είναι εξαιρετική αμυντική μονάδα. Το πεζικό δεν θα μπορέσει να τους διαπεράσει εύκολα.
<br><br>
Δυστυχώς, οι επιθετικές τους δυνατότητες είναι μάλλον χαμηλές και η ταχύτητά τους, σε σχέση με άλλες μονάδες ιππικού, είναι κάτω από τον μέσο όρο. Η εκπαίδευσή τους διαρκεί πολύ και είναι μάλλον ακριβή.';
$Definition['Troops'][16]['title'] = 'Τεύτονας ιππότης';
$Definition['Troops'][16]['desc'] = 'Ο Τεύτονας ιππότης είναι ένας ισχυρός πολεμιστής ο οποίος στην επίθεση σπέρνει στους αντίπαλους του τον τρόμο. Στην άμυνα είναι ένας καλός αγωνιστής ενάντια στο εχθρικό ιππικά. Οι δαπάνες για εκπαίδευση και συντήρηση είναι όμως υψηλές.';
$Definition['Troops'][17]['title'] = 'Πολιορκητικός κριός';
$Definition['Troops'][17]['desc'] = 'Ο πολιορκητικός κριός είναι ένα βαρύ όπλο υποστήριξης για το πεζικό και το ιππικό σου. Ο στόχος του είναι να καταστρέψει τους εχθρικούς τοίχους και, με αυτόν τον τρόπο, να αυξήσει τις πιθανότητες των στρατευμάτων σου να υπερνικήσουν τις οχυρώσεις του εχθρού.';
$Definition['Troops'][18]['title'] = 'Καταπέλτης';
$Definition['Troops'][18]['desc'] = 'Ο καταπέλτης είναι ένα εξαιρετικό όπλο μεγάλης απόστασης. Χρησιμοποιείται για την καταστροφή των πεδίων και των κτηρίων του εχθρικού χωριού. Παρόλα αυτά, αν δεν έχει συνοδεία άλλων στρατευμάτων, είναι ακίνδυνος, γι αυτό μη ξεχνάτε να στείλετε και μερικά στρατεύματα μαζί.

<br><br>
Έχοντας μια Πλατεία συγκεντρώσεως σε υψηλό επίπεδο κάνει τους καταπέλτες σας να χτυπούν με μεγαλύτερη ακρίβεια τα εχθρικά χωριά. Περισσότερες πληροφορίες <a href="' . getAnswersUrl() . '?view=answers&amp;action=answer&amp;aid=157#go2answer" target="blank">εδώ</a>.
<br>
ΣΗΜΕΙΩΣΗ: Οι καταπέλτες ΜΠΟΡΟΥΝ να χτυπήσουν κρυψώνες, τοποθέτη παγίδων και λιθοδόμο όταν χτυπούν τυχαία.';
$Definition['Troops'][19]['title'] = 'Φύλαρχος';
$Definition['Troops'][19]['desc'] = 'Ανάμεσα στους καλύτερους, οι Τεύτονες επιλέγουν τον φύλαρχο τους. Για να επιλεχθεί, ανδρεία και στρατηγική δεν είναι αρκετά, πρέπει να είναι και ένας δεινός ομιλητής καθώς είναι ο κύριος σκοπός ενός φύλαρχου να πείσει τον πληθυσμό ξένων χωριών να ακολουθήσουν την φυλή του Φύλαρχου. 
<br><br>
Όσο συχνότερα μιλάει ο Φύλαρχος στον πληθυσμό ενός χωριού, τόσο μειώνεται η πίστη μέχρι να ενταχθεί στην φυλή του φύλαρχου.';
$Definition['Troops'][20]['title'] = 'Άποικος';
$Definition['Troops'][20]['desc'] = 'Οι άποικοι είναι γενναίοι και θαρραλέοι πολίτες που φεύγουν από το χωριό μετά από μακρά εκπαίδευση για να ιδρύσουν ένα νέο χωριό προς τιμήν σας. 
<br><br>
Καθώς το ταξίδι και η ίδρυση του νέου χωριού είναι πολύ δύσκολα, τρεις άποικοι είναι ορκισμένοι να πάνε μαζί. Χρειάζονται μια βάση 750 μονάδων ανά ύλη.';
$Definition['Troops'][21]['title'] = 'Φάλαγγα';
$Definition['Troops'][21]['desc'] = 'Από την στιγμή που είναι πεζικό, οι Φάλαγγες είναι φθηνές και παράγονται γρήγορα.
<br><br>
Αν και επιθετική τους δύναμη είναι χαμηλή, είναι αρκετά δυνατές στην άμυνα εναντίον πεζικού και ιππικού.';
$Definition['Troops'][22]['title'] = 'Μαχητής με ξίφος';
$Definition['Troops'][22]['desc'] = 'Οι Μαχητές με ξίφος είναι ακριβότεροι από τις Φάλαγγες αλλά είναι μια επιθετική μονάδα.
<br><br>
Είναι αρκετά αδύναμοι στην άμυνα, ειδικά ενάντια στο ιππικό.';
$Definition['Troops'][23]['title'] = 'Ανιχνευτής';
$Definition['Troops'][23]['desc'] = 'Ο ανιχνευτής είναι η μονάδα αναγνώρισης των Γαλατών. Είναι πολύ γρήγορα και προσεκτικά προωθούνται στις εχθρικές δυνάμεις για να κατασκοπεύσουν κτήρια, μονάδες ή πρώτες ύλες.
<br><br>
Εάν δεν υπάρχει οποιοδήποτε Equites Legati ή ανιχνευτής στο αντίπαλο χωριό, η ανίχνευση παραμένει απαρατήρητη.';
$Definition['Troops'][24]['title'] = 'Αστραπή του Τουτατή';
$Definition['Troops'][24]['desc'] = 'Οι Αστραπές του Τουτατή είναι μια πολύ γρήγορη και δυνατή μονάδα ιππικού. Μπορούν να μεταφέρουν μεγάλες ποσότητες υλών και είναι εξαιρετικοί επιδρομείς.
<br><br>
Σχετικά με την άμυνα, οι δυνατότητές τους είναι μεσαίες.';
$Definition['Troops'][25]['title'] = 'Δρουίδης';
$Definition['Troops'][25]['desc'] = 'Αυτή η μεσαία μονάδα ιππικού είναι εξαιρετική στην άμυνα. Ο κύριος σκοπός του Δρουίδη είναι η άμυνα ενάντια στο εχθρικό πεζικό. Το κόστος εκπαίδευσης και η τροφοδοσία του είναι σχετικά ακριβές.';
$Definition['Troops'][26]['title'] = 'Ιδουανός';
$Definition['Troops'][26]['desc'] = 'Οι Ιδουανοί είναι το απόλυτο όπλο των Γαλατών για επίθεση και άμυνα εναντίον ιππικού. Λίγες μονάδες μπορούν να συγκριθούν με τις δυνάμεις τους.
<br><br>
Παρόλα αυτά, η εκπαίδευση και ο εξοπλισμός τους είναι πολύ ακριβά. Τρώνε 3 μονάδες σιταριού την ώρα, γι αυτό θα πρέπει να σκεφτείτε προσεκτικά αν αξίζουν την προσπάθεια και τα έξοδα.';
$Definition['Troops'][27]['title'] = 'Πολιορκητικός κριός';
$Definition['Troops'][27]['desc'] = 'Ο πολιορκητικός κριός είναι ένα βαρύ όπλο υποστήριξης για το πεζικό και το ιππικό σου. Ο στόχος του είναι να καταστρέψει τους εχθρικούς τοίχους και, με αυτόν τον τρόπο, να αυξήσει τις πιθανότητες των στρατευμάτων σου να υπερνικήσουν τις οχυρώσεις του εχθρού.';
$Definition['Troops'][28]['title'] = 'Πολεμικός καταπέλτης';
$Definition['Troops'][28]['desc'] = 'Ο πολεμικός καταπέλτης είναι ένα εξαιρετικό όπλο μεγάλης απόστασης. Χρησιμοποιείτε για να καταστρέψει πεδία και κτήρια εχθρικών χωριών. Ωστόσο χωρίς συνοδεία στρατού είναι σχεδόν χωρίς άμυνα, οπότε μην ξεχνάτε να στείλετε μερικά από τα στρατεύματά σας μαζί.
<br><br>
Ένα υψηλό επίπεδο πλατείας συγκεντρώσεως κάνει τους καταπέλτες σας περισσότερο ακριβείς και σας δίνει την ευκαιρία να χτυπήσετε περισσότερα εχθρικά κτήρια. Περισσότερες πληροφορίες είναι διαθέσιμες <a href="' . getAnswersUrl() . '?view=answers&amp;action=answer&amp;aid=157#go2answer" target="blank">εδώ</a>.
<br>
ΣΗΜΕΙΩΣΗ: Οι καταπέλτες ΜΠΟΡΟΥΝ να χτυπήσουν κρυψώνες, τοποθέτη παγίδων ή λιθοδόμο όταν στοχεύουν τυχαία.';
$Definition['Troops'][29]['title'] = 'Αρχηγός';
$Definition['Troops'][29]['desc'] = 'Κάθε φυλή έχει έναν αρχαίο και έμπειρο πολεμιστή του οποίου η παρουσία και οι λόγοι είναι δυνατόν να πείσουν τον πληθυσμό ενός εχθρικού χωριού να έρθουν στην φυλή του.
<br><br>
Όσο συχνότερα μιλάει ο Αρχηγός στον πληθυσμό ενός χωριού, τόσο μειώνεται η πίστη μέχρι να ενταχθεί στην φυλή του αρχηγού.';
$Definition['Troops'][30]['title'] = 'Άποικος';
$Definition['Troops'][30]['desc'] = 'Οι άποικοι είναι γενναίοι και θαρραλέοι πολίτες που φεύγουν από το χωριό μετά από μακρά εκπαίδευση για να ιδρύσουν ένα νέο χωριό προς τιμήν σας.
<br><br>
Καθώς το ταξίδι και η ίδρυση του νέου χωριού είναι πολύ δύσκολα, τρεις άποικοι είναι ορκισμένοι να πάνε μαζί. Χρειάζονται μια βάση 750 μονάδων ανά ύλη.';
$Definition['Troops'][31]['title'] = 'Αρουραίοι';
$Definition['Troops'][32]['title'] = 'Αράχνες';
$Definition['Troops'][33]['title'] = 'Φίδια';
$Definition['Troops'][34]['title'] = 'Νυχτερίδες';
$Definition['Troops'][35]['title'] = 'Αγριογούρουνα';
$Definition['Troops'][36]['title'] = 'Λύκοι';
$Definition['Troops'][37]['title'] = 'Αρκούδες';
$Definition['Troops'][38]['title'] = 'Κροκόδειλοι';
$Definition['Troops'][39]['title'] = 'Τίγρης';
$Definition['Troops'][40]['title'] = 'Ελέφαντες';
$Definition['Troops'][41]['title'] = 'Δορατοφόροι';
$Definition['Troops'][42]['title'] = 'Ακανθωτόι πολεμιστές';
$Definition['Troops'][43]['title'] = 'Φύλακες';
$Definition['Troops'][44]['title'] = 'Γεράκια';
$Definition['Troops'][45]['title'] = 'Ιππείς με τσεκούρι';
$Definition['Troops'][46]['title'] = 'Νατάριοι ιππότες';
$Definition['Troops'][47]['title'] = 'Πολεμικοί Ελέφαντες';
$Definition['Troops'][48]['title'] = 'Βαλλίστρες';
$Definition['Troops'][49]['title'] = 'Νατάριοι Αυτοκράτορες';
$Definition['Troops'][50]['title'] = 'Άποικοι';
$Definition['Troops'][51]['title'] = 'Πολιτοφυλακή σκλάβων';
$Definition['Troops'][51]['desc'] = 'Η Πολιτοφυλακή σκλάβων είναι η φτηνότερη μονάδα με τον μικρότερο χρόνο δημιουργίας στο παιχνίδι. Αν και αυτό σάς επιτρέπει να στρατολογείτε μια αμυντική δύναμη σε πολύ λίγο χρόνο, η ισχύς τους στη μάχη είναι μικρή σε σχέση με άλλα αμυντικά στρατεύματα.';
$Definition['Troops'][52]['title'] = 'Φύλακας της τέφρας';
$Definition['Troops'][52]['desc'] = 'Ο Φύλακας της τέφρας είναι ο τυπικός πεζικάριος σε αμυντικό ρόλο, με αξιόπιστη μαχητική ισχύ. Τα πάει ιδιαιτέρως καλά απέναντι σε άλλες μονάδες πεζικού, αλλά ακόμα και απέναντι σε ιππικό, δεν θα πρέπει να υποτιμάται.';
$Definition['Troops'][53]['title'] = 'Πολεμιστής με Κοπίδα';
$Definition['Troops'][53]['desc'] = 'O Πολεμιστής με Κοπίδα είναι επίλεκτος στρατιώτης, που χαρακτηρίζεται για τη δεινότητά του τόσο στην επίθεση όσο και στην άμυνα απέναντι σε άλλους πεζούς πολεμιστές.';
$Definition['Troops'][54]['title'] = 'Εξερευνητής Sopdu';
$Definition['Troops'][54]['desc'] = 'Ο Εξερευνητής Sopdu καλπάζει προς άγνωστες περιοχές για να τις εξερευνήσει και να συλλέξει πληροφορίες για τις δυνάμεις του εχθρού. Μπορεί, επίσης, να κατοπτεύσει αποτελεσματικά τα χωριά του εχθρού και να εντοπίσει τυχόν αδυναμίες στην άμυνά τους.';
$Definition['Troops'][55]['title'] = 'Φύλακας Anhur';
$Definition['Troops'][55]['desc'] = 'Ο Φύλακας Anhor είναι ένας έφιππος πολεμιστής σε αμυντικό ρόλο που μπορεί να υπερισχύσει έναντι οποιουδήποτε επιτιθέμενου πεζικού. Πέρα από τη μέσης ισχύος ικανότητα σε επίθεση και άμυνα απέναντι σε ιππικό, πρόκειται για την ισχυρότερη μονάδα των Αιγυπτίων μετά τον Εξερευνητή Sopdu.';
$Definition['Troops'][56]['title'] = 'Άρμα Resheph';
$Definition['Troops'][56]['desc'] = 'Το Άρμα Resheph είναι αξιόμαχο σε κάθε είδος πολεμικής αναμέτρησης. Διαθέτει μεγάλη ισχύ κρούσης σε επιθετικό ρόλο, αλλά και αξιόπιστη ισχύ ανάσχεσης απέναντι σε πεζικό, αν και σε αμυντικό ρόλο διακρίνεται πρωτίστως απέναντι σε ιππικό. Το μειονέκτημά του είναι το μεγάλο κόστος εκπαίδευσης, συν το ότι καταναλώνουν μεγάλη ποσότητα από τη συγκομιδή σας.';
$Definition['Troops'][57]['title'] = 'Κριός';
$Definition['Troops'][57]['desc'] = 'Ο πολιορκητικός Κριός είναι ένα βαρύ όπλο σε ρόλο υποστήριξης για το πεζικό και το ιππικό σας. Έργο του είναι η καταστροφή των τειχών του εχθρού, συμβάλλοντας έτσι στις προσπάθειες των στρατευμάτων σας να καταβάλουν τις εχθρικές οχυρώσεις.';
$Definition['Troops'][58]['title'] = 'Καταπέλτης λίθων';
$Definition['Troops'][58]['desc'] = 'Ο Καταπέλτης λίθων αποτελεί ένα εξαιρετικό όπλο μεγάλου βεληνεκούς. Χρησιμοποιείται για την καταστροφή των χωραφιών και των κτιρίων των χωριών του εχθρού. Ωστόσο, χωρίς στρατεύματα συνοδείας, είναι πρακτικά απροστάτευτος, οπότε μην αμελήσετε να τον υποστηρίξετε με μερικούς από τους στρατιώτες σας. 
<br><br>
Ένα υψηλό επίπεδο πλατείας συγκεντρώσεως κάνει τους καταπέλτες σας περισσότερο ακριβείς και σας δίνει την ευκαιρία να χτυπήσετε περισσότερα εχθρικά κτήρια. Περισσότερες πληροφορίες είναι διαθέσιμες <a href="' . getAnswersUrl() . '?view=answers&amp;action=answer&amp;aid=157#go2answer" target="blank">εδώ</a>.
<br>
ΣΗΜΕΙΩΣΗ: Οι καταπέλτες ΜΠΟΡΟΥΝ να χτυπήσουν κρυψώνες, τοποθέτη παγίδων ή λιθοδόμο όταν στοχεύουν τυχαία.';
$Definition['Troops'][59]['title'] = 'Νομάρχης';
$Definition['Troops'][59]['desc'] = 'Ο Νομάρχης είναι ο διοικητικός επικεφαλής των Αιγυπτίων. Διαπραγματεύονται όρους παράδοσης και, χάρη στο χάρισμά τους, μπορούν να κερδίσουν την αφοσίωση ακόμα και εχθρικών λαών, ώστε να ενταχθούν στην αυτοκρατορία σας. 
<br/>
Με κάθε επίσκεψη του Νομάρχη, η αφοσίωση του πληθυσμού στην επικράτεια του εχθρού φθίνει, έως ότου γίνει ανύπαρκτη και οι ντόπιοι εκεί αποδεχτούν τη δική σας επικυριαρχία.';
$Definition['Troops'][60]['title'] = 'Έποικος';
$Definition['Troops'][60]['desc'] = 'Οι έποικοι είναι γενναίοι και τολμηροί πολίτες που, μετά από πολλή εκπαίδευση, αφήνουν το χωριό, για να ιδρύσουν ένα νέο χωριό προς τιμήν σου. 
<br/>
Τόσο το ταξίδι όσο και η ίδρυση ενός νέου χωριού είναι δύσκολο εγχείρημα, οπότε τουλάχιστον τρεις έποικοι πρέπει να είναι μαζί. Χρειάζονται βασικές προμήθειες 750 μονάδων ανά είδος πόρου.';
$Definition['Troops'][61]['title'] = 'Μισθοφόρος';
$Definition['Troops'][61]['desc'] = 'Ο Μισθοφόρος είναι ο μαχητής για όλες τις δουλειές. Τόσο στην επίθεση όσο και στην άμυνα, οι μισθοφόροι μπορούν να σταθούν επάξια απέναντι σε άλλες μονάδες, χωρίς ωστόσο να διακρίνονται ιδιαίτερα σε καμία μορφή μάχης. Ωστόσο, οι μέτριες ικανότητές τους αντανακλώνται στο μέτριο κόστος εκπαίδευσής τους.';
$Definition['Troops'][62]['title'] = 'Τοξότης';
$Definition['Troops'][62]['desc'] = 'Ο Τοξότης είναι η πρώτη σας επιλογή όταν πρόκειται για επιθέσεις μεγάλης έκτασης. Δεδομένης της αδυναμίας τους στην άμυνα, είναι ευτύχημα το ότι στους τοξότες αρέσει να πολεμούν στην πρώτη γραμμή.';
$Definition['Troops'][63]['title'] = 'Ανιχνευτής';
$Definition['Troops'][63]['desc'] = 'Ο Ανιχνευτής είναι ταχύτατος στον εντοπισμό και την ανίχνευση των στρατιωτικών και οικονομικών μυστικών των χωριών του εχθρού, τα οποία και σας μεταφέρει.';
$Definition['Troops'][64]['title'] = 'Καβαλάρης της Στέπας';
$Definition['Troops'][64]['desc'] = 'Ο Καβαλάρης της Στέπας είναι εξαιρετικός στην επίθεση και εκπαιδεύεται πολύ ταχύτερα από άλλους έφιππους πολεμιστές. Ως αποτέλεσμα, ωστόσο, είναι πολύ αδύναμος στην άμυνα.';
$Definition['Troops'][65]['title'] = 'Επίλεκτος τοξότης';
$Definition['Troops'][65]['desc'] = 'O Επίλεκτος τοξότης αποτελεί μια συνολικά καλή επιλογή μονάδας ιππικού. Η αξιόπιστη ισχύς του σε επιθετικό ρόλο επισκιάζεται από το γεγονός ότι είναι η μοναδική μονάδα των Ούννων που διαθέτει μια κάποια επιδεξιότητα στην άμυνα.';
$Definition['Troops'][66]['title'] = 'Επιδρομέας';
$Definition['Troops'][66]['desc'] = 'Ο Επιδρομέας είναι μια απόλυτη φονική μηχανή. Με απίστευτη επιθετική ισχύ, καθώς κι εντυπωσιακή ταχύτητα, μπορεί να καταβάλει τις περισσότερες αμυντικές γραμμές του αντιπάλου χωρίς μια αμυχή στην πανοπλία του.';
$Definition['Troops'][67]['title'] = 'Κριός';
$Definition['Troops'][67]['desc'] = 'Ο πολιορκητικός Κριός είναι ένα βαρύ όπλο σε ρόλο υποστήριξης για το πεζικό και το ιππικό σας. Έργο του είναι η καταστροφή των τειχών του εχθρού, συμβάλλοντας έτσι στις προσπάθειες των στρατευμάτων σας να καταβάλουν τις εχθρικές οχυρώσεις.';
$Definition['Troops'][68]['title'] = 'Καταπέλτης';
$Definition['Troops'][68]['desc'] = 'Ο Καταπέλτης αποτελεί ένα εξαιρετικό όπλο μεγάλου βεληνεκούς. Χρησιμοποιείται για την καταστροφή των χωραφιών και των κτιρίων των χωριών του εχθρού. Ωστόσο, χωρίς στρατεύματα συνοδείας, είναι πρακτικά απροστάτευτος, οπότε μην αμελήσετε να τον υποστηρίξετε με μερικούς από τους στρατιώτες σας. 
<br><br>
Ένα υψηλό επίπεδο πλατείας συγκεντρώσεως κάνει τους καταπέλτες σας περισσότερο ακριβείς και σας δίνει την ευκαιρία να χτυπήσετε περισσότερα εχθρικά κτήρια. Περισσότερες πληροφορίες είναι διαθέσιμες <a href="' . getAnswersUrl() . '?view=answers&amp;action=answer&amp;aid=157#go2answer" target="blank">εδώ</a>.
<br>
ΣΗΜΕΙΩΣΗ: Οι καταπέλτες ΜΠΟΡΟΥΝ να χτυπήσουν κρυψώνες, τοποθέτη παγίδων ή λιθοδόμο όταν στοχεύουν τυχαία.';
$Definition['Troops'][69]['title'] = 'Λογάδες';
$Definition['Troops'][69]['desc'] = 'Οι Λογάδες κέρδισαν τη θέση τους με το σπαθί τους, υπερνικώντας όλες τις προκλήσεις σε μια θανατηφόρα μάχη φυσικής και διανοητικής υπεροχής. Πλέον, αφήνουν τα πάτρια μόνο όταν πρόκειται για κατακτήσεις. 
<br/>
Κάθε φορά που πατάνε το πόδι τους σε ένα χωριό του εχθρού, η ισχυρή τους παρουσία κάνει την αφοσίωση του πληθυσμού στον προηγούμενο δυνάστη τους να φθίνει, έως ότου αποφασίσουν να συνασπιστούν υπό την ηγεσία σας.';
$Definition['Troops'][70]['title'] = 'Έποικος';
$Definition['Troops'][70]['desc'] = 'Οι έποικοι είναι γενναίοι και τολμηροί πολίτες που, μετά από πολλή εκπαίδευση, αφήνουν το χωριό, για να ιδρύσουν ένα νέο χωριό προς τιμήν σου. 
<br/>
Τόσο το ταξίδι όσο και η ίδρυση ενός νέου χωριού είναι δύσκολο εγχείρημα, οπότε τουλάχιστον τρεις έποικοι πρέπει να είναι μαζί. Χρειάζονται βασικές προμήθειες 750 μονάδων ανά είδος πόρου.';

$Definition['Troops'][98]['title'] = 'Ήρωας';
$Definition['Troops'][99]['title'] = 'Παγίδα';
//
$Definition['villageOverview']['villageOverview'] = 'Επισκόπηση χωριών';
$Definition['villageOverview']['Overview'] = 'Επισκόπηση';
$Definition['villageOverview']['Resources'] = 'Ύλες';
$Definition['villageOverview']['Warehouse'] = 'Αποθήκη';
$Definition['villageOverview']['CulturePoints'] = 'Πόντοι πολιτισμού';
$Definition['villageOverview']['Troops'] = 'στρατεύματα';
$Definition['villageOverview']['Select x as favor tab'] = 'Θέσε το %s στα αγαπημένα.';
$Definition['villageOverview']['This tab is set as favourite'] = 'Αυτή η καρτέλα έχει οριστεί ως αγαπημένη καρτέλα.';
$Definition['villageOverview']['Village statistics||For this feature you need Travian Plus activated'] = 'Στατιστικά χωριού||Γι αυτό το στοιχείο χρειάζεστε ενεργοποιημένο το Travian Plus.';
$Definition['villageOverview']['Village'] = 'Χωριό';
$Definition['villageOverview']['Attacks'] = 'Επιθέσεις';
$Definition['villageOverview']['Building'] = 'Κτήριο';
$Definition['villageOverview']['Troops'] = 'Στρατεύματα';
$Definition['villageOverview']['Merchants'] = 'Έμποροι';
$Definition['villageOverview']['Own attacking troops'] = 'Δικά μου επιτιθέμενα στρατεύματα';
$Definition['villageOverview']['Oasis attacking troops'] = 'Επιτιθέμενα στρατεύματα στην όαση';
$Definition['villageOverview']['Oasis reinforcing troops'] = 'Στρατεύματα ενισχύσεις στην οαση';
$Definition['villageOverview']['Village reinforcing troops'] = 'Στρατεύματα ενισχύσεις στο χωριό';
$Definition['villageOverview']['Other attacking troops'] = 'Ξένα επιτιθέμενα στρατεύματα';
$Definition['villageOverview']['Own Reinforcing troops'] = 'Δικές μου ενισχύσεις';
$Definition['villageOverview']['Sum'] = 'Σύνολο';
$Definition['villageOverview']['duration'] = 'Διάρκεια';
$Definition['villageOverview']['CPs/Day'] = 'ΠΠ / ημέρα';
$Definition['villageOverview']['Celebrations'] = 'Εορτασμοί';
$Definition['villageOverview']['Slots'] = 'Πεδία';
$Definition['villageOverview']['Own Troops'] = 'Δικά μου στρατεύματα';
$Definition['villageOverview']['Troops in villages'] = 'Στρατεύματα στα χωριά';
$Definition['villageOverview']['Upkeep'] = 'Συντήρηση';
$Definition['villageOverview']['Armory'] = 'Σιδηρουργείο';
$Definition['villageOverview']['inResearch'] = 'Σε εξέλιξη';
$Definition['villageOverview']['research_level'] = 'Επίπεδο έρευνας';
$Definition['villageOverview']['per hour'] = 'την ώρα';
//
$Definition['demolishNowPopup']['Redeem'] = 'Εξαργύρωση';
$Definition['demolishNowPopup']['desc'] = 'Άμεση κατεδάφιση του συγκεκριμένου κτηρίου; Θα αφαιρεθεί από το χωριό σου.';
//
$Definition['finishNowPopup']['title'] = 'Ολοκλήρωσε όλες τις εντολές κατασκευών και έρευνες άμεσα.';
$Definition['finishNowPopup']['desc'] = 'Οι ακόλουθες παραγγελίες θα ολοκληρωθούν άμεσα';
$Definition['finishNowPopup']['Redeem'] = 'Εξαργύρωση';
$Definition['finishNowPopup']['buildingOrders'] = 'Εντολές κατασκευής';
$Definition['finishNowPopup']['academy'] = 'Έρευνα' . '(ακαδημία)';
$Definition['finishNowPopup']['smithy'] = 'Έρευνα' . '(σιδηρουργείο)';
$Definition['finishNowPopup']['demolishBuildingLevel'] = 'Κατεδάφιση';
$Definition['finishNowPopup']['level'] = 'Επίπεδο';
$Definition['finishNowPopup']['No construction orders or research that could be completed instantly'] = 'Δεν υπάρχουν εντολές κατασκευής ή έρευνα που θα μπορούσε να ολοκληρωθεί αμέσως.';
//
$Definition['goldClubPopup']['title'] = 'Gold club';
$Definition['goldClubPopup']['gold'] = 'Χρυσός';
$Definition['goldClubPopup']['Bonus duration'] = 'Διάρκεια επιδόματος';
$Definition['goldClubPopup']['whole game round'] = ' όλος ο γύρος του παιχνιδιού';
$Definition['goldClubPopup']['Additionally, you will have access to the following features:'] = 'Επιπλέον, θα έχετε πρόσβαση στα ακόλουθα στοιχεία:';
$Definition['goldClubPopup']['In order to use this feature, you need to activate the Gold club!'] = 'Για να χρησιμοποιήσετε αυτό το στοιχείο πρέπει να ενεργοποιήσετε το Gold club!';
$Definition['goldClubPopup']['troopEscape'] = [
    'title' => 'Διαφυγή στην πρωτεύουσα',
    'text' => 'Μπορείτε να διατάξετε τα δικά σας στρατεύματα στην πρωτεύουσα, να φύγουν αυτόματα από το χωριό σε περίπτωση επίθεσης, από την πλατεία συγκεντρώσεως.',
];
$Definition['goldClubPopup']['raidList'] = [
    'title' => 'Φάρμες',
    'text' => 'Στην πλατεία συγκέντρωσης, μπορείς να χρησιμοποιήσεις την λίστα με φάρμες για να διαχειριστείτε επιθέσεις σε επικερδής στόχους.',
];
$Definition['goldClubPopup']['tradeThreeTimes'] = [
    'title' => 'Οι έμποροι μπορούν να τρέξουν 3 φορές',
    'text' => 'Οι έμποροι μπορούν να πραγματοποιούν αυτόματα αποστολές υλών έως και τρεις φορές στη σειρά.',
];
$Definition['goldClubPopup']['tradeThreeTimes'] = [
    'title' => 'Οι έμποροι μπορούν να τρέξουν 3 φορές',
    'text' => 'Οι έμποροι μπορούν να μεταφέρουν ύλες αυτόματα μέχρι 3 φορές στην σειρά.',
];
$Definition['goldClubPopup']['cropFinder'] = [
    'title' => 'Εύρεση πολυσίταρων (9 και 15) χωραφιών στον χάρτη',
    'text' => 'Μια λειτουργία του χάρτη που σας επιτρέπει να βρείτε τεμάχια με αυξημένη παραγωγή σιταριού και οάσεις με επίδομα.',
];
$Definition['goldClubPopup']['messageArchive'] = [
    'title' => 'Αρχειοθέτηση μηνυμάτων και αναφορών',
    'text' => 'Σημαντικά μηνύματα και αναφορές μπορούν να αρχειοθετηθούν ώστε να υπάρχει εύκολη πρόσβαση αργότερα σε αυτά.',
];
$Definition['goldClubPopup']['furtherInfos'] = 'Το <B>Gold club</b> θα ενεργοποιήσει τα ακόλουθα στοιχεία για το υπόλοιπο του γύρου του παιχνιδιού. Πάτησε στο "i" για περισσότερες πληροφορίες.';
//
$Definition['overlay'] = ['defaultTitle' => 'Καλωσόρισες στο νέο Travian περιβάλλον χρήσης',
    'defaultDescription' => 'Μετακίνησε το ποντίκι σου πάνω από τα μαρκαρισμένα στοιχεία του περιβάλλοντος χρήσης για να δεις επιπλέον πληροφορίες.',
    'closeLink' => 'Κλείσε την βοήθεια και συνέχισε να παίζεις.',
    'mainPageTitle' => 'Κύρια σελίδα',
    'mainPageDescription' => 'The <span class="important">Το έμβλημα του παιχνιδιού</span> σε μεταφέρει στην κύρια σελίδα μας, όπου μπορείς να βρεις πληροφορίες και παιχνίδια.',
    'villageSwitchTitle' => 'Άλλαξε επισκόπηση χωριόύ',
    'villageSwitchDescription' => 'Άλλαξε μεταξύ των πεδίων υλών έξω από το χωριό σου και το κέντρο του χωριού σου που περιέχει όλα τα άλλα κτήρια. Πάτησε σε ένα πεδίο υλών ή ένα άδειο πεδίο για να το ανοίξεις. Εδώ μπορείς να τα αναβαθμίσεις ή να τα χρησιμοποιήσεις.',
    'mainNavigationTitle' => 'Ειδικές επισκοπήσεις παιχνιδιού',
    'mainNavigationDescription' => '<span class="important">Χάρτης κόσμου:</span> Ο χάρτης δείχνει τον περίγυρο του χωριού σου. Εδώ μπορείς να βρεις στόχους και πιθανές απειλές.<br/><span class="important">Στατιστικά:</span> Επιλεγμένα στοιχεία από όλους τους παίκτες και τις συμμαχίες μέσα στο παιχνίδι.<br /><span class="important">Αναφορές:</span> Αναφορές σχετικά με γεγονότα, όπως μάχες, εμπόριο και περιπέτειες.<br /><span class="important">Μηνύματα:</span> Κλείσε συμφωνίες και κάνε σχέδια απευθείας με άλλους παίκτες.',
    'premiumFeaturesTitle' => 'Αγόρασε και χρησιμοποίησε χρυσό',
    'premiumFeaturesDescription' => 'Αγόρασε <span class="important">Χρυσό</span> εδώ για να έχεις πρόσβαση σε προχωρημένα στοιχεία και αναβαθμισμένο περιβάλλον χρήσης. <br /><span class="important">Ασήμι</span> χρησιμοποιείτε στις δημοπρασίες του ήρωα και μπορείς να το ανταλλάξεις για χρυσό στο ανταλλακτήριο.',
    'outOfGameTitle' => 'Διαχείριση',
    'outOfGameDescription' => 'Χρήσιμα στοιχεία του παιχνιδιού:<br /><span class="important">Προφίλ:</span> Επεξεργάσου το δημόσιο προφίλ του παίκτη σου.<br /><span class="important">Ρυθμίσεις:</span> Επιλογές και τεχνικές ρυθμίσεις.<br /><span class="important">Φόρουμ:</span> Πήγαινε απευθείας στο επίσημο φόρουμ. <br /><span class="important">IRC:</span> Ένα support chat στο οποίο μπορείς να βρεις βοήθεια. <br /><span class="important">Answers:</span> Το βοήθημα του Travian.<br /><span class="important">Αποσύνδεση:</span> Αποσυνδέσου από τον λογαριασμό σου.',
    'villageResourcesTitle' => 'Ύλες του επιλεγμένου χωριού',
    'villageResourcesDescription' => 'Δείχνει το μέγεθος της αποθήκης και το τρέχον απόθεμα των υλών ξύλου, πηλού και σιδήρου. Ένα κλικ στο στοκ θα σου δείξει μια επισκόπηση για το πως υπολογίζεται η τρέχουσα παραγωγή μιας ύλης.',
    'villageCropTitle' => 'Σιτάρι του συγκεκριμένου χωριού',
    'villageCropDescription' => 'Δείχνει το μέγεθος της σιταποθήκης και το τρέχον απόθεμα σιταριού. Το ελεύθερο σιτάρι χρειάζεται για την συντήρηση καινούργιων κτηρίων ή για την αναβάθμιση υπαρχόντων κτηρίων.',
    'sidebarBoxHeroTitle' => 'Η εικόνα του ήρωά σου',
    'sidebarBoxHeroDescription' => 'Ο ήρωάς σου και κάποια σημαντικά στοιχεία γι αυτόν. Πάτησε στην εικόνα για να αλλάξεις χαρακτηριστικά ή εξοπλισμό στον ήρωα. Το πρώτο κουμπί οδηγεί στις διαθέσιμες περιπέτειες. Μπορείς να στείλεις των ήρωα σε αυτές, κατευθείαν από εκεί. Το άλλο κουμπί σε οδηγεί στις δημοπρασίες, όπου μπορείς να πουλήσεις αντικείμενά σου ή να αγοράσεις από άλλους παίκτες.',
    'sidebarBoxAllianceTitle' => 'Η συμμαχία σου',
    'sidebarBoxAllianceDescription' => 'Σε μια συμμαχία, οι παίκτες μπορούν να συνεργαστούν καλύτερα μεταξύ τους και να προσφέρουν υποστήριξη ο ένας στον άλλο. Για την δική σου ασφάλεια θα πρέπει να βρεις γρήγορα συμμάχους. Όταν γίνεις μέλος μιας συμμαχίας, τα κουμπιά θα σε οδηγούν στο προφίλ της συμμαχίας και το φόρουμ της συμμαχίας.',
    'sidebarBoxInfoboxTitle' => 'Το κουτί πληροφοριών',
    'sidebarBoxInfoboxDescription' => 'Εδώ μπορείς να βρεις σημαντικά μηνύματα του συστήματος.',
    'sidebarBoxLinklistTitle' => 'Η λίστα link',
    'sidebarBoxLinklistDescription' => 'Για να χρησιμοποιήσεις την λίστα link, χρειάζεσαι Travian PLUS. Απευθείας link σε σημαντικούς στόχους ή κτήρια καθώς μπορούν να δημιουργηθούν και εξωτερικά link. Το κουμπί σας επιτρέπει να επεξεργαστείτε την λίστα.',
    'sidebarBoxActiveVillageTitle' => 'Σήμα ενεργού χωριού',
    'sidebarBoxActiveVillageDescription' => 'Το όνομα του επιλεγμένου χωριού και η πίστη των πολιτών σου. Στην κορυφή, οι χρήστες PLUS, μπορούν να βρουν 4 απευθείας links στην αγορά και τα κτήρια στρατευμάτων. Το κουμπί επεξεργασίας σου επιτρέπει να αλλάξεις το όνομα του χωριού.',
    'sidebarBoxVillagelistTitle' => 'Η λίστα όλων των χωριών σου',
    'sidebarBoxVillagelistDescription' => 'Στην επικεφαλίδα, μπορείς να δεις πόσα χωριά σου ανήκουν και πόσα θα μπορούσες να έχεις. Πιο κάτω, μπορείς να δεις την πρόοδο των πόντων πολιτισμού που χρειάζεσαι για το επόμενο χωριό. Τα κουμπιά σου επιτρέπουν να δεις κάποιες άλλες σελίδες επισκόπησης και σου δείχνουν τις συντεταγμένες του χωριού.',
    'sidebarBoxQuestmasterTitle' => 'Ο σύμβουλος και taskmaster',
    'sidebarBoxQuestmasterDescription' => 'Πάτησε στον taskmaster για να εμφανίσεις ή να κρύψεις τις εργασίες σου. Θα σε ενημερώσει αν υπάρχουν νέα. Πιο κάτω μπορείς να βρεις μια επισκόπηση των εργασιών σου.',];
//
$Definition['plusPopup'] = ['title' => 'Travian PLUS',
    'subHeadLine' => 'Για να χρησιμοποιήσετε αυτό το στοιχείο, χρειάζεται να ενεργοποιήσετε το Travian PLUS.',
    'plusPopupButtonExtraFeatures' => 'Επιπλέον, θα έχετε πρόσβαση στα ακόλουθα στοιχεία:',
    'Bonus duration in days:' => 'Διάρκεια επιδόματος:',
    "features" => [
        'attackWarning' => [
            'title' => 'Ειδοποίηση επίθεσης',
            'text' => 'Οι εισερχόμενες επιθέσεις θα φαίνονται στην λίστα των χωριών σας.',
        ], 'buildingQueue' => [
            'title' => 'Κατασκευές στην σειρά',
            'text' => 'Οι κατασκευές στην σειρά σας επιτρέπουν να βάλετε στην σειρά περισσότερες κατασκευές.',
        ], 'directLinks' => [
            'title' => 'Απευθείας Links',
            'text' => 'Τα απευθείας links στην αγορά, το στρατόπεδο, τον στάβλο και το εργαστήριο, καθώς επίσης και πρόσθετες σημαντικές πληροφορίες tooltip.',
        ], 'linkList' => [
            'title' => 'Λίστα link',
            'text' => 'Σας επιτρέπει την δημιουργία links, τα οποία σας επιτρέπουν να φτάσετε οποιαδήποτε σελίδα στο παιχνίδι με ένα κλικ..',
        ], 'villageStatistics' => [
            'title' => 'Επισκόπηση χωριού',
            'text' => 'Επισκόπηση παραγωγής, αποθεμάτων, πόντων πολιτισμού και στρατευμάτων για όλα τα χωριά σας.',
        ], 'fullScreen' => [
            'title' => 'Μεγαλύτερος χάρτης',
            'text' => 'Για μια καλύτερη επισκόπηση, ο χάρτης μπορεί να μεγαλώσει ώστε να καλύπτει ολόκληρη την οθόνη και να εμφανίζει μια μεγαλύτερη περιοχή.',
        ], 'tradeMulti' => [
            'title' => 'Οι έμποροι μπορούν να πάνε δυο φορές',
            'text' => 'Οι έμποροι μπορούν να επαναλάβουν αυτόματα παράδοση υλών για δεύτερη φορά.',
        ],
    ],
    'furtherInfos' => 'Το Travian PLUS σας ενεργοποιεί τα παραπάνω στοιχεία για %s  και μπορεί να επεκταθεί οποιαδήποτε στιγμή. Αν επιλέξετε την αυτόματη επέκταση αυτού του στοιχείου, θα επεκταθεί μια μέρα πριν λήξη και ο χρυσός θα μειωθεί επίσης εκείνη την στιγμή. Για περισσότερες πληροφορίες πατήστε στο "i".',
];
//
$Definition['productionBoostPopup']['+25%‎ lumber production'] = '+25% παραγωγή ξυλείας';
$Definition['productionBoostPopup']['+25%‎ clay production'] = '+25% παραγωγή πηλού';
$Definition['productionBoostPopup']['+25%‎ iron production'] = '+25% παραγωγή σιδήρου';
$Definition['productionBoostPopup']['+25%‎ crop production'] = '+25% παραγωγή σιταριού';
$Definition['productionBoostPopup']['Production bonus'] = 'Ενίσχυση παραγωγής';
$Definition['productionBoostPopup']['Select which resources production you would like to increase:'] = 'Επιλέξτε ποια παραγωγή υλών θα θέλατε να αυξήσετε:';
$Definition['productionBoostPopup']['Bonus duration in days:'] = 'Διάρκεια επιδόματος σε ημέρες:';
$Definition['productionBoostPopup']['furtherInfos'] = 'Το επίδομα παραγωγής αυξάνει την παραγωγή των επιλεγμένων υλών, σε όλα τα χωριά σας κατά 25%% για %s. Αν επιλέξετε την αυτόματη επέκταση, το επίδομα παραγωγής θα ενεργοποιείτε αυτόματα μόλις λήξη.';

$Definition['Support'] = [
    'Support' => 'Υποστήριξη',
    'description' => 'Μπορείτε να χρησιμοποιήσετε την ακόλουθη φόρμα για να στείλετε ένα αίτημα στην υποστήριξη. Παρακαλώ απαντήστε όσο το δυνατό περισσότερες ερωτήσεις, με αυτό τον τρόπο θα μπορέσουμε να απαντήσουμε στο αίτημα σας το συντομότερο δυνατό. Χωρίς μια έγκυρη διεύθυνση email το αίτημα σας δεν θα επεξεργαστεί.',
    'Game errors, login errors and game rules related questions' => 'Λάθη μέσα στο παιχνίδι, πρόβλημα σύνδεσης και ερωτήσεις για τους κανόνες του παιχνιδιού.',
    'Game world' => 'Κόσμος παιχνιδιού',
    'please select' => 'παρακαλώ επιλέξτε',
    'I don´t know' => 'Δεν ξέρω',
    'Username' => 'Όνομα',
    'Email' => 'Email',
    'Category' => 'Κατηγορία',
    'Message' => 'Μήνυμα',
    'General questions' => 'Γενικές ερωτήσεις',
    'I cannot log in' => 'Δεν μπορώ να συνδεθώ στο λογαριασμό μου',
    'I cannot register an account' => 'Δεν μπορώ να καταχωρήσω λογαριασμό',
    'send request' => 'Αποστολή μηνύματος',
    'Captcha' => 'Captcha',
    'errors' => [
        'please select',
        'This field is necessary' => 'Αυτό το πεδίο είναι απαραίτητο.',
        'Entry is too short' => 'Η καταχώρηση είναι πολύ μικρή.',
        'Invalid email address' => 'Μη έγκυρη διεύθυνση e-mail.',
        'Wrong captcha' => 'Λάθος captcha.',
    ],
    'done' => 'Θα προσπαθήσουμε να σας βοηθήσουμε το συντομότερο δυνατό. Παρακαλούμε να είστε υπομονετικοί - συνήθως θα λάβετε απάντηση μέσα σε 24 ώρες.',
];

$Definition['inGameSupport'] = [
    'Support' => 'Υποστίρηξη',
    'description' => 'Χρησιμοποιώντας το σύστημα βοήθειας στη σελίδα Απαντήσεις, μπορείτε εύκολα να βρείτε απαντήσεις σε όλες τις γενικές ερωτήσεις σχετικά με το Travian γρήγορα και χωρίς να ψάχνετε για μεγάλο χρονικό διάστημα. Επιπλέον, έχετε τη δυνατότητα να επικοινωνήσετε με την υποστήριξη. Μπορεί να πάρει την υποστήριξή μας μέχρι και 24 ώρες για να απαντήσει στην ερώτησή σας. Για να πάρετε μια ταχύτερη απάντηση, δοκιμάστε τις απαντήσεις.',
    'Game errors, login errors and game rules related questions' => 'Λάθη μέσα στο παιχνίδι, πρόβλημα σύνδεσης και ερωτήσεις για τους κανόνες του παιχνιδιού',
    'Category' => 'Κατηγορία',
    'Message' => 'Μήνυμα',
    'general questions' => 'Γενικές ερωτήσεις',
    'report an error' => 'Αναφορά λάθους',
    'send request' => 'Αποστολή μηνύματος',
    'please select' => 'Παρακαλώ επιλέξτε',
    'Game support' => 'Υποστίρηξη παιχνιγιού',
    'Violation of the rules' => 'Παράβαση κανόνων',
    'Plus support' => 'Plus support',
    'to the village' => 'στο χωριό.',
    'Captcha' => 'Captcha',
    'errors' => [
        'please select' => 'Παρακαλώ επιλέξτε',
        'This field is necessary' => 'Αυτό το πεδίο είναι απαραίτητο.',
        'Entry is too short' => 'Η καταχώρηση είναι πολύ μικρή.',
        'Wrong captcha' => 'Λάθος captcha.',
    ],
    'done' => 'Θα προσπαθήσουμε να σας βοηθήσουμε το συντομότερο δυνατό. Παρακαλούμε να είστε υπομονετικοί - συνήθως θα λάβετε απάντηση μέσα σε 24 ώρες
.',
];
$Definition['LinkList']['Vouchers (GoldBank)'] = 'Κουπόνια (Τράπεζα χρυσού)';
$Definition['LinkList']['Farmlist'] = 'Λίστα με φάρμες';
$Definition['LinkList']['Farms'] = 'Φάρμες';
$Definition['LinkList']['Go to admin panel'] = 'Go to admin panel';
$Definition['LinkList']['Contact Support'] = 'Επικοινωνίστε με την τεχνική υποστήριξη';

$Definition['Email']['serverStartEmailSubject'] = 'Molon-Lave new server starts soon';
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
    'Redeem' => 'εξαργύρωση',
    'EnterYourCodeTo' => 'Αν έχετε κωδικό εξαργύρωσης, εισαγάγετε τον κωδικό σας για να εξαργυρώσετε την αγορά σας παρακάτω',
    'Redeem code' => 'Εξαργύρωση κουπονιών',
    'Purchased code' => 'Κωδικός Εξαργύρωσης',
    'invalidCode' => 'Λανθασμένος κωδικός.',
    'codeIsUsed' => 'Αυτός ο κωδικός έχει χρησιμοποιηθεί ήδη.',
    'redeemSuccess' => 'Ο κωδικός εξαργυρώθηκε με επιτυχία. Ο χρυσός θα σας προστεθεί σύντομα στο λογαριασμό σας.',
    'tooManyTries' => 'Πάρα πολλές προσπάθειες. Δοκιμάστε ξανά μετά από λίγο.',
    'unknownError' => 'Αγνωστο σφάλμα',
];
$Definition['Voting'] = [
    'description' => 'Μπορείτε να ψηφίσετε εδώ σε αυτούς τους ιστοτόπους που αναφέρονται παρακάτω και να πάρετε %s χρυσό δωρεάν. ',
    'Next vote in %s hours' => 'επόμενη ψήφος σε %s ώρες.',
    'Vote at TopG' => 'ψηφίστε για TopG',
    'Vote at Arena Top 100' => 'ψηφίστε για Top 100',
    'Vote at GTop100' => 'ψηφίστε για GTop100',
];
$Definition['Embassy']['Attacker'] = 'Επιτιθέμενος';
$Definition['Embassy']['Defender'] = 'Αμυνόμενος';
$Definition['Embassy']['Alliance'] = 'Συμμαχία';
$Definition['Embassy']['Password'] = 'Κωδικός';
$Definition['Embassy']['Confirm'] = 'Επιβεβαίωση';
$Definition['Embassy']['No nearby alliance found'] = 'Δεν βρέθηκε κοντινή συμμαχία';
$Definition['Embassy']['Population'] = 'Πληθυσμός';
$Definition['Embassy']['Villages within 50 fields'] = 'Χωριά μέσα σε 50 πεδία';
$Definition['Embassy']['Alliance %s (%s), invited by %s'] = 'Προσκληθήκατε στην συμμαχεία: %s (%s), ο παίκτης που σας προσκάλεσε: %s';
$Definition['Embassy']['Found alliance'] = 'Ἰδρυση συμμαχίας';
$Definition['Embassy']['In order to found an alliance you need to have an embassy level 3'] = 'Για την ίδρυση νέας συμμαχίας απαιτείται το χτίσιμο <b>Πρεσβείας</b> στο επίπεδο 3.';
$Definition['Embassy']['Join alliance'] = 'Συμμετέχω στη συμμαχία';
$Definition['Embassy']['Find alliance'] = 'Βρες συμμαχία';
$Definition['Embassy']['The password is wrong'] = 'Ο κωδικός ασφαλείας είναι λάθος.';
$Definition['Embassy']['In order to quit the alliance you have to enter your password again for safety reasons'] = 'Για να ολοκληρωθεί η παραίτηση σου από την συμμαχία θα πρέπει να εισάγεις τον κωδικό πρόσβασης';
$Definition['Embassy']['Leave the alliance'] = 'Αφήστε την συμμαχία';
$Definition['Embassy']['Alliance leave contribution note'] = 'Αυτό θα επηρεάσει μόνο την ολική κατάταξη συνεισφορών. Οι συνεισφορές στα επιδόματα της τρέχουσας συμμαχίας θα παραμείνουν. Αν επιστρέψετε, το σύνολο των συνεισφορών σου θα είναι 0.';
$Definition['Embassy']['If you leave the alliance your contribution statistics will reset'] = 'Αν αφήσεις την συμμαχία σου, τα στατιστικά των συνεισφορών σου θα μηδενιστούν';

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
return $Definition;