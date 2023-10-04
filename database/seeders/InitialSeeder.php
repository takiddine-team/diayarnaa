<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\BackgroundImage;
use App\Models\Feature;
use App\Models\ContactUs;
use App\Models\DiyarnaaCity;
use App\Models\DiyarnaaCountry;
use App\Models\DiyarnaaRegion;
use App\Models\FeatureType;
use App\Models\MainCategory;
use Illuminate\Database\Seeder;
use App\Models\PremiumMembership;
use App\Models\PremiumMembershipPage;
use App\Models\SubCategory;
use App\Models\Target;
use App\Models\TermCondition;

class InitialSeeder extends Seeder
{
    public function run()
    {
        // ======================================================================
        // ============================= About Section ==========================
        // ======================================================================
        About::create([
            'about_description_en' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl',
            'about_description_ar' => '
            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المق
            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن
            التركيز على الشكل الخارجي للنص أوعن التركيز على الشكل الخارجي للنص أو ',

            'about_image' => 'about.jpg',

            'our_message_en' => ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl. Sed euismod, nisl vel aliquam aliquam, n ',
            'our_message_ar' =>
            '
            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المق
            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن
            التركيز على الشكل الخارجي للنص أوعن التركيز على الشكل الخارجي للنص أو ',
            'our_message_image' => 'style_files/frontend/img/ab1.png',

            'our_vission_en' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod ',
            'our_vission_ar' =>
            '
            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المق
            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن
            التركيز على الشكل الخارجي للنص أوعن التركيز على الشكل الخارجي للنص أو ',
            'our_vission_image' => 'style_files/frontend/img/ab2.png',

            'our_value_en' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod ',
            'our_value_ar' =>
            '
            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المق
            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن
            التركيز على الشكل الخارجي للنص أوعن التركيز على الشكل الخارجي للنص أو ',
            'our_value_image' => 'style_files/frontend/img/ab3.png',
            'background_aboutus_image' => 'style_files/frontend/img/inner1.png',
            'background_company_image' => 'style_files/frontend/img/inner1.png',
        ]);

        // ======================================================================
        // ============================= Term Condition Section ==========================
        // ======================================================================



        $term_conditions = [

            [
                'term_title_ar' => 'القبول',
                'term_title_en' => 'Acceptance',
                'term_description_ar' => '<ul>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">شركة ديارنا العربية هي شركة مركزها الرئيسي </span></span><span style=\"font-size:12.0pt\">المغرب - طنجة <span style=\"color:black\">&nbsp;وهي مالكة لموقع ديارنا العربية </span></span><span dir=\"LTR\" style=\"font-size:12.0pt\"><span style=\"color:black\">www.diyarnaa.com</span></span><span style=\"font-size:12.0pt\"><span style=\"color:black\"> (موقع إلكتروني على الشبكة العنكبوتية الإنترنت) والمشار إليه فيما بعد &quot;الموقع&quot; والذي يوفر خدمات عقارية بمختلف الدول العربية عن طريق الإعلانات سواء عن طريق ملاك العقارات أو المكاتب العقارية المعتمدة والمرخصة المنتشرة بكافة الدول العربية أو عن طريق وكلاء الموقع المنتشرين على مستوى الدول العربية والمشار إليها فيما بعد بشكل جماعي &quot;الخدمة&quot;.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">&quot;الرسوم&quot; يقصد بها المبلغ المستحق لنا من جانبكم بموجب أمر الاشتراك.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">&quot;العضوية&quot; يقصد بها أحقيتكم في الحصول على الخدمات بموجب الشروط والأحكام للخدمات المقدمة لأي عضو أو مجموعة خدمات حسب باقة العضوية المختارة في أمر الاشتراك.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">بقبولكم استخدام هذا الموقع فإنكم توافقون على الالتزام بشروط الاستخدام للموقع الإلكتروني ويشار إليها مجتمعة فيما بعد باسم &quot;الشروط&quot; وتتعهدون بالالتزام بها وأي تغيير أو تحديث يطرأ عليها من وقت لآخر وفى حالة اعتراضكم على أي شرط من تلك الشروط يكون خياركم الوحيد هو التوقف فورا عن استخدام الموقع.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">كما توافقون على أنكم مسؤولون عن مخالفة أي قوانين محلية أو دولية. </span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">ويعمل بهذه الشروط بيننا وبينكم فور قبولكم لها وذلك عن طريق استخدام الموقع.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">قد يرسل إليكم ديارنا العربية &quot;الموقع&quot; في أي وقت إشعارات بالتغييرات على الموقع الإلكتروني أو الشروط وفقا لتقديره الخاص.</span></span></span></span></li></ul>',
                'term_description_en' => '<p>- Diyarnaa Al Arabiya Company is a company headquartered in Morocco - Tangier, and it owns the website www.diyarnaa.com (a website on the World Wide Web), hereinafter referred to as the &quot;website&quot;, which provides real estate services in various Arab countries through advertisements, whether through owners. Accredited and licensed real estate or real estate offices spread across all Arab countries, or through site agents spread across the Arab countries, hereinafter collectively referred to as the &quot;Service&quot;.<br />- &ldquo;Fees&rdquo; means the amount payable to us by you pursuant to the Subscription Order.<br />- &ldquo;Membership&rdquo; means your eligibility to obtain services under the terms and conditions for the services provided to any member or group of services according to the membership package chosen in the subscription order.<br />- By accepting the use of this site, you agree to be bound by the terms of use of the website, collectively referred to hereinafter as the &quot;Terms&quot;, and you undertake to abide by them and any change or update that may occur to them from time to time. In the event that you object to any of these conditions, your only option is to stop immediately Site use.<br />- You also agree that you are responsible for violating any local or international laws.<br />- These terms and conditions between you and us will work upon your acceptance of them through the use of the site.<br />Diyaruna Al Arabiya &ldquo;the site&rdquo; may at any time send you notices of changes to the website or the terms and conditions at its sole discretion.</p>', 'status' => 1
            ],
            [
                'term_title_ar' => 'وصف الخدمة لمالك العقار',
                'term_title_en' => 'Description of the service for the property owner',
                'term_description_ar' => '<ul>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">الموقع عبارة عن بوابة للسوق العقاري العربي على مستوى 13 دولة عبر الإنترنت والذي يسمح لمستخدمي الموقع من ملاك العقارات والذين يلتزمون بالشروط بالقيام بعرض إعلاناتهم على الموقع الإلكتروني وفق الشروط ووفق باقة العضوية المختارة.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">يسمح الموقع لمالك العقار القيام بالإعلان عن عقاره بالدولة الموجود العقار فيها وذلك بعد اتباع التعليمات والتسجيل بالموقع والذي يقر ويوافق على أنه مسؤول مسئولية كاملة عن عقاره الوارد بالإعلان دون أدنى مسئولية على الموقع حيث أن الموقع لا يتحمل أية مسئولية تجاه أي طرف فيما يتعلق بالمعاملات الخاصة مع ملاك العقارات.</span></span></span></span></li></ul>',
                'term_description_en' => '<p>- The site is a gateway to the Arab real estate market at the level of 13 countries via the Internet, which allows users of the site who are real estate owners and who adhere to the conditions to display their advertisements on the website according to the conditions and according to the chosen membership package.<br />- The site allows the real estate owner to advertise his real estate in the country in which the real estate is located, after following the instructions and registering on the site, who acknowledges and agrees that he is fully responsible for his real estate contained in the advertisement without any responsibility on the site as the site bears no responsibility towards any party regarding private transactions with landlords.</p>', 'status' =>  1
            ],
            [
                'term_title_ar' => 'وصف الخدمة للمكتب العقاري',
                'term_title_en' => 'Description of the service for the real estate office',
                'term_description_ar' => '<ul>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">يسمح الموقع للمكاتب العقارية المرخصة والمعتمدة بكل دولة عربية طلب التسجيل بالموقع والقيام بعرض الإعلانات الخاصة بالعقارات ملك عملائهم وفق باقة العضوية المختارة وذلك تحت مسئوليتهم حيث أنهم يقروا ويوافقوا على إنهم مسئولون مسئولية كاملة عن كافة العقارات الواردة بالإعلانات المرسلة منهم إلى الموقع دون أدنى مسئولية على الموقع.</span></span></span></span></li></ul>',
                'term_description_en' => '<p>The site allows licensed and accredited real estate offices in every Arab country to request registration on the site and to display advertisements for real estate owned by their customers according to the chosen membership package, under their responsibility, as they acknowledge and agree that they are fully responsible for all real estate contained in the advertisements sent from them to the site without any responsibility on the site .</p>', 'status' => 1
            ],
            [
                'term_title_ar' => 'وصف الخدمة للباحث العقاري',
                'term_title_en' => 'Description of the service for the real estate researcher',
                'term_description_ar' => '<ul>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">يتيح الموقع للباحثين عن عقارات مميزة بكافة الدول العربية القيام بالتسجيل بالموقع واختيار باقة العضوية المناسبة له وتحديد طلبه ليقوم الموقع بالبحث عن طلباته وعرضها عليه للمفاضلة بينها واتخاذ القرار السليم.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">كما يحق لمالك العقار أو المكتب العقاري أو الباحث العقاري عند اتخاذ القرار بشراء عقار معين بإحدى الدول أن يطلب من الموقع خدمة الوساطة بينه وبين الطرف الآخر وبعد قيامه بإتباع التعليمات الخاصة بالموقع يبدأ الموقع في اتخاذ إجراءات الوساطة لإنهاء الصفقة عن طريق إحدى مكاتب المحامين المعتمدين بالدولة الموجود العقار فيها المطلوب الوساطة فيه والذي يعتبر وكيل للموقع بدولة العقار المبيع.</span></span></span></span></li></ul>',
                'term_description_en' => '<p>- The site allows those looking for distinguished real estate in all Arab countries to register on the site, choose the appropriate membership package for him, and specify his request so that the site searches for his requests and presents them to him in order to compare them and make the right decision.<br />- Also, the owner of the property, the real estate office, or the real estate researcher, when making the decision to buy a specific property in one of the countries, has the right to ask the site for a mediation service between him and the other party. The property in which mediation is required is located, and who is considered an agent for the site in the country of the sold property.</p>', 'status' =>  1
            ],
            [
                'term_title_ar' => 'سياسة المحتوى',
                'term_title_en' => 'Content policy',
                'term_description_ar' => '<ul>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">تقر وتوافق على أن الموقع غير مسئول عن الإعلانات الواردة بالموقع وأن المسئولية تقع على المعلن حيث أن الموقع لا يتحكم بتلك الإعلانات كما إنه لا يتحكم بأي وسيلة من وسائل الاتصالات الإلكترونية للمستخدمين سواء على سبيل المثال لا الحصر وسائل البريد الإلكتروني المرسلة من خارج نطاق الاتصالات الإلكترونية سواء من خلال الموقع الإلكتروني أو من خلال الطرف الآخر أو الملفات أو الصور المرسلة من الطرف الآخر.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">تقر وتوافق على حرية الموقع في إجراء فحص لمحتوى الإعلانات قبل عرضها وللموقع أن يسمح بعرض الإعلانات التي تتوافق مع الشروط.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">تقر وتوافق على أنك المسئول الوحيد مسئولية كاملة عن المحتوى الخاص بإعلانك الذي تم وضعه وإرساله للموقع عبر البريد الإلكتروني أو بأي طريقة أخرى دون أدنى مسئولية على الموقع والذي لا يتحمل مسئولية أي محتوى خاص بالإعلانات المرفوعة على الموقع.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">أنك تمنح كل مستخدم للموقع ترخيصا غير حصري للوصول إلى المحتوى الخاص بك عبر الموقع الإلكتروني ينتهي هذا الترخيص بمجرد قيامك أو قيام الموقع بإزالة أو حذف هذا المحتوى من الموقع الإلكتروني.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">الموقع غير مسئول عن أية نشاطات انتهاك حقوق الطبع والنشر وانتهاك حقوق الملكية الفكرية ويجوز للموقع وفق تقديرها الخاص إزالة أي محتوى يمثل انتهاكا لحقوق الملكية الفكرية إذا تم إخطارها وفقا لصحيح القانون ويجوز للموقع إزالة المحتوى المخالف دون إشعار مسبق كما يحق للموقع إنهاء دخول المستخدم إلى الموقع الإلكتروني إذا تكررت التعديات أو في حالة العثور على أي عمل يتعارض مع تلك الشروط، والمقصود بالتكرار قيام الموقع بإشعار المستخدم عبر البريد الإلكتروني مرتين فأكثر.</span></span></span></span></li></ul>',
                'term_description_en' => '<ul>	<li>- You acknowledge and agree that the site is not responsible for the advertisements contained on the site and that the responsibility rests with the advertiser, as the site does not control these advertisements, nor does it control any means of electronic communication for users, including, but not limited to, e-mails sent from outside the scope of electronic communications Whether through the website or through the third party, files or images sent by the other party.</li>	<li>- You acknowledge and agree that the site is free to conduct an examination of the content of ads before displaying them, and the site may allow the display of ads that comply with the conditions.</li>	<li>- You acknowledge and agree that you are solely and fully responsible for the content of your advertisement that was placed and sent to the site via e-mail or in any other way, without any responsibility on the site, which is not responsible for any content of the ads uploaded on the site.</li>	<li>- You grant each user of the Website a non-exclusive license to access your Content via the Website. This license terminates once you or the Website remove or delete such Content from the Website.</li>	<li>- The site is not responsible for any copyright infringement activities and infringement of intellectual property rights. The site may, at its own discretion, remove any content that violates intellectual property rights if it is notified in accordance with the valid law. The site may remove the infringing content without prior notice. The site also has the right to terminate the user&#39;s access to the site. If the infringement is repeated or if any action is found that contradicts these terms, the repetition means that the site will notify the user via e-mail twice or more.</li></ul>', 'status' =>  1
            ],
            [
                'term_title_ar' => 'إعلانات السلايدر',
                'term_title_en' => 'Slider ads',
                'term_description_ar' => '<ul>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">يتيح الموقع خدمة الإعلانات على رؤوس الصفحات (السلايدر) سواء على الصفحة الرئيسية للموقع وهذا متاح فقط للشركات العقارية الكبرى كما يتيح أيضا لباقي الشركات خدمة الإعلان على رؤوس الصفحات الداخلية للدول بالموقع (السلايدر) حسب باقة العضوية.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">تقر وتوافق على مسئوليتك الكاملة عن محتوى الإعلانات الخاصة بك والمراد رفعها سواء سلايدر رئيسي بالصفحة الرئيسية للموقع أو سلايدر داخلي على الصفحات الداخلية للدول.&nbsp;&nbsp;&nbsp; </span></span></span></span></li></ul>',
                'term_description_en' => '<ul>	<li>- The site provides advertisement service on the headers of the pages (sliders), whether on the main page of the site, and this is available only for major real estate companies.</li>	<li>- You acknowledge and agree that you are fully responsible for the content of your ads that are to be uploaded, whether the main slider on the main page of the site or the internal slider on the internal pages of the countries.</li></ul>', 'status' =>  1
            ],
            [
                'term_title_ar' => 'مسئولياتكم',
                'term_title_en' => 'Your responsibilities',
                'term_description_ar' => '<ul>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">نحن لسنا وكلاء عقاريين أو وسطاء عقاريين وإنما نحن نقوم بتقديم خدمة من خلالها يستطيع الباحث العادي الوصول إلى مراده في البحث العقاري بكافة الدول العربية كما يستطيع مالك العقار بعرض عقاره للبيع بطريقة احترافية يوفرها له الموقع كما يستطيع معها المكتب العقاري بتسويق نفسه وكذلك تسويق العقارات الخاصة بعملائه بمستوى احترافي.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">نحن لا نشترك في أي اتصال بينك وبين الطرف الآخر ولا نشارك في أي جزء من تلك الصفقة سوى عند قيام أحد طرفي الصفقة بطلب وساطة الموقع لإنهاء إجراءات الصفقة.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">أنتم تتحملون مسئولية تقديم الاستفسارات الخاصة بإعلاناتكم والمعلومات الخاصة بها ونحن لا نقدم أي ضمان ولا نتحمل أي مسئولية عن دقة تلك المعلومات الواردة بالإعلانات.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">تقرون بمسئوليتكم من أن جميع المواد المعلن عنها أو المعروضة في إطار استخدامك للخدمة لا تتضمن أي محتويات غير قانونية ولا تستخدم لأغراض غير لائقة.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">أنتم المسئولون عن التحقق من التفاصيل وتأكيدها وتتحملون مسئولية الاستعانة بمساحين أو الحصول على المشورة القانونية قبل الالتزام بأي عملية شراء وتتحملون مسئولية ضمان تصرفكم بحسن نية تجاه أي أطراف أخرى.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">أنتم مسئولون عن تحديث الإعلانات العقارية لتتوافق مع المبادئ التوجيهية لصورة الموقع ونحتفظ بحقنا في منع أي محتوي غير مناسب.</span></span></span></span></li></ul><p dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; تقرون وتؤكدون أن استخدامكم لموقعنا على الإنترنت سيكون طبقا لشروط الاستخدام هذه بما في ذلك جميع التعديلات والتقيحات على هذه الشروط.</span></span></span></p><p dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; تقرون وتؤكدون على الامتثال بجميع القوانين المعمول بها عند استخدامكم لخدماتنا.</span></span></span></p>',
                'term_description_en' => '<ul>	<li>- We are not real estate agents or real estate brokers. Rather, we provide a service through which the ordinary researcher can reach his goal in real estate research in all Arab countries. The real estate owner can also offer his real estate for sale in a professional manner provided by the site. The real estate office can also market itself as well as private real estate. clients in a professional manner.</li>	<li>- We do not participate in any communication between you and the other party, and we do not participate in any part of that transaction except when one of the parties to the transaction requests the mediation of the site to terminate the transaction procedures.</li>	<li>- You bear the responsibility for submitting inquiries about your advertisements and information related to them, and we do not provide any guarantee and bear no responsibility for the accuracy of that information contained in the advertisements.</li>	<li>- You acknowledge your responsibility that all materials advertised or displayed in the context of your use of the service do not include any illegal content and are not used for improper purposes.</li>	<li>- You are responsible for verifying and confirming details and it is your responsibility to use surveyors or obtain legal advice before committing to any purchase and you are responsible for ensuring that you act in good faith towards any third parties.</li>	<li>- You are responsible for updating real estate ads to comply with the site image guidelines and we reserve the right to block any inappropriate content.</li>	<li>- You acknowledge and confirm that your use of our website will be in accordance with these terms of use, including all amendments and revisions to these terms.</li>	<li>You acknowledge and confirm that you will comply with all applicable laws when using our Services.</li></ul>', 'status' =>  1
            ],
            [
                'term_title_ar' => 'تعديلات الشروط',
                'term_title_en' => 'Terms modifications',
                'term_description_ar' => '<ul>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">تقرون باستخدامكم لهذا الموقع بانه يجوز لنا مراجعة وتعديل &quot; شروط الاستخدام &quot; هذه وأي شروط للموقع في أي وقت دون إشعار.</span></span></span></span></li></ul>',
                'term_description_en' => '<p>By using this website, you acknowledge that we may revise and amend these &ldquo;Terms of Use&rdquo; and any terms of the website at any time without notice.</p>', 'status' =>  1
            ],
            [
                'term_title_ar' => 'الملكية الفكرية',
                'term_title_en' => 'intellectual property',
                'term_description_ar' => '<ul>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">مالم يذكر خلاف ذلك صراحة فإن جميع محتويات هذا الموقع تحمل حقوق التأليف والنشر والعلامات التجارية والمظهر التجاري و/أو الملكية الفكرية الأخرى التي نمتلكها أو الخاضعة للرقابة أو المرخصة من قبلنا أو بواسطة أطراف ثالثة قامت بترخيص موادها لنا وهي محمية بموجب القوانين المعمول بها.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">نحتفظ نحن والموردون المرخصون لنا بجميع حقوق الملكية الفكرية في كافة النصوص والبرامج والمحتوى وغيرها من المواد التي تظهر على هذا الموقع.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">يحظر أي استخدام لهذا الموقع أو محتوياته بما في ذلك النسخ أو التخزين كليا او جزئيا خلاف استخدامك الشخصي وغير التجاري دون إذن منا ولا يجوز لكم تعديل أو توزيع أو إعادة نشر أي شيء على هذا الموقع لأي غرض من الأغراض.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">إن الأسماء والشعارات وجميع ما يتصل بها من منتجات وأسماء الخدمات وتصميم العلامات والشعارات هي علامات تجارية أو علامات خدمة لنا أو للمرخصين لنا ولا يجوز منح أي ترخيص للعلامة التجارية أو علامة الخدمة فيما يتعلق بالمواد الواردة في هذا الموقع.</span></span></span></span></li>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">الوصول لهذا الموقع لا يخول لأي شخص استخدام أي اسم أو شعار أو علامة في أي صورة من الصور.</span></span></span></span></li></ul>',
                'term_description_en' => '<ul>	<li>Unless expressly stated otherwise, all contents of this website bear copyrights, trademarks, trade dress and/or other intellectual property that are owned by us or are controlled or licensed by us or by third parties who have licensed their materials to us and are protected by applicable laws.</li>	<li>We and our licensors reserve all intellectual property rights in all text, software, content and other materials that appear on this site.</li>	<li>- Any use of this site or its contents, including copying or storing in whole or in part, other than for your personal and non-commercial use, is prohibited without our permission, and you may not modify, distribute or republish anything on this site for any purpose.</li>	<li>The names, logos and all related product and service names, mark design and slogans are trademarks or service marks of us or our licensors and no license to the trademark or service mark may be granted in connection with the materials on this site.</li>	<li>Access to this site does not authorize anyone to use any name, logo or mark in any of the images.</li></ul>', 'status' =>  1
            ],
            [
                'term_title_ar' => 'سياسة منع البريد المؤذي Spam',
                'term_title_en' => 'Spam prevention policy',
                'term_description_ar' => '<ul>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">إنك تدرك وتوافق على أن إرسال بريد إلكتروني غير مرغوب فيه للإعلانات أو اتصالات أخرى غير مرغوب فيها إلى عناوين البريد يكون ممنوع صراحة بموجب هذه الشروط.</span></span></span></span></li></ul>',
                'term_description_en' => '<ul>	<li>You understand and agree that sending unsolicited email advertisements or other unsolicited communications to mailing addresses is expressly prohibited by these Terms.</li></ul>', 'status' =>  1
            ],
            [
                'term_title_ar' => 'التنازل عن الضمانات',
                'term_title_en' => 'Disclaimer of warranties',
                'term_description_ar' => '<ul>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">تقر وتوافق صراحة على أن استخدام الموقع والخدمة بشكل كامل يكون على مسئوليتك الخاصة وأن الموقع الإلكتروني والخدمة مقدمة على أساس &quot;كما هي&quot; أو &quot;حسب التوفر&quot; دون أية ضمانات من أي نوع كانت بما في ذلك على سبيل المثال لا الحصر عدم الإخلال بحقوق الملكية يتم التنازل عنه صراحة وفقا لأقصى حد يحدده القانون.</span></span></span></span></li></ul>',
                'term_description_en' => '<ul>	<li>- You expressly acknowledge and agree that the use of the Website and the Service is entirely at your own risk and that the Website and the Service are provided on an &ldquo;as is&rdquo; or &ldquo;as available&rdquo; basis without any warranties of any kind whatsoever including but not limited to non-infringement of proprietary rights It is expressly waived to the fullest extent specified by law.</li></ul>', 'status' =>  1
            ],
            [
                'term_title_ar' => 'حد المسئولية',
                'term_title_en' => 'limit of liability',
                'term_description_ar' => '<ul>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">لا يجوز بأي حال من الأحوال للموقع أو مسؤوليه أو مدراءه أو موظفيه أو وكلائه أن يكون مسئول عن أية أضرار سواء بشكل مباشر أو غير مباشر أو بشكل عرضي أو خاص أو تبعي ناتجة بأي شكل من الأشكال عن استخدامك للموقع الإلكتروني أو الخدمة بما في ذلك على سبيل المثال لا الحصر الأضرار الناتجة عن استخدام أو إساءة استخدام الموقع أو الخدمة أو عدم القدرة على استخدام الموقع أو الخدمة.</span></span></span></span></li></ul>',
                'term_description_en' => '<ul>	<li>- In no way shall the site or its officers, directors, employees or agents be liable for any damages, whether direct, indirect, incidental, special or consequential, arising in any way from your use of the website or the service, including on including but not limited to damages resulting from the use or misuse of the Website or the Service or the inability to use the Website or the Service.</li></ul>', 'status' =>  1
            ],
            [
                'term_title_ar' => 'انتهاك الشروط والتعويض',
                'term_title_en' => 'Violation of terms and compensation',
                'term_description_ar' => '<ul>	<li dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"color:black\">يحتفظ الموقع بالحق في طلب التعويضات القانونية المنصفة عن أية انتهاكات للشروط بما في ذلك على سبيل المثال لا الحصر الأداء المحدد لأي شرط وارد في هذه الشروط أو أمر قضائي أولى أو دائم ضد خرق أو تهديد خرق أي شرط أو المساعدة في ممارسة أية سلطة ممنوحة ضمن هذه الشروط.&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span></span></li></ul>',
                'term_description_en' => '<ul>	<li>The Site reserves the right to seek equitable legal remedies for any breaches of the Terms, including without limitation the specific performance of any provision of these Terms, a preliminary or permanent injunction against the breach or threatened breach of any provision, or assistance in the exercise of any power granted within these terms.</li></ul>', 'status' =>  1
            ],



        ];


        foreach ($term_conditions as $term_condition) {
            TermCondition::create($term_condition);
        }








        //===========================================================================================
        //====================================Contact Us=============================================
        //===========================================================================================
        ContactUs::create([
            'phone' => '+962 787878787',
            'phone_two' => '+962 787878787',
            'email' => 'info@diyarna.com',
            'url_map' => 'https://goo.gl/maps/iDcxrTTfS6yxju6s8',
            'facebook' => 'https://www.facebook.com/diyarnaar',
            'twitter' => 'https://twitter.com/diyarnaar',
            'instagram' => 'https://www.instagram.com/diyarnaar',
            'linkedin' => 'https://www.linkedin.com/diyarnaar',
            'messanger' => 'https://www.messanger.com',
            'youtube' => ' https://www.youtube.com/channel/UCSaoC5OYn_ufaydEC8eOScQ',
            'background_image' => 'style_files/frontend/img/inner1.png',

        ]);
        // ======================================================================
        // =========================Target  Section =========================
        // =====================================================================
        Target::create([
            'name_en' => 'Sale',
            'name_ar' => 'بيع',
            'status' => 1,

        ]);
        Target::create([
            'name_en' => 'Buy',
            'name_ar' => 'شراء',
            'status' => 1,

        ]);
        Target::create([
            'name_en' => 'Rent',
            'name_ar' => 'ايجار',
            'status' => 1,

        ]);



        //====================================================================================================
        //==============================Premium membership page================================================
        //====================================================================================================
        PremiumMembershipPage::create([
            'description_ar' => 'تمتع بالعديد من المميزات والخصائص الرائعة التي تمنحك العضوية المميزة',
            'description_en' => 'Enjoy many of the great features and characteristics that the premium membership gives you',
            'image' => 'style_files/frontend/img/inner1.png',
        ]);
        // ======================================================================
        // ========================= Diyarnaa Country Section =========================
        // ======================================================================
        $diyarnaa_countries = [
            ["id" => '1', "country_key" => 'KW',  "country_code" => '+965',   "public_country_id" => '121', "name_en" => 'Kuwait',                   "name_ar" => ' الكويت', "flag" => 'storage/diyarnaa_countries/flags/Kuwait.png', "image" => 'storage/diyarnaa_countries/images/Kuwait.jpg', "public_currency_id" => '77', "status" => '1', "deleted_at" => NULL],
            ["id" => '2', "country_key" => 'BH',  "country_code" => '+973',   "public_country_id" => '23',  "name_en" => 'Bahrain',                  "name_ar" => ' البحرين', "flag" => 'storage/diyarnaa_countries/flags/Bahrain.png', "image" => 'storage/diyarnaa_countries/images/Bahrain.jfif', "public_currency_id" => '11', "status" => '1', "deleted_at" => NULL],
            ["id" => '3', "country_key" => 'EG',  "country_code" => '+20',   "public_country_id" => '64',  "name_en" => 'Egypt',                    "name_ar" => ' مصر', "flag" => 'storage/diyarnaa_countries/flags/Egypt.png', "image" => 'storage/diyarnaa_countries/images/Egypt.jfif', "public_currency_id" => '46', "status" => '1', "deleted_at" => NULL],
            ["id" => '4', "country_key" => 'JO',  "country_code" => '+962',   "public_country_id" => '111', "name_en" => 'Jordan',                   "name_ar" => ' الأردن', "flag" => 'storage/diyarnaa_countries/flags/Jordan.png', "image" => 'storage/diyarnaa_countries/images/Jordan.jfif', "public_currency_id" => '74', "status" => '1', "deleted_at" => NULL],
            ["id" => '5', "country_key" => 'LB',  "country_code" => '+961',   "public_country_id" => '125', "name_en" => 'Lebanon',                  "name_ar" => ' لبنان', "flag" => 'storage/diyarnaa_countries/flags/Lebanon.png', "image" => 'storage/diyarnaa_countries/images/Lebanon.jfif', "public_currency_id" => '81', "status" => '1', "deleted_at" => NULL],
            ["id" => '6', "country_key" => 'MA',  "country_code" => '+212',   "public_country_id" => '135', "name_en" => 'Morocco',                  "name_ar" => ' المغرب', "flag" => 'storage/diyarnaa_countries/flags/Morocco.png', "image" => 'storage/diyarnaa_countries/images/Morocco.jfif', "public_currency_id" => '97', "status" => '1', "deleted_at" => NULL],
            ["id" => '7', "country_key" => 'QA',  "country_code" => '+974',  "public_country_id" => '185', "name_en" => 'Qatar',                    "name_ar" => ' قطر', "flag" => 'storage/diyarnaa_countries/flags/Qatar.png', "image" => 'storage/diyarnaa_countries/images/Qatar.jfif', "public_currency_id" => '117', "status" => '1', "deleted_at" => NULL],
            ["id" => '8', "country_key" => 'SA',  "country_code" => '+966',  "public_country_id" => '191', "name_en" => 'Saudi Arabia',             "name_ar" => '  السعودية', "flag" => 'storage/diyarnaa_countries/flags/Saudi.png', "image" => 'storage/diyarnaa_countries/images/Saudi.jfif', "public_currency_id" => '123', "status" => '1', "deleted_at" => NULL],
            ["id" => '9', "country_key" => 'SY',  "country_code" => '+963',  "public_country_id" => '210', "name_en" => 'Syria', "name_ar" => ' سوريا', "flag" => 'storage/diyarnaa_countries/flags/Syria.png', "image" => 'storage/diyarnaa_countries/images/Syria.jfif', "public_currency_id" => '141', "status" => '1', "deleted_at" => NULL],
            ["id" => '10', "country_key" => 'AE', "country_code" => '+971',   "public_country_id" => '2',   "name_en" => 'Emirates', "name_ar" => 'الإمارات  ', "flag" => 'storage/diyarnaa_countries/flags/Emirates.png', "image" => 'storage/diyarnaa_countries/images/Emirates.jfif', "public_currency_id" => '153', "status" => '1', "deleted_at" => NULL],
            ["id" => '11', "country_key" => 'TR', "country_code" => '+90',   "public_country_id" => '223', "name_en" => 'Turkey',               "name_ar" =>   ' تركيا', "flag" => 'storage/diyarnaa_countries/flags/Turkey.png', "image" => 'storage/diyarnaa_countries/images/Turkey.jfif', "public_currency_id" => '149', "status" => '1', "deleted_at" => NULL],
        ];
        foreach ($diyarnaa_countries as $diyarnaa_country) {
            DiyarnaaCountry::create($diyarnaa_country);
        }

        // ======================================================================
        // ========================= Diyarnaa City Section =========================
        // =====================================================================
        $diyarnaa_cities = [
            ["id" => '1', "diyarnaa_country_id" => 1, "name_en" => 'Al \'Asimah', "name_ar" => 'محافظة العاصمة', "status" => '1'],
            ["id" => '2',   "diyarnaa_country_id" => '1', "name_en" => 'Al Ahmadi',  "name_ar" => 'محافظة الأحمدي', "status" => '1'],
            ["id" => '3',   "diyarnaa_country_id" => '1', "name_en" => 'Al Farwaniyah',  "name_ar" => 'الفروانية', "status" => '1'],
            ["id" => '4',   "diyarnaa_country_id" => '1', "name_en" => 'Al Jahra\'',  "name_ar" => 'الجهراء', "status" => '1'],
            ["id" => '5',   "diyarnaa_country_id" => '1', "name_en" => 'Hawalli',  "name_ar" => 'محافظة حولي', "status" => '1'],
            ["id" => '6',   "diyarnaa_country_id" => '1', "name_en" => 'Mubarak al Kabir',  "name_ar" => 'مبارك الكبير', "status" => '1'],
            ["id" => '7',   "diyarnaa_country_id" => '2', "name_en" => 'Manama',  "name_ar" => 'المنامة', "status" => '1'],
            ["id" => '8',   "diyarnaa_country_id" => '2', "name_en" => 'Al Janubiyah', "name_ar" =>  'المحافظة الجنوبية', "status" => '1'],
            ["id" => '9',   "diyarnaa_country_id" => '2', "name_en" => 'Al Muharraq', "name_ar" =>  'المحرّق', "status" => '1'],
            ["id" => '10',  "diyarnaa_country_id" => '2', "name_en" => 'Ash Shamaliyah',  "name_ar" => 'المحافظة الشمالية', "status" => '1'],
            ["id" => '11',  "diyarnaa_country_id" => '3', "name_en" => 'Ad Daqahliyah', "name_ar" =>  'محافظة الدقهلية', "status" => '1'],
            ["id" => '12',  "diyarnaa_country_id" => '3', "name_en" => 'Al Bahr al Ahmar',  "name_ar" => 'محافظة البحر الأحمر', "status" => '1'],
            ["id" => '13',  "diyarnaa_country_id" => '3', "name_en" => 'Al Buhayrah',  "name_ar" => 'محافظة البحيرة', "status" => '1'],
            ["id" => '14',  "diyarnaa_country_id" => '3', "name_en" => 'Al Fayyum',  "name_ar" => 'الفيوم', "status" => '1'],
            ["id" => '15',  "diyarnaa_country_id" => '3', "name_en" => 'Al Gharbiyah',     "name_ar" =>  'محافظة الغربية', "status" => '1'],
            ["id" => '16',  "diyarnaa_country_id" => '3', "name_en" => 'Al Iskandariyah',  "name_ar" =>   'محافظة الإسكندرية', "status" => '1'],
            ["id" => '17',  "diyarnaa_country_id" => '3', "name_en" => 'Al Isma\'iliyah',  "name_ar" => 'محافظة الإسماعيلية', "status" => '1'],
            ["id" => '18',  "diyarnaa_country_id" => '3', "name_en" => 'Al Jizah',        "name_ar" =>    'محافظة الجيزة', "status" => '1'],
            ["id" => '19',  "diyarnaa_country_id" => '3', "name_en" => 'Al Minufiyah',   "name_ar" =>   'محافظة المنوفية', "status" => '1'],
            ["id" => '20',  "diyarnaa_country_id" => '3', "name_en" => 'Al Minya',      "name_ar" =>   'محافظة المنيا', "status" => '1'],
            ["id" => '21',  "diyarnaa_country_id" => '3', "name_en" => 'Al Qahirah',   "name_ar" =>   'مديرية القاهرة', "status" => '1'],
            ["id" => '22',  "diyarnaa_country_id" => '3', "name_en" => 'Al Qalyubiyah',  "name_ar" =>   'محافظة القليوبية', "status" => '1'],
            ["id" => '23',  "diyarnaa_country_id" => '3', "name_en" => 'Al Uqsur',       "name_ar" =>  'محافظة الأقصر', "status" => '1'],
            ["id" => '24',  "diyarnaa_country_id" => '3', "name_en" => 'Al Wadi al Jadid', "name_ar" =>  'محافظة الوادي الجديد', "status" => '1'],
            ["id" => '25',  "diyarnaa_country_id" => '3', "name_en" => 'As Suways',  "name_ar" => 'محافظة السويس', "status" => '1'],
            ["id" => '26',  "diyarnaa_country_id" => '3', "name_en" => 'Ash Sharqiyah', "name_ar" =>  'المنطقة الشرقية', "status" => '1'],
            ["id" => '27',  "diyarnaa_country_id" => '3', "name_en" => 'Aswan',  "name_ar" => 'مدينة أسوان', "status" => '1'],
            ["id" => '28',  "diyarnaa_country_id" => '3', "name_en" => 'Asyut', "name_ar" =>  'أسيوط', "status" => '1'],
            ["id" => '29',  "diyarnaa_country_id" => '3', "name_en" => 'Bani Suwayf', "name_ar" =>  'بني سويف', "status" => '1'],
            ["id" => '30',  "diyarnaa_country_id" => '3', "name_en" => 'Bur Sa\'id',  "name_ar" => 'بورسعيد', "status" => '1'],
            ["id" => '31',  "diyarnaa_country_id" => '3', "name_en" => 'Dumyat',  "name_ar" => 'محافظة دمياط', "status" => '1'],
            ["id" => '32',  "diyarnaa_country_id" => '3', "name_en" => 'Janub Sina\'',  "name_ar" => 'محافظة جنوب سيناء', "status" => '1'],
            ["id" => '33',  "diyarnaa_country_id" => '3', "name_en" => 'Kafr ash Shaykh', "name_ar" =>  'كفر الشيخ', "status" => '1'],
            ["id" => '34',  "diyarnaa_country_id" => '3', "name_en" => 'Matruh',  "name_ar" => 'محافظة مطروح', "status" => '1'],
            ["id" => '35',  "diyarnaa_country_id" => '3', "name_en" => 'Qina',  "name_ar" => 'قنا', "status" => '1'],
            ["id" => '36',  "diyarnaa_country_id" => '3', "name_en" => 'Shamal Sina\'',  "name_ar" => 'محافظة شمال سيناء', "status" => '1'],
            ["id" => '37',  "diyarnaa_country_id" => '3', "name_en" => 'Suhaj',  "name_ar" => 'سوهاج', "status" => '1'],
            ["id" => '38',  "diyarnaa_country_id" => '4', "name_en" => 'Ajlun',  "name_ar" => 'محافظة عجلون', "status" => '1'],
            ["id" => '39',  "diyarnaa_country_id" => '4', "name_en" => 'Al \'Aqabah', "name_ar" => 'محافظة العقبة ', "status" => '1'],
            ["id" => '40',  "diyarnaa_country_id" => '4', "name_en" => 'Amman',  "name_ar" => 'محافظة عمان ', "status" => '1'],
            ["id" => '41',  "diyarnaa_country_id" => '4', "name_en" => 'Al Balqa\'', "name_ar" =>  'محافظة البلقاء', "status" => '1'],
            ["id" => '42',  "diyarnaa_country_id" => '4', "name_en" => 'Al Karak',  "name_ar" => 'محافظة الكرك', "status" => '1'],
            ["id" => '43',  "diyarnaa_country_id" => '4', "name_en" => 'Al Mafraq',  "name_ar" => 'محافظة المفرق', "status" => '1'],
            ["id" => '44',  "diyarnaa_country_id" => '4', "name_en" => 'At Tafilah', "name_ar" =>  'محافظة الطفيلة', "status" => '1'],
            ["id" => '45',  "diyarnaa_country_id" => '4', "name_en" => 'Az Zarqa\'', "name_ar" =>  'محافظة الزرقاء', "status" => '1'],
            ["id" => '46',  "diyarnaa_country_id" => '4', "name_en" => 'Irbid', "name_ar" =>  'محافظة إربد', "status" => '1'],
            ["id" => '47',  "diyarnaa_country_id" => '4', "name_en" => 'Jarash',  "name_ar" => 'محافظة جرش', "status" => '1'],
            ["id" => '48',  "diyarnaa_country_id" => '4', "name_en" => 'Ma\'an',  "name_ar" => 'محافظة معان', "status" => '1'],
            ["id" => '49',  "diyarnaa_country_id" => '4', "name_en" => 'Madaba', "name_ar" =>  'محافظة مادبا', "status" => '1'],
            ["id" => '50',  "diyarnaa_country_id" => '5', "name_en" => 'Aakkar', "name_ar" =>  'قضاء عكار', "status" => '1'],
            ["id" => '51',  "diyarnaa_country_id" => '5', "name_en" => 'Baalbek-Hermel',  "name_ar" => 'محافظة بعلبك الهرمل', "status" => '1'],
            ["id" => '52',  "diyarnaa_country_id" => '5', "name_en" => 'Beqaa', "name_ar" =>  'البقاع', "status" => '1'],
            ["id" => '53',  "diyarnaa_country_id" => '5', "name_en" => 'Beyrouth',  "name_ar" => 'بيروت', "status" => '1'],
            ["id" => '54',  "diyarnaa_country_id" => '5', "name_en" => 'Liban-Nord', "name_ar" =>  'محافظة الشمال', "status" => '1'],
            ["id" => '55',  "diyarnaa_country_id" => '5', "name_en" => 'Liban-Sud', "name_ar" =>  'محافظة الجنوب', "status" => '1'],
            ["id" => '56',  "diyarnaa_country_id" => '5', "name_en" => 'Mont-Liban',  "name_ar" => 'جبل لبنان', "status" => '1'],
            ["id" => '57',  "diyarnaa_country_id" => '5', "name_en" => 'Nabatiye', "name_ar" =>  'النبطية', "status" => '1'],
            ["id" => '58',  "diyarnaa_country_id" => '6', "name_en" => 'Casablanca',  "name_ar" => 'الدار البيضاء', "status" => '1'],
            ["id" => '103', "diyarnaa_country_id" => '6', "name_en" => 'Marrakesh', "name_ar" =>  'مراكش', "status" => '1'],
            ["id" => '104', "diyarnaa_country_id" => '6', "name_en" => 'Tangier',  "name_ar" => 'طنجة', "status" => '1'],
            ["id" => '105', "diyarnaa_country_id" => '6', "name_en" => 'Rabat',  "name_ar" => 'الرباط', "status" => '1'],
            ["id" => '106', "diyarnaa_country_id" => '6', "name_en" => 'Agadir', "name_ar" =>  'اكادیر', "status" => '1'],
            ["id" => '107', "diyarnaa_country_id" => '6', "name_en" => 'fez', "name_ar" =>  'فاس', "status" => '1'],
            ["id" => '108', "diyarnaa_country_id" => '6', "name_en" => 'Meknes', "name_ar" =>  'مكناس', "status" => '1'],
            ["id" => '109', "diyarnaa_country_id" => '6', "name_en" => 'Quneitra', "name_ar" =>  'القنیطرة', "status" => '1'],
            ["id" => '110', "diyarnaa_country_id" => '6', "name_en" => 'Oujda',  "name_ar" => 'وجدة', "status" => '1'],
            ["id" => '111', "diyarnaa_country_id" => '6', "name_en" => 'Temara',  "name_ar" => 'تمارة', "status" => '1'],
            ["id" => '112', "diyarnaa_country_id" => '6', "name_en" => 'Dar Bouazza', "name_ar" =>  'دار بوعزة', "status" => '1'],
            ["id" => '113', "diyarnaa_country_id" => '6', "name_en" => 'Nador',  "name_ar" => 'الناظور', "status" => '1'],
            ["id" => '114', "diyarnaa_country_id" => '6', "name_en" => 'Bouznika', "name_ar" =>  'بوزنیقة', "status" => '1'],
            ["id" => '115', "diyarnaa_country_id" => '7', "name_en" => 'Ad Dawhah',  "name_ar" => 'الدوحة', "status" => '1'],
            ["id" => '116', "diyarnaa_country_id" => '7', "name_en" => 'Al Khawr ',  "name_ar" => 'الخور ', "status" => '1'],
            ["id" => '117', "diyarnaa_country_id" => '7', "name_en" => 'Al Wakrah',  "name_ar" => 'الوكرة', "status" => '1'],
            ["id" => '118', "diyarnaa_country_id" => '7', "name_en" => 'Ar Rayyan', "name_ar" =>  'الريان', "status" => '1'],
            ["id" => '119', "diyarnaa_country_id" => '7', "name_en" => 'Ash Shamal',  "name_ar" => 'الشمال', "status" => '1'],
            ["id" => '121', "diyarnaa_country_id" => '7', "name_en" => 'Umm Salal', "name_ar" =>  'أم صلال', "status" => '1'],
            ["id" => '122', "diyarnaa_country_id" => '8', "name_en" => '\'Asir',  "name_ar" => 'منطقة عسير', "status" => '1'],
            ["id" => '123', "diyarnaa_country_id" => '8', "name_en" => 'Al Bahah',  "name_ar" => 'الباحة', "status" => '1'],
            ["id" => '124', "diyarnaa_country_id" => '8', "name_en" => 'Al Hudud ash Shamaliyah',  "name_ar" => 'الحدود الشمالي', "status" => '1'],
            ["id" => '125', "diyarnaa_country_id" => '8', "name_en" => 'Al Jawf',  "name_ar" => 'الجوف', "status" => '1'],
            ["id" => '126', "diyarnaa_country_id" => '8', "name_en" => 'Al Madinah al Munawwarah',  "name_ar" => 'المدينة المنو', "status" => '1'],
            ["id" => '127', "diyarnaa_country_id" => '8', "name_en" => 'Al Qasim',  "name_ar" => 'القصيم', "status" => '1'],
            ["id" => '128', "diyarnaa_country_id" => '8', "name_en" => 'Ar Riyad', "name_ar" =>  'الرياض', "status" => '1'],
            ["id" => '129', "diyarnaa_country_id" => '8', "name_en" => 'Ash Sharqiyah', "name_ar" =>  'الشرقية', "status" => '1'],
            ["id" => '130', "diyarnaa_country_id" => '8', "name_en" => 'Ha\'il',  "name_ar" => 'حائل', "status" => '1'],
            ["id" => '131', "diyarnaa_country_id" => '8', "name_en" => 'Jazan', "name_ar" =>  'جازان', "status" => '1'],
            ["id" => '132', "diyarnaa_country_id" => '8', "name_en" => 'Makkah al Mukarramah',  "name_ar" => 'مكة المكرمة', "status" => '1'],
            ["id" => '133', "diyarnaa_country_id" => '8', "name_en" => 'Najran',  "name_ar" => 'نجران', "status" => '1'],
            ["id" => '134', "diyarnaa_country_id" => '8', "name_en" => 'Tabuk',  "name_ar" => 'تبوك', "status" => '1'],
            ["id" => '135', "diyarnaa_country_id" => '9', "name_en" => 'Al Hasakah',  "name_ar" => 'الحسكة', "status" => '1'],
            ["id" => '136', "diyarnaa_country_id" => '9', "name_en" => 'Al Ladhiqiyah',  "name_ar" => 'محافظة اللاذقية', "status" => '1'],
            ["id" => '137', "diyarnaa_country_id" => '9', "name_en" => 'Al Qunaytirah',  "name_ar" => 'محافظة القنيطرة', "status" => '1'],
            ["id" => '138', "diyarnaa_country_id" => '9', "name_en" => 'Ar Raqqah',  "name_ar" => 'الرقة', "status" => '1'],
            ["id" => '139', "diyarnaa_country_id" => '9', "name_en" => 'As Suwayda\'',  "name_ar" => 'السويداء', "status" => '1'],
            ["id" => '140', "diyarnaa_country_id" => '9', "name_en" => 'Dar\'a',  "name_ar" => 'محافظة درعا', "status" => '1'],
            ["id" => '141', "diyarnaa_country_id" => '9', "name_en" => 'Dayr az Zawr', "name_ar" =>  'دير الزور', "status" => '1'],
            ["id" => '142', "diyarnaa_country_id" => '9', "name_en" => 'Dimashq',  "name_ar" => 'دمشق', "status" => '1'],
            ["id" => '143', "diyarnaa_country_id" => '9', "name_en" => 'Halab', "name_ar" =>  'حلب', "status" => '1'],
            ["id" => '144', "diyarnaa_country_id" => '9', "name_en" => 'Hamah', "name_ar" =>  'مدينة حماة', "status" => '1'],
            ["id" => '145', "diyarnaa_country_id" => '9', "name_en" => 'Hims',  "name_ar" => 'منطقة حمص', "status" => '1'],
            ["id" => '146', "diyarnaa_country_id" => '9', "name_en" => 'Idlib',  "name_ar" => 'مدينة ادلب', "status" => '1'],
            ["id" => '147', "diyarnaa_country_id" => '9', "name_en" => 'Rif Dimashq', "name_ar" =>  'ريف دمشق', "status" => '1'],
            ["id" => '148', "diyarnaa_country_id" => '9', "name_en" => 'Tartus', "name_ar" =>  'طرطوس', "status" => '1'],
            ["id" => '149', "diyarnaa_country_id" => '10', "name_en" => 'Ajman City',  "name_ar" => 'عجمان', "status" => '1'],
            ["id" => '150', "diyarnaa_country_id" => '10', "name_en" => 'Abu Zaby', "name_ar" =>  'أبوظبي', "status" => '1'],
            ["id" => '151', "diyarnaa_country_id" => '10', "name_en" => 'Al Fujayrah',  "name_ar" => 'الفجيرة', "status" => '1'],
            ["id" => '152', "diyarnaa_country_id" => '10', "name_en" => 'Ash Shariqah', "name_ar" =>  'الشَّارِقة', "status" => '1'],
            ["id" => '153', "diyarnaa_country_id" => '10', "name_en" => 'Dubayy',  "name_ar" => 'دبي', "status" => '1'],
            ["id" => '154', "diyarnaa_country_id" => '10', "name_en" => 'Ra\'s al Khaymah', "name_ar" =>  'رأس الخيمة', "status" => '1'],
            ["id" => '155', "diyarnaa_country_id" => '10', "name_en" => 'Umm al Qaywayn', "name_ar" =>  'أم القيوين', "status" => '1'],
            ["id" => '156', "diyarnaa_country_id" => '11', "name_en" => 'Adana',  "name_ar" => 'أضنة', "status" => '1'],
            ["id" => '237', "diyarnaa_country_id" => '11', "name_en" => 'Adiyaman',  "name_ar" => 'أدیامان', "status" => '1'],
            ["id" => '238', "diyarnaa_country_id" => '11', "name_en" => 'opium',  "name_ar" => 'أفیون', "status" => '1'],
            ["id" => '239', "diyarnaa_country_id" => '11', "name_en" => 'Ağrı Province',  "name_ar" => 'آغري', "status" => '1'],
            ["id" => '240', "diyarnaa_country_id" => '11', "name_en" => 'Amasya Province',  "name_ar" => 'أماسيا', "status" => '1'],
            ["id" => '241', "diyarnaa_country_id" => '11', "name_en" => 'Ankara Province',  "name_ar" => 'أنقرة', "status" => '1'],
            ["id" => '242', "diyarnaa_country_id" => '11', "name_en" => 'Antalya Province', "name_ar" =>  'أنطاليا', "status" => '1'],
            ["id" => '243', "diyarnaa_country_id" => '11', "name_en" => 'Artwin County',  "name_ar" => 'أرتوین', "status" => '1'],
            ["id" => '244', "diyarnaa_country_id" => '11', "name_en" => 'Aytan Province', "name_ar" =>  'أیطن', "status" => '1'],
            ["id" => '245', "diyarnaa_country_id" => '11', "name_en" => 'Balaq Asir Governorate', "name_ar" =>  'بالق أسير', "status" => '1'],
            ["id" => '246', "diyarnaa_country_id" => '11', "name_en" => 'Bilecak Province',  "name_ar" => 'بيله جك', "status" => '1'],
            ["id" => '247', "diyarnaa_country_id" => '11', "name_en" => 'Bincol County',  "name_ar" => 'بینكُل', "status" => '1'],
            ["id" => '248', "diyarnaa_country_id" => '11', "name_en" => 'Bitlis Province', "name_ar" =>  'بیطلیس', "status" => '1'],
            ["id" => '249', "diyarnaa_country_id" => '11', "name_en" => 'Bolu ',  "name_ar" => 'بولو', "status" => '1'],
            ["id" => '250', "diyarnaa_country_id" => '11', "name_en" => 'Burdur',  "name_ar" => 'بوردور', "status" => '1'],
            ["id" => '251', "diyarnaa_country_id" => '11', "name_en" => 'Bursa ', "name_ar" =>  'بورصة', "status" => '1'],
            ["id" => '252', "diyarnaa_country_id" => '11', "name_en" => 'Çanakkale ', "name_ar" =>  'جاناكالي', "status" => '1'],
            ["id" => '253', "diyarnaa_country_id" => '11', "name_en" => 'Cankri',  "name_ar" => 'جانقري', "status" => '1'],
            ["id" => '254', "diyarnaa_country_id" => '11', "name_en" => 'Gorum ',  "name_ar" => 'جوروم', "status" => '1'],
            ["id" => '255', "diyarnaa_country_id" => '11', "name_en" => 'Denizli ',  "name_ar" => 'دنیزلي', "status" => '1'],
            ["id" => '256', "diyarnaa_country_id" => '11', "name_en" => 'Diyarbakir ', "name_ar" =>  'دیار بكر', "status" => '1'],
            ["id" => '257', "diyarnaa_country_id" => '11', "name_en" => 'Edirne ',  "name_ar" => 'أدرنة', "status" => '1'],
            ["id" => '258', "diyarnaa_country_id" => '11', "name_en" => 'El Azgh ',  "name_ar" => 'الازغ', "status" => '1'],
            ["id" => '259', "diyarnaa_country_id" => '11', "name_en" => 'Erzincan ',  "name_ar" => 'أرزینجان', "status" => '1'],
            ["id" => '260', "diyarnaa_country_id" => '11', "name_en" => 'Erzurum ',  "name_ar" => 'أرضروم', "status" => '1'],
            ["id" => '261', "diyarnaa_country_id" => '11', "name_en" => 'Eskişehir ',  "name_ar" => ' أسكي شھیر', "status" => '1'],
            ["id" => '262', "diyarnaa_country_id" => '11', "name_en" => 'Gaziantep ', "name_ar" =>  ' غازي عینتاب', "status" => '1'],
            ["id" => '263', "diyarnaa_country_id" => '11', "name_en" => 'Giresun ', "name_ar" =>  'غيرسون', "status" => '1'],
        ];
        foreach ($diyarnaa_cities as $diyarnaa_city) {
            DiyarnaaCity::create($diyarnaa_city);
        }
        // ======================================================================
        // ========================= Diyarnaa Region Section =========================
        // =====================================================================
        $diyarnaa_regions = [
            ["diyarnaa_city_id" => 38, "name_en" => 'Ajloun', "name_ar" =>  'عجلون',  "status" => '1'],
            ["diyarnaa_city_id" => 38, "name_en" => 'Ain Jannah', "name_ar" => 'عين جنة',  "status" => '1'],
            ["diyarnaa_city_id" => 38, "name_en" => 'Al Tayara', "name_ar" => 'الطيارة',  "status" => '1'],
            ["diyarnaa_city_id" => 38, "name_en" => 'Ashtafina', "name_ar" => 'اشتفينا',  "status" => '1'],
            ["diyarnaa_city_id" => 38, "name_en" => 'Governorate', "name_ar" =>  'محنا',  "status" => '1'],
            ["diyarnaa_city_id" => 38, "name_en" => 'Umm al-Yanabe\'', "name_ar" => 'أم الينابيع',  "status" => '1'],
            ["diyarnaa_city_id" => 38, "name_en" => 'Negev',  "name_ar" => 'النقب',  "status" => '1'],
            ["diyarnaa_city_id" => 38, "name_en" => 'Khallet Salem', "name_ar" => 'خلة سالم', "status" => '1'],
            ["diyarnaa_city_id" => 38, "name_en" => 'Aweimer', "name_ar" => 'عويمر',  "status" => '1'],
            ["diyarnaa_city_id" => 38, "name_en" => 'Za\'tara', "name_ar" => 'الزعترة', "status" => '1'],
        ];
        foreach ($diyarnaa_regions as $diyarnaa_region) {
            DiyarnaaRegion::create($diyarnaa_region);
        }
        // ======================================================================
        // =========================Main Category Section =========================
        // =====================================================================
        MainCategory::create([
            'name_en' => 'Residential',
            'name_ar' => 'سكني',
            'status' => 1,
        ]);
        MainCategory::create([
            'name_en' => 'Commercial',
            'name_ar' => 'تجاري',
            'status' => 1,
        ]);
        MainCategory::create([
            'name_en' => 'Industrial',
            'name_ar' => 'صناعي',
            'status' => 1,
        ]);
        MainCategory::create([
            'name_en' => 'lands',
            'name_ar' => 'أراضي',
            'status' => 1,
        ]);
        // ======================================================================
        // =========================Sub Category Section =========================
        // ======================== سكني / Residential===========================
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'lounge',
            'name_ar' => 'استراحة',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Any Villa',
            'name_ar' => 'أي فيلا',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Bungalow',
            'name_ar' => 'بانجلو',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Building',
            'name_ar' => 'بنایة',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'whole building',
            'name_ar' => 'بنایة كاملة',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Pent House',
            'name_ar' => 'بنت هاوس',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'House',
            'name_ar' => 'بيت ',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'town house',
            'name_ar' => 'تاون ھاوس ',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Jakhour',
            'name_ar' => 'جاخور',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'populations',
            'name_ar' => 'جمعیات',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Duplex',
            'name_ar' => 'دوبلكس',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Houses',
            'name_ar' => 'دور',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Roof',
            'name_ar' => 'روف',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'WorkersWorkers accommodation',
            'name_ar' => 'سكن عمال',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Shalet',
            'name_ar' => 'شالیه',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'apartment',
            'name_ar' => 'شقة',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Hotel Appartment',
            'name_ar' => 'شقة فندقیة',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Appartments',
            'name_ar' => 'شقق',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'an entire floor',
            'name_ar' => 'طابق كامل',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Building',
            'name_ar' => 'عمارة',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Hotel rooms',
            'name_ar' => 'غرف فندقیة',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'room',
            'name_ar' => 'غرفة',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Villas',
            'name_ar' => 'فلل',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Villa',
            'name_ar' => 'فیلا',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Villa in a complex',
            'name_ar' => 'فيلا في مجمع',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Cellar',
            'name_ar' => 'قبو',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Qaseemeh',
            'name_ar' => 'قسیمة',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'palace',
            'name_ar' => 'قصر',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'palaces',
            'name_ar' => 'قصور',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'residential building',
            'name_ar' => 'مبنى سكني',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'a store',
            'name_ar' => 'متجر',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Apartment complex',
            'name_ar' => 'مجمع سكني',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Apartment complex',
            'name_ar' => 'مجمع سكني',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Shop',
            'name_ar' => 'محل',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Store',
            'name_ar' => 'مخزن',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Farm',
            'name_ar' => 'مزرعة',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Residential project',
            'name_ar' => 'مشروع سكني',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'office',
            'name_ar' => 'مكتب',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Double house',
            'name_ar' => 'منزل مزدوج',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'half floor',
            'name_ar' => 'نصف طابق',
            'status' => 1,
        ]);
        // ======================================================================
        // =========================Sub Category Section =========================
        // ======================== تجاري / Commercial===========================
        SubCategory::create([
            'category_id' => 2,
            'name_ar' => 'أرض',
            'name_en' => 'land',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_ar' => 'برج',
            'name_en' => 'tower',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_ar' => 'دور',
            'name_en' => 'Role',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_ar' => 'رياض أطفال',
            'name_en' => 'Kindergarten',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_ar' => 'سكن موظفين',
            'name_en' => 'Staff accommodation',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_ar' => 'شقق استثمارية',
            'name_en' => 'investment apartments',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_ar' => 'شقق فندقية',
            'name_en' => 'Hotel Appartments',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_ar' => ' صالة عرض',
            'name_en' => 'Gallery',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_ar' => 'طابق تجاري',
            'name_en' => 'Commercial floor',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_ar' => 'عمارة تجارية',
            'name_en' => 'Commercial building',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_ar' => 'عیادة',
            'name_en' => 'clinic',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_ar' => 'فندق',
            'name_en' => 'hotel',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'Villa',
            'name_ar' => 'فیلا',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_ar' => 'فيلا تجاريه',
            'name_en' => 'Commercial villa',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'showroom',
            'name_ar' => 'قاعة عرض',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'Qaseemeh',
            'name_ar' => 'قسيمة',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'garage',
            'name_ar' => 'كراج',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'booth',
            'name_ar' => 'كشك',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'Market',
            'name_ar' => 'ماركت',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'Commercial building',
            'name_ar' => 'مبنى تجاري',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'store',
            'name_ar' => 'متجر',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'complex',
            'name_ar' => 'مجمع',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'Petrol station',
            'name_ar' => 'محطة وقود',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'Shop',
            'name_ar' => 'محل',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'Shops',
            'name_ar' => 'محلات',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'Store',
            'name_ar' => 'مخزن',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'Farm',
            'name_ar' => 'مزرعة',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'storehouse',
            'name_ar' => 'مستودع',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'government project',
            'name_ar' => 'مشروع حكومي',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'Resturant',
            'name_ar' => 'مطعم',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'Exhibition',
            'name_ar' => 'معرض',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'Lab',
            'name_ar' => 'معمل',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'cafe',
            'name_ar' => 'مقھى',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'Office',
            'name_ar' => 'مكتب',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'club',
            'name_ar' => 'نادي',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'Shop front',
            'name_ar' => 'واجھة محل',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 2,
            'name_en' => 'workshop',
            'name_ar' => 'ورشة',
            'status' => 1,
        ]);
        // ======================================================================
        // =========================Sub Category Section =========================
        // ======================== صناعي / Industrial===========================
        SubCategory::create([
            'category_id' => 3,
            'name_en' => 'Staff accommodation',
            'name_ar' => 'سكن موظفين',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 3,
            'name_en' => 'Industrial floor',
            'name_ar' => 'طابق صناعي ',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 3,
            'name_en' => 'Qaseemeh',
            'name_ar' => 'قسیمة',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 3,
            'name_en' => 'a store',
            'name_ar' => 'متجر',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 3,
            'name_en' => 'Shop',
            'name_ar' => 'محل',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 3,
            'name_en' => 'Retail stores',
            'name_ar' => 'محلات تجزئة',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 3,
            'name_en' => 'Stores',
            'name_ar' => 'مخازن',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 3,
            'name_en' => 'Store',
            'name_ar' => 'مخزن',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 3,
            'name_en' => 'Store',
            'name_ar' => 'مخزن',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 3,
            'name_en' => 'storehouse',
            'name_ar' => 'مستودع',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 3,
            'name_en' => 'Factory',
            'name_ar' => 'مصنع',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 3,
            'name_en' => 'Lab',
            'name_ar' => 'معمل',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 3,
            'name_en' => 'office',
            'name_ar' => 'مكتب',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 3,
            'name_en' => 'Hanger',
            'name_ar' => 'ھنجر',
            'status' => 1,
        ]);
        // ======================================================================
        // =========================Sub Category Section =========================
        // ======================== اراضي / lands===========================
        SubCategory::create([
            'category_id' => 4,
            'name_ar' => 'أرض',
            'name_en' => 'land',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 4,
            'name_ar' => 'أرض سكنية',
            'name_en' => 'Residential land',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 4,
            'name_ar' => 'أرض تجارية',
            'name_en' => 'commercial land',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 4,
            'name_ar' => 'أرض صناعية',
            'name_en' => 'Industrial land',
            'status' => 1,
        ]);
        SubCategory::create([
            'category_id' => 4,
            'name_ar' => 'أرض زراعية',
            'name_en' => 'Agricultural Land',
            'status' => 1,
        ]);

        // ======================================================================
        // =========================Feature Type Section =========================
        // =====================================================================
        FeatureType::create([
            'name_en' => 'Construction Age',
            'name_ar' => 'عمر البناء',
            'status' => '1',
        ]);
        FeatureType::create([
            'name_en' => 'Land Area',
            'name_ar' => 'مساحة الارض',
            'status' => '1',
        ]);
        FeatureType::create([
            'name_en' => 'Real estate Status',
            'name_ar' => 'حالة العقار',
            'status' => '1',
        ]);
        FeatureType::create([
            'name_en' => 'Number of Rooms',
            'name_ar' => 'عدد الغرف',
            'status' => '1',
        ]);
        FeatureType::create([
            'name_en' => 'Number of Bathrooms',
            'name_ar' => 'عدد الحمامات',
            'status' => '1',
        ]);
        // ======================================================================
        // =========================Feature  Section =========================
        // =====================================================================
        Feature::create([
            'name_en' => 'Under construction',
            'name_ar' => ' قيد اإلنشاء',
            'status' => 1,
            'feature_type_id' => 1,

        ]);
        Feature::create([
            'name_en' => ' 11 – 0 months',
            'name_ar' => 'شهر 11 – 0',
            'status' => 1,
            'feature_type_id' => 1,
        ]);
        Feature::create([
            'name_en' => ' 1 – 5 years',
            'name_ar' => '1-5 سنوات',
            'status' => 1,
            'feature_type_id' => 1,
        ]);
        Feature::create([
            'name_en' => ' 6 – 9 years',
            'name_ar' => '6-9 سنوات',
            'status' => 1,
            'feature_type_id' => 1,
        ]);
        Feature::create([
            'name_en' => ' 10 – 19 years',
            'name_ar' => '10-19 سنوات',
            'status' => 1,
            'feature_type_id' => 1,
        ]);
        Feature::create([
            'name_en' => ' 20+ years',
            'name_ar' => '20 سنة',
            'status' => 1,
            'feature_type_id' => 1,
        ]);
        Feature::create([
            'name_en' => 'Square meters',
            'name_ar' => 'متر مربع ',
            'status' => 1,
            'feature_type_id' => 2,
        ]);
        Feature::create([
            'name_en' => 'Square foot',
            'name_ar' => ' قدم مربع ',
            'status' => 1,
            'feature_type_id' => 2,
        ]);
        Feature::create([
            'name_en' => ' acre',
            'name_ar' => ' فّدان ',
            'status' => 1,
            'feature_type_id' => 2,
        ]);
        Feature::create([
            'name_en' => ' acres',
            'name_ar' => ' دونم ',
            'status' => 1,
            'feature_type_id' => 2,
        ]);
        Feature::create([
            'name_en' => ' Hectare',
            'name_ar' => ' هكتار ',
            'status' => 1,
            'feature_type_id' => 2,
        ]);
        Feature::create([
            'name_en' => ' Ready for delivery',
            'name_ar' => ' جاهز للتسليم',
            'status' => 1,
            'feature_type_id' => 3,
        ]);
        Feature::create([
            'name_en' => ' Unde construction',
            'name_ar' => ' قيد اإلنشاء',
            'status' => 1,
            'feature_type_id' => 3,
        ]);
        Feature::create([
            'name_en' => ' Studio',
            'name_ar' => ' ستوديو ',
            'status' => 1,
            'feature_type_id' => 4,
        ]);
        Feature::create([
            'name_en' => ' Bedroom',
            'name_ar' => ' غرفة نوم ',
            'status' => 1,
            'feature_type_id' => 4,
        ]);
        Feature::create([
            'name_en' => ' 2 Bedrooms',
            'name_ar' => ' 2 غرفتا نوم',
            'status' => 1,
            'feature_type_id' => 4,
        ]);
        Feature::create([
            'name_en' => ' 3 Bedrooms',
            'name_ar' => ' 3 غرفتا نوم',
            'status' => 1,
            'feature_type_id' => 4,
        ]);
        Feature::create([
            'name_en' => ' 4 Bedrooms',
            'name_ar' => ' 4 غرفتا نوم',
            'status' => 1,
            'feature_type_id' => 4,
        ]);
        Feature::create([
            'name_en' => ' 5 Bedrooms',
            'name_ar' => ' 5 غرفتا نوم',
            'status' => 1,
            'feature_type_id' => 4,
        ]);
        Feature::create([
            'name_en' => ' 5+ Bedrooms',
            'name_ar' => ' 5+ غرفتا نوم',
            'status' => 1,
            'feature_type_id' => 4,
        ]);
        Feature::create([
            'name_en' => ' Bathroom',
            'name_ar' => 'حمام',
            'status' => 1,
            'feature_type_id' => 5,
        ]);
        Feature::create([
            'name_en' => '2 Bathroom',
            'name_ar' => 'حمامين',
            'status' => 1,
            'feature_type_id' => 5,
        ]);
        Feature::create([
            'name_en' => '3 Bathroom',
            'name_ar' => '3 حمامات',
            'status' => 1,
            'feature_type_id' => 5,
        ]);
        Feature::create([
            'name_en' => '4 Bathroom',
            'name_ar' => '4 حمامات',
            'status' => 1,
            'feature_type_id' => 5,
        ]);
        Feature::create([
            'name_en' => '5 Bathroom',
            'name_ar' => '5 حمامات',
            'status' => 1,
            'feature_type_id' => 5,
        ]);
        Feature::create([
            'name_en' => '5+ Bathroom',
            'name_ar' => '5+ حمامات',
            'status' => 1,
            'feature_type_id' => 5,
        ]);


        // ======================================================================
        // =========================Feature  Section =========================
        // =====================================================================

        BackgroundImage::create([
            'website_broker' => null,
            'complaint' => null,
            'job' => null,
            'term_condition' => null,
            'privacy_policy' => null,
            'user_signup' => null,
            'user_login' => null,
            'advertisement_details' => null,
            'user_dashboard' => null,
        ]);
    }
}
