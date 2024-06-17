<?php
use Core\Config;
use Model\DailyQuestModel;
use Model\Quest;
global $Definition;

$Definition['403Error']['You cannot pass!'] = 'شما نمی توانید عبور کنید!';
$Definition['403Error']['I am a servant of the Secret Order, wielder of the flame of 403, You cannot pass'] = 'من محافظ درگاه 403 هستم. شما نمی توانید عبور کنید.';
//Academy
$Definition['Academy'] = ["zoomIn" => "بزرگنمایی",
    "Researches for village %s" => "تحقیقات برای دهکده %s",
    "noResearchAvailableDesc" => "در حال حاضر هیچ نیروی جدیدی برای تحقیق نمیباشد. برای اینکه پیش نیازهای تحقیق نیروها را مطالعه کنید روی کتاب سیاه رنگ موجود در پایین صفحه (سمت راست) کلیک کنید.",
    "showMore" => "جزئیات بیشتر",
    "hideMore" => "جزئیات کمتر",
    "Researching" => "در حال توسعه", "unit" => "نیرو",
    "research" => "تحقیق",
    "one_research_is_going" => "در حال حاضر تحقیقی در حال انجام است.",
];
$Definition['ActivationNew'] = [
    'unableToGenerateBase' => 'قادر به پیدا کردن دهکده برای بنای امپراتوری شما نبودیم. لطفا بعدا امتحان کنید یا با پشتیبانی تماس بگیرید.',
    'vidSelectDescription' => 'امپراتوری‌های عظیم با تصمیم‌گیری‌های مهم آغاز می‌شود! آیا مهاجمی هستید که عاشق رقابت است؟ یا سرمایه‌گذاری زمانی شما نسبتاً پایین است؟ آیا یک بازیکن تیمی هستید که دوست دارد اقتصاد پررونقی به‌راه اندازد؟',
    'sectorSelectDescription' => 'دوست دارید کجا امپراتوری‌تان را بنا کنید؟ برای ایده‌آل‌ترین محل از قسمت «پیشنهادی» استفاده کنید. یا محلی که دوستانتان در آنجا حضور دارند را انتخاب نمایید و تیمی تشکیل دهید!',
    'recommendedForNewPlayers' => 'توصیه شده برای بازیکنان تازه کار',
    'Select your starting position' => 'نقطه شروع‌تان را انتخاب کنید',
    'Select your tribe' => 'قومتان را انتخاب کنید',
    'Confirm' => 'تایید',
    'back' => 'بازگشت',
    'New' => 'جدید',
    'RECOMMENDED' => 'پیشنهادی',
    'Ready to rule the world?' => 'آماده حکم‌فرمایی بر جهان هستید؟',
    'PLAY NOW' => 'هم اکنون بازی کنید',
    'North - West' => 'شمال - غرب',
    'North - East' => 'شمال - شرق',
    'South - West' => 'جنوب - غرب',
    'South - East' => 'جنوب - شرق',
    'selectionComplete' => 'انتخاب شما تکمیل است. تنها یک کلیک تا پذیرش این چالش باقی مانده است! ',
    "race1_attributes" => [
        0 => 'مدیریت پیش نیازهای زمانی نیروها',
        1 => 'می‌تواند توسعه روستاها را به سریعترین شکل انجام دهد',
        2 => 'نیروهای بسیار قدرتمند، اما گران‌قیمت',
        3 => 'برای بازیکنان تازه‌کار بازی با آن سخت است',
    ], 'race2_attributes' => [
        0 => 'زمان تربیت: زیاد',
        1 => 'مهارت در غارت در اوایل بازی',
        2 => 'پیاده نظام قدرتمند و ارزان',
        3 => 'برای بازیکنان هجومی',
    ], "race3_attributes" => [
        0 => 'زمان تربیت: کم',
        1 => 'حفاظت در برابر غارتگری و دفاع خوب',
        2 => 'سواره نظام فوق‌العاده و سریع',
        3 => 'مناسب برای بازیکنان تازه‌کار',
    ], "race6_attributes" => [
        0 => 'زمان تربیت: کم',
        1 => 'منابع بیشتری موجود است',
        2 => 'واحدهای دفاعی عالی',
        3 => 'مناسب برای بازیکنان تازه‌کار',
    ], "race7_attributes" => [
        0 => 'زمان تربیت: زیاد',
        1 => 'سواره نظام بسیار قدرتمند',
        2 => 'متکی به دیگران برای حفاظت',
        3 => 'برای بازیکنان تازه‌کار توصیه نمی‌شود!',
    ],
];
//Activation
$Definition['activation'] = [
    'unableToGenerateBase' => 'قادر به پیدا کردن دهکده برای بنای امپراتوری شما نبودیم. لطفا بعدا امتحان کنید یا با پشتیبانی تماس بگیرید.',
    "selectASector" => "موقعیت شروع انتخاب کنید.",
    "sector_nw" => "شما در شمال-غربی شروع خواهید کرد.",
    "sector_ne" => "شما در شمال-شرقی شروع خواهید کرد.",
    "sector_sw" => "شما در جنوب-غربی شروع خواهید کرد.",
    "sector_se" => "شما در جنوب-شرقی شروع خواهید کرد.",
    "race_helpers" => [
        1 => "کوینتوس", 2 => 'هنریک', 3 => ' امبیوریکس',
    ],
    "selectedRace" => "شما نژاد %s را انتخاب کردید. بعد از این  به بعد %s راهنمای شما خواهد بود.",
    "changeVid" => "تغییر نژاد",
    "submitSector" => "انتخاب مکان شروع",
    "sectorDescription" => 'دهکده‌ی خود را اینجا بسازید و یا محل انتخابی را با کلیک روی نقشه عوض کنید.',
    "selectARace" => "یک نژاد انتخاب کنید.",
    "submitKind" => "انتخاب یک نژاد",
    "attributes" => "خصوصیات",
    "thanksForActivation" => 'از اینکه اکانت خود را فعال کردید متشکریم.',
    "pleaseChooseATribe" => 'نژاد خود را برای این جهان (سرور) انتخاب کنید.',
    "vidDescription" => 'اگر به تازگی با TRAVIAN آشنا شده‌اید ما توصیه می‌کنیم گول‌ها را انتخاب کنید.',
    "race1_attributes" => [
        0 => 'زمان نیاز باید مدیریت شده باشد.',
        1 => 'می‌توانند سریع‌تر از بقیه دهکده‌ی خود را وسعت دهند.',
        2 => 'لشکریان قدرتمند ولی گرانبهایی دارند؛ پیاده نظام‌های <br />بسیار قدرتمندی دارند.',
        3 => 'با این نژاد مراحل ابتدایی بازی بسیار سخت می‌باشد و برای <br />بازیکن‌های جدید این نژاد توصیه نمی‌شود.',
    ], 'race2_attributes' => [
        0 => 'زمان کافی برای بازیکن‌های مهاجم وجود دارد.',
        1 => 'لشکریان ارزان آن را می‌توان سریع تربیت کرد و برای<br> غارت خوب هستند.',
        2 => 'برای بازیکن‌های مهاجم و با تجربه.',
    ], "race3_attributes" => [
        0 => 'زمان کمی نیاز می‌باشد.',
        1 => 'از همان ابتدای بازی در مقابل غارت‌ها دفاع بهتری دارند.',
        2 => 'سواره نظام‌های عالی و سریع‌ترین نیروها را در بازی دارند.',
        3 => 'برای بازیکن‌های تازه وارد بهترین انتخاب می‌باشد.',
    ],
];
//Alliance
$Definition['Alliance']['In order to quit alliance you need an embassy'] = 'برای خروج از اتحاد شما نیاز به سفارت دارید.';
$Definition['Alliance']['Kicking/inviting is not allowed at this time'] = 'اخراج و دعوت بازیکن به اتحاد مجاز نمی باشد.';
$Definition['Alliance']['in vacation'] = 'درحالت تعطیلات';
$Definition['Alliance']['Enter tag'] = 'تگ را وارد کنید.';
$Definition['Alliance']['Enter name'] = 'نام را وارد کنید.';
$Definition['Alliance']['Tag too long'] = 'تگ طولانی است.';
$Definition['Alliance']['Name too long'] = 'نام طولانی است.';
$Definition['Alliance']['Category'] = 'ردیف';
$Definition['Alliance']['week'] = 'هفته';
$Definition['Alliance']['bbcode'] = 'کد BB';
$Definition['Alliance']['Medals'] = 'مدال ها';
$Definition['Alliance']['BB codes'] = 'کدهای BB';
$Definition['Alliance']['News'] = 'اخبار';
$Definition['Alliance']['Number'] = 'تعداد';
$Definition['Alliance']['losses'] = 'تلفات';
$Definition['Alliance']['strength'] = 'قدرت';
$Definition['Alliance']['Title'] = 'عنوان';
$Definition['Alliance']['URL'] = 'آدرس';
$Definition['Alliance']['Hint'] = 'راهنمایی';
$Definition['Alliance']['Tip'] = 'نکته';
$Definition['Alliance']['confederacy with x'] = 'اتحاد با %s';
$Definition['Alliance']['NAP with x'] = 'صلح با %s';
$Definition['Alliance']['war with x'] = 'اعلان جنگ به %s';
$Definition['Alliance']['accept'] = 'پذیرش';
$Definition['Alliance']['Select'] = 'انتخاب';
$Definition['Alliance']['Confirm'] = 'تایید';
$Definition['Alliance']['wrongPassword'] = 'رمز عبور اشتباه است.';
$Definition['Alliance']['In order to kick the player you have to enter your password again for security reasons'] = 'به دلایل امنیتی برای اخراج بازیکن شما اول نیاز به وارد کردن رمز عبور خود دارید.';
$Definition['Alliance']['Password'] = 'رمز عبور';
$Definition['Alliance']['Cant kick player'] = 'قادر به اخراج بازیکن نمی باشید.';
$Definition['Alliance']['InvitesAreClosed'] = 'عضو گیری اتحاد ها بسته شده است.';
$Definition['Alliance']['There is already an offer'] = 'درحال حاظر یک پیشنهاد موجود است.';
$Definition['Alliance']['Alliance x does not exists'] = 'اتحاد %s وجود ندارد.';
$Definition['Alliance']['offer a confederacy'] = 'پیشنهاد اتحاد';
$Definition['Alliance']['offer a NAP'] = 'پیشنهاد آتش بس';
$Definition['Alliance']['declare war'] = 'اعلان جنگ';
$Definition['Alliance']['Own offers'] = 'پیشنهادات ما';
$Definition['Alliance']['Foreign offers'] = 'پیشنهادات خارجی';
$Definition['Alliance']['Send'] = 'ارسال';
$Definition['Alliance']['DiplomacyShowText'] = '<div class="text">اگر می خواهید ارتباط های اتحاد بصورت اتوماتیک برای شما نمایش
داده شود، در قسمت توضیحات <span class="e">[diplomatie]
</span> را تایپ کنید؛ <span class="e">[ally]</span>، <span class="e">[nap]</span> و <span class="e">[war]</span> نیز
موجود است.</div>';
$Definition['Alliance']['DiplomacyHint'] = 'از لحاظ سیاسی و دیپلماتیک بهتر است قبل از ارسال تقاضای آتش بس (NAP) و یا متحد شدن، با اتحاد مورد نظر بحث و گفتگو کنید.';
$Definition['Alliance']['Existing relationships'] = 'روابط موجود';
$Definition['Alliance']['The player x does`t exists'] = 'بازیکن %s وجود ندارد.';
$Definition['Alliance']['none'] = 'هیچ';
$Definition['Alliance']['draw back'] = 'لغو';
$Definition['Alliance']['invite sent to x'] = 'دعوت نامه برای %s ارسال شد.';
$Definition['Alliance']['invitation for x'] = 'دعوت نامه برای %s';
$Definition['Alliance']['test has already received an invitation'] = 'برای %s قبلا دعوت نامه ارسال شده است.';
$Definition['Alliance']['Invitations'] = 'دعوت نامه ها';
$Definition['Alliance']['invite'] = 'دعوت';
$Definition['Alliance']['toTheForum'] = 'به فروم';
$Definition['Alliance']['you just left your alliance'] = 'شما تازه اتحاد خود را ترک کرده اید.';
$Definition['Alliance']['In order to quit the alliance you have to enter your password gain for safety reasons'] = 'به دلایل امنیتی برای خروج از اتحاد باید رمز عبور خود را وارد کنید.';
$Definition['Alliance']['x has been kicked from the alliance'] = '%s از اتحاد اخراج شد.';
$Definition['Alliance']['If your alliance wants to use an external forum, you can enter the URL here'] = 'اگر اتحاد شما میخواهد از یک فروم خارجی استفاده کند، آدرس آن را اینجا وارد کنید.';
$Definition['Alliance']['choose player'] = 'بازیکن';
$Definition['Alliance']['Manage flags and markers in map'] = 'مدیریت نشانه ها و علامت های نقشه';
$Definition['Alliance']['Manage forums'] = 'مدیریت فروم';
$Definition['Alliance']['IGMs to every alliance member'] = 'ارسال پیام کلی به اعضای اتحاد';
$Definition['Alliance']['You can set up different permissions for each alliance member and assign positions'] = 'شما برای هر عضو اتحاد میتوانید دسترسی های جدایی تنظیم کنید.';
$Definition['Alliance']['fighting points'] = 'امتیاز حمله';
$Definition['Alliance']['Tag exists'] = 'این تگ موجود است.';
$Definition['Alliance']['Changes saved'] = 'تغییرات ذخیره شد.';
$Definition['Alliance']['Date'] = 'تاریخ';
$Definition['Alliance']['Don´t show attacks of own alliance (under 100 units, no losses)'] = 'حملات اتحاد های خودی را نشان نده.(زیر 100 نیرو، بدون تلفات)';
$Definition['Alliance']['noReports'] = 'گزارشی یافت نشد.';
$Definition['Alliance']['online now'] = 'آنلاین';
$Definition['Alliance']['active players'] = 'فعال حداکثر 10 دقیقه پیش';
$Definition['Alliance']['active 3days'] = 'فعال حداکثر 3 روز پیش';
$Definition['Alliance']['active 7days'] = 'فعال حداکثر 7 روز پیش';
$Definition['Alliance']['inactive'] = 'غیر فعال';
$Definition['Alliance']['Rank'] = 'رتبه';
$Definition['Alliance']['Points'] = 'امتیاز ها';
$Definition['Alliance']['Change name'] = 'تغییر نام';
$Definition['Alliance']['Change alliance description'] = 'تغییر توضیحات اتحاد';
$Definition['Alliance']['Edit internal info page'] = 'ویرایش صفحه داخلی اتحاد';
$Definition['Alliance']['Assign to position'] = 'اعطای مقام';
$Definition['Alliance']['Link to the forum'] = 'لینک به فروم';
$Definition['Alliance']['Settings'] = 'تنظیمات';
$Definition['Alliance']['Actions'] = 'فعالیت ها';
$Definition['Alliance']['Invite a player into the alliance'] = 'دعوت یک بازیکن به اتحاد';
$Definition['Alliance']['Alliance diplomacy'] = 'سیاست اتحاد';
$Definition['Alliance']['Quit alliance'] = 'خروج از اتحاد';
$Definition['Alliance']['Kick player'] = 'اخراج بازیکن';
$Definition['Alliance']['Population'] = 'جمعیت';
$Definition['Alliance']['Details'] = 'مشخصات';
$Definition['Alliance']['Members'] = 'اعضا';
$Definition['Alliance']['Position'] = 'درجات';
$Definition['Alliance']['no thread created'] = 'هیچ تایپکی ایجاد نشده است.';
$Definition['Alliance']['This survey ends on x'] = 'این نظرسنجی در تاریخ %s تمام می شود.';
$Definition['Alliance']['voting finished'] = 'زمان نظرسنجی به پایان رسیده است.';
$Definition['Alliance']['move topic'] = 'انتقال تایپک';
$Definition['Alliance']['edit topic'] = 'ویرایش تایپک';
$Definition['Alliance']['x times edited, last edit by y'] = '%sx ویرایش شده، آخرین ویرایش توسط %s در %s.';
$Definition['Alliance']['Player ID'] = 'شناسه‌ی کاربری';
$Definition['Alliance']['user_list_headline'] = 'فروم را برای این بازیکنان باز کن';
$Definition['Alliance']['answer(s)'] = 'پاسخ ها';
$Definition['Alliance']['Last post'] = 'آخرین پست';
$Definition['Alliance']['Posts:'] = 'پست ها';
$Definition['Alliance']['pop'] = 'جمعیت';
$Definition['Alliance']['Villages'] = 'دهکده ها';
$Definition['Alliance']['post reply'] = 'پاسخ';
$Definition['Alliance']['created'] = 'ایجاد شده';
$Definition['Alliance']['author'] = 'نویسنده';
$Definition['Alliance']['messages'] = 'پیام ها';
$Definition['Alliance']['reply'] = 'پاسخ';
$Definition['Alliance']['vote'] = 'نظرسنجی';
$Definition['Alliance']['to result'] = 'به نتایج';
$Definition['Alliance']['to survey'] = 'به نظر سنجی';
$Definition['Alliance']['name'] = 'نام';
$Definition['Alliance']['addLine'] = 'اضافه کردن';
$Definition['Alliance']['New Thread'] = 'تایپک جدید';
$Definition['Alliance']['Post new thread'] = 'اضافه کردن تایپک جدید';
$Definition['Alliance']['Thread'] = 'تایپک';
$Definition['Alliance']['Report'] = 'گزارش';
$Definition['Alliance']['Coordinates'] = 'مختصات';
$Definition['Alliance']['report'] = 'گزارش';
$Definition['Alliance']['Troops'] = 'لشکریان';
$Definition['Alliance']['Vote_options'] = 'انتخاب ها';
$Definition['Alliance']['Survey'] = 'نظرسنجی';
$Definition['Alliance']['ends on'] = 'اتمام در';
$Definition['Alliance']['open_topic'] = 'بازکردن تاپیک';
$Definition['Alliance']['close_topic'] = 'بستن تاپیک';
$Definition['Alliance']['stick_topic'] = 'مهم کردن تایپک';
$Definition['Alliance']['unstick_topic'] = 'غیر مهم کردن تایپک';
$Definition['Alliance']['preview'] = 'پیش نمایش';
$Definition['Alliance']['underline'] = 'مختصات';
$Definition['Alliance']['Player'] = 'بازیکن';
$Definition['Alliance']['Alliance ID'] = 'شناسه اتحاد';
$Definition['Alliance']['ally_list_headline'] = 'برای اتحاد های دیگری باز کن:';
$Definition['Alliance']['sitters_allowed'] = 'جازه‌ی اینکار به جانشین‌ها داده شده است';
$Definition['Alliance']['open forum for the following alliances'] = 'فروم را برای اتحاد های زیر بازکن';
$Definition['Alliance']['edit forum'] = 'ویرایش فروم';
$Definition['Alliance']['create_in_area'] = 'ایجاد در این قسمت';
$Definition['Alliance']['public_forum'] = 'فروم عمومی';
$Definition['Alliance']['forum_name'] = 'اسم فروم';
$Definition['Alliance']['new_forum'] = 'فروم جدید';
$Definition['Alliance']['desc'] = 'توضیحات';
$Definition['Alliance']['alliance_forum'] = 'فروم اتحاد';
$Definition['Alliance']['conf_forum'] = 'فروم متحدین';
$Definition['Alliance']['closed_forum'] = 'فروم بسته';
$Definition['Alliance']['Tag'] = 'تگ';
$Definition['Alliance']['Forum name'] = 'نام فروم';
$Definition['Alliance']['Threads'] = 'تاپیک ها';
$Definition['Alliance']['Last post'] = 'آخرین پست';
$Definition['Alliance']['to the top'] = 'به بالا';
$Definition['Alliance']['to the bottom'] = 'به پایین';
$Definition['Alliance']['Delete'] = 'حذف';
$Definition['Alliance']['Confirm deletion?'] = 'حذف را تایید می کنید؟';
$Definition['Alliance']['show last post'] = 'نمایش آخرین پست';
$Definition['Alliance']['edit'] = 'ویرایش';
$Definition['Alliance']['thread without new entries'] = 'فروم بدون ورودی جدید';
$Definition['Alliance']['thread with new entries'] = 'فروم با ورودی جدید';
$Definition['Alliance']['noForum'] = 'هیچ فرومی ساخته نشده است.';
$Definition['Alliance']['switch admin'] = 'به حالت مدیریت برو';
$Definition['Alliance']['switch non admin'] = 'به حالت عادی برو';
$Definition['Alliance']['set x as favor tab'] = 'انتخاب %s به عنوان تب مورد علاقه.';
$Definition['Alliance']['This tab is set as favourite'] = 'این تب به عنوان تب مورد علاقه انتخاب شده است.';
$Definition['Alliance']['Overview'] = 'دیدکلی';
$Definition['Alliance']['NewForum'] = 'فروم جدید';
$Definition['Alliance']['Attacks'] = 'حملات';
$Definition['Alliance']['Bonuses'] = 'جایزه اضافه';
$Definition['Alliance']['Forum'] = 'فروم';
$Definition['Alliance']['Options'] = 'تنظیمات';
$Definition['Alliance']['Profile'] = 'پروفایل';
$Definition['Alliance']['Alliance'] = 'اتحاد';
$Definition['Alliance']['no Alliance'] = 'بدون اتحاد';
$Definition['Alliance']['You are currently not in an alliance In order to join an alliance, you need a level 1 Embassy and an invitation'] = 'در حال حاظر شما در اتحادی نیستید. برای عضویت در اتحاد نیاز به یک سفارت سطح 1 و یک دعوت نامه دارید.';
//
//$Definition['Artefacts']['numbers'] = array(1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X');
$Definition['Artefacts']['numbers'] = [
    1 => '', 2 => '', 3 => '', 4 => '', 5 => '', 6 => '', 7 => '', 8 => '',
    9 => '', 10 => '',
];
$Definition['Artefacts'][2] = [
    'names' => [
        1 => 'کتیبه راز هاي معماري کوچک %s',
        2 => 'کتیبه راز هاي معماري بزرگ %s',
        3 => 'کتیبه راز های معماری منحصربفرد',
    ],
    'desc' => 'این کتیبه دهکده شما را دربرابر منجنیق و دژکوب با ضریب %s مقاوم می کند.',
];
$Definition['Artefacts'][4] = [
    'names' => [
        1 => ' چکمه خدايان کوچک %s', 2 => ' چکمه خدايان بزرگ %s',
        3 => ' چکمه خدايان منحصربفرد',
    ],
    'desc' => 'اين كتيبه سرعت حركت سرباز هاي شما را با ضریب %s افزایش می دهد.',
];
$Definition['Artefacts'][5] = [
    'names' => [
        1 => 'چشمان عقاب کوچک %s', 2 => 'چشمان عقاب بزرگ %s',
        3 => 'چشمان عقاب منحصربفرد',
    ],
    'desc' => 'این کتیبه تاثیر تمام جاسوس های خودی در این دهکده و دهکده های دیگر را با ضریب %s افزایش می دهد.',
];
$Definition['Artefacts'][6] = [
    'names' => [
        1 => 'کتیبه مرتاض ها %s', 2 => 'کتیبه مرتاض ها %s',
        3 => 'کتیبه مرتاض ها منحصربفرد',
    ],
    'desc' => 'این کتیبه مصرف گندم لشکریان دهکده شما را با ضریب %s کاهش می دهد.',
];
$Definition['Artefacts'][8] = [
    'names' => [
        1 => 'جنگ آموز کوچک %s', 2 => 'جنگ آموز بزرگ %s',
        3 => 'جنگ آموز منحصربفرد',
    ],
    'desc' => 'این کتیبه سرعت تربیت در قصر ، اقامتگاه ، سربازخانه، اصطبل و کارگاه را با ضریب %s افزایش می دهد.',
];
$Definition['Artefacts'][9] = [
    'names' => [
        1 => 'کتیبه انبار برتر کوچک %s', 2 => 'کتیبه انبار برتر بزرگ %s',
    ],
    'desc' => 'این کتیبه به شما امکان ساخت انبار بزرگ و انبار غذای بزرگ را می دهد. توجه داشته باشید که ارتقای ساختمان تنها با داشتن این کتیبه امکان پذیر است.',
];
$Definition['Artefacts'][10] = [
    'names' => [
        1 => 'کتیبه گیج کننده %s', 2 => 'کتیبه گیج کننده بزرگ %s',
        3 => 'کتیبه گیج کننده منحصربفرد',
    ],
    "desc" => "این کت" . "یبه ظرفیت مخفیگاه های شما را با ضریب %s افزایش می دهد.<br> این کتیبه باعت می شود منجنیق ها تنها به هدف گیری تصادفی باشند البته این مورد در مورد شگفتی جهان کار نمی کند.",
];
$Definition['Artefacts'][11] = [
    'names' => [1 => 'کتیبه احمق ها', 3 => 'کتیبه احمق ها منحصر به فرد',],
    //no desc for this one.
];
$Definition['Artefacts'][12] = [
    'name' => 'نقشه ساخت شگفتی جهان',
    'desc' => 'با استفاده از این نقشه قادر به ساخت شگفتی جهان در دهکده های شگفتی جهان هستید. برای ارتقای شگفتی جهان نیاز است یک نقشه ساخت دیگر نزد یکی از هم اتحادی ها یا متحدین شما باشد.',
    //no desc for this one.
];
//Auction
$Definition['Auction']['notEnoughGold'] = 'طلا کافی نیست.';
$Definition['Auction']['autoCorrect'] = 'مقادیر بصورت اتوماتیک تنظیم شد.';
$Definition['Auction']['disabledSubmitTooltip'] = 'مقدار طلا وارد نشده است.';
$Definition['Auction']['disabledSubmitTooltip2'] = 'حداقل 200 نقره لازم میباشد';
$Definition['Auction']['enabledSubmitTooltip'] = 'مبادله کن';
$Definition['Auction']['enabledSubmitTooltip2'] = 'مبادله نقره به طلا';
$Definition['Auction']['maxAmountTooltip'] = 'خرید طلا.';
$Definition['Auction']['exchange'] = 'مبادله';
$Definition['Auction']['Exchange'] = 'مبادله';
$Definition['Auction']['silverExchange'] = 'دفتر مبادله';
$Definition['Auction']['sitterError'] = 'به عنوان جانشین شما اجازه دسترسی به این قسمت را ندارید.';
$Definition['Auction']['deletionError'] = 'در هنگام حذف اکانت قادر به دسترسی به این قسمت نیستید.';
$Definition['Auction']['10AdventuresError'] = 'شما تنها زمانی می توانید در حراجی شرکت کنید که 10 ماجراجویی انجام داده باشید.';
$Definition['Auction']['yes'] = 'بله';
$Definition['Auction']['no'] = 'خیر';
$Definition['Auction']['Confirm sale:'] = 'تایید فروش:';
$Definition['Auction']['You can only have x auctions at a time'] = 'شما تنها می توانید %s حراجی همزمان داشته باشید.';
$Definition['Auction']['Finish 10 adventures to unlock the auctions!'] = '10 ماجراجویی انجام دهید تا حراجی ها بازشوند!';
$Definition['Auction']['Choose an item to sell An auction can last up to x hours'] = 'یک جنس برای فروش انتخاب کنید. یک حراجی حداقل %s ساعت طول می کشد.';
$Definition['Auction']['Finished auctions'] = 'حراجی های تمام شده';
$Definition['Auction']['AuctionNotFound'] = 'این حراجی در سیستم ثبت نشده است.';
$Definition['Auction']['Really sell this item?'] = 'واقعاً این جنس فروخته شود؟';
$Definition['Auction']['Sell [AMOUNT] units?'] = 'فروش [AMOUNT] واحد؟';
$Definition['Auction']['Not enough items available for auction ([MIN_AMOUNT] items)'] = 'مقدار کافی از جنس برای حراجی موجود نیست.([MIN_AMOUNT] عدد)';
$Definition['Auction']['Do you want to sell this horse for 100 silver?'] = 'آیا واقعا می خواهید این اسب را 100 نقره بفروشید؟';
$Definition['Auction']['You cannot sell your horse!'] = 'شما اسب خود را نمی توانید بفروشید!';
$Definition['Auction']['AuctionFinished'] = 'این حراجی به اتمام رسیده است.';
$Definition['Auction']['notEnoughSilverAuctionError'] = 'شما سکه‌ی نقره تراوین کافی برای پیشنهاد ندارید. حداقل پیشنهاد ممکن %s سکه‌ی نقره تراوین میباشد.';
$Definition['Auction']['min'] = 'حداقل';
$Definition['Auction']['bidFor'] = 'پیشنهاد برای';
$Definition['Auction']['balanceSince'] = 'معاملات در طول 7 روز آخر';
$Definition['Auction']['cause'] = 'دلیل';
$Definition['Auction']['date'] = 'تاریخ';
$Definition['Auction']['showAccounting'] = 'نمایش جزئیات در مورد سکه‌های نقره‌‎ی تراوین رزرو شده در حراجی‌ها.';
$Definition['Auction']['hideAccounting'] = 'عدم نمایش جزئیات در مورد سکه‌های نقره‌‎ی تراوین رزرو شده در حراجی‌ها.';
$Definition['Auction']['noBooking'] = 'چیزی یافت نشد.';
$Definition['Auction']['Adventure'] = 'ماجراجویی';
$Definition['Auction']['sell x items of y'] = 'فروش %s مقدار از %s';
$Definition['Auction']['buy x items of y'] = 'خرید %s مقدار از %s';
$Definition['Auction']['currentBid'] = 'پیشنهاد فعلی';
$Definition['Auction']['currentBidder'] = 'بیشترین پیشنهاد دهنده';
$Definition['Auction']['notEnoughSilver'] = 'کمبود نقره';
$Definition['Auction']['desc'] = 'توضیحات';
$Definition['Auction']['clock'] = 'زمان';
$Definition['Auction']['bid'] = 'حراجی ها';
$Definition['Auction']['noAuction'] = 'حراجی یافت نشد.';
$Definition['Auction']['Change'] = 'تغییر';
$Definition['Auction']['del'] = 'حذف';
$Definition['Auction']['select all'] = 'انتخاب همه';
$Definition['Auction']['won'] = 'برنده';
$Definition['Auction']['outbid'] = 'بازنده';
$Definition['Auction']['reserve'] = 'رزرو کردن';
$Definition['Auction']['balance'] = 'موجودی';
$Definition['Auction']['running'] = 'درحال اجرا';
$Definition['Auction']['x unit perItem'] = '%s نقره برای هر واحد';
$Definition['Auction']['buy'] = 'خرید';
$Definition['Auction']['sell'] = 'فروش';
$Definition['Auction']['bids'] = 'پیشنهاد ها';
$Definition['Auction']['doBid'] = 'پیشنهاد';
$Definition['Auction']['accounting'] = 'حسابداری نقره';
$Definition['Auction']['cancelled'] = 'لغو شده';
$Definition['Auction']['finished'] = 'تمام شده';
$Definition['Auction']['filterFor'] = 'فیلتر برای';
$Definition['Auction']['silver'] = 'سکه نقره تراوین';
$Definition['Auction']['helmet'] = 'کلاه خود';
$Definition['Auction']['body'] = 'اجناس بدن';
$Definition['Auction']['leftHand'] = 'اجناس دست چپ';
$Definition['Auction']['rightHand'] = 'اجناس دست راست';
$Definition['Auction']['shoes'] = 'کفش ها';
$Definition['Auction']['horse'] = 'اسب ها';
$Definition['Auction']['cage'] = 'قفس ها';
$Definition['Auction']['scroll'] = 'کتیبه ها';
$Definition['Auction']['ointment'] = 'پماد ها';
$Definition['Auction']['bandage25'] = 'نوار زخم کوچک';
$Definition['Auction']['bandage%s'] = 'نوار زخم';
$Definition['Auction']['bucketOfWater'] = 'سطل ها';
$Definition['Auction']['bookOfWisdom'] = 'کتابهای دانش';
$Definition['Auction']['lawTables'] = 'لوح قانون';
$Definition['Auction']['artWork'] = 'اثرهای هنری';
//BBCode
$Definition['BBCode']['this player is registered at x'] = 'این بازیکن در تاریخ %s ثبت نام کرده است.';
$Definition['BBCode']['this player is under protection to x'] = 'این بازیکن تا %s تحت حمایت است.';
$Definition['BBCode']['x has refused a confederacy to y'] = '%s پیشنهاد اتحاد با %s را رد کرد.';
$Definition['BBCode']['x has refused nap to y'] = '%s پیشنهاد صلح با %s را رد کرد.';
$Definition['BBCode']['x has refused war to y'] = '%s پیشنهاد جنگ با %s را رد کرد.';
$Definition['BBCode']['confederacies with'] = 'متحد با';
$Definition['BBCode']['non-aggression pact(s) with'] = 'صلح با';
$Definition['BBCode']['at war(s) with'] = 'جنگ با';
$Definition['BBCode']['Forum'] = 'فروم';
$Definition['BBCode']['News'] = 'اخبار';
$Definition['BBCode']['Strength of own alliance'] = 'قدرت اتحاد خودی';
$Definition['BBCode']['X kicked Y from Alliance'] = '%s بازیکن %s را از اتحاد اخراج کرد.';
$Definition['BBCode']['Fighting points (difference to yesterday)'] = 'امتیاز حمله (تفاضل با دیروز)';
$Definition['BBCode']['troops destroyed by alliance Ally'] = 'سربازان کشته شده توسط اتحاد %s';
$Definition['BBCode']['resources stolen by alliance Ally'] = 'منابع غارت شده توسط اتحاد %s';
$Definition['BBCode']['troops destroyed of alliance Ally'] = 'سربازان کشته شده از اتحاد %s';
$Definition['BBCode']['resources stolen of alliance Ally'] = 'منابع دزدیده شده از اتحاد %s';
$Definition['BBCode']['This alliance cannot be found'] = 'این اتحاد یافت نشد.';
$Definition['BBCode']['latest postings on forum'] = 'آخرین پست های فروم';
$Definition['BBCode']['Alliance Events'] = 'رخداد های اتحاد';
$Definition['BBCode']['X joined Alliance'] = '%s به اتحاد پیوست.';
$Definition['BBCode']['X left Alliance'] = '%s اتحاد را ترک کرد.';
$Definition['BBCode']['X created new village'] = '%s دهکده جدید بنا کرد.';
$Definition['BBCode']['X invited Y'] = '%s بازیکن %s را به اتحاد دعوت کرد.';
$Definition['BBCode']['x has offered a confederacy to y'] = '%s به %s درخواست متحد شدن داد.';
$Definition['BBCode']['x has offered war to y'] = '%s به %s پیشنهاد جنگ داد.';
$Definition['BBCode']['x has offered nap to y'] = '%s به %s پیشنهاد صلح داد.';
$Definition['BBCode']['x has accepted a confederacy to y'] = '%s پیشنهاد متحد شدن را پذیرفت.';
$Definition['BBCode']['x has accepted nap to y'] = '%s پیشنهاد صلح را پذیرفت.';
$Definition['BBCode']['x has accepted war to y'] = '%s پیشنهاد جنگ را پذیرفت.';
$Definition['BBCode']['Losses compared to alliance'] = 'تنفات در مقایسه با اتحاد %s';
$Definition['BBCode']['attack'] = 'حمله';
$Definition['BBCode']['defense'] = 'دفاع';
//Buildings
$Definition['Buildings']['increase warehouse storage by level 20 storage value'] = 'ظرفیت یک انبار سطح 20 را به ظرفیت فعلی انبار اضافه کن.';
$Definition['Buildings']['increase granny storage by level 20 storage value'] = 'ظرفیت یک انبارغدا سطح 20 را به ظرفیت فعلی انبارغدا اضافه کن.';
$Definition['Buildings']['Alliance Founder'] = 'تاسیس کننده اتحاد';
$Definition['Buildings']['Alliance'] = 'اتحاد';
$Definition['Buildings']['to the alliance'] = 'به اتحاد';
$Definition['Buildings']['Tag'] = 'تگ';
$Definition['Buildings']['Name'] = 'نام';
$Definition['Buildings']['FoundAlliance'] = 'تاسیس اتحاد';
$Definition['Buildings']['accept'] = 'پذیرفتن';
$Definition['Buildings']['refuse'] = 'رد کردن';
$Definition['Buildings']['ww_change_name_desc'] = 'نام شگفتی جهان';
$Definition['Buildings']['allianceFull'] = 'این اتحاد حداکثر تعداد عضو های ممکن را دارا می باشد.';
$Definition['Buildings']['Enter Tag'] = 'تگ را وارد کنید.';
$Definition['Buildings']['Tag exists'] = 'این تگ وجود دارد.';
$Definition['Buildings']['Enter Name'] = 'یک نام وارد کنید.';
$Definition['Buildings']['Join alliance'] = 'پیوستن به اتحاد';
$Definition['Buildings']['There are no invitations available'] = 'درحال حاظر دعوت نامه ای موجود نیست.';
$Definition['Buildings']['Buildings'] = 'ساختمان ها';
$Definition['Buildings']['onOffLevelSwitch'] = 'نمایش/عدم نمایش نمایشگر ارتقا';
$Definition['Buildings']['maxMasterBuilderReached'] = 'شما حداکثر قادر به قراردادن %s ساختمان در نوبت ساخت هستید.';
$Definition['Buildings']['enoughResourcesAt'] = 'منابع کافی در %s.';
$Definition['Buildings']['constructBuilding'] = 'بنای ساختمان';
$Definition['Buildings']['upgradeBuilding'] = 'ارتقا به سطح %s';
$Definition['Buildings']['waitLoop'] = 'درنوبت ساخت';
$Definition['Buildings']['workersBusy'] = 'کارگران مشغول کارند.';
$Definition['Buildings']['enoughResourcesAtNever'] = 'تولید گندم شما منفی است به همین دلیل شما هیچگاه منابع کافی برای ساخت این ساختمان را نخواهید داشت.';
$Definition['Buildings']['(not possible)'] = '(غیرممکن)';
$Definition['Buildings']['finishNow']['finishNow'] = 'اتمام سریع ساخت';
$Definition['Buildings']['mainBuilding'] = [];
$Definition['Buildings']['mainBuilding']['Demolish building'] = 'تخریب ساختمان';
$Definition['Buildings']['mainBuilding']['demolish_desc'] = 'اگر دیگر به ساختمانی نیاز ندارید می توانید آنرا تخریب کنید';
$Definition['Buildings']['mainBuilding']['demolish'] = 'تخریب';
$Definition['Buildings']['mainBuilding']['Demolish completely'] = 'تخریب کامل';
$Definition['Buildings']['mainBuilding']['complete_demolish_title'] = 'آیا مطمئن هستید میخواهید این ساختمان را کامل تخریب کنید؟ این ساختمان به طور کل از دهکده شما پاک می شود.';
$Definition['Buildings']['buildingQueue']['buildingQueue'] = 'قرار دادن در نوبت ساخت';
$Definition['Buildings']['buildingQueue']['name'] = 'تراوین پلاس';
$Definition['Buildings']['buildingQueue']['desc'] = 'با اکانت پلاس می توانید 2 ساختمان همزمان در حال ساخت داشته باشید.';
$Definition['Buildings']['newBuilding']['Infrastructure'] = 'پیش نیاز ها';
$Definition['Buildings']['newBuilding']['Military'] = 'نظامی';
$Definition['Buildings']['newBuilding']['Resources'] = 'منابع';
$Definition['Buildings']['Infrastructure'] = 'پیش نیاز ها';
$Definition['Buildings']['Military'] = 'نظامی';
$Definition['Buildings']['resources'] = 'منابع';
$Definition['Buildings']['costsForUpgradeToLvl'] = '<b>هزینه</b> ازتقا به سطح %s';
$Definition['Buildings']['costs'] = 'هزینه';
$Definition['Buildings']['errors']['foodShortage'] = 'گندمزار را ارتقا دهید.';
$Definition['Buildings']['errors']['upgradeWareHouse'] = 'انبار را ارتقا دهید.';
$Definition['Buildings']['errors']['upgradeGranny'] = 'انبار غذا را ارتقا دهید.';
$Definition['Buildings']['errors']['constructWarehouse'] = 'انبار بساز.';
$Definition['Buildings']['errors']['constructGranny'] = 'انبار غذا بساز.';
$Definition['Buildings']['errors']['noGreatArtefact'] = 'شما برای ارتقا یا ساخت این ساختمان نیاز به کتیبه انبار بزرگ دارید.';
$Definition['Buildings']['errors']['wwPlans'] = 'برای ارتقا یا ساخت شگفتی جهان نیاز به نقشه ساخت دارید. <br> برای ارتقا تا سطح 50 نیاز به نقشه ساخت در دهکده های خود دارید. و برای ارتقای آن تا سطح 100 نیاز به نقشه ساخت دومی دارید که دست یکی از اعضای اتحاد شما است.';
$Definition['Buildings']['construct_with_master_builder'] = 'سفارش ساخت به معماران';
$Definition['Buildings']['constructNewBuilding'] = 'بنای ساختمان جدید';
$Definition['Buildings']['preRequests'] = 'پیش نیاز ها';
$Definition['Buildings']['no_building_available'] = 'در حال حاظر قادر به ساخت ساختمانی نیستید.<br> بیشتر ساختمان ها پیش نیاز هایی دارند برای اطلاعات بیشتر به دستورالعمل مراجعه کنید.';
$Definition['Buildings']['soon_available'] = 'ساختمان هایی که بزودی قادر به ساخت آنها خواهید بود';
$Definition['Buildings']['level'] = 'سطح';
$Definition['Buildings']['upgradeNotices']['reachedMaxLvL'] = 'به سطح آخر ممکن رسید.';
$Definition['Buildings']['upgradeNotices']['buildingIsOnDemolition'] = 'این ساخنمان در حال تخریب شدن است.';
$Definition['Buildings']['upgradeNotices']['upCostsToLevel'] = 'هزینه ارتقا به سطح';
$Definition['Buildings']['upgradeNotices']['currentlyUpgradingToLevel'] = 'در حال حاظر در حال ارتقا به سطح %s.';
$Definition['Buildings']['upgradeNotices']['currentlyReachingMaxLevel'] = '%s در حال حاظر درحال رسیدن به آخرین سطح ممکن می باشد.';
$Definition['Buildings']['upgradeNotices']['buildingIsOnDemolition'] = 'این ساختمان در حال تخریب است.';
$Definition['Buildings']['masterBuilder']['masterBuilder'] = 'نوبت ساخت';
$Definition['Buildings']['masterBuilder']['atStartOfConstruction'] = 'در شروع ساخت';
$Definition['Buildings']['buildingSites']['rallyPoint'] = 'محل احداث اردوگاه';
$Definition['Buildings']['buildingSites']['building'] = 'محل احداث ساختمان';
$Definition['Buildings']['buildingSites']['WorldWonder'] = 'محل احداث شگفتی جهان';
$Definition['Buildings'][1]['title'] = 'هیزم شکن';
$Definition['Buildings'][1]['desc'] = 'هیزم شکن درختان را بریده و چوب تولید می‌کند. هر قدر سطح هیزم شکن را بیشتر ارتقاء دهید، چوب بیشتری تولید خواهد شد.';
$Definition['Buildings'][1]['current_prod'] = 'تولید فعلی';
$Definition['Buildings'][1]['next_prod'] = 'تولید در سطح';
$Definition['Buildings'][1]['unit'] = 'درساعت';
$Definition['Buildings'][2]['title'] = 'آجرسازی';
$Definition['Buildings'][2]['desc'] = 'در اینجا آجر خام (خشت) ساخته می‌شود. هر قدر سطح این ساختمان بالاتر باشد تولید این محصول بیشتر خواهد شد.';
$Definition['Buildings'][2]['current_prod'] = 'تولید فعلی';
$Definition['Buildings'][2]['next_prod'] = 'تولید در سطح';
$Definition['Buildings'][2]['unit'] = 'درساعت';
$Definition['Buildings'][3]['title'] = 'معدن آهن';
$Definition['Buildings'][3]['desc'] = 'در اینجا معدنچیان، به تولید آهن می‌پردازند. هر قدر که سطح معدن بالاتر باشد، آهن بیشتری تولید خواهد شد.';
$Definition['Buildings'][3]['current_prod'] = 'تولید فعلی';
$Definition['Buildings'][3]['next_prod'] = 'تولید در سطح';
$Definition['Buildings'][3]['unit'] = 'درساعت';
$Definition['Buildings'][4]['title'] = 'گندم زار';
$Definition['Buildings'][4]['desc'] = 'غذای مصرفی مردم در اینجا تولید می‌شود. هر قدر سطح آن بالاتر باشد گندم بیشتری نیز تولید خواهد شد.';
$Definition['Buildings'][4]['current_prod'] = 'تولید فعلی';
$Definition['Buildings'][4]['next_prod'] = 'تولید در سطح';
$Definition['Buildings'][4]['unit'] = 'درساعت';
$Definition['Buildings'][5]['title'] = 'چوب بری';
$Definition['Buildings'][5]['desc'] = 'برش و نجاری چوب‌هایی که هیزم شکن فراهم می‌سازد، در این ساختمان انجام می‌گیرد. بسته به سطح چوب بری شما می‌توانید سطح تولید چوب را تا 25% بالا ببرید.';
$Definition['Buildings'][5]['current_prod'] = 'افزایش تولید فعلی';
$Definition['Buildings'][5]['next_prod'] = 'افزایش تولید در سطح';
$Definition['Buildings'][5]['unit'] = 'درصد';
$Definition['Buildings'][6]['title'] = 'آجر پزی';
$Definition['Buildings'][6]['desc'] = 'در آجرپزی از خشت خام، آجر ساخته می‌شود که می‌تواند تولید را تا سقف 25% افزایش دهد.';
$Definition['Buildings'][6]['current_prod'] = 'افزایش تولید فعلی';
$Definition['Buildings'][6]['next_prod'] = 'افزایش تولید در سطح';
$Definition['Buildings'][6]['unit'] = 'درصد';
$Definition['Buildings'][7]['title'] = 'ذوب آهن';
$Definition['Buildings'][7]['desc'] = 'در ذوب آهن، آهن تولید شده در معدن‌های آهن شما ذوب شده و راحت‌تر قابل استفاده در دهکده خواهد بود. بسته به سطح آن این ساختمان قادر به افزایش تولید آهن تا 25% می‌باشد.';
$Definition['Buildings'][7]['current_prod'] = 'افزایش تولید فعلی';
$Definition['Buildings'][7]['next_prod'] = 'افزایش تولید در سطح';
$Definition['Buildings'][7]['unit'] = 'درصد';
$Definition['Buildings'][8]['title'] = 'آسیاب';
$Definition['Buildings'][8]['desc'] = 'در آسیاب از گندم تولیدی در گندم زارها آرد تولید می‌شود. بسته به سطح آن این ساختمان قادر به افزایش تولید گندم تا 25% می‌باشد.';
$Definition['Buildings'][8]['current_prod'] = 'افزایش تولید فعلی';
$Definition['Buildings'][8]['next_prod'] = 'افزایش تولید در سطح';
$Definition['Buildings'][8]['unit'] = 'درصد';
$Definition['Buildings'][9]['title'] = 'نانوایی';
$Definition['Buildings'][9]['desc'] = 'در نانوایی از آرد تولید شده در آسیاب نان تولید می‌شود. بسته به سطح آن این ساختمان قادر به افزایش تولید گندم تا 50% می‌باشد.';
$Definition['Buildings'][9]['current_prod'] = 'افزایش تولید فعلی';
$Definition['Buildings'][9]['next_prod'] = 'افزایش تولید در سطح';
$Definition['Buildings'][9]['unit'] = 'درصد';
$Definition['Buildings'][10]['title'] = 'انبار';
$Definition['Buildings'][10]['desc'] = 'آهن, چوب و خشت، در انبار ذخیره می‌شوند. با ارتقاء سطح آن ظرفیت آن بیشتر شده و قادر به ذخیره‌ی بیشتر منابع خواهید بود.';
$Definition['Buildings'][10]['current_prod'] = 'ظرفیت فعلی';
$Definition['Buildings'][10]['next_prod'] = 'ظرفیت در سطح';
$Definition['Buildings'][10]['unit'] = 'واحد منبع';
$Definition['Buildings'][11]['title'] = 'انبار غذا';
$Definition['Buildings'][11]['desc'] = 'گندم تولید شده در گندم زارها در انبار غذا ذخیره می‌شود. با ارتقاء سطح آن ظرفیت آن نیز بیشتر خواهد شد.';
$Definition['Buildings'][11]['current_prod'] = 'ظرفیت فعلی';
$Definition['Buildings'][11]['next_prod'] = 'ظرفیت در سطح';
$Definition['Buildings'][11]['unit'] = 'واحد منبع';
$Definition['Buildings'][13]['title'] = 'آهنگری';
$Definition['Buildings'][13]['desc'] = 'در آهنگری اسلحه‌ها و تجهیزات جنگی لشکریان شما ارتقاء داده می‌شود. هر قدر سطح آن بالا باشد می‌توانید اسلحه و تجهیزات را بیشتر ارتقاء دهید.';
$Definition['Buildings'][14]['title'] = 'میدان تمرین';
$Definition['Buildings'][14]['desc'] = 'در میدان تمرین، لشگریان شما استقامت خود را افزايش مي دهند. با ارتقاي هرچه بيشتر اين ساختمان، سربازان شما از فاصله 20 خانه به بعد، سریعتر حرکت می کنند.';
$Definition['Buildings'][14]['current_prod'] = 'افزایش سرعت حرکت فعلی لشکریان';
$Definition['Buildings'][14]['next_prod'] = 'افزایش سرعت حرکت لشکریان در سطح';
$Definition['Buildings'][14]['unit'] = 'درصد';
$Definition['Buildings'][15]['title'] = 'ساختمان اصلی';
$Definition['Buildings'][15]['desc'] = 'معماران دهکده‌ی شما در ساختمان اصلی دهکده زندگی می‌کنند. هر قدر سطح آن بالا باشد سرعت ساخت ساختمان‌ها و ارتقاء آنها نیز بیشتر خواهد شد.';
$Definition['Buildings'][15]['current_prod'] = 'زمان ساخت فعلی';
$Definition['Buildings'][15]['next_prod'] = 'زمان ساخت در سطح';
$Definition['Buildings'][15]['unit'] = 'درصد';
$Definition['Buildings'][16]['title'] = 'اردوگاه';
$Definition['Buildings'][16]['desc'] = 'لشکریان دهکده‌ی شما در این محل جمع می‌شوند. از اینجا شما می‌توانید آنها را به حمله، جنگیدن و غنیمت گیری، تسخیر دهکده و آبادی و یا پشتیبانی از دهکده‌های دیگر ارسال کنید.<br /><br />اگر مجموع تعداد لشکریان مهاجم کمتر از سطح اردوگاه باشد شما می‌توانید نوع لشکریان ارسال شده را ببینید.';
$Definition['Buildings'][17]['title'] = 'بازار';
$Definition['Buildings'][17]['desc'] = 'در بازار شما می‌توانید با دیگر بازیکن‌ها تجارت کنید. هر قدر سطح آن بالا باشد، در هر تجارت می‌توانید منابع بیشتری مبادله کنید.';
$Definition['Buildings'][18]['title'] = 'سفارت';
$Definition['Buildings'][18]['desc'] = 'سفارت محلی برای مذاکره‌ی دیپلمات‌ها است. هر قدر سطح آن بالا باشد قدرت پادشاه بیشتر خواهد بود.';
$Definition['Buildings'][19]['title'] = 'سرباز خانه';
$Definition['Buildings'][19]['desc'] = 'در سربازخانه پیاده نظام ها تربیت می‌شوند. هر قدر سطح آن بالا باشد، زمان مورد نیاز برای تربیت آنها نیز کمتر خواهد بود.';
$Definition['Buildings'][20]['title'] = 'اصطبل';
$Definition['Buildings'][20]['desc'] = 'در اصطبل سواره نظام ها تربیت می‌شوند. هر قدر سطح آن بالا باشد، زمان مورد نیاز برای تربیت آنها نیز کمتر خواهد بود.';
$Definition['Buildings'][21]['title'] = 'کارگاه';
$Definition['Buildings'][21]['desc'] = 'در کارگاه شما می توانید ماشینهای جنگی مثل دژكوب و منجنیق را تولید کنید. هر قدر سطح آن بالا باشد سرعت ساخت نیز بیشتر خواهد بود.';
$Definition['Buildings'][22]['title'] = 'دارالفنون';
$Definition['Buildings'][22]['desc'] = 'در دارالفنون، نیروهای جدیدی می‌توانید تحقیق کنید. هر قدر سطح آن بالا باشد قادر به تحقیق نیروهای بهتری خواهید بود.<br><br>بعد از تحقیق نیرو در دارالفنون می‌توانید آن نیرو را در این دهکده بسازید.';
$Definition['Buildings'][23]['title'] = 'مخفیگاه';
$Definition['Buildings'][23]['desc'] = 'از مخفیگاه برای مخفی کردن مقداری از منابع خود در زمانی که دهکده مورد حمله قرار می‌گیرد می‌توانید استفاده کنید. این منابع قابل غارت نخواهند بود.';
$Definition['Buildings'][23]['current_prod'] = 'ظرفیت فعلی';
$Definition['Buildings'][23]['next_prod'] = 'ظرفیت مخفیگاه در سطح';
$Definition['Buildings'][23]['overall_storage'] = 'میزان مخفی شده در تمامی مخفیگاه ها';
$Definition['Buildings'][23]['unit'] = 'واحد منبع';
$Definition['Buildings'][24]['title'] = 'تالار';
$Definition['Buildings'][24]['desc'] = 'در تالار شما می توانید جشنهای پرشکوه برگزار کنید. این جشنها باعث افزایش امتیاز فرهنگی دهكده ي شما می شوند.';
$Definition['Buildings'][25]['title'] = 'اقامتگاه ';
$Definition['Buildings'][25]['desc'] = 'اقامتگاه قصر کوچکی است و هنگامی که پادشاه و یا ملکه از دهکده دیدن می‌کنند در آن می‌مانند. اقامتگاه از دهکده در مقابل افرادی که قصد تسخیر آن را دارند محافظت می کند.';
$Definition['Buildings'][26]['title'] = 'قصر';
$Definition['Buildings'][26]['desc'] = 'در قصر شاه و ملکه امپراطوری زندگی می کنند. شما در کل امپراطوری فقط یک قصر می توانید داشته باشید. فقط دهکده ای که قصر شما در آن است را می توانید به پایتخت خود تبدیل کنید (شما نمی توانید در یک دهکده قصر و اقامتگاه را با هم داشته باشید).';
$Definition['Buildings'][27]['title'] = 'خزانه';
$Definition['Buildings'][27]['desc'] = 'ثروت امپراطوری شما در خزانه نگهداری می شود. خزانه تنها برای یک کتیبه جا دارد. براي نگهداري كتيبه كوچك شما به خزانه سطح 10 و براي نگهداري كتيبه بزرگ و يا منحصر به فرد شما به خزانه سطح 20 نياز خواهيد داشت. فعال شدن کتیبه در سرورهای معمولی 24 ساعت و در سرور اسپید 12 ساعت طول خواهد کشید.';
$Definition['Buildings'][28]['title'] = 'تجارتخانه';
$Definition['Buildings'][28]['desc'] = 'در تجارتخانه می‌توانید گاری‌های تاجرها را ارتقاء دهید و با اسب‌های قوی‌تر مجهز کنید. گاری‌های پیشرفته تر ظرفیت حمل بیشتری خواهند داشت.';
$Definition['Buildings'][28]['current_prod'] = 'ظرفیت فعلی تاجران';
$Definition['Buildings'][28]['next_prod'] = 'ظرفیت تاجران در سطح';
$Definition['Buildings'][28]['unit'] = 'درصد';
$Definition['Buildings'][29]['title'] = 'سربازخانه بزرگ';
$Definition['Buildings'][29]['desc'] = 'پادگان بزرگ به شما اجازه می دهد تا واحدهای نظامی را به صورت همزمان با پادگان ولی به سه برابر قیمت تربیت کنید. سرباز خانه بزرگ را نمی توان در پایتخت بنا کرد';
$Definition['Buildings'][30]['title'] = 'اصطبل بزرگ';
$Definition['Buildings'][30]['desc'] = ' اصطبل بزرگ به شما اجازه می دهد تا واحدهای نظامی را به صورت همزمان با اصطبل ولی به سه برابر قیمت تربیت کنید. سرباز خانه بزرگ را نمی توان در پایتخت بنا کرد';
$Definition['Buildings'][31]['title'] = 'دیوار شهر';
$Definition['Buildings'][31]['desc'] = 'با بنا کردن دیوار شهر، شما می توانبد از دهکده خود در مقابل حملات دفاع کنید. هرچه دیوار شهر در مرحله بالاتری باشد، قدرت دفاعی بیشتر میشود';
$Definition['Buildings'][31]['current_prod'] = 'امتیاز دفاعی';
$Definition['Buildings'][31]['next_prod'] = 'امتیاز دفاعی در سطح';
$Definition['Buildings'][31]['unit'] = 'درصد';
$Definition['Buildings'][32]['title'] = 'دیوار گلی';
$Definition['Buildings'][32]['desc'] = 'با بنا کردن دیوار شهر، شما می توانبد از دهکده خود در مقابل حملات دفاع کنید. هرچه دیوار شهر در مرحله بالاتری باشد، قدرت دفاعی بیشتر میشود';
$Definition['Buildings'][32]['current_prod'] = 'امتیاز دفاعی';
$Definition['Buildings'][32]['next_prod'] = 'امتیاز دفاعی در سطح';
$Definition['Buildings'][32]['unit'] = 'درصد';
$Definition['Buildings'][33]['title'] = 'پرچین';
$Definition['Buildings'][33]['desc'] = 'با بنا کردن دیوار شهر، شما می توانبد از دهکده خود در مقابل حملات دفاع کنید. هرچه دیوار شهر در مرحله بالاتری باشد، قدرت دفاعی بیشتر میشود';
$Definition['Buildings'][33]['current_prod'] = 'امتیاز دفاعی';
$Definition['Buildings'][33]['next_prod'] = 'امتیاز دفاعی در سطح';
$Definition['Buildings'][33]['unit'] = 'درصد';
$Definition['Buildings'][34]['title'] = 'سنگ تراشی';
$Definition['Buildings'][34]['desc'] = 'سنگ تراش ها كه متخصصاني باتجربه در سنگ تراشی هستند، در اين ساختمان زندگي مي كنند. هرچه سطح این ساختمان بالاتر باشد مقاومت ساختمانهای دهکده شما بالاتر خواهد بود.';
$Definition['Buildings'][34]['current_prod'] = 'ثبات فعلی';
$Definition['Buildings'][34]['next_prod'] = 'ثبات در سطح';
$Definition['Buildings'][34]['unit'] = 'درصد';
$Definition['Buildings'][35]['title'] = 'قهوه خانه';
$Definition['Buildings'][35]['desc'] = 'قهوه و چایی در قهوه خانه تولید می شود که بعد از تولید از طرف سربازان در جشن ها مصرف می شود. این باعث افزایش قدرت سربازان در جنگ خواهد شد، ولی متاسفانه باعث کاهش قدرت چیف (رئیس) خواهد شد و منجنیق ها تنها قادر به هدفگیری تصادفی خواهند بود. قادر به ساخت این ساختمان تنها در پایتخت خود می باشید ولی تاثیر آن به کل امپراطوری خواهد بود.';
$Definition['Buildings'][36]['title'] = 'تله ساز';
$Definition['Buildings'][36]['desc'] = 'تله ساز با داشتن تله های مخفی در دهکده، شما را از دست دشمنان حفظ می کند. نیروهای دشمن در تله ها اسیر گشته و قادر به آسیب رساندن به دهکده شما نخواهند بود.<p>نیروهای اسیر شده را نمی توان با غارت، آزاد کرد. وقتی که نیروها با یک حمله عادی موفق آزاد گشتند، يك سوم از تله ها بطور خودکار تعمیر خواهد شد و در صورتی که صاحب تله ها خود اسیران را آزاد کند، نصف تله ها بطور خودکار تعمیر خواند شد.';
$Definition['Buildings'][36]['current_prod'] = 'حداکثر تعداد فعلی';
$Definition['Buildings'][36]['next_prod'] = 'حداکثر تعداد در سطح';
$Definition['Buildings'][36]['unit'] = 'تله';
$Definition['Buildings'][36]['overall_storage'] = 'حداکثر تعداد تله ها در تمامی تله ساز ها';
$Definition['Buildings'][37]['title'] = 'عمارت قهرمان';
$Definition['Buildings'][37]['desc'] = 'در این عمارت شما می توانید یک قهرمان تربیت کنید و بعد از اینکه این ساختمان به مرحله 10 رسید می توانید آبادی های اطراف خود را بگیرید (برای گرفتن آبادی دوم و سوم به ترتیب نیاز به عمارت قهرمان سطح 15 و 20 دارید).';
$Definition['Buildings'][38]['title'] = 'انبار بزرگ';
$Definition['Buildings'][38]['desc'] = 'در انبار بزرگ میتوانید به 3 برابر انبار معمولی منابع خود را ذخیره کنید';
$Definition['Buildings'][38]['current_prod'] = 'ظرفیت فعلی';
$Definition['Buildings'][38]['next_prod'] = 'ظرفیت در سطح';
$Definition['Buildings'][38]['unit'] = 'واحد منبع';
$Definition['Buildings'][39]['title'] = 'انبار غذا بزرگ';
$Definition['Buildings'][39]['desc'] = 'در انبار غذا بزرگ این امکان به شما داده میشود تا 3 برابر انبار غذا معمولی گندم ذخیره سازی کنید';
$Definition['Buildings'][39]['current_prod'] = 'ظرفیت فعلی';
$Definition['Buildings'][39]['next_prod'] = 'ظرفیت در سطح';
$Definition['Buildings'][39]['unit'] = 'واحد منبع';
$Definition['Buildings'][40]['title'] = 'شگفتی جهان';
$Definition['Buildings'][40]['desc'] = 'این یک معجزه بزرگ هست در دنیا و فقط محدود بازیکنانی قادر به ساخت چنان بنایی هستند این بازیکنان باید جزو قوی ترین ها باشند و هرکسی از پس این بنا برنمی آید';
$Definition['Buildings'][41]['title'] = 'آبشخوری اسب ها';
$Definition['Buildings'][41]['desc'] = 'آبخوری اسب ها مراقب سلامتی اسب های شما بوده، مصرف گندم آنها را کاهش داده و تربیت آنها را سریع تر می کند.';
$Definition['Buildings'][41]['current_prod'] = 'مدت زمان تربیت فعلی';
$Definition['Buildings'][41]['next_prod'] = 'مدت زمان تربیت در سطح';
$Definition['Buildings'][41]['unit'] = 'درصد';
$Definition['Buildings'][42]['title'] = 'دیوار سنگی';
$Definition['Buildings'][42]['desc'] = 'با ساختن دیوار سنگی می‌توانید روستایتان را در برابر حملات گله‌های وحشی دشمنان خود مصون دارید. هرچه سطح آن بالاتر باشد، امتیاز بالاتری هم به قابلیت دفاعی نیروهای شما داده می‌شود. 
<br/>
دیوار سنگی را فقط مصری‌ها می‌توانند بسازند؛ امتیاز دفاعی آن مثل حصار گال‌ها و دوام آن با دیوار سرزمین توتون‌ها قابل مقایسه است.';
$Definition['Buildings'][42]['current_prod'] = 'امتیاز دفاعی';
$Definition['Buildings'][42]['next_prod'] = 'امتیاز دفاعی در سطح';
$Definition['Buildings'][42]['unit'] = 'درصد';
$Definition['Buildings'][43]['title'] = 'دیوار موقت';
$Definition['Buildings'][43]['desc'] = 'با ساختن دیوار سنگی موقت روستایتان را در برابر حملات گله‌های وحشی دشمنان خود مصون دارید. هرچه سطح آن بالاتر باشد، امتیاز بالاتری هم به قابلیت دفاعی نیروهای شما داده می‌شود. 
<br/>
دیوار موقت را فقط هون‌ها می‌توانند بسازند؛ امتیاز دفاعی آن مثل دیوار سرزمین توتون‌ها و دوام آن با دیوار شهر رومی قابل مقایسه است.';
$Definition['Buildings'][43]['current_prod'] = 'امتیاز دفاعی';
$Definition['Buildings'][43]['next_prod'] = 'امتیاز دفاعی در سطح';
$Definition['Buildings'][43]['unit'] = 'درصد';
$Definition['Buildings'][44]['title'] = 'مرکز فرماندهی';
$Definition['Buildings'][44]['desc'] = 'مرکز فرماندهی روستا را در برابر دشمنان متجاوز محافظت می‌کند. شما در هر روستا می‌توانید یک مرکز فرماندهی بسازید. مهاجر و سناتور/رئیس/رئیس قبیله/فرمانروایان/رزمجویان را می‌توان آنجا آموزش داد.';

$Definition['Buildings'][45]['title'] = 'مجتمع آب‌رسانی';
$Definition['Buildings'][45]['desc'] = 'مجتمع آب‌رسانی این امکان را به شما می‌دهد که جریان آب را در واحه خود کنترل کنید. این کار نه تنها به پرورش درختان و محصولات زراعی کمک می‌کند، بلکه برای معادن و منابع نیز مفید واقع می‌شود چون انتقال آب و منابع را برای کارگران تأمین می‌کند. 
<br/>
این ساختمان باعث افزایش امتیاز تمامی واحه‌های الحاقی می‌شود. حداکثر اثرگذاری آن در سطح 20 اثر واحه‌ها را دوبرابر می‌کند. 
<br/>
مجتمع آبرسانی را فقط مصری‌ها می‌توانند بسازند.';
$Definition['Buildings'][45]['current_prod'] = 'افزایش فعلی';
$Definition['Buildings'][45]['next_prod'] = 'افزایش در سطح';
$Definition['Buildings'][45]['unit'] = 'درصد';
//
$Definition['combat'] = ["simulate" => "شبیه سازی", "attacker" => "مهاجم",
    "defender" => "مدافع", "number" => "تعداد",
    "unit_level" => "سطح", "other" => "دیگر",
    "Population" => "جمعیت",
    "catapult_target_level" => "سطح هدف منجنیق",
    "hero_off_bonus" => "امتیاز هجومی قهرمان",
    "hero_power" => "قدرت هجومی قهرمان",
    "Palace_Resident" => "قصر / اقامتگاه",
    "loyaltyReducedBy" => "وفاداری کاهش یافت با ",
    "DamageByCatapult" => "آسیب از طرف منجنیق",
    "DamageByRam" => "آسیب از طرف دژکوپ", "from" => "از",
    "to" => "به", "normal" => "عادی",
    "raid" => "غارت", "attack_type" => "نوع حمله",
    "troops" => "لشکریان", "casualties" => "تلفات",
    "attack_settings" => "تنظیمات حمله", "attack_types" => [
        1 => "جاسوسی", 2 => "عادی", 3 => "غارت",
    ],
];
//
$Definition['cropFinder']['title'] = '9/15 گندم یاب';
$Definition['cropFinder']['Start position:'] = 'مختصات شروع:';
$Definition['cropFinder']['cropper'] = 'گندمی';
$Definition['cropFinder']['both'] = 'هردو';
$Definition['cropFinder']['Type'] = 'نوع';
$Definition['cropFinder']['any'] = 'هرچه';
$Definition['cropFinder']['Oasis crop bonus (at least)'] = 'امتیاز آبادی (حداقل)';
$Definition['cropFinder']['only show unoccupied'] = 'تنها تسخیرنشده ها را نشان بده';
$Definition['cropFinder']['search'] = 'جستجو';
$Definition['cropFinder']['Croplands'] = 'گندمزار ها';
$Definition['cropFinder']['distance'] = 'فاصله';
$Definition['cropFinder']['Position'] = 'مختصات';
$Definition['cropFinder']['Oasis'] = 'آبادی';
$Definition['cropFinder']['Occupied by'] = 'تسخیر شده';
$Definition['cropFinder']['Alliance'] = 'اتحاد';
$Definition['cropFinder']['noRows'] = 'هیچ نتیجه ای یافت نشد.';
//
$Definition['DailyQuest'] = [];
$Definition['DailyQuest']['You`ve reached max voting limit Try again later'] = '!!!';
$Definition['DailyQuest']['Daily Quests'] = 'وظایف روزانه';
$Definition['DailyQuest']['Collect daily rewards'] = 'دریافت جوایز روزانه';
$Definition['DailyQuest']['Click for details'] = 'کلیک کنید';
$Definition['DailyQuest']['points'] = 'امتیاز ها';
$Definition['DailyQuest']['Collect reward'] = 'دریافت جایزه';
$Definition['DailyQuest']['Overview'] = 'دیدکلی';
$Definition['DailyQuest']['This account is banned'] = 'این اکانت بازداشت شده است.';
$Definition['DailyQuest']['Congratulations! You have collected enough points to get a reward!'] = 'تبریک! شما امتیاز کافی برای گرفتن یک جایزه را کسب کردید.';
$Definition['DailyQuest']['For collecting x points today, you receive the following reward'] = 'برای کسب %s امتیاز امروز، شما جایزه زیر را دریافت خواهید کرد';
$Definition['DailyQuest']['For collecting x points today, you can now collect your reward'] = 'برای دریافت %s امتیاز امروز، شما می توانید جایزه خود را دریافت کنید.';
$Definition['DailyQuest']['Your daily reward is determined randomly from these options'] = 'جایزه روزانه شما از بین یکی از گزینه های زیر بصورت تصادفی معین خواهد شد';
$Definition['DailyQuest']['reward_25%_desc'] = 'با جمع کردن 25 امتیاز قادر به دریافت یکی از جوایز زیر می باشید:
<br />
 <ul>
<li> +' . calculate_dailyquest_bonus(200, 'res') . ' تا از هر منبع</li>
<li> +' . calculate_dailyquest_bonus(50, 'exp') . ' تجربه برای قهرمان</li>
<li>+' . calculate_dailyquest_bonus(50, 'cp') . ' امتیاز فرهنگی</li>
<li>+' . calculate_dailyquest_bonus(1000, 'res') . ' منبع از نوع تصادفی</li>
</ul>';
$Definition['DailyQuest']['you collected x points today!'] = 'شما امروز %s امتیاز دریافت کردید!';
$Definition['DailyQuest']['Your Reward:'] = 'جایزه شما:';
$Definition['DailyQuest']['reward_25%_rows'][] = '<li> +' . calculate_dailyquest_bonus(200, 'res') . ' تا از هر منبع</li>';
$Definition['DailyQuest']['reward_25%_rows'][] = '<li> +' . calculate_dailyquest_bonus(50, 'exp') . ' تجربه برای قهرمان</li>';
$Definition['DailyQuest']['reward_25%_rows'][] = '<li>+' . calculate_dailyquest_bonus(50, 'cp') . ' امتیاز فرهنگی</li>';
$Definition['DailyQuest']['reward_25%_rows'][] = '<li>+' . calculate_dailyquest_bonus(1000, 'res') . ' منبع از نوع تصادفی</li>';
$Definition['DailyQuest']['x points achieved'] = '%s امتیاز دریافت شد.';
$Definition['DailyQuest']['reward_50%_desc'] = 'با جمع کردن 50 امتیاز قادر به دریافت یکی از جوایز زیر می باشید:
<br />
 <ul>
<li> +' . calculate_dailyquest_bonus(86400, 'plus') . ' اکانت پلاس</li>
<li>+' . calculate_dailyquest_bonus(86400, 'productionBoost') . ' افزایش تولید چوب</li>
<li>+' . calculate_dailyquest_bonus(86400, 'productionBoost') . ' افزایش تولید خشت</li>
<li>+' . calculate_dailyquest_bonus(86400, 'productionBoost') . ' افزایش تولید آهن</li>
<li>+' . calculate_dailyquest_bonus(86400, 'productionBoost') . ' افزایش تولید گندم</li>
</ul>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li> +' . calculate_dailyquest_bonus(86400, 'plus') . ' اکانت پلاس</li>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li>+' . calculate_dailyquest_bonus(86400, 'productionBoost') . ' افزایش تولید چوب</li>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li>+' . calculate_dailyquest_bonus(86400, 'productionBoost') . ' افزایش تولید خشت</li>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li>+' . calculate_dailyquest_bonus(86400, 'productionBoost') . ' افزایش تولید آهن</li>';
$Definition['DailyQuest']['reward_50%_rows'][] = '<li>+' . calculate_dailyquest_bonus(86400, 'productionBoost') . ' افزایش تولید گندم</li>';
$Definition['DailyQuest']['reward_75%_desc'] = 'با جمع کردن 75 امتیاز قادر به دریافت یکی از جوایز زیر می باشید:
<br />
 <ul>
<li> +5 پماد</li>
<li>+5 لوح قانون</li>
<li>+5 نوار زخم کوچک</li>
<li>+5 قفس</li>
<li>+1 ماجراجویی</li>
</ul>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li> +' . calculate_dailyquest_bonus(5, 'item') . ' دهن شفاء</li> پماد</li>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(5, 'item') . ' دهن شفاء</li> لوح قانون</li>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(5, 'item') . ' دهن شفاء</li> نوار زخم کوچک</li>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(5, 'item') . ' دهن شفاء</li> قفس</li>';
$Definition['DailyQuest']['reward_75%_rows'][] = '<li>+' . calculate_dailyquest_bonus(1, 'adv') . ' دهن شفاء</li> ماجراجویی</li>';
$Definition['DailyQuest']['reward_100%_desc'] = 'با جمع کردن 100 امتیاز قادر به دریافت یکی از جوایز زیر می باشید:
<br />
 <ul>
<li> +' . calculate_dailyquest_bonus(400, 'cp') . ' امتیاز فرهنگی</li>
<li>+' . calculate_dailyquest_bonus(20000, 'res') . ' منبع از نوع تصادفی</li>
<li>+' . calculate_dailyquest_bonus(400, 'exp') . ' تجربه قهرمان</li>
<li>+' . calculate_dailyquest_bonus(4000, 'res') . ' از هر منبع</li>
</ul>';
$Definition['DailyQuest']['reward_100%_rows'][] = '<li> +' . calculate_dailyquest_bonus(400, 'cp') . ' امتیاز فرهنگی</li>';
$Definition['DailyQuest']['reward_100%_rows'][] = '<li>+' . calculate_dailyquest_bonus(20000, 'res') . ' منبع از نوع تصادفی</li>';
$Definition['DailyQuest']['reward_100%_rows'][] = '<li>+' . calculate_dailyquest_bonus(400, 'exp') . ' تجربه قهرمان</li>';
$Definition['DailyQuest']['reward_100%_rows'][] = '<li>+' . calculate_dailyquest_bonus(4000, 'res') . ' از هر منبع</li>';
$Definition['DailyQuest']['Receive these free rewards every day!'] = 'جایزه های زیر را بصورت رایگان هر روز دریافت کنید!';
$Definition['DailyQuest']['nextResetDesc'] = 'ریست بعدی در ساعت %s. تا آن موقع امتیاز های خود را دریافت کنید.';
$Definition['DailyQuest']['Quest is complete for today'] = 'وظیفه برای امروز به پایان رسیده است';
$Definition['DailyQuest']['Quest is still open'] = 'وظیفه هنوز باز است.';
$Definition['DailyQuest']['Difficulty'] = 'دشواری';
$Definition['DailyQuest']['Requirement'] = 'پیش نیاز ها';
$Definition['DailyQuest']['Overview'] = 'دیدکلی';
$Definition['DailyQuest']['This quest is worth + x points'] = 'امتیاز این وظیفه + %s امتیاز می باشد.';
$Definition['DailyQuest']['Points granted for this quest: + x / y'] = 'امتیاز بدست آمده از این وظیفه + %s / %s';
$Definition['DailyQuest']['The points for this quest can be achieved x times per day'] = 'امتیاز این وظیفه در روز %s بار قابل دریافت است.';
$Definition['DailyQuest']['Difficulties'] = [
    "challenging" => 'چالش انگیز', "hard" => 'سخت', "moderate" => 'متوسط',
];
$Definition['DailyQuest']['questData'] = [
    1 => [
        'name' => 'کامل کردن یک ماجراجویی',
        'desc' => 'قهرمان خود را به ماجراجویی بفرستید. امتیاز این وظیفه زمانی قابل دریافت است که قهرمان به مکان ماجراجویی برسد. برای آغاز ماجراجویی با توجه به عکس روبرو تلاش کنید.',
        'difficulty' => 'moderate', 'Requirement' => 'ماجراجویی موجود',
    ], 2 => [
        'name' => 'غارت یک آبادی تسخیرنشده',
        'desc' => 'به یک آبادی تسخیر نشده حمله کن. این وظیفه حتی اگر لشکریان شما در حمله شکست بخورند نیز امتیاز را برای شما فراهم می کند. توجه کنید استفاده از قفس برای جلوگیری از حمله قابل قبول نمی باشد.',
        'difficulty' => 'hard', 'Requirement' => 'لشکریان فراوان',
    ], 3 => [
        'name' => 'غارت/حمله به دهکده ناتار ها',
        'desc' => 'به یکی از دهکده های ناتار ها حمله کنید یا آن را غارت کنید. شما نباید به دهکده های شگفتی جهان حمله کنید تا زمانی که حداقل 100,000 نیرو داشته باشید.',
        'difficulty' => 'challenging', 'Requirement' => 'لشکریان فراوان',
    ], 4 => [
        'name' => 'بردن یک حراجی',
        'desc' => 'با شرکت در حراجی شما دوبار برنده می شوید. یک بار جنس را برده و یک بار امتیاز خود را در وظایف روزانه دریافت می کنید. <br> جایزه این وظیفه زمانی که حراجی به پایان برسد قابل دریافت است.',
        'difficulty' => 'challenging',
        'Requirement' => '10 ماجراجویی به اتمام رسیده',
    ], 5 => [
        'name' => 'دریافت یا مصرف طلا',
        'desc' => 'برای دریافت امتیاز این وظیفه نیاز دارید طلا مصرف کرده و یا دریافت کنید.',
        'difficulty' => 'moderate', 'Requirement' => 'هیچ',
    ], 6 => [
        'name' => 'ارتقای یک ساختمان',
        'desc' => 'برای دریافت امتیاز این وظیفه نیاز است شما ساختمانی بسازید و یا یک ساختمان را ارتقا دهید. <br> امتیاز این وظیفه زمانی قابل دریافت است که ساخت به اتمام رسیده باشد.',
        'difficulty' => 'moderate', 'Requirement' => 'منابع',
    ], 7 => [
        'name' => 'ارتقای یک منبع',
        'desc' => 'برای دریافت امتیاز این وظیفه نیاز است شما ساختمانی بسازید و یا یک ساختمان را ارتقا دهید. <br> امتیاز این وظیفه زمانی قابل دریافت است که ساخت به اتمام رسیده باشد.',
        'difficulty' => 'moderate', 'Requirement' => 'منابع',
    ], 8 => [
        'name' => 'ساخت همزمان 20 سرباز پیاده',
        'desc' => '20 سرباز یا تعداد بیشتر بطور همزمان تربیت کنید.',
        'difficulty' => 'challenging', 'Requirement' => 'سربازخانه',
    ], 9 => [
        'name' => 'ساخت همزمان 20 سرباز سواره',
        'desc' => '20 سرباز یا تعداد بیشتر بطور همزمان تربیت کنید.',
        'difficulty' => 'challenging', 'Requirement' => 'اصطبل',
    ], 10 => [
        'name' => 'برپا کردن یک جشن',
        'desc' => 'یک جشن کوچک یا بزرگ برپا کنید.',
        'difficulty' => 'hard', 'Requirement' => '3 تالار شهر',
    ],
    11 => [
        'name' => 'به میزان %s منابع در اتحاد خود مشارکت کنید تا بتوانید به امتیاز ویژه اتحاد دست پیدا کنید', 'desc' => 'برای کمک به اتحاد خود، شما می توانید مشارکت کنید در ارسال منابع برای اتحاد خود برای دریافت امتیازهای اضافی، زمانی که اتحاد شما منابع کافی دریافت کرد، کل اعضاء از مزایای آن بهرمند خواهند شد. این ماموریت زمانی آغاز خواهد شد که شما در هر اتحاد مشارکت ارسال منابع کنید ', 'difficulty' => 'challenging', 'Requirement' => 'عضویت در اتحاد',
    ],
];
$Definition['DailyQuest']['VotingSystemTitle'] = 'طلای رایگان دریافت کنید!';
$Definition['DailyQuest']['Vote'] = 'رای';
$Definition['DailyQuest']['VoteRewardDesc'] = 'به ازای هر رای شما 10 <img class="gold" src="img/x.gif"> دریافت خواهید کرد.';
$Definition['DailyQuest']['Earn free gold!!!'] = 'طلای رایگان بدست آورید!!!';
$Definition['DailyQuest']['Click on Consultant to open Hints page'] = 'برای رای دادن بر بروی عکس های زیر کلیک کنید.';
$Definition['DailyQuest']['if you abuse the vote system you will be banned'] = 'اگر تقلبی در رای گیری صورت گیرد اکانت شما بازداشت خواهد شد.';
$Definition['DailyQuest']['voteQuestDescription'] = 'شما با رای دادن به سایت ما طلای رایگان دریافت خواهید کرد. <br /> برای رای دادن روی عکس های زیر کلیک کنید.';
//
$Definition['Dorf1']['units'] = 'لشکریان';
$Definition['Dorf1']['none'] = 'هیچ';
$Definition['Dorf1']['production']['production per hour'] = 'تولیدات در ساعت';
$Definition['Dorf1']['production']['resources'] = [];
$Definition['Dorf1']['production']['resources'][1] = 'چوب';
$Definition['Dorf1']['production']['resources'][2] = 'خشت';
$Definition['Dorf1']['production']['resources'][3] = 'آهن';
$Definition['Dorf1']['production']['resources'][4] = 'گندم';
$Definition['Dorf1']['production']['productionBoostButton'] = 'اطلاعات بیشتر در پلاس';
$Definition['Dorf1']['movements']['incoming'] = 'لشکریان در حال آمدن';
$Definition['Dorf1']['movements']['outgoing'] = 'لشکریان درحال رفتن';
$Definition['Dorf1']['movements']['hour'] = 'ساعت';
$Definition['Dorf1']['movements']['in'] = 'در';
$Definition['Dorf1']['movements']['incomingAttacksToOases'] = 'حملات به آبادی های خودی';
$Definition['Dorf1']['movements']['incomingAttacksToMe'] = 'حملات به دهکده های خودی';
$Definition['Dorf1']['movements']['reinforcement'] = 'نیروی کمکی';
$Definition['Dorf1']['movements']['incomingReinforcements'] = 'نیروی های کمکی خودی';
$Definition['Dorf1']['movements']['incomingReinforcementsToMyOases'] = 'نیروهای کمکی به آبادی های خودی';
$Definition['Dorf1']['movements']['outGoingAttacks'] = 'حملات خودی';
$Definition['Dorf1']['movements']['attack'] = 'حمله';
$Definition['Dorf1']['movements']['outGoingReinforcements'] = 'نیروی های کمکی خودی';
$Definition['Dorf1']['movements']['adventure'] = 'ماجراجویی';
$Definition['Dorf1']['movements']['outGoingAdventure'] = 'قهرمان در حال ماجراجویی';
$Definition['Dorf1']['movements']['evasion'] = 'گریز';
$Definition['Dorf1']['movements']['settlers'] = 'بنای دهکده جدید';
$Definition['Dorf1']['movements']['settlersOnTheWay'] = 'مهاجران در راه';
$Definition['Dorf1']['movements']['outGoingEvasion'] = 'گریز نیرو های خودی';
//
$Definition['embassyWhite']['embassy'] = 'سفارت';
$Definition['embassyWhite']['invites to you:'] = 'تعداد دعوت نامه ها به شما: ';
$Definition['embassyWhite']['max embassy level:'] = ' بالاترین سطح سفارت: ';
$Definition['embassyWhite']['construct an embassy'] = 'سفارت بساز.';
$Definition['embassyWhite']['Alliance forum'] = 'فروم اتحاد';
$Definition['embassyWhite']['Alliance overview'] = 'دیدکلی اتحاد';
$Definition['embassyWhite']['no alliance'] = 'اتحادی موجود نیست';
$Definition['embassyWhite']['You are currently not part of any alliance'] = 'درحال حاظر شما عضو اتحادی نیستید.';
//
$Definition['ExtraModules'] = [
    'addFarmsNearby' => 'اضافه کردن فارم های %sx%s',
    'addFarms' => 'اضافه کردن 100 فارم منحصربفرد',
    'addFarmsIsDisabledTill' => 'این قابلیت تا %s غیرفعال است.',
    'buyAdventure' => 'یافتن ماجراجویی',
    'upgradeToMaxLevel' => 'ارتقا به آخرین سطح ممکن',
    'upgradeStorageToMaxLevel' => 'ارتقا به آخرین سطح ممکن',
    'increaseStorage' => 'افزایش ظرفیت',
    'smithyMaxLevel' => 'ارتقا به آخرین سطح ممکن',
    'smithyUpgradeAllToMax' => 'ارتقا همه به آخرین سطح',
    'academyResearchAll' => 'تحقیق تمامی نیروها',
    'finishTraining' => 'اتمام فوری تربیت لشکریان',
    'Used %s of %s' => 'استفاده شده %s از %s',
    'Feature limit reached' => 'قابل استفاده نمی باشد!',
    'Errors' => [
        'WWDisabled' => 'در دهکده شگفتی جهان قادر به استفاده از این قابلیت نمی باشید.',
        'Feature limit reached' => 'قابل استفاده نمی باشد!'
    ]
];
//
$Definition['FarmList'] = [
    'You can only have one autoraid per account' => 'شما فقط یک غارت خودکار در کل اکانت می توانید داشته باشید.',
    'Auto raid On' => 'حمله خودکار روشن',
    'Auto raid Off' => 'حمله خودکار خاموش',
    'Auto raid costs %s silver(s) every %s seconds when it hits the farmlist' => 'حمله خودکار در هر بار تکرار %s <img src="img/x.gif" class="silver"> هزینه دارد.',
    "System: You must wait some time before sending another raid" => "شما باید قبل از ارسال دوباره فارم لیست کمی صبر کنید.",
    "nameTooLong" => "نام طولانی است.",
    "enterListName" => "نام لیست را وارد کنید.",
    "nameIsNotUnique" => "این نام قبلا برای لیست دیگری انتخاب شده است.",
    "nRaidsMade" => "%s غارت انجام شد.",
    "delete" => "حذف",
    "choose_village" => "یک دهکده انتخاب کنید.",
    "add" => "افزودن",
    "addRaid" => "افزودن فارم",
    "editRaid" => "ویرایش فارم",
    "choose_target" => "هدف را انتخاب کنید",
    "FarmList" => "لیست فارم",
    "reallyDelete" => "وافعا حذف شود؟",
    "raidList" => "لیست غارت",
    "lastTargets" => "آخرین هدف ها",
    "create_new_list" => "ایجاد لیست جدید",
    "rename_list" => "تغییر نام لیست",
    "rename" => "تغییر نام",
    "Village" => "دهکده",
    "pop" => "جمعیت",
    "distance" => "فاصله",
    "troops" => "لشکریان",
    "lastRaid" => "آخرین حمله",
    "name" => "نام",
    "create" => "ایجاد",
    "checkAll" => "انتخاب همه",
    "startRaid" => "غارت",
    "details" => "اطلاعات",
    "occupiedOasis" => "آبادی تسخیر شده",
    "unoccupiedOasis" => "آبادی تسخیر نشده",
    "edit" => "ویرایش",
    "outGoingAttack" => "حملات خودی",
    "noSlot" => "هیچ فارمی افروده نشده است.",
    "noVillageInTarget" => "در این مختصات دهکده یا آبادی یافت نشد.",
    "noTroopsSelected" => "سربازی انتخاب نشده است.",
    "sameVillageEntered" => "سربازی که در این دهکده ساخته شده است نمی تواند به این دهکده حمله کند!",
    "errorWorldWonderVillage" => "به این دهکده نمی توانید حمله کنید.",
    "slotsFull" => "فضای خالی برای فارم جدید وجود ندارد.",
    'editAllSlotsRaid' => 'ویرایش کلی',
    'Attack_iReport1' => 'حمله به  <img src=\'img/x.gif\' class=\'iReport iReport1\'/><img src=\'img/x.gif\' class=\'iReport iReport2\'/><img src=\'img/x.gif\' class=\'iReport iReport3\'/> <br>  تمام دهکده های لیست',
    'Attack_iReport2' => 'حمله به  <img src=\'img/x.gif\' class=\'iReport iReport1\'/> <br>  دهکده های بدون تلفات (سبز)  ',
    'Attack_iReport3' => 'حمله به  <img src=\'img/x.gif\' class=\'iReport iReport1\'/><img src=\'img/x.gif\' class=\'iReport iReport2\'/> <br>   به تمام لیست بجز حمله هایی که <br> بطور کامل دفاع شده اند (گزارش قرمز) ',
    'Attack_att3' => 'حمله به  <img src=\'img/x.gif\' class=\'att3\'/>  بصورت رندم <br>  در صورتی که  نیروهای شما <br> کمتر از لیست باشد بصورت <br> تصادفی  به تعدادی از دهکده ها <br> ارسال می شود ',
    'underProtection' => 'شما تحت حمایت هستید و فقط می توانید به آبادی های تسخیر نشده حمله کنید <br> در صورت حمله به دهکده یا آبادی تسخیر شده، حمایت شما لغو می شود ',
    'You attacked %s seconds ago, you need to wait %s seconds before sending another raid' => 'شما %s ثانیه پیش آخرین حمله خود را ارسال کرده اید. شما باید %s ثانیه دیگر صبر کنید.',
];
//
$Definition['Global']['Building settings'] = 'تنظیمات ساختمان';
$Definition['Global']['Times'] = 'تعداد';
$Definition['Global']['Unlimited'] = 'نامحدود';
$Definition['Global']['Hour'] = 'ساعت';
$Definition['Global']['Day'] = 'روز';
$Definition['Global']['Minute'] = 'دقیقه';
$Definition['Global']['Second'] = 'ثانیه';
$Definition['Global']['This tab is set as favourite'] = 'این صفحه به عنوان صفحه مورد علاقه شما انتخاب شده است.';
$Definition['Global']['Select tab %s as favourite'] = 'انتخاب صفحه %s به عنوان صفحه مورد علاقه شما';
$Definition['Global']['loadingData'] = 'بارگزاری...';
$Definition['Global']['registration_startgame_message_subject'] = 'نکات و مطالب مفید';
$Definition['Global']['registration_startgame_message_message'] = '[name] خوش آمدید؛ 

اینجا خانه جدیدتان است.

نگاهی به اطراف بیندازید. زمین‌های باشکوه، محصولات طلایی و کوه‌های آهنین - همگی متعلق به شماست. روستایتان شاید الان کوچک باشد، اما با ذکاوت و سخت‌کوشی آن را به یک امپراتوری تبدیل خواهید کرد. با این حال، یک حاکم بزرگ باید چیزی بیش از فضیلت محض را دارا باشد - یک حاکم بزرگ نیازمند خرد و دانایی است. پس به من گوش بدهید:

دنیا بر پایه منابع می‌چرخد. ساختمان‌هایتان به آنها احتیاج دارند، نیروهایتان از آن غذا می‌خورند، و کل جنگ‌ها نیز بر سر چیزی جز این نیست. بله، لازم است بدانید که: منابع راهی به سوی جاودانگی است. همیشه آنها را مصرف کنید. حفاظت از مبتدیان شما 5 روز دیگر از بین می‌رود و غارت گران هم زیاد منتظر نمی‌مانند. مرتباً به بازی بپردازید و روی مخفیگاه و زمین‌های منابع سرمایه‌گذاری کنید تا همواره اقتصاد پررونقی را داشته باشید.

نفس عمیقی بکشید. هوا شاید هنوز به خاطر باران طراوت و تازگی داشته باشد، ولی بوی خاکستر می‌آید. از نشانه‌های جنگ نمی‌توانید فرار کنید. ولی هنر دیپلماسی را دیگر نیاز نیست پنهان کنید: با دیگران صحبت کنید. دوستانی بیابید و به یک اتحاد ملحق شوید. آنها هنگام نیاز دست شما را می‌گیرند و توصیه‌های بیشماری در اختیارتان می‌گذارند. باید با متجاوزانتان هم مکاتبه کنید. به این قضیه پی خواهید برد که اکثر اوقات می‌توانید به معامله‌ای دست بزنید که برای هر دو طرف پرمنفعت باشد.

حالا خشت اول را بگذارید. این بنای تاریخی شماست. ولی فقط همین یکی نخواهد بود. برنامه شما باید این باشد که در اسرع وقت، دومین دهکده را بنا کنید. گزینه‌های پیش رویتان و در نتیجه قدرت‌تان شدیداً افزایش خواهد یافت. منابع بسیار فراوان، راه‌های دیگر برای تخصص پیدا کردن در ساختمان‌ها و نتیجتاً راهبردهای بهتر. استقرار در محلی نزدیکتر به دوستان نیز مزیتی است که نباید فراموش شود.

دیگر وقت را برای حرف زدن تلف نکنیم. اکنون وقت عمل است. از کارگذار مشورت بگیرید – برنامه‌هایی عالی از قبل برایتان تدارک دیده است. اجازه دهید سخنم را با یک پند ارزشمند تمام کنم: هیچ‌گاه به‌واقع شکست نخورده‌اید مگر اینکه تسلیم شده باشید. چالش‌ها و پس‌روی‌هایی وجود خواهد داشت، اما فقط با پشت سر گذاشتن آنهاست که به شکوفایی می‌رسید. هر داستان بزرگی با سختی‌هایی همراه است. حالا بروید و به جهان نشان دهید که شما که هستید.';
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
    'en' => 'انگلیسی',
    'ir' => 'فارسی',
];
$Definition['Global']['edit'] = 'ویرایش';
$Definition['Global']['ms'] = 'میلی ثانیه';
$Definition['Global']['ns'] = 'نانو ثانیه';
$Definition['Global']['FreeGoldTitle'] = 'طلای رایگان';
$Definition['Global']['FreeGold'] = 'بازیکن گرامی،' . "\n\n" . '%s عدد طلای تراوین به حساب شما افزوده شد.' . "\n\n" . 'با تشکر،' . "\n" . 'تیم تراوین';
$Definition['Global']['BuyGoldSubject'] = 'تراکنش با موفقیت انجام شد.';
$Definition['Global']['BuyGoldText'] = 'تراکنش شما با موفقیت انجام شد.';
$Definition['Global']['BuyGoldText'] .= PHP_EOL . '%s طلا به اکانت شما افزوده شد.';
$Definition['Global']['BuyGoldText'] .= PHP_EOL . 'کد پیگیری: %s';
$Definition['Global']['voucherTitle'] = 'تراکنش با موفقیت انجام شد.';
$Definition['Global']['voucherText'] = 'کپن شما مصرف و %s طلا به اکانت شما واریز شد.';
$Definition['Global']['voucherText'] .= PHP_EOL . 'کد پیگیری: %s';
$Definition['Global']['VoucherEmailSubject'] = 'کد کوپن تراوین';
$Definition['Global']['VoucherEmailMessage'] = 'بازیکن عزیز،<br />شما به تازگی حساب کاربری خود را در تراوین حذف کرده اید و شما در آن سرور مقداری طلای تراوین خریداری کرده بودید.<br /><br />شما هم اکنون می توانید سکه های طلا خود را به سروری دیگر انتقال دهید <br /> کد کوپن شما: %s<br /><br />با احترام تیم تراوین شما';
$Definition['Global']['Farms'] = 'فارم ها';
$Definition['Global']['Farm'] = 'فارم';
$Definition['Global']['The process may take some time Please wait'] = 'این کار ممکن است طولانی شود. لطفا صبر کنید.';
$Definition['Global']['Loading'] = 'بارگزاری';
$Definition['Global']['Contact admin'] = 'تماس با پشتیبانی';
$Definition['Global']['Travian'] = 'تراوین';
$Definition['Global']['FAQ'] = 'پاسخ های تراوین';
$Definition['Global']['cropfinder']['no results found'] = 'چیزی مطابق جستجوی شما پیدا نشد.';
$Definition['Global']['Dear [PlayerName],'] = '%s عزیز،';
$Definition['Global']['Best regards,The Travian Team'] = 'موفق باشید،<br />تیم تراوین';
$Definition['Global']['Register'] = 'ثبت نام';
$Definition['Global']['today'] = 'امروز';
$Definition['Global']['yesterday'] = 'دیروز';
$Definition['Global']['tomorrow'] = 'فردا';
$Definition['Global']['x days later'] = '%s روز دیگر';
$Definition['Global']['x days past'] = '%s روز قبل';
$Definition['Global']['beforeyesterday'] = 'پریروز';
$Definition['Global']['newVillageName'] = 'دهکده جدید';
$Definition['Global']['moreInformation'] = 'اطلاعات بیشتر';
$Definition['Global']['Hello x'] = 'سلام %s،';
$Definition['Global']['continue'] = 'ادامه';
$Definition['Global']['gold'] = 'سکه طلای تراوین';
$Definition['Global']['silver'] = 'سکه نقره تراوین';
$Definition['Global']['convertedTo'] = 'تبدیل شد به';
$Definition['Global']['Login'] = 'ورود';
$Definition['Global']['Support'] = 'پشتیبانی';
$Definition['Global']['Wilderness'] = 'سرزمین نامسکون';
$Definition['Global']['OccupiedOasis'] = 'آبادی تسخیر شده';
$Definition['Global']['unOccupiedOasis'] = 'آبادی تسخیر نشده';
$Definition['Global']['Abandoned valley'] = 'سرزمین متروکه';
$Definition['Global']['Player not found'] = 'بازیکن یافت نشد';
$Definition['Global']['Alliance not found'] = 'اتحاد یافت نشد';
$Definition['Global']['Invalid Report ID'] = 'شناسه گزارش اشتباه است';
$Definition['Global']['Invalid private key'] = 'کد شناسایی گزارش اشتباه است';
$Definition['Global']['General']['instructions'] = 'دستورالعمل';
$Definition['Global']['General']['ok'] = 'تایید';
$Definition['Global']['General']['cancel'] = 'لغو';
$Definition['Global']['General']['close'] = 'بستن';
$Definition['Global']['General']['or'] = 'یا';
$Definition['Global']['General']['closeWindow'] = 'بستن پنجره';
$Definition['Global']['General']['level'] = 'سطح';
$Definition['Global']['General']['in'] = 'در';
$Definition['Global']['General']['at'] = 'در';
$Definition['Global']['General']['endat'] = 'اتمام در';
$Definition['Global']['General']['hour'] = 'ساعت';
$Definition['Global']['General']['startat'] = 'شروع در';
$Definition['Global']['General']['duration'] = 'مدت زمان';
$Definition['Global']['General']['cost'] = 'هزینه';
$Definition['Global']['General']['perHour'] = 'در ساعت';
$Definition['Global']['General']['save'] = 'ذخیره';
$Definition['Global']['NatarsName'] = 'ناتار ها';
$Definition['Global']['playerVillageName'] = 'دهکده ی %s';
$Definition['Global']['wwName'] = 'شگفتی جهان';
$Definition['Global']['NatureName'] = 'طبیعت';
$Definition['Global']['races'][1] = 'رومی ها';
$Definition['Global']['races'][2] = 'توتن ها';
$Definition['Global']['races'][3] = 'گول ها';
$Definition['Global']['races'][4] = 'طبیعت';
$Definition['Global']['races'][5] = 'ناتار ها';
$Definition['Global']['races'][6] = 'مصریان';
$Definition['Global']['races'][7] = 'هون‌ها';
$Definition['Global']['UnloadHelper']['message'] = 'شما تغییراتی بدون ذخیره سازی ایجاد کرده اید، آیا مطمئن به تغییر صفحه هستید؟';
$Definition['Global']['Footer']['FAQ'] = 'سوالات متداول - پاسخ‌های تراوین';
$Definition['Global']['Footer']['Credits'] = 'Credits';
$Definition['Global']['Footer']['HomePage'] = 'صفحه اصلی';
$Definition['Global']['Footer']['Forum'] = 'فروم';
$Definition['Global']['Footer']['Links'] = 'لینک ها';
$Definition['Global']['Footer']['Terms'] = 'شرایط';
$Definition['Global']['Footer']['Imprint'] = 'یادداشت ها';
/*$Definition['Global']['SUPPORT_MESSAGE_EXTRA_THINGS'] = '<br /><br />-----------------------<br />[b]توجه:[/b] ما مايليم که شما را براي بهبود تيم پشتيباني خود به نظرسنجي دعوت کنيم!  <br />و اين بسيار عالي خواهد بود اگر شما بتوانيد چند دقيقه کوچکي از وقتتان را به پر کردن يک نظرسنجي کوتاه بدهيد!<br />به سمت نظرسنجي: <a target="_blank" href="http://goto.traviangames.com/t-com">http://goto.traviangames.com/t-com</a><br />-----<br /><br />T4/T4.4 پاسخ هاي تراوين : <a target="_blank" href="http://t4.answers.travian.com/">http://t4.answers.travian.com/</a><br />T2.5/T3 پاسخ هاي تراوين: <a target="_blank" href="http://t3.answers.travian.com/">http://t3.answers.travian.com/</a><br />وبسايت ما: <a target="_blank" href="http://www.travian.com/">http://www.travian.com/</a><br />ايميل ما: <a href="mailto:admin@' . WebService::getJustDomain() . '">admin@' . WebService::getJustDomain() . '</a><br /><br />--<br />Travian Games GmbH<br />Tehran, no32, corner of ZirakZadeh Alley<br />80807 München<br />Germany<br /><br /><a target="_blank" href="http://www.traviangames.com">http://www.traviangames.com</a><br /><br />مدير عامل: Iran Travian Team<br /><br />دادگاه ثبت شده: بازي آنلاين تراوين ثبت شده در بنياد ملي بازي هاي رايانه اي<br />شماره مجوز کسب و کار: HRB 173511<br /><br />آدرس فاکس: IR 246258085<br />–<br />اين ايميل ها و پيوست آن محرمانه  در نظر گرفته شده <br />صرفا براي جلب توجه شخص  به آنها پرداخته شده است.<br />و پاسخ به آن الزامي نيست<br /><br /> [b][i]با احترام تيم تراوين ايران*love*[/i][/b]  <br />–<br /><br /><br />---------------------<br /><br /><br />';$Language['CP'] = 'CP';
$Definition['Global']['SUPPORT_MESSAGE_EXTRA_THINGS_UNIQUE_FINDER'] = '[b]توجه:[/b] ما مايليم که شما را براي بهبود تيم پشتيباني خود به نظرسنجي دعوت کنيم!';
*/
$Definition['Global']['SUPPORT_MESSAGE_EXTRA_THINGS'] = '<br><br>';
$Definition['Global']['SUPPORT_MESSAGE_EXTRA_THINGS_UNIQUE_FINDER'] = '';

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
<h1>نقشه های ساخت</h1>
<br><br>
روز های بی شماری از جنگ اول گذشته است. امپراتوری ناتار ها با تلاش قادر به ساخت نقشه هایی برای ساخت شگفتی شده اند.<br><br>
<!--<span style="font-size:60%; color: #666;">(Story by
Grozoth)</span>-->
<b>راهنمایی:</b> <i>برای دزدین یک نقشه ی ساخت یکی از موارد زیر باید اتفاق بیفتد:</i><br>
<li>شما باید به ناتار ها حمله کنید.(حمله غارت جوابگو نیست!)</li>
<li>در حمله پیروز شوید.</li>
<li>خزانه را تخریب کنید.</li>
<li>قهرمان باید در جنگ شرکت کند.</li>
<li>خزانه سطح 10 باید در دهکده ی مهاجم وجود داشته باشد.</li>
<br><br>
برای ساخت شگفتی جهان تا سطح 50 نیاز به نقشه ساخت در دهکده های خود دارید و برای ارتقای آن تا سطح 100 حتما باید یکی از متحدان شما دارای نقشه دیگری باشد.
<br /><br />
موفق باشید!

';
$Definition['Global']['WWConstructStart'] = $Definition['Global']['WWPlansReleaseMessage'];
$Definition['Global']['ServerFinishNoWinner'] = '
بازيکنان عزيز تراوين،
<br><br>
<img src="/img/ww100.png" style="float:left;">
همه چيز هاي خوب بلاخره پاياني دارند, واين عصر نيز همچنين , باعث هم خوشحالي و هم ناراحتي ماست, که به شما عزيزان اعلام کنيم که اين نيز به پايان رسيد
					اميدوار هستيم که شما از بازي به همان اندازه که ما از ارائه آن به شما لذت برديم , لذت برده باشيد . و متشکريم که تا پايان بازي با ما مانديد.
<br><br>
نتيجه: با توجه به تلاش بی پایان بازیکنان، این جهان بازی توسط ناتار ها به پایان رسید.
<br><br>
بازيکن "<b><i>%s</i></b>" حکمران بزرگترين امپراتوري بود و بعد از او به ترتيب بازيکنان "<b><i>%s</i></b>" و "<b><i>%s</i></b>" بزرگترين امپراتوري ها را حکمراني کردند.
<br>
<br>
بازيکن "<b><i>%s</i></b>" با حملاتي که انجام داد، يکي از قدرتمندترين و ترسناکترين امپراتورها بود.
<br>
<br>
و همچنين بازيکن "<b><i>[DEFENDER]</i></b>" بهترين مدافع اين عصر بشمار ميايد.

<br><br>
با تشکر,<br>
تيم تراوين
<br><br>
<span style="font-size:60%; color: #666;"><small>(نوشته شده توسط
Grozoth)</small></span>';

$Definition['Global']['NatarsAreBuildingWW'] = '<center><h1>خبرهای مهم</h1></center>
<br>
وای خدای من, هم اکنون مطلع شدیم که <b><font color="blue">ناتارها</font></b> نیز قدرت ساخت شگفتی جهان را پیدا کردند و با سرعت زیادی ( %s سطح در هر %s) در حال ارتقاء شگفتی جهان می باشند.
<img src="/img/natars.jpg" style="float:left;">
<br><br>
با نیرویی که آنها دارند هیچگاه نمی توانیم شگفتی جهان آنها را نابود کنیم و فقط باید سرعت ساخت خود را افزایش دهیم تا برنده این دوره شویم. <b><font';

$Definition['Global']['ServerFinishWinner'] = '
بازيکنان عزيز تراوين،
<br><br>
<img src="/img/ww100.png" style="float:left;">
همه چيز هاي خوب بلاخره پاياني دارند, واين عصر نيز همچنين , باعث هم خوشحالي و هم ناراحتي ماست, که به شما عزيزان اعلام کنيم که اين نيز به پايان رسيد
					اميدوار هستيم که شما از بازي به همان اندازه که ما از ارائه آن به شما لذت برديم , لذت برده باشيد . و متشکريم که تا پايان بازي با ما مانديد.
<br><br>
نتيجه: خيلي وقت است که شب شده است، ولي باز کارگران دهکده <b><i>%s</i></b>
 در اين سوز شب زمستاني همچنان کار ميکنند، با آنکه ميدانند لشکريان
بيشماري در حال حرکت به سوي دهکده آنها مي باشند تا مانع کار آنها شوند، و
آنها ميدانند که زمان کم و دشمنان زيادي دارند. پاداش اين کار خود را زماني
 که کارگر گمنامي آخرين سنگ اين بنا را که ساليان سال از آن به عنوان
بزرگترين بناي بعد از سقوط ناتارها ياد خواهد شد در جاي خود قرار داد،
دريافت کردند.
<br><br>
بازيکن "<b><i>%s</i></b>" با کمک اتحاد "<b><i>%s</i></b>" اولين
گروهي بودند که ساخت شگفتي جهان را به اتمام رساندند. آنها از ميليون ها
منابع براي ساخت اين بنا و از صدها هزار سرباز شجاع براي دفاع از آن
استفاده کردند. به اين دليل "<b><i>%s</i></b>" مقام "بازيکن برنده اين دوره" را از آن خود کرد.
<br><br>
بازيکن "<b><i>%s</i></b>" حکمران بزرگترين امپراتوري بود و بعد از او به ترتيب بازيکنان "<b><i>%s</i></b>" و "<b><i>%s</i></b>" بزرگترين امپراتوري ها را حکمراني کردند.
<br>
<br>
بازيکن "<b><i>%s</i></b>" با حملاتي که انجام داد، يکي از قدرتمندترين و ترسناکترين امپراتورها بود.
<br>
<br>
و همچنين بازيکن "<b><i>[DEFENDER]</i></b>" بهترين مدافع اين عصر بشمار ميايد.

<br><br>
با تشکر,<br>
تيم تراوين
<br><br>
<span style="font-size:60%; color: #666;"><small>(نوشته شده توسط
Grozoth)</small></span>';
$Definition['Global']['ArtifactsReleaseMessage'] = '<div style="width:450px; height:830px; padding: 60px 25px;background:url(img/Natars_Banner_gross.jpg) no-repeat;">
    <center>
        <h1>کتیبه ها</h1>
        <br />
        <p style="font-size:100%; text-align:justify; width:400px">
بعد از مدت طولانی ناتار ها موفق به تحقیق و ساخت کتیبه هایی با قابلیت شگفت انگیز شدند. این کتیبه ها به قدری میتوانند ترسناک باشند که حتی فکر آن نیز غیر از تصور باشد.            <br><br>
            <img src="img/msg.jpg" alt="کتیبه ها" width="400" height="200" style="float:right">
            <br><br>
زمان برای تسخیر کتیبه ها فرا رسیده است. باکمک اتحاد خود و جنگجو های پرقدرت خود به جنگ ناتار ها بروید. هرچند ناتار ها از این کتیبه ها به شدت محافظت می کنند. بعد از حمله موفقیت آمیز قهرمان شما کتیبه را خواهد دزدید.        </p>

        <br/>
        <br/>
        <span style="font-size:60%; color: #666;">(نویسنده: Cryptid_Hunter)</span>
    </center>
</div>
';
$Definition['Global']['GoldPromotionPublicMsg'] = '<font color="#998200" size="2"><b>تخفیف طلایی</b></font><br />تمامی تعرفه های خرید طلا از  %s تا %s تمامی پکیج های خرید طلا شامل <b>20%%</b> طلای بیشتر برای شما خواهد بود.';
//
$Definition['GoldHelper']['exchangeResources']['exchangeResources'] = 'تعدیل منابع';
$Definition['GoldHelper']['exchangeResources']['error_in_ww'] = 'در دهکده شگفتی جهان قادر به استفاده از این قابلیت نمی باشید.';
$Definition['GoldHelper']['exchangeResources']['error_no_marketplace'] = 'بازار بساز.';
$Definition['GoldHelper']['exchangeResources']['error_low_pop'] = 'شما باید حداقل 40 جمعیت داشته باشید.';
$Definition['GoldHelper']['exchangeResources']['error_low_resources'] = 'حداقل جمع منابع شما باید 50 باشد.';
//
$Definition['Help']['Help system'] = 'راهنمایی';
$Definition['Help']['FAQ - Answers'] = 'سوالات متداول - جواب ها';
$Definition['Help']['Game rules'] = 'قوانین بازی';
$Definition['Help']['Contact ingame support'] = 'تماس با پشتیبانی داخل بازی';
$Definition['Help']['If you couldn\'t find an answer, contact the ingame support here'] = 'اگر پاسخ سوال خود را پیدا نکرده اید، با پشتیبانی تماس بگیرید.';
$Definition['Help']['Plus questions'] = 'پشتیبانی پلاس';
$Definition['Help']['You can ask questions about payment and premium features here'] = 'شما میتوانید سوالات خود را درباره درگاه پرداخت اینجا مطرح کنید.';
$Definition['Help']['Forum'] = 'فروم';
$Definition['Help']['On our Forum, you can meet and converse with other players'] = 'در فروم، شما میتوانید با بازیکنان جدید آشنا شوید.';
$Definition['Help']['Short instruction'] = 'دستورالعمل';
$Definition['Help']['Here you can find short explanations about the troops and buildings found in Travian'] = 'اینجا شما میتوانید اطلاعاتی درباره لشکریان و ساختمان های تراوین کسب کنید.';
$Definition['Help']['Interface help'] = 'راهنمای محیط کاربری';
$Definition['Help']['An overview of the user interface with short descriptions of the different functions'] = 'اینجا یک دیدکلی از محیط کاربری خواهید داشت.';
$Definition['Help']['Here, you can find the current game rules'] = 'اینجا، شما میتوانید قوانین فعلی بازی را مشاهده کنید.';
$Definition['Help']['Here, you can find your answers about Travian If you really can\'t find your answer here, you can also contact our ingame support afterwards'] = 'اینجا شما میتوانید جواب های خود را درباره ی بازی پیدا کنید.';
$Definition['Help']['inGameSupport'] = [
    'description' => 'با استفاده از سیستم راهنمای ما و سایت پاسخ‌های تراوین شما براحتی قادر به پیدا کردن پاسخ سوالات عمومی خود خواهید بود و نیازی به جستجوی طولانی نمی‌باشد. علاوه بر این شما قادر به تماس با پشتیبانی داخل بازی نیز می‌باشید ولی پشتیبانی داخل بازی تا 24 ساعت برای ارسال پاسخ نیاز دارد. برای دریافت پاسخ سریع تر به سایت پاسخ‌های تراوین مراجعه کنید.',
    'FAQ - go to Answers' => 'سوالات متداول - سایت پاسخ‌های تراوین',
    'I tried Answers but I want to contact the support' => 'سایت پاسخ‌های تراوین را مطالعه کردم، ولی می‌خواهم با پشتیبانی تماس بگیرم.',
    'Contact ingame support' => 'تماس با پشتیبانی داخل بازی',
];
//
$Definition['Hero'] = ["Attributes" => "خصوصیات", "Appearance" => "ظاهر",
    "Adventure" => "ماجراجویی", "Auction" => "حراجی",
    "showInformation" => "نمایش اطلاعات",
    "hideInformation" => "مخفی کردن اطلاعات", "normal" => "معمولی",
    "hard" => "دشوار",
];
//
$Definition['HeroAdventure']['Duration to the adventure'] = 'مدت زمان به ماجراجویی';
$Definition['HeroAdventure']['Arrival in: %s hrs | Return in: %s hrs'] = 'رسیدن در %s ساعت، بازگشت در %s ساعت.';
$Definition['HeroAdventure']['No rallyPoint'] = 'در دهکده اردوگاهی موجود نیست.';
$Definition['HeroAdventure']['headerAdventures'] = 'ماجراجویی های فعلی';
$Definition['HeroAdventure']['location'] = 'مکان';
$Definition['HeroAdventure']['moveTime'] = 'مدت زمان';
$Definition['HeroAdventure']['difficulty'] = 'خطر';
$Definition['HeroAdventure']['timeLeft'] = 'زمان باقی مانده';
$Definition['HeroAdventure']['goTo'] = 'لینک';
$Definition['HeroAdventure']['gotoAdventure'] = 'به ماجراجویی.';
$Definition['HeroAdventure']['normal'] = 'معمولی';
$Definition['HeroAdventure']['hard'] = 'سخت';
$Definition['HeroAdventure']['wald'] = 'جنگل';
$Definition['HeroAdventure']['clay'] = 'خشت';
$Definition['HeroAdventure']['hill'] = 'کوه';
$Definition['HeroAdventure']['lake'] = 'دریاچه';
$Definition['HeroAdventure']['adventure_dif_hard'] = 'ماجراجویی سخت';
$Definition['HeroAdventure']['adventure_dif_normal'] = 'ماجراجویی معمولی';
$Definition['HeroAdventure']['natarsLandscape'] = 'سرزمین نامسکون ناتار ها';
$Definition['HeroAdventure']['natars'] = 'دهکده ناتار ها';
$Definition['HeroAdventure']['adventure'] = 'ماجراجویی';
$Definition['HeroAdventure']['unOccupiedOasis'] = 'آبادی تسخیر نشده';
$Definition['HeroAdventure']['ok'] = 'تایید';
$Definition['HeroAdventure']['no adventures'] = 'ماجراجویی یافت نشد.';
$Definition['HeroAdventure']['Hero not available'] = 'قهرمان در دسترس نیست.';
$Definition['HeroAdventure']['Hero is stationed in village'] = 'قهرمان در این دهکده مستقر شده است.';
$Definition['HeroAdventure']['Hero is not in selected village at the moment'] = 'قهرمان درحال حاظر در دهکده انتخاب شده نیست.';
$Definition['HeroAdventure']['StartAdventure'] = 'آغاز ماجراجویی.';
$Definition['HeroAdventure']['back'] = 'قبلی';
$Definition['HeroAdventure']['rallyPointNeeded'] = 'اردوگاه نیاز است.';
$Definition['HeroAdventure']['Send hero to village'] = 'ارسال قهرمان به دهکده';
$Definition['HeroAdventure']['Travel time to village'] = 'زمان سفر به دهکده';
$Definition['HeroAdventure']['Revive hero first'] = 'اول قهرمان را زنده کنید.';
$Definition['HeroAdventure']['The Hero must be stationed in the selected village first in order to start an adventure from there'] = 'قهرمان باید به دهکده بازگردد تا ماجراجویی جدیدی شروع کنید.';
$Definition['HeroAdventure']['Travel time calculation for other villages'] = 'محاسبه‌ی مدت زمان سفر به دهکده‌ی دیگر';
$Definition['HeroAdventure']['Show travel time calculation for other villages'] = 'نمایش محاسبه‌ی مدت زمان سفر به دهکده‌ی دیگر';
$Definition['HeroAdventure']['Hide travel time calculation for other villages'] = 'عدم نمایش محاسبه‌ی مدت زمان سفر به دهکده‌ی دیگر';
$Definition['HeroAdventure']['Hero on his way'] = 'قهرمان در راه است';
//
$Definition['HeroFace'] = ["Gender" => "جنسیت", "male" => "مرد", "female" => "زن",
    "save" => "ذخیره", "random" => "تصادفی",
    "headProfile" => "سر", "hairColor" => "رنگ مو",
    "hairStyle" => "مدل مو", "ears" => "گوش ها",
    "eyebrow" => "ابروها", "eyes" => "چشم ها", "nose" => "بینی",
    "mouth" => "دهان", "beard" => "ریش",
];
//
$Definition['HeroGlobal']['HeroOverview'] = 'دیدکلی قهرمان';
$Definition['HeroGlobal']['health'] = 'سلامتی';
$Definition['HeroGlobal']['Experience'] = 'تجربه';
$Definition['HeroGlobal']['Appear'] = 'ظاهر';
$Definition['HeroGlobal']['Attributes'] = 'خصوصیات';
$Definition['HeroGlobal']['showInformation'] = 'نمایش اطلاعات';
$Definition['HeroGlobal']['hideInformation'] = 'عدم نمایش اطلاعات';
$Definition['HeroGlobal']['available_adventures:'] = 'ماجراجویی های موجود:';
$Definition['HeroGlobal']['next adventure will expire in:'] = 'ماجراجویی بعدی در %s ساعت دیگر به پایان می رسد.';
$Definition['HeroGlobal']['Auctions'] = 'حراجی';
$Definition['HeroGlobal']['Auctions with maximum bid:'] = 'حراجی ها با حداکثر پیشنهاد:';
$Definition['HeroGlobal']['Auctions which you got outbid:'] = 'حراجی هایی که شما خارج شدید:';
$Definition['HeroGlobal']['Adventure'] = 'ماجراجویی';
$Definition['HeroGlobal']['Tooltip loading'] = 'در حال بارگزاری...';
$Definition['HeroGlobal']['shortStatus']['Home'] = 'خانه';
$Definition['HeroGlobal']['shortStatus']['defending'] = 'دفاع می کند.';
$Definition['HeroGlobal']['shortStatus']['trapped'] = 'اسیر شده است.';
$Definition['HeroGlobal']['shortStatus']['dead'] = 'مرده';
$Definition['HeroGlobal']['shortStatus']['return'] = 'در راه';
$Definition['HeroGlobal']['shortStatus']['adventure'] = 'در راه';
$Definition['HeroGlobal']['shortStatus']['reinforcement'] = 'در راه';
$Definition['HeroGlobal']['shortStatus']['attack'] = 'در راه';
$Definition['HeroGlobal']['shortStatus']['escape'] = 'در راه';
$Definition['HeroGlobal']['shortStatus']['reviving'] = 'درحال زنده شدن است.';
$Definition['HeroGlobal']['longStatus']['Home'] = 'قهرمان شما در حال حاظر در دهکده %s است.';
$Definition['HeroGlobal']['longStatus']['defending'] = 'قهرمان شما در حال دفاع از دهکده %s است.';
$Definition['HeroGlobal']['longStatus']['trapped'] = 'قهرمان شما در حال حاظر در دهکده %s اسیر شده است.';
$Definition['HeroGlobal']['longStatus']['dead'] = 'قهرمان شما کشته شده است.';
$Definition['HeroGlobal']['longStatus']['return'] = 'قهرمان شما در حال بازگشت به دهکده %s می باشد.';
$Definition['HeroGlobal']['longStatus']['return'] .= '  رسیدن تا %s در %s.';
$Definition['HeroGlobal']['longStatus']['adventure'] = 'قهرمان شما در حال ماجراجویی %s است. رسیدن تا %s در %s.';
$Definition['HeroGlobal']['longStatus']['reinforcement'] = 'دهکده خانه قهرمان دهکده %s است. قهرمان در راه است.';
$Definition['HeroGlobal']['longStatus']['reinforcement'] .= ' رسیدن تا %s در %s.';
$Definition['HeroGlobal']['longStatus']['attack'] = 'دهکده خانه قهرمان دهکده %s است. قهرمان در راه است.';
$Definition['HeroGlobal']['longStatus']['attack'] .= '  رسیدن تا %s در %s.';
$Definition['HeroGlobal']['longStatus']['escape'] = 'قهرمان در حال گریز است.';
$Definition['HeroGlobal']['longStatus']['escape'] .= '  رسیدن تا %s در %s.';
$Definition['HeroGlobal']['longStatus']['reviving'] = 'قهرمان شما در حال زنده شدن در دهکده ی %s است.';
$Definition['HeroGlobal']['inventoryStatus']['Home'] = 'قهرمان شما در حال حاظر در دهکده <a href="karte.php?d=%s">%s</a> است.';
$Definition['HeroGlobal']['inventoryStatus']['defending'] = 'قهرمان شما در حال دقاع از دهکده ' . '<a href="karte.php?d=%s">%s</a> است.';
$Definition['HeroGlobal']['inventoryStatus']['trapped'] = 'قهرمان شما در دهکده ' . '<a href="karte.php?d=%s">%s</a> اسیر شده است.';
$Definition['HeroGlobal']['inventoryStatus']['dead'] = 'قهرمان شما کشته شده است.';
$Definition['HeroGlobal']['inventoryStatus']['return'] = 'قهرمان شما در حال بازگشت به دهکده <a href="karte.php?d=%s">%s</a> می باشد.';
$Definition['HeroGlobal']['inventoryStatus']['return'] .= '  رسیدن تا %s در %s.';
$Definition['HeroGlobal']['inventoryStatus']['adventure'] = 'قهرمان شما در حال ماجراجویی %s است. رسیدن تا %s در %s.';
$Definition['HeroGlobal']['inventoryStatus']['adventure'] .= '<div class="subMessage">(پروسه‌ی ماجراجویی را می‌توانید در <a href="build.php?gid=16&amp;tt=1&amp;newdid=%s">اردوگاه</a> ببینید.)  </div>';
$Definition['HeroGlobal']['inventoryStatus']['reinforcement'] = 'قهرمان شما برای پشتیبانی اعزام شده است.';
$Definition['HeroGlobal']['inventoryStatus']['reinforcement'] .= '  رسیدن تا %s در %s.';
$Definition['HeroGlobal']['inventoryStatus']['attack'] = 'دهکده خانه قهرمان دهکده <a href="karte.php?d=%s"> %s</a> است. قهرمان در راه است.';
$Definition['HeroGlobal']['inventoryStatus']['attack'] .= ' رسیدن تا %s در %s.';
$Definition['HeroGlobal']['inventoryStatus']['reinforcement'] = 'دهکده خانه قهرمان دهکده <a href="karte.php?d=%s"> %s</a> است. قهرمان در راه است.';
$Definition['HeroGlobal']['inventoryStatus']['escape'] = 'قهرمان در حال گریز است.';
$Definition['HeroGlobal']['inventoryStatus']['escape'] .= '  رسیدن تا %s در %s.';
$Definition['HeroGlobal']['inventoryStatus']['reviving'] = 'قهرمان شما درحال زنده شدن در دهکده ی <a href="karte.php?d=%s">%s</a> است ';
$Definition['HeroGlobal']['inventoryStatus']['reviving'] .= ' زمان باقی مانده: ';
//
$Definition['HeroInventory'] = [
    "loyaltyIsMaxYourCannotIncreaseItMore" => "وفاداری دهکده‌ی شما به حداکثر رسیده است. نمی‌توانید بیشتر از این آن را افزایش دهید.",
    "HeroAliveAndCannotUseBucket" => "قهرمان شما زنده است در نتیجه نمی توانید از سطل استفاده کنید.",
    "YourHeroWillBeAliveImmediatelyAndOneWaterBucketWillBeUsedAndNoResourcesWillBeRefunded" => "قهرمان شما بصورت فوری زنده خواهد شد و یک سطل ناپدید خواهد شد. منابع فعلی استفاده شده برگشت داده نخواهد شد!",

    "YouCannotUseThisItemCurrently" => "درحال حاضر شما نمی توانید از این جنس استفاده کنید.",
    "waterBucketsUsed" => "شما از تمامی سهم روزانه خود برای استفاده از سطل استفاده کرده اید. زمان استفاده بعدی: %s",
    "currentHeroExperience" => "تجربه فعلی قهرمان",
    "heroExperienceGainFromItems" => "تجربه‌ی بدست آمده از طریق مصرف کتیبه",
    "heroExperienceAfterUse" => "تجربه قهرمان بعد از مصرف",
    "currentCulturePoints" => "امتیاز فرهنگی فعلی",
    "culturePointsGainFromItems" => "امتیاز فرهنگی بدست آمده از اثرهای هنری",
    "culturePointsAfterUsage" => "امتیاز فرهنگی بعد از مصرف",
    "heroLevel" => "سطح قهرمان",
    "RomanSpecialHeroAttribute" => "قهرمان شما به ازای هر امتیاز %s قدرت هجومی دریافت خواهد کرد.",
    "TeutonSpecialHeroAttribute" => "وقتی قهرمان شما با لشکریان باشد میزان غارت از مخفیگاه به ازای %s درصد افزایش خواهد یافت.",
    "GualSpecialHeroAttribute" => "اگر قهرمان شما سواره باشد سرعت آن %s در خانه افزایش خواهد یافت.",
    "notMoveableText" => 'قهرمان شما مرده است و یا در دهکده نیست، به این دلیل قادر به \r\nاستفاده از این جنس نمی‌باشید',
    "notMoveableTextDead" => 'قادر به تغییر مکان این جنس نمی‌باشید. ابتدا باید قهرمان خود \r\nرا زنده کنید',
    "moveDialogDescription" => "تعداد اجناسی که تغییر مکان داده شوند",
    "useDialogDescription" => "تعداد اجناسی که استفاده شوند",
    "useOneDialogTitle" => "آیا واقعاً می‌خواهید این جنس را مصرف کنید؟",
    "moveDialogTitle" => "تغییر مکان",
    "useDialogTitle" => "استفاده", "buttonOk" => "تایید",
    "buttonCancel" => "لغو", "save" => "ذخیره تغییرات",
    "Body" => "بدن", "BuyItem" => "خرید جنس",
    "sellItem" => "فروش جنس", "productBonus" => "منابع",
    "increaseOfProduction" => "افزایش تولید منابع",
    "productBonusDesc" => "باعت افزایش تولید منابع در دهکده ای که قهرمان در آن مقیم است خواهد شد.",
    "defBonus" => "امتیاز دفاعی",
    "defBonusDesc" => "باعث افزایش قدرت دفاعی لشکریانی که با قهرمان باشند خواهد شد.",
    "offBonus" => "امتیاز هجومی",
    "offBonusDesc" => "باعث افزایش قدرت هجومی لشکریانی که با قهرمان باشند خواهد شد.",
    "fightingStrength" => "قدرت هجومی", "fightingStrengthDesc" => "قدرت هجومی قهرمان ترکیبی از قدرت حمله و دفاع او می‌باشد. به
هر اندازه که قدرت هجومی قهرمان بیشتر باشد به همان اندازه
صدمه کمتری در ماجراجویی‌های خود خواهد دید",
    "attackBehaviourSettings" => "مخفی کردن قهرمان",
    "availablePoints" => "امتیاز های موجود",
    "SaveChanges" => "لطفا تغییرات را ذخیره کنید.",
    "HeroHideDesc" => "هنگامی که حمله‌ای به این دهکده انجام شود قهرمان مخفی خواهد شد.",
    "HeroShowDesc" => "قهرمان شما همیشه با لشکریان باقی خواهد ماند.",
    "ReviveHeroInVillage" => "برای انتخاب دهکده اصلی دیگر برای قهرمان، دهکده مورد نظر را انتخاب کنید تا قهرمان آنجا زنده شود",
    "ResourcesRequiredToReviveHero" => "منابع مورد نیاز برای زنده کردن قهرمان",
    'HeroReviveInVillageDescription' => 'بود <a href="karte.php?d=%s">%s</a> دهکده اصلی قهرمان شما زنده خواهد شد <a href="karte.php?d=%s">%s</a> قهرمان شما در دهکده.',
    "EnoughResourcesAt" => "منابع کافی در",
    "changeResourcesHeadline" => "تغییر نوع تولید منابع از طرف قهرمان",
    "Regenerate" => "دوباره زنده کردن", "health" => "سلامتی",
    "heroRegenerationRate" => "بازسازی قهرمان شما",
    "perDay" => "در روز", "fromHero" => "از قهرمان",
    "fromItem" => "از جنس مجهز شده",
    "experience" => "تجربه",
    "experienceNeededToNextLevel" => "قهرمان شما برای رسیدن به سطح %s به %s تجربه نیاز دارد.",
    "speed" => "سرعت",
    "speedOfYourHero" => "سرعت قهرمان شما",
    "fieldPerHour" => "خانه/ساعت", "fromHorse" => "از اسب",
    "HeroProduction" => "تولید قهرمان",
    "currentHeroProduction" => "تولید فعلی قهرمان شما",
    "Bonus" => "افزایش", "Percent" => "درصد",
    "level" => "سطح",
    'heroExperienceBonus' => 'Bonus',

];
//
$Definition['HeroItems'] = [
    1 => [
        1 => [
            "name" => "کلاه خود هشیاری", "title" => "%s&#37;+ تجربه‌ی بیشتر",
        ], 2 => [
            "name" => "کلاه خود روشنگری", "title" => "%s&#37;+ تجربه‌ی بیشتر",
        ], 3 => [
            "name" => "کلاه خود دانش", "title" => "%s&#37;+ تجربه‌ی بیشتر",
        ], 4 => [
            "name" => "کلاه خود بازسازی", "title" => "%s+ سلامتی در هر روز",
        ], 5 => [
            "name" => "کلاه خود سلامتی", "title" => "%s+ سلامتی در هر روز",
        ], 6 => ["name" => "کلاه خود شفا", "title" => "%s+ سلامتی در هر روز"],
        7 => [
            "name" => "کلاه خود گلادیاتورها",
            "title" => "%s+ امتیاز فرهنگی در هر روز",
        ], 8 => [
            "name" => "کلاه خود تریبون",
            "title" => "%s+ امتیاز فرهنگی در هر روز",
        ], 9 => [
            "name" => "کلاه خود کنسول", "title" => "%s+ امتیاز فرهنگی در هر روز",
        ], 10 => [
            "name" => "کلاه خود سوارکار",
            "title" => "زمان تربیت در اصطبل به میزان %s&#37; کاهش خواهد یافت.",
        ], 11 => [
            "name" => "کلاه خود سواره نظام",
            "title" => "زمان تربیت در اصطبل به میزان %s&#37; کاهش خواهد یافت.",
        ], 12 => [
            "name" => "کلاه خود سواره نظام عالی رتبه",
            "title" => "زمان تربیت در اصطبل به میزان %s&#37; کاهش خواهد یافت.",
        ], 13 => [
            "name" => "کلاه خود سربازها",
            "title" => "زمان تربیت در سربازخانه به میزان %s&#37; کاهش خواهد یافت.",
        ], 14 => [
            "name" => "کلاه خود جنگجویان",
            "title" => "زمان تربیت در سربازخانه به میزان %s&#37; کاهش خواهد یافت.",
        ], 15 => [
            "name" => "کلاه خود فرمانروا",
            "title" => "زمان تربیت در سربازخانه به میزان %s&#37; کاهش خواهد یافت.",
        ],
    ], 2 => [
        82 => ["name" => "زره بازسازی", "title" => "%s+ سلامتی در هر روز"],
        83 => ["name" => "زره سلامتی", "title" => "%s+ سلامتی در هر روز"],
        84 => ["name" => "زره تندرستی", "title" => "%s+ سلامتی در هر روز"],
        85 => [
            "name" => "زره سبک",
            "title" => "%s+ سلامتی در هر روز<br />خسارت وارده بر سلامتی به میزان %s کاهش خواهد یافت.",
        ], 86 => [
            "name" => "زره",
            "title" => "%s+ سلامتی در هر روز<br />خسارت وارده بر سلامتی به میزان %s کاهش خواهد یافت.",
        ], 87 => [
            "name" => "زره سنگین",
            "title" => "%s+ سلامتی در هر روز<br />خسارت وارده بر سلامتی به میزان %s کاهش خواهد یافت.",
        ], 88 => [
            "name" => "سپر سینه‌ی سبک", "title" => "%s+ قدرت هجومی برای قهرمان",
        ], 89 => [
            "name" => "سپر سینه‌", "title" => "%s+ قدرت هجومی برای قهرمان",
        ], 90 => [
            "name" => "سپر سینه‌ی سنگین",
            "title" => "%s+ قدرت هجومی برای قهرمان",
        ], 91 => [
            "name" => "زره چند بخشی سبک",
            "title" => "%s+ قدرت هجومی برای قهرمان<br/>خسارت وارده بر سلامتی به میزان %s کاهش خواهد یافت.",
        ], 92 => [
            "name" => "زره چند بخشی",
            "title" => "%s+ قدرت هجومی برای قهرمان<br/>خسارت وارده بر سلامتی به میزان %s کاهش خواهد یافت.",
        ], 93 => [
            "name" => "زره چند بخشی سنگین",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />خسارت وارده بر سلامتی به میزان %s کاهش خواهد یافت.",
        ],
    ], 3 => [
        61 => [
            "name" => "نقشه‌ی کوچک",
            "title" => "%s&#37; افزایش سرعت برگشت به دهکده",
        ], 62 => [
            "name" => "نقشه", "title" => "%s&#37; افزایش سرعت برگشت به دهکده",
        ], 63 => [
            "name" => "نقشه‌ی بزرگ",
            "title" => "%s&#37; افزایش سرعت برگشت به دهکده",
        ], 64 => [
            "name" => "پرچم سه گوش کوچک",
            "title" => "افزایش %s&#37; سرعت حرکت لشکریان هنگام رفت آمد بین دهکده‌های خودی.",
        ], 65 => [
            "name" => "پرچم سه گوش",
            "title" => "افزایش %s&#37; سرعت حرکت لشکریان هنگام رفت آمد بین دهکده‌های خودی.",
        ], 66 => [
            "name" => "پرچم سه گوش بزرگ",
            "title" => "افزایش %s&#37; سرعت حرکت لشکریان هنگام رفت آمد بین دهکده‌های خودی.",
        ], 67 => [
            "name" => "پرچم کوچک",
            "title" => "سرعت حرکت لشکریان میان متحدین به میزان %s&#37; افزایش خواهد یافت.",
        ], 68 => [
            "name" => "پرچم",
            "title" => "سرعت حرکت لشکریان میان متحدین به میزان %s&#37; افزایش خواهد یافت.",
        ], 69 => [
            "name" => "پرچم بزرگ",
            "title" => "سرعت حرکت لشکریان میان متحدین به میزان %s&#37; افزایش خواهد یافت.",
        ], 73 => [
            "name" => "کیسه‌ی کوچک دزدان", "title" => "%s&#37;+ امتیاز غارت",
        ], 74 => ["name" => "کیسه‌ی دزدان", "title" => "%s&#37;+ امتیاز غارت"],
        75 => [
            "name" => "کیسه‌ی بزرگ دزدان", "title" => "%s&#37;+ امتیاز غارت",
        ], 76 => [
            "name" => "سپر کوچک", "title" => "%s+ قدرت هجومی برای قهرمان",
        ], 77 => ["name" => "سپر", "title" => "%s+ قدرت هجومی برای قهرمان"],
        78 => [
            "name" => "سپر بزرگ", "title" => "%s+ قدرت هجومی برای قهرمان",
        ], 79 => [
            "name" => "شیپور کوچک ناتارها",
            "title" => "%s&#37;+ قدرت هجومی در مقابل ناتارها",
        ], 80 => [
            "name" => "شیپور ناتارها",
            "title" => "%s&#37;+ قدرت هجومی در مقابل ناتارها",
        ], 81 => [
            "name" => "شیپور بزرگ ناتارها",
            "title" => "%s&#37;+ قدرت هجومی در مقابل ناتارها",
        ],
    ], 4 => [
        16 => [
            "name" => "شمشیر کوتاه سرباز لژیون",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر سرباز لژیون: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 17 => [
            "name" => "شمشیر سرباز لژیون",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر سرباز لژیون: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 18 => [
            "name" => "شمشیر بلند سرباز لژیون",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر سرباز لژیون: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 19 => [
            "name" => "شمشیر کوتاه محافظ",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر محافظ: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 20 => [
            "name" => "شمشیر محافظ",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر محافظ: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 21 => [
            "name" => "شمشیر بلند محافظ",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر محافظ: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 22 => [
            "name" => "شمشیر کوتاه شمشیرزن روم",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شمشیرزن: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 23 => [
            "name" => "شمشیر شمشیرزن روم",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شمشیرزن: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 24 => [
            "name" => "شمشیر بلند شمشیرزن روم",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شمشیرزن: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 25 => [
            "name" => "شمشیر کوتاه شوالیه",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شوالیه: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 26 => [
            "name" => "شمشیر شوالیه",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شوالیه: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 27 => [
            "name" => "شمشیر بلند شوالیه",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شوالیه: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 28 => [
            "name" => "نیزه‌ی سبک شوالیه‌ی سزار",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شوالیه‌ی سزار: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 29 => [
            "name" => "نیزه‌ی شوالیه‌ی سزار",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شوالیه‌ی سزار: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 30 => [
            "name" => "نیزه‌ی سنگین شوالیه‌ی سزار",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شوالیه‌ی سزار: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 31 => [
            "name" => "نیزه‌ی سبک سرباز پياده",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر سرباز پیاده: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 32 => [
            "name" => "نیزه‌ی سرباز پياده",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر سرباز پیاده: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 33 => [
            "name" => "نیزه‌ی سنگین سرباز پياده",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر سرباز پیاده: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 34 => [
            "name" => "شمشیر کوتاه شمشيرزن گول",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شمشیرزن: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 35 => [
            "name" => "شمشیر شمشيرزن گول",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شمشیرزن: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 36 => [
            "name" => "شمشیر بلند شمشيرزن گول",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شمشیرزن: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 37 => [
            "name" => "کمان کوچک رعد",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر رعد: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 38 => [
            "name" => "کمان رعد",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر رعد: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 39 => [
            "name" => "کمان بزرگ رعد",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر رعد: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 40 => [
            "name" => "تجهیزات جنگی سبک كاهن سواره",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر کاهن سواره: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 41 => [
            "name" => "تجهیزات جنگی كاهن سواره",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر کاهن سواره: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 42 => [
            "name" => "تجهیزات جنگی سنگین كاهن سواره",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر کاهن سواره: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 43 => [
            "name" => "نیزه‌ی سبک شوالیه‌ی گول",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شوالیه‌ی گول: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 44 => [
            "name" => "نیزه‌ی شوالیه‌ی گول",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شوالیه‌ی گول: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 45 => [
            "name" => "نیزه‌ی سنگین شوالیه‌ی گول",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شوالیه‌ی گول: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 46 => [
            "name" => "گرز سبک گرزدار",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر گرزدار: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 47 => [
            "name" => "گرز گرزدار",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر گرزدار: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 48 => [
            "name" => "گرز سنگین گرزدار",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر گرزدار: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 49 => [
            "name" => "نیزه‌ی سبک نيزه دار",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر نیزه دار: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 50 => [
            "name" => "نیزه‌ی نيزه دار",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر نیزه دار: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 51 => [
            "name" => "نیزه‌ی سنگین نيزه دار",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر نیزه دار: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 52 => [
            "name" => "تبر سبک تبرزن",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر تبرزن: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 53 => [
            "name" => "تبر تبرزن",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر تبرزن: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 54 => [
            "name" => "تبر سنگین تبرزن",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر تبرزن: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 55 => [
            "name" => "چکش سبک دلاور",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر دلاور: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 56 => [
            "name" => "چکش دلاور",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر دلاور: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 57 => [
            "name" => "چکش سنگین دلاور",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر دلاور: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 58 => [
            "name" => "شمشیر کوتاه شوالیه‌ی توتن",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شوالیه‌ی توتن: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 59 => [
            "name" => "شمشیر شوالیه‌ی توتن",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شوالیه‌ی توتن: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 60 => [
            "name" => "شمشیر بلند شوالیه‌ی توتن",
            "title" => "%s+ قدرت هجومی برای قهرمان<br />برای هر شوالیه‌ی توتن: %s+ قدرت حمله + %s+ قدرت دفاع",
        ], 115 => [ //start
            'name' => 'Club of the Slave Militia',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر نیروی برده‌ها: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 116 => [
            'name' => 'Mace of the Slave Militia',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر نیروی برده‌ها: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 117 => [
            'name' => 'Morning Star of the Slave Militia',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر نیروی برده‌ها: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 118 => [ //start
            'name' => 'Hatchet of the Ash Warden',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر نگهبان خاکستر: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 119 => [
            'name' => 'Axe of the Ash Warden',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر نگهبان خاکستر: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 120 => [
            'name' => 'Battle Axe of the Ash Warden',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر نگهبان خاکستر: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 121 => [//start
            'name' => 'Short Khopesh of the Warrior',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر جنگجوی قداره‌زن: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 122 => [
            'name' => 'Khopesh of the Warrior',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر جنگجوی قداره‌زن: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 123 => [
            'name' => 'Long Khopesh of the Warrior',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر جنگجوی قداره‌زن: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 124 => [//start
            'name' => 'Spear of the Anhor Guard',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر گارد آنهور: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 125 => [
            'name' => 'Spear of the Anhor Guard',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر گارد آنهور: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 126 => [
            'name' => 'Lance of the Anhor Guard',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر گارد آنهور: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 127 => [//start
            'name' => 'Short Bow of the Resheph Chariot',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر ارابه ریشف: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 128 => [
            'name' => 'Bow of the Resheph Chariot',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر ارابه ریشف: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 129 => [
            'name' => 'Long Bow of the Resheph Chariot',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر ارابه ریشف: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 130 => [ //start
            'name' => 'Hatchet of the Mercenary',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر مزدور: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 131 => [
            'name' => 'Axe of the Mercenary',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر مزدور: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 132 => [
            'name' => 'Battle Axe of the Mercenary',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر مزدور: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 133 => [ //start
            'name' => 'Composite Short Bow of the Bowman',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر کمان‌دار: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 134 => [
            'name' => 'Composite Bow of the Bowman',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر کمان‌دار: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 135 => [
            'name' => 'Composite Long Bow of the Bowman',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر کمان‌دار: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 136 => [ //start
            'name' => 'Short Spatha Sword of the Steppe Rider',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر استپ‌سوار: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 137 => [
            'name' => 'Spatha Sword of the Steppe Rider',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر استپ‌سوار: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 138 => [
            'name' => 'Long Spatha Sword of the Steppe Rider',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر استپ‌سوار: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 139 => [ //start
            'name' => 'Composite Short Bow of the Marksman',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر تیرانداز: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 140 => [
            'name' => 'Composite Bow of the Marksman',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر تیرانداز: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 141 => [
            'name' => 'Composite Long Bow of the Marksman',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر تیرانداز: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 142 => [ //start
            'name' => 'Short Spatha Sword of the Marauder',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر مهاجم: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 143 => [
            'name' => 'Spatha Sword of the Marauder',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر مهاجم: %s+ قدرت حمله + %s+ قدرت دفاع',
        ], 144 => [
            'name' => 'Long Spatha Sword of the Marauder',
            'title' => '%s+ قدرت هجومی برای قهرمان<br />برای هر مهاجم: %s+ قدرت حمله + %s+ قدرت دفاع',
        ],
    ], 5 => [
        94 => [
            "name" => "چکمه‌ی بازسازی", "title" => "%s+ سلامتی در هر روز",
        ], 95 => [
            "name" => "چکمه‌ی سلامتی", "title" => "%s+ سلامتی در هر روز",
        ], 96 => ["name" => "چکمه‌ی ترمیم", "title" => "%s+ سلامتی در هر روز"],
        97 => [
            "name" => "چکمه‌ی سربازی",
            "title" => "افزایش %s&#37;+ سرعت لشکریان برای فاصله‌های بیشتر از %s خانه",
        ], 98 => [
            "name" => "چکمه‌ی جنگجو",
            "title" => "افزایش %s&#37;+ سرعت لشکریان برای فاصله‌های بیشتر از %s خانه",
        ], 99 => [
            "name" => "چکمه‌ی فرمانروا",
            "title" => "افزایش %s&#37;+ سرعت لشکریان برای فاصله‌های بیشتر از %s خانه",
        ], 100 => [
            "name" => "مهمیز کوچک",
            "title" => "%s+ خانه در ساعت برای قهرمان های سواره",
        ], 101 => [
            "name" => "مهمیز",
            "title" => "%s+ خانه در ساعت برای قهرمان های سواره",
        ], 102 => [
            "name" => "مهمیز بزرگ",
            "title" => "%s+ خانه در ساعت برای قهرمان های سواره",
        ],
    ], 6 => [
        103 => [
            "name" => "اسب", "title" => "%s+ خانه در ساعت برای قهرمان",
        ], 104 => [
            "name" => "اسب اصیل", "title" => "%s+ خانه در ساعت برای قهرمان",
        ], 105 => [
            "name" => "اسب جنگی", "title" => "%s+ خانه در ساعت برای قهرمان",
        ],
    ], 7 => [
        112 => [
            "name" => "نوار زخم کوچک", "title" => "این جنس اگر همراه قهرمان باشد، تلفات جنگی بعد از جنگ
کاهش خواهد یافت. این نوار زخم قادر به ترمیم حداکثر %s&#37;
از تلفات جنگی می‌باشد. شما تنها به اندازه‌ی نوار زخمی که
همراه خود دارید قادر به ترمیم تلفات خواهید بود. مدت زمان
نیاز برای ترمیم برابر زمان نیاز برای برگشت لشکریان می‌باشد، ولی حداقل به %s ساعت نیاز خواهد داشت.<br />این جنس قابل انباشته شدن است.<br />باید قبل از رخ دادن جنگ قهرمان را با آن مجهز کنید تا تاثیر
داشته باشد.",
        ],
    ], 8 => [
        113 => [
            "name" => "نوار زخم", "title" => "این جنس اگر همراه قهرمان باشد، تلفات جنگی بعد از جنگ
کاهش خواهد یافت. این نوار زخم قادر به ترمیم حداکثر %s&#37;
از تلفات جنگی می‌باشد. شما تنها به اندازه‌ی نوار زخمی که
همراه خود دارید قادر به ترمیم تلفات خواهید بود. مدت زمان
نیاز برای ترمیم برابر زمان نیاز برای برگشت لشکریان می‌باشد، ولی حداقل به %s ساعت نیاز خواهد داشت.<br />این جنس قابل انباشته شدن است.<br />باید قبل از رخ دادن جنگ قهرمان را با آن مجهز کنید تا تاثیر
داشته باشد.",
        ],
    ], 9 => [
        114 => [
            "name" => "قفس", "title" => "با استفاده از این جنس قادر به گرفتن حیوانات موجود در آبادی <br />
ها و نگهداری آنها در دهکده برای دفاع در مقابل حمله‌ها می‌باشید.<br />این جنس قابل انباشته شدن است.<br />جنگی رخ نخواهد داد و حیوانات گرفته خواهند شد.",
        ],
    ], 10 => [
        107 => [
            "name" => "کتیبه", "title" => "زمانی تاثیر خواهد داشت که همراه قهرمان باشد. باعث افزایش <br />
تجربه‌ی کسب شده از طرف قهرمان خواهد شد.<br />زمانی که قهرمان با آن مجهز شود تاثیر خواهد داشت.<br />این جنس قابل انباشته شدن است.",
        ],
    ], 11 => [
        106 => [
            "name" => "پماد", "title" => "از این جنس برای ترمیم زخم‌های قهرمان می‌توانید استفاده کنید. <br />
مقدار سلامتی را به مقدار تعداد پمادهای موجود می‌توانید افزایش <br />
دهید (حداکثر %s&#37;).<br />زمانی که قهرمان با آن مجهز شود تاثیر خواهد داشت.<br />این جنس قابل انباشته شدن است.",
        ],
    ], 12 => [
        108 => [
            "name" => "سطل",
            "title" => "قهرمان شما را بصورت فوری و رایگان زنده خواهد کرد. اگر قهرمان زنده باشد، قادر به قرار دادن آن در جعبه‌ی او نیستید.<br />زمانی که قهرمان با آن مجهز شود تاثیر خواهد داشت.",
        ],
    ], 13 => [
        110 => [
            "name" => "کتاب دانش",
            "title" => "تمامی خصوصیات را بازنشانی (برگشت به حالت اول) کرده و می‌توانید آنها را دوباره تغییر دهید.<br />زمانی که قهرمان با آن مجهز شود تاثیر خواهد داشت.",
        ],
    ], 14 => [
        109 => [
            "name" => "لوح قانون", "title" => "وفاداری دهکده‌ای که قهرمان در آن می‌باشد را افزایش خواهد <br />
داد. هر لوح قادر به افزایش %s&#37; وفاداری می‌باشد. حداکثر مقدار <br />
ممکن %s&#37; است.<br />زمانی که قهرمان با آن مجهز شود تاثیر خواهد داشت.<br />این جنس قابل انباشته شدن است.",
        ],
    ], 15 => [
        111 => [
            "name" => "اثر هنری",
            "title" => "اگر از اثر هنری استفاده کنید به صورت فوری امتیاز فرهنگی بدست خواهید آورد. مقدار امتیاز فرهنگی که به شما داده خواهد شد برابر تولیدی کل دهکده‌های شما خواهد بود . حداکثر این مقدار در سرور اسپید %sx برابر %s امتیاز فرهنگی می‌باشد.<br />زمانی که قهرمان با آن مجهز شود تاثیر خواهد داشت.<br />این جنس قابل انباشته شدن است.",
        ],
    ],
];
//
$Definition['HeroMansion'] = ["AnnexedOasis" => "آبادی های تسخیر شده",
    "type" => "نوع", "owner" => "صاحب",
    "Village" => "دهکده",
    "Coordinates" => "مختصات",
    "Resources" => "منابع", "Loyalty" => "وفاداری",
    "conquered" => "تسخیر شده", "Forest" => "جنگل",
    "Clay" => "دشت", "Hill" => "کوه",
    "Lake" => "دریاچه",
    "nextOasisInHeroMansionLevel" => "آبادی بعدی در عمارت قهرمان سطح",
    "inReachOases" => "آبادی های قابل تسخیر",
    "noSlot" => "هیچ آبادی یافت نشد.",
    "duration" => "مدت زمان",
    "finished" => "اتمام در",
    "AbandonOases" => "ترک آبادی",
    "areYouSure" => "آیا مطمئن هستید؟",
    "del" => "حذف",
    "noNearOasis" => "آبادی در اطراف شما یافت نشد.",
];
//
use Core\Helper\WebService;
$Definition['inGame']['Enable this button to construct by clicking on the field'] = 'Enable this button to construct by clicking on the field';
$Definition['inGame']['Disable fast upgrade'] = 'Disable fast upgrade';
$Definition['inGame']['Inadmissible name/message'] = 'نام یا پیام غیرقابل قبول است.';
$Definition['inGame']['Error: very long input'] = 'نام یا پیام وارد شده طولانی است.';
$Definition['inGame']['TrainingTime'] = 'زمان تربیت: %s';
$Definition['inGame']['noTroopInBeingTrained'] = 'هیچ سربازی درحال تربیت نیست.';
$Definition['inGame']['FreeMerchants'] = 'تاجران موجود: %s/%s';
$Definition['inGame']['No further tasks available in this category'] = 'وظیفه دیگری در این نوع وجود ندارد.';
$Definition['inGame']['Click here to extend your beginners protection by 3 days'] = 'شما می توانید حمایت تازه واردین خود را به مدت %s %s تمدید کنید.';
$Definition['inGame']['You cannot send resources to other players, attack them or be attacked by them while in beginners protection'] = 'شما نمی توانید به بازیکنان دیگر منابع ارسال کنید یا حمله کنید در حالی که در حمایت تازه واردین هستید.';
$Definition['inGame']['Are you sure you want to extend your beginners protection?'] = 'آیا مطمئن هستید می خواهید حمایت تازه واردین خود را تمدید کنید؟';
$Definition['inGame']['Hours'] = 'ساعت';
$Definition['inGame']['Days'] = 'روز';
$Definition['inGame']['Minutes'] = 'دقیقه';
$Definition['inGame']['Seconds'] = 'ثانیه';
$Definition['inGame']['extend'] = 'تمدید';
$Definition['inGame']['maintenanceDesc'] = 'سیستم در حالت تعمیرات می باشد. <br> کارشناسان ما در حال برسی سیستم برای مشکلات هستند. لطفا کمی صبر کنید. <br> این عملیات ممکن از چند دقیقه و گاهی تا چند ساعت طول بکشد.';
$Definition['inGame']['serverTime'] = 'زمان سرور';
$Definition['inGame']['loyalty'] = 'وفاداری';
$Definition['inGame']['needPlusDesc'] = 'برای استفاده از این قابلیت نیاز به اکانت پلاس فعال دارید.';
$Definition['inGame']['noWorkShop'] = 'کارگاهی در این دهکده یافت نشد.';
$Definition['inGame']['DirectLinks'] = 'لینک های مستقیم';
$Definition['inGame']['noStable'] = 'اصطبلی در این دهکده یافت نشد.';
$Definition['inGame']['noBarracks'] = 'سربازخانه ای در این دهکده یافت نشد.';
$Definition['inGame']['noMarketplace'] = 'بازاری در این دهکده یافت نشد.';
$Definition['inGame']['changeVillageName'] = 'تغییر نام دهکده.';
$Definition['inGame']['trap_desc'] = 'شما %s تله دارید. %s تله در حال حاضر پر است.';
$Definition['inGame']['newVillageName'] = 'نام جدید دهکده';
$Definition['inGame']['DoubleClickToChangeVillageName'] = 'برای تغییر نام دهکده دوبار کلیک کنید.';
$Definition['inGame']['villages'] = 'دهکده ها';
$Definition['inGame']['hideCoordinates'] = 'مخفی کردن مختصات';
$Definition['inGame']['showCoordinates'] = 'نمایش مختصات';
$Definition['inGame']['Village statistics'] = 'آمار دهکده';
$Definition['inGame']['culture points'] = 'امتیاز فرهنگی';
$Definition['inGame']['Culture points generated to take control of another village:'] = 'امتیاز فرهنگی تولید شده برای دهکده جدید:';
$Definition['inGame']['MaintenanceWork'] = 'تعمیرات و نگهداری';
$Definition['inGame']['run celebration'] = 'برگزاری جشن';
$Definition['inGame']['festival'] = 'جشن';
$Definition['inGame']['type'] = 'نوع';
$Definition['inGame']['one celebration is running'] = 'یک جشن درحال اجرا است.';
$Definition['inGame']['celebrationRunning'] = 'جشن های درحال برگزاری';
$Definition['inGame']['Here you can subscribe or unsubscribe to our newsletter'] = 'اینجا شما میتواید عضو خبرنامه ما شوید.';
$Definition['inGame']['sitterChangeNameDesc'] = 'به عنوان جانشین قادر به تغییر نام دهکده نیستید.';
$Definition['inGame']['Are you sure you want to convert x gold to y silver?'] = 'آیا مطمئن هستید میخواهید %s طلا را به %s نقره تبدیل کنید؟';
$Definition['inGame']['Exchange'] = 'تبدیل';
$Definition['inGame']['The account will be deleted in'] = 'اکانت در %s ساعت دیگر حذف خواهد شد.';
$Definition['inGame']['infoBox']['ArtifactsWillBeReleasedIn'] = 'کتیبه ها در %s ساعت دیگر آزاد خواهند شد.';
$Definition['inGame']['infoBox']['wwPlansWillBeReleasedIn'] = 'نقشه های ساخت تا %s ساعت دیگر آزاد خواهند شد.';
$Definition['inGame']['infoBox']['youCanBuildWWIn'] = 'تا %s ساعت دیگر شما می توانید شگفتی جهان را بسازید.';
$Definition['inGame']['infoBox']['MedalsWillBeGivenIn'] = 'مدال ها در %s ساعت دیگر توزیع خواهند شد.';
$Definition['inGame']['infoBox']['AutoFinishTime'] = 'بازی به صورت خودکار توسط ناتار ها تا %s ساعت دیگر به اتمام خواهد رسید.';
$Definition['inGame']['infoBox']['CatapultAvailableIn'] = 'منجنیق ها %s ساعت دیگر قابل استفاده خواهند بود.';
$Definition['inGame']['infoBox']['PlusWillBeFinished'] = 'اکانت پلاس شما تا %s ساعت دیگر اعتبار دارد.';
$Definition['inGame']['infoBox']['Boost1WillBeFinished'] = 'افرایش تولید چوب شما تا %s ساعت دیگر اعتبار دارد.';
$Definition['inGame']['infoBox']['Boost2WillBeFinished'] = 'افزایش تولید خشت شما تا %s ساعت دیگر اعتبار دارد.';
$Definition['inGame']['infoBox']['Boost3WillBeFinished'] = 'افزایش تولید آهن شما تا %s ساعت دیگر اعتبار دارد.';
$Definition['inGame']['infoBox']['Boost4WillBeFinished'] = 'افزایش تولید گندم شما تا %s ساعت دیگر اعتبار دارد.';
$Definition['inGame']['infoBox']['plusAccountExpired'] = 'اکانت پلاس شما منقضی شده است.';
$Definition['inGame']['infoBox']['productionBoost1Expired'] = 'افزایش تولید چوب شما به پایان رسیده است.';
$Definition['inGame']['infoBox']['productionBoost2Expired'] = 'افزایش تولید خشت شما به پایان رسیده است.';
$Definition['inGame']['infoBox']['productionBoost3Expired'] = 'افزایش تولید آهن شما به پایان رسیده است.';
$Definition['inGame']['infoBox']['productionBoost4Expired'] = 'افزایش تولید گندم شما به پایان رسیده است.';
$Definition['inGame']['infoBox']['protection'] = 'شما تا %s ساعت دیگر تحت حمایت هستید.';
$Definition['inGame']['infoBox']['Your account was banned!'] = 'اکانت شما بازداشت شده است.';
$Definition['inGame']['infoBox']['Reason'] = 'دلیل';
$Definition['inGame']['infoBox']['Not enough gold to extend this feature'] = 'طلای کافی برای تمدید موجود نمی باشد.';
$Definition['inGame']['infoBox']['Reasons'] = [
    'Pushing' => 'پوش',
    'Cheat' => 'چیت',
    'Hack' => 'هک',
    'Bug' => 'باگ',
    'Bad Name' => 'نام بد',
    'Multiaccount' => 'مولتی اکانت',
    'Swearing' => 'انکارکردن',
    'Insults' => 'فحاشی/توهین',
    'Spam' => 'اسپم',
    'Other' => 'دیگر',
    'Another' => 'دیگر'
];
$Definition['inGame']['infoBox']['AutoType_GoldPromotion'] = '<font color="#ff8000" size="2"><b>تخفیف طلایی</b></font><br />تمامی تعرفه های خرید طلا از  %s تا %s تمامی پکیج های خرید طلا شامل <b>20%%</b> طلای بیشتر برای شما خواهد بود.';
$Definition['inGame']['infoBox']['Your account is in vacation until [time]'] = 'اکانت شما در حالت تعطیلات است تا %s.';
$Definition['inGame']['infoBox']['day(s)'] = 'روز';
$Definition['inGame']['infoBox']['hour(s)'] = 'ساعت';
$Definition['inGame']['infoBox']['overFlowMessage'] = 'حجم صندوق گزارشات شما بیش از 90%% استفاده شده است. پیام هایی که بیش از %s %s مانده باشند حذف خواهند شد.';
$Definition['inGame']['More Information'] = 'اطلاعات بیشتر';
$Definition['inGame']['total_messages'] = 'تعداد پیام ها';
$Definition['inGame']['unReadMessages'] = 'تعداد پیام های خوانده نشده';
$Definition['inGame']['showMoreMessages'] = 'نمایش پیام های بیشتر';
$Definition['inGame']['hideMoreMessages'] = 'نمایش پیام های کمتر';
$Definition['inGame']['Confirm'] = 'تایید';
$Definition['inGame']['InfoBox'] = 'اعلانات';
$Definition['inGame']['Delete this message permanently?'] = 'حذف این پیام به صورت همیشگی؟';
$Definition['inGame']['This tab is selected as your fav tab'] = 'این صفحه (Tab) به عنوان صفحه‌ی مورد علاقه انتخاب شده است';
$Definition['inGame']['Select this tab as fav'] = 'انتخاب این صفحه به عنوان صفحه مورد علاقه';
$Definition['inGame']['sendMessage'] = 'نوشتن پیام';
$Definition['inGame']['zoom_in'] = 'بزرگنمایی';
$Definition['inGame']['zoomIn'] = 'بزرگنمایی';
$Definition['inGame']['available'] = 'فعلی';
$Definition['inGame']['Amount'] = 'تعداد';
$Definition['inGame']['train_troops'] = 'سرباز تربیت کنید.';
$Definition['inGame']['in_training'] = 'درحال تربیت';
$Definition['inGame']['next_creating'] = 'تله بعدی در %s ساعت دیگر ساخته خواهد شد.';
$Definition['inGame']['next_training'] = 'سرباز بعدی در %s ساعت دیگر تربیت خواهد شد.';
$Definition['inGame']['in_creating'] = 'درحال ساخت';
$Definition['inGame']['train'] = 'تربیت';
$Definition['inGame']['palaceNoTrainText'] = 'برای بنای یا تسخیر دهکده جدید به قصر سطح 10 ، 15 ، 20 به ترتیب نیاز دارید. برای بنای دهکده جدید نیاز به 3 مهاجر دارید و برای تسخیر دهکده دیگری نیاز به رئیس خواهید داشت.';
$Definition['inGame']['residenceNoTrainText'] = 'برای بنای دهکده جدید یا تسخیر آن به اقامتگاه سطح 10 و 20 نیاز خواهید داشت. برای بنای دهکده جدید نیاز به 3 مهاجر دارید و برای فتح یا تسخیر دهکده جدید نیاز به رئیس خواهید داشت.';
$Definition['inGame']['noTroops'] = 'در حال حاضر هیچ نیرویی برای تربیت در این ساختمان تحقیق نشده است. برای تحقیق و یا مشاهده اطلاعات نیروها به دارالفنون مراجعه کنید.';
$Definition['inGame']['Profile']['Profile'] = 'پروفایل';
$Definition['inGame']['Profile']['edit profile description'] = 'توضیحات پروفایل را ویرایش کنید.';
$Definition['inGame']['Options']['Options'] = 'تنظیمات';
$Definition['inGame']['Options']['edit account settings'] = 'تنظیمات اکانت را ویرایش کنید.';
$Definition['inGame']['Options']['you may not edit settings of another account'] = 'شما اجازه تفییر تنظیمات اکانت دیگری را ندارید.';
$Definition['inGame']['Forum']['Forum'] = 'فروم';
$Definition['inGame']['Forum']['Meet other players on our external forum'] = 'با بازیکنان دیگر در فروم خارجی ما آشنا شوید.';
$Definition['inGame']['Help']['Help'] = 'راهنمایی';
$Definition['inGame']['Help']['Manuals, Answers and Support'] = 'راهنمایی، سوالات و پشتیبانی';
$Definition['inGame']['Logout']['Logout'] = 'خروج';
$Definition['inGame']['Logout']['Log out from the game'] = 'خروج از بازی.';
$Definition['inGame']['Navigation']['Resources'] = 'منابع';
$Definition['inGame']['Navigation']['Buildings'] = 'ساختمان ها';
$Definition['inGame']['Navigation']['Map'] = 'نقشه';
$Definition['inGame']['Navigation']['Statistics'] = 'آمار';
$Definition['inGame']['Navigation']['Reports'] = 'گزارش ها';
$Definition['inGame']['Navigation']['newReports'] = 'گزارش های جدید';
$Definition['inGame']['Navigation']['Messages'] = 'پیام ها';
$Definition['inGame']['Navigation']['newMessages'] = 'پیام های جدید';
$Definition['inGame']['Navigation']['Buy gold'] = 'خرید طلا';
$Definition['inGame']['gold'] = 'سکه طلای تراوین';
$Definition['inGame']['goldShort'] = 'طلا';
$Definition['inGame']['silver'] = 'سکه نقره تراوین';
$Definition['inGame']['silverShort'] = 'نقره';
$Definition['inGame']['endAt'] = 'اتمام در';
$Definition['inGame']['finishNow'] = 'اتمام سریع ساخت';
$Definition['inGame']['finishNowSitterNoPermission'] = 'شما به عنوان جانشین اجازه استفاده از طلا را ندارید.';
$Definition['inGame']['finishNowWWDisabled'] = 'استفاده از طلا در دهکده شگفتی جهان امکان پذیر نمی باشد.';
$Definition['inGame']['resources']['resources'] = 'منابع';
$Definition['inGame']['resources']['r0'] = 'همه';
$Definition['inGame']['resources']['r1'] = 'چوب';
$Definition['inGame']['resources']['r2'] = 'خشت';
$Definition['inGame']['resources']['r3'] = 'آهن';
$Definition['inGame']['resources']['r4'] = 'گندم';
$Definition['inGame']['resources']['r5'] = 'گندم آزاد';
$Definition['inGame']['Small celebration'] = 'جشن کوچک';
$Definition['inGame']['Big celebration'] = 'جشن بزرگ';
$Definition['inGame']['Hold a celebration'] = 'جشن بگیرید.';
$Definition['inGame']['productionBoost']['activate'] = 'فعال سازی';
$Definition['inGame']['productionBoost']['remainingTime'] = 'زمان باقی مانده: %s روز تا %s.';
$Definition['inGame']['productionBoost']['remainingTime2'] = 'ساعت %s به پایان می رسد.';
$Definition['inGame']['productionBoost']['woodProductionBoost'] = 'تولید بیشتر چوب';
$Definition['inGame']['productionBoost']['clayProductionBoost'] = 'تولید بیشتر خشت';
$Definition['inGame']['productionBoost']['ironProductionBoost'] = 'تولید بیشتر آهن';
$Definition['inGame']['productionBoost']['cropProductionBoost'] = 'تولید بیشتر گندم';
$Definition['inGame']['productionBoost']['extend'] = 'تمدید';
$Definition['inGame']['productionBoost']['activate now'] = 'هم اکنون فعال کن. <br> مدت زمان: %s';
$Definition['inGame']['productionBoost']['extend now'] = 'هم اکنون تمدید کن. <br> مدت زمان: %s ';
$Definition['inGame']['plus']['remainingTime'] = 'زمان باقی مانده: %s روز تا %s.';
$Definition['inGame']['plus']['remainingTime2'] = 'ساعت %s به پایان می رسد.';
$Definition['inGame']['plus']['activate'] = 'فعال سازی';
$Definition['inGame']['plus']['extend'] = 'تمدید';
$Definition['inGame']['plus']['activate now'] = 'هم اکنون فعال کن. <br> مدت زمان: %s ';
$Definition['inGame']['plus']['extend now'] = 'هم اکنون تمدید کن. <br> مدت زمان: %s  ';
$Definition['inGame']['sitterNoPermForGold'] = 'شما به عنوان جانشین تنها زمانی قادر به استفاده از طلا می باشید که صاحب اکانت به شما اجازه آن را داده باشد.';
$Definition['inGame']['continue'] = 'ادامه';
$Definition['inGame']['stockBar']['production']['r1'] = 'چوب||تولید در ساعت: %s<br>پرشدن در %s<br> برای اطلاعات بیشتر کلیک کنید.';
$Definition['inGame']['stockBar']['production']['r2'] = 'خشت||تولید در ساعت: %s<br>پرشدن در %s<br> برای اطلاعات بیشتر کلیک کنید.';
$Definition['inGame']['stockBar']['production']['r3'] = 'آهن||تولید در ساعت: %s<br>پرشدن در %s<br> برای اطلاعات بیشتر کلیک کنید.';
$Definition['inGame']['stockBar']['production']['r4'] = 'گندم||تولید بدون محاسبه گندم مصرفی ساختمان ها: %s<br>پرشدن در %s<br> برای اطلاعات بیشتر کلیک کنید.';
$Definition['inGame']['stockBar']['production']['r4Empty'] = 'گندم||تولید بدون محاسبه گندم مصرفی ساختمان ها: %s<br><span class="red">خالی خواهد شد در %s</span><br> برای اطلاعات بیشتر کلیک کنید';
$Definition['inGame']['stockBar']['production']['r5'] = 'گندم برای ساخت ساختمان ها.||تراز گندم: %s <br> برای اطلاعات بیشتر کلیک کنید.';
$Definition['inGame']['EndGameWinner'] = 'بازیکنان عزیز تراوین،
<br><br><img src="img/ww100.png" style="float:right;">
همه چیزهای خوب بالاخره پایانی دارند، و این عصر نیز به همچنین. باعث هم
خوشحالی و هم ناراحتی ما است که به شما عزیزان اعلام کنیم این نیز به پایان
 رسید. امیدوار هستیم که شما از بازی کردن این بازی به همان اندازه که ما
از ارائه آن به شما لذت بردیم، لذت برده باشید و متشکریم که تا پایان بازی
ماندید.
<br><br>
نتیجه: خیلی وقت است که شب شده است، ولی باز کارگران دهکده <b><i>%s</i></b>
 در این سوز شب زمستانی همچنان کار میکنند، با آنکه میدانند لشکریان
بیشماری در حال حرکت به سوی دهکده آنها می باشند تا مانع کار آنها شوند، و
آنها میدانند که زمان کم و دشمنان زیادی دارند. پاداش این کار خود را زمانی
 که کارگر گمنامی آخرین سنگ این بنا را که سالیان سال از آن به عنوان
بزرگترین بنای بعد از سقوط ناتارها یاد خواهد شد در جای خود قرار داد،
دریافت کردند.
<br><br>
بازیکن "<b><i>%s</i></b>" با کمک اتحاد "<b><i>%s</i></b>" اولین
گروهی بودند که ساخت شگفتی جهان را به اتمام رساندند. آنها از میلیون ها
منابع برای ساخت این بنا و از صدها هزار سرباز شجاع برای دفاع از آن
استفاده کردند. به این دلیل "<b><i>%s</i></b>" مقام "بازیکن برنده این دوره" را از آن خود کرد.
<br><br>
بازیکن "<b><i>%s</i></b>" حکمران بزرگترین امپراتوری بود و بعد از او به ترتیب بازیکنان "<b><i>%s</i></b>" و "<b><i>%s</i></b>" بزرگترین امپراتوری ها را حکمرانی کردند.
<br>
بازیکن "<b><i>%s</i></b>" با حملاتی که انجام داد، یکی از قدرتمندترین و ترسناکترین امپراتورها بود.
<br>
و همچنین بازیکن "<b><i>%s</i></b>" بهترین مدافع این عصر بشمار میاید.
<br><br>
با تشکر<br>
تیم تراوین<br><br>
<span class="note none"><i>نوشته شده توسط Admin</i></span>';
$Definition['inGame']['EndGameNoWinner'] = 'بازیکنان عزیز تراوین،
<br><br><img src="img/ww100.png" style="float:right;">
همه چیزهای خوب بالاخره پایانی دارند، و این عصر نیز به همچنین. باعث هم
خوشحالی و هم ناراحتی ما است که به شما عزیزان اعلام کنیم این نیز به پایان
 رسید. امیدوار هستیم که شما از بازی کردن این بازی به همان اندازه که ما
از ارائه آن به شما لذت بردیم، لذت برده باشید و متشکریم که تا پایان بازی
ماندید.
<br><br>
نتیجه: متاسفانه این جهان بازی برنده ای نداشت و ناتار ها برنده شدند.<br><br>
<br /><br /><br /><br /><br /><br />
بازیکن "<b><i>%s</i></b>" حکمران بزرگترین امپراتوری بود و بعد از او به ترتیب بازیکنان "<b><i>%s</i></b>" و "<b><i>%s</i></b>" بزرگترین امپراتوری ها را حکمرانی کردند.
<br>
بازیکن "<b><i>%s</i></b>" با حملاتی که انجام داد، یکی از قدرتمندترین و ترسناکترین امپراتورها بود.
<br>
و همچنین بازیکن "<b><i>%s</i></b>" بهترین مدافع این عصر بشمار میاید.
<br><br>
با تشکر<br>
تیم تراوین<br><br>
<span class="note none"><i>نوشته شده توسط Admin</i></span>';
$Definition['inGame']['bannedPageWithTime'] = 'سلام   %s!
<br><br>
شما به دلیل تخلف از قوانین ممنوع و بازداشت شده اید. هر بازیکن مجاز است که تنها یک حساب کاربری یک حساب کاربری در هر سرور داشته باشد.
<br/>
علت بازداشت: %s
</br></br> برای اطمینان از اینکه شما دوباره در آینده ممنوع و مسدود نخواهید شد این  است،که شما باید قوانین را به دقت مطالعه کنید:
</br></br><center><a href="http://' . WebService::getJustDomain() . 'spielregeln.php">» قوانین بازی</a> </center>
</br></br></br>
برای ادابه بازی باید تا %s صبر کنید و یا با مولتی هانتر تماس بگیرید و با کمال احترام دلیل را از او بپرسید.
</br></br><center>  <a href="messages.php?t=1&id=2">» نوشتن پیام</a> </center>
</br></br>
اما ممکن است به یکی از دلایل زیر این اتفاق افتاده باشد:
</br></br>
● همیشه دلیلی برای ممنوعیت وجود دارد. سعی کنید در مورد دلایل ممکن برای این ممنوعیت فکر کنید و مسائل را بی پرده و با مولتی هانتر تماس بگیرید.
</br>
● مولتی هانتر ها می تواند مقدار زیادی از اطلاعات مربوط به حساب شما را بررسی کنند. <u>توسط مموری استیک</u> و شما نباید بهانه ای  برای توجیه تخلفتان  از قوانین بگیرید.
</br>
● خوش لحن بودن و صبور بودن، این ممکن است مجازات را کاهش دهد .
</br>
● اگر مولتی هانتر بلافاصله پاسخ ندهد،   او احتمالا آنلاین نیست. و این مسئله  با ارسال چندین پیام پی در پی  حل و فصل  نمیشود، به خصوص او  میتواند حتی از خواندن نامه هایی که موضوع ندارن خوداری کند .
</br>
● اگر شما واقعا به ناحق ممنوع (بن) شده است <u>سعی کنید آرامش خود را حفظ کنید و مودب باشید</u> و همچنین در حالی که با او صحبت میکنید خونسردی خود را حفظ کنید , ومشکل خود را با مولتی هانتر در میان بگذارید
</p>
 <small><i>با احترام تیم تراوین</i></small></p>';
$Definition['inGame']['bannedPage'] = '
سلام   %s!
<br><br>
شما به دلیل تخلف از قوانین ممنوع و بازداشت شده اید. هر بازیکن مجاز است که تنها یک حساب کاربری یک حساب کاربری در هر سرور داشته باشد.

</br></br> برای اطمینان از اینکه شما دوباره در آینده ممنوع و مسدود نخواهید شد این  است،که شما باید قوانین را به دقت مطالعه کنید:
</br></br><center><a href="http://' . WebService::getJustDomain() . 'spielregeln.php">» قوانین بازی</a> </center>
</br></br></br>
برای ادامه بازی خود با مولتی هانتر تماس بگیرید و با کمال احترام دلیل را از او بپرسید .
</br></br><center>  <a href="messages.php?t=1&id=2">» نوشتن پیام</a> </center>
</br></br>
اما ممکن است به یکی از دلایل زیر این اتفاق افتاده باشد:
</br></br>
● همیشه دلیلی برای ممنوعیت وجود دارد. سعی کنید در مورد دلایل ممکن برای این ممنوعیت فکر کنید و مسائل را بی پرده و با مولتی هانتر تماس بگیرید.
</br>
● مولتی هانتر ها می تواند مقدار زیادی از اطلاعات مربوط به حساب شما را بررسی کنند. <u>توسط مموری استیک</u> و شما نباید بهانه ای  برای توجیه تخلفتان  از قوانین بگیرید.
</br>
● خوش لحن بودن و صبور بودن، این ممکن است مجازات را کاهش دهد .
</br>
● اگر مولتی هانتر بلافاصله پاسخ ندهد،   او احتمالا آنلاین نیست. و این مسئله  با ارسال چندین پیام پی در پی  حل و فصل  نمیشود، به خصوص او  میتواند حتی از خواندن نامه هایی که موضوع ندارن خوداری کند .
</br>
● اگر شما واقعا به ناحق ممنوع (بن) شده است <u>سعی کنید آرامش خود را حفظ کنید و مودب باشید</u> و همچنین در حالی که با او صحبت میکنید خونسردی خود را حفظ کنید , ومشکل خود را با مولتی هانتر در میان بگذارید
</p>
 <small><i>با احترام تیم تراوین</i></small></p>';
$Definition['inGame']['bannedSmallPage'] = 'شما به دلیل تخلف از قوانین ممنوع و بازداشت شده اید.';
$Definition['inGame']['bannedClickPage'] = '
<h2>سلام %s,</h2>
<br/>
<center><b>اکانت شما مسدود شده است</b>
    <br>
</center>
<div>این ممکن است به دلیل تعداد کلیلک های بالا اتفاق افتاده باشد که موقتی خواهد بود, در اینصورت ظرف مدت 5 ثانیه این مشکل خود به خود حل میشود.
    <br>
    <br>اما ممکن است به یکی از دلایل زیر این اتفاق افتاده باشد:
    <br>
    <br>
    <li>استفاده از اسکریپت های غیر قانونی</li>
    <li>پوشینگ</li>
    <li>اسپم</li>
    <li>فحاشی به سایر بازیکنان</li>
    <li>تلاش برای هک کردن سیستم</li>
    <br>
    <br>برای اطلاعات بیشتر با <a href="messages.php?t=1&id=4">مولتی هانترها</a> یا <a href="messages.php?t=1&id=1">پشتیبانی</a> تماس بگیرید و یا به ادمین از طریق <b>chamirhossein@gmail.com</b> ایمیل بفرستید
    <br>
    <br>با تشکر</div>
';
$answersUrl = getAnswersUrl();
$Definition['inGame']['QUEST_MESSAGE_SUBJECT'] = 'نکاتی برای شروع بازی';
$Definition['inGame']['QUEST_MESSAGE'] = <<<HTML
سلام %s،<br /><br />
تراوین یک بازی سلطه از طریق استراتژی و دیپلماسی است. در اول باید در مقابل دیگر
بازیکنان ایستادگی کرد. به دنبال متحدان برای رسیدن به اهداف خود باشید. حتی قوی
ترین بازیکنان نیاز به کمک دارند.
<br /><br />
هدف بازیکنان این است که همیشه برای زنده ماندن و رشد می کنند. به منظور ساده شدن و
فهم بهتر بازی سیستم وظایف شما را یاری خواهد کرد. منابع خود را از همسایگان حریص
خود در امان نگه دارید. شما می توانید برخی از راهنمایی های اضافه را اینجا پیدا
کنید: <a href="{$answersUrl}index.php?aid=104#go2answer">راهنمایی کنید من فارم هستم!</a>
<br /><br />
در آغاز، شما اغلب می توانید از حملات دشمن جلوگیری کنید، با این حال شما باید از
خود در برابر تسخیر دهکده های خود دفاع کنید. بدون نیرو، شما قادر نخواهید بود نه
به خودتان و نه متحدان شما کمک کنید. اطلاعات بیشتر اینجا یافت می شود: <a href="{$answersUrl}index.php?aid=172#go2answer">لشکریان</a>
<br /><br />
هنگامی که گرد و غبار شدید پس از جنگ اول فرونشست، قوی ترین اتحاد ها برای کنترل کردن سرزمین های بزرگتری جنگ خواهند کرد. آنها اتحاد ها و رقیب های یکدیگر را نابود خواهند کرد. اتحاد های قوی در آینده کنترل کتیبه ها را در اختیار خواهند گرفت و بعد شروع به ساخت شگفتی جهان خواهند کرد.
<br /><br />
اهداف خود را نسبت به زمانی که برای بازی اختصاص می دهید انتخاب کنید - هر مقدار که اهداف بالاتری داشته باشید زمان بیشتری برای ساخت و ساز و جنگ نیاز خواهید داشت.
<br /><br />
اما به اندازه کافی صحبت کردم! به همراه دوستان قدیمی و جدید خود به جنگ دشمنان بروید - و در کنار یکدیگر لذت ببرید.
HTML;
//
$Definition['links']['These links are found helpful by many players Add them to your personal link list'] = 'این لینک ها لینک هایی هستند که توسط بازیکنان بیشتر مورد استفاده بوده اند. شما می توانید آنها را به لیست لینک های خود اضافه کنید.';
$Definition['links']['Recommended links'] = 'لینک های پیشنهادی';
$Definition['links']['recommenced_links'] = [
    [
        'name' => 'پاسخ های تراوین', 'url' => getAnswersUrl().'*',
    ], [
        'name' => 'دیدکلی دهکده', 'url' => 'dorf3.php?s=0',
    ], [
        'name' => 'دیدکلی انبارها', 'url' => 'dorf3.php?s=3',
    ], [
        'name' => 'گزارشات اتحاد', 'url' => 'allianz.php?s=3',
    ], [
        'name' => 'گزارشات اطراف', 'url' => 'reports.php?t=5',
    ], [
        'name' => 'تنظیمات', 'url' => 'options.php',
    ], [
        'name' => 'انجمن', 'url' => getForumUrl().'*',
    ],
];
$Definition['links']['Define often-used pages as direct links Place a * at the end of the link and it will be opened in a new tab'] = 'صفحاتی که بیشتر بازدید می کنید را به لینک های مستقیم اضافه کنید. با اضافه کردن یک * در آخر لینک، لینک در صفحه جدید باز خواهد شد.';
$Definition['links']['Delete entry'] = 'حذف ورودی';
$Definition['links']['add entry'] = 'افزودن ورودی';
$Definition['links']['No'] = 'ردیف';
$Definition['links']['Link Name'] = 'نام لینک';
$Definition['links']['Link Target'] = 'هدف لینک';
$Definition['links']['Link list'] = 'لینک ها';
$Definition['links']['linkWillOpenInNewTab'] = 'لینک در صفحه جدید بازخواهد شد.';
$Definition['links']['edit link list'] = 'لیست لینک ها را ویرایش کنید.';
$Definition['links']['Travian Plus allows you to make a link list'] = 'تراوین پلاس به شما این امکان را می دهد که لیستی از لینک ها بسازید.';
//
$Definition['Login']['Server will start in'] = 'شروع سرور در: ';
$Definition['Login']['registrationSuccessful'] = 'ثبت نام شما موفقیت آمیز بود. به محض شروع سرور ما ایمیلی به ایمیل شما ارسال خواهیم کرد.';
$Definition['Login']['registrationSuccessful'] .= 'منتظر ایمیل تایید باشید. ';
$Definition['Login']['Login'] = 'ورود';
$Definition['Login']['Welcome'] = 'به سرور %s خوش آمدید.';
$Definition['Login']['noJavascript'] = 'در مرورگر شما JavaScript غیرفعال می‌باشد. برای اینکه قادر به بازی باشید باید از تنظیمات مرورگر خود JavaScript را فعال کنید';
$Definition['Login']['accountNameOrEmailAddress'] = 'نام اکانت یا آدرس ایمیل';
$Definition['Login']['pass'] = 'رمز عبور';
$Definition['Login']['lowResOption'] = 'ویرایش برای بازیکن';
$Definition['Login']['lowRes'] = 'با پهنای باند کمتر (سرعت اینترنت کمتر)';
$Definition['Login']['lowResInfo'] = '(توجه: این ویرایش نقشه تمامی امکان‌های ممکن را ندارد)';
$Definition['Login']['Captcha'] = 'کد امنیتی';
$Definition['Login']['CaptchaError'] = 'کد امنیتی صحیح نیست یا وارد نشده است.';
$Definition['Login']['PasswordForgotten?'] = 'رمز عبور خود را فراموش کرده اید؟';
$Definition['Login']['We will send you a new password It will be activated as soon as you confirm receipt?'] = 'ما برای شما رمز جدیدی ارسال خواهیم کرد. به محض اینکه دریافت نامه را تایید کنید رمز فعال خواهد شد.';
$Definition['Login']['Request new CAPTCHA'] = 'درخواست کد امنیتی جدید';
$Definition['Login']['Email'] = 'ایمیل';
$Definition['Login']['Request password'] = 'درخواست رمز عبور';
$Definition['Login']['Sent to'] = 'رمز عبور جدید به این آدرس ایمیل ارسال شد';
$Definition['Login']['EmailEmpty'] = 'ایمیل خالی است.';
$Definition['Login']['PasswordChangedSuccessfully'] = 'رمز عبور با موفقیت تغییر یافت.';
$Definition['Login']['PasswordFail'] = 'رمز عبور تغییر نیافت. ممکن است کد قبلا استفاده شده باشد.';
$Definition['Login']['pw_forgot_email'] = nl2br('
<div style="direction: rtl; text-align: right">
سلام %s
شما درخواست رمز عبور جدیدی برای اکانت تراوین خود کرده اید. شما میتوانید رمز جدید را با توجه به این ایمیل پیدا کنید:
---------------------------------------------------------------------------------------------------------------------------------

اطلاعات دسترسی شما:
نام اکانت: %s
آدرس ایمیل %s
رمز: %s
جهان بازی: %s

---------------------------------------------------------------------------------------------------------------------------------
روی لینک زیر کلیک کنید تا رمز اکانت شما تغییر کند:
<a href="%s">%s</a>
اگر می خواهید رمز خود را تغییر دهید می توانید از بخش تنظیمات اکانت اقدام کنید.
اگر شما این درخواست را ندادید این ایمیل را نادیده بگیرید.

تیم تراوین شما
</div>
Impressum:
Travian Games GmbH, Wilhelm-Wagenfeld-Str. 22, 80807 München, Deutschland
Tel: +49 (0)89 3249150, Fax: +49 (0)89 324915970, www.traviangames.de
CEO: Siegfried Müller
commercial court: Amtsgericht München, HRB 173511,
tax number: DE 246258085');
$Definition['Login']['userErrors'] = [];
$Definition['Login']['userErrors']['empty'] = 'نام را وارد کنید.';
$Definition['Login']['userErrors']['notFound'] = 'این لاگین موجود نیست.';
$Definition['Login']['pwErrors'] = [];
$Definition['Login']['pwErrors']['empty'] = 'رمز عبور را وارد کنید.';
$Definition['Login']['pwErrors']['wrong'] = 'رمز عبور وارد شده صحیح نیست.';
$Definition['Login']['pwErrors']['error21Days'] = 'این بازیکن بیش از 21 روز است که داخل بازی نشده است. شما به عنوان جانشین نمی توانید وارد اکانت شوید.';
//
$Definition['Logout'] = ["Logout" => "خروج موفقیت آمیز.",
    "delete_cookies" => "پاک کردن کوکی ها",
    "thanks_for_your_visit" => 'با تشکر از بازدید شما',
    "cookieDesc" => "اگر افراد دیگری نیز از این کامپیوتر استفاده می کنند، شما باید کوکی ها را برای امنیت بیشتر خود پاک کنید",
    "back_to_the_game" => "بازگشت به بازی",
];
//
$Definition['Manual'] = ['fightingStrength' => "قدرت حمله",
    "fightingStrengthAgainstInf" => "قدرت دفاع در برابر پیاده نظام",
    'fightingStrengthAgainstCav' => "قدرت دفاع در برابر سواره نظام",
    "speed" => "سرعت",
    "CarrySize" => "قابلیت حمل",
    "TravianAnswers" => "پاسخ های تراوین",
    "moreInTravianAnswers" => "اطلاعات بیشتر در سایت پاسخ‌های تراوین",
    "durationOfTraining" => "مدت زمان تربیت",
    "fieldsPerHour" => "خانه در ساعت",
    "preRequests" => "پیش نیاز ها",
    "toOverview" => "به دید کلی", "None" => "هیچ",
    "and" => "و",
    "construction_time" => "زمان ساخت", "for" => "برای",
    "level" => "سطح",
    "BuildingPlan" => "نقشه ساخت",
    "Capital" => "پایتخت",
    "onlyForTribe" => "برای نژاد",
    "Units" => "لشکریان",
];
//
$Definition['map'] = ["player" => "بازیکن",
    "alliance" => "اتحاد",
    "owner" => "صاحب",
    "Tribe" => "نژاد",
    "Village" => "دهکده",
    "Annex Oasis" => "تسخیر آبادی",
    "sendTroops" => "لشکرکشی",
    "no free slots" => "عمارت قهرمان فضای خالی ندارد.",
    "distribution" => "تقسیم زمین",
    "pop" => "جمعیت",
    "capital" => "پایتخت",
    'x is under protection to y' => 'این بازیکن تا %s تحت حمایت است.',
    'banned' => 'این بازیکن به دلیل نقص قوانین بازداشت شده است.',
    'sendMerchants' => 'ارسال تاجران',
    "constructMarketplace" => "بازار بساز.",
    "readySettlers" => "مهاجران آماده",
    "foundNewVillage" => "بنای دهکده جدید",
    "culturePointsForNewVillage" => "حداقل امتیاز فرهنگی برای بنای دهکده جدید ",
    "noResourcesForNewVillage" => "منابع کافی نیست (حداقل 750 واحد از هر منبع)",
    "Add to farm list" => "افزودن به لیست فارم",
    "noFarmList" => "فارم لیستی برای این دهکده وجود ندارد. اول یک فارم لیست بسازید.",
    "Edit farm list (Oasis already in farm list x)" => "ویرایش لیست فارم (آبادی در لیست فارم %s موجود است.)",
    "Edit farm list (Village already in farm list x)" => "ویرایش لیست فارم (دهکده در لیست فارم %s موجود است.)",
    "move up" => "حرکت به بالا",
    "move down" => "حرکت به پایین",
    "move right" => "حرکت به راست",
    "move left" => "حرکت به چپ",
    "for this feature you need the goldclub actived" => "برای استفاده از این قابلیت شما به کلوپ طلایی فعال نیاز دارید.",
    "vacationModeActive" => "این بازیکن در حال حاظر در تعطیلات است.",
    'noUnits' => 'هیچ.',
    'units' => 'لشکریان',
    'Bonus' => 'امتیاز',
    'Reports' => 'گزارش ها',
    'Surrounding' => 'اطراف',
    'fields' => 'خانه',
    'Distance' => 'فاصله',
    'Other Information' => 'اطلاعات دیگر',
    'Simulate raid' => 'شبیه سازی جنگ',
    'No information<br>available!' => 'هیچ اطلاعاتی <br>دردسترس نیست!',
    'landscape_desc' => 'سرزمین نامسکون (غیر قابل سکونت) ',
    'centerMap' => 'مرکز نقشه',
    'constructRallyPoint' => 'اردوگاه بساز.',
    'startAdventure' => 'آغاز ماجراجویی',
    "mark_not_found" => "فهرست یافت نشد.",
    "ok" => "تایید",
    "markAlliance" => "علامت اتحاد",
    "markPlayer" => "علامت بازیکن",
    "markField" => "علامت خانه",
    "players" => "بازیکن ها",
    "please_resend_all_data" => "تمامی اطلاعات لازم ارسال نشده است. لطفا با دوباره تلاش کنید.",
    "alliances_mark_exists" => "این اتحاد قبلا فهرست شده است.",
    "player_mark_exists" => "این بازیکن قبلا فهرست شده است.",
    "invalid_coordinates" => "مختصات اشتباه است.",
    "colour_does_not_exists" => "رنگ یافت نشد.",
    "no_alliance_map_mark_error" => "این بازیکن در اتحادی نمی باشد. در نتیجه این اتحاد فهرست نمی شود.",
    "map" => "نقشه",
    "zoomIn" => "افزایش زوم",
    "zoomOut" => "کاهش زوم",
    "zoomLevel" => "سطح بزرگنمایی",
    "filter" => "فیلتر",
    "showAllianceMarks" => "نمایش علامت های اتحاد",
    "hideAllianceMarks" => "عدم نمایش علامت های اتحاد",
    "showUserMarks" => "نمایش علامت های بازیکن",
    "hideUserMarks" => "عدم نمایش علامت های بازیکن",
    "minimap" => "نقشه کوچک",
    "outline" => "فهرست مطالب",
    "users" => "بازیکن ها",
    "population" => "جمعیت",
    "tribe" => "نژاد",
    "village" => "دهکده",
    "loadingData" => "بارگزاری...",
    "landscape" => "سرزمین متروکه",
    "freeOasis" => "آبادی تسخیر نشده",
    "occupiedOasis" => "آبادی تسخیر شده",
    "natarsVillage" => "دهکده ناتار ها",
    "bounty" => "غنائم",
    "difficulty" => "دشواری",
    "arrival" => "رسیدن در",
    "supply" => "نیروی کمکی",
    "spy" => "جاسوسی",
    "return" => "بازگشت",
    "raid" => "غارت",
    "attack" => "حمله",
    "save" => "ذخیره",
    "cancel" => "لغو",
    'flags' => "نشانه ها",
    "Adventure" => "ماجراجویی",
    "normal" => "معمولی",
    "hard" => "سخت",
    "ownPlayerMarkTitle" => "علامت های بازیکن های خودی.",
    "ownAllianceMarks" => "علامت های اتحاد های خودی",
    "ownFlags" => "علامت های خودی.",
    "allianceMarkTitle" => 'علامت گذاری اتحاد برای اتحاد من',
    "playerMarksTitle" => "علامت گذاری بازیکن برای اتحاد من",
    "allianceFlags" => 'علامت گذاری خانه برای اتحاد من',
    "largeMap" => "نقشه بزرگ",
    "needPlus" => "برای استفاده از این قابلیت به اکانت پلاس فعال نیاز دارید.",
    "cropFinder" => "گندم یاب",
    "needClub" => "برای استفاده از این قابلیت نیاز به کلوپ طلایی فعال دارید.",
    "YouAreBanned" => "اکانت شما بازداشت شده است به همین دلیل قادر به انجام این کار نیستید.",
    "YouAreInVacationMode" => "اکانت شما در حالت تعطیلات است، به همین دلیل قادر به انجام این کار نیستید.",
    "YouAreProtected" => "شما در حمایت تازه واردین بسر می برید، به همین دلیل قادر به انجام این کار نیستید.",
    'mapFlagsLimitReached' => 'شما 5 پرچم ثبت کرده اید. برای ادامه یکی از آنها را پاک کرده و دوباره امتحان کنید.',
    'mapMarksLimitReached' => 'شما 5 علامت ثبت کرده اید. برای ادامه یکی از آنها را پاک کرده و دوباره امتحان کنید.',
];
//
$Definition['MarketPlace']['While you are in beginners protection you are only allowed to do a 1:1 or better trade'] = 'در زمان حمایت برای تجارت بهتر شما تنها قادر به پذیرش درخواست های 1:1 می باشید.';
$Definition['MarketPlace']['x\'s offering has been accepted'] = 'پیشنهاد %s پذیرفته شد.'; //new
$Definition['MarketPlace']['are on their way to you'] = 'در راه آمدن به سمت شما هستند.';
$Definition['MarketPlace']['have been dispatched by your merchants'] = 'توسط تاجران شما ارسال شد.';
$Definition['MarketPlace']['Management'] = 'مدیریت';
$Definition['MarketPlace']['SendResources'] = 'ارسال منابع';
$Definition['MarketPlace']['resourcesSent'] = 'منابع ارسال شدند.';
$Definition['MarketPlace']['sitterNoPermissions'] = 'به عنوان جانشین شما اجازه ارسال منابع به دهکده های دیگری را ندارید.';
$Definition['MarketPlace']['sameVillage'] = 'به دهکده خود نمی توانید منابع بفرستید.';
$Definition['MarketPlace']['Buy'] = 'خرید';
$Definition['MarketPlace']['Offer'] = 'پیشنهاد';
$Definition['MarketPlace']['Delete'] = 'حذف';
$Definition['MarketPlace']['Select x as favor tab'] = 'انتخاب صفحه %s به عنوان صفحه مورد علاقه.';
$Definition['MarketPlace']['you are in vacationMode'] = 'شما درحالت تعطیلات قرار دارید.';
$Definition['MarketPlace']['This tab is set as favourite'] = 'این صفحه به عنوان صفحه مورد علاقه انتخاب شده است.';
$Definition['MarketPlace']['Free merchants'] = 'تاجران موجود';
$Definition['MarketPlace']['Own merchants and NPC'] = 'تاجران خودی و تعدیل منابع';
$Definition['MarketPlace']['Merchants offering resources'] = 'تاجران در حال فروش منابع';
$Definition['MarketPlace']['you are banned'] = 'شما به علت نقص قوانین بازداشت شده اید.';
$Definition['MarketPlace']['Merchants underway'] = 'تاجران در راه';
$Definition['MarketPlace']['Exchange resources'] = 'تعدیل منابع';
$Definition['MarketPlace']['Trade routes'] = 'مسیر های تجارت';
$Definition['MarketPlace']['Create new trade route'] = 'ساخت مسیر تجارت جدید';
$Definition['MarketPlace']['Start'] = 'شروع';
$Definition['MarketPlace']['Merchants'] = 'تاجر ها';
$Definition['MarketPlace']['Action'] = 'اقدام';
$Definition['MarketPlace']['GoldClub'] = 'کلوپ طلایی';
$Definition['MarketPlace']['Description'] = 'توضیحات';
$Definition['MarketPlace']['Trade route to x'] = 'مسیر تجارت به %s';
$Definition['MarketPlace']['edit'] = 'ویرایش';
$Definition['MarketPlace']['cancel'] = 'لغو';
$Definition['MarketPlace']['Resources'] = 'منابع';
$Definition['MarketPlace']['Target village'] = 'دهکده هدف';
$Definition['MarketPlace']['Target'] = 'هدف';
$Definition['MarketPlace']['all'] = 'همه';
$Definition['MarketPlace']['only mine'] = 'فقط من';
$Definition['MarketPlace']['others'] = 'دیگران';
$Definition['MarketPlace']['Show villages in list'] = 'نمایش دهکده ها در لیست';
$Definition['MarketPlace']['Start time'] = 'زمان شروع';
$Definition['MarketPlace']['nextTradeRoute'] = 'مسیر تجارت بعدی در ساعت %s نیاز به %s تاجر دارد.';
$Definition['MarketPlace']['not enough merchants'] = 'تاجر کافی ندارید.';
$Definition['MarketPlace']['offer added successfully'] = 'پیشنهاد با موفقیت ثبت شد.';
$Definition['MarketPlace']['own alliance only'] = 'فقط اتحاد خودی';
$Definition['MarketPlace']['max, time of transport'] = 'حداکثر زمان';
$Definition['MarketPlace']["Own offers"] = 'پیشنهاد های خودی';
$Definition['MarketPlace']["I'm searching"] = 'جستجو';
$Definition['MarketPlace']["Alliance"] = 'اتحاد';
$Definition['MarketPlace']["hours"] = 'ساعت.';
$Definition['MarketPlace']["accept offer"] = 'پذیرش پیشنهاد';
$Definition['MarketPlace']["yes"] = 'بله';
$Definition['MarketPlace']["no"] = 'خیر';
$Definition['MarketPlace']["Offers at the marketplace"] = 'پیشنهادهای موجود در بازار';
$Definition['MarketPlace']["Offered to me"] = 'پیشنهاد شده به من';
$Definition['MarketPlace']["Wanted from me"] = 'درخواست شده از من';
$Definition['MarketPlace']["Player"] = 'بازیکن';
$Definition['MarketPlace']["Duration"] = 'مدت زمان';
$Definition['MarketPlace']["Action"] = 'عمل';
$Definition['MarketPlace']["onReturnMerchants"] = 'تاجران درحال بازگشت';
$Definition['MarketPlace']["onReturnMerchants"] = 'تاجران درحال بازگشت';
$Definition['MarketPlace']["onComingMerchants"] = 'تاجران در حال آمدن';
$Definition['MarketPlace']["onGoingMerchants"] = 'تاجران درحال رفتن';
$Definition['MarketPlace']["noResourcesEntered"] = 'منبعی انتخاب نشده است.';
$Definition['MarketPlace']["noVillageWithName"] = 'دهکده ای با این نام یافت نشد.';
$Definition['MarketPlace']["noVillageInCoordinate"] = 'در این مختصات دهکده ای یافت نشد.';
$Definition['MarketPlace']["enterVillageNameOrCoordinate"] = 'مختصات یا نام دهکده را وارد کنید.';
$Definition['MarketPlace']["PlayerBanned"] = 'این بازیکن به دلیل نقص قوانین بازداشت شده است.';
$Definition['MarketPlace']["serverFinished"] = 'بازی در این سرور به پایان رسیده است.';
$Definition['MarketPlace']["go"] = 'برو';
$Definition['MarketPlace']["goBack"] = 'تغییر مقادیر';
$Definition['MarketPlace']["or"] = 'یا';
$Definition['MarketPlace']["Village"] = 'دهکده';
$Definition['MarketPlace']["Arrival"] = 'رسیدن در';
$Definition['MarketPlace']["in"] = 'تا';
$Definition['MarketPlace']["hour"] = 'ساعت';
$Definition['MarketPlace']["at"] = 'در';
$Definition['MarketPlace']["sendToVillage"] = 'ارسال به دهکده';
$Definition['MarketPlace']["returnFromVillage"] = 'بازگشت از دهکده';
$Definition['MarketPlace']["receiveFromVillage"] = 'دریافت از دهکده';
$Definition['MarketPlace']["Each of your merchants can carry"] = 'هر کدام از تاجران شما قادر به حمل';
$Definition['MarketPlace']["Each of your merchants can carry resources"] = 'منابع هستند.';
$Definition['MarketPlace']["prepare"] = 'آماده کردن';
$Definition['MarketPlace']["noOffers"] = 'هیچ پیشنهادی موجود نیست';
$Definition['MarketPlace']["I'm offering"] = 'پیشنهاد';
$Definition['MarketPlace']['not enough resources'] = 'منابع کافی نیست.';
$Definition['MarketPlace']['Unable to create offer; maximum ratio allowed is 2:1'] = 'امکان ایجاد پیشنهاد نمی‌باشد. حداکثر ضریب تفاوت باید 2:1 (1ب2) باشد.';
$Definition['MarketPlace']['Search'] = 'جستجو';
$Definition['MarketPlace']['Deliveries'] = 'تعداد';
$Definition['MarketPlace']['noRoute'] = 'مسیر تجارتی افروده نشده است.';
$Definition['MarketPlace']['Create new trade route'] = 'ساخت مسیر تجارت جدید';
$Definition['MarketPlace']['notEnoughMerchants'] = "تاجر کافی ندارید. به [MERCHANTS_NEEDED] تاجر نیاز دارید ولی تنها [MERCHANTS_AVAILABLE] تاجر موجود می‌باشد.";
$Definition['MarketPlace']['tradeRouteDesc'] = 'کلوپ طلایی به شما امکان استفاده از مسیر های تجارت را می دهد. با این قابلیت می توانید به صورت خودکار منابع بین دهکده های خود منابع جابجا کنید.';
$Definition['MarketPlace']['Enabled'] = 'فعال';
$Definition['MarketPlace']['needToBeActive'] = 'برای استفاده از این قابلیت نیاز به کلوپ طلایی فعال دارید.';
$Definition['MarketPlace']['Click here to exchange resources'] = 'برای تعدیل منابع اینجا کلیک کنید.';
$Definition['MarketPlace']['Trade your village\'s resources immediately with NPC merchant 1:1'] = 'تعدیل منابع این دهکده بصورت 1:1 و مساوی.';
$Definition['MarketPlace']['Send time'] = 'زمان ارسال';
$Definition['MarketPlace']['every %s minutes'] = 'هر %s دقیقه';
$Definition['MarketPlace']['every %s hours'] = 'هر %s ساعت';
$Definition['MarketPlace']['every %s days'] = 'هر %s روز';
$Definition['MarketPlace']['You are under protection'] = 'درزمان حمایت امکان ارسال منابع وجود ندارد.';
//
$Definition['Medals']['Category'] = 'ردیف';
$Definition['Medals']['Week'] = 'هفته';
$Definition['Medals']['Rank'] = 'رتبه';
$Definition['Medals']['Resources'] = 'منابع';
$Definition['Medals']['Points'] = 'امتیاز';
$Definition['Medals']['Received in week:'] = 'دریافت در هفته: ';
$Definition['Medals']['category15'] = 'دریافت این مدال نشان می دهد شما برای %s بار بین 10 نفر اول تاپ غارتگران بوده اید.';
$Definition['Medals']['category9'] = 'دریافت این مدال نشان می دهد شما برای %s بار بین 3 نفر اول تاپ غارتگران بوده اید.';
$Definition['Medals']['category14'] = 'دریافت این مدال نشان می دهد شما برای %s بار بین 10 نفر اول تاپ پیشرفت کنندگان هفته بوده اید.';
$Definition['Medals']['category8'] = 'دریافت این مدال نشان می دهد شما برای %s بار بین 3 نفر اول تاپ پیشرفت کنندگان بوده اید.';
$Definition['Medals']['category7'] = 'دریافت این مدال نشان می دهد شما برای %s بار بین 3 نفر اول تاپ مدافعین بوده اید.';
$Definition['Medals']['category13'] = 'دریافت این مدال نشان می دهد شما برای %s بار بین 10 نفر اول تاپ مهاجمین بوده اید.';
$Definition['Medals']['category12'] = 'دریافت این مدال نشان می دهد شما برای %s بار بین 10 نفر اول تاپ مهاجمین بوده اید.';
$Definition['Medals']['category6'] = 'دریافت این مدال نشان می دهد شما برای %s بار بین 3 نفر اول تاپ مهاجمین بوده اید.';
$Definition['Medals']['category5'] = 'دریافت این مدال نشان می دهد شما %s بار در هفته هم بین مهاجمین و هم بین مدافعین بوده اید.';
$Definition['Medals']['names'] = [];
$Definition['Medals']['names'][1] = 'مهاجمین هفته';
$Definition['Medals']['names'][2] = 'مدافعین هفته';
$Definition['Medals']['names'][3] = 'پیشرفت کننده های هفته';
$Definition['Medals']['names'][4] = 'غارتگران هفته';
$Definition['Medals']['names'][5] = 'رده میان 10 نفر اول مهاجمین و مدافعین';
$Definition['Medals']['names'][6] = 'رده میان 3 نفر اول مهاجمین';
$Definition['Medals']['names'][12] = 'رده میان 10 نفر اول مهاجمین';
$Definition['Medals']['names'][7] = 'رده میان 3 نفر اول مدافعین';
$Definition['Medals']['names'][13] = 'رده میان 10 نفر مدافعین';
$Definition['Medals']['names'][8] = 'رده میان 3 نفر اول پیشرفت کنندگان';
$Definition['Medals']['names'][14] = 'رده میان 10 نفر اول پیشرفت کنندگان';
$Definition['Medals']['names'][9] = 'رده میان 3 نفر اول غارتگران';
$Definition['Medals']['names'][15] = 'رده میان 10 نفر اول غارتگران';
$Definition['Medals']['SpecialMedals'] = [
    // Ranke Wonder Of World
    1 => '<span class="gloriatitle">مسابقات قهرمانی</span><div class="gloriacontent">کشور: %s<br>سرور: %s<br>دسته: شگفتی جهان<br>نام: %s<br>نژاد: %s<br>رتبه: 1<br>سطح شگفتی جهان: %s</div>',
    2 => '<span class="gloriatitle">مسابقات قهرمانی</span><div class="gloriacontent">کشور: %s<br>سرور: %s<br>دسته: شگفتی جهان<br>نام: %s<br>نژاد: %s<br>رتبه: 2<br>سطح شگفتی جهان: %s</div>',
    3 => '<span class="gloriatitle">مسابقات قهرمانی</span><div class="gloriacontent">کشور: %s<br>سرور: %s<br>دسته: شگفتی جهان<br>نام: %s<br>نژاد: %s<br>رتبه: 3<br>سطح شگفتی جهان: %s</div>',

    // Ranke Offensive 1 ta 4 top 10
    4 => '<span class="gloriatitle">مسابقات قهرمانی</span><div class="gloriacontent">کشور: %s<br>سرور: %s<br>دسته: قوی ترین مهاجم<br>نام: %s<br>نژاد: %s<br>رتبه: 1<br>امتیازها: %s</div>',
    5 => '<span class="gloriatitle">مسابقات قهرمانی</span><div class="gloriacontent">کشور: %s<br>سرور: %s<br>دسته: قوی ترین مهاجم<br>نام: %s<br>نژاد: %s<br>رتبه: 2<br>امتیازها: %s</div>',
    6 => '<span class="gloriatitle">مسابقات قهرمانی</span><div class="gloriacontent">کشور: %s<br>سرور: %s<br>دسته: قوی ترین مهاجم<br>نام: %s<br>نژاد: %s<br>رتبه: 3<br>امتیازها: %s</div>',
    7 => '<span class="gloriatitle">مسابقات قهرمانی</span><div class="gloriacontent">کشور: %s<br>سرور: %s<br>دسته: قوی ترین مهاجم<br>نام: %s<br>نژاد: %s<br>رتبه: 4<br>امتیازها: %s</div>',
    // Ranke Defensive 1 ta 4 top 10
    8 =>  '<span class="gloriatitle">مسابقات قهرمانی</span><div class="gloriacontent">کشور: %s<br>سرور: %s<br>دسته: قوی ترین مدافع<br>نام: %s<br>نژاد: %s<br>رتبه: 1<br>امتیازها: %s</div>',
    9 =>  '<span class="gloriatitle">مسابقات قهرمانی</span><div class="gloriacontent">کشور: %s<br>سرور: %s<br>دسته: قوی ترین مدافع<br>نام: %s<br>نژاد: %s<br>رتبه: 2<br>امتیازها: %s</div>',
    10 => '<span class="gloriatitle">مسابقات قهرمانی</span><div class="gloriacontent">کشور: %s<br>سرور: %s<br>دسته: قوی ترین مدافع<br>نام: %s<br>نژاد: %s<br>رتبه: 3<br>امتیازها: %s</div>',
    11 => '<span class="gloriatitle">مسابقات قهرمانی</span><div class="gloriacontent">کشور: %s<br>سرور: %s<br>دسته: قوی ترین مدافع<br>نام: %s<br>نژاد: %s<br>رتبه: 4<br>امتیازها: %s</div>',
    // Ranke Pop Nafarate Avale 1 ta 4
    12 => '<span class="gloriatitle">مسابقات قهرمانی</span><div class="gloriacontent">کشور: %s<br>سرور: %s<br>دسته: پیشرفت کننده <br>نام: %s<br>نژاد: %s<br>رتبه: 1<br>امتیازها: %s</div>',
    13 => '<span class="gloriatitle">مسابقات قهرمانی</span><div class="gloriacontent">کشور: %s<br>سرور: %s<br>دسته: پیشرفت کننده <br>نام: %s<br>نژاد: %s<br>رتبه: 2<br>امتیازها: %s</div>',
    14 => '<span class="gloriatitle">مسابقات قهرمانی</span><div class="gloriacontent">کشور: %s<br>سرور: %s<br>دسته: پیشرفت کننده <br>نام: %s<br>نژاد: %s<br>رتبه: 3<br>امتیازها: %s</div>',
    15 => '<span class="gloriatitle">مسابقات قهرمانی</span><div class="gloriacontent">کشور: %s<br>سرور: %s<br>دسته: پیشرفت کننده <br>نام: %s<br>نژاد: %s<br>رتبه: 4<br>امتیازها: %s</div>',
];
//
$Definition['Messages'] = [];
$Definition['Messages']['You cannot send a message to more than %s users'] = 'شما نمی توانید یک پیام را به بیش از %s کاربر ارسال کنید.';
$Definition['Messages']['spam_unread_protection'] = 'سیستم انتی اسپم: شما %s پیام خوانده نشده به این بازیکن ارسال کرده اید. شما نمی توانید پیام دیگری به این بازیکن ارسال کنید تا پیام های ارسالی قبلی شما توسط بازیکن خوانده شود یا 2 ساعت صبر کنید.';
$Definition['Messages']['Error: Very long subject!'] = 'مشکل: موضوع خیلی طولانی است.';
$Definition['Messages']['Spam protection: Please wait for 10 minutes and try again'] = '<b>سیستم ضد اسپم</b>: لطفا 10 دقیقه صبرکنید و دوباره امتحال کنید.';
$Definition['Messages']['You are currently not part of any alliance'] = 'شما درحال حاضر عضو اتحادی نیستید.';
$Definition['Messages']['Inadmissible message'] = 'پیام غیرقابل پذیرش است.';
$Definition['Messages']['Mark as read'] = 'علامت به عنوان خوانده شده';
$Definition['Messages']['Mark as unread'] = 'علامت به عنوان خوانده نشده';
$Definition['Messages']['reportingSuccessful'] = 'پیام با موفقیت گزارش شد.';
$Definition['Messages']['closeButtonText'] = 'بستن';
$Definition['Messages']['Messages'] = 'پیام ها';
$Definition['Messages']['Inbox'] = 'صندق ورودی';
$Definition['Messages']['needClub'] = 'برای استفاده از این قابلیت نیاز به کلوپ طلایی فعال دارید.';
$Definition['Messages']['Delete'] = 'حذف';
$Definition['Messages']['Subject'] = 'موضوع';
$Definition['Messages']['Sender'] = 'فرستنده';
$Definition['Messages']['Sent at'] = 'ارسال شده در';
$Definition['Messages']['Read'] = 'خوانده شده';
$Definition['Messages']['Your note is too long!'] = 'یادداشت شما خیلی طولانی است!';
$Definition['Messages']['Unread'] = 'خوانده نشده';
$Definition['Messages']['select all'] = 'علامت همه';
$Definition['Messages']['Recipient'] = 'دریافت کننده';
$Definition['Messages']['Choose reason'] = 'یک دلیل انتخاب کنید.';
$Definition['Messages']['Advertisement'] = 'تبلیغات';
$Definition['Messages']['harassment'] = 'آزار و اذیت';
$Definition['Messages']['gold'] = 'خرید طلا';
$Definition['Messages']['Other'] = 'دیگر';
$Definition['Messages']['report'] = 'گزارش';
$Definition['Messages']['Attention: Misuse of the report function is punishable'] = 'توجه: سوء استفاده قابل پیگیری و مجازات است.';
$Definition['Messages']['sender'] = 'فرستنده';
$Definition['Messages']['Report as spam'] = 'گزارش به عنوان هرزنامه';
$Definition['Messages']['back to send box'] = 'بازگشت به صندوق ارسال شده ها';
$Definition['Messages']['There are no messages available in the sentbox'] = 'هیچ پیامی در صندوق ارسال شده ها نیست.';
$Definition['Messages']['There are no messages available in the inbox'] = 'هیچ پیامی در صندوق ورودی موجود نیست.';
$Definition['Messages']['There are no messages available in the archive'] = 'هیچ پیامی آرشیو نشده است.';
$Definition['Messages']['waiting for confirmation'] = 'انتظار برای تایید';
$Definition['Messages']['Recover'] = 'بازیابی';
$Definition['Messages']['Addressbook'] = 'لیست دوستان';
$Definition['Messages']['send'] = 'ارسال';
$Definition['Messages']['Alliance'] = 'اتحاد';
$Definition['Messages']['xxx wrote:'] = '%s نوشت:';
$Definition['Messages']['You dont have permission here'] = 'شما اجازه دسترسی به این قسمت را ندارید.';
$Definition['Messages']['player x does not exists'] = 'بازیکن %s وجود ندارد.';
$Definition['Messages']['you send your last message in x and you will be able to send message in y'] = 'شما آخرین پیام خود را در %s ارسال کرده اید و قادر به ارسال پیام تا %s نمی باشید.';
$Definition['Messages']['no subject'] = 'بدون موضوع';
$Definition['Messages']['ConfirmDelete'] = 'آیا واقعاً مایل به حذف این پیغام هستید?';
$Definition['Messages']['answer'] = 'پاسخ';
$Definition['Messages']['Player'] = 'بازیکن';
$Definition['Messages']['Coordinates'] = 'مختصات';
$Definition['Messages']['report'] = 'گزارش';
$Definition['Messages']['Troops'] = 'لشکریان';
$Definition['Messages']['preview'] = 'پیش نمایش';
$Definition['Messages']['back to the inbox'] = 'بازگشت به صندوق ورودی';
$Definition['Messages']['Write'] = 'نوشتن';
$Definition['Messages']['Sent'] = 'صندق خروجی';
$Definition['Messages']['- saved -'] = '- ذخیره شد -';
$Definition['Messages']['Archive'] = 'آرشیو';
$Definition['Messages']['Notes'] = 'یادداشت ها';
$Definition['Messages']['Ignored players'] = 'بازیکن های نادیده گرفته شده';
$Definition['Messages']['online now'] = 'آنلاین';
$Definition['Messages']['active players'] = 'فعال حداکثر 10 دقیقه پیش';
$Definition['Messages']['active 3days'] = 'فعال حداکثر 3 روز پیش';
$Definition['Messages']['active 7days'] = 'فعال حداکثر 7 روز پیش';
$Definition['Messages']['inactive'] = 'غیر فعال';
$Definition['Messages']['Current message has already been reported as: x'] = 'این پیام به عنوان زیر گزارش شده است: %s';
$Definition['Messages']['Ambassador'] = 'سفیر';
$Definition['Messages']['Spam protection: You must have at least %s pop to be able to send messages'] = 'Spam protection: You must have at least %s pop to be able to send messages';
$Definition['Messages']['Alliance Invitation received'] = 'دعوت نامه دریافت شد.';
$Definition['Messages']['Alliance Invitation revoked'] = 'دعوت نامه لغو شد.';
$Definition['Messages']['AllianceInvitationReceiveText'] = 'سلام %s،
<br/><br/>
شما دعوت شدید توسط [player]%s[/player] تا به اتحاد [alliance]%s[/alliance] ملحق شوید.
<br/><br/>
موفق باشید و از بازی لذت ببرید.';
$Definition['Messages']['AllianceInvitationRevokeText'] = 'سلام %s،<br /><br />دعوت نامه شما برای ملحق شدن به اتحاد [alliance]%s[/alliance] توسط [player]%s[/player] لغو شد.<br /><br />موفق باشید و از بازی لذت ببرید.';
$Definition['Messages']['WrittenBySitter%s'] = '- نوشته شده از طرف جانشین %s -';
//
$Definition['notFound']['title'] = 'چیزی اینجا نیست!';
$Definition['notFound']['desc'] = 'ما 404 بار گشتیم اما چیزی پیدا نکردیم.';
//
$Definition['npc'] = ["disabled_in_ww" => "در دهکده شگفتی جهان قادر به استفاده از این قابلیت نمی باشید.",
    'npc_desc' => 'با تاجرهای تعدیل منابع، شما قادر به تجارت منابع در انبار خود به هر نحوی که دوست دارید هستید.<br /><br />در خط اول منابع موجود فعلی نمایش داده می شود و در خط دوم شما قادر به نوشتن نسبت دلخواه خود با توجه به منابع موجود می‌باشید. در خط سوم تفاضل میان مقادیر قبلی و جدید نمایش داده می‌شود.',
    'sum' => 'مجموع',
    'distribute_remaining_resources' => 'توضیع منابع باقی مانده',
    'exchangeResources' => 'تعدیل منابع',
    'redeem_now' => 'تعدیل منابع',
    'redeem' => 'تعدیل',
    'remain' => 'باقی مانده',
    "build_marketPlace" => "بازار بساز",
];
//
$Definition['Options']['Change name'] = 'تغییر نام';
$Definition['Options']['Yes'] = 'بله';
$Definition['Options']['No'] = 'خیر';
$Definition['Options']['You need to wait 7 days before deletion'] = 'متاسفانه شما نمی توانید درحال حاضر طلای خود را انتقال دهید. در صورتی که سوالی دارید با ';
$Definition['Options']['You need to wait 7 days before deletion'] .= 'plus@' .WebService::getJustDomain();
$Definition['Options']['You need to wait 7 days before deletion'] .= 'تماس بگیرید.';
$Definition['Options']['Newsletter'] = 'خبرنامه';
$Definition['Options']['sitter'] = 'جانشین';
$Definition['Options']['Sitter(s) for this account'] = 'جانشین های این اکانت';
$Definition['Options']['Sitting for other account(s)'] = 'جانشین برای اکانت های دیگر';
$Definition['Options']['Sitting for other account(s)Desc'] = 'اکانت‌های زیر شما را به عنوان جانشین خود انتخاب کرده‌اند. شما قادر به لغو جانشینی با کلیک بر روی علامت X قرمز رنگ می‌باشید.';
$Definition['Options']['MySittersDesc'] = 'جانشین با نام اکانت شما و با رمز خود قادر به وارد شدن به اکانت شما می‌باشد. شما حداکثر می‌توانید 2 جانشین برای خود انتخاب کنید.';
$Definition['Options']['no entry'] = 'وارد شده است.';
$Definition['Options']['Here you can subscribe or unsubscribe to our newsletter'] = 'اینجا شما میتوانید عضو خبرنامه ما شوید.';
$Definition['Options']['Travian Games'] = 'بازی های تراوین';
$Definition['Options']['invalid old email'] = 'ایمیل قبلی برابر نیست.';
$Definition['Options']['invalid new email'] = 'ایمیل جدید صحیح نیست.';
$Definition['Options']['Receive notifications about invitations to an alliance'] = 'دریافت اعلانات درباره دعوت نامه های اتحاد';
$Definition['Options']['new email exists'] = 'ایمیل جدید صحیح نیست.';
$Definition['Options']['Name black listed'] = 'این نام موجود نیست.';
$Definition['Options']['Name exists'] = 'نام موجود است.';
$Definition['Options']['Name too short'] = 'نام بسیار کوتاه است.';
$Definition['Options']['Name too long'] = 'نام بسیار طولانی است.';
$Definition['Options']['Please enter a new account name and confirmation password'] = 'لطفا نام جدید اکانت و رمز عبور را وارد کنید.';
$Definition['Options']['Confirmation password does not match'] = 'تایید رمز عبور با رمز اکانت یکی نیست.';
$Definition['Options']['Confirm with password'] = 'تایید با رمز';
$Definition['Options']['Change account name'] = 'تغییر نام اکانت';
$Definition['Options']['Number of changes'] = 'تعداد تغییرات';
$Definition['Options']['Enter new account name'] = 'نام جدید';
$Definition['Options']['changeNameDesc'] = 'اینجا شما قادر به تغییر نام اکانت خود هستید. شما نام اکانت خود را می توانید %s بار بصورت رایگان تا رسیدن به جمعیت %s تغییر دهید. بعد از آن تغییر نام اکانت %s طلا هزینه دارد.تغییر نام اکانت در جمعیت های %s و بالاتر ممکن نیست.';
$Definition['Options']['Change password'] = 'تغییر رمز عبور';
$Definition['Options']['Old Password'] = 'رمز عبور فعلی';
$Definition['Options']['New Password'] = 'رمز عبور جدید';
$Definition['Options']['confirm'] = 'تایید';
$Definition['Options']['Change email'] = 'تغییر ایمیل';
$Definition['Options']['Old email'] = 'ایمیل فعلی';
$Definition['Options']['New email'] = 'ایمیل جدید';
$Definition['Options']['Change email desc'] = 'لطفا ایمیل قبلی و ایمیل جدید خود را وارد کنید. بعد از این ایمیل به هر دو ایمیل ارسال خواهد شد که حاوی کد است.';
$Definition['Options']['Game'] = 'بازی';
$Definition['Options']['Account'] = 'اکانت';
$Definition['Options']['Delete account'] = 'حذف اکانت';
$Definition['Options']['Delete account?'] = 'حذف اکانت؟';
$Definition['Options']['Sitter'] = 'جانشین';
$Definition['Options']['Preferences'] = 'تنظیمات';
$Definition['Options']['Report filter'] = 'فیلتر گزارشات';
$Definition['Options']['Auto-complete'] = 'تکمیل خودکار';
$Definition['Options']['No reports about transfers between your own villages'] = 'عدم نمایش گزارشات بین دهکده های خودی.';
$Definition['Options']['No reports about transfers to foreign villages'] = 'عدم نمایش گزارشات به دهکده های دیگر.';
$Definition['Options']['No reports about transfers from foreign villages'] = 'عدم نمایش گزارشات از دهکده های دیگر.';
$Definition['Options']['The LowRes version does not display images in reports'] = 'نسخه کم مصرف عکس ها را در گزارشات نشان نمی دهد.';
$Definition['Options']['Complete for rally point and marketplace'] = 'تکمیل خودکار در اردوگاه و بازار';
$Definition['Options']['Own villages'] = 'دهکده های خودی';
$Definition['Options']['Nearby villages'] = 'دهکده های نزدیک';
$Definition['Options']["Alliance members' villages"] = 'دهکده های هم اتحادی';
$Definition['Options']["Display"] = 'نمایش';
$Definition['Options']["Don't display images in reports"] = 'عدم نمایش عکس ها در گزارشات';
$Definition['Options']["Messages and reports per page"] = 'تعداد نمایش در هر صفحه گزارشات و پیام ها';
$Definition['Options']["Troop movements per page in rally point"] = 'تعداد نمایش در هر صفحه اردوگاه';
$Definition['Options']["Time zone preferences"] = 'تنظیمات منطقه زمانی';
$Definition['Options']["You can change your time zone here"] = 'شما میتوانید منظقه زمانی خود را اینجا تغییر دهید.';
$Definition['Options']["Time zone"] = 'منطقه زمانی';
$Definition['Options']["Date format"] = 'تاریخ';
$Definition['Options']["local time zones"] = 'منطفه زمانی داخلی';
$Definition['Options']["general time zones"] = 'منطقه زمانی عمومی';
$Definition['Options']["change_mail_desc"] = 'یک ایمیل حاوی کد به هر دو ایمیل شما ارسال شد. آنها را اینجا وارد کنید.';
$Definition['Options']["Old email code"] = 'کد ایمیل قبلی';
$Definition['Options']["New email code"] = 'کد ایمیل جدید';
$Definition['Options']["x of y changes"] = '%s از %s بار';
$Definition['Options']["password wrong"] = 'رمز عبور اشتباه است.';
$Definition['Options']["deleteDesc"] = 'در این قسمت قادر به حذف اکانت خود می‌باشید. بعد از تایید، حذف اکانت شما 1 ساعت طول خواهد کشید.';
$Definition['Options']["codes are not correct"] = 'کد ها صحیح نیست.';
$Definition['Options']["email_changed"] = 'ایمیل با موفقیت تغییر کرد.';
$Definition['Options']["Email change is in progress"] = 'پروسه تغییر ایمیل موجود است.';
$Definition['Options']["EmailChange_new_subject"] = 'تغییر نام اکانت بخش 2';
$Definition['Options']["EmailChange_new"] = '
<div style="text-align: right; direction: RTL">
سلام %s،
شما این ایمیل را به عنوان ایمیل جدید برای اکانت خود در سرور %s انتخاب کرده اید. لطفا کد زیر را در قسمت کد ایمیل جدید در تنظیمات اکانت خود وارد کنید:

کد: %s

شما ایمیل دیگری دریافت خواهید کرد که کد اصلی شما در آن است. آن را در قسمت کد ایمیل قبلی وارد کنید.
</div>
';
$Definition['Options']["EmailChange_old_subject"] = 'تغییر نام اکانت بخش 1';
$Definition['Options']["EmailChange_old"] = '
<div style="text-align: right; direction: RTL">
سلام %s،
شما درخواست تغییر ایمیل برای اکانت تراوین در جهان %s کرده اید.
لطفا این کد را در قسمت کد ایمیل قبلی در قسمت تنظیمات اکانت وارد کنید.

کد: %s

شما ایمیل دیگری دریافت خواهید کرد که کد دوم در آن است آنرا در قسمت کد ایمیل جدید وارد کنید..
</div>';
$Definition['Options']['Vacation'] = 'تعطیلات';
$Definition['Options']['Use the vacation to protect your villages while being abroad'] = 'از سیستم تعطیلات برای محافظت از دهکده خود زمانی که نمی توانید بازی کنید استفاده کنید.';
$Definition['Options']['While in vacation mode the following actions will be deactivated'] = 'وقتی که سیستم تعطیلات فعال باشد شما قادر به انجام این کار ها نیستید';
$Definition['Options']['send or receive troops'] = 'ارسال/دریافت لشکریان';
$Definition['Options']['start new building orders'] = 'احداث ساختمان جدید';
$Definition['Options']['using the marketplace'] = 'استفاده از بازار';
$Definition['Options']['start training troops'] = 'تربیت سرباز';
$Definition['Options']['join alliances'] = 'ملحق شدن به اتحاد';
$Definition['Options']['delete your account'] = 'حذف اکانت';
$Definition['Options']['Alliance settings'] = 'تنظیمات اتحاد';
$Definition['Options']['Show alliance news'] = 'نمایش اخبار اتحاد';
$Definition['Options']['Alliance members founded new village'] = 'بنای دهکده توسط اعضای اتحاد';
$Definition['Options']['New alliance member joined'] = 'ورود عضو جدید';
$Definition['Options']['Player has been invited'] = 'دعوت بازیکن جدید';
$Definition['Options']['Player has left alliance'] = 'ترک کردن اتحاد توسط بازیکن';
$Definition['Options']['Player was kicked from alliance'] = 'اخراج بازیکن از اتحاد';
$Definition['Options']['There are no outgoing troops'] = 'هیچ نیرویی در حال رفتن نباشد';
$Definition['Options']['There are no incoming troops'] = 'هیچ نیرویی در حال آمدن نباشد';
$Definition['Options']['There are no troops reinforing other players'] = 'هیچ نیرویی در حال پشتیبانی از بازیکنان دیگر نباشد';
$Definition['Options']['No other player reinforces you'] = 'هیچ بازیکنی در حال پشتیبانی از شما نباشد';
$Definition['Options']['You dont own a Wonder of the World Village'] = 'شما دارای دهکده شگفتی جهان نباشید';
$Definition['Options']['You dont own an artifact'] = 'شما دارای کتیبه ای نباشید';
$Definition['Options']['You dont have beginners protection left'] = 'شما دارای حمایت تازه واردین نباشید';
$Definition['Options']['There are no troops in your traps'] = 'نیرویی در تله های شما اسیر نشده باشد';
$Definition['Options']['x/9 conditions met'] = '%s/9 شرایط برای تعطیلات فراهم است';
$Definition['Options']['Available Days x/y'] = 'روز های موجود %s / %s';
$Definition['Options']['How many days should the vacation mode last'] = 'چند روز تعطیلات به طول بیانجامد';
$Definition['Options']['Vacation til'] = 'تعطیلات تا';
$Definition['Options']['Your account is not in deletion'] = 'اکانت شما در حال حذف نباشد';
$Definition['Options']['enter vacation mode now'] = 'به حالت تعطیلات برو';
$Definition['Options']['Vacation mode is active'] = 'حالت تعطیلات فعال است';
$Definition['Options']['Are you sure you want to enter vacation mode?'] = 'آیا مطمئن هستید می خواهید به حالت تعطیلات بروید؟';
$Definition['Options']['Your account will be protected, and the resource production will continue'] = 'اکانت شما تحت حمایت خواهد بود و تولید منابع ادامه می یابد.';
$Definition['Options']['So will the crop consumption by troops too, which may lead to troop starvation'] = 'همانطور که مصرف گندم از طرف سربازان ادامه خواهد یافت.';
$Definition['Options']['Your are not able to'] = 'شما قادر به انجام این کارها نیستید';
$Definition['Options']['upgrade buildings'] = 'ارتقا ساختمان';
$Definition['Options']['train troops'] = 'تربیت سرباز';
$Definition['Options']['send troops'] = 'ارسال لشکریان';
$Definition['Options']['send merchants'] = 'ارسال تاجران';
$Definition['Options']['delete your account'] = 'حذف اکانت';
$Definition['Options']['Remaining days in vacation mode'] = 'روز های باقی مانده در حالت تعطیلات';
$Definition['Options']['day(s)'] = 'روز';
$Definition['Options']['You can abort vacation mode now'] = 'شما میتوانید هم اکنون حالت تعطیلات را لغو کنید';
$Definition['Options']['abort vacation mode'] = 'لغو حالت تعطیلات';
$Definition['Options']['Vacation mode runs til'] = 'حالت تعطیلات در حال اجرا است تا';
$Definition['Options']['player name'] = 'نام بازیکن';
$Definition['Options']['Send raids'] = 'ارسال غارت';
$Definition['Options']['Send reinforcements to other players'] = 'ارسال نیروی کمکی به بازیکن های دیگر';
$Definition['Options']['Send resources to other players'] = 'ارسال منابع به بازیکن های دیگر';
$Definition['Options']['Buy and spend Gold'] = 'خرید یا مصرف طلا';
$Definition['Options']['Delete and archive messages and reports'] = 'حذف  یا آرشیو پیام ها و گزارشات';
$Definition['Options']['Contribute resources to alliance bonuses'] = 'مشارکت در ارائه منابع برای امتیازهای اضافی اتحاد';
$Definition['Options']['Read and send messages'] = 'خواندن یا ارسال پیام';
$Definition['Options']['language settings'] = 'تنظیمات زبان';
$Definition['Options']['Language'] = 'زبان';
$Definition['Options']['Support colorBlind title'] = 'پشتیبانی از کسانی که کوررنگی دارند';
$Definition['Options']['Use colorBlind?'] = 'استفاده از پشتیبانی کوررنگی؟';
$Definition['Options']['Support colorBlind desc'] = 'شما می توانید حالت کور رنگی را فعال کنید، این حالت رنگها و آیکون ها را بهینه می کند و هیچ تاثیری در روند بازی ندارد.';
$Definition['Options']['Transfer gold'] = 'انتقال طلا';
$Definition['Options']['You have Gold %s pieces of gold, %s pieces can be transferred after deleting your account!'] = 'شما %s طلا دارید، %s طلا قادر به انتقال بعد از حذف اکانت خواهد بود.';
$Definition['Options']['Auto reload status'] = 'تنظیمات بارگزاری خودکار';
$Definition['Options']['Enable auto reload?'] = 'بارگزاری خودکار فعال شود ؟';
$Definition['Options']['Use fast upgrade on buildings'] = 'ارتقای سریع';
$Definition['Options']['This player is sitter for 2 players'] = 'This player is sitter for 2 players.';
$Definition['Options']['You can set the page to auto reload, the page will be automatically refreshed when timer reaches 0'] = 'شما می توانید بارگزاری خودکار را فعال کنید، در این صورت وقتی تایمر به اتمام برسد صفحه به صورت خودکار بارگزاری مجدد می شود.';
$Definition['Options']['Graphic pack'] = 'بسته گرافیکی';
$Definition['Options']['You can change the way the game looks for you'] = 'شما می توانید بسته گرافیکی مورد نظر خود را انتخاب کنید.';
$Definition['Options']['new'] = 'جدید';


//
$Definition['PaymentWizard']['You have a WW village or Artifact So you cannot use this feature'] = 'شما دهکده شگفتی جهان یا کتیبه دارید و قادر به استفاده از این گزینه نمی باشید.';
$Definition['PaymentWizard']['Gold'] = 'طلا';
$Definition['PaymentWizard']['goldClub'] = 'کلوپ طلایی';
$Definition['PaymentWizard']['x gold moneyUnit'] = '%s سکه طلا %s %s';
$Definition['PaymentWizard']['paymentUnAvailable'] = 'درگاه پرداخت در حال حاظر در دسترس نیست.';
$Definition['PaymentWizard']['location'] = 'موقعیت';
$Definition['PaymentWizard']['ChangeLocation'] = 'تغییر موقعیت';
$Definition['PaymentWizard']['Package'] = 'بسته';
$Definition['PaymentWizard']['ChoosePackage'] = 'انتخاب یک بسته';
$Definition['PaymentWizard']['changePackage'] = 'تغییر بسته';
$Definition['PaymentWizard']['BuySettings'] = 'تنظیمات خرید';
$Definition['PaymentWizard']['hour'] = 'ساعت';
$Definition['PaymentWizard']['Not Available yet'] = 'در دسترس نیست';
$Definition['PaymentWizard']['All displayed prices are final prices'] = 'تمامی قیمت های لیست شده قیمت های نهایی هستند.';
$Definition['PaymentWizard']['You can check the status of your order at any time'] = 'شما می توانید سفارشات خود را در هر زمان برسی کنید.';
$Definition['PaymentWizard']['Show open orders'] = 'نمایش سفارشات فعال';
$Definition['PaymentWizard']['Hide open orders'] = 'عدم نمایش سفارشات فعال';
$Definition['PaymentWizard']['Payment options:'] = 'گزینه های پرداخت:';
$Definition['PaymentWizard']['Show payment methods'] = 'نمایش روش های پرداخت';
$Definition['PaymentWizard']['Buy gold'] = 'خرید طلا';
$Definition['PaymentWizard']['Advantages'] = 'امکانات پلاس';
$Definition['PaymentWizard']['Plus Support'] = 'پشتیبانی پلاس';
$Definition['PaymentWizard']['Earn Gold'] = 'بدست آوردن طلا';
$Definition['PaymentWizard']['Delivery:'] = 'تحویل:';
$Definition['PaymentWizard']['Select payment method'] = 'انتخاب روش پرداخت';
$Definition['PaymentWizard']['Step3-ChoosePayment'] = 'مرحله 3 - انتخاب روش خرید';
$Definition['PaymentWizard']['step'] = 'مرحله';
$Definition['PaymentWizard']['notEnoughGoldForThisOption'] = 'سکه طلای کافی برای این گزینه ندارید!';
$Definition['PaymentWizard']['ChooseAnotherPackage'] = 'انتخاب بسته دیگر';
$Definition['PaymentWizard']['BuyNow'] = 'حالا خرید کن؟';
$Definition['PaymentWizard']['Gold'] = 'طلا';
$Definition['PaymentWizard']['Please activate advantage that you can choose'] = 'مزایای مورد نظر خود را برای فعالسازی انتخاب کنید';
$Definition['PaymentWizard']['ToTheEndOfTheGame'] = 'تا آخر بازی';
$Definition['PaymentWizard']['Days remaining'] = 'روز های باقی مانده';
$Definition['PaymentWizard']['until'] = 'تا';
$Definition['PaymentWizard']['EndsAtX'] = 'پایان در %s ساعت';
$Definition['PaymentWizard']['Bonus duration'] = 'مدت زمان';
$Definition['PaymentWizard']['Days'] = 'روز';
$Definition['PaymentWizard']['Payment rules'] = 'قوانین پرداخت';
$Definition['PaymentWizard']['PaymentRulesHTML'] = '';
$Definition['PaymentWizard']['Hour'] = 'ساعت';
$Definition['PaymentWizard']['Extend automatically'] = 'تمدید خودکار';
$Definition['PaymentWizard']['Activated To End Of the game'] = 'فعال تا <b>آخر بازی</b>';
$Definition['PaymentWizard']['GoldClub'] = 'کلوپ طلایی';
$Definition['PaymentWizard']['goldClubDesc'] = 'این گزینه تا پایان بازی فعال می‌باشد!<br />
کلوپ طلایی شامل: خانه‌های فارم، ارسال 3 بار تاجرها، مرکز تحقیق 9/15 گندمی، سفارش ساخت برای معمارها، مسیرهای تجارت اتوماتیک و گریز اتوماتیک در زمانی که به شما حمله‌ای می‌شود، می باشد.';
$Definition['PaymentWizard']['Plus'] = 'اکانت پلاس';
$Definition['PaymentWizard']['PlusDesc'] = 'مروری بهتر و مزایای بیشتری برای صرفه جویی در زمان فراهم میکند
<br />
قادر به بزرگتر کردن نقشه برای نمایش بهتر آن می‌باشید. قراردادن در نویت ساخت. برای اینکه بتوانید در بازار بهتر عمل کنید، می‌توانید از امکان فیلتر منابع در بازار استفاده کنید تا تنها تجارت‌های منابع خاص برای شما نمایش داده شود!';
$Definition['PaymentWizard']['+25Wood'] = '+25% تولید چوب';
$Definition['PaymentWizard']['+25WoodDesc'] = 'با استفاده از این امکان قادر به افزایش 25% تولید چوب دهکده‌ی خود می‌باشید.
<br />
این مقدار به تولیدی تک تک هیزم شکن ها افزوده نخواهد شد و بلکه تاثیر آن به تولیدی کل می‌باشد!';
$Definition['PaymentWizard']['+25Clay'] = '+25% تولید خشت';
$Definition['PaymentWizard']['+25ClayDesc'] = 'با استفاده از این امکان قادر به افزایش 25% تولید خشت دهکده‌ی خود می‌باشید.
<br />
این مقدار به تولیدی تک تک آجرسازی ها افزوده نخواهد شد و بلکه تاثیر آن به تولیدی کل می‌باشد!';
$Definition['PaymentWizard']['+25Iron'] = '+25% تولید آهن';
$Definition['PaymentWizard']['+25IronDesc'] = 'با استفاده از این امکان قادر به افزایش 25% تولید آهن دهکده‌ی خود می‌باشید.
<br />
این مقدار به تولیدی تک تک معادن آهن افزوده نخواهد شد و بلکه تاثیر آن به تولیدی کل می‌باشد!';
$Definition['PaymentWizard']['+25Crop'] = '+25% تولید گندم';
$Definition['PaymentWizard']['+25CropDesc'] = 'با استفاده از این امکان قادر به افزایش 25% تولید گندم دهکده‌ی خود می باشید.
<br />
این مقدار به تولیدی تک تک گندم زار ها افزوده نخواهد شد و بلکه تاثیر آن به تولیدی کل می‌باشد!';
$Definition['PaymentWizard']['Travian Answers'] = 'پاسخ‌های تراوین';
$Definition['PaymentWizard']['Recipient [RECEIVER_COUNT]:'] = 'دریافت کننده [RECEIVER_COUNT]:';
$Definition['PaymentWizard']['mentor'] = 'راهنما';
$Definition['PaymentWizard']['How can we help?'] = 'چگونه میتوانیم کمکتان کنیم؟';
$Definition['PaymentWizard']['Plus FAQ'] = 'راهنمای پلاس';
$Definition['PaymentWizard']['Plus FAQ Desc'] = 'اگر در مورد انتقال و یا خرید سکه‌ی طلای تراوین و یا امکانات پلاس سوالی داشتید می‌توانید سایت پاسخ‌های تراوین را مطالعه کنید.';
$Definition['PaymentWizard']['Contact Plus Support'] = 'پشتیبانی پلاس';
$Definition['PaymentWizard']['Plus Support'] = 'پشتیبانی پلاس';
$Definition['PaymentWizard']['Plus Support Desc'] = 'مشکلی دارید که هنوز برای آن پاسخی پیدا نکرده‌اید؟ با پشتیبانی پلاس/خرید ما برای راهنمایی های بیشتر تماس بگیرید.';
$Definition['PaymentWizard']['Miscellaneous information'] = 'اطلاعات متفرقه';
$Definition['PaymentWizard']['Miscellaneous information warning'] = 'توجه: لطفاً توجه داشته باشید که اگر خواستید اکانت خود را حذف کنید باید حداقل 7 روز بعد از خرید آخر خود منتظر بمانید تا قادر به فعال سازی حذف اکانت باشید.';
$Definition['PaymentWizard']['How can I invite players?'] = 'چگونه میتوانیم بازیکن دعوت کنیم؟';
$Definition['PaymentWizard']['Players invited so far'] = 'بازیکن‌های معرفی شده';
$Definition['PaymentWizard']['If you invite players to open an account in Travian on this server, you can receive Gold as a reward, You can use this Gold to purchase a Plus Account or other Gold advantages'] = 'گر بازیکنی که دعوت کرده‌اید در بازی برای خود اکانتی ساخته و دهکده‌ی دومی برای خود بسازد برای شما سکه‌ی طلای تراوین جایزه داده خواهد شد که قادر به استفاده از این سکه‌های طلای تراوین مانند سکه‌های طلای تراوین خریداری شده خواهید بود.';
$Definition['PaymentWizard']['To bring in new players, you can invite them by email or have them click on your REF link'] = 'برای اینکار می‌توانید افراد دیگر را از طریق ایمیل دعوت کنید و یا لینک دعوت خود را برای آنها ارسال کنید.';
$Definition['PaymentWizard']['As soon as an invited player has reached x villages'] = '<p>به محض اینکه بازیکن دعوت شده از طرف شما دهکده‌ی <span class="amount">2</span> خود را بنا کرد، برای شما  <span class="goldReward"><img src="img/x.gif" class="gold" alt="طلا"> <span class="amount">'.Config::getProperty("gold", "invitePlayerGold").'</span></span> اضافه خواهد شد.</p>';
$Definition['PaymentWizard']['back to overview'] = 'بازگشت به دید کلی';
$Definition['PaymentWizard']['Choose an option to earn gold'] = 'یک گزینه انتخاب نمائید';
$Definition['PaymentWizard']['Send link to friends'] = 'ارسال لینک به دوستان';
$Definition['PaymentWizard']['You can send a link to your friends via email, inviting them to Travian'] = 'میتوانید از طریق ارسال ایمیل لینک ارجاع خود را برای دوستانتان ایمیل کنید.';
$Definition['PaymentWizard']['Send email to friends'] = 'ارسال ایمیل به دوستان';
$Definition['PaymentWizard']['Your personal referral link'] = 'لینک ارجاع شخصی (لینک دعوت)';
$Definition['PaymentWizard']['Display a list of all the players you have invited so far'] = 'نمایش لیست و مشخصات بازیکن‌های دعوت شده';
$Definition['PaymentWizard']['Display list of all invited players'] = 'نمایش لیست معرفی شدگان';
$Definition['PaymentWizard']['Please enter recipients email addresses'] = 'لطفا ایمیل های دریافت کننده ها را وارد کنید';
$Definition['PaymentWizard']['Recipient 1'] = 'دریافت کننده 1';
$Definition['PaymentWizard']['Recipient 2'] = 'دریافت کننده 2';
$Definition['PaymentWizard']['Add more people'] = 'افزودن';
$Definition['PaymentWizard']['Add a personal message (optional)'] = 'متن اختصاصی شما (اختیاری)';
$Definition['PaymentWizard']['Cancel'] = 'انصراف';
$Definition['PaymentWizard']['Send invitation'] = 'ارسال دعوتنامه';
$Definition['PaymentWizard']['INVITE_EMAIL_MESSAGE'] = 'سلام,

بازیکن [PLAYERNAME]([PLAYEREMAIL]) می خواهد شما را
برای بازی در بازی آنلاین تراوین دعودت کند.
[PLAYERNAME] در جهان [GAMEWORLD] با نژاد [TRIBE] بازی می کند/

برای ثبت نام، از لیست زیر استفاده کنید:
<a href="[INVITE_LINK]">[INVITE_LINK]</a>

----------

[CUSTOM_MESSAGE]';
$Definition['PaymentWizard']['You have not brought in any new players yet'] = 'شما بازیکن جدید را دعوت نکرده اید.';
$Definition['PaymentWizard']['INVITE_EMAIL_SUBJECT'] = 'تراوین: دعوت نامه از طرف بازیکن [PLAYERNAME]';
$Definition['PaymentWizard']['Number of successfully sent invitations: x'] = 'تعداد دعوت نامه هایی که با موفقیت ارسال شدند: %s';
$Definition['PaymentWizard']['OpenOffers'] = 'سفارش های فعال';
$Definition['PaymentWizard']['Order Date'] = 'تاریخ سفارش';
$Definition['PaymentWizard']['Payment'] = 'درگاه';
$Definition['PaymentWizard']['Booking'] = 'حسابداری';
$Definition['PaymentWizard']['Presenter'] = 'ببنیان گزار';
$Definition['PaymentWizard']['Units'] = 'واحد';
$Definition['PaymentWizard']['Price'] = 'قیمت';
$Definition['PaymentWizard']['Pending'] = 'در انتظار';
$Definition['PaymentWizard']['Success'] = 'موفقیت آمیز';
$Definition['PaymentWizard']['Success2'] = 'ناموفق';
$Definition['PaymentWizard']['Cancelled'] = 'انصراف داده شده';
$Definition['PaymentWizard']['booked'] = 'واریز شده';
$Definition['PaymentWizard']['not booked'] = 'واریز نشده';
$Definition['PaymentWizard']['no Open Orders'] = 'هیچ سفارشی یافت نشد.';
$Definition['PaymentWizard']['AccountDeletionErr'] = 'این اکانت در حال حذف است.<br>شما قادر به خرید طلا نمی باشید.<br><br>متاسفامه برای جلوگیری از مشکلات پرداخت شما قادر به خرید طلا نیستید.';
$Definition['PaymentWizard']['The payment system is not available'] = 'درگاه پرداخت در حال حاظر در دسترس نیست.';
$Definition['PaymentWizard']['An error occurred The payment system is not available at the moment Please try again later'] = 'درگاه پرداخت در حال حاظر در دسترس نیست. لطفا بعدا امتحان کنید.';
$Definition['PaymentWizard']['World'] = 'جهان بازی';
$Definition['PaymentWizard']['UID'] = 'شماره';
$Definition['PaymentWizard']['Member since'] = 'ثبت نام کرده';
$Definition['PaymentWizard']['Inhabitants'] = 'جمعیت';
$Definition['PaymentWizard']['Villages'] = 'دهکده ها';
$Definition['PaymentWizard']['paymentFeatures'] = 'امکانات اضافه';
$Definition['PaymentWizard']['Troops'] = 'لشگریان';
$Definition['PaymentWizard']['buyAnimal'] = 'خرید حیوانات';
$Definition['PaymentWizard']['General'] = 'عمومی';
$Definition['PaymentWizard']['GeneralOptions'] = 'گزینه های عمومی';
$Definition['PaymentWizard']['buyTroops'] = 'خرید سرباز';
$Definition['PaymentWizard']['buyResources'] = 'خرید منابع';
$Definition['PaymentWizard']['WWDisabled'] = 'شما نمی توانید از این قابلیت در دهکده شگفتی جهان استفاده کنید.';
$Definition['PaymentWizard']['Buy'] = 'خرید';
$Definition['PaymentWizard']['delivery'] = 'تحویل';
$Definition['PaymentWizard']['Immediately'] = 'فوری';
$Definition['PaymentWizard']['Minutes'] = 'دقیقه';
$Definition['PaymentWizard']['upgradeAllResourcesTo20'] = 'ارتقای سطح تمامی منابع به سطح 20';
$Definition['PaymentWizard']['upgradeAllResourcesTo20Desc'] = 'سطوح تمامی منابع به 20 ارتقا می یابد.';
$Definition['PaymentWizard']['upgradeAllResourcesTo30'] = 'ارتقای سطح تمامی منابع به سطح 30';
$Definition['PaymentWizard']['upgradeAllResourcesTo30Desc'] = 'سطوح تمامی منابع به 30 ارتقا می یابد.';
$Definition['PaymentWizard']['rallyPointTo20'] = 'ساخت اردوگاه سطح 20';
$Definition['PaymentWizard']['rallyPointTo20Desc'] = 'ساخت اردوگاه سطح 20 در دهکده فعلی.';
$Definition['PaymentWizard']['oneHourOfProduction'] = 'خرید 1 ساعت منابع تولید شده در دهکده';
$Definition['PaymentWizard']['oneHourOfProductionDesc'] = 'به میزان تولید یک ساعت منابع به دهکده فعلی اضافه خواهد شد.';
$Definition['PaymentWizard']['finishTraining'] = 'تربیت فوری لشکریان';
$Definition['PaymentWizard']['finishTrainingDesc'] = 'تمامی لشکریان به صورت فوری و در دهکده فعلی تربیت خواهند شد.';
$Definition['PaymentWizard']['moreProtection'] = 'افزودن حمایت روزانه';
$Definition['PaymentWizard']['moreProtectionDesc'] = 'با حمایت، دیگر نمی توانند به شما حمله کنند ';
$Definition['PaymentWizard']['fasterTraining'] = '+%s%% افرایش سرعت تربیت لشکریان';
$Definition['PaymentWizard']['fasterTrainingDesc'] = 'در تمام دهکده ها اصطبل سربازخانه کارگاه تاثیر آن فقط برای نیروهایی است که بعد از این تربیت می کنید.';
$Definition['PaymentWizard']['academyResearchAll'] = 'تحقیق تمام نیروها در این دهکده';
$Definition['PaymentWizard']['academyResearchAllDesc'] = 'تمامی نیروها در این دهکده تحقیق خواهند شد و نیازی به ساخت دارالفنون نیست.';
$Definition['PaymentWizard']['smithyUpgradeAllToMax'] = 'ارتقا سطح تمام نیروها به سطح 20 در این دهکده';
$Definition['PaymentWizard']['smithyUpgradeAllToMaxDesc'] = 'تمامی نیروها در آهنگری به آخرین سطح ارتقا خواهند یافت.';
$Definition['PaymentWizard']['cancelTrainingQueue'] = 'لغو تمام تربیت سربازان در این دهکده';
$Definition['PaymentWizard']['cancelTrainingQueueDesc'] = 'تمامی صف تربیت لشکریان دراین دهکده لغو می شود. منابع برگشت داده نمی شود.';
$Definition['PaymentWizard']['increaseStorage'] = 'افزایش ظرفیت انبار';
$Definition['PaymentWizard']['increaseStorageDesc'] = 'ظرفیت یک انبار سطح 20 را به ظرفیت فعلی انبار اضافه کن.';
$Definition['PaymentWizard']['Used: %s of %s'] = 'استفاده شده: %s از %s';
$Definition['PaymentWizard']['Gold bank'] = 'بانک طلا';
$Definition['PaymentWizard']['Show all the golds you have saved'] = 'نمایش لیست طلاهای ذخیره شده';
$Definition['PaymentWizard']['Display saved golds and how to use them'] = 'نمایش لیست طلاهای ذخیره شده و طریقه استفاده آنها';
$Definition['PaymentWizard']['Voucher code'] = 'کدکوپن';
$Definition['PaymentWizard']['Voucher ID'] = 'شناسه کپن';
$Definition['PaymentWizard']['Gold'] = 'طلا';
$Definition['PaymentWizard']['Action'] = 'عملیات';
$Definition['PaymentWizard']['Use'] = 'استفاده';
$Definition['PaymentWizard']['Date'] = 'تاریخ';
$Definition['PaymentWizard']['No saved golds'] = 'هیچ طلایی ذخیره ندارید!';
$Definition['PaymentWizard']['Are you sure?'] = 'آیا مطمئن هستید؟';
$Definition['PaymentWizard']['This feature is disabled'] = 'این قابلیت در دسترس نیست.';
$Definition['PaymentWizard']['Gold bank is disabled'] = 'بانک طلا غیرفعال است.';
$Definition['PaymentWizard']['Invitation is closed'] = 'دعوت بازیکنان امکان پذیر نمی باشد';
$Definition['PaymentWizard']['Server is closed for invitations'] = 'ثبت نام در این سرور به اتمام رسیده است.';
$Definition['PaymentWizard']['Gold bank is disabled'] = 'بانک طلا غیرفعال است.';
$Definition['PaymentWizard']['Power'] = 'قدرت!';
$Definition['PaymentWizard']['Attack/Defense Bonus'] = 'امتیاز دفاعی/هجومی';

$Definition['PaymentWizard']['atkBonus'] = '+%s%% قدرت هجومی';
$Definition['PaymentWizard']['atkBonusDesc'] = 'قدرت کلی نیروهای شما را در حملات با درصد مشخصی افزایش می دهد.';
$Definition['PaymentWizard']['defBonus'] = '+%s%% قدرت دفاعی';
$Definition['PaymentWizard']['defBonusDesc'] = 'قدرت کلی نیروهای شما را در دفاع با درصد مشخصی افزایش می دهد.';
$Definition['PaymentWizard']['Protection'] = 'حمایت';
$Definition['PaymentWizard']['Protection Packages'] = 'بسته های حمایت';
$Definition['PaymentWizard']['Protection daily limit reached'] = 'به علت محدودیت خرید روزانه این قابلیت غیرفعال است.';
$Definition['PaymentWizard']['You have %s hour(s) of protection left'] = 'شما %s ساعت حمایت دارید.';
$Definition['PaymentWizard']['You have no protection left'] = 'شما تحت حمایت نیستید.';
$Definition['PaymentWizard']['You can buy %s hour(s) of protection per day'] = 'شما در روز می توانید %s ساعت حمایت بخرید.';
$Definition['PaymentWizard']['You have %s golds in your vouchers'] = 'شما %s طلا در بانک طلای خود دارید.';

$Definition['PaymentWizard']['Location'] = 'موقعیت';
$Definition['PaymentWizard']['Packages'] = 'پکیج ها';
$Definition['PaymentWizard']['Payment methods'] = 'روش های پرداخت';
$Definition['PaymentWizard']['Overview'] = 'دیدکلی';
$Definition['PaymentWizard']['Selected package'] = 'پکیج انتخابی';
$Definition['PaymentWizard']['Your new gold balance'] = 'طلای جدید شما';
$Definition['PaymentWizard']['Gold'] = 'طلا';
$Definition['PaymentWizard']['Price'] = 'قیمت';
$Definition['PaymentWizard']['Buy now'] = 'خرید';
$Definition['PaymentWizard']['Voucher'] = 'کوپن';
$Definition['PaymentWizard']['Redeem'] = 'تسویه';
$Definition['PaymentWizard']['Redeem voucher'] = 'تسویه کوپن';
$Definition['PaymentWizard']['Open orders'] = 'سفارش های فعال';

$Definition['PaymentWizard']['Voucher rules'] = 'قوانین کوپن ها';
$Definition['PaymentWizard']['voucherRules'] = [
    ''.(100-Config::getProperty("gold", "voucherTaxPercent")).'% طلا های باقی مانده ذخیره خواهند شد.',
    //'کدکوپن در هر اکانتی قابل استفاده است.',
    'فقط طلا های خریداری شده و جوایز بازی قابل ذخیره شدن می باشند.',
    //'شما اجازه فروش کوپن های خود را ندارید.',
    'کوپن ها بعد از '.Config::getProperty("gold", "voucherExpireDays").' روز حذف خواهند شد.',
];
$Definition['PaymentWizard']['Reason'] = 'دلیل';
$Definition['PaymentWizard']['Show'] = 'نمایش';
$Definition['PaymentWizard']['Voucher'] = 'کوپن';
$Definition['PaymentWizard']['Vouchers'] = 'کوپن ها';
$Definition['PaymentWizard']['History'] = 'تاریخچه';
$Definition['PaymentWizard']['Email'] = 'ایمیل';
$Definition['PaymentWizard']['Used'] = 'استفاده شده';
$Definition['PaymentWizard']['Use details'] = 'اطلاعات استفاده کننده';
$Definition['PaymentWizard']['Voucher details'] = 'اطلاعات کوپن';
$Definition['PaymentWizard']['World ID'] = 'جهان بازی';
$Definition['PaymentWizard']['Player'] = 'بازیکن';
$Definition['PaymentWizard']['Gold num'] = 'تعداد طلا';
$Definition['PaymentWizard']['Use voucher'] = 'استفاده از کوپن ها';
$Definition['PaymentWizard']['Invalid voucher code'] = 'کد کوپن نامعتبر است';
$Definition['PaymentWizard']['Unable to use voucher'] = 'مشکلی در هنگام استفاده از کوپن رخ داده است.';
$Definition['PaymentWizard']['Redeem gold by gold number'] = 'دریافت طلا با مقدار مشخص';
$Definition['PaymentWizard']['You don`t have enough gold in your bank'] = 'شما طلای کافی در بانک ذخیره ندارید.';
$Definition['PaymentWizard']['Gold number must be 20 or more'] = 'تعداد طلا باید حداقل 20 یا بیشتر باشد.';
$Definition['PaymentWizard']['%s golds was added to your account'] = '%s طلا با موفقیت به اکانت شما افزوده شد.';
$Definition['PaymentWizard']['Voucher code'] = 'کدکوپن';
$Definition['PaymentWizard']['Use voucher with code'] = 'استفاده از کوپن با کد';
$Definition['PaymentWizard']['Your voucher(s)'] = 'کوپن های شما';
$Definition['PaymentWizard']['You have no voucher codes'] = "شما کوپنی ندارید.";
$Definition['PaymentWizard']['VoucherReasons']['gift'] = 'هدیه';
$Definition['PaymentWizard']['VoucherReasons']['remaining'] = 'باقی مانده طلا';
$Definition['PaymentWizard']['VoucherReasons']['winner'] = 'برنده بازی';
$Definition['PaymentWizard']['VoucherReasons']['2ndWinner'] = 'دومین برنده';
$Definition['PaymentWizard']['VoucherReasons']['3rdWinner'] = 'سومین برنده';
$Definition['PaymentWizard']['VoucherReasons']['winnerAlliance'] = 'اتحاد برنده';
$Definition['PaymentWizard']['VoucherReasons']['topOff'] = 'بهترین مهاجم';
$Definition['PaymentWizard']['VoucherReasons']['topDef'] = 'بهترین مدافع';
$Definition['PaymentWizard']['VoucherReasons']['topClimber'] = 'بهترین پیشرفت کننده';
$Definition['PaymentWizard']['VoucherReasons']['topOffHammer'] = 'بهترین همر هجومی';
$Definition['PaymentWizard']['VoucherReasons']['topDefHammer'] = 'بهترین همر دفاعی';
$Definition['PaymentWizard']['VoucherReasons']['Partial use'] = 'استفاده تعدادی';
$Definition['PaymentWizard']['VoucherReasons']['payment'] = 'درگاه پرداخت';
$Definition['PaymentWizard']['PayPalVATDesc'] = 'تراکنش های پی پال 3% مالیات + 0.30$ مالیات دارند.';
$Definition['PaymentWizard']['Animals purchased'] = 'حیوانات خریداری شد.';
$Definition['PaymentWizard']['Troops purchased'] = 'سربازان خریداری شد.';
$Definition['PaymentWizard']['Resources purchased!'] = 'منابع خریداری شد.';
$Definition['PaymentWizard']['You can buy animals every %s %s'] = 'شما هر %s %s مجاز به خرید حیوانات هستید.';
$Definition['PaymentWizard']['You can buy resources every %s %s'] = 'شما هر %s %s مجاز به خرید منابع هستید.';
$Definition['PaymentWizard']['You can buy troops every %s %s'] = 'شما هر %s %s مجاز به خرید لشکریان هستید.';
$Definition['PaymentWizard']['You need to wait %s %s before buying this package'] = 'برای خرید این بسته باید %s %s صبر کنید.';

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
$Definition['productionOverview'] = ["HDP" => "آبشخوری اسب",
    "productionOverview" => "دید کلی منابع",
    "balance" => "بالانس",
    "production_field" => "منبع",
    "production_per_hour" => "تولید در ساعت",
    "production" => "تولید",
    "bonus" => "افزایش",
    "production_bonus" => "افزایش تولیدات",
    "Oases" => "آبادی ها",
    "total_bonus" => "کل افزایش",
    "total_production_per_hour" => "کل تولید در ساعت",
    "hero_production" => "تولید قهرمان",
    "interim_balance" => "مقدار فعلی",
    "total" => "کل",
    "sum" => "مجموع",
    "inactive" => "غیرفعال",
    "productionBoostSpeechBubbleFurtherInfo" => 'این گزینه تولید منابع را در <span class="underlined">همه</span> دهکده های شما افزایش می دهد.',
    "productionWithBoost" => "تولید در ساعت به همراه افزایش",
    "extendNow" => "تمدید",
    "activeNow" => "فعال سازی",
    "durationDays" => "روز های فعال بودن افزایش",
    "Production of buildings and oases" => "تولیدات ساختمان ها و آبادی ها",
    "Population and construction orders" => "جمعیت و ساختمان های در حال ساخت",
    "Incomplete construction orders" => "سفارش های ساخت درحال انجام",
    "Consumption of own troops" => "مصرف گندم لشکریان خودی",
    "in village" => "در دهکده",
    "in oasis or reinforcements from own villages" => "در آبادی یا نیروی کمکی برای دهکده های خودی",
    "imprisoned" => "اسیر شده",
    "on the way" => "در راه",
    "Artefact bonus" => "امتیاز کتیبه",
    "Consumption of foreign troops" => "مصرف گندم لشکریان دیگری",
    "Crop balance" => "تراز گندم",
    "WW effect" => "تاثیر شگفتی جهان",
];
//
$Definition['Profile']['Player Profile'] = 'پروفایل بازیکن';
$Definition['Profile']['Details'] = 'مشخصات';
$Definition['Profile']['Rank'] = 'رتبه';
$Definition['Profile']['Tribe'] = 'نژاد';
$Definition['Profile']['Status'] = 'وضعیت';
$Definition['Profile']['Active'] = 'فعال';
$Definition['Profile']['inActive'] = 'غیرفعال';
$Definition['Profile']['Alliance'] = 'اتحاد';
$Definition['Profile']['Escape in villages'] = 'گریز در دهکده ها';
$Definition['Profile']['Villages'] = 'دهکده ها';
$Definition['Profile']['Login to player account'] = 'ورود به اکانت بازیکن';
$Definition['Profile']['Population'] = 'جمعیت';
$Definition['Profile']['Description'] = 'توضیحات';
$Definition['Profile']['This player messages are banned'] = 'نامه نگاری این بازیکن بازداشت می باشد.';
$Definition['Profile']['Name'] = 'نام';
$Definition['Profile']['Oases'] = 'آبادی ها';
$Definition['Profile']['Inhabitants'] = 'ساکنین';
$Definition['Profile']['Coordinates'] = 'مختصات';
$Definition['Profile']['Stop ignoring this player'] = 'نادیده نگرفتن بازیکن';
$Definition['Profile']['Accept messages from this player'] = 'دریافت پیام از این بازیکن.';
$Definition['Profile']['Write message'] = 'نوشتن پیام';
$Definition['Profile']['Write Message'] = 'نوشتن پیام';
$Definition['Profile']['Ignore Player'] = 'نادیده گرفتن بازیکن';
$Definition['Profile']['Edit list'] = 'ویرایش لیست';
$Definition['Profile']['Ignore list is full'] = 'لیست نادیده گرفته ها پر شده است.';
$Definition['Profile']['Player will be ignored'] = 'بازیکن نادیده گرفته خواهد شد.';
$Definition['Profile']['WoW'] = 'شگفتی جهان';
$Definition['Profile']['Support'] = 'پشتیبانی';
$Definition['Profile']['Game rules'] = 'قوانین بازی';
$Definition['Profile']['To ignore messages from a specific player, go to its profile and click on "Ignore"!'] = 'برای نادیده گرفتن بازیکن به پروفایل آن رفته و روی نادیده گرفتن کلیک کنید.';
$Definition['Profile']['MultihunterDesc'] = 'مولتی‌هانترها وظیفه‌ی اجرای <a href="
'.Config::getInstance()->settings->indexUrl.'spielregeln.php" target="_blank">قوانین بازی</a> را برعهده
دارند. اگر در مورد قوانین بازی سوالی داشتید و یا می‌خواهید
نقض قانونی را گزارش کنید می‌توانید با مولتی‌هانترها تماس
بگیرید.        ';
$Definition['Profile']['Support and Multihunter'] = 'پشتیبانی و مولتی هانتر';
$Definition['Profile']['The support consists of experienced players who will gladly answer your questions'] = 'داوطلب‌هایی از میان بازیکن‌های حرفه‌ای که برای پاسخ به سوالات شما هستند. ';
$Definition['Profile']['capital'] = 'پایتخت';
$Definition['Profile']['Artifact'] = 'کتیبه';
$Definition['Profile']['Birthday'] = 'تاریخ تولد';
$Definition['Profile']['Gender'] = 'جنسیت';
$Definition['Profile']['n/a'] = 'نامعلوم';
$Definition['Profile']['male'] = 'مرد';
$Definition['Profile']['female'] = 'زن';
$Definition['Profile']['Location'] = 'مکان';
$Definition['Profile']['Age'] = 'سن';
$Definition['Profile']['Overview'] = 'دیدکلی';
$Definition['Profile']['Edit Profile'] = 'ویرایش پروفایل';
$Definition['Profile']['Medals'] = 'مدال ها';
$Definition['Profile']['DoveOfPeace'] = 'کبوتر صلح';
$Definition['Profile']['Category'] = 'ردیف';
$Definition['Profile']['Rank'] = 'رتبه';
$Definition['Profile']['Week'] = 'هفته';
$Definition['Profile']['SpecialMedals'] = 'افتخارات';
$Definition['Profile']['BB-Code'] = 'کد BB';
$Definition['Profile']['SpecialMedalsTitle'] = [
    1 => 'برنده سرور رتبه 1',
    2 => 'برنده سرور رتبه 2',
    3 => 'برنده سرور رتبه 3',

    4 => 'برترین مهاجم رتبه 1',
    5 => 'برترین مهاجم رتبه 2',
    6 => 'برترین مهاجم رتبه 3',
    7 => 'برترین مهاجم رتبه 4',


    8 => 'برترین مدافع رتبه 1',
    9 => 'برترین مدافع رتبه 2',
    10 => 'برترین مدافع رتبه 3',
    11 => 'برترین مدافع رتبه 4',

    12 => 'برترین پیشرفت کننده رتبه 1',
    13 => 'برترین پیشرفت کننده رتبه 2',
    14 => 'برترین پیشرفت کننده رتبه 3',
    15 => 'برترین پیشرفت کننده رتبه 4',

    16 => 'بهترین همر هجومی',
    17 => 'بهترین همر دفاعی',
    18 => 'اتحاد برنده',
];
$Definition['Profile']['Player special medals'] = 'مدال های ویژه';
$Definition['Profile']['mySpeicalMTitle'] = [
    1 => 'شگفتی جهان',
    2 => 'شگفتی جهان',
    3 => 'شگفتی جهان',

    4 => "قوی ترین مهاجم",
    5 => "قوی ترین مهاجم",
    6 => "قوی ترین مهاجم",
    7 => "قوی ترین مهاجم",

    8 => 'قوی ترین مدافع',
    9 => 'قوی ترین مدافع',
    10 => 'قوی ترین مدافع',
    11 => 'قوی ترین مدافع',

    12 => 'بهترین پیشرفت کننده',
    13 => 'بهترین پیشرفت کننده',
    14 => 'بهترین پیشرفت کننده',
    15 => 'بهترین پیشرفت کننده',

    16 => 'بهترین همر هجومی',
    17 => 'بهترین همر دفاعی',
    18 => 'اتحاد برنده',
];
$Definition['Profile']['mySpeicalM'] = [
// Ranke Wonder Of World
    1 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - رتبه: 1 - سطح شگفتی جهان: %s',
    2 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - رتبه: 2 - سطح شگفتی جهان: %s',
    3 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - رتبه: 3 - سطح شگفتی جهان: %s',

// Ranke Offensive 1 ta 4 top 10
    4 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - رتبه: 1 - امتیازها: %s',
    5 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - رتبه: 2 - امتیازها: %s',
    6 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - رتبه: 3 - امتیازها: %s',
    7 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - رتبه: 4 - امتیازها: %s',
// Ranke Defensive 1 ta 4 top 10
    8 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - رتبه: 1 - امتیازها: %s',
    9 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - رتبه: 2 - امتیازها: %s',
    10 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - رتبه: 3 - امتیازها: %s',
    11 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - رتبه: 4 - امتیازها: %s',
// Ranke Pop Nafarate Avale 1 ta 4
    12 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - رتبه: 1 - امتیازها: %s',
    13 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - رتبه: 2 - امتیازها: %s',
    14 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - رتبه: 3 - امتیازها: %s',
    15 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - رتبه: 4 - امتیازها: %s',

    16 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - امتیازها: %s',
    17 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - امتیازها: %s',
    18 => 'سرور: <span class="warning"><b>%s</b></span> - نام: <span class="warning"><b>%s</b></span> - %s - اتحاد: <span class="warning"><b>%s</b></span>',

];
$Definition['Profile']['SpecialMedalsLayout'] = 'سرور  %s  &nbsp; &nbsp; &nbsp;  اکانت %s';
$Definition['Profile']['SpecialMedalsState'] = 'وضعیت افتخارات';
$Definition['Profile']['SpecialShow'] = 'نمایش';
$Definition['Profile']['SpecialHide'] = 'عدم نمایش';
$Definition['Profile']['Language'] = 'زبان';
$Definition['Profile']['Show country flag in your profile'] = 'نمایش پرچم کشور شما در پروفایل';
$Definition['Profile']['Show special medals?'] = 'نمایش مدال های ویژه؟';
$Definition['Profile']['YES'] = 'بله';
$Definition['Profile']['NO'] = 'خیر';
$Definition['Profile']['Note'] = 'نکته';
$Definition['Profile']['Edit'] = 'ویرایش';
$Definition['Profile']['NoteDescription'] = 'ویرایش کنید متن شخصی خود را در این قسمت. حداکثر طول متن: 500 کاراکتر';
//

$Definition['Quest']['welcome'] = 'خوش آمدید';
$Definition['Quest']['helperAndTasks'] = 'راهنما و وظایف';
$Definition['Quest']['taskList'] = 'لیست وظایف';
$Definition['Quest']['questButtonActivateTips'] = 'نمایش اشاره برای این وظیفه';
$Definition['Quest']['questButtonDeactivateTips'] = 'غیر فعال کردن اشاره';
$Definition['Quest']['questTipsToggleDescription'] = 'اشاره روشن/خاموش';
$Definition['Quest']['startTutorial'] = 'ادامه';
$Definition['Quest']['getReward'] = 'دریافت جایزه';
$Definition['Quest']['SkipTutorial'] = 'رد کردن آموزش';
$Definition['Quest']['skip'] = 'رد کردن آموزش';
$Definition['Quest']['questRewardTitle'] = 'جایزه تو';
$Definition['Quest']['overview'] = 'دیدکلی';
$Definition['Quest']['questTaskTitle'] = 'وظیقه';
$Definition['Quest']['endOfTutorial'] = 'پایان آموزش';
$Definition['Quest']['continue'] = 'ادامه';
$Definition['Quest']['battle'] = 'جنگی';
$Definition['Quest']['economy'] = 'اقتصادی';
$Definition['Quest']['world'] = 'عمومی';
$Definition['Quest']['Tutorial_01']['questTitle'] = 'خوش آمدید';
$Definition['Quest']['Tutorial_01']['questDescription'] = 'سلام %s, به تراوین خوش آمدید!  <br>تا زمانی که شما دهکده ی دیگری بنا کنید من شما را راهنمایی خواهم کرد. در این آموزش, به شما آموزش ساخت و ارتقاء ساختمان ها و دهکده داده خواهد شد.';
$Definition['Quest']['Tutorial_01']['continue'] = 'ادامه';
$Definition['Quest']['Tutorial_01']['skip'] = 'ردکردن آموزش';
$Definition['Quest']['Tutorial_01']['todo'] = [0 => 'آموزش ویژگی های اصلی این بازی رو به شما توضیح خواهد داد!',];
$Definition['Quest']['Tutorial_01']['steps'] = [0 => 'شروع آموزش',];
$Definition['Quest']['Tutorial_02']['questTitle'] = 'وظیفه و راهنما';
$Definition['Quest']['Tutorial_02']['questDescription'] = 'شما میتوانید این پنجره را ببندید و یا حرکت دهید. برای باز کردن دوباره, روی تصویر من در گوشه پایین سمت چپ کلیک کنید. این قسمت در مورد برخی از قسمت ها شما را راهنمایی خواهد کرد.';
$Definition['Quest']['Tutorial_02']['questDescriptionReward'] = 'حالا شما در رابطه با این وظیفه چیزهای یاد گرفته اید. وظیفه بعدی جایزه این وظیفه شما را خواهد داد. آجرسازی خود را بسازید!';
$Definition['Quest']['Tutorial_02']['rewardDescription'] = 'یک آجرسازی سطح 1 در انتظار شماست!';
$Definition['Quest']['Tutorial_02']['todo'] = [
    0 => 'بستن صفحه آموزش', 1 => 'بازکردن صفحه آموزش',
    2 => 'روی راهنما کلیک کن تا این پنجره باز شود',
];
$Definition['Quest']['Tutorial_02']['steps'] = [
    0 => 'بستن صفحه آموزش', 1 => 'بازکردن صفحه آموزش',
    2 => 'غیرفعال کردن اشاره',
];
$Definition['Quest']['Tutorial_03']['questTitle'] = 'ساخت هیزم شکن';
$Definition['Quest']['Tutorial_03']['questDescription'] = 'در اطراف دهکده‌ی تو 4 جنگل سبز موجود است. در یکی از آنها هیزم شکن بساز. چوب منبع مهمی برای دهکده‌ی جدید ما می‌باشد - یک هیزم شکن بساز!';
$Definition['Quest']['Tutorial_03']['questDescriptionReward'] = 'بله، اینطوری خواهی توانست چوب بیشتری بدست آوری.من کمی کمک کردم و ساخت را فوراً به اتمام رساندم.';
$Definition['Quest']['Tutorial_03']['rewardDescription'] = 'هیزم شکن فوراً ساخته شد.';
$Definition['Quest']['Tutorial_03']['todo'] = [
    0 => 'روی یک خانه از جنگل کلیک کنید', 1 => 'سفارش ساخت یک هیزم شکن بدهید',
];
$Definition['Quest']['Tutorial_03']['steps'] = [
    0 => 'بازکردن جنگل', 1 => 'هیزمشکن سطح 1',
];
$Definition['Quest']['Tutorial_04']['questTitle'] = 'ساخت هیزم شکن';
$Definition['Quest']['Tutorial_04']['questDescription'] = 'ساختمان سطح بالاتر برای دهکده شما مفیدتر خواهد بود و تولیدات شما رو ارتقاء , اما منابع بیشتری باید خرج کنید. هیزم شکن سطح 1 را به سطح 2 ارتقاء دهید!';
$Definition['Quest']['Tutorial_04']['questDescriptionReward'] = 'بله، اینطوری خواهی توانست چوب بیشتری بدست آوری.من کمی کمک کردم و ساخت را فوراً به اتمام رساندم.';
$Definition['Quest']['Tutorial_04']['questTaskTitle'] = 'وظیقه';
$Definition['Quest']['Tutorial_04']['rewardDescription'] = 'هیزم شکن فوراً ارتقاء پیدا کرد';
$Definition['Quest']['Tutorial_04']['todo'] = [
    0 => 'هیزم شکن سطح 1 را باز کنید', 1 => 'سفارش ساخت سطح 2 هیزم شکن بدهید',
];
$Definition['Quest']['Tutorial_04']['steps'] = [
    0 => 'بازکردن جنگل', 1 => 'هیزمشکن سطح 2',
];
$Definition['Quest']['Tutorial_05']['questTitle'] = 'ارتقاء گندم زار';
$Definition['Quest']['Tutorial_05']['questDescription'] = 'زمانی که به ساختمان های منابع خود نگاه میکنید گندم زارهایی مشاهده خواهد شد, روی یکی از گندمزار ها کلیک کرده و آن ساختمان را ارتقاء دهید. این ساختمان ها به تولید گندم و غذای دهکده شما کمک خواهد کرد. یک گندم زار ارتقاء بده.';
$Definition['Quest']['Tutorial_05']['questDescriptionReward'] = 'ساخت گندم زار سطح 1 بصورت فوری انجام شد، وظیفه بعدی ارتقاء آن به سطح 2 میباشد';
$Definition['Quest']['Tutorial_05']['rewardDescription'] = 'ساخت گندم زار سطح 1 بصورت فوری انجام شد، وظیفه بعدی ارتقاء آن به سطح 2 میباشد';
$Definition['Quest']['Tutorial_05']['todo'] = [
    0 => 'روی یک خانه گندم زار کلیک کنید',
    1 => 'یک گندم زار را به سطح 1 ارتقاء دهید',
];
$Definition['Quest']['Tutorial_05']['steps'] = [
    0 => 'بازکردن گندمزار', 1 => 'گندمزار سطح 1',
];
$Definition['Quest']['Tutorial_06']['questTitle'] = 'تولیدات قهرمان';
$Definition['Quest']['Tutorial_06']['questDescription'] = 'گر قهرمان شما زنده باشد, میتوانید تولید این دهکده را تا حدودی افزایش دهید. ما میخواهیم تولیدات را روی خشت تنظیم کنیم. تولیدات منابع قهرمان را روی خشت تنظیم کنید.';
$Definition['Quest']['Tutorial_06']['questDescriptionReward'] = 'خوب انجام دادی. قهرمان شما قادر به کمک در تولیدات دهکده میباشد. منابع تولیدی توسط قهرمان به دهکده ی محل اقامت او تعلق خواهد گرفت, حتی اگر در راه باشد. من مقداری خشت به انبار تو اضافه خواهم کرد.';
$Definition['Quest']['Tutorial_06']['rewardDescription'] = '<div class="inlineIconList resourceWrapper"><div class="inlineIcon resources" title=""><i class="r2 questRewardTypeResource questRewardTypeClay"></i><span class="value questRewardValue">'.Quest::getInstance()->multiply(200).'</span></div></div>';
$Definition['Quest']['Tutorial_06']['todo'] = [
    0 => 'روی تصویر قهرمان کلیک کرده و وارد بخش قهرمان بشوید',
    1 => 'تولید منبع قهرمان را روی خشت ذخیره کنید',
];
$Definition['Quest']['Tutorial_06']['steps'] = [
    0 => 'بخش قهرمان', 1 => 'تولیدات قهرمان',
];
$Definition['Quest']['Tutorial_07']['questTitle'] = 'برو داخل دهکده';
$Definition['Quest']['Tutorial_07']['questDescription'] = 'حالا, ما باید مقدار انبار دهکده را برای ذخیره سازی منابع بیشتر ارتقاء دهیم. برای همین نیاز داریم وارد داخل دهکده بشیم. وارد بخش داخلی دهکده شوید.';
$Definition['Quest']['Tutorial_07']['todo'] = [0 => 'وارد داخل دهکده شو.',];
$Definition['Quest']['Tutorial_07']['steps'] = [0 => 'برو به داخل دهکده',];
$Definition['Quest']['Tutorial_08']['questTitle'] = 'یک انبار بساز';
$Definition['Quest']['Tutorial_08']['questDescription'] = 'بودن انبار، فقط منابع کمی را می توان در دهکده نگهداری کرد. روی هر خانه قابل دسترس کلیک کنید. دنبال انبار بگردید و آن را بنا کنید.';
//$Definition['Quest']['Tutorial_08']['questDescriptionReward'] = 'ساخت انبار سطح 1 با موفقیت آغاز شد، بعد از به اتمام رسیدن ساخت کامل این ساختمان خواهید دید که ظرفیت نگهداری منابع شما بیشتر خواهد شد. این مقدار ظرفیت فقط به چوب، خشت و آهن محدود میشود, به تو 1 روز اکانت تراوین پلاس اهداء شد.';
$Definition['Quest']['Tutorial_08']['questDescriptionReward'] = 'ساخت انبار سطح 1 با موفقیت آغاز شد، بعد از به اتمام رسیدن ساخت کامل این ساختمان خواهید دید که ظرفیت نگهداری منابع شما بیشتر خواهد شد. این مقدار ظرفیت فقط به چوب، خشت و آهن محدود میشود, به تو '.Quest::calcEffect(86400, 'plus', true).' اکانت تراوین پلاس اهداء شد.';
$Definition['Quest']['Tutorial_08']['rewardDescription'] = 'یک ساعت اکانت تراوین پلاس';
$Definition['Quest']['Tutorial_08']['todo'] = [
    0 => 'یکی از خانه های نشان داده شده را انتخاب کن',
    1 => 'سفارش ساخت انبار سطح 1 را بده',
];
$Definition['Quest']['Tutorial_08']['steps'] = [
    0 => 'بخش ساخت ساختمان', 1 => 'ساخت انبار سطح 1',
];
$Definition['Quest']['Tutorial_09']['questTitle'] = 'اردوگاه';
$Definition['Quest']['Tutorial_09']['questDescription'] = 'برای ارسال قهرمان به ماجراجویی نیاز به اردوگاه دارید - شما میتوانید بخش اردوگاه را در قسمت وسط دهکده پیدا کنید! اردوگاه را به سطح 1 برسانید.';
$Definition['Quest']['Tutorial_09']['questDescriptionReward'] = 'عالیه! سفارش ساخت اردوگاه داده شده حالا قهرمان شما میتواند به ماجراجویی برود. برای این وظیفه, من به شما مقداری طلا خواهم داد, تا هر موقع نیاز داشتی از آن استفاده کنی.';
$Definition['Quest']['Tutorial_09']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeGold"> <span class="questRewardValue">2</span>';
$Definition['Quest']['Tutorial_09']['todo'] = [
    0 => 'روی بخش مربوط به اردوگاه کلیک کنید',
    1 => 'سفارش ساخت اردوگاه سطح 1 را بدهید',
];
$Definition['Quest']['Tutorial_09']['steps'] = [
    0 => 'بخش ساخت اردوگاه', 1 => 'ساخت اردوگاه سطح 1',
];
$Definition['Quest']['Tutorial_10']['questTitle'] = 'ساخت سریع';
$Definition['Quest']['Tutorial_10']['questDescription'] = 'در قسمت پایینی دهکده لیست ساختمان های در حال ساخت مربوط به دهکده ی فعال را مشاهده خواهید کرد. در این زمان شما قادر به ارتقاء سریع ساخت میباشید. با استفاده از مصرف طلا شما میتوانید تمامی ساختمان های در حال ساخت را با گزینه "اتمام سریع ساخت" به پایان برسانید.';
$Definition['Quest']['Tutorial_10']['questDescriptionReward'] = 'حالا تو میتوانی نیروها و قهرمان خود را بین دهکده های دیگر جا به جا کنی. اول, منابع و تولیدات خود را افزایش بده تا بتوانی منابع بیشتری تولید کنی.';
$Definition['Quest']['Tutorial_10']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeGold"> <span class="questRewardValue">10</span>';
$Definition['Quest']['Tutorial_10']['todo'] = [0 => 'ساختمان های در حال ساخت را بصورت فوری به اتمام برسان',];
$Definition['Quest']['Tutorial_10']['steps'] = [0 => 'ساخت سریع ساختمان',];
$Definition['Quest']['Tutorial_11']['questTitle'] = 'شرکت در ماجراجویی';
$Definition['Quest']['Tutorial_11']['questDescription'] = 'در اطراف دهکده ی شما اتفاقاتی رخ خواهد داد که شما میتوانید قهرمان خود را به ماجراجویی ارسال کنید و غنیمت به دست بیاورید. لیست ماجراجویی خود را باز کرده و اولین ماجراجویی خود را آغاز کنید.';
$Definition['Quest']['Tutorial_11']['questDescriptionReward'] = 'عالیه, قهرمان شما در راه است - چه چیزی پیدا کرده است? میتوانید حرکت لشکریان و قهرمان خود را در دهکده مشاهده کنید. من قهرمان شما را بصورت فوری به اتمام ماجراجویی خواهم رساند تا متوجه شوید چه چیزی غنیمت گرفته است.';
$Definition['Quest']['Tutorial_11']['rewardDescription'] = 'قهرمان شما فوراً رسانده شد';
$Definition['Quest']['Tutorial_11']['todo'] = [0 => 'قهرمان خود را به ماجراجویی ارسال کنید',];
$Definition['Quest']['Tutorial_11']['steps'] = [0 => 'ماجراجویی قهرمان',];
$Definition['Quest']['Tutorial_12']['questTitle'] = 'گزارشات';
$Definition['Quest']['Tutorial_12']['questDescription'] = 'حالا قهرمان شما از ماجراجویی بازگشته و یک گزارش ثبت شده است. در منوی بالا بخش گزارشات میتوانید لیست گزارشات ذخیره شده ی خود را مشاهده کنید.';
$Definition['Quest']['Tutorial_12']['questDescriptionReward'] = 'شما قبل از این دیدید که غنیمت قهرمان در ماجراجویی چه بود. چه استفاده ای میتوان کرد? خب، قهرمان شما در ماجراجویی مقداری سلامتی از دست داده است، برای بهبود او مقداری پماد به شما خواهم داد.';
$Definition['Quest']['Tutorial_12']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeItem item106"> <span class="questRewardValue">'.Quest::calcEffect(10, 'item', true).'</span>';
$Definition['Quest']['Tutorial_12']['todo'] = [
    0 => 'لیست گزارشات را باز کن', 1 => 'گزارش ماجراجویی جدید را بخوان',
];
$Definition['Quest']['Tutorial_12']['steps'] = [
    0 => 'لیست گزارشات', 1 => 'خواندن گزارش',
];
$Definition['Quest']['Tutorial_13']['questTitle'] = 'بهبود قهرمان';
$Definition['Quest']['Tutorial_13']['questDescription'] = 'قهرمان شما در حال حاضر مقداری از سلامتی خود را از دست داده است. وارد بخش خصوصیات قهرمان بشوید. حالا روی تصویر پماد کلیک کرده و تعدادی دلخواه به آن بدهید و روی تایید کلیک کنید.';
$Definition['Quest']['Tutorial_13']['questDescriptionReward'] = 'تمامی اجناس در این بخش قابل استفاده میباشند. روی هر جنس که بروید مشخصات و توضیحات آن جنس را خواهد دید، تمامی اجناس قهرمان مورد استفاده و مفید خواهند بود.';
$Definition['Quest']['Tutorial_13']['rewardDescription'] = 'تجربه قهرمان شما 20 عدد افزایش یافت';
$Definition['Quest']['Tutorial_13']['todo'] = [
    0 => 'روی تصویر قهرمان کلیک کرده و وارد بخش خصوصیات او شوید',
    1 => 'روی تصویر پماد کلیک کرده و آن را مصرف کنید',
];
$Definition['Quest']['Tutorial_13']['steps'] = [
    0 => 'خصوصیات قهرمان', 1 => 'بهبود قهرمان',
];
$Definition['Quest']['Tutorial_14']['questTitle'] = 'راهنمای نمای داخلی';
$Definition['Quest']['Tutorial_14']['questDescription'] = 'کنار تصویر من, شما یک دکمه لامپ مشاهده میکنید. با کلیک بر روی آن میتوانید اطلاعاتی در رابطه با قسمت های مختلف بازی کسب کنید. یک بار امتحان کنید!';
$Definition['Quest']['Tutorial_14']['questDescriptionReward'] = 'اگر سوالی در طی بازی شما براتون پیش آمد به صفحه سوالات عمومی تراوین مراجعه کنید - همیشه به شما کمک خواهد کرد. برای مراجعه به این قسمت روی "i" در بالای همین صفحه کلیک کنید و یا پایین صفحه روی "سوالات متدوال" کلیک کنید.';
$Definition['Quest']['Tutorial_14']['rewardDescription'] = buildResourcesReward([270, 300, 270, 220]);
$Definition['Quest']['Tutorial_14']['todo'] = [0 => 'راهنمای داخلی بازی و بخش های کاربری را باز کنید',];
$Definition['Quest']['Tutorial_14']['steps'] = [0 => 'راهنمای نمای داخلی',];
$Definition['Quest']['Tutorial_15']['questTitle'] = 'پایان آموزش';
$Definition['Quest']['Tutorial_15']['questDescription'] = 'حالا شما با روند بازی آشنایی پیدا کرده اید. مهم ترین قسمت شروع بازی حمایت از تازه واردین بازی است که شما زمان آن را میتوانید در بخش اعلانات واقع در سمت راست صفحه مشاهده نمائید. از بازی لذت ببرید!';
$Definition['Quest']['Tutorial_15']['rewardDescription'] = 'آموزش به پایان رسیده است.';
$Definition['Quest']['Tutorial_15']['todo'] = [0 => 'آموزش به پایان رسیده است.',];
$Definition['Quest']['Tutorial_15']['steps'] = [0 => 'پایان آموزش بازی',];
$Definition['Quest']['Tutorial_15a']['questTitle'] = 'رد کردن آموزش';
$Definition['Quest']['Tutorial_15a']['questDescription'] = $Definition['Quest']['Tutorial_15a']['questDescriptionReward'] = 'برای شروع بازی, من تعدادی ساختمان و مقداری طلا به تو خواهم داد. وظایف خود را انجام داده و دهکده خود را گسترش بده. از بازی لذت ببرید!';
//$Definition['Quest']['Tutorial_15a']['rewardDescription'] = 'اردوگاه, آجر سازی, هیزم شکن 2, گندم زار 2, 10 طلا, 1 روز اکانت پلاس';
$Definition['Quest']['Tutorial_15a']['rewardDescription'] = 'اردوگاه, آجر سازی, هیزم شکن 2, گندم زار 2, 10 طلا, '.Quest::calcEffect(86400, 'plus', true).' اکانت پلاس';
$Definition['Quest']['Tutorial_15a']['steps'] = [0 => 'پایان آموزش بازی',];
$Definition['Quest']['battle_01_name'] = 'ماجراجویی بعدی';
$Definition['Quest']['battle_02_name'] = 'ساخت یک مخفیگاه';
$Definition['Quest']['battle_03_name'] = 'ساخت سربازخانه';
$Definition['Quest']['battle_04_name'] = 'سطح قهرمان';
$Definition['Quest']['battle_05_name'] = 'تربیت سرباز';
$Definition['Quest']['battle_06_name'] = 'ساخت دیوار دهکده';
$Definition['Quest']['battle_07_name'] = 'حمله به آبادی';
$Definition['Quest']['battle_08_name'] = '10 ماجراجویی';
$Definition['Quest']['battle_09_name'] = 'حراجی';
$Definition['Quest']['battle_10_name'] = 'ارتقاء سربازخانه';
$Definition['Quest']['battle_11_name'] = 'ساخت دارالفنون';
$Definition['Quest']['battle_12_name'] = 'تحقیق نیرو';
$Definition['Quest']['battle_13_name'] = 'ساخت آهنگری';
$Definition['Quest']['battle_14_name'] = 'تقویت یک نیرو';
$Definition['Quest']['battle_15_name'] = 'اتمام 5 ماجراجویی';
$Definition['Quest']['Battle_01']['questTitle'] = 'ماجراجویی بعدی';
$Definition['Quest']['Battle_01']['questDescription'] = 'در طول آموزش, شما غنیمت های فراوانی از ماجراجویی بدست خواهید آورد. قهرمان خود را به ماجراجویی بعدی ارسال کن و منتظر باش به دهکده بازگردد. بسیار سریع غنیمت شما به دستتان خواهد رسید.';
$Definition['Quest']['Battle_01']['questDescriptionReward'] = 'بسیار خوب, قهرمان شما در راه است. نکته: هر چقدر قهرمان شما درگیری بیشتری در جنگ ها و ماجراجویی داشته باشد سلامتی خود را از دست خواهد داد.';
$Definition['Quest']['Battle_01']['rewardDescription'] = '30 تجربه قهرمان';
$Definition['Quest']['Battle_01']['todo'] = [0 => 'قهرمان خود را به ماجراجویی دیگری ارسال کنید',];
$Definition['Quest']['Battle_02']['questTitle'] = 'ساخت یک مخفیگاه';
$Definition['Quest']['Battle_02']['questDescription'] = 'بازیکنان میتوانند منابع دهکده یکدیگر را غارت کنند. در شروع بازی شما با حمایت از تازه واردین امنیت دارید. برای جلوگیری از غارت منابع خود میتوانید از مخفیگاه استفاده کنید و آن را ارتقاء دهید.';
$Definition['Quest']['Battle_02']['questDescriptionReward'] = 'عالیه, حالا مقداری از منابع انبارهای دهکده ی شما در مخفیگاه جمع آوری میشود و دشمنان نمیتوانند آنرا غارت کنند. قسمت اعلانات را نگاه کن تا از زمان حمایت خود با خبر شوی.';
$Definition['Quest']['Battle_02']['rewardDescription'] = buildResourcesReward([130, 150, 120, 100]);
$Definition['Quest']['Battle_02']['todo'] = [0 => 'یک مخفیگاه در دهکده بنا کن',];
$Definition['Quest']['Battle_03']['questTitle'] = 'ساخت سربازخانه';
$Definition['Quest']['Battle_03']['questDescription'] = 'سربازخانه اولین ساختمان برای ساخت نیرو در دهکده میباشد. برای دفاع از دهکده و حمله به دهکده های دیگر نیاز به نیروی زیادی دارید که باید آنها را آماده کنید.';
$Definition['Quest']['Battle_03']['questDescriptionReward'] = 'سربازخانه ساخته شد، اولین قدم برای شروع یک امپراطوری!';
$Definition['Quest']['Battle_03']['rewardDescription'] = buildResourcesReward([110, 140, 160, 30]);
$Definition['Quest']['Battle_03']['todo'] = [0 => 'یک سربازخانه در دهکده بنا کن',];
$Definition['Quest']['Battle_04']['questTitle'] = 'سطح قهرمان';
$Definition['Quest']['Battle_04']['questDescription'] = 'هر موقع قهرمان شما یک سطح ارتقاء پیدا کند، مقداری امتیاز به او تعلق خواهد گرفت. وارد بخش خصوصیات قهرمان بشوید و امتیاز های داده شده را استفاده کنید.';
$Definition['Quest']['Battle_04']['questDescriptionReward'] = 'شما در هر زمان قادر به تغییر خصوصیات قهرمان میباشید. برای اینکار شما نیاز به کتاب دانش خواهید داشت که در حراجی و ماجراجویی یافت خواهد شد.';
$Definition['Quest']['Battle_04']['rewardDescription'] = buildResourcesReward([190, 250, 150, 110]);
$Definition['Quest']['Battle_04']['todo'] = [0 => 'امتیازهای داده شده به قهرمان را استفاده کنید',];
$Definition['Quest']['Battle_05']['questTitle'] = 'تربیت سرباز';
$Definition['Quest']['Battle_05']['questDescription'] = 'حالا زمان آن رسیده که تعدادی سرباز بسازید. در سربازخانه، شما قادر به ساخت انواع نیروهای تحقیق شده هستید.';
$Definition['Quest']['Battle_05']['questDescriptionReward'] = 'آغاز یک امپراطوری قدرتمند! همیشه یادتان باشد که همسایگان شما نیز ممکن است که دارای نیرو باشد، با دقت حمله کنید.';
$Definition['Quest']['Battle_05']['rewardDescription'] = '<img src="img/x.gif" class="questRewardTypeItem item114"> <span class="questRewardValue">1</span>';
$Definition['Quest']['Battle_05']['todo'] = [0 => '2 سرباز در سربازخانه تربیت کن',];
$Definition['Quest']['Battle_06']['questTitle'] = 'ساخت دیوار دهکده';
$Definition['Quest']['Battle_06']['questDescription'] = 'حالا شما باید پایه دفاع از دهکده را بنا کنید. برای اینکار نیاز به ساخت دیوار دهکده دارید، دیوار به قدرت دفاعی شما در برابر دشمنان کمک زیادی خواهد کرد.';
$Definition['Quest']['Battle_06']['questDescriptionReward'] = 'عالیه، حالا امنیت دفاعی دهکده ی شما بالاتر خواهد رفت.';
$Definition['Quest']['Battle_06']['rewardDescription'] = buildResourcesReward([120, 120, 90, 50]);
$Definition['Quest']['Battle_06']['todo'] = [0 => 'دیوار دهکده خود را بساز',];
$Definition['Quest']['Battle_07']['questTitle'] = 'حمله به آبادی';
$Definition['Quest']['Battle_07']['questDescription'] = 'در نقشه جستجو کن و به یک آبادی حمله کنید. در نظر داشته باشید که اگر در آن آبادی حیوانات زیادی باشند بیشتر صدمه خواهید دید.';
$Definition['Quest']['Battle_07']['questDescriptionReward'] = 'عالیه، اولین حمله ی شما در راه است! شما در زمان محدودی از شروع حمله قادر به لغو حمله میباشید.';
$Definition['Quest']['Battle_07']['rewardDescription'] = Quest::calcEffect(2, 'troops', true) . ' سرباز پایه';
$Definition['Quest']['Battle_07']['todo'] = [0 => 'به یک آبادی حمله کن',];
$Definition['Quest']['Battle_08']['questTitle'] = '10 ماجراجویی';
$Definition['Quest']['Battle_08']['questDescription'] = 'به ماجراجویی ها ادامه بده. بعد از اتمام 10 ماجراجویی اول شما قادر به شرکت در حراجی اجناس قهرمان و مبادله طلا با نقره خواهید بود.';
$Definition['Quest']['Battle_08']['questDescriptionReward'] = 'عالیه، حالا شما میتوانید در حراجی شرکت کنید. نقره جمع آوری کنید و آنها را تبدیل به طلا کنید و در دهکده استفاده کنید.';
$Definition['Quest']['Battle_08']['rewardDescription'] = '500 سکه نقره';
$Definition['Quest']['Battle_08']['todo'] = [0 => '10 ماجراجویی انجام بده',];
$Definition['Quest']['Battle_09']['questTitle'] = 'حراجی';
$Definition['Quest']['Battle_09']['questDescription'] = 'در حراجی اجناس قهرمان شرکت کن';
$Definition['Quest']['Battle_09']['questDescriptionReward'] = 'عالیه, حالا شما میدانید بهترین معامله با بازیکن های دیگر در حراجی به چه صورت خواهد بود.';
$Definition['Quest']['Battle_09']['rewardDescription'] = buildResourcesReward([280, 120, 220, 110]);
$Definition['Quest']['Battle_09']['todo'] = [0 => 'در حراجی های اجناس قهرمان شرکت کن.',];
$Definition['Quest']['Battle_10']['questTitle'] = 'ارتقاء سربازخانه';
$Definition['Quest']['Battle_10']['questDescription'] = 'سربازخانه خود را ارتقاء بده. با اینکار سرعت ساخت سربازان بیشتر خواهد شد و ساختمان های دیگری آزاد خواهند شد.';
$Definition['Quest']['Battle_10']['questDescriptionReward'] = 'خوب است. حالا سربازان شما سریعتر ساخته خواهند شد و قادر به ساخت دارالفنون میباشید.';
$Definition['Quest']['Battle_10']['rewardDescription'] = buildResourcesReward([440, 290, 430, 240]);
$Definition['Quest']['Battle_10']['todo'] = [0 => 'سربازخانه خود را به سطح 3 برسانید.',];
$Definition['Quest']['Battle_11']['questTitle'] = 'ساخت دارالفنون';
$Definition['Quest']['Battle_11']['questDescription'] = 'نیروها و لشکریان جدید در دارالفنون تحقیق میشوند. بعضی از نیروها قدرت بیشتر نسبت به دیگری دارند که باعث قدرتمند تر شدن شما میشوند.';
$Definition['Quest']['Battle_11']['questDescriptionReward'] = 'انجامش دادی. بزودی اطلاعات بیشتر در مورد نیروهای نژاد خود کسب خواهید کرد.';
$Definition['Quest']['Battle_11']['rewardDescription'] = buildResourcesReward([210, 170, 245, 115]);
$Definition['Quest']['Battle_11']['todo'] = [0 => 'دارالفنون بنا کن.',];
$Definition['Quest']['Battle_12']['questTitle'] = 'تحقیق نیرو';
$Definition['Quest']['Battle_12']['questDescription'] = 'نیروهای قابل تحقیق خود را بررسی کن. در اینجا نیروهای سواره نظام و پیاده نظام مشاهده میکنید. نیروها از پایه هم دفاعی هستند و هم هجومی.';
$Definition['Quest']['Battle_12']['questDescriptionReward'] = 'فقط 1 تحقیق کافی نیست به مرور زمان آنها را بیشتر کنید; حال نیروی تحقیق شده در ساختمان مربوط به خود قابل تربیت میباشد.';
$Definition['Quest']['Battle_12']['rewardDescription'] = buildResourcesReward([450, 435, 515, 550]);
$Definition['Quest']['Battle_12']['todo'] = [0 => 'یک نیرو به دلخواه تحقیق کن.',];
$Definition['Quest']['Battle_13']['questTitle'] = 'ساخت آهنگری';
$Definition['Quest']['Battle_13']['questDescription'] = 'آهنگری در قدرتمندتر کردن لشکریان شما نقش مهمی را ایفا میکند. توسط آهنگری صلاح های لشکریان شما قدرتمند میشوند.';
$Definition['Quest']['Battle_13']['questDescriptionReward'] = 'خوب بود. حالا شما قادر به تقویت نیروهای خود میباشید.';
$Definition['Quest']['Battle_13']['rewardDescription'] = buildResourcesReward([500, 400, 700, 400]);
$Definition['Quest']['Battle_13']['todo'] = [0 => 'آهنگری بنا کن.',];
$Definition['Quest']['Battle_14']['questTitle'] = 'تقویت یک نیرو';
$Definition['Quest']['Battle_14']['questDescription'] = 'تقویت یک سرباز تا 20 مرحله قابل انجام خواهد بود، شما تمامی نیروهای تحقیق شده ی خود را در آهنگری مشاهده خواهید کرد.';
$Definition['Quest']['Battle_14']['questDescriptionReward'] = 'عالیه، حالا نیروی شما نسبت به قبل قدرتمند تر شده است.';
$Definition['Quest']['Battle_14']['rewardDescription'] = '
								<img src="img/x.gif" class="questRewardTypeItem item112"> <span class="questRewardValue">'.Quest::calcEffect(10, 'item', true).'</span>
							';
$Definition['Quest']['Battle_14']['todo'] = [0 => 'یک نیرو به دلخواه تقویت کن.',];
$Definition['Quest']['Battle_15']['questTitle'] = 'اتمام 5 ماجراجویی';
$Definition['Quest']['Battle_15']['questDescription'] = 'ماجراجویی بیشتر یعنی منابع و تجربه بیشتر.قهرمان خود را فعال نگه دارید درعین حال به او استراحت دهید تا سلامتی اش باز گردد.';
//Ointments can be used to heal your hero. If you equip ointments they will be used as soon as the hero takes damage.
$Definition['Quest']['Battle_15']['questDescriptionReward'] = 'پماد می تواند سلامتی قهرمان شما را افزایش دهد.اگر به آن تجهیز شود تا زمانی که آصسیب ببیند از پماد استفاده می شود.';
$Definition['Quest']['Battle_15']['rewardDescription'] = '
								<img src="img/x.gif" class="questRewardTypeItem item106"> <span class="questRewardValue">'.Quest::calcEffect(15, 'item', true).'</span>
							';

$Definition['Quest']['Battle_15']['todo'] = [0 => 'اتمام 5 ماجراجویی',];
$Definition['Quest']['economy_01_name'] = 'ارتقاء معدن آهن';
$Definition['Quest']['economy_02_name'] = 'ارتقاء منابع بیشتر';
$Definition['Quest']['economy_03_name'] = 'انبار غذا';
$Definition['Quest']['economy_04_name'] = 'همه به سطح یک';
$Definition['Quest']['economy_05_name'] = 'از هر منبع یکی به سطح 2';
$Definition['Quest']['economy_06_name'] = 'ساخت بازار';
$Definition['Quest']['economy_07_name'] = 'معامله در بازار منابع';
$Definition['Quest']['economy_08_name'] = 'همه منابع به سطح 2';
$Definition['Quest']['economy_09_name'] = 'انبار به سطح 3';
$Definition['Quest']['economy_10_name'] = 'انبار غذا به سطح 3';
$Definition['Quest']['economy_11_name'] = 'ساخت آسیاب';
$Definition['Quest']['economy_12_name'] = 'همه منابع به سطح 5';
$Definition['Quest']['Economy_01']['questTitle'] = 'ارتقاء معدن آهن';
$Definition['Quest']['Economy_01']['questDescription'] = 'سفارش ساخت یک معدن آهن بده! مهمترین گزینه در منابع شما آهن میباشد که تقریباً همه جا به کار خواهد آمد.';
$Definition['Quest']['Economy_01']['questDescriptionReward'] = 'تولید آهن شما بیشتر شد. یک جایزه تولید بیشتر کل منابع به شما اهداء خواهد شد.';
$Definition['Quest']['Economy_01']['rewardDescription'] = Quest::calcEffect(86400, 'productionBoost', true) . ' تولید 25% منابع بیشتر در ساعت برای تمامی منابع';
$Definition['Quest']['Economy_01']['todo'] = [0 => 'شروع به ساخت یک معدن آهن کن',];
$Definition['Quest']['Economy_02']['questTitle'] = 'ارتقاء منابع بیشتر';
$Definition['Quest']['Economy_02']['questDescription'] = 'یک هیزم شکن، آجرسازی، معدن آهن و گندم زار را به سطح 1 برسان. برای تکمیل این وظیفه شما نیاز دارید از هر 4 خانه 2 خانه را به سطح 1 برسانید.';
$Definition['Quest']['Economy_02']['questDescriptionReward'] = 'تولید آهن شما بیشتر شد. یک جایزه تولید بیشتر کل منابع به شما اهداء خواهد شد.';
$Definition['Quest']['Economy_02']['rewardDescription'] = 'یک ساعت تولید 25% منابع بیشتر در ساعت برای تمامی منابع';
$Definition['Quest']['Economy_02']['todo'] = [0 => 'از هر منبع یکی دیگر را به سطح 1 برسان.',];
$Definition['Quest']['Economy_03']['questTitle'] = 'انبار غذا';
$Definition['Quest']['Economy_03']['questDescription'] = 'انبار غذا به جمع آوری گندم بیشتر در دهکده کمک خواهد کرد.';
$Definition['Quest']['Economy_03']['questDescriptionReward'] = 'عالیست! حالا گندم بیشتری قابل ذخیره سازی میباشد، با رساندن انبار به سطح 20 قادر به ساخت یک انبار دیگر میباشید.';
$Definition['Quest']['Economy_03']['rewardDescription'] = buildResourcesReward([250, 290, 100, 130]);
$Definition['Quest']['Economy_03']['todo'] = [0 => 'یک انبار غذا بنا کن.',];
$Definition['Quest']['Economy_04']['questTitle'] = 'همه به سطح یک';
$Definition['Quest']['Economy_04']['questDescription'] = 'حالا نیاز به گسترش دهکده خواهید داشت، برای شروع باید تولیدات خود را افزایش دهید.';
$Definition['Quest']['Economy_04']['questDescriptionReward'] = 'خوب است، حالا تولیدات منابع دهکده شما بیشتر شده و میتوانید ساختمان های بیشتری بسازید.';
$Definition['Quest']['Economy_04']['rewardDescription'] = buildResourcesReward([400, 460, 330, 270]);
$Definition['Quest']['Economy_04']['todo'] = [0 => 'همه منابع را به سطح 1 برسان.',];
$Definition['Quest']['Economy_05']['questTitle'] = 'از هر منبع یکی به سطح 2';
$Definition['Quest']['Economy_05']['questDescription'] = 'حالا از هر منبع یکی را به سطح 2 برسانید، برای به اتمام رساندن این وظیفه از هر نوع منبع یکی به سطح 2 کافیست.';
$Definition['Quest']['Economy_05']['questDescriptionReward'] = 'تولیدات چوب، خشت، آهن و گندم شما بیشتر شده است.';
$Definition['Quest']['Economy_05']['rewardDescription'] = buildResourcesReward([240, 255, 190, 160]);
$Definition['Quest']['Economy_05']['todo'] = [0 => 'از هر منبع یکی را به سطح 2 برسان.',];
$Definition['Quest']['Economy_06']['questTitle'] = 'ساخت بازار';
$Definition['Quest']['Economy_06']['questDescription'] = 'در بازار شما قادر به ارسال منابع به دهکده های دیگر و یا مبادله منابع با بازیکن های دیگر خواهید بود. آغاز تجارت شما از این ساختمان است.';
$Definition['Quest']['Economy_06']['questDescriptionReward'] = 'عالیست، حالا شما میتوانید از امکانات بازار مثل ارسال منابع و یا تعدیل منابع استفاده کنید.';
$Definition['Quest']['Economy_06']['rewardDescription'] = '
								<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">'.Quest::getInstance()->multiply(600).'</span>
							';
$Definition['Quest']['Economy_06']['todo'] = [0 => 'یک بازار در دهکده بنا کن.',];
$Definition['Quest']['Economy_07']['questTitle'] = 'معامله در بازار منابع';
$Definition['Quest']['Economy_07']['questDescription'] = 'خوب است، شما اولین تجارت خود را انجام دادید. به مرور زمان روش سود کردن در تجارت را متوجه خواهید شد.';
$Definition['Quest']['Economy_07']['questDescriptionReward'] = 'عالیست، حالا شما میتوانید از امکانات بازار مثل ارسال منابع و یا تعدیل منابع استفاده کنید.';
$Definition['Quest']['Economy_07']['rewardDescription'] = buildResourcesReward([100, 99, 99, 99]);
$Definition['Quest']['Economy_07']['todo'] = [0 => 'در بازار منابع معامله کن.',];
$Definition['Quest']['Economy_08']['questTitle'] = 'همه منابع به سطح 2';
$Definition['Quest']['Economy_08']['questDescription'] = 'عالیست! تولیدات منابع شما دوباره افزایش یافت و حالا قادر به گسترش و ارتقاء ساختمان های دیگر میباشید.';
$Definition['Quest']['Economy_08']['questDescriptionReward'] = 'عالیست، حالا شما میتوانید از امکانات بازار مثل ارسال منابع و یا تعدیل منابع استفاده کنید.';
$Definition['Quest']['Economy_08']['rewardDescription'] = buildResourcesReward([400, 400, 400, 200]);
$Definition['Quest']['Economy_08']['todo'] = [0 => 'همه منابع را به سطح 2 برسان.',];
$Definition['Quest']['Economy_09']['questTitle'] = 'انبار به سطح 3';
$Definition['Quest']['Economy_09']['questDescription'] = 'خوب، حالا که تولیدات منابع شما زیاد شده باید انبار خود را ارتقاء دهید تا بتوانید منابع تولید شده را ذخیره کنید در غیر اینصورت انبار شما پر خواهد شد.';
$Definition['Quest']['Economy_09']['questDescriptionReward'] = 'خوب است، حالا انبارهای شما توانایی ذخیره منابع بیشتری دارند، ظرفیت انبار را در همان ساختمان میتوانید مشاهده کنید..';
$Definition['Quest']['Economy_09']['rewardDescription'] = buildResourcesReward([620, 750, 560, 230]);
$Definition['Quest']['Economy_09']['todo'] = [0 => 'انبار دهکده را به سطح 3 ارتقاء بده.',];
$Definition['Quest']['Economy_10']['questTitle'] = 'انبار غذا به سطح 3';
$Definition['Quest']['Economy_10']['questDescription'] = 'بعد از انبار شما برای ذخیره کردن گندم نیاز به ارتقاء انبار غذا دارید، هرچقدر سطح انبار غذا بالاتر باشد گندم بیشتری قابل ذخیره شدن میباشد.';
$Definition['Quest']['Economy_10']['questDescriptionReward'] = 'عالیست، حالا همانند انبار، انبار غذای شما نیز به سطح 3 ارتقاء پیدا کرده و گندم بیشتری را ذخیره خواهد کرد.';
$Definition['Quest']['Economy_10']['rewardDescription'] = buildResourcesReward([880, 1020, 590, 320]);
$Definition['Quest']['Economy_10']['todo'] = [0 => 'انبار غذای دهکده را به سطح 3 برسان.',];
$Definition['Quest']['Economy_11']['questTitle'] = 'ساخت آسیاب';
$Definition['Quest']['Economy_11']['questDescription'] = 'تولیدات گندم شما توسط 2 ساختمان دیگر قابل افزایش میباشد که یکی از این دو ساختمان آسیاب میباشد که تا سطح 5 قابل ارتقاء است.';
$Definition['Quest']['Economy_11']['questDescriptionReward'] = 'آسیاب از سطح 1 به سطح 2 ارتقاء خواهد کرد.';
$Definition['Quest']['Economy_11']['rewardDescription'] = 'آسیاب از سطح 1 به سطح 2 ارتقاء خواهد کرد.';
$Definition['Quest']['Economy_11']['todo'] = [0 => 'در دهکده آسیاب بنا کن.',];
$Definition['Quest']['Economy_12']['questTitle'] = 'همه منابع به سطح 5';
$Definition['Quest']['Economy_12']['questDescription'] = 'خوب، وقت آن رسیده که تولیدات دهکده را به سطح پیشرفته ای ارتقاء دهید تا توانایی ساخت ساختمان های بیشتر و نیروهای بیشتری را داشته باشید.';
$Definition['Quest']['Economy_12']['questDescriptionReward'] = 'بسیار عالی، حالا تولیدات شما سرعت بیشتری پیدا کرده اند قادر به انجام کارهای زیادی میباشید، دهکده در حال رونق گرفتن میباشد.';
$Definition['Quest']['Economy_12']['rewardDescription'] = Quest::calcEffect(86400, 'productionBoost', true) . ' تولید 25% منابع بیشتر در ساعت برای تمامی منابع';
$Definition['Quest']['Economy_12']['todo'] = [0 => 'همه منابع را به سطح 5 برسانید.',];
$Definition['Quest']['World_01']['questTitle'] = 'دیدن بخش آمار';
$Definition['Quest']['World_01']['questDescription'] = 'در بخش آمار، تمامی بازیکنان و اتحاد ها به همراه تاپ 10 امتیازات غارت، هجوم و ... درج شده است.';
$Definition['Quest']['World_01']['questDescriptionReward'] = 'این قسمت از آمار اطلاعات خوبی به شما خواهد داد. در بخش تاپ 10 امتیازات مربوط به هجوم، دفاع، غارت و پیشرفت 10 بازیکن برتر درج شده است.';
$Definition['Quest']['World_01']['rewardDescription'] = buildResourcesReward([90, 120, 60, 30]);
$Definition['Quest']['World_01']['todo'] = [0 => 'در بالای صفحه روی قسمت آمار کلیک کنید.',];
$Definition['Quest']['World_02']['questTitle'] = 'تغییر نام دهکده';
$Definition['Quest']['World_02']['questDescription'] = 'در قسمت بالا سمت چپ نام دهکده خود را مشاهده میکنید، روی دکمه تغییر کلیک کنید و نام دهکده را تغییر دهید.';
$Definition['Quest']['World_02']['questDescriptionReward'] = 'آفرین، اینگونه میتوانی نام تمامی دهکده های خود را به نامی دلخواه و زیبا تغییر دهید.';
$Definition['Quest']['World_02']['rewardDescription'] = Quest::calcEffect(100, 'cp', true) . ' امتیاز فرهنگی';
$Definition['Quest']['World_02']['todo'] = [0 => 'نام دهکده خود را به نامی زیبا تغییر دهید.',];
$Definition['Quest']['World_03']['questTitle'] = 'ساختمان اصلی به سطح 3';
$Definition['Quest']['World_03']['questDescription'] = 'با ارتقاء ساختمان اصلی، سرعت ساخت ساختمان های دیگر افزایش پیدا خواهد کرد، هر چه سطح ساختمان اصلی بالاتر باشد سرعت ساخت ساختمان ها نیز بالاتر خواهد رفت و ساخت تعدادی از ساختمان ها آزاد خواهد شد.';
$Definition['Quest']['World_03']['questDescriptionReward'] = 'عالیه, حالا سرعت ساخت ساختمان های دیگر افزایش پیدا کرده و تعدادی از ساختمان ها برای ساخت آزاد شدند.';
$Definition['Quest']['World_03']['rewardDescription'] = buildResourcesReward([170, 100, 130, 70]);
$Definition['Quest']['World_03']['todo'] = [0 => 'ساختمان اصلی را به سطح 3 ارتقا دهید.',];
$Definition['Quest']['World_04']['questTitle'] = 'ساخت سفارت';
$Definition['Quest']['World_04']['questDescription'] = 'تراوین یک بازی چند نفره هستش که شما برای دفاع از خود بهتره که با تعدادی از بازیکن ها دوست بشوید. بهترین راه برای هم پیمان شدن با بازیکنان دیگر تشکیل یک اتحاد است. سفارت بساز و وارد یک اتحاد شو.';
$Definition['Quest']['World_04']['questDescriptionReward'] = 'عالیست، حالا شما میتوانید توسط سفارت یک اتحاد تشکیل دهید و یا توسط دعوتنامه بقیه بازیکن ها وارد اتحاد آنها بشوی.';
$Definition['Quest']['World_04']['rewardDescription'] = buildResourcesReward([215, 145, 195, 50]);
$Definition['Quest']['World_04']['todo'] = [0 => 'یک سفارت در دهکده بنا کنید.',];
$Definition['Quest']['World_05']['questTitle'] = 'مشاهده نقشه';
$Definition['Quest']['World_05']['questDescription'] = 'نقشه تراوین ابزاری برای دیدکلی دنیای تراوین میباشد. همسایگان و آبادی های اطراف خود را بررسی کنید.';
$Definition['Quest']['World_05']['questDescriptionReward'] = 'آیا دوست و یا هم اتحادی در اطراف شما هست? نقشه به شما کمک خواهد کرد که آبادی های مورد نظر را غارت کنید و یا خانه ی دهکده ی بعدی خود را پیدا کنید.';
$Definition['Quest']['World_05']['rewardDescription'] = buildResourcesReward([90, 160, 90, 95]);
$Definition['Quest']['World_05']['todo'] = [0 => 'روی نقشه کلیک کنید.',];
$Definition['Quest']['World_06']['questTitle'] = 'مشاهده پیام ها';
$Definition['Quest']['World_06']['questDescription'] = 'زمانی که شما پیغام جدیدی دریافت میکنید چراغ بالای بخش پیامها روشن خواهد شد و تعداد نامه های خوانده نشده را نشان میدهد. یک نگاهی بیانداز.';
$Definition['Quest']['World_06']['questDescriptionReward'] = 'خوب است، حالا میتوانی از این طریق با دیگر بازیکنان دنیای تراوین مکاتبه و نامه نگاری کنید.';
$Definition['Quest']['World_06']['rewardDescription'] = buildResourcesReward([280, 315, 200, 145]);
$Definition['Quest']['World_06']['todo'] = [0 => 'وارد بخش پیام ها شوید.',];
$Definition['Quest']['World_07']['questTitle'] = 'مزایای طلا';
$Definition['Quest']['World_07']['questDescription'] = 'در طول آموزش، متوجه شدید که سکه طلا در چه قسمت های به شما کمک خواهد کرد که از بازیکن های دیگر سریعتر پیشرفت کنید. در بخش مربوط به سکه طلا، شما گزینه های مختلف را خواهید دید.';
$Definition['Quest']['World_07']['questDescriptionReward'] = 'من به تو مقداری سکه طلای رایگان خواهم داد، این سکه ها را میتوانی در امکانات پلاس خرج کنی.';
$Definition['Quest']['World_07']['rewardDescription'] = '
								<img src="img/x.gif" class="questRewardTypeGold"> <span class="questRewardValue">20</span>
							';
$Definition['Quest']['World_07']['todo'] = [0 => 'سکه طلا',];
$Definition['Quest']['World_08']['questTitle'] = 'اتحاد';
$Definition['Quest']['World_08']['questDescription'] = 'وارد یک اتحاد شو. اگر شما دوستی ندارید که وارد اتحاد او شوید میتوانید با رساندن سفارت به سطح 3 یک اتحاد تشکیل دهید.';
$Definition['Quest']['World_08']['questDescriptionReward'] = 'شروع خوبی بود. با فعالیت و همکاری بیشتر با بازیکن های دیگه بازی جذاب تر خواهد شد، و روابط دیپلماسی شما قوی تر خواهد شد.';
$Definition['Quest']['World_08']['rewardDescription'] = buildResourcesReward([295, 210, 235, 185]);
$Definition['Quest']['World_08']['todo'] = [0 => 'وارد یک اتحاد شوید.',];
$Definition['Quest']['World_09']['questTitle'] = 'ساختمان اصلی به سطح 5';
$Definition['Quest']['World_09']['questDescription'] = 'حالا زمان ارتقاء ساختمان اصلی میباشد, پس از آن میتوانید ساختمان های جدید بسازید. یادت باشه که منابع مصرفی را به موقع تولید کنی.';
$Definition['Quest']['World_09']['questDescriptionReward'] = 'عالیه, حالا میتوانی اقامتگاه بنا کنی. سرعت ساخت ساختمان ها نیز افزایش پیدا کرد.';
$Definition['Quest']['World_09']['rewardDescription'] = buildResourcesReward([570, 470, 560, 265]);
$Definition['Quest']['World_09']['todo'] = [0 => 'ساختمان اصلی را به سطح 5 برسانید.',];
$Definition['Quest']['World_10']['questTitle'] = 'ساخت اقامتگاه';
$Definition['Quest']['World_10']['questDescription'] = 'ساخت یک اقامتگاه را شروع کن که پایه اصلی بنای دهکده ی جدید میباشد. اگر این دهکده، پایتخت میباشد لطفاً اقامتگاه بسازید.';
$Definition['Quest']['World_10']['questDescriptionReward'] = 'خوب است، حالا شما دارای اقامتگاه میباشید. با افزایش تولیدات و جمع آوری منابع بیشتر سعی کنید اقامتگاه را به سطح 10 برسانید تا بتوانید دهکده جدید بنا کنید.';
$Definition['Quest']['World_10']['rewardDescription'] = buildResourcesReward([525, 420, 620, 335]);
$Definition['Quest']['World_10']['todo'] = [0 => 'یک اقامتگاه در دهکده بنا کن.',];
$Definition['Quest']['World_11']['questTitle'] = 'امتیاز فرهنگی';
$Definition['Quest']['World_11']['questDescription'] = 'برای گسترش امپراطوری و بنای دهکده ی جدید نیاز به امتیاز فرهنگی دارید. وارد اقامتگاه بشوید و روی امتیاز فرهنگی کلیک کنید.';
$Definition['Quest']['World_11']['questDescriptionReward'] = 'خوب است، در این قسمت اطلاعاتی در رابطه با امتیاز فرهنگی دهکده های خود بدست خواهید آورد.';
$Definition['Quest']['World_11']['rewardDescription'] = buildResourcesReward([650, 800, 740, 530]);
$Definition['Quest']['World_11']['todo'] = [0 => 'به بخش امتیاز فرهنگی در قصر یا اقامتگاه برو.',];
$Definition['Quest']['World_12']['questTitle'] = 'انبار به سطح 7';
$Definition['Quest']['World_12']['questDescription'] = 'با گسترش منابع و ساختمان ها برای رونق دهی دهکده حالا نیاز دارید که انبار خود را ارتقاء بدید که منابع بیشتری قابل ذخیره سازی باشد.';
$Definition['Quest']['World_12']['questDescriptionReward'] = 'عالیست، حالا ظرفیت انبار چوب، خشت و آهن شما افزایش پیدا کرده و مقدار قابل توجهی منابع میتوانید ذخیره کنید.';
$Definition['Quest']['World_12']['rewardDescription'] = buildResourcesReward([2650, 2150, 1810, 1320]);
$Definition['Quest']['World_12']['todo'] = [0 => 'انبار دهکده را به سطح 7 ارتقاء دهید.',];
$Definition['Quest']['World_13']['questTitle'] = 'گزارشات اطراف';
$Definition['Quest']['World_13']['questDescription'] = 'در قسمت گزارشات یک بخشی به اسم گزارشات اطراف وجود داره که در آن میتوانید اتفاقات و رویدادهایی که در اطراف دهکده شما رخ داده مشاهده کنید.';
$Definition['Quest']['World_13']['questDescriptionReward'] = 'با این قسمت نیز آشنا شدید، گزارشات اطراف به برنامه ریزی حملات شما کمک زیادی خواهد کرد.';
$Definition['Quest']['World_13']['rewardDescription'] = buildResourcesReward([800, 700, 750, 600]);
$Definition['Quest']['World_13']['todo'] = [0 => 'گزارشات و رویدادهای اطراف را مشاهده کنید.',];
$Definition['Quest']['World_14']['questTitle'] = 'اقامتگاه به سطح 10';
$Definition['Quest']['World_14']['questDescription'] = 'همانطور که در وظایف قبل به شما گفته شد برای بنا کردن دهکده ی جدید باید اقامتگاه را به سطح 10 برسانید و 3 مهاجر تربیت کنید.';
$Definition['Quest']['World_14']['questDescriptionReward'] = 'عالیست، حالا زمینه برای تربیت 3 مهاجر آماده است اما باید به منابع خود توجه کنید چون تربیت مهاجر هزینه بالایی دارد.';
$Definition['Quest']['World_14']['rewardDescription'] =  Quest::calcEffect(500, 'cp', true) . ' امتیاز فرهنگی';
$Definition['Quest']['World_14']['todo'] = [0 => 'اقامتگاه را به سطح 10 ارتقاء دهید.',];
$Definition['Quest']['World_15']['questTitle'] = '3 مهاجر';
$Definition['Quest']['World_15']['questDescription'] = 'حال زمان آن رسیده که 3 مهاجر تربیت کنید و آنها را برای بنای دهکده ی جدید ارسال کنید.';
$Definition['Quest']['World_15']['questDescriptionReward'] = 'خوب است، حالا شما باید در نقشه جستجو کنید و خانه ی مورد نظر خود را انتخاب کنید، مهاجرها را به آنجا ارسال کنید تا دهکده جدید شما بنا شود.';
$Definition['Quest']['World_15']['rewardDescription'] = buildResourcesReward([1050, 800, 900, 750]);
$Definition['Quest']['World_15']['todo'] = [0 => '3 مهاجر در اقامتگاه برای احداث دهکده جدید تربیت کن.',];
$Definition['Quest']['World_16']['questTitle'] = 'احداث دهکده جدید';
$Definition['Quest']['World_16']['questDescription'] = 'حالا همه چی آماده شده برای گسترش امپراطری خود، تنها یک قدم تا بنای دهکده ی بعدی شما باقی مانده است. مهاجرهای ساخته شده را برای بنای دهکده جدید ارسال کن.';
$Definition['Quest']['World_16']['questDescriptionReward'] = 'بسیار عالی، حال شما جزء قدرتمندترین امپراطوری های دنیای تراوین هستید. به همین روند بازی ادامه بدید و نیروهای زیادی تربیت کنید تا بتوانید در مقابل دشمنان پیروز بشوید.';
$Definition['Quest']['World_16']['rewardDescription'] = Quest::calcEffect(172800, 'plus', true) . ' اکانت پلاس شما فعال خواهد بود.';
$Definition['Quest']['World_16']['todo'] = [0 => 'دهکده ی جدید بنا کنید.',];
$Definition['Quest']['world_01_name'] = 'دیدن بخش آمار';
$Definition['Quest']['world_02_name'] = 'تغییر نام دهکده';
$Definition['Quest']['world_03_name'] = 'ساختمان اصلی به سطح 3';
$Definition['Quest']['world_04_name'] = 'ساخت سفارت';
$Definition['Quest']['world_05_name'] = 'مشاهده نقشه';
$Definition['Quest']['world_06_name'] = 'مشاهده پیام ها';
$Definition['Quest']['world_07_name'] = 'مزایای طلا';
$Definition['Quest']['world_08_name'] = 'اتحاد';
$Definition['Quest']['world_09_name'] = 'ساختمان اصلی به سطح 5';
$Definition['Quest']['world_10_name'] = 'ساخت اقامتگاه';
$Definition['Quest']['world_11_name'] = 'امتیاز فرهنگی';
$Definition['Quest']['world_12_name'] = 'انبار به سطح 7';
$Definition['Quest']['world_13_name'] = 'گزارشات اطراف';
$Definition['Quest']['world_14_name'] = 'اقامتگاه به سطح 10';
$Definition['Quest']['world_15_name'] = '3 مهاجر';
$Definition['Quest']['world_16_name'] = 'احداث دهکده جدید';
//

$Definition['RallyPoint']['greyAreaNewVillageCaution'] = 'اخطار! اگر در این مختصات دهکده‌ی جدیدی بنا کنید ناتارها به آن حمله کرده و سعی خواهند کرد شما را از محدوده‌ی خود دور نگه دارند. <br>
دهکدەهایی که در محدوده‌ی ناتارها می‌باشند، امتیاز فرهنگی تولید نخواهند کرد.';
$Definition['RallyPoint']['Changed successfully: %s will be the new home village for hero'] = 'با موفقیت تغییر یافت: %s دهکده‌ی محل اقامت جدید قهرمان خواهد شد.';
$Definition['RallyPoint']['nowSettlersWillGoNeedsXResources'] = 'حال مهاجرها برای بنای دهکده‌ی جدید شروع به حرکت خواهند کرد. <br>
بنای دهکده‌ی جدید به %s واحد از هر منبع (چوب، خشت، آهن و گندم) نیاز دارد.';
$Definition['RallyPoint']['Settlers']['notEnoughResources'] = 'منابع کافی موجود نیست.';
$Definition['RallyPoint']['sendBack'] = 'بازگرداندن';
$Definition['RallyPoint']['reinforcement'] = 'نیروی کمکی';
$Definition['RallyPoint']['normal'] = 'عادی';
$Definition['RallyPoint']['raid'] = 'غارت';
$Definition['RallyPoint']['attack'] = 'حمله';
$Definition['RallyPoint']['Village'] = 'دهکده';
$Definition['RallyPoint']['changeHeroHomeVillage'] = 'تغییر خانه قهرمان';
$Definition['RallyPoint']['or'] = 'یا';
$Definition['RallyPoint']['number'] = 'تعداد';
$Definition['RallyPoint']['withdraw'] = 'پس کشیدن';
$Definition['RallyPoint']['reviving'] = 'احیا کردن';
$Definition['RallyPoint']['createNewVillage'] = 'بنای دهکده جدید';
$Definition['RallyPoint']['spy'] = 'جاسوسی';
$Definition['RallyPoint']['supply'] = 'نیروی کمکی';
$Definition['RallyPoint']['Errors']['activeVillageChanged'] = 'دهکده فعال تغییر یافته است.';
$Definition['RallyPoint']['Errors']['EnterCoordinateOrDname'] = 'مختصات را وارد کنید.';
$Definition['RallyPoint']['Errors']['noVillageWithThisName'] = 'دهکده ای با این نام یافت نشد.';
$Definition['RallyPoint']['Errors']['noVillageInCoordinate'] = 'دهکده یا آبادی در این مختصات یافت نشد.';
$Definition['RallyPoint']['Errors']['NatarCapitalError'] = 'شما به پایتخت ناتار ها نمی توانید حمله کنید.';
$Definition['RallyPoint']['Errors']['noTroopsSelected'] = 'حداقل یک نیرو انتخاب کنید.';
$Definition['RallyPoint']['Errors']['playerHasBeginnerProtection'] = 'این بازیکن تحت حمایت است.';
$Definition['RallyPoint']['Errors']['cantAttackUrSelf'] = 'شما به خودتان نمی توانید حمله کنید.';
$Definition['RallyPoint']['Errors']['cantAttackDuringProtection'] = 'در زمان حمایت نمی توانید حمله کنید.';
$Definition['RallyPoint']['Errors']['reallyAttackOwn?'] = 'آیا مطمئن هستید می خواهید به خود حمله کنید؟';
$Definition['RallyPoint']['Errors']['reallyAttackFriend?'] = 'آیا مطمئن هستید میخواهید به دوست خود حمله کنید؟';
$Definition['RallyPoint']['Errors']['youAreBanned'] = 'شما بازداشت شده اید.';
$Definition['RallyPoint']['Errors']['playerBanned'] = 'این بازیکن به دلیل نقص قوانین بازداشت شده است.';
$Definition['RallyPoint']['Errors']['cantSendReinforcementsDuringProtection'] = 'در زمان حمایت نمی توانید نیروی کمکی ارسال کنید.';
$Definition['RallyPoint']['Errors']['protectionWillBeGone'] = 'درصورت حمله یا ارسال نیروی کمکی در زمان حمایت، حمایت شما لغو می شود. آیا مطمئن هستید؟';
$Definition['RallyPoint']['Errors']['youCannotAttackArtifactWhileInProtection'] = 'You cannot attack a village with artifact while you are in protection.';
$Definition['RallyPoint']['Errors']['heroDeployError'] = 'شما قهرمان خود را تنها در نیروی کمکی به دهکده های خودی می توانید جابجا کنید. در صورتی که دهکده هدف نیز اردوگاه داشته باشد.';
$Definition['RallyPoint']['Errors']['serverFinished'] = 'بازی به اتمام رسیده است.';
$Definition['RallyPoint']['Errors']['playerIsInVacation'] = 'این بازیکن در حالت تعطیلات است.';
$Definition['RallyPoint']['Errors']['farmsAreProtectedTill'] = 'فارم ها تا %s تحت حمایت هستند.';
$Definition['RallyPoint']['reinforcementForVillageName'] = 'نیروی کمکی برای %s';
$Definition['RallyPoint']['send'] = 'فرستادن';
$Definition['RallyPoint']['edit'] = 'ویرایش';
$Definition['RallyPoint']['reinforcementForPlayerName'] = 'نیرو های %s';
$Definition['RallyPoint']['imprisendInVillage'] = 'نیروهای اسیر شده در دهکده %s';
$Definition['RallyPoint']['imprisendPlayer'] = 'اسیران %s';
$Definition['RallyPoint']['showAll'] = 'نمایش همه';
$Definition['RallyPoint']['no_incoming_troops_error'] = 'هیچ لشکری در حال آمدن نمی باشد.';
$Definition['RallyPoint']['no_outgoing_troops_error'] = 'هیچ لشکری در حال رفتن نمی باشد.';
$Definition['RallyPoint']['no_outvillage_troops_error'] = 'لشکری در خارج دهکده نمی باشد.';
$Definition['RallyPoint']['return'] = 'بازگشت';
$Definition['RallyPoint']['units'] = 'لشکریان';
$Definition['RallyPoint']['ownTroops'] = 'لشکریان خودی';
$Definition['RallyPoint']['from'] = 'از';
$Definition['RallyPoint']['CrannyForest'] = 'مخفیگاه جنگل';
$Definition['RallyPoint']['adventure'] = 'ماجراجویی';
$Definition['RallyPoint']['occupiedOasis'] = 'آبادی تسخیر شده';
$Definition['RallyPoint']['unoccupiedOasis'] = 'آبادی تسخیر نشده';
$Definition['RallyPoint']['ArrivalIn'] = 'رسیدن در';
$Definition['RallyPoint']['against'] = 'به';
$Definition['RallyPoint']['for'] = 'برای';
$Definition['RallyPoint']['of'] = 'از';
$Definition['RallyPoint']['catapultTargets'] = 'هدف';
//attack types
$Definition['RallyPoint']['inAttack'] = $Definition['RallyPoint']['outAttack'] = $Definition['RallyPoint']['inAttackOasis'] = 'حمله';
$Definition['RallyPoint']['inRaid'] = $Definition['RallyPoint']['outRaid'] = $Definition['RallyPoint']['inRaidOasis'] = 'غارت';
$Definition['RallyPoint']['inSupply'] = $Definition['RallyPoint']['outSupply'] = $Definition['RallyPoint']['inSupplyOasis'] = 'نیروی کمکی';
$Definition['RallyPoint']['outSettlers'] = 'بنای دهکده جدید';
$Definition['RallyPoint']['outSpy'] = 'جاسوسی';
$Definition['RallyPoint']['myOasis'] = 'آبادی خودی';
$Definition['RallyPoint']['outEscape'] = 'گریز به مخفیگاه جنگل';
$Definition['RallyPoint']['filters'][1] = 'لشکریان در حال آمدن';
$Definition['RallyPoint']['filters'][2] = 'لشکریان در حال رفتن';
$Definition['RallyPoint']['filters'][3] = 'نیرو های این دهکده';
$Definition['RallyPoint']['filters'][4] = 'نیروهای در دهکده دیگر';
$Definition['RallyPoint']['SubFilters'][1] = 'حملات عادی/غارت';
$Definition['RallyPoint']['SubFilters'][2] = 'نیرو های در حال بازگشت';
$Definition['RallyPoint']['SubFilters'][3] = 'نیرو های کمکی';
$Definition['RallyPoint']['SubFilters'][4] = 'حملات عادی/غارت';
$Definition['RallyPoint']['SubFilters'][5] = 'نیرو های کمکی خودی';
$Definition['RallyPoint']['SubFilters'][6] = 'نیروهای ارسالی به ترتیب ارسال';
$Definition['RallyPoint']['goldClubEvasionDesc'] = 'با کلوپ طلایی شما میتوانید لشکریان خود را در هنگام حمله در امان نگه دارید.';
$Definition['RallyPoint']['evasion in capital'] = 'گریز در پایتخت';
$Definition['RallyPoint']['goldclub'] = 'کلوپ طلایی';
$Definition['RallyPoint']['EvasionSettings'] = 'تنظیمات گریز';
$Definition['RallyPoint']['HeroShowDesc'] = 'قهرمان شما با لشکریان خواهد ماند.';
$Definition['RallyPoint']['HeroHideDesc'] = 'قهرمان شما در حملات گریز خواهد کرد.';
//$Definition['RallyPoint']["EvasionDesc"] = " فعال کردن گریز برای پایتخت. لشکریان هنگام رسیدن حمله دهکده را ترک کرده و بعد از 180 ثانیه باز خواهند گشت. نیروها تنها زمانی گریز خواهند کرد که هیچ نیرویی در حال رسیدن به دهکده در 10 ثانیه قبل از رسیدن حمله نباشد (نیروهای گریز کرده از این قانون مستثناست). این گزینه باعث خواهد شد تمامی نیروهایی که در دهکده تربیت شده‌اند گریز کنند و نیروهای پشتیبانی موجود در دهکده گریز نخواهند کرد.";
$Definition['RallyPoint']["EvasionDesc"] = " فعال کردن گریز. لشکریان هنگام رسیدن حمله دهکده را ترک کرده و بعد از ".(Config::getInstance()->game->evasion_time*2)." ثانیه باز خواهند گشت. نیروها تنها زمانی گریز خواهند کرد که هیچ نیرویی در حال رسیدن به دهکده در 10 ثانیه قبل از رسیدن حمله نباشد (نیروهای گریز کرده از این قانون مستثناست). این گزینه باعث خواهد شد تمامی نیروهایی که در دهکده تربیت شده‌اند گریز کنند و نیروهای پشتیبانی موجود در دهکده گریز نخواهند کرد.";
$Definition['RallyPoint']['Management'] = 'مدیریت';
$Definition['RallyPoint']['overview'] = 'دیدکلی';
$Definition['RallyPoint']['sendTroops'] = 'لشکرکشی';
$Definition['RallyPoint']['combatSimulator'] = 'شبیه ساز جنگ';
$Definition['RallyPoint']['farmlist'] = 'لیست فارم';
$Definition['RallyPoint']['needClubToBeActive'] = 'برای استفاده از این قابلیت نیاز به کلوپ طلایی فعال دارید.';
$Definition['RallyPoint']['This tab is set as favourite'] = 'این منو به عنوان مورد علاقه انتخاب شده است.';
$Definition['RallyPoint']['Set tab x as favourite'] = 'انتخاب تب %s به عنوان مورد علاقه.';
$Definition['RallyPoint']['ArrivalIn'] = 'رسیدن در';
$Definition['RallyPoint']['kill'] = 'کشتن';
$Definition['RallyPoint']['target'] = 'هدف';
$Definition['RallyPoint']['player'] = 'بازیکن';
$Definition['RallyPoint']['catapult only attacks in normal type'] = 'نکته: منجنیق <b>فقط</b> در حملات عادی کار می کند.';
$Definition['RallyPoint']['troops'] = 'لشکریان';
$Definition['RallyPoint']['random'] = 'تصادفی';
$Definition['RallyPoint']['willBeAttackedTarget'] = 'مورد هدف منجنیق قرار خواهد گرفت.';
$Definition['RallyPoint']['options'] = 'تنظیمات';
$Definition['RallyPoint']['Consumption'] = 'مصرف گندم';
$Definition['RallyPoint']['withdraw'] = 'پس کشیدن';
$Definition['RallyPoint']['TroopKillDesc'] = 'مطمئن هستید میخواید نیرو ها را بکشید؟';
$Definition['RallyPoint']['back'] = 'بازگرداندن';
$Definition['RallyPoint']['free'] = 'آزاد کردن';
$Definition['RallyPoint']['spyTarget'] = 'نوع جاسوسی';
$Definition['RallyPoint']['spyTargetTroopsBuildings'] = 'نیرو ها و ساختمان ها';
$Definition['RallyPoint']['spyTargetTroopsResources'] = 'منابع و لشکریان';
//
$Definition['reCaptcha']['title'] = 'تشخیص روبات از انسان';
$Definition['reCaptcha']['desc'] = 'سیستم استفاده مشکوکی را تشخیص داده است. اکانت شما به صورت موقت قفل شده است. <br/><br/> برای تایید اینکه شما یک روبات نیستید دستورات زیر را انجام دهید.';
$Definition['reCaptcha']['Sorry you submitted wrong answer'] = 'متاسفانه جواب شما اشتباه است.';

$Definition['farmListLockHandle']['title'] = 'تشخیص روبات از انسان';
$Definition['farmListLockHandle']['captcha'] = 'کدامنیتی';
$Definition['farmListLockHandle']['submit'] = 'تایید';
$Definition['farmListLockHandle']['newCode'] = 'درخواست کد جدید';
$Definition['farmListLockHandle']['desc'] = 'شما به تعداد بالا اقدام به استفاده از فارم لیست نموده اید. کد زیر را در کادر وارد کنید تا قابلیت فارم لیست برایتان فعال شود.';
$Definition['farmListLockHandle']['Sorry you submitted wrong answer'] = 'متاسفانه جواب شما اشتباه است.';

//
$Definition['Reports'] = ["reportTypes" => [1 => 'پیروزی در حمله بدون تلفات',
    0 => 'گزارش',
    2 => 'پیروزی در حمله با تلفات',
    3 => 'شکست در حمله',
    4 => 'پیروزی در دفاع بدون تلفات',
    5 => 'پیروزی در دفاع با تلفات',
    6 => 'شکست در دفاع با تلفات',
    7 => 'شکست در دفاع بدون تلفات',
    8 => 'نیروی کمکی',
    11 => 'تاجران بیشتر چوب توزیع کردند.',
    12 => 'تاجران بیشتر خشت توزیع کردند.',
    13 => 'تاجران بیشتر آهن توزیع کردند.',
    14 => 'تاجران بیشتر گندم توزیع کردند.',
    15 => 'جاسوسان پیروز و مدافع متوجه جاسوسی نشد.',
    16 => 'جاسوسی موفقیت آمیز بود ولی مدافع از جاسوسی باخبر شد.',
    17 => 'جاسوسی موفقیت آمیز نبود.',
    18 => 'شکست در دفاع',
    19 => 'جلوی جاسوسی گرفته شد.',
    20 => 'حیوانات گرفته شدند.',
    21 => 'گزارش ماجراجویی',
    22 => 'مهاجران برای بنا کردن دهکده جدید عازم شدند.',
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
$Definition['Reports']['There was no village at target destination'] = 'دهکده ای در نقطه مقصد وجود نداشت.';
$Definition['Reports']['newVillageCreatedSuccussFully'] = 'دهکده جدید با موفقیت بنا شد';
$Definition['Reports']['escapeNonCapitalErr'] = 'نیروهای شما قادر به گریز نبودند زیرا گریز تنها در پایتخت امکان پذیر است.';
$Definition['Reports']['escapeTroopsComingErr'] = 'نیروهای شما قادر به گریز نبودند زیرا در 10 ثانیه بعد نیرویی در حال آمدن بود.';
$Definition['Reports']['evasionNotEnabled'] = 'لشکریان شما گریز نکردند چون امکان گریز فعال نشده بود!';
$Definition['Reports']['escapeDisabledBecauseYourPopulationIsTooLow'] = 'لشکریان شما گریز نکردند چون جمعیت دهکده شما بسیار پایین است.';
$Definition['Reports']['Archive||For this feature you need the Gold club activated'] = 'آرشیو||برای استفاده از این قابلیت شما به کلوپ طلایی فعال نیاز دارید.';
$Definition['Reports']['Add to farm list||For this feature you need the Gold club activated'] = 'افزودن به لیست فارم||برای استفاده از این قابلیت شما به کلوپ طلایی فعال نیاز دارید.';
$Definition['Reports']['Mark as read'] = 'علامت به عنوان خوانده شده';
$Definition['Reports']['Mark as unread'] = 'علامت به عنوان خوانده نشده';
$Definition['Reports']['Combat simulator'] = 'شبیه ساز جنگ';
$Definition['Reports']['Repeat attack'] = 'تکرار حمله';
$Definition['Reports']['Tabs']['All'] = 'همه';
$Definition['Reports']['Tabs']['Troops'] = 'لشکریان';
$Definition['Reports']['Tabs']['Trade'] = 'تاجران';
$Definition['Reports']['Tabs']['Miscellaneous'] = 'متفرقه';
$Definition['Reports']['Tabs']['Archive'] = 'آرشیو';
$Definition['Reports']['Tabs']['Surrounding'] = 'اطراف';
$Definition['Reports']['Tabs']['Attacks'] = 'حمله';
$Definition['Reports']['Tabs']['Defense'] = 'دفاعی';
$Definition['Reports']['Tabs']['Spy'] = 'جاسوسی';
$Definition['Reports']['Tabs']['Other'] = 'دیگر';
$Definition['Reports']['needClub'] = 'برای استفاده از این قابلیت نیاز به کلوپ طلایی دارید.';
$Definition['Reports']['village totally destroyed'] = 'دهکده کاملا نابود شد.';
$Definition['Reports']['adventureFailed'] = 'ماجراجویی با موفقیت آمیز نبود.';
$Definition['Reports']['Silver'] = 'نقره';
$Definition['Reports']['WWPlanCaptured'] = 'نقشه ساخت دزدیده شد.';
$Definition['Reports']['heroArtifactCapture'] = 'کتیبه دزدیده شد.';
$Definition['Reports']['x didnt damaged'] = '%s آسیب ندید.';
$Definition['Reports']['TrapFreeAllianceAndMe'] = 'شما %s عدد از سربازان خود و %s عدد از سربازان متحدین خود را آزاد کردید و بقیه کشته شدند.';
$Definition['Reports']['TrapFreeMe'] = 'شما %s عدد از سربازان خودی را آزاد کردید و بقیه کشته شدند.';
$Definition['Reports']['TrapFreeAlliance'] = 'شما %s عدد از سربازان متحدین خود را آزاد کرده و بقیه کشته شدند.';
$Definition['Reports']['select all'] = 'انتخاب همه';
$Definition['Reports']['Unread'] = 'خوانده نشده';
$Definition['Reports']['location'] = 'مکان';
$Definition['Reports']['distance'] = 'فاصله';
$Definition['Reports']['Read'] = 'خوانده شده';
$Definition['Reports']['newer reports'] = 'گزارشات جدید تر';
$Definition['Reports']['older reports'] = 'گزارشات قدیمی تر';
$Definition['Reports']['Really delete this report?'] = 'واقعا این گزارش حذف شود؟';
$Definition['Reports']['Delete report'] = 'حذف گزارش';
$Definition['Reports']['Delete'] = 'حذف';
$Definition['Reports']['Archive'] = 'آرشیو';
$Definition['Reports']['Recover'] = 'بازیابی';
$Definition['Reports']['Access permissions'] = 'دسترسی';
$Definition['Reports']['make opponent anonymous'] = 'مخفی کردن رقیب';
$Definition['Reports']['make myself anonymous'] = 'من را مخفی کن';
$Definition['Reports']['hide own troops'] = 'مخفی کردن لشکریان خودی';
$Definition['Reports']['hide opposing troops'] = 'مخفی کردن لشکریان رقیب';
$Definition['Reports']['Description:'] = 'توضیحات:';
$Definition['Reports']['VillageCaptured'] = 'اهالی دهکده ی %s تصمیم گرفتند به امپراتوری شما بپیوندند.';
$Definition['Reports']['CantCaptureCapital'] = 'پایتخت را نمیتوان تسخیر کرد.';
$Definition['Reports']['culturePointsErr'] = 'امتیاز فرهنگی کافی ندارید.';
$Definition['Reports']['rpExists'] = 'قصر یا اقامتگاه موجود است.';
$Definition['Reports']['You can only have 1 ww village at a time'] = 'شما تنها می توانید یک دهکده شگفتی جهان داشته باشید.';
$Definition['Reports']['You cannot capture your alliance members village'] = 'شما نمی توانید دهکده متحد خود را تسخیر کنید.';
$Definition['Reports']['randomTargetsWereChosen'] = 'هدفهای تصادفی انتخاب شده بودند.';
$Definition['Reports']['defenderIsSupportedByTheFollowingArtifact'] = 'مدافع توسط این کتیبه پشتیبانی می شود: %s';
$Definition['Reports']['NoFreeAttackerTreasurySpace'] = 'در دهکده ی مهاجم خزانه وجود ندارد و یا خزانه پر است.';
$Definition['Reports']['maxArtifactReached'] = 'شما حداکثر کتیبه های موجود را دارا می باشید.';
$Definition['Reports']['TreasuryExists'] = 'خزانه موجود است.';
$Definition['Reports']['From'] = 'از';
$Definition['Reports']['Village'] = 'دهکده';
$Definition['Reports']['oasis'] = 'آبادی';
$Definition['Reports']['Troops'] = 'لشکریان';
$Definition['Reports']['units'] = 'لشکریان';
$Definition['Reports']['Trapped'] = 'اسیر شده';
$Definition['Reports']['casualties'] = 'تلفات';
$Definition['Reports']['from oasis'] = 'از آبادی';
$Definition['Reports']['you used x cages'] = 'شما از %s قفس استفاده کردید.';
$Definition['Reports']['x attacks y'] = '%s به %s حمله می کند.';
$Definition['Reports']['x send resources to y'] = '%s به %s منابع می فرستد.';
$Definition['Reports']['Bounty'] = 'غنائم';
$Definition['Reports']['exp'] = 'تجربه';
$Definition['Reports']['noValuableThingFound'] = 'هیچ چیز با ارزشی یافت نشد.';
$Definition['Reports']['injury'] = 'سلامتی';
$Definition['Reports']['unknown'] = 'ناشناس';
$Definition['Reports']['Sender'] = 'ارسال کننده';
$Definition['Reports']['Recipient'] = 'دریافت کننده';
$Definition['Reports']['supplies'] = 'منابع می فرستد به';
$Definition['Reports']['from alliance'] = 'از اتحاد';
$Definition['Reports']['x supplies y'] = '%s به %s نیروی کمکی می فرستد.';
$Definition['Reports']['Consumption'] = 'مصرف گندم';
$Definition['Reports']['reinforced'] = 'نیروی کمکی فرستاد به';
$Definition['Reports']['x reinforced y'] = '%s به %s نیروی کمکی می فرستد.';
$Definition['Reports']['perHR'] = 'در ساعت';
$Definition['Reports']['x destroyed'] = '%s تخریب شد.';
$Definition['Reports']['reduced lvl from x to y'] = 'سطح %s از %s به %s کاهش یافت.';
$Definition['Reports']['x did not damaged'] = 'به %s آسیبی نرسید.';
$Definition['Reports']['you troops in village x were attacked'] = 'لشکریان شما در دهکده %s مورد حمله قرار گرفتند.';
$Definition['Reports']['x is on adventure'] = '%s درحال کاوش %s است.';
$Definition['Reports']['An Oasis was plundered'] = 'یک آبادی غارت شد.';
$Definition['Reports']['x has conquered an oasis'] = '%s یک آبادی تسخیر کرد.';
$Definition['Reports']['An Oasis was abandoned'] = 'یک آبادی ترک شد.';
$Definition['Reports']['x has founded y'] = '%s دهکده %s را بنا کرد.';
$Definition['Reports']['x has conquered y'] = '%s دهکده %s را تسخیر کرد.';
$Definition['Reports']['x has lost y'] = '%s دهکده %s را از دست داد.';
$Definition['Reports']['x renamed y to z'] = '%s نام دهکده %s را به %s تغییر داد.';
$Definition['Reports']['A fight took at village name of player name'] = 'یک حمله در دهکده %s بازیکن %s رخ داد.';
$Definition['Reports']['noData'] = 'گزارشی یافت نشد.';
$Definition['Reports']['Subject'] = 'موضوع';
$Definition['Reports']['Sent'] = 'فرستاده شده در';
//report types
$Definition['Reports']['AnimalsCaught'] = 'حیوانات گرفته شدند.';
$Definition['Reports']['x spies y'] = '%s از %s جاسوسی می کند.';
$Definition['Reports']['x founds a new village'] = '%s یک دهکده جدید بنا کرد.';
$Definition['Reports']['occupiedOasis'] = 'آبادی تسخیر شده';
$Definition['Reports']['unoccupiedOasis'] = 'آبادی تسخیر نشده';
$Definition['Reports']['Attacker'] = 'مهاجم';
$Definition['Reports']['Defender'] = 'مدافع';
$Definition['Reports']['Reinforcement'] = 'نیروی کمکی';
$Definition['Reports']['Information'] = 'اطلاعات';
$Definition['Reports']['Resources'] = 'منابع';
$Definition['Reports']['None of your soldiers returned'] = 'هیچ کدام از لشکریان شما بازنشگتند.';
$Definition['Reports']['None of your spies returned'] = 'هیچکدام از جاسوسان باز نگشتند.';

$Definition['Reports']['Ram does not work on alliance members'] = 'دژکوب بر روی هم اتحادی ها اثر نمی کند.';
$Definition['Reports']['Cata is disabled'] = 'هنجنیق غیرفعال است.';
$Definition['Reports']['Cata does not work on alliance members'] = 'منجنیق روی هم اتحادی اثر نمی کند.';

$Definition['Reports']['NoFreeSlotsToCaptureOasis'] = 'فضای خالی برای تسخیر آبادی در عمارت قهرمان وجود ندارد.';
$Definition['Reports']['OasisCaptured'] = 'آبادی تسخیر شد.';
$Definition['Reports']['LoyaltyLowered'] = 'وفاداری از %s به %s کاهش یافت.';
//$Definition['Reports']['Inbox - All reports older than seven days will be deleted'] = 'صندوق ورودی - تمامی گزارش هایی که بیش از 7 روز مانده باشند حذف خواهند شد.';
$Definition['Reports']['Inbox - All reports older than seven days will be deleted'] = 'صندوق ورودی - تمام گزارشاتی که آرشیو نشده باشند بعد از 3 ساعت حذف خواهند شد.';
$Definition['Reports']['Management'] = 'مدیریت';
$Definition['Reports']['ManagementDesc'] = ' دراین قسمت شما می توانید گزارش های خود را مدیریت کنید. گزارش هایی که بیشتر از 7 روز مانده باشند حذف خواهند شد.';
$Definition['Reports']['ManagementOptions'] = [
    1 => 'پیروزی در حمله بدون تلفات',
    2 => 'پیروزی در حمله با تلفات',
    3 => 'شکست در حمله',
    4 => 'پیروزی در دفاع بدون تلفات',
    5 => 'پیروزی در دفاع با تلفات',
    6 => 'شکست در دفاع با تلفات',
    7 => 'شکست در دفاع بدون تلفات',
    8 => 'نیروی کمکی',
    9 => 'ارسال منابع',
    10 => 'جاسوسی',
    11 => 'ماجراجویی',
    12 => 'همه گزارش ها',
];
$Definition['Reports']['startTime'] = [
    0 => 'شروع سرور',
    600 => '10 دقیقه قبل',
    1800 => '30 دقیقه قبل',
    3600 => '1 ساعت قبل',
    7200 => '2 ساعت قبل',
    10800 => '3 ساعت قبل',
    21600 => '6 ساعت قبل',
    43200 => '12 ساعت قبل',
    86400 => '1 روز قبل',
    172800 => '2 روز قبل',
    604800 => '7 روز قبل',
];
$Definition['Reports']['ManagementDeleteDesc'] = 'حذف گزارش های %s از %s %s';
$Definition['Reports']['ButtonOK'] = 'تایید';
$Definition['Reports']['ReportsStatistics'] = 'آمار گزارشات';
$Definition['Reports']['%s report(s) removed successfully'] = '%s گزارش با موفقیت حذف شد.';
$Definition['Reports']['AllReportsCount'] = 'تعداد کل گزارش ها';
$Definition['Reports']['ReportsWithoutCasualties'] = 'تعداد گزارش های حمله بدون تلفات';
$Definition['Reports']['ReportsWithCasualties'] = 'تعداد گزارش های حمله با تلفات';
$Definition['Reports']['ReportsDefWithoutCasualties'] = 'تعداد گزارش های دفاع بدون تلفات';
$Definition['Reports']['ReportsDefWithCasualties'] = 'تعداد گزارش های دفاع با تلفات';
$Definition['Reports']['ReportsOtherReports'] = 'تعداد گزارش های دیگر';
//
$Definition['ResidencePalace']['Management'] = 'مدیریت';
$Definition['ResidencePalace']['Train'] = 'تربیت';
$Definition['ResidencePalace']['CulturePoints'] = 'امتیاز فرهنگی';
$Definition['ResidencePalace']['Loyalty'] = 'وفاداری';
$Definition['ResidencePalace']['Expansion'] = 'گسترش';
$Definition['ResidencePalace']['This tab is set as favourite'] = 'این صفحه به عنوان صفحه مورد علاقه شما انتخاب شده است.';
$Definition['ResidencePalace']['Select x as favor tab'] = 'انتخاب صفحه %s به عنوان صفحه موجود علاقه.';
$Definition['ResidencePalace']['Controllable villages'] = 'دهکده های قابل کنترل';
$Definition['ResidencePalace']['Number of your villages'] = 'تعداد دهکده های خودی';
$Definition['ResidencePalace']['Maximum controllable villages'] = 'حداکثر دهکده های قابل کنترل';
$Definition['ResidencePalace']['Culture points per day'] = 'امتیاز فرهنگی در روز';
$Definition['ResidencePalace']['Culture points produced so far'] = 'امتیاز فرهنگی تولید شده';
$Definition['ResidencePalace']['Next village controllable at'] = 'دهکده بعدی قابل کنترل در امتیاز فرهنگی';
$Definition['ResidencePalace']['Culture points still needed'] = 'امتیاز فرهنگی مورد نیاز';
$Definition['ResidencePalace']['Active village'] = 'دهکده فعلی';
$Definition['ResidencePalace']['Other villages'] = 'دهکده های دیگر';
$Definition['ResidencePalace']['Hero'] = 'قهرمان';
$Definition['ResidencePalace']['Total'] = 'مجموع';
$Definition['ResidencePalace']['loyaltyDesc'] = 'مجموع';
$Definition['ResidencePalace']['Coordinates'] = 'مختصات';
$Definition['ResidencePalace']['noExpansion'] = 'هیچ دهکده ای یافت نشد.';
$Definition['ResidencePalace']['ChangeCapital'] = 'انتخاب این دهکده به عنوان پایتخت';
$Definition['ResidencePalace']['Cant set ww as capital'] = 'شما دهکده شگفتی جهان را نمی توانید به عنوان پایتخت خود انتخاب کنید.';
$Definition['ResidencePalace']['Password'] = 'رمز عبور';
$Definition['ResidencePalace']['wrongPass'] = 'رمز عبور اشتباه است.';
$Definition['ResidencePalace']['ConfirmChangeCapital'] = 'آیا مطمئن هستید؟';
$Definition['ResidencePalace']['This is your capital'] = 'این دهکده پایتخت شماست.';
$Definition['ResidencePalace']['Date'] = 'تاریخ';
$Definition['ResidencePalace']['In order to found or conquer further villages, you require culture points An additional village will predictably be controllable on x (±5 minutes)'] = 'برای بنای دهکده جدید شما در تاریخ %s امتیاز فرهنگی لازم را خواهید داشت. (±5 دقیقه)';
$Definition['ResidencePalace']['The further the buildings of your villages are upgraded, the more culture points per day they will produce'] = 'هرچه سطح ساختمان های دهکده شما بالاتر باشد، امتیاز فرهنگی بیشتری بدست خواهید آورد.';
$Definition['ResidencePalace']['Loyalty in the current village'] = 'وفاداری در دهکده فعلی';
$Definition['ResidencePalace']['Loyalty overview'] = 'دیدکلی وفاداری';
$Definition['ResidencePalace']['village'] = 'دهکده';
$Definition['ResidencePalace']['Inhabitants'] = 'جمعیت';
$Definition['ResidencePalace']['Player(s)'] = 'بازیکن';
$Definition['ResidencePalace']['A palace or residence protect a village from being conquered If the seat of government has been destroyed, a village`s loyalty can be lowered by attacks with chieftains, chiefs and senators If the loyalty is lowered to zero, the village will join the attacker`s empire An ongoing great celebration in the village of either attacker or defender will increase or lower the rate at which each attacking administrator will lower the loyalty Each level of the seat of government increases the speed at which the loyalty of a village increases to 100% again A hero stationed in the village can use tablets of law to additionally increase loyalty'] = 'یک قصر یا یک اقامتگاه از دهکده شما در برابر تسخیر شدن محافظت می کند. اگر این ساختمان تخریب شود، وفاداری دهکده در حملات با استفاده از رئیس کاهش می یابد. اگر وفاداری به صفر برسد دهکده جزء امپراتوری مهاجم خواهد شد. جشن بزرگ در دهکده مدافع و یا مهاجم میزان کاهش وفاداری را افزایش و کاهش می دهد. هر سطحی که این ساختمان ارتقا پیدا کند وفاداری بالاتر خواهد رفت.';
//
$Definition['Smithy'] = [];
$Definition['Smithy']['Improve weapons and armour'] = 'سلاح ها و زره ها را تقویت کنید.';
$Definition['Smithy']['one_research_is_going'] = 'یک تحقیق درحال انجام است.';
$Definition['Smithy']['reachedMaxLvl'] = 'سطح %s به آخرین سطح ممکن رسید.';
$Definition['Smithy']['improve'] = 'تقویت';
$Definition['Smithy']['Researching'] = 'درحال تحقیق';
$Definition['Smithy']['unit'] = 'نیرو';
$Definition['Smithy']['upgradeSmithy'] = 'آهنگری را ارتقا دهید.';
//
$Definition['Statistics']['raid'] = 'غارت';
$Definition['Statistics']['Prizes for top 10'] = 'جوایز تاپ 10';
$Definition['Statistics']['Bonus name'] = 'نام دسته';
$Definition['Statistics']['No prize is declared for top10'] = 'جایزه ای برای تاپ 10 درنظر گرفته نشده است.';
$Definition['Statistics']['top10 prize distribution desc'] = 'جوایز پس از هر بار ریست شدن تاپ 10 پخش خواهند شد.';

$Definition['Statistics']['Average number of troops per player'] = 'میانگین لشکریان به نسبت تعداد بازیکنان';
$Definition['Statistics']['Game development'] = 'توسعه بازی';
$Definition['Statistics']['The following graphs show a time progression of economy, population, and the military strength of your army'] = 'نمودار زیر چگونگی رشد اقتصادی، جمعیتی و نظامی اکانت شما را نمایش می‌دهد.';
$Definition['Statistics']['Number of troops'] = 'تعداد لشکریان';
$Definition['Statistics']['total'] = 'کل';
$Definition['Statistics']['reinforcements'] = 'پشتیبانی';
$Definition['Statistics']['Resource production and population'] = 'تولید منابع و جمعیت';
$Definition['Statistics']['resources/4'] = 'منابع/4';
$Definition['Statistics']['Inhabitants'] = 'جمعیت';
$Definition['Statistics']['Rank'] = 'رتبه';
$Definition['Statistics']['Number of troops killed'] = 'تعداد سربازهای کشته شده';
$Definition['Statistics']['attack'] = 'حمله';
$Definition['Statistics']['titleInHeader'] = 'آمار';
$Definition['Statistics']['Actions'] = 'عملیات ها';
$Definition['Statistics']['edit'] = 'ویرایش';
$Definition['Statistics']['tabs'] = [];
$Definition['Statistics']['tabs']['players'] = 'بازیکنان';
$Definition['Statistics']['tabs']['alliances'] = 'اتحاد ها';
$Definition['Statistics']['tabs']['villages'] = 'دهکده ها';
$Definition['Statistics']['tabs']['hero'] = 'قهرمان ها';
$Definition['Statistics']['tabs']['plus'] = 'پلاس';
$Definition['Statistics']['tabs']['General'] = 'عمومی';
$Definition['Statistics']['tabs']['WonderOfTheWorld'] = 'شگفتی جهان';
$Definition['Statistics']['tabs']['Bonus'] = 'جوایز و وضعیت ها';
$Definition['Statistics']['tabs']['farm'] = 'فارم ها';
$Definition['Statistics']['subTabs'] = [];
$Definition['Statistics']['subTabs']['overview'] = 'دیدکلی';
$Definition['Statistics']['subTabs']['attacker'] = 'مهاجم';
$Definition['Statistics']['subTabs']['defender'] = 'مدافع';
$Definition['Statistics']['subTabs']['Top 10'] = 'تاپ 10';
$Definition['Statistics']['player'] = 'بازیکنان';
$Definition['Statistics']['alliance'] = 'اتحاد';
$Definition['Statistics']['rank'] = 'رتبه';
$Definition['Statistics']['name'] = 'نام';
$Definition['Statistics']['largestPlayers'] = 'بزرگترین بازیکن ها';
$Definition['Statistics']['largestAlliances'] = 'بزرگترین اتحاد ها';
$Definition['Statistics']['largestVillages'] = 'بزرگترین دهکده ها';
$Definition['Statistics']['level'] = 'سطح';
$Definition['Statistics']['xp'] = 'تجربه';
$Definition['Statistics']['most exp heros'] = 'باتجربه ترین قهرمان ها';
$Definition['Statistics']['alliance'] = 'اتحاد';
$Definition['Statistics']['population'] = 'جمعیت';
$Definition['Statistics']['village'] = 'دهکده';
$Definition['Statistics']['points'] = 'امتیاز';
$Definition['Statistics']['coordinates'] = 'مختصات';
$Definition['Statistics']['errors'] = [];
$Definition['Statistics']['errors']['userNotFound'] = 'بازیکنی با نام %s یافت نشد.';
$Definition['Statistics']['errors']['allianceNotFound'] = 'اتحادی با نام %s یافت نشد.';
$Definition['Statistics']['errors']['villageNotFound'] = 'دهکده ای با نام %s یافت نشد.';
$Definition['Statistics']['top10'] = [];
$Definition['Statistics']['top10']['attackers of the week'] = 'مهاجمین هفته';
$Definition['Statistics']['top10']['defenders of the week'] = 'مدافعین هفته';
$Definition['Statistics']['top10']['robbers of the week'] = 'غارتگران هفته';
$Definition['Statistics']['top10']['climbers of the week'] = 'پیشرفت کننده های هفته';
$Definition['Statistics']['top10']['resources'] = 'منابع';
$Definition['Statistics']['top10']['ranks'] = 'رتبه';
$Definition['Statistics']['top10']['pop'] = 'جمعیت';
$Definition['Statistics']['top10']['points'] = 'امتیاز';
$Definition['Statistics']['top10']['No'] = 'ردیف';
$Definition['Statistics']['top10']['top off hammer'] = 'قویترین حمله (از ابتدای سرور)';
$Definition['Statistics']['top10']['top def hammer'] = 'قویترین دفاع (از ابتدای سرور)';
$Definition['Statistics']['top10']['date'] = 'تاریخ';
$Definition['Statistics']['General'] = [];
$Definition['Statistics']['General']['Country ranks'] = 'رتبه بندی کشور ها';
$Definition['Statistics']['General']['Country name'] = 'اسم کشور';
$Definition['Statistics']['General']['Players'] = 'بازیکنان';
$Definition['Statistics']['General']['Points'] = 'امتیاز ها';
$Definition['Statistics']['General']['CountryFlag'] = 'پرچم';
$Definition['Statistics']['General']['Total country population'] = 'کل جمعیت کشور';
$Definition['Statistics']['General']['Tribe'] = 'نژاد';
$Definition['Statistics']['General']['Tribes'] = 'نژاد ها';
$Definition['Statistics']['General']['Romans'] = 'رومی ها';
$Definition['Statistics']['General']['Teutons'] = 'توتن ها';
$Definition['Statistics']['General']['Gauls'] = 'گول ها';
$Definition['Statistics']['General']['Egyptians'] = 'مصریان';
$Definition['Statistics']['General']['Huns'] = 'هون‌ها';
$Definition['Statistics']['General']['Miscellaneous'] = 'اطلاعات بیشتر';
$Definition['Statistics']['General']['Attacks'] = 'حملات';
$Definition['Statistics']['General']['Casualties'] = 'تلفات';
$Definition['Statistics']['General']['Date'] = 'تاریخ';
$Definition['Statistics']['General']['Registered'] = 'ثبت نام کرده';
$Definition['Statistics']['General']['Percent'] = 'درصد';
$Definition['Statistics']['General']['Players'] = 'بازیکن ها';
$Definition['Statistics']['General']['RegisteredPlayers'] = 'بازیکن های ثبت نام شده';
$Definition['Statistics']['General']['ActivePlayers'] = 'بازیکنان فعال';
$Definition['Statistics']['General']['onlinePlayers'] = 'بازیکنان آنلاین';
$Definition['Statistics']['General']['Attacks and casualties'] = 'حملات و تلفات';
$Definition['Statistics']['WonderOfTheWorld'] = [];
$Definition['Statistics']['WonderOfTheWorld']['player'] = 'بازیکن';
$Definition['Statistics']['WonderOfTheWorld']['name'] = 'نام';
$Definition['Statistics']['WonderOfTheWorld']['alliance'] = 'اتحاد';
$Definition['Statistics']['WonderOfTheWorld']['level'] = 'سطح';
$Definition['Statistics']['WonderOfTheWorld']['attackToWonder'] = 'حمله بعدی در %s';
$Definition['Statistics']['Winner and top player bonuses'] = 'جوایز و وضعیت';
$Definition['Statistics']['Winner Player'] = 'بازیکن برنده';
$Definition['Statistics']['Second Winner Player'] = 'دومین برنده';
$Definition['Statistics']['Third Winner Player'] = 'سومین برنده';
$Definition['Statistics']['Bonus rules'] = 'قوانین جایزه ها';
$Definition['Statistics']['bonus_rules_array'] = [
    'جایزه به کسانی که دارای چندین اکانت هستند تعلق نخواهد گرفت.',
    'درصورتی که جایزه ای برای نفر دوم و سوم درنظر گرفته شده باشد، باید سطح شگفتی جهان آنها بیشتر از 50 باشد.',
    sprintf('جایزه اتحاد فقط به %s نفر اول بجز برنده اتحاد تعلق خواهد گرفت که جمعیت بیشتر از %s داشته باشند.', Config::getProperty("bonus", "bonusGoldTopAllianceCount"), Config::getProperty("bonus", "bonusGoldTopAllianceMinPop")),
    'بعضی از سرور ها دارای جایزه نقدی هستند، در این صورت شما را باخبر خواهیم کرد.',
    'بعد از اتمام سرور طلا ها در بانک طلا توسط ایمیل ثبت نامی ذخیره خواهد شد.',
];
$Definition['Statistics']['Winner Alliance (Top 5)'] = 'اتحاد برنده';
$Definition['Statistics']['Top attacker'] = 'بهترین مهاجم';
$Definition['Statistics']['Top defender'] = 'یهترین مدافع';
$Definition['Statistics']['Top climber'] = 'بهترین پیشرفت کننده';
$Definition['Statistics']['Server states'] = 'وضعیت سرور';
$Definition['Statistics']['Daily gold will be given in'] = 'طلای روزانه توضیع خواهد شد در';
$Definition['Statistics']['Daily quest will reset in'] = 'وظایف روزانه بارگزاری خواهد شد در';
$Definition['Statistics']['Medals will be given in'] = 'مدال ها توضیع خواهند شد در';
$Definition['Statistics']['Artifacts will be released in'] = 'کتیبه ها آزاد خواهند شد در';
$Definition['Statistics']['WWPlans will be released in'] = 'نقشه های ساخت آزاد خواهند شد در';
$Definition['Statistics']['You can build WW in'] = 'شما قادر به ساخت شگفتی جهان خواهید بود در';
$Definition['Statistics']['Game will be finished in'] = 'بازی به اتمام خواهد رسید در';
$Definition['Statistics']['hours'] = 'ساعت';
$Definition['Statistics']['Top Off hammer'] = 'صاحب بزرگترین لشکر هجومی';
$Definition['Statistics']['Top Def hammer'] = 'صاحب بزرگترین لشکر دفاعی';
$Definition['Statistics']['raid'] = 'غارت';
$Definition['Statistics']['Other prises'] = 'جایزه های دیگر';
//
$Definition['Treasury']['ArtifactIsDisabled'] = 'كتيبه غير فعال می‌باشد.';
$Definition['Treasury']['This tab is set as favourite'] = 'این صفحه به عنوان صفحه مورد علاقه شما انتخاب شده است.';
$Definition['Treasury']['Management'] = 'مدیریت';
$Definition['Treasury']['Artefacts in your area'] = 'کتیبه های منطقه شما';
$Definition['Treasury']['Small artefacts'] = 'کتیبه های کوچک';
$Definition['Treasury']['Large artefacts'] = 'کتیبه های بزرگ';
$Definition['Treasury']['select tab x as favor tab'] = 'انتخاب صفحه %s به عنوان صفحه مورد علاقه.';
$Definition['Treasury']['Stored artefact'] = 'کتیبه های خودی';
$Definition['Treasury']['Name'] = 'نام';
$Definition['Treasury']['Village'] = 'دهکده';
$Definition['Treasury']['conquered'] = 'تسخیر شده در';
$Definition['Treasury']['Former owner'] = 'سابقه تسخیر';
$Definition['Treasury']['you dont own any artefacts'] = 'شما کتیبه ای ندارید.';
$Definition['Treasury']['Effect'] = 'تاثیر';
$Definition['Treasury']['Village'] = 'دهکده';
$Definition['Treasury']['Account'] = 'اکانت';
$Definition['Treasury']['Player'] = 'بازیکن';
$Definition['Treasury']['Area of effect'] = 'تاثیر';
$Definition['Treasury']['Bonus'] = 'امتیاز';
$Definition['Treasury']['Required level'] = 'سطح مورد نیاز';
$Definition['Treasury']['Time of conquer'] = 'زمان تسخیر';
$Definition['Treasury']['Active'] = 'فعال';
$Definition['Treasury']['Time of activation'] = 'زمان فعال سازی';
$Definition['Treasury']['Alliance'] = 'اتحاد';
$Definition['Treasury']['Distance'] = 'فاصله';
$Definition['Treasury']['Owner'] = 'صاحب';
$Definition['Treasury']['No Artefact'] = 'کتیبه ها آزاد نشده اند.';
//
$Definition['Troops']['hero']['title'] = 'قهرمان';
$Definition['Troops'][1]['title'] = 'سرباز لژیون';
$Definition['Troops'][1]['desc'] = 'سرباز لژیون یک سرباز ساده و همه منظوره در ارتش رومی‌ها است. با تربیت مخصوصی که داشته هم در دفاع و هم در حمله عملکرد نسباتاً خوبی دارد. به هر حال هیچوقت سرباز لژیون قادر به رسیدن به سطح لشکریان سطح بالا نمی‌باشد.';
$Definition['Troops'][2]['title'] = 'محافظ';
$Definition['Troops'][2]['desc'] = 'محافظ، همانطور که از اسمش پیداست، محافظ و گارد مخصوص امپراطور است. این محافظ‌ها به قیمت جان خود از امپراطور محافظت می‌کنند. از آنجایی که این سرباز برای دفاع تربیت شده است مهاجم خیلی ضعیفی است.';
$Definition['Troops'][3]['title'] = 'شمشیر زن';
$Definition['Troops'][3]['desc'] = 'شمشیرزن یک مهاجم حرفه‌ای در ارتش رومی‌ها است. او سریع، قوی و یک کابوس برای همه مدافعین است. ولی تربیت این نیرو گران قیمت و زمانبر است.';
$Definition['Troops'][4]['title'] = 'خبرچین';
$Definition['Troops'][4]['desc'] = 'خبرچین وظیفه جاسوسی را در ارتش رومی‌ها به عهده دارد. او خیلی چابک است و می‌تواند در مورد منابع و ارتش دشمن جاسوسی کند. <br><br> اگر هیچ ردیاب، خبرچین و جاسوسی در دهکده‌ای که از آن جاسوسی می‌کند نباشد، دشمن از آمد و رفت او خبردار نخواهد شد.';
$Definition['Troops'][5]['title'] = 'شوالیه';
$Definition['Troops'][5]['desc'] = 'اینها شوالیه‌های استاندارد رومی‌ها به حساب می‌آیند و سلاح‌های مجهزی دارند. شوالیه‌ها شاید سریعترین نیروها نباشند، ولی برای دشمنانی که آماده نباشند خیلی هراس برانگيز خواهند بود. به هر حال نباید فراموش کرد که تامین غذای او و اسبش ارزان نخواهد بود.';
$Definition['Troops'][6]['title'] = 'شوالیه سزار';
$Definition['Troops'][6]['desc'] = 'شوالیه‌های سزار، شوالیه‌های خاص ارتش روم هستند. آنها لباس‌هایی بسیار مقاوم دارند و به سختی آسیب می‌بینند، اما این سلاح‌ها و لباس‌ها قیمت زیادی نیز خواهند داشت. آنها کند حرکت می‌کنند، منابع کمی می‌توانند حمل کنند و زیاد غذا مصرف می‌کنند. خوب، برای قدرتی که دارند باید هزینه خوبی هم پرداخت کرد.';
$Definition['Troops'][7]['title'] = 'دژ کوب';
$Definition['Troops'][7]['desc'] = 'دژکوب یک همراه خوب، هم برای پیاده نظام و هم سواره نظام است. کار آن تخریب دیوار شهر دشمن است و با این کار، شانس نیروهایتان در فایق آمدن بر نیروهای دشمن بالا خواهد رفت.';
$Definition['Troops'][8]['title'] = 'منجنیق آتشین';
$Definition['Troops'][8]['desc'] = 'منجنیق آتشین یک سلاح دور برد عالی برای خراب کردن مزارع، منابع و ساختمان‌های دشمن است. اما اگر با نیروهای دیگر همراهی نشود، تقریباً بی‌دفاع است، پس فراموش نکنيد که هميشه تعدادی نیرو همراه با آن بفرستید. <br><br> هر قدر سطح اردوگاه بیشتر باشد، به همان اندازه دقت منجنیق بالا می‌رود و شما می‌توانید موقع فرستادن آن، مشخص کنید که به چه ساختمانی می‌خواهید صدمه بزنید. اگر اردوگاه سطح 10 داشته باشید، به غیر از مخفیگاه، سنگ تراشی وتله ساز ، همه ساختمانهای دیگر را می‌توانید مورد هدف قرار دهید. <br> راهنمایی: در صورتی که شلیک تصادفی انتخاب شود، ممکن است مخفیگاه، سنگ تراشی و تله ساز نیز تخریب شوند.';
$Definition['Troops'][9]['title'] = 'سناتور';
$Definition['Troops'][9]['desc'] = 'سناتور رهبر منتخب قبیله است. او یک سخنگوی خوب است و می‌داند چگونه باید دیگران را قانع کند. او می‌تواند دهکده‌های دیگر را قاتع کند تا برای امپراطوری او بجنگند. <br><br> هر بار که سناتور با اهالی دهکده دشمن صحبت کند، وفاداری آنها کاهش پیدا می‌کند تا زمانی که بعد از چند بار سخنرانی او، دهکده ازآن شما می شود.';
$Definition['Troops'][10]['title'] = 'مهاجر';
$Definition['Troops'][10]['desc'] = 'مهاجرها روستایی‌هایی شجاع هستند که بعد از یک آموزش طولانی مدت از دهکده مهاجرت کرده و یک دهکده به افتخار شما بنا می کنند. <br><br> از آنجایی که سفر و بنا نهادن یک دهکده کاری دشوار است، این مهاجرها با همدیگر به سفر می‌پردازند. در ضمن از هر منبع نیز 750 تا با خود می برند.';
$Definition['Troops'][11]['title'] = 'گرزدار';
$Definition['Troops'][11]['desc'] = 'گرزدار ارزانترین نوع نیرو در تراوین است. سریع تعلیم داده می‌شود و قدرت حمله متوسطی دارد. بدیهی است این سربازان پوشش خیلی خوبی ندارند و در مقابل شوالیه‌ها و در حالت کل سواره نظام‌ها تقریباً بی‌دفاع و خيلی آسيب پذير هستند.';
$Definition['Troops'][12]['title'] = 'نیزه دار';
$Definition['Troops'][12]['desc'] = 'در ارتش توتن‌ها کار دفاع با نیزه داران است. اين سرباز با نیزه درازی که در اختيار دارد، در مقابل سواره نظام‌ها خوب می‌تواند دفاع کند. <br><br> ولی از او برای حمله استفاده نکنید، چرا که قدرت آسیب دهی بسیار پایینی دارد.';
$Definition['Troops'][13]['title'] = 'تبر زن';
$Definition['Troops'][13]['desc'] = 'قویترین پیاده نظام توتن‌ها است و هم در حمله و هم در دفاع بسیار قویست. سرعت کم و هزینه‌ی بالا ایراد این نیرو می‌باشد.';
$Definition['Troops'][14]['title'] = 'جاسوس';
$Definition['Troops'][14]['desc'] = 'جاسوس، خیلی جلوتر از ارتش توتن حرکت می‌کند تا اطلاعات لازم در مورد قدرت دشمن و وضعیت دهکده‌ی دشمن را دریابد. از آنجایی که او پیاده است، نسبت به نظیران خود در قبایل رومی و گول از سرعت پایین تری برخوردار است. او می‌تواند مقدار منابع، نیروها و موانع موجود در دهکده دشمن را شناسایی کند. <br><br> اگر دشمن جاسوس، ردیاب و یا خبرچین نداشته باشد، نفوذ او به دهکده‌ی دشمن، از دید دشمن پنهان خواهد ماند.';
$Definition['Troops'][15]['title'] = 'دلاور';
$Definition['Troops'][15]['desc'] = 'دلاور با داشتن زرهی مقاوم یک مدافع خوب است. مخصوصاً اينكه پیاده نظام‌ها در مقابل دلاور کاری از دست شان بر نمی‌آید. <br><br> متاسفانه، او قدرت و سرعت نسبتاً پایینی در مقایسه با سایر سواره نظام‌ها در حمله دارد و می‌توان گفت که قدرت و سرعت آن نسبت به سایر سواره نظام‌ها در حمله، زیر مقدار متوسط است. مدت زمان تربیت او طولانی و هزینه تربیت کردن چنین نیرویی زیاد است.';
$Definition['Troops'][16]['title'] = 'شوالیه توتن';
$Definition['Troops'][16]['desc'] = 'شوالیه‌ی توتن، یک جنگجوی ترسناک است. صدای پاهای او برای دشمن‌ها، خوف انگیز و مأیوس کننده است. او از لحاظ دفاعی، مدافع خوبی در مقابل سواره نظام‌ها است. اما هزینه‌ی تربیت و نگهداریش نیز فوق العاده زیاد است.';
$Definition['Troops'][17]['title'] = 'دژکوب';
$Definition['Troops'][17]['desc'] = 'دژکوب یک همراه خوب برای هر دو پیاده نظام و سواره نظام است. کار آن، تخریب دیوار شهر دشمن است و با این کار شانس نیروهایتان در فایق آمدن بر نیروهای دشمن بالا خواهد رفت.';
$Definition['Troops'][18]['title'] = 'منجنیق';
$Definition['Troops'][18]['desc'] = 'منجنیق، یک سلاح دور برد عالی برای خراب کردن مزارع، منابع و ساختمان‌های دشمن است. اما اگر با نیروهای دیگر همراهی نشود. تقربا بی دفاع است، پس فراموش نکنيد که هميشه تعدادی نیرو همراه با آن بفرستید <br><br> هر قدر سطح اردوگاه بیشتر باشد، به همان اندازه دقت منجنیق بالا می رود و شما می‌توانید موقع فرستادن آن، مشخص کنید که به چه ساختمانی می خواهید صدمه بزنید. اگر اردوگاه سطح 10 داشته باشید، به غیر از مخفیگاه، سنگ تراشی و تله ساز، همه ساختمان‌های دیگر را می‌توانید هدف قرار دهید. <br> راهنمایی: در صورتی که شلیک تصادفی انتخاب شود، ممکن است مخفیگاه، سنگ تراشی و تله ساز نیز تخریب شوند.';
$Definition['Troops'][19]['title'] = 'رئیس';
$Definition['Troops'][19]['desc'] = 'توتن‌ها از ميان خود رئیس انتخاب می‌کنند. برای انتخاب شدن، قدرت و شجاعت کافی نیست و علاوه بر اینها رئیس باید سخنگوی خوبی نیز باشد، چرا که وظیفه‌ی اصلی او راضی ساختن جمعیت دهکده‌های بیگانه برای پیوستن به قبیله‌ی اوست. <br><br> هر قدر رئیس بیشتر با اهالی یک دهکده صحبت کند، به همان اندازه وفاداری اهالی دهکده كاهش يافته و در نهایت، مردم دهکده به قبیله رئیس می‌پیوندد.';
$Definition['Troops'][20]['title'] = 'مهاجر';
$Definition['Troops'][20]['desc'] = 'مهاجرها روستایی‌هایی شجاع هستند که بعد از یک آموزش طولانی مدت از دهکده مهاجرت کرده و یک دهکده به افتخار شما بنا می کنند. <br><br> از آنجایی که سفر و بنا نهادن یک دهکده کاری دشوار است، این مهاجرها با همدیگر به سفر می‌پردازند. در ضمن از هر منبع نیز 750 تا با خود می برند.';
$Definition['Troops'][21]['title'] = 'سرباز پیاده';
$Definition['Troops'][21]['desc'] = 'سربازان پیاده، نسبتاً ارزان هستند و سریع تربیت می‌شوند. <br><br> قدرت حمله خوبی ندارند ولی مدافع خوبی در مقابل هر دو سواره و پیاده نظام‌ها هستند.';
$Definition['Troops'][22]['title'] = 'شمشیر زن';
$Definition['Troops'][22]['desc'] = 'شمشیرزن‌ها گرانتر از سربازان پياده هستند اما در عوض، جزو مهاجم‌ها به شمار می‌روند. <br><br> آنها از لحاظ دفاعی بسیار ضعیفند، مخصوصاً در مقابل سواره‌ها.';
$Definition['Troops'][23]['title'] = 'ردیاب';
$Definition['Troops'][23]['desc'] = 'ردیاب‌ها نیروی جاسوسی گول‌ها هستند. آنها خیلی سریع و با دقت عمل می‌کنند و می‌توانند آمار منابع و نیروهای دشمن را بدست آورند. <br><br> اگر دشمن جاسوس، ردیاب و یا خبرچین نداشته باشد، نفوذ او به دهکده‌ی دشمن، از دید دشمن پنهان خواهد ماند.';
$Definition['Troops'][24]['title'] = 'رعد';
$Definition['Troops'][24]['desc'] = 'رعد همانطور که از اسمش می توان فهمید، یک نیروی بسیار سریع است و می‌تواند مقدار زیادی منابع حمل کند، بنابراین بهترین غارتگر به حساب می آید. <br><br> اين نيرو، در دفاع از قدرت متوسطی برخوردار است.';
$Definition['Troops'][25]['title'] = 'کاهن سواره';
$Definition['Troops'][25]['desc'] = 'این شوالیه، یک نیروی دفاعی عالیست. هدف اصلی از ساخت کاهن‌ها، دفاع در مقابل پیاده نظام‌ها است. این نیرو هزینه‌ی تربیت و نگهداری بالایی دارد.';
$Definition['Troops'][26]['title'] = 'شوالیه گول';
$Definition['Troops'][26]['desc'] = 'شوالیه‌ی گول یک مهاجم عالی و یک مدافع حرفه‌ای در مقابل سواره نظام‌ها است. قلیلی از نیروها توان برابری در مقابل آنها را دارا هستند. <br><br> اما تربیت و تجهیز آنها خیلی پر هزینه است و بخاطر این که در هر ساعت سه غذا مصرف می‌کنند، بهتر است قبل از تربیت آنها بیندیشید که آیا ارزشش را دارند یا نه.';
$Definition['Troops'][27]['title'] = 'دژکوب';
$Definition['Troops'][27]['desc'] = 'دژکوب یک همراه خوب برای هر دو پیاده نظام و سواره نظام است. کار آن، تخریب دیوار شهر دشمن است و با این کار شانس نیروهایتان در فایق آمدن بر نیروهای دشمن بالا خواهد رفت.';
$Definition['Troops'][28]['title'] = 'منجنیق';
$Definition['Troops'][28]['desc'] = 'منجنیق، یک سلاح دور برد عالی برای خراب کردن مزارع، منابع و ساختمان‌های دشمن است. اما اگر با نیروهای دیگر همراهی نشود. تقربا بی‌دفاع است، پس فراموش نکنيد که هميشه تعدادی نیرو همراه با آن بفرستید. <br><br> هر قدر سطح اردوگاه بیشتر باشد، به همان اندازه دقت منجنیق بالا می‌رود و شما می‌توانید موقع فرستادن آن، مشخص کنید که به چه ساختمانی می‌خواهید صدمه بزنید. اگر اردوگاه سطح 10 داشته باشید، به غیر از مخفیگاه، سنگ تراشی و تله ساز، همه‌ی ساختمان‌های دیگر را می‌توانید هدف قرار دهید. <br> راهنمایی: در صورتی که شلیک تصادفی انتخاب شود، ممکن است مخفیگاه، سنگ تراشی و تله ساز نیز تخریب شوند.';
$Definition['Troops'][29]['title'] = 'رئیس قبیله';
$Definition['Troops'][29]['desc'] = 'هر قبیله‌ای یک جنگجوی با تجربه و قدیمی دارد که سخنان او می‌تواند بر روی اهالی دهکده‌ی دشمن تاثیرگذار باشد و آنها را برای پیوستن به قبیله‌ی خودش قانع کند. <br><br> هر چه بیشتر رئیس قبیله در مقابل دیوار دهکده‌ی دشمن به سخنرانی بپردازد، به همان اندازه وفاداری اهالی به پادشاه‌های خویش کمتر می‌شود و سرانجام آنها به قبیله رئیس گول ملحق می‌شوند.';
$Definition['Troops'][30]['title'] = 'مهاجر';
$Definition['Troops'][30]['desc'] = 'مهاجرها روستایی‌هایی شجاع هستند که بعد از یک آموزش طولانی مدت از دهکده مهاجرت کرده و یک دهکده به افتخار شما بنا می کنند. <br><br> از آنجایی که سفر و بنا نهادن یک دهکده کاری دشوار است، این مهاجرها با همدیگر به سفر می‌پردازند. در ضمن از هر منبع نیز 750 تا با خود می برند.';
$Definition['Troops'][31]['title'] = 'موش';
$Definition['Troops'][32]['title'] = 'عنکبوت';
$Definition['Troops'][33]['title'] = 'افعی';
$Definition['Troops'][34]['title'] = 'خفاش';
$Definition['Troops'][35]['title'] = 'گراز وحشی';
$Definition['Troops'][36]['title'] = 'گرگ';
$Definition['Troops'][37]['title'] = 'خرس';
$Definition['Troops'][38]['title'] = 'تمساح';
$Definition['Troops'][39]['title'] = 'ببر';
$Definition['Troops'][40]['title'] = 'فیل';
$Definition['Troops'][41]['title'] = 'نیزه دار ناتار';
$Definition['Troops'][42]['title'] = 'تیغ پوش';
$Definition['Troops'][43]['title'] = 'محافظ ناتار';
$Definition['Troops'][44]['title'] = 'پرندگان شکاری';
$Definition['Troops'][45]['title'] = 'تیشه زن';
$Definition['Troops'][46]['title'] = 'شوالیه ناتار';
$Definition['Troops'][47]['title'] = 'فيل عظيم الجثه جنگي';
$Definition['Troops'][48]['title'] = 'منجنیق عظيم';
$Definition['Troops'][49]['title'] = 'امپراطوري ناتار';
$Definition['Troops'][50]['title'] = 'مهاجر';
$Definition['Troops'][51]['title'] = 'نیروی برده‌ها';
$Definition['Troops'][51]['desc'] = 'نیروی برده‌ها ارزان‌ترین واحد در این بازی با کوتاه‌ترین زمان ساخت است. گرچه این نیرو به شما امکان می‌دهد خیلی سریع یک نیروی دفاعی ایجاد کنید، از لحاظ قدرت جنگی در مقایسه با سایر نیروهای دفاعی ضعیف هستند.';
$Definition['Troops'][52]['title'] = 'نگهبان خاکستر';
$Definition['Troops'][52]['desc'] = '«نگهبان خاکستر» سرباز پیاده استاندارد نیروی دفاعی شماست که دارای قدرت نبرد بالایی است. آنها در مقابل پیاده نظام‌های دیگر عملکردی استثنایی دارند، ولی ضعف نیروی دفاعی آنها در مقابل سواره نظام‌ها را نباید فراموش کرد.';
$Definition['Troops'][53]['title'] = 'جنگجوی قداره‌زن';
$Definition['Troops'][53]['desc'] = 'جنگجوی قداره‌زن یک سرباز ویژه است که هم قدرت حمله بالا و هم قدرت دفاعی چشمگیری در مقابل سایر جنگجوهای پیاده از خود به نمایش می‌گذارد.';
$Definition['Troops'][54]['title'] = 'کاوشگر سوپدو';
$Definition['Troops'][54]['desc'] = 'کاوشگر سوپدو به سوی قلمروهای ناشناخته می‌تازد تا منطقه و تعداد سربازان دشمن را برآورد کند. آنها قادر به بررسی دقیق روستاهای طرف مقابل نیز هستند و نقاط ضعف آنها را شناسایی می‌کنند.';
$Definition['Troops'][55]['title'] = 'گارد آنهور';
$Definition['Troops'][55]['desc'] = 'گارد آنهور یک مدافع سواره است که بر هرگونه پیاده نظام مهاجم غلبه می‌کند. علاوه بر داشتن قدرت دفاعی و تهاجمی متوسط در مقابل سواره نظام‌ها، پس از کاوشگر سوپدو سریعترین واحد مصری هستند.';
$Definition['Troops'][56]['title'] = 'ارابه ریشف';
$Definition['Troops'][56]['desc'] = 'ارابه ریشف در تمامی میادین جنگ مهارت دارد. آنها سلاح تهاجمی سنگینی را با خود می‌برند و در مقابل پیاده نظام‌ها دارای قدرت تدافعی بسیار بالایی هستند؛ ولی در دفاع مقابل سواره نظام‌ها حقیقتاً برتر عمل می‌کنند. از طرفی آموزش دادن آنها بسیار هزینه‌بر است و محصول زراعی فراوانی مصرف می‌کنند.';
$Definition['Troops'][57]['title'] = 'دژکوب';
$Definition['Troops'][57]['desc'] = 'دژکوب یک سلاح پشتیبان سنگین برای پیاده نظام و سواره نظام شماست. وظیفه آنها در هم کوبیدن دیوارهای دشمن و بنابراین افزایش شانس نیروهای شما در غلبه بر سنگرهای دشمن است.';
$Definition['Troops'][58]['title'] = 'منجنیق سنگ‌انداز';
$Definition['Troops'][58]['desc'] = 'منجنیق سنگ‌انداز یک سلاح عالی دوربرد است؛ از این سلاح برای نابود کردن زمین‌ها و ساختمان‌های روستاهای دشمن استفاده می‌شود. با این حال، بدون نیروهای اسکورت‌کننده، عملاً بی‌دفاع است و بنابراین نباید فراموش کنید که تعدادی از نیروهایتان را همراه آن بفرستید. 
<br>
داشتن میزان بالایی از امتیاز لشکرکشی باعث دقیق‌تر شدن منجنیق‌های شما می‌شود و این قابلیت را به شما می‌دهد که ساختمان‌های دیگر دشمن را هدف بگیرید. اطلاعات بیشتر از اینجا قابل دسترسی است. نکته: وقتی منجنیق‌ها به صورت تصادفی نشانه‌روی کنند می‌توانند مخفیگاه‌ها، تله‌ها یا سنگ‌تراشی‌ها را بزنند.';
$Definition['Troops'][59]['title'] = 'فرمانروا';
$Definition['Troops'][59]['desc'] = 'فرمانروا رهبر اجرایی مصری‌ها است. آنها بر سر شرایط تسلیم مذاکره می‌کنند و به لطف جذبه‌شان، می‌توانند افراد طرف دشمن را متقاعد کنند که به امپراتوری شما ملحق شوند. 
<br/>
با هر بار ملاقات فرمانروا، وفاداری گروه دشمن کاهش می‌یابد تا اینکه به صفر می‌رسد و آنها سلطنت شما را می‌پذیرند.';
$Definition['Troops'][60]['title'] = 'مقیم';
$Definition['Troops'][60]['desc'] = 'مقیم‌ها شهروندانی شجاع و دلاور هستند که پس از آموزش‌های بسیار از روستا خارج می‌شوند تا روستای جدیدی را به افتخار شما بنا کنند. 
<br/>
از آنجایی که هم این سفر و هم ایجاد روستای جدید امری بس دشوار است، سه مقیم باید با هم همراه شوند. حداقل تجهیزات مورد نیاز آنها 750 واحد از هر منبع است';
$Definition['Troops'][61]['title'] = 'مزدور';
$Definition['Troops'][61]['desc'] = '«مزدور» شخصی همه کاره است. عملکرد تدافعی و تهاجمی آنها به خوبی با سایر واحدها قابل مقایسه است ولی در هیچ یک از انواع نبرد برتری ندارند. با این حال، به تناسب توانایی‌های متوسط‌شان، هزینه‌های آموزش‌شان نیز در سطح متوسط است.';
$Definition['Troops'][62]['title'] = 'کمان‌دار';
$Definition['Troops'][62]['desc'] = 'کماندار اولین انتخاب شما برای حملات تهاجمی عظیم است. آنها عاشق این هستند که در خطوط مقدم باشند، که جای شکر دارد، چون مهارت‌های دفاعی‌شان خیلی ضعیف است.';
$Definition['Troops'][63]['title'] = 'دیدبان';
$Definition['Troops'][63]['desc'] = 'دیدبان یک واحد دیدبانی برق‌آساست که رازهای نظامی و اقتصادی روستاهای دشمن را شناسایی می‌کند و آنها را به شما منتقل می‌کند.';
$Definition['Troops'][64]['title'] = 'استپ‌سوار';
$Definition['Troops'][64]['desc'] = 'استپ‌سوار یک مهاجم برجسته است که آموزشش را سریعتر از بسیاری از جنگجوهای سواره دیگر تمام می‌کند. اما به همین دلیل آنها در نبردهای دفاعی بسیار ضعیف هستند.';
$Definition['Troops'][65]['title'] = 'تیرانداز';
$Definition['Troops'][65]['desc'] = 'تیرانداز یکی از واحدهای باتجربه سواره نظام است. به این خاطر که آنها تنها سرباز دفاعی ماهر هون‌ها هستند، به قدرت حمله بالایشان چندان توجهی نمی‌شود.';
$Definition['Troops'][66]['title'] = 'مهاجم';
$Definition['Troops'][66]['desc'] = 'مهاجم یکی از نیروهای بی‌نظیری است که باید آن را در نظر گرفت. با داشتن قدرت تهاجمی فوق‌العاده و سرعت بی‌نظیر، بدون اینکه ضربه‌ای به زره‌شان وارد شود اکثر نیروهای دفاعی را در هم می‌کوبند.';
$Definition['Troops'][67]['title'] = 'دژکوب';
$Definition['Troops'][67]['desc'] = 'دژکوب یک سلاح پشتیبان سنگین برای پیاده نظام و سواره نظام شماست. وظیفه آنها در هم کوبیدن دیوارهای دشمن و بنابراین افزایش شانس نیروهای شما در غلبه بر سنگرهای دشمن است.';
$Definition['Troops'][68]['title'] = 'منجنیق';
$Definition['Troops'][68]['desc'] = 'منجنیق یک سلاح عالی دوربرد است؛ از این سلاح برای نابود کردن زمین‌ها و ساختمان‌های روستاهای دشمن استفاده می‌شود. با این حال، بدون نیروهای اسکورت‌کننده، عملاً بی‌دفاع است و بنابراین نباید فراموش کنید که تعدادی از نیروهایتان را همراه آن بفرستید. 
<br/>
داشتن میزان بالایی از امتیاز لشکرکشی باعث دقیق‌تر شدن منجنیق‌های شما می‌شود و این قابلیت را به شما می‌دهد که ساختمان‌های دیگر دشمن را هدف بگیرید. اطلاعات بیشتر از اینجا قابل دسترسی است. نکته: وقتی منجنیق‌ها به صورت تصادفی نشانه‌روی کنند می‌توانند مخفیگاه‌ها، تله‌ها یا سنگ‌تراشی‌ها را بزنند.';
$Definition['Troops'][69]['title'] = 'رزمجویان';
$Definition['Troops'][69]['desc'] = 'رزمجویان با شکست دادن همه حریفان در نبرد جسمی و روحی سهمگین، جایگاه خودشان را بدست آورده‌اند. حالا آنها فقط به قصد تصرف از خانه بیرون می‌زنند. 
<br/>
هربار که به روستای دشمن پا می‌گذارند، حضور قدرتمندشان باعث می‌شود که وفاداری افراد روستا به مالک قبلی‌شان کمتر و کمتر شود، تا اینکه تصمیم می‌گیرند مطیع فرمان شما شوند.';
$Definition['Troops'][70]['title'] = 'مقیم';
$Definition['Troops'][70]['desc'] = 'مقیم‌ها شهروندانی شجاع و دلاور هستند که پس از آموزش‌های بسیار از روستا خارج می‌شوند تا روستای جدیدی را به افتخار شما بنا کنند. 
<br/>
از آنجایی که هم این سفر و هم ایجاد روستای جدید امری بس دشوار است، سه مقیم باید با هم همراه شوند. حداقل تجهیزات مورد نیاز آنها 750 واحد از هر منبع است.';

$Definition['Troops'][98]['title'] = 'قهرمان';
$Definition['Troops'][99]['title'] = 'تله';
//
$Definition['villageOverview']['villageOverview'] = 'دیدکلی دهکده';
$Definition['villageOverview']['Overview'] = 'دیدکلی';
$Definition['villageOverview']['Resources'] = 'منابع';
$Definition['villageOverview']['Warehouse'] = 'انبار';
$Definition['villageOverview']['CulturePoints'] = 'امتیاز فرهنگی';
$Definition['villageOverview']['Troops'] = 'لشکریان';
$Definition['villageOverview']['Select x as favor tab'] = 'انتخاب صفحه %s به عنوان صفحه موجود علاقه.';
$Definition['villageOverview']['This tab is set as favourite'] = 'این صفحه به عنوان صفحه مورد علاقه شما انتخاب شده است.';
$Definition['villageOverview']['Village statistics||For this feature you need Travian Plus activated'] = 'دیدکلی دهکده||برای استفاده از این قابلیت به اکانت پلاس فعال نیاز دارید.';
$Definition['villageOverview']['Village'] = 'دهکده';
$Definition['villageOverview']['Attacks'] = 'حملات';
$Definition['villageOverview']['Building'] = 'ساخت و ساز';
$Definition['villageOverview']['Troops'] = 'لشکریان';
$Definition['villageOverview']['Merchants'] = 'تاجران';
$Definition['villageOverview']['Own attacking troops'] = 'حملات خودی';
$Definition['villageOverview']['Oasis attacking troops'] = 'حملات به آبادی خودی';
$Definition['villageOverview']['Oasis reinforcing troops'] = 'نیروی کمکی به آبادی خودی';
$Definition['villageOverview']['Village reinforcing troops'] = 'نیروی کمکی';
$Definition['villageOverview']['Other attacking troops'] = 'حملات به دهکده های خودی';
$Definition['villageOverview']['Own Reinforcing troops'] = 'نیروهای کمکی خودی';
$Definition['villageOverview']['Sum'] = 'مجموع';
$Definition['villageOverview']['duration'] = 'مدت زمان';
$Definition['villageOverview']['CPs/Day'] = 'امتیازفرهنگی/روز';
$Definition['villageOverview']['Celebrations'] = 'جشن ها';
$Definition['villageOverview']['Slots'] = 'ظرفیت';
$Definition['villageOverview']['Own Troops'] = 'سربازان خودی';
$Definition['villageOverview']['Troops in villages'] = 'سربازان در دهکده ها';
$Definition['villageOverview']['Upkeep'] = 'مصرف گندم';
$Definition['villageOverview']['Armory'] = 'آهنگری';
$Definition['villageOverview']['inResearch'] = 'درحال تحقیق';
$Definition['villageOverview']['research_level'] = 'سطح فعلی تحقیقات';
$Definition['villageOverview']['per hour'] = 'در ساعت';
//
$Definition['demolishNowPopup']['Redeem'] = 'آماده کردن';
$Definition['demolishNowPopup']['desc'] = 'آیا مطمئن هستید میخواهید این ساختمان را کامل تخریب کنید؟ این ساختمان به طور کل از دهکده شما پاک می شود.';
//
$Definition['finishNowPopup']['title'] = 'به اتمام رساندن تمامی ساخت و ساز ها و تحقیقات در این دهکده.';
$Definition['finishNowPopup']['desc'] = 'گزینه های زیر بصورت فوری قابل ساخت میباشند';
$Definition['finishNowPopup']['Redeem'] = 'اتمام';
$Definition['finishNowPopup']['buildingOrders'] = 'درحال ساخت';
$Definition['finishNowPopup']['academy'] = 'تحقیق'.'(دارالفنون)';
$Definition['finishNowPopup']['smithy'] = 'تحقیق'.'(آهنگری)';
$Definition['finishNowPopup']['demolishBuildingLevel'] = 'تخریب ساختمان سطح';
$Definition['finishNowPopup']['level'] = 'سطح';
$Definition['finishNowPopup']['No construction orders or research that could be completed instantly'] = 'هیچ دستور ساخت یا تحقیقی قابل اتمام فوری نیست.';
//
$Definition['goldClubPopup'] = [];
$Definition['goldClubPopup']['title'] = 'کلوپ طلایی';
$Definition['goldClubPopup']['gold'] = 'طلا';
$Definition['goldClubPopup']['Bonus duration'] = 'مدت زمان';
$Definition['goldClubPopup']['whole game round'] = 'تا پایان بازی';
$Definition['goldClubPopup']['Additionally, you will have access to the following features:'] = 'سپس, شما به این امکانات دسترسی خواهید داشت:';
$Definition['goldClubPopup']['In order to use this feature, you need to activate the Gold club!'] = 'برای استفاده از این قابلیت نیاز دارید کلوپ طلایی خود را فعال کنید.';
$Definition['goldClubPopup']['troopEscape'] = [
    'title' => 'گریز لشکریان',
    'text'  => 'لشکریان خودی در پایتخت را می توان طوری فرمان داد تا در هنگام حمله گریز کنند.',
];
$Definition['goldClubPopup']['raidList'] = [
    'title' => 'لیست فارم',
    'text'  => 'در اردوگاه شما قادر به استفاده از فارم لیست برای حمله استفاده کنید.',
];
$Definition['goldClubPopup']['tradeThreeTimes'] = [
    'title' => 'ارسال مکرر تاجران',
    'text'  => 'توسط این ویژگی شما میتوانید تاجران خود را به 2 یا 3 بار ارسال اتوماتیک تنظیم کنید.',
];
$Definition['goldClubPopup']['tradeThreeTimes'] = [
    'title' => 'ارسال مکرر تاجران',
    'text'  => 'توسط این ویژگی شما میتوانید تاجران خود را به 2 یا 3 بار ارسال اتوماتیک تنظیم کنید.',
];
$Definition['goldClubPopup']['cropFinder'] = [
    'title' => 'گندم یاب',
    'text'  => 'در نقشه میتوانید از قابلیت گندم یاب برای دهکده های 15 یا 9 گندمی استفاده کنید.',
];
$Definition['goldClubPopup']['messageArchive'] = [
    'title' => 'آرشیو پیام ها و گزارشات',
    'text'  => 'در پیام ها یا گزارش ها می توانید از امکان آرشیو کردن استفاده کنید.',
];
$Definition['goldClubPopup']['furtherInfos'] = 'بعد از فعال سازی کلوپ طلایی تا پایان بازی قادر به استفاده از آن خواهید بود. برای اطلاعات بیشتر روی "i" کلیک کنید.';
//
$Definition['overlay'] = ['defaultTitle' => 'به تراوین جدید خوش آمدید',
    'defaultDescription' => 'نشانه گر موس خود را به قسمت های انتخاب شده حرکت دهید تا اطلاعات بیشتر در رابطه با آن قسمت نمایش داده شود.',
    'closeLink' => 'این صفحه را ببند و به بازی ادامه بده.',
    'mainPageTitle' => 'صفحه اصلی',
    'mainPageDescription' => 'این <span class="important">صفحه اصلی تراوین</span> است که در آن اطلاعات بازی ها و اخبار مربوطه درج میشود.',
    'villageSwitchTitle' => 'تغییر نمایش دهکده',
    'villageSwitchDescription' => 'توسط این قسمت میتوانید به بخش ساختمان ها و یا منابع برای ارتقاء و مدیریت آنها مراجعه نمائید.',
    'mainNavigationTitle' => 'مرور ویژه بازی',
    'mainNavigationDescription' => '<span class="important">نقشه:</span> در این قسمت تمام دهکده های خودی و همسایگان قابل مشاهده میباشد.<br /><span class="important">آمار:</span> بازیکن ها و اتحادهای در حال بازی در این قسمت نمایش داده میشوند.<br /><span class="important">گزارشات:</span> گزارشات مربوط به جنگ و تجارت شما در این قسمت میباشد.<br /><span class="important">پیغام:</span> در این قسمت میتوانید با بازیکن های دیگر ارتباط برقرار کنید.',
    'premiumFeaturesTitle' => 'خرید و استفاده طلا',
    'premiumFeaturesDescription' => 'خرید <span class="important">طلا</span> در این قسمت است و شما میتوانید از امکانات پلاس استفاده نمائید.<br /><span class="important">نقره</span> در حراجی برای خرید اجناس قهرمان استفاده میشود.',
    'outOfGameTitle' => 'مدیریت',
    'outOfGameDescription' => 'بخش های مورد استفاده بازی:<br /><span class="important">پروفایل:</span> ویرایش پروفایل بازی خود.<br /><span class="important">تنظیمات:</span> تنظیمات کلی و فنی اکانت خود.<br /><span class="important">انجمن:</span> تالار گفتمان اختصاصی تراوین.<br /><span class="important">پاسخ ها:</span> صفحه سوالات و پاسخ تراوین.<br /><span class="important">خروج:</span> خارج شدن از اکانت.',
    'villageResourcesTitle' => 'منابع داخل دهکده',
    'villageResourcesDescription' => 'حجم گنجایش انبار شما و منابع چوب، خشت و آهن دهکده شما در این قسمت میباشد.',
    'villageCropTitle' => 'گندم داخل دهکده',
    'villageCropDescription' => 'حجم گنجایش انبار غذا و مقدار منبع گندم شما در این قسمت میباشد.',
    'sidebarBoxHeroTitle' => 'تصویر قهرمان شما',
    'sidebarBoxHeroDescription' => 'قهرمان شما و مهمترین بخش های آن.<br />روی عکس قهرمان کلیک کنید تا اجناس آن قابل مشاهده باشند.<br />دکمه ی اول مربوط به ماجراجویی قهرمان میباشد; شما میتوانید قهرمان خود را به سرزمین های دیگر برای ماجراجویی ارسال نمائید. دکمه دوم مربوط به بخش حراجی اجناس قهرمان میباشد, جایی که شما اجناس را خرید و فروش میکنید.',
    'sidebarBoxAllianceTitle' => 'اتحاد شما',
    'sidebarBoxAllianceDescription' => 'در یک اتحاد، بازیکنان میتوانند بهتر برنامه های تجارت و جنگی خود را با کمک دوستان مدیریت کنند. برای پیشرفت امپراطوری خود به یک اتحاد نیاز خواهید داشت. زمانی که شما در یک اتحاد عضو شوید گزینه های زیر فعال خواهند شد.',
    'sidebarBoxInfoboxTitle' => 'اعلانات',
    'sidebarBoxInfoboxDescription' => 'در این قسمت پیام های مهم سیستم نمایش داده میشنود.',
    'sidebarBoxLinklistTitle' => 'لیست لینک ها',
    'sidebarBoxLinklistDescription' => 'برای استفاده از این بخش به اکانت پلاس تراوین نیاز دارید.<br />لینک های مستقیم دسترسی شما را به صفحات دلخواه خود، راحت تر و سریع تر میکند.',
    'sidebarBoxActiveVillageTitle' => 'قسمت مربوط به دهکده ی فعلی',
    'sidebarBoxActiveVillageDescription' => 'نام دهکده و مقدار وفاداری مربوط به دهکده فعال شما در این قسمت میباشد.<br />در بالای این قسمت 4 گزینه لینک سریع به ساختمان های درج شده میباشد که فقط در صورت داشتن اکانت پلاس تراوین فعال خواهند شد. دکمه ویرایش به شما این امکان را میدهد که نام دهکده خود را به نام دلخواه تغییر دهید.',
    'sidebarBoxVillagelistTitle' => 'لیست دهکده های موجود شما',
    'sidebarBoxVillagelistDescription' => 'در بالای این بخش، شما مشاهده میکنید که چه تعداد دهکده تحت فرمان شما هستند و چه تعداد دیگر میتوانید گسترش دهید. همچنان میتوانید امتیاز فرهنگی مورد نیاز برای تسخیر دهکده جدید را مشاهده نمائید. دکمه ها هم برای مشاهده دیدکلی دهکده ها و مختصات آنها میباشد.',
    'sidebarBoxQuestmasterTitle' => 'راهنما',
    'sidebarBoxQuestmasterDescription' => 'روی این قسمت کلیک کنید تا راهنمای تازه واردین شما باز شود. او برای شما خبرهای مهمی خواهد داشت که با انجام آنها با روند بازی آشنا خواهید شد.',
    'sidebarBoxQuestachievementsTitle' => 'وظایف روزانه برای جوایز روزانه',
    'sidebarBoxQuestachievementsDescription' => 'وظایف روزانه را بصورت مرتب برای جوایز برسی کنید. شما همچنین می توانید وظایف را برسی کنید تا طریقه ی گرفتن امتیاز را بیاموزید. سعی کنید قبل از ریست شدن وظایف روزانه جوایز خود را دریافت کنید.',
];
//
$Definition['plusPopup'] = ['title' => 'تراوین پلاس',
    'subHeadLine' => 'برای استفاده از این امکان نیاز به فعالسازی اکانت پلاس تراوین دارید.:',
    'plusPopupButtonExtraFeatures' => 'علاوه بر این، به شما امکان دسترسی به ویژگی های زیر را خواهد داد:',
    'Bonus duration in days:' => 'مدت زمان به روز:',
    "features" => [
        'attackWarning' => [
            'title' => 'اخطار حمله',
            'text' => 'زمانی که به دهکده های شما حمله میشود در لیست دهکده ها اخطار به نمایش در خواهد امد.',
        ], 'buildingQueue' => [
            'title' => 'نوبت ساخت',
            'text' => 'به شما این امکان را میدهد که همزمان چند ساختمان را ارتقاء دهید.',
        ], 'directLinks' => [
            'title' => 'لینک مستقیم',
            'text' => 'لینک مستقیم به بازار، سربازخانه، اصطبل و کارگاه, را برای شما فعال خواهد کرد.',
        ], 'linkList' => [
            'title' => 'لیست لینک',
            'text' => 'به شما این امکان را میدهد تا لینک های مورد علاقه خودتان را برای دسترسی آسان تر ثبت کنید.',
        ], 'villageStatistics' => [
            'title' => 'دیدکلی دهکده',
            'text' => 'در این قسمت تمام ریز مشخصات و محاسبات دهکده شما نمایش داده میشود.',
        ], 'fullScreen' => [
            'title' => 'نقشه بزرگ',
            'text' => 'برای دید بهتر دهکده ها و خانه های اطراف امپراطوری خود این گزینه در نقشه فعال خواهد شد.',
        ], 'tradeMulti' => [
            'title' => 'ارسال مکرر تاجران',
            'text' => 'توسط این ویژگی شما میتوانید تاجران خود را به 2 یا 3 بار ارسال اتوماتیک تنظیم کنید.',
        ],
    ],
    'furtherInfos' => 'اکانت تراوین پلاس به مدت %s روز برای شما اعتبار خواهد داشت، زمانی که اعتبار شما به پایان برسد تمام امکانات ذکر شده غیر فعال خواهند شد و شما نسبت به تمدید اکانت خود باید اقدام نمائید تا گزینه های بالا مجدداً فعال گردد.',
];
//
$Definition['productionBoostPopup']['+25%‎ lumber production'] = '+25% تولید چوب';
$Definition['productionBoostPopup']['+25%‎ clay production'] = '+25% تولید خشت';
$Definition['productionBoostPopup']['+25%‎ iron production'] = '+25% تولید آهن';
$Definition['productionBoostPopup']['+25%‎ crop production'] = '+25% تولید گندم';
$Definition['productionBoostPopup']['Production bonus'] = 'تولیدات پلاس';
$Definition['productionBoostPopup']['Select which resources production you would like to increase:'] = 'بسته مورد نظر خود را انتخاب کنید:';
$Definition['productionBoostPopup']['Bonus duration in days:'] = 'مدت زمان به روز:';
$Definition['productionBoostPopup']['furtherInfos'] = 'تولیدات پلاس باعث افزایش تولید منابع دهکده های شما در طول یک زمان محدود میباشد که باعث افزایش 25%% تولیدات شما خواهد شد. اگر شما یک بسته را انتخاب و فعالسازی کنید پس از مدت تعیین شده اعتبار شما به پایان خواهد رسید و برای افزایش دوباره باید تمدید کنید.';
$Definition['productionBoostPopup']['furtherInfos'] .= '%s';
$Definition['Support'] = [
    'Support' => 'پشتیبانی',
    'description' => 'از فرم زیر می‌توانید برای تماس با پشتیبانی استفاده کنید. لطفاً با دقت اطلاعات درخواست شده را وارد کنید تا قادر به راهنمایی و رفع مشکل شما در اسرع وقت باشیم. توجه کنید که بدون آدرس ایمیل معتبر، به درخواست شما رسیدگی نخواهد شد.',
    'Game errors, login errors and game rules related questions' => 'اشکال در بازی، مشکل لاگین و سوالات در مورد قوانین بازی',
    'Game world' => 'جهان (سرور) بازی',
    'please select' => 'لطفاً انتخاب کنید',
    'I don´t know' => 'نمی‌دانم',
    'Username' => 'نام کاربری',
    'Email' => 'ایمیل',
    'Category' => 'دسته',
    'Message' => 'پیام',
    'General questions' => 'سوالات عمومی',
    'I cannot log in' => 'نمی‌توانم وارد اکانت شوم',
    'I cannot register an account' => 'نمی‌توانم ثبت نام کنم',
    'send request' => 'ارسال درخواست',
    'Captcha' => 'کدامنیتی',
    'errors' => [
        'please select' => 'لطفاً انتخاب کنید',
        'This field is necessary' => 'پر کردن این خانه الزامی می‌باشد.',
        'Entry is too short' => 'اطلاعات وارد شده بسیار کوتاه می‌باشد.',
        'Invalid email address' => 'آدرس ایمیل نامعتبر.',
        'Wrong captcha' => 'کدامنیتی صحیح نیست.',
    ],
    'done' => 'سعی خواهیم کرد در اسرع وقت مشکل شما را رفع کنیم. لطفاً منتظر پاسخ بمانید - معمولاً پاسخ تمامی نامه‌ها تا 24 ساعت ارسال می‌شود.',
];
$Definition['inGameSupport'] = [
    'Support' => 'پشتیبانی',
    'description' => 'از فرم زیر می‌توانید برای تماس با پشتیبانی استفاده کنید. لطفاً با دقت اطلاعات درخواست شده را وارد کنید تا قادر به راهنمایی و رفع مشکل شما در اسرع وقت باشیم. توجه کنید که بدون آدرس ایمیل معتبر، به درخواست شما رسیدگی نخواهد شد.',
    'Game errors, login errors and game rules related questions' => 'اشکال در بازی، مشکل لاگین و سوالات در مورد قوانین بازی',
    'Category' => 'دسته',
    'Message' => 'پیام',
    'general questions' => 'سوالات عمومی',
    'report an error' => 'گزارش اشکال در بازی',
    'send request' => 'ارسال درخواست',
    'please select' => 'لطفاً انتخاب کنید',
    'Game support' => 'پشتیبانی بازی',
    'Violation of the rules' => 'نقض قوانین بازی',
    'Plus support' => 'پشتیبانی پلاس',
    'Back to the village' => 'بازگشت به دهکده.',
    'Captcha' => 'کدامنیتی',
    'errors' => [
        'please select' => 'لطفاً انتخاب کنید',
        'This field is necessary' => 'پر کردن این خانه الزامی می‌باشد.',
        'Entry is too short' => 'اطلاعات وارد شده بسیار کوتاه می‌باشد.',
        'Wrong captcha' => 'کدامنیتی صحیح نیست.',
    ],
    'done' => 'سعی خواهیم کرد در اسرع وقت مشکل شما را رفع کنیم. لطفاً منتظر پاسخ بمانید - معمولاً پاسخ تمامی نامه‌ها تا 24 ساعت ارسال می‌شود.',
];
$Definition['LinkList']['Vouchers (GoldBank)'] = 'بانک طلا';
$Definition['LinkList']['Farmlist'] = 'لیست فارم ها';
$Definition['LinkList']['Farms'] = 'فارم ها';
$Definition['LinkList']['Go to admin panel'] = 'پنل میریت';
$Definition['LinkList']['Contact Support'] = 'تماس با پشتیبانی';

$Definition['Email']['serverStartEmailSubject'] = 'سرور جدید بزودی شروع می شود';
$Definition['Email']['serverStartEmail'] = '
<div style="font-size: 14px; direction: RTL;">
[PLAYERNAME] عزیز, <br />
 سرور <b><u>[SERVER_NAME]</b></u> به زودی شروع خواهد شد!
<br />
<p style="color: red; font-weight: bold; font-size: 16px; text-align: center;">سرور در <u>[SERVER_START_TIME]</u> شروع خواهد شد..</p>
<br />
این ایمیل برای طلاع رسانی رسانی به شما ارسال شده است. سرور <b><u>[SERVER_NAME]</u></b> به زودی شروع خواهد شد، این سرور پر هیجان را از دست ندهید! اولین نفری باشید که در سرور ثبت نام می کنید!<br />
<p style="color: green; font-weight: bold; font-size: 16px; text-align: center;">
رای بازی در این سرور رو لینک کلیلک کنید. <a href="[SERVER_URL]">[SERVER_URL]</a>
</p>
</div>';
$Definition['redeemCode'] = [
    'Redeem' => 'معتبر سازی',
    'EnterYourCodeTo' => 'اگر کدی در دست دارید برای دریافت خرید خود در فرم زیر وارد کنید:',
    'Redeem code' => 'معتبر سازی کد',
    'Purchased code' => 'کد خریداری شده',
    'invalidCode' => 'کد وارد شده اشتباه است.',
    'codeIsUsed' => 'این کد قبلا استفاده شده است.',
    'redeemSuccess' => 'کد شما با موفقیت استفاده شد. طلای خریداری شده به زودی به اکانت شما واریز خواهد شد.',
    'tooManyTries' => 'شما تعداد زیادی تلاش ناموفق داشته اید. لطفا پس از مدتی دوباره امتحان کنید.',
    'unknownError' => 'خطای نامشخص',
];
$Definition['Voting'] = [
    'description' => 'You can vote here at these websites listed below and get %s gold for free.',
    'Next vote in %s hours' => 'Next vote in %s hours.',
    'Vote at TopG' => 'Vote at TopG',
    'Vote at Arena Top 100' => 'Vote at Arena Top 100',
    'Vote at GTop100' => 'Vote at GTop100',
];
$Definition['Embassy']['Alliance'] = 'اتحاد';
$Definition['Embassy']['Password'] = 'رمز';
$Definition['Embassy']['Confirm'] = 'تایید';
$Definition['Embassy']['No nearby alliance found'] = 'اتحادی در نزدیکی شما یافت نشد.';
$Definition['Embassy']['Population'] = 'جمعیت';
$Definition['Embassy']['Villages within 50 fields'] = 'دهکده های موجود در 50 حوزه';
$Definition['Embassy']['Alliance %s (%s), invited by %s'] = 'اتحاد %s (%s), دعوت شده توسط %s';
$Definition['Embassy']['Found alliance'] = 'تاسیس اتحاد';
$Definition['Embassy']['In order to found an alliance you need to have an embassy level 3'] = 'برای پیدا کردن یک اتحاد شما نیاز به ساخت یک سفارت خانه سطح 3 دارید';
$Definition['Embassy']['Join alliance'] = 'پیوستن به اتحاد';
$Definition['Embassy']['Find alliance'] = 'یافتن اتحاد';
$Definition['Embassy']['The password is wrong'] = 'رمز عبور درست نیست.';
$Definition['Embassy']['In order to quit the alliance you have to enter your password again for safety reasons'] = '
برای خروج از اتحاد باید رمز اکانت (کلمه‌ی عبور) خود را بدلیل مسائل امنیتی دوباره وارد کنید.';
$Definition['Embassy']['Leave the alliance'] = 'ترک اتحاد';
$Definition['Embassy']['Alliance leave contribution note'] = 'این موضوع تنها بر روی مجموع رتبه مشارکت کلی شما تاثیر خواهد گذاشت. مشارکت در امتیازهای اضافی در اتحاد فعلی همچنان باقی خواهند ماند و اگر شما بازگردید جمع مشارکت شما 0 خواهد بود.';
$Definition['Embassy']['If you leave the alliance your contribution statistics will reset'] = 'اگر شما اتحاد خود را ترک کنید ، شاخص های شما ریست خواهند شد';
$Definition['Mail']['Hello'] = 'سلام';
$Definition['Mail']['Activate'] = 'فعال سازی';
$Definition['Mail']['Activation code'] = 'کد فعال سازی';
$Definition['Mail']['Email verification reminder'] = 'یادآور تایید ایمیل';
$Definition['Mail']['Activation progress reminder'] = 'یادآور تکمیل ثبت نام';
$Definition['Mail']['_TO_ACTIVATE_YOUR_ACCOUNT_PLEASE_'] = 'برای فعال کردن اکانت خود، لطفاً روی دکمه تأیید کلیک کنید یا لینک فعال‌سازی زیر را کپی کرده و در مرورگرتان قرار دهید.';
$Definition['Mail']['Continue Registration Progress'] = 'ادامه پروسه ثبت نام';
$Definition['Mail']['Your Travian Team'] = 'تیم تراوین شما';
$Definition['Mail']['Enjoy the game and fight many glorious battles'] = 'از بازی لذت ببرید و در نبردهای باشکوه شرکت کنید';
$Definition['Mail']['Game world Url'] = 'لینک جهان بازی';
$Definition['Mail']['Thank you for registering on %s'] = 'از ثبت نام شما در %s سپاسگزاریم';
$Definition['Mail']['APPROVED_EMAIL_TO_CONTINUE_INSTRUCTIONS'] = 'شما قبلا ایمیل خود را تایید کرده اید. برای ادامه پروسه ثبت نام، وارد اکانت خود شده یا روی دکمه زیر کلیک کنید تا مستقیما به صفحه ادامه عملیات ثبت نام منتقل شوید.';

$Definition['EVerify'] = [
    'Email verification' => 'تایید ایمیل',
    'VERIFICATION_CODE' => 'کد تایید',
    'NEED_VERIFICATION_FOR_FEATURES' => 'برای استفاده از کلیه امکانات بازی شما باید ایمیل خود را تایید کنید.',
    'ADD_NEW_VERIFY_PROGRESS' => 'ایجاد یک پروسه فعال سازی',
    'VERIFY' => 'تایید',
    'EMAIL_ADDRESS' => 'آدرس ایمیل',
    'VERIFICATION_IN_PROGRESS' => 'درحال حاظر یک پروسه تایید در حال اتجام می باشد.',
    'ENTER_CODE_OR_CLICK_ON_THE_LINK' => 'کدتاییدیه را که در ایمیل خود دریافت کرده اید در اینجا وارد کنید یا روی لینک دریافتی کلیک کنید.',
    'PLEASE_CHECK_SPAM_BOX' => 'لطفا <b>پوشه اسپم</b> را هم در ایمیل خود برسی کنید.',
    'TO_CANCEL_AND_CREATE_NEW_ONE_CLICK_HERE' => 'برای حذف پروسه فعلی و ایجاد پروسه جدید <a href="/verify.php?cancelProgress">اینجا کلیک کنید.</a>',
    'errors' => [
        'emptyEmail' => 'لطفا یک آدرس ایمیل وارد کنید.',
        'invalidEmail' => 'آدرس ایمیل وارد شده معتبر نمی باشد.',
        'alreadyInProgress' => 'شما یک پروسه فعال برای تایید ایمیل دارید.',
        'emailAlreadyExists' => 'این آدرس ایمیل قبلا موجود است. هرایمیل تنها قادر به استفاده در یک اکانت می باشد.',
        'emailBlacklisted' => 'این آدرس ایمیل در لیست سیاه موجود است. شما قادر به تایید این ایمیل نمی باشید.',
        'noVerificationInProgress' => 'هیچ پروسه ای در جریان نمی باشد.',
        'emptyCode' => 'لطفا کد تاییدیه را وارد کنید.',
        'invalidCode' => 'کد تاییدیه وارد شده معتبر نمی باشد.',
        'verificationSuccessFull' => 'تایید با موفقیت انجام شد. کلیه امکانات از هم اکنون در اکانت شما در دسترس است.',
        'invalidCaptcha' => 'ریکپچا اشتباه است.',
        'verificationEmailHasBeenSent' => 'کد تاییدیه به ایمیل شما ارسال شد.
<br/>
لطفا ایمیل خود را برسی کنید و کد فعال سازی دریافتی را اینجا وارد کنید یا روی لینک دریافتی کلیک کنید. همچنین درصورت عدم دریافت ایمیل پوشه اسپم را هم برسی کنید.',
        'tooManyResends' => 'شما به تعداد بالا درخواست ارسال دوباره ایمیل کرده اید. لطفا آرامش خود را حفظ کرده و بعدا تلاش کنید.',
    ],
    'limitations' => [
        'شما قادر به بازیابی رمز عبور اکانت در صورت فراموشی نخواهید بود.',
        'شما فادر به ارسال حملات و نیروی کمکی نخواهید بود.',
        'شما قادر به خرید طلا و بسته های ویژه نمی باشید.',
        'شما قادر به استفاده از طلاهای ذخیره شده در ایمیل خود نمی باشید.',
        'طلاهای خریداری شده ذخیره نخواهند شد.',
        'مدال ها و سابقه شما ذخیره نخواهد شد.',
        'مدال ها و سوابق قبلی شما در پروفایل نمایان نخواهد شد.',
    ],
    'UNVERIFIED_ACCOUNT_LIMITATIONS' => 'محدودیت های اکانت تایید نشده',
    'YOU_CANNOT_DO_THE_FOLLOWING_THINGS' => 'درصورتی که ایمیل خود را تایید نکنید قادر به انجام کارهای زیر نیستید',
    'WE_ARE_NOT_RESPONSIBLE_AS_ADMINISTRATORS_TO_RESTORE' => 'اگر شما ایمیل خود را تایید نکنید، ما به عنوان مدیریت مسئولیتی دربرابر بازیابی اکانت، ذخیره طلا ها و مدال ها و غیره نمی پذیریم.',
    'YOU_ARE_THE_ONLY_ONE_RESPONSIBLE' => 'شما مسئول عواقب هستید.',
    'TO_LOGIN_PLEASE_CLICK_HERE' => 'برای ورود <a href="login.php">اینجا کلیک کنید</a>.',
    'NO_CODE_ENTERED' => 'کدی وارد نشده است.',
    'ENTERED_CODE_INVALID' => 'کد وارد شده معتبر نمی باشد.',
    'EMAIL_EXISTS_CANT_VERIFY' => 'ما قادر به تایید ایمیل شما نبودیم چون این ایمیل قبلا تایید شده است',
    'EMAIL_BLACKLISTED_CANT_VERIFY' => 'ما قادر به تایید ایمیل شما نبودیم چون این ایمیل در لیست سیاه موجود است',
    'NO_MATCHING_ROWS_FOUND' => 'کد وارد شده معتبر نمی باشد.',
    'YOUR_ACCOUNT_WAS_VERIFIED_SUCCESSFULLY' => 'ایمیل شما با موفقیت تایید شد.',
    'email' => [
        'HELLO_X' => 'سلام %s،',
        'THANKS_FOR_REGISTERING_ACCOUNT' => 'از ثبت نام در تراوین متشکیم.',
        'INSTRUCTIONS' => 'برای تایید ایمیل خود روی لینک زیر کلیک کرده و یا کد تایید را مستقیما در سیستم وارد کنید:',
        'YOUR_ACCESS_DATA' => 'اطلاعات ورود شما',
        'PLAYER_NAME' => 'نام بازیکن',
        'EMAIL_ADDRESS' => 'آدرس ایمیل',
        'GAME_WORLD' => 'جهان بازی',
        'VERIFICATION_CODE' => 'کد تایید',
        'HAVE_A_GOOD_TIME_AND_MANY_GLORIOUS_BATTLES' => 'از بازی تراوین لذت برده و پیروز باشید.',
        'YOUR_TRAVIAN_TEAM' => 'تیم تراوین شما',
        'GAME_HINTS' => 'نکات بازی',
        'IN_OUR_ANSWERS_AND_FORUM' => 'راهنمای بازی: در سایت پاسخ‌های تراوین %s می‌توانید اطلاعات زیادی در مورد تراوین پیدا کنید. در عین حال می‌توانید به فروم ما در %s برای گفتگو و آشنایی با بازیکن‌های دیگر نیز مراجعه کنید.',
    ],
    'YOUR_EMAIL_ADDRESS_IS_NOT_VERIFIED_TO_VERIFY_CLICK_HERE' => 'آدرس ایمیل شما تایید نشده است. برای تایید لطفا <a href="/verify.php">اینجا کلیک کنید</a>.',
    'TO_RESEND_EMAIL_PLEASE_CLICK_HERE' => 'برای ارسال مجدد کد تاییدیه <a href="verify.php?resendEmail">اینجا کلیک کنید</a>.',
    'LOGIN_BEFORE_GAME_DESCRIPTION_VERIFY' => 'اکانت شما فعال شده و فعلا نیازی به تایید ایمیل نمی باشد. بعد از شروع بازی شما بلافاصله می توانید با استفاده از نام کاربری و رمز عبور خود وارد بازی شوید.',
];
$Definition['Truce'] = [
    'reasons' => [
        0 => 'معمولی',
        1 => 'کریسمس',
        2 => 'سال نو',
        3 => 'عید',
        4 => 'عاشورا',
    ],
    'infobox_reasons' => [
        0 => 'روز صلح فعال است<br>شروع: %s<br>پایان:%s',
        1 => 'روز صلح به مناسبت کریسمس فعال است<br>شروع: %s<br>پایان:%s',
        2 => 'روز صلح به مناسبت سال نو فعال است<br>شروع: %s<br>پایان:%s',
        3 => 'روز صلح به مناسبت عید فعال است<br>شروع: %s<br>پایان:%s',
        4 => 'روز صلح فعال است.<br>شروع: %s<br>پایان:%s',

    ],
    'report_descriptions' => [
        0 => '%s از دهکده شما بازدید می کند.',
        1 => '%s برایتان کریسمس خوبی آرزو می کند.',
        2 => '%s سال خوبی برایتان آرزو می کند',
        3 => '%s عید خوبی را آرزو می کند.',
        4 => '%s روز عاشورا را به شما تسلیت میگوید',
    ],
];
$Definition['AllianceBonus'] = [
    'As sitter you can`t contribute to alliance bonuses' => 'به عنوان جانشین شما اجازه مشارکت در امتیاز ویژه اتحاد را ندارید.',
    'You have reached you daily contribution limit, Reset in %s' => 'شما به محدودیت روزانه مشارکت خود رسیده اید. ریست در %s.',
    'Your contribution will be tripled' => 'مشارکت شما 3 برابر خواهد شد',
    'Your active village was changed' => 'دهکده فعال تغییر کرده است',
    'Invalid resources entered' => 'منابع وارد شده معتبر نیست',
    'Not enough are not available' => 'منابع موجود نیست',
    'The amount of gold could not be subtracted from your account' => 'امکان کسر طلا از اکانت شما وجود نداشت',
    'Contribution: %s resources' => 'مشارکت: %s منابع',
    'Tripled: %s resources' => 'سه برابر شد: %s منابع',
    'Contribute' => 'مشارکت',
    'Contribution failed:' => 'مشارکت موفقیت آمیز نبود:',
    'You can`t contribute when next level is unlocking' => 'شما نمی توانید زمانی که سطح بعدی درحال بازشدن است مشارکت کنید.',
    'Contribution limit for today is reached' => 'محدودیت مشارکت شما برای امروز به سر رسیده است.',
    'Recruitment' => 'آموزش',
    'Philosophy' => 'فلسفه',
    'Metallurgy' => 'فلزکاری',
    'Commerce' => 'تجارت',

    'training_upgrading' => 'آموزش درحال ارتقا است',
    'cp_upgrading' => 'فلسفه درحال ارتقا است',
    'armor_upgrading' => 'فلز کاری درحال ارتقا است',
    'trade_upgrading' => 'تجارت درحال ارتقا است',

    'training_bonus_maxed' => 'آموزش به حداکثر سطح خود رسید',
    'cp_bonus_maxed' => 'فلسفه به حداکثر سطح خود رسید',
    'armor_bonus_maxed' => 'فلزکاری به حداکثر سطح خود رسید',
    'trade_bonus_maxed' => 'تجارت به حداکثر سطح خود رسید',

    'Faster troop production bonus' => 'امتیاز ویژه آموزش سریع نیروها',
    'Culture Points production bonus' => 'امتیاز ویژه تولید امتیاز فرهنگی',
    'Weapons and armor bonus' => 'امتیاز ویژه سلاح و زره',
    'Merchant capacity bonus' => 'امتیاز ویژه برای ظرفیت تاجران',
    'Please select a bonus' => 'یک امتیاز ویژه انتخاب کنید.',
    'Sum:' => 'جمع:',
    'Contribute x3' => 'مشارکت x3',
    'AllianceBonusDescription' => 'کار تیمی رمز موفقیت در دنیای تراوین است. با کمک به تأمین منابع، جوایزی را برای کل اتحاد خود به ارمغان ببرید و برتری‌تان را نسبت به سایرین افزایش دهید. با توجه به اینکه فعال کردن یک امتیاز ویژه نیاز به میزان زیادی منابع دارد، کل اتحاد می بایست برای رسیدن به این هدف همکاری کنند و برای رسیدن به امتیاز ویژه حمایت از راه اهداء منابع انجام دهند.',
    'Contribute resources' => 'مشارکت در ارسال منابع',
    'My daily contribution limit (reset in %s)' => 'حد مجاز مشارکت من در روز (ریست در %s)‎',
    'Amount of resources you can still contribute: %s' => 'مقدار منابعی که شما هنوز می توانید مشارکت کنید: %s',
    'Contribution successful' => 'مشارکت با موفقیت انجام شد.',
    'Alliance bonus overview' => 'بررسی امتیاز ویژه اتحاد',
    'Contributors of the Week' => 'مشارکت کننده های هفته',
    'Contributors of all Time' => 'مشارکت کننده های کل',
    'NoColumn' => 'شماره',
    'Player(s)' => 'بازیکن',
    'Resources' => 'منابع',
    'Amount of resources needed to reach next level: %s' => 'مقدار منابع مورد نیاز برای رسیدن به سطح بعدی: %s',
    'training_bonus_desc' => 'اشتراک‌گذاری بینش‌های نظامی می‌تواند نقش بسزایی در پیروزی در جنگ داشته باشد. پیشرفت‌های حاصل در حوزه توسعه ماشین‌های جنگی و مربیان مجرب باعث افزایش سریعتر بزرگی ارتش شما خواهد شد.',
    'armor_bonus_desc' => 'برای رشد یک امپراتوری شما نیاز به چیزهایی بیشتری نسبت به یک ارتش دارید. به مردم خود آموزش علوم مختلف ارائه دهید تا در زمینه های مختلف تبدیل شوند به پیشگامان در معماری و مزرعه داری و مدیریت دهکده. یک فرهنگ غنی، به راحتی با نفوذ خود در ملت های دیگر، آنها را به پذیرش قوانین و حکومت شما تشویق خواهد کرد.',
    'cp_bonus_desc' => 'در طول تاریخ، درگیری‌ها با یک اصل مشترک تعیین می‌شده است: باید چوبت بزرگتر باشد. زره تقویت‌شده و تسلیحات پیشرفته‌تر کمک می‌کند که سربازان شما بر دشمنان برتری یابند.',
    'trade_bonus_desc' => 'نبردی که منابعش تأمین مجدد نشود مساوی است با باخت. اسب‌های بارکش و ارابه‌های بزرگتر به تاجران شما کمک می‌کند که منابع بیشتری را به محل‌های مورد نیاز حمل کنند، چه آنجا خط مقدم باشد و چه دوستی که نیازمند کمک است.',
    'training_bonus_upgrading' => 'امتیاز ویژه آموزش در حال ارتقا است و آماده می شود در %s',
    'armor_bonus_upgrading' => 'امتیاز ویژه سلاح و زره در حال ارتقا است و آماده می شود در %s',
    'cp_bonus_upgrading' => 'امتیاز ویژه فلسفه در حال ارتقا است و آماده می شود در %s',
    'trade_bonus_upgrading' => 'امتیاز ویژه تجارت در حال ارتقا است و آماده می شود در %s',
    'You joined the alliance less than 24:00 hours ago' => 'شما کمتر از 24:00 ساعت است که عضو اتحاد شده اید.',
    'You can still donate, but you may have to wait for the bonuses to unlock' => 'شما می توانید مشارکت کنید ولی ممکن است برای فعال شدن امتیاز ها زمانی در انتظار باشید.',
    'Bonus activation time: %s' => 'زمان فعال سازی امتیاز ویژه: %s',
    'Alliance bonus level %s (+%s%%)' => 'سطح امتیاز اضافی اتحاد %s (+%s%%)',
];
$Definition['WWChangeName'] = [
    'Name' => 'نام',
    'Wonder of the world name' => 'نام شگفتی جهان',
    'What do you want Wonder of the world name to be?' => 'می خواهید نام شگفتی جهان شما چه باشد؟',
    'Can be changed until level 11' => 'تا قبل از مرحله 11 قابل تغییر است',
];
$Definition['TransferGold'] = [
    'title' => 'انتقال طلا',
    'desc' => 'با استفاده از این قابلیت شما می توانید طلای خریداری شده در اکانت خود را به اکانت دیگری انتقال دهید. برای انتقال حداقل 30 طلا لازم است.',
    'transfer_cost' => 'هزینه انتقال: %s%% از طلای انتقالی',
    'only_bought' => '🔴 فقط طلاهای خریداری شده قابل انتقال هستند.',
    'the_following_errors' => 'خطا های زیر رخ داد:',
    'available_gold' => 'طلای موجود',
    'gold_amount' => 'مقدار طلا',
    'target_player' => 'بازیکن مقصد',
    'cost' => 'هزینه',
    'transfer' => 'انتقال',
    'InvalidGoldAmount' => 'مقدار طلا صحیح نیست',
    'YouDoNotHaveEnoughGold' => 'شما طلای کافی ندارید',
    'TargetPlayerUnknown' => 'بازیکن مقصد نامشخص است',
    'TargetPlayerNotFound' => 'بازیکن یافت نشد',
    'transfer_success_msg' => '%s <img src="img/x.gif" class="gold"> با موفقیت به اکانت %s انتقال یافت.',
    'recent_transfers' => 'انتقال های اخیر',
    'player' => 'بازیکن',
    'amount' => '<img src="img/x.gif" class="gold">',
    'date' => 'تاریخ',
    'TransferMsg' => [
        'Subject' => 'انتقال طلا انجام شد',
        'Message' => "سلام %s\n\n%s طلا از بازیکن %s به اکانت شما انتقال یافت.\n\nموفق باشید.",
    ],
    'SenderEmailAddress' => 'ایمیل ارسال اکانت مبدا',
    'InvalidAccountEmail' => 'ایمیل وارد شده برای اکانت صحیح نیست.',
];
return $Definition;