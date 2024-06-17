<?php
use Core\Config;
use Model\DailyQuestModel;
use Model\Quest;
global $Definition;
$Definition['403Error']['You cannot pass!'] = 'لا يمكنك الدخول !';
$Definition['403Error']['I am a servant of the Secret Order, wielder of the flame of 403, You cannot pass'] = 'لا يمكنك الدخول للسيرفر';
//Academy
$Definition['Academy'] = [
    "zoomIn" => "تكبير",
    "Researches for village %s" => "بحث القرى %s",
    "ResearchesForVillage" => "بحث القرى",
    "noResearchAvailableDesc" => "لا يمكن البحث عن أي قوات جديدة في الوقت الراهن، للبحث عن الشروط المسبقة للقوات الجديدة، انقر على صورة الوحدة ذات الصلة في الدليل",
    "showMore" => "عرض المزيد",
    "hideMore" => "عرض المزيد",
    "Researching" => "البحث",
    "unit" => "وحدة",
    "research" => "البحث",
    "one_research_is_going" => "جاري البحث",
];

$Definition['ActivationNew'] = [
    'unableToGenerateBase' => 'We were unable to generate a new village for you. Please try again after a while or contact administrator.',
    'vidSelectDescription' => 'الإمبراطوريات العظيمة تبدأ من القرارات والأساسات الهامة ! هل انت مهاجم تحب المنافسة ؟? او تحب التجارة ووقتك محدود ؟ او تحب ان تكون أحد أفراد مجموعة قوية ؟?',
    'sectorSelectDescription' => 'اين تريد البدء في بناء إمبراطوريتك ? إستخدم "الموصى بها" للمواقع المثالية . او حدد المنطقة حيث يقع إصدقائك واعضاء فريقك !',
    'recommendedForNewPlayers' => 'أوصيت لاعبين جدد',
    'Select your starting position' => 'إختيار منطقة البداية',
    'Select your tribe' => 'إختيار القبيلة',
    'Confirm' => 'تأكيد',
    'back' => 'عودة',
    'New' => 'جديد',
    'RECOMMENDED' => 'موصى بها',
    'Ready to rule the world?' => 'على إستعداد لحكم العالم ؟?',
    'PLAY NOW' => 'لعب الآن',
    'North - West' => 'الشمال الغربي',
    'North - East' => 'الشمال الشرقي',
    'South - West' => 'الجنوب الغربي',
    'South - East' => 'الجنوب الشرقي',
    'selectionComplete' => 'إكتمل إختيارك , خطوة أخيرة لقبول التحدي !',
    "race1_attributes" => [
        0 => 'متطلبات الوقت معتدل',
        1 => 'يمكن تطوير القرى بسرعة',
        2 => 'قوات قوية جداً ولاكن مكلفة',
        3 => 'لا ينصح بها للاعبين الجدد',
    ], 'race2_attributes' => [
        0 => 'متطلبات الوقت عالي',
        1 => 'ممتازة في النهب بالبداية',
        2 => 'قوية , مشاة رخيصة الثمن',
        3 => 'للاعبين المحاربين',
    ], "race3_attributes" => [
        0 => 'متطلبات الوقت منخفض',
        1 => 'حماية الموارد وقوة الدفاع',
        2 => 'اسرع الفرسان بين القبائل',
        3 => 'ينصح بها للاعبين الجدد ',
    ], "race6_attributes" => [
        0 => 'متطلبات الوقت منخفض',
        1 => 'المزيد من الموارد المتاحة',
        2 => 'وحدات ممتاز , دفاعية',
        3 => 'ينصح بها للاعبين الجدد',
    ], "race7_attributes" => [
        0 => 'متطلبات الوقت عالي',
        1 => 'اقوى الفرسان بين القبائل',
        2 => 'الإعتماد على الأخرين للحماية',
        3 => 'لا ينصح بها للاعبين الجدد!',
    ],
];
$Definition['activation'] = [
    'unableToGenerateBase' => 'We were unable to generate a new village for you. Please try again after a while or contact administrator.',
    "selectASector" => "تحديد نقطة الانطلاقة",
    "sector_nw" => "الإنطلاق من الشمال الغربي",
    "sector_ne" => "الإنطلاق من الشمال الشرقي",
    "sector_sw" => "الإنطلاق من الجنوب الغربي",
    "sector_se" => "الإنطلاق من الجنوب الشرقي",
    "race_helpers" => [
        1 => "الإغريق", 2 => 'الرومان', 3 => 'الجرمان',
    ],

    "selectedRace" => "لقد اخترت %s قبيلة %s اعتباراً من الآن سيكون الآمر ملازماً لبداية طريقك في اللعبة لإرشادك",
    "changeVid" => "تغيير القبيلة",
    "submitSector" => "إختيار نقطة الإنطلاق",
    "sectorDescription" => 'أنشأ قريتك هنا، أو قم بتغيير ااختيارك الأولي بعملك "كليك" على الخارطة
',
    "selectARace" => "اختيار قبيلة",
    "submitKind" => "اختيار قبيلة",
    "attributes" => "التفاصيل",
    "thanksForActivation" => 'شكراً على تفعيل حسابك',
    "pleaseChooseATribe" => 'اختيار قبيلة في هذا العالم',
    "vidDescription" => 'ننصحك بإختيار قبيلة الإغريق إذا كنت جديدً على اللعبة',
    "race1_attributes" => [
        0 => 'الوقت اللازم للتطوير متوسط',
        1 => 'أسرع القبائل إنشاءً للقرى.',
        2 => 'قوّات قوية جداً لكنها مكلفة - قوة مشاة جبّارة',
        3 => 'تكاد لا تلمح إيجابياتها في البدايات، لذلك لا ننصح بها للمبتدئين',
    ], 'race2_attributes' => [
        0 => 'وقت أطول للتطوير من أجل لعبة هجومية',
        1 => 'قوّات جبّارة سريعة التدريب وخبيرة في النهب',
        2 => 'اختيار اللاعبين الخبراء والميّالين للهجوم',
    ], "race3_attributes" => [
        0 => 'أقصر وقت تطوير مقارنة بباقي القبائل',
        1 => 'حماية ضد النهب أفضل وإمكانية دفاعية جيدة في وقت مبكر',
        2 => 'سلاح فرسان كفؤ جداً، أسرع الوحدات القتالية في اللعبة',
        3 => 'منصوحٌ بها للمبتدئين',
    ],
];
//Alliance
$Definition['Alliance']['Kicking/inviting is not allowed at this time'] = 'الطرد/الدعوة غير مسموح به في هذا الوقت .';
$Definition['Alliance']['Enter tag'] = ':رمز';
$Definition['Alliance']['Enter name'] = ':الأسم';
$Definition['Alliance']['Tag too long'] = 'الرمز طويل .';
$Definition['Alliance']['Name too long'] = 'الإسم طويل .';
$Definition['Alliance']['Category'] = 'فئة';
$Definition['Alliance']['week'] = 'إسبوع';
$Definition['Alliance']['bbcode'] = 'BB اكواد';
$Definition['Alliance']['Medals'] = 'الميداليات';
$Definition['Alliance']['BB codes'] = 'BB اكواد';
$Definition['Alliance']['News'] = 'الأخبار';
$Definition['Alliance']['Number'] = 'العدد';
$Definition['Alliance']['losses'] = 'الخسائر';
$Definition['Alliance']['strength'] = 'القوة';
$Definition['Alliance']['Title'] = 'العنوان';
$Definition['Alliance']['URL'] = 'رابط';
$Definition['Alliance']['Hint'] = 'تلميح';
$Definition['Alliance']['Tip'] = 'نصيحه';
$Definition['Alliance']['confederacy with x'] = 'في التحالف مع %s';
$Definition['Alliance']['NAP with x'] = 'ميثاق عدم إعتداء مع %s';
$Definition['Alliance']['war with x'] = 'في الحرب مع %s';
$Definition['Alliance']['accept'] = 'تأكيد';
$Definition['Alliance']['Select'] = 'إختيار';
$Definition['Alliance']['Confirm'] = 'أكد';
$Definition['Alliance']['wrongPassword'] = 'كلمة السر خاطئة';
$Definition['Alliance']['In order to kick the player you have to enter your password again for security reasons'] = 'لطرد اللاعب , يرجى إدخال كلمة السر لإسباب أمنية';
$Definition['Alliance']['Password'] = 'كلمة السر';
$Definition['Alliance']['Cant kick player'] = 'قمت بطرد اللاعب';
$Definition['Alliance']['InvitesAreClosed'] = 'الدعوات مغلقة';
$Definition['Alliance']['There is already an offer'] = 'هناك عرض بالفعل';
$Definition['Alliance']['Alliance x does not exists'] = 'التحالف %s غير موجود';
$Definition['Alliance']['offer a confederacy'] = 'عرض ميثاق تحالف';
$Definition['Alliance']['offer a NAP'] = 'عرض ميثاق عدم إعتداء';
$Definition['Alliance']['declare war'] = 'عرض إعلان الحرب';
$Definition['Alliance']['Own offers'] = 'العروض الخاصه';
$Definition['Alliance']['Foreign offers'] = 'العروض الأجنبية';
$Definition['Alliance']['Send'] = 'إرسال';
$Definition['Alliance']['DiplomacyShowText'] = '<div class="text">لعرض العلاقات التحالفية تلقائيا في وصف التحالف. عليك فقط كتابة<span class="e">[diplomatie]</span> في وصفك الخاص, <span class="e">[ally]</span>, <span class="e">[nap]</span> او <span class="e">[war]</span> يمكنك فعل ذلك أيضاً بطريقة منفصلة. أكتب فقط		</div>';
$Definition['Alliance']['DiplomacyHint'] = 'السلوك الدبلوماسي يحتّم التخاطب مع التحالف الآخر قبل إرسال عرض تحالف أو عدم إعتداء
';
$Definition['Alliance']['Existing relationships'] = 'العلاقات الحالية';
$Definition['Alliance']['The player x does`t exists'] = 'اللاعب %s غير موجود';
$Definition['Alliance']['none'] = 'لا شيء';
$Definition['Alliance']['draw back'] = 'إلغاء';
$Definition['Alliance']['invite sent to x'] = 'تم إرسال الدعوة %s.';
$Definition['Alliance']['invitation for x'] = 'دعوة لـ %s';
$Definition['Alliance']['test has already received an invitation'] = '%s تلقى الدعوة بالفعل';
$Definition['Alliance']['Invitations'] = 'الدعوات';
$Definition['Alliance']['invite'] = 'دعوه';
$Definition['Alliance']['toTheForum'] = 'رابط للمنتدى';
$Definition['Alliance']['you just left your alliance'] = 'تم ترك التحالف';
$Definition['Alliance']['In order to quit the alliance you have to enter your password gain for safety reasons'] = 'من أجل ترك التحالف يرجى إدخال كلمة السر لإسباب أمنية';
$Definition['Alliance']['x has been kicked from the alliance'] = '%s تم طرده من التحالف';
$Definition['Alliance']['If your alliance wants to use an external forum, you can enter the URL here'] = 'إذا اردت منتدى خارجي يمكنك إضافة رابط المنتدى هنا';
$Definition['Alliance']['choose player'] = 'إختيار لاعب';
$Definition['Alliance']['Manage flags and markers in map'] = 'إدارة الأعلام على الخارطة';
$Definition['Alliance']['Manage forums'] = 'ادارة المنتدى';
$Definition['Alliance']['IGMs to every alliance member'] = 'ظاهر لكل اعضاء التحالف';
$Definition['Alliance']['You can set up different permissions for each alliance member and assign positions'] = 'تعديل الأذونات للاعبين';
$Definition['Alliance']['fighting points'] = 'نقاط القتال';
$Definition['Alliance']['Tag exists'] = 'الرمز مستخدم';
$Definition['Alliance']['Changes saved'] = 'حفظ التغييرات';
$Definition['Alliance']['Date'] = 'التاريخ';
$Definition['Alliance']['Don´t show attacks of own alliance (under 100 units, no losses)'] = 'إخفاء الهجمات الخاصه بالتحالف ( 100 جندي واقل , بدون خسائر )';
$Definition['Alliance']['noReports'] = 'لا توجد تقارير';
$Definition['Alliance']['online now'] = 'متواجد الآن';
$Definition['Alliance']['active players'] = 'كان متواجد قبل 10 دقائق مضت';
$Definition['Alliance']['active 3days'] = 'كان متواجد قبل 3 ايام مضت';
$Definition['Alliance']['active 7days'] = 'كان متواجد قبل 7 ايام مضت';
$Definition['Alliance']['inactive'] = 'غير نشط';
$Definition['Alliance']['Rank'] = 'الرتبة';
$Definition['Alliance']['Points'] = 'النقاط';
$Definition['Alliance']['Change name'] = 'تغيير الأسم';
$Definition['Alliance']['Change alliance description'] = 'تغيير وصف التحالف';
$Definition['Alliance']['Edit internal info page'] = 'صفحة المعلومات الداخلية';
$Definition['Alliance']['Assign to position'] = 'توزيع المناصب';
$Definition['Alliance']['Link to the forum'] = 'رابط إلى المنتدى';
$Definition['Alliance']['Settings'] = 'الإعدادات';
$Definition['Alliance']['Actions'] = 'المزادات';
$Definition['Alliance']['Invite a player into the alliance'] = 'دعوة لاعب للتحالف';
$Definition['Alliance']['Alliance diplomacy'] = 'دبلوماسية التحالف';
$Definition['Alliance']['Quit alliance'] = 'ترك التحالف';
$Definition['Alliance']['Kick player'] = 'طرد لاعب';
$Definition['Alliance']['Population'] = 'السكان';
$Definition['Alliance']['Details'] = 'التفاصيل';
$Definition['Alliance']['Members'] = 'اللاعبين';
$Definition['Alliance']['Position'] = 'القادة';
$Definition['Alliance']['no thread created'] = 'لا توجد اي مواضيع';
$Definition['Alliance']['This survey ends on x'] = 'ينتهي هذا الإستطلاع في %s.';
$Definition['Alliance']['voting finished'] = 'إنتهى التصويت';
$Definition['Alliance']['move topic'] = 'نقل الموضوع';
$Definition['Alliance']['edit topic'] = 'تعديل الموضوع';
$Definition['Alliance']['x times edited, last edit by y'] = '%sx تعديل, الاخير %s في %s.';
$Definition['Alliance']['Player ID'] = 'معرف اللاعب';
$Definition['Alliance']['user_list_headline'] = 'فتح منتدى للاعبين';
$Definition['Alliance']['answer(s)'] = 'اسئلة ';
$Definition['Alliance']['Last post'] = 'اخر المواضيع';
$Definition['Alliance']['Posts:'] = ': المواضيع';
$Definition['Alliance']['pop'] = 'سكان';
$Definition['Alliance']['Villages'] = 'القرى';
$Definition['Alliance']['post reply'] = 'الرد على الموضوع';
$Definition['Alliance']['created'] = 'إنشاء';
$Definition['Alliance']['author'] = 'الكاتب';
$Definition['Alliance']['messages'] = 'الرسائل';
$Definition['Alliance']['reply'] = 'رد';
$Definition['Alliance']['vote'] = 'تصويت';
$Definition['Alliance']['to result'] = 'اضهار النتائج';
$Definition['Alliance']['to survey'] = 'الى الإستطلاع';
$Definition['Alliance']['name'] = 'الاسم';
$Definition['Alliance']['addLine'] = 'إضافة';
$Definition['Alliance']['New Thread'] = 'موضوع جديد';
$Definition['Alliance']['Post new thread'] = 'اضافة موضوع جديد';
$Definition['Alliance']['Thread'] = 'موضوع';
$Definition['Alliance']['Report'] = 'أبلغ عن';
$Definition['Alliance']['Coordinates'] = 'الإحداثيات';
$Definition['Alliance']['report'] = 'ابلغ';
$Definition['Alliance']['Troops'] = 'القوات';
$Definition['Alliance']['Vote_options'] = 'خيارات التصويت';
$Definition['Alliance']['Survey'] = 'الإستطلاع';
$Definition['Alliance']['ends on'] = 'ينتهي في';
$Definition['Alliance']['open_topic'] = 'فتح موضوع';
$Definition['Alliance']['close_topic'] = 'اغلاق موضوع';
$Definition['Alliance']['stick_topic'] = 'اظهار لموضوع';
$Definition['Alliance']['unstick_topic'] = 'اخفاء الموضوع';
$Definition['Alliance']['preview'] = 'عرض';
$Definition['Alliance']['underline'] = 'تسطير';
$Definition['Alliance']['Player'] = 'اللاعب';
$Definition['Alliance']['Alliance ID'] = 'معرف التحالف';
$Definition['Alliance']['ally_list_headline'] = 'مفتوح للتحالفات الأخرى :';
$Definition['Alliance']['sitters_allowed'] = 'مسموح للمتحالفين';
$Definition['Alliance']['open forum for the following alliances'] = 'مفتوح للتحالفات التالية';
$Definition['Alliance']['edit forum'] = 'تعديل المنتدى';
$Definition['Alliance']['create_in_area'] = 'الخصوصية';
$Definition['Alliance']['public_forum'] = 'منتدى عام';
$Definition['Alliance']['forum_name'] = 'اسم المنتدى';
$Definition['Alliance']['new_forum'] = 'منتدى جديد';
$Definition['Alliance']['desc'] = 'الوصف';
$Definition['Alliance']['alliance_forum'] = 'منتدى التحالف';
$Definition['Alliance']['conf_forum'] = 'منتدى المتحالفين';
$Definition['Alliance']['closed_forum'] = 'منتدى مغلق';
$Definition['Alliance']['Tag'] = 'رمز';
$Definition['Alliance']['Forum name'] = 'اسم المنتدى';
$Definition['Alliance']['Threads'] = 'المواضيع';
$Definition['Alliance']['Last post'] = 'اخر المواضيع';
$Definition['Alliance']['to the top'] = 'إلى الاعلى';
$Definition['Alliance']['to the bottom'] = 'إلى الأسفل';
$Definition['Alliance']['Delete'] = 'حذف';
$Definition['Alliance']['Confirm deletion?'] = 'تأكيد الحذف ؟';
$Definition['Alliance']['show last post'] = 'عرض اخر المشاركات';
$Definition['Alliance']['edit'] = 'تعديل';
$Definition['Alliance']['thread without new entries'] = 'لا تتوفر مشاركات جديدة للموضوع';
$Definition['Alliance']['thread with new entries'] = 'تتوفر مشاركات جديدة للموضوع';
$Definition['Alliance']['noForum'] = 'لم يتم إنشاء اي منتدى حتى الآن';
$Definition['Alliance']['switch admin'] = 'تبديل المشرف';
$Definition['Alliance']['switch non admin'] = 'تبديل غير المشرف';
$Definition['Alliance']['set x as favor tab'] = 'تعيين %s علامة التبويب مفضلة';
$Definition['Alliance']['This tab is set as favourite'] = 'تم تعيين علامة التبويب هذه كـ مفضلة';
$Definition['Alliance']['Overview'] = 'نظرة عامه';
$Definition['Alliance']['NewForum'] = 'منتدى جديد';
$Definition['Alliance']['Attacks'] = 'الهجمات';
$Definition['Alliance']['Bonuses'] = 'Bonuses';
$Definition['Alliance']['Forum'] = 'المنتدى';
$Definition['Alliance']['Options'] = 'الخيارات';
$Definition['Alliance']['Profile'] = 'اللاعبين';
$Definition['Alliance']['Alliance'] = 'التحالف';
$Definition['Alliance']['no Alliance'] = 'لا يوجد تحالف';
$Definition['Alliance']['You are currently not in an alliance In order to join an alliance, you need a level 1 Embassy and an invitation'] = 'انت غير منضم لإي تحالف في الوقت الحالي , يجب بناء سفارة من المستوى الأول لقبول الدعوات';
//Artefacts
$Definition['Artefacts']['numbers'] = [
    1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII',
    8 => 'VIII', 9 => 'IX', 10 => 'X',
];
$Definition['Artefacts'][2] = [
    'names' => [
        1 => 'المهندس المعماري\' صغيرة %s',
        2 => 'المهندس المعماري\' الكبيرة %s',
        3 => 'المهندس المعماري النادرة',
    ],
    'desc' => '.هذه التحفة تحمي قريتك من المقاليع ومحطمات الأبواب. من خلالها تزداد صلابة المباني وحائط المدينة %s',
];
$Definition['Artefacts'][4] = [
    'names' => [
        1 => 'تحفة القوات السريعة الصغيرة %s', 2 => 'تحفة القوات السريعة الكبيرة %s',
        3 => 'تحفة القوات السريعة النادرة',
    ],
    'desc' => '. هذه التحفة تضاعف سرعة القوات %s',
];
$Definition['Artefacts'][5] = [
    'names' => [
        1 => 'تحفة المستكشف الصغيرة %s', 2 => 'تحفة المستكشف الكبيرة %s',
        3 => 'تحفة المستكشف النادرة',
    ],
    'desc' => 'هذه التحفة تدع المستكشف الخاص بك %s قويا عن وضعه الطبيعي. جميع الكشافة المقيمين في القرية, او في الطريق الى قرية أخرة للتجسس تستفيد من هذه المكافاة. يمكنك أيضا في نقطة التجمع معرفة أنواع قوات الهجوم القادمة اليك لكن ليس عدد هذه الجنود',
];
$Definition['Artefacts'][6] = [
    'names' => [
        1 => 'تحفة إستهلاك القمح الصغيرة %s', 2 => 'تحفة إستهلاك القمح الكبيرة %s',
        3 => 'تحفة إستهلاك القمح النادرة',
    ],
    'desc' => 'هذه التحفة تقلل من كمية القمح التي تستهلكها قواتك والقوات المقيمة في قريتك
 %s;',
];
$Definition['Artefacts'][8] = [
    'names' => [
        1 => 'تحفة بناء القوات الصغيرة %s',
        2 => 'تحفة بناء القوات الكبيرة %s', 3 => 'تحفة بناء القوات النادرة',
    ],
    'desc' => ' هذة االتحفة تقلل من المدة الزمنية لتدريب القوّات في السكن/القصر، الثكنة، الاسطبل والمصانع الحربية %s;',
];
$Definition['Artefacts'][9] = [
    'names' => [
        1 => 'تحفة المخزن الكبير الصغيرة %s', 2 => 'تحفة المخزن الكبير الكبيرة %s',
    ],
    'desc' => 'تمكّنك مخططات البناء من تشييد المخازن الكبيرة ومخازن الحبوب الكبيرة. وهي ضرورية أيضاً لرفع مستويات هذه المخازن بعد التشييد',
];
$Definition['Artefacts'][10] = [
    'names' => [
        1 => 'تحفة المخبأ الصغيرة %s', 2 => 'تحفة المخبأ الكبيرة %s',
        3 => 'تحفة المخبأ النادرة',
    ], "desc" => nl2br("تزيد هذه التحفة من سعة المخابئ %s ميزة إضافية: لن تستطيع المقاليع اختيار أهدافها في القرى الواقعة تحت تأثير هذه التحفة وستضرب عشوائياً عليها فقط!. يستثنى من ذلك في حالة التحف تأثير القرى والعضوية: أعجوبة العالم والخزنات. في التحف النادرة تستثنى أعجوبة العالم فقط"),
];
$Definition['Artefacts'][11] = [
    'names' => [
        1 => 'تحفة الجوكر الصغيرة', 3 => 'تحفة الجوكر النادرة',
    ],//no desc for this one.
];
$Definition['Artefacts'][12] = [
    'name' => 'خريطة بناء معجزة العالم',
    'desc' => 'تسمح لك هذه التحفة برفع مستويات المعجزة حتى مستوى 51 , من ثم أنت بحاجه لتحفة آخرى لدى احد لاعبي التحالف لكي تستمر في رفع مستويات المعجزة',
    //no desc for this one.
];
//Auction
$Definition['Auction']['notEnoughGold'] = 'ليس لديك ما يكفي من الذهب';
$Definition['Auction']['autoCorrect'] = 'تم التصحيح تلقائياً';
$Definition['Auction']['disabledSubmitTooltip'] = 'لم يتم إدخال عدد الذهب';
$Definition['Auction']['disabledSubmitTooltip2'] = 'انت بحاجه لـ200 فضه على الأقل';
$Definition['Auction']['enabledSubmitTooltip'] = 'تبادل';
$Definition['Auction']['enabledSubmitTooltip2'] = 'مبادلة الذهب إلى الفضة';
$Definition['Auction']['maxAmountTooltip'] = 'شراء الذهب';
$Definition['Auction']['exchange'] = 'مبادلة';
$Definition['Auction']['Exchange'] = 'مبادلة';
$Definition['Auction']['silverExchange'] = 'مكتب الصرافة';
$Definition['Auction']['sitterError'] = 'لا يمكنك الوصول الى المزايدات وانت وكيل';
$Definition['Auction']['deletionError'] = 'لا يمكنك الوصول الى المزايدات \ العضوية تحت الحذف';
$Definition['Auction']['yes'] = 'نعم';
$Definition['Auction']['no'] = 'لا';
$Definition['Auction']['Confirm sale:'] = ': تـأكيد البيع';
$Definition['Auction']['You can only have x auctions at a time'] = 'يمكنك الحصول على %s مزايدات في المرة الواحدة';
$Definition['Auction']['10AdventuresError'] = 'يجب عليك إنهاء 10 مغامرات للبدء بإستخدام المزايدات';
$Definition['Auction']['Finish 10 adventures to unlock the auctions!'] = 'يجب عليك إنهاء 10 مغامرات للبدء بإستخدام المزايدات';
$Definition['Auction']['Choose an item to sell An auction can last up to x hours'] = 'اختيار بند للبيع يمكن للمزاد ان يستمر حتى %s ساعه ';
$Definition['Auction']['Finished auctions'] = 'انتهى المزاد';
$Definition['Auction']['AuctionNotFound'] = 'لم يتم العثور على المزاد';
$Definition['Auction']['Really sell this item?'] = 'هل تريد بالفعل بيع هذا البند ؟';
$Definition['Auction']['Sell [AMOUNT] units?'] = 'بيع [AMOUNT] وحدات ؟';
$Definition['Auction']['Not enough items available for auction ([MIN_AMOUNT] items)'] = 'لا يتوفر الحد الأدنى ([MIN_AMOUNT] وحدات )';
$Definition['Auction']['Do you want to sell this horse for 100 silver?'] = 'هل تريد بيع الحصان مقابل 100 من الفضة ؟';
$Definition['Auction']['You cannot sell your horse!'] = '! لا يمكنك بيع حصانك';
$Definition['Auction']['AuctionFinished'] = 'انتهى هذا المزاد';
$Definition['Auction']['notEnoughSilverAuctionError'] = 'لا يوجد لديك ما يكفي من الفضه انت بحاجه لـ  %s من الفضه';
$Definition['Auction']['min'] = 'لكل قطعة';
$Definition['Auction']['bidFor'] = 'مزايدة';
$Definition['Auction']['balanceSince'] = 'سجل الـ7 ايام الماضية';
$Definition['Auction']['cause'] = 'التفاصيل';
$Definition['Auction']['date'] = 'التاريخ';
$Definition['Auction']['showAccounting'] = 'عرض التفاصيل';
$Definition['Auction']['hideAccounting'] = 'اخفاء التفاصيل';
$Definition['Auction']['noBooking'] = 'لا يوجد شيء';
$Definition['Auction']['Adventure'] = 'مغامرة';
$Definition['Auction']['sell x items of y'] = 'بيع %s وحدة من %s';
$Definition['Auction']['buy x items of y'] = 'شراء %s بند من %s';
$Definition['Auction']['currentBid'] = 'السعر الحالي';
$Definition['Auction']['currentBidder'] = 'المزايد الحالي';
$Definition['Auction']['notEnoughSilver'] = 'الفضة لا تكفي';
$Definition['Auction']['desc'] = 'الوصف';
$Definition['Auction']['clock'] = 'ساعات';
$Definition['Auction']['bid'] = 'المزايدات';
$Definition['Auction']['noAuction'] = 'لا يوجد شيء';
$Definition['Auction']['Change'] = 'مزايدة';
$Definition['Auction']['del'] = 'حذف';
$Definition['Auction']['select all'] = 'تحديد الكل';
$Definition['Auction']['won'] = 'فزت';
$Definition['Auction']['outbid'] = 'تمت المزايدة عليك';
$Definition['Auction']['reserve'] = 'حجز';
$Definition['Auction']['balance'] = 'الرصيد';
$Definition['Auction']['running'] = 'جاري';
$Definition['Auction']['x unit perItem'] = 'x وحدة لك وحدة';
$Definition['Auction']['buy'] = 'شراء';
$Definition['Auction']['sell'] = 'بيع';
$Definition['Auction']['bids'] = 'مزايدات';
$Definition['Auction']['doBid'] = 'مزايدة';
$Definition['Auction']['accounting'] = 'حسابي';
$Definition['Auction']['cancelled'] = 'المغلقة';
$Definition['Auction']['finished'] = 'المنتهية';
$Definition['Auction']['filterFor'] = 'تصفية حسب';
$Definition['Auction']['silver'] = 'الفضة';
$Definition['Auction']['helmet'] = 'الخوذ';
$Definition['Auction']['body'] = 'دروع الجسم';
$Definition['Auction']['leftHand'] = 'اليد اليسرى';
$Definition['Auction']['rightHand'] = 'اليد اليمنى';
$Definition['Auction']['shoes'] = 'الأحذية';
$Definition['Auction']['horse'] = 'الأحصنة';
$Definition['Auction']['cage'] = 'الأقفاص';
$Definition['Auction']['scroll'] = 'المخطوطات';
$Definition['Auction']['ointment'] = 'دهن الشفاء';
$Definition['Auction']['bandage25'] = 'الضمادات الصغيرة';
$Definition['Auction']['bandage%s'] = 'الضمادات الكبيرة';
$Definition['Auction']['bucketOfWater'] = 'إكسير الحياة';
$Definition['Auction']['bookOfWisdom'] = 'كتاب الحكمة';
$Definition['Auction']['lawTables'] = 'لوائح القانون';
$Definition['Auction']['artWork'] = 'القطع الفنية';
//BBCode
$Definition['BBCode']['this player is registered at x'] = 'هذا اللاعب سجل في هذا العالم %s';
$Definition['BBCode']['this player is under protection to x'] = 'اللاعب تحت حماية المبتدئين %s';
$Definition['BBCode']['x has refused a confederacy to y'] = '%s لقد رفض التحالف %s.';
$Definition['BBCode']['x has refused nap to y'] = '%s لقد رفض ميثاق عدم الإعتداء %s.';
$Definition['BBCode']['x has refused war to y'] = '%s لقد رفض إعلان الحرب %s.';
$Definition['BBCode']['confederacies with'] = 'التحالف مع';
$Definition['BBCode']['non-aggression pact(s) with'] = ' عدم إعتداء مع';
$Definition['BBCode']['at war(s) with'] = 'في الحرب مع';
$Definition['BBCode']['Forum'] = 'المنتدى';
$Definition['BBCode']['News'] = 'الأخبار';
$Definition['BBCode']['Strength of own alliance'] = 'قوة التحالف الخاص بك';
$Definition['BBCode']['X kicked Y from Alliance'] = '%s طُرد %s من التحالف';
$Definition['BBCode']['Fighting points (difference to yesterday)'] = 'نقاط القتال (الفرق عن الأمس)';
$Definition['BBCode']['troops destroyed by alliance Ally'] = 'القوات التي دمرها التحالف %s';
$Definition['BBCode']['resources stolen by alliance Ally'] = 'الموارد التي نهبها التحالف %s';
$Definition['BBCode']['troops destroyed of alliance Ally'] = 'القوات المدمرة من التحالف %s';
$Definition['BBCode']['resources stolen of alliance Ally'] = 'الموارد المنهوبة من التحالف %s';
$Definition['BBCode']['This alliance cannot be found'] = 'لم يتم العثور على التحالف';
$Definition['BBCode']['latest postings on forum'] = 'أحدث المشاركات في المنتدى';
$Definition['BBCode']['Alliance Events'] = 'أحداث التحالف';
$Definition['BBCode']['X joined Alliance'] = '%s انضم إلى التحالف';
$Definition['BBCode']['X left Alliance'] = '%s غادر التحالف';
$Definition['BBCode']['X created new village'] = '%s أنشئ قرية جديدة ';
$Definition['BBCode']['X invited Y'] = '%s قام بدعوة %s الى التحالف  ';
$Definition['BBCode']['x has offered a confederacy to y'] = '%s عرض التحالف مع %s';
$Definition['BBCode']['x has offered war to y'] = '%s اعلن الحرب على %s';
$Definition['BBCode']['x has offered nap to y'] = '%s عرض ميثاق إعتداء مع %s';
$Definition['BBCode']['x has accepted a confederacy to y'] = '%s قبل التحالف ';
$Definition['BBCode']['x has accepted nap to y'] = '%s قبل ميثاق الإعتداء';
$Definition['BBCode']['x has accepted war to y'] = '%s قبل إعلان الحرب';
$Definition['BBCode']['Losses compared to alliance'] = 'الخسائر مقارنة مع تحالف %s';
$Definition['BBCode']['attack'] = 'الهجوم';
$Definition['BBCode']['defense'] = 'الدفاع';
//Buildings
$Definition['Buildings']['increase warehouse storage by level 20 storage value'] = 'رفع مستودع الخام لمستوى 20';
$Definition['Buildings']['increase granny storage by level 20 storage value'] = 'رفع مستودع القمح لمستوى 20';
$Definition['Buildings']['Alliance Founder'] = 'مؤسس التحالف';
$Definition['Buildings']['Alliance'] = 'التحالف';
$Definition['Buildings']['to the alliance'] = 'إلى التحالف';
$Definition['Buildings']['Tag'] = 'الرمز';
$Definition['Buildings']['Name'] = 'الاسم';
$Definition['Buildings']['FoundAlliance'] = 'تم العثور على التحالف';
$Definition['Buildings']['accept'] = 'تـأكيد';
$Definition['Buildings']['refuse'] = 'رفض';
$Definition['Buildings']['ww_change_name_desc'] = 'معجزة العالم';
$Definition['Buildings']['allianceFull'] = 'هذا التحالف وصل للحد الأعلى لضم اللاعبين';
$Definition['Buildings']['Enter Tag'] = 'إضافة رمز';
$Definition['Buildings']['Tag exists'] = 'الرمز موجود';
$Definition['Buildings']['Enter Name'] = 'إدخال إسم';
$Definition['Buildings']['Join alliance'] = 'إلى التحالف';
$Definition['Buildings']['There are no invitations available'] = 'لا توجد دعوات في الوقت الحالي';
$Definition['Buildings']['Buildings'] = 'بناء';
$Definition['Buildings']['onOffLevelSwitch'] = 'إظهار/إخفاء مستويات المباني';
$Definition['Buildings']['maxMasterBuilderReached'] = 'يمكن ان يكون لديك  %s فقط أوامر البناء في المبنى الرئيسي';
$Definition['Buildings']['enoughResourcesAt'] = 'ستتوفر الموارد اللازمة %s';
$Definition['Buildings']['constructBuilding'] = 'بناء مبنى';
$Definition['Buildings']['upgradeBuilding'] = 'الترقية إلى المستوى %s';
$Definition['Buildings']['waitLoop'] = 'انتظار';
$Definition['Buildings']['workersBusy'] = 'العمال مشغولون حالياً';
$Definition['Buildings']['enoughResourcesAtNever'] = 'القمح لديك بالسالب , يجب عليك رفع حقل قمح';
$Definition['Buildings']['(not possible)'] = '(غير ممكن)';
$Definition['Buildings']['finishNow']['finishNow'] = 'بناء على الفور';
$Definition['Buildings']['mainBuilding']['Demolish building'] = 'هدم المباني';
$Definition['Buildings']['mainBuilding']['demolish_desc'] = 'إن لم تكن بحاجة لمبنى يمكنك هدمة من هنا';
$Definition['Buildings']['mainBuilding']['demolish'] = 'هدم';
$Definition['Buildings']['mainBuilding']['Demolish completely'] = 'الهدم بالكامل';
$Definition['Buildings']['mainBuilding']['complete_demolish_title'] = 'هدم المبنى المحدد ؟ سيتم حذفه نهائياً من القرية';
$Definition['Buildings']['buildingQueue']['buildingQueue'] = 'بناء بالإنتظار';
$Definition['Buildings']['buildingQueue']['name'] = 'ترافيان بلاس';
$Definition['Buildings']['buildingQueue']['desc'] = 'ترافيان بلاس يتيح لك بناء مبنيين في نفس الوقت بدلا من مبنى واحد';
$Definition['Buildings']['newBuilding']['Infrastructure'] = 'البنية التحتية';
$Definition['Buildings']['newBuilding']['Military'] = 'مباني الجيش';
$Definition['Buildings']['newBuilding']['Resources'] = 'مباني الموارد';
$Definition['Buildings']['Infrastructure'] = 'بنية تحتية';
$Definition['Buildings']['Military'] = 'مبنى الجيش';
$Definition['Buildings']['resources'] = 'مبنى الموارد';
$Definition['Buildings']['costsForUpgradeToLvl'] = '<b>التكلفة</b> للترقية للمستوى %s';
$Definition['Buildings']['costs'] = 'التكلفة';
$Definition['Buildings']['errors']['foodShortage'] = 'نقص الغذاء';
$Definition['Buildings']['errors']['upgradeWareHouse'] = 'ترقية مستودع الخام';
$Definition['Buildings']['errors']['upgradeGranny'] = 'ترقية مستودع الحبوب';
$Definition['Buildings']['errors']['constructWarehouse'] = 'بناء مستودع الخام';
$Definition['Buildings']['errors']['constructGranny'] = 'بناء مستودع الحبوب';
$Definition['Buildings']['errors']['noGreatArtefact'] = 'انت بحاجه لتحفة المخزن لبناء هذا النوع من المخازن , او يمكنك بناءة داخل قرية المعجزة بدون الحاجة إلى تحفة';
$Definition['Buildings']['errors']['wwPlans'] = '
لا يمكن بناء معجزة العالم إلا في إحدى القرى التتارية القديمة. ومع ذلك، فإن مخطط البناء ضروري أيضا. بدءا من 0 الى المستوى 51، هناك حاجة إلى مخطط واحد اضافي بعد مستوى 50 . المخطط الثاني يجب أن يكون مملوك من قبل لاعب آخر في نفس التحالف.';
$Definition['Buildings']['construct_with_master_builder'] = 'البناء بمساعدة البناء';
$Definition['Buildings']['constructNewBuilding'] = 'بناء مبنى جديد';
$Definition['Buildings']['preRequests'] = 'المتطلبات الأساسية';
$Definition['Buildings']['no_building_available'] = 'لا يمكن بناء اي مباني في الوقت الحالي<br />معظم المباني بحاجة لمتطلبات أساسية لإنشائها , أنظر الدليل';
$Definition['Buildings']['soon_available'] = 'المباني التي ستتاح قريباً';
$Definition['Buildings']['level'] = 'مستوى';
$Definition['Buildings']['upgradeNotices']['reachedMaxLvL'] = 'وصلت للمستوى الأقصى';
$Definition['Buildings']['upgradeNotices']['buildingIsOnDemolition'] = 'هذا المبنى قيد الهدم';
$Definition['Buildings']['upgradeNotices']['upCostsToLevel'] = 'تكاليف الترقية إلى مستوى';
$Definition['Buildings']['upgradeNotices']['currentlyUpgradingToLevel'] = 'الترقية الحالية %s';
$Definition['Buildings']['upgradeNotices']['currentlyReachingMaxLevel'] = '%s جاري رفع المبنى للمستوى النهائي';
$Definition['Buildings']['masterBuilder']['masterBuilder'] = 'البناء';
$Definition['Buildings']['masterBuilder']['atStartOfConstruction'] = 'في بداية البناء';
$Definition['Buildings']['buildingSites']['rallyPoint'] = 'موقع نقطة التجمع';
$Definition['Buildings']['buildingSites']['building'] = 'منطقة بناء';
$Definition['Buildings']['buildingSites']['WorldWonder'] = 'موقع المعجزة';
$Definition['Buildings'][1]['title'] = 'الحطاب';
$Definition['Buildings'][1]['desc'] = 'الحطّاب يقوم بقطع الأشجار لإنتاج الخشب. كلما تم تطوير الحطاب، يزداد إنتاج الخشب';
$Definition['Buildings'][1]['current_prod'] = 'الإنتاج الحالي';
$Definition['Buildings'][1]['next_prod'] = 'الإنتاج على مستوى التالي';
$Definition['Buildings'][1]['unit'] = 'في الساعة';
$Definition['Buildings'][2]['title'] = 'حفرة الطين';
$Definition['Buildings'][2]['desc'] = 'يستخرج الطين من حفرة الطين. كلما تم تطوير حفرة الطين، يزداد إنتاج الطين';
$Definition['Buildings'][2]['current_prod'] = 'الإنتاج الحالي';
$Definition['Buildings'][2]['next_prod'] = 'الإنتاج على مستوى التالي';
$Definition['Buildings'][2]['unit'] = 'في الساعة';
$Definition['Buildings'][3]['title'] = 'منجم الحديد';
$Definition['Buildings'][3]['desc'] = 'يُستخرج عمال المناجم مادة الحديد الثمينة من مناجم الحديد . كلما ازداد مستوى المنجم، يزداد انتاج الحديد في الساعة';
$Definition['Buildings'][3]['current_prod'] = 'الإنتاج الحالي';
$Definition['Buildings'][3]['next_prod'] = 'الإنتاج على المستوى التالي';
$Definition['Buildings'][3]['unit'] = 'في الساعة';
$Definition['Buildings'][4]['title'] = 'حقول القمح';
$Definition['Buildings'][4]['desc'] = 'في حقول القمح يتم إنتاج الغذاء لسكان القرية، كلما تم تطوير حقول القمح، يزداد إنتاج القمح';
$Definition['Buildings'][4]['current_prod'] = 'الإنتاج الحالي';
$Definition['Buildings'][4]['next_prod'] = 'الإنتاج على المستوى التالي';
$Definition['Buildings'][4]['unit'] = 'في الساعة';
$Definition['Buildings'][5]['title'] = 'معمل النجارة';
$Definition['Buildings'][5]['desc'] = 'في معمل النجارة يتم معالجة الخشب. كلما إرتفع مستوى المعمل، يزداد إنتاج الخشب ليصل إلى 25 في المائة';
$Definition['Buildings'][5]['current_prod'] = 'زيادة الإنتاج في الوقت الحالي';
$Definition['Buildings'][5]['next_prod'] = 'الزيادة على المستوى التالي';
$Definition['Buildings'][5]['unit'] = '%';
$Definition['Buildings'][6]['title'] = 'مصنع البلوك';
$Definition['Buildings'][6]['desc'] = 'في مصنع البلوك يتم تحويل الطين إلى بلوك وتبعا لتطور المبنى يزداد إنتاج الطين حتى يصل إلى 25 في المائة';
$Definition['Buildings'][6]['current_prod'] = 'زيادة الإنتاج في الوقت الحالي';
$Definition['Buildings'][6]['next_prod'] = 'الزيادة على المستوى التالي';
$Definition['Buildings'][6]['unit'] = '%';
$Definition['Buildings'][7]['title'] = 'مسبك الحديد';
$Definition['Buildings'][7]['desc'] = 'في مصنع الحديد  يتم تصنيع الحديد وتبعا لتطور المبنى يزداد إنتاج الحديد حتى  يصل إلى 25 في المائة';
$Definition['Buildings'][7]['current_prod'] = 'زيادة الإنتاج في الوقت الحالي';
$Definition['Buildings'][7]['next_prod'] = 'الزيادة على المستوى التالي';
$Definition['Buildings'][7]['unit'] = '%';
$Definition['Buildings'][8]['title'] = 'المطاحن';
$Definition['Buildings'][8]['desc'] = 'في المطاحن يتم تحويل القمح إلى دقيق وكلما ازداد تطور بناء المطحنة، يزداد إنتاج القمح إلى ما يصل حتى 25 في المائة';
$Definition['Buildings'][8]['current_prod'] = 'زيادة الإنتاج في الوقت الحالي';
$Definition['Buildings'][8]['next_prod'] = ' الزيادة على المستوى التالي';
$Definition['Buildings'][8]['unit'] = '%';
$Definition['Buildings'][9]['title'] = 'المخبز';
$Definition['Buildings'][9]['desc'] = 'في المخابز يتم تحويل الدقيق إلى خبز. كلما إرتفع مستوى تطور المخابز، يزداد إنتاج الخبز مما يرفع إنتاجية القمح حتى 50 في المائة';
$Definition['Buildings'][9]['current_prod'] = 'زيادة الإنتاج في الوقت الحالي';
$Definition['Buildings'][9]['next_prod'] = ' الزيادة على المستوى التالي';
$Definition['Buildings'][9]['unit'] = '%';
$Definition['Buildings'][10]['title'] = 'مستودع الخام';
$Definition['Buildings'][10]['desc'] = '.في المخزن يتم تخزين موارد الخشب والطين والحديد. كلما ارتفع مستوى بناء المخزن، تزداد طاقته التخزينية وعندما يمتلئ المخزن يتوقف الإنتاج إلى حين توسعته';
$Definition['Buildings'][10]['current_prod'] = 'السعة التخزينية الحالية';
$Definition['Buildings'][10]['next_prod'] = 'السعة التخزينية على المستوى التالي';
$Definition['Buildings'][10]['unit'] = 'من الموارد';
$Definition['Buildings'][11]['title'] = 'مستودع الحبوب';
$Definition['Buildings'][11]['desc'] = 'في مخزن الحبوب يتم تخزين القمح. كلما ارتفع مستوى بناء المخزن، تزداد طاقته التخزينية للقمح وعندما يمتلئ المخزن فسوف يتوقف الإنتاج إلى حين توسيعه';
$Definition['Buildings'][11]['current_prod'] = 'السعة التخزينية الحالية';
$Definition['Buildings'][11]['next_prod'] = 'السعة التخزينية على المستوى التالي';
$Definition['Buildings'][11]['unit'] = 'من الموارد';
$Definition['Buildings'][13]['title'] = 'افران صهر الحديد';
$Definition['Buildings'][13]['desc'] = 'يتم في أفران صهر الحديد تطوير أسلحة ودروع جنودك. كلما ارتفع مستوى البناء، تزداد الخيارات أمامك لتحديث تسليح القوّات';
$Definition['Buildings'][14]['title'] = 'ساحة البطولة';
$Definition['Buildings'][14]['desc'] = 'في ساحة البطولة يمكن تحسين طاقات القوات. كلما ارتفع مستوى الساحة، تزداد سرعة تحرك قواتك في المسافات التي تزيد عن عشرين حقلاً';
$Definition['Buildings'][14]['current_prod'] = 'السرعة الحالية';
$Definition['Buildings'][14]['next_prod'] = 'السرعة عند المستوى التالي';
$Definition['Buildings'][14]['unit'] = '%';
$Definition['Buildings'][15]['title'] = 'المبنى الرئيسي';
$Definition['Buildings'][15]['desc'] = 'مهندسو القرية يعيشون في المبنى الرئيسي. كلما ازداد مستوى بناء المبنى الرئيسي، تزداد سرعة إنشاء المباني الجديدة';
$Definition['Buildings'][15]['current_prod'] = 'زمن البناء الحالي';
$Definition['Buildings'][15]['next_prod'] = 'زمن البناء على المستوى التالي';
$Definition['Buildings'][15]['unit'] = '%';
$Definition['Buildings'][16]['title'] = 'نقطة التجمع';
$Definition['Buildings'][16]['desc'] = 'في نقطة التجمع تلتقي قوات القرية. من هنا يمكن إرسال القوات للهجوم أو النهب أو لتعزيز القرى الأخرى

كلما ازداد مستوى نقطة التجمّع، يزداد عدد الوحدات المكتشفة حين قدوم هجوم على القرية';
$Definition['Buildings'][17]['title'] = 'السوق';
$Definition['Buildings'][17]['desc'] = 'يمكنك المتاجرة بالمواد الخام مع اللاعبين الآخرين عن طريق السوق. كلما إرتفع مستوى السوق، تزداد كمية الموارد الممكن نقلها';
$Definition['Buildings'][18]['title'] = 'السفارة';
$Definition['Buildings'][18]['desc'] = '.السفارة هي مكان الدبلوماسيين. وكلما تطور بناء السفارة، تزداد الخيارات الدبلوماسية المتاحة للملك';
$Definition['Buildings'][19]['title'] = 'الثكنة';
$Definition['Buildings'][19]['desc'] = 'في الثكنة يتم تدريب الجنود، كلما تم تطوير الثكنة، تزداد سرعة تدريب الجنود';
$Definition['Buildings'][20]['title'] = 'الإسطبل';
$Definition['Buildings'][20]['desc'] = 'في الإسطبل يتم تدريب الفرسان. كلما ارتفع مستوى الإسطبل تزداد سرعة تدريبهم';
$Definition['Buildings'][21]['title'] = 'المصانع الحربية';
$Definition['Buildings'][21]['desc'] = 'في المصانع الحربية يمكن بناء محطمات الأبواب والمقاليع. كلما ارتفع مستوى المصانع تزداد سرعة الإنتاج';
$Definition['Buildings'][22]['title'] = 'الأكاديمية';
$Definition['Buildings'][22]['desc'] = 'في الأكاديمية يمكنك تدريب أنواع جديدة من القوات. كلما ارتفع مستوى الأكاديمة تزداد أنواع القوات التي يمكن تدريبها. بعد إتمام عمليات البحث في الأكاديمية، يمكنك تدريبهم في الثكنة أو الاسطبل أو المصانع الحربية';
$Definition['Buildings'][23]['title'] = 'المخبأ';
$Definition['Buildings'][23]['desc'] = 'في حالة الهجوم على قريتك يقوم السكان بإخفاء جزء من الموارد المتوفرة في المخازن تلقائياً في المخبأ. هذه الموارد المخفية في المخبأ لا يمكن سرقتها';
$Definition['Buildings'][23]['current_prod'] = 'حجم المخبأ الحالي';
$Definition['Buildings'][23]['next_prod'] = 'الحجم عند المستوى التالي';
$Definition['Buildings'][23]['overall_storage'] = 'الوحدات التي يمكن إخفاؤها بواسطة كل المخابئ';
$Definition['Buildings'][23]['unit'] = 'من كل مورد';
$Definition['Buildings'][24]['title'] = 'البلدية';
$Definition['Buildings'][24]['desc'] = 'يمكنك اقامة حفلات لمواطنيكم في قاعة المدينة. هذه الحفلات من تزيد عدد نقاط الثقافة

نقاط الثقافة لازمة لتأسيس او قهر القرى الجديدة. كل بناء ينتج نقاط ثقافة . خلال الحفلات يزداد انتاج نقاط ثقافة';
$Definition['Buildings'][25]['title'] = 'السكن';
$Definition['Buildings'][25]['desc'] = 'يحمي السكن القرية ضد غزوات الخصوم. يمكنك بناء سكن واحد في كل قرية. وهناك يمكن تدريبمستوطن والرؤساء';
$Definition['Buildings'][26]['title'] = 'القصر';
$Definition['Buildings'][26]['desc'] = 'القصر مبنىً فريد، حيث يمكنك تشييد قصر واحد في كل إمبراطوريتك، ويمكنك اعتبار القرية التي تحتوي القصر عاصمة لك. في القصر يمكنك تدريبمستوطن والحكماء/زعماء/الرؤساء';
$Definition['Buildings'][27]['title'] = 'الخزنة';
$Definition['Buildings'][27]['desc'] = 'في الخزنات، تُخبأ أسرار امبراطوريتك. حيث تتسع كل خزنة لتحفة واحدة فقط. يلزمك خزنة في المستوى 10 لتضع فيها تحفة. للتحف الكبرى يلزمك خزنة في المستوى 20';
$Definition['Buildings'][28]['title'] = 'المكتب التجاري';
$Definition['Buildings'][28]['desc'] = 'في المكتب التجاري يمكن تحسين العربات كذلك بخيول قوية ،كلما ازداد بناء المكتب التجاري، تزداد مقدرة التجار على حمل الموارد أكثر';
$Definition['Buildings'][28]['current_prod'] = 'الزيادة الحالية';
$Definition['Buildings'][28]['next_prod'] = 'الزيادة على المستوى التالي';
$Definition['Buildings'][28]['unit'] = '%';
$Definition['Buildings'][29]['title'] = 'الثكنة الكبيرة';
$Definition['Buildings'][29]['desc'] = 'الثكنة الكبرى تسمح بتدريب قوات اضافية. تكلفتها ثلاثة اضعاف ذلك. بالتزامن مع الثكنة العادية يمكن تكوين ضعف القوات الثكنه الكبيرة لا يمكن أن تبنى في القرية الرئيسية';
$Definition['Buildings'][30]['title'] = 'الإسطبل الكبير';
$Definition['Buildings'][30]['desc'] = 'الاسطبل الكبير يسمح بتدريب مزيد من الفرسان. تكلفة هذه القوات ثلاثة اضعاف ذلك. الاسطبل الكبير لا يمكن أن يبنى في القرية الرئيسية';
$Definition['Buildings'][31]['title'] = 'سور المدينة';
$Definition['Buildings'][31]['desc'] = 'الجدار الأرضي يحمي من الهجمات على القرية ،كلما ازداد بناء الجدار ، سيكون من الايسر علي المدافعين الكفاح بنجاح من نهب الاعداء

جدار المدينة لا يمكن ان يبنى الا من الجرمان.هذا الجدار احسن ضد محطمة الابواب من سور المدينة، ولكن للدفاع يدمر أيسر من سور المدينة أو الحباك';
$Definition['Buildings'][31]['current_prod'] = 'مكافأة الدفاع الحالية';
$Definition['Buildings'][31]['next_prod'] = 'مكافأة الدفاع على المستوى التالي';
$Definition['Buildings'][31]['unit'] = '%';
$Definition['Buildings'][32]['title'] = 'جدار المدينة';
$Definition['Buildings'][32]['desc'] = 'سور المدينة يحمي من الهجمات على القرية ،كلما ازداد بناء السور ، سيكون من الايسر علي المدافعين الكفاح بنجاح من نهب الاعداء .

سور المدينة لا يمكن ان يبنى الا من الرومان .

هذا الجدار يعطي أعلى مكافاه للدفاع ، ولكن محطمة الابواب تدمر الجدار أيسر من الجدار الأرضي أو الحباك';
$Definition['Buildings'][32]['current_prod'] = 'مكافأة الدفاع الحالية';
$Definition['Buildings'][32]['next_prod'] = 'مكافأة الدفاع على المستوى التالي';
$Definition['Buildings'][32]['unit'] = '%';
$Definition['Buildings'][33]['title'] = 'حائط المدينة';
$Definition['Buildings'][33]['desc'] = 'الحاجز يحمي من الهجمات على القرية ،كلما ازداد بناء الحاجز ، سيكون من الايسر علي المدافعين الكفاح بنجاح من نهب الاعداء

الحاجز لا يمكن ان يبنى الا من الاغريق.هذا الحباك هو متوسط بين و سور القرية والجدار الأرضي';
$Definition['Buildings'][33]['current_prod'] = 'مكافأة الدفاع الحالية';
$Definition['Buildings'][33]['next_prod'] = 'مكافأة الدفاع على المستوى التالي';
$Definition['Buildings'][33]['unit'] = '%';
$Definition['Buildings'][34]['title'] = 'الحجار';
$Definition['Buildings'][34]['desc'] = 'الحجّار خبير في قطع الحجر . ،كلما ارتفع مستوى البناءن تزداد صلابة مباني قريتك في وجه هجمات المقاليع .

ان الحجار لا يمكن ان يبنى الا في العاصمة';
$Definition['Buildings'][34]['current_prod'] = 'الإستقرار الحالي';
$Definition['Buildings'][34]['next_prod'] = 'الإستقرار على المستوى';
$Definition['Buildings'][34]['unit'] = '%';
$Definition['Buildings'][35]['title'] = 'المقهى';
$Definition['Buildings'][35]['desc'] = 'في المقهى يتم توزيع شـآهي بالنعناع، الذي يحبه أبناء الشعب كثيراً. حين يحتفل الجنود تزيد قوتهم بمعدل 1% لكل مستوى، ولكن تضعف في الوقت نفسه قدرة المقاليع على إصابة أهدافها بدقة وكذا تضعف قدرة الرؤساء على إقناع الشعوب العدوة بالانطواء تحت حكمك';
$Definition['Buildings'][36]['title'] = 'الصياد';
$Definition['Buildings'][36]['desc'] = 'الصياد يحمي قريتك جيدا بالفخاخ الخفية ، صممت لامساك المهاجمين ولابعاد الخطر عن قريتك . كل مستوى يزيد عدد الأفخاخ المتاحة   ';
$Definition['Buildings'][36]['current_prod'] = 'عدد الأفخاخ الحالي';
$Definition['Buildings'][36]['next_prod'] = 'عدد الأفخاخ على المستوى التالي';
$Definition['Buildings'][36]['unit'] = 'فخ';
$Definition['Buildings'][36]['overall_storage'] = 'إجمالي عدد الأفخاخ';
$Definition['Buildings'][37]['title'] = 'قصر البطل';
$Definition['Buildings'][37]['desc'] = 'قصر الأبطال، منزل البطل الخاص بك 

عند المستويات 10 و 15 و 20 بطلكم ان ارفاق 1 و 2 و 3 من الواحات على التوالي ، هذه الواحات زيادة انتاجهم من المواد الاولية وخاصة في ضم القرية';
$Definition['Buildings'][38]['title'] = 'مستودع الخام الكبير';
$Definition['Buildings'][38]['desc'] = 'في المستودع يتم تخزين الموارد ( الخشب والطين والحديد) . المخازن الكبرى توفر لك مساحة اكبر وتحافظ على مواردك على النحو المعتاد';
$Definition['Buildings'][38]['current_prod'] = 'السعة الحالية';
$Definition['Buildings'][38]['next_prod'] = 'السعة على المستوى التالي';
$Definition['Buildings'][38]['unit'] = 'من الموارد';
$Definition['Buildings'][39]['title'] = 'مستودع الحبوب الكبير';
$Definition['Buildings'][39]['desc'] = 'في مخازن القمح يتم تخزين القمح المنتج من الحقول . المستودع الكبير يوفر لك مساحة اكبر ويحافظ على القمح على النحو المعتاد';
$Definition['Buildings'][39]['current_prod'] = 'السعة الحالية';
$Definition['Buildings'][39]['next_prod'] = 'السعة على المستوى التالي';
$Definition['Buildings'][39]['unit'] = 'من الموارد';
$Definition['Buildings'][40]['title'] = 'معجزة العالم';
$Definition['Buildings'][40]['desc'] = 'أعجوبة العالم تمثل قمة المفاخر الإنشائية وعروس العجائب .اللاعبون الأقوى والأغنى بالموارد هم فقط الذين يتمكنون من إنشاء مثل هذا العمل الجبار. ويتمكنون من المدافعة عنه ضد الأعداء الحاسدين

لا يمكن بناء أعجوبة العالم إلا في القرة الأثرية للناتار . وبنائها لا يمكن إلا بعد الحصول على الخريطة.
وعند المستوى 50 يجب أن يحصل لاعب أخر من نفس الحلف على الخريطة الثانية ليستمر البناء';
$Definition['Buildings'][41]['title'] = 'ساقية الخيول';
$Definition['Buildings'][41]['desc'] = 'بئر سقي الخيول يضمن للخيول الرفاه و يسرع في تدريبها 1 في المائة و ايضا يقلل من أستهلاك القمح للقوات التالية 1) فرقة تجسس مستوى 10 2) سلاح الفرسان مستوى 15 3) فرسان قيصر مستوى 20 لا يستطيع احد في بناء هذا البئر لسقى الخيول الا الرومان';
$Definition['Buildings'][41]['current_prod'] = 'وقت التدريب الحالي';
$Definition['Buildings'][41]['next_prod'] = 'وقت التدريب على المستوى التالي';
$Definition['Buildings'][41]['unit'] = '%';
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
$Definition['combat'] = ["simulate" => "محاكاة", "مهاجم" => "مهاجم",
    "defender" => "مدافع", "number" => "عدد",
    "unit_level" => "مستوى", "other" => "اخرى",
    "Population" => "السكان",
    "catapult_target_level" => "هدف المقاليع",
    "hero_off_bonus" => "الكفائة الحربية",
    "hero_power" => "مكافأة الهجوم",
    "Palace_Resident" => "السكن / القصر",
    "loyaltyReducedBy" => "تم خفض الولاء",
    "DamageByCatapult" => "ضرر المقاليع",
    "DamageByRam" => "تخفيض", "from" => "من",
    "to" => "الى", "normal" => "كامل",
    "raid" => "نهب",
    "attack_type" => "نوع الهجوم", "troops" => "القوات",
    "casualties" => "الوفيات",
    "attack_settings" => "اعدادات الهجوم", "attack_types" => [
        1 => "الجواسيس", 2 => "كامل", 3 => "نهب",
    ],
];
//cropFinder
$Definition['cropFinder']['title'] = 'مستكشف الحقول';
$Definition['cropFinder']['Start position:'] = ': نقطة البداية';
$Definition['cropFinder']['cropper'] = 'الحقول';
$Definition['cropFinder']['both'] = 'كلا';
$Definition['cropFinder']['Type'] = 'اكتب';
$Definition['cropFinder']['any'] = 'اي';
$Definition['cropFinder']['Oasis crop bonus (at least)'] = 'مكافأة القمح: (على الأقل)';
$Definition['cropFinder']['only show unoccupied'] = ' أظهر فقط غير المأهولة';
$Definition['cropFinder']['search'] = 'بحث';
$Definition['cropFinder']['Croplands'] = 'حقول القمح';
$Definition['cropFinder']['distance'] = 'المسافة';
$Definition['cropFinder']['Position'] = 'الموقع';
$Definition['cropFinder']['Oasis'] = 'الواحات';
$Definition['cropFinder']['Occupied by'] = 'محتلة من';
$Definition['cropFinder']['Alliance'] = 'تحالف';
$Definition['cropFinder']['noRows'] = 'لم يتم العثور على قمحيات حسب الإعدادات المطلوبة';
//DailyQuest
$Definition['DailyQuest']['You`ve reached max voting limit Try again later'] = '!!!';
$Definition['DailyQuest']['Daily Quests'] = 'المهام اليومية';
$Definition['DailyQuest']['Collect daily rewards'] = 'جمع المكافآت يومياً';
$Definition['DailyQuest']['Click for details'] = 'اظغط هنا للتفاصيل';
$Definition['DailyQuest']['points'] = 'نقاط';
$Definition['DailyQuest']['Collect reward'] = 'جمع المكافآت';
$Definition['DailyQuest']['Overview'] = 'نظرة عامه';
$Definition['DailyQuest']['This account is banned'] = 'حسابك محظور';
$Definition['DailyQuest']['Congratulations! You have collected enough points to get a reward!'] = 'تهانينا! لقد قمت بتجميع نقاط كافية للحصول على مكافأة';
$Definition['DailyQuest']['For collecting x points today, you receive the following reward'] = 'عند جمع 25 نقطة، يمكنك تلقّي واحدة من المكافآت التالية:
 %s ';
$Definition['DailyQuest']['For collecting x points today, you can now collect your reward'] = 'كونك قمت بتجميع 25 نقاط/نقطة اليوم، تحصل على ما يلي %s';
$Definition['DailyQuest']['Your daily reward is determined randomly from these options'] = 'يتم تحديد المكافأة اليومية بشكل عشوائي من هذه الخيارات
';
$Definition['DailyQuest']['reward_25%_desc'] = 'من خلال جمع 25 نقطة سوف تتلقى واحدة من المكافآت التالية:
<br />
 <ul>
<li>+' . calculate_dailyquest_bonus(200, 'res') . ' من الموارد من كل نوع</li>
<li>+' . calculate_dailyquest_bonus(50, 'exp') . '  نقطة خبرة للبطل</li>
<li>+' . calculate_dailyquest_bonus(50, 'cp') . ' نقطة حضارية</li>
<li>+' . calculate_dailyquest_bonus(1000, 'res') . ' من نوع واحد من الموارد</li>
</ul>';
$Definition['DailyQuest']['you collected x points today!'] = 'قمت بتجميع %s نقطة اليوم';
$Definition['DailyQuest']['Your Reward:'] = 'مكافأتك';
$Definition['DailyQuest']['reward_25%_rows'][] = '<li> +' . calculate_dailyquest_bonus(200, 'res') . ' من الموارد من كل نوع</li>';
$Definition['DailyQuest']['reward_25%_rows'][] = '<li> +' . calculate_dailyquest_bonus(50, 'exp') . ' نقطة خبرة للبطل</li>';
$Definition['DailyQuest']['reward_25%_rows'][] = '<li>+' . calculate_dailyquest_bonus(50, 'cp') . ' نقطة حضارية</li>';
$Definition['DailyQuest']['reward_25%_rows'][] = '<li>+' . calculate_dailyquest_bonus(1000, 'res') . ' من نوع واحد من الموارد</li>';
$Definition['DailyQuest']['x points achieved'] = '%s نقاط جمعت';
$Definition['DailyQuest']['reward_50%_desc'] = 'من خلال جمع 50 نقطة سوف تتلقى واحدة من المكافآت التالية:
<br />
 <ul>
<li> +'.calculate_dailyquest_bonus(86400, 'plus').' من بلاس</li>
<li> +'.calculate_dailyquest_bonus(86400, 'productionBoost').' +25% على انتاج الخشب لمدة يوم واحد</li>
<li> +'.calculate_dailyquest_bonus(86400, 'productionBoost').' +25% على انتاج الطين لمدة يوم واحد</li>
<li> +'.calculate_dailyquest_bonus(86400, 'productionBoost').' +25% على الحديد لمدة يوم واحد</li>
<li> +'.calculate_dailyquest_bonus(86400, 'productionBoost').' +25% على إنتاج القمح لمدة يوم واحد</li>
</ul>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li> +'.calculate_dailyquest_bonus(86400, 'plus').'واحد على بلس</li>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li> +'.calculate_dailyquest_bonus(86400, 'productionBoost').'+25% انتاج الخشب</li>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li> +'.calculate_dailyquest_bonus(86400, 'productionBoost').'+25% انتاج الطين</li>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li> +'.calculate_dailyquest_bonus(86400, 'productionBoost').'+25% انتاج الحديد</li>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li> +'.calculate_dailyquest_bonus(86400, 'productionBoost').'+25% انتاج القمح</li>';
$Definition['DailyQuest']['reward_75%_desc'] = 'من خلال جمع 75 نقطة سوف تتلقى واحدة من المكافآت التالية:
<br />
 <ul>
<li>+5 دهن الشفاء</li>
<li>+5 لوائح القانون</li>
<li>+5 ضماد صغير </li>
<li>+5 قفص</li>
<li>+1 مغامرة إضافية</li>
</ul>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(5, 'item') . ' دهن شفاء</li>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(5, 'item') . ' لوائح قانون</li>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(5, 'item') . ' ضمادات صغيرة </li>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(5, 'item') . ' اقفاص</li>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(1, 'adv') . ' اضافة مغامرة</li>';
$Definition['DailyQuest']['reward_100%_desc'] = 'من خلال جمع 100 نقطة سوف تتلقى واحدة من المكافآت التالية:
<br />
 <ul>
<li>+' . calculate_dailyquest_bonus(400, 'cp') . ' نقطة حضارية</li>
<li>+' . calculate_dailyquest_bonus(2000, 'res') . ' من نوع واحد من الموارد</li>
<li>+' . calculate_dailyquest_bonus(400, 'exp') . ' نقطة خبرة للبطل</li>
<li>+' . calculate_dailyquest_bonus(4000, 'res') . ' من كل مورد</li>
</ul>';
$Definition['DailyQuest']['reward_100%_rows'][] = '<li>+' . calculate_dailyquest_bonus(400, 'cp') . ' نقطة حضارية</li>';
$Definition['DailyQuest']['reward_100%_rows'][] = '<li>+' . calculate_dailyquest_bonus(20000, 'res') . ' من نوع واحد من الموارد</li>';
$Definition['DailyQuest']['reward_100%_rows'][] = '<li>+' . calculate_dailyquest_bonus(400, 'exp') . ' نقطة خبرة للبطل</li>';
$Definition['DailyQuest']['reward_100%_rows'][] = '<li>+' . calculate_dailyquest_bonus(4000, 'res') . ' من كل مورد</li>';
$Definition['DailyQuest']['Receive these free rewards every day!'] = 'تلقي هذه المكافآت المجانية كل يوم!';
$Definition['DailyQuest']['nextResetDesc'] = 'إعادة الضبط التالي عند الساعه %s  تأكد من جمع نقاط قبل ذلك';
$Definition['DailyQuest']['Quest is complete for today'] = 'أكمل البحث اليوم';
$Definition['DailyQuest']['Quest is still open'] = 'التجميع لا زال مستمر';
$Definition['DailyQuest']['Difficulty'] = 'الصعوبة';
$Definition['DailyQuest']['Requirement'] = 'المتطلبات';
$Definition['DailyQuest']['Overview'] = 'نظرة عامة';
$Definition['DailyQuest']['This quest is worth + x points'] = 'تستحق هذه المهة + %s نقطة';
$Definition['DailyQuest']['Points granted for this quest: + x / y'] = 'النقاط الممنوحة في هذه المهمة + %s / %s';
$Definition['DailyQuest']['The points for this quest can be achieved x times per day'] = 'هذه المهمة يمكنك تحقيقها %s مرات في اليوم';
$Definition['DailyQuest']['Difficulties'] = [
    "challenging" => 'تحدي', "hard" => 'صعبة', "moderate" => 'معتدلة',
];
$Definition['DailyQuest']['questData'] = [
    1 => [
        'name' => 'انهاء مغامرة', 'desc' => 'أرسل بطلك في مغامرة. تعتبر هذه المهمّة منجزة حالما يصل بطلك إلى مكان مغامرته، حتى لو فشل في العودة إلى القرية.
لإرسال البطل في مغامرة، اضغط فقط على الأيقونة الظاهرة على الصورة.
النقاط التي يمكنك كسبها في هذه المهمّة هي 1 مرّات في اليوم',
        'difficulty' => 'moderate', 'Requirement' => 'مغامرة متاحة',
    ], 2 => [
        'name' => 'نهب واحة غير مملوكة', 'desc' => 'أرسل قواتك للنهب من واحة غير محتلّة. تعتبر هذه المهمّة منجَزة، حالما تصل قواتك للواحة بغض النظر عن نجاتهم في هذه المهمّة وعودتهم للقرية أو لا. استخدام الأقفاص في هذه المهمّة لتجنّب القتال وفقدان القوّات سيؤدي إلى عدم منحك لأي نقطة في هذه المهمّة.
يمكنك استخدام محاكي المعركة قبل إرسال القوات لمعركة نتيجة تقريبية للمعركة. تجد محاكي المعركة في نقطة التجمّع في مركز القرية.
النقاط التي يمكنك كسبها في هذه المهمّة هي 3 مرّات في اليوم',
        'difficulty' => 'hard', 'Requirement' => 'بعض القوات',
    ], 3 => [
        'name' => 'نهب/مهاجمة قرية نتار', 'desc' => 'أرسل قواتك لنهب /لمهاجمة قرية نتارية. تعتبر هذه المهمّة منجَزة، حالما تصل قواتك للقرية بغض النظر عن نجاتهم في هذه المهمّة وعودتهم لقريتك أو لا
لا تحاول ابداً نهب/مهاجمة قرية أعجوبة العالم أو عاصمة النتار. من أجل مهاجمة قرية أعجوبة العالم ينبغي عليك حشر ما لا يقلّ عن 100 ألف مقاتل!
النقاط التي يمكنك كسبها في هذه المهمّة هي 3 مرّات في اليوم
<br />', 'difficulty' => 'challenging', 'Requirement' => 'بعض القوات',
    ], 4 => [
        'name' => 'فُز بمزاد', 'desc' => 'شارك في مزاد وفُز مرتين بشراء الغرض الذي تريده وبذلك تستطيع جمع المزيد من النقاط التي يمكنك إضافتها لرصيدك اليومي!
يتم منحك النقاط فقط حين تستطيع كسب المزاد وشراء الغرض

النقاط التي يمكنك كسبها في هذه المهمّة هي 1 مرّات في اليوم
<br />', 'difficulty' => 'challenging',
        'Requirement' => 'إنهاء 10 مغامرات',
    ], 5 => [
        'name' => 'اكسب أو أنفق الذهب', 'desc' => 'قم بكسب او إنفاق الذهب لإكمال هذه المهمة , يمكنك إنهاء 3 مهمات كل يوم
<br />', 'difficulty' => 'moderate', 'Requirement' => 'ذهب',
    ], 6 => [
        'name' => 'قم بتطوير مبنى', 'desc' => 'قم بتطوير او بناء 3 مباني , يمكنك إنهاء 3 مهمات كل يوم
<br />', 'difficulty' => 'moderate', 'Requirement' => 'موارد',
    ], 7 => [
        'name' => 'قم بتطوير حقل موارد', 'desc' => 'قم بتطوير او بناء 3 حقول من الموارد , يمكنك إنهاء 3 مهمات كل يوم
<br />', 'difficulty' => 'moderate', 'Requirement' => 'موارد',
    ], 8 => [
        'name' => 'تدريب 20 وحدة من نوع المشاة', 'desc' => 'قم بتدريب 20 وحدة من نوع المشاة دفعة واحدة , يمكنك إنهاء 3 مهمات كل يوم
<br />', 'difficulty' => 'moderate', 'Requirement' => 'ثكنة + موارد',
    ], 9 => [
        'name' => 'تدريب 20 وحدة من نوع الفرسان', 'desc' => 'قم بتدريب 20 وحدة من نوع الفرسان دفعة واحدة , يمكنك إنهاء 3 مهمات كل يوم
<br />', 'difficulty' => 'moderate', 'Requirement' => 'إسطبل + موارد',
    ], 10 => [
        'name' => 'قم بعمل احتفال كبير أو احتفال صغير', 'desc' => '
قم بعمل احتفال كبير أو احتفال صغير في البلدية.
سيتم احتساب النقاط حالما تقوم بتفعيل أي احتفال في قريتك. الاحتفالات الجارية حالياً في القرية لا تحسب لك ولا تمنحك أي نقاط.
النقاط التي يمكنك كسبها في هذه المهمّة هي 3 مرّات في اليوم
<br/>
سيتم منحك النقاط فور بدء احتفال<br/>', 'difficulty' => 'hard', 'Requirement' => 'بلدية + موارد',
    ],
    11 => [
        'name' => 'Contribute 1000 resources to an alliance bonus', 'desc' => 'To support your alliance you can contribute resources to an alliance bonus. Once your alliance collected enough contributions to unlock or level up an alliance bonus, the whole alliance benefits from its effect. This quest is accomplished once you\'ve contributed to any alliance bonus.', 'difficulty' => 'challenging', 'Requirement' => 'Alliance membership',
    ],
];
$Definition['DailyQuest']['VotingSystemTitle'] = '! كسب الذهب مجاناً';
$Definition['DailyQuest']['Vote'] = 'تصويت';
$Definition['DailyQuest']['VoteRewardDesc'] = 'كل تصويت 10 من الذهب <img class="gold" src="img/x.gif"> هدية لك';
$Definition['DailyQuest']['Earn free gold!!!'] = 'إكسب الذهب مجاناً';
$Definition['DailyQuest']['Click on Consultant to open Hints page'] = 'انقر على المستشار لفتح صفحة التلميحات';
$Definition['DailyQuest']['if you abuse the vote system you will be banned'] = 'إذا اسأت إستخدام التصويت سيتم حظرك';
$Definition['DailyQuest']['voteQuestDescription'] = 'يمكنك كسب بعض الذهب مجانا من خلال استكمال عملية التصويت <br> يجب النقر على الصورة أدناه ليتم التصويت عليها';
//Dorf1
$Definition['Dorf1']['units'] = 'القوات';
$Definition['Dorf1']['none'] = ' لا شيء';
$Definition['Dorf1']['production']['production per hour'] = 'الإنتاج في الساعة';
$Definition['Dorf1']['production']['resources'][1] = ' الخشب';
$Definition['Dorf1']['production']['resources'][2] = ' الطين';
$Definition['Dorf1']['production']['resources'][3] = ' الحديد';
$Definition['Dorf1']['production']['resources'][4] = ' القمح';
$Definition['Dorf1']['production']['productionBoostButton'] = 'مزيد من المعلومات عن زيادة الإنتاج';
$Definition['Dorf1']['movements']['incoming'] = 'القوات القادمة';
$Definition['Dorf1']['movements']['outgoing'] = 'القوات المغادرة';
$Definition['Dorf1']['movements']['hour'] = 'ساعة';
$Definition['Dorf1']['movements']['in'] = 'في ';
$Definition['Dorf1']['movements']['incomingAttacksToOases'] = 'الهجمات القادمة للواحة';
$Definition['Dorf1']['movements']['incomingAttacksToMe'] = 'الهجمات القادمة';
$Definition['Dorf1']['movements']['reinforcement'] = 'تعزيز ';
$Definition['Dorf1']['movements']['incomingReinforcements'] = 'التعزيزات القادمة';
$Definition['Dorf1']['movements']['incomingReinforcementsToMyOases'] = 'التعزيزات القادمة للواحة';
$Definition['Dorf1']['movements']['outGoingAttacks'] = 'الهجمات الخاصة';
$Definition['Dorf1']['movements']['attack'] = ' هجوم ';
$Definition['Dorf1']['movements']['outGoingReinforcements'] = 'التعزيزات الخاصة';
$Definition['Dorf1']['movements']['adventure'] = 'مغامرة';
$Definition['Dorf1']['movements']['outGoingAdventure'] = 'البطل في مغامرة';
$Definition['Dorf1']['movements']['evasion'] = 'الهروب';
$Definition['Dorf1']['movements']['settlers'] = 'إستيطان';
$Definition['Dorf1']['movements']['settlersOnTheWay'] = 'المستوطنون على الطريق';
$Definition['Dorf1']['movements']['outGoingEvasion'] = 'هروب قواتي';
//embassyWhite
$Definition['embassyWhite']['embassy'] = 'السفارة';
$Definition['embassyWhite']['invites to you:'] = ': يدعوك إلى تحالف';
$Definition['embassyWhite']['max embassy level:'] = 'اقصى مستوى للسفارة :';
$Definition['embassyWhite']['construct an embassy'] = 'قم ببناء سفارة';
$Definition['embassyWhite']['Alliance forum'] = 'منتدى التحالف';
$Definition['embassyWhite']['Alliance overview'] = 'نظرة عامة على التحالف';
$Definition['embassyWhite']['no alliance'] = 'لا تحالف';
$Definition['embassyWhite']['You are currently not part of any alliance'] = 'انت حالياً لا تنتمي لإي تحالف';
//ExtraModules
$Definition['ExtraModules'] = [
    'addFarmsNearby' => 'Add %sx%s nearby farms',
    'addFarms' => 'إضافة 100 مزرعة',
    'addFarmsIsDisabledTill' => 'هذه الميزة معطلة حتى  %s.',
    'buyAdventure' => 'بحث عن مغامرة',
    'upgradeToMaxLevel' => 'ترقية للمستوى النهائي',
    'upgradeStorageToMaxLevel' => 'ترقية للمستوى النهائي',
    'increaseStorage' => 'زيادة التخزين',
    'smithyMaxLevel' => 'ترقية للمستوى النهائي',
    'smithyUpgradeAllToMax' => 'ترقية الجميع للمستوى النهائي',
    'academyResearchAll' => 'البحث عن جميع الوحدات',
    'finishTraining' => 'انهاء جميع التدريبات',
    'Used %s of %s' => 'المستخدمة %s من %s',
    'Feature limit reached' => 'تم الوصول إلى حد الميزة',
    'Errors' => ['WWDisabled' => 'لا يمكنك إستخدام هذه الميزة في المعجزة', 'Feature limit reached' => 'تم الوصول إلى حد الميزة',],
];
//Farmlist
$Definition['FarmList'] = [
    'You can only have one autoraid per account' => 'You can only have one autoraid per account.',
    'Auto raid On' => 'هجوم نهب على',
    'Auto raid Off' => 'الغاء هجوم النهب',
    'Auto raid costs %s silver(s) every %s seconds when it hits the farmlist' => 'تكاليف قائمة المزارع %s <img class="silver" src="img/x.gif"> اللذي يهجم عشوائياً',
    "System: You must wait some time before sending another raid" => "النظام : يرجى الإنتظار بعض الوقت قبل أن ترسل هجمات اخرى",
    "nameTooLong" => "الإسم طويل جداً",
    "enterListName" => "أضف إسم للقائمة",
    "nameIsNotUnique" => "هذا الإسم مستخدم يجب إختيار إسم آخر",
    "nRaidsMade" => "%s نهب",
    "delete" => "حذف",
    "choose_village" => "إختيار القرية",
    "add" => "اضافة",
    "addRaid" => "إضافة قرية",
    "editRaid" => "تعديل القرية",
    "choose_target" => "حدد الهدف",
    "FarmList" => "قائمة المزارع",
    "reallyDelete" => "هل تريد الحذف حقاً ؟",
    "raidList" => "قائمة المزارع",
    "lastTargets" => "الاهداف الأخيرة",
    "create_new_list" => "إنشاء قائمة جديدة",
    "rename_list" => "تغيير إسم القائمة",
    "rename" => "إعادة تسمية",
    "Village" => "القرية",
    "pop" => "السكان",
    "distance" => "المسافة",
    "troops" => "القوات",
    "lastRaid" => "اخر نهب",
    "name" => "الاسم",
    "create" => "انشاء",
    "checkAll" => "فحص الكل",
    "startRaid" => "بدء النهب",
    "details" => "تفاصيل",
    "occupiedOasis" => "واحة محتلة",
    "unoccupiedOasis" => "واحة غير محتلة",
    "edit" => "تعديل",
    "outGoingAttack" => "هجماتي",
    "noSlot" => "لم تقم بإضافة أي قوائم",
    "noVillageInTarget" => "لم يتم العثور على قرية بهذه الإحداثيات",
    "noTroopsSelected" => "لم تقم بإختيار قوات",
    "sameVillageEntered" => "لا يمكنك مهاجمة القرية التي إخترتها",
    "errorWorldWonderVillage" => "لا يمكنك مهاجمة هذه القرية",
    "slotsFull" => "جميع القرى قيد الإستخدام",
    'editAllSlotsRaid' => 'تعديل جميع الفواصل الزمنية',
    'Attack_iReport1' => 'هجوم على <img src=\'img/x.gif\' class=\'iReport iReport1\'/><img src=\'img/x.gif\' class=\'iReport iReport2\'/><img src=\'img/x.gif\' class=\'iReport iReport3\'/>',
    'Attack_iReport2' => 'هجوم على <img src=\'img/x.gif\' class=\'iReport iReport1\'/>',
    'Attack_iReport3' => 'هجوم على <img src=\'img/x.gif\' class=\'iReport iReport1\'/><img src=\'img/x.gif\' class=\'iReport iReport2\'/> بإستثناء الخسائر ',
    'Attack_att3' => '<img src=\'img/x.gif\' class=\'att3\'/><br /> الهجوم عشوائياً',
    'underProtection' => 'لا يمكنك مهاجمة لاعبين وانت تحت حماية المبتدئين',
    'انت هاجمت %s ثواني مضت, يجب الإنتظار %s ثواني قبل إرسال هجمة اخرى' => 'Your last attack was sent %s seconds ago. You need to wait %s seconds to send another raid.',
];
use Core\Helper\WebService;
$Definition['Global']['Building settings'] = 'Building settings';
$Definition['Global']['Times'] = 'Times';
$Definition['Global']['Unlimited'] = 'غير محدود';
$Definition['Global']['Hour'] = 'ساعة';
$Definition['Global']['Day'] = 'يوم';
$Definition['Global']['Minute'] = 'دقيقة';
$Definition['Global']['Second'] = 'ثانية';
$Definition['Global']['This tab is set as favourite'] = 'تم تعيين علامة التبويب ك مفضلة';
$Definition['Global']['Select tab %s as favourite'] = 'إختيار علامة التبويب %s ك مفضلة';
$Definition['Global']['loadingData'] = '... إنتظر من فضلك';
$Definition['Global']['registration_startgame_message_subject'] = 'Subject';
$Definition['Global']['registration_startgame_message_message'] = '';
$Definition['Global']['Newsletter_NewServer_subject'] = 'جديد %s %sx سيرفر';
$Definition['Global']['Newsletter_NewServer_content'] = '<strong>! مرحباً</strong>,
<br/>
<br/>
<br/>
! جاء الوقت
<strong>سيتم الإفتتاح اليوم<a href="[REGISTRATION_URL]" style="color:#f88c1f;" target="_blank"
                                        title="Travian">سيرفر</a> لترافيان</strong> يسجل أشجع واقوى المقاتلين المحترفين !
<br/>
<br/>
<div align="center">
    <a href="[REGISTRATION_URL]" target="_blank" title="لعب الآن">
        <img alt="لعب الآن" height="47" src="[INDEX_URL]img/Webstart/Play_Now_Button_x120_rot_EN.jpg"
             style="border-width: 0px; border-style: solid;" title="لعب الآن" width="120"/></a>
</div>
<br/>
يتم التحضير من أجل التحف والعجائب الإسطورية في العالم
<br/>
<br/>
<strong><a href="[REGISTRATION_URL]" style="color:#f88c1f;" target="_blank" title="ترافيان">تبدأ معركة جديدة الآن</a></strong> والإنضمام إلى تحالف قوي الآن لا تضيع الوقت !<br/>
<br/>Become the strongest player of Travian!<br/><br/><strong>Your Travian Team<br/><br/><br/><br/></strong>';
$Definition['Global']['Languages'] = [
    'en' => 'en',
    'ir' => 'ar',
];
$Definition['Global']['edit'] = 'تعديل';
$Definition['Global']['ms'] = 'ms';
$Definition['Global']['ns'] = 'ns';
$Definition['Global']['Best regards,The Travian Team'] = 'تحياتنا الحارة ,<br />فريق ترافيان';
$Definition['Global']['FreeGoldTitle'] = 'تلقيت ذهب !';
$Definition['Global']['FreeGold'] = " عزيزي اللاعب,\n\n%s ذهب تم إضافتها لحسابك \ تحياتنا , فريق ترافيان العرب";
$Definition['Global']['BuyGoldSubject'] = 'تم الإنتهاء من عملية النقل';
$Definition['Global']['BuyGoldText'] = 'إكتملت عملية النقل بنجاح !' . PHP_EOL . PHP_EOL . 'تمت إضافة %s من الذهب إلى حسابك' . PHP_EOL . PHP_EOL . " شفرة التتبع هي : %s" . PHP_EOL . PHP_EOL . "تحياتنا , فريق ترافيان العرب";
$Definition['Global']['voucherTitle'] = 'تمت إضافة الذهب';
$Definition['Global']['voucherText'] = 'تم إستخدام رقم القسيمة وإضافة الذهب إلى حسابك' . PHP_EOL . PHP_EOL . '%s تم إضافة الذهب' . PHP_EOL . PHP_EOL . ": شفرة التتبع هي %s" . PHP_EOL . PHP_EOL . " تحياتنا , فريق ترافيان العرب";
$Definition['Global']['Travian'] = 'ترافيان';
$Definition['Global']['Farm'] = 'مزرعة';
$Definition['Global']['Farms'] = 'مزارع';
$Definition['Global']['The process may take some time Please wait'] = 'قد تستغرق العملية بعض الوقت يرجى الإنتظار';
$Definition['Global']['Loading'] = 'إنتظر من فضلك';
$Definition['Global']['Contact admin'] = 'الإتصال بالدعم';
$Definition['Global']['VoucherEmailSubject'] = 'رمز قسيمة ترافيان';
$Definition['Global']['VoucherEmailMessage'] = 'عزيزي اللاعب,<br />لقد حذفت حسابك مؤخراً وقد إشتريت بعض الذهب<br /><br />يمكنك الآن الحصول على الذهب الخاص بك إلى حساب آخر في ألعاب ترافيان مع التعليمات البرمجية أدناه
 <br /> Voucher code: %s<br /><br />تحياتنا, فريق ترافيان';
$Definition['Global']['FAQ'] = 'المساعدة';
$Definition['Global']['cropfinder']['no results found'] = 'لا توجد نتائج';
$Definition['Global']['today'] = 'اليوم';
$Definition['Global']['yesterday'] = 'الأمس';
$Definition['Global']['tomorrow'] = 'غدأ';
$Definition['Global']['x days later'] = '%s أيام قادمة';
$Definition['Global']['x days past'] = '%s أيام ماضية';
$Definition['Global']['Dear [PlayerName],'] = 'عزيزي %s,';
$Definition['Global']['beforeyesterday'] = 'أول امس';
$Definition['Global']['newVillageName'] = 'قرية جديدة';
$Definition['Global']['moreInformation'] = 'المزيد من المعلومات';
$Definition['Global']['Hello x'] = 'مرحباً %s,';
$Definition['Global']['continue'] = 'إستمرار';
$Definition['Global']['gold'] = 'الذهب';
$Definition['Global']['silver'] = 'الفضه';
$Definition['Global']['convertedTo'] = 'تحويل إلى';
$Definition['Global']['Login'] = 'دخول';
$Definition['Global']['Register'] = 'تسجيل';
$Definition['Global']['Support'] = 'الدعم';
$Definition['Global']['Wilderness'] = 'البرية';
$Definition['Global']['OccupiedOasis'] = 'واحة محتلة';
$Definition['Global']['unOccupiedOasis'] = 'واحة غير محتلة';
$Definition['Global']['Abandoned valley'] = 'وادي مهجور';
$Definition['Global']['Player not found'] = 'لم يتم العثور على اللاعب';
$Definition['Global']['Alliance not found'] = 'لم يتم العثور على التحالف';
$Definition['Global']['Invalid Report ID'] = 'معرف التقرير غير صالح';
$Definition['Global']['Invalid private key'] = 'المفتاح الخاص غير صالح';
$Definition['Global']['General']['instructions'] = 'تعليمات';
$Definition['Global']['General']['ok'] = 'حسناً';
$Definition['Global']['General']['cancel'] = 'إلغاء';
$Definition['Global']['General']['close'] = 'إغلاق';
$Definition['Global']['General']['or'] = 'او';
$Definition['Global']['General']['closeWindow'] = 'إغلاق النافذة';
$Definition['Global']['General']['level'] = 'المستوى';
$Definition['Global']['General']['in'] = 'في';
$Definition['Global']['General']['at'] = 'في';
$Definition['Global']['General']['endat'] = 'الانتهاء في';
$Definition['Global']['General']['hour'] = 'ساعه';
$Definition['Global']['General']['startat'] = 'البداية في';
$Definition['Global']['General']['duration'] = 'الوقت';
$Definition['Global']['General']['cost'] = 'التكلفة';
$Definition['Global']['General']['perHour'] = 'في الساعه';
$Definition['Global']['General']['save'] = 'حفظ';
$Definition['Global']['NatarsName'] = 'النتار';
$Definition['Global']['playerVillageName'] = "%s's قرية";
$Definition['Global']['wwName'] = 'معجزة العالم';
$Definition['Global']['NatureName'] = 'النتار';
$Definition['Global']['races'][1] = 'الرومان';
$Definition['Global']['races'][2] = 'الجرمان';
$Definition['Global']['races'][3] = 'الإغريق';
$Definition['Global']['races'][4] = 'نتار';
$Definition['Global']['races'][5] = 'النتار';
$Definition['Global']['races'][6] = 'Egyptians';
$Definition['Global']['races'][7] = 'Huns';
$Definition['Global']['UnloadHelper']['message'] = 'توجد هناك تغييرات لم تقم بحفظها , هل تريد حقاً الخروج ؟';
$Definition['Global']['Footer']['FAQ'] = 'المساعدة , الإجوبة';
$Definition['Global']['Footer']['Credits'] = 'المطورين والداعمين';
$Definition['Global']['Footer']['HomePage'] = 'الصفحة الرئيسية';
$Definition['Global']['Footer']['Forum'] = 'المنتدى';
$Definition['Global']['Footer']['Links'] = 'الروابط';
$Definition['Global']['Footer']['Terms'] = 'الشروط';
$Definition['Global']['Footer']['Imprint'] = 'الرئيسية';
$Definition['Global']['Footer']['Register'] = 'التسجيل';
$Definition['Global']['SUPPORT_MESSAGE_EXTRA_THINGS'] = '<br /><br />-----<br />تنبيه: نود أن ندعوك للمساعدة في تحسين دعمنا!<br />سيكون جيداً إذا يمكن أن تخصص بضع دقائق لملء الدراسة!<br />To the survey: <a target="_blank" href="http://goto.traviangames.com/t-com">http://goto.traviangames.com/t-com</a><br />-----<br /><br /> المساعدة <a target="_blank" href="http://t4.answers.travian.com/">http://t4.answers.travian.com/</a><br />T2.5/T3 Travian online help: <a target="_blank" href="http://t3.answers.travian.com/">http://t3.answers.travian.com/</a><br />Web: <a target="_blank" href="http://www.travian.com/">http://www.travian.com/</a><br />Email: <a href="mailto:admin@' . WebService::getJustDomain() . '">admin@' . WebService::getJustDomain() . '</a><br /><br />--<br />Travian Games GmbH<br />Wilhelm-Wagenfeld-Stra?e 22<br />80807 München<br />Germany<br /><br /><a target="_blank" href="http://www.traviangames.com">http://www.traviangames.com</a><br /><br />CEO: Lars Janssen<br /><br />Registration court: Munich district court<br />Business license number: HRB 173511<br /><br />Tax ID number: DE 246258085<br />–<br />This email and its attachments are strictly confidential and are intended<br />solely for the attention of the person to whom it is addressed. If you are<br />not the intended recipient of this email, please delete it including its<br />attachments immediately and inform us accordingly.<br />–<br /><br /><br />-----<br /><br /><br />';
$Definition['Global']['SUPPORT_MESSAGE_EXTRA_THINGS_UNIQUE_FINDER'] = 'تنبيه: نود أن ندعوك للمساعدة في تحسين دعمنا!
';
$Definition['Global']['INVITATION_WITH_PRE_REGISTRATION_CODE_EMAIL_SUBJECT'] = 'سيرفر جديد قادم!';
$Definition['Global']['INVITATION_WITH_PRE_REGISTRATION_CODE_EMAIL'] = '<strong>مرحباً[EMAIL]</strong>,
<br />
<br />جاء دورك , اليوم سينطلق سيرفر جديد</strong>
<strong><a href="[GAME_WORLD_URL_REGISTRATION]" style="color:#f88c1f;" target="_blank" title="Travian">سيرفر [WORLD_ID]</a></strong>
<strong>في ترافيان </strong>
يسجل في ترافيان أشجع واقوى المحاربين القدامى فقط !
<br />
<br />
<div align="left">
    <a href="[GAME_WORLD_URL_REGISTRATION]" target="_blank" title="Play now">
        <img alt="Play now" height="47" src="[GAME_WORLD_URL]img/en/Play_Now_Button_x120_rot_EN.jpg" style="border-width: 0px; border-style: solid;" title="لعب الآن" width="120" />
    </a>
</div>
<br />يتم التحضير للتحف للتنافس في هذا العالم عليها
<br />
<br />
<strong>
    <a href="[GAME_WORLD_URL_REGISTRATION]" style="color:#f88c1f;" target="_blank" title="Travian">تبدأ معركة جديدة الآن</a>
</strong> قم بالتسجيل والإنضمام لتحالف قوي 
<br />
<br />نتمنى ان تكون الأفضل
<br />
<p>رمز التسجيل المسبق :  [PRE_REGISTRATION_CODE]</p>
<br />
<strong>Your Travian Team</strong>';
$Definition['Global']['WWPlansReleaseMessage'] = '
وقد مرت ايام لا تعد ولا تحصى منذ المعارك الاولى على جدران النتار , العديد من الجيوش تم تدميرها على جدران النتار , والأن بدأ الإنتشار ورائحة الموت في هذا العالم قد بدأت للتو ! إحرص على التجييش للمستقبل !
<br><br>
لقد وصلو الكشافة مع حكايات وقصص ومشاهد رهيبة تقشعر لها الأبدان , جيوش خيفه لا يمر أحد من طريقها الا وانتهت حياته , قوة كبيرة جداً قوة قاسية ولا ترحم , إنها تسحق آمل الناس , السباق قد بدأ جهز دفاعك وجيشك للمقاومة والهجوم لا تكن أخر من يعلم !
<br><br>
ظهرت مخططات البناء , مخططات البناء تستطيع بواسطتها أن ترفع مستوى المعجزة , قم بخطف التحف قبل أن يخطفها الخصم
<br><br>
عشرات الاف من الكشافة تجول على الجميع وتبحث عن أي شيئ ولكن الاماكن القوية لن تقدر على الوصول لها ! ومع ذلك المشاكل قد بدأت وظهرت الأسرار لهذه الإمبراطورية ! 
<br><br>
الان بداية النهاية , عندما تصطدم أقوى الجيوش في ساحات القتال في هذا العالم لتقرير مصير جميع الأطراف , السيف ضد السيف , وهذه هي الحرب التي سوف تتكرر عبر الأزمان , هذه هي حربكم , يحب عليك حفر إسمك عبر التاريخ , هنا يمكنك أن تصبح أسطورة ...
<br><br>
<span style="font-size:60%; color: #666;">(كتبت بواسطة : الصياد)</span>
<br><br>
<br><br>
<b>المتطلبات</b><i> : لسرقة مخطط بناء يجب توفر هذه الشروط </i><br>
<li>إرسال هجوم كامل على قرية المخطط  </li>
<li>أن ينجح الهجوم على قرية المخطط</li>
<li>أن تدمر الخزنة</li>
<li>مشاركة البطل بالهجوم واجبة</li>
<li>يجب أن يكون مستوى الخزنة 10 </li>
<br><br>
من ثم تحصل على التحفة إذا نجح  الهجوم ويتم إختطاف التحفة , يجب إختيار هدف المقاليع ( الخزنة )
<br><br>
للبناء يجب على صاحب المعجزة الحصول على مخطط بناء واحد حتى مستوى 49 يجب على لاعب اخر من التحالف إمتلاك مخطط بناء آخر للإستمرار في رفع المعجزة لمستوى 100 
';
$Definition['Global']['WWConstructStart'] = $Definition['Global']['WWPlansReleaseMessage'];
$Definition['Global']['ArtifactsReleaseMessage'] = <<<HTML_ENTITIES
<div style="width:450px; height:830px; padding: 95px 60px
60px 25px; background:
url(img/Natars_Banner_gross.jpg)
no-repeat;">
        <center>
            <h1>التحف</h1>
            <p style="font-size:85%; text-align:justify; width:400px">
                لقد ظهرت التحف وحان الوقت للإستحواذ على التحف المفيدة , سارع للحصول على تحفة قبل خطفها
                <br><br><img src="img/msg.jpg"
                             alt="Artefacts" width="400" height="200" style="float:
right">
                <br><br>
التحف قطع أثرية ثمينة ومفيدة , ولكل تحفة تـأثير مميز , إن اللاعبون يودون الحصول على التحف الأثمن والأغلى مثل تدريب القوات بوقت اسرع واستهلاك القمح , والبعض الأخر يفضل تـأثيرات اخرى , ماذا تريد انت ؟ هيا سارع لإمتلاك تحفة , ولا تنسى أن إمتلاك التحفة وحدة لا يكفي وإنما انت بحاجة لدعم من تحالفك للدفاع عنها , ف جهز نفسك جيداً !             </p><br/><br/>
<span style="font-size:60%; color: #666;">(كتبت بواسطة : الصياد)</span>
</center>
</div>
HTML_ENTITIES;
$Definition['Global']['NatarsAreBuildingWW'] = '<center><span style="text-align: center; color: red;"><b>Important news</b></span></center><br />OMG, We were notified that <font color="blue"><b>Natars</b></font> found the power to build the Wonder of the world and they are upgrading that very fast (%s level(s) per %s).<img src="/img/natars.jpg" style="float:right;"><br><br><br /><br />With their power we can\'t destroy them and we must increase our upgrading speed to win the <font color="blue"><b>Natars</b></font>.';

/*$Definition['Global']['ServerFinishWinner'] = 'اعزائنا لاعبين ترافيان,
<br><br>
<img src="/img/ww100.png" style="float:right;">
إنتهى السيرفر
<br><br>
  <i><b>%s</b></i>, لاعب إستحق إحترام الخصوم وأثبت انه وبمساعدة تحالفة الأقوى في هذا العالم وقام ببناء أخر حجر في معجزة العالم ليصبح اول من بنى المعجزة وقهر فيها التتار وجيوشهم
<br><br>
تعاون التحالف مطلوب <i>"<b>%s.</b>"</i>, <i>"
<b>%s</b>"</i> ليس إمتلاك المخطط يعني أنك ستبني المعجزة , ف الأعداء والخصوم أيضاً قد يحصلون على مخطط بناء وسباقكم في بناء المعجزة<i>"<b>%s</b>"</i> who receives the title
"الفائز في هذا السيرفر"!
<br><br>
<i>"<b>%s</b>"</i> قام ببناء أكبر إمبراطورية عرفها العالم <i>"<b>%s</b>"</i> and <i>"
<b>%s</b>"</i>.
<br>
<i>"<b>%s</b>"</i> ولاكن القائد الأكثر رعباً الذي زلزل حصون الخصم وكسب معارك كثيرة وكبيرة هو
<br>
<i>"<b>%s</b>"</i> أما اقوى المدافعين الذي أظهر للعالم أنه الأقوى في هذا الجانب فهو
<br><br>
Best regards,<br>
فريق ترافيان
<br><br>
<span style="font-size:60%; color: #666;">(كتبت بواسطة الصياد)</span>';*/
$Definition['Global']['ServerFinishWinner'] = 'اعزائنا لاعبين ترافيان,
<br><br>
<img src="/img/ww100.png" style="float:right;">
بعد ايام طويلة من التعب والعمل بتفان قام احد العمال بوضع اللبنة الأخيرة في اقوى واعظم بناء عرفة العالم
<br><br>
<br />
<br />
النتيجة :
<br />
إستطاع العمال في المعجزة : <i><b>%s</b></i>, ببناء اخر حجر في الإعجوبة
نتيجة التنسيق والعمل الجيد , إستطاعو ان يبنو اخر حجر في معجزة العالم وإنهاء هذا العالم والسيطرة علية إلى الأبد
<br><br>
<br />
ودافعو عنها ضد هجمات الخصوم والنتار جنبنا إلى جنب مع تحالف <i>"<b>%s</b>"</i>, <i>"
<br />
<b>%s</b>"</i>اول من أنهى بناء المعجزة وقد رصد لها وتحالفه ملايين الموارد لبناء معجزة العالم وبذلك إستحق<i>"<b>%s</b>"</i> 
"الفائز بهذا العالم"!
<br><br>
<br />
<br />
<i>"<b>%s</b>"</i> قام ببناء أكبر وافضل الإمبراطوريات في هذا السيرفر واستحق بذلك لقب أكبر إمبراطورية يتبعه كل من <i>"<b>%s</b>"</i> و <i>"
<b>%s</b>"</i>.
<br>
<br />
<br />
<i>"<b>%s</b>"</i> قام ببث الرعب والخوف في قلوب اعدائة وخصومة  , هاجمهم وشتت شملهم وفرق جمعهم ونحرهم في أرضهم واستحق بذلك افضل مهاجمين السيرفر !
<br>
<br />
<br />
<i>"<b>[DEFENDER]</b>"</i> قام بالدفاع عن عاصمته بكل شجاعة , وقتل جيوش كبيرة بإعداد كبيرة من مَن راودتهم نفسهم بالهجوم عليه , واستحق بذلك لقب أفضل المدافعين في السيرفر !
<br><br>
<br />
أطيب التحيات , <br>
فريق ترافيان العرب
<br><br>
<span style="font-size:60%; color: #666;">(كتبت بواسطة الصياد)</span>';
$Definition['Global']['ServerFinishNoWinner'] = 'أعزائنا لاعبين ترافيان,
<br><br>
<img src="/img/ww100.png" style="float:right;">
بعد ايام طويلة من التعب والعمل بتفان قام احد العمال بوضع اللبنة الأخيرة في اقوى واعظم بناء عرفة العالم 
<br><br>
<br />
<br />
النتيجة :
أعزائنا اللاعبين الجميع بذل قصارى جهدة في بناء المعجزة ولاكن التتار كان أسرع في ذلك ! حظاً موفق للجميع
<br><br>
<br />
<i>"<b>%s</b>"</i> قام ببناء أكبر وافضل الإمبراطوريات في هذا السيرفر واستحق بذلك لقب أكبر إمبراطورية يتبعه كل من  <i>"<b>%s</b>"</i> و  <i>"
<b>%s</b>"</i>.
<br />
<br />
<br>
<i>"<b>%s</b>"</i>  قام ببث الرعب والخوف في قلوب اعدائة وخصومة  , هاجمهم وشتت شملهم وفرق جمعهم ونحرهم في أرضهم واستحق بذلك افضل مهاجمين السيرفر ! 
<br>
<br />
<br />
<i>"<b>[DEFENDER]</b>"</i> قام بالدفاع عن عاصمته بكل شجاعة , وقتل جيوش كبيرة بإعداد كبيرة من مَن راودتهم نفسهم بالهجوم عليه , واستحق بذلك لقب أفضل المدافعين في السيرفر !
<br><br>
<br />
<br />
اطيب التحيات,<br>
فريق ترافيان العرب
<br><br>
<span style="font-size:60%; color: #666;">(كتبت بواسطة : الصياد)</span>';
$Definition['Global']['SUPPORT_MESSAGE_EXTRA_THINGS'] = '<br /><br />';
$Definition['Global']['SUPPORT_MESSAGE_EXTRA_THINGS_UNIQUE_FINDER'] = '<br />';
$Definition['Global']['GoldPromotionPublicMsg'] = '<font color="#998200" size="4"><b>Gold Promotion!!!</b></font><br /><br />This Gold promotion will happen between %s till %s.<br /><br />All gold purchased during this time will give you <b>20%%</b> more gold than usual.';
//GoldHelper
$Definition['GoldHelper']['exchangeResources']['exchangeResources'] = 'تبادل الموارد';
$Definition['GoldHelper']['exchangeResources']['error_in_ww'] = 'لا يمكنك إستخدام هذه الميزة في قرى النتار';
$Definition['GoldHelper']['exchangeResources']['error_no_marketplace'] = 'بناء السوق';
$Definition['GoldHelper']['exchangeResources']['error_low_pop'] = 'يجب ان يكون لديك 40 ساكن على الاقل';
$Definition['GoldHelper']['exchangeResources']['error_low_resources'] = 'يجب أن يكون لديك 50 مورد على الاقل';
//Help
$Definition['Help']['Help system'] = 'نظام المساعدة';
$Definition['Help']['FAQ - Answers'] = 'الأسئلة';
$Definition['Help']['Game rules'] = 'قواعد اللعبة';
$Definition['Help']['Contact ingame support'] = 'الإتصال بالدعم';
$Definition['Help']['If you couldn\'t find an answer, contact the ingame support here'] = 'إذا لم تتمكن من العثور على الإيجابة يرجى الإتصال بالدعم';
$Definition['Help']['Plus questions'] = 'اسئلة البلس';
$Definition['Help']['You can ask questions about payment and premium features here'] = 'يمكنك طرح الإسئلة عن الذهب من هنا';
$Definition['Help']['Forum'] = 'المنتدى';
$Definition['Help']['On our Forum, you can meet and converse with other players'] = 'في المنتدى يمكنك الانضمام لباقي اللاعبين للتواصل';
$Definition['Help']['Short instruction'] = 'تعليمات';
$Definition['Help']['Here you can find short explanations about the troops and buildings found in Travian'] = 'هنا يمكنك أن تجد تفسيرات قصيرة حول القوات والمباني الموجودة في ترافيان.';
$Definition['Help']['Interface help'] = 'واجهة المساعدة';
$Definition['Help']['An overview of the user interface with short descriptions of the different functions'] = 'نظرة عامة على واجهة المستخدم';
$Definition['Help']['Here, you can find the current game rules'] = 'قواعد اللعبة الحالية';
$Definition['Help']['Here, you can find your answers about Travian If you really can\'t find your answer here, you can also contact our ingame support afterwards'] = 'هنا، يمكنك أن تجد إجاباتك عن ترافيان إذا كنت حقا لا يمكن العثور على إجابتك هنا، يمكنك أيضا الاتصال دعمنا داخل اللعبة بعد ذلك.
';
$Definition['Help']['inGameSupport'] = [
    'description' => 'باستخدام نظام المساعدة لدينا، صفحة الإجابات، يمكنك بسهولة العثور على إجابات لجميع الأسئلة العامة حول ترافيان بسرعة ودون البحث لفترة طويلة. بالإضافة إلى ذلك، لديك إمكانية الاتصال بالدعم. يمكن أن يستغرق دعمنا تصل إلى 24 ساعة للرد على سؤالك. للحصول على إجابة أسرع، جرب الإجابات.',
    'FAQ - go to Answers' => 'المساعدة',
    'I tried Answers but I want to contact the support' => 'يمكنك التواصل مع الدعم من هنا',
    'Contact ingame support' => 'الدعم والمساعدة',
];
//Hero
$Definition['Hero'] = ["Attributes" => "السمات", "المظهر" => "السمات",
    "Adventure" => "المغامرات", "Auction" => "المزايدات",
    "showInformation" => "معلومات اكثر",
    "hideInformation" => "اخفاء المعلومات", "normal" => "عادي",
    "hard" => "صعبة",
];
//HeroAdventure
$Definition['HeroAdventure']['Duration to the adventure'] = 'وقت المغامرة';
$Definition['HeroAdventure']['Arrival in: %s hrs | Return in: %s hrs'] = ': الوصول في %s : ساعة | عودة في%s ساعة';
$Definition['HeroAdventure']['No rallyPoint'] = 'لا توجد نقطة تجمع';
$Definition['HeroAdventure']['headerAdventures'] = 'المغامرات المتاحة';
$Definition['HeroAdventure']['location'] = 'الموقع';
$Definition['HeroAdventure']['moveTime'] = 'المدة الزمنية';
$Definition['HeroAdventure']['difficulty'] = 'الصعوبة';
$Definition['HeroAdventure']['timeLeft'] = 'الوقت المتبقي';
$Definition['HeroAdventure']['goTo'] = 'المكان';
$Definition['HeroAdventure']['gotoAdventure'] = 'إلى المغامرة';
$Definition['HeroAdventure']['normal'] = 'عادي';
$Definition['HeroAdventure']['hard'] = 'صعبة';
$Definition['HeroAdventure']['wald'] = 'واحة خشب';
$Definition['HeroAdventure']['clay'] = 'واحة طين';
$Definition['HeroAdventure']['hill'] = 'جبال';
$Definition['HeroAdventure']['lake'] = 'بحيرة';
$Definition['HeroAdventure']['adventure_dif_hard'] = 'مغامرة صعبة';
$Definition['HeroAdventure']['adventure_dif_normal'] = 'مغامرة عادية';
$Definition['HeroAdventure']['natarsLandscape'] = 'واحة خشب';
$Definition['HeroAdventure']['natars'] = 'قرية نتار';
$Definition['HeroAdventure']['adventure'] = 'مغامرة';
$Definition['HeroAdventure']['unOccupiedOasis'] = 'واحة غير محتلة';
$Definition['HeroAdventure']['ok'] = 'إذهب للمغامرة';
$Definition['HeroAdventure']['no adventures'] = 'لم يتم العثور على مغامرة';
$Definition['HeroAdventure']['Hero not available'] = 'غير موجود';
$Definition['HeroAdventure']['Hero is stationed in village'] = 'في القرية';
$Definition['HeroAdventure']['Hero is not in selected village at the moment'] = 'البطل ليس في القرية المختارة';
$Definition['HeroAdventure']['StartAdventure'] = 'بدء المغامرة';
$Definition['HeroAdventure']['back'] = 'عودة';
$Definition['HeroAdventure']['rallyPointNeeded'] = 'انت بحاجة لنقطة تجمع';
$Definition['HeroAdventure']['Send hero to village'] = 'ارسال البطل للقرية';
$Definition['HeroAdventure']['Travel time to village'] = 'الوقت للذهاب للقرية';
$Definition['HeroAdventure']['Revive hero first'] = 'انعاش البطل بالبداية';
$Definition['HeroAdventure']['The Hero must be stationed in the selected village first in order to start an adventure from there'] = 'يجب ان يكون البطل في هذه القرية حتى يذهب للمغامرة ';
$Definition['HeroAdventure']['Travel time calculation for other villages'] = 'حساب الوقت من القرى الأخرى';
$Definition['HeroAdventure']['Show travel time calculation for other villages'] = 'عرض اوقات الذهاب للقرى الاخرى';
$Definition['HeroAdventure']['Hide travel time calculation for other villages'] = 'إخفاء اوقات الذهاب للقرى الأخرى';
$Definition['HeroAdventure']['Hero on his way'] = 'البطل على الطريق';
//HeroFace
$Definition['HeroFace'] = [
    "Gender" => "الجنس",
    "male" => "ملك",
    "female" => "ملكة", "save" => "حفظ",
    "random" => "عشوائي", "headProfile" => "الرأس",
    "hairColor" => "لون الشعر", "hairStyle" => "تسريحة الشعر",
    "ears" => "الأذنيين", "eyebrow" => "الحاجبين",
    "eyes" => "العينين", "nose" => "الأنف", "mouth" => "الفم",
    "beard" => "اللحية",
];
//Hero Global
$Definition['HeroGlobal']['HeroOverview'] = 'نظرة عامة';
$Definition['HeroGlobal']['health'] = 'الصحة';
$Definition['HeroGlobal']['Experience'] = 'الخبرة';
$Definition['HeroGlobal']['Appear'] = 'المظهر الخارجي';
$Definition['HeroGlobal']['Attributes'] = 'السمات';
$Definition['HeroGlobal']['showInformation'] = 'عرض المعلومات';
$Definition['HeroGlobal']['hideInformation'] = 'إخفاء المعلومات';
$Definition['HeroGlobal']['available_adventures:'] = ': المغامرات المتاحة';
$Definition['HeroGlobal']['next adventure will expire in:'] = ': تنتهي المغامرة التالية في %s';
$Definition['HeroGlobal']['Auctions'] = 'المزايدات';
$Definition['HeroGlobal']['Auctions with maximum bid:'] = ': المزايدات الأعلى سعراً';
$Definition['HeroGlobal']['Auctions which you got outbid:'] = ': المزايدات المزايد عليها';
$Definition['HeroGlobal']['Adventure'] = 'مغامرة';
$Definition['HeroGlobal']['Tooltip loading'] = 'جاري التحميل ...';
$Definition['HeroGlobal']['shortStatus']['Home'] = '	في القرية';
$Definition['HeroGlobal']['shortStatus']['defending'] = 'يدافع';
$Definition['HeroGlobal']['shortStatus']['trapped'] = 'مأسور';
$Definition['HeroGlobal']['shortStatus']['dead'] = 'جريح';
$Definition['HeroGlobal']['shortStatus']['return'] = 'على الطريق';
$Definition['HeroGlobal']['shortStatus']['adventure'] = 'على الطريق';
$Definition['HeroGlobal']['shortStatus']['reinforcement'] = 'على الطريق';
$Definition['HeroGlobal']['shortStatus']['attack'] = 'على الطريق';
$Definition['HeroGlobal']['shortStatus']['escape'] = 'على الطريق';
$Definition['HeroGlobal']['shortStatus']['reviving'] = 'تجديد';
$Definition['HeroGlobal']['longStatus']['Home'] = 'البطل حالياً في القرية %s.';
$Definition['HeroGlobal']['longStatus']['defending'] = 'البطل حالياً يدافع عن القرية %s.';
$Definition['HeroGlobal']['longStatus']['trapped'] = 'البطل مأسور في القرية %s.';
$Definition['HeroGlobal']['longStatus']['dead'] = 'البطل جريح';
$Definition['HeroGlobal']['longStatus']['return'] = 'بطلك في طريق العودة الى القرية %s.';
$Definition['HeroGlobal']['longStatus']['return'] .= 'الوقت المتبقي %s في %s.';
$Definition['HeroGlobal']['longStatus']['adventure'] = 'البطل في مغامرة %s';
$Definition['HeroGlobal']['longStatus']['reinforcement'] = 'موطن البطل في %s. البطل على الطريق';
$Definition['HeroGlobal']['longStatus']['reinforcement'] .= 'الوقت المتبقي %s في %s.';
$Definition['HeroGlobal']['longStatus']['attack'] = 'موطن البطل في %s. البطل على الطريق.';
$Definition['HeroGlobal']['longStatus']['attack'] .= 'الوقت المتبقي %s في %s.';
$Definition['HeroGlobal']['longStatus']['escape'] = 'البطل هـآرب';
$Definition['HeroGlobal']['longStatus']['escape'] .= 'الوقت المتبقي %s في %s.';
$Definition['HeroGlobal']['longStatus']['reviving'] = 'يتم تجديد البطل في القرية';
$Definition['HeroGlobal']['inventoryStatus']['Home'] = 'البطل حالياً في القرية <a href="karte.php?d=%s">%s</a>.';
$Definition['HeroGlobal']['inventoryStatus']['defending'] = 'البطل حالياً يدافع عن <a href="karte.php?d=%s">%s</a>.';
$Definition['HeroGlobal']['inventoryStatus']['trapped'] = 'البطل مأسور في القرية<a href="karte.php?d=%s">%s</a>.';
$Definition['HeroGlobal']['inventoryStatus']['dead'] = 'البطل جريح';
$Definition['HeroGlobal']['inventoryStatus']['return'] = 'البطل في طريق العودة إلى <a href="karte.php?d=%s">%s</a>.';
$Definition['HeroGlobal']['inventoryStatus']['return'] .= 'الوقت المتبقي %s في %s.';
$Definition['HeroGlobal']['inventoryStatus']['adventure'] = 'البطل في المغامرة %s. الوقت المتبقي %s في %s.';
$Definition['HeroGlobal']['inventoryStatus']['adventure'] .= '<div class="subMessage"> يمكنك رؤية مجريات المغامرة <a href="build.php?gid=16&amp;tt=1&amp;newdid=%s">نقطة التجمع</a>.) </div>';
$Definition['HeroGlobal']['inventoryStatus']['reinforcement'] = 'موطن البطل في <a href="karte.php?d=%s">%s</a>. Hero is on thy way.';
$Definition['HeroGlobal']['inventoryStatus']['reinforcement'] .= 'الوقت المتبقي %s في %s.';
$Definition['HeroGlobal']['inventoryStatus']['attack'] = 'موطن البطل في <a href="karte.php?d=%s">%s</a>. البطل على الطريق';
$Definition['HeroGlobal']['inventoryStatus']['attack'] .= 'الوقت المتبقي %s في %s.';
$Definition['HeroGlobal']['inventoryStatus']['escape'] = 'البطل هـآرب';
$Definition['HeroGlobal']['inventoryStatus']['escape'] .= 'الوقت المتبقي %s في %s.';
$Definition['HeroGlobal']['inventoryStatus']['reviving'] = 'يتم تجديد البطل في <a href="karte.php?d=%s">%s</a>';
$Definition['HeroGlobal']['inventoryStatus']['reviving'] .= ' : الوقت المتبقي';
//HeroInventory
$Definition['HeroInventory'] = [
    "loyaltyIsMaxYourCannotIncreaseItMore" => "Your village loyalty is maxed. You can`t increase it anymore.",
    "HeroAliveAndCannotUseBucket" => "لايمكنك تجديد البطل فهو على قيد الحياة بالفعل",
    "YourHeroWillBeAliveImmediatelyAndOneWaterBucketWillBeUsedAndNoResourcesWillBeRefunded" => "You hero will be alive immediately. One waterbucket will be used and the resources will not be refunded.",

    "YouCannotUseThisItemCurrently" => "لا يمكنك إستخدام هذه الأداه حالياً",
    "waterBucketsUsed" => "لقد إستخدمت الحد الأقصى",
    "currentHeroExperience" => "خبرة البطل الحالية",
    "heroExperienceGainFromItems" => "الخبرة المكتسبة من اللفافات",
    "heroExperienceAfterUse" => "خبرة البطل بعد الإستخدام",
    "currentCulturePoints" => "النقاط الحضارية الحالية",
    "culturePointsGainFromItems" => "النقاط الحضارية المكتسبة من الاعمال الفنية",
    "culturePointsAfterUsage" => "النقاط الحضارية بعد الإستخدام",
    "heroLevel" => "مستوى البطل",
    "RomanSpecialHeroAttribute" => "سيحصل البطل الخاص بك %s قوة هجوم من كل نقطة",
    "TeutonSpecialHeroAttribute" => "ستحصل على النقاط والبطل مع القوات %s نقطة إضافية",
    "GualSpecialHeroAttribute" => "عندما يكون البطل مع القوات ستحصل على %s سرعة إضافية",
    "notMoveableText" => 'لا يمكنك إستخدام هذه الأداة والبطل جريح او خارج القرية !',
    "notMoveableTextDead" => 'لا يمكنك إستخدام هذه الاداة يجب تجديد البطل أولاً',
    "moveDialogDescription" => "عدد القطع",
    "useDialogDescription" => "عدد القطع",
    "useOneDialogTitle" => "هل أنت متأكد من إستخدام هذه الآداة ؟",
    "moveDialogTitle" => "تكبير",
    "useDialogTitle" => "استخدام", "buttonOk" => "حسناً",
    "buttonCancel" => "إلغاء",
    "save" => "حفظ التغيرات",
    "Body" => "الجسم",
    "BuyItem" => "شراء أداة",
    "sellItem" => "بيع أداة",
    "productBonus" => "الموارد",
    "increaseOfProduction" => "الإنتاج",
    "productBonusDesc" => "يزيد إنتاج الموارد في القرية التي يتواجد بها البطل",
    "defBonus" => "مكافأة الدفاع",
    "defBonusDesc" => "يزيد القوة الدفاعية لكل القوات المرافقة له",
    "offBonus" => "مكافأة الهجوم",
    "offBonusDesc" => "يزيد القوة الهجومية لكل القوات المرافقة له",
    "fightingStrength" => "الكفائة الحربية",
    "fightingStrengthDesc" => "تزيد قوة البطل في الهجوم والدفاع وتقلل من الإصابات التي يتعرض لها في الهجمات , المغامرات , الدفاع",
    "attackBehaviourSettings" => "اخفاء البطل",
    "availablePoints" => "النقاط المتاحة",
    "SaveChanges" => "يرجى حفظ التغييرات",
    "HeroHideDesc" => "عند تعرضك لهجوم سيختبأ بطلك ويكون في مأمن.",
    "HeroShowDesc" => "سيبقى بطلك دوماً مع قواتك",
    "ReviveHeroInVillage" => "لتغيير موطن البطل او تجديدة في قرية أخرى",
    "ResourcesRequiredToReviveHero" => "تكلفة التجديد",
    'HeroReviveInVillageDescription' => 'موطن البطل <a href="karte.php?d=%s">%s</a>. سيتم تجديدة في <a href="karte.php?d=%s">%s</a>.',
    "EnoughResourcesAt" => "الموارد غير كافية",
    "changeResourcesHeadline" => "تغيير إنتاج الموارد",
    "Regenerate" => "تجديد البطل",
    "health" => "الصحة",
    "heroRegenerationRate" => "تجديد البطل الخاص بك",
    "perDay" => "في اليوم",
    "fromHero" => "من البطل",
    "fromItem" => "من المعدات",
    "experience" => "الخبرة",
    "experienceNeededToNextLevel" => "يحتاج البطل الى %s نقاط للوصول للمستوى التالي %s.",
    "speed" => "السرعة",
    "speedOfYourHero" => "سرعة البطل",
    "fieldPerHour" => "في الساعة",
    "fromHorse" => "من الحصان",
    "HeroProduction" => "إنتاج البطل",
    "currentHeroProduction" => "إنتاج البطل الحالي",
    "Bonus" => "مكافأة",
    "Percent" => "%", "level" => "المستوى",
    'heroExperienceBonus' => 'Bonus',

];
//HeroItems
$Definition['HeroItems'] = [
    1 => [
        1 => [
            "name" => "خوذة المعرفة", "title" => "%s&#37;+ زيادة خبرة للبطل",
        ], 2 => [
            "name" => "خوذة الكشف",
            "title" => "%s&#37;+ زيادة خبرة للبطل",
        ], 3 => [
            "name" => "خوذة الحكمة",
            "title" => "%s&#37;+ زيادة خبرة للبطل",
        ], 4 => [
            "name" => "خوذة التجديد",
            "title" => "%s+ نقاط صحة في اليوم",
        ], 5 => [
            "name" => "خوذة الصحة", "title" => "%s+ نقاط صحة في اليوم",
        ], 6 => [
            "name" => "خوذة الشفاء", "title" => "%s+ نقاط صحة في اليوم",
        ], 7 => [
            "name" => "خوذة الإغريقي المصارع",
            "title" => "%s+ نقطة حضارية في اليوم",
        ], 8 => [
            "name" => "خوذة الشعوب", "title" => "%s+ نقطة حضارية في اليوم",
        ], 9 => [
            "name" => "خوذة القنصل", "title" => "%s+ نقطة حضارية في اليوم",
        ], 10 => [
            "name" => "خوذة الفرسان",
            "title" => "تخفيض زمن التدريب اللازم في الاسطبل بمقدار %s&#37;.",
        ], 11 => [
            "name" => "خوذة سلاح الفرسان",
            "title" => "تخفيض زمن التدريب اللازم في الاسطبل بمقدار %s&#37;.",
        ], 12 => [
            "name" => "خوذة سلاح الفرسان الثقيلة",
            "title" => "تخفيض زمن التدريب اللازم في الاسطبل بمقدار %s&#37;.",
        ], 13 => [
            "name" => "خوذة المرتزقة",
            "title" => "تخفيض زمن التدريب اللازم في الثكنة بمقدار %s&#37;.",
        ], 14 => [
            "name" => "خوذة المقاتل",
            "title" => "تخفيض زمن التدريب اللازم في الثكنة بمقدار %s%%.",
        ], 15 => [
            "name" => "خوذة القائد",
            "title" => "تخفيض زمن التدريب اللازم في الثكنة بمقدار %s%%.",
        ],
    ], 2 => [
        82 => [
            "name" => "درع التجديد الخفيف",
            "title" => "%s+ نقطة صحة يومياً",
        ], 83 => [
            "name" => "درع التجديد", "title" => "%s+ نقطة صحة يومياً",
        ], 84 => [
            "name" => "درع التجديد الثقيل", "title" => "%s+ نقطة صحة يومياً",
        ], 85 => [
            "name" => "درع مسنن خفيف",
            "title" => "%s تخفيض نسبة الإصابة بمقدار.<br />%s+ نقاط صحة في اليوم",
        ], 86 => [
            "name" => "درع مسنن",
            "title" => "%s تخفيض نسبة الإصابة بمقدار.<br />%s+ نقاط صحة في اليوم",
        ], 87 => [
            "name" => "درع مسنن ثقيل",
            "title" => "%s تخفيض نسبة الإصابة بمقدار.<br />%s+ نقاط صحة في اليوم",
        ], 88 => [
            "name" => "درع الصدر الخفيف",
            "title" => "%s+ قوة قتالية للبطل.",
        ], 89 => [
            "name" => "درع الصدر",
            "title" => "%s+ قوة قتالية للبطل.",
        ], 90 => [
            "name" => "درع الصدر الثقيل",
            "title" => "%s+ قوة قتالية للبطل.",
        ], 91 => [
            "name" => "درع أعضاء الجسم الخفيف",
            "title" => "%s تخفيض الضرر بمقدار.<br />%s+ قوة قتاليّة للبطل.",
        ], 92 => [
            "name" => "درع أعضاء الجسم",
            "title" => "%s تخفيض الضرر بمقدار.<br />%s+ قوة قتاليّة للبطل.",
        ], 93 => [
            "name" => "درع أعضاء الجسم الثقيل",
            "title" => "%s تخفيض الضرر بمقدار.<br />%s+ قوة قتاليّة للبطل.",
        ],
    ], 3 => [
        61 => [
            "name" => "الخارطة الصغيرة",
            "title" => "%s&#37; عودة أسرع للبطل والقوات المرافقة له",
        ], 62 => [
            "name" => "الخارطة", "title" => "%s&#37; عودة أسرع للبطل والقوات المرافقة له",
        ], 63 => [
            "name" => "الخارطة الكبيرة",
            "title" => "%s&#37; عودة أسرع للبطل والقوات المرافقة له",
        ], 64 => [
            "name" => "راية صغيرة للقبيلة",
            "title" => "%s&#37; تحرّك أسرع للقوات بين القرى الخاصة باللاعب.",
        ], 65 => [
            "name" => "راية للقبيلة",
            "title" => "%s&#37; تحرّك أسرع للقوات بين القرى الخاصة باللاعب.",
        ], 66 => [
            "name" => "راية كبيرة للقبيلة",
            "title" => "%s&#37; تحرّك أسرع للقوات بين القرى الخاصة باللاعب.",
        ], 67 => [
            "name" => "راية صغيرة للحلف",
            "title" => "تحرّك أسرع لقوّات اللاعبين في التحالف الواحد %s&#37;",
        ], 68 => [
            "name" => "راية للحلف",
            "title" => "تحرّك أسرع لقوّات اللاعبين في التحالف الواحد %s&#37;",
        ], 69 => [
            "name" => "راية كبيرة للحلف",
            "title" => "تحرّك أسرع لقوّات اللاعبين في التحالف الواحد %s&#37;",
        ], 73 => [
            "name" => "كيس السارق الصغير", "title" => "%s&#37;+ مكافأة نهب*
* يخفّض قدرة المخابئ على إخفاء الموارد بمقدار ",
        ], 74 => ["name" => "كيس السارق", "title" => "%s&#37;+ مكافأة نهب*
* يخفّض قدرة المخابئ على إخفاء الموارد بمقدار "],
        75 => [
            "name" => "كيس السارق الكبير", "title" => "%s&#37;+ مكافأة نهب*
* يخفّض قدرة المخابئ على إخفاء الموارد بمقدار ",
        ], 76 => [
            "name" => "ترس الحرب الصغير",
            "title" => "%s+ نقطة زياة على الكفاءة الحربية للبطل",
        ], 77 => [
            "name" => "ترس الحرب", "title" => "%s+ نقطة زياة على الكفاءة الحربية للبطل",
        ], 78 => [
            "name" => "ترس الحرب الكبير",
            "title" => "%s+ نقطة زياة على الكفاءة الحربية للبطل",
        ], 79 => [
            "name" => "بوق الحرب الصغير للتتار",
            "title" => "%s&#37;+ قوة إضافية ضد النتار",
        ], 80 => [
            "name" => "بوق حرب التتار",
            "title" => "%s&#37;+ قوة إضافية ضد النتار",
        ], 81 => [
            "name" => "بوق الحرب الكبير للتتار",
            "title" => "%s&#37;+ قوة إضافية ضد النتار",
        ],
    ], 4 => [
        16 => [
            "name" => "سيف الجندي الأول، القصير",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل جندي أول :  +%s  هجوم و +%s دفاع",
        ], 17 => [
            "name" => "سيف الجندي الأول",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل جندي أول : +%s هجوم و +%s دفاع",
        ], 18 => [
            "name" => "سيف الجندي الأول، الطويل",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل جندي أول : +%s هجوم و +%s دفاع",
        ], 19 => [
            "name" => "سيف حارس الإمبراطور القصير",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل حارس إمبراطور : +%s هجوم و +%s دفاع",
        ], 20 => [
            "name" => "سيف حارس الإمبراطور",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل حارس إمبراطور : +%s هجوم و +%s دفاع",
        ], 21 => [
            "name" => "سيف حارس الإمبراطور الطويل",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل حارس إمبراطور : +%s هجوم و +%s دفاع",
        ], 22 => [
            "name" => "سيف الجندي المهاجم القصير",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل جندي مهاجم : +%s هجوم و +%s دفاع",
        ], 23 => [
            "name" => "سيف الجندي المهاجم",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل جندي مهاجم : +%s هجوم و +%s دفاع",
        ], 24 => [
            "name" => "سيف الجندي المهاجم الطويل",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل جندي مهاجم : +%s هجوم و +%s دفاع",
        ], 25 => [
            "name" => "سيف سلاح الفرسان القصير",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل سلاح فرسان : +%s هجوم و +%s دفاع",
        ], 26 => [
            "name" => "سيف سلاح الفرسان",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل سلاح فرسان : +%s هجوم و +%s دفاع",
        ], 27 => [
            "name" => "سيف سلاح الفرسان الطويل",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل سلاح فرسان : +%s هجوم و +%s دفاع",
        ], 28 => [
            "name" => "رمح فرسان القيصر الخفيف",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل فرسان قيصر : +%s هجوم و +%s دفاع",
        ], 29 => [
            "name" => "رمح فرسان القيصر",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل فرسان قيصر : +%s هجوم و +%s دفاع",
        ], 30 => [
            "name" => "رمح فرسان القيصر الثقيل",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل فرسان قيصر : +%s هجوم و +%s دفاع",
        ], 31 => [
            "name" => "حربة الكتيبة القصيرة",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل كتيبة : +%s هجوم و +%s دفاع",
        ], 32 => [
            "name" => "حربة الكتيبة",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل كتيبة : +%s هجوم و +%s دفاع",
        ], 33 => [
            "name" => "حربة الكتيبة الطويلة",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل كتيبة : +%s هجوم و +%s دفاع",
        ], 34 => [
            "name" => "سيف المبارز القصير",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل مبارز : +%s هجوم و +%s دفاع",
        ], 35 => [
            "name" => "سيف المبارز",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل مبارز : +%s هجوم و +%s دفاع",
        ], 36 => [
            "name" => "سيف المبارز الطويل",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل مبارز : +%s هجوم و +%s دفاع",
        ], 37 => [
            "name" => "قوس رعد الإغريق القصير",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل رعد : +%s هجوم و +%s دفاع",
        ], 38 => [
            "name" => "قوس رعد الإغريق",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل رعد : +%s هجوم و +%s دفاع",
        ], 39 => [
            "name" => "قوس رعد الإغريق الطويل",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل رعد : +%s هجوم و +%s دفاع",
        ], 40 => [
            "name" => "عصا فرسان السلت الصغيرة",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل فرسان السلت : +%s هجوم و +%s دفاع",
        ], 41 => [
            "name" => "عصا فرسان السلت",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل فرسان السلت : +%s هجوم و +%s دفاع",
        ], 42 => [
            "name" => "عصا فرسان السلت الكبيرة",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل فرسان السلت : +%s هجوم و +%s دفاع",
        ], 43 => [
            "name" => "رمح فرسان الليل القصير",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل فرسان الليل : +%s هجوم و +%s دفاع",
        ], 44 => [
            "name" => "رمح فرسان الليل",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل فرسان الليل : +%s هجوم و +%s دفاع",
        ], 45 => [
            "name" => "رمح فرسان الليل الطويل",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل فرسان الليل : +%s هجوم و +%s دفاع",
        ], 46 => [
            "name" => "هراوة ابو هراوة الخفيفة",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل ابو هراوة : +%s هجوم و +%s دفاع",
        ], 47 => [
            "name" => "هراوة ابو هراوة",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل ابو هراوة : +%s هجوم و +%s دفاع",
        ], 48 => [
            "name" => "هراوة ابو هراوة الثقيلة",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل ابو هراوة : +%s هجوم و +%s دفاع",
        ], 49 => [
            "name" => "رمح ابو رمح القصير",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل ابو رمح : +%s هجوم و +%s دفاع",
        ], 50 => [
            "name" => "رمح ابو رمح",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل ابو رمح : +%s هجوم و +%s دفاع",
        ], 51 => [
            "name" => "رمح ابو رمح الطويل",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل ابو رمح : +%s هجوم و +%s دفاع",
        ], 52 => [
            "name" => "بطلة ابو فأس الخفيفة",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل ابو فأس : +%s هجوم و +%s دفاع",
        ], 53 => [
            "name" => "بلطة ابو فأس",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل ابو فأس : +%s هجوم و +%s دفاع",
        ], 54 => [
            "name" => "بلطة ابو فأس الثقيلة",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل ابو فأس : +%s هجوم و +%s دفاع",
        ], 55 => [
            "name" => "مطرقة مقاتل القيصر الخفيفة",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل مقاتل القيصر : +%s هجوم و +%s دفاع",
        ], 56 => [
            "name" => "مطرقة مقاتل القيصر",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل مقاتل القيصر : +%s هجوم و +%s دفاع",
        ], 57 => [
            "name" => "مطرقة مقاتل القيصرالثقيلة",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل مقاتل القيصر +%s هجوم و +%s دفاع",
        ], 58 => [
            "name" => "سيف فرسان الجرمان القصير",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل فرسان الجرمان : +%s هجوم و +%s دفاع",
        ], 59 => [
            "name" => "سيف فرسان الجرمان",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل فرسان الجرمان : +%s هجوم و +%s دفاع",
        ], 60 => [
            "name" => "سيف فرسان الجرمان الطويل",
            "title" => "%s+ كفاءة حربية للبطل<br />لكل فرسان الجرمان : +%s هجوم و +%s دفاع",
        ], 115 => [ //start
            'name' => 'Club of the Slave Militia',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Slave Militia',
        ], 116 => [
            'name' => 'Mace of the Slave Militia',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Slave Militia',
        ], 117 => [
            'name' => 'Morning Star of the Slave Militia',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Slave Militia',
        ], 118 => [ //start
            'name' => 'Hatchet of the Ash Warden',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Ash Warden',
        ], 119 => [
            'name' => 'Axe of the Ash Warden',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Ash Warden',
        ], 120 => [
            'name' => 'Battle Axe of the Ash Warden',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Ash Warden',
        ], 121 => [//start
            'name' => 'Short Khopesh of the Warrior',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Khopesh Warrior',
        ], 122 => [
            'name' => 'Khopesh of the Warrior',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Khopesh Warrior',
        ], 123 => [
            'name' => 'Long Khopesh of the Warrior',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Khopesh Warrior',
        ], 124 => [//start
            'name' => 'Spear of the Anhor Guard',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Anhor Guard',
        ], 125 => [
            'name' => 'Spear of the Anhor Guard',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Anhor Guard',
        ], 126 => [
            'name' => 'Lance of the Anhor Guard',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Anhor Guard',
        ], 127 => [//start
            'name' => 'Short Bow of the Resheph Chariot',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Resheph Chariot',
        ], 128 => [
            'name' => 'Bow of the Resheph Chariot',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Resheph Chariot',
        ], 129 => [
            'name' => 'Long Bow of the Resheph Chariot',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Resheph Chariot',
        ], 130 => [ //start
            'name' => 'Hatchet of the Mercenary',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Mercenary',
        ], 131 => [
            'name' => 'Axe of the Mercenary',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Mercenary',
        ], 132 => [
            'name' => 'Battle Axe of the Mercenary',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Mercenary',
        ], 133 => [ //start
            'name' => 'Composite Short Bow of the Bowman',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Bowman',
        ], 134 => [
            'name' => 'Composite Bow of the Bowman',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Bowman',
        ], 135 => [
            'name' => 'Composite Long Bow of the Bowman',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Bowman',
        ], 136 => [ //start
            'name' => 'Short Spatha Sword of the Steppe Rider',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Steppe Rider',
        ], 137 => [
            'name' => 'Spatha Sword of the Steppe Rider',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Steppe Rider',
        ], 138 => [
            'name' => 'Long Spatha Sword of the Steppe Rider',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Steppe Rider',
        ], 139 => [ //start
            'name' => 'Composite Short Bow of the Marksman',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Marksman',
        ], 140 => [
            'name' => 'Composite Bow of the Marksman',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Marksman',
        ], 141 => [
            'name' => 'Composite Long Bow of the Marksman',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Marksman',
        ], 142 => [ //start
            'name' => 'Short Spatha Sword of the Marauder',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Marauder',
        ], 143 => [
            'name' => 'Spatha Sword of the Marauder',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Marauder',
        ], 144 => [
            'name' => 'Long Spatha Sword of the Marauder',
            'title' => '%s+ Offensive strength for Hero<br />also +%s attack and +%s defense point for each Marauder',
        ],
    ], 5 => [
        94 => [
            "name" => "حذاء التجديد", "title" => "%s+ نقطة صحة/اليوم",
        ], 95 => [
            "name" => "حذاء الصحة", "title" => "%s+ نقطة صحة/اليوم",
        ], 96 => [
            "name" => "حذاء الشفاء", "title" => "%s+ نقطة صحة/اليوم",
        ], 97 => [
            "name" => "حذاء المرتزقة",
            "title" => "%s&#37;+ زيادة على السرعة الأساسية لمسير القوات للمسافات أبعد من  %s ميدان .",
        ], 98 => [
            "name" => "حذاء المحارب",
            "title" => "%s&#37;+ زيادة على السرعة الأساسية لمسير القوات للمسافات أبعد من  %s ميدان .",
        ], 99 => [
            "name" => "حذاء القائد",
            "title" => "%s&#37;+ زيادة على السرعة الأساسية لمسير القوات للمسافات أبعد من  %s ميدان .",
        ], 100 => [
            "name" => "حدوات الحصان الصغيرة",
            "title" => "%s+ ميدان في الساعة .",
        ], 101 => [
            "name" => "حدوات الحصان",
            "title" => "%s+ ميدان في الساعة .",
        ], 102 => [
            "name" => "حدوات حصان الكبيرة",
            "title" => "%s+ ميدان في الساعة .",
        ],
    ], 6 => [
        103 => [
            "name" => "حصان الركوب الخفيف", "title" => "%s+ ميدان في الساعة .",
        ], 104 => [
            "name" => "فرس أصيل",
            "title" => "%s+ ميدان في الساعة .",
        ], 105 => [
            "name" => "حصان محارب", "title" => "%s+ ميدان في الساعة .",
        ],
    ], 7 => [
        112 => [
            "name" => "ضمادات صغيرة",
            "title" => "يمكن تقليل خسائر المعارك مباشرة بعدها، إذا حملها البطل معه. يمكنك استعادة 25&#37; من الخسائر. يتم تفعيلها بعد المعارك. عودة الخسائر تحتاج 24 ساعة على الأقل<br>قابل للتكويم<br>يتم تفعيلها بعد المعارك.",
        ],
    ], 8 => [
        113 => [
            "name" => "ضمادات كبيرة",
            "title" => "يمكن تقليل خسائر المعارك مباشرة بعدها , إذا حملها البطل معه يمكن إستعادة 33&#37; من الخسائر. يتم تفعيلها بعد المعارك . عودة الخسائر تحتاج 24 ساعة على الأقل .<br />قابل للتكويم .<br />يتم تفعيلها بعد المعارك .",
        ],
    ], 9 => [
        114 => [
            "name" => "قفص",
            "title" => "يمكنك تدجين الحيوانات في الواحات وجلبها لقريتك، لتساهم في الدفاع عنها. لا داع للقلق، فهي لا تستهلك القمح , لن يكون هناك قتال , فقط تؤسر الحيوانات.",
        ],
    ], 10 => [
        107 => [
            "name" => "وثيقة ملفوفة",
            "title" => "ستزيد الوثيقة من خبرة البطل , كل وثيقة تساوي 10 نقاط خبرة",
        ],
    ], 11 => [
        106 => [
            "name" => "دهن الشفاء",
            "title" => "يمكنك زيادة صحة البطل بعد تعرضه للإصابة على ان لا تزيد عن  %s&#37;. , كل دهن يساوي 1 نقطة صحة .",
        ],
    ], 12 => [
        108 => [
            "name" => "إكسير التجديد",
            "title" => "أعد بطلك فوراً ومجاناً. إذا كان البطل حياً، لا يمكنك استخدام إكسير الحياة. يختفي وعاء إكسير الحياة بعد استعماله.",
        ],
    ], 13 => [
        110 => [
            "name" => "كتاب الحكمة",
            "title" => "إعادة توزيع نقاط البطل. يتم تصفير هذه النقاط , ويمكنك بعدها توزيع النقاط كيفما شئت",
        ],
    ], 14 => [
        109 => [
            "name" => "لائحة القوانين",
            "title" => "رفع الولاء في موطن البطل فوراً بنسبة %s&#37; لكل لائحة , على أن لا يزيد عن %s&#37; لكل قرية .",
        ],
    ], 15 => [
        111 => [
            "name" => "لوحة فنية",
            "title" => "باستخدامك هذه التحفة الفنيّة، ستتم فوراً إضافة نقاط حضارية مساوية لمجموع ما تنتجه كل قراك (+%s culture points), على أنّها لن تزيد عن %s نقطة حضارية لكل تحفة فنيّة .<br />يتم تفعيلها حين نقلها للبطل.<br />قابل للتكويم.",
        ],
    ],
];
//HeroMansion
$Definition['HeroMansion'] = ["AnnexedOasis" => "الواحات",
    "type" => "الاسم", "owner" => "لاعب",
    "Village" => "القرية",
    "Coordinates" => "الإحداثيات",
    "Resources" => "الموارد",
    "Loyalty" => "الولاء",
    "conquered" => "إحتلال",
    "Forest" => "غابة", "Clay" => "طين",
    "Hill" => "جبال", "Lake" => "بحيرة",
    "nextOasisInHeroMansionLevel" => "يمكنك إحتلال واحة عند مستوى قصر الابطال",
    "inReachOases" => "الواحات",
    "noSlot" => "لم يتم العثور على واحات",
    "duration" => "الوقت",
    "finished" => "تم الإنتهاء من",
    "AbandonOases" => "حذف الواحة",
    "areYouSure" => "هل أنت متأكد ؟",
    "del" => "حذف",
    "noNearOasis" => "لم يتم العثور على واحات قريبة",
];
//inGame
$Definition['inGame']['Enable this button to construct by clicking on the field'] = 'يمكنك تمكين هذا الزر من خلال النقر على الحقل';
$Definition['inGame']['Disable fast upgrade'] = 'تعطيل الترقية السريعة';
$Definition['inGame']['Inadmissible name/message'] = 'احرف غير مقبولة اسم/نص';
$Definition['inGame']['Error: very long input'] = 'خطأ: النص / النص طويل جدا.';
$Definition['inGame']['TrainingTime'] = 'وقت التدريب %s';
$Definition['inGame']['noTroopInBeingTrained'] = 'لا توجد أي عمليات تدريب';
$Definition['inGame']['FreeMerchants'] = 'التجار المتوفرون: %s/%s';
$Definition['inGame']['No further tasks available in this category'] = 'لا توجد مهام أخرى متوفرة في هذه الفئة';
$Definition['inGame']['Click here to extend your beginners protection by 3 days'] = 'إنقر هنا للحصول على وقت إضافي لحماية المبتدئين %s %s';
$Definition['inGame']['You cannot send resources to other players, attack them or be attacked by them while in beginners protection'] = 'لا يمكنك إرسال موارد أو قوات أوتعزيز لاعبين تحت حماية المبتدئين';
$Definition['inGame']['Are you sure you want to extend your beginners protection?'] = 'هل تريد بالتأكيد تمديد حماية المبتدئين ؟';
$Definition['inGame']['Hours'] = 'ساعات';
$Definition['inGame']['Days'] = 'ايام';
$Definition['inGame']['Minutes'] = 'شهور';
$Definition['inGame']['Seconds'] = 'ثواني';
$Definition['inGame']['extend'] = 'تمديد';
$Definition['inGame']['Exchange'] = 'مبادلة';
$Definition['inGame']['Are you sure you want to convert x gold to y silver?'] = 'هل تريد بالتأكيد تحويل %s ذهب %s الى فضه ؟';
$Definition['inGame']['maintenanceDesc'] = 'الموقع تحت الصيانة , جميع البيانات محفوظة <br /> المبرمجين يعملون على تعديل الموقع<br />قد تستغرق هذه العملية من دقائق الى ساعات .<br /> شكراً على صبرك <br /> فريق ترافيان';
$Definition['inGame']['serverTime'] = 'وقت السيرفر';
$Definition['inGame']['loyalty'] = 'الولاء';
$Definition['inGame']['needPlusDesc'] = 'هذه الميزة بحاجة للإشتراك في بلس';
$Definition['inGame']['noWorkShop'] = 'لا يوجد سوق في القرية عليك ببناء السوق';
$Definition['inGame']['DirectLinks'] = 'روابط مباشرة';
$Definition['inGame']['noStable'] = 'لا يوجد هناك إسطبل في هذه القرية';
$Definition['inGame']['noBarracks'] = 'ليس هناك ثكنة في هذه القرية';
$Definition['inGame']['noMarketplace'] = 'لا يوجد هناك سوق في هذه القرية';
$Definition['inGame']['changeVillageName'] = 'تغيير إسم القرية';
$Definition['inGame']['trap_desc'] = 'لديك %s فخ . %s الصياد ممتلئ بالأفخاخ';
$Definition['inGame']['newVillageName'] = 'إسم القرية الجديد';
$Definition['inGame']['DoubleClickToChangeVillageName'] = 'أنقر مزدوجاً لتغيير إسم القرية';
$Definition['inGame']['villages'] = 'القرى';
$Definition['inGame']['hideCoordinates'] = 'إخفاء الإحداثيات';
$Definition['inGame']['showCoordinates'] = 'عرض الإحداثيات';
$Definition['inGame']['Village statistics'] = 'إحصائيات القرية';
$Definition['inGame']['culture points'] = 'النقاط الحضارية';
$Definition['inGame']['Culture points generated to take control of another village:'] = 'يمكنك بناء قرية جديدة عند توفر النقاط الحضارية اللازمة :';
$Definition['inGame']['MaintenanceWork'] = 'اعمال صيانة';
$Definition['inGame']['run celebration'] = 'بدء إحتفال';
$Definition['inGame']['festival'] = 'إحتفال';
$Definition['inGame']['type'] = 'أكتب';
$Definition['inGame']['one celebration is running'] = 'هناك إحتفال جاري';
$Definition['inGame']['celebrationRunning'] = 'بدء الإحتفال';
$Definition['inGame']['Here you can subscribe or unsubscribe to our newsletter'] = 'هنا يمكنك الإشتراك أو إلغاء الإشتراك';
$Definition['inGame']['sitterChangeNameDesc'] = 'لا يمكنك تغيير إسم القرية';
$Definition['inGame']['The account will be deleted in'] = 'سيتم حذف الحساب في :	%s.';
$Definition['inGame']['infoBox']['ArtifactsWillBeReleasedIn'] = 'موعد ظهور التحف في %s ساعة ';
$Definition['inGame']['infoBox']['wwPlansWillBeReleasedIn'] = 'موعد ظهور المخطوطات في %s ساعة';
$Definition['inGame']['infoBox']['youCanBuildWWIn'] = 'ظهور مخططات البناء في  %s ساعة';
$Definition['inGame']['infoBox']['MedalsWillBeGivenIn'] = 'موعد تسليم الأوسمة في %s ساعة.';
$Definition['inGame']['infoBox']['AutoFinishTime'] = 'سينتهي السيرفر في %s ساعة بواسطة النتار';
$Definition['inGame']['infoBox']['CatapultAvailableIn'] = 'المقابض ستكون متاحة في %s ساعة';
$Definition['inGame']['infoBox']['PlusWillBeFinished'] = ' ينتهي حساب البلاس في %s.';
$Definition['inGame']['infoBox']['Boost1WillBeFinished'] = 'تنتهي الزيادة على الخشب في  %s ساعة';
$Definition['inGame']['infoBox']['Boost2WillBeFinished'] = 'تنتهي الزيادة على الطين في  %s ساعة';
$Definition['inGame']['infoBox']['Boost3WillBeFinished'] = 'تنتهي الزيادة على الحديد في  %s ساعة';
$Definition['inGame']['infoBox']['Boost4WillBeFinished'] = 'تنتهي الزيادة على القمح في  %s ساعة';
$Definition['inGame']['infoBox']['plusAccountExpired'] = 'إنتهى حساب بلس';
$Definition['inGame']['infoBox']['productionBoost1Expired'] = 'إنتهت الزيادة على الخشب';
$Definition['inGame']['infoBox']['productionBoost2Expired'] = 'إنتهت الزيادة على الطين';
$Definition['inGame']['infoBox']['productionBoost3Expired'] = 'إنتهت الزيادة على الحديد';
$Definition['inGame']['infoBox']['productionBoost4Expired'] = 'إنتهت الزيادة على القمح';
$Definition['inGame']['infoBox']['protection'] = 'ما زال لديك %s ساعة من حماية المبتدئين.';
$Definition['inGame']['infoBox']['Your account was banned!'] = 'حسابك موقوف';
$Definition['inGame']['infoBox']['Reason'] = 'السبب';
$Definition['inGame']['infoBox']['Not enough gold to extend this feature'] = 'Not enough gold to extend this feature.';
$Definition['inGame']['infoBox']['Reasons'] = [
    'Pushing' => 'دفع',
    'Cheat' => 'غش',
    'Hack' => 'خطأ برمجي',
    'Bug' => 'وصف',
    'Bad Name' => 'إسم مخالف',
    'Multiaccount' => 'تعدد',
    'Swearing' => 'دخول مخالف',
    'Insults' => 'إهانة',
    'Spam' => 'رسائل مزعجة',
    'Another' => 'أخرى',
    'Other' => 'أخرى'
];
$Definition['inGame']['infoBox']['AutoType_GoldPromotion'] = '<font color="#ff8000" size="2"><b>زيادة على الذهب</b></font><br />زيادة على الذهب بمقدار %s حتى %s.<br />ستتم إضافة الزيادة في حال شراء الذهب داخل فترة العرض<b>20%%</b> افضل من المعتاد';
$Definition['inGame']['infoBox']['Your account is in vacation until [time]'] = 'حسابك في إجازة حتى %s.';
$Definition['inGame']['infoBox']['day(s)'] = 'يوم/ ايام';
$Definition['inGame']['infoBox']['hour(s)'] = 'ساعة\ساعات';
$Definition['inGame']['infoBox']['overFlowMessage'] = 'سيتم حذف التقارير إذا وصل الصندوق لـ90% من الحجم المسموح للتقارير الاقدم من %d %s سيتم حذفها';
$Definition['inGame']['More Information'] = 'مزيد من المعلومات';
//Your report box has over 90% of its size used. Overflowing reports, which are older than one day may be deleted.
$Definition['inGame']['total_messages'] = 'الرسائل';
$Definition['inGame']['unReadMessages'] = 'رسائل غير مقروئة';
$Definition['inGame']['showMoreMessages'] = 'عرض المزيد من الرسائل';
$Definition['inGame']['hideMoreMessages'] = 'إخفاء الرسائل';
$Definition['inGame']['Confirm'] = 'تـأكيد';
$Definition['inGame']['InfoBox'] = 'الأخبار';
$Definition['inGame']['Delete this message permanently?'] = 'هل تريد حذف هذه الرسالة نهائياً ؟';
$Definition['inGame']['This tab is selected as your fav tab'] = 'يتم تحديد علامة التبويب هذه كعلامة التبويب المفضلة لديك';
$Definition['inGame']['Select this tab as fav'] = 'اختر علامة التبويب هذه كعلامة تبويب مفضلة';
$Definition['inGame']['sendMessage'] = 'إرسال رسالة';
$Definition['inGame']['zoom_in'] = 'تكبير';
$Definition['inGame']['zoomIn'] = 'تكبير';
$Definition['inGame']['available'] = 'متوفر: ';
$Definition['inGame']['Amount'] = 'الكمية';
$Definition['inGame']['train_troops'] = 'تدريب القوات';
$Definition['inGame']['bannedSmallPage'] = 'أنت موقوف';
$Definition['inGame']['in_training'] = 'تحت التدريب';
$Definition['inGame']['next_creating'] = 'سيتم تدريب الفخ المقبل في %s ساعة';
$Definition['inGame']['next_training'] = 'سيتم تدريب الوحدة المقبلة بعد %s ساعة';
$Definition['inGame']['in_creating'] = 'تدريب في';
$Definition['inGame']['train'] = 'تدريب';
$Definition['inGame']['palaceNoTrainText'] = 'لتدريب مستوطنين او رئساء او حكماء او زعماء انت بحاجة لقصر مستوى 10 او 15 او 20';
$Definition['inGame']['residenceNoTrainText'] = 'لتدريب مستوطنين او رئساء او حكماء او زعماء انت بحاجة لسكن مستوى 10 او 20';
$Definition['inGame']['noTroops'] = 'لم يتم البحث عن أي قوات لهذا المبنى<br />يجب عليك البحث عن قوات هذا المبنى في الأكاديمية';
$Definition['inGame']['Profile']['Profile'] = 'الملف الشخصي';
$Definition['inGame']['Profile']['edit profile description'] = 'تعديل الوصف';
$Definition['inGame']['Options']['Options'] = 'إعدادات';
$Definition['inGame']['Options']['edit account settings'] = 'تعديل الإعدادات';
$Definition['inGame']['Options']['you may not edit settings of another account'] = 'لا يمكنك تعديل حساب آخر';
$Definition['inGame']['Forum']['Forum'] = 'المنتدى';
$Definition['inGame']['Forum']['Meet other players on our external forum'] = 'التواصل مع اللاعبين في المنتدى';
$Definition['inGame']['Help']['Help'] = 'المساعدة';
$Definition['inGame']['Help']['Manuals, Answers and Support'] = 'الدعم';
$Definition['inGame']['Logout']['Logout'] = 'خروج';
$Definition['inGame']['Logout']['Log out from the game'] = 'تسجيل الخروج من اللعبة';
$Definition['inGame']['Navigation']['Resources'] = 'الموارد';
$Definition['inGame']['Navigation']['Buildings'] = 'المباني';
$Definition['inGame']['Navigation']['Map'] = 'الخارطة';
$Definition['inGame']['Navigation']['Statistics'] = 'الإحصائيات';
$Definition['inGame']['Navigation']['Reports'] = 'التقارير';
$Definition['inGame']['Navigation']['newReports'] = 'تقرير جديد ';
$Definition['inGame']['Navigation']['Messages'] = 'الرسائل';
$Definition['inGame']['Navigation']['newMessages'] = ' رسائل جديدة';
$Definition['inGame']['Navigation']['Buy gold'] = 'شراء الذهب';
$Definition['inGame']['gold'] = 'الذهب';
$Definition['inGame']['goldShort'] = 'الذهب';
$Definition['inGame']['silver'] = 'الفضة';
$Definition['inGame']['silverShort'] = 'الفضة';
$Definition['inGame']['endAt'] = 'ينتهي في';
$Definition['inGame']['finishNow'] = 'ينتهي الآن';
$Definition['inGame']['finishNowSitterNoPermission'] = 'ليس لديك صلاحية إستخدام الذهب';
$Definition['inGame']['finishNowWWDisabled'] = 'لا يمكنك إستخدام الذهب في المعجزة';
$Definition['inGame']['resources']['resources'] = 'الموارد';
$Definition['inGame']['resources']['r0'] = 'اللكل';
$Definition['inGame']['resources']['r1'] = 'الخشب';
$Definition['inGame']['resources']['r2'] = 'الطين';
$Definition['inGame']['resources']['r3'] = 'الحديد';
$Definition['inGame']['resources']['r4'] = 'القمح';
$Definition['inGame']['resources']['r5'] = 'محاصيل القمح';
$Definition['inGame']['Small celebration'] = 'إحتفال صغير';
$Definition['inGame']['Big celebration'] = 'إحتفال كبير';
$Definition['inGame']['Hold a celebration'] = 'بدء إحتفال';
$Definition['inGame']['productionBoost']['activate'] = 'فعل';
$Definition['inGame']['productionBoost']['remainingTime'] = 'الوقت المتبقي : %s يوم في %s.';
$Definition['inGame']['productionBoost']['remainingTime2'] = 'ينتهي في %s ساعة';
$Definition['inGame']['productionBoost']['woodProductionBoost'] = 'إنتاج خشب إضافي';
$Definition['inGame']['productionBoost']['clayProductionBoost'] = 'إنتاج طين إضافي';
$Definition['inGame']['productionBoost']['ironProductionBoost'] = 'إنتاج حديد إضافي';
$Definition['inGame']['productionBoost']['cropProductionBoost'] = 'إنتاج قمح إضافي';
$Definition['inGame']['productionBoost']['extend'] = 'تمديد';
$Definition['inGame']['productionBoost']['activate now'] = 'تفعيل الآن <br> مدة الزيادة أيام %s';
$Definition['inGame']['productionBoost']['extend now'] = 'تمديد الآن <br> مدة الزيادة أيام %s';
$Definition['inGame']['plus']['remainingTime'] = 'الوقت المتبقي %s في يوم %s';
$Definition['inGame']['plus']['remainingTime2'] = 'ينتهي في %s';
$Definition['inGame']['plus']['activate'] = 'فعل';
$Definition['inGame']['plus']['extend'] = 'تمديد';
$Definition['inGame']['plus']['activate now'] = ' تفعيل الآن <br> الوقت :  %s يوم';
$Definition['inGame']['plus']['extend now'] = 'تمديد الآن <br> الوقت : %s يوم';
$Definition['inGame']['sitterNoPermForGold'] = 'لا يمكنك ذلك وأنت وكيل , الإ اذا حصلت على صلاحيات الذهب';
$Definition['inGame']['continue'] = 'متابعة';
$Definition['inGame']['stockBar']['production']['r1'] = 'الخشب||الإنتاج : %s<br>يمتلئ في %s<br>اضغط هنا لمزيد من المعلومات';
$Definition['inGame']['stockBar']['production']['r2'] = 'الطين||الإنتاج : %s<br>يمتلئ في %s<br>اضغط هنا لمزيد من المعلومات';
$Definition['inGame']['stockBar']['production']['r3'] = 'الحديد||الإنتاج : %s<br>يمتلئ في %s<br>إظغط هنا لمزيد من المعلومات';
$Definition['inGame']['stockBar']['production']['r4'] = 'القمح||الإنتاج : %s<br>يمتلئ في %s<br>اضغط هنا لمزيد من المعلومات';
$Definition['inGame']['stockBar']['production']['r4Empty'] = 'Crop||Production less building upkeep: %s<br><span class="red">Empty in: %s</span><br>Click for more information';
$Definition['inGame']['stockBar']['production']['r5'] = 'القمح المجاني||إحتياطي القمح : %s<br>اضغط هنا لمزيد من المعلومات';
$Definition['inGame']['bannedPage'] = 'مرحباً %s!
</br></br>لقد تم إيقافك بسبب إنتهاك قواعد اللعبة , كل لاعب يحق له حساب واحد في السيرفر
</br></br>حتى لا تحصل منك أي إنتهاك لقواعد اللعبة في المستقبل , يجب عليك قراءة قوانين اللعبة بعناية :
</br></br><center><a href="http://' . WebService::getJustDomain() . 'spielregeln.php">» قواعد اللعبة</a></center>
</br></br></br>
لمواصلة اللعب يجب عليك مراسلة الصياد
</br></br><center><a href="messages.php?t=1&id=2">» إكتب رسالة </a></center>
</br></br>
يجب الإنتباه للنقاط التالية :
</br></br>
لا يتم إيقافك بدون سبب , يجب عليك فهم ذلك
</br>
الصياد لديه معلومات كافية عن أي لاعب في السيرفر , فلا تحاول التبرير بالإعذار لإنتهاكك قواعد اللعبة </br>
كن متعاوناً ومحترمً في التعاون مع الصياد , ذلك قد يقلل العقوبة
</br>
إذا تم التأخر عليك , فإن الصياد غير متوفر على الشبكة عند تواجدة سيرد عليك</br>
 لن يتم حل المشكلة بإرسالك اكثر من رسالة , بل إنه يأخر من حل المشكلة , خاصه انه لم يقرأها حتى الآن
</br>
إذا تم حظرك بشكل خاطئ , يرجى ان تبقى هادئً عند التحدث مع الصياد وإخبره عن وجهة نظرك , سيرحب بذلك
</p>
<small><i>مع أطيب التحيات , فريق ترافيان</i></small></p>';
$Definition['inGame']['bannedPageWithTime'] = 'مرحباً %s!
</br></br>لقد تم إيقافك بسبب : %s. كل لاعب يحق له حساب واحد فقط في السيرفر
</br></br>حتى لا تتعرض لهذا الإيقاف مرة إخرى يرجى قرائة الشروط والقوانين :
</br></br><center><a href="http://' . WebService::getJustDomain() . 'spielregeln.php">» قوانين ترافيان</a></center>
</br></br></br>
لمواصلة اللعب يجب عليك الإنتظار حتى  %s أو الإتصال بالصياد
</br></br><center><a href="messages.php?t=1&id=2">» أكتب رسالة</a></center>
</br></br>
يجب الإنتباه للنقاط التالية :
</br></br>
لا يتم إيقافك بدون سبب , يجب عليك فهم ذلك</br>
الصياد لديه معلومات كافية عن أي لاعب في السيرفر , فلا تحاول التبرير بالإعذار لإنتهاكك قواعد اللعبة</br>
كن متعاوناً ومحترمً في التعاون مع الصياد , ذلك قد يقلل العقوبة</br>
إذا تم التأخر عليك , فإن الصياد غير متوفر على الشبكة عند تواجدة سيرد عليك</br>
 لن يتم حل المشكلة بإرسالك اكثر من رسالة , بل إنه يأخر من حل المشكلة , خاصه انه لم يقرأها حتى الآن
</br>
إذا تم حظرك بشكل خاطئ , يرجى ان تبقى هادئً عند التحدث مع الصياد وإخبره عن وجهة نظرك , سيرحب بذلك
</p>
<small><i>مع أطيب التحيات , فريق ترافيان</i></small></p>';
$Definition['inGame']['bannedClickPage'] = '
<h2>مرحباً %s,</h2>
<br/>
<center><b>إن حسابك موقوف !</b>
    <br>
</center>
<div>يمكن أن هذا الحظر مؤقت قد يصل لـ20 ثانية
    <br>
    <br>او ربما حصل بسبب :
    <br>
    <br>
    <li>إستخدام البرامج</li>
    <li>دفع</li>
    <li>سبام</li>
    <li>إهانة</li>
    <li>غش</li>
    <br>
    <br>لمزيد من المعلومات الإتصال بـ <a href="messages.php?t=1&id=4">الصياد</a> او <a href="messages.php?t=1&id=1">الدعم</a> او مراسلة الإيميل <b>travianarab@yahoo.com</b>.
    <br>
    <br>تحياتنا الحارة</div>
';
$answersUrl = getAnswersUrl();
$Definition['inGame']['QUEST_MESSAGE_SUBJECT'] = 'نصائح لبدء اللعب';
$Definition['inGame']['QUEST_MESSAGE'] = <<<HTML
مرحباً %s,<br><br>
<br><br>
ترافيان - لعبة الاستراتيجيات الأشهر في الانترنت<br><br>
<br><br>
ترافيان واحدة من أنجح ألعاب المتصفحات في العالم. في ترافيان، تؤسس امبراطوريتك، توسّعها وتدّرب جيشاً لحمايتها، في النهاية، تتساعد مع لاعبين آخرين لتنافسوا على بناء أعجوبة العالم.
 <a href="{$answersUrl}index.php?aid=104#go2answer">النجدة لقد أصبحت مزرعة !</a><br><br>
<br><br>
في البداية، يمكنك في كثير من الأحيان تجنب هجمات العدو، ولكن يجب عليك الدفاع عن نفسك ضد محاولات قهر. دون القوات، لن تكون قادرة على مساعدة نفسك ولا حلفائكم. مزيد من المعلومات هنا: <a href="{$answersUrl}index.php?aid=172#go2answer">القوات</a><br><br>
<br><br>
وبمجرد أن يستقر غبار المعارك الأولى، ستبدأ أقوى التحالفات في القتال من أجل السيطرة على أراضي أكبر من أي وقت مضى. وسوف تدمر التهديدات والمنافسين وتشكل تحالفات جديدة. وتحالفات قوية بشكل خاص سوف تكافح في وقت لاحق للسيطرة على القطع الأثرية القوية و - كعرض لقوتهم الخاصة - لتكون أول من نصب عجب من العالم.<br><br>
<br><br>
ضبط أهدافك الشخصية إلى الوقت الذي يمكن أن تصبح جاهزاً للعب - نمي أكثر طموحا لإهدافك، والمزيد من الوقت سيكون مطلوبا للبناء والتفاوض والقتال.<br><br>
<br><br>
ولكن لن يكفي الحديث! الحصول معنا جنبا إلى جنب مع الأصدقاء القدامى والجدد، ومحاربة أعدائك - والمتعة معا!
HTML;
$Definition['links']['These links are found helpful by many players Add them to your personal link list'] = 'هذه الروابط وجدت انها مفيدة من قبل العديد من اللاعبين. إضافتها إلى قائمة الروابط الشخصية الخاصة بك.';
$Definition['links']['Recommended links'] = 'الروابط الموصى بها';
$Definition['links']['recommenced_links'] = [
    [
        'name' => 'أسئلة ترافيان', 'url' => getAnswersUrl() . '*',
    ], [
        'name' => 'نظرة عامة على القرية', 'url' => 'dorf3.php?s=0',
    ], [
        'name' => 'نظرة عامة على المستودعات', 'url' => 'dorf3.php?s=3',
    ], [
        'name' => 'تقارير التحالف', 'url' => 'allianz.php?s=3',
    ], [
        'name' => 'القرى المجاورة', 'url' => 'reports.php?t=5',
    ], [
        'name' => 'الخيارات', 'url' => 'options.php',
    ], [
        'name' => 'التواصل الإجتماعي', 'url' => getForumUrl() . '*',
    ],
];
$Definition['links']['Define often-used pages as direct links Place a * at the end of the link and it will be opened in a new tab'] = 'قائمة الروابط، تستخدم لوضع روابط مباشرة إلى الصفحات / الأبنية / قرى اللاعبين التي تفتحها دوماً. يمكنك وضع * بعد الرابط لتفتحه في لسان مستقل.';
$Definition['links']['Delete entry'] = 'حذف المدخلات';
$Definition['links']['add entry'] = 'إضافة';
$Definition['links']['No'] = 'لا';
$Definition['links']['Link Name'] = 'اسم الرابط';
$Definition['links']['Link Target'] = 'هدف الرابط';
$Definition['links']['Link list'] = 'قائمة الرابط';
$Definition['links']['linkWillOpenInNewTab'] = 'فتح الرابط في لسان جديد';
$Definition['links']['edit link list'] = 'تحرير قائمة الروابط';
$Definition['links']['Travian Plus allows you to make a link list'] = 'بلس يسمح لك بإضافة قائمة الروابط';
//Login
$Definition['Login']['Server will start in'] = 'يبدأ السيرفر في :';
$Definition['Login']['registrationSuccessful'] = 'شكراً للتسجيل , سيتم إرسال رسالة لك عند بدء السيرفر';
$Definition['Login']['registrationSuccessful'] .= ' إنتظر الرسالة .';
$Definition['Login']['Login'] = 'دخول';
$Definition['Login']['Welcome'] = 'مرحباً بكم في السيرفر %s';
$Definition['Login']['noJavascript'] = 'تم إلغاء تنشيط جافا سكريبت. يجب تفعيله في إعدادات المتصفح الخاص بك لتكون قادرة على لعب ترافيان.';
$Definition['Login']['accountNameOrEmailAddress'] = 'اسم اللاعب او الإيميل';
$Definition['Login']['pass'] = 'كلمة السر :';
$Definition['Login']['lowResOption'] = 'نسخة اللاعب ';
$Definition['Login']['lowRes'] = 'النسخة الخفيفة وظائف خريطة أقل';
$Definition['Login']['lowResInfo'] = '(في حال كان اتصال النت ضعيفاً)';
$Definition['Login']['Captcha'] = 'التحقق';
$Definition['Login']['CaptchaError'] = 'الرجاء إلتأكد من التحقق مرة اخرى';
$Definition['Login']['PasswordForgotten?'] = 'طلب كلمة سر جديدة ؟ ';
$Definition['Login']['We will send you a new password It will be activated as soon as you confirm receipt?'] = 'سوف نرسل لك كلمة سر جديدة. سيتم تفعيلها بمجرد تأكيد الاستلام.';
$Definition['Login']['Request new CAPTCHA'] = 'طلب تحقق جديد';
$Definition['Login']['Email'] = 'الإيميل';
$Definition['Login']['Request password'] = 'طلب كلمة سر';
$Definition['Login']['Sent to'] = 'تم إرسال كلمة السر';
$Definition['Login']['EmailEmpty'] = 'الإيميل غير مستخدم';
$Definition['Login']['PasswordChangedSuccessfully'] = 'تم تغيير كلمة السر بنجاح !';
$Definition['Login']['PasswordFail'] = 'لم يتم تغيير كلمة السر , ربما تم إستخدام الرمز بالفعل';
$Definition['Login']['pw_forgot_email'] = nl2br('
<div style="الإتجاه rtl; text-align: right">
مرحباً %s
لقد طلبت إرسال كلمة المرور الخاصة بك في
ترافيان. في الرسالة التالية ستجد كل ما
يتعلق بمعلومات دخولك على عضويتك في لعبة
ترافيان:
---------------------------------------------------------------------------------------------------------------------------------

بيانات الدخول:

اسم اللاعب:  %s
عنوان البريد الإلكتروني:  %s
كلمة المرور: %s
رابط السيرفر: %s

---------------------------------------------------------------------------------------------------------------------------------
قم رجاء بالضغط على الرابط التالي لتفعيل
كلمة السر الجديدة. بعد الضغط يتم إلغاء كلمة
السر القديمة وتصبح باطلة:
<a href="%s">%s</a>

في حال أردت إعادة تعيين كلمة السر هذه،
يتوجب عليك الدخول لصفحة العضوية، وبعدها
اختيار القائمة "العضوية".

في حال أنك تذكرت كلمة السر الخاصة بك، أو
أنك لم تقم بالاساس بطلبها، تجاهل هذه
الرسالة رجاء.

مع تحيات فريق ترافيان
</div>
بيانات الناشر:

Travian Games GmbH, Wilhelm-Wagenfeld-Str. 22, 80807 München, Deutschland
Tel: +49 (0)89 3249150, Fax: +49 (0)89 324915970, www.traviangames.de
CEO: Siegfried Müller
commercial court: Amtsgericht München, HRB 173511,
tax number: DE 246258085');
$Definition['Login']['userErrors']['empty'] = 'تسجيل الدخول';
$Definition['Login']['userErrors']['notFound'] = ' تسجيل الدخول المطلوب غير موجود تأكد من عنوان السيرفر';
$Definition['Login']['pwErrors']['empty'] = 'كلمة السر :';
$Definition['Login']['pwErrors']['wrong'] = 'كلمة السر خاطئة';
$Definition['Login']['pwErrors']['error21Days'] = 'لم يتم تسجيل دخول هذا المستخدم لأكثر من 21 يوما.';
//Logout
$Definition['Logout'] = ["Logout" => "تم الخروج بنجاح .",
    "delete_cookies" => "حذف ملفات تعريف الإرتباط",
    "thanks_for_your_visit" => 'نشكرك على الزيارة',
    "cookieDesc" => "هل هناك أشخاص آخرون تستعمل هذا الجهاز؟ للأمان على بياناتك يفضل أن تحذف الكوكيز",
    "back_to_the_game" => "العودة للعبة",
];
//Manual
$Definition['Manual'] = ['fightingStrength' => "قوة القتال",
    "fightingStrengthAgainstInf" => "قوة القتال ضد",
    'fightingStrengthAgainstCav' => "قوة القتال ضد",
    "speed" => "speed", "CarrySize" => "يحمل",
    "TravianAnswers" => "اجوبة ترافيان",
    "moreInTravianAnswers" => "المزيد في أجوبة ترافيان",
    "durationOfTraining" => "وقت التدريب",
    "fieldsPerHour" => "الحقول في الساعة",
    "preRequests" => "المتطلبات الأساسية",
    "toOverview" => "نظرة عامة", "None" => "لا شيء",
    "and" => "و",
    "construction_time" => "وقت البناء",
    "for" => "for", "level" => "المستوى",
    "BuildingPlan" => "مخطط البناء",
    "Capital" => "عاصمة",
    "onlyForTribe" => "فقط لـ", "Units" => "وحدات",
];
//Map
$Definition['map'] = ["player" => "اللاعب",
    "alliance" => "التحالف",
    "owner" => "المالك",
    "Tribe" => "القبيلة",
    "Village" => "قرية",
    "Annex Oasis" => "الواحات",
    "sendTroops" => "ارسال قوات",
    "no free slots" => "قصر الابطال لدية مجال لواحة جديدة الان",
    "distribution" => "توزيع",
    "pop" => "السكان",
    "capital" => "عاصمة",
    'x is under protection to y' => 'اللاعب تحت حماية المبتدئين حتى : %s',
    'banned' => 'هذا اللاعب موقوف , بسبب إنتهاك قواعد اللعبة',
    'sendMerchants' => 'ارسال تجار',
    "constructMarketplace" => "بناء السوق",
    "readySettlers" => "المستوطنون جاهزون",
    "foundNewVillage" => "بناء قرية جديدة !",
    "culturePointsForNewVillage" => "لم تكتمل النقاط الحضارية بعد !",
    "noResourcesForNewVillage" => "لا توجد موارد كافية , يجب توفر 750 موارد من كل مورد",
    "Add to farm list" => "إضافة مزرعة للقائمة",
    "noFarmList" => "لا توجد قائمة مزارع في هذه القرية , قم بإنشاء قائمة مزارع جديدة",
    "Edit farm list (Oasis already in farm list x)" => "تحرير قائمة المزارع (هناك واحة بالفعل %s)",
    "Edit farm list (Village already in farm list x)" => "تحرير قائمة المزارع (هناك هذه القرية بالفعل %s)",
    "move up" => "تحريك للأعلى",
    "move down" => "تحريك للأسفل",
    "move right" => "تحريك لليمين",
    "move left" => "تحريك لليسار",
    "for this feature you need the goldclub actived" => "لهذه الميزة تحتاج إلى الإشتراك بنادي الذهب",
    "vacationModeActive" => "اللاعب في إجازة",
    'noUnits' => 'لا شيء',
    'units' => 'وحدات',
    'Bonus' => 'زيادة',
    'Reports' => 'التقارير',
    'Surrounding' => 'الجوار',
    'Other Information' => 'معلومات أخرى',
    'fields' => 'ميدان',
    'Distance' => 'المسافة',
    'Simulate raid' => 'المحاكاة',
    'No information<br>available!' => 'لا معلومات<br>متاحة !',
    'landscape_desc' => 'الموقع',
    'centerMap' => 'عرض الموقع',
    'constructRallyPoint' => 'بناء نقطة التجمع',
    'startAdventure' => 'بدء المغامرة',
    "mark_not_found" => "لا توجد نتائج",
    "ok" => "حسناً",
    "markAlliance" => "علامات التحالف",
    "markPlayer" => "علامات اللاعب",
    "markField" => "علامات",
    "players" => "اللاعبين",
    "please_resend_all_data" => "جميع المعلومات مطلوبة",
    "alliances_mark_exists" => "هذا التحالف بالفعل موجود",
    "player_mark_exists" => "تم وضع علامة على هذا الاعب بالفعل",
    "invalid_coordinates" => "الإحداثيات غير صحيحة",
    "colour_does_not_exists" => "لون غير صالحة",
    "no_alliance_map_mark_error" => "اللاعب لا يتبع لإي تحالف",
    "map" => "الخارطة",
    "zoomIn" => "تكبير",
    "zoomOut" => "تصغير",
    "zoomLevel" => "مستوى التكبير",
    "filter" => "فلتر",
    "showAllianceMarks" => "إظهار علامات التحالف",
    "hideAllianceMarks" => "إخفاء علامات التحالف",
    "showUserMarks" => "عرض علامات اللاعب",
    "hideUserMarks" => "إخفاء علامات اللاعب",
    "minimap" => "خارطة مصغرة",
    "outline" => "الإحداثيات",
    "users" => "اللاعب: ",
    "population" => "السكان",
    "tribe" => "القبيلة",
    "village" => "قرية",
    "loadingData" => "إنتظر ..",
    "landscape" => "الإحداثيات",
    "freeOasis" => "واحة غير محتلة",
    "occupiedOasis" => "واحة محتلة",
    "natarsVillage" => "قرية نتار",
    "bounty" => "مكافأة",
    "difficulty" => "الصعوبة",
    "arrival" => "الوصول في",
    "supply" => "تعزيز",
    "spy" => "تعزيز",
    "return" => "إرجاع",
    "raid" => "هجوم للنهب",
    "attack" => "هجوم كامل",
    "save" => "حفظ",
    "cancel" => "إلغاء",
    'flags' => "الأعلام",
    "Adventure" => "مغامرة",
    "normal" => "عادية",
    "hard" => "صعبة",
    "ownPlayerMarkTitle" => "العلامات الخاصة",
    "ownAllianceMarks" => "علامات التحالف الخاصة",
    "ownFlags" => "الأعللام الخاصة",
    "allianceMarkTitle" => 'علامات التحالف الخاصه',
    "playerMarksTitle" => "علامات لاعب تحالفي",
    "allianceFlags" => 'علامات تحالفي',
    "largeMap" => "Fullscreen",
    "needPlus" => "من أجل إستخدام هذه الميزة يجب تفعيل بلس",
    "cropFinder" => "مكتشف القمح",
    "needClub" => "من أجل إستخدام هذه الميزة يجب تفعيل نادي الذهب",
    "YouAreBanned" => "انت موقوف",
    "YouAreInVacationMode" => "انت في إجازة .",
    "YouAreProtected" => "لا يمكنك القيا بهذا الإجراء , مازلت تحت حماية المبتدئين",
    'mapFlagsLimitReached' => 'لقد وصلت إلى الحد الأقصى لعدد 5 أعلام. يرجى حذف علامة واحدة قبل أن تتمكن من إضافة علامة أخرى.',
    'mapMarksLimitReached' => 'لقد وصلت إلى الحد الأقصى لعدد 10 علامات. يرجى حذف علامة واحدة قبل أن تتمكن من إضافة علامة أخرى.',
];
//Market place
$Definition['MarketPlace']['While you are in beginners protection you are only allowed to do a 1:1 or better trade'] = 'وانت في حماية المبتدئين يسمح لك إستخدام عروض 1:1 .';
$Definition['MarketPlace']['x\'s offering has been accepted'] = 'x\'s تم قبول العرض'; //new
$Definition['MarketPlace']['are on their way to you'] = 'التجار في الطريق إليك';
$Definition['MarketPlace']['have been dispatched by your merchants'] = 'تم إرسالها تجارك على الطريق الآن';
$Definition['MarketPlace']['Management'] = 'نظرة عامة';
$Definition['MarketPlace']['SendResources'] = 'إرسال الموارد';
$Definition['MarketPlace']['resourcesSent'] = 'تم إرسال الموارد';
$Definition['MarketPlace']['sitterNoPermissions'] = 'ك وكيل , يمكنك إستخدام ذلك إذا اعطاك الموكل الصلاحيات';
$Definition['MarketPlace']['sameVillage'] = 'تجارك بالفعل بهذه القرية .';
$Definition['MarketPlace']['Buy'] = 'شراء';
$Definition['MarketPlace']['Offer'] = 'عرض';
$Definition['MarketPlace']['Delete'] = 'حذف';
$Definition['MarketPlace']['Select x as favor tab'] = 'إختيار %s كـ علامة تبويب مفضلة';
$Definition['MarketPlace']['This tab is set as favourite'] = 'تم تعيين علامة التبويب كـ مفضلة';
$Definition['MarketPlace']['Free merchants'] = 'التجارة الحرة';
$Definition['MarketPlace']['Own merchants and NPC'] = 'التجارة الخاصه';
$Definition['MarketPlace']['Merchants offering resources'] = 'تجار في السوق';
$Definition['MarketPlace']['you are banned'] = 'انت موقوف بسبب إنتهاك قواعد اللعبة';
$Definition['MarketPlace']['Merchants underway'] = 'تجار على الطريق';
$Definition['MarketPlace']['Exchange resources'] = 'تبادل الموارد';
$Definition['MarketPlace']['Trade routes'] = 'طرق التجارة';
$Definition['MarketPlace']['Create new trade route'] = 'إنشاء مسار تجاري جديد';
$Definition['MarketPlace']['Start'] = 'بدء';
$Definition['MarketPlace']['Merchants'] = 'التجار';
$Definition['MarketPlace']['Action'] = 'عمل';
$Definition['MarketPlace']['GoldClub'] = 'نادي الذهب';
$Definition['MarketPlace']['Description'] = 'الوصف';
$Definition['MarketPlace']['Trade route to x'] = 'مخطط تجاري إلى %s';
$Definition['MarketPlace']['edit'] = 'تعديل';
$Definition['MarketPlace']['cancel'] = 'إلغاء';
$Definition['MarketPlace']['Resources'] = 'الموارد';
$Definition['MarketPlace']['Target village'] = 'القرية الهدف';
$Definition['MarketPlace']['Target'] = 'القرية';
$Definition['MarketPlace']['all'] = 'اللكل';
$Definition['MarketPlace']['only mine'] = 'فقط انا';
$Definition['MarketPlace']['others'] = 'الأخرين';
$Definition['MarketPlace']['Show villages in list'] = 'عرض القرى';
$Definition['MarketPlace']['Start time'] = 'بدء الوقت';
$Definition['MarketPlace']['nextTradeRoute'] = 'الإرسال التالي في %s انت بحاجه %s تاجر';
$Definition['MarketPlace']['not enough merchants'] = 'التجار لا تكفي';
$Definition['MarketPlace']['offer added successfully'] = 'تمت إضافة العرض بنجاح';
$Definition['MarketPlace']['own alliance only'] = 'فقط لتحالفي';
$Definition['MarketPlace']['max, time of transport'] = 'اعلى وقت نقل';
$Definition['MarketPlace']["Own offers"] = 'المعروض';
$Definition['MarketPlace']["I'm searching"] = 'البحث عن';
$Definition['MarketPlace']["Alliance"] = 'التحالف';
$Definition['MarketPlace']["hours"] = 'ساعة';
$Definition['MarketPlace']["accept offer"] = 'قبول العرض';
$Definition['MarketPlace']["yes"] = 'نعم';
$Definition['MarketPlace']["no"] = 'لا';
$Definition['MarketPlace']["Offers at the marketplace"] = 'العروض في السوق';
$Definition['MarketPlace']["Offered to me"] = 'عروضي';
$Definition['MarketPlace']["Wanted from me"] = 'المطلوب مني';
$Definition['MarketPlace']["Player"] = 'اللاعب';
$Definition['MarketPlace']["Duration"] = 'الوقت';
$Definition['MarketPlace']["Action"] = 'عمل';
$Definition['MarketPlace']["onReturnMerchants"] = 'التجار العائدون';
$Definition['MarketPlace']["onComingMerchants"] = 'التجار القادمون';
$Definition['MarketPlace']["onGoingMerchants"] = 'التجار المغادرون';
$Definition['MarketPlace']["noResourcesEntered"] = 'لم يتم إختيار أي موارد';
$Definition['MarketPlace']["noVillageWithName"] = 'لم يتم العثور على القرية';
$Definition['MarketPlace']["noVillageInCoordinate"] = 'لا توجد قرية في هذه الإحداثيات';
$Definition['MarketPlace']["enterVillageNameOrCoordinate"] = 'الإحداثيات غير صحيحة';
$Definition['MarketPlace']["PlayerBanned"] = 'هذا اللاعب موقوف';
$Definition['MarketPlace']["serverFinished"] = 'السيرفر إنتهى';
$Definition['MarketPlace']["go"] = 'ذهاب';
$Definition['MarketPlace']["goBack"] = 'عودة';
$Definition['MarketPlace']["or"] = 'او';
$Definition['MarketPlace']["Village"] = 'القرية';
$Definition['MarketPlace']["Arrival"] = 'الوصول :';
$Definition['MarketPlace']["in"] = 'بعد';
$Definition['MarketPlace']["hour"] = 'ساعه';
$Definition['MarketPlace']["at"] = 'في';
$Definition['MarketPlace']["sendToVillage"] = 'نقل موارد للقرية';
$Definition['MarketPlace']["returnFromVillage"] = 'العودة من القرية';
$Definition['MarketPlace']["receiveFromVillage"] = 'قادمون من القرية';
$Definition['MarketPlace']["Each of your merchants can carry"] = 'يمكن لكل تاجر حمل';
$Definition['MarketPlace']["Each of your merchants can carry resources"] = 'موارد';
$Definition['MarketPlace']["prepare"] = 'إرسال';
$Definition['MarketPlace']["noOffers"] = 'لم يتم العثور على أي عروض';
$Definition['MarketPlace']["I'm offering"] = 'إحتفالات';
$Definition['MarketPlace']['not enough resources'] = 'الموارد غير كافية';
$Definition['MarketPlace']['Unable to create offer; maximum ratio allowed is 2:1'] = 'يتعذر إنشاء عرض؛ الحد الأقصى المسموح به هو 2: 1.';
$Definition['MarketPlace']['Search'] = 'بحث';
$Definition['MarketPlace']['Deliveries'] = 'التسليم';
$Definition['MarketPlace']['noRoute'] = 'لا يوجد مخطط تجاري';
$Definition['MarketPlace']['Create new trade route'] = 'إنشاء مخطط جديد';
$Definition['MarketPlace']['notEnoughMerchants'] = "التجار لا تكفي [MERCHANTS_NEEDED] تاجر  انت بحاجه لـ ,[MERCHANTS_AVAILABLE] تاجر موجود";
$Definition['MarketPlace']['tradeRouteDesc'] = 'نادي الذهب يسمح لك لاقامة مخططات تجارية، والتي ترسل تلقائيا الموارد بين قراكم.';
$Definition['MarketPlace']['Enabled'] = 'ممكن';
$Definition['MarketPlace']['needToBeActive'] = 'من أجل استخدام هذه الميزة، تحتاج إلى تفعيل نادي الذهب!';
$Definition['MarketPlace']['Click here to exchange resources'] = 'أنقر هنا لتبادل الموارد';
$Definition['MarketPlace']['Trade your village\'s resources immediately with NPC merchant 1:1'] = ' قم بإعادة توزيع مواردك في قريتك باستخدام تاجر المبادلة الآن فوراً وبنسبة 1:1';
$Definition['MarketPlace']['Send time'] = 'ارسال في';
$Definition['MarketPlace']['every %s minutes'] = 'كل %s دقيقة';
$Definition['MarketPlace']['every %s hours'] = 'كل %s ساعة';
$Definition['MarketPlace']['every %s days'] = 'كل %s يوم';
$Definition['MarketPlace']['You are under protection'] = 'You are under protection.';
//Medals
$Definition['Medals']['Category'] = 'الفئة';
$Definition['Medals']['Week'] = 'الإسبوع';
$Definition['Medals']['Rank'] = 'الرتبة';
$Definition['Medals']['Resources'] = 'الموارد';
$Definition['Medals']['Points'] = 'النقاط';
$Definition['Medals']['Received in week:'] = 'هذا الإسبوع :';
$Definition['Medals']['category15'] = 'هذا يعني أنك أحد افضل 10 سارقين %s عن الإسبوع';
$Definition['Medals']['category9'] = 'هذا يعني انك احد افضل 3 سارقين  %s 3 مرات على التوالي';
$Definition['Medals']['category14'] = 'هذا يعني أنك احد افضل 10 مطورين %s عن الإسبوع';
$Definition['Medals']['category8'] = 'هذا يعني أنك احد افضل 3 مطورين %s 3 مرات على التوالي';
$Definition['Medals']['category7'] = 'هذا يعني انك احد افضل 10 مدافعين %s عن الإسبوع';
$Definition['Medals']['category13'] = 'هذا يعني انك احد افضل 3 مدافعين %s 3 مرات على التوالي';
$Definition['Medals']['category12'] = 'هذا يعني انك احد افضل 10 مهاجمين %s عن الإسبوع';
$Definition['Medals']['category6'] = 'هذا يعني انك افضل 3 مهاجمين %s 3 مرات على التوالي';
$Definition['Medals']['category5'] = 'هذا يعني أنك احد افضل مهاجم ومدافع  %s في نفس الإسبوع';
$Definition['Medals']['names'][1] = 'مهاجمون الإسبوع';
$Definition['Medals']['names'][2] = 'مدافعون الإسبوع';
$Definition['Medals']['names'][3] = 'مطورون الإسبوع';
$Definition['Medals']['names'][4] = 'ناهبون الإسبوع';
$Definition['Medals']['names'][5] = 'أفضل 10 مدافعين ومهاجمون عن الإسبوع';
$Definition['Medals']['names'][6] = 'افضل 3 مهاجمون';
$Definition['Medals']['names'][12] = 'أفضل 10 مهاجمون';
$Definition['Medals']['names'][7] = 'افضل 3 مدافعون';
$Definition['Medals']['names'][13] = 'أفضل 10 مدافعون';
$Definition['Medals']['names'][8] = 'افضل 3 مطورون';
$Definition['Medals']['names'][14] = 'افضل 10 مطورون';
$Definition['Medals']['names'][9] = 'افضل 3 ناهبون';
$Definition['Medals']['names'][15] = 'افضل 10 ناهبون';
$Definition['Medals']['SpecialMedals'] = [
    // Ranke Wonder Of World
    1 => '<span class="gloriatitle">البطولة الدولية</span><div class="gloriacontent">الدولة : %s<br>السيرفر :  %s<br>الفئة: معجزة العالم<br>الإسم :  %s<br>القبيلة : %s<br>الرتبة : 1<br>مستوى المعجزة : %s</div>',
    2 => '<span class="gloriatitle">البطولة الدولية</span><div class="gloriacontent">الدولة : %s<br>السيرفر : %s<br>الفئة: معجزة العالم<br>الإسم : %s<br>القبيلة : %s<br>الرتبة : 2<br>مستوى المعجزة : %s</div>',
    3 => '<span class="gloriatitle">البطولة الدولية</span><div class="gloriacontent">الدولة : %s<br>السيرفر : %s<br>الفئة : معجزة العالم<br>الإسم : %s<br>القبيلة : %s<br>الرتبة : 3<br>مستوى المعجزة : %s</div>',

    // Ranke Offensive 1 ta 4 top 10
    4 => '<span class="gloriatitle">البطولة الدولية</span><div class="gloriacontent">الدولة : %s<br>السيرفر : %s<br>الفئة : الهجوم<br>الإسم : %s<br>القبيلة : %s<br>الرتبة : 1<br>النقاط : %s</div>',
    5 => '<span class="gloriatitle">البطولة الدولية</span><div class="gloriacontent">الدولة : %s<br>السيرفر : %s<br>الفئة : الهجوم<br>الإسم : %s<br>القبيلة : %s<br>الرتبة : 2<br>النقاط : %s</div>',
    6 => '<span class="gloriatitle">البطولة الدولية</span><div class="gloriacontent">الدولة : %s<br>السيرفر : %s<br>الفئة : الهجوم<br>الإسم : %s<br>القبيلة : %s<br>الرتبة : 3<br>النقاط : %s</div>',
    7 => '<span class="gloriatitle">البطولة الدولية</span><div class="gloriacontent">الدولة : %s<br>السيرفر : %s<br>الفئة : الهجوم<br>الإسم : %s<br>القبيلة : %s<br>الرتبة : 4<br>النقاط : %s</div>',
    // Ranke Defensive 1 ta 4 top 10
    8 => '<span class="gloriatitle">البطولة الدولية</span><div class="gloriacontent">الدولة : %s<br>السيرفر : %s<br>الفئة : الدفاع<br>الإسم : %s<br>القبيلة : %s<br>الرتبة : 1<br>النقاط : %s</div>',
    9 => '<span class="gloriatitle">البطولة الدولية :</span><div class="gloriacontent">الدولة : %s<br>السيرفر : %s<br>الفئة : الدفاع<br>الإسم : %s<br>القبيلة : %s<br>الرتبة : 2<br>النقاط : %s</div>',
    10 => '<span class="gloriatitle">البطولة الدولية</span><div class="gloriacontent">الدولة : %s<br>السيرفر : %s<br>الفئة : الدفاع<br>الإسم : %s<br>القبيلة : %s<br>الرتبة : 3<br>النقاط : %s</div>',
    11 => '<span class="gloriatitle">البطولة الدولية</span><div class="gloriacontent">الدولة : %s<br>السيرفر : %s<br>الفئة : الدفاع<br>الإسم : %s<br>القبيلة : %s<br>الرتبة : 4<br>النقاط : %s</div>',
    // Ranke Pop Nafarate Avale 1 ta 4
    12 => '<span class="gloriatitle">البطولة الدولية</span><div class="gloriacontent">الدولة : %s<br>السيرفر : %s<br>الفئة : السكان <br>الإسم : %s<br>القبيلة : %s<br>الرتبة : 1<br>النقاط : %s</div>',
    13 => '<span class="gloriatitle">البطولة الدولية</span><div class="gloriacontent">الدولة : %s<br>السيرفر : %s<br>الفئة : السكان <br>الإسم : %s<br>القبيلة : %s<br>الرتبة : 2<br>النقاط : %s</div>',
    14 => '<span class="gloriatitle">البطولة الدولية</span><div class="gloriacontent">الدولة : %s<br>السيرفر : %s<br>الفئة : السكان <br>الإسم : %s<br>القبيلة : %s<br>الرتبة : 3<br>النقاط : %s</div>',
    15 => '<span class="gloriatitle">البطولة الدولية</span><div class="gloriacontent">الدولة : %s<br>السيرفر : %s<br>الفئة : <br>الإسم : %s<br>القبيلة : %s<br>الرتبة : 4<br>النقاط : %s</div>',
];
//Messages
$Definition['Messages']['You cannot send a message to more than %s users'] = 'لا يمكنك إرسال رسالة إلى أكثر من %s المستخدمين';
$Definition['Messages']['spam_unread_protection'] = 'الحماية من البريد المزعج : لديك %s رسائل غير مقروءة تم إرسالها إلى هذا المستخدم، لا يمكنك إرسال أي رسائل لهذا اللاعب حتى يقرأ اللاعب الرسائل أو يجب عليك الانتظار ساعتين.';
$Definition['Messages']['Current message has already been reported as: x'] = 'تم الإبلاغ عن الرسالة الحالية على النحو التالي: %s.';
$Definition['Messages']['Error: Very long subject!'] = 'خطأ : موضوع طويل جداً ';
$Definition['Messages']['Spam protection: Please wait for 10 minutes and try again'] = '<b>الحماية من البريد المزعج</b>: يرجى الإنتظار 10 دقائق والمحاولة مجدداً';
$Definition['Messages']['You are currently not part of any alliance'] = 'انت حالياً لا تنتمي إلى اي تحالف';
$Definition['Messages']['Inadmissible message'] = 'رسالة غير مقبولة.';
$Definition['Messages']['Mark as read'] = 'وضع إشارة مقروء';
$Definition['Messages']['Mark as unread'] = 'وضع إشارة غير مقروء';
$Definition['Messages']['reportingSuccessful'] = 'تم الإرسال بنجاح !';
$Definition['Messages']['closeButtonText'] = 'إغلاق';
$Definition['Messages']['Messages'] = 'الرسائل';
$Definition['Messages']['Inbox'] = 'الوارد';
$Definition['Messages']['needClub'] = 'لإستخدام هذه الميزة يجب عليك تفعيل نادي الذهب';
$Definition['Messages']['Delete'] = 'حذف';
$Definition['Messages']['Subject'] = 'الموضوع';
$Definition['Messages']['Sender'] = 'المرسل';
$Definition['Messages']['Sent at'] = 'مرسلة في';
$Definition['Messages']['Read'] = 'مقروءة';
$Definition['Messages']['Unread'] = 'غير مقروءة';
$Definition['Messages']['Your note is too long!'] = 'ملاحظتك طويلة جداً !';
$Definition['Messages']['select all'] = 'تحديد الكل';
$Definition['Messages']['Recipient'] = 'المستلم';
$Definition['Messages']['Choose reason'] = 'إختيار السبب';
$Definition['Messages']['Advertisement'] = 'الإعلانات';
$Definition['Messages']['harassment'] = 'مضايقة';
$Definition['Messages']['gold'] = 'شراء الذهب';
$Definition['Messages']['Other'] = 'أخرى';
$Definition['Messages']['report'] = 'إبلاغ';
$Definition['Messages']['Attention: Misuse of the report function is punishable'] = 'تنبيه: إساءة استخدام وظيفة التقرير يعاقب عليها.';
$Definition['Messages']['sender'] = 'المرسل';
$Definition['Messages']['Report as spam'] = 'ابلاغ عن سبام';
$Definition['Messages']['back to send box'] = 'العودة للوارد';
$Definition['Messages']['There are no messages available in the sentbox'] = 'لا توجد رسائل متوفرة في صندوق الرسائل المرسلة';
$Definition['Messages']['There are no messages available in the inbox'] = 'لا توجد رسائل متوفرة في صندوق الوارد';
$Definition['Messages']['There are no messages available in the archive'] = 'لا تتوفر أي رسائل في الإرشيف';
$Definition['Messages']['waiting for confirmation'] = 'في إنتظار التأكيد';
$Definition['Messages']['Recover'] = 'إستعادة';
$Definition['Messages']['Addressbook'] = 'دليل العناوين';
$Definition['Messages']['send'] = 'إرسال';
$Definition['Messages']['Alliance'] = 'التحالف';
$Definition['Messages']['xxx wrote:'] = 'كتبت بواسطة : %s';
$Definition['Messages']['You dont have permission here'] = 'ليس لديك أذن هنا';
$Definition['Messages']['player x does not exists'] = 'هذا الاسم %s غير موجود';
$Definition['Messages']['you send your last message in x and you will be able to send message in y'] = 'يمكنك إرسال رسالتك الأخيرة في %s وسوف تكون قادر على إرسال رسالة جديدة في %s.';
$Definition['Messages']['no subject'] = 'بدون موضوع';
$Definition['Messages']['ConfirmDelete'] = 'هل تريد حقاً حذف هذه الرسالة ؟';
$Definition['Messages']['answer'] = 'رد';
$Definition['Messages']['Player'] = 'اللاعب';
$Definition['Messages']['Coordinates'] = 'الإحداثيات';
$Definition['Messages']['report'] = 'إبلغ عن';
$Definition['Messages']['Troops'] = 'القوات';
$Definition['Messages']['preview'] = 'معاينة';
$Definition['Messages']['back to the inbox'] = 'العودة لصندوق الوارد';
$Definition['Messages']['Write'] = 'أكتب';
$Definition['Messages']['Sent'] = 'الصادر';
$Definition['Messages']['- saved -'] = '- حفظت -';
$Definition['Messages']['Archive'] = 'الإرشيف';
$Definition['Messages']['Notes'] = 'الملاحظات';
$Definition['Messages']['Ignored players'] = 'اللاعبين المتجاهلين';
$Definition['Messages']['online now'] = 'على الشبكة الآن';
$Definition['Messages']['active players'] = 'بالكثير : 10 ساعات';
$Definition['Messages']['active 3days'] = 'بالكثير : 3 أيام';
$Definition['Messages']['active 7days'] = 'بالكثير : 7 أيام';
$Definition['Messages']['inactive'] = 'غير نشط';
$Definition['Messages']['Ambassador'] = 'سفير';
$Definition['Messages']['Alliance Invitation received'] = 'دعوة للتحالف';
$Definition['Messages']['Alliance Invitation revoked'] = 'تم إلغاء الدعوة';
$Definition['Messages']['Spam protection: You must have at least %s pop to be able to send messages'] = 'الحماية من الرسائل الغير مقبول بها : يجب توفر لديك %s ساكن حتى تستطيع إرسال الرسائل';
$Definition['Messages']['AllianceInvitationRevokeText'] = <<<HTML
مرحباً %s,
<br /><br />
دعوتك للإنضام للتحالف %s تم إلغائها بواسطة %s.
<br /><br />
نتمنى لك حظاً طيباً ومزيداً من المتعة !
HTML;
$Definition['Messages']['AllianceInvitationReceiveText'] = <<<HTML
مرحباً %s,
<br /><br />
أنت مدعو من قبل %s للإنضمام للتحالف %s.
<br /><br />
لقبول الدعوة اذهب إلى سفارتك والانضمام إلى التحالف. إذا لم يكن لديك سفارة بعد، يمكنك إنشاء السفارة أولا.
<br /><br />
نتمنى لك حظاً طيباً ومزيداً من المتعة !
HTML;
$Definition['Messages']['WrittenBySitter%s'] = '- Written by sitter %s -';
//NotFound
$Definition['notFound']['title'] = 'لا شيء هنا !';
$Definition['notFound']['desc'] = '404 لا يوجد شيء هنا عن ماذا تبحث يا عزيزي ؟';
//NPC
$Definition['npc'] = ["disabled_in_ww" => "لا يمكنك إستخدام هذه الميزة في قرى المعجزة",
    'npc_desc' => 'مع تاجر المبادلة يمكنك توزيع الموارد كيفما تشاء<br><br>يظهر السطر الأول المخزون الحالي. في السطر الثاني، يمكنك اختيار توزيع آخر. السطر الثالث يبين الفرق بين المخزون القديم والجديد.',
    'sum' => 'المجموع',
    'distribute_remaining_resources' => 'توزيع الموارد المتبقية',
    'exchangeResources' => 'توزيع الموارد',
    'redeem_now' => 'توزيع الآن',
    'redeem' => 'توزيع',
    'remain' => 'يتبقى',
    "build_marketPlace" => "بناء السوق",
];
//Options
$Definition['Options']['Change name'] = 'تغيير الإسم';
$Definition['Options']['Yes'] = 'نعم';
$Definition['Options']['No'] = 'لا';
$Definition['Options']['You need to wait 7 days before deletion'] = 'للأسف، لا يمكنك نقل الذهب الخاص بك الآن. إذا كان لديك أي أسئلة، وإرسال بريد إلكتروني إلى travianarab@yahoo.com' . (WebService::getJustDomain()) . '.';
$Definition['Options']['Newsletter'] = 'الأخبار';
$Definition['Options']['sitter'] = 'الوكلاء';
$Definition['Options']['Sitter(s) for this account'] =  'الوكلاء على الحساب';
$Definition['Options']['Sitting for other account(s)'] = 'انت وكيل على الحسابات التالية';
$Definition['Options']['Sitting for other account(s)Desc'] = 'أنت وكيل على الحسابات التالية ';
$Definition['Options']['MySittersDesc'] = 'يستطيع الوكيل تسجيل الدخول الى عضويتك بإستخدام اسم الإستعارة الخاص بك، وكلمة السر الخاص به. يسمح لك بتسجيل وكيلين على عضويتك كحد اقصى.
';
$Definition['Options']['no entry'] = 'لا يوجد وكلاء';
$Definition['Options']['Here you can subscribe or unsubscribe to our newsletter'] = 'هنا يمكنك الاشتراك أو إلغاء الاشتراك في النشرة الإخبارية لدينا.';
$Definition['Options']['Travian Games'] = 'العاب ترافيان';
$Definition['Options']['invalid old email'] = 'البريد الإلكتروني القديم غير صحيح .';
$Definition['Options']['invalid new email'] = 'البريد الإلكتروني الجديد غير صالح .';
$Definition['Options']['Receive notifications about invitations to an alliance'] = 'تلقّي إشعارات في حال دُعيت لتحالف ما.';
$Definition['Options']['new email exists'] = 'هناك بريد إلكتروني جديد';
$Definition['Options']['Name black listed'] = 'اسم الحساب الجديد إما موجود بالفعل أو غير مسموح به. الرجاء تجربة اسم آخر.';
$Definition['Options']['Name exists'] = 'اسم الحساب الجديد إما موجود بالفعل أو غير مسموح به. الرجاء تجربة اسم آخر.';
$Definition['Options']['Name too short'] = 'الإسم قصير جداً';
$Definition['Options']['Name too long'] = 'الإسم طويل جداً';
$Definition['Options']['Please enter a new account name and confirmation password'] = 'الرجاء إدخال اسم حساب جديد وكلمة سر.';
$Definition['Options']['Confirmation password does not match'] = 'كلمة سر التأكيد غير مطابقة .';
$Definition['Options']['Confirm with password'] = 'تـأكيد كلمة السر :';
$Definition['Options']['Change account name'] = 'تغيير إسم الحساب :';
$Definition['Options']['Number of changes'] = 'عدد التغييرات :';
$Definition['Options']['Enter new account name'] = 'إضافة إسم حساب جديد :';
$Definition['Options']['changeNameDesc'] = 'يمكنك تغيير اسم حسابك هنا. يرجى العلم بأن اسم حسابك قد لا ينتهك قواعد اللعبة أو البنود والشروط. يمكنك تغيير اسم حسابك مجانا لمدة %s من المرات أو حتى تصل إلى %s من السكان. بعد ذلك، سيتم تغيير اسم حسابك مقابل  %s ذهب . تغيير اسم الحساب بعد عدد سكان %s غير ممكن!';
$Definition['Options']['Change password'] = 'تغيير كلمة السر';
$Definition['Options']['Old Password'] = 'كلمة السر القديمة ';
$Definition['Options']['New Password'] = 'كلمة السر الجديدة ';
$Definition['Options']['confirm'] = 'تـأكيد';
$Definition['Options']['Change email'] = 'تغيير الإيميل ';
$Definition['Options']['Old email'] = 'الإيميل القديم';
$Definition['Options']['New email'] = 'الإيميل الجديد';
$Definition['Options']['Change email desc'] = 'الرجاء إدخال عنوان بريدك الإلكتروني القديم وعنوان بريدك الإلكتروني الجديد. ستحصل بعد ذلك على رمز التحقق على كل من عناوين البريد الإلكتروني التي يجب عليك إدخالها هنا.';
$Definition['Options']['Game'] = 'اللعبة';
$Definition['Options']['Account'] = 'الحساب';
$Definition['Options']['Delete account'] = 'حذف الحساب';
$Definition['Options']['Delete account?'] = 'هل أنت متأكد من حذف الحساب ؟ ';
$Definition['Options']['Sitter'] = 'الوكلاء';
$Definition['Options']['Preferences'] = 'التفضيلات';
$Definition['Options']['Report filter'] = 'فلتر التقارير';
$Definition['Options']['Auto-complete'] = 'الإكمال التلقائي';
$Definition['Options']['No reports about transfers between your own villages'] = 'لا تقارير في تبادل الموارد بين قراكم الخاصة';
$Definition['Options']['No reports about transfers to foreign villages'] = 'لا تقارير في إرسال الموارد الى القرى الأخرى';
$Definition['Options']['No reports about transfers from foreign villages'] = 'لا تقارير في إستقبال الموارد من القرى الأخرى';
$Definition['Options']['The LowRes version does not display images in reports'] = 'لا يتم عرض الصور في التقارير';
$Definition['Options']['Complete for rally point and marketplace'] = 'تستخدم لنقطة التجمع والسوق:';
$Definition['Options']['Own villages'] = 'القرى الخاصة ';
$Definition['Options']['Nearby villages'] = 'قرى الجوار';
$Definition['Options']["Alliance members' villages"] = 'قرى الأعضاء في التحالف';
$Definition['Options']["Display"] = 'اعرض';
$Definition['Options']["Don't display images in reports"] = 'لا تقم بعرض الصور في التقرير';
$Definition['Options']["Messages and reports per page"] = 'رسائل وتقارير لكل صفحة:';
$Definition['Options']["Troop movements per page in rally point"] = 'عدد تحركّات القوّات لكل صفحة في نقطة التجمّع';
$Definition['Options']["Time zone preferences"] = 'المنطقة الزمنية المفضلة';
$Definition['Options']["You can change your time zone here"] = 'يمكنك تغيير منطقتك الزمنية هنا';
$Definition['Options']["Time zone"] = 'منطقة التوقيت ';
$Definition['Options']["Date format"] = 'صيغة التاريخ';
$Definition['Options']["local time zones"] = 'المنطقة الحالية';
$Definition['Options']["general time zones"] = 'المناطق العامة';
$Definition['Options']["change_mail_desc"] = 'تم إرسال رمز التحقق إلى كل من عناوين البريد الإلكتروني القديمة والجديدة. أدخل كلاهما في الحقول الصحيحة هنا.';
$Definition['Options']["Old email code"] = 'رمز الإيميل القديم :';
$Definition['Options']["New email code"] = 'رمز الإيميل الجديد :';
$Definition['Options']["x of y changes"] = '%s من %s تغييرات ';
$Definition['Options']["password wrong"] = 'كلمة السر غير صحيحة';
$Definition['Options']["deleteDesc"] = 'هنا يمكنك حذف عضويتك. حالما يبدأ الحذف، سيستغرق الأمر ثلاثة أيام لحذف العضوية النهائي. يمكنك إلغاء الحذف خلال الفترة متى ما شئت بالضغط على إشارة × الحمراء. لا يمكنك الدخول في مزادات أو استخدام الصرّاف طالما أن عضويتك قيد الحذف.';
$Definition['Options']["codes are not correct"] = 'الرمز غير صحيح !';
$Definition['Options']["email_changed"] = 'Email changed';
$Definition['Options']["Email change is in progress"] = 'جاري تغيير البريد الإلكتروني';
$Definition['Options']["EmailChange_new_subject"] = 'تغيير الإيميل الخطوة الثانية';
$Definition['Options']["EmailChange_new"] = '
<div style="text-align: left; direction: LTR">
مرحباً %s,

لقد طلبت تغيير الإيميل يرجى إضافة هذا الرمز في مربع الرمز الجديد

الرمز %s

ستتلقى بريدا إلكترونيا آخر إلى عنوانك القديم برمز ثان لك
يجب أن تدخل في المربع "رمز العنوان القديم".
</div>
';
$Definition['Options']["EmailChange_old_subject"] = 'تغيير الإيميل الخطوة الأولى';
$Definition['Options']["EmailChange_old"] = '
<div style="text-align: left; direction: LTR">
مرحباً %s,

لقد طلبت تغيير الإيميل يرجى إضافة هذا الرمز في مربع الرمز القديم

الرمز : %s

ستتلقى بريدا إلكترونيا آخر إلى عنوانك الجديد برمز ثان لك
يجب أن تدخل في مربع "رمز عنوان جديد".
</div>';
$Definition['Options']['Vacation'] = 'إجازة';
$Definition['Options']['Use the vacation to protect your villages while being abroad'] = 'استخدم ميزة الإجازة لتحمي قراك في حالة غيابك.';
$Definition['Options']['While in vacation mode the following actions will be deactivated'] = 'سيتم تعطيل الأمور التالية في حالة وضع العضوية في حالة إجازة';
$Definition['Options']['send or receive troops'] = 'إرسال أو استقبال القوات';
$Definition['Options']['start new building orders'] = 'البدء بتشييد المباني';
$Definition['Options']['using the marketplace'] = 'استخدام السوق';
$Definition['Options']['start training troops'] = 'تدريب القوات';
$Definition['Options']['join alliances'] = 'الانضمام لتحالف';
$Definition['Options']['delete your account'] = 'حذف العضوية';
$Definition['Options']['Alliance settings'] = 'إعدادات التحالف';
$Definition['Options']['Show alliance news'] = 'عرض أخبار التحالف';
$Definition['Options']['Alliance members founded new village'] = 'أسس أعضاء التحالف قرية جديدة';
$Definition['Options']['New alliance member joined'] = 'انضم عضو تحالف جديد';
$Definition['Options']['Player has been invited'] = 'تمت دعوة لاعب إلى التحالف';
$Definition['Options']['Player has left alliance'] = 'اللاعب ترك التحالف';
$Definition['Options']['Player was kicked from alliance'] = 'اللاعب طُرد من التحالف';
$Definition['Options']['There are no outgoing troops'] = 'لا توجد قوات مغادرة';
$Definition['Options']['There are no incoming troops'] = 'لا توجد قوات قادمة';
$Definition['Options']['There are no troops reinforing other players'] = 'لا توجد قوات معززة بالخارج';
$Definition['Options']['No other player reinforces you'] = 'لا توجد تعزيزات من الخارج';
$Definition['Options']['You dont own a Wonder of the World Village'] = 'لا تملك معجزة من معجزات العالم';
$Definition['Options']['You dont own an artifact'] = 'لا تملك تحفة';
$Definition['Options']['You dont have beginners protection left'] = 'لا توجد حماية مبتدئين';
$Definition['Options']['There are no troops in your traps'] = 'لا توجد قوات مأسورة لديك';
$Definition['Options']['x/9 conditions met'] = '%s/9 الشروط';
$Definition['Options']['Available Days x/y'] = 'الأيام المتاحة %s/%s';
$Definition['Options']['How many days should the vacation mode last'] = 'عدد أيام الإجازة';
$Definition['Options']['Vacation til'] = 'إجازة لغاية';
$Definition['Options']['Your account is not in deletion'] = 'عضويتك ليست قيد الحذف';
$Definition['Options']['enter vacation mode now'] = 'أدخل في وضع إجازة الآن';
$Definition['Options']['Vacation mode is active'] = 'وضع الإجازة نشط';
$Definition['Options']['Are you sure you want to enter vacation mode?'] = 'هل أنت متأكد من الدخول بوضع إجازة الآن ؟';
$Definition['Options']['Your account will be protected, and the resource production will continue'] = 'سيتم حماية حسابك، وسيستمر إنتاج الموارد.';
$Definition['Options']['So will the crop consumption by troops too, which may lead to troop starvation'] = 'وكذا سيستمر استهلاك القوّات من القمح، ما يعني أنه قد تحصل حالات موت من الجوع فيها في حال لم يكن القمح كافياً';
$Definition['Options']['Your are not able to'] = 'أنت لست قادر على';
$Definition['Options']['upgrade buildings'] = 'ترقية المباني';
$Definition['Options']['train troops'] = 'تدريب القوات';
$Definition['Options']['send troops'] = 'إرسال القوات';
$Definition['Options']['send merchants'] = 'إرسال التجار';
$Definition['Options']['delete your account'] = 'حذف الحساب';
$Definition['Options']['Remaining days in vacation mode'] = 'الأيام المتبقية في وضع الإجازة';
$Definition['Options']['day(s)'] = ' يوم ';
$Definition['Options']['You can abort vacation mode now'] = 'يمكنك إلغاء وضع الإجازة الآن إذا اردت ذلك';
$Definition['Options']['abort vacation mode'] = 'إلغاء وضع الإجازة';
$Definition['Options']['Vacation mode runs til'] = 'وضع الإجازة';
$Definition['Options']['player name'] = 'إسم اللاعب :';
$Definition['Options']['Send raids'] = 'إرسال نهب';
$Definition['Options']['Send reinforcements to other players'] = 'إرسال تعزيزات للاعبين آخرين';
$Definition['Options']['Send resources to other players'] = 'إرسال الموارد';
$Definition['Options']['Buy and spend Gold'] = 'شراء وإستخدام الذهب';
$Definition['Options']['Delete and archive messages and reports'] = 'قراءة وإرسال الرسائل';
$Definition['Options']['Contribute resources to alliance bonuses'] = 'Contribute resources to alliance bonuses';
$Definition['Options']['Read and send messages'] = 'حذف الرسائل والتقارير';
$Definition['Options']['language settings'] = 'إعدادات اللغة';
$Definition['Options']['Language'] = 'الدولة';
$Definition['Options']['Support colorBlind title'] = 'دعم الألوان';
$Definition['Options']['Use colorBlind?'] = 'إستخدام دعم الألوان ؟';
$Definition['Options']['Support colorBlind desc'] = 'يمكنك تفعيل دعم تمييز الألوان لتعديل الأيقونات وتحسين الألوان. لا تؤثر هذه الخاصية على آلية وسيرورة اللعبة أبدًا.';
$Definition['Options']['Transfer gold'] = 'نقل الذهب';
$Definition['Options']['You have Gold %s pieces of gold, %s pieces can be transferred after deleting your account!'] = 'لديك (%s) من الذهب -  (%s) قطعة يمكنك نقلها بعد حذف الحساب لإي حساب آخر';
$Definition['Options']['Auto reload status'] = 'إعدادات إعادة التحميل التلقائي';
$Definition['Options']['Enable auto reload?'] = 'هل تريد تمكين التحميل التلقائي؟';
$Definition['Options']['Use fast upgrade on buildings'] = 'إستخدام الترقية السريعة للمباني';
$Definition['Options']['This player is sitter for 2 players'] = 'هذا اللاعب لديه بالفل وكيلين';
$Definition['Options']['You can set the page to auto reload, the page will be automatically refreshed when timer reaches 0'] = 'يمكنك تعيين الصفحة لإعادة التحميل التلقائي، سيتم تحديث الصفحة تلقائيا عندما يصل الموقت 0.';
$Definition['Options']['Graphic pack'] = 'Graphic pack';
$Definition['Options']['You can change the way the game looks for you'] = 'You can change the way the game looks for you.';
$Definition['Options']['new'] = 'New';


//PaymentWizard
$Definition['PaymentWizard']['You have a WW village or Artifact So you cannot use this feature'] = 'لديك قرية معجزة العالم أو قطعة أثرية لذلك لا يمكنك استخدام هذه الميزة.';
$Definition['PaymentWizard']['Gold'] = 'الذهب';
$Definition['PaymentWizard']['goldClub'] = 'نادي الذهب';
$Definition['PaymentWizard']['x gold moneyUnit'] = '%s الذهب %s %s';
$Definition['PaymentWizard']['paymentUnAvailable'] = 'الشراء حالياً غير متآح';
$Definition['PaymentWizard']['location'] = 'موقعك';
$Definition['PaymentWizard']['ChangeLocation'] = 'تغيير موقعك';
$Definition['PaymentWizard']['Package'] = 'الحزمة';
$Definition['PaymentWizard']['ChoosePackage'] = 'تغيير الحزمة';
$Definition['PaymentWizard']['changePackage'] = 'تغيير الحزمة';
$Definition['PaymentWizard']['BuySettings'] = 'إعدادات الشراء';
$Definition['PaymentWizard']['hour'] = 'ساعه';
$Definition['PaymentWizard']['Not Available yet'] = 'غير متوفر حتى الآن';
$Definition['PaymentWizard']['All displayed prices are final prices'] = 'جميع الأسعار المعروضة هي الأسعار النهائية';
$Definition['PaymentWizard']['You can check the status of your order at any time'] = 'يمكنك التحقق من حالة طلبك في أي وقت';
$Definition['PaymentWizard']['Show open orders'] = 'عرض الأوامر المفتوحة';
$Definition['PaymentWizard']['Hide open orders'] = 'إخفاء الأوامر المفتوحة';
$Definition['PaymentWizard']['Payment options:'] = 'خيارات الدفع :';
$Definition['PaymentWizard']['Show payment methods'] = 'عرض طرق الدفع';
$Definition['PaymentWizard']['Buy gold'] = 'شراء الذهب';
$Definition['PaymentWizard']['Advantages'] = 'المميزات';
$Definition['PaymentWizard']['Plus Support'] = 'دعم بلاس';
$Definition['PaymentWizard']['Earn Gold'] = 'كسب الذهب';
$Definition['PaymentWizard']['Delivery:'] = 'توصيل';
$Definition['PaymentWizard']['Select payment method'] = 'إختيار طريقة دفع';
$Definition['PaymentWizard']['Step3-ChoosePayment'] = 'الخطوة الثالثة - إختيار طريقة الدفع';
$Definition['PaymentWizard']['step'] = 'خطوة';
$Definition['PaymentWizard']['notEnoughGoldForThisOption'] = 'ليس لديك ما يكفي من الذهب لاستخدام هذه الميزة!';
$Definition['PaymentWizard']['ChooseAnotherPackage'] = 'إختر حزمة أخرى';
$Definition['PaymentWizard']['BuyNow'] = 'شراء الآن ؟';
$Definition['PaymentWizard']['Gold'] = 'الذهب';
$Definition['PaymentWizard']['Please activate advantage that you can choose'] = 'الرجاء إختيار الميزة التي ترغب في تفعيلها';
$Definition['PaymentWizard']['ToTheEndOfTheGame'] = 'الجولة كاملة';
$Definition['PaymentWizard']['Days remaining'] = 'الأيام المتبقية :';
$Definition['PaymentWizard']['until'] = 'حتى';
$Definition['PaymentWizard']['EndsAtX'] = 'تنتهي في %s.';
$Definition['PaymentWizard']['Bonus duration'] = 'مدة المكافأة';
$Definition['PaymentWizard']['Days'] = 'ايام';
$Definition['PaymentWizard']['Payment rules'] = 'قواعد الدفع';
$Definition['PaymentWizard']['PaymentRulesHTML'] = '<div style="width: 400px; font-size: 13px;"><h1 style="color: red; text-align: center;">قواعد شراء الذهب</h1><h2>Rules to buy Gold</h2><h3>1. النظام الآلي</h3>لدينا نظام الدفع التلقائي وبعد نجاح شراء الذهب سوف تضاف إلى حسابك تلقائيا<h3>2. لم يصلك الذهب ؟</h3>قم بمراسلة الصياد وسيتم إضافة الذهب في حال وجود إثبات الدفع<h3 style="color: red;">Important:</h3><p>سيتم حذف حسابك في حال عمل إسترداد لإموالك في حساب باي بال</p><h3 style="color: red;">مهم :</h3>اذا تم تعويض ذلك يمكننا إعادة عضويتك مع فرض بعض العقوبات<h3 style="color: red;">مهم :</h3>يمكنك الحصول على اموالك فوراً إذا كنت في الولايات المتحدة <b>PayPal</b> لإي سبب<h3 style="color: red;">مهم :</h3>إذا واجهت مشاكل أخرى يرجى مراسلتنا</p><p> <b>Should</b></div>';
$Definition['PaymentWizard']['Extend automatically'] = 'تمديد تلقائي';
$Definition['PaymentWizard']['Activated To End Of the game'] = 'تنشيط لـ <b>نهاية اللعبة</b>';
$Definition['PaymentWizard']['GoldClub'] = 'نادي الذهب';
$Definition['PaymentWizard']['goldClubDesc'] = '<p>كامل الجولة</p>
<p>ميزات رائعة لكل فترة اللعب!

دع التجّار في قريتك ينقلون الموارد أكثر من مرة تلقائياً، جِد القمحيات على الخارطة وقم بحفظ رسائلك وتقارير المعارك التي تخوضها. استخدم قائمة المزارع لتجدول هجماتك ... اِحمِ جيشك الهجومي بتفعيل خيار الهروب في العاصمة حين تتعرض لهجوم الخصم!</p>';
$Definition['PaymentWizard']['Plus'] = 'بلس';
$Definition['PaymentWizard']['PlusDesc'] = ' <p>تمنح إمكانيات استعراض وميزات أفضل!</p>
                <p>
اضبط إعدادت اللعبة وفق رؤيتك في اللعب عن طريق وضع روابط مباشرة للقرى على الخريطة التي يمكنك تكبيرها أكثر. بهذا الخيار يمكنك استعراض كافة معلومات القرية من الوهلة الأولى: كل الهجمات الصادرة والواردة والقوات المغادرة والقادمة كتعزيزات ومساندة. أرسل تجّارك لمرتين تلقائياً وأوكل أمر البناء حين توفّر الموارد للبنّاء!</p>';
$Definition['PaymentWizard']['+25Wood'] = '+25% إنتاج الخشب';
$Definition['PaymentWizard']['+25WoodDesc'] = ' <p>تمنحك زيادة بمقدار 25% على إنتاجية قراك من الموارد المختارة للمدة التي تراها أمامك.

</p>
                <p>تضاف الـ 25% زيادة ليس فقط على الإنتاج الأساسي لقريتك، بل على الإنتاج مع الزيادات التي تحصل عليها بعد بناء المباني المختلفة!</p>';
$Definition['PaymentWizard']['+25Clay'] = '+25% إنتاج الطين';
$Definition['PaymentWizard']['+25ClayDesc'] = '<p>تمنحك زيادة بمقدار 25% على إنتاجية قراك من الموارد المختارة للمدة التي تراها أمامك.

</p>
                <p>تضاف الـ 25% زيادة ليس فقط على الإنتاج الأساسي لقريتك، بل على الإنتاج مع الزيادات التي تحصل عليها بعد بناء المباني المختلفة!</p>';
$Definition['PaymentWizard']['+25Iron'] = '+25% إنتاج الحديد';
$Definition['PaymentWizard']['+25IronDesc'] = ' <p>تمنحك زيادة بمقدار 25% على إنتاجية قراك من الموارد المختارة للمدة التي تراها أمامك.
</p>
                <p>تضاف الـ 25% زيادة ليس فقط على الإنتاج الأساسي لقريتك، بل على الإنتاج مع الزيادات التي تحصل عليها بعد بناء المباني المختلفة!<</p>';
$Definition['PaymentWizard']['+25Crop'] = '+25% إنتاج القمح';
$Definition['PaymentWizard']['+25CropDesc'] = '<p>تمنحك زيادة بمقدار 25% على إنتاجية قراك من الموارد المختارة للمدة التي تراها أمامك.</p>
                <p>تضاف الـ 25% زيادة ليس فقط على الإنتاج الأساسي لقريتك، بل على الإنتاج مع الزيادات التي تحصل عليها بعد بناء المباني المختلفة!</p>';
$Definition['PaymentWizard']['Travian Answers'] = 'أجوبة ترافيان';
$Definition['PaymentWizard']['Recipient [RECEIVER_COUNT]:'] = 'مستلم [RECEIVER_COUNT]:';
$Definition['PaymentWizard']['mentor'] = 'المستشار';
$Definition['PaymentWizard']['How can we help?'] = 'كيف يمكننا مساعدتك ؟';
$Definition['PaymentWizard']['Plus FAQ'] = 'دعم بلاس';
$Definition['PaymentWizard']['Plus FAQ Desc'] = 'في حال كان لديك أسئلة بشأن نقل الذهب، وميزات بلس يرجى مراسلة الدعم';
$Definition['PaymentWizard']['Contact Plus Support'] = 'الإتصال بدعم بلس';
$Definition['PaymentWizard']['Plus Support'] = 'دعم بلاس';
$Definition['PaymentWizard']['Plus Support Desc'] = 'كنت تواجه مشكلة ولا يمكن العثور على إجابة لسؤالك؟ يمكنك الاتصال بدعم بلس هنا.';
$Definition['PaymentWizard']['Miscellaneous information'] = 'معلومات عامة ومتنوعة';
$Definition['PaymentWizard']['Miscellaneous information warning'] = 'إذا كنت ترغب في حذف حسابك، يرجى ملاحظة أن هذا ممكن فقط بعد 7 أيام بعد آخر شراء للذهب أو نقل الذهب.';
$Definition['PaymentWizard']['How can I invite players?'] = 'كيف يمكنني دعوة لاعب ؟';
$Definition['PaymentWizard']['Players invited so far'] = 'اللاعبين المدعوون حتى الآن';
$Definition['PaymentWizard']['If you invite players to open an account in Travian on this server, you can receive Gold as a reward, You can use this Gold to purchase a Plus Account or other Gold advantages'] = 'إذا قمت بدعوة اللاعبين لفتح حساب في ترافيان على هذا الخادم، يمكنك الحصول على الذهب كمكافأة. يمكنك استخدام هذا الذهب للإشتراك في بلس أو مزايا الذهب الأخرى.';
$Definition['PaymentWizard']['To bring in new players, you can invite them by email or have them click on your REF link'] = 'لجلب لاعبين جدد، يمكنك دعوتهم عن طريق البريد الإلكتروني أو النقر على رابط الإحالة الخاص بك.';
$Definition['PaymentWizard']['As soon as an invited player has reached x villages'] = 'حالما يصل اللاعب لـ<span class="amount">2</span> قرى , ستتلقى <span class="goldReward"><img src="img/x.gif" class="gold" alt="Gold"> <span class="amount">' . Config::getProperty("gold", "invitePlayerGold") . '.</span></span>';
$Definition['PaymentWizard']['back to overview'] = 'عودة لنظرة عامة';
$Definition['PaymentWizard']['Choose an option to earn gold'] = 'إختيار خيار لكسب الذهب';
$Definition['PaymentWizard']['Send link to friends'] = 'إرسال الرابط لصديق';
$Definition['PaymentWizard']['You can send a link to your friends via email, inviting them to Travian'] = 'يمكنك إرسال رابط إلى أصدقائك عبر البريد الإلكتروني، ودعوتهم إلى ترافيان.';
$Definition['PaymentWizard']['Send email to friends'] = 'إرسال البريد الإلكتروني إلى الأصدقاء';
$Definition['PaymentWizard']['Your personal referral link'] = 'رابط الإحالة الخاص بك';
$Definition['PaymentWizard']['Display a list of all the players you have invited so far'] = 'عرض قائمة  جميع اللاعبين التي دعوتهم حتى الآن';
$Definition['PaymentWizard']['Display list of all invited players'] = 'عرض قائمة بجميع اللاعبين المدعوين';
$Definition['PaymentWizard']['Please enter recipients email addresses'] = 'يرجى إدخال عناوين البريد الإلكتروني للمستلمين';
$Definition['PaymentWizard']['Recipient 1'] = 'المستلم الأول';
$Definition['PaymentWizard']['Recipient 2'] = 'المستلم الثاني';
$Definition['PaymentWizard']['Add more people'] = 'إضافة أشخاص أخرين';
$Definition['PaymentWizard']['Add a personal message (optional)'] = 'إضافة رسالة مخصصة (إختياري)';
$Definition['PaymentWizard']['Cancel'] = 'الغاء';
$Definition['PaymentWizard']['Send invitation'] = 'إرسال الدعوات';
$Definition['PaymentWizard']['INVITE_EMAIL_MESSAGE'] = 'مرحباً,

اللاعب [PLAYERNAME] ([PLAYEREMAIL]) قام بدعوتك للتسجيل في ترافيان العربية
[PLAYERNAME] في العالم [GAMEWORLD] مع قبيلة [TRIBE].

للاشتراك، يرجى استخدام هذا الرابط:
<a href="[INVITE_LINK]">[INVITE_LINK]</a>

----------

[CUSTOM_MESSAGE]';
$Definition['PaymentWizard']['You have not brought in any new players yet'] = 'لم تجلب أي لاعبين جدد حتى الان.';
$Definition['PaymentWizard']['INVITE_EMAIL_SUBJECT'] = 'ترافيان: دعوة من لاعب [PLAYERNAME]';
$Definition['PaymentWizard']['Number of successfully sent invitations: x'] = 'عدد الدعوات التي تم إرسالها بنجاح: %s';
$Definition['PaymentWizard']['OpenOffers'] = 'العروض';
$Definition['PaymentWizard']['Order Date'] = 'تاريخ الطلب';
$Definition['PaymentWizard']['Payment'] = 'دفع';
$Definition['PaymentWizard']['Booking'] = 'الحجز';
$Definition['PaymentWizard']['Presenter'] = 'مقدم';
$Definition['PaymentWizard']['Units'] = 'وحدات';
$Definition['PaymentWizard']['Price'] = 'السعر';
$Definition['PaymentWizard']['Pending'] = 'قيد الإنتظار';
$Definition['PaymentWizard']['Success'] = 'تم الدفع !';
$Definition['PaymentWizard']['Success2'] = 'فشل الدفع';
$Definition['PaymentWizard']['Cancelled'] = 'ملغية';
$Definition['PaymentWizard']['booked'] = 'حجز';
$Definition['PaymentWizard']['not booked'] = 'لم يتم الحجز';
$Definition['PaymentWizard']['no Open Orders'] = 'لا أوامر مفتوحة';
$Definition['PaymentWizard']['AccountDeletionErr'] = ' حسابك قيد الحذف <br>لا يمكنك شراء الذهب<br><br>منعاً لعمليات الإحتيال';
$Definition['PaymentWizard']['The payment system is not available'] = 'نظام الدفع غير متوفر.';
$Definition['PaymentWizard']['An error occurred The payment system is not available at the moment Please try again later'] = 'حدث خطأ لا يتوفر نظام الدفع في الوقت الحالي يرجى إعادة المحاولة لاحقا.';
$Definition['PaymentWizard']['World'] = 'العالم';
$Definition['PaymentWizard']['UID'] = 'الرمز';
$Definition['PaymentWizard']['Member since'] = 'عضو منذ';
$Definition['PaymentWizard']['Inhabitants'] = 'السكان';
$Definition['PaymentWizard']['Villages'] = 'القرى';
$Definition['PaymentWizard']['paymentFeatures'] = 'ميزات ترافيان بلاس';
$Definition['PaymentWizard']['Troops'] = 'القوات';
$Definition['PaymentWizard']['buyAnimal'] = 'شراء الوحوش';
$Definition['PaymentWizard']['General'] = 'عام';
$Definition['PaymentWizard']['GeneralOptions'] = 'خيارات عامة';
$Definition['PaymentWizard']['buyTroops'] = 'شراء جيوش';
$Definition['PaymentWizard']['buyResources'] = 'شراء موارد';
$Definition['PaymentWizard']['WWDisabled'] = 'لا يمكنك إستخدام هذه الميزة في المعجزة';
$Definition['PaymentWizard']['Buy'] = 'شراء';
$Definition['PaymentWizard']['delivery'] = 'توصيل';
$Definition['PaymentWizard']['Immediately'] = 'فوراً';
$Definition['PaymentWizard']['Minutes'] = ' دقيقة';
$Definition['PaymentWizard']['upgradeAllResourcesTo20'] = 'ترقية الموارد الحقول إلى المستوى 20';
$Definition['PaymentWizard']['upgradeAllResourcesTo20Desc'] = 'ترقية الموارد الحقول إلى المستوى 20';
$Definition['PaymentWizard']['upgradeAllResourcesTo30'] = 'ترقية الموارد الحقول إلى المستوى 30';
$Definition['PaymentWizard']['upgradeAllResourcesTo30Desc'] = 'ترقية الموارد الحقول إلى المستوى 30';
$Definition['PaymentWizard']['rallyPointTo20'] = 'بناء نقطة التجمع للمستوى 20';
$Definition['PaymentWizard']['rallyPointTo20Desc'] = 'بناء للمستوى 20 نقطة التجمع في القرية الحالية.';
$Definition['PaymentWizard']['oneHourOfProduction'] = 'شراء 1 ساعة إنتاج الموارد للقرية';
$Definition['PaymentWizard']['oneHourOfProductionDesc'] = '1 ساعة من إنتاج الموارد الخاصة بك، ستضاف إلى قريتك الحالية.';
$Definition['PaymentWizard']['finishTraining'] = 'الانتهاء من جميع قوات التدريب فوراً';
$Definition['PaymentWizard']['finishTrainingDesc'] = 'كل ما تبذلونه من القوات على قائمة الانتظار في القرية الحالية سوف تدرب على الفور.';
$Definition['PaymentWizard']['moreProtection'] = 'الحماية';
$Definition['PaymentWizard']['moreProtectionDesc'] = 'مع الحماية لا يمكن لأحد أن يهاجمك وأنت بالخارج.';
$Definition['PaymentWizard']['fasterTraining'] = '+%s%% تدريب أسرع';
$Definition['PaymentWizard']['fasterTrainingDesc'] = 'يمكنك تدريب أسرع في كل من قريتك في هذه الفترة.';
$Definition['PaymentWizard']['academyResearchAll'] = 'البحث عن جميع الوحدات';
$Definition['PaymentWizard']['academyResearchAllesc'] = 'بحث جميع الوحدات في القرية. لا حاجة للبحث في الأكاديمية بعد الآن.';
$Definition['PaymentWizard']['smithyUpgradeAllToMax'] = 'ترقية جميع القوات إلى مستوى الحد الأقصى في افران صهر الحديد';
$Definition['PaymentWizard']['smithyUpgradeAllToMaxDesc'] = 'وسيتم ترقية جميع القوات إلى مستوى الحد الأقصى في أفران صهر الحديد.';
$Definition['PaymentWizard']['cancelTrainingQueue'] = 'طابور التدريب';
$Definition['PaymentWizard']['cancelTrainingQueueDesc'] = 'سيتم حذف كل قائمة انتظار التدريب. لم يتم تضمين أي رد للموارد.';
$Definition['PaymentWizard']['increaseStorage'] = 'زيادة تخزين';
$Definition['PaymentWizard']['increaseStorageDesc'] = 'زيادة سعة التخزين الحالية بمستوى تخزين 20.';
$Definition['PaymentWizard']['Gold bank'] = 'بنك الذهب';
$Definition['PaymentWizard']['Show all the golds you have saved'] = 'عرض جميع الذهب المحفوظ';
$Definition['PaymentWizard']['Display saved golds and how to use them'] = 'عرض الذهب المحفوظة وكيفية استخدامها';
$Definition['PaymentWizard']['Voucher code'] = 'كود القسيمة';
$Definition['PaymentWizard']['Voucher ID'] = 'معرف القسيمة';
$Definition['PaymentWizard']['Gold'] = 'الذهب';
$Definition['PaymentWizard']['Action'] = 'فعل';
$Definition['PaymentWizard']['Use'] = 'استخدام';
$Definition['PaymentWizard']['Date'] = 'التاريخ';
$Definition['PaymentWizard']['Used: %s of %s'] = 'التاريخ : %s من %s';
$Definition['PaymentWizard']['No saved golds'] = 'ليس لديك ذهب محفوظ';
$Definition['PaymentWizard']['Are you sure?'] = 'هل أنت متأكد';
$Definition['PaymentWizard']['This feature is disabled'] = 'تم تعطيل هذه الميزة.';
$Definition['PaymentWizard']['Gold bank is disabled'] = 'تم تعطيل بنك الذهب';
$Definition['PaymentWizard']['Invitation is closed'] = 'تم إغلاق الدعوة';
$Definition['PaymentWizard']['Server is closed for invitations'] = 'تم إغلاق الخادم للدعوات.';
$Definition['PaymentWizard']['Gold bank is disabled'] = 'تم تعطيل بنك الذهب.';
$Definition['PaymentWizard']['Power'] = 'القوة!';
$Definition['PaymentWizard']['Attack/Defense Bonus'] = 'مكافأة الهجوم/الدفاع';

$Definition['PaymentWizard']['atkBonus'] = '+%s%% مكافأة الهجوم';
$Definition['PaymentWizard']['atkBonusDesc'] = 'زيادة القدرة الهجومية للقوات اثناء مرافقة البطل';
$Definition['PaymentWizard']['defBonus'] = '+%s%% مكافأة الدفاع';
$Definition['PaymentWizard']['defBonusDesc'] = 'زيادة القدرة الدفاعية للقوات اثناء مرافقة البطل';
$Definition['PaymentWizard']['Protection'] = 'الحماية';
$Definition['PaymentWizard']['Protection Packages'] = 'حزم الحماية';
$Definition['PaymentWizard']['Protection daily limit reached'] = 'تم الوصول إلى الحد اليومي للحماية.';
$Definition['PaymentWizard']['You have %s hour(s) of protection left'] = 'لديك %s ساعة(s) اخرى من الحماية';
$Definition['PaymentWizard']['You have no protection left'] = 'لا توجد لديك حماية';
$Definition['PaymentWizard']['You can buy %s hour(s) of protection per day'] = 'لقد قمت بشراء %s ساعة(s) من الحماية في اليوم';
$Definition['PaymentWizard']['You have %s golds in your vouchers'] = 'لديك %s من الذهب في القسيمة';



$Definition['PaymentWizard']['Location'] = 'موقعك';
$Definition['PaymentWizard']['Packages'] = 'حزم';
$Definition['PaymentWizard']['Payment methods'] = 'طرق الدفع';
$Definition['PaymentWizard']['Overview'] = 'نظرة عامه';
$Definition['PaymentWizard']['Selected package'] = 'حزمة مختارة';
$Definition['PaymentWizard']['Your new gold balance'] = 'رصيد الذهب الجديد';
$Definition['PaymentWizard']['Gold'] = 'الذهب';
$Definition['PaymentWizard']['Price'] = 'السعر';
$Definition['PaymentWizard']['Buy now'] = 'شراء الآن';
$Definition['PaymentWizard']['Voucher'] = 'إيصال';
$Definition['PaymentWizard']['Redeem'] = 'إنتهى';
$Definition['PaymentWizard']['Redeem voucher'] = 'إسترداد قيمة الذهب';
$Definition['PaymentWizard']['Open orders'] = 'أوامر مفتوحة';
$Definition['PaymentWizard']['Voucher rules'] = 'قواعد القسائم';
$Definition['PaymentWizard']['voucherRules'] = [
    'سيتم نقل '.(100-Config::getProperty("gold", "voucherTaxPercent")).'٪ فقط من الذهب المتبقي.',
    'يمكن استخدام شفرة القسيمة لاسترداد الشفرة على أي حساب مستخدم (بدون بريد إلكتروني).',
    'فقط يتم شراؤها الذهب والمكافآت سيتم حفظها كقسائم.',
    'لا يمكنك بيع قسائم.',
    'ستستمر رموز القسائم لمدة '.Config::getProperty("gold", "voucherExpireDays").' يوما فقط.',
];
$Definition['PaymentWizard']['Reason'] = 'السبب';
$Definition['PaymentWizard']['Show'] = 'عرض';
$Definition['PaymentWizard']['Voucher'] = 'إيصال';
$Definition['PaymentWizard']['Vouchers'] = 'قسائم';
$Definition['PaymentWizard']['History'] = 'السجل';
$Definition['PaymentWizard']['Email'] = 'البريد الإلكتروني';
$Definition['PaymentWizard']['Yes'] = 'نعم';
$Definition['PaymentWizard']['Used'] = 'مستخدم';
$Definition['PaymentWizard']['Use details'] = 'استخدام التفاصيل';
$Definition['PaymentWizard']['Voucher details'] = 'تفاصيل القسيمة';
$Definition['PaymentWizard']['World ID'] = 'رقم التعريف لهذا العالم';
$Definition['PaymentWizard']['Player'] = 'لاعب';
$Definition['PaymentWizard']['Gold num'] = 'عدد الذهب';
$Definition['PaymentWizard']['Use voucher'] = 'استخدام قسيمة';
$Definition['PaymentWizard']['Invalid voucher code'] = 'رمز قسيمة غير صالح';
$Definition['PaymentWizard']['Unable to use voucher'] = 'تعذر إستخدام القسيمة';
$Definition['PaymentWizard']['Redeem gold by gold number'] = 'إستبدال';
$Definition['PaymentWizard']['You don`t have enough gold in your bank'] = 'لا يوجد لديك ما يكفي من الذهب لإتمام هذه العملية.';
$Definition['PaymentWizard']['Gold number must be 20 or more'] = 'كنت لا تملك ما يكفي من الذهب في البنك الذي تتعامل معه.';
$Definition['PaymentWizard']['%s golds was added to your account'] = '%s تم إضافة الذهب إلى حسابك.';
$Definition['PaymentWizard']['Voucher code'] = 'كود القسيمة';
$Definition['PaymentWizard']['Use voucher with code'] = 'إستخدام القسائم';
$Definition['PaymentWizard']['Your voucher(s)'] = 'القسيمة الخاصة بك';
$Definition['PaymentWizard']['You have no voucher codes'] = "ليس لديك أي قسيمة.";
$Definition['PaymentWizard']['VoucherReasons']['gift'] = 'هدية';
$Definition['PaymentWizard']['VoucherReasons']['remaining'] = 'الذهب المتبقي';
$Definition['PaymentWizard']['VoucherReasons']['winner'] = 'الفائز';
$Definition['PaymentWizard']['VoucherReasons']['2ndWinner'] = 'الفائز الثاني';
$Definition['PaymentWizard']['VoucherReasons']['3rdWinner'] = 'الفائز الثالث';
$Definition['PaymentWizard']['VoucherReasons']['winnerAlliance'] = 'التحالف الفائز';
$Definition['PaymentWizard']['VoucherReasons']['topOff'] = 'افضل المهاجمون';
$Definition['PaymentWizard']['VoucherReasons']['topDef'] = 'افضل المدافعون';
$Definition['PaymentWizard']['VoucherReasons']['topClimber'] = 'افضل المطورون';
$Definition['PaymentWizard']['VoucherReasons']['topOffHammer'] = 'افضل الناهبون';
$Definition['PaymentWizard']['VoucherReasons']['topDefHammer'] = 'افضل الناهبون';
$Definition['PaymentWizard']['VoucherReasons']['payment'] = 'طريقة الدفع';
$Definition['PaymentWizard']['VoucherReasons']['Partial use'] = 'استفاده تعدادی';
$Definition['PaymentWizard']['PayPalVATDesc'] = 'ستتم إضافة ضريبة " باي بال " 0.3$ +3% على القيمة.';
$Definition['PaymentWizard']['Animals purchased'] = 'الوحوش التي تم شرائها';
$Definition['PaymentWizard']['Troops purchased'] = 'الجيوش التي تم شرائها';
$Definition['PaymentWizard']['Resources purchased!'] = 'الموارد التي تم شرائها';
$Definition['PaymentWizard']['You can buy animals every %s %s'] = 'يمكنك شراء وحوش كل %s %s.';
$Definition['PaymentWizard']['You can buy resources every %s %s'] = 'يمكنك شراء موارد كل %s %s.';
$Definition['PaymentWizard']['You can buy troops every %s %s'] = 'يمكنك شراء قوات كل  %s %s.';
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
$Definition['productionOverview'] = ["productionOverview" => "نظرة عامة على الإنتاج",
    "balance" => "الرصيد",
    "production_field" => "حقل الموارد",
    "production_per_hour" => "الإنتاج بالساعة",
    "production" => "إنتاج",
    "bonus" => "علاوة",
    "production_bonus" => "مكافأة الإنتاج",
    "Oases" => "الواحات",
    "total_bonus" => "جميع المكافآت",
    "total_production_per_hour" => "إجمالي الإنتاج في الساعة",
    "hero_production" => "إنتاج البطل",
    "interim_balance" => "الرصيد المؤقت",
    "total" => "المجموع",
    "HDP" => "حصان، الشرب، أسهم",
    "sum" => "المجموع",
    "inactive" => "غير نشط",
    "productionBoostSpeechBubbleFurtherInfo" => 'تزيد علاوة الإنتاج من إنتاج المورد <span class="underlined">اللكل</span> قراكم.',
    "productionWithBoost" => "إنتاج ساعة بما في ذلك مكافأة الإنتاج",
    "extendNow" => "تمديد الآن",
    "activeNow" => "نشط الآن",
    "durationDays" => "أيام المدة",
    "Production of buildings and oases" => "إنتاج المباني والواحات",
    "Population and construction orders" => "عدد السكان وأوامر البناء",
    "Incomplete construction orders" => "أوامر البناء غير مكتملة",
    "Consumption of own troops" => "استهلاك القوات الخاصة",
    "in village" => "في القرية",
    "in oasis or reinforcements from own villages" => "في واحة أو تعزيزات من القرى الخاصة",
    "imprisoned" => "مأسور",
    "on the way" => "علي الطريق",
    "Artefact bonus" => "مكافأة القطع الأثرية",
    "Consumption of foreign troops" => "استهلاك القوات المعززة",
    "Crop balance" => "إحتياطي القمح",
    "WW effect" => "WW effect",
];
//
$Definition['Alliance']['In order to quit alliance you need an embassy'] = 'In order to quit alliance you need an embassy.';
$Definition['Alliance']['in vacation'] = 'في إجازة';
$Definition['Profile']['Player Profile'] = 'الملف الشخصي للاعب';
$Definition['Profile']['Details'] = 'التفاصيل :';
$Definition['Profile']['Rank'] = 'الرتبة :';
$Definition['Profile']['Tribe'] = 'القبيلة :';
$Definition['Profile']['Alliance'] = 'التحالف :';
$Definition['Profile']['Villages'] = 'القرى :';
$Definition['Profile']['Status'] = 'الحالة :';
$Definition['Profile']['Login to player account'] = 'تسجيل الدخول إلى حساب لاعب';
$Definition['Profile']['Population'] = 'السكان';
$Definition['Profile']['Description'] = 'الوصف';
$Definition['Profile']['Name'] = 'الإسم';
$Definition['Profile']['Active'] = 'نشط';
$Definition['Profile']['inActive'] = 'غير نشط';
$Definition['Profile']['This player messages are banned'] = 'هذا اللاعب موقوف.';
$Definition['Profile']['Escape in villages'] = 'الهروب للقرى';
$Definition['Profile']['Oases'] = 'الواحات';
$Definition['Profile']['Inhabitants'] = 'السكان';
$Definition['Profile']['Coordinates'] = 'الإحداثيات';
$Definition['Profile']['Stop ignoring this player'] = 'توقف عن تجاهل هذا اللاعب';
$Definition['Profile']['Accept messages from this player'] = 'قبول الرسائل من هذا اللاعب';
$Definition['Profile']['Write message'] = 'اكتب رسالة';
$Definition['Profile']['Write Message'] = 'اكتب رسالة';
$Definition['Profile']['Ignore Player'] = 'تجاهل اللاعب';
$Definition['Profile']['Edit list'] = 'تعديل القائمة';
$Definition['Profile']['Ignore list is full'] = 'قائمة التجاهل ممتلئة .';
$Definition['Profile']['Player will be ignored'] = 'سيتم تجاهل لاعب.';
$Definition['Profile']['WoW'] = 'معجزة';
$Definition['Profile']['Support'] = 'الدعم';
$Definition['Profile']['Game rules'] = 'قواعد اللعبة';
$Definition['Profile']['To ignore messages from a specific player, go to its profile and click on "Ignore"!'] = 'لتجاهل الرسائل من لاعب معين، انتقل إلى ملفه الشخصي وانقر على "تجاهل"!';
$Definition['Profile']['MultihunterDesc'] = 'الصياد مسؤول عن ذلك <a href="http://www.travian.com/spielregeln.php" target="_blank">قواعد اللعبة</a>. إذا كان لديك أسئلة حول القواعد أو ترغب في الإبلاغ عن انتهاكات، يمكنك مراسلة الصياد';
$Definition['Profile']['Support and Multihunter'] = 'الدعم و الصياد';
$Definition['Profile']['The support consists of experienced players who will gladly answer your questions'] = 'يتكون الدعم من فريق من اللاعبين ذوي الخبرة العالية اللذين سوف يسعدون للإجابة على أسئلتك .';
$Definition['Profile']['capital'] = 'عاصمة';
$Definition['Profile']['Artifact'] = 'التحفة';
$Definition['Profile']['Birthday'] = 'عيد الميلاد';
$Definition['Profile']['Gender'] = 'الجنس';
$Definition['Profile']['n/a'] = 'لا توجد بيانات';
$Definition['Profile']['male'] = 'محارب';
$Definition['Profile']['female'] = 'محاربه';
$Definition['Profile']['Location'] = 'الدولة';
$Definition['Profile']['Age'] = 'العمر';
$Definition['Profile']['Overview'] = 'نظرة عامة';
$Definition['Profile']['Edit Profile'] = 'تعديل الملف الشخصي';
$Definition['Profile']['Medals'] = 'الميداليات';
$Definition['Profile']['DoveOfPeace'] = 'حمامة السلام';
$Definition['Profile']['Category'] = 'الفئة';
$Definition['Profile']['Rank'] = 'الرتبة';
$Definition['Profile']['Week'] = 'الإسبوع';
$Definition['Profile']['BB-Code'] = 'الكود';
$Definition['Profile']['SpecialMedalsTitle'] = [
    1 => 'فزة برتبة 1 ',
    2 => 'فزة برتبة 2',
    3 => 'فزة برتبة 3',

    4 => 'افضل رتبة هجوم 1',
    5 => 'افضل رتبة هجوم 2',
    6 => 'افضل رتبة هجوم 3',
    7 => 'افضل رتبة هجوم 4',

    8 => 'افضل رتبة دفاع 1',
    9 => 'افضل رتبة دفاع 2',
    10 => 'افضل رتبة دفاع 3',
    11 => 'افضل رتبة دفاع 4',

    12 => 'افضل رتبة مطور 1',
    13 => 'افضل رتبة مطور 2',
    14 => 'افضل رتبة مطور 3',
    15 => 'افضل رتبة مطور 4',

    16 => 'Top offensive hammer',
    17 => 'Top defensive hammer',
    18 => 'Winner alliance',

];
$Definition['Profile']['Player special medals'] = 'الميداليات الخاصة';
$Definition['Profile']['mySpeicalMTitle'] = [
    1 => 'إعجوبة العالم',
    2 => 'إعجوبة العالم',
    3 => 'إعجوبة العالم',

    4 => "هجومي",
    5 => "هجومي",
    6 => "هجومي",
    7 => "هجومي",

    8 => 'دفاعي',
    9 => 'دفاعي',
    10 => 'دفاعي',
    11 => 'دفاعي',

    12 => 'تعداد السكان',
    13 => 'تعداد السكان',
    14 => 'تعداد السكان',
    15 => 'تعداد السكان',

    16 => 'Top offensive hammer',
    17 => 'Top defensive hammer',
    18 => 'Winner alliance',
];
$Definition['Profile']['mySpeicalM'] = [
// Ranke Wonder Of World
    1 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 1 - WW المستوى : %s',
    2 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 2 - WW المستوى : %s',
    3 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 3 - WW المستوى : %s',

// Ranke Offensive 1 ta 4 top 10
    4 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 1 - P: %s',
    5 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 2 - P: %s',
    6 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 3 - P: %s',
    7 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 4 - P: %s',
// Ranke Defensive 1 ta 4 top 10
    8 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 1 - P: %s',
    9 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 2 - P: %s',
    10 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 3 - P: %s',
    11 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 4 - P: %s',
// Ranke Pop Nafarate Avale 1 ta 4
    12 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 1 - Points: %s',
    13 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 2 - Points: %s',
    14 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 3 - Points: %s',
    15 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 4 - Points: %s',

    16 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 4',
    17 => 'S: <span class="warning"><b>%s</b></span> - الإسم : <span class="warning"><b>%s</b></span> - %s - الرتبة : 4',
    18 => 'S: <span class="warning"><b>%s</b></span> - Name: <span class="warning"><b>%s</b></span> - %s - A: <span class="warning"><b>%s</b></span>',
];
$Definition['Profile']['SpecialMedalsLayout'] = 'السيرفر %s  &nbsp; &nbsp; &nbsp; الحساب %s';
$Definition['Profile']['SpecialMedalsState'] = 'الميداليات الخاصة';
$Definition['Profile']['SpecialShow'] = 'عرض';
$Definition['Profile']['SpecialHide'] = 'إخفاء';
$Definition['Profile']['SpecialMedals'] = 'الميداليات العالمية';
$Definition['Profile']['Language'] = 'الدولة';
$Definition['Profile']['Show country flag in your profile'] = 'إظهار علم البلد في الوصف';
$Definition['Profile']['Show special medals?'] = 'إظهار الميداليات ؟';
$Definition['Profile']['YES'] = 'نعم';
$Definition['Profile']['NO'] = 'لا';
$Definition['Profile']['Note'] = 'Note';
$Definition['Profile']['Edit'] = 'Edit';
$Definition['Profile']['NoteDescription'] = 'Edit your personal note about this player. Max. length: 500 characters';
//
$Definition['Quest'] = [];
$Definition['Quest']['welcome'] = 'مرحبا';
$Definition['Quest']['helperAndTasks'] = 'المهام والمساعدة';
$Definition['Quest']['taskList'] = 'قائمة المهام';
$Definition['Quest']['questButtonActivateTips'] = 'عرض التلميحات';
$Definition['Quest']['questButtonDeactivateTips'] = 'إخفاء التلميحات';
$Definition['Quest']['questTipsToggleDescription'] = 'التلميحات تشغيل / إيقاف';
$Definition['Quest']['startTutorial'] = 'متابعة';
$Definition['Quest']['getReward'] = 'إحصل على المكافأة';
$Definition['Quest']['SkipTutorial'] = 'تجنب المهام';
$Definition['Quest']['skip'] = 'تجنب المهام';
$Definition['Quest']['questRewardTitle'] = 'مكافأتك';
$Definition['Quest']['overview'] = 'نظرة عامة';
$Definition['Quest']['questTaskTitle'] = 'بحث';
$Definition['Quest']['endOfTutorial'] = 'نهاية البرنامج التعليمي';
$Definition['Quest']['continue'] = 'متابعة';
$Definition['Quest']['battle'] = 'معركة ';
$Definition['Quest']['economy'] = 'إلتجارة';
$Definition['Quest']['world'] = 'العالم ';
$Definition['Quest']['Tutorial_01']['questTitle'] = 'مرحباً';
$Definition['Quest']['Tutorial_01']['questDescription'] = 'مرحباً %s, مرحباً بك في ترافيان <br>سأساعدك حتى بناء اول قرية وستستمر بعدها بنفسك';
$Definition['Quest']['Tutorial_01']['continue'] = 'متابعة';
$Definition['Quest']['Tutorial_01']['skip'] = 'تجنب المهام';
$Definition['Quest']['Tutorial_01']['todo'] = [0 => 'دروس وشروح السمات الرئيسية للعبة، ويمكن أن يستغرق  بضع دقائق. إبدأ الآن!',];
$Definition['Quest']['Tutorial_01']['steps'] = [0 => 'بدء البرنامج التعليمي',];
$Definition['Quest']['Tutorial_02']['questTitle'] = 'المهام والمساعدة';
$Definition['Quest']['Tutorial_02']['questDescription'] = 'يمكنك نقل صفحة المهمة أو إغلاقها. لفتحه مرة أخرى، ببساطة انقر على الصورة في أعلى الزاوية اليسرى. ستجد تلميحات والمهام تساعدك في اللعبة.';
$Definition['Quest']['Tutorial_02']['questDescriptionReward'] = ' يمكنك دائما الحصول على معلومات عن المهمة الحالية الخاصة بك. يمكنك البدء المهمة التالية عندما تتلقى مكافأة المهمة. الحصول على حفرة الطين الخاص بك.!';
$Definition['Quest']['Tutorial_02']['rewardDescription'] = 'هناك مستوى حفرة الطين 1 في انتظاركم!';
$Definition['Quest']['Tutorial_02']['todo'] = [
    0 => 'إغلاق المهمة ', 1 => 'انقر على المستشار لفتح صفحة التلميحات ',
    2 => 'إيقاف تلميحات الميزة (تعطيل)',
];
$Definition['Quest']['Tutorial_02']['steps'] = [
    0 => 'إغلاق المهمة', 1 => 'عرض التلميحات', 2 => 'تعطيل التلميحات',
];
$Definition['Quest']['Tutorial_03']['questTitle'] = 'بناء الحطاب';
$Definition['Quest']['Tutorial_03']['questDescription'] = 'لرفع قريتك تحتاج إلى الكثير من الموارد، لبناء وتدريب القوات وحتى تنمو إمبراطورية الخاص بك! أولا زيادة الموارد الخاصة بك الإنتاج - بناء الحطاب!';
$Definition['Quest']['Tutorial_03']['questDescriptionReward'] = 'انها بداية قوية لنتحرك في تجارة أقوى. لقد أكملت للتو بناء الحطاب، لتكون قادرة على الاستمرار';
$Definition['Quest']['Tutorial_03']['rewardDescription'] = 'إنهاء مستوى الحطاب 1';
$Definition['Quest']['Tutorial_03']['todo'] = [
    0 => 'افتح منطقة الغابة ',
    1 => 'رفع حقل الخشب مستوى 1 ',
];
$Definition['Quest']['Tutorial_03']['steps'] = [
    0 => 'فتح منطقة الحطاب', 1 => 'بناء الحطاب',
];
$Definition['Quest']['Tutorial_04']['questTitle'] = 'ترقية الحطاب ';
$Definition['Quest']['Tutorial_04']['questDescription'] = 'سيتطلب مبنى أكبر المزيد من الموارد مع كل ترقية، ولكن بدوره سوف تنتج أيضا أكثر من ذلك. يرجى ترقية الحطاب من مستوى 1 إلى مستوى 2 الآن!';
$Definition['Quest']['Tutorial_04']['questDescriptionReward'] = 'يمكن العثور على عرض التخزين الخاصة بك والأسهم فوق قريتك. وسيتم اتخاذ تكاليف البناء';
$Definition['Quest']['Tutorial_04']['questTaskTitle'] = 'المهمة';
$Definition['Quest']['Tutorial_04']['rewardDescription'] = 'الانتهاء من بناء مستوى الحطاب 2 على الفور';
$Definition['Quest']['Tutorial_04']['todo'] = [
    0 => 'فتح الحطاب المستوى 1 ',
    1 => 'طلب بناء الحطاب المستوى 2 ',
];
$Definition['Quest']['Tutorial_04']['steps'] = [
    0 => 'فتح المبنى ', 1 => 'الحطاب 2',
];
$Definition['Quest']['Tutorial_05']['questTitle'] = 'بناء حقول القمح';
$Definition['Quest']['Tutorial_05']['questDescription'] = 'عند النظر إلى إحتياطي القمح ، لاحظ استهلاك القمح في الزاوية اليسرى. وهذا ما يمكنك التدريب وتطوير المباني بحجم الإحتياطي. يرجى رفع حقول القمح
';
$Definition['Quest']['Tutorial_05']['questDescriptionReward'] = 'الآن يتم إنتاج قمح قريتك بكميات كافية لبناء مبنى جديد. السكان حالياً يتم دعم قوى التغذية المتمركزة في القرية ';
$Definition['Quest']['Tutorial_05']['rewardDescription'] = 'الانتهاء من مستوى حقل القمح من 1 ورفع مستواه إلى المستوى 2';
$Definition['Quest']['Tutorial_05']['todo'] = [
    0 => 'انقر على مكان حقل القمح ', 1 => 'بناء حقل القمح مستوى 1 ',
];
$Definition['Quest']['Tutorial_05']['steps'] = [
    0 => 'فتح حقول القمح ', 1 => 'رفع حقل القمح للمستوى التالي',
];
$Definition['Quest']['Tutorial_06']['questTitle'] = 'إنتاج البطل ';
$Definition['Quest']['Tutorial_06']['questDescription'] = 'يتم إنتاج الموارد من قبل البطل وهو على قيد الحياة , يرجى تغيير إنتاج البطل إلى الطين';
$Definition['Quest']['Tutorial_06']['questDescriptionReward'] = 'عظيم! الآن البطل الخاص بك سوف يساعد على إنتاج المزيد من الموارد. جميع الموارد المنتجة سوف تضيف إلى القرية الرئيسية. وسوف تزيد الموارد الخاصة بك.';
$Definition['Quest']['Tutorial_06']['rewardDescription'] = '<div class="inlineIconList resourceWrapper"><div class="inlineIcon resources" title=""><i class="r2 questRewardTypeResource questRewardTypeClay"></i><span class="value questRewardValue">'.Quest::getInstance()->multiply(200).'</span></div></div>';
$Definition['Quest']['Tutorial_06']['todo'] = [
    0 => 'انقر على صورة البطل وفتح نظرة عامة. ',
    1 => 'تغيير إنتاج البطل الخاص بك إلى الطين والحفظ. ',
];
$Definition['Quest']['Tutorial_06']['steps'] = [
    0 => 'Click On hero Image', 1 => 'تغيير الإنتاج ',
];
$Definition['Quest']['Tutorial_07']['questTitle'] = 'إذهب إلى مركز القرية ';
$Definition['Quest']['Tutorial_07']['questDescription'] = 'بعد ذلك، سوف نقوم بزيادة حجم المخزن عن طريق نظرة عامة على القرية في الجزء العلوي من القائمة للعبة. للقيام بذلك، نحن بحاجة إلى المباني داخل القرية. الذهاب إلى مركز القرية.';
$Definition['Quest']['Tutorial_07']['todo'] = [0 => 'أدخل مركز القرية.',];
$Definition['Quest']['Tutorial_07']['steps'] = [0 => 'أدخل مركز القرية',];
$Definition['Quest']['Tutorial_08']['questTitle'] = 'مستودع الخام ';
$Definition['Quest']['Tutorial_08']['questDescription'] = 'يجب عليك بناء مستودع خام لزيادة تخزين الموارد ورفع المباني والحقول لمستويات اكبر';
$Definition['Quest']['Tutorial_08']['questDescriptionReward'] = 'وقد بدأت أعمال البناء وقريبا يمكنك توفير المزيد من الموارد والنهب. وسوف أعطيك '.Quest::calcEffect(86400, 'plus', true).' ترافيان بلس، والتي يمكن أن تعطي الأوامر إلى مبنى أخر ووضعها في قائمة الانتظار أن البناء الأول للمبنى لم تنته.';
$Definition['Quest']['Tutorial_08']['rewardDescription'] = 'يوم واحد بلس';
$Definition['Quest']['Tutorial_08']['todo'] = [
    0 => 'إفتح مركز القرية , اختر مكان فارغ إختر المباني',
    1 => 'قم بترقية مستودع الخام للمستوى 1 ',
];
$Definition['Quest']['Tutorial_08']['steps'] = [
    0 => 'انقر على مكان فارغ', 1 => 'بناء مستودع الخام',
];
$Definition['Quest']['Tutorial_09']['questTitle'] = 'نقطة التجمع ';
$Definition['Quest']['Tutorial_09']['questDescription'] = 'من أجل إرسال البطل إلى مغامرات، تحتاج إلى نقطة تجمع - يمكنك العثور عليه في مركز القرية! بناء عليها وترقية إلى المستوى 1';
$Definition['Quest']['Tutorial_09']['questDescriptionReward'] = 'تبدو جيدة! الآن يمكنك إرسال البطل الخاص بك إلى المغامرة. لتنفيذ هذه المهمة، سوف أعطيك بعض الذهب التي يمكنك قضاء ذلك في الطريق الصحيح.';
$Definition['Quest']['Tutorial_09']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeGold"> <span class="questRewardValue">2</span>';
$Definition['Quest']['Tutorial_09']['todo'] = [
    0 => 'انقر على موقع مبنى نقطة التجمع. ',
    1 => 'بناء نقطة التجمع للمستوى 1 ',
];
$Definition['Quest']['Tutorial_09']['steps'] = [
    0 => 'أنقر على موقع مبنى نقطة التجمع', 1 => 'بناء نقطة التجمع للمستوى 1',
];
$Definition['Quest']['Tutorial_10']['questTitle'] = 'إنهاء فوراً ';
$Definition['Quest']['Tutorial_10']['questDescription'] = 'أسفل القرية، يمكنك العثور على قائمة مع كل من أوامر البناء الحالية الخاصة بك. هذه المرة، يمكنك تسريع بناء نفسك. استخدام الذهب من المهمة الأخيرة والانتهاء من أوامر البناء من خلال النقر على "البناء الكامل على الفور".';
$Definition['Quest']['Tutorial_10']['questDescriptionReward'] = 'الآن يمكنك إرسال مغامرة البطل الخاص بك. أولا، إعطاء النظام لبناء بعض الموارد التي قريتك دائما يكبر. الحصول على هذا الذهب واستخدامه بحكمة.';
$Definition['Quest']['Tutorial_10']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeGold"> <span class="questRewardValue">10</span>';
$Definition['Quest']['Tutorial_10']['todo'] = [0 => 'إنهاء اوامر البناء على الفور ',];
$Definition['Quest']['Tutorial_10']['steps'] = [0 => 'انهاء البناء ',];
$Definition['Quest']['Tutorial_11']['questTitle'] = 'الذهاب إلى المغامرة ';
$Definition['Quest']['Tutorial_11']['questDescription'] = 'اكتشاف الأماكن الغامضة في محيطك لجمع الخبرة . فتح قائمة المغامرة وإرسال البطل الخاص بك على مغامرته الأولى.';
$Definition['Quest']['Tutorial_11']['questDescriptionReward'] = 'عظيم !، البطل الخاص بك هو في طريق المغامرة - ما اللذي سوف يجده؟ أدناه صورة البطل يمكنك ان ترى صورة البطل تتحرك. سأعود البطل الخاص بك على الفور !، لمعرفة ما سيحدث.';
$Definition['Quest']['Tutorial_11']['rewardDescription'] = 'سيعود البطل الخاص بك على الفور من المغامرة';
$Definition['Quest']['Tutorial_11']['todo'] = [0 => 'إرسال البطل الخاص بك إلى المغامرة',];
$Definition['Quest']['Tutorial_11']['steps'] = [0 => 'مغامرات البطل ',];
$Definition['Quest']['Tutorial_12']['questTitle'] = 'التقارير';
$Definition['Quest']['Tutorial_12']['questDescription'] = 'البطل الخاص بك هو الآن في طريق العودة من المغامرة الأولى. في القائمة في الجزء العلوي، يمكنك العثور على التقارير. افتح قائمة التقارير وقراءة تقرير المغامرة.';
$Definition['Quest']['Tutorial_12']['questDescriptionReward'] = 'يمكنك معرفة ما حصل عليه البطل من المغامرة , سأعطيك بعض دهن الشفاء لشفاء بطلك من الإصابة التي تعرض لها اثناء المغامرة';
$Definition['Quest']['Tutorial_12']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeItem item106"> <span class="questRewardValue">'.Quest::calcEffect(10, 'item', true).'</span>';
$Definition['Quest']['Tutorial_12']['todo'] = [
    0 => 'فتح قائمة التقارير', 1 => 'عرض تقرير المغامرة',
];
$Definition['Quest']['Tutorial_12']['steps'] = [
    0 => 'قائمة التقارير ', 1 => 'قراءة التقرير الخاص بالمغامرة ',
];
$Definition['Quest']['Tutorial_13']['questTitle'] = 'شفاء البطل';
$Definition['Quest']['Tutorial_13']['questDescription'] = 'أصيب بطلك ببعض الجروح , قم بالظغط على صورة البطل وإعطاءة بعض دهن الشفاء';
$Definition['Quest']['Tutorial_13']['questDescriptionReward'] = 'جميع الأدوات والأسلحة يمكن أن تستخدم في نفس الطريقه. اعتمادا على نوعه، يمكنك عرض معلومات الآداة من خلال تمرير المؤشر فوق الأداة.';
$Definition['Quest']['Tutorial_13']['rewardDescription'] = 'تلقى بطلك 20 نقطة خبرة';
$Definition['Quest']['Tutorial_13']['todo'] = [
    0 => 'انقر على صورة البطل الخاص بك  ',
    1 => 'إختر دهن الشفاء وقم بإستخدامه',
];
$Definition['Quest']['Tutorial_13']['steps'] = [
    0 => 'مخزن البطل ', 1 => 'شفاء البطل',
];
$Definition['Quest']['Tutorial_14']['questTitle'] = 'واجهة المساعدة ';
$Definition['Quest']['Tutorial_14']['questDescription'] = 'بالقرب من صورتي، يمكنك العثور على بعض المساعدة الإضافية بخصوص اللعبة. هناك، يمكنك أن تجد تفسيرات حول التخطيط وأقسام مختلفة من واجهة المستخدم. اعطه محاولة فقط!';
$Definition['Quest']['Tutorial_14']['questDescriptionReward'] = 'إذا كان لديك أسئلة محددة، أولا البحث عنها في "إجابات ترافيان" والحصول على المساعدة. للقيام بذلك، و "ط" في رأس هذه النافذة أو في زاوية من الشاشة.';
$Definition['Quest']['Tutorial_14']['rewardDescription'] = buildResourcesReward([270, 300, 270, 220]);
$Definition['Quest']['Tutorial_14']['todo'] = [0 => 'افتح مساعدة واجهة المستخدم واطلع على واجهة المستخدم ',];
$Definition['Quest']['Tutorial_14']['steps'] = [0 => 'مساعدة واجهة المستخدم ',];
$Definition['Quest']['Tutorial_15']['questTitle'] = 'نهاية التدريب ';
$Definition['Quest']['Tutorial_15']['questDescription'] = $Definition['Quest']['Tutorial_15a']['questDescriptionReward'] = 'الآن أنت تعرف أساسيات اللعبة. سوف تظهر معلومات هامة مثل البيانات الحرجة لدعم الوافدين الجدد واللعبة في مربع المعلومات على اليسار. استمتع ترافيان!';
$Definition['Quest']['Tutorial_15']['rewardDescription'] = 'الانتهاء من التدريب.';
$Definition['Quest']['Tutorial_15']['todo'] = [0 => 'نهاية البرنامج التعليمي',];
$Definition['Quest']['Tutorial_15']['steps'] = [0 => 'نهاية البرنامج التعليمي',];
$Definition['Quest']['Tutorial_15a']['questTitle'] = 'تخطي البرنامج التعليمي';
$Definition['Quest']['Tutorial_15a']['questDescription'] = 'لتبدأ، وسوف أعطيك المباني والمزايا من البرنامج التعليمي. المزيد من المهام والمكافآت في انتظاركم من الآن حتى بناء قريتك الثانية. استمتع بلعب ترافيان!';
$Definition['Quest']['Tutorial_15a']['rewardDescription'] = 'نقطة التجمع 1, حفرة الطين, الحطاب مستوى 2, حقل القمح مستوى 2, 10 ذهب, '.Quest::calcEffect(86400, 'plus', true).' بلاس';
$Definition['Quest']['Tutorial_15a']['steps'] = [0 => 'تخطي البرنامج التعليمي',];
$Definition['Quest']['battle_01_name'] = 'المغامرة التالية ';
$Definition['Quest']['battle_02_name'] = 'بناء مخبأ ';
$Definition['Quest']['battle_03_name'] = 'بناء ثكنة ';
$Definition['Quest']['battle_04_name'] = 'مستوى البطل ';
$Definition['Quest']['battle_05_name'] = 'تدريب قوات';
$Definition['Quest']['battle_06_name'] = 'بناء السور';
$Definition['Quest']['battle_07_name'] = 'مهاجمة واحة';
$Definition['Quest']['battle_08_name'] = '10 مغامرات';
$Definition['Quest']['battle_09_name'] = 'المزاد';
$Definition['Quest']['battle_10_name'] = 'ترقية الثكنة';
$Definition['Quest']['battle_11_name'] = 'بناء الأكاديمية';
$Definition['Quest']['battle_12_name'] = 'البحث عن قوات';
$Definition['Quest']['battle_13_name'] = 'تحسين القوات';
$Definition['Quest']['battle_14_name'] = 'تحسين القوات';
$Definition['Quest']['battle_15_name'] = 'إنهاء 5 مغامرات';
$Definition['Quest']['Battle_01']['questTitle'] = 'المغامرة التالية';
$Definition['Quest']['Battle_01']['questDescription'] = 'خلال الدورة التدريبية، تحصل على بعض نقاط الخبرة من المغامرات. إبدأ مغامرتك التالية حالما يعود بطلك إلى القرية. تجميع الخبرة سيعطيك دفعة للنمو بسرعة.';
$Definition['Quest']['Battle_01']['questDescriptionReward'] = 'ممتاز بطلك على الطريق';
$Definition['Quest']['Battle_01']['rewardDescription'] = '30 نقطة خبرة للبطل';
$Definition['Quest']['Battle_01']['todo'] = [0 => 'الإنتقال للمغامرة التالية ',];
$Definition['Quest']['Battle_02']['questTitle'] = 'بناء المخبأ ';
$Definition['Quest']['Battle_02']['questDescription'] = 'قم ببناء مخبأ لحماية موارد القرية , هناك الكثير من اللاعبين يريدون مواردك ! قم بتخبئة مواردك';
$Definition['Quest']['Battle_02']['questDescriptionReward'] = 'بعد إنتهاء حماية المبتدئين سترى الكثير من اللاعبين القريب والبعيد يبحث عن موارد , لاتكن أنت من يعطيهم موارد ! خبئ مواردك ';
$Definition['Quest']['Battle_02']['rewardDescription'] = buildResourcesReward([130, 150, 120, 100]);
$Definition['Quest']['Battle_02']['todo'] = [0 => 'بناء مخبأ ',];
$Definition['Quest']['Battle_03']['questTitle'] = 'بناء ثكنة ';
$Definition['Quest']['Battle_03']['questDescription'] = 'في الثكنة يتم تدريب القوات , كلما إرتفع مستوى الثكنة قلت الفترة الزمنية لتدريب القوات';
$Definition['Quest']['Battle_03']['questDescriptionReward'] = 'وقد بنيت الثكنات الخاصة بك! خطوة جيدة نحو الهيمنة على العالم!';
$Definition['Quest']['Battle_03']['rewardDescription'] = buildResourcesReward([110, 140, 160, 30]);
$Definition['Quest']['Battle_03']['todo'] = [0 => ' بناء الثكنة ',];
$Definition['Quest']['Battle_04']['questTitle'] = 'مستوى البطل ';
$Definition['Quest']['Battle_04']['questDescription'] = 'إظغط على صورة البطل وأظهر الميزات وقم بإضافة نقاط على الكفائة الحربية !';
$Definition['Quest']['Battle_04']['questDescriptionReward'] = 'يمكنك تغيير توزيع النقاط لكل فئة في أي وقت. كل ما تحتاجه لهذا هو كتاب الحكمة، والتي يمكن العثور عليها في مغامرات.';
$Definition['Quest']['Battle_04']['rewardDescription'] = buildResourcesReward([190, 250, 150, 110]);
$Definition['Quest']['Battle_04']['todo'] = [0 => 'توزيع النقاط الخاصه بالبطل عند توفر نقاط جديدة',];
$Definition['Quest']['Battle_05']['questTitle'] = 'تدريب القوات';
$Definition['Quest']['Battle_05']['questDescription'] = 'الآن حان الوقت لتدريب القوات الأولى. في الثكنات، يمكنك بالفعل تدريب نوع واحد من وحدة المشاة.';
$Definition['Quest']['Battle_05']['questDescriptionReward'] = 'وقد وضعت حجر الأساس للجيش المجيدة! تذكر دائما أنه لا يزال بإمكانك الهجوم، حتى عندما لا تكون متصلا بالإنترنت.';
$Definition['Quest']['Battle_05']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeItem item114"> <span class="questRewardValue">1</span>';
$Definition['Quest']['Battle_05']['todo'] = [0 => 'تدريب القوات في الثكنة',];
$Definition['Quest']['Battle_06']['questTitle'] = 'بناء السور ';
$Definition['Quest']['Battle_06']['questDescription'] = 'الآن يجب عليك أيضا بناء بعض الدفاعات.و زيادة الدفاع الأساسي الخاص بك، كما يزيد من قوة القتال للدفاع .';
$Definition['Quest']['Battle_06']['questDescriptionReward'] = 'رائع، مكافأة الدفاع من السور الآن أفضل من السابق.';
$Definition['Quest']['Battle_06']['rewardDescription'] = buildResourcesReward([120, 120, 90, 50]);
$Definition['Quest']['Battle_06']['todo'] = [0 => 'بناء السور حول قريتك ',];
$Definition['Quest']['Battle_07']['questTitle'] = 'مهاجمة واحة ';
$Definition['Quest']['Battle_07']['questDescription'] = 'قم بالبحث عن واحة غير محتلة بالجوار وقم بمهاجمتها ببعض القوات أو بالبطل ليأسر الوحوش منها';
$Definition['Quest']['Battle_07']['questDescriptionReward'] = 'تهانينا، الهجوم الأول الخاص بك في الطريق! لا يزال بإمكانك إلغائه لفترة قصيرة من الوقت من داخل نقطة التجمع.';
$Definition['Quest']['Battle_07']['rewardDescription'] = Quest::calcEffect(2, 'troops', true) . ' ' . 'واحد من القوات';
$Definition['Quest']['Battle_07']['todo'] = [0 => 'فتح الخارطة ومهاجمة واحة غير محتلة ',];
$Definition['Quest']['Battle_08']['questTitle'] = '10 مغامرات ';
$Definition['Quest']['Battle_08']['questDescription'] = 'الاستمرار في إرسال البطل الخاص بك على مغامرات. بعد الانتهاء من 10 منهم، يمكنك المشاركة في المزادات والمواد التجارية مع لاعبين آخرين.';
$Definition['Quest']['Battle_08']['questDescriptionReward'] = 'تهانينا، يمكنك الآن استخدام المزاد. خذ هذه الفضة، لذلك لديك بعض الفضة للتداول على الفور.';
$Definition['Quest']['Battle_08']['rewardDescription'] = '500 فضة';
$Definition['Quest']['Battle_08']['todo'] = [0 => 'انهاء 10 مغامرات',];
$Definition['Quest']['Battle_09']['questTitle'] = 'المزاد';
$Definition['Quest']['Battle_09']['questDescription'] = 'قم بالذهاب للمزاد وشراء قطعة او قم ببيع قطعة من القطع االتي حصل عليها البطل من المغامرات';
$Definition['Quest']['Battle_09']['questDescriptionReward'] = 'ممتاز , وانت الأن تعرف إستخدام المزاد مع باقي اللاعبين !';
$Definition['Quest']['Battle_09']['rewardDescription'] = buildResourcesReward([280, 120, 220, 110]);
$Definition['Quest']['Battle_09']['todo'] = [0 => 'إنشاء عرض وتأكيده في المزاد .',];
$Definition['Quest']['Battle_10']['questTitle'] = 'ترقية الثكنة ';
$Definition['Quest']['Battle_10']['questDescription'] = 'ترقية الثكنات الخاصة بك الآن. مع هذا، يمكنك استيفاء متطلبات فتح المزيد من المباني.';
$Definition['Quest']['Battle_10']['questDescriptionReward'] = 'رائع , يمكنك تدريب القوات الآن بوقت أقل من السابق , كما يمكنك أيضاً بناء الأكاديمية !';
$Definition['Quest']['Battle_10']['rewardDescription'] = buildResourcesReward([440, 290, 430, 240]);
$Definition['Quest']['Battle_10']['todo'] = [0 => 'ترقية الثكنة للمستوى 3 ',];
$Definition['Quest']['Battle_11']['questTitle'] = 'بناء الأكاديمية';
$Definition['Quest']['Battle_11']['questDescription'] = 'وحدات جديدة وقوية لقريتك يمكن بحثها في الأكاديمية. بعض الوحدات مكلفة للغاية ولها متطلبات عالية قبل أن يتم البحث عنها.';
$Definition['Quest']['Battle_11']['questDescriptionReward'] = 'أحسنت , قريباً ستجد قوات متاحة للبحث عنها !';
$Definition['Quest']['Battle_11']['rewardDescription'] = buildResourcesReward([210, 170, 245, 115]);
$Definition['Quest']['Battle_11']['todo'] = [0 => 'بناء الأكاديمية الآن',];
$Definition['Quest']['Battle_12']['questTitle'] = 'البحث عن وحدة';
$Definition['Quest']['Battle_12']['questDescription'] = 'تحقق من خيارات البحث الآن. هناك وحدات المشاة والفرسان، فضلا عن أسلحة الحصار. وحدات متخصصة أساسا في الهجوم أو الدفاع.';
$Definition['Quest']['Battle_12']['questDescriptionReward'] = ' البحث وحده هو بالطبع لا يكفي؛ سوف تحتاج أيضا إلى تدريب قوات.';
$Definition['Quest']['Battle_12']['rewardDescription'] = buildResourcesReward([450, 435, 515, 550]);
$Definition['Quest']['Battle_12']['todo'] = [0 => 'إبحث عن نوع إضافي من القوات في الأكاديمية',];
$Definition['Quest']['Battle_13']['questTitle'] = 'بناء افران صهر الحديد ';
$Definition['Quest']['Battle_13']['questDescription'] = ' افران صهر الحديد يمكنك تحسين القوات فيها ورفع جاهزية جيشك الهجومي والدفاعي بشكل اقوى ';
$Definition['Quest']['Battle_13']['questDescriptionReward'] = 'ممتاز. الآن يمكنك تدريع أقوى الجنود.';
$Definition['Quest']['Battle_13']['rewardDescription'] = buildResourcesReward([500, 400, 700, 400]);
$Definition['Quest']['Battle_13']['todo'] = [0 => 'بناء افران صهر الحديد',];
$Definition['Quest']['Battle_14']['questTitle'] = 'تحسين الوحدات';
$Definition['Quest']['Battle_14']['questDescription'] = 'تحسين القوات مهم للغاية ف كل مستوى تحسين تزداد قواتك قوة إضافية تجعل دروعها صلبة';
$Definition['Quest']['Battle_14']['questDescriptionReward'] = 'تحسين أي وحدة من الوحدات المتوفرة في افران صهر الحديد';
$Definition['Quest']['Battle_14']['rewardDescription'] = '

								<img src="img/x.gif" class="questRewardTypeItem item112"> <span class="questRewardValue">'.Quest::calcEffect(10, 'item', true).'</span>

							';
$Definition['Quest']['Battle_14']['todo'] = [0 => 'إنهاء ترقية نوع القوات.',];
$Definition['Quest']['Battle_15']['questTitle'] = 'إنهاء 5 مغامرات';
$Definition['Quest']['Battle_15']['questDescription'] = 'مغامرات أكثر غنائم أكثر , قم بإرسال بطلك للمغامرة كلما توفرت مغامرة , قم بإراحة البطل إذا كانت صحته متدنية أو إعطائة دهن شفاء';
$Definition['Quest']['Battle_15']['questDescriptionReward'] = 'مرهم يمكن استخدامها للشفاء البطل الخاص بك. إذا كنت تجهيز المراهم أنها سوف تستخدم في أقرب وقت البطل يأخذ الضرر.';
$Definition['Quest']['Battle_15']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeItem item106"> <span class="questRewardValue">'.Quest::calcEffect(15, 'item', true).'</span>';
$Definition['Quest']['Battle_15']['todo'] = [0 => 'إنهاء 5 مغامرات',];
$Definition['Quest']['economy_01_name'] = 'منجم حديد';
$Definition['Quest']['economy_02_name'] = 'موارد إضافية ';
$Definition['Quest']['economy_03_name'] = 'المخبأ';
$Definition['Quest']['economy_04_name'] = 'اللكل مستوى 1 ';
$Definition['Quest']['economy_05_name'] = 'للمستوى 2 !';
$Definition['Quest']['economy_06_name'] = 'السوق';
$Definition['Quest']['economy_07_name'] = 'التجارة';
$Definition['Quest']['economy_08_name'] = 'اللكل للمستوى 2';
$Definition['Quest']['economy_09_name'] = 'مستودع الخام مستوى 3';
$Definition['Quest']['economy_10_name'] = 'مستودع الحبوب مستوى 3';
$Definition['Quest']['economy_11_name'] = 'المطاحن';
$Definition['Quest']['economy_12_name'] = 'اللكل مستوى 5';
$Definition['Quest']['Economy_01']['questTitle'] = 'منجم حديد';
$Definition['Quest']['Economy_01']['questDescription'] = 'طلب بناء منجم الحديد! هدفك الرئيسي لا يزال رفع الإنتاج من الموارد بحيث يمكنك النمو بسرعة.';
$Definition['Quest']['Economy_01']['questDescriptionReward'] = 'ارتفع إنتاج الحديد لقريتك. سوف تساعدك علاوة الإنتاج على زيادة إنتاج أي مورد معين إلى أبعد من ذلك.';
$Definition['Quest']['Economy_01']['rewardDescription'] = Quest::calcEffect(86400, 'productionBoost', true) . ' + 25٪ مكافأة على إنتاج جميع الموارد';
$Definition['Quest']['Economy_01']['todo'] = [0 => 'بدء بناء منجم الحديد.',];
$Definition['Quest']['Economy_02']['questTitle'] = 'المزيد من الموارد';
$Definition['Quest']['Economy_02']['questDescription'] = 'قم بتمديد حقل من الخشب والطين والحديد والقمح إلى مستوى 1. لإكمال هذه المهمة يجب أن يكون لديك حقلان على الأقل من كل نوع من الموارد فوق المستوى 0. طالما أن ترافيان بلس لا يزال نشطا، يمكنك دائما طلب امر إضافي في نفس الوقت.';
$Definition['Quest']['Economy_02']['questDescriptionReward'] = 'تهانينا! قريتك تنمو وتزدهر .';
$Definition['Quest']['Economy_02']['rewardDescription'] = 'يوم واحد + 25٪ مكافأة على إنتاج جميع الموارد';
$Definition['Quest']['Economy_02']['todo'] = [0 => 'ترقية الحقول من كل نوع إلى المستوى 1.',];
$Definition['Quest']['Economy_03']['questTitle'] = 'مستودع الحبوب';
$Definition['Quest']['Economy_03']['questDescription'] = 'من أجل تخزين المزيد من القمح، تحتاج إلى مستودع حبوب. يمكن العثور على حد السعة التخزينية الحالي عند النظر إلى شريط الموارد.';
$Definition['Quest']['Economy_03']['questDescriptionReward'] = ' تمام! المستودع الآن يسمح لك لتخزين المزيد من القمح.';
$Definition['Quest']['Economy_03']['rewardDescription'] = buildResourcesReward([250, 290, 100, 130]);
$Definition['Quest']['Economy_03']['todo'] = [0 => 'بناء مخزن.',];
$Definition['Quest']['Economy_04']['questTitle'] = 'الكل للمستوى الاول ';
$Definition['Quest']['Economy_04']['questDescription'] = 'في البداية، من الأفضل التركيز على الموارد. يرجى ترقية جميع حقول الموارد إلى المستوى 1.';
$Definition['Quest']['Economy_04']['questDescriptionReward'] = 'إنتاج الموارد الخاصة بك يتطور بشكل جيد. قريبا يمكننا البدء في بناء المزيد من المباني في قريتك.';
$Definition['Quest']['Economy_04']['rewardDescription'] = buildResourcesReward([400, 460, 330, 270]);
$Definition['Quest']['Economy_04']['todo'] = [0 => 'ترقية جميع حقول الموارد إلى المستوى 1.',];
$Definition['Quest']['Economy_05']['questTitle'] = 'للمستوى 2! ';
$Definition['Quest']['Economy_05']['questDescription'] = 'أحسنت! إذا كنت بحاجة إلى مزيد من المعلومات حول الإنتاج الخاص بك، انقر على شريط الموارد .';
$Definition['Quest']['Economy_05']['questDescriptionReward'] = 'أحسنت! إذا كنت بحاجة إلى مزيد من المعلومات حول الإنتاج الخاص بك، انقر على شريط الموارد .';
$Definition['Quest']['Economy_05']['rewardDescription'] = buildResourcesReward([240, 255, 190, 160]);
$Definition['Quest']['Economy_05']['todo'] = [0 => 'ترقية حقل واحد من كل مورد إلى المستوى 2.',];
$Definition['Quest']['Economy_06']['questTitle'] = 'السوق ';
$Definition['Quest']['Economy_06']['questDescription'] = 'في حال كان لديك نقص في مورد واحد، يمكنك تداوله للحصول على موارد أخرى مع لاعبين آخرين في السوق. من أجل بناء سوق تحتاج إلى مبنى رئيسي 3.';
$Definition['Quest']['Economy_06']['questDescriptionReward'] = 'السوق الخاص بك جاهز ويمكنك الآن بدء التداول مع لاعبين آخرين.!';
$Definition['Quest']['Economy_06']['rewardDescription'] = '
								<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . Quest::getInstance()->multiply(600) . '</span>
							';
$Definition['Quest']['Economy_06']['todo'] = [0 => 'بناء السوق ',];
$Definition['Quest']['Economy_07']['questTitle'] = 'تجارة ';
$Definition['Quest']['Economy_07']['questDescription'] = 'ويمكن رؤية العروض الموجودة في السوق عند النقر على \ "شراء \". تحقق من سعر الصرف والمسافة. إذا لم تتمكن من العثور على عرض مناسب، فانقر على \ "عرض \" لإنشاء عرض بنفسك.';
$Definition['Quest']['Economy_07']['questDescriptionReward'] = 'رهيب، كنت قد بدأت تجارتك الأولى.';
$Definition['Quest']['Economy_07']['rewardDescription'] = buildResourcesReward([100, 99, 99, 99]);
$Definition['Quest']['Economy_07']['todo'] = [0 => 'إنشاء عرض السوق أو قبول واحد',];
$Definition['Quest']['Economy_08']['questTitle'] = 'الكل للمستوى 2';
$Definition['Quest']['Economy_08']['questDescription'] = 'قبل البدء في إنشاء مبان أكثر تكلفة، يجب علينا زيادة إنتاج الموارد الخاصة بك. ترقية جميع حقول الموارد إلى المستوى 2.';
$Definition['Quest']['Economy_08']['questDescriptionReward'] = 'تهانينا! إنتاج الموارد الخاصة بك يتطور بشكل جيد.';
$Definition['Quest']['Economy_08']['rewardDescription'] = buildResourcesReward([400, 400, 400, 200]);
$Definition['Quest']['Economy_08']['todo'] = [0 => 'قم بتمديد جميع حقول الموارد إلى المستوى 2',];
$Definition['Quest']['Economy_09']['questTitle'] = 'مستودع الخام 3 ';
$Definition['Quest']['Economy_09']['questDescription'] = 'حان الوقت لضبط مستودع الخام للمستوى 3 لزيادة السعة.';
$Definition['Quest']['Economy_09']['questDescriptionReward'] = 'جيد، لن تضيع أي موارد اثناء غيابك.';
$Definition['Quest']['Economy_09']['rewardDescription'] = buildResourcesReward([620, 750, 560, 230]);
$Definition['Quest']['Economy_09']['todo'] = [0 => 'ترقية مستودع الخام إلى المستوى 3',];
$Definition['Quest']['Economy_10']['questTitle'] = 'مستودع الحبوب 3';
$Definition['Quest']['Economy_10']['questDescription'] = 'ترقية مستودع الحبوب إلى المستوى 3';
$Definition['Quest']['Economy_10']['questDescriptionReward'] = 'جيد، لن تضيع أي موارد اثناء غيابك.';
$Definition['Quest']['Economy_10']['rewardDescription'] = buildResourcesReward([880, 1020, 590, 320]);
$Definition['Quest']['Economy_10']['todo'] = [0 => 'ترقية مستودع الحبوب إلى المستوى 3',];
$Definition['Quest']['Economy_11']['questTitle'] = 'المطاحن';
$Definition['Quest']['Economy_11']['questDescription'] = 'مطاحن الحبوب تزيد من إنتاج القمح الخاص بك.';
$Definition['Quest']['Economy_11']['questDescriptionReward'] = 'الآن لديك الكثير من حقول القمح ولديك مباني تزيد إنتاج القمح , المطاحن والمخبز . وهناك أيضا مبان تزيد من إنتاج الخام الموارد الأخرى.';
$Definition['Quest']['Economy_11']['rewardDescription'] = 'مطاحن الحبوب المستوى 2';
$Definition['Quest']['Economy_11']['todo'] = [0 => 'ترقية حقل قمح للمستوى 5',];
$Definition['Quest']['Economy_12']['questTitle'] = 'اللكل للمستوى 5';
$Definition['Quest']['Economy_12']['questDescription'] = 'سوف تحتاج إلى إنتاج أعلى بكثير من أجل تجنيبك فترة انتظار طويلة حتى تكون قادرا على تحمل المباني والمستوطنين اللازمة لقرية ثانية. ترقية جميع حقول الموارد إلى المستوى 5.';
$Definition['Quest']['Economy_12']['questDescriptionReward'] = 'أحسنت، الإنتاج الخاص بك أعلى الآن ويمكنك أن تبني المزيد من المباني والحقول.';
$Definition['Quest']['Economy_12']['rewardDescription'] = Quest::calcEffect(86400, 'productionBoost', true) . ' + 25٪ مكافأة على إنتاج جميع الموارد';
$Definition['Quest']['Economy_12']['todo'] = [0 => 'ترقية جميع حقول الموارد إلى المستوى 5.',];
$Definition['Quest']['World_01']['questTitle'] = 'الإحصائيات';
$Definition['Quest']['World_01']['questDescription'] = 'في عالم ترافيان، كنت تنافس ضد مئات من اللاعبين الآخرين. تحقق من الإحصاءات لمعرفة المزيد عن الرتب الخاصه بك في العالم';
$Definition['Quest']['World_01']['questDescriptionReward'] = 'بصرف النظر عن الرتبة، وهناك معلومات أخرى مفيدة. تظهر لك أقوى المهاجمين والناهبون والمدافعون والمطورون الأكثر نجاحا.';
$Definition['Quest']['World_01']['rewardDescription'] = buildResourcesReward([90, 120, 60, 30]);
$Definition['Quest']['World_01']['todo'] = [0 => 'فتح الإحصاءات ومقارنة نفسك مع لاعبين آخرين. ',];
$Definition['Quest']['World_02']['questTitle'] = 'تغيير إسم القرية ';
$Definition['Quest']['World_02']['questDescription'] = 'اسم القرية الذي تختارة سيرآه جميع اللاعبين، وتبين لهم أن الإمبراطورية الخاصة بك تحمل إسم مميز.';
$Definition['Quest']['World_02']['questDescriptionReward'] = 'جيد، الآن كنت قد أكملت الخطوة الأولى لترك بصمتك في عالم ترافيان.';
$Definition['Quest']['World_02']['rewardDescription'] = Quest::calcEffect(100, 'cp', true) . ' نقطة حضارية إضافية';
$Definition['Quest']['World_02']['todo'] = [0 => 'تغيير اسم القرية على علامة القرية.',];
$Definition['Quest']['World_03']['questTitle'] = 'المبنى الرئيسي للمستوى 3 ';
$Definition['Quest']['World_03']['questDescription'] = 'كلما إرتفع مستوى المبنى الرئيسي كلما قلت المدة الزمنية لإنشاء المباني وفتح خيارات جديدة لمباني جديدة تستطيع بنائها';
$Definition['Quest']['World_03']['questDescriptionReward'] = 'جيد، المبنى الرئيسي يسمح لك الآن لبناء بعض المباني الإضافية التي كانت مقفلة.';
$Definition['Quest']['World_03']['rewardDescription'] = buildResourcesReward([170, 100, 130, 70]);
$Definition['Quest']['World_03']['todo'] = [0 => 'قم بترقية المبنى الرئيسي إلى المستوى 3.',];
$Definition['Quest']['World_04']['questTitle'] = 'بناء سفارة ';
$Definition['Quest']['World_04']['questDescription'] = 'عالم ترافيان هو مكان خطير وتحتاج إلى أن تكون قادر على الدفاع عن نفسك. يتم توفير دفاع إضافي من التحالف. إنشاء سفارة من أجل الانضمام إلى تحالف.';
$Definition['Quest']['World_04']['questDescriptionReward'] = 'ممتاز، والآن يمكنك قبول دعوات التحالف. يمكن العثور على دعوات داخل السفارة.';
$Definition['Quest']['World_04']['rewardDescription'] = buildResourcesReward([215, 145, 195, 50]);
$Definition['Quest']['World_04']['todo'] = [0 => 'بناء سفارة.',];
$Definition['Quest']['World_05']['questTitle'] = 'فتح الخارطة ';
$Definition['Quest']['World_05']['questDescription'] = 'الخارطة تظهر لك عالم ترافيان. تحقق من جيرانك لمعرفة العدو من الصديق ودراسة المنطقة لوضع خطة للسيطرة عليها في المستقبل.';
$Definition['Quest']['World_05']['questDescriptionReward'] = 'هل هناك لاعبين أو تحالفات قوية بالقرب منك؟ تساعد الخريطة أيضا في العثور على الواحات والأماكن حيث يمكنك بناء قرى جديدة فيها.';
$Definition['Quest']['World_05']['rewardDescription'] = buildResourcesReward([90, 160, 90, 95]);
$Definition['Quest']['World_05']['todo'] = [0 => 'افتح الخريطة من القائمة.',];
$Definition['Quest']['World_06']['questTitle'] = 'قرائة الرسالة';
$Definition['Quest']['World_06']['questDescription'] = 'لقد تلقيت للتو رسالة مع بعض التلميحات المفيدة. يمكن التعرف على الرسائل غير المقروءة . إلقاء نظرة الآن.';
$Definition['Quest']['World_06']['questDescriptionReward'] = 'استخدام الرسائل للتواصل مع لاعبين آخرين. يجب ان تكون دائما هادئة ومهذبا مع اللاعبين، حتى لو كنت في معركة معهم.';
$Definition['Quest']['World_06']['rewardDescription'] = buildResourcesReward([280, 315, 200, 145]);
$Definition['Quest']['World_06']['todo'] = [0 => 'افتح نظرة عامة على الرسائل وقراءة الرسالة الرئيسية للمهمة! ',];
$Definition['Quest']['World_07']['questTitle'] = 'مكافأة الذهب ';
$Definition['Quest']['World_07']['questDescription'] = 'خلال البرنامج التعليمي، كنت قد استخدمت بالفعل الذهب لتسريع أوامر البناء الخاص بك. في متجر الذهب، يمكنك معرفة ما يمكنك استخدام الذهب الخاص بك .';
$Definition['Quest']['World_07']['questDescriptionReward'] = 'هنا بعض الذهب مجانا مرة أخرى، بحيث يمكنك الاستفادة من بعض مزايا الذهب.';
$Definition['Quest']['World_07']['rewardDescription'] = '

								<img src="img/x.gif" class="questRewardTypeGold"> <span class="questRewardValue">20</span>

							';
$Definition['Quest']['World_07']['todo'] = [0 => 'إلقاء نظرة على المميزات للذهب.',];
$Definition['Quest']['World_08']['questTitle'] = 'تحالف ';
$Definition['Quest']['World_08']['questDescription'] = 'البحث عن الحلفاء والانضمام إلى تحالف. إذا لم يكن لديك أي اتصالات حتى الآن، والتحقق من تحالفات اللاعبين بالقرب منك أو البحث عن تحالف في المنتدى.';
$Definition['Quest']['World_08']['questDescriptionReward'] = ' هيا إلى بداية رائعة . أقوى وأكثر نشاطا . هل اكتشفت كيفية الإبلاغ عن الهجمات على لاعبين التحالف وكيفية طلب المساعدة؟';
$Definition['Quest']['World_08']['rewardDescription'] = buildResourcesReward([295, 210, 235, 185]);
$Definition['Quest']['World_08']['todo'] = [0 => 'الإنضمام إلى تحالف',];
$Definition['Quest']['World_09']['questTitle'] = 'المبنى الرئيسي للمستوى 5';
$Definition['Quest']['World_09']['questDescription'] = 'حان الوقت لترقية المبنى الرئيسي، بحيث يمكنك بناء المباني الجديدة';
$Definition['Quest']['World_09']['questDescriptionReward'] = 'رائع! أليس كذلك ؟ الآن البناء الخاص بك أسرع. الحصول على المكافأة الخاصة بك وإعداد نفسك للمهمة المقبلة.';
$Definition['Quest']['World_09']['rewardDescription'] = buildResourcesReward([570, 470, 560, 265]);
$Definition['Quest']['World_09']['todo'] = [0 => ' ترقية المبنى الرئيسي إلى المستوى 5.',];
$Definition['Quest']['World_10']['questTitle'] = 'السكن او القصر';
$Definition['Quest']['World_10']['questDescription'] = ' من أجل إنشاء قرية جديدة قريبا , يجب عليك بناء السكن او القصر.';
$Definition['Quest']['World_10']['questDescriptionReward'] = 'هذا المبنى ضروري لبناء قرية جديدة أو احتلال قرية. كل ما ارتفع المبنى كلما زاد عدد القرى التي تستطيع إنشائها.';
$Definition['Quest']['World_10']['rewardDescription'] = buildResourcesReward([525, 420, 620, 335]);
$Definition['Quest']['World_10']['todo'] = [0 => 'بناء السكن او القصر',];
$Definition['Quest']['World_11']['questTitle'] = 'النقاط الحضارية';
$Definition['Quest']['World_11']['questDescription'] = 'من أجل السيطرة على المزيد من القرى في امبراطوريتك، تحتاج نقاط حضارية. نظرة عامة في السكن أو القصر يخبرك كم يلزمك من النقاط والوقت.';
$Definition['Quest']['World_11']['questDescriptionReward'] = 'في قائمة القرية يمكنك أيضا رؤية الوضع الحالي للقرى الجديدة المحتملة وكمية النقاط الحضارية المطلوبة. قم بزيارة \ "الإجابات \" لمعرفة كيفية زيادة النقاط الحضارية بسرعة.';
$Definition['Quest']['World_11']['rewardDescription'] = buildResourcesReward([650, 800, 740, 530]);
$Definition['Quest']['World_11']['todo'] = [0 => 'افتح علامة التبويب النقاط الحضارية في السكن أو القصر.',];
$Definition['Quest']['World_12']['questTitle'] = 'مستودع الخام 7 ';
$Definition['Quest']['World_12']['questDescription'] = 'ترقية المستودع الخاص بك لإعداد قريتك لإنشاء قرية جديدة. سعة التخزين الحالية الخاصة بك لن يكون كافيا قريبا لتحمل المباني والمستوطنين المطلوبة.';
$Definition['Quest']['World_12']['questDescriptionReward'] = 'جيد، سعة التخزين الخاصة بك يجب أن تكون كافيا لبعض الوقت الآن. تذكر أن تدافع عن مواردك القيمة أو تخفيها.';
$Definition['Quest']['World_12']['rewardDescription'] = buildResourcesReward([2650, 2150, 1810, 1320]);
$Definition['Quest']['World_12']['todo'] = [0 => 'ترقية مستودع الخام إلى مستوى 7.',];
$Definition['Quest']['World_13']['questTitle'] = 'التقارير المجاورة';
$Definition['Quest']['World_13']['questDescription'] = 'تقارير المناطق المجاورة تساعدك على البقاء على علم بالأحداث والتغيرات داخل منطقتكم.';
$Definition['Quest']['World_13']['questDescriptionReward'] = 'من تغييرات الاسم إلى النهب التي حدثت والهجمات، والكثير هو ممكن. آمل أن تستمتع بقراءة التقارير.';
$Definition['Quest']['World_13']['rewardDescription'] = buildResourcesReward([800, 700, 750, 600]);
$Definition['Quest']['World_13']['todo'] = [0 => 'افتح التقارير وقراءة تقارير القرى المجاورة.',];
$Definition['Quest']['World_14']['questTitle'] = 'السكن أو القصر 10 ';
$Definition['Quest']['World_14']['questDescription'] = 'يمكن تدريب المستوطنين في القصر أو السكن.';
$Definition['Quest']['World_14']['questDescriptionReward'] = 'من كل قرية يمكنك بناء فقط 2-3 قرى جديدة. المطلوب 3 مستوطنين او رئيس / حكيم / زعيم ونقاط حضارية جاهزة لكل قرية !.';
$Definition['Quest']['World_14']['rewardDescription'] =  Quest::calcEffect(500, 'cp', true) . ' نقطة حضارية ';
$Definition['Quest']['World_14']['todo'] = [0 => 'قم بترقية السكن أو القصر إلى مستوى 10. ',];
$Definition['Quest']['World_15']['questTitle'] = 'تدريب ثلاثة مستوطنين';
$Definition['Quest']['World_15']['questDescription'] = 'المستوطنون يسافرون دائما في مجموعة صغيرة عند تأسيس قرية جديدة.';
$Definition['Quest']['World_15']['questDescriptionReward'] = 'حماية المستوطنين الخاصين بك جيدا من الهجمات حتى يكونو على استعداد للذهاب لإنشاء قرية جديدة او توفر النقاط الحضارية !.';
$Definition['Quest']['World_15']['rewardDescription'] = buildResourcesReward([1050, 800, 900, 750]);
$Definition['Quest']['World_15']['todo'] = [0 => 'تدريب 3 مستوطنين في السكن / القصر.',];
$Definition['Quest']['World_16']['questTitle'] = 'إنشاء قرية جديدة';
$Definition['Quest']['World_16']['questDescription'] = 'ابحث في الخارطة عن مكان جيد للبناء. هل ترغب في أن تكون بالقرب من قريتك، وإنتاج أكثر من موارد معينة أو أن تكون بالقرب من العديد من الواحات القمحية ؟ .';
$Definition['Quest']['World_16']['questDescriptionReward'] = "عظيم، كنت لاعب من الاعبين الأقوى في عالم ترافيان. مواصلة اللعب وتتبع الكثير من القوات للدفاع عن القرية.";
$Definition['Quest']['World_16']['rewardDescription'] = Quest::calcEffect(172800, 'plus', true) . 'ترافيان بلس ';
$Definition['Quest']['World_16']['todo'] = [0 => 'إنشاء قرية جديدة',];
$Definition['Quest']['world_01_name'] = 'عرض الإحصائيات';
$Definition['Quest']['world_02_name'] = 'تغيير إسم القرية';
$Definition['Quest']['world_03_name'] = 'المبنى الرئيسي للمستوى 3 ';
$Definition['Quest']['world_04_name'] = 'بناء سفارة ';
$Definition['Quest']['world_05_name'] = 'فتح الخارطة';
$Definition['Quest']['world_06_name'] = 'قراءة الرسالة';
$Definition['Quest']['world_07_name'] = 'مكافأة الذهب';
$Definition['Quest']['world_08_name'] = 'تحالف';
$Definition['Quest']['world_09_name'] = 'المبنى الرئيسي للمستوى 5';
$Definition['Quest']['world_10_name'] = 'السكن او القصر';
$Definition['Quest']['world_11_name'] = 'النقاط الحضارية';
$Definition['Quest']['world_12_name'] = 'مستودع الخام للمستوى 7';
$Definition['Quest']['world_13_name'] = 'تقارير القرى المجاورة';
$Definition['Quest']['world_14_name'] = 'السكن او القصر للمستوى 10 ';
$Definition['Quest']['world_15_name'] = '3 مستوطنين';
$Definition['Quest']['world_16_name'] = 'قرية جديدة';
//
$Definition['RallyPoint']['greyAreaNewVillageCaution'] = 'Caution: If you settle a village at this coordinates, Natars will try to attack and keep you away from this area.<br />Villages in this area will not produce culture points.';
$Definition['RallyPoint']['Changed successfully: %s will be the new home village for hero'] = 'Changed successfully: %s will be the new home village for hero.';
$Definition['RallyPoint']['nowSettlersWillGoNeedsXResources'] = 'Now settlers will go to create a new village.<br />Creating new village needs %s of each resources (lumber, clay, iron, crop).';
$Definition['RallyPoint']['Settlers']['notEnoughResources'] = 'Not enough resources.';

$Definition['RallyPoint']['sendBack'] = 'إرجاع';
$Definition['RallyPoint']['reinforcement'] = 'مساندة';
$Definition['RallyPoint']['normal'] = 'هجوم كامل';
$Definition['RallyPoint']['raid'] = 'هجوم للنهب';
$Definition['RallyPoint']['attack'] = 'هجوم';
$Definition['RallyPoint']['Village'] = 'قرية';
$Definition['RallyPoint']['changeHeroHomeVillage'] = 'تغيير موطن البطل';
$Definition['RallyPoint']['or'] = 'او';
$Definition['RallyPoint']['number'] = 'عدد';
$Definition['RallyPoint']['withdraw'] = 'إنسحاب';
$Definition['RallyPoint']['reviving'] = 'تجديد';
$Definition['RallyPoint']['createNewVillage'] = 'إنشاء قرية جديدة';
$Definition['RallyPoint']['loyaltyReducedBy'] = 'خفض الولاء ';
$Definition['RallyPoint']['spy'] = 'تجسس';
$Definition['RallyPoint']['supply'] = 'مساندة';
$Definition['RallyPoint']['Errors']['activeVillageChanged'] = 'Active village was changed.';
$Definition['RallyPoint']['Errors']['EnterCoordinateOrDname'] = 'أدخل اسم أو احداثيات.';
$Definition['RallyPoint']['Errors']['noVillageWithThisName'] = 'القرية غير موجودة.';
$Definition['RallyPoint']['Errors']['noVillageInCoordinate'] = 'الإحداثيات غير موجودة.';
$Definition['RallyPoint']['Errors']['NatarCapitalError'] = 'الله يهديك وين رايح ! لا يمكنك مهاجمة عاصمة التتار';
$Definition['RallyPoint']['Errors']['noTroopsSelected'] = 'يجب حديد عدد القوات';
$Definition['RallyPoint']['Errors']['playerHasBeginnerProtection'] = 'هذا اللاعب في فترة الحماية.';
$Definition['RallyPoint']['Errors']['cantAttackUrSelf'] = 'القوات هي بالفعل في قريتك';
$Definition['RallyPoint']['Errors']['cantAttackDuringProtection'] = 'لا يمكنك الهجوم وانت في فترة الحماية.';
$Definition['RallyPoint']['Errors']['reallyAttackOwn?'] = 'هل أنت متأكد انك تريد مهاجمة نفسك !؟';
$Definition['RallyPoint']['Errors']['reallyAttackFriend?'] = 'هل أنت متأكد من أنك تريد مهاجمة صديق ؟';
$Definition['RallyPoint']['Errors']['protectionWillBeGone'] = 'سيتم إلغاء الحماية. هل أنت متأكد؟';
$Definition['RallyPoint']['Errors']['youCannotAttackArtifactWhileInProtection'] = 'You cannot attack a village with artifact while you are in protection.';
$Definition['RallyPoint']['Errors']['youAreBanned'] = 'أنت موقوف !';
$Definition['RallyPoint']['Errors']['playerBanned'] = 'هذا الحساب موقوف بسبب إنتهاك قواعد اللعبة';
$Definition['RallyPoint']['Errors']['cantSendReinforcementsDuringProtection'] = 'لا يمكنك مساندة أحد وانت في فترة الحماية.';
$Definition['RallyPoint']['Errors']['heroDeployError'] = 'يمكنك تغيير موطن بطلك , ولاكن يجب توفر نقطة تجمع في القرية الأخرى';
$Definition['RallyPoint']['Errors']['serverFinished'] = 'انتهى السيرفر';
$Definition['RallyPoint']['Errors']['playerIsInVacation'] = 'اللاعب في إجازة';
$Definition['RallyPoint']['Errors']['farmsAreProtectedTill'] = 'مزرعة محمية حتى %s.';
$Definition['RallyPoint']['reinforcementForVillageName'] = 'مساندة %s';
$Definition['RallyPoint']['send'] = 'إرسال';
$Definition['RallyPoint']['edit'] = 'تعديل';
$Definition['RallyPoint']['reinforcementForPlayerName'] = 'مساندة %s';
$Definition['RallyPoint']['imprisendInVillage'] = 'مأسور في %s';
$Definition['RallyPoint']['imprisendPlayer'] = 'مأسور %s';
$Definition['RallyPoint']['showAll'] = 'عرض الكل';
$Definition['RallyPoint']['no_incoming_troops_error'] = 'لا توجد قوات قادمة';
$Definition['RallyPoint']['no_outgoing_troops_error'] = 'لا توجد قوات مغادرة';
$Definition['RallyPoint']['no_outvillage_troops_error'] = 'لا توجد قوات في القرية';
$Definition['RallyPoint']['return'] = 'عودة';
$Definition['RallyPoint']['units'] = 'وحدات';
$Definition['RallyPoint']['ownTroops'] = 'الجيش';
$Definition['RallyPoint']['from'] = 'من';
$Definition['RallyPoint']['CrannyForest'] = 'غير معلوم';
$Definition['RallyPoint']['adventure'] = 'مغامرة';
$Definition['RallyPoint']['occupiedOasis'] = 'واحة محتلة';
$Definition['RallyPoint']['unoccupiedOasis'] = 'واحة غير محتلة';
$Definition['RallyPoint']['ArrivalIn'] = 'الوصول في';
$Definition['RallyPoint']['against'] = 'على';
$Definition['RallyPoint']['for'] = 'الى';
$Definition['RallyPoint']['of'] = '';
$Definition['RallyPoint']['catapultTargets'] = 'إستهداف';
//attack types
$Definition['RallyPoint']['inAttack'] = $Definition['RallyPoint']['outAttack'] = $Definition['RallyPoint']['inAttackOasis'] = 'كامل';
$Definition['RallyPoint']['inRaid'] = $Definition['RallyPoint']['outRaid'] = $Definition['RallyPoint']['inRaidOasis'] = 'نهب';
$Definition['RallyPoint']['inSupply'] = $Definition['RallyPoint']['outSupply'] = $Definition['RallyPoint']['inSupplyOasis'] = 'مساندة';
$Definition['RallyPoint']['outSettlers'] = 'بناء قرية جديدة';
$Definition['RallyPoint']['outSpy'] = 'تجسس';
$Definition['RallyPoint']['myOasis'] = 'My Oasis';
$Definition['RallyPoint']['outEscape'] = 'الهروب';
$Definition['RallyPoint']['filters'][1] = 'القوات القادمة';
$Definition['RallyPoint']['filters'][2] = 'القوات المغادرة';
$Definition['RallyPoint']['filters'][3] = 'القوات في هذه القرية وواحاتها';
$Definition['RallyPoint']['filters'][4] = 'القوات في قرى او واحات أخرى';
$Definition['RallyPoint']['SubFilters'][1] = 'النهب / الهجمات المغادرة';
$Definition['RallyPoint']['SubFilters'][2] = 'القوات القادمة';
$Definition['RallyPoint']['SubFilters'][3] = 'تأكيدد';
$Definition['RallyPoint']['SubFilters'][4] = 'النهب / الهجمات المغادرة';
$Definition['RallyPoint']['SubFilters'][5] = 'التعزيزات الخاصة';
$Definition['RallyPoint']['SubFilters'][6] = 'الكل';
$Definition['RallyPoint']['goldClubEvasionDesc'] = 'نادي الذهب , يتيح لك إخفاء القوات وتهريبها لخارج القرية عند حصول هجمات على القرية';
$Definition['RallyPoint']['evasion in capital'] = 'الهروب';
$Definition['RallyPoint']['goldclub'] = 'نادي الذهب';
$Definition['RallyPoint']['EvasionSettings'] = 'اعدادات الهروب';
$Definition['RallyPoint']['HeroShowDesc'] = ' سيبقى البطل دوماً مع القوات';
$Definition['RallyPoint']['HeroHideDesc'] = 'سيختفي البطل عند تعرضك لهجوم';
$Definition['RallyPoint']["EvasionDesc"] = 'وسوف تغادر القوات فى وقت الهجوم وتعود بعد 180 ثانية. ولن تهرب القوات إلا إذا لم تكن هناك قوات تعود إلى ديارها في غضون 10 ثوان قبل الهجوم، باستثناء القوات التي تعود من استخدام هذا الخيار. وهذه الميزة تمكين جميع القوات المدربة في القرية للهروب، ولكن القوات المعززة لن تهرب.';
$Definition['RallyPoint']['Management'] = 'إعدادات';
$Definition['RallyPoint']['overview'] = 'نظرة عامة';
$Definition['RallyPoint']['sendTroops'] = 'إرسال قوات';
$Definition['RallyPoint']['combatSimulator'] = 'محاكي المعركة';
$Definition['RallyPoint']['farmlist'] = 'قائمة المزارع';
$Definition['RallyPoint']['needClubToBeActive'] = 'لهذه الميزة تحتاج إلى نادي الذهب.';
$Definition['RallyPoint']['This tab is set as favourite'] = 'تم تعيين علامة التبويب هذه كمفضلة';
$Definition['RallyPoint']['Set tab x as favourite'] = 'تعيين علامة التبويب %s ك مفضلة';
$Definition['RallyPoint']['ArrivalIn'] = 'وصول في';
$Definition['RallyPoint']['kill'] = 'الوفيات';
$Definition['RallyPoint']['target'] = 'الهدف';
$Definition['RallyPoint']['player'] = 'اللاعب';
$Definition['RallyPoint']['catapult only attacks in normal type'] = ' المقاليع تعمل أثناء <b>الهجوم الكامل</b> فقط';
$Definition['RallyPoint']['troops'] = 'القوات';
$Definition['RallyPoint']['random'] = 'قصف عشوائي';
$Definition['RallyPoint']['willBeAttackedTarget'] = 'سيتم الهجوم بالمقاليع';
$Definition['RallyPoint']['options'] = 'خيارات';
$Definition['RallyPoint']['Consumption'] = 'الإستهلاك';
$Definition['RallyPoint']['withdraw'] = 'إنسحاب';
$Definition['RallyPoint']['TroopKillDesc'] = 'هل أنت متأكد من قتل قواتك ؟ لماذا لا تحررها ؟ !';
$Definition['RallyPoint']['back'] = 'عودة';
$Definition['RallyPoint']['free'] = 'حر';
$Definition['RallyPoint']['spyTarget'] = 'نوع التجسس';
$Definition['RallyPoint']['spyTargetTroopsBuildings'] = 'التحصينات والقوات';
$Definition['RallyPoint']['spyTargetTroopsResources'] = 'الموارد والقوات';
//
$Definition['reCaptcha']['title'] = 'معرف النظام';
$Definition['reCaptcha']['desc'] = ' نريد التحقق من أنك شخص ولست ريبوت يلعب اللعبة<br /><br />انقر على مربع الاختيار للتحقق من أنك لست روبوت.';
$Definition['reCaptcha']['Sorry you submitted wrong answer'] = 'الإجابة غير صحيحة';

$Definition['farmListLockHandle']['title'] = 'نظام الحماية';
$Definition['farmListLockHandle']['captcha'] = 'الكابتشا';
$Definition['farmListLockHandle']['submit'] = 'إستمرار';
$Definition['farmListLockHandle']['newCode'] = 'طلب إختبار جديد';
$Definition['farmListLockHandle']['desc'] = 'كنت تستخدم قائمة المزارع أكثر مما كان متوقعا في وقت قصير. لا يمكنك استخدام قائمة المزرعة في الوقت الحالي. يمكنك تحرير حسابك عن طريق إدخال النص أدناه في الإدخال.';
$Definition['farmListLockHandle']['Sorry you submitted wrong answer'] = 'عذراً , الرمز غير صحيح';

//
$Definition['Reports'] = ["reportTypes" => [1 => 'لقد فزت بالهجوم دون خسائر',
    0 => 'التقارير',
    2 => 'لقد فزت بالهجوم مع خسائر',
    3 => 'لم ينج أحد من جنودك',
    4 => 'لقد فزت بالدفاع دون خسائر',
    5 => 'لقد فزت بالدفاع مع خسائر',
    6 => 'تم إختراق القرية',
    7 => 'لقد فزت بالدفاع مع خسائر',
    8 => 'تعزيز',
    11 => 'نقل الخشب بشكل رئيسي',
    12 => 'نقل الطين بشكل رئيسي',
    13 => 'نقل الحديد بشكل رئيسي',
    14 => 'نقل القمح بشكل رئيسي',
    15 => 'لم يتم كشف تجسسك',
    16 => 'تم التجسس مع خسائر',
    17 => 'لم ينج أحد من كشافتك',
    18 => 'لم يستطع العدو كشف قريتك',
    19 => 'تم كشف قريتك',
    20 => 'أسر وحوش',
    21 => 'مغامرة',
    22 => 'قام المستوطنون ببناء قرية جديدة',
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
$Definition['Reports']['newVillageCreatedSuccussFully'] = 'تم إنشاء قرية جديدة بنجاح';
$Definition['Reports']['escapeNonCapitalErr'] = 'قواتك لا تهرب لأن الهروب متاح فقط في العاصمة.';
$Definition['Reports']['escapeTroopsComingErr'] = 'قواتك لا تهرب لأن هناك قوات عادت قبل هجوم الخصم بـ 10 ثانية.';
$Definition['Reports']['evasionNotEnabled'] = 'Troops didn`t escape because evasion is not enabled.';
$Definition['Reports']['escapeDisabledBecauseYourPopulationIsTooLow'] = 'Troops didn`t escape because your village population is too low.';
$Definition['Reports']['Overflowing reports will be deleted automatically, if they are older than %s hours'] = 'سيتم حذف التقارير الفائضة تلقائيا، إذا كانت أكبر %s ساعة';
$Definition['Reports']['Archive||For this feature you need the Gold club activated'] = 'الإرشيف | هذه الميزة تحتاج إلى تفعيل نادي الذهب';
$Definition['Reports']['Add to farm list||For this feature you need the Gold club activated'] = 'قائمة المزارع | هذه الميزة تحتاج إلى تفعيل نادي الذهب';
$Definition['Reports']['Mark as read'] = 'تحديد كـ مقروء';
$Definition['Reports']['Mark as unread'] = 'تحديد كـ غير مقروء';
$Definition['Reports']['Combat simulator'] = 'محاكى المعركة';
$Definition['Reports']['Repeat attack'] = 'تكرار الهجوم';
$Definition['Reports']['Tabs']['All'] = 'الكل';
$Definition['Reports']['Tabs']['Troops'] = 'القوات';
$Definition['Reports']['Tabs']['Trade'] = 'التجارة';
$Definition['Reports']['Tabs']['Miscellaneous'] = 'متنوع';
$Definition['Reports']['Tabs']['Archive'] = 'الإرشيف';
$Definition['Reports']['Tabs']['Surrounding'] = 'القرى المجاورة';
$Definition['Reports']['Tabs']['Attacks'] = 'الهجمات';
$Definition['Reports']['Tabs']['Defense'] = 'الدفاع';
$Definition['Reports']['Tabs']['Spy'] = 'التجسس';
$Definition['Reports']['Tabs']['Other'] = 'اخرى';
$Definition['Reports']['needClub'] = 'انت بحاجه لنادي الذهب لتفعيل هذه الميزة';
$Definition['Reports']['village totally destroyed'] = 'تم نسف القرية بالكامل';
$Definition['Reports']['adventureFailed'] = 'لم تنجح المغامرة !';
$Definition['Reports']['Silver'] = 'الفضة';
$Definition['Reports']['WWPlanCaptured'] = 'تم الإستيلاء على تحفة مخطط البناء !';
$Definition['Reports']['heroArtifactCapture'] = 'تم الإستيلاء على التحفة !';
$Definition['Reports']['x didnt damaged'] = '%s لم تتم إصابة';
$Definition['Reports']['TrapFreeAllianceAndMe'] = 'قمت بتحرير %s من قواتك %s من قوات التحالف والبقية فقدو أثناء تحريرهم !';
$Definition['Reports']['TrapFreeMe'] = 'لقد حررت %s من قواتك , والبقية فقدو أثناء تحريرهم';
$Definition['Reports']['TrapFreeAlliance'] = 'لقد حررت %s من قوات تحالفك , والبقية فقدو أثناء تحريرهم';
$Definition['Reports']['select all'] = 'تحديد الكل';
$Definition['Reports']['Unread'] = 'غير مقروء';
$Definition['Reports']['location'] = 'الموقع';
$Definition['Reports']['distance'] = 'المسافة';
$Definition['Reports']['Read'] = 'قراءة';
$Definition['Reports']['newer reports'] = 'تقارير احدث';
$Definition['Reports']['older reports'] = 'تقارير اقدم';
$Definition['Reports']['Really delete this report?'] = 'هل تريد حقا حذف هذا التقرير؟';
$Definition['Reports']['Delete report'] = 'حذف التقرير';
$Definition['Reports']['Delete'] = 'حذف';
$Definition['Reports']['Archive'] = 'الأرشيف';
$Definition['Reports']['Recover'] = 'إستعادة';
$Definition['Reports']['Access permissions'] = 'صلاحيات الوصول';
$Definition['Reports']['make opponent anonymous'] = 'إخفاء قوات الخصم';
$Definition['Reports']['make myself anonymous'] = 'إخفاء قواتي';
$Definition['Reports']['hide own troops'] = 'إخفاء قواتي الخاصة';
$Definition['Reports']['hide opposing troops'] = 'إخفاء قوات الخصم';
$Definition['Reports']['Description:'] = 'الوصف :';
$Definition['Reports']['VillageCaptured'] = 'سكان القرية %s قررو الإنضمام إلى إمبراطوريتك';
$Definition['Reports']['CantCaptureCapital'] = 'لا يمكن الإحتلال';
$Definition['Reports']['culturePointsErr'] = 'لا توجد نقاط حضارية كافية !';
$Definition['Reports']['rpExists'] = 'السكن أو القصر لم يتدمر بعد';
$Definition['Reports']['You can only have 1 ww village at a time'] = 'يمكنك إحتلال معجزة واحدة فقط في نفس الوقت';
$Definition['Reports']['You cannot capture your alliance members village'] = 'You cannot capture your alliance member`s village.';
$Definition['Reports']['randomTargetsWereChosen'] = 'Random targets were selected.';
$Definition['Reports']['defenderIsSupportedByTheFollowingArtifact'] = 'Defender is protected by the following artifact: %s';
$Definition['Reports']['NoFreeAttackerTreasurySpace'] = 'لا توجد خزنة أو ان الخزنة لم تكتمل بعد !';
$Definition['Reports']['maxArtifactReached'] = 'لا يمكنك خطف تحف أخرى لقد وصلت للحد المسموح به للتحف';
$Definition['Reports']['TreasuryExists'] = 'لم تتدمر الخزنة !';
$Definition['Reports']['From'] = 'من';
$Definition['Reports']['Village'] = 'قرية';
$Definition['Reports']['oasis'] = 'واحة';
$Definition['Reports']['Troops'] = 'القوات';
$Definition['Reports']['units'] = 'وحدات';
$Definition['Reports']['Trapped'] = 'مأسورين';
$Definition['Reports']['casualties'] = 'الخسائر';
$Definition['Reports']['from oasis'] = 'من الواحة';
$Definition['Reports']['you used x cages'] = 'لقد إستخدمت %s قفص.';
$Definition['Reports']['x attacks y'] = '%s يهجم على %s.';
$Definition['Reports']['x send resources to y'] = '%s إرسال الموارد إلى %s.';
$Definition['Reports']['Bounty'] = 'الموارد';
$Definition['Reports']['exp'] = 'خبرة';
$Definition['Reports']['noValuableThingFound'] = 'لم يتم العثور على شيء';
$Definition['Reports']['injury'] = 'الصحة';
$Definition['Reports']['unknown'] = 'غير معروف';
$Definition['Reports']['Sender'] = 'المرسل';
$Definition['Reports']['Recipient'] = 'المستلم';
$Definition['Reports']['supplies'] = 'اللوازم';
$Definition['Reports']['from alliance'] = 'من التحالف';
$Definition['Reports']['x supplies y'] = '%s اللوازم %s';
$Definition['Reports']['Consumption'] = 'إستهلاك';
$Definition['Reports']['reinforced'] = 'يعزز ';
$Definition['Reports']['x reinforced y'] = '%s يعزز %s';
$Definition['Reports']['perHR'] = 'في الساعة';
$Definition['Reports']['x destroyed'] = '%s تدمر ';
$Definition['Reports']['reduced lvl from x to y'] = '%s\'s خفض من مستوى %s إلى %s.';
$Definition['Reports']['x did not damaged'] = '%s لم تتم إصابة';
$Definition['Reports']['you troops in village x were attacked'] = 'القوات الخاصه بالقرية %s هجمت';
$Definition['Reports']['x is on adventure'] = '%s يستكشف %s.';
$Definition['Reports']['An Oasis was plundered'] = 'تم نهب الواحة';
$Definition['Reports']['x has conquered an oasis'] = '%s قد غزا الواحة';
$Definition['Reports']['An Oasis was abandoned'] = 'تم التخلي عن واحة.';
$Definition['Reports']['x has founded y'] = '%s قام بتأسيس %s.';
$Definition['Reports']['x has conquered y'] = '%s قام بغزو %s.';
$Definition['Reports']['x has lost y'] = '%s خسر %s.';
$Definition['Reports']['x renamed y to z'] = '%s أعاد تسمية %s الى %s.';
$Definition['Reports']['A fight took at village name of player name'] = 'حصلت معركة في %s من %s.';
$Definition['Reports']['noData'] = 'لا توجد أي تقارير';
$Definition['Reports']['Subject'] = 'الموضوع';
$Definition['Reports']['Sent'] = 'في';
//report types
$Definition['Reports']['AnimalsCaught'] = 'أسر وحوش';
$Definition['Reports']['x spies y'] = '%s يتجسس على %s.';
$Definition['Reports']['x founds a new village'] = '%s أسس قرية جديدة';
$Definition['Reports']['occupiedOasis'] = 'واحة محتلة';
$Definition['Reports']['unoccupiedOasis'] = 'واحة غير محتلة';
$Definition['Reports']['Attacker'] = 'هجوم';
$Definition['Reports']['Defender'] = 'دفاع';
$Definition['Reports']['Reinforcement'] = 'مساندة';
$Definition['Reports']['Information'] = 'معلومات';
$Definition['Reports']['Resources'] = 'الموارد';
$Definition['Reports']['None of your soldiers returned'] = 'لم ينجُ أحد من جنودك !';
$Definition['Reports']['None of your spies returned'] = 'لم ينجُ أحد من جواسيسك';
$Definition['Reports']['Ram does not work on alliance members'] = 'Ram does not work on alliance members.';
$Definition['Reports']['Cata is disabled'] = 'Catapult system is disabled.';
$Definition['Reports']['Cata does not work on alliance members'] = 'Catapult does not work on alliance members.';
$Definition['Reports']['NoFreeSlotsToCaptureOasis'] = 'ترقية قصر الأبطال للحصول على واحات أخرى';
$Definition['Reports']['OasisCaptured'] = 'قام البطل بإحتلال هذه الواحة !';
$Definition['Reports']['LoyaltyLowered'] = 'خفض الولاء من <b>%d</b> إلى <b>%d</b>';
$Definition['Reports']['Inbox - All reports older than seven days will be deleted'] = ' سيتم حذف جميع التقارير الأقدم من إسبوع , في صندوق الوارد للتقارير';

$Definition['Reports']['Management'] = 'نظرة عامة';
$Definition['Reports']['ManagementDesc'] = 'يمكنك إدارة تقاريرك هنا.';
$Definition['Reports']['ManagementOptions'] = [
    1 => 'فاز ك مهاجم بدون خسائر',
    2 => 'فاز ك مهاجم مع خسائر',
    3 => 'فقد جميع القوات',
    4 => 'فاز ك مدافع بدون خسائر',
    5 => 'فاز ك مدافع مع خسائر',
    6 => 'تم اختراق دفاع',
    7 => 'اختراق الدفاع',
    8 => 'تعزيز',
    9 => 'التجرة',
    10 => 'التجسس',
    11 => 'مغامرة',
    12 => 'كل التقارير',
];
$Definition['Reports']['startTime'] = [
    0 => 'بدء السيرفر',
    600 => '10 دقائق',
    1800 => '30 دقيقة',
    3600 => '1 ساعة',
    7200 => '2 ساعات',
    10800 => '3 ساعات',
    21600 => '6 ساعات',
    43200 => '12 ساعة',
    86400 => '1 يوم',
    172800 => '2 يوم',
    604800 => '7 يوم',
];
$Definition['Reports']['ManagementDeleteDesc'] = 'حذف التقارير من %s الى %s %s';
$Definition['Reports']['ButtonOK'] = 'موافق';
$Definition['Reports']['ReportsStatistics'] = 'احصائيات التقارير';
$Definition['Reports']['%s report(s) removed successfully'] = '%s تقارير تمت إزالتها بنجاح';
$Definition['Reports']['AllReportsCount'] = 'كل التقارير';
$Definition['Reports']['ReportsWithoutCasualties'] = 'تقارير الهجوم دون خسائر';
$Definition['Reports']['ReportsWithCasualties'] = 'تقارير الهجوم مع خسائر';
$Definition['Reports']['ReportsDefWithoutCasualties'] = 'تقارير الدفاع دون خسائر';
$Definition['Reports']['ReportsDefWithCasualties'] = 'تقارير الدفاع مع خسائر';
$Definition['Reports']['ReportsOtherReports'] = 'التقارير الأخرى';
//
$Definition['ResidencePalace']['Management'] = 'نظرة عامة';
$Definition['ResidencePalace']['Train'] = 'تدريب';
$Definition['ResidencePalace']['CulturePoints'] = 'النقاط الحضارية';
$Definition['ResidencePalace']['Loyalty'] = 'الولاء';
$Definition['ResidencePalace']['Expansion'] = 'التوسع';
$Definition['ResidencePalace']['This tab is set as favourite'] = 'تم تعيين علامة التبويب هذه كمفضلة';
$Definition['ResidencePalace']['Select x as favor tab'] = 'اختيار %s ك علامة تبويب مفضلة';
$Definition['ResidencePalace']['Controllable villages'] = 'القرى التي يمكن السيطرة عليها';
$Definition['ResidencePalace']['Number of your villages'] = 'عدد القرى';
$Definition['ResidencePalace']['Maximum controllable villages'] = 'الحد الاقصى للقرى التي يمكن السيطرة عليها';
$Definition['ResidencePalace']['Culture points per day'] = 'النقاط الحضارية في اليوم';
$Definition['ResidencePalace']['Culture points produced so far'] = 'النقاط الحضارية حتى الآن';
$Definition['ResidencePalace']['Next village controllable at'] = 'القرية المقبلة في';
$Definition['ResidencePalace']['Culture points still needed'] = 'انت بحاجة لنقاط حضارية إضافية';
$Definition['ResidencePalace']['Active village'] = 'القرية النشطة';
$Definition['ResidencePalace']['Other villages'] = 'القرى الأخرى';
$Definition['ResidencePalace']['Hero'] = 'البطل';
$Definition['ResidencePalace']['Total'] = 'المجموع';
$Definition['ResidencePalace']['loyaltyDesc'] = 'المجموع';
$Definition['ResidencePalace']['Coordinates'] = 'احداثيات';
$Definition['ResidencePalace']['noExpansion'] = 'لم يتم العثور على قرى';
$Definition['ResidencePalace']['ChangeCapital'] = 'جعل هذه القرية عاصمتك';
$Definition['ResidencePalace']['Cant set ww as capital'] = 'لا يمكنك إختيار قرية المعجزة كـ عاصمة';
$Definition['ResidencePalace']['Password'] = 'كلمة السر';
$Definition['ResidencePalace']['wrongPass'] = 'كلمة السر خاطئة';
$Definition['ResidencePalace']['ConfirmChangeCapital'] = 'هل أنت متأكد ؟';
$Definition['ResidencePalace']['This is your capital'] = 'هذه هي عاصمتك';
$Definition['ResidencePalace']['Date'] = 'التاريخ';
$Definition['ResidencePalace']['In order to found or conquer further villages, you require culture points An additional village will predictably be controllable on x (±5 minutes)'] = 'أنت بحاجة للنقاط الحضارية لإنشاء او إحتلال قرى جديدة , هذه الإحصائيات قد تكون عن ما مضى او تقدم 5 دقائق ';
$Definition['ResidencePalace']['The further the buildings of your villages are upgraded, the more culture points per day they will produce'] = 'النقاط الحضارية يتم إنتاجها عن طريق رفع مباني قريتك كلما إرتفع مستوى المبنى كلما زاد إنتاجه من النقاط الحضارية اليومية';
$Definition['ResidencePalace']['Loyalty in the current village'] = 'الولاء في القرية الحالية';
$Definition['ResidencePalace']['Loyalty overview'] = 'نظرة عامة على الولاء';
$Definition['ResidencePalace']['village'] = 'قرية';
$Definition['ResidencePalace']['Inhabitants'] = 'السكان';
$Definition['ResidencePalace']['Player(s)'] = 'اللاعب';
$Definition['ResidencePalace']['A palace or residence protect a village from being conquered If the seat of government has been destroyed, a village`s loyalty can be lowered by attacks with chieftains, chiefs and senators If the loyalty is lowered to zero, the village will join the attacker`s empire An ongoing great celebration in the village of either attacker or defender will increase or lower the rate at which each attacking administrator will lower the loyalty Each level of the seat of government increases the speed at which the loyalty of a village increases to 100% again A hero stationed in the village can use tablets of law to additionally increase loyalty'] = 'القصر او السكن , مركز القرية إذا تم هدمة من قبلك أو قبل الخصم سيستطيع تخفيض ولاء القرية في كل هجوم يقوم به وإحتلال القرية , ف حافظ على السكن والقصر لحماية قريتك وسكانها';
//
$Definition['Smithy']['Improve weapons and armour'] = 'تحسين الأسلحة والدروع';
$Definition['Smithy']['one_research_is_going'] = 'هناك بحث جاري';
$Definition['Smithy']['reachedMaxLvl'] = '%s تم التحسين بالكامل';
$Definition['Smithy']['improve'] = 'تحسين';
$Definition['Smithy']['Researching'] = 'البحث';
$Definition['Smithy']['unit'] = 'الوحدة';
$Definition['Smithy']['upgradeSmithy'] = 'يجب رفع مستوى أفران صهر الحديد';
//
$Definition['Statistics']['Prizes for top 10'] = 'Prizes for top 10';
$Definition['Statistics']['Bonus name'] = 'Bonus name';
$Definition['Statistics']['No prize is declared for top10'] = 'No prize is declared for top10.';
$Definition['Statistics']['top10 prize distribution desc'] = 'The prizes for top10 will be given to player after the top10 was reset.';


$Definition['Statistics']['Average number of troops per player'] = 'متوسط عدد القوات لكل لاعب';
$Definition['Statistics']['Game development'] = 'مطورون اللعبة';
$Definition['Statistics']['The following graphs show a time progression of economy, population, and the military strength of your army'] = 'الرسوم البيانية التالية تظهر تقدم الاقتصاد، والسكان، والقوة العسكرية للجيش الخاص بك.';
$Definition['Statistics']['Number of troops'] = 'عدد الجيش';
$Definition['Statistics']['titleInHeader'] = 'الإحصائيات';
$Definition['Statistics']['edit'] = 'تعديل';
$Definition['Statistics']['tabs'] = [];
$Definition['Statistics']['tabs']['players'] = 'اللاعب';
$Definition['Statistics']['tabs']['alliances'] = 'التحالفات';
$Definition['Statistics']['tabs']['villages'] = 'القرى';
$Definition['Statistics']['tabs']['hero'] = 'البطل';
$Definition['Statistics']['tabs']['plus'] = 'ترافيان بلاس';
$Definition['Statistics']['tabs']['General'] = 'عام';
$Definition['Statistics']['tabs']['WonderOfTheWorld'] = 'المعجزات';
//$Definition['Statistics']['tabs']['WonderOfTheWorld'] = 'معجزات العالم';
$Definition['Statistics']['tabs']['Bonus'] = 'حالة المكافأة';
$Definition['Statistics']['tabs']['farm'] = 'المزارع';
$Definition['Statistics']['Actions'] = 'المزايدات';
$Definition['Statistics']['subTabs'] = [];
$Definition['Statistics']['subTabs']['overview'] = 'نظرة عامة';
$Definition['Statistics']['subTabs']['attacker'] = 'المهاجم';
$Definition['Statistics']['subTabs']['defender'] = 'المدافع';
$Definition['Statistics']['subTabs']['Top 10'] = 'افضل 10';
$Definition['Statistics']['player'] = 'اللاعب';
$Definition['Statistics']['alliance'] = 'التحالف';
$Definition['Statistics']['rank'] = 'الرتبة';
$Definition['Statistics']['name'] = 'الإسم';
$Definition['Statistics']['largestPlayers'] = 'اللاعبون الكبار';
$Definition['Statistics']['largestAlliances'] = 'التحالفات الكبيرة';
$Definition['Statistics']['largestVillages'] = 'القرى الكبيرة';
$Definition['Statistics']['level'] = 'المستوى';
$Definition['Statistics']['xp'] = 'الخبرة';
$Definition['Statistics']['most exp heros'] = 'الأكثر خبرة الأبطال';
$Definition['Statistics']['alliance'] = 'التحالف';
$Definition['Statistics']['population'] = 'السكان';
$Definition['Statistics']['village'] = 'القرى';
$Definition['Statistics']['points'] = 'النقاط';
$Definition['Statistics']['coordinates'] = 'الإحداثيات';
$Definition['Statistics']['errors'] = [];
$Definition['Statistics']['errors']['userNotFound'] = 'اللاعب %s لم يتم العثور عليه';
$Definition['Statistics']['errors']['allianceNotFound'] = 'التحالف %s لم يتم العثور عليه';
$Definition['Statistics']['errors']['villageNotFound'] = 'القرية %s لم يتم العثور عليها';
$Definition['Statistics']['top10'] = [];
$Definition['Statistics']['top10']['attackers of the week'] = 'مهاجمون الإسبوع';
$Definition['Statistics']['top10']['defenders of the week'] = 'مدافعون الإسبوع';
$Definition['Statistics']['top10']['robbers of the week'] = 'ناهبون الإسبوع';
$Definition['Statistics']['top10']['climbers of the week'] = 'مطورون الإسبوع';
$Definition['Statistics']['top10']['resources'] = 'الموارد';
$Definition['Statistics']['top10']['ranks'] = 'الرتبة';
$Definition['Statistics']['top10']['pop'] = 'السكان';
$Definition['Statistics']['top10']['points'] = 'النقاط';
$Definition['Statistics']['top10']['No'] = 'رتبة';
$Definition['Statistics']['top10']['top off hammer'] = 'اعلى المهاجمون';
$Definition['Statistics']['top10']['top def hammer'] = 'اعلى المدافعون';
$Definition['Statistics']['top10']['date'] = 'التاريخ';
$Definition['Statistics']['General'] = [];
$Definition['Statistics']['General']['Country ranks'] = 'الرتبة حسب البلد';
$Definition['Statistics']['General']['Country name'] = 'الرتبة حسب الإسم';
$Definition['Statistics']['General']['Players'] = 'اللاعبون';
$Definition['Statistics']['General']['Points'] = 'النقاط';
$Definition['Statistics']['General']['CountryFlag'] = 'البلد';
$Definition['Statistics']['General']['Total country population'] = 'مجموع سكان البلد';
$Definition['Statistics']['General']['Tribe'] = 'القبيلة';
$Definition['Statistics']['General']['Tribes'] = 'القبائل';
$Definition['Statistics']['General']['Romans'] = 'الرومان';
$Definition['Statistics']['General']['Teutons'] = 'الجرمان';
$Definition['Statistics']['General']['Gauls'] = 'الإغريق';
$Definition['Statistics']['General']['Egyptians'] = 'Egyptians';
$Definition['Statistics']['General']['Huns'] = 'Huns';
$Definition['Statistics']['General']['Miscellaneous'] = 'متنوع';
$Definition['Statistics']['General']['Attacks'] = 'الهجمات';
$Definition['Statistics']['General']['Casualties'] = 'الخسائر';
$Definition['Statistics']['General']['Date'] = 'التاريخ';
$Definition['Statistics']['General']['Registered'] = 'مسجل';
$Definition['Statistics']['General']['Percent'] = '%';
$Definition['Statistics']['General']['Players'] = 'اللاعبون';
$Definition['Statistics']['General']['RegisteredPlayers'] = 'اللاعبون المسجلين';
$Definition['Statistics']['General']['ActivePlayers'] = 'اللاعبون النشطُون';
$Definition['Statistics']['General']['onlinePlayers'] = 'اللاعبون المتواجدين';
$Definition['Statistics']['General']['Attacks and casualties'] = 'الهجمات والخسائر';
$Definition['Statistics']['WonderOfTheWorld'] = [];
$Definition['Statistics']['WonderOfTheWorld']['player'] = 'اللاعب';
$Definition['Statistics']['WonderOfTheWorld']['name'] = 'الإسم';
$Definition['Statistics']['WonderOfTheWorld']['alliance'] = 'التحالف';
$Definition['Statistics']['WonderOfTheWorld']['level'] = 'المستوى';
$Definition['Statistics']['WonderOfTheWorld']['attackToWonder'] = '%s';
$Definition['Statistics']['Game development'] = 'مطورون اللعبة';
$Definition['Statistics']['The following graphs show a time progression of economy, population, and the military strength of your army'] = 'الرسوم البيانية التالية تظهر تقدم الاقتصاد، والسكان، والقوة العسكرية للجيش الخاص بك.';
$Definition['Statistics']['Number of troops'] = 'عدد القوات';
$Definition['Statistics']['total'] = 'المجموع';
$Definition['Statistics']['reinforcements'] = 'التعزيزات';
$Definition['Statistics']['Resource production and population'] = 'إنتاج الموارد والسكان';
$Definition['Statistics']['resources/4'] = 'الموارد / 4';
$Definition['Statistics']['Inhabitants'] = 'السكان';
$Definition['Statistics']['Rank'] = 'الرتبة';
$Definition['Statistics']['Number of troops killed'] = 'عدد الجنود الذين قتلوا';
$Definition['Statistics']['attack'] = 'الهجوم';
$Definition['Statistics']['Winner and top player bonuses'] = 'مكافآت الفائزين واللاعبون الكبار';
$Definition['Statistics']['Winner Player'] = 'اللاعب الفائر';
$Definition['Statistics']['Second Winner Player'] = 'المركز الثاني';
$Definition['Statistics']['Third Winner Player'] = 'المركز الثالث';
$Definition['Statistics']['Bonus rules'] = 'المكافأة';
$Definition['Statistics']['bonus_rules_array'] = [
    'فقط '.(100-Config::getProperty("gold", "voucherTaxPercent")).'% المتبقي من الذهب ',
    'يمكن استخدام شفرة القسيمة لاسترداد الشفرة على أي حساب مستخدم (بدون بريد إلكتروني).',
    'ما يتم شرائة فقط , سيتم حفظة كـ قسائم .',
    sprintf('جائزة التحالف %s افضل اللاعبين (بإستثناء الفائز) من عدد سكانهم فوق %s.', Config::getProperty("bonus", "bonusGoldTopAllianceCount"), Config::getProperty("bonus", "bonusGoldTopAllianceMinPop")),
    'لا يمكنك بيع القسائم',
    'رمز القسائم له مدة إنتهاء '.Config::getProperty("gold", "voucherExpireDays").' يوم.',
];
$Definition['Statistics']['Winner Alliance (Top 5)'] = 'الفائزون من التحالف (Top 5)';
$Definition['Statistics']['Top attacker'] = 'افضل المهاجمون';
$Definition['Statistics']['Top defender'] = 'افضل المدافعون';
$Definition['Statistics']['Top climber'] = 'افضل المطورون ';
$Definition['Statistics']['Server states'] = 'حالة السيرفر';
$Definition['Statistics']['Daily gold will be given in'] = 'سيتم إعطاء الذهب اليومي في';
$Definition['Statistics']['Daily quest will reset in'] = 'سيتم إعادة المهام اليومية في';
$Definition['Statistics']['Medals will be given in'] = 'سيتم تسليم الأوسمة في';
$Definition['Statistics']['Artifacts will be released in'] = 'ستظهر التحف في';
$Definition['Statistics']['WWPlans will be released in'] = 'سيتم فك الحماية عن المعجزات في';
$Definition['Statistics']['You can build WW in'] = 'سيبدأ بناء المعجزات في';
$Definition['Statistics']['Game will be finished in'] = 'سينتهي السيرفر في';
$Definition['Statistics']['hours'] = 'ساعات';
$Definition['Statistics']['Top Off hammer'] = 'اعلى مهاجم';
$Definition['Statistics']['Top Def hammer'] = 'اعلى مدافع';
$Definition['Statistics']['raid'] = 'نهب';
$Definition['Statistics']['Other prises'] = '';
//
$Definition['Treasury']['ArtifactIsDisabled'] = 'Artifact disabled.';
$Definition['Treasury']['This tab is set as favourite'] = 'تم تعيين علامة التبويب هذه ك مفضلة';
$Definition['Treasury']['Management'] = 'نظرة عامة';
$Definition['Treasury']['Artefacts in your area'] = 'تحف في الجوار';
$Definition['Treasury']['Small artefacts'] = 'التحف الصغيرة';
$Definition['Treasury']['Large artefacts'] = 'التحف الكبيرة';
$Definition['Treasury']['select tab x as favor tab'] = 'اختيار علامة التبويب هذه %s ك علامة تبويب مفضلة';
$Definition['Treasury']['Stored artefact'] = 'التحف المستولى عليها';
$Definition['Treasury']['Name'] = 'الإسم';
$Definition['Treasury']['Village'] = 'القرية';
$Definition['Treasury']['conquered'] = 'إستولى';
$Definition['Treasury']['Former owner'] = 'المالك السابق';
$Definition['Treasury']['you dont own any artefacts'] = 'انت لا تملك أي تحفة';
$Definition['Treasury']['Effect'] = 'التأثير';
$Definition['Treasury']['Village'] = 'قرية';
$Definition['Treasury']['Account'] = 'عضوية';
$Definition['Treasury']['Player'] = 'اللاعب';
$Definition['Treasury']['Area of effect'] = 'التأثير';
$Definition['Treasury']['Bonus'] = 'المكافأة';
$Definition['Treasury']['Required level'] = 'مستوى الخزنة';
$Definition['Treasury']['Time of conquer'] = 'إستولى';
$Definition['Treasury']['Active'] = 'فعالة';
$Definition['Treasury']['Time of activation'] = 'تتفعل في';
$Definition['Treasury']['Alliance'] = 'التحالف';
$Definition['Treasury']['Distance'] = 'المسافة';
$Definition['Treasury']['Owner'] = 'المالك';
$Definition['Treasury']['No Artefact'] = 'لم يتم تحرير التحف بعد.';
//
$Definition['Troops']['hero']['title'] = 'البطل';
$Definition['Troops'][1]['title'] = 'جندي أول';
$Definition['Troops'][1]['desc'] = 'الجندي الأول هو نوع من مشاة الامبراطوريه الرومانيه. حصل على التدريب في مجالات عديدة، وهو مفيد في الهجوم والدفاع أيضاً ولكنه في أحسن الحالات لن يصل لقوة الوحدات المتخصصة. ';
$Definition['Troops'][2]['title'] = 'حراس الإمبراطور';
$Definition['Troops'][2]['desc'] = 'حراس الإمبراطور كما هو واضح من اسمهم: هم حراسٌ متخصصون في حماية الإمبراطور والإمبراطورية ومستعدون لدفع حياتهم ثمناً لذلك. وبما أن حراس الإمبراطور مدربون على الدفاع فإن قوتهم الهجومية ضعيفة.';
$Definition['Troops'][3]['title'] = 'جندي مهاجم';
$Definition['Troops'][3]['desc'] = 'الجندي المهاجم هو المهاجم الأقوى في فيلق المشاة الروماني. سريع وقوي فهو يبث الرعب في قلب كل مدافع. 
هذه القوة لها ثمنها وهو التدريب الطويل و المكلف.';
$Definition['Troops'][4]['title'] = 'فرقة تجسس';
$Definition['Troops'][4]['desc'] = 'الجواسيس هم قوات الاستخبارات الرومانية، وهي ذات سرعة عالية وقدرة كبيرة على استطلاع تحصينات وموارد قرى الصخم.

<br><br>
في حال عدم امتلاك الخصم لقوات تجسسية في قراه، لن يعرف بزيارته له أبدًا.';
$Definition['Troops'][5]['title'] = 'سلاح الفرسان';
$Definition['Troops'][5]['desc'] = 'هذه هي الوحدة العادية لفرسان الرومان. وهي سريعة ولكنها مسلحه جيدا و مدرعة جيدا ، فهو إرهاب لجميع الأعداء غير المستعدين. بيد انه ينبغي ملاحظة أن أكل الحصان والفارس ليس رخيصا على الإطلاق!';
$Definition['Troops'][6]['title'] = 'فرسان قيصر';
$Definition['Troops'][6]['desc'] = 'هذا هو سلاح الفرسان المدرع. فهو مدرع ومسلح تسليحا جيدا ، لكنها أبطأ من سلاح الفرسان العادي ويمكنها حمل موارد أقل. صيانتها أيضا اكثر تكلفة الطاقة لها ثمن ضخم. أما قدراته الهجومية أو الدفاعية فهي جبارة';
$Definition['Troops'][7]['title'] = 'كبش';
$Definition['Troops'][7]['desc'] = 'محطمة الابواب هي سلاح يستخدم لدعم المشاة والفرسان. دورها هو تدمير جدار العدو وجعل المعركه اسهل للمهاجمين.';
$Definition['Troops'][8]['title'] = 'المقلاع الناري';
$Definition['Troops'][8]['desc'] = 'المقلاع الناري هو سلاح ممتاز للاستخدام عن بعد لتدمير المباني وحقول المواد الخام . ويكاد يكون دون دفاع ، فإنها تحتاج إلى مرافقة فعالة . كلما ازداد مستوى بناء نقطة التجمع ، و طاقم المقلاع افضل تدريبا - كلما ازداد التصويب.وعند المستوى 10 من نقطة التجمع ، يمكن استهداف كل بقعة في قرية العدو باستثناء المخبأ .
<br><br> <a href="' . getAnswersUrl() . '?view=answers&amp;action=answer&amp;aid=157#go2answer" target="blank">here</a>.
<br>
';
$Definition['Troops'][9]['title'] = 'حكيم';
$Definition['Troops'][9]['desc'] = 'الحكيم. وهو خطيب ماهر، يعرف كيف يقنع الناس في اتّباعه. وهو بذلك يستطيع اقناع حتى سكان القرى المعاديه للانضمام إلى بلدكم . 
في كل مرة يتكلم فيها الحكيم أمام سور قرية العدو، .
<br><br>
 ينخفض فيها ولاء سكان القرية حتى يقرروا في النهاية الانضمام لمملكتكم';
$Definition['Troops'][10]['title'] = 'مستوطن';
$Definition['Troops'][10]['desc'] = 'المستوطنون هم مواطنون شجعان من قريتك. ومدربون على انشاء قرىً جديدة .
.
<br><br>
لأن تأسيس قرية جديدة مهمة صعبة بصفة خاصة ،فانك تحتاج الى ثلاثة مستوطنين. وبالاضافة الى ذلك ، فانك تحتاج الى 750 وحدة من كل المواد الخام ';
$Definition['Troops'][11]['title'] = 'ابو هراوة';
$Definition['Troops'][11]['desc'] = 'مقاتل ابوهراوة هو ارخص وحده في جميع القبائل . يتم تدريبها بسرعة ، لذا فهو متواضع في الهجوم ، ودرعه ليس الاقوى. وهو لايتمكن من الصمود امام الفرسان .';
$Definition['Troops'][12]['title'] = 'ابو رمح';
$Definition['Troops'][12]['desc'] = 'مقاتل برمح هو سلاح ممتاز كمدافع نظرا لطول رمحه ، خصوصا انه يجيد الدفاع ضد الفرسان .
هو متواضع في الهجوم ،لأنه ليس قويا بصورة كافيه';
$Definition['Troops'][13]['title'] = 'ابو فأس';
$Definition['Troops'][13]['desc'] = 'هو أقوى المشاة الجرمان. قوي في الهجوم متواضع في الدفاع ، وهو أبطأ وأكثر كلفة من الوحدات الأخرى.';
$Definition['Troops'][14]['title'] = 'الكشاف';
$Definition['Troops'][14]['desc'] = 'الكشاف هو أحد وحدات الجرمان وعملها التجسس على العدو . تذهب مشيا على الأقدام ولكن ذلك ليس بسرعة فائقة. وبهدوء يستطلع التجسس على العدو ويتعرف على وحداته وكذلك المواد الخام و دفاعاته .
<br><br>
 . إذا لم يكن هناك كشافه في قرية العدو ، فان زيارته ستكون بهدوء';
$Definition['Troops'][15]['title'] = 'مقاتل القيصر';
$Definition['Troops'][15]['desc'] = 'لأن صاحب الدرع الثقيل ، مقاتل القيصر مدافع ممتاز.ففي معارك المشاة بالكاد يمكن لهم الاختراق .
ضعيف في الهجوم و سرعته متواضعة نسبيا .
<br><br>
.وضعيف بالنسبة لسلاح الفرسان نظرا لثقل لدرعه. تدريبه طويل ومكلف';
$Definition['Troops'][16]['title'] = 'فرسان الجرمان';
$Definition['Troops'][16]['desc'] = 'الفارس الجرماني هو الفارس المحارب الذي يجعل قوى اعدائه تنكمش في خوف. وهو ايضا مدافع ممتاز ضد فرسان العدو. ولكن التدريب وتكاليف الصيانة مرتفعة';
$Definition['Troops'][17]['title'] = 'محطمة الأبواب';
$Definition['Troops'][17]['desc'] = 'محطمة الأبواب هي سلاح يستخدم لدعم المشاة والفرسان. دورها هو تدمير جدار العدو وجعل المعركة أسهل للمهاجمين.';
$Definition['Troops'][18]['title'] = 'المقلاع';
$Definition['Troops'][18]['desc'] = 'المقلاع هو سلاح ممتازا للاستخدام عن بعد لتدمير المباني وحقول المواد الخام . ويكاد يكون دون دفاع ، فإنها تحتاج إلى مرافقة فعالة . .
كلما ازداد بناء نقطة التجمع مستوى . 
<br><br>
، و طاقم المقلاع افضل تدريبا - كلما ازداد التصويب.عند المستوى 10 من نقطة التجمع ، يمكن استهداف كل بقعة باستثناء المخبأ <a href="' . getAnswersUrl() . '?view=answers&amp;action=answer&amp;aid=157#go2answer" target="blank">here</a>.
<br>
إنتبة : تفعيل المقهى اثناء الهجوم بالمقاليع سيكون القصف عشوائي !';
$Definition['Troops'][19]['title'] = 'الزعيم';
$Definition['Troops'][19]['desc'] = 'الجرمان يختارون زعيم منهم. الزعيم لا يملك فقط استراتيجية وشجاعة ، وانما ايضا مهارات كخطيب. هذه المهارات تمكنه من اقناع سكان القرى الاخرى الى التخلي عن الولاءات السابقة .
<br><br>
في كل مرة يتكلم لسكان القرية امام اسوار المدينة ،كلما تقل موالات حاكم معادي حتى انضمام القرية إلى مملكتكم .';
$Definition['Troops'][20]['title'] = 'مستوطن';
$Definition['Troops'][20]['desc'] = 'المستوطنون هم مواطنون شجعان من قريتك ومدربون على انشاء قرىً جديدة .
لأن تأسيس قرية جديدة مهمة صعبة بصفة خاصة ،فانك تحتاج الى ثلاثة مستوطنين. .
<br><br>
 وبالاضافة الى ذلك ، فانك تحتاج الى 750 وحدة من كل المواد الخام';
$Definition['Troops'][21]['title'] = 'الكتيبة';
$Definition['Troops'][21]['desc'] = 'الكتيبة هي مجرد وحدة مشاة نسبيا رخيصة وسريعة الانتاج .
هجومه ضئيل  .
<br><br>
، لكنه في الدفاع يثبت قيمته ، كونه فعالا ضد المشاة وكذلك الفرسان';
$Definition['Troops'][22]['title'] = 'المبارز';
$Definition['Troops'][22]['desc'] = 'المبارز أغلى من الكتيبه ، وله قدرات هجومية جيدة .

<br><br>
لكنه في الدفاع ضعيف نسبيا ، ولا سيما ضد الفرسان .';
$Definition['Troops'][23]['title'] = 'المستكشف';
$Definition['Troops'][23]['desc'] = 'الكشاف هي الجواسيس للجيوش الإغريقية. فهي استثناءيه سريعة وقادرة على تحديد وحدات العدو سرا وكذلك الموارد او دفاعاته.

<br><br>
إذا لم يكن هناك ألكشافه في قرية العدو .فسيمر تجسسها بسلام وهدوء';
$Definition['Troops'][24]['title'] = 'الرعد';
$Definition['Troops'][24]['desc'] = 'الرعد هي وحدة هجوم قوي وسريعة وممتاز لتحمل المواد الخام .

<br><br>
لكنه في الدفاع متوسط في أحسن الأحوال.';
$Definition['Troops'][25]['title'] = 'فرسان السلت';
$Definition['Troops'][25]['desc'] = 'وحدة فرسان السلت مجهزة للدفاع. والغرض الرئيسي من فرسان السلت بالتأكيد الدفاع ضد المشاة. لكن تكاليف الصيانة باهظة الثمن نسبيا بالإضافة للبناء المكلف.';
$Definition['Troops'][26]['title'] = 'فرسان الليل';
$Definition['Troops'][26]['desc'] = 'فرسان الليل هي الأسلحة النهائية في الهجوم والدفاع ضد الفرسان. لا ينافسها احد في هذه المجالات .

<br><br>
فرسان الليل تدريبها ومعداتها مكلفه ، وخصوصا في وحدات من القمح 3 / ساعة ، اللاعب يجب دائما أن يسأل نفسه ما إذا كان مستعدا لقبول هذه التكاليف .';
$Definition['Troops'][27]['title'] = 'محطمة الأبواب الخشبية';
$Definition['Troops'][27]['desc'] = 'محطمة الأبواب الخشبية هي سلاح يستخدم لدعم المشاة والفرسان. دورها هو تدمير جدار العدو وجعل المعركة أسهل للمهاجمين.';
$Definition['Troops'][28]['title'] = 'المقلاع الحربي';
$Definition['Troops'][28]['desc'] = 'المقلاع هو سلاح ممتاز للاستخدام عن بعد لتدمير المباني وحقول المواد الخام . ويكاد يكون دون دفاع ، فإنها تحتاج إلى مرافقة فعالة . .


<br><br>
كلما ازداد بناء نقطة التجمع مستوى، و طاقم المقلاع افضل تدريبا - كلما ازداد التصويب.عند المستوى 10 من نقطة التجمع ، يمكن استهداف كل بقعة باستثناء المخبأ .  <a href="' . getAnswersUrl() . '?view=answers&amp;action=answer&amp;aid=157#go2answer" target="blank">here</a>.
<br>
';
$Definition['Troops'][29]['title'] = 'رئيس';
$Definition['Troops'][29]['desc'] = 'في كل قبيلة مقاتلون مسنون وذوو خبرة تستخدمهم لإقناع سكان القرى الأخرى بالانضمام إلى قبيلتها .

<br><br>
في كل مرة يتكلم في سكان قرية أمام أسوارها، تقل موالاة الحاكم حتى انضمام القرية إلى مملكتكم ';
$Definition['Troops'][30]['title'] = 'مستوطن';
$Definition['Troops'][30]['desc'] = 'المستوطنون هم مواطنون شجعان من قريتك ومدربون على إنشاء قرية جديدة .
لأن تأسيس قريةجديدة مهمة صعبة بصفة خاصة ،فانك تحتاج إلى ثلاثة مستوطنين .
<br><br>
. وبالإضافة إلى ذلك ، فانك تحتاج إلى 750 وحدة من كل المواد الخام';
$Definition['Troops'][31]['title'] = 'الجرذ';
$Definition['Troops'][32]['title'] = 'العنكبوت';
$Definition['Troops'][33]['title'] = 'الثعبان';
$Definition['Troops'][34]['title'] = 'الخفاش';
$Definition['Troops'][35]['title'] = 'الخزير البري';
$Definition['Troops'][36]['title'] = 'الذئب';
$Definition['Troops'][37]['title'] = 'الدب';
$Definition['Troops'][38]['title'] = 'التمساح';
$Definition['Troops'][39]['title'] = 'النمر';
$Definition['Troops'][40]['title'] = 'الفيل';
$Definition['Troops'][41]['title'] = 'جندي قاتل';
$Definition['Troops'][42]['title'] = 'محارب الشوك';
$Definition['Troops'][43]['title'] = 'حارس التتار';
$Definition['Troops'][44]['title'] = 'طائر التجسس';
$Definition['Troops'][45]['title'] = 'فارس الفؤوس';
$Definition['Troops'][46]['title'] = 'فارس التتار';
$Definition['Troops'][47]['title'] = 'فيل تحطيم الأبواب';
$Definition['Troops'][48]['title'] = 'مقلاع تتاري';
$Definition['Troops'][49]['title'] = 'إمبراطور تتاري';
$Definition['Troops'][50]['title'] = 'مستوطن تتاري';
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

$Definition['Troops'][98]['title'] = 'البطل';
$Definition['Troops'][99]['title'] = 'فخ';
//
$Definition['villageOverview']['villageOverview'] = 'نظرة عامة على القرية';
$Definition['villageOverview']['Overview'] = 'نظرة عامة';
$Definition['villageOverview']['Resources'] = 'الموارد';
$Definition['villageOverview']['Warehouse'] = 'المستودعات';
$Definition['villageOverview']['CulturePoints'] = 'النقاط الحضارية';
$Definition['villageOverview']['Troops'] = 'القوات';
$Definition['villageOverview']['Select x as favor tab'] = 'تحديد علامة التبويب هذه  %s ك مفضلة';
$Definition['villageOverview']['This tab is set as favourite'] = 'علامة التبويب هذه تم تعيينها ك مفضلة';
$Definition['villageOverview']['Village statistics||For this feature you need Travian Plus activated'] = 'إحصائيات القرية | لهذه الميزة انت بحاجة لترافيان بلاس';
$Definition['villageOverview']['Village'] = 'القرى';
$Definition['villageOverview']['Attacks'] = 'الهجمات';
$Definition['villageOverview']['Building'] = 'بناء';
$Definition['villageOverview']['Troops'] = 'القوات';
$Definition['villageOverview']['Merchants'] = 'التجار';
$Definition['villageOverview']['Own attacking troops'] = 'قواتي المهاجمة';
$Definition['villageOverview']['Oasis attacking troops'] = 'القوات المهاجمة للواحة';
$Definition['villageOverview']['Oasis reinforcing troops'] = 'القوات في الواحة';
$Definition['villageOverview']['Village reinforcing troops'] = 'القوات المعززة';
$Definition['villageOverview']['Other attacking troops'] = 'قوات مهاجمة قرى اخرى';
$Definition['villageOverview']['Own Reinforcing troops'] = 'القوات الخاصة';
$Definition['villageOverview']['Sum'] = 'المجموع';
$Definition['villageOverview']['duration'] = 'الوقت';
$Definition['villageOverview']['CPs/Day'] = 'نقطة/اليوم';
$Definition['villageOverview']['Celebrations'] = 'الإحتفالات';
$Definition['villageOverview']['Slots'] = 'المخارج';
$Definition['villageOverview']['Own Troops'] = 'القوات الخاصه';
$Definition['villageOverview']['Troops in villages'] = 'القوات في القرى !';
$Definition['villageOverview']['Upkeep'] = 'صيانة';
$Definition['villageOverview']['Armory'] = 'الجيش';
$Definition['villageOverview']['inResearch'] = 'بحث';
$Definition['villageOverview']['research_level'] = 'مستوى البحث';
$Definition['villageOverview']['per hour'] = 'في الساعه';
//
$Definition['demolishNowPopup']['Redeem'] = 'إنهي';
$Definition['demolishNowPopup']['desc'] = 'هل تريد بالتأكيد هدم هذا المبنى تماما؟ سيتم إزالة هذا المبنى من قريتك.';
//
$Definition['finishNowPopup']['title'] = 'البناء الكامل على الفور';
$Definition['finishNowPopup']['desc'] = 'سيتم الانتهاء من الأوامر التالية على الفور';
$Definition['finishNowPopup']['Redeem'] = 'إستخدام';
$Definition['finishNowPopup']['buildingOrders'] = 'المباني';
$Definition['finishNowPopup']['academy'] = 'البحث' . '(الأكاديمية)';
$Definition['finishNowPopup']['smithy'] = 'التحسين' . '(افران صهر الحديد)';
$Definition['finishNowPopup']['demolishBuildingLevel'] = 'هدم مستوى البناء';
$Definition['finishNowPopup']['level'] = 'المستوى';
$Definition['finishNowPopup']['No construction orders or research that could be completed instantly'] = 'لا أوامر البناء أو البحوث التي يمكن أن تكتمل على الفور.';
//
$Definition['goldClubPopup']['title'] = 'نادي الذهب';
$Definition['goldClubPopup']['gold'] = 'الذهب';
$Definition['goldClubPopup']['Bonus duration'] = 'وقت المكافأة';
$Definition['goldClubPopup']['whole game round'] = 'كامل الجولة';
$Definition['goldClubPopup']['Additionally, you will have access to the following features:'] = 'بالإضافة إلى ذلك، سيكون لديك الوصول إلى الميزات التالية:';
$Definition['goldClubPopup']['In order to use this feature, you need to activate the Gold club!'] = 'من أجل استخدام هذه الميزة، تحتاج إلى تفعيل نادي الذهب!';
$Definition['goldClubPopup']['troopEscape'] = [
    'title' => 'تهريب القوات',
    'text' => 'ويمكن أن تأمر القوات الخاصة في عاصمتك بالهروب تلقائيا من القرية قبل الهجمات عبر نقطة التجمع.',
];
$Definition['goldClubPopup']['raidList'] = [
    'title' => 'قائمة المزارع',
    'text' => 'في نقطة تجمع، يمكنك استخدام قائمة المزرعة لإدارة الهجمات على ألمزارع.',
];
$Definition['goldClubPopup']['tradeThreeTimes'] = [
    'title' => 'يمكن للتجار الذهاب 3 مرات',
    'text' => 'يمكن للتجار تنفيذ شحنات الموارد تلقائيا تصل إلى ثلاث مرات على التوالي.',
];
$Definition['goldClubPopup']['tradeThreeTimes'] = [
    'title' => 'المخطط التجاري',
    'text' => 'يمكنك إعداد شحنات الموارد في الوقت المناسب والمنتظمة بين القرى الخاصة بك.',
];
$Definition['goldClubPopup']['cropFinder'] = [
    'title' => 'مستكشف الحقول (9 و 15) على الخريطة',
    'text' => 'وظيفة البحث المتكاملة على الخريطة يسمح لك لإيجاد قمحيات مع زيادة إنتاج القمح والواحات والمكافأة.',
];
$Definition['goldClubPopup']['messageArchive'] = [
    'title' => 'الإرشيف',
    'text' => 'يمكن أرشفة الرسائل والتقارير الهامة وسهولة الوصول إليها لاحقا.',
];
$Definition['goldClubPopup']['furtherInfos'] = 'سيتيح <B>نادي الذهب</b> تشغيل هذه الميزات اضغط على "i" لمعلومات أخرى ..';
//
$Definition['overlay'] = ['defaultTitle' => 'أهلاً بك في واجهة المستخدم الجديدة من ترافيان',
    'defaultDescription' => 'حرّك مؤشر الفأرة على العناصر المعلَّمة في واجهة المستخدم لتعرف المزيد من المعلومات حولها.
',
    'closeLink' => 'إغلاق فقرة المساعدة ومتابعة اللعب.',
    'mainPageTitle' => 'الرئيسية',
    'mainPageDescription' => 'The <span class=\"important\">ترافيان<\/span> ينقلك إلى الصفحة الرئيسية لترافيان',
    'villageSwitchTitle' => 'التبديل لقرية اخرى',
    'villageSwitchDescription' => 'التبديل بين حقول الموارد خارج قريتك ومركز القرية التي تحتوي على كل ما تبذلونه من المباني الأخرى. انقر على حقل مورد أو بناء أو فتحة فارغة لفتحها. هنا يمكنك إما الترقية أو استخدامها.',
    'mainNavigationTitle' => 'لعبه خاصة نظرة عامة',
    'mainNavigationDescription' => '<span class=\"important\">خريطة العالم :<\/span> تظهر الخريطة المناطق المحيطة بقرتك. هنا يمكنك أن ترى الأهداف والتهديدات المحتملة.<br \/><span class=\"important\">الاحصائيات<\/span> البيانات المحددة من جميع اللاعبين والتحالفات داخل اللعبة.<br \/><span class=\"important\">التقارير<\/span> تقارير عن أحداث مثل المعارك، والحرف والمغامرات. <br \/><span class=\"important\">الرسائل<\/span> صفقات الإضراب أو وضع خطط مباشرة مع لاعبين آخرين.',
    'premiumFeaturesTitle' => 'شراء واستخدام الذهب',
    'premiumFeaturesDescription' => 'شراء <span class="important">الذهب</span> هنا أن يكون الوصول إلى الميزات الحصرية وترقيات واجهة.<br \/><span class=\"important\">Silver<\/span> يستخدم في مزادات البطل ويمكن تبادلها للذهب في دار المزاد.',
    'outOfGameTitle' => 'نظرة عامة',
    'outOfGameDescription' => 'تلميحات مفيدة<br /><span class="important">الملف الشخصي :</span> تعديل ملفك الشخصي <br /><span class="important">Settings:</span> تفضيلات وإعدادات فنية.<br /><span class="important">المنتدى</span> الذهاب مباشرة إلى المنتدى الرسمي.<br /><span class="important">IRC:</span>دردشة الدعم التي يمكنك أن تجد المساعدة.<br /><span class="important">الاجوبة : </span> صفحات المساعدة ترافيان.<br /><span class="important">Logout:</span> سجل الخروج من حسابك.',
    'villageResourcesTitle' => 'موارد القرية المختارة',
    'villageResourcesDescription' => 'يعرض حجم المستودع والمخزونات الحالية من الأخشاب والموارد والطين والحديد.<br \/>والنقرة على الأسهم عرض لمحة عامة عن كيفية حساب الإنتاج الحالي من مورد.',
    'villageCropTitle' => 'قمح القرية المختارة',
    'villageCropDescription' => 'يعرض حجم المخزونات ومخزونات المحاصيل الحالية. ويحتاج المحصول الحر إلى صيانة المباني الجديدة أو المحسنة. في اللعبة، انقر على الأزرار ذات الصلة لمعرفة المزيد من المعلومات التفصيلية.',
    'sidebarBoxHeroTitle' => 'البطل الخاص بك',
    'sidebarBoxHeroDescription' => 'البطل الخاص بك وبعض البيانات الهامة حول هذا الموضوع.<br \/>انقر على الصورة لتغيير السمات أو تجهيز العناصر.<br \/>الزر الأول يؤدي إلى مغامرات المتاحة. يمكنك إرسال البطل الخاص بك في طريقها مباشرة من هناك. الزر الآخر يؤدي إلى منزل المزاد، حيث يمكنك بيع العناصر التي تم جمعها أو شراء بعض من لاعبين آخرين.',
    'sidebarBoxAllianceTitle' => 'تحالفك',
    'sidebarBoxAllianceDescription' => 'في تحالف، يمكن للاعبين التعاون بشكل أفضل مع بعضها البعض وتقديم كل الدعم الآخر. من أجل سلامتك الخاصة يجب عليك البحث بسرعة عن الحلفاء. عندما كنت عضوا في تحالف، وأزرار تؤدي إلى الملف الشخصي التحالف ومنتدى التحالف.',
    'sidebarBoxInfoboxTitle' => 'مربع المعلومات',
    'sidebarBoxInfoboxDescription' => 'هنا يمكنك أن تجد رسائل النظام الهامة.',
    'sidebarBoxLinklistTitle' => 'قائمة الروابط',
    'sidebarBoxLinklistDescription' => 'من أجل استخدام قائمة الروابط، تحتاج أتيرغاتيس بلوس.<br \/> يمكن إنشاء روابط مباشرة إلى أهداف مهمة أو المباني وكذلك وصلات خارجية. الزر يسمح لك لتحرير القائمة.',
    'sidebarBoxActiveVillageTitle' => 'القرية',
    'sidebarBoxActiveVillageDescription' => 'اسم القرية المختارة وولاء مواطنيها إلى حكمكم.<br \/>في الجزء العلوي، يمكن للمستخدمين بلوس العثور على 4 وصلات مباشرة إلى السوق والمباني القوات. زر تحرير يسمح لك بتغيير اسم القرية.',
    'sidebarBoxVillagelistTitle' => 'قائمة كل قراكم',
    'sidebarBoxVillagelistDescription' => ' يمكنك أن ترى كيف العديد من القرى التي تملك حاليا وكم كنت يمكن أن يكون حاليا. أدناه، يمكنك أن ترى التقدم نقطة الثقافة اللازمة للقرية القادمة. الأزرار تسمح لك أن ننظر إلى بعض صفحات نظرة عامة أخرى وعرض إحداثيات القرية.',
    'sidebarBoxQuestmasterTitle' => 'المستشار',
    'sidebarBoxQuestmasterDescription' => 'انقر على مدير المهام لعرض أو إخفاء مهامه لك. وسوف تتيح لك معرفة ما إذا كان هناك أي أخبار. أدناه يمكنك العثور على لمحة عامة عن المهام الحالية.',
];
//
$Definition['plusPopup'] = ['title' => 'ترافيان بلس',
    'subHeadLine' => 'من أجل استخدام هذه الميزة، تحتاج إلى تفعيل ترافيان بلس.',
    'plusPopupButtonExtraFeatures' => 'بالإضافة إلى ذلك، سيكون لديك الوصول إلى الميزات التالية:',
    'Bonus duration in days:' => 'مدة المكافأة بالأيام:',
    "features" => [
        'attackWarning' => [
            'title' => 'تحذير الهجمات',
            'text' => 'سيتم عرض الهجمات الواردة في قائمة القرية.',
        ], 'buildingQueue' => [
            'title' => 'مبنى إضافي',
            'text' => 'تستطيع إضافة أمرين بناء في نفس الوقت بدلاً من أمر واحد',
        ], 'directLinks' => [
            'title' => 'روابط مباشرة',
            'text' => 'تستطيع إضافة روابط مباشرة , مثل أفضل التحالفات , افضل 10 لاعبين , خيارات القرية , التحالف , وأمور اخرى',
        ], 'linkList' => [
            'title' => 'قائمة الروابط',
            'text' => 'يسمح للروابط التي يمكن تحديدها بحرية، والتي تسمح لك للوصول إلى كل صفحة في اللعبة بنقرة واحدة بسيطة ..',
        ], 'villageStatistics' => [
            'title' => 'احصائيات القرية',
            'text' => 'إحصائيات القرية تظهر لك اعداد الجيش في العضوية والمستودعات والقوات المغادرة والقادمة وأمور أخرى',
        ], 'fullScreen' => [
            'title' => 'خارطة كبيرة',
            'text' => 'أحصل على خارطة أكبر لرؤية نطاق أكثر من المنطقة ',
        ], 'tradeMulti' => [
            'title' => 'تشغيل التجار X2',
            'text' => 'تشغيل التجار X2 بدلاً من x1 تلقائياً',
        ],
    ],
    'furtherInfos' => 'ترافيان بلوس تمكن الميزات المذكورة أعلاه لـ %s أيام ويمكن تمديدها في أي وقت. إذا قمت بتحديد الإضافة التلقائية لهذه الميزة، سيتم تمديدها قبل يوم واحد من نفادها وسيتم أيضا خصم الذهب ثم. لمزيد من المعلومات، انقر فوق  "i".',
];
//
$Definition['productionBoostPopup']['+25%‎ lumber production'] = '+25% إنتاج الخشب';
$Definition['productionBoostPopup']['+25%‎ clay production'] = '+25% إنتاج الطين';
$Definition['productionBoostPopup']['+25%‎ iron production'] = '+25% إنتاج الحديد';
$Definition['productionBoostPopup']['+25%‎ crop production'] = '+25% إنتاج القمح';
$Definition['productionBoostPopup']['Production bonus'] = 'مكافآت الإنتاج';
$Definition['productionBoostPopup']['Select which resources production you would like to increase:'] = 'رجاء اختر أي الموارد تريد زيادة انتاجها:';
$Definition['productionBoostPopup']['Bonus duration in days:'] = 'المدة بالأيام:';
$Definition['productionBoostPopup']['furtherInfos'] = 'تزيد علاوة الإنتاج من إنتاج المورد  المحدد في جميع قراكم  25%% ل %s ايام. إذا قمت بتحديد الإضافة التلقائية، سيتم إعادة تنشيط المكافأة الإنتاجية تلقائيا بمجرد نفادها.';

$Definition['Support'] = [
    'Support' => 'الدعم',
    'description' => 'يمكنك استخدام النموذج التالي لإرسال طلبك إلى الدعم. يرجى تخصيص بعض الوقت للإجابة عن الأسئلة النموذجية بأكبر قدر ممكن من التفاصيل، حتى نتمكن من الرد على طلبك بسرعة . يرجى ملاحظة أنه بدون عنوان بريد إلكتروني صالح، لن تتم معالجة طلبك.',
    'Game errors, login errors and game rules related questions' => 'أخطاء اللعبة، وأخطاء تسجيل الدخول وقواعد اللعبة الأسئلة ذات الصلة',
    'Game world' => 'سيرفر اللعبة',
    'please select' => 'يرجى الإختيار',
    'I don´t know' => 'لا اعلم',
    'Username' => 'الإسم',
    'Email' => 'الإيميل',
    'Category' => 'الفئة',
    'Message' => 'الرسالة',
    'General questions' => 'سؤال عام',
    'I cannot log in' => 'لا أستطيع تسجيل الدخول',
    'I cannot register an account' => 'لا أستطيع تسجيل حساب',
    'send request' => 'إرسل طلب',
    'Captcha' => 'التحقق',
    'errors' => [
        'يرجى الإختيار',
        'This field is necessary' => 'هذا الحقل ضروري.',
        'Entry is too short' => 'النص قصير جداً',
        'Invalid email address' => 'الإيميل خطأ',
        'Wrong captcha' => 'التحقق خاطئ',
    ],
    'done' => 'سنحاول مساعدتك في أقرب وقت ممكن. يرجى التحلي بالصبر - سوف تتلقى إجابة خلال 24 ساعة.',
];

$Definition['inGameSupport'] = [
    'Support' => 'الدعم',
    'description' => 'باستخدام نظام المساعدة لدينا، صفحة الإجابات، يمكنك بسهولة العثور على إجابات لجميع الأسئلة العامة حول ترافيان بسرعة ودون البحث لفترة طويلة. بالإضافة إلى ذلك، لديك إمكانية الاتصال بالدعم. يمكن أن يستغرق دعمنا تصل إلى 24 ساعة للرد على سؤالك. للحصول على إجابة أسرع، جرب الإجابات.',
    'Game errors, login errors and game rules related questions' => 'أخطاء اللعبة، وأخطاء تسجيل الدخول وقواعد اللعبة الأسئلة ذات الصلة',
    'Category' => 'الفئة',
    'Message' => 'الرسالة',
    'general questions' => 'سؤال عام',
    'report an error' => 'ابلاغ عن خطأ',
    'send request' => 'ارسال طلب',
    'please select' => 'يرجى الاختيار',
    'Game support' => 'دعم اللعبة',
    'Violation of the rules' => 'إنتهاك قواعد اللعبة',
    'Plus support' => 'دعم بلس',
    'Back to the village' => 'العودة للقرية',
    'Captcha' => 'التحقق',
    'errors' => [
        'please select',
        'This field is necessary' => 'هذا الحقل ضروري.',
        'Entry is too short' => 'النص قصير جداً',
        'Wrong captcha' => 'التحقق خاطئ',
    ],
    'done' => 'سنحاول مساعدتك في أقرب وقت ممكن. يرجى التحلي بالصبر - سوف تتلقى إجابة خلال 24 ساعة.',
];
$Definition['LinkList']['Vouchers (GoldBank)'] = 'قسائم';
$Definition['LinkList']['Farmlist'] = 'قائمة المزارع';
$Definition['LinkList']['Farms'] = 'المزارع';
$Definition['LinkList']['Go to admin panel'] = 'الذهاب لـ لوحة تحكم الإدمن';
$Definition['LinkList']['Contact Support'] = 'اتصل بالدعم';

$Definition['Email']['serverStartEmailSubject'] = 'يبدأ السيرفر الجديد قريبا';
$Definition['Email']['serverStartEmail'] = '
<div style="font-size: 14px;">
عزيزي [PLAYERNAME], <br /> السيرفر  <b><u>[SERVER_NAME]</b></u> سوف يبدأ قريباً ! !
<br />
<p style="color: red; font-weight: bold; font-size: 16px; text-align: center;">سيتم بدء تشغيل الخادم في <u>[SERVER_START_TIME]</u>.</p>
<br />
هذه الرسالة الإلكترونية لإعلامك بأن خادم اللعبة <b><u>[SERVER_NAME]</u></b> <b>سيبدأ قريباً </b>لا تفوت الفرصة ! كن أول من يسجل على هذا العالم !
<br />
<p style="color: green; font-weight: bold; font-size: 16px; text-align: center;">
أنقر على الرابط او قم بنسخة ووضعة في المتصفح للتسجيل ! <a href="[SERVER_URL]">[SERVER_URL]</a>
</p>
</div>';
$Definition['redeemCode'] = [
    'Redeem' => 'إستخدام',
    'EnterYourCodeTo' => 'إذا كان لديك قسيمة شراء , قم بإدخال الرمز في الحقل ',
    'Redeem code' => 'إضافة الرمز :',
    'Purchased code' => 'الرمز',
    'invalidCode' => 'الرمز غير صحيح',
    'codeIsUsed' => 'تم إستخدام الرمز من قبل',
    'redeemSuccess' => 'يرجى الإنتظار سيتم إضافة الذهب خلال لحظات',
    'tooManyTries' => 'لقد ادخلت رموز كثيرة يرجى المحاولة في وقت لاحق , او مراسلة الدعم',
    'unknownError' => 'خطأ غير معروف',
];
$Definition['Voting'] = [
    'description' => 'يمكنك التصويت هنا في هذه المواقع المدرجة أدناه والحصول على %s من الذهب مجاناً',
    'Next vote in %s hours' => 'التصويت التالي في %s ساعة.',
    'Vote at TopG' => 'التصويت على موقع توب جي',
    'Vote at Arena Top 100' => 'التصويت على توب 100',
    'Vote at GTop100' => 'التصويت على موقع توب جي',
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
return $Definition;